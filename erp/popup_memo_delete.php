<?
$sub_menu = "100101";
include_once("./_common.php");

$sql = "select * from com_list_gy_comment where idx = '$idx' ";
$row = sql_fetch($sql);
if (!$row['idx']) {
	$msg ="�ڵ� ���� ����� �Ѿ���� �ʾҽ��ϴ�.";
} else {
	sql_query("update com_list_gy_comment set delete_yn='1' where idx = '$idx' ");
}
//����
if($dealer == "ok") goto_url("./popup_memo_dealer.php?id=".$id."&memo_type=".$memo_type);
//�������
else if($dealer == "contractor") goto_url("./popup_memo_contractor.php?id=".$id."&memo_type=".$memo_type);
else goto_url("./popup_memo.php?id=".$id."&memo_type=".$memo_type);
?>
