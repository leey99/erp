<?
$sub_menu = "1500100";
include_once("./_common.php");

$sql_common = " from policy_fund a, policy_fund_opt b ";

//echo $member[mb_profile];
if($is_admin != "super") {
	$stx_man_cust_name = $member[mb_profile];
}
$is_admin = "super";
//echo $is_admin;
$sql_search = " where a.id=b.id and a.id='$id' ";

if (!$sst) {
    $sst = "a.id";
    $sod = "desc";
}

$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";

//echo $sql;
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = 20;
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���

if (!$page) $page = 1; // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����

$top_sub_title = "images/top15_01.gif";
$sub_title = "��å�ڱ��Ƿ�";
$g4[title] = $sub_title." : ��å�ڱ� : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order ";
//echo $sql;
$result = sql_query($sql);
//echo $row[id];

$colspan = 11;

if($w == "u") {
	$row=mysql_fetch_array($result);
	//�����DB �ɼ�
	$sql_opt = " select * from policy_fund_opt where id='$id' ";
	//echo $sql1;
	$result_opt = sql_query($sql_opt);
	$row_opt=mysql_fetch_array($result_opt);
}
//echo $row[id];
//�˻� �Ķ���� ����
$qstr = "stx_comp_name=".$stx_comp_name."&stx_upjong=".$stx_upjong."&stx_boss_name=".$stx_boss_name."&stx_t_no=".$stx_t_no."&stx_comp_tel=".$stx_comp_tel."&stx_comp_juso=".$stx_comp_juso."&stx_attend=".$stx_attend;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px;background-color:#f7fafd">
<script src="./js/jquery-1.8.0.min.js" type="text/javascript" charset="euc-kr"></script>
<script language="javascript">
function checkID()
{
	var frm = document.dataForm;
	if (frm.comp_bznb.value == "")
	{
		alert("����ڹ�ȣ�� �Է��ϼ���.");
		frm.comp_bznb.focus();
		return;
	}
	var ret = window.open("./common/member_idcheck.php?user_id="+frm.comp_bznb.value, "id_check", "top=100, left=100, width=395,height=240");
	return;
}
function checkAddress(strgbn)
{
	//var ret = window.open("./common/member_address.php?frm_name=dataForm&frm_zip1=adr_zip1&frm_zip2=adr_zip2&frm_addr1=adr_adr1&frm_addr2=adr_adr2", "address", "top=100, left=100, width=410,height=285, scrollbars");
	var ret = window.open("../road_address/search.php", "address", "width=496,height=522,scrollbars=0");
	return;
}
function id_copy() {
	var frm = document.dataForm;
	frm.user_id.value = frm.comp_bznb.value;
}
function checkData() {
	var frm = document.dataForm;
	var rv = 0;
	if (frm.writer.value == "")
	{
		alert("������ȭ�ڸ� �Է��ϼ���.");
		frm.writer.focus();
		return;
	}
	if (frm.com_name.value == "")
	{
		alert("��ȣ�� �Է��ϼ���.");
		frm.com_name.focus();
		return;
	}
	if (frm.regdt.value == "")
	{
		alert("������ڸ� �Է��ϼ���.");
		frm.regdt.focus();
		return;
	}
	if (frm.boss_name.value == "")
	{
		alert("��ǥ�ڸ��� �Է��ϼ���.");
		frm.boss_name.focus();
		return;
	}
	if (frm.upjong.value == "")
	{
		alert("������ �Է��ϼ���.");
		frm.upjong.focus();
		return;
	}
	if (frm.com_tel1.value == "")
	{
		alert("��ȭ��ȣ�� �Է��ϼ���.");
		frm.com_tel1.focus();
		return;
	}
	if (frm.com_tel2.value == "")
	{
		alert("��ȭ��ȣ�� �Է��ϼ���.");
		frm.com_tel2.focus();
		return;
	}
	if (frm.com_tel3.value == "")
	{
		alert("��ȭ��ȣ�� �Է��ϼ���.");
		frm.com_tel3.focus();
		return;
	}
/*
	if (frm.cust_cel1.value == "")
	{
		alert("�ڵ����� �Է��ϼ���.");
		frm.cust_cel1.focus();
		return;
	}
	if (frm.cust_cel2.value == "")
	{
		alert("�ڵ����� �Է��ϼ���.");
		frm.cust_cel2.focus();
		return;
	}
	if (frm.cust_cel3.value == "")
	{
		alert("�ڵ����� �Է��ϼ���.");
		frm.cust_cel3.focus();
		return;
	}
*/
	if (frm.adr_zip1.value == "") {
		alert("�ּҸ� �Է��ϼ���.");
		return;
	}
	frm.action = "policy_fund_update.php";
	frm.submit();
	return;
}
function radio_chk(x,t){
	var count=0;
	for(i=0;i<x.length;i++){
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
function only_number() {
	if (event.keyCode < 48 || event.keyCode > 57) {
		event.returnValue = false;
	}
}
function only_number_hyphen() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if(event.keyCode != 45) event.returnValue = false;
	}
}
function only_number_comma() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if(event.keyCode != 46) event.returnValue = false;
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
function open_upjong(n) {
	window.open("popup/upjong_popup.php?n=_"+n, "upjong_popup", "width=540, height=706, toolbar=no, menubar=no, scrollbars=no, resizable=no" );
}
function findNomu() {
	var ret = window.open("pop_manage_cust.php", "pop_nomu_cust", "top=100, left=100, width=800,height=600, scrollbars");
	return;
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
		//�齺���̽�Ű ����
		if(event.keyCode != 8) {
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
				if ( type =='1' ) {
					main.comp_bznb.value=total;					// type �� ���� �������� �־� �ش�.
				}
				else if ( type =='2' ) {
					main.user_id.value=total;					// type �� ���� �������� �־� �ش�.
				}
			}else if(keydown =='N'){
				return total
			}
		}
		return total
	}
}
function delhyphen(inputVal, count){
	var tmp = "";
	for(i=0; i<count; i++){
		if(inputVal.substring(i,i+1)!='-'){		// ���� substring�� ����
			tmp += inputVal.substring(i,i+1);	// ���� ��� , �� ����
		}
	}
	return tmp;
}
//����/������
function only_number_english() {
	if (event.keyCode < 48 || (event.keyCode > 57 && event.keyCode < 97) || (event.keyCode > 122)) event.returnValue = false;
}
//����Խ��� �Է� �޸�
function checkcomma(inputVal, type, keydown) {		// inputVal�� õ������ , ǥ�ø� ���� �������� ��
	var main = document.dataForm;			// ���⼭ type �� �ش��ϴ� ���� �ֱ� ���� ��ġ���� index
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
	if(1 == 1) { // ��� ����
		//�齺���̽�Ű ����
		if(event.keyCode != 8) {
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
				type.value=total;
			}else if(keydown =='N'){
				return total
			}
		}
		return total
	}
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
function pay_day_last_chk(val) {
	var main = document.dataForm;
	if(val.checked == true) {
		if(main.pay_day.value != "") main.pay_day_old.value = main.pay_day.value;
		main.pay_day.value = "";
	} else {
		//alert(main.pay_day_old.value);
		main.pay_day.value = main.pay_day_old.value;
	}
}
//���ε�Ϲ�ȣ �Է� ������
function checkhyphen_bupin_no(inputVal, type, keydown) {		// inputVal�� õ������ , ǥ�ø� ���� �������� ��
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
		//�齺���̽�Ű ����
		if(event.keyCode != 8) {
			//alert(inputVal.length);
			//alert(input);
			if(inputVal.length == 6){
				//input = delhyphen(inputVal, inputVal.length);
				total += input.substring(0,6)+"-";
			} else {
				total += inputVal;
			}
			if(keydown =='Y'){
				if ( type =='1' ) {
					main.bupin_no.value=total;					// type �� ���� �������� �־� �ش�.
				}
				else if ( type =='2' ) {
					main.jumin_no.value=total;					// type �� ���� �������� �־� �ش�.
				}
			}else if(keydown =='N'){
				return total
			}
		}
		return total
	}
}
function tab_view(tab) {
	var obj = document.getElementById(tab);
	if(obj.style.display == "none") {
		obj.style.display = "";
	} else {
		obj.style.display = "none";
	}
}
//õ���� �޹�
function checkThousand(inputVal, type, keydown) {
	main = document.dataForm;
	var chk		= 0;
	var share	= 0;
	var start	= 0;
	var triple	= 0;
	var end		= 0;
	var total	= "";			
	var input	= "";
	//�� ����Ʈ+�� �� �� Home
	if(event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=36) {
		if (inputVal.length > 3) {
			input = delCom(inputVal, inputVal.length);
			chk = (input.length)/3;
			chk = Math.floor(chk);
			share = (input.length)%3;
			if (share == 0 ) {						
				chk = chk - 1;
			}
			for(i=chk; i>0; i--) {
				triple = i * 3;
				end = Number(input.length)-Number(triple);
				total += input.substring(start,end)+",";
				start = end;
			}
			total +=input.substring(start,input.length);
		} else {
			total = inputVal;
		}
		if(keydown =='Y') {
			type.value=total;
		}else if(keydown =='N') {
			return total
		}
		return total
	}
}
function delCom(inputVal, count) {
	var tmp = "";
	for(i=0; i<count; i++) {
		if(inputVal.substring(i,i+1)!=',') {
			tmp += inputVal.substring(i,i+1);
		}
	}
	return tmp;
}
function writer_onchange(obj) {
	var main = document.dataForm;
	if(obj.value == 1) main.writer_tel.value = "070-4680-7041";
	else if(obj.value == 2) main.writer_tel.value = "070-4680-0331";
	else if(obj.value == 3) main.writer_tel.value = "051-921-5255";
	else if(obj.value == 4) main.writer_tel.value = "055-388-8805";
	else if(obj.value == 5) main.writer_tel.value = "063-461-4747";
	else if(obj.value == 6) main.writer_tel.value = "053-292-4117";
	//�����
	else if(obj.value == 110) main.writer_tel.value = "070-4680-7041";
	//�ӿ���
	else if(obj.value == 122) main.writer_tel.value = "070-4808-0331";
	//�ֵ�ȯ
	else if(obj.value == 2001) main.writer_tel.value = "051-921-5255";
	//Ȳ���
	else if(obj.value == 2002) main.writer_tel.value = "051-921-5255";
	//�籹��
	else if(obj.value == 3501) main.writer_tel.value = "055-388-8805";
	//������
	else if(obj.value == 3601) main.writer_tel.value = "063-461-4747";
	//����ö
	else if(obj.value == 1001) main.writer_tel.value = "053-292-4117";
	//��켮
	else if(obj.value == 25) main.writer_tel.value = "070-7405-2661";
	//�̹���
	else if(obj.value == 1602) main.writer_tel.value = "010-3116-3124";
	//�����
	else if(obj.value == 2301) main.writer_tel.value = "055-245-0337";
}
function field_add(div_id) {
	var v2 = document.getElementById(div_id+'2');
	var v3 = document.getElementById(div_id+'3');
	var v4 = document.getElementById(div_id+'4');
	if(v2.style.display == "none") {
		v2.style.display = "";
	} else {
		if(v3.style.display == "none") {
			v3.style.display = "";
		} else {
			if(v4.style.display == "none") {
				v4.style.display = "";
			} else {
				alert("�ִ� 8������ �߰� �����մϴ�.");
			}
		}
	}
}
</script>
<script src="https://spi.maps.daum.net/imap/map_js_init/postcode.js"></script>
<script>
	function openDaumPostcode(zip1,zip2,addr1,addr2) {
    new daum.Postcode({
        oncomplete: function(data) {
            frm = document.dataForm;
						frm[zip1].value = data.postcode1;
						frm[zip2].value = data.postcode2;
						frm[addr1].value = data.address;
						frm[addr2].focus();
        }
    }).open();
	}
