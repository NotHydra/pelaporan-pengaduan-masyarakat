<?php
$sourcePath = "../..";
include "$sourcePath/utilities/environment.php";
include "$sourcePath/utilities/connection.php";
include "$sourcePath/utilities/session/start.php";

include "$sourcePath/middlewares/isNotAuthenticated.php";

include "$sourcePath/utilities/session/data.php";
include "$sourcePath/utilities/role.php";
include "$sourcePath/utilities/date.php";

roleGuardMinimum($sessionLevel, "petugas", "/$originalPath");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $headTitle = "Tanggapan";
  include "$sourcePath/components/head.php";
  include "$sourcePath/components/data-table/head.php";
  include "$sourcePath/components/select/head.php";
  include "$sourcePath/utilities/modal.php";
  ?>
</head>

<body class="hold-transition layout-navbar-fixed layout-fixed light-mode" id="body-theme">
  <div class="wrapper">
    <?php
    $navActive = [5, null];
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
                $extraTitle = "Utama";
                include "$sourcePath/components/content/head.php";
                ?>

                <div class="card-body">
                  <form class="row mb-2" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div class="col-sm">
                      <?php
                      $inputArray = [
                        [
                          "id" => 1,
                          "display" => null,
                          "name" => "tahun",
                          "type" => "select",
                          "value" => [
                            array_merge([[0, "Semua"]], array_map(function ($yearObject) {
                              return [$yearObject[0], $yearObject[0]];
                            }, mysqli_fetch_all(mysqli_query($connection, "SELECT DISTINCT YEAR(dibuat) FROM pengaduan WHERE (status='diproses' OR status='selesai') AND dihapus='0' ORDER BY dibuat DESC;")))), isset($_POST["tahun"]) ? $_POST["tahun"] : null
                          ],
                          "placeholder" => "Pilih tahun disini",
                          "enable" => true
                        ],
                      ];

                      include "$sourcePath/components/input/detail.php";
                      ?>
                    </div>

                    <div class="col-sm">
                      <?php
                      $inputArray = [
                        [
                          "id" => 1,
                          "display" => null,
                          "name" => "bulan",
                          "type" => "select",
                          "value" => [
                            [
                              [0, "Semua"],
                              [1, "Januari"],
                              [2, "Februari"],
                              [3, "Maret"],
                              [4, "April"],
                              [5, "Mei"],
                              [6, "Juni"],
                              [7, "Juli"],
                              [8, "Agustus"],
                              [9, "September"],
                              [10, "Oktober"],
                              [11, "November"],
                              [12, "Desember"]
                            ], isset($_POST["bulan"]) ? $_POST["bulan"] : null
                          ],
                          "placeholder" => "Pilih bulan disini",
                          "enable" => true
                        ],
                      ];

                      include "$sourcePath/components/input/detail.php";
                      ?>
                    </div>

                    <div class="col-sm">
                      <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-search"></i> Cari</button>
                    </div>
                  </form>

                  <div class="row">
                    <div class="col-sm">
                      <table id="main-table" class="table table-bordered table-striped table-sm">
                        <thead>
                          <tr>
                            <th class="text-center align-middle export">No.</th>
                            <th class="text-center align-middle export">Masyarakat</th>
                            <th class="text-center align-middle export">Foto</th>
                            <th class="text-center align-middle export">Isi Pengaduan</th>
                            <th class="text-center align-middle export">Status</th>
                            <th class="text-center align-middle export">Dibuat</th>
                            <th class="text-center align-middle export">Diubah</th>
                            <th class="text-center align-middle export">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $currentDate = date("Y-m-d H:i:s");

                          $extraFilter = "";
                          if (isset($_POST["tahun"])) {
                            $tahunFilter = $_POST["tahun"];
                            if ($tahunFilter != 0) {
                              $extraFilter = $extraFilter . " AND YEAR(dibuat)='$tahunFilter'";
                            };
                          };

                          if (isset($_POST["bulan"])) {
                            $bulanFilter = $_POST["bulan"];
                            if ($bulanFilter != 0) {
                              $extraFilter = $extraFilter . " AND MONTH(dibuat)='$bulanFilter'";
                            };
                          };

                          $result = mysqli_query($connection, "SELECT id, id_masyarakat, foto, isi_pengaduan, status, dibuat, diubah FROM pengaduan WHERE (status='diproses' OR status='selesai') AND dihapus='0' $extraFilter ORDER BY dibuat DESC;");
                          foreach ($result as $i => $data) {
                            $id = $data["id"];
                            $idMasyarakat = $data["id_masyarakat"];
                            $dataMasyarakat = mysqli_fetch_assoc(mysqli_query($connection, "SELECT nik, nama FROM masyarakat WHERE id='$idMasyarakat' AND dihapus='0';"));
                          ?>
                            <tr>
                              <td class="text-center align-middle"><?php echo $i + 1; ?>.</td>
                              <td class="text-center align-middle"><?php echo $dataMasyarakat["nik"] . " - " . $dataMasyarakat["nama"]; ?></td>
                              <td class="text-center align-middle">
                                <img class="m-auto d-block" src="<?php echo $sourcePath; ?>/public/dist/img/storage/<?php echo $data["foto"]; ?>" width="400px">
                              </td>
                              <td class="align-middle"><?php echo $data["isi_pengaduan"]; ?></td>
                              <td class="text-center align-middle"><?php echo ucwords($data["status"]); ?></td>
                              <td class="text-center align-middle"><?php echo $data["dibuat"]; ?></td>
                              <td class="text-center align-middle"><?php echo dateInterval($data["diubah"], $currentDate); ?></td>

                              <td class="text-center align-middle">
                                <div class="btn-group">
                                  <a class="btn btn-app bg-primary m-0" href="./daftar.php?id=<?php echo $id; ?>">
                                    <i class="fas fa-clipboard"></i> Tanggapan
                                  </a>

                                  <?php
                                  if ($data["status"] == "diproses") {
                                  ?>
                                    <a class="btn btn-app bg-success m-0" role="button" onclick="confirmModal('location', '.?id=<?php echo $id; ?>&type=selesai');">
                                      <i class="fas fa-check"></i> Selesai
                                    </a>
                                  <?php
                                  } else if ($data["status"] == "selesai") {
                                  ?>
                                    <a class="btn btn-app bg-warning m-0" role="button" onclick="confirmModal('location', '.?id=<?php echo $id; ?>&type=batal');">
                                      <i class="fas fa-undo"></i> Batalkan
                                    </a>
                                  <?php
                                  };
                                  ?>
                                </div>
                              </td>
                            </tr>
                          <?php
                          };
                          ?>
                        </tbody>
                      </table>
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
  include "$sourcePath/components/data-table/script.php";
  include "$sourcePath/components/select/script.php";

  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["id"]) and isset($_GET["type"])) {
      $id = $_GET["id"];
      $type = $_GET["type"];

      try {
        $status = mysqli_fetch_assoc(mysqli_query($connection, "SELECT status FROM pengaduan WHERE id=$id AND dihapus='0';"))["status"];

        if ($type == "selesai" and $status == "diproses") {
          $result = mysqli_query($connection, "UPDATE pengaduan SET status='selesai' WHERE id='$id' AND dihapus='0';");
        } else if ($type == "batal" and $status == "selesai") {
          $result = mysqli_query($connection, "UPDATE pengaduan SET status='diproses' WHERE id='$id' AND dihapus='0';");
        } else {
          $result = null;
        };

        if ($result) {
          echo "<script>successModal(null, '.');</script>";
        } else {
          echo "<script>errorModal(null, null);</script>";
        };
      } catch (exception $e) {
        echo "<script>errorModal(null, null);</script>";
      };
    }
  };
  ?>
</body>

</html>