<?
$sub_menu = "100101";
include_once("./_common.php");

$now_time = date("Y-m-d H:i:s");

$sql_common = " regdt = '$now_time',
						com_code = '$id',
						memo = '$memo',
						user_id = '$user_id'
";
//����
if ($w == 'u'){
	$sql = " update shipbuilding_comment set 
				$sql_common 
			  where idx = '$idx' ";
	sql_query($sql);
	alert("���������� ������ ���� �Ǿ����ϴ�.","popup_memo.php?id=$id&w=$w&idx=$idx");
//���
}else{
	$sql = " insert shipbuilding_comment set 
					$sql_common 
					";
	sql_query($sql);
	alert("���������� ������ ��� �Ǿ����ϴ�.","shipbuilding_memo.php?id=$id");
}
?>