<main>
    <div class="container">
        <div class="row justify-content-center mt-3 mb-5">
            <div class="col-md-6 text-center">
                <figure class="d-flex align-items-center justify-content-center">
                    <img src="<?= base_url('upload/user/' . get_foto($tukang->foto)) ?>" alt="" class="img-cover" srcset="" width="100">
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
                </table>

                <a href="" class="btn btn-primary mb-3">Pilih Tukang</a>
            </div>
        </div>
    </div>
</main>