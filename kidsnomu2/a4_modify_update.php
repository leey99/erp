<?
$sub_menu = "700220";
include_once("./_common.php");
/*
//POST용
foreach($_POST as $key => $value) { 
	$$key = $value; // register_globals option 편하게(?) 사용하기 위한 부분 
	if(!is_array($$key)) {
		echo $key." = ".$value."<br>"; 
	} else { 
		for($a=0; $a < sizeof($$key); $a++) 
		echo $key."[".$a."] = ".$value[$a]."<br>"; 
	} 
}
*/
//auth_check($auth[$sub_menu], "w");
//mysql_query("set names euckr");

$now_time = date("Y-m-d H:i:s");
$mktime = mktime();
$user_id = $member['mb_id'];

// 천단위 콤마 제거 DB 저장
$modify_salary = ereg_replace(',', '', $modify_salary);
//보험적용여부
$modify_insurance = $misgy.",".$missj.",".$miskm.",".$misgg;

//첨부파일 경로
$upload_dir = 'files/4insure/';

$sql_common = " comp_name = '$comp_name',
						comp_adr = '$comp_adr',
						comp_bznb = '$comp_bznb',
						comp_tel = '$comp_tel',
						comp_email = '$comp_email',
						comp_fax = '$comp_fax',

						modify_name = '$modify_name',
						modify_ssnb = '$modify_ssnb',
						modify_salary = '$modify_salary',
						modify_date = '$modify_date',
						modify_insurance = '$modify_insurance',
						modify_reason = '$modify_reason',
						modify_note = '$modify_note',

						user_id = '$user_id',
						wr_datetime = '$now_time' ";

if ($w == 'u') {
	$sql = " update a4_modify set 
				$sql_common 
				where id = '$id' ";
	sql_query($sql);
	$sql_opt = " delete from a4_modify_opt where mid = $id ";
	sql_query($sql_opt);
} else {
	$sql = " insert a4_modify set 
			$sql_common ";
	sql_query($sql);
	$id = mysql_insert_id();
}
//월평균보수 변경 신고 DB 옵션
$modify_count = count($modify_name_)-1;
for($i=0; $i<=$modify_count; $i++) {
	$k = $i + 2;
	$modify_salary_[$i] = ereg_replace(',', '', $modify_salary_[$i]);
	$modify_insurance_[$i] = $_POST["misgy_".$k].",".$_POST["missj_".$k].",".$_POST["miskm_".$k].",".$_POST["misgg_".$k];
	$sql_common2 = " 
						modify_name = '$modify_name_[$i]',
						modify_ssnb = '$modify_ssnb_[$i]',
						modify_salary = '$modify_salary_[$i]',
						modify_date = '$modify_date_[$i]',
						modify_insurance = '$modify_insurance_[$i]',
						modify_reason = '$modify_reason_[$i]',
						modify_note = '$modify_note_[$i]' ";
	$sql2 = " insert a4_modify_opt set $sql_common2 , mid = '$id' ";
	sql_query($sql2);
}
//echo $sql;
//exit;
if(!$sabun) alert("정상적으로 신고 접수/수정 되었습니다.","a4_modify_view.php?id=$id&page=$page");
else alert("정상적으로 변경신고 접수 되었습니다.","staff_list_beistand.php&page=$page");
?>