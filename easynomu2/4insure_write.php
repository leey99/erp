<?
$sub_menu = "100200";
include_once("./_common.php");

// ���� ���¸� �۵�
if($w == "u") {
	$result1=mysql_query("select * from $g4[insure_table] where id = $id");
	$row1=mysql_fetch_array($result1);

	// �⺻�� ǥ�� ����
	if($row1[join_date] == "0000-00-00 00:00:00") $row1[join_date] = "";
	// ��¥ ���� : �ð� ǥ�� ����
	if($row1[join_date_2] == "0000-00-00 00:00:00") $row1[join_date_2] = "";
	else $row1[join_date_2] = substr($row1[join_date_2], 0, 11);
	if($row1[join_date_3] == "0000-00-00 00:00:00") $row1[join_date_3] = "";
	else $row1[join_date_3] = substr($row1[join_date_3], 0, 11);
	if($row1[join_date_4] == "0000-00-00 00:00:00") $row1[join_date_4] = "";
	else $row1[join_date_4] = substr($row1[join_date_4], 0, 11);
	if($row1[join_date_5] == "0000-00-00 00:00:00") $row1[join_date_5] = "";
	else $row1[join_date_5] = substr($row1[join_date_5], 0, 11);
	if($row1[join_time] == "0") $row1[join_time] = "";
	else $row1[join_time] = number_format($row1[join_time]);
	if($row1[join_time_2] == "0") $row1[join_time_2] = "";
	else $row1[join_time_2] = number_format($row1[join_time_2]);
	if($row1[join_time_3] == "0") $row1[join_time_3] = "";
	else $row1[join_time_3] = number_format($row1[join_time_3]);
	if($row1[join_time_4] == "0") $row1[join_time_4] = "";
	else $row1[join_time_4] = number_format($row1[join_time_4]);
	if($row1[join_time_5] == "0") $row1[join_time_5] = "";
	else $row1[join_time_5] = number_format($row1[join_time_5]);
	if($row1[join_salary] == "0") $row1[join_salary] = "";
	else $row1[join_salary] = number_format($row1[join_salary]);
	if($row1[join_salary_2] == "0") $row1[join_salary_2] = "";
	else $row1[join_salary_2] = number_format($row1[join_salary_2]);
	if($row1[join_salary_3] == "0") $row1[join_salary_3] = "";
	else $row1[join_salary_3] = number_format($row1[join_salary_3]);
	if($row1[join_salary_4] == "0") $row1[join_salary_4] = "";
	else $row1[join_salary_4] = number_format($row1[join_salary_4]);
	if($row1[join_salary_5] == "0") $row1[join_salary_5] = "";
	else $row1[join_salary_5] = number_format($row1[join_salary_5]);
	if($row1[quit_date] == "0000-00-00 00:00:00") $row1[quit_date] = "";
	if($row1[quit_date_2] == "0000-00-00 00:00:00") $row1[quit_date_2] = "";
	if($row1[quit_date_3] == "0000-00-00 00:00:00") $row1[quit_date_3] = "";
	if($row1[quit_date_4] == "0000-00-00 00:00:00") $row1[quit_date_4] = "";
	if($row1[quit_date_5] == "0000-00-00 00:00:00") $row1[quit_date_5] = "";
	if($row1[quit_sum_now] == "0") $row1[quit_sum_now] = "";
	else $row1[quit_sum_now] = number_format($row1[quit_sum_now]);
	if($row1[quit_sum_now_2] == "0") $row1[quit_sum_now_2] = "";
	else $row1[quit_sum_now_2] = number_format($row1[quit_sum_now_2]);
	if($row1[quit_sum_now_3] == "0") $row1[quit_sum_now_3] = "";
	else $row1[quit_sum_now_3] = number_format($row1[quit_sum_now_3]);
	if($row1[quit_sum_now_4] == "0") $row1[quit_sum_now_4] = "";
	else $row1[quit_sum_now_4] = number_format($row1[quit_sum_now_4]);
	if($row1[quit_sum_now_5] == "0") $row1[quit_sum_now_5] = "";
	else $row1[quit_sum_now_5] = number_format($row1[quit_sum_now_5]);
	if($row1[quit_sum_now_month] == "0") $row1[quit_sum_now_month] = "";
	if($row1[quit_sum_now_month_2] == "0") $row1[quit_sum_now_month_2] = "";
	if($row1[quit_sum_now_month_3] == "0") $row1[quit_sum_now_month_3] = "";
	if($row1[quit_sum_now_month_4] == "0") $row1[quit_sum_now_month_4] = "";
	if($row1[quit_sum_now_month_5] == "0") $row1[quit_sum_now_month_5] = "";
	if($row1[quit_sum_pre] == "0") $row1[quit_sum_pre] = "";
	else $row1[quit_sum_pre] = number_format($row1[quit_sum_pre]);
	if($row1[quit_sum_pre_2] == "0") $row1[quit_sum_pre_2] = "";
	else $row1[quit_sum_pre_2] = number_format($row1[quit_sum_pre_2]);
	if($row1[quit_sum_pre_3] == "0") $row1[quit_sum_pre_3] = "";
	else $row1[quit_sum_pre_3] = number_format($row1[quit_sum_pre_3]);
	if($row1[quit_sum_pre_4] == "0") $row1[quit_sum_pre_4] = "";
	else $row1[quit_sum_pre_4] = number_format($row1[quit_sum_pre_4]);
	if($row1[quit_sum_pre_5] == "0") $row1[quit_sum_pre_5] = "";
	else $row1[quit_sum_pre_5] = number_format($row1[quit_sum_pre_5]);
	if($row1[quit_sum_pre_month] == "0") $row1[quit_sum_pre_month] = "";
	if($row1[quit_sum_pre_month_2] == "0") $row1[quit_sum_pre_month_2] = "";
	if($row1[quit_sum_pre_month_3] == "0") $row1[quit_sum_pre_month_3] = "";
	if($row1[quit_sum_pre_month_4] == "0") $row1[quit_sum_pre_month_4] = "";
	if($row1[quit_sum_pre_month_5] == "0") $row1[quit_sum_pre_month_5] = "";
	if($row1[quit_3month] == "0") $row1[quit_3month] = "";
	else $row1[quit_3month] = number_format($row1[quit_3month]);
	if($row1[quit_3month_2] == "0") $row1[quit_3month_2] = "";
	else $row1[quit_3month_2] = number_format($row1[quit_3month_2]);
	if($row1[quit_3month_3] == "0") $row1[quit_3month_3] = "";
	else $row1[quit_3month_3] = number_format($row1[quit_3month_3]);
	if($row1[quit_3month_4] == "0") $row1[quit_3month_4] = "";
	else $row1[quit_3month_4] = number_format($row1[quit_3month_4]);
	if($row1[quit_3month_5] == "0") $row1[quit_3month_5] = "";
	else $row1[quit_3month_5] = number_format($row1[quit_3month_5]);
}

