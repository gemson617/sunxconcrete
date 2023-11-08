<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SalesOrder extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->is_logged_in();
        
        if($this->auth_level!=9){
            redirect('/logout');
        }
    }
   
    public function view()
    {
        $this->db->select('s.id AS id, s.status AS salesStatus,
                   SUM(si.received_qty) AS received_quantity,
                   SUM(si.tottalamt) AS received_amount,
                   SUM(si.available_quantity) AS availableQty,
                   s.total_qty,
                   s.grand_total,
                   s.created_on,
                   s.sale_no,
                   s.po_number,
                   si.sales_order_id as sale_id,
                   si.product_id,
                   si.driver_name,
                   si.truck_no,
                   si.transaction_id,
                   c.company_name,                   
                   ');
        $this->db->from('sales_order as s');
        $this->db->join('sales_order_items as si', 'si.sales_order_id = s.id', 'left');
        $this->db->join('customer as c','c.customer_id = s.sold_to_party','left'); 
        $this->db->group_by('si.sales_order_id, si.id');
        $query = $this->db->get()->result();
        


        $resultArr = array();

        foreach($query as $key=>$row){
            $sale_id = $row->sale_id;

            if (!isset($resultArr[$sale_id])) {
                $resultArr[$sale_id] = array();
            }

            $resultArr[$sale_id]['id'] = $row->id;
            $resultArr[$sale_id]['received_quantity'] = $row->received_quantity;
            $resultArr[$sale_id]['received_amount'] = $row->received_amount;
            $resultArr[$sale_id]['availableQty'] = $row->availableQty;
            $resultArr[$sale_id]['total_qty'] = $row->total_qty;
            $resultArr[$sale_id]['grand_total'] = $row->grand_total;
            $resultArr[$sale_id]['created_on'] = $row->created_on;
            $resultArr[$sale_id]['sale_no'] = $row->sale_no;
            $resultArr[$sale_id]['po_number'] = $row->po_number;
            $resultArr[$sale_id]['company_name'] = $row->company_name;
            
            $resultArr[$sale_id]["child"][] = $row;
        }

        // echo "<pre>";print_r($resultArr);
        // die();

        $view_data['sale'] = $resultArr;
        $data = array(
            'title' => 'Sales Orders',
            'content' => $this->load->view('pages/sales_order/view', $view_data, true),
        );
        $this->load->view('base/base_template', $data);  
    }


    //inser function 

    public function add()
    {
        if(isset($_POST['submit'])) {
          
      
            $user_id =$this->auth_user_id; 
            $qno = $this->input->post('qno');
            $sold_to_party = $this->input->post('sold_to');    
            $ship_to_party = $this->input->post('ship_to');  
            $remarks = $this->input->post('remarks');  
            $cgst = $this->input->post('cgst');    
            $sgst = $this->input->post('sgst');    
            $igst = $this->input->post('igst');    
            $total_tax = $this->input->post('total_tax');    
            $round_off = $this->input->post('round_off');    
            $g_total = $this->input->post('g_total');  
            $sub_total = $this->input->post('sub_total');  



            $product = $this->input->post('product[]');    
            $hsn_code = $this->input->post('hsn_id[]');    
            $uom = $this->input->post('uom_id[]');   
            $qty = $this->input->post('qty[]');   
            $price = $this->input->post('price[]');   
            $amount = $this->input->post('amount[]');  

           

            $insert_array = array(
                'user_id' => $user_id,  
                'quotation_no' => $qno,                
                'sub_total' => $sub_total,               
                'cgst' => $cgst,
                'sgst' => $sgst,
                'igst' => $igst,
                'total_tax' => $total_tax,
                'round_off' => $round_off,    
                'grand_total' => $g_total,    
                'sold_to_party' => $sold_to_party,    
                'ship_to_party' => $ship_to_party,               
                'remarks' => $remarks,               
               
                'created_on' => date('Y-m-d h:i:s'),
            );


 
            $insert = $this->mcommon->common_insert('quotation', $insert_array);
            $quotation_id = $this->db->insert_id();
           
           
           
            $rowcount = count($product);
           
            for ($i = 0; $i < $rowcount; $i++) 
            {
                $insert_array_new = array(
                    'quotation_id' => $quotation_id,
                    'user_id' => $user_id,
                    'product_id'   => $product[$i],
                    'hsn_id' => $hsn_code[$i],
                    'uom_id' => $uom[$i],
                    'quantity' => $qty[$i],
                    'price' => $price[$i],
                    'amount' => $amount[$i],
                    'created_on' => date('Y-m-d'),
                );
                $insert = $this->mcommon->common_insert('quotation_sub', $insert_array_new);
            }
          

            $update_com_status = $this->mcommon->common_edit('em_companies',array('quotation_sn_status'=>0),array('id' =>1));

          $qtyData = $this->getTotalQuantity($quotation_id);
             $quantity = 0;

             foreach ($qtyData as $qty){
               $quantity += $qty->quantity;
             }

             $update_array_new = array(
                'total_qty'=>$quantity
             );
              
             $update_new = $this->mcommon->common_edit('quotation', $update_array_new,array('id' => $quotation_id));

            if ($update_new > '0') {
                $this->session->set_flashdata('alert_success', 'Quotation added successfully!');
                redirect('Quotation/view');
            } else {
                $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
            }
        }
        $view_data['uom'] = $this->mcommon->records_all('uom', array('status' => 1));      

        $view_data['customers'] = $this->mcommon->records_all('customer', array('status' => 1));
        $view_data['products'] = $this->mcommon->records_all('product', array('status' => 1));    
        // $view_data['qno'] = $this->mcommon->records_all('em_companies', array('id' => 1))->row();
        $this->db->select('*');
        $this->db->from('em_companies'); 
        $this->db->where('id',1); 
        $result = $this->db->get()->row();
        // print_r($result); exit();
        
            if ($result->quotation_sn_status == 1) {
                $view_data['qnumber'] = $result->quotation_starting_number;
            } else {
                $quotationRecord = $this->mcommon->last_inserid('quotation');
                $view_data['qnumber'] = !empty($quotationRecord) ? $quotationRecord->quotation_no : null;
            }       
        $data = array(
            'title' => 'Add Sale',
            'content' => $this->load->view('pages/sales_order/add', $view_data, true),
        );
        $this->load->view('base/base_template', $data);
    }

//Edit Function
    public function edit($id){

        if (isset($_POST['submit'])) {
           
            $removeid = $this->input->post('removeid');    
           


            $user_id =$this->auth_user_id; 
            $sold_to_party = $this->input->post('sold_to');    
            $ship_to_party = $this->input->post('ship_to');  
            $remarks = $this->input->post('remarks');  
            $cgst = $this->input->post('cgst');    
            $sgst = $this->input->post('sgst');    
            $total_tax = $this->input->post('total_tax');    
            $round_off = $this->input->post('round_off');    
            $g_total = $this->input->post('g_total');  
            $sub_total = $this->input->post('sub_total');  



            $product = $this->input->post('product');    
            $hsn_code = $this->input->post('hsn_id');    
            $uom = $this->input->post('uom_id');   
            $qty = $this->input->post('qty');   
            $price = $this->input->post('price');   
            $amount = $this->input->post('amount');  
            $subId =  $this->input->post('primary_id'); 

        //  print_r($this->input->post('qty'));
        //  exit();


            $update_array = array(

                'user_id' => $user_id,    
                
                'sub_total' => $sub_total,               
                'cgst' => $cgst,               
                'sgst' => $sgst,               
                'total_tax' => $total_tax,    
                'round_off' => $round_off,    
                'grand_total' => $g_total,    
                'sold_to_party' => $sold_to_party,    
                'ship_to_party' => $ship_to_party,               
                'remarks' => $remarks,    
                'created_on' => date('Y-m-d'),
            );

            $update = $this->mcommon->common_edit('quotation', $update_array, array('id' => $id));
            
            $rowcount = count($product);

           
            
                for ($i = 0; $i < $rowcount; $i++) 
                {

                    if($subId[$i] != '')
                    {
                    $update_array_new = array(
                        
                        'user_id' => $user_id,
                        'product_id'   => $product[$i],
                        'hsn_id' => $hsn_code[$i],
                        'uom_id' => $uom[$i],
                        'quantity' => $qty[$i],                        
                        'price' => $price[$i],
                        'amount' => $amount[$i],
                        'created_on' => date('Y-m-d'),
                    );
                    $update = $this->mcommon->common_edit('quotation_sub', $update_array_new, array('id' => $subId[$i]));
                }else{
                    $insert_array_new = array(
                        
                        'user_id' => $user_id,
                        'quotation_id' => $id,
                        'product_id'   => $product[$i],
                        'hsn_id' => $hsn_code[$i],
                        'uom_id' => $uom[$i],
                        'quantity' => $qty[$i],
                        'price' => $price[$i],
                        'amount' => $amount[$i],
                        'created_on' => date('Y-m-d'),
                    );
                    $insert = $this->mcommon->common_insert('quotation_sub', $insert_array_new);
                }
            }

 
            $qtyData = $this->getTotalQuantity($id);
             $quantity = 0;

             foreach ($qtyData as $qty){
               $quantity += $qty->quantity;
             }

             $update_array_new = array(
                'total_qty'=>$quantity
             );
              
             $update_new = $this->mcommon->common_edit('quotation', $update_array_new,array('id' => $id));



             $rowcount2 = count($removeid);

             for ($i = 0; $i < $rowcount2; $i++) 
             {
                $delete = $this->mcommon->common_delete('quotation_sub',array('id' => $removeid[$i]));
   
             }


            if ($update) {
                $this->session->set_flashdata('alert_success', 'Quotation updated successfully!');
                redirect('Quotation/view');
            } else {
                $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
            }

      
        
    }else{
        $view_data['customers'] = $this->mcommon->records_all('customer', array('status' => 1));
        $view_data['products'] = $this->mcommon->records_all('product', array('status' => 1));    
        $view_data['quotation'] = $this->mcommon->specific_row('quotation', array('id' => $id));    
        $view_data['uom'] = $this->mcommon->records_all('uom', array('status' => 1)); 
     
            // $this->db->from('quotation'); 
            // $this->db->where('id', $id);
            //  $result = $this->db->get();
            //  return $result->result();
            
                    // qSub.id as qSubId,
                    // qsub.quantity as subQty,
                    // qsub.price as subPrice,
                    // qsub.amount as subAmount,
      

        $this->db->select('*,
                            qSub.id as qSubId,
                            qSub.quantity as subQty,
                            qSub.price as subPrice,
                            qSub.amount as subAmount,');
        $this->db->from('quotation_sub as qSub'); 
        $this->db->where('qSub.quotation_id', $id); 
        $this->db->join('product as p','p.product_id = qSub.product_id','left'); 
        $this->db->join('hsn_code as h', 'h.hsn_id = qSub.hsn_id','left'); 
        $this->db->join('uom as u', 'u.uom_id = qSub.uom_id','left'); 
        $this->db->order_by('qSub.id','DESC');       
        $query = $this->db->get();
        $view_data['quotations'] = $query->result();  
        
        $data = array(
            'title' => 'Edit Sale',
            'content' => $this->load->view('pages/sales_order/edit', $view_data, true),
        );
        $this->load->view('base/base_template', $data);
    }
    }


    public function invoice_list(){
        $this->db->select('*,s.status as salesStatus');
        $this->db->from('sales_order as s');
        $this->db->join('sales_order_sub as sob','sob.sales_order_id=s.id','left');
        $this->db->join('product as p','p.product_id = sob.product_id','left');
        $this->db->join('customer as c','c.customer_id = s.sold_to_party','left');
        $this->db->join('hsn_code as h', 'h.hsn_id = sob.hsn_id','left');
        $this->db->join('uom as u', 'u.uom_id = sob.uom_id','left');
        $this->db->order_by('s.id','DESC');
        $query = $this->db->get();
        $view_data['salesOrder'] = $query->result();
        
        $data = array(
            'title' => 'Sales Invoice List',
            'content' => $this->load->view('pages/sales_order/invoicelist', $view_data, true),
        );
        $this->load->view('base/base_template', $data);
    }
      
    public function getQuantity($id)
    {
        if (isset($_POST['submit'])) {
           
            $plant_id = $this->input->post('plant_id'); 
            $credit_bill_status = $this->input->post('credit_bill'); 

            $subId = $this->input->post('subId');
            $product = $this->input->post('product'); 
            $qty = $this->input->post('qty');
            $amount = $this->input->post('amount');

            $truck_no = $this->input->post('truck_no'); 
            $driver_name = $this->input->post('driver_name'); 
            $dc_no = $this->input->post('dc_no'); 
            $batch_no = $this->input->post('batch_no'); 
            $dc_date = $this->input->post('dc_date'); 
            $po_number = $this->input->post('po_number'); 

            $rowcount = count($qty);
            $uniqueId = md5(uniqid());

            for ($i = 0; $i < $rowcount; $i++) 
            {
                if($qty[$i] != '')
                {
                    if($qty[$i] != 0)
                    {
                        $sales_order_id = $this->mcommon->specific_row_value('sales_order_sub', array('id' => $subId[$i]),'sales_order_id');
                        $total_qty = $this->mcommon->specific_row_value('sales_order_sub', array('id' => $subId[$i]),'total_qty');
                        $available_qty = $this->mcommon->specific_row_value('sales_order_sub', array('id' => $subId[$i]),'available_qty');
                        $receivedQty = $this->mcommon->specific_row_value('sales_order_sub', array('id' => $subId[$i]),'received_qty');
                        
                        $received_qty = $receivedQty + $qty[$i];
                        $available_qty=$available_qty - $qty[$i];
                            

                        $update_array = array(
                                'received_qty' => $received_qty,
                                'available_qty' => $available_qty,
                            );
                            

                            $update = $this->mcommon->common_edit('sales_order_sub', $update_array,array('id'=>$subId[$i]));
                           
                            $available_qty = $this->mcommon->specific_row_value('sales_order_sub', array('id' => $subId[$i]),'available_qty');
                      
                            $igst = $amount[$i] * 18/100;
                            $totalAmount = $amount[$i] + $igst;

                            $insert_array = array(
                                'plant_id' => $plant_id,
                                'po_no' => $po_number,
                                'transaction_id' => $uniqueId,
                                'credit_bill_status' => $credit_bill_status,
                                'sales_order_id' => $id,
                                'product_id' => $product[$i],
                                'total_quantity'=>$total_qty,
                                'available_quantity'=>$available_qty,
                                'received_qty'=>$qty[$i],
                                'sale_price'=>$amount[$i],
                                'tax'=>$igst,
                                'tottalamt'=>$totalAmount,
                                'truck_no'=>$truck_no,
                                'driver_name'=>$driver_name,
                                'dc_no'=>$dc_no,
                                'dc_date'=>$dc_date,
                                'batch_no'=>$batch_no,
                                'created_on'=>date('d-m-y')
                            );

                            $insert = $this->mcommon->common_insert('sales_order_items', $insert_array);

                            // $this->db->select('*');
                            // $this->db->from('sales_order_sub as sub'); 
                            // $this->db->where('sub.sales_order_id',$sales_order_id);       
                            // $query = $this->db->get();
                            // $total_qty = $query->result();
                            // $total_quantity = 0;

                            // foreach($total_qty as $total){
                            //     $total_quantity += $total->total_qty;
                            // }

                            // $update_array_new = $this->mcommon->common_edit('sales_order_sub', $update_array,array('id'=>$subId[$i]));
                            
                          

                    }
                }


            }
        
           
        
            

            // $available_quantity = $this->mcommon->specific_row_value('sales_order', array('id' => $id),'available_quantity');
            // $received_quantity = $this->mcommon->specific_row_value('sales_order', array('id' => $id),'received_qty');

            // $total_quantity = $this->mcommon->specific_row_value('sales_order', array('id' => $id),'total_quantity');
            // $price = $this->mcommon->specific_row_value('sales_order', array('id' => $id),'price');
       
            // $quotation_id = $this->mcommon->specific_row_value('sales_order', array('id' => $id),'quotation_id');
            
            
            // $remaining_quantity = $available_quantity - $quantity;
            // $received_quantity = $received_quantity + $quantity;
            // $sale_price = $quantity * $price;
            // $tax = $sale_price * 18 /100;
            // $tottalamt = $tax + $sale_price;
            
    
            // $update_array = array(
            //     'available_quantity' => $remaining_quantity,               
            //     'received_qty' => $received_quantity,               
            //     'status' => 2,               
            // );

            // $update = $this->mcommon->common_edit('sales_order', $update_array,array('id'=>$id));


            // $insert_array = array(
            //     'sales_order_id'=>$id,
            //     'plant_id'=>$plant_id,
            //     'quotation_id'=>$quotation_id,
            //     'total_quantity'=>$total_quantity,
            //     'available_quantity' => $remaining_quantity,               
            //     'sale_price' => $sale_price,               
            //     'tax' => $tax,               
            //     'tottalamt' => $tottalamt,               
            //     'credit_bill_status' => $credit_bill_status,               
            //     'received_qty' => $quantity,              
            //     'created_on' => date('d-m-y'),               
            // );
            // $insert = $this->mcommon->common_insert('sales_order_items', $insert_array);
           
            // $received_quantity_new = $this->mcommon->specific_row_value('sales_order', array('id' => $id),'received_qty');

            // if($received_quantity_new >= $total_quantity){
            //     $update_array2 = array(
            //         'status' => 3,               
            //     );
    
            //     $update = $this->mcommon->common_edit('sales_order', $update_array2,array('id'=>$id));
            // }

            if ($insert > '0') {
                $this->session->set_flashdata('alert_success', 'Sales Order Updated Successfully!');
                redirect('SalesOrder/view');
            } else {
                $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
                redirect('SalesOrder/view');
            }
        }
        else{

            $this->db->select('*,sub.id as subId, sub.price as sprice');
            $this->db->from('sales_order_sub as sub'); 
            $this->db->where('sub.sales_order_id', $id); 
            $this->db->join('sales_order as s','s.id = sub.sales_order_id','left'); 
            $this->db->join('product as p','p.product_id = sub.product_id','left'); 
            $this->db->join('hsn_code as h', 'h.hsn_id = sub.hsn_id','left'); 
            $this->db->join('uom as u', 'u.uom_id = sub.uom_id','left'); 
            // $this->db->order_by('sub.id','DESC');       
            $query = $this->db->get();
            $view_data['products'] =  $query->result();

            //   ECHO'<PRE>';
            // print_r($view_data['products']);
            // exit();




            $this->db->select('*');
            $this->db->from('plant_master as u'); 
            $this->db->order_by('u.pm_id','DESC');       
            $query = $this->db->get();
            $view_data['plant'] = $query->result();

           

            $this->db->select('*,sub.id as subId');
            $this->db->from('sales_order_sub as sub');
            $this->db->where('sub.sales_order_id',$id);    
            $this->db->join('product as p','p.product_id = sub.product_id','left'); 
            $this->db->join('hsn_code as h', 'h.hsn_id = sub.hsn_id','left'); 
            $this->db->join('uom as u', 'u.uom_id = sub.uom_id','left'); 
            $query = $this->db->get();
            // $view_data['products'] =  $query->result();

          

            $view_data['id'] = $id;
            $data = array(
                'title' => 'Sales Orders',
                'content' => $this->load->view('pages/sales_order/sale', $view_data, true),
            );
            $this->load->view('base/base_template', $data);  
        }
    }



    public function get_product()
    {
        $product_id = $this->input->post("product_id");
        $results = $this->product_details($product_id);
        echo json_encode($results);
    }

    public function product_details($product_id){
        $this->db->select('p.price as product_rate,h.hsn_name,u.uom,
                            hsn_id,uom_id');
        $this->db->from('product as p'); 
        $this->db->where('p.product_id',$product_id); 
        $this->db->join('hsn_code as h', 'h.hsn_id = p.hsn_code'); 
        $this->db->join('uom as u', 'u.uom_id = p.uom'); 
        $this->db->limit('1');       
        $result = $this->db->get()->row_array();
        // $result = $query->result();
        return $result;
    }


    public function getProducts(){
      
        $sales_order_id = $this->input->post("sales_order_id");
        $result =  $this->db->select('p.product_id,p.product_name');
        $this->db->from('sales_order_sub as sub');
        $this->db->join('product as p','p.product_id = sub.product_id','left'); 
        $this->db->where('sub.sales_order_id',$sales_order_id);    
        $query = $this->db->get();
        $results = $query->result();  
        echo json_encode($results);
    }
    
    public function viewSalesItems($id)
    {

        
        $this->db->select('*, c.company_name , si.total_quantity as totalQuantity,
                            si.available_quantity as availableQuantity,
                            sum(si.received_qty) as receivedQty,
                            sum(si.tottalamt) as totalAmount,
                            si.transaction_id as transaction_id,
                            si.created_on as created_date
                            ');
        $this->db->from('sales_order as s'); 
        $this->db->join('sales_order_items as si','si.sales_order_id = s.id'); 
        // $this->db->join('sales_order_sub as sub','sub.sales_order_id = s.id'); 
        $this->db->where('si.sales_order_id',$id); 
        // $this->db->join('product as p','p.product_id = sub.product_id','left'); 
        $this->db->join('customer as c','c.customer_id = s.sold_to_party','left'); 
        $this->db->order_by('si.id','DESC');       
        $this->db->group_by('si.transaction_id');       
        $query = $this->db->get();
        $view_data['salesOrder'] = $query->result();
        $view_data['id'] = $id;
        //         echo "<pre>";
        // print_r($view_data['salesOrder']);
        // exit();
        $data = array(
            'title' => 'Sales Order Items',
            'content' => $this->load->view('pages/sales_order/viewSalesItems', $view_data, true),
        );
        $this->load->view('base/base_template', $data);  
    }



    public function invoice($id)
    
    {

        $this->db->select('*,
        s.status as sStatus,
        s.id as sId');
        $this->db->from('sales_order as s'); 
        $this->db->where('s.id',$id); 
        $this->db->join('product as p','p.product_id = s.product_id','left'); 
        $this->db->join('hsn_code as h', 'h.hsn_id = s.hsn_id','left'); 
        $this->db->join('uom as u', 'u.uom_id = s.uom_id','left'); 
        $view_data['salesOrder'] = $this->db->get()->row_array();
        

        $this->db->select('*,state.name as stateName');
        $this->db->from('sales_order as s'); 
        $this->db->where('s.id',$id); 
        $this->db->join('customer as c','c.customer_id = s.sold_to_party','left'); 
        $this->db->join('states as state', 'state.id = c.customer_state','left');       
        $view_data['sold_to_party'] = $this->db->get()->row_array();

        $this->db->select('*,state.name as stateName');
        $this->db->from('sales_order as s'); 
        $this->db->where('s.id',$id); 
        $this->db->join('customer as c','c.customer_id = s.ship_to_party','left');
        $this->db->join('states as state', 'state.id = c.customer_state','left');              
        $view_data['ship_to_party'] = $this->db->get()->row_array();
       
        $view_data['company'] = $this->mcommon->specific_row('em_companies', array('id' => 1));


        // echo "<pre>";
        // print_r($view_data['company']);
        // exit();  



        $data = array(
            'title' => 'Sales Quantity',
            'content' => $this->load->view('pages/sales_order/invoice', $view_data, true),
        );
        $this->load->view('base/base_template', $data);
          
    }

    public function itemsInvoice($id){
                 
        $this->db->select('*,si.total_quantity as totalQuantity,
                            si.available_quantity as availableQuantity,
                            si.received_qty as receivedQuantity');
        $this->db->from('sales_order as s'); 
        $this->db->join('sales_order_items as si','si.sales_order_id = s.id'); 
        $this->db->where('si.sales_order_id',$id); 
        $this->db->join('product as p','p.product_id = s.product_id','left'); 
        // $this->db->join('customer as c','c.customer_id = s.sold_to_party','left'); 
        $this->db->join('hsn_code as h', 'h.hsn_id = s.hsn_id','left'); 
        $this->db->join('uom as u', 'u.uom_id = s.uom_id','left'); 
        $query = $this->db->get();
        // $view_data['salesOrders'] = $query->row_array(); 
        $view_data['salesOrders'] = $query->result(); 

        $this->db->select('*,
        s.status as sStatus,
        s.id as sId');
        $this->db->from('sales_order as s'); 
        $this->db->where('s.id',$id); 
        $this->db->join('product as p','p.product_id = s.product_id','left'); 
        $this->db->join('hsn_code as h', 'h.hsn_id = s.hsn_id','left'); 
        $this->db->join('uom as u', 'u.uom_id = s.uom_id','left'); 
        $view_data['salesOrder'] = $this->db->get()->row_array();
        
        $this->db->select('*,state.name as stateName');
        $this->db->from('sales_order as s'); 
        $this->db->where('s.id',$id); 
        $this->db->join('customer as c','c.customer_id = s.sold_to_party','left'); 
        $this->db->join('states as state', 'state.id = c.customer_state','left');       
        $view_data['sold_to_party'] = $this->db->get()->row_array();

        $this->db->select('*,state.name as stateName');
        $this->db->from('sales_order as s'); 
        $this->db->where('s.id',$id); 
        $this->db->join('customer as c','c.customer_id = s.ship_to_party','left');
        $this->db->join('states as state', 'state.id = c.customer_state','left');              
        $view_data['ship_to_party'] = $this->db->get()->row_array();
       
        $view_data['company'] = $this->mcommon->specific_row('em_companies', array('id' => 1));
        $view_data['salesItems'] = $this->mcommon->specific_row('sales_order_items', array('id' => $id));
           
          

        $data = array(
            'title' => 'Sales Order Items',
            'content' => $this->load->view('pages/sales_order/itemsInvoice', $view_data, true),
        );
        $this->load->view('base/base_template', $data);  
    }

    public function deliveryChallan($id){
                 
      
        $this->db->select('*,si.total_quantity as totalQuantity,
                            si.available_quantity as availableQuantity,
                            si.received_qty as receivedQuantity');
       
        $this->db->from('sales_order_items as si'); 
        $this->db->where('si.transaction_id',$id);  
        $this->db->join('product as p','p.product_id = si.product_id','left'); 
        $this->db->join('hsn_code as h', 'h.hsn_id = p.hsn_code','left'); 
        $this->db->join('uom as u', 'u.uom_id = p.uom','left'); 
        $query = $this->db->get();
        $view_data['salesOrders'] = $query->result(); 


        $plant_id = 0;
        foreach ($view_data['salesOrders'] as $plant){
            $plant_id = $plant->plant_id;
          }
       
    
        $view_data['plant_name'] = $this->mcommon->specific_row_value('plant_master', array('pm_id' => $plant_id),'plant_master_name');    

//  echo "<pre>";
//         print_r($view_data['plant_name']);
//         exit();  


        $sales_order_id = $this->mcommon->specific_row_value('sales_order_items', array('transaction_id' => $id), 'sales_order_id');

        // $this->db->join('sales_order_sub as sub','si.sales_order_id=sub.sales_order_id '); 
        // // $this->db->join('sales_order as s','si.sales_order_id = s.id'); 
     
        $this->db->select('*,state.name as stateName');
        $this->db->from('sales_order as s'); 
        $this->db->where('s.id',$sales_order_id); 
        $this->db->join('customer as c','c.customer_id = s.sold_to_party','left'); 
        $this->db->join('states as state', 'state.id = c.customer_state','left');       
        $view_data['sold_to_party'] = $this->db->get()->row_array();

        $this->db->select('*,state.name as stateName');
        $this->db->from('sales_order as s'); 
        $this->db->where('s.id',$sales_order_id); 
        $this->db->join('customer as c','c.customer_id = s.ship_to_party','left');
        $this->db->join('states as state', 'state.id = c.customer_state','left');              
        $view_data['ship_to_party'] = $this->db->get()->row_array();
       
        $view_data['company'] = $this->mcommon->specific_row('em_companies', array('id' => 1));
        $view_data['salesItems'] = $this->mcommon->specific_row('sales_order_items', array('id' => $id));
           
   
        // echo "<pre>";
        // print_r($view_data['salesOrders']);
        // print_r($view_data['salesOrder']['sales_order_id']);
        // print_r($view_data['sold_to_party']);
        // print_r($view_data['ship_to_party']);
        // exit();   

        $data = array(
            'title' => 'Sales Invoice',
            'content' => $this->load->view('pages/sales_order/delivery_challan', $view_data, true),
        );
        $this->load->view('base/base_template', $data);  
    }

}
