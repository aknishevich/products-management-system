<?php require_once "Header.php"; ?>
<title>Attributes</title>
</head>
<body>
<?php
require_once "Menu.php";
?>
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
            <span class="ml-5"><strong>ID(<?= $attributeValue->getId(); ?>)</strong><?= $attributeValue->getValue(); ?>
            </span>
        <?php
        endforeach;
    endforeach;
    ?>
</div>
</body>
</html>
