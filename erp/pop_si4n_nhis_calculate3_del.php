<?
$sub_menu = "400100";
include_once("./_common.php");

$now_time = date("Y-m-d H:i:s");

//현재 날짜 시간
$now_date = date("Y-m-d");
$now_time = date("H:i:s");

//기존 데이터 삭제 후 삽입
$sql_opt_del = " delete from si4n_nhis_pay_time where com_code='$code' ";
//echo $sql_opt_del;
//exit;
sql_query($sql_opt_del);
$pay_list_url = "pop_si4n_nhis_calculate3.php";
alert("정상적으로 삭제 되었습니다.","$pay_list_url?id=$code&cnt=$total_count");
?>