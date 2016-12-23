<?
$sub_menu = "600100";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

$now_time = date("Y-m-d H:i:s");

$sql_common2 = " vacation_reason = '$vacation_reason',
								vacation_sdate = '$vacation_sdate',
								vacation_edate = '$vacation_edate',
								vacation_cause = '$vacation_cause'
						";

//수정
if ($w == 'u'){
	$sql2 = " update pibohum_base_nomu set 
				$sql_common2 
				where idx = '$idx' ";
	//연차휴가 1회
	//echo $sql2;
	//exit;
	sql_query($sql2);
	alert("정상적으로 휴가/휴직이 수정 되었습니다.","vacation.php?page=$page");
//등록
}else{
	$sql2 = " insert pibohum_base_nomu set 
				$sql_common2 
				, com_code = '$com_code', sabun='$sabun' ";
	//$id = mysql_insert_id();
	//echo $sql2;
	//exit;
	sql_query($sql2);
	alert("정상적으로 휴가/휴직이 등록 되었습니다.","vacation.php");
}
?>
