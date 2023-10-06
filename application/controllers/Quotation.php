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
    public function add()
    {
        if(isset($_POST['submit'])) {
          
      
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



            $product = $this->input->post('product[]');    
            $hsn_code = $this->input->post('hsn_id[]');    
            $uom = $this->input->post('uom_id[]');   
            $qty = $this->input->post('qty[]');   
            $price = $this->input->post('price[]');   
            $amount = $this->input->post('amount[]');  

           

            $insert_array = array(
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
              
            $update_array = array(
                'status' => 3,               
                'po_number' => $poNumber,               
                'credit_note' => $creditNote,               
            );
            $update = $this->mcommon->common_edit('quotation', $update_array,array('id' => $q_id));


            // if($status == 3){

                    $data = $this->get_all_data($id);
                    $datas= $this->get_all_datas($id);

                    // echo "<pre>";
                    // foreach ($data as $row) {
                    // print_r($row->total_tax);
                    // }
                    // exit();


                    foreach ($data as $row) {
                        $insert_array = array(
                            'quotation_id' => $id,               
                            'user_id' => $row->user_id,               
                            
                            'sub_total' => $row->sub_total,  
                            'total_qty' => $row->total_qty,  
                            'cgst' => $row->cgst,  
                            'sgst' => $row->sgst,  
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
// print_r($datas);
// exit();
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




            // }

            // echo "<pre>";
            // print_r($insert_array);
            // exit();

            // if ($status == 2) {
            //     $message = 'Rejected';
            // }else{
            //     $message = 'Accepted';
            // }

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


        // echo "<pre>";
        //     print_r($view_data['quotation_sub']);
        //     exit(); 

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

        $data = array(
            'title' => 'Quotation',
            'content' => $this->load->view('pages/quotation/invoice', $view_data, true),
        );
        $this->load->view('base/base_template', $data);   
    }



    public function edit($id){

        if (isset($_POST['submit'])) {
           

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

         
            //     for ($i = 0; $i < $rowcount; $i++) 
            //     {
                  
            //     }
            // }


            $qtyData = $this->getTotalQuantity($id);
             $quantity = 0;

             foreach ($qtyData as $qty){
               $quantity += $qty->quantity;
             }

             $update_array_new = array(
                'total_qty'=>$quantity
             );
              
             $update_new = $this->mcommon->common_edit('quotation', $update_array_new,array('id' => $id));

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
        
        //         echo "<pre>";
        // print_r($view_data['quotations']);
        // exit();   

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