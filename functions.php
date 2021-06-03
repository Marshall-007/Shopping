<?php
function pdo_connect_mysql() {
    // Update the details below with your MySQL details
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'test';
    try {
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	// If there is an error with the connection, stop the script and display the error.
    	die ('Failed to connect to database!');
    }
}

// Get the amount of items in the shopping cart, this will be displayed in the header.
$num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
// Template header, feel free to customize this
function template_header($title) {
    // Get the amount of items in the shopping cart, this will be displayed in the header.
$num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link href="CSS/style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head> 
        <script>

main .featured {
	display: flex;
	flex-direction: column;
	background-image: url('imgs/featured-image.jpg');
	background-repeat: no-repeat;
	background-size: cover;
	height: 500px;
	align-items: center;
	justify-content: center;
	text-align: center;
}
main .featured h2 {
	display: inline-block;
	margin: 0;
	width: 1050px;
	font-family: Rockwell, Courier Bold, Courier, Georgia, Times, Times New Roman, serif;
	font-size: 68px;
	color: #FFFFFF;
	padding-bottom: 10px;
}
main .featured p {
	display: inline-block;
	margin: 0;
	width: 1050px;
	font-size: 24px;
	color: #FFFFFF;
}


</script>
	<body>
        <header>
            <div class="content-wrapper">
                <h1>Dube's Gadgets</h1>
                <nav>
                    <a href="index.php">Home</a>
                    <a href="index.php?page=products">Products</a>
                      <a href="Hello/index.php">Admin</a>
                </nav>
                <div class="link-icons">
                    <a href="index.php?page=cart">
						<i class="fas fa-shopping-cart"></i>
                                               <span>$num_items_in_cart</span>
					</a>
                </div>
            </div>
        </header>
        <main>
EOT;
}
// Template footer
function template_footer() {
$year = date('Y');
echo <<<EOT
        </main>
        <footer>
            <div class="content-wrapper">
                <p>&copy; $year, Dube's Gadgets Web Development POE</p>
            </div>
        </footer>
        <script src="script.js"></script>
    </body>
</html>
EOT;
}


?>