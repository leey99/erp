<?
$sub_menu = "300100";
include_once("./_common.php");
$is_admin = "super";

//�����, ó����Ȳ, ó������ ����
$now_time = date("Y-m-d H:i:s");
$damdang_code_0022 = "������";
$damdang_code_0023 = "�̹�ȭ";
if($damdang_code != "") {
	$sql = " update total_pay set 
				damdang_code = '$damdang_code',
				conduct = '$conduct',
				ok_datetime = '$now_time'
			  where id = '$id' ";
	//echo $sql;
	//exit;
	sql_query($sql);

	if($damdang_code == "0022") $damdang_name = $damdang_code_0022;
	else if($damdang_code == "0023") $damdang_name = $damdang_code_0023;

	alert("���������� �����($damdang_name) Ȯ���� �Ǿ����ϴ�.","total_pay_list_admin.php?page=$page");
}
$result1=mysql_query("select * from total_pay where id = $id");
$row1=mysql_fetch_array($result1);
$comp_bznb = $row1[t_no];
$comp_name = $row1[comp_name];
$boss_name = $row1[boss_name];
$adr_zip = explode("-",$row1[adr_zip]);
$adr_zip1 = $adr_zip[0];
$adr_zip2 = $adr_zip[1];
$adr_adr1 = $row1[adr_adr1];
$adr_adr2 = $row1[adr_adr2];
$sj_upjong_code = $row1[sj_upjong_code];
$sj_upjong = $row1[sj_upjong];
$sj_percent = $row1[sj_percent];
$comp_email = $row1[comp_email];
$comp_tel = $row1[comp_tel];
$comp_fax = $row1[comp_fax];
//�ٷ��� �Ű�Ǽ�
$result2=mysql_query("select count(*) as cnt from total_pay_opt where mid = $id");
$row2=mysql_fetch_array($result2);
$worker_count = $row2[cnt];

// �α��� �� ��������� �α���
if(!$row1[comp_name]) {
	$sql_a4 = " select * from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
	$row_a4 = sql_fetch($sql_a4);
	$row1[comp_name] = $row_a4[com_name];
	$row1[comp_adr]  = $row_a4[com_juso]." ".$row_a4[com_juso2];
	$row1[comp_bznb] = $row_a4[t_insureno];
	$row1[comp_tel]  = $row_a4[com_tel];
}

