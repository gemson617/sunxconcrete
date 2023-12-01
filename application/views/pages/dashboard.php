<!-- <div class="main-content"> -->
<link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
<style>
    .badge {
  font-family: "Rubik", sans-serif;
  box-shadow: 0 0 24px 0 rgba(0, 0, 0, 0.06), 0 1px 0 0 rgba(0, 0, 0, 0.02);
  padding: .35em .5em;
  font-weight: 500;
}
   
        .badge-success {
                             background-color: #0acf97;
                        }

        /* .badge-not {
                                background-color: #9b2b2b;
                        } */
        .approved-btn {
            background-color: #db9323;
            border-color: #db9323;
        }

        .new {
                    background-color: #cc0000;
            }
        .accept {
                background-color: #9b2b2b;
        }
        .complete {
                    background-color: #006633;
            }
            .approved {
                    background-color: #0acf97;
            }
            .update {
                    background-color: #004080;
            }
                   
    
    </style>
<?php 
$count = count($employee_type);    
foreach($employee_type as $row)        
{
    // print_r($employee_type['value'][$i]);  

} ?>

<?php foreach($month_wise_task as $row1)  {  
} ?> 
<div class="page-content">
    <div class="container-fluid">
        <div class="col-xl-12">
    


        <div class="row">
                            <div class="col-lg-6 col-xl-3 mb-4">
                                <div class="card bg-info text-white ">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="me-3">
                                                <div class="text-white-75 ">Customers</div>
                                                <div class="text-lg fw-bold"><?= $customers ?></div>
                                            </div>
                                            <i class="bx bx-user" style="font-size: 30px;"></i>
                                            <!-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar feather-xl text-white-50"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg> -->
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between small">
                                        <a class="text-white stretched-link" href="<?php echo site_url('customer');?>">View Customers List</a>
                                        <div class="text-white"><svg class="svg-inline--fa fa-angle-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" data-fa-i2svg=""><path fill="currentColor" d="M246.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L178.7 256 41.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"></path></svg><!-- <i class="fas fa-angle-right"></i> Font Awesome fontawesome.com --></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-3 mb-4">
                                <div class="card bg-warning text-white ">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="me-3">
                                                <div class="text-white-75 ">Quotation</div>
                                                <div class="text-lg fw-bold"><?= $quatation ?></div>
                                            </div>
                                            <i class="bx bx-edit-alt" style="font-size: 30px;"></i>
                                            <!-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign feather-xl text-white-50"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg> -->
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between small">
                                        <a class="text-white stretched-link" href="<?php echo site_url('Quotation/view'); ?>">View Quotation List</a>
                                        <div class="text-white"><svg class="svg-inline--fa fa-angle-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" data-fa-i2svg=""><path fill="currentColor" d="M246.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L178.7 256 41.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"></path></svg><!-- <i class="fas fa-angle-right"></i> Font Awesome fontawesome.com --></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-3 mb-4">
                                <div class="card bg-success text-white ">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="me-3">
                                                <div class="text-white-75 ">Sales</div>
                                                <div class="text-lg fw-bold"><?= $sales ?></div>
                                            </div>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square feather-xl text-white-50"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between small">
                                        <a class="text-white stretched-link" href="<?php echo site_url('SalesOrder/view'); ?>">View Sales List</a>
                                        <div class="text-white"><svg class="svg-inline--fa fa-angle-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" data-fa-i2svg=""><path fill="currentColor" d="M246.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L178.7 256 41.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"></path></svg><!-- <i class="fas fa-angle-right"></i> Font Awesome fontawesome.com --></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-3 mb-4">
                                <div class="card bg-danger text-white ">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="me-3">
                                                <div class="text-white-75">Completed Invoice</div>
                                                <div class="text-lg fw-bold"><?= $invoice ?></div>
                                            </div>
                                            <i class="bx bx-file" style="font-size: 30px;"></i>
                                            <!-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-circle feather-xl text-white-50"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg> -->
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between small">
                                        <a class="text-white stretched-link" href="<?php echo site_url('SalesOrder/invoice_list'); ?>">View Invoice</a>
                                        <div class="text-white"><svg class="svg-inline--fa fa-angle-right" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="angle-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 512" data-fa-i2svg=""><path fill="currentColor" d="M246.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L178.7 256 41.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"></path></svg><!-- <i class="fas fa-angle-right"></i> Font Awesome fontawesome.com --></div>
                                    </div>
                                </div>
                            </div>
                        </div>        
                        <!-- <div class="row"><div class="col-xl-3 col-sm-6 grid-margin stretch-card"><div class="card"><div class="card-body"><div class="row"><div class="col-9"><div class="d-flex align-items-center align-self-start"><h3 class="counter mb-0">12.34</h3><p class="text-success ml-2 mb-0 font-weight-medium">+3.5%</p></div></div><div class="col-3"><div class="icon icon-box-success "><span class="mdi mdi-arrow-top-right icon-item"></span></div></div></div><h6 class="text-muted font-weight-normal">Potential growth</h6></div></div></div><div class="col-xl-3 col-sm-6 grid-margin stretch-card"><div class="card"><div class="card-body"><div class="row"><div class="col-9"><div class="d-flex align-items-center align-self-start"><h3 class="mb-0">$17.34</h3><p class="text-success ml-2 mb-0 font-weight-medium">+11%</p></div></div><div class="col-3"><div class="icon icon-box-success"><span class="mdi mdi-arrow-top-right icon-item"></span></div></div></div><h6 class="text-muted font-weight-normal">Revenue current</h6></div></div></div><div class="col-xl-3 col-sm-6 grid-margin stretch-card"><div class="card"><div class="card-body"><div class="row"><div class="col-9"><div class="d-flex align-items-center align-self-start"><h3 class="mb-0">$12.34</h3><p class="text-danger ml-2 mb-0 font-weight-medium">-2.4%</p></div></div><div class="col-3"><div class="icon icon-box-danger"><span class="mdi mdi-arrow-bottom-left icon-item"></span></div></div></div><h6 class="text-muted font-weight-normal">Daily Income</h6></div></div></div><div class="col-xl-3 col-sm-6 grid-margin stretch-card"><div class="card"><div class="card-body"><div class="row"><div class="col-9"><div class="d-flex align-items-center align-self-start"><h3 class="mb-0">$31.53</h3><p class="text-success ml-2 mb-0 font-weight-medium">+3.5%</p></div></div><div class="col-3"><div class="icon icon-box-success "><span class="mdi mdi-arrow-top-right icon-item"></span></div></div></div><h6 class="text-muted font-weight-normal">Expense current</h6></div></div></div></div> -->
            <form action="<?php echo site_url('Dashboard'); ?>" method="post">
                <div class="row">
                    
                    <?php if ($this->auth_level == 9) { ?>
                        <!-- <div class="col-md-6">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">Select Employee</p>
                                            <select class="form-control" name="employee">
                                                <option value="">Select Employee</option>
                                                <option value="All">All</option>
                                                <?php foreach ($employee as $emp) { ?>
                                                    <option value="<?php echo $emp->emp_id; ?>"><?php echo $emp->first_name . '' . $emp->middle_name . '' . $emp->surname; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div> -->
                    <?php } ?>
                    <!-- <div class="col-md-6">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-muted fw-medium">Month</p>
                                        <input type="month" class="form-control" name="month" oninput='this.form.submit()'>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                               
                    

                    <!-- <div class="row">
                        <div class="col-md-3">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p align="center" class="text-muted fw-medium">No. of Task Assigned</p>
                                            <h4 align="center"><?php echo count($no_of_task_assigned); ?></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p align="center" class="text-muted fw-medium">No. of Task Pending</p>
                                            <h4 align="center"><?php echo count($pending); ?></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p align="center" class="text-muted fw-medium">No. of Task (over Due)</p>
                                            <h4 align="center"><?php echo $over_due ? $over_due : 0; ?></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p align="center" class="text-muted fw-medium">Show the approval Task</p>
                                            <h4 align="center"><?php echo count($approval)? count($approval) : 0; ?></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->

                 

                </div>
            </form>
       
        <!-- </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Employee Chart</h4>
                        <div id="doughnut-chart" class="e-charts"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Task Chart</h4>
                        <div id="pie-chart" class="e-charts"></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-2">
            </div>

                     <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Target vs Completed </h4>
                                <div id="mix-line-bar" class="e-charts"></div>
                            </div>
                        </div>
                    </div>
        </div> -->


        <!-- <div class="row">
            <div class="col-xl-2">
            </div>
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-5">Upcoming Birthdays</h4>
                        <ul class="verti-timeline list-unstyled" style="width:500px;">
                            <?php foreach($upcoming_dob_employee as $brow){
                                ?>
                                <li class="event-list">
                                    <div class="event-timeline-dot">
                                        <i class="bx bx-right-arrow-circle font-size-18"></i>
                                    </div>
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <h5 class="font-size-14"><?php echo date('d-F', strtotime($brow->dob));?> <i class="bx bx-right-arrow-alt font-size-16 text-primary align-middle ms-2"></i></h5>
                                        </div>
                                        <div class="flex-grow-6">
                                            <div>
                                            <?php echo $brow->first_name." ".$brow->last_name;?><i class="bx bx-right-arrow-alt font-size-16 text-primary align-middle ms-2"></i>
                                            </div>
                                           
                                        </div>   
                                        <div class="flex-grow-2"></div>                                     
                                        <div class="flex-grow-6 ms-2"> 
                                            <div>
                                            <?php echo $brow->role_name;?>
                                            </div>
                                        </div> 
                                    </div>
                                    
                                </li>
                            <?php 
                            }?>
                            
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-2">
            </div>
        </div> -->
        <!-- <div class="row row-align">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Task Over Due</h4>
                        <div class="table-responsive">
                        <table id="dmstable" class="table table-hover datatable dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                          
                                            <th scope="col">Job ID</th>
                                            <th scope="col">Client</th>
                                            <th scope="col">Job Type</th>                                    
                                            <th scope="col">Timeline</th>
                                            <th scope="col">Start Date </th>  
                                            <th scope="col">End Date </th>         
                                            <th scope="col">Approver</th>
                                            <th scope="col"> Over Due </th>
                                            <th scope="col">Status</th>                                   
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php 
                                        if(!empty($over_due_task)){
                                        foreach ($over_due_task as $key => $d) { ?>
                                            <tr>
                                               
                                                <td><?php echo $d->task_id; ?></td>
                                                <td><?php echo $d->client_name; ?></td>
                                                <td><?php echo $d->service_name; ?></td>                                       
                                                <td><?php echo $d->time_line," ".$d->duration; ?></td>
                                                <td><?php echo date('d-m-Y',strtotime($d->due_date)); ?></td>
                                                <td><?php echo date('d-m-Y',strtotime($d->due_date_to)); ?></td>
                                               
                                                <td><?php 
                                                    $get_tid = $this->mcommon->records_all('task_assign', array('task_id'=>$d->task_id));
                                                    $length = count($get_tid);
                                                    
                                                    if($length > 1){
                                                        $output = array();
                                                        $i=1;
                                                        foreach($get_tid as $row){                                                    
                                                            $get_assign = $this->mcommon->specific_row_value('users',array('user_id'=>$row->assign_to),'first_name');
                                                            $output[] = array(
                                                                'assign_name' => $get_assign,
                                                            );
                                                            $assignexp = explode(',', $get_assign);                                                   
                                                            $assign = implode('', $assignexp);
                                                            echo $assign;if($i < $length){ echo ", "; } 
                                                            $i++;
                                                        }                                             
                                                        
                                                    }else{
                                                        $get_assign = $this->mcommon->specific_row_value('users',array('user_id'=>$d->assign_to),'first_name');
                                                        echo $get_assign."(".$d->assign_to.")";
                                                    }     
                                                ?></td>
                                              
                                                <td><?php echo $d->approver; ?></td>  
                                                <td>
                                                    <?php
                                                        $today_date = date('Y-m-d');
                                                        $time1 = strtotime($d->due_date_to);                               
                                                        $time2 = strtotime($today_date);
                                                        $dateTimeObject1 = date_create($d->due_date_to);                              
                                                        $dateTimeObject2 = date_create($today_date);
                                                        $interval = date_diff($dateTimeObject1, $dateTimeObject2);// Printing result in hours
                                                        
                                                        $minutes = $interval->days * 24 * 60;
                                                        $minutes += $interval->h * 60;
                                                        $minutes += $interval->i;//Printing result in minutes
                                                        $hr=(int) $interval->h;
                                                        echo $interval->days." Days";
                                                        $total_hr += $hr;
                                                    ?>
                                                </td>                                     
                                               
                                                <td><?php if ($d->task_status == 1) { ?>
                                                    <span class="badge badge-success new">
                                                        <?php echo "New"; ?> </span>
                                                        <?php
                                                    } else if($d->task_status == 2) { ?>
                                                    <span class="badge badge-not accept">
                                                        <?php echo "Accepted";
                                                    }else if($d->task_status == 3) { ?>
                                                        <span class="badge badge-not complete">
                                                        <?php echo "Completed";
                                                    } else if($d->task_status == 4) { ?>
                                                        <span class="badge badge-not approved">
                                                        <?php echo "Approved";
                                                    } ?></span></td>                                            
                                            
                                            </tr>
                                        <?php }
                                        }else{ ?>
                                        <tr> <td colspan="10" align="center"><?php echo "No Data";?></td> </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

</div>

</div>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/metismenu/metisMenu.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/simplebar/simplebar.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/node-waves/waves.min.js"></script>
<!-- echarts js -->
<script src="<?php echo base_url(); ?>assets/libs/echarts/echarts.min.js"></script>
<!-- echarts init -->
<script src="<?php echo base_url(); ?>assets/js/pages/echarts.init.js"></script>

<script src="<?php echo base_url(); ?>assets/js/app.js"></script>
<script>   
    // Start Doughnut Chart

    var dom = document.getElementById("doughnut-chart");
    var myChart = echarts.init(dom);
    var app = {};
    option = null;
      var emp = JSON.parse(`<?php echo $employee_type_label; ?>`);
    // var emp = JSON.parse(`<?php echo json_encode($employee_type['name']); ?>`);

    var data = emp.name;
    var arr = [];
    console.log(data);

    option = {
        tooltip: {
            trigger: 'item',
            formatter: "{a} <br/>{b}: {c} ({d}%)"
        },
        legend: {
            orient: 'vertical',
            x: 'left',
            //  data: ["Admin Staff","Paid Assistant","Article Assistant","Manager","Partner"],
             data: data,
            textStyle: {color: '#8791af'}
        },
        color: ['#556ee6', '#f1b44c', '#f46a6a', '#50a5f1', '#34c38f'],
        series: [
            {
                name:'Employee Type',
                type:'pie',
                radius: ['50%', '70%'],
                avoidLabelOverlap: false,
                label: {
                    normal: {
                        show: false,
                        position: 'center'
                    },
                    emphasis: {
                        show: true,
                        textStyle: {
                            fontSize: '30',
                            fontWeight: 'bold'
                        }
                    }
                },
                labelLine: {
                    normal: {
                        show: false
                    }
                },
                //   data: arr
                data:[
                    <?php
                    $count = count($employee_type['name']);
                    // for ( $i = 0; $i < $count; $i++) {    
                        foreach($employee_type as $row)  {     
                        ?>   
                            {value:<?php echo json_encode($row['value']);?>, name:<?php echo json_encode($row['name']);?>},
                    <?php }
                    ?>
                
                    // {value:$row['value'], name:+$row['name']},
                
                    // {value:310, name:'Admin Staff'},
                    // {value:310, name:'Paid Assistant'},
                    // {value:234, name:'Article Assistant'},
                    // {value:135, name:'Manager'},
                    // {value:1548, name:'Partner'}
                ]
            }
        ]
    };
    ;
    if (option && typeof option === "object") {
        myChart.setOption(option, true);
    }
     // End Doughnut Chart

      // Start Pie Chart     

        var dom = document.getElementById("pie-chart");
        var myChart = echarts.init(dom);
        var app = {};
        option = null;
        option = {
            tooltip : {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
            legend: {
                orient: 'vertical',
                left: 'left',
                data: ['Created','Assigned','Completed','Approved','Invoiced'],
                textStyle: {color: '#8791af'}
            },
            color: ['#f46a6a', '#34c38f', '#50a5f1', '#f1b44c', '#556ee6'],
            series : [
                {
                    name: 'Total sales',
                    type: 'pie',
                    radius : '55%',
                    center: ['50%', '60%'],
                    data:[
                        <?php
                    $count = count($task_type['name']);
                    // for ( $i = 0; $i < $count; $i++) {    
                        foreach($task_type as $row)  {     
                        ?>   
                            {value:<?php echo json_encode($row['value']);?>, name:<?php echo json_encode($row['name']);?>},
                    <?php }
                    ?>
                        // {value:335, name:'Laptop'},
                        // {value:310, name:'Tablet'},
                        // {value:234, name:'Mobile'},
                        // {value:135, name:'Others'},
                        // {value:1548, name:'Desktop'}
                    ],
                    itemStyle: {
                        emphasis: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }
            ]
        };
        ;
        if (option && typeof option === "object") {
            myChart.setOption(option, true);
        }
         // End Pie Chart

        // mix line & bar

        var dom = document.getElementById("mix-line-bar");
        var myChart = echarts.init(dom);
        var app = {};
        option = null;
        app.title = 'Data view';

        option = {
            // Setup grid
            grid: {
                zlevel: 0,
                x: 80,
                x2: 50,
                y: 30,
                y2: 30,
                borderWidth: 0,
                backgroundColor: 'rgba(0,0,0,0)',
                borderColor: 'rgba(0,0,0,0)',
            },
            tooltip: {
                trigger: 'axis',
                axisPointer: {
                    type: 'cross',
                    crossStyle: {
                        color: '#999'
                    }
                }
            },
            toolbox: {
                orient: 'center',
                left: 0,
                top: 20,
                feature: {
                // dataView: { readOnly: false, title: "Data View" },
                magicType: { type: ['line', 'bar'], title: {line: "For line chart", bar: "For bar chart"}},
                restore: { title: "restore" },
                saveAsImage: { title: "Download Image" }
                }
            },
            color: ['#34c38f', '#556ee6', '#f46a6a'],
            legend: {
                data:['Target','Completed'],
                textStyle: {color: '#8791af'}
            },
            xAxis: [
                {
                    type: 'category',
                    data: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
                    axisPointer: {
                        type: 'shadow'
                    },
                    axisLine: {
                        lineStyle: {
                        color: '#8791af'
                        },
                    },
                }
            ],
            yAxis: [
                {
                    type: 'value',
                    name: 'Count',
                    min: 0,
                    max: 100,
                    interval: 10,
                    axisLine: {
                        lineStyle: {
                        color: '#8791af'
                        },
                    },
                    splitLine: {
                        lineStyle: {
                            color:"rgba(166, 176, 207, 0.1)"
                        }
                    },
                    axisLabel: {
                        formatter: '{value}'
                    }
                },
                // {
                //     type: 'value',
                //     name: 'Temperature',
                //     min: 0,
                //     max: 25,
                //     interval: 5,
                //     axisLine: {
                //         lineStyle: {
                //         color: '#8791af'
                //         },
                //     },
                //     splitLine: {
                //         lineStyle: {
                //             color:"rgba(166, 176, 207, 0.1)"
                //         }
                //     },
                //     axisLabel: {
                //         formatter: '{value} Ã‚Â°C'
                //     }
                // }
            ],
            series: [
                {
                    name:'Target',
                    type:'bar',
                    //    data:[0, 0, 4, 1, 0, 0, 0, 0, 0, 0, 0, 0]
                    data:[
                        <?php foreach($month_wise_task as $row)  {    ?>
                            <?php echo json_encode($row['name']);?>,
   

                     <?php } ?>
                     
                    ]
                   
                },
                {
                    name:'Completed',
                    type:'bar',
                    // data:[2.6, 5.9, 9.0, 26.4, 28.7, 70.7, 175.6, 182.2, 0, 0, 0, 0]
                    data:[
                        <?php foreach($month_wise_complete as $row)  {    ?>
                            <?php echo json_encode($row['value']);?>,
   

                     <?php } ?>
                    ]
                },
                // {
                //     name:'Average Temperature',
                //     type:'line',
                //     yAxisIndex: 1,
                //     data:[2.0, 2.2, 3.3, 4.5, 6.3, 10.2, 20.3, 23.4]
                // }
            ]
        };
        ;
        if (option && typeof option === "object") {
            myChart.setOption(option, true);
        }

</script>