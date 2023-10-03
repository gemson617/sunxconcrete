<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SalesOrder extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->is_logged_in();
        // if($this->auth_level!=9){
        //     redirect('/logout');
        // }
    }
    public function view()
    {
        $this->db->select('*,s.status as salesStatus');
        $this->db->from('sales_order as s'); 
        $this->db->join('product as p','p.product_id = s.product_id','left'); 
        $this->db->join('customer as c','c.customer_id = s.sold_to_party','left'); 
        $this->db->join('hsn_code as h', 'h.hsn_id = s.hsn_id','left'); 
        $this->db->join('uom as u', 'u.uom_id = s.uom_id','left'); 
        $this->db->order_by('s.id','DESC');       
        $query = $this->db->get();
        $view_data['salesOrder'] = $query->result();  
        //         echo "<pre>";
        // print_r($view_data['salesOrder']);
        // exit();       
        $data = array(
            'title' => 'Add Quotation',
            'content' => $this->load->view('pages/sales_order/view', $view_data, true),
        );
        $this->load->view('base/base_template', $data);  
    }

    public function invoice_list(){
        $this->db->select('*,s.status as salesStatus');
        $this->db->from('sales_order as s'); 
        $this->db->join('product as p','p.product_id = s.product_id','left'); 
        $this->db->join('customer as c','c.customer_id = s.sold_to_party','left'); 
        $this->db->join('hsn_code as h', 'h.hsn_id = s.hsn_id','left'); 
        $this->db->join('uom as u', 'u.uom_id = s.uom_id','left'); 
        $this->db->order_by('s.id','DESC');       
        $query = $this->db->get();
        $view_data['salesOrder'] = $query->result();  
        //         echo "<pre>";
        // print_r($view_data['salesOrder']);
        // exit();       
        $data = array(
            'title' => 'Add Quotation',
            'content' => $this->load->view('pages/sales_order/invoicelist', $view_data, true),
        );
        $this->load->view('base/base_template', $data);  
    }
      
    public function getQuantity($id)
    {
        if (isset($_POST['submit'])) {
            $quantity = $this->input->post('qty'); 
            $credit_bill_status = $this->input->post('credit_bill'); 
            
            

            $available_quantity = $this->mcommon->specific_row_value('sales_order', array('id' => $id),'available_quantity');
            $received_quantity = $this->mcommon->specific_row_value('sales_order', array('id' => $id),'received_qty');

            $total_quantity = $this->mcommon->specific_row_value('sales_order', array('id' => $id),'total_quantity');
            $received_quantity_new = $this->mcommon->specific_row_value('sales_order', array('id' => $id),'received_qty');
       
            $quotation_id = $this->mcommon->specific_row_value('sales_order', array('id' => $id),'quotation_id');

            $remaining_quantity = $available_quantity - $quantity;
            $received_quantity = $received_quantity + $quantity;
            
    
            $update_array = array(
                'available_quantity' => $remaining_quantity,               
                'received_qty' => $received_quantity,               
                'status' => 2,               
            );

            $update = $this->mcommon->common_edit('sales_order', $update_array,array('id'=>$id));


            $insert_array = array(
                'sales_order_id'=>$id,
                'quotation_id'=>$quotation_id,
                'total_quantity'=>$total_quantity,
                'available_quantity' => $remaining_quantity,               
                'credit_bill_status' => $credit_bill_status,               
                'received_qty' => $quantity,              
                'created_on' => date('d-m-y'),               
            );
            $insert = $this->mcommon->common_insert('sales_order_items', $insert_array);

            if($received_quantity_new >= $total_quantity){
                $update_array2 = array(
                    'status' => 3,               
                );
    
                $update = $this->mcommon->common_edit('sales_order', $update_array2,array('id'=>$id));
            }

            if ($update > '0') {
                $this->session->set_flashdata('alert_success', 'Sales Order Updated Successfully!');
                redirect('SalesOrder/view');
            } else {
                $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
            }
        }
    }

    
    public function viewSalesItems($id)
    {
        $this->db->select('*,si.total_quantity as totalQuantity,
                            si.available_quantity as availableQuantity,
                            si.received_qty as receivedQuantity');
        $this->db->from('sales_order as s'); 
        $this->db->join('sales_order_items as si','si.sales_order_id = s.id'); 
        $this->db->where('si.sales_order_id',$id); 
        $this->db->join('product as p','p.product_id = s.product_id','left'); 
        $this->db->join('customer as c','c.customer_id = s.sold_to_party','left'); 
        $this->db->join('hsn_code as h', 'h.hsn_id = s.hsn_id','left'); 
        $this->db->join('uom as u', 'u.uom_id = s.uom_id','left'); 
        // $this->db->order_by('si.id','DESC');       
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



    public function invoice($id){

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
           
        // echo "<pre>";
        // print_r($view_data['salesOrder']);
        // exit();       

        $data = array(
            'title' => 'Sales Order Items',
            'content' => $this->load->view('pages/sales_order/itemsInvoice', $view_data, true),
        );
        $this->load->view('base/base_template', $data);  
    }

}
