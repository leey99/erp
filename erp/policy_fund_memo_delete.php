<?
$sub_menu = "1500101";
include_once("./_common.php");

$sql = "select * from policy_fund_comment where idx = '$idx' ";
$row = sql_fetch($sql);
if (!$row['idx']) {
	$msg ="코드 값이 제대로 넘어오지 않았습니다.";
} else {
	sql_query("update policy_fund_comment set delete_yn='1' where idx = '$idx' ");
}
goto_url("./policy_fund_memo.php?id=$id");
?>
