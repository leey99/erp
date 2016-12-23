								<!--리스트 -->
								<table width="100%" border="0" cellpadding="0" cellspacing="0" class="bgtable" style="table-layout:fixed;">
									<tr>
										<td width="200" height="84" valign="top">
											<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
												<col width="11%">
												<col width="">
												<col width="34%">
												<col width="25%">
												<tr>
													<td nowrap height="85" align="center" style="background-color:rgb(226, 226, 226);">자<br />동<br />입<br />력</td>
													<td nowrap class="tdhead_center">이름</td>
													<td nowrap class="tdhead_center">입사일</td>
													<td nowrap class="tdhead_center">직위</td>
												</tr>
											</table>
										</td>
										<td nowrap class="tdhead_center" valign="top">
<?
//통상임금
$sql_g = " select * from com_paycode_list where com_code = '$com_code' and item='trade' ";
//echo $sql_g;
$result_g = sql_query($sql_g);
for($i=0; $row_g=sql_fetch_array($result_g); $i++) {
	$g_code = $row_g[code];
	$money_g_txt[$g_code] = $row_g[name];
	//echo $g_code;
}
//기타수당
$sql_e = " select * from com_paycode_list where com_code = '$com_code' and item='privilege' ";
$result_e = sql_query($sql_e);
for($i=0; $row_e=sql_fetch_array($result_e); $i++) {
	$e_code = $row_e[code];
	$money_e_txt[$e_code] = $row_e[name];
	//임금포함여부
	$money_e_gy[$e_code] = $row_e[gy_yn];
	//과세포함여부
	$money_e_income[$e_code] = $row_e[income];
}
$pay_list_width = 3550;
$money_month_text = "결정임금";
?>
											<div id="spanTop" style="width:100%;overflow:hidden">
												<table cellpadding=0 cellspacing=0 border=0>
													<tr>
														<td>  
															<table width="<?=$pay_list_width?>" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:;">
																<tr>
																	<td class="tdhead_center" rowspan="4" width="45">유형</td>
																	<td class="tdhead_center" colspan="10">결정급여 및 근로시간(월) </td>
																	<td class="tdhead_center" rowspan="4" width="18"></td>
																	<td class="tdhead_center" colspan="7">기본급 및 제수당 </td>
																	<td class="tdhead_center" rowspan="4" width="18"></td>
																	<td class="tdhead_center" colspan="5">기본급 및 제수당 </td>
																	<td class="tdhead_center" rowspan="4" width="18"></td>
																	<td class="tdhead_center" colspan="10">기본급 및 제수당 </td>
																	<td class="tdhead_center" rowspan="4" width="18"></td>
																	<td class="tdhead_center" colspan="2"> </td>
																	<td class="tdhead_center" colspan="8">공제액</td>
																	<td class="tdhead_center" rowspan="4" width="74">공제후<br>지급액 </td>
																	<td class="tdhead_center" rowspan="4" width="18"></td>
																</tr>
																<tr>
																	<td class="tdhead_center" rowspan="3" width="66"><?=$money_month_text?></td>
																	<td class="tdhead_center" colspan="4">근로시간</td>
																	<td class="tdhead_center" colspan="4">근태공제시간</td>
																	<td class="tdhead_center" rowspan="3" width="63">임금산출<br>총시간 </td>

																	<td class="tdhead_center" colspan="7">기본월급</td>
																	<td class="tdhead_center" colspan="5">제수당</td>
																	<td class="tdhead_center" colspan="8">제수당</td>
																	<td class="tdhead_center" colspan="2">기타</td>
																	<td class="tdhead_center" rowspan="3" width="68">임금계</td>
																	<td class="tdhead_center" rowspan="3" width="68">과세소득</td>
																	<td class="tdhead_center" colspan="4"><input type="checkbox" name="manual_4insure" <?=$check_manual_4insure?> onclick="check_manual(this);" value="1" title="수동입력" style="vertical-align:middle;"> 4대보험</td>
																	<td class="tdhead_center" colspan="2"><input type="checkbox" name="manual_tax" <?=$check_manual_tax?> onclick="check_manual(this);" value="1" title="수동입력" style="vertical-align:middle;"> 세금</td>
																	<td class="tdhead_center" colspan="1">기타</td>
																	<td class="tdhead_center" rowspan="3" width="72">공제계</td>
																</tr>
																<tr>
																	<td class="tdhead_center" rowspan="2" width="63">소정<br>근로시간</td>
																	<td class="tdhead_center" rowspan="2" width="63">연장<br>근로시간</td>
																	<td class="tdhead_center" rowspan="2" width="63">야간<br>근로시간</td>
																	<td class="tdhead_center" rowspan="2" width="63">휴일<br>근로시간</td>

																	<td class="tdhead_center" rowspan="2" width="64">지각</td>
																	<td class="tdhead_center" rowspan="2" width="64">조퇴</td>
																	<td class="tdhead_center" rowspan="2" width="64">외출</td>
																	<td class="tdhead_center" rowspan="2" width="64">결근</td>

																	<td class="tdhead_center" rowspan="2" width="77">통상시급</td>
																	<td class="tdhead_center" rowspan="2" width="78">기본시급</td>
																	<td class="tdhead_center" rowspan="2" width="102"><input type="checkbox" name="money_month_fix" <?=$check_money_month_fix?> onclick="money_month_fix_ft(this);" value="Y" title="수동입력"> 기본급</td>
																	<td class="tdhead_center" colspan="4">법정수당(과세)</td>
																	<td class="tdhead_center" colspan="5">통상임금수당</td>
																	<td class="tdhead_center" colspan="4">비과세</td>
																	<td class="tdhead_center" colspan="4">과세</td>
<?
//아이좋아어린이집
if($com_code == "20368") $etc_text = "환급/소급";
else $etc_text = "가불";
//매년 2월 연말정산 환급분으로 교체 160218
if($search_month == 2) $minus_text = "연말정산";
else $minus_text = "기타공제";
?>
																	<td class="tdhead_center" rowspan="2" width="71"><?=$etc_text?></td>
																	<td class="tdhead_center" rowspan="2" width="71">근태공제</td>

																	<td class="tdhead_center" rowspan="2" width="57">국민연금</td>
																	<td class="tdhead_center" rowspan="2" width="57">건강보험</td>
																	<td class="tdhead_center" rowspan="2" width="57">장기요양</td>
																	<td class="tdhead_center" rowspan="2" width="57">고용보험</td>
																	<td class="tdhead_center" rowspan="2" width="57">소득세</td>
																	<td class="tdhead_center" rowspan="2" width="57">주민세</td>
																	<td class="tdhead_center" rowspan="2" width="60"><?=$minus_text?></td>
																</tr>
																<tr>
																	<td class="tdhead_center" width="110"><input type="checkbox" name="manual_ext" <?=$check_manual_ext?> onclick="check_manual(this);" value="1" title="수동입력" style="vertical-align:middle;"> 연장근로</td>
																	<td class="tdhead_center" width="110"><input type="checkbox" name="manual_night" <?=$check_manual_night?> onclick="check_manual(this);" value="1" title="수동입력" style="vertical-align:middle;"> 야간근로</td>
																	<td class="tdhead_center" width="110"><input type="checkbox" name="manual_hday" <?=$check_manual_hday?> onclick="check_manual(this);" value="1" title="수동입력" style="vertical-align:middle;"> 휴일근로</td>
																	<td class="tdhead_center" width="101">연차수당</td>



																	<td class="tdhead_center" width="138"><input type="text" name="g1" class="textfm5" readonly  style="width:100%;" value="<?=$money_g_txt['g1']?>"></td>
																	<td class="tdhead_center" width="138"><input type="text" name="g2" class="textfm5" readonly  style="width:100%;" value="<?=$money_g_txt['g2']?>"></td>
																	<td class="tdhead_center" width="138"><input type="text" name="g3" class="textfm5" readonly  style="width:100%;" value="<?=$money_g_txt['g3']?>"></td>
																	<td class="tdhead_center" width="138"><input type="text" name="g4" class="textfm5" readonly  style="width:100%;" value="<?=$money_g_txt['g4']?>"></td>
																	<td class="tdhead_center" width="138"><input type="text" name="g5" class="textfm5" readonly  style="width:100%;" value="<?=$money_g_txt['g5']?>"></td>
																	<td class="tdhead_center" width="68"><input type="text" name="b1" class="textfm5" readonly  style="width:100%;" value="<?=$money_e_txt['e1']?>"></td>
																	<td class="tdhead_center" width="68"><input type="text" name="b2" class="textfm5" readonly  style="width:100%;" value="<?=$money_e_txt['e2']?>"></td>
																	<td class="tdhead_center" width="68"><input type="text" name="b3" class="textfm5" readonly  style="width:100%;" value="<?=$money_e_txt['e3']?>"></td>
																	<td class="tdhead_center" width="68"><input type="text" name="b4" class="textfm5" readonly  style="width:100%;" value="<?=$money_e_txt['e4']?>"></td>
																	<td class="tdhead_center" width="68"><input type="text" name="b5" class="textfm5" readonly  style="width:100%;" value="<?=$money_e_txt['e5']?>"></td>
																	<td class="tdhead_center" width="68"><input type="text" name="b6" class="textfm5" readonly  style="width:100%;" value="<?=$money_e_txt['e6']?>"></td>
																	<td class="tdhead_center" width="68"><input type="text" name="b7" class="textfm5" readonly  style="width:100%;" value="<?=$money_e_txt['e7']?>"></td>
																	<td class="tdhead_center" width="68"><input type="text" name="b8" class="textfm5" readonly  style="width:100%;" value="<?=$money_e_txt['e8']?>"></td>
																</tr>
															</table>
														</td>
														<td nowrap bgcolor=white>&nbsp; &nbsp;&nbsp; &nbsp;</td>
													</tr>
												</table>
											</div>
										</td>
									</tr>
									<tr>
										<td width="200" bgcolor="#FFFFFF">
