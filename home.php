<?php
// Get the 4 most recently added products
$stmt = $pdo->prepare('SELECT * FROM products ORDER BY date_added DESC LIMIT 4');
$stmt->execute();
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?=template_header('Home')?>

<div class="featured" style="background-image: url('imgs/background.webp');">
    <h2>Gadgets</h2>
    <p style="color:#ffffff">
    We pride ourselves in giving our customers the best electrical gamming hardware.
        We supply the latest Tech from, RAM, Graphics Cards and and monitors.
     Our online ordering system givsses users the ability to get the correct information about the products that they are purchasing while giving the customer quality assurence.
        Gammer's shop gives its customers top of the range products that are garanteed to last more than 2 years. 
         </p>
</div>
<div class="recentlyadded content-wrapper">
    <h2>Recently Added Products</h2>
    <div class="products">
        <?php foreach ($recently_added_products as $product): ?>
        <a href="index.php?page=product&id=<?=$product['id']?>" class="product">
            <?>" widimg src="imgs/<?=$product['img']th="200" height="200" alt="<?=$product['name']?>">
            <span class="name"><?=$product['name']?></span>
            <span class="price">
                R<?=$product['price']?>
                <?php if ($product['rrp'] > 0): ?>
                <span class="rrp">R<?=$product['rrp']?></span>
                <?php endif; ?>
            </span>
        </a>
        <?php endforeach; ?>
    </div>
</div>

<?=template_footer()?>