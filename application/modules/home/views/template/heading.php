<?php
$titleApp = explode(" ", ($titleApp ?? 'Booking Tukang'));
?>
<header class="fixed-top">
    <div class="container d-flex align-items-center justify-content-between">
        <h1 class="h1"><?= $titleApp[0] ?><span><?= $titleApp[1] ?></span></h1>
        <div class="cart position-relative d-block">
            <?= icons('cart.svg') ?>
            <span>99</span>
        </div>
    </div>
</header>