</script>
<?
include "inc/top.php";
?>
					<td onmouseover="showM('900')" valign="top">
						<div style="margin:10px 20px 20px 20px;min-height:480px;">
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td width="100"><img src="images/top15.gif" border="0"></td>
									<td width=""><img src="<?=$top_sub_title?>" border="0"></td>
									<td></td>
								</tr>
								<tr><td height="1" bgcolor="#cccccc" colspan="3"></td></tr>
							</table>
							<table width="900" border="0" align="left" cellpadding="0" cellspacing="0" >
								<tr>
									<td valign="top" style="padding:10px 0 0 0">
										<!--Ÿ��Ʋ -->	

							<!--��޴� -->
							<table border=0 cellspacing=0 cellpadding=0 style=""> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
												����� �⺻����
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
							
							<form name="dataForm" method="post" enctype="MULTIPART/FORM-DATA">
							<input type="hidden" name="w" value="<?=$w?>">
							<input type="hidden" name="com_code" value="<?=$row['com_code']?>">
							<!-- �Է��� -->
							<table width="100%" height="200" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
								<tr>
									<td nowrap class="tdrowk" width="90"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">������ȭ��<font color="red">*</font></td>
									<td nowrap  class="tdrow" width="176">
										<select name="writer" class="selectfm" onchange="writer_onchange(this)">
											<option value="">����</option>
											<option value="110" <? if($row['writer'] == 110) echo "selected"; ?>><?=$writer_arry_policy[110]?></option>
											<option value="122" <? if($row['writer'] == 122) echo "selected"; ?>><?=$writer_arry_policy[122]?></option>
											<option value="2002" <? if($row['writer'] == 2002) echo "selected"; ?>><?=$writer_arry_policy[2002]?></option>
											<option value="3501" <? if($row['writer'] == 3501) echo "selected"; ?>><?=$writer_arry_policy[3501]?></option>
											<option value="3601" <? if($row['writer'] == 3601) echo "selected"; ?>><?=$writer_arry_policy[3601]?></option>
											<option value="1001" <? if($row['writer'] == 1001) echo "selected"; ?>><?=$writer_arry_policy[1001]?></option>
											<option value="25" <? if($row['writer'] == 25) echo "selected"; ?>><?=$writer_arry_policy[25]?></option>
											<option value="1602" <? if($row['writer'] == 1602) echo "selected"; ?>><?=$writer_arry_policy[1602]?></option>
											<option value="2301" <? if($row['writer'] == 2301) echo "selected"; ?>><?=$writer_arry_policy[2301]?></option>
										</select>
										<input name="writer_tel" type="text" class="textfm5" style="width:94px;ime-mode:disabled;" value="<?=$row['writer_tel']?>" maxlength="10" onKeyPress="" onkeyup="">
									</td>
									<td nowrap class="tdrowk" width="96"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">������<font color="red">*</font></td>
									<td nowrap  class="tdrow" width="210">
										<input name="com_name" type="text" class="textfm" style="width:100%;ime-mode:active;" value="<?=$row['com_name']?>" maxlength="50">
									</td>
									<td nowrap class="tdrowk" width="96"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�������<font color="red"></font></td>
									<td nowrap  class="tdrow" width="">