// �α��� �� ��������� �α���
if(!$row1[comp_name]) {
	$sql_a4 = " select * from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
	$row_a4 = sql_fetch($sql_a4);
	$com_code = $row_a4[com_code];
	$row1[comp_name] = $row_a4[com_name];
	$row1[comp_adr]  = $row_a4[com_juso]." ".$row_a4[com_juso2];
	$row1[comp_bznb] = $row_a4[t_insureno];
	$row1['t_no'] = $row_a4['t_no'];
	$row1[comp_tel]  = $row_a4[com_tel];
	$row1[comp_email]  = $row_a4[com_mail];
	$row1[comp_fax]  = $row_a4[com_fax];
	$row1['memo'] = $row_a4['memo'];
}
//�����
$quit_date = substr($row1[quit_date], 0, 11);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title>4�뺸�� ���/��� �Ű� : <?=$member['mb_nick']?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px">
<script language="javascript">
function checkData() {
	var frm = document.dataForm;
	if (frm.comp_name.value == "")
	{
		alert("������Ī�� �Է��ϼ���.");
		frm.comp_name.focus();
		return;
	}
	if (frm.comp_adr.value == "")
	{
		alert("������������ �Է��ϼ���.");
		frm.comp_adr.focus();
		return;
	}
	if (frm.comp_bznb.value == "")
	{
		alert("����ڵ�Ϲ�ȣ�� �Է��ϼ���.");
		frm.comp_bznb.focus();
		return;
	}
	if (frm.comp_tel.value == "")
	{
		alert("��ȭ��ȣ(�����)�� �Է��ϼ���.");
		frm.comp_tel.focus();
		return;
	}
	if(frm.comp_tno.value == "") {
		alert("����������ȣ�� �Է��ϼ���.");
		frm.comp_tno.focus();
		return;
	}
	if(frm.comp_email.value == "") {
		alert("�̸��ϸ� �Է��ϼ���.");
		frm.comp_email.focus();
		return;
	}
	//�Ի��� �Է°� Ȯ��
	if(frm.join_ok.checked) {

		if (frm.join_name.value == "")
		{
			alert("����(�Ի���)�� �Է��ϼ���.");
			frm.join_name.focus();
			return;
		}
		if (frm.join_ssnb.value == "")
		{
			alert("�ֹε�Ϲ�ȣ(�Ի���)�� �Է��ϼ���.");
			frm.join_ssnb.focus();
			return;
		}
		if (frm.join_date.value == "")
		{
			alert("�Ի����� �Է��ϼ���.");
			frm.join_date.focus();
			return;
		}
		if (frm.join_jikjong.value == "")
		{
			alert("������ �Է��ϼ���.");
			frm.join_jikjong.focus();
			return;
		}
		if (frm.join_time.value == "")
		{
			alert("�ּ����ٷνð��� �Է��ϼ���.");
			frm.join_time.focus();
			return;
		}
		if (frm.join_salary.value == "")
		{
			alert("���ӱ��� �Է��ϼ���.");
			frm.join_salary.focus();
			return;
		}
		//alert(frm.isgy.checked);
		if (!frm.isgy.checked && !frm.issj.checked && !frm.iskm.checked && !frm.isgg.checked)
		{
			alert("�������뿩�θ� ������ �ּ���.");
			frm.isgy.focus();
			return;
		}
		if(radio_chk(frm.contract_worker, "����� ���θ�") == 0) {
			frm.contract_worker[0].focus();
			return;
		}
		if(frm.contract_worker[0].checked) {
			if(frm.contract_end_date.value == "") {
				alert("����������� �Է��ϼ���.");
				frm.contract_end_date.focus();
				return;
			}
		}
	}

	if(frm.quit_ok.checked) {
		if (frm.quit_name.value == "")
		{
			alert("����(�����)�� �Է��ϼ���.");
			frm.quit_name.focus();
			return;
		}
		if (frm.quit_ssnb.value == "")
		{
			alert("�ֹε�Ϲ�ȣ(�����)�� �Է��ϼ���.");
			frm.quit_ssnb.focus();
			return;
		}
		if (frm.quit_tel.value == "")
		{
			alert("��ȭ��ȣ(�����)�� �Է��ϼ���.");
			frm.quit_tel.focus();
			return;
		}
		if (frm.quit_date.value == "")
		{
			alert("������� �Է��ϼ���.");
			frm.quit_date.focus();
			return;
		}
		if (frm.quit_cause.value == "")
		{
			alert("���������� �Է��ϼ���.");
			frm.quit_cause.focus();
			return;
		}
		if (frm.quit_sum_now.value == "")
		{
			alert("�ش翬���ӱ��Ѿ��� �Է��ϼ���.");
			frm.quit_sum_now.focus();
			return;
		}
		if (frm.quit_sum_now_month.value == "")
		{
			alert("�ش翬���ӱ��Ѿ� ���������� �Է��ϼ���.");
			frm.quit_sum_now_month.focus();
			return;
		}
	}
	frm.action = "4insure_update.php";
	frm.submit();
	return;
}
//������ư üũ �Լ�
function radio_chk(x,t) {
	var count=0;
	for(i=0;i<x.length;i++) {
		if(x[i].checked){
			count += 1;
			radio_name_val = x[i].value; 
		}
	}
	if(count == 0){
		alert(t+" ������ �ּ���.");
		return rv = 0;
	}else{
		//alert(radio_name_val);
		return rv = 1;
	}
}
function join_ok_func() {
	var frm = document.dataForm;
	if(!frm.join_ok.checked) frm.join_ok.checked = true;
}
function quit_ok_func() {
	var frm = document.dataForm;
	if(!frm.quit_ok.checked) frm.quit_ok.checked = true;
}
//===============================================
// event.shiftKey : Ű�ڵ尪
// event.shiftKey, event.altKey, event.ctrlKey : boolean
// event.srcElement : �̺�Ʈ�� �߻��� ��ü
// 8: BackSpace, 46: Del
// ","=44, "-"=45, "."=46, "/"=47
// "0"=48, "9"=57
//"." = 190
// "@"=64, "A"=65, "Z"=90, "a"=97, "z"=122
// 37:LeftArrow, 38:UpArrow, 39:RightArrow, 40:DownArrow **
/** =============================================
Return : event.returnValue = boolean
Comment: Ű�Է½� ���ڸ� �Է� �ް� �Ѵ�.
Usage  : onKeyDown="fn_onKeyOnlyNumber();"
---------------------------------------------- */
function fn_onKeyOnlyNumber() {

}
function checkThousand(inputVal, type, keydown) {		// inputVal�� õ������ , ǥ�ø� ���� �������� ��
	main = document.dataForm;			// ���⼭ type �� �ش��ϴ� ���� �ֱ� ���� ��ġ���� index
	var chk		= 0;				// chk �� õ������ ���� ���̸� check
	var share	= 0;				// share 200,000 �� ���� 3�� ����� ���� �����ϱ� ���� ����
	var start	= 0;
	var triple	= 0;				// triple 3, 6, 9 �� 3�� ��� 
	var end		= 0;				// start, end substring ������ ���� ����  
	var total	= "";			
	var input	= "";				// total ���Ƿ� string ���� �����ϱ� ���� ����
	if (inputVal.length > 3){
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
		for(i=chk; i>0; i--){
			triple = i * 3;					// 3�� ��� ��� 9,6,3 ��� ���� ������
			end = Number(input.length)-Number(triple);	// �� ���� end ���� ���� �þ� ���� �ȴ�.
			total += input.substring(start,end)+",";	// total�� �տ��� ���� ���ʷ� ���δ�.
			start = end;					// end ���� �������� start ������ ����.
		}
		total +=input.substring(start,input.length);		// ���������� ������ 3�ڸ� ���� �ڿ� ������.
	} else {
		total = inputVal;					// 3�� ����� �Ǳ� �������� ���� �״�� �����ȴ�.
	}
	if(keydown =='Y'){
		if ( type =='1' ) {
			main.join_salary.value=total;					// type �� ���� �������� �־� �ش�.
		}
		if ( type =='2' ) {
			main.quit_sum_now.value=total;
		}
		if ( type =='3' ) {
			main.quit_3month.value=total;				
		}
		if ( type =='4' ) {
			main.quit_sum_pre.value=total;
		}
<?
$k = 0;
for($i=2; $i<=5; $i++) {
?>
		if ( type =='1<?=$i?>' ) {
			//alert(main.elements["join_salary_[]"][<?=$k?>].value);
			if(main.join_count.value == 3) {
				main.elements["join_salary_[]"].value=total;
			} else {
				main.elements["join_salary_[]"][<?=$k?>].value=total;
			}
		}
		if ( type =='2<?=$i?>' ) {
			if(main.quit_count.value == 3) {
				main.elements["quit_sum_now_[]"].value=total;
			} else {
				main.elements["quit_sum_now_[]"][<?=$k?>].value=total;
			}
		}
		if ( type =='3<?=$i?>' ) {
			if(main.quit_count.value == 3) {
				main.elements["quit_3month_[]"].value=total;
			} else {
				main.elements["quit_3month_[]"][<?=$k?>].value=total;
			}
		}
		if ( type =='4<?=$i?>' ) {
			if(main.quit_count.value == 3) {
				main.elements["quit_sum_pre_[]"].value=total;
			} else {
				main.elements["quit_sum_pre_[]"][<?=$k?>].value=total;
			}
		}
<?
	$k++;
}
?>
	}else if(keydown =='N'){
		return total
	}
	return total
}
function delCom(inputVal, count){
	var tmp = "";
	for(i=0; i<count; i++){
		if(inputVal.substring(i,i+1)!=','){		// ���� substring�� ����
			tmp += inputVal.substring(i,i+1);	// ���� ��� , �� ����
		}
	}
	return tmp;
}
function only_number() {
	if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;
}
function open_jikjong(n) {
	window.open("popup/jikjong_popup.php?n=_"+n, "jikjong_popup", "width=640, height=706, toolbar=no, menubar=no, scrollbars=no, resizable=no" );
}
function iframe_focus(rowNum,nhicRowNum) {
	//���Լ�
}
function value_set(n,m) {
	//���Լ�
}
function join_name_change(obj_text) {
	var frm = document.dataForm;
	//alert(obj_text);
	obj_value = obj_text.split("_");
	frm.join_code.value = obj_value[0];
	frm.join_name.value = obj_value[1];
	frm.join_ssnb.value = obj_value[2];
	frm.join_date.value = obj_value[3];
	frm.join_jikjong_code.value = obj_value[4];
	frm.join_jikjong.value = obj_value[5];
	frm.join_time.value = obj_value[6];
	frm.join_salary.value = obj_value[7];
	if(obj_value[8] == "0") frm.isgy.checked = true;
	else frm.isgy.checked = false;
	if(obj_value[9] == "0") frm.issj.checked = true;
	else frm.issj.checked = false;
	if(obj_value[10] == "0") frm.iskm.checked = true;
	else frm.iskm.checked = false;
	if(obj_value[11] == "0") frm.isgg.checked = true;
	else frm.isgg.checked = false;
	join_ok_func();
}
//�Ի��� �߰��� ���� ����
function join_name_change_add(n, obj_text) {
	var frm = document.dataForm;
	obj_value = obj_text.split("_");
	getId('join_code_'+n).value = obj_value[0];
	getId('join_name_'+n).value = obj_value[1];
	getId('join_ssnb_'+n).value = obj_value[2];
	getId('join_date_'+n).value = obj_value[3];
	getId('join_jikjong_code_'+n).value = obj_value[4];
	getId('join_jikjong_'+n).value = obj_value[5];
	getId('join_time_'+n).value = obj_value[6];
	getId('join_salary_'+n).value = obj_value[7];
	if(obj_value[8] == "0") getId('isgy_'+n).checked = true;
	else getId('isgy_'+n).checked = false;
	if(obj_value[9] == "0") getId('issj_'+n).checked = true;
	else getId('issj_'+n).checked = false;
	if(obj_value[10] == "0") getId('iskm_'+n).checked = true;
	else getId('iskm_'+n).checked = false;
	if(obj_value[11] == "0") getId('isgg_'+n).checked = true;
	else getId('isgg_'+n).checked = false;
	join_ok_func();
}
//����� ���� ����
function quit_name_change(obj_text) {
	var frm = document.dataForm;
	obj_value = obj_text.split("_");
	frm.quit_code.value = obj_value[0];
	frm.quit_name.value = obj_value[1];
	frm.quit_ssnb.value = obj_value[2];
	frm.quit_date.value = obj_value[3];
	frm.quit_tel.value = obj_value[4];
	frm.quit_sum_now.value = obj_value[5];
	frm.quit_sum_now_month.value = obj_value[6];
	frm.quit_3month.value = obj_value[7];
	frm.quit_sum_pre.value = obj_value[8];
	frm.quit_sum_pre_month.value = obj_value[9];
	quit_ok_func();
}
//����� �߰��� ���� ����
function quit_name_change_add(n, obj_text) {
	var frm = document.dataForm;
	obj_value = obj_text.split("_");
	getId('quit_code_'+n).value = obj_value[0];
	getId('quit_name_'+n).value = obj_value[1];
	getId('quit_ssnb_'+n).value = obj_value[2];
	getId('quit_date_'+n).value = obj_value[3];
	getId('quit_tel_'+n).value = obj_value[4];
	getId('quit_sum_now_'+n).value = obj_value[5];
	getId('quit_sum_now_month_'+n).value = obj_value[6];
	getId('quit_3month_'+n).value = obj_value[7];
	getId('quit_sum_pre_'+n).value = obj_value[8];
	getId('quit_sum_pre_month_'+n).value = obj_value[9];
	quit_ok_func();
}
//DIV ���� ����
function tab_view(tab) {
	var obj = document.getElementById(tab);
	if(obj.style.display == "none") {
		obj.style.display = "";
	} else {
		obj.style.display = "none";
	}
}
//����ڹ�ȣ �Է� ������
function checkhyphen(inputVal, type, keydown) {		// inputVal�� õ������ , ǥ�ø� ���� �������� ��
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
	input = delhyphen(inputVal, inputVal.length);
	//������ master �Է�
	//alert(input);
	if(1 == 1) { //��� ����
		//�� ����Ʈ+�� �� �� Home backsp
		if(event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=36 && event.keyCode!=8) {
			//alert(inputVal.length);
			//alert(input);
			if(inputVal.length == 3){
				//input = delhyphen(inputVal, inputVal.length);
				total += input.substring(0,3)+"-";
			} else if(inputVal.length == 6){
				total += inputVal.substring(0,8)+"-";
			} else if(inputVal.length == 12){
				total += inputVal.substring(0,14)+"";
			} else {
				total += inputVal;
			}
			if(keydown =='Y'){
				main.comp_bznb.value=total;
			}else if(keydown =='N'){
				return total
			}
		}
		return total
	}
}
//����������ȣ �Է� ������
function checkhyphen_tno(inputVal, type, keydown) {
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
	input = delhyphen(inputVal, inputVal.length);
	//������ master �Է�
	//alert(input);
	if(1 == 1) { //��� ����
		//�� ����Ʈ+�� �� �� Home backsp
		if(event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=36 && event.keyCode!=8) {
			//alert(inputVal.length);
			//alert(input);
			if(inputVal.length == 3){
				//input = delhyphen(inputVal, inputVal.length);
				total += input.substring(0,3)+"-";
			} else if(inputVal.length == 6){
				total += inputVal.substring(0,8)+"-";
			} else if(inputVal.length == 12){
				total += inputVal.substring(0,14)+"-";
			} else {
				total += inputVal;
			}
			if(keydown =='Y'){
				main.comp_tno.value=total;
			}else if(keydown =='N'){
				return total
			}
		}
		return total
	}
}
function delhyphen(inputVal, count) {
	var tmp = "";
	for(i=0; i<count; i++){
		if(inputVal.substring(i,i+1)!='-') {		// ���� substring�� ����
			tmp += inputVal.substring(i,i+1);	// ���� ��� , �� ����
		}
	}
	return tmp;
}
function only_number() {
	//Ű���� ��� ����Ű
	if (event.keyCode < 48 || event.keyCode > 57) {
		//Ű���� ���� ����Ű
		if (event.keyCode < 95 || event.keyCode > 105) {
			//del 46 , backsp 8 , left 37 , right 39 , tab 9 , shift 16
			if(event.keyCode != 46 && event.keyCode != 8 && event.keyCode != 37 && event.keyCode != 39 && event.keyCode != 9 && event.keyCode != 16) {
				event.preventDefault ? event.preventDefault() : event.returnValue = false;
			}
		}
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
include "./inc/left_menu7.php";
include "./inc/left_banner.php";
?>
						</td>
						<td valign="top" style="padding:10px 10px 10px 10px">

							<!--Ÿ��Ʋ -->
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>     
									<td height="18">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td style='font-size:8pt;color:#929292;'><img src="images/g_title_icon.gif" align=absmiddle  style='margin:0 5 2 0'><span style='font-size:9pt;color:black;'>4�뺸�� ���/��� �Ű�</span>
												</td>
												<td align=right class=navi></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr><td height="1" bgcolor=e0e0de></td></tr>
								<tr><td height="2" bgcolor=f5f5f5></td></tr>
								<tr><td height="5"></td></tr>
							</table>

							<!--������ -->
							<form name="dataForm" method="post" enctype="multipart/form-data">
							<input type="hidden" name="w" value="<?=$w?>" />
							<input type="hidden" name="com_code" value="<?=$com_code?>" />
							<input type="hidden" name="id" value="<?=$row1[id]?>" />
							<input type="hidden" name="page" value="<?=$page?>" />
							<input type="hidden" name="join_count" value="2" />
							<input type="hidden" name="quit_count" value="2" />
								<table border="0" cellspacing="0" cellpadding="0">
									<tr> 
										<td id=""> 
											<table border="0" cellspacing="0" cellpadding="0">
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
													���������
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
								<!--�˻� -->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
									<col width="20%">
									<col width="30%">
									<col width="20%">
									<col width="30%">
									<tr>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">������Ī<font color="red">*</font></td>
										<td nowrap class="tdrow">
											<input name="comp_name" type="text" class="textfm" style="width:150px;" value="<?=$row1[comp_name]?>" maxlength="25">
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����������<font color="red">*</font></td>
										<td nowrap class="tdrow">
											<input name="comp_adr" type="text" class="textfm" style="width:99%;" value="<?=$row1[comp_adr]?>" maxlength="50">
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����ڵ�Ϲ�ȣ<font color="red">*</font></td>
										<td nowrap class="tdrow">
											<input name="comp_bznb" type="text" class="textfm" style="width:120px;ime-mode:disabled;" value="<?=$row1[comp_bznb]?>" maxlength="12" onkeydown="only_number()" onkeyup="checkhyphen(this.value, '1','Y')" />
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">��ȭ��ȣ<font color="red">*</font></td>
										<td nowrap class="tdrow">
											<input name="comp_tel" type="text" class="textfm" style="width:100px;" value="<?=$row1[comp_tel]?>" maxlength="15"> ��) (055) 1234-1234
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����������ȣ<font color="red">*</font></td>
										<td nowrap class="tdrow">
											<input name="comp_tno" id="comp_tno" type="text" class="textfm" style="width:120px;ime-mode:disabled;" value="<?=$row1['t_no']?>" maxlength="14" onkeydown="only_number()" onkeyup="checkhyphen_tno(this.value, '2','Y')">
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�ѽ���ȣ<font color="red"></font></td>
										<td nowrap class="tdrow">
											<input name="comp_fax" id="comp_fax" type="text" class="textfm" style="width:100px;" value="<?=$row1[comp_fax]?>" maxlength="15"> ��) 055-1234-1234
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�̸���<font color="red">*</font></td>
										<td nowrap class="tdrow">
											<input name="comp_email" id="comp_email" type="text" class="textfm" style="width:210px;" value="<?=$row1['comp_email']?>" maxlength="30">
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">���<font color="red"></font></td>
										<td nowrap class="tdrow">
											<input name="memo" id="memo" type="text" class="textfm" style="width:99%;" value="<?=$row1['memo']?>" maxlength="30" />
										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px;line-height:0px;"></div>

									<table border=0 cellspacing=0 cellpadding=0> 
										<tr> 
											<td style="background-color:#8db41d" valign="top"> 
												<table border=0 cellpadding=0 cellspacing=0> 
													<tr> 
														<td><img src="images/g_tab_on_lt.gif"></td> 
														<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
														�Ի���
														</td> 
														<td><img src="images/g_tab_on_rt.gif"></td> 
													</tr> 
												</table> 
											</td> 
											<td width=2></td> 
											<td valign="bottom"> <input type="checkbox" name="join_ok" value="1" class="checkbox" style="height:18px"> �Ի��� �Է½� üũ���ֽʽÿ�.</td> 
										</tr> 
									</table>
									<div style="height:2px;font-size:0px" class="bgtr"></div>
									<div style="height:2px;font-size:0px;line-height:0px;"></div>
									<!--�˻� -->
									<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
										<col width="20%">
										<col width="30%">
										<col width="20%">
										<col width="30%">
										<tr>
											<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����<font color="red">*</font></td>
											<td nowrap class="tdrow">
												<input name="join_code" type="hidden" value="<?=$row1['join_code']?>">
												<input name="join_name" type="text" class="textfm" style="width:100px;" value="<?=$row1['join_name']?>" maxlength="25" onclick="join_ok_func()" onfocus="join_ok_func()">
												<select name="join_sabun" class="selectfm" onchange="join_name_change(this.value);">
													<option value="______________">����</option>
