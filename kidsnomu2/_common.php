<?
@extract($_GET); 
@extract($_POST); 
@extract($_SERVER);

$g4_path = ".."; // common.php 의 상대 경로
$g4_easynomu = "../kidsnomu";
$g4 = array();
$g4['member_table'] = "a4_member";
include_once ("$g4_path/common_easynomu.php");
$g4['admin_path'] = "../admin";
$g4['insure_table'] = "a4_4insure";
$g4['com_list_gy'] = "com_list_gy";
$g4['pibohum_base'] = "pibohum_base";
//echo $g4['easynomu'];
//exit;
//echo $PHP_SELF;
//exit;
//echo $mode;
//exit;
//echo ['mb_id'];
//exit;

if($mode != "popup") {
	include_once("$g4[admin_path]/admin.lib.php");
}
//사업장 코드
$sql_a4 = " select * from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
$row_a4 = sql_fetch($sql_a4);
$com_code = $row_a4['com_code'];
//echo $sql_a4;

//이지노무 명칭
//$easynomu_name = "키즈노무";
$easynomu_name = "키즈노무 : ".$member['mb_nick']."(".$member['mb_id'].")";
$rooturl = "http://www.kidsnomu.com/kidsnomu";
$rootssl = "https://www.kidsnomu.com/kidsnomu";

//지사 배열
//                               1      2      3      4       5       6       7      8     9      10        11      12    13      14     15     16     17     18     19     20      21     22      23      24      25      26     27     28     29      30       31      32     33     34     35     36      37     38      39 40 41 42 43 44 45 46 47 48 49 50 51 52 53 54 55 56 57 58 59 60 61 62 63 64 65 66 67 68 69 70101
$man_cust_name_arry = array("","본사","창원","강릉","평택","대전1","대전2","고양","광주","대구1","대구2","의정부","청주","목포","성남","전주","경산","나주","부산","부산1","부산2","울산","서울1","창원2","딜러1","딜러2","인천","김해","안산","서울2","서울3","서울4","화성","거제","천안","양산","전북1","진주","부산3","광주2");
//담당자
$damdang_code_0022 = "이민지";
//$damdang_code_0023 = "이민화";
$damdang_code_0023 = "임현미";
$damdang_code_0024 = "김국진";
$damdang_code_0028 = "석정현";
$damdang_code_0029 = "박소향";
$damdang_code_0092 = "강태진";

//무료버전 사용자 정식버전 접근 차단
if($row_a4['lawwiz_code'] == "f") {
	alert("잘못된 접근입니다.","/kidsnomu_lite/");
}
?>