<?
$spanMain_height = 251;
?>
											<div id="spanLeft" style="width:200px;height:<?=$spanMain_height?>px;overflow:hidden">
												<div style="display:none;">
													<input type="hidden" name="idx">
													<input type="hidden" name="pay_gbn">
													<input type="hidden" name="yyyymm">
													<input type="hidden" name="emp_name">
													<input type="hidden" name="emp_sdate">
													<input type="hidden" name="emp_pname">
													<input type="hidden" name="family_cnt">
													<input type="hidden" name="child_cnt">

													<input type="hidden" name="money_month">
													<input type="hidden" name="money_hour">
													<input type="hidden" name="money_hour_ds">
													<input type="hidden" name="money_hour_ts">

													<input type="hidden" name="workhour_day">
													<input type="hidden" name="workhour_ext">
													<input type="hidden" name="workhour_night">
													<input type="hidden" name="workhour_hday">

													<input type="hidden" name="workhour_ext_add">
													<input type="hidden" name="workhour_night_add">
													<input type="hidden" name="workhour_hday_add">

													<input type="hidden" name="workhour_late">
													<input type="hidden" name="workhour_leave">
													<input type="hidden" name="workhour_out">
													<input type="hidden" name="workhour_absence">

													<input type="hidden" name="money_time">
													<input type="hidden" name="workhour_total">

													<input type="hidden" name="week_hday">
													<input type="hidden" name="year_hday">
													<input type="hidden" name="money_base">
													<input type="hidden" name="money_ext">
													<input type="hidden" name="money_hday">
													<input type="hidden" name="money_night">
													<input type="hidden" name="money_week">
													<input type="hidden" name="money_year">

													<input type="hidden" name="money_ext_add">
													<input type="hidden" name="money_night_add">
													<input type="hidden" name="money_hday_add">

													<input type="hidden" name="money_b1">
													<input type="hidden" name="money_b2">
													<input type="hidden" name="money_b3">
													<input type="hidden" name="money_b4">
													<input type="hidden" name="money_g1">
													<input type="hidden" name="money_g2">
													<input type="hidden" name="money_g3">
													<input type="hidden" name="money_g4">
													<input type="hidden" name="money_g5">
													<input type="hidden" name="money_e1">
													<input type="hidden" name="money_e2">
													<input type="hidden" name="money_e3">
													<input type="hidden" name="money_e4">
													<input type="hidden" name="money_e5">
													<input type="hidden" name="money_e6">
													<input type="hidden" name="money_e7">
													<input type="hidden" name="money_e8">
													<!--합계포함 여부-->
													<input type="hidden" name="money_e1_gy" value="<?=$money_e_gy['e1']?>">
													<input type="hidden" name="money_e2_gy" value="<?=$money_e_gy['e2']?>">
													<input type="hidden" name="money_e3_gy" value="<?=$money_e_gy['e3']?>">
													<input type="hidden" name="money_e4_gy" value="<?=$money_e_gy['e4']?>">
													<input type="hidden" name="money_e5_gy" value="<?=$money_e_gy['e5']?>">
													<input type="hidden" name="money_e6_gy" value="<?=$money_e_gy['e6']?>">
													<input type="hidden" name="money_e7_gy" value="<?=$money_e_gy['e7']?>">
													<input type="hidden" name="money_e8_gy" value="<?=$money_e_gy['e8']?>">
													<!--과세포함 여부-->
													<input type="hidden" name="money_e1_income" value="<?=$money_e_income['e1']?>">
													<input type="hidden" name="money_e2_income" value="<?=$money_e_income['e2']?>">
													<input type="hidden" name="money_e3_income" value="<?=$money_e_income['e3']?>">
													<input type="hidden" name="money_e4_income" value="<?=$money_e_income['e4']?>">
													<input type="hidden" name="money_e5_income" value="<?=$money_e_income['e5']?>">
													<input type="hidden" name="money_e6_income" value="<?=$money_e_income['e6']?>">
													<input type="hidden" name="money_e7_income" value="<?=$money_e_income['e7']?>">
													<input type="hidden" name="money_e8_income" value="<?=$money_e_income['e8']?>">
													<!--임금총액-->
													<input type="hidden" name="money_total">
													<input type="hidden" name="money_for_tax">
													<input type="hidden" name="money_yun">
													<input type="hidden" name="money_health">
													<input type="hidden" name="money_yoyang">
													<input type="hidden" name="money_goyong">
													<input type="hidden" name="tax_so">
													<input type="hidden" name="tax_jumin">
													<input type="hidden" name="minus">
													<input type="hidden" name="minus2">
													<input type="hidden" name="etc">
													<input type="hidden" name="etc2">
													<input type="hidden" name="money_gongje">
													<input type="hidden" name="money_result">
													<input type="hidden" name="workhour_year">
													<!--추가 필드-->
													<input type="hidden" name="money_ng4">
													<input type="hidden" name="money_ng5">
													<input type="hidden" name="advance_pay">
													<input type="hidden" name="check_money_min_yn">
													<input type="hidden" name="check_money_b_yn">
													<input type="hidden" name="check_money_so_yn">
													<input type="hidden" name="money_hour_ms">
													<input type="hidden" name="check_business_yn">
													<!--4대보험여부-->
													<input type="hidden" name="isgy">
													<input type="hidden" name="issj">
													<input type="hidden" name="iskm">
													<input type="hidden" name="isgg">
													<!--두리누리-->
													<input type="hidden" name="durunuri">
												</div>
												<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
													<col width="11%">
													<col width="">
													<col width="34%">
													<col width="25%">
													<?
													// 리스트 출력
													for ($i=0; $row=sql_fetch_array($result); $i++) {
														//$page
														//$total_page
														//$rows
														$no = $total_count - $i - ($rows*($page-1));
														$list = $i%2;
														$code = $row[com_code];
														// 사업장명 : 사업장코드
														$sql_com = " select com_name from $g4[com_list_gy] where com_code = '$row[com_code]' ";
														$row_com = sql_fetch($sql_com);
														$com_name = $row_com[com_name];
														$com_name = cut_str($com_name, 21, "..");
														$name = cut_str($row[name], 6, "..");

														//사원정보 추가 DB
														$sql2 = " select * from pibohum_base_opt where com_code='$row[com_code]' and sabun='$row[sabun]' ";
														$result2 = sql_query($sql2);
														$row2=mysql_fetch_array($result2);

														//사원정보 추가 DB 2
														$sql4 = " select * from pibohum_base_opt2 where com_code='$row[com_code]' and sabun='$row[sabun]' ";
														$result4 = sql_query($sql4);
														$row4=mysql_fetch_array($result4);

														//직위
														$sql_position = " select * from com_code_list where com_code = '$code' and code='$row2[position]' and item='position' ";
														$result_position = sql_query($sql_position);
														$row_position=mysql_fetch_array($result_position);
														$k = $i+1;

														//호봉
														$sql_step = " select * from com_code_list where com_code = '$code' and code='$row2[step]' and item='step' ";
														$result_step = sql_query($sql_step);
														$row_step=mysql_fetch_array($result_step);

														//채용형태
														if($row[work_form] == "") $work_form = "-";
														else if($row[work_form] == "1") $work_form = "정규직";
														else if($row[work_form] == "2") $work_form = "계약직";
														else if($row[work_form] == "3") $work_form = "일용직";
													?>

													<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
														<td nowrap class="ltrow1_center_h24">
															<input type="checkbox" name="idx" value="<?=$row[sabun]?>">
														</td>
<?
if($row2[pay_gbn] == "0") $pay_gbn = "월급제";
else if($row2[pay_gbn] == "1") $pay_gbn = "시급제";
else if($row2[pay_gbn] == "3") $pay_gbn = "연봉제";
if($row4[input_type] == "1") $input_type = "(A)";
else if($row4[input_type] == "2") $input_type = "(B)";
else if($row4[input_type] == "3") $input_type = "(C)";
//월 중간 입사자 일할 계산
$join_year = $search_year;
$join_month = $search_month;
$join_day = $row_com_opt['pay_calculate_day_period1'];
if($join_day < 10) $join_day = "0".$join_day;
$start_date = $join_year.".".$join_month.".".$join_day;
$end_year = $search_year;
$end_month = $search_month;
$end_day = $row_com_opt['pay_calculate_day_period2'];
if($end_day == "말") {
	$end_day = date("t",mktime(0,0,0,$end_month,1,$end_year));
} else if($end_day < 10) {
	$end_day = "0".$end_day;
}
$end_date = $end_year.".".$end_month.".".$end_day;
$in_day = $row['in_day'];
if($in_day > $start_date && $in_day <= $end_date) {
	$in_day_chk = "1";
	$in_day_color = "color:red";
	$in_day_hyphen = str_replace('.','-',$in_day);
	$start_date_hyphen = str_replace('.','-',$start_date);
	$end_date_hyphen = str_replace('.','-',$end_date);
	$in_day_var = new DateTime($in_day_hyphen);
	$end_date_var = new DateTime($end_date_hyphen);
	$date_diff_var = date_diff($in_day_var, $end_date_var);
	$work_day = ($date_diff_var->days)+1;
} else {
	$in_day_color = "";
}
?>
														<td nowrap class="ltrow1_center_h24"><b onclick="clientxy();emp_text('<?=$row[sabun]?>','<?=$row[name]?>','<?=$in_day?>','<?=$row[out_day]?>','<?=$row_position[name]?>','<?=$row2[family_cnt]?>','<?=$row4[workhour_day_w]?>','<?=$pay_gbn.$input_type?>','<?=number_format($row4['money_month_base'])?>','<?=number_format($row4['money_hour_ms'])?>','<?=number_format($row4['money_min_base'])?>');" style="cursor:pointer"><?=$name?></b></td>
														<td nowrap class="ltrow1_center_h24"><span <? if(	$in_day_chk == 1) { ?> onclick="month_middle_cal('<?=$k?>','<?=$end_day?>','<?=$work_day?>')" style="cursor:pointer;<?=$in_day_color?>" <? } ?> ><?=$in_day?></span></td>
														<td nowrap class="ltrow1_center_h24" title="<?=$row_position['name']?>"><input type="text" name="emp_pname" value="<?=$row_position[name]?>" style="width:100%;ime-mode:active;" class="textfm5" readonly onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" /></td>
													</tr>
													<?
													}
													if ($i == 0)
															echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' nowrap class=\"ltrow1_center_h22\">자료가 없습니다.</td></tr>";
													?>

												</table>
												<br>
											</div>
										</td>
										<td bgcolor="#FFFFFF" valign="top">
											<div id="spanMain" style="width:100%;height:<?=$spanMain_height?>px;overflow-x:hidden;overflow-y:auto;" onScroll="spanLeft.scrollTop = this.scrollTop; spanTop.scrollLeft = this.scrollLeft;">
												<table width="<?=$pay_list_width?>" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
													<?
													$result = sql_query($sql);
													// 리스트 출력
													for ($i=0; $row=sql_fetch_array($result); $i++) {
														//$page
														//$total_page
														//$rows

														$no = $total_count - $i - ($rows*($page-1));
														$list = $i%2;
														// 사업장명 : 사업장코드
														$sql_com = " select com_name from $g4[com_list_gy] where com_code = '$row[com_code]' ";
														$row_com = sql_fetch($sql_com);
														$com_name = $row_com['com_name'];
														$com_name = cut_str($com_name, 21, "..");
														//$name = cut_str($row[name], 6, "..");
														//근로자 성명 전체 표시 150709
														$name = $row['name'];

														//사원정보 추가 DB
														$sql2 = " select * from pibohum_base_opt where com_code='$row[com_code]' and sabun='$row[sabun]' ";
														$result2 = sql_query($sql2);
														$row2=mysql_fetch_array($result2);

														//직위
														$sql_position = " select * from com_code_list where com_code='$row[com_code]' and code='$row2[position]' and item='position' ";
														//echo $sql_position;
														$result_position = sql_query($sql_position);
														$row_position=mysql_fetch_array($result_position);
														//echo $row_position[name];
														$k = $i+1;

														//호봉
														$sql_step = " select * from com_code_list where com_code='$row[com_code]' and code='$row2[step]' and item='step' ";
														$result_step = sql_query($sql_step);
														$row_step=mysql_fetch_array($result_step);

														//채용형태
														if($row[work_form] == "") $work_form = "-";
														else if($row[work_form] == "1") $work_form = $work_form_txt[1];
														else if($row[work_form] == "2") $work_form = $work_form_txt[2];
														else if($row[work_form] == "3") $work_form = $work_form_txt[3];
														else if($row[work_form] == "4") $work_form = $work_form_txt[4];

														//급여유형
														//echo $row2[pay_gbn];
														if($row2[pay_gbn] == "0") $pay_gbn = "월급제";
														else if($row2[pay_gbn] == "1") $pay_gbn = "시급제";
														else if($row2[pay_gbn] == "2") $pay_gbn = "복합근무";
														else if($row2[pay_gbn] == "3") $pay_gbn = "연봉제";
														else if($row2[pay_gbn] == "4") $pay_gbn = "일급제";
														else $pay_gbn = "-";
														$pay_gbn_no = $row2[pay_gbn];

														//연장근로
														$sql_attendance = " select * from a4_attendance where com_code='$row[com_code]' and sabun='$row[sabun]' and att_day like '201310%' ";
														//echo $sql_attendance;
														$result_attendance = sql_query($sql_attendance);
														$row_attendance=mysql_fetch_array($result_attendance);

														//사원정보 추가 DB (급여정보)
														$sql3 = " select * from pibohum_base_opt2 where com_code='$row[com_code]' and sabun='$row[sabun]' ";
														$result3 = sql_query($sql3);
														$row3=mysql_fetch_array($result3);

														//급여관리 DB (급여반영) 년월 : 급여복사 클릭 여부 150723
														if($data == "copy") {
															$sql4 = " select * from pibohum_base_pay where com_code='$row[com_code]' and sabun='$row[sabun]' and year = '$copy_year' and month = '$copy_month' ";
														} else {
															$sql4 = " select * from pibohum_base_pay where com_code='$row[com_code]' and sabun='$row[sabun]' and year = '$search_year' and month = '$search_month' ";
														}
														//echo $sql4;
														$result4 = sql_query($sql4);
														$row4=mysql_fetch_array($result4);

														//추가연장 근로시간 초기화
														if(!$row4[w_ext_add]) $row4[w_ext_add] = "0";
														if(!$row4[w_night_add]) $row4[w_night_add] = "0";
														if(!$row4[w_hday_add]) $row4[w_hday_add] = "0";
														if(!$row3[money_month_base]) {
															$row4[w_ext_add] = "";
															$row4[w_night_add] = "";
															$row4[w_hday_add] = "";
														}
														//4대보험여부
														if($row[apply_gy] == "0") $isgy_chk = "checked";
														else $isgy_chk = "";
														if($row[apply_sj] == "0") $issj_chk = "checked";
														else $issj_chk = "";
														if($row[apply_km] == "0") $iskm_chk = "checked";
														else $iskm_chk = "";
														if($row[apply_gg] == "0") $isgg_chk = "checked"; 
														else $isgg_chk = "";
														//두리누리 지원 여부
														$durunuri = $row2[insurance];
														//국민연금 만60세 해당 사원
														$now_date = date("Ymd");
														$jumin_date = "19".substr($row[jumin_no],0,9);
														$age_cal = ( $now_date - $jumin_date ) / 10000;
														$age = (int)$age_cal;
														if($age_cal >= 60) {
															$iskm_chk = "";
														}
														//사업소득자 3.3% 소득세/주민세
														if($row['work_form'] == 4) {
															$check_business_yn = "0";
															$pay_gbn = "<span style='color:blue' title='사업소득자'>".$pay_gbn."</a>";
														}
														else $check_business_yn = "";
													?>

													<tr class="list_row_now_gr" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_gr';">
														<input type="hidden" name="pay_no" value="<?=$row[sabun]?>">
														<input type="hidden" name="cust_numb" value="98">
														<input type="hidden" name="work_numb" value="64">
														<input type="hidden" name="pay_gbn" value="<?=$pay_gbn_no?>">
														<input type="hidden" name="yyyymm" value="201311">
														<input type="hidden" name="emp_name" value="<?=$name?>">
														<input type="hidden" name="emp_sdate" value="<?=$row[in_day]?>">
														<input type="hidden" name="money_hour" value="0">
														<input type="hidden" name="week_hday" value="0">
														<input type="hidden" name="year_hday" value="0">
														<input type="hidden" name="money_week" value="">
														<input type="hidden" name="sabun[]" value="<?=$row[sabun]?>">
														<input type="hidden" name="staff_name[]" value="<?=$name?>">
														<input type="hidden" name="in_day[]" value="<?=$row[in_day]?>">
														<input type="hidden" name="out_day[]" value="<?=$row[out_day]?>">
														<input type="hidden" name="position[]" value="<?=$row2[position]?>">

														<input type="hidden" name="position_txt[]" value="<?=$row_position[name]?>">
														<input type="hidden" name="step_txt[]" value="<?=$row_step[name]?>">
														<input type="hidden" name="work_form[]" value="<?=$work_form?>">
														<input type="hidden" name="dept[]" value="<?=$row2[dept_1]?>">
														<input type="hidden" name="pay_gbn_txt[]" value="<?=$pay_gbn_txt?>">
														<input type="hidden" name="pay_gbn_<?=$i?>">

														<input type="hidden" name="family_cnt" value="<?=$row[family_cnt]?>">
														<input type="hidden" name="child_cnt" value="<?=$row[child_cnt]?>">

<?
//if($row4[money_month] == 0 || $data == "load") {
//급여 미저장, 사원급여정보 불러오기, (급여복사 && 결정임금 미등록) 150903
if(!$w_date_ok || $data == "load" || ($data == "copy" && !$row4['money_total']) ) {
	if($pay_gbn_no == 1) {
		$money_total = $row3[money_hour_ds];
		$money_hour_ds = $row3[money_hour_ds];
	} else if($pay_gbn_no == 4) {
		$money_total = $row3[money_day_base];
		$money_hour_ds = $row3[money_hour_ds];
	} else {
		$money_total = $row3[money_month_base];
		$money_hour_ds = 0;
	}
	$workhour_day = $row3[workhour_day];
	$workhour_ext = $row3[workhour_ext];
	$workhour_night = $row3[workhour_night];
	$workhour_hday = $row3[workhour_hday];
	$workhour_year = $row3[workhour_year];

	$w_ext_add = 0;
	$w_night_add = 0;
	$w_hday_add = 0;

	//근태정보
	$att_ymd = $search_year."".$search_month;
	$sql_attendance = " select * from a4_attendance where com_code='$com_code' and sabun='$row[sabun]' ";
	//echo $sql_attendance;
	$result_attendance = sql_query($sql_attendance);
	$att_rule = array();
	//근태정보 초기화
	$w_late = "";
	$w_leave = "";
	$w_out = "";
	$w_absence = "";
	for($j=0; $row_attendance=sql_fetch_array($result_attendance); $j++) {
		//적용일자
		$att_day = date('Y-m-d',strtotime($row_attendance[att_day]));
		$att_date = explode("-", $att_day);
		//echo $att_date[0];
		//해당 년도
		if($att_date[0] == $search_year && $att_date[1] == $search_month) {
			$monthday = date('md',strtotime($row_attendance[att_day]));
			$att_rule_2 = explode(":", $row_attendance[att_time2]);
			$att_rule_1 = explode(":", $row_attendance[att_time]);
			if($att_rule_2[0] < $att_rule_1[0]) {
				$att_rule_hour = (24 - $att_rule_1[0]) + $att_rule_2[0];
			} else {
				$att_rule_hour = ($att_rule_2[0] - $att_rule_1[0]);
			}
			$att_rule_min = ($att_rule_2[1] - $att_rule_1[1]);
			$att_rule_min_cal = $att_rule_min / 60;
			$att_category = $row_attendance[att_category];
			//echo $att_category;
			$att_rule[$att_category] = $att_rule_hour + $att_rule_min_cal;
			//$att_rule[$att_category] += $att_rule[$att_category];
			if($att_category == 3) $w_late += $att_rule[$att_category];
			else if($att_category == 2) $w_leave += $att_rule[$att_category];
			else if($att_category == 4) $w_out += $att_rule[$att_category];
			else if($att_category == 1) $w_absence += $att_rule[$att_category] -1;
		}
	}
	if($j == 0) {
		$w_late = "";
		$w_leave = "";
		$w_out = "";
		$w_absence = "";
	}
	$workhour_total = 0;

	$money_hour_ts = $row3[money_hour_ts];
	//기본시급
	$money_time = $row3[money_min_base];
	$money_base = $row3[money_hour_ms];

	$money_ext = $row3[money_b1];
	$money_night = $row3[money_b2];
	$money_hday = $row3[money_b3];
	$annual_paid_holiday = $row3[money_b4];

	$money_ext_add = $row4[ext_add];
	$money_night_add = $row4[night_add];
	$money_hday_add = $row4[hday_add];

	$money_g1 = $row3[money_g1];
	$money_g2 = $row3[money_g2];
	$money_g3 = $row3[money_g3];
	$money_g4 = $row3[money_g4];
	$money_g5 = $row3[money_g5];

	$money_e1 = $row3[money_e1];
	$money_e2 = $row3[money_e2];
	$money_e3 = $row3[money_e3];
	$money_e4 = $row3[money_e4];
	$money_e5 = $row3[money_e5];
	$money_e6 = $row3[money_e6];
	$money_e7 = $row3[money_e7];
	$money_e8 = $row3[money_e8];
} else {
	if($pay_gbn_no == 1) {
		$money_total = $row4[money_hour_ds];
		$money_hour_ds = $row4[money_hour_ds];
	} else {
		$money_total = $row4[money_total];
		$money_hour_ds = 0;
	}
	$workhour_day = $row4[w_day];
	$workhour_ext = $row4[w_ext];
	$workhour_night = $row4[w_night];
	$workhour_hday = $row4[w_hday];
	$workhour_year = 0;
	$w_ext_add = $row4[w_ext_add];
	$w_night_add = $row4[w_night_add];
	$w_hday_add = $row4[w_hday_add];
	$w_late = $row4[w_late];
	$w_leave = $row4[w_leave];
	$w_out = $row4[w_out];
	$w_absence = $row4[w_absence];
	$workhour_total = $row4[workhour_total];
	$money_hour_ts = $row4[money_time];
	$money_time = $row4[money_min_base];
	$money_base = $row4[money_month];
	$money_ext = $row4[ext];
	$money_night = $row4[night];
	$money_hday = $row4[hday];
	$annual_paid_holiday = $row4[annual_paid_holiday];
	$money_ext_add = $row4[ext_add];
	$money_night_add = $row4[night_add];
	$money_hday_add = $row4[hday_add];
	$money_g1 = $row4[g1];
	$money_g2 = $row4[g2];
	$money_g3 = $row4[g3];
	$money_g4 = $row4[g4];
	$money_g5 = $row4[g5];
	$money_e1 = $row4[b1];
	$money_e2 = $row4[b2];
	$money_e3 = $row4[b3];
	$money_e4 = $row4[b4];
	$money_e5 = $row4[b5];
	$money_e6 = $row4[b6];
	$money_e7 = $row4[b7];
	$money_e8 = $row4[b8];
}
//최저시급 DB 출력
if($row4[money_hour_ds] == 0) {
	$money_hour_ds = $row3[money_hour_ds];
} else {
	$money_hour_ds = $row4[money_hour_ds];
}
?>
														<input type="hidden" name="w_day_<?=$i?>">
														<input type="hidden" name="w_ext_<?=$i?>">
														<input type="hidden" name="w_night_<?=$i?>">
														<input type="hidden" name="w_hday_<?=$i?>">

														<input type="hidden" name="w_ext_add_<?=$i?>">
														<input type="hidden" name="w_night_add_<?=$i?>">
														<input type="hidden" name="w_hday_add_<?=$i?>">

														<input type="hidden" name="w_late_<?=$i?>">
														<input type="hidden" name="w_leave_<?=$i?>">
														<input type="hidden" name="w_out_<?=$i?>">
														<input type="hidden" name="w_absence_<?=$i?>">

														<input type="hidden" name="workhour_total_<?=$i?>">

														<input type="hidden" name="money_hour_ds_<?=$i?>">
														<input type="hidden" name="money_hour_ts_<?=$i?>">
														<input type="hidden" name="money_time_<?=$i?>">
														<input type="hidden" name="money_day_<?=$i?>">
														<input type="hidden" name="money_month_<?=$i?>">
														<input type="hidden" name="money_setting_<?=$i?>">

														<input type="hidden" name="g1_<?=$i?>">
														<input type="hidden" name="g2_<?=$i?>">
														<input type="hidden" name="g3_<?=$i?>">
														<input type="hidden" name="g4_<?=$i?>">
														<input type="hidden" name="g5_<?=$i?>">

														<input type="hidden" name="ext_<?=$i?>">
														<input type="hidden" name="night_<?=$i?>">
														<input type="hidden" name="hday_<?=$i?>">
														<input type="hidden" name="ext_add_<?=$i?>">
														<input type="hidden" name="night_add_<?=$i?>">
														<input type="hidden" name="hday_add_<?=$i?>">
														<input type="hidden" name="annual_paid_holiday_<?=$i?>">

														<input type="hidden" name="e1_<?=$i?>">
														<input type="hidden" name="e2_<?=$i?>">
														<input type="hidden" name="e3_<?=$i?>">
														<input type="hidden" name="e4_<?=$i?>">
														<input type="hidden" name="e5_<?=$i?>">
														<input type="hidden" name="e6_<?=$i?>">
														<input type="hidden" name="e7_<?=$i?>">
														<input type="hidden" name="e8_<?=$i?>">

														<!--공제내역-->
														<input type="hidden" name="tax_so_var_<?=$i?>">
														<input type="hidden" name="tax_jumin_var_<?=$i?>">
														<input type="hidden" name="advance_pay_<?=$i?>">
														<input type="hidden" name="health_<?=$i?>">
														<input type="hidden" name="yoyang_<?=$i?>">
														<input type="hidden" name="yun_<?=$i?>">
														<input type="hidden" name="goyong_<?=$i?>">
														<input type="hidden" name="end_pay_<?=$i?>">
														<input type="hidden" name="minus_<?=$i?>">
														<input type="hidden" name="minus2_<?=$i?>">
														<input type="hidden" name="etc_<?=$i?>">
														<input type="hidden" name="etc2_<?=$i?>">

														<input type="hidden" name="money_total_<?=$i?>">
														<input type="hidden" name="money_for_tax_<?=$i?>">
														<input type="hidden" name="money_gongje_<?=$i?>">
														<input type="hidden" name="money_result_<?=$i?>">
														<!--추가 필드-->
														<input type="hidden" name="money_ng4">
														<input type="hidden" name="money_ng5">
														<input type="hidden" name="advance_pay">
														<input type="hidden" name="check_money_min_yn" value="<?=$row3[check_money_min_yn]?>">
														<input type="hidden" name="check_money_b_yn" value="<?=$row3[check_money_b_yn]?>">
														<input type="hidden" name="check_money_so_yn" value="<?=$row2[apply_so]?>">
														<input type="hidden" name="money_hour_ms" value="<?=$row3[money_hour_ms]?>">
														<input type="hidden" name="check_business_yn" value="<?=$check_business_yn?>">
														<!--법정수당-->
														<input type="hidden" name="money_b1" value="<?=$row3[money_b1]?>">
														<input type="hidden" name="money_b2" value="<?=$row3[money_b2]?>">
														<input type="hidden" name="money_b3" value="<?=$row3[money_b3]?>">
														<input type="hidden" name="money_b4" value="<?=$row3[money_b4]?>">
														<!--4대보험여부-->
														<input type="hidden" name="isgy" value="<?=$isgy_chk?>">
														<input type="hidden" name="issj" value="<?=$issj_chk?>">
														<input type="hidden" name="iskm" value="<?=$iskm_chk?>">
														<input type="hidden" name="isgg" value="<?=$isgg_chk?>">
														<!--두리누리-->
														<input type="hidden" name="durunuri" value="<?=$durunuri?>">
														<!--연차수당-->
														<!--<input type="hidden" name="money_year" value="<?=number_format($annual_paid_holiday)?>">-->
														<!--추가연장 추가야간 추가휴일-->
														<input type="hidden" name="workhour_ext_add" value="<?=$w_ext_add?>">
														<input type="hidden" name="workhour_night_add" value="<?=$w_night_add?>">
														<input type="hidden" name="workhour_hday_add" value="<?=$w_hday_add?>">
														<input type="hidden" name="money_ext_add" value="<?=number_format($money_ext_add)?>">
														<input type="hidden" name="money_night_add" value="<?=number_format($money_night_add)?>">
														<input type="hidden" name="money_hday_add" value="<?=number_format($money_hday_add)?>">
														<!--기타공제-->
														<!--<input type="hidden" name="minus" value="<?=$row4[minus]?>">-->
														<input type="hidden" name="minus2" value="<?=$row4[minus2]?>">
														<!--기준시급(시급제) 필드-->
														<input type="hidden" name="money_hour_ds" value="<?=$money_hour_ds?>">
														<td nowrap class="ltrow1_center_h24" style="background-color:#ffffff" width="45"><input type="hidden" style="width:100%;ime-mode:disabled;" class="textfm5" name="pay_gbn_txt" value="<?=$pay_gbn?>"><?=$pay_gbn?></td><!-- 근무유형 -->
<?
//echo $total_count;
if($k < $total_count) {
	$k_next = $k+1;
}
?>
														<td nowrap class="ltrow1_center_h24" width="65"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_month" id="id_money_month_<?=$k?>" value="<?=number_format($money_total)?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_month_<?=$k_next?>').focus(); }"></td><!--결정임금-->
														<td nowrap class="ltrow1_center_h24" width="63"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_day" id="id_workhour_day_<?=$k?>" value="<?=$workhour_day?>" onkeyup="cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('wid_orkhour_day_<?=$k_next?>').focus(); }"></td><!-- 소정근로시간 -->
														<td nowrap class="ltrow1_center_h24" width="63"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_ext" id="id_workhour_ext_<?=$k?>" value="<?=$workhour_ext?>" onkeyup="cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_workhour_ext_<?=$k_next?>').focus(); }"></td><!-- 연장근로시간 -->
														<td nowrap class="ltrow1_center_h24" width="62"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_night" id="id_workhour_night_<?=$k?>" value="<?=$workhour_night?>" onkeyup="cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_workhour_night_<?=$k_next?>').focus(); }"></td><!-- 야간근로시간 -->
														<td nowrap class="ltrow1_center_h24" width="63"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_hday" id="id_workhour_hday_<?=$k?>" value="<?=$workhour_hday?>" onkeyup="cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_workhour_hday_<?=$k_next?>').focus(); }"></td><!-- 휴일근로시간 -->

														<td nowrap class="ltrow1_center_h24" width="64"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_late" id="id_workhour_late_<?=$k?>" value="<?=$w_late?>" onkeyup="cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_workhour_late_<?=$k_next?>').focus(); }"></td><!-- 지각 -->
														<td nowrap class="ltrow1_center_h24" width="63"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_leave" id="id_workhour_leave_<?=$k?>" value="<?=$w_leave?>" onkeyup="cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_workhour_leave_<?=$k_next?>').focus(); }"></td><!-- 조퇴 -->
														<td nowrap class="ltrow1_center_h24" width="64"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_out" id="id_workhour_out_<?=$k?>" value="<?=$w_out?>" onkeyup="cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_workhour_out_<?=$k_next?>').focus(); }"></td><!-- 외출 -->
														<td nowrap class="ltrow1_center_h24" width="64"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_absence" id="id_workhour_absence_<?=$k?>" value="<?=$w_absence?>" onkeyup="cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_workhour_absence_<?=$k_next?>').focus(); }"></td><!-- 결근 -->
														<td nowrap class="ltrow1_center_h24" width="62"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="workhour_total" value="<?=$workhour_total?>"></td><!-- 임금산출 총시간 -->
														<td nowrap class="ltrow1_center_h24" width="18"></td>

														<td nowrap class="ltrow1_center_h24" width="77"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_hour_ts" id="id_money_hour_ts_<?=$k?>" value="<?=number_format($money_hour_ts)?>" onkeydown="if(event.keyCode == 13){ getId('id_money_hour_ts_<?=$k_next?>').focus(); }"></td><!-- 통상임금(시간급) -->
														<td nowrap class="ltrow1_center_h24" width="77"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_time" id="id_money_time_<?=$k?>" value="<?=number_format($money_time)?>" onkeydown="if(event.keyCode == 13){ getId('id_money_time_<?=$k_next?>').focus(); }"></td><!-- 기본시급 -->
