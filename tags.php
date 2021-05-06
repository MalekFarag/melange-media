<?php

include_once 'load.php';

    if(isset($_GET['t'])){
        $tag = $_GET['t'];
        
        $num = 99;

        $getBlogs = searchByTag($tag, $num);
        
    }

    $displayRandomTags = displayRandTags();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php if(isset($_GET['t'])){ echo $_GET['t'].' Posts';}else{ echo 'Search';}  ?> - Productivity Guys</title>
    <?php include_once 'templates/head.php'; ?>
    
    <!-- <meta name="description" content="Search by tags. Learn about digital marketing, design, coding, & everything productivity. Productivity Guys blog is here to help entrepreneurs exapand their skillset and improve."> -->
</head>
<body>
<main id="app">
<h1 class="hidden"><?php if(isset($_GET['t'])){ echo $_GET['t'].' Posts';}else{ echo 'Search';}  ?> - Productivity Guys</h1>



<?php include_once 'templates/header.php'; ?>

    <div class="content searchPage">
    <h2 class="headerM"><?php if(isset($_GET['t'])){ echo $_GET['t'].' Tagged Posts';}else{ echo 'Checkout These Tags';}  ?></h2>

    


    <!-- latest posts here 6-->
    <?php 
    if(isset($_GET['t'])):
    
    if($getBlogs->rowCount() > 0): ?>
        
        <div class="postDiv">
            <div class="postList">

            <?php while ($info = $getBlogs->fetch(PDO::FETCH_ASSOC)): $blogImg = 'images/blog-images/'.$info['blog_image']; ?>
                <a href='./p?title=<?php echo $info['blog_title']; ?>&id=<?php echo $info['blog_id']; ?>' class="post">
                    <div class="bgimg" style="background-image: url('<?php echo $blogImg; ?>');"></div>
                    <div class="text">
                        <div class="tags">
                            <?php $tags = $info['blog_tags']; displayTags($tags);?>
                        </div>

                        <h3 class="title"><?php echo $info['blog_title']; ?></h3>
                        <h4 class="subtitle"><?php echo $info['blog_subheader']; ?></h4>
                        <p class="date">By <?php echo $info['blog_author']; ?>. <?php $date = $info['blog_date']; convertDate($date); ?></p>
                    </div>
                </a>
            <?php endwhile; ?>
            </div>
        </div>
        <?php elseif($getBlogs->rowCount() == 0): ?>
                
            <h3 class="headerS" style='margin-bottom: 0; padding-bottom: 300px'>No Posts Match This Search</h3>

        <?php  endif; endif;?>

        <div class="recommededDiv">
            <div class="recommendedTags">
                <?php while ($info = $displayRandomTags->fetch(PDO::FETCH_ASSOC)): ?>
                    
                    <?php  if(!empty($info['blog_tags'])): ?>
                        
                            <?php $tags = $info['blog_tags']; displayTags2($tags);?>
                        
                    <?php endif; ?>
                                
                <?php endwhile; ?>
            </div>

        </div>

    </div>


<?php include_once 'templates/footer.php'; ?>
</main>
</body>
</html>