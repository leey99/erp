<?
$sub_menu = "1900300";
include_once("./_common.php");

$sql = "select * from erp_application where idx = '$idx' ";
//echo $sql;
//exit;
$row = sql_fetch($sql);
if(!$row['idx']) {
	$msg ="�ڵ� ���� ����� �Ѿ���� �ʾҽ��ϴ�.";
} else {
	sql_query("delete from erp_application where idx = '$idx' ");
}
goto_url("./iframe_electric_collection.php?id=".$id);
?>
