<?
$g4_path = ".."; // common.php �� ��� ���
include_once("$g4_path/common_erp.php");
//echo $mb_id;
$mb_id       = $_POST[mb_id];
$mb_password = $_POST[mb_password];

$now_time = date("Y-m-d H:i:s");

if (!trim($mb_id) || !trim($mb_password))
    alert("ȸ�����̵� �н����尡 �����̸� �ȵ˴ϴ�.");

/*
// �ڵ� ��ũ��Ʈ�� �̿��� ���ݿ� ����Ͽ� �α��� ���нÿ��� �����ð��� �����Ŀ� �ٽ� �α��� �ϵ��� ��
if ($check_time = get_session("ss_login_check_time")) {
    if ($check_time > $g4['server_time'] - 15) {
        alert("�α��� ���нÿ��� 15�� ���Ŀ� �ٽ� �α��� �Ͻñ� �ٶ��ϴ�.");
    }
}
set_session("ss_login_check_time", $g4['server_time']);
*/

$g4[member_table] = "a4_member";
$mb = get_member($mb_id);
// ���Ե� ȸ���� �ƴϴ�. �н����尡 Ʋ����. ��� �޼����� ���� �������� �ʴ� ������ 
// ȸ�����̵� �Է��� ���� ������ �� �н����带 �Է��غ��� ��츦 �����ϱ� ���ؼ��Դϴ�.
// �ҹ�������� ��� ȸ�����̵� Ʋ����, �н����尡 Ʋ������ �˱������ ���� �ð��� �ҿ�Ǳ� �����Դϴ�.
if (!$mb[mb_id] || (sql_password($mb_password) != $mb[mb_password])) {
    alert("���Ե� ȸ���� �ƴϰų� �н����尡 Ʋ���ϴ�.\\n\\n�н������ ��ҹ��ڸ� �����մϴ�.");
}
// ���ܵ� ���̵��ΰ�?
if ($mb[mb_intercept_date] && $mb[mb_intercept_date] <= date("Ymd", $g4[server_time])) {
    $date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1�� \\2�� \\3��", $mb[mb_intercept_date]); 
    alert("ȸ������ ���̵�� ������ �����Ǿ� �ֽ��ϴ�.\\n\\nó���� : $date");
}
// Ż���� ���̵��ΰ�?
if ($mb[mb_leave_date] && $mb[mb_leave_date] <= date("Ymd", $g4[server_time])) {
    $date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1�� \\2�� \\3��", $mb[mb_leave_date]); 
    alert("Ż���� ���̵��̹Ƿ� �����Ͻ� �� �����ϴ�.\\n\\nŻ���� : $date");
}
//�α��� 10�� �ʰ� ���� ���� (��ǥ�� ��û) 151111
if( $mb['mb_today_login'] <= date("Y-m-d H:i:s", strtotime("-10 days")) ) {
    alert("������ �α������� 10���� �ʰ��Ͽ� \\n�����Ͻ� �� �����ϴ�.\\n\\n������ �α��� �Ͻ� : ".$mb['mb_today_login']."\\n\\n����� �����ٶ��ϴ�. 1544-4519");
}
/*
//���� ����
if ($config[cf_use_email_certify] && !preg_match("/[1-9]/", $mb[mb_email_certify])) {
    alert("���������� �����ž� �α��� �Ͻ� �� �ֽ��ϴ�.\\n\\nȸ������ �����ּҴ� $mb[mb_email] �Դϴ�.");
}
*/
if ($mb[mb_email_certify] == "0000-00-00 00:00:00") {
    alert("���� ȸ������ �� ������ ������ �ʿ��մϴ�. \\n������ 1544-4519 ���� �ٶ��ϴ�.");
}
/*
//�̿��� ����
if ($mb[mb_open] != 1) {
  alert($mb[mb_name]."(���̵�:".$mb[mb_id].") ����ڴ�\\n[�̿����� ��������ó����ħ]�� �����Ͽ� �ֽʽÿ�.");
}
*/
$member_skin_path = "$g4[path]/skin/member/$config[cf_member_skin]";
@include_once("$member_skin_path/login_check.skin.php");

// ȸ�����̵� ���� ����
set_session('erp_mb_id', $mb[mb_id]);
//echo $mb[mb_id];
//exit;

// 3.26
// ���̵� ��Ű�� �Ѵް� ����
if ($auto_login) {
    // 3.27
    // �ڵ��α��� ---------------------------
    // ��Ű �Ѵް� ����
    $key = md5($_SERVER[SERVER_ADDR] . $_SERVER[REMOTE_ADDR] . $_SERVER[HTTP_USER_AGENT] . $mb[mb_password]);
    set_cookie('ck_mb_id', $mb[mb_id], 86400 * 31);
    set_cookie('ck_auto', $key, 86400 * 31);
    // �ڵ��α��� end ---------------------------
} else {
    set_cookie('ck_mb_id', '', 0);
    set_cookie('ck_auto', '', 0);
}


if ($url) 
{
    $link = urldecode($url);
    // 2003-06-14 �߰� (�ٸ� �������� �Ѱ��ֱ� ����)
    if (preg_match("/\?/", $link))
        $split= "&"; 
    else
        $split= "?"; 

    // $_POST �迭�������� �Ʒ��� �̸��� ������ ���� �͸� �ѱ�
    foreach($_POST as $key=>$value) 
    {
				//id_save �߰�
        if ($key != "id_save" && $key != "mb_id" && $key != "mb_password" && $key != "x" && $key != "y" && $key != "url") 
        {
            $link .= "$split$key=$value";
            $split = "&";
        }
    }
} 
else
    $link = $g4[path];

//�α��� �� �ڵ� ��� üũ 160307
$id = $mb['mb_id'];
$type = "go";
$branch = $mb['mb_profile'];
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
	//alert("�̹� ��� üũ �Ǿ����ϴ�. (".$row_work['check_time'].")","work_go_leave_update.php");
	//exit;
} else {
	//����� üũ
	$sql_common = " branch = '$branch', user_id = '$id', type = '$work_code', check_time = '$now_time' ";
	$sql = " insert work_go_leave set $sql_common ";
	//echo $sql;
	sql_query($sql);
}
//echo $mb[mb_id];
//exit;
//������� ��ü �α��� �� �ڵ� ������������ �������� �̵� 160503
//if($id == "el1001") {
//������� ��ü : ����� ����, �ص����� ���̻� 160629
if($mb['mb_level'] == 2) {
	//��� ���¼������ ��ũ 160928
	if($mb['mb_id'] == 'saroon') goto_url("./kepco_dsm_list.php");
	else goto_url("./electric_charges_contractor.php");
	exit;
}
goto_url($link);
?>
