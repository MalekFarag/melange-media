<?php 

if(isset($_GET['search'])){
    $q = $_GET['q'];


        redirect_to("./search?q=$q");
}


?>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MWWWRS7"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<div class="mainHeader">

    <div class="topBar">
        <div class="subscribe">
            Follow Us
        </div>
        <ul class="social">
            <li><a style="background-image: url('images/icons/instagram.svg');" class='insta' href="https://www.instagram.com/productivityguys/" target="_blank"></a></li>
            <li><a style="background-image: url('images/icons/linkedin.svg');" class='linkedin' href="https://www.linkedin.com/company/76425555" target="_blank"></a></li>
            <li><a style="background-image: url('images/icons/facebook.svg');" class='fb' href="https://www.facebook.com/productivityguys" target="_blank"></a></li>
            <li><a style="background-image: url('images/icons/twitter.svg');" class='twitter' href="https://twitter.com/ProductivityAfl" target="_blank"></a></li>
        </ul>

        
    </div>

    <div class="head">
        <div class="logoBurger">

                <!-- search for article -->
            <div @click='openSearch()' class='searchIcon img'></div>

            <!-- logo -->
            <a href='./' class="img mainLogo"></a>



            <div @click='toggleBurger()' class='burger'  v-bind:class="[isBurger ? '' : 'burgerOn']">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>

        <nav class="mainNav"   v-bind:class="[isBurger ? '' : 'navOn']">
            <ul class="navList">
                
                <li><a href="./latest-posts">Latest Posts</a></li>


                <li><a href="./about">About Us</a></li>

            </ul>
        </nav>

        <form class="searchHead" v-bind:class="[isSearch ? '' : 'searchOn']" method='GET'>
            <input name='q' type="text" class="text" v-model='query' placeholder='Search...'>
            <button name='search'><div class="img"></div><button>
        </form>
        
        
        
    </div>

</div>
