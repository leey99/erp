<?
$sub_menu = "700220";
include_once("./_common.php");

// ���� ���¸� �۵�
if($w == "u") {
	$result1=mysql_query("select * from a4_modify where id = $id");
	$row1=mysql_fetch_array($result1);

	if($row1[modify_salary] == "0") $row1[modify_salary] = "";
	else $row1[modify_salary] = number_format($row1[modify_salary]);
	if($row1[modify_salary_2] == "0") $row1[modify_salary_2] = "";
	else $row1[modify_salary_2] = number_format($row1[modify_salary_2]);
	if($row1[modify_salary_3] == "0") $row1[modify_salary_3] = "";
	else $row1[modify_salary_3] = number_format($row1[modify_salary_3]);
	if($row1[modify_salary_4] == "0") $row1[modify_salary_4] = "";
	else $row1[modify_salary_4] = number_format($row1[modify_salary_4]);
	if($row1[modify_salary_5] == "0") $row1[modify_salary_5] = "";
	else $row1[modify_salary_5] = number_format($row1[modify_salary_5]);
}
// �α��� �� ��������� �α���
if(!$row1[comp_name]) {
	$sql_a4 = " select * from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
	$row_a4 = sql_fetch($sql_a4);
	$row1[comp_name] = $row_a4[com_name];
	$row1[comp_adr]  = $row_a4[com_juso]." ".$row_a4[com_juso2];
	$row1[comp_bznb] = $row_a4[t_insureno];
	$row1[comp_tel]  = $row_a4[com_tel];
}
$sub_title = "����պ�������Ű�";
$g4[title] = $sub_title." : ����������Ű� : ".$easynomu_name;
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
function checkData() {
	var frm = document.dataForm;
	if (frm.comp_bznb.value == "")
	{
		alert("����ڵ�Ϲ�ȣ�� �Է��ϼ���.");
		frm.comp_bznb.focus();
		return;
	}
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
	if (frm.comp_tel.value == "")
	{
		alert("��ȭ��ȣ(�����)�� �Է��ϼ���.");
		frm.comp_tel.focus();
		return;
	}
	if (frm.comp_email.value == "")
	{
		alert("�̸����� �Է��ϼ���.");
		frm.comp_email.focus();
		return;
	}
	if (frm.modify_name.value == "")
	{
		alert("������ �Է��ϼ���.");
		frm.modify_name.focus();
		return;
	}
	if (frm.modify_ssnb.value == "")
	{
		alert("�ֹε�Ϲ�ȣ�� �Է��ϼ���.");
		frm.modify_ssnb.focus();
		return;
	}
	if (frm.modify_salary.value == "")
	{
		alert("���� �� ����պ����� �Է��ϼ���.");
		frm.modify_salary.focus();
		return;
	}
	if (frm.modify_date.value == "")
	{
		alert("���� ���� ������ �Է��ϼ���.");
		frm.modify_date.focus();
		return;
	}
	if (frm.modify_reason.value == "")
	{
		alert("��������� �Է��ϼ���.");
		frm.modify_reason.focus();
		return;
	}
	frm.action = "a4_modify_update_admin.php";
	frm.submit();
	return;
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
		type.value=total;					// type �� ���� �������� �־� �ش�.
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
function open_comp(frm_name) {
	if(frm_name == 2) frm = document.dataForm2;
	else frm = document.dataForm;
	n = frm.comp_bznb.value;
	if(frm.comp_bznb.value == "") {
		alert("����ڵ�Ϲ�ȣ�� �Է� �� �˻��� �ֽʽÿ�.");
		frm.comp_bznb.focus();
		return;
	}
	window.open("popup/comp_bznb_popup.php?comp_bznb="+n+"&frm="+frm_name, "comp_popup", "width=540, height=706, toolbar=no, menubar=no, scrollbars=no, resizable=no" );
}
</script>
<? include "./inc/top_admin.php"; ?>

<div id="content">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="1200" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td width="100%" valign="top" style="padding:10px 10px 10px 10px">
							<div style="width:908px">
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

							<!--������ -->
							<form name="dataForm" method="post">
							<input type="hidden" name="w" value="<?=$w?>">
							<input type="hidden" name="id" value="<?=$row1[id]?>">
							<input type="hidden" name="page" value="<?=$page?>">
							<input type="hidden" name="modify_count" value="2">
								<table border=0 cellspacing=0 cellpadding=0> 
									<tr> 
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
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
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����ڵ�Ϲ�ȣ<font color="red">*</font></td>
										<td nowrap class="tdrow">
											<input name="comp_bznb" type="text" class="textfm" style="width:100px;" value="<?=$row1[comp_bznb]?>" maxlength="12" onkeyup="checkBznb(this.value, '1','Y')" >
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����������<font color="red">*</font></td>
										<td nowrap class="tdrow">
											<input name="comp_adr" type="text" class="textfm" style="width:250px;" value="<?=$row1[comp_adr]?>" maxlength="50">
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">������Ī<font color="red">*</font></td>
										<td nowrap class="tdrow">
											<input name="comp_name" type="text" class="textfm" style="width:150px;" value="<?=$row1[comp_name]?>" maxlength="25">
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">��ȭ��ȣ<font color="red">*</font></td>
										<td nowrap class="tdrow">
											<input name="comp_tel" type="text" class="textfm" style="width:100px;" value="<?=$row1[comp_tel]?>" maxlength="15"> ��) 055-1234-1234
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�̸���<font color="red">*</font></td>
										<td nowrap class="tdrow">
											<input name="comp_email" id="comp_email" type="text" class="textfm" style="width:210px;" value="<?=$row1[comp_email]?>" maxlength="30">
										</td>
										<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�ѽ���ȣ<font color="red"></font></td>
										<td nowrap class="tdrow">
											<input name="comp_fax" id="comp_fax" type="text" class="textfm" style="width:100px;" value="<?=$row1[comp_fax]?>" maxlength="15"> ��) 055-1234-1234
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
														<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'>�ٷ���</td> 
														<td><img src="images/g_tab_on_rt.gif"></td> 
													</tr> 
												</table> 
											</td> 
											<td width=2></td> 
											<td valign="bottom"></td> 
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
											<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����<font color="red">*</font></td>
											<td nowrap class="tdrow">
												<input name="modify_name" type="text" class="textfm" style="width:150px;" value="<?=$row1[modify_name]?>" maxlength="25" onclick="" onfocus="modify_ok_func()">
											</td>
											<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�ֹε�Ϲ�ȣ<font color="red">*</font></td>
											<td nowrap class="tdrow">
												<input name="modify_ssnb" type="text" class="textfm" style="width:100px;" value="<?=$row1[modify_ssnb]?>" maxlength="14"> ��) 123456-1234567
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">���� �� ����պ���<font color="red">*</font></td>
											<td nowrap class="tdrow">
												<input name="modify_salary" type="text" class="textfm" style="width:150px;ime-mode:inactive;" onkeypress="only_number()" value="<?=$row1[modify_salary]?>" maxlength="25" onkeyup="checkThousand(this.value, '1','Y')">
											</td>
											<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">���� ���� ����<font color="red">*</font></td>
											<td nowrap class="tdrow">
												<input name="modify_date" type="text" class="textfm" style="width:100px;" value="<?=$row1[modify_date]?>" maxlength="7"> ��) 2014.02
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�������뿩��<font color="red">*</font></td>
											<td nowrap class="tdrow">
