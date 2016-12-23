<?
//모든 사용자 표시 150923
//if($member['mb_level'] > 6) {
	if($title_main_no == "01") {
?>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='client_process_list.php'"><div style="margin:8px 0 0 0;">접수처리현황</div></div>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='client_list.php'"><div style="padding:8px 0 0 0">거래처정보</div></div>
<?
		//if($member['mb_level'] > 6) {
		//6지사 -> 7영업사원 초과 권한, 본사 관리부 권한 160824
		if($member['mb_level'] > 7) {
?>
							<!--<a href="client_memo.php">거래처방문/연락</a>-->
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='client_sms_list.php'"><div style="padding:8px 0 0 0">문자메세지발송</div></div>
<?
		} else {
?>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='client_search.php'"><div style="padding:8px 0 0 0">거래처검색</div></div>
<?
		}
	} else if($title_main_no == "02") {
?>
							<div style="width:100px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='client_application_list.php'"><div style="padding:8px 0 0 0">지원금현황</div></div>
							<div style="width:100px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='client_reapplication.php'"><div style="padding:8px 0 0 0">재신청현황</div></div>
							<div style="width:100px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='unpaid_balance.php'"><div style="padding:8px 0 0 0">미수급현황</div></div>
							<div style="width:100px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='app_family_insurance_list.php'"><div style="padding:8px 0 0 0">가족보험료</div></div>
							<div style="width:90px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='client_application_cycle.php'"><div style="padding:8px 0 0 0">신청주기</div></div>
							<div style="width:90px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;"><div style="padding:8px 0 0 0"><a href="support_person_list.php" class="white">지원대상</a></div></div>
							<div style="width:90px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;"><div style="padding:8px 0 0 0"><a href="acceleration_employment.php" class="white">신규고용</a></div></div>
							<div style="width:90px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;"><div style="padding:8px 0 0 0"><a href="reduction_prevention.php" class="white">감원방지</a></div></div>
							<div style="width:90px; height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;"><div style="padding:8px 0 0 0"><a href="job_time_list.php" class="white">고용창출</a></div></div>
							<div style="width:90px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='reduction_application.php'"><div style="padding:8px 0 0 0">감원방지2</div></div>
<?
	} else if($title_main_no == "03") {
?>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='settlement_list.php'"><div style="padding:8px 0 0 0">결산현황</div></div>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='settlement_report.php'"><div style="padding:8px 0 0 0">결산보고서</div></div>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='settlement_sales.php'"><div style="padding:8px 0 0 0">영업관리</div></div>
<?
		//본사만 표시 160405
		if($member['mb_level'] > 6) {
?>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='settlement_pay.php'"><div style="padding:8px 0 0 0">급여관리</div></div>

<?
		} else {
			//지사장, 지사관리 권한 160509
			if($member['mb_level'] == 6) {
?>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='settlement_pay_branch.php'"><div style="padding:8px 0 0 0">급여관리</div></div>
<?
			}
		}
	} else if($title_main_no == "05") {
?>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='samu_list.php'"><div style="padding:8px 0 0 0">사무위탁현황</div></div>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='samu_insure_list.php'"><div style="padding:8px 0 0 0">피보험자신고</div></div>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='total_pay_list.php'"><div style="padding:8px 0 0 0">보수총액신고</div></div>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='total_insure_list.php'"><div style="padding:8px 0 0 0">보험료신고</div></div>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='accountant_list.php'"><div style="padding:8px 0 0 0">회계사무소</div></div>
<?
	} else if($title_main_no == "10") {
?>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='list_notice.php?bo_table=erp_notice'"><div style="padding:8px 0 0 0">공지사항</div></div>
<?
		//본사만 표시 160126
		if($member['mb_level'] > 6) {
?>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='list_notice.php?bo_table=erp_dealer'"><div style="padding:8px 0 0 0">공지(제휴점)</div></div>
<?
		}
?>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='list_notice.php?bo_table=erp_event'"><div style="padding:8px 0 0 0">주요일정</div></div>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='list_notice.php?bo_table=erp_online'"><div style="padding:8px 0 0 0">Q&amp;A</div></div>
<?
	} else if($title_main_no == "18") {
?>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='client_kidsnomu_list.php'"><div style="padding:8px 0 0 0">키즈노무</div></div>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='client_program_list.php'"><div style="padding:8px 0 0 0">이지노무</div></div>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='client_construction_list.php'"><div style="padding:8px 0 0 0">건설월정액</div></div>
<?
	} else if($title_main_no == "19") {
?>
							<div style="width:90px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;"><div style="padding:8px 0 0 0"><a href="electric_charges_list.php" class="white">전기요금</a></div></div>
							<div style="width:90px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;"><div style="padding:8px 0 0 0"><a href="job_invent_recompense.php" class="white">직무발명</a></div></div>
<?
//지사 오픈 불가 김국진 과장 의견 161019
if($member['mb_level'] > 6) {
?>
							<div style="width:90px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;"><div style="padding:8px 0 0 0"><a href="si4n_nhis_list.php" class="white">4대보험</a></div></div>
<?
}
?>
							<div style="width:90px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;"><div style="padding:8px 0 0 0"><a href="kepco_dsm_list.php" class="white">수요관리</a></div></div>
							<div style="width:100px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;"><div style="padding:8px 0 0 0"><a href="job_education_list.php" class="white">사업주훈련</a></div></div>
							<div style="width:100px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;"><div style="padding:8px 0 0 0"><a href="danger_evaluate_list.php" class="white">위험성평가</a></div></div>
							<div style="width:100px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;"><div style="padding:8px 0 0 0"><a href="family_insurance_list.php" class="white">가족보험료</a></div></div>
							<div style="width:90px; height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;"><div style="padding:8px 0 0 0"><a href="policy_fund_list.php" class="white">정책자금</a></div></div>
							<div style="width:90px; height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;"><div style="padding:8px 0 0 0"><a href="employment_agency.php" class="white">인력관리</a></div></div>
<?
	} else if($title_main_no == "20") {
?>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='list_notice.php?bo_table=erp_schedule'"><div style="padding:8px 0 0 0">스케줄관리</div></div>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='schedule_view.php'"><div style="padding:8px 0 0 0">방문스케줄등록</div></div>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='list_notice.php?bo_table=erp_job_education'"><div style="padding:8px 0 0 0">사업주훈련관리</div></div>
<?
	} else if($title_main_no == "21") {
?>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='list_pds.php?bo_table=erp_pds'"><div style="padding:8px 0 0 0">서식자료실</div></div>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='list_pds.php?bo_table=erp_pds2'"><div style="padding:8px 0 0 0">영업자료실</div></div>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='list_pds.php?bo_table=erp_pds3'"><div style="padding:8px 0 0 0">서류자료실</div></div>
<?
	} else if($title_main_no == "07") {
?>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='groupware_business_log.php'"><div style="padding:8px 0 0 0">전자결재</div></div>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='groupware_pay_stubs.php'"><div style="padding:8px 0 0 0">급여명세</div></div>
<?
		//영업사원 제외 160823
		if($member['mb_level'] != 7) {
?>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='list_notice.php?bo_table=erp_punctuality'"><div style="padding:8px 0 0 0">근태관리</div></div>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='groupware_attendance.php'"><div style="padding:8px 0 0 0">출근부</div></div>
<?
			//관리자, 대표, 부장, 과장, 회계 담당자 161205
			if($member['mb_id'] == "master" || $member['mb_id'] == "kcmc1001" || $member['mb_id'] == "kcmc1004" || $member['mb_id'] == "kcmc1008") {
?>
							<div style="width:150px;height:30px;background:url('images/sub_menu_bg_on.gif') no-repeat;color:#ffffff;cursor:pointer;text-align:center;float:left;" onclick="location.href='address_book.php'"><div style="padding:8px 0 0 0">주소록</div></div>
<?
			}
		}
	}
//}
?>