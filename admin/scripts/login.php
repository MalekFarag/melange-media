<?php 

function login($email, $password, $ip){
    //Debug
    // $message = sprintf('You are trying to login with email %s and password %s', $email, $password);

    $pdo = Database::getInstance()->getConnection();

    // check user existance0
    $check_exist_query = 'SELECT COUNT(*) FROM tbl_user WHERE user_email= :email'; // sanitation
    $user_set = $pdo->prepare($check_exist_query);
    $user_set->execute( // sanitation pt2
        array(
            ':email' => $email,
        )
    );

    if($user_set->fetchColumn()>0){
        //encrypting password
        $passwordEncryp = md5($password);

        //user exist
        $get_user_query = 'SELECT * FROM tbl_user WHERE user_email = :email AND user_password = :password';

        $user_check = $pdo->prepare($get_user_query);
        $user_check->execute(
            array(
                ':email'=>$email,
                ':password'=>$passwordEncryp,
            )
        );

        
    while($found_user = $user_check->fetch(PDO::FETCH_ASSOC)){

        // login successful
        $message = 'logged in successfully!';
        $_SESSION['user_id'] = $found_user['user_id'];
        $_SESSION['user_fname'] = $found_user['user_fname'];
        // updating database
        $update_query = 'UPDATE tbl_user SET user_ip = :ip WHERE user_id = :id';
        $update_set = $pdo->prepare($update_query);
        $update_set->execute(
                array(
                    ':ip'=>$ip,
                    ':id'=>$found_user['user_id']
                )

        );
    }
    redirect_to('./dashboard');
    // if(isset($found_user['user_id'])){
    //     
    // }

    }else{
        //user doesn't exit
        return 'user doesnt exists';
    }
}

function confirm_logged_in(){
    if(!isset($_SESSION['user_id'])){
        redirect_to('./login');
    }
}

function logout(){
    session_destroy();
    redirect_to('./login');
}

function confirm_verified(){
    $pdo = Database::getInstance()->getConnection();
        //getting user virification status
            $user_verify_query = 'SELECT * FROM tbl_user WHERE user_id = :id';
            $user_verify_set = $pdo->prepare($user_verify_query);
            $user_verify_set->execute(
                array(
                    ':id'=>$_SESSION['user_id']
                )    
            );

            $verified = $user_verify_set->fetch(PDO::FETCH_ASSOC);

        // checking if user is verified... if not, redirect 
        if($verified['verified'] == '0'){
            redirect_to('./verify');
        }
}