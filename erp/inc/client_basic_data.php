<script type="text/javascript">
//�ߺ�Ȯ�� : ����������ȣ
function check_tno() {
	var frm = document.dataForm;
	if(frm.t_insureno.value == "") {
		alert("����������ȣ�� �Է��ϼ���.");
		frm.t_insureno.focus();
		return;
	}
	if(frm.t_insureno.value.length < 14) {
		alert("����������ȣ 14�ڸ�('-'����)�� �Է��ϼ���.");
		frm.t_insureno.focus();
		return;
	}
	var ret = window.open("./popup/comp_tno_popup_overlap.php?tno="+frm.t_insureno.value, "tno_check", "width=540, height=290, toolbar=no, menubar=no, scrollbars=no, resizable=no" );
	return;
}
function input_today(input_obj, output_name, vars) {
	var frm = document.dataForm;
	if(input_obj.value == vars) {
		frm[output_name].value = "<?=$today?>";
	} else {
		frm[output_name].value = "";
	}
}
function input_today_agent_elect_public(input_obj, output_name, output_name2) {
	var frm = document.dataForm;
	if(input_obj.value == 3) {
		frm[output_name].value = "<?=$today?>";
	} else 	if(input_obj.value == 7 || input_obj.value == 8) {
		frm[output_name2].value = "<?=$today?>";
	} else {
		frm[output_name].value = "";
	}
}
function input_today_samu(input_obj, output_name, output_name2) {
	var frm = document.dataForm;
	if(input_obj.value == 4) {
		frm[output_name].value = "<?=$today?>";
		frm[output_name2].value = "";
	} else 	if(input_obj.value == 5) {
		frm[output_name2].value = "<?=$today?>";
	} else {
		frm[output_name].value = "";
	}
}
function input_today_easynomu(input_obj, output_name, output_name2) {
	var frm = document.dataForm;
	if(input_obj.value == 3) {
		frm[output_name].value = "<?=$today?>";
	} else 	if(input_obj.value == 5) {
		frm[output_name2].value = "<?=$today?>";
	} else {
		frm[output_name].value = "";
	}
}
function input_today_double(input_obj, output_name, vars, vars2) {
	var frm = document.dataForm;
	if(input_obj.value == vars || input_obj.value == vars2) {
		frm[output_name].value = "<?=$today?>";
	} else {
		frm[output_name].value = "";
	}
}
function checkbox_today(input_obj, output_name) {
	var frm = document.dataForm;
	if(input_obj.checked == true) {
		frm[output_name].value = "<?=$today?>";
	} else {
		frm[output_name].value = "";
	}
}
function chk_today(output_name, vars) {
	var frm = document.dataForm;
	frm[output_name].value = "<?=$today?>";
}
function uptae_change(obj_text) {
	var frm = document.dataForm;
	frm.uptae.value = obj_text;
}
function persons_0(obj) {
	var frm = document.dataForm;
	if(obj.checked) {
		frm.persons_gy_old.value = frm.persons_gy.value;
		frm.persons_sj_old.value = frm.persons_sj.value;
		frm.persons_gy.value = "";
		frm.persons_sj.value = "";
	} else {
		frm.persons_gy.value = frm.persons_gy_old.value;
		frm.persons_sj.value = frm.persons_sj_old.value;
	}
}
//�繫��Ź �̷�
function open_samu_history(id) {
	var ret = window.open("./samu_history_popup.php?id="+id, "window_samu_history", "scrollbars=yes,width=640,height=240");
	return;
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
if($samu_list == "ok") {
	$sql_samu = " select * from com_samu where com_code='$com_code' ";
	$result_samu = sql_query($sql_samu);
	$row_samu = mysql_fetch_array($result_samu);
}
?>
							<!--dataForm �� ����-->
							<form name="dataForm" method="post" enctype="MULTIPART/FORM-DATA">
								<input type="hidden" name="w" value="<?=$w?>">
								<!--�ŷ�ó �⺻���� �μ� ����-->
								<div id='print_page'>
									<table border=0 cellspacing=0 cellpadding=0 style=""> 
										<tr>
											<td> 
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
											<td width=10></td> 
											<td valign="bottom">�� �ʼ��� ������ ���� ��� "-" (������)���� �Է����ֽʽÿ�.</td> 
										</tr> 
									</table>
									<div style="height:2px;font-size:0px" class="bgtr"></div>
									<div style="height:2px;font-size:0px;line-height:0px;"></div>
									<!--�Է���-->
									<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
										<tr>
											<td nowrap class="tdrowk" width="110"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">������<font color="red">*</font></td>
											<td nowrap  class="tdrow" width="238">
												<div style="padding-top:3px;">
<?
if($report != "ok") {
?>
												<input name="firm_name" type="text" class="textfm" style="width:220px;ime-mode:active;" value="<?=$row['com_name']?>" maxlength="50">
<?
} else {
	echo $row['com_name'];
	echo "<input type='hidden' name='firm_name' value='".$row['com_name']."'>";
	if($samu_list == "ok") {
		echo "<br><span style='color:blue'>";
		if($row_samu['com_name_samu']) echo $row_samu['com_name_samu'];
		echo "</span>";
	}
}
?>
												</div>
											</td>
											<td nowrap class="tdrowk" width="100"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���������</td>
											<td nowrap  class="tdrow" width="210">
<?
if($report != "ok") {
?>
												<input name="cntr_sdate" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row['cntr_sdate']?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')">
												<table border=0 cellpadding=0 cellspacing=0 style="display:inline;vertical-align:middle"><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:loadCalendar(document.dataForm.cntr_sdate);" target="">�޷�</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table>
												��)2012.01.01
<?
} else {
	echo $row['cntr_sdate'];
}
?>
											</td>
											<td nowrap class="tdrowk" width="98"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����ڱ���<font color="red">*</font></td>
											<td nowrap  class="tdrow" width="">
