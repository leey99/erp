								<table border="0" cellspacing="0" cellpadding="0"> 
									<tr>
										<td> 
											<table border="0" cellspacing="0" cellpadding="0"> 
												<tr> 
													<td><img src="images/sb_tab_on_lt.gif" alt="[" /></td> 
													<td class="Sftbutton_white" style="width:90px;text-align:center;background:url('images/sb_tab_on_bg.gif');"> 
														금일 본사입금
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
	$sql_common = " from com_list_gy a, com_list_gy_opt b, erp_application c where a.com_code = b.com_code and a.com_code = c.com_code and ( c.application_kind != '0' and c.application_kind != '' ) and ( (c.main_receipt_date = '$subject_date') ) order by c.main_receipt_date desc ";
	$sql = " select count(*) as cnt $sql_common ";
	//echo $sql;
	$row = sql_fetch($sql);
	$total_count = $row[cnt];
	$rows = 999;
	$total_page  = ceil($total_count / $rows);
	if (!$page) $page = 1;
	$from_record = ($page - 1) * $rows; // 시작 열을 구함
	//select * from com_list_gy a, com_list_gy_opt b, erp_application c where a.com_code = b.com_code and a.com_code = c.com_code and ( c.application_kind != '0' and c.application_kind != '' ) and ( (c.main_receipt_date >= '2016.04.04' and c.main_receipt_date <= '2016.04.04') ) order by c.main_receipt_date desc limit 0, 20 
	$sql = " select * $sql_common ";
	//echo $sql;
	$result = sql_query($sql);
	$colspan = 7;
?>
								<div style="height:2px;font-size:0px" class="bbtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>

								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="">
									<tr>
										<td class="tdhead_center" width="46">No</td>
										<td class="tdhead_center">사업장명</td>
										<td class="tdhead_center" width="120">신청내용</td>
										<td class="tdhead_center" width="70">본사입금일</td>
										<td class="tdhead_center" width="80">본사입금액</td>
										<td class="tdhead_center" width="90">지점</td>
										<td class="tdhead_center" width="100">담당자</td>
									</tr>
<?
	// 리스트 출력
	for ($i=0; $row=sql_fetch_array($result); $i++) {
		$no = $total_count - $i - ($rows*($page-1));
		//거래처 코드
		$com_code = $row['com_code'];
		//위탁서래처 코드
		if($row['samu_receive_no']) {
			$samu_receive_no = "(".$row['samu_receive_no'].")";
		} else {
			$samu_receive_no = "";
		}
		//등록일자
		$regdt = $row['regdt'];
		//등록일자 색상
		if($regdt >= $search_sday && $regdt <= $search_eday) $regdt_color = "color:red";
		else $regdt_color = "";
		//신청내용
		$application_kind_code = $row['application_kind'];
		$application_kind = $support_kind_array[$application_kind_code];
		//접수일자
		if($row['application_accept']) $application_accept = $row['application_accept'];
		else $application_accept = "-";
		//접수일자 색상
		if($search_day6) {
			if($application_accept >= $search_sday && $application_accept <= $search_eday) $application_accept_color = "color:red";
			else $application_accept_color = "";
		}
		//재접수일자
		if($row['reapplication_date']) $reapplication_date = $row['reapplication_date'];
		else $reapplication_date = "-";
		//재접수일자 색상
		if($search_day1) {
			if($reapplication_date >= $search_sday && $reapplication_date <= $search_eday) $reapplication_date_color = "color:red";
			else $reapplication_date_color = "";
		}
		//우편물발송
		if($row['application_send']) $application_send = $row['application_send'];
		else $application_send = "-";
		//계약입금일
		if($row['down_payment_date']) $down_payment_date = $row['down_payment_date'];
		else $down_payment_date = "-";
		//계약금
		if($row['down_payment']) $down_payment = number_format($row['down_payment']);
		else $down_payment = "-";
		//계약금 합계
		$dpay = str_replace(',','',$row['down_payment']);
		$down_payment_sum += ($dpay);
		//업체입금일
		if($row['client_receipt_date']) $client_receipt_date = $row['client_receipt_date'];
		else $client_receipt_date = "-";
		//업체입금일 색상
		if($search_day2) {
			if($client_receipt_date >= $search_sday && $client_receipt_date <= $search_eday) $client_receipt_date_color = "color:red";
			else $client_receipt_date_color = "";
		}
		//업체입금액
		if($row['client_receipt_fee']) {
			$client_receipt_fee = number_format($row['client_receipt_fee']);
		} else {
			$client_receipt_fee = "-";
		}
		//업체입금액 합계
		$crf = str_replace(',','',$client_receipt_fee);
		$client_receipt_fee_sum += ($crf);
		//본사입금일
		if($row['main_receipt_date']) $main_receipt_date = $row['main_receipt_date'];
		else $main_receipt_date = "-";
		//본사입금일 색상
		if($search_day3) {
			if($main_receipt_date >= $search_sday && $main_receipt_date <= $search_eday) $main_receipt_date_color = "color:red";
			else $main_receipt_date_color = "";
		}
		//본사입금액
		if($row['main_receipt_fee']) {
			$main_receipt_fee = number_format($row['main_receipt_fee']);
		} else {
			$main_receipt_fee = "-";
		}
		//본사입금액 합계
		$mrf = str_replace(',','',$main_receipt_fee);
		$main_receipt_fee_sum += ($mrf);
		//사업장명
		$com_name_full = $row['com_name'];
		$com_name = cut_str($com_name_full, 28, "..");
		//관리점
		$damdang_code = $row['damdang_code'];
		if($damdang_code) $branch = $man_cust_name_arry[$damdang_code];
		else $branch = "-";
		$damdang_code2 = $row['damdang_code2'];
		if($damdang_code2) $branch = $man_cust_name_arry[$damdang_code2];
		//담당매니저
		$manage_cust_name = $row['manage_cust_name'];
		//링크 URL
		if($member['mb_level'] > 6 || $row['damdang_code'] == $member['mb_profile']) {
			$com_view = "client_application_view.php?id=$com_code&w=u&$qstr&page=$page";
		} else {
			$com_view = "javascript:alert('해당 거래처 정보를 열람할 권한이 없습니다.');";
		}
?>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td class="ltrow1_center_h22"><?=$no?></td>
										<td class="ltrow1_left_h22" title="<?=$com_name_full?>">
											<a href="<?=$com_view?>" style="font-weight:bold" target="_blank"><?=$com_name?></a>
										</td>
										<td class="ltrow1_left_h22" style=""><?=$application_kind?></td>
										<td class="ltrow1_right_h22_padding"><?=$main_receipt_date?></td>
										<td class="ltrow1_right_h22_padding"><?=$main_receipt_fee?></td>
										<td class="ltrow1_center_h22"><?=$branch?></td>
										<td class="ltrow1_center_h22"><?=$manage_cust_name?></td>
									</tr>
<?
	}
	if ($i == 0)
			echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' class=\"ltrow1_center_h22\">자료가 없습니다.</td></tr>";
