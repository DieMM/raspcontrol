<div id="loginForm">
 
    <?php
    // STEP 3. Check for an action and show the approprite message.
    if($_GET['action']=='not_yet_logged_in'){
        echo "<div id='infoMesssage'>You cannot go to the index page because you are not yet logged in.</div>";
    }
     
    // STEP 4. Check if the user clicked the 'Login' button already by checking the PHP $_POST variable
    if($_POST){
         
        // these username and password are just examples, it should be from you database
        // passwords must be encrypted (salt and hash) to be secured, this post should give you an idea or see the update below
        $username = 'subscriber';
        $password = 'codeofaninja';
         
        // check if the inputted username and password match
        if($_POST['username']==$username && $_POST['password']==$password){
             
            // if it is, set the session value to true
            $_SESSION['logged_in'] = true;
             
            // and redirect to your site's admin or index page
            header('Location: index.php');
             
        }else{
         
            // if it does not match, tell the user his access is denied.
            echo "<div id='failedMessage'>Access denied. :(</div>";
        }
    }
    ?>
 
    <!-- where the user will enter his username and password -->
    <form action="login.php" method="post">
     
        <div id="formHeader">Admin Login</div>
         
        <div id="formBody">
            <div class="formField">
                <input type="text" name="username" placeholder="Username" />
            </div>
             
            <div class="formField">
                <input type="password" name="password" placeholder="Password" />
            </div>
         
            <div>
                <input type="submit" value="Login" class="customButton" />
            </div>
        </div>
         
        <div id="userNotes">
            <div>Username: subscriber</div>
            <div>Password: codeofaninja</div>
            <div><a href="index.php">Go to index page</a></div>
        </div>
    </form>
     
</div>