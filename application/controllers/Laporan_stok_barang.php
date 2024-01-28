<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once "AuthController.php";

class Laporan_stok_barang extends AuthController
{

    function cetak()
    {
        // session_start();

        //include "application/views/cetak.php";
        //var_dump($view);exit;        
        $this->load->view('cetak');
    }

    function masuk()
    {
        $this->load->view('cetak_masuk');
    }

    function keluar()
    {
        $this->load->view('cetak_keluar');
    }


    public function cetak_pdf()
    {

        //Load the library
        $this->load->library('html2pdf');

        //Set folder to save PDF to
        $this->html2pdf->folder('./assets/plugins/pdfs/');

        //Set the filename to save/download as
        $this->html2pdf->filename('LAPORAN_STOK_BARANG_GUDANG_MATERIAL.pdf.pdf');

        //Set the paper defaults
        $this->html2pdf->paper('a4', 'portrait');

        $data = array(
            'title' => 'PDF Created',
            'message' => 'Hello World!'
        );

        //Load html view
        $this->html2pdf->html($this->load->view('cetak', $data, true));

        if ($this->html2pdf->create('save')) {
            //PDF was successfully saved or downloaded
            echo 'PDF saved';
        }
    }

    function createPDF($html, $filename = '', $download = TRUE, $paper = 'A4', $orientation = 'portrait')
    {
        $dompdf = new Dompdf\DOMPDF();
        $dompdf->load_html($html);
        $dompdf->set_paper($paper, $orientation);
        $dompdf->render();
        if ($download)
            $dompdf->stream($filename . '.pdf', array('Attachment' => 1));
        else
            $dompdf->stream($filename . '.pdf', array('Attachment' => 0));
    }

    function generate()
    {
        $this->load->library('pdf');
        $html = $this->load->view('cetak', [], true);
        $this->pdf->createPDF($html, 'mypdf', false);
    }
}