?>
									<tr>
										<td class="tdhead_center"></td>
										<td class="tdhead_center" colspan="2">금일 합계</td>
										<td class="tdhead_center"></td>
										<td class="tdhead_right_padding"><?=number_format($main_receipt_fee_sum)?></td>
										<td class="tdhead_center"></td>
										<td class="tdhead_center"></td>
									</tr>
<?
//금월 합계
$subject_ym = substr($subject_date, 0, 7);
$this_month_start = date($subject_ym.".01");
$this_month_last_day = date('t', strtotime($this_month_start));
$this_month_end = date($subject_ym).".".$this_month_last_day;
//전월 날짜 계산 160908
$this_month_start_arry = explode(".", $this_month_start);
$pre_month_start = date("Y.m", strtotime($this_month_start_arry[0]."-".$this_month_start_arry[1]."-".$this_month_start_arry[1]." - 1 months")).".01";
//echo $pre_month_start;
$pre_month_last_day = date('t', strtotime($pre_month_start));
$pre_month_yn = substr($pre_month_start, 0, 7);
$pre_month_end = date($pre_month_yn).".".$pre_month_last_day;

//$sql_where = " and ( (c.main_receipt_date >= '$this_month_start' and c.main_receipt_date <= '$this_month_end') ) ";
//검색 기간 종료일을 기안일로 설정, 부장님 의견 160510
$sql_where = " and ( (c.main_receipt_date >= '$this_month_start' and c.main_receipt_date <= '$subject_date') ) ";
$sql_common = " from com_list_gy a, com_list_gy_opt b, erp_application c where a.com_code = b.com_code and a.com_code = c.com_code and ( c.application_kind != '0' and c.application_kind != '' ) $sql_where ";
$sql = " select sum(main_receipt_fee) as sum $sql_common ";
$row = sql_fetch($sql);
$main_receipt_fee_sum_month = $row['sum'];
?>
									<tr>
										<td class="tdhead_center"></td>
										<td class="tdhead_center" colspan="2">금월 합계</td>
										<td class="tdhead_center"></td>
										<td class="tdhead_right_padding"><?=number_format($main_receipt_fee_sum_month)?></td>
										<td class="tdhead_center"></td>
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
														지원금 접수
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
	//금월 합계(신청금액)
	$sql_where = " and ( (c.application_accept >= '$this_month_start' and c.application_accept <= '$subject_date') ) ";
	$sql_where .= " and ( c.reapplication_done != 2 and c.reapplication_done != 3 ) ";
	//전기요금컨설팅 제외(전정애) 160701
	$sql_common = " from com_list_gy a, com_list_gy_opt b, erp_application c where a.com_code = b.com_code and a.com_code = c.com_code and ( c.application_kind != '0' and c.application_kind != '' and c.application_kind != 23 ) $sql_where ";
	$sql = " select sum(application_fee_sum) as sum $sql_common ";
	//echo $sql;
	$row = sql_fetch($sql);
	$application_fee_sum_sum_month = $row['sum'];
	//누적 합계 160502 / 최종완료 1완료 2반려 3취소 제외 160630
	$sql_where = " and ( c.reapplication_done != 1 and c.reapplication_done != 2 and c.reapplication_done != 3 ) ";
	$sql_common = " from com_list_gy a, com_list_gy_opt b, erp_application c where a.com_code = b.com_code and a.com_code = c.com_code and ( c.application_kind != '0' and c.application_kind != '' and c.application_kind != 23 ) $sql_where ";
	$sql = " select sum(application_fee_sum) as sum $sql_common ";
	//echo $sql;
	$row = sql_fetch($sql);
	$application_fee_sum_sum_total = $row['sum'];

	//select * from com_list_gy a, com_list_gy_opt b, erp_application c where a.com_code = b.com_code and a.com_code = c.com_code and ( c.application_kind != '0' and c.application_kind != '' ) and ( (c.application_accept >= '2016.04.04' and c.application_accept <= '2016.04.04') ) order by c.application_accept desc
	$sql_common = " from com_list_gy a, com_list_gy_opt b, erp_application c where a.com_code = b.com_code and a.com_code = c.com_code and ( c.application_kind != '0' and c.application_kind != '' ) and ( (c.application_accept = '$subject_date') ) order by c.application_accept desc ";
	$sql = " select count(*) as cnt $sql_common ";
	//echo $sql;
	$row = sql_fetch($sql);
	$total_count = $row[cnt];
	$rows = 999;
	$total_page  = ceil($total_count / $rows);
	if (!$page) $page = 1;
	$from_record = ($page - 1) * $rows; // 시작 열을 구함
	$sql = " select * $sql_common ";
	//echo $sql;
	$result = sql_query($sql);
	$colspan = 7;
?>
								<div style="height:2px;font-size:0px" class="bbtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>

								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="">
									<tr>
										<td class="tdhead_center" width="46">No</td>
										<td class="tdhead_center">사업장명</td>
										<td class="tdhead_center" width="120">신청내용</td>
										<td class="tdhead_center" width="70">접수일자</td>
										<td class="tdhead_center" width="90">신청금액</td>
										<td class="tdhead_center" width="90">지점</td>
										<td class="tdhead_center" width="100">담당자</td>
									</tr>
