<?php 
    require_once '../load.php';

    
    $hash = $_GET['hash'];
    $email = $_GET['email'];

    if(!empty($hash)){
        $message = verifyUser($hash, $email);
    }else{
        $message = redirect_to('login');
    }

    if(isset($_POST['resend'])){
        $message = resendVerify($email, $hash);
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veryifying User... - Melange Media Admin</title>
    <?php include '../templates/adminHead.php';?>
</head>
<body>


<main id='app'>

    <div class="content userEdit adminSec">

        <h2 class="headerM"><?php echo !empty($message)? $message: ''; ?></h2>
        
        
        
</main>
    
</body>
</html>