<?
//기본급 수동입력 클래스 설정
if($check_money_month_fix) {
	$class_money_base = "textfm";
	$readonly_money_base = "";
} else {
	$class_money_base = "textfm5";
	$readonly_money_base = "readonly";
}
?>
														<td nowrap class="ltrow1_center_h24" width="100"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="<?=$class_money_base?>" <?=$readonly_money_base?> name="money_base" id="id_money_base_<?=$k?>" value="<?=number_format($money_base)?>" onchage="this.form.money_month_var[].value='this.value';" onkeyup="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_base_<?=$k_next?>').focus(); }"></td><!-- 기본급 -->
														<td nowrap class="ltrow1_center_h24" width="110"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" name="money_ext" id="id_money_ext_<?=$k?>" value="<?=number_format($money_ext)?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_ext_<?=$k_next?>').focus(); }"></td><!-- 연장근로수당 -->
														<td nowrap class="ltrow1_center_h24" width="110"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" name="money_night" id="id_money_night_<?=$k?>" value="<?=number_format($money_night)?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_night_<?=$k_next?>').focus(); }"></td><!-- 야간근로수당 -->
														<td nowrap class="ltrow1_center_h24" width="110"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" name="money_hday" id="id_money_hday_<?=$k?>" value="<?=number_format($money_hday)?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_hday_<?=$k_next?>').focus(); }"></td><!-- 휴일근로수당 -->
														<td nowrap class="ltrow1_center_h24" width="101"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm"  name="money_year" id="id_money_year_<?=$k?>" value="<?=number_format($annual_paid_holiday)?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_year_<?=$k_next?>').focus(); }"></td><!-- 연차수당 -->




														<td nowrap class="ltrow1_center_h24" width="18"></td>

														<td nowrap class="ltrow1_center_h24" width="137"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_g1" id="id_money_g1_<?=$k?>" value="<?=number_format($money_g1)?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_g1_<?=$k_next?>').focus(); }"></td><!-- 고정성1 -->
														<td nowrap class="ltrow1_center_h24" width="138"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_g2" id="id_money_g2_<?=$k?>" value="<?=number_format($money_g2)?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_g2_<?=$k_next?>').focus(); }"></td><!-- 고정성2 -->
														<td nowrap class="ltrow1_center_h24" width="137"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_g3" id="id_money_g3_<?=$k?>" value="<?=number_format($money_g3)?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_g3_<?=$k_next?>').focus(); }"></td><!-- 고정성3 -->
														<td nowrap class="ltrow1_center_h24" width="137"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_g4" id="id_money_g4_<?=$k?>" value="<?=number_format($money_g4)?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_g4_<?=$k_next?>').focus(); }"></td><!-- 고정성4 -->
														<td nowrap class="ltrow1_center_h24" width="137"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_g5" id="id_money_g5_<?=$k?>" value="<?=number_format($money_g5)?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_g5_<?=$k_next?>').focus(); }"></td><!-- 고정성5 -->
														<td nowrap class="ltrow1_center_h24" width="18"></td>

														<td nowrap class="ltrow1_center_h24" width="67"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e1" id="id_money_e1_<?=$k?>" value="<?=number_format($money_e1)?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_e1_<?=$k_next?>').focus(); }"></td><!-- 기타수당1 -->
														<td nowrap class="ltrow1_center_h24" width="68"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e2" id="id_money_e2_<?=$k?>" value="<?=number_format($money_e2)?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_e2_<?=$k_next?>').focus(); }"></td><!-- 기타수당2 -->
														<td nowrap class="ltrow1_center_h24" width="68"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e3" id="id_money_e3_<?=$k?>" value="<?=number_format($money_e3)?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_e3_<?=$k_next?>').focus(); }"></td><!-- 기타수당3 -->
														<td nowrap class="ltrow1_center_h24" width="67"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e4" id="id_money_e4_<?=$k?>" value="<?=number_format($money_e4)?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_e4_<?=$k_next?>').focus(); }"></td><!-- 기타수당4 -->
														<td nowrap class="ltrow1_center_h24" width="68"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e5" id="id_money_e5_<?=$k?>" value="<?=number_format($money_e5)?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_e5_<?=$k_next?>').focus(); }"></td><!-- 기타수당5 -->
														<td nowrap class="ltrow1_center_h24" width="67"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e6" id="id_money_e6_<?=$k?>" value="<?=number_format($money_e6)?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_e6_<?=$k_next?>').focus(); }"></td><!-- 기타수당6 -->
														<td nowrap class="ltrow1_center_h24" width="68"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e7" id="id_money_e7_<?=$k?>" value="<?=number_format($money_e7)?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_e7_<?=$k_next?>').focus(); }"></td><!-- 기타수당7 -->
														<td nowrap class="ltrow1_center_h24" width="68"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e8" id="id_money_e8_<?=$k?>" value="<?=number_format($money_e8)?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_e8_<?=$k_next?>').focus(); }"></td><!-- 기타수당8 -->

														<td nowrap class="ltrow1_center_h24" width="70"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="etc" id="id_etc_<?=$k?>" value="<?=number_format($row4[etc])?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_etc_<?=$k_next?>').focus(); }"></td><!-- 가불 -->
														<td nowrap class="ltrow1_center_h24" width="70"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="etc2" value="<?=number_format($row4[etc2])?>"></td><!-- 근태공제 -->
														<td nowrap class="ltrow1_center_h24" width="18"></td>

														<td nowrap class="ltrow1_center_h24" width="67"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_total" value="<?=number_format($row4[money_total])?>"></td><!-- 임금계 -->
														<td nowrap class="ltrow1_center_h24" width="67"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_for_tax" value="<?=number_format($row4[money_for_tax])?>"></td><!-- 과세소득 -->

														<td nowrap class="ltrow1_center_h24" width="56"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_yun" id="id_money_yun_<?=$k?>" value="<?=number_format($row4[yun])?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay2('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_yun_<?=$k_next?>').focus(); }"></td><!-- 국민연금 -->
														<td nowrap class="ltrow1_center_h24" width="57"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_health" id="id_money_health_<?=$k?>" value="<?=number_format($row4[health])?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay2('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_health_<?=$k_next?>').focus(); }"></td><!-- 건강보험 -->
														<td nowrap class="ltrow1_center_h24" width="57"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_yoyang" id="id_money_yoyang_<?=$k?>" value="<?=number_format($row4[yoyang])?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay2('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_yoyang_<?=$k_next?>').focus(); }"></td><!-- 장기요양보험 -->
														<td nowrap class="ltrow1_center_h24" width="57"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_goyong" id="id_money_goyong_<?=$k?>" value="<?=number_format($row4[goyong])?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay2('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_goyong_<?=$k_next?>').focus(); }"></td><!-- 고용보험 -->
														<td nowrap class="ltrow1_center_h24" width="57"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="tax_so" id="id_tax_so_<?=$k?>" value="<?=number_format($row4[tax_so])?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay3('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_tax_so_<?=$k_next?>').focus(); }"></td><!-- 소득세 -->
														<td nowrap class="ltrow1_center_h24" width="57"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="tax_jumin" id="id_tax_jumin_<?=$k?>" value="<?=number_format($row4[tax_jumin])?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay2('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_tax_jumin_<?=$k_next?>').focus(); }"></td><!-- 주민세 -->
														<td nowrap class="ltrow1_center_h24" width="60"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="commify(this.value, this);focusOutClass('<?=$k?>');" class="textfm" name="minus" id="id_minus_<?=$k?>" value="<?=number_format($row4[minus])?>" onkeyup="checkThousand_negative(this.value, this,'Y');cal_pay2('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_minus_<?=$k_next?>').focus(); }"></td><!-- 기타공제 -->

														<td nowrap class="ltrow1_center_h24" width="72"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_gongje" value="<?=number_format($row4[money_gongje])?>"></td><!-- 공제계 -->
														<td nowrap class="ltrow1_center_h24" width="73"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_result" value="<?=number_format($row4[money_result])?>"></td><!-- 공제후지급액 -->
														<td nowrap class="ltrow1_center_h24" width="18"></td>
													</tr>
