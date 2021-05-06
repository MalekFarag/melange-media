<?php

include_once 'load.php';

        $tbl = 'tbl_blog';
        $num = 10;
        $num2 = 5;

        $hero = getAllAvailable($tbl, 1);


        $latest = getAllAvailable($tbl, $num);

        // categories = 2,3,4,5,1

        $art = getAllAvailableByCat($tbl, 2, $num2);
        $ent = getAllAvailableByCat($tbl, 3, $num2);
        $food = getAllAvailableByCat($tbl, 4, $num2);
        $lifestyle = getAllAvailableByCat($tbl, 5, $num2);
        $local = getAllAvailableByCat($tbl, 1, $num2);

        

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Melange Media</title>
    <?php include_once 'templates/head.php'; ?>
    
    <!-- <meta name="description" content=""> -->
</head>
<body>
<main id="app">
<h1 class="hidden">Melange Media - Home</h1>



<?php include_once 'templates/header.php'; ?>
    <div class="content homePage">
        <?php if($hero->rowCount() > 0): ?>
                <?php while ($info = $hero->fetch(PDO::FETCH_ASSOC)): $blogImg = 'images/blog-images/'.$info['blog_image']; ?>

        <div class="heroSec" style="background-image: url('<?php echo $blogImg; ?>');">

            <!-- latest post -->
            <a href='./p?title=<?php echo $info['blog_title']; ?>&id=<?php echo $info['blog_id']; ?>' class="post">
                <!-- <div style="background-image: url('');" class="bgimg desktop"></div>
                <div style="background-image: url('');" class="bgimg mobile"></div> -->
                <div class="bgimg"></div>
                

                <div class="text">
                    <p class="cat underline">Featured</p>
                    <h3 class="title"><?php echo $info['blog_title']; ?></h3>
                    <p class="date"><?php $date = $info['blog_date']; convertDate($date); ?></p>
                </div>
            </a>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>


        <!-- latest posts here 6-->
        <?php if($latest->rowCount() > 0): ?>
        
        <div class="postDiv">
            <h2 class="secHead">Featured</h2>
            <div class="postList">

            <?php while ($info = $latest->fetch(PDO::FETCH_ASSOC)): $blogImg = 'images/blog-images/'.$info['blog_image']; ?>
                <a href='./p?title=<?php echo $info['blog_title']; ?>&id=<?php echo $info['blog_id']; ?>' class="post">
                    <div class="bgimg" style="background-image: url('<?php echo $blogImg; ?>');"></div>
                    <div class="text">
                        <div class="tags">
                            <?php $tags = $info['blog_tags']; displayTags($tags);?>
                        </div>

                        <h3 class="title"><?php echo $info['blog_title']; ?></h3>
                        <h4 class="subtitle"><?php echo $info['blog_subheader']; ?></h4>
                        <p class="date"><?php $date = $info['blog_date']; convertDate($date); ?></p>
                    </div>
                </a>
            <?php endwhile; ?>

            </div>

            <a href="./latest-posts" class="viewMore">View More <div class="img" style="background-image: url('images/icons/arrow-right.svg');"></div></a>
        </div>
        <?php endif; ?>

        <!-- <div class="adDiv"></div> -->


        <!-- latest posts here 6-->
        <?php if($art->rowCount() > 0): ?>
        
        <div class="postDiv">
            <h2 class="secHead">Art</h2>
            <div class="divLine"></div>
            <div class="postList postListRow">

            <?php while ($info = $art->fetch(PDO::FETCH_ASSOC)): $blogImg = 'images/blog-images/'.$info['blog_image']; ?>
                <a href='./p?title=<?php echo $info['blog_title']; ?>&id=<?php echo $info['blog_id']; ?>' class="post">
                    <div class="bgimg" style="background-image: url('<?php echo $blogImg; ?>');"></div>
                    <div class="text">
                        <div class="tags">
                            <?php $tags = $info['blog_tags']; displayTags($tags);?>
                        </div>

                        <h3 class="title"><?php echo $info['blog_title']; ?></h3>
                        <h4 class="subtitle"><?php echo $info['blog_subheader']; ?></h4>
                        <p class="date"><?php $date = $info['blog_date']; convertDate($date); ?></p>
                    </div>
                </a>
            <?php endwhile; ?>

            </div>

            <a href="./art" class="viewMore">View More <div class="img" style="background-image: url('images/icons/arrow-right.svg');"></div></a>
        </div>
        <?php endif; ?>

        <!-- latest posts here 6-->
        <?php if($local->rowCount() > 0): ?>
        
        <div class="postDiv">
            <h2 class="secHead">Local</h2>
            <div class="divLine"></div>
            <div class="postList postListRow">

            <?php while ($info = $local->fetch(PDO::FETCH_ASSOC)): $blogImg = 'images/blog-images/'.$info['blog_image']; ?>
                <a href='./p?title=<?php echo $info['blog_title']; ?>&id=<?php echo $info['blog_id']; ?>' class="post">
                    <div class="bgimg" style="background-image: url('<?php echo $blogImg; ?>');"></div>
                    <div class="text">
                        <div class="tags">
                            <?php $tags = $info['blog_tags']; displayTags($tags);?>
                        </div>

                        <h3 class="title"><?php echo $info['blog_title']; ?></h3>
                        <h4 class="subtitle"><?php echo $info['blog_subheader']; ?></h4>
                        <p class="date"><?php $date = $info['blog_date']; convertDate($date); ?></p>
                    </div>
                </a>
            <?php endwhile; ?>

            </div>

            <a href="./local" class="viewMore">View More <div class="img" style="background-image: url('images/icons/arrow-right.svg');"></div></a>
        </div>
        <?php endif; ?>

        

        <!-- latest posts here 6-->
        <?php if($ent->rowCount() > 0): ?>
            <!-- <div class="adDiv"></div> -->
        
        <div class="postDiv">
            <h2 class="secHead">Entertainment</h2>
            <div class="postList">

            <?php while ($info = $ent->fetch(PDO::FETCH_ASSOC)): $blogImg = 'images/blog-images/'.$info['blog_image']; ?>
                <a href='./p?title=<?php echo $info['blog_title']; ?>&id=<?php echo $info['blog_id']; ?>' class="post">
                    <div class="bgimg" style="background-image: url('<?php echo $blogImg; ?>');"></div>
                    <div class="text">
                        <div class="tags">
                            <?php $tags = $info['blog_tags']; displayTags($tags);?>
                        </div>

                        <h3 class="title"><?php echo $info['blog_title']; ?></h3>
                        <h4 class="subtitle"><?php echo $info['blog_subheader']; ?></h4>
                        <p class="date"><?php $date = $info['blog_date']; convertDate($date); ?></p>
                    </div>
                </a>
            <?php endwhile; ?>

            </div>

            <a href="./entertainment" class="viewMore">View More <div class="img" style="background-image: url('images/icons/arrow-right.svg');"></div></a>
        </div>
        <?php endif; ?>

        


        <!-- latest posts here 6-->
        <?php if($food->rowCount() > 0): ?>
            <!-- <div class="adDiv"></div> -->
        <div class="postDiv">
            <h2 class="secHead">Food</h2>
            <div class="divLine"></div>
            <div class="postList postListRow">

            <?php while ($info = $food->fetch(PDO::FETCH_ASSOC)): $blogImg = 'images/blog-images/'.$info['blog_image']; ?>
                <a href='./p?title=<?php echo $info['blog_title']; ?>&id=<?php echo $info['blog_id']; ?>' class="post">
                    <div class="bgimg" style="background-image: url('<?php echo $blogImg; ?>');"></div>
                    <div class="text">
                        <div class="tags">
                            <?php $tags = $info['blog_tags']; displayTags($tags);?>
                        </div>

                        <h3 class="title"><?php echo $info['blog_title']; ?></h3>
                        <h4 class="subtitle"><?php echo $info['blog_subheader']; ?></h4>
                        <p class="date"><?php $date = $info['blog_date']; convertDate($date); ?></p>
                    </div>
                </a>
            <?php endwhile; ?>

            </div>

            <a href="./food" class="viewMore">View More <div class="img" style="background-image: url('images/icons/arrow-right.svg');"></div></a>
        </div>
        <?php endif; ?>

        <!-- latest posts here 6-->
        <?php if($lifestyle->rowCount() > 0): ?>
        
        <div class="postDiv">
            <h2 class="secHead">Lifestyle</h2>
            <div class="divLine"></div>
            <div class="postList postListRow">

            <?php while ($info = $lifestyle->fetch(PDO::FETCH_ASSOC)): $blogImg = 'images/blog-images/'.$info['blog_image']; ?>
                <a href='./p?title=<?php echo $info['blog_title']; ?>&id=<?php echo $info['blog_id']; ?>' class="post">
                    <div class="bgimg" style="background-image: url('<?php echo $blogImg; ?>');"></div>
                    <div class="text">
                        <div class="tags">
                            <?php $tags = $info['blog_tags']; displayTags($tags);?>
                        </div>

                        <h3 class="title"><?php echo $info['blog_title']; ?></h3>
                        <h4 class="subtitle"><?php echo $info['blog_subheader']; ?></h4>
                        <p class="date"><?php $date = $info['blog_date']; convertDate($date); ?></p>
                    </div>
                </a>
            <?php endwhile; ?>

            </div>

            <a href="./lifestyle" class="viewMore">View More <div class="img" style="background-image: url('images/icons/arrow-right.svg');"></div></a>
        </div>
        <?php endif; ?>

        


        
        
        
</div>


<?php include_once 'templates/footer.php'; ?>
</main>
</body>
</html>
