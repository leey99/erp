<?
$sub_menu = "200100";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

//�����Ͻ� ID �ʱ�ȭ
if(strlen($id) != 4) $id = "";
//���������
$sql_com = " select com_code from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
$row_com = sql_fetch($sql_com);
$com_code = $row_com[com_code];
//��������� �߰�
$sql_com_opt = " select * from com_list_gy_opt where com_code='$com_code' ";
$result_com_opt = sql_query($sql_com_opt);
$row_com_opt=mysql_fetch_array($result_com_opt);
//�ְ��ٷνð� DB
$sql_work_time = " select * from a4_work_time where com_code='$com_code' and sabun ='' ";
$result_work_time = sql_query($sql_work_time);
$row_work_time=mysql_fetch_array($result_work_time);
//echo $sql_work_time;

$sql_common = " from $g4[pibohum_base] ";

$sub_title = "������";
$g4[title] = $sub_title." : ������� : ".$easynomu_name;

$colspan = 11;

$sql1 = " select * from $g4[pibohum_base] where com_code='$code' and sabun='$id' ";
//echo $sql1;
$result1 = sql_query($sql1);

$sql2 = " select * from pibohum_base_opt where com_code='$code' and sabun='$id' ";
$result2 = sql_query($sql2);

$sql3 = " select * from pibohum_gg where com_code='$code' and sabun='$id' ";
$result3 = sql_query($sql3);

$sql4 = " select * from pibohum_base_opt2 where com_code='$code' and sabun='$id' ";
$result4 = sql_query($sql4);
//echo $sql4;
//exit;

if($w == "u") {
	$row1=mysql_fetch_array($result1);
	$row2=mysql_fetch_array($result2);
	$row3=mysql_fetch_array($result3);
	$row4=mysql_fetch_array($result4);
}
//�ֱٷνð� ����
if($row2[work_gbn] == "A" || $row2[work_gbn] == "")	{
	$work_gbn_checked = "A";
	$workhour_day_w = "40";
	$workhour_day_d = "8";
} else {
	$work_gbn_checked = "B";
	$workhour_day_w = "44";
	$workhour_day_d = "8";
}
//�ٷνð�(����) 1��
$check_worktime_d_yn = $row4[check_worktime_d_yn];
if($check_worktime_d_yn == "Y") {
	$workhour_day_d = $row4[workhour_day_d];
} else {
	$workhour_day_d = $row_work_time[workhour_day_d];
}
//�ٷνð�(����) 1��
$check_worktime_w_yn = $row4[check_worktime_w_yn];
if($check_worktime_w_yn == "Y") {
	$workhour_day_w = $row4[workhour_day_w];
	$workhour_ext_w = $row4[workhour_ext_w];
	$workhour_night_w = $row4[workhour_night_w];
	$workhour_hday_w = $row4[workhour_hday_w];
} else {
	$workhour_ext_w = $row_work_time[workhour_ext_w];
	$workhour_night_w = $row_work_time[workhour_night_w];
	$workhour_hday_w = $row_work_time[workhour_hday_w];
}
//�ٷνð�(����) 1����
$check_worktime_yn = $row4[check_worktime_yn];
if($check_worktime_yn == "Y") {
	$workhour_day = $row4[workhour_day];
	$workhour_ext = $row4[workhour_ext];
	$workhour_night = $row4[workhour_night];
	$workhour_hday = $row4[workhour_hday];
}
if($workhour_ext_w == "") $workhour_ext_w = 0;
if($workhour_night_w == "") $workhour_night_w = 0;
if($workhour_hday_w == "") $workhour_hday_w = 0;

if($row4[check_money_min_2014_yn] == "Y") {
	$check_money_min_2014_yn = $row4[check_money_min_2014_yn];
} else {
	$check_money_min_2014_yn = "N";
}
if($row4[check_money_min_yn] == "Y") {
	$check_money_min_yn = $row4[check_money_min_yn];
} else {
	$check_money_min_yn = "N";
}
//�����ӱ�(1�ð�)
/*
if($check_money_min_2014_yn == "Y") {
	//2014�� �����ñ�
	$money_min_time = 4860;
} else {
	$money_min_time = 5210;
}
*/
$money_min_time_2013 = 4860;
//2014 -> 2015 �����ñ� ����
$money_min_time_2014 = 5580;
$money_min_time = 6030;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px">
<script language="javascript">
// ���� �˻� Ȯ��
function del(page,id) 
{
	if(confirm("�����Ͻðڽ��ϱ�?")) {
		location.href = "4insure_delete.php?page="+page+"&id="+id;
	}
}
function goSearch() {
	var frm = document.searchForm;
	frm.action = "<?=$PHP_SELF?>";
	frm.submit();
	return;
}
function checkAddress(strgbn) {
	//var ret = window.open("./common/member_address.php?frm_name=dataForm&frm_zip1=adr_zip1&frm_zip2=adr_zip2&frm_addr1=adr_adr1&frm_addr2=adr_adr2", "address", "top=100, left=100, width=410,height=285, scrollbars");
	var ret = window.open("../road_address/search.php", "address", "width=496,height=522,scrollbars=0");
	return;
}
function displayPayGbn() {
	var f = document.dataForm;
	var frm = document.formSalary;
	if(f.pay_gbn[1].checked) {
		//�ñ���
		document.getElementById("decision").innerHTML = "���ؽñ�";
		document.getElementById("decision_txt").innerHTML = "���ؽñ�";
		document.getElementById("decision_div").style.display = "none";
		document.getElementById("decision_div2").style.display = "inline";
		document.getElementById("decision_reset").style.display = "none";
		document.getElementById("decision_reset2").style.display = "inline";
		frm.money_month_base.value = 0;
		//�⺻�� �ڵ�����
		frm.check_money_min_yn.checked = false;
		frm.check_money_min_yn.value = "N";
		document.getElementById('check_money_min_div').style.display = "none";
		frm.money_min.className = "textfm5";
		frm.money_min.readOnly = true;
		//�ӱ�����
		document.getElementById("money_minus_txt").style.display = "none";
		document.getElementById("money_minus_div").style.display = "none";		
	} else {
		//������
		document.getElementById("decision").innerHTML = "�����ӱ�";
		document.getElementById("decision_txt").innerHTML = "�����ӱ�";
		document.getElementById("decision_div").style.display = "inline";
		document.getElementById("decision_div2").style.display = "none";
		document.getElementById("decision_reset").style.display = "inline";
		document.getElementById("decision_reset2").style.display = "none";
		document.getElementById('check_money_min_div').style.display = "inline";
		//�ӱ�����
		document.getElementById("money_minus_txt").style.display = "";
		document.getElementById("money_minus_div").style.display = "";
	}
	document.getElementById("workday_month_text").style.display="none";
	document.getElementById("workday_week").style.display="none";
	f.workday_week.value = "5";
	changeWorkDayWeek();
	setWorkHour("all"); /////////////
	//alert(document.getElementById("money_month_base").style.display);
}
function changeWorkDayWeek() {
	var f = document.dataForm;
	var workday_month = "";
	var workday_week = toInt(f.workday_week.value);
	var workday_month_text = document.getElementById("workday_month_text");
	if( workday_week == 0 ) {
		workday_month = "";
		workday_month_text.innerHTML = "�̵��";
	}else{
		workday_month = workday_week * 4;
		workday_month_text.innerHTML = workday_week + "�ϱٷ�";
	}
	f.workday_month.value = workday_month;
	setWorkHour('base');
}
//��Ÿ���� �����ӱݿ��� ����
function money_e_exclude_fuc(obj) {
	//alert(obj.checked);
	if(obj.checked) obj.value = "Y";
	else obj.value = "N";
	setWorkHour();
}
function setPayBase() {
	var frm = document.dataForm;
	//alert(frm.pay_gbn[0].checked);
	if(frm.pay_gbn[0].checked || frm.pay_gbn[2].checked || frm.pay_gbn[3].checked){
		frm.money_month.value = document.formSalary.money_month.value; // �⺻(��)��
		frm.money_hour.value = ""; // ���ؽñ� 
		frm.money_min.value = document.formSalary.money_min.value; // �⺻��
		frm.workhour_day.value = document.formSalary.workhour_day.value; // �ٷνð� 
		frm.workhour_ext.value = document.formSalary.workhour_ext.value; // ����ٷνð� 
		frm.workhour_hday.value = document.formSalary.workhour_hday.value; // ���ϱٷνð� 
		frm.workhour_night.value = document.formSalary.workhour_night.value; // �߰��ٷνð� 
		frm.workhour_total.value = document.formSalary.workhour_total.value; // �ѱٷνð� 
		frm.week_hday.value = ""; // �����ϼ� 
		frm.year_hday.value = ""; // ���������ް��ϼ� 
		frm.money_g1.value = document.formSalary.money_g1.value; // ���������� 
		frm.money_g2.value = document.formSalary.money_g2.value; // ���������� 
		frm.money_g3.value = document.formSalary.money_g3.value; // ���������� 
		frm.money_g4.value = document.formSalary.money_g4.value; // ���������� 
		frm.money_g5.value = document.formSalary.money_g5.value; // ���������� 
		frm.money_b1.value = document.formSalary.money_b1.value; // �������� 
		frm.money_b2.value = document.formSalary.money_b2.value; // �������� 
		frm.money_b3.value = document.formSalary.money_b3.value; // �������� 
		frm.money_b4.value = document.formSalary.money_b4.value; // �������� 
		frm.money_b5.value = document.formSalary.money_b5.value; // ��������
		frm.money_e1.value = document.formSalary.money_e1.value; // ��Ÿ���� 
		frm.money_e2.value = document.formSalary.money_e2.value; // ��Ÿ���� 
		frm.money_e3.value = document.formSalary.money_e3.value; // ��Ÿ���� 
		frm.money_e4.value = document.formSalary.money_e4.value; // ��Ÿ���� 
		frm.money_e5.value = document.formSalary.money_e5.value; // ��Ÿ����
		frm.money_e6.value = document.formSalary.money_e6.value; // ��Ÿ���� 
		frm.money_e7.value = document.formSalary.money_e7.value; // ��Ÿ���� 
		frm.money_e8.value = document.formSalary.money_e8.value; // ��Ÿ����

		frm.workhour_day_w.value = document.formSalary.workhour_day_w.value; // 1�� �ٷνð� 
		frm.workhour_ext_w.value = document.formSalary.workhour_ext_w.value; // 1�� ����ٷνð� 
		frm.workhour_hday_w.value = document.formSalary.workhour_hday_w.value; // 1�� ���ϱٷνð� 
		frm.workhour_night_w.value = document.formSalary.workhour_night_w.value; // 1�� �߰��ٷνð� 
		frm.workhour_total_w.value = document.formSalary.workhour_total_w.value; // 1�� �ѱٷνð� 

		frm.workhour_day_d.value = document.formSalary.workhour_day_d.value; // 1�� �ٷνð� 
		frm.money_hour_ts.value = document.formSalary.money_hour_ts.value; // ����ӱ� (�ð���)
		//frm.money_hour_ds.value = document.formSalary.money_hour_ds.value; // ����ӱ� (�ð���)

		frm.money_min_base.value = document.formSalary.money_min_base.value; // �⺻�ñ�

		frm.workhour_total2.value = document.formSalary.workhour_total2.value; // 1���� �ѱٷνð�(�ٷΰ�༭��)
		frm.workhour_total3.value = document.formSalary.workhour_total3.value; // 1���� �ѱٷνð�(�ӱݻ����)

		frm.workhour_total2_w.value = document.formSalary.workhour_total2_w.value; // 1�� �ѱٷνð�(�ٷΰ�༭��)
		frm.workhour_total3_w.value = document.formSalary.workhour_total3_w.value; // 1�� �ѱٷνð�(�ӱݻ����)

		frm.money_year_yn.value = document.formSalary.money_year_yn.value; // �������� ���޿���
		frm.money_base.value = document.formSalary.money_base.value; // �⺻��
		frm.money_ext.value = document.formSalary.money_ext.value; // ����ٷμ���
		frm.money_hday.value = document.formSalary.money_hday.value; // ���ϱٷμ���
		frm.money_night.value = document.formSalary.money_night.value; // �߰��ٷμ���
		frm.workhour_year.value = document.formSalary.workhour_year.value; // �����ް� �ð�
		frm.money_year.value = document.formSalary.money_year.value; // ��������
		frm.money_month_base.value = document.formSalary.money_month_base.value; // �����޾�, ������ �⺻��+�������� ���� ���ʱݾ�
		frm.check_worktime_d_yn.value = document.formSalary.check_worktime_d_yn.checked ? "Y" : "N"; // 1�� �ٷνð� �����Է�
		frm.check_worktime_w_yn.value = document.formSalary.check_worktime_w_yn.checked ? "Y" : "N"; // 1�� �ٷνð� �����Է�
		frm.check_worktime_yn.value = document.formSalary.check_worktime_yn.checked ? "Y" : "N"; // 1���� �ٷνð� �����Է�
		frm.check_money_min_yn.value = document.formSalary.check_money_min_yn.checked ? "Y" : "N"; // �⺻�� �����Է�
		frm.check_money_min_2014_yn.value = document.formSalary.check_money_min_2014_yn.checked ? "Y" : "N"; // �⺻�� �����Է�
		frm.check_money_b_yn.value = document.formSalary.check_money_b_yn.checked ? "Y" : "N"; // �������� �����Է�
	} else if(frm.pay_gbn[1].checked) {
		//�ñ���
		frm.money_month.value = ""; // �⺻(��)�� 
		frm.money_hour.value = document.formSalary.money_hour.value; // ���ؽñ� 
		frm.money_min.value = document.formSalary.money_min.value; // �⺻��
		frm.workhour_day.value = document.formSalary.workhour_day.value; // �ٷνð� 
		frm.workhour_ext.value = document.formSalary.workhour_ext.value; // ����ٷνð� 
		frm.workhour_hday.value = document.formSalary.workhour_hday.value; // ���ϱٷνð� 
		frm.workhour_night.value = document.formSalary.workhour_night.value; // �߰��ٷνð� 
		frm.workhour_total.value = document.formSalary.workhour_total.value; // �ѱٷνð� 
		//frm.week_hday.value = document.formSalary.week_hday.value; // �����ϼ� 
		//frm.year_hday.value = document.formSalary.year_hday.value; // ���������ް��ϼ� 
		frm.week_hday.value = ""; // �����ϼ� 
		frm.year_hday.value = ""; // ���������ް��ϼ� 
		frm.money_g1.value = document.formSalary.money_g1.value; // ���������� 
		frm.money_g2.value = document.formSalary.money_g2.value; // ���������� 
		frm.money_g3.value = document.formSalary.money_g3.value; // ���������� 
		frm.money_g4.value = document.formSalary.money_g4.value; // ���������� 
		frm.money_g5.value = document.formSalary.money_g5.value; // ���������� 
		frm.money_b1.value = document.formSalary.money_b1.value; // �������� 
		frm.money_b2.value = document.formSalary.money_b2.value; // �������� 
		frm.money_b3.value = document.formSalary.money_b3.value; // �������� 
		frm.money_b4.value = document.formSalary.money_b4.value; // �������� 
		frm.money_b5.value = document.formSalary.money_b5.value; // ��������
		frm.money_e1.value = document.formSalary.money_e1.value; // ��Ÿ���� 
		frm.money_e2.value = document.formSalary.money_e2.value; // ��Ÿ���� 
		frm.money_e3.value = document.formSalary.money_e3.value; // ��Ÿ���� 
		frm.money_e4.value = document.formSalary.money_e4.value; // ��Ÿ���� 
		frm.money_e5.value = document.formSalary.money_e5.value; // ��Ÿ����
		frm.money_e6.value = document.formSalary.money_e6.value; // ��Ÿ���� 
		frm.money_e7.value = document.formSalary.money_e7.value; // ��Ÿ���� 
		frm.money_e8.value = document.formSalary.money_e8.value; // ��Ÿ����
		frm.workhour_day_w.value = document.formSalary.workhour_day_w.value; // 1�� �ٷνð� 
		frm.workhour_ext_w.value = document.formSalary.workhour_ext_w.value; // 1�� ����ٷνð� 
		frm.workhour_hday_w.value = document.formSalary.workhour_hday_w.value; // 1�� ���ϱٷνð� 
		frm.workhour_night_w.value = document.formSalary.workhour_night_w.value; // 1�� �߰��ٷνð� 
		frm.workhour_total_w.value = document.formSalary.workhour_total_w.value; // 1�� �ѱٷνð� 

		frm.workhour_day_d.value = document.formSalary.workhour_day_d.value; // 1�� �ٷνð� 
		frm.money_hour_ts.value = document.formSalary.money_hour_ts.value; // ����ӱ� (�ð���)
		//frm.money_hour_ds.value = document.formSalary.money_hour_ds.value; // ����ӱ� (�ð���)

		frm.money_min_base.value = document.formSalary.money_min_base.value; // �⺻�ñ�

		frm.workhour_total2.value = document.formSalary.workhour_total2.value; // 1���� �ѱٷνð�(�ٷΰ�༭��)
		frm.workhour_total3.value = document.formSalary.workhour_total3.value; // 1���� �ѱٷνð�(�ӱݻ����)

		frm.workhour_total2_w.value = document.formSalary.workhour_total2_w.value; // 1�� �ѱٷνð�(�ٷΰ�༭��)
		frm.workhour_total3_w.value = document.formSalary.workhour_total3_w.value; // 1�� �ѱٷνð�(�ӱݻ����)

		frm.money_year_yn.value = ""; // �������� ���޿���
		frm.money_base.value = document.formSalary.money_base.value; // �⺻��
		frm.money_ext.value = document.formSalary.money_ext.value; // ����ٷμ���
		frm.money_hday.value = document.formSalary.money_hday.value; // ���ϱٷμ���
		frm.money_night.value = document.formSalary.money_night.value; // �߰��ٷμ���
		frm.workhour_year.value = ""; // �����ް� �ð�
		frm.money_year.value = ""; // ��������
		frm.money_month_base.value = document.formSalary.money_total_sum.value; // �����޾�, ������ �⺻��+�������� ���� ���ʱݾ�
		frm.check_worktime_d_yn.value = document.formSalary.check_worktime_d_yn.checked ? "Y" : "N"; // 1�� �ٷνð� �����Է�
		frm.check_worktime_w_yn.value = document.formSalary.check_worktime_w_yn.checked ? "Y" : "N"; // 1�� �ٷνð� �����Է�
		frm.check_worktime_yn.value = document.formSalary.check_worktime_yn.checked ? "Y" : "N"; // 1���� �ٷνð� �����Է�
		frm.check_money_min_yn.value = document.formSalary.check_money_min_yn.checked ? "Y" : "N"; // �⺻�� �����Է�
		frm.check_money_min_2014_yn.value = document.formSalary.check_money_min_2014_yn.checked ? "Y" : "N"; // �⺻�� �����Է�
		frm.check_money_b_yn.value = document.formSalary.check_money_b_yn.checked ? "Y" : "N"; // �������� �����Է�
	} else {
		frm.money_month.value = "";
		frm.money_hour.value = "";
		frm.workhour_day.value = "";
		frm.workhour_ext.value = "";
		frm.workhour_hday.value = "";
		frm.workhour_night.value = "";
		frm.workhour_total.value = ""; // �ѱٷνð�
		frm.week_hday.value = "";
		frm.year_hday.value = "";
		frm.money_g1.value = "";
		frm.money_g2.value = "";
		frm.money_g3.value = "";
		frm.money_b1.value = "";
		frm.money_b2.value = "";
		frm.money_b3.value = "";
		frm.workhour_day_w.value = "";
		frm.workhour_ext_w.value = "";
		frm.workhour_hday_w.value = "";
		frm.workhour_night_w.value = "";
		frm.workhour_total_w.value = "";

		frm.workhour_day_d.value = ""; // 1�� �ٷνð� 
		frm.money_hour_ts.value = ""; // ����ӱ� (�ð���)
		//frm.money_hour_ds.value = ""; // ����ӱ� (�ϱ�)

		frm.money_min_base.value = ""; // �⺻�ñ�

		frm.workhour_total2.value = ""; // 1���� �ѱٷνð�(�ٷΰ�༭��)
		frm.workhour_total3.value = ""; // 1���� �ѱٷνð�(�ӱݻ����)

		frm.workhour_total2_w.value = ""; // 1�� �ѱٷνð�(�ٷΰ�༭��)
		frm.workhour_total3_w.value = ""; // 1�� �ѱٷνð�(�ӱݻ����)

		frm.money_year_yn.value = ""; // �������� ���޿���
		frm.money_base.value = ""; // �⺻��
		frm.money_ext.value = ""; // ����ٷμ���
		frm.money_hday.value = ""; // ���ϱٷμ���
		frm.money_night.value = ""; // �߰��ٷμ���
		frm.workhour_year.value = ""; // �����ް� �ð�
		frm.money_year.value = ""; // ��������
		frm.money_month_base.value = ""; // �����޾�, ������ �⺻��+�������� ���� ���ʱݾ�
		frm.check_worktime_yn.value = "N"; // �ٷνð� �����Է�
	}
}

