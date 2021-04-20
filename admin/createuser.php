<?php 
require_once '../load.php';
confirm_logged_in();
confirm_verified();

$ip = $_SERVER['REMOTE_ADDR'];


if(isset($_POST['createuser'])){
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);

    if(empty($email) || empty($fname)  || empty($lname)|| empty($password)){
        $message = 'please fill require fields';
    }else{
        $message = createuser($fname, $lname,$password, $email, $ip);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Account - Productivy Guys Admin</title>
    <?php include '../templates/adminHead.php';?>
</head>
<body>

<main id='app'>

    <?php include '../templates/adminHeader.php';?>

    <div class="content createUser adminSec">
        

        <?php echo !empty($message)? $message: ''; ?>
        <form class='form' action="createuser" method="post">

            <h2 class='headerM'>Create New Account</h2>

            <label for="">First Name</label>
            <input type="text" name='fname' value='' required>

            <label for="">Last Name</label>
            <input type="text" name='lname' value='' required>

            <label for="">Password</label>
            <input type="text" name='password' value='' required>

            <label for="">Email</label>
            <input type="email" name='email' value='' required>

            <button class='button1' name="createuser">Create Account</button>
        </form>
    </div>
    

    <?php include '../templates/adminFooter.php';?>
</main>

    
</body>
</html>