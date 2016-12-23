<?
$sub_menu = "100200";
include_once("./_common.php");

//check_demo();
//auth_check($auth[$sub_menu], "d");

if($sub_domain){
	$sub_menu = "800000";
}
//echo $chk_data;
//exit;
$chk_data_array = explode(",", $chk_data);
$check_cnt = sizeof($chk_data_array);
for( $i=0 ; $i < $check_cnt ; $i++) {
	if($chk_data_array[$i]) $id = $chk_data_array[$i];
	$sql = "select * from $g4[insure_table] where id = '$id' ";
	//echo $sql;
	//exit;
	$row = sql_fetch($sql);
	if (!$row[id]) {
		$msg ="id 값이 제대로 넘어오지 않았습니다.";
	} else {
		sql_query("delete from $g4[insure_table] where id = '$id' ");
	}
}
if ($url)
    goto_url("{$url}?$qstr&w=u&id=$id");
else
    goto_url("./4insure_list_admin.php?$qstr");
?>
