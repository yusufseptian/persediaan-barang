<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_barang extends CI_Controller {

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
	function input(){
		require_once "application/connection/database.php";
		 if (isset($_POST['simpan'])) {
            // ambil data hasil submit dari form
            $nama_jenis  = mysqli_real_escape_string($mysqli, trim($_POST['nama_jenis']));
            $created_user = $_SESSION['id_user'];

            // perintah query untuk menyimpan data ke tabel jenis
            $query = mysqli_query($mysqli, "INSERT INTO is_jenis_barang(nama_jenis,created_user,updated_user) 
                                            VALUES('$nama_jenis','$created_user','$created_user')")
                                            or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));    

            // cek query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil simpan data
                redirect("home/dashboard?module=jenis&alert=1");
            }   
        } 
	}

	function update(){
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
                                                or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));

                // cek query
                if ($query) {
                    // jika berhasil tampilkan pesan berhasil update data
                    redirect("home/dashboard?module=jenis&alert=2");
                }         
            }
        }
	}

	function delete(){
		if (isset($_GET['id'])) {
            $id_jenis = $_GET['id'];
    
            // perintah query untuk menghapus data pada tabel jenis
            $query = mysqli_query($mysqli, "DELETE FROM is_jenis_barang WHERE id_jenis='$id_jenis'")
                                            or die('Ada kesalahan pada query delete : '.mysqli_error($mysqli));

            // cek hasil query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil delete data
                redirect("home/dashboard?module=jenis&alert=3");
            }
        }
	}
}
