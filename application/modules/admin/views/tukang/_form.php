<form method="POST" action="<?= $action ?>">
    <div class="form-group">
        <label for="nama">Nama</label>
        <input class="form-control form-control-solid" id="nama" name="nama" type="text" value="<?= (!empty($data->nama)) ? $data->nama : set_value('nama') ?>">
        <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
    </div>
    <div class="form-group">
        <label for="jk">Jenis Kelamin</label>
        <select name="jk" id="jk" class="form-control form-control-solid js-example-basic-single">
            <option value="">Pilih Jenis Kelamin</option>
            <option value="1" <?= selected_option($data->jk, 1) ?>>Laki-laki</option>
            <option value="0" <?= selected_option($data->jk, 0) ?>>Perempuan</option>
        </select>
        <?= form_error('jk', '<small class="text-danger pl-3">', '</small>'); ?>
    </div>
    <div class="form-group">
        <label for="tanggal_lahir">Tanggal Lahir</label>
        <input class="form-control form-control-solid" id="tanggal_lahir" name="tanggal_lahir" type="date" value="<?= (!empty($data->tanggal_lahir)) ? $data->tanggal_lahir : set_value('tanggal_lahir') ?>">
        <?= form_error('tanggal_lahir', '<small class="text-danger pl-3">', '</small>'); ?>
    </div>
    <div class="form-group">
        <label for="alamat">alamat</label>
        <textarea class="form-control form-control-solid" name="alamat" id="alamat" cols="30" rows="5"><?= (!empty($data->alamat)) ? $data->alamat : set_value('alamat') ?></textarea>
        <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
    </div>
    <div class="form-group">
        <label for="no_hp">No HP</label>
        <input class="form-control form-control-solid" id="no_hp" name="no_hp" type="text" value="<?= (!empty($data->no_hp)) ? $data->no_hp : set_value('no_hp') ?>">
        <?= form_error('no_hp', '<small class="text-danger pl-3">', '</small>'); ?>
    </div>
    <div class="form-group">
        <label for="fee_per_day">Fee /Day</label>
        <input class="form-control form-control-solid" id="fee_per_day" name="fee_per_day" type="number" value="<?= (!empty($data->fee_per_day)) ? $data->fee_per_day : set_value('fee_per_day') ?>">
        <?= form_error('fee_per_day', '<small class="text-danger pl-3">', '</small>'); ?>
    </div>
    <div class="form-group">
        <label for="skills">Skills</label>
        <input class="form-control form-control-solid" id="skills" name="skills" type="text" value="<?= (!empty($data->skills)) ? $data->skills : set_value('skills') ?>">
        <small>pisahkan dengan koma(,)</small>
        <?= form_error('skills', '<small class="text-danger pl-3">', '</small>'); ?>
    </div>
    <div class="form-group">
        <label for="foto">foto</label>
        <input class="form-control form-control-solid" id="foto" name="foto" type="file" value="<?= (!empty($data->foto)) ? $data->foto : set_value('foto') ?>">
        <?= form_error('foto', '<small class="text-danger pl-3">', '</small>'); ?>
    </div>
    <div class="form-group">
        <a href="<?= base_url('jurusan') ?>" class="btn btn-warning"><i class="fa fa-arrow-left"></i>&nbsp; Kembali</a>
        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i>&nbsp;Simpan</button>
    </div>
</form>