<?
$sub_menu = "400101";
include_once("./_common.php");
$now_date = date("Y.m.d");
$now_time = date("Y-m-d H:i:s");
$mb_id = $member['mb_id'];
$sql_a4 = " select * from com_list_gy where com_code = '$id' ";
$result_a4 = sql_query($sql_a4);
$row_a4 = mysql_fetch_array($result_a4);
$com_name_4insure = $row_a4['com_name'];
$biz_no_4insure = $row_a4['biz_no'];
//접수방법 기타 강제 설정 150922
$input_type = 3;
$sql_common = " com_code = '$id',
						com_name_4insure = '$com_name_4insure',
						biz_no_4insure = '$biz_no_4insure',
						samu_insure_regdt = '$now_date',
						regdt = '$now_time',
						report_date = '$now_date',
						report_time = '$now_time',
						input_type = '$input_type',
						report_kind = '$report_kind',
						isgy = '$isgy',
						issj = '$issj',
						iskm = '$iskm',
						isgg = '$isgg',
						staff_name = '$staff_name',
						staff_ssnb = '$staff_ssnb',
						staff_memo = '$staff_memo',
						user_id = '$mb_id'
";
//수정
if ($w == 'u'){
	$sql = " update samu_4insure set 
				$sql_common 
			  where idx = '$idx' ";
	sql_query($sql);
	alert("정상적으로 피보험자신고가 수정 되었습니다.","popup_4insure.php?id=$id&w=$w&idx=$idx");
//등록
}else{
	$sql = " insert samu_4insure set 
					$sql_common 
					";
	sql_query($sql);
	alert("정상적으로 피보험자신고가 등록 되었습니다.","popup_4insure.php?id=$id&amp;stx_report_kind=$stx_report_kind");
}
?>