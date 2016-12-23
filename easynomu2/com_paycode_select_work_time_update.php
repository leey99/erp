<?
$sub_menu = "100300";
include_once("./_common.php");

//echo $code." ";
//echo $a_checked." ";
//echo $b_checked." ";
//echo $work_gbn_chk." ";
//echo $url." ";
//echo count($week_day)." ";
//echo $week_day;
/*
echo $a_workhour_day_d." "; // 1일 소정근로시간
echo $a_workhour_day_w." "; // 1주 소정근로시간
echo $a_workhour_ext_w." "; // 1주 연장근로시간
echo $a_workhour_hday_w." "; // 1주 휴일근로시간
echo $a_workhour_night_w." "; // 1주 야간근로시간
for($i=0;$i>count($work_gbn);$i++) {
	echo $work_gbn[$i];
	echo $week_day[$i];
	echo $workday_gbn[$i];
}
*/
//echo $a_workhour_ext_w;
//exit;
/*
if($work_gbn_chk == "A") {
	$workhour_day_d = $a_workhour_day_d;
	$workhour_day_w = $a_workhour_day_w;
	$workhour_ext_w = $a_workhour_ext_w;
	$workhour_hday_w = $a_workhour_hday_w;
	$workhour_night_w = $a_workhour_night_w;
} else if($work_gbn_chk == "B") {
	$workhour_day_d = $b_workhour_day_d;
	$workhour_day_w = $b_workhour_day_w;
	$workhour_ext_w = $b_workhour_ext_w;
	$workhour_hday_w = $b_workhour_hday_w;
	$workhour_night_w = $b_workhour_night_w;
}
*/
$now_time = date("Y-m-d H:i:s");

