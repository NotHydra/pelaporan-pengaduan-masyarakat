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
$result = mysqli_query($connection, "SELECT id FROM masyarakat WHERE id='$id' and dihapus='0';");
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
                $extraTitle = "Hapus";
                include "$sourcePath/components/content/head.php";
                ?>

                <div class="card-body">
                  <div class="row">
                    <div class="col-sm">
                      <form action="<?php $_SERVER["PHP_SELF"]; ?>?id=<?php echo $id; ?>" method="POST" onsubmit="return confirmModal('form', this);">
                        <?php
                        $data = mysqli_fetch_assoc(mysqli_query($connection, "SELECT nik, nama, username, telepon FROM masyarakat WHERE id='$id' and dihapus='0';"));
                        $inputArray = [
                          [
                            "id" => 1,
                            "display" => "NIK",
                            "name" => "nik",
                            "type" => "number",
                            "value" => $data["nik"],
                            "placeholder" => "Masukkan NIK disini",
                            "enable" => false
                          ],
                          [
                            "id" => 2,
                            "display" => "Nama",
                            "name" => "nama",
                            "type" => "text",
                            "value" => $data["nama"],
                            "placeholder" => "Masukkan nama disini",
                            "enable" => false
                          ],
                          [
                            "id" => 3,
                            "display" => "Username",
                            "name" => "username",
                            "type" => "text",
                            "value" => $data["username"],
                            "placeholder" => "Masukkan username disini",
                            "enable" => false
                          ],
                          [
                            "id" => 4,
                            "display" => "Telepon",
                            "name" => "telepon",
                            "type" => "number",
                            "value" => $data["telepon"],
                            "placeholder" => "Masukkan telepon disini",
                            "enable" => false
                          ],
                        ];

                        include "$sourcePath/components/input/detail.php";
                        ?>

                        <button class="btn btn-danger btn-block" type="submit"><i class="fa fa-trash"></i> Hapus</button>
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
    try {
      $result = mysqli_query($connection, "UPDATE masyarakat SET dihapus='1' WHERE id='$id';");

      if ($result) {
        echo "<script>successModal(null, '.');</script>";
      } else {
        echo "<script>errorModal(null, null);</script>";
      };
    } catch (exception $e) {
      echo "<script>errorModal(null, null);</script>";
    };
  };
  ?>
</body>

</html>