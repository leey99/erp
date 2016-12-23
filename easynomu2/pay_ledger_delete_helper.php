<?
$sub_menu = "400200";
include_once("./_common.php");

$chk_data_array = explode(",", $chk_data);
$check_cnt = sizeof($chk_data_array);
if($chk_data) {
	for( $i=0 ; $i < $check_cnt ; $i++) {
		$code_id_array = explode("_", $chk_data_array[$i]);
		$code = $code_id_array[0];
		$id = $code_id_array[1];
		$year = $code_id_array[2];
		$month = $code_id_array[3];
		$w_date = $code_id_array[4];
		$w_time = $code_id_array[5];
		$w_gubun = $code_id_array[6];
		//echo $id;
		//exit;
		if($w_gubun != "all") $where_reg_time = " and w_date = '$w_date' and w_time = '$w_time' ";
		else $where_reg_time = "";
		$sql_where = " com_code = '$code' and year = '$year' and month = '$month' $where_reg_time ";
		$sql = "select * from pibohum_base_pay_helper where $sql_where ";
		//echo count($idx);
		//echo $sql;
		//exit;
		$row = sql_fetch($sql);
		if (!$row[sabun]) {
			$msg ="코드 값이 제대로 넘어오지 않았습니다.";
		} else {
			sql_query("delete from pibohum_base_pay_helper where $sql_where ");
		}
	}
}
goto_url("./pay_ledger_list_helper.php?search_year=$search_year");
?>
