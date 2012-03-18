<?php
require_once "db.php";
session_start();
if (!isset($_SESSION['name']))
{
	header('location: index.php');
}

if (isset($_POST['logout']))
{
	echo "fefefegf";
	session_destroy();
	header('location: index.php');
	return;
}
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