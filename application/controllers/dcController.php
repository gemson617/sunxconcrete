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

        $data = array(
            'title' => 'Sales Orders',
            'content' => $this->load->view('pages/deliveryChallan/view', $view_data, true),
        );
        $this->load->view('base/base_template', $data);  
    }


}