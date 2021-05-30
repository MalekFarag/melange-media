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
        <a class="subscribe">
            London, ON
        </a>
        <!-- <ul class="social">
            <li><a style="background-image: url('images/icons/instagram.svg');" class='insta' href="https://www.instagram.com/productivityguys/" target="_blank"></a></li>
            <li><a style="background-image: url('images/icons/linkedin.svg');" class='linkedin' href="https://www.linkedin.com/company/76425555" target="_blank"></a></li>
            <li><a style="background-image: url('images/icons/facebook.svg');" class='fb' href="https://www.facebook.com/productivityguys" target="_blank"></a></li>
            <li><a style="background-image: url('images/icons/twitter.svg');" class='twitter' href="https://twitter.com/ProductivityAfl" target="_blank"></a></li>
        </ul> -->

        
    </div>

    <div class="head">
        <div class="logoBurger">

            <!-- burger  -->
            <div @click='toggleBurger()' class='burger'  v-bind:class="[isBurger ? '' : 'burgerOn']">
                <div></div>
                <div></div>
                <div></div>
            </div>

            <!-- logo -->
            <a href='./' class="img mainLogo">
                <div class="img logoImg"></div>
                Melange
            </a>

            <!-- search for article -->
            <div @click='openSearch()' class='searchIcon img'></div>
        </div>

        <nav class="mainNav"   v-bind:class="[isBurger ? '' : 'navOn']">
            <ul class="navList">
                <li><a href="./">Home</a></li>
                <!-- <li class='lastHover'><a href="./latest-posts">Latest Posts</a></li> -->
                <!-- <div class="hoverList"> -->
                    <li><a href="./art">Art</a></li>
                    <li><a href="./entertainment">Entertainment</a></li>
                    <li><a href="./food">Food</a></li>
                    <li><a href="./lifestyle">Lifestyle</a></li>
                    <li><a href="./local">Local</a></li>
                <!-- </div> -->
                

                <li><a href="./about">About Us</a></li>

            </ul>
        </nav>

        <form class="searchHead" v-bind:class="[isSearch ? '' : 'searchOn']" method='GET'>
            <input name='q' type="text" class="text"  v:bind='query' placeholder='Search...'>
            <button name='search'><div class="img"></div><button>
        </form>
        
        
        
    </div>

    <div class="categoryFloat">
        <ul class="list">
                    <li><a href="./art">Art</a></li>
                    <li><a href="./entertainment">Entertainment</a></li>
                    <li><a href="./food">Food</a></li>
                    <li><a href="./lifestyle">Lifestyle</a></li>
                    <li><a href="./local">Local</a></li>
        </ul>
    </div>

</div>
