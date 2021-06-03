<?php
/* Attempt MySQL server connection. Assuming you are running MySQL server with default setting (user 'root' with no password) */
	$link = mysqli_connect("localhost", "root", "", "");
 
	// Check connection
		if($link === false){
		die("ERROR: Could not connect. " . mysqli_connect_error());
							}
							
 
	// Escape user inputs for security
		$Name = mysqli_real_escape_string($link, $_REQUEST['Name']);
		$Surname = mysqli_real_escape_string($link, $_REQUEST['Surname']);
		$Contact = mysqli_real_escape_string($link, $_REQUEST['Contact']);
        $Email = mysqli_real_escape_string($link, $_REQUEST['Email']);
	// Attempt insert query execution
		$sql = "INSERT INTO tblData (Name, Surname, Contact, Email) 
				VALUES ('$Name', '$Surname', '$Contact', '$Email')";
		if(mysqli_query($link, $sql)){
		echo "Records added successfully.";
									} else
									{
										echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
									}
 
				// Close connection
						mysqli_close($link);
?>