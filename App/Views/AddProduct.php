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
        <input required type="text" name="productName" value="" placeholder="Product name">
        <input required type="text" name="productDescription" placeholder="Product description">
        <input required type="text" name="productPrice" placeholder="Product price">
        <input type="submit" name="productAdd" value="Add new Product">
    </form>
</div>
</body>
</html>