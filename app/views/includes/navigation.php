<nav class="top-nav">
    <ul>
        <li>
            <a href="<?php echo URLROOT; ?>/pages/index">Home</a>
        </li>
        <li>
            <?php if(isset($_SESSION['id'])) : ?>   
                <a href="<?php echo URLROOT; ?>/users/result">Result</a>
            <?php else :  ?>
                <a style="color: darkgrey;">Result</a>
            <?php endif;?>
        </li>
        <li>
            <?php if(isset($_SESSION['id'])) : ?>
                <a href="<?php echo URLROOT; ?>/users/logout">Log Out</a>
            <?php else :  ?>
                <a href="<?php echo URLROOT; ?>/users/login">Login</a>
            <?php endif;?>
        </li>
        <?php if(isset($_SESSION['id'])) : ?>
            <li style="color: darkgrey; border-color: darkgrey;"  id="btn-register">
                    <a style="color: darkgrey;">Register</a>
            </li>
        <?php else :  ?>
            <li id="btn-register">
                <a href="<?php echo URLROOT; ?>/users/register">Register</a>
            </li>
        <?php endif;?>
       
    </ul>

    
</nav>