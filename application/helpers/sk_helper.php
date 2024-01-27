<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * tables
 */

function stok_barang($table = null, $param = null){
    //$table = 'is_barang';
    $CI = & get_instance();
    if ($param != null) { $CI->db->where($param); }
    $data = $CI->db->query('SELECT a.id_barang,a.nama_barang,a.id_jenis,a.id_satuan,a.stok, a.safety_stok,b.id_jenis,b.nama_jenis,c.id_satuan,c.nama_satuan 
                                            FROM is_barang as a INNER JOIN is_jenis_barang as b INNER JOIN is_satuan as c
                                            ON a.id_jenis=b.id_jenis AND a.id_satuan=c.id_satuan ORDER BY id_barang DESC');
    return $data->result_array();
}