<?
if($row[upche_div] == "1") {
	$chk_comp_type1 = "checked";
	$comp_type_text = "����";
} else if($row[upche_div] == "2") {
	$chk_comp_type2 = "checked";
	$comp_type_text = "����";
} else if($row[upche_div] == "3") {
	$chk_comp_type3 = "checked";
	$comp_type_text = "����";
}
if($report != "ok") {
?>
												<input type="radio" name="comp_type" value="1" <?=$chk_comp_type1?>>����
												<input type="radio" name="comp_type" value="2" <?=$chk_comp_type2?>>����
												<input type="radio" name="comp_type" value="3" <?=$chk_comp_type3?>>����
<?
} else {
	echo $comp_type_text;
}
?>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����ڹ�ȣ<font color="red">*</font></td>
											<td nowrap  class="tdrow">
<?
if($report != "ok") {
?>
												<input name="comp_bznb" type="text" class="textfm" style="width:120px;ime-mode:disabled;" value="<?=$row['biz_no']?>" maxlength="12" onkeydown="only_number()" onkeyup="checkhyphen(this.value, '1','Y')">
<?
} else {
	echo $row['biz_no'];
	echo "<input type='hidden' name='comp_bznb' value='".$row['biz_no']."'>";
}
?>
											</td>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����������ȣ</td>
											<td nowrap  class="tdrow">
<?
if($report != "ok") {
?>
												<input name="t_insureno" type="text" class="textfm" style="width:120px;ime-mode:disabled;" value="<?=$row['t_insureno']?>" maxlength="14" onkeydown="only_number()" onkeyup="checkhyphen_tno(this.value, '2','Y')">
												<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:check_tno();" target="">�ߺ�Ȯ��</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
<?
} else {
	echo $row['t_insureno'];
}
?>
											</td>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���ε�Ϲ�ȣ<font color="red"></font></td>
											<td nowrap  class="tdrow" width="">
<?
if($report != "ok") {
?>
												<input name="bupin_no" type="text" class="textfm" style="width:150px;" value="<?=$row['bupin_no']?>" maxlength="14" onkeydown="only_number_hyphen()" onkeyup="checkhyphen_bupin_no(this.value, '1','Y')">
<?
} else {
	echo $row['bupin_no'];
}
?>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����<font color="red">*</font></td>
											<td nowrap  class="tdrow">