<?
if($row['upche_div'] == "1") {
	$chk_comp_type1 = "checked";
	$comp_type_text = "����";
} else if($row[upche_div] == "2") {
	$chk_comp_type2 = "checked";
	$comp_type_text = "����";
} else if($row[upche_div] == "3") {
	$chk_comp_type3 = "checked";
	$comp_type_text = "����";
}
?>
										<input type="radio" name="comp_type" value="1" <?=$chk_comp_type1?>>����
										<input type="radio" name="comp_type" value="2" <?=$chk_comp_type2?>>����
										<input type="radio" name="comp_type" value="3" <?=$chk_comp_type3?>>����
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�������<font color="red">*</font></td>
									<td nowrap  class="tdrow" width="">
										<input name="regdt" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row['regdt']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
										<table border='0' cellpadding='0' cellspacing='0' style="vertical-align:middle;display:inline;"><tr><td width='2'></td><td><img src=./images/btn2_lt.gif></td><td background="./images/btn2_bg.gif" class=ftbutton3_white nowrap><a href="javascript:loadCalendar(document.dataForm.regdt);" target="">�޷�</a></td><td><img src="./images/btn2_rt.gif"></td> <td width=2></td></tr></table>
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��ǥ�ڸ�<font color="red">*</font></td>
									<td nowrap  class="tdrow">
										<input name="boss_name" type="text" class="textfm" style="width:150px;ime-mode:active;" value="<?=$row['boss_name']?>" maxlength="25">
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�ֹε�Ϲ�ȣ</td>
									<td nowrap class="tdrow">
										<input name="jumin_no" type="text" class="textfm" style="width:120px;ime-mode:disabled;" value="<?=$row['jumin_no']?>" maxlength="14"  onkeypress="only_number_hyphen()" onkeyup="checkhyphen_bupin_no(this.value, '2','Y')">
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����<font color="red">*</font></td>
									<td nowrap  class="tdrow">
										<input name="upjong" type="text" class="textfm" style="width:100%;" value="<?=$row['upjong']?>" maxlength="12" onkeypress="" onkeyup="">
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��ȭ��ȣ<font color="red">*</font></td>
									<td nowrap  class="tdrow">
