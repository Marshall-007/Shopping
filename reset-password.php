<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
// Include config file
require_once "DBConn.php";
 
// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Prepare an update statement
        $sql = "UPDATE tbl_user SET Password = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
            
            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: login.php");
                exit();
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


  <style type="text/CSS">

        a:link,a:visited{
            display: block;
            font-style: normal;
            color: white;
            font-size: 14px;
            width: 120px;
            text-align: center;
            padding: 4px;
            text-transform: uppercase;
            text-decoration: none; 
        }
      example_b {
color: #fff !important;
text-transform: uppercase;
text-decoration: none;
background: #60a3bc;
padding: 20px;
border-radius: 50px;
display: inline-block;
border: none;
transition: all 0.4s ease 0s;
}


.example_b:hover {
text-shadow: 0px 0px 6px rgba(255, 255, 255, 1);
-webkit-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.57);
-moz-box-shadow: 0px 5px 40px -10px rgba(0,0,0,0.57);
transition: all 0.4s ease 0s;
}

        h3{color: lightpink}
       
        body {font-family: verdana;
              padding: 20px;
              opacity: 50;
               background-image: url('images/cool-background.png'); ;
              background-repeat: no-repeat;
              background-size: auto;
        }
        tr{
            height: 0px;
        }
        td{
            height: 2px
        }
        span{background-color: black;}
        h1 {font-size: 18pt;}
        h2 {font-size: 14pt; color: cyan}
        p {text-align: justify; margin: 10px 0px;}
        li { font-family: Arial; color: white; margin-left: 10%}
        footer{float: left; width: 1200px; height: 40px; padding: 5px; background-color: black; color: white;}
        //This is the code for the table 
        table{
            border-collapse: collapse;
            width: 100%;
            color: #588c7e;
            font-family: monospace;
            font-size: 25px;
            text-align: left;

        }
        
        
        
        img{
            margin-bottom: 1px;
            margin: 1px;
            border-radius: 40%;
        }
        
        table {
            border-radius: 40%;
            padding: 2px;
            
        }
        
        th{
            background-color: blue;
            color: white;
            font-size:25px;
            text-align: center;

        }

       


        tr{
            font-size: 23px;

        }

        tr:nth-child(even){background-color: black;
        }
        tr:nth-child(odd){background-color: gray;
                          color:black}

        
        //Styleing for the show items BUTTON
.button {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div style="alignment-adjust: central; margin-left: 33%; margin-top: 10%;"class="wrapper">
        <h2>Reset Password</h2>
        <p>Please fill out this form to reset your password.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                <label>New Password</label>
                <input type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?>">
                <span class="help-block"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <table>
                    
                    <tr> <td><a style="color: black" id="myBtn"> <input type="submit" class="btn btn-primary" value="Submit"></a></td>
                        <td><a class="btn btn-link btn button1" href="index.php">Cancel</a></td>
                </tr>
                </table> 
            </div>
        </form>
    </div>    
</body>
</html>