<?
@extract($_GET); 
@extract($_POST); 
@extract($_SERVER);

$g4_path = ".."; // common.php �� ��� ���
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
//����� �ڵ�
$sql_a4 = " select * from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
$row_a4 = sql_fetch($sql_a4);
$com_code = $row_a4['com_code'];
//echo $sql_a4;

//�����빫 ��Ī
//$easynomu_name = "Ű��빫";
$easynomu_name = "Ű��빫 : ".$member['mb_nick']."(".$member['mb_id'].")";
$rooturl = "http://www.kidsnomu.com/kidsnomu";
$rootssl = "https://www.kidsnomu.com/kidsnomu";

//���� �迭
//                               1      2      3      4       5       6       7      8     9      10        11      12    13      14     15     16     17     18     19     20      21     22      23      24      25      26     27     28     29      30       31      32     33     34     35     36      37     38      39 40 41 42 43 44 45 46 47 48 49 50 51 52 53 54 55 56 57 58 59 60 61 62 63 64 65 66 67 68 69 70101
$man_cust_name_arry = array("","����","â��","����","����","����1","����2","���","����","�뱸1","�뱸2","������","û��","����","����","����","���","����","�λ�","�λ�1","�λ�2","���","����1","â��2","����1","����2","��õ","����","�Ȼ�","����2","����3","����4","ȭ��","����","õ��","���","����1","����","�λ�3","����2");
//�����
$damdang_code_0022 = "�̹���";
//$damdang_code_0023 = "�̹�ȭ";
$damdang_code_0023 = "������";
$damdang_code_0024 = "�豹��";
$damdang_code_0028 = "������";
$damdang_code_0029 = "�ڼ���";
$damdang_code_0092 = "������";

//������� ����� ���Ĺ��� ���� ����
if($row_a4['lawwiz_code'] == "f") {
	alert("�߸��� �����Դϴ�.","/kidsnomu_lite/");
}
?>
