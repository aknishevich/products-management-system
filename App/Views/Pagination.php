<?php

$pCount = $productRepository->getCount();

if (isset($_REQUEST['pageId']) && is_int((int)$_REQUEST['pageId']) && $_REQUEST['pageId'] >= 1) {
    if ($_REQUEST['pageId'] < ($pCount / $pLength + 1)) {
        $curPage = $_REQUEST['pageId'];
    } elseif (($pCount % $pLength) == 0) {
        $curPage = intval($pCount / $pLength);
    } else {
        $curPage = intval($pCount / $pLength) + 1;
    }
} else {
    $curPage = 1;
}
if (($pCount % $pLength) == 0) {
    $lastPage = intval($pCount / $pLength);
} else {
    $lastPage = intval($pCount / $pLength) + 1;
}

$rangeFrom = $curPage * $pLength - $pLength;

?>
<nav class="mt-4">
    <ul class="pagination justify-content-center">
        <li class="page-item <?php if ($curPage == 1) echo "disabled" ?>">
            <a class="page-link" href="/?pageId=1">Start</a>
        </li>
        <?php
        if ($curPage * $pLength - $pLength - 1 < $pCount && $curPage * $pLength - $pLength - 1 > 0) {
            if ($curPage * $pLength - 2 * $pLength - 1 < $pCount && $curPage * $pLength - 2 * $pLength - 1 > 0) { ?>
                <li class="page-item"><a class="page-link" href="?pageId=<?= $curPage - 2 ?>"><?= $curPage - 2 ?></a>
                </li>
            <?php } ?>
            <li class="page-item"><a class="page-link" href="?pageId=<?= $curPage - 1 ?>"><?= $curPage - 1 ?></a></li>
        <?php } ?>
        <li class="page-item active">
            <a class="page-link" href="?pageId=<?= $curPage ?>"><?= $curPage ?></a>
        </li>
        <?php
        if ($curPage * $pLength + 1 <= $pCount) {
            ?>
            <li class="page-item"><a class="page-link" href="?pageId=<?= $curPage + 1 ?>"><?= $curPage + 1 ?></a></li>
            <?php
            if ($curPage * $pLength + $pLength + 1 <= $pCount) { ?>
                <li class="page-item"><a class="page-link" href="?pageId=<?= $curPage + 2 ?>"><?= $curPage + 2 ?></a>
                </li>
            <?php }
        } ?>
        <li class="page-item <?php if ($pCount <= $curPage * $pLength) echo "disabled" ?>">
            <a class="page-link" href="?pageId=<?= $lastPage ?>">End</a>
        </li>
    </ul>
</nav>
