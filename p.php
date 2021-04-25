
<?php

include_once 'load.php';
$actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if (isset($_GET['id'])) {
    $title = $_GET['title'];
    $id = $_GET['id'];
    $col = 'blog_id';
    $tbl = 'tbl_blog';
    // $col = 'blog_title';
    // $getBlog = getSingleBlogByTitle($tbl, $col, $title);
    $getBlog = getSingleBlog($tbl, $col, $id);
    $getRecommened = getRecommended($title, $id);



    // $banner1 = getRandRes();
}else{
    redirect_to('./error');
}





?>


<?php while($info = $getBlog->fetch(PDO::FETCH_ASSOC)):  $blogImg = 'images/blog-images/'.$info['blog_image'];?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $info['blog_title']; ?> - Melange Media</title>
    <?php include_once 'templates/head.php'; ?>
    <link rel='canonical' href='<?php echo 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>'>
    <!-- social share -->
    <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=60187e4603ca8f0018e4839a&product=inline-share-buttons" async="async"></script>

    <meta name="description" content="<?php echo $info['blog_subheader']; ?>">

    <meta property="og:url"           content="<?php echo $actual_link; ?>" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="<?php echo $info['blog_title']; ?> - Melange Media" />
    <meta property="og:description"   content="<?php echo $info['blog_title']; ?>. Melange Media." />
    <meta property="og:image"         content="https://www.melangemedia.com/images/blog-images/<?php echo $info['blog_image']; ?>" />
</head>
<body>
<main id="app">
<h1 class="hidden"><?php echo $info['blog_title']; ?></h1>

<?php include_once 'templates/header.php'; ?>
    <div class="articlePage">

        <div class="articleDiv">
                                
                        <div class="article">

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

                            
                        </div>

                        <div class="adDiv"></div>

                        

                    
        </div>
    
    <div class="content" style='padding-top: 0;'>
            

        
        <div class="postDiv">
            <h2 class="secHead">Recommended For You</h2>
            <div class="divLine"></div>
            <div class="postList postListRow">
                    <?php while ($row = $getRecommened->fetch(PDO::FETCH_ASSOC)): $blogImg2 = 'images/blog-images/'.$row['blog_image']; ?>
                        <a href='./p?title=<?php echo $row['blog_title']; ?>&id=<?php echo $row['blog_id']; ?>' class="post">
                            <div class="bgimg" style="background-image: url('<?php echo $blogImg2; ?>');"></div>
                            <div class="text">
                                <div class="tags">
                                    <?php $tags = $row['blog_tags']; displayTags($tags);?>
                                </div>

                                <h3 class="title"><?php echo $row['blog_title']; ?></h3>
                                <h4 class="subtitle"><?php echo $row['blog_subheader']; ?></h4>
                                <p class="date"><?php $date2 = $row['blog_date']; convertDate($date2); ?></p>
                            </div>
                        </a>
                    <?php endwhile; ?>
                
            </div>
            <a href="./latest-posts" class="viewMore">View More <div class="img" style="background-image: url('images/icons/arrow-right.svg');"></div></a>


        </div>
        


    </div>

        
        
        
    
</div>

<?php include_once 'templates/footer.php'; ?>
</main>
</body>
</html>
<?php endwhile;?>