<?
$sub_menu = "700100";
include_once("./_common.php");

$sql = "select * from business_log_comment where idx = '$idx' ";
$row = sql_fetch($sql);
if (!$row['idx']) {
	$msg ="�ڵ� ���� ����� �Ѿ���� �ʾҽ��ϴ�.";
} else {
	sql_query("update business_log_comment set delete_yn='1' where idx = '$idx' ");
}
goto_url("./popup_business_log_memo.php?id=".$id."&memo_type=".$memo_type."&drafter_id=".$drafter_id);
?>
