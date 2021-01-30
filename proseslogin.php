<?php
include("conn.php");
date_default_timezone_set('Asia/Jakarta');

session_start();

$username = $_POST['username'];
$password = $_POST['password'];

//$username = mysqli_real_escape_string($username);
//$password = mysqli_real_escape_string($password);

if (empty($username) && empty($password)) {

	header('location:index.php?error1');
} else if (empty($username)) {
	header('location:index.php?error=2');
} else if (empty($password)) {
	header('location:index.php?error=3');
}

$q = mysqli_query($koneksi, "SELECT user.user_id, user.fullname, user.level, user.gambar, departement.name as departement, departement.id as departement_id FROM user LEFT JOIN departement ON (user.departement_id = departement.id) WHERE username='$username' AND password='$password'");
$row = mysqli_fetch_array($q);

if (mysqli_num_rows($q) == 1) {
	$_SESSION['user_id'] = $row['user_id'];
	$_SESSION['username'] = $username;
	$_SESSION['fullname'] = $row['fullname'];
	$_SESSION['level'] = $row['level'];
	$_SESSION['gambar'] = $row['gambar'];
	$_SESSION['departement'] = $row['departement'];
	$_SESSION['departement_id'] = $row['departement_id'];
	if ($row['level'] == "Admin") {
		header('location:admin/index.php');
	} else {
		header('location:user/index.php');
	}
} else {
	header('location:index.php?error=4');
}
