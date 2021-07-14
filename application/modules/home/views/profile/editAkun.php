<section class="login position-relative">
    <div class="container vh-100 d-flex align-items-center justify-content-center">
        <div class="row text-center justify-content-center">
            <div class="col-12 mb-3">
                <h1 class="h1">Data<span> Personal</span></h1>
            </div>
            <div class="col-10">
                <form action="<?= base_url('profile/edit-akun') ?>" method="post" id="formlogin" name="formlogin" class="needs-validation" novalidate enctype="multipart/form-data">
                    <div class="input-group has-validation">
                        <input type="text" class="form-control mb-3" id="username" placeholder="Username" name="username" value="<?= $data->username ?>" required>
                    </div>
                    <div class=" input-group has-validation">
                        <input type="password" class="form-control mb-3" id="password" placeholder="Password" name="password" pattern="^\S{3,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Must have at least 6 characters' : ''); if(this.checkValidity()) form.password_repeat.pattern = this.value;">
                    </div>
                    <div class="input-group has-validation">
                        <input type="password" class="form-control mb-3" id="password_repeat" placeholder="Ulangi Password" name="password_repeat" pattern="^\S{3,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter the same Password as above' : '');">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">UBAH</button>
                </form>
            </div>
        </div>
    </div>
    <p class="d-flex w-100 fs-6 position-absolute bottom-0 d-flex justify-content-center">Belum punya akun? <a href="<?= base_url('register') ?>" class="ms-1">Daftar</a></p>
</section>

<script>
    (function() {
        'use strict'

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