<?
$sub_menu = "100102";
include_once("./_common.php");
if(!$id) exit;
//echo $id;
$now_time = date("Y-m-d H:i:s");

$sql_common = " check_ok = '$check_ok' ";
$sql = " update shipbuilding_gy_opt set 
			$sql_common 
			where com_code = '$id' ";
//echo $sql;
sql_query($sql);
alert("���������� Ȯ��üũ �Ǿ����ϴ�.","check_ok_update.php");
?>