<?
$com_tel = explode("-",$row['com_tel']);
$com_tel1 = $com_tel[0];
$sel_cust_tel1 = array();
$sel_cust_tel1[$com_tel1] = "selected";
$com_tel2 = $com_tel[1];
$com_tel3 = $com_tel[2];
?>
									<select name="com_tel1" class="selectfm">
									<option value="">����</option>
										<option value="02"  <?=$sel_cust_tel1['02']?> >02</option>
										<option value="031" <?=$sel_cust_tel1['031']?>>031</option>
										<option value="032" <?=$sel_cust_tel1['032']?>>032</option>
										<option value="033" <?=$sel_cust_tel1['033']?>>033</option>
										<option value="041" <?=$sel_cust_tel1['041']?>>041</option>
										<option value="042" <?=$sel_cust_tel1['042']?>>042</option>
										<option value="043" <?=$sel_cust_tel1['043']?>>043</option>
										<option value="044" <?=$sel_cust_tel1['044']?>>044</option>
										<option value="051" <?=$sel_cust_tel1['051']?>>051</option>
										<option value="052" <?=$sel_cust_tel1['052']?>>052</option>
										<option value="053" <?=$sel_cust_tel1['053']?>>053</option>
										<option value="054" <?=$sel_cust_tel1['054']?>>054</option>
										<option value="055" <?=$sel_cust_tel1['055']?>>055</option>
										<option value="061" <?=$sel_cust_tel1['061']?>>061</option>
										<option value="062" <?=$sel_cust_tel1['062']?>>062</option>
										<option value="063" <?=$sel_cust_tel1['063']?>>063</option>
										<option value="064" <?=$sel_cust_tel1['064']?>>064</option>
										<option value="070" <?=$sel_cust_tel1['070']?>>070</option>
										<option value="000" <?=$sel_cust_tel1['000']?>>��ĭ</option>
										<option value="010" <?=$sel_cust_tel1['010']?>>010</option>
										<option value="011" <?=$sel_cust_tel1['011']?>>011</option>
										<option value="016" <?=$sel_cust_tel1['016']?>>016</option>
										<option value="017" <?=$sel_cust_tel1['017']?>>017</option>
										<option value="018" <?=$sel_cust_tel1['018']?>>018</option>
										<option value="019" <?=$sel_cust_tel1['019']?>>019</option>
									</select>
										-
										<input name="com_tel2" type="text" class="textfm" style="width:35;ime-mode:disabled;" value="<?=$com_tel2?>" maxlength="4" onKeyPress="onlyNumber();">
										-
										<input name="com_tel3" type="text" class="textfm" style="width:35;ime-mode:disabled;" value="<?=$com_tel3?>" maxlength="4" onKeyPress="onlyNumber();">
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�ڵ���<font color="red"></font></td>
									<td nowrap  class="tdrow">
<?
$cust_cel = explode("-",$row['com_hp']);
$cust_cel1 = $cust_cel[0];
//echo $cust_cel1;
$sel_cust_cel1 = array();
$sel_cust_cel1[$cust_cel1] = "selected";
//echo $sel_cust_cel1[$cust_cel1];
$cust_cel2 = $cust_cel[1];
$cust_cel3 = $cust_cel[2];
?>
										<select name="cust_cel1" class="selectfm">
											<option value="">����</option>
											<option value="010" <?=$sel_cust_cel1['010']?>>010</option>
											<option value="011" <?=$sel_cust_cel1['011']?>>011</option>
											<option value="016" <?=$sel_cust_cel1['016']?>>016</option>
											<option value="017" <?=$sel_cust_cel1['017']?>>017</option>
											<option value="018" <?=$sel_cust_cel1['018']?>>018</option>
											<option value="019" <?=$sel_cust_cel1['019']?>>019</option>
											<option value="070" <?=$sel_cust_cel1['070']?>>070</option>
										</select>
										-
										<input name="cust_cel2" type="text" class="textfm" style="width:35px;ime-mode:disabled;" value="<?=$cust_cel2?>" maxlength="4" onKeyPress="onlyNumber();">
										-
										<input name="cust_cel3" type="text" class="textfm" style="width:35px;ime-mode:disabled;" value="<?=$cust_cel3?>" maxlength="4" onKeyPress="onlyNumber();">
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk" rowspan="3"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�ּ�<font color="red">*</font></td>
									<td nowrap  class="tdrow" rowspan="3" colspan="3">
