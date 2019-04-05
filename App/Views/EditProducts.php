<?php require_once "Header.php"; ?>
    <title>Add Product</title>
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
            <li class="nav-item active">
                <a class="nav-link" href="/editProducts">Edit Products</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container">
    <h1 class="text-center my-5">Edit Products page</h1>
    <div class="row">
        <form action="" method="post">
            <?php
            $productRepository = new \App\Repository\ProductRepository();
            $products = $productRepository->getProducts();
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
    </div>
</div>
</body>
</html>