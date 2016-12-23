<?
$sub_menu = "500300";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

$now_time = date("Y-m-d H:i:s");

$sql_common2 = " bonus_day = '$bonus_day',
								pay = '$pay',
								memo = '$memo'
						";

//수정
if ($w == 'u'){
	$sql2 = " update pibohum_base_bonus set 
				$sql_common2 
				where idx = '$idx' ";
	sql_query($sql2);
	alert("정상적으로 연차가 수정 되었습니다.","bonus.php?page=$page");
//등록
}else{
	$sql2 = " insert pibohum_base_bonus set 
				$sql_common2 
				, com_code = '$com_code', sabun='$sabun' ";
	//$id = mysql_insert_id();
	//echo $sql2;
	//exit;
	sql_query($sql2);
	alert("정상적으로 상여금이 등록 되었습니다.","bonus.php");
}
?>