function setWorkHour( type, base_gn ) {
	if(document.dataForm.pay_gbn[1].checked) {
		setWorkHour_Parttime( type, money_min_time );
		return;
	}
	if(document.formSalary.check_money_min_2014_yn.checked) {
		money_min_time = <?=$money_min_time_2014?>;
	} else {
		money_min_time = <?=$money_min_time?>;
	}
	//alert(type);
	if(type==undefined) type = "";

	var workday_month = toInt(document.dataForm.workday_month.value); // �Ϲ����� 1���� �ٹ��ϼ�
	var workday_week = workday_month / 4 ; // �Ϲ����� �ְ� �ٷ��ϼ�

	var emp5_gbn = "";
	var rate_ext, rate_hday, rate_night;
	if( emp5_gbn == "1" ){ // 5������
		rate_ext = 1;
		rate_hday = 1;
		rate_night = 1;
	}else{
/*
		rate_ext = 1.5;
		rate_hday = 1.5;
		rate_night = 0.5;
*/
<?
//�⺻����
$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='b1' ";
$row_paycode = sql_fetch($sql_paycode);
if($row_paycode[multiple]) {
	$rate_ext = $row_paycode[multiple];
} else {
	$rate_ext = 1.5;
}
//�߰��ٷ�
$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='b2' ";
$row_paycode = sql_fetch($sql_paycode);
if($row_paycode[multiple]) {
	$rate_night = $row_paycode[multiple];
} else {
	$rate_night = 2;
}
//���ϱٷ�
$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='b3' ";
$row_paycode = sql_fetch($sql_paycode);
if($row_paycode[multiple]) {
	$rate_hday = $row_paycode[multiple];
} else {
	$rate_hday = 1.5;
}
?>
		rate_ext = <?=$rate_ext?>;
		rate_night = <?=$rate_night?>;
		rate_hday = <?=$rate_hday?>;
	}
	//�����ñ� ����
	//alert(document.dataForm.money_min_time.value);
	var money_min_time = toInt(document.dataForm.money_min_time.value);
	//alert(money_min_time);
	//�ڹٽ�ũ��Ʈ ���� ó��
	var f = document.formSalary;
	var money_month, money_month_base, money_month_base_view, money_minus, money_min;
	var money_g_sum, money_g1, money_g2, money_g3, money_g4, money_g5;
	var money_b_sum, money_b1, money_b2, money_b3, money_b4, money_b5;
	var money_e_sum, money_e1, money_e2, money_e3, money_e4, money_e5;
	var workhour_day_d, money_month_minus;
	var workhour_day, workhour_ext, workhour_hday, workhour_night, workhour_total, workhour_total2, workhour_total3;
	var workhour_day_w, workhour_ext_w, workhour_hday_w, workhour_night_w, workhour_total_w, workhour_total2_w, workhour_total3_w;
	//�����ӱ� ����
	//alert(f.money_e_exclude.value);
	//money_month = toInt(f.money_month.value); // �⺻����
	money_g1 = toInt(f.money_g1.value); // ����������1
	money_g2 = toInt(f.money_g2.value); // ����������2
	money_g3 = toInt(f.money_g3.value); // ����������3
	money_g4 = toInt(f.money_g4.value); // ����������4
	money_g5 = toInt(f.money_g5.value); // ����������5

	money_b1 = toInt(f.money_b1.value); // ��������1
	money_b2 = toInt(f.money_b2.value); // ��������2
	money_b3 = toInt(f.money_b3.value); // ��������3
	money_b4 = toInt(f.money_b4.value); // ��������4
	money_b5 = toInt(f.money_b5.value); // ��������5

	money_e1 = toInt(f.money_e1.value); // ���������1
	money_e2 = toInt(f.money_e2.value); // ���������2
	money_e3 = toInt(f.money_e3.value); // ���������3
	money_e4 = toInt(f.money_e4.value); // ���������4
	money_e5 = toInt(f.money_e5.value); // ���������5
	money_e6 = toInt(f.money_e6.value); // ���������6
	money_e7 = toInt(f.money_e7.value); // ���������7
	money_e8 = toInt(f.money_e8.value); // ���������8

	// ������ �⺻��+�������� ----------------------------------
	money_month_base_view = toInt(f.money_month_base_view.value);
	money_month_base = toInt(f.money_month_base.value); // �����޾�, ������ �⺻��+�������� ���� ���ʱݾ�
	//if(money_month_base == money_month_base) money_month_base = money_month_base_view;
	if(base_gn == "1") {
		money_month_base = money_month_base_view;
		f.money_month_base.value = money_month_base_view;
	}
	
	//money_month = money_month_base -money_g1 -money_g2 -money_g3 -money_g4 -money_g5 -money_b1 -money_b2 -money_b3 -money_b4 -money_b5;
	//alert(money_month_base+" - "+money_g1+" - "+money_g2+" - "+money_g3+" - "+money_g4+" - "+money_g5+" - "+money_b1+" - "+money_b2+" - "+money_b3+" - "+money_b4+" - "+money_b5);

	//����ӱ�/��������
	money_g_sum = money_g1 +money_g2 +money_g3 +money_g4 +money_g5;
	money_b_sum = money_b1 +money_b2 +money_b3 +money_b4 +money_b5;
	//����ӱ� �հ�
	//money_g_sum = money_g1 +money_g2 +money_g3 +money_g4 +money_g5;
	//alert(money_g_sum);

	//��Ÿ���� ����
	if(f.money_e1_gy.value != "Y") {
		money_e1 = 0;
	}
	if(f.money_e2_gy.value != "Y") {
		money_e2 = 0;
	}
	if(f.money_e3_gy.value != "Y") {
		money_e3 = 0;
	}
	if(f.money_e4_gy.value != "Y") {
		money_e4 = 0;
	}
	if(f.money_e5_gy.value != "Y") {
		money_e5 = 0;
	}
	if(f.money_e6_gy.value != "Y") {
		money_e6 = 0;
	}
	if(f.money_e7_gy.value != "Y") {
		money_e7 = 0;
	}
	if(f.money_e8_gy.value != "Y") {
		money_e8 = 0;
	}
	//��Ÿ���� �հ�
	money_e_sum = money_e1 + money_e2 + money_e3 + money_e4 + money_e5 + money_e6 + money_e7 + money_e8;
	//alert(money_e_sum);

	if(f.money_e_exclude.value != "Y") {
		money_month = money_month_base - money_g_sum - money_b_sum - money_e_sum;
		f.money_month_minus.value = 0;
	} else {
		money_month = money_month_base - money_g_sum - money_b_sum;
		f.money_month_minus.value = setComma( money_e_sum );
	}
	//money_month = money_month_base;
	f.money_month.value = setComma( money_month );

	//���,����,��Ÿ �հ�
	f.money_g_sum.value = setComma( money_g_sum );
	f.money_b_sum.value = setComma( money_b_sum );
	f.money_e_sum.value = setComma( money_e_sum );

	if( f.check_worktime_yn.checked ) { // �����Է�

		workhour_day_d = toFloat(f.workhour_day_d.value);
		//1�� �ٷνð� �����Է� üũ ���� 1�� �ٷνð� �ڵ� ��� 150903
		if(!f.check_worktime_w_yn.checked) workhour_day_w = workhour_day_d*5;
		else workhour_day_w = toFloat(f.workhour_day_w.value);
		workhour_ext_w = toFloat(f.workhour_ext_w.value);
		workhour_hday_w = toFloat(f.workhour_hday_w.value);
		workhour_night_w = toFloat(f.workhour_night_w.value);

		//workhour_day_w = workhour_day_d * workday_week;
		f.workhour_day_w.value = workhour_day_w;
		workhour_day = toFloat(f.workhour_day.value);
		workhour_ext = toFloat(f.workhour_ext.value);
		workhour_hday = toFloat(f.workhour_hday.value);
		workhour_night = toFloat(f.workhour_night.value);

	} else {

		workhour_day_d = toFloat(f.workhour_day_d.value);
		//1�� �ٷνð� �����Է� üũ ���� 1�� �ٷνð� �ڵ� ��� 150903
		if(f.check_worktime_d_yn.checked) workhour_day_w = workhour_day_d*5;
		else workhour_day_w = toFloat(f.workhour_day_w.value);
		workhour_ext_w = toFloat(f.workhour_ext_w.value);
		workhour_hday_w = toFloat(f.workhour_hday_w.value);
		workhour_night_w = toFloat(f.workhour_night_w.value);
		workhour_total_w = 0;
		//month_calc = 365*12*7;
		month_calc = 4.3452;
		//month_calc = 4.345238095238095;

		var workhour_day_d_limit = workhour_day_d; // 1�ϼ����ٷνð� max 8 �� ����
		if( workhour_day_d_limit > 8 ) workhour_day_d_limit = 8;

		f.workhour_day_w.value = workhour_day_w;
		workhour_day = Math.round( ( workhour_day_w + workhour_day_d_limit ) * month_calc  );
		//alert("�����ٷνð�(1����) : ( "+workhour_day_w+" + "+workhour_day_d_limit+" ) * "+month_calc);

		//workhour_day = Math.round( ( workhour_day_d*workday_week + workhour_day_d_limit ) * month_calc  );
		f.workhour_day.value = workhour_day;

		workhour_ext = parseInt( workhour_ext_w * month_calc *100 ) / 100;
		//alert(workhour_ext);
		f.workhour_ext.value = workhour_ext;

		workhour_hday = parseInt( workhour_hday_w * month_calc *100 ) / 100;
		f.workhour_hday.value = workhour_hday;

		workhour_night = parseInt( workhour_night_w * month_calc *100 ) / 100;
		f.workhour_night.value = workhour_night;

		workhour_day = toFloat(f.workhour_day.value);
		workhour_ext = toFloat(f.workhour_ext.value);
		workhour_hday = toFloat(f.workhour_hday.value);
		workhour_night = toFloat(f.workhour_night.value);
	}

	//�ѱٷνð�
	workhour_total = parseInt( ( workhour_day + (workhour_ext*rate_ext) + (workhour_night*rate_night) + (workhour_hday*rate_hday) ) * 1000 ) / 1000; // �߰��ٷμ��� ���� -----------
	//alert(workhour_total+"="+workhour_day+"+("+workhour_ext+"*"+rate_ext+")+("+workhour_night+"*"+rate_night+")+("+workhour_hday+"*"+rate_hday+")");
	workhour_total = Math.round(workhour_total*100)/100;
	workhour_total_w = parseInt( ( workhour_day_w + workhour_ext_w*rate_ext + workhour_hday_w*rate_hday + workhour_night_w*rate_night ) * 1000 ) / 1000;

	//�ѱٷνð�(�ٷΰ�༭��)
	workhour_total2 = parseInt( ( workhour_day + workhour_ext + workhour_hday ) * 1000 ) / 1000;
	workhour_total2_w = parseInt( ( workhour_day_w + workhour_ext_w + workhour_hday_w ) * 1000 ) / 1000;

	//�ѱٷνð�(�ӱݻ����)
	//workhour_total3 = parseInt( ( workhour_day + workhour_ext*rate_ext + workhour_hday*rate_hday + workhour_night*rate_night ) * 1000 ) / 1000;
	workhour_total3 = parseInt( ( workhour_day ) * 1000 ) / 1000;
	//workhour_total3_w = parseInt( ( workhour_day_w + workhour_ext_w*rate_ext + workhour_hday_w*rate_hday + workhour_night_w*rate_night ) * 1000 ) / 1000;
	workhour_total3_w = parseInt( ( workhour_day_w ) * 1000 ) / 1000;
	//alert("( ( "+workhour_day+" + "+workhour_ext+" * "+rate_ext+" + "+workhour_hday+" * "+rate_hday+" + "+workhour_night+" * "+rate_night+" ) * 1000 ) / 1000");

	//����ӱ�(�ð���)
	//money_hour_ts = (money_month+money_g1+money_g2+money_g3) / workhour_total3;
	//if( isNaN(money_hour_ts) ) money_hour_ts = 0;
	//alert("("+money_month+"+"+money_g1+"+"+money_g2+"+"+money_g3+") / "+workhour_total3);

	//����ӱ�(�ϱ�)
	//money_hour_ds = (money_month+money_g1+money_g2+money_g3) / workhour_total3 * workhour_day_d;
	//if( isNaN(money_hour_ds) ) money_hour_ds = 0;

	//�⺻�ñ�
	//money_hour_ts = Math.round(money_month / workhour_total3);
	//money_hour_ts = Math.round( (money_month + money_g_sum) / workhour_total3);
	//����ӱ�(�ñ�)
	money_min = toInt(f.money_min.value);
	//alert(money_min);
	money_hour_ts = Math.round( (money_min + money_g_sum) / workhour_total3);
	//alert(money_hour_ts);
	//alert("�⺻�ñ� : "+money_month+" + "+money_g_sum+" / "+workhour_total3);
	//alert(money_hour_ts+"=("+money_min+"+"+money_g_sum+")/"+workhour_total3);
	if( isNaN(money_hour_ts) ) money_hour_ts = 0;
	//alert("("+money_month+") / "+workhour_total3);
	//�⺻�ϱ�
	//money_hour_ds = (money_month) / workhour_total3 * workhour_day_d;
	//if( isNaN(money_hour_ds) ) money_hour_ds = 0;

	//�������� ���޿��� ----------------------
	var money_year_yn = f.money_year_yn.value; // �������� ���޿���
	var workhour_year = 0; // �����ް� �ð�
	var money_year = 0; // ��������
/*
	if( money_year_yn == "Y" ) {

		//�ӱݻ��� �ѽð� ����
		workhour_total3 = parseInt( ( workhour_day + workhour_ext*rate_ext + workhour_hday*rate_hday + workhour_night*rate_night+ workhour_day_d*1.25 ) * 1000 ) / 1000;

		//����ӱ�(�ð���)
		money_hour_ts = (money_month+money_g1+money_g2+money_g3) / workhour_total3;
		if( isNaN(money_hour_ts) ) money_hour_ts = 0;

		//����ӱ�(�ϱ�)
		money_hour_ds = (money_month+money_g1+money_g2+money_g3) / workhour_total3;
		if( isNaN(money_hour_ds) ) money_hour_ds = 0;

		workhour_year = parseInt( workhour_day_d * 1.25 * 10 ) / 10;
		money_year = Math.round( workhour_day_d * 1.25 * money_hour_ts );
	}
*/
	var money_base = 0; // �⺻��
	var money_ext = 0; // ����ٷμ���
	var money_hday = 0; // ���ϱٷμ���
	var money_night = 0; // �߰��ٷμ���
	//var money_min = 0; //�����ӱ�(1����)

	money_ext = Math.round( money_hour_ts * rate_ext * workhour_ext );
	//alert("����ٷμ��� : "+money_hour_ts+" * "+rate_ext+" * "+workhour_ext);
	//alert(money_ext);
	money_hday = Math.round( money_hour_ts * rate_hday * workhour_hday );
	money_night = Math.round( money_hour_ts * rate_night * workhour_night );
	//money_base = money_month - money_ext - money_hday - money_night - money_year;
	money_base = money_month + money_b1 + money_b2 + money_b3 + money_b4 + money_b5;


	f.workhour_total.value = workhour_total;
	f.workhour_total_w.value = workhour_total_w;

	f.workhour_total2.value = workhour_total2;
	f.workhour_total2_w.value = workhour_total2_w;

	f.workhour_total3.value = workhour_total3;
	f.workhour_total3_w.value = workhour_total3_w;

	//�⺻�ñ� õ���� �޸�
	f.money_hour_ts.value = money_hour_ts;
	f.money_hour_ts_view.value = setComma( parseInt(money_hour_ts) );

	//�⺻�ϱ� õ���� �޸�
	//f.money_hour_ds.value = setComma( parseInt(money_hour_ds) );

	//�����ӱ�(1�ð�) ���� ������ ǥ��
	//alert(f.money_min_time.value);
	//alert(money_hour_ts+" <?=$money_min_time?>");
	if(money_hour_ts < money_min_time) {
		f.money_hour_ts_view.style.fontWeight = "bold";
		f.money_hour_ts_view.style.color = "red";
		//document.getElementById('').style.color = "red";
		//alert(f.money_hour_ts.style.color);
		//alert("����ӱ�(�ð���) : "+money_hour_ts);
		//alert(f.money_hour_ts.name);
	} else {
		f.money_hour_ts_view.style.fontWeight = "normal";
		f.money_hour_ts_view.style.color = "black";
	}

	// �ּ��ӱ� ���رݾ�
	//alert(f.check_money_min_yn.value);
	if(f.check_money_min_yn.value == "Y") {
		money_min = toInt(f.money_min.value);
		f.money_min.value = setComma( money_min );
	} else {
		//money_min = toInt(workhour_total3 * money_min_time);
		//�⺻�� �ڵ� ���(�����ӱ� - ������) 150625
		money_min = toInt(money_month_base - (money_g_sum + money_b_sum + money_e_sum));
		//alert(money_min);
		f.money_min.value = setComma( money_min );
	}
	//money_min_time = toInt(workhour_total3 * <?=$money_min_time?>) / workhour_total3;
	//alert("("+workhour_total3+" * "+"<?=$money_min_time?>) / "+workhour_total3);

	//�����ӱ�(1����) ���� ������ ǥ��
	//alert(money_month+" < "+money_min);
	//if(money_month < money_min) {
	if(money_hour_ts < money_min_time) {
		f.money_month.style.fontWeight = "bold";
		f.money_month.style.color = "red";
		//document.getElementById('').style.color = "red";
		//alert(f.money_hour_ts.style.color);
		//alert("����ӱ�(�ð���) : "+money_hour_ts);
		//alert(f.money_hour_ts.name);
		getId('base_down').style.display = "";
	} else {
		f.money_month.style.fontWeight = "normal";
		f.money_month.style.color = "black";
		getId('base_down').style.display = "none";
	}

	//f.money_min_time.value = setComma( toInt(workhour_total3 * <?=$money_min_time?>) / workhour_total3 );
	f.money_min_time.value = setComma( money_min_time );

	f.workhour_year.value = workhour_year;
	f.money_year.value = setComma( money_year );
	f.money_base.value = setComma( money_base );
	f.money_ext.value = setComma( money_ext );
	f.money_hday.value = setComma( money_hday );
	f.money_night.value = setComma( money_night );
	// ��������(����) �ڵ� �Է�
	if(f.check_money_b_yn.checked == false) {
		f.money_b1.value = setComma( money_ext );
		f.money_b2.value = setComma( money_night );
		f.money_b3.value = setComma( money_hday );
	}
	//�������� �� ���� ���� 131219
	//f.money_b4.value = setComma( money_year );
	//�ӱ�����
	money_minus = money_month-money_min;
	//money_minus = money_month_base-(money_month + money_g_sum + money_b_sum + money_e_sum);
	f.money_minus.value = setComma( money_minus );
	if(money_month < money_min) {
		f.money_minus.style.fontWeight = "bold";
		f.money_minus.style.color = "red";
	} else {
		f.money_minus.style.fontWeight = "normal";
		f.money_minus.style.color = "black";
	}
	//���հ�
	//f.money_total_sum.value = setComma(money_month + money_g_sum + money_b_sum + money_e_sum);
	f.money_total_sum.value = setComma(money_min + money_g_sum + money_b_sum + money_e_sum);
	//f.money_month_minus.value = setComma(money_month_base-money_month_base_view);
	money_month_minus = money_min-money_month;
	if(money_month_minus < 0) {
		f.money_month_minus.style.color = "red";
		getId('money_month_minus_text').innerHTML = "("+setComma(-money_month_minus)+"�� �����մϴ�.)";
	} else if(money_month_minus == 0) {
		f.money_month_minus.style.color = "black";
		getId('money_month_minus_text').innerHTML = "(�ӱ������� �����ϴ�.)";
	} else {
		f.money_month_minus.style.color = "red";
		getId('money_month_minus_text').innerHTML = "("+setComma(money_month_minus)+"�� �ʰ��Դϴ�.)";
	}
	f.money_month_minus.value = setComma(money_min-money_month);
	//�⺻�ñ�
	f.money_min_base.value = setComma(parseInt(Math.round(money_min/workhour_day)));
}