<?
$modify_insurance_array = explode(",",$row1[modify_insurance]);
if($modify_insurance_array[0] == "1") $misgy_chk = "checked";
else $misgy_chk = "";
if($modify_insurance_array[1] == "1") $missj_chk = "checked";
else $missj_chk = "";
if($modify_insurance_array[2] == "1") $miskm_chk = "checked";
else $miskm_chk = "";
if($modify_insurance_array[3] == "1") $misgg_chk = "checked";
else $misgg_chk = "";
?>
												<input type="checkbox" name="misgy" value="1" class="checkbox" <?=$misgy_chk?>>���
												<input type="checkbox" name="missj" value="1" class="checkbox" <?=$missj_chk?>>����
												<input type="checkbox" name="miskm" value="1" class="checkbox" <?=$miskm_chk?>>����
												<input type="checkbox" name="misgg" value="1" class="checkbox" <?=$misgg_chk?>>�ǰ�
											</td>
											<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�������<font color="red">*</font></td>
											<td nowrap class="tdrow">
<?
$modify_reason[1] = "�����λ�";
$modify_reason[2] = "��������";
$modify_reason[3] = "��������";
?>
												<select name="modify_reason" class="selectfm" style="">
													<option value="" >����</option>
													<option value="<?=$modify_reason[1]?>" <? if($row1[modify_reason] == $modify_reason[1]) echo "selected"; ?> ><?=$modify_reason[1]?></option>
													<option value="<?=$modify_reason[2]?>" <? if($row1[modify_reason] == $modify_reason[2]) echo "selected"; ?> ><?=$modify_reason[2]?></option>
													<option value="<?=$modify_reason[3]?>" <? if($row1[modify_reason] == $modify_reason[3]) echo "selected"; ?> ><?=$modify_reason[3]?></option>
												</select>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">���<font color="red"></font></td>
											<td nowrap class="tdrow">
												<input name="modify_note" type="text" class="textfm" style="width:150px;" value="<?=$row1[modify_note]?>" maxlength="25">
											</td>
											<td nowrap class="tdrowk"></td>
											<td nowrap class="tdrow">
											</td>
										</tr>
									</table>
									<div style="height:5px;font-size:0px;line-height:0px;"></div>

									<script language="javascript">
									var modify_name = new Array();
									var modify_ssnb = new Array();
									var modify_date = new Array();
									var modify_salary = new Array();
									var modify_insurance = new Array();
									var misgy = new Array();
									var missj = new Array();
									var miskm = new Array();
									var misgg = new Array();
									var modify_reason = new Array();
									var modify_reason_1 = new Array();
									var modify_reason_2 = new Array();
									var modify_reason_3 = new Array();
									var modify_note = new Array();

									var frm = document.dataForm;