$sql_common_a = " 
						work_gbn = 'A',
						work_gbn_text = '$work_gbn_text_a',
						workday_gbn = '$workday_gbn_0,$workday_gbn_1,$workday_gbn_2,$workday_gbn_3,$workday_gbn_4,$workday_gbn_5,$workday_gbn_6',

						work_shour = '$work_shour_0,$work_shour_1,$work_shour_2,$work_shour_3,$work_shour_4,$work_shour_5,$work_shour_6',
						work_smin = '$work_smin_0,$work_smin_1,$work_smin_2,$work_smin_3,$work_smin_4,$work_smin_5,$work_smin_6',
						work_ehour = '$work_ehour_0,$work_ehour_1,$work_ehour_2,$work_ehour_3,$work_ehour_4,$work_ehour_5,$work_ehour_6',
						work_emin = '$work_emin_0,$work_emin_1,$work_emin_2,$work_emin_3,$work_emin_4,$work_emin_5,$work_emin_6',

						rest_shour = '$rest_shour_0,$rest_shour_1,$rest_shour_2,$rest_shour_3,$rest_shour_4,$rest_shour_5,$rest_shour_6',
						rest_smin = '$rest_smin_0,$rest_smin_1,$rest_smin_2,$rest_smin_3,$rest_smin_4,$rest_smin_5,$rest_smin_6',
						rest_ehour = '$rest_ehour_0,$rest_ehour_1,$rest_ehour_2,$rest_ehour_3,$rest_ehour_4,$rest_ehour_5,$rest_ehour_6',
						rest_emin = '$rest_emin_0,$rest_emin_1,$rest_emin_2,$rest_emin_3,$rest_emin_4,$rest_emin_5,$rest_emin_6',

						rest_shour2 = '$rest_shour2_0,$rest_shour2_1,$rest_shour2_2,$rest_shour2_3,$rest_shour2_4,$rest_shour2_5,$rest_shour2_6',
						rest_smin2 = '$rest_smin2_0,$rest_smin2_1,$rest_smin2_2,$rest_smin2_3,$rest_smin2_4,$rest_smin2_5,$rest_smin2_6',
						rest_ehour2 = '$rest_ehour2_0,$rest_ehour2_1,$rest_ehour2_2,$rest_ehour2_3,$rest_ehour2_4,$rest_ehour2_5,$rest_ehour2_6',
						rest_emin2 = '$rest_emin2_0,$rest_emin2_1,$rest_emin2_2,$rest_emin2_3,$rest_emin2_4,$rest_emin2_5,$rest_emin2_6',

						rest_shour3 = '$rest_shour3_0,$rest_shour3_1,$rest_shour3_2,$rest_shour3_3,$rest_shour3_4,$rest_shour3_5,$rest_shour3_6',
						rest_smin3 = '$rest_smin3_0,$rest_smin3_1,$rest_smin3_2,$rest_smin3_3,$rest_smin3_4,$rest_smin3_5,$rest_smin3_6',
						rest_ehour3 = '$rest_ehour3_0,$rest_ehour3_1,$rest_ehour3_2,$rest_ehour3_3,$rest_ehour3_4,$rest_ehour3_5,$rest_ehour3_6',
						rest_emin3 = '$rest_emin3_0,$rest_emin3_1,$rest_emin3_2,$rest_emin3_3,$rest_emin3_4,$rest_emin3_5,$rest_emin3_6',

						ext_shour = '$ext_shour_0,$ext_shour_1,$ext_shour_2,$ext_shour_3,$ext_shour_4,$ext_shour_5,$ext_shour_6',
						ext_smin = '$ext_smin_0,$ext_smin_1,$ext_smin_2,$ext_smin_3,$ext_smin_4,$ext_smin_5,$ext_smin_6',
						ext_ehour = '$ext_ehour_0,$ext_ehour_1,$ext_ehour_2,$ext_ehour_3,$ext_ehour_4,$ext_ehour_5,$ext_ehour_6',
						ext_emin = '$ext_emin_0,$ext_emin_1,$ext_emin_2,$ext_emin_3,$ext_emin_4,$ext_emin_5,$ext_emin_6',

						night_shour = '$night_shour_0,$night_shour_1,$night_shour_2,$night_shour_3,$night_shour_4,$night_shour_5,$night_shour_6',
						night_smin = '$night_smin_0,$night_smin_1,$night_smin_2,$night_smin_3,$night_smin_4,$night_smin_5,$night_smin_6',
						night_ehour = '$night_ehour_0,$night_ehour_1,$night_ehour_2,$night_ehour_3,$night_ehour_4,$night_ehour_5,$night_ehour_6',
						night_emin = '$night_emin_0,$night_emin_1,$night_emin_2,$night_emin_3,$night_emin_4,$night_emin_5,$night_emin_6',

						workhour_day_d = '$a_workhour_day_d',
						workhour_day_w = '$a_workhour_day_w',
						workhour_ext_w = '$a_workhour_ext_w',
						workhour_hday_w = '$a_workhour_hday_w',
						workhour_night_w = '$a_workhour_night_w',
						modify_date = '$now_time' ";
