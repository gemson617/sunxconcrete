<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DcController extends MY_Controller
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
        $view_data['sale'] ['transaction_id'] = [];

        foreach($view_data['sale']  as $key=> $row){

            $this->db->select('*');
            $this->db->from('sales_order_items as s'); 
            $this->db->where('s.sales_order_id',$row->id); 
            $this->db->group_by('s.transaction_id');  
            $query_items = $this->db->get()->result();
            $view_data['sale'][$key]->saless = $query_items;

            // Array to store transaction IDs for each sale
            $transaction_ids = [];

            foreach ($view_data['sale'][$key]->saless as $item_key => $item) {
                $transaction_ids[] = $item->transaction_id;
            }
            // Assign the array of transaction IDs to the sale data
            $view_data['sale'][$key]->transaction_id = $transaction_ids;
        }

        $data = array(
            'title' => 'Sales Orders',
            'content' => $this->load->view('pages/deliveryChallan/view', $view_data, true),
        );
        $this->load->view('base/base_template', $data);  
    }


}