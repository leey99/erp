								<!--����Ʈ -->
								<table width="100%" border="0" cellpadding="0" cellspacing="0" class="bgtable" style="table-layout:fixed;">
									<tr>
										<td width="200" height="84" valign="top">
											<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
												<col width="11%">
												<col width="">
												<col width="34%">
												<col width="25%">
												<tr>
													<td nowrap height="85" align="center" style="background-color:rgb(226, 226, 226);">��<br />��<br />��<br />��</td>
													<td nowrap class="tdhead_center">�̸�</td>
													<td nowrap class="tdhead_center">�Ի���</td>
													<td nowrap class="tdhead_center">����</td>
												</tr>
											</table>
										</td>
										<td nowrap class="tdhead_center" valign="top">
<?
//����ӱ�
$sql_g = " select * from com_paycode_list where com_code = '$com_code' and item='trade' ";
//echo $sql_g;
$result_g = sql_query($sql_g);
for($i=0; $row_g=sql_fetch_array($result_g); $i++) {
	$g_code = $row_g[code];
	$money_g_txt[$g_code] = $row_g[name];
	//echo $g_code;
}
//��Ÿ����
$sql_e = " select * from com_paycode_list where com_code = '$com_code' and item='privilege' ";
$result_e = sql_query($sql_e);
for($i=0; $row_e=sql_fetch_array($result_e); $i++) {
	$e_code = $row_e[code];
	$money_e_txt[$e_code] = $row_e[name];
	//�ӱ����Կ���
	$money_e_gy[$e_code] = $row_e[gy_yn];
	//�������Կ���
	$money_e_income[$e_code] = $row_e[income];
}
$pay_list_width = 3550;
$money_month_text = "�����ӱ�";
?>
											<div id="spanTop" style="width:100%;overflow:hidden">
												<table cellpadding=0 cellspacing=0 border=0>
													<tr>
														<td>  
															<table width="<?=$pay_list_width?>" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:;">
																<tr>
																	<td class="tdhead_center" rowspan="4" width="45">����</td>
																	<td class="tdhead_center" colspan="10">�����޿� �� �ٷνð�(��) </td>
																	<td class="tdhead_center" rowspan="4" width="18"></td>
																	<td class="tdhead_center" colspan="7">�⺻�� �� ������ </td>
																	<td class="tdhead_center" rowspan="4" width="18"></td>
																	<td class="tdhead_center" colspan="5">�⺻�� �� ������ </td>
																	<td class="tdhead_center" rowspan="4" width="18"></td>
																	<td class="tdhead_center" colspan="10">�⺻�� �� ������ </td>
																	<td class="tdhead_center" rowspan="4" width="18"></td>
																	<td class="tdhead_center" colspan="2"> </td>
																	<td class="tdhead_center" colspan="8">������</td>
																	<td class="tdhead_center" rowspan="4" width="74">������<br>���޾� </td>
																	<td class="tdhead_center" rowspan="4" width="18"></td>
																</tr>
																<tr>
																	<td class="tdhead_center" rowspan="3" width="66"><?=$money_month_text?></td>
																	<td class="tdhead_center" colspan="4">�ٷνð�</td>
																	<td class="tdhead_center" colspan="4">���°����ð�</td>
																	<td class="tdhead_center" rowspan="3" width="63">�ӱݻ���<br>�ѽð� </td>

																	<td class="tdhead_center" colspan="7">�⺻����</td>
																	<td class="tdhead_center" colspan="5">������</td>
																	<td class="tdhead_center" colspan="8">������</td>
																	<td class="tdhead_center" colspan="2">��Ÿ</td>
																	<td class="tdhead_center" rowspan="3" width="68">�ӱݰ�</td>
																	<td class="tdhead_center" rowspan="3" width="68">�����ҵ�</td>
																	<td class="tdhead_center" colspan="4"><input type="checkbox" name="manual_4insure" <?=$check_manual_4insure?> onclick="check_manual(this);" value="1" title="�����Է�" style="vertical-align:middle;"> 4�뺸��</td>
																	<td class="tdhead_center" colspan="2"><input type="checkbox" name="manual_tax" <?=$check_manual_tax?> onclick="check_manual(this);" value="1" title="�����Է�" style="vertical-align:middle;"> ����</td>
																	<td class="tdhead_center" colspan="1">��Ÿ</td>
																	<td class="tdhead_center" rowspan="3" width="72">������</td>
																</tr>
																<tr>
																	<td class="tdhead_center" rowspan="2" width="63">����<br>�ٷνð�</td>
																	<td class="tdhead_center" rowspan="2" width="63">����<br>�ٷνð�</td>
																	<td class="tdhead_center" rowspan="2" width="63">�߰�<br>�ٷνð�</td>
																	<td class="tdhead_center" rowspan="2" width="63">����<br>�ٷνð�</td>

																	<td class="tdhead_center" rowspan="2" width="64">����</td>
																	<td class="tdhead_center" rowspan="2" width="64">����</td>
																	<td class="tdhead_center" rowspan="2" width="64">����</td>
																	<td class="tdhead_center" rowspan="2" width="64">���</td>

																	<td class="tdhead_center" rowspan="2" width="77">���ñ�</td>
																	<td class="tdhead_center" rowspan="2" width="78">�⺻�ñ�</td>
																	<td class="tdhead_center" rowspan="2" width="102"><input type="checkbox" name="money_month_fix" <?=$check_money_month_fix?> onclick="money_month_fix_ft(this);" value="Y" title="�����Է�"> �⺻��</td>
																	<td class="tdhead_center" colspan="4">��������(����)</td>
																	<td class="tdhead_center" colspan="5">����ӱݼ���</td>
																	<td class="tdhead_center" colspan="4">�����</td>
																	<td class="tdhead_center" colspan="4">����</td>
