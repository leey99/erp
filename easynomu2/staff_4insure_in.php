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
//����� Ÿ��
if($row_com_opt[comp_print_type]) {
	$comp_print_type = $row_com_opt[comp_print_type];
} else {
	$comp_print_type = "default";
}

//���� �ٷ��� ����
$chk_data_array = explode(",", $chk_data);
$check_cnt = sizeof($chk_data_array);

for( $i=0 ; $i < $check_cnt ; $i++) {
	$code_id_array = explode("_", $chk_data_array[$i]);
	$code = $code_id_array[0];
	$id = $code_id_array[1];
	echo $id;
}

$sql_common = " from $g4[pibohum_base] ";

$sub_title = "������";
$g4[title] = $sub_title." : ������� : ".$easynomu_name;

$colspan = 11;

$sql1 = " select * from $g4[pibohum_base] where com_code='$code' and sabun='$id' ";
echo $sql1;
$result1 = sql_query($sql1);

$sql2 = " select * from pibohum_base_opt where com_code='$code' and sabun='$id' ";
$result2 = sql_query($sql2);

$row1=mysql_fetch_array($result1);
$row2=mysql_fetch_array($result2);
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
<script type="text/javascript" src="./js/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/lang/calendar-ko.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
<script src="https://spi.maps.daum.net/imap/map_js_init/postcode.js"></script>
<script type="text/javascript">
//<![CDATA[
function openDaumPostcode(zip1,zip2,addr1,addr2) {
	new daum.Postcode({
			oncomplete: function(data) {
					frm = document.dataForm;
					frm.adr_zip1.value = data.postcode1;
					frm.adr_zip2.value = data.postcode2;
					frm.adr_adr1.value = data.address;
					frm.adr_adr2.focus();
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
								<input type="hidden" name="code" value="<?=$com_code?>">
								<input type="hidden" name="id" value="<?=$id?>">
								<input type="hidden" name="w" value="<?=$w?>">
								<input type="hidden" name="page" value="<?=$page?>">
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
											<input name="emp_name" type="text" class="textfm" style="width:150;ime-mode:active;" value="<?=$row1[name]?>" onKeyDown="if(event.keyCode == 13){ document.dataForm.emp_ssnb1.focus(); }" tabindex="1" maxlength="25">
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�ֹε�Ϲ�ȣ<font color="red">*</font></td>
										<td nowrap class="tdrow">
											<?
											$jumin_no = explode("-",$row1[jumin_no]);
											?>

											<input name="emp_ssnb1" type="text" class="textfm" style="width:60px;ime-mode:disabled;" value="<?=$jumin_no[0]?>" onKeyDown="if(event.keyCode == 13){ document.dataForm.emp_ssnb2.focus(); }" tabindex="2" maxlength="6" onKeyPress="onlyNumber();" onblur="getCont(this.value, document.dataForm.emp_ssnb2.value);" />
											-
											<input name="emp_ssnb2" type="text" class="textfm" style="width:73px;ime-mode:disabled;" value="<?=$jumin_no[1]?>" onKeyDown="if(event.keyCode == 13){ document.dataForm.pay_gbn[0].focus(); }" tabindex="3" maxlength="7" onKeyPress="onlyNumber();" onblur="getCont(document.dataForm.emp_ssnb1.value, this.value);" />
											<div id='rst' style="color:red;"></div>
											<input type="hidden" name="rst_chk" value="" />
										</td>
										<td nowrap class="tdrowk" rowspan="3">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�������
										</td>
										<td nowrap class="tdrow" rowspan="3">
											<?
												//�������
												if($row2[pic]) {
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
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�ܱ��� ����</td>
										<td nowrap class="tdrow">
											<?
											if($row1[fg_div] == 0) $foreign_gbn_checked_1 = "checked";
											else $foreign_gbn_checked_2 = "checked";
											?>

											<input type="radio" name="foreign_gbn" value="0" <?=$foreign_gbn_checked_1?>>������
											<input type="radio" name="foreign_gbn" value="1" <?=$foreign_gbn_checked_2?>>�ܱ���
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�ּ�</td>
										<td nowrap class="tdrow" colspan="3">
											<?
											$adr_zip = explode("-",$row1[w_postno]);
											?>
											<div style="float:left;height:22px">
												<input name="adr_zip1" type="text" class="textfm" style="width:30px;ime-mode:active;" value="<?=$adr_zip[0]?>" readonly>
												-
												<input name="adr_zip2" type="text" class="textfm" style="width:30px;ime-mode:active;" value="<?=$adr_zip[1]?>" readonly>
											</div>
											<div style="float:;height:22px">
												<table border=0 cellpadding=0 cellspacing=0><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:openDaumPostcode('adr_zip1','adr_zip2','adr_adr1','adr_adr2');" target="">�ּ�ã��</a></td><td><img src=./images/btn2_rt.gif></td><td width=2></td></tr></table>
											</div>
											<input name="adr_adr1" type="text" class="textfm" style="width:480px;ime-mode:active;" value="<?=$row1[w_juso]?>" readonly>
											<br>
											<input name="adr_adr2" type="text" class="textfm" style="width:480px;ime-mode:active;" value="<?=$row2[w_juso2]?>" maxlength="150">
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�޴���</td>
										<td nowrap class="tdrow">
											<?
											$emp_cel = explode("-",$row2[emp_cel]);
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
											$emp_tel = explode("-",$row1[add_tel]);
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
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��������</td>
										<td class="tdrow">
											<?
											if($row1[gubun] == 0) $emp_stat_chk0 = "checked";
											else if($row1[gubun] == 1) $emp_stat_chk1 = "checked";
											else if($row1[gubun] == 2) $emp_stat_chk2 = "checked";
											else if($row1[gubun] == 3) $emp_stat_chk3 = "checked";
											else $emp_stat_chk0 = "checked";
											?>

											<input type="radio" name="emp_stat" value="0" <?=$emp_stat_chk0?> >����
											<input type="radio" name="emp_stat" value="1" <?=$emp_stat_chk1?> >����
											<input type="radio" name="emp_stat" value="2" <?=$emp_stat_chk2?> >����
											<input type="radio" name="emp_stat" value="3" <?=$emp_stat_chk3?> >����
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">ä������</td>
										<td nowrap class="tdrow">
											<select name="work_form" onclick="work_form_func(this)">
											<?
											$work_form_id = $row1['work_form'];
											for($i=1; $i<5; $i++) {
											?>

											<option value="<?=$i?>" <? if($i == $work_form_id) echo "selected"; ?> ><?=$work_form_txt[$i]?></option>
											<?
											}
											?>

											</select>
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����(��å)</td>
										<td nowrap class="tdrow">
											<select name="position">
												<option value="">����</option>
												<?
												//�ű� �ٷ��� ��� �� Ȱ�������� �ڵ� ���� 150820
												if(!$w && $kind == "beistand") $row2['position'] = 13;
												$sql_position = " select * from com_code_list where item='position' and com_code='$code' order by code ";
												$result_position = sql_query($sql_position);
												for($i=0; $row_position=sql_fetch_array($result_position); $i++) {
												?>

												<option value="<?=$row_position[code]?>" <? if($row2[position] == $row_position[code]) echo "selected"; ?> ><?=$row_position[name]?></option>
												<?
												}
												?>

											</select>
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����</td>
										<td nowrap class="tdrow">
											<input name="jikjong_code" id="join_jikjong_code_undefined" type="text" class="textfm" style="width:30px;" value="<?=$row2[jikjong_code]?>" maxlength="3" readonly>
											<input name="jikjong" id="join_jikjong_undefined" type="text" class="textfm" style="width:140px;" value="<?=$row2[jikjong]?>" maxlength="25" readonly>
											<label onclick="open_jikjong();" style="cursor:pointer"><img src="images/search_bt.png" align=absmiddle></label>
										</td>
									</tr>
									<tr id="contract_term" style="">
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��������</td>
										<td class="tdrow">
											<input id="contract_sdate" name="contract_sdate" type="text" class="textfm5" style="width:80px;ime-mode:disabled;" value="<?=$row2[contract_sdate]?>" maxlength="10" readonly>
											<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:loadCalendar(document.dataForm.contract_sdate);" target="">�޷�</a></td><td><img src=./images/btn2_rt.gif></td><td width=2></td></tr></table>
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���������</td>
										<td class="tdrow">
											<input id="contract_edate" name="contract_edate" type="text" class="textfm5" style="width:80px;ime-mode:disabled;" value="<?=$row2[contract_edate]?>" maxlength="10" readonly>
											<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:loadCalendar(document.dataForm.contract_edate);" target="">�޷�</a></td><td><img src=./images/btn2_rt.gif></td><td width=2></td></tr></table>
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�����</td>
										<td nowrap class="tdrow">
											<input id="emp_edate" name="emp_edate" type="text" class="textfm" style="width:80;ime-mode:disabled;" value="<?=$row1['out_day']?>" tabindex="5" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, '2','Y')">
											 <table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:loadCalendar(document.all.emp_edate);" target="">�޷�</a></td><td><img src=./images/btn2_rt.gif></td><td width=2></td></tr></table>
												<input type="checkbox" name="out_temp" value="1" class="checkbox" <? if($row1['out_temp']) echo "checked"; ?> />�ӽ����
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
													�߰�����
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

								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<col width="11%">
									<col width="23%">
									<col width="12%">
									<col width="20%">
									<col width="10%">
									<col width="24%">
									<tr>
										<td nowrap class="tdrowk" rowspan="2"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���뺸��<font color="red"></font></td>
										<td nowrap class="tdrow" rowspan="2" colspan="3">
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
											if($row1[apply_jy] == "0") $isjy_chk = "checked"; 
											else $isjy_chk = "";
											//�ű� ��Ͻ� �׻� üũ
											if($w != "u") {
												$isgy_chk = "checked";
												$issj_chk = "checked";
												$iskm_chk = "checked";
												$isgg_chk = "checked"; 
												$isjy_chk = "checked"; 
											}
											?>

											<input type="checkbox" name="isgy" value="0" class="checkbox" <?=$isgy_chk?>>���
											<input type="checkbox" name="issj" value="0" class="checkbox" <?=$issj_chk?>>����
											<input type="checkbox" name="iskm" value="0" class="checkbox" <?=$iskm_chk?>>����
											<input type="checkbox" name="isgg" value="0" class="checkbox" <?=$isgg_chk?>>�ǰ�
											<input type="checkbox" name="isjy" value="0" class="checkbox" <?=$isjy_chk?>>�����
											<br>
											���ο��� �ű԰��� �Ұ�(��60�� �̻�), ��뺸�� �ű԰��� �Ұ�(�� 65�� �̻�)
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���뼼��</td>
										<td nowrap class="tdrow">
											<?
											if($row2[apply_so] == "0") $isso_chk = "checked";
											else $isso_chk = "";
											if($row2[apply_ju] == "0") $isju_chk = "checked";
											else $isju_chk = "";
											if($w != "u") {
												$isso_chk = "checked";
												$isju_chk = "checked";
											}
											?>

											<input type="checkbox" name="isso" value="0" class="checkbox" <?=$isso_chk?>>�ҵ漼,�ֹμ�
											<!--<input type="checkbox" name="isju" value="0" class="checkbox" <?=$isju_chk?>>�ֹμ�-->
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�η紩��
											<img src="./images/question_img.gif" onclick="clientxy_help(event, 'couponHelpDiv2');" style="cursor:pointer;vertical-align:middle">
										</td>
										<td nowrap class="tdrow">
<?
if($row2['insurance'] == "1") {
	$insurance_chk = "checked";
	$year_month_display = "";
} else {
	$insurance_chk = "";
	$year_month_display = "display:none";
}
?>
											<input type="checkbox" name="insurance" value="1" class="checkbox" <?=$insurance_chk?> style="vertical-align:middle" onclick="insurance_div(this);">�η紩�� ��ȸ����
											<div id="year_month" style="margin:0 0 4px 0;<?=$year_month_display?>">
												�������
												<select name="insurance_year">
<?
for($i=2014;$i<2016;$i++) {
?>
													<option value="<?=$i?>" <? if($i == $row2['insurance_year']) echo "selected"; ?> ><?=$i?></option>
<?
}
?>
												</select>��
												<select name="insurance_month">
<?
for($i=1;$i<13;$i++) {
	if($i < 10) $month = "0".$i;
	else $month = $i;
?>
													<option value="<?=$month?>" <? if($i == $row2['insurance_month']) echo "selected"; ?> ><?=$month?></option>
<?
}
?>


												</select>��
											</div>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�ξ簡����</td>
										<td nowrap class="tdrow" colspan="3">
											�� (��������)
<?
$family_cnt = $row2[family_cnt];
if($family_cnt == "" || $family_cnt == "0") $family_cnt = 1;
$child_cnt = $row2[child_cnt];
$etc_cnt = $row2[etc_cnt];
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
											��Ÿ �ξ簡��
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
										</td>
										<td nowrap class="tdrowk"></td>
										<td nowrap class="tdrow">
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�̸���</td>
										<td nowrap class="tdrow">
											<input name="emp_email" type="text" class="textfm" style="width:180px;ime-mode:disabled;" value="<?=$row2[emp_email]?>" maxlength="50">
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�μ���</td>
										<td nowrap class="tdrow">
											<input type="hidden" name="dept1" value="<?=$row2[dept_1]?>" />
											<select name="dept" onchange="document.dataForm.dept1.value=this[this.selectedIndex].text;">
												<option value="">����</option>
												<?
												$sql_dept = " select * from com_code_list where item='dept' and com_code='$code' order by code ";
												$result_dept = sql_query($sql_dept);
												for($i=0; $row_dept=sql_fetch_array($result_dept); $i++) {
												?>

												<option value="<?=$row_dept[code]?>" <? if($row2[dept] == $row_dept[code]) echo "selected"; ?> ><?=$row_dept[name]?></option>
												<?
												}
												?>

											</select>
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�Ҽ�����</td>
										<td class="tdrow">
											<input size="20" type="text" class="textfm" name="dept2" value="<?=$row2[dept_2]?>" />
										</td>
									</tr>
									<tr>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���¹�ȣ</td>
										<td class="tdrow">
											<input type="text" class="textfm" name="bank_2" value="<?=$row2[bank_account]?>" style="width:166px" />
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�����</td>
										<td class="tdrow">
											<select name="bank_1">
												<option value="">����</option>
												<option value="�츮����" <? if($row2[bank_name] == "�츮����") echo "selected"; ?>>�츮����</option>
												<option value="��������" <? if($row2[bank_name] == "��������") echo "selected"; ?>>��������</option>
												<option value="��ȯ����" <? if($row2[bank_name] == "��ȯ����") echo "selected"; ?>>��ȯ����</option>
												<option value="�������" <? if($row2[bank_name] == "�������") echo "selected"; ?>>�������</option>
												<option value="��������" <? if($row2[bank_name] == "��������") echo "selected"; ?>>��������</option>
												<option value="�ϳ�����" <? if($row2[bank_name] == "�ϳ�����") echo "selected"; ?>>�ϳ�����</option>
												<option value="��������" <? if($row2[bank_name] == "��������") echo "selected"; ?>>��������</option>
												<option value="�뱸����" <? if($row2[bank_name] == "�뱸����") echo "selected"; ?>>�뱸����</option>
												<option value="�λ�����" <? if($row2[bank_name] == "�λ�����") echo "selected"; ?>>�λ�����</option>
												<option value="��������" <? if($row2[bank_name] == "��������") echo "selected"; ?>>��������</option>
												<option value="�泲����" <? if($row2[bank_name] == "�泲����") echo "selected"; ?>>�泲����</option>
												<option value="��������" <? if($row2[bank_name] == "��������") echo "selected"; ?>>��������</option>
												<option value="��������" <? if($row2[bank_name] == "��������") echo "selected"; ?>>��������</option>
												<option value="��ü��" <? if($row2[bank_name] == "��ü��") echo "selected"; ?>>��ü��</option>
												<option value="�ѱ���Ƽ����" <? if($row2[bank_name] == "�ѱ���Ƽ����") echo "selected"; ?>>�ѱ���Ƽ����</option>
												<option value="�������ݰ�" <? if($row2[bank_name] == "�������ݰ�") echo "selected"; ?>>�������ݰ�</option>
												<option value="�ſ���������" <? if($row2[bank_name] == "�ſ���������") echo "selected"; ?>>�ſ���������</option>
												<option value="���Ĵٵ���Ÿ������" <? if($row2[bank_name] == "���Ĵٵ���Ÿ������") echo "selected"; ?>>���Ĵٵ���Ÿ������</option>
											</select>
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">������</td>
										<td class="tdrow">
											<input size="20" type="text" class="textfm" name="bank_3" value="<?=$row2[bank_depositor]?>" />
										</td>
									</tr>
									<tr>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����</td>
										<td class="tdrow">
											<input type="text" class="textfm" name="nation" value="<?=$row1['nation']?>" style="width:166px" />
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">ü���ڰ�</td>
										<td class="tdrow">
											<select name="staycapacity">
												<option value="">����</option>
												<option value="B1" <? if($row1['staycapacity'] == "B1") echo "selected"; ?>>B1 ��������</option>
												<option value="B2" <? if($row1['staycapacity'] == "B2") echo "selected"; ?>>B2 �������</option>
												<option value="C2" <? if($row1['staycapacity'] == "C2") echo "selected"; ?>>C2 �ܱ���</option>
												<option value="C3" <? if($row1['staycapacity'] == "C3") echo "selected"; ?>>C3 �ܱ�����</option>
												<option value="C4" <? if($row1['staycapacity'] == "C4") echo "selected"; ?>>C4 �ܱ����</option>
												<option value="D2" <? if($row1['staycapacity'] == "D2") echo "selected"; ?>>D2 ����</option>
												<option value="D3" <? if($row1['staycapacity'] == "D3") echo "selected"; ?>>D3 �������</option>
												<option value="D4" <? if($row1['staycapacity'] == "D4") echo "selected"; ?>>D4 �Ϲݿ���</option>
												<option value="E4" <? if($row1['staycapacity'] == "E4") echo "selected"; ?>>E4 �������</option>
												<option value="E5" <? if($row1['staycapacity'] == "E5") echo "selected"; ?>>E5 ��������</option>
												<option value="E7" <? if($row1['staycapacity'] == "E7") echo "selected"; ?>>E7 Ư��Ȱ��</option>
												<option value="E8" <? if($row1['staycapacity'] == "E8") echo "selected"; ?>>E8 �������</option>
												<option value="E9" <? if($row1['staycapacity'] == "E9") echo "selected"; ?>>E9 ���������</option>
												<option value="E10" <? if($row1['staycapacity'] == "E10") echo "selected"; ?>>E10 �������</option>
												<option value="F1" <? if($row1['staycapacity'] == "F1") echo "selected"; ?>>F1 �湮����</option>
												<option value="F2" <? if($row1['staycapacity'] == "F2") echo "selected"; ?>>F2 ����</option>
												<option value="F3" <? if($row1['staycapacity'] == "F3") echo "selected"; ?>>F3 ����</option>
												<option value="F4" <? if($row1['staycapacity'] == "F4") echo "selected"; ?>>F4 ��ܵ���</option>
												<option value="F5" <? if($row1['staycapacity'] == "F5") echo "selected"; ?>>F5 ����</option>
												<option value="G1" <? if($row1['staycapacity'] == "G1") echo "selected"; ?>>G1 ��Ÿ</option>
												<option value="H1" <? if($row1['staycapacity'] == "H1") echo "selected"; ?>>H1 �������</option>
												<option value="H2" <? if($row1['staycapacity'] == "H2") echo "selected"; ?>>H2 �湮���</option>
											</select>
										</td>
										<td class="tdrowk"></td>
										<td class="tdrow">
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">Ư�̻���</td>
										<td nowrap class="tdrow" colspan="5">
											<input type="text" class="textfm" name="remark" value="<?=$row2[remark]?>" style="width:100%" />
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
									<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
										<col width="12%">
										<col width="22%">
										<col width="12%">
										<col width="20%">
										<col width="10%">
										<col width="24%">
										<tr>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����ο���</td>
											<td nowrap class="tdrow">
												<?
												if($row2[drawback_form] == 0) $drawback_form_chk0 = "selected";
												else if($row2[drawback_form] == 1) $drawback_form_chk1 = "selected";
												else if($row2[drawback_form] == 2) $drawback_form_chk2 = "selected";
												else if($row2[drawback_form] == 3) $drawback_form_chk3 = "selected";
												else if($row2[drawback_form] == 4) $drawback_form_chk4 = "selected";
												else if($row2[drawback_form] == 5) $drawback_form_chk5 = "selected";
												else if($row2[drawback_form] == 6) $drawback_form_chk6 = "selected";
												else if($row2[drawback_form] == 7) $drawback_form_chk7 = "selected";
												else if($row2[drawback_form] == 8) $drawback_form_chk8 = "selected";
												else if($row2[drawback_form] == 9) $drawback_form_chk9 = "selected";
												else if($row2[drawback_form] == 10) $drawback_form_chk10 = "selected";
												else if($row2[drawback_form] == 11) $drawback_form_chk11 = "selected";
												else if($row2[drawback_form] == 12) $drawback_form_chk12 = "selected";
												else if($row2[drawback_form] == 13) $drawback_form_chk13 = "selected";
												else if($row2[drawback_form] == 14) $drawback_form_chk14 = "selected";
												else if($row2[drawback_form] == 15) $drawback_form_chk15 = "selected";
												else if($row2[drawback_form] == 16) $drawback_form_chk16 = "selected";
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
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�����</td>
											<td nowrap class="tdrow">
												<?
												if($row2[aged] == 1) $aged_chk = "checked";
												else $aged_chk = "";
												if($row2[insurance] == 1) $insurance_chk = "checked";
												else $insurance_chk = "";
												if($row2[retired] == 1) $retired_chk = "checked";
												else $retired_chk = "";
												if($row2[deferred] == 1) $deferred_chk = "checked";
												else $deferred_chk = "";
												?>

												<input type="checkbox" name="aged" value="1" class="checkbox" <?=$aged_chk?>> 60���̻�
											</td>
											<td nowrap class="tdrowk"></td>
											<td nowrap class="tdrow">
												
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">������������</td>
											<td nowrap class="tdrow">
												<select name="retired" class="selectfm">
													<option value=""  <?=$retired_chk0?> >�ش���׾���</option>
													<option value="1" <?=$retired_chk1?> >������������</option>
												</select>
											</td>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���͹ΰ��</td>
											<td nowrap class="tdrow">
												<input type="checkbox" name="deferred" value="1" class="checkbox" <?=$deferred_chk?>> ���͹ΰ������
											</td>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��꿩��</td>
											<td nowrap class="tdrow">
												<?
												if($row2[chidbirth] == "") $chidbirth_chk0 = "selected";
												else if($row2[chidbirth] == 1) $chidbirth_chk1 = "selected";
												else if($row2[chidbirth] == 2) $chidbirth_chk2 = "selected";
												?>

												<select name="chidbirth" class="selectfm">
													<option value=""  <?=$chidbirth_chk0?> >�ش���׾���</option>
													<option value="1" <?=$chidbirth_chk1?> >������Ʊ���</option>
													<option value="2" <?=$chidbirth_chk2?> >������Ʊ��ü�η�</option>
												</select>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��������</td>
											<td nowrap class="tdrow">
												<?
												if($row2[matriarch] == "") $matriarch_selected0 = "selected";
												else if($row2[matriarch] == 1) $matriarch_selected1 = "selected";
												else if($row2[matriarch] == 2) $matriarch_selected2 = "selected";
												?>

												<select name="matriarch" class="selectfm">
													<option value=""  <?=$matriarch_selected0?> >�ش���׾���</option>
													<option value="1" <?=$matriarch_selected1?> >�Ѻθ���</option>
													<option value="2" <?=$matriarch_selected2?> >���ʻ�Ȱ�����</option>
												</select>
											</td>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��������</td>
											<td nowrap class="tdrow">
												<input type="checkbox" name="rural" value="1" class="checkbox" <? if($row2[rural] == "1") echo "checked"; ?> > ��������������
											</td>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">ó�찳����</td>
											<td nowrap class="tdrow">
												<input type="checkbox" name="treatment" value="1" class="checkbox" <? if($row2[treatment] == "1") echo "checked"; ?> > ó�찳����
											</td>
										</tr>
									</table>
									<div style="height:4px;font-size:0px;line-height:0px;"></div>

									<?
									$fund_array = explode(",",$row2[fund]);
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
											<td class="tdrow"><input type="checkbox" name="fund[0]" value="1" class="checkbox" <?=$fund_chk1?>> ���������Ű��<br><img src="images/blank.gif" width="24" height="1">(���뵿��)</td>
											<td class="tdrow"><input type="checkbox" name="fund[1]" value="1" class="checkbox" <?=$fund_chk2?>> 50+�����������������<br><img src="images/blank.gif" width="24" height="1">(���뵿��)</td>
											<td class="tdrow"><input type="checkbox" name="fund[2]" value="1" class="checkbox" <?=$fund_chk3?>> ���������Ʒ� ���α׷�<br><img src="images/blank.gif" width="24" height="1">(��´���������������)</td>
											<td class="tdrow"><input type="checkbox" name="fund[3]" value="1" class="checkbox" <?=$fund_chk4?>> ����� ����ɷ�������α׷�<br><img src="images/blank.gif" width="24" height="1">(�������������)</td>
										</tr>
										<tr>
											<td class="tdrow"><input type="checkbox" name="fund[4]" value="1" class="checkbox" <?=$fund_chk5?>> ������ ���α׷�<br><img src="images/blank.gif" width="24" height="1">(�ѱ�����ΰ�����)</td>
											<td class="tdrow"><input type="checkbox" name="fund[5]" value="1" class="checkbox" <?=$fund_chk6?>> �����ɷ°����Ʒ� ���α׷�<br><img src="images/blank.gif" width="24" height="1">(�ѱ�����ΰ�����)</td>
											<td class="tdrow"><input type="checkbox" name="fund[6]" value="1" class="checkbox" <?=$fund_chk7?>> ������Ȱ ���α׷�<br><img src="images/blank.gif" width="24" height="1">(�ѱ�����ΰ�����)</td>
											<td class="tdrow"><input type="checkbox" name="fund[7]" value="1" class="checkbox" <?=$fund_chk8?>> �о��ߴ� û�ҳ� �ڸ�/�н����� ���<br><img src="images/blank.gif" width="24" height="1">(����������)</td>
										</tr>
										<tr>
											<td class="tdrow"><input type="checkbox" name="fund[8]" value="1"  class="checkbox" <?=$fund_chk9?> > ��Ȱ�ٷ�<br><img src="images/blank.gif" width="24" height="1">(������ü��ü)</td>
											<td class="tdrow"><input type="checkbox" name="fund[9]" value="1" class="checkbox" <?=$fund_chk10?>> ������� ������Ʈ<br><img src="images/blank.gif" width="24" height="1">(���Ǻ�����)</td>
											<td class="tdrow"><input type="checkbox" name="fund[10]" value="1" class="checkbox" <?=$fund_chk11?>> ����� ������ڸ� ���� ���α׷�<br><img src="images/blank.gif" width="24" height="1">(������,�ѱ�������ȣ��������)</td>
											<td class="tdrow"><input type="checkbox" name="fund[11]" value="1" class="checkbox" <?=$fund_chk12?>> �����⺻���� (�ѱ����ƺ����Ƿ����,<br><img src="images/blank.gif" width="24" height="1">���뱺����������)</td>
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
												<input size="14" type="text" class="textfm" name="school_sdate" value="<?=$row2[school_sdate]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '3','Y')" /> ~
												<input size="14" type="text" class="textfm" name="school_edate" value="<?=$row2[school_edate]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '4','Y')" /> ��) 2001.03.02~2005.02.10
											</td>
											<td class="tdrow">
												<input size="40" type="text" class="textfm" name="school_name" value="<?=$row2[school_name]?>" />
											</td>
											<td class="tdrow">
												<input size="33" type="text" class="textfm" name="school_part" value="<?=$row2[school_part]?>" />
											</td>
										</tr>
										<tr>
											<td class="tdrow">
												<input size="14" type="text" class="textfm" name="school_sdate2" value="<?=$row2[school_sdate2]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '5','Y')" /> ~
												<input size="14" type="text" class="textfm" name="school_edate2" value="<?=$row2[school_edate2]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '6','Y')" />
											</td>
											<td class="tdrow">
												<input size="40" type="text" class="textfm" name="school_name2" value="<?=$row2[school_name2]?>" />
											</td>
											<td class="tdrow">
												<input size="33" type="text" class="textfm" name="school_part2" value="<?=$row2[school_part2]?>" />
											</td>
										</tr>
										<tr>
											<td class="tdrow">
												<input size="14" type="text" class="textfm" name="school_sdate3" value="<?=$row2[school_sdate3]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '7','Y')" /> ~
												<input size="14" type="text" class="textfm" name="school_edate3" value="<?=$row2[school_edate3]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '8','Y')" />
											</td>
											<td class="tdrow">
												<input size="40" type="text" class="textfm" name="school_name3" value="<?=$row2[school_name3]?>" />
											</td>
											<td class="tdrow">
												<input size="33" type="text" class="textfm" name="school_part3" value="<?=$row2[school_part3]?>" />
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
												<input size="14" type="text" class="textfm" name="career_sdate" value="<?=$row2[career_sdate]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '9','Y')" /> ~
												<input size="14" type="text" class="textfm" name="career_edate" value="<?=$row2[career_edate]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '10','Y')" /> ��) 2001.03.02~2005.02.10
											</td>
											<td class="tdrow">
												<input size="40" type="text" class="textfm" name="career_name" value="<?=$row2[career_name]?>" />
											</td>
											<td class="tdrow">
												<input size="33" type="text" class="textfm" name="career_part" value="<?=$row2[career_part]?>" />
											</td>
										</tr>
										<tr>
											<td class="tdrow">
												<input size="14" type="text" class="textfm" name="career_sdate2" value="<?=$row2[career_sdate2]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '11','Y')" /> ~
												<input size="14" type="text" class="textfm" name="career_edate2" value="<?=$row2[career_edate2]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '12','Y')" />
											</td>
											<td class="tdrow">
												<input size="40" type="text" class="textfm" name="career_name2" value="<?=$row2[career_name2]?>" />
											</td>
											<td class="tdrow">
												<input size="33" type="text" class="textfm" name="career_part2" value="<?=$row2[career_part2]?>" />
											</td>
										</tr>
										<tr>
											<td class="tdrow">
												<input size="14" type="text" class="textfm" name="career_sdate3" value="<?=$row2[career_sdate3]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '13','Y')" /> ~
												<input size="14" type="text" class="textfm" name="career_edate3" value="<?=$row2[career_edate3]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '14','Y')" />
											</td>
											<td class="tdrow">
												<input size="40" type="text" class="textfm" name="career_name3" value="<?=$row2[career_name3]?>" />
											</td>
											<td class="tdrow">
												<input size="33" type="text" class="textfm" name="career_part3" value="<?=$row2[career_part3]?>" />
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
												<input size="14" type="text" class="textfm" name="education_sdate" value="<?=$row2[education_sdate]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '17','Y')" /> ~
												<input size="14" type="text" class="textfm" name="education_edate" value="<?=$row2[education_edate]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '18','Y')" /> ��) 2001.03.02~2005.02.10
											</td>
											<td class="tdrow">
												<input size="40" type="text" class="textfm" name="education_name" value="<?=$row2[education_name]?>" />
											</td>
											<td class="tdrow">
												<input size="33" type="text" class="textfm" name="education_organization" value="<?=$row2[education_organization]?>" />
											</td>
										</tr>
										<tr>
											<td class="tdrow">
												<input size="14" type="text" class="textfm" name="education_sdate2" value="<?=$row2[education_sdate2]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '19','Y')" /> ~
												<input size="14" type="text" class="textfm" name="education_edate2" value="<?=$row2[education_edate2]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '20','Y')" />
											</td>
											<td class="tdrow">
												<input size="40" type="text" class="textfm" name="education_name2" value="<?=$row2[education_name2]?>" />
											</td>
											<td class="tdrow">
												<input size="33" type="text" class="textfm" name="education_organization2" value="<?=$row2[education_organization2]?>" />
											</td>
										</tr>
										<tr>
											<td class="tdrow">
												<input size="14" type="text" class="textfm" name="education_sdate3" value="<?=$row2[education_sdate3]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '21','Y')" /> ~
												<input size="14" type="text" class="textfm" name="education_edate3" value="<?=$row2[education_edate3]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '22','Y')" />
											</td>
											<td class="tdrow">
												<input size="40" type="text" class="textfm" name="education_name3" value="<?=$row2[education_name3]?>" />
											</td>
											<td class="tdrow">
												<input size="33" type="text" class="textfm" name="education_organization3" value="<?=$row2[education_organization3]?>" />
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
												<input size="14" type="text" class="textfm" name="license_date" value="<?=$row2[license_date]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '23','Y')" /> ��) 2012.12.10
											</td>
											<td class="tdrow">
												<input size="40" type="text" class="textfm" name="license_name" value="<?=$row2[license_name]?>" />
											</td>
											<td class="tdrow">
												<input size="26" type="text" class="textfm" name="license_step" value="<?=$row2[license_step]?>" />
											</td>
											<td class="tdrow">
												<input size="29" type="text" class="textfm" name="license_organization" value="<?=$row2[license_organization]?>" />
											</td>
										</tr>
										<tr>
											<td class="tdrow">
												<input size="14" type="text" class="textfm" name="license_date2" value="<?=$row2[license_date2]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '24','Y')" />
											</td>
											<td class="tdrow">
												<input size="40" type="text" class="textfm" name="license_name2" value="<?=$row2[license_name2]?>" />
											</td>
											<td class="tdrow">
												<input size="26" type="text" class="textfm" name="license_step2" value="<?=$row2[license_step2]?>" />
											</td>
											<td class="tdrow">
												<input size="29" type="text" class="textfm" name="license_organization2" value="<?=$row2[license_organization2]?>" />
											</td>
										</tr>
										<tr>
											<td class="tdrow">
												<input size="14" type="text" class="textfm" name="license_date3" value="<?=$row2[license_date3]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '25','Y')" />
											</td>
											<td class="tdrow">
												<input size="40" type="text" class="textfm" name="license_name3" value="<?=$row2[license_name3]?>" />
											</td>
											<td class="tdrow">
												<input size="26" type="text" class="textfm" name="license_step3" value="<?=$row2[license_step3]?>" />
											</td>
											<td class="tdrow">
												<input size="29" type="text" class="textfm" name="license_organization3" value="<?=$row2[license_organization3]?>" />
											</td>
										</tr>
									</table>
								</div>
							</div>
							<!--tab1-->

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
if($id) {
	$url_pay = "./staff_pay_view.php?w=u&id=$id&code=$code&page=$page";
} else {
	$url_pay = "javascript:alert('���� �� �̿��Ͻʽÿ�.');";
}
//ȭ��������κθ�ȸ : Ȱ��������
if($comp_print_type == "H") {
	if($row2['position'] == "13" || $kind == "beistand") {
		$url_list = "staff_list_beistand.php?page=".$page;
	} else if($row2['position'] == "14" || $kind == "helper") {
		$url_list = "staff_list_helper.php?page=".$page;
	} else {
		$url_list = "staff_list.php?page=".$page;
	}
} else {
	$url_list = "staff_list.php?page=".$page;
}
?>
							<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed;margin-top:20px">
								<tr>
									<td style="text-align:center">
										<a href="<?=$url_save?>" target=""><img src="images/btn_save_big.png" border="0"></a>
										<a href="<?=$url_pay?>" target=""><img src="images/btn_pay_info_big.png" border="0"></a>
										<a href="<?=$url_list?>" target=""><img src="images/btn_list_big.png" border="0"></a>
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
</body>
</html>
