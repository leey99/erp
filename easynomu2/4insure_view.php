<?
$sub_menu = "700200";
include_once("./_common.php");

$result1=mysql_query("select * from $g4[insure_table] where id = $id");
$row1=mysql_fetch_array($result1);
if($row1[join_date] == "0000-00-00 00:00:00") $row1[join_date] = "";
if($row1[join_date_2] == "0000-00-00 00:00:00") $row1[join_date_2] = "";
if($row1[join_date_3] == "0000-00-00 00:00:00") $row1[join_date_3] = "";
if($row1[join_date_4] == "0000-00-00 00:00:00") $row1[join_date_4] = "";
if($row1[join_date_5] == "0000-00-00 00:00:00") $row1[join_date_5] = "";
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
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title>4�뺸�� ���/��� �Ű�</title>
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
  PrintPage.document.write("<html><head><title></title><link rel='stylesheet' type='text/css' href='css/style.css'>\n<link rel='stylesheet' type='text/css' href='css/style_admin.css'>\n</head>\n<body style='margin:0'>\n<div style='text-align:center;'>\n"+iepage_script+"\n"+iepage_object+"\n<div style='width:880px;margin:0 auto;'>\n" + Obj.innerHTML + "\n</div>\n</div>\n</body></html>");
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

	$sql = " update $g4[insure_table] set 
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
	self.location.href = "4insure_list.php?page=<?=$page?>";
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
	// IEPageSetupX.Print(); // �μ��ϱ� 
	// IEPageSetupX.Print(true); // �μ��ȭ���� ���� 
	// PrintTest(); // ��Ʈ�Ѽ�ġ���� �׽�Ʈ 
	// IEPageSetupX.RollBack(); // ���� ���� ������ �ǵ���(�� �ܰ� ������ ����) 
	// IEPageSetupX.Clear(); // ������ 0����, �Ӹ���/�ٴڱ��� ��� ����, ���� �� �̹��� �μ� ���� 
	// IEPageSetupX.SetDefault(); // �⺻������ �ǵ��� 
	// IEPageSetupX.SetDefault(); // �⺻������ ����(���� ���: 0.75mm, �Ӹ���:&w&b������ &p / &P, �ٴڱ�:&u&b&d, ���� �� �̹��� �μ�: ����) 
	// IEPageSetupX.Preview(); // �̸����� 
	// IEPageSetupX.SetupPage(); // ����������â ���� 
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
							<table width="100%" border=0 cellspacing=0 cellpadding=0>
								<tr>     
									<td height="18">
										<table width=100% border=0 cellspacing=0 cellpadding=0>
											<tr>
												<td style='font-size:8pt;color:#929292;'><img src="images/g_title_icon.gif" align=absmiddle  style='margin:0 5 2 0'><span style='font-size:9pt;color:black;'>4�뺸�� ���/��� �Ű�</span>
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
							<div id="startPrint"> 
							<!--������ -->
							<form name="dataForm" method="post">
								<input type="hidden" name="id" value="<?=$id?>">
								<div class="td_center big_font">4�뺸�� ��桤��� �Ű�</div>
								<!--�˻� -->
								<table width="100%" border="0" cellpadding="0" cellspacing="0" class="bgtable1_view" style="table-layout:fixed">
									<col width="15%">
									<col width="30%">
									<col width="15%">
									<col width="40%">
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
<?
if($row1['t_no']) echo " (".$row1['t_no'].")";
?>
										</td>
										<td class="td_center">��ȭ��ȣ</td>
										<td class="td_left">
											<?=$row1[comp_tel]?>
										</td>
									</tr>
								</table>
								<div style="height:1px;font-size:0px" class="bgtr"></div>
								<!--�Ի��� -->
								<table width="100%" border="0" cellpadding="0" cellspacing="0" class="bgtable1_view" style="table-layout:fixed">
									<col width="4%">
									<col width="6%">
									<col width="12%">
									<col width="11%">
									<col width="6%">
									<col width="8%">
									<col width="10%">
									<col width="">
									<col width="20%">
									<tr>
										<td class="td_center" rowspan="6">��<br>��<br>��</td>
										<td class="td_center" style="height:50px">����</td>
										<td class="td_center">�ֹε�Ϲ�ȣ</td>
										<td class="td_center">�Ի���</td>
										<td class="td_center">����</td>
										<td class="td_center">�ּ���<br>�ٷνð�</td>
										<td class="td_center">���ӱ�</td>
										<td class="td_center">�������뿩��</td>
										<td class="td_center">���</td>
									</tr>
									<tr>
										<td class="td_left" style="height:40px">
											<?=$row1[join_name]?>
										</td>
										<td class="td_left">
											<?=$row1[join_ssnb]?>
										</td>
										<td class="td_left">
											<?=substr($row1[join_date], 0, 11);?>
										</td>
										<td class="td_center">
											<?=$row1[join_jikjong_code]?>
										</td>
										<td class="td_right">
											<?=$row1[join_time]?>
										</td>
										<td class="td_right">
											<?=$row1[join_salary]?>
										</td>
										<td class="td_center">
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
											<input type="checkbox" class="no_borer" <?=$isgy_chk?> disabled>���
											<input type="checkbox" class="no_borer" <?=$issj_chk?> disabled>����
											<input type="checkbox" class="no_borer" <?=$iskm_chk?> disabled>����
											<input type="checkbox" class="no_borer" <?=$isgg_chk?> disabled>�ǰ�
										</td>
										<td class="td_left">
