<?php


function createuser($fname, $lname, $password, $email, $ip){
    
    $pdo = Database::getInstance()->getConnection();
    $hash = md5(date('l jS \of F Y h:i:s A'));

     // check user existance
     $check_email_query = 'SELECT COUNT(user_email) AS num FROM tbl_user WHERE user_email = :email'; 
     $user_set = $pdo->prepare($check_email_query);
     $user_set->execute(
         array(
             ':email'=>$email
         )
     );
 
     

     if($user_set->fetchColumn() == 0){
                //mail config
                ini_set('display_errors', 1);
                error_reporting(E_ALL);
                $from = 'contact@melangemedia.ca';
                $to = $email;
                $subject = "Please Verify Your New Account | Melange Media Admin Site";
                $message = "



        Thank you for creating an account with us. Please verify your account by clicking the link below.


        https://melangemedia.ca/admin/verify?hash=$hash&email=$email 






        Email is formatted by Reve Solutions. Powered by Titan.
        ";
                $headers = 'From:'.$from;
                mail($to,$subject,$message,$headers);

                        

                
                    $passwordEncryp = md5($password);

                    

                    //creating user sql query from form details
                    $create_user_query = "INSERT INTO tbl_user ( user_fname, user_lname, user_email, user_password, verified, user_hash, user_ip) VALUES ( :fname, :lname, :email, :password, '0', ':hash', ':ip');";

                    $user_signup = $pdo->prepare($create_user_query);
                    $user_signup->execute(
                        array(
                            ':fname'=>$fname,
                            ':lname'=>$lname,
                            ':email'=>$email,
                            ':password'=>$passwordEncryp,
                            ':hash'=>$hash,
                            ':ip'=>$ip
                        )
                    );

                    if($user_signup){
                        return "An Email has been sent to $email with a link to verify your account.";
                    }else{
                        return 'There has been an error creeating your account. Try again.';
                    }
    }else{

    return 'This email already exists in our system. Try using another one.';
        
    }
}

function resendVerify($email, $hash){
    //mail config
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        $from = 'contact@melangemedia.ca';
        $to = $email;
        $subject = "Please Verify Your New Account | Melange Media Admin Site";
        $message = "



        Thank you for creating an account with us. Please verify your account by clicking the link below.


        https://melangemedia.ca/admin/verify?hash=$hash&email=$email 






        Email is formatted by Reve Solutions. Powered by Titan.
        ";
        $headers = 'From:'.$from;
        mail($to,$subject,$message,$headers);
}


function getSingleUser($id){
    $pdo = Database::getInstance()->getConnection();
    //TODO: execute the proper SQL query to fetch the user data whose user_id = $id
    $get_user_query = 'SELECT * FROM tbl_user WHERE user_id = :id';
    $get_user_set = $pdo->prepare($get_user_query);
    $get_user_result = $get_user_set->execute(
        array(
            ':id'=>$id
        )
    );

    //TODO: if the execution is successful, return the user data
    // Otherwise, return an error message
    if($get_user_result){
        return $get_user_set;
    }else{
        return 'There was a problem accessing the user';
    }
}

function editUser($id, $fname, $lname, $password, $email){

    $passwordEncryp = md5($password);

    //TODO: set up database connection
    $pdo = Database::getInstance()->getConnection();

     // check user existance
     $check_email_query = 'SELECT COUNT(user_email) AS num FROM tbl_user WHERE user_email = :email AND user_id != :id'; 
     $user_set = $pdo->prepare($check_email_query);
     $user_set->execute(
         array(
             ':email'=>$email,
             ':id'=> $id
         )
     );
 
     

     if($user_set->fetchColumn() == 0){
                //TODO: Run the proper SQL query to update tbl_user with proper values
            $update_user_query = 'UPDATE tbl_user SET user_fname = :fname, user_lname = :lname, user_password=:password, user_email =:email WHERE user_id = :id';
            $update_user_set = $pdo->prepare($update_user_query);
            $update_user_result = $update_user_set->execute(
                array(
                    ':fname'=>$fname,
                    ':lname'=>$lname,
                    ':password'=>$passwordEncryp,
                    ':email'=>$email,
                    ':id'=>$id
                )
            );

            $_SESSION['user_fname'] = $fname;

            // echo $update_user_set->debugDumpParams();
            // exit;

            //TODO: if everything goes well, redirect user to index.php
            // Otherwise, return some error message...
            if($update_user_result){
                redirect_to('./dashboard');
            }else{
                return 'There has been an error. Try again.';
            }
     }else{
        return 'This email already exists in our system. Try using another one.';   
    }

    
}

