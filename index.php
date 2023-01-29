<?php
$sourcePath = "./sources";
include "$sourcePath/utilities/environment.php";
include "$sourcePath/utilities/connection.php";
include "$sourcePath/utilities/session/start.php";
include "$sourcePath/utilities/session/data.php";

include "$sourcePath/utilities/date.php";

include "$sourcePath/middlewares/isNotAuthenticated.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $headTitle = "Utama";
  include "$sourcePath/components/head.php";
  include "$sourcePath/utilities/modal.php";
  ?>
</head>

<body class="hold-transition layout-navbar-fixed layout-fixed light-mode" id="body-theme">
  <div class="wrapper">
    <?php
    $navActive = [1, null];
    include "$sourcePath/components/nav.php";
    ?>

    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm">
              <div class="card">
                <?php
                $pageItemObject = $pageArray[$navActive[0]];
                $extraTitle = null;
                include "$sourcePath/components/content/head.php";
                ?>

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

    <?php
    include "$sourcePath/components/footer.php";
    ?>
  </div>

  <?php
  include "$sourcePath/components/script.php";
  ?>
</body>

</html>