<?php
$sourcePath = "../..";
include "$sourcePath/utilities/environment.php";
include "$sourcePath/utilities/connection.php";
include "$sourcePath/utilities/session/start.php";

include "$sourcePath/middlewares/isNotAuthenticated.php";

include "$sourcePath/utilities/session/data.php";
include "$sourcePath/utilities/role.php";
include "$sourcePath/utilities/date.php";

roleGuardMinimum($sessionLevel, "masyarakat", "/$originalPath/sources/models/authentication/logout.php");

$id = $_GET["id"];
$result = mysqli_query($connection, "SELECT id FROM pengaduan WHERE id='$id' AND id_masyarakat='$sessionId' AND dihapus='0';");
if (mysqli_num_rows($result) <= 0) {
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
    $navActive = [3, null];
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
                $extraTitle = "Hapus";
                include "$sourcePath/components/content/head.php";
                ?>

                <div class="card-body">
                  <div class="row">
                    <div class="col-sm">
                      <form action="<?php $_SERVER["PHP_SELF"]; ?>?id=<?php echo $id; ?>" method="POST" onsubmit="return confirmModal('form', this);">
                        <?php
                        $data = mysqli_fetch_assoc(mysqli_query($connection, "SELECT foto, isi_pengaduan FROM pengaduan WHERE id='$id' AND id_masyarakat='$sessionId' AND dihapus='0';"));
                        $inputArray = [
                          [
                            "id" => 1,
                            "display" => "Foto",
                            "name" => "foto",
                            "type" => "image",
                            "value" => $data["foto"],
                            "placeholder" => "Masukkan foto disini",
                            "enable" => false
                          ],
                          [
                            "id" => 2,
                            "display" => "Isi Pengaduan",
                            "name" => "isi_pengaduan",
                            "type" => "textarea",
                            "value" => $data["isi_pengaduan"],
                            "placeholder" => "Masukkan isi pengaduan disini",
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
      $result = mysqli_query($connection, "UPDATE pengaduan SET dihapus='1' WHERE id='$id' AND id_masyarakat='$sessionId';");

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