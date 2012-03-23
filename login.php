<?php
require("login2.php");

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" 
       "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <title>Login/Signup</title> 
        <link type="text/css" rel="stylesheet" href="main.css">
    </head>
    <body>
      <div id="container">
        <div id="header">
            <ul>
              <li><a href="index.php">Home</a></li>
            </ul>
        </div><!-- end header -->
        <div id="content">
        	<div id="toolbar">
            	<ul>
                	<li><a href="login.php" class="selected">Login/Signup</a></li>
                	<!--<li><a href="logout.php">Logout</a></li>-->
           	 	</ul>
            	<!--<form method="get" action="">
                	<input type="text" id="search-text" name="s" value="" />
                	<input type="submit" id="search-submit" value="Search" />
            	</form>-->
            </div>
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
                    <td><input type="password" name="password"></td>
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
                    <td><input type="password" name="newpassword"></td>
                </tr>
				<tr>
                    <td align="right">confirm password</td>
                    <td>:</td>
                    <td><input type="password" name="newpassword2"></td>
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
        
            
        </div>
        
        <div id="footer">
            <p>Copyright &copy 2012 SI572BOOKSTOREGROUP. All Rights Reserved.</p>
        </div>
    </body>
</html>