<?
if($row['uptae_code']) {
	$uptae_code = $row['uptae_code'];
}
if($report != "ok") {
?>
												<input name="uptae" type="text" class="textfm" style="width:120px;ime-mode:active;" value="<?=$row['uptae']?>" maxlength="50">
												<select name="uptae_code" class="selectfm" onchange="uptae_change(this[this.selectedIndex].text);">
													<option value="">����</option>
<?
	for($i=1;$i<count($uptae_arry);$i++) {
		if($row['uptae_code'] == $i) $sel_uptae_code[$i] = "selected";
?>
													<option value="<?=$i?>" <?=$sel_uptae_code[$i]?>><?=$uptae_arry[$i]?></option>
<?
	}
?>
												</select>
<?
} else {
	echo $row['uptae'];
}
?>
											</td>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����</td>
											<td nowrap  class="tdrow" colspan="3">
												<div style="padding-top:3px;">
<?
if($report != "ok") {
?>
													<input name="upjong_code" id="upjong_code_undefined" type="text" class="textfm" style="width:40px;" value="<?=$row['upjong_code']?>" maxlength="5" readonly>
													<label onclick="open_upjong();" style="cursor:pointer"><img src="images/search_bt.png" align=absmiddle></label>
													<input name="upjong" id="upjong_undefined" type="text" class="textfm" style="width:450px;" value="<?=$row['upjong']?>" maxlength="25" readonly>
<?
} else {
	echo $row['upjong'];
	if($row['upjong_code']) echo " (".$row['upjong_code'].")";
	if($samu_list == "ok") {
		echo "<br><span style='color:blue'>";
		if($row_samu['upjong_gy']) echo " ���: ".$row_samu['upjong_gy'];
		if($row_samu['upjong_sj']) echo " ����: ".$row_samu['upjong_sj'];
		echo "</span>";
	}
}
?>
												</div>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����</td>
											<td nowrap  class="tdrow" colspan="3">
<?
if($report != "ok") {
?>
												<input name="jongmok" type="text" class="textfm" style="width:100%;ime-mode:active;" value="<?=$row['jongmok']?>" maxlength="100">
<?
} else {
	echo $row['jongmok'];
}
?>
											</td>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��ǥ�ڸ�<font color="red">*</font></td>
											<td nowrap  class="tdrow">
<?
if($report != "ok") {
?>
												<input name="cust_name" type="text" class="textfm" style="width:150;ime-mode:active;" value="<?=$row['boss_name']?>" maxlength="25">
<?
} else {
	echo $row['boss_name'];
	echo "<input type='hidden' name='cust_name' value='".$row['boss_name']."'>";
	if($samu_list == "ok") {
		echo "<span style='color:blue'>";
		if($row_samu['boss_name']) echo " ".$row_samu['boss_name'];
		echo "</span>";
	}
}
?>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��ȭ��ȣ<font color="red">*</font></td>
											<td nowrap  class="tdrow">
<?
$com_tel = explode("-",$row[com_tel]);
$com_tel1 = $com_tel[0];
$sel_cust_tel1 = array();
$sel_cust_tel1[$com_tel1] = "selected";
$com_tel2 = $com_tel[1];
$com_tel3 = $com_tel[2];
if($report != "ok") {
?>
												<select name="cust_tel1" class="selectfm">
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
												<input name="cust_tel2" type="text" class="textfm" style="width:35px;ime-mode:disabled;" value="<?=$com_tel2?>" maxlength="4" onKeyPress="onlyNumber();">
												-
												<input name="cust_tel3" type="text" class="textfm" style="width:35px;ime-mode:disabled;" value="<?=$com_tel3?>" maxlength="4" onKeyPress="onlyNumber();">
<?
} else {
	if($row['com_tel']) {
		//��ȭ��ȣ
		$com_tel = $row['com_tel'];
		//1544 ���� ������ȣ ����
		$com_tel_array = explode("-", $com_tel);
		if($com_tel_array[0] == "000") $com_tel = $com_tel_array[1]."-".$com_tel_array[2];
		echo $com_tel;
	}
	if($samu_list == "ok") {
		echo "<span style='color:blue'>";
		if($row_samu['com_tel']) echo " ".$row_samu['com_tel'];
		echo "</span>";
	}
}
?>
											</td>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�ѽ���ȣ<font color="red">*</font></td>
											<td nowrap  class="tdrow">
