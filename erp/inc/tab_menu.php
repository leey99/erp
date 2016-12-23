<?
//탭 메뉴 링크
$client_view = "client_view.php?id=$com_code&w=u&page=$page&$qstr";
$client_process_view = "client_process_view.php?id=$com_code&w=u&page=$page&$qstr";
$samu_view = "samu_view.php?id=$com_code&w=u&page=$page&$qstr";
//사업주훈련
if($row['job_request_if']) {
	$sql_job = " select idx from job_education where com_code='$com_code' ";
	$result_job = sql_query($sql_job);
	$row_job=mysql_fetch_array($result_job);
	$job_idx = $row_job['idx'];
	$job_education_view = "job_education_view.php?w=u&id=$job_idx";
	$tab_job_education_is = 1;
	$job_education_not = "";
} else {
	$job_education_view = "client_view.php?id=$com_code&w=u&v=write&&page=$page&$qstr#17001";
	$tab_job_education_is = "";
	$job_education_not = "if(confirm('해당 거래처의 사업주훈련 정보가 없습니다.\\n사업주훈련 의뢰 후 이용 바랍니다.')){location.href = this.href;};return false;";
}
//위험성평가
if($row['danger_evaluate_if']) {
	$danger_evaluate_view = "job_education_view.php?w=u&id=$job_idx";
	$tab_danger_evaluate_is = 1;
	$danger_evaluate_not = "";
} else {
	$danger_evaluate_view = "client_view.php?id=$com_code&w=u&v=write&page=$page&$qstr#16001";
	$tab_danger_evaluate_is = "";
	$danger_evaluate_not = "if(confirm('해당 거래처의 위험성평가 정보가 없습니다.\\n위험성평가 의뢰 후 이용 바랍니다.')){location.href = this.href;};return false;";
}
//지원금
$sql_support = " select * from erp_application where com_code='$com_code' and application_kind!='0' ";
$result_support = sql_query($sql_support);
$total_support = mysql_num_rows($result_support);
if($total_support) {
	$support_view = "client_application_view.php?id=$com_code&w=u&page=$page&$qstr";
	$tab_support_is = 1;
	$support_not = "";
} else {
	$support_view = "client_process_view.php?id=$com_code&w=u&v=write&page=$page&$qstr#40001";
	$tab_support_is = "";
	$support_not = "if(confirm('해당 거래처의 지원금 정보가 없습니다.\\n지원금 신청 후 이용 바랍니다.')){location.href = this.href;};return false;";
}
//프로그램 종류
if($tab_program_url == 1) $tab_program_url_text = "program";
else if($tab_program_url == 2) $tab_program_url_text = "kidsnomu";
else if($tab_program_url == 3) $tab_program_url_text = "construction";
else $tab_program_url_text = "program";
$client_program_view = "client_".$tab_program_url_text."_view.php?id=$com_code&w=u&page=$page&$qstr";
//가족보험료
/*
$sql_family_insurance = " select * from erp_application where com_code='$com_code' and application_kind='18' ";
$result_family_insurance = sql_query($sql_family_insurance);
$total_family_insurance = mysql_num_rows($result_family_insurance);
*/
//환급신청의뢰 여부
//if(!$total_family_insurance) {
	$sql_family_insurance = " select * from com_list_gy_opt b where b.com_code='$com_code' and ( b.refund_request='1' or b.family_work_if='1' or b.insurance_holder!='' ) ";
	$result_family_insurance = sql_query($sql_family_insurance);
	$total_family_insurance = mysql_num_rows($result_family_insurance);
