<?
$sub_menu = "100400";
include_once("./_common.php");

$g4[com_paycode_list] = "com_paycode_list";
$chk_data_array = explode(",", $chk_data);
$check_cnt = sizeof($chk_data_array);
if($chk_data) {
	for( $i=0 ; $i < $check_cnt ; $i++) {
		$code_id_array = explode("_", $chk_data_array[$i]);
		$code = $code_id_array[0];
		$auto = $code_id_array[1];
		$sql_where = " com_code = '$com_code' and code = '$code' and item = '$item' ";
		$sql = "select * from $g4[com_paycode_list] where $sql_where ";
		$result = sql_query($sql);
		$row=mysql_fetch_array($result);
		if($row[name]) {
			$sql_common = " auto = '$auto' ";
			$sql = " update $g4[com_paycode_list] set 
						$sql_common 
						where $sql_where ";
			//echo $sql."<br>";
			//exit;
			sql_query($sql);
		}
	}
}
goto_url("./com_paycode_list.php?item=$item&page=$page");
?>
