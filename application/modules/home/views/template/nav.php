<?php

$menus = [
    [
        'icon' => 'home.svg',
        'icon_' => 'home_.svg',
        'label' => 'home'
    ],
    [
        'icon' => 'search.svg',
        'icon_' => 'search_.svg',
        'label' => 'search'
    ],
    [
        'icon' => 'history.svg',
        'icon_' => 'history_.svg',
        'label' => 'history'
    ],
    [
        'icon' => 'profile.svg',
        'icon_' => 'profile_.svg',
        'label' => 'profile'
    ]
]

?>

<nav class="fixed-bottom">
    <div class="container">
        <ul>
            <?php
            foreach ($menus as $menu) {

                $uri = $this->uri->segment(1) ?? 'home';
                $ifActive = ($uri == $menu['label']);

                $isActive = ($ifActive) ? 'active' : '';
                $icon = ($ifActive) ? $menu['icon_'] : $menu['icon'];
            ?>
                <li>
                    <a href="<?= base_url($menu['label']) ?>">
                        <?= icons($icon) ?>
                        <h5 class="<?= $isActive ?>"><?= $menu['label'] ?></h5>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
</nav>