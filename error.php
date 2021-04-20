<?php

include_once 'load.php';

        $title = 'error';
        $id ='0';


        $hero = getRecommended($title, $id);
        

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Error 404 - Productivity Guys</title>
    <?php include_once 'templates/head.php'; ?>
    
    <meta name="description" content="Productivity. Learn More.">
</head>
<body>
<main id="app">
<h1 class="hidden">Productivity Guys - Error 404</h1>



<?php //include_once 'templates/header.php'; ?>
    <div class="content sentPage">
        <div class="sentMsg">
            <h2 class="headerL" style='margin-top: 0;'>Looks Like This Content Isn't Available...</h2>
            <p class="headerS">Error 404: Page Not Found</p>

            
            <div class="postDiv">
                <h3 class="headerM">Here's a few Posts We Think You'd Like :)</h3>
                <div class="postList">
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
            </div>

            <span class='italic'><a href="./">Or you can to go back to the main site by clicking here</a></span>
        </div>
        

        
    </div>


<?php include_once 'templates/footer.php'; ?>
</main>
</body>
</html>
