<?php 
	//this code will enable the user to open the shopping cart page
	session_start();
	require("includes/DBConn.php");
	
	     if(isset($_GET['page']))
		 {
			 $pages = array("shopping cart", "product");
			 if(in_array($_GET['page'], $pages))
			 {
				 $_page = $_GET['page'];
			 }
			 else
			 {
				 $_page = "product";
			 }
		 }
		 else
		 {
			 $_page = "product";
		 }
	?>
	
<!DOCTYPE>
<html>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/favicon.ico">

	
		<title>Shopping</title>
		
	<!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/template.css" rel="stylesheet" type="text/css">    
    
    <!-- Google webfont for headings -->
   <link href='https://fonts.googleapis.com/css?family=Aref+Ruqaa' rel='stylesheet' type='text/css'> 
   
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
    
    <!-- Bootstrap core JavaScript -->
    <script src="js/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/docs.min.js"></script>
    
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
</head>
<body>

	
<!-----Form code--->
<link rel="stylesheet" href="css/jquery-ui.css" />
<link href="css/template.css" rel="stylesheet" type="text/css">
<script src="js/jquery-1.8.3.js"></script>
<script src="js/jquery-ui.js"></script>
<script>
	$(function()
	{
		$.datepicker.setDefaults({dateFormat: 'dd-mm-yy'});
		$("input.date").datepicker();
	});
</script>
<script lang="javascript" src="js/jquery.validation.js"></script>

<div class = "container">

	<div id="top" class="row">
	
	<div id="logo" class"pull-left">
		<a href="index.html"><img alt="" src="images/<!-----insert image------->">
	</div>
	
	<!-----static navbar------>
	<nav class="row navbar">
		<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
				</button>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
				
						<li><a href="index.php">Login</a></li>
						<li><a href="register.php">Register</a></li>
						<li><a href="DBConn.php">DBConn</a></li>
						<li><a href="createTable.php">View Tables</a></li>
						<li><a href="shopping.php">Shopping</a></li>
				</ul>
		</div>
	</nav>
	
	<!-----Big banner image------>
	<div class="row">
		<div id="banner">
				<a href="index.php">
						<img src="../banner/images%20(1).png" alt="images(1).png" style="left: 0px; top: 0px" width="285" height="189">
		</div>
	</div>
	
	<?php
$product_array = $db_handle->runQuery("SELECT * FROM tbl_Item ORDER BY id ASC");
if (!empty($product_array)) { 
	foreach($product_array as $key=>$value){
?>
	<div class="product-item">
		<form method="post" action="index.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
		<div class="product-image"><img src="<?php echo $product_array[$key]["image"]; ?>"></div>
		<div class="product-tile-footer">
		<div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
		<div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
		<div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
		</div>
		</form>
	</div>


	
	   <div id = "container">
		 
		 <div id = "main">
		 
		     <?php 
			    require($_page. "DBConn.php");
			 ?>
		 
		 </div id><!-----end main---->
		 
		 <div id = "side bar">
		 
		 </div id = "side bar"><!----end side bar---->
		 
		 </div><!---end container--->
		 
		<table class="tbl-cart" cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th style="text-align:left;">Name</th>
<th style="text-align:left;">Code</th>
<th style="text-align:right;" width="5%">Quantity</th>
<th style="text-align:right;" width="10%">Unit Price</th>
<th style="text-align:right;" width="10%">Price</th>
<th style="text-align:center;" width="5%">Picture</th>
</tr>	
<?php		
    foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["quantity"]*$item["price"];
		?>
				<tr>
				<td><img src="<?php echo $item["image"]; ?>" class="cart-item-image" />
<?php echo $item["name"]; ?></td>
				<td><?php echo $item["code"]; ?></td>
				<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
				<td  style="text-align:right;"><?php echo "$ ".$item["price"]; ?></td>
				<td  style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
				<td style="text-align:center;"><a href="index.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
				</tr>
				<?php
				$total_quantity += $item["quantity"];
				$total_price += ($item["price"]*$item["quantity"]);
		}
		?>

<tr>
<td colspan="2" align="right">Total:</td>
<td align="right"><?php echo $total_quantity; ?></td>
<td align="right" colspan="2"><strong>
<?php echo "$ ".number_format($total_price, 2); ?></strong></td>
<td></td>
</tr>
</tbody>
</table>
	
</body>
</html>