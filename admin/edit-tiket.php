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
    <div id="loader-wrapper" style="z-index: 10000;">
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
                <h5 class="breadcrumbs-title">Data Tiket IT Helpdesk</h5>
                <ol class="breadcrumb">
                  <li><a href="index.php">Dashboard</a></li>
                  <li><a href="tiket.php">Tiket</a></li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->


        <!--start container-->
        <div class="container">
          <?php
          $kd = $_GET['id'];
          $sql = mysqli_query($koneksi, "SELECT tiket.*, user.fullname FROM tiket JOIN user on (tiket.user_id = user.user_id) WHERE id_tiket='$kd'");
          if (mysqli_num_rows($sql) == 0) {
            header("Location: tiket.php");
          } else {
            $row = mysqli_fetch_assoc($sql);
          }



          $get_asset = mysqli_query($koneksi, "SELECT name FROM asset WHERE asset_id = '" . $row['pc_no'] . "'");
          $asset = mysqli_fetch_assoc($get_asset)['name'];

          if (isset($_POST['update'])) {
            $id_tiket  = $_POST['id_tiket'];
            $penanggung_jawab = $_POST['penanggung_jawab'];
            $tanggal_penanganan = $_POST['tanggal_penanganan'] . " " . $_POST['waktu_penanganan'];
            $penanganan = $_POST['penanganan'];
            $status = $_POST['status'];

            $update = mysqli_query($koneksi, "UPDATE tiket SET tanggal_penanganan='$tanggal_penanganan', penanggung_jawab='$penanggung_jawab', penanganan='$penanganan', status='$status' WHERE id_tiket='$id_tiket'") or die(mysqli_error());
            if ($update) {
              echo '<script>sweetAlert({
	                                                   title: "Berhasil!", 
                                                        text: "Tiket Berhasil di update!' . $tanggal_penanganan . '", 
                                                        type: "success"
                                                        },function(){
                                                          window.location.replace("tiket.php");
                                                      });</script>';
            } else {
              echo '<script>sweetAlert({
	                                                   title: "Gagal!", 
                                                        text: "Tiket Gagal di update, silahakan coba lagi!", 
                                                        type: "error"
                                                        });</script>';
            }
          }


          ?>
          <div class="col s8 m8 l6">
            <div class="card-panel">
              <h4 class="header2">Edit Status Tiket Helpdesk</h4>
              <div class="row">
                <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" class="col s12">
                  <div class="row">
                    <div class="input-field col s12">
                      <!-- <i class="mdi-action-assignment-ind prefix"></i> -->
                      <input id="id_tiket" name="id_tiket" value="<?php echo $row['id_tiket']; ?>" type="text" readonly="readonly">
                      <label for="Id Tiket">Id Tiket</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <!-- <i class="mdi-action-alarm-on prefix"></i> -->
                      <input id="tanggal" name="tanggal" value="<?php echo $row['tanggal']; ?>" type="text" readonly="readonly">
                      <label for="Tanggal">Tanggal</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <!-- <i class="mdi-action-label-outline prefix"></i> -->
                      <input id="pc_no" name="pc_no" value="<?php echo $row['pc_no'] . " / " . $asset; ?>" type="text" readonly="readonly">
                      <label for="PC No">No Asset Perangkat</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <!-- <i class="mdi-action-account-circle prefix"></i> -->
                      <input id="nama" name="nama" value="<?php echo $row['fullname']; ?>" type="text" readonly="readonly">
                      <label for="Nama">Nama</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s8">
                      <!-- <i class="mdi-action-lock-outline prefix"></i> -->
                      <input id="departemen" name="departemen" value="<?php echo $row['departemen']; ?>" type="text" readonly="readonly">
                      <label for="Departemen">Departemen</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <!-- <i class="mdi-action-subject prefix"></i> -->
                      <textarea id="problem" name="problem" class="materialize-textarea validate" length="120" readonly="readonly"><?php echo $row['problem']; ?></textarea>
                      <label for="Problem">Problem</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <label for="tanggal_penanganan">Penanggung Jawab</label>
                      <div>
                        <select name="penanggung_jawab" class="select2 form-control">
                          <?php
                          $admin = mysqli_query($koneksi, "SELECT user_id, fullname FROM user WHERE level = 'Admin'");
                          foreach (mysqli_fetch_all($admin) as $admin) {
                            echo "<option value='" . $admin[0] . "'>" . $admin['1'] . "</option>";
                          }
                          ?>
                        </select>
                        <label for="penanggung_jawab" class="active">Penanggung Jawab</label>
                      </div>
                    </div>
                  </div>
                  <div class="row" style="margin-top: 8px;">
                    <div class="input-field col s12">
                      <input id="tanggal_penanganan" name="tanggal_penanganan" class="datepicker" type="text">
                      <label for="tanggal_penanganan">Tanggal Penanganan</label>
                    </div>
                  </div>
                  <div class="row" style="margin-top: 8px;">
                    <div class="input-field col s12">
                      <input id="waktu_penanganan" name="waktu_penanganan" class="timepicker" type="text">
                      <label for="waktu_penanganan">Waktu Penanganan</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <!-- <i class="mdi-action-question-answer prefix"></i> -->
                      <textarea id="penanganan" name="penanganan" class="materialize-textarea validate" length="120"></textarea>
                      <label for="Penanganan">Penanganan</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <select name="status" class="select2 form-control" id="status" required>
                        <option value=""> <?php echo $row['status']; ?></option>
                        <option value="open">Open</option>
                        <option value="close">Close</option>
                        <option value="cancel">Cancel</option>
                      </select>
                      <label for="status" class="active">Status</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <button class="btn cyan waves-effect waves-light right" type="submit" name="update" id="update">Submit
                        <i class="mdi-content-send right"></i>
                      </button>
                    </div>
                  </div>
              </div>
              </form>
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
    <script type="text/javascript" src="js/materialize.min.js"></script>
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
    <script type="text/javascript" src="js/plugins/timepicker/js/timepicker.min.js"></script>

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

      $(".timepicker").timepicker();
      $(".datepicker").pickadate({
        format: "yyyy-mm-dd"
      });
    </script>

  </body>

  </html>