<?
$adr_zip = explode("-",$row['com_postno']);
?>
										<input name="adr_zip1" type="text" class="textfm" style="width:30px;" value="<?=$adr_zip[0]?>" >
										-
										<input name="adr_zip2" type="text" class="textfm" style="width:30px;" value="<?=$adr_zip[1]?>" >
										<table border=0 cellpadding=0 cellspacing=0 style="display:inline;vertical-align:middle"><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:openDaumPostcode('adr_zip1','adr_zip2','adr_adr1','adr_adr2');" target="">�ּ�ã��</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table>
										<br>
										<input name="adr_adr1" type="text" class="textfm" style="width:450px;" value="<?=$row['com_juso']?>" >
										<br>
										<input name="adr_adr2" type="text" class="textfm" style="width:450px;" value="<?=$row['com_juso2']?>" maxlength="150">
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����</td>
									<td nowrap  class="tdrow">
										<input name="area" type="text" class="textfm" style="width:120px;" value="<?=$row[area]?>" maxlength="50">
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��������</td>
									<td nowrap  class="tdrow">
										<select name="reg_factory" class="selectfm" onchange="">
											<option value="">����</option>
											<option value="1" <? if($row['reg_factory'] == 1) echo "selected"; ?>>��</option>
											<option value="2" <? if($row['reg_factory'] == 2) echo "selected"; ?>>��</option>
										</select>
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�ſ���</td>
									<td nowrap  class="tdrow">
										������
										<input name="credit_com" type="text" class="textfm" style="width:50px;ime-mode:disabled;" value="<?=$row['credit_com']?>" maxlength="12">
										���ε��
										<input name="credit_per" type="text" class="textfm" style="width:50px;ime-mode:disabled;" value="<?=$row['credit_per']?>" maxlength="12">
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">������Ȳ<font color="red"></font></td>
									<td nowrap  class="tdrow">
										<select name="property" class="selectfm" onchange="" style="width:60px">
											<option value="">����</option>
											<option value="1" <? if($row['property'] == 1) echo "selected"; ?>>�ڰ�</option>
											<option value="2" <? if($row['property'] == 2) echo "selected"; ?>>�Ӵ�</option>
											<option value="3" <? if($row['property'] == 3) echo "selected"; ?>>����</option>
											<option value="4" <? if($row['property'] == 4) echo "selected"; ?>>��Ÿ</option>
										</select>
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�Ӵ볻��<font color="red"></font></td>
									<td nowrap  class="tdrow">
										����
										<input name="charter" type="text" class="textfm" style="width:70px;" value="<?=$row['charter']?>" maxlength="12">
										����
										<input name="rent_month" type="text" class="textfm" style="width:70px;" value="<?=$row['rent_month']?>" maxlength="12">
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���<font color="red"></font></td>
									<td nowrap  class="tdrow">
										����
										<input name="area_site" type="text" class="textfm" style="width:35px;" value="<?=$row['area_site']?>" maxlength="6">
										���๰
										<input name="area_building" type="text" class="textfm" style="width:35px;" value="<?=$row['area_building']?>" maxlength="6">
										����
										<input name="area_facility" type="text" class="textfm" style="width:35px;" value="<?=$row['area_facility']?>" maxlength="6">
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���޸�</td>
									<td nowrap  class="tdrow" colspan="5">
										<textarea name="memo" class="textfm" style='width:100%;height:70px;word-break:break-all;' itemname="����" required><?=$row[memo]?></textarea>
									</td>
								</tr>
							</table>

							<div style="height:10px;font-size:0px"></div>
							<!--��޴� -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100px;text-align:center'> 
													����� ���⳻��
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

							<!-- �Է��� -->
							<table width="100%" height="100" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layput:fixed">
								<tr>
									<td nowrap class="tdrowk_center" width="96" rowspan="4">���<br>���⳻��</td>
									<td nowrap class="tdrowk_center" width="">�ְ�</td>
									<td nowrap class="tdrowk_center" width="108">�⺸</td>
									<td nowrap class="tdrowk_center" width="108">�ź�</td>
									<td nowrap class="tdrowk_center" width="108">�������</td>
									<td nowrap class="tdrowk_center" width="108">������</td>
									<td nowrap class="tdrowk_center" width="108">���ڱ�</td>
									<td nowrap class="tdrowk_center" width="108">���ڱ�</td>
									<td nowrap class="tdrowk_center" width="108">�߱�û</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk_center">����</td>
									<td nowrap class="tdrow_center" width="">
										<input name="bank_1" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['bank_1']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="bank_2" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['bank_2']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="bank_3" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['bank_3']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="bank_4" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['bank_4']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="bank_5" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['bank_5']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="bank_6" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['bank_6']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="bank_7" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['bank_7']?>" maxlength="12">
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk_center">�ݾ�</td>
									<td nowrap class="tdrow_center" width="">
										<input name="amount_1" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['amount_1']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="amount_2" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['amount_2']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="amount_3" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['amount_3']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="amount_4" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['amount_4']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="amount_5" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['amount_5']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="amount_6" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['amount_6']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="amount_7" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['amount_7']?>" maxlength="12">
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk_center">�ݸ�</td>
									<td nowrap class="tdrow_center" width="">
										<input name="interst_1" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['interst_1']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="interst_2" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['interst_2']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="interst_3" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['interst_3']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="interst_4" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['interst_4']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="interst_5" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['interst_5']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="interst_6" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['interst_6']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="interst_7" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['interst_7']?>" maxlength="12">
									</td>
								</tr>
							</table>

							<div style="height:4px;font-size:0px"></div>

							<!-- �Է��� -->
							<table width="100%" height="100" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layput:fixed">
								<tr>
									<td nowrap class="tdrowk_center" width="96" rowspan="6">������<br>���⳻��</td>
									<td nowrap class="tdrowk_center">����</td>
									<td nowrap class="tdrow_center" width="">
										<input name="lend_bank_1" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['lend_bank_1']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="lend_bank_2" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['lend_bank_2']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="lend_bank_3" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['lend_bank_3']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="lend_bank_4" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['lend_bank_4']?>" maxlength="12">
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk_center">���ⱸ��</td>
									<td nowrap class="tdrow_center" width="">
										<select name="lend_kind_1" class="selectfm" onchange="" style="width:100%">
											<option value="">����</option>
											<option value="1" <? if($row_opt['lend_kind_1'] == 1) echo "selected"; ?>>�ü�</option>
											<option value="2" <? if($row_opt['lend_kind_1'] == 2) echo "selected"; ?>>����</option>
											<option value="3" <? if($row_opt['lend_kind_1'] == 3) echo "selected"; ?>>����</option>
											<option value="4" <? if($row_opt['lend_kind_1'] == 4) echo "selected"; ?>>����</option>
											<option value="5" <? if($row_opt['lend_kind_1'] == 5) echo "selected"; ?>>�����ڱ�</option>
											<option value="6" <? if($row_opt['lend_kind_1'] == 6) echo "selected"; ?>>��Ÿ</option>
										</select>
									</td>
									<td nowrap class="tdrow_center" width="">
										<select name="lend_kind_2" class="selectfm" onchange="" style="width:100%">
											<option value="">����</option>
											<option value="1" <? if($row_opt['lend_kind_2'] == 1) echo "selected"; ?>>�ü�</option>
											<option value="2" <? if($row_opt['lend_kind_2'] == 2) echo "selected"; ?>>����</option>
											<option value="3" <? if($row_opt['lend_kind_2'] == 3) echo "selected"; ?>>����</option>
											<option value="4" <? if($row_opt['lend_kind_2'] == 4) echo "selected"; ?>>����</option>
											<option value="5" <? if($row_opt['lend_kind_2'] == 5) echo "selected"; ?>>�����ڱ�</option>
											<option value="6" <? if($row_opt['lend_kind_2'] == 6) echo "selected"; ?>>��Ÿ</option>
										</select>
									</td>
									<td nowrap class="tdrow_center" width="">
										<select name="lend_kind_3" class="selectfm" onchange="" style="width:100%">
											<option value="">����</option>
											<option value="1" <? if($row_opt['lend_kind_3'] == 1) echo "selected"; ?>>�ü�</option>
											<option value="2" <? if($row_opt['lend_kind_3'] == 2) echo "selected"; ?>>����</option>
											<option value="3" <? if($row_opt['lend_kind_3'] == 3) echo "selected"; ?>>����</option>
											<option value="4" <? if($row_opt['lend_kind_3'] == 4) echo "selected"; ?>>����</option>
											<option value="5" <? if($row_opt['lend_kind_3'] == 5) echo "selected"; ?>>�����ڱ�</option>
											<option value="6" <? if($row_opt['lend_kind_3'] == 6) echo "selected"; ?>>��Ÿ</option>
										</select>
									</td>
									<td nowrap class="tdrow_center" width="">
										<select name="lend_kind_4" class="selectfm" onchange="" style="width:100%">
											<option value="">����</option>
											<option value="1" <? if($row_opt['lend_kind_4'] == 1) echo "selected"; ?>>�ü�</option>
											<option value="2" <? if($row_opt['lend_kind_4'] == 2) echo "selected"; ?>>����</option>
											<option value="3" <? if($row_opt['lend_kind_4'] == 3) echo "selected"; ?>>����</option>
											<option value="4" <? if($row_opt['lend_kind_4'] == 4) echo "selected"; ?>>����</option>
											<option value="5" <? if($row_opt['lend_kind_4'] == 5) echo "selected"; ?>>�����ڱ�</option>
											<option value="6" <? if($row_opt['lend_kind_4'] == 6) echo "selected"; ?>>��Ÿ</option>
										</select>
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk_center">�ݾ�</td>
									<td nowrap class="tdrow_center" width="">
										<input name="lend_amount_1" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['lend_amount_1']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="lend_amount_2" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['lend_amount_2']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="lend_amount_3" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['lend_amount_3']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="lend_amount_4" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['lend_amount_4']?>" maxlength="12">
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk_center">�ݸ�</td>
									<td nowrap class="tdrow_center" width="">
										<input name="lend_interst_1" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['lend_interst_1']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="lend_interst_2" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['lend_interst_2']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="lend_interst_3" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['lend_interst_3']?>" maxlength="12">
									</td>
									<td nowrap class="tdrow_center" width="">
										<input name="lend_interst_4" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['lend_interst_4']?>" maxlength="12">
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk_center">�㺸����</td>
									<td nowrap class="tdrow_center" width="" colspan="4">
										<input name="security" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['security']?>" maxlength="90">
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk_center">�ְŷ�����</td>
									<td nowrap class="tdrow_center" width="" colspan="4">
										<input name="primary_bank" type="text" class="textfm" style="width:100%;" value="<?=$row_opt['primary_bank']?>" maxlength="90">
									</td>
								</tr>
							</table>
							<div style="height:4px;font-size:0px"></div>

							<!-- �Է��� -->
							<table width="100%" height="" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layput:fixed">
								<tr>
									<td nowrap class="tdrowk_center" width="96" rowspan="">�����Ƿڱݾ�</td>
									<td nowrap  class="tdrow" width="" colspan="">
										��å�ڱ�
										<input name="loan_policy" type="text" class="textfm" style="width:100px;" value="<?=$row['loan_policy']?>" maxlength="12" onKeyPress="">
										�����ڱ�
										<input name="loan_finance" type="text" class="textfm" style="width:100px;" value="<?=$row['loan_finance']?>" maxlength="12" onKeyPress="">
										��Ÿ
										<input name="loan_etc" type="text" class="textfm" style="width:100px;" value="<?=$row['loan_etc']?>" maxlength="12" onKeyPress="">
									</td>
								</tr>
							</table>


							<div style="height:10px;font-size:0px"></div>
							<!--��޴� -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:120px;text-align:center'> 
													��å�ڱ� ó����Ȳ
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

							<!-- �Է��� -->
							<table width="100%" height="" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layput:fixed">
								<tr>
									<td nowrap class="tdrowk" width="96"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">ó����Ȳ<font color="red"></font></td>
									<td nowrap  class="tdrow" width="">
