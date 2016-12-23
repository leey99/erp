								<table border="0" cellspacing="0" cellpadding="0"> 
									<tr>
										<td> 
											<table border="0" cellspacing="0" cellpadding="0"> 
												<tr> 
													<td><img src="images/sb_tab_on_lt.gif" alt="[" /></td> 
													<td class="Sftbutton_white" style="width:90px;text-align:center;background:url('images/sb_tab_on_bg.gif');"> 
														TM 콜수
													</td> 
													<td><img src="images/sb_tab_on_rt.gif" alt="]" /></td> 
												</tr> 
											</table> 
										</td> 
										<td width="6"></td> 
										<td valign="middle"></td> 
									</tr> 
								</table>
<?
//금월
$subject_ym = substr($subject_date, 0, 7);
$this_month_start = date($subject_ym.".01");
//$this_month_start = date("Y.m.01");
$this_month_last_day = date('t', strtotime($this_month_start));
$this_month_end = date($subject_ym).".".$this_month_last_day;
//금주
$this_today_weekday = date('w', strtotime($subject_date));
$this_today_weekday_mon = (int)$this_today_weekday - 1;
$this_today_weekday_sun = 7 - (int)$this_today_weekday;
$subject_date_arry = explode(".", $subject_date);
$subject_date_hyphen = $subject_date_arry[0]."-".$subject_date_arry[1]."-".$subject_date_arry[2];
$this_week_monday = date("Y.m.d", strtotime("-{$this_today_weekday_mon} day {$subject_date_hyphen}"));
$this_week_sunday = date("Y.m.d", strtotime("+{$this_today_weekday_sun} day {$subject_date_hyphen}"));
//echo $this_today_weekday;
//echo $this_week_sunday;
$sql_common_call = " from tm_call_count ";
$sql_common_call .=  " where mb_code='$drafter_code' and ( call_date >= '$this_month_start' and call_date <= '$this_month_end' ) ";
$sql_call = " select * $sql_common_call ";
//echo $sql_call;
$result_call = sql_query($sql_call);
?>
								<div style="height:2px;font-size:0px" class="bbtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
<script type="text/javascript">
//<![CDATA[
function cal_today() {
	var frm = document.dataForm;
	call_consult = toInt(frm['count_today_consult'].value);
	call_schedule = toInt(frm['count_today_schedule'].value);
	call_today = call_consult + call_schedule;
	getId('count_today_sum').innerHTML = call_today;
}
//]]>
</script>
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="">
									<tr>
										<td class="tdhead_center" width="90">구분</td>
										<td class="tdhead_center" width="90">상담문의</td>
										<td class="tdhead_center" width="90">방문일정</td>
										<td class="tdhead_center" width="90">합계</td>
										<td class="tdhead_center">비고</td>
									</tr>
<?
	//변수 초기화
	$count_today_consult = 0;
	$count_today_schedule = 0;
	$count_today_sum = 0;

	$count_week_consult = 0;
	$count_week_schedule = 0;
	$count_week_sum = 0;

	$count_month_consult = 0;
	$count_month_schedule = 0;
	$count_month_sum = 0;
	//리스트 출력
	for ($i=0; $row_call=mysql_fetch_assoc($result_call); $i++) {
		//금일
		if($row_call['call_date'] == $subject_date) {
			$count_today_consult = $row_call['call_consult'];
			$count_today_schedule = $row_call['call_schedule'];
			$count_today_memo = $row_call['call_memo'];
		}
		//금주
		if($row_call['call_date'] >= $this_week_monday && $row_call['call_date'] <= $this_week_sunday) {
			$count_week_consult += $row_call['call_consult'];
			$count_week_schedule += $row_call['call_schedule'];
		}
		//금월
		$count_month_consult += $row_call['call_consult'];
		$count_month_schedule += $row_call['call_schedule'];
	}
	$count_today_sum = $count_today_consult + $count_today_schedule;
	$count_week_sum = $count_week_consult + $count_week_schedule;
	$count_month_sum = $count_month_consult + $count_month_schedule;

	//입력 데이터가 0일 경우 빈칸으로 변경
	if($count_today_consult == 0) $count_today_consult = "";
	if($count_today_schedule == 0) $count_today_schedule = "";
?>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td class="ltrow1_center_h22">금일</td>
										<td class="ltrow1_center_h22">
<?
if($report_input == 1) {
?>
											<input name="count_today_consult"  type="text" class="textfm" style="width:70px;ime-mode:disabled;text-align:right;" value="<?=$count_today_consult?>" onKeyPress="only_number();" onkeyup="cal_today();" maxlength="3" />
<?
} else {
	echo $count_today_consult;
}
?>
										</td>
										<td class="ltrow1_center_h22">
<?
if($report_input == 1) {
?>
											<input name="count_today_schedule" type="text" class="textfm" style="width:70px;ime-mode:disabled;text-align:right;" value="<?=$count_today_schedule?>" onKeyPress="only_number()" onkeyup="cal_today();" maxlength="3" />
<?
} else {
	echo $count_today_schedule;
}
?>


										</td>
										<td class="ltrow1_center_h22"><span id="count_today_sum"><?=$count_today_sum?></span></td>
										<td class="ltrow1_left_h22">
<?
if($report_input == 1) {
?>
											<input name="count_today_memo" type="text" class="textfm" style="width:99%;ime-mode:active;" value="<?=$count_today_memo?>" maxlength="150" />
<?
} else {
	echo $count_today_memo;
}
?>
										</td>
									</tr>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td class="ltrow1_center_h22">금주</td>
										<td class="ltrow1_center_h22"><?=$count_week_consult?></td>
										<td class="ltrow1_center_h22"><?=$count_week_schedule?></td>
										<td class="ltrow1_center_h22"><?=$count_week_sum?></td>
										<td class="ltrow1_left_h22" style=""><?=$this_week_monday." ~ ".$this_week_sunday.""?></td>
									</tr>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td class="ltrow1_center_h22">금월</td>
										<td class="ltrow1_center_h22"><?=$count_month_consult?></td>
										<td class="ltrow1_center_h22"><?=$count_month_schedule?></td>
										<td class="ltrow1_center_h22"><?=$count_month_sum?></td>
										<td class="ltrow1_left_h22" style=""><?=$this_month_start." ~ ".$this_month_end.""?></td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px"></div>