<?
$sub_menu = "300100";
include_once("./_common.php");

//check_demo();
//auth_check($auth[$sub_menu], "d");
//echo $chk_data;
//exit;
$chk_data_array = explode(",", $chk_data);
$check_cnt = sizeof($chk_data_array);
for( $i=0 ; $i < $check_cnt ; $i++) {
	if($chk_data_array[$i]) $id = $chk_data_array[$i];
	$sql = "select * from total_pay where id = '$id' ";
	//echo $sql;
	//exit;
	$row = sql_fetch($sql);
	if (!$row[id]) {
		$msg ="id ���� ����� �Ѿ���� �ʾҽ��ϴ�.";
	} else {
		sql_query("delete from total_pay where id = '$id' ");
		sql_query("delete from total_pay_opt where mid = '$id' ");
	}
}
if ($url)
    goto_url("{$url}?$qstr&w=u&id=$id");
else
    goto_url("./total_pay_list_admin.php?$qstr");
?>
