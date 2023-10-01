<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Sms
{

    public function __construct()
    {
        $this->_CI = &get_instance();
        $this->_CI->load->model('Common_model', 'mcommon');
    }

    public function send_sms($sms_value, $template_id, $user_id)
    {
        //get mobile number
        $mobile_no = $this->_CI->mcommon->specific_row_value('user_details', array('user_id' => $user_id), 'mobile');
        $sms_template = $this->_CI->mcommon->specific_row_value('m_sms_template', array('id' => $template_id), 'template_content');
        $temp_id = $this->_CI->mcommon->specific_row_value('m_sms_template', array('id' => $template_id), 'template_id');

        $username = "jewelb";
        $apikey = "msMXhFsa1vmyvPHhRIUn";
        $senderid = "JEWBAZ";

        $vars = array(
            '{#var1#}'       => $sms_value[0],
            '{#var2#}'        => $sms_value[1],
            '{#var3#}'        => $sms_value[2],
            '{#var4#}'        => $sms_value[3],
            '{#var5#}'        => $sms_value[4],
            '{#var6#}'        => $sms_value[5],
            '{#var7#}'        => $sms_value[6],
            '{#var8#}'        => $sms_value[7],
            '{#var9#}'        => $sms_value[8],
            '{#var10#}'        => $sms_value[9],
        );

        $message = strtr($sms_template, $vars);
        $encodemsg = urlencode($message);
        $url = 'http://reseller.alphasoftz.info/api/sendsms.php?user=' . $username . '&apikey=' . $apikey . '&mobile=' . $mobile_no . '&message=' . $encodemsg . '&senderid=' . $senderid . '&type=txt&tid=' . $temp_id;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $curl_scraped_page = curl_exec($ch);
        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
        }
        curl_close($ch);

        if (isset($error_msg)) {
            $error_array = array('status' => 'error', 'message' => $error_msg);
            return $error_array;
        } else {
            $success_array = array('status' => 'success', 'message' => 'OTP sent successfully');
            return $success_array;
        }
    }

    public function submit_notification_result($notification)
    {
        $result = $this->_CI->pm->insert_notification($notification);
        return $result;
    }
}
