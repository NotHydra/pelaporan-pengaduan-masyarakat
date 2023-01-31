<?php
if (!isset($_SESSION["id"])) {
    echo "<script>window.location='/$originalPath/sources/models/authentication/login/masyarakat.php';</script>";
};
