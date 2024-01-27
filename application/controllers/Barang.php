<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $this->load->view('login');
    }
    function input()
    {
        require_once "application/connection/database.php";
        if (isset($_POST['simpan'])) {
            // ambil data hasil submit dari form
            $id_barang    = mysqli_real_escape_string($mysqli, trim($_POST['id_barang']));
            $nama_barang  = mysqli_real_escape_string($mysqli, trim($_POST['nama_barang']));
            $safety_stok  = mysqli_real_escape_string($mysqli, trim($_POST['safety_stok']));
            $id_jenis     = mysqli_real_escape_string($mysqli, trim($_POST['jenis']));
            $id_satuan    = mysqli_real_escape_string($mysqli, trim($_POST['satuan']));

            $created_user = $_SESSION['id_user'];

            // perintah query untuk menyimpan data ke tabel barang
            $query = mysqli_query($mysqli, "INSERT INTO is_barang(id_barang,nama_barang,id_jenis,id_satuan,safety_stok,created_user,updated_user) 
                                            VALUE('$id_barang','$nama_barang','$id_jenis','$id_satuan','$safety_stok','$created_user','$created_user')")
                or die('Ada kesalahan pada query insert : ' . mysqli_error($mysqli));

            // cek query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil simpan data
                redirect("home/dashboard?module=barang&alert=1");
            }
        }
    }

    function update()
    {
        require_once "application/connection/database.php";
        if (isset($_POST['simpan'])) {
            if (isset($_POST['id_barang'])) {
                // ambil data hasil submit dari form
                $id_barang    = mysqli_real_escape_string($mysqli, trim($_POST['id_barang']));
                $nama_barang  = mysqli_real_escape_string($mysqli, trim($_POST['nama_barang']));
                $safety_stok  = mysqli_real_escape_string($mysqli, trim($_POST['safety_stok']));
                $id_jenis     = mysqli_real_escape_string($mysqli, trim($_POST['jenis']));
                $id_satuan    = mysqli_real_escape_string($mysqli, trim($_POST['satuan']));

                $updated_user = $_SESSION['id_user'];

                // perintah query untuk mengubah data pada tabel barang
                $query = mysqli_query($mysqli, "UPDATE is_barang SET nama_barang    = '$nama_barang',
                                                                     id_jenis       = '$id_jenis',
                                                                     safety_stok       = '$safety_stok',
                                                                     id_satuan      = '$id_satuan',
                                                                     updated_user   = '$updated_user'
                                                               WHERE id_barang      = '$id_barang'")
                    or die('Ada kesalahan pada query update : ' . mysqli_error($mysqli));

                // cek query
                if ($query) {
                    // jika berhasil tampilkan pesan berhasil update data
                    redirect("home/dashboard?module=barang&alert=2");
                }
            }
        }
    }

    function delete()
    {
        if (isset($_GET['id'])) {
            $id_barang = $_GET['id'];

            // perintah query untuk menghapus data pada tabel barang
            $query = mysqli_query($mysqli, "DELETE FROM is_barang WHERE id_barang='$id_barang'")
                or die('Ada kesalahan pada query delete : ' . mysqli_error($mysqli));

            // cek hasil query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil delete data
                redirect("home/dashboard?module=barang&alert=3");
            }
        }
    }
}