$sql_common_b = " 
						work_gbn = 'B',
						work_gbn_text = '$work_gbn_text_b',
						workday_gbn = '$b_workday_gbn_0,$b_workday_gbn_1,$b_workday_gbn_2,$b_workday_gbn_3,$b_workday_gbn_4,$b_workday_gbn_5,$b_workday_gbn_6',

						work_shour = '$b_work_shour_0,$b_work_shour_1,$b_work_shour_2,$b_work_shour_3,$b_work_shour_4,$b_work_shour_5,$b_work_shour_6',
						work_smin = '$b_work_smin_0,$b_work_smin_1,$b_work_smin_2,$b_work_smin_3,$b_work_smin_4,$b_work_smin_5,$b_work_smin_6',
						work_ehour = '$b_work_ehour_0,$b_work_ehour_1,$b_work_ehour_2,$b_work_ehour_3,$b_work_ehour_4,$b_work_ehour_5,$b_work_ehour_6',
						work_emin = '$b_work_emin_0,$b_work_emin_1,$b_work_emin_2,$b_work_emin_3,$b_work_emin_4,$b_work_emin_5,$b_work_emin_6',

						rest_shour = '$b_rest_shour_0,$b_rest_shour_1,$b_rest_shour_2,$b_rest_shour_3,$b_rest_shour_4,$b_rest_shour_5,$b_rest_shour_6',
						rest_smin = '$b_rest_smin_0,$b_rest_smin_1,$b_rest_smin_2,$b_rest_smin_3,$b_rest_smin_4,$b_rest_smin_5,$b_rest_smin_6',
						rest_ehour = '$b_rest_ehour_0,$b_rest_ehour_1,$b_rest_ehour_2,$b_rest_ehour_3,$b_rest_ehour_4,$b_rest_ehour_5,$b_rest_ehour_6',
						rest_emin = '$b_rest_emin_0,$b_rest_emin_1,$b_rest_emin_2,$b_rest_emin_3,$b_rest_emin_4,$b_rest_emin_5,$b_rest_emin_6',

						rest_shour2 = '$b_rest_shour2_0,$b_rest_shour2_1,$b_rest_shour2_2,$b_rest_shour2_3,$b_rest_shour2_4,$b_rest_shour2_5,$b_rest_shour2_6',
						rest_smin2 = '$b_rest_smin2_0,$b_rest_smin2_1,$b_rest_smin2_2,$b_rest_smin2_3,$b_rest_smin2_4,$b_rest_smin2_5,$b_rest_smin2_6',
						rest_ehour2 = '$b_rest_ehour2_0,$b_rest_ehour2_1,$b_rest_ehour2_2,$b_rest_ehour2_3,$b_rest_ehour2_4,$b_rest_ehour2_5,$b_rest_ehour2_6',
						rest_emin2 = '$b_rest_emin2_0,$b_rest_emin2_1,$b_rest_emin2_2,$b_rest_emin2_3,$b_rest_emin2_4,$b_rest_emin2_5,$b_rest_emin2_6',

						rest_shour3 = '$b_rest_shour3_0,$b_rest_shour3_1,$b_rest_shour3_2,$b_rest_shour3_3,$b_rest_shour3_4,$b_rest_shour3_5,$b_rest_shour3_6',
						rest_smin3 = '$b_rest_smin3_0,$b_rest_smin3_1,$b_rest_smin3_2,$b_rest_smin3_3,$b_rest_smin3_4,$b_rest_smin3_5,$b_rest_smin3_6',
						rest_ehour3 = '$b_rest_ehour3_0,$b_rest_ehour3_1,$b_rest_ehour3_2,$b_rest_ehour3_3,$b_rest_ehour3_4,$b_rest_ehour3_5,$b_rest_ehour3_6',
						rest_emin3 = '$b_rest_emin3_0,$b_rest_emin3_1,$b_rest_emin3_2,$b_rest_emin3_3,$b_rest_emin3_4,$b_rest_emin3_5,$b_rest_emin3_6',

						ext_shour = '$b_ext_shour_0,$b_ext_shour_1,$b_ext_shour_2,$b_ext_shour_3,$b_ext_shour_4,$b_ext_shour_5,$b_ext_shour_6',
						ext_smin = '$b_ext_smin_0,$b_ext_smin_1,$b_ext_smin_2,$b_ext_smin_3,$b_ext_smin_4,$b_ext_smin_5,$b_ext_smin_6',
						ext_ehour = '$b_ext_ehour_0,$b_ext_ehour_1,$b_ext_ehour_2,$b_ext_ehour_3,$b_ext_ehour_4,$b_ext_ehour_5,$b_ext_ehour_6',
						ext_emin = '$b_ext_emin_0,$b_ext_emin_1,$b_ext_emin_2,$b_ext_emin_3,$b_ext_emin_4,$b_ext_emin_5,$b_ext_emin_6',

						night_shour = '$b_night_shour_0,$b_night_shour_1,$b_night_shour_2,$b_night_shour_3,$b_night_shour_4,$b_night_shour_5,$b_night_shour_6',
						night_smin = '$b_night_smin_0,$b_night_smin_1,$b_night_smin_2,$b_night_smin_3,$b_night_smin_4,$b_night_smin_5,$b_night_smin_6',
						night_ehour = '$b_night_ehour_0,$b_night_ehour_1,$b_night_ehour_2,$b_night_ehour_3,$b_night_ehour_4,$b_night_ehour_5,$b_night_ehour_6',
						night_emin = '$b_night_emin_0,$b_night_emin_1,$b_night_emin_2,$b_night_emin_3,$b_night_emin_4,$b_night_emin_5,$b_night_emin_6',

						workhour_day_d = '$b_workhour_day_d',
						workhour_day_w = '$b_workhour_day_w',
						workhour_ext_w = '$b_workhour_ext_w',
						workhour_hday_w = '$b_workhour_hday_w',
						workhour_night_w = '$b_workhour_night_w',
						modify_date = '$now_time' ";