function editUser2($id, $fname, $lname, $email){

    //TODO: set up database connection
    $pdo = Database::getInstance()->getConnection();

    //TODO: Run the proper SQL query to update tbl_user with proper values
    $update_user_query = 'UPDATE tbl_user SET user_fname = :fname, user_lname = :lname, user_email =:email WHERE user_id = :id';
    $update_user_set = $pdo->prepare($update_user_query);
    $update_user_result = $update_user_set->execute(
        array(
            ':fname'=>$fname,
            ':lname'=>$lname,
            ':email'=>$email,
            ':id'=>$id
        )
    );

    $_SESSION['user_fname'] = $fname;



    // echo $update_user_set->debugDumpParams();
    // exit;

    //TODO: if everything goes well, redirect user to index.php
    // Otherwise, return some error message...
    if($update_user_result){
        redirect_to('./dashboard');
    }else{
        return 'Guess you got canned...';
    }
}


function forgotPassword($email){
    $pdo = Database::getInstance()->getConnection();
    $check_exist_query = 'SELECT COUNT(*) FROM tbl_user WHERE user_email= :email'; // sanitation
    $user_set = $pdo->prepare($check_exist_query);
    $user_set->execute( // sanitation pt2
        array(
            ':email' => $email
        )
    );

    //if email exists...
    if($user_set->fetchColumn()>0){
        //create new hash (for verification)
        $hash = md5(date('l jS \of F Y h:i:s A'));

        $update_user_query = 'UPDATE tbl_user SET user_hash = :hash WHERE user_email = :email';
        $update_user_set = $pdo->prepare($update_user_query);
        $update_user_result = $update_user_set->execute(
            array(
                ':hash'=>$hash,
                ':email'=>$email
            )
        );

        if($update_user_result){


            //send email with new hash

        //mail config
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        $from = 'contact@melangemedia.ca';
        $to = $email;
        $subject = "Reset Password Request | Melange Media Admin Site";
        $message = "



Here is your reset password link for your Melange Media Admin Site.


https://melangemedia.ca/admin/resetpassword?hash=$hash&email=$email






Email is formatted by Reve Solutions. Powered by Titan.
";
        $headers = 'From:'.$from;
        mail($to,$subject,$message,$headers);

                return "An Email has been sent to $email with a link to reset your password.";
            }else{
                return 'Email does not exist in our database.';
            }
            
        }else{
            return 'There has been an error. Try again.';
        }


        
}


function resetUserPassword($hash, $password, $email){

    $pdo = Database::getInstance()->getConnection();

    $check_exist_query = 'SELECT COUNT(*) FROM tbl_user WHERE user_email= :email AND user_hash = :hash'; // sanitation
    $user_set = $pdo->prepare($check_exist_query);
    $user_set->execute( // sanitation pt2
        array(
            ':email'=>$email,
            ':hash'=>$hash
        )
    );

    //if email exists...
    if($user_set->fetchColumn()>0){
        $passwordEncryp = md5($password);


        $update_user_query = 'UPDATE tbl_user SET user_password = :password WHERE user_hash = :hash';
        $update_user_set = $pdo->prepare($update_user_query);
        $update_user_result = $update_user_set->execute(
            array(
                ':hash'=>$hash,
                ':password'=>$passwordEncryp
            )
        );

        
        return "Your Password has been reset. Try logging in. <a class='green' href='./login'>Click here to login</a>";

    }else{
        return 'Your password was not reset. Make sure the url is the same as the link in the email we sent you.';
    }
}





function verifyUser($hash, $email){
    $pdo = Database::getInstance()->getConnection();
    //if db hash = url hash... then update verify column to 1. return message

    $check_exist_query = 'SELECT COUNT(*) FROM tbl_user WHERE user_email= :email'; // sanitation
    $user_set = $pdo->prepare($check_exist_query);
    $user_set->execute( // sanitation pt2
        array(
            ':email' => $email
        )
    );

    //if email exists...
    if($user_set->fetchColumn()>0){

        $check_exist_query = 'SELECT COUNT(*) FROM tbl_user WHERE user_hash= :hash'; // sanitation
        $user_set = $pdo->prepare($check_exist_query);
        $user_set->execute( // sanitation pt2
            array(
                ':hash' => $hash
            )
        );

        //if hash exists...
        if($user_set->fetchColumn()>0){
            // attempting to update verify
            $update_user_query = 'UPDATE tbl_user SET verified = 1 WHERE user_hash = :hash';
            $update_user_set = $pdo->prepare($update_user_query);
            $update_user_result = $update_user_set->execute(
                array(
                    ':hash'=>$hash
                )
            );

            if($update_user_result){
                // redirect_to('index.php');
                return "You account has been verified! <a href='./login'>Click here to login!</a>";
            }else{
                return 'There has been an error verifying your account. Try again.';
            }


    }else{
        return "Your account was not verifed. Make sure you openned the link we sent to $email. <br> <button name='resend' class='button4'>Resend Email</button> ";
    }

            

    }else{
        return 'Nice try... Melange will not be hacked!';
    }

        
    

}

