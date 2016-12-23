<?
$sub_menu = "400500";
include_once("./_common.php");

$now_time = date("Y-m-d H:i:s");
$now_date = date("Y.m.d");

//담당자 설정
$mb_id = $member['mb_id'];

//사업장 기본정보
$sql_common = "
						regdt = '$regdt',
						report_date = '$report_date',
						input_type = '$input_type',
						report_kind = '$report_kind',
						isgy = '$isgy',
						issj = '$issj',
						iskm = '$iskm',
						isgg = '$isgg',
						staff_name = '$staff_name',
						staff_ssnb = '$staff_ssnb',
						staff_memo = '$staff_memo',

						modify_id = '$mb_id',
						modify_time = '$now_time'
";
$sql = " update samu_4insure set $sql_common where idx = '$idx' ";
//echo $sql;
//exit;
sql_query($sql);
alert("정상적으로 피보험자신고 정보가 수정 되었습니다.","samu_insure_view.php?id=".$id."&amp;idx=".$idx."&amp;w=".$w."&amp;page=".$page."&amp;".$qstr);
?>