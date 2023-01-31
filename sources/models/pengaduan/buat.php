<?php
$sourcePath = "../..";
include "$sourcePath/utilities/environment.php";
include "$sourcePath/utilities/connection.php";
include "$sourcePath/utilities/session/start.php";

include "$sourcePath/middlewares/isNotAuthenticated.php";

include "$sourcePath/utilities/session/data.php";
include "$sourcePath/utilities/role.php";
include "$sourcePath/utilities/date.php";

roleGuardSingle($sessionLevel, "masyarakat", "/$originalPath");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $headTitle = "Pengaduan";
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
                $extraTitle = "Buat";
                include "$sourcePath/components/content/head.php";
                ?>

                <div class="card-body">
                  <div class="row">
                    <div class="col-sm">
                      <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST" onsubmit="return confirmModal('form', this);" enctype="multipart/form-data">
                        <?php
                        $inputArray = [
                          [
                            "id" => 1,
                            "display" => "Foto",
                            "name" => "foto",
                            "type" => "image",
                            "value" => null,
                            "placeholder" => "Masukkan foto disini",
                            "enable" => true
                          ],
                          [
                            "id" => 2,
                            "display" => "Isi Pengaduan",
                            "name" => "isi_pengaduan",
                            "type" => "textarea",
                            "value" => isset($_POST["isi_pengaduan"]) ? $_POST["isi_pengaduan"] : null,
                            "placeholder" => "Masukkan isi pengaduan disini",
                            "enable" => true

                          ],
                        ];

                        include "$sourcePath/components/input/detail.php";
                        ?>

                        <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-plus"></i> Buat</button>
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
    $foto = date("Ymdhis") . "-" . $_FILES["foto"]["name"];
    $isiPengaduan = $_POST["isi_pengaduan"];

    try {
      move_uploaded_file($_FILES['foto']['tmp_name'], $sourcePath . '/public/dist/img/storage/' . $foto);
      $result = mysqli_query($connection, "INSERT INTO pengaduan (id_masyarakat, foto, isi_pengaduan) VALUES ('$sessionId', '$foto', '$isiPengaduan');");

      if ($result) {
        echo "<script>successModal(null, null);</script>";
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