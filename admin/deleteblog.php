<?php 
    require_once '../load.php';
    confirm_logged_in();
    confirm_verified();



    //grab the individual post
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $tbl = 'tbl_blog';
        $col = 'blog_id';
        $getBlog = getSingleBlog($tbl, $col, $id);
    }

    // submitting inputted values
    if(isset($_POST['delete'])){

        $message = deleteBlog($id);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Post? - Melange Media Admin</title>
    <?php include '../templates/adminHead.php';?>
</head>
<body>


<main id='app'>
<?php include '../templates/adminHeader.php';?>
    <div class="content delProd adminSec" style='min-height: auto;'>
        <h2 class='headerM'>Delete Post</h2>

        <?php echo !empty($message)? $message : '';?>
    </div>

        <div class="articlePage">
        <div class="articleDiv">
            <div class="article">
                    <?php while($info = $getBlog->fetch(PDO::FETCH_ASSOC)):  $blogImg = '../images/blog-images/'.$info['blog_image'];?>

                        <div class="reset">
                            <div class="pub" style='font-size: x-large;'>
                                <?php if($info['blog_published'] == 1){
                                    echo 'Published';
                                }else{
                                    echo 'Not Published';
                                } ?>
                            </div>


                            <?php  if(!empty($info['blog_image'])): ?>
                                    <div class="headImg img" style="background-image: url('<?php echo $blogImg; ?>');"></div>
                                <?php endif; ?>

                            <?php  if(!empty($info['blog_tags'])): ?>
                                <div class="tags">
                                    <?php $tags = $info['blog_tags']; displayTags2($tags);?>
                                </div>
                            <?php endif; ?>

                            <div class="catDate">
                                <span class="cat"><?php getCategory($info['blog_category']); ?></span> <span class="date"><?php $date = $info['blog_date']; convertDate($date); ?></span>
                            </div>
                            
                            <h2 class='headerL'><?php echo $info['blog_title']; ?></h2>
                            
                            <h3 class="headerS">By <?php echo $info['blog_author']; ?></h3>
                            
                            <!-- <div class="shareDiv">
                                <div class="sharethis-inline-share-buttons"></div>
                            </div> -->

                            <div class="divLine"></div>


                            

                        
                            <!-- need body styling -->
                            <?php  if(!empty($info['blog_body'])): ?>
                                
                                <div class="articleBody">

                                    
                                    <?php echo $info['blog_body']; ?>
                                </div>
                            <?php endif; ?>

                        

                            

                            <?php  if(!empty($info['blog_end_link'])): ?>
                                <div class="endLinkDiv">
                                    <!-- <h3 class="headerS">Link</h3> -->
                                    <a target='_blank' href="<?php echo $info['blog_end_link']; ?>" class="button1">Click Here</a>
                                </div>
                            <?php endif; ?>

                    <?php endwhile;?>
                </div>
        </div>
        
        </div>
        
                
        <form class='form' action="deleteblog?id=<?php echo $id ; ?>" method="post">
            <button name='delete' class='button1'>Delete Blog Post</button>
        </form>

</div>

    <?php include '../templates/adminFooter.php';?>
</main>


</body>
</html>