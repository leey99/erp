<?
$sub_menu = "200200";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

//사원등록시 ID 초기화
if(strlen($id) != 4) $id = "";
//사업장정보
if(!$com_code) {
	$sql_com = " select com_code from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
	$row_com = sql_fetch($sql_com);
	$com_code = $row_com[com_code];
}
//사업장정보 추가
$sql_com_opt = " select * from com_list_gy_opt where com_code='$com_code' ";
$result_com_opt = sql_query($sql_com_opt);
$row_com_opt=mysql_fetch_array($result_com_opt);
//사업장 타입
if($row_com_opt[comp_print_type]) {
	$comp_print_type = $row_com_opt[comp_print_type];
} else {
	$comp_print_type = "default";
}
//주간근로시간 DB
$sql_work_time = " select * from a4_work_time where com_code='$com_code' and sabun ='' ";
$result_work_time = sql_query($sql_work_time);
$row_work_time=mysql_fetch_array($result_work_time);
//echo $sql_work_time;

$sql_common = " from $g4[pibohum_base] ";

$sub_title = "변경내역 및 출력";
$g4[title] = $sub_title." : 사원관리 : ".$easynomu_name;

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
 
	var iepage_script = "<style type='text/css'>\n@media print{ \n#noPrint1{display: none;} \n} \n</style> \n<script language='javascript' type='text/javascript'> \nfunction Installed() \n{ \ntry \n{ \nreturn (new ActiveXObject('IEPageSetupX.IEPageSetup')); \n} \ncatch (e) \n{ \nreturn false; \n} \n} \nfunction PrintTest() \n{ \nif (!Installed()) \nalert('컨트롤이 설치되지 않았습니다. 정상적으로 인쇄되지 않을 수 있습니다.') \nelse \nalert('정상적으로 설치되었습니다.'); \n} \nfunction printsetup()\n{ \nIEPageSetupX.header = '';\nIEPageSetupX.footer = '';\nIEPageSetupX.leftMargin = 10;\nIEPageSetupX.rightMargin = 10;\nIEPageSetupX.topMargin = 20;\nIEPageSetupX.bottomMargin = 10;\nIEPageSetupX.PrintBackground = true;\nIEPageSetupX.Orientation = 1;\nIEPageSetupX.PaperSize = 'A4';\n</sc"+"ript>";
	var iepage_object = "<script language='JavaScript' for='IEPageSetupX' event='OnError(ErrCode, ErrMsg)'>\nalert('에러 코드: ' + ErrCode + '\n에러 메시지: ' + ErrMsg);\n</sc"+"ript>\n<object id=IEPageSetupX classid='clsid:41C5BC45-1BE8-42C5-AD9F-495D6C8D7586' codebase='/IEPageSetupX/IEPageSetupX.cab#version=1,4,0,3' width=0 height=0>\n<param name='copyright' value='http://isulnara.com'>\n<div style='position:absolute;top:276;left:320;width:300;height:68;border:solid 1 #99B3A0;background:#D8D7C4;overflow:hidden;z-index:1;visibility:visible;'><FONT style='font-family: '굴림', 'Verdana'; font-size: 9pt; font-style: normal;'>\n<BR>  인쇄 여백제어 컨트롤이 설치되지 않았습니다.  <BR>  <a href='/IEPageSetupX/IEPageSetupX.exe'><font color=red>이곳</font></a>을 클릭하여 수동으로 설치하시기 바랍니다.  </FONT>\n</div>\n</object>";

  PrintPage.document.open();  
  PrintPage.document.write("<html><head><title></title><link rel='stylesheet' type='text/css' href='css/style.css'>\n<link rel='stylesheet' type='text/css' href='css/style_admin.css'>\n</head>\n<body style='margin:0'>\n<div style='text-align:center;'>\n"+iepage_script+"\n"+iepage_object+"\n<div style='width:880px;margin:0 auto;'>\n" + Obj.innerHTML + "\n</div>\n</div>\n</body></html>");
  PrintPage.document.close();  
  PrintPage.document.title = document.domain;
	// 크기에 맞게 축소
	PrintPage.IEPageSetupX.ShrinkToFit = true;
	// 배경색 배경이미지 출력
	PrintPage.IEPageSetupX.PrintBackground = true;
	// 가로출력
	PrintPage.IEPageSetupX.Orientation = 1;
	// 인쇄미리보기
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
							<!--타이틀 -->
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
								<!--댑메뉴 -->
								<table border=0 cellspacing=0 cellpadding=0> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
													변경내역
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
								<!--댑메뉴 -->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
									<tr>
										<td nowrap class="tdhead_center" width="32">No</td>
										<td nowrap class="tdhead_center" width="">변경일시</td>
										<td nowrap class="tdhead_center" width="62">직위</td>
										<td nowrap class="tdhead_center" width="82">결정임금</td>
										<td nowrap class="tdhead_center" width="82">기본급</td>
										<td nowrap class="tdhead_center" width="60">채용형태</td>
										<td nowrap class="tdhead_center" width="60">급여형태</td>
										<td nowrap class="tdhead_center" width="74">입사일</td>
										<td nowrap class="tdhead_center" width="74">퇴사일</td>
										<td nowrap class="tdhead_center" width="200">취득여부</td>
									</tr>