//�����ӱ�(1����) �����ݾ� ����
function money_min_set() {
	var f = document.formSalary;
	//alert(f.money_min.value);
	f.money_month_base.value = f.money_min.value;
	setWorkHour();
}
//�ӱ����� �����ݾ� ����
function money_minus_set() {
	var f = document.formSalary;
	//alert(f.money_min.value);
	money_month_base_view = toInt(f.money_month_base_view.value);
	money_month_base = toInt(f.money_month_base.value);
	money_minus = toInt(f.money_minus.value);
	money_minus = eval(-money_minus);
	f.money_month_base.value = setComma(money_month_base+money_minus);
	//f.money_month_minus.value = setComma(money_month_base_view-money_month_base);
	setWorkHour();
}
function changeMoneyYearYn(){
	var f = document.formSalary;
	var emp5_gbn = "";
	var text = "";
	if( f.money_year_yn.value == "Y" ){
		if( emp5_gbn == "1" ){
			text = "<b> = �����ٷνð� + ����ٷνð� + ���ϱٷνð� + �߰��ٷνð� + 1�� �����ٷνð� * 1.25</b>";
		}else{
			text = "<b> = �����ٷνð� + ����ٷνð�*1.5 + ���ϱٷνð�*1.5 + �߰��ٷνð�*0.5 + 1�� �����ٷνð� * 1.25</b> ";
		}
	}else{
		if( emp5_gbn == "1" ){
			text = "<b> = �����ٷνð� + ����ٷνð� + ���ϱٷνð� + �߰��ٷνð�</b>";
		}else{
			text = "<b> = �����ٷνð� + ����ٷνð�*1.5 + ���ϱٷνð�*1.5 + �߰��ٷνð�*0.5</b> ";
		}
	}
	//document.getElementById("workhour_total3_text").innerHTML = text;
}
//�󿩱� �����Է�
function checkBonus_MoneyYn() {
	var f = document.dataForm;
	var className = "textfm5";
	var readOnly = true;
	if( f.check_bonus_money_yn.checked ) {
		className = "textfm";
		readOnly = false;
		document.getElementById('bonus_money').style.display="inline";
		document.getElementById('bonus_standard').style.display="none";
	}else{
		className = "textfm5";
		readOnly = true;
		document.getElementById('bonus_money').style.display="none";
		document.getElementById('bonus_standard').style.display="inline";
	}
	f.money_min.className = className;
	f.money_min.readOnly = readOnly;
	var obj = f.check_bonus_money_yn;
	if(obj.checked) obj.value = "Y";
	else obj.value = "N";
}
//1�� �ٷνð� �����Է�
function checkWorkTime_dYn() {
	var f = document.formSalary;
	var className = "textfm5";
	var readOnly = true;
	if( f.check_worktime_d_yn.checked ) {
		className = "textfm";
		readOnly = false;
	}else{
		f.workhour_day_d.value = 8;
		if(!f.check_worktime_w_yn.checked) f.workhour_day_w.value = 40;
		if(!f.check_worktime_yn.checked) f.workhour_day.value = 209;
		//setWorkHour('day');
		className = "textfm5";
		readOnly = true;
	}
	f.workhour_day_d.className = className;
	f.workhour_day_d.readOnly = readOnly;
}
//1�� �ٷνð� �����Է�
function checkWorkTime_wYn() {
	var f = document.formSalary;

	var className = "textfm5";
	var readOnly = true;
	if( f.check_worktime_w_yn.checked ) {
		className = "textfm";
		readOnly = false;
	}else{
		setWorkHour('day');
		className = "textfm5";
		readOnly = true;
	}
	f.workhour_day_w.className = className;
	f.workhour_ext_w.className = className;
	f.workhour_hday_w.className = className;
	f.workhour_night_w.className = className;

	f.workhour_day_w.readOnly = readOnly;
	f.workhour_ext_w.readOnly = readOnly;
	f.workhour_hday_w.readOnly = readOnly;
	f.workhour_night_w.readOnly = readOnly;
}
//1���� �ٷνð� �����Է�
function checkWorkTimeYn() {
	var f = document.formSalary;

	var className = "textfm5";
	var readOnly = true;
	if( f.check_worktime_yn.checked ) {
		className = "textfm";
		readOnly = false;
	}else{
		setWorkHour();
		className = "textfm5";
		readOnly = true;
	}
	f.workhour_day.className = className;
	f.workhour_ext.className = className;
	f.workhour_hday.className = className;
	f.workhour_night.className = className;

	f.workhour_day.readOnly = readOnly;
	f.workhour_ext.readOnly = readOnly;
	f.workhour_hday.readOnly = readOnly;
	f.workhour_night.readOnly = readOnly;
}
//�⺻�ñ� ���� �Է�
function checkMoney_Hour_TsYn() {
	var f = document.formSalary;

	var className = "textfm5";
	var readOnly = true;
	if( f.check_money_hour_ts_yn.checked ) {
		className = "textfm";
		readOnly = false;
	}else{
		className = "textfm5";
		readOnly = true;
	}
	f.money_hour_ts_view.className = className;
	f.money_hour_ts_view.readOnly = readOnly;
}
//�⺻��(�ӱ����� ��) ���� �Է�
function checkMoney_MonthYn() {
	var f = document.formSalary;

	var className = "textfm5";
	var readOnly = true;
	if( f.check_money_month_yn.checked ) {
		className = "textfm";
		readOnly = false;
	}else{
		className = "textfm5";
		readOnly = true;
	}
	f.money_month.className = className;
	f.money_month.readOnly = readOnly;
}
//�⺻�ñ�(2014) ���� �Է�
function checkMoney_Min2014Yn(money) {
	var f = document.formSalary;
	var frm = document.dataForm;
	var obj = f.check_money_min_2014_yn;
	if(obj.checked) {
		obj.value = "Y";
		f.money_min_time.value = money;
		frm.money_min_time.value = money;
		//alert(f.money_min_time.value);
	}else{
		obj.value = "N";
		f.money_min_time.value = "<?=number_format($money_min_time)?>";
		frm.money_min_time.value = "<?=number_format($money_min_time)?>";
	}
/*
	var obj2 = f.check_money_min_yn;
	obj2.value = "N";
	obj2.checked = false;
	document.getElementById('check_money_min_bt').style.display="none";
	f.money_min.className = "textfm5";
	f.money_min.readOnly = true;
*/
	//alert(obj.value);
	setWorkHour();
	setWorkHour();
}
//�⺻�� ���� �Է�
function checkMoney_MinYn() {
	var f = document.formSalary;

	var className = "textfm5";
	var readOnly = true;
	if( f.check_money_min_yn.checked ) {
		className = "textfm";
		readOnly = false;
		document.getElementById('check_money_min_bt').style.display="inline";
	}else{
		className = "textfm5";
		readOnly = true;
		document.getElementById('check_money_min_bt').style.display="none";
	}
	f.money_min.className = className;
	f.money_min.readOnly = readOnly;
	var obj = f.check_money_min_yn;
	if(obj.checked) obj.value = "Y";
	else obj.value = "N";
}
//�������� ���� �Է�
function checkMoney_bYn() {
	var f = document.formSalary;

	var className = "textfm5";
	var readOnly = true;
	if( f.check_money_b_yn.checked ) {
		className = "textfm";
		readOnly = false;
	}else{
		className = "textfm5";
		readOnly = true;
	}
	f.money_b1.className = className;
	f.money_b1.readOnly = readOnly;
	f.money_b2.className = className;
	f.money_b2.readOnly = readOnly;
	f.money_b3.className = className;
	f.money_b3.readOnly = readOnly;
	var obj = f.check_money_b_yn;
	if(obj.checked) obj.value = "Y";
	else obj.value = "N";
}
function checkData() {
	var frm = document.dataForm;
	if (frm.emp_name.value == "") {
		alert("������ �Է��ϼ���.");
		frm.emp_name.focus();
		return;
	}
	if (frm.emp_ssnb1.value == "") {
		alert("�ֹι�ȣ�� �Է��ϼ���.");
		frm.emp_ssnb1.focus();
		return;
	}
	if (frm.emp_ssnb2.value == "") {
		alert("�ֹι�ȣ�� �Է��ϼ���.");
		frm.emp_ssnb2.focus();
		return;
	}
	if(frm.foreign_gbn[0].checked) {
		//alert(frm.foreign_gbn[0].checked);
		//return;
		//�ֹε�Ϲ�ȣ �˻�
		var key = "234567892345";           
		var keyarray = new Array();
		var per_numarray = new Array();
		var sum=0;
		per_num = frm.emp_ssnb1.value+""+frm.emp_ssnb2.value;
		if (per_num.length != 13) {            //�ֹι�ȣ 13�ڸ� ���� ó��
			alert("�ֹε�Ϲ�ȣ�� �߸� �Է� �Ǿ����ϴ�.");
			frm.emp_ssnb1.value = "";
			frm.emp_ssnb2.value = "";
			frm.emp_ssnb1.focus();
			return;
		}
		for (var i=0;i<=12 ;i++ ) {
			keyarray[i] = key.substr(i,1);         //��Ű���� �迭�� ����
			per_numarray[i] =  per_num.substr(i,1);    //�Է��ֹι��� �迭�� ����
			sum = sum + (keyarray[i] * per_numarray[i]);  //�� �迭�� ���Ͽ�  ��ü���� ����
		}
		sum=11-(sum%11);                //���� 11�� ���� �������� 11���� ��
		if (sum>=10) {                  //10 ��  0 ,  11��  1�� 
			sum=sum-10;
		}
		//alert(sum);
		//return;
		//�и�Ƽ ���� �ֹι�ȣ �������� ��
		if (sum==per_num.substr(12,1)) {
			//alert("�������� �ֹε�Ϲ�ȣ�Դϴ�."); 
		} else {
			alert("�߸��� �ֹε�Ϲ�ȣ�Դϴ�.");
			frm.emp_ssnb1.value = "";
			frm.emp_ssnb2.value = "";
			frm.emp_ssnb1.focus();
			return;
		}
	}

	if (frm.emp_sdate.value == "") {
		alert("�Ի����� �Է��ϼ���.");
		frm.emp_sdate.focus();
		return;
	}
	total_cal();
	setPayBase();

	var f = document.formSalary;
	//alert(f.check_money_min_yn.value);
	//alert(f.check_worktime_w_yn.value);
	//return;

	frm.action = "staff_update.php";
	frm.submit();
	return;
}

function delData() {
	var frm = document.dataForm;
	var ret = window.confirm("�����Ͻðڽ��ϱ�?");
	if (ret)
	{
		frm.mode.value = "delete";
		frm.action = "staff_delete.php";
		frm.submit();
	}
	return;
}
function tab_view(tab) {
	var obj = document.getElementById(tab);
	if(obj.style.display == "none") {
		obj.style.display = "";
	} else {
		obj.style.display = "none";
	}
}

function openSelectWorkTime() {
	if( document.dataForm.pay_gbn[2].checked ){
		alert("���ձٹ��� ��� �ְ� �ٹ��ð�ǥ�� ������ �� �����ϴ�.");
		return;
	}
	if( document.dataForm.pay_gbn[0].checked || document.dataForm.pay_gbn[2].checked || document.dataForm.pay_gbn[3].checked ){
		if( document.formSalary.check_worktime_yn.checked ){
			alert("�ٷνð� �����Է� üũ�� �����ϼž� �ְ� �ٹ�ǥ ������ �����մϴ�.");
			return;
		}
	}else if( document.dataForm.pay_gbn[1].checked ){
		if( document.formSalary.check_worktime_yn.checked ){
			alert("�ٷνð� �����Է� üũ�� �����ϼž� �ְ� �ٹ�ǥ ������ �����մϴ�.");
			return;
		}
	}
	var ret = window.open("pop_select_work_time.php?cust_numb=98", "pop_sel_work_time", "top=100, left=50, width=900,height=600, scrollbars");
	return;
}

function goFile(strfile, strno) {
	var bcheck = document.formSalary.check_worktime_yn.checked;
	var frm = document.fileForm;
	var ret;
	if (bcheck == true)
	{
		ret = window.confirm("1�ϼ����ٷνð� �� 1�ֱٷνð������� Ȯ���ϼ̳���? ��� �����Ͻðڽ��ϱ�?");
		if (ret)
		{
			frm.doc_no.value = strno;
			frm.action = "/_biz/report/"+strfile;
			frm.submit();
		}
	}
	else
	{
		frm.doc_no.value = strno;
		frm.action = "/_biz/report/"+strfile;
		frm.submit();
	}
	return;
}
function tab_show(tab) {
	var frm = document.dataForm;
	frm.tab.value = tab;
	document.getElementById(tab).style.display="";
	if(tab == "tab1") {
		document.getElementById('tab2').style.display="none";
		document.getElementById('tab2_bt').style.display="none";
		document.getElementById('tab_img1').src="./images/tab01_on.gif";
		document.getElementById('tab_img2').src="./images/tab02_off.gif";
	} else {
		document.getElementById('tab1').style.display="none";
		document.getElementById('tab2_bt').style.display="inline";
		document.getElementById('tab_img1').src="./images/tab01_off.gif";
		document.getElementById('tab_img2').src="./images/tab02_on.gif";
	}
}
</script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/lang/calendar-ko.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
<script language="javascript">
function loadCalendar( obj )
{
	var calendar = new Calendar(0, null, onSelect, onClose);
	calendar.create();
	calendar.parseDate(obj.value);
	calendar.showAtElement(obj, "Br");

	function onSelect(calendar, date)
	{
		var input_field = obj;
		input_field.value = date;
		if (calendar.dateClicked) {
			calendar.callCloseHandler();
		}
	};

	function onClose(calendar)
	{
		calendar.hide();
		calendar.destroy();
	};
}
//õ���� �޹�
function checkThousand(inputVal, type, keydown) {		// inputVal�� õ������ , ǥ�ø� ���� �������� ��
	main = document.dataForm;			// ���⼭ type �� �ش��ϴ� ���� �ֱ� ���� ��ġ���� index
	var chk		= 0;				// chk �� õ������ ���� ���̸� check
	var share	= 0;				// share 200,000 �� ���� 3�� ����� ���� �����ϱ� ���� ����
	var start	= 0;
	var triple	= 0;				// triple 3, 6, 9 �� 3�� ��� 
	var end		= 0;				// start, end substring ������ ���� ����  
	var total	= "";			
	var input	= "";				// total ���Ƿ� string ���� �����ϱ� ���� ����
	//alert(event.keyCode);
	//�齺���̽� �� ����Ʈ+�� �� �� Del
	//�齺���̽�, Del ����
	//&& event.keyCode!=8 && event.keyCode!=46
	//�� ����Ʈ+�� �� �� Home
	if(event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=36) {
		if (inputVal.length > 3) {
			input = delCom(inputVal, inputVal.length);
			/*
			for(i=0; i<inputVal.length; i++){
				if(inputVal.substring(i,i+1)!=','){		// ���� substring�� ����
					input += inputVal.substring(i,i+1);	// ���� ��� , �� ����
				}
			}*/
			chk = (input.length)/3;					// input ���� 3�Ƿ� ���� �� ���
			chk = Math.floor(chk);					// �� ������ �۰ų� ���� �� �� �ִ��� ���� ���
			share = (input.length)%3;				// 200,000 �� ���� 3�� ����� ���� �ɷ����� ���� ������ ���
			if (share == 0 ) {						
				chk = chk - 1;					// ���̰� 3�� ����� ���� ���� chk ���� �ϳ� ����.
			}
			for(i=chk; i>0; i--) {
				triple = i * 3;					// 3�� ��� ��� 9,6,3 ��� ���� ������
				end = Number(input.length)-Number(triple);	// �� ���� end ���� ���� �þ� ���� �ȴ�.
				total += input.substring(start,end)+",";	// total�� �տ��� ���� ���ʷ� ���δ�.
				start = end;					// end ���� �������� start ������ ����.
			}
			total +=input.substring(start,input.length);		// ���������� ������ 3�ڸ� ���� �ڿ� ������.
		} else {
			total = inputVal;					// 3�� ����� �Ǳ� �������� ���� �״�� �����ȴ�.
		}
		if(keydown =='Y') {
			type.value=total;					// type �� ���� �������� �־� �ش�.
		}else if(keydown =='N') {
			return total
		}
		return total
	}
}
function delCom(inputVal, count) {
	var tmp = "";
	for(i=0; i<count; i++){
		if(inputVal.substring(i,i+1)!=','){		// ���� substring�� ����
			tmp += inputVal.substring(i,i+1);	// ���� ��� , �� ����
		}
	}
	return tmp;
}
//�����ӱ� �ʱ�ȭ
function money_month_base_reset() {
	var f = document.formSalary;
	//f.money_month_base_view.value = "";
	//f.money_month_base_view.focus();
	f.money_month_base.value = "";
	f.money_month_base.focus();
}
//���ؽñ� �ʱ�ȭ
function money_hour_reset() {
	var f = document.formSalary;
	//f.money_month_base_view.value = "";
	//f.money_month_base_view.focus();
	f.money_hour.value = "";
	f.money_hour.focus();
}
//�⺻�� �ʱ�ȭ
function money_min_reset() {
	var f = document.formSalary;
	f.money_min.value = "";
	f.money_min.focus();
}
function position_set(type, position_code) {
	var f = document.formSalary;
	var position_array = new Array();
	var step_array = new Array();
	<?
	$sql_position = " select * from com_code_list where com_code='$com_code' and item = 'position' ";
	//echo $sql_position;
	$result_position = sql_query($sql_position);
	for($i=0; $row_position=sql_fetch_array($result_position); $i++) {
	?>
	position_array[<?=$row_position[code]?>] = "<?=$row_position[amount]?>";
	<?
	}
	$sql_step = " select * from com_code_list where com_code='$com_code' and item = 'step' ";
	//echo $sql_step;
	$result_step = sql_query($sql_step);
	for($i=0; $row_step=sql_fetch_array($result_step); $i++) {
	?>
	step_array[<?=$row_step[code]?>] = "<?=$row_step[amount]?>";
	<?
	}
	?>
	if(type=="position") {
		if(position_array[position_code] == "") {
			f.money_g1.value = "0";
		} else {
			f.money_g1.value = position_array[position_code];
		}
	} else if(type=="step") {
		if(step_array[position_code] == "") {
			f.money_g3.value = "0";
		} else {
			f.money_g3.value = step_array[position_code];
		}
	}
	if(position_code == "") {
		if(type=="position") {
			f.money_g1.value = "0";
		} else if(type=="step") {
			f.money_g3.value = "0";
		}
	}
	setWorkHour();
}

//�Ի���,����� �Է� �޸�
function checkcomma(inputVal, type, keydown) {		// inputVal�� õ������ , ǥ�ø� ���� �������� ��
	main = document.dataForm;			// ���⼭ type �� �ش��ϴ� ���� �ֱ� ���� ��ġ���� index
	var chk		= 0;				// chk �� õ������ ���� ���̸� check
	var chk2	= 0;
	var chk3	= 0;
	var share	= 0;				// share 200,000 �� ���� 3�� ����� ���� �����ϱ� ���� ����
	var start	= 0;
	var triple	= 0;				// triple 3, 6, 9 �� 3�� ��� 
	var end		= 0;				// start, end substring ������ ���� ����  
	var total	= "";			
	var input	= "";				// total ���Ƿ� string ���� �����ϱ� ���� ����
	//���� �Է¸�
	//alert(event.keyCode);
	input = delcomma(inputVal, inputVal.length);
	//������ master �Է�
	//alert(input);
	//�齺���̽� �� ����Ʈ+�� �� �� Del
	if(event.keyCode!=8 && event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=46) {
		//alert(inputVal.length);
		//alert(input);
		if(inputVal.length == 4){
			//input = delhyphen(inputVal, inputVal.length);
			total += input.substring(0,4)+".";
		} else if(inputVal.length == 7){
			total += inputVal.substring(0,7)+".";
		} else if(inputVal.length == 12){
			total += inputVal.substring(0,14)+"";
		} else {
			total += inputVal;
		}
		if(keydown =='Y'){
			if ( type =='1' ) {
				main.emp_sdate.value=total;					// type �� ���� �������� �־� �ش�.
			} else if ( type =='2' ) {
				main.emp_edate.value=total;
			} else if ( type =='3' ) {
				main.school_sdate.value=total;
			} else if ( type =='4' ) {
				main.school_edate.value=total;
			} else if ( type =='5' ) {
				main.school_sdate2.value=total;
			} else if ( type =='6' ) {
				main.school_edate2.value=total;
			} else if ( type =='7' ) {
				main.school_sdate3.value=total;
			} else if ( type =='8' ) {
				main.school_edate3.value=total;
			} else if ( type =='9' ) {
				main.career_sdate.value=total;
			} else if ( type =='10' ) {
				main.career_edate.value=total;
			} else if ( type =='11' ) {
				main.career_sdate2.value=total;
			} else if ( type =='12' ) {
				main.career_edate2.value=total;
			} else if ( type =='13' ) {
				main.career_sdate3.value=total;
			} else if ( type =='14' ) {
				main.career_edate3.value=total;

			} else if ( type =='17' ) {
				main.education_sdate.value=total;
			} else if ( type =='18' ) {
				main.education_edate.value=total;
			} else if ( type =='19' ) {
				main.education_sdate2.value=total;
			} else if ( type =='20' ) {
				main.education_edate2.value=total;
			} else if ( type =='21' ) {
				main.education_sdate3.value=total;
			} else if ( type =='22' ) {
				main.education_edate3.value=total;
			} else if ( type =='23' ) {
				main.license_date1.value=total;
			} else if ( type =='24' ) {
				main.license_date2.value=total;
			} else if ( type =='25' ) {
				main.license_date3.value=total;
			}
		}else if(keydown =='N'){
			return total;
		}
	}
	return total;
}
function delcomma(inputVal, count){
	var tmp = "";
	for(i=0; i<count; i++){
		if(inputVal.substring(i,i+1)!='.'){		// ���� substring�� ����
			tmp += inputVal.substring(i,i+1);	// ���� ��� , �� ����
		}
	}
	return tmp;
}
function only_number_comma() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if(event.keyCode != 46) event.returnValue = false;
	}
}
function only_number() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		event.returnValue = false;
	}
}
//���� �˻�
function open_jikjong(n) {
	window.open("popup/jikjong_popup.php?n=_"+n, "jikjong_popup", "width=540, height=706, toolbar=no, menubar=no, scrollbars=no, resizable=no" );
}
//ä������ (�����, �Ͽ��� ���Ⱓ ǥ��)
function work_form_chk(chk) {
	//alert(chk.value);
	if(chk.value != 1) {
		document.getElementById("contract_term").style.display="";
	} else {
		document.getElementById("contract_term").style.display="none";
	}
}
//����(�����Ⱓ ǥ��)
function layoff_chk(chk) {
	if(chk.value == 1) {
		document.getElementById("contract_term").style.display="";
	} else {
		document.getElementById("contract_term").style.display="none";
	}
}
function work_gbn_chk(chk) {
	//alert(chk);
	var f = document.formSalary;
	if(chk == "A") {
		f.workhour_day_w.value = 40;
	} else {
		f.workhour_day_w.value = 44;
	}
	setWorkHour('day');
}
//20������ �ڳ�
function family_count_calc() {
	var f = document.dataForm;
	//f.family_count.value = (toInt(f.child_count.value)*2) + toInt(f.etc_count.value) + 1;
	f.family_count.value = (toInt(f.child_count.value)*1) + toInt(f.etc_count.value) + 1;
	if(f.spouse_yn.checked) f.family_count.value = toInt(f.family_count.value) + 1;
}
//����� ����
function spouse_count_calc(obj) {
	var f = document.dataForm;
	if(obj.checked) {
		f.family_count.value = (toInt(f.child_count.value)*1) + toInt(f.etc_count.value) + 2;
	} else {
		f.family_count.value = (toInt(f.child_count.value)*1) + toInt(f.etc_count.value) + 1;
	}
}
//����ҵ� 4�뺸�� üũ ����
function work_form_func(obj) {
	var f = document.dataForm;
	if(obj.value == 4) {
		f.isgy.checked = false;
		f.issj.checked = false;
		f.iskm.checked = false;
		f.isgg.checked = false;
		f.isjy.checked = false;
	}
}
</script>
<script type="text/javascript" src="https://spi.maps.daum.net/imap/map_js_init/postcode.v2.js"></script>
<script type="text/javascript">
//<![CDATA[
function openDaumPostcode(zip1,zip2,addr1,addr2,zip) {
	new daum.Postcode({
			oncomplete: function(data) {
					frm = document.dataForm;
					frm[zip1].value = data.postcode1;
					frm[zip2].value = data.postcode2;
					frm[addr1].value = data.address;
					//frm[zip].value = data.zonecode;
					frm[addr2].focus();
			}
	}).open();
}
function openDaumPostcode_new(zip,addr1,addr2) {
	new daum.Postcode({
			oncomplete: function(data) {
					frm = document.dataForm;
					frm[zip].value = data.zonecode;
					frm[addr1].value = data.roadAddress;
					frm[addr2].focus();
			}
	}).open();
}
//]]>
</script>
<? include "./inc/top.php"; ?>

