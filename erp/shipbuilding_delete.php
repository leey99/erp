<?
$sub_menu = "100100";
include_once("./_common.php");

//echo $chk_data;

//check_demo();
//auth_check($auth[$sub_menu], "d");

$chk_data_array = explode(",", $chk_data);
$check_cnt = sizeof($chk_data_array);
for( $i=0 ; $i < $check_cnt ; $i++) {
	$id = $chk_data_array[$i];
	$sql = "select * from shipbuilding_gy where com_code = '$id' ";
	//echo count($idx);
	//echo $sql;
	$row = sql_fetch($sql);
	if (!$row[com_code]) {
		$msg ="사업장코드 값이 제대로 넘어오지 않았습니다.";
	} else {
		sql_query("update shipbuilding_gy set delete_yn='1' where com_code = '$id' ");
		//sql_query("delete from shipbuilding_gy where com_code = '$id' ");
		//sql_query("delete from shipbuilding_gy_opt where com_code = '$id' ");
	}
}
//exit;
if ($url)
    goto_url("{$url}?$qstr&w=u&id=$id");
else
    goto_url("./main.php?page=$page");
?>
