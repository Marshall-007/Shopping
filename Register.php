<?php
// Include DBConn file
require_once "DBConn.php";
 
// Define variables and initialize with empty values
$Fname = $Lname = $Email = $Password = $confirm_password = "";
$Fname_err = $Lname_err = $Email_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate Fname
    if(empty(trim($_POST["Fname"]))){
        $Fname_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT * FROM tbl_user WHERE Fname = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["Fname"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $Fname_err = "This username is already taken.";
                } else{
                    $Fname = trim($_POST["Fname"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    // Validate Lname
    if(empty(trim($_POST["Lname"]))){
        $Lname_err = "Please enter a Surname.";
    } else{
        // Prepare a select statement
        $sql = "SELECT * FROM tbl_user WHERE Lname = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_Lname);
            
            // Set parameters
            $param_Lname = trim($_POST["Lname"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 2){
                    $Lname_err = "This Surname is already taken.";
                } else{
                    $Lname = trim($_POST["Lname"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
	// Validate Email
    if(empty(trim($_POST["Email"]))){
        $Email_err = "Please enter a Email.";
    } else{
        // Prepare a select statement
        $sql = "SELECT * FROM tbl_user WHERE Email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_Email);
            
            // Set parameters
            $param_Email = trim($_POST["Email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 3){
                    $Email_err = "This Email is already taken.";
                } else{
                    $Email = trim($_POST["Email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    // Validateing the password
    if(empty(trim($_POST["Password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["Password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["Password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($Fname_err) && empty($Lname_err) && empty($Email_err) && 
	empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO tbl_user (Fname,Lname,Email,Password) 
				VALUES ('$Fname','$Lname','$Email',MD5('$Password'))";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_Lname, $param_Email, $param_password);
            
            // Set parameters
            $param_username = $Fname;
			$param_Lname = $Lname;
			$param_Email = $Email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: Login.php");
            } else{
                echo "Something went wrong. Please try again later.";
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
    <title>User Registration</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
  
         @import url('https://fonts.googleapis.com/css?family=Noto+Sans:400,400i,700,700i&subset=greek-ext');

body{
	background-image: url('images/cool-background.png');
        background-position: center;
    background-origin: content-box;
    background-repeat: no-repeat;
    background-size: inherit;
	min-height:100vh;
	font-family: 'Noto Sans', sans-serif;
}
.text-center{
	color:#fff;	
	text-transform:uppercase;
    font-size: 23px;
    margin: -50px 0 2px 0;
    display: block;
    text-align: center;
}
.box{
    
	position:absolute;
	left:50%;
	top:50%;
	transform: translate(-50%,-50%);
    background-color: rgba(0, 0, 0, 0.89);
	border-radius:3px;
	padding:55px 60px;
}
.input-container{
	position:relative;
	margin-bottom:15px;
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
  padding:1px 0 5px 0;
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
	background-color:blue;
	outline: appworkspace;
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
.button1 {size: 15px;
  border-color: #3498db;
  color: #fff;
  box-shadow: 0 0 40px 40px #3498db inset, 0 0 0 0 #3498db;
  -webkit-transition: all 150ms ease-in-out;
  transition: all 150ms ease-in-out;

}

.button1:hover {
  box-shadow: 0 0 10px 0 #3498db inset, 0 0 10px 4px #3498db;
}

    .btn:hover, .btn:focus {
  color: #fff;
  outline: 0;
} 
        
    </style>
</head>
<body>
    <table style="margin-top: 90px; margin-bottom: 70px" align="center"><tr><td colspan="1">
    <div  style="margin-top: 90px; margin-bottom: 70px" class="box">
        <form    action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
         
        <span class="text-center">Sign up</span>
        <p style="color: white;">Please fill all fields in this form to create an account.</p>
           <div class=" input-container <?php echo (!empty($Fname_err)) ? 'has-error' : ''; ?>">
                <span style=" color: red;"  class="input-container">
                    <label>Username</label>&nbsp;
                <input type="text" name="Fname" class="input-container " value="<?php echo $Fname; ?>">
                <?php echo $Fname_err; ?></span>
            </div>    
			<div class="input-container <?php echo (!empty($Lname_err)) ? 'has-error' : ''; ?>">
               <span style=" color: red;"  class="input-container">
                   <label>Surname</label>&nbsp;
                <input type="text" name="Lname" class="input-container " value="<?php echo $Lname; ?>">
                <?php echo $Lname_err; ?></span>
            </div>  
			<div class="input-container <?php echo (!empty($Email_err)) ? 'has-error' : ''; ?>">
               <span style=" color: red;"  class="input-container">
                   <label>Email</label>&nbsp;
                <input type="text" name="Email" class="input-container " value="<?php echo $Email; ?>">
                <?php echo $Email_err; ?></span>
            </div>  
            <div class="input-container <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <span style=" color: red;"  class="input-container">
                    <label>Password</label>&nbsp;
                <input type="password" name="Password" class="input-container " value="<?php echo $Password; ?>">
               <?php echo $password_err; ?></span>
            </div>
            <div class="input-container <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
              <span style=" color: red;"  class="input-container">
                   <label>Confirm Password</label>&nbsp;
                <input type="password" name="confirm_password" class="input-container" value="<?php echo $confirm_password; ?>">
                <?php echo $confirm_password_err; ?></span>
            </div>
            <div class="input-container">
                <table>
                    <tr><td style="width: 200px;"><input  class="btn button1" type="submit" class="btn" value="Submit"></td>
                        <td></td>
                          <td></td>
                        <td style="width: 120px;"><input class="btn button1"  type="reset" class="btn" value="Reset"></td>
                    </tr>
               </table>
            </div>
            <p style="color: white;" >Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>  
</td>
	</tr>
</table>		
</body>
</html>