<?
$com_fax = explode("-",$row[com_fax]);
$com_fax1 = $com_fax[0];
$sel_cust_fax1 = array();
$sel_cust_fax1[$com_fax1] = "selected";
$com_fax2 = $com_fax[1];
$com_fax3 = $com_fax[2];
if($report != "ok") {
?>
												<select name="cust_fax1" class="selectfm">
													<option value="">����</option>
													<option value="02"  <?=$sel_cust_fax1['02']?> >02</option>
													<option value="031" <?=$sel_cust_fax1['031']?>>031</option>
													<option value="032" <?=$sel_cust_fax1['032']?>>032</option>
													<option value="033" <?=$sel_cust_fax1['033']?>>033</option>
													<option value="041" <?=$sel_cust_fax1['041']?>>041</option>
													<option value="042" <?=$sel_cust_fax1['042']?>>042</option>
													<option value="043" <?=$sel_cust_fax1['043']?>>043</option>
													<option value="044" <?=$sel_cust_fax1['044']?>>044</option>
													<option value="051" <?=$sel_cust_fax1['051']?>>051</option>
													<option value="052" <?=$sel_cust_fax1['052']?>>052</option>
													<option value="053" <?=$sel_cust_fax1['053']?>>053</option>
													<option value="054" <?=$sel_cust_fax1['054']?>>054</option>
													<option value="055" <?=$sel_cust_fax1['055']?>>055</option>
													<option value="061" <?=$sel_cust_fax1['061']?>>061</option>
													<option value="062" <?=$sel_cust_fax1['062']?>>062</option>
													<option value="063" <?=$sel_cust_fax1['063']?>>063</option>
													<option value="064" <?=$sel_cust_fax1['064']?>>064</option>
													<option value="070" <?=$sel_cust_fax1['070']?>>070</option>
													<option value="0303" <?=$sel_cust_fax1['0303']?>>0303</option>
													<option value="0502" <?=$sel_cust_fax1['0502']?>>0502</option>
													<option value="0505" <?=$sel_cust_fax1['0505']?>>0505</option>
													<option value="0507" <?=$sel_cust_fax1['0507']?>>0507</option>
												</select>
												-
												<input name="cust_fax2" type="text" class="textfm" style="width:35px;ime-mode:disabled;" value="<?=$com_fax2?>" maxlength="4" onKeyPress="onlyNumber();">
												-
												<input name="cust_fax3" type="text" class="textfm" style="width:35px;ime-mode:disabled;" value="<?=$com_fax3?>" maxlength="4" onKeyPress="onlyNumber();">
<?
} else {
	echo $row['com_fax'];
	$fax_error_array = array("","��������","�κ�����","��ȭ����","�������","���¹�ȣ","��ȭ��","��Ÿ");
	$fax_error = $row['fax_error'];
	if($fax_error) echo " (".$fax_error_array[$fax_error].")";
}
$sql_fax = " select * from fax_not where com_fax = '$row[com_fax]' ";
$row_fax = sql_fetch($sql_fax);
if($row_fax['fax_error']) echo "<span style='color:red'> �ѽ��Ұ�</span>";
?>
											</td>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��ǥ���ֹι�ȣ</td>
											<td nowrap class="tdrow">
<?
if($report != "ok") {
?>
												<input name="cust_ssnb" type="text" class="textfm" style="width:150;ime-mode:disabled;" value="<?=$row[jumin_no]?>" maxlength="14"  onkeydown="only_number_hyphen()" onkeyup="checkhyphen_bupin_no(this.value, '2','Y')">
<?
} else {
	echo $row['jumin_no'];
}
?>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����ڸ�<font color="red">*</font></td>
											<td nowrap  class="tdrow">
