<?
$sub_menu = "400100";
include_once("./_common.php");

$sql_common = " from $g4[pibohum_base] ";

$sub_title = "�޿��ݿ�";
$g4[title] = $sub_title." : �޿����� : �����빫";

$colspan = 11;

$sql1 = " select * from $g4[pibohum_base] where com_code='$code' and sabun='$id' ";

//echo $sql1;
$result1 = sql_query($sql1);
$row1=mysql_fetch_array($result1);

$sql2 = " select * from pibohum_base_opt where com_code='$code' and sabun='$id' ";
$result2 = sql_query($sql2);
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
									<td><img src="images/subname04.gif" /></td>
								</tr>
								<tr>
									<td><a href="pay_list.php" onmouseover="limg1.src='images/menu04_sub01_on.gif'" onmouseout="limg1.src='images/menu04_sub01_off.gif'"><img src="images/menu04_sub01_off.gif" name="limg1" id="limg1" /></a></td>
								</tr>
								<tr>
									<td><a href="pay_ledger_list.php" onmouseover="limg2.src='images/menu04_sub02_on.gif'" onmouseout="limg2.src='images/menu04_sub02_off.gif'"><img src="images/menu04_sub02_off.gif" name="limg2" id="limg2" /></a></td>
								</tr>
								<tr>
									<td><a href="pay_statistics.php" onmouseover="limg3.src='images/menu04_sub03_on.gif'" onmouseout="limg3.src='images/menu04_sub03_off.gif'"><img src="images/menu04_sub03_off.gif" name="limg3" id="limg3" /></a></td>
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

							<!--�˻� -->
							<form name="dataForm" method="post">
							<input type="hidden" name="w" value="<?=$w?>">
							<input type="hidden" name="page" value="<?=$page?>">
							<input type="hidden" name="com_code" value="<?=$row1[com_code]?>">
							<input type="hidden" name="id" value="<?=$id?>">

							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
								<col width="11%">
								<col width="14%">
								<col width="11%">
								<col width="14%">
								<col width="11%">
								<col width="14%">
								<col width="11%">
								<col width="14%">
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����</td>
									<td nowrap class="tdrow">
										<?=$row1[name]?>
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�ֹε�Ϲ�ȣ</td>
									<td nowrap class="tdrow">
										<?=$row1[jumin_no]?>
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�Ի���</td>
									<td nowrap class="tdrow">
										<?=$row1[in_day]?>
									</td>
									<td nowrap class="tdrowk">
										<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����
									</td>
									<td nowrap class="tdrow">
<?
if($row2[pay_gbn] == "") echo "";
else if($row2[pay_gbn] == "1") echo "������";
else if($row2[pay_gbn] == "2") echo "�ñ���";
else if($row2[pay_gbn] == "3") echo "���ձٹ�";
?>
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����</td>
									<td nowrap class="tdrow">
<?
$sql_position = " select * from com_code_list where code='$row2[position]' ";
$result_position = sql_query($sql_position);
$row_position=mysql_fetch_array($result_position);
echo $row_position[name];
?>
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�����з�</td>
									<td nowrap class="tdrow">
<?
$sql_step = " select * from com_code_list where code='$row2[step]' ";
$result_step = sql_query($sql_step);
$row_step=mysql_fetch_array($result_step);
echo $row_step[name];
?>
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�ټ�ȣ��</td>
									<td nowrap class="tdrow">
										<?=$row2[pay_step]?>
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">ä������</td>
									<td nowrap class="tdrow">
<?
if($row1[work_form] == "") echo "";
else if($row1[work_form] == "1") echo "������";
else if($row1[work_form] == "2") echo "�����";
else if($row1[work_form] == "3") echo "�Ͽ���";
?>
									</td>
								</tr>
							</table>

							<div style="height:2px;font-size:0px;line-height:0px;"></div>
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
								<col width="11%">
								<col width="23%">
								<col width="12%">
								<col width="20%">
								<col width="10%">
								<col width="24%">
								<tr>
									<td class="tdrowk_center">����</td>
									<td class="tdrow">
										<input type="radio" name="pay_gbn" value="01" onclick="displayPayGbn();checkDocNo();" checked >������
										<input type="radio" name="pay_gbn" value="02" onclick="displayPayGbn();checkDocNo();">�ñ���
										<input type="radio" name="pay_gbn" value="04" onclick="displayPayGbn();checkDocNo();">���ձٹ�
									</td>
									<td class="tdrowk_center">�ֱٷνð�</td>
									<td class="tdrow">
										<input type="radio" name="work_gbn" value="A" onclick="">��40�ð�
										<input type="radio" name="work_gbn" value="B" onclick="" checked >��44�ð�
									</td>
									<td class="tdrowk_center">�ְ� �ٷ���</td>
									<td class="tdrow">
										<input name="workday_month" type="hidden" value="20">
										<span id="workday_month_text" style="display:;">
