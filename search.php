<?php
require_once "db.php";
session_start();
if (isset($_SESSION['error']))
	{
		echo $_SESSION['error'];
		unset($_SESSION['error']);
	}
$search = $_POST['search'];

# get the search-by-term value
$term = $_POST['term'];
if ( $term == "All"){
	
	$result=mysql_query('select * from book join course on book.course_id = course.num where book.name like "%' .$search. '%" 
	or authorln like "%' .$search. '%" or authorfn like "%' .$search. '%" or isbn like "%' .$search. '%"
	or course_id like "%' .$search. '%" or fullName like "%' .$search. '%" '); }
else {
	$q = 'select * from book join course on book.course_id = course.num and course.term LIKE "%'.$term.'%" where book.name like "%' .$search. '%"  
	or authorln like "%' .$search. '%" or authorfn like "%' .$search. '%" or isbn like "%' .$search. '%" or course_id like "%' .$search. '%" or fullName like "%' .$search. '%" ';
	$result= mysql_query($q);
}

#store the number of book rows
$rowCount = mysql_num_rows($result);

# variable to store the number of rows that match all search parameters
$resultCount = 0;

#for every row from the database
for( $i = 0; $i < $rowCount; $i = $i + 1 ) {

	# store book name
	$name = mysql_result($result,$i, 'book.name');
	
	# if there is result
	if( isset($result)) {
		#if this is the first row, print the table header
		if( $resultCount == 0 ) {
			print('<table width="732" height="179" border="5" align="center">');
		}

		#store row info in variables
		$authorln = mysql_result($result, $i, 'book.authorln');
		$authorfn = mysql_result($result, $i, 'book.authorfn');
		$price = mysql_result($result, $i, 'book.price');
		$isbn = mysql_result($result, $i, 'book.ISBN');
		$year = mysql_result($result,$i,'book.year');
		$term = mysql_result($result,$i,'course.term');
		$id = mysql_result($result,$i, 'book.id');
		$picture= mysql_result($result,$i, 'book.picture');

		#print the row using variables
	  print('<tr align="center">
	  	  <td><div align="center"><a href="bookInfo.php?id='.$id.'"><img src=" '.$picture.' " alt="'.$id.'" width="99" height="135" /></a></div></td>
		  <td>Book Name: <div align="center"><strong>'.$name.' (Price: $'.$price.')</strong></div></td>
		  <td><p>Term: <div align="center">'.$term.'</div></p>
		  <p>ISBN: <div align="center">'.$isbn.'</div></p></td>
		</tr> ');
		
		#increment matched result count
		$resultCount = $resultCount + 1;
	}
}
#if no book matched the search terms
if( $resultCount == 0 ) {
	#print a message to that effect
	  $error='No matches found. Please search again.';
} 

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN""http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <title>Search Results</title> 
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
            <ul>
                <li><a href="shoppingcart.php">My Shopping Cart</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
		<p style="color:red"><?php if (isset($error)) echo $error; ?></p>
        <div id="footer">
            <p>Copyright &copy 2012 SI572BOOKSTOREGROUP. All Rights Reserved.</p>
        </div>
    </body>
</html>