<?
	//합계 초기화
	$application_fee_sum_sum = 0;
	// 리스트 출력
	for ($i=0; $row=sql_fetch_array($result); $i++) {
		//$no = $total_count - $i - ($rows*($page-1));
		$no = $i + 1;
		//거래처 코드
		$com_code = $row['com_code'];
		//위탁서래처 코드
		if($row['samu_receive_no']) {
			$samu_receive_no = "(".$row['samu_receive_no'].")";
		} else {
			$samu_receive_no = "";
		}
		//등록일자
		$regdt = $row['regdt'];
		//등록일자 색상
		if($regdt >= $search_sday && $regdt <= $search_eday) $regdt_color = "color:red";
		else $regdt_color = "";
		//신청내용
		$application_kind_code = $row['application_kind'];
		$application_kind = $support_kind_array[$application_kind_code];
		//신청예상금액 / 매출예상금액
		if($row['application_fee_sum']) {
			$application_fee_sum = number_format($row['application_fee_sum']);
		} else {
			$application_fee_sum = "-";
		}
		if($row['application_fee_sum']) {
			if($row['p_support']) $application_fee_expect = number_format($row['application_fee_sum']*($row['p_support']/100));
			else $application_fee_expect = "-";
		} else {
			$application_fee_expect = "-";
		}
		//신청금액 / 매출금액 합계
		$afs = str_replace(',','',$application_fee_sum);
		$application_fee_sum_sum += ($afs);
		$afe = str_replace(',','',$application_fee_expect);
		$application_fee_expect_sum += ($afe);
		//접수일자
		if($row['application_accept']) $application_accept = $row['application_accept'];
		else $application_accept = "-";
		//접수일자 색상
		if($search_day6) {
			if($application_accept >= $search_sday && $application_accept <= $search_eday) $application_accept_color = "color:red";
			else $application_accept_color = "";
		}
		//재접수일자
		if($row['reapplication_date']) $reapplication_date = $row['reapplication_date'];
		else $reapplication_date = "-";
		//재접수일자 색상
		if($search_day1) {
			if($reapplication_date >= $search_sday && $reapplication_date <= $search_eday) $reapplication_date_color = "color:red";
			else $reapplication_date_color = "";
		}
		//사업장명
		$com_name_full = $row['com_name'];
		$com_name = cut_str($com_name_full, 28, "..");
		//관리점
		$damdang_code = $row['damdang_code'];
		if($damdang_code) $branch = $man_cust_name_arry[$damdang_code];
		else $branch = "-";
		$damdang_code2 = $row['damdang_code2'];
		if($damdang_code2) $branch = $man_cust_name_arry[$damdang_code2];
		//담당매니저
		$manage_cust_name = $row['manage_cust_name'];
		//최종완료
		$reapplication_done_code = $row['reapplication_done'];
		$reapplication_done = $reapplication_done_array[$reapplication_done_code];
		if(!$reapplication_done) $reapplication_done = "-";
		//링크 URL
		if($member['mb_level'] > 6 || $row['damdang_code'] == $member['mb_profile']) {
			$com_view = "client_application_view.php?id=$com_code&w=u&$qstr&page=$page";
		} else {
			$com_view = "javascript:alert('해당 거래처 정보를 열람할 권한이 없습니다.');";
		}
?>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td class="ltrow1_center_h22"><?=$no?></td>
										<td class="ltrow1_left_h22" title="<?=$com_name_full?>">
											<a href="<?=$com_view?>" style="font-weight:bold" target="_blank"><?=$com_name?></a>
										</td>
										<td class="ltrow1_left_h22" style=""><?=$application_kind?></td>
										<td class="ltrow1_right_h22_padding"><?=$application_accept?></td>
										<td class="ltrow1_right_h22_padding"><?=$application_fee_sum?></td>
										<td class="ltrow1_center_h22"><?=$branch?></td>
										<td class="ltrow1_center_h22"><?=$manage_cust_name?></td>
									</tr>
<?
	}
	if ($i == 0)
			echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' class=\"ltrow1_center_h22\">자료가 없습니다.</td></tr>";
?>
									<tr>
										<td class="tdhead_center"></td>
										<td class="tdhead_center" colspan="2">금일 합계</td>
										<td class="tdhead_center"></td>
										<td class="tdhead_right_padding"><?=number_format($application_fee_sum_sum)?></td>
										<td class="tdhead_center"></td>
										<td class="tdhead_center"></td>
									</tr>
									<tr>
										<td class="tdhead_center"></td>
										<td class="tdhead_center" colspan="2">금월 합계</td>
										<td class="tdhead_center"></td>
										<td class="tdhead_right_padding"><?=number_format($application_fee_sum_sum_month)?></td>
										<td class="tdhead_center"></td>
										<td class="tdhead_center"></td>
									</tr>
									<tr>
										<td class="tdhead_center"></td>
										<td class="tdhead_center" colspan="2">누적 합계</td>
										<td class="tdhead_center"></td>
										<td class="tdhead_right_padding"><?=number_format($application_fee_sum_sum_total)?></td>
										<td class="tdhead_center"></td>
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
													<td class="Sftbutton_white" style="width:100px;text-align:center;background:url('images/sb_tab_on_bg.gif');"> 
														전기요금컨설팅
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
	//금월 합계(계약금액)
	$sql_where = " and ( (c.down_payment_date >= '$this_month_start' and c.down_payment_date <= '$subject_date') ) ";
	$sql_where .= " and ( c.reapplication_done != 2 and c.reapplication_done != 3 ) ";
	$sql_common = " from com_list_gy a, com_list_gy_opt b, erp_application c where a.com_code = b.com_code and a.com_code = c.com_code and ( c.application_kind = 23 ) $sql_where ";
	$sql = " select sum(application_fee_sum) as sum, sum(down_payment) as sum2 $sql_common ";
	//echo $sql;
	$row = sql_fetch($sql);
	$application_fee_sum_month = $row['sum'];
	$down_payment_month = $row['sum2'];

	//전월 합계(계약금액)
	$sql_where = " and ( (c.down_payment_date >= '$pre_month_start' and c.down_payment_date <= '$pre_month_end') ) ";
	$sql_where .= " and ( c.reapplication_done != 2 and c.reapplication_done != 3 ) ";
	$sql_common = " from com_list_gy a, com_list_gy_opt b, erp_application c where a.com_code = b.com_code and a.com_code = c.com_code and ( c.application_kind = 23 ) $sql_where ";
	$sql = " select sum(application_fee_sum) as sum, sum(down_payment) as sum2 $sql_common ";
	//echo $sql;
	$row = sql_fetch($sql);
	$application_fee_sum_month_pre = $row['sum'];
	$down_payment_month_pre = $row['sum2'];

	//누적 합계 160502 / 최종완료 1완료(포함 161028) 2반려 3취소 제외 160630
	$sql_where = " and ( c.reapplication_done != 2 and c.reapplication_done != 3 ) ";
	$sql_common = " from com_list_gy a, com_list_gy_opt b, erp_application c where a.com_code = b.com_code and a.com_code = c.com_code and ( c.application_kind = 23 ) $sql_where ";
	$sql = " select sum(application_fee_sum) as sum, sum(down_payment) as sum2 $sql_common ";
	$row = sql_fetch($sql);
	$application_fee_sum_total = $row['sum'];
	$down_payment_total = $row['sum2'];

	$sql_common = " from com_list_gy a, com_list_gy_opt b, erp_application c where a.com_code = b.com_code and a.com_code = c.com_code and ( c.application_kind = 23 ) and ( (c.down_payment_date = '$subject_date') ) order by c.down_payment_date desc ";
	$sql = " select count(*) as cnt $sql_common ";
	//echo $sql;
	$row = sql_fetch($sql);
	$total_count = $row[cnt];
	$rows = 999;
	$total_page  = ceil($total_count / $rows);
	if (!$page) $page = 1;
	$from_record = ($page - 1) * $rows; // 시작 열을 구함
	$sql = " select * $sql_common ";
	//echo $sql;
	$result = sql_query($sql);
	$colspan = 7;