<?
// 리스트 출력
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
	//채용형태
	if($row[work_form] == "") $work_form = "";
	else if($row[work_form] == "1") $work_form = "정규직";
	else if($row[work_form] == "2") $work_form = "계약직";
	else if($row[work_form] == "3") $work_form = "일용직";
	//입사일/퇴사일
	if($row[in_day] == "..") $in_day = "-";
	else if($row[in_day] == "") $in_day = "-";
	else $in_day = $row[in_day];
	if($row[out_day] == "..") $out_day = "-";
	else if($row[out_day] == "") $out_day = "-";
	else $out_day = $row[out_day];
	//사원 추가 DB
	$sql_opt = " select * from pibohum_bak_opt where mid='$row[id]' ";
	$result_opt = sql_query($sql_opt);
	$row_opt=mysql_fetch_array($result_opt);
	//부서
	$dept = $row_opt[dept_1];
	//echo $row_opt['mid'];
	//직위
	$position = "-";
	if($row_opt[position]) {
		$sql_position = " select * from com_code_list where item='position' and com_code = '$code' and code = $row_opt[position] ";
		//echo $sql_position;
		$result_position = sql_query($sql_position);
		$row_position = sql_fetch_array($result_position);
		if($row_position[name]) $position = $row_position[name];
		else $position = "-";
	}
	//급여구분
	if($row_opt[pay_gbn] == "0") $pay_gbn = "월급제";
	else if($row_opt[pay_gbn] == "1") $pay_gbn = "시급제";
	else if($row_opt[pay_gbn] == "2") $pay_gbn = "복합근무";
	else if($row_opt[pay_gbn] == "3") $pay_gbn = "연봉제";
	else $pay_gbn = "-";
	//최초등록일자
	$sql_opt2 = " select * from pibohum_base_opt2 where com_code='$code' and sabun='$id' ";
	$result_opt2 = sql_query($sql_opt2);
	$row_opt2=mysql_fetch_array($result_opt2);
	$registration_date = $row_opt2[wr_date];
	//변경일자
	$sql_bak_opt2 = " select max(wr_date) as modify_date from pibohum_bak_opt2 where mid='$row[id]' ";
	$result_bak_opt2 = sql_query($sql_bak_opt2);
	$row_bak_opt2=mysql_fetch_array($result_bak_opt2);
	$modify_date = $row_bak_opt2[modify_date];
	//급여정보
	$sql_bak_opt2 = " select * from pibohum_bak_opt2 where mid='$row[id]' ";
	$result_bak_opt2 = sql_query($sql_bak_opt2);
	$row_bak_opt2=mysql_fetch_array($result_bak_opt2);
	//링크값
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
											<!--취득여부 문자형 0 비교-->
											<input type="checkbox" name="isgy" value="0" class="checkbox" disabled <? if($row[apply_gy] == "0") echo "checked"; ?> >고용
											<input type="checkbox" name="issj" value="0" class="checkbox" disabled <? if($row[apply_sj] == "0") echo "checked"; ?> >산재
											<input type="checkbox" name="iskm" value="0" class="checkbox" disabled <? if($row[apply_km] == "0") echo "checked"; ?> >연금
											<input type="checkbox" name="isgg" value="0" class="checkbox" disabled <? if($row[apply_gg] == "0") echo "checked"; ?> >건강
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
								<!--댑메뉴 -->
								<table border=0 cellspacing=0 cellpadding=0> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
													기본정보
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
								<!--댑메뉴 -->

								<!--기본폼 dataForm-->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<col width="11%">
									<col width="23%">
									<col width="11%">
									<col width="23%">
									<col width="10%">
									<col width="22%">
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">성명</td>
										<td nowrap class="tdrow">
											<?=$row1['name']?>
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">주민등록번호</td>
										<td nowrap class="tdrow">
											<?
											$jumin_no = explode("-",$row1['jumin_no']);
											?>

											<?=$jumin_no[0]?>-<?=$jumin_no[1]?>
										</td>
										<td nowrap class="tdrowk" rowspan="3">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">증명사진
										</td>
										<td nowrap class="tdrow" rowspan="3">
											<?
												//증명사진
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
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">입사일<font color="red">*</font></td>
										<td nowrap class="tdrow">
											<?=$row1['in_day']?>
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">외국인 여부</td>
										<td nowrap class="tdrow">
											<?
											if($row1['fg_div'] == 0) echo "내국인";
											else echo "외국인";
											?>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">주소</td>
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
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">휴대폰</td>
										<td nowrap class="tdrow">
											<?=$row2['emp_cel']?>
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">전화번호</td>
										<td nowrap class="tdrow">
											<?=$row1['add_tel']?>
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">재직상태</td>
										<td nowrap class="tdrow">
											<?
											if($row1['gubun'] == 0) echo "재직";
											else if($row1['gubun'] == 1) echo "휴직";
											else if($row1['gubun'] == 2) echo "퇴사";
											else echo "재직";
											?>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">채용형태</td>
										<td nowrap class="tdrow">
											<?
											if($row1['work_form'] == "") $row1['work_form'] = 1;
											$work_form_id = $row1['work_form'];
											$work_form_txt[1] = "정규직";
											$work_form_txt[2] = "계약직";
											$work_form_txt[3] = "일용직";
											$work_form_txt[4] = "사업소득";
											echo $work_form_txt[$work_form_id];
											?>
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">직위(직책)</td>
										<td nowrap class="tdrow">
												<?
												$sql_position = " select * from com_code_list where item='position' and com_code='$code' and code='$row2[position]' ";
												$result_position = sql_query($sql_position);
												$row_position = sql_fetch_array($result_position);
												echo $row_position['name'];
												?>
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">직종</td>
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
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">계약시작일</td>
										<td class="tdrow">
											<?=$row2['contract_sdate']?>
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">계약종료일</td>
										<td class="tdrow">
											<?=$row2['contract_edate']?>
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">퇴사일</td>
										<td nowrap class="tdrow">
											<?=$row1['out_day']?>
										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px;line-height:0px;"></div>

								<!--댑메뉴 -->
								<table border=0 cellspacing=0 cellpadding=0> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
													추가정보
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
								<!--댑메뉴 -->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<tr>
										<td nowrap class="tdrowk" rowspan="2"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">적용보험<font color="red"></font></td>
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

											<input type="checkbox" name="isgy" value="0" class="checkbox" disabled <?=$isgy_chk?>>고용
											<input type="checkbox" name="issj" value="0" class="checkbox" disabled <?=$issj_chk?>>산재
											<input type="checkbox" name="iskm" value="0" class="checkbox" disabled <?=$iskm_chk?>>연금
											<input type="checkbox" name="isgg" value="0" class="checkbox" disabled <?=$isgg_chk?>>건강
											<input type="checkbox" name="isjy" value="0" class="checkbox" disabled <?=$isjy_chk?>>장기요양
											<br>
											국민연금 신규가입 불가(만60세 이상), 고용보험 신규가입 불가(만 65세 이상)
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">적용세금</td>
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

											<input type="checkbox" name="isso" value="0" class="checkbox" disabled <?=$isso_chk?>>소득세,주민세
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">두루누리
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
											<input type="checkbox" name="insurance" value="1" class="checkbox" disabled <?=$insurance_chk?> style="vertical-align:middle" onclick="insurance_div(this);">두루누리 사회보험
											<div id="year_month" style="margin:0 0 4px 0;<?=$year_month_display?>">
												적용시점
												<select name="insurance_year">
