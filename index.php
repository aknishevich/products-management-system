<?php

require 'vendor/autoload.php';

use App\Entity\Product;
use \App\Repository\ProductRepository;
use App\Db\DataBase;

$db = DataBase::getDb();
$productRepository = new ProductRepository();
/*$db->query("CREATE TABLE IF NOT EXISTS `products` (
    `id` INTEGER PRIMARY KEY AUTOINCREMENT,
    `name` VARCHAR NOT NULL,
    `description` VARCHAR NOT NULL,
    `price` FLOAT NOT NULL
)");*/
//$db->query("INSERT INTO `products` (`name`, `description`, `price`) VALUES ('Iphone', 'Iphone descr', 2019)");


if (isset($_POST['productAdd']))
{
    $insertProduct = new Product($_POST['productName'], $_POST['productDescription'], $_POST['productPrice']);
    $productRepository->create($insertProduct);
}
if (isset($_POST['updateProducts'])) {
    for ($i = 0; $i < count($_POST['productId']); $i++) {
        $updateProduct = new Product($_POST['productName'][$i], $_POST['productDescription'][$i], $_POST['productPrice'][$i],'', $_POST['productId'][$i]);
        $productRepository->update($updateProduct);
    }
}
if (isset($_POST['productDelete'])) {
    $productRepository->delete($_POST['productDelete']);
}

///*$insertProduct = new Product('Apple', 'Apple description', 1000);
//$productRepository->create($insertProduct);*/
$productRepository->delete(4);
$products = $productRepository->getProducts();

//$productUpdate = new Product($products[3]->getName(), );

echo "<pre>";
$counter = 1;
foreach ($products as $product) {
    echo $counter . " " . $product->getName() . "<br>";
    $counter++;
}
echo "</pre>";

?>
<form action="" method="post">
    <?php
    foreach ($products as $product):
        ?>
        <div>
            <label for="productId[]"><?= $product->getId(); ?></label>
            <input type="hidden" name="productId[]" value="<?= $product->getId(); ?>">
            <input type="text" name="productName[]" value="<?= $product->getName(); ?>">
            <input type="text" name="productDescription[]" value="<?= $product->getDescription(); ?>">
            <input type="text" name="productPrice[]" value="<?= $product->getPrice(); ?>">
            <button type="submit" name="productDelete" value="<?= $product->getId(); ?>">Remove</button>
        </div>
    <?php
    endforeach;
    ?>
    <br>
    <input type="submit" value="Save" name="updateProducts">
</form>


<form action="" method="post">
    <input required type="text" name="productName" value="" placeholder="Product name">
    <input required type="text" name="productDescription" placeholder="Product description">
    <input required type="text" name="productPrice" placeholder="Product price">
    <input type="submit" name="productAdd" value="Add new Product">
</form>