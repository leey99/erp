<?
$sub_menu = "1900101";
include_once("./_common.php");

$now_time = date("Y-m-d H:i:s");
$mb_nick = $member['mb_nick'];
$mb_name = $member['mb_name'];
$sql_common = " regdt = '$now_time',
						mid = '$id',
						com_code = '$com_code',
						memo = '$etc',
						user_id = '$user_id',
						user_nick = '$mb_nick',
						user_name = '$mb_name'
";
//�߰�����
$sql_common2 = "
						etc = '$etc',
						etc_user = '$mb_name',
						editdt = '$now_time'
";
//����
if ($w == 'u'){
	$sql = " update job_time_comment set 
				$sql_common 
			  where idx = '$idx' ";
	sql_query($sql);
	alert("���������� ó������� ���� �Ǿ����ϴ�.","job_time_etc.php?id=$id&w=$w&idx=$idx");
//���
}else{
	$sql = " insert job_time_comment set 
					$sql_common 
					";
	sql_query($sql);
	//���â�� �߰�DB
	$sql2 = " update job_time_opt set 
				$sql_common2 
				where id = '$id' ";
	sql_query($sql2);
	alert("���������� ó������� ��� �Ǿ����ϴ�.","job_time_etc.php?id=$id");
}
?>