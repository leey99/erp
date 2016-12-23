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
<title>4대보험 취득/상실 신고서</title>
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
 
	var iepage_script = "<style type='text/css'>\n@media print{ \n#noPrint1{display: none;} \n} \n</style> \n<script language='javascript' type='text/javascript'> \nfunction Installed() \n{ \ntry \n{ \nreturn (new ActiveXObject('IEPageSetupX.IEPageSetup')); \n} \ncatch (e) \n{ \nreturn false; \n} \n} \nfunction PrintTest() \n{ \nif (!Installed()) \nalert('컨트롤이 설치되지 않았습니다. 정상적으로 인쇄되지 않을 수 있습니다.') \nelse \nalert('정상적으로 설치되었습니다.'); \n} \nfunction printsetup()\n{ \nIEPageSetupX.header = '';\nIEPageSetupX.footer = '';\nIEPageSetupX.leftMargin = 10;\nIEPageSetupX.rightMargin = 10;\nIEPageSetupX.topMargin = 20;\nIEPageSetupX.bottomMargin = 10;\nIEPageSetupX.PrintBackground = true;\nIEPageSetupX.Orientation = 0;\nIEPageSetupX.PaperSize = 'A4';\n</sc"+"ript>";
	var iepage_object = "<script language='JavaScript' for='IEPageSetupX' event='OnError(ErrCode, ErrMsg)'>\nalert('에러 코드: ' + ErrCode + '\n에러 메시지: ' + ErrMsg);\n</sc"+"ript>\n<object id=IEPageSetupX classid='clsid:41C5BC45-1BE8-42C5-AD9F-495D6C8D7586' codebase='/IEPageSetupX/IEPageSetupX.cab#version=1,4,0,3' width=0 height=0>\n<param name='copyright' value='http://isulnara.com'>\n<div style='position:absolute;top:276;left:320;width:300;height:68;border:solid 1 #99B3A0;background:#D8D7C4;overflow:hidden;z-index:1;visibility:visible;'><FONT style='font-family: '굴림', 'Verdana'; font-size: 9pt; font-style: normal;'>\n<BR>  인쇄 여백제어 컨트롤이 설치되지 않았습니다.  <BR>  <a href='/IEPageSetupX/IEPageSetupX.exe'><font color=red>이곳</font></a>을 클릭하여 수동으로 설치하시기 바랍니다.  </FONT>\n</div>\n</object>";

  PrintPage.document.open();  
  PrintPage.document.write("<html><head><title></title><link rel='stylesheet' type='text/css' href='css/style.css'>\n<link rel='stylesheet' type='text/css' href='css/style_admin.css'>\n</head>\n<body style='margin:0'>\n<div style='text-align:center;'>\n"+iepage_script+"\n"+iepage_object+"\n<div style='width:880px;margin:0 auto;'>\n" + Obj.innerHTML + "\n</div>\n</div>\n</body></html>");
  PrintPage.document.close();  
  PrintPage.document.title = document.domain;
	// 세로출력
	PrintPage.IEPageSetupX.Orientation = 0;
	// 인쇄미리보기
	PrintPage.IEPageSetupX.Preview();
  //PrintPage.print(PrintPage.location.reload());
} 
function damdang_check() {
	var frm = document.dataForm;
	if (frm.damdang_code.value == "")
	{
		alert("담당자를 선택하세요.");
		frm.damdang_code.focus();
		return;
	}
	frm.action = "<?=$PHP_SELF?>";
	frm.submit();
	return;
}
<?
$now_time = date("Y-m-d H:i:s");
// 담당자
$damdang_code_0022 = "정진희";
$damdang_code_0023 = "이민화";
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
	alert("정상적으로 담당자(<?=$damdang_name?>) 확인이 되었습니다.");
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
		alert("컨트롤이 설치되지 않았습니다. 정상적으로 인쇄되지 않을 수 있습니다.") 
	else 
		alert("정상적으로 설치되었습니다."); 
} 
function printsetup() 
{ 
	IEPageSetupX.header = ""; // 헤더설정 
	IEPageSetupX.footer = ""; // 푸터설정 
	IEPageSetupX.leftMargin = 10; // 왼쪽여백설정 
	IEPageSetupX.rightMargin = 10; // 오른쪽여백 설정 
	IEPageSetupX.topMargin = 20; // 윗쪽여백 설정 
	IEPageSetupX.bottomMargin = 10; // 아랫쪽 여백설정 
	IEPageSetupX.PrintBackground = true; // 배경색 및 이미지 인쇄 
	IEPageSetupX.Orientation = 1; // 가로 출력을 원하시면 0을 넣으면 됩니다. 세로출력은 1입니다. 
	IEPageSetupX.PaperSize = 'A4'; // 용지설정입니다. 
	// IEPageSetupX.Print(); // 인쇄하기 
	// IEPageSetupX.Print(true); // 인쇄대화상자 띄우기 
	// PrintTest(); // 컨트롤설치여부 테스트 
	// IEPageSetupX.RollBack(); // 수정 이전 값으로 되돌림(한 단계 이전만 지원) 
	// IEPageSetupX.Clear(); // 여백은 0으로, 머리글/바닥글은 모두 제거, 배경색 및 이미지 인쇄 안함 
	// IEPageSetupX.SetDefault(); // 기본값으로 되돌림 
	// IEPageSetupX.SetDefault(); // 기본값으로 복원(여백 모두: 0.75mm, 머리글:&w&b페이지 &p / &P, 바닥글:&u&b&d, 배경색 및 이미지 인쇄: 안함) 
	// IEPageSetupX.Preview(); // 미리보기 
	// IEPageSetupX.SetupPage(); // 페이지설정창 띄우기 
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

							<!--타이틀 -->
							<table width="100%" border=0 cellspacing=0 cellpadding=0>
								<tr>     
									<td height="18">
										<table width=100% border=0 cellspacing=0 cellpadding=0>
											<tr>
												<td style='font-size:8pt;color:#929292;'><img src="images/g_title_icon.gif" align=absmiddle  style='margin:0 5 2 0'><span style='font-size:9pt;color:black;'>4대보험 취득/상실 신고서</span>
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
												신고서
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
							<!--데이터 -->
							<form name="dataForm" method="post">
								<input type="hidden" name="id" value="<?=$id?>">
								<div class="td_center big_font">4대보험 취득·상실 신고서</div>
								<!--검색 -->
								<table width="100%" border="0" cellpadding="0" cellspacing="0" class="bgtable1_view" style="table-layout:fixed">
									<col width="15%">
									<col width="30%">
									<col width="15%">
									<col width="40%">
									<tr>
										<td class="td_center">사업장명칭</td>
										<td class="td_left">
											<?=$row1[comp_name]?>
										</td>
										<td class="td_center">사업장소재지</td>
										<td class="td_left">
											<?=$row1[comp_adr]?>
										</td>
									</tr>
									<tr>
										<td class="td_center">사업자등록번호</td>
										<td class="td_left">
											<?=$row1[comp_bznb]?>
<?
if($row1['t_no']) echo " (".$row1['t_no'].")";
?>
										</td>
										<td class="td_center">전화번호</td>
										<td class="td_left">
											<?=$row1[comp_tel]?>
										</td>
									</tr>
								</table>
								<div style="height:1px;font-size:0px" class="bgtr"></div>
								<!--입사자 -->
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
										<td class="td_center" rowspan="6">입<br>사<br>자</td>
										<td class="td_center" style="height:50px">성명</td>
										<td class="td_center">주민등록번호</td>
										<td class="td_center">입사일</td>
										<td class="td_center">직종</td>
										<td class="td_center">주소정<br>근로시간</td>
										<td class="td_center">월임금</td>
										<td class="td_center">보험적용여부</td>
										<td class="td_center">비고</td>
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
											<input type="checkbox" class="no_borer" <?=$isgy_chk?> disabled>고용
											<input type="checkbox" class="no_borer" <?=$issj_chk?> disabled>산재
											<input type="checkbox" class="no_borer" <?=$iskm_chk?> disabled>연금
											<input type="checkbox" class="no_borer" <?=$isgg_chk?> disabled>건강
										</td>
										<td class="td_left">
<?
if($row1['contract_worker'] == 1) echo "계약직 ";
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
											<input type="checkbox" class="no_borer" <?=$isgy_chk?> disabled>고용
											<input type="checkbox" class="no_borer" <?=$issj_chk?> disabled>산재
											<input type="checkbox" class="no_borer" <?=$iskm_chk?> disabled>연금
											<input type="checkbox" class="no_borer" <?=$isgg_chk?> disabled>건강
											<?
											}
											?>
										</td>
										<td class="td_left">