$sql_common_c = " 
						work_gbn = 'C',
						work_gbn_text = '$work_gbn_text_c',
						workday_gbn = '$c_workday_gbn_0,$c_workday_gbn_1,$c_workday_gbn_2,$c_workday_gbn_3,$c_workday_gbn_4,$c_workday_gbn_5,$c_workday_gbn_6',

						work_shour = '$c_work_shour_0,$c_work_shour_1,$c_work_shour_2,$c_work_shour_3,$c_work_shour_4,$c_work_shour_5,$c_work_shour_6',
						work_smin = '$c_work_smin_0,$c_work_smin_1,$c_work_smin_2,$c_work_smin_3,$c_work_smin_4,$c_work_smin_5,$c_work_smin_6',
						work_ehour = '$c_work_ehour_0,$c_work_ehour_1,$c_work_ehour_2,$c_work_ehour_3,$c_work_ehour_4,$c_work_ehour_5,$c_work_ehour_6',
						work_emin = '$c_work_emin_0,$c_work_emin_1,$c_work_emin_2,$c_work_emin_3,$c_work_emin_4,$c_work_emin_5,$c_work_emin_6',

						rest_shour = '$c_rest_shour_0,$c_rest_shour_1,$c_rest_shour_2,$c_rest_shour_3,$c_rest_shour_4,$c_rest_shour_5,$c_rest_shour_6',
						rest_smin = '$c_rest_smin_0,$c_rest_smin_1,$c_rest_smin_2,$c_rest_smin_3,$c_rest_smin_4,$c_rest_smin_5,$c_rest_smin_6',
						rest_ehour = '$c_rest_ehour_0,$c_rest_ehour_1,$c_rest_ehour_2,$c_rest_ehour_3,$c_rest_ehour_4,$c_rest_ehour_5,$c_rest_ehour_6',
						rest_emin = '$c_rest_emin_0,$c_rest_emin_1,$c_rest_emin_2,$c_rest_emin_3,$c_rest_emin_4,$c_rest_emin_5,$c_rest_emin_6',

						rest_shour2 = '$c_rest_shour2_0,$c_rest_shour2_1,$c_rest_shour2_2,$c_rest_shour2_3,$c_rest_shour2_4,$c_rest_shour2_5,$c_rest_shour2_6',
						rest_smin2 = '$c_rest_smin2_0,$c_rest_smin2_1,$c_rest_smin2_2,$c_rest_smin2_3,$c_rest_smin2_4,$c_rest_smin2_5,$c_rest_smin2_6',
						rest_ehour2 = '$c_rest_ehour2_0,$c_rest_ehour2_1,$c_rest_ehour2_2,$c_rest_ehour2_3,$c_rest_ehour2_4,$c_rest_ehour2_5,$c_rest_ehour2_6',
						rest_emin2 = '$c_rest_emin2_0,$c_rest_emin2_1,$c_rest_emin2_2,$c_rest_emin2_3,$c_rest_emin2_4,$c_rest_emin2_5,$c_rest_emin2_6',

						rest_shour3 = '$c_rest_shour3_0,$c_rest_shour3_1,$c_rest_shour3_2,$c_rest_shour3_3,$c_rest_shour3_4,$c_rest_shour3_5,$c_rest_shour3_6',
						rest_smin3 = '$c_rest_smin3_0,$c_rest_smin3_1,$c_rest_smin3_2,$c_rest_smin3_3,$c_rest_smin3_4,$c_rest_smin3_5,$c_rest_smin3_6',
						rest_ehour3 = '$c_rest_ehour3_0,$c_rest_ehour3_1,$c_rest_ehour3_2,$c_rest_ehour3_3,$c_rest_ehour3_4,$c_rest_ehour3_5,$c_rest_ehour3_6',
						rest_emin3 = '$c_rest_emin3_0,$c_rest_emin3_1,$c_rest_emin3_2,$c_rest_emin3_3,$c_rest_emin3_4,$c_rest_emin3_5,$c_rest_emin3_6',

						ext_shour = '$c_ext_shour_0,$c_ext_shour_1,$c_ext_shour_2,$c_ext_shour_3,$c_ext_shour_4,$c_ext_shour_5,$c_ext_shour_6',
						ext_smin = '$c_ext_smin_0,$c_ext_smin_1,$c_ext_smin_2,$c_ext_smin_3,$c_ext_smin_4,$c_ext_smin_5,$c_ext_smin_6',
						ext_ehour = '$c_ext_ehour_0,$c_ext_ehour_1,$c_ext_ehour_2,$c_ext_ehour_3,$c_ext_ehour_4,$c_ext_ehour_5,$c_ext_ehour_6',
						ext_emin = '$c_ext_emin_0,$c_ext_emin_1,$c_ext_emin_2,$c_ext_emin_3,$c_ext_emin_4,$c_ext_emin_5,$c_ext_emin_6',

						night_shour = '$c_night_shour_0,$c_night_shour_1,$c_night_shour_2,$c_night_shour_3,$c_night_shour_4,$c_night_shour_5,$c_night_shour_6',
						night_smin = '$c_night_smin_0,$c_night_smin_1,$c_night_smin_2,$c_night_smin_3,$c_night_smin_4,$c_night_smin_5,$c_night_smin_6',
						night_ehour = '$c_night_ehour_0,$c_night_ehour_1,$c_night_ehour_2,$c_night_ehour_3,$c_night_ehour_4,$c_night_ehour_5,$c_night_ehour_6',
						night_emin = '$c_night_emin_0,$c_night_emin_1,$c_night_emin_2,$c_night_emin_3,$c_night_emin_4,$c_night_emin_5,$c_night_emin_6',

						workhour_day_d = '$c_workhour_day_d',
						workhour_day_w = '$c_workhour_day_w',
						workhour_ext_w = '$c_workhour_ext_w',
						workhour_hday_w = '$c_workhour_hday_w',
						workhour_night_w = '$c_workhour_night_w',
						modify_date = '$now_time' ";

