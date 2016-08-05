<?php
class DBConnection{
	function getConnection(){
	  //change to your database server/user name/password
		mysql_connect("mysql1.alwaysdata.com","84540","root") or
		//mysql:host=;dbname=sealteamsix_database
         die("Could not connect: " . mysql_error());
    //change to your database name
		mysql_select_db("sealteamsix_database") or 
		     die("Could not select database: " . mysql_error());
	}
}
?>