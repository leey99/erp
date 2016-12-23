<?
$sub_menu = "100100";
include_once("./_common.php");
if($id) {
	$sql = " select com_code from com_list_gy where electric_charges_no='$id' and com_code!='$code' ";
	$result = sql_query($sql);
	$row = mysql_fetch_array($result);
	$com_code = $row['com_code'];
	//$total = mysql_num_rows($result);
	if($com_code) {
		echo "Y";
	} else {
		echo "N";
	}
} else {
	echo "N";
}
?>
