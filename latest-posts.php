<?php

include_once 'load.php';

        $tbl = 'tbl_blog';


        $hero = getAllAvailable($tbl, 1);


        $latest = getAllAvailable($tbl, 999);

        

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Latest Posts - Melange Media</title>
    <?php include_once 'templates/head.php'; ?>
    
    <meta name="description" content="">
</head>
<body>
<main id="app">
<h1 class="hidden">Latest Posts</h1>



<?php include_once 'templates/header.php'; ?>
    <div class="content homePage">
        <?php if($hero->rowCount() > 0): ?>
        <div class="heroSec">

            <!-- latest post -->
        <?php while ($info = $hero->fetch(PDO::FETCH_ASSOC)): $blogImg = 'images/blog-images/'.$info['blog_image']; ?>
            <a href='./p?title=<?php echo $info['blog_title']; ?>&id=<?php echo $info['blog_id']; ?>' class="post">
                <!-- <div style="background-image: url('');" class="bgimg desktop"></div>
                <div style="background-image: url('');" class="bgimg mobile"></div> -->
                <div class="bgimg" style="background-image: url('<?php echo $blogImg; ?>');"></div>
                

                <div class="text">
                    <h3 class="title"><?php echo $info['blog_title']; ?></h3>
                    <h4 class="subtitle"><?php echo $info['blog_subheader']; ?></h4>
                    <p class="date">By <?php echo $info['blog_author']; ?>. <?php $date = $info['blog_date']; convertDate($date); ?></p>
                </div>
            </a>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>


        <!-- latest posts here 6-->
        <?php if($latest->rowCount() > 0): ?>
        <div class="postDiv">
            <h2 class="secHead">Latest Posts</h2>
            <div class="postList" style='overflow: auto; flex-wrap: wrap; justify-content: center; '>

            <?php while ($info = $latest->fetch(PDO::FETCH_ASSOC)): $blogImg = 'images/blog-images/'.$info['blog_image']; ?>
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

            <!-- <a href="./latest-posts" class="viewMore">View More <div class="img" style="background-image: url('images/icons/arrow-right.svg');"></div></a> -->
        </div>
        <?php endif; ?>

</div>


<?php include_once 'templates/footer.php'; ?>
</main>
</body>
</html>