?>
								<div style="height:2px;font-size:0px" class="bbtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>

								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="">
									<tr>
										<td class="tdhead_center" width="46">No</td>
										<td class="tdhead_center">사업장명</td>
										<td class="tdhead_center" width="120">전체 수수료</td>
										<td class="tdhead_center" width="70">입금일자</td>
										<td class="tdhead_center" width="90">계약금액</td>
										<td class="tdhead_center" width="90">지점</td>
										<td class="tdhead_center" width="100">담당자</td>
									</tr>
<?
	//합계 초기화
	$application_fee_sum_sum = 0;
	$down_payment_sum = 0;
	// 리스트 출력
	for ($i=0; $row=sql_fetch_array($result); $i++) {
		$no = $i + 1;
		//거래처 코드
		$com_code = $row['com_code'];
		//위탁서래처 코드
		if($row['samu_receive_no']) {
			$samu_receive_no = "(".$row['samu_receive_no'].")";
		} else {
			$samu_receive_no = "";
		}
		//등록일자
		$regdt = $row['regdt'];
		//등록일자 색상
		if($regdt >= $search_sday && $regdt <= $search_eday) $regdt_color = "color:red";
		else $regdt_color = "";
		//신청내용
		$application_kind_code = $row['application_kind'];
		$application_kind = $support_kind_array[$application_kind_code];
		//계약금 금일 누적 160701
		$down_payment = number_format($row['down_payment']);
		$dps = str_replace(',','',$down_payment);
		$down_payment_sum += ($dps);
		//계약금
		if($row['down_payment']) {
			$down_payment = number_format($row['down_payment']);
		} else {
			$down_payment = "-";
		}
		//신청금액
		$application_fee_sum = number_format($row['application_fee_sum']);
		$afs = str_replace(',','',$application_fee_sum);
		//echo $afs." ";
		$application_fee_sum_sum += ($afs);
		//접수일자
		if($row['down_payment_date']) $down_payment_date = $row['down_payment_date'];
		else $down_payment_date = "-";
		//접수일자 색상
		if($search_day6) {
			if($down_payment_date >= $search_sday && $down_payment_date <= $search_eday) $down_payment_date_color = "color:red";
			else $down_payment_date_color = "";
		}
		//재접수일자
		if($row['reapplication_date']) $reapplication_date = $row['reapplication_date'];
		else $reapplication_date = "-";
		//재접수일자 색상
		if($search_day1) {
			if($reapplication_date >= $search_sday && $reapplication_date <= $search_eday) $reapplication_date_color = "color:red";
			else $reapplication_date_color = "";
		}
		//사업장명
		$com_name_full = $row['com_name'];
		$com_name = cut_str($com_name_full, 28, "..");
		//관리점
		$damdang_code = $row['damdang_code'];
		if($damdang_code) $branch = $man_cust_name_arry[$damdang_code];
		else $branch = "-";
		$damdang_code2 = $row['damdang_code2'];
		if($damdang_code2) $branch = $man_cust_name_arry[$damdang_code2];
		//담당매니저
		$manage_cust_name = $row['manage_cust_name'];
		//최종완료
		$reapplication_done_code = $row['reapplication_done'];
		$reapplication_done = $reapplication_done_array[$reapplication_done_code];
		if(!$reapplication_done) $reapplication_done = "-";
		//링크 URL
		if($member['mb_level'] > 6 || $row['damdang_code'] == $member['mb_profile']) {
			$com_view = "client_application_view.php?id=$com_code&w=u&$qstr&page=$page";
		} else {
			$com_view = "javascript:alert('해당 거래처 정보를 열람할 권한이 없습니다.');";
		}
?>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td class="ltrow1_center_h22"><?=$no?></td>
										<td class="ltrow1_left_h22" title="<?=$com_name_full?>">
											<a href="<?=$com_view?>" style="font-weight:bold" target="_blank"><?=$com_name?></a>
										</td>
										<td class="ltrow1_right_h22_padding"><?=$application_fee_sum?></td>
										<td class="ltrow1_right_h22_padding"><?=$down_payment_date?></td>
										<td class="ltrow1_right_h22_padding"><?=$down_payment?></td>
										<td class="ltrow1_center_h22"><?=$branch?></td>
										<td class="ltrow1_center_h22"><?=$manage_cust_name?></td>
									</tr>
<?
	}
	if ($i == 0)
			echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' class=\"ltrow1_center_h22\">자료가 없습니다.</td></tr>";
?>
									<tr>
										<td class="tdhead_center"></td>
										<td class="tdhead_center" colspan="1">금일 합계</td>
										<td class="tdhead_right_padding"><?=number_format($application_fee_sum_sum)?></td>
										<td class="tdhead_center"></td>
										<td class="tdhead_right_padding"><?=number_format($down_payment_sum)?></td>
										<td class="tdhead_center"></td>
										<td class="tdhead_center"></td>
									</tr>
									<tr>
										<td class="tdhead_center"></td>
										<td class="tdhead_center" colspan="1">전월 합계</td>
										<td class="tdhead_right_padding"><?=number_format($application_fee_sum_month_pre)?></td>
										<td class="tdhead_center"></td>
										<td class="tdhead_right_padding"><?=number_format($down_payment_month_pre)?></td>
										<td class="tdhead_center"></td>
										<td class="tdhead_center"></td>
									</tr>
									<tr>
										<td class="tdhead_center"></td>
										<td class="tdhead_center" colspan="1">금월 합계</td>
										<td class="tdhead_right_padding"><?=number_format($application_fee_sum_month)?></td>
										<td class="tdhead_center"></td>
										<td class="tdhead_right_padding"><?=number_format($down_payment_month)?></td>
										<td class="tdhead_center"></td>
										<td class="tdhead_center"></td>
									</tr>
									<tr>
										<td class="tdhead_center"></td>
										<td class="tdhead_center" colspan="1">누적 합계</td>
										<td class="tdhead_right_padding"><?=number_format($application_fee_sum_total)?></td>
										<td class="tdhead_center"></td>
										<td class="tdhead_right_padding"><?=number_format($down_payment_total)?></td>
										<td class="tdhead_center"></td>
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
														지원금 취소
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
	$sql_common = " from com_list_gy a, com_list_gy_opt b, erp_application c where a.com_code = b.com_code and a.com_code = c.com_code and ( c.application_kind != '0' and c.application_kind != '' ) and ( (c.cancel_date = '$subject_date') ) order by c.cancel_date desc ";
	$sql = " select count(*) as cnt $sql_common ";
	//echo $sql;
	$row = sql_fetch($sql);
	$total_count = $row[cnt];
	$rows = 999;
	$total_page  = ceil($total_count / $rows);
	if (!$page) $page = 1;
	$from_record = ($page - 1) * $rows; // 시작 열을 구함
	$sql = " select * $sql_common ";
	//echo $sql;
	$result = sql_query($sql);
	$colspan = 8;