<?
for($i=2014;$i<2016;$i++) {
?>
													<option value="<?=$i?>" <? if($i == $row2['insurance_year']) echo "selected"; ?> ><?=$i?></option>
<?
}
?>
												</select>년
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


												</select>월
											</div>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">부양가족수</td>
										<td nowrap class="tdrow" colspan="3">
											총 (본인포함)
<?
$family_cnt = $row2['family_cnt'];
if($family_cnt == "" || $family_cnt == "0") $family_cnt = 1;
$child_cnt = $row2['child_cnt'];
$etc_cnt = $row2['etc_cnt'];
?>
											<b><?=$family_cnt?>명</b>
											20세이하 자녀 <b><?=$child_cnt?>명</b>
											기타 부양가족 <b><?=$etc_cnt?>명</b>
										</td>
										<td class="tdrowk"></td>
										<td class="tdrow">
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">이메일</td>
										<td nowrap class="tdrow">
											<?=$row2['emp_email']?>
										</td>
										<td class="tdrowk" width="74"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">부서명</td>
										<td class="tdrow">
											<?=$row2['dept_1']?>
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">소속지사</td>
										<td class="tdrow">
											<?=$row2['dept_2']?>
										</td>
									</tr>
									<tr>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">계좌번호</td>
										<td class="tdrow">
											<?=$row2['bank_account']?>
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">은행명</td>
										<td class="tdrow">
											<?=$row2['bank_name']?>
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">예금주</td>
										<td class="tdrow">
											<?=$row2['bank_depositor']?>
										</td>
									</tr>
									<tr>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">국적</td>
										<td class="tdrow">
											<?=$row1['nation']?>
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">체류자격</td>
										<td class="tdrow">