$sub_title = "2013�⵵ �����Ѿ׽Ű�";
$g4[title] = $sub_title." : �����Ѿ׽Ű� : ".$easynomu_name;
//ó�����
$conduct = $row1[conduct];
//�˻� �Ķ���� ����
$qstr = "stx_comp_name=".$stx_comp_name."&stx_t_no=".$stx_t_no."&stx_comp_tel=".$stx_comp_tel."&stx_conduct=".$stx_conduct;
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
 
	var iepage_script = "<style type='text/css'>\n@media print{ \n#noPrint1{display: none;} \n} \n</style> \n<script language='javascript' type='text/javascript'> \nfunction Installed() \n{ \ntry \n{ \nreturn (new ActiveXObject('IEPageSetupX.IEPageSetup')); \n} \ncatch (e) \n{ \nreturn false; \n} \n} \nfunction PrintTest() \n{ \nif (!Installed()) \nalert('��Ʈ���� ��ġ���� �ʾҽ��ϴ�. ���������� �μ���� ���� �� �ֽ��ϴ�.') \nelse \nalert('���������� ��ġ�Ǿ����ϴ�.'); \n} \nfunction printsetup()\n{ \nIEPageSetupX.header = '';\nIEPageSetupX.footer = '';\nIEPageSetupX.leftMargin = 10;\nIEPageSetupX.rightMargin = 10;\nIEPageSetupX.topMargin = 20;\nIEPageSetupX.bottomMargin = 10;\nIEPageSetupX.PrintBackground = true;\nIEPageSetupX.Orientation = 0;\nIEPageSetupX.PaperSize = 'A4';\n</sc"+"ript>";
	var iepage_object = "<script language='JavaScript' for='IEPageSetupX' event='OnError(ErrCode, ErrMsg)'>\nalert('���� �ڵ�: ' + ErrCode + '\n���� �޽���: ' + ErrMsg);\n</sc"+"ript>\n<object id=IEPageSetupX classid='clsid:41C5BC45-1BE8-42C5-AD9F-495D6C8D7586' codebase='/IEPageSetupX/IEPageSetupX.cab#version=1,4,0,3' width=0 height=0>\n<param name='copyright' value='http://isulnara.com'>\n<div style='position:absolute;top:276;left:320;width:300;height:68;border:solid 1 #99B3A0;background:#D8D7C4;overflow:hidden;z-index:1;visibility:visible;'><FONT style='font-family: '����', 'Verdana'; font-size: 9pt; font-style: normal;'>\n<BR>  �μ� �������� ��Ʈ���� ��ġ���� �ʾҽ��ϴ�.  <BR>  <a href='/IEPageSetupX/IEPageSetupX.exe'><font color=red>�̰�</font></a>�� Ŭ���Ͽ� �������� ��ġ�Ͻñ� �ٶ��ϴ�.  </FONT>\n</div>\n</object>";

  PrintPage.document.open();  
  PrintPage.document.write("<html><head><title></title><link rel='stylesheet' type='text/css' href='css/style.css'>\n<link rel='stylesheet' type='text/css' href='css/style_admin.css'>\n</head>\n<body style='margin:0'>\n<div style='text-align:center;'>\n"+iepage_script+"\n"+iepage_object+"\n<div style='width:1080px;margin:0 auto;'>\n" + Obj.innerHTML + "\n</div>\n</div>\n</body></html>");
  PrintPage.document.close();  
  PrintPage.document.title = document.domain;
	// ����
	PrintPage.IEPageSetupX.topMargin = 0;
	PrintPage.IEPageSetupX.bottomMargin = 0;
	// �������
	PrintPage.IEPageSetupX.Orientation = 0;
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
//����� ���� ����
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
</script>
<? include "./inc/top_admin.php"; ?>
<div id="content">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<div id='print_page'>
				<table width="1080" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td width="100%" valign="top" style="padding:0 10px 0 10px">
							<div style="">
							<!--Ÿ��Ʋ -->
