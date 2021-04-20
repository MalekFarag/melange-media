<?php 
    require_once '../load.php';
    confirm_logged_in();
    confirm_verified();



    //grab the individual post
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $tbl = 'tbl_resources';
        $col = 'res_id';
        $getBlog = getSingleBlog($tbl, $col, $id);
    }

    // submitting inputted values
    if(isset($_POST['delete'])){

        $message = deleteRes($id);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Resource? - Productivy Guys Admin</title>
    <?php include '../templates/adminHead.php';?>
</head>
<body>


<main id='app'>
<?php include '../templates/adminHeader.php';?>
    <div class="content delProd adminSec">
        <h2 class='headerM'>Delete Resource</h2>

        <?php echo !empty($message)? $message : '';?>

        <?php if($getBlog->rowCount() > 0): ?>
            <?php while ($info = $getBlog->fetch(PDO::FETCH_ASSOC)): $resImg = '../images/res-images/'.$info['res_image']; ?>

                <div class="banner">
                    <div class="info">
                        <div class="img" style='background-image: url(<?php echo $resImg; ?>);'></div>
                        <div class="text">
                            <h4 class="title"><?php echo $info['res_title']; ?></h4>
                            <p class="subheader"><?php echo $info['res_subheader']; ?></p>
                            <a href="<?php echo $info['res_link']; ?>" target='_blank' class="button1">Click Here</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
        
                
            <form class='resource' action="deleteresource?id=<?php echo $id ; ?>" method="post">        
                <button name='delete' class='button1'>Delete Resource</button>
            </form>

    </div>
</div>

    <?php include '../templates/adminFooter.php';?>
</main>


</body>
</html>