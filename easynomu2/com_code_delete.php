<?
$sub_menu = "100200";
include_once("./_common.php");

$g4[com_code_list] = "com_code_list";
//echo $chk_data;
//exit;
$chk_data_array = explode(",", $chk_data);
$check_cnt = sizeof($chk_data_array);
if($check_cnt) {
	for( $i=0 ; $i < $check_cnt ; $i++) {
		$code_id_array = explode("_", $chk_data_array[$i]);
		$com_code = $code_id_array[0];
		$id = $code_id_array[1];
		//echo $id;
		//exit;
		$sql_where = " com_code = '$com_code' and code = '$id' and item = '$item' ";
		$sql = "select * from $g4[com_code_list] where $sql_where ";
		//echo count($idx);
		//echo $sql;
		//exit;
		$row = sql_fetch($sql);
		if (!$row[code]) {
			$msg ="코드 값이 제대로 넘어오지 않았습니다.";
		} else {
			$sql_del = "delete from $g4[com_code_list] where $sql_where ";
			//echo $sql_del."<br>";
			sql_query($sql_del);
		}
	}
}
//exit;
$sql_where = " com_code = '$com_code' and code = '$id' and item = '$item' ";
$sql = "select * from $g4[com_code_list] where $sql_where ";
//echo $sql;
//exit;
$row = sql_fetch($sql);
if (!$row[code]) {
	$msg ="사원코드 값이 제대로 넘어오지 않았습니다.";
} else {
	$sql = "delete from $g4[com_code_list] where $sql_where ";
	sql_query($sql);
	//echo $sql;
	//exit;
}
goto_url("./com_code_list.php?item=$item&page=$page");
?>
