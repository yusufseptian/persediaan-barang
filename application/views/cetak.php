<?php
//session_start();
ob_start();

// Panggil koneksi database.php untuk koneksi database
require_once "application/connection/database.php";
// panggil fungsi untuk format tanggal
include "application/connection/fungsi_tanggal.php";

$hari_ini = date("d-m-Y");

$no = 1;
// fungsi query untuk menampilkan data dari tabel transaksi
$query = mysqli_query($mysqli, "SELECT a.id_barang,a.nama_barang,a.id_jenis,a.id_satuan,a.stok,b.id_jenis,b.nama_jenis,c.id_satuan,c.nama_satuan 
                                FROM is_barang as a INNER JOIN is_jenis_barang as b INNER JOIN is_satuan as c
                                ON a.id_jenis=b.id_jenis AND a.id_satuan=c.id_satuan ORDER BY id_barang DESC")
    or die('Ada kesalahan pada query tampil Data Barang: ' . mysqli_error($mysqli));
$count  = mysqli_num_rows($query);
?>
<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Laporan Stok Barang</title>
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
        LAPORAN STOK BARANG GUDANG ORICOW
    </div>

    <hr><br>

    <div id="isi">
        <table class="table table-bordered table-sm" width="100%" cellpadding="0" cellspacing="0">
            <thead style="background:#e8ecee">
                <tr class="tr-title">
                    <th height="20" align="center" valign="middle">No.</th>
                    <th height="20" align="center" valign="middle">ID Barang</th>
                    <th height="20" align="center" valign="middle">Nama Barang</th>
                    <th height="20" align="center" valign="middle">Jenis Barang</th>
                    <th height="20" align="center" valign="middle">Stok</th>
                    <th height="20" align="center" valign="middle">Satuan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // tampilkan data
                while ($data = mysqli_fetch_assoc($query)) {
                    // menampilkan isi tabel dari database ke tabel di aplikasi
                    echo "  <tr>
                        <td width='40' height='13' align='center' valign='middle'>$no</td>
                        <td width='80' height='13' align='center' valign='middle'>$data[id_barang]</td>
                        <td style='padding-left:5px;' width='215' height='13' valign='middle'>$data[nama_barang]</td>
                        <td style='padding-left:5px;' width='150' height='13' valign='middle'>$data[nama_jenis]</td>
                        <td style='padding-right:10px;' width='80' height='13' align='right' valign='middle'>$data[stok]</td>
                        <td style='padding-left:5px;' width='80' height='13' valign='middle'>$data[nama_satuan]</td>
                    </tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>

        <div id="footer-tanggal">
            Yogyakarta, <?php echo tgl_eng_to_ind("$hari_ini"); ?>
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
            if (typeof InstallTrigger !== "undefined") {
                window.close();
            }
            window.onafterprint = function() {
                window.close();
            }
        })
    </script>
</body>

</html><!-- Akhir halaman HTML yang akan di konvert -->
<?php
// $filename="LAPORAN STOK BARANG GUDANG MATERIAL.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
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