<div id="content">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="1200" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top" width="270">
							<table border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td><img src="images/subname02.gif" /></td>
								</tr>
								<tr>
									<td><a href="staff_list.php" onmouseover="limg1.src='images/menu02_sub01_on.gif'" onmouseout="limg1.src='images/menu02_sub01_off.gif'"><img src="images/menu02_sub01_off.gif" name="limg1" id="limg1" /></a></td>
								</tr>
								<tr>
									<td><a href="staff_history.php" onmouseover="limg2.src='images/menu02_sub02_on.gif'" onmouseout="limg2.src='images/menu02_sub02_off.gif'"><img src="images/menu02_sub02_off.gif" name="limg2" id="limg2" /></a></td>
								</tr>
							</table>
<?
include "./inc/left_banner.php";
?>
						</td>
						<td valign="top" style="padding:10px 10px 10px 10px">
							<!--Ÿ��Ʋ -->
							<table width="100%" border=0 cellspacing=0 cellpadding=0>
								<tr>     
									<td height="18">
										<table width=100% border=0 cellspacing=0 cellpadding=0>
											<tr>
												<td style='font-size:8pt;color:#929292;'><img src="images/g_title_icon.gif" align=absmiddle  style='margin:0 5 2 0'><span style='font-size:9pt;color:black;'><?=$sub_title?></span>
												</td>
												<td align=right class=navi></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr><td height=1 bgcolor=e0e0de></td></tr>
								<tr><td height=2 bgcolor=f5f5f5></td></tr>
								<tr><td height=5></td></tr>
							</table>

							<!--�Ǹ޴� -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr> 
									<td id="Tab_cust_tab_03"> 
										<a href="javascript:tab_show('tab1');"><img src="./images/tab01_on.gif" border="0" id="tab_img1"></a>
									</td> 
									<td width=2></td> 
									<td id="Tab_cust_tab_04"> 
										<a href="javascript:tab_show('tab2');"><img src="./images/tab02_off.gif" border="0" id="tab_img2"></a>
									</td> 
									<td width=10></td> 
									<td>
<?
//�Ի���
$in_day_array = explode(".",$row1[in_day]);
$in_day = $in_day_array[0]."�� ".$in_day_array[1]."�� ".$in_day_array[2]."��";
//ä������
if($row1[work_form] == "") $work_form = "";
else if($row1[work_form] == "1") $work_form = "������";
else if($row1[work_form] == "2") $work_form = "�����";
else if($row1[work_form] == "3") $work_form = "�Ͽ���";
else if($row1[work_form] == "4") $work_form = "����ҵ�";
?>
										���� : <strong><?=$row1[name]?></strong> / �ֹε�Ϲ�ȣ : <?=$row1[jumin_no]?> / �Ի��� : <?=$in_day?> / ä������ : <?=$work_form?>
									</td>
								</tr> 
							</table>
							<div style="height:2px;font-size:0px" class="bgtr_tab"></div>
							<div style="height:10px;font-size:0px"></div>

							<div id="tab1">
								<!--��޴� -->
								<table border=0 cellspacing=0 cellpadding=0> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
													�⺻����
													</td> 
													<td><img src="images/g_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width=2></td> 
										<td valign="bottom"></td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!--��޴� -->


								<!--�⺻�� dataForm-->
								<form name="dataForm" method="post" enctype="multipart/form-data">
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<col width="11%">
									<col width="23%">
									<col width="12%">
									<col width="20%">
									<col width="10%">
									<col width="24%">
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����<font color="red">*</font></td>
										<td nowrap class="tdrow">
											<input name="emp_name" type="text" class="textfm" style="width:150;ime-mode:active;" value="<?=$row1['name']?>" onKeyDown="if(event.keyCode == 13){ document.dataForm.emp_ssnb1.focus(); }" tabindex="1" maxlength="25">
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�ֹε�Ϲ�ȣ<font color="red">*</font></td>
										<td nowrap class="tdrow">
											<?
											$jumin_no = explode("-",$row1['jumin_no']);
											?>

											<input name="emp_ssnb1" type="text" class="textfm" style="width:60px;ime-mode:disabled;" value="<?=$jumin_no[0]?>" onKeyDown="if(event.keyCode == 13){ document.dataForm.emp_ssnb2.focus(); }" tabindex="2" maxlength="6" onKeyPress="onlyNumber();">
											-
											<input name="emp_ssnb2" type="text" class="textfm" style="width:73px;ime-mode:disabled;" value="<?=$jumin_no[1]?>" onKeyDown="if(event.keyCode == 13){ document.dataForm.pay_gbn[0].focus(); }" tabindex="3" maxlength="7" onKeyPress="onlyNumber();">
										</td>
										<td nowrap class="tdrowk" rowspan="3">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�������
										</td>
										<td nowrap class="tdrow" rowspan="3">
											<?
												//�������
												if($row2['pic']) {
													$pic = "./files/images/$row1[com_code]_$row1[sabun].jpg";
												} else {
													$pic = "./images/blank_pic.gif";
												}
											?>

											<img src="<?=$pic?>" width="90" height="90" style="margin-bottom:2px"><br>
											<input name="filename" type="file" class="textfm_search" style="width:170px;">
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�Ի���<font color="red">*</font></td>
										<td nowrap class="tdrow">
											<input id="emp_sdate" name="emp_sdate" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row1[in_day]?>" tabindex="4" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, '1','Y')">
											<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:loadCalendar(document.all.emp_sdate);" target="">�޷�</a></td><td><img src=./images/btn2_rt.gif></td><td width=2></td></tr></table>
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�����<div style="font-size:8pt">(�������ٹ���)</div></td>
										<td nowrap class="tdrow">
											<input id="emp_edate" name="emp_edate" type="text" class="textfm" style="width:80;ime-mode:disabled;" value="<?=$row1[out_day]?>" tabindex="5" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, '2','Y')">
											 <table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:loadCalendar(document.all.emp_edate);" target="">�޷�</a></td><td><img src=./images/btn2_rt.gif></td><td width=2></td></tr></table>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�ּ�</td>
										<td nowrap class="tdrow" colspan="3">
											<?
											$adr_zip = explode("-",$row1['w_postno']);
											?>
											<div style="float:left;height:22px">
												<input name="adr_zip1" type="text" class="textfm" style="width:30px;ime-mode:active;" value="<?=$adr_zip[0]?>" readonly>
												-
												<input name="adr_zip2" type="text" class="textfm" style="width:30px;ime-mode:active;" value="<?=$adr_zip[1]?>" readonly>
											</div>
											<div style="float:;height:22px">
												<table border=0 cellpadding=0 cellspacing=0><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:openDaumPostcode('adr_zip1','adr_zip2','adr_adr1','adr_adr2','');" target="">�ּ�ã��</a></td><td><img src=./images/btn2_rt.gif></td><td width=2></td></tr></table>
											</div>
											<input name="adr_adr1" type="text" class="textfm" style="width:480px;ime-mode:active;" value="<?=$row1['w_juso']?>" readonly>
											<br>
											<input name="adr_adr2" type="text" class="textfm" style="width:480px;ime-mode:active;" value="<?=$row2['w_juso2']?>" maxlength="150">
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�̸���</td>
										<td nowrap class="tdrow">
											<input name="emp_email" type="text" class="textfm" style="width:180px;ime-mode:disabled;" value="<?=$row2['emp_email']?>" maxlength="50">
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�޴���</td>
										<td nowrap class="tdrow">
											<?
											$emp_cel = explode("-",$row2['emp_cel']);
											if($emp_cel[0] == "010") $emp_cel_selected1 = "selected";
											else if($emp_cel[0] == "011") $emp_cel_selected2 = "selected";
											else if($emp_cel[0] == "016") $emp_cel_selected3 = "selected";
											else if($emp_cel[0] == "017") $emp_cel_selected4 = "selected";
											else if($emp_cel[0] == "018") $emp_cel_selected5 = "selected";
											else if($emp_cel[0] == "019") $emp_cel_selected6 = "selected";
											else if($emp_cel[0] == "070") $emp_cel_selected7 = "selected";
											?>

											<select name="emp_cel1" class="selectfm">
												<option value="">����</option>
												<option value="010" <?=$emp_cel_selected1?> >010</option>
												<option value="011" <?=$emp_cel_selected2?> >011</option>
												<option value="016" <?=$emp_cel_selected3?> >016</option>
												<option value="017" <?=$emp_cel_selected4?> >017</option>
												<option value="018" <?=$emp_cel_selected5?> >018</option>
												<option value="019" <?=$emp_cel_selected6?> >019</option>
												<option value="070" <?=$emp_cel_selected7?> >070</option>
											</select>
											-
											<input name="emp_cel2" type="text" class="textfm" style="width:35px;ime-mode:disabled;" value="<?=$emp_cel[1]?>" maxlength="4" onKeyPress="onlyNumber();">
											-
											<input name="emp_cel3" type="text" class="textfm" style="width:35px;ime-mode:disabled;" value="<?=$emp_cel[2]?>" maxlength="4" onKeyPress="onlyNumber();">
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����</td>
										<td nowrap class="tdrow">
											<input name="jikjong_code" id="join_jikjong_code_undefined" type="text" class="textfm" style="width:30px;" value="<?=$row2['jikjong_code']?>" maxlength="3" readonly>
											<input name="jikjong" id="join_jikjong_undefined" type="text" class="textfm" style="width:140px;" value="<?=$row2['jikjong']?>" maxlength="25" readonly>
											<label onclick="open_jikjong();" style="cursor:pointer"><img src="images/search_bt.png" align=absmiddle></label>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�ܱ��� ����</td>
										<td nowrap class="tdrow">
											<?
											if($row1['fg_div'] == 0) $foreign_gbn_checked_1 = "checked";
											else $foreign_gbn_checked_2 = "checked";
											?>

											<input type="radio" name="foreign_gbn" value="0" <?=$foreign_gbn_checked_1?>>������
											<input type="radio" name="foreign_gbn" value="1" <?=$foreign_gbn_checked_2?>>�ܱ���
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��ȭ��ȣ</td>
										<td nowrap class="tdrow">
											<?
											$emp_tel = explode("-",$row1['add_tel']);
											if     ($emp_tel[0] == "02")  $emp_tel_selected1 = "selected";
											else if($emp_tel[0] == "032") $emp_tel_selected2 = "selected";
											else if($emp_tel[0] == "042") $emp_tel_selected3 = "selected";
											else if($emp_tel[0] == "051") $emp_tel_selected4 = "selected";
											else if($emp_tel[0] == "052") $emp_tel_selected5 = "selected";
											else if($emp_tel[0] == "053") $emp_tel_selected6 = "selected";
											else if($emp_tel[0] == "062") $emp_tel_selected7 = "selected";
											else if($emp_tel[0] == "064") $emp_tel_selected8 = "selected";
											else if($emp_tel[0] == "031") $emp_tel_selected9 = "selected";
											else if($emp_tel[0] == "033") $emp_tel_selected10 = "selected";
											else if($emp_tel[0] == "041") $emp_tel_selected11 = "selected";
											else if($emp_tel[0] == "043") $emp_tel_selected12 = "selected";
											else if($emp_tel[0] == "054") $emp_tel_selected13 = "selected";
											else if($emp_tel[0] == "055") $emp_tel_selected14 = "selected";
											else if($emp_tel[0] == "061") $emp_tel_selected15 = "selected";
											else if($emp_tel[0] == "063") $emp_tel_selected16 = "selected";
											else if($emp_tel[0] == "070") $emp_tel_selected17 = "selected";
											?>

											<select name="emp_tel1" class="selectfm">
												<option value="">����</option>
												<option value="02"  <?=$emp_tel_selected1?> >02</option>
												<option value="032" <?=$emp_tel_selected2?> >032</option>
												<option value="042" <?=$emp_tel_selected3?> >042</option>
												<option value="051" <?=$emp_tel_selected4?> >051</option>
												<option value="052" <?=$emp_tel_selected5?> >052</option>
												<option value="053" <?=$emp_tel_selected6?> >053</option>
												<option value="062" <?=$emp_tel_selected7?> >062</option>
												<option value="064" <?=$emp_tel_selected8?> >064</option>
												<option value="031" <?=$emp_tel_selected9?> >031</option>
												<option value="033" <?=$emp_tel_selected10?> >033</option>
												<option value="041" <?=$emp_tel_selected11?> >041</option>
												<option value="043" <?=$emp_tel_selected12?> >043</option>
												<option value="054" <?=$emp_tel_selected13?> >054</option>
												<option value="055" <?=$emp_tel_selected14?> >055</option>
												<option value="061" <?=$emp_tel_selected15?> >061</option>
												<option value="063" <?=$emp_tel_selected16?> >063</option>
												<option value="070" <?=$emp_tel_selected17?> >070</option>
											</select>
											-
											<input name="emp_tel2" type="text" class="textfm" style="width:35px;ime-mode:disabled;" value="<?=$emp_tel[1]?>" maxlength="4" onKeyPress="onlyNumber();">
											-
											<input name="emp_tel3" type="text" class="textfm" style="width:35px;ime-mode:disabled;" value="<?=$emp_tel[2]?>" maxlength="4" onKeyPress="onlyNumber();">
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��������</td>
										<td nowrap class="tdrow">
											<input type="checkbox" name="rural" value="1" class="checkbox" style="vertical-align:middle;" <? if($row2['rural'] == "1") echo "checked"; ?> > ��������������
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;">ä������</td>
										<td nowrap class="tdrow">
											<select name="work_form" onclick="work_form_func(this)">
											<?
											if($row1['work_form'] == "") $row1['work_form'] = 1;
											$work_form_txt[1] = "������";
											$work_form_txt[2] = "�����";
											$work_form_txt[3] = "�Ͽ���";
											$work_form_txt[4] = "����ҵ�";
											for($i=1; $i<=4; $i++) {
											?>

											<option value="<?=$i?>" <? if($i == $row1['work_form']) echo "selected"; ?> ><?=$work_form_txt[$i]?></option>
											<?
											}
											?>

											</select>
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;">��������</td>
										<td nowrap class="tdrow">
											<?
											if($row1['gubun'] == 0) $emp_stat_chk0 = "checked";
											else if($row1['gubun'] == 1) $emp_stat_chk1 = "checked";
											else if($row1['gubun'] == 2) $emp_stat_chk2 = "checked";
											else $emp_stat_chk0 = "checked";
											?>

											<input type="radio" name="emp_stat" value="0" <?=$emp_stat_chk0?> >����
											<input type="radio" name="emp_stat" value="1" <?=$emp_stat_chk1?> onclick="layoff_chk(this)" >����
											<input type="radio" name="emp_stat" value="2" <?=$emp_stat_chk2?> >���
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���͹ΰ��</td>
										<td nowrap class="tdrow">
											<input type="checkbox" name="deferred" value="1" class="checkbox" style="vertical-align:middle;" <?=$deferred_chk?>> ���͹ΰ������
										</td>
									</tr>
									<tr id="contract_term" style="<? if( $row1['work_form'] == 1 && $row1['gubun'] != 1 ) echo "display:none"; ?>">
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���Ⱓ</td>
										<td class="tdrow">
											������ <input id="contract_sdate" name="contract_sdate" type="text" class="textfm5" style="width:80px;ime-mode:disabled;" value="<?=$row2['contract_sdate']?>" maxlength="10" readonly>
											<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle;"><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:loadCalendar(document.dataForm.contract_sdate);" target="">�޷�</a></td><td><img src=./images/btn2_rt.gif></td><td width=2></td></tr></table>
											<br />
											������ <input id="contract_edate" name="contract_edate" type="text" class="textfm5" style="width:80px;ime-mode:disabled;" value="<?=$row2['contract_edate']?>" maxlength="10" readonly>
											<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle;"><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:loadCalendar(document.dataForm.contract_edate);" target="">�޷�</a></td><td><img src=./images/btn2_rt.gif></td><td width=2></td></tr></table>
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�����Ⱓ</td>
										<td class="tdrow">
											������ <input id="layoff_sdate" name="layoff_sdate" type="text" class="textfm5" style="width:80px;ime-mode:disabled;" value="<?=$row2['layoff_sdate']?>" maxlength="10" readonly>
											<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle;"><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:loadCalendar(document.dataForm.layoff_sdate);" target="">�޷�</a></td><td><img src=./images/btn2_rt.gif></td><td width=2></td></tr></table>
											<br />
											������ <input id="layoff_edate" name="layoff_edate" type="text" class="textfm5" style="width:80px;ime-mode:disabled;" value="<?=$row2['layoff_edate']?>" maxlength="10" readonly>
											<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle;"><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:loadCalendar(document.dataForm.layoff_edate);" target="">�޷�</a></td><td><img src=./images/btn2_rt.gif></td><td width=2></td></tr></table>
										</td>
										<td class="tdrowk"></td>
										<td class="tdrow">

										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk" rowspan="2"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0;">���뺸��<font color="red"></font></td>
										<td nowrap class="tdrow"  rowspan="2" colspan="3">
<?
//echo $row1[apply_gy];
if($row1[apply_gy] == "0") $isgy_chk = "checked";
else $isgy_chk = "";
if($row1[apply_sj] == "0") $issj_chk = "checked";
else $issj_chk = "";
if($row1[apply_km] == "0") $iskm_chk = "checked";
else $iskm_chk = "";
if($row1[apply_gg] == "0") $isgg_chk = "checked"; 
else $isgg_chk = "";
//�ű� ��Ͻ� �ڵ� üũ 150709
if(!$w) {
	$isgy_chk = "checked";
	$issj_chk = "checked";
	$iskm_chk = "checked";
	$isgg_chk = "checked"; 
}
?>
											<input type="checkbox" name="isgy" value="0" class="checkbox" style="vertical-align:middle;" <?=$isgy_chk?>>���
											<input type="checkbox" name="issj" value="0" class="checkbox" style="vertical-align:middle;" <?=$issj_chk?>>����
											<input type="checkbox" name="iskm" value="0" class="checkbox" style="vertical-align:middle;" <?=$iskm_chk?>>����
											<input type="checkbox" name="isgg" value="0" class="checkbox" style="vertical-align:middle;" <?=$isgg_chk?>>�ǰ�
											<br>
											���ο��� �ű԰��� �Ұ�(��60�� �̻�), ��뺸�� �ű԰��� �Ұ�(�� 65�� �̻�)
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����ο���</td>
										<td nowrap class="tdrow">
											<?
											if($row2['drawback_form'] == 0) $drawback_form_chk0 = "selected";
											else if($row2['drawback_form'] == 1) $drawback_form_chk1 = "selected";
											else if($row2['drawback_form'] == 2) $drawback_form_chk2 = "selected";
											else if($row2['drawback_form'] == 3) $drawback_form_chk3 = "selected";
											else if($row2['drawback_form'] == 4) $drawback_form_chk4 = "selected";
											else if($row2['drawback_form'] == 5) $drawback_form_chk5 = "selected";
											else if($row2['drawback_form'] == 6) $drawback_form_chk6 = "selected";
											else if($row2['drawback_form'] == 7) $drawback_form_chk7 = "selected";
											else if($row2['drawback_form'] == 8) $drawback_form_chk8 = "selected";
											else if($row2['drawback_form'] == 9) $drawback_form_chk9 = "selected";
											else if($row2['drawback_form'] == 10) $drawback_form_chk10 = "selected";
											else if($row2['drawback_form'] == 11) $drawback_form_chk11 = "selected";
											else if($row2['drawback_form'] == 12) $drawback_form_chk12 = "selected";
											else if($row2['drawback_form'] == 13) $drawback_form_chk13 = "selected";
											else if($row2['drawback_form'] == 14) $drawback_form_chk14 = "selected";
											else if($row2['drawback_form'] == 15) $drawback_form_chk15 = "selected";
											else if($row2['drawback_form'] == 16) $drawback_form_chk16 = "selected";
											else $drawback_form_chk0 = "selected";
											?>

											<select name="drawback_form" class="selectfm">
												<option value=""  <?=$drawback_form_chk0?> >0.�ش���׾���</option>
												<option value="1" <?=$drawback_form_chk1?> >1.��ü���</option>
												<option value="2" <?=$drawback_form_chk2?> >2.���������</option>
												<option value="3" <?=$drawback_form_chk3?> >3.�ð����</option>
												<option value="4" <?=$drawback_form_chk4?> >4.û�����</option>
												<option value="5" <?=$drawback_form_chk5?> >5.������</option>
												<option value="6" <?=$drawback_form_chk6?> >6.�ȸ����</option>
												<option value="7" <?=$drawback_form_chk7?> >7.�������</option>
												<option value="8" <?=$drawback_form_chk8?> >8.�������</option>
												<option value="9" <?=$drawback_form_chk9?> >9.�����</option>
												<option value="10" <?=$drawback_form_chk10?> >10.ȣ������</option>
												<option value="11" <?=$drawback_form_chk11?> >11.���/������</option>
												<option value="12" <?=$drawback_form_chk12?> >12.�������</option>
												<option value="13" <?=$drawback_form_chk13?> >13.�������</option>
												<option value="14" <?=$drawback_form_chk14?> >14.�������</option>
												<option value="15" <?=$drawback_form_chk15?> >15.�������</option>
												<option value="16" <?=$drawback_form_chk16?> >16.��Ÿ</option>
											</select>
											<select name="drawback_form_grade" class="selectfm">
												<option value=""  <?=$drawback_form_grade_chk0?> >����</option>
												<option value="1" <?=$drawback_form_grade_chk1?> >1��</option>
												<option value="2" <?=$drawback_form_grade_chk2?> >2��</option>
												<option value="3" <?=$drawback_form_grade_chk3?> >3��</option>
												<option value="4" <?=$drawback_form_grade_chk4?> >4��</option>
												<option value="5" <?=$drawback_form_grade_chk5?> >5��</option>
												<option value="6" <?=$drawback_form_grade_chk6?> >6��</option>
											</select>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�����</td>
										<td nowrap class="tdrow">
											<?
											if($row2['aged'] == 1) $aged_chk = "checked";
											else $aged_chk = "";
											if($row2['insurance'] == 1) $insurance_chk = "checked";
											else $insurance_chk = "";
											if($row2['retired'] == 1) $retired_chk = "checked";
											else $retired_chk = "";
											if($row2['deferred'] == 1) $deferred_chk = "checked";
											else $deferred_chk = "";
											?>

											<input type="checkbox" name="aged" value="1" class="checkbox" style="vertical-align:middle;" <?=$aged_chk?>> 60���̻�
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk" rowspan="2"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�ξ簡����</td>
										<td nowrap class="tdrow" rowspan="2" colspan="3">
											��(��������)
