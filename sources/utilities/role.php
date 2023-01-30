<?php
$roleLevel = array(
    "masyarakat" => 1,
    "petugas" => 2,
    "administrator" => 3,
    "superadministrator" => 4,
);

function roleConvert($role)
{
    global $roleLevel;

    return $roleLevel[$role];
}

function roleCheckMinimum($role, $level)
{
    if (roleConvert($role) >= roleConvert($level)) {
        return true;
    } else {
        return false;
    }
}

function roleCheckSingle($role, $level)
{
    if (roleConvert($role) == roleConvert($level)) {
        return true;
    } else {
        return false;
    }
}

function roleGuardMinimum($role, $level, $path)
{
    if (!roleCheckMinimum($role, $level)) {
        echo "<script>window.location='$path';</script>";
    }
}

function roleGuardSingle($role, $level, $path)
{
    if (!roleCheckSingle($role, $level)) {
        echo "<script>window.location='$path';</script>";
    }
}
