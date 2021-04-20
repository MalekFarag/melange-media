<?php

$ip = $_SERVER['REMOTE_ADDR'];







    if(isset($_POST['contact'])){
        $name = trim($_POST['customerName']);
        // $company = trim($_POST['customerCompany']);
        $email = trim($_POST['customerEmail']);
        // $phone = trim($_POST['customerphone']);
        $body = trim($_POST['customerMessage']);
        

        // $goals = $_POST['goals'];
        // $goals = implode(",",$interestArray);
        // $interest = trim($_POST['interest']);
        // $interests = array();
        

        if(!empty($name) || !empty($email)){
            //Log user in
                // $message = sendMessage($name, $company, $email, $phone, $body, $interests);


    
                    //mail config
                        ini_set('display_errors', 1);
                        error_reporting(E_ALL);
                        $from = 'contact@melangemedia.ca';
                        $to = 'contact@melangemedia.ca';
                        $subject = "Message From $name | Melange Media Form";
                        $message = "
A someone filled and sent a contact form from the contact page.

                        
The following message was sent by $name 
Email: $email
                          
                                    
Customer Message:

$body





Email is formatted by Reve Solutions. Powered by Titan.
";
                        $headers = 'From:'.$from;
                        mail($to,$subject,$message,$headers);

                        redirect_to('./');

                        
                
                        
        }else{
            $message = "<span class='errmsg'>Please fill out the required fields</span>";
        }
    }


?>