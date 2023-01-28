<?php
$sourcePath = "./sources";

include "$sourcePath/utilities/environment.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $headTitle = "Utama";
  ?>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pelaporan | <?php echo $headTitle; ?></title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?php echo $sourcePath; ?>/public/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo $sourcePath; ?>/public/dist/css/adminlte.min.css">
</head>

<body class="hold-transition layout-navbar-fixed layout-fixed light-mode" id="body-theme">
  <div class="wrapper">
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
          <a class="nav-link">Username1 Sebagai Level</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
      </ul>
    </nav>

    <aside class="main-sidebar sidebar-light-primary elevation-4" id="aside-theme">
      <a href="/<?php echo $originalPath; ?>" class="brand-link">
        <img src="<?php echo $sourcePath; ?>/public/dist/img/app-logo.png" alt="App Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Pelaporan</span>
      </a>

      <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?php echo $sourcePath; ?>/public/dist/img/user-profile.png" class="img-circle elevation-2" alt="User Profile">
          </div>

          <div class="info">
            <a class="d-block">
              <p class="h5 m-0 p-0">Username1</p>
              <p class="h6 text-muted m-0 p-0">Level</p>
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
            <li class="nav-item menu-open">
              <a href="" class="nav-link active">
                <i class="nav-icon far fa-circle"></i>
                <p>
                  Utama
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="" class="nav-link">
                <i class="nav-icon far fa-circle"></i>
                <p>
                  Pengguna
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Petugas</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Masyarakat</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <a href="" class="nav-link">
                <i class="nav-icon far fa-circle"></i>
                <p>
                  Pengaduan
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="" class="nav-link">
                <i class="nav-icon far fa-circle"></i>
                <p>
                  Pengaturan
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>

              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a class="nav-link" role="button" onclick="changeColorTheme();">
                    <i class="far fa-sun nav-icon" id="icon-theme"></i>
                    <p id="text-theme">Tema Terang</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
      </div>
    </aside>

    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm">
              <div class="card">
                <div class="card-header">
                  <div class="row">
                    <div class="col-sm-6">
                      <h1 class="m-0">Utama</h1>
                    </div>

                    <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/<?php echo $originalPath; ?>/">Utama</a></li>
                      </ol>
                    </div>
                  </div>
                </div>

                <div class="card-body">
                  <div class="row">
                    <div class="col-sm">
                      <p>Selamat datang di website <b>Laporan Pengaduan Masyarakat</b></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <footer class="main-footer">
      <b>Copyright &copy; 2023 XII RPL</b>

      <div class="float-right d-none d-sm-inline-block">
        <b>Version Beta</b>
      </div>
    </footer>
  </div>

  <script src="<?php echo $sourcePath ?>/public/plugins/jquery/jquery.min.js"></script>
  <script src="<?php echo $sourcePath ?>/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo $sourcePath ?>/public/dist/js/adminlte.js"></script>

  <script>
    function defaultColorTheme() {
      const bodyElement = document.getElementById("body-theme");
      const navElement = document.getElementById("nav-theme");
      const asideElement = document.getElementById("aside-theme");
      const iconElement = document.getElementById("icon-theme");
      const textElement = document.getElementById("text-theme");

      if (localStorage.colorThemeType == "light") {
        bodyElement.classList.remove("dark-mode");
        bodyElement.classList.add("light-mode");

        navElement.classList.remove("navbar-dark");
        navElement.classList.add("navbar-light");

        asideElement.classList.remove("sidebar-dark-primary");
        asideElement.classList.add("sidebar-light-primary");

        iconElement.classList.remove("fa-moon");
        iconElement.classList.add("fa-sun");

        textElement.innerHTML = "Tema Terang";
      } else if (localStorage.colorThemeType == "dark") {
        bodyElement.classList.remove("light-mode");
        bodyElement.classList.add("dark-mode");

        navElement.classList.remove("navbar-light");
        navElement.classList.add("navbar-dark");

        asideElement.classList.remove("sidebar-light-primary");
        asideElement.classList.add("sidebar-dark-primary");

        iconElement.classList.remove("fa-sun");
        iconElement.classList.add("fa-moon");

        textElement.innerHTML = "Tema Gelap";
      }
    }

    function changeColorTheme() {
      const bodyElement = document.getElementById("body-theme");
      const navElement = document.getElementById("nav-theme");
      const asideElement = document.getElementById("aside-theme");
      const iconElement = document.getElementById("icon-theme");
      const textElement = document.getElementById("text-theme");

      if (localStorage.colorThemeType == "light") {
        bodyElement.classList.remove("light-mode");
        bodyElement.classList.add("dark-mode");

        navElement.classList.remove("navbar-light");
        navElement.classList.add("navbar-dark");

        asideElement.classList.remove("sidebar-light-primary");
        asideElement.classList.add("sidebar-dark-primary");

        iconElement.classList.remove("fa-sun");
        iconElement.classList.add("fa-moon");

        textElement.innerHTML = "Tema Gelap";

        localStorage.colorThemeType = "dark";
      } else if (localStorage.colorThemeType == "dark") {
        bodyElement.classList.remove("dark-mode");
        bodyElement.classList.add("light-mode");

        navElement.classList.remove("navbar-dark");
        navElement.classList.add("navbar-light");

        asideElement.classList.remove("sidebar-dark-primary");
        asideElement.classList.add("sidebar-light-primary");

        iconElement.classList.remove("fa-moon");
        iconElement.classList.add("fa-sun");

        textElement.innerHTML = "Tema Terang";

        localStorage.colorThemeType = "light";
      }
    }

    if (!localStorage.colorThemeType) {
      localStorage.colorThemeType = "light";
    };

    defaultColorTheme()
  </script>
</body>

</html>