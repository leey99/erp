<?
$sub_menu = "100101";
include_once("./_common.php");
$now_time = date("Y-m-d H:i:s");
$mb_id = $member['mb_id'];
$mb_name = $member['mb_name'];
$mb_nick = $member['mb_nick'];
$sql_common = " regdt = '$now_time',
						com_code = '$id',
						t_no = '$t_no',
						memo = '$memo',
						user_id = '$mb_id',
						user_nick = '$mb_nick',
						user_name = '$mb_name'
";
//����
if ($w == 'u'){
	$sql = " update total_pay_comment set 
				$sql_common 
			  where idx = '$idx' ";
	sql_query($sql);
	alert("���������� �޸� ���� �Ǿ����ϴ�.","popup_memo.php?id=$id&w=$w&idx=$idx");
//���
}else{
	$sql = " insert total_pay_comment set 
					$sql_common 
					";
	sql_query($sql);
	alert("���������� �޸� ��� �Ǿ����ϴ�.","popup_memo.php?id=$id&t_no=$t_no");
}
?>