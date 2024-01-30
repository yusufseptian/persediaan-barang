<?php
//session_start();
ob_start();

// Panggil koneksi database.php untuk koneksi database
require_once "application/connection/database.php";
// panggil fungsi untuk format tanggal
include "application/connection/fungsi_tanggal.php";

$hari_ini = date("d-m-Y");

// ambil data hasil submit dari form
$tgl1     = $_GET['tgl_awal'];
$explode  = explode('-', $tgl1);
$tgl_awal = $explode[2] . "-" . $explode[1] . "-" . $explode[0];

$tgl2      = $_GET['tgl_akhir'];
$explode   = explode('-', $tgl2);
$tgl_akhir = $explode[2] . "-" . $explode[1] . "-" . $explode[0];

if (isset($_GET['tgl_awal'])) {
    $no    = 1;
    // fungsi query untuk menampilkan data dari tabel barang masuk
    $query = mysqli_query($mysqli, "SELECT a.id_barang_masuk,a.tanggal_masuk,a.id_barang,a.jumlah_masuk,b.id_barang,b.nama_barang,b.id_satuan,c.id_satuan,c.nama_satuan
                                    FROM is_barang_masuk as a INNER JOIN is_barang as b INNER JOIN is_satuan as c
                                    ON a.id_barang=b.id_barang AND b.id_satuan=c.id_satuan
                                    WHERE a.tanggal_masuk BETWEEN '$tgl_awal' AND '$tgl_akhir'
                                    ORDER BY a.id_barang_masuk ASC")
        or die('Ada kesalahan pada query tampil Transaksi : ' . mysqli_error($mysqli));
    $count  = mysqli_num_rows($query);
}
?>
<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>LAPORAN DATA BARANG MASUK</title>
    <!-- JQuery -->
    <script src="<?= base_url('assets/plugins/jQuery/jQuery-2.1.3.min.js') ?>"></script>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/bootstrap/5.3/css/bootstrap.min.css') ?>">
    <script src="<?= base_url('assets/plugins/bootstrap/5.3/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- Native -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/laporan.css" />
    <style>
        .table>thead>tr>th {
            text-align: center;
        }
    </style>
</head>

<body>
    <div id="title">
        LAPORAN DATA BARANG MASUK
    </div>
    <?php
    if ($tgl_awal == $tgl_akhir) { ?>
        <div id="title-tanggal">
            Tanggal <?php echo tgl_eng_to_ind($tgl1); ?>
        </div>
    <?php
    } else { ?>
        <div id="title-tanggal">
            Tanggal <?php echo tgl_eng_to_ind($tgl1); ?> s.d. <?php echo tgl_eng_to_ind($tgl2); ?>
        </div>
    <?php
    }
    ?>

    <hr><br>
    <div id="isi">
        <table width="100%" border="0.3" cellpadding="0" cellspacing="0">
            <thead style="background:#e8ecee">
                <tr class="tr-title">
                    <th height="20" align="center" valign="middle">NO.</th>
                    <th height="20" align="center" valign="middle">ID TRANSAKSI</th>
                    <th height="20" align="center" valign="middle">TANGGAL</th>
                    <th height="20" align="center" valign="middle">ID BARANG</th>
                    <th height="20" align="center" valign="middle">NAMA BARANG</th>
                    <th height="20" align="center" valign="middle">JUMLAH MASUK</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // jika data ada
                if ($count == 0) {
                    echo "  <tr>
                    <td width='40' height='13' align='center' valign='middle'></td>
                    <td width='120' height='13' align='center' valign='middle'></td>
                    <td width='120' height='13' align='center' valign='middle'></td>
                    <td width='80' height='13' align='center' valign='middle'></td>
                    <td style='padding-left:5px;' width='210' height='13' valign='middle'></td>
                    <td style='padding-left:5px;' width='100' height='13' valign='middle'></td>
                </tr>";
                }
                // jika data tidak ada
                else {
                    // tampilkan data
                    while ($data = mysqli_fetch_assoc($query)) {
                        $tanggal       = $data['tanggal_masuk'];
                        $exp           = explode('-', $tanggal);
                        $tanggal_masuk = tgl_eng_to_ind($exp[2] . "-" . $exp[1] . "-" . $exp[0]);

                        // menampilkan isi tabel dari database ke tabel di aplikasi
                        echo "  <tr>
                        <td width='40' height='13' align='center' valign='middle'>$no</td>
                        <td width='120' height='13' align='center' valign='middle'>$data[id_barang_masuk]</td>
                        <td width='120' height='13' align='center' valign='middle'>$tanggal_masuk</td>
                        <td width='80' height='13' align='center' valign='middle'>$data[id_barang]</td>
                        <td style='padding-left:5px;' width='210' height='13' valign='middle'>$data[nama_barang]</td>
                        <td style='padding-left:5px;' width='100' height='13' valign='middle'>$data[jumlah_masuk] $data[nama_satuan]</td>
                    </tr>";
                        $no++;
                    }
                }
                ?>
            </tbody>
        </table>

        <div id="footer-tanggal">
            Bandarlampung, <?php echo tgl_eng_to_ind("$hari_ini"); ?>
        </div>
        <div id="footer-jabatan">
            Pimpinan
        </div>

        <div id="footer-nama">
            <?= $_SESSION['nama_user'] ?>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            window.print();
            window.close();
        })
    </script>
</body>

</html><!-- Akhir halaman HTML yang akan di konvert -->
<?php
// $filename="LAPORAN DATA BARANG MASUK.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
// //==========================================================================================================
// $content = ob_get_clean();
// $content = '<page style="font-family: freeserif">'.($content).'</page>';
// // panggil library html2pdf
// require_once('assets/plugins/html2pdf_v4.03/html2pdf.class.php');
// try
// {
//     $html2pdf = new HTML2PDF('P','F4','en', false, 'ISO-8859-15',array(10, 10, 10, 10));
//     $html2pdf->setDefaultFont('Arial');
//     $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
//     $html2pdf->Output($filename);
// }
// catch(HTML2PDF_exception $e) { echo $e; }
?>