?>
								<div style="height:2px;font-size:0px" class="bbtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>

								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="">
									<tr>
										<td class="tdhead_center" width="46">No</td>
										<td class="tdhead_center">사업장명</td>
										<td class="tdhead_center" width="120">신청내용</td>
										<td class="tdhead_center" width="70">접수일자</td>
										<td class="tdhead_center" width="80">신청금액</td>
										<td class="tdhead_center" width="90">지점</td>
										<td class="tdhead_center" width="100">담당자</td>
										<td class="tdhead_center" width="100">비고</td>
									</tr>
<?
	//합계 초기화
	$application_fee_sum_sum = 0;
	// 리스트 출력
	for ($i=0; $row=sql_fetch_array($result); $i++) {
		$no = $i + 1;
		//거래처 코드
		$com_code = $row['com_code'];
		//위탁서래처 코드
		if($row['samu_receive_no']) {
			$samu_receive_no = "(".$row['samu_receive_no'].")";
		} else {
			$samu_receive_no = "";
		}
		//등록일자
		$regdt = $row['regdt'];
		//등록일자 색상
		if($regdt >= $search_sday && $regdt <= $search_eday) $regdt_color = "color:red";
		else $regdt_color = "";
		//신청내용
		$application_kind_code = $row['application_kind'];
		$application_kind = $support_kind_array[$application_kind_code];
		//신청예상금액 / 매출예상금액
		if($row['application_fee_sum']) {
			$application_fee_sum = number_format($row['application_fee_sum']);
		} else {
			$application_fee_sum = "-";
		}
		if($row['application_fee_sum']) {
			if($row['p_support']) $application_fee_expect = number_format($row['application_fee_sum']*($row['p_support']/100));
			else $application_fee_expect = "-";
		} else {
			$application_fee_expect = "-";
		}
		//신청금액 / 매출금액 합계
		$afs = str_replace(',','',$application_fee_sum);
		$application_fee_sum_sum += ($afs);
		$afe = str_replace(',','',$application_fee_expect);
		$application_fee_expect_sum += ($afe);
		//접수일자
		if($row['application_accept']) $application_accept = $row['application_accept'];
		else $application_accept = "-";
		//접수일자 색상
		if($search_day6) {
			if($application_accept >= $search_sday && $application_accept <= $search_eday) $application_accept_color = "color:red";
			else $application_accept_color = "";
		}
		//재접수일자
		if($row['reapplication_date']) $reapplication_date = $row['reapplication_date'];
		else $reapplication_date = "-";
		//재접수일자 색상
		if($search_day1) {
			if($reapplication_date >= $search_sday && $reapplication_date <= $search_eday) $reapplication_date_color = "color:red";
			else $reapplication_date_color = "";
		}
		//사업장명
		$com_name_full = $row['com_name'];
		$com_name = cut_str($com_name_full, 28, "..");
		//최종완료 : 반려, 취소, 이관
		if($row['reapplication_done'] == 2) $reapplication_done_return = "반려";
		else if($row['reapplication_done'] == 3) $reapplication_done_return = "취소";
		else $reapplication_done_return = "";
		//관리점
		$damdang_code = $row['damdang_code'];
		if($damdang_code) $branch = $man_cust_name_arry[$damdang_code];
		else $branch = "-";
		$damdang_code2 = $row['damdang_code2'];
		if($damdang_code2) $branch = $man_cust_name_arry[$damdang_code2];
		//담당매니저
		$manage_cust_name = $row['manage_cust_name'];
		//최종완료
		$reapplication_done_code = $row['reapplication_done'];
		$reapplication_done = $reapplication_done_array[$reapplication_done_code];
		if(!$reapplication_done) $reapplication_done = "-";
		//링크 URL
		if($member['mb_level'] > 6 || $row['damdang_code'] == $member['mb_profile']) {
			$com_view = "client_application_view.php?id=$com_code&w=u&$qstr&page=$page";
		} else {
			$com_view = "javascript:alert('해당 거래처 정보를 열람할 권한이 없습니다.');";
		}
?>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td class="ltrow1_center_h22"><?=$no?></td>
										<td class="ltrow1_left_h22" title="<?=$com_name_full?>">
											<a href="<?=$com_view?>" style="font-weight:bold" target="_blank"><?=$com_name?></a>
										</td>
										<td class="ltrow1_left_h22" style=""><?=$application_kind?></td>
										<td class="ltrow1_right_h22_padding"><?=$application_accept?></td>
										<td class="ltrow1_right_h22_padding"><?=$application_fee_sum?></td>
										<td class="ltrow1_center_h22"><?=$branch?></td>
										<td class="ltrow1_center_h22"><?=$manage_cust_name?></td>
										<td class="ltrow1_center_h22"><?=$reapplication_done_return?></td>
									</tr>
<?
	}
	if ($i == 0)
			echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' class=\"ltrow1_center_h22\">자료가 없습니다.</td></tr>";
?>
									<tr>
										<td class="tdhead_center"></td>
										<td class="tdhead_center" colspan="2">합계(신청금액)</td>
										<td class="tdhead_center"></td>
										<td class="tdhead_right_padding"><?=number_format($application_fee_sum_sum)?></td>
										<td class="tdhead_center"></td>
										<td class="tdhead_center"></td>
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
														거래명세서 발행
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
	$sql_common = " from com_list_gy a, com_list_gy_opt b, erp_application c where a.com_code = b.com_code and a.com_code = c.com_code and ( c.application_kind != '0' and c.application_kind != '' ) and ( (c.statement_date = '$subject_date') ) order by c.statement_date desc ";
	$sql = " select count(*) as cnt $sql_common ";
	//echo $sql;
	$row = sql_fetch($sql);
	$total_count = $row[cnt];
	$rows = 999;
	$total_page  = ceil($total_count / $rows);
	if (!$page) $page = 1;
	$from_record = ($page - 1) * $rows; // 시작 열을 구함
	$sql = " select * $sql_common ";
	//echo $sql;
	$result = sql_query($sql);
	$colspan = 7;
?>
								<div style="height:2px;font-size:0px" class="bbtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>

								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="">
									<tr>
										<td class="tdhead_center" width="46">No</td>
										<td class="tdhead_center">사업장명</td>
										<td class="tdhead_center" width="120">신청내용</td>
										<td class="tdhead_center" width="70">발행일</td>
										<td class="tdhead_center" width="80">청구금액</td>
										<td class="tdhead_center" width="90">지점</td>
										<td class="tdhead_center" width="100">담당자</td>
									</tr>
