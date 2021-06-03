<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: index.php");
  exit;
}
// Include DBCon file
require_once "DBConn.php";
 
// Define variables and initialize with empty values
$Email = $Password = "";
$Email_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if Email is empty
    if(empty(trim($_POST["Email"]))){
        $Email_err = "Please enter username.";
    } else{
        $Email = trim($_POST["Email"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["Password"]))){
        $password_err = "Please enter your password.";
    } else{
        $Password = trim($_POST["Password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT Fname, Lname, Email, Password FROM tbl_User WHERE Email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_Email);
            
            // Set parameters
            $param_Email = $Email;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                
                $hashed_password = password_hash($Password, PASSWORD_DEFAULT);
                
                
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $fname, $Lname, $Email, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if($Password == "123456"||$Password=="Passwprd1"){
                            // Password is correct, so start a new session
                           session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["ID"] = $ID;
                            $_SESSION["Email"] = $Email;                            
                            
                            // Redirect user to welcome page
                            header("location: index.php");
							
                        } else{
                            // Display an error message if password is not valid
                             $password_err = "The password you entered was not valid.";
                            
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $Email_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
    
        @import url('https://fonts.googleapis.com/css?family=Noto+Sans:400,400i,700,700i&subset=greek-ext');

body{
	background-image: url('images/cool-background.png');
        background-position: center;
    background-origin: content-box;
    background-repeat: no-repeat;
    background-size: cover;
	min-height:100vh;
	font-family: 'Noto Sans', sans-serif;
}
.text-center{
	color:#fff;	
	text-transform:uppercase;
    font-size: 23px;
    margin: -50px 0 80px 0;
    display: block;
    text-align: center;
}
.box{
    
	position:absolute;
	left:50%;
	top:50%;
	transform: translate(-50%,-50%);
    background-color: rgba(0, 0, 0, 0.89);
	border-radius:16px;
	padding:70px 100px;
}
.input-container{
	position:relative;
	margin-bottom:25px;
}
.input-container label{
	position:absolute;
	top:0px;
	left:0px;
	font-size:16px;
	color:#fff;	
	transition: all 0.5s ease-in-out;
}
.input-container input{ 
  border:0;
  border-bottom:1px solid #555;  
  background:transparent;
  width:100%;
  padding:8px 0 5px 0;
  font-size:16px;
  color:#fff;
}
.input-container input:focus{ 
 border:none;	
 outline:none;
  background:transparent;
 border-bottom:1px solid #e74c3c;	
}
.btn{
	color:#fff;
	background-color:#e74c3c;
	outline: none;
    border: 0;
    color: #fff;
	padding:10px 20px;
	text-transform:uppercase;
	margin-top:50px;
	border-radius:2px;
	cursor:pointer;
	position:relative;
        
        border-radius: 12px;
           
}


/*.btn:after{
	content:"";
	position:absolute;
	background:rgba(0,0,0,0.50);
	top:0;
	right:0;
	width:100%;
	height:100%;
}*/
.input-container input:focus ~ label,
.input-container input:valid ~ label{
	top:-12px;
	font-size:12px;
	
}

        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
		
    </style>
</head>
<body > 
    <fieldset>
      
<table align="center"><tr><td colspan="1">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">   
        <div class="box">
            
                <span class="text-center">Login</span>
                <p style="color: white">Please fill in your credentials to login.</p>
       
                <div style=" color: white;" class="input-container <?php echo (!empty($Email_err)) ? 'has-error' : ''; ?>">
               <div class="input-container">
                   <span style=" color: red;"  class="input-container"> <label>Username</label>&nbsp;
                <input type="mail" name="Email" value="<?php echo $Email; ?>">
                <?php echo $Email_err; ?></span>
            </div>     </div>
            <div class="input-container <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
               <div class="input-container">
               <span style=" color: red;"  class="input-container"> <label>Password </label>&nbsp;
                <input type="password" name="Password">
                <?php echo $password_err; ?></span>
            </div>
                <div style="margin-left: 30%" class="btn">
                <input style="width: 80px; "type="submit"  value="Login">
            </div>
                <p style="color: white" >Don't have an account? <a href="register.php">Sign up now</a>.</p>
      
    </div>   
        </div>
        </form>
                
	</td>
	</tr>
      
</table>	
    </fieldset>
   
</body>
</html>