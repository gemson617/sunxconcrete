<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Invoice extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->is_logged_in();
       
    }
    public function index()
    {
          
        if (isset($_POST['submit'])) {
            $invoice_status = $this->input->post('invoice_status');          
                    
           
            $view_data['datatable'] = $this->datatable($invoice_status);           
            $view_data['add_option'] = 1;
            $view_data['edit_option'] = 1;
            $view_data['delete_option'] = 1; 
        
            // echo "<pre>";
            // print_r($view_data['record']);
            // exit();
            $data = array(
                'page_title' => 'Invoice Generation',
                'title' => 'Invoice Generation',
                'content' => $this->load->view('pages/invoice/invoice', $view_data, TRUE),
            );
            
            $this->load->view('base/base_template', $data);
        }else {
            if ($this->verify_min_level(1)) {
                $view_data['datatable'] = $this->datatable();
                $view_data['add_option'] = 1;
                $view_data['edit_option'] = 1;
                $view_data['delete_option'] = 1;
                $data = array(
                    'page_title' => 'Invoice Generation',
                    'title' => 'Invoice Generation',
                    'content' => $this->load->view('pages/invoice/invoice', $view_data, TRUE),
                );
                $this->load->view('base/base_template', $data);
            } else {
                redirect('login');
            }
        }
    }

    public function datatable($invoice_status='')
    {
        
        $this->db->select('t.*, c.client_name, s.service_name, CONCAT(u.first_name, " ", u.last_name)as approver,ta.assign_to as assigned');
        $this->db->from('task as t');
        $this->db->join('task_assign as ta', 'ta.task_id = t.task_id', 'left');
        $this->db->join('users as u', 'u.user_id=t.approver');
        $this->db->join('client as c', 'c.client_id=t.client');
        $this->db->join('service as s', 's.service_id=t.service');
        if($invoice_status == 3){
        $this->db->join('invoice as i', 'i.task_id=t.task_id and i.paid=t.invoice_amount');
        }
        if($invoice_status == 1){
            $this->db->where('t.invoice_edit', '0');   
        }
        if($invoice_status == 2){
            $this->db->where('t.invoice_edit', '1');   
            $this->db->where('t.gen_invoice', '1');   
        }
        if($invoice_status == 3){
            $this->db->where('t.invoice_edit', '1');   
            $this->db->where('t.gen_invoice', '1');  
        }
        
        // $this->db->where('t.task_status', '2');
        $this->db->where('t.is_approved', '1');   
        $this->db->where('t.status', '1');     
        $this->db->group_by('t.task_id');
        $query = $this->db->get();
        $result = $query->result();
      
        return $result;
    }

    public function add()
    {
        if (isset($_POST['submit'])) {
        }
        $view_data['service'] = $this->mcommon->records_all('service', array('status' => '1'), 'service_name');
        $view_data['client'] = $this->mcommon->records_all('client', array('status' => '1'), 'client_name');
        $view_data['users'] = $this->mcommon->records_all('users', array('auth_level' => '6'));
        $view_data['approver'] = $this->mcommon->records_all('users', array('auth_level' => '7'));
        $data = array(
            'title' => 'Add invoice',
            'content' => $this->load->view('pages/invoice/add', $view_data, true),
        );
        $this->load->view('base/base_template', $data);
    }

    public function edit($id)
    {
        if (isset($_POST['submit'])) {

            $service_amount = $this->input->post('service_amount');
            $gst = $this->input->post('gst');     
            $gst_percent = $this->input->post('gst_percent');     
            $invoice_amount = $this->input->post('invoice_amount');  
            $client_code = $this->input->post('client_code');
            $client_id =$this->input->post('client_id');   
                 $split_gst = $gst/2; 
            $user_id = $this->auth_user_id;   
            
                $invoice_code = $client_code."/00".$id; 
                $invoice_seq = $this->mcommon->invoie_seq($client_id);
                $in_client_code = $this->mcommon->get_client_code('client',$client_id);
                $get_client_code = $this->mcommon->specific_row_value('client',array('client_id'=>$client_id),'client_code');
            
                foreach($in_client_code as $val){  
                $invoice_client_code = $val->client_code.'/00'.$invoice_seq;
                }
                $update_array = array(
                    'invoice_edit' => 1,
                    'invoice_code' => $invoice_code,
                    'service_amount' => $service_amount,    
                    'gst' => $gst,    
                    'gst_percent' => $gst_percent,    
                    'invoice_amount' => $invoice_amount,   
                    'invoice_seq_code'=>$invoice_seq, 
                    'invoice_client_code'=>$invoice_client_code,
                    // 'updated_by' => $user_id,
                );
                //insert values in database
                $update = $this->mcommon->common_edit('task', $update_array, array('task_id' => $id));
                $invoice_id = $this->mcommon->specific_row_value('invoice', array('task_id' => $id),'invoice_id');
                    if($update && $invoice_id == ""){
                        $insert_array = array(
                            'task_id' => $id,
                            'invoice_code' => $invoice_code,
                            'amount' => $service_amount,
                            'cgst' => $split_gst,
                            'sgst' => $split_gst,
                            'igst' => $gst,
                            'invoice_amount' => $invoice_amount,
                            'created_on' => date('Y-m-d H:i:s'),
                            'created_by' => $user_id,
                            // 'is_billed' => 0,
                            'status' => 1,
                        );
            
                        //insert values in database
                        $insert = $this->mcommon->common_insert('invoice', $insert_array);
                    }

                if ($update && $insert) {
                    $this->session->set_flashdata('alert_success', 'Invoice updated successfully!');
                    redirect('invoice');
                } else {
                    $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
                }
           
        }
        $view_data['get_client'] = $this->mcommon->get_clientid($id);
        $view_data['default'] = $this->mcommon->get_taskDetail($id);
        $view_data['service'] = $this->mcommon->records_all('service');
        // $view_data['client'] = $this->mcommon->records_all('client_master');
        $view_data['users'] = $this->mcommon->records_all('users', array('auth_level' => '6'));
        $data = array(
            'title' => 'Edit invoice',
            'content' => $this->load->view('pages/invoice/edit_invoice', $view_data, true),
        );
        $this->load->view('base/base_template', $data);
    }
    public function edit_invoice_amount($id)
    {
        if (isset($_POST['submit'])) {

            $service_amount = $this->input->post('service_amount');
            $gst = $this->input->post('gst');     
            $gst_percent = $this->input->post('gst_percent');     
            $invoice_amount = $this->input->post('invoice_amount');  
            $client_code = $this->input->post('client_code');
            $client_id =$this->input->post('client_id');   
                 $split_gst = $gst/2; 
            $user_id = $this->auth_user_id;      
            $heck_exist_invoice = $this->mcommon->specific_row_value('invoice',array('task_id'=>$id),'invoice_id');
           
                $update_array = array(
                    'invoice_edit' => 1,                    
                    'service_amount' => $service_amount,    
                    'gst' => $gst,    
                    'gst_percent' => $gst_percent,    
                    'invoice_amount' => $invoice_amount,  
                );
                //insert values in database
                $update = $this->mcommon->common_edit('task', $update_array, array('task_id' => $id));
                $invoice_id = $this->mcommon->specific_row_value('invoice', array('task_id' => $id),'invoice_id');
                   
                        $insert_array = array(
                            'task_id' => $id,                           
                            'amount' => $service_amount,
                            'cgst' => $split_gst,
                            'sgst' => $split_gst,
                            'igst' => $gst,
                            'invoice_amount' => $invoice_amount,
                            'updated_on' => date('Y-m-d H:i:s'),
                            'updated_by' => $user_id,
                            // 'is_billed' => 0,
                            'status' => 1,
                        );
            
                        //insert values in database
                        $insert = $this->mcommon->common_edit('invoice', $insert_array,array('invoice_id' => $invoice_id));                   

                if ($update && $insert) {
                    $this->session->set_flashdata('alert_success', 'Invoice Amount updated successfully!');
                    redirect('invoice');
                } else {
                    $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
                }

           
        }
        $view_data['get_client'] = $this->mcommon->get_clientid($id);
        $view_data['default'] = $this->mcommon->get_taskDetail($id);
        $view_data['service'] = $this->mcommon->records_all('service');
         $view_data['invoice_task'] = $this->mcommon->specific_row('task',array('task_id' => $id));
      
        $view_data['users'] = $this->mcommon->records_all('users', array('auth_level' => '6'));
        $data = array(
            'title' => 'Edit invoice',
            'content' => $this->load->view('pages/invoice/edit_invoice_amount', $view_data, true),
        );
        $this->load->view('base/base_template', $data);
    }

    public function view($id)
    {      
        $get_date = $this->mcommon->specific_row_value('task',array('task_id'=>$id),'invoice_date');
        if($get_date != '' && !empty($get_date) && $get_date != "0000-00-00 00:00:00")
        {
            $invoice_date = $get_date;
        }else{
            $invoice_date = date('Y-m-d H:i:s');
        }
        // print_r($invoice_date);
        // exit();
        // $view_data['task'] = $this->mcommon->get_taskdata($id);
        $update_array = array(                
            'gen_invoice' => 1, 
            'invoice_date' => $invoice_date, 
            // 'invoice_amount' => $invoice_amount, 
        );
        //insert values in database
        $update = $this->mcommon->common_edit('task', $update_array, array('task_id' => $id));
        // $invoice_array = array(                
        //     'task_id' => 1, 
        //     'invoice_date' => $invoice_date, 
        //      'invoice_amount' => $invoice_amount, 
        // );
        // //insert values in database
        // $update = $this->mcommon->common_insert('invoice', $invoice_array);
        if ($update) {
            $view_data['default'] = $this->mcommon->specific_row('task', array('task_id' => $id));
            $client_id = $this->mcommon->specific_row_value('task', array('task_id' => $id),'client');
            $view_data['task'] = $this->mcommon->get_taskdata($id);
            $view_data['client_detail'] = $this->mcommon->records_all('client', array('client_id' => $client_id));
            $view_data['users'] = $this->mcommon->records_all('users', array('auth_level' => '6'));       
            $view_data['get_company'] = $this->mcommon->records_all('em_companies');
            $view_data['invoice_date'] = $this->mcommon->specific_row_value('task', array('task_id' => $id),'invoice_date');
            
            $view_data['invoice_id'] = $id;
            $data = array(
                'title' => 'Invoice',
                'content' => $this->load->view('pages/invoice/print_invoice', $view_data, true),
            );
            $this->load->view('base/base_template', $data);
        } else {
            $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
        }
    }

    public function view_invoice($id)
    {      
        $get_date = $this->mcommon->specific_row_value('task',array('task_id'=>$id),'invoice_date');
        if($get_date != '' && !empty($get_date) && $get_date != "0000-00-00 00:00:00")
        {
            $invoice_date = $get_date;
        }else{
            $invoice_date = date('Y-m-d H:i:s');
        }
        

        $view_data['default'] = $this->mcommon->specific_row('task', array('task_id' => $id));
        $client_id = $this->mcommon->specific_row_value('task', array('task_id' => $id),'client');
        $view_data['task'] = $this->mcommon->get_taskdata($id);
        $view_data['client_detail'] = $this->mcommon->records_all('client', array('client_id' => $client_id));
        $view_data['users'] = $this->mcommon->records_all('users', array('auth_level' => '6'));       
        $view_data['get_company'] = $this->mcommon->records_all('em_companies');
        $view_data['invoice_date'] = $this->mcommon->specific_row_value('task', array('task_id' => $id),'invoice_date');
        $view_data['invoice_id'] = $id;
        $data = array(
            'title' => 'Invoice',
            'content' => $this->load->view('pages/invoice/view_invoice', $view_data, true),
        );
        $this->load->view('base/base_template', $data);
        
    }

    function db_table($name)
    {
        $CI = &get_instance();

        $auth_model = $CI->authentication->auth_model;

        return $CI->$auth_model->db_table($name);
    }

    public function delete($id)
    {
        $delete = $this->mcommon->common_delete('task', array('task_id' => $id));
        return $delete;
    }

    public function change_status($id)
    {
        $current_status = $this->mcommon->specific_row_value('task', array('task_id' => $id), 'status');
        $change_status = ($current_status == 1) ? 0 : 1;
        $update = $this->mcommon->common_edit('task', array('status' => $change_status), array('task_id' => $id));
        echo json_encode($id);
    }

    public function change_task_status($id)
    {
        $change_status = array(            
            'task_status' => 2,               
            'completed_by' => $this->auth_user_id,
            'completed_on' => date('Y-m-d H:i:s'),
            'status' => 1,
        );        
        $update = $this->mcommon->common_edit('task', $change_status, array('task_id' => $id));
        echo json_encode($id);
    }

    public function pay_invoice($id)
    {
        if (isset($_POST['submit'])) {
            // print_r($_POST);
            // exit();
            $task_id = $this->input->post('task_id');
            $payment_date = $this->input->post('payment_date');     
            $bank = $this->input->post('bank');     
            $amount = $this->input->post('amount');  
            $balance = $this->input->post('balance'); 
            $invoice_id = $this->mcommon->specific_row_value('invoice',array('task_id'=>$task_id),"invoice_id");
                 $split_gst = $gst/2; 
            $user_id = $this->auth_user_id;           
            $invoice_code = $client_code."/00".$id; 
            $payment_array = array(
                'invoice_id' => $invoice_id,
                'task_id' => $task_id,
                'payment_date' => $payment_date,    
                'bank' => $bank,    
                'amount' => $amount,    
                'balance' => $balance,    
                'created_by' => $user_id,
            );
            //      echo "<pre>";
            // print_r($payment_array);
            // exit();
            //insert values in database
            $insert = $this->mcommon->common_insert('record_payment', $payment_array);
           if($insert){
            $paid_amount = $this->mcommon->specific_row_value('task',array('task_id'=>$task_id),"paid_amount");
                $pay_amount = $paid_amount + $amount;
                $change_status = array(            
                    'paid_amount' => $pay_amount, 
                    'tbalance' => $balance,  
                );        
                $update = $this->mcommon->common_edit('task', $change_status, array('task_id' => $task_id));

                $invoice_array = array(            
                    'paid' => $pay_amount,  
                    'ibalance' => $balance, 
                );        
                $update = $this->mcommon->common_edit('invoice', $invoice_array, array('invoice_id' => $invoice_id));
           }

            if ($insert) {
                $this->session->set_flashdata('alert_success', 'Receipt updated successfully!');
                redirect('invoice');
            } else {
                $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
            }
        }

        $view_data['default'] = $this->mcommon->get_taskDetail($id);
        $view_data['invoice_id'] = $this->mcommon->specific_row_value('invoice',array('task_id'=>$id),"invoice_id");
        $view_data['service'] = $this->mcommon->records_all('service');
        // $view_data['client'] = $this->mcommon->records_all('client_master');
        $view_data['users'] = $this->mcommon->records_all('users', array('auth_level' => '6'));
       
        $data = array(
            'title' => 'Edit invoice',
            'content' => $this->load->view('pages/invoice/pay_invoice', $view_data, true),
        );
        $this->load->view('base/base_template', $data);
    }

    public function edit_pay_invoice($id)
    {
        if (isset($_POST['submit'])) {
            // print_r($_POST);
            // exit();
            $task_id = $this->input->post('task_id');
            $rp_id = $this->input->post('rp_id');
            $payment_date = $this->input->post('payment_date');     
            $bank = $this->input->post('bank');     
            $amount = $this->input->post('amount');  
            $balance = $this->input->post('balance'); 
            $invoice_id = $this->mcommon->specific_row_value('invoice',array('task_id'=>$task_id),"invoice_id");
            
            
            $split_gst = $gst/2; 
            $user_id = $this->auth_user_id;           
            $invoice_code = $client_code."/00".$id; 
            $payment_array = array(              
                'payment_date' => $payment_date,    
                'bank' => $bank,    
                'amount' => $amount,    
                'balance' => $balance,   
            );
                //      echo "<pre>";
      
            //insert values in database
            $rp_update = $this->mcommon->common_edit('record_payment', $payment_array, array('rp_id' => $rp_id));
            // $insert = $this->mcommon->common_insert('record_payment', $payment_array);
           if($rp_update){
            $paid_amount = $this->mcommon->specific_row_value('task',array('task_id'=>$task_id),"paid_amount");
                $pay_amount = $paid_amount + $amount;
                $change_status = array(            
                    'paid_amount' => $amount, 
                    'tbalance' => $balance,  
                );        
                $update = $this->mcommon->common_edit('task', $change_status, array('task_id' => $task_id));

                $invoice_array = array(            
                    'paid' => $amount,  
                    'ibalance' => $balance, 
                );        
                $invoice_update = $this->mcommon->common_edit('invoice', $invoice_array, array('invoice_id' => $invoice_id));
           }

            if ($rp_update) {
                $this->session->set_flashdata('alert_success', 'Receipt updated successfully!');
                redirect('invoice');
            } else {
                $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
            }
        }

        $view_data['default'] = $this->mcommon->get_taskDetail($id);
        $view_data['invoice_id'] = $this->mcommon->specific_row_value('invoice',array('task_id'=>$id),"invoice_id");
        $view_data['service'] = $this->mcommon->records_all('service');
        // $view_data['client'] = $this->mcommon->records_all('client_master');
        $view_data['users'] = $this->mcommon->records_all('users', array('auth_level' => '6'));
        $view_data['rp_data'] = $this->mcommon->get_rpid($id,$view_data['invoice_id']);
            //   print_r($get_latest_rpid);
            //     exit();
       
        $data = array(
            'title' => 'Edit Paid Invoice',
            'content' => $this->load->view('pages/invoice/pay_invoice_edit', $view_data, true),
        );
        $this->load->view('base/base_template', $data);
    }
}