<?
if($report != "ok") {
?>
												<input name="damdang_name" type="text" class="textfm" style="width:140;ime-mode:active;" value="<?=$row[com_damdang]?>" maxlength="20" >
												��) ȫ�浿 ����
<?
} else {
	echo $row['com_damdang'];
}
?>
											</td>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�������ȭ</td>
											<td nowrap class="tdrow">
<?
$damdang_cel = explode("-",$row[com_damdang_tel]);
$damdang_cel1 = $damdang_cel[0];
$sel_damdang_cel1 = array();
$sel_damdang_cel1[$damdang_cel1] = "selected";
$damdang_cel2 = $damdang_cel[1];
$damdang_cel3 = $damdang_cel[2];
if($report != "ok") {
?>
												<select name="damdang_cel1" class="selectfm">
													<option value="">����</option>
													<option value="02"  <?=$sel_damdang_cel1['02']?> >02</option>
													<option value="031" <?=$sel_damdang_cel1['031']?>>031</option>
													<option value="032" <?=$sel_damdang_cel1['032']?>>032</option>
													<option value="033" <?=$sel_damdang_cel1['033']?>>033</option>
													<option value="041" <?=$sel_damdang_cel1['041']?>>041</option>
													<option value="042" <?=$sel_damdang_cel1['042']?>>042</option>
													<option value="043" <?=$sel_damdang_cel1['043']?>>043</option>
													<option value="044" <?=$sel_damdang_cel1['044']?>>044</option>
													<option value="051" <?=$sel_damdang_cel1['051']?>>051</option>
													<option value="052" <?=$sel_damdang_cel1['052']?>>052</option>
													<option value="053" <?=$sel_damdang_cel1['053']?>>053</option>
													<option value="054" <?=$sel_damdang_cel1['054']?>>054</option>
													<option value="055" <?=$sel_damdang_cel1['055']?>>055</option>
													<option value="061" <?=$sel_damdang_cel1['061']?>>061</option>
													<option value="062" <?=$sel_damdang_cel1['062']?>>062</option>
													<option value="063" <?=$sel_damdang_cel1['063']?>>063</option>
													<option value="064" <?=$sel_damdang_cel1['064']?>>064</option>
													<option value="070" <?=$sel_damdang_cel1['070']?>>070</option>
													<option value="010" <?=$sel_damdang_cel1['010']?>>010</option>
													<option value="011" <?=$sel_damdang_cel1['011']?>>011</option>
													<option value="016" <?=$sel_damdang_cel1['016']?>>016</option>
													<option value="017" <?=$sel_damdang_cel1['017']?>>017</option>
													<option value="018" <?=$sel_damdang_cel1['018']?>>018</option>
													<option value="019" <?=$sel_damdang_cel1['019']?>>019</option>
												</select>
												-
												<input name="damdang_cel2" type="text" class="textfm" style="width:35px;ime-mode:disabled;" value="<?=$damdang_cel2?>" maxlength="4" onKeyPress="onlyNumber();">
												-
												<input name="damdang_cel3" type="text" class="textfm" style="width:35px;ime-mode:disabled;" value="<?=$damdang_cel3?>" maxlength="4" onKeyPress="onlyNumber();">
<?
} else {
	echo $row['com_damdang_tel'];
}
?>
											</td>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��ǥ���ڵ���</td>
											<td nowrap  class="tdrow">
<?
$cust_cel = explode("-",$row[boss_hp]);
$cust_cel1 = $cust_cel[0];
//echo $cust_cel1;
$sel_cust_cel1 = array();
$sel_cust_cel1[$cust_cel1] = "selected";
//echo $sel_cust_cel1[$cust_cel1];
$cust_cel2 = $cust_cel[1];
$cust_cel3 = $cust_cel[2];
if($report != "ok") {
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
<?
} else {
	echo $row['boss_hp'];
}
?>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk" rowspan="3"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�ּ�<font color="red">*</font></td>
											<td nowrap  class="tdrow" rowspan="3" colspan="3">
