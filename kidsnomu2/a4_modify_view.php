<?
$sub_menu = "700200";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

$result1=mysql_query("select * from a4_modify where id = $id");
$row1=mysql_fetch_array($result1);

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

$sub_title = "����պ�������Ű�";
$g4[title] = $sub_title." : ����������Ű� : ".$easynomu_name;
?>
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
 
	var iepage_script = "<style type='text/css'>\n@media print{ \n#noPrint1{display: none;} \n} \n</style> \n<script language='javascript' type='text/javascript'> \nfunction Installed() \n{ \ntry \n{ \nreturn (new ActiveXObject('IEPageSetupX.IEPageSetup')); \n} \ncatch (e) \n{ \nreturn false; \n} \n} \nfunction PrintTest() \n{ \nif (!Installed()) \nalert('��Ʈ���� ��ġ���� �ʾҽ��ϴ�. ���������� �μ���� ���� �� �ֽ��ϴ�.') \nelse \nalert('���������� ��ġ�Ǿ����ϴ�.'); \n} \nfunction printsetup()\n{ \nIEPageSetupX.header = '';\nIEPageSetupX.footer = '';\nIEPageSetupX.leftMargin = 10;\nIEPageSetupX.rightMargin = 10;\nIEPageSetupX.topMargin = 20;\nIEPageSetupX.bottomMargin = 10;\nIEPageSetupX.PrintBackground = true;\nIEPageSetupX.Orientation = 0;\nIEPageSetupX.PaperSize = 'A4';\n</sc"+"ript>";
	var iepage_object = "<script language='JavaScript' for='IEPageSetupX' event='OnError(ErrCode, ErrMsg)'>\nalert('���� �ڵ�: ' + ErrCode + '\n���� �޽���: ' + ErrMsg);\n</sc"+"ript>\n<object id=IEPageSetupX classid='clsid:41C5BC45-1BE8-42C5-AD9F-495D6C8D7586' codebase='/IEPageSetupX/IEPageSetupX.cab#version=1,4,0,3' width=0 height=0>\n<param name='copyright' value='http://isulnara.com'>\n<div style='position:absolute;top:276;left:320;width:300;height:68;border:solid 1 #99B3A0;background:#D8D7C4;overflow:hidden;z-index:1;visibility:visible;'><FONT style='font-family: '����', 'Verdana'; font-size: 9pt; font-style: normal;'>\n<BR>  �μ� �������� ��Ʈ���� ��ġ���� �ʾҽ��ϴ�.  <BR>  <a href='/IEPageSetupX/IEPageSetupX.exe'><font color=red>�̰�</font></a>�� Ŭ���Ͽ� �������� ��ġ�Ͻñ� �ٶ��ϴ�.  </FONT>\n</div>\n</object>";

  PrintPage.document.open();  
  PrintPage.document.write("<html><head><title></title><link rel='stylesheet' type='text/css' href='css/style.css'>\n<link rel='stylesheet' type='text/css' href='css/style_admin.css'>\n</head>\n<body style='margin:0'>\n<div style='text-align:center;'>\n"+iepage_script+"\n"+iepage_object+"\n<div style='margin:0 auto;'>\n" + Obj.innerHTML + "\n</div>\n</div>\n</body></html>");
  PrintPage.document.close();  
  PrintPage.document.title = document.domain;
	// �������
	PrintPage.IEPageSetupX.Orientation = 0;
	// �μ�̸�����
	PrintPage.IEPageSetupX.Preview();
  //PrintPage.print(PrintPage.location.reload());
} 
function damdang_check() {
	var frm = document.dataForm;
	if (frm.damdang_code.value == "")
	{
		alert("����ڸ� �����ϼ���.");
		frm.damdang_code.focus();
		return;
	}
	frm.action = "<?=$PHP_SELF?>";
	frm.submit();
	return;
}
<?
$now_time = date("Y-m-d H:i:s");
// �����
$damdang_code_0022 = "������";
$damdang_code_0023 = "�̹�ȭ";
if($damdang_code != "") {

	$sql = " update a4_modify set 
				damdang_code = '$damdang_code',
				conduct = '$conduct',
				ok_datetime = '$now_time'
			  where id = '$id' ";
	//echo $sql;
	//exit;
	sql_query($sql);

	if($damdang_code == "0022") $damdang_name = $damdang_code_0022;
	else if($damdang_code == "0023") $damdang_name = $damdang_code_0023;
?>
	alert("���������� �����(<?=$damdang_name?>) Ȯ���� �Ǿ����ϴ�.");
	self.location.href = "a4_modify_list_admin.php?page=<?=$page?>&stx_conduct=<?=$stx_conduct?>";
<?
}
?>
</script>

