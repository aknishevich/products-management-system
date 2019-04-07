<?php require_once "Header.php"; ?>
    <title>Product</title>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
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
    <?php
    $productRepository = new \App\Repository\ProductRepository();
    $product = $productRepository->getProducts("id", $_GET['id'])[0];
    $attributes = $product->getAttributes();
    ?>
    <h1 class="text-success my-5 text-center"> <?= $product->getName(); ?> <small class="text-danger"><?= $product->getPrice(); ?>$</small></h1>
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <p style="font-size: 20px;"><?= $product->getDescription(); ?></p>
            <h2>Specifications:</h2>
            <?php
            foreach ($attributes as $attribute) {
                if (!empty($attribute)) {
                    echo $attribute->getName() . ": " . $attribute->getValue() . "<br>";
                }
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>