<?
$family_cnt = $row2['family_cnt'];
if($family_cnt == "" || $family_cnt == "0") $family_cnt = 1;
$child_cnt = $row2['child_cnt'];
$etc_cnt = $row2['etc_cnt'];
?>
											<input name="family_count" type="text" class="textfm5" style="width:30px;ime-mode:disabled;" value="<?=$family_cnt?>" maxlength="10" readonly>
											20������ �ڳ�
											<select name="child_count" class="selectfm" onchange="family_count_calc();">>
												<option value=0 <? if($child_cnt == 0) echo "selected"; ?> >0��</option>
												<option value=1 <? if($child_cnt == 1) echo "selected"; ?> >1��</option>
												<option value=2 <? if($child_cnt == 2) echo "selected"; ?> >2��</option>
												<option value=3 <? if($child_cnt == 3) echo "selected"; ?> >3��</option>
												<option value=4 <? if($child_cnt == 4) echo "selected"; ?> >4��</option>
												<option value=5 <? if($child_cnt == 5) echo "selected"; ?> >5��</option>
												<option value=6 <? if($child_cnt == 6) echo "selected"; ?> >6��</option>
												<option value=7 <? if($child_cnt == 7) echo "selected"; ?> >7��</option>
												<option value=8 <? if($child_cnt == 8) echo "selected"; ?> >8��</option>
												<option value=9 <? if($child_cnt == 9) echo "selected"; ?> >9��</option>
											</select>
											<br />
											�θ��(60�� �̻�, ���ҵ� 100���� ����)
											<select name="etc_count" class="selectfm" onchange="family_count_calc();">
												<option value=0 <? if($etc_cnt == 0) echo "selected"; ?> >0��</option>
												<option value=1 <? if($etc_cnt == 1) echo "selected"; ?> >1��</option>
												<option value=2 <? if($etc_cnt == 2) echo "selected"; ?> >2��</option>
												<option value=3 <? if($etc_cnt == 3) echo "selected"; ?> >3��</option>
												<option value=4 <? if($etc_cnt == 4) echo "selected"; ?> >4��</option>
												<option value=5 <? if($etc_cnt == 5) echo "selected"; ?> >5��</option>
												<option value=6 <? if($etc_cnt == 6) echo "selected"; ?> >6��</option>
												<option value=7 <? if($etc_cnt == 7) echo "selected"; ?> >7��</option>
												<option value=8 <? if($etc_cnt == 8) echo "selected"; ?> >8��</option>
												<option value=9 <? if($etc_cnt == 9) echo "selected"; ?> >9��</option>
											</select>
											����� ����<input type="checkbox" name="spouse_yn" value="1" class="checkbox" onclick="spouse_count_calc(this);" <? if($row2['spouse_yn'] == "1") echo "checked"; ?> />
											<span style="color:red;">�� �޿��ݿ�</span>
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�η紩��</td>
										<td nowrap class="tdrow">
											<!--<input type="checkbox" name="insurance" value="1" class="checkbox" style="vertical-align:middle;" <?=$insurance_chk?> />-->
											<select name="insurance" class="selectfm" onchange="">
												<option value="">����</option>
												<option value=1 <? if($row2['insurance'] == 1) echo "selected"; ?> >40%</option>
												<option value=2 <? if($row2['insurance'] == 2) echo "selected"; ?> >60%</option>
											</select>
											��������
											<span style="color:red;">�� �޿��ݿ�</span>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"></td>
										<td nowrap class="tdrow">
										</td>
									</tr>
									<tr>
										<td class="tdrowk" rowspan="2"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���¹�ȣ</td>
										<td class="tdrow" rowspan="2">
											<input type="text" class="textfm" name="bank_2" value="<?=$row2['bank_account']?>" style="width:166px" />
											<div style="margin-top:4px;">��) 1234-12-1234</div>
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�����</td>
										<td class="tdrow">
											<input size="20" type="text" class="textfm" name="bank_1" value="<?=$row2['bank_name']?>" />
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�μ���</td>
										<td class="tdrow">
											<input type="hidden" name="dept1" value="<?=$row2['dept_1']?>" />
											<select name="dept" onchange="document.dataForm.dept1.value=this[this.selectedIndex].text;">
												<option value="">����</option>
												<?
												$sql_dept = " select * from com_code_list where item='dept' and com_code='$code' order by code ";
												$result_dept = sql_query($sql_dept);
												for($i=0; $row_dept=sql_fetch_array($result_dept); $i++) {
												?>

												<option value="<?=$row_dept['code']?>" <? if($row2['dept_1'] == $row_dept['code']) echo "selected"; ?> ><?=$row_dept['name']?></option>
												<?
												}
												?>

											</select>
										</td>
									</tr>
									<tr>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">������</td>
										<td class="tdrow">
											<input size="20" type="text" class="textfm" name="bank_3" value="<?=$row2['bank_depositor']?>" />
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�Ҽ�����</td>
										<td class="tdrow">
											<input size="20" type="text" class="textfm" name="dept2" value="<?=$row2['dept_2']?>" />
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�ӱ���ũ��</td>
										<td nowrap class="tdrow">
											<select name="retired" class="selectfm">
												<option value=""  <?=$retired_chk0?> >�ش���׾���</option>
												<option value="1" <?=$retired_chk1?> >��������������</option>
												<option value="2" <?=$retired_chk2?> >���⿬��</option>
											</select>
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��������</td>
										<td nowrap class="tdrow">
											<?
											if($row2['matriarch'] == "") $matriarch_selected0 = "selected";
											else if($row2['matriarch'] == 1) $matriarch_selected1 = "selected";
											else if($row2['matriarch'] == 2) $matriarch_selected2 = "selected";
											?>

											<select name="matriarch" class="selectfm">
												<option value=""  <?=$matriarch_selected0?> >�ش���׾���</option>
												<option value="1" <?=$matriarch_selected1?> >�Ѻθ���</option>
												<option value="2" <?=$matriarch_selected2?> >���ʻ�Ȱ�����</option>
											</select>
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��꿩��</td>
										<td nowrap class="tdrow">
											<?
											if($row2['chidbirth'] == "") $chidbirth_chk0 = "selected";
											else if($row2['chidbirth'] == 1) $chidbirth_chk1 = "selected";
											else if($row2['chidbirth'] == 2) $chidbirth_chk2 = "selected";
											?>

											<select name="chidbirth" class="selectfm">
												<option value=""  <?=$chidbirth_chk0?> >�ش���׾���</option>
												<option value="1" <?=$chidbirth_chk1?> >������Ʊ���</option>
												<option value="2" <?=$chidbirth_chk2?> >������Ʊ��ü�η�</option>
											</select>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">Ư�̻���</td>
										<td nowrap class="tdrow" colspan="5">
											<input type="text" class="textfm" name="remark" value="<?=$row2['remark']?>" style="width:100%" />
										</td>
									</tr>
								</table>

								<div style="height:10px;font-size:0px;line-height:0px;"></div>
								<!--��޴� -->
								<table border=0 cellspacing=0 cellpadding=0> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80px;text-align:center'> 
														<a href="javascript:tab_view('dependent');">�ξ簡��</a>
													</td> 
													<td><img src="images/g_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width=2></td> 
										<td valign="bottom"></td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!--��޴� -->
<?
//$dependent_display = "display:none";
$dependent_display = "";
?>
								<div id="dependent" style="<?=$dependent_display?>">
									<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed;">
										<tr>
											<td nowrap class="tdrowk" width="40"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">��ȣ</td>
											<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����</td>
											<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����</td>
											<td nowrap class="tdrowk" width="130"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�ֹε�Ϲ�ȣ</td>
											<td nowrap class="tdrowk" width="64"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">���ſ���</td>
											<td nowrap class="tdrowk" width="40"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">��ȣ</td>
											<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����</td>
											<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����</td>
											<td nowrap class="tdrowk" width="130"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�ֹε�Ϲ�ȣ</td>
											<td nowrap class="tdrowk" width="64"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">���ſ���</td>
										</tr>
										<tr>
<?
$children_array = explode(",",$row1['children1']);
if($children_array[3]) $children_checked = "checked";
else $children_checked = "";
?>
											<td nowrap class="tdrow_center">1</td>
											<td nowrap class="tdrow">
												<input name="children_relation" type="text" class="textfm" style="width:80px;" value="<?=$children_array[0]?>" maxlength="10">
											</td>
											<td nowrap class="tdrow">
												<input name="children_name" type="text" class="textfm" style="width:80px;" value="<?=$children_array[1]?>" maxlength="10">
											</td>
											<td nowrap class="tdrow">
												<input name="children_ssnb" type="text" class="textfm" style="width:120px;" value="<?=$children_array[2]?>" maxlength="14">
											</td>
											<td nowrap class="tdrow">
												<input name="children_cohabitation" type="checkbox" value="1" <?=$children_checked?> class="checkbox"> ����
											</td>
<?
$children_array = explode(",",$row1['children2']);
if($children_array[3]) $children_checked = "checked";
else $children_checked = "";
?>
											<td nowrap class="tdrow_center">2</td>
											<td nowrap class="tdrow">
												<input name="children_relation2" type="text" class="textfm" style="width:80px;" value="<?=$children_array[0]?>" maxlength="10">
											</td>
											<td nowrap class="tdrow">
												<input name="children_name2" type="text" class="textfm" style="width:80px;" value="<?=$children_array[1]?>" maxlength="10">
											</td>
											<td nowrap class="tdrow">
												<input name="children_ssnb2" type="text" class="textfm" style="width:120px;" value="<?=$children_array[2]?>" maxlength="14">
											</td>
											<td nowrap class="tdrow">
												<input name="children_cohabitation2" type="checkbox" value="1" <?=$children_checked?> class="checkbox"> ����
											</td>
										</tr>
										<tr>
<?
$children_array = explode(",",$row1['children3']);
if($children_array[3]) $children_checked = "checked";
else $children_checked = "";
?>
											<td nowrap class="tdrow_center">3</td>
											<td nowrap class="tdrow">
												<input name="children_relation3" type="text" class="textfm" style="width:80px;" value="<?=$children_array[0]?>" maxlength="10">
											</td>
											<td nowrap class="tdrow">
												<input name="children_name3" type="text" class="textfm" style="width:80px;" value="<?=$children_array[1]?>" maxlength="10">
											</td>
											<td nowrap class="tdrow">
												<input name="children_ssnb3" type="text" class="textfm" style="width:120px;" value="<?=$children_array[2]?>" maxlength="14">
											</td>
											<td nowrap class="tdrow">
												<input name="children_cohabitation3" type="checkbox" value="1" <?=$children_checked?> class="checkbox"> ����
											</td>
<?
$children_array = explode(",",$row1['children4']);
if($children_array[3]) $children_checked = "checked";
else $children_checked = "";
?>
											<td nowrap class="tdrow_center">4</td>
											<td nowrap class="tdrow">
												<input name="children_relation4" type="text" class="textfm" style="width:80px;" value="<?=$children_array[0]?>" maxlength="10">
											</td>
											<td nowrap class="tdrow">
												<input name="children_name4" type="text" class="textfm" style="width:80px;" value="<?=$children_array[1]?>" maxlength="10">
											</td>
											<td nowrap class="tdrow">
												<input name="children_ssnb4" type="text" class="textfm" style="width:120px;" value="<?=$children_array[2]?>" maxlength="14">
											</td>
											<td nowrap class="tdrow">
												<input name="children_cohabitation4" type="checkbox" value="1" <?=$children_checked?> class="checkbox"> ����
											</td>
										</tr>
										<tr>
<?
$children_array = explode(",",$row1['children5']);
if($children_array[3]) $children_checked = "checked";
else $children_checked = "";
?>
											<td nowrap class="tdrow_center">5</td>
											<td nowrap class="tdrow">
												<input name="children_relation5" type="text" class="textfm" style="width:80px;" value="<?=$children_array[0]?>" maxlength="10">
											</td>
											<td nowrap class="tdrow">
												<input name="children_name5" type="text" class="textfm" style="width:80px;" value="<?=$children_array[1]?>" maxlength="10">
											</td>
											<td nowrap class="tdrow">
												<input name="children_ssnb5" type="text" class="textfm" style="width:120px;" value="<?=$children_array[2]?>" maxlength="14">
											</td>
											<td nowrap class="tdrow">
												<input name="children_cohabitation5" type="checkbox" value="1" <?=$children_checked?> class="checkbox"> ����
											</td>
<?
$children_array = explode(",",$row1['children6']);
if($children_array[3]) $children_checked = "checked";
else $children_checked = "";
?>
											<td nowrap class="tdrow_center">6</td>
											<td nowrap class="tdrow">
												<input name="children_relation6" type="text" class="textfm" style="width:80px;" value="<?=$children_array[0]?>" maxlength="10">
											</td>
											<td nowrap class="tdrow">
												<input name="children_name6" type="text" class="textfm" style="width:80px;" value="<?=$children_array[1]?>" maxlength="10">
											</td>
											<td nowrap class="tdrow">
												<input name="children_ssnb6" type="text" class="textfm" style="width:120px;" value="<?=$children_array[2]?>" maxlength="14">
											</td>
											<td nowrap class="tdrow">
												<input name="children_cohabitation6" type="checkbox" value="1" <?=$children_checked?> class="checkbox"> ����
											</td>
										</tr>
									</table>
								</div>

								<div style="height:10px;font-size:0px;line-height:0px;"></div>
								<!--��޴� -->
								<table border=0 cellspacing=0 cellpadding=0> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:130px;text-align:center'> 
														<a href="javascript:tab_view('support');">������ �����</a>
													</td> 
													<td><img src="images/g_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width=2></td> 
										<td valign="bottom"></td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!--��޴� -->
<?
$support_display = "display:none";
?>
								<div id="support" style="<?=$support_display?>">
								<?
								$fund_array = explode(",",$row2['fund']);
								if($fund_array[0] == 1) $fund_chk1 = "checked";
								if($fund_array[1] == 1) $fund_chk2 = "checked";
								if($fund_array[2] == 1) $fund_chk3 = "checked";
								if($fund_array[3] == 1) $fund_chk4 = "checked";
								if($fund_array[4] == 1) $fund_chk5 = "checked";
								if($fund_array[5] == 1) $fund_chk6 = "checked";
								if($fund_array[6] == 1) $fund_chk7 = "checked";
								if($fund_array[7] == 1) $fund_chk8 = "checked";
								if($fund_array[8] == 1) $fund_chk9 = "checked";
								if($fund_array[9] == 1) $fund_chk10 = "checked";
								if($fund_array[10] == 1) $fund_chk11 = "checked";
								if($fund_array[11] == 1) $fund_chk12 = "checked";
								?>

								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
									<col width="5%">
									<col width="18%">
									<col width="20%">
									<col width="22%">
									<col width="25%">
									<tr>
										<td class="tdrowk_center" rowspan="3" style="font-weight:bold">��<br>��</td>
										<td class="tdrow"><input type="checkbox" name="fund[0]" value="1" class="checkbox" <?=$fund_chk1?>> ���������Ű��</td>
										<td class="tdrow"><input type="checkbox" name="fund[1]" value="1" class="checkbox" <?=$fund_chk2?>> 50+�����������������</td>
										<td class="tdrow"><input type="checkbox" name="fund[2]" value="1" class="checkbox" <?=$fund_chk3?>> ���������Ʒ� ���α׷�</td>
										<td class="tdrow"><input type="checkbox" name="fund[3]" value="1" class="checkbox" <?=$fund_chk4?>> ����� ����ɷ�������α׷�</td>
									</tr>
									<tr>
										<td class="tdrow"><input type="checkbox" name="fund[4]" value="1" class="checkbox" <?=$fund_chk5?>> ������ ���α׷�</td>
										<td class="tdrow"><input type="checkbox" name="fund[5]" value="1" class="checkbox" <?=$fund_chk6?>> �����ɷ°����Ʒ� ���α׷�</td>
										<td class="tdrow"><input type="checkbox" name="fund[6]" value="1" class="checkbox" <?=$fund_chk7?>> ������Ȱ ���α׷�</td>
										<td class="tdrow"><input type="checkbox" name="fund[7]" value="1" class="checkbox" <?=$fund_chk8?>> �о��ߴ� û�ҳ� �ڸ�/�н����� ���</td>
									</tr>
									<tr>
										<td class="tdrow"><input type="checkbox" name="fund[8]" value="1"  class="checkbox" <?=$fund_chk9?> > ��Ȱ�ٷ�(������ü��ü)</td>
										<td class="tdrow"><input type="checkbox" name="fund[9]" value="1" class="checkbox" <?=$fund_chk10?>> ������� ������Ʈ</td>
										<td class="tdrow"><input type="checkbox" name="fund[10]" value="1" class="checkbox" <?=$fund_chk11?>> ����� ������ڸ� ���� ���α׷�</td>
										<td class="tdrow"><input type="checkbox" name="fund[11]" value="1" class="checkbox" <?=$fund_chk12?>> �����⺻����(�ѱ����ƺ����Ƿ����)</td>
									</tr>
								</table>
								</div>

								<div style="height:10px;font-size:0px;line-height:0px;"></div>
								<!--��޴� -->
								<table border=0 cellspacing=0 cellpadding=0> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:160px;text-align:center'> 
														<a href="javascript:tab_view('person');">�з�/���/����/�ڰ�/����</a>
													</td> 
													<td><img src="images/g_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width=2></td> 
										<td valign="bottom"></td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!--��޴� -->
