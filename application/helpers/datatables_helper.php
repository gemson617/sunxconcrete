<?php
/*
 * function that generate the action buttons edit, delete
 * This is just showing the idea you can use it in different view or whatever fits your needs
 */
function getOrderDetailsArr($orders='')
{
    $ci      = & get_instance();
    $result = explode(',',$orders);
    $ci->load->model('common_model');
    
    $first_name = $result[0];
    $mobile = $result[1];
    $o_id = $result[2];
    $created_date = str_replace("'","",$result[3]);
    $order_amount = $result[4];
    $category_id = $result[5];
    $gender = $result[6];
    $item_status_id = $result[7];
    $item_id = $result[8];
    $country_code = $result[9];

    if($gender==1)
    {
        $gender_name = 'Male';
    }
    else
    {
        $gender_name = 'Female';
    }

    //Get status  name
    $status_name = $ci->common_model->specific_row_value('wq_order_status',array('id'=>$item_status_id),'status_name');

    //Get Category name
    $category_name = $ci->common_model->specific_row_value('m_category',array('id'=>$category_id),'category_name');

    
    $html ='<div style="margin-left: 20px;" onclick="javascript:get_order_item_details('.$item_id.');"><h4>'.$first_name.'&nbsp;&nbsp;<br />'.$country_code.' '.$mobile.'</span></h4><p><strong>Category: </strong><br />'.$category_name.'<br /><strong>Order Status:</strong><br /><em>'.$status_name.'</em>&nbsp;<br /><div class="d-flex justify-content-between"><div><span class="badge badge-ontime">'.$gender_name.'</span></div><div>'.$created_date.'</div></div></div>';
    return $html;
}

?>
