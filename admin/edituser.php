<?php 
    require_once '../load.php';
    confirm_logged_in();

    $id = $_SESSION['user_id'];
    $user = getSingleUser($id);

    if(is_string($user)){
        $message = $user;
    }

    if(isset($_POST['edit_user'])){
        
        $fname = trim($_POST['fname']);
        $lname = trim($_POST['lname']);
        $password = trim($_POST['password']);
        $email = trim($_POST['email']);

        if(empty($password)){
            $message = editUser2($id, $fname, $lname, $email);
        }else{
            $message = editUser($id, $fname, $lname, $password, $email);
        } 

        // $message =  $fname.'<br>'.$lname.'<br>'.$email.'<br>'.$password.'<br>';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Current Account - Productivy Guys Admin</title>
    <?php include '../templates/adminHead.php';?>
</head>
<body>


    <main id='app'>
    <?php include '../templates/adminHeader.php';?>
        <div class="content userEdit adminSec">
            
            <!-- <p class='subhead'>If this is your first time logging in, please update your password or any other detail to verify your account and gain access to the rest of the site.</p> -->
            <?php echo !empty($message)? $message : '';?>
            <form class='form' action="edituser" method="post">
            <h2 class='headerM'>Edit Current Account</h2>
            <?php while($info = $user->fetch(PDO::FETCH_ASSOC)): ?>
                    <label>First Name:</label>
                    <input type="text" name="fname" value="<?php echo $info['user_fname'];?>" required>

                    <label>Last Name:</label>
                    <input type="text" name="lname" value="<?php echo $info['user_lname'];?>" required>

                    <label>Email:</label>
                    <input type="email" name="email" value="<?php echo $info['user_email'];?>" required>
                    
                    <label>Password: <br><span class='subhead'>leave blank to keep current password</span></label>
                    <input type="text" name="user_password">

                    
                <?php endwhile;?>
                <button type="submit" class='button1' name="edit_user">Edit Account</button>
            </form>

        </div>

        
        <?php include '../templates/adminFooter.php';?>
    </main>
    
</body>
</html>