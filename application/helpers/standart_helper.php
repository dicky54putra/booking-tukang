<?php

const __ADMIN = 'admin/';
const __HOME = 'home/';

function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('username')) {
        redirect('admin/login');
    } else {
        // bahan 
        $id_role = $ci->session->userdata('id_role');
        $menu = $ci->uri->segment(2);

        $queryMenu = $ci->db->get_where('menu_navigasi', ['url' => $menu])->row_array();
        $id_menu_navigasi = $queryMenu['id_menu_navigasi'];

        $userAccess = $ci->db->get_where('tr_menu_navigasi', [
            'id_role' => $id_role,
            'id_menu_navigasi' => $id_menu_navigasi
        ]);
        $userAccess->row();

        if ($ci->uri->segment(1) == 'admin' && $menu == '') {
            return true;
        }
        if ($userAccess->num_rows() < 1) {
            redirect('admin/blocked');
        }
    }
}

function send_email($send)
{
    return '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Email - Elearning</title>
        <style>
            body {
                font-family: "Poppins", "sans-serif", "arial";
                background-color: white;
                width: 600px;
                margin:30px auto;
            }
            .header {
                // border: 1px solid black;
                border: none;
                background-color: #0061f2 ;
            }
            .header .meta-header {
                padding-top:18px;
                padding-bottom:18px;
                text-align: center;
                color:white;
                font-style: bold;
            }
            .header .logo-header {
                margin: auto;
                height: 2rem;
                width: 2rem;
                display: block;
                background-color: gray;
            }
            .content .message {
                font-size: 11px;
                font-weight: 400;
                line-height: 1.625;
            }
            .message span {
                font-weight: 600;
            }
            .message a {
                text-decoration: none;
            }
            .content {
                padding: 20px;
            }
            .content .card {
                background-color: #dfdfdf;
                padding: 18px;
                box-shadow:  0 4px 5px 0 rgba(0, 0, 0, 0.05);
            }
            .content .meta-card {
                width: 80%;
                display: flex;
                align-items: center;
                justify-content: space-evenly;
            }
            .meta-card .logo-card {
                width: 4rem;
                height: 4rem;
                background: red;
                border-radius: 50%;
            }
            .btn-card {
                cursor: pointer;
                color: white;
                font-size: 11px;
                border-radius: 2px;
                padding:0.5rem 1.5rem;
                background-color: #2e2cc9;
                border: 0;
            }
            .content .message {
                padding-top:20px;
            }
            .footer {
                font-size: 11px;
                text-align: center;
                margin-top: 20px;
            }
        </style>
    </head>
    <body>
        <section class="header">
            <div class="meta-header">
                <h3>SMK Pelita Nusantara 1</h3>
            </div>
        </section>
        <section class="content">
            <div class="meta-content">
                <h4 class="name">Hai, ' . $send['siswa'] . '</h4>
                <p class="message"> <span> ' . $send['guru'] . ' memposting ' . $send['tipe'] . ' baru di <a href="' . $send['url'] . '">sini</a></p>
            </div>
            <div class="card">
                <div class="meta-card"> 
                    <div class="logo-card"></div>
                    <div>
                        <h4>' . $send['judul'] . '</h4>
                        <a href="' . $send['url'] . '" class="btn-card">Buka</a>
                    </div>
                </div>
            </div>
        </section>
        <hr>
        <section class="footer">
             2020 &copy; SMK Pelita Nusantara 1 
        </section>
    </body>
    </html>';
}


function set_email($tipe)
{
    $ci = get_instance();
    $query = $ci->db->get("setting_school")->row();
    if ($tipe == "user") {
        return $query->email;
    } else if ($tipe == "pass") {
        return $query->password;
    }
}

function tanggal_indo($tanggal, $cetak_hari = false)
{
    $hari = array(
        1 =>    'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu',
        'Minggu'
    );

    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $split    = explode('-', $tanggal);
    if ($tanggal > 0) {
        $tgl_indo = $split[2] . ' ' . $bulan[(int) $split[1]] . ' ' . $split[0];

        if ($cetak_hari) {
            $num = date('N', strtotime($tanggal));
            return $hari[$num] . ', ' . $tgl_indo;
        }

        return $tgl_indo;
    }
}

function selamat()
{
    //ubah timezone menjadi jakarta
    date_default_timezone_set("Asia/Jakarta");

    //ambil jam dan menit
    $jam = date('H:i');

    //atur salam menggunakan IF
    if ($jam > '05:30' && $jam < '10:00') {
        $salam = 'Pagi';
    } elseif ($jam >= '10:00' && $jam < '15:00') {
        $salam = 'Siang';
    } elseif ($jam < '18:00') {
        $salam = 'Sore';
    } else {
        $salam = 'Malam';
    }

    return $salam;
}

function icons($icon, $h = "30px")
{
    return '<img src="' . base_url('assets/img/icons/') . $icon . '" height="' . $h . '">';
}

function __homeTemplate($url, $data = null)
{
    get_instance()->load->view(__HOME . 'template/header', $data);
    get_instance()->load->view(__HOME . $url, $data);
    get_instance()->load->view(__HOME . 'template/footer');
}