<?
	// 리스트 출력
	for ($i=0; $row=sql_fetch_array($result); $i++) {
		$no = $i + 1;
		//거래처 코드
		$com_code = $row['com_code'];
		//신청내용
		$application_kind_code = $row['application_kind'];
		$application_kind = $support_kind_array[$application_kind_code];
		//거래명세서
		if($row['statement_date']) $statement_date = $row['statement_date'];
		else $statement_date = "-";
		//거래명세서 색상
		if($search_day4) {
			if($statement_date >= $search_sday && $statement_date <= $search_eday) $statement_date_color = "color:red";
			else $statement_date_color = "";
		}
		//사업장명
		$com_name_full = $row['com_name'];
		$com_name = cut_str($com_name_full, 28, "..");
		//관리점
		$damdang_code = $row['damdang_code'];
		if($damdang_code) $branch = $man_cust_name_arry[$damdang_code];
		else $branch = "-";
		$damdang_code2 = $row['damdang_code2'];
		if($damdang_code2) $branch = $man_cust_name_arry[$damdang_code2];
		//담당매니저
		$manage_cust_name = $row['manage_cust_name'];
		//링크 URL
		if($member['mb_level'] > 6 || $row['damdang_code'] == $member['mb_profile']) {
			$com_view = "client_application_view.php?id=$com_code&w=u&$qstr&page=$page";
		} else {
			$com_view = "javascript:alert('해당 거래처 정보를 열람할 권한이 없습니다.');";
		}
		//청구금액
		if($row['requested_amount']) {
			$requested_amount = number_format($row['requested_amount']);
		} else {
			$requested_amount = "-";
		}
		//청구금액 합계
		$rqst = str_replace(',','',$requested_amount);
		$requested_amount_sum += ($rqst);
?>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td class="ltrow1_center_h22"><?=$no?></td>
										<td class="ltrow1_left_h22" title="<?=$com_name_full?>">
											<a href="<?=$com_view?>" style="font-weight:bold" target="_blank"><?=$com_name?></a>
										</td>
										<td class="ltrow1_left_h22" style=""><?=$application_kind?></td>
										<td class="ltrow1_right_h22_padding"><?=$statement_date?></td>
										<td class="ltrow1_right_h22_padding"><?=$requested_amount?></td>
										<td class="ltrow1_center_h22"><?=$branch?></td>
										<td class="ltrow1_center_h22"><?=$manage_cust_name?></td>
									</tr>
<?
	}
	if ($i == 0)
			echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' class=\"ltrow1_center_h22\">자료가 없습니다.</td></tr>";
?>
									<tr>
										<td class="tdhead_center"></td>
										<td class="tdhead_center" colspan="2">합계(청구금액)</td>
										<td class="tdhead_center"></td>
										<td class="tdhead_right_padding"><?=number_format($requested_amount_sum)?></td>
										<td class="tdhead_center"></td>
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
														세금계산서 발행
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
	$sql_common = " from com_list_gy a, com_list_gy_opt b, erp_application c where a.com_code = b.com_code and a.com_code = c.com_code and ( c.application_kind != '0' and c.application_kind != '' ) and ( (c.tax_invoice = '$subject_date') ) order by c.tax_invoice desc ";
	$sql = " select count(*) as cnt $sql_common ";
	//echo $sql;
	$row = sql_fetch($sql);
	$total_count = $row[cnt];
	$rows = 999;
	$total_page  = ceil($total_count / $rows);
	if (!$page) $page = 1;
	$from_record = ($page - 1) * $rows; // 시작 열을 구함
	$sql = " select * $sql_common ";
	//echo $sql;
	$result = sql_query($sql);
	$colspan = 7;
?>
								<div style="height:2px;font-size:0px" class="bbtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>

								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="">
									<tr>
										<td class="tdhead_center" width="46">No</td>
										<td class="tdhead_center">사업장명</td>
										<td class="tdhead_center" width="120">신청내용</td>
										<td class="tdhead_center" width="70">발행일</td>
										<td class="tdhead_center" width="80">청구금액</td>
										<td class="tdhead_center" width="90">지점</td>
										<td class="tdhead_center" width="100">담당자</td>
									</tr>
<?
	//합계 초기화
	$requested_amount_sum = 0;
	// 리스트 출력
	for ($i=0; $row=sql_fetch_array($result); $i++) {
		$no = $i + 1;
		//거래처 코드
		$com_code = $row['com_code'];
		//신청내용
		$application_kind_code = $row['application_kind'];
		$application_kind = $support_kind_array[$application_kind_code];
		//세금계산서
		if($row['tax_invoice']) $tax_invoice = $row['tax_invoice'];
		else $tax_invoice = "-";
		//사업장명
		$com_name_full = $row['com_name'];
		$com_name = cut_str($com_name_full, 28, "..");
		//관리점
		$damdang_code = $row['damdang_code'];
		if($damdang_code) $branch = $man_cust_name_arry[$damdang_code];
		else $branch = "-";
		$damdang_code2 = $row['damdang_code2'];
		if($damdang_code2) $branch = $man_cust_name_arry[$damdang_code2];
		//담당매니저
		$manage_cust_name = $row['manage_cust_name'];
		//링크 URL
		if($member['mb_level'] > 6 || $row['damdang_code'] == $member['mb_profile']) {
			$com_view = "client_application_view.php?id=$com_code&w=u&$qstr&page=$page";
		} else {
			$com_view = "javascript:alert('해당 거래처 정보를 열람할 권한이 없습니다.');";
		}
		//청구금액
		if($row['requested_amount']) {
			$requested_amount = number_format($row['requested_amount']);
		} else {
			$requested_amount = "-";
		}
		//청구금액 합계
		$rqst = str_replace(',','',$requested_amount);
		$requested_amount_sum += ($rqst);
?>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td class="ltrow1_center_h22"><?=$no?></td>
										<td class="ltrow1_left_h22" title="<?=$com_name_full?>">
											<a href="<?=$com_view?>" style="font-weight:bold" target="_blank"><?=$com_name?></a>
										</td>
										<td class="ltrow1_left_h22" style=""><?=$application_kind?></td>
										<td class="ltrow1_right_h22_padding"><?=$tax_invoice?></td>
										<td class="ltrow1_right_h22_padding"><?=$requested_amount?></td>
										<td class="ltrow1_center_h22"><?=$branch?></td>
										<td class="ltrow1_center_h22"><?=$manage_cust_name?></td>
									</tr>
<?
	}
	if ($i == 0)
			echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' class=\"ltrow1_center_h22\">자료가 없습니다.</td></tr>";
