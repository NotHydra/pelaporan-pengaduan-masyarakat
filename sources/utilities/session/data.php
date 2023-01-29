<?php
$sessionId = $_SESSION["id"];
$sessionType = $_SESSION["type"];

if ($sessionType == "petugas") {
    $result = mysqli_query($connection, "SELECT nama, username, telepon, level FROM petugas WHERE id='$sessionId' AND status='aktif' AND dihapus='0';");

    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);

        $sessionNama = $data["nama"];
        $sessionUsername = $data["username"];
        $sessionTelepon = $data["telepon"];

        $sessionLevel = $data["level"];
        $sessionStatus = "aktif";
    } else {
        echo "<script>window.location='/$originalPath/sources/models/authentication/logout.php'</script>";
    }
} else if ($sessionType == "masyarakat") {
    $result = mysqli_query($connection, "SELECT nik, nama, username, telepon FROM masyarakat WHERE id='$sessionId' AND dihapus='0';");

    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);

        $sessionNIK = $data["nik"];
        $sessionNama = $data["nama"];
        $sessionUsername = $data["username"];
        $sessionTelepon = $data["telepon"];

        $sessionLevel = "masyarakat";
        $sessionStatus = "aktif";
    } else {
        echo "<script>window.location='/$originalPath/sources/models/authentication/logout.php'</script>";
    }
}
