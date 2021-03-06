<br>
<div class="container">
    <!-- <div class="row ">
        <div class="col-12 d-flex justify-content-end">
            <button class="btn btn-success px-5" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">Filter</button>
        </div>
    </div> -->
    <div class="row justify-content-center mt-3">
        <div class="col-12 col-md-10 col-lg-8">
            <?php $total = 0; ?>
            <?php foreach ($carts as $cart) { ?>
                <?php
                $total += $cart->fee;
                if ($cart->status == 1) {
                    $color = '#ffc107';
                    $status = 'Order';
                } else if ($cart->status == 2) {
                    $color = '#0d6efd';
                    $status = 'On Progress';
                } else if ($cart->status == 3) {
                    $color = '#198754';
                    $status = 'Lunas';
                } else {
                    $color = '#EF629E';
                    $status = 'Canceled';
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
                    <tr style="font-size: 15px; background: #ECECEC;">
                        <td>Tukang: <?= $cart->nama_tukang ?> | bos: <?= $cart->nama_pemesan ?></td>
                        <td style="text-align: right; color:<?= $color ?>;"><?= $status ?></td>
                    </tr>
                    <?php if ($cart->status == 3) { ?>
                        <tr style="font-size: 15px;">
                            <td>Penilaian:</td>
                            <td style="text-align: right; ">
                                <span class="badge bg-success" type="button" data-bs-toggle="offcanvas" data-bs-target="#penilaian" aria-controls="offcanvasBottom" onclick="getProyek(<?= $cart->id_proyek ?>);"><?= $cart->skor ?? 0 ?></span>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } ?>
            <!-- <hr>
            <table class="w-100">
                <tr style=" font-size: 24px; font-weight: 600;">
                    <td>Total</td>
                    <td style="text-align: right;"><?= short_rp($total) ?></td>
            </table> -->
        </div>
    </div>
</div>



<div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel" style="border-radius: 20px;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title text-start" id="offcanvasBottomLabel">Filter</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body small">
        <form action="<?= base_url('history') ?>" method="post" id="formlogin" name="formlogin" class="needs-validation" novalidate>
            <input type="text" class="form-control mb-3" id="tanggal_awal" placeholder="Tanggal Awal" name="tanggal_awal" type="text" onMouseOver="(this.type='date')" onMouseOut="(this.type='text')" value="<?= $post['tanggal_awal'] ?? '' ?>">
            <input type="text" class="form-control mb-3" id="tanggal_akhir" placeholder="Tanggal Akhir" name="tanggal_akhir" type="text" onMouseOver="(this.type='date')" onMouseOut="(this.type='text')" value="<?= $post['tanggal_akhir'] ?? '' ?>">
            <textarea class="form-control mb-3" name="deskripsi" id="deskripsi" cols="30" rows="3" placeholder="Deskripsi"><?= $post['deskripsi'] ?? '' ?></textarea>
            <textarea class="form-control mb-3" name="lokasi" id="lokasi" cols="30" rows="3" placeholder="Alamat"><?= $post['alamat'] ?? '' ?></textarea>
            <input type="text" class="form-control mb-3" id="fee" placeholder="Total Fee" name="fee" value="<?= $post['fee'] ?? '' ?>">
            <select name="status" class="form-control mb-3" id="status">
                <option value="">Pilih Status</option>
                <option value="1" <?= selected_option($post['status'], 1) ?>>Cart</option>
                <option value="2" <?= selected_option($post['status'], 2) ?>>Proses</option>
                <option value="3" <?= selected_option($post['status'], 3) ?>>Selesai</option>
            </select>

            <button type="submit" class="btn btn-primary w-100 mb-5">CARI</button>
        </form>
    </div>
</div>


<div class="offcanvas offcanvas-bottom" tabindex="-1" id="penilaian" aria-labelledby="offcanvasBottomLabel" style="border-radius: 20px;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title text-start" id="offcanvasBottomLabel">Filter</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body small">
        <form action="" method="post" id="formEditSkor" name="formEditSkor" class="needs-validation">
            <input type="number" min="1" max="10" class="form-control mb-3" id="nilai" placeholder="Nilai" name="nilai">

            <button type="submit" class="btn btn-primary w-100 mb-5">NILAI</button>
        </form>
    </div>
</div>

<script>
    const tAwal = document.getElementById('tanggal_awal')
    const tAkhir = document.getElementById('tanggal_akhir')

    tAwal.oninput = () => {
        const dateTAwal = new Date(tAwal.value)
        const dateTAkhir = new Date(tAkhir.value)
        tAkhir.setAttribute("min", tAwal.value)
    }
    tAkhir.oninput = () => {
        const dateTAkhir = new Date(tAkhir.value)
        const dateTAwal = new Date(tAwal.value)
        tAwal.setAttribute("max", tAkhir.value)
    }

    const getProyek = id => {
        const form = document.getElementById('formEditSkor')
        const form_url = `<?= base_url('proyek/update-skor/') ?>`
        const nilai = document.getElementById('nilai')
        fetch(`<?= base_url('proyek/get-proyek/') ?>${id}`)
            .then(response => response.json())
            .then(data => {
                form.setAttribute('action', `${form_url}${id}`)
                nilai.value = data.skor
            })
            .catch(err => console.log(err))
    }
</script>