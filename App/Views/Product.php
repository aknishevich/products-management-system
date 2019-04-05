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
        </ul>
    </div>
</nav>
<div class="container">
    <?php
    $productRepository = new \App\Repository\ProductRepository();
    $product = $productRepository->getProducts("id", $_GET['id'])[0];
    ?>
    <h1 style="color: red;"><?= $product->getName(); ?></h1>
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

            <h4>Id: <span><?= $product->getId(); ?></span></h4>
            <h4>Name: <span><?= $product->getName(); ?></span></h4>
            <h4>Description: <span><?= $product->getDescription(); ?></span></h4>
            <h4>Price: <span><?= $product->getPrice(); ?></span></h4>

        </div>
    </div>
</div>
</body>
</html>