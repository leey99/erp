<?
$sub_menu = "700220";
include_once("./_common.php");
/*
//POST��
foreach($_POST as $key => $value) { 
	$$key = $value; // register_globals option ���ϰ�(?) ����ϱ� ���� �κ� 
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

// õ���� �޸� ���� DB ����
$modify_salary = ereg_replace(',', '', $modify_salary);
//�������뿩��
$modify_insurance = $misgy.",".$missj.",".$miskm.",".$misgg;

//÷������ ���
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
//����պ��� ���� �Ű� DB �ɼ�
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
if(!$sabun) alert("���������� �Ű� ����/���� �Ǿ����ϴ�.","a4_modify_view.php?id=$id&page=$page");
else alert("���������� ����Ű� ���� �Ǿ����ϴ�.","staff_list_beistand.php&page=$page");
?>