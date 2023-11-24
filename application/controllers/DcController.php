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
                          SUM(sSub.total_qty) as totalQuantity,SUM(sSub.received_qty) as receivedQuantity, SUM(sSub.available_qty) as availableQuantity');
        $this->db->from('sales_order as s');   
        $this->db->join('sales_order_sub as sSub','s.id = sSub.sales_order_id ','left');      
        $this->db->join('customer as c','c.customer_id = s.sold_to_party', 'left');
        $this->db->order_by('s.id','DESC');  
        $this->db->group_by('sSub.sales_order_id','DESC');
        $query = $this->db->get()->result();
        $view_data['sale'] = $query;
        $view_data['sale'] ['transaction_id'] = [];

        foreach($view_data['sale']  as $key=> $row){

            $this->db->select('*, SUM(s.received_qty) as totalInvoiceQuantity, SUM(s.tottalamt) as tottalInvoiceAmt');
            $this->db->from('sales_order_items as s'); 
            $this->db->where('s.sales_order_id',$row->id); 
            $this->db->group_by('s.transaction_id');  
            $query_items = $this->db->get()->result();
            $view_data['sale'][$key]->saleOrderItems = $query_items;

            // Array to store transaction IDs for each sale
            $transaction_ids = [];

            foreach ($view_data['sale'][$key]->saleOrderItems as $item_key => $item) {
                $transaction_ids[] = $item->transaction_id;
            }
            // Assign the array of transaction IDs to the sale data
            $view_data['sale'][$key]->transaction_id = $transaction_ids;
        }

        // echo "<pre>";
        // print_r($view_data['sale']);
        // exit();

        $data = array(
            'title' => 'Sales Orders',
            'content' => $this->load->view('pages/deliveryChallan/view', $view_data, true),
        );
        $this->load->view('base/base_template', $data);  
    }

    public function creditNote()
    {
       $transaction_id  = $this->input->post("transactionid");
       $tottalAmt  = $this->input->post("tottalamount");
       $creditPer  = $this->input->post("creditNote");

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
        'transaction_id' => $transaction_id,
        'company_id'   => 1,
        //'po_number'   =>  $poNumber,
        'grand_total' => $tottalAmt,
        'credit_percentage'  => $creditPer,
        'credit_amount'  => $tottalAmt * ($creditPer/100),            
        );
        $this->mcommon->common_insert('credit_note',$insert_array,true);
        $update_com_status = $this->mcommon->common_edit('em_companies',array('creditnote_sn_status'=>0),array('id' =>1));
    }
}