//}
if($total_family_insurance) {
	$family_insurance_view = "family_insurance_view.php?id=$com_code&w=u&page=$page&$qstr";
	$tab_family_insurance_is = 1;
	$family_insurance_not = "";
} else {
	$family_insurance_view = "client_view.php?id=$com_code&w=u&v=write&page=$page&$qstr#11001";
	$tab_family_insurance_is = "";
	$family_insurance_not = "if(confirm('해당 거래처의 지원금 정보가 없습니다.\\n지원금 신청 후 이용 바랍니다.')){location.href = this.href;};return false;";
}
//정책자금
$sql_policy_fund = " select * from policy_fund where com_code='$com_code' ";
$result_policy_fund = sql_query($sql_policy_fund);
$row_policy_fund = mysql_fetch_array($result_policy_fund);
$policy_fund_id = $row_policy_fund['id'];
if($policy_fund_id) {
	$policy_fund_view = "policy_fund_view.php?id=$policy_fund_id&w=u&page=$page&$qstr";
	$tab_policy_fund_is = 1;
} else {
	$policy_fund_view = "client_view.php?id=$com_code&w=u&v=write&page=$page&$qstr#16001";
	$tab_policy_fund_is = "";
	$policy_fund_not = "if(confirm('해당 거래처의 정책자금 정보가 없습니다.\\n정책자금 의뢰 후 이용 바랍니다.')){location.href = this.href;};return false;";
}
//고용창출(시간선택제)
$sql_job_time = " select * from job_time where com_code='$com_code' ";
$result_job_time = sql_query($sql_job_time);
$row_job_time = mysql_fetch_array($result_job_time);
$job_time_id = $row_job_time['id'];
if($job_time_id) {
	$job_time_view = "job_time_view.php?id=$job_time_id&w=u&page=$page&$qstr";
	$tab_job_time_is = 1;
	$job_time_not = "";
} else {
	$job_time_view = "client_view.php?id=$com_code&w=u&v=write&page=$page&$qstr#19001";
	$tab_job_time_is = "";
	$job_time_not = "if(confirm('해당 거래처의 시간선택제 정보가 없습니다.\\n시간선택제 의뢰 후 이용 바랍니다.')){location.href = this.href;};return false;";
}
//전기요금컨설팅
if($row['electric_charges_no']) {
	$electric_charges_view = "electric_charges_view.php?id=$com_code&w=u&page=$page&$qstr";
	$tab_electric_charges_is = 1;
	$electric_charges_not = "";
} else {
	$electric_charges_view = "client_view.php?id=$com_code&w=u&v=write&page=$page&$qstr#20001";
	$tab_electric_charges_is = "";
	$electric_charges_not = "if(confirm('해당 거래처의 전기요금컨설팅 정보가 없습니다.\\n전기요금컨설팅 의뢰 후 이용 바랍니다.')){location.href = this.href;};return false;";
}
//지원대상확인
$sql_support_person = " select * from com_list_gy_memo where com_code='$com_code' and delete_yn != '1' ";
$result_support_person = sql_query($sql_support_person);
$row_support_person = mysql_fetch_array($result_support_person);
$support_person_id = $row_support_person['idx'];
if($support_person_id) {
	$support_person_view = "support_person_view.php?id=$com_code&w=u&page=$page&$qstr";
	$tab_support_person_is = 1;
	$support_person_not = "";
} else {
	$support_person_view = "support_person_view.php?id=$com_code&w=u&page=$page&$qstr";
	$tab_support_person_is = "";
	$support_person_not = "if(confirm('해당 거래처의 지원대상조회 정보가 없습니다.\\n지원대상조회 전달사항 등록 후 이용 바랍니다.')){location.href = this.href;};return false;";
}
//신규고용확인
$sql_acceleration_employment = " select * from com_employment where com_code='$com_code' and delete_yn != '1' ";
$result_acceleration_employment = sql_query($sql_acceleration_employment);
$row_acceleration_employment = mysql_fetch_array($result_acceleration_employment);
$acceleration_employment_id = $row_acceleration_employment['idx'];
if($acceleration_employment_id) {
	$acceleration_employment_view = "acceleration_employment_view.php?id=$com_code&w=u&page=$page&$qstr";
	$tab_acceleration_employment_is = 1;
	$acceleration_employment_not = "";
} else {
	$acceleration_employment_view = "acceleration_employment_view.php?id=$com_code&w=u&page=$page&$qstr";
	$tab_acceleration_employment_is = "";
	$acceleration_employment_not = "if(confirm('해당 거래처의 지원대상조회 정보가 없습니다.\\n지원대상조회 전달사항 등록 후 이용 바랍니다.')){location.href = this.href;};return false;";
}
//첨부파일
$data_view = "data_view.php?id=$com_code&w=u&page=$page&$qstr";
//직무발명보상제도 160927
$job_invent_view = "job_invent_recompense_view.php?w=u&id=$com_code";
//스케줄
$schedule_view = "client_schedule_view.php?id=$com_code&w=u&page=$page&$qstr";
//4대보험절감
//echo $row2['si4n_nhis_chk'];
if($row2['si4n_nhis_chk']) {
	$si4n_view = "si4n_nhis_view.php?id=$com_code&w=u&page=$page&$qstr";
	$tab_si4n_is = 1;
	$si4n_not = "";
} else {
	$si4n_view = "client_view.php?id=$com_code&w=u&v=write&page=$page&$qstr#1901000";
	$tab_si4n_is = "";
	$si4n_not = "if(confirm('해당 거래처의 4대보험절감 정보가 없습니다.\\n4대보험절감 의뢰 후 이용 바랍니다.')){location.href = this.href;};return false;";
}
//알림
$sql_alert = " select * from erp_alert where com_code='$com_code' ";
$result_alert = sql_query($sql_alert);
$total_alert = mysql_num_rows($result_alert);
if($total_alert) {
	$tab_alert_is = 1;
} else {
	$tab_alert_is = "";
}
$alert_view = "alert_view.php?id=$com_code&w=u&page=$page&$qstr";
//탭 메뉴 내용 유무 표시
//사무위탁 수임
if($row['samu_req_yn'] == 4) $tab_samu_is = 1;
else $tab_samu_is = "";
//프로그램 사용
if($row['easynomu_yn'] == 1) {
	$tab_program_is = 1;
} else if($row['easynomu_yn'] == 2) {
	$tab_program_is = 2;
} else {
	$tab_program_is = "";
	if($row['construction_yn'] == 1) $tab_program_is = 3;
}
//탭 메뉴 온오프 배열
$tab_onoff = array();
for($t=1;$t<=16;$t++) {
	$tab_onoff[$t] = "off";
	if($t == 1) $tab_onoff[$t] = "is";
	if($t == 2) $tab_onoff[$t] = "is";
}
//강제 첨부파일 is 설정 -> 기본 설정 160105
//$tab_data_is = 1;
//탭 메뉴 활성화
if($tab_samu_is) $tab_onoff[3] = "is";
if($tab_job_education_is) $tab_onoff[4] = "is";
if($tab_danger_evaluate_is) $tab_onoff[5] = "is";
if($tab_support_is) $tab_onoff[6] = "is";
if($tab_program_is) $tab_onoff[7] = "is";
if($tab_family_insurance_is) $tab_onoff[8] = "is";
if($tab_policy_fund_is) $tab_onoff[9] = "is";
if($tab_job_time_is) $tab_onoff[11] = "is";
if($tab_electric_charges_is) $tab_onoff[12] = "is";
if($tab_support_person_is) $tab_onoff[13] = "is";
if($tab_acceleration_employment_is) $tab_onoff[14] = "is";
if($tab_data_is) $tab_onoff[15] = "is";
if($tab_si4n_is) $tab_onoff[16] = "is";
if($tab_alert_is) $tab_onoff[10] = "is";
$tab_onoff[$tab_onoff_this] = "on";
?>
							<table border="0" cellspacing="0" cellpadding="0"> 
								<tr> 
									<td id="Tab_cust_tab_01"> 
										<a href="<?=$client_view?>"><img src="./images/view_tab_01_<?=$tab_onoff[1]?>.png" border="0" id="tab_img1" alt="거래처" /></a>
									</td>
									<td width=2></td> 
									<td id="Tab_cust_tab_02"> 
										<a href="<?=$client_process_view?>"><img src="./images/view_tab_02_<?=$tab_onoff[2]?>.png" border="0" id="tab_img2" alt="접수처리" /></a>
									</td>
									<td width=2></td> 
									<td id="Tab_cust_tab_03"> 
										<a href="<?=$samu_view?>"><img src="./images/view_tab_03_<?=$tab_onoff[3]?>.png" border="0" id="tab_img3" alt="사무위탁" /></a>
									</td>
									<td width=2></td> 
									<td id="Tab_cust_tab_04"> 
										<a href="<?=$job_education_view?>" onclick="<?=$job_education_not?>"><img src="./images/view_tab_04_<?=$tab_onoff[4]?>.png" border="0" id="tab_img4" alt="사업주훈련" /></a>
									</td>
									<td id="Tab_cust_tab_05" style="display:none;">
										<a href="<?=$danger_evaluate_view?>" onclick="<?=$danger_evaluate_not?>"><img src="./images/view_tab_05_<?=$tab_onoff[5]?>.png" border="0" id="tab_img5" alt="위험성평가" /></a>
									</td>
									<td width=2></td> 
									<td id="Tab_cust_tab_06"> 
										<a href="<?=$support_view?>" onclick="<?=$support_not?>"><img src="./images/view_tab_06_<?=$tab_onoff[6]?>.png" border="0" id="tab_img6" alt="지원금" /></a>
									</td>
									<td width=2></td> 
									<td id="Tab_cust_tab_07"> 
										<a href="<?=$client_program_view?>"><img src="./images/view_tab_07_<?=$tab_onoff[7]?>.png" border="0" id="tab_img7" alt="프로그램" /></a>
									</td>
									<td width=2></td> 
									<td id="Tab_cust_tab_08"> 
										<a href="<?=$family_insurance_view?>" onclick="<?=$family_insurance_not?>"><img src="./images/view_tab_08_<?=$tab_onoff[8]?>.png" border="0" id="tab_img8" alt="가족보험료" /></a>
									</td>
									<td id="Tab_cust_tab_09" style="display:none;"> 
										<a href="<?=$policy_fund_view?>" onclick="<?=$policy_fund_not?>"><img src="./images/view_tab_09_<?=$tab_onoff[9]?>.png" border="0" id="tab_img9" alt="정책자금" /></a>
									</td>
									<td width=2></td> 
									<td id="Tab_cust_tab_11"> 
										<a href="<?=$job_time_view?>" onclick="<?=$job_time_not?>"><img src="./images/view_tab_11_<?=$tab_onoff[11]?>.png" border="0" id="tab_img11" alt="시간선택제" /></a>
									</td>
									<td width=2></td> 
									<td id="Tab_cust_tab_12"> 
										<a href="<?=$electric_charges_view?>" onclick="<?=$electric_charges_not?>"><img src="./images/view_tab_12_<?=$tab_onoff[12]?>.png" border="0" id="tab_img12" alt="전기요금컨설팅" /></a>
									</td>
									<td width=2></td> 
									<td id="Tab_cust_tab_13"> 
										<a href="<?=$support_person_view?>" onclick="<?=$support_person_not?>"><img src="./images/view_tab_13_<?=$tab_onoff[13]?>.png" border="0" id="tab_img13" alt="지원대상조회" /></a>
									</td>
									<td width=2></td>
									<td id="Tab_cust_tab_14"> 
										<a href="<?=$acceleration_employment_view?>" onclick="<?=$acceleration_employment_not?>"><img src="./images/view_tab_14_<?=$tab_onoff[14]?>.png" border="0" id="tab_img14" alt="신규고용확인" /></a>
									</td>
									<td width=2></td>
									<td id="Tab_cust_tab_15"> 
										<!--<a href="<?=$data_view?>"><img src="./images/view_tab_data_<?=$tab_onoff[15]?>.png" border="0" id="tab_img15" alt="첨부파일" /></a>-->
										<a href="<?=$job_invent_view?>"><img src="./images/view_tab_job_invent_<?=$tab_onoff[15]?>.png" border="0" id="tab_img15" alt="첨부파일" /></a>
									</td>
									<td width=2></td>
									<td id="Tab_cust_tab_16"> 
										<a href="<?=$si4n_view?>" onclick="<?=$si4n_not?>"><img src="./images/view_tab_si4n_<?=$tab_onoff[16]?>.png" border="0" id="tab_img16" alt="4대보험절감" /></a>
									</td>
									<td width=2></td>
									<td id="Tab_cust_tab_10"> 
										<a href="<?=$alert_view?>"><img src="./images/view_tab_alert_<?=$tab_onoff[10]?>.png" border="0" id="tab_img10" alt="알림" /></a>
									</td>
									<td width=2></td>
								</tr> 
							</table>
							<div style="height:2px;font-size:0px" class="bgtr_tab"></div>
							<div style="height:10px;font-size:0px;line-height:0px;"></div>
