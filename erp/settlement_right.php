<?
//��� : ����(��ǥ, ������, ������, ����, �渮���, ������) ���� 150914 / �������� ������ ������(������ ����) 160406 / ����1 ���̿� ���� 160408
$mb_id_check = explode('000',$member['mb_id']);
if($mb_id_check[1] != "1" && $member['mb_id'] != "kcmc1001" && $member['mb_id'] != "kcmc1002" && $member['mb_id'] != "kcmc1004" && $member['mb_id'] != "kcmc1008" && $member['mb_id'] != "master" && $member['mb_id'] != "gj0024" && $member['mb_id'] != "jb10002") {
	alert("�ش� �������� ������ ������ �����ϴ�.");
}
?>