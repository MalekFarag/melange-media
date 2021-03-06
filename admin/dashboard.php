<?php 
    require_once '../load.php';
    confirm_logged_in();
    confirm_verified();

    // if (isset($_GET['filter'])) {
    //     $args = array(
    //         'tbl' => 'tbl_blog',
    //         'tbl2' => 'tbl_category',
    //         'tbl3' => 'tbl_blog_category',
    //         'col' => 'blog_id',
    //         'col2' => 'category_id',
    //         'col3' => 'category_name',
    //         'filter' => $_GET['filter'],
    //     );
    //     $currentFilter =  $_GET['filter'];
    //     $getBlogs = getBlogsByCategory($args);

    if (isset($_POST['search'])){

        $term = $_POST['t'];

        $currentFilter = $term.' Posts';
            
        $getBlogs = searchByTerm($term);
    } else {
        $term = '';
        $blog_table = 'tbl_blog';
        $getBlogs = getAllBlogs($blog_table);
        $currentFilter = 'All Posts';
    }

    
    
    
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard - Melange Media Admin</title>
    <?php include '../templates/adminHead.php';?>
</head>
<body>
<main id='app'>
    <?php include '../templates/adminHeader.php';?>
        <div class="content dashPage adminSec">
                <!-- <nav class="blogFilter">
                    <ul class="blogList">
                        <a href="index.php">All Posts</a>
                        <a href="index.php?filter=Articles">Articles</a>
                    </ul>
                </nav> -->


                <h2 class='headerL currentFilter'><?php echo $currentFilter; ?></h2>

                <form id='searchBar' action="dashboard" method="post">
                    <input placeholder='Search Post...' type="text" name='t' value="<?php if($term != ''){ echo $term;}?>" required >
                    <button name='search'><div class="img"></div></button>
                </form>

                <?php if($term != ''): ?>
                    <form action="dashboard" method="post">
                        <button style='font-size: small;' class='button1'>Show All Posts</button>
                    </form>
                <?php endif; ?>


                <div class="blogWrap">
                    <?php while ($row = $getBlogs->fetch(PDO::FETCH_ASSOC)): $blogImg = '../images/blog-images/'.$row['blog_image']; ?>
                        <div class="blogItem">
                                <div class='img' style="background-image: url('<?php echo $blogImg; ?>') ;" ></div>
                                <div class="info">
                                    
                                    <h3 class="headerS"><?php echo $row['blog_title']; ?></h3>
                                    <h4 class="description italic">By <?php echo $row['blog_author']; ?>. <?php $date = $row['blog_date']; convertDate($date); ?></h4>
                                    
                                </div>
                                
                                <div class="options">
                                    <div class="pub">
                                        <?php if($row['blog_published'] == 1){
                                                echo 'Published <div class="img" style="background-image: url(../images/icons/done2.svg);"></div>';
                                            }else{
                                                echo 'Not Published <div class="img" style="background-image: url(../images/icons/close.svg);"></div>';
                                            } ?>
                                    </div>
                                    
                                    <a href="editblog?id=<?php echo $row['blog_id']; ?>" class="edit">Edit Post</a>
                                    <a href="deleteblog?id=<?php echo $row['blog_id']; ?>" class="delete">Delete Post</a>
                                    
                                </div>
                                
                        </div>  
                    <?php endwhile; ?>
                </div>


                

                


        </div>

    
    
    <?php include '../templates/adminFooter.php';?>
        
    </main>
    
    
</body>
</html>