<script type="text/javascript">
//자동 계산
//cal_pay('<?=$k?>');
</script>
													<?
													}
													if ($i == 0) {
														echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' nowrap class=\"ltrow1_center_h22\">자료가 없습니다.</td></tr>";
													}
													if ($i == 1) {
														echo "<input type='checkbox' name='pay_no' value='' style='display:none'><input type='checkbox' name='idx' value='' style='display:none'>";
													}
													?>
												</table>
											</div>
										</td>
									</tr>
								</table>


<script type="text/javascript">
<!--
function cal_pay(idx) {
	var f = document.dataForm;
	var pay_gbn,money_day;
	var money_month,money_hour,money_hour_ds,money_hour_ts,workhour_day,workhour_ext,workhour_night,workhour_hday,workhour_ext_add,workhour_night_add,workhour_hday_add,workhour_total;
	var workhour_late,workhour_leave,workhour_out,workhour_absence;
	var week_hday,year_hday,money_base,money_time,money_ext,money_night,money_hday,money_ext_add,money_night_add,money_hday_add,money_week,money_year;
	var money_g1,money_g2,money_g3,money_g4,money_g5,money_e1,money_e2,money_e3,money_e4,money_e5,money_e6,money_e7,money_e8;
	var money_g_sum, money_b_sum, money_e_sum;
	var money_total,money_for_tax,money_yun,money_health,money_yoyang,money_goyong,tax_so,tax_jumin,minus,minus2,etc,etc2,money_gongje,money_result,workhour_year;

	pay_gbn 		    = toInt(f.pay_gbn 		  [idx].value);
	money_month     = toInt(f.money_month   [idx].value); //기본월급 mm--
	money_hour      = toInt(f.money_hour    [idx].value);	//기준시급 hh--
	money_hour_ds   = toInt(f.money_month 	[idx].value);	//기준시급(시급제)
	money_hour_ts   = toInt(f.money_hour_ts [idx].value);	//통상임금(시간급)


	workhour_day    = toFloat(f.workhour_day  [idx].value);	//소정근로시간         
	workhour_ext    = toFloat(f.workhour_ext  [idx].value);	//연장근로시간         
	workhour_night  = toFloat(f.workhour_night[idx].value);	//야간근로시간
	workhour_hday   = toFloat(f.workhour_hday [idx].value);	//휴일근로시간

	workhour_ext_add    = toFloat(f.workhour_ext_add   [idx].value);	//추가연장근로시간
	workhour_night_add  = toFloat(f.workhour_night_add [idx].value);	//추가야간근로시간
	workhour_hday_add   = toFloat(f.workhour_hday_add  [idx].value);	//추가휴일근로시간

	workhour_late    = toFloat(f.workhour_late   [idx].value);
	workhour_leave   = toFloat(f.workhour_leave  [idx].value);
	workhour_out     = toFloat(f.workhour_out    [idx].value);
	workhour_absence = toFloat(f.workhour_absence[idx].value);

	workhour_total  = toFloat(f.workhour_total[idx].value);	//임금산출 총시간 mm-- 


	week_hday       = toInt(f.week_hday     [idx].value);   // 주휴일일수 hh--      
	year_hday       = toInt(f.year_hday     [idx].value);	// 연차유급휴가일수 hh--
	money_base      = toInt(f.money_base    [idx].value);	// 기본급      
	money_time      = toInt(f.money_time    [idx].value);	// 기본시급
	money_ext       = toInt(f.money_ext     [idx].value);	// 연장근로수당
	money_hday      = toInt(f.money_hday    [idx].value);	// 휴일근로수당
	money_night     = toInt(f.money_night   [idx].value);	// 야간근로수당
	money_week      = toInt(f.money_week    [idx].value);	// 주휴수당 hh--
	money_year      = toInt(f.money_year    [idx].value);	// 연차수당 hh--

	money_ext_add   = toInt(f.money_ext_add [idx].value);	// 연장근로수당(추가)
	money_hday_add  = toInt(f.money_hday_add[idx].value);	// 휴일근로수당(추가)
	money_night_add = toInt(f.money_night_add[idx].value);	// 야간근로수당(추가)

	money_g1        = toInt(f.money_g1      [idx].value);
	money_g2        = toInt(f.money_g2      [idx].value);
	money_g3        = toInt(f.money_g3      [idx].value);
	money_g4        = toInt(f.money_g4      [idx].value);
	money_g5        = toInt(f.money_g5      [idx].value);
	money_e1        = toInt(f.money_e1      [idx].value);
	money_e2        = toInt(f.money_e2      [idx].value);
	money_e3        = toInt(f.money_e3      [idx].value);
	money_e4        = toInt(f.money_e4      [idx].value);
	money_e5        = toInt(f.money_e5      [idx].value);
	money_e6        = toInt(f.money_e6      [idx].value);
	money_e7        = toInt(f.money_e7      [idx].value);




	money_e8        = toInt(f.money_e8      [idx].value);
	money_total     = toInt(f.money_total   [idx].value); //임금계       
	money_for_tax   = toInt(f.money_for_tax [idx].value);	//과세소득     
	money_yun       = toInt(f.money_yun     [idx].value);	//국민연금     
	money_health    = toInt(f.money_health  [idx].value);	//건강보험     
	money_yoyang    = toInt(f.money_yoyang  [idx].value);	//장기요양보험 
	money_goyong    = toInt(f.money_goyong  [idx].value);	//고용보험     
	tax_so          = toInt(f.tax_so        [idx].value);	//소득세       
	tax_jumin       = toInt(f.tax_jumin     [idx].value);	//주민세
	minus           = toInt(f.minus         [idx].value);	//기타공제
	minus2          = toInt(f.minus2        [idx].value);	//기타공제2
	etc           	= toInt(f.etc      	 	  [idx].value);	//가불
	etc2          	= toInt(f.etc2      	  [idx].value);	//근태공제
	money_gongje    = toInt(f.money_gongje  [idx].value);	//공제계       
	money_result    = toInt(f.money_result  [idx].value);	//공제후 지급액
	//workhour_year   = toFloat(f.workhour_year  [idx].value);	//연차휴가시간 mm-- 
	workhour_year   = 0;

	var emp5_gbn = "";
	var rate_ext, rate_hday, rate_night;
	if( emp5_gbn == "1" ) { // 5인이하
		rate_ext = 1;
		rate_night = 1;
		rate_hday = 1;
	}else{
/*
		rate_ext = 1.5;
		rate_night = 0.5;
		rate_hday = 1.5;
*/
<?
//기본연장
$sql_paycode = " select * from com_paycode_list where com_code = '$com_code' and code='b1' ";
$row_paycode = sql_fetch($sql_paycode);
if($row_paycode[multiple]) {
	$rate_ext = $row_paycode[multiple];
} else {
	$rate_ext = 1.5;
}
if($row_paycode[manual] == "Y") $check_manual_ext = "checked";
//야간근로
$sql_paycode = " select * from com_paycode_list where com_code = '$com_code' and code='b2' ";
$row_paycode = sql_fetch($sql_paycode);
if($row_paycode[multiple]) {
	$rate_night = $row_paycode[multiple];
} else {
	$rate_night = 2;
}
if($row_paycode[manual] == "Y") $check_manual_night = "checked";
//휴일근로
$sql_paycode = " select * from com_paycode_list where com_code = '$com_code' and code='b3' ";
$row_paycode = sql_fetch($sql_paycode);
if($row_paycode[multiple]) {
	$rate_hday = $row_paycode[multiple];
} else {
	$rate_hday = 1.5;
}
if($row_paycode[manual] == "Y") $check_manual_hday = "checked";
?>
		rate_ext = <?=$rate_ext?>;
		rate_night = <?=$rate_night?>;
		rate_hday = <?=$rate_hday?>;
	}
	//통상임금수당 합계
	money_g_sum = money_g1+money_g2+money_g3+money_g4+money_g5;
	//alert(money_g_sum+"="+money_g1+"+"+money_g2+"+"+money_g3+"+"+money_g4+"+"+money_g5);


	//임금합계 제외
	if(f.money_e1_gy.value != "Y") money_e1 = 0;
	if(f.money_e2_gy.value != "Y") money_e2 = 0;
	if(f.money_e3_gy.value != "Y") money_e3 = 0;
	if(f.money_e4_gy.value != "Y") money_e4 = 0;
	if(f.money_e5_gy.value != "Y") money_e5 = 0;
	if(f.money_e6_gy.value != "Y") money_e6 = 0;
	if(f.money_e7_gy.value != "Y") money_e7 = 0;
	if(f.money_e8_gy.value != "Y") money_e8 = 0;
	//기타수당 합계
	money_e_sum = money_e1+money_e2+money_e3+money_e4+money_e5+money_e6+money_e7+money_e8;

	k = idx-1;
	money_month_old = f['money_month_'+k].value;
	//시급제
	//alert(pay_gbn);
	if(pay_gbn == 1) {
		money_hour = money_month;
		//임금산출 총시간
		//workhour_total = parseInt( ( workhour_day + (workhour_ext*rate_ext) + (workhour_night*rate_night) + (workhour_hday*rate_hday)  -(workhour_late+workhour_leave+workhour_out+workhour_absence) ) * 1000 ) / 1000;
		workhour_total = parseInt( ( workhour_day + (workhour_ext*rate_ext) + (workhour_night*rate_night) + (workhour_hday*rate_hday) ) * 1000 ) / 1000;
		workhour_total = Math.round(workhour_total*100)/100;
		//money_base = Math.round( money_hour * workhour_day );
		//기본급 고정 : 고정이 아닐 경우 기본급 계산
		if(!f.money_month_fix.checked || f.idx[idx].checked) money_base = Math.round( money_hour * workhour_day );
		//money_hour_ts = Math.round( money_hour + ( money_g_sum / workhour_day ) );
		//통상임금 = 결정임금
		money_hour_ts = money_month;
		//money_hour_ts = 5160;
		if( isNaN(money_hour_ts) ) money_hour_ts = 0;
		f.money_hour_ds[idx].value = money_hour_ds;
		//alert(money_hour_ds);
	} else {
		//workhour_total 임금산출 총시간 mm--
		//workhour_total = workhour_day + (workhour_ext*rate_ext) + (workhour_night*rate_night) + (workhour_hday*rate_hday) + (workhour_ext_add*rate_ext) + (workhour_night_add*rate_night) + (workhour_hday_add*rate_hday) + workhour_year -(workhour_late+workhour_leave+workhour_out+workhour_absence);
		workhour_total = workhour_day + (workhour_ext*rate_ext) + (workhour_night*rate_night) + (workhour_hday*rate_hday) + (workhour_ext_add*rate_ext) + (workhour_night_add*rate_night) + (workhour_hday_add*rate_hday) + workhour_year;

		//money_base 기본급
		//money_base = money_month - money_ext - money_hday - money_night - money_year;
		
		//alert(money_base);
		//money_hour_ts 통상임금(시간급) 
		if( workhour_total != 0 ){
			//기본급 수동입력
			//alert(f.check_money_min_yn[idx].value);
			if(f.check_money_min_yn[idx].value == "Y") {
				//alert(f['money_month_'+k].value);
				if(money_month_old == money_month) {
					money_hour_ms = toInt(f.money_hour_ms[idx].value);
					if(!f.money_month_fix.checked  || f.idx[idx].checked) money_base = money_month - (money_ext + money_night + money_hday) - (money_g_sum + money_e_sum) - money_year;
					if(money_hour_ms != money_base) {
						if(!f.money_month_fix.checked  || f.idx[idx].checked) money_base = money_month - (money_ext + money_night + money_hday) - (money_g_sum + money_e_sum) - money_year;
					}
					//if(idx == 3) alert(money_base);
				} else {
					if(!f.money_month_fix.checked || f.idx[idx].checked) money_base = money_month - (money_ext + money_night + money_hday) - (money_g_sum + money_e_sum) - money_year;
					//if(idx == 1) alert(money_base+" = "+money_month+" - ("+money_ext+" + "+money_night+" + "+money_hday+") - ("+money_g_sum+" + "+money_e_sum+") - "+money_year);
				}
				//급여 해당월 중간 입사자 기본급 설정
				if(money_base > money_month_old) {
					if(!f.money_month_fix.checked || f.idx[idx].checked) money_base = money_month - (money_ext + money_night + money_hday) - (money_g_sum + money_e_sum) - money_year;
				}
				money_hour_ts = Math.round( ( money_base + money_g_sum ) / workhour_day);
				//alert(money_hour_ts+"=("+money_base+"+"+money_g_sum+")/"+workhour_day);
				//alert(money_base);
			} else {
				if(!f.money_month_fix.checked || f.idx[idx].checked) money_base = money_month - (money_ext + money_night + money_hday) - (money_g_sum + money_e_sum) - money_year;
				//if(idx == 1) alert(money_base+" = "+money_month+" - ("+money_ext+" + "+money_night+" + "+money_hday+") - ("+money_g_sum+" + "+money_e_sum+") - "+money_year);
				money_hour_ts = ( money_month - money_g_sum ) / workhour_day;
			}
		}
	}
	//결정임금 0 이면 통상시급, 기본급 0
	if(money_month == 0) money_hour_ts = 0;
	if(money_month == 0) money_base = 0;
	//money_ext 연장근로수당 
	//money_hday 휴일근로수당
	//money_night 야간근로수당 
	//money_year 연차수당 -----------------------------------

	//순서 변경 : 사원관리-급여정보 법정수당 수정입력 데이터 적용 150625

	money_ext_add = Math.round(workhour_ext_add * money_hour_ts * rate_ext);
	money_night_add = Math.round(workhour_night_add * money_hour_ts * rate_night);
	money_hday_add = Math.round(workhour_hday_add * money_hour_ts * rate_hday);

	//연차수당
	//money_year = Math.round(workhour_year * money_hour_ts );
	//결정임금 변경으로 통상시급, 기본급 변경 반복문
	if(money_month_old != money_month) {
		//기본급 자동 계산 문제로 20번 반복문 제거 150803
		for(i=0;i<20;i++) {
			//money_base = money_month - (money_ext + money_night + money_hday) - (money_g_sum + money_e_sum) - money_year;
			if(!f.money_month_fix.checked || f.idx[idx].checked) {
				//money_base = money_month - (money_ext + money_night + money_hday) - (money_g_sum + money_e_sum) - money_year;
			}
			//if(idx == 1) alert(money_base);
			//alert(money_base+" = "+money_month+" - ("+money_ext+" + "+money_night+" + "+money_hday+") - ("+money_g_sum+" + "+money_e_sum+") - "+money_year);
			//시급제 (통상임금 설정)
			if(pay_gbn == 1) {
				money_hour_ts = money_month;
			} else {
				money_hour_ts = Math.round( ( money_base + money_g_sum ) / workhour_day);
			}
			//alert(money_hour_ts+"=("+money_base+"+"+money_g_sum+")/"+workhour_day);
			//money_ext = Math.round(workhour_ext * money_hour_ts * rate_ext);
			//money_night = Math.round(workhour_night * money_hour_ts * rate_night);
			//money_hday = Math.round(workhour_hday * money_hour_ts * rate_hday);
			//alert(money_ext);
			if(!f.manual_ext.checked) {
				if(f.check_money_b_yn[idx].value == "Y") money_ext = parseInt(f.money_b1[idx].value);
				else money_ext = Math.round(workhour_ext * money_hour_ts * rate_ext);
			} else {
				money_ext = toInt(f.money_ext[idx].value);
			}
			//수동입력 야간근로
			if(!f.manual_night.checked) {
				if(f.check_money_b_yn[idx].value == "Y") money_night = parseInt(f.money_b2[idx].value);
				else money_night = Math.round(workhour_night * money_hour_ts * rate_night);
			} else {
				money_night = toInt(f.money_night[idx].value);
				//alert(money_night);
			}
			//수동입력 휴일근로
			if(!f.manual_hday.checked) {
				if(f.check_money_b_yn[idx].value == "Y") money_hday = parseInt(f.money_b3[idx].value);
				else money_hday = Math.round(workhour_hday * money_hour_ts * rate_hday);
			} else {
				money_hday = toInt(f.money_hday[idx].value);
			}
			money_ext_add = Math.round(workhour_ext_add * money_hour_ts * rate_ext);
			money_night_add = Math.round(workhour_night_add * money_hour_ts * rate_night);
			money_hday_add = Math.round(workhour_hday_add * money_hour_ts * rate_hday);
		}
	}
	//순서 변경 : 사원관리-급여정보 법정수당 수정입력 데이터 적용 150625
	//법정수당 수동입력 (사원관리-급여정보) 연장근로 수동입력 140610
	if(!f.manual_ext.checked) {
		if(f.check_money_b_yn[idx].value == "Y") money_ext = parseInt(f.money_b1[idx].value);
		else money_ext = Math.round(workhour_ext * money_hour_ts * rate_ext);
	} else {
		money_ext = toInt(f.money_ext[idx].value);
	}
	//수동입력 야간근로
	if(!f.manual_night.checked) {
		if(f.check_money_b_yn[idx].value == "Y") money_night = parseInt(f.money_b2[idx].value);
		else money_night = Math.round(workhour_night * money_hour_ts * rate_night);
	} else {
		money_night = toInt(f.money_night[idx].value);
		//alert(money_night);
	}
	//수동입력 휴일근로
	if(!f.manual_hday.checked) {
		if(f.check_money_b_yn[idx].value == "Y") money_hday = parseInt(f.money_b3[idx].value);
		else money_hday = Math.round(workhour_hday * money_hour_ts * rate_hday);
	} else {
		money_hday = toInt(f.money_hday[idx].value);
	}
	//통상임금(시간급) 반올림
	money_hour_ts = Math.round(money_hour_ts);
	//money_base = money_month - (money_ext + money_night + money_hday) - money_g_sum - money_year;
	//기본급 계산식
	//alert(money_base+"="+money_month+"-("+money_ext+"+"+money_night+"+"+money_hday+")-("+money_g_sum+"+"+money_e_sum+")-"+money_year);
	//alert(money_base+"="+money_month+"-("+money_ext+"+"+money_night+"+"+money_hday+")-"+money_g_sum+"-"+money_year);

	//기본시급 미설정, 기본급/소정근로시간 미설정 시 기본시급 0 셋팅 : 기본시급 = 기본급 / 소정근로시간 : 150727
	if(!money_time) {
		if(!money_base) money_time = 0;
		else if(!workhour_day) money_time = 0;
		else money_time = Math.round( money_base / workhour_day );
		//alert(money_time);
	}
	//시급제
	if(pay_gbn == 1) {
		money_time = money_hour_ts;
		
	} else {
		//기본시급 재설정
		if(money_time) money_time = Math.round( money_base / workhour_day );
		else money_time = 0;
	}
	//근태공제
	etc2 = money_time * (workhour_late+workhour_leave+workhour_out+workhour_absence);

	//money_total 임금계 
	//money_total = money_month+money_g_sum+money_e_sum;
<?
//아이좋아어린이집
if($com_code == "20368") echo " money_total = money_base + (money_ext + money_hday + money_night + money_year) + (money_ext_add + money_hday_add + money_night_add) + (money_g_sum + money_e_sum + etc) - (etc2); ";
else echo " money_total = money_base + (money_ext + money_hday + money_night + money_year) + (money_ext_add + money_hday_add + money_night_add) + (money_g_sum + money_e_sum) - (etc + etc2); ";
?>
	//money_total = money_base + (money_ext + money_hday + money_night + money_year) + (money_ext_add + money_hday_add + money_night_add) + (money_g_sum + money_e_sum) - (etc + etc2);
	//money_for_tax 과세소득 
	//money_for_tax = money_total - money_g1 - money_g2 - money_g3;
	//alert(money_total);
<?
//차량유지
$sql_paycode = " select * from com_paycode_list where com_code = '$com_code' and code='e1' ";
$row_paycode = sql_fetch($sql_paycode);
if($row_paycode[tax_limit]) {
	$money_e1_tax_limit = preg_replace('@,@', '', $row_paycode[tax_limit]);
} else {
	$money_e1_tax_limit = 0;
}
//식대
$sql_paycode = " select * from com_paycode_list where com_code = '$com_code' and code='e2' ";
$row_paycode = sql_fetch($sql_paycode);
if($row_paycode[tax_limit]) {
	$money_e2_tax_limit = preg_replace('@,@', '', $row_paycode[tax_limit]);
} else {
	$money_e2_tax_limit = 0;
}
//자녀보육
$sql_paycode = " select * from com_paycode_list where com_code = '$com_code' and code='e3' ";
$row_paycode = sql_fetch($sql_paycode);
if($row_paycode[tax_limit]) {
	$money_e3_tax_limit = preg_replace('@,@', '', $row_paycode[tax_limit]);
} else {
	$money_e3_tax_limit = 0;
}
//연구활동비
$sql_paycode = " select * from com_paycode_list where com_code = '$com_code' and code='e4' ";
$row_paycode = sql_fetch($sql_paycode);
if($row_paycode[tax_limit]) {
	$money_e4_tax_limit = preg_replace('@,@', '', $row_paycode[tax_limit]);
} else {
	$money_e4_tax_limit = 0;
}
?>

	//기타수당 과세포함 여부, 비과세 한도 설정
	//alert(f.money_e6_income.value);
	if(f.money_e1_income.value != "Y") {
		if(money_e1 > toInt(<?=$money_e1_tax_limit?>)) money_e1 = money_e1 - toInt(<?=$money_e1_tax_limit?>);
		else money_e1 = 0;		
	}
	if(f.money_e2_income.value != "Y") {
		if(money_e2 > toInt(<?=$money_e2_tax_limit?>)) money_e2 = money_e2 - toInt(<?=$money_e2_tax_limit?>);
		else money_e2 = 0;
	}
	if(f.money_e3_income.value != "Y") {
		if(money_e3 > toInt(<?=$money_e3_tax_limit?>)) money_e3 = money_e3 - toInt(<?=$money_e3_tax_limit?>);
		else money_e3 = 0;
	}
	if(f.money_e4_income.value != "Y") {
		if(money_e4 > toInt(<?=$money_e4_tax_limit?>)) money_e4 = money_e4 - toInt(<?=$money_e4_tax_limit?>);
		else money_e4 = 0;
	}
	if(f.money_e5_income.value != "Y") {
		if(money_e5 > toInt(<?=$money_e5_tax_limit?>)) money_e5 = money_e5 - toInt(<?=$money_e5_tax_limit?>);
		else money_e5 = 0;
	}
	if(f.money_e6_income.value != "Y") {
		if(money_e6 > toInt(<?=$money_e6_tax_limit?>)) money_e6 = money_e6 - toInt(<?=$money_e6_tax_limit?>);
		else money_e6 = 0;
	}
	if(f.money_e7_income.value != "Y") {
		if(money_e7 > toInt(<?=$money_e7_tax_limit?>)) money_e7 = money_e7 - toInt(<?=$money_e7_tax_limit?>);
		else money_e7 = 0;
	}
	if(f.money_e8_income.value != "Y") {
		if(money_e8 > toInt(<?=$money_e8_tax_limit?>)) money_e8 = money_e8 - toInt(<?=$money_e8_tax_limit?>);
		else money_e8 = 0;
	}
	//alert(f.money_e4_income.value);
	//f.error_code.value += money_e1;
	//기타수당 합계 (과세소득 계산용)
	money_e_income_sum = money_e1+money_e2+money_e3+money_e4+money_e5+money_e6+money_e7+money_e8;
	//alert(money_e_income_sum);
	//f.error_code.value += ", "+money_e_income_sum;

<?
if($member['mb_id'] == "227-80-10541") {
?>
	money_for_tax = (money_total - money_g1 - money_e_sum) + money_e_income_sum;
<?
} else {
	//아이좋아어린이집
	if($com_code == "20368") echo " money_for_tax = (money_total - (money_e_sum+etc)) + money_e_income_sum; ";
	else echo " money_for_tax = (money_total - money_e_sum) + money_e_income_sum; ";
}
?>
	//money_for_tax_var = (money_total - money_e_sum) + money_e_income_sum;
	money_for_tax_var = money_for_tax;
	//두루누리 지원금 50%
	//durunuri_50 = 1;
	//alert(durunuri);
	//1번 40%, 2번 60% 지원
	if(f.durunuri[idx].value == "1") durunuri_50 = 0.6;
	else if(f.durunuri[idx].value == "2") durunuri_50 = 0.4;
	else durunuri_50 = 1;
	//alert(f.idx[idx].checked);
	//4대보험 수동입력 유무
	if(!f.manual_4insure.checked || f.idx[idx].checked) {
		//money_yun 국민연금  
		//money_yun = get_round( parseInt(money_for_tax) * 0.045 / durunuri_50 );
		money_yun = get_round( parseInt(money_for_tax) * 0.045 * durunuri_50 );
		//money_health 건강보험 
		//2015년 건강보험 요율 3.035
		//alert(f.search_year.value);
		if(f.search_year.value >= 2016) {
			money_health_rate = 0.0306;
		} else if(f.search_year.value == 2015 ) {
			money_health_rate = 0.03035;
		} else {
			money_health_rate = 0.02995;
		}
		//alert(money_health_rate);
		money_health = get_round( parseInt(money_for_tax) * money_health_rate );
		//money_yoyang 장기요양보험 
		money_yoyang = get_round( money_health* 0.0655  );
		//money_goyong 고용보험
		//money_goyong = get_round( parseInt(money_for_tax) * 0.0065 / durunuri_50 );
		money_goyong = get_round( parseInt(money_for_tax) * 0.0065 * durunuri_50 );
		//4대보험 공제 제외
		if(f.iskm[idx].value != "checked") money_yun = 0;
		if(f.isgg[idx].value != "checked") money_health = 0;
		if(f.isgg[idx].value != "checked") money_yoyang = 0;
		if(f.isgy[idx].value != "checked") money_goyong = 0;
		//if(f.isgy.value == "checked") money_goyong = 0;
	}
	//세금 수동입력 유무
	if(!f.manual_tax.checked || f.idx[idx].checked) {
		//tax_so 소득세
		//alert(f.check_money_so_yn[idx].value);
		if(f.check_money_so_yn[idx].value == "0" || f.check_money_so_yn[idx].value == "") {
			tax_so = GetTax( money_for_tax, idx );
		} else {
			tax_so = 0;
		}
		//사업소득자 3.3% 적용
		if(f.check_business_yn[idx].value == "0") {
			//alert(f.money_time[idx].value);
			//money_day = toInt(f.money_time[idx].value) * 8;
			tax_so = get_round(money_for_tax* 0.03 );
			if(tax_so <= 1000) tax_so = 0;
		}
		//tax_jumin 주민세
		tax_jumin = get_round(tax_so* 0.1 );
	}

	//money_gongje 공제계 
	money_gongje = money_yun+money_health+money_yoyang+money_goyong+tax_so+tax_jumin+minus+minus2;
	//money_result 공제후 지급액 
	money_result = money_total - money_gongje;

	//소수점 2자리 반올림
	workhour_total = workhour_total.toFixed(2);
	money_hour_ts = money_hour_ts.toFixed(2);
	//alert(money_hour_ts);

	//통상임금(시간급) < 최저임금(2014년)
	money_min = 5210;
	if(money_hour_ts < money_min) {
		f.money_hour_ts[idx].style.color = "red";
	} else {
		f.money_hour_ts[idx].style.color = "#343434";
	}

	//천단위 구분
	money_hour_ts = number_format(money_hour_ts);
	money_time = number_format(money_time);
	money_base = number_format(money_base);
	money_ext = number_format(money_ext);
	money_hday = number_format(money_hday);
	money_night = number_format(money_night);
	money_year = number_format(money_year);

	money_ext_add = number_format(money_ext_add);
	money_hday_add = number_format(money_hday_add);
	money_night_add = number_format(money_night_add);

	money_total = number_format(money_total);
	money_for_tax = number_format(money_for_tax_var);

	money_yun = number_format(money_yun);
	money_health = number_format(money_health);
	money_yoyang = number_format(money_yoyang);
	money_goyong = number_format(money_goyong);
	tax_so = number_format(tax_so);
	tax_jumin = number_format(tax_jumin);
	minus2 = number_format(minus2);
	etc2 = number_format(etc2);

	money_gongje = number_format(money_gongje);
	money_result = number_format(money_result);

	//변수 input 입력
	//f.error_code.value = money_base;
	f.money_hour_ts[idx].value = money_hour_ts; //money_hour_ts 통상임금(시간급) 
	//기본시급 0 일 경우 통상시급 적용
	//if(!money_time) alert(money_time);
	f.money_time[idx].value = money_time;
	f.workhour_total[idx].value = workhour_total; //workhour_total 임금산출 총시간 mm--
<?
if(!$row3['money_month']) {
?>
	f.money_base[idx].value = money_base; //money_base 기본급
<? } ?>
	if(f.check_money_b_yn[idx].value != "Y") {
		if(!f.manual_ext.checked) f.money_ext[idx].value = money_ext; //money_ext 연장근로수당 
		if(!f.manual_hday.checked) f.money_hday[idx].value = money_hday; //money_hday 휴일근로수당 
		if(!f.manual_night.checked) f.money_night[idx].value = money_night; //money_night 야간근로수당 
	}
	//f.money_year[idx].value = money_year //money_year 연차수당 ------------------------

	f.money_ext_add[idx].value = money_ext_add //money_ext 연장근로수당(추가)
	f.money_hday_add[idx].value = money_hday_add //money_hday 휴일근로수당(추가)
	f.money_night_add[idx].value = money_night_add //money_night 야간근로수당(추가)

	f.money_total[idx].value = money_total //money_total 임금계 
	f.money_for_tax[idx].value = money_for_tax //money_for_tax 과세소득 

	f.money_yun[idx].value = money_yun //money_yun 국민연금 
	f.money_health[idx].value = money_health //money_health 건강보험 
	f.money_yoyang[idx].value = money_yoyang //money_yoyang 장기요양보험 
	f.money_goyong[idx].value = money_goyong //money_goyong 고용보험 

	f.tax_so[idx].value = tax_so //tax_so 소득세 
	f.tax_jumin[idx].value = tax_jumin //tax_jumin 주민세 

	f.minus2[idx].value = minus2 //근태공제
	f.etc2[idx].value = etc2 //근태공제

	f.money_gongje[idx].value = money_gongje //money_gongje 공제계 
	f.money_result[idx].value = money_result //money_result 공제후 지급액
	//결정임금 0 일 경우 모두 0 설정
	if(money_month == 0) {
		f.money_base[idx].value = 0;
		f.money_ext[idx].value = 0;
		f.money_hday[idx].value = 0;
		f.money_night[idx].value = 0;
		f.money_total[idx].value = 0;
		f.money_for_tax[idx].value = 0;
		f.money_yun[idx].value = 0;
		f.money_health[idx].value = 0;
		f.money_yoyang[idx].value = 0;
		f.money_goyong[idx].value = 0;
		f.tax_so[idx].value = 0;
		f.tax_jumin[idx].value = 0;
		f.minus2[idx].value = 0;
		f.etc2[idx].value = 0;
		f.money_gongje[idx].value = 0;
		f.money_result[idx].value = 0;
	}
}
//엑셀입력
function pay_excel_input(url, code, year, month) {
	window.open("popup/"+url+"?code=_"+code+"?year=_"+year+"?month=_"+month, "jikjong_popup", "width=640, height=706, toolbar=no, menubar=no, scrollbars=no, resizable=no" );
}
//급여복사
function pay_copy(url) {
	self.location.href = url+"?data=copy&amp;select_type=<?=$select_type?>&amp;search_pay_gbn=<?=$search_pay_gbn?>&amp;add_work_numb=<?=$add_work_numb?>&amp;search_year=<?=$search_year?>&amp;search_month=<?=$search_month?>&amp;copy_year="+getId('copy_year').value+"&amp;copy_month="+getId('copy_month').value;
}
//-->
</script>