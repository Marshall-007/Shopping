<?php

include "DBConn.php";

$query = "DROP table  if exists tbl_User";

//check connection
if ($link->query($query)) {
    echo "Table tbl_User deleted  ....";
    $sql = "CREATE TABLE tbl_User (
		ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		Fname VARCHAR(30) NOT NULL,
		Lname VARCHAR(30) NOT NULL,
		Email VARCHAR(50),
		Password VARCHAR(50)
		)";
    if ($link->query($sql)) {
        echo "created table tbl_User....";
    } else {
        echo $link->error;
    }
}

$file = fopen("C:\wamp64\www\userData.txt", "r");

while (!feof($file)) {
    $content = fgets($file);
    $carray = explode(";", $content);
    list($ID, $Fname, $Lname, $Email, $Password) = $carray;
    $sql = "INSERT INTO tbl_User (ID,Fname,Lname,Email,Password) VALUES 
		($ID,$Fname,$Lname,$Email,$Password)";
    $link->query($sql);
}
fclose($file);
// Close connection
mysqli_close($link);
?>