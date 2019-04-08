<?php require_once "Header.php"; ?>
<title>Add Product</title>
</head>

<body>
<?php
require_once "Menu.php";
?>
<div class="container my-5">
    <?php echo $GLOBALS['handle'](); ?>
    <h1 class="text-center my-5">Add Product</h1>
    <form action="/addProduct" method="post">
        <div class="form-group">
            <label for="productName">Product Name</label>
            <input required type="text" class="form-control" id="productName" name="productName"
                   value="<?= isset($_POST['productName']) ? $_POST['productName'] : '' ?>">
        </div>
        <div class="form-group">
            <label for="productDescription">Product description</label>
            <textarea required type="text" class="form-control" id="productDescription"
                      name="productDescription"><?= isset($_POST['productDescription']) ?
                                                          $_POST['productDescription'] : '' ?></textarea>
        </div>
        <div class="form-group">
            <label for="productPrice">Product price</label>
            <input required type="text" class="form-control" id="productPrice" name="productPrice"
                   value="<?= isset($_POST['productPrice']) ? $_POST['productPrice'] : '' ?>">
        </div>
        <div class="form-group">
            <label for="productAttributes">Product attributes
                <small>(optional)</small>
            </label>
            <input type="text" class="form-control" id="productAttributes" name="productAttributes"
                   name="productAttributes"
                   value="<?= isset($_POST['productAttributes']) ? $_POST['productAttributes'] : '' ?>">
            <small>Use IDs from Attributes ID list on <a href="/attributes">Attributes page</a>
                separated by commas. For example: "1,7,10,14"</small>
        </div>
        <input type="submit" name="productAdd" class="btn btn-sm btn-success" value="Add new Product">
    </form>
</div>
</body>
</html>
