<?php 
    require_once '../load.php';
    confirm_logged_in();
    confirm_verified();


    $category_tbl = 'tbl_category';
    $categories = getAll($category_tbl);

    //grab the individual blog
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $tbl = 'tbl_blog';
        $col = 'blog_id';
        $getBlog = getSingleBlog($tbl, $col, $id);
    }

    

    // submitting inputted values
    if(isset($_POST['edit'])){
        $blog = array(
            'title'=>trim($_POST['title']),
            'author'=>trim($_POST['author']),
            'subheader'=>trim($_POST['subheader']),
            'date'=>$_POST['date'],
            'published'=>$_POST['published'],
            'category'=>$_POST['category'],
            //'tags'=>$_POST['tags'], 
            'body'=>$_POST['body'], 
            'buttonLink'=>$_POST['buttonLink'], 
            'videoLink'=>$_POST['videoLink'], 
            'tags'=>trim($_POST['tags']), 

            'image'=>$_FILES['image']
        );
        $result = editBlog($blog, $id);
        $message =  $result;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post - Melange Media Admin</title>
    <?php include '../templates/adminHead.php';?>
    <script src="https://cdn.tiny.cloud/1/voc9219x8oy4p5j8ipiznuan5pifw1fv44s4ax5ors8b0v33/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
</head>
<body>

<main id='app'>
<?php include '../templates/adminHeader.php';?>
    <div class="content editProd adminSec">
        

            <?php echo !empty($message)? $message: ''; ?>
            <!-- use enctype multipart/form-data for upload files -->
            <form class='form' action="editblog?id=<?php echo $id ; ?>" method="post" enctype='multipart/form-data' style='max-width: 900px;'>
                <h2 class='headerM'>Edit Post</h2>
                <?php while($info = $getBlog->fetch(PDO::FETCH_ASSOC)): $blogImg = '../images/blog-images/'.$info['blog_image'];?>
                    <label for="">Title</label>
                    <input type="text" name='title' value="<?php echo $info['blog_title']; ?>" maxlength='256' required>
                    
                    <label for="">Author</label>
                    <input type="text" name='author' value="<?php echo $info['blog_author']; ?>" maxlength='64' required>

                    <label for="">Subheader</label>
                    <input type="text" name='subheader' maxlength='256' value="<?php echo $info['blog_subheader']; ?>" required>


                    <label for="">Date</label>
                    <input type="date" name="date" value="<?php echo $info['blog_date']; ?>" maxlength='128' required>

                    

                    <label for="">Blog Category</label>
                    <select name="category" id="category"  required>
                        <!-- <option>Select Category for Blog Post</option> -->
                        <?php while($row = $categories->fetch(PDO::FETCH_ASSOC)): ?>
                            <option value="<?php echo $row['category_id'] ?>"><?php echo $row['category_name']; ?></option>
                        <?php endwhile ; ?>
                    </select>

                    <label>Tags (Seperate tags by ,):</label>
                    <input type="text" name='tags' value="<?php echo $info['blog_tags']; ?>" maxlength='256'>


                    <div class='img thumbnail' style="background-image: url('<?php echo $blogImg; ?>') ;" ></div>
                    
                    <label for=""  required>Post Header Image Upload</label>
                    <input type="file" name="image" id="image">


                    <label for="">Blog Body</label>
                    <textarea style='min-height: 500px;' name="body"><?php echo $info['blog_body']; ?></textarea>

                    <script>
                            tinymce.init({
                            selector: 'textarea',
                            plugins: ' autolink lists media table autoresize image link advlist charmap code',
                            toolbar: 'undo redo | styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image  tablenumlist bullist lists advlist charmap | code',
                            toolbar_mode: 'floating',
                            image_dimensions: false,
                            // toolbar_sticky: true,
                            tinycomments_mode: 'embedded',
                            tinycomments_author: 'Author name',
                            font_formats:
                            "Roboto=Roboto; Arial=arial,helvetica,sans-serif; Arial Black=arial black,Comic Sans MS=comic sans ms,sans-serif; Courier New=courier new,courier; Georgia=georgia,palatino; Helvetica=helvetica; Impact=impact,chicago; Times New Roman=times new roman,times;  Verdana=verdana,geneva;",

                        });

                    
                    </script>

                    <label for="">Embed YouTube Video?</label>
                    <input type="text" name='videoLink' value="<?php echo $info['blog_yt_video']; ?>">

                    <label for="">Link for Button at End of The Post</label>
                    <input type="text" name='buttonLink' value="<?php echo $info['blog_end_link']; ?>">

                    <label>Publish Now?:</label>
                        <select name="published" id="published" required>
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    
                    <?php endwhile;?>
                    <button class='button1' type='submit' name="edit">Save Changes</button>
            </form>

    </div>
    
        <?php include '../templates/adminFooter.php';?>
</main>


</body>
</html>