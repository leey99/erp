<?
$sub_menu = "1900300";
include_once("./_common.php");
$now_time = date("Y-m-d H:i:s");

$sql_common = " regdt = '$now_time',
						com_code = '$id',
						user_id = '$user_id',
						year = '$search_year',
						month = '$search_month',
						electric_before = '$electric_before',
						electric_after = '$electric_after',
						electric_before_contrast = '$electric_before_contrast',
						electric_same_month = '$electric_same_month',
						electric_same_month_contrast = '$electric_same_month_contrast'
";
$sql = " insert electric_manage set 
				$sql_common 
				";
sql_query($sql);
alert("정상적으로 등록 되었습니다.","iframe_electric_manage.php?id=".$id);
?>