<?
$sub_menu = "400101";
include_once("./_common.php");

$sql = "select * from samu_4insure where idx = '$idx' ";
$row = sql_fetch($sql);
if(!$row['idx']) {
	$msg ="�ڵ� ���� ����� �Ѿ���� �ʾҽ��ϴ�.";
} else {
	sql_query("update samu_4insure set delete_yn='1' where idx = '$idx' ");
}
goto_url("./popup_4insure.php?id=$id&amp;stx_report_kind=$stx_report_kind");
?>
