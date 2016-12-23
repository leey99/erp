<?
$sub_menu = "100200";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

/*
echo $w;
echo $att_day;
echo $toYear;
echo $toMonth;
echo $sabun;
echo $att_time;
echo $att_time2;
echo $att_category;
echo $att_note;
exit;
*/

$g4[table] = "a4_attendance";
$now_time = date("Y-m-d H:i:s");

$sql_common = " com_code = '$com_code',
						sabun = '$sabun',
						att_day  = '$att_day',
						att_day2 = '$att_day2',
						att_time  = '$att_time',
						att_time2 = '$att_time2',
						att_category = '$att_category',
						att_note = '$att_note',
						att_annual_paid_holiday = '$att_annual_paid_holiday'
					";

//수정
if ($w == 'u'){
	$sql = " update $g4[table] set 
			$sql_common 
			where id = '$id' ";
	//echo $sql;
	//exit;
	sql_query($sql);
//등록
}else{
	$sql = " insert $g4[table] set 
			$sql_common ";
	//echo $sql;
	//exit;
	sql_query($sql);
}
if($w == 'u') $add_modify = "수정";
else $add_modify = "추가";
alert("정상적으로 근태정보가 $add_modify 되었습니다.","attendance.php?toYear=$toYear&toMonth=$toMonth");
?>