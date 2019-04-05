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
        </ul>
    </div>
</nav>
<div class="container">
    <h1 class="text-center" style="color: blue;">Home page</h1>
    <div class="row">
        <?php
        $productRepository = new \App\Repository\ProductRepository();
        $products = $productRepository->getProducts();
        foreach ($products as $product):
        ?>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <h4><a href="/product?id=<?= $product->getId(); ?>"><?= $product->getName(); ?></a></h4>
        </div>
        <?php
        endforeach;
        ?>
    </div>
</div>
</body>
</html>