<?
//�������
$sql_sabun = " select * from pibohum_base where com_code='$com_code' ";
//echo $sql_sabun;
$result_sabun = sql_query($sql_sabun);
$sabun_array = "";
for($i=0; $row_sabun=sql_fetch_array($result_sabun); $i++) {
	$sabun = $row_sabun['sabun'];
	$sabun_name[$sabun] = $row_sabun['name'];
	$sql_sabun_opt = " select * from pibohum_base_opt where com_code='$com_code' and sabun = '$sabun' ";
	$row_sabun_opt = sql_fetch($sql_sabun_opt);
	//�޿����� �ش��
	$search_month = date("m");
	//echo $search_month;
	if($search_month == 1) {
		$search_year_minus = 1;
		$search_month = 12;
	} else {
		$search_year_minus = 0;
		$search_month -= 1;
	}
	if($search_month < 10) $search_month = "0".$search_month;
	$search_year = date("Y");
	$search_year -= $search_year_minus;
	//Ȱ�������� �޿� DB
	$sql_pay_h = " select money_for_tax, workhour_total from pibohum_base_pay_h where com_code='$com_code' and sabun='$sabun' and year='$search_year' and month='$search_month' ";
	echo "<!--".$sql_pay_h."-->";
	$row_pay_h = sql_fetch($sql_pay_h);
	$workhour_total = $row_pay_h['workhour_total'];
	$money_for_tax = $row_pay_h['money_for_tax'];
	if(!$workhour_total) $workhour_total = 0;
	$work_time = ceil($workhour_total * 12 / 365 *7);
?>
													<option value='<?=$row_sabun['sabun']?>_<?=$row_sabun['name']?>_<?=$row_sabun['jumin_no']?>_<?=$row_sabun['in_day']?>_<?=$row_sabun_opt['jikjong_code']?>_<?=$row_sabun_opt['jikjong']?>_<? if($work_time) echo $work_time;?>_<? if($money_for_tax) echo number_format($money_for_tax); ?>_<?=$row_sabun['apply_gy']?>_<?=$row_sabun['apply_sj']?>_<?=$row_sabun['apply_km']?>_<?=$row_sabun['apply_gg']?>' <? if($row_sabun['sabun'] == $row_att['sabun']) echo "selected"; ?> ><?=$row_sabun['name']?> (<?=$row_sabun['in_day']?>)</option>
<?
	//��� ���� Select Box ���� ����
	$sabun_selectbox_join[$sabun] = $row_sabun['sabun']."_".$row_sabun['name']."_".$row_sabun['jumin_no']."_".$row_sabun['in_day']."_".$row_sabun_opt['jikjong_code']."_".$row_sabun_opt['jikjong']."_".$work_time."_".number_format($money_for_tax)."_".$row_sabun['apply_gy']."_".$row_sabun['apply_sj']."_".$row_sabun['apply_km']."_".$row_sabun['apply_gg'];
	$sabun_array .= "<option value='".$sabun_selectbox_join[$sabun]."'>".$row_sabun['name']." (".$row_sabun['in_day'].")</option>";
}
?>
												</select>
											</td>
											<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�ֹε�Ϲ�ȣ<font color="red">*</font></td>
											<td nowrap class="tdrow">
												<input name="join_ssnb" type="text" class="textfm" style="width:100px;" value="<?=$row1[join_ssnb]?>" maxlength="14"> ��) 123456-1234567
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�Ի���<font color="red">*</font></td>
											<td nowrap class="tdrow">
												<input name="join_date" type="text" class="textfm5" readonly style="width:80px;" value="<?=substr($row1['join_date'], 0, 11);?>" maxlength="15">
												<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.dataForm.join_date);" target="">�޷�</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
												��) 2013.09.05
											</td>
											<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����<font color="red">*</font></td>
											<td nowrap class="tdrow">
												<input name="join_jikjong_code" id="join_jikjong_code_undefined" type="text" class="textfm" style="width:30px;" value="<?=$row1[join_jikjong_code]?>" maxlength="3" readonly>
												<input name="join_jikjong" id="join_jikjong_undefined" type="text" class="textfm" style="width:180px;" value="<?=$row1[join_jikjong]?>" maxlength="25" readonly>
												<label onclick="open_jikjong();" style="cursor:pointer"><img src="images/search_bt.png" align=absmiddle></label>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�ּ����ٷνð�<font color="red">*</font></td>
											<td nowrap class="tdrow">
												<input name="join_time" type="text" class="textfm" style="width:100px;" value="<?=$row1[join_time]?>" maxlength="4">
											</td>
											<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">���ӱ�<font color="red">*</font></td>
											<td nowrap class="tdrow">
												<input name="join_salary" type="text" class="textfm" style="width:150px;ime-mode:inactive;" onkeypress="only_number()" value="<?=$row1[join_salary]?>" maxlength="25" onkeyup="checkThousand(this.value, '1','Y')">
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�������뿩��<font color="red">*</font></td>
											<td nowrap class="tdrow">
												<?
												//echo $row1[isgy];
												if($row1[isgy] == "1") $isgy_chk = "checked";
												else $isgy_chk = "";
												if($row1[issj] == "1") $issj_chk = "checked";
												else $issj_chk = "";
												if($row1[iskm] == "1") $iskm_chk = "checked";
												else $iskm_chk = "";
												if($row1[isgg] == "1") $isgg_chk = "checked";
												else $isgg_chk = "";
												?>
												<input type="checkbox" name="isgy" value="1" class="checkbox" <?=$isgy_chk?>>���
												<input type="checkbox" name="issj" value="1" class="checkbox" <?=$issj_chk?>>����
												<input type="checkbox" name="iskm" value="1" class="checkbox" <?=$iskm_chk?>>����
												<input type="checkbox" name="isgg" value="1" class="checkbox" <?=$isgg_chk?>>�ǰ�
											</td>
											<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����� ����<font color="red">*</font></td>
											<td nowrap class="tdrow">
												<input type="radio" name="contract_worker" value="1" style="vertical-align:middle;" <? if($row1['contract_worker'] == 1) echo "checked"; ?> />��
												<input type="radio" name="contract_worker" value="2" style="vertical-align:middle;" <? if($row1['contract_worker'] == 2) echo "checked"; ?> />�ƴϿ�
												<br />
												���������
												<input name="contract_end_date" type="text" class="textfm5" readonly style="width:70px;" value="<?=$row1['contract_end_date']?>" maxlength="25" /><table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.dataForm.contract_end_date);" target="">�޷�</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
												<br />��뺸�踸 �ش�˴ϴ�.
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">���<font color="red"></font></td>
											<td nowrap class="tdrow" colspan="3">
												<input name="join_note" type="text" class="textfm" style="width:98%;" value="<?=$row1['join_note']?>" maxlength="50">
											</td>
										</tr>
									</table>

									<div style="height:2px;font-size:0px;line-height:0px;"></div>
									<table border=0 cellspacing=0 cellpadding=0> 
										<tr>
											<td id=""> 
												<table border=0 cellpadding=0 cellspacing=0> 
													<tr> 
														<td><img src="images/sb_tab_on_lt.gif"></td> 
														<td background="images/sb_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
															<a href="javascript:tab_view('children');">�Ǻξ��� ���</a>
														</td> 
														<td><img src="images/sb_tab_on_rt.gif"></td> 
													</tr> 
												</table> 
											</td> 
											<td width=6></td> 
											<td valign="middle"></td> 
										</tr> 
									</table>
									<div style="height:2px;font-size:0px;background-color:#226bd4"></div>
									<div style="height:2px;font-size:0px;line-height:0px;"></div>
<?
$children_array = explode(",",$row1[children1]);
if($children_array[3]) $children_checked = "checked";
else $children_checked = "";

