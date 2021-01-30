<?php
session_start();
if (empty($_SESSION['username'])) {
  header('location:../index.php');
} else {
  include "../conn.php";
?>
  <!DOCTYPE html>
  <html lang="en">

  <!--================================================================================
	Item Name: Materialize - Material Design Admin Template
	Version: 1.0
	Author: GeeksLabs
	Author URL: http://www.themeforest.net/user/geekslabs
================================================================================ -->

  <?php include "head.php"; ?>

  <body>
    <!-- Start Page Loading -->
    <div id="loader-wrapper">
      <div id="loader"></div>
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
    </div>
    <!-- End Page Loading -->

    <!-- //////////////////////////////////////////////////////////////////////////// -->

    <!-- START HEADER -->
    <?php include "header.php"; ?>
    <!-- END HEADER -->

    <!-- //////////////////////////////////////////////////////////////////////////// -->

    <!-- START MAIN -->
    <div id="main">
      <!-- START WRAPPER -->
      <div class="wrapper">

        <!-- START LEFT SIDEBAR NAV-->
        <?php include "menu.php"; ?>
        <?php
        $timeout = 10; // Set timeout minutes
        $logout_redirect_url = "../index.php"; // Set logout URL

        $timeout = $timeout * 60; // Converts minutes to seconds
        if (isset($_SESSION['start_time'])) {
          $elapsed_time = time() - $_SESSION['start_time'];
          if ($elapsed_time >= $timeout) {
            session_destroy();
            echo "<script>alert('Session Anda Telah Habis!'); window.location = '$logout_redirect_url'</script>";
          }
        }
        $_SESSION['start_time'] = time();
        ?>
      <?php } ?>
      <!-- END LEFT SIDEBAR NAV-->

      <!-- //////////////////////////////////////////////////////////////////////////// -->

      <!-- START CONTENT -->
      <section id="content">

        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper" class=" grey lighten-3">
          <div class="container">
            <div class="row">
              <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title">Data Aset IT Helpdesk</h5>
                <ol class="breadcrumb">
                  <li><a href="index.php">Dashboard</a></li>
                  <li><a href="asset.php">Aset</a></li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->


        <!--start container-->
        <div class="container">
          <?php
          if (isset($_POST['input'])) {
            $asset_id  = $_POST['asset_id'];
            $name = $_POST['name'];

            $update = mysqli_query($koneksi, "INSERT INTO asset (asset_id, name) VALUES('$asset_id', '$name')") or die(mysqli_error());
            if ($update) {
              echo '<script>sweetAlert({
	                                                   title: "Berhasil!", 
                                                        text: "Aset Berhasil di simpan!", 
                                                        type: "success"
                                                        },function(){
                                                          window.location.replace("asset.php");
                                                      });</script>';
            } else {
              echo '<script>sweetAlert({
	                                                   title: "Gagal!", 
                                                        text: "Aset Gagal di simpan, silahakan coba lagi!", 
                                                        type: "error"
                                                        });</script>';
            }
          }


          ?>
          <div class="col s8 m8 l6">
            <div class="card-panel">
              <h4 class="header2">Input Aset</h4>
              <div class="row">
                <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" class="col s12">
                  <div class="row">
                    <div class="input-field col s12">
                      <!-- <i class="mdi-action-assignment-ind prefix"></i> -->
                      <input id="id_tiket" name="asset_id" type="text">
                      <label for="Id Tiket">Id Aset</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <!-- <i class="mdi-action-alarm-on prefix"></i> -->
                      <input id="tanggal" name="name" type="text">
                      <label for="Tanggal">Nama</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <button class="btn cyan waves-effect waves-light right" type="submit" name="input" id="update">Submit
                        <i class="mdi-content-send right"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
    <!--end container-->

    </section>
    <!-- END CONTENT -->
    </div>
    <!-- END WRAPPER -->

    </div>
    <!-- END MAIN -->



    <!-- //////////////////////////////////////////////////////////////////////////// -->

    <!-- START FOOTER -->
    <?php include "footer.php"; ?>
    <!-- END FOOTER -->



    <!-- ================================================
    Scripts
    ================================================ -->
    <!-- jQuery Library -->
    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
    <!--materialize js-->
    <script type="text/javascript" src="js/materialize.js"></script>
    <!--prism-->
    <script type="text/javascript" src="js/prism.js"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <!-- select2 -->
    <script type="text/javascript" src="js/plugins/select2/select2.full.min.js"></script>
    <!-- data-tables -->
    <script type="text/javascript" src="js/plugins/data-tables/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/plugins/data-tables/data-tables-script.js"></script>
    <!-- chartist -->
    <script type="text/javascript" src="js/plugins/chartist-js/chartist.min.js"></script>

    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="js/plugins.js"></script>

    <script>
      $(document).ready(function() {
        var dataTable = $('#lookup').DataTable({
          "processing": true,
          "serverSide": true,
          "ajax": {
            url: "ajax-grid-data1.php", // json datasource
            type: "post", // method  , by default get
            error: function() { // error handling
              $(".lookup-error").html("");
              $("#lookup").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
              $("#lookup_processing").css("display", "none");

            }
          }
        });

      });

      $(".select2").select2({
        width: "100%"
      });

      var picker = $(".datepicker").pickadate({
        format: "yyyy-mm-dd"
      });
    </script>

  </body>

  </html>