<style type="text/css">
.fax_bgtable1 {
	border-top:1px solid #cccccc;
	border-left:1px solid #cccccc;
	border-right:1px solid #cccccc;
}
.fax_bgtable1 td {
	border:1px solid #cccccc;
}
.fax_bgtable2 {
	border-left:1px solid #cccccc;
	border-right:1px solid #cccccc;
	border-bottom:1px solid #cccccc;
}
.fax_bgtable2 td {
	border:1px solid #cccccc;
}
.fax_tdrowk, .fax_tdrow {
	background:#ffffff;
	padding:4px;
}
.fax_tdrowk_center {
	height:26px;
	text-align:center;
	background:#ffffff;
}
.fax_ltrow1_center_h24 {
	height:30px;
	text-align:center;
	background:#ffffff;
}
.small {
	font-size:7pt;
}
</style>
							<!--������ -->
							<form name="dataForm" method="post">
								<input type="hidden" name="w" value="<?=$w?>">
								<input type="hidden" name="id" value="<?=$id?>">
								<input type="hidden" name="page" value="<?=$page?>">
								<table border=0 cellspacing=0 cellpadding=0 style="margin:10px 0 0 0"> 
									<tr> 
										<td id="">1. ���������</td> 
										<td style="padding:0 0 0 50px">����� : �輺�� 070-4659-4960    /  �ڰ濬 070-4659-2118    /   ȸ���ѽ� 0505-609-0001</td>
									</tr> 
								</table>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!--�˻� -->
								<table width="100%" border="0" cellpadding="0" cellspacing="0" class="fax_bgtable1" style="">
									<col width="120">
									<col width="320">
									<col width="112">
									<col width="230">
									<col width="110">
									<col width="">
									<tr>
										<td nowrap class="fax_tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����������ȣ</td>
										<td nowrap class="fax_tdrow">
											<?=$comp_bznb?>
										</td>
										<td nowrap class="fax_tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">������Ī</td>
										<td nowrap class="fax_tdrow">
											<?=$comp_name?>
										</td>
										<td nowrap class="fax_tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">��ǥ��</td>
										<td nowrap class="fax_tdrow">
											<?=$boss_name?>
										</td>
									</tr>
									<tr>
										<td nowrap class="fax_tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">����������</td>
										<td nowrap class="fax_tdrow" colspan="3">
											<?=$adr_zip1?>-<?=$adr_zip2?> <?=$adr_adr1?> <?=$adr_adr2?>
										</td>
										<td nowrap class="fax_tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�������</td>
										<td nowrap class="fax_tdrow">
											�ڵ�(<?=$sj_upjong_code?>) ����(<?=$sj_percent?>) <?=$sj_upjong?>
										</td>
									</tr>
									<tr>
										<td nowrap class="fax_tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�̸���</td>
										<td nowrap class="fax_tdrow">
											<?=$comp_email?>
										</td>
										<td nowrap class="fax_tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">��ȭ��ȣ</td>
										<td nowrap class="fax_tdrow">
											<?=$comp_tel?>
										</td>
										<td nowrap class="fax_tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�ѽ���ȣ</td>
										<td nowrap class="fax_tdrow">
											<?=$comp_fax?>
										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px;line-height:0px;"></div>

								<table border=0 cellspacing=0 cellpadding=0> 
									<tr> 
										<td id="">2. �ٷ��� �����Ѿ�</td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!--�˻� -->
								<table width="100%" border="0" cellpadding="0" cellspacing="0" class="fax_bgtable1" style="table-layout:fixed;">
									<col width="">
									<col width="44">
									<col width="52">
									<col width="58">
									<col width="58">
									<col width="98">
									<col width="80">
									<col width="58">
									<col width="58">
									<col width="90">
									<col width="90">
									<col width="80">
									<col width="64">
									<col width="98">
									<col width="34">
									<tr>
										<td nowrap class="fax_tdrowk_center" rowspan="3">����</td>
										<td nowrap class="fax_tdrowk_center" rowspan="3">�ֹ�<br>���<br>��ȣ</td>
										<td nowrap class="fax_tdrowk_center" rowspan="3">�����<br>�ΰ�<br>����</td>
										<td nowrap class="fax_tdrowk_center" colspan="4">���纸��</td>
										<td nowrap class="fax_tdrowk_center" colspan="5">��뺸��</td>
										<td nowrap class="fax_tdrowk_center" colspan="3">�ǰ�����</td>
									</tr>
									<tr>
										<td nowrap class="fax_tdrowk_center" rowspan="2">�����</td>
										<td nowrap class="fax_tdrowk_center" rowspan="2">�����</td>
										<td nowrap class="fax_tdrowk_center" rowspan="2">���������Ѿ�<br>(��)</td>
										<td nowrap class="fax_tdrowk_center" rowspan="2">����պ���<br>(��)</td>
										<td nowrap class="fax_tdrowk_center" rowspan="2">�����</td>
										<td nowrap class="fax_tdrowk_center" rowspan="2">�����</td>
										<td nowrap class="fax_tdrowk_center" colspan="2">���������Ѿ�(��)</td>
										<td nowrap class="fax_tdrowk_center" rowspan="2">����պ���<br>(��)</td>
										<td nowrap class="fax_tdrowk_center" rowspan="2">�ڰ����<br>(����)��</td>
										<td nowrap class="fax_tdrowk_center" rowspan="2">���������Ѿ�<br>(��)</td>
										<td nowrap class="fax_tdrowk_center" rowspan="2">�ٹ�<br>����</td>
									</tr>
									<tr>
										<td nowrap class="fax_tdrowk_center" rowspan="" width="90">1~6��<br>�����Ѿ���</td>
										<td nowrap class="fax_tdrowk_center" rowspan="" width="90">7~12��<br>�����Ѿ���</td>
									</tr>
								</table>
								<table width="100%" border="0" cellpadding="0" cellspacing="0" class="fax_bgtable2" style="table-layout:fixed;">
									<col width="">
									<col width="44">
									<col width="52">
									<col width="58">
									<col width="58">
									<col width="98">
									<col width="80">
									<col width="58">
									<col width="58">
									<col width="90">
									<col width="90">
									<col width="80">
									<col width="64">
									<col width="98">
									<col width="34">
									<tr>
