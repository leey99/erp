<?
$mode = "popup";
$member['mb_id'] = "test";
include_once("./_common.php");
if($id) {
	//통합관리프로그램 DB
	include_once("../../dbconfig_erp.php");
	//echo $mysql_db;
	$db2 = mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db);
	//print_r($db2);
	mysqli_query($db2, " set names euckr ");
	$sql_a4 = " select com_code from com_list_gy where biz_no='$id' ";
	$result_a4 = mysqli_query($db2, $sql_a4);
	$row_a4 = mysqli_fetch_assoc($result_a4);
	$com_code = $row_a4['com_code'];
	if($com_code) {
		echo "Y";
	} else {
		echo "N";
	}
} else {
	echo "not";
}
?>
