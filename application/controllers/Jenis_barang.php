<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once "AuthController.php";

class Jenis_barang extends AuthController
{

    public function index()
    {
        $this->load->view('login');
    }
    function input()
    {
        require_once "application/connection/database.php";
        if (isset($_POST['simpan'])) {
            // ambil data hasil submit dari form
            $nama_jenis  = mysqli_real_escape_string($mysqli, trim($_POST['nama_jenis']));
            $created_user = $_SESSION['id_user'];

            // perintah query untuk menyimpan data ke tabel jenis
            $query = mysqli_query($mysqli, "INSERT INTO is_jenis_barang(nama_jenis,created_user,updated_user) 
                                            VALUES('$nama_jenis','$created_user','$created_user')")
                or die('Ada kesalahan pada query insert : ' . mysqli_error($mysqli));

            // cek query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil simpan data
                redirect("home/dashboard?module=jenis&alert=1");
            }
        }
    }

    function update()
    {
        require_once "application/connection/database.php";
        if (isset($_POST['simpan'])) {
            if (isset($_POST['id_jenis'])) {
                // ambil data hasil submit dari form
                $id_jenis    = mysqli_real_escape_string($mysqli, trim($_POST['id_jenis']));
                $nama_jenis  = mysqli_real_escape_string($mysqli, trim($_POST['nama_jenis']));
                $updated_user = $_SESSION['id_user'];

                // perintah query untuk mengubah data pada tabel jenis
                $query = mysqli_query($mysqli, "UPDATE is_jenis_barang SET nama_jenis    = '$nama_jenis',
                                                                     updated_user   = '$updated_user'
                                                               WHERE id_jenis      = '$id_jenis'")
                    or die('Ada kesalahan pada query update : ' . mysqli_error($mysqli));

                // cek query
                if ($query) {
                    // jika berhasil tampilkan pesan berhasil update data
                    redirect("home/dashboard?module=jenis&alert=2");
                }
            }
        }
    }


    function delete()
    {
        require_once "application/connection/database.php";
        if (isset($_GET['id'])) {
            $id_jenis = $_GET['id'];
            // perintah query untuk menghapus data pada tabel jenis
            // $query = mysqli_query($mysqli, "DELETE FROM is_jenis_barang WHERE id_jenis='$id_jenis'")
            //                                 or die('Ada kesalahan pada query delete : '.mysqli_error($mysqli));

            $query = mysqli_query($mysqli, "UPDATE is_jenis_barang SET deleted_user = '$_SESSION[id_user]', deleted_date = now() WHERE id_jenis = '$id_jenis'")
                or die('Ada kesalahan pada query Hapus : ' . mysqli_error($mysqli));

            // cek hasil query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil delete data
                redirect("home/dashboard?module=jenis&alert=3");
            }
        }
    }
}