<?
//�������ƾ����
if($com_code == "20368") $etc_text = "ȯ��/�ұ�";
else $etc_text = "����";
//�ų� 2�� �������� ȯ�޺����� ��ü 160218
if($search_month == 2) $minus_text = "��������";
else $minus_text = "��Ÿ����";
?>
																	<td class="tdhead_center" rowspan="2" width="71"><?=$etc_text?></td>
																	<td class="tdhead_center" rowspan="2" width="71">���°���</td>

																	<td class="tdhead_center" rowspan="2" width="57">���ο���</td>
																	<td class="tdhead_center" rowspan="2" width="57">�ǰ�����</td>
																	<td class="tdhead_center" rowspan="2" width="57">�����</td>
																	<td class="tdhead_center" rowspan="2" width="57">��뺸��</td>
																	<td class="tdhead_center" rowspan="2" width="57">�ҵ漼</td>
																	<td class="tdhead_center" rowspan="2" width="57">�ֹμ�</td>
																	<td class="tdhead_center" rowspan="2" width="60"><?=$minus_text?></td>
																</tr>
																<tr>
																	<td class="tdhead_center" width="110"><input type="checkbox" name="manual_ext" <?=$check_manual_ext?> onclick="check_manual(this);" value="1" title="�����Է�" style="vertical-align:middle;"> ����ٷ�</td>
																	<td class="tdhead_center" width="110"><input type="checkbox" name="manual_night" <?=$check_manual_night?> onclick="check_manual(this);" value="1" title="�����Է�" style="vertical-align:middle;"> �߰��ٷ�</td>
																	<td class="tdhead_center" width="110"><input type="checkbox" name="manual_hday" <?=$check_manual_hday?> onclick="check_manual(this);" value="1" title="�����Է�" style="vertical-align:middle;"> ���ϱٷ�</td>
																	<td class="tdhead_center" width="101">��������</td>



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
													<!--�հ����� ����-->
													<input type="hidden" name="money_e1_gy" value="<?=$money_e_gy['e1']?>">
													<input type="hidden" name="money_e2_gy" value="<?=$money_e_gy['e2']?>">
													<input type="hidden" name="money_e3_gy" value="<?=$money_e_gy['e3']?>">
													<input type="hidden" name="money_e4_gy" value="<?=$money_e_gy['e4']?>">
													<input type="hidden" name="money_e5_gy" value="<?=$money_e_gy['e5']?>">
													<input type="hidden" name="money_e6_gy" value="<?=$money_e_gy['e6']?>">
													<input type="hidden" name="money_e7_gy" value="<?=$money_e_gy['e7']?>">
													<input type="hidden" name="money_e8_gy" value="<?=$money_e_gy['e8']?>">
													<!--�������� ����-->
													<input type="hidden" name="money_e1_income" value="<?=$money_e_income['e1']?>">
													<input type="hidden" name="money_e2_income" value="<?=$money_e_income['e2']?>">
													<input type="hidden" name="money_e3_income" value="<?=$money_e_income['e3']?>">
													<input type="hidden" name="money_e4_income" value="<?=$money_e_income['e4']?>">
													<input type="hidden" name="money_e5_income" value="<?=$money_e_income['e5']?>">
													<input type="hidden" name="money_e6_income" value="<?=$money_e_income['e6']?>">
													<input type="hidden" name="money_e7_income" value="<?=$money_e_income['e7']?>">
													<input type="hidden" name="money_e8_income" value="<?=$money_e_income['e8']?>">
													<!--�ӱ��Ѿ�-->
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
													<!--�߰� �ʵ�-->
													<input type="hidden" name="money_ng4">
													<input type="hidden" name="money_ng5">
													<input type="hidden" name="advance_pay">
													<input type="hidden" name="check_money_min_yn">
													<input type="hidden" name="check_money_b_yn">
													<input type="hidden" name="check_money_so_yn">
													<input type="hidden" name="money_hour_ms">
													<input type="hidden" name="check_business_yn">
													<!--4�뺸�迩��-->
													<input type="hidden" name="isgy">
													<input type="hidden" name="issj">
													<input type="hidden" name="iskm">
													<input type="hidden" name="isgg">
													<!--�θ�����-->
													<input type="hidden" name="durunuri">
												</div>
												<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
													<col width="11%">
													<col width="">
													<col width="34%">
													<col width="25%">
													<?
													// ����Ʈ ���
													for ($i=0; $row=sql_fetch_array($result); $i++) {
														//$page
														//$total_page
														//$rows
														$no = $total_count - $i - ($rows*($page-1));
														$list = $i%2;
														$code = $row[com_code];
														// ������ : ������ڵ�
														$sql_com = " select com_name from $g4[com_list_gy] where com_code = '$row[com_code]' ";
														$row_com = sql_fetch($sql_com);
														$com_name = $row_com[com_name];
														$com_name = cut_str($com_name, 21, "..");
														$name = cut_str($row[name], 6, "..");

														//������� �߰� DB
														$sql2 = " select * from pibohum_base_opt where com_code='$row[com_code]' and sabun='$row[sabun]' ";
														$result2 = sql_query($sql2);
														$row2=mysql_fetch_array($result2);

														//������� �߰� DB 2
														$sql4 = " select * from pibohum_base_opt2 where com_code='$row[com_code]' and sabun='$row[sabun]' ";
														$result4 = sql_query($sql4);
														$row4=mysql_fetch_array($result4);

														//����
														$sql_position = " select * from com_code_list where com_code = '$code' and code='$row2[position]' and item='position' ";
														$result_position = sql_query($sql_position);
														$row_position=mysql_fetch_array($result_position);
														$k = $i+1;

														//ȣ��
														$sql_step = " select * from com_code_list where com_code = '$code' and code='$row2[step]' and item='step' ";
														$result_step = sql_query($sql_step);
														$row_step=mysql_fetch_array($result_step);

														//ä������
														if($row[work_form] == "") $work_form = "-";
														else if($row[work_form] == "1") $work_form = "������";
														else if($row[work_form] == "2") $work_form = "�����";
														else if($row[work_form] == "3") $work_form = "�Ͽ���";
													?>

													<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
														<td nowrap class="ltrow1_center_h24">
															<input type="checkbox" name="idx" value="<?=$row[sabun]?>">
														</td>
<?
if($row2[pay_gbn] == "0") $pay_gbn = "������";
else if($row2[pay_gbn] == "1") $pay_gbn = "�ñ���";
else if($row2[pay_gbn] == "3") $pay_gbn = "������";
if($row4[input_type] == "1") $input_type = "(A)";
else if($row4[input_type] == "2") $input_type = "(B)";
else if($row4[input_type] == "3") $input_type = "(C)";
//�� �߰� �Ի��� ���� ���
$join_year = $search_year;
$join_month = $search_month;
$join_day = $row_com_opt['pay_calculate_day_period1'];
if($join_day < 10) $join_day = "0".$join_day;
$start_date = $join_year.".".$join_month.".".$join_day;
$end_year = $search_year;
$end_month = $search_month;
$end_day = $row_com_opt['pay_calculate_day_period2'];
if($end_day == "��") {
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
															echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' nowrap class=\"ltrow1_center_h22\">�ڷᰡ �����ϴ�.</td></tr>";
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
													// ����Ʈ ���
													for ($i=0; $row=sql_fetch_array($result); $i++) {
														//$page
														//$total_page
														//$rows

														$no = $total_count - $i - ($rows*($page-1));
														$list = $i%2;
														// ������ : ������ڵ�
														$sql_com = " select com_name from $g4[com_list_gy] where com_code = '$row[com_code]' ";
														$row_com = sql_fetch($sql_com);
														$com_name = $row_com['com_name'];
														$com_name = cut_str($com_name, 21, "..");
														//$name = cut_str($row[name], 6, "..");
														//�ٷ��� ���� ��ü ǥ�� 150709
														$name = $row['name'];

														//������� �߰� DB
														$sql2 = " select * from pibohum_base_opt where com_code='$row[com_code]' and sabun='$row[sabun]' ";
														$result2 = sql_query($sql2);
														$row2=mysql_fetch_array($result2);

														//����
														$sql_position = " select * from com_code_list where com_code='$row[com_code]' and code='$row2[position]' and item='position' ";
														//echo $sql_position;
														$result_position = sql_query($sql_position);
														$row_position=mysql_fetch_array($result_position);
														//echo $row_position[name];
														$k = $i+1;

														//ȣ��
														$sql_step = " select * from com_code_list where com_code='$row[com_code]' and code='$row2[step]' and item='step' ";
														$result_step = sql_query($sql_step);
														$row_step=mysql_fetch_array($result_step);

														//ä������
														if($row[work_form] == "") $work_form = "-";
														else if($row[work_form] == "1") $work_form = $work_form_txt[1];
														else if($row[work_form] == "2") $work_form = $work_form_txt[2];
														else if($row[work_form] == "3") $work_form = $work_form_txt[3];
														else if($row[work_form] == "4") $work_form = $work_form_txt[4];

														//�޿�����
														//echo $row2[pay_gbn];
														if($row2[pay_gbn] == "0") $pay_gbn = "������";
														else if($row2[pay_gbn] == "1") $pay_gbn = "�ñ���";
														else if($row2[pay_gbn] == "2") $pay_gbn = "���ձٹ�";
														else if($row2[pay_gbn] == "3") $pay_gbn = "������";
														else if($row2[pay_gbn] == "4") $pay_gbn = "�ϱ���";
														else $pay_gbn = "-";
														$pay_gbn_no = $row2[pay_gbn];

														//����ٷ�
														$sql_attendance = " select * from a4_attendance where com_code='$row[com_code]' and sabun='$row[sabun]' and att_day like '201310%' ";
														//echo $sql_attendance;
														$result_attendance = sql_query($sql_attendance);
														$row_attendance=mysql_fetch_array($result_attendance);

														//������� �߰� DB (�޿�����)
														$sql3 = " select * from pibohum_base_opt2 where com_code='$row[com_code]' and sabun='$row[sabun]' ";
														$result3 = sql_query($sql3);
														$row3=mysql_fetch_array($result3);

														//�޿����� DB (�޿��ݿ�) ��� : �޿����� Ŭ�� ���� 150723
														if($data == "copy") {
															$sql4 = " select * from pibohum_base_pay where com_code='$row[com_code]' and sabun='$row[sabun]' and year = '$copy_year' and month = '$copy_month' ";
														} else {
															$sql4 = " select * from pibohum_base_pay where com_code='$row[com_code]' and sabun='$row[sabun]' and year = '$search_year' and month = '$search_month' ";
														}
														//echo $sql4;
														$result4 = sql_query($sql4);
														$row4=mysql_fetch_array($result4);

														//�߰����� �ٷνð� �ʱ�ȭ
														if(!$row4[w_ext_add]) $row4[w_ext_add] = "0";
														if(!$row4[w_night_add]) $row4[w_night_add] = "0";
														if(!$row4[w_hday_add]) $row4[w_hday_add] = "0";
														if(!$row3[money_month_base]) {
															$row4[w_ext_add] = "";
															$row4[w_night_add] = "";
															$row4[w_hday_add] = "";
														}
														//4�뺸�迩��
														if($row[apply_gy] == "0") $isgy_chk = "checked";
														else $isgy_chk = "";
														if($row[apply_sj] == "0") $issj_chk = "checked";
														else $issj_chk = "";
														if($row[apply_km] == "0") $iskm_chk = "checked";
														else $iskm_chk = "";
														if($row[apply_gg] == "0") $isgg_chk = "checked"; 
														else $isgg_chk = "";
														//�θ����� ���� ����
														$durunuri = $row2[insurance];
														//���ο��� ��60�� �ش� ���
														$now_date = date("Ymd");
														$jumin_date = "19".substr($row[jumin_no],0,9);
														$age_cal = ( $now_date - $jumin_date ) / 10000;
														$age = (int)$age_cal;
														if($age_cal >= 60) {
															$iskm_chk = "";
														}
														//����ҵ��� 3.3% �ҵ漼/�ֹμ�
														if($row['work_form'] == 4) {
															$check_business_yn = "0";
															$pay_gbn = "<span style='color:blue' title='����ҵ���'>".$pay_gbn."</a>";
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
//�޿� ������, ����޿����� �ҷ�����, (�޿����� && �����ӱ� �̵��) 150903
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

	//��������
	$att_ymd = $search_year."".$search_month;
	$sql_attendance = " select * from a4_attendance where com_code='$com_code' and sabun='$row[sabun]' ";
	//echo $sql_attendance;
	$result_attendance = sql_query($sql_attendance);
	$att_rule = array();
	//�������� �ʱ�ȭ
	$w_late = "";
	$w_leave = "";
	$w_out = "";
	$w_absence = "";
	for($j=0; $row_attendance=sql_fetch_array($result_attendance); $j++) {
		//��������
		$att_day = date('Y-m-d',strtotime($row_attendance[att_day]));
		$att_date = explode("-", $att_day);
		//echo $att_date[0];
		//�ش� �⵵
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
	//�⺻�ñ�
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
//�����ñ� DB ���
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

														<!--��������-->
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
														<!--�߰� �ʵ�-->
														<input type="hidden" name="money_ng4">
														<input type="hidden" name="money_ng5">
														<input type="hidden" name="advance_pay">
														<input type="hidden" name="check_money_min_yn" value="<?=$row3[check_money_min_yn]?>">
														<input type="hidden" name="check_money_b_yn" value="<?=$row3[check_money_b_yn]?>">
														<input type="hidden" name="check_money_so_yn" value="<?=$row2[apply_so]?>">
														<input type="hidden" name="money_hour_ms" value="<?=$row3[money_hour_ms]?>">
														<input type="hidden" name="check_business_yn" value="<?=$check_business_yn?>">
														<!--��������-->
														<input type="hidden" name="money_b1" value="<?=$row3[money_b1]?>">
														<input type="hidden" name="money_b2" value="<?=$row3[money_b2]?>">
														<input type="hidden" name="money_b3" value="<?=$row3[money_b3]?>">
														<input type="hidden" name="money_b4" value="<?=$row3[money_b4]?>">
														<!--4�뺸�迩��-->
														<input type="hidden" name="isgy" value="<?=$isgy_chk?>">
														<input type="hidden" name="issj" value="<?=$issj_chk?>">
														<input type="hidden" name="iskm" value="<?=$iskm_chk?>">
														<input type="hidden" name="isgg" value="<?=$isgg_chk?>">
														<!--�θ�����-->
														<input type="hidden" name="durunuri" value="<?=$durunuri?>">
														<!--��������-->
														<!--<input type="hidden" name="money_year" value="<?=number_format($annual_paid_holiday)?>">-->
														<!--�߰����� �߰��߰� �߰�����-->
														<input type="hidden" name="workhour_ext_add" value="<?=$w_ext_add?>">
														<input type="hidden" name="workhour_night_add" value="<?=$w_night_add?>">
														<input type="hidden" name="workhour_hday_add" value="<?=$w_hday_add?>">
														<input type="hidden" name="money_ext_add" value="<?=number_format($money_ext_add)?>">
														<input type="hidden" name="money_night_add" value="<?=number_format($money_night_add)?>">
														<input type="hidden" name="money_hday_add" value="<?=number_format($money_hday_add)?>">
														<!--��Ÿ����-->
														<!--<input type="hidden" name="minus" value="<?=$row4[minus]?>">-->
														<input type="hidden" name="minus2" value="<?=$row4[minus2]?>">
														<!--���ؽñ�(�ñ���) �ʵ�-->
														<input type="hidden" name="money_hour_ds" value="<?=$money_hour_ds?>">
														<td nowrap class="ltrow1_center_h24" style="background-color:#ffffff" width="45"><input type="hidden" style="width:100%;ime-mode:disabled;" class="textfm5" name="pay_gbn_txt" value="<?=$pay_gbn?>"><?=$pay_gbn?></td><!-- �ٹ����� -->
<?
//echo $total_count;
if($k < $total_count) {
	$k_next = $k+1;
}
?>
														<td nowrap class="ltrow1_center_h24" width="65"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_month" id="id_money_month_<?=$k?>" value="<?=number_format($money_total)?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_month_<?=$k_next?>').focus(); }"></td><!--�����ӱ�-->
														<td nowrap class="ltrow1_center_h24" width="63"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_day" id="id_workhour_day_<?=$k?>" value="<?=$workhour_day?>" onkeyup="cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('wid_orkhour_day_<?=$k_next?>').focus(); }"></td><!-- �����ٷνð� -->
														<td nowrap class="ltrow1_center_h24" width="63"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_ext" id="id_workhour_ext_<?=$k?>" value="<?=$workhour_ext?>" onkeyup="cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_workhour_ext_<?=$k_next?>').focus(); }"></td><!-- ����ٷνð� -->
														<td nowrap class="ltrow1_center_h24" width="62"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_night" id="id_workhour_night_<?=$k?>" value="<?=$workhour_night?>" onkeyup="cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_workhour_night_<?=$k_next?>').focus(); }"></td><!-- �߰��ٷνð� -->
														<td nowrap class="ltrow1_center_h24" width="63"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_hday" id="id_workhour_hday_<?=$k?>" value="<?=$workhour_hday?>" onkeyup="cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_workhour_hday_<?=$k_next?>').focus(); }"></td><!-- ���ϱٷνð� -->

														<td nowrap class="ltrow1_center_h24" width="64"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_late" id="id_workhour_late_<?=$k?>" value="<?=$w_late?>" onkeyup="cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_workhour_late_<?=$k_next?>').focus(); }"></td><!-- ���� -->
														<td nowrap class="ltrow1_center_h24" width="63"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_leave" id="id_workhour_leave_<?=$k?>" value="<?=$w_leave?>" onkeyup="cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_workhour_leave_<?=$k_next?>').focus(); }"></td><!-- ���� -->
														<td nowrap class="ltrow1_center_h24" width="64"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_out" id="id_workhour_out_<?=$k?>" value="<?=$w_out?>" onkeyup="cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_workhour_out_<?=$k_next?>').focus(); }"></td><!-- ���� -->
														<td nowrap class="ltrow1_center_h24" width="64"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_absence" id="id_workhour_absence_<?=$k?>" value="<?=$w_absence?>" onkeyup="cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_workhour_absence_<?=$k_next?>').focus(); }"></td><!-- ��� -->
														<td nowrap class="ltrow1_center_h24" width="62"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="workhour_total" value="<?=$workhour_total?>"></td><!-- �ӱݻ��� �ѽð� -->
														<td nowrap class="ltrow1_center_h24" width="18"></td>

														<td nowrap class="ltrow1_center_h24" width="77"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_hour_ts" id="id_money_hour_ts_<?=$k?>" value="<?=number_format($money_hour_ts)?>" onkeydown="if(event.keyCode == 13){ getId('id_money_hour_ts_<?=$k_next?>').focus(); }"></td><!-- ����ӱ�(�ð���) -->
														<td nowrap class="ltrow1_center_h24" width="77"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_time" id="id_money_time_<?=$k?>" value="<?=number_format($money_time)?>" onkeydown="if(event.keyCode == 13){ getId('id_money_time_<?=$k_next?>').focus(); }"></td><!-- �⺻�ñ� -->
<?
//�⺻�� �����Է� Ŭ���� ����
if($check_money_month_fix) {
	$class_money_base = "textfm";
	$readonly_money_base = "";
} else {
	$class_money_base = "textfm5";
	$readonly_money_base = "readonly";
}
?>
														<td nowrap class="ltrow1_center_h24" width="100"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="<?=$class_money_base?>" <?=$readonly_money_base?> name="money_base" id="id_money_base_<?=$k?>" value="<?=number_format($money_base)?>" onchage="this.form.money_month_var[].value='this.value';" onkeyup="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_base_<?=$k_next?>').focus(); }"></td><!-- �⺻�� -->
														<td nowrap class="ltrow1_center_h24" width="110"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" name="money_ext" id="id_money_ext_<?=$k?>" value="<?=number_format($money_ext)?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_ext_<?=$k_next?>').focus(); }"></td><!-- ����ٷμ��� -->
														<td nowrap class="ltrow1_center_h24" width="110"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" name="money_night" id="id_money_night_<?=$k?>" value="<?=number_format($money_night)?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_night_<?=$k_next?>').focus(); }"></td><!-- �߰��ٷμ��� -->
														<td nowrap class="ltrow1_center_h24" width="110"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" name="money_hday" id="id_money_hday_<?=$k?>" value="<?=number_format($money_hday)?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_hday_<?=$k_next?>').focus(); }"></td><!-- ���ϱٷμ��� -->
														<td nowrap class="ltrow1_center_h24" width="101"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm"  name="money_year" id="id_money_year_<?=$k?>" value="<?=number_format($annual_paid_holiday)?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_year_<?=$k_next?>').focus(); }"></td><!-- �������� -->




														<td nowrap class="ltrow1_center_h24" width="18"></td>

														<td nowrap class="ltrow1_center_h24" width="137"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_g1" id="id_money_g1_<?=$k?>" value="<?=number_format($money_g1)?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_g1_<?=$k_next?>').focus(); }"></td><!-- ������1 -->
														<td nowrap class="ltrow1_center_h24" width="138"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_g2" id="id_money_g2_<?=$k?>" value="<?=number_format($money_g2)?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_g2_<?=$k_next?>').focus(); }"></td><!-- ������2 -->
														<td nowrap class="ltrow1_center_h24" width="137"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_g3" id="id_money_g3_<?=$k?>" value="<?=number_format($money_g3)?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_g3_<?=$k_next?>').focus(); }"></td><!-- ������3 -->
														<td nowrap class="ltrow1_center_h24" width="137"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_g4" id="id_money_g4_<?=$k?>" value="<?=number_format($money_g4)?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_g4_<?=$k_next?>').focus(); }"></td><!-- ������4 -->
														<td nowrap class="ltrow1_center_h24" width="137"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_g5" id="id_money_g5_<?=$k?>" value="<?=number_format($money_g5)?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_g5_<?=$k_next?>').focus(); }"></td><!-- ������5 -->
														<td nowrap class="ltrow1_center_h24" width="18"></td>

														<td nowrap class="ltrow1_center_h24" width="67"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e1" id="id_money_e1_<?=$k?>" value="<?=number_format($money_e1)?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_e1_<?=$k_next?>').focus(); }"></td><!-- ��Ÿ����1 -->
														<td nowrap class="ltrow1_center_h24" width="68"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e2" id="id_money_e2_<?=$k?>" value="<?=number_format($money_e2)?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_e2_<?=$k_next?>').focus(); }"></td><!-- ��Ÿ����2 -->
														<td nowrap class="ltrow1_center_h24" width="68"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e3" id="id_money_e3_<?=$k?>" value="<?=number_format($money_e3)?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_e3_<?=$k_next?>').focus(); }"></td><!-- ��Ÿ����3 -->
														<td nowrap class="ltrow1_center_h24" width="67"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e4" id="id_money_e4_<?=$k?>" value="<?=number_format($money_e4)?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_e4_<?=$k_next?>').focus(); }"></td><!-- ��Ÿ����4 -->
														<td nowrap class="ltrow1_center_h24" width="68"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e5" id="id_money_e5_<?=$k?>" value="<?=number_format($money_e5)?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_e5_<?=$k_next?>').focus(); }"></td><!-- ��Ÿ����5 -->
														<td nowrap class="ltrow1_center_h24" width="67"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e6" id="id_money_e6_<?=$k?>" value="<?=number_format($money_e6)?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_e6_<?=$k_next?>').focus(); }"></td><!-- ��Ÿ����6 -->
														<td nowrap class="ltrow1_center_h24" width="68"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e7" id="id_money_e7_<?=$k?>" value="<?=number_format($money_e7)?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_e7_<?=$k_next?>').focus(); }"></td><!-- ��Ÿ����7 -->
														<td nowrap class="ltrow1_center_h24" width="68"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e8" id="id_money_e8_<?=$k?>" value="<?=number_format($money_e8)?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_e8_<?=$k_next?>').focus(); }"></td><!-- ��Ÿ����8 -->

														<td nowrap class="ltrow1_center_h24" width="70"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="etc" id="id_etc_<?=$k?>" value="<?=number_format($row4[etc])?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_etc_<?=$k_next?>').focus(); }"></td><!-- ���� -->
														<td nowrap class="ltrow1_center_h24" width="70"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="etc2" value="<?=number_format($row4[etc2])?>"></td><!-- ���°��� -->
														<td nowrap class="ltrow1_center_h24" width="18"></td>

														<td nowrap class="ltrow1_center_h24" width="67"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_total" value="<?=number_format($row4[money_total])?>"></td><!-- �ӱݰ� -->
														<td nowrap class="ltrow1_center_h24" width="67"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_for_tax" value="<?=number_format($row4[money_for_tax])?>"></td><!-- �����ҵ� -->

														<td nowrap class="ltrow1_center_h24" width="56"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_yun" id="id_money_yun_<?=$k?>" value="<?=number_format($row4[yun])?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay2('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_yun_<?=$k_next?>').focus(); }"></td><!-- ���ο��� -->
														<td nowrap class="ltrow1_center_h24" width="57"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_health" id="id_money_health_<?=$k?>" value="<?=number_format($row4[health])?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay2('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_health_<?=$k_next?>').focus(); }"></td><!-- �ǰ����� -->
														<td nowrap class="ltrow1_center_h24" width="57"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_yoyang" id="id_money_yoyang_<?=$k?>" value="<?=number_format($row4[yoyang])?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay2('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_yoyang_<?=$k_next?>').focus(); }"></td><!-- ����纸�� -->
														<td nowrap class="ltrow1_center_h24" width="57"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_goyong" id="id_money_goyong_<?=$k?>" value="<?=number_format($row4[goyong])?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay2('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_goyong_<?=$k_next?>').focus(); }"></td><!-- ��뺸�� -->
														<td nowrap class="ltrow1_center_h24" width="57"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="tax_so" id="id_tax_so_<?=$k?>" value="<?=number_format($row4[tax_so])?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay3('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_tax_so_<?=$k_next?>').focus(); }"></td><!-- �ҵ漼 -->
														<td nowrap class="ltrow1_center_h24" width="57"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="tax_jumin" id="id_tax_jumin_<?=$k?>" value="<?=number_format($row4[tax_jumin])?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay2('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_tax_jumin_<?=$k_next?>').focus(); }"></td><!-- �ֹμ� -->
														<td nowrap class="ltrow1_center_h24" width="60"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="commify(this.value, this);focusOutClass('<?=$k?>');" class="textfm" name="minus" id="id_minus_<?=$k?>" value="<?=number_format($row4[minus])?>" onkeyup="checkThousand_negative(this.value, this,'Y');cal_pay2('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_minus_<?=$k_next?>').focus(); }"></td><!-- ��Ÿ���� -->

														<td nowrap class="ltrow1_center_h24" width="72"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_gongje" value="<?=number_format($row4[money_gongje])?>"></td><!-- ������ -->
														<td nowrap class="ltrow1_center_h24" width="73"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_result" value="<?=number_format($row4[money_result])?>"></td><!-- ���������޾� -->
														<td nowrap class="ltrow1_center_h24" width="18"></td>
													</tr>