<style type="text/css"> 
@media print{ 
	#noPrint1{display: none;} 
} 
</style> 
<script language="javascript" type="text/javascript"> 
function Installed() 
{ 
	try 
	{ 
		return (new ActiveXObject('IEPageSetupX.IEPageSetup')); 
	} 
	catch (e) 
	{ 
		return false; 
	} 
} 
function PrintTest() 
{ 
	if (!Installed()) 
		alert("��Ʈ���� ��ġ���� �ʾҽ��ϴ�. ���������� �μ���� ���� �� �ֽ��ϴ�.") 
	else 
		alert("���������� ��ġ�Ǿ����ϴ�."); 
} 
function printsetup() 
{ 
	IEPageSetupX.header = ""; // ������� 
	IEPageSetupX.footer = ""; // Ǫ�ͼ��� 
	IEPageSetupX.leftMargin = 10; // ���ʿ��鼳�� 
	IEPageSetupX.rightMargin = 10; // �����ʿ��� ���� 
	IEPageSetupX.topMargin = 20; // ���ʿ��� ���� 
	IEPageSetupX.bottomMargin = 10; // �Ʒ��� ���鼳�� 
	IEPageSetupX.PrintBackground = true; // ���� �� �̹��� �μ� 
	IEPageSetupX.Orientation = 1; // ���� ����� ���Ͻø� 0�� ������ �˴ϴ�. ��������� 1�Դϴ�. 
	IEPageSetupX.PaperSize = 'A4'; // ���������Դϴ�. 
} 
</script> 
<script language='JavaScript' for='IEPageSetupX' event='OnError(ErrCode, ErrMsg)'> 
alert('���� �ڵ�: ' + ErrCode + '\n���� �޽���: ' + ErrMsg); 
</script> 
<div style=' wwedig:12px; line-height:1px; font-size:1px;'>&nbsp;</div> 
<object id=IEPageSetupX classid='clsid:41C5BC45-1BE8-42C5-AD9F-495D6C8D7586' codebase='/IEPageSetupX/IEPageSetupX.cab#version=1,4,0,3' width=0 height=0> 
	<param name='copyright' value='http://isulnara.com'> 
	<div style='position:absolute;top:276;left:320;width:300;height:68;border:solid 1 #99B3A0;background:#D8D7C4;overflow:hidden;z-index:1;visibility:visible;'><FONT style='font-family: '����', 'Verdana'; font-size: 9pt; font-style: normal;'> 
		<BR>  �μ� �������� ��Ʈ���� ��ġ���� �ʾҽ��ϴ�.  <BR>  <a href='/IEPageSetupX/IEPageSetupX.exe'><font color=red>�̰�</font></a>�� Ŭ���Ͽ� �������� ��ġ�Ͻñ� �ٶ��ϴ�.  </FONT> 
	</div> 
</object> 

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
$content_width = "940";
?>
						</td>
						<td width="100%" valign="top" style="padding:10px 10px 10px 10px">
							<div style="width:<?=$content_width?>px">
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

							<table border=0 cellspacing=0 cellpadding=0> 
								<tr> 
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'>
												�Ű�
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

							<div id='print_page'>
							<div id="startPrint" style="width:<?=$content_width?>px"> 
							<!--������ -->
							<form name="dataForm" method="post">
								<input type="hidden" name="id" value="<?=$id?>">
								<div class="td_center big_font">����պ��� ���� �Ű�</div>
								<!--�˻� -->
								<table width="100%" border="0" cellpadding="0" cellspacing="0" class="bgtable1_view" style="table-layout:fixed">
									<col width="20%">
									<col width="30%">
									<col width="20%">
									<col width="30%">
									<tr>
										<td class="td_center">������Ī</td>
										<td class="td_left">
											<?=$row1[comp_name]?>
										</td>
										<td class="td_center">����������</td>
										<td class="td_left">
											<?=$row1[comp_adr]?>
										</td>
									</tr>
									<tr>
										<td class="td_center">����ڵ�Ϲ�ȣ</td>
										<td class="td_left">
											<?=$row1[comp_bznb]?>
										</td>
										<td class="td_center">��ȭ��ȣ</td>
										<td class="td_left">
											<?=$row1[comp_tel]?>
										</td>
									</tr>
									<tr>
										<td class="td_center">�̸���</td>
										<td class="td_left">
											<?=$row1[comp_email]?>
										</td>
										<td class="td_center">�ѽ���ȣ</td>
										<td class="td_left">
											<?=$row1[comp_fax]?>
										</td>
									</tr>
								</table>
								<div style="height:1px;font-size:0px" class="bgtr"></div>
