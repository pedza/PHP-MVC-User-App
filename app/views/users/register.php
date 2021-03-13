<?php
    require APPROOT . '/views/includes/head.php';
?>

<div class="navbar">
    <?php
      require APPROOT . '/views/includes/navigation.php';
    ?>
</div>

<div class="class-container">
    <div class="wrapper-login">
        <h2>Register</h2>


        <form action="<?php echo URLROOT; ?>/users/register" method="POST">
            <input type="text" placeholder="Username *" name="username">
            <span class="invalidFeedback">
                <?php echo $data['usernameError']; ?>
            </span>
            <input type="email" placeholder="Email *" name="email">
            <span class="invalidFeedback">
                <?php echo $data['emailError']; ?>
            </span>
            <input type="password" placeholder="Password *" name="password">
            <span class="invalidFeedback">
                <?php echo $data['passwordError']; ?>
            </span>

            <input type="password" placeholder="Confirm Password *" name="confirmPassword">
            <span class="invalidFeedback">
                <?php echo $data['confirmPasswordError']; ?>
            </span>
            
            <select name="category" id="category">
            <option value='0'>Select a category</option>
                <?php echo $this->getCategories(); ?>
            </select>
            <span class="invalidFeedback">
                <?php echo $data['categoryError']; ?>
            </span>

            <button id="submit" type="submit" value="submit">Submit</button>
        </form>
    </div>
</div>