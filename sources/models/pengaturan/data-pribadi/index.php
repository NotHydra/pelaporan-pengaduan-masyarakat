<?php
$sourcePath = "../../..";
include "$sourcePath/utilities/environment.php";
include "$sourcePath/utilities/connection.php";
include "$sourcePath/utilities/session/start.php";

include "$sourcePath/middlewares/isNotAuthenticated.php";

include "$sourcePath/utilities/session/data.php";
include "$sourcePath/utilities/role.php";
include "$sourcePath/utilities/date.php";

roleGuardMinimum($sessionLevel, "masyarakat", "/$originalPath/sources/models/authentication/logout.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $headTitle = "Data Pribadi";
  include "$sourcePath/components/head.php";
  include "$sourcePath/utilities/modal.php";
  ?>
</head>

<body class="hold-transition layout-navbar-fixed layout-fixed light-mode" id="body-theme">
  <div class="wrapper">
    <?php
    $navActive = [6, 1];
    include "$sourcePath/components/nav.php";
    ?>

    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm">
              <div class="card">
                <?php
                $pageItemObject = $pageArray[$navActive[0]]["child"][$navActive[1]];
                $extraTitle = "Utama";
                include "$sourcePath/components/content/head.php";
                ?>

                <div class="card-body">
                  <div class="row">
                    <div class="col-sm">
                      <form action="<?php $_SERVER["PHP_SELF"]; ?>?id=<?php echo $sessionId; ?>" method="POST" onsubmit="return confirmModal('form', this);">
                        <?php
                        if ($sessionType == "masyarakat") {
                          $inputArray = [
                            [
                              "id" => 1,
                              "display" => "NIK",
                              "name" => "nik",
                              "type" => "number",
                              "value" => $sessionNIK,
                              "placeholder" => "Masukkan NIK disini",
                              "enable" => false
                            ],
                            [
                              "id" => 2,
                              "display" => "Nama",
                              "name" => "nama",
                              "type" => "text",
                              "value" => $sessionNama,
                              "placeholder" => "Masukkan nama disini",
                              "enable" => false
                            ],
                            [
                              "id" => 3,
                              "display" => "Username",
                              "name" => "username",
                              "type" => "text",
                              "value" => $sessionUsername,
                              "placeholder" => "Masukkan username disini",
                              "enable" => false
                            ],
                            [
                              "id" => 4,
                              "display" => "Telepon",
                              "name" => "telepon",
                              "type" => "number",
                              "value" => $sessionTelepon,
                              "placeholder" => "Masukkan telepon disini",
                              "enable" => false
                            ]
                          ];
                        } else if ($sessionType == "petugas") {
                          $inputArray = [
                            [
                              "id" => 1,
                              "display" => "Nama",
                              "name" => "nama",
                              "type" => "text",
                              "value" => $sessionNama,
                              "placeholder" => "Masukkan nama disini",
                              "enable" => false
                            ],
                            [
                              "id" => 2,
                              "display" => "Username",
                              "name" => "username",
                              "type" => "text",
                              "value" => $sessionUsername,
                              "placeholder" => "Masukkan username disini",
                              "enable" => false
                            ],
                            [
                              "id" => 3,
                              "display" => "Telepon",
                              "name" => "telepon",
                              "type" => "number",
                              "value" => $sessionTelepon,
                              "placeholder" => "Masukkan telepon disini",
                              "enable" => false
                            ],
                            [
                              "id" => 4,
                              "display" => "Level",
                              "name" => "level",
                              "type" => "text",
                              "value" => ucwords($sessionLevel),
                              "placeholder" => "Masukkan level disini",
                              "enable" => false
                            ],
                            [
                              "id" => 5,
                              "display" => "Status",
                              "name" => "status",
                              "type" => "text",
                              "value" => ucwords($sessionStatus),
                              "placeholder" => "Masukkan status disini",
                              "enable" => false
                            ],
                          ];
                        };

                        include "$sourcePath/components/input/detail.php";
                        ?>

                        <a class="btn btn-warning btn-block mt-1" href="./ubah.php"><i class="fa fa-edit"></i> Ubah</a>
                        <a class="btn btn-danger btn-block mt-1" href="./ubah-password.php"><i class="fa fa-lock"></i> Ubah Password</a>

                      </form>
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
  include "$sourcePath/components/select/script.php";
  ?>
</body>

</html>