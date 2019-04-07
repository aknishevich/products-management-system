<?php require_once "Header.php"; ?>
<title>Attributes</title>
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
            <li class="nav-item active">
                <a class="nav-link" href="/attributes">Attributes List</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container my-5">
    <h1 class="text-center my-5">Attributes</h1>
    <?php
    $attributeValueRepository = new \App\Repository\AttributeValueRepository();
    $attributeNameRepository = new \App\Repository\AttributeNameRepository();
    $attributeNames = $attributeNameRepository->getAttributesName();
    foreach ($attributeNames as $attributeName): ?>
        <h4 class="mt-3"><?= $attributeName->getName(); ?></h4>
        <?php
        $attributeValues = $attributeValueRepository->getAttributesValue('parent', $attributeName->getId());
        foreach ($attributeValues as $attributeValue): ?>
            <span class="ml-5"><strong>ID(<?= $attributeValue->getId(); ?>)</strong><?= $attributeValue->getValue(); ?></span>
        <?php
        endforeach;
    endforeach;
    ?>
</div>
</body>
</html>