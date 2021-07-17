<main>
    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="col-12 col-md-10 col-lg-8">
                <?php $total = 0; ?>
                <?php foreach ($carts as $cart) { ?>
                    <?php
                    $total += $cart->fee;
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
                <button class="btn btn-primary w-100 mt-5">Bayar</button>
            </div>
        </div>
    </div>
</main>