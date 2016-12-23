<?
$sub_menu = "100300";
include_once("./_common.php");

$g4[com_paycode_list] = "com_paycode_list";
$chk_data_array = explode(",", $chk_data);
$check_cnt = sizeof($chk_data_array);
if($chk_data) {
	for( $i=0 ; $i < $check_cnt ; $i++) {
		$code_id_array = explode("_", $chk_data_array[$i]);
		$code = $code_id_array[0];
		$id = $code_id_array[1];
		//echo $id;
		//exit;
		$sql_where = " com_code = '$com_code' and code = '$id' and item = '$item' ";
		$sql = "select * from $g4[com_paycode_list] where $sql_where ";
		//echo count($idx);
		//echo $sql;
		//exit;
		$row = sql_fetch($sql);
		if (!$row[sabun]) {
			$msg ="사원코드 값이 제대로 넘어오지 않았습니다.";
		} else {
			sql_query("delete from $g4[com_paycode_list] where $sql_where ");
		}
	}
}
$sql_where = " com_code = '$com_code' and code = '$id' and item = '$item' ";
$sql = "select * from $g4[com_paycode_list] where $sql_where ";
//echo $sql;
//exit;
$row = sql_fetch($sql);
if (!$row[code]) {
	$msg ="사원코드 값이 제대로 넘어오지 않았습니다.";
} else {
	$sql = "delete from $g4[com_paycode_list] where $sql_where ";
	sql_query($sql);
	//echo $sql;
	//exit;
}
goto_url("./com_paycode_list.php?item=$item&page=$page");
?>
