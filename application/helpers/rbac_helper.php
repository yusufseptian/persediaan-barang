<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

function isAdmin(): bool
{
    $result = false;
    if (isset($_SESSION['hak_akses'])) {
        $result = strtolower($_SESSION['hak_akses']) == "super admin";
    }
    return $result;
}

function isStaffGudang(): bool
{
    $result = false;
    if (isset($_SESSION['hak_akses'])) {
        $result = strtolower($_SESSION['hak_akses']) == "gudang";
    }
    return $result;
}

function isManajer(): bool
{
    $result = false;
    if (isset($_SESSION['hak_akses'])) {
        $result = strtolower($_SESSION['hak_akses']) == "manajer";
    }
    return $result;
}