<?
$sel_check_ok = array();
$check_ok_id = $row_opt['check_ok'];
$sel_check_ok[$check_ok_id] = "selected";
?>
										<select name="check_ok" class="selectfm">
											<option value="">����</option>
											<option value="9" <?=$sel_check_ok['9']?>>�����</option>
											<option value="1" <?=$sel_check_ok['1']?>>���Ϸ�</option>
											<option value="2" <?=$sel_check_ok['2']?>>��������</option>
											<option value="3" <?=$sel_check_ok['3']?>>1�����޿Ϸ�</option>
											<option value="6" <?=$sel_check_ok['6']?>>2�����޿Ϸ�</option>
											<option value="4" <?=$sel_check_ok['4']?>>����Ұ�</option>
											<option value="5" <?=$sel_check_ok['5']?>>����</option>
										</select>
									</td>
									<td nowrap class="tdrowk" width="80"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����ȭ</td>
									<td nowrap  class="tdrow" width="160">
										<input name="teldt" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row['teldt']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
										<table border=0 cellpadding=0 cellspacing=0 style="vertical-align:middle;display:inline;"><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:loadCalendar(document.dataForm.teldt);" target="">�޷�</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table>
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����ݾ�<font color="red"></font></td>
									<td nowrap  class="tdrow" width="" colspan="">
										������
										<select name="ok_loan_facility">
											<option value="">����</option>
											<option value="������" <? if($row['ok_loan_facility'] == "������") echo "selected"; ?>>������</option>
											<option value="������" <? if($row['ok_loan_facility'] == "������") echo "selected"; ?>>������</option>
											<option value="�泲����" <? if($row['ok_loan_facility'] == "�泲����") echo "selected"; ?>>�泲����</option>
											<option value="��������" <? if($row['ok_loan_facility'] == "��������") echo "selected"; ?>>��������</option>
											<option value="��������" <? if($row['ok_loan_facility'] == "��������") echo "selected"; ?>>��������</option>
											<option value="�������" <? if($row['ok_loan_facility'] == "�������") echo "selected"; ?>>�������</option>
											<option value="��������" <? if($row['ok_loan_facility'] == "��������") echo "selected"; ?>>��������</option>
											<option value="�뱸����" <? if($row['ok_loan_facility'] == "�뱸����") echo "selected"; ?>>�뱸����</option>
											<option value="�λ�����" <? if($row['ok_loan_facility'] == "�λ�����") echo "selected"; ?>>�λ�����</option>
											<option value="�������ݰ�" <? if($row['ok_loan_facility'] == "�������ݰ�") echo "selected"; ?>>�������ݰ�</option>
											<option value="�ſ���������" <? if($row['ok_loan_facility'] == "�ſ���������") echo "selected"; ?>>�ſ���������</option>
											<option value="��������" <? if($row['ok_loan_facility'] == "��������") echo "selected"; ?>>��������</option>
											<option value="���Ĵٵ���Ÿ������" <? if($row['ok_loan_facility'] == "���Ĵٵ���Ÿ������") echo "selected"; ?>>���Ĵٵ���Ÿ������</option>
											<option value="��ȯ����" <? if($row['ok_loan_facility'] == "��ȯ����") echo "selected"; ?>>��ȯ����</option>
											<option value="�츮����" <? if($row['ok_loan_facility'] == "�츮����") echo "selected"; ?>>�츮����</option>
											<option value="��ü��"   <? if($row['ok_loan_facility'] == "��ü��")   echo "selected"; ?>>��ü��</option>
											<option value="��������" <? if($row['ok_loan_facility'] == "��������") echo "selected"; ?>>��������</option>
											<option value="��������" <? if($row['ok_loan_facility'] == "��������") echo "selected"; ?>>��������</option>
											<option value="�ϳ�����" <? if($row['ok_loan_facility'] == "�ϳ�����") echo "selected"; ?>>�ϳ�����</option>
											<option value="�ѱ���Ƽ����" <? if($row['ok_loan_facility'] == "�ѱ���Ƽ����") echo "selected"; ?>>�ѱ���Ƽ����</option>
										</select>
										���ޱݾ�
										<input name="ok_loan_policy" type="text" class="textfm" style="width:100px;" value="<?=$row['ok_loan_policy']?>" maxlength="12" onKeyPress="">
										������
										<input name="ok_loan_fee" type="text" class="textfm" style="width:40px;" value="<?=$row['ok_loan_fee']?>" maxlength="2" onKeyPress="">%
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">������<font color="red">*</font></td>
									<td nowrap  class="tdrow">
