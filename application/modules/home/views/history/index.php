<main>
    <div class="container">
        <div class="row ">
            <div class="col-12 d-flex justify-content-end">
                <button class="btn btn-success px-5" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">Filter</button>
            </div>
        </div>
        <div class="row justify-content-center mt-3">
            <div class="col-12 col-md-10 col-lg-8">
                <?php $total = 0; ?>
                <?php foreach ($carts as $cart) { ?>
                    <?php
                    $total += $cart->fee;
                    if ($cart->status == 1) {
                        $color = '#ffc107';
                        $status = 'Cart';
                    } else if ($cart->status == 2) {
                        $color = '#0d6efd';
                        $status = 'Proses';
                    } else if ($cart->status == 3) {
                        $color = '#198754';
                        $status = 'Selesai';
                    }
                    ?>
                    <hr>
                    <table class="pt-2 w-100">
                        <tr style="font-size: 12px;">
                            <td><?= tanggal_indo($cart->tanggal_awal) ?> - <?= tanggal_indo($cart->tanggal_akhir) ?></td>
                            <td style="text-align: right;">Total fee:</td>
                        </tr>
                        <tr style="font-size: 24px; font-weight: 600;">
                            <td><?= $cart->deskripsi ?></td>
                            <td style="text-align: right;"><?= short_rp($cart->fee) ?></td>
                        </tr>
                        <tr style="font-size: 15px;">
                            <td>Tukang: <?= $cart->nama_tukang ?> | bos: <?= $cart->nama_pemesan ?></td>
                            <td style="text-align: right; color:<?= $color ?>;"><?= $status ?></td>
                        </tr>
                    </table>
                <?php } ?>
                <hr>
                <table class="w-100">
                    <tr style=" font-size: 24px; font-weight: 600;">
                        <td>Total</td>
                        <td style="text-align: right;"><?= short_rp($total) ?></td>
                </table>
            </div>
        </div>
    </div>
</main>


<div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel" style="border-radius: 20px;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title text-start" id="offcanvasBottomLabel">Filter</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body small">
        <form action="<?= base_url('proyek/add-to-cart') ?>" method="post" id="formlogin" name="formlogin" class="needs-validation" novalidate>
            <input type="hidden" class="form-control mb-3" name="url" value="<?= current_url() ?>">


            <button type="submit" class="btn btn-primary w-100 mb-5">CARI</button>
        </form>
    </div>
</div>