<?
$person_display = "display:none";
?>
								<div id="person" style="<?=$person_display?>">
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
									<col width="5%">
									<col width="40%">
									<col width="30%">
									<col width="25%">
									<tr>
										<td class="tdrowk_center" rowspan="4" style="font-weight:bold">��<br>��</td>
										<td class="tdrowk_center">�� ��</td>
										<td class="tdrowk_center">�б��� �� �����а�</td>
										<td class="tdrowk_center">�� ��</td>
									</tr>
									<tr>
										<td class="tdrow">
											<input size="14" type="text" class="textfm" name="school_sdate" value="<?=$row2['school_sdate']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '3','Y')" /> ~
											<input size="14" type="text" class="textfm" name="school_edate" value="<?=$row2['school_edate']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '4','Y')" /> ��) 2001.03.02~2005.02.10
										</td>
										<td class="tdrow">
											<input size="40" type="text" class="textfm" name="school_name" value="<?=$row2['school_name']?>" />
										</td>
										<td class="tdrow">
											<input size="33" type="text" class="textfm" name="school_part" value="<?=$row2['school_part']?>" />
										</td>
									</tr>
									<tr>
										<td class="tdrow">
											<input size="14" type="text" class="textfm" name="school_sdate2" value="<?=$row2['school_sdate2']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '5','Y')" /> ~
											<input size="14" type="text" class="textfm" name="school_edate2" value="<?=$row2['school_edate2']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '6','Y')" />
										</td>
										<td class="tdrow">
											<input size="40" type="text" class="textfm" name="school_name2" value="<?=$row2['school_name2']?>" />
										</td>
										<td class="tdrow">
											<input size="33" type="text" class="textfm" name="school_part2" value="<?=$row2['school_part2']?>" />
										</td>
									</tr>
									<tr>
										<td class="tdrow">
											<input size="14" type="text" class="textfm" name="school_sdate3" value="<?=$row2['school_sdate3']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '7','Y')" /> ~
											<input size="14" type="text" class="textfm" name="school_edate3" value="<?=$row2['school_edate3']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '8','Y')" />
										</td>
										<td class="tdrow">
											<input size="40" type="text" class="textfm" name="school_name3" value="<?=$row2['school_name3']?>" />
										</td>
										<td class="tdrow">
											<input size="33" type="text" class="textfm" name="school_part3" value="<?=$row2['school_part3']?>" />
										</td>
									</tr>
								</table>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
									<col width="5%">
									<col width="40%">
									<col width="30%">
									<col width="25%">
									<tr>
										<td class="tdrowk_center" rowspan="4" style="font-weight:bold">��<br>��</td>
										<td class="tdrowk_center">�� ��</td>
										<td class="tdrowk_center">�ٹ�ó</td>
										<td class="tdrowk_center">�� ��</td>
									</tr>
									<tr>
										<td class="tdrow">
											<input size="14" type="text" class="textfm" name="career_sdate" value="<?=$row2['career_sdate']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '9','Y')" /> ~
											<input size="14" type="text" class="textfm" name="career_edate" value="<?=$row2['career_edate']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '10','Y')" /> ��) 2001.03.02~2005.02.10
										</td>
										<td class="tdrow">
											<input size="40" type="text" class="textfm" name="career_name" value="<?=$row2['career_name']?>" />
										</td>
										<td class="tdrow">
											<input size="33" type="text" class="textfm" name="career_part" value="<?=$row2['career_part']?>" />
										</td>
									</tr>
									<tr>
										<td class="tdrow">
											<input size="14" type="text" class="textfm" name="career_sdate2" value="<?=$row2['career_sdate2']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '11','Y')" /> ~
											<input size="14" type="text" class="textfm" name="career_edate2" value="<?=$row2['career_edate2']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '12','Y')" />
										</td>
										<td class="tdrow">
											<input size="40" type="text" class="textfm" name="career_name2" value="<?=$row2['career_name2']?>" />
										</td>
										<td class="tdrow">
											<input size="33" type="text" class="textfm" name="career_part2" value="<?=$row2['career_part2']?>" />
										</td>
									</tr>
									<tr>
										<td class="tdrow">
											<input size="14" type="text" class="textfm" name="career_sdate3" value="<?=$row2['career_sdate3']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '13','Y')" /> ~
											<input size="14" type="text" class="textfm" name="career_edate3" value="<?=$row2['career_edate3']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '14','Y')" />
										</td>
										<td class="tdrow">
											<input size="40" type="text" class="textfm" name="career_name3" value="<?=$row2['career_name3']?>" />
										</td>
										<td class="tdrow">
											<input size="33" type="text" class="textfm" name="career_part3" value="<?=$row2['career_part3']?>" />
										</td>
									</tr>
								</table>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
									<col width="5%">
									<col width="40%">
									<col width="30%">
									<col width="25%">
									<tr>
										<td class="tdrowk_center" rowspan="4" style="font-weight:bold">����<br>�̼�</td>
										<td class="tdrowk_center">�� ��</td>
										<td class="tdrowk_center">�� ��</td>
										<td class="tdrowk_center">�Ʒñ��</td>
									</tr>
									<tr>
										<td class="tdrow">
											<input size="14" type="text" class="textfm" name="education_sdate" value="<?=$row2['education_sdate']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '17','Y')" /> ~
											<input size="14" type="text" class="textfm" name="education_edate" value="<?=$row2['education_edate']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '18','Y')" /> ��) 2001.03.02~2005.02.10
										</td>
										<td class="tdrow">
											<input size="40" type="text" class="textfm" name="education_name" value="<?=$row2['education_name']?>" />
										</td>
										<td class="tdrow">
											<input size="33" type="text" class="textfm" name="education_organization" value="<?=$row2['education_organization']?>" />
										</td>
									</tr>
									<tr>
										<td class="tdrow">
											<input size="14" type="text" class="textfm" name="education_sdate2" value="<?=$row2['education_sdate2']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '19','Y')" /> ~
											<input size="14" type="text" class="textfm" name="education_edate2" value="<?=$row2['education_edate2']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '20','Y')" />
										</td>
										<td class="tdrow">
											<input size="40" type="text" class="textfm" name="education_name2" value="<?=$row2['education_name2']?>" />
										</td>
										<td class="tdrow">
											<input size="33" type="text" class="textfm" name="education_organization2" value="<?=$row2['education_organization2']?>" />
										</td>
									</tr>
									<tr>
										<td class="tdrow">
											<input size="14" type="text" class="textfm" name="education_sdate3" value="<?=$row2['education_sdate3']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '21','Y')" /> ~
											<input size="14" type="text" class="textfm" name="education_edate3" value="<?=$row2['education_edate3']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '22','Y')" />
										</td>
										<td class="tdrow">
											<input size="40" type="text" class="textfm" name="education_name3" value="<?=$row2['education_name3']?>" />
										</td>
										<td class="tdrow">
											<input size="33" type="text" class="textfm" name="education_organization3" value="<?=$row2['education_organization3']?>" />
										</td>
									</tr>
								</table>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
									<col width="5%">
									<col width="22%">
									<col width="30%">
									<col width="20%">
									<col width="23%">
									<tr>
										<td class="tdrowk_center" rowspan="4" style="font-weight:bold">�ڰ�<br>����</td>
										<td class="tdrowk_center">�������</td>
										<td class="tdrowk_center">�ڰ�/�����</td>
										<td class="tdrowk_center">�ڰݹ�ȣ</td>
										<td class="tdrowk_center">������</td>
									</tr>
									<tr>
										<td class="tdrow">
											<input size="14" type="text" class="textfm" name="license_date" value="<?=$row2['license_date']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '23','Y')" /> ��) 2012.12.10
										</td>
										<td class="tdrow">
											<input size="40" type="text" class="textfm" name="license_name" value="<?=$row2['license_name']?>" />
										</td>
										<td class="tdrow">
											<input size="26" type="text" class="textfm" name="license_step" value="<?=$row2['license_step']?>" />
										</td>
										<td class="tdrow">
											<input size="29" type="text" class="textfm" name="license_organization" value="<?=$row2['license_organization']?>" />
										</td>
									</tr>
									<tr>
										<td class="tdrow">
											<input size="14" type="text" class="textfm" name="license_date2" value="<?=$row2['license_date2']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '24','Y')" />
										</td>
										<td class="tdrow">
											<input size="40" type="text" class="textfm" name="license_name2" value="<?=$row2['license_name2']?>" />
										</td>
										<td class="tdrow">
											<input size="26" type="text" class="textfm" name="license_step2" value="<?=$row2['license_step2']?>" />
										</td>
										<td class="tdrow">
											<input size="29" type="text" class="textfm" name="license_organization2" value="<?=$row2['license_organization2']?>" />
										</td>
									</tr>
									<tr>
										<td class="tdrow">
											<input size="14" type="text" class="textfm" name="license_date3" value="<?=$row2['license_date3']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '25','Y')" />
										</td>
										<td class="tdrow">
											<input size="40" type="text" class="textfm" name="license_name3" value="<?=$row2['license_name3']?>" />
										</td>
										<td class="tdrow">
											<input size="26" type="text" class="textfm" name="license_step3" value="<?=$row2['license_step3']?>" />
										</td>
										<td class="tdrow">
											<input size="29" type="text" class="textfm" name="license_organization3" value="<?=$row2['license_organization3']?>" />
										</td>
									</tr>
								</table>
								</div>
							</div>
							<!--tab1-->

							<div id="tab2" style="display:none">
								<!--���� ������-->
								<?
								if(!$code) $code = $com_code;
								if($check_money_min_2014_yn == "Y") {
									$money_min_time_var = $money_min_time_2014;
								} else {
									$money_min_time_var = $money_min_time;
								}
								?>

								<input type="hidden" name="w" value="<?=$w?>">
								<input type="hidden" name="page" value="<?=$page?>">
								<input type="hidden" name="code" value="<?=$code?>">
								<input type="hidden" name="id" value="<?=$id?>">
								<input type="hidden" name="tab" value="<?=$tab?>">

								<input type="hidden" name="money_month" value="0"><!-- �⺻(��)�� -->
								<input type="hidden" name="money_min_time" value="<?=$money_min_time_var?>"><!-- �⺻�ñ� -->
								<input type="hidden" name="money_hour" value="<?=$money_min_time?>"><!-- ���ؽñ� -->
								<input type="hidden" name="money_min" value="0"><!-- �⺻�� -->

								<input type="hidden" name="workhour_day" value="24"><!-- 1���� �ٷνð� -->
								<input type="hidden" name="workhour_ext" value="0"><!-- 1���� ����ٷνð� -->
								<input type="hidden" name="workhour_hday" value="0"><!-- 1���� ���ϱٷνð� -->
								<input type="hidden" name="workhour_night" value="0"><!-- 1���� �߰��ٷνð� -->
								<input type="hidden" name="workhour_total" value="0"><!-- 1���� �ѱٷνð� -->
								<input type="hidden" name="workhour_total2" value=""><!-- 1���� �ѱٷνð�(�ٷΰ�༭��) -->
								<input type="hidden" name="workhour_total3" value=""><!-- 1���� �ѱٷνð�(�ӱݻ����) -->

								<input type="hidden" name="workhour_day_w" value="0"><!-- 1�� �ٷνð� -->
								<input type="hidden" name="workhour_ext_w" value="0"><!-- 1�� ����ٷνð� -->
								<input type="hidden" name="workhour_hday_w" value="0"><!-- 1�� ���ϱٷνð� -->
								<input type="hidden" name="workhour_night_w" value="0"><!-- 1�� �߰��ٷνð� -->
								<input type="hidden" name="workhour_total_w" value="0"><!-- 1�� �ѱٷνð� -->
								<input type="hidden" name="workhour_total2_w" value=""><!-- 1�� �ѱٷνð�(�ٷΰ�༭��) -->
								<input type="hidden" name="workhour_total3_w" value=""><!-- 1�� �ѱٷνð�(�ӱݻ����) -->

								<input type="hidden" name="workhour_day_d" value=""><!-- 1�� �ٷνð� -->
								<input type="hidden" name="money_hour_ts" value=""><!-- ����ӱ� (�ð���) -->
								<!--<input type="hidden" name="money_hour_ds" value="">--><!-- ����ӱ� (�ϱ�) -->

								<input type="hidden" name="money_min_base" value=""><!-- �⺻�ñ� -->

								<input type="hidden" name="money_g1" value="<?=$row4['money_g1']?>"><!-- ���������� -->
								<input type="hidden" name="money_g2" value="0"><!-- ���������� -->
								<input type="hidden" name="money_g3" value="0"><!-- ���������� -->
								<input type="hidden" name="money_g4" value="0"><!-- ���������� -->
								<input type="hidden" name="money_g5" value="0"><!-- ���������� -->
								<input type="hidden" name="money_b1" value="0"><!-- ��������� -->
								<input type="hidden" name="money_b2" value="0"><!-- ��������� -->
								<input type="hidden" name="money_b3" value="0"><!-- ��������� -->
								<input type="hidden" name="money_b4" value="0"><!-- ��������� -->
								<input type="hidden" name="money_b5" value="0"><!-- ��������� -->

								<input type="hidden" name="money_e1" value="0"><!-- ��������� -->
								<input type="hidden" name="money_e2" value="0"><!-- ��������� -->
								<input type="hidden" name="money_e3" value="0"><!-- ��������� -->
								<input type="hidden" name="money_e4" value="0"><!-- ��������� -->
								<input type="hidden" name="money_e5" value="0"><!-- ��������� -->
								<input type="hidden" name="money_e6" value="0"><!-- ��������� -->
								<input type="hidden" name="money_e7" value="0"><!-- ��������� -->
								<input type="hidden" name="money_e8" value="0"><!-- ��������� -->

								<input type="hidden" name="week_hday" value="4"><!-- �����ϼ� -->
								<input type="hidden" name="year_hday" value="0"><!-- ���������ް��ϼ� -->

								<input type="hidden" name="money_base" value=""><!-- �⺻�� -->
								<input type="hidden" name="money_ext" value=""><!-- ����ٷμ��� -->
								<input type="hidden" name="money_hday" value=""><!-- ���ϱٷμ��� -->
								<input type="hidden" name="money_night" value=""><!-- �߰��ٷμ��� -->

								<input type="hidden" name="money_year_yn" value=""><!-- �������� ���޿��� -->
								<input type="hidden" name="workhour_year" value=""><!-- �����ް� �ð� -->
								<input type="hidden" name="money_year" value=""><!-- �������� -->

								<input type="hidden" name="money_month_base" value=""><!-- �����޾�, ������ �⺻��+�������� ���� ���ʱݾ� -->
								<input type="hidden" name="check_worktime_d_yn" value="N"><!-- 1�� �ٷνð��� �������� �Է� -->
								<input type="hidden" name="check_worktime_w_yn" value="N"><!-- 1�� �ٷνð��� �������� �Է� -->
								<input type="hidden" name="check_worktime_yn" value="N"><!-- 1���� �ٷνð��� �������� �Է� -->
								<input type="hidden" name="check_money_min_yn" value="N"><!-- �⺻�� ���� �Է� -->
								<input type="hidden" name="check_money_min_2014_yn" value="N"><!-- �����ñ�(2014��) ���� �Է� -->
								<input type="hidden" name="check_money_b_yn" value="N"><!-- �������� ���� �Է� -->

								<input type="hidden" name="work_numb" value="82">
								<input type="hidden" name="emp_yn" value="Y">
								<input type="hidden" name="work_numb_other" value="">
								<input type="hidden" name="cust_numb" value="98">
								<input type="hidden" name="url" value="staff_view.php">
								<input type="hidden" name="frmurl" value="staff_update.php">
								<input type="hidden" name="mode" value="update">
								<!--��޴� -->
								<table border=0 cellspacing=0 cellpadding=0> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
													��������
													</td> 
													<td><img src="images/g_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width=2></td> 
										<td valign="bottom"></td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!--��޴� -->
								<?
								//�����ӱ�
								//$pay_year = "1100000";
								if($row4['money_month_base'])	{
									$pay_year = $row4['money_month_base'];
								} else {
									$pay_year = 0;
								}
								//���ؽñ�
								if($row4[money_hour_ds]) {
									$money_hour = $row4[money_hour_ds];
								} else {
									//�����ñ� 2016��
									$money_hour = $money_min_time;
								}
								//�⺻��
								if($row4[money_hour_ms])	{
									$money_hour_ms = number_format($row4[money_hour_ms]);
								}
								?>
								<input type="hidden" name="pay_month" id="pay_month" value="<?=$pay_year?>" />
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<col width="11%">
									<col width="23%">
									<col width="12%">
									<col width="20%">
									<col width="10%">
									<col width="24%">
									<tr>
										<td class="tdrowk_center">����</td>
										<td class="tdrow">
<?
if($row2[pay_gbn] == "") $row2[pay_gbn] = "0";
?>
											<input type="radio" name="pay_gbn" value="0" onclick="displayPayGbn();" <? if($row2[pay_gbn] == "0") echo "checked"; ?> >������
											<input type="radio" name="pay_gbn" value="1" onclick="displayPayGbn();" <? if($row2[pay_gbn] == "1") echo "checked"; ?> >�ñ���
											<input type="radio" name="pay_gbn" value="2" onclick="displayPayGbn();" <? if($row2[pay_gbn] == "2") echo "checked"; ?> style="display:none"><!--���ձٹ�-->
											<input type="radio" name="pay_gbn" value="3" onclick="displayPayGbn();" <? if($row2[pay_gbn] == "3") echo "checked"; ?> >������
										</td>
										<td class="tdrowk_center">�ֱٷνð�</td>
										<td class="tdrow">
											<input type="radio" name="work_gbn" value="A" onclick="work_gbn_chk(this.value);" <? if($work_gbn_checked == "A") echo "checked"; ?> >��40�ð�
											<input type="radio" name="work_gbn" value="B" onclick="work_gbn_chk(this.value);" <? if($work_gbn_checked == "B") echo "checked"; ?> >��44�ð�
											<!--�ְ� �ٷ��� ���� ��-->
											<input name="workday_month" type="hidden" value="<?=$row_com_opt[workday_month]?>">
											<span id="workday_month_text" style="display:none;"></span>
											<input tyle="hidden" id="workday_week" name="workday_week" style="display:none;"></span>
										</td>
										<td class="tdrowk_center">����</td>
										<td class="tdrow">
											<input name="annual_paid_holiday" type="text" class="textfm" style="width:35px;ime-mode:disabled;" value="<?=$row4[annual_paid_holiday]?>" maxlength="2" onKeyPress="onlyNumber();"> ��) 15
											<!--<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="./calculator/s2.html?mode=staff" target="" onclick="cal_open(this.href,'s2',960,680);return false;">������ȸ</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table>-->
										</td>
									</tr>
									<tr>
										<td class="tdrowk_center">����(��å)</td>
										<td class="tdrow">
											<select name="position" onchange="position_set('position',this.value);">
												<option value="">����</option>
												<?
												$sql_position = " select * from com_code_list where item='position' and com_code='$code' ";
												$result_position = sql_query($sql_position);
												for($i=0; $row_position=sql_fetch_array($result_position); $i++) {
												?>

												<option value="<?=$row_position[code]?>" <? if($row2[position] == $row_position[code]) echo "selected"; ?> ><?=$row_position[name]?></option>
												<?
												}
												?>

											</select>
										</td>
										<td class="tdrowk_center">ȣ��</td>
										<td class="tdrow">
											<select name="step" onchange="position_set('step',this.value);">
												<option value="">����</option>
												<?
												$sql_step = " select * from com_code_list where item='step' and com_code='$code' order by code ";
												$result_step = sql_query($sql_step);
												for($i=0; $row_step=sql_fetch_array($result_step); $i++) {
												?>

												<option value="<?=$row_step[code]?>" <? if($row2[step] == $row_step[code]) echo "selected"; ?> ><?=$row_step[name]?></option>
												<?
												}
												?>

											</select>
										</td>
										<td class="tdrowk_center"></td>
										<td class="tdrow">

										</td>
									</tr>
								</table>

								<div style="height:10px;font-size:0px;line-height:0px;"></div>

								<!--��޴� -->
								<table border=0 cellspacing=0 cellpadding=0> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
													�󿩱�
													</td> 
													<td><img src="images/g_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width=2></td> 
										<td valign="bottom"></td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!--��޴� -->
