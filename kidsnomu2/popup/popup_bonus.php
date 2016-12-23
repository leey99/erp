<?
$mode = "popup";
$member['mb_id'] = "test";
include_once("./_common.php");

$sql_common = " from $g4[com_list_gy] ";

$sql_search = " where biz_no='$comp_bznb' ";

$sub_title = "업종코드";
$g4[title] = $sub_title." : 팝업 : 이지노무";

$sql = " select *
          $sql_common
          $sql_search
          $sql_order ";

//echo $sql;
$result = sql_query($sql);

$colspan = 11;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<!-- saved from url=(0096)http://www.4insure.or.kr/ins4/ptl/ptcp/clnt/popup/ClntCommPopupSrchP.do -->
<HTML xmlns="http://www.w3.org/1999/xhtml"><HEAD><META content="IE=7.0000" 
http-equiv="X-UA-Compatible">
<TITLE>상여금 조회</TITLE>
<META content="text/html; charset=ks_c_5601-1987" http-equiv=Content-Type>
<META content="IE=7 http-equiv=X-UA-Compatible">
<META content="text/css http-equiv=Content-Style-Type">
<link rel="stylesheet" type="text/css" href="../css/style.css" />
<link rel="stylesheet" type="text/css" href="../css/style_admin.css">
<SCRIPT type=text/javascript>
function win_close(){
	window.close();
}
</SCRIPT>
<META name=GENERATOR content="MSHTML 10.00.9200.16686"></HEAD>
<BODY onload=""><!-- width:540px, height:650px -->

<?
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
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<col width="12%">
									<col width="">
									<tr>
									<tr>
										<td class="tdrowk_center">상여금</td>
										<td class="tdrow">
											<select name="bonus_standard" class="selectfm">
												<option value="1" <? if($row4[bonus_standard] == "1") echo "selected"; ?> >기본급</option>
												<option value="2" <? if($row4[bonus_standard] == "2") echo "selected"; ?> >결정금액</option>
												<option value="3" <? if($row4[bonus_standard] == "3") echo "selected"; ?> >통상급여</option>
												<option value="4" <? if($row4[bonus_standard] == "4") echo "selected"; ?> >총급여</option>
											</select>
											<input name="bonus_percent" type="text" class="textfm" style="width:40px;ime-mode:disabled;" value="<?=$row4[bonus_percent]?>" maxlength="3" onKeyPress="onlyNumber();">%
<?
$bonus_array = explode(",",$row4[bonus_time]);
if($bonus_array[0] == 1) $bonus_chk1 = "checked";
if($bonus_array[1] == 1) $bonus_chk2 = "checked";
if($bonus_array[2] == 1) $bonus_chk3 = "checked";
if($bonus_array[3] == 1) $bonus_chk4 = "checked";
if($bonus_array[4] == 1) $bonus_chk5 = "checked";
if($bonus_array[5] == 1) $bonus_chk6 = "checked";
if($bonus_array[6] == 1) $bonus_chk7 = "checked";
if($bonus_array[7] == 1) $bonus_chk8 = "checked";
if($bonus_array[8] == 1) $bonus_chk9 = "checked";
if($bonus_array[9] == 1) $bonus_chk10 = "checked";
if($bonus_array[10] == 1) $bonus_chk11 = "checked";
if($bonus_array[11] == 1) $bonus_chk12 = "checked";
if($bonus_array[12] == 1) $bonus_chk13 = "checked";
if($bonus_array[13] == 1) $bonus_chk14 = "checked";
if($bonus_array[14] == 1) $bonus_chk15 = "checked";
if($bonus_array[15] == 1) $bonus_chk16 = "checked";
?>
											<input type="checkbox" name="bonus[0]" value="1" class="checkbox" <?=$bonus_chk1?>>1월
											<input type="checkbox" name="bonus[1]" value="1" class="checkbox" <?=$bonus_chk2?>>2월
											<input type="checkbox" name="bonus[2]" value="1" class="checkbox" <?=$bonus_chk3?>>3월
											<input type="checkbox" name="bonus[3]" value="1" class="checkbox" <?=$bonus_chk4?>>4월
											<input type="checkbox" name="bonus[4]" value="1" class="checkbox" <?=$bonus_chk5?>>5월
											<input type="checkbox" name="bonus[5]" value="1" class="checkbox" <?=$bonus_chk6?>>6월
											<input type="checkbox" name="bonus[6]" value="1" class="checkbox" <?=$bonus_chk7?>>7월
											<input type="checkbox" name="bonus[7]" value="1" class="checkbox" <?=$bonus_chk8?>>8월
<br>
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
											<input type="checkbox" name="bonus[8]" value="1" class="checkbox" <?=$bonus_chk9?>>9월
											<input type="checkbox" name="bonus[9]" value="1" class="checkbox" <?=$bonus_chk10?>>10월
											<input type="checkbox" name="bonus[10]" value="1" class="checkbox" <?=$bonus_chk11?>>11월
											<input type="checkbox" name="bonus[11]" value="1" class="checkbox" <?=$bonus_chk12?>>12월
											<input type="checkbox" name="bonus[12]" value="1" class="checkbox" <?=$bonus_chk13?>>설
											<input type="checkbox" name="bonus[13]" value="1" class="checkbox" <?=$bonus_chk14?>>추석
											<input type="checkbox" name="bonus[14]" value="1" class="checkbox" <?=$bonus_chk15?>>하기휴가
											<input type="checkbox" name="bonus[15]" value="1" class="checkbox" <?=$bonus_chk16?>>연말
										</td>
									</tr>
								</table>



<P class=close><A onclick="win_close();event.returnValue = false;" href="#"><IMG alt=닫기 src="images/btn_close.gif"></A></P>
<DIV style="HEIGHT: 10px"></DIV></DIV></DIV></BODY></HTML>
