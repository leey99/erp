<?
$sub_menu = "100101";
include_once("./_common.php");

$sql = "select * from total_pay_comment where idx = '$idx' ";
$row = sql_fetch($sql);
if (!$row['idx']) {
	$msg ="�ڵ� ���� ����� �Ѿ���� �ʾҽ��ϴ�.";
} else {
	sql_query("update total_pay_comment set delete_yn='1' where idx = '$idx' ");
}
goto_url("./popup_memo.php?id=$id&t_no=$t_no");
?>
