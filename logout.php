<?php
require_once "db.php";
session_start();
//Prevent unlogged users to access this page
if (!isset($_SESSION['name']))
{
	header('location: index.php');
}
// If user submits logout, then destroy the session, release all cookies and redirect to home page
if (isset($_POST['logout']))
{
	session_destroy();
	header('location: index.php');
	return;
}

//If users has logged in, ask them to submit a confirmation
echo $_SESSION['name']. " Are you sure you want to log out? \n";
echo '
<form method="post">
	<table>
		<tr>

		<td colspan="3" align="center">
            <input type="submit" name="logout" value="Log out"/>
            &nbsp;&nbsp;
            <a href="index.php">Cancel</a>
        </td>
		</tr>
	</table>
</form>
	';

?>
