<main>
    <div class="container">
        <div class="row justify-content-center mt-3 mb-5">
            <div class="col-md-6 text-center">
                <?php $foto = empty($tukang->foto) ? '404.png' : $tukang->foto; ?>
                <figure class="d-flex align-items-center justify-content-center">
                    <img src="<?= base_url('upload/user/' . get_foto($foto)) ?>" alt="" class="img-cover" srcset="" width="100">
                </figure>
                <h3 class="h3"><?= $tukang->nama ?? '' ?></h3>
                <table class="table w-100">
                    <tr>
                        <td>Fee / day</td>
                        <td>:</td>
                        <td><?= rp($tukang->fee_per_day ?? 0) ?></td>
                    </tr>
                    <tr>
                        <td>no HP</td>
                        <td>:</td>
                        <td><?= $tukang->no_hp ?? '' ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td><?= $tukang->alamat ?? '' ?></td>
                    </tr>
                    <tr>
                        <td>Skils</td>
                        <td>:</td>
                        <td>
                            <?php foreach ($skills as $skill) { ?>
                                <span class="badge bg-success"><?= $skill ?></span>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Rating</td>
                        <td>:</td>
                        <td><?= skor($tukang->id_tukang) ?></td>
                    </tr>
                    <tr>
                        <td>Total Proyek Selesai</td>
                        <td>:</td>
                        <td><?= total_proyek($tukang->id_tukang) ?></td>
                    </tr>
                </table>
                <button class="btn btn-primary mb-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">Pilih Tukang</button>
            </div>
        </div>
    </div>
</main>

<div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel" style="border-radius: 20px;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title text-start" id="offcanvasBottomLabel">Pilih Tukang : <?= $tukang->nama ?> <br> fee: <?= rp($tukang->fee_per_day) ?> /Hari</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body small pb-4">
        <form action="<?= base_url('proyek/add-to-cart') ?>" method="post" id="formlogin" name="formlogin" class="needs-validation" novalidate>
            <input type="hidden" class="form-control mb-3" name="id_tukang" value="<?= $tukang->id_tukang ?>">
            <input type="hidden" class="form-control mb-3" name="id_pemesan" value="<?= $pemesan->id_pemesan ?>">
            <input type="hidden" class="form-control mb-3" name="url" value="<?= current_url() ?>">
            <input type="text" class="form-control mb-3" id="tanggal_awal" placeholder="Tanggal Awal" name="tanggal_awal" type="text" onMouseOver="(this.type='date')" onMouseOut="(this.type='text')" required>
            <input type="text" class="form-control mb-3" id="tanggal_akhir" placeholder="Tanggal Akhir" name="tanggal_akhir" type="text" onMouseOver="(this.type='date')" onMouseOut="(this.type='text')" required>
            <textarea class="form-control mb-3" name="deskripsi" id="deskripsi" cols="30" rows="3" placeholder="Deskripsi" required></textarea>
            <textarea class="form-control mb-3" name="lokasi" id="lokasi" cols="30" rows="3" placeholder="Alamat" required></textarea>
            <input type="text" class="form-control mb-3" id="fee" placeholder="Total Fee" name="fee" readonly>

            <button type="submit" class="btn btn-primary w-100 mb-5">PILIH</button>
        </form>
    </div>
</div>

<script>
    const tAwal = document.getElementById('tanggal_awal')
    const tAkhir = document.getElementById('tanggal_akhir')
    const fee = document.getElementById('fee')

    function getDay(dateTAwal, dateTAkhir) {
        const h = (dateTAkhir - dateTAwal) / (1000 * 60 * 60 * 24)

        fee.value = h * <?= $tukang->fee_per_day ?? 0 ?>;
        console.log(h);
    }

    tAwal.oninput = () => {
        const dateTAwal = new Date(tAwal.value)
        const dateTAkhir = new Date(tAkhir.value)

        getDay(dateTAwal, dateTAkhir)
        tAkhir.setAttribute("min", tAwal.value)
    }
    tAkhir.oninput = () => {
        const dateTAkhir = new Date(tAkhir.value)
        const dateTAwal = new Date(tAwal.value)
        tAwal.setAttribute("max", tAkhir.value)
        console.log(tAkhir.value);
        getDay(dateTAwal, dateTAkhir)
    }

    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>