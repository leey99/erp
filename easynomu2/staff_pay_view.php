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
$sql_com = " select * from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
$row_com = sql_fetch($sql_com);
$com_code = $row_com[com_code];
//��������� �߰�
$sql_com_opt = " select * from com_list_gy_opt where com_code='$com_code' ";
$result_com_opt = sql_query($sql_com_opt);
$row_com_opt=mysql_fetch_array($result_com_opt);
//��������� �߰�2
$sql_com_opt2 = " select * from com_list_gy_opt2 where com_code='$com_code' ";
$result_com_opt2 = sql_query($sql_com_opt2);
$row_com_opt2 = mysql_fetch_array($result_com_opt2);
//�ְ��ٷνð� DB
$sql_work_time = " select * from a4_work_time where com_code='$com_code' and sabun ='' ";
$result_work_time = sql_query($sql_work_time);
$row_work_time=mysql_fetch_array($result_work_time);
//echo $sql_work_time;
//����� Ÿ��
if($row_com_opt[comp_print_type]) {
	$comp_print_type = $row_com_opt[comp_print_type];
} else {
	$comp_print_type = "default";
}

$sql_common = " from $g4[pibohum_base] ";

$sub_title = "�޿�����";
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
if($row2['work_gbn'] == "A" || $row2['work_gbn'] == "")	{
	$work_gbn_checked = "A";
} else if($row2['work_gbn'] == "B") {
	$work_gbn_checked = "B";
} else if($row2['work_gbn'] == "C") {
	$work_gbn_checked = "C";
}
//�ٷνð�(����) 1��
$check_worktime_d_yn = $row4['check_worktime_d_yn'];
if($check_worktime_d_yn == "Y") {
	$workhour_day_d = $row4['workhour_day_d'];
} else {
	if($row_work_time['workhour_day_d']) $workhour_day_d = $row_work_time['workhour_day_d'];
	else $workhour_day_d = 8;
}
//�ٷνð�(����) 1��
$check_worktime_w_yn = $row4['check_worktime_w_yn'];
if($check_worktime_w_yn == "Y") {
	if($row4['workhour_day_d']) $workhour_day_d = $row4['workhour_day_d'];
	else $workhour_day_d = 8;
	$workhour_day_w = $row4['workhour_day_w'];
	$workhour_ext_w = $row4['workhour_ext_w'];
	$workhour_night_w = $row4['workhour_night_w'];
	$workhour_hday_w = $row4['workhour_hday_w'];
} else {
	$workhour_day_d = $row_work_time['workhour_day_d'];
	$workhour_ext_w = $row_work_time['workhour_ext_w'];
	$workhour_night_w = $row_work_time['workhour_night_w'];
	$workhour_hday_w = $row_work_time['workhour_hday_w'];
}
//�ٷνð�(����) 1����
$check_worktime_yn = $row4['check_worktime_yn'];
if($check_worktime_yn == "Y") {
	$workhour_day = $row4['workhour_day'];
	$workhour_ext = $row4['workhour_ext'];
	$workhour_night = $row4['workhour_night'];
	$workhour_hday = $row4['workhour_hday'];
}
if($workhour_ext_w == "") $workhour_ext_w = 0;
if($workhour_night_w == "") $workhour_night_w = 0;
if($workhour_hday_w == "") $workhour_hday_w = 0;

