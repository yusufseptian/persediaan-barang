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

function isAllowedModule($module): bool
{
    $adminAccess = ['barang', 'jenis', 'satuan', 'user', 'form_barang', 'form_user', 'form_jenis', 'form_satuan', 'barang_masuk', 'form_barang_masuk', 'barang_keluar', 'form_barang_keluar', 'lap_stok', 'lap_barang_masuk', 'lap_barang_keluar'];
    $staffAccess = ['barang_masuk', 'form_barang_masuk', 'barang_keluar', 'form_barang_keluar', 'lap_stok', 'lap_barang_masuk', 'lap_barang_keluar'];
    $manajerAccess = ['lap_stok', 'lap_barang_masuk', 'lap_barang_keluar'];
    $allAccess = ['home', 'password'];
    $isAllowed = false;
    if (isAdmin()) {
        $akses = $adminAccess;
    } elseif (isStaffGudang()) {
        $akses = $staffAccess;
    } elseif (isManajer()) {
        $akses = $manajerAccess;
    }
    $akses = array_merge($akses, $allAccess);
    foreach ($akses as $dt) {
        if ($module == $dt) {
            $isAllowed = true;
            break;
        }
    }
    return $isAllowed;
}