<?
if($row1['staycapacity'] == "B1") $staycapacity = "B1 사증면제";
else if($row1['staycapacity'] == "B2") $staycapacity = "B2 관광통과";
else if($row1['staycapacity'] == "C2") $staycapacity = "C2 단기상용";
else if($row1['staycapacity'] == "C3") $staycapacity = "C3 단기종합";
else if($row1['staycapacity'] == "C4") $staycapacity = "C4 단기취업";
else if($row1['staycapacity'] == "C4") $staycapacity = "C4 단기취업";
else if($row1['staycapacity'] == "D2") $staycapacity = "D2 유학";
else if($row1['staycapacity'] == "D3") $staycapacity = "D3 산업연수";
else if($row1['staycapacity'] == "D4") $staycapacity = "D4 일반연수";
else if($row1['staycapacity'] == "E4") $staycapacity = "E4 기술지도";
else if($row1['staycapacity'] == "E5") $staycapacity = "E5 전문직업";
else if($row1['staycapacity'] == "E7") $staycapacity = "E7 특정활동";
else if($row1['staycapacity'] == "E8") $staycapacity = "E8 연수취업";
else if($row1['staycapacity'] == "E9") $staycapacity = "E9 비전문취업";
else if($row1['staycapacity'] == "E10") $staycapacity = "E10 선원취업";
else if($row1['staycapacity'] == "F1") $staycapacity = "F1 방문동거";
else if($row1['staycapacity'] == "F2") $staycapacity = "F2 거주";
else if($row1['staycapacity'] == "F3") $staycapacity = "F3 동반";
else if($row1['staycapacity'] == "F4") $staycapacity = "F4 재외동포";
else if($row1['staycapacity'] == "F5") $staycapacity = "F5 영주";
else if($row1['staycapacity'] == "G1") $staycapacity = "G1 기타";
else if($row1['staycapacity'] == "H1") $staycapacity = "H1 관광취업";
else if($row1['staycapacity'] == "H2") $staycapacity = "H2 방문취업";
echo $staycapacity;
?>
										</td>
										<td class="tdrowk"></td>
										<td class="tdrow">
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">특이사항</td>
										<td nowrap class="tdrow" colspan="5">
											<?=$row2[remark]?>
										</td>
									</tr>
								</table>

								<div style="height:10px;font-size:0px;line-height:0px;"></div>
								<!--댑메뉴 -->
								<table border=0 cellspacing=0 cellpadding=0> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:130px;text-align:center'> 
														<a href="javascript:tab_view('support');">지원금 대상자</a>
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
								<!--댑메뉴 -->
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
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">장애인여부</td>
											<td nowrap class="tdrow">
												<?
												if($row2[drawback_form] == 0) echo "0.해당사항없음";
												else if($row2[drawback_form] == 1) echo "1.지체장애";
												else if($row2[drawback_form] == 2) echo "2.뇌병변장애";
												else if($row2[drawback_form] == 3) echo "3.시각장애";
												else if($row2[drawback_form] == 4) echo "4.청각장애";
												else if($row2[drawback_form] == 5) echo "5.언어장애";
												else if($row2[drawback_form] == 6) echo "6.안명장애";
												else if($row2[drawback_form] == 7) echo "7.신장장애";
												else if($row2[drawback_form] == 8) echo "8.심장장애";
												else if($row2[drawback_form] == 9) echo "9.간장애";
												else if($row2[drawback_form] == 10) echo "10.호흡기장애";
												else if($row2[drawback_form] == 11) echo "11.장루/요루장애";
												else if($row2[drawback_form] == 12) echo "12.간질장애";
												else if($row2[drawback_form] == 13) echo "13.지적장애";
												else if($row2[drawback_form] == 14) echo "14.정신장애";
												else if($row2[drawback_form] == 15) echo "15.자폐성장애";
												else if($row2[drawback_form] == 16) echo "16.기타";
												else echo "0.해당사항없음";

												if($row2[drawback_form_grade] == 1) echo "1급";
												else if($row2[drawback_form_grade] == 2) echo "2급";
												else if($row2[drawback_form_grade] == 3) echo "3급";
												else if($row2[drawback_form_grade] == 4) echo "4급";
												else if($row2[drawback_form_grade] == 5) echo "5급";
												else if($row2[drawback_form_grade] == 6) echo "6급";
												else echo "";
												?>
											</td>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">고령자</td>
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

												<input type="checkbox" name="aged" value="1" class="checkbox" disabled <?=$aged_chk?>> 60세이상
											</td>
											<td nowrap class="tdrowk"></td>
											<td nowrap class="tdrow">
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">정년이후재고용</td>
											<td nowrap class="tdrow">
												<?
												if($row2['retired'] == "") echo "해당사항없음";
												else if($row2['retired'] == 1) echo "정년이후재고용";
												else echo "";
												?>
											</td>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">새터민고용</td>
											<td nowrap class="tdrow">
												<input type="checkbox" name="deferred" value="1" class="checkbox" disabled <?=$deferred_chk?>> 새터민고용지원
											</td>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">출산여부</td>
											<td nowrap class="tdrow">
												<?
												if($row2['chidbirth'] == "") echo "해당사항없음";
												else if($row2['chidbirth'] == 1) echo "출산육아기고용";
												else if($row2['chidbirth'] == 2) echo "출산육아기대체인력";
												?>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">여성가장</td>
											<td nowrap class="tdrow">
												<?
												if($row2['matriarch'] == "") echo "해당사항없음";
												else if($row2['matriarch'] == 1) echo "한부모가정";
												else if($row2['matriarch'] == 2) echo "기초생활대상자";
												?>
											</td>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">도서지역</td>
											<td nowrap class="tdrow">
												<input type="checkbox" name="rural" value="1" class="checkbox" disabled <? if($row2[rural] == "1") echo "checked"; ?> > 도서지역거주자
											</td>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">처우개선비</td>
											<td nowrap class="tdrow">
												<input type="checkbox" name="treatment" value="1" class="checkbox" disabled <? if($row2[treatment] == "1") echo "checked"; ?> > 처우개선비
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
											<td class="tdrowk_center" rowspan="3" style="font-weight:bold">선<br>택</td>
											<td class="tdrow"><input type="checkbox" name="fund[0]" value="1" class="checkbox" disabled <?=$fund_chk1?>> 취업성공패키지<br><img src="images/blank.gif" width="24" height="1">(고용노동부)</td>
											<td class="tdrow"><input type="checkbox" name="fund[1]" value="1" class="checkbox" disabled <?=$fund_chk2?>> 50+새일터적응지원사업<br><img src="images/blank.gif" width="24" height="1">(고용노동부)</td>
											<td class="tdrow"><input type="checkbox" name="fund[2]" value="1" class="checkbox" disabled <?=$fund_chk3?>> 직업교육훈련 프로그램<br><img src="images/blank.gif" width="24" height="1">(경력단절여성지원센터)</td>
											<td class="tdrow"><input type="checkbox" name="fund[3]" value="1" class="checkbox" disabled <?=$fund_chk4?>> 고령자 취업능력향상프로그램<br><img src="images/blank.gif" width="24" height="1">(고령자인재은행)</td>
										</tr>
										<tr>
											<td class="tdrow"><input type="checkbox" name="fund[4]" value="1" class="checkbox" disabled <?=$fund_chk5?>> 시험고용 프로그램<br><img src="images/blank.gif" width="24" height="1">(한국장애인고용공단)</td>
											<td class="tdrow"><input type="checkbox" name="fund[5]" value="1" class="checkbox" disabled <?=$fund_chk6?>> 직업능력개발훈련 프로그램<br><img src="images/blank.gif" width="24" height="1">(한국장애인고용공단)</td>
											<td class="tdrow"><input type="checkbox" name="fund[6]" value="1" class="checkbox" disabled <?=$fund_chk7?>> 직업재활 프로그램<br><img src="images/blank.gif" width="24" height="1">(한국장애인고용공단)</td>
											<td class="tdrow"><input type="checkbox" name="fund[7]" value="1" class="checkbox" disabled <?=$fund_chk8?>> 학업중단 청소년 자립/학습지원 사업<br><img src="images/blank.gif" width="24" height="1">(여성가족부)</td>
										</tr>
										<tr>
											<td class="tdrow"><input type="checkbox" name="fund[8]" value="1"  class="checkbox" disabled <?=$fund_chk9?> > 자활근로<br><img src="images/blank.gif" width="24" height="1">(지방자체단체)</td>
											<td class="tdrow"><input type="checkbox" name="fund[9]" value="1"  class="checkbox" disabled <?=$fund_chk10?>> 희망리본 프로젝트<br><img src="images/blank.gif" width="24" height="1">(보건복지부)</td>
											<td class="tdrow"><input type="checkbox" name="fund[10]" value="1" class="checkbox" disabled <?=$fund_chk11?>> 출소자 허그일자리 지원 프로그램<br><img src="images/blank.gif" width="24" height="1">(법무부,한국법무보호복지공단)</td>
											<td class="tdrow"><input type="checkbox" name="fund[11]" value="1" class="checkbox" disabled <?=$fund_chk12?>> 전직기본교육 (한국보훈복지의료공단,<br><img src="images/blank.gif" width="24" height="1">제대군인지원센터)</td>
										</tr>
									</table>
								</div>
								<div style="height:10px;font-size:0px;line-height:0px;"></div>

								<!--댑메뉴 -->
								<table border=0 cellspacing=0 cellpadding=0> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:160px;text-align:center'> 
														<a href="javascript:tab_view('school_career');">학력/경력/교육/자격/면허</a>
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
								<!--댑메뉴 -->
								<div id="school_career" style="display:none">
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
									<col width="5%">
									<col width="40%">
									<col width="30%">
									<col width="25%">
									<tr>
										<td class="tdrowk_center" rowspan="4" style="font-weight:bold">학<br>력</td>
										<td class="tdrowk_center">기 간</td>
										<td class="tdrowk_center">학교명 및 전공학과</td>
										<td class="tdrowk_center">학 위</td>
									</tr>
									<tr>
										<td class="tdrow">
											<input size="14" type="text" class="textfm" name="school_sdate" value="<?=$row2[school_sdate]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '3','Y')" /> ~
											<input size="14" type="text" class="textfm" name="school_edate" value="<?=$row2[school_edate]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '4','Y')" /> 예) 2001.03.02~2005.02.10
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
										<td class="tdrowk_center" rowspan="4" style="font-weight:bold">경<br>력</td>
										<td class="tdrowk_center">기 간</td>
										<td class="tdrowk_center">근무처</td>
										<td class="tdrowk_center">직 위</td>
									</tr>
									<tr>
										<td class="tdrow">
											<input size="14" type="text" class="textfm" name="career_sdate" value="<?=$row2[career_sdate]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '9','Y')" /> ~
											<input size="14" type="text" class="textfm" name="career_edate" value="<?=$row2[career_edate]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '10','Y')" /> 예) 2001.03.02~2005.02.10
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
										<td class="tdrowk_center" rowspan="4" style="font-weight:bold">교육<br>이수</td>
										<td class="tdrowk_center">기 간</td>
										<td class="tdrowk_center">종 류</td>
										<td class="tdrowk_center">훈련기관</td>
									</tr>
									<tr>
										<td class="tdrow">
											<input size="14" type="text" class="textfm" name="education_sdate" value="<?=$row2[education_sdate]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '17','Y')" /> ~
											<input size="14" type="text" class="textfm" name="education_edate" value="<?=$row2[education_edate]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '18','Y')" /> 예) 2001.03.02~2005.02.10
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
										<td class="tdrowk_center" rowspan="4" style="font-weight:bold">자격<br>면허</td>
										<td class="tdrowk_center">취득일자</td>
										<td class="tdrowk_center">자격/면허명</td>
										<td class="tdrowk_center">자격번호</td>
										<td class="tdrowk_center">발행기관</td>
									</tr>
									<tr>
										<td class="tdrow">
											<input size="14" type="text" class="textfm" name="license_date" value="<?=$row2[license_date]?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, '23','Y')" /> 예) 2012.12.10
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
								<!--댑메뉴 -->
								<table border=0 cellspacing=0 cellpadding=0> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
													기초정보
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
								<!--댑메뉴 -->
								<?
								//결정임금
								//$pay_year = "1100000";
								if($row4[money_month_base])	{
									$pay_year = $row4[money_month_base];
								} else {
									$pay_year = 0;
								}
								//기준시급
								if($row4[money_hour_ds]) {
									$money_hour = $row4[money_hour_ds];
								} else {
									$money_hour = 4860;
								}
								//기본급
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
										<td class="tdrowk_center">유형</td>
										<td class="tdrow">