<?
if($row['damdang_code']) {
	$man_cust_name_code = $row['damdang_code'];
} else {
	$man_cust_name_code = $stx_man_cust_name;
}
if($report != "ok") {
	if($member['mb_level'] >= 7) {
?>
										<select name="damdang_code" class="selectfm">
<?
	for($i=1;$i<count($man_cust_name_arry)-1;$i++) {
		if($row['damdang_code'] == $i) $sel_damdang_code[$i] = "selected";
?>
											<option value="<?=$i?>" <?=$sel_damdang_code[$i]?>><?=$man_cust_name_arry[$i]?></option>
<?
	}
?>
											<option value="101" <? if($man_cust_name_code == 101) echo "selected"; ?>>���»�1</option>
										</select>
<?
	} else {
		echo $man_cust_name_arry[$man_cust_name_code];
		echo "<input type='hidden' name='damdang_code' value='".$man_cust_name_code."'>";
	}
} else {
	if($row['damdang_code']) echo $man_cust_name_arry[$man_cust_name_code];
		echo "<input type='hidden' name='damdang_code' value='".$man_cust_name_code."'>";
}
?>
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">ó�����</td>
									<td nowrap  class="tdrow" colspan="3">
										<textarea name="etc" class="textfm" style='width:100%;height:70px;word-break:break-all;' itemname="����" required><?=$row_opt[etc]?></textarea>
									</td>
								</tr>
							</table>
							<div style="height:10px;font-size:0px"></div>
<?
$is_damdang = "ok";
?>
							<!--÷�μ���-->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/sb_tab_on_lt.gif"></td> 
												<td background="images/sb_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
													÷�μ���
												</td> 
												<td><img src="images/sb_tab_on_rt.gif"></td> 
											</tr> 
										</table> 
									</td> 
									<td width=6></td> 
									<td valign="middle"></td> 
								</tr> 
							</table>
							<div style="height:2px;font-size:0px" class="bbtr"></div>
							<div style="height:2px;font-size:0px;line-height:0px;"></div>
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
								<tr>
									<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����1 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_del_1" value="1" style="vertical-align:middle">����<? } ?>
