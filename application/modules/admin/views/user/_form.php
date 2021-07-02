<?php
if (!empty($data->role) && $data->role != 1) {
    $disabled = 'disabled';
    $role = [
        [
            'role' => 1,
            'nama' => 'Admin'
        ],
        // [
        //     'role' => 2,
        //     'nama' => 'Guru'
        // ],
        // [
        //     'role' => 3,
        //     'nama' => 'Siswa'
        // ],
    ];
} else {
    $disabled = '';
    $role = [
        [
            'role' => 1,
            'nama' => 'Admin'
        ],
    ];
}
?>
<form method="POST" action="<?= $action ?>" enctype="multipart/form-data">
    <div class="form-group">
        <label for="nama">Nama</label>
        <input class="form-control form-control-solid" id="nama" name="nama" type="text" value="<?= (!empty($data->nama)) ? $data->nama : set_value('nama') ?>" <?= $disabled ?>>
        <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input class="form-control form-control-solid" id="username" name="username" type="text" value="<?= (!empty($data->username)) ? $data->username : set_value('username') ?>" <?= $disabled ?>>
        <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input class="form-control form-control-solid" id="password" name="password" type="password">
        <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
    </div>
    <div class="form-group">
        <label for="password_repeat">Password Repeat</label>
        <input class="form-control form-control-solid" id="password_repeat" name="password_repeat" type="password">
        <?= form_error('password_repeat', '<small class="text-danger pl-3">', '</small>'); ?>
    </div>
    <div class="form-group">
        <label for="foto">Foto</label>
        <input class="form-control form-control-solid" id="foto" name="foto" type="file">
        <?= form_error('foto', '<small class="text-danger pl-3">', '</small>'); ?>
    </div>
    <div class="form-group">
        <label for="role">Role</label>
        <select name="role" id="role" class="form-control form-control-solid " <?= $disabled ?>>
            <option value="">Pilih Role</option>
            <?php
            foreach ($role as $key => $val) :
            ?>
                <option value="<?= $val['role'] ?>" <?= (!empty($data->role)) ? $select = ($data->role == $val['role']) ? 'selected' : '' : '' ?>><?= $val['nama'] ?></option>
            <?php endforeach; ?>
        </select>
        <?= form_error('role', '<small class="text-danger pl-3">', '</small>'); ?>
    </div>
    <div class="form-group">
        <a href="<?= base_url(__ADMIN . 'user') ?>" class="btn btn-warning"><i class="fa fa-arrow-left"></i>&nbsp; Kembali</a>
        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i>&nbsp;Simpan</button>
    </div>
</form>