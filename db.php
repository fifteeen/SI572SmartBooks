<?php
    define("HOSTNAME", "localhost");
    define("DB_NAME", "smartbooks");
    define("DB_USER", "administrator");
    define("DB_PASS", "smartbooks");
    
    // Attempt connection to database Server
    mysql_connect(HOSTNAME, DB_USER, DB_PASS) or 
        die('ERROR: Fail to connect to database server!');
    // Attempt to access database
    mysql_select_db(DB_NAME) or 
        die("ERROR: Fail to access database");
?>
