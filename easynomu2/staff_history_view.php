<?
$sub_menu = "200200";
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
if(!$com_code) {
	$sql_com = " select com_code from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
	$row_com = sql_fetch($sql_com);
	$com_code = $row_com[com_code];
}
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
//�ְ��ٷνð� DB
$sql_work_time = " select * from a4_work_time where com_code='$com_code' and sabun ='' ";
$result_work_time = sql_query($sql_work_time);
$row_work_time=mysql_fetch_array($result_work_time);
//echo $sql_work_time;

$sql_common = " from $g4[pibohum_base] ";

$sub_title = "���泻�� �� ���";
$g4[title] = $sub_title." : ������� : ".$easynomu_name;

$colspan = 11;

if(!$idx) {
	$sql_idx_max = " select max(id) as idx_max from pibohum_bak where com_code='$code' and sabun='$id' ";
	//echo $sql_idx_max;
	$result_idx_max = sql_query($sql_idx_max);	
	$row_idx_max=mysql_fetch_array($result_idx_max);
	$idx = $row_idx_max['idx_max'];
	//echo $idx;
}
$sql1 = " select * from pibohum_bak where id = '$idx' ";
//echo $sql1;
$result1 = sql_query($sql1);

$sql2 = " select * from pibohum_bak_opt where mid = '$idx' ";
//echo $sql2;
$result2 = sql_query($sql2);

$sql4 = " select * from pibohum_bak_opt2 where mid = '$idx' ";
$result4 = sql_query($sql4);
//echo $sql4;
//exit;

