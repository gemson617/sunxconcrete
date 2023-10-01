<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Email_template extends MY_Controller
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
            $view_data['template'] = $this->get_template();

            $data = array(
                'page_title' => 'Email Template',
                'title' => 'Email Template',
                'content' => $this->load->view('pages/email_template', $view_data, TRUE),
            );
            $this->load->view('base/base_template', $data);
        } else {
            redirect('login');
        }
    }

    public function get_template()
    {
        $this->db->select("*");
        $this->db->from("email_template");
        $this->db->where("status", 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_body()
    {
        $id = $this->input->post("id");
        $this->db->select("*");
        $this->db->from("email_template");
        $this->db->where("eid", $id);
        $query = $this->db->get();
        $ret = $query->row();
        $body = $ret->body;
        $id = $ret->eid;
        $array = array(
            'id' => $id,
            'body' => $body,
        );
        echo json_encode($body);
    }

    public function edit()
    {
        if (isset($_POST['submit'])) {
            // print_r($_POST);
            // die();
            //Receive Values
            $template = $this->input->post('template');
            $body = $this->input->post('body');
            $status = $this->input->post('status');
            //Set validation Rules
            $this->form_validation->set_rules('template', 'Template', 'required');
            $this->form_validation->set_rules('body', 'Body', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');
            //check is the validation returns no error
            if ($this->form_validation->run() == true) {

                //prepare update array
                $update_array = array(
                    'body' => $body,
                    'status' => $status,
                );

                //insert values in database
                $update = $this->mcommon->common_edit('email_template', $update_array, array('eid' => $template));

                if ($update) {
                    $this->session->set_flashdata('alert_success', 'Email Template updated successfully!');
                    redirect('Email_template');
                } else {
                    $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
                }
            }
        }

        $view_data['template'] = $this->get_template();

        $data = array(
            'page_title' => 'Email Template',
            'title' => 'Email Template',
            'content' => $this->load->view('pages/email_template', $view_data, TRUE),
        );
        $this->load->view('base/base_template', $data);
    }
}