//�Ǻξ��� �Է� ������ ���� �� ǥ�� 160401
if(!$children_array[0]) $children_div = "display:none";
?>
									<!--��޴� -->
									<div id="children" style="<?=$children_div?>">
										<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
											<col width="10%">
											<col width="10%">
											<col width="20%">
											<col width="10%">
											<col width="10%">
											<col width="10%">
											<col width="20%">
											<col width="10%">
											<tr>
												<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����</td>
												<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����</td>
												<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�ֹε�Ϲ�ȣ</td>
												<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">���ſ���</td>
												<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����</td>
												<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����</td>
												<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�ֹε�Ϲ�ȣ</td>
												<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">���ſ���</td>
											</tr>
											<tr>
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
$children_array = explode(",",$row1[children2]);
if($children_array[3]) $children_checked = "checked";
else $children_checked = "";
?>
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
$children_array = explode(",",$row1[children3]);
if($children_array[3]) $children_checked = "checked";
else $children_checked = "";
?>
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
$children_array = explode(",",$row1[children4]);
if($children_array[3]) $children_checked = "checked";
else $children_checked = "";
?>
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
$children_array = explode(",",$row1[children5]);
if($children_array[3]) $children_checked = "checked";
else $children_checked = "";
?>
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

									<div style="height:5px;font-size:0px;line-height:0px;"></div>

									<script language="javascript">
									var join_name = new Array();
									var join_ssnb = new Array();
									var join_date = new Array();
									var join_jikjong = new Array();
									var join_jikjong_code = new Array();
									var join_time = new Array();
									var join_time = new Array();
									var join_salary = new Array();
									var isgy = new Array();
									var issj = new Array();
									var iskm = new Array();
									var isgg = new Array();
									var contract_worker_1 = new Array();
									var contract_worker_2 = new Array();
									var contract_end_date = new Array();
									var join_note = new Array();

									var children1 = new Array();
									var children2 = new Array();
									var children3 = new Array();
									var children4 = new Array();
									var children5 = new Array();
									var children6 = new Array();

									var children_relation1 = new Array();
									var children_name1 = new Array();
									var children_ssnb1 = new Array();
									var children_cohabitation1 = new Array();
									var children_checked1 = new Array();
									var children_relation2 = new Array();
									var children_name2 = new Array();
									var children_ssnb2 = new Array();
									var children_cohabitation2 = new Array();
									var children_checked2 = new Array();
									var children_relation3 = new Array();
									var children_name3 = new Array();
									var children_ssnb3 = new Array();
									var children_cohabitation3 = new Array();
									var children_checked3 = new Array();
									var children_relation4 = new Array();
									var children_name4 = new Array();
									var children_ssnb4 = new Array();
									var children_cohabitation4 = new Array();
									var children_checked4 = new Array();
									var children_relation5 = new Array();
									var children_name5 = new Array();
									var children_ssnb5 = new Array();
									var children_cohabitation5 = new Array();
									var children_checked5 = new Array();
									var children_relation6 = new Array();
									var children_name6 = new Array();
									var children_ssnb6 = new Array();
									var children_cohabitation6 = new Array();
									var children_checked6 = new Array();

									var quit_name = new Array();
									var quit_ssnb = new Array();
									var quit_tel = new Array();
									var quit_date = new Array();
									var quit_cause = new Array();
									var quit_isgy = new Array();
									var quit_issj = new Array();
									var quit_iskm = new Array();
									var quit_isgg = new Array();
									var quit_sum_now = new Array();
									var quit_sum_now_month = new Array();
									var quit_sum_pre = new Array();
									var quit_sum_pre_month = new Array();
									var quit_3month = new Array();

									var filename = new Array();
									var quit_note = new Array();

									var frm = document.dataForm;
									<?
									for($i=2; $i<=5; $i++) {
										$join_name_add = "join_name_".$i;
										$join_ssnb_add = "join_ssnb_".$i;
										$join_date_add = "join_date_".$i;
										$join_jikjong_add = "join_jikjong_".$i;
										$join_jikjong_code_add = "join_jikjong_code_".$i;
										$join_time_add = "join_time_".$i;
										$join_salary_add = "join_salary_".$i;
										$isgy_add = "isgy_".$i;
										$issj_add = "issj_".$i;
										$iskm_add = "iskm_".$i;
										$isgg_add = "isgg_".$i;

										$contract_worker_add = "contract_worker_".$i;
										$contract_end_date_add = "contract_end_date_".$i;

										$join_note_add = "join_note_".$i;

										$children1 = "children1_".$i;
										$children2 = "children2_".$i;
										$children3 = "children3_".$i;
										$children4 = "children4_".$i;
										$children5 = "children5_".$i;
										$children6 = "children6_".$i;

										$quit_name_add = "quit_name_".$i;
										$quit_ssnb_add = "quit_ssnb_".$i;
										$quit_tel_add = "quit_tel_".$i;
										$quit_date_add = "quit_date_".$i;
										$quit_cause_add = "quit_cause_".$i;
										$quit_sum_now_add = "quit_sum_now_".$i;
										$quit_sum_now_month_add = "quit_sum_now_month_".$i;
										$quit_sum_pre_add = "quit_sum_pre_".$i;
										$quit_sum_pre_month_add = "quit_sum_pre_month_".$i;
										$quit_3month_add = "quit_3month_".$i;

										$quit_isgy_add = "quit_isgy_".$i;
										$quit_issj_add = "quit_issj_".$i;
										$quit_iskm_add = "quit_iskm_".$i;
										$quit_isgg_add = "quit_isgg_".$i;

										$filename_add = "file".$i;
										$quit_note_add = "quit_note_".$i;
									?>
									join_name[<?=$i?>] = "<?=$row1[$join_name_add]?>";
									join_ssnb[<?=$i?>] = "<?=$row1[$join_ssnb_add]?>";
									join_date[<?=$i?>] = "<?=$row1[$join_date_add]?>";
									join_jikjong[<?=$i?>] = "<?=$row1[$join_jikjong_add]?>";
									join_jikjong_code[<?=$i?>] = "<?=$row1[$join_jikjong_code_add]?>";
									join_time[<?=$i?>] = "<?=$row1[$join_time_add]?>";
									join_salary[<?=$i?>] = "<?=$row1[$join_salary_add]?>";
									<?
									//echo $row1[$isgy_add];
									if($row1[$isgy_add] == "1") {
									?>
									isgy[<?=$i?>] = "checked";
									<?
									} else {
									?>
									isgy[<?=$i?>] = "";
									<?
									}
									if($row1[$issj_add] == "1") {
									?>
									issj[<?=$i?>] = "checked";
									<?
									} else {
									?>
									issj[<?=$i?>] = "";
									<?
									}
									if($row1[$iskm_add] == "1") {
									?>
									iskm[<?=$i?>] = "checked";
									<?
									} else {
									?>
									iskm[<?=$i?>] = "";
									<?
									}
									if($row1[$isgg_add] == "1") {
									?>
									isgg[<?=$i?>] = "checked";
									<?
									} else {
									?>
									isgg[<?=$i?>] = "";
									<?
									}
									?>
									//alert("<?=$isgy_add?>");
									<?
									if($row1[$contract_worker_add] == 1) {
									?>
									contract_worker_1[<?=$i?>] = "checked";
									<?
									} else if($row1[$contract_worker_add] == 2) {
									?>
									contract_worker_2[<?=$i?>] = "checked";
									<?
									}
									?>
									contract_end_date[<?=$i?>] = "<?=$row1[$contract_end_date_add]?>";
									join_note[<?=$i?>] = "<?=$row1[$join_note_add]?>";
									children1[<?=$i?>] = "<?=$row1[$children1]?>";
									children2[<?=$i?>] = "<?=$row1[$children2]?>";
									children3[<?=$i?>] = "<?=$row1[$children3]?>";
									children4[<?=$i?>] = "<?=$row1[$children4]?>";
									children5[<?=$i?>] = "<?=$row1[$children5]?>";
									children6[<?=$i?>] = "<?=$row1[$children6]?>";

									children_array = children1[<?=$i?>].split(",");
									children_relation1[<?=$i?>] = children_array[0];
									children_name1[<?=$i?>] = children_array[1];
									children_ssnb1[<?=$i?>] = children_array[2];
									children_cohabitation1[<?=$i?>] = children_array[3];
									if(children_name1[<?=$i?>] == undefined) children_name1[<?=$i?>] = "";
									if(children_ssnb1[<?=$i?>] == undefined) children_ssnb1[<?=$i?>] = "";
									if(children_cohabitation1[<?=$i?>] == undefined) children_cohabitation1[<?=$i?>] = "";
									if(children_cohabitation1[<?=$i?>]) children_checked1[<?=$i?>] = "checked";
									else children_checked1[<?=$i?>] = "";
									children_array = children2[<?=$i?>].split(",");
									children_relation2[<?=$i?>] = children_array[0];
									children_name2[<?=$i?>] = children_array[1];
									children_ssnb2[<?=$i?>] = children_array[2];
									children_cohabitation2[<?=$i?>] = children_array[3];
									if(children_name2[<?=$i?>] == undefined) children_name2[<?=$i?>] = "";
									if(children_ssnb2[<?=$i?>] == undefined) children_ssnb2[<?=$i?>] = "";
									if(children_cohabitation2[<?=$i?>] == undefined) children_cohabitation2[<?=$i?>] = "";
									if(children_cohabitation2[<?=$i?>]) children_checked2[<?=$i?>] = "checked";
									else children_checked2[<?=$i?>] = "";
									children_array = children3[<?=$i?>].split(",");
									children_relation3[<?=$i?>] = children_array[0];
									children_name3[<?=$i?>] = children_array[1];
									children_ssnb3[<?=$i?>] = children_array[2];
									children_cohabitation3[<?=$i?>] = children_array[3];
									if(children_name3[<?=$i?>] == undefined) children_name3[<?=$i?>] = "";
									if(children_ssnb3[<?=$i?>] == undefined) children_ssnb3[<?=$i?>] = "";
									if(children_cohabitation3[<?=$i?>] == undefined) children_cohabitation3[<?=$i?>] = "";
									if(children_cohabitation3[<?=$i?>]) children_checked3[<?=$i?>] = "checked";
									else children_checked3[<?=$i?>] = "";
									children_array = children4[<?=$i?>].split(",");
									children_relation4[<?=$i?>] = children_array[0];
									children_name4[<?=$i?>] = children_array[1];
									children_ssnb4[<?=$i?>] = children_array[2];
									children_cohabitation4[<?=$i?>] = children_array[3];
									if(children_name4[<?=$i?>] == undefined) children_name4[<?=$i?>] = "";
									if(children_ssnb4[<?=$i?>] == undefined) children_ssnb4[<?=$i?>] = "";
									if(children_cohabitation4[<?=$i?>] == undefined) children_cohabitation4[<?=$i?>] = "";
									if(children_cohabitation4[<?=$i?>]) children_checked4[<?=$i?>] = "checked";
									else children_checked4[<?=$i?>] = "";
									children_array = children5[<?=$i?>].split(",");
									children_relation5[<?=$i?>] = children_array[0];
									children_name5[<?=$i?>] = children_array[1];
									children_ssnb5[<?=$i?>] = children_array[2];
									children_cohabitation5[<?=$i?>] = children_array[3];
									if(children_name5[<?=$i?>] == undefined) children_name5[<?=$i?>] = "";
									if(children_ssnb5[<?=$i?>] == undefined) children_ssnb5[<?=$i?>] = "";
									if(children_cohabitation5[<?=$i?>] == undefined) children_cohabitation5[<?=$i?>] = "";
									if(children_cohabitation5[<?=$i?>]) children_checked5[<?=$i?>] = "checked";
									else children_checked5[<?=$i?>] = "";
									children_array = children6[<?=$i?>].split(",");
									children_relation6[<?=$i?>] = children_array[0];
									children_name6[<?=$i?>] = children_array[1];
									children_ssnb6[<?=$i?>] = children_array[2];
									children_cohabitation6[<?=$i?>] = children_array[3];
									if(children_name6[<?=$i?>] == undefined) children_name6[<?=$i?>] = "";
									if(children_ssnb6[<?=$i?>] == undefined) children_ssnb6[<?=$i?>] = "";
									if(children_cohabitation6[<?=$i?>] == undefined) children_cohabitation6[<?=$i?>] = "";
									if(children_cohabitation6[<?=$i?>]) children_checked6[<?=$i?>] = "checked";
									else children_checked6[<?=$i?>] = "";

									quit_name[<?=$i?>] = "<?=$row1[$quit_name_add]?>";
									quit_ssnb[<?=$i?>] = "<?=$row1[$quit_ssnb_add]?>";
									quit_tel[<?=$i?>] = "<?=$row1[$quit_tel_add]?>";
									quit_date[<?=$i?>] = "<?=$row1[$quit_date_add]?>";
									quit_cause[<?=$i?>] = "<?=$row1[$quit_cause_add]?>";
									<?
									$quit_cause[$i] = $row1[$quit_cause_add];
									?>
									quit_sum_now[<?=$i?>] = "<?=$row1[$quit_sum_now_add]?>";
									quit_sum_now_month[<?=$i?>] = "<?=$row1[$quit_sum_now_month_add]?>";
									quit_sum_pre[<?=$i?>] = "<?=$row1[$quit_sum_pre_add]?>";
									quit_sum_pre_month[<?=$i?>] = "<?=$row1[$quit_sum_pre_month_add]?>";
									quit_3month[<?=$i?>] = "<?=$row1[$quit_3month_add]?>";
									<?
									if($row1[$quit_isgy_add] == "1") {
									?>
									quit_isgy[<?=$i?>] = "checked";
									<?
									} else {
									?>
									quit_isgy[<?=$i?>] = "";
									<?
									}
									if($row1[$quit_issj_add] == "1") {
									?>
									quit_issj[<?=$i?>] = "checked";
									<?
									} else {
									?>
									quit_issj[<?=$i?>] = "";
									<?
									}
									if($row1[$quit_iskm_add] == "1") {
									?>
									quit_iskm[<?=$i?>] = "checked";
									<?
									} else {
									?>
									quit_iskm[<?=$i?>] = "";
									<?
									}
									if($row1[$quit_isgg_add] == "1") {
									?>
									quit_isgg[<?=$i?>] = "checked";
									<?
									} else {
									?>
									quit_isgg[<?=$i?>] = "";
									<?
									}
									?>
									filename[<?=$i?>] = "<?=$row1[$filename_add]?>";
									quit_note[<?=$i?>] = "<?=$row1[$quit_note_add]?>";
									<?
									}
									?>

									function onload_4insure(){ 
										//alert("<?=$id?>");
<?
if($id) {
	$sql2 = " select * from pibohum_base where com_code='$code' and sabun='$id' ";
	$result2 = sql_query($sql2);
	$row2 = mysql_fetch_array($result2);
	$sql3 = " select * from pibohum_base_opt where com_code='$code' and sabun='$id' ";
	$result3 = sql_query($sql3);
	$row3 = mysql_fetch_array($result3);
	$sql4 = " select * from pibohum_base_opt2 where com_code='$code' and sabun='$id' ";
	$result4 = sql_query($sql4);
	$row4 = mysql_fetch_array($result4);
	$sql_nomu = " select * from pibohum_base_nomu where com_code='$code' and sabun='$id' ";
	$result_nomu = sql_query($sql_nomu);
	$row_nomu = mysql_fetch_array($result_nomu);
	//���Ű�
	if($mode == "in") {
		$in_day = $row2[in_day];
?>
join_ok_func();
var frm = document.dataForm;
frm.join_code.value = "<?=$row2[sabun]?>";
frm.join_name.value = "<?=$row2[name]?>";
frm.join_ssnb.value = "<?=$row2[jumin_no]?>";
frm.join_date.value = "<?=$in_day?>";
frm.join_jikjong_code.value = "<?=$row3[jikjong_code]?>";
frm.join_jikjong.value = "<?=$row3[jikjong]?>";
frm.join_time.value = "<?=$row4[workhour_day_w]?>";
frm.join_salary.value = "<?=number_format($row4[money_month_base])?>";
<?
		if($row2[apply_gy] == "0") {
			echo "frm.isgy.checked = true;";
		}
		if($row2[apply_sj] == "0") {
			echo "frm.issj.checked = true;";
		}
		if($row2[apply_km] == "0") {
			echo "frm.iskm.checked = true;";
		}
		if($row2[apply_gg] == "0") {
			echo "frm.isgg.checked = true;";
		}
	} else if($mode == "out") {
		$out_day = $row2[out_day];
?>
quit_ok_func();
var frm = document.dataForm;
frm.quit_code.value = "<?=$row2[sabun]?>";
frm.quit_name.value = "<?=$row2[name]?>";
frm.quit_ssnb.value = "<?=$row2[jumin_no]?>";
frm.quit_date.value = "<?=$out_day?>";
frm.quit_tel.value = "<?=$row2[add_tel]?>";
<?
	//�ش翬���ӱ��Ѿ� 151103
	$now_year = date("Y");
	$sql_pay = " select * from pibohum_base_pay_h where com_code='$code' and sabun='$id' order by year desc, month desc ";
	//echo "//".$sql_pay;
	$result_pay = sql_query($sql_pay);
	$quit_sum_now = 0;
	$quit_sum_now_month = 0;
	$quit_3month = 0;
	$quit_3month_cnt = 0;
	$quit_sum_pre = 0;
	$quit_sum_pre_month = 0;
	for($i=0; $row_pay=sql_fetch_array($result_pay); $i++) {
		echo "//year ".$row_pay['year'].".".$row_pay['month']."\n";
		if($row_pay['money_for_tax'] > 0) {
			if($i < 3) {
				$quit_3month += (int)$row_pay['money_for_tax'];
				$quit_3month_cnt++;
			}
			if($row_pay['year'] == $now_year) {
				$quit_sum_now += (int)$row_pay['money_for_tax'];
				$quit_sum_now_month++;
			} else if($row_pay['year'] == ($now_year-1)) {
				$quit_sum_pre += (int)$row_pay['money_for_tax'];
				$quit_sum_pre_month++;
			}
		}
	}
	if($quit_sum_now) $quit_sum_now = number_format($quit_sum_now);
	if($quit_3month) $quit_3month = number_format($quit_3month / $quit_3month_cnt);
	if($quit_sum_pre) $quit_sum_pre = number_format($quit_sum_pre);
?>
frm.quit_sum_now.value = "<?=$quit_sum_now?>";
frm.quit_sum_now_month.value = "<?=$quit_sum_now_month?>";
frm.quit_3month.value = "<?=$quit_3month?>";
frm.quit_sum_pre.value = "<?=$quit_sum_pre?>";
frm.quit_sum_pre_month.value = "<?=$quit_sum_pre_month?>";
//alert(value);
selectObj = frm.quit_cause;
//alert(selectObj.options.length);
for(i=0; i<selectObj.options.length;i++) {
	if( selectObj.options[i].value == value) {
		selectObj.options[i].selected = "selected";
		break;
	}
}
<?
	}
}
?>
										<?
										if($row1[join_name] != "") {
										?>
										join_ok_func();
										<?
										}
										?>
										<?
										if($row1[quit_name] != "") {
										?>
										quit_ok_func();
										<?
										}
										?>
										<?
										for($i=2; $i<=5; $i++) {
											$join_name_add = "join_name_".$i;
											if($row1[$join_name_add] != "") {
										?>
										join_plus(<?=$i?>);
										<?
											}
										}
										?>
										<?
										for($i=2; $i<=5; $i++) {
											$quit_name_add = "quit_name_".$i;
											if($row1[$quit_name_add] != "") {
										?>
										quit_plus(<?=$i?>);
										<?
											}
										}
										?>
									}
									addLoadEvent(onload_4insure); 

									function join_plus(n){
										//alert(n);
										if(frm.join_count.value > 5) {
											alert("�ѹ��� �Ű��� �� �ִ� �ο��� 5����� �Դϴ�.");
											return false;
										} else { 
											document.getElementById('join_add_div').style.display = "";
											var Tbl = document.getElementById('join_optable'); 
											tRow = Tbl.insertRow();//tr �߰�
											tCell = tRow.insertCell();//td �߰�
											tCell.className = "tdrowk"; 
											tCell.colSpan = 2;
											tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">����<font color=\"red\">*</font>";
											tCell = tRow.insertCell();
											tCell.className = "tdrow"; 
											tCell.colSpan = 2;
											tCell.innerHTML = "<input name=\"join_name_[]\" id=\"join_name_"+n+"\" type=\"text\" class=\"textfm\" style=\"width:100px;\" value=\""+join_name[n]+"\" maxlength=\"25\"><input name=\"join_code_[]\" id=\"join_code_"+n+"\" type=\"hidden\" value=\"\"><select name=\"join_sabun_[]\" class=\"selectfm\" onchange=\"join_name_change_add("+n+", this.value);\"><option value=\"______________\">����</option><?=$sabun_array?></select>";
											tCell = tRow.insertCell();
											tCell.className = "tdrowk"; 
											tCell.colSpan = 2;
											tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">�ֹε�Ϲ�ȣ<font color=\"red\">*</font>";
											tCell = tRow.insertCell();
											tCell.className = "tdrow"; 
											tCell.colSpan = 2;
											tCell.innerHTML = "<input name=\"join_ssnb_[]\" id=\"join_ssnb_"+n+"\" type=\"text\" class=\"textfm\" style=\"width:100px;\" value=\""+join_ssnb[n]+"\" maxlength=\"14\">";

											tRow = Tbl.insertRow();
											tCell = tRow.insertCell();
											tCell.className = "tdrowk"; 
											tCell.colSpan = 2;
											tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">�Ի���<font color=\"red\">*</font>";
											tCell = tRow.insertCell();
											tCell.className = "tdrow"; 
											tCell.colSpan = 2;
											tCell.innerHTML = "<input name=\"join_date_[]\" id=\"join_date_"+n+"\" type=\"text\" class=\"textfm5\" readonly style=\"width:80px;\" value=\""+join_date[n]+"\" maxlength=\"10\" onclick=\"loadCalendar(this);\"> �� <font color=\"red\">Ŭ���� �޷� ǥ��</font>";
											tCell = tRow.insertCell();
											tCell.className = "tdrowk"; 
											tCell.colSpan = 2;
											tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">����<font color=\"red\">*</font>";
											tCell = tRow.insertCell();
											tCell.className = "tdrow"; 
											tCell.colSpan = 2;
											tCell.innerHTML = "<input name=\"join_jikjong_code_[]\" id=\"join_jikjong_code_"+n+"\" type=\"text\" class=\"textfm\" style=\"width:30px;\" value=\""+join_jikjong_code[n]+"\" maxlength=\"3\" readonly><input name=\"join_jikjong_[]\" id=\"join_jikjong_"+n+"\" type=\"text\" class=\"textfm\" style=\"width:180px;\" value=\""+join_jikjong[n]+"\" maxlength=\"25\" readonly><label onclick=\"open_jikjong("+n+");\" style=\"cursor:pointer\"><img src=\"images/search_bt.png\" align=absmiddle></label>";

											tRow = Tbl.insertRow();
											tCell = tRow.insertCell();
											tCell.className = "tdrowk"; 
											tCell.colSpan = 2;
											tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">�ּ����ٷνð�<font color=\"red\">*</font>";
											tCell = tRow.insertCell();
											tCell.className = "tdrow"; 
											tCell.colSpan = 2;
											tCell.innerHTML = "<input name=\"join_time_[]\" id=\"join_time_"+n+"\" type=\"text\" class=\"textfm\" style=\"width:100px;\" value=\""+join_time[n]+"\" maxlength=\"4\">";
											tCell = tRow.insertCell();
											tCell.className = "tdrowk"; 
											tCell.colSpan = 2;
											tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">���ӱ�<font color=\"red\">*</font>";
											tCell = tRow.insertCell();
											tCell.className = "tdrow"; 
											tCell.colSpan = 2;
											tCell.innerHTML = "<input name=\"join_salary_[]\" id=\"join_salary_"+n+"\" type=\"text\" class=\"textfm\" style=\"width:150px;ime-mode:inactive;\" onkeypress=\"only_number()\" value=\""+join_salary[n]+"\" maxlength=\"25\" onkeyup=\"checkThousand(this.value, '1"+frm.join_count.value+"','Y')\">";

											tRow = Tbl.insertRow();
											tCell = tRow.insertCell();
											tCell.className = "tdrowk"; 
											tCell.colSpan = 2;
											tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">�������뿩��<font color=\"red\">*</font>";
											tCell = tRow.insertCell();
											tCell.className = "tdrow"; 
											tCell.colSpan = 2;
											tCell.innerHTML = "<input type=\"checkbox\" name=\"isgy_"+n+"\" id=\"isgy_"+n+"\" value=\"1\" class=\"checkbox\" "+isgy[n]+"> ��� <input type=\"checkbox\" name=\"issj_"+n+"\" id=\"issj_"+n+"\" value=\"1\" class=\"checkbox\" "+issj[n]+"> ���� <input type=\"checkbox\" name=\"iskm_"+n+"\" id=\"iskm_"+n+"\" value=\"1\" class=\"checkbox\" "+iskm[n]+"> ���� <input type=\"checkbox\" name=\"isgg_"+n+"\" id=\"isgg_"+n+"\" value=\"1\" class=\"checkbox\" "+isgg[n]+"> �ǰ�";
											tCell = tRow.insertCell();
											tCell.className = "tdrowk"; 
											tCell.colSpan = 2;
											tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">����� ����<font color=\"red\">*</font>";
											tCell = tRow.insertCell();
											tCell.className = "tdrow"; 
											tCell.colSpan = 2;
											tCell.innerHTML = "<input type=\"radio\" name=\"contract_worker_"+n+"\" id=\"contract_worker_"+n+"\" value=\"1\" style=\"vertical-align:middle;\" "+contract_worker_1[n]+" />�� <input type=\"radio\" name=\"contract_worker_"+n+"\" value=\"2\" style=\"vertical-align:middle;\" "+contract_worker_2[n]+" />�ƴϿ� <br />��������� <input name=\"contract_end_date_[]\" type=\"text\" class=\"textfm5\" readonly style=\"width:70px;\" value=\""+contract_end_date[n]+"\" maxlength=\"10\" onclick=\"loadCalendar(this);\" /> �� <font color=\"red\">Ŭ���� �޷� ǥ��</font>";

											tRow = Tbl.insertRow();
											tCell = tRow.insertCell();
											tCell.className = "tdrowk"; 
											tCell.colSpan = 2;
											tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">���<font color=\"red\"></font>";
											tCell = tRow.insertCell();
											tCell.className = "tdrow"; 
											tCell.colSpan = 6;
											tCell.innerHTML = "<input name=\"join_note_[]\" type=\"text\" class=\"textfm\" style=\"width:98%;\" value=\""+join_note[n]+"\" maxlength=\"50\">";

											tRow = Tbl.insertRow();
											tCell = tRow.insertCell();
											tCell.className = "tdrowk"; 
											tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">����<font color=\"red\"></font>";
											tCell = tRow.insertCell();
											tCell.className = "tdrowk"; 
											tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">����<font color=\"red\"></font>";
											tCell = tRow.insertCell();
											tCell.className = "tdrowk"; 
											tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">�ֹε�Ϲ�ȣ<font color=\"red\"></font>";
											tCell = tRow.insertCell();
											tCell.className = "tdrowk"; 
											tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">���ſ���<font color=\"red\"></font>";
											tCell = tRow.insertCell();
											tCell.className = "tdrowk"; 
											tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">����<font color=\"red\"></font>";
											tCell = tRow.insertCell();
											tCell.className = "tdrowk"; 
											tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">����<font color=\"red\"></font>";
											tCell = tRow.insertCell();
											tCell.className = "tdrowk"; 
											tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">�ֹε�Ϲ�ȣ<font color=\"red\"></font>";
											tCell = tRow.insertCell();
											tCell.className = "tdrowk"; 
											tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">���ſ���<font color=\"red\"></font>";

											tRow = Tbl.insertRow();
											tCell = tRow.insertCell();
											tCell.className = "tdrow"; 
											tCell.innerHTML = "<input name=\"children_relation1_[]\" type=\"text\" class=\"textfm\" style=\"width:80px;\" value=\""+children_relation1[n]+"\" maxlength=\"10\">";
											tCell = tRow.insertCell();
											tCell.className = "tdrow"; 
											tCell.innerHTML = "<input name=\"children_name1_[]\" type=\"text\" class=\"textfm\" style=\"width:80px;\" value=\""+children_name1[n]+"\" maxlength=\"10\">";
											tCell = tRow.insertCell();
											tCell.className = "tdrow"; 
											tCell.innerHTML = "<input name=\"children_ssnb1_[]\" type=\"text\" class=\"textfm\" style=\"width:120px;\" value=\""+children_ssnb1[n]+"\" maxlength=\"14\">";
											tCell = tRow.insertCell();
											tCell.className = "tdrow"; 
											tCell.innerHTML = "<input name=\"children_cohabitation1_[]\" type=\"checkbox\" value=\"1\" "+children_checked1[n]+" class=\"checkbox\"> ����";
											tCell = tRow.insertCell();
											tCell.className = "tdrow"; 
											tCell.innerHTML = "<input name=\"children_relation2_[]\" type=\"text\" class=\"textfm\" style=\"width:80px;\" value=\""+children_relation2[n]+"\" maxlength=\"10\">";
											tCell = tRow.insertCell();
											tCell.className = "tdrow"; 
											tCell.innerHTML = "<input name=\"children_name2_[]\" type=\"text\" class=\"textfm\" style=\"width:80px;\" value=\""+children_name2[n]+"\" maxlength=\"10\">";
											tCell = tRow.insertCell();
											tCell.className = "tdrow"; 
											tCell.innerHTML = "<input name=\"children_ssnb2_[]\" type=\"text\" class=\"textfm\" style=\"width:120px;\" value=\""+children_ssnb2[n]+"\" maxlength=\"14\">";
											tCell = tRow.insertCell();
											tCell.className = "tdrow"; 
											tCell.innerHTML = "<input name=\"children_cohabitation2_[]\" type=\"checkbox\" value=\"1\" "+children_checked2[n]+" class=\"checkbox\"> ����";

											tRow = Tbl.insertRow();
											tCell = tRow.insertCell();
											tCell.className = "tdrow"; 
											tCell.innerHTML = "<input name=\"children_relation3_[]\" type=\"text\" class=\"textfm\" style=\"width:80px;\" value=\""+children_relation3[n]+"\" maxlength=\"10\">";
											tCell = tRow.insertCell();
											tCell.className = "tdrow"; 
											tCell.innerHTML = "<input name=\"children_name3_[]\" type=\"text\" class=\"textfm\" style=\"width:80px;\" value=\""+children_name3[n]+"\" maxlength=\"10\">";
											tCell = tRow.insertCell();
											tCell.className = "tdrow"; 
											tCell.innerHTML = "<input name=\"children_ssnb3_[]\" type=\"text\" class=\"textfm\" style=\"width:120px;\" value=\""+children_ssnb3[n]+"\" maxlength=\"14\">";
											tCell = tRow.insertCell();
											tCell.className = "tdrow"; 
											tCell.innerHTML = "<input name=\"children_cohabitation3_[]\" type=\"checkbox\" value=\"1\" "+children_checked3[n]+" class=\"checkbox\"> ����";
											tCell = tRow.insertCell();
											tCell.className = "tdrow"; 
											tCell.innerHTML = "<input name=\"children_relation4_[]\" type=\"text\" class=\"textfm\" style=\"width:80px;\" value=\""+children_relation4[n]+"\" maxlength=\"10\">";
											tCell = tRow.insertCell();
											tCell.className = "tdrow"; 
											tCell.innerHTML = "<input name=\"children_name4_[]\" type=\"text\" class=\"textfm\" style=\"width:80px;\" value=\""+children_name4[n]+"\" maxlength=\"10\">";
											tCell = tRow.insertCell();
											tCell.className = "tdrow"; 
											tCell.innerHTML = "<input name=\"children_ssnb4_[]\" type=\"text\" class=\"textfm\" style=\"width:120px;\" value=\""+children_ssnb4[n]+"\" maxlength=\"14\">";
											tCell = tRow.insertCell();
											tCell.className = "tdrow"; 
											tCell.innerHTML = "<input name=\"children_cohabitation4_[]\" type=\"checkbox\" value=\"1\" "+children_checked4[n]+" class=\"checkbox\"> ����";

											tRow = Tbl.insertRow();
											tCell = tRow.insertCell();
											tCell.className = "tdrow_end"; 
											tCell.innerHTML = "<input name=\"children_relation5_[]\" type=\"text\" class=\"textfm\" style=\"width:80px;\" value=\""+children_relation5[n]+"\" maxlength=\"10\">";
											tCell = tRow.insertCell();
											tCell.className = "tdrow_end"; 
											tCell.innerHTML = "<input name=\"children_name5_[]\" type=\"text\" class=\"textfm\" style=\"width:80px;\" value=\""+children_name5[n]+"\" maxlength=\"10\">";
											tCell = tRow.insertCell();
											tCell.className = "tdrow_end"; 
											tCell.innerHTML = "<input name=\"children_ssnb5_[]\" type=\"text\" class=\"textfm\" style=\"width:120px;\" value=\""+children_ssnb5[n]+"\" maxlength=\"14\">";
											tCell = tRow.insertCell();
											tCell.className = "tdrow_end"; 
											tCell.innerHTML = "<input name=\"children_cohabitation5_[]\" type=\"checkbox\" value=\"1\" "+children_checked5[n]+" class=\"checkbox\"> ����";
											tCell = tRow.insertCell();
											tCell.className = "tdrow_end"; 
											tCell.innerHTML = "<input name=\"children_relation6_[]\" type=\"text\" class=\"textfm\" style=\"width:80px;\" value=\""+children_relation6[n]+"\" maxlength=\"10\">";
											tCell = tRow.insertCell();
											tCell.className = "tdrow_end"; 
											tCell.innerHTML = "<input name=\"children_name6_[]\" type=\"text\" class=\"textfm\" style=\"width:80px;\" value=\""+children_name6[n]+"\" maxlength=\"10\">";
											tCell = tRow.insertCell();
											tCell.className = "tdrow_end"; 
											tCell.innerHTML = "<input name=\"children_ssnb6_[]\" type=\"text\" class=\"textfm\" style=\"width:120px;\" value=\""+children_ssnb6[n]+"\" maxlength=\"14\">";
											tCell = tRow.insertCell();
											tCell.className = "tdrow_end"; 
											tCell.innerHTML = "<input name=\"children_cohabitation6_[]\" type=\"checkbox\" value=\"1\" "+children_checked6[n]+" class=\"checkbox\"> ����";

											frm.join_count.value++;
											//alert(frm.join_count.value);
										} 
									}
									</script>

									<div id="join_add_div" style="display:none">
										<table border=0 cellspacing=0 cellpadding=0> 
											<tr> 
												<td id=""> 
													<table border=0 cellpadding=0 cellspacing=0> 
														<tr> 
															<td><img src="images/g_tab_on_lt.gif"></td> 
															<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
															�Ի���(�߰�)
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
									</div>
									<!--�˻� -->
									<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed" id="join_optable">
										<col width="10%">
										<col width="10%">
										<col width="20%">
										<col width="10%">
										<col width="10%">
										<col width="10%">
										<col width="20%">
										<col width="10%">
									</table>
					 
									<div style="height:5px;font-size:0px;line-height:0px;"></div>
									<table border=0 cellpadding=0 cellspacing=0 style=display:inline;>
										<tr>
											<td width=2></td>
											<td><img src="images/btn_lt.gif"></td>        
											<td background="images/btn_bg.gif" class=ftbutton1 nowrap><label onclick="join_plus(document.dataForm.join_count.value)" style="cursor:pointer">�Ի��� �߰�</label></td>
											<td><img src="images/btn_rt.gif"></td>
											<td width=2></td>
										</tr>
									</table>
									<div style="height:10px;font-size:0px;line-height:0px;"></div>

									<table border=0 cellspacing=0 cellpadding=0> 
										<tr> 
											<td style="background-color:#8db41d" valign="top"> 
												<table border=0 cellpadding=0 cellspacing=0> 
													<tr> 
														<td><img src="images/g_tab_on_lt.gif"></td> 
														<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
														�����
														</td> 
														<td><img src="images/g_tab_on_rt.gif"></td> 
													</tr> 
												</table> 
											</td> 
											<td width=2></td> 
											<td valign="bottom"> <input type="checkbox" name="quit_ok" value="1" class="checkbox" style="height:18px"> ����� �Է½� üũ���ֽʽÿ�.</td>  
										</tr> 
									</table>
									<div style="height:2px;font-size:0px" class="bgtr"></div>
									<div style="height:2px;font-size:0px;line-height:0px;"></div>
									<!--�˻� -->
									<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
										<col width="20%">
										<col width="30%">
										<col width="20%">
										<col width="30%">
										<tr>
											<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����<font color="red">*</font></td>
											<td nowrap class="tdrow">
												<input name="quit_name" type="text" class="textfm" style="width:100px;" value="<?=$row1['quit_name']?>" maxlength="25" onclick="quit_ok_func()">
												<input name="quit_code" type="hidden" value="<?=$row1['quit_code']?>">
												<select name="quit_sabun" class="selectfm" onchange="quit_name_change(this.value);">
													<option value="______________">����</option>
