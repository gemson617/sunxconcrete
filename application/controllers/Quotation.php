<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Quotation extends MY_Controller
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
        $this->db->select('*,cn.status as qStatus,cn.created_on as created');
        $this->db->from('credit_note as cn'); 
        $this->db->join('customer as c', 'c.customer_id = cn.customer_id','left'); 
        $this->db->order_by('cn.id','DESC');       
        $query = $this->db->get();
        $view_data['credit_note'] = $query->result();  
        
        $data = array(
            'title' => 'View Credit Note',
            'content' => $this->load->view('pages/credit_note/view_credit_note', $view_data, true),
        );
        $this->load->view('base/base_template', $data);

    }

    public function creditInvoice($id){
       
        // echo "<pre>";
        //     print_r($view_data['quotation_sub']);
        //     exit(); 

        // $this->db->select('*,cn.status as qStatus,cn.created_on as created');
        // $this->db->from('credit_note as cn'); 
        // $this->db->join('customer as c', 'c.customer_id = cn.customer_id','left'); 
        // $this->db->join('states as s', 's.id = c.customer_state','left'); 
        // $this->db->where('cn.id',$id);       
        // $query = $this->db->get();
        // $view_data['result'] = $query->row();


        $this->db->select('*,state.name as stateName');
        $this->db->from('credit_note as cn'); 
        $this->db->where('cn.id',$id); 
        $this->db->join('sales_order as s','s.quotation_id = cn.quotation_id','left'); 
        $this->db->join('customer as c','c.customer_id = cn.customer_id','left'); 
        $this->db->join('states as state', 'state.id = c.customer_state','left');       
        $view_data['result'] = $this->db->get()->row_array();
       
        $this->db->select('*');
        $this->db->from('credit_note as cn'); 
        $this->db->where('cn.id',$id); 
        $this->db->join('sales_order as s','s.quotation_id = cn.quotation_id','left'); 
        $this->db->join('sales_order_items as si','si.sales_order_id = s.id','left'); 
        $this->db->join('product as p','p.product_id = si.product_id','left');
        $query = $this->db->get();
        $view_data['products'] = $query->result();

        // echo '<pre>';
        // print_r($view_data['products']);
        //      exit(); 

        $view_data['credit_note']= $this->mcommon->specific_row('credit_note',array('id',$id));
        $data = array(
            'title' => 'Credit Invoice',
            'content' => $this->load->view('pages/credit_note/creditNote', $view_data, true),
        );
        $this->load->view('base/base_template', $data);   
    }





    public function add()
    {
        if(isset($_POST['submit'])) {
          
      
            $user_id =$this->auth_user_id; 
            $qno = $this->input->post('qno');
            $sold_to_party = $this->input->post('sold_to');    
            $ship_to_party = $this->input->post('ship_to');  
            $remarks = $this->input->post('remarks');  
            $cgst = $this->input->post('cgst');    
            $sgst = $this->input->post('sgst');    
            $igst = $this->input->post('igst');    
            $total_tax = $this->input->post('total_tax');    
            $round_off = $this->input->post('round_off');    
            $g_total = $this->input->post('g_total');  
            $sub_total = $this->input->post('sub_total');  



            $product = $this->input->post('product[]');    
            $hsn_code = $this->input->post('hsn_id[]');    
            $uom = $this->input->post('uom_id[]');   
            $qty = $this->input->post('qty[]');   
            $price = $this->input->post('price[]');   
            $amount = $this->input->post('amount[]');  

           

            $insert_array = array(
                'user_id' => $user_id,  
                'quotation_no' => $qno,                
                'sub_total' => $sub_total,               
                'cgst' => $cgst,
                'sgst' => $sgst,
                'igst' => $igst,
                'total_tax' => $total_tax,
                'round_off' => $round_off,    
                'grand_total' => $g_total,    
                'sold_to_party' => $sold_to_party,    
                'ship_to_party' => $ship_to_party,               
                'remarks' => $remarks,               
               
                'created_on' => date('Y-m-d h:i:s'),
            );


 
            $insert = $this->mcommon->common_insert('quotation', $insert_array);
            $quotation_id = $this->db->insert_id();
           
           
           
            $rowcount = count($product);
           
            for ($i = 0; $i < $rowcount; $i++) 
            {
                $insert_array_new = array(
                    'quotation_id' => $quotation_id,
                    'user_id' => $user_id,
                    'product_id'   => $product[$i],
                    'hsn_id' => $hsn_code[$i],
                    'uom_id' => $uom[$i],
                    'quantity' => $qty[$i],
                    'price' => $price[$i],
                    'amount' => $amount[$i],
                    'created_on' => date('Y-m-d'),
                );
                $insert = $this->mcommon->common_insert('quotation_sub', $insert_array_new);
            }
          

            $update_com_status = $this->mcommon->common_edit('em_companies',array('quotation_sn_status'=>0),array('id' =>1));

          $qtyData = $this->getTotalQuantity($quotation_id);
             $quantity = 0;

             foreach ($qtyData as $qty){
               $quantity += $qty->quantity;
             }

             $update_array_new = array(
                'total_qty'=>$quantity
             );
              
             $update_new = $this->mcommon->common_edit('quotation', $update_array_new,array('id' => $quotation_id));

            if ($update_new > '0') {
                $this->session->set_flashdata('alert_success', 'Quotation added successfully!');
                redirect('Quotation/add');
            } else {
                $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
            }
        }

        $view_data['customers'] = $this->mcommon->records_all('customer', array('status' => 1));
        $view_data['products'] = $this->mcommon->records_all('product', array('status' => 1));    
        // $view_data['qno'] = $this->mcommon->records_all('em_companies', array('id' => 1))->row();
        $this->db->select('*');
        $this->db->from('em_companies'); 
        $this->db->where('id',1); 
        $result = $this->db->get()->row();
        // print_r($result); exit();
        
            if ($result->quotation_sn_status == 1) {
                $view_data['qnumber'] = $result->quotation_starting_number;
            } else {
                $quotationRecord = $this->mcommon->last_inserid('quotation');
                $view_data['qnumber'] = !empty($quotationRecord) ? $quotationRecord->quotation_no : null;
            }
       
        $data = array(
            'title' => 'Add Quotation',
            'content' => $this->load->view('pages/quotation/add', $view_data, true),
        );
        $this->load->view('base/base_template', $data);
    }

    public function getTotalQuantity($quotation_id){
        // $this->db->select('sum(quantity)'); 
        $this->db->from('quotation_sub'); 
        $this->db->where('quotation_id', $quotation_id);
         $result = $this->db->get();
         return $result->result();
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
        $this->db->select('*,q.status as qStatus,q.created_on as created,
                SUM(qSub.quantity) as totalQuantity,
                q.grand_total as gtotal,
                q.id as id');
        $this->db->from('quotation as q'); 
        $this->db->join('quotation_sub as qSub','q.id = qSub.quotation_id ','left'); 
        $this->db->join('customer as c', 'c.customer_id = q.sold_to_party','left'); 
        $this->db->order_by('q.id','DESC');       
        $this->db->group_by('qSub.quotation_id','DESC');       
        $query = $this->db->get();
        $view_data['quotations'] = $query->result();  
        
        //         echo "<pre>";
        // print_r($view_data['quotations']);
        // exit();      

        $data = array(
            'title' => 'View Quotation',
            'content' => $this->load->view('pages/quotation/view', $view_data, true),
        );
        $this->load->view('base/base_template', $data);   
    }

    public function credit_note_view(){
        $this->db->select('*,q.status as qStatus,q.created_on as created');
        $this->db->from('quotation as q'); 
        // $this->db->join('quotation_sub as qSub','q.id = qSub.quotation_id ','left'); 
        // $this->db->join('hsn_code as h', 'h.hsn_id = q.hsn_id','left'); 
        // $this->db->join('uom as u', 'u.uom_id = q.uom_id','left'); 
        $this->db->join('customer as c', 'c.customer_id = q.sold_to_party','left'); 
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
            // print_r($_POST);
            // exit();
            $q_id = $id;    
            $poNumber = $this->input->post('poNumber');    
            $creditNote = $this->input->post('creditNote');    
            if( $creditNote==1)
            {

                $this->db->select('*,q.status as qStatus,q.created_on as created');
                $this->db->from('quotation as q'); 
                $this->db->join('customer as c', 'c.customer_id = q.sold_to_party','left'); 
                $this->db->where('q.id',$q_id);   
                $query = $this->db->get();
                $result= $query->row(); 
                $company= $this->mcommon->specific_row('em_companies', array('id' => 1));
//   echo '<pre>';
//   print_r($result); exit();
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
                'quotation_id ' => $result->id,
                'company_id'   => $company['id'],
                'po_number'   =>  $poNumber,
                'grand_total' => $result->grand_total,
                'credit_percentage'  => $company['credit_note_percentage'],
                'credit_amount'  => $result->grand_total*($company['credit_note_percentage']/100 ),
                    
                );
                $this->mcommon->common_insert('credit_note',$insert_array,true);
                $update_com_status = $this->mcommon->common_edit('em_companies',array('creditnote_sn_status'=>0),array('id' =>1));
               
            }
              
            $update_array = array(
                'status' => 3,               
                'po_number' => $poNumber,               
                'credit_note' => $creditNote,               
            );
            $update = $this->mcommon->common_edit('quotation', $update_array,array('id' => $q_id));



                    $data = $this->get_all_data($id);
                    $datas= $this->get_all_datas($id);

                    $this->db->select('*');
                    $this->db->from('em_companies'); 
                    $this->db->where('id',1); 
                    $result = $this->db->get()->row();
                
                    if ($result->sales_sn_status == 1) {
                        $snumber = $result->sales_starting_number;
                    } else {
                        $saleOrderRecord = $this->mcommon->last_inserid('sales_order');
                        $snumber = !empty($saleOrderRecord) ? $saleOrderRecord->sale_no : null;
                    }


                    foreach ($data as $row) {
                        $insert_array = array(
                            'user_id' => $row->user_id, 
                            'quotation_id' => $id, 
                            'sale_no' => $snumber,
                            'quotation_no' => $row->quotation_no,               
                            
                            'sub_total' => $row->sub_total,  
                            'total_qty' => $row->total_qty,  
                            'cgst' => $row->cgst,  
                            'sgst' => $row->sgst,  
                            'igst' => $row->igst,  
                            'total_tax' => $row->total_tax,  
                            'round_off' => $row->round_off,  
                            'grand_total' => $row->grand_total,    
                            'sold_to_party' => $row->sold_to_party,  
                            'ship_to_party' => $row->ship_to_party,  
                          
                            'po_number' => $row->po_number,  
                            'created_on' => date('y-m-d h:i:s'),               
                        );
                    }


                    $insert = $this->mcommon->common_insert('sales_order', $insert_array);
                    $last_insert_id = $this->db->insert_id();
                    $update_com_status = $this->mcommon->common_edit('em_companies',array('sales_sn_status'=>0),array('id' =>1));


                    foreach($datas as $data2){
                        $insert_array_new=array(                            
                            'quotation_id' => $data2->quotation_id,
                            'sales_order_id' => $last_insert_id,
                            'user_id' => $data2->user_id,
                            'product_id'   => $data2->product_id,
                            'hsn_id' => $data2->hsn_id,
                            'uom_id' => $data2->uom_id,
                            'total_qty' => $data2->quantity,
                            'available_qty' => $data2->quantity,
                            'price' =>$data2->price,
                            'amount' => $data2->amount,
                            'created_on' => date('Y-m-d'),
                        );
                        $insert = $this->mcommon->common_insert('sales_order_sub', $insert_array_new);
                    }




            if ($update > '0') {

                $this->session->set_flashdata('alert_success', 'Quotation Accepted Successfully!');
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
    public function get_all_datas($id) {
        $this->db->from('quotation_sub'); 
        $this->db->where('quotation_id', $id);
        // $this->db->join('sales_or', $id);|
         $result = $this->db->get();
         return $result->result();
    }

  
    public function quotationInvoice($id){
       
        $this->db->select('*,
                        q.status as qStatus,
                        q.id as qId');
        $this->db->from('quotation as q'); 
        $this->db->where('q.id',$id); 
        $this->db->order_by('q.id','DESC');       
        $view_data['quotation'] = $this->db->get()->row_array();
        

        $this->db->select('*,
        qSub.id as qSubId,
        qSub.quantity as subQty,
        qSub.price as subPrice,
        qSub.amount as subAmount,');
        $this->db->from('quotation_sub as qSub'); 
        $this->db->where('qSub.quotation_id', $id); 
        $this->db->join('product as p','p.product_id = qSub.product_id','left'); 
        $this->db->join('hsn_code as h', 'h.hsn_id = qSub.hsn_id','left'); 
        $this->db->join('uom as u', 'u.uom_id = qSub.uom_id','left'); 
        $this->db->order_by('qSub.id','DESC');     
        $result = $this->db->get();
        $view_data['quotation_sub'] = $result->result();



        $this->db->select('*,s.name as stateName');
        $this->db->from('quotation as q'); 
        $this->db->where('q.id',$id); 
        $this->db->join('customer as c','c.customer_id = q.sold_to_party','left'); 
        $this->db->join('states as s', 's.id = c.customer_state','left');       
        $view_data['sold_to_party'] = $this->db->get()->row_array();

        // echo "<pre>";
        //     print_r($view_data['sold_to_party']);
        //     exit(); 
        $this->db->select('*,s.name as stateName');
        $this->db->from('quotation as q'); 
        $this->db->where('q.id',$id); 
        $this->db->join('customer as c','c.customer_id = q.ship_to_party','left');
        $this->db->join('states as s', 's.id = c.customer_state','left');              
        $view_data['ship_to_party'] = $this->db->get()->row_array();
        $view_data['company'] = $this->mcommon->specific_row('em_companies', array('id' => 1));

        $data = array(
            'title' => 'Quotation',
            'content' => $this->load->view('pages/quotation/invoice', $view_data, true),
        );
        $this->load->view('base/base_template', $data);   
    }



    public function edit($id){

        if (isset($_POST['submit'])) {
           
            $removeid = $this->input->post('removeid');    
           


            $user_id =$this->auth_user_id; 
            $sold_to_party = $this->input->post('sold_to');    
            $ship_to_party = $this->input->post('ship_to');  
            $remarks = $this->input->post('remarks');  
            $cgst = $this->input->post('cgst');    
            $sgst = $this->input->post('sgst');    
            $total_tax = $this->input->post('total_tax');    
            $round_off = $this->input->post('round_off');    
            $g_total = $this->input->post('g_total');  
            $sub_total = $this->input->post('sub_total');  



            $product = $this->input->post('product');    
            $hsn_code = $this->input->post('hsn_id');    
            $uom = $this->input->post('uom_id');   
            $qty = $this->input->post('qty');   
            $price = $this->input->post('price');   
            $amount = $this->input->post('amount');  
            $subId =  $this->input->post('primary_id'); 

        //  print_r($this->input->post('qty'));
        //  exit();


            $update_array = array(

                'user_id' => $user_id,    
                
                'sub_total' => $sub_total,               
                'cgst' => $cgst,               
                'sgst' => $sgst,               
                'total_tax' => $total_tax,    
                'round_off' => $round_off,    
                'grand_total' => $g_total,    
                'sold_to_party' => $sold_to_party,    
                'ship_to_party' => $ship_to_party,               
                'remarks' => $remarks,    
                'created_on' => date('Y-m-d'),
            );

            $update = $this->mcommon->common_edit('quotation', $update_array, array('id' => $id));
            
            $rowcount = count($product);

           
            
                for ($i = 0; $i < $rowcount; $i++) 
                {

                    if($subId[$i] != '')
                    {
                    $update_array_new = array(
                        
                        'user_id' => $user_id,
                        'product_id'   => $product[$i],
                        'hsn_id' => $hsn_code[$i],
                        'uom_id' => $uom[$i],
                        'quantity' => $qty[$i],                        
                        'price' => $price[$i],
                        'amount' => $amount[$i],
                        'created_on' => date('Y-m-d'),
                    );
                    $update = $this->mcommon->common_edit('quotation_sub', $update_array_new, array('id' => $subId[$i]));
                }else{
                    $insert_array_new = array(
                        
                        'user_id' => $user_id,
                        'quotation_id' => $id,
                        'product_id'   => $product[$i],
                        'hsn_id' => $hsn_code[$i],
                        'uom_id' => $uom[$i],
                        'quantity' => $qty[$i],
                        'price' => $price[$i],
                        'amount' => $amount[$i],
                        'created_on' => date('Y-m-d'),
                    );
                    $insert = $this->mcommon->common_insert('quotation_sub', $insert_array_new);
                }
            }

 
            $qtyData = $this->getTotalQuantity($id);
             $quantity = 0;

             foreach ($qtyData as $qty){
               $quantity += $qty->quantity;
             }

             $update_array_new = array(
                'total_qty'=>$quantity
             );
              
             $update_new = $this->mcommon->common_edit('quotation', $update_array_new,array('id' => $id));



             $rowcount2 = count($removeid);

             for ($i = 0; $i < $rowcount2; $i++) 
             {
                $delete = $this->mcommon->common_delete('quotation_sub',array('id' => $removeid[$i]));
   
             }


            if ($update) {
                $this->session->set_flashdata('alert_success', 'Quotation updated successfully!');
                redirect('Quotation/view');
            } else {
                $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
            }

      
        
    }else{
        $view_data['customers'] = $this->mcommon->records_all('customer', array('status' => 1));
        $view_data['products'] = $this->mcommon->records_all('product', array('status' => 1));    
        $view_data['quotation'] = $this->mcommon->specific_row('quotation', array('id' => $id));    
      
     
            // $this->db->from('quotation'); 
            // $this->db->where('id', $id);
            //  $result = $this->db->get();
            //  return $result->result();
            
                    // qSub.id as qSubId,
                    // qsub.quantity as subQty,
                    // qsub.price as subPrice,
                    // qsub.amount as subAmount,
      

        $this->db->select('*,
                            qSub.id as qSubId,
                            qSub.quantity as subQty,
                            qSub.price as subPrice,
                            qSub.amount as subAmount,');
        $this->db->from('quotation_sub as qSub'); 
        $this->db->where('qSub.quotation_id', $id); 
        $this->db->join('product as p','p.product_id = qSub.product_id','left'); 
        $this->db->join('hsn_code as h', 'h.hsn_id = qSub.hsn_id','left'); 
        $this->db->join('uom as u', 'u.uom_id = qSub.uom_id','left'); 
        $this->db->order_by('qSub.id','DESC');       
        $query = $this->db->get();
        $view_data['quotations'] = $query->result();  
        
        $data = array(
            'title' => 'Edit Quotation',
            'content' => $this->load->view('pages/quotation/edit', $view_data, true),
        );
        $this->load->view('base/base_template', $data);
    }
    }

    public function delete($id)
    {
        $delete = $this->mcommon->common_delete('quotation', array('id' => $id));
        return $delete;
    }
}