<?
$result_opt_cnt = mysql_query("select count(*) as cnt from total_pay_opt where mid = $id");
$row_opt_cnt = mysql_fetch_array($result_opt_cnt);
$cnt = $row_opt_cnt[cnt];
//echo $cnt;
$result_opt = mysql_query("select * from total_pay_opt where mid = $id order by id asc");
for($i=1; $row_opt=sql_fetch_array($result_opt); $i++) {
	$name[$i] = $row_opt[name1];
	//�ֹε�Ϲ�ȣ ���ڸ� ��ǥ ó��
	$ssnb[$i] = explode("-",$row_opt[ssnb1]);
	$ssnb1[$i] = $ssnb[$i][0];
	$ssnb2[$i] = $ssnb[$i][1];
	$bohum_code[$i] = $row_opt[bohum_code1];
	$sj_sdate[$i] = $row_opt[sj_sdate1];
	$sj_edate[$i] = $row_opt[sj_edate1];
	$sj_ypay[$i] = number_format($row_opt[sj_ypay1]);
	if($sj_ypay[$i] == "0") $sj_ypay[$i] = "&nbsp;";
	$sj_mpay[$i] = number_format($row_opt[sj_mpay1]);
	if($sj_mpay[$i] == "0") $sj_mpay[$i] = "&nbsp;";
	$gy_sdate[$i] = $row_opt[gy_sdate1];
	$gy_edate[$i] = $row_opt[gy_edate1];
	$gy_ypay[$i] = number_format($row_opt[gy_ypay1]);
	$gy_ypay2[$i] = number_format($row_opt[gy_ypay2]);
	$gy_mpay[$i] = number_format($row_opt[gy_mpay1]);
	if($gy_ypay[$i] == "0") $gy_ypay[$i] = "&nbsp;";
	if($gy_ypay2[$i] == "0") $gy_ypay2[$i] = "&nbsp;";
	if($gy_mpay[$i] == "0") $gy_mpay[$i] = "&nbsp;";
	$gy_post[$i] = $row_opt[gy_post1];
	$gg_sdate[$i] = $row_opt[gg_sdate1];
	$gg_ypay[$i] = number_format($row_opt[gg_ypay1]);
	$gg_month[$i] = number_format($row_opt[gg_month1]);
	if($gg_ypay[$i] == "0") $gg_ypay[$i] = "&nbsp;";
	if($gg_month[$i] == "0") $gg_month[$i] = "&nbsp;";
}
$temp_sj_ypay = number_format($row1[temp_sj_ypay]);
$temp_gy_ypay = number_format($row1[temp_gy_ypay]);
$temp_gy_ypay2 = number_format($row1[temp_gy_ypay2]);
$etc_sj_ypay = number_format($row1[etc_sj_ypay]);
$etc2_sj_ypay = number_format($row1[etc2_sj_ypay]);
$sj_ysum = number_format($row1[sj_ysum]);
$gy_ysum = number_format($row1[gy_ysum]);
$gy_ysum2 = number_format($row1[gy_ysum2]);
$temp_gg_ypay = number_format($row1[temp_gg_ypay]);
$etc_gg_ypay = number_format($row1[etc_gg_ypay]);
$etc2_gg_ypay = number_format($row1[etc2_gg_ypay]);
$gg_ysum = number_format($row1[gg_ysum]);
if($temp_sj_ypay == "0") $temp_sj_ypay = "&nbsp;";
if($temp_gy_ypay == "0") $temp_gy_ypay = "&nbsp;";
if($temp_gy_ypay2 == "0") $temp_gy_ypay2 = "&nbsp;";
if($etc_sj_ypay == "0") $etc_sj_ypay = "&nbsp;";
if($etc2_sj_ypay == "0") $etc2_sj_ypay = "&nbsp;";
if($sj_ysum == "0") $sj_ysum = "&nbsp;";
if($gy_ysum == "0") $gy_ysum = "&nbsp;";
if($gy_ysum2 == "0") $gy_ysum2 = "&nbsp;";
if($temp_gg_ypay == "0") $temp_gg_ypay = "&nbsp;";
if($etc_gg_ypay == "0") $etc_gg_ypay = "&nbsp;";
if($etc2_gg_ypay == "0") $etc2_gg_ypay = "&nbsp;";
if($gg_ysum == "0") $gg_ysum = "&nbsp;";

