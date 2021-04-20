<?php 
require_once '../load.php';
confirm_logged_in();
confirm_verified();




if(isset($_POST['post_res'])){

    
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
    

    

        $result = createRes($resource);
        $message =  $result;

        
    
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Resource - Productivy Guys Admin</title>
    <?php include '../templates/adminHead.php';?>
</head>
<body>




<main id='app'>
<?php include '../templates/adminHeader.php';?>


    <div class="content createProd adminSec">


        

            <?php echo !empty($message)? $message: ''; ?>
            <!-- use enctype multipart/form-data for upload files -->
            <form class='form' action="createresource" method="post" enctype='multipart/form-data' style='max-width: 900px;'>
                <h2 class='headerM'>Create Resouce</h2>
                <p class="description">Do not use here: # </p>
                <label for="">Title</label>
                <input type="text" name='title' maxlength='256' required>
                
                <label for="">Author</label>
                <input type="text" name='author' maxlength='64' required>

                <label for="">Subheader / Description</label>
                <textarea name="subheader" required></textarea>


                <label for="">Date</label>
                <input type="date" name="date" required>

                <label>Tags (Seperate tags by ,):</label>
                <input type="text" name='tags' class="text" maxlength='256'>

                <!-- file upload needs config -->
                <label for="">Post Header Image Upload</label>
                <input type="file" name="image" id="image">



                <label for="">Resource Link</label>
                <input type="text" name='link' required>

                <label>Publish Now?:</label>
                    <select name="published" id="published" required>
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                

                <button class='button1' type='submit' name="post_res">Create Resource</button>
            </form>

    </div>
    

    <?php include '../templates/adminFooter.php';?>
</main>


    
</body>
</html>