<?
if($row1['contract_worker_2'] == 1) echo "계약직 ";
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
											<input type="checkbox" class="no_borer" <?=$isgy_chk?> disabled>고용
											<input type="checkbox" class="no_borer" <?=$issj_chk?> disabled>산재
											<input type="checkbox" class="no_borer" <?=$iskm_chk?> disabled>연금
											<input type="checkbox" class="no_borer" <?=$isgg_chk?> disabled>건강
											<?
											}
											?>
										</td>
										<td class="td_left">
<?
if($row1['contract_worker_3'] == 1) echo "계약직 ";
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
											<input type="checkbox" class="no_borer" <?=$isgy_chk?> disabled>고용
											<input type="checkbox" class="no_borer" <?=$issj_chk?> disabled>산재
											<input type="checkbox" class="no_borer" <?=$iskm_chk?> disabled>연금
											<input type="checkbox" class="no_borer" <?=$isgg_chk?> disabled>건강
											<?
											}
											?>
										</td>
										<td class="td_left">
<?
if($row1['contract_worker_4'] == 1) echo "계약직 ";
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
											<input type="checkbox" class="no_borer" <?=$isgy_chk?> disabled>고용
											<input type="checkbox" class="no_borer" <?=$issj_chk?> disabled>산재
											<input type="checkbox" class="no_borer" <?=$iskm_chk?> disabled>연금
											<input type="checkbox" class="no_borer" <?=$isgg_chk?> disabled>건강
											<?
											}
											?>
										</td>
										<td class="td_left">
