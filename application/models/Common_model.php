<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Common_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * [record_counts description]
     * @param  [type] $user_id [users id]
     * @return [INT]   user's id [description]
     * @author Ganesh Ananthan
     */

    public function record_counts($table)
    {
        $this->db->select('*');
        $this->db->from($table);
        $num_results = $this->db->count_all_results();
        return $num_results;
    }

    public function specific_record_counts($table, $constraint_array)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($constraint_array);
        $num_results = $this->db->count_all_results();
        return $num_results;
    }

    public function specific_record_counts_other($table, $constraint_array)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($constraint_array);
        $num_results = $this->db->count_all_results();
        return $num_results;
    }

    public function specific_row($table, $constraint_array = '')
    {
        $this->db->select('*');
        $this->db->from($table);
        if (!empty($constraint_array)) {
            $this->db->where($constraint_array);
        }
        $result = $this->db->get()->row_array();
        return $result;
    }

    public function specific_row_value($table, $constraint_array = '', $get_field)
    {
        $this->db->select($get_field);
        $this->db->from($table);
        if (!empty($constraint_array)) {
            $this->db->where($constraint_array);
        }
        $result = $this->db->get()->row_array();
        return $result[$get_field];
    }

    public function records_all($table, $constraint_array = '', $field='',$order_by = '')
    {
        $this->db->from($table);
        if (!empty($constraint_array)) {
            $this->db->where($constraint_array);
        }
        if (!empty($order_by)) {
            $this->db->order_by($field,$order_by);
        }
        $results = $this->db->get()->result();
        return $results;
    }

    public function specific_fields_records_all($table, $constraint_array = '', $get_field_array = '')
    {
        if (!empty($get_field_array)) {
            $this->db->select($get_field_array);
        } else {
            $this->db->select('*');
        }
        $this->db->from($table);
        if (!empty($constraint_array)) {
            $this->db->where($constraint_array);
        }
        $results = $this->db->get()->result_array()();
        return $results;
    }

    public function common_insert($table, $data)
    {
        $this->db->insert($table, $data);
        $result = $this->db->insert_id();
        return $result;
    }

    public function common_edit($table, $data, $where_array)
    {
        $this->db->trans_start();
        $this->db->update($table, $data, $where_array);
        $this->db->trans_complete();
        if ($this->db->affected_rows() == '1') {
            return true;
        } else {
            if ($this->db->trans_status() === false) {
                return false;
            }
            return true;
        }
    }

    public function common_delete($table, $where_array)
    {
        $this->db->delete($table, $where_array);
        if ($this->db->affected_rows() == '1') {
            return true;
        } else {
            return false;
        }
    }

    public function in_array_rec($needle, $haystack, $strict = false)
    {
        foreach ($haystack as $item) {
            if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && $this->in_array_rec($needle, $item, $strict))) {
                return true;
            }
        }
        return 0;
    }

    public function last_record($table, $pm_key, $date_column)
    {
        $query = $this->db->query("SELECT * FROM $table ORDER BY $pm_key DESC LIMIT 1");
        $result = $query->result_array();
        return $result;
    }

    public function last_inserid($table)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by('id', 'desc');
        $this->db->limit('1');
        $result = $this->db->get()->row();
        return $result;
    }

    

    public function common_table_last_updated($table, $pm_key, $date_column)
    {
        $this->db->select($date_column);
        $this->db->from($table);
        $this->db->order_by($pm_key, 'desc');
        $this->db->limit('1');
        $result = $this->db->get()->row_array();
        return $this->time_elapsed_string($result[$date_column]);
    }

    public function time_elapsed_string($datetime, $full = false)
    {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) {
            $string = array_slice($string, 0, 1);
        }

        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

    public function clean_url($string)
    {
        $url = strtolower($string);
        $url = str_replace(array("'", '"'), '', $url);
        $url = str_replace(array(' ', '+', '!', '&', '-', '/', '.'), '-', $url);
        $url = str_replace("?", "", $url);
        $url = str_replace("---", "-", $url);
        $url = str_replace("--", "-", $url);
        return $url;
    }

    public function sendEmailWithTemplate($email_array)
    {
        $this->load->library('email');
        $this->email->set_newline("\r\n");

        $from_email_address = $this->dbvars->app_email;
        $from_email_name = $this->dbvars->app_name;
        $to_email_address = $email_array['to_email'];
        $email_subject = $email_array['subject'];
        $email_message = $email_array['message'];

        // Set to, from, message, etc.
        $this->email->from($from_email_address, $from_email_name);
        $this->email->to($to_email_address);
        $this->email->subject($email_subject);
        $this->email->message($email_message);
        $this->email->send();

        if (isset($email_array['cc'])) {
            $email_cc = $email_array['cc'];
            $this->email->cc($email_cc);
        }
        if (isset($email_array['bcc'])) {
            $email_bcc = $email_array['bcc'];
            $this->email->cc($email_bcc);
        }

        echo $this->email->print_debugger();
        $result = $this->email->send();
    }
    //  Dropdown Menu Simple
    /**
     * @param $get_field - mention only two params like KEY & VALUE
    - If you want CONCAT two or more fields in the Key OR Value section. pass like that
    - array( CONCAT(user_firstname, '.', user_surname) AS Key, fieldName as Value)
     */
    public function Dropdown($table, $get_field, $constraint_array = '', $groupBy = '', $orderby = '', $limit = '', $optionType = '', $joinArr = '')
    {

        $this->db->select($get_field);

        $this->db->from($table);
        if (!empty($constraint_array)) {
            $this->db->where($constraint_array);
        }

        if ($groupBy != '') {
            $this->db->group_by($groupBy);
        }

        if (!empty($orderby)) {
            $this->db->order_by($orderby);
        }

        if ($limit != '') {
            $this->db->limit($limit);
        }
        if (!empty($constraint_array)) {
            foreach ($joinArr as $tableName => $condition) {
                $this->db->join($tableName, $condition, '=');
            }
        }

        $results = $this->db->get()->result();

        $options = array();

        if ($optionType == '') {
            $options[''] = "-- Select --";
        }

        foreach ($results as $item) {
            $options[$item->Key] = $item->Value;

        }
        return $options;
    }

    public function dataUpdate($table, $field, $where, $trans_set = '')
    {
        $this->db->set("$field", "$field+1", false);
        if ($where != '') {
            $this->db->where($where);
        }
        if ($trans_set != '') {
            foreach ($trans_set as $row => $val) {
                $val_array[] = $val;

            }
            $this->db->where_in('naming_series_id', $val_array);
        }
        $this->db->update($table);
        return $result = $this->db->affected_rows();
    }

    public function validate_vendor($table, $vendor_id)
    {
        $this->db->where('vendor_id', $vendor_id);
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            $result = 1;
            return $result;
        } else {
            $result = 2;
            return $result;
        }
    }

    // Generate Naming Series
    public function generateSeries($naming, $transaction_id)
    {
        //This can be deleted after changing naming series to array form
        $naming_avoid = $naming;
        if (!is_array($naming)) {
            $naming = array('0' => $naming);
        }
        //End of delete
        foreach ($naming as $key) {
            $naminglist[$key] = explode('_', $key);
        }
        foreach ($naminglist as $row => $val) {
            $namingtest1[$row] = $val[0];
            $namingtest2[$row] = $val[1];
        }
        foreach ($namingtest1 as $row => $val) {
            $const_array = array(
                'naming_series_id' => $val,
                'transaction_id' => $transaction_id,
            );
            $currentValue = $this->specific_row_value('set_naming_series', $const_array, 'current_value');
            $prefixLength = $this->specific_row_value('set_naming_series', $const_array, 'prefix_id');
            $result[$row] = $namingtest2[$row] . '/' . str_pad($currentValue, $prefixLength, 0, STR_PAD_LEFT);

        }
        //This can be deleted after changing naming series to array form
        if (!is_array($naming_avoid)) {
            foreach ($result as $key => $value) {
                $inter = $value;
            }
            return $inter;
        }
        //End of delete
        return $result;
    }

    public function join_records_all($fields, $table, $joinArr, $constraint_array = '', $groupBy = '', $orderby = '', $limitValue = '', $distinct = '')
    {
        $this->db->select(implode(',', $fields), false);
        $this->db->from($table);
        foreach ($joinArr as $tableName => $condition) {
            $this->db->join($tableName, $condition, 'left');
        }
        if (!empty($constraint_array)) {
            $this->db->where($constraint_array);
        }

        if (!empty($orderby)) {
            $this->db->order_by($orderby);
        }

        if ($groupBy != '') {
            $this->db->group_by($groupBy);
        }

        if ($limitValue != '') {
            $this->db->limit($limitValue);
        }
        if ($distinct != '') {
            $this->db->limit($limitValue);
        }

        $results = $this->db->get();
        return $results;
    }

    public function validate_insert($table, $qr_code, $data)
    {
        $this->db->where('qr_code', $qr_code);
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            $result = 1;
            return $result;
        } else {
            $this->db->insert($table, $data);
        }
    }

    public function get_domain($url)
    {
        $pieces = parse_url($url);
        $domain = isset($pieces['host']) ? $pieces['host'] : $pieces['path'];
        if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
            return $regs['domain'];
        }
        return false;
    }

    public function get_products($group_id)
    {
        $this->db->select("*");
        $this->db->from("products");
        $this->db->where('psub_cat_id', $group_id);
        $this->db->group_by("product_name");
        $query = $this->db->get();
        return $query->result();
    }
    public function get_subcatdrop($group_id)
    {
        $this->db->select("*");
        $this->db->from("sub_category");
        $this->db->where('spg_id', $group_id);
        $this->db->group_by("subcategory_name");
        $query = $this->db->get();
        return $query->result();
    }

    public function get_user($user_id)
    {
        $this->db->select("*");
        $this->db->from("users");
        $this->db->where("user_id", $user_id);

        $num_results = $this->db->get()->result();
        return $num_results;
    }

    public function get_all_users()
    {
        $this->db->select("*");
        $this->db->from("users");
        $this->db->where('auth_level!=', 9);
        $this->db->order_by("first_name", "asc");
        $this->db->order_by("username", "asc");
        // $this->db->order_by("user_id", "desc");
        $query = $this->db->get();
        return $query->result();
    }

    public function get_user_addresss($user_id)
    {
        $this->db->select("*");
        $this->db->from("user_address");
        $this->db->where('user_id', $user_id);
        $this->db->order_by("id", "asc");
        $query = $this->db->get();
        return $query->result();

    }

    public function get_product_price($product_id, $uom, $quantity, $pgroup)
    {
        $this->db->select("*");
        $this->db->from("products");
        $this->db->where("product_id", $product_id);
        $query = $this->db->get();
        $ret = $query->row();
        $product_name = $ret->product_name;

        $this->db->select("*");
        $this->db->from("products_group");
        $this->db->where("pg_id", $pgroup);
        $query = $this->db->get();
        $ret = $query->row();
        $igst = $ret->igst;
        $getigst = $igst / 100;

        $this->db->select("*");
        $this->db->from("products");
        $this->db->where("product_name", $product_name);
        $this->db->where("unit", $uom);
        $query = $this->db->get();
        $ret = $query->row();
        // $selling_price = $ret->selling_price;
        $selling_price = $ret->selling_price;
        if ($igst >= 1) {
            $price = $selling_price * $quantity;

            $gst = $getigst * $quantity;
            $tgst = $selling_price * $gst;
            $result = $price + $tgst;
        } else {
            $result = $selling_price * $quantity;

        }
        return $result;
    }
    // grand total//
    public function get_grandtotal($total)
    {
        $this->db->select("*");
        $this->db->from("order_settings");
        // $this->db->where("product_id", $product_id);
        $query = $this->db->get();
        $ret = $query->row();
        $free_delivery = $ret->free_delivery;

        $selling_price = $ret->selling_price;
        if ($total >= $free_delivery) {
            $result = $total;
        } else {
            $result = $total + 30;

        }
        return $result;
    }
    // delivery charge
    public function get_delivery_charge($total)
    {
        $this->db->select("*");
        $this->db->from("order_settings");
        // $this->db->where("product_id", $product_id);
        $query = $this->db->get();
        $ret = $query->row();
        $free_delivery = $ret->free_delivery;

        $selling_price = $ret->selling_price;
        if ($total >= $free_delivery) {
            $result = 0;
        } else {
            $result = 30;

        }
        return $result;
    }
    public function subDropdown($id = '')
    {
        $this->db->select('sub_cat_id,subcategory_name');
        $this->db->from('sub_category');
        if ($id != "") {

            $this->db->where('spg_id', $id);
        }

        // $this->db->where('is_delete',0);
        $this->db->order_by("subcategory_name", "asc");

        $results = $this->db->get()->result();
        $options = array();
        $options[''] = 'Select Sub Category';
        foreach ($results as $item) {
            $options[$item->sub_cat_id] = $item->subcategory_name;
        }
        return $options;
    }
    public function productrecord($id)
    {
        $this->db->select("*");
        $this->db->from('products as p');
        $this->db->join("stocks as s", "s.pro_id=p.product_id");
        $this->db->join("set_uom as u", "u.u_id=p.unit");
        // $this->db->where("p.active", 1);
        $this->db->where('p.product_id', $id);
        $this->db->order_by("p.product_id", "asc");
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function product_group()
    {
        $this->db->select("*");
        $this->db->from('products_group as p');

        $this->db->order_by("p.product_group", "asc");
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function sub_group()
    {
        $this->db->select("*");
        $this->db->from('sub_category as s');

        $this->db->order_by("s.subcategory_name", "asc");
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function uom()
    {
        $this->db->select("*");
        $this->db->from('set_uom as su');

        $this->db->order_by("su.uom", "asc");
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function uom_unit()
    {
        $this->db->select("*");
        $this->db->from('measurments as m');
        $this->db->where('m.m_active', "1");
        $this->db->order_by("m.m_unit", "asc");
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function brand()
    {
        $this->db->select("*");
        $this->db->from('brands as b');
        $this->db->where('b.brand_active', "1");
        $this->db->order_by("b.brand_name", "asc");
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function fetch_module($role)
    {
        $this->db->select('*');
        $this->db->from("previleges as p");
        $this->db->where("p.role",$role);
        $results = $this->db->get()->result();
        return $results;
    }  
    public function get_taskdata($id)
    {
        $this->db->select('t.*, c.client_name, s.service_name, s.*,CONCAT(u.first_name, " ", u.last_name)as approver,ta.assign_to as assigned');
        $this->db->from('task as t');
        $this->db->join('task_assign as ta', 'ta.task_id = t.task_id', 'left');
        $this->db->join('users as u', 'u.user_id=t.approver');
        $this->db->join('client as c', 'c.client_id=t.client');
        $this->db->join('service as s', 's.service_id=t.service');
        // $this->db->where('t.task_status', '2');
        $this->db->where('t.task_id', $id);        
        $this->db->group_by('t.task_id');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function get_taskDetail($id)
    {
        // $this->db->select('t.*,ta.*,c.client_name, s.service_name, s.*,CONCAT(u.first_name, " ", u.last_name)as approver,ta.assign_to as assigned');
        $this->db->select('t.*,c.client_name, s.service_name, s.*,CONCAT(u.first_name, " ", u.last_name)as approver,ta.assign_to as assigned, sc.s_category_name,t.created_on as created_on');
        $this->db->from('task as t');
        $this->db->join('task_assign as ta', 'ta.task_id = t.task_id', 'left');
        $this->db->join('users as u', 'u.user_id=t.approver');
        $this->db->join('client as c', 'c.client_id=t.client');
        $this->db->join('service as s', 's.service_id=t.service');
        $this->db->join('service_category as sc', 'sc.s_category_id=s.s_cat_id','left');
        // $this->db->where('t.task_status', '2');
        $this->db->where('t.task_id', $id);        
        $this->db->group_by('t.task_id');
        $query = $this->db->get();
        $result = $query->result();  
        $output = array();   
       
     
        foreach($result as $row){
           
            $this->db->select('ta.*,CONCAT(u.first_name, " ", u.last_name)as executive');
            $this->db->from('task_assign as ta');
            $this->db->join('users as u', 'u.user_id=ta.assign_to');
            $this->db->where('ta.task_id', $row->task_id); 
            $this->db->group_by('ta.task_assign_id');
            $query1 = $this->db->get();
            $result1 = $query1->result(); 
           
            $output[]  = array(
                'task_id' => $row->task_id,
                'client_name' => $row->client_name,
                'service_name' => $row->service_name,
                'service_cost' => $row->service_cost,
                'time_line' => $row->time_line,
                'due_date' => $row->due_date,
                'due_date_to' => $row->due_date_to,
                'approver' => $row->approver,
                'task_status' => $row->task_status,
                'status' => $row->status,
                'priority' => $row->priority,
                'job_detail' => $row->job_detail,
                'assign_arr' => $result1,
                'is_approved' => $row->is_approved,
                'remarks' => $row->remarks,
                'execute_remarks' => $row->execute_remarks,
                'service_category' => $row->s_category_name,
                'created_on' => $row->created_on,
                'invoice_amount' => $row->invoice_amount,
                'paid_amount' => $row->paid_amount,
            );
        }        
        return $output;
    }

    public function get_service(){
        $this->db->select('s.*, c.s_category_name');
        $this->db->from('service as s');
        $this->db->join('service_category as c', 'c.s_category_id = s.s_cat_id', 'left');       
        // $this->db->where('t.task_status', '2');
        $this->db->where('s.status', 1);        
        $this->db->group_by('s.service_id');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function get_billJob(){
        $this->db->select('t.task_id, s.service_name');
        $this->db->from('task as t');
        $this->db->join('service as s', 's.service_id = t.service', 'left');       
        //  $this->db->where('t.task_status', '2');
        // $this->db->where('s.status', 1);        
        $this->db->group_by('t.task_id');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function get_assignDropdown(){
        $this->db->select("*");
        $this->db->from("users as u");
        $this->db->join('role_master as r', 'r.id = u.auth_level', 'left');
        $this->db->where('is_approve', 1);
        $this->db->where('auth_level>', 4);
        $this->db->where('auth_level<', 7);
        $this->db->order_by("first_name", "asc");
       
        $query = $this->db->get();
        $result = $query->result();
        foreach ($result as $row){
            $output[] = array(
                'user_id' => $row->user_id,
                'first_name' => $row->first_name,
                'last_name' => $row->last_name,
                'auth_level' => $row->auth_level,
                'role' => $row->role_name,
                'user_code' => $row->user_code,
                'is_approve' => $row->is_approve,
            );
        }

        return $output;

    }

    public function get_approverDropdown(){
        $this->db->select("*");
        $this->db->from("users as u");
        $this->db->join('role_master as r', 'r.id = u.auth_level', 'left');
        $this->db->where('is_approve', 1);
        $this->db->where('auth_level>=', 7);       
       
        $query = $this->db->get();
        $result = $query->result();
        foreach ($result as $row){
            $output[] = array(
                'user_id' => $row->user_id,
                'first_name' => $row->first_name,
                'last_name' => $row->last_name,
                'auth_level' => $row->auth_level,
                'role' => $row->role_name,
                'user_code' => $row->user_code,
                'is_approve' => $row->is_approve,
            );
        }

        return $output;
    }


    public function get_clientid($id){
        $this->db->select("*");
        $this->db->from("task");
        $this->db->where('task_id',$id);
        $query = $this->db->get()->result();
        return $query;
    }
    public  function invoie_seq($id){
        $this->db->select('*');
        $this->db->from('task');
        $this->db->where('client = ',$id);
        $num_results = $this->db->count_all_results();
        return $num_results;
    }
    public function get_client_code($table,$id){
        $this->db->select('client_code');
        $this->db->from($table);
        $this->db->where('client_id = ',$id);
        $num = $this->db->get()->result();
        return $num;       
    }
    public function checktime($id,$start,$end,$sheet){
     $this->db->select('*');
     $this->db->from('time_sheet');
     $this->db->where('start_time =',$start);
     $this->db->where('end_time =',$end);
     $this->db->where('created_by =',$id);
     $this->db->where('sheet_date',$sheet);
     $this->db->order_by("end_time", "desc");
     $check = $this->db->get()->result_array();
     if($check ==null){
        $this->db->select('*');
        $this->db->from('time_sheet');
        $this->db->where('created_by =',$id);
        $this->db->where('sheet_date',$sheet);
        $this->db->order_by("end_time", "desc");
        $checked = $this->db->get()->result_array();
             if($checked !=null){
                    foreach($checked as $val){
                        if(($start >=explode(' ',$val['end_time'])[0]) && ($end>$start)){
                             return true;
                         }
                     }
                return false;
            }else{
                return true;
            }

     }
     else{
        return false;
     }

    }

    public function get_temp_data($table,$array,$data){
       $this->db->select('*');
       $this->db->from($table);
       $this->db->where($array);
       $this->db->where('temp_status =','1');
       $query =$this->db->order_by($data,'desc')->get()->row();
       return $query;
    }  
    public function get_check_id($table,$array){
        $this->db->select("*");
        $this->db->from($table);
        $this->db->where($array);
        $this->db->where('temp_status =','1');
        $query = $this->db->get()->result();
        if($query){
            return true;
        }else{
            return false;
        }
    }
    
    public function get_rpid($task_id,$invoice_id){
        $this->db->select('*');
        $this->db->from('record_payment as r');
        // $this->db->join('service_category as c', 'c.s_category_id = s.s_cat_id', 'left');       
         $this->db->where('r.invoice_id', $invoice_id);
        $this->db->where('r.task_id', $task_id);        
        $this->db->order_by('rp_id','desc');
        $this->db->limit('1');
        $query = $this->db->get();
        $result = $query->row();
        return $result;
    }

    public function pre_time($sheet_date,$user_id,$start_time,$end_time){
        $te = new DateTime($start_time.'+1 time');
        $val1 = $start_time + 1;
        $start = $val1.':00';
              
        $val2 = $end_time - 1;
        $end = $val2.':00';
        
        //  print_r($sheet_date);
        //  print_r($user_id);
        // print_r($end);
        //  EXIT();
        // $end = $val2.':00';
         $sql = " SELECT *
        FROM `time_sheet`
        WHERE `sheet_date` = '$sheet_date'
        AND `created_by` = '$user_id' AND 
        (`start_time` BETWEEN '$start_time' and '$end' OR `end_time` BETWEEN '$start' and '$end_time'  OR
         `start_time` = '$start_time'
        OR `end_time` = '$end_time')";

       
        // print_r($start);
        // print_r($end);
        // print_r($sheet_date);
        // $this->db->select('*');
        // $this->db->from('time_sheet'); 
        //  $this->db->where('sheet_date',$sheet_date);
        // $this->db->where('created_by',$user_id);      
        // $this->db->where('start_time >=',$start_time);  
        // $this->db->where('start_time <=',$end);
        // $this->db->or_where('end_time >=',$start);  
        // $this->db->or_where('end_time <=',$end_time);                
        // $this->db->or_where('start_time',$start_time);
        // $this->db->or_where('end_time',$end_time);
        // $query = $this->db->get();
        $query = $this->db->query($sql)->result();
        //  echo "<pre>";
        //  print_r($this->db);
        // $result = $query->result();
        return $query;       
    }

    public function pre_time1($sheet_date,$user_id,$start_time,$end_time){
        $te = new DateTime($start_time.'+1 time');
        $val1 = $start_time + 1;
        $start = $val1.':00';
              
        $val2 = $end_time - 1;
        $end = $val2.':00';
        
         print_r($sheet_date);
        // print_r($start);
        // print_r($end);
        // EXIT();
        // $end = $val2.':00';
         $sql = " SELECT *
        FROM `time_sheet`
        WHERE 'sheet_date' = '$sheet_date'
        AND `created_by` = '$user_id'
        AND `start_time` BETWEEN '$start_time' and '$end' OR
        (`end_time` BETWEEN '$start' and '$end_time'  OR
         `start_time` = '$start_time'
        OR `end_time` = '$end_time')";

       
        // print_r($start);
        // print_r($end);
        // print_r($sheet_date);
        // $this->db->select('*');
        // $this->db->from('time_sheet'); 
        //  $this->db->where('DATE(sheet_date)',date('Y-m-d',strtotime($sheet_date)));
        // $this->db->where('created_by',$this->auth_user_id);      
        // $this->db->where('start_time BETWEEN "'.$start_time. '" and "'.$end.'"');  
        // $this->db->or_where('end_time BETWEEN "'.$start. '" and "'.$end_time.'"');                
        // $this->db->or_where('start_time',$start_time);
        // $this->db->or_where('end_time',$end_time);
        $query = $this->db->query($sql)->result();
        echo "<pre>";
        print_r($this->db);
        //$result = $query->get();
        return $query;       
    }
    

    public function is_dc_no_exists($dc_no) {
        $this->db->where('dc_no', $dc_no);
        $query = $this->db->get('sales_order_items'); // Replace 'your_table_name' with your actual table name

        return $query->num_rows() > 0;
    }
}