<?
$bonus_array = explode(",",$row4[bonus_time]);
if($bonus_array[0] == "") $bonus_time1 = "��";
else $bonus_time1 = $bonus_array[0];
if($bonus_array[1] == "") $bonus_time2 = "�߼�";
else $bonus_time2 = $bonus_array[1];
if($bonus_array[2] == "") $bonus_time3 = "�ϱ��ް�";
else $bonus_time3 = $bonus_array[2];
if($bonus_array[3] == "") $bonus_time4 = "����";
else $bonus_time4 = $bonus_array[3];
if($bonus_array[4] == "") $bonus_time5 = "";
else $bonus_time5 = $bonus_array[4];
if($bonus_array[5] == "") $bonus_time6 = "";
else $bonus_time6 = $bonus_array[5];
$bonus_p = explode(",",$row4[bonus_p]);
//�󿩱� �����Է�
$check_bonus_money_yn = $row4[check_bonus_money_yn];
$bonus_money = $row4[bonus_money];
?>
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<tr>
										<td class="tdrowk_center">�� ��</td>
										<td class="tdrowk">��������</td>
										<td class="tdrowk">���޽ñ�1</td>
										<td class="tdrowk">���޽ñ�2</td>
										<td class="tdrowk">���޽ñ�3</td>
										<td class="tdrowk">���޽ñ�4</td>
										<td class="tdrowk">���޽ñ�5</td>
										<td class="tdrowk">���޽ñ�6</td>
									</tr>
									<tr>
										<td class="tdrowk" style="padding:5px">��Ī</td>
										<td class="tdrow" width="140">
											<select name="bonus_standard" id="bonus_standard" class="selectfm" style="width:74px;<? if($check_bonus_money_yn == "Y") echo "display:none"; else echo "display:inline"; ?>">
												<option value="1" <? if($row4[bonus_standard] == "1") echo "selected"; ?> >�⺻��</option>
												<option value="2" <? if($row4[bonus_standard] == "2") echo "selected"; ?> >�����ӱ�</option>
												<option value="3" <? if($row4[bonus_standard] == "3") echo "selected"; ?> >����ӱ�</option>
												<option value="4" <? if($row4[bonus_standard] == "4") echo "selected"; ?> >�ѱ޿�</option>
											</select>
											<input name="bonus_money" id="bonus_money" type="text" class="textfm" style="width:76px;ime-mode:disabled;<? if($check_bonus_money_yn != "Y") echo "display:none"; else echo "display:inline"; ?>" value="<?=number_format($bonus_money)?>" maxlength="10" onblur="" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')">
											<input type="checkbox" name="check_bonus_money_yn" id="check_bonus_money_yn" value="<?=$check_bonus_money_yn?>" <? if($check_bonus_money_yn == "Y") echo "checked"; ?> onClick="checkBonus_MoneyYn()">����
										</td>
										<td class="tdrow"><input name="bonus[0]" type="text" class="textfm" style="width:60px;ime-mode:;" value="<?=$bonus_time1?>" maxlength="10"></td>
										<td class="tdrow"><input name="bonus[1]" type="text" class="textfm" style="width:60px;ime-mode:;" value="<?=$bonus_time2?>" maxlength="10"></td>
										<td class="tdrow"><input name="bonus[2]" type="text" class="textfm" style="width:60px;ime-mode:;" value="<?=$bonus_time3?>" maxlength="10"></td>
										<td class="tdrow"><input name="bonus[3]" type="text" class="textfm" style="width:60px;ime-mode:;" value="<?=$bonus_time4?>" maxlength="10"></td>
										<td class="tdrow"><input name="bonus[4]" type="text" class="textfm" style="width:60px;ime-mode:;" value="<?=$bonus_time5?>" maxlength="10"></td>
										<td class="tdrow"><input name="bonus[5]" type="text" class="textfm" style="width:60px;ime-mode:;" value="<?=$bonus_time6?>" maxlength="10"></td>
									</tr>
									<tr>
										<td class="tdrowk">�󿩺���</td>
										<td class="tdrow"><input name="bonus_percent" type="text" class="textfm" style="width:60px;ime-mode:disabled;" value="<?=$row4[bonus_percent]?>" maxlength="3">%</td>
										<td class="tdrow"><input name="bonus_p[0]" type="text" class="textfm" style="width:60px;ime-mode:disabled;" value="<?=$bonus_p[0]?>" maxlength="3">%</td>
										<td class="tdrow"><input name="bonus_p[1]" type="text" class="textfm" style="width:60px;ime-mode:disabled;" value="<?=$bonus_p[1]?>" maxlength="3">%</td>
										<td class="tdrow"><input name="bonus_p[2]" type="text" class="textfm" style="width:60px;ime-mode:disabled;" value="<?=$bonus_p[2]?>" maxlength="3">%</td>
										<td class="tdrow"><input name="bonus_p[3]" type="text" class="textfm" style="width:60px;ime-mode:disabled;" value="<?=$bonus_p[3]?>" maxlength="3">%</td>
										<td class="tdrow"><input name="bonus_p[4]" type="text" class="textfm" style="width:60px;ime-mode:disabled;" value="<?=$bonus_p[4]?>" maxlength="3">%</td>
										<td class="tdrow"><input name="bonus_p[5]" type="text" class="textfm" style="width:60px;ime-mode:disabled;" value="<?=$bonus_p[5]?>" maxlength="3">%</td>
									</tr>
								</table>

								<!--���/�޿����� �Է�-->
							</form>
							<!--�⺻�� dataForm-->

							<div style="height:10px;font-size:0px;line-height:0px;"></div>

							<!-- ������ / ���ձٹ� -->
							<form name="formSalary" id="formSalary" style="margin:0display:;">
								<!--<input type="hidden" name="workhour_day_d" value="8">--><!-- 1�� �ٷνð� -->
								<input type="hidden" name="money_month_" value="0"><!-- �⺻(��)�� -->
								<input name="workhour_total2_w" type="hidden" class="textfm5" style="width:60;ime-mode:disabled;" value="" maxlength="10" readonly>
								<input name="workhour_total2" type="hidden" class="textfm5" style="width:60;ime-mode:disabled;" value="" maxlength="10" readonly>
								<input name="workhour_total3_w" type="hidden" class="textfm5" style="width:60;ime-mode:disabled;" value="" maxlength="10" readonly>
								<input name="workhour_total3" type="hidden" class="textfm5" style="width:60;ime-mode:disabled;" value="" maxlength="10" readonly>

								<!--��޴� -->
								<table border=0 cellspacing=0 cellpadding=0> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
													�ٷνð�
													</td> 
													<td><img src="images/g_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width=2></td> 
										<td valign="bottom"></td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!--��޴� -->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed;">
									<tr>
										<td class="tdrowk_center" width="142">�� ��</td>
										<td class="tdrowk"><b>����</b>�ٷνð�</td>
										<td class="tdrowk"><b>����</b>�ٷνð�</td>
										<td class="tdrowk"><b>�߰�</b>�ٷνð�</td>
										<td class="tdrowk"><b>����</b>�ٷνð�</td>
										<td class="tdrowk"><b>��</b>�ٷνð�</td>
									</tr>
									<tr>
										<td class="tdrowk"><b>1��</b>�ٷνð� <input type="checkbox" name="check_worktime_d_yn" value="Y" <? if($check_worktime_d_yn == "Y") echo "checked"; ?> onClick="checkWorkTime_dYn()">����</td>
										<td class="tdrow"><input name="workhour_day_d" type="text" class="textfm5" style="width:60px;ime-mode:disabled;" value="<?=$workhour_day_d?>" maxlength="10" onblur="setWorkHour('day')" readonly> �ð�</td>
										<td class="tdrow"></td>
										<td class="tdrow"></td>
										<td class="tdrow"></td>
										<td class="tdrow"></td>
									</tr>
									<tr>
										<td class="tdrowk"><b>1��</b>�ٷνð� <input type="checkbox" name="check_worktime_w_yn" value="Y" <? if($check_worktime_w_yn == "Y") echo "checked"; ?> onClick="checkWorkTime_wYn()">����</td>
										<td class="tdrow"><input name="workhour_day_w" type="text" class="textfm5" style="width:60px;ime-mode:disabled;" value="<?=$workhour_day_w?>" maxlength="10" onblur="setWorkHour('day')" readonly> �ð�</td>
										<td class="tdrow"><input name="workhour_ext_w" type="text" class="textfm5" style="width:60px;ime-mode:disabled;" value="<?=$workhour_ext_w?>" maxlength="10" onblur="setWorkHour('ext')" readonly> �ð�</td>
										<td class="tdrow"><input name="workhour_night_w" type="text" class="textfm5" style="width:60px;ime-mode:disabled;" value="<?=$workhour_night_w?>" maxlength="10" onblur="setWorkHour('night')" readonly> �ð�</td>
										<td class="tdrow"><input name="workhour_hday_w" type="text" class="textfm5" style="width:60px;ime-mode:disabled;" value="<?=$workhour_hday_w?>" maxlength="10" onblur="setWorkHour('hday')" readonly> �ð�</td>
										<td class="tdrow"><input name="workhour_total_w" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="<?=$workhour_total_w?>" maxlength="10" readonly> �ð�</td>
									</tr>
									<tr>
										<td class="tdrowk"><b>1����</b>�ٷνð� <input type="checkbox" name="check_worktime_yn" value="Y" <? if($row4[check_worktime_yn] == "Y") echo "checked"; ?> onClick="checkWorkTimeYn()">����</td>
										<td class="tdrow"><input name="workhour_day" type="text" class="textfm5" style="width:60px;ime-mode:disabled;" value="<?=$workhour_day?>" maxlength="10" onblur="setWorkHour()" readonly>�ð�</td>
										<td class="tdrow"><input name="workhour_ext" type="text" class="textfm5" style="width:60px;ime-mode:disabled;" value="<?=$workhour_ext?>" maxlength="10" onblur="setWorkHour()" readonly> �ð�</td>
										<td class="tdrow"><input name="workhour_night" type="text" class="textfm5" style="width:60px;ime-mode:disabled;" value="<?=$workhour_night?>" maxlength="10" onblur="setWorkHour()" readonly> �ð�</td>
										<td class="tdrow"><input name="workhour_hday" type="text" class="textfm5" style="width:60px;ime-mode:disabled;" value="<?=$workhour_hday?>" maxlength="10" onblur="setWorkHour()" readonly> �ð�</td>
										<td class="tdrow"><input name="workhour_total" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="<?=$workhour_total?>" maxlength="10" readonly> �ð�</td>
									</tr>
									<tr>
										<td class="tdrowk"><b>�ٷμ���</td>
										<td class="tdrow"></td>
										<td class="tdrow"><input name="money_ext" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="<?=$money_ext?>" maxlength="10" readonly> ��</td>
										<td class="tdrow"><input name="money_night" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="<?=$money_night?>" maxlength="10" readonly> ��</td>
										<td class="tdrow"><input name="money_hday" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="<?=$money_hday?>" maxlength="10" readonly> ��</td>
										<td class="tdrow"></td>
								</table>
								<div style="height:10px;font-size:0px;line-height:0px;"></div>

								<!--��޴� -->
								<table border=0 cellspacing=0 cellpadding=0> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0>
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
														<span id="decision"><? if($row2[pay_gbn] == "1") echo "���ؽñ�"; else echo "�����ӱ�"; ?></span>
													</td> 
													<td><img src="images/g_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width=2></td> 
										<td valign="bottom"></td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!--��޴� -->

								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
									<tr>
										<td class="tdrowk_center">�� <span id="decision_txt"><? if($row2[pay_gbn] == "1") echo "���ؽñ�"; else echo "�����ӱ�"; ?></span></td>
										<td class="tdrow">
											<div id="decision_div" style="<? if($row2[pay_gbn] == "1") echo "display:none"; else echo "display:inline"; ?>">
												<input name="money_month_base" id="money_month_base" type="text" class="textfm" style="width:70px;ime-mode:disabled;" value="<?=number_format($pay_year)?>" maxlength="10" onblur="setWorkHour();" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"> ��
												<table border=0 cellpadding=0 cellspacing=0 style="display:inline;<? if($row2[pay_gbn] == "1") echo "display:none"; ?>" id="decision_reset" ><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:money_month_base_reset();" target="">�ٽ��Է�</a></td><td><img src=./images/btn2_rt.gif></td><td width=2></td></tr></table>
											</div>
											<div id="decision_div2" style="<? if($row2[pay_gbn] == "0") echo "display:none"; else echo "display:inline"; ?>">
												<input name="money_hour"       id="money_hour"       type="text" class="textfm" style="width:70px;ime-mode:disabled;" value="<?=number_format($money_hour)?>" maxlength="10" onblur="setWorkHour();" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"> ��
												<table border=0 cellpadding=0 cellspacing=0 style="display:inline;<? if($row2[pay_gbn] == "0") echo "display:none"; ?>" id="decision_reset2"><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:money_hour_reset();" target="">�ٽ��Է�</a></td><td><img src=./images/btn2_rt.gif></td><td width=2></td></tr></table>
											</div>
										</td>
										<td class="tdrowk_center"></td>
										<td class="tdrow">
											
										</td>
									</tr>
								</table>
								<div style="margin:4px 0 0 0;color:red;display:none" id="base_down">�⺻���� �����ӱݿ� �̴��Դϴ�. �����ݾ��� �÷� �ֽʽÿ�.</div>
								<div style="height:10px;font-size:0px;line-height:0px;"></div>

								<!--��޴� -->
								<table border=0 cellspacing=0 cellpadding=0> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
														�⺻�ñ�
													</td> 
													<td><img src="images/g_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width=2></td> 
										<td valign="bottom"></td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!--��޴� -->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
									<tr>
										<td class="tdrowk_center">�� �����ñ�(<?=$now_year?>��)</td>
										<td class="tdrow" valign="top">
											<input name="money_min_time" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="0" maxlength="10" readonly> ��
											<!--<input type="checkbox" name="check_money_hour_ts_yn" value="Y" <? if($row4[check_money_hour_ts_yn] == "Y") echo "checked"; ?> onClick="checkMoney_Hour_TsYn()">����-->
											<input type="checkbox" name="check_money_min_2014_yn" id="check_money_min_2014_yn" value="<?=$check_money_min_2014_yn?>" <? if($check_money_min_2014_yn == "Y") echo "checked"; ?> onClick="checkMoney_Min2014Yn('<?=number_format($money_min_time_2014)?>')"><?=number_format($money_min_time_2014)?>��(2015��)
										</td>
										<td class="tdrowk_center">�� ����ӱ�(�ñ�)</td>
										<td class="tdrow">
											<input name="money_hour_ts" type="hidden"><!--���ڸ� ����-->
											<input name="money_hour_ts_view" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="" maxlength="10" readonly> ��
											<!--<input type="checkbox" name="check_money_hour_ts_yn" value="Y" <? if($row4[check_money_hour_ts_yn] == "Y") echo "checked"; ?> onClick="checkMoney_Hour_TsYn()">����-->
										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px;line-height:0px;"></div>

								<!--��޴� -->
								<table border=0 cellspacing=0 cellpadding=0> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
													�⺻��
													</td> 
													<td><img src="images/g_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width=2></td> 
										<td valign="bottom"></td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!--��޴� -->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
									<tr>
										<td class="tdrowk_center">�� �⺻��</td>
										<td class="tdrow" valign="top">
											<input name="money_min" type="text" style="width:70px;ime-mode:disabled;" value="<?=$money_hour_ms?>" <? if($check_money_min_yn == "Y") { ?> class="textfm" <? } else { ?> class="textfm5" readonly <? } ?> maxlength="10" onblur="setWorkHour();" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"> ��
											<div id="check_money_min_div">
												<input type="checkbox" name="check_money_min_yn" id="check_money_min_yn" value="<?=$check_money_min_yn?>" <? if($check_money_min_yn == "Y") echo "checked"; ?> onClick="checkMoney_MinYn()">����
												<table border=0 cellpadding=0 cellspacing=0 id="check_money_min_bt" style="<? if($check_money_min_yn == "N") echo "display:none"; else echo "display:inline"; ?>"><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:money_min_reset();" target="">�ٽ��Է�</a></td><td><img src=./images/btn2_rt.gif></td><td width=2></td></tr></table>
											</div>
										</td>
										<td class="tdrowk_center">�� �⺻�ñ�</td>
										<td class="tdrow">
											<input name="money_min_base" type="text" class="textfm5" style="width:70px;ime-mode:disabled;" value="0" maxlength="10" readonly> ��
											<!--<input name="money_min" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="0" maxlength="10" readonly> ��-->
											<!--<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:money_minus_set();money_minus_set();money_minus_set();money_minus_set();money_minus_set();money_minus_set();money_minus_set();money_minus_set();money_minus_set();money_minus_set();money_minus_set();" target="">�⺻������</a></td><td><img src=./images/btn2_rt.gif></td><td width=2></td></tr></table>-->
										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px;line-height:0px;"></div>

								<!--��޴� -->
								<table border=0 cellspacing=0 cellpadding=0> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
													����ӱ�(����)
													</td> 
													<td><img src="images/g_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width=2></td> 
										<td valign="bottom"></td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!--��޴� -->
								<?
								//���� �Է� ����
								if($row2[position]) {
									$sql_position_pay = " select * from com_code_list where code = $row2[position] and com_code='$code' ";
									$result_position_pay = sql_query($sql_position_pay);
									$row_position_pay = sql_fetch_array($result_position_pay);
									//$position_pay = $row_position_pay[amount];
									//ȣ������
									$sql_step_pay = " select * from com_code_list where code = $row2[step] and com_code='$code' ";
									$result_step_pay = sql_query($sql_step_pay);
									$row_step_pay = sql_fetch_array($result_step_pay);
									//$step_pay = $row_step_pay[amount];
								}

								//����ӱ�1
								$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='g1' ";
								$row_paycode = sql_fetch($sql_paycode);
								$money_g1_txt = $row_paycode[name];
								if($row4[money_g1] == "") {
									$row4[money_g1] = $row_paycode[calculate];
								}
								//����ӱ�2
								$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='g2' ";
								$row_paycode = sql_fetch($sql_paycode);
								$money_g2_txt = $row_paycode[name];
								if($row4[money_g2] == "") {
									$row4[money_g2] = $row_paycode[calculate];
								}
								//����ӱ�3
								$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='g3' ";
								$row_paycode = sql_fetch($sql_paycode);
								$money_g3_txt = $row_paycode[name];
								if($row4[money_g3] == "") {
									$row4[money_g3] = $row_paycode[calculate];
								}
								//����ӱ�4
								$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='g4' ";
								$row_paycode = sql_fetch($sql_paycode);
								$money_g4_txt = $row_paycode[name];
								if($row4[money_g4] == "") {
									$row4[money_g4] = $row_paycode[calculate];
								}
								//����ӱ�5
								$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='g5' ";
								$row_paycode = sql_fetch($sql_paycode);
								$money_g5_txt = $row_paycode[name];
								if($row4[money_g5] == "") {
									$row4[money_g5] = $row_paycode[calculate];
								}
								//����ӱ�6
								$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='g6' ";
								$row_paycode = sql_fetch($sql_paycode);
								$money_g6_txt = $row_paycode[name];
								if($row4[money_g6] == "") {
									$row4[money_g6] = $row_paycode[calculate];
								}
								//����ӱ�7
								$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='g7' ";
								$row_paycode = sql_fetch($sql_paycode);
								$money_g7_txt = $row_paycode[name];
								if($row4[money_g7] == "") {
									$row4[money_g7] = $row_paycode[calculate];
								}
								//����ӱ�8
								$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='g8' ";
								$row_paycode = sql_fetch($sql_paycode);
								$money_g8_txt = $row_paycode[name];
								if($row4[money_g8] == "") {
									$row4[money_g8] = $row_paycode[calculate];
								}

								//��å���� ������ ���� �� 0
								//if($position_pay == "") $position_pay = 0;
								if($row4[money_g1] != "") $money_g1 = number_format($row4[money_g1]);
								else $money_g1 = 0;
								if($row4[money_g2] != "") $money_g2 = number_format($row4[money_g2]);
								else $money_g2 = 0;
								//ȣ�� ������ ���� �� 0
								//if($step_pay == "") $step_pay = 0;
								if($row4[money_g3] != "") $money_g3 = number_format($row4[money_g3]);
								else $money_g3 = 0;
								if($row4[money_g4] != "") $money_g4 = number_format($row4[money_g4]);
								else $money_g4 = 0;
								if($row4[money_g5] != "") $money_g5 = number_format($row4[money_g5]);
								else $money_g5 = 0;
								//����ӱ� �߰���
								$money_g6 = number_format($row4[money_g6]);
								$money_g7 = number_format($row4[money_g7]);
								$money_g8 = number_format($row4[money_g8]);
								if($money_g6 == "") $money_g6 = 0;
								if($money_g7 == "") $money_g7 = 0;
								if($money_g8 == "") $money_g8 = 0;
								?>

								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
									<tr>
										<td class="tdrowk_center"><?=$money_g1_txt?></td>
										<td class="tdrow_center"><input name="money_g1" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="<?=$money_g1?>" maxlength="10" onblur="setWorkHour();" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"> ��</td>
										<td class="tdrowk_center"><?=$money_g2_txt?></td>
										<td class="tdrow_center"><input name="money_g2" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="<?=$money_g2?>" maxlength="10" onblur="setWorkHour();" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"> ��</td>
										<td class="tdrowk_center"><?=$money_g3_txt?></td>
										<td class="tdrow_center"><input name="money_g3" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="<?=$money_g3?>" maxlength="10" onblur="setWorkHour();" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"> ��</td>
										<td class="tdrowk_center"><?=$money_g4_txt?></td>
										<td class="tdrow_center"><input name="money_g4" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="<?=$money_g4?>" maxlength="10" onblur="setWorkHour();" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"> ��</td>
										<td class="tdrowk_center"><?=$money_g5_txt?></td>
										<td class="tdrow_center"><input name="money_g5" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="<?=$money_g5?>" maxlength="10" onblur="setWorkHour();" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"> ��</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px;line-height:0px;"></div>

								<!--��޴� -->
								<table border="0" cellspacing="0" cellpadding="0" style="display:inline">
									<tr>
										<td valign="bottom"> 
											<table border="0" cellspacing="0" cellpadding="0"> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100px;text-align:center'> 
													��������
													</td> 
													<td><img src="images/g_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width=2></td> 
										<td valign="bottom"><input type="checkbox" name="check_money_b_yn" id="check_money_b_yn" value="Y" <? if($row4['check_money_b_yn'] == "Y") echo "checked"; ?> onclick="checkMoney_bYn()" style="vertical-align:middle;">����</td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!--��޴� -->
<?
$money_b4 = $row4[money_b4];
$money_b5 = $row4[money_b5];
if($money_b4 == "") $money_b4 = 0;
if($money_b5 == "") $money_b5 = 0;
//�������� �����Է�
if($row4[check_money_b_yn] == "Y") {
	$b_class = "textfm";
	$b_readonly = "";
} else {
	$b_class="textfm5";
	$b_readonly = "readonly";
}
?>
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
									<tr>
										<td class="tdrowk_center">�⺻����</td>
										<td class="tdrow_center"><input name="money_b1" type="text" class="<?=$b_class?>" <?=$b_readonly?> style="width:60;ime-mode:disabled;" value="<?=number_format($row4['money_b1'])?>" maxlength="10" onblur="setWorkHour();" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"> ��</td>
										<td class="tdrowk_center">�߰��ٷ�</td>
										<td class="tdrow_center"><input name="money_b2" type="text" class="<?=$b_class?>" <?=$b_readonly?> style="width:60;ime-mode:disabled;" value="<?=number_format($row4['money_b2'])?>" maxlength="10" onblur="setWorkHour();" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"> ��</td>
										<td class="tdrowk_center">���ϱٷ�</td>
										<td class="tdrow_center"><input name="money_b3" type="text" class="<?=$b_class?>" <?=$b_readonly?> style="width:60;ime-mode:disabled;" value="<?=number_format($row4['money_b3'])?>" maxlength="10" onblur="setWorkHour();" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"> ��</td>
										<td class="tdrowk_center">��������</td>
										<td class="tdrow_center"><input name="money_b4" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="<?=number_format($money_b4)?>" maxlength="10" onblur="setWorkHour();" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"> ��</td>
										<td class="tdrowk_center"></td>
										<td class="tdrow_center"><input name="money_b5" type="hidden" class="textfm" style="width:60;ime-mode:disabled;" value="<?=number_format($money_b5)?>" maxlength="10" onblur="setWorkHour();"onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px;line-height:0px;"></div>

								<!--��޴� -->
								<table border=0 cellspacing=0 cellpadding=0> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
													��Ÿ����
													</td> 
													<td><img src="images/g_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width=2></td> 
										<td valign="bottom">
											<!--<input type="checkbox" name="money_e_exclude" value="N" onclick="money_e_exclude_fuc(this)"> �����ӱݿ��� ����-->
											<input type="hidden" name="money_e_exclude" value="N">
										</td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!--��޴� -->
<?
//��Ÿ����1
$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='e1' ";
$row_paycode = sql_fetch($sql_paycode);
$money_e1_txt = $row_paycode[name];
$money_e1_gy = $row_paycode[gy_yn];
//echo $row4[money_e1];
if($row4[money_e1] == "") {
	$row4[money_e1] = $row_paycode[calculate];
}
//��Ÿ����2
$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='e2' ";
$row_paycode = sql_fetch($sql_paycode);
$money_e2_txt = $row_paycode[name];
$money_e2_gy = $row_paycode[gy_yn];
if($row4[money_e2] == "") {
	$row4[money_e2] = $row_paycode[calculate];
}
//��Ÿ����3
$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='e3' ";
$row_paycode = sql_fetch($sql_paycode);
$money_e3_txt = $row_paycode[name];
$money_e3_gy = $row_paycode[gy_yn];
if($row4[money_e3] == "") {
	$row4[money_e3] = $row_paycode[calculate];
}
//��Ÿ����4
$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='e4' ";
$row_paycode = sql_fetch($sql_paycode);
$money_e4_txt = $row_paycode[name];
$money_e4_gy = $row_paycode[gy_yn];
if($row4[money_e4] == "") {
	$row4[money_e4] = $row_paycode[calculate];
}
//��Ÿ����5
$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='e5' ";
$row_paycode = sql_fetch($sql_paycode);
$money_e5_txt = $row_paycode[name];
$money_e5_gy = $row_paycode[gy_yn];
if($row4[money_e5] == "") {
	$row4[money_e5] = $row_paycode[calculate];
}
//��Ÿ����6
$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='e6' ";
$row_paycode = sql_fetch($sql_paycode);
$money_e6_txt = $row_paycode[name];
$money_e6_gy = $row_paycode[gy_yn];
if($row4[money_e6] == "") {
	$row4[money_e6] = $row_paycode[calculate];
}
//��Ÿ����7
$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='e7' ";
$row_paycode = sql_fetch($sql_paycode);
$money_e7_txt = $row_paycode[name];
$money_e7_gy = $row_paycode[gy_yn];
if($row4[money_e7] == "") {
	$row4[money_e7] = $row_paycode[calculate];
}
//��Ÿ����8
$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='e8' ";
$row_paycode = sql_fetch($sql_paycode);
$money_e8_txt = $row_paycode[name];
$money_e8_gy = $row_paycode[gy_yn];
if($row4[money_e8] == "") {
	$row4[money_e8] = $row_paycode[calculate];
}