<?
if($row1['contract_worker'] == 1) echo "����� ";
if($row1['contract_end_date']) echo $row1['contract_end_date']." ";
?>
											<?=$row1[join_note]?>
										</td>
									</tr>
									<tr>
										<td class="td_left" style="height:40px">
											<?=$row1[join_name_2]?>
										</td>
										<td class="td_left">
											<?=$row1[join_ssnb_2]?>
										</td>
										<td class="td_left">
											<?=substr($row1[join_date_2], 0, 11);?>
										</td>
										<td class="td_center">
											<?=$row1[join_jikjong_code_2]?>
										</td>
										<td class="td_right">
											<?=$row1[join_time_2]?>
										</td>
										<td class="td_right">
											<?=$row1[join_salary_2]?>
										</td>
										<td class="td_center">
											<?
											if($row1[join_name_2] != "") {
												if($row1[isgy_2] == "1") $isgy_chk = "checked";
												else $isgy_chk = "";
												if($row1[issj_2] == "1") $issj_chk = "checked";
												else $issj_chk = "";
												if($row1[iskm_2] == "1") $iskm_chk = "checked";
												else $iskm_chk = "";
												if($row1[isgg_2] == "1") $isgg_chk = "checked";
												else $isgg_chk = "";
											?>
											<input type="checkbox" class="no_borer" <?=$isgy_chk?> disabled>���
											<input type="checkbox" class="no_borer" <?=$issj_chk?> disabled>����
											<input type="checkbox" class="no_borer" <?=$iskm_chk?> disabled>����
											<input type="checkbox" class="no_borer" <?=$isgg_chk?> disabled>�ǰ�
											<?
											}
											?>
										</td>
										<td class="td_left">
