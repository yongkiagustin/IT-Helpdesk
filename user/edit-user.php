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
    <!-- <div id="loader-wrapper">
      <div id="loader"></div>
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
    </div> -->
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
                <h5 class="breadcrumbs-title">Update Profile</h5>
                <ol class="breadcrumb">
                  <li><a href="index.php">Dashboard</a></li>
                  <li><a href="detail-user.php">Profile</a></li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->


        <!--start container-->
        <div class="container">
          <?php
          $sql = mysqli_query($koneksi, "SELECT * FROM user WHERE user_id='" . $_SESSION['user_id'] . "'");
          if (mysqli_num_rows($sql) == 0) {
            header("Location: admin.php");
          } else {
            $row = mysqli_fetch_assoc($sql);
          }
          if (isset($_POST['update'])) {

            $gambar = '';
            if (!empty($_FILES["gambar"]["tmp_name"])) {
              $namafolder = "../foto/"; //tempat menyimpan file
              $jenis_gambar = $_FILES['gambar']['type'];
              if ($jenis_gambar == "image/jpeg" || $jenis_gambar == "image/jpg" || $jenis_gambar == "image/gif" || $jenis_gambar == "image/x-png") {
                $gambar = $namafolder . basename($_FILES['gambar']['name']);
                move_uploaded_file($_FILES['gambar']['tmp_name'], $gambar);
              }
            }

            $username = $_POST['username'];
            $password = $_POST['password'];
            $fullname = $_POST['fullname'];
            $no_hp = $_POST['no_hp'];
            $update = mysqli_query($koneksi, "UPDATE user SET username='$username', password='$password', fullname='$fullname', no_hp='$no_hp', gambar='$gambar' WHERE user_id='" . $_SESSION['user_id'] . "'") or die("");
            if ($update) {
              $q = mysqli_query($koneksi, "SELECT user.user_id, user.fullname, user.username, user.level, user.gambar, departement.name as departement, departement.id as departement_id FROM user LEFT JOIN departement ON (user.departement_id = departement.id) WHERE user_id='" . $_SESSION['user_id'] . "'");
              $login = mysqli_fetch_array($q);
              $_SESSION['user_id'] = $login['user_id'];
              $_SESSION['username'] = $login['username'];
              $_SESSION['fullname'] = $login['fullname'];
              $_SESSION['level'] = $login['level'];
              $_SESSION['gambar'] = $login['gambar'];
              $_SESSION['departement'] = $login['departement'];
              $_SESSION['departement_id'] = $login['departement_id'];
              echo '<script>sweetAlert({
	                                                   title: "Berhasil!", 
                                                        text: "Data Berhasil di update!", 
                                                        type: "success"
                                                        },function(){
                                                            window.location.replace("detail-user.php");
                                                        });</script>';
            } else {
              echo '<script>sweetAlert({
	                                                   title: "Gagal!", 
                                                        text: "Data Gagal di update, silahakan coba lagi!", 
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
                      <input id="username" name="username" type="text" value="<?php echo $row['username'] ?>" autocomplete="off" required="required">
                      <label for="Username">Username</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <input id="password" name="password" type="text" value="<?php echo $row['password'] ?>" autocomplete="off" required="required">
                      <label for="Password">Password</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <input id="fullname" name="fullname" type="text" value="<?php echo $row['fullname'] ?>" autocomplete="off" required="required">
                      <label for="Nama">Nama</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <input id="no_hp" name="no_hp" type="text" value="<?php echo $row['no_hp'] ?>" autocomplete="off" required="required">
                      <label for="No Hp">No HP</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <img src="<?php echo $row['gambar']; ?>" alt="" width="175" style="border: 3px solid #666; border-radius: 5px;" />
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <input type="file" name="gambar">
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-field col s12">
                      <button class="btn cyan waves-effect waves-light right" type="submit" name="update" id="update">Submit</button>
                      <a href="user-detail.php" style="margin-right=20px" class="btn orange waves-effect waves-light right" type="submit" name="input" id="update">Kembali
                      </a>
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
    !-- jQuery Library -->
    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
    <!--materialize js-->
    <script type="text/javascript" src="js/materialize.js"></script>
    <!--prism-->
    <script type="text/javascript" src="js/prism.js"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
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
    </script>

  </body>

  </html>