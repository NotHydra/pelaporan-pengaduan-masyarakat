<?php
$sourcePath = "../../..";
include "$sourcePath/utilities/environment.php";
include "$sourcePath/utilities/connection.php";
include "$sourcePath/utilities/session/start.php";

include "$sourcePath/middlewares/isAuthenticated.php";

include "$sourcePath/utilities/date.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  $headTitle = "Register Masyarakat";
  include "$sourcePath/components/head.php";
  include "$sourcePath/utilities/modal.php";
  ?>
</head>

<body class="hold-transition login-page" id="body-theme">
  <div class="login-box" id="login-container">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="/<?php echo $originalPath; ?>" class="h1"><b>Pelaporan</b></a>
      </div>

      <div class="card-body">
        <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST" onsubmit="return confirmModal('form', this, 'login-container');">
          <?php
          $inputArray = [
            [
              "id" => 1,
              "display" => "NIK",
              "name" => "nik",
              "type" => "number",
              "icon" => "address-card",
              "value" => isset($_POST["nik"]) ? $_POST["nik"] : null
            ],
            [
              "id" => 2,
              "display" => "Nama",
              "name" => "nama",
              "type" => "text",
              "icon" => "user-circle",
              "value" => isset($_POST["nama"]) ? $_POST["nama"] : null
            ],
            [
              "id" => 3,
              "display" => "Username",
              "name" => "username",
              "type" => "text",
              "icon" => "user",
              "value" => isset($_POST["username"]) ? $_POST["username"] : null
            ],
            [
              "id" => 4,
              "display" => "Telepon",
              "name" => "telepon",
              "type" => "number",
              "icon" => "phone",
              "value" =>  isset($_POST["telepon"]) ? $_POST["telepon"] : null
            ],
            [
              "id" => 5,
              "display" => "Password",
              "name" => "password",
              "type" => "password",
              "icon" => "lock",
              "value" =>  isset($_POST["password"]) ? $_POST["password"] : null
            ],
            [
              "id" => 6,
              "display" => "Konfirmasi Password",
              "name" => "konfirmasi_password",
              "type" => "password",
              "icon" => "unlock",
              "value" =>  isset($_POST["konfirmasi_password"]) ? $_POST["konfirmasi_password"] : null
            ]
          ];

          include "$sourcePath/components/input/basic.php";
          ?>

          <div class="row">
            <div class="col-sm">
              <button type="submit" class="btn btn-primary btn-block">Register Masyarakat</button>
            </div>
          </div>
        </form>

        <div class="mt-1">
          <p class="mb-0">
            <a href="../login/masyarakat.php" class="text-center">Login Masyarakat</a>
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="title is-6 m-1 p-0"><b>Copyright © <?php echo currentYear(); ?> XII RPL</b></div>

  <?php
  include "$sourcePath/components/script.php";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = md5($_POST["password"]);
    $konfirmasiPassword = md5($_POST["konfirmasi_password"]);

    if ($password == $konfirmasiPassword) {
      $nik = $_POST["nik"];
      $nama = $_POST["nama"];
      $username = $_POST["username"];
      $telepon = $_POST["telepon"];

      try {
        $result = mysqli_query($connection, "INSERT INTO masyarakat (nik, nama, username, password, telepon) VALUES ('$nik', '$nama', '$username', '$password', '$telepon');");

        if ($result) {
          echo "<script>successModal(null, null, 'login-container');</script>";
        } else {
          echo "<script>errorModal(null, null, 'login-container');</script>";
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

        echo "<script>errorModal('$message', null, 'login-container');</script>";
      };
    } else {
      echo "<script>errorModal('Konfirmasi password salah', null, 'login-container');</script>";
    };
  };
  ?>
</body>

</html>