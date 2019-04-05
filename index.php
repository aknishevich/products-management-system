<?php

require_once "App/bootstrap.php";

exit;

echo "<pre>";
$counter = 1;
$productRepository = new \App\Repository\ProductRepository();
$products = $productRepository->getProducts();
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




<?php
echo "<pre>";
var_dump($_GET);
echo "</pre>";