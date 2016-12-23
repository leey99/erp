<?
$sub_menu = "100101";
include_once("./_common.php");

$sql = "select * from com_list_gy_comment where idx = '$idx' ";
$row = sql_fetch($sql);
if (!$row['idx']) {
	$msg ="코드 값이 제대로 넘어오지 않았습니다.";
} else {
	sql_query("update com_list_gy_comment set delete_yn='1' where idx = '$idx' ");
}
//딜러
if($dealer == "ok") goto_url("./popup_memo_dealer.php?id=".$id."&memo_type=".$memo_type);
//전기공사
else if($dealer == "contractor") goto_url("./popup_memo_contractor.php?id=".$id."&memo_type=".$memo_type);
else goto_url("./popup_memo.php?id=".$id."&memo_type=".$memo_type);
?>
