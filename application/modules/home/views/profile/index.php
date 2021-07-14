<main>
    <div id="profile" class="container">
        <div class="row justify-content-center">
            <div class="col-6 text-center">
                <img class="img-thumbnail img-cover" src="<?= base_url('upload/user/' . get_foto($session->foto)) ?>" alt="" srcset="" style="width: 100px; height: 100px; border-radius: 50%;">
                <h5><?= $session->nama ?></h5>
                <p class="profesi">Tukang</p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-11 col-md-8 col-lg-6">
                <table style="width: 100%;">
                    <tr>
                        <th colspan="2">Data Pribadi</th>
                    </tr>
                    <tr>
                        <td style="width: 50%;">Nama</td>
                        <td style="text-align: right;"><?= $session->nama ?></td>
                    </tr>
                    <tr>
                        <td>No Hp</td>
                        <td style="text-align: right;"><?= $user->no_hp ?? '' ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td style="text-align: right;"><?= $user->email ?? '' ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td style="text-align: right;"><?= $user->alamat ?? '' ?></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <?php
                        if (!empty($user->jk)) {
                            $jk = ($user->jk === 1) ? 'Laki-laki' : $pm = ($user->jk === 0) ? 'Perempuan' : '';
                        }
                        ?>
                        <td style="text-align: right;"><?= $jk ?? '' ?></td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                    </tr>
                    <?php if (!empty($user->id_tukang)) { ?>
                        <tr>
                            <th colspan="2">Data Tukang</th>
                        </tr>
                        <tr>
                            <td style="width: 50%;">Skills</td>
                            <td style="text-align: right;">></td>
                        </tr>
                        <tr>
                            <td>Deskripsi</td>
                            <td style="text-align: right;">></td>
                        </tr>
                        <tr>
                            <td>Fee per hari</td>
                            <td style="text-align: right;">></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="2"><a href="<?= base_url('profile/edit') ?>" class="btn btn-primary w-100 mt-3 mb-3">PERBARUI DATA PERSONAL</a></td>
                    </tr>
                    <tr>
                        <th colspan="2">Data Akun</th>
                    </tr>
                    <tr>
                        <td style="width: 50%;">username</td>
                        <td style="text-align: right;"><?= $session->username ?></td>
                    </tr>
                    <tr>
                        <td colspan="2"><a href="<?= base_url('profile/edit-akun') ?>" class="btn btn-primary w-100 mt-3">PERBARUI DATA AKUN</a></td>
                    </tr>
                </table>
                <form action="<?= base_url('logout') ?>" method="post">
                    <input type="hidden" name="isPost" value="true">
                    <button type="submit" class="btn btn-danger w-100 mt-3 mb-3">LOGOUT</button>
                </form>
            </div>
        </div>

    </div>
</main>