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
    <title>Thank You - Melange Media</title>
    <?php include_once 'templates/head.php'; ?>
    
    <!-- <meta name="description" content="Productivity. Learn More."> -->
</head>
<body>
<main id="app">
<h1 class="hidden">Melange Media - Sent</h1>



<?php //include_once 'templates/header.php'; ?>
    <div class="content sentPage">
        <div class="sentMsg">
            <h2 class="headerL" style='margin-top: 0;'>We Got Your Message :)</h2>
            <p class="headerS">We'll Have a look and reach out to you soon!</p>

            
        
            <span class='italic'><a href="./">Click to go back to the main site</a></span>
        </div>
        

        
    </div>


<?php include_once 'templates/footer.php'; ?>
</main>
</body>
</html>