?>
									<tr>
										<td class="tdhead_center"></td>
										<td class="tdhead_center" colspan="2">합계(청구금액)</td>
										<td class="tdhead_center"></td>
										<td class="tdhead_right_padding"><?=number_format($requested_amount_sum)?></td>
										<td class="tdhead_center"></td>
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
														미수금 현황
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
	//$sql_common = " from com_list_gy a, com_list_gy_opt b, erp_application c where a.com_code = b.com_code and a.com_code = c.com_code and ( c.application_kind != '0' and c.application_kind != '' ) and c.main_receipt_date = '' and ( c.reapplication_done = '' or c.reapplication_done = '1' or c.reapplication_done = '4' ) and ( ( c.application_kind = '23' and c.client_receipt_fee = '' ) or ( c.application_kind != '23' and c.client_receipt_fee != '' ) ) and c.statement_date != '' order by c.statement_date desc , c.com_code desc ";
	$sql_common = " from com_list_gy a, com_list_gy_opt b, erp_application c where a.com_code = b.com_code and a.com_code = c.com_code and ( c.application_kind != '0' and c.application_kind != '' ) and c.main_receipt_date = '' and ( c.reapplication_done = '' or c.reapplication_done = '1' or c.reapplication_done = '4' ) and ( ( c.application_kind = '23' ) or ( c.application_kind != '23' and c.client_receipt_fee != '' ) ) and c.statement_date != '' order by c.statement_date desc , c.com_code desc ";
	$sql = " select count(*) as cnt $sql_common ";
	//echo $sql;
	$row = sql_fetch($sql);
	$total_count = $row[cnt];
	$rows = 999;
	$total_page  = ceil($total_count / $rows);
	if (!$page) $page = 1;
	$from_record = ($page - 1) * $rows; // 시작 열을 구함
	$sql = " select * $sql_common ";
	//echo $sql;
	$result = sql_query($sql);
	$colspan = 7;
?>
								<div style="height:2px;font-size:0px" class="bbtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>

								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="">
									<tr>
										<td class="tdhead_center" width="46">No</td>
										<td class="tdhead_center">사업장명</td>
										<td class="tdhead_center" width="120">신청내용</td>
										<td class="tdhead_center" width="70">청구일자</td>
										<td class="tdhead_center" width="80">청구금액</td>
										<td class="tdhead_center" width="90">지점</td>
										<td class="tdhead_center" width="70">세금계산서</td>
										<td class="tdhead_center" width="130">비고</td>
									</tr>
<?
	//합계 초기화
	$requested_amount_sum = 0;
	$client_receipt_fee_sum = 0;
	// 리스트 출력
	for ($i=0; $row=sql_fetch_array($result); $i++) {
		$no = $i + 1;
		//거래처 코드
		$com_code = $row['com_code'];
		//신청내용
		$application_kind_code = $row['application_kind'];
		$application_kind = $support_kind_array[$application_kind_code];
		//업체입금일 -> 거래명세서 발급일 160510
		if($row['statement_date']) $client_receipt_date = $row['statement_date'];
		else $client_receipt_date = "-";
		//업체입금일 색상
		if($search_day2) {
			if($client_receipt_date >= $search_sday && $client_receipt_date <= $search_eday) $client_receipt_date_color = "color:red";
			else $client_receipt_date_color = "";
		}
		//업체입금액 -> 청구금액 / 전정애 주임 의견 160510
		if($row['requested_amount']) {
			$client_receipt_fee = number_format($row['requested_amount']);
		} else {
			$client_receipt_fee = "-";
		}
		//업체입금액 합계
		$crf = str_replace(',','',$client_receipt_fee);
		$client_receipt_fee_sum += ($crf);
		//사업장명
		$com_name_full = $row['com_name'];
		$com_name = cut_str($com_name_full, 28, "..");
		//관리점
		$damdang_code = $row['damdang_code'];
		if($damdang_code) $branch = $man_cust_name_arry[$damdang_code];
		else $branch = "-";
		$damdang_code2 = $row['damdang_code2'];
		if($damdang_code2) $branch = $man_cust_name_arry[$damdang_code2];
		//담당매니저
		$manage_cust_name = $row['manage_cust_name'];
		//세금계산서
		if($row['tax_invoice']) $tax_invoice = $row['tax_invoice'];
		else $tax_invoice = "-";
		//링크 URL
		if($member['mb_level'] > 6 || $row['damdang_code'] == $member['mb_profile']) {
			$com_view = "client_application_view.php?id=$com_code&w=u&$qstr&page=$page";
		} else {
			$com_view = "javascript:alert('해당 거래처 정보를 열람할 권한이 없습니다.');";
		}
		//취소 사업장 회색 블럭 표시 151210
		if($reapplication_done_return) {
			$tr_class = "list_row_now_gr";
		} else {
			$tr_class = "list_row_now_wh";
		}
		//내용증명
		if($row['certification_content']) $unpaid_balance_memo = "내용증명 ";
		else $unpaid_balance_memo = "";
		//부분입금 161004
		if($row['part_receipt']) $unpaid_balance_memo .= "부분입금";
?>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td class="ltrow1_center_h22"><?=$no?></td>
										<td class="ltrow1_left_h22" title="<?=$com_name_full?>">
											<a href="<?=$com_view?>" style="font-weight:bold" target="_blank"><?=$com_name?></a>
										</td>
										<td class="ltrow1_left_h22" style=""><?=$application_kind?></td>
										<td class="ltrow1_right_h22_padding"><?=$client_receipt_date?></td>
										<td class="ltrow1_right_h22_padding"><?=$client_receipt_fee?></td>
										<td class="ltrow1_center_h22"><?=$branch?></td>
										<td class="ltrow1_center_h22"><?=$tax_invoice?></td>
										<td class="ltrow1_center_h22"><?=$unpaid_balance_memo?></td>
									</tr>
<?
	}
	if ($i == 0)
			echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' class=\"ltrow1_center_h22\">자료가 없습니다.</td></tr>";
?>
									<tr>
										<td class="tdhead_center"></td>
										<td class="tdhead_center" colspan="2">합계(업체입금액)</td>
										<td class="tdhead_center"></td>
										<td class="tdhead_right_padding"><?=number_format($client_receipt_fee_sum)?></td>
										<td class="tdhead_center"></td>
										<td class="tdhead_center"></td>
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
													<td class="Sftbutton_white" style="width:180px;text-align:center;background:url('images/sb_tab_on_bg.gif');"> 
														노무관리 프로그램 접수
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
//select * from com_list_gy a, com_list_gy_opt b, com_list_gy_opt2 c where a.com_code = b.com_code and a.com_code = c.com_code and b.easynomu_yn = '1' and ( (a.damdang_code = '1') ) and ( (c.easynomu_process = '3') ) order by a.com_code desc
	$sql_common = " from com_list_gy a, com_list_gy_opt b, com_list_gy_opt2 c where a.com_code = b.com_code and a.com_code = c.com_code and ( c.easynomu_process = '3' ) order by a.com_code desc ";
	$sql = " select count(*) as cnt $sql_common ";
	//echo $sql;
	$row = sql_fetch($sql);
	$total_count = $row[cnt];
	$rows = 999;
	$total_page  = ceil($total_count / $rows);
	if (!$page) $page = 1;
	$from_record = ($page - 1) * $rows; // 시작 열을 구함
	$sql = " select * $sql_common ";
	//echo $sql;
	$result = sql_query($sql);
	$colspan = 8;
