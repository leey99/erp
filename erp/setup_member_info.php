<?
$sub_menu = "100100";
include_once("./_common.php");

$now_date = date("Y.m.d");

//echo $member[mb_profile];
if($is_admin != "super") {
	$stx_man_cust_name = $member['mb_profile'];
}
$is_admin = "super";

$sub_title = "ȸ������";
$g4[title] = $sub_title." : ȯ�漳�� : ".$easynomu_name;

if($w == "u") {
	$sql1 = " select * from a4_member where mb_id='$mb_id' ";
	$sql2 = " select * from a4_manage where user_id='$mb_id' and state=1 ";
} else {
	$sql1 = " select * from a4_member where mb_id='$member[mb_id]' ";
	$sql2 = " select * from a4_manage where user_id='$member[mb_id]' and state=1 ";
}
$result1 = sql_query($sql1);
$row1=mysql_fetch_array($result1);
$result2 = sql_query($sql2);
$row2=mysql_fetch_array($result2);
$top_sub_title = "images/top08_01.gif";
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
	var ret = window.open("../road_address/search.php", "address", "width=496,height=522,scrollbars=0");
	return;
}
function id_copy() {
	var frm = document.dataForm;
	frm.user_id.value = frm.comp_bznb.value;
}
function checkData(action_file) {
	var frm = document.dataForm;
	var rv = 0;
	if(frm.mb_nick.value == "") {
		alert("������ �Է��ϼ���.");
		frm.mb_nick.focus();
		return;
	}
	if(frm.mb_password.value == "") {
		alert("��й�ȣ�� �Է��ϼ���.");
		frm.mb_password.focus();
		return;
	}
	if(frm.mb_password.value.length < 6) {
		alert("��й�ȣ�� 6�ڸ� �̻� �Է��ϼ���.");
		frm.mb_password.focus();
		return;
	}
	if(frm.mb_password_re.value == "") {
		alert("��й�ȣ Ȯ���� �Է��ϼ���.");
		frm.mb_password_re.focus();
		return;
	}
	if(frm.mb_password_re.value.length < 6) {
		alert("��й�ȣ Ȯ���� 6�ڸ� �̻� �Է��ϼ���.");
		frm.mb_password_re.focus();
		return;
	}
	if(frm.mb_password.value != frm.mb_password_re.value) {
		alert("��й�ȣ�� ��й�ȣ Ȯ���� �ٸ��ϴ�.");
		frm.mb_password_re.focus();
		return;
	}
	frm.action = action_file;
	frm.submit();
	return;
}
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
function only_number_hyphen() {
	if (event.keyCode < 48 || event.keyCode > 57) {
		if (event.keyCode < 95 || event.keyCode > 105) {
			if(event.keyCode != 45) event.preventDefault ? event.preventDefault() : event.returnValue = false;
		}
	}
}
function only_number_comma() {
	if (event.keyCode < 48 || event.keyCode > 57) {
		if (event.keyCode < 95 || event.keyCode > 105) {
			if(event.keyCode != 46) event.returnValue = false;
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
function open_upjong(n) {
	window.open("popup/upjong_popup.php?n=_"+n, "upjong_popup", "width=540, height=706, toolbar=no, menubar=no, scrollbars=no, resizable=no" );
}
function findNomu(branch) {
	var ret = window.open("pop_manage_cust.php?search_belong="+branch, "pop_nomu_cust", "top=100, left=100, width=800,height=600, scrollbars");
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
				if ( type =='1' ) {
					main.comp_bznb.value=total;					// type �� ���� �������� �־� �ش�.
				}
				else if ( type =='2' ) {
					main.t_insureno.value=total;					// type �� ���� �������� �־� �ش�.
				}
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
				main.t_insureno.value=total;
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
	if (event.keyCode < 48 || (event.keyCode > 57 && event.keyCode < 97) || (event.keyCode > 122)) event.preventDefault ? event.preventDefault() : event.returnValue = false;
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
		//�� ����Ʈ+�� �� �� Home backsp
		if(event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=36 && event.keyCode!=8) {
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
	//�� ����Ʈ+�� �� �� Home backsp
	if(event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=36 && event.keyCode!=8) {
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
if( ($member['mb_profile'] >= 110 && $member['mb_profile'] <= 200) || $member['mb_level'] == 4 ) include "inc/top_dealer.php";
else include "inc/top.php";
//����Ʈ ����
$content_width = "1008";
?>
					<td onmouseover="showM('900')" valign="top">
						<div style="margin:10px 20px 20px 20px;min-height:480px;">
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td width="100"><img src="images/top08.gif" border="0"></td>
									<td width=""><img src="<?=$top_sub_title?>" border="0"></td>
									<td></td>
								</tr>
								<tr><td height="1" bgcolor="#cccccc" colspan="3"></td></tr>
							</table>
							<table width="1000" border="0" align="left" cellpadding="0" cellspacing="0" >
								<tr>
									<td valign="top" style="padding:10px 0 0 0">
										<!--Ÿ��Ʋ -->	

							<form name="dataForm" method="post" enctype="MULTIPART/FORM-DATA">
							<input type="hidden" name="w" value="<?=$w?>">
							<div id="tab1">
								<!--��޴� -->
								<table border=0 cellspacing=0 cellpadding=0 style=""> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
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
											<input name="mb_nick" type="text" class="textfm" style="width:150;ime-mode:active;" value="<?=$row1['mb_nick']?>" onKeyDown="if(event.keyCode == 13){ document.dataForm.emp_ssnb1.focus(); }" tabindex="1" maxlength="25">
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����(����)<font color="red">*</font></td>
										<td nowrap class="tdrow">
											<?=$row1['mb_name']?>
										</td>
										<td nowrap class="tdrowk" rowspan="3">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�������
										</td>
										<td nowrap class="tdrow" rowspan="3">
											<?
												//�������
												$upload_dir = "files/images/".$row1['mb_id'].".jpg";
												if(file_exists($upload_dir)) {
													$pic = $upload_dir;
												} else {
													$pic = "./images/blank_pic.gif";
												}
											?>

											<img src="<?=$pic?>" width="90" height="90" style="margin-bottom:2px"> (�̹����� jpg ���ϸ�) <br>
											<input name="filename_1" type="file" class="textfm_search" style="width:218px;">
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��й�ȣ<font color="red">*</font></td>
										<td nowrap class="tdrow">
											<input id="mb_password" name="mb_password" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row1['mb_pass']?>" tabindex="4" maxlength="12" onKeyPress="" onkeyup="">
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��й�ȣ Ȯ��<font color="red">*</font></td>
										<td nowrap class="tdrow">
											<input id="mb_password_re" name="mb_password_chl" type="password" class="textfm" style="width:80;ime-mode:disabled;" value="" tabindex="5" maxlength="12" onKeyPress="" onkeyup="">
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�ּ�</td>
										<td nowrap class="tdrow" colspan="3">
											<?
											$adr_zip = array();
											$adr_zip[0] = $row1['mb_zip1'];
											$adr_zip[1] = $row1['mb_zip2'];
											?>
											<div style="float:left;height:22px">
												<input name="adr_zip1" type="text" class="textfm" style="width:30px;ime-mode:active;" value="<?=$adr_zip[0]?>" readonly>
												-
												<input name="adr_zip2" type="text" class="textfm" style="width:30px;ime-mode:active;" value="<?=$adr_zip[1]?>" readonly>
											</div>
											<div style="float:;height:22px">
												<table border=0 cellpadding=0 cellspacing=0><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:openDaumPostcode('adr_zip1','adr_zip2','adr_adr1','adr_adr2');" target="">�ּ�ã��</a></td><td><img src=./images/btn2_rt.gif></td><td width=2></td></tr></table>
											</div>
											<input name="adr_adr1" type="text" class="textfm" style="width:480px;ime-mode:active;" value="<?=$row1['mb_addr1']?>" readonly>
											<br>
											<input name="adr_adr2" type="text" class="textfm" style="width:480px;ime-mode:active;" value="<?=$row1['mb_addr2']?>" maxlength="150">
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�޴���</td>
										<td nowrap class="tdrow">
											<?
											$emp_cel = explode("-",$row2['hp']);
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
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��ȭ��ȣ</td>
										<td nowrap class="tdrow">
											<?
											$emp_tel = explode("-",$row2['tel']);
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
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�ѽ���ȣ</td>
										<td nowrap class="tdrow">
<?
$emp_fax = explode("-",$row2['fax']);
$emp_fax1 = $emp_fax[0];
$sel_emp_fax1 = array();
$sel_emp_fax1[$emp_fax1] = "selected";
$emp_fax2 = $emp_fax[1];
$emp_fax3 = $emp_fax[2];
?>
											<select name="emp_fax1" class="selectfm">
											<option value="">����</option>
												<option value="02"  <?=$sel_emp_fax1['02']?> >02</option>
												<option value="031" <?=$sel_emp_fax1['031']?>>031</option>
												<option value="032" <?=$sel_emp_fax1['032']?>>032</option>
												<option value="033" <?=$sel_emp_fax1['033']?>>033</option>
												<option value="041" <?=$sel_emp_fax1['041']?>>041</option>
												<option value="042" <?=$sel_emp_fax1['042']?>>042</option>
												<option value="043" <?=$sel_emp_fax1['043']?>>043</option>
												<option value="051" <?=$sel_emp_fax1['051']?>>051</option>
												<option value="052" <?=$sel_emp_fax1['052']?>>052</option>
												<option value="053" <?=$sel_emp_fax1['053']?>>053</option>
												<option value="054" <?=$sel_emp_fax1['054']?>>054</option>
												<option value="055" <?=$sel_emp_fax1['055']?>>055</option>
												<option value="061" <?=$sel_emp_fax1['061']?>>061</option>
												<option value="062" <?=$sel_emp_fax1['062']?>>062</option>
												<option value="063" <?=$sel_emp_fax1['063']?>>063</option>
												<option value="064" <?=$sel_emp_fax1['064']?>>064</option>
												<option value="070" <?=$sel_emp_fax1['070']?>>070</option>
												<option value="070" <?=$sel_emp_fax1['0303']?>>0303</option>
												<option value="070" <?=$sel_emp_fax1['0505']?>>0505</option>
											</select>
											-
											<input name="emp_fax2" type="text" class="textfm" style="width:35px;ime-mode:disabled;" value="<?=$emp_fax2?>" maxlength="4" onKeyPress="onlyNumber();">
											-
											<input name="emp_fax3" type="text" class="textfm" style="width:35px;ime-mode:disabled;" value="<?=$emp_fax3?>" maxlength="4" onKeyPress="onlyNumber();">
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�̸���</td>
										<td nowrap class="tdrow">
											<input name="emp_email" type="text" class="textfm" style="width:180px;ime-mode:disabled;" value="<?=$row2['email']?>" maxlength="50">
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��������</td>
										<td nowrap class="tdrow">
<?
if($row2['state'] == 1) $state_text = "����";
else $state_text = "����";
echo $state_text;
?>
										</td>
										<td nowrap class="tdrowk"></td>
										<td nowrap class="tdrow">

										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk" rowspan="3"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">Ư�̻���</td>
										<td nowrap class="tdrow" colspan="3" rowspan="3">
											<textarea name="mb_memo_call" class="textfm" style='width:100%;height:64px;word-break:break-all;'><?=$row1['mb_memo_call']?></textarea>
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">ȸ��ID</td>
										<td nowrap class="tdrow">
											<?=$row1['mb_id']?>
											<input type="hidden" name="mb_id" value="<?=$row1['mb_id']?>">
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">ȸ������</td>
										<td nowrap class="tdrow">
<?
$mb_level = $row1['mb_level'];
?>
											<?=$mb_level?>
											(<?=$level_array[$mb_level]?>)
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�����ڵ�</td>
										<td nowrap class="tdrow">
<?
$mb_profile = $row1['mb_profile'];
?>
											<?=$mb_profile?>
											(<?=$man_cust_name_arry[$mb_profile]?>)
										</td>
									</tr>
<?
//���� ����
if($member['mb_profile'] == 1) {
	//������� DB
	$sql_approval = " select * from business_approval where user_id='$row1[mb_id]' ";
	$result_approval = sql_query($sql_approval);
	$row_approval = mysql_fetch_array($result_approval);
	//���Ŵ��� DB
	$sql_common = " from a4_manage ";
	//����, ����, ���� �̻� -> ���� �̻� 160622
	//$sql_search = " where item='manage' and state=1 and belong=1 and p_code<=3 ";
	$sql_search = " where item='manage' and state=1 and belong=1 and p_code<=6 ";
	$sql_order = " order by p_code asc ";
	$sql_manage = " select * $sql_common $sql_search $sql_order ";
	//echo $sql_manage;
	$result_manage = sql_query($sql_manage);
	for($i=0; $row_manage=sql_fetch_array($result_manage); $i++) {
		$manage_id[$i] = $row_manage['user_id'];
		$manage_name[$i] = $row_manage['name'];
		$manage_position[$i] = $row_manage['position'];
	}
?>
									<tr>
										<td nowrap class="tdrowk" rowspan=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�������</td>
										<td nowrap class="tdrow" colspan="5">
											<select name="approval1" class="selectfm">
												<option value="">�������1</option>
<?
	for($i=0; $i<sizeof($manage_id); $i++ ) {
?>
												<option value="<?=$manage_id[$i]?>" <? if($row_approval['approval1'] == $manage_id[$i]) echo "selected"; ?>><?=$manage_name[$i]?> <?=$manage_position[$i]?></option>
<?
	}
?>
											</select>
											<select name="approval2" class="selectfm">
												<option value="">�������2</option>
<?
	for($i=0; $i<sizeof($manage_id); $i++ ) {
?>
												<option value="<?=$manage_id[$i]?>" <? if($row_approval['approval2'] == $manage_id[$i]) echo "selected"; ?>><?=$manage_name[$i]?> <?=$manage_position[$i]?></option>
<?
	}
?>
											</select>
											<select name="approval3" class="selectfm">
												<option value="">�������3</option>
<?
	for($i=0; $i<sizeof($manage_id); $i++ ) {
?>
												<option value="<?=$manage_id[$i]?>" <? if($row_approval['approval3'] == $manage_id[$i]) echo "selected"; ?>><?=$manage_name[$i]?> <?=$manage_position[$i]?></option>
<?
	}
?>
											</select>
											<select name="approval4" class="selectfm">
												<option value="">�������4</option>
<?
	for($i=0; $i<sizeof($manage_id); $i++ ) {
?>
												<option value="<?=$manage_id[$i]?>" <? if($row_approval['approval4'] == $manage_id[$i]) echo "selected"; ?>><?=$manage_name[$i]?> <?=$manage_position[$i]?></option>
<?
	}
?>
											</select>
											<select name="approval5" class="selectfm">
												<option value="">�������5</option>
<?
	for($i=0; $i<sizeof($manage_id); $i++ ) {
?>
												<option value="<?=$manage_id[$i]?>" <? if($row_approval['approval5'] == $manage_id[$i]) echo "selected"; ?>><?=$manage_name[$i]?> <?=$manage_position[$i]?></option>
<?
	}
?>
											</select>
											�� �������� �� ���� ������ �������ϴ�.
										</td>
									</tr>
<?
}
?>
								</table>

								<input type="hidden" name="w" value="<?=$w?>" />
								<input type="hidden" name="id" value="<?=$id?>" />
								<input type="hidden" name="tab" value="<?=$tab?>" />
								<input type="hidden" name="code" value="<?=$row2['code']?>" />
							</div>
							<div id="tab2" style="display:none">

							</div>
							<div style="height:20px;font-size:0px"></div>
							<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layput:fixed">
								<tr>
									<td align="center">
<?
$url_save = "javascript:checkData('setup_member_info_update.php');";
?>
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_save?>" target="">�� ��</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table>
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="./main.php" target="">Ȩ����</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table>
									</td>
								</tr>
							</table>

							<div style="height:20px;font-size:0px"></div>
						</form>
						<!--��޴� -->
						<!-- �Է��� -->
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
