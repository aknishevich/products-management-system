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
        </ul>
    </div>
</nav>
<div class="container">
    <h1 class="text-center my-5">Add Product</h1>
    <form action="/addProduct" method="post">
        <div class="form-group">
            <input required type="text" class="form-control" name="productName" value="" placeholder="Product name">
        </div>
        <div class="form-group">
            <input required type="text" class="form-control" name="productDescription" placeholder="Product description">
        </div>
        <div class="form-group">
            <input required type="text" class="form-control" name="productPrice" placeholder="Product price">
        </div>
        <div class="form-group">
            <label for="productFile">Select photo for the file (optional)</label>
            <input type="file" class="form-control" id="productFile" name="productFile">
        </div>
        <input type="submit" name="productAdd" value="Add new Product">
    </form>
</div>
</body>
</html>