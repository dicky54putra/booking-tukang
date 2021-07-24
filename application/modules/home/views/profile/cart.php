<main>
    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="col-12 col-md-10 col-lg-8">
                <?php
                $total = 0;
                $id_project = ''
                ?>
                <?php foreach ($carts as $cart) { ?>
                    <?php
                    $total += $cart->fee;
                    $id_project .= $cart->id_proyek . '-';
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
                            <td colspan="2">Tukang: <?= $cart->nama_tukang ?> | bos: <?= $cart->nama_pemesan ?></td>
                        </tr>
                    </table>
                <?php } ?>
                <hr>
                <table class="w-100">
                    <tr style=" font-size: 24px; font-weight: 600;">
                        <td>Total</td>
                        <td style="text-align: right;"><?= short_rp($total) ?></td>
                </table>
                <button class="btn btn-primary w-100 mt-5" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">Bayar</button>
            </div>
        </div>
    </div>
</main>


<div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel" style="border-radius: 20px;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title text-start" id="offcanvasBottomLabel">Konfirmasi Pembayaran</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body small pb-4">
        <div class="text-center">
            <p>Apakah anda yakin ?</p>
            <?php $id_project = substr($id_project, 0, -1) ?>
            <a href="<?= base_url('profile/cart/' . $id_project) ?>" class="btn btn-success">Konfirmasi Pembayaran</a>
        </div>
    </div>
</div>