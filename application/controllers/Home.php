<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
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
	function login()
	{
		require_once "application/connection/database.php";

		// ambil data hasil submit dari form
		$username = mysqli_real_escape_string($mysqli, stripslashes(strip_tags(htmlspecialchars(trim($_POST['username'])))));
		$password = md5(mysqli_real_escape_string($mysqli, stripslashes(strip_tags(htmlspecialchars(trim($_POST['password']))))));

		// pastikan username dan password adalah berupa huruf atau angka.
		if (!ctype_alnum($username) or !ctype_alnum($password)) {
			header("Location: index.php?alert=1");
		} else {
			// ambil data dari tabel user untuk pengecekan berdasarkan inputan username dan passrword
			$query = mysqli_query($mysqli, "SELECT * FROM is_users WHERE username='$username' AND password='$password' AND status='aktif'")
				or die('Ada kesalahan pada query user: ' . mysqli_error($mysqli));
			$rows  = mysqli_num_rows($query);

			// jika data ada, jalankan perintah untuk membuat session
			if ($rows > 0) {
				$data  = mysqli_fetch_assoc($query);

				// session_start();
				$_SESSION['id_user']   = $data['id_user'];
				$_SESSION['username']  = $data['username'];
				$_SESSION['password']  = $data['password'];
				$_SESSION['nama_user'] = $data['nama_user'];
				$_SESSION['hak_akses'] = $data['hak_akses'];

				// lalu alihkan ke halaman user
				redirect("home/dashboard?module=home");
				redirect('home/dashboard');
			}

			// jika data tidak ada, alihkan ke halaman login dan tampilkan pesan = 1
			else {
				header("Location: index.php?alert=1");
			}
		}
	}

	function dashboard()
	{
		$this->load->view('main', 'modules/beranda/view');
	}

	function logout()
	{
		session_start();
		// hapus session
		session_destroy();

		// alihkan ke halaman login (index.php) dan berikan alert = 2
		//header('Location: index.php?alert=2');
		redirect('home');
	}
}
