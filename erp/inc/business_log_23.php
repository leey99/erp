								<table border="0" cellspacing="0" cellpadding="0"> 
									<tr>
										<td> 
											<table border="0" cellspacing="0" cellpadding="0"> 
												<tr> 
													<td><img src="images/sb_tab_on_lt.gif" alt="[" /></td> 
													<td class="Sftbutton_white" style="width:90px;text-align:center;background:url('images/sb_tab_on_bg.gif');"> 
														�ű� ���� ��Ȳ
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
//�ݿ�
$subject_ym = substr($subject_date, 0, 7);
$this_month_start = date($subject_ym.".01");
$this_month_last_day = date('t', strtotime($this_month_start));
$this_month_end = date($subject_ym).".".$this_month_last_day;
//�繫��Ź, Ű��빫
$sql_common = " from com_list_gy a, com_list_gy_opt b, com_list_gy_opt2 c where a.com_code = b.com_code and a.com_code = c.com_code ";
$sql_common .=  " and ( ( b.samu_req_date >= '$this_month_start' and b.samu_req_date <= '$this_month_end' ) or (b.easynomu_yn = 2 and c.easynomu_finish_date >= '$this_month_start' and c.easynomu_finish_date <= '$this_month_end') ) order by a.com_code desc ";
$sql = " select count(*) as cnt $sql_common ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$rows = 999;
$total_page  = ceil($total_count / $rows);
if (!$page) $page = 1;
$from_record = ($page - 1) * $rows; // ���� ���� ����
$sql = " select * $sql_common ";
//echo $sql;
$result = sql_query($sql);
$colspan = 5;
?>
								<div style="height:2px;font-size:0px" class="bbtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>

								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="">
									<tr>
										<td class="tdhead_center" width="100">����</td>
										<td class="tdhead_center" width="80">����</td>
										<td class="tdhead_center" width="80">����</td>
										<td class="tdhead_center" width="80">����</td>
										<td class="tdhead_center">���</td>
									</tr>
<?
//���� �ʱ�ȭ
$count_samu_today = 0;
$count_samu_main = 0;
$count_samu_branch = 0;

$count_kidsnomu_today = 0;
$count_kidsnomu_main = 0;
$count_kidsnomu_branch = 0;
//����Ʈ ���
for ($i=0; $row=mysql_fetch_assoc($result); $i++) {
	//�繫��Ź
	if($row['samu_req_date']) {
		if($row['samu_req_date'] == $subject_date) {
			$count_samu_today ++;
			//����
			if($row['damdang_code'] == 1) {
				$count_samu_main ++;
			} else {
				$count_samu_branch ++;
			}
			$damdang_code = (int)$row['damdang_code'];
			$count_samu_memo .= $row['com_name']."(".$man_cust_name_arry[$damdang_code].").";
		}
		//�ݿ�
		$count_samu_month ++;
		if($row['damdang_code'] == 1) {
			$count_month_samu_main ++;
		} else {
			$count_month_samu_branch ++;
		}
	}
	//Ű��빫
	if($row['easynomu_finish_date']) {
		if($row['easynomu_finish_date'] == $subject_date) {
			$count_kidsnomu_today ++;
			//����
			if($row['damdang_code'] == 1) {
				$count_kidsnomu_main ++;
			} else {
				$count_kidsnomu_branch ++;
			}
			$damdang_code = (int)$row['damdang_code'];
			$count_kidsnomu_memo .= $row['com_name']."(".$man_cust_name_arry[$damdang_code].").";
		}
		$count_kidsnomu_month ++;
		if($row['damdang_code'] == 1) {
			$count_month_kidsnomu_main ++;
		} else {
			$count_month_kidsnomu_branch ++;
		}
	}
}
$count_today_sum = $count_samu_today + $count_kidsnomu_today;
$count_main_sum = $count_samu_main + $count_kidsnomu_main;
$count_branch_sum = $count_samu_branch + $count_kidsnomu_branch;
//�ݿ�
$count_month_sum = $count_samu_month + $count_kidsnomu_month;
$count_month_main_sum = $count_month_samu_main + $count_month_kidsnomu_main;
$count_month_branch_sum = $count_month_samu_branch + $count_month_kidsnomu_branch;
?>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td class="ltrow1_center_h22">�繫��Ź</td>
										<td class="ltrow1_right_h22_padding"><?=$count_samu_today?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_samu_main?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_samu_branch?></td>
										<td class="ltrow1_left_h22" style=""><?=$count_samu_memo?></td>
									</tr>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td class="ltrow1_center_h22">Ű��빫</td>
										<td class="ltrow1_right_h22_padding"><?=$count_kidsnomu_today?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_kidsnomu_main?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_kidsnomu_branch?></td>
										<td class="ltrow1_left_h22" style=""><?=$count_kidsnomu_memo?></td>
									</tr>
									<tr>
										<td class="tdhead_center">���� �հ�</td>
										<td class="tdhead_right_padding"><?=number_format($count_today_sum)?></td>
										<td class="tdhead_right_padding"><?=number_format($count_main_sum)?></td>
										<td class="tdhead_right_padding"><?=number_format($count_branch_sum)?></td>
										<td class="tdhead_center"></td>
									</tr>
									<tr>
										<td class="tdhead_center">�ݿ� �հ�</td>
										<td class="tdhead_right_padding"><?=number_format($count_month_sum)?></td>
										<td class="tdhead_right_padding"><?=number_format($count_month_main_sum)?></td>
										<td class="tdhead_right_padding"><?=number_format($count_month_branch_sum)?></td>
										<td class="tdhead_center"></td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px"></div>

								<table border="0" cellspacing="0" cellpadding="0"> 
									<tr>
										<td> 
											<table border="0" cellspacing="0" cellpadding="0"> 
												<tr> 
													<td><img src="images/sb_tab_on_lt.gif" alt="[" /></td> 
													<td class="Sftbutton_white" style="width:90px;text-align:center;background:url('images/sb_tab_on_bg.gif');"> 
														�Ǻ����� �Ű�
													</td> 
													<td><img src="images/sb_tab_on_rt.gif" alt="]" /></td> 
												</tr> 
											</table> 
										</td> 
										<td width="6"></td> 
										<td valign="middle"></td> 
									</tr> 
								</table>

								<div style="height:2px;font-size:0px" class="bbtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>

								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="">
									<tr>
										<td class="tdhead_center" width="50">����</td>
										<td class="tdhead_center" width="68">���Ű�</td>
										<td class="tdhead_center" width="68">��ǽŰ�</td>
										<td class="tdhead_center" width="68">��������</td>
										<td class="tdhead_center" width="68">�����Ű�</td>
										<td class="tdhead_center" width="68">�Ҹ�Ű�</td>
										<td class="tdhead_center" width="68">����Ű�</td>
										<td class="tdhead_center" width="68">���ο���</td>
										<td class="tdhead_center" width="68">�����簳</td>
										<td class="tdhead_center" width="68">�����Ű�</td>
										<td class="tdhead_center" width="68">�η紩��</td>
										<td class="tdhead_center" width="68">��Ÿ</td>
										<td class="tdhead_center">�հ�</td>
									</tr>
