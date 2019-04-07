<?php require_once "Header.php"; ?>
    <title>Main</title>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/">Homepage</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/addProduct">Add Product</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/editProducts">Edit Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/attributes">Attributes List</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container my-5">
    <h1 class="text-center my-5">Products</h1>
    <div class="row">
        <?php
        $productRepository = new \App\Repository\ProductRepository();
        $products = $productRepository->getProducts();
        foreach ($products as $product):
        ?>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a href="/product?id=<?= $product->getId(); ?>">
                    <h4><?= $product->getName(); ?></h4>
                    <figure>
                        <img style="width: 100%;" src="https://via.placeholder.com/200x150" alt="Here should be an image =(">
                    </figure>
                    <small>Here should have been an image = (</small>
                </a>
            </div>

        <?php
        endforeach;
        ?>
    </div>
</div>

<?php

var_dump(\Respect\Validation\Validator::notEmpty()->validate('21'));

/*$productRepository = new \App\Repository\ProductRepository;
$attrName = $attributes->getAttributesValue();
foreach ($attrName as $item) {
    echo $item->getName() . ": " . $item->getValue(). "<br>";
}
*/?>
</body>
</html>