$sql_common_opt2 = "
						work_gbn_base = '$work_gbn_base' ";

for($i=0;$i<3;$i++) {
	if($i == 0) {
		$work_gbn_chk = "A";
		$sql_common = $sql_common_a;
	} else if($i == 1) {
		$work_gbn_chk = "B";
		$sql_common = $sql_common_b;
	} else {
		$work_gbn_chk = "C";
		$sql_common = $sql_common_c;
	}
	//데이터 유무
	$sql_chk = " select * from a4_work_time where com_code = '$code' and work_gbn = '$work_gbn_chk' ";
	$result_chk = sql_query($sql_chk);
	$total_chk = mysql_num_rows($result_chk);
	//수정
	if($total_chk) {
		$sql = " update a4_work_time set $sql_common where com_code = '$code' and work_gbn = '$work_gbn_chk' ";
	//등록
	} else {
		$sql = " insert a4_work_time set $sql_common , com_code = '$code' ";
	}
	//echo $sql;
	//exit;
	sql_query($sql);
}
//데이터 유무 (추가 정보 opt2)
$sql_chk2 = " select * from com_list_gy_opt2 where com_code = '$code' ";
$result_chk2 = sql_query($sql_chk2);
$total_chk2 = mysql_num_rows($result_chk2);
//수정
if($total_chk) {
	$sql2 = " update com_list_gy_opt2 set $sql_common_opt2 where com_code = '$code' ";
//등록
} else {
	$sql2 = " insert com_list_gy_opt2 set $sql_common_opt2 , com_code = '$code' ";
}
sql_query($sql2);
alert("정상적으로 주간근무시간이 저장 되었습니다.","com_paycode_list.php?item=$item");
?>