$row1=mysql_fetch_array($result1);
$row2=mysql_fetch_array($result2);
$row4=mysql_fetch_array($result4);
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
function tab_view(tab) {
	var obj = document.getElementById(tab);
	if(obj.style.display == "none") {
		obj.style.display = "";
	} else {
		obj.style.display = "none";
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
							<div id="staff_history_list">
								<!--��޴� -->
								<table border=0 cellspacing=0 cellpadding=0> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
													���泻��
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
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
									<tr>
										<td nowrap class="tdhead_center" width="32">No</td>
										<td nowrap class="tdhead_center" width="">�����Ͻ�</td>
										<td nowrap class="tdhead_center" width="62">����</td>
										<td nowrap class="tdhead_center" width="82">�����ӱ�</td>
										<td nowrap class="tdhead_center" width="82">�⺻��</td>
										<td nowrap class="tdhead_center" width="60">ä������</td>
										<td nowrap class="tdhead_center" width="60">�޿�����</td>
										<td nowrap class="tdhead_center" width="74">�Ի���</td>
										<td nowrap class="tdhead_center" width="74">�����</td>
										<td nowrap class="tdhead_center" width="200">��濩��</td>
									</tr>
<?
// ����Ʈ ���
$sql = " select count(*) as cnt
         from pibohum_bak
         where com_code='$code' and sabun='$id'
          ";
$row = sql_fetch($sql);
$total_count = $row[cnt];
$sql = " select * from pibohum_bak where com_code='$code' and sabun='$id' order by id desc ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {
	$no = $total_count - $i - ($rows*($page-1));
	$id = $row[sabun];
	$idx = $row[id];
	//ä������
	if($row[work_form] == "") $work_form = "";
	else if($row[work_form] == "1") $work_form = "������";
	else if($row[work_form] == "2") $work_form = "�����";
	else if($row[work_form] == "3") $work_form = "�Ͽ���";
	//�Ի���/�����
	if($row[in_day] == "..") $in_day = "-";
	else if($row[in_day] == "") $in_day = "-";
	else $in_day = $row[in_day];
	if($row[out_day] == "..") $out_day = "-";
	else if($row[out_day] == "") $out_day = "-";
	else $out_day = $row[out_day];
	//��� �߰� DB
	$sql_opt = " select * from pibohum_bak_opt where mid='$row[id]' ";
	$result_opt = sql_query($sql_opt);
	$row_opt=mysql_fetch_array($result_opt);
	//�μ�
	$dept = $row_opt[dept_1];
	//echo $row_opt['mid'];
	//����
	$position = "-";
	if($row_opt[position]) {
		$sql_position = " select * from com_code_list where item='position' and com_code = '$code' and code = $row_opt[position] ";
		//echo $sql_position;
		$result_position = sql_query($sql_position);
		$row_position = sql_fetch_array($result_position);
		if($row_position[name]) $position = $row_position[name];
		else $position = "-";
	}
	//�޿�����
	if($row_opt[pay_gbn] == "0") $pay_gbn = "������";
	else if($row_opt[pay_gbn] == "1") $pay_gbn = "�ñ���";
	else if($row_opt[pay_gbn] == "2") $pay_gbn = "���ձٹ�";
	else if($row_opt[pay_gbn] == "3") $pay_gbn = "������";
	else $pay_gbn = "-";
	//���ʵ������
	$sql_opt2 = " select * from pibohum_base_opt2 where com_code='$code' and sabun='$id' ";
	$result_opt2 = sql_query($sql_opt2);
	$row_opt2=mysql_fetch_array($result_opt2);
	$registration_date = $row_opt2[wr_date];
	//��������
	$sql_bak_opt2 = " select max(wr_date) as modify_date from pibohum_bak_opt2 where mid='$row[id]' ";
	$result_bak_opt2 = sql_query($sql_bak_opt2);
	$row_bak_opt2=mysql_fetch_array($result_bak_opt2);
	$modify_date = $row_bak_opt2[modify_date];
	//�޿�����
	$sql_bak_opt2 = " select * from pibohum_bak_opt2 where mid='$row[id]' ";
	$result_bak_opt2 = sql_query($sql_bak_opt2);
	$row_bak_opt2=mysql_fetch_array($result_bak_opt2);
	//��ũ��
	$staff_url = "staff_history_view.php?id=".$id."&code=".$code."&idx=".$idx."&idx1=".$idx1."&idx2=".$idx2;
?>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td nowrap class="ltrow1_center"><?=$no?></td>
										<td class="ltrow1_center"><a href="<?=$staff_url?>"><b><?=$modify_date?></b></a></td>
										<td nowrap class="ltrow1_center"><?=$position?><br></td>
										<td nowrap class="ltrow1_center"><?=number_format($row_bak_opt2[money_month_base])?></td>
										<td nowrap class="ltrow1_center"><?=number_format($row_bak_opt2[money_hour_ms])?></td>
										<td nowrap class="ltrow1_center"><?=$work_form?></td>
										<td nowrap class="ltrow1_center"><?=$pay_gbn?></td>
										<td nowrap class="ltrow1_center"><?=$in_day?></td>
										<td nowrap class="ltrow1_center"><?=$out_day?></td>
										<td nowrap class="ltrow1_center">
											<!--��濩�� ������ 0 ��-->
											<input type="checkbox" name="isgy" value="0" class="checkbox" disabled <? if($row[apply_gy] == "0") echo "checked"; ?> >���
											<input type="checkbox" name="issj" value="0" class="checkbox" disabled <? if($row[apply_sj] == "0") echo "checked"; ?> >����
											<input type="checkbox" name="iskm" value="0" class="checkbox" disabled <? if($row[apply_km] == "0") echo "checked"; ?> >����
											<input type="checkbox" name="isgg" value="0" class="checkbox" disabled <? if($row[apply_gg] == "0") echo "checked"; ?> >�ǰ�
										</td>
									</tr>
<?
}
?>
								</table>
							</div>
							<div style="height:12px;font-size:0px;line-height:0px;"></div>

							<div id='print_page'>
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
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<col width="11%">
									<col width="23%">
									<col width="11%">
									<col width="23%">
									<col width="10%">
									<col width="22%">
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����</td>
										<td nowrap class="tdrow">
											<?=$row1['name']?>
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�ֹε�Ϲ�ȣ</td>
										<td nowrap class="tdrow">
											<?
											$jumin_no = explode("-",$row1['jumin_no']);
											?>

											<?=$jumin_no[0]?>-<?=$jumin_no[1]?>
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

											<img src="<?=$pic?>" width="90" height="90" style="margin-bottom:2px">
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�Ի���<font color="red">*</font></td>
										<td nowrap class="tdrow">
											<?=$row1['in_day']?>
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�ܱ��� ����</td>
										<td nowrap class="tdrow">
											<?
											if($row1['fg_div'] == 0) echo "������";
											else echo "�ܱ���";
											?>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�ּ�</td>
										<td nowrap class="tdrow" colspan="3">
<?
if($row1['w_postno']) {
?>
											(<?=$row1['w_postno']?>)
<?
}
?>
											<?=$row1['w_juso']?>
											<?=$row2['w_juso2']?>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�޴���</td>
										<td nowrap class="tdrow">
											<?=$row2['emp_cel']?>
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��ȭ��ȣ</td>
										<td nowrap class="tdrow">
											<?=$row1['add_tel']?>
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��������</td>
										<td nowrap class="tdrow">
											<?
											if($row1['gubun'] == 0) echo "����";
											else if($row1['gubun'] == 1) echo "����";
											else if($row1['gubun'] == 2) echo "���";
											else echo "����";
											?>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">ä������</td>
										<td nowrap class="tdrow">
											<?
											if($row1['work_form'] == "") $row1['work_form'] = 1;
											$work_form_id = $row1['work_form'];
											$work_form_txt[1] = "������";
											$work_form_txt[2] = "�����";
											$work_form_txt[3] = "�Ͽ���";
											$work_form_txt[4] = "����ҵ�";
											echo $work_form_txt[$work_form_id];
											?>
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����(��å)</td>
										<td nowrap class="tdrow">
												<?
												$sql_position = " select * from com_code_list where item='position' and com_code='$code' and code='$row2[position]' ";
												$result_position = sql_query($sql_position);
												$row_position = sql_fetch_array($result_position);
												echo $row_position['name'];
												?>
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����</td>
										<td nowrap class="tdrow">
<?
if($row2['jikjong_code']) {
?>
											(<?=$row2['jikjong_code']?>)
<?
}
?>
											<?=$row2['jikjong']?>
										</td>
									</tr>
									<tr id="contract_term" style="">
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��������</td>
										<td class="tdrow">
											<?=$row2['contract_sdate']?>
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���������</td>
										<td class="tdrow">
											<?=$row2['contract_edate']?>
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�����</td>
										<td nowrap class="tdrow">
											<?=$row1['out_day']?>
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
											?>

											<input type="checkbox" name="isgy" value="0" class="checkbox" disabled <?=$isgy_chk?>>���
											<input type="checkbox" name="issj" value="0" class="checkbox" disabled <?=$issj_chk?>>����
											<input type="checkbox" name="iskm" value="0" class="checkbox" disabled <?=$iskm_chk?>>����
											<input type="checkbox" name="isgg" value="0" class="checkbox" disabled <?=$isgg_chk?>>�ǰ�
											<input type="checkbox" name="isjy" value="0" class="checkbox" disabled <?=$isjy_chk?>>�����
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

											<input type="checkbox" name="isso" value="0" class="checkbox" disabled <?=$isso_chk?>>�ҵ漼,�ֹμ�
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
											<input type="checkbox" name="insurance" value="1" class="checkbox" disabled <?=$insurance_chk?> style="vertical-align:middle" onclick="insurance_div(this);">�η紩�� ��ȸ����
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
$family_cnt = $row2['family_cnt'];
if($family_cnt == "" || $family_cnt == "0") $family_cnt = 1;
$child_cnt = $row2['child_cnt'];
$etc_cnt = $row2['etc_cnt'];
?>
											<b><?=$family_cnt?>��</b>
											20������ �ڳ� <b><?=$child_cnt?>��</b>
											��Ÿ �ξ簡�� <b><?=$etc_cnt?>��</b>
										</td>
										<td class="tdrowk"></td>
										<td class="tdrow">
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�̸���</td>
										<td nowrap class="tdrow">
											<?=$row2['emp_email']?>
										</td>
										<td class="tdrowk" width="74"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�μ���</td>
										<td class="tdrow">
											<?=$row2['dept_1']?>
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�Ҽ�����</td>
										<td class="tdrow">
											<?=$row2['dept_2']?>
										</td>
									</tr>
									<tr>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���¹�ȣ</td>
										<td class="tdrow">
											<?=$row2['bank_account']?>
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�����</td>
										<td class="tdrow">
											<?=$row2['bank_name']?>
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">������</td>
										<td class="tdrow">
											<?=$row2['bank_depositor']?>
										</td>
									</tr>
									<tr>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����</td>
										<td class="tdrow">
											<?=$row1['nation']?>
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">ü���ڰ�</td>
										<td class="tdrow">
<?
if($row1['staycapacity'] == "B1") $staycapacity = "B1 ��������";
else if($row1['staycapacity'] == "B2") $staycapacity = "B2 �������";
else if($row1['staycapacity'] == "C2") $staycapacity = "C2 �ܱ���";
else if($row1['staycapacity'] == "C3") $staycapacity = "C3 �ܱ�����";
else if($row1['staycapacity'] == "C4") $staycapacity = "C4 �ܱ����";
else if($row1['staycapacity'] == "C4") $staycapacity = "C4 �ܱ����";
else if($row1['staycapacity'] == "D2") $staycapacity = "D2 ����";
else if($row1['staycapacity'] == "D3") $staycapacity = "D3 �������";
else if($row1['staycapacity'] == "D4") $staycapacity = "D4 �Ϲݿ���";
else if($row1['staycapacity'] == "E4") $staycapacity = "E4 �������";
else if($row1['staycapacity'] == "E5") $staycapacity = "E5 ��������";
else if($row1['staycapacity'] == "E7") $staycapacity = "E7 Ư��Ȱ��";
else if($row1['staycapacity'] == "E8") $staycapacity = "E8 �������";
else if($row1['staycapacity'] == "E9") $staycapacity = "E9 ���������";
else if($row1['staycapacity'] == "E10") $staycapacity = "E10 �������";
else if($row1['staycapacity'] == "F1") $staycapacity = "F1 �湮����";
else if($row1['staycapacity'] == "F2") $staycapacity = "F2 ����";
else if($row1['staycapacity'] == "F3") $staycapacity = "F3 ����";
else if($row1['staycapacity'] == "F4") $staycapacity = "F4 ��ܵ���";
else if($row1['staycapacity'] == "F5") $staycapacity = "F5 ����";
else if($row1['staycapacity'] == "G1") $staycapacity = "G1 ��Ÿ";
else if($row1['staycapacity'] == "H1") $staycapacity = "H1 �������";
else if($row1['staycapacity'] == "H2") $staycapacity = "H2 �湮���";
echo $staycapacity;
?>
										</td>
										<td class="tdrowk"></td>
										<td class="tdrow">
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">Ư�̻���</td>
										<td nowrap class="tdrow" colspan="5">
											<?=$row2[remark]?>
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
												if($row2[drawback_form] == 0) echo "0.�ش���׾���";
												else if($row2[drawback_form] == 1) echo "1.��ü���";
												else if($row2[drawback_form] == 2) echo "2.���������";
												else if($row2[drawback_form] == 3) echo "3.�ð����";
												else if($row2[drawback_form] == 4) echo "4.û�����";
												else if($row2[drawback_form] == 5) echo "5.������";
												else if($row2[drawback_form] == 6) echo "6.�ȸ����";
												else if($row2[drawback_form] == 7) echo "7.�������";
												else if($row2[drawback_form] == 8) echo "8.�������";
												else if($row2[drawback_form] == 9) echo "9.�����";
												else if($row2[drawback_form] == 10) echo "10.ȣ������";
												else if($row2[drawback_form] == 11) echo "11.���/������";
												else if($row2[drawback_form] == 12) echo "12.�������";
												else if($row2[drawback_form] == 13) echo "13.�������";
												else if($row2[drawback_form] == 14) echo "14.�������";
												else if($row2[drawback_form] == 15) echo "15.�������";
												else if($row2[drawback_form] == 16) echo "16.��Ÿ";
												else echo "0.�ش���׾���";

												if($row2[drawback_form_grade] == 1) echo "1��";
												else if($row2[drawback_form_grade] == 2) echo "2��";
												else if($row2[drawback_form_grade] == 3) echo "3��";
												else if($row2[drawback_form_grade] == 4) echo "4��";
												else if($row2[drawback_form_grade] == 5) echo "5��";
												else if($row2[drawback_form_grade] == 6) echo "6��";
												else echo "";
												?>
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

												<input type="checkbox" name="aged" value="1" class="checkbox" disabled <?=$aged_chk?>> 60���̻�
											</td>
											<td nowrap class="tdrowk"></td>
											<td nowrap class="tdrow">
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">������������</td>
											<td nowrap class="tdrow">
												<?
												if($row2['retired'] == "") echo "�ش���׾���";
												else if($row2['retired'] == 1) echo "������������";
												else echo "";
												?>
											</td>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���͹ΰ��</td>
											<td nowrap class="tdrow">
												<input type="checkbox" name="deferred" value="1" class="checkbox" disabled <?=$deferred_chk?>> ���͹ΰ������
											</td>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��꿩��</td>
											<td nowrap class="tdrow">
												<?
												if($row2['chidbirth'] == "") echo "�ش���׾���";
												else if($row2['chidbirth'] == 1) echo "������Ʊ���";
												else if($row2['chidbirth'] == 2) echo "������Ʊ��ü�η�";
												?>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��������</td>
											<td nowrap class="tdrow">
												<?
												if($row2['matriarch'] == "") echo "�ش���׾���";
												else if($row2['matriarch'] == 1) echo "�Ѻθ���";
												else if($row2['matriarch'] == 2) echo "���ʻ�Ȱ�����";
												?>
											</td>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��������</td>
											<td nowrap class="tdrow">
												<input type="checkbox" name="rural" value="1" class="checkbox" disabled <? if($row2[rural] == "1") echo "checked"; ?> > ��������������
											</td>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">ó�찳����</td>
											<td nowrap class="tdrow">
												<input type="checkbox" name="treatment" value="1" class="checkbox" disabled <? if($row2[treatment] == "1") echo "checked"; ?> > ó�찳����
											</td>
										</tr>
									</table>
									<div style="height:4px;font-size:0px;line-height:0px;"></div>

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
											<td class="tdrow"><input type="checkbox" name="fund[0]" value="1" class="checkbox" disabled <?=$fund_chk1?>> ���������Ű��<br><img src="images/blank.gif" width="24" height="1">(���뵿��)</td>
											<td class="tdrow"><input type="checkbox" name="fund[1]" value="1" class="checkbox" disabled <?=$fund_chk2?>> 50+�����������������<br><img src="images/blank.gif" width="24" height="1">(���뵿��)</td>
											<td class="tdrow"><input type="checkbox" name="fund[2]" value="1" class="checkbox" disabled <?=$fund_chk3?>> ���������Ʒ� ���α׷�<br><img src="images/blank.gif" width="24" height="1">(��´���������������)</td>
											<td class="tdrow"><input type="checkbox" name="fund[3]" value="1" class="checkbox" disabled <?=$fund_chk4?>> ����� ����ɷ�������α׷�<br><img src="images/blank.gif" width="24" height="1">(�������������)</td>
										</tr>
										<tr>
											<td class="tdrow"><input type="checkbox" name="fund[4]" value="1" class="checkbox" disabled <?=$fund_chk5?>> ������ ���α׷�<br><img src="images/blank.gif" width="24" height="1">(�ѱ�����ΰ�����)</td>
											<td class="tdrow"><input type="checkbox" name="fund[5]" value="1" class="checkbox" disabled <?=$fund_chk6?>> �����ɷ°����Ʒ� ���α׷�<br><img src="images/blank.gif" width="24" height="1">(�ѱ�����ΰ�����)</td>
											<td class="tdrow"><input type="checkbox" name="fund[6]" value="1" class="checkbox" disabled <?=$fund_chk7?>> ������Ȱ ���α׷�<br><img src="images/blank.gif" width="24" height="1">(�ѱ�����ΰ�����)</td>
											<td class="tdrow"><input type="checkbox" name="fund[7]" value="1" class="checkbox" disabled <?=$fund_chk8?>> �о��ߴ� û�ҳ� �ڸ�/�н����� ���<br><img src="images/blank.gif" width="24" height="1">(����������)</td>
										</tr>
										<tr>
											<td class="tdrow"><input type="checkbox" name="fund[8]" value="1"  class="checkbox" disabled <?=$fund_chk9?> > ��Ȱ�ٷ�<br><img src="images/blank.gif" width="24" height="1">(������ü��ü)</td>
											<td class="tdrow"><input type="checkbox" name="fund[9]" value="1"  class="checkbox" disabled <?=$fund_chk10?>> ������� ������Ʈ<br><img src="images/blank.gif" width="24" height="1">(���Ǻ�����)</td>
											<td class="tdrow"><input type="checkbox" name="fund[10]" value="1" class="checkbox" disabled <?=$fund_chk11?>> ����� ������ڸ� ���� ���α׷�<br><img src="images/blank.gif" width="24" height="1">(������,�ѱ�������ȣ��������)</td>
											<td class="tdrow"><input type="checkbox" name="fund[11]" value="1" class="checkbox" disabled <?=$fund_chk12?>> �����⺻���� (�ѱ����ƺ����Ƿ����,<br><img src="images/blank.gif" width="24" height="1">���뱺����������)</td>
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
														<a href="javascript:tab_view('school_career');">�з�/���/����/�ڰ�/����</a>
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
								<div id="school_career" style="display:none">
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
							<!--tab1-->
							<div style="height:10px;font-size:0px;line-height:0px;"></div>
							<div id="tab2" style="">
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
								//���ؽñ�
								if($row4[money_hour_ds]) {
									$money_hour = $row4[money_hour_ds];
								} else {
									$money_hour = 4860;
								}
								//�⺻��
								if($row4[money_hour_ms])	{
									$money_hour_ms = number_format($row4[money_hour_ms]);
									$money_min = $row4[money_hour_ms];
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
$pay_gbn = $row2[pay_gbn];
$pay_gbn_array = array("������","�ñ���","���ձٹ�","������");
echo $pay_gbn_array[$pay_gbn];
?>
										</td>
										<td class="tdrowk_center">�ֱٷνð�</td>
										<td class="tdrow">
<?
if($row2[work_gbn] == "A" || $row2[work_gbn] == "") echo "��40�ð�";
else echo "��44�ð�";
?>
										</td>
										<td class="tdrowk_center">����</td>
										<td class="tdrow">
											<?=$row4[annual_paid_holiday]?>
										</td>
									</tr>
									<tr>
										<td class="tdrowk_center">����(��å)</td>
										<td class="tdrow">
											<?
											$sql_position = " select * from com_code_list where item='position' and com_code='$code' and code='$row2[position]' ";
											$result_position = sql_query($sql_position);
											$row_position=mysql_fetch_array($result_position);
											echo $row_position[name];
											?>
										</td>
										<td class="tdrowk_center">ȣ��</td>
										<td class="tdrow">
											<?
											$sql_step = " select * from com_code_list where item='step' and com_code='$code' and code='$row2[step]' ";
											$result_step = sql_query($sql_step);
											$row_step=mysql_fetch_array($result_step);
											echo $row_step[name];
											?>
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
<?
if($check_bonus_money_yn == "Y") {
	echo number_format($bonus_money);
} else {
	if($row4[bonus_standard] == "1") echo "�⺻��";
	else if($row4[bonus_standard] == "2") echo "�����ӱ�";
	else if($row4[bonus_standard] == "3") echo "����ӱ�";
	else if($row4[bonus_standard] == "4") echo "�ѱ޿�";
	else echo "������";
}
?>
										</td>
										<td class="tdrow"><?=$bonus_time1?></td>
										<td class="tdrow"><?=$bonus_time2?></td>
										<td class="tdrow"><?=$bonus_time3?></td>
										<td class="tdrow"><?=$bonus_time4?></td>
										<td class="tdrow"><?=$bonus_time5?></td>
										<td class="tdrow"><?=$bonus_time6?></td>
									</tr>
									<tr>
										<td class="tdrowk">�󿩺���</td>
										<td class="tdrow"><?=$row4[bonus_percent]?>%</td>
										<td class="tdrow"><?=$bonus_p[0]?>%</td>
										<td class="tdrow"><?=$bonus_p[1]?>%</td>
										<td class="tdrow"><?=$bonus_p[2]?>%</td>
										<td class="tdrow"><?=$bonus_p[3]?>%</td>
										<td class="tdrow"><?=$bonus_p[4]?>%</td>
										<td class="tdrow"><?=$bonus_p[5]?>%</td>
									</tr>
								</table>

								<!--���/�޿����� �Է�-->
							</form>
							<!--�⺻�� dataForm-->

							<div style="height:10px;font-size:0px;line-height:0px;"></div>

							<!-- ������ / ���ձٹ� -->
							<form name="formSalary" id="formSalary" style="margin:0display:;">
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
$workhour_day_w = $row4[workhour_day_w];
$workhour_ext_w = $row4[workhour_ext_w];
$workhour_hday_w = $row4[workhour_hday_w];
$workhour_night_w = $row4[workhour_night_w];
$workhour_total_w = $workhour_day_w + ($workhour_ext_w*$rate_ext) + ($workhour_hday_w*$rate_hday) + ($workhour_night_w*$rate_night);
$workhour_total = $row4[workhour_day] + ($row4[workhour_ext]*$rate_ext) + ($row4[workhour_night]*$rate_night) + ($row4[workhour_hday]*$rate_hday);
$money_ext = number_format($row4[money_b1]);
$money_night = number_format($row4[money_b2]);
$money_hday = number_format($row4[money_b3]);
?>
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
										<td class="tdrowk"><b>1��</b>�ٷνð�</td>
										<td class="tdrow"><?=$row4[workhour_day_w]?> �ð�</td>
										<td class="tdrow"><?=$row4[workhour_ext_w]?> �ð�</td>
										<td class="tdrow"><?=$row4[workhour_night_w]?> �ð�</td>
										<td class="tdrow"><?=$row4[workhour_hday_w]?> �ð�</td>
										<td class="tdrow"><?=$workhour_total_w?> �ð�</td>

									</tr>
									<tr>
										<td class="tdrowk"><b>1����</b>�ٷνð�</td>
										<td class="tdrow"><?=$row4[workhour_day]?> �ð�</td>
										<td class="tdrow"><?=$row4[workhour_ext]?> �ð�</td>
										<td class="tdrow"><?=$row4[workhour_night]?> �ð�</td>
										<td class="tdrow"><?=$row4[workhour_hday]?> �ð�</td>
										<td class="tdrow"><?=$workhour_total?> �ð�</td>
									</tr>
									<tr>
										<td class="tdrowk"><b>�ٷμ���</td>
										<td class="tdrow"></td>
										<td class="tdrow"><?=$money_ext?> ��</td>
										<td class="tdrow"><?=$money_night?> ��</td>
										<td class="tdrow"><?=$money_hday?> ��</td>
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
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:170;text-align:center'> 
														<span id="decision"><? if($row2['pay_gbn'] == "1") echo "���ؽñ�"; else echo "�����ӱ�"; ?></span> / �⺻�ñ� / �⺻��
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
										<td class="tdrowk_center" width="90"><span id="decision_txt"><? if($row2['pay_gbn'] == "1") echo "���ؽñ�"; else echo "�����ӱ�"; ?></span></td>
										<td class="tdrow">
											<div id="decision_div" style="<? if($row2['pay_gbn'] == "1") echo "display:none"; else echo "display:inline"; ?>">
												<?=number_format($pay_year)?> ��
											</div>
											<div id="decision_div2" style="<? if($row2['pay_gbn'] != "1") echo "display:none"; else echo "display:inline"; ?>">
												<?=number_format($money_hour)?> ��
											</div>
										</td>
										<td class="tdrowk" width="110"></td>
										<td class="tdrow">
											
										</td>
									</tr>
									<tr>
										<td class="tdrowk_center">�����ñ�</td>
										<td class="tdrow" valign="top">
											<?
											if($check_money_min_2013_yn == "Y") echo "4,860";
											else echo "5,210";
											?> ��
										</td>
										<td class="tdrowk_center">����ӱ�(�ñ�)</td>
										<td class="tdrow">
											<?=number_format($row4['money_hour_ts'])?> ��
										</td>
									</tr>
									<tr>
										<td class="tdrowk_center">�⺻��</td>
										<td class="tdrow" valign="top">
											<?=$money_hour_ms?> ��
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
								if($row2['position']) {
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
								if($row4[money_g1] != "") $money_g1 = $row4[money_g1];
								else $money_g1 = 0;
								if($row4[money_g2] != "") $money_g2 = $row4[money_g2];
								else $money_g2 = 0;
								//ȣ�� ������ ���� �� 0
								//if($step_pay == "") $step_pay = 0;
								if($row4[money_g3] != "") $money_g3 = $row4[money_g3];
								else $money_g3 = 0;
								if($row4[money_g4] != "") $money_g4 = $row4[money_g4];
								else $money_g4 = 0;
								if($row4[money_g5] != "") $money_g5 = $row4[money_g5];
								else $money_g5 = 0;
								//����ӱ� �߰���
								$money_g6 = $row4[money_g6];
								$money_g7 = $row4[money_g7];
								$money_g8 = $row4[money_g8];
								if($money_g6 == "") $money_g6 = 0;
								if($money_g7 == "") $money_g7 = 0;
								if($money_g8 == "") $money_g8 = 0;
								?>

								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
									<tr>
										<td class="tdrowk_center"><?=$money_g1_txt?></td>
										<td class="tdrow_center"><?=number_format($money_g1)?> ��</td>
										<td class="tdrowk_center"><?=$money_g2_txt?></td>
										<td class="tdrow_center"><?=number_format($money_g2)?> ��</td>
										<td class="tdrowk_center"><?=$money_g3_txt?></td>
										<td class="tdrow_center"><?=number_format($money_g3)?> ��</td>
										<td class="tdrowk_center"><?=$money_g4_txt?></td>
										<td class="tdrow_center"><?=number_format($money_g4)?> ��</td>
										<td class="tdrowk_center"><?=$money_g5_txt?></td>
										<td class="tdrow_center"><?=number_format($money_g5)?> ��</td>
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
$money_b1 = $row4[money_b1];
$money_b2 = $row4[money_b2];
$money_b3 = $row4[money_b3];
$money_b4 = $row4[money_b4];
$money_b5 = $row4[money_b5];
if($money_b4 == "") $money_b4 = 0;
if($money_b5 == "") $money_b5 = 0;
?>
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
									<tr>
										<td class="tdrowk_center">�⺻����</td>
										<td class="tdrow_center"><?=number_format($money_b1)?> ��</td>
										<td class="tdrowk_center">�߰��ٷ�</td>
										<td class="tdrow_center"><?=number_format($money_b2)?> ��</td>
										<td class="tdrowk_center">���ϱٷ�</td>
										<td class="tdrow_center"><?=number_format($money_b3)?> ��</td>
										<td class="tdrowk_center">��������</td>
										<td class="tdrow_center"><?=number_format($money_b4)?> ��</td>
										<td class="tdrowk_center"></td>
										<td class="tdrow_center"></td>
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
$money_e1 = $row4[money_e1];
$money_e2 = $row4[money_e2];
$money_e3 = $row4[money_e3];
$money_e4 = $row4[money_e4];
$money_e5 = $row4[money_e5];
$money_e6 = $row4[money_e6];
$money_e7 = $row4[money_e7];
$money_e8 = $row4[money_e8];
if($money_e1 == "") $money_e1 = 0;
if($money_e2 == "") $money_e2 = 0;
if($money_e3 == "") $money_e3 = 0;
if($money_e4 == "") $money_e4 = 0;
if($money_e5 == "") $money_e5 = 0;
if($money_e6 == "") $money_e6 = 0;
if($money_e7 == "") $money_e7 = 0;
if($money_e8 == "") $money_e8 = 0;
//�հ�
$money_g_sum = $money_g1+$money_g2+$money_g3+$money_g4+$money_g5;
$money_b_sum = $money_b1+$money_b2+$money_b3+$money_b4;
$money_e_sum = $money_e1+$money_e2+$money_e3+$money_e4+$money_e5+$money_e6+$money_e7+$money_e8;
//���հ�
$money_total_sum = $money_min + $money_g_sum + $money_b_sum + $money_e_sum;
?>
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
									<tr>
										<td class="tdrow_center" width="180" colspan="2">��Ÿ����(�����)</td>
										<td class="tdrowk_center"><?=$money_e1_txt?></td>
										<td class="tdrow_center"><?=number_format($money_e1)?> ��</td>
										<td class="tdrowk_center"><?=$money_e2_txt?></td>
										<td class="tdrow_center"><?=number_format($money_e2)?> ��</td>
										<td class="tdrowk_center"><?=$money_e3_txt?></td>
										<td class="tdrow_center"><?=number_format($money_e3)?> ��</td>
										<td class="tdrowk_center"><?=$money_e4_txt?></td>
										<td class="tdrow_center"><?=number_format($money_e4)?> ��</td>
									</tr>
									<tr>
										<td class="tdrow_center" colspan="2">��Ÿ����(����)</td>
										<td class="tdrowk_center"><?=$money_e5_txt?></td>
										<td class="tdrow_center"><?=number_format($money_e5)?> ��</td>
										<td class="tdrowk_center"><?=$money_e6_txt?></td>
										<td class="tdrow_center"><?=number_format($money_e6)?> ��</td>
										<td class="tdrowk_center"><?=$money_e7_txt?></td>
										<td class="tdrow_center"><?=number_format($money_e7)?> ��</td>
										<td class="tdrowk_center"><?=$money_e8_txt?></td>
										<td class="tdrow_center"><?=number_format($money_e8)?> ��</td>
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
											<?=number_format($money_g_sum)?> ��
										</td>
										<td class="tdrowk_center">�� �������� �հ�</td>
										<td class="tdrow" valign="top">
											<?=number_format($money_b_sum)?> ��
										</td>
										<td class="tdrowk_center">�� ��Ÿ���� �հ�</td>
										<td class="tdrow" valign="top">
											<?=number_format($money_e_sum)?> ��
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
											<?=number_format($money_total_sum)?> ��
										</td>
										<td class="tdrowk_center"></td>
										<td class="tdrow" valign="top" colspan="3">

										</td>
									</tr>
								</table>
							</div>
							</div>
							</div><!--����Ʈ ���� ��-->
<?
//���Ѻ� ��ũ��
if($member['mb_profile'] == "guest") {
	$url_print = "javascript:alert_demo();";
} else {
	$url_print = "javascript:pagePrint(document.getElementById('print_page'))";
}
?>

							<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed;margin-top:20px">
								<tr>
									<td style="text-align:center">
										<a href="<?=$url_print?>" target=""><img src="images/btn_print_big.png" border="0"></a>
										<a href="staff_history.php?page=<?=$page?>" target=""><img src="images/btn_list_big.png" border="0"></a>
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
</body>
</html>
