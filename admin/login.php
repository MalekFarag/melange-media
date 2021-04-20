<?php 
    require_once '../load.php';

    $ip = $_SERVER['REMOTE_ADDR'];

    if(isset($_POST['login'])){
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        if(!empty($email) && !empty($password)){
            //Log user in
            $message = login($email, $password, $ip);
        }else{
            $message = 'Please fill out the required field';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Productivy Guys Admin</title>
    <?php include '../templates/adminHead.php';?>
</head>
<body>
    <main id='app'>
        <div class="content loginPage adminSec">
            <div class="info">
                
                <?php echo !empty($message)? $message: ''; ?>
                <form class='form' action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="img" style='background-image: url(../images/brand/logo-icon.svg); height: 50px; width: 100%; margin: 0px auto;'></div>

                    <h2 class='headerM'>Login Page</h2>
                    <label for="email">Email:</label>
                    <input type="text" name="email" id="email">

                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password">

                    <button class='button1' name="login">Login</button>

                    <a style='margin-top: 20px;' href="./forgotpassword">Forgot Password?</a>

                    <a href="../">Back to main site</a>
                </form>


                
            </div>


        </div>
        
        
    </main>
    
</body>
</html>