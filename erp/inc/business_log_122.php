								<table border="0" cellspacing="0" cellpadding="0"> 
									<tr>
										<td> 
											<table border="0" cellspacing="0" cellpadding="0"> 
												<tr> 
													<td><img src="images/sb_tab_on_lt.gif" alt="[" /></td> 
													<td class="Sftbutton_white" style="width:90px;text-align:center;background:url('images/sb_tab_on_bg.gif');"> 
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
								<div style="height:2px;font-size:0px" class="bbtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>

								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="">
									<tr>
										<td class="tdhead_center" width="50">구분</td>
										<td class="tdhead_center" width="68">미선택</td>
										<td class="tdhead_center" width="68">조회불가</td>
										<td class="tdhead_center" width="68">요금조회</td>
										<td class="tdhead_center" width="68">계약진행</td>
										<td class="tdhead_center" width="68">상담완료</td>
										<td class="tdhead_center" width="68">업무진행</td>
										<td class="tdhead_center" width="68">진행불가</td>
										<td class="tdhead_center" width="68">보류</td>
										<td class="tdhead_center" width="68">공사완료</td>
										<td class="tdhead_center" width="68">실사완료</td>
										<td class="tdhead_center" width="68">최종완료</td>
										<td class="tdhead_center">합계</td>
									</tr>
<?
//변수 초기화
$count_electric_sum = 0;
for($i=0; $i<=11; $i++) {
	$count_electric[$i] = 0;
}
//전기요금
$sql_electric = " select * from com_list_gy a, com_list_gy_opt b where  a.com_code=b.com_code and (b.manage_cust_numb='$drafter_code' and a.damdang_code='1') and a.electric_charges_no!='' ";
$result_electric = sql_query($sql_electric);
for($i=0; $row_electric=mysql_fetch_assoc($result_electric); $i++) {
	//미선택
	if($row_electric['electric_charges_process'] == "") {
		$count_electric[1] ++;
	//조회불가
	} else if($row_electric['electric_charges_process'] == 1) {
		$count_electric[2] ++;
	//요금조회
	} else if($row_electric['electric_charges_process'] == 2) {
		$count_electric[3] ++;
	//계약진행
	} else if($row_electric['electric_charges_process'] == 3) {
		$count_electric[4] ++;
	//업무진행
	} else if($row_electric['electric_charges_process'] == 4) {
		$count_electric[5] ++;
	//진행불가
	} else if($row_electric['electric_charges_process'] == 5) {
		$count_electric[6] ++;
	//보류
	} else if($row_electric['electric_charges_process'] == 6) {
		$count_electric[7] ++;
	//공사완료
	} else if($row_electric['electric_charges_process'] == 7) {
		$count_electric[8] ++;
	//실사완료
	} else if($row_electric['electric_charges_process'] == 8) {
		$count_electric[9] ++;
	//최종완료
	} else if($row_electric['electric_charges_process'] == 9) {
		$count_electric[10] ++;
	//상담완료
	} else {
		if($row_electric['electric_charges_process'] == 10) $count_electric[11] ++;
	}
}
//합계
for($i=1;$i<=count($count_electric);$i++) {
	$count_electric_sum += $count_electric[$i];
}
?>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td class="ltrow1_center_h22">전체</td>
										<td class="ltrow1_right_h22_padding"><a href="electric_charges_list.php?stx_manage_name=<?=$drafter_name?>&stx_process=no" target="_blank"><?=$count_electric[1]?></a></td>
										<td class="ltrow1_right_h22_padding"><a href="electric_charges_list.php?stx_manage_name=<?=$drafter_name?>&stx_process=1" target="_blank"><?=$count_electric[2]?></a></td>
										<td class="ltrow1_right_h22_padding"><a href="electric_charges_list.php?stx_manage_name=<?=$drafter_name?>&stx_process=2" target="_blank"><?=$count_electric[3]?></a></td>
										<td class="ltrow1_right_h22_padding"><a href="electric_charges_list.php?stx_manage_name=<?=$drafter_name?>&stx_process=3" target="_blank"><?=$count_electric[4]?></a></td>
										<td class="ltrow1_right_h22_padding"><a href="electric_charges_list.php?stx_manage_name=<?=$drafter_name?>&stx_process=10" target="_blank"><?=$count_electric[11]?></a></td>
										<td class="ltrow1_right_h22_padding"><a href="electric_charges_list.php?stx_manage_name=<?=$drafter_name?>&stx_process=4" target="_blank"><?=$count_electric[5]?></td>
										<td class="ltrow1_right_h22_padding"><a href="electric_charges_list.php?stx_manage_name=<?=$drafter_name?>&stx_process=5" target="_blank"><?=$count_electric[6]?></td>
										<td class="ltrow1_right_h22_padding"><a href="electric_charges_list.php?stx_manage_name=<?=$drafter_name?>&stx_process=6" target="_blank"><?=$count_electric[7]?></td>
										<td class="ltrow1_right_h22_padding"><a href="electric_charges_list.php?stx_manage_name=<?=$drafter_name?>&stx_process=7" target="_blank"><?=$count_electric[8]?></td>
										<td class="ltrow1_right_h22_padding"><a href="electric_charges_list.php?stx_manage_name=<?=$drafter_name?>&stx_process=8" target="_blank"><?=$count_electric[9]?></td>
										<td class="ltrow1_right_h22_padding"><a href="electric_charges_list.php?stx_manage_name=<?=$drafter_name?>&stx_process=9" target="_blank"><?=$count_electric[10]?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_electric_sum?></td>
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
														거래처 현황
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
										<td class="tdhead_center" width="68">전기요금</td>
										<td class="tdhead_center" width="68">신규고용</td>
										<td class="tdhead_center" width="68">다수고령</td>
										<td class="tdhead_center" width="68">가족보험</td>
										<td class="tdhead_center" width="68">정년퇴직</td>
										<td class="tdhead_center" width="68">시간선택</td>
										<td class="tdhead_center" width="68">직무교육</td>
										<td class="tdhead_center" width="68">고용촉진</td>
										<td class="tdhead_center" width="68">대체인력</td>
										<td class="tdhead_center" width="68">육아휴직</td>
										<td class="tdhead_center" width="68">기타</td>
										<td class="tdhead_center">합계</td>
									</tr>
