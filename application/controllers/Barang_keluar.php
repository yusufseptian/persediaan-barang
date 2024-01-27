<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_keluar extends CI_Controller {

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
        $id_barang_keluar = mysqli_real_escape_string($mysqli, trim($_POST['id_barang_keluar']));

        $tanggal          = mysqli_real_escape_string($mysqli, trim($_POST['tanggal_keluar']));
        $exp              = explode('-',$tanggal);
        $tanggal_keluar   = $exp[2]."-".$exp[1]."-".$exp[0];

        $id_barang        = mysqli_real_escape_string($mysqli, trim($_POST['id_barang']));
        $jumlah_keluar    = mysqli_real_escape_string($mysqli, trim($_POST['jumlah_keluar']));
        $total_stok       = mysqli_real_escape_string($mysqli, trim($_POST['total_stok']));

        $created_user     = $_SESSION['id_user'];

            // perintah query untuk menyimpan data ke tabel barang keluar
        $query = mysqli_query($mysqli, "INSERT INTO is_barang_keluar(id_barang_keluar,tanggal_keluar,id_barang,jumlah_keluar,created_user) 
            VALUES('$id_barang_keluar','$tanggal_keluar','$id_barang','$jumlah_keluar','$created_user')")
        or die('Ada kesalahan pada query insert : '.mysqli_error($mysqli));    

            // cek query
        if ($query) {                      
                // jika berhasil tampilkan pesan berhasil simpan data
            redirect("home/dashboard? module=barang_keluar&alert=1");
        }   
    }elseif ($_GET['act']=='approve') {
        if (isset($_GET['id'])) {
            // ambil data hasil submit dari form
            $id_barang_keluar = mysqli_real_escape_string($mysqli, trim($_GET['id']));
            $jumlah_keluar    = mysqli_real_escape_string($mysqli, trim($_GET['jml']));
            $id_barang        = mysqli_real_escape_string($mysqli, trim($_GET['idb']));
            $stok             = mysqli_real_escape_string($mysqli, trim($_GET['stok']));
            $status           = "Approve";
            $sisa_stok        = $stok - $jumlah_keluar;

            // perintah query untuk mengubah data pada tabel barang
            $query = mysqli_query($mysqli, "UPDATE is_barang_keluar SET status              = '$status'
              WHERE id_barang_keluar    = '$id_barang_keluar'")
            or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));

            // cek query
            if ($query) {
                // perintah query untuk mengubah data pada tabel barang
                $query1 = mysqli_query($mysqli, "UPDATE is_barang SET stok = '$sisa_stok'
                    WHERE id_barang = '$id_barang'")
                or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));

                // cek query
                if ($query1) {                       
                    // jika berhasil tampilkan pesan berhasil simpan data
                    redirect("home/dashboard?module=barang_keluar&alert=2");
                }
            }     
        }   
    }elseif ($_GET['act']=='reject') {
        if (isset($_GET['id'])) {
            // ambil data hasil submit dari form
            $id_barang_keluar = mysqli_real_escape_string($mysqli, trim($_GET['id']));
            $status           = "Reject";

            // perintah query untuk mengubah data pada tabel barang
            $query = mysqli_query($mysqli, "UPDATE is_barang_keluar SET status              = '$status'
              WHERE id_barang_keluar    = '$id_barang_keluar'")
            or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));

            // cek query
            if ($query) {                  
                // jika berhasil tampilkan pesan berhasil simpan data
                redirect("home/dashboard?module=barang_keluar&alert=3");
            }     
        }   
    }  
}


function cek_barang(){
    require_once "application/connection/database.php";
    if(isset($_POST['dataidbarang'])) {
        $id_barang = $_POST['dataidbarang'];

  // fungsi query untuk menampilkan data dari tabel barang
        $query = mysqli_query($mysqli, "SELECT a.id_barang,a.nama_barang,a.id_satuan,a.stok,b.id_satuan,b.nama_satuan 
          FROM is_barang as a INNER JOIN is_satuan as b ON a.id_satuan=b.id_satuan 
          WHERE id_barang='$id_barang'")
        or die('Ada kesalahan pada query tampil data barang: '.mysqli_error($mysqli));

  // tampilkan data
        $data = mysqli_fetch_assoc($query);

        $stok   = $data['stok'];
        $satuan = $data['nama_satuan'];

        if($stok != '') {
            echo "<div class='form-group'>
            <label class='col-sm-2 control-label'>Stok</label>
            <div class='col-sm-5'>
              <div class='input-group'>
                <input type='text' class='form-control' id='stok' name='stok' value='$stok' readonly>
                <span class='input-group-addon'>$satuan</span>
            </div>
        </div>
    </div>";
} else {
    echo "<div class='form-group'>
    <label class='col-sm-2 control-label'>Stok</label>
    <div class='col-sm-5'>
      <div class='input-group'>
        <input type='text' class='form-control' id='stok' name='stok' value='Stok barang tidak ditemukan' readonly>
        <span class='input-group-addon'>Satuan barang tidak ditemukan</span>
    </div>
</div>
</div>";
}       
}
}


function approve(){
    require_once "application/connection/database.php";
    if (isset($_GET['id'])) {
            // ambil data hasil submit dari form
        $id_barang_keluar = mysqli_real_escape_string($mysqli, trim($_GET['id']));
        $jumlah_keluar    = mysqli_real_escape_string($mysqli, trim($_GET['jml']));
        $id_barang        = mysqli_real_escape_string($mysqli, trim($_GET['idb']));
        $stok             = mysqli_real_escape_string($mysqli, trim($_GET['stok']));
        $status           = "Approve";
        $sisa_stok        = $stok - $jumlah_keluar;

            // perintah query untuk mengubah data pada tabel barang
        $query = mysqli_query($mysqli, "UPDATE is_barang_keluar SET status              = '$status'
          WHERE id_barang_keluar    = '$id_barang_keluar'")
        or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));

            // cek query
        if ($query) {
                // perintah query untuk mengubah data pada tabel barang
            $query1 = mysqli_query($mysqli, "UPDATE is_barang SET stok = '$sisa_stok'
                WHERE id_barang = '$id_barang'")
            or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));

                // cek query
            if ($query1) {                       
                    // jika berhasil tampilkan pesan berhasil simpan data
                redirect("home/dashboard?module=barang_keluar&alert=2");
            }
        }     
    }
}

function reject(){
    require_once "application/connection/database.php";
    if (isset($_GET['id'])) {
            // ambil data hasil submit dari form
        $id_barang_keluar = mysqli_real_escape_string($mysqli, trim($_GET['id']));
        $status           = "Reject";

            // perintah query untuk mengubah data pada tabel barang
        $query = mysqli_query($mysqli, "UPDATE is_barang_keluar SET status              = '$status'
          WHERE id_barang_keluar    = '$id_barang_keluar'")
        or die('Ada kesalahan pada query update : '.mysqli_error($mysqli));

            // cek query
        if ($query) {                  
                // jika berhasil tampilkan pesan berhasil simpan data
            redirect("home/dashboard?module=barang_keluar&alert=3");
        }     
    } 

}
}
