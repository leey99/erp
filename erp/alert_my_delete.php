<?
$sub_menu = "100100";
include_once("./_common.php");

//check_demo();
//auth_check($auth[$sub_menu], "d");

$chk_data_array = explode(",", $chk_data);
$check_cnt = sizeof($chk_data_array);
for( $i=0 ; $i < $check_cnt ; $i++) {
	$id = $chk_data_array[$i];
	$sql = "select * from erp_alert where idx = '$id' ";
	//echo count($idx);
	//echo $sql;
	//exit;
	$row = sql_fetch($sql);
	//com_code ������ ���� ��� ����, idx �����ͷ� ��ü
	if(!$row['idx']) {
		$msg ="�˶��ڵ� ���� ����� �Ѿ���� �ʾҽ��ϴ�.";
	} else {
		//sql_query("delete from erp_alert where idx = '$id' ");
		$del_main = $member['mb_id'].",".$row['del_main'];
		$sql_del = " update erp_alert set del_main='$del_main' where idx = '$id' ";
		//echo $sql_del;
		//exit;
		sql_query($sql_del);
	}
}
goto_url("./alert_my.php?page=".$page);
?>
