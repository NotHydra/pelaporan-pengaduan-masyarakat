<?php
$sourcePath = "../../..";
include "$sourcePath/utilities/environment.php";
include "$sourcePath/utilities/connection.php";
include "$sourcePath/utilities/session/start.php";

include "$sourcePath/middlewares/isNotAuthenticated.php";

include "$sourcePath/utilities/session/data.php";
include "$sourcePath/utilities/date.php";
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
    $navActive = [2, 1];
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
                $extraTitle = "Buat";
                include "$sourcePath/components/content/head.php";
                ?>

                <div class="card-body">
                  <div class="row">
                    <div class="col-sm">
                      <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST" onsubmit="return confirmModal('form', this);">
                        <?php
                        $inputArray = array(
                          array(
                            "id" => 1,
                            "display" => "Nama",
                            "name" => "nama",
                            "type" => "text",
                            "value" => isset($_POST["nama"]) ? $_POST["nama"] : null,
                            "placeholder" => "Masukkan nama disini",
                            "enable" => true
                          ),
                          array(
                            "id" => 2,
                            "display" => "Username",
                            "name" => "username",
                            "type" => "text",
                            "value" => isset($_POST["username"]) ? $_POST["username"] : null,
                            "placeholder" => "Masukkan username disini",
                            "enable" => true

                          ),
                          array(
                            "id" => 3,
                            "display" => "Telepon",
                            "name" => "telepon",
                            "type" => "number",
                            "value" => isset($_POST["telepon"]) ? $_POST["telepon"] : null,
                            "placeholder" => "Masukkan telepon disini",
                            "enable" => true
                          ),
                          array(
                            "id" => 4,
                            "display" => "Level",
                            "name" => "level",
                            "type" => "select",
                            "value" => array(array(
                              array("superadministrator", "Superadministrator"),
                              array("administrator", "Administrator"),
                              array("petugas", "Petugas"),
                            ), isset($_POST["level"]) ? $_POST["level"] : null),
                            "placeholder" => "Masukkan level disini",
                            "enable" => true
                          ),
                          array(
                            "id" => 5,
                            "display" => "Status",
                            "name" => "status",
                            "type" => "select",
                            "value" => array(array(
                              array("tidak aktif", "Tidak Aktif"),
                              array("aktif", "Aktif"),
                            ), isset($_POST["status"]) ? $_POST["status"] : null),
                            "placeholder" => "Masukkan status disini",
                            "enable" => true
                          ),
                          array(
                            "id" => 6,
                            "display" => "Password",
                            "name" => "password",
                            "type" => "password",
                            "value" => isset($_POST["password"]) ? $_POST["password"] : null,
                            "placeholder" => "Masukkan password disini",
                            "enable" => true
                          ),
                          array(
                            "id" => 7,
                            "display" => "Konfirmasi Password",
                            "name" => "konfirmasi_password",
                            "type" => "password",
                            "value" => isset($_POST["konfirmasi_password"]) ? $_POST["konfirmasi_password"] : null,
                            "placeholder" => "Masukkan konfirmasi password disini",
                            "enable" => true
                          )
                        );

                        include "$sourcePath/components/input/detail.php";
                        ?>

                        <button class=" btn btn-primary btn-block" type="submit"><i class="fa fa-plus"></i> Buat</button>
                        <a class="btn btn-danger btn-block" role="button" onclick="confirmModal('location', '.');"><i class="fa fa-undo"></i> Kembali</a>
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

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = md5($_POST["password"]);
    $konfirmasiPassword = md5($_POST["konfirmasi_password"]);

    if ($password == $konfirmasiPassword) {
      $nama = $_POST["nama"];
      $username = $_POST["username"];
      $telepon = $_POST["telepon"];
      $level = $_POST["level"];
      $status = $_POST["status"];

      try {
        $result = mysqli_query($connection, "INSERT INTO petugas (nama, username, password, telepon, level, status) VALUES ('$nama', '$username', '$password', '$telepon', '$level', '$status');");

        if ($result) {
          echo "<script>successModal(null, null);</script>";
        } else {
          echo "<script>errorModal(null, null);</script>";
        };
      } catch (exception $e) {
        $message = null;
        $errorMessage = mysqli_error($connection);

        if (str_contains($errorMessage, "Duplicate entry")) {
          if (str_contains($errorMessage, "'username'")) {
            $message = "Username sudah digunakan";
          };
        }

        echo "<script>errorModal('$message', null);</script>";
      };
    } else {
      echo "<script>errorModal('Konfirmasi password salah', null);</script>";
    }
  };
  ?>
</body>

</html>