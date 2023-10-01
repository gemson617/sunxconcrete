<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Push_notification
{

    public function __construct()
    {
        $this->_CI = &get_instance();
        $this->_CI->load->model('Profile_model', 'pm');
    }

    public function send_push($message_array, $user_id)
    {
        $user = $this->_CI->pm->profile($user_id);

        $device_id = array();
        $device_id[] = $user[0]['device_id'];
        define('API_ACCESS_KEY', 'AAAAXxrjfHE:APA91bGhOdCg0_2YPwEjbm2ckEHBIFc6Ds3JmZumidTaK09kL-med26Q-eYyKxOhv5ilzWv1jgPOEPOpTILpRC1_o3oqPuQtw3SgllCKDPLVhyWpP0PJn_bbUWrm_y73eMxGeRtkkA1O');
        if (!empty($message_array)) {
            $registrationIds = $device_id;
            $body = $message_array['body'];
            $title = $message_array['title'];

            // prep the bundle
            $msg = array
                (
                'body' => $body,
                'title' => $title,
                'vibrate' => 1,
                'sound' => 1,
            );
            $fields = array
                (
                'registration_ids' => $registrationIds,
                'notification' => $msg,
            );

            $headers = array
                (
                'Authorization: key=' . API_ACCESS_KEY,
                'Content-Type: application/json',
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);
            curl_close($ch);
            return $result;
        }

    }

    public function submit_notification_result($notification)
    {
        $result = $this->_CI->pm->insert_notification($notification);
        return $result;
    }


}