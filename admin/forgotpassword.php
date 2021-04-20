<?php 
    require_once '../load.php';

    if(isset($_POST['requestpassword'])){
        
        $email = trim($_POST['email']);
        

            $message = forgotPassword($email);
        

        // $message =  $fname.'<br>'.$lname.'<br>'.$email.'<br>'.$password.'<br>';
    }
    
    
    
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password - Melange Media Admin</title>
    <?php include '../templates/adminHead.php';?>
</head>
<body>
<main id='app'>

        <div class="content dashPage adminSec">
                
            

            <?php echo !empty($message)? $message : '';?>
            <form class='form' action="forgotpassword" method="post">
                <h2 class="headerM">Request Password Reset</h2>
                <label for="">Account Email</label>
                <input type="email" name="email" required>
                

                <button type="submit" class='button1' name="requestpassword">Reset Password</button>
            </form>

        </div>

    
    

        
    </main>
    
    
</body>
</html>