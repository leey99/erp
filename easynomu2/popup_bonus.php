<?
$mode = "popup";
include_once("./_common.php");
//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}
$colspan = 11;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<TITLE>상여금 조회</TITLE>
<link rel="stylesheet" type="text/css" href="./css/style.css" />
<link rel="stylesheet" type="text/css" href="./css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
<SCRIPT type=text/javascript>
function win_close(){
	window.close();
}
</SCRIPT>
<META name=GENERATOR content="MSHTML 10.00.9200.16686"></HEAD>
<BODY style="margin:10px"><!-- width:540px, height:650px -->
<?
$sql1 = " select * from $g4[pibohum_base] where com_code='$code' and sabun='$id' ";
//echo $sql1;
$result1 = sql_query($sql1);
$row1=mysql_fetch_array($result1);
$sql2 = " select * from pibohum_base_opt where com_code='$code' and sabun='$id' ";
$result2 = sql_query($sql2);
$row2=mysql_fetch_array($result2);
$sql4 = " select * from pibohum_base_opt2 where com_code='$code' and sabun='$id' ";
$result4 = sql_query($sql4);
$row4=mysql_fetch_array($result4);
?>
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

								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<col width="11%">
									<col width="23%">
									<col width="12%">
									<col width="20%">
									<col width="10%">
									<col width="24%">
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">성명<font color="red"></font></td>
										<td nowrap class="tdrow">
											<?=$row1[name]?>
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">주민등록번호<font color="red"></font></td>
										<td nowrap class="tdrow">
											<?
											$jumin_no = explode("-",$row1[jumin_no]);
											?>

											<?=$jumin_no[0]?>-<?=$jumin_no[1]?>
										</td>
										<td nowrap class="tdrowk" rowspan="3">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">증명사진
										</td>
										<td nowrap class="tdrow" rowspan="3">
											<?
												//증명사진
												if($row2[pic]) {
													$pic = "./files/images/$row1[com_code]_$row1[sabun].jpg";
												} else {
													$pic = "./images/blank_pic.gif";
												}
											?>

											<img src="<?=$pic?>" width="90" height="90" style="margin-bottom:2px"><br>
											
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">입사일<font color="red"></font></td>
										<td nowrap class="tdrow">
											<?=$row1[in_day]?>
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">퇴사일</td>
										<td nowrap class="tdrow">
											<?=$row1[out_day]?>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">주소</td>
										<td nowrap class="tdrow" colspan="3">
											<?
											$adr_zip = explode("-",$row1[w_postno]);
											?>
											<div>
												<?=$adr_zip[0]?>-<?=$adr_zip[1]?>
											</div>
											<?=$row1[w_juso]?>
											<br>
											<?=$row2[w_juso2]?>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">이메일</td>
										<td nowrap class="tdrow">
											<?=$row2[emp_email]?>
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">휴대폰</td>
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

											<?=$emp_cel[0]?>-<?=$emp_cel[1]?><?=$emp_cel[2]?>
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">전화번호</td>
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

											<?=$add_tel[0]?>-<?=$add_tel[1]?><?=$add_tel[2]?>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">직종</td>
										<td nowrap class="tdrow" colspan="5">
											<?=$row2[jikjong_code]?> -
											<?=$row2[jikjong]?>
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
													상여금정보
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
										<td class="tdrowk" width="90">지급시기1</td>
										<td class="tdrowk" width="90">지급시기2</td>
										<td class="tdrowk" width="90">지급시기3</td>
										<td class="tdrowk" width="90">지급시기4</td>
										<td class="tdrowk" width="90">지급시기5</td>
										<td class="tdrowk" width="90">지급시기6</td>
									</tr>
									<tr>
										<td class="tdrowk" style="padding:5px">명칭</td>
										<td class="tdrow">
											<?
											if($row4[bonus_standard] == "1") echo "기본급";
											else if($row4[bonus_standard] == "2") echo "결정임금";
											else if($row4[bonus_standard] == "3") echo "통상임금";
											else if($row4[bonus_standard] == "4") echo "총급여";
											if($check_bonus_money_yn == "Y") echo number_format($bonus_money);
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
<?
for($i=0;$i<6;$i++) {
	$k = $i + 1;
	$sql = " select * from pibohum_base_bonus where com_code='$code' and sabun='$id' and bonus_time='$k' ";
	$result = sql_query($sql);
	$row = mysql_fetch_array($result);
	$bonus_day[$i] = $row[bonus_day];
	$bonus_pay[$i] = $row[pay];
}
?>
									<tr>
										<td class="tdrowk">지급액</td>
										<td class="tdrow"></td>
										<td class="tdrow"><?=$bonus_pay[0]?></td>
										<td class="tdrow"><?=$bonus_pay[1]?></td>
										<td class="tdrow"><?=$bonus_pay[2]?></td>
										<td class="tdrow"><?=$bonus_pay[3]?></td>
										<td class="tdrow"><?=$bonus_pay[4]?></td>
										<td class="tdrow"><?=$bonus_pay[5]?></td>
									</tr>
									<tr>
										<td class="tdrowk">지급일자</td>
										<td class="tdrow"></td>
										<td class="tdrow"><?=$bonus_day[0]?></td>
										<td class="tdrow"><?=$bonus_day[1]?></td>
										<td class="tdrow"><?=$bonus_day[2]?></td>
										<td class="tdrow"><?=$bonus_day[3]?></td>
										<td class="tdrow"><?=$bonus_day[4]?></td>
										<td class="tdrow"><?=$bonus_day[5]?></td>
									</tr>
								</table>

<P align="center"><A onclick="win_close();event.returnValue = false;" href="#"><IMG alt=닫기 src="./popup/images/btn_close.gif"></A></P>
<DIV style="HEIGHT: 10px"></DIV>
</BODY>
</HTML>
