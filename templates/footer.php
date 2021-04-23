<footer class="footer">

    <div class="footLogo img"></div>

    <div class="footSocial">
        <nav class="footNav">
            <ul class="navList">
                <li><a href="./">Home</a></li>
                <!-- <li class='lastHover'><a href="./latest-posts">Latest Posts</a></li> -->
                <div class="hoverList">
                    <li><a href="./art">Art</a></li>
                    <li><a href="./entertainement">Entertainment</a></li>
                    <li><a href="./food">Food</a></li>
                    <li><a href="./lifestyle">Lifestyle</a></li>
                    <li><a href="./local">Local</a></li>
                </div>
                
                

                <li><a href="./about">About Us</a></li>
                <!-- <li><a href="./contact">Contact Us</a></li> -->
            </ul>
        </nav>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class='subscribeDiv'>
            <h6 class="headerS">Subcribe To The Network</h6>
            <div class="inputList">
                <input type="text" name="name" placeholder='name'>
                <input type="email" name="email" placeholder='email'>
            </div>
            
            <button class='button1' name='subscribe'>Subscribe</button>

        </form>

        <nav class="socialNav">
            <ul class="social">
                <li><a style="background-image: url('images/icons/instagram.svg');" class='insta img' href="" target="_blank"></a></li>
                <li><a style="background-image: url('images/icons/facebook.svg');" class='fb img' href="" target="_blank"></a></li>
                <li><a style="background-image: url('images/icons/twitter.svg');" class='twitter img' href="" target="_blank"></a></li>
                <li><a style="background-image: url('images/icons/tiktok.svg');" class='tiktok img' href="" target="_blank"></a></li>
                <li><a style="background-image: url('images/icons/reddit.svg');" class='reddit img' href="" target="_blank"></a></li>
                <li><a style="background-image: url('images/icons/pinterest.svg');" class='pinterest img' href="" target="_blank"></a></li>
                
            </ul>
        </nav>
    </div>
    


    <div class="copyright">Melange Media <?php echo date('Y');?> &copy;. All Rights Reserved. <br>
        Website designed and developed by <a href="https://revesolutions.ca/" style='color: white;' target='_blank'>Reve Solutions</a>
    </div>

    
</footer>

<script src="js/main.js"></script>