<?
$adr_zip = explode("-",$row['com_postno']);
if($report != "ok") {
?>
												<input name="adr_zip1" type="text" class="textfm" style="width:30px;ime-mode:active;" value="<?=$adr_zip[0]?>" >
												-
												<input name="adr_zip2" type="text" class="textfm" style="width:30px;ime-mode:active;" value="<?=$adr_zip[1]?>" >
												<table border=0 cellpadding=0 cellspacing=0 style="display:inline;vertical-align:middle"><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:openDaumPostcode('adr_zip1','adr_zip2','adr_adr1','adr_adr2');" target="">�ּ�ã��</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table>
												<br>
												<input name="adr_adr1" type="text" class="textfm" style="width:480px;ime-mode:active;" value="<?=$row['com_juso']?>" >
												<br>
												<input name="adr_adr2" type="text" class="textfm" style="width:480px;ime-mode:active;" value="<?=$row['com_juso2']?>" maxlength="150">
<?
} else {
	if($row['com_postno']) echo "(".$row['com_postno'].") ";
	echo $row['com_juso']." ".$row['com_juso2'];
	if($samu_list == "ok") {
		echo "<span style='color:blue'>";
		if($row_samu['com_juso']) echo "<br>".$row_samu['com_juso'];
		echo "</span>";
	}
}
?>
											</td>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�̸���<font color="red">*</font></td>
											<td nowrap  class="tdrow">
<?
if($report != "ok") {
?>
												<input name="cust_email" type="text" class="textfm" style="width:192px;ime-mode:disabled;" value="<?=$row[com_mail]?>" maxlength="100">
<?
} else {
	echo $row['com_mail'];
}
?>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�����Ģ�Ű�</td>
											<td nowrap class="tdrow">
<?
if($row['employment_report'] == "") $sel_employment_report1 = "selected";
else if($row['employment_report'] == "1") $sel_employment_report2 = "selected";
else if($row['employment_report'] == "2") $sel_employment_report3 = "selected";
if($report != "ok") {
?>
												<select name="employment_report" class="selectfm">
													<option value="" <?=$sel_employment_report1?>>��</option>
													<option value="1" <?=$sel_employment_report2?>>��</option>
													<option value="2" <?=$sel_employment_report3?>>��</option>
												</select>
												<input name="employment_report_date" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row['employment_report_date']?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')">
												<table border=0 cellpadding=0 cellspacing=0 style="display:inline;vertical-align:middle"><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:loadCalendar(document.dataForm.employment_report_date);" target="">�޷�</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table>
<?
} else {
	echo $row['employment_report_date'];
}
?>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����� �Ը�</td>
											<td nowrap  class="tdrow">
<?
if($row['emp5_gbn'] == 1) $emp5_gbn = "checked";
if($row['emp30_gbn'] == 1) $emp30_gbn = "checked";
if($report != "ok") {
?>
												<input type="checkbox" name="emp5_gbn" value="1" <?=$emp5_gbn?> style="vertical-align:middle">5�� �̸�
												<input type="checkbox" name="emp30_gbn" value="1" <?=$emp30_gbn?> style="vertical-align:middle">30�� �̻�
<?
} else {
	if($row['emp5_gbn']) echo "5�� �̸�";
	if($row['emp30_gbn']) echo "30�� �̻�";
}
?>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">������<font color="red">*</font></td>
											<td nowrap  class="tdrow">