for($i=1;$i<=$cnt;$i++) {
	if($i > $worker_count) {
	 $worker_display[$i] = "display:none";
	}

	if(!$bohum_code[$i]) $bohum_code[$i] = "&nbsp;";
	if(!$sj_sdate[$i]) $sj_sdate[$i] = "&nbsp;";
	if(!$sj_edate[$i]) $sj_edate[$i] = "&nbsp;";
	if(!$gy_sdate[$i]) $gy_sdate[$i] = "&nbsp;";
	if(!$gy_edate[$i]) $gy_edate[$i] = "&nbsp;";
	if(!$gg_sdate[$i]) $gg_sdate[$i] = "&nbsp;";
	if(!$gg_month[$i]) $gg_month[$i] = "&nbsp;";
?>
									<tr id="worker_tr<?=$i?>" style="<?=$worker_display[$i]?>" class="list_row_now_wh">
										<td nowrap class="fax_ltrow1_center_h24"><?=$name[$i]?></td>
										<td nowrap class="fax_ltrow1_center_h24 small"><?=$ssnb1[$i]?></td>
										<td nowrap class="fax_ltrow1_center_h24"><?=$bohum_code[$i]?></td>
										<td nowrap class="fax_ltrow1_center_h24 small"><?=$sj_sdate[$i]?></td>
										<td nowrap class="fax_ltrow1_center_h24 small"><?=$sj_edate[$i]?></td>
										<td nowrap class="fax_ltrow1_center_h24"><?=$sj_ypay[$i]?></td>
										<td nowrap class="fax_ltrow1_center_h24"><?=$sj_mpay[$i]?></td>
										<td nowrap class="fax_ltrow1_center_h24 small"><?=$gy_sdate[$i]?></td>
										<td nowrap class="fax_ltrow1_center_h24 small"><?=$gy_edate[$i]?></td>
										<td nowrap class="fax_ltrow1_center_h24"><?=$gy_ypay[$i]?></td>
										<td nowrap class="fax_ltrow1_center_h24"><?=$gy_ypay2[$i]?></td>
										<td nowrap class="fax_ltrow1_center_h24"><?=$gy_mpay[$i]?></td>
										<td nowrap class="fax_ltrow1_center_h24 small"><?=$gg_sdate[$i]?></td>
										<td nowrap class="fax_ltrow1_center_h24"><?=$gg_ypay[$i]?></td>
										<td nowrap class="fax_ltrow1_center_h24"><?=$gg_month[$i]?></td>
									</tr>
<?
}
?>
									<tr class="list_row_now_wh">
										<td nowrap class="fax_ltrow1_center_h24">&nbsp;</td>
										<td nowrap class="fax_ltrow1_center_h24" colspan="2">&nbsp;</td>
										<td nowrap class="fax_ltrow1_center_h24">&nbsp;</td>
										<td nowrap class="fax_ltrow1_center_h24">&nbsp;</td>
										<td nowrap class="fax_ltrow1_center_h24">&nbsp;</td>
										<td nowrap class="fax_ltrow1_center_h24">&nbsp;</td>
										<td nowrap class="fax_ltrow1_center_h24">&nbsp;</td>
										<td nowrap class="fax_ltrow1_center_h24">&nbsp;</td>
										<td nowrap class="fax_ltrow1_center_h24">&nbsp;</td>
										<td nowrap class="fax_ltrow1_center_h24">&nbsp;</td>
										<td nowrap class="fax_ltrow1_center_h24">&nbsp;</td>
										<td nowrap class="fax_ltrow1_center_h24">&nbsp;</td>
										<td nowrap class="fax_ltrow1_center_h24">&nbsp;</td>
										<td nowrap class="fax_ltrow1_center_h24">&nbsp;</td>
									</tr>
									<tr class="list_row_now_wh">
										<td nowrap class="fax_ltrow1_center_h24" colspan="5">�Ͽ�ٷ��� �����Ѿ�</td>
										<td nowrap class="fax_ltrow1_center_h24"><?=$temp_sj_ypay?></td>
										<td nowrap class="fax_ltrow1_center_h24">&nbsp;</td>
										<td nowrap class="fax_ltrow1_center_h24">&nbsp;</td>
										<td nowrap class="fax_ltrow1_center_h24">&nbsp;</td>
										<td nowrap class="fax_ltrow1_center_h24"><?=$temp_gy_ypay?></td>
										<td nowrap class="fax_ltrow1_center_h24"><?=$temp_gy_ypay2?></td>
										<td nowrap class="fax_ltrow1_center_h24">&nbsp;</td>
										<td nowrap class="fax_ltrow1_center_h24">&nbsp;</td>
										<td nowrap class="fax_ltrow1_center_h24"><?=$temp_gg_ypay?></td>
										<td nowrap class="fax_ltrow1_center_h24">&nbsp;</td>
									</tr>
									<tr class="list_row_now_wh">
										<td nowrap class="fax_ltrow1_center_h24" colspan="5">�� ���� �ٷ��� �����Ѿ�(60�ð� �̸�)</td>
										<td nowrap class="fax_ltrow1_center_h24"><?=$etc_sj_ypay?></td>
										<td nowrap class="fax_ltrow1_center_h24">&nbsp;</td>
										<td nowrap class="fax_ltrow1_center_h24">&nbsp;</td>
										<td nowrap class="fax_ltrow1_center_h24">&nbsp;</td>
										<td nowrap class="fax_ltrow1_center_h24">&nbsp;</td>
										<td nowrap class="fax_ltrow1_center_h24">&nbsp;</td>
										<td nowrap class="fax_ltrow1_center_h24">&nbsp;</td>
										<td nowrap class="fax_ltrow1_center_h24">&nbsp;</td>
										<td nowrap class="fax_ltrow1_center_h24"><?=$etc_gg_ypay?></td>
										<td nowrap class="fax_ltrow1_center_h24">&nbsp;</td>
									</tr>
									<tr class="list_row_now_wh">
										<td nowrap class="ltrow1_center_h24" colspan="5">�� ���� �ٷ��� �����Ѿ�(�ܱ��� �ٷ���)</td>
										<td nowrap class="ltrow1_center_h24"><?=$etc2_sj_ypay?></td>
										<td nowrap class="ltrow1_center_h24"></td>
										<td nowrap class="ltrow1_center_h24"></td>
										<td nowrap class="ltrow1_center_h24"></td>
										<td nowrap class="ltrow1_center_h24"></td>
										<td nowrap class="ltrow1_center_h24"></td>
										<td nowrap class="ltrow1_center_h24"></td>
										<td nowrap class="ltrow1_center_h24"></td>
										<td nowrap class="ltrow1_center_h24"><?=$etc2_gg_ypay?></td>
										<td nowrap class="ltrow1_center_h24"></td>
									</tr>
									<tr class="list_row_now_wh">
										<td nowrap class="fax_ltrow1_center_h24" colspan="5">�� ��</td>
										<td nowrap class="fax_ltrow1_center_h24"><?=$sj_ysum?></td>
										<td nowrap class="fax_ltrow1_center_h24">&nbsp;</td>
										<td nowrap class="fax_ltrow1_center_h24">&nbsp;</td>
										<td nowrap class="fax_ltrow1_center_h24">&nbsp;</td>
										<td nowrap class="fax_ltrow1_center_h24"><?=$gy_ysum?></td>
										<td nowrap class="fax_ltrow1_center_h24"><?=$gy_ysum2?></td>
										<td nowrap class="fax_ltrow1_center_h24">&nbsp;</td>
										<td nowrap class="fax_ltrow1_center_h24">&nbsp;</td>
										<td nowrap class="fax_ltrow1_center_h24"><?=$gg_ysum?></td>
										<td nowrap class="fax_ltrow1_center_h24">&nbsp;</td> 
									</tr>
								</table>
								<div style="height:10px;font-size:0px;line-height:0px;"></div>
