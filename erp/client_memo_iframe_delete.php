<?
$sub_menu = "100401";
include_once("./_common.php");

$sql = "select * from com_list_gy_memo where idx = '$idx' ";
$row = sql_fetch($sql);
if (!$row['idx']) {
	$msg ="�ڵ� ���� ����� �Ѿ���� �ʾҽ��ϴ�.";
} else {
	sql_query("update com_list_gy_memo set delete_yn='1' where idx = '$idx' ");
}
goto_url("./client_memo_iframe.php?id=$id");
?>