<?
$sql_modify_cnt = " select count(*) as cnt from a4_modify_opt where mid = '$id' ";
$row_modify_cnt = sql_fetch($sql_modify_cnt);
$a4_rowspan = $row_modify_cnt[cnt]+4;
?>
								<!--�Ի��� -->
								<table width="100%" border="0" cellpadding="0" cellspacing="0" class="bgtable1_view" style="">
									<tr>
										<td class="td_center" rowspan="<?=$a4_rowspan?>" width="60">��<br>��<br>��</td>
										<td class="td_center" style="height:25px" width="80">����</td>
										<td class="td_center" width="110">�ֹε�Ϲ�ȣ</td>
										<td class="td_center" width="120">������ ����պ���</td>
										<td class="td_center" width="100">�������� ����</td>
										<td class="td_center" width="210">�������� ����</td>
										<td class="td_center" width="80">�������</td>
										<td class="td_center">���</td>
									</tr>
									<tr>
										<td class="td_center" style="height:25px">
											<?=$row1[modify_name]?>
										</td>
										<td class="td_center">
											<?=$row1[modify_ssnb]?>
										</td>
										<td class="td_right">
											<?=number_format($row1[modify_salary])?> ��
										</td>
										<td class="td_center">
											<?=$row1[modify_date]?>
										</td>
										<td class="td_center">
											<?
											//echo $row1[isgy];
											if($row1[modify_name] != "") {
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
											<input type="checkbox" class="no_borer" <?=$misgy_chk?> dmisabled>���
											<input type="checkbox" class="no_borer" <?=$missj_chk?> dmisabled>����
											<input type="checkbox" class="no_borer" <?=$miskm_chk?> dmisabled>����
											<input type="checkbox" class="no_borer" <?=$misgg_chk?> dmisabled>�ǰ�
											<?
											}
											?>
										</td>
										<td class="td_center">
											<?=$row1[modify_reason]?>
										</td>
										<td class="td_left">
											<?=$row1[modify_note]?>
										</td>
									</tr>
<?
$sql_modify_add = " select * from a4_modify_opt where mid = '$id' order by id ";
$result_modify_add = sql_query($sql_modify_add);
for($i=2; $row2=sql_fetch_array($result_modify_add); $i++) {
	if($row2["modify_salary"]) {
		$modify_salary = number_format($row2["modify_salary"])." ��";
	} else {
		$modify_salary = "";
	}
?>
									<tr>
										<td class="td_center" style="height:25px">
											<?=$row2["modify_name"]?>
										</td>
										<td class="td_center">
											<?=$row2["modify_ssnb"]?>
										</td>
										<td class="td_right">
											<?=$modify_salary?>
										</td>
										<td class="td_center">
											<?=$row2["modify_date"]?>
										</td>
										<td class="td_center">
											<?
											if($row2["modify_name"] != "") {
												$modify_insurance_array = explode(",",$row2["modify_insurance"]);
												if($modify_insurance_array[0] == "1") $misgy_chk = "checked";
												else $misgy_chk = "";
												if($modify_insurance_array[1] == "1") $missj_chk = "checked";
												else $missj_chk = "";
												if($modify_insurance_array[2] == "1") $miskm_chk = "checked";
												else $miskm_chk = "";
												if($modify_insurance_array[3] == "1") $misgg_chk = "checked";
												else $misgg_chk = "";
											?>
											<input type="checkbox" class="no_borer" <?=$misgy_chk?> dmisabled>���
											<input type="checkbox" class="no_borer" <?=$missj_chk?> dmisabled>����
											<input type="checkbox" class="no_borer" <?=$miskm_chk?> dmisabled>����
											<input type="checkbox" class="no_borer" <?=$misgg_chk?> dmisabled>�ǰ�
											<?
											}
											?>
										</td>
										<td class="td_center">
											<?=$row2["modify_reason"]?>
										</td>
										<td class="td_left">
											<?=$row2["modify_note"]?>
										</td>
									</tr>
<?
}
?>
								</table>
								<div style="height:5px;font-size:0px;line-height:0px;"></div>

								</div>
								</div>

								<!--�˻� -->
								<input type="hidden" name="quit_count" value="1">
								<table width="100%" border="0" cellpadding="0" cellspacing="0" class="bgtable1" style="table-layout:fixed" id="quit_optable">
									<col width="20%">
									<col width="30%">
									<col width="20%">
									<col width="30%">
								</table>
				 
								<div style="height:5px;font-size:0px;line-height:0px;"></div>
								<div style="height:10px;font-size:0px;line-height:0px;"></div>

								<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
									<tr>
										<td align="center">
