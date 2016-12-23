<?
$sub_menu = "400100";
include_once("./_common.php");

$sql_common = " from $g4[pibohum_base] ";

$sub_title = "급여반영";
$g4[title] = $sub_title." : 급여관리 : 이지노무";

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

							<!--댑메뉴 -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
												직원정보
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

							<!--검색 -->
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
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">성명</td>
									<td nowrap class="tdrow">
										<?=$row1[name]?>
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">주민등록번호</td>
									<td nowrap class="tdrow">
										<?=$row1[jumin_no]?>
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">입사일</td>
									<td nowrap class="tdrow">
										<?=$row1[in_day]?>
									</td>
									<td nowrap class="tdrowk">
										<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">유형
									</td>
									<td nowrap class="tdrow">
<?
if($row2[pay_gbn] == "") echo "";
else if($row2[pay_gbn] == "1") echo "월급제";
else if($row2[pay_gbn] == "2") echo "시급제";
else if($row2[pay_gbn] == "3") echo "복합근무";
?>
									</td>
								</tr>
								<tr>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">직위</td>
									<td nowrap class="tdrow">
<?
$sql_position = " select * from com_code_list where code='$row2[position]' ";
$result_position = sql_query($sql_position);
$row_position=mysql_fetch_array($result_position);
echo $row_position[name];
?>
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">최종학력</td>
									<td nowrap class="tdrow">
<?
$sql_step = " select * from com_code_list where code='$row2[step]' ";
$result_step = sql_query($sql_step);
$row_step=mysql_fetch_array($result_step);
echo $row_step[name];
?>
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">근속호봉</td>
									<td nowrap class="tdrow">
										<?=$row2[pay_step]?>
									</td>
									<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">채용형태</td>
									<td nowrap class="tdrow">
<?
if($row1[work_form] == "") echo "";
else if($row1[work_form] == "1") echo "정규직";
else if($row1[work_form] == "2") echo "계약직";
else if($row1[work_form] == "3") echo "일용직";
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
									<td class="tdrowk_center">유형</td>
									<td class="tdrow">
										<input type="radio" name="pay_gbn" value="01" onclick="displayPayGbn();checkDocNo();" checked >월급제
										<input type="radio" name="pay_gbn" value="02" onclick="displayPayGbn();checkDocNo();">시급제
										<input type="radio" name="pay_gbn" value="04" onclick="displayPayGbn();checkDocNo();">복합근무
									</td>
									<td class="tdrowk_center">주근로시간</td>
									<td class="tdrow">
										<input type="radio" name="work_gbn" value="A" onclick="">주40시간
										<input type="radio" name="work_gbn" value="B" onclick="" checked >주44시간
									</td>
									<td class="tdrowk_center">주간 근로일</td>
									<td class="tdrow">
										<input name="workday_month" type="hidden" value="20">
										<span id="workday_month_text" style="display:;">