<?
//echo $stx_man_cust_name;
if($row['damdang_code']) {
	$man_cust_name_code = $row['damdang_code'];
} else {
	$man_cust_name_code = $stx_man_cust_name;
}
if($row['damdang_code2']) {
	$man_cust_name_code2 = $row['damdang_code2'];
}
if($report != "ok") {
	if($member['mb_level'] >= 7) {
		//echo count($man_cust_name_arry);
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
												����
												<select name="damdang_code2" class="selectfm">
													<option value="">����</option>
<?
	for($i=1;$i<count($man_cust_name_arry)-1;$i++) {
		if($row['damdang_code2'] == $i) $sel_damdang_code2[$i] = "selected";
?>
													<option value="<?=$i?>" <?=$sel_damdang_code2[$i]?>><?=$man_cust_name_arry[$i]?></option>
<?
	}
?>
												</select>
<?
	} else {
		echo $man_cust_name_arry[$man_cust_name_code];
		echo " (".$man_cust_name_arry[$man_cust_name_code2].")";
		echo "<input type='hidden' name='damdang_code' value='".$man_cust_name_code."'>";
		echo "<input type='hidden' name='damdang_code2' value='".$man_cust_name_code2."'>";
	}
} else {
	if($row['damdang_code']) echo $man_cust_name_arry[$man_cust_name_code];
	if($row['damdang_code2']) echo " (".$man_cust_name_arry[$man_cust_name_code2].")";
	echo "<input type='hidden' name='damdang_code' value='".$man_cust_name_code."'>";
	echo "<input type='hidden' name='damdang_code2' value='".$man_cust_name_code2."'>";
}
?>
											</td>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���Ŵ���<font color="red">*</font></td>
											<td nowrap  class="tdrow">
<?
if($w != "u") {
	$mb_id = $member['mb_id'];
	$mb_name = $member['mb_name'];
	$mb_profile_code = $member['mb_profile'];
	$mb_profile = $man_cust_name_arry[$mb_profile_code];
	$branch = $man_cust_name_arry[$damdang_code];
	//���Ŵ��� �ڵ� üũ
	$sql_manage = "select * from a4_manage where state = '1' and user_id = '$mb_id' ";
	$row_manage = sql_fetch($sql_manage);
	$manage_code = $row_manage['code'];
	$manage_name = $row_manage['name'];
} else {
	$manage_code = $row['manage_cust_numb'];
	$manage_name = $row['manage_cust_name'];
}
if($report != "ok") {
?>
<?
	if($member['mb_level'] >= 7) {
		//���� ���� �� �������� �ڵ� �ݿ�
		if($row['damdang_code2']) $damdang_code_no = "document.dataForm.damdang_code2.value";
		else $damdang_code_no = "document.dataForm.damdang_code.value";
?>
												<input type="text" name="manage_cust_numb" class="textfm" style="width:34px" readonly value="<?=$manage_code?>">
												<input name="manage_cust_name" type="text" class="textfm" style="width:88px" readonly value="<?=$manage_name?>">
												<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white nowrap"><a href="javascript:findNomu(<?=$damdang_code_no?>);" target="">�˻�</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
<?
	} else {
		if($w == "u") {
			if($row['manage_cust_name']) echo $row['manage_cust_name'];
			if($row['manage_cust_numb']) echo "(".$row['manage_cust_numb'].")";
			echo "<input type='hidden' name='manage_cust_numb' value='".$manage_code."'>";
			echo "<input type='hidden' name='manage_cust_name' value='".$manage_name."'>";
		} else {
			echo $manage_name;
			echo "(".$manage_code.")";
			echo "<input type='hidden' name='manage_cust_numb' value='".$manage_code."'>";
			echo "<input type='hidden' name='manage_cust_name' value='".$manage_name."'>";
		}
	}
?>
<?
} else {
	if($row['manage_cust_name']) echo $row['manage_cust_name'];
	if($row['manage_cust_numb']) echo "(".$row['manage_cust_numb'].")";
	echo "<input type='hidden' name='manage_cust_numb' value='".$manage_code."'>";
	echo "<input type='hidden' name='manage_cust_name' value='".$manage_name."'>";
}
?>
											</td>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�빫���α׷�</td>
											<td nowrap  class="tdrow">
