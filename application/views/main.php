<?php
//session_start();
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Aplikasi Gudang Oricow</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="description" content="Aplikasi Aplikasi Persediaan Barang dengan PHP7 dan MySQLi">
  <meta name="author" content="Indra Styawantoro" />

  <!-- favicon -->
  <link rel="shortcut icon" href="<?php echo base_url() ?>assets/img/favicon.png" />

  <!-- Bootstrap 3.3.2 -->
  <link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <!-- FontAwesome 4.3.0 -->
  <link href="<?php echo base_url() ?>assets/plugins/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <!-- DATA TABLES -->
  <link href="<?php echo base_url() ?>assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
  <!-- Datepicker -->
  <link href="<?php echo base_url() ?>assets/plugins/datepicker/datepicker.min.css" rel="stylesheet" type="text/css" />
  <!-- Chosen Select -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/plugins/chosen/css/chosen.min.css" />
  <!-- Theme style -->
  <link href="<?php echo base_url() ?>assets/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
  <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
  <link href="<?php echo base_url() ?>assets/css/skins/skin-blue.min.css" rel="stylesheet" type="text/css" />
  <!-- Date Picker -->
  <link href="<?php echo base_url() ?>assets/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
  <!-- Custom CSS -->
  <link href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet" type="text/css" />

  <!-- Fungsi untuk membatasi karakter yang diinputkan -->
  <script type="text/javascript" src="https://code.jquery.com/jquery-1.8.2.js"></script>
  <style type="text/css">
    #overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: #000;
      filter: alpha(opacity=70);
      -moz-opacity: 0.7;
      -khtml-opacity: 0.7;
      opacity: 0.7;
      z-index: 100;
      display: none;
    }

    .cnt223 a {
      text-decoration: none;
    }

    .popup {
      width: 100%;
      margin: 0 auto;
      display: none;
      position: fixed;
      z-index: 101;
    }

    .cnt223 {
      max-width: 500px;
      min-height: 150px;
      margin: 100px auto;
      background: #f3f3f3;
      position: relative;
      z-index: 103;
      padding: 15px 20px;
      border-radius: 5px;
      box-shadow: 0 2px 5px #000;
    }

    .cnt223 p {
      clear: both;
      color: #555555;
      /* text-align: justify; */
      font-size: 16px;
      font-family: sans-serif;
    }

    .cnt223 p a {
      color: #d91900;
      font-weight: bold;
    }

    .cnt223 .x {
      float: right;
      height: 35px;
      left: 22px;
      position: relative;
      top: -25px;
      width: 34px;
    }

    .cnt223 .x:hover {
      cursor: pointer;
    }
  </style>
  <script type='text/javascript'>
    let showWarningStock = false;
    $(document).ready(function() {
      if (showWarningStock) {
        var overlay = $('<div id="overlay"></div>');
        overlay.show();
        overlay.appendTo(document.body);
        $('.popup').show();
        $('.closed').click(function() {
          $('.popup').hide();
          overlay.appendTo(document.body).remove();
          return false;
        });

        $('.x').click(function() {
          $('.popup').hide();
          overlay.appendTo(document.body).remove();
          return false;
        });
      }
    });
  </script>
  <div class='popup'>
    <div class='cnt223'>
      <h1>Warning Stok</h1>
      <p> Segera Melakukan Pembelian Barang di Bawah ini :</p>
      <?php $no = 1;
      foreach (stok_barang() as $v) : ?>
        <?php if ($v['stok'] <= $v['safety_stok']) : ?>
          <?php echo $no++ . ' - ' . '<b>' . $v['nama_barang'] . ' ' . '</b> Sisa Barang :' . $v['stok'] . ' ' . $v['nama_satuan']; ?> <br>
        <?php endif; ?>
      <?php endforeach ?>
      <?php if ($no > 1 && isset($_GET['module'])) : ?>
        <?php if ($_GET['module'] == 'home' || $_GET['module'] == 'barang' || $_GET['module'] == 'barang_masuk' || $_GET['module'] == 'barang_keluar') : ?>
          <script>
            showWarningStock = true;
          </script>
        <?php endif ?>
      <?php endif ?>
      <br>
      <a class="closed btn btn-danger btn-sm" href="<?php echo base_url() ?>">Oke Mengerti</a>
    </div>
  </div>
  <script language="javascript">
    function getkey(e) {
      if (window.event)
        return window.event.keyCode;
      else if (e)
        return e.which;
      else
        return null;
    }

    function goodchars(e, goods, field) {
      var key, keychar;
      key = getkey(e);
      if (key == null) return true;

      keychar = String.fromCharCode(key);
      keychar = keychar.toLowerCase();
      goods = goods.toLowerCase();

      // check goodkeys
      if (goods.indexOf(keychar) != -1)
        return true;
      // control keys
      if (key == null || key == 0 || key == 8 || key == 9 || key == 27)
        return true;

      if (key == 13) {
        var i;
        for (i = 0; i < field.form.elements.length; i++)
          if (field == field.form.elements[i])
            break;
        i = (i + 1) % field.form.elements.length;
        field.form.elements[i].focus();
        return false;
      };
      // else return false
      return false;
    }
  </script>
  <link rel="icon" type="image/x-icon" href="<?= base_url('assets/images/sys/logo-transparent.png') ?>">

