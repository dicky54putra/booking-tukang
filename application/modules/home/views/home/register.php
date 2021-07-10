<section class="login position-relative">
    <div class="container vh-100 d-flex align-items-center justify-content-center">
        <div class="row text-center justify-content-center">
            <div class="col-12 mb-3">
                <h1 class="h1">Booking<span>Tukang</span></h1>
            </div>
            <div class="col-10">
                <form action="" method="post" id="formRegister" name="formRegister" class="needs-validation" novalidate>
                    <div class="one">
                        <div class="input-group has-validation">
                            <input type="text" class="form-control mb-3" id="nama" placeholder="Nama" name="nama" required>
                        </div>
                        <div class="input-group has-validation">
                            <input type="text" class="form-control mb-3" id="email" placeholder="Email" name="email" required>
                        </div>
                        <div class="input-group has-validation">
                            <input type="text" class="form-control mb-3" id="no_hp" placeholder="No HP" name="no_hp" required>
                        </div>
                        <div class="input-group has-validation">
                            <input type="text" class="form-control mb-3" id="alamat" placeholder="Alamat (Kota, Provinsi)" name="alamat" required>
                        </div>
                        <span type="button" class="btn btn-primary w-100" id="selanjutnya">SELANJUTNYA</span>
                    </div>


                    <div class="two" style="display: none;">
                        <input type="text" class="form-control mb-3" id="username" placeholder="Username" name="username">
                        <input type="password" class="form-control mb-3" id="password" placeholder="Password" name="password" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Must have at least 6 characters' : ''); if(this.checkValidity()) form.password_repeat.pattern = this.value;">
                        <input type="password" class="form-control mb-3" id="password_repeat" placeholder="Ulangi Password" name="password_repeat" pattern="^\S{6,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter the same Password as above' : '');">
                        <button type="submit" id="submit" class="btn btn-primary w-100">DAFTAR</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <p class="d-flex w-100 fs-6 position-absolute bottom-0 d-flex justify-content-center">Sudah punya akun? <a href="<?= base_url('login') ?>" class="ms-1">Login</a></p>
</section>

<script>
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')
        const next = document.querySelector('#selanjutnya')
        const frontPage = document.querySelector('.one')
        const backPage = document.querySelector('.two')
        const submit = document.querySelector('#submit')

        const uname = document.querySelector('#username')
        const pw = document.querySelector('#password')
        const pwRepeat = document.querySelector('#password_repeat')


        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                next.addEventListener('click', function(event) {
                    if (form.checkValidity()) {
                        frontPage.style.display = 'none';
                        backPage.style.display = 'block';

                        uname.setAttribute('required', true)
                        pw.setAttribute('required', true)
                        pwRepeat.setAttribute('required', true)

                        form.classList.remove('was-validated')
                    } else {
                        form.classList.add('was-validated')
                    }

                }, false)

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