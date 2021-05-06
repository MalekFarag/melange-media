<?php

include_once 'load.php';

        

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>About Us - Melange Media</title>
    <?php include_once 'templates/head.php'; ?>
    
    <!-- <meta name="description" content=""> -->
</head>
<body>
<main id="app">
<h1 class="hidden">About Melange Media</h1>



<?php include_once 'templates/header.php'; ?>
    <div class="content aboutPage">
        <h2 class="headerL" style='margin-top: 0; padding-top: 120px;'>What is Melange?</h2>

        <div class="info">
            <div class="img" style="background-image: url('images/brand/logo-ver-text.svg');"></div>
            <div class="text">
                <h3 class="headerM">Our Mission</h3>
                <p class="description">To give a voice to the people & strengthen the community through the melange
                </p>
            </div>
        </div>



        <div class="forms">
            <form action="about" class="form" method='post'>    
                <h2 class="headerM">Contact Us</h2>
                <!-- <p class="description">Have a question? Feel free to send it to us. We're here to help :)</p> -->

                <label for="">Name</label>
                <input type="text" name='customerName'>

                <label for="">Email</label>
                <input type="text" name='customerEmail'>


                <label for="">Message</label>
                <textarea type="text" name='customerMessage'></textarea>

                <button name='contact' class="button1" style='width: 60%; margin: 30px auto;'>Send</button>
            </form>
        </div>
        
        
</div>


<?php include_once 'templates/footer.php'; ?>
</main>
</body>
</html>