<?
if($row_com_opt[workday_month] == 20) {
$workhour_day_d = 8;
echo "5�ϱٷ�";
} else if($row_com_opt[workday_month] == 24) {
$workhour_day_d = 8;
echo "6�ϱٷ�";
}
?>
(������������ ���氡��)
										</span>
										<select id="workday_week" name="workday_week" class="selectfm" style="display:none;" onChange="changeWorkDayWeek();">
											<option value="">�ְ��ٷ��� ����</option>
											<option value="1" >1�ϱٷ�</option>
											<option value="2" >2�ϱٷ�</option>
											<option value="3" >3�ϱٷ�</option>
											<option value="4" >4�ϱٷ�</option>
											<option value="5" selected>5�ϱٷ�</option>
											<option value="6" >6�ϱٷ�</option>
											<option value="7" >7�ϱٷ�</option>
										</select>
									</td>
								</tr>
								<tr>
									<td class="tdrowk_center">����</td>
									<td class="tdrow">
										<input size="10" type="text" class="textfm" name="pay_year" id="pay_year" value="18660720" />
									</td>
									<td class="tdrowk_center">�����ӱ�</td>
									<td class="tdrow">
										<input size="10" type="text" class="textfm" name="pay_month" id="pay_month" value="1555060"/>
									</td>
									<td class="tdrowk_center">�󿩱�</td>
									<td class="tdrow">
										<select name="bonus" style="width:70px">
											<option value='0' >0%</option><option value='100' >100%</option><option value='200' selected>200%</option><option value='300' >300%</option><option value='400' >400%</option><option value='500' >500%</option><option value='600' >600%</option><option value='700' >700%</option><option value='800' >800%</option><option value='900' >900%</option><option value='1000' >1000%</option><option value='1100' >1100%</option><option value='1200' >1200%</option>				</select>
											<select name="bonus_n" style="width:100px">
											<option value='6,12' selected>2 ȸ����</option>
											<option value='3,6,9,12' >4 ȸ����</option>
											<option value='2,4,6,8,10,12' >6 ȸ����</option>
											<option value='1,2,3,4,5,6,7,8,9,10,11,12' >12 ȸ����</option>
										</select>
									</td>
								</tr>
								<tr>
									<td class="tdrowk_center">����</td>
									<td class="tdrow">
										<select name="position">
											<option value="">����</option>
<?
$sql_position = " select * from com_code_list where item='position' ";
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
										<select name="position">
											<option value="">����</option>
