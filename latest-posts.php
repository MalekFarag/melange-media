<?php

include_once 'load.php';

        $tbl = 'tbl_blog';


        $hero = getAllAvailable($tbl, 1);


        $latest = getAllAvailable($tbl, 999);
        $banner1 = getRandRes();
        

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Latest Posts - Productivity Guys Blog</title>
    <?php include_once 'templates/head.php'; ?>
    
    <meta name="description" content="Latest posts. Learn about digital marketing, design, coding, & everything productivity. Productivity Guys blog is here to help entrepreneurs exapand their skillset and improve.">
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


        <?php if($banner1->rowCount() > 0): ?>
            <?php while ($info = $banner1->fetch(PDO::FETCH_ASSOC)): $resImg = 'images/res-images/'.$info['res_image']; ?>

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

        <div class="formDiv" style='margin: 40px auto; margin-bottom: 0; padding-bottom: 40px; max-width: 424px;'>
                <div class="sender-form-field" data-sender-form-id="kkubb7vc6157pteji"></div>
            </div>
</div>


<?php include_once 'templates/footer.php'; ?>
</main>
</body>
</html>