<?
if($row1['contract_worker_2'] == 1) echo "����� ";
if($row1['contract_end_date_2']) echo $row1['contract_end_date_2']." ";
?>
											<?=$row1[join_note_2]?>
										</td>
									</tr>
									<tr>
										<td class="td_left" style="height:40px">
											<?=$row1[join_name_3]?>
										</td>
										<td class="td_left">
											<?=$row1[join_ssnb_3]?>
										</td>
										<td class="td_left">
											<?=substr($row1[join_date_3], 0, 11);?>
										</td>
										<td class="td_center">
											<?=$row1[join_jikjong_code_3]?>
										</td>
										<td class="td_right">
											<?=$row1[join_time_3]?>
										</td>
										<td class="td_right">
											<?=$row1[join_salary_3]?>
										</td>
										<td class="td_center">
											<?
											if($row1[join_name_3] != "") {
												if($row1[isgy_3] == "1") $isgy_chk = "checked";
												else $isgy_chk = "";
												if($row1[issj_3] == "1") $issj_chk = "checked";
												else $issj_chk = "";
												if($row1[iskm_3] == "1") $iskm_chk = "checked";
												else $iskm_chk = "";
												if($row1[isgg_3] == "1") $isgg_chk = "checked";
												else $isgg_chk = "";
											?>
											<input type="checkbox" class="no_borer" <?=$isgy_chk?> disabled>���
											<input type="checkbox" class="no_borer" <?=$issj_chk?> disabled>����
											<input type="checkbox" class="no_borer" <?=$iskm_chk?> disabled>����
											<input type="checkbox" class="no_borer" <?=$isgg_chk?> disabled>�ǰ�
											<?
											}
											?>
										</td>
										<td class="td_left">
<?
if($row1['contract_worker_3'] == 1) echo "����� ";
if($row1['contract_end_date_3']) echo $row1['contract_end_date_3']." ";
?>
											<?=$row1[join_note_3]?>
										</td>
									</tr>
									<tr>
										<td class="td_left" style="height:40px">
											<?=$row1[join_name_4]?>
										</td>
										<td class="td_left">
											<?=$row1[join_ssnb_4]?>
										</td>
										<td class="td_left">
											<?=substr($row1[join_date_4], 0, 11);?>
										</td>
										<td class="td_center">
											<?=$row1[join_jikjong_code_4]?>
										</td>
										<td class="td_right">
											<?=$row1[join_time_4]?>
										</td>
										<td class="td_right">
											<?=$row1[join_salary_4]?>
										</td>
										<td class="td_center">
											<?
											if($row1[join_name_4] != "") {
												if($row1[isgy_4] == "1") $isgy_chk = "checked";
												else $isgy_chk = "";
												if($row1[issj_4] == "1") $issj_chk = "checked";
												else $issj_chk = "";
												if($row1[iskm_4] == "1") $iskm_chk = "checked";
												else $iskm_chk = "";
												if($row1[isgg_4] == "1") $isgg_chk = "checked";
												else $isgg_chk = "";
											?>
											<input type="checkbox" class="no_borer" <?=$isgy_chk?> disabled>���
											<input type="checkbox" class="no_borer" <?=$issj_chk?> disabled>����
											<input type="checkbox" class="no_borer" <?=$iskm_chk?> disabled>����
											<input type="checkbox" class="no_borer" <?=$isgg_chk?> disabled>�ǰ�
											<?
											}
											?>
										</td>
										<td class="td_left">
<?
if($row1['contract_worker_4'] == 1) echo "����� ";
if($row1['contract_end_date_4']) echo $row1['contract_end_date_4']." ";
?>
											<?=$row1[join_note_4]?>
										</td>
									</tr>
									<tr>
										<td class="td_left" style="height:40px">
											<?=$row1[join_name_5]?>
										</td>
										<td class="td_left">
											<?=$row1[join_ssnb_5]?>
										</td>
										<td class="td_left">
											<?=substr($row1[join_date_5], 0, 11);?>
										</td>
										<td class="td_center">
											<?=$row1[join_jikjong_code_5]?>
										</td>
										<td class="td_right">
											<?=$row1[join_time_5]?>
										</td>
										<td class="td_right">
											<?=$row1[join_salary_5]?>
										</td>
										<td class="td_center">
											<?
											if($row1[join_name_5] != "") {
												if($row1[isgy_5] == "1") $isgy_chk = "checked";
												else $isgy_chk = "";
												if($row1[issj_5] == "1") $issj_chk = "checked";
												else $issj_chk = "";
												if($row1[iskm_5] == "1") $iskm_chk = "checked";
												else $iskm_chk = "";
												if($row1[isgg_5] == "1") $isgg_chk = "checked";
												else $isgg_chk = "";
											?>
											<input type="checkbox" class="no_borer" <?=$isgy_chk?> disabled>���
											<input type="checkbox" class="no_borer" <?=$issj_chk?> disabled>����
											<input type="checkbox" class="no_borer" <?=$iskm_chk?> disabled>����
											<input type="checkbox" class="no_borer" <?=$isgg_chk?> disabled>�ǰ�
											<?
											}
											?>
										</td>
										<td class="td_left">