<?
//���� �ʱ�ȭ
for($i=0; $i<=11; $i++) {
	$count_samu_insure_today[$i] = 0;
	$count_samu_insure[$i] = 0;
}
$count_samu_insure_today_sum = 0;
//�Ǻ����ڽŰ�DB
$sql_search_samu_insure = " where report_date >= '$this_month_start' and report_date <= '$this_month_end' ";
$sql_samu_insure = " select * from samu_4insure ";
$sql_samu_insure .= " $sql_search_samu_insure ";
//echo $sql_samu_insure;
$result_samu_insure = sql_query($sql_samu_insure);
for($i=0; $row_samu_insure=mysql_fetch_assoc($result_samu_insure); $i++) {
	//����
	if($row_samu_insure['report_date'] == $subject_date) {
		$report_kind = $row_samu_insure['report_kind'];
		$count_samu_insure_today[$report_kind] ++;
		$count_samu_insure_today_sum ++;
	}
	$report_kind = $row_samu_insure['report_kind'];
	$count_samu_insure[$report_kind] ++;
	$count_samu_insure_sum ++;
}
?>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td class="ltrow1_center_h22">����</td>
										<td class="ltrow1_right_h22_padding"><?=$count_samu_insure_today[1]?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_samu_insure_today[2]?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_samu_insure_today[3]?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_samu_insure_today[4]?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_samu_insure_today[5]?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_samu_insure_today[6]?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_samu_insure_today[7]?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_samu_insure_today[8]?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_samu_insure_today[9]?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_samu_insure_today[10]?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_samu_insure_today[11]?></td>
										<td class="ltrow1_right_h22_padding" style=""><?=$count_samu_insure_today_sum?></td>
									</tr>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td class="ltrow1_center_h22">�ݿ�</td>
										<td class="ltrow1_right_h22_padding"><?=$count_samu_insure[1]?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_samu_insure[2]?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_samu_insure[3]?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_samu_insure[4]?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_samu_insure[5]?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_samu_insure[6]?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_samu_insure[7]?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_samu_insure[8]?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_samu_insure[9]?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_samu_insure[10]?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_samu_insure[11]?></td>
										<td class="ltrow1_right_h22_padding" style=""><?=$count_samu_insure_sum?></td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px"></div>