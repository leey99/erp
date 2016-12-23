								<table border="0" cellspacing="0" cellpadding="0"> 
									<tr>
										<td> 
											<table border="0" cellspacing="0" cellpadding="0"> 
												<tr> 
													<td><img src="images/sb_tab_on_lt.gif" alt="[" /></td> 
													<td class="Sftbutton_white" style="width:90px;text-align:center;background:url('images/sb_tab_on_bg.gif');"> 
														신규 접수 현황
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
$this_month_last_day = date('t', strtotime($this_month_start));
$this_month_end = date($subject_ym).".".$this_month_last_day;
//사무위탁, 키즈노무
$sql_common = " from com_list_gy a, com_list_gy_opt b, com_list_gy_opt2 c where a.com_code = b.com_code and a.com_code = c.com_code ";
$sql_common .=  " and ( ( b.samu_req_date >= '$this_month_start' and b.samu_req_date <= '$this_month_end' ) or (b.easynomu_yn = 2 and c.easynomu_finish_date >= '$this_month_start' and c.easynomu_finish_date <= '$this_month_end') ) order by a.com_code desc ";
$sql = " select count(*) as cnt $sql_common ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$rows = 999;
$total_page  = ceil($total_count / $rows);
if (!$page) $page = 1;
$from_record = ($page - 1) * $rows; // 시작 열을 구함
$sql = " select * $sql_common ";
//echo $sql;
$result = sql_query($sql);
$colspan = 5;
?>
								<div style="height:2px;font-size:0px" class="bbtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>

								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="">
									<tr>
										<td class="tdhead_center" width="100">구분</td>
										<td class="tdhead_center" width="80">금일</td>
										<td class="tdhead_center" width="80">본사</td>
										<td class="tdhead_center" width="80">지사</td>
										<td class="tdhead_center">비고</td>
									</tr>
<?
//변수 초기화
$count_samu_today = 0;
$count_samu_main = 0;
$count_samu_branch = 0;

$count_kidsnomu_today = 0;
$count_kidsnomu_main = 0;
$count_kidsnomu_branch = 0;
//리스트 출력
for ($i=0; $row=mysql_fetch_assoc($result); $i++) {
	//사무위탁
	if($row['samu_req_date']) {
		if($row['samu_req_date'] == $subject_date) {
			$count_samu_today ++;
			//본사
			if($row['damdang_code'] == 1) {
				$count_samu_main ++;
			} else {
				$count_samu_branch ++;
			}
			$damdang_code = (int)$row['damdang_code'];
			$count_samu_memo .= $row['com_name']."(".$man_cust_name_arry[$damdang_code].").";
		}
		//금월
		$count_samu_month ++;
		if($row['damdang_code'] == 1) {
			$count_month_samu_main ++;
		} else {
			$count_month_samu_branch ++;
		}
	}
	//키즈노무
	if($row['easynomu_finish_date']) {
		if($row['easynomu_finish_date'] == $subject_date) {
			$count_kidsnomu_today ++;
			//본사
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
//금월
$count_month_sum = $count_samu_month + $count_kidsnomu_month;
$count_month_main_sum = $count_month_samu_main + $count_month_kidsnomu_main;
$count_month_branch_sum = $count_month_samu_branch + $count_month_kidsnomu_branch;
?>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td class="ltrow1_center_h22">사무위탁</td>
										<td class="ltrow1_right_h22_padding"><?=$count_samu_today?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_samu_main?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_samu_branch?></td>
										<td class="ltrow1_left_h22" style=""><?=$count_samu_memo?></td>
									</tr>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td class="ltrow1_center_h22">키즈노무</td>
										<td class="ltrow1_right_h22_padding"><?=$count_kidsnomu_today?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_kidsnomu_main?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_kidsnomu_branch?></td>
										<td class="ltrow1_left_h22" style=""><?=$count_kidsnomu_memo?></td>
									</tr>
									<tr>
										<td class="tdhead_center">금일 합계</td>
										<td class="tdhead_right_padding"><?=number_format($count_today_sum)?></td>
										<td class="tdhead_right_padding"><?=number_format($count_main_sum)?></td>
										<td class="tdhead_right_padding"><?=number_format($count_branch_sum)?></td>
										<td class="tdhead_center"></td>
									</tr>
									<tr>
										<td class="tdhead_center">금월 합계</td>
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
														피보험자 신고
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
										<td class="tdhead_center" width="50">구분</td>
										<td class="tdhead_center" width="68">취득신고</td>
										<td class="tdhead_center" width="68">상실신고</td>
										<td class="tdhead_center" width="68">보수변경</td>
										<td class="tdhead_center" width="68">성립신고</td>
										<td class="tdhead_center" width="68">소멸신고</td>
										<td class="tdhead_center" width="68">변경신고</td>
										<td class="tdhead_center" width="68">납부예외</td>
										<td class="tdhead_center" width="68">납부재개</td>
										<td class="tdhead_center" width="68">이직신고</td>
										<td class="tdhead_center" width="68">두루누리</td>
										<td class="tdhead_center" width="68">기타</td>
										<td class="tdhead_center">합계</td>
									</tr>
<?
//변수 초기화
for($i=0; $i<=11; $i++) {
	$count_samu_insure_today[$i] = 0;
	$count_samu_insure[$i] = 0;
}
$count_samu_insure_today_sum = 0;
//피보험자신고DB
$sql_search_samu_insure = " where report_date >= '$this_month_start' and report_date <= '$this_month_end' ";
$sql_samu_insure = " select * from samu_4insure ";
$sql_samu_insure .= " $sql_search_samu_insure ";
//echo $sql_samu_insure;
$result_samu_insure = sql_query($sql_samu_insure);
for($i=0; $row_samu_insure=mysql_fetch_assoc($result_samu_insure); $i++) {
	//금일
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
										<td class="ltrow1_center_h22">금일</td>
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
										<td class="ltrow1_center_h22">금월</td>
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