<nav class="main-header navbar navbar-expand navbar-light" id="nav-theme">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" role="button"><i class="fas fa-bars"></i></a>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
            <a href="/<?php echo $originalPath; ?>" class="nav-link">Utama</a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item d-none d-sm-inline-block">
            <a class="nav-link"><?php echo ucwords($sessionUsername); ?> Sebagai <?php echo ucwords($sessionLevel); ?></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>

<aside class="main-sidebar sidebar-light-primary elevation-4" id="aside-theme" style="height: 100vh;">
    <a href="/<?php echo $originalPath; ?>" class="brand-link">
        <img src="<?php echo $sourcePath; ?>/public/dist/img/app-logo.png" alt="App Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Pelaporan</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex" style="align-items: center;">
            <div class="image">
                <img src="<?php echo $sourcePath; ?>/public/dist/img/user-profile.png" class="img-circle elevation-2" alt="User Profile">
            </div>

            <div class="info">
                <a class="d-block" href="/<?php echo $originalPath; ?>/sources/models/pengaturan/data-pribadi">
                    <p class="h5 m-0 p-0"><?php echo ucwords($sessionUsername); ?></p>
                    <p class="h6 text-muted m-0 p-0"><?php echo ucwords($sessionLevel); ?></p>
                </a>
            </div>
        </div>

        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                <?php
                $pageArray = [
                    1 => [
                        "id" => 1,
                        "title" => "Utama",
                        "icon" => "far fa-circle",
                        "link" => "",
                        "child" => null,
                    ]
                ];

                if (roleCheckMinimum($sessionLevel, "administrator")) {
                    $pageArray[2] = [
                        "id" => 2,
                        "title" => "Pengguna",
                        "icon" => "far fa-circle",
                        "link" => null,
                        "child" => [
                            1 => [
                                "id" => 1,
                                "title" => "Petugas",
                                "icon" => "far fa-circle",
                                "link" => "sources/models/pengguna/petugas",
                            ],
                            2 => [
                                "id" => 2,
                                "title" => "Masyarakat",
                                "icon" => "far fa-circle",
                                "link" => "sources/models/pengguna/masyarakat",
                            ]
                        ]
                    ];
                };

                if (roleCheckSingle($sessionLevel, "masyarakat")) {
                    $pageArray[3] = [
                        "id" => 3,
                        "title" => "Pengaduan",
                        "icon" => "far fa-circle",
                        "link" => "sources/models/pengaduan",
                        "child" => null,
                    ];
                };

                if (roleCheckMinimum($sessionLevel, "petugas")) {
                    $pageArray[4] =  [
                        "id" => 4,
                        "title" => "Verval",
                        "icon" => "far fa-circle",
                        "link" => "sources/models/verval",
                        "child" => null,
                    ];

                    $pageArray[5] =  [
                        "id" => 5,
                        "title" => "Tanggapan",
                        "icon" => "far fa-circle",
                        "link" => "sources/models/tanggapan",
                        "child" => null,
                    ];
                }

                $pageArray[6] = [
                    "id" => 6,
                    "title" => "Pengaturan",
                    "icon" => "far fa-circle",
                    "link" => null,
                    "child" => [
                        1 => [
                            "id" => 1,
                            "title" => "Data Pribadi",
                            "icon" => "far fa-circle",
                            "link" => "sources/models/pengaturan/data-pribadi",
                        ]
                    ]
                ];
                ?>

                <?php
                foreach ($pageArray as $pageObject) {
                ?>
                    <li class="nav-item<?php echo ($pageObject["id"] == $navActive[0] and $navActive[1] != null) ? " menu-open" : ""; ?>">
                        <a href="/<?php echo $originalPath; ?>/<?php echo $pageObject["link"]; ?>" class="nav-link<?php echo ($pageObject["id"] == $navActive[0]) ? " active" : ""; ?>">
                            <i class="nav-icon <?php echo $pageObject["icon"]; ?>"></i>
                            <p>
                                <?php echo $pageObject["title"]; ?>

                                <?php
                                if ($pageObject["child"] != null) {
                                ?>
                                    <i class="right fas fa-angle-left"></i>
                                <?php
                                };
                                ?>
                            </p>
                        </a>

                        <?php
                        if ($pageObject["child"] != null) {
                        ?>
                            <ul class="nav nav-treeview">
                                <?php
                                foreach ($pageObject["child"] as $pageChildObject) {
                                ?>
                                    <li class="nav-item">
                                        <a href="/<?php echo $originalPath; ?>/<?php echo $pageChildObject["link"]; ?>" class="nav-link<?php echo ($pageObject["id"] == $navActive[0] and $pageChildObject["id"] == $navActive[1]) ? " active" : ""; ?>">
                                            <i class="nav-icon <?php echo $pageChildObject["icon"]; ?>"></i>
                                            <p><?php echo $pageChildObject["title"]; ?></p>
                                        </a>
                                    </li>
                                <?php
                                };

                                if ($pageObject["id"] == 6) {
                                ?>
                                    <li class="nav-item">
                                        <a class="nav-link" role="button" onclick="confirmModal('action', changeColorTheme);">
                                            <i class="nav-icon far fa-sun" id="icon-theme"></i>
                                            <p id="text-theme">Tema Terang</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" role="button" onclick="confirmModal('location', '/<?php echo $originalPath; ?>/sources/models/authentication/logout.php')">
                                            <i class="nav-icon far fa-circle"></i>
                                            <p>Logout</p>
                                        </a>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                        <?php
                        };
                        ?>
                    </li>
                <?php
                };
                ?>
            </ul>
        </nav>
    </div>
</aside>