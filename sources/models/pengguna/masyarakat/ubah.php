<?php
$sourcePath = "../../..";
include "$sourcePath/utilities/environment.php";
include "$sourcePath/utilities/connection.php";
include "$sourcePath/utilities/session/start.php";

include "$sourcePath/middlewares/isNotAuthenticated.php";

include "$sourcePath/utilities/session/data.php";
include "$sourcePath/utilities/role.php";
include "$sourcePath/utilities/date.php";

roleGuardMinimum($sessionLevel, "administrator", "/$originalPath");

$id = $_GET["id"];
$result = mysqli_query($connection, "SELECT id FROM masyarakat WHERE id='$id' AND dihapus='0';");
if (mysqli_num_rows($result) <= 0) {
  echo "<script>window.location='.';</script>";
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $headTitle = "Masyarakat";
  include "$sourcePath/components/head.php";
  include "$sourcePath/components/select/head.php";
  include "$sourcePath/utilities/modal.php";
  ?>
</head>

<body class="hold-transition layout-navbar-fixed layout-fixed light-mode" id="body-theme">
  <div class="wrapper">
    <?php
    $navActive = [2, 2];
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
                      <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST" onsubmit="return confirmModal('form', this);">
                        <?php
                        $data = mysqli_fetch_assoc(mysqli_query($connection, "SELECT nik, nama, username, telepon FROM masyarakat WHERE id='$id' AND dihapus='0';"));
                        $inputArray = [
                          [
                            "id" => 1,
                            "display" => "NIK",
                            "name" => "nik",
                            "type" => "number",
                            "value" => isset($_POST["nik"]) ? $_POST["nik"] : $data["nik"],
                            "placeholder" => "Masukkan NIK disini",
                            "enable" => true
                          ],
                          [
                            "id" => 2,
                            "display" => "Nama",
                            "name" => "nama",
                            "type" => "text",
                            "value" => isset($_POST["nama"]) ? $_POST["nama"] : $data["nama"],
                            "placeholder" => "Masukkan nama disini",
                            "enable" => true
                          ],
                          [
                            "id" => 3,
                            "display" => "Username",
                            "name" => "username",
                            "type" => "text",
                            "value" => isset($_POST["username"]) ? $_POST["username"] : $data["username"],
                            "placeholder" => "Masukkan username disini",
                            "enable" => true

                          ],
                          [
                            "id" => 4,
                            "display" => "Telepon",
                            "name" => "telepon",
                            "type" => "number",
                            "value" => isset($_POST["telepon"]) ? $_POST["telepon"] : $data["telepon"],
                            "placeholder" => "Masukkan telepon disini",
                            "enable" => true
                          ],
                        ];

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
    $nik = $_POST["nik"];
    $nama = $_POST["nama"];
    $username = $_POST["username"];
    $telepon = $_POST["telepon"];

    try {
      $result = mysqli_query($connection, "UPDATE masyarakat SET nik='$nik', nama='$nama', username='$username', telepon='$telepon' WHERE id='$id' AND dihapus='0';");

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
        } else if (str_contains($errorMessage, "'nik'")) {
          $message = "NIK sudah digunakan";
        };
      };

      echo "<script>errorModal('$message', null);</script>";
    };
  };
  ?>
</body>

</html>