<?
$sql_step = " select * from com_code_list where item='step' ";
$result_step = sql_query($sql_step);
for($i=0; $row_step=sql_fetch_array($result_step); $i++) {
?>
											<option value="<?=$row_step[code]?>" <? if($row2[step] == $row_step[code]) echo "selected"; ?> ><?=$row_step[name]?></option>
<?
}
?>
										</select>
									</td>
									<td class="tdrowk_center">������</td>
									<td class="tdrow">
										<select name="end_pay" style="width:100px">
											<option value='����ӱ�' selected>����ӱ�</option>
											<option value='�����ӱ�' >�����ӱ�</option>
										</select>
									</td>
								</tr>
							</table>
							<!--���/�޿����� �Է�-->
				

							<div style="height:2px;font-size:0px;line-height:0px;"></div>


							<!-- ������ / ���ձٹ� -->
							<form name="formSalary" id="formSalary" style="display:;">
								<input type="hidden" name="money_month" value="0"><!-- �⺻(��)�� -->
								<input type="hidden" name="money_hour" value="4860"><!-- ���ؽñ� -->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
									<tr>
										<td class="tdrowk_center">1�� �����ٷνð�</td>
										<td class="tdrow_center"><input name="workhour_day_d" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="<?=$workhour_day_d?>" maxlength="10" onblur="setWorkHour('base')"> �ð�</td>
										<td class="tdrowk_center">�ٷνð� �����Է�</td>
										<td class="tdrow" colspan="3">
											<input type="checkbox" name="check_worktime_yn" value="Y"  onClick="checkWorkTimeYn()"> 1���� �ٷνð��� �������� �Է�
										</td>
									</tr>
									<tr>
										<td class="tdrowk_center">1�� �����ٷνð�</td>
										<td class="tdrow_center"><input name="workhour_day_w" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="0" maxlength="10" onblur="//setWorkHour('day')" readonly> �ð�</td>
										<td class="tdrowk_center">1���� �����ٷνð�</td>
										<td class="tdrow">
											<input name="workhour_day" type="text" class="textfm5" style="width:40;ime-mode:disabled;" value="24" maxlength="10" onblur="setWorkHour()" readonly>�ð� (��������)
										</td>
										<td class="tdrowk_center">�⺻��</td>
										<td class="tdrow_center">
											<input name="money_base" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="" maxlength="10" readonly> ��
										</td>
									</tr>
									<tr>
										<td class="tdrowk_center">1�� ����ٷνð�</td>
										<td class="tdrow_center"><input name="workhour_ext_w" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="0" maxlength="10" onblur="setWorkHour('ext')"> �ð�</td>
										<td class="tdrowk_center">1���� ����ٷνð�</td>
										<td class="tdrow_center">
											<input name="workhour_ext" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="0" maxlength="10" onblur="setWorkHour()" readonly> �ð�
										</td>
										<td class="tdrowk_center">����ٷμ���</td>
										<td class="tdrow_center">
											<input name="money_ext" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="" maxlength="10" readonly> ��
										</td>
									</tr>
									<tr>
										<td class="tdrowk_center">1�� ���ϱٷνð�</td>
										<td class="tdrow_center"><input name="workhour_hday_w" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="0" maxlength="10" onblur="setWorkHour('hday')"> �ð�</td>
										<td class="tdrowk_center">1���� ���ϱٷνð�</td>
										<td class="tdrow_center">
											<input name="workhour_hday" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="0" maxlength="10" onblur="setWorkHour()" readonly> �ð�
										</td>
										<td class="tdrowk_center">���ϱٷμ���</td>
										<td class="tdrow_center">
											<input name="money_hday" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="" maxlength="10" readonly> ��
										</td>
									</tr>
									<tr>
										<td class="tdrowk_center">1�� �߰��ٷνð�</td>
										<td class="tdrow_center">
											<input name="workhour_night_w" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="0" maxlength="10" onblur="setWorkHour('night')"> �ð�
										</td>
										<td class="tdrowk_center">1���� �߰��ٷνð�</td>
										<td class="tdrow_center">
											<input name="workhour_night" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="0" maxlength="10" onblur="setWorkHour()" readonly> �ð�
										</td>
										<td class="tdrowk_center">�߰��ٷμ���</td>
										<td class="tdrow_center">
											<input name="money_night" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="" maxlength="10" readonly> ��
										</td>
									</tr>
									<tr>
										<td class="tdrowk_center">1�� �� �ٷνð�</td>
										<td class="tdrow_center"><input name="workhour_total_w" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="0" maxlength="10" readonly> �ð�</td>
										<td class="tdrowk_center">1���� �� �ٷνð�</td>
										<td class="tdrow_center"><input name="workhour_total" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="0" maxlength="10" readonly> �ð�</td>
										<td class="tdrow_center" colspan="2"></td>
									</tr>
									<tr>
										<td class="tdrowk_center">�������� ���Կ���</td>
										<td class="tdrow_center">
											<select name="money_year_yn" class="selectfm" onChange="changeMoneyYearYn();setWorkHour();">
												<option value=""></option>
												<option value="Y" >����</option>
												<option value="N" >������</option>
											</select>
										</td>
										<td class="tdrowk_center">�����ް� �ð�</td>
										<td class="tdrow_center">
											<input name="workhour_year" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="" maxlength="10" readonly> �ð�
										</td>
										<td class="tdrowk_center">��������</td>
										<td class="tdrow_center">
											<input name="money_year" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="0" maxlength="10" readonly> ��
										</td>
									</tr>
								</table>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>

								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
									<tr>
										<td class="tdrowk_center"><b>�� �ٷΰ�༭ �ٷνð�</b></td>
										<td colspan="3" bgcolor="white" style="padding-left:2px;"> <b> = �����ٷνð� + ����ٷνð� + ���ϱٷνð�</b> </td>
									</tr>
									<tr>
										<td class="tdrowk_center">1�� �� �ٷνð�</td>
										<td class="tdrow_center"><input name="workhour_total2_w" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="" maxlength="10" readonly> �ð�</td>
										<td class="tdrowk_center">1���� �� �ٷνð�</td>
										<td class="tdrow_center"><input name="workhour_total2" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="" maxlength="10" readonly> �ð�</td>
									</tr>
								</table>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>

								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
									<tr>
										<td class="tdrowk_center"><b>�� 1���� ����ٷνð�</b></td>
										<td colspan="3" bgcolor="white" style="padding-left:2px;"> 
											<div id="workhour_total3_text">
												<b> = �����ٷνð� + ����ٷνð�*1.5 + ���ϱٷνð�*1.5 + �߰��ٷνð�*0.5 </b> 
											</div>
										</td>
									</tr>
									<tr>
										<td class="tdrowk_center">1�� �� �ٷνð�</td>
										<td class="tdrow_center"><input name="workhour_total3_w" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="" maxlength="10" readonly> �ð�</td>
										<td class="tdrowk_center">1���� �� �ٷνð�</td>
										<td class="tdrow_center"><input name="workhour_total3" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="" maxlength="10" readonly> �ð�</td>
									</tr>
									<tr>
										<td class="tdrowk_center"><b>�ּ��ӱ�(1�����ٷνð�*4,860)</b></td>
										<td class="tdrow_center"> 
											<input name="money_min" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="0" maxlength="10" readonly> �� 
											<font color=white>..</font>
										</td>
										<td class="tdrowk_center"> 
											<b>�����ӱ�</b> 
										</td>
										<td class="tdrow_center"> 
											<input name="money_min_time" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="0" maxlength="10" readonly> �� 
											<font color=white>..</font>
										</td>
									</tr>
								</table>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>

								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
									<tr>
										<td class="tdrowk_center">�����޾�</td>
										<td class="tdrowk_center" colspan="2">����������</td>
										<td class="tdrowk_center" colspan="2">���������</td>
										<td class="tdrowk_center">�⺻�� + ��������</td>
									</tr>
									<tr>
										<td class="tdrow_center" rowspan="3"><input name="money_month_base" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="" maxlength="10" onblur="setWorkHour();"> ��</td>
										<td class="tdrowk_center">��å����</td>
										<td class="tdrow_center"><input name="money_g1" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="0" maxlength="10" onblur="setWorkHour();"> ��</td>
										<td class="tdrowk_center">�Ĵ�</td>
										<td class="tdrow_center"><input name="money_b1" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="0" maxlength="10" onblur="setWorkHour();"> ��</td>
										<td class="tdrow_center" rowspan="3"><input name="money_month" type="text" class="textfm" style="width:60;background:bbbbbb;" value="0" maxlength="10" readonly> ��</td>
									</tr>
									<tr>
										<td class="tdrowk_center">�ڰݼ���</td>
										<td class="tdrow_center"><input name="money_g2" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="0" maxlength="10" onblur="setWorkHour();"> ��</td>
										<td class="tdrowk_center">�ڰ����������</td>
										<td class="tdrow_center"><input name="money_b2" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="0" maxlength="10" onblur="setWorkHour();"> ��</td>
									</tr>
									<tr>
										<td class="tdrowk_center">-</td>
										<td class="tdrow_center"><input name="money_g3" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="0" maxlength="10" onblur="setWorkHour();"> ��</td>
										<td class="tdrowk_center">-</td>
										<td class="tdrow_center"><input name="money_b3" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="0" maxlength="10" onblur="setWorkHour();"> ��</td>
									</tr>
								</table>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>

								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
									<tr>
										<td class="tdrowk_center" width="230"><b>�� ����ӱ� (�ð���)</b></td>
										<td colspan="3" bgcolor="white" style="padding-left:2px;"> <b> = [ (�⺻��+��������) + ���������� ] / 1���� ����ٷνð� </b> </td>
									</tr>
									<tr>
										<td class="tdrowk_center">����ӱ� (�ð���)</td>
										<td colspan="3" bgcolor="white" style="padding-left:65px;"> 
											<input name="money_hour_ts_view" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="" maxlength="10" readonly> ��
											<input name="money_hour_ts" type="hidden" value="">
										</td>
									</tr>
								</table>
							</form>

							<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed;margin-top:20px">
								<tr>
									<td style="text-align:center">

										<table border=0 cellpadding=0 cellspacing=0 style="display: inline;">
											<tr>
												<td width=2></td>
												<td><img src=images/btn_lt.gif></td>
												<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="javascript:checkData();" target="">�޿�����</a></td>
												<td><img src=images/btn_rt.gif></td>
											 <td width=2></td>
											</tr>
										</table>
										<table border=0 cellpadding=0 cellspacing=0 style="display: inline;">
											<tr>
												<td width=2></td>
												<td><img src=images/btn_lt.gif></td>
												<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="pay_list.php?page=<?=$page?>" target="">�� ��</a></td>
												<td><img src=images/btn_rt.gif></td>
											 <td width=2></td>
											</tr>
										</table>

									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<? include "./inc/bottom.php";?>
			</td>
		</tr>
	</table>		
</div>
<script language="javascript">

</script>
</body>
</html>
