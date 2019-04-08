<?php require_once "Header.php"; ?>
<title>Product</title>
</head>
<body>
<?php
require_once "Menu.php";
?>
<div class="container my-5">
    <?php
    $productRepository = new \App\Repository\ProductRepository();
    if (isset($_GET['id']) && (null !== ($page = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE)))) {
        $product = $productRepository->getProducts(null, null, "id", $_GET['id'])[0];
        $attributes = $product->getAttributes();
        ?>
        <h1 class="text-success mt-4 mb-3 text-center"> <?= $product->getName(); ?></h1>
        <h3 class="text-danger text-center"><?= $product->getPrice(); ?>$</h3>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mx-auto">
                <img style="width: 100%; margin-bottom: 2rem;" src="https://via.placeholder.com/400x250" alt="Here should be an image =(">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mx-auto">
                <p style="font-size: 20px;"><?= $product->getDescription(); ?></p>
                <h2>Specifications:</h2>
                <?php
                foreach ($attributes as $attribute) {
                    if (!empty($attribute)) {
                        echo '<strong>' . $attribute->getName() . ':</strong> ' . $attribute->getValue() . "<br>";
                    }
                }
                ?>
            </div>
        </div>
    <?php
    }
    else { ?>
        <h1>Product not found</h1>
    <?php
    }
    ?>
</div>
</body>
</html>
