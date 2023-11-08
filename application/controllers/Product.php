<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->is_logged_in();
        
        if($this->auth_level!=9){
            redirect('/logout');
        }
    }
    public function index()
    {
        if ($this->verify_min_level(1)) {
            $view_data['datatable'] = $this->datatable();    
            // echo "<pre>";
            // print_r($view_data['datatable']);
            // exit();
            $data = array(
                'page_title' => 'Product',
                'title' => 'Product',
                'content' => $this->load->view('pages/product/product', $view_data, TRUE),
            );
            $this->load->view('base/base_template', $data);
        } else {
            redirect('login');
        }
    }

    public function datatable()
    {
        $this->db->select('*,p.status as product_status');
        $this->db->from('product as p'); 
        $this->db->join('hsn_code as h', 'h.hsn_id = p.hsn_code'); 
        // $this->db->join('uom as u', 'u.uom_id = p.uom'); 
        $this->db->order_by('p.product_id','DESC');       
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function add()
    {
        if (isset($_POST['submit'])) {
            $product_name = $this->input->post('product_name');    
            $hsn_code = $this->input->post('hsn_code');    
            $uom = $this->input->post('uom');    
            $price = $this->input->post('price');    
            $user_id =$this->auth_user_id;            
            $insert_array = array(
                'product_name' => $product_name,               
                'hsn_code' => $hsn_code,               
                // 'uom' => $uom,               
                'price' => $price,    
                'created_on' => date('Y-m-d'),                
            );
            // echo "<pre>";
            // print_r($insert_array);
            // exit();
            $insert = $this->mcommon->common_insert('product', $insert_array);

            if ($insert > '0') {
                $this->session->set_flashdata('alert_success', 'Product added successfully!');
                redirect('product');
            } else {
                $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
            }
        }
        $view_data['hsn_code'] = $this->mcommon->records_all('hsn_code', array('status' => 1));
        $view_data['uom'] = $this->mcommon->records_all('uom', array('status' => 1));       
        $data = array(
            'title' => 'Add Product',
            'content' => $this->load->view('pages/product/add', $view_data, true),
        );
        $this->load->view('base/base_template', $data);
    }

    public function edit($id)
    {

        if (isset($_POST['submit'])) {
            //Receive Values      
            // print_r('hii');
            // exit();   
            $product_name = $this->input->post('product_name');    
            $hsn_code = $this->input->post('hsn_code');    
            $uom = $this->input->post('uom');    
            $price = $this->input->post('price');
            //prepare update array
            $update_array = array(                
                'product_name' => $product_name,               
                'hsn_code' => $hsn_code,               
                // 'uom' => $uom,               
                'price' => $price,              
            );
            

            //insert values in database
            $update = $this->mcommon->common_edit('product', $update_array, array('product_id' => $id));
            if ($update) {
                $this->session->set_flashdata('alert_success', 'Product updated successfully!');
                redirect('product');
            } else {
                $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
            }
        }

        $view_data['hsn_code'] = $this->mcommon->records_all('hsn_code', array('status' => 1));
        $view_data['uom'] = $this->mcommon->records_all('uom', array('status' => 1));
        // echo '<pre>';
        // print_r( $view_data['hsn_code']);
        // exit();
        $view_data['default'] = $this->mcommon->specific_row('product', array('product_id' => $id));
        $data = array(
            'title' => 'Edit Product',
            'content' => $this->load->view('pages/product/edit', $view_data, true),
        );
        $this->load->view('base/base_template', $data);
    }

    public function delete($id)
    {
        $delete = $this->mcommon->common_delete('product', array('product_id' => $id));
        return $delete;
    }

    public function change_status($id)
    {       
        $current_status = $this->mcommon->specific_row_value('product', array('product_id' => $id), 'status');
        $change_status = ($current_status == 1) ? 0 : 1;      
        $update = $this->mcommon->common_edit('product', array('status' => $change_status), array('product_id' => $id));
        echo json_encode($update);
    }
}