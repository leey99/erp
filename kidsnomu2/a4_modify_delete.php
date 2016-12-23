<?
$sub_menu = "700220";
include_once("./_common.php");

//check_demo();
//auth_check($auth[$sub_menu], "d");
//echo $chk_data;
//exit;
$qstr = "page=".$page;
$chk_data_array = explode(",", $chk_data);
$check_cnt = sizeof($chk_data_array);
for( $i=0 ; $i < $check_cnt ; $i++) {
	if($chk_data_array[$i]) $id = $chk_data_array[$i];
	$sql = "select * from a4_modify where id = '$id' ";
	//echo $sql;
	//exit;
	$row = sql_fetch($sql);
	if (!$row[id]) {
		$msg ="id 값이 제대로 넘어오지 않았습니다.";
	} else {
		sql_query("delete from a4_modify where id = '$id' ");
	}
}
goto_url("./a4_modify_list_admin.php?$qstr");
?>
