<section class="login position-relative">
    <div class="container vh-100 d-flex align-items-center justify-content-center">
        <div class="row text-center justify-content-center">
            <div class="col-12 mb-3">
                <h1 class="h1">Data<span> Personal</span></h1>
            </div>
            <div class="col-10">
                <form action="<?= base_url('profile/edit') ?>" method="post" id="formlogin" name="formlogin" class="needs-validation" novalidate>
                    <input type="text" class="form-control mb-3" id="nama" placeholder="Nama" name="nama" value="<?= $data->nama ?>">
                    <input type="text" class="form-control mb-3" id="no_hp" placeholder="No HP" name="no_hp" value="<?= $data->no_hp ?>">
                    <input type="text" class="form-control mb-3" id="email" placeholder="Email" name="email" value="<?= $data->email ?>">
                    <textarea name="alamat" class="form-control mb-3" id="alamat" rows="5" placeholder="Alamat"><?= $data->alamat ?></textarea>
                    <select name="jk" id="jk" class="form-control mb-3">
                        <option value="1" <?= $data->jk === 1 ? 'selected' : '' ?>>Laki-laki</option>
                        <option value="0" <?= $data->jk === 0 ? 'selected' : '' ?>>Perempuan</option>
                    </select>
                    <button type="submit" class="btn btn-primary w-100">UBAH</button>
                </form>
            </div>
        </div>
    </div>
    <p class="d-flex w-100 fs-6 position-absolute bottom-0 d-flex justify-content-center">Belum punya akun? <a href="<?= base_url('register') ?>" class="ms-1">Daftar</a></p>
</section>