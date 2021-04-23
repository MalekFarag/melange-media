<div class="mainHeader">

    <div class="topBar">
        <div class="subscribe">
            Hey, <?php echo $_SESSION['user_fname']; ?>
        </div>

        
    </div>

    <div class="head">
        <div class="logoBurger">

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