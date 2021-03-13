<?php

  require APPROOT . '/views/includes/head.php';


?>

<div id="section-landing">

    <?php
      require APPROOT . '/views/includes/navigation.php';
    ?>

    <div class="wrapper-landing">
        
  
        <h1>WELCOME</h1>
        <?php if(isset($_SESSION['id'])) : ?>
        <h2><?php echo $_SESSION['username'] ?></h2>
        <?php else :  ?> 
        <h2>USER</h2>
        <?php endif;?> 

    </div>

    <div class="class-container">
    <div class="wrapper-login">
        <h2>SEARCH</h2>


        <form action="<?php echo URLROOT; ?>/pages/index" method="POST">
            <input type="text" placeholder="search *" name="term">
           
            
            <select name="category" id="category">
            <option value='0'>Select a category</option>
                <?php echo $this->getCategories(); ?>
            </select>
            

            <button id="submit" type="submit" value="submit">Submit</button>
        </form>
    </div>
</div>

    

</div>



