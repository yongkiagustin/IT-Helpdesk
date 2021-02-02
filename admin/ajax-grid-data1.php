<?php
/* Database connection start */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "isd";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

/* Database connection end */

// storing  request (ie, get/post) global array to a variable  
$requestData = $_REQUEST;


$columns = array(
	// datatable column index  => database column name
	0 => 'id_tiket',
	1 => 'tanggal',
	2 => 'asset_id',
	3 => 'nama',
	4 => 'email',
	5 => 'departemen',
	6 => 'problem',
	7 => 'status'
);

$condition = ' WHERE 1=1 ';
if (!empty($requestData['search_date'])) {
	$date = $requestData['search_date'];
	$condition .= " AND (tanggal LIKE '%$date%' OR tanggal_penanganan LIKE '%$date%') ";
}

// getting total number records without any search
$sql = "SELECT id_tiket, tanggal, asset_id as pc_no, user.fullname, departement.name as departement, problem, penanganan, admin.fullname as penanggung_jawab, tanggal_penanganan status FROM tiket JOIN user on (tiket.user_id = user.user_id) JOIN departement on (user.departement_id = departement.id) JOIN asset ON (tiket.pc_no = asset.id) JOIN user AS admin ON (admin.user_id = tiket.penanggung_jawab)";
$sql .= $condition;
$query = mysqli_query($conn, $sql) or die("ajax-grid-data.php: get Tiket");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if (!empty($requestData['search']['value'])) {
	// if there is a search parameter
	$sql = "SELECT id_tiket, tanggal, asset_id as pc_no, user.fullname, departement.name as departement, problem, penanganan, admin.fullname as penanggung_jawab, tanggal_penanganan, status FROM tiket JOIN user on (tiket.user_id = user.user_id) JOIN departement on (user.departement_id = departement.id) JOIN asset ON (tiket.pc_no = asset.id) JOIN user AS admin ON (admin.user_id = tiket.penanggung_jawab)";
	$sql .= $condition;
	$sql .= " OR id_tiket LIKE '" . $requestData['search']['value'] . "%' ";    // $requestData['search']['value'] contains search parameter
	$sql .= " OR tanggal LIKE '" . $requestData['search']['value'] . "%' ";
	$sql .= " OR asset_id LIKE '" . $requestData['search']['value'] . "%' ";
	$sql .= " OR fullname LIKE '" . $requestData['search']['value'] . "%' ";
	$sql .= " OR departement.name LIKE '" . $requestData['search']['value'] . "%' ";
	$sql .= " OR tanggal_penanganan LIKE '" . $requestData['search']['value'] . "%' ";
	$sql .= " OR problem LIKE '" . $requestData['search']['value'] . "%' ";
	$sql .= " OR status LIKE '" . $requestData['search']['value'] . "%' ";

	// echo $sql;
	$query = mysqli_query($conn, $sql) or die("ajax-grid-data.php: 1");
	$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 

	$sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
	$query = mysqli_query($conn, $sql) or die("ajax-grid-data.php: 2"); // again run query with limit

} else {

	$sql = "SELECT id_tiket, tanggal, asset_id as pc_no, user.fullname, departement.name as departement, problem, penanganan, admin.fullname as penanggung_jawab, tanggal_penanganan, status FROM tiket JOIN user on (tiket.user_id = user.user_id) JOIN departement on (user.departement_id = departement.id) JOIN asset ON (tiket.pc_no = asset.id) JOIN user AS admin ON (admin.user_id = tiket.penanggung_jawab)";
	$sql .= $condition;
	$sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "   LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
	$query = mysqli_query($conn, $sql) or die("ajax-grid-data.php: 3");
}

$data = array();
while ($row = mysqli_fetch_array($query)) {  // preparing an array
	$nestedData = array();

	$nestedData[] = $row["id_tiket"];
	$nestedData[] = $row["tanggal"];
	$nestedData[] = $row["pc_no"];
	$nestedData[] = $row["fullname"];
	$nestedData[] = $row["departement"];
	$nestedData[] = $row["problem"];
	$nestedData[] = $row["penanganan"];
	$nestedData[] = $row["penanggung_jawab"];
	$nestedData[] = $row["tanggal_penanganan"];
	$nestedData[] = $row["status"];
	$nestedData[] = '<td><center>
                     <a href="edit-tiket.php?id=' . $row['id_tiket'] . '" style="color:#eee;"  data-toggle="tooltip" title="Edit" class="btn-floating waves-effect waves-light light-blue darken-3"><i class="mdi-editor-mode-edit"></i> </a>
				     <a href="tiket.php?aksi=delete&id=' . $row['id_tiket'] . '"  data-toggle="tooltip" title="Delete" onclick="return confirm(\'Anda yakin akan menghapus data ' . $row['id_tiket'] . '?\')" class="btn-floating waves-effect waves-light red"><i class="mdi-action-delete"></i> </a>
	                 </center></td>';


	//$nestedData[] = number_format($total,0,",",".");		

	$data[] = $nestedData;
}



$json_data = array(
	"draw"            => intval($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
	"recordsTotal"    => intval($totalData),  // total number of records
	"recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
	"data"            => $data   // total data array
);

echo json_encode($json_data);  // send data as json format
