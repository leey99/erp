<?
$sub_menu = "100001";
include_once("./_common.php");
echo "work_go_leave_update.php";
if(!$id) exit;
echo $id;
$now_time = date("Y-m-d H:i:s");
$now_date = date("Y-m-d");

//����� ����
if($type == "go") {
	$work_code = 1;
	$work_type = "���";
} else {
	$work_code = 2;
	$work_type = "���";
}

//����� �⺻���� ȣ��
$sql_work = "select * from work_go_leave where check_time like '$now_date%' and type = '$work_code' and user_id = '$id' ";
$row_work = sql_fetch($sql_work);
if($row_work['idx']) {
	//$check_date = explode(" ", $row_work['check_time']);
	alert("�̹� ".$work_type." üũ �Ǿ����ϴ�. (".$row_work['check_time'].")","work_go_leave_update.php");
	exit;
}
//����� üũ
$sql_common = " branch = '$branch', user_id = '$id', type = '$work_code', check_time = '$now_time' ";
$sql = " insert work_go_leave set $sql_common ";
//echo $sql;
sql_query($sql);

alert("���������� ".$work_type." üũ �Ǿ����ϴ�.","work_go_leave_update.php");
?>