<?
if($report != "ok") {
?>
												<input type="radio" name="easynomu_yn" value="1" <? if($row['easynomu_yn'] == 1) echo "checked"; ?>>�����빫
												<input type="radio" name="easynomu_yn" value="2" <? if($row['easynomu_yn'] == 2) echo "checked"; ?>>Ű��빫
												<input type="radio" name="easynomu_yn" value=""  <? if($row['easynomu_yn'] == "") echo "checked"; ?>>����
<?
} else {
	if($row['easynomu_yn'] == 1) echo "�����빫";
	else if($row['easynomu_yn'] == 2) echo "Ű��빫";
	else if($row['easynomu_yn'] == 3) echo "����";
}
?>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�����Ȳ</td>
											<td nowrap class="tdrow" width="" colspan="3">
<?
if($report != "ok") {
?>
												������
												<input name="p_support" type="text" class="textfm" style="width:40px;ime-mode:disabled;" value="<?=$row['p_support']?>" maxlength="3" onkeydown="only_number();" onkeyup=""> %
												�δ��
												<input name="p_contribution" type="text" class="textfm" style="width:40px;ime-mode:disabled;" value="<?=$row['p_contribution']?>" maxlength="3" onkeydown="only_number();" onkeyup=""> %
												��Ÿ
												<input name="p_construction" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row['p_construction']?>" maxlength="12" onkeydown="only_number();" onkeyup="">
<?
//��Ÿ ����
$p_construction_yn = $row['p_construction_yn'];
?>
												<select name="p_construction_yn" class="selectfm" onchange="">
													<option value=""  <? if($p_construction_yn == "")  echo "selected"; ?>>����</option>
													<option value="1" <? if($p_construction_yn == "1") echo "selected"; ?>>�Ǽ�������</option>
													<option value="2" <? if($p_construction_yn == "2") echo "selected"; ?>>�Ǽ������ݼұ޺�</option>
													<option value="3" <? if($p_construction_yn == "3") echo "selected"; ?>>�޿�����</option>
													<option value="4" <? if($p_construction_yn == "4") echo "selected"; ?>>�����Ģ</option>
													<option value="5" <? if($p_construction_yn == "5") echo "selected"; ?>>��Ÿ</option>
												</select>
<?
} else {
	echo "<input name='p_support' type='hidden' value='".$row['p_support']."'>";
	echo "<input name='p_contribution' type='hidden' value='".$row['p_contribution']."'>";
	if($row['p_support']) echo "������ : ".$row['p_support']."%";
	if($row['p_contribution']) echo "�δ�� : ".$row['p_contribution']."%";
	if($row['p_construction']) echo "��Ÿ : ".$row['p_construction']." ";
	if($row['p_construction_yn'] == 1) echo "�Ǽ�������";
	else if($row['p_construction_yn'] == 2) echo "�Ǽ������ݼұ޺�";
	else if($row['p_construction_yn'] == 3) echo "�޿�����";
	else if($row['p_construction_yn'] == 4) echo "�����Ģ";
	else if($row['p_construction_yn'] == 5) echo "��Ÿ";
}
?>
											</td>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�Ǽ�������</td>
											<td nowrap class="tdrow" width="">
<?
if($report != "ok") {
?>
												<input type="radio" name="construction_yn" value="1" <? if($row['construction_yn'] == 1) echo "checked"; ?>>�빫�ڻ�
												<input type="radio" name="construction_yn" value="2" <? if($row['construction_yn'] == 2) echo "checked"; ?>>��������
												<input type="radio" name="construction_yn" value=""  <? if($row['construction_yn'] == "") echo "checked"; ?>>����
<?
} else {
	if($row['construction_yn'] == 1) echo "�빫�ڻ�";
	else if($row['construction_yn'] == 2) echo "��������";
	else if($row['construction_yn'] == 3) echo "����";
}
?>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk" width="110"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�޸�<font color="red"></font></td>
											<td nowrap  class="tdrow" colspan="5">
<?
if($report != "ok") {
?>
												<textarea name="memo" class="textfm" style='width:100%;height:48px;word-break:break-all;' itemname="����" required><?=$memo?></textarea>
<?
} else {
	if($memo) echo "<pre>".$memo."</pre>";
}
?>
											</td>
										</tr>
									</table>
