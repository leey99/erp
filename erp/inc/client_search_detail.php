
												<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
													<tr>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">취업규칙신고</td>
														<td nowrap class="tdrow">
															<select name="stx_rules_report_if" class="selectfm" onchange="">
																<option value=""   <? if($stx_rules_report_if == "")  echo "selected"; ?>>전체</option>
																<option value="1"  <? if($stx_rules_report_if == "1") echo "selected"; ?>>YES</option>
																<option value="2"  <? if($stx_rules_report_if == "2") echo "selected"; ?>>NO</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0"><? if($stx_retirement_age) echo "<span style='font-weight:bold'>"; ?>정년나이<? if($stx_retirement_age) echo "</span>";?></td>
														<td nowrap class="tdrow">
															<input name="stx_retirement_age"  type="text" class="textfm" style="width:40px;ime-mode:active;" value="<?=$stx_retirement_age?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">신규투자규모</td>
														<td nowrap class="tdrow">
															<select name="stx_new_fund_scale_site" class="selectfm" onchange="">
																<option value=""  <? if($stx_new_fund_scale_site == "")  echo "selected"; ?>>전체</option>
																<option value="1" <? if($stx_new_fund_scale_site == "1") echo "selected"; ?>>부지</option>
																<option value="2" <? if($stx_new_fund_scale_site == "2") echo "selected"; ?>>건축물</option>
																<option value="3" <? if($stx_new_fund_scale_site == "3") echo "selected"; ?>>설비</option>
																<option value="4" <? if($stx_new_fund_scale_site == "4") echo "selected"; ?>>합계</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">공장설립업종</td>
														<td nowrap class="tdrow">
															<select name="stx_establish_type" class="selectfm" onchange="">
																<option value=""  <? if($stx_establish_type == "")  echo "selected"; ?>>전체</option>
																<option value="1" <? if($stx_establish_type == "1") echo "selected"; ?>>동종업종 설립</option>
																<option value="2" <? if($stx_establish_type == "2") echo "selected"; ?>>타업종설립</option>
																<option value="3" <? if($stx_establish_type == "3") echo "selected"; ?>>기타</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0"><? if($stx_refund_request) echo "<span style='font-weight:bold'>"; ?>가족보험환급신청<? if($stx_refund_request) echo "</span>";?></td>
														<td nowrap class="tdrow">
															<select name="stx_refund_request" class="selectfm" onchange="">
																<option value=""   <? if($stx_refund_request == "")  echo "selected"; ?>>전체</option>
																<option value="1"  <? if($stx_refund_request == "1") echo "selected"; ?>>YES</option>
																<option value="2"  <? if($stx_refund_request == "2") echo "selected"; ?>>NO</option>
															</select>
														</td>
													</tr>
													<tr>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사무실/공장분리</td>
														<td nowrap class="tdrow">
															<select name="stx_factory_split" class="selectfm" onchange="">
																<option value=""  <? if($stx_factory_split == "")  echo "selected"; ?>>전체</option>
																<option value="1" <? if($stx_factory_split == "1") echo "selected"; ?>>YES</option>
																<option value="2" <? if($stx_factory_split == "2") echo "selected"; ?>>NO</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">연장나이</td>
														<td nowrap class="tdrow">
															<input name="stx_extend_age"  type="text" class="textfm" style="width:40px;ime-mode:active;" value="<?=$stx_extend_age?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0"><? if($stx_easynomu_request) echo "<span style='font-weight:bold'>"; ?>이지노무의뢰<? if($stx_easynomu_request) echo "</span>";?></td>
														<td nowrap class="tdrow">
															<select name="stx_easynomu_request" class="selectfm" onchange="">
																<option value=""  <? if($stx_easynomu_request == "")  echo "selected"; ?>>전체</option>
																<option value="1" <? if($stx_easynomu_request == "1") echo "selected"; ?>>기본설치</option>
																<option value="2" <? if($stx_easynomu_request == "2") echo "selected"; ?>>급여테이블</option>
																<option value="3" <? if($stx_easynomu_request == "3") echo "selected"; ?>>취업규칙서</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">투자업종해당</td>
														<td nowrap class="tdrow">
															<select name="stx_fund_type_industry" class="selectfm" onchange="">
																<option value=""  <? if($stx_fund_type_industry == "")  echo "selected"; ?>>전체</option>
																<option value="1" <? if($stx_fund_type_industry == "1") echo "selected"; ?>>지역선도산업</option>
																<option value="2" <? if($stx_fund_type_industry == "2") echo "selected"; ?>>지역집중유치업종</option>
																<option value="3" <? if($stx_fund_type_industry == "3") echo "selected"; ?>>지식서비스산업</option>
																<option value="4" <? if($stx_fund_type_industry == "4") echo "selected"; ?>>성장촉진지역</option>
																<option value="5" <? if($stx_fund_type_industry == "5") echo "selected"; ?>>특화업종</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">취업지원프로그램이수자</td>
														<td nowrap class="tdrow">
															<select name="stx_employment_support" class="selectfm" onchange="">
																<option value=""  <? if($stx_employment_support == "")  echo "selected"; ?>>전체</option>
																<option value="1" <? if($stx_employment_support == "1") echo "selected"; ?>>YES</option>
																<option value="2" <? if($stx_employment_support == "2") echo "selected"; ?>>NO</option>
															</select>
														</td>
													</tr>
													<tr>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">공장설립계획</td>
														<td nowrap class="tdrow">
															<select name="stx_establish_proposal_if" class="selectfm" onchange="">
																<option value=""  <? if($stx_establish_proposal_if == "")  echo "selected"; ?>>전체</option>
																<option value="1" <? if($stx_establish_proposal_if == "1") echo "selected"; ?>>YES</option>
																<option value="2" <? if($stx_establish_proposal_if == "2") echo "selected"; ?>>NO</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">다수인원</td>
														<td nowrap class="tdrow">
															<input name="stx_multitude"  type="text" class="textfm" style="width:40px;ime-mode:active;" value="<?=$stx_multitude?>" onkeydown="if(event.keyCode == 13){ goSearch(); }">
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">부담금진행</td>
														<td nowrap class="tdrow">
															<select name="stx_charge_progress" class="selectfm" onchange="">
																<option value=""  <? if($stx_charge_progress == "")  echo "selected"; ?>>전체</option>
																<option value="1" <? if($stx_charge_progress == "1") echo "selected"; ?>>전기</option>
																<option value="2" <? if($stx_charge_progress == "2") echo "selected"; ?>>물</option>
																<option value="3" <? if($stx_charge_progress == "3") echo "selected"; ?>>농지보전</option>
																<option value="4" <? if($stx_charge_progress == "4") echo "selected"; ?>>기타</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">공장설립방법</td>
														<td nowrap class="tdrow">
															<select name="stx_establish_way" class="selectfm" onchange="">
																<option value=""  <? if($stx_establish_way == "")  echo "selected"; ?>>전체</option>
																<option value="1" <? if($stx_establish_way == "1") echo "selected"; ?>>임대</option>
																<option value="2" <? if($stx_establish_way == "2") echo "selected"; ?>>신규자가공장설립</option>
																<option value="3" <? if($stx_establish_way == "3") echo "selected"; ?>>공장매입</option>
																<option value="4" <? if($stx_establish_way == "4") echo "selected"; ?>>제2공장</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">사업주산재보험가입</td>
														<td nowrap class="tdrow">
															<select name="stx_sj_if" class="selectfm" onchange="">
																<option value=""  <? if($stx_sj_if == "")  echo "selected"; ?>>전체</option>
																<option value="1" <? if($stx_sj_if == "1") echo "selected"; ?>>YES</option>
																<option value="2" <? if($stx_sj_if == "2") echo "selected"; ?>>NO</option>
															</select>
														</td>
													</tr>
													<tr>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">중증장애인채용</td>
														<td nowrap class="tdrow">
															<select name="stx_handicapped_employment" class="selectfm" onchange="">
																<option value=""  <? if($stx_handicapped_employment == "")  echo "selected"; ?>>전체</option>
																<option value="1" <? if($stx_handicapped_employment == "1") echo "selected"; ?>>YES</option>
																<option value="2" <? if($stx_handicapped_employment == "2") echo "selected"; ?>>NO</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">산재여부</td>
														<td nowrap class="tdrow">
															<select name="stx_disaster_if" class="selectfm" onchange="">
																<option value=""  <? if($stx_disaster_if == "")  echo "selected"; ?>>전체</option>
																<option value="1" <? if($stx_disaster_if == "1") echo "selected"; ?>>YES</option>
																<option value="2" <? if($stx_disaster_if == "2") echo "selected"; ?>>NO</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">창업여부</td>
														<td nowrap class="tdrow">
															<select name="stx_found_if" class="selectfm" onchange="">
																<option value=""  <? if($stx_found_if == "")  echo "selected"; ?>>전체</option>
																<option value="1" <? if($stx_found_if == "1") echo "selected"; ?>>자기소유</option>
																<option value="2" <? if($stx_found_if == "2") echo "selected"; ?>>임대</option>
																<option value="3" <? if($stx_found_if == "3") echo "selected"; ?>>개별입지</option>
																<option value="4" <? if($stx_found_if == "4") echo "selected"; ?>>계획입지</option>
																<option value="5" <? if($stx_found_if == "5") echo "selected"; ?>>공장등록</option>
																<option value="6" <? if($stx_found_if == "6") echo "selected"; ?>>미등록</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">지역성장지원대상업종</td>
														<td nowrap class="tdrow">
															<select name="stx_subsidy_type_if" class="selectfm" onchange="">
																<option value=""   <? if($stx_subsidy_type_if == "")   echo "selected"; ?>>전체</option>
																<option value="1"  <? if($stx_subsidy_type_if == "1")  echo "selected"; ?>>신재생에너지</option>
																<option value="2"  <? if($stx_subsidy_type_if == "2")  echo "selected"; ?>>콘텐츠/SW</option>
																<option value="3"  <? if($stx_subsidy_type_if == "3")  echo "selected"; ?>>방송통신융합</option>
																<option value="4"  <? if($stx_subsidy_type_if == "4")  echo "selected"; ?>>LED응용</option>
																<option value="5"  <? if($stx_subsidy_type_if == "5")  echo "selected"; ?>>그린수송시스템</option>
																<option value="6"  <? if($stx_subsidy_type_if == "6")  echo "selected"; ?>>로봇응용</option>
																<option value="7"  <? if($stx_subsidy_type_if == "7")  echo "selected"; ?>>신소재,나노융합</option>
																<option value="8"  <? if($stx_subsidy_type_if == "8")  echo "selected"; ?>>IT융합</option>
																<option value="9"  <? if($stx_subsidy_type_if == "9")  echo "selected"; ?>>바이오,헬스케어</option>
																<option value="10" <? if($stx_subsidy_type_if == "10") echo "selected"; ?>>교육</option>
																<option value="11" <? if($stx_subsidy_type_if == "11") echo "selected"; ?>>고부가식품</option>
																<option value="12" <? if($stx_subsidy_type_if == "12") echo "selected"; ?>>탄소저감에너지</option>
																<option value="13" <? if($stx_subsidy_type_if == "13") echo "selected"; ?>>첨단그린도시</option>
																<option value="14" <? if($stx_subsidy_type_if == "14") echo "selected"; ?>>고도물처리</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">자가공장용지1000㎡미만</td>
														<td nowrap class="tdrow">
															<select name="stx_factory_site_1000" class="selectfm" onchange="">
																<option value=""  <? if($stx_factory_site_1000 == "")  echo "selected"; ?>>전체</option>
																<option value="1" <? if($stx_factory_site_1000 == "1") echo "selected"; ?>>YES</option>
																<option value="2" <? if($stx_factory_site_1000 == "2") echo "selected"; ?>>NO</option>
															</select>
														</td>
													</tr>
													<tr>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">여성가장채용</td>
														<td nowrap class="tdrow">
															<select name="stx_women_matriarch_if" class="selectfm" onchange="">
																<option value=""  <? if($stx_women_matriarch_if == "")  echo "selected"; ?>>전체</option>
																<option value="1" <? if($stx_women_matriarch_if == "1") echo "selected"; ?>>YES</option>
																<option value="2" <? if($stx_women_matriarch_if == "2") echo "selected"; ?>>NO</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">취등록세</td>
														<td nowrap class="tdrow">
															<select name="stx_found_tax" class="selectfm" onchange="">
																<option value=""  <? if($stx_found_tax == "")  echo "selected"; ?>>전체</option>
																<option value="1" <? if($stx_found_tax == "1") echo "selected"; ?>>면제</option>
																<option value="2" <? if($stx_found_tax == "2") echo "selected"; ?>>납부</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">투자금조달계획</td>
														<td nowrap class="tdrow">
															<select name="stx_disaster_if" class="selectfm" onchange="">
																<option value=""  <? if($stx_disaster_if == "")  echo "selected"; ?>>전체</option>
																<option value="1" <? if($stx_disaster_if == "1") echo "selected"; ?>>내부자금</option>
																<option value="2" <? if($stx_disaster_if == "2") echo "selected"; ?>>외부자금</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">고용창출사업계획서</td>
														<td nowrap class="tdrow">
															<select name="stx_job_creation_proposal" class="selectfm" onchange="">
																<option value=""  <? if($stx_job_creation_proposal == "")  echo "selected"; ?>>전체</option>
																<option value="1" <? if($stx_job_creation_proposal == "1") echo "selected"; ?>>전문인력</option>
																<option value="2" <? if($stx_job_creation_proposal == "2") echo "selected"; ?>>고용환경</option>
																<option value="3" <? if($stx_job_creation_proposal == "3") echo "selected"; ?>>일자리함께</option>
																<option value="4" <? if($stx_job_creation_proposal == "4") echo "selected"; ?>>시간선택제</option>
																<option value="5" <? if($stx_job_creation_proposal == "5") echo "selected"; ?>>지역성장</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">취업규칙/급여정비</td>
														<td nowrap class="tdrow">
															<select name="stx_rule_pay" class="selectfm" onchange="">
																<option value=""  <? if($stx_rule_pay == "")  echo "selected"; ?>>전체</option>
																<option value="1" <? if($stx_rule_pay == "1") echo "selected"; ?>>YES</option>
																<option value="2" <? if($stx_rule_pay == "2") echo "selected"; ?>>NO</option>
															</select>
														</td>
													</tr>
													<tr>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">도서지역거주자</td>
														<td nowrap class="tdrow">
															<select name="stx_rural_areas" class="selectfm" onchange="">
																<option value=""  <? if($stx_rural_areas == "")  echo "selected"; ?>>전체</option>
																<option value="1" <? if($stx_rural_areas == "1") echo "selected"; ?>>YES</option>
																<option value="2" <? if($stx_rural_areas == "2") echo "selected"; ?>>NO</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">임금피크제</td>
														<td nowrap class="tdrow">
															<select name="stx_pay_peak_if" class="selectfm" onchange="">
																<option value=""   <? if($stx_pay_peak_if == "")  echo "selected"; ?>>전체</option>
																<option value="1"  <? if($stx_pay_peak_if == "1") echo "selected"; ?>>YES</option>
																<option value="2"  <? if($stx_pay_peak_if == "2") echo "selected"; ?>>NO</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">연구소경력</td>
														<td nowrap class="tdrow">
															<select name="stx_career_kind" class="selectfm" onchange="">
																<option value=""  <? if($stx_career_kind == "")  echo "selected"; ?>>전체</option>
																<option value="1" <? if($stx_career_kind == "1") echo "selected"; ?>>기능장</option>
																<option value="2" <? if($stx_career_kind == "2") echo "selected"; ?>>명장</option>
																<option value="3" <? if($stx_career_kind == "3") echo "selected"; ?>>기술사</option>
																<option value="4" <? if($stx_career_kind == "4") echo "selected"; ?>>올림픽입상</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">투자계획기본체크사항</td>
														<td nowrap class="tdrow">
															<select name="stx_fund_basic_check" class="selectfm" onchange="">
																<option value=""  <? if($stx_fund_basic_check == "")  echo "selected"; ?>>전체</option>
																<option value="1" <? if($stx_fund_basic_check == "1") echo "selected"; ?>>최근3년매출</option>
																<option value="2" <? if($stx_fund_basic_check == "2") echo "selected"; ?>>신용등급</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">교대제운영</td>
														<td nowrap class="tdrow">
															<select name="stx_shift_system" class="selectfm" onchange="">
																<option value=""  <? if($stx_shift_system == "")  echo "selected"; ?>>전체</option>
																<option value="1" <? if($stx_shift_system == "1") echo "selected"; ?>>2교대</option>
																<option value="2" <? if($stx_shift_system == "2") echo "selected"; ?>>3교대</option>
															</select>
														</td>
													</tr>
													<tr>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">지방세체납</td>
														<td nowrap class="tdrow">
															<select name="stx_local_tax_yn" class="selectfm" onchange="">
																<option value=""  <? if($stx_local_tax_yn == "")  echo "selected"; ?>>전체</option>
																<option value="1" <? if($stx_local_tax_yn == "1") echo "selected"; ?>>YES</option>
																<option value="2" <? if($stx_local_tax_yn == "2") echo "selected"; ?>>NO</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">근로계약서</td>
														<td nowrap class="tdrow">
															<select name="stx_work_contract" class="selectfm" onchange="">
																<option value=""  <? if($stx_work_contract == "")  echo "selected"; ?>>전체</option>
																<option value="1" <? if($stx_work_contract == "1") echo "selected"; ?>>YES</option>
																<option value="2" <? if($stx_work_contract == "2") echo "selected"; ?>>NO</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">투자형태</td>
														<td nowrap class="tdrow">
															<select name="stx_fund_kind" class="selectfm" onchange="">
																<option value=""  <? if($stx_fund_kind == "")  echo "selected"; ?>>전체</option>
																<option value="1" <? if($stx_fund_kind == "1") echo "selected"; ?>>지방이전</option>
																<option value="2" <? if($stx_fund_kind == "2") echo "selected"; ?>>신축</option>
																<option value="3" <? if($stx_fund_kind == "3") echo "selected"; ?>>증축</option>
																<option value="4" <? if($stx_fund_kind == "4") echo "selected"; ?>>제2공장</option>
																<option value="5" <? if($stx_fund_kind == "5") echo "selected"; ?>>복귀기업</option>
																<option value="6" <? if($stx_fund_kind == "6") echo "selected"; ?>>연구소</option>
															</select>
														</td>
														<td nowrap class="tdrowk"><img src="images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">공장설립관련의뢰</td>
														<td nowrap class="tdrow">
															<select name="stx_establish_request" class="selectfm" onchange="">
																<option value=""  <? if($stx_establish_request == "")  echo "selected"; ?>>전체</option>
																<option value="1" <? if($stx_establish_request == "1") echo "selected"; ?>>사업타탕성분석</option>
																<option value="2" <? if($stx_establish_request == "2") echo "selected"; ?>>사업계획서작성</option>
																<option value="3" <? if($stx_establish_request == "3") echo "selected"; ?>>공장설립</option>
																<option value="4" <? if($stx_establish_request == "4") echo "selected"; ?>>공장설립승인신청</option>
																<option value="5" <? if($stx_establish_request == "5") echo "selected"; ?>>공장등록신청</option>
															</select>
														</td>
														<td nowrap class="tdrowk"></td>
														<td nowrap class="tdrow">
														</td>
													</tr>
												</table>
