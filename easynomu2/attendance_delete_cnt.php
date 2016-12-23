<?
$sub_menu = "100200";
include_once("./_common.php");

$chk_data_array = explode(",", $chk_data);
$check_cnt = sizeof($chk_data_array);
if($check_cnt) {
	for( $i=0 ; $i < $check_cnt ; $i++) {
		$id = $chk_data_array[$i];
		//echo $id;
		//exit;
		$sql_where = " id = '$id' ";
		$sql = "select * from a4_attendance where $sql_where ";
		//echo count($idx);
		//echo $sql;
		//exit;
		$row = sql_fetch($sql);
		if (!$row[sabun]) {
			$msg ="코드 값이 제대로 넘어오지 않았습니다.";
		} else {
			sql_query("delete from a4_attendance where $sql_where ");
		}
	}
}
goto_url("./attendance.php?toYear=$toYear&toMonth=$toMonth");
?>