<?
if($row2[pay_gbn] == "") $row2[pay_gbn] = "0";
$pay_gbn = $row2[pay_gbn];
$pay_gbn_array = array("월급제","시급제","복합근무","연봉제");
echo $pay_gbn_array[$pay_gbn];
?>
										</td>
										<td class="tdrowk_center">주근로시간</td>
										<td class="tdrow">
<?
if($row2[work_gbn] == "A" || $row2[work_gbn] == "") echo "주40시간";
else echo "주44시간";
?>
										</td>
										<td class="tdrowk_center">연차</td>
										<td class="tdrow">
											<?=$row4[annual_paid_holiday]?>
										</td>
									</tr>
									<tr>
										<td class="tdrowk_center">직위(직책)</td>
										<td class="tdrow">
											<?
											$sql_position = " select * from com_code_list where item='position' and com_code='$code' and code='$row2[position]' ";
											$result_position = sql_query($sql_position);
											$row_position=mysql_fetch_array($result_position);
											echo $row_position[name];
											?>
										</td>
										<td class="tdrowk_center">호봉</td>
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

								<!--댑메뉴 -->
								<table border=0 cellspacing=0 cellpadding=0> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
													상여금
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
								<!--댑메뉴 -->
<?
$bonus_array = explode(",",$row4[bonus_time]);
if($bonus_array[0] == "") $bonus_time1 = "설";
else $bonus_time1 = $bonus_array[0];
if($bonus_array[1] == "") $bonus_time2 = "추석";
else $bonus_time2 = $bonus_array[1];
if($bonus_array[2] == "") $bonus_time3 = "하기휴가";
else $bonus_time3 = $bonus_array[2];
if($bonus_array[3] == "") $bonus_time4 = "연말";
else $bonus_time4 = $bonus_array[3];
if($bonus_array[4] == "") $bonus_time5 = "";
else $bonus_time5 = $bonus_array[4];
if($bonus_array[5] == "") $bonus_time6 = "";
else $bonus_time6 = $bonus_array[5];
$bonus_p = explode(",",$row4[bonus_p]);
//상여금 수동입력
$check_bonus_money_yn = $row4[check_bonus_money_yn];
$bonus_money = $row4[bonus_money];
?>
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<tr>
										<td class="tdrowk_center">구 분</td>
										<td class="tdrowk">산정기준</td>
										<td class="tdrowk">지급시기1</td>
										<td class="tdrowk">지급시기2</td>
										<td class="tdrowk">지급시기3</td>
										<td class="tdrowk">지급시기4</td>
										<td class="tdrowk">지급시기5</td>
										<td class="tdrowk">지급시기6</td>
									</tr>
									<tr>
										<td class="tdrowk" style="padding:5px">명칭</td>
										<td class="tdrow" width="140">
