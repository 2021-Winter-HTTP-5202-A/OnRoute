<?php
    use OnRoute\models\{Database, User};
    require_once 'vendor/autoload.php';
    require_once 'library/functions.php';
    require_once 'models/Mailer.php';

    //Add unqiue css files here
    $css = array('styles/login.css');
    require_once './views/header.php';
    require_once 'models/Database.php';
    require_once 'models/User.php';


    $dbcon = Database::getDB();
    $user = new User($dbcon);

    $invalid = "";

    //Checks to see if a user is logged in
    if (isset($_SESSION['userID'])) {
        Header('Location: index.php');
    }

    //Registration
    if (isset($_POST['submit'])) {
        //Gets the email from the posted form
        $email = $_POST['email'];

        //Gets a list of registered user emails
        $emailExists = $user->checkIfEmailIsUnique($email);

        //Checks if the email exists
        if ($emailExists) {
            //Lets the user know the email already exists
            echo 'Email already exists';
        } else {
            //Encrypts password
            $hashedPass = md5($_POST['pass']);
            //Gets variables from the posted form
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $pnumber = $_POST['pnumber'];
            //Sets the subject and body for the email
            $subject = "Registration successful";
            $body = "You are now registered on onroute.";
            //Adds the new user to the database
            $u = $user->addUser($email, $hashedPass, $fname, $lname, $pnumber);
            //Sends the email letting the user know their registration was successful
            send_email($email, $fname.' '.$lname, $subject, $body);
            
            //Grabs the id of the newly created user account
            $newID = $user->getUserIdByEmail($email);
            //Stores the user data into session variables
            $_SESSION['userID'] = $newID->id;
            $_SESSION['userEmail'] = $email;
            $_SESSION['userFirstName'] = $fname;
            $_SESSION['userLastName'] = $lname;
            //Redirects to homepage
            header('Location: index.php');
        }
    }
    
    //Login
    if (isset($_POST['login'])) {
        //Gets the posted email and password
        $email = $_POST['in_email'];
        $hashedPass = md5($_POST['in_pass']);

        //Gets the user associated with that email and password
        //If the credentials were correct it returns the user's data,
        //Else it returns null
        $u = $user->getUser($email, $hashedPass);

        //Checks if the user's data was returned
        if (!$u == null) {
            //Stores the user data into session variables
            $_SESSION['userID'] = $u->id;
            $_SESSION['userEmail'] = $u->email;
            $_SESSION['userFirstName'] = $u->firstname;
            $_SESSION['userLastName'] = $u->lastname;
            $_SESSION['userPhone'] = $u->phonenumber;
            //Redirects to homepage
            header('Location: Flights.php');
        } else {
            //Lets the user know their username or password is incorrect
            $invalid = "<p>Invalid username and/or password</p>";
        }
    }
?>
<script type="text/javascript" src="library/userValidation.js"></script>
<main>
    <div class="formContainer">
        <form action="login.php" method="post" id="loginForm">
            <h2>Login</h2>
            <div class="formContainer__form">
                <div class="formContainer__form_input">
                    <label for="in_email">Email: </label>
                    <input type="text" name="in_email" required/>
                </div>
                <div class="formContainer__form_input">
                    <label for="in_pass">Password: </label>
                    <input type="password" name="in_pass" required/>
                    <?= $invalid ?>
                </div>
                <div class="formContainer__form_input">
                <a href="forgotPassword.php" class="forgotPassBtn">Forgot your password?</a>
                </div>
                <input class="loginBtn" type="submit" value="Login" name="login">
            </div>
        </form>
    </div>
    <div class="formContainer">
        <form action="login.php" method="post" id="registerForm">
            <h2>Don't Have An Account?<br>Register Here</h2>
            <div class="formContainer__form">
                <div class="formContainer__form_input">
                    <label for="email">Email:</label> 
                    <input type="text" name="email" id="inEmail" required/>
                </div>
                <div class="formContainer__form_input">
                    <label for="pass">Password:</label>
                    <input type="password" name="pass" id="inPass" required/>
                </div>
                <div class="formContainer__form_input">
                <label for="passConfirm">Confirm Password:</label><input type="password" name="passConfirm" id="inPassConfirm" required/>
                </div>
                <div class="formContainer__form_input">
                    <label for="fname">First Name:</label>  
                    <input type="text" name="fname" id="inFName" required/>
                </div>
                <div class="formContainer__form_input">
                    <label for="lname">Last Name:</label> 
                    <input type="text" name="lname" id="inLName" required/>
                </div>
                <div class="formContainer__form_input">
                    <label for="pnumber">Phone Number: </label> 
                    <input type="text" name="pnumber" id="inPNumber" required/>
                </div>
                <input class="loginBtn" type="submit" name="submit" value="Register">
            </div>
        </form>
    </div>
</main>

<?php
    require_once 'views/footer.php';
?>