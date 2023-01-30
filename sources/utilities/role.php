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

function roleMinimum($role, $minimumLevel)
{
    if (roleConvert($role) >= roleConvert($minimumLevel)) {
        return true;
    } else {
        return false;
    }
}

function roleSingle($role, $level)
{
    if (roleConvert($role) == roleConvert($level)) {
        return true;
    } else {
        return false;
    }
}

function roleMultiple($role, $level)
{
    if (in_array(roleConvert($role), array_map(function ($role) {
        return roleConvert($role);
    }, $level))) {
        return true;
    } else {
        return false;
    }
}