<!DOCTYPE html>
<html>
    <body>
        <div class="index large-4 medium-4 large-offset-4 medium-offset-4 columns">
            <h1 class="text-center">Registration Form </h1>
            
            <!-- Check for valid inputs from the user and shows error message if needed -->
            <form method="post">
                First name: <input type="text" name="firstName">
                <br><br>
                Last name: <input type="text" id="lastname"> <br>
                <br><br>
                E-mail: <input type="text" id="email">
                <br><br>
                <p>____________________________________________________________________</p>
                
                Username: <input type="text" name="username">
                <span style="font-size: small">Username must be at least 8 characters long with only letters and numbers.</span>
                <br><br>
                Password: <input type="password" name="password">
                <span style="font-size: small">Password must be 8-20 characters long with at least one capital letter.</span>
                <br><br>
                
                <!-- Registration button -->
                <?php echo $this->Form->button('Submit'); ?>
            </form>
        </div>
    </body>
</html>