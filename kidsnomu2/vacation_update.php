<?
$sub_menu = "600100";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

$now_time = date("Y-m-d H:i:s");

$sql_common2 = " vacation_reason = '$vacation_reason',
								vacation_sdate = '$vacation_sdate',
								vacation_edate = '$vacation_edate',
								vacation_cause = '$vacation_cause'
						";

//����
if ($w == 'u'){
	$sql2 = " update pibohum_base_nomu set 
				$sql_common2 
				where idx = '$idx' ";
	//�����ް� 1ȸ
	//echo $sql2;
	//exit;
	sql_query($sql2);
	alert("���������� �ް�/������ ���� �Ǿ����ϴ�.","vacation.php?page=$page");
//���
}else{
	$sql2 = " insert pibohum_base_nomu set 
				$sql_common2 
				, com_code = '$com_code', sabun='$sabun' ";
	//$id = mysql_insert_id();
	//echo $sql2;
	//exit;
	sql_query($sql2);
	alert("���������� �ް�/������ ��� �Ǿ����ϴ�.","vacation.php");
}
?>
