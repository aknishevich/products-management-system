<?php require_once "Header.php"; ?>
<title>Main</title>
</head>
<body>
<?php
require_once "Menu.php";
?>
<div class="container my-5">
    <h1 class="text-center my-5">Products</h1>
    <div class="row">
        <?php
        $page = isset($_GET['pageId']) ? $_GET['pageId'] : null;
        $pLength = 8;
        $productRepository = new \App\Repository\ProductRepository();
        $products = $productRepository->getProducts($page, $pLength);
        foreach ($products as $product):
            ?>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a href="/product?id=<?= $product->getId(); ?>">
                    <h4><?= $product->getName(); ?></h4>
                    <img style="width: 100%;" src="https://via.placeholder.com/200x150"
                         alt="Here should be an image =(">
                    <small>Here should have been an image = (</small>
                </a>
            </div>

        <?php
        endforeach;
        ?>
    </div>
    <?php
    include_once "Pagination.php";
    ?>
</div>
</body>
</html>
