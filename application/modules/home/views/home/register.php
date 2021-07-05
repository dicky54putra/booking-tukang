<section class="login position-relative">
    <div class="container vh-100 d-flex align-items-center justify-content-center">
        <div class="row text-center justify-content-center">
            <div class="col-12 mb-3">
                <h1 class="h1">Booking<span>Tukang</span></h1>
            </div>
            <div class="col-10">
                <div class="one">
                    <input type="text" class="form-control mb-3" id="username" placeholder="Username" name="username">
                    <input type="text" class="form-control mb-3" id="no_hp" placeholder="No HP" name="no_hp">
                    <input type="text" class="form-control mb-3" id="alamat" placeholder="Alamat (Kota, Provinsi)" name="alamat">
                    <input type="text" class="form-control mb-3" id="jk" placeholder="Jenis Kelamin" name="jk">
                    <select class="form-control mb-3" name="jk" id="jk">
                        <option disabled selected hidden>Pilih Jenis Kelamin</option>
                        <option value="1">Laki-Laki</option>
                        <option value="0">Perempuan</option>
                    </select>
                    <select class="form-control mb-3" name="jenis" id="jenis">
                        <option disabled selected hidden>Pilih Jenis Akun</option>
                        <option value="1">Tukang</option>
                        <option value="0">Mitra Tukang</option>
                    </select>
                    <button type="button" class="btn btn-primary w-100">SELANJUTNYA</button>
                </div>
                <div class="two" style="display: none;">
                    <input type="text" class="form-control mb-3" id="email" placeholder="Email" name="email">
                    <input type="password" class="form-control mb-3" id="password" placeholder="Password" name="password">
                    <input type="password" class="form-control mb-3" id="password_repeat" placeholder="Ulangi Password" name="password_repeat">
                    <button type="button" class="btn btn-primary w-100">SELANJUTNYA</button>
                </div>
            </div>
        </div>
    </div>
    <p class="d-flex w-100 fs-6 position-absolute bottom-0 d-flex justify-content-center">Sudah punya akun? <a href="<?= base_url('login') ?>" class="ms-1">Login</a></p>
</section>