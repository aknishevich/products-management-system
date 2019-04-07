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
            <li class="nav-item active">
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
    <?php echo $GLOBALS['handle'](); ?>
    <h1 class="text-center my-5">Add Product</h1>
    <form action="/addProduct" method="post">
        <div class="form-group">
            <label for="productName">Product Name</label>
            <input required type="text" class="form-control" id="productName" name="productName" value="<?= $_POST['productName'] ?>" placeholder="Product name">
        </div>
        <div class="form-group">
            <label for="productDescription">Product description</label>
            <input required type="text" class="form-control" id="productDescription" name="productDescription" value="<?= $_POST['productDescription'] ?>" placeholder="Product description">
        </div>
        <div class="form-group">
            <label for="productPrice">Product price</label>
            <input required type="text" class="form-control" id="productPrice" name="productPrice" value="<?= $_POST['productPrice'] ?>" placeholder="Product price">
        </div>
        <div class="form-group">
            <label for="productAttributes">Product attributes <small>(optional)</small></label>
            <input type="text" class="form-control" id="productAttributes" name="productAttributes" name="productAttributes" value="<?= $_POST['productAttributes'] ?>" placeholder="1,5,7">
        </div>
        <input type="submit" name="productAdd" class="btn btn-sm btn-success" value="Add new Product">
    </form>
</div>
</body>
</html>