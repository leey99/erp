<?
$sub_menu = "500301";
include_once("./_common.php");

$sql_a4 = " select com_code from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
$row_a4 = sql_fetch($sql_a4);
$com_code = $row_a4['com_code'];

if(!$id) exit;
//echo $id;
$now_time = date("Y-m-d H:i:s");

//상여금기준 (산정기준, 상여비율)
$sql_opt2 = " select * from pibohum_base_opt2 where com_code='$com_code' and sabun='$id' ";
//echo $sql_opt2;
$result_opt2 = sql_query($sql_opt2);
$row_opt2 = mysql_fetch_array($result_opt2);
//echo $row_opt2['bonus_time'];
//echo $row_opt2['bonus_p'];
//exit;
$bonus_time = explode(",",$row_opt2['bonus_time']);	
$bonus_p_array = explode(",",$row_opt2['bonus_p']);	

$bonus_time_data = $bonus_time[0].",".$bonus_time[1].",".$bonus_time[2].",".$bonus_time[3].",".$bonus_time[4].",".$bonus_time[5];

if(!$bonus_time[0]) {
	$sql_com_opt = " select * from com_list_gy_opt where com_code='$com_code' ";
	$result_com_opt = sql_query($sql_com_opt);
	$row_com_opt = mysql_fetch_array($result_com_opt);
	$bonus_time_data = $row_com_opt['bonus_time'];
}

$bonus_p_array[$bonus_no] = $bonus_p;
//echo $bonus_p_array[0];
$bonus_p_data = $bonus_p_array[0].",".$bonus_p_array[1].",".$bonus_p_array[2].",".$bonus_p_array[3].",".$bonus_p_array[4].",".$bonus_p_array[5];
//echo $bonus_p_data;
//exit;
$sql_common = " bonus_p = '$bonus_p_data',
	bonus_time = '$bonus_time_data'
";
$sql = " update pibohum_base_opt2 set 
			$sql_common 
			where com_code = '$com_code' and sabun = '$id' ";
//echo $sql;
//exit;
sql_query($sql);
//alert("정상적으로 적용 되었습니다.","bonus_list_update.php");
?>