<?
$sql_modify_cnt = " select count(*) as cnt from a4_modify_opt where mid = '$id' ";
$row_modify_cnt = sql_fetch($sql_modify_cnt);
$modify_count = $row_modify_cnt[cnt]+1;
$sql_modify_add = " select * from a4_modify_opt where mid = '$id' order by id ";
$result_modify_add = sql_query($sql_modify_add);
for($i=2; $row2=sql_fetch_array($result_modify_add); $i++) {
	$modify_name_add = "modify_name_".$i;
	$modify_ssnb_add = "modify_ssnb_".$i;
	$modify_date_add = "modify_date_".$i;
	$modify_salary_add = "modify_salary_".$i;
	$modify_insurance_add = "modify_insurance_".$i;
	$misgy_add = "misgy_".$i;
	$missj_add = "missj_".$i;
	$miskm_add = "miskm_".$i;
	$misgg_add = "misgg_".$i;
	$modify_reason_add = "modify_reason_".$i;
	$modify_note_add = "modify_note_".$i;
?>
									modify_name[<?=$i?>] = "<?=$row2[modify_name]?>";
									modify_ssnb[<?=$i?>] = "<?=$row2[modify_ssnb]?>";
									modify_date[<?=$i?>] = "<?=$row2[modify_date]?>";
									modify_salary[<?=$i?>] = "<?=number_format($row2[modify_salary])?>";
									//alert("<?=$row2[$modify_insurance_add]?>");
									<?
									$modify_insurance_add_array = explode(",",$row2[modify_insurance]);
									if($modify_insurance_add_array[0] == "1") {
									?>
									misgy[<?=$i?>] = "checked";
									<?
									} else {
									?>
									misgy[<?=$i?>] = "";
									<?
									}
									if($modify_insurance_add_array[1] == "1") {
									?>
									missj[<?=$i?>] = "checked";
									<?
									} else {
									?>
									missj[<?=$i?>] = "";
									<?
									}
									if($modify_insurance_add_array[2] == "1") {
									?>
									miskm[<?=$i?>] = "checked";
									<?
									} else {
									?>
									miskm[<?=$i?>] = "";
									<?
									}
									if($modify_insurance_add_array[3] == "1") {
									?>
									misgg[<?=$i?>] = "checked";
									<?
									} else {
									?>
									misgg[<?=$i?>] = "";
									<?
									}
									?>
									modify_reason[<?=$i?>] = "<?=$row2[modify_reason]?>";
									if(modify_reason[<?=$i?>] == "�����λ�") {
										modify_reason_1[<?=$i?>] = "selected";
									} else if(modify_reason[<?=$i?>] == "��������") {
										modify_reason_2[<?=$i?>] = "selected";
									} else if(modify_reason[<?=$i?>] == "��������") {
										modify_reason_3[<?=$i?>] = "selected";
									}
									modify_note[<?=$i?>] = "<?=$row2[modify_note]?>";
<?
}
?>
									function onload_4insure() {
<?
//echo $modify_count;
for($i=2; $i<=$modify_count; $i++) {
?>
										modify_plus(<?=$i?>);
<?
}
?>
									}
									addLoadEvent(onload_4insure); 

									function modify_plus(n){
										//alert(n);
										if(frm.modify_count.value > 20) {
											alert("�ѹ��� �Ű��� �� �ִ� �ο��� 20����� �Դϴ�.");
											return false;
										} else { 
											document.getElementById('modify_add_div').style.display = "";
											var Tbl = document.getElementById('modify_optable'); 
											tRow = Tbl.insertRow();//tr �߰�
											tCell = tRow.insertCell();//td �߰�
											tCell.className = "tdrowk"; 
											tCell.colSpan = 2;
											tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">����<font color=\"red\"></font>";
											tCell = tRow.insertCell();
											tCell.className = "tdrow"; 
											tCell.colSpan = 2;
											tCell.innerHTML = "<input name=\"modify_name_[]\" type=\"text\" class=\"textfm\" style=\"width:150px;\" value=\""+modify_name[n]+"\" maxlength=\"25\">";
											tCell = tRow.insertCell();
											tCell.className = "tdrowk"; 
											tCell.colSpan = 2;
											tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">�ֹε�Ϲ�ȣ<font color=\"red\"></font>";
											tCell = tRow.insertCell();
											tCell.className = "tdrow"; 
											tCell.colSpan = 2;
											tCell.innerHTML = "<input name=\"modify_ssnb_[]\" type=\"text\" class=\"textfm\" style=\"width:100px;\" value=\""+modify_ssnb[n]+"\" maxlength=\"14\">";

											tRow = Tbl.insertRow();
											tCell = tRow.insertCell();
											tCell.className = "tdrowk"; 
											tCell.colSpan = 2;
											tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">���� �� ����պ���<font color=\"red\"></font>";
											tCell = tRow.insertCell();
											tCell.className = "tdrow"; 
											tCell.colSpan = 2;
											tCell.innerHTML = "<input name=\"modify_salary_[]\" type=\"text\" class=\"textfm\" style=\"width:150px;ime-mode:inactive;\" onkeypress=\"only_number()\" value=\""+modify_salary[n]+"\" maxlength=\"25\" onkeyup=\"checkThousand(this.value, '1"+frm.modify_count.value+"','Y')\">";
											tCell = tRow.insertCell();
											tCell.className = "tdrowk"; 
											tCell.colSpan = 2;
											tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">���� ���� ����<font color=\"red\"></font>";
											tCell = tRow.insertCell();
											tCell.className = "tdrow"; 
											tCell.colSpan = 2;
											tCell.innerHTML = "<input name=\"modify_date_[]\" type=\"text\" class=\"textfm\" style=\"width:100px;\" value=\""+modify_date[n]+"\" maxlength=\"7\">";

											tRow = Tbl.insertRow();
											tCell = tRow.insertCell();
											tCell.className = "tdrowk"; 
											tCell.colSpan = 2;
											tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">�������뿩��<font color=\"red\"></font>";
											tCell = tRow.insertCell();
											tCell.className = "tdrow"; 
											tCell.colSpan = 2;
											tCell.innerHTML = "<input type=\"checkbox\" name=\"misgy_"+n+"\" value=\"1\" class=\"checkbox\" "+misgy[n]+"> ��� <input type=\"checkbox\" name=\"missj_"+n+"\" value=\"1\" class=\"checkbox\" "+missj[n]+"> ���� <input type=\"checkbox\" name=\"miskm_"+n+"\" value=\"1\" class=\"checkbox\" "+miskm[n]+"> ���� <input type=\"checkbox\" name=\"misgg_"+n+"\" value=\"1\" class=\"checkbox\" "+misgg[n]+"> �ǰ�";
											tCell = tRow.insertCell();
											tCell.className = "tdrowk"; 
											tCell.colSpan = 2;
											tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">�������<font color=\"red\"></font>";
											tCell = tRow.insertCell();
											tCell.className = "tdrow"; 
											tCell.colSpan = 2;
											tCell.innerHTML = "<select name=\"modify_reason_[]\" class=\"selectfm\" style=\"\"><option value=\"\" >����</option><option value=\"�����λ�\" "+modify_reason_1[n]+">�����λ�</option><option value=\"��������\" "+modify_reason_2[n]+">��������</option><option value=\"��������\" "+modify_reason_3[n]+">��������</option></select>";

											tRow = Tbl.insertRow();
											tCell = tRow.insertCell();
											tCell.className = "tdrowk_end"; 
											tCell.colSpan = 2;
											tCell.innerHTML = "<img src=\"images/icon_02.gif\" width=\"2\" height=\"2\" style=\"margin:0 5 3 0\">���<font color=\"red\"></font>";
											tCell = tRow.insertCell();
											tCell.className = "tdrow_end"; 
											tCell.colSpan = 2;
											tCell.innerHTML = "<input name=\"modify_note_[]\" type=\"text\" class=\"textfm\" style=\"width:150px;\" value=\""+modify_note[n]+"\" maxlength=\"25\">";
											tCell = tRow.insertCell();
											tCell.className = "tdrowk_end"; 
											tCell.colSpan = 2;
											tCell.innerHTML = "";
											tCell = tRow.insertCell();
											tCell.className = "tdrow_end"; 
											tCell.colSpan = 2;
											tCell.innerHTML = "";

											frm.modify_count.value++;
										} 
									}
									</script>

									<div id="modify_add_div" style="display:none">
										<table border=0 cellspacing=0 cellpadding=0> 
											<tr> 
												<td id=""> 
													<table border=0 cellpadding=0 cellspacing=0> 
														<tr> 
															<td><img src="images/g_tab_on_lt.gif"></td> 
															<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
															�ٷ���(�߰�)
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
									<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed" id="modify_optable">
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
											<td background="images/btn_bg.gif" class=ftbutton1 nowrap><label onclick="modify_plus(document.dataForm.modify_count.value)" style="cursor:pointer">�ٷ��� �߰�</label></td>
											<td><img src="images/btn_rt.gif"></td>
											<td width=2></td>
										</tr>
									</table>
									<div style="height:10px;font-size:0px;line-height:0px;"></div>

								<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
									<tr>
										<td align="center">
											<table border=0 cellpadding=0 cellspacing=0 style="display:inline;">
												<tr>
													<td width=2></td>
													<td><img src=images/btn_lt.gif></td>
													<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="javascript:checkData();" target="">�� ��</a></td>
													<td><img src=images/btn_rt.gif></td>
												 <td width=2></td>
												</tr>
											</table>
											<?
											if($w == "u") {
											?>
											<table border=0 cellpadding=0 cellspacing=0 style="display:inline;">
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
											?>
											<table border=0 cellpadding=0 cellspacing=0 style=display:inline;>
											 <tr>
												 <td width=2></td>
													<td><img src=images/btn_lt.gif></td>
													<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="a4_modify_list_admin.php" target="">�� ��</a></td>
													<td><img src=images/btn_rt.gif></td>
												 <td width=2></td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</form>
							</div>
						</td>
					</tr>
				</table>
				<? include "./inc/bottom.php";?>
			</td>
		</tr>
	</table>			
</div>
</body>
</html>
