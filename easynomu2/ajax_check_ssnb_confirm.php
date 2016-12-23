<?
$sub_menu = "30100";
include_once("./_common.php");
//$sql = " select * from pibohum_base where jumin_no='$id' ";
if($sabun) $where_sabun = " and sabun!='$sabun' ";
else $where_sabun = "";
$sql = " select * from pibohum_base where jumin_no='$id' and (com_code='$code' $where_sabun) ";
$result = sql_query($sql);
$total = mysql_num_rows($result);
if($total) {
	echo "Y";
} else {
	echo "N";
}
?>