<script type="text/javascript">
//�ڵ� ���
//cal_pay('<?=$k?>');
</script>
													<?
													}
													if ($i == 0) {
														echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' nowrap class=\"ltrow1_center_h22\">�ڷᰡ �����ϴ�.</td></tr>";
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
	money_month     = toInt(f.money_month   [idx].value); //�⺻���� mm--
	money_hour      = toInt(f.money_hour    [idx].value);	//���ؽñ� hh--
	money_hour_ds   = toInt(f.money_month 	[idx].value);	//���ؽñ�(�ñ���)
	money_hour_ts   = toInt(f.money_hour_ts [idx].value);	//����ӱ�(�ð���)


	workhour_day    = toFloat(f.workhour_day  [idx].value);	//�����ٷνð�         
	workhour_ext    = toFloat(f.workhour_ext  [idx].value);	//����ٷνð�         
	workhour_night  = toFloat(f.workhour_night[idx].value);	//�߰��ٷνð�
	workhour_hday   = toFloat(f.workhour_hday [idx].value);	//���ϱٷνð�

	workhour_ext_add    = toFloat(f.workhour_ext_add   [idx].value);	//�߰�����ٷνð�
	workhour_night_add  = toFloat(f.workhour_night_add [idx].value);	//�߰��߰��ٷνð�
	workhour_hday_add   = toFloat(f.workhour_hday_add  [idx].value);	//�߰����ϱٷνð�

	workhour_late    = toFloat(f.workhour_late   [idx].value);
	workhour_leave   = toFloat(f.workhour_leave  [idx].value);
	workhour_out     = toFloat(f.workhour_out    [idx].value);
	workhour_absence = toFloat(f.workhour_absence[idx].value);

	workhour_total  = toFloat(f.workhour_total[idx].value);	//�ӱݻ��� �ѽð� mm-- 


	week_hday       = toInt(f.week_hday     [idx].value);   // �������ϼ� hh--      
	year_hday       = toInt(f.year_hday     [idx].value);	// ���������ް��ϼ� hh--
	money_base      = toInt(f.money_base    [idx].value);	// �⺻��      
	money_time      = toInt(f.money_time    [idx].value);	// �⺻�ñ�
	money_ext       = toInt(f.money_ext     [idx].value);	// ����ٷμ���
	money_hday      = toInt(f.money_hday    [idx].value);	// ���ϱٷμ���
	money_night     = toInt(f.money_night   [idx].value);	// �߰��ٷμ���
	money_week      = toInt(f.money_week    [idx].value);	// ���޼��� hh--
	money_year      = toInt(f.money_year    [idx].value);	// �������� hh--

	money_ext_add   = toInt(f.money_ext_add [idx].value);	// ����ٷμ���(�߰�)
	money_hday_add  = toInt(f.money_hday_add[idx].value);	// ���ϱٷμ���(�߰�)
	money_night_add = toInt(f.money_night_add[idx].value);	// �߰��ٷμ���(�߰�)

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
	money_total     = toInt(f.money_total   [idx].value); //�ӱݰ�       
	money_for_tax   = toInt(f.money_for_tax [idx].value);	//�����ҵ�     
	money_yun       = toInt(f.money_yun     [idx].value);	//���ο���     
	money_health    = toInt(f.money_health  [idx].value);	//�ǰ�����     
	money_yoyang    = toInt(f.money_yoyang  [idx].value);	//����纸�� 
	money_goyong    = toInt(f.money_goyong  [idx].value);	//��뺸��     
	tax_so          = toInt(f.tax_so        [idx].value);	//�ҵ漼       
	tax_jumin       = toInt(f.tax_jumin     [idx].value);	//�ֹμ�
	minus           = toInt(f.minus         [idx].value);	//��Ÿ����
	minus2          = toInt(f.minus2        [idx].value);	//��Ÿ����2
	etc           	= toInt(f.etc      	 	  [idx].value);	//����
	etc2          	= toInt(f.etc2      	  [idx].value);	//���°���
	money_gongje    = toInt(f.money_gongje  [idx].value);	//������       
	money_result    = toInt(f.money_result  [idx].value);	//������ ���޾�
	//workhour_year   = toFloat(f.workhour_year  [idx].value);	//�����ް��ð� mm-- 
	workhour_year   = 0;

	var emp5_gbn = "";
	var rate_ext, rate_hday, rate_night;
	if( emp5_gbn == "1" ) { // 5������
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
//�⺻����
$sql_paycode = " select * from com_paycode_list where com_code = '$com_code' and code='b1' ";
$row_paycode = sql_fetch($sql_paycode);
if($row_paycode[multiple]) {
	$rate_ext = $row_paycode[multiple];
} else {
	$rate_ext = 1.5;
}
if($row_paycode[manual] == "Y") $check_manual_ext = "checked";
//�߰��ٷ�
$sql_paycode = " select * from com_paycode_list where com_code = '$com_code' and code='b2' ";
$row_paycode = sql_fetch($sql_paycode);
if($row_paycode[multiple]) {
	$rate_night = $row_paycode[multiple];
} else {
	$rate_night = 2;
}
if($row_paycode[manual] == "Y") $check_manual_night = "checked";
//���ϱٷ�
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
	//����ӱݼ��� �հ�
	money_g_sum = money_g1+money_g2+money_g3+money_g4+money_g5;
	//alert(money_g_sum+"="+money_g1+"+"+money_g2+"+"+money_g3+"+"+money_g4+"+"+money_g5);


	//�ӱ��հ� ����
	if(f.money_e1_gy.value != "Y") money_e1 = 0;
	if(f.money_e2_gy.value != "Y") money_e2 = 0;
	if(f.money_e3_gy.value != "Y") money_e3 = 0;
	if(f.money_e4_gy.value != "Y") money_e4 = 0;
	if(f.money_e5_gy.value != "Y") money_e5 = 0;
	if(f.money_e6_gy.value != "Y") money_e6 = 0;
	if(f.money_e7_gy.value != "Y") money_e7 = 0;
	if(f.money_e8_gy.value != "Y") money_e8 = 0;
	//��Ÿ���� �հ�
	money_e_sum = money_e1+money_e2+money_e3+money_e4+money_e5+money_e6+money_e7+money_e8;

	k = idx-1;
	money_month_old = f['money_month_'+k].value;
	//�ñ���
	//alert(pay_gbn);
	if(pay_gbn == 1) {
		money_hour = money_month;
		//�ӱݻ��� �ѽð�
		//workhour_total = parseInt( ( workhour_day + (workhour_ext*rate_ext) + (workhour_night*rate_night) + (workhour_hday*rate_hday)  -(workhour_late+workhour_leave+workhour_out+workhour_absence) ) * 1000 ) / 1000;
		workhour_total = parseInt( ( workhour_day + (workhour_ext*rate_ext) + (workhour_night*rate_night) + (workhour_hday*rate_hday) ) * 1000 ) / 1000;
		workhour_total = Math.round(workhour_total*100)/100;
		//money_base = Math.round( money_hour * workhour_day );
		//�⺻�� ���� : ������ �ƴ� ��� �⺻�� ���
		if(!f.money_month_fix.checked || f.idx[idx].checked) money_base = Math.round( money_hour * workhour_day );
		//money_hour_ts = Math.round( money_hour + ( money_g_sum / workhour_day ) );
		//����ӱ� = �����ӱ�
		money_hour_ts = money_month;
		//money_hour_ts = 5160;
		if( isNaN(money_hour_ts) ) money_hour_ts = 0;
		f.money_hour_ds[idx].value = money_hour_ds;
		//alert(money_hour_ds);
	} else {
		//workhour_total �ӱݻ��� �ѽð� mm--
		//workhour_total = workhour_day + (workhour_ext*rate_ext) + (workhour_night*rate_night) + (workhour_hday*rate_hday) + (workhour_ext_add*rate_ext) + (workhour_night_add*rate_night) + (workhour_hday_add*rate_hday) + workhour_year -(workhour_late+workhour_leave+workhour_out+workhour_absence);
		workhour_total = workhour_day + (workhour_ext*rate_ext) + (workhour_night*rate_night) + (workhour_hday*rate_hday) + (workhour_ext_add*rate_ext) + (workhour_night_add*rate_night) + (workhour_hday_add*rate_hday) + workhour_year;

		//money_base �⺻��
		//money_base = money_month - money_ext - money_hday - money_night - money_year;
		
		//alert(money_base);
		//money_hour_ts ����ӱ�(�ð���) 
		if( workhour_total != 0 ){
			//�⺻�� �����Է�
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
				//�޿� �ش�� �߰� �Ի��� �⺻�� ����
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
	//�����ӱ� 0 �̸� ���ñ�, �⺻�� 0
	if(money_month == 0) money_hour_ts = 0;
	if(money_month == 0) money_base = 0;
	//money_ext ����ٷμ��� 
	//money_hday ���ϱٷμ���
	//money_night �߰��ٷμ��� 
	//money_year �������� -----------------------------------

	//���� ���� : �������-�޿����� �������� �����Է� ������ ���� 150625

	money_ext_add = Math.round(workhour_ext_add * money_hour_ts * rate_ext);
	money_night_add = Math.round(workhour_night_add * money_hour_ts * rate_night);
	money_hday_add = Math.round(workhour_hday_add * money_hour_ts * rate_hday);

	//��������
	//money_year = Math.round(workhour_year * money_hour_ts );
	//�����ӱ� �������� ���ñ�, �⺻�� ���� �ݺ���
	if(money_month_old != money_month) {
		//�⺻�� �ڵ� ��� ������ 20�� �ݺ��� ���� 150803
		for(i=0;i<20;i++) {
			//money_base = money_month - (money_ext + money_night + money_hday) - (money_g_sum + money_e_sum) - money_year;
			if(!f.money_month_fix.checked || f.idx[idx].checked) {
				//money_base = money_month - (money_ext + money_night + money_hday) - (money_g_sum + money_e_sum) - money_year;
			}
			//if(idx == 1) alert(money_base);
			//alert(money_base+" = "+money_month+" - ("+money_ext+" + "+money_night+" + "+money_hday+") - ("+money_g_sum+" + "+money_e_sum+") - "+money_year);
			//�ñ��� (����ӱ� ����)
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
			//�����Է� �߰��ٷ�
			if(!f.manual_night.checked) {
				if(f.check_money_b_yn[idx].value == "Y") money_night = parseInt(f.money_b2[idx].value);
				else money_night = Math.round(workhour_night * money_hour_ts * rate_night);
			} else {
				money_night = toInt(f.money_night[idx].value);
				//alert(money_night);
			}
			//�����Է� ���ϱٷ�
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
	//���� ���� : �������-�޿����� �������� �����Է� ������ ���� 150625
	//�������� �����Է� (�������-�޿�����) ����ٷ� �����Է� 140610
	if(!f.manual_ext.checked) {
		if(f.check_money_b_yn[idx].value == "Y") money_ext = parseInt(f.money_b1[idx].value);
		else money_ext = Math.round(workhour_ext * money_hour_ts * rate_ext);
	} else {
		money_ext = toInt(f.money_ext[idx].value);
	}
	//�����Է� �߰��ٷ�
	if(!f.manual_night.checked) {
		if(f.check_money_b_yn[idx].value == "Y") money_night = parseInt(f.money_b2[idx].value);
		else money_night = Math.round(workhour_night * money_hour_ts * rate_night);
	} else {
		money_night = toInt(f.money_night[idx].value);
		//alert(money_night);
	}
	//�����Է� ���ϱٷ�
	if(!f.manual_hday.checked) {
		if(f.check_money_b_yn[idx].value == "Y") money_hday = parseInt(f.money_b3[idx].value);
		else money_hday = Math.round(workhour_hday * money_hour_ts * rate_hday);
	} else {
		money_hday = toInt(f.money_hday[idx].value);
	}
	//����ӱ�(�ð���) �ݿø�
	money_hour_ts = Math.round(money_hour_ts);
	//money_base = money_month - (money_ext + money_night + money_hday) - money_g_sum - money_year;
	//�⺻�� ����
	//alert(money_base+"="+money_month+"-("+money_ext+"+"+money_night+"+"+money_hday+")-("+money_g_sum+"+"+money_e_sum+")-"+money_year);
	//alert(money_base+"="+money_month+"-("+money_ext+"+"+money_night+"+"+money_hday+")-"+money_g_sum+"-"+money_year);

	//�⺻�ñ� �̼���, �⺻��/�����ٷνð� �̼��� �� �⺻�ñ� 0 ���� : �⺻�ñ� = �⺻�� / �����ٷνð� : 150727
	if(!money_time) {
		if(!money_base) money_time = 0;
		else if(!workhour_day) money_time = 0;
		else money_time = Math.round( money_base / workhour_day );
		//alert(money_time);
	}
	//�ñ���
	if(pay_gbn == 1) {
		money_time = money_hour_ts;
		
	} else {
		//�⺻�ñ� �缳��
		if(money_time) money_time = Math.round( money_base / workhour_day );
		else money_time = 0;
	}
	//���°���
	etc2 = money_time * (workhour_late+workhour_leave+workhour_out+workhour_absence);

	//money_total �ӱݰ� 
	//money_total = money_month+money_g_sum+money_e_sum;
<?
//�������ƾ����
if($com_code == "20368") echo " money_total = money_base + (money_ext + money_hday + money_night + money_year) + (money_ext_add + money_hday_add + money_night_add) + (money_g_sum + money_e_sum + etc) - (etc2); ";
else echo " money_total = money_base + (money_ext + money_hday + money_night + money_year) + (money_ext_add + money_hday_add + money_night_add) + (money_g_sum + money_e_sum) - (etc + etc2); ";
?>
	//money_total = money_base + (money_ext + money_hday + money_night + money_year) + (money_ext_add + money_hday_add + money_night_add) + (money_g_sum + money_e_sum) - (etc + etc2);
	//money_for_tax �����ҵ� 
	//money_for_tax = money_total - money_g1 - money_g2 - money_g3;
	//alert(money_total);
<?
//��������
$sql_paycode = " select * from com_paycode_list where com_code = '$com_code' and code='e1' ";
$row_paycode = sql_fetch($sql_paycode);
if($row_paycode[tax_limit]) {
	$money_e1_tax_limit = preg_replace('@,@', '', $row_paycode[tax_limit]);
} else {
	$money_e1_tax_limit = 0;
}
//�Ĵ�
$sql_paycode = " select * from com_paycode_list where com_code = '$com_code' and code='e2' ";
$row_paycode = sql_fetch($sql_paycode);
if($row_paycode[tax_limit]) {
	$money_e2_tax_limit = preg_replace('@,@', '', $row_paycode[tax_limit]);
} else {
	$money_e2_tax_limit = 0;
}
//�ڳຸ��
$sql_paycode = " select * from com_paycode_list where com_code = '$com_code' and code='e3' ";
$row_paycode = sql_fetch($sql_paycode);
if($row_paycode[tax_limit]) {
	$money_e3_tax_limit = preg_replace('@,@', '', $row_paycode[tax_limit]);
} else {
	$money_e3_tax_limit = 0;
}
//����Ȱ����
$sql_paycode = " select * from com_paycode_list where com_code = '$com_code' and code='e4' ";
$row_paycode = sql_fetch($sql_paycode);
if($row_paycode[tax_limit]) {
	$money_e4_tax_limit = preg_replace('@,@', '', $row_paycode[tax_limit]);
} else {
	$money_e4_tax_limit = 0;
}
?>

	//��Ÿ���� �������� ����, ����� �ѵ� ����
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
	//��Ÿ���� �հ� (�����ҵ� ����)
	money_e_income_sum = money_e1+money_e2+money_e3+money_e4+money_e5+money_e6+money_e7+money_e8;
	//alert(money_e_income_sum);
	//f.error_code.value += ", "+money_e_income_sum;

<?
if($member['mb_id'] == "227-80-10541") {
?>
	money_for_tax = (money_total - money_g1 - money_e_sum) + money_e_income_sum;
<?
} else {
	//�������ƾ����
	if($com_code == "20368") echo " money_for_tax = (money_total - (money_e_sum+etc)) + money_e_income_sum; ";
	else echo " money_for_tax = (money_total - money_e_sum) + money_e_income_sum; ";
}
?>
	//money_for_tax_var = (money_total - money_e_sum) + money_e_income_sum;
	money_for_tax_var = money_for_tax;
	//�η紩�� ������ 50%
	//durunuri_50 = 1;
	//alert(durunuri);
	//1�� 40%, 2�� 60% ����
	if(f.durunuri[idx].value == "1") durunuri_50 = 0.6;
	else if(f.durunuri[idx].value == "2") durunuri_50 = 0.4;
	else durunuri_50 = 1;
	//alert(f.idx[idx].checked);
	//4�뺸�� �����Է� ����
	if(!f.manual_4insure.checked || f.idx[idx].checked) {
		//money_yun ���ο���  
		//money_yun = get_round( parseInt(money_for_tax) * 0.045 / durunuri_50 );
		money_yun = get_round( parseInt(money_for_tax) * 0.045 * durunuri_50 );
		//money_health �ǰ����� 
		//2015�� �ǰ����� ���� 3.035
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
		//money_yoyang ����纸�� 
		money_yoyang = get_round( money_health* 0.0655  );
		//money_goyong ��뺸��
		//money_goyong = get_round( parseInt(money_for_tax) * 0.0065 / durunuri_50 );
		money_goyong = get_round( parseInt(money_for_tax) * 0.0065 * durunuri_50 );
		//4�뺸�� ���� ����
		if(f.iskm[idx].value != "checked") money_yun = 0;
		if(f.isgg[idx].value != "checked") money_health = 0;
		if(f.isgg[idx].value != "checked") money_yoyang = 0;
		if(f.isgy[idx].value != "checked") money_goyong = 0;
		//if(f.isgy.value == "checked") money_goyong = 0;
	}
	//���� �����Է� ����
	if(!f.manual_tax.checked || f.idx[idx].checked) {
		//tax_so �ҵ漼
		//alert(f.check_money_so_yn[idx].value);
		if(f.check_money_so_yn[idx].value == "0" || f.check_money_so_yn[idx].value == "") {
			tax_so = GetTax( money_for_tax, idx );
		} else {
			tax_so = 0;
		}
		//����ҵ��� 3.3% ����
		if(f.check_business_yn[idx].value == "0") {
			//alert(f.money_time[idx].value);
			//money_day = toInt(f.money_time[idx].value) * 8;
			tax_so = get_round(money_for_tax* 0.03 );
			if(tax_so <= 1000) tax_so = 0;
		}
		//tax_jumin �ֹμ�
		tax_jumin = get_round(tax_so* 0.1 );
	}

	//money_gongje ������ 
	money_gongje = money_yun+money_health+money_yoyang+money_goyong+tax_so+tax_jumin+minus+minus2;
	//money_result ������ ���޾� 
	money_result = money_total - money_gongje;

	//�Ҽ��� 2�ڸ� �ݿø�
	workhour_total = workhour_total.toFixed(2);
	money_hour_ts = money_hour_ts.toFixed(2);
	//alert(money_hour_ts);

	//����ӱ�(�ð���) < �����ӱ�(2014��)
	money_min = 5210;
	if(money_hour_ts < money_min) {
		f.money_hour_ts[idx].style.color = "red";
	} else {
		f.money_hour_ts[idx].style.color = "#343434";
	}

	//õ���� ����
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

	//���� input �Է�
	//f.error_code.value = money_base;
	f.money_hour_ts[idx].value = money_hour_ts; //money_hour_ts ����ӱ�(�ð���) 
	//�⺻�ñ� 0 �� ��� ���ñ� ����
	//if(!money_time) alert(money_time);
	f.money_time[idx].value = money_time;
	f.workhour_total[idx].value = workhour_total; //workhour_total �ӱݻ��� �ѽð� mm--
<?
if(!$row3['money_month']) {
?>
	f.money_base[idx].value = money_base; //money_base �⺻��
<? } ?>
	if(f.check_money_b_yn[idx].value != "Y") {
		if(!f.manual_ext.checked) f.money_ext[idx].value = money_ext; //money_ext ����ٷμ��� 
		if(!f.manual_hday.checked) f.money_hday[idx].value = money_hday; //money_hday ���ϱٷμ��� 
		if(!f.manual_night.checked) f.money_night[idx].value = money_night; //money_night �߰��ٷμ��� 
	}
	//f.money_year[idx].value = money_year //money_year �������� ------------------------

	f.money_ext_add[idx].value = money_ext_add //money_ext ����ٷμ���(�߰�)
	f.money_hday_add[idx].value = money_hday_add //money_hday ���ϱٷμ���(�߰�)
	f.money_night_add[idx].value = money_night_add //money_night �߰��ٷμ���(�߰�)

	f.money_total[idx].value = money_total //money_total �ӱݰ� 
	f.money_for_tax[idx].value = money_for_tax //money_for_tax �����ҵ� 

	f.money_yun[idx].value = money_yun //money_yun ���ο��� 
	f.money_health[idx].value = money_health //money_health �ǰ����� 
	f.money_yoyang[idx].value = money_yoyang //money_yoyang ����纸�� 
	f.money_goyong[idx].value = money_goyong //money_goyong ��뺸�� 

	f.tax_so[idx].value = tax_so //tax_so �ҵ漼 
	f.tax_jumin[idx].value = tax_jumin //tax_jumin �ֹμ� 

	f.minus2[idx].value = minus2 //���°���
	f.etc2[idx].value = etc2 //���°���

	f.money_gongje[idx].value = money_gongje //money_gongje ������ 
	f.money_result[idx].value = money_result //money_result ������ ���޾�
	//�����ӱ� 0 �� ��� ��� 0 ����
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
//�����Է�
function pay_excel_input(url, code, year, month) {
	window.open("popup/"+url+"?code=_"+code+"?year=_"+year+"?month=_"+month, "jikjong_popup", "width=640, height=706, toolbar=no, menubar=no, scrollbars=no, resizable=no" );
}
//�޿�����
function pay_copy(url) {
	self.location.href = url+"?data=copy&amp;select_type=<?=$select_type?>&amp;search_pay_gbn=<?=$search_pay_gbn?>&amp;add_work_numb=<?=$add_work_numb?>&amp;search_year=<?=$search_year?>&amp;search_month=<?=$search_month?>&amp;copy_year="+getId('copy_year').value+"&amp;copy_month="+getId('copy_month').value;
}
//-->
</script>