</head>

<body class="skin-blue fixed">
  <div class="wrapper">

    <header class="main-header ">
      <!-- Logo -->
      <a href="?module=home" class="logo" style="background-color: #98191c !important">
        <img src="<?= base_url('assets/images/sys/logo.jpg') ?>" alt="" style="height: 30px; border-radius: 5px;">
        Gudang Oricow
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top" role="navigation" style="background-color: #D04848 !important">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

            <!-- panggil file "top-menu.php" untuk menampilkan menu -->
            <?php include "top-menu.php" ?>

          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->

        <!-- panggil file "sidebar-menu.php" untuk menampilkan menu -->
        <?php include "sidebar-menu.php" ?>

      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <!-- panggil file "content-menu.php" untuk menampilkan content -->
      <?php include "content.php" ?>

      <!-- Modal Logout -->
      <div class="modal fade" id="logout">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><i class="fa fa-sign-out"> Logout</i></h4>
            </div>
            <div class="modal-body">
              <p>Apakah Anda yakin ingin logout? </p>
            </div>
            <div class="modal-footer">
              <a type="button" class="btn btn-danger" href="<?php echo base_url('home/logout') ?>">Ya, Logout</a>
              <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->

    </div><!-- /.content-wrapper -->

    <footer class="main-footer text-center">
      <strong>Copyright &copy; <?php echo date('Y') ?> - <a href="#" style="color: #98191c !important">Aplikasi Gudang Oricow</a>.</strong>
    </footer>
  </div><!-- ./wrapper -->

  <!-- jQuery 2.1.3 -->
  <script src="<?php echo base_url() ?>assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
  <!-- Bootstrap 3.3.2 JS -->
  <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
  <!-- datepicker -->
  <script src="<?php echo base_url() ?>assets/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
  <!-- chosen select -->
  <script src="<?php echo base_url() ?>assets/plugins/chosen/js/chosen.jquery.min.js"></script>
  <!-- DATA TABES SCRIPT -->
  <script src="<?php echo base_url() ?>assets/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
  <script src="<?php echo base_url() ?>assets/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
  <!-- Datepicker -->
  <script src="<?php echo base_url() ?>assets/plugins/datepicker/bootstrap-datepicker.min.js" type="text/javascript"></script>
  <!-- Slimscroll -->
  <script src="<?php echo base_url() ?>assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
  <!-- FastClick -->
  <script src='<?php echo base_url() ?>assets/plugins/fastclick/fastclick.min.js'></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url() ?>assets/js/app.min.js" type="text/javascript"></script>

  <!-- page script -->
  <script type="text/javascript">
    $(function() {
      // datepicker plugin
      $('.date-picker').datepicker({
        autoclose: true,
        todayHighlight: true
      });

      // chosen select
      $('.chosen-select').chosen({
        allow_single_deselect: true
      });
      //resize the chosen on window resize

      $(window)
        .off('resize.chosen')
        .on('resize.chosen', function() {
          $('.chosen-select').each(function() {
            var $this = $(this);
            $this.next().css({
              'width': $this.parent().width()
            });
          })
        }).trigger('resize.chosen');
      //resize chosen on sidebar collapse/expand
      $(document).on('settings.ace.chosen', function(e, event_name, event_val) {
        if (event_name != 'sidebar_collapsed') return;
        $('.chosen-select').each(function() {
          var $this = $(this);
          $this.next().css({
            'width': $this.parent().width()
          });
        })
      });


      $('#chosen-multiple-style .btn').on('click', function(e) {
        var target = $(this).find('input[type=radio]');
        var which = parseInt(target.val());
        if (which == 2) $('#form-field-select-4').addClass('tag-input-style');
        else $('#form-field-select-4').removeClass('tag-input-style');
      });

      // DataTables
      $("#dataTables1").dataTable();
      $('#dataTables2').dataTable({
        "bPaginate": true,
        "bLengthChange": false,
        "bFilter": false,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": false
      });
    });
  </script>

</body>

</html>