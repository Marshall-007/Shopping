<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>List of items</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="CSS/CSS.css">
    </head>

    <body class="" >



        <?php
// Initialize the session
        session_start();

// Check if the user is logged in, if not then redirect him to login page
        if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
            header("location: login.php");
            exit;
        }
        ?>

        <!DOCTYPE html>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">




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

        td{
            width: 180px;

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

    <!-- bar -->
    <div id="sidebar">
        <div class="toggle-btn">
            <span></span>
            <span></span>
            <span></span>

        </div>

        <h3 >Menu</h3>

        <ul  style="list-style: none;"> 

            <li><a  class="button1" href = "index.php">Home</a></li>
            <li><a  class="button1" href = "reset-password.php">Reset Password</a></li> 
            <li><a  class="button1" href = "logout.php">Sign-out</a></li> 

        </ul>

    </div>

    <!-- Page Content -->
    <div class="parallax">
        <div class="container">




            <style type="text/css">
                body{ font: 14px sans-serif; text-align: center; }
            </style>
   
            <div class="page-header">
                <h1>Hi, <b></b> Welcome To The Gamer's shop.</h1> 
                <button style="font-size: 20px; background-color: green; size: 12px; padding: 10px  " class="button button1 button_cont example_b" onclick="myFunction()">Show Items</button>
                  </div>



            <div   style="background-color: red; margin-left: 25%; margin-right: 25%; margin: 1px; width: auto; height: auto; visibility: visible ; color: white ;padding: 1px">

               
                <div class="button1" id="myDIV">

                    <div>

                        <table style="border-radius: 40%;">
                         
                                <th>ItemID</th>
                                <th>Description</th>
                                <th>Cost Price</th>
                                <th>Quantity</th>
                                <th>Sell Price</th>
                                <th>Add Item To cart</th>

                            </tr>
 
                            <?php
                            $link = mysqli_connect("localhost", "root", "changeme", "test");
                            if ($link->connect_error) {
                                die("Connection Failed: " . $link->connect_error);
                            }
                            $sql = "SELECT* from tbl_item";
                            $result = $link->query($sql);

                            $i = 1;
                            if ($result->num_rows > 0) {

                                while ($row = $result->fetch_assoc()) {

                                    echo "<tr><td class='zoom'>"
                                    . "<img  src='images/Item0$i.JPG' alt='NOOO!!!' width='160' height='100'/>" . $row[
                                    "ItemID"] . "</td><td>" . $row[
                                    "Description"] . "</td><td>" . 'R' . $row[
                                    "Cost Price"] . "</td><td>" . $row[
                                    "Quantity"] . "</td><td>" . 'R' . $row[
                                    "Sell Price"] . "</td><td  >  <button class='btn button1'  "
                                            . " id='myBtn'"
                                            . "onclick= AddToCart()  style='color:black;'>Add to cart</button>  </td></tr>";
                                    $i++;
                                }
                                echo "</button> "
                                . "</table>";
                            } else {
                                echo '0 Results found';
                            }
                            $link->close();
                            ?>


</table>

                    </div>

                    
                    
                    
                    <!-- The Modal -->
            <div id="myModal" class="modal">

                <!-- Modal content -->
                <div class="modal-content">
                    <span style="color: red" class="close">&times;</span>
                    <p> <h4>Select the Quantity You want</h4> </p>
                    <table>
                        <tr><td><img src='images/Item01.JPG' alt='NOOO!!!' width='160' height='100'/></td>
                            <td><a style="color: black" href="CompanyRegister.html">R1250.00</a></td>
                            <td>
                                <select name="cars" id="cars">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                <br><br>
                                <input   style="width:  120px; color: black;"   type="submit" class=" button button1" value="Add"></td>
                        </tr>

                    </table>
                </div>
</div>
                </div>
            </div>

                <script>


                    function myFunction() {
                        var x = document.getElementById("myDIV");
                        if (x.style.display === "none") {
                            x.style.display = "block";
                        } else {
                            x.style.display = "none";
                        }
                    }



                    function w3_open() {
                        document.getElementById("sidebar").classList.toggl("active");
                        document.getElementById("sidebar").style.width = "100%";
                        document.getElementById("sidebar").style.display = "block";
                    }

                    function w3_close() {
                        document.getElementById("sidebar").style.display = "none";
                    }
                </script>
            </div>
        </div>
        </div>
    
            

        

            <script>

</script>

            <script>
                function AddToCart() {
                    
                    
  alert("Item(s) sucsesfully added to cart !");
}
                // Get the modal
                var modal = document.getElementById("myModal");

                // Get the button that opens the modal
                var btn = document.getElementById("myBtn");

                // Get the <span> element that closes the modal
                var span = document.getElementsByClassName("close")[0];
                // When the user clicks the button, open the modal 
                btn.onclick = function() {
                    modal.style.display = "block";
                }

                // When the user clicks on <span> (x), close the modal
                span.onclick = function() {
                    modal.style.display = "none";
                }

                // When the user clicks anywhere outside of the modal, close it
                window.onclick = function(event) {
                    if (event.target === modal) {
                        modal.style.display = "none";
                    }
                }
                var myWindow;

                function closeWin() {
                    myWindow.close();
                }
            </script>

        


</body>



</html>