<?
if($row1['contract_worker_5'] == 1) echo "����� ";
if($row1['contract_end_date_5']) echo $row1['contract_end_date_5']." ";
?>
											<?=$row1[join_note_5]?>
										</td>
									</tr>
								</table>
								<div style="height:1px;font-size:0px" class="bgtr"></div>
								<!--������ -->
								<table width="100%" border="0" cellpadding="0" cellspacing="0" class="bgtable1_view" style="table-layout:fixed">
									<col width="4%">
									<col width="6%">
									<col width="12%">
									<col width="11%">
									<col width="9%">
									<col width="10%">
									<col width="8%">
									<col width="4%">
									<col width="106">
									<col width="">
									<col width="4%">
									<col width="10%">
									<tr>
										<td class="td_center" rowspan="6">��<br>��<br>��</td>
										<td class="td_center" style="height:50px">����</td>
										<td class="td_center">�ֹε�Ϲ�ȣ</td>
										<td class="td_center">��ȭ��ȣ</td>
										<td class="td_center">�����</td>
										<td class="td_center">��������</td>
										<td class="td_center">�ش翬��<br>�ӱ��Ѿ�</td>
										<td class="td_center">����<br />����</td>
										<td class="td_center">��������<br />����</td>
										<td class="td_center">���⵵<br>�ӱ��Ѿ�</td>
										<td class="td_center">����<br />����</td>
										<td class="td_center">������3������<br>����ӱ�</td>
									</tr>
									<tr>
										<td class="td_left" style="height:40px">
											<?=$row1[quit_name]?>
										</td>
										<td class="td_left">
											<?=$row1[quit_ssnb]?>
										</td>
										<td class="td_left">
											<?=$row1[quit_tel]?>
										</td>
										<td class="td_left">
											<?=substr($row1[quit_date], 0, 11);?>
										</td>
										<?
										$quit_cause[11] = "���λ������� ���� �������";
										$quit_cause[12] = "����� ����, ��������� ���� �������";
										$quit_cause[13] = "����,�λ�,��� ��";
										$quit_cause[14] = "¡���ذ�";
										$quit_cause[15] = "��Ÿ���λ���,���λ������";
										$quit_cause[22] = "���, ����..";
										$quit_cause[23] = "�濵�� �ʿ信 ���� �ذ�";
										$quit_cause[24] = "�޾�,�ӱ�ü��, ȸ������..";
										$quit_cause[25] = "��Ÿȸ�����,������..";
										$quit_cause[26] = "¡���ذ�, �ǰ����";
										$quit_cause[31] = "����";
										$quit_cause[32] = "��ุ��, ��������";
										$quit_cause[33] = "��������";
										$quit_cause[41] = "��뺸�� ������, ���߰��";
										$quit_cause[42] = "���߰��";
										$quit_cause[98] = "�Ҹ����� �ϰ�����";
										$quit_cause[99] = "���ٿ� ���� ����";
										?>
										<td class="td_left">
											<?=$quit_cause[$row1[quit_cause]]?>
										</td>
										<td class="td_right">
											<?=$row1[quit_sum_now]?>
										</td>
										<td class="td_right">
											<?=$row1[quit_sum_now_month]?>
										</td>
										<td class="td_center">
											<?
											if($row1[quit_isgy] == "1") $quit_isgy_chk = "checked";
											else $quit_isgy_chk = "";
											if($row1[quit_issj] == "1") $quit_issj_chk = "checked";
											else $quit_issj_chk = "";
											if($row1[quit_iskm] == "1") $quit_iskm_chk = "checked";
											else $quit_iskm_chk = "";
											if($row1[quit_isgg] == "1") $quit_isgg_chk = "checked";
											else $quit_isgg_chk = "";
											?>
											<input type="checkbox" class="no_borer" <?=$quit_isgy_chk?> disabled />���
											<input type="checkbox" class="no_borer" <?=$quit_issj_chk?> disabled />����
											<br /><input type="checkbox" class="no_borer" <?=$quit_iskm_chk?> disabled />����
											<input type="checkbox" class="no_borer" <?=$quit_isgg_chk?> disabled />�ǰ�
										</td>
										<td class="td_right">
											<?=$row1[quit_sum_pre]?>
										</td>
										<td class="td_right">
											<?=$row1[quit_sum_pre_month]?>
										</td>
										<td class="td_right">
											<?=$row1[quit_3month]?>
										</td>
									</tr>
