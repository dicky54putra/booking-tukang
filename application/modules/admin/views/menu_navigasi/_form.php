<form method="POST" action="<?= $action ?>">
    <div class="form-group">
        <label for="nama">Nama</label>
        <input class="form-control form-control-solid" id="nama" name="nama" type="text" value="<?= (!empty($data->nama)) ? $data->nama : set_value('nama') ?>">
        <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
    </div>
    <div class="form-group">
        <label for="url">Url</label>
        <input class="form-control form-control-solid" id="url" name="url" type="text" value="<?= (!empty($data->url)) ? $data->url : set_value('url') ?>">
        <?= form_error('url', '<small class="text-danger pl-3">', '</small>'); ?>
    </div>
    <div class="form-group">
        <label for="id_parent">Parent</label>
        <select name="id_parent" id="id_parent" class="form-control form-control-solid js-example-basic-single">
            <option value="">Pilih Parent</option>
            <?php
            $menu_navigasi = $this->db->get_where('menu_navigasi', ['id_parent' => 0])->result();
            foreach ($menu_navigasi as $key => $val) :
            ?>
                <option value="<?= $val->id_menu_navigasi ?>" <?= (!empty($data->id_parent)) ? $select = ($data->id_parent == $val->id_menu_navigasi) ? 'selected' : '' : '' ?>><?= $val->nama ?></option>
            <?php endforeach; ?>
        </select>
        <?= form_error('id_parent', '<small class="text-danger pl-3">', '</small>'); ?>
    </div>
    <div class="form-group">
        <label for="icon">Icon</label>
        <input class="form-control form-control-solid" id="icon" name="icon" type="text" value="<?= (!empty($data->icon)) ? $data->icon : set_value('icon') ?>">
        <?= form_error('icon', '<small class="text-danger pl-3">', '</small>'); ?>
    </div>
    <?php
    if (!empty($data->id_menu_navigasi)) {
    ?>
        <div class="form-group">
            <label for="no_urut">No Urut</label>
            <input class="form-control form-control-solid" id="no_urut" name="no_urut" type="text" value="<?= (!empty($data->no_urut)) ? $data->no_urut : set_value('no_urut') ?>">
            <?= form_error('no_urut', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>
    <?php } ?>
    <div class="form-group">
        <a href="<?= base_url(__ADMIN . 'menu_navigasi') ?>" class="btn btn-warning"><i class="fa fa-arrow-left"></i>&nbsp; Kembali</a>
        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i>&nbsp;Simpan</button>
    </div>
</form>