<?php
$sourcePath = "../../..";
include "$sourcePath/utilities/environment.php";
include "$sourcePath/utilities/connection.php";
include "$sourcePath/utilities/session/start.php";

include "$sourcePath/middlewares/isNotAuthenticated.php";

include "$sourcePath/utilities/session/data.php";
include "$sourcePath/utilities/role.php";
include "$sourcePath/utilities/date.php";

roleGuardMinimum($sessionLevel, "petugas", "/$originalPath");

$id = $_GET["id"];
$result = mysqli_query($connection, "SELECT level FROM petugas WHERE id='$id' and dihapus='0';");
$data = mysqli_fetch_assoc($result);
if (mysqli_num_rows($result) <= 0 or !roleCheckMinimum($sessionLevel, roleConvert($data["level"]) + 1)) {
  echo "<script>window.location='.';</script>";
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $headTitle = "Petugas";
  include "$sourcePath/components/head.php";
  include "$sourcePath/components/select/head.php";
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
                $extraTitle = "Ubah";
                include "$sourcePath/components/content/head.php";
                ?>

                <div class="card-body">
                  <div class="row">
                    <div class="col-sm">
                      <form action="<?php $_SERVER["PHP_SELF"]; ?>?id=<?php echo $id; ?>" method="POST" onsubmit="return confirmModal('form', this);">
                        <?php
                        $data = mysqli_fetch_assoc(mysqli_query($connection, "SELECT nama, username, telepon, level, status FROM petugas WHERE id='$id' and dihapus='0';"));
                        $inputArray = array(
                          array(
                            "id" => 1,
                            "display" => "Nama",
                            "name" => "nama",
                            "type" => "text",
                            "value" => isset($_POST["nama"]) ? $_POST["nama"] : $data["nama"],
                            "placeholder" => "Masukkan nama disini",
                            "enable" => true
                          ),
                          array(
                            "id" => 2,
                            "display" => "Username",
                            "name" => "username",
                            "type" => "text",
                            "value" => isset($_POST["username"]) ? $_POST["username"] : $data["username"],
                            "placeholder" => "Masukkan username disini",
                            "enable" => true

                          ),
                          array(
                            "id" => 3,
                            "display" => "Telepon",
                            "name" => "telepon",
                            "type" => "number",
                            "value" => isset($_POST["telepon"]) ? $_POST["telepon"] : $data["telepon"],
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
                            ), isset($_POST["level"]) ? $_POST["level"] : $data["level"]),
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
                            ), isset($_POST["status"]) ? $_POST["status"] : $data["status"]),
                            "placeholder" => "Masukkan status disini",
                            "enable" => true
                          ),
                        );

                        include "$sourcePath/components/input/detail.php";
                        ?>

                        <button class="btn btn-warning btn-block" type="submit"><i class="fa fa-edit"></i> Ubah</button>
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
  include "$sourcePath/components/select/script.php";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $username = $_POST["username"];
    $telepon = $_POST["telepon"];
    $level = $_POST["level"];
    $status = $_POST["status"];

    try {
      $result = mysqli_query($connection, "UPDATE petugas SET nama='$nama', username='$username', telepon='$telepon', level='$level', status='$status' WHERE id='$id';");

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
      };

      echo "<script>errorModal('$message', null);</script>";
    };
  };
  ?>
</body>

</html>