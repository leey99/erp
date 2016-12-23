<?
$sub_menu = "300100";
include_once("./_common.php");

//auth_check($auth[$sub_menu], "w");
//mysql_query("set names euckr");

$now_time = date("Y-m-d H:i:s");
$now_date = date("Y.m.d");

for($app_no=1;$app_no<=$app_count;$app_no++) {
	$k = $app_no;
	if($k == 1) $k = "";
	$idx = $_POST['idx'.$k];
	//천단위콤마 제거
	$application_fee_sum = str_replace(',','',$_POST['application_fee_sum'.$k]);
	$client_receipt_fee = str_replace(',','',$_POST['client_receipt_fee'.$k]);
	$requested_amount = str_replace(',','',$_POST['requested_amount'.$k]);
	$main_receipt_fee = str_replace(',','',$_POST['main_receipt_fee'.$k]);
	$main_income = str_replace(',','',$_POST['main_income'.$k]);
	$lawyer_fee = str_replace(',','',$_POST['lawyer_fee'.$k]);
	$allowance_pay = str_replace(',','',$_POST['allowance_pay'.$k]);
	$sales_pay = str_replace(',','',$_POST['sales_pay'.$k]);
	//업무지원수당 수수료 비율 160302
	$service_support_rate = str_replace(',','',$_POST['service_support_rate'.$k]);
	//업무지원수당금액
	$service_support_pay = str_replace(',','',$_POST['service_support_pay'.$k]);
	//지원금 종류
	$application_kind = $_POST['application_kind'.$k];
	//이관 160127
	$transfer_chk = $_POST['transfer_chk'.$k];
	//본사조회 160321
	$inquiry_chk = $_POST['inquiry_chk'.$k];
	//신규등록 160331
	$new_chk = $_POST['new_chk'.$k];
	//메모
	$application_review = $_POST['application_review'.$k];
	$application_recognize = $_POST['application_recognize'.$k];
	$application_send = $_POST['application_send'.$k];
	$application_send_no = $_POST['application_send_no'.$k];
	$application_accept = $_POST['application_accept'.$k];
	//선청기간/분기 선택
	$application_date_chk = $_POST['application_date_chk'.$k];
	$application_date_start = $_POST['application_date_start'.$k];
	$application_date_end = $_POST['application_date_end'.$k];
	//신청년도
	$application_quarter_year = $_POST['application_quarter_year'.$k.'_1'].",".$_POST['application_quarter_year'.$k.'_2'].",".$_POST['application_quarter_year'.$k.'_3'];
	//선청분기
	$application_quarter = $_POST['application_quarter'.$k.'_1_1'].",".$_POST['application_quarter'.$k.'_1_2'].",".$_POST['application_quarter'.$k.'_1_3'].",".$_POST['application_quarter'.$k.'_1_4']."_".$_POST['application_quarter'.$k.'_2_1'].",".$_POST['application_quarter'.$k.'_2_2'].",".$_POST['application_quarter'.$k.'_2_3'].",".$_POST['application_quarter'.$k.'_2_4']."_".$_POST['application_quarter'.$k.'_3_1'].",".$_POST['application_quarter'.$k.'_3_2'].",".$_POST['application_quarter'.$k.'_3_3'].",".$_POST['application_quarter'.$k.'_3_4'];
	$reapplication_date = $_POST['reapplication_date'.$k];
	//재신청일자 완료
	$reapplication_done = $_POST['reapplication_done'.$k];
	//업체입금일, 거래명세서
	$client_receipt_date = $_POST['client_receipt_date'.$k];
	$statement_date = $_POST['statement_date'.$k];
	$tax_invoice = $_POST['tax_invoice'.$k];
	$main_receipt_date = $_POST['main_receipt_date'.$k];
	$receipt_place = $_POST['receipt_place'.$k];
	$person_charge = $_POST['person_charge'.$k];
	//수당료, VAT별도 체크 160128
	$allowance_rate = $_POST['allowance_rate'.$k];
	$allowance_rate_vat_extra = $_POST['allowance_rate_vat_extra'.$k];
	//개인계좌
	$individual_account_var = $_POST['individual_account'.$k];
	//개인계좌
	$lawyer_not_var = $_POST['lawyer_not'.$k];
	//갑근세
	$grade_income_tax_var = $_POST['grade_income_tax'.$k];

	//갑근세(업무지원수당), 업무지원수당료, 무지원지사(담당자)
	$service_support_grade_income_tax = $_POST['service_support_grade_income_tax'.$k];
	$allowance_rate = $_POST['allowance_rate'.$k];
	$service_support_staff = $_POST['service_support_staff'.$k];

	//영업담당자 150903
	$manager_code = $_POST['manager_code'.$k];
	$manager_name = $_POST['manager_name'.$k];
	//커미션
	$sales_rate = $_POST['sales_rate'.$k];
	//계약금세금계산서, 계약금입금일, 계약금, 잔금지급일, 잔금, 부가세포함 150925
	$down_payment_tax = $_POST['down_payment_tax'.$k];
	$down_payment_date = $_POST['down_payment_date'.$k];
	$down_payment = str_replace(',','',$_POST['down_payment'.$k]);
	$remainder_date = $_POST['remainder_date'.$k];
	$remainder = str_replace(',','',$_POST['remainder'.$k]);
	$remainder_vat = str_replace(',','',$_POST['remainder_vat'.$k]);
	//관리자, 본사 권한 150903
	if($member['mb_level'] != 6) {
		$sql_common_app_master = " 
							application_kind = '$application_kind',
							transfer_chk = '$transfer_chk',
							inquiry_chk = '$inquiry_chk',
							new_chk = '$new_chk',
							application_review = '$application_review',
							application_recognize = '$application_recognize',
							application_send = '$application_send',
							application_send_no = '$application_send_no',

							application_date_chk = '$application_date_chk',
							application_date_start = '$application_date_start',
							application_date_end = '$application_date_end',
							application_quarter_year = '$application_quarter_year',
							application_quarter = '$application_quarter',
							application_fee_sum = '$application_fee_sum',
							reapplication_date = '$reapplication_date',
							reapplication_done = '$reapplication_done',

							down_payment_tax = '$down_payment_tax',
							down_payment_date = '$down_payment_date',
							down_payment = '$down_payment',
							remainder_date = '$remainder_date',
							remainder = '$remainder',
							remainder_vat = '$remainder_vat',

							client_receipt_date = '$client_receipt_date',
							client_receipt_fee = '$client_receipt_fee',
							statement_date = '$statement_date',
							requested_amount = '$requested_amount',
							tax_invoice = '$tax_invoice',
							main_receipt_date = '$main_receipt_date',
							main_receipt_fee = '$main_receipt_fee',
							receipt_place = '$receipt_place',
							person_charge = '$person_charge',

							lawyer_fee = '$lawyer_fee',
							main_income = '$main_income',
							allowance_rate = '$allowance_rate',
							allowance_rate_vat_extra = '$allowance_rate_vat_extra',
							allowance_pay = '$allowance_pay',
							individual_account = '$individual_account_var',
							lawyer_not = '$lawyer_not_var',
							grade_income_tax = '$grade_income_tax_var',

							service_support_grade_income_tax = '$service_support_grade_income_tax',
							service_support_rate = '$service_support_rate',
							service_support_pay = '$service_support_pay',
							service_support_staff = '$service_support_staff',
		";
	}
	//지원금DB
	$sql_common_app = " 
						w_date = '$now_time',

						$sql_common_app_master

						application_accept = '$application_accept',
						sales_manager = '$manager_code',
						sales_manager_name = '$manager_name',
						sales_rate = '$sales_rate',
						sales_pay = '$sales_pay'
	";
	//지원금DB 데이터 유무
	$sql2 = " select * from erp_application where idx='$idx' ";
	$row2 = sql_fetch($sql2);
	$idx = $row2['idx'];
	$reapplication_done_org = $row2['reapplication_done'];

	//취소일자 : 반려2, 취소3
	if($reapplication_done == 2 || $reapplication_done == 3) {
		$cancel_date = $now_date;
		//최종완료 반려, 취소 건 취소일자 쿼리 161205
		if($reapplication_done_org != 2 && $reapplication_done_org != 3) {
			$cancel_date_sql = " cancel_date = '$cancel_date', ";
		} else {
			$cancel_date_sql = "";
		}
	} else {
		$cancel_date = "";
		$cancel_date_sql = " cancel_date = '$cancel_date', ";
	}

	if($idx) {
		$sql_app = " update erp_application set
					$cancel_date_sql
					$sql_common_app 
					where idx = '$idx'
		";
	} else {
		$sql_app = " insert erp_application set
					$cancel_date_sql
					$sql_common_app 
		";
	}
	//echo $sql_app."<br><br>";
	sql_query($sql_app);

	//지원금(전기요금컨설팅 잔금) DB 160128
	if($application_kind == 23) {
		//분납 9회 -> 24회 160929
		for($sno=1;$sno<=24;$sno++) {
			$remainder_date = $_POST['remainder_date'.$k.'_'.$sno];
			if($remainder_date) {
				$remainder_vat = str_replace(',','',$_POST['remainder_vat'.$k.'_'.$sno]);
				$app_surplus_id = $_POST['app_surplus_id'.$k.'_'.$sno];
				$sql_common_app_surplus = " 
																		remainder_date = '$remainder_date',
																		remainder_vat = '$remainder_vat',
																		requested_amount = '$remainder_vat'
				";
				//회차 구분 추가 160929
				$sql3 = " select * from erp_application_surplus where id='$app_surplus_id' and mid='$idx' and sid='$sno' ";
				$result3 = sql_query($sql3);
				$total3 = mysql_num_rows($result3);
				if($total3) $sql_app_surplus = " update erp_application_surplus set $sql_common_app_surplus where id='$app_surplus_id' and mid='$idx' and sid='$sno' ";
				else $sql_app_surplus = " insert erp_application_surplus set $sql_common_app_surplus , mid='$idx' , sid='$sno' ";
				sql_query($sql_app_surplus);
			}
		}
	}
}
alert("정상적으로 결산 정보가 수정 되었습니다.","settlement_view.php?id=$id&w=$w&page=$page");
?>