?>
								<div style="height:2px;font-size:0px" class="bbtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>

								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="">
									<tr>
										<td class="tdhead_center" width="76">담당</td>
										<td class="tdhead_center" width="76">접수 누적</td>
										<td class="tdhead_center" width="76">이지노무</td>
										<td class="tdhead_center" width="76">키즈노무</td>
										<td class="tdhead_center" width="76">노무박사</td>
										<td class="tdhead_center" width="96">월정액</td>
										<td class="tdhead_center">비고</td>
									</tr>
<?
	//변수 초기화
	$count_total_main = 0;
	$count_total_branch = 0;
	$count_total_dealer = 0;
	$count_easynomu_main = 0;
	$count_kidsomu_main = 0;
	$count_labor_main = 0;
	$count_easynomu_branch = 0;
	$count_kidsomu_branch = 0;
	$count_labor_branch = 0;
	$count_easynomu_dealer = 0;
	$count_kidsomu_dealer = 0;
	$count_labor_dealer = 0;

	$program_pay_main = 0;
	$program_pay_branch = 0;
	$program_pay_dealer = 0;

	$today_count_total_sum = 0;
	$today_count_easynomu_sum = 0;
	$today_count_kidsnomu_sum = 0;
	$today_count_labor_sum = 0;
	$today_program_pay_sum = 0;
	$today_program_setting_pay_sum = 0;

	// 리스트 출력
	for ($i=0; $row=mysql_fetch_assoc($result); $i++) {
		//본사
		if($row['damdang_code'] == 1) {
			$count_total_main ++;
			if($row['easynomu_yn'] == 1) $count_easynomu_main ++;
			else if($row['easynomu_yn'] == 2) $count_kidsnomu_main ++;
			//노무박사
			if($row['construction_yn'] == 1) $count_labor_main ++;
			//이지노무 + 키즈노무 + 노무박사
			if($row['easynomu_yn'] == 1 || $row['easynomu_yn'] == 2 || $row['construction_yn'] == 1) {
				//월정액 합산 : 이지노무 + 키즈노무 + 노무박사
				$program_pay_main += (int)$row['month_pay'];
				//세팅비
				$program_setting_pay_main += (int)$row['setting_pay'];
			}
		} else {
			$count_total_branch ++;
			if($row['easynomu_yn'] == 1) $count_easynomu_branch ++;
			else if($row['easynomu_yn'] == 2) $count_kidsnomu_branch ++;
			if($row['construction_yn'] == 1) $count_labor_branch ++;
			if($row['easynomu_yn'] == 1 || $row['easynomu_yn'] == 2 || $row['construction_yn'] == 1) {
				$program_pay_branch += (int)$row['month_pay'];
				$program_setting_pay_branch += (int)$row['setting_pay'];
			}
		}
		//합계(금일)
		if($row['easynomu_finish_date'] == $subject_date) {
			$today_count_total_sum ++;
		}
	}
/*
	$program_memo_main = "총 세팅비 : ".number_format($program_setting_pay_main);
	$program_memo_branch = "총 세팅비 : ".number_format($program_setting_pay_branch);
	$program_memo_dealer = "총 세팅비 : ".number_format($program_setting_pay_dealer);
*/
	$count_total_sum = $count_total_main + $count_total_branch + $count_total_dealer;
	$count_easynomu_sum = $count_easynomu_main + $count_easynomu_branch + $count_easynomu_dealer;
	$count_kidsnomu_sum = $count_kidsnomu_main + $count_kidsnomu_branch + $count_kidsnomu_dealer;
	$count_labor_sum = $count_labor_main + $count_labor_branch + $count_labor_dealer;
	$program_pay_sum = $program_pay_main + $program_pay_branch + $program_pay_dealer;
	$program_setting_pay_sum = $program_setting_pay_main + $program_setting_pay_branch + $program_setting_pay_dealer;
?>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td class="ltrow1_center_h22">본사</td>
										<td class="ltrow1_right_h22_padding"><?=$count_total_main?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_easynomu_main?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_kidsnomu_main?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_labor_main?></td>
										<td class="ltrow1_right_h22_padding"><?=number_format($program_pay_main)?></td>
										<td class="ltrow1_left_h22" style=""><?=$program_memo_main?></td>
									</tr>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td class="ltrow1_center_h22">지사</td>
										<td class="ltrow1_right_h22_padding"><?=$count_total_branch?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_easynomu_branch?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_kidsnomu_branch?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_labor_branch?></td>
										<td class="ltrow1_right_h22_padding"><?=number_format($program_pay_branch)?></td>
										<td class="ltrow1_left_h22" style=""><?=$program_memo_branch?></td>
									</tr>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td class="ltrow1_center_h22">딜러</td>
										<td class="ltrow1_right_h22_padding"><?=$count_total_dealer?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_easynomu_dealer?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_kidsnomu_dealer?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_labor_dealer?></td>
										<td class="ltrow1_right_h22_padding"><?=number_format($program_pay_dealer)?></td>
										<td class="ltrow1_left_h22" style=""><?=$program_memo_dealer?></td>
									</tr>
									<tr>
										<td class="tdhead_center">합계(금일)</td>
										<td class="tdhead_right_padding"><?=number_format($today_count_total_sum)?></td>
										<td class="tdhead_right_padding"><?=number_format($today_count_easynomu_sum)?></td>
										<td class="tdhead_right_padding"><?=number_format($today_count_kidsnomu_sum)?></td>
										<td class="tdhead_right_padding"><?=number_format($today_count_labor_sum)?></td>
										<td class="tdhead_right_padding"><?=number_format($today_program_pay_sum)?></td>
										<td class="tdhead_center"></td>
									</tr>
									<tr>
										<td class="tdhead_center">합계(금월)</td>
										<td class="tdhead_right_padding"><?=number_format($month_count_total_sum)?></td>
										<td class="tdhead_right_padding"><?=number_format($month_count_easynomu_sum)?></td>
										<td class="tdhead_right_padding"><?=number_format($month_count_kidsnomu_sum)?></td>
										<td class="tdhead_right_padding"><?=number_format($month_count_labor_sum)?></td>
										<td class="tdhead_right_padding"><?=number_format($month_program_pay_sum)?></td>
										<td class="tdhead_center"></td>
									</tr>
									<tr>
										<td class="tdhead_center">합계(전체)</td>
										<td class="tdhead_right_padding"><?=number_format($count_total_sum)?></td>
										<td class="tdhead_right_padding"><?=number_format($count_easynomu_sum)?></td>
										<td class="tdhead_right_padding"><?=number_format($count_kidsnomu_sum)?></td>
										<td class="tdhead_right_padding"><?=number_format($count_labor_sum)?></td>
										<td class="tdhead_right_padding"><?=number_format($program_pay_sum)?></td>
										<td class="tdhead_center"></td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px"></div>