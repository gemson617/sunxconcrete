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
        $this->db->select('*,s.*,s.id as id,s.status as salesStatus,  
                            sum(si.received_qty) as received_quantity,
                            sum(si.tottalamt) as received_amount,
                            sum(si.available_quantity) as availableQty, 
                            s.total_qty,
                            s.grand_total,
        ');
        $this->db->from('sales_order as s'); 
        // $this->db->join('sales_order_sub as sub','sub.sales_order_id = s.id','left'); 
        $this->db->join('sales_order_items as si','si.sales_order_id = s.id','left'); 
        $this->db->join('customer as c','c.customer_id = s.sold_to_party','left'); 
        $this->db->order_by('s.id','DESC');       
        $this->db->group_by('si.sales_order_id');       
        $query = $this->db->get();
        

        $this->db->select('*,s.*,s.id as id,s.status as salesStatus,  
        sum(si.received_qty) as received_quantity,
        sum(si.tottalamt) as received_amount,
        sum(si.available_quantity) as availableQty, 
        s.total_qty,
        s.grand_total,');
        $this->db->from('sales_order as s'); 
        $this->db->join('sales_order_items as si','si.sales_order_id = s.id','left'); 
        $this->db->join('customer as c','c.customer_id = s.sold_to_party','left'); 
        $this->db->order_by('s.id','DESC');       
        $this->db->group_by('si.sales_order_id');       
        $query = $this->db->get();
        $result = $query->result();
       
        $itemsArray = array();
    
        foreach($result as $res){
                $this->db->select("*");
                $this->db->from('sales_order_items '); 
                $this->db->where("transaction_id", $res->id);
                $query = $this->db->get();
                $result2 = $query->row();

                foreach($result2 as $res2){
                    $itemsArray[] = array(
                        'transaction_id' => $res2->transaction_id,
                        'sales_order_id' => $res2->sales_order_id,
                    );
            }
        }


        $resultArray = array();


    

        foreach($result as $res){
     
            // print_r($res->id);

        
                $resultArray[] = array(
                    'id' => $res->id,
                    'company_name' => $res->company_name,
                    'sale_no' => $res->sale_no,
                    'quotation_no' => $res->quotation_no,
                    'quotation_id' => $res->quotation_id,
                    'user_id' => $res->user_id,
                    'sub_total' => $res->sub_total,
                    'total_qty' => $res->total_qty,
                    'availableQty' => $res->availableQty,
                    'received_quantity' => $res->received_quantity,
                    'cgst' => $res->cgst,
                    'sgst' => $res->sgst,
                    'total_tax' => $res->total_tax,
                    'received_amount' => $res->received_amount,
                    'grand_total' => $res->grand_total,
                    'status' => $res->status,
                    'sold_to_party' => $res->sold_to_party,
                    'ship_to_party' => $res->ship_to_party,
                    'po_number' => $res->po_number,
                    'created_on' => $res->created_on,
                
                    'itemsTable' => $itemsArray

                    // 'itemsTable' => $itemsArray[] = array(
                    //     'sales_order_id' => $ret->sales_order_id,
                    //     'transaction_id' => $ret->transaction_id,
                    // )
        );
  
     
        }

        


   echo "<pre>";
        print_r($resultArray);

        exit();  

        // foreach($resultArray as $arr){
        //     print_r($arr['po_number']);
        //     echo'<br>';
             
        // }
        // exit(); 

        $view_data['salesOrder'] = $resultArray;  

    





  
        $data = array(
            'title' => 'Sales Orders',
            'content' => $this->load->view('pages/sales_order/view', $view_data, true),
        );
        $this->load->view('base/base_template', $data);  
      
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

            $this->db->select('*,sub.id as subId');
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
