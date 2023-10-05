<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
		// $this->load->model("Common_modl", "mcommon");

        		// $approve_status = $this->mcommon->specific_row_value('users', array('user_id'=> $this->auth_user_id),'is_approve');
        		//  if ($approve_status == 0) {
        			
                //     redirect('/logout');
                // }
				if($this->auth_level!=9){
					redirect('/logout');
				}
	}
	public function index()
	{
	   // echo phpinfo();
		if ($this->verify_min_level(1)) {
			


			//Doughnut Chart
			// $view_data['employee_type_label'] = $this->employee_type_label();
			// $view_data['employee_type'] = $this->employee_type_chart();
			// $view_data['month_wise_task'] = $this->month_wise_task();
			// $view_data['month_wise_complete'] = $this->month_wise_complete();
			
			// Pie Chart
			// $view_data['task_type'] = $this->task_type_chart();
			// Employee Upcomimg Birth Day 
			// $view_data['upcoming_dob_employee'] = $this->upcoming_dob_employee();
			
			
			$view_data = '';
			$data = array(
				'page_title' => 'Dashboard',
				'title' => 'Dashboard',
				'content' => $this->load->view('pages/dashboard', $view_data, TRUE),
			);
			$this->load->view('base/base_template', $data);
		} else {
			redirect('login');
		}
	}

	// public function over_due()
	// {
	// 	$today_date = date('Y-m-d');
    //     $this->db->select('*');
    //     $this->db->from('task as t');    
	// 	$this->db->where('t.is_approved', '0');
	// 	$this->db->where('DATE(t.due_date_to)<', $today_date);  
    //     $query = $this->db->get();
    //     $result = $query->result();

    //     return count($result);
	// }

	// public function this_week()
	// {	
	// 	$today_date                 =   date('Y-m-d');
	// 	$end_week                   =   date('Y-m-d', strtotime("-7 day", strtotime($today_date)));
	// 	$today_date = date('Y-m-d');
    //     $this->db->select('*');
    //     $this->db->from('task as t');  
	// 	// $this->db->where('DATE(t.due_date)<=', $today_date);  
	// 	$this->db->where('DATE(created_on) <=', $today_date);
	// 	$this->db->where('DATE(created_on) >=', $end_week);
    //     $query = $this->db->get();
    //     $result = $query->result();

    //     return count($result);
	// }



	public function employee_type_label()
	{		
		$this->db->select("r.id,r.role_name");
        $this->db->from("role_master as r");
		$this->db->where("r.id!=",9);
		$query = $this->db->get();
        $result = $query->result();
		foreach($result as $row) {		
			$this->db->select("COUNT(u.user_id) as type");
			$this->db->from("users as u");       
			$this->db->where("u.auth_level",$row->id);
			$query1 = $this->db->get();
			$result1 = $query1->result();       
			foreach($result1 as $row1) {
					$data['name'][] = $row->role_name;
					$data['value'][] = (int) $row1->type;					
					$data['option'][] = 'value:'.$row1->type.', name:'.$row->role_name;
			}
		}
		
      $resultdata = json_encode($data);
	  return $resultdata;
	}
	public function employee_type_chart()
	{		
		$this->db->select("r.id,r.role_name");
        $this->db->from("role_master as r");
		$this->db->where("r.id!=",9);
		$query = $this->db->get();
        $result = $query->result();
		$data = array(); 
		foreach($result as $row) {		
		$this->db->select("COUNT(u.user_id) as type,r.id,r.role_name");
        $this->db->from("users as u");    
		$this->db->join("role_master as r","r.id = u.auth_level"); 
        $this->db->where("u.auth_level",$row->id);
        $query1 = $this->db->get();
		
        $result1 = $query1->result_array();  
	   
			foreach($result1 as $row1) {
					
					$data[] = array(
						'name' => $row1['role_name'],
						'value' => $row1['type'],
					);	
			}
		}
		
	  return $data;
	}
	//Pie Chart



		
			
		
		
	
	public function upcoming_dob_employee()
	{	
		$today_date                 =   date('m');
		// $end_week                   =   date('Y-m-d', strtotime("+7 day", strtotime($today_date)));
		// $today_date = date('Y-m-d');
        $this->db->select('*');
        $this->db->from('users as t');  
		$this->db->join("role_master as r","r.id = t.auth_level",'left'); 
		$this->db->where('MONTH(t.dob)', $today_date);
		// $this->db->where('DATE(t.dob) >=', $end_week);	
		 $this->db->group_by('t.user_id');	
        $query = $this->db->get();
        $result = $query->result();

        return $result;
	}





	
}
