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
    <title>Delete Post? - Productivy Guys Admin</title>
    <?php include '../templates/adminHead.php';?>
</head>
<body>


<main id='app'>
<?php include '../templates/adminHeader.php';?>
    <div class="content delProd adminSec">
        <h2 class='headerM'>Delete Post</h2>

        <?php echo !empty($message)? $message : '';?>
    </div>

        
                <div class="article">
                    <?php while($info = $getBlog->fetch(PDO::FETCH_ASSOC)):  $blogImg = '../images/blog-images/'.$info['blog_image'];?>

                        <div class="reset">
                            <div class="pub">
                                <?php if($info['blog_published'] == 1){
                                    echo 'Published <i class="fas fa-check-square green"></i>';
                                }else{
                                    echo 'Not Published <i class="fas fa-window-close"></i>';
                                } ?>
                            </div>


                            <?php  if(!empty($info['blog_tags'])): ?>
                                <div class="tags">
                                    <?php $tags = $info['blog_tags']; displayTags($tags);?>
                                </div>
                            <?php endif; ?>

                            <h2 class='headerMedium'><?php echo $info['blog_title']; ?></h2>

                            <h3 class="subhead">By <?php echo $info['blog_author']; ?>. <?php $date = $info['blog_date']; convertDate($date); ?></h3>
                            
                            

                            <div class="divLine"></div>
                            

                            <?php  if(!empty($info['blog_image'])): ?>
                                <div class="img" style="background-image: url('<?php echo $blogImg; ?>');"></div>
                            <?php endif; ?>

                            
                            
                            
                    

                            <?php  if(!empty($info['blog_yt_video'])): ?>
                                <div class="ytVideo">
                                    <iframe width="100%" height="100%" src="https://www.youtube.com/embed/<?php $url = $info['blog_yt_video']; getYTID($url);?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                            <?php endif; ?>

                            
                        </div>
                        


                        <!-- need body styling -->
                        <?php  if(!empty($info['blog_body'])): ?>
                            <div class="articleBody">

                                
                                <?php echo $info['blog_body']; ?>
                            </div>
                        <?php endif; ?>

                        <div class="reset">

                            <?php  if(!empty($info['blog_end_link'])): ?>
                                <div class="endLinkDiv">
                                    <h3 class="subhead">Checkout My Recommended Link</h3>
                                    <a target='_blank' href="<?php echo $info['blog_end_link']; ?>" class="button3">Click Here</a>
                                </div>
                            <?php endif; ?>
                        </div>

                    <?php endwhile;?>
                </div>
        <form class='form' action="deleteblog?id=<?php echo $id ; ?>" method="post">
            <button name='delete' class='button1'>Delete Blog Post</button>
        </form>

</div>

    <?php include '../templates/adminFooter.php';?>
</main>


</body>
</html>