<?
if($is_damdang == "ok") {
?>
										<div style="margin:4px 0 0 0">
											<img src="./images/icon_blank.gif" width="2" height="2" style="margin:0 5px 3px 0"><a href="javascript:field_add('file_tr');"><img src="images/btn_add.png" border="0" style="vertical-align:middle"> <span  style="">�߰�</span></a>
										</div>
<?
}
?>
									</td>
									<td   class="tdrow" width="373">
										<? if($is_damdang == "ok") { ?><input name="filename_1" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
										<a href="files/policy_fund/<?=$row_opt['filename_1']?>" target="_blank"><?=$row_opt['filename_1']?></a>
										<input type="hidden" name="file_1" value="<?=$row_opt['filename_1']?>">
									</td>
									<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����2 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_del_2" value="1" style="vertical-align:middle">����<? } ?></td>
									<td   class="tdrow" >
										<? if($is_damdang == "ok") { ?><input name="filename_2" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
										<a href="files/policy_fund/<?=$row_opt['filename_2']?>" target="_blank"><?=$row_opt['filename_2']?></a>
										<input type="hidden" name="file_2" value="<?=$row_opt['filename_2']?>">
									</td>
								</tr>
								<tr id="file_tr2" style="<? if(!$row_opt['filename_3'] && !$row_opt['filename_4']) echo "display:none"; ?>">
									<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����3 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_del_3" value="1" style="vertical-align:middle">����<? } ?></td>
									<td   class="tdrow" >
										<? if($is_damdang == "ok") { ?><input name="filename_3" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
										<a href="files/policy_fund/<?=$row_opt['filename_3']?>" target="_blank"><?=$row_opt['filename_3']?></a>
										<input type="hidden" name="file_3" value="<?=$row_opt['filename_3']?>">
									</td>
									<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����4 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_del_4" value="1" style="vertical-align:middle">����<? } ?></td>
									<td   class="tdrow" >
										<? if($is_damdang == "ok") { ?><input name="filename_4" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
										<a href="files/policy_fund/<?=$row_opt['filename_4']?>" target="_blank"><?=$row_opt['filename_4']?></a>
										<input type="hidden" name="file_4" value="<?=$row_opt['filename_4']?>">
									</td>
								</tr>
								<tr id="file_tr3" style="<? if(!$row_opt['filename_5'] && !$row_opt['filename_6']) echo "display:none"; ?>">
									<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����5 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_del_5" value="1" style="vertical-align:middle">����<? } ?></td>
									<td   class="tdrow" >
										<? if($is_damdang == "ok") { ?><input name="filename_5" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
										<a href="files/policy_fund/<?=$row_opt['filename_5']?>" target="_blank"><?=$row_opt['filename_5']?></a>
										<input type="hidden" name="file_5" value="<?=$row_opt['filename_5']?>">
									</td>
									<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����6 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_del_6" value="1" style="vertical-align:middle">����<? } ?></td>
									<td   class="tdrow" >
										<? if($is_damdang == "ok") { ?><input name="filename_6" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
										<a href="files/policy_fund/<?=$row_opt['filename_6']?>" target="_blank"><?=$row_opt['filename_6']?></a>
										<input type="hidden" name="file_6" value="<?=$row_opt['filename_6']?>">
									</td>
								</tr>
								<tr id="file_tr4" style="<? if(!$row_opt['filename_7'] && !$row_opt['filename_8']) echo "display:none"; ?>">
									<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����7 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_del_7" value="1" style="vertical-align:middle">����<? } ?></td>
									<td   class="tdrow" >
										<? if($is_damdang == "ok") { ?><input name="filename_7" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><? } ?>
										<br><a href="files/policy_fund/<?=$row_opt['filename_7']?>" target="_blank"><?=$row_opt['filename_7']?></a>
										<input type="hidden" name="file_7" value="<?=$row_opt['filename_7']?>">
									</td>
									<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����8 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_del_8" value="1" style="vertical-align:middle">����<? } ?></td>
									<td   class="tdrow" >
										<? if($is_damdang == "ok") { ?><input name="filename_8" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><? } ?>
										<br><a href="files/policy_fund/<?=$row_opt['filename_8']?>" target="_blank"><?=$row_opt['filename_8']?></a>
										<input type="hidden" name="file_8" value="<?=$row_opt['filename_8']?>">
									</td>
								</tr>
							</table>
<?
//������ ��� ǥ��
if($w) {
?>
								<!--���޻���-->
								<div style="height:10px;font-size:0px;line-height:0px;"></div>
								<!--��޴� -->
								<a name="80001"><!--���޻���--></a>
								<table border="0" cellspacing="0" cellpadding="0" style=""> 
									<tr>
										<td id=""> 
											<table border="0" cellpadding="0" cellspacing="0"> 
												<tr> 
													<td><img src="images/so_tab_on_lt.gif"></td> 
													<td background="images/so_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
														���޻���
													</td> 
													<td><img src="images/so_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width=2></td> 
										<td valign="bottom"></td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="botr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!-- �Է��� -->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<tr>
										<td nowrap class="tdrow" width="">
											<script type="text/javascript">
											function resizeFrame(frm) {
											 frm.style.height = "auto";
											 contentHeight = frm.contentWindow.document.documentElement.scrollHeight;
											 frm.style.height = contentHeight + 0 + "px";
											}
											</script>
											<iframe src="policy_fund_memo.php?id=<?=$id?>" frameborder="0" width="100%" height="200" onload="resizeFrame(this)" scrolling="auto" style="margin:10px 0 0 0"></iframe>
										</td>
									</tr>
								</table>
<?
}
?>
							</div>


							<div style="height:20px;font-size:0px"></div>

							<div style="height:10px;font-size:0px"></div>
							<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layput:fixed">
								<tr>
									<td align="center">
<?
//���Ѻ� ��ũ�� : ��ü ����
if($member['mb_level'] == 0) {
	$url_save = "javascript:alert_no_right();";
} else {
	$url_save = "javascript:checkData();";
}
$url_list = "./policy_fund_list.php?page=".$page;
?>
										<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="<?=$url_save?>" target="">�� ��</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
										<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="<?=$url_list?>" target="">�� ��</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
									</td>
								</tr>
							</table>
							<div style="height:20px;font-size:0px"></div>
							<!--���� ����-->
							<input type="hidden" name="url" value="./policy_fund_view.php" />
							<input type="hidden" name="prv_cust_tell"  value="<?=$row['com_tel']?>" />
							<input type="hidden" name="prv_user_id" value="<?=$row['t_insureno']?>" />
							<input type="hidden" name="w" value="<?=$w?>" />
							<input type="hidden" name="id" value="<?=$id?>" />
							<input type="hidden" name="page" value="<?=$page?>" />
						</form>
					</div>
				</td>
			</tr>
		</table>


									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</div>
		</td>
	</tr>
</table>
<? include "./inc/bottom.php";?>
</body>
</html>
