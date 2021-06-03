<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Additems</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
  
         @import url('https://fonts.googleapis.com/css?family=Noto+Sans:400,400i,700,700i&subset=greek-ext');

body{
	background-color: blue;
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
/*.button1 {size: 15px;
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
        */
    </style>
</head>
<body>
    
    
    
    
    
    
    
    
    
    
    <?php
include "DBConn.php"; // Using database connection file here

if(isset($_POST['submit']))
{	$id = 1;	
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $price = $_POST['price'];
    $rrp = $_POST['rrp'];
    $quantity = $_POST['quantity'];
    $img = $_POST['img'];
    $date_added = $_POST['date_added'];

    $insert = mysqli_query($link,"INSERT INTO products (id,name, desc, price, rrp, quantity, img, date_added) VALUES ('$id',$name','$desc','$price','$rrp','$quantity','$img','$date_added')");

    if(!$insert)
    {
        echo mysqli_error($link);
    }
    else
    {
        echo "Records added successfully.";
    }
}

mysqli_close($link); // Close connection
?>

    
    
    
    
    
    
    
    
    
    
    
    <table style="margin-top: 90px; margin-bottom: 70px" align="center"><tr><td colspan="1">
    <div  style="margin-top: 90px; margin-bottom: 70px" >
        <form method="post">
         
        <span class="text-center">Add Products</span>
        <p style="color: white;">In this section you can add products to the online shop.</p>
           <div class=" input-container">
                <span style=" color: red;"  class="input-container">
                    <label>Product Name:</label>&nbsp;
                <input type="text" name="name" class="input-container ">
                </span>
            </div>    
			<div class="input-container">
               <span style=" color: red;"  class="input-container">
                   <label>Description </label>&nbsp;
                <input type="text" name="desc" class="input-container ">
                </span>
            </div>  
			<div class="input-container">
               <span style=" color: red;"  class="input-container">
                   <label>Price</label>&nbsp;
                <input type="text" name="price" class="input-container ">
                </span>
            </div>  
            <div class="input-container">
                <span style=" color: red;"  class="input-container">
                    <label>Retail Price</label>&nbsp;
                    <input type="text" name="rrp" class="input-container ">
               </span>
            </div>
            <div class="input-container">
              <span style=" color: red;"  class="input-container">
                   <label>Quantity</label>&nbsp;
                   <input type="number" name="quantity" class="input-container">
               </span>
            </div>
        
        
            <div class="input-container">
              <span style=" color: red;"  class="input-container">
                   <label>Choose Image</label>&nbsp;
                   <input type="file" id="myFile" name="img">
   
               </span>
            </div>
        
        
        <div class="input-container">
              <span style=" color: red;"  class="input-container">
                   <label>Date added</label>&nbsp;
                   <input type="date" id="myFile" name="date_added">
   
               </span>
            </div>
            <div class="input-container">
                <table>
                    <tr><td style="width: 200px;"><input  type="submit" name="submit" class="btn button1" class="btn" value="Add"></td>
                        <td></td>
                          <td></td>
                        </tr>
               </table>
            </div>
        </form>
    </div>  
</td>
	</tr>
</table>		
</body>
</html>