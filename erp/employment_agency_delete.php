<?
$sub_menu = "1900900";
include_once("./_common.php");

$sql = "select * from employment_agency where idx = '$idx' ";
$row = sql_fetch($sql);
if(!$row['idx']) {
	$msg ="�ڵ� ���� ����� �Ѿ���� �ʾҽ��ϴ�.";
} else {
	sql_query(" update employment_agency set delete_yn='1' where idx = '$idx' ");
}
goto_url("./employment_agency.php?page=".$page);
?>
