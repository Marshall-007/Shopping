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

<?php
session_start();
// Include functions and connect to the database using PDO MySQL
include 'functions.php';
$pdo = pdo_connect_mysql();
// Page is set to home (home.php) by default, so when the visitor visits that will be the page they see.
$page = isset($_GET['page']) && file_exists($_GET['page'] . '.php') ? $_GET['page'] : 'home';
// Include and show the requested page
include $page . '.php';
?>