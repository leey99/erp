<?
$g4_path = "../.."; // common.php �� ��� ���
$g4_easynomu = "..";
$g4[member_table] = "a4_member";
include_once ("$g4_path/common_easynomu.php");
$g4[admin_path] = "../../admin";
$g4[insure_table] = "a4_4insure";
$g4[com_list_gy] = "com_list_gy";
$g4[pibohum_base] = "pibohum_base";
//echo $g4[easynomu];
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
//�����빫 ��Ī
$easynomu_name = "�����빫";
$rooturl = "http://www.easynomu.com/easynomu";
$rootssl = "https://www.easynomu.com/easynomu";
?>
