<?php 
    require_once '../load.php';

    
        
        if(empty($_GET['hash'] AND $_GET['email'])){
            $hash = '';
            $email= '';

            }else{
                $hash = $_GET['hash'];
                $email = $_GET['email'];
            }
        



    // if(empty($hash OR $email)){
    //     redirect_to('admin_login.php');
    // }
        if(isset($_POST['edit_user'])){
            $password = trim($_POST['user_password']);
        
            $message = resetUserPassword($hash, $password, $email);
        }


        
    
    

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password - Melange Media Admin</title>
    <?php include '../templates/adminHead.php';?>
</head>
<body>


    <main id='app'>

        <div class="content userEdit adminSec">
            
            <!-- <p class='subhead'>If this is your first time logging in, please update your password or any other detail to verify your account and gain access to the rest of the site.</p> -->
            

            
                <?php echo !empty($message)? $message : '';?>
            <form class='form' action="resetpassword?hash=<?php echo $hash ; ?>&email=<?php echo $email ; ?>" method="post">
                    <h2 class='headerM'>Reset Password</h2>
                    <h3 class='headerSmall'>Account Email:</h3>
                    <h4 class='description'><?php echo $email; ?></h4>
                    
                    <label>New Password:</label>
                    <input type="text" name="user_password">

                    
                
                <button class='button4' name="edit_user">Update Password</button>
            </form>


        </div>

        
     
    </main>
    
</body>
</html>