if($row4['check_money_min_2013_yn'] == "Y") {
	$check_money_min_2013_yn = $row4['check_money_min_2013_yn'];
} else {
	$check_money_min_2013_yn = "N";
}
if($row4['check_money_min_2014_yn'] == "Y") {
	$check_money_min_2014_yn = $row4['check_money_min_2014_yn'];
} else {
	$check_money_min_2014_yn = "N";
}
if($row4['check_money_min_2015_yn'] == "Y") {
	$check_money_min_2015_yn = $row4['check_money_min_2015_yn'];
} else {
	$check_money_min_2015_yn = "N";
}
if($row4['check_money_min_yn'] == "Y") {
	$check_money_min_yn = $row4['check_money_min_yn'];
} else {
	$check_money_min_yn = "N";
}
//�����ӱ�(1�ð�)
/*
if($check_money_min_2013_yn == "Y") {
	//2013�� �����ñ�
	$money_min_time = 4860;
} else {
	$money_min_time = 5210;
}
*/
$money_min_time_2013 = 4860;
$money_min_time_2014 = 5210;
$money_min_time_2015 = 5580;
$money_min_time = 6030;
//�����ϱ�
$money_min_day = $money_min_time * 8;
//�ñ��� �����Է�
$money_time_input = $row_com_opt2['money_time_input'];
//�ۼ�Ʈ(�����ӱ�) ������
if($row4['money_month_base_pesent']) {
	$money_month_base_pesent = $row4['money_month_base_pesent'];
} else {
	$money_month_base_pesent = $row_com_opt2['money_month_base_pesent'];
}
if(!$money_month_base_pesent) $money_month_base_pesent = 80;
//�����Ѿ�
if($row4['money_year_base']) {
	$money_year_base = $row4['money_year_base'];
}
//������ ���� (�����ӱ���)
if($row4['money_year_base_division']) {
	$money_year_base_division = $row4['money_year_base_division'];
	$money_year_base_division2 = $row4['money_year_base_division'];
	$money_year_base_pesent = $row4['money_year_base_division'];
} else {
	$money_year_base_division = $row_com_opt2['money_year_base_division'];
	$money_year_base_division2 = $row_com_opt2['money_year_base_division2'];
}
if(!$money_year_base_division) $money_year_base_division = 12;
if(!$money_year_base_division2) $money_year_base_division2 = 12;
//�⺻�ϱ�
if($row4['money_day_base']) {
	$money_day_base = $row4['money_day_base'];
}
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
function getXmlHttpRequest() {
	var xmlHttp = false;
	if(window.ActiveXObject) {
		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
	} else {
		xmlHttp = new XMLHttpRequest();
		xmlHttp.overrideMimeType("text/xml");
	}
	return xmlHttp;
}
function getDocNo() {
	var f = document.dataForm;
	var cust_numb = f.cust_numb.value;
	var xmlHttp = getXmlHttpRequest();
	if( !xmlHttp ){
		alert("XmlHttp �������� ����...");
		return "";
	}
	var pay_gbn = "";
	if( f.pay_gbn.value == "0" ){
		pay_gbn = "0";
	}else if( f.pay_gbn.value == "1" ) {
		pay_gbn = "1";
	}else if( f.pay_gbn.value == "2" ) {
		pay_gbn = "2";
	}else if( f.pay_gbn.value == "3" ) {
		pay_gbn = "3";
	}
	if( pay_gbn == "" ){
		// alert("�޿� ������ ���õ��� �ʾҽ��ϴ�.");
		return "";
	}
	var doc_no = "";
	var url = "get_docno.php";
	xmlHttp.open("POST", url, false);
	xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlHttp.onreadystatechange = function() {
		if(xmlHttp.readyState == 4) {
			if( xmlHttp.status == 200 ){
				try{
					var vtext = xmlHttp.responseText.replace(/(\n|\r)/g, "");
					doc_no = vtext;
				}catch(e){}
			}
		}
	}
	var arg = "cust_numb="+cust_numb+"&pay_gbn="+pay_gbn;
	xmlHttp.send(arg);
	return doc_no;
}
function displayPayGbn() {
	var f = document.dataForm;
	var frm = document.formSalary;
/*
	if( f.pay_gbn[2].checked ) { // ���ձٹ�
		document.getElementById("workday_month_text").style.display="none";
		document.getElementById("workday_week").style.display="";
		changeWorkDayWeek();
	}else{ //������,�ñ���
		document.getElementById("workday_month_text").style.display="";
		document.getElementById("workday_week").style.display="none";
		f.workday_week.value = "5";
		changeWorkDayWeek();
	}
*/
	if(f.pay_gbn.value != "") {
		document.getElementById("pay_base").style.display = "";
	} else {
		document.getElementById("pay_gbn2_0").style.display = "none";
		document.getElementById("pay_gbn2_1").style.display = "none";
		document.getElementById("pay_gbn2_3").style.display = "none";
		document.getElementById("pay_gbn2_4").style.display = "none";
		document.getElementById("pay_base").style.display = "none";
	}

	if(f.pay_gbn.value == "1") {
		//�ñ���
		document.getElementById("pay_gbn2_0").style.display = "none";
		document.getElementById("pay_gbn2_1").style.display = "inline";
		document.getElementById("pay_gbn2_3").style.display = "none";
		document.getElementById("pay_gbn2_4").style.display = "none";
		document.getElementById("decision").innerHTML = "���ؽñ�";
		document.getElementById("decision_txt").innerHTML = "�� ���ؽñ�";
		document.getElementById("decision_div").style.display = "none";
		document.getElementById("decision_div2").style.display = "inline";
		document.getElementById("decision_div3").style.display = "none";
		document.getElementById("decision_div4").style.display = "none";
		document.getElementById("decision_reset").style.display = "none";
		document.getElementById("decision_reset2").style.display = "inline";
		document.getElementById("decision_reset3").style.display = "none";
		document.getElementById("decision_reset4").style.display = "none";
		frm.money_month_base.value = 0;
		//�⺻�� �ڵ�����
/*
		//�ñ��� �⺻�� ���� �Է� �߰� 14.02.26
		frm.check_money_min_yn.checked = false;
		frm.check_money_min_yn.value = "N";
		document.getElementById('check_money_min_div').style.display = "none";
		frm.money_min.className = "textfm5";
		frm.money_min.readOnly = true;
*/
		frm.check_money_min_yn.checked = false;
		frm.check_money_min_yn.value = "N";
		document.getElementById('check_money_min_div').style.display = "inline";
		frm.money_min.className = "textfm5";
		frm.money_min.readOnly = true;
		//�ӱ�����
		document.getElementById("money_minus_txt").style.display = "none";
		document.getElementById("money_minus_div").style.display = "none";
		//�ñ��� ���ý� ����
		document.getElementById("pay_money_min_div").style.display = "none";
	} else if(f.pay_gbn.value == "0") {
		//������
		document.getElementById("pay_gbn2_0").style.display = "inline";
		document.getElementById("pay_gbn2_1").style.display = "none";
		document.getElementById("pay_gbn2_3").style.display = "none";
		document.getElementById("pay_gbn2_4").style.display = "none";
		document.getElementById("decision").innerHTML = "�����ӱ�";
		document.getElementById("decision_txt").innerHTML = "�� �����ӱ�";
		document.getElementById("decision_div").style.display = "inline";
		document.getElementById("decision_div2").style.display = "none";
		document.getElementById("decision_div3").style.display = "none";
		document.getElementById("decision_div4").style.display = "none";
		document.getElementById("decision_reset").style.display = "inline";
		document.getElementById("decision_reset2").style.display = "none";
		document.getElementById("decision_reset3").style.display = "none";
		document.getElementById("decision_reset4").style.display = "none";
		document.getElementById('check_money_min_div').style.display = "inline";
		//�ӱ�����
		document.getElementById("money_minus_txt").style.display = "";
		document.getElementById("money_minus_div").style.display = "";
		//�⺻�� ǥ��
		document.getElementById("pay_money_min_div").style.display = "";
	} else if(f.pay_gbn.value == "3") {
		//������
		document.getElementById("pay_gbn2_0").style.display = "none";
		document.getElementById("pay_gbn2_1").style.display = "none";
		document.getElementById("pay_gbn2_3").style.display = "inline";
		document.getElementById("pay_gbn2_4").style.display = "none";
		document.getElementById("decision").innerHTML = "�����ӱ�";
		document.getElementById("decision_txt").innerHTML = "�� �����Ѿ�";
		document.getElementById("decision_div").style.display = "none";
		document.getElementById("decision_div2").style.display = "none";
		document.getElementById("decision_div3").style.display = "inline";
		document.getElementById("decision_div4").style.display = "none";
		document.getElementById("decision_reset").style.display = "none";
		document.getElementById("decision_reset2").style.display = "none";
		document.getElementById("decision_reset3").style.display = "inline";
		document.getElementById("decision_reset4").style.display = "none";
		document.getElementById('check_money_min_div').style.display = "inline";
		//�ӱ�����
		document.getElementById("money_minus_txt").style.display = "";
		document.getElementById("money_minus_div").style.display = "";
		//�⺻�� ǥ��
		document.getElementById("pay_money_min_div").style.display = "";
	} else 	if(f.pay_gbn.value == "4") {
		//�ϱ���
		document.getElementById("pay_gbn2_0").style.display = "none";
		document.getElementById("pay_gbn2_1").style.display = "none";
		document.getElementById("pay_gbn2_3").style.display = "none";
		document.getElementById("pay_gbn2_4").style.display = "inline";
		document.getElementById("decision").innerHTML = "�����ϱ�";
		document.getElementById("decision_txt").innerHTML = "�� �����ϱ�";
		document.getElementById("decision_div").style.display = "none";
		document.getElementById("decision_div2").style.display = "none";
		document.getElementById("decision_div3").style.display = "none";
		document.getElementById("decision_div4").style.display = "inline";
		document.getElementById("decision_reset").style.display = "none";
		document.getElementById("decision_reset2").style.display = "inline";
		document.getElementById("decision_reset3").style.display = "none";
		document.getElementById("decision_reset4").style.display = "inline";
		frm.money_month_base.value = 0;
		frm.check_money_min_yn.checked = false;
		frm.check_money_min_yn.value = "N";
		document.getElementById('check_money_min_div').style.display = "inline";
		frm.money_min.className = "textfm5";
		frm.money_min.readOnly = true;
		//�ӱ�����
		document.getElementById("money_minus_txt").style.display = "none";
		document.getElementById("money_minus_div").style.display = "none";
		//�ñ��� ���ý� ����
		document.getElementById("pay_money_min_div").style.display = "none";
	}
	document.getElementById("workday_month_text").style.display="none";
	document.getElementById("workday_week").style.display="none";
	f.workday_week.value = "5";
	changeWorkDayWeek();
	setWorkHour("all"); /////////////
	//alert(document.getElementById("money_month_base").style.display);
}
//�޿����� �� ���ý� ���� �Լ�
function pay_gbn_select() {
	var f = document.dataForm;
	var frm = document.formSalary;
	money_min_time = "<?=$money_min_time?>";
	money_min_day  = "<?=$money_min_day?>";
	//�����Ѿ� ���� ���� ��ư �ʱ� ��Ȱ��ȭ 160405
	getId('money_year_apply').style.display = "none";
	if(f.pay_gbn.value == "1") {
		//�ñ��� : A �����ñ�
		if(f.pay_gbn2_1.value == "1") {
			frm.money_hour.value = setComma(money_min_time);
			//frm.money_hour.focus();
		//�ñ��� : B �����Է�
		} else if(f.pay_gbn2_1.value == "2") {
			frm.money_hour.value = "<?=number_format($money_time_input)?>";
			//frm.money_hour.focus();
		}
	} else if(f.pay_gbn.value == "0") {
		//������ : A �����ӱ�
		//alert(f.pay_gbn2_0.value);
		if(f.pay_gbn2_0.value == "1") {
			workhour_day = frm.workhour_day.value;
			frm.money_min.value = setComma(money_min_time * workhour_day);
			frm.money_month_base.value = "";
			frm.money_month_base.focus();
		//������ : B �ۼ�Ʈ
		} else if(f.pay_gbn2_0.value == "2") {
			frm.money_min.value = "";
			frm.money_month_base.value = "";
			frm.money_month_base.focus();
		//������ : C �����Է�
		} else if(f.pay_gbn2_0.value == "3") {
			frm.money_min.value = "";
			frm.money_month_base.value = "";
			frm.money_month_base.focus();
		}
	} else if(f.pay_gbn.value == "3") {
		//�����Ѿ� ���� ���� ��ư 160405
		getId('money_year_apply').style.display = "inline";
		//������ : A �����ӱ���
		if(f.pay_gbn2_3.value == "1") {
			frm.money_year_base.value = "";
			frm.money_year_base.focus();
			frm.money_year_base_division.value = <?=$money_year_base_division?>;
		//������ : B ��������
		} else if(f.pay_gbn2_3.value == "2") {
			frm.money_year_base.value = "";
			frm.money_year_base.focus();
			frm.money_year_base_division.value = <?=$money_year_base_division2?>;
		}
	} else 	if(f.pay_gbn.value == "4") {
		//�ñ��� : A �����ϱ�
		if(f.pay_gbn2_4.value == "1") {
			frm.money_day_base.value = setComma(money_min_day);
			frm.money_day_base.focus();
		//�ñ��� : B �����Է�
		} else if(f.pay_gbn2_4.value == "2") {
			frm.money_day_base.value = "";
			frm.money_day_base.focus();
		}
	}
	//������ : B �ۼ�Ʈ ���ý� ǥ��
	if(f.pay_gbn.value == "0" && f.pay_gbn2_0.value == "2") {
		document.getElementById("decision_txt2").style.display = "inline";
		document.getElementById("decision_input2").style.display = "inline";
	} else {
		document.getElementById("decision_txt2").style.display = "none";
		document.getElementById("decision_input2").style.display = "none";
	}
	//������ ���ý�
	if(f.pay_gbn.value == "3") {
		document.getElementById("decision_txt2").innerHTML = "�� ��������";
		document.getElementById("decision_txt2").style.display = "inline";
		document.getElementById("decision_input3").style.display = "inline";
	} else {
		document.getElementById("decision_txt2").innerHTML = "�� �ۼ�Ʈ(�����ӱ�)";
		document.getElementById("decision_input3").style.display = "none";
	}
}
//�����ڵ� ����
function pay_code_select() {
	document.getElementById("pay_base2").style.display = "";
	total_cal();
}
function pay_code_input() {
	var f = document.dataForm;
	if(f.pay_gbn.value == "") {
		alert("�޿������� �����Ͻʽÿ�.");
		f.pay_gbn.focus();
		return;
	}
	document.getElementById("pay_base3").style.display = "";
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
	//������ ���ձٹ� ������
	if(frm.pay_gbn.value == "0" || frm.pay_gbn.value == "2" || frm.pay_gbn.value == "3"){
		frm.money_month.value = document.formSalary.money_month.value; //�⺻(��)��
		frm.money_hour.value = ""; //���ؽñ�
		frm.money_min.value = document.formSalary.money_min.value; //�⺻��
		frm.workhour_day.value = document.formSalary.workhour_day.value; //�ٷνð� 
		frm.workhour_ext.value = document.formSalary.workhour_ext.value; //����ٷνð� 
		frm.workhour_hday.value = document.formSalary.workhour_hday.value; //���ϱٷνð� 
		frm.workhour_night.value = document.formSalary.workhour_night.value; //�߰��ٷνð� 
		frm.workhour_total.value = document.formSalary.workhour_total.value; //�ѱٷνð� 
		frm.week_hday.value = ""; //�����ϼ� 
		frm.year_hday.value = ""; //���������ް��ϼ� 
		frm.money_g1.value = document.formSalary.money_g1.value; //����������1
		frm.money_g2.value = document.formSalary.money_g2.value; //����������2
		frm.money_g3.value = document.formSalary.money_g3.value; //����������3
		frm.money_g4.value = document.formSalary.money_g4.value; //����������4
		frm.money_g5.value = document.formSalary.money_g5.value; //����������5
		frm.money_b1.value = document.formSalary.money_b1.value; //��������1
		frm.money_b2.value = document.formSalary.money_b2.value; //��������2
		frm.money_b3.value = document.formSalary.money_b3.value; //��������3
		frm.money_b4.value = document.formSalary.money_b4.value; //��������4
		frm.money_b5.value = document.formSalary.money_b5.value; //��������5
		frm.money_e1.value = document.formSalary.money_e1.value; //��Ÿ����1
		frm.money_e2.value = document.formSalary.money_e2.value; //��Ÿ����2
		frm.money_e3.value = document.formSalary.money_e3.value; //��Ÿ����3
		frm.money_e4.value = document.formSalary.money_e4.value; //��Ÿ����4
		frm.money_e5.value = document.formSalary.money_e5.value; //��Ÿ����5
		frm.money_e6.value = document.formSalary.money_e6.value; //��Ÿ����6
		frm.money_e7.value = document.formSalary.money_e7.value; //��Ÿ����7
		frm.money_e8.value = document.formSalary.money_e8.value; //��Ÿ����8
		frm.money_e9.value = document.formSalary.money_e9.value; //��Ÿ����9

		frm.pay_yun.value = document.formSalary.pay_yun.value; //���ο���
		frm.pay_health.value = document.formSalary.pay_health.value; //�ǰ�����
		frm.pay_goyong.value = document.formSalary.pay_goyong.value; //��뺸��
/*
		frm.money_yun.value = document.formSalary.money_yun.value; //���ο���
		frm.money_health.value = document.formSalary.money_health.value; //�ǰ�����
		frm.money_yoyang.value = document.formSalary.money_yoyang.value; //�����
		frm.money_goyong.value = document.formSalary.money_goyong.value; //��뺸��
*/
		frm.workhour_day_w.value = document.formSalary.workhour_day_w.value; //1�� �ٷνð� 
		frm.workhour_ext_w.value = document.formSalary.workhour_ext_w.value; //1�� ����ٷνð� 
		frm.workhour_hday_w.value = document.formSalary.workhour_hday_w.value; //1�� ���ϱٷνð� 
		frm.workhour_night_w.value = document.formSalary.workhour_night_w.value; //1�� �߰��ٷνð� 
		frm.workhour_total_w.value = document.formSalary.workhour_total_w.value; //1�� �ѱٷνð� 

		frm.workhour_day_d.value = document.formSalary.workhour_day_d.value; //1�� �ٷνð� 
		frm.money_hour_ts.value = document.formSalary.money_hour_ts.value; //����ӱ� (�ð���)
		//frm.money_hour_ds.value = document.formSalary.money_hour_ds.value; //����ӱ� (�ϱ�)

		frm.money_min_base.value = document.formSalary.money_min_base.value; //�⺻�ñ�
		frm.money_year_base.value = document.formSalary.money_year_base.value; //��������
		frm.money_year_base_division.value = document.formSalary.money_year_base_division.value; //��������

		frm.workhour_total2.value = document.formSalary.workhour_total2.value; //1���� �ѱٷνð�(�ٷΰ�༭��)
		frm.workhour_total3.value = document.formSalary.workhour_total3.value; //1���� �ѱٷνð�(�ӱݻ����)

		frm.workhour_total2_w.value = document.formSalary.workhour_total2_w.value; //1�� �ѱٷνð�(�ٷΰ�༭��)
		frm.workhour_total3_w.value = document.formSalary.workhour_total3_w.value; //1�� �ѱٷνð�(�ӱݻ����)

		frm.money_year_yn.value = document.formSalary.money_year_yn.value; //�������� ���޿���
		frm.money_base.value = document.formSalary.money_base.value; //�⺻��
		frm.money_ext.value = document.formSalary.money_ext.value; //����ٷμ���
		frm.money_hday.value = document.formSalary.money_hday.value; //���ϱٷμ���
		frm.money_night.value = document.formSalary.money_night.value; //�߰��ٷμ���
		frm.workhour_year.value = document.formSalary.workhour_year.value; //�����ް� �ð�
		frm.money_year.value = document.formSalary.money_year.value; //��������
		frm.money_period.value = document.formSalary.money_period.value; //��������
		frm.money_month_base.value = document.formSalary.money_month_base.value; //�����޾�, ������ �⺻��+�������� ���� ���ʱݾ�
		frm.money_month_base_pesent.value = document.formSalary.money_month_base_pesent.value; //�ۼ�Ʈ(�����ӱ�)
		frm.check_worktime_d_yn.value = document.formSalary.check_worktime_d_yn.checked ? "Y" : "N"; // 1�� �ٷνð� �����Է�
		frm.check_worktime_w_yn.value = document.formSalary.check_worktime_w_yn.checked ? "Y" : "N"; //1�� �ٷνð� �����Է�
		frm.check_worktime_yn.value = document.formSalary.check_worktime_yn.checked ? "Y" : "N"; //1���� �ٷνð� �����Է�
		frm.check_money_min_yn.value = document.formSalary.check_money_min_yn.checked ? "Y" : "N"; //�⺻�� �����Է�
		frm.check_money_min_2015_yn.value = document.formSalary.check_money_min_2015_yn.checked ? "Y" : "N"; //�⺻�� �����Է�
		frm.check_money_b_yn.value = document.formSalary.check_money_b_yn.checked ? "Y" : "N"; //�������� �����Է�
	} else if(frm.pay_gbn.value == "1") {
		//�ñ���
		frm.money_month.value = ""; //�⺻(��)�� 
		frm.money_hour.value = document.formSalary.money_hour.value; //���ؽñ� 
		frm.money_min.value = document.formSalary.money_min.value; //�⺻��
		frm.workhour_day.value = document.formSalary.workhour_day.value; //�ٷνð� 
		frm.workhour_ext.value = document.formSalary.workhour_ext.value; //����ٷνð� 
		frm.workhour_hday.value = document.formSalary.workhour_hday.value; //���ϱٷνð� 
		frm.workhour_night.value = document.formSalary.workhour_night.value; //�߰��ٷνð� 
		frm.workhour_total.value = document.formSalary.workhour_total.value; //�ѱٷνð� 
		//frm.week_hday.value = document.formSalary.week_hday.value; //�����ϼ� 
		//frm.year_hday.value = document.formSalary.year_hday.value; //���������ް��ϼ� 
		frm.week_hday.value = ""; //�����ϼ� 
		frm.year_hday.value = ""; //���������ް��ϼ� 
		frm.money_g1.value = document.formSalary.money_g1.value; //���������� 
		frm.money_g2.value = document.formSalary.money_g2.value; //���������� 
		frm.money_g3.value = document.formSalary.money_g3.value; //���������� 
		frm.money_g4.value = document.formSalary.money_g4.value; //���������� 
		frm.money_g5.value = document.formSalary.money_g5.value; //���������� 
		frm.money_b1.value = document.formSalary.money_b1.value; //�������� 
		frm.money_b2.value = document.formSalary.money_b2.value; //�������� 
		frm.money_b3.value = document.formSalary.money_b3.value; //�������� 
		frm.money_b4.value = document.formSalary.money_b4.value; //�������� 
		frm.money_b5.value = document.formSalary.money_b5.value; //��������
		frm.money_e1.value = document.formSalary.money_e1.value; //��Ÿ���� 
		frm.money_e2.value = document.formSalary.money_e2.value; //��Ÿ���� 
		frm.money_e3.value = document.formSalary.money_e3.value; //��Ÿ���� 
		frm.money_e4.value = document.formSalary.money_e4.value; //��Ÿ���� 
		frm.money_e5.value = document.formSalary.money_e5.value; //��Ÿ����
		frm.money_e6.value = document.formSalary.money_e6.value; //��Ÿ���� 
		frm.money_e7.value = document.formSalary.money_e7.value; //��Ÿ���� 
		frm.money_e9.value = document.formSalary.money_e9.value; //��Ÿ����

		frm.pay_yun.value = document.formSalary.pay_yun.value; //���ο���
		frm.pay_health.value = document.formSalary.pay_health.value; //�ǰ�����
		frm.pay_goyong.value = document.formSalary.pay_goyong.value; //��뺸��
/*
		frm.money_yun.value = document.formSalary.money_yun.value; //���ο���
		frm.money_health.value = document.formSalary.money_health.value; //�ǰ�����
		frm.money_yoyang.value = document.formSalary.money_yoyang.value; //�����
		frm.money_goyong.value = document.formSalary.money_goyong.value; //��뺸��
*/
		frm.workhour_day_w.value = document.formSalary.workhour_day_w.value; //1�� �ٷνð� 
		frm.workhour_ext_w.value = document.formSalary.workhour_ext_w.value; //1�� ����ٷνð� 
		frm.workhour_hday_w.value = document.formSalary.workhour_hday_w.value; //1�� ���ϱٷνð� 
		frm.workhour_night_w.value = document.formSalary.workhour_night_w.value; //1�� �߰��ٷνð� 
		frm.workhour_total_w.value = document.formSalary.workhour_total_w.value; //1�� �ѱٷνð� 

		frm.workhour_day_d.value = document.formSalary.workhour_day_d.value; //1�� �ٷνð� 
		frm.money_hour_ts.value = document.formSalary.money_hour_ts.value; //����ӱ� (�ð���)
		//frm.money_hour_ds.value = document.formSalary.money_hour_ds.value; //����ӱ� (�ð���)
		frm.money_min_base.value = document.formSalary.money_min_base.value; //�⺻�ñ�

		frm.workhour_total2.value = document.formSalary.workhour_total2.value; //1���� �ѱٷνð�(�ٷΰ�༭��)
		frm.workhour_total3.value = document.formSalary.workhour_total3.value; //1���� �ѱٷνð�(�ӱݻ����)

		frm.workhour_total2_w.value = document.formSalary.workhour_total2_w.value; //1�� �ѱٷνð�(�ٷΰ�༭��)
		frm.workhour_total3_w.value = document.formSalary.workhour_total3_w.value; //1�� �ѱٷνð�(�ӱݻ����)

		frm.money_year_yn.value = ""; //�������� ���޿���
		frm.money_base.value = document.formSalary.money_base.value; //�⺻��
		frm.money_ext.value = document.formSalary.money_ext.value; //����ٷμ���
		frm.money_hday.value = document.formSalary.money_hday.value; //���ϱٷμ���
		frm.money_night.value = document.formSalary.money_night.value; //�߰��ٷμ���
		frm.workhour_year.value = ""; //�����ް� �ð�
		frm.money_year.value = ""; //��������
		frm.money_period.value = ""; //��������
		frm.money_month_base.value = document.formSalary.money_total_sum.value; //�����޾�, ������ �⺻��+�������� ���� ���ʱݾ�
		frm.check_worktime_d_yn.value = document.formSalary.check_worktime_d_yn.checked ? "Y" : "N"; // 1�� �ٷνð� �����Է�
		frm.check_worktime_w_yn.value = document.formSalary.check_worktime_w_yn.checked ? "Y" : "N"; //1�� �ٷνð� �����Է�
		frm.check_worktime_yn.value = document.formSalary.check_worktime_yn.checked ? "Y" : "N"; //1���� �ٷνð� �����Է�
		frm.check_money_min_yn.value = document.formSalary.check_money_min_yn.checked ? "Y" : "N"; //�⺻�� �����Է�
		frm.check_money_min_2015_yn.value = document.formSalary.check_money_min_2015_yn.checked ? "Y" : "N"; //�⺻�� �����Է�
		frm.check_money_b_yn.value = document.formSalary.check_money_b_yn.checked ? "Y" : "N"; //�������� �����Է�
	} else if(frm.pay_gbn.value == "4") {
		//�ϱ���
		frm.money_month.value = ""; //�⺻(��)�� 
		frm.money_hour.value = document.formSalary.money_hour.value; //���ؽñ� 
		frm.money_min.value = document.formSalary.money_min.value; //�⺻��
		frm.money_day_base.value = document.formSalary.money_day_base.value; //�⺻�ϱ�
		frm.workhour_day.value = document.formSalary.workhour_day.value; //�ٷνð� 
		frm.workhour_ext.value = document.formSalary.workhour_ext.value; //����ٷνð� 
		frm.workhour_hday.value = document.formSalary.workhour_hday.value; //���ϱٷνð� 
		frm.workhour_night.value = document.formSalary.workhour_night.value; //�߰��ٷνð� 
		frm.workhour_total.value = document.formSalary.workhour_total.value; //�ѱٷνð� 
		//frm.week_hday.value = document.formSalary.week_hday.value; //�����ϼ� 
		//frm.year_hday.value = document.formSalary.year_hday.value; //���������ް��ϼ� 
		frm.week_hday.value = ""; //�����ϼ� 
		frm.year_hday.value = ""; //���������ް��ϼ� 

		frm.money_g1.value = document.formSalary.money_g1.value; //���������� 
		frm.money_g2.value = document.formSalary.money_g2.value; //���������� 
		frm.money_g3.value = document.formSalary.money_g3.value; //���������� 
		frm.money_g4.value = document.formSalary.money_g4.value; //���������� 
		frm.money_g5.value = document.formSalary.money_g5.value; //���������� 
		frm.money_b1.value = document.formSalary.money_b1.value; //�������� 
		frm.money_b2.value = document.formSalary.money_b2.value; //�������� 
		frm.money_b3.value = document.formSalary.money_b3.value; //�������� 
		frm.money_b4.value = document.formSalary.money_b4.value; //�������� 
		frm.money_b5.value = document.formSalary.money_b5.value; //��������
		frm.money_e1.value = document.formSalary.money_e1.value; //��Ÿ���� 
		frm.money_e2.value = document.formSalary.money_e2.value; //��Ÿ���� 
		frm.money_e3.value = document.formSalary.money_e3.value; //��Ÿ���� 
		frm.money_e4.value = document.formSalary.money_e4.value; //��Ÿ���� 
		frm.money_e5.value = document.formSalary.money_e5.value; //��Ÿ����
		frm.money_e6.value = document.formSalary.money_e6.value; //��Ÿ���� 
		frm.money_e7.value = document.formSalary.money_e7.value; //��Ÿ���� 
		frm.money_e9.value = document.formSalary.money_e9.value; //��Ÿ����

		frm.pay_yun.value = document.formSalary.pay_yun.value; //���ο���
		frm.pay_health.value = document.formSalary.pay_health.value; //�ǰ�����
		frm.pay_goyong.value = document.formSalary.pay_goyong.value; //��뺸��
/*
		frm.money_yun.value = document.formSalary.money_yun.value; //���ο���
		frm.money_health.value = document.formSalary.money_health.value; //�ǰ�����
		frm.money_yoyang.value = document.formSalary.money_yoyang.value; //�����
		frm.money_goyong.value = document.formSalary.money_goyong.value; //��뺸��
*/
		frm.workhour_day_w.value = document.formSalary.workhour_day_w.value; //1�� �ٷνð� 
		frm.workhour_ext_w.value = document.formSalary.workhour_ext_w.value; //1�� ����ٷνð� 
		frm.workhour_hday_w.value = document.formSalary.workhour_hday_w.value; //1�� ���ϱٷνð� 
		frm.workhour_night_w.value = document.formSalary.workhour_night_w.value; //1�� �߰��ٷνð� 
		frm.workhour_total_w.value = document.formSalary.workhour_total_w.value; //1�� �ѱٷνð� 

		frm.workhour_day_d.value = document.formSalary.workhour_day_d.value; //1�� �ٷνð� 
		frm.money_hour_ts.value = document.formSalary.money_hour_ts.value; //����ӱ� (�ð���)
		//frm.money_hour_ds.value = document.formSalary.money_hour_ds.value; //����ӱ� (�ð���)
		frm.money_min_base.value = document.formSalary.money_min_base.value; //�⺻�ñ�

		frm.workhour_total2.value = document.formSalary.workhour_total2.value; //1���� �ѱٷνð�(�ٷΰ�༭��)
		frm.workhour_total3.value = document.formSalary.workhour_total3.value; //1���� �ѱٷνð�(�ӱݻ����)

		frm.workhour_total2_w.value = document.formSalary.workhour_total2_w.value; //1�� �ѱٷνð�(�ٷΰ�༭��)
		frm.workhour_total3_w.value = document.formSalary.workhour_total3_w.value; //1�� �ѱٷνð�(�ӱݻ����)

		frm.money_year_yn.value = ""; //�������� ���޿���
		frm.money_base.value = document.formSalary.money_base.value; //�⺻��
		frm.money_ext.value = document.formSalary.money_ext.value; //����ٷμ���
		frm.money_hday.value = document.formSalary.money_hday.value; //���ϱٷμ���
		frm.money_night.value = document.formSalary.money_night.value; //�߰��ٷμ���
		frm.workhour_year.value = ""; //�����ް� �ð�
		frm.money_year.value = ""; //��������
		frm.money_period.value = ""; //��������
		frm.money_month_base.value = document.formSalary.money_total_sum.value; //�����޾�, ������ �⺻��+�������� ���� ���ʱݾ�
		frm.check_worktime_d_yn.value = document.formSalary.check_worktime_d_yn.checked ? "Y" : "N"; //1�� �ٷνð� �����Է�
		frm.check_worktime_w_yn.value = document.formSalary.check_worktime_w_yn.checked ? "Y" : "N"; //1�� �ٷνð� �����Է�
		frm.check_worktime_yn.value = document.formSalary.check_worktime_yn.checked ? "Y" : "N"; //1���� �ٷνð� �����Է�
		frm.check_money_min_yn.value = document.formSalary.check_money_min_yn.checked ? "Y" : "N"; //�⺻�� �����Է�
		frm.check_money_min_2015_yn.value = document.formSalary.check_money_min_2015_yn.checked ? "Y" : "N"; //�⺻�� �����Է�
		frm.check_money_b_yn.value = document.formSalary.check_money_b_yn.checked ? "Y" : "N"; //�������� �����Է�
	} else {
		frm.money_month.value = "";
		frm.money_hour.value = "";
		frm.workhour_day.value = "";
		frm.workhour_ext.value = "";
		frm.workhour_hday.value = "";
		frm.workhour_night.value = "";
		frm.workhour_total.value = ""; //�ѱٷνð�
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

		frm.workhour_day_d.value = ""; //1�� �ٷνð� 
		frm.money_hour_ts.value = ""; //����ӱ� (�ð���)
		//frm.money_hour_ds.value = ""; //����ӱ� (�ϱ�)
		frm.money_min_base.value = ""; //�⺻�ñ�

		frm.workhour_total2.value = ""; //1���� �ѱٷνð�(�ٷΰ�༭��)
		frm.workhour_total3.value = ""; //1���� �ѱٷνð�(�ӱݻ����)

		frm.workhour_total2_w.value = ""; //1�� �ѱٷνð�(�ٷΰ�༭��)
		frm.workhour_total3_w.value = ""; //1�� �ѱٷνð�(�ӱݻ����)

		frm.money_year_yn.value = ""; //�������� ���޿���
		frm.money_base.value = ""; //�⺻��
		frm.money_ext.value = ""; //����ٷμ���
		frm.money_hday.value = ""; //���ϱٷμ���
		frm.money_night.value = ""; //�߰��ٷμ���
		frm.workhour_year.value = ""; //�����ް� �ð�
		frm.money_year.value = ""; //��������
		frm.money_period.value = ""; //��������
		frm.money_month_base.value = ""; //�����޾�, ������ �⺻��+�������� ���� ���ʱݾ�
		frm.check_worktime_yn.value = "N"; //�ٷνð� �����Է�
	}
	//�޸�
	frm.memo_pay.value = document.formSalary.memo_pay.value; //�⺻��
}
function setWorkHour( type, base_gn ) {
	//�ϱ��� �⺻�ϱ����� �⺻�ñ� ����
	if(document.dataForm.pay_gbn.value == "1") {
		setWorkHour_Parttime( type, money_min_time );
		return;
	} else if(document.dataForm.pay_gbn.value == "4") {
		money_min_time = toInt(document.formSalary.money_day_base.value)/8;
		document.formSalary.money_hour.value = setComma(money_min_time);
		//alert(money_min_time);
		setWorkHour_Parttime( type, money_min_time );
		return;
	}
	if(document.formSalary.check_money_min_2015_yn.checked) {
		money_min_time = <?=$money_min_time_2015?>;
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
		rate_night = 1;
		rate_hday = 1;
	} else {
/*
		rate_ext = 1.5;
		rate_night = 0.5;
		rate_hday = 1.5;
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
//�����ñ�(2015��)
$money_time_2015 = 5580;
//�����ñ�(2016��)
$money_time_2016 = 6030;
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
	money_e9 = toInt(f.money_e9.value); // ���������9

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
	if(f.money_e9_gy.value != "Y") {
		money_e9 = 0;
	}
	//��Ÿ���� �հ�
	money_e_sum = money_e1 + money_e2 + money_e3 + money_e4 + money_e5 + money_e6 + money_e7 + money_e8 + money_e9;
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

	//alert(f.check_worktime_yn.checked);

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
		//alert(workhour_day_d);

		f.workhour_day_w.value = workhour_day_w;
		workhour_day = Math.round( ( workhour_day_w + workhour_day_d_limit ) * month_calc  );
		//alert("�����ٷνð�(1����) : "+workhour_day+" = ( "+workhour_day_w+" + "+workhour_day_d_limit+" ) * "+month_calc);

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
	//��������(2016��)
	money_min_2016 = <?=$money_time_2016?> * workhour_day;
	f.money_min_2016.value = setComma(money_min_2016);

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
	if( money_hour_ts == Infinity ) money_hour_ts = 0;
	//alert("("+money_month+") / "+workhour_total3);
	//�⺻�ϱ�
	//money_hour_ds = (money_month) / workhour_total3 * workhour_day_d;
	//if( isNaN(money_hour_ds) ) money_hour_ds = 0;

	//�������� ���޿��� ----------------------
	var money_year_yn = f.money_year_yn.value; // �������� ���޿���
	var workhour_year = 0; // �����ް� �ð�
	var money_year = 0; // ��������
	var money_period = 0; // ��������
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
		money_min = toInt(workhour_total3 * money_min_time);
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
	f.money_period.value = setComma( money_period );
	f.money_base.value = setComma( money_base );
	f.money_ext.value = setComma( money_ext );
	f.money_hday.value = setComma( money_hday );
	f.money_night.value = setComma( money_night );
	// ��������(����) �ڵ� �Է�
	//alert(f.check_money_b_yn.checked);
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
//��������
function checkAnnualPaidHolidayYn() {
	var f = document.dataForm;
	if(f.check_annual_paid_holiday_yn.checked) {
		f.annual_paid_holiday_hidden.value = f.annual_paid_holiday.value;
		f.annual_paid_holiday.value = "15";
	} else {
		f.annual_paid_holiday.value = f.annual_paid_holiday_hidden.value;
	}
}
//���Ұ��
function checkCalDayYn() {

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
	f = document.formSalary;

	var className = "textfm5";
	var readOnly = true;
	if( f.check_worktime_d_yn.checked ) {
		className = "textfm";
		readOnly = false;
	}else{
		f.workhour_day_d.value = 8;
		if(!f.check_worktime_w_yn.checked) f.workhour_day_w.value = 40;
		if(!f.check_worktime_yn.checked) f.workhour_day.value = 209;
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
//�⺻�ñ�(2013) ���� �Է�
function checkMoney_Min2013Yn(money) {
	var f = document.formSalary;
	var frm = document.dataForm;
	var obj = f.check_money_min_2013_yn;
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
//�⺻�ñ�(2015) ���� �Է�
function checkMoney_Min2015Yn(money) {
	var f = document.formSalary;
	var frm = document.dataForm;
	var obj = f.check_money_min_2015_yn;
	if(obj.checked) {
		obj.value = "Y";
		f.money_min_time.value = money;
		frm.money_min_time.value = money;
	}else{
		obj.value = "N";
		f.money_min_time.value = "<?=number_format($money_min_time)?>";
		frm.money_min_time.value = "<?=number_format($money_min_time)?>";
	}
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
		alert("�޿����-��ٷνð��� ����/�߰�/���� �ٷνð� \n������ ����� �ڵ� �ݿ����� �ʽ��ϴ�.");
	} else {
		className = "textfm5";
		readOnly = true;
	}
	f.money_b1.className = className;
	f.money_b1.readOnly = readOnly;
	f.money_b2.className = className;
	f.money_b2.readOnly = readOnly;
	f.money_b3.className = className;
	f.money_b3.readOnly = readOnly;
	//f.money_b4.className = className;
	//f.money_b4.readOnly = readOnly;
	var obj = f.check_money_b_yn;
	if(obj.checked) obj.value = "Y";
	else obj.value = "N";
}
//4�뺸�� ���� �Է�
function checkMoney_4insureYn() {
	var f = document.formSalary;

	var className = "textfm5";
	var readOnly = true;
	if( f.check_money_4insure_yn.checked ) {
		className = "textfm";
		readOnly = false;
		alert("�޿����-����������� 4�뺸�� ����� �ڵ� �ݿ����� �ʽ��ϴ�.");
	} else {
		className = "textfm5";
		readOnly = true;
	}
	f.money_yun.className = className;
	f.money_yun.readOnly = readOnly;
	f.money_health.className = className;
	f.money_health.readOnly = readOnly;
	f.money_yoyang.className = className;
	f.money_yoyang.readOnly = readOnly;
	f.money_goyong.className = className;
	f.money_goyong.readOnly = readOnly;
	//f.money_sj.className = className;
	//f.money_sj.readOnly = readOnly;
}
function checkData() {
	var frm = document.dataForm;
	total_cal();
	setPayBase();

	var f = document.formSalary;
	//alert(f.check_money_min_yn.value);
	//alert(f.check_worktime_w_yn.value);
	//return;

	frm.action = "staff_pay_update.php";
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

function openSelectWorkTime() {
	if( document.dataForm.pay_gbn.value == "2" ){
		alert("���ձٹ��� ��� �ְ� �ٹ��ð�ǥ�� ������ �� �����ϴ�.");
		return;
	}
	if( document.dataForm.pay_gbn.value == "0" || document.dataForm.pay_gbn.value == "2" || document.dataForm.pay_gbn.value == "3" ){
		if( document.formSalary.check_worktime_yn.checked ){
			alert("�ٷνð� �����Է� üũ�� �����ϼž� �ְ� �ٹ�ǥ ������ �����մϴ�.");
			return;
		}
	}else if( document.dataForm.pay_gbn.value == "1" ){
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
//�����ӱ� �ۼ�Ʈ ���
function money_month_base_pesent_cal() {
	var f = document.formSalary;
	money_min = toInt(f.money_month_base.value) * ( toInt(f.money_month_base_pesent.value) / 100 );
	f.check_money_min_yn.checked = true;
	checkMoney_MinYn();
	f.money_min.value = setComma(money_min);
}
//������ ���� ���
function money_year_base_pesent_cal() {
	var f = document.formSalary;
	money_month_base = Math.round( toInt(f.money_year_base.value) / toInt(f.money_year_base_division.value) );
	f.money_month_base.value = setComma(money_month_base);
	f.money_year_base_month.value = f.money_month_base.value;
}
//�������� �����Ա� ����
function money_month_base_copy(fid) {
	var f = document.formSalary;
	f.money_month_base.value = fid.value;
	//alert(f.money_month_base.value);
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
//�����Ѿ� �ʱ�ȭ
function money_year_reset() {
	var f = document.formSalary;
	f.money_year_base.value = "";
	f.money_year_base.focus();
}
//�⺻�ϱ� �ʱ�ȭ
function money_day_reset() {
	var f = document.formSalary;
	f.money_day_base.value = "";
	f.money_day_base.focus();
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
	var e = event.keyCode;
	window.status = e;
	if (e>=48 && e<=57) return;
	if (e>=96 && e<=105) return;
	if (e>=37 && e<=40) return;
	if (e==8 || e==9 || e==13 || e==46) return;
	event.returnValue = false;
}
//���� �˻�
function open_jikjong(n) {
	window.open("popup/jikjong_popup.php?n=_"+n, "jikjong_popup", "width=640, height=706, toolbar=no, menubar=no, scrollbars=no, resizable=no" );
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
<?
//�ֱٷνð� ����/����/�߰� A
$sql_work_time = " select * from a4_work_time where com_code='$code' and sabun='' and work_gbn = 'A' ";
$result_work_time = sql_query($sql_work_time);
$row_work_time = mysql_fetch_array($result_work_time);
$a_work_gbn_text = $row_work_time['work_gbn_text'];
$a_workhour_day_d = $row_work_time['workhour_day_d'];
$a_workhour_day_w = $row_work_time['workhour_day_w'];
$a_workhour_ext_w = $row_work_time['workhour_ext_w'];
$a_workhour_night_w = $row_work_time['workhour_night_w'];
$a_workhour_hday_w = $row_work_time['workhour_hday_w'];
//�ֱٷνð� ����/����/�߰� B
$sql_work_time = " select * from a4_work_time where com_code='$code' and sabun='' and work_gbn = 'B' ";
$result_work_time = sql_query($sql_work_time);
$row_work_time = mysql_fetch_array($result_work_time);
$b_work_gbn_text = $row_work_time['work_gbn_text'];
$b_workhour_day_d = $row_work_time['workhour_day_d'];
$b_workhour_day_w = $row_work_time['workhour_day_w'];
$b_workhour_ext_w = $row_work_time['workhour_ext_w'];
$b_workhour_night_w = $row_work_time['workhour_night_w'];
$b_workhour_hday_w = $row_work_time['workhour_hday_w'];
//�ֱٷνð� ����/����/�߰� C
$sql_work_time = " select * from a4_work_time where com_code='$code' and sabun='' and work_gbn = 'C' ";
$result_work_time = sql_query($sql_work_time);
$row_work_time = mysql_fetch_array($result_work_time);
$c_work_gbn_text = $row_work_time['work_gbn_text'];
$c_workhour_day_d = $row_work_time['workhour_day_d'];
$c_workhour_day_w = $row_work_time['workhour_day_w'];
$c_workhour_ext_w = $row_work_time['workhour_ext_w'];
$c_workhour_night_w = $row_work_time['workhour_night_w'];
$c_workhour_hday_w = $row_work_time['workhour_hday_w'];
?>
function work_gbn_chk(chk) {
	//alert(chk);
	var f = document.formSalary;

	//1��, 1�� �ٷνð� �����Է� �ڵ� üũ 160126
	f.check_worktime_d_yn.checked = true;
	f.check_worktime_w_yn.checked = true;
	f.workhour_day_d.className = "textfm";
	f.workhour_day_d.readOnly = false;
	f.workhour_day_w.className = "textfm";
	f.workhour_day_w.readOnly = false;
	f.workhour_ext_w.className = "textfm";
	f.workhour_ext_w.readOnly = false;
	f.workhour_night_w.className = "textfm";
	f.workhour_night_w.readOnly = false;
	f.workhour_hday_w.className = "textfm";
	f.workhour_hday_w.readOnly = false;

	if(chk == "A") {
		f.workhour_day_d.value = '<?=$a_workhour_day_d?>';
		f.workhour_day_w.value = '<?=$a_workhour_day_w?>';
		f.workhour_ext_w.value = '<?=$a_workhour_ext_w?>';
		f.workhour_night_w.value = '<?=$a_workhour_night_w?>';
		f.workhour_hday_w.value = '<?=$a_workhour_hday_w?>';
	} else if(chk == "B") {
		f.workhour_day_d.value = '<?=$b_workhour_day_d?>';
		f.workhour_day_w.value = '<?=$b_workhour_day_w?>';
		f.workhour_ext_w.value = '<?=$b_workhour_ext_w?>';
		f.workhour_night_w.value = '<?=$b_workhour_night_w?>';
		f.workhour_hday_w.value = '<?=$b_workhour_hday_w?>';
	} else if(chk == "C") {
		f.workhour_day_d.value = '<?=$c_workhour_day_d?>';
		f.workhour_day_w.value = '<?=$c_workhour_day_w?>';
		f.workhour_ext_w.value = '<?=$c_workhour_ext_w?>';
		f.workhour_night_w.value = '<?=$c_workhour_night_w?>';
		f.workhour_hday_w.value = '<?=$c_workhour_hday_w?>';
	}
	setWorkHour('day');
	total_cal();
}
function check_ge_func(fid,id) {
	if(fid.checked == true) {
		document.getElementById("money_"+id+"_td").style.display="inline";
		document.getElementById("money_"+id+"_tdk").style.display="inline";
	} else {
		document.getElementById("money_"+id+"_td").style.display="none";
		document.getElementById("money_"+id+"_tdk").style.display="none";
	}
}
</script>
<? include "./inc/top.php"; ?>

<div id="content">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="1200" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top" width="270">
<?
if($comp_print_type == "H") {
	include "./inc/left_menu2_type_h.php";
} else {
	include "./inc/left_menu2.php";
}
include "./inc/left_banner.php";
?>
						</td>
						<td valign="top" style="padding:10px 10px 10px 10px">
							<div id='print_page'>
							<!--Ÿ��Ʋ -->
							<table width="100%" border=0 cellspacing=0 cellpadding=0>
								<tr>     
									<td height="18">
										<table width="100%" border=0 cellspacing=0 cellpadding=0>
											<tr>
												<td style='font-size:8pt;color:#929292;'><img src="images/g_title_icon.gif" align=absmiddle  style='margin:0 5px 2px 0'><span style='font-size:9pt;color:black;'><?=$sub_title?></span>
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
									<td>
<?
//����
$position = " ";
if($row2[position]) {
	$sql_position = " select * from com_code_list where item='position' and com_code = '$code' and code = $row2[position] ";
	//echo $sql_position;
	$result_position = sql_query($sql_position);
	$row_position = sql_fetch_array($result_position);
	$position = $row_position[name];
}
//�ֹε�Ϲ�ȣ �� �ټ��ڸ� ��ǥ ó��
$jumin_no = substr($row1[jumin_no],0,9)."*****";
//�Ի���
$in_day_array = explode(".",$row1[in_day]);
$in_day = $in_day_array[0]."�� ".$in_day_array[1]."�� ".$in_day_array[2]."��";
//ä������
if($row1[work_form] == "") $work_form = "";
else if($row1[work_form] == "1") $work_form = "������";
else if($row1[work_form] == "2") $work_form = "�����";
else if($row1[work_form] == "3") $work_form = "�Ͽ���";
else if($row1[work_form] == "4") $work_form = "����ҵ�";
//�������
$staff_info = "���� : ".$row1['name']." / ���� : ".$position." / �ֹε�Ϲ�ȣ : ".$jumin_no." / �Ի��� : ".$in_day." / ä������ : ".$work_form;
echo $staff_info;
?>
									</td>
								</tr> 
							</table>
							<div style="height:2px;font-size:0px" class="bgtr_tab"></div>
							<div style="height:10px;font-size:0px"></div>

							<!--�⺻�� dataForm-->
							<form name="dataForm" method="post" enctype="multipart/form-data">

								<!--���� ������-->
								<?
								if(!$code) $code = $com_code;
								if($check_money_min_2015_yn == "Y") {
									$money_min_time_var = $money_min_time_2015;
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
								<input type="hidden" name="money_day_base" value=""><!-- �⺻�ϱ� -->
								<input type="hidden" name="money_year_base" value=""><!-- �����Ѿ� -->
								<input type="hidden" name="money_year_base_division" value=""><!-- �������� -->

								<input type="hidden" name="money_g1" value="<?=$row4[money_g1]?>"><!-- ���������� -->
								<input type="hidden" name="money_g2" value="0"><!-- ���������� -->
								<input type="hidden" name="money_g3" value="0"><!-- ���������� -->
								<input type="hidden" name="money_g4" value="0"><!-- ���������� -->
								<input type="hidden" name="money_g5" value="0"><!-- ���������� -->
								<input type="hidden" name="money_b1" value="0"><!-- �������� -->
								<input type="hidden" name="money_b2" value="0"><!-- �������� -->
								<input type="hidden" name="money_b3" value="0"><!-- �������� -->
								<input type="hidden" name="money_b4" value="0"><!-- �������� -->
								<input type="hidden" name="money_b5" value="0"><!-- �������� -->

								<input type="hidden" name="money_e1" value="0"><!-- ��������� -->
								<input type="hidden" name="money_e2" value="0"><!-- ��������� -->
								<input type="hidden" name="money_e3" value="0"><!-- ��������� -->
								<input type="hidden" name="money_e4" value="0"><!-- ��������� -->
								<input type="hidden" name="money_e5" value="0"><!-- ��������� -->
								<input type="hidden" name="money_e6" value="0"><!-- ��������� -->
								<input type="hidden" name="money_e7" value="0"><!-- ��������� -->
								<input type="hidden" name="money_e8" value="0"><!-- ��������� -->
								<input type="hidden" name="money_e9" value="0"><!-- ��������� -->

								<input type="hidden" name="pay_yun" value="0"><!-- ���ο��� -->
								<input type="hidden" name="pay_health" value="0"><!-- �ǰ����� -->
								<input type="hidden" name="pay_goyong" value="0"><!-- ��뺸�� -->

								<input type="hidden" name="money_yun" value="0"><!-- ���ο��� -->
								<input type="hidden" name="money_health" value="0"><!-- �ǰ����� -->
								<input type="hidden" name="money_yoyang" value="0"><!-- ����� -->
								<input type="hidden" name="money_goyong" value="0"><!-- ��뺸�� -->

								<input type="hidden" name="week_hday" value="4"><!-- �����ϼ� -->
								<input type="hidden" name="year_hday" value="0"><!-- ���������ް��ϼ� -->

								<input type="hidden" name="money_base" value=""><!-- �⺻�� -->
								<input type="hidden" name="money_ext" value=""><!-- ����ٷμ��� -->
								<input type="hidden" name="money_hday" value=""><!-- ���ϱٷμ��� -->
								<input type="hidden" name="money_night" value=""><!-- �߰��ٷμ��� -->

								<input type="hidden" name="money_year_yn" value=""><!-- �������� ���޿��� -->
								<input type="hidden" name="workhour_year" value=""><!-- �����ް� �ð� -->
								<input type="hidden" name="money_year" value=""><!-- �������� -->
								<input type="hidden" name="money_period" value=""><!-- �������� -->

								<input type="hidden" name="money_month_base" value=""><!-- �����޾�, ������ �⺻��+�������� ���� ���ʱݾ� -->
								<input type="hidden" name="money_month_base_pesent" value=""><!-- �ۼ�Ʈ(�����ӱ�) -->

								<input type="hidden" name="memo_pay" value=""><!-- �޸� -->
								<input type="hidden" name="money_total_sum" value=""><!-- �Ѿ� -->

								<input type="hidden" name="check_worktime_d_yn" value="N"><!-- 1�� �ٷνð��� �������� �Է� -->
								<input type="hidden" name="check_worktime_w_yn" value="N"><!-- 1�� �ٷνð��� �������� �Է� -->
								<input type="hidden" name="check_worktime_yn" value="N"><!-- 1���� �ٷνð��� �������� �Է� -->
								<input type="hidden" name="check_money_min_yn" value="N"><!-- �⺻�� ���� �Է� -->
								<input type="hidden" name="check_money_min_2015_yn" value="N"><!-- �����ñ�(2015��) ���� �Է� -->
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
								if($row4[money_month_base])	{
									$pay_year = $row4[money_month_base];
								} else {
									$pay_year = 0;
								}
								//��������
								$money_year_base_month = $pay_year;
								//���ؽñ�
								if($row4[money_hour_ds]) {
									$money_hour = $row4[money_hour_ds];
								} else {
									if($row_com_opt2['pay_gbn_b'] && substr($row_com['payrpt'], 1,1)==2) $money_hour = $money_time_input;
									else $money_hour = $money_min_time;
								}
								//�⺻��
								if($row4[money_hour_ms])	{
									$money_hour_ms = number_format($row4[money_hour_ms]);
								}
								?>
								<input type="hidden" name="pay_month" id="pay_month" value="<?=$pay_year?>" />
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<col width="10%">
									<col width="40%">
									<col width="10%">
									<col width="40%">
									<tr>
										<td class="tdrowk_center">�����ٷνð�</td>
										<td class="tdrow">
											<select name="work_gbn" id="work_gbn" class="selectfm" style="width:;" onchange="work_gbn_chk(this.value);">
												<option value="A" <? if($work_gbn_checked == "A") echo "selected"; ?> >A(<?=$a_work_gbn_text?>) ����(<?=$a_workhour_day_w?>) ����(<?=$a_workhour_ext_w?>) �߰�(<?=$a_workhour_night_w?>) ����(<?=$a_workhour_hday_w?>)</option>
												<option value="B" <? if($work_gbn_checked == "B") echo "selected"; ?> >B(<?=$b_work_gbn_text?>) ����(<?=$b_workhour_day_w?>) ����(<?=$b_workhour_ext_w?>) �߰�(<?=$b_workhour_night_w?>) ����(<?=$b_workhour_hday_w?>)</option>
												<option value="C" <? if($work_gbn_checked == "C") echo "selected"; ?> >C(<?=$c_work_gbn_text?>) ����(<?=$c_workhour_day_w?>) ����(<?=$c_workhour_ext_w?>) �߰�(<?=$c_workhour_night_w?>) ����(<?=$c_workhour_hday_w?>)</option>
											</select>
											<!--�ְ� �ٷ��� ���� ��-->
											<input name="workday_month" type="hidden" value="<?=$row_com_opt[workday_month]?>">
											<span id="workday_month_text" style="display:none;"></span>
											<input tyle="hidden" id="workday_week" name="workday_week" style="display:none;">
<?
if($check_worktime_w_yn != "Y") {
	//�ֱٷνð� ����/����/�߰� (�������)
	$sql_work_time = " select * from a4_work_time where com_code='$code' and sabun='' and work_gbn = '$work_gbn_checked' ";
	//echo $sql_work_time;
	$result_work_time = sql_query($sql_work_time);
	$row_work_time = mysql_fetch_array($result_work_time);
	$workhour_day_d = $row_work_time[workhour_day_d];
	$workhour_day_w = $row_work_time[workhour_day_w];
	$workhour_ext_w = $row_work_time[workhour_ext_w];
	$workhour_night_w = $row_work_time[workhour_night_w];
	$workhour_hday_w = $row_work_time[workhour_hday_w];
}
?>
										</td>
										<td class="tdrowk_center">�޿�����</td>
										<td class="tdrow">
<?
//if($row2[pay_gbn] == "") $row2[pay_gbn] = "0";
//echo $row2[pay_gbn];
//echo $row_com_opt2['pay_gbn_a'];
if(!$row2['pay_gbn']) {
	if($row_com_opt2['pay_gbn_a']) {
		$row2['pay_gbn'] = "0";
		$row4['input_type'] = substr($row_com['payrpt'], 0,1);
	} else {
		if($row_com_opt2['pay_gbn_b']) {
			$row2['pay_gbn'] = "1";
			$row4['input_type'] = substr($row_com['payrpt'], 1,1);
		} else {
			if($row_com_opt2['pay_gbn_c']) {
				$row2['pay_gbn'] = "3";
				$row4['input_type'] = substr($row_com['payrpt'], 3,1);
			} else {
				if($row_com_opt2['pay_gbn_d']) {
					$row2['pay_gbn'] = "4";
					$row4['input_type'] = substr($row_com['payrpt'], 4,1);
				}
			}
		}
	}
}
?>
											<select name="pay_gbn" id="pay_gbn" class="selectfm" style="width:92px;" onchange="displayPayGbn();pay_gbn_select();">
												<option value=""  <? if($row2[pay_gbn] == "")  echo "selected"; ?> >�����ϼ���</option>
												<option value="0" <? if($row2[pay_gbn] == "0") echo "selected"; ?> >������</option>
												<option value="1" <? if($row2[pay_gbn] == "1") echo "selected"; ?> >�ñ���</option>
												<option value="3" <? if($row2[pay_gbn] == "3") echo "selected"; ?> >������</option>
												<option value="4" <? if($row2[pay_gbn] == "4") echo "selected"; ?> >�ϱ���</option>
											</select>
											<select name="pay_gbn2_0" id="pay_gbn2_0" class="selectfm" style="width:100px;<? if($row2[pay_gbn] == "0") echo "display:inline"; else echo "display:none"; ?>" onchange="pay_gbn_select();">
												<option value="1" <? if($row4[input_type] == "1") echo "selected"; ?> >A �����ӱ�</option>
												<option value="2" <? if($row4[input_type] == "2") echo "selected"; ?> >B �ۼ�Ʈ</option>
												<option value="3" <? if($row4[input_type] == "3") echo "selected"; ?> >C �����Է�</option>
											</select>
											<select name="pay_gbn2_1" id="pay_gbn2_1" class="selectfm" style="width:100px;<? if($row2[pay_gbn] == "1") echo "display:inline"; else echo "display:none"; ?>" onchange="pay_gbn_select();">
												<option value="1" <? if($row4[input_type] == "1") echo "selected"; ?> >A �����ñ�</option>
												<option value="2" <? if($row4[input_type] == "2") echo "selected"; ?> >B �����Է�</option>
											</select>
											<select name="pay_gbn2_3" id="pay_gbn2_3" class="selectfm" style="width:100px;<? if($row2[pay_gbn] == "3") echo "display:inline"; else echo "display:none"; ?>" onchange="pay_gbn_select();">
												<option value="1" <? if($row4[input_type] == "1") echo "selected"; ?> >A �����ӱ���</option>
												<option value="2" <? if($row4[input_type] == "2") echo "selected"; ?> >B ��������</option>
											</select>
											<select name="pay_gbn2_4" id="pay_gbn2_4" class="selectfm" style="width:100px;<? if($row2[pay_gbn] == "4") echo "display:inline"; else echo "display:none"; ?>" onchange="pay_gbn_select();">
												<option value="1" <? if($row4[input_type] == "1") echo "selected"; ?> >A �����ϱ�</option>
												<option value="2" <? if($row4[input_type] == "2") echo "selected"; ?> >B �����Է�</option>
											</select>
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

							</form>
							<!--�⺻�� dataForm-->

							<div style="height:10px;font-size:0px;line-height:0px;"></div>

							<!-- ������ / ���ձٹ� -->
							<form name="formSalary" id="formSalary" style="margin:0;display:;">
								<!--<input type="hidden" name="workhour_day_d" value="<?=$workhour_day_d?>" />--><!-- 1�� �ٷνð� -->
								<input type="hidden" name="money_month_" value="0" /><!-- �⺻(��)�� -->
								<input name="workhour_total2_w" type="hidden" class="textfm5" style="width:60;ime-mode:disabled;" value="" maxlength="10" readonly />
								<input name="workhour_total2" type="hidden" class="textfm5" style="width:60;ime-mode:disabled;" value="" maxlength="10" readonly />
								<input name="workhour_total3_w" type="hidden" class="textfm5" style="width:60;ime-mode:disabled;" value="" maxlength="10" readonly />
								<input name="workhour_total3" type="hidden" class="textfm5" style="width:60;ime-mode:disabled;" value="" maxlength="10" readonly />

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
										<td class="tdrowk"><b>�ٷμ���</b></td>
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
											<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='memo_pay_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer">
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
													�޸�
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
$memo_pay_div_display = "display:none;";
?>
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" id="memo_pay_div" style="<?=$memo_pay_div_display?>">
									<col width="10%">
									<col width="40%">
									<col width="10%">
									<col width="40%">
									<tr>
										<td class="tdrow">
											<textarea name="memo_pay" style="width:100%;height:200px;word-break:break-all;" class="textfm"><?=$row4['memo_pay']?></textarea>
										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px;line-height:0px;"></div>

								<div id="pay_base" style="display:none;">
									<!--��޴� -->
									<table border=0 cellspacing=0 cellpadding=0> 
										<tr>
											<td id=""> 
												<table border=0 cellpadding=0 cellspacing=0>
													<tr> 
														<td><img src="images/g_tab_on_lt.gif"></td> 
														<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
															<span id="decision"><? if($row2[pay_gbn] == "1") echo "���ؽñ�"; else if($row2[pay_gbn] == "4") echo "�����ϱ�"; else echo "�����ӱ�"; ?></span>
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
											<td class="tdrowk_center" width="20%"><span id="decision_txt"><? if($row2[pay_gbn] == "1") echo "�� ���ؽñ�"; else echo "�� �����ӱ�"; ?></span></td>
											<td class="tdrow" width="30%">
												<div id="decision_div" style="<? if($row2[pay_gbn] == "1") echo "display:none"; else echo "display:inline"; ?>">
													<a href="javascript:money_month_base_reset();" title="�ٽ��Է�"><img src="images/btn_reset.png" border="0" style="display:<? if($row2[pay_gbn] == "1") echo "none"; else echo "inline" ?>;vertical-align:middle;" id="decision_reset"></a>
													<input name="money_month_base" id="money_month_base" type="text" class="textfm" style="width:70px;ime-mode:disabled;" value="<?=number_format($pay_year)?>" maxlength="10" onblur="setWorkHour();" onkeyup="checkThousand(this.value, this,'Y')"> ��
												</div>
												<div id="decision_div2" style="<? if($row2[pay_gbn] == "0") echo "display:none"; else echo "display:inline"; ?>">
													<a href="javascript:money_hour_reset();" title="�ٽ��Է�"><img src="images/btn_reset.png" border="0" style="display:<? if($row2[pay_gbn] == "0") echo "none"; else echo "inline" ?>;vertical-align:middle;" id="decision_reset2"></a>
													<input name="money_hour"       id="money_hour"       type="text" class="textfm" style="width:70px;ime-mode:disabled;" value="<?=number_format($money_hour)?>" maxlength="10" onblur="setWorkHour();" onkeyup="checkThousand(this.value, this,'Y')"> ��
												</div>
												<div id="decision_div3" style="<? if($row2[pay_gbn] == "3") echo "display:none"; else echo "display:inline"; ?>">
													<a href="javascript:money_year_reset();" title="�ٽ��Է�"><img src="images/btn_reset.png" border="0" style="display:<? if($row2[pay_gbn] == "0") echo "none"; else echo "inline" ?>;vertical-align:middle;" id="decision_reset3"></a>
													<input name="money_year_base" id="money_year_base"   type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=number_format($money_year_base)?>" maxlength="11" onblur="setWorkHour();" onkeyup="checkThousand(this.value, this,'Y')"> �� /
													<input name="money_year_base_division" id="money_year_base_division" type="text" class="textfm" style="width:50px;ime-mode:disabled;" value="<?=$money_year_base_pesent?>" maxlength="2" onblur="setWorkHour();" onkeypress="only_number();" onkeyup=""> ����
													<table border=0 cellpadding=0 cellspacing=0 style="vertical-align:middle;display:inline;<? if($row2[pay_gbn] == "1") echo "display:none"; ?>" id="money_year_apply"><tr><td width="2"></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:money_year_base_pesent_cal();">����</a></td><td><img src=./images/btn2_rt.gif></td><td width=2></td></tr></table>
												</div>
												<div id="decision_div4" style="<? if($row2[pay_gbn] == "4") echo "display:none"; else echo "display:inline"; ?>">
													<a href="javascript:money_day_reset();" title="�ٽ��Է�"><img src="images/btn_reset.png" border="0" style="display:<? if($row2[pay_gbn] == "4") echo "none"; else echo "inline" ?>;vertical-align:middle;" id="decision_reset4"></a>
													<input name="money_day_base" id="money_day_base" type="text" class="textfm" style="width:70px;ime-mode:disabled;" value="<?=number_format($money_day_base)?>" maxlength="10" onblur="setWorkHour();" onkeyup="checkThousand(this.value, this,'Y')"> ��
												</div>
											</td>
											<td class="tdrowk_center" width="20%"><span id="decision_txt2" style="display:<? if( ($row2[pay_gbn] == "0" && $row4[input_type] == "2" && $row4[input_type] == "3") || $row2[pay_gbn] == "3" ) echo "inline"; else echo "none"; ?>"><? if($row2[pay_gbn] == "0") echo "�� �ۼ�Ʈ(�����ӱ�)"; else if($row2[pay_gbn] == "3") echo "�� ��������"; ?></span></td>
											<td class="tdrow" width="30%">
												<div id="decision_input2" style="<? if($row2[pay_gbn] == "0" && $row4[input_type] == "2") echo "display:inline"; else echo "display:none"; ?>">
													<input name="money_month_base_pesent" id="money_month_base_pesent" type="text" class="textfm" style="width:40px;ime-mode:disabled;" value="<?=$money_month_base_pesent?>" maxlength="2" onblur="setWorkHour();" onkeypress="only_number();" onkeyup=""> %
													<table border=0 cellpadding=0 cellspacing=0 style="vertical-align:middle;display:inline;<? if($row2[pay_gbn] == "1") echo "display:none"; ?>" ><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:money_month_base_pesent_cal();">����</a></td><td><img src=./images/btn2_rt.gif></td><td width=2></td></tr></table>
												</div>
												<div id="decision_input3" style="<? if($row2[pay_gbn] == "3") echo "display:inline"; else echo "display:none"; ?>">
													<input name="money_year_base_month" id="money_year_base_month" type="text" class="textfm" style="width:70px;ime-mode:disabled;" value="<?=number_format($money_year_base_month)?>" maxlength="10" onblur="money_month_base_copy(this);" onkeypress="only_number();" onkeyup=""> ��
												</div>
											</td>
										</tr>
									</table>
									<div style="margin:4px 0 0 0;color:red;display:none" id="base_down">�⺻���� �����ӱݿ� �̴��Դϴ�. �����ݾ��� �÷� �ֽʽÿ�.</div>
									<div style="height:10px;font-size:0px;line-height:0px;"></div>

									<div id="pay_money_min_time" style="display:none;">
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
												<td class="tdrowk_center">�� �����ñ�(2016��)</td>
												<td class="tdrow" valign="top">
													<input name="money_min_time" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="" maxlength="10" readonly> ��
													<!--<input type="checkbox" name="check_money_hour_ts_yn" value="Y" <? if($row4[check_money_hour_ts_yn] == "Y") echo "checked"; ?> onClick="checkMoney_Hour_TsYn()">����-->
													<!--<input type="checkbox" name="check_money_min_2014_yn" id="check_money_min_2014_yn" value="<?=$check_money_min_2014_yn?>" <? if($check_money_min_2014_yn == "Y") echo "checked"; ?> onClick="checkMoney_Min2014Yn('<?=number_format($money_min_time_2014)?>')"><?=number_format($money_min_time_2014)?>��(2014��)-->
													<input type="checkbox" name="check_money_min_2015_yn" id="check_money_min_2015_yn" value="<?=$check_money_min_2015_yn?>" <? if($check_money_min_2015_yn == "Y") echo "checked"; ?> onClick="checkMoney_Min2015Yn('<?=number_format($money_min_time_2015)?>')"><?=number_format($money_min_time_2015)?>��(2015��)
												</td>
											</tr>
										</table>
										<div style="height:10px;font-size:0px;line-height:0px;"></div>
									</div>
									<div id="pay_money_min_div" style="display:;">
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
												<td class="tdrowk_center" width="15%">�� �⺻��</td>
												<td class="tdrow" valign="top" width="22%">
													<div id="check_money_min_div">
														<input type="checkbox" name="check_money_min_yn" id="check_money_min_yn" value="<?=$check_money_min_yn?>" <? if($check_money_min_yn == "Y") echo "checked"; ?> onClick="checkMoney_MinYn()" style="vertical-align:middle;" />����
														<a href="javascript:money_min_reset();" title="�ٽ��Է�"><img src="images/btn_reset.png" border="0" style="display:<? if($check_money_min_yn == "N") echo "none"; else echo "inline"; ?>;vertical-align:middle;" id="check_money_min_bt"></a>
													</div>
													<input name="money_min" id="money_min" type="text" style="width:70px;ime-mode:disabled;" value="<?=$money_hour_ms?>" <? if($check_money_min_yn == "Y") { ?> class="textfm" <? } else { ?> class="textfm5" readonly <? } ?> maxlength="10" onblur="setWorkHour();" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"> ��
												</td>
												<td class="tdrowk_center" width="15%">�� �⺻�ñ�</td>
												<td class="tdrow" width="16%">
													<input name="money_min_base" type="text" class="textfm5" style="width:70px;ime-mode:disabled;" value="0" maxlength="10" readonly> ��
												</td>
												<td class="tdrowk_center" width="15%">�� ���ñ�</td>
												<td class="tdrow">
													<input name="money_hour_ts" type="hidden"><!--���ڸ� ����-->
													<input name="money_hour_ts_view" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="" maxlength="10" readonly> ��
													<!--<input type="checkbox" name="check_money_hour_ts_yn" value="Y" <? if($row4[check_money_hour_ts_yn] == "Y") echo "checked"; ?> onClick="checkMoney_Hour_TsYn()">����-->
												</td>
											</tr>
											<tr>
												<td class="tdrowk_center" width="">��������(2016��)</td>
												<td class="tdrow" valign="top" width="">
													<img src="images/blank.gif" width="67" height="1"><input name="money_min_2016" type="text" class="textfm5" style="width:70px;ime-mode:disabled;" value="<?=number_format($money_min_2016)?>" maxlength="10" readonly> ��
												</td>
												<td class="tdrowk_center" width=""><b>�����ñ�</b>(2016��)</td>
												<td class="tdrow" width="">
													<input name="money_time_2016" type="text" class="textfm5" style="width:70px;ime-mode:disabled;" value="<?=number_format($money_time_2016)?>" maxlength="10" readonly> ��
												</td>
												<td class="tdrowk_center" width=""></td>
												<td class="tdrow">

												</td>
											</tr>
										</table>
									</div><!--�ñ��� ���ý� ���� ��-->
<!--
									<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed;margin-top:10px">
										<tr>
											<td style="text-align:center">
												<a href="javascript:pay_code_select()"><img src="images/btn_paychoice_big.png" border="0"></a>
											</td>
										</tr>
									</table>
-->
									<div style="height:2px;font-size:0px;line-height:0px;"></div>
								</div><!--�����ӱ�, ���ؽñ� ���� ��-->
								<!--<div id="pay_base2" style="<? if(!$row4[money_month_base])	echo "display:none;"; ?>">-->
								<div id="pay_base2" style="<? echo "display:none;"; ?>">
									<!--��޴� -->
									<table border=0 cellspacing=0 cellpadding=0> 
										<tr>
											<td id=""> 
												<table border=0 cellpadding=0 cellspacing=0> 
													<tr> 
														<td><img src="images/g_tab_on_lt.gif"></td> 
														<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
														�����ڵ� ����
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
									//����ӱ�1
									$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='g1' ";
									$row_paycode = sql_fetch($sql_paycode);
									$money_g1_txt = $row_paycode[name];
									$money_g1_auto = $row_paycode[auto];
									if($row4[money_g1] == "") {
										$row_paycode[calculate] = str_replace(',','',$row_paycode[calculate]);
										$row4[money_g1] = $row_paycode[calculate];
									}
									//����ӱ�2
									$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='g2' ";
									$row_paycode = sql_fetch($sql_paycode);
									$money_g2_txt = $row_paycode[name];
									$money_g2_auto = $row_paycode[auto];
									if($row4[money_g2] == "") {
										$row_paycode[calculate] = str_replace(',','',$row_paycode[calculate]);
										$row4[money_g2] = $row_paycode[calculate];
									}
									//����ӱ�3
									$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='g3' ";
									$row_paycode = sql_fetch($sql_paycode);
									$money_g3_txt = $row_paycode[name];
									$money_g3_auto = $row_paycode[auto];
									if($row4[money_g3] == "") {
										$row_paycode[calculate] = str_replace(',','',$row_paycode[calculate]);
										$row4[money_g3] = $row_paycode[calculate];
									}
									//����ӱ�4
									$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='g4' ";
									$row_paycode = sql_fetch($sql_paycode);
									$money_g4_txt = $row_paycode[name];
									$money_g4_auto = $row_paycode[auto];
									if($row4[money_g4] == "") {
										$row_paycode[calculate] = str_replace(',','',$row_paycode[calculate]);
										$row4[money_g4] = $row_paycode[calculate];
									}
									//����ӱ�5
									$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='g5' ";
									$row_paycode = sql_fetch($sql_paycode);
									$money_g5_txt = $row_paycode[name];
									$money_g5_auto = $row_paycode[auto];
									if($row4[money_g5] == "") {
										$row_paycode[calculate] = str_replace(',','',$row_paycode[calculate]);
										$row4[money_g5] = $row_paycode[calculate];
									}
									//����ӱ�6
									$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='g6' ";
									$row_paycode = sql_fetch($sql_paycode);
									$money_g6_txt = $row_paycode[name];
									$money_g6_auto = $row_paycode[auto];
									if($row4[money_g6] == "") {
										$row_paycode[calculate] = str_replace(',','',$row_paycode[calculate]);
										$row4[money_g6] = $row_paycode[calculate];
									}
									//����ӱ�7
									$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='g7' ";
									$row_paycode = sql_fetch($sql_paycode);
									$money_g7_txt = $row_paycode[name];
									$money_g7_auto = $row_paycode[auto];
									if($row4[money_g7] == "") {
										$row_paycode[calculate] = str_replace(',','',$row_paycode[calculate]);
										$row4[money_g7] = $row_paycode[calculate];
									}
									//����ӱ�8
									$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='g8' ";
									$row_paycode = sql_fetch($sql_paycode);
									$money_g8_txt = $row_paycode[name];
									$money_g8_auto = $row_paycode[auto];
									if($row4[money_g8] == "") {
										$row_paycode[calculate] = str_replace(',','',$row_paycode[calculate]);
										$row4[money_g8] = $row_paycode[calculate];
									}
									//��Ÿ����1
									$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='e1' ";
									$row_paycode = sql_fetch($sql_paycode);
									$money_e1_txt = $row_paycode[name];
									$money_e1_auto = $row_paycode[auto];
									$money_e1_gy = $row_paycode[gy_yn];
									//echo $row4[money_e1];
									if($row4[money_e1] == "") {
										$row_paycode[calculate] = str_replace(',','',$row_paycode[calculate]);
										$row4[money_e1] = $row_paycode[calculate];
									}
									//��Ÿ����2
									$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='e2' ";
									$row_paycode = sql_fetch($sql_paycode);
									$money_e2_txt = $row_paycode[name];
									$money_e2_auto = $row_paycode[auto];
									$money_e2_gy = $row_paycode[gy_yn];
									if($row4[money_e2] == "") {
										$row_paycode[calculate] = str_replace(',','',$row_paycode[calculate]);
										$row4[money_e2] = $row_paycode[calculate];
									}
									//��Ÿ����3
									$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='e3' ";
									$row_paycode = sql_fetch($sql_paycode);
									$money_e3_txt = $row_paycode[name];
									$money_e3_auto = $row_paycode[auto];
									$money_e3_gy = $row_paycode[gy_yn];
									if($row4[money_e3] == "") {
										$row_paycode[calculate] = str_replace(',','',$row_paycode[calculate]);
										$row4[money_e3] = $row_paycode[calculate];
									}
									//��Ÿ����4
									$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='e4' ";
									$row_paycode = sql_fetch($sql_paycode);
									$money_e4_txt = $row_paycode[name];
									$money_e4_auto = $row_paycode[auto];
									$money_e4_gy = $row_paycode[gy_yn];
									if($row4[money_e4] == "") {
										$row_paycode[calculate] = str_replace(',','',$row_paycode[calculate]);
										$row4[money_e4] = $row_paycode[calculate];
									}
									//��Ÿ����5
									$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='e5' ";
									$row_paycode = sql_fetch($sql_paycode);
									$money_e5_txt = $row_paycode[name];
									$money_e5_auto = $row_paycode[auto];
									$money_e5_gy = $row_paycode[gy_yn];
									if($row4[money_e5] == "") {
										$row_paycode[calculate] = str_replace(',','',$row_paycode[calculate]);
										$row4[money_e5] = $row_paycode[calculate];
									}
									//��Ÿ����6
									$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='e6' ";
									$row_paycode = sql_fetch($sql_paycode);
									$money_e6_txt = $row_paycode[name];
									$money_e6_auto = $row_paycode[auto];
									$money_e6_gy = $row_paycode[gy_yn];
									if($row4[money_e6] == "") {
										$row_paycode[calculate] = str_replace(',','',$row_paycode[calculate]);
										$row4[money_e6] = $row_paycode[calculate];
									}
									//��Ÿ����7
									$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='e7' ";
									$row_paycode = sql_fetch($sql_paycode);
									$money_e7_txt = $row_paycode[name];
									$money_e7_auto = $row_paycode[auto];
									$money_e7_gy = $row_paycode[gy_yn];
									if($row4[money_e7] == "") {
										$row_paycode[calculate] = str_replace(',','',$row_paycode[calculate]);
										$row4[money_e7] = $row_paycode[calculate];
									}
									//��Ÿ����8
									$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='e8' ";
									$row_paycode = sql_fetch($sql_paycode);
									$money_e8_txt = $row_paycode[name];
									$money_e8_auto = $row_paycode[auto];
									$money_e8_gy = $row_paycode[gy_yn];
									if($row4[money_e8] == "") {
										$row_paycode[calculate] = str_replace(',','',$row_paycode[calculate]);
										$row4[money_e8] = $row_paycode[calculate];
									}
									//��Ÿ����9
									$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='e9' ";
									$row_paycode = sql_fetch($sql_paycode);
									$money_e9_txt = $row_paycode[name];
									$money_e9_auto = $row_paycode[auto];
									$money_e9_gy = $row_paycode[gy_yn];
									if($row4[money_e9] == "") {
										$row_paycode[calculate] = str_replace(',','',$row_paycode[calculate]);
										$row4[money_e9] = $row_paycode[calculate];
									}
									?>
									<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
										<tr>
											<td class="tdrowk_center" width="120">����ӱ�</td>
											<td class="tdrow">
												<input type="checkbox" name="check_g1" value="1" <? if($money_g1_auto == "Y") echo "checked"; ?> onclick="check_ge_func(this,'g1')" > <?=$money_g1_txt?>
												<input type="checkbox" name="check_g2" value="1" <? if($money_g2_auto == "Y") echo "checked"; ?> onclick="check_ge_func(this,'g2')" > <?=$money_g2_txt?>
												<input type="checkbox" name="check_g3" value="1" <? if($money_g3_auto == "Y") echo "checked"; ?> onclick="check_ge_func(this,'g3')" > <?=$money_g3_txt?>
												<input type="checkbox" name="check_g4" value="1" <? if($money_g4_auto == "Y") echo "checked"; ?> onclick="check_ge_func(this,'g4')" > <?=$money_g4_txt?>
												<input type="checkbox" name="check_g5" value="1" <? if($money_g5_auto == "Y") echo "checked"; ?> onclick="check_ge_func(this,'g5')" > <?=$money_g5_txt?>
											</td>
										</tr>
										<tr>
											<td class="tdrowk_center" width="120">��Ÿ����(�����)</td>
											<td class="tdrow">
												<input type="checkbox" name="check_e1" value="1" <? if($money_e1_auto == "Y") echo "checked"; ?> onclick="check_ge_func(this,'e1')" > <?=$money_e1_txt?>
												<input type="checkbox" name="check_e2" value="1" <? if($money_e2_auto == "Y") echo "checked"; ?> onclick="check_ge_func(this,'e2')" > <?=$money_e2_txt?>
												<input type="checkbox" name="check_e3" value="1" <? if($money_e3_auto == "Y") echo "checked"; ?> onclick="check_ge_func(this,'e3')" > <?=$money_e3_txt?>
												<input type="checkbox" name="check_e4" value="1" <? if($money_e4_auto == "Y") echo "checked"; ?> onclick="check_ge_func(this,'e4')" > <?=$money_e4_txt?>
										</tr>
										<tr>
											<td class="tdrowk_center" width="120">��Ÿ����(����)</td>
											<td class="tdrow">
												<input type="checkbox" name="check_e5" value="1" <? if($money_e5_auto == "Y") echo "checked"; ?> onclick="check_ge_func(this,'e5')" > <?=$money_e5_txt?>
												<input type="checkbox" name="check_e6" value="1" <? if($money_e6_auto == "Y") echo "checked"; ?> onclick="check_ge_func(this,'e6')" > <?=$money_e6_txt?>
												<input type="checkbox" name="check_e7" value="1" <? if($money_e7_auto == "Y") echo "checked"; ?> onclick="check_ge_func(this,'e7')" > <?=$money_e7_txt?>
												<input type="checkbox" name="check_e8" value="1" <? if($money_e8_auto == "Y") echo "checked"; ?> onclick="check_ge_func(this,'e8')" > <?=$money_e8_txt?>
												<input type="checkbox" name="check_e9" value="1" <? if($money_e9_auto == "Y") echo "checked"; ?> onclick="check_ge_func(this,'e9')" > <?=$money_e9_txt?>
											</td>
										</tr>
									</table>

								</div>

								<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed;margin-top:10px">
									<tr>
										<td style="text-align:center">
											<a href="javascript:pay_code_input()"><img src="images/btn_enter_big.png" border="0"></a>
										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px;line-height:0px;"></div>

								<table width="100%" border=0 cellspacing=0 cellpadding=0>
									<tr>     
										<td height="10">

										</td>
									</tr>
									<tr><td height=1 bgcolor=e0e0de></td></tr>
									<tr><td height=2 bgcolor=f5f5f5></td></tr>
									<tr><td height=5></td></tr>
								</table>
								<!--�Ǹ޴� -->
								<table border=0 cellspacing=0 cellpadding=0> 
									<tr> 
										<td>
<?
//�������
echo $staff_info;
?>
										</td>
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bgtr_tab"></div>
								<div style="height:10px;font-size:0px"></div>

								<div id="pay_base3" style="<? if(!$row4[money_month_base])	echo "display:none;"; ?>">
									<!--��޴� -->
									<table border=0 cellspacing=0 cellpadding=0> 
										<tr>
											<td id=""> 
												<table border=0 cellpadding=0 cellspacing=0> 
													<tr> 
														<td><img src="images/g_tab_on_lt.gif"></td> 
														<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
														����ӱ�
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
									//��å���� ������ ���� �� 0
									//if($position_pay == "") $position_pay = 0;
									//echo $row4[money_g1];
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
/*
									$money_g6 = number_format($row4[money_g6]);
									$money_g7 = number_format($row4[money_g7]);
									$money_g8 = number_format($row4[money_g8]);
									if($money_g6 == "") $money_g6 = 0;
									if($money_g7 == "") $money_g7 = 0;
									if($money_g8 == "") $money_g8 = 0;
*/
									?>
									<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
										<tr>
											<td class="tdrowk_center" id="money_g1_tdk" <? if($money_g1_auto != "Y") echo "style='display:none'"; ?> ><?=$money_g1_txt?></td>
											<td class="tdrow_center"  id="money_g1_td"  <? if($money_g1_auto != "Y") echo "style='display:none'"; ?> ><input name="money_g1" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="<?=$money_g1?>" maxlength="10" onblur="setWorkHour();" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"> ��</td>
											<td class="tdrowk_center" id="money_g2_tdk" <? if($money_g2_auto != "Y") echo "style='display:none'"; ?> ><?=$money_g2_txt?></td>
											<td class="tdrow_center"  id="money_g2_td"  <? if($money_g2_auto != "Y") echo "style='display:none'"; ?> ><input name="money_g2" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="<?=$money_g2?>" maxlength="10" onblur="setWorkHour();" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"> ��</td>
											<td class="tdrowk_center" id="money_g3_tdk" <? if($money_g3_auto != "Y") echo "style='display:none'"; ?> ><?=$money_g3_txt?></td>
											<td class="tdrow_center"  id="money_g3_td"  <? if($money_g3_auto != "Y") echo "style='display:none'"; ?> ><input name="money_g3" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="<?=$money_g3?>" maxlength="10" onblur="setWorkHour();" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"> ��</td>
											<td class="tdrowk_center" id="money_g4_tdk" <? if($money_g4_auto != "Y") echo "style='display:none'"; ?> ><?=$money_g4_txt?></td>
											<td class="tdrow_center"  id="money_g4_td"  <? if($money_g4_auto != "Y") echo "style='display:none'"; ?> ><input name="money_g4" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="<?=$money_g4?>" maxlength="10" onblur="setWorkHour();" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"> ��</td>
											<td class="tdrowk_center" id="money_g5_tdk" <? if($money_g5_auto != "Y") echo "style='display:none'"; ?> ><?=$money_g5_txt?></td>
											<td class="tdrow_center"  id="money_g5_td"  <? if($money_g5_auto != "Y") echo "style='display:none'"; ?> ><input name="money_g5" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="<?=$money_g5?>" maxlength="10" onblur="setWorkHour();" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"> ��</td>
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
									$money_e1 = number_format((int)$row4[money_e1]);
									$money_e2 = number_format((int)$row4[money_e2]);
									$money_e3 = number_format((int)$row4[money_e3]);
									$money_e4 = number_format((int)$row4[money_e4]);
									//echo $money_e4;
									$money_e5 = number_format((int)$row4[money_e5]);
									$money_e6 = number_format((int)$row4[money_e6]);
									$money_e7 = number_format((int)$row4[money_e7]);
									$money_e8 = number_format((int)$row4[money_e8]);
									$money_e9 = number_format((int)$row4[money_e9]);
									if($money_e1 == "") $money_e1 = 0;
									if($money_e2 == "") $money_e2 = 0;
									if($money_e3 == "") $money_e3 = 0;
									if($money_e4 == "") $money_e4 = 0;
									if($money_e5 == "") $money_e5 = 0;
									if($money_e6 == "") $money_e6 = 0;
									if($money_e7 == "") $money_e7 = 0;
									if($money_e8 == "") $money_e8 = 0;
									if($money_e9 == "") $money_e9 = 0;
									?>
									<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
										<tr>
											<td class="tdrow_center" width="60" colspan="2">(�����)</td>
											<td class="tdrowk_center" id="money_e1_tdk" <? if($money_e1_auto != "Y") echo "style='display:none'"; ?> ><?=$money_e1_txt?><input name="money_e1_gy" type="hidden" value="<?=$money_e1_gy?>"></td>
											<td class="tdrow_center"  id="money_e1_td"  <? if($money_e1_auto != "Y") echo "style='display:none'"; ?> ><input name="money_e1" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="<?=$money_e1?>" maxlength="10" onblur="setWorkHour();" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"> ��</td>
											<td class="tdrowk_center" id="money_e2_tdk" <? if($money_e2_auto != "Y") echo "style='display:none'"; ?> ><?=$money_e2_txt?><input name="money_e2_gy" type="hidden" value="<?=$money_e2_gy?>"></td>
											<td class="tdrow_center"  id="money_e2_td"  <? if($money_e2_auto != "Y") echo "style='display:none'"; ?> ><input name="money_e2" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="<?=$money_e2?>" maxlength="10" onblur="setWorkHour();" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"> ��</td>
											<td class="tdrowk_center" id="money_e3_tdk" <? if($money_e3_auto != "Y") echo "style='display:none'"; ?> ><?=$money_e3_txt?><input name="money_e3_gy" type="hidden" value="<?=$money_e3_gy?>"></td>
											<td class="tdrow_center"  id="money_e3_td"  <? if($money_e3_auto != "Y") echo "style='display:none'"; ?> ><input name="money_e3" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="<?=$money_e3?>" maxlength="10" onblur="setWorkHour();" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"> ��</td>
											<td class="tdrowk_center" id="money_e4_tdk" <? if($money_e4_auto != "Y") echo "style='display:none'"; ?> ><?=$money_e4_txt?><input name="money_e4_gy" type="hidden" value="<?=$money_e4_gy?>"></td>
											<td class="tdrow_center"  id="money_e4_td"  <? if($money_e4_auto != "Y") echo "style='display:none'"; ?> ><input name="money_e4" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="<?=$money_e4?>" maxlength="10" onblur="setWorkHour();" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"> ��</td>
										</tr>
									</table>
									<div style="height:4px;font-size:0px;line-height:0px;"></div>
									<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
										<tr>
											<td class="tdrow_center" width="60" colspan="2">(����)</td>
											<td class="tdrowk_center" id="money_e5_tdk" <? if($money_e5_auto != "Y") echo "style='display:none'"; ?> ><?=$money_e5_txt?><input name="money_e5_gy" type="hidden" value="<?=$money_e5_gy?>"></td>
											<td class="tdrow_center"  id="money_e5_td"  <? if($money_e5_auto != "Y") echo "style='display:none'"; ?> ><input name="money_e5" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="<?=$money_e5?>" maxlength="10" onblur="setWorkHour();" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"> ��</td>
											<td class="tdrowk_center" id="money_e6_tdk" <? if($money_e6_auto != "Y") echo "style='display:none'"; ?> ><?=$money_e6_txt?><input name="money_e6_gy" type="hidden" value="<?=$money_e6_gy?>"></td>
											<td class="tdrow_center"  id="money_e6_td"  <? if($money_e6_auto != "Y") echo "style='display:none'"; ?> ><input name="money_e6" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="<?=$money_e6?>" maxlength="10" onblur="setWorkHour();" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"> ��</td>
											<td class="tdrowk_center" id="money_e7_tdk" <? if($money_e7_auto != "Y") echo "style='display:none'"; ?> ><?=$money_e7_txt?><input name="money_e7_gy" type="hidden" value="<?=$money_e7_gy?>"></td>
											<td class="tdrow_center"  id="money_e7_td"  <? if($money_e7_auto != "Y") echo "style='display:none'"; ?> ><input name="money_e7" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="<?=$money_e7?>" maxlength="10" onblur="setWorkHour();" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"> ��</td>
											<td class="tdrowk_center" id="money_e8_tdk" <? if($money_e8_auto != "Y") echo "style='display:none'"; ?> ><?=$money_e8_txt?><input name="money_e8_gy" type="hidden" value="<?=$money_e8_gy?>"></td>
											<td class="tdrow_center"  id="money_e8_td"  <? if($money_e8_auto != "Y") echo "style='display:none'"; ?> ><input name="money_e8" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="<?=$money_e8?>" maxlength="10" onblur="setWorkHour();" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"> ��</td>
											<td class="tdrowk_center" id="money_e9_tdk" <? if($money_e9_auto != "Y") echo "style='display:none'"; ?> ><?=$money_e9_txt?><input name="money_e9_gy" type="hidden" value="<?=$money_e9_gy?>"></td>
											<td class="tdrow_center"  id="money_e9_td"  <? if($money_e9_auto != "Y") echo "style='display:none'"; ?> ><input name="money_e9" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="<?=$money_e9?>" maxlength="10" onblur="setWorkHour();" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"> ��</td>
										</tr>
									</table>
									<div style="height:10px;font-size:0px;line-height:0px;"></div>

									<!--��޴� -->
									<table border=0 cellspacing=0 cellpadding=0>
										<tr>
											<td id="" valign="bottom"> 
												<table border=0 cellpadding=0 cellspacing=0> 
													<tr> 
														<td><img src="images/g_tab_on_lt.gif"></td> 
														<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
														��������
														</td> 
														<td><img src="images/g_tab_on_rt.gif"></td> 
													</tr> 
												</table> 
											</td> 
											<td valign="bottom" style="padding:0 0 0 10px"><input type="checkbox" name="check_money_b_yn" id="check_money_b_yn" value="Y" <? if($row4[check_money_b_yn] == "Y") echo "checked"; ?> onClick="checkMoney_bYn()"  style="vertical-align:middle;" />����</td> 
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
											<td class="tdrowk_center">����ٷ�</td>
											<td class="tdrow_center"><input name="money_b1" type="text" class="<?=$b_class?>" <?=$b_readonly?> style="width:60px;ime-mode:disabled;" value="<?=number_format($row4[money_b1])?>" maxlength="10" onblur="setWorkHour();" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"> ��</td>
											<td class="tdrowk_center">�߰��ٷ�</td>
											<td class="tdrow_center"><input name="money_b2" type="text" class="<?=$b_class?>" <?=$b_readonly?> style="width:60px;ime-mode:disabled;" value="<?=number_format($row4[money_b2])?>" maxlength="10" onblur="setWorkHour();" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"> ��</td>
											<td class="tdrowk_center">���ϱٷ�</td>
											<td class="tdrow_center"><input name="money_b3" type="text" class="<?=$b_class?>" <?=$b_readonly?> style="width:60px;ime-mode:disabled;" value="<?=number_format($row4[money_b3])?>" maxlength="10" onblur="setWorkHour();" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"> ��</td>
											<td class="tdrowk_center">��������</td>
											<td class="tdrow_center"><input name="money_b4" type="text" class="textfm" style="width:60px;ime-mode:disabled;" value="<?=number_format($money_b4)?>" maxlength="10" onblur="setWorkHour();" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"> ��</td>
											<td class="tdrowk_center">��������</td>
											<td class="tdrow_center"><input name="money_b5" type="text" class="textfm" style="width:60px;ime-mode:disabled;" value="<?=number_format($money_b5)?>" maxlength="10" onblur="setWorkHour();" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"></td>
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
											<td class="tdrowk_center">�� ��Ÿ���� �հ�</td>
											<td class="tdrow" valign="top">
												<input name="money_e_sum" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="0" maxlength="10" readonly> ��
											</td>
											<td class="tdrowk_center">�� �������� �հ�</td>
											<td class="tdrow" valign="top">
												<input name="money_b_sum" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="0" maxlength="10" readonly> ��
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
												<input name="money_total_sum" type="text" class="textfm5" style="width:70px;ime-mode:disabled;" value="0" maxlength="10" readonly> ��
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
									<input name="money_month_base_view" type="hidden" class="textfm5" style="width:70px;ime-mode:disabled;" value="<?=$pay_year?>" maxlength="10" onblur="setWorkHour();" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')">
									<input name="money_year_yn" type="hidden" value="N">
									<input name="workhour_year" type="hidden" value="<?=$workhour_year?>">
									<input name="money_year" type="hidden" value="<?=$money_year?>">
									<input name="money_period" type="hidden" value="<?=$money_period?>">
									<input name="money_month" type="hidden" value="<?=$pay_year?>">
									<input name="money_base" type="hidden" value="">

									<div style="height:10px;font-size:0px;line-height:0px;"></div>
									<div style="height:1px;font-size:0px" class="bgtr"></div>
								</div>
								<div id="div_insure_pay">
									<div style="height:10px;font-size:0px;line-height:0px;"></div>
									<!--��޴� -->
									<table border=0 cellspacing=0 cellpadding=0>
										<tr>
											<td id="" valign="bottom"> 
												<table border=0 cellpadding=0 cellspacing=0> 
													<tr> 
														<td><img src="images/g_tab_on_lt.gif"></td> 
														<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
														����սŰ�ݾ�
														</td> 
														<td><img src="images/g_tab_on_rt.gif"></td> 
													</tr> 
												</table> 
											</td> 
											<td valign="bottom" style="padding:0 0 0 10px"></td> 
										</tr> 
									</table>
									<div style="height:2px;font-size:0px" class="bgtr"></div>
									<div style="height:2px;font-size:0px;line-height:0px;"></div>
									<?
									$insure_class = "textfm";
									$insure_readonly = "";
									?>
									<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
										<tr>
											<td class="tdrowk_center">���ο���</td>
											<td class="tdrow_center"><input name="pay_yun"    type="text" class="<?=$insure_class?>" <?=$insure_readonly?> style="width:70px;ime-mode:disabled;" value="<?=number_format($row4['pay_yun'])?>" maxlength="10" onblur="setWorkHour();" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"> ��</td>
											<td class="tdrowk_center">�ǰ�����</td>
											<td class="tdrow_center"><input name="pay_health" type="text" class="<?=$insure_class?>" <?=$insure_readonly?> style="width:70px;ime-mode:disabled;" value="<?=number_format($row4['pay_health'])?>" maxlength="10" onblur="setWorkHour();" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"> ��</td>
											<td class="tdrowk_center">��뺸��</td>
											<td class="tdrow_center"><input name="pay_goyong" type="text" class="<?=$insure_class?>" <?=$insure_readonly?> style="width:70px;ime-mode:disabled;" value="<?=number_format($row4['pay_goyong'])?>" maxlength="10" onblur="setWorkHour();" onkeypress="only_number();" onkeyup="checkThousand(this.value, this,'Y')"> ��</td>
										</tr>
									</table>
									<div style="height:10px;font-size:0px;line-height:0px;"></div>
									<div style="height:1px;font-size:0px" class="bgtr"></div>
								</div>
								</div><!--��¿��� ����-->
<?
//���Ѻ� ��ũ��
//echo $member[mb_profile];
if($member['mb_profile'] == "guest") {
	$url_save = "javascript:alert_demo();";
	$url_form = "javascript:alert_demo();";
} else {
	$url_save = "javascript:checkData();";
	$url_form = "./work_contract.php?id=$id&code=$code&page=$page";
}
$url_info = "./staff_view.php?w=u&id=$id&code=$code&page=$page";
//ȭ��������κθ�ȸ : Ȱ��������, ����
if($comp_print_type == "H") {
	if($row2['position'] == "13" || $kind == "beistand") {
		$url_list = "staff_pay_beistand.php?page=".$page;
	} else if($row2['position'] == "14" || $kind == "helper") {
		$url_list = "staff_pay_helper.php?page=".$page;
	} else {
		$url_list = "staff_pay.php?page=".$page;
	}
} else {
	$url_list = "staff_pay.php?page=".$page;
}
?>
								<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed;margin-top:20px">
									<tr>
										<td style="text-align:center">
											<a href="javascript:total_cal();"><img src="images/btn_lastcal_big.png" border="0"></a>
											<a href="<?=$url_save?>"><img src="images/btn_save_big.png" border="0"></a>
											<a href="<?=$url_info?>"><img src="images/btn_staff_info_big.png" border="0"></a>
											<a href="javascript:pagePrint(document.getElementById('print_page'))" target=""><img src="images/btn_print_big.png" border="0"></a>
											<a href="<?=$url_list?>"><img src="images/btn_list_big.png" border="0"></a>
										</td>
									</tr>
								</table>
								<input type="hidden" name="error_code" style="width:100%" value="">
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

function total_cal() {
	setWorkHour();setWorkHour();setWorkHour();setWorkHour();setWorkHour();setWorkHour();setWorkHour();setWorkHour();setWorkHour();setWorkHour();setWorkHour();setWorkHour();setWorkHour();setWorkHour();setWorkHour();setWorkHour();
}
//�ñ���
function setWorkHour_Parttime( type, money_min_time ){
	if(document.formSalary.check_money_min_2015_yn.checked) {
		money_min_time = <?=$money_min_time_2015?>;
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
	var money_e_sum, money_e1, money_e2, money_e3, money_e4, money_e5, money_e6, money_e7, money_e8, money_e9;
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
	money_e9 = toInt(f.money_e9.value); // ���������9

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
	if(f.money_e9_gy.value != "Y") {
		money_e9 = 0;
	}
	//��Ÿ���� �հ�
	money_e_sum = money_e1 + money_e2 + money_e3 + money_e4 + money_e5 + money_e6 + money_e7 + money_e8 + money_e9;

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
		workhour_day_w = toFloat(f.workhour_day_w.value);
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

		workhour_day_w = toFloat(f.workhour_day_w.value);
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
	//workhour_total = parseInt( ( workhour_day + workhour_ext + workhour_hday ) * 1000 ) / 1000; // �߰��ٷμ��� ���� -----------
	//workhour_total_w = parseInt( ( workhour_day_w + workhour_ext_w + workhour_hday_w + workhour_night_w ) * 1000 ) / 1000;
	workhour_total = parseInt( ( workhour_day + (workhour_ext*rate_ext) + (workhour_night*rate_night) + (workhour_hday*rate_hday) ) * 1000 ) / 1000; // �߰��ٷμ��� ���� -----------
	workhour_total_w = parseInt( ( workhour_day_w + workhour_ext_w*rate_ext + workhour_hday_w*rate_hday + workhour_night_w*rate_night ) * 1000 ) / 1000;

	//�ѱٷνð�(�ٷΰ�༭��)
	workhour_total2 = parseInt( ( workhour_day + workhour_ext + workhour_hday ) * 1000 ) / 1000;
	workhour_total2_w = parseInt( ( workhour_day_w + workhour_ext_w + workhour_hday_w ) * 1000 ) / 1000;

	//�ѱٷνð�(�ӱݻ����)
	workhour_total3 = parseInt( ( workhour_day + workhour_ext*rate_ext + workhour_hday*rate_hday + workhour_night*rate_night ) * 1000 ) / 1000;
	workhour_total3_w = parseInt( ( workhour_day_w + workhour_ext_w*rate_ext + workhour_hday_w*rate_hday + workhour_night_w*rate_night ) * 1000 ) / 1000;

	//����ӱ�(�ñ�)
	//money_min = toInt(f.money_min.value);
	money_min_time = toInt(f.money_hour.value);
	money_min = toInt(workhour_day * money_min_time);
	//alert(money_min);

	// ����ӱ�(�ð���) = ���ؽñ޾� + (������������ / 1���� �����ٷνð�)
	//alert(money_hour+"+(("+money_g1+"+"+money_g2+"+"+money_g3+")/"+workhour_day+")");
	money_hour_ts = money_hour + ( (money_g1+money_g2+money_g3) / workhour_day );
	//alert(money_hour_ts);
	if( isNaN(money_hour_ts) ) money_hour_ts = 0;
	if( money_hour_ts == Infinity ) money_hour_ts = 0;
	//alert(money_hour_ts);

	f.workhour_total.value = workhour_total;
	f.workhour_total_w.value = workhour_total_w;

	f.workhour_total2.value = workhour_total2;
	f.workhour_total2_w.value = workhour_total2_w;

	f.workhour_total3.value = workhour_total3;
	f.workhour_total3_w.value = workhour_total3_w;

	f.money_hour_ts.value = money_hour_ts;
	f.money_hour_ts_view.value = setComma( parseInt(money_hour_ts) );

	// �ּ��ӱ� ���رݾ�
	//�ñ��� �⺻�� ���� �Է� �߰� 14.02.26
	/*
	if(f.check_money_min_yn.value == "Y") {
		f.money_min.value = setComma( toInt(money_min) );
	} else {
		f.money_min.value = setComma( toInt(workhour_day_w * money_min_time) );
	}
	*/
	var money_base = 0; // �⺻��
	var money_ext = 0; // ����ٷμ���
	var money_hday = 0; // ���ϱٷμ���
	var money_night = 0; // �߰��ٷμ���
	money_base = Math.round( money_hour * workhour_day );
	//alert(money_hour_ts+"*"+rate_ext+"*"+workhour_ext);
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
//���ڸ� �Է� �����ϵ��� ó��
jQuery.fn.extend({
    numberOnly : function() {
        return this.each(function() {
            try {
                var $this = $(this);
                // FF patch : �ѱ��Է� ���¿��� keydown �Է� ������ �Ȱɸ��� ������ �־� �ѱ� �Է� �Ұ����ϵ��� ����
                $this.css('ime-mode', 'disabled');
                // ����,�޸�,backspace,enter key�� �Է� �����ϵ��� ����
                $this.keydown(function(p_event) {
                    var l_before_length = $this.val().length;
                    var l_keycode = p_event.keyCode;
                    var l_str     = l_keycode > 57 ? String.fromCharCode(l_keycode-48) : String.fromCharCode(l_keycode);
                    var l_pattern = /^[0-9]+$/;
                    // back-space, tab-key enter-key, delete-key, ��, ��, ��, ��, ��ǥ  �� �Է� �����ϵ��� ��
										//alert(l_keycode);
                    if(l_keycode == 8 || l_keycode == 9 || l_keycode == 13 || l_keycode == 46 || l_keycode == 37 || l_keycode == 38 || l_keycode == 39 || l_keycode == 40 || l_keycode == 188) {
                        return true;
                    }
                    // ���ڸ� �Է� �����ϵ��� ��
                    var l_after_length = $this.val().length;
                    if(!l_pattern.test(l_str)) {
                        if(l_before_length != l_after_length) {
                            $this.val($this.val().substring(0, l_after_length - 1));
                        }
                        return false;
                    } else {
                        return true;
                    }
                });
                // ��Ŀ���� ����� �� ó�� - number format�� ���� �޸��� ��� �����Ѵ�.
                $this.focus(function() {
                    $this.val($this.val().replace(/,/g, ''));
                });
            } catch(e) {
                alert("[jsutil.js's numberFormat] " + e.description);
            }
        });
    }
});
//���ڸ� �Է� ���� input id ���� : �����ӱ�, ���ؽñ�
$(function() {
	$('#money_month_base').numberOnly();
	$('#money_hour').numberOnly();
});
//���
function pagePrint(Obj) {  
  var W = Obj.offsetWidth + 40;        //screen.availWidth;  
  var H = Obj.offsetHeight + 50;       //screen.availHeight; 
 
  var features = "menubar=no,toolbar=no,location=no,directories=no,status=no,scrollbars=yes,resizable=yes,width=" + W + ",height=" + H + ",left=0,top=0";  
  var PrintPage = window.open("about:blank",Obj.id,features);  
 
	var iepage_script = "<style type='text/css'>\n@media print{ \n#noPrint1{display: none;} \n} \n</style> \n<script language='javascript' type='text/javascript'> \nfunction Installed() \n{ \ntry \n{ \nreturn (new ActiveXObject('IEPageSetupX.IEPageSetup')); \n} \ncatch (e) \n{ \nreturn false; \n} \n} \nfunction PrintTest() \n{ \nif (!Installed()) \nalert('��Ʈ���� ��ġ���� �ʾҽ��ϴ�. ���������� �μ���� ���� �� �ֽ��ϴ�.') \nelse \nalert('���������� ��ġ�Ǿ����ϴ�.'); \n} \nfunction printsetup()\n{ \nIEPageSetupX.header = '';\nIEPageSetupX.footer = '';\nIEPageSetupX.leftMargin = 10;\nIEPageSetupX.rightMargin = 10;\nIEPageSetupX.topMargin = 20;\nIEPageSetupX.bottomMargin = 10;\nIEPageSetupX.PrintBackground = true;\nIEPageSetupX.Orientation = 1;\nIEPageSetupX.PaperSize = 'A4';\n</sc"+"ript>";
	var iepage_object = "<script language='JavaScript' for='IEPageSetupX' event='OnError(ErrCode, ErrMsg)'>\nalert('���� �ڵ�: ' + ErrCode + '\n���� �޽���: ' + ErrMsg);\n</sc"+"ript>\n<object id=IEPageSetupX classid='clsid:41C5BC45-1BE8-42C5-AD9F-495D6C8D7586' codebase='/IEPageSetupX/IEPageSetupX.cab#version=1,4,0,3' width=0 height=0>\n<param name='copyright' value='http://isulnara.com'>\n<div style='position:absolute;top:276;left:320;width:300;height:68;border:solid 1 #99B3A0;background:#D8D7C4;overflow:hidden;z-index:1;visibility:visible;'><FONT style='font-family: '����', 'Verdana'; font-size: 9pt; font-style: normal;'>\n<BR>  �μ� �������� ��Ʈ���� ��ġ���� �ʾҽ��ϴ�.  <BR>  <a href='/IEPageSetupX/IEPageSetupX.exe'><font color=red>�̰�</font></a>�� Ŭ���Ͽ� �������� ��ġ�Ͻñ� �ٶ��ϴ�.  </FONT>\n</div>\n</object>";

  PrintPage.document.open();  
  PrintPage.document.write("<html><head><title></title><link rel='stylesheet' type='text/css' href='css/style.css'>\n<link rel='stylesheet' type='text/css' href='css/style_admin.css'>\n</head>\n<body style='margin:0'>\n<div style='text-align:center;'>\n"+iepage_script+"\n"+iepage_object+"\n<div style='width:880px;margin:0 auto;'>\n" + Obj.innerHTML + "\n</div>\n</div>\n</body></html>");
  PrintPage.document.close();  
  PrintPage.document.title = document.domain;
	// ũ�⿡ �°� ���
	PrintPage.IEPageSetupX.ShrinkToFit = true;
	// ���� ����̹��� ���
	PrintPage.IEPageSetupX.PrintBackground = true;
	// �������
	PrintPage.IEPageSetupX.Orientation = 1;
	// �μ�̸�����
	PrintPage.IEPageSetupX.Preview();
  //PrintPage.print(PrintPage.location.reload());
}
</script>
</body>
</html>