<?
if($row1['contract_worker_5'] == 1) echo "계약직 ";
if($row1['contract_end_date_5']) echo $row1['contract_end_date_5']." ";
?>
											<?=$row1[join_note_5]?>
										</td>
									</tr>
								</table>
								<div style="height:1px;font-size:0px" class="bgtr"></div>
								<!--퇴직자 -->
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
										<td class="td_center" rowspan="6">퇴<br>사<br>자</td>
										<td class="td_center" style="height:50px">성명</td>
										<td class="td_center">주민등록번호</td>
										<td class="td_center">전화번호</td>
										<td class="td_center">상실일</td>
										<td class="td_center">퇴직사유</td>
										<td class="td_center">해당연도<br>임금총액</td>
										<td class="td_center">산정<br />월수</td>
										<td class="td_center">보험적용<br />여부</td>
										<td class="td_center">전년도<br>임금총액</td>
										<td class="td_center">산정<br />월수</td>
										<td class="td_center">퇴직전3개월간<br>평균임금</td>
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
										$quit_cause[11] = "개인사정으로 인한 자진퇴사";
										$quit_cause[12] = "사업장 이전, 사업장으로 인한 자진퇴사";
										$quit_cause[13] = "질병,부상,노령 등";
										$quit_cause[14] = "징계해고";
										$quit_cause[15] = "기타개인사정,본인사망포함";
										$quit_cause[22] = "폐업, 도산..";
										$quit_cause[23] = "경영상 필요에 의한 해고";
										$quit_cause[24] = "휴업,임금체불, 회사이전..";
										$quit_cause[25] = "기타회사사정,명예퇴직..";
										$quit_cause[26] = "징계해고, 권고사직";
										$quit_cause[31] = "정년";
										$quit_cause[32] = "계약만료, 공사종료";
										$quit_cause[33] = "공사종료";
										$quit_cause[41] = "고용보험 비적용, 이중고용";
										$quit_cause[42] = "이중고용";
										$quit_cause[98] = "소멸사업장 일괄종료";
										$quit_cause[99] = "전근에 의한 퇴직";
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
											<input type="checkbox" class="no_borer" <?=$quit_isgy_chk?> disabled />고용
											<input type="checkbox" class="no_borer" <?=$quit_issj_chk?> disabled />산재
											<br /><input type="checkbox" class="no_borer" <?=$quit_iskm_chk?> disabled />연금
											<input type="checkbox" class="no_borer" <?=$quit_isgg_chk?> disabled />건강
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
											//퇴사자 등록 시만 표시
											if($row1['quit_name_'.$i]) {
											?>
											<input type="checkbox" class="no_borer" <?=$quit_isgy_chk?> disabled />고용
											<input type="checkbox" class="no_borer" <?=$quit_issj_chk?> disabled />산재
											<br /><input type="checkbox" class="no_borer" <?=$quit_iskm_chk?> disabled />연금
											<input type="checkbox" class="no_borer" <?=$quit_isgg_chk?> disabled />건강
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

								<!--검색 -->
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
//처리결과
$conduct = $row1['conduct'];
//echo $is_admin;
//본사 권한
if($is_admin == "super") {
?>
											<table border=0 cellpadding=0 cellspacing=0 style="display:inline;">
												<tr>
													<td style="padding-right:5px">담당자</td>
													<td>
														<?
														if($row1[damdang_code] == "0022") $damdang_code_select_1 = "selected";
														else $damdang_code_select_1 = "";
														if($row1[damdang_code] == "0023") $damdang_code_select_2 = "selected";
														else $damdang_code_select_2 = "";
														?>
														<select name="damdang_code" class="selectfm">
															<option value="">선택하세요</option>
															<option value="0022" <?=$damdang_code_select_1?>><?=$damdang_code_0022?></option>
															<option value="0023" <?=$damdang_code_select_2?>><?=$damdang_code_0023?></option>
														</select>
														<select name="conduct" class="selectfm">
															<option value="1" <? if($conduct == "1") echo "selected"; ?> >처리중</option>
															<option value="2" <? if($conduct == "2") echo "selected"; ?> >처리완료</option>
															<option value="3" <? if($conduct == "3") echo "selected"; ?> >예약중</option>
															<option value="4" <? if($conduct == "4") echo "selected"; ?> >반려</option>
														</select>
													</td>
												</tr>
											</table>

											<table border=0 cellpadding=0 cellspacing=0 style="display:inline;">
												<tr>
													<td width=2></td>
													<td><img src=images/btn_lt.gif></td>
													<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="javascript:damdang_check()" target="">확 인</a></td>
													<td><img src=images/btn_rt.gif></td>
												 <td width=2></td>
												</tr>
											</table>
<?
}
?>
<?
//권한별 링크값
if($member['mb_profile'] == "guest") {
	$url_print = "javascript:alert_demo();";
	$url_modify = "javascript:alert_demo();";
} else {
	$url_print = "javascript:pagePrint(document.getElementById('print_page'))";
	if($conduct == 2 || $conduct == 4) $url_modify = "javascript:alert('처리완료/반려된 접수 건은 수정이 불가능합니다.');";
	else $url_modify = "4insure_write.php?w=u&id=".$row1['id']."".$qstr;
}
?>

											<table border=0 cellpadding=0 cellspacing=0 style="display:inline;">
												<tr>
													<td width=2></td>
													<td><img src=images/btn_lt.gif></td>
													<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_print?>" target="">출 력</a></td>
													<td><img src=images/btn_rt.gif></td>
												 <td width=2></td>
												</tr>
											</table>
											<table border=0 cellpadding=0 cellspacing=0 style="display:inline;">
												<tr>
													<td width=2></td>
													<td><img src=images/btn_lt.gif></td>
													<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_modify?>" target="">수 정</a></td>
													<td><img src=images/btn_rt.gif></td>
												 <td width=2></td>
												</tr>
											</table>
											<table border=0 cellpadding=0 cellspacing=0 style=display:inline;>
											 <tr>
												 <td width=2></td>
													<td><img src=images/btn_lt.gif></td>
													<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="4insure_list.php?<?=$qstr?>" target="">목 록</a></td>
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