<?
if($check_bonus_money_yn == "Y") {
	echo number_format($bonus_money);
} else {
	if($row4[bonus_standard] == "1") echo "기본급";
	else if($row4[bonus_standard] == "2") echo "결정임금";
	else if($row4[bonus_standard] == "3") echo "통상임금";
	else if($row4[bonus_standard] == "4") echo "총급여";
	else echo "미지급";
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
										<td class="tdrowk">상여비율</td>
										<td class="tdrow"><?=$row4[bonus_percent]?>%</td>
										<td class="tdrow"><?=$bonus_p[0]?>%</td>
										<td class="tdrow"><?=$bonus_p[1]?>%</td>
										<td class="tdrow"><?=$bonus_p[2]?>%</td>
										<td class="tdrow"><?=$bonus_p[3]?>%</td>
										<td class="tdrow"><?=$bonus_p[4]?>%</td>
										<td class="tdrow"><?=$bonus_p[5]?>%</td>
									</tr>
								</table>

								<!--사원/급여정보 입력-->
							</form>
							<!--기본폼 dataForm-->

							<div style="height:10px;font-size:0px;line-height:0px;"></div>

							<!-- 월급제 / 복합근무 -->
							<form name="formSalary" id="formSalary" style="margin:0display:;">
								<!--댑메뉴 -->
								<table border=0 cellspacing=0 cellpadding=0> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
													근로시간
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
								<!--댑메뉴 -->
<?
//기본연장
$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='b1' ";
$row_paycode = sql_fetch($sql_paycode);
if($row_paycode[multiple]) {
	$rate_ext = $row_paycode[multiple];
} else {
	$rate_ext = 1.5;
}
//야간근로
$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='b2' ";
$row_paycode = sql_fetch($sql_paycode);
if($row_paycode[multiple]) {
	$rate_night = $row_paycode[multiple];
} else {
	$rate_night = 2;
}
//휴일근로
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
										<td class="tdrowk_center" width="142">구 분</td>
										<td class="tdrowk"><b>소정</b>근로시간</td>
										<td class="tdrowk"><b>연장</b>근로시간</td>
										<td class="tdrowk"><b>야간</b>근로시간</td>
										<td class="tdrowk"><b>휴일</b>근로시간</td>
										<td class="tdrowk"><b>총</b>근로시간</td>
									</tr>
									<tr>
										<td class="tdrowk"><b>1주</b>근로시간</td>
										<td class="tdrow"><?=$row4[workhour_day_w]?> 시간</td>
										<td class="tdrow"><?=$row4[workhour_ext_w]?> 시간</td>
										<td class="tdrow"><?=$row4[workhour_night_w]?> 시간</td>
										<td class="tdrow"><?=$row4[workhour_hday_w]?> 시간</td>
										<td class="tdrow"><?=$workhour_total_w?> 시간</td>

									</tr>
									<tr>
										<td class="tdrowk"><b>1개월</b>근로시간</td>
										<td class="tdrow"><?=$row4[workhour_day]?> 시간</td>
										<td class="tdrow"><?=$row4[workhour_ext]?> 시간</td>
										<td class="tdrow"><?=$row4[workhour_night]?> 시간</td>
										<td class="tdrow"><?=$row4[workhour_hday]?> 시간</td>
										<td class="tdrow"><?=$workhour_total?> 시간</td>
									</tr>
									<tr>
										<td class="tdrowk"><b>근로수당</td>
										<td class="tdrow"></td>
										<td class="tdrow"><?=$money_ext?> 원</td>
										<td class="tdrow"><?=$money_night?> 원</td>
										<td class="tdrow"><?=$money_hday?> 원</td>
										<td class="tdrow"></td>
								</table>
								<div style="height:10px;font-size:0px;line-height:0px;"></div>

								<!--댑메뉴 -->
								<table border=0 cellspacing=0 cellpadding=0> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0>
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:170;text-align:center'> 
														<span id="decision"><? if($row2['pay_gbn'] == "1") echo "기준시급"; else echo "결정임금"; ?></span> / 기본시급 / 기본급
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
								<!--댑메뉴 -->

								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
									<tr>
										<td class="tdrowk_center" width="90"><span id="decision_txt"><? if($row2['pay_gbn'] == "1") echo "기준시급"; else echo "결정임금"; ?></span></td>
										<td class="tdrow">
											<div id="decision_div" style="<? if($row2['pay_gbn'] == "1") echo "display:none"; else echo "display:inline"; ?>">
												<?=number_format($pay_year)?> 원
											</div>
											<div id="decision_div2" style="<? if($row2['pay_gbn'] != "1") echo "display:none"; else echo "display:inline"; ?>">
												<?=number_format($money_hour)?> 원
											</div>
										</td>
										<td class="tdrowk" width="110"></td>
										<td class="tdrow">
											
										</td>
									</tr>
									<tr>
										<td class="tdrowk_center">최저시급</td>
										<td class="tdrow" valign="top">
											<?
											if($check_money_min_2013_yn == "Y") echo "4,860";
											else echo "5,210";
											?> 원
										</td>
										<td class="tdrowk_center">통상임금(시급)</td>
										<td class="tdrow">
											<?=number_format($row4['money_hour_ts'])?> 원
										</td>
									</tr>
									<tr>
										<td class="tdrowk_center">기본급</td>
										<td class="tdrow" valign="top">
											<?=$money_hour_ms?> 원
										</td>
										<td class="tdrowk_center"></td>
										<td class="tdrow">

										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px;line-height:0px;"></div>

								<!--댑메뉴 -->
								<table border=0 cellspacing=0 cellpadding=0> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
													통상임금(과세)
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
								<!--댑메뉴 -->
								<?
								//직위 입력 유무
								if($row2['position']) {
									$sql_position_pay = " select * from com_code_list where code = $row2[position] and com_code='$code' ";
									$result_position_pay = sql_query($sql_position_pay);
									$row_position_pay = sql_fetch_array($result_position_pay);
									//$position_pay = $row_position_pay[amount];
									//호봉수당
									$sql_step_pay = " select * from com_code_list where code = $row2[step] and com_code='$code' ";
									$result_step_pay = sql_query($sql_step_pay);
									$row_step_pay = sql_fetch_array($result_step_pay);
									//$step_pay = $row_step_pay[amount];
								}

								//통상임금1
								$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='g1' ";
								$row_paycode = sql_fetch($sql_paycode);
								$money_g1_txt = $row_paycode[name];
								if($row4[money_g1] == "") {
									$row4[money_g1] = $row_paycode[calculate];
								}
								//통상임금2
								$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='g2' ";
								$row_paycode = sql_fetch($sql_paycode);
								$money_g2_txt = $row_paycode[name];
								if($row4[money_g2] == "") {
									$row4[money_g2] = $row_paycode[calculate];
								}
								//통상임금3
								$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='g3' ";
								$row_paycode = sql_fetch($sql_paycode);
								$money_g3_txt = $row_paycode[name];
								if($row4[money_g3] == "") {
									$row4[money_g3] = $row_paycode[calculate];
								}
								//통상임금4
								$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='g4' ";
								$row_paycode = sql_fetch($sql_paycode);
								$money_g4_txt = $row_paycode[name];
								if($row4[money_g4] == "") {
									$row4[money_g4] = $row_paycode[calculate];
								}
								//통상임금5
								$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='g5' ";
								$row_paycode = sql_fetch($sql_paycode);
								$money_g5_txt = $row_paycode[name];
								if($row4[money_g5] == "") {
									$row4[money_g5] = $row_paycode[calculate];
								}
								//통상임금6
								$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='g6' ";
								$row_paycode = sql_fetch($sql_paycode);
								$money_g6_txt = $row_paycode[name];
								if($row4[money_g6] == "") {
									$row4[money_g6] = $row_paycode[calculate];
								}
								//통상임금7
								$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='g7' ";
								$row_paycode = sql_fetch($sql_paycode);
								$money_g7_txt = $row_paycode[name];
								if($row4[money_g7] == "") {
									$row4[money_g7] = $row_paycode[calculate];
								}
								//통상임금8
								$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='g8' ";
								$row_paycode = sql_fetch($sql_paycode);
								$money_g8_txt = $row_paycode[name];
								if($row4[money_g8] == "") {
									$row4[money_g8] = $row_paycode[calculate];
								}

								//직책수당 데이터 무일 때 0
								//if($position_pay == "") $position_pay = 0;
								if($row4[money_g1] != "") $money_g1 = $row4[money_g1];
								else $money_g1 = 0;
								if($row4[money_g2] != "") $money_g2 = $row4[money_g2];
								else $money_g2 = 0;
								//호봉 데이터 무일 때 0
								//if($step_pay == "") $step_pay = 0;
								if($row4[money_g3] != "") $money_g3 = $row4[money_g3];
								else $money_g3 = 0;
								if($row4[money_g4] != "") $money_g4 = $row4[money_g4];
								else $money_g4 = 0;
								if($row4[money_g5] != "") $money_g5 = $row4[money_g5];
								else $money_g5 = 0;
								//통상임금 추가분
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
										<td class="tdrow_center"><?=number_format($money_g1)?> 원</td>
										<td class="tdrowk_center"><?=$money_g2_txt?></td>
										<td class="tdrow_center"><?=number_format($money_g2)?> 원</td>
										<td class="tdrowk_center"><?=$money_g3_txt?></td>
										<td class="tdrow_center"><?=number_format($money_g3)?> 원</td>
										<td class="tdrowk_center"><?=$money_g4_txt?></td>
										<td class="tdrow_center"><?=number_format($money_g4)?> 원</td>
										<td class="tdrowk_center"><?=$money_g5_txt?></td>
										<td class="tdrow_center"><?=number_format($money_g5)?> 원</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px;line-height:0px;"></div>

								<!--댑메뉴 -->
								<table border=0 cellspacing=0 cellpadding=0>
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
													법정수당
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
								<!--댑메뉴 -->
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
										<td class="tdrowk_center">기본연장</td>
										<td class="tdrow_center"><?=number_format($money_b1)?> 원</td>
										<td class="tdrowk_center">야간근로</td>
										<td class="tdrow_center"><?=number_format($money_b2)?> 원</td>
										<td class="tdrowk_center">휴일근로</td>
										<td class="tdrow_center"><?=number_format($money_b3)?> 원</td>
										<td class="tdrowk_center">연차수당</td>
										<td class="tdrow_center"><?=number_format($money_b4)?> 원</td>
										<td class="tdrowk_center"></td>
										<td class="tdrow_center"></td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px;line-height:0px;"></div>

								<!--댑메뉴 -->
								<table border=0 cellspacing=0 cellpadding=0> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
													기타수당
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
								<!--댑메뉴 -->
<?
//기타수당1
$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='e1' ";
$row_paycode = sql_fetch($sql_paycode);
$money_e1_txt = $row_paycode[name];
$money_e1_gy = $row_paycode[gy_yn];
//echo $row4[money_e1];
if($row4[money_e1] == "") {
	$row4[money_e1] = $row_paycode[calculate];
}
//기타수당2
$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='e2' ";
$row_paycode = sql_fetch($sql_paycode);
$money_e2_txt = $row_paycode[name];
$money_e2_gy = $row_paycode[gy_yn];
if($row4[money_e2] == "") {
	$row4[money_e2] = $row_paycode[calculate];
}
//기타수당3
$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='e3' ";
$row_paycode = sql_fetch($sql_paycode);
$money_e3_txt = $row_paycode[name];
$money_e3_gy = $row_paycode[gy_yn];
if($row4[money_e3] == "") {
	$row4[money_e3] = $row_paycode[calculate];
}
//기타수당4
$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='e4' ";
$row_paycode = sql_fetch($sql_paycode);
$money_e4_txt = $row_paycode[name];
$money_e4_gy = $row_paycode[gy_yn];
if($row4[money_e4] == "") {
	$row4[money_e4] = $row_paycode[calculate];
}
//기타수당5
$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='e5' ";
$row_paycode = sql_fetch($sql_paycode);
$money_e5_txt = $row_paycode[name];
$money_e5_gy = $row_paycode[gy_yn];
if($row4[money_e5] == "") {
	$row4[money_e5] = $row_paycode[calculate];
}
//기타수당6
$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='e6' ";
$row_paycode = sql_fetch($sql_paycode);
$money_e6_txt = $row_paycode[name];
$money_e6_gy = $row_paycode[gy_yn];
if($row4[money_e6] == "") {
	$row4[money_e6] = $row_paycode[calculate];
}
//기타수당7
$sql_paycode = " select * from com_paycode_list where com_code = '$code' and code='e7' ";
$row_paycode = sql_fetch($sql_paycode);
$money_e7_txt = $row_paycode[name];
$money_e7_gy = $row_paycode[gy_yn];
if($row4[money_e7] == "") {
	$row4[money_e7] = $row_paycode[calculate];
}
//기타수당8
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
//합계
$money_g_sum = $money_g1+$money_g2+$money_g3+$money_g4+$money_g5;
$money_b_sum = $money_b1+$money_b2+$money_b3+$money_b4;
$money_e_sum = $money_e1+$money_e2+$money_e3+$money_e4+$money_e5+$money_e6+$money_e7+$money_e8;
//총합계
$money_total_sum = $money_min + $money_g_sum + $money_b_sum + $money_e_sum;
?>
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
									<tr>
										<td class="tdrow_center" width="180" colspan="2">기타수당(비과세)</td>
										<td class="tdrowk_center"><?=$money_e1_txt?></td>
										<td class="tdrow_center"><?=number_format($money_e1)?> 원</td>
										<td class="tdrowk_center"><?=$money_e2_txt?></td>
										<td class="tdrow_center"><?=number_format($money_e2)?> 원</td>
										<td class="tdrowk_center"><?=$money_e3_txt?></td>
										<td class="tdrow_center"><?=number_format($money_e3)?> 원</td>
										<td class="tdrowk_center"><?=$money_e4_txt?></td>
										<td class="tdrow_center"><?=number_format($money_e4)?> 원</td>
									</tr>
									<tr>
										<td class="tdrow_center" colspan="2">기타수당(과세)</td>
										<td class="tdrowk_center"><?=$money_e5_txt?></td>
										<td class="tdrow_center"><?=number_format($money_e5)?> 원</td>
										<td class="tdrowk_center"><?=$money_e6_txt?></td>
										<td class="tdrow_center"><?=number_format($money_e6)?> 원</td>
										<td class="tdrowk_center"><?=$money_e7_txt?></td>
										<td class="tdrow_center"><?=number_format($money_e7)?> 원</td>
										<td class="tdrowk_center"><?=$money_e8_txt?></td>
										<td class="tdrow_center"><?=number_format($money_e8)?> 원</td>
									</tr>
								</table>

								<div style="height:10px;font-size:0px;line-height:0px;"></div>
								<!--댑메뉴 -->
								<table border=0 cellspacing=0 cellpadding=0>
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0>
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td>
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'>
													제수당 합계
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
								<!--댑메뉴 -->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
									<tr>
										<td class="tdrowk_center">⑤ 통상임금 합계</td>
										<td class="tdrow" valign="top">
											<?=number_format($money_g_sum)?> 원
										</td>
										<td class="tdrowk_center">⑥ 법정수당 합계</td>
										<td class="tdrow" valign="top">
											<?=number_format($money_b_sum)?> 원
										</td>
										<td class="tdrowk_center">⑦ 기타수당 합계</td>
										<td class="tdrow" valign="top">
											<?=number_format($money_e_sum)?> 원
										</td>
									</tr>
								</table>

								<div style="height:10px;font-size:0px;line-height:0px;"></div>
								<!--댑메뉴 -->
								<table border=0 cellspacing=0 cellpadding=0>
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0>
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td>
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'>
													급여 합계
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
								<!--댑메뉴 -->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
									<tr>
										<td class="tdrowk_center">⑧ 총합계</td>
										<td class="tdrow" valign="top">
											<?=number_format($money_total_sum)?> 원
										</td>
										<td class="tdrowk_center"></td>
										<td class="tdrow" valign="top" colspan="3">

										</td>
									</tr>
								</table>
							</div>
							</div>
							</div><!--프린트 영역 끝-->
<?
//권한별 링크값
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
