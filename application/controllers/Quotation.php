<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Quotation extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->is_logged_in();
        // if($this->auth_level!=9){
        //     redirect('/logout');
        // }
    }
    public function add()
    {
        if (isset($_POST['submit'])) {
            $product = $this->input->post('product');    
            $hsn_code = $this->input->post('hsn_id');    
            $uom = $this->input->post('uom_id');    
            $price = $this->input->post('price');    
            $quantity = $this->input->post('qty');    
            $amount = $this->input->post('amount');   
           
            $sub_total = $this->input->post('sub_total');    
            $cgst = $this->input->post('cgst');    
            $sgst = $this->input->post('sgst');    
            $total_tax = $this->input->post('total_tax');    
            $round_off = $this->input->post('round_off');    
            $g_total = $this->input->post('g_total');   
       
            $sold_to = $this->input->post('sold_to');    
            $ship_to = $this->input->post('ship_to');    
            $tax_payable = $this->input->post('tax_payable');    
            $place_of_supply = $this->input->post('place_of_supply');    
            $po_no = $this->input->post('po_no');   
            $user_id =$this->auth_user_id;  

            $insert_array = array(
                'user_id' => $user_id,
                'product_id' => $product,               
                'hsn_id' => $hsn_code,               
                'uom_id' => $uom,               
                'price' => $price,    
                'quantity' => $quantity,    
                'amount' => $amount,    
                
                'sub_total' => $sub_total,               
                'cgst' => $cgst,               
                'sgst' => $sgst,               
                'total_tax' => $total_tax,    
                'round_off' => $round_off,    
                'grand_total' => $g_total,    
                'sold_to_party' => $sold_to,    
               
                'ship_to_party' => $ship_to,               
                'tax_payable' => $tax_payable,               
                'place_of_supply' => $place_of_supply,               
                'po_number' => $po_no,    
               
                'created_on' => date('Y-m-d'),
            );
        //      echo "<pre>";
        // print_r($_POST);
        // exit();   
            $insert = $this->mcommon->common_insert('quotation', $insert_array);

            if ($insert > '0') {
                $this->session->set_flashdata('alert_success', 'Quotation added successfully!');
                redirect('Quotation/add');
            } else {
                $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
            }
        }

        $view_data['customers'] = $this->mcommon->records_all('customer', array('status' => 1));
        $view_data['products'] = $this->mcommon->records_all('product', array('status' => 1));    
        // echo "<pre>";
        // print_r($view_data['customers']);
        // exit();   
        $data = array(
            'title' => 'Add Quotation',
            'content' => $this->load->view('pages/quotation/add', $view_data, true),
        );
        $this->load->view('base/base_template', $data);
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

    public function view(){
        $this->db->select('*,q.status as qStatus');
        $this->db->from('quotation as q'); 
        $this->db->join('product as p','p.product_id = q.product_id','left'); 
        $this->db->join('hsn_code as h', 'h.hsn_id = q.hsn_id','left'); 
        $this->db->join('uom as u', 'u.uom_id = q.uom_id','left'); 
        $this->db->order_by('q.id','DESC');       
        $query = $this->db->get();
        $view_data['quotations'] = $query->result();  
        //         echo "<pre>";
        // print_r($view_data['quotations']);
        // exit();       
        $data = array(
            'title' => 'Add Quotation',
            'content' => $this->load->view('pages/quotation/view', $view_data, true),
        );
        $this->load->view('base/base_template', $data);   
    }
    
    public function accept($id)
    {
        if (isset($_POST['submit'])) {
            $q_id = $id;    
            $status = $this->input->post('status');    
              
            $update_array = array(
                'status' => $status,               
            );
            $update = $this->mcommon->common_edit('quotation', $update_array,array('id' => $q_id));


            if($status == 3){

                    $data = $this->get_all_data($id);
                    // echo "<pre>";
                    // foreach ($data as $row) {
                    // print_r($row->total_tax);
                    // }
                    // exit();
                    foreach ($data as $row) {
                        $insert_array = array(
                            'quotation_id' => $id,               
                            'user_id' => $row->user_id,               
                            'product_id' => $row->product_id,  
                            'hsn_id' => $row->hsn_id,  
                            'uom_id' => $row->uom_id,  
                            'total_quantity' => $row->quantity,  
                            'available_quantity' => $row->quantity,  
                            'price' => $row->price,  
                            'amount' => $row->amount,  
                            'sub_total' => $row->sub_total,  
                            'cgst' => $row->cgst,  
                            'sgst' => $row->sgst,  
                            'total_tax' => $row->total_tax,  
                            'round_off' => $row->round_off,  
                            'grand_total' => $row->grand_total,    
                            'sold_to_party' => $row->sold_to_party,  
                            'ship_to_party' => $row->ship_to_party,  
                            'tax_payable' => $row->tax_payable,  
                            'place_of_supply' => $row->place_of_supply,  
                            'po_number' => $row->po_number,  
                            'created_on' => date('y-m-d h:i:s'),               
                        );
                    }
                    $insert = $this->mcommon->common_insert('sales_order', $insert_array);

            }

            // echo "<pre>";
            // print_r($insert_array);
            // exit();
            if ($status == 2) {
                $message = 'Rejected';
            }else{
                $message = 'Accepted';
            }

            if ($update > '0') {

                $this->session->set_flashdata('alert_success', 'Quotation ' .$message. ' Successfully!');
                redirect('Quotation/view');
            } else {
                $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
            }
        }
        // $view_data['hsn_code'] = $this->mcommon->records_all('hsn_code', array('status' => 1));
        // $view_data['uom'] = $this->mcommon->records_all('uom', array('status' => 1));      
        $view_data['id'] = $id; 
        $data = array(
            'title' => 'Add Product',
            'content' => $this->load->view('pages/quotation/acceptQuotation', $view_data, true),
        );
        $this->load->view('base/base_template', $data);
    }

    public function get_all_data($id) {
        $this->db->from('quotation'); 
        $this->db->where('id', $id);
         $result = $this->db->get();
         return $result->result();
    }

  
    public function quotationInvoice($id){
        $this->db->select('*,
        q.status as qStatus,
        q.id as qId');
        $this->db->from('quotation as q'); 
        $this->db->where('q.id',$id); 
        $this->db->join('product as p','p.product_id = q.product_id','left'); 
        $this->db->join('hsn_code as h', 'h.hsn_id = q.hsn_id','left'); 
        $this->db->join('uom as u', 'u.uom_id = q.uom_id','left'); 
        // $this->db->join('states as s', 's.id = c.customer_state','left'); 
        $this->db->order_by('q.id','DESC');       
        $view_data['quotation'] = $this->db->get()->row_array();
        

        $this->db->select('*,s.name as stateName');
        $this->db->from('quotation as q'); 
        $this->db->where('q.id',$id); 
        $this->db->join('customer as c','c.customer_id = q.sold_to_party','left'); 
        $this->db->join('states as s', 's.id = c.customer_state','left');       
        $view_data['sold_to_party'] = $this->db->get()->row_array();

        $this->db->select('*,s.name as stateName');
        $this->db->from('quotation as q'); 
        $this->db->where('q.id',$id); 
        $this->db->join('customer as c','c.customer_id = q.ship_to_party','left');
        $this->db->join('states as s', 's.id = c.customer_state','left');              
        $view_data['ship_to_party'] = $this->db->get()->row_array();
        $view_data['company'] = $this->mcommon->specific_row('em_companies', array('id' => 1));

        // echo "<pre>";
        //     print_r($view_data['company']['company_name']);
        //     exit(); 
        $data = array(
            'title' => 'Quotation',
            'content' => $this->load->view('pages/quotation/invoice', $view_data, true),
        );
        $this->load->view('base/base_template', $data);   
    }

}