<?
//echo $is_admin;
if($is_admin == "super") {
	//ó�����
	$conduct = $row1[conduct];
?>
											<table border=0 cellpadding=0 cellspacing=0 style="display:inline;">
												<tr>
													<td style="padding-right:5px">�����</td>
													<td>
														<?
														if($row1[damdang_code] == "0022") $damdang_code_select_1 = "selected";
														else $damdang_code_select_1 = "";
														if($row1[damdang_code] == "0023") $damdang_code_select_2 = "selected";
														else $damdang_code_select_2 = "";
														?>
														<select name="damdang_code" class="selectfm">
															<option value="">�����ϼ���</option>
															<option value="0022" <?=$damdang_code_select_1?>><?=$damdang_code_0022?></option>
															<option value="0023" <?=$damdang_code_select_2?>><?=$damdang_code_0023?></option>
														</select>
														<select name="conduct" class="selectfm">
															<option value="1" <? if($conduct == "1") echo "selected"; ?> >ó����</option>
															<option value="2" <? if($conduct == "2") echo "selected"; ?> >ó���Ϸ�</option>
															<option value="3" <? if($conduct == "3") echo "selected"; ?> >������</option>
															<option value="4" <? if($conduct == "4") echo "selected"; ?> >�ݷ�</option>
														</select>
													</td>
												</tr>
											</table>

											<table border=0 cellpadding=0 cellspacing=0 style="display:inline;">
												<tr>
													<td width=2></td>
													<td><img src=images/btn_lt.gif></td>
													<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="javascript:damdang_check()" target="">Ȯ ��</a></td>
													<td><img src=images/btn_rt.gif></td>
												 <td width=2></td>
												</tr>
											</table>
<?
}
?>
<?
//���Ѻ� ��ũ��
if($member['mb_profile'] == "guest") {
	$url_print = "javascript:alert_demo();";
	$url_modify = "javascript:alert_demo();";
} else {
	$url_print = "javascript:pagePrint(document.getElementById('print_page'))";
	$url_modify = "a4_modify_write.php?w=u&id=".$row1[id]."".$qstr;
}
?>

											<table border=0 cellpadding=0 cellspacing=0 style="display:inline;">
												<tr>
													<td width=2></td>
													<td><img src=images/btn_lt.gif></td>
													<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_print?>" target="">�� ��</a></td>
													<td><img src=images/btn_rt.gif></td>
												 <td width=2></td>
												</tr>
											</table>
											<!--<table border=0 cellpadding=0 cellspacing=0 style="display:inline;">
												<tr>
													<td width=2></td>
													<td><img src=images/btn_lt.gif></td>
													<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_modify?>" target="">�� ��</a></td>
													<td><img src=images/btn_rt.gif></td>
												 <td width=2></td>
												</tr>
											</table>-->
											<table border=0 cellpadding=0 cellspacing=0 style=display:inline;>
											 <tr>
												 <td width=2></td>
													<td><img src=images/btn_lt.gif></td>
													<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="4insure_list.php?<?=$qstr?>" target="">�� ��</a></td>
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