<?
//변수 초기화
$count_total_today_sum = 0;
$count_total_sum = 0;
for($i=0; $i<=11; $i++) {
	$count_total_today[$i] = 0;
	$count_total[$i] = 0;
}
//날짜 형식 변경
$subject_date_arry = explode(".", $subject_date);
$subject_date_transform = $subject_date_arry[0]."-".$subject_date_arry[1]."-".$subject_date_arry[2];
//전기요금
$sql_electric = " select count(*) as cnt from com_list_gy a, com_list_gy_opt b where  a.com_code=b.com_code and (b.manage_cust_numb='$drafter_code') and a.electric_charges_no!='' ";
$row_electric = sql_fetch($sql_electric);
$count_total[1] = $row_electric['cnt'];
//신규고용
$sql_employment = " select count(distinct c.com_code) as cnt from com_list_gy a, com_list_gy_opt b, com_employment c, com_list_gy_opt2 d where a.com_code=b.com_code and a.com_code=c.com_code and a.com_code=d.com_code and c.delete_yn!='1' and (b.manage_cust_numb='$drafter_code') ";
$row_employment = sql_fetch($sql_employment);
$count_total[2] = $row_employment['cnt'];
//지원금현황DB : 60세다수고령, 가족보험료환급, 정년퇴직계속고용, 시간선택제일자리, 직무교육, 고용촉진, 대체인력지원금, 육아휴직장려금, 기타
$sql_application = " select * from com_list_gy a, com_list_gy_opt b, erp_application c where a.com_code = b.com_code and a.com_code = c.com_code and ( c.application_kind != '0' and c.application_kind != '' ) and b.manage_cust_numb='$drafter_code' order by c.application_accept desc ";
$result_application = sql_query($sql_application);
for($i=0; $row_application=mysql_fetch_assoc($result_application); $i++) {
	//금일 지원금 등록
	if(strpos($row_application['w_date'], $subject_date_transform)) {
		 //금일 합계
		$count_total_today_sum ++;
		//다수고령
		if($row_application['application_kind'] == 2) {
			$count_total_today[3] ++;
		//가족보험
		} else if($row_application['application_kind'] == 16) {
			$count_total_today[4] ++;
		//정년퇴직
		} else if($row_application['application_kind'] == 3) {
			$count_total_today[5] ++;
		//시간선택
		} else if($row_application['application_kind'] == 9) {
			$count_total_today[6] ++;
		//직무교육
		} else if($row_application['application_kind'] == 20) {
			$count_total_today[7] ++;
		//고용촉진
		} else if($row_application['application_kind'] == 7) {
			$count_total_today[8] ++;
		//대체인력
		} else if($row_application['application_kind'] == 25) {
			$count_total_today[9] ++;
		//육아휴직
		} else if($row_application['application_kind'] == 24) {
			$count_total_today[10] ++;
		//기타
		} else {
			//전기요금컨설팅 지원금 제외
			if($row_application['application_kind'] != 23) $count_total_today[11] ++;
		}
	}
	//다수고령
	if($row_application['application_kind'] == 2) {
		$count_total[3] ++;
	//가족보험
	} else if($row_application['application_kind'] == 16) {
		$count_total[4] ++;
	//정년퇴직
	} else if($row_application['application_kind'] == 3) {
		$count_total[5] ++;
	//시간선택
	} else if($row_application['application_kind'] == 9) {
		$count_total[6] ++;
	//직무교육
	} else if($row_application['application_kind'] == 20) {
		$count_total[7] ++;
	//고용촉진
	} else if($row_application['application_kind'] == 7) {
		$count_total[8] ++;
	//대체인력
	} else if($row_application['application_kind'] == 25) {
		$count_total[9] ++;
	//육아휴직
	} else if($row_application['application_kind'] == 24) {
		$count_total[10] ++;
	//기타
	} else {
		if($row_application['application_kind'] != 23) $count_total[11] ++;
	}
}
//합계
for($i=1;$i<=count($count_total);$i++) {
	$count_total_sum += $count_total[$i];
}
?>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td class="ltrow1_center_h22">금일</td>
										<td class="ltrow1_right_h22_padding"><?=$count_total_today[1]?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_total_today[2]?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_total_today[3]?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_total_today[4]?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_total_today[5]?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_total_today[6]?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_total_today[7]?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_total_today[8]?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_total_today[9]?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_total_today[10]?></td>
										<td class="ltrow1_right_h22_padding"><?=$count_total_today[11]?></td>
										<td class="ltrow1_right_h22_padding" style=""><?=$count_total_today_sum?></td>
									</tr>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td class="ltrow1_center_h22">전체</td>
										<td class="ltrow1_right_h22_padding"><a href="electric_charges_list.php?stx_manage_name=<?=$drafter_name?>" target="_blank"><?=$count_total[1]?></a></td>
										<td class="ltrow1_right_h22_padding"><a href="acceleration_employment.php?stx_manage_name=<?=$drafter_name?>" target="_blank"><?=$count_total[2]?></a></td>
										<td class="ltrow1_right_h22_padding"><a href="client_application_list.php?stx_manage_name=<?=$drafter_name?>&stx_application_kind=2" target="_blank"><?=$count_total[3]?></a></td>
										<td class="ltrow1_right_h22_padding"><a href="client_application_list.php?stx_manage_name=<?=$drafter_name?>&stx_application_kind=16" target="_blank"><?=$count_total[4]?></a></td>
										<td class="ltrow1_right_h22_padding"><a href="client_application_list.php?stx_manage_name=<?=$drafter_name?>&stx_application_kind=3" target="_blank"><?=$count_total[5]?></a></td>
										<td class="ltrow1_right_h22_padding"><a href="client_application_list.php?stx_manage_name=<?=$drafter_name?>&stx_application_kind=9" target="_blank"><?=$count_total[6]?></a></td>
										<td class="ltrow1_right_h22_padding"><a href="client_application_list.php?stx_manage_name=<?=$drafter_name?>&stx_application_kind=20" target="_blank"><?=$count_total[7]?></a></td>
										<td class="ltrow1_right_h22_padding"><a href="client_application_list.php?stx_manage_name=<?=$drafter_name?>&stx_application_kind=7" target="_blank"><?=$count_total[8]?></a></td>
										<td class="ltrow1_right_h22_padding"><a href="client_application_list.php?stx_manage_name=<?=$drafter_name?>&stx_application_kind=25" target="_blank"><?=$count_total[9]?></a></td>
										<td class="ltrow1_right_h22_padding"><a href="client_application_list.php?stx_manage_name=<?=$drafter_name?>&stx_application_kind=24" target="_blank"><?=$count_total[10]?></a></td>
										<td class="ltrow1_right_h22_padding"><a href="client_application_list.php?stx_manage_name=<?=$drafter_name?>" target="_blank"><?=$count_total[11]?></a></td>
										<td class="ltrow1_right_h22_padding" style=""><?=$count_total_sum?></td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px"></div>