<?
//�������
$sql_sabun = " select * from pibohum_base where com_code='$com_code' ";
$result_sabun = sql_query($sql_sabun);
$sabun_array = "";
for($i=0; $row_sabun=sql_fetch_array($result_sabun); $i++) {
	$sabun = $row_sabun['sabun'];
	$sabun_name[$sabun] = $row_sabun['name'];
	$sql_sabun_opt = " select * from pibohum_base_opt where com_code='$com_code' and sabun = '$sabun' ";
	$row_sabun_opt = sql_fetch($sql_sabun_opt);
	$sql_sabun_opt2 = " select * from pibohum_base_opt2 where com_code='$com_code' and sabun = '$sabun' ";
	//$row_sabun_opt2 = sql_fetch($sql_sabun_opt2);

	//�ش翬���ӱ��Ѿ� 151103
	$now_year = date("Y");
	$sql_pay = " select * from pibohum_base_pay_h where com_code='$com_code' and sabun='$sabun' order by year desc, month desc ";
	//echo "//".$sql_pay;
	$result_pay = sql_query($sql_pay);
	$quit_sum_now = 0;
	$quit_sum_now_month = 0;
	$quit_3month = 0;
	$quit_3month_cnt = 0;
	$quit_sum_pre = 0;
	$quit_sum_pre_month = 0;
	for($i=0; $row_pay=sql_fetch_array($result_pay); $i++) {
		//echo "//year ".$row_pay['year'].".".$row_pay['month']."\n";
		if($row_pay['money_for_tax'] > 0) {
			if($i < 3) {
				$quit_3month += (int)$row_pay['money_for_tax'];
				$quit_3month_cnt++;
			}
			if($row_pay['year'] == $now_year) {
				$quit_sum_now += (int)$row_pay['money_for_tax'];
				$quit_sum_now_month++;
			} else if($row_pay['year'] == ($now_year-1)) {
				$quit_sum_pre += (int)$row_pay['money_for_tax'];
				$quit_sum_pre_month++;
			}
		}
	}
	if($quit_sum_now) $quit_sum_now = number_format($quit_sum_now);
	else $quit_sum_now = "";
	if($quit_3month) $quit_3month = number_format($quit_3month / $quit_3month_cnt);
	else $quit_3month = "";
	if($quit_sum_pre) $quit_sum_pre = number_format($quit_sum_pre);
	else $quit_sum_pre = "";
?>
													<option value='<?=$row_sabun['sabun']?>_<?=$row_sabun['name']?>_<?=$row_sabun['jumin_no']?>_<?=$row_sabun['out_day']?>_<?=$row_sabun_opt['emp_cel']?>_<?=$quit_sum_now?>_<?=$quit_sum_now_month?>_<?=$quit_3month?>_<?=$quit_sum_pre?>_<?=$quit_sum_pre_month?>'><?=$row_sabun['name']?> (<?=$row_sabun['in_day']?>)</option>
<?
	//��� ���� Select Box ���� ����
	$sabun_selectbox_quit[$sabun] = $row_sabun['sabun']."_".$row_sabun['name']."_".$row_sabun['jumin_no']."_".$row_sabun['out_day']."_".$row_sabun_opt['emp_cel']."_".$quit_sum_now."_".$quit_sum_now_month."_".$quit_3month."_".$quit_sum_pre."_".$quit_sum_pre_month;
	$sabun_quit_array .= "<option value='".$sabun_selectbox_quit[$sabun]."'>".$row_sabun['name']." (".$row_sabun['in_day'].")</option>";
}
?>
												</select>
											</td>
											<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�ֹε�Ϲ�ȣ<font color="red">*</font></td>
											<td nowrap class="tdrow">
												<input name="quit_ssnb" type="text" class="textfm" style="width:130px;" value="<?=$row1[quit_ssnb]?>" maxlength="14">
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">��ȭ��ȣ<font color="red">*</font></td>
											<td nowrap class="tdrow">
												<input name="quit_tel" type="text" class="textfm" style="width:100px;" value="<?=$row1[quit_tel]?>" maxlength="15"> ��) 055-1234-1234
											</td>
											<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�����<font color="red">*</font></td>
											<td nowrap class="tdrow">
												<input name="quit_date" type="text" class="textfm5" readonly style="width:80px;" value="<?=$quit_date?>" maxlength="25">
												<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.dataForm.quit_date);" target="">�޷�</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
												(������ �ٹ� ������)
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">��������<font color="red">*</font></td>
											<td nowrap class="tdrow" colspan="3">
											<?
											for($i=0; $i<=99; $i++) {
												//echo $row1[quit_cause];
												if($row1[quit_cause] == $i) $quit_cause_select[$i] = "selected";
												else $quit_cause_select[$i] = "";
											}
											?>
												<select name="quit_cause" class="selectfm">
													<option value="">�����ϼ���</option>
													<option value="11" <? if($row1[quit_cause] == "11") echo "selected"; ?>>���λ������� ���� �������</option>
													<option value="12" <? if($row1[quit_cause] == "12") echo "selected"; ?>>����� ����, �ٷ����Ǻ���, �ӱ�ü�� ������ �������</option>
													<option value="22" <? if($row1[quit_cause] == "22") echo "selected"; ?>>���, ����</option>
													<option value="23" <? if($row1[quit_cause] == "23") echo "selected"; ?>>�濵�� �ʿ� �� ȸ���Ȳ���� ���Ѱ��� � ���� ���(�Ǿ��޿�)</option>
													<option value="26" <? if($row1[quit_cause] == "26") echo "selected"; ?>>�ٷ����� ��å������ ���� ¡���ذ�</option>
													<option value="31" <? if($row1[quit_cause] == "31") echo "selected"; ?>>����</option>
													<option value="32" <? if($row1[quit_cause] == "32") echo "selected"; ?>>��ุ��, ��������</option>
													<option value="41" <? if($row1[quit_cause] == "41") echo "selected"; ?>>��뺸�� ������, ���߰��</option>
													<option value="98" <? if($row1[quit_cause] == "98") echo "selected"; ?>>�Ҹ����� �ϰ�����</option>
													<option value="99" <? if($row1[quit_cause] == "99") echo "selected"; ?>>���ٿ� ���� ����</option>
												</select>
												<!--, �ǰ���� ���� ������, �豹�� ��û 160603-->
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�������뿩��<font color="red">*</font></td>
											<td nowrap class="tdrow">
												<?
												//echo $row1[isgy];
												if($row1[quit_isgy] == "1") $quit_isgy_chk = "checked";
												else $quit_isgy_chk = "";
												if($row1[quit_issj] == "1") $quit_issj_chk = "checked";
												else $quit_issj_chk = "";
												if($row1[quit_iskm] == "1") $quit_iskm_chk = "checked";
												else $quit_iskm_chk = "";
												if($row1[quit_isgg] == "1") $quit_isgg_chk = "checked";
												else $quit_isgg_chk = "";
												?>
												<input type="checkbox" name="quit_isgy" value="1" class="checkbox" <?=$quit_isgy_chk?>>���
												<input type="checkbox" name="quit_issj" value="1" class="checkbox" <?=$quit_issj_chk?>>����
												<input type="checkbox" name="quit_iskm" value="1" class="checkbox" <?=$quit_iskm_chk?>>����
												<input type="checkbox" name="quit_isgg" value="1" class="checkbox" <?=$quit_isgg_chk?>>�ǰ�
											</td>
											<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�ش翬���ӱ��Ѿ�<font color="red">*</font></td>
											<td nowrap class="tdrow">
												<input name="quit_sum_now" type="text" class="textfm" style="width:130px;ime-mode:inactive;" onkeypress="only_number()" value="<?=$row1[quit_sum_now]?>" maxlength="25" onkeyup="checkThousand(this.value, '2','Y')"> ��������
												<input name="quit_sum_now_month" type="text" class="textfm" style="width:30px;ime-mode:inactive;" onkeypress="only_number()" value="<?=$row1[quit_sum_now_month]?>" maxlength="4"> 
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">������3������ ����ӱ�<font color="red"></font></td>
											<td nowrap class="tdrow">
												<input name="quit_3month" type="text" class="textfm" style="width:130px;ime-mode:inactive;" onkeypress="only_number()" value="<?=$row1[quit_3month]?>" maxlength="25" onkeyup="checkThousand(this.value, '3','Y')">
											</td>
											<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">���⵵�ӱ��Ѿ�<font color="red"></font></td>
											<td nowrap class="tdrow">
												<input name="quit_sum_pre" type="text" class="textfm" style="width:130px;ime-mode:inactive;" onkeypress="only_number()" value="<?=$row1[quit_sum_pre]?>" maxlength="25" onkeyup="checkThousand(this.value, '4','Y')"> ��������
												<input name="quit_sum_pre_month" type="text" class="textfm" style="width:30px;ime-mode:inactive;" onkeypress="only_number()" value="<?=$row1[quit_sum_pre_month]?>" maxlength="4"> 
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">÷������<font color="red"></font></td>
											<td class="tdrow">
												<input name="filename1" class="textfm_search" style="width: 220px;" type="file">
