<?
$sub_menu = "500101";
include_once("./_common.php");
$now_time = date("Y-m-d H:i:s");
$mb_id = $member['mb_id'];
$mb_name = $member['mb_name'];
$mb_nick = $member['mb_nick'];
$mb_profile_code = $member['mb_profile'];
$sql_common = " regdt = '$now_time',
						com_code = '$id',
						memo = '$memo',
						call_day = '$call',
						damdang_code_memo = '$mb_profile_code',
						user_id = '$mb_id',
						user_nick = '$mb_nick',
						user_name = '$mb_name'
";
//����
if ($w == 'u'){
	$sql = " update com_list_gy_call set 
				$sql_common 
			  where idx = '$idx' ";
	sql_query($sql);
	alert("���������� ���� �Ǿ����ϴ�.","client_call_iframe.php?id=$id&w=$w&idx=$idx");
//���
}else{
	$sql = " insert com_list_gy_call set 
					$sql_common 
					";
	sql_query($sql);
	alert("���������� ��� �Ǿ����ϴ�.","client_call_iframe.php?id=$id");
}
?>