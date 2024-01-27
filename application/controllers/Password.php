<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Password extends CI_Controller {
	
	public function change()
	{
        require_once "application/connection/database.php";
		if (isset($_POST['simpan'])) {
        if (isset($_SESSION['id_user'])) {
            // ambil data hasil submit dari form
            $old_pass    = md5(mysqli_real_escape_string($mysqli, trim($_POST['old_pass'])));
            $new_pass    = md5(mysqli_real_escape_string($mysqli, trim($_POST['new_pass'])));
            $retype_pass = md5(mysqli_real_escape_string($mysqli, trim($_POST['retype_pass'])));

            // ambil data hasil session user
            $id_user = $_SESSION['id_user'];

            // seleksi password dari tabel user untuk dicek
            $sql = mysqli_query($mysqli, "SELECT password FROM is_users WHERE id_user=$id_user")
                                          or die('Ada kesalahan pada query seleksi password : '.mysqli_error($mysqli));
            $data = mysqli_fetch_assoc($sql);

            // fungsi untuk pengecekan password sebelum diubah 
            // jika input password lama tidak sama dengan password di database, 
            // alihkan ke halaman ubah password dan tampilkan pesan = 1
            if ($old_pass != $data['password']){
                redirect("home/dashboard?module=password&alert=1");
            }

            // jika input password lama sama dengan password didatabase, jalankan perintah untuk pengecekan selanjutnya
            else {

                // jika input password baru tidak sama dengan input ulangi password baru, 
                // alihkan ke halaman ubah password dan tampilkan pesan = 2 
                if ($new_pass != $retype_pass){
                        redirect("home/dashboard?module=password&alert=2");
                }

                // selain itu, jalankan perintah update password
                else {
                    // perintah query untuk mengubah data pada tabel user
                    $query = mysqli_query($mysqli, "UPDATE is_users SET password = '$new_pass'
                                                                  WHERE id_user  = '$id_user'")
                                                    or die('Ada kesalahan pada query update password : '.mysqli_error($mysqli));   

                    // cek query
                    if ($query) {
                        // jika berhasil tampilkan pesan berhasil update data
                        redirect("home/dashboard?module=password&alert=3");
                    }   
                }
            }
        }
	}
	
}
