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
              
        $this->db->select('s.*, s.id AS id,c.company_name,
                          SUM(sSub.total_qty) as totalQuantity,');
        $this->db->from('sales_order as s');   
        $this->db->join('sales_order_sub as sSub','s.id = sSub.sales_order_id ','left');      
        $this->db->join('customer as c','c.customer_id = s.sold_to_party', 'left');
        $this->db->order_by('s.id','DESC');  
        $this->db->group_by('sSub.sales_order_id','DESC');
        $query = $this->db->get()->result();
        

        $view_data['sale'] = $query;
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
            $sno = $this->input->post('sno');
            $date = $this->input->post('date');
            $sold_to_party = $this->input->post('sold_to');    
            $ship_to_party = $this->input->post('ship_to');
            
            $po_number = $this->input->post('po_number');  
            $credit_note = $this->input->post('credit_note');  
            $credit_noteYN = $this->input->post('credit_noteYN');  

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
                'sale_no' => $sno,    
                'date' => $date,            
                'po_number' => $po_number,            
                'credit_note' => $credit_note,            
                'credit_noteYN' => $credit_noteYN,            
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


 
            $insert = $this->mcommon->common_insert('sales_order', $insert_array);
            $sales_order_id = $this->db->insert_id();
           
            if( $credit_noteYN==1)
            {

                $this->db->select('*,q.status as qStatus,q.created_on as created');
                $this->db->from('sales_order as q'); 
                $this->db->join('customer as c', 'c.customer_id = q.sold_to_party','left'); 
                $this->db->where('q.id',$sales_order_id);   
                $query = $this->db->get();
                $result= $query->row(); 
                $company= $this->mcommon->specific_row('em_companies', array('id' => 1));
//   echo '<pre>';
//   print_r($result); exit();
                $this->db->select('*');
                $this->db->from('em_companies'); 
                $this->db->where('id',1); 
                $comresult = $this->db->get()->row();
                // print_r($comresult->creditnote_sn_status); exit();
                
                    if ($comresult->creditnote_sn_status == 1) {
                        $cnumber = $comresult->credit_note_starting_number;
                    } else {
                        $creditNoteRecord = $this->mcommon->last_inserid('credit_note');
                        $cnumber = !empty($creditNoteRecord) ? $creditNoteRecord->credit_no : null;
                        $cnumber = $cnumber +1;                   
                    }

               $insert_array = array(
                'user_id' => $this->auth_user_id,   
                'credit_no' => $cnumber,   
                'credit_note_starting_number'=>'C'.$cnumber,                                               
                'customer_id' => $result->customer_id,
                'sales_order_id ' => $result->id,
                'company_id'   => $company['id'],
                'po_number'   =>  $po_number,
                'grand_total' => $result->grand_total,
                'credit_percentage'  => $company['credit_note_percentage'],
                'credit_amount'  => $result->grand_total*($company['credit_note_percentage']/100 ),
                'created_on' => date('Y-m-d'),  
                    
                );
                $this->mcommon->common_insert('credit_note',$insert_array,true);
                $update_com_status = $this->mcommon->common_edit('em_companies',array('creditnote_sn_status'=>0),array('id' =>1));
               
            }
           
            $rowcount = count($product);
           
            for ($i = 0; $i < $rowcount; $i++) 
            {
                $insert_array_new = array(
                    'sales_order_id' => $sales_order_id,
                    'user_id' => $user_id,
                    'product_id'   => $product[$i],
                    'hsn_id' => $hsn_code[$i],
                    'uom_id' => $uom[$i],
                    'total_qty' => $qty[$i],
                    'available_qty' => $qty[$i],
                    'price' => $price[$i],
                    'amount' => $amount[$i],
                    'created_on' => date('Y-m-d'),
                );
                $insert = $this->mcommon->common_insert('sales_order_sub', $insert_array_new);
            }
          

            $update_com_status = $this->mcommon->common_edit('em_companies',array('sales_sn_status'=>0),array('id' =>1));

          $qtyData = $this->getTotalQuantity($sales_order_id);
             $quantity = 0;

             foreach ($qtyData as $qty){
               $quantity += $qty->quantity;
             }

             $update_array_new = array(
                'total_qty'=>$quantity
             );
              
             $update_new = $this->mcommon->common_edit('quotation', $update_array_new,array('id' => $quotation_id));

            if ($update_new > '0') {
                $this->session->set_flashdata('alert_success', 'SaleOrder added successfully!');
                redirect('SalesOrder/view');
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
            
            if ($result->sales_sn_status == 1) {
                $view_data['snumber'] = $result->sales_prefix.$result->sales_starting_number;
            } else {
                $saleOrderRecord = $this->mcommon->last_inserid('sales_order');
                
                preg_match('/^([a-zA-Z]+)(\d+)$/', $saleOrderRecord->sale_no, $matches);
                if (count($matches) === 3) {
                    $prefix = $matches[1];
                    $numericPart = intval($matches[2]);
                
                    // Increment numeric part
                    $newNumericPart = $numericPart + 1;
                
                    // Create the new sale number
                    $newSaleNo = $prefix . $newNumericPart;
                
                    // Use $newSaleNo as needed
                    $view_data['snumber'] =  $newSaleNo;
                } else {
                    // Invalid sale number format
                    $this->session->set_flashdata('alert_danger', 'Please Set Correct Slae Prefix on Company Settings!');
                redirect('SalesOrder/view');
                    echo 'Invalid sale number format';
                }
                // $snum = $saleOrderRecord->sale_no + 1;
                // $view_data['snumber'] = !empty($saleOrderRecord) ? $result->sales_prefix.$snum : null;
            }
           
           
        $data = array(
            'title' => 'Add Sale order',
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

            $credit_note = $this->input->post('credit_note');  
            $credit_noteYN = $this->input->post('credit_noteYN');  
            $date = $this->input->post('date');  
            $po_number = $this->input->post('po_number');  

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

                'credit_note' => $credit_note,               
                'credit_noteYN' => $credit_noteYN,               
                'date' => $date,               
                'po_number' => $po_number,    

                'round_off' => $round_off,    
                'grand_total' => $g_total,    
                'sold_to_party' => $sold_to_party,    
                'ship_to_party' => $ship_to_party,               
                'remarks' => $remarks,    
                'created_on' => date('Y-m-d'),
            );

            $update = $this->mcommon->common_edit('sales_order', $update_array, array('id' => $id));
            

            if($credit_noteYN == 0){
                $cnDelete = $this->mcommon->common_delete('credit_note', array('sales_order_id' => $id));
            }


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
                        'total_qty' => $qty[$i],   
                        'available_qty' => $qty[$i],                        
                        'price' => $price[$i],
                        'amount' => $amount[$i],
                        'created_on' => date('Y-m-d'),
                    );
                    $update = $this->mcommon->common_edit('sales_order_sub', $update_array_new, array('id' => $subId[$i]));
                }else{
                    $insert_array_new = array(
                        
                        'user_id' => $user_id,
                        'sales_order_id' => $id,
                        'product_id'   => $product[$i],
                        'hsn_id' => $hsn_code[$i],
                        'uom_id' => $uom[$i],
                        'total_qty' => $qty[$i],
                        'available_qty' => $qty[$i],                        
                        'price' => $price[$i],
                        'amount' => $amount[$i],
                        'created_on' => date('Y-m-d'),
                    );
                    $insert = $this->mcommon->common_insert('sales_order_sub', $insert_array_new);
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
              
             $update_new = $this->mcommon->common_edit('sales_order', $update_array_new,array('id' => $id));



             $rowcount2 = count($removeid);

             for ($i = 0; $i < $rowcount2; $i++) 
             {
                $delete = $this->mcommon->common_delete('sales_order_sub',array('id' => $removeid[$i]));
   
             }


            if ($update) {
                $this->session->set_flashdata('alert_success', 'SaleOrder updated successfully!');
                redirect('salesOrder/view');
            } else {
                $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
            }

      
        
    }else{
        $view_data['customers'] = $this->mcommon->records_all('customer', array('status' => 1));
        $view_data['products'] = $this->mcommon->records_all('product', array('status' => 1));    
        $view_data['sales_order'] = $this->mcommon->specific_row('sales_order', array('id' => $id));    
        $view_data['uom'] = $this->mcommon->records_all('uom', array('status' => 1)); 
     
            // $this->db->from('quotation'); 
            // $this->db->where('id', $id);
            //  $result = $this->db->get();
            //  return $result->result();
            
                    // qSub.id as qSubId,
                    // qsub.quantity as subQty,
                    // qsub.price as subPrice,
                    // qsub.amount as subAmount,
      

        $this->db->select('sSub.*, h.hsn_name');
        $this->db->from('sales_order_sub as sSub'); 
        $this->db->where('sSub.sales_order_id', $id); 
        $this->db->join('product as p','p.product_id = sSub.product_id','left'); 
        $this->db->join('hsn_code as h', 'h.hsn_id = sSub.hsn_id','left'); 
        $this->db->join('uom as u', 'u.uom_id = sSub.uom_id','left');         
        $query = $this->db->get();
        $view_data['sales'] = $query->result();  
        // echo '<pre>'; print_r($view_data['sales_order']);
        //  die();
        $data = array(
            'title' => 'Edit Sale order',
            'content' => $this->load->view('pages/sales_order/edit', $view_data, true),
        );
        $this->load->view('base/base_template', $data);
    }
    }


    public function invoice_list(){
        $this->db->select('*,s.status as salesStatus,sum(sob.total_qty) as totalQuantity,
                            sum(sob.received_qty) as receivedQuantity,s.grand_total as grand_total');
        $this->db->from('sales_order as s');
        $this->db->join('sales_order_sub as sob','sob.sales_order_id=s.id','left');
        // $this->db->join('product as p','p.product_id = sob.product_id','left');
        $this->db->join('customer as c','c.customer_id = s.sold_to_party','left');
        // $this->db->join('hsn_code as h', 'h.hsn_id = sob.hsn_id','left');
        // $this->db->join('uom as u', 'u.uom_id = sob.uom_id','left');
        $this->db->order_by('s.id','DESC');
        $this->db->group_by('sob.sales_order_id');

        $query = $this->db->get();
        $view_data['salesOrder'] = $query->result();
              
        // echo '<pre>'; print_r($view_data['salesOrder']);
        //  die();

        $data = array(
            'title' => 'Sales Invoice List',
            'content' => $this->load->view('pages/sales_order/invoicelist', $view_data, true),
        );
        $this->load->view('base/base_template', $data);
    }
      
    public function getQuantity($id)
    {
        if (isset($_POST['submit'])) {
        //             echo '<pre>'; print_r($_POST);
        //  die();
           
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
                                'sales_sub_id' => $subId[$i],
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
        
           

            if ($insert > '0') {
                $this->session->set_flashdata('alert_success', 'Sales Order Updated Successfully!');
                redirect('dcController/view');
            } else {
                $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
                redirect('dcController/view');
            }
        }
            else
        {

            $this->db->select('*,sub.id as subId, sub.price as sprice, sub.available_qty as available_qty');
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


        $this->db->from('sales_order_items as si');
        $this->db->where('si.sales_order_id',$id); 
        $this->db->join('sales_order_sub as sub','sub.id = si.sales_sub_id','left'); 
        $this->db->join('product as p','p.product_id = sub.product_id','left'); 
        $this->db->join('hsn_code as h', 'h.hsn_id = sub.hsn_id','left'); 
        $this->db->join('uom as u', 'u.uom_id = sub.uom_id','left'); 
        // $this->db->group_by('si.sales_order_id'); 
        $query = $this->db->get();
        $view_data['salesOrders'] = $query->result(); 

        // echo "<pre>";
        // print_r($view_data['salesOrders']);
        // exit();  

        $this->db->select('*,
        s.status as sStatus,
        s.id as sId');
        $this->db->from('sales_order as s'); 
        $this->db->where('s.id',$id); 
        // $this->db->join('product as p','p.product_id = s.product_id','left'); 
        // $this->db->join('hsn_code as h', 'h.hsn_id = s.hsn_id','left'); 
        // $this->db->join('uom as u', 'u.uom_id = s.uom_id','left'); 
        $view_data['salesOrder'] = $this->db->get()->row_array();

        //                echo "<pre>";
        // print_r($view_data['salesOrder']['sgst']);
        // exit();  

        
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

    public function delete($id)
    {
        $delete = $this->mcommon->common_delete('sales_order', array('id' => $id));
        $delete = $this->mcommon->common_delete('sales_order_sub', array('sales_order_id' => $id));
        return $delete;
    }

    public function getTotalQuantity($sales_order_id){
        // $this->db->select('sum(quantity)'); 
        $this->db->from('sales_order_sub'); 
        $this->db->where('sales_order_id', $sales_order_id);
         $result = $this->db->get();
         return $result->result();
    }

}