<?
for($i=2; $i<=5; $i++) {
?>
									<tr>
										<td class="td_left" style="height:40px">
											<?=$row1['quit_name_'.$i]?>
										</td>
										<td class="td_left">
											<?=$row1['quit_ssnb_'.$i]?>
										</td>
										<td class="td_left">
											<?=$row1['quit_tel_'.$i]?>
										</td>
										<td class="td_left">
											<?=substr($row1['quit_date_'.$i], 0, 11);?>
										</td>
										<td class="td_left">
											<?=$quit_cause[$row1['quit_cause_'.$i]]?>
										</td>
										<td class="td_right">
											<?=$row1['quit_sum_now_'.$i]?>
										</td>
										<td class="td_right">
											<?=$row1['quit_sum_now_month_'.$i]?>
										</td>
										<td class="td_center">
											<?
											if($row1['quit_isgy_'.$i] == "1") $quit_isgy_chk = "checked";
											else $quit_isgy_chk = "";
											if($row1['quit_issj_'.$i] == "1") $quit_issj_chk = "checked";
											else $quit_issj_chk = "";
											if($row1['quit_iskm_'.$i] == "1") $quit_iskm_chk = "checked";
											else $quit_iskm_chk = "";
											if($row1['quit_isgg_'.$i] == "1") $quit_isgg_chk = "checked";
											else $quit_isgg_chk = "";
											//����� ��� �ø� ǥ��
											if($row1['quit_name_'.$i]) {
											?>
											<input type="checkbox" class="no_borer" <?=$quit_isgy_chk?> disabled />���
											<input type="checkbox" class="no_borer" <?=$quit_issj_chk?> disabled />����
											<br /><input type="checkbox" class="no_borer" <?=$quit_iskm_chk?> disabled />����
											<input type="checkbox" class="no_borer" <?=$quit_isgg_chk?> disabled />�ǰ�
											<?
											}
											?>
										</td>
										<td class="td_right">
											<?=$row1['quit_sum_pre_'.$i]?>
										</td>
										<td class="td_right">
											<?=$row1['quit_sum_pre_month_'.$i]?>
										</td>
										<td class="td_right">
											<?=$row1['quit_3month_'.$i]?>
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
//ó�����
$conduct = $row1['conduct'];
//echo $is_admin;
//���� ����
if($is_admin == "super") {
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
	if($conduct == 2 || $conduct == 4) $url_modify = "javascript:alert('ó���Ϸ�/�ݷ��� ���� ���� ������ �Ұ����մϴ�.');";
	else $url_modify = "4insure_write.php?w=u&id=".$row1['id']."".$qstr;
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
											<table border=0 cellpadding=0 cellspacing=0 style="display:inline;">
												<tr>
													<td width=2></td>
													<td><img src=images/btn_lt.gif></td>
													<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_modify?>" target="">�� ��</a></td>
													<td><img src=images/btn_rt.gif></td>
												 <td width=2></td>
												</tr>
											</table>
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
