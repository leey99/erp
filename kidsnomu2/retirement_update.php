<?
$sub_menu = "500100";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

$now_time = date("Y-m-d H:i:s");

$sql_common = " out_day = '$out_day', gubun = 2 ";

$sql_common2 = " retire_reason = '$retire_reason',
								quit_date = '$out_day',
								retire_pay = '$retire_pay',
								quit_cause = '$quit_cause',
								quit_cause_text = '$quit_cause_text'
						";

//추가 필드 데이터 유무
$sql1 = " select * from pibohum_base_nomu where idx='$idx' ";
//echo $sql1;
//exit;
$result1 = sql_query($sql1);
$total1 = mysql_num_rows($result1);
//수정
if ($w == 'u') {

	$sql = " update $g4[pibohum_base] set 
				$sql_common 
			  where com_code = '$com_code' and sabun='$sabun' ";
	//echo $sql;
	//exit;

	if($total1) {
		$sql2 = " update pibohum_base_nomu set 
					$sql_common2 
					where idx='$idx' ";
	} else {
		$sql2 = " insert pibohum_base_nomu set 
					$sql_common2 
					, com_code = '$com_code', sabun='$id' ";
	}
	sql_query($sql);
	sql_query($sql2);
	alert("정상적으로 퇴직정보가 수정 되었습니다.","retirement.php?page=$page");
//등록
}else{
/*
	$sql = " update $g4[pibohum_base] set 
					$sql_common
					where com_code = '$com_code' and sabun='$sabun' ";
*/
	if($total1) {
		$sql2 = " update pibohum_base_nomu set 
					$sql_common2 
					where idx='$idx' ";
	} else {
		$sql2 = " insert pibohum_base_nomu set 
					$sql_common2 
					, com_code = '$com_code', sabun='$sabun' ";
	}
	//echo $sql;
	//exit;
  //$id = mysql_insert_id();

	//사원정보 자동 퇴사일 입력 기능 해제 160217
	//sql_query($sql);
	sql_query($sql2);
	alert("정상적으로 퇴직정보가 등록 되었습니다.","retirement.php");
}
//echo $sql;
//echo $sql2;
//exit;
?>