<?
$etc_count = explode(",",$row1[etc_count]);
?>
								<table border=0 cellspacing=0 cellpadding=0> 
									<tr> 
										<td id="">3. �Ͽ�ٷ��� �� �׹��� �ٷ��ڼ�(��)</td>  
									</tr> 
								</table>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!--�˻� -->
								<div id="temp_etc_count" style="<?=$change_total_display?>">
								<table width="100%" border="0" cellpadding="0" cellspacing="0" class="fax_bgtable1" style="">
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td nowrap class="fax_tdrowk_center">����</td>
<?
for($i=1;$i<13;$i++) {
?>
										<td nowrap class="fax_ltrow1_center_h24" width="70"><?=$i?>��</td>
<?
}
?>
									</tr>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td nowrap class="fax_tdrowk_center">�ٷ��ڼ�</td>
<?
for($i=1;$i<13;$i++) {
	$k = $i - 1;
	if(!$etc_count[$k]) $etc_count[$k] = "&nbsp;";
?>
										<td nowrap class="fax_ltrow1_center_h24"><?=$etc_count[$k]?></td>
<?
}
?>
									</tr>
								</table>

								<!--�˻� -->
								<div style="height:10px;font-size:0px;line-height:0px;"></div>
								<table width="100%" border="0" cellpadding="0" cellspacing="0" style="">
									<tr>
										<td align="" style="">
											<input type="checkbox" name="chk_temp_etc" value="Y" <? if($row1[chk_temp_etc] == "Y") echo "checked"; ?> style="border:0;margin:0 0 3px 0; vertical-align: middle;"> <span style="font-weight:bold">2013�⵵ �ٷ���(�Ͽ�ٷ��� ��) ��� �� �������޾� ����</span>
										</td>
										<td align="" style="">
											<input type="checkbox" name="chk_divide" value="Y" <? if($row1[chk_divide] == "Y") echo "checked"; ?> style="border:0;margin:0 0 3px 0; vertical-align: middle;"> <span style="font-weight:bold">���꺸��� ���Ұ��� �����</span>
										</td>
										<td align="" style="">
											<input type="checkbox" name="chk_appropriate" value="Y" <? if($row1[chk_appropriate] == "Y") echo "checked"; ?> style="border:0;margin:0 0 3px 0; vertical-align: middle;"> <span style="font-weight:bold">��������� ����û�� ����</span>
										</td>
									</tr>
									<tr>
										<td align="" style="">
											<input type="checkbox" name="agree_check1" style="border:0;margin:0 0 3px 0; vertical-align: middle;"> <span style="font-weight:bold">�� ���׿� ���� ��ü���� ���� �ۼ��Ͽ����� Ȯ���մϴ�. </span>
										</td>
										<td align="" style="">
											<input type="checkbox" name="agree_check2" style="border:0;margin:0 0 3px 0; vertical-align: middle;"> <span style="font-weight:bold">��������ó����ħ ����</span>
										</td>
										<td align="" style="">

										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</div><!--����Ʈ ���� ����-->
				<table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin:20px 0 0 0">
					<tr>
						<td align="center">
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
							<table border=0 cellpadding=0 cellspacing=0 style="display:inline;">
								<tr>
									<td width=2></td>
									<td><img src=images/btn_lt.gif></td>
									<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="javascript:pagePrint(document.getElementById('print_page'))" target="">�� ��</a></td>
									<td><img src=images/btn_rt.gif></td>
								 <td width=2></td>
								</tr>
							</table>
							<table border=0 cellpadding=0 cellspacing=0 style="display:inline;">
								<tr>
									<td width=2></td>
									<td><img src=images/btn_lt.gif></td>
									<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="total_pay_write_admin.php?w=u&id=<?=$row1[id]?>&<?=$qstr?>" target="">�� ��</a></td>
									<td><img src=images/btn_rt.gif></td>
								 <td width=2></td>
								</tr>
							</table>
							<table border=0 cellpadding=0 cellspacing=0 style=display:inline;>
							 <tr>
								 <td width=2></td>
									<td><img src=images/btn_lt.gif></td>
									<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="total_pay_list_admin.php?page=<?=$page?>&<?=$qstr?>" target="">�� ��</a></td>
									<td><img src=images/btn_rt.gif></td>
								 <td width=2></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				</form>
				<? include "./inc/bottom.php";?>
			</td>
		</tr>
	</table>			
</div>
</body>
</html>
