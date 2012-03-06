<?php
    // Gain access to DB
    require_once "db.php";
    // Initialize session for page
    //session_start();
    
    // Need to check whether the user came to this page because of clicking the
    // link from the index page or because of the form submission in this page.
    if ( (isset($_POST['email']) && isset($_POST['password'])) 
	||(isset($_POST['newemail']) && isset($_POST['newpassword'])&& isset($_POST['newpassword2'])))
    {
        // Came to this page because of the form submission.
		//If because of log in submission
		if (isset($_POST['email']) && isset($_POST['password']))
		{
			// Safeguard entered values 
			$email = trim(mysql_real_escape_string($_POST['email']));
			$password = trim(mysql_real_escape_string($_POST['password']));
			//For returning customers
			// Various checks of entered values
			if ( empty($email) )
				// Value for make is an empty string
				// Set error message to display in index page
				echo("Log In Error: email address is required.");
				//$_SESSION['sesError'] = "Log In Error: email address is required.";
			elseif ( empty($password) )
				// Value for model is an empty string
				// Set error message to display in index page
				echo("Log In Error: password is required. ");
				//$_SESSION['sesError'] = "Log In Error: password is required. ";
			else 
			{
				//If email and password is not empty, then see if email and password matches
				$sql = "SELECT password FROM users WHERE email= '$email'";
				$pwd = mysql_fetch_row(mysql_query($sql));
				//If email does not exist, show the message
				if (empty($pwd))
				echo("Your account does not exist. Please sign up first.");
				//$_SESSION['sesError']= "Your account does not exist. Please sign up first.";
				//If password matches, log in successful
				elseif ($pwd[0]==$password)
				echo('Hi, you are logged in.');
				//$_SESSION['sesSuccess'] = 'Hi, you are logged in.';
				else
				echo($pwd."Your password is not correct.");
				//$_SESSION['sesError']= "Your password is not correct.";
			}
			// Redirect to index page
			//header( 'Location: index.php' );        
			// Suspend further execution of this page and wait for redirect
					// Various checks of entered values
		}		
				
		//If submit for sign up
		if (isset($_POST['newemail']) && isset($_POST['newpassword'])&& isset($_POST['newpassword2']))
		{
			$newemail = trim(mysql_real_escape_string($_POST['newemail']));
			$newpassword = trim(mysql_real_escape_string($_POST['newpassword']));
			$newpassword2 = trim(mysql_real_escape_string($_POST['newpassword2']));
			$newusername=trim(mysql_real_escape_string($_POST['username']));
			if ( empty($newemail) )
				// Value for make is an empty string
				// Set error message to display in index page
				echo("Sign Up Error: email address is required.");
				//$_SESSION['sesError'] = "Sign Up Error: email address is required.";
			elseif ( empty($newpassword) )
				// Value for model is an empty string
				// Set error message to display in index page
				echo("Sign Up Error: password is required. ");
				//$_SESSION[¡®sesError¡¯]="Sign Up Error: password is required. "
			elseif ( empty($newpassword2) )
				// Value for model is an empty string
				// Set error message to display in index page
				echo("Sign Up Error: please confirm your password. ");
				//$_SESSION['sesError'] = "Sign Up Error: please confirm your password. ";
			else 
			{
				//If email and password is not empty, then see if email exist and password matches
				$sql = "SELECT id FROM users WHERE email= '$newemail'";
				$result=mysql_query($sql);
				$row=mysql_fetch_row($result);
				if ($newpassword!=$newpassword2)
					echo( "Your password does not match. Please conform your password again.");
				elseif (empty($row))
				{
					//create new users
					$sql="INSERT INTO users (email, password, username) VALUES ('$newemail', '$newpassword','$newusername')";
					mysql_query($sql);
					echo( "Congratulations! Your account has been created. ");
				}

				else
					echo("Your account already exists. Please log in. ");

        }
        // Redirect to index page
        //header( 'Location: index.php' );
		}
        // Suspend further execution of this page and wait for redirect

        return;
    }
?>
<html>
    <head>
        <title>Login/Signup</title>
    </head>
    <body>
        <h1>If you are a returning customer</h1>
        <form method="post">
            <table border="0">
                <tr>
                    <td align="right">Email</td>
                    <td>:</td>
                    <td><input type="text" name="email"></td>
                </tr>
                <tr>
                    <td align="right">password</td>
                    <td>:</td>
                    <td><input type="text" name="password"></td>
                </tr>
                <tr>
                    <td colspan="3" align="center">
                        <input type="submit" value="Log in"/>
                        &nbsp;&nbsp;
                        <a href="index.php">Cancel</a>
                    </td>
                </tr>
            </table>
        </form>
		        <h1>If you are a new customer</h1>
        <form method="post">
            <table border="0">
                <tr>
                    <td align="right">Email</td>
                    <td>:</td>
                    <td><input type="text" name="newemail"></td>
                </tr>
                <tr>
                    <td align="right">password</td>
                    <td>:</td>
                    <td><input type="text" name="newpassword"></td>
                </tr>
				<tr>
                    <td align="right">confirm password</td>
                    <td>:</td>
                    <td><input type="text" name="newpassword2"></td>
                </tr>
				<tr>
                    <td align="right">User name (optional)</td>
                    <td>:</td>
                    <td><input type="text" name="username"></td>
                </tr>
                <tr>
                    <td colspan="3" align="center">
                        <input type="submit" value="Sign up"/>
                        &nbsp;&nbsp;
                        <a href="index.php">Cancel</a>
                    </td>
                </tr>
            </table>
        </form>

    </body>
</html>

