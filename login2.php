<?php
    // Gain access to DB
    require_once "db.php";
    // Initialize session for page
    session_start();
	//if $_SESSION['error'] exists, then display the error message
	if (isset($_SESSION['error']))
	{
		echo $_SESSION['error'];
		unset($_SESSION['error']);
	}

	//if a user already logged in, show the message. 
	if (isset($_SESSION['name']))
	{
		header("location: index.php");
	}
    
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
				{
					$_SESSION['error'] = "Log In Error: email address is required.";
					// Redirect to login page

				}
			elseif ( empty($password) )
				{	
					// Value for model is an empty string
					// Set error message to display in index page
					$_SESSION['error'] = "Log In Error: password is required.";
					// Redirect to login page
					header( 'Location: login.php' );

				}
			else 
				{
					//If email and password is not empty, then see if email and password matches
					$sql = "SELECT password FROM users WHERE email= '$email'";
					$pwd = mysql_fetch_row(mysql_query($sql));
					//If email does not exist, show the message
					if (empty($pwd))
					{
						$_SESSION['error']= "Account does not exist, please sign up first. ";
						// Redirect to login page
						header( 'Location: login.php' );

					}
					//If password matches, log in successful
					elseif ($pwd[0]==$password)
					{
						$sql = "SELECT id, username, isAdmin, email FROM users WHERE email= '$email'";
						$result = mysql_query($sql);
						$_SESSION['name'] = mysql_result($result,0,'username');
						$_SESSION['email']= mysql_result($result,0,'email');
						$_SESSION['isAdmin']= mysql_result($result,0,'isAdmin');
						$_SESSION['user_id']= mysql_result($result,0,'id');
						unset($_SESSION['error']);
						// Login complete, redirect to index page
						header( 'Location: index.php' );

					}
					else
					{
						$_SESSION['error']= "Your password is incorrect.";
						// Redirect to login page
						header( 'Location: login.php' );

					}
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
				{
					// Value for make is an empty string
					// Set error message to display in index page
					$_SESSION['error'] = "Signup Error: email address is required.";
					// Redirect to login page
					header( 'Location: login.php' );

				}
			elseif ( empty($newpassword) )
				{
					// Value for model is an empty string
					// Set error message to display in index page
					$_SESSION['error']="Signup Error: password is required.";
					// Redirect to login page
					header( 'Location: login.php' );

				}
			elseif ( empty($newpassword2) )
				{
					// Value for model is an empty string
					// Set error message to display in index page
					$_SESSION['error'] = "Signup Error: please confirm your password. ";
					// Redirect to login page
					header( 'Location: login.php' );

				}
			elseif ($newpassword!=$newpassword2)
				{
					$_SESSION['error'] = "Signup Error: the passwords you typed do not match. ";
					// Redirect to login page
					header( 'Location: login.php' );
				}				

			else 
			{
				//If email and password is not empty, then see if email exist and password matches
				$sql = "SELECT id FROM users WHERE email= '$newemail'";
				$result=mysql_query($sql);
				$row=mysql_fetch_row($result);
			if (empty($row))
				{
					//create new users
					$sql="INSERT INTO users (email, password, username, isAdmin) VALUES ('$newemail', '$newpassword','$newusername', '0')";
					mysql_query($sql);
					$_SESSION['email'] = $newemail;
					$_SESSION['name']= $newusername;
					$_SESSION['isAdmin']= 0;
					$_SESSION['success']= "Congratulations! Your account has been created";
					$sql = "SELECT id, username, isAdmin, email FROM users WHERE email= '$newemail'";
					$result = mysql_query($sql);
					$_SESSION['user_id']= mysql_result($result,0,'id');
					// Redirect to index page
					header( 'Location: index.php' );

				}

				else
					$_SESSION['error'] = "Error: your account already exists. Please log in. ";
					// Redirect to login page
					header( 'Location: login.php' );


			}
		}

        return;
    }
?>