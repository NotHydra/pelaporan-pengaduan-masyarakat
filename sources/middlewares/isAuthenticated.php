<?php
if (isset($_SESSION["id"])) {
    echo "<script>window.location='/$originalPath';</script>";
};