<?
if($row_com_opt[workday_month] == 20) {
$workhour_day_d = 8;
echo "5일근로";
} else if($row_com_opt[workday_month] == 24) {
$workhour_day_d = 8;
echo "6일근로";
}
?>
(사업장관리에서 변경가능)
										</span>
										<select id="workday_week" name="workday_week" class="selectfm" style="display:none;" onChange="changeWorkDayWeek();">
											<option value="">주간근로일 선택</option>
											<option value="1" >1일근로</option>
											<option value="2" >2일근로</option>
											<option value="3" >3일근로</option>
											<option value="4" >4일근로</option>
											<option value="5" selected>5일근로</option>
											<option value="6" >6일근로</option>
											<option value="7" >7일근로</option>
										</select>
									</td>
								</tr>
								<tr>
									<td class="tdrowk_center">연봉</td>
									<td class="tdrow">
										<input size="10" type="text" class="textfm" name="pay_year" id="pay_year" value="18660720" />
									</td>
									<td class="tdrowk_center">결정임금</td>
									<td class="tdrow">
										<input size="10" type="text" class="textfm" name="pay_month" id="pay_month" value="1555060"/>
									</td>
									<td class="tdrowk_center">상여금</td>
									<td class="tdrow">
										<select name="bonus" style="width:70px">
											<option value='0' >0%</option><option value='100' >100%</option><option value='200' selected>200%</option><option value='300' >300%</option><option value='400' >400%</option><option value='500' >500%</option><option value='600' >600%</option><option value='700' >700%</option><option value='800' >800%</option><option value='900' >900%</option><option value='1000' >1000%</option><option value='1100' >1100%</option><option value='1200' >1200%</option>				</select>
											<select name="bonus_n" style="width:100px">
											<option value='6,12' selected>2 회분할</option>
											<option value='3,6,9,12' >4 회분할</option>
											<option value='2,4,6,8,10,12' >6 회분할</option>
											<option value='1,2,3,4,5,6,7,8,9,10,11,12' >12 회분할</option>
										</select>
									</td>
								</tr>
								<tr>
									<td class="tdrowk_center">직위</td>
									<td class="tdrow">
										<select name="position">
											<option value="">선택</option>
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
									<td class="tdrowk_center">호봉</td>
									<td class="tdrow">
										<select name="position">
											<option value="">선택</option>
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
									<td class="tdrowk_center">퇴직금</td>
									<td class="tdrow">
										<select name="end_pay" style="width:100px">
											<option value='통상임금' selected>통상임금</option>
											<option value='결정임금' >결정임금</option>
										</select>
									</td>
								</tr>
							</table>
							<!--사원/급여정보 입력-->
				

							<div style="height:2px;font-size:0px;line-height:0px;"></div>


							<!-- 월급제 / 복합근무 -->
							<form name="formSalary" id="formSalary" style="display:;">
								<input type="hidden" name="money_month" value="0"><!-- 기본(월)급 -->
								<input type="hidden" name="money_hour" value="4860"><!-- 기준시급 -->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
									<tr>
										<td class="tdrowk_center">1일 소정근로시간</td>
										<td class="tdrow_center"><input name="workhour_day_d" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="<?=$workhour_day_d?>" maxlength="10" onblur="setWorkHour('base')"> 시간</td>
										<td class="tdrowk_center">근로시간 수동입력</td>
										<td class="tdrow" colspan="3">
											<input type="checkbox" name="check_worktime_yn" value="Y"  onClick="checkWorkTimeYn()"> 1개월 근로시간을 수동으로 입력
										</td>
									</tr>
									<tr>
										<td class="tdrowk_center">1주 소정근로시간</td>
										<td class="tdrow_center"><input name="workhour_day_w" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="0" maxlength="10" onblur="//setWorkHour('day')" readonly> 시간</td>
										<td class="tdrowk_center">1개월 소정근로시간</td>
										<td class="tdrow">
											<input name="workhour_day" type="text" class="textfm5" style="width:40;ime-mode:disabled;" value="24" maxlength="10" onblur="setWorkHour()" readonly>시간 (주휴포함)
										</td>
										<td class="tdrowk_center">기본급</td>
										<td class="tdrow_center">
											<input name="money_base" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="" maxlength="10" readonly> 원
										</td>
									</tr>
									<tr>
										<td class="tdrowk_center">1주 연장근로시간</td>
										<td class="tdrow_center"><input name="workhour_ext_w" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="0" maxlength="10" onblur="setWorkHour('ext')"> 시간</td>
										<td class="tdrowk_center">1개월 연장근로시간</td>
										<td class="tdrow_center">
											<input name="workhour_ext" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="0" maxlength="10" onblur="setWorkHour()" readonly> 시간
										</td>
										<td class="tdrowk_center">연장근로수당</td>
										<td class="tdrow_center">
											<input name="money_ext" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="" maxlength="10" readonly> 원
										</td>
									</tr>
									<tr>
										<td class="tdrowk_center">1주 휴일근로시간</td>
										<td class="tdrow_center"><input name="workhour_hday_w" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="0" maxlength="10" onblur="setWorkHour('hday')"> 시간</td>
										<td class="tdrowk_center">1개월 휴일근로시간</td>
										<td class="tdrow_center">
											<input name="workhour_hday" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="0" maxlength="10" onblur="setWorkHour()" readonly> 시간
										</td>
										<td class="tdrowk_center">휴일근로수당</td>
										<td class="tdrow_center">
											<input name="money_hday" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="" maxlength="10" readonly> 원
										</td>
									</tr>
									<tr>
										<td class="tdrowk_center">1주 야간근로시간</td>
										<td class="tdrow_center">
											<input name="workhour_night_w" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="0" maxlength="10" onblur="setWorkHour('night')"> 시간
										</td>
										<td class="tdrowk_center">1개월 야간근로시간</td>
										<td class="tdrow_center">
											<input name="workhour_night" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="0" maxlength="10" onblur="setWorkHour()" readonly> 시간
										</td>
										<td class="tdrowk_center">야간근로수당</td>
										<td class="tdrow_center">
											<input name="money_night" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="" maxlength="10" readonly> 원
										</td>
									</tr>
									<tr>
										<td class="tdrowk_center">1주 총 근로시간</td>
										<td class="tdrow_center"><input name="workhour_total_w" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="0" maxlength="10" readonly> 시간</td>
										<td class="tdrowk_center">1개월 총 근로시간</td>
										<td class="tdrow_center"><input name="workhour_total" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="0" maxlength="10" readonly> 시간</td>
										<td class="tdrow_center" colspan="2"></td>
									</tr>
									<tr>
										<td class="tdrowk_center">연차수당 포함여부</td>
										<td class="tdrow_center">
											<select name="money_year_yn" class="selectfm" onChange="changeMoneyYearYn();setWorkHour();">
												<option value=""></option>
												<option value="Y" >포함</option>
												<option value="N" >미포함</option>
											</select>
										</td>
										<td class="tdrowk_center">연차휴가 시간</td>
										<td class="tdrow_center">
											<input name="workhour_year" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="" maxlength="10" readonly> 시간
										</td>
										<td class="tdrowk_center">연차수당</td>
										<td class="tdrow_center">
											<input name="money_year" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="0" maxlength="10" readonly> 원
										</td>
									</tr>
								</table>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>

								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
									<tr>
										<td class="tdrowk_center"><b>※ 근로계약서 근로시간</b></td>
										<td colspan="3" bgcolor="white" style="padding-left:2px;"> <b> = 소정근로시간 + 연장근로시간 + 휴일근로시간</b> </td>
									</tr>
									<tr>
										<td class="tdrowk_center">1주 총 근로시간</td>
										<td class="tdrow_center"><input name="workhour_total2_w" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="" maxlength="10" readonly> 시간</td>
										<td class="tdrowk_center">1개월 총 근로시간</td>
										<td class="tdrow_center"><input name="workhour_total2" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="" maxlength="10" readonly> 시간</td>
									</tr>
								</table>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>

								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
									<tr>
										<td class="tdrowk_center"><b>※ 1개월 가산근로시간</b></td>
										<td colspan="3" bgcolor="white" style="padding-left:2px;"> 
											<div id="workhour_total3_text">
												<b> = 소정근로시간 + 연장근로시간*1.5 + 휴일근로시간*1.5 + 야간근로시간*0.5 </b> 
											</div>
										</td>
									</tr>
									<tr>
										<td class="tdrowk_center">1주 총 근로시간</td>
										<td class="tdrow_center"><input name="workhour_total3_w" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="" maxlength="10" readonly> 시간</td>
										<td class="tdrowk_center">1개월 총 근로시간</td>
										<td class="tdrow_center"><input name="workhour_total3" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="" maxlength="10" readonly> 시간</td>
									</tr>
									<tr>
										<td class="tdrowk_center"><b>최소임금(1개월근로시간*4,860)</b></td>
										<td class="tdrow_center"> 
											<input name="money_min" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="0" maxlength="10" readonly> 원 
											<font color=white>..</font>
										</td>
										<td class="tdrowk_center"> 
											<b>최저임금</b> 
										</td>
										<td class="tdrow_center"> 
											<input name="money_min_time" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="0" maxlength="10" readonly> 원 
											<font color=white>..</font>
										</td>
									</tr>
								</table>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>

								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
									<tr>
										<td class="tdrowk_center">총지급액</td>
										<td class="tdrowk_center" colspan="2">고정성수당</td>
										<td class="tdrowk_center" colspan="2">비과세수당</td>
										<td class="tdrowk_center">기본급 + 법정수당</td>
									</tr>
									<tr>
										<td class="tdrow_center" rowspan="3"><input name="money_month_base" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="" maxlength="10" onblur="setWorkHour();"> 원</td>
										<td class="tdrowk_center">직책수당</td>
										<td class="tdrow_center"><input name="money_g1" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="0" maxlength="10" onblur="setWorkHour();"> 원</td>
										<td class="tdrowk_center">식대</td>
										<td class="tdrow_center"><input name="money_b1" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="0" maxlength="10" onblur="setWorkHour();"> 원</td>
										<td class="tdrow_center" rowspan="3"><input name="money_month" type="text" class="textfm" style="width:60;background:bbbbbb;" value="0" maxlength="10" readonly> 원</td>
									</tr>
									<tr>
										<td class="tdrowk_center">자격수당</td>
										<td class="tdrow_center"><input name="money_g2" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="0" maxlength="10" onblur="setWorkHour();"> 원</td>
										<td class="tdrowk_center">자가운전보고비</td>
										<td class="tdrow_center"><input name="money_b2" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="0" maxlength="10" onblur="setWorkHour();"> 원</td>
									</tr>
									<tr>
										<td class="tdrowk_center">-</td>
										<td class="tdrow_center"><input name="money_g3" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="0" maxlength="10" onblur="setWorkHour();"> 원</td>
										<td class="tdrowk_center">-</td>
										<td class="tdrow_center"><input name="money_b3" type="text" class="textfm" style="width:60;ime-mode:disabled;" value="0" maxlength="10" onblur="setWorkHour();"> 원</td>
									</tr>
								</table>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>

								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
									<tr>
										<td class="tdrowk_center" width="230"><b>※ 통상임금 (시간급)</b></td>
										<td colspan="3" bgcolor="white" style="padding-left:2px;"> <b> = [ (기본급+법정수당) + 고정성수당 ] / 1개월 가산근로시간 </b> </td>
									</tr>
									<tr>
										<td class="tdrowk_center">통상임금 (시간급)</td>
										<td colspan="3" bgcolor="white" style="padding-left:65px;"> 
											<input name="money_hour_ts_view" type="text" class="textfm5" style="width:60;ime-mode:disabled;" value="" maxlength="10" readonly> 원
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
												<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="javascript:checkData();" target="">급여저장</a></td>
												<td><img src=images/btn_rt.gif></td>
											 <td width=2></td>
											</tr>
										</table>
										<table border=0 cellpadding=0 cellspacing=0 style="display: inline;">
											<tr>
												<td width=2></td>
												<td><img src=images/btn_lt.gif></td>
												<td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="pay_list.php?page=<?=$page?>" target="">목 록</a></td>
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
