<?php

include_once 'load.php';

        $tbl = 'tbl_blog';

        
        

        if(isset($_GET['q'])){

            $query = $_GET['q'];
            $getBlogs = searchPubByTerm($query);
            
        }else{
            $query = '';
        }
        


        
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php if(isset($_GET['q'])){ echo $_GET['q'].' Posts';}else{ echo 'Search';}  ?> - Productivity Guys</title>
    <?php include_once 'templates/head.php'; ?>
    
    <meta name="description" content="Search posts. Learn about digital marketing, design, coding, & everything productivity. Productivity Guys blog is here to help entrepreneurs exapand their skillset and improve.">
</head>
<body>
<main id="app">
<h1 class="hidden"><?php if(isset($_GET['q'])){ echo $_GET['q'].' Posts';}else{ echo 'Search';}  ?></h1>



<?php include_once 'templates/header.php'; ?>

    <div class="content searchPage">
    <h2 class="headerM"><?php if(isset($_GET['q'])){ echo $_GET['q'].' Posts';}else{ echo 'Search For Posts';}  ?></h2>

    <form class="searchBar" method='GET'  style='padding-bottom: 100px'>
            <input name='q' type="text" class="text" placeholder='Search...' required>
            <button name='search'><div class="img"></div></button>
    </form>


    <!-- latest posts here 6-->
    <?php 
    if(isset($_GET['q'])):
    
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



       
    </div>


<?php include_once 'templates/footer.php'; ?>
</main>
</body>
</html>