if($row4['money_e1']) $money_e1 = number_format($row4['money_e1']);
if($row4['money_e2']) $money_e2 = number_format($row4['money_e2']);
if($row4['money_e3']) $money_e3 = number_format($row4['money_e3']);
if($row4['money_e4']) $money_e4 = number_format($row4['money_e4']);
//echo $money_e4;
if($row4['money_e5']) $money_e5 = number_format($row4['money_e5']);
if($row4['money_e6']) $money_e6 = number_format($row4['money_e6']);
if($row4['money_e7']) $money_e7 = number_format($row4['money_e7']);
if($row4['money_e8']) $money_e8 = number_format($row4['money_e8']);
if($money_e1 == "") $money_e1 = 0;
if($money_e2 == "") $money_e2 = 0;
if($money_e3 == "") $money_e3 = 0;
if($money_e4 == "") $money_e4 = 0;
if($money_e5 == "") $money_e5 = 0;
if($money_e6 == "") $money_e6 = 0;
if($money_e7 == "") $money_e7 = 0;
if($money_e8 == "") $money_e8 = 0;
?>
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
									<tr>
										<td class="tdrow_center" width="180" colspan="2">��Ÿ����(�����)</td>
										<td class="tdrowk_center"><?=$money_e1_txt?><input name="money_e1_gy" type="hidden" value="<?=$money_e1_gy?>"></td>
										<td class="tdrow_center"><input name="money_e1" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="<?=$money_e1?>" maxlength="10" onblur="setWorkHour();" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"> ��</td>
										<td class="tdrowk_center"><?=$money_e2_txt?><input name="money_e2_gy" type="hidden" value="<?=$money_e2_gy?>"></td>
										<td class="tdrow_center"><input name="money_e2" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="<?=$money_e2?>" maxlength="10" onblur="setWorkHour();" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"> ��</td>
										<td class="tdrowk_center"><?=$money_e3_txt?><input name="money_e3_gy" type="hidden" value="<?=$money_e3_gy?>"></td>
										<td class="tdrow_center"><input name="money_e3" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="<?=$money_e3?>" maxlength="10" onblur="setWorkHour();" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"> ��</td>
										<td class="tdrowk_center"><?=$money_e4_txt?><input name="money_e4_gy" type="hidden" value="<?=$money_e4_gy?>"></td>
										<td class="tdrow_center"><input name="money_e4" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="<?=$money_e4?>" maxlength="10" onblur="setWorkHour();" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"> ��</td>
									</tr>
									<tr>
										<td class="tdrow_center" colspan="2">��Ÿ����(����)</td>
										<td class="tdrowk_center"><?=$money_e5_txt?><input name="money_e5_gy" type="hidden" value="<?=$money_e5_gy?>"></td>
										<td class="tdrow_center"><input name="money_e5" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="<?=$money_e5?>" maxlength="10" onblur="setWorkHour();" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"> ��</td>
										<td class="tdrowk_center"><?=$money_e6_txt?><input name="money_e6_gy" type="hidden" value="<?=$money_e6_gy?>"></td>
										<td class="tdrow_center"><input name="money_e6" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="<?=$money_e6?>" maxlength="10" onblur="setWorkHour();" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"> ��</td>
										<td class="tdrowk_center"><?=$money_e7_txt?><input name="money_e7_gy" type="hidden" value="<?=$money_e7_gy?>"></td>
										<td class="tdrow_center"><input name="money_e7" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="<?=$money_e7?>" maxlength="10" onblur="setWorkHour();" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"> ��</td>
										<td class="tdrowk_center"><?=$money_e8_txt?><input name="money_e8_gy" type="hidden" value="<?=$money_e8_gy?>"></td>
										<td class="tdrow_center"><input name="money_e8" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="<?=$money_e8?>" maxlength="10" onblur="setWorkHour();" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"> ��</td>
									</tr>
								</table>

								<div style="height:10px;font-size:0px;line-height:0px;"></div>
								<!--��޴� -->
								<table border=0 cellspacing=0 cellpadding=0>
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0>
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td>
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'>
													������ �հ�
													</td>
													<td><img src="images/g_tab_on_rt.gif"></td>
												</tr>
											</table>
										</td>
										<td width=2></td>
										<td valign="bottom"></td>
									</tr>
								</table>
								<div style="height:2px;font-size:0px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!--��޴� -->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
									<tr>
										<td class="tdrowk_center">�� ����ӱ� �հ�</td>
										<td class="tdrow" valign="top">
											<input name="money_g_sum" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="0" maxlength="10" readonly> ��
										</td>
										<td class="tdrowk_center">�� �������� �հ�</td>
										<td class="tdrow" valign="top">
											<input name="money_b_sum" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="0" maxlength="10" readonly> ��
										</td>
										<td class="tdrowk_center">�� ��Ÿ���� �հ�</td>
										<td class="tdrow" valign="top">
											<input name="money_e_sum" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="0" maxlength="10" readonly> ��
										</td>
									</tr>
								</table>

								<div style="height:10px;font-size:0px;line-height:0px;"></div>
								<!--��޴� -->
								<table border=0 cellspacing=0 cellpadding=0>
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0>
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td>
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'>
													�޿� �հ�
													</td>
													<td><img src="images/g_tab_on_rt.gif"></td>
												</tr>
											</table>
										</td>
										<td width=2></td>
										<td valign="bottom"></td>
									</tr>
								</table>
								<div style="height:2px;font-size:0px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!--��޴� -->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
									<tr>
										<td class="tdrowk_center">�� ���հ�</td>
										<td class="tdrow" valign="top">
											<input name="money_total_sum" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="0" maxlength="10" readonly> ��
										</td>
										<td class="tdrowk_center"><div id="money_minus_txt" style="<? if($check_money_min_yn == "N") echo "display:none"; else echo "display:inline"; ?>">�� �ӱ�����</div></td>
										<td class="tdrow" valign="top" colspan="3">
											<div id="money_minus_div" style="<? if($check_money_min_yn == "N") echo "display:none"; else echo "display:inline"; ?>">
												<input name="money_month_minus" id="money_month_minus" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="0" maxlength="10" readonly /> ��
												<input name="money_minus" id="money_minus" type="hidden" class="textfm5" style="width:80px;ime-mode:disabled;" value="" maxlength="10" readonly />
												<span id="money_month_minus_text"></span>
											</div>
										</td>
									</tr>
								</table>
								<!--�޿����� ��-->
								<!--���� ������ -->
								<!--<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
									<tr>
										<td class="tdrowk_center">�����ӱ� View</td>
										<td class="tdrow" valign="top">
											<input name="money_month_base_view" id="money_month_base_view" type="text" class="textfm5" style="width:70px;ime-mode:disabled;" value="<?=$pay_year?>" maxlength="10" onblur="setWorkHour();" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')">
											<input name="money_year_yn" type="hidden" value="N">
											<input name="workhour_year" type="hidden" class="textfm5" style="width:60;ime-mode:disabled;" value="<?=$workhour_year?>" maxlength="10" readonly>
											<input name="money_year" type="hidden" class="textfm5" style="width:60;ime-mode:disabled;" value="<?=$money_year?>" maxlength="10" readonly>
										</td>
										<td class="tdrowk_center">�⺻�� ���</td>
										<td class="tdrow" valign="top">
											<input name="money_month" type="text" class="textfm5" style="width:70px;ime-mode:disabled;" value="<?=$pay_year?>" maxlength="10" readonly>
										</td>
										<td class="tdrowk_center">�޿� ���̽�</td>
										<td class="tdrow" valign="top">
											<input name="money_base" type="text" class="textfm5" style="width:70px;ime-mode:disabled;" value="" maxlength="10" readonly>
										</td>
									</tr>
								</table>-->

								<!--���� ������ -->
								<input name="money_month_base_view" type="hidden" class="textfm5" style="width:70px;ime-mode:disabled;" value="<?=$pay_year?>" maxlength="10" onblur="setWorkHour();" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')">
								<input name="money_year_yn" type="hidden" value="N">
								<input name="workhour_year" type="hidden" value="<?=$workhour_year?>">
								<input name="money_year" type="hidden" value="<?=$money_year?>">
								<input name="money_month" type="hidden" value="<?=$pay_year?>">
								<input name="money_base" type="hidden" value="">

							</div>
<?
//���Ѻ� ��ũ��
//echo $member['mb_profile'];
if($member['mb_level'] == 6) {
	$url_save = "javascript:alert_demo();";
	$url_form = "javascript:alert_demo();";
} else {
	$url_save = "javascript:checkData();";
	$url_form = "./work_contract.php?id=$id&code=$code&page=$page";
}
?>

							<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed;margin-top:20px">
								<tr>
									<td style="text-align:center">
										<!--<table border=0 cellpadding=0 cellspacing=0 style="display: inline;">
											<tr>
												<td width=2></td>
												<td><img src=images/btn_lt.gif></td>
												<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="javascript:setWorkHour();" target="">���</a></td>
												<td><img src=images/btn_rt.gif></td>
											 <td width=2></td>
											</tr>
										</table>-->
										<table border=0 cellpadding=0 cellspacing=0 style="display: none;" id="tab2_bt">
											<tr>
												<td width=2></td>
												<td><img src=images/btn_lt.gif></td>
												<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="javascript:total_cal();" target="">�������</a></td>
												<td><img src=images/btn_rt.gif></td>
											 <td width=2></td>
											</tr>
										</table>
										<table border=0 cellpadding=0 cellspacing=0 style="display: inline;">
											<tr>
												<td width=2></td>
												<td><img src=images/btn_lt.gif></td>
												<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_save?>" target="">�� ��</a></td>
												<td><img src=images/btn_rt.gif></td>
											 <td width=2></td>
											</tr>
										</table>
										<table border=0 cellpadding=0 cellspacing=0 style="display: inline;">
											<tr>
												<td width=2></td>
												<td><img src=images/btn_lt.gif></td>
												<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="staff_list.php?page=<?=$page?>" target="">�� ��</a></td>
												<td><img src=images/btn_rt.gif></td>
											 <td width=2></td>
											</tr>
										</table>
										<table border=0 cellpadding=0 cellspacing=0 style="display: inline;">
											<tr>
												<td width=2></td>
												<td><img src=images/btn_lt.gif></td>
												<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_form?>" target="">�ٷΰ�༭</a></td>
												<td><img src=images/btn_rt.gif></td>
											 <td width=2></td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
							<input type="hidden" name="error_code" style="width:100%" value="code">
							</form>
						</td>
					</tr>
				</table>
				<? include "./inc/bottom.php";?>

			</td>
		</tr>
	</table>			
</div>
<script language="javascript">
addLoadEvent(displayPayGbn);
addLoadEvent(checkWorkTime_dYn);
addLoadEvent(checkWorkTime_wYn);
addLoadEvent(checkWorkTimeYn);
//addLoadEvent(setPayBase);
<?
if(!$tab) $tab = "tab1";
?>
tab_show('<?=$tab?>');
function total_cal() {
	setWorkHour();setWorkHour();setWorkHour();setWorkHour();setWorkHour();setWorkHour();setWorkHour();setWorkHour();setWorkHour();setWorkHour();setWorkHour();setWorkHour();setWorkHour();setWorkHour();setWorkHour();setWorkHour();
}
//�ñ���
function setWorkHour_Parttime( type, money_min_time ){
	if(document.formSalary.check_money_min_2014_yn.checked) {
		money_min_time = <?=$money_min_time_2014?>;
	} else {
		money_min_time = <?=$money_min_time?>;
	}
	if(type==undefined) type = "";

	var workday_month = toInt(document.dataForm.workday_month.value); // �Ϲ����� 1���� �ٹ��ϼ�
	var workday_week = workday_month / 4 ; // �Ϲ����� �ְ� �ٷ��ϼ�

	var emp5_gbn = "";
	var rate_ext, rate_hday, rate_night;
	if( emp5_gbn == "1" ){ // 5������
		rate_ext = 1;
		rate_hday = 1;
		rate_night = 1;
	}else{
		rate_ext = <?=$rate_ext?>;
		rate_night = <?=$rate_night?>;
		rate_hday = <?=$rate_hday?>;
	}
	var money_min_time = toInt(document.dataForm.money_min_time.value);
	var f = document.formSalary; /////////////////////
	//f.error_code.value = "<?=$rate_ext?>";
	var money_hour; // ���ؽñ޾� ////////////////////////////
	var money_month, money_month_base, money_month_base_view, money_minus, money_min;
	var money_g_sum, money_g1, money_g2, money_g3, money_g4, money_g5;
	var money_b_sum, money_b1, money_b2, money_b3, money_b4, money_b5;
	var money_e_sum, money_e1, money_e2, money_e3, money_e4, money_e5;
	var workhour_day_d, money_month_minus;
	var workhour_day, workhour_ext, workhour_hday, workhour_night, workhour_total, workhour_total2, workhour_total3;
	var workhour_day_w, workhour_ext_w, workhour_hday_w, workhour_night_w, workhour_total_w, workhour_total2_w, workhour_total3_w;

	//money_month = toInt(f.money_month.value); // �⺻����
	money_hour = toInt( f.money_hour.value ); // ���ؽñ޾�
	money_g1 = toInt(f.money_g1.value); // ����������1
	money_g2 = toInt(f.money_g2.value); // ����������2
	money_g3 = toInt(f.money_g3.value); // ����������3
	money_g4 = toInt(f.money_g4.value); // ����������4
	money_g5 = toInt(f.money_g5.value); // ����������5

	money_b1 = toInt(f.money_b1.value); // ��������1
	money_b2 = toInt(f.money_b2.value); // ��������2
	money_b3 = toInt(f.money_b3.value); // ��������3
	money_b4 = toInt(f.money_b4.value); // ��������4
	money_b5 = toInt(f.money_b5.value); // ��������5

	money_e1 = toInt(f.money_e1.value); // ���������1
	money_e2 = toInt(f.money_e2.value); // ���������2
	money_e3 = toInt(f.money_e3.value); // ���������3
	money_e4 = toInt(f.money_e4.value); // ���������4
	money_e5 = toInt(f.money_e5.value); // ���������5
	money_e6 = toInt(f.money_e6.value); // ���������6
	money_e7 = toInt(f.money_e7.value); // ���������7
	money_e8 = toInt(f.money_e8.value); // ���������8

	//����ӱ�/��������
	money_g_sum = money_g1 +money_g2 +money_g3 +money_g4 +money_g5;
	money_b_sum = money_b1 +money_b2 +money_b3 +money_b4 +money_b5;
	//��Ÿ���� ����
	if(f.money_e1_gy.value != "Y") {
		money_e1 = 0;
	}
	if(f.money_e2_gy.value != "Y") {
		money_e2 = 0;
	}
	if(f.money_e3_gy.value != "Y") {
		money_e3 = 0;
	}
	if(f.money_e4_gy.value != "Y") {
		money_e4 = 0;
	}
	if(f.money_e5_gy.value != "Y") {
		money_e5 = 0;
	}
	if(f.money_e6_gy.value != "Y") {
		money_e6 = 0;
	}
	if(f.money_e7_gy.value != "Y") {
		money_e7 = 0;
	}
	if(f.money_e8_gy.value != "Y") {
		money_e8 = 0;
	}
	//��Ÿ���� �հ�
	money_e_sum = money_e1 + money_e2 + money_e3 + money_e4 + money_e5 + money_e6 + money_e7 + money_e8;

	if(f.money_e_exclude.value != "Y") {
		money_month = money_month_base - money_g_sum - money_b_sum - money_e_sum;
		f.money_month_minus.value = 0;
	} else {
		money_month = money_month_base - money_g_sum - money_b_sum;
		f.money_month_minus.value = setComma( money_e_sum );
	}
	//money_month = money_month_base;
	f.money_month.value = setComma( money_month );

	//���,����,��Ÿ �հ�
	f.money_g_sum.value = setComma( money_g_sum );
	f.money_b_sum.value = setComma( money_b_sum );
	f.money_e_sum.value = setComma( money_e_sum );

	if( f.check_worktime_yn.checked ) { // �����Է�
		workhour_day_d = toFloat(f.workhour_day_d.value);
		//1�� �ٷνð� �����Է� üũ ���� 1�� �ٷνð� �ڵ� ��� 150903
		if(!f.check_worktime_w_yn.checked) workhour_day_w = workhour_day_d*5;
		else workhour_day_w = toFloat(f.workhour_day_w.value);
		workhour_ext_w = toFloat(f.workhour_ext_w.value);
		workhour_hday_w = toFloat(f.workhour_hday_w.value);
		workhour_night_w = toFloat(f.workhour_night_w.value);

		//workhour_day_w = workhour_day_d * workday_week;
		f.workhour_day_w.value = workhour_day_w;

		workhour_day = toFloat(f.workhour_day.value);
		workhour_ext = toFloat(f.workhour_ext.value);
		workhour_hday = toFloat(f.workhour_hday.value);
		workhour_night = toFloat(f.workhour_night.value);
	}else{
		workhour_day_d = toFloat(f.workhour_day_d.value);
		//1�� �ٷνð� �����Է� üũ ���� 1�� �ٷνð� �ڵ� ��� 150903
		if(f.check_worktime_d_yn.checked) workhour_day_w = workhour_day_d*5;
		else workhour_day_w = toFloat(f.workhour_day_w.value);
		workhour_ext_w = toFloat(f.workhour_ext_w.value);
		workhour_hday_w = toFloat(f.workhour_hday_w.value);
		workhour_night_w = toFloat(f.workhour_night_w.value);
		workhour_total_w = 0;
		month_calc = 4.3452;

		var workhour_day_d_limit = workhour_day_d; // 1�ϼ����ٷνð� max 8 �� ����
		if( workhour_day_d_limit > 8 ) workhour_day_d_limit = 8;

		f.workhour_day_w.value = workhour_day_w;
		workhour_day = Math.round( ( workhour_day_w + workhour_day_d_limit ) * month_calc  );
		//alert("�����ٷνð�(1����) : ( "+workhour_day_w+" + "+workhour_day_d_limit+" ) * "+month_calc);

		//workhour_day = Math.round( ( workhour_day_d*workday_week + workhour_day_d_limit ) * month_calc  );
		f.workhour_day.value = workhour_day;

		workhour_ext = parseInt( workhour_ext_w * month_calc *100 ) / 100;
		//alert(workhour_ext);
		f.workhour_ext.value = workhour_ext;

		workhour_hday = parseInt( workhour_hday_w * month_calc *100 ) / 100;
		f.workhour_hday.value = workhour_hday;

		workhour_night = parseInt( workhour_night_w * month_calc *100 ) / 100;
		f.workhour_night.value = workhour_night;

		workhour_day = toFloat(f.workhour_day.value);
		workhour_ext = toFloat(f.workhour_ext.value);
		workhour_hday = toFloat(f.workhour_hday.value);
		workhour_night = toFloat(f.workhour_night.value);
	}

	//�ѱٷνð�
	workhour_total = parseInt( ( workhour_day + workhour_ext + workhour_hday ) * 1000 ) / 1000; // �߰��ٷμ��� ���� -----------
	workhour_total_w = parseInt( ( workhour_day_w + workhour_ext_w + workhour_hday_w + workhour_night_w ) * 1000 ) / 1000;

	//�ѱٷνð�(�ٷΰ�༭��)
	workhour_total2 = parseInt( ( workhour_day + workhour_ext + workhour_hday ) * 1000 ) / 1000;
	workhour_total2_w = parseInt( ( workhour_day_w + workhour_ext_w + workhour_hday_w ) * 1000 ) / 1000;

	//�ѱٷνð�(�ӱݻ����)
	workhour_total3 = parseInt( ( workhour_day + workhour_ext*rate_ext + workhour_hday*rate_hday + workhour_night*rate_night ) * 1000 ) / 1000;
	workhour_total3_w = parseInt( ( workhour_day_w + workhour_ext_w*rate_ext + workhour_hday_w*rate_hday + workhour_night_w*rate_night ) * 1000 ) / 1000;

	//����ӱ�(�ñ�)
	money_min = toInt(f.money_min.value);

	// ����ӱ�(�ð���) = ���ؽñ޾� + (������������ / 1���� �����ٷνð�) 
	money_hour_ts = money_hour + ( (money_g1+money_g2+money_g3) / workhour_day );
	if( isNaN(money_hour_ts) ) money_hour_ts = 0;

	f.workhour_total.value = workhour_total;
	f.workhour_total_w.value = workhour_total_w;

	f.workhour_total2.value = workhour_total2;
	f.workhour_total2_w.value = workhour_total2_w;

	f.workhour_total3.value = workhour_total3;
	f.workhour_total3_w.value = workhour_total3_w;

	f.money_hour_ts.value = money_hour_ts;
	f.money_hour_ts_view.value = setComma( parseInt(money_hour_ts) );

	// �ּ��ӱ� ���رݾ�
	f.money_min.value = setComma( toInt(workhour_total3 * money_min_time) );

	var money_base = 0; // �⺻��
	var money_ext = 0; // ����ٷμ���
	var money_hday = 0; // ���ϱٷμ���
	var money_night = 0; // �߰��ٷμ���
	money_base = Math.round( money_hour * workhour_day );
	money_ext = Math.round( money_hour_ts * rate_ext * workhour_ext );
	money_hday = Math.round( money_hour_ts * rate_hday * workhour_hday );
	money_night = Math.round( money_hour_ts * rate_night * workhour_night );

	f.money_min_time.value = setComma( money_min_time );

	f.money_base.value = setComma( money_base );
	f.money_ext.value = setComma( money_ext );
	f.money_hday.value = setComma( money_hday );
	f.money_night.value = setComma( money_night );
	// ��������(����) �ڵ� �Է�
	if(f.check_money_b_yn.checked == false) {
		f.money_b1.value = setComma( money_ext );
		f.money_b2.value = setComma( money_night );
		f.money_b3.value = setComma( money_hday );
	}
	//�ӱ�����
	money_minus = money_month-money_min;
	f.money_minus.value = setComma( money_minus );
	if(money_month < money_min) {
		f.money_minus.style.fontWeight = "bold";
		f.money_minus.style.color = "red";
	} else {
		f.money_minus.style.fontWeight = "normal";
		f.money_minus.style.color = "black";
	}
	//���հ�
	f.money_total_sum.value = setComma(money_min + money_g_sum + money_b_sum + money_e_sum);
	//f.error_code.value = money_min;
}
</script>
</body>
</html>
