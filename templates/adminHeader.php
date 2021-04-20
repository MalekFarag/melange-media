<div class="mainHeader">

    <div class="topBar">
        <div class="subscribe">
            Hey, <?php echo $_SESSION['user_fname']; ?>
        </div>
        <ul class="social" style='opacity: 0;'>
            <li><a style="background-image: url('../images/icons/instagram.svg');" class='insta' href="http://"></a></li>
            <li><a style="background-image: url('../images/icons/linkedin.svg');" class='linkedin' href="http://"></a></li>
            <li><a style="background-image: url('../images/icons/facebook.svg');" class='fb' href="http://"></a></li>
            <li><a style="background-image: url('../images/icons/twitter.svg');" class='twitter' href="http://"></a></li>
            <li><a class='insta' href="http://"></a></li>
        </ul>

        
    </div>

    <div class="head">
        <div class="logoBurger">

                <!-- search for article -->
            <div @click='openSearch()' class='searchIcon img'  style='opacity: 0;'></div>

            <!-- logo -->
            <a  href="./dashboard" class="img mainLogo"></a>


            <div @click='toggleBurger()' class='burger'  v-bind:class="[isBurger ? '' : 'burgerOn']">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>

        <nav class="mainNav"   v-bind:class="[isBurger ? '' : 'navOn']">
            <ul class="navList">
                <li><a href="./dashboard">Dashboard</a></li>
                <li><a href="./createblog">Create Post</a></li>
                <li><a href="./createresource">Create Resource</a></li>
                <li><a href="./edituser">Edit Current Account</a></li>
                <li><a href="./createuser">Create New Account</a></li>
                <li><a href="./logout">Logout</a></li>
            </ul>
        </nav>

        <form class="searchHead" v-bind:class="[isSearch ? '' : 'searchOn']">
            <input type="text" class="text" v-model='query' placeholder='Search...'>
            <a v-bind:href="'./search?q=' + this.query"><div class="img"></div></a>
        </form>
        
        
        
    </div>

</div>