<?
if($row1[file1]) {
	$file_url = "<a href='./files/4insure/".$row1[file1]."'>".$row1[file1]."</a>";
}
?>
												<?=$file_url?>
											</td>
											<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">���<font color="red"></font></td>
											<td nowrap class="tdrow">
												<input name="quit_note" type="text" class="textfm" style="width:150px;" value="<?=$row1[quit_note]?>" maxlength="25">
											</td>
										</tr>
									</table>
									<div style="height:5px;font-size:0px;line-height:0px;"></div>

									<div id="quit_add_div" style="display:none">
									<table border="0" cellpadding="0" cellspacing="0"> 
										<tr> 
											<td id=""> 
												<table border="0" cellpadding="0" cellspacing="0"> 
													<tr> 
														<td><img src="images/g_tab_on_lt.gif"></td> 
														<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
														�����(�߰�)
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
								</div>
								<!--�˻� -->

								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed" id="quit_optable">
									<col width="20%">
									<col width="30%">
									<col width="20%">
									<col width="30%">
								</table>
				 
								<div style="height:5px;font-size:0px;line-height:0px;"></div>
								<table border="0" cellpadding="0" cellspacing="0" style="display:inline;">
									<tr>
										<td width=2></td>
										<td><img src="images/btn_lt.gif"></td>        
										<td background="images/btn_bg.gif" class=ftbutton1 nowrap><label onclick="quit_plus(document.dataForm.quit_count.value);" style="cursor:pointer">����� �߰�</label></td>
										<td><img src="images/btn_rt.gif"></td>
										<td width=2></td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px;line-height:0px;"></div>

								<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
									<tr>
										<td align="" style="padding-bottom:15px">
											�� 4�� ���� ��� ��� �Ű����<br>
											����� �ڷḦ �������� ���� �Ű������ �ѹ��� �ż��ϰ� ó��, 
											�ǰ���������� ��꺸��� �� ���ݰ��������� �ӱ��Ѿ� �Ű� ���� ó��
										</td>
									</tr>
									<tr>
										<td align="center">
