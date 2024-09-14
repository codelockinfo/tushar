<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

class client_functions {
    function conatct_form(){  
        $response_data = array('data' => 'fail', 'msg' => 'Unknown error occurred');
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        if (empty($email)) {
            $error_array['email'] = "Please enter an email address";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_array['email'] = "Please enter a valid email address";
        }
        
        if (isset($_POST['name']) && $_POST['name'] == '') {
            $error_array['name'] = "Please enter name";
        }
        
        if (isset($_POST['message']) && $_POST['message'] == '') {
            $error_array['message'] = "Please enter message";
        }
        
        if (empty($error_array)) {  
            $message = "Name : "  .$_POST['name'];
            $message .= "<br> Email : "  .$email;
            $message .= "<br> Message : "  .$_POST['message'];
            $to = "codelockinfo@gmail.com";	
            $subject = "Shopify Inquiry"; 
            $headers = $_POST['email']." \r\n";     
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
            $responceEmail = mail ($to, $subject, $message, $headers);	
            $response_data = array('data' => 'success', 'msg' => 'Send mail successfully!');
        }else{
            $response_data = array('data' => 'fail', 'msg' => $error_array);
        }
        
        $response = json_encode($response_data);
        return $response;
        
    }
}