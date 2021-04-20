<?php 
require_once '../load.php';
confirm_logged_in();
confirm_verified();

//grab the individual blog
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $tbl = 'tbl_resources';
    $col = 'res_id';
    $getBlog = getSingleBlog($tbl, $col, $id);
}


if(isset($_POST['edit_res'])){

    
        $resource = array(
            'title'=>trim($_POST['title']),
            'author'=>trim($_POST['author']),
            'subheader'=>trim($_POST['subheader']),
            'date'=>$_POST['date'],
            'published'=>$_POST['published'],
            'link'=>$_POST['link'], 

            'tags'=>trim($_POST['tags']), 

            'image'=>$_FILES['image']
        );
    

    

        $result = editRes($resource, $id);
        $message =  $result;

        
    
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Resource - Productivy Guys Admin</title>
    <?php include '../templates/adminHead.php';?>
</head>
<body>




<main id='app'>
<?php include '../templates/adminHeader.php';?>


    <div class="content createProd adminSec">


        

            <?php echo !empty($message)? $message: ''; ?>
            <!-- use enctype multipart/form-data for upload files -->
            <form class='form' action="editresource?id=<?php echo $id ; ?>" method="post" enctype='multipart/form-data' style='max-width: 900px;'>
                <h2 class='headerM'>Edit Resource</h2>
                <?php while($info = $getBlog->fetch(PDO::FETCH_ASSOC)): $blogImg = '../images/res-images/'.$info['res_image'];?>
                    <label for="">Title</label>
                    <input type="text" name='title' value="<?php echo $info['res_title']; ?>" maxlength='256' required>
                    
                    <label for="">Author</label>
                    <input type="text" name='author' value="<?php echo $info['res_author']; ?>" maxlength='64' required>

                    <label for="">Subheader / Description</label>
                    <textarea name="subheader" required><?php echo $info['res_subheader']; ?></textarea>


                    <label for="">Date</label>
                    <input type="date" name="date" value="<?php echo $info['res_date']; ?>" required>

                    <label>Tags (Seperate tags by ,):</label>
                    <input type="text" name='tags' class="text" maxlength='256' value="<?php echo $info['res_tags']; ?>">

                    <!-- file upload needs config -->
                    <label for="">Post Header Image Upload</label>
                    <input type="file" name="image" id="image">



                    <label for="">Resource Link</label>
                    <input type="text" name='link' value="<?php echo $info['res_link']; ?>" required>

                    <label>Publish Now?:</label>
                        <select name="published" id="published" required>
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                
                <?php endwhile ; ?>
                <button class='button1' type='submit' name="edit_res">Save Changes</button>
            </form>

    </div>
    

    <?php include '../templates/adminFooter.php';?>
</main>


    
</body>
</html>