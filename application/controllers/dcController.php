<?php
defined('BASEPATH') or exit('No direct script access allowed');

class dcController extends MY_Controller
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

        //  echo "<pre>";
        //  print_r($view_data['sale']);
        //  exit();




        // $this->db->select('*, c.company_name , si.total_quantity as totalQuantity,
        //                     si.available_quantity as availableQuantity,
        //                     sum(si.received_qty) as receivedQty,
        //                     sum(si.tottalamt) as totalAmount,
        //                     si.transaction_id as transaction_id,
        //                     si.created_on as created_date
        //                     ');
        // $this->db->from('sales_order as s'); 
        // $this->db->join('sales_order_items as si','si.sales_order_id = s.id'); 
        // // $this->db->join('sales_order_sub as sub','sub.sales_order_id = s.id'); 
        // $this->db->where('si.sales_order_id',11); 
        // // $this->db->join('product as p','p.product_id = sub.product_id','left'); 
        // $this->db->join('customer as c','c.customer_id = s.sold_to_party','left'); 
        // $this->db->order_by('si.id','DESC');       
        // $this->db->group_by('si.transaction_id');       
        // $query = $this->db->get();
        // $view_data['salesOrder'] = $query->result();
        // $view_data['id'] = $id;
        
        // echo "<pre>";
        // print_r($view_data['salesOrder']);
        // exit();













        $data = array(
            'title' => 'Sales Orders',
            'content' => $this->load->view('pages/deliveryChallan/view', $view_data, true),
        );
        $this->load->view('base/base_template', $data);  
    }


}