<?
//���Ѻ� ��ũ��
if($member['mb_profile'] == "guest") {
	$url_save = "javascript:alert_demo();";
} else {
	//ó���Ϸ�� ���� ���� ���� �Ұ� ������ ��û 160225
	if($row1['conduct'] == "2") $url_save = "javascript:alert('ó���Ϸ�� ���� ���� ������ �Ұ����մϴ�.');";
	else $url_save = "javascript:checkData();";
	//$url_save = "javascript:checkData();";
}
?>

											<table border="0" cellpadding="0" cellspacing="0" style="display:inline;">
												<tr>
													<td width=2></td>
													<td><img src=images/btn_lt.gif></td>
													<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_save?>">�� ��</a></td>
													<td><img src=images/btn_rt.gif></td>
												 <td width=2></td>
												</tr>
											</table>
<?
if($w == "u") {
?>
											<table border="0" cellpadding="0" cellspacing="0" style="display:inline;">
												<tr>
													<td width=2></td>
													<td><img src=images/btn_lt.gif></td>
													<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="javascript:history.back();" target="">�� ��</a></td>
													<td><img src=images/btn_rt.gif></td>
												 <td width=2></td>
												</tr>
											</table>
<?
}
if(!$id) {
?>
											<table border="0" cellpadding="0" cellspacing="0" style="display:inline;">
											 <tr>
												 <td width=2></td>
													<td><img src=images/btn_lt.gif></td>
													<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="4insure_list.php" target="">�� ��</a></td>
													<td><img src=images/btn_rt.gif></td>
												 <td width=2></td>
												</tr>
											</table>
<?
} else {
?>
											<table border="0" cellpadding="0" cellspacing="0" style="display:inline;">
											 <tr>
												 <td width=2></td>
													<td><img src=images/btn_lt.gif></td>
													<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="staff_list_beistand.php?page=<?=$page?>" target="">�� ��</a></td>
													<td><img src=images/btn_rt.gif></td>
												 <td width=2></td>
												</tr>
											</table>
<?
}
?>
										</td>
									</tr>
								</table>
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
function quit_plus(n){
	var frm = document.dataForm;
	var quit_cause_option = "<option value=\"11\">���λ������� ���� �������</option><option value=\"12\">����� ����, �ٷ����Ǻ���, �ӱ�ü�� ������ �������</option><option value=\"22\">���, ����</option><option value=\"23\">�濵�� �ʿ� �� ȸ���Ȳ���� ���Ѱ��� � ���� ���(�Ǿ��޿�)</option><option value=\"26\">�ٷ����� ��å������ ���� ¡���ذ�, �ǰ����</option><option value=\"31\">����</option><option value=\"32\">��ุ��, ��������</option><option value=\"41\">��뺸�� ������, ���߰��</option><option value=\"98\">�Ҹ����� �ϰ�����</option><option value=\"99\">���ٿ� ���� ����</option>";
	if(frm.quit_count.value > 5) {
		alert("�ѹ��� �Ű��� �� �ִ� �ο��� 5����� �Դϴ�.");
		return false;
	} else { 
		document.getElementById('quit_add_div').style.display = "";
		var Tbl = document.getElementById('quit_optable'); 
		tRow = Tbl.insertRow();//tr �߰�
		tCell = tRow.insertCell();//td �߰�
		tCell.className = "tdrowk"; 
		tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">����<font color=\"red\">*</font>";
		tCell = tRow.insertCell();
		tCell.className = "tdrow"; 
		tCell.innerHTML = "<input name=\"quit_name_[]\" id=\"quit_name_"+n+"\" type=\"text\" class=\"textfm\" style=\"width:100px;\" value=\""+quit_name[n]+"\" maxlength=\"25\"><input name=\"quit_code_[]\" id=\"quit_code_"+n+"\" type=\"hidden\" value=\"\"> <select name=\"quit_sabun_[]\" class=\"selectfm\" onchange=\"quit_name_change_add("+n+", this.value);\"><option value=\"______________\">����</option><?=$sabun_quit_array?></select>";
		tCell = tRow.insertCell();
		tCell.className = "tdrowk"; 
		tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">�ֹε�Ϲ�ȣ<font color=\"red\">*</font>";
		tCell = tRow.insertCell();
		tCell.className = "tdrow"; 
		tCell.innerHTML = "<input name=\"quit_ssnb_[]\" id=\"quit_ssnb_"+n+"\" type=\"text\" class=\"textfm\" style=\"width:130px;\" value=\""+quit_ssnb[n]+"\" maxlength=\"14\">";

		tRow = Tbl.insertRow();
		tCell = tRow.insertCell();
		tCell.className = "tdrowk"; 
		tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">��ȭ��ȣ<font color=\"red\">*</font>";
		tCell = tRow.insertCell();
		tCell.className = "tdrow"; 
		tCell.innerHTML = "<input name=\"quit_tel_[]\" id=\"quit_tel_"+n+"\" type=\"text\" class=\"textfm\" style=\"width:100px;\" value=\""+quit_tel[n]+"\" maxlength=\"15\">";
		tCell = tRow.insertCell();
		tCell.className = "tdrowk"; 
		tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">�����<font color=\"red\">*</font>";
		tCell = tRow.insertCell();
		tCell.className = "tdrow"; 
		tCell.innerHTML = "<input name=\"quit_date_[]\" id=\"quit_date_"+n+"\" type=\"text\" class=\"textfm5\" readonly style=\"width:80px;\" value=\""+quit_date[n]+"\" maxlength=\"10\" onclick=\"loadCalendar(this);\"> �� <font color=\"red\">Ŭ���� �޷� ǥ��</font>";
		//�������� �߰��� selected
		var quit_cause_select11 = new Array();
		var quit_cause_select12 = new Array();
		var quit_cause_select22 = new Array();
		var quit_cause_select23 = new Array();
		var quit_cause_select25 = new Array();
		var quit_cause_select26 = new Array();
		var quit_cause_select31 = new Array();
		var quit_cause_select32 = new Array();
		var quit_cause_select41 = new Array();
		var quit_cause_select98 = new Array();
		var quit_cause_select99 = new Array();
<?
for($i=2; $i<=5; $i++) {
?>
		quit_cause[<?=$i?>] = "<?=$quit_cause[$i]?>";
		quit_cause_select11[<?=$i?>] = "";
		quit_cause_select12[<?=$i?>] = "";
		quit_cause_select22[<?=$i?>] = "";
		quit_cause_select23[<?=$i?>] = "";
		quit_cause_select25[<?=$i?>] = "";
		quit_cause_select26[<?=$i?>] = "";
		quit_cause_select31[<?=$i?>] = "";
		quit_cause_select32[<?=$i?>] = "";
		quit_cause_select41[<?=$i?>] = "";
		quit_cause_select98[<?=$i?>] = "";
		quit_cause_select99[<?=$i?>] = "";
		if(quit_cause[<?=$i?>] == "11") quit_cause_select11[<?=$i?>] = "selected";
		else if(quit_cause[<?=$i?>] == "12") quit_cause_select12[<?=$i?>] = "selected";
		else if(quit_cause[<?=$i?>] == "22") quit_cause_select22[<?=$i?>] = "selected";
		else if(quit_cause[<?=$i?>] == "23") quit_cause_select23[<?=$i?>] = "selected";
		else if(quit_cause[<?=$i?>] == "26") quit_cause_select26[<?=$i?>] = "selected";
		else if(quit_cause[<?=$i?>] == "31") quit_cause_select31[<?=$i?>] = "selected";
		else if(quit_cause[<?=$i?>] == "32") quit_cause_select32[<?=$i?>] = "selected";
		else if(quit_cause[<?=$i?>] == "41") quit_cause_select41[<?=$i?>] = "selected";
		else if(quit_cause[<?=$i?>] == "98") quit_cause_select98[<?=$i?>] = "selected";
		else if(quit_cause[<?=$i?>] == "99") quit_cause_select99[<?=$i?>] = "selected";
<?
}
?>
		tRow = Tbl.insertRow();
		tCell = tRow.insertCell();
		tCell.className = "tdrowk"; 
		tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">��������<font color=\"red\">*</font>";
		tCell = tRow.insertCell();
		tCell.className = "tdrow"; 
		tCell.colSpan = 3;
		tCell.innerHTML = "<select name=\"quit_cause_[]\" class=\"selectfm\" style=\"\"><option value=\"\">�����ϼ���</option><option value=\"11\" "+quit_cause_select11[n]+">���λ������� ���� �������</option><option value=\"12\" "+quit_cause_select12[n]+">����� ����, �ٷ����Ǻ���, �ӱ�ü�� ������ �������</option><option value=\"22\" "+quit_cause_select22[n]+">���, ����</option><option value=\"23\" "+quit_cause_select23[n]+">�濵�� �ʿ� �� ȸ���Ȳ���� ���Ѱ��� � ���� ���(�Ǿ��޿�)</option><option value=\"26\" "+quit_cause_select26[n]+">�ٷ����� ��å������ ���� ¡���ذ�..</option><option value=\"31\" "+quit_cause_select31[n]+">����</option><option value=\"32\" "+quit_cause_select32[n]+">��ุ��, ��������</option><option value=\"41\" "+quit_cause_select41[n]+">��뺸�� ������, ���߰��</option><option value=\"98\" "+quit_cause_select98[n]+">�Ҹ����� �ϰ�����</option><option value=\"99\" "+quit_cause_select99[n]+">���ٿ� ���� ����</option></select>";

		tRow = Tbl.insertRow();
		tCell = tRow.insertCell();
		tCell.className = "tdrowk"; 
		tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">�������뿩��<font color=\"red\">*</font>";
		tCell = tRow.insertCell();
		tCell.className = "tdrow"; 
		tCell.innerHTML = "<input type=\"checkbox\" name=\"quit_isgy_"+n+"\" value=\"1\" class=\"checkbox\" "+quit_isgy[n]+"> ��� <input type=\"checkbox\" name=\"quit_issj_"+n+"\" value=\"1\" class=\"checkbox\" "+quit_issj[n]+"> ���� <input type=\"checkbox\" name=\"quit_iskm_"+n+"\" value=\"1\" class=\"checkbox\" "+quit_iskm[n]+"> ���� <input type=\"checkbox\" name=\"quit_isgg_"+n+"\" value=\"1\" class=\"checkbox\" "+quit_isgg[n]+"> �ǰ�";
		tCell = tRow.insertCell();
		tCell.className = "tdrowk"; 
		tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">�ش翬���ӱ��Ѿ�<font color=\"red\">*</font>";
		tCell = tRow.insertCell();
		tCell.className = "tdrow"; 
		tCell.innerHTML = "<input name=\"quit_sum_now_[]\" id=\"quit_sum_now_"+n+"\" type=\"text\" class=\"textfm\" style=\"width:130px;ime-mode:inactive;\" onkeypress=\"only_number()\" value=\""+quit_sum_now[n]+"\" maxlength=\"25\" onkeyup=\"checkThousand(this.value, '2"+frm.quit_count.value+"','Y')\"> �������� <input name=\"quit_sum_now_month_[]\" id=\"quit_sum_now_month_"+n+"\" type=\"text\" class=\"textfm\" style=\"width:30px;ime-mode:inactive;\" onkeypress=\"only_number()\" value=\""+quit_sum_now_month[n]+"\" maxlength=\"2\">";

		tRow = Tbl.insertRow();
		tCell = tRow.insertCell();
		tCell.className = "tdrowk"; 
		tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">������3������ ����ӱ�<font color=\"red\"></font>";
		tCell = tRow.insertCell();
		tCell.className = "tdrow"; 
		tCell.innerHTML = "<input name=\"quit_3month_[]\" id=\"quit_3month_"+n+"\" type=\"text\" class=\"textfm\" style=\"width:130px;ime-mode:inactive;\" onkeypress=\"only_number()\" value=\""+quit_3month[n]+"\" maxlength=\"25\" onkeyup=\"checkThousand(this.value, '3"+frm.quit_count.value+"','Y')\">";
		tCell = tRow.insertCell();
		tCell.className = "tdrowk"; 
		tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">���⵵�ӱ��Ѿ�<font color=\"red\">*</font>";
		tCell = tRow.insertCell();
		tCell.className = "tdrow"; 
		tCell.innerHTML = "<input name=\"quit_sum_pre_[]\" id=\"quit_sum_pre_"+n+"\" type=\"text\" class=\"textfm\" style=\"width:130px;ime-mode:inactive;\" onkeypress=\"only_number()\" value=\""+quit_sum_pre[n]+"\" maxlength=\"25\" onkeyup=\"checkThousand(this.value, '4"+frm.quit_count.value+"','Y')\"> �������� <input name=\"quit_sum_pre_month_[]\" id=\"quit_sum_pre_month_"+n+"\" type=\"text\" class=\"textfm\" style=\"width:30px;ime-mode:inactive;\" onkeypress=\"only_number()\" value=\""+quit_sum_pre_month[n]+"\" maxlength=\"2\">";

		tRow = Tbl.insertRow();
		tCell = tRow.insertCell();
		tCell.className = "tdrowk_end"; 
		tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">÷������<font color=\"red\"></font>";
		tCell = tRow.insertCell();
		tCell.className = "tdrow_end"; 
		tCell.innerHTML = "<input name=\"filename"+n+"\" type=\"file\" class=\"textfm_search\" style=\"width:220px;\"><a href=\"./files/4insure/"+filename[n]+"\">"+filename[n]+"</a>";
		tCell = tRow.insertCell();
		tCell.className = "tdrowk_end"; 
		tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">���<font color=\"red\"></font>";
		tCell = tRow.insertCell();
		tCell.className = "tdrow_end"; 
		tCell.innerHTML = "<input name=\"quit_note_[]\" type=\"text\" class=\"textfm\" style=\"width:100%;\" value=\""+quit_note[n]+"\" maxlength=\"25\">";

		frm.quit_count.value++;
		//alert(frm.join_count.value);
	} 
}
//���� �Ű� ��� (���Ű�) 151112
function join_auto() {
<?
//�ٷ��� ���� ���� ���� �� ����
if($chk_data) {
	//���� ���� �迭 ó�� �޹� ����
	$chk_data_array = explode(",", $chk_data);
	$check_cnt = sizeof($chk_data_array);
	//�������� ī��Ʈ
	$modify_count = 0;
	for( $i=0 ; $i < $check_cnt ; $i++) {
		if($chk_data_array[$i]) $id = $chk_data_array[$i];
		$k = $i + 1;
		if($k == 1) {
			echo "join_name_change('".$sabun_selectbox_join[$id]."');";
		} else {
			echo "join_plus(document.dataForm.join_count.value);";
			echo "join_name_change_add(".$k.", '".$sabun_selectbox_join[$id]."');";
		}
	}
}
?>
}
//���� �Ű� ��� (��ǽŰ�) 151112
function quit_auto() {
<?
//�ٷ��� ���� ���� ���� �� ����
if($chk_data) {
	//���� ���� �迭 ó�� �޹� ����
	$chk_data_array = explode(",", $chk_data);
	$check_cnt = sizeof($chk_data_array);
	//�������� ī��Ʈ
	$modify_count = 0;
	for( $i=0 ; $i < $check_cnt ; $i++) {
		if($chk_data_array[$i]) $id = $chk_data_array[$i];
		$k = $i + 1;
		if($k == 1) {
			echo "quit_name_change('".$sabun_selectbox_quit[$id]."');";
		} else {
			echo "quit_plus(document.dataForm.quit_count.value);";
			echo "quit_name_change_add(".$k.", '".$sabun_selectbox_quit[$id]."');";
		}
	}
}
?>
}
<?
//������ �ε� �� �Լ� ȣ��
if($mode == "in") echo "addLoadEvent(join_auto);";
else if($mode == "out") echo "addLoadEvent(quit_auto);";
?>
</script>
</body>
</html>
