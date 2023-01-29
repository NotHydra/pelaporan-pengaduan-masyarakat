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
  include "$sourcePath/components/data-table/head.php";
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
                $extraTitle = "Utama";
                include "$sourcePath/components/content/head.php";
                ?>

                <div class="card-body">
                  <div class="row">
                    <div class="col-sm">
                      <table id="main-table" class="table table-bordered table-striped table-sm">
                        <thead>
                          <tr>
                            <th class="text-center align-middle export">No.</th>
                            <th class="text-center align-middle export">Nama</th>
                            <th class="text-center align-middle export">Username</th>
                            <th class="text-center align-middle export">Telepon</th>
                            <th class="text-center align-middle export">Level</th>
                            <th class="text-center align-middle export">Status</th>
                            <th class="text-center align-middle export">Dibuat</th>
                            <th class="text-center align-middle export">Diubah</th>
                            <th class="text-center align-middle export">Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $currentDate = date("Y-m-d H:i:s");
                          $result = mysqli_query($connection, "SELECT id, nama, username, telepon, level, status, dibuat, diubah FROM petugas WHERE dihapus='0';");
                          foreach ($result as $i => $data) {
                          ?>
                            <tr>
                              <td class="text-center align-middle"><?php echo $i + 1; ?>.</td>
                              <td class="align-middle"><?php echo $data["nama"]; ?></td>
                              <td class="align-middle"><?php echo $data["username"]; ?></td>
                              <td class="align-middle"><?php echo $data["telepon"]; ?></td>
                              <td class="text-center align-middle"><?php echo ucwords($data["level"]); ?></td>
                              <td class="text-center align-middle"><?php echo ucwords($data["status"]); ?></td>
                              <td class="text-center align-middle"><?php echo $data["dibuat"]; ?></td>
                              <td class="text-center align-middle"><?php echo dateInterval($data["diubah"], $currentDate); ?></td>

                              <td class="text-center align-middle">
                                <div class="btn-group">
                                  <a class="btn btn-app bg-warning m-0" href="./ubah?id=<?php echo $data['id']; ?>">
                                    <i class="fas fa-edit"></i> Ubah
                                  </a>

                                  <a class="btn btn-app bg-danger m-0" href="./ubah-password?id=<?php echo $data['id']; ?>">
                                    <i class="fas fa-lock"></i> Ubah Password
                                  </a>

                                  <a class="btn btn-app bg-danger m-0" href="./hapus?id=<?php echo $data['id']; ?>">
                                    <i class="fas fa-trash"></i> Hapus
                                  </a>
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

                  <a class="btn btn-primary btn-block mt-1" href="./buat.php"><i class="fa fa-plus"></i> Buat</a>
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
  ?>
</body>

</html>