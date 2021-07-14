<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= (!empty($title)) ? $title . ' | ' : ''; ?>TukangApp</title>
    <link href="<?= base_url() ?>assets/css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="<?= base_url() ?>assets/assets/img/favicon.png" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/darktheme.css" />
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/js/tempusdominus-bootstrap-4.min.js" integrity="sha512-2JBCbWoMJPH+Uj7Wq5OLub8E5edWHlTM4ar/YJkZh3plwB2INhhOC3eDoqHm1Za/ZOSksrLlURLoyXVdfQXqwg==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/css/tempusdominus-bootstrap-4.min.css" integrity="sha512-PMjWzHVtwxdq7m7GIxBot5vdxUY+5aKP9wpKtvnNBZrVv1srI8tU6xvFMzG8crLNcMj/8Xl/WWmo/oAP/40p1g==" crossorigin="anonymous" />

    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.24.1/feather.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <style>
        .select2-container--default .select2-selection--single {
            padding-top: 5px;
            padding-left: 5px;
            height: 40px;
            height: calc(1.5em + 1rem + 2px);
            width: 100%;
            font-size: 1rem;
            background-color: #ecf0f6;
            border-color: #ecf0f6;
            position: relative;
            font-weight: 400;
            line-height: 1.5;
        }

        .select2-selection__rendered {
            color: #687281 !important;
        }
    </style>
</head>
<?php
$user = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row();
$role = $this->db->select('id_menu_navigasi')->get_where('tr_menu_navigasi', 'id_role in(' . $this->session->userdata('id_role') . ')')->result();
$role_ = '';
foreach ($role as $key => $value) :
    $role_ .= $value->id_menu_navigasi . ',';
endforeach;
$substr_role = substr($role_, 0, -1);
// var_dump($substr_role);
// var_dump($role[0]['id_menu_navigasi']);
// die;
?>

<body class="nav-fixed">
    <nav class="topnav navbar navbar-expand shadow navbar-light bg-white" id="sidenavAccordion">
        <a class="navbar-brand d-none d-sm-block" href="<?= base_url() . __ADMIN ?>">Tukang <strong>App</strong></a>
        <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 mr-lg-2" id="sidebarToggle" href="#"><i data-feather="menu"></i></button>
        <?= tanggal_indo(date('Y-m-d'), true) ?>
        <ul class="navbar-nav align-items-center ml-auto">
            <li class="nav-item no-caret mr-3" style="font-weight: bold;">
                Selamat <?= selamat() ?>, <?= $user->nama ?>
            </li>
            <li class="nav-item dropdown no-caret mr-3 dropdown-user float-right">
                <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="<?= base_url('upload/user/') . get_foto($user->foto) ?>" /></a>
                <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                    <h6 class="dropdown-header d-flex align-items-center">
                        <img class="dropdown-user-img" src="<?= base_url('upload/user/') . get_foto($user->foto) ?>" />
                        <div class="dropdown-user-details">
                            <div class="dropdown-user-details-name"><?= $user->nama ?></div>
                            <div class="dropdown-user-details-email"><?= $user->username ?></div>
                        </div>
                    </h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?= base_url('admin/profil') ?>">
                        <div class="dropdown-item-icon"><i data-feather="settings"></i></div>
                        Profile
                    </a>
                    <a class="dropdown-item" href="<?= base_url('admin/logout') ?>">
                        <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                        Logout
                    </a>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sidenav shadow-right sidenav-light">
                <div class="sidenav-menu">
                    <div class="nav accordion" id="accordionSidenav">
                        <?php
                        $menu_p = $this->db->query("SELECT * FROM menu_navigasi WHERE id_parent = 0 AND id_menu_navigasi IN($substr_role) AND menu_navigasi.status = 1 ORDER BY no_urut ASC")->result();
                        $c = 0;
                        foreach ($menu_p as $key => $val) {
                            if ($val->url == '#') {
                                $menu_c = $this->db->get_where('menu_navigasi', ['id_parent' => $val->id_menu_navigasi])->result();
                                $c = [];
                                $b = '';
                                foreach ($menu_c as $key => $value) {
                                    $a = ($value->url == $this->uri->segment(2)) ? 'active' : '';
                                    $b .= ($a == 'active') ? 1 : 0;
                                }
                                $b_ = str_replace(0, '', $b);
                                $cc_ = (isset($c_[0])) ? $c_[0] : 0;
                                if ($b_ > 0) {
                                    $tampil = 'active';
                                    $t_f = 'true';
                                } else {
                                    $tampil = 'collapsed';
                                    $t_f = 'false';
                                }
                        ?>
                                <a class="nav-link <?= $tampil ?>" href="javascript:void(0);" data-toggle="collapse" data-target="#<?= str_replace(' ', '', $val->nama) . $val->id_menu_navigasi;  ?>" aria-expanded="<?= $t_f ?>" aria-controls="<?= str_replace(' ', '', $val->nama) . $val->id_menu_navigasi; ?>">
                                    <div class="nav-link-icon"><i class="fa fa-<?= $val->icon ?>"></i></div>
                                    <?= $val->nama ?>
                                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                            <?php } else { ?>
                                <a class="nav-link <?= ($val->url == $this->uri->segment(2)) ? 'active' : ''; ?>" href="<?= base_url("admin/$val->url") ?>" aria-expanded="false">
                                    <div class="nav-link-icon"><i class="fa fa-<?= $val->icon ?>"></i></div>
                                    <?= $val->nama ?>
                                </a>
                            <?php } ?>
                            <?php
                            $menu_c = $this->db->get_where('menu_navigasi', ['id_parent' => $val->id_menu_navigasi])->result();
                            $c_ = [];
                            $b = '';
                            foreach ($menu_c as $key => $value) {
                                $a = ($value->url == $this->uri->segment(2)) ? 'active' : '';
                                $b .= ($a == 'active') ? 1 : 0;
                                array_push($c_, $b_);
                            }
                            $b_ = str_replace(0, '', $b);
                            if ($b_ > 0) {
                                $show_ = 'show';
                            } else {
                                $show_ = '';
                            }
                            ?>
                            <div class="collapse <?= $show_ ?>" id="<?= str_replace(' ', '', $val->nama) . $val->id_menu_navigasi; ?>" data-parent="#accordionSidenav">
                                <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                                    <?php
                                    $menu_c2 = $this->db->query("SELECT * FROM menu_navigasi WHERE id_parent = $val->id_menu_navigasi AND id_menu_navigasi IN($substr_role) AND menu_navigasi.status = 1 ORDER BY no_urut ASC")->result();
                                    foreach ($menu_c2 as $key => $value) {
                                    ?>
                                        <a class="nav-link <?= ($value->url == $this->uri->segment(2)) ? 'active' : ''; ?>" href="<?= base_url("admin/$value->url") ?>"><?= $value->nama ?></a>
                                    <?php } ?>
                                </nav>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="sidenav-footer">
                    <div class="sidenav-footer-content">
                        <div class="sidenav-footer-subtitle">Logged in as:</div>
                        <div class="sidenav-footer-title"><?= ($user->role == 999) ? $user->nama . ' (Developer)' : $admin = ($user->role == 1) ? $user->nama . ' (Admin)' : $guru = ($user->role == 2) ? $user->nama . ' (Guru)' : $siswa = ($user->role == 3) ? $user->nama . ' (Siswa)' : ''; ?></div>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>