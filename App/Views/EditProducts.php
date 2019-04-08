<?php require_once "Header.php"; ?>
<title>Add Product</title>
</head>
<body>
<?php
require_once "Menu.php";
?>
<div class="container mb-5">
    <?php echo $GLOBALS['handle'](); ?>
    <h1 class="text-center my-4">Edit Products</h1>
    <small>For Attributes use IDs from Attributes ID list on <a href="/attributes">Attributes page</a>
        separated by commas.</small>
    <div class="row">
        <form action="" method="post">
            <?php
            $page = isset($_GET['pageId']) ? $_GET['pageId'] : null;
            $pLength = 5;
            $productRepository = new \App\Repository\ProductRepository();
            $products = $productRepository->getProducts($page, $pLength);
            foreach ($products as $product):
                ?>
                <div class="form-group">
                    <label for="productId[]"><?= $product->getId(); ?></label>
                    <input type="hidden" name="productId[]" value="<?= $product->getId(); ?>">
                    <input type="text" name="productName[]" value="<?= $product->getName(); ?>">
                    <input type="text" name="productDescription[]" value="<?= $product->getDescription(); ?>">
                    <input type="text" name="productPrice[]" value="<?= $product->getPrice(); ?>">
                    <input type="text" name="productAttributes[]" value="<?= $product->getAttributesAsString(); ?>">
                    <button type="submit" class="btn btn-sm btn-danger" name="productDelete"
                            value="<?= $product->getId(); ?>">Remove
                    </button>
                </div>
            <?php
            endforeach;
            ?>
            <br>
            <input type="submit" class="btn btn-success" value="Save" name="updateProducts">
        </form>
    </div>
    <?php
    include_once "Pagination.php";
    ?>
</div>
</body>
</html>
