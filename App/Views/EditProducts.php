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
        separated by commas. For example: "1,7,10,14"
    </small>
    <div class="row">
        <form action="" method="post">
            <table class="table">
                <?php
                $page = isset($_GET['pageId']) ? $_GET['pageId'] : null;
                $pLength = 5;
                $productRepository = new \App\Repository\ProductRepository();
                $products = $productRepository->getProducts($page, $pLength);
                ?>
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Price</th>
                        <th scope="col">Attributes</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <?php
                foreach ($products as $product):
                    ?>
                    <tr>
                        <td>
                            <?= $product->getId(); ?>
                        </td>
                        <td>
                            <input type="hidden" name="productId[]" value="<?= $product->getId(); ?>">
                            <input type="text" name="productName[]" value="<?= $product->getName(); ?>">
                        </td>
                        <td>
                            <textarea class="form-control"
                                      name="productDescription[]"><?= $product->getDescription(); ?></textarea>
                        </td>
                        <td>
                            <input type="text" name="productPrice[]" value="<?= $product->getPrice(); ?>">
                        </td>
                        <td>
                            <input type="text" name="productAttributes[]"
                                   value="<?= $product->getAttributesAsString(); ?>">
                        </td>
                        <td>
                            <button type="submit" class="btn btn-sm btn-danger" name="productDelete"
                                    value="<?= $product->getId(); ?>">Remove
                            </button>
                        </td>
                    </tr>
                <?php
                endforeach;
                ?>
                <br>
            </table>
            <input type="submit" class="btn btn-success" value="Save" name="updateProducts">
        </form>
    </div>
    <?php
    include_once "Pagination.php";
    ?>
</div>
</body>
</html>
