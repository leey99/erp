<?
$sub_menu = "200100";
include_once("./_common.php");

//check_demo();
//auth_check($auth[$sub_menu], "d");
//echo $chk_data;
//exit;
$chk_data_array = explode(",", $chk_data);
$check_cnt = sizeof($chk_data_array);

for( $i=0 ; $i < $check_cnt ; $i++) {
	$code_id_array = explode("_", $chk_data_array[$i]);
	$code = $code_id_array[0];
	$id = $code_id_array[1];
	//echo $id;
	//exit;
	$sql = "select * from $g4[pibohum_base] where com_code = '$code' and sabun = '$id' ";
	//echo count($idx);
	//echo $sql;
	//exit;
	$row = sql_fetch($sql);
	if (!$row[sabun]) {
		$msg ="사원코드 값이 제대로 넘어오지 않았습니다.";
	} else {
		sql_query("delete from $g4[pibohum_base] where com_code = '$code' and sabun = '$id' ");
		sql_query("delete from pibohum_base_opt where com_code = '$code' and sabun = '$id' ");
		sql_query("delete from pibohum_base_opt2 where com_code = '$code' and sabun = '$id' ");
		sql_query("delete from pibohum_base_nomu where com_code = '$code' and sabun = '$id' ");
	}
}
//exit;
if($kind) goto_url("./staff_list_".$kind.".php?page=".$page);
else goto_url("./staff_list.php?page=$page");
?>
