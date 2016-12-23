<?
//G type 계명전자
?>
<script language="javascript">
// 삭제 검사 확인
function del(page,id) 
{
	if(confirm("삭제하시겠습니까?")) {
		location.href = "4insure_delete.php?page="+page+"&id="+id;
	}
}
function goSearch()
{
	var frm = document.searchForm;
	frm.action = "<?=$PHP_SELF?>";
	frm.submit();
	return;
}
function goInput(mode){
	var f = document.dataForm;
	/*
	if( f.jigub_day.value == "" ){
		alert("지급일을 입력해 주세요.");
		f.jigub_day.focus();
		return;
	}
	*/
	//alert(f.money_month[1].value);
	//alert(<?=$total_count?>);
	//alert(f.w_day.value);
	//w_day = document.getElementsByTagName("w_day[]").;
	//alert(w_day.value);

	//f["w_day_"+0].value = f.workhour_day[1].value;
	//alert(f["w_day_"+0].value);

	for(i=1;i<=<?=$total_count?>;i++) {
		//alert(f.emp_name[i].value);
		k = i-1;
		//alert(f.workhour_day[i].value);
		f["pay_gbn_"+k].value = f.pay_gbn[i].value;

		f["workday_"+k].value = f.workday[i].value;
		f["w_day_"+k].value = f.workhour_day[i].value;
		f["w_ext_"+k].value = f.workhour_ext[i].value;
		f["w_night_"+k].value = f.workhour_night[i].value;
		f["w_hday_"+k].value = f.workhour_hday[i].value;
		f["w_year_"+k].value = f.workhour_year[i].value;

		f["w_ext_add_"+k].value = f.workhour_ext_add[i].value;
		f["w_night_add_"+k].value = f.workhour_night_add[i].value;
		f["w_hday_add_"+k].value = f.workhour_hday_add[i].value;
		//alert(f["w_night_add_"+k].value);

		f["workhour_total_"+k].value = f.workhour_total[i].value;
		//alert(f["workhour_total_"+k].value);

		f["money_hour_ds_"+k].value = f.money_hour_ds[i].value;
		//alert(f["money_hour_ds_"+k].value);
		f["money_hour_ts_"+k].value = f.money_hour_ts[i].value;
		//기본시급
		f["money_time_"+k].value = f.money_time[i].value;
		//f["money_day_"+k].value = f.money_day[i].value;
		f["money_month_"+k].value = f.money_base[i].value;
		f["money_setting_"+k].value = f.money_month[i].value;

		f["g1_"+k].value = f.money_g1[i].value;
		f["g2_"+k].value = f.money_g2[i].value;
		f["g3_"+k].value = f.money_g3[i].value;
		f["g4_"+k].value = f.money_g4[i].value;
		f["g5_"+k].value = f.money_g5[i].value;

		f["ext_"+k].value = f.money_ext[i].value;
		f["night_"+k].value = f.money_night[i].value;
		f["hday_"+k].value = f.money_hday[i].value;
		f["annual_paid_holiday_"+k].value = f.money_year[i].value;

		f["ext_add_"+k].value = f.money_ext_add[i].value;
		f["night_add_"+k].value = f.money_night_add[i].value;
		f["hday_add_"+k].value = f.money_hday_add[i].value;

		f["e1_"+k].value = f.money_e1[i].value;
		f["e2_"+k].value = f.money_e2[i].value;
		f["e3_"+k].value = f.money_e3[i].value;
		f["e4_"+k].value = f.money_e4[i].value;
		f["e5_"+k].value = f.money_e5[i].value;
		f["e6_"+k].value = f.money_e6[i].value;
		f["e7_"+k].value = f.money_e7[i].value;
		f["e8_"+k].value = f.money_e8[i].value;

		f["tax_so_var_"+k].value = f.tax_so[i].value;
		f["tax_jumin_var_"+k].value = f.tax_jumin[i].value;
		f["advance_pay_"+k].value = f.advance_pay[i].value;
		f["health_"+k].value = f.money_health[i].value;
		f["yoyang_"+k].value = f.money_yoyang[i].value;
		f["yun_"+k].value = f.money_yun[i].value;
		f["goyong_"+k].value = f.money_goyong[i].value;
		//f["end_pay_"+k].value = f.end_pay[i].value;
		f["minus_"+k].value = f.minus[i].value;

		f["money_total_"+k].value = f.money_total[i].value;
		f["money_for_tax_"+k].value = f.money_for_tax[i].value;
		f["money_gongje_"+k].value = f.money_gongje[i].value;
		f["money_result_"+k].value = f.money_result[i].value;
	}

	f.mode.value = mode;
	f.action = "pay_update.php";
	f.submit();
}
//급여반영 입력폼
var ary_tax = new Array();
var ary_tax2 = new Array();
var ary_tax3 = new Array();
var ary_tax4 = new Array();
var ary_tax5 = new Array();
var ary_tax6 = new Array();
var ary_tax7 = new Array();
var ary_tax8 = new Array();
var ary_tax9 = new Array();
var ary_tax10 = new Array();
var ary_tax11 = new Array();
<?
//2015년도 7월 개정 근로소득 간의세액표 150821
//if($search_year >= 2015 && $search_month >= 7) {
//2015년도 소득 세액표 기준 연월 재설정 160226
$search_year_month = $search_year.".".$search_month;
if($search_year_month >= "2015.07") {
	include "./inc/ary_tax_2015.php";
} else {
	include "./inc/ary_tax.php";
}
?>
function loadCalendar( obj ) {
	var calendar = new Calendar(0, null, onSelect, onClose);
	calendar.create();
	calendar.parseDate(obj.value);
	calendar.showAtElement(obj, "Br");
	function onSelect(calendar, date) {
		var input_field = obj;
		input_field.value = date;
		if (calendar.dateClicked) {
			calendar.callCloseHandler();
		}
	};
	function onClose(calendar) {
		calendar.hide();
		calendar.destroy();
	};
}
function checkAll(){
	var f = document.dataForm;
	for( var i = 1; i<f.idx.length; i++ ) {
		f.idx[i].checked = f.checkall.checked;
	}
}
function GetTax(money_for_tax) {
	//alert(money_for_tax); //460000
	var i, money_base, smoney, emoney, tax, tax_result
	money_base = parseInt( money_for_tax / 1000 )
	tax_result = 0
	//alert(money_base); //460
	//alert(ary_tax.length);
	for( var i=0; i <ary_tax.length; i++ ){
	//for( var i=0; i <10; i++ ){
		smoney = ary_tax[i][0];
		emoney = ary_tax[i][1];
		tax = ary_tax[i][2];
		//alert(smoney);
		if( money_base >= smoney && money_base < emoney ) {
			tax_result = tax;
			break;
		}
	}
	return tax_result;
}
function cal_pay(idx) {
	var f = document.dataForm;
	var pay_gbn;
	var money_month,money_hour,money_hour_ds,money_hour_ts,workday,workhour_day,workhour_ext,workhour_night,workhour_hday,workhour_year,workhour_ext_add,workhour_night_add,workhour_hday_add,workhour_total;
	var week_hday,year_hday,money_base,money_ext,money_night,money_hday,money_ext_add,money_night_add,money_hday_add,money_week,money_year;
	var money_g1,money_g2,money_g3,money_g4,money_g5,money_e1,money_e2,money_e3,money_e4,money_e5,money_e6,money_e7,money_e8;
	var money_g_sum, money_b_sum, money_e_sum;
	var money_total,money_for_tax,money_yun,money_health,money_yoyang,money_goyong,tax_so,tax_jumin,minus,money_gongje,money_result;

	pay_gbn 		    = toInt(f.pay_gbn 		  [idx].value);
	money_month     = toInt(f.money_month   [idx].value);    //기본월급 mm--        
	money_hour      = toInt(f.money_hour    [idx].value); 	//기준시급 hh--        
	money_hour_ds   = toInt(f.money_month 	[idx].value);	//기준시급(시급제)
	money_hour_ts   = toInt(f.money_hour_ts [idx].value);	//통상임금(시간급)

	workday         = toFloat(f.workday       [idx].value);	//근로일수
	workhour_day    = toFloat(f.workhour_day  [idx].value);	//소정근로시간         
	workhour_ext    = toFloat(f.workhour_ext  [idx].value);	//연장근로시간         
	workhour_night  = toFloat(f.workhour_night[idx].value);	//야간근로시간
	workhour_hday   = toFloat(f.workhour_hday [idx].value);	//휴일근로시간
	workhour_year   = toFloat(f.workhour_year [idx].value);	//특별근로시간
	//workhour_year = 0;

	workhour_ext_add    = toFloat(f.workhour_ext_add  [idx].value);	//추가연장근로시간
	workhour_night_add    = toFloat(f.workhour_night_add  [idx].value);	//추가야간근로시간
	workhour_hday_add   = 0; //변경 140331

	workhour_total  = toFloat(f.workhour_total[idx].value);	//임금산출 총시간 mm-- 
	week_hday       = toInt(f.week_hday     [idx].value);   // 주휴일일수 hh--      
	year_hday       = toInt(f.year_hday     [idx].value);	// 연차유급휴가일수 hh--
	money_base      = toInt(f.money_base    [idx].value);	// 기본급               
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

	money_e6_g      = toInt(f.money_e6      [idx].value); //납땜수당
	money_e7_g      = toInt(f.money_e7      [idx].value); //교통비

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
	money_gongje    = toInt(f.money_gongje  [idx].value);	//공제계       
	money_result    = toInt(f.money_result  [idx].value);	//공제후 지급액

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
//야간근로
$sql_paycode = " select * from com_paycode_list where com_code = '$com_code' and code='b2' ";
$row_paycode = sql_fetch($sql_paycode);
if($row_paycode[multiple]) {
	$rate_night = $row_paycode[multiple];
} else {
	$rate_night = 2;
}
//휴일근로
$sql_paycode = " select * from com_paycode_list where com_code = '$com_code' and code='b3' ";
$row_paycode = sql_fetch($sql_paycode);
if($row_paycode[multiple]) {
	$rate_hday = $row_paycode[multiple];
} else {
	$rate_hday = 1.5;
}
?>
		rate_ext = <?=$rate_ext?>;
		rate_night = <?=$rate_night?>;
		rate_hday = <?=$rate_hday?>;
	}

	//통상임금수당 합계
	money_g_sum = money_g1+money_g2+money_g3+money_g4+money_g5;
	//alert(money_g_sum+"="+money_g1+"+"+money_g2+"+"+money_g3+"+"+money_g4+"+"+money_g5);

	if(workday != 0) {
		//납땜수당
		money_e6_g = workday * 1000;
		//교통비
		money_e7_g = workday * 2000;
	}

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
		workhour_total = parseInt( ( workhour_day + (workhour_ext*rate_ext) + (workhour_night*rate_night) + (workhour_hday*rate_hday) + (workhour_year*rate_hday) ) * 1000 ) / 1000; // 야간근로수당 제외 -----------
		workhour_total = Math.round(workhour_total*100)/100;
		money_base = Math.round( money_hour * workhour_day );
		//money_hour_ts = Math.round( money_hour + ( money_g_sum / workhour_day ) );
		//통상임금 = 결정임금
		money_hour_ts = money_month;
		//money_hour_ts = 5160;
		if( isNaN(money_hour_ts) ) money_hour_ts = 0;
		f.money_hour_ds[idx].value = money_hour_ds;
		//alert(money_hour_ds);
	} else {
		//workhour_total 임금산출 총시간 mm--
		workhour_total = workhour_day + (workhour_ext*rate_ext) + (workhour_night*rate_night) + (workhour_hday*rate_hday) + (workhour_ext_add*rate_ext) + (workhour_night_add*rate_night) + (workhour_hday_add*rate_hday) + (workhour_year*rate_hday);

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
					money_base = toInt(f.money_hour_ms[idx].value);
				} else {
					money_base = money_month - (money_ext + money_night + money_hday) - (money_g_sum + money_e_sum) - money_year;
					//alert(money_base+" = "+money_month+" - ("+money_ext+" + "+money_night+" + "+money_hday+") - ("+money_g_sum+" + "+money_e_sum+") - "+money_year);
				}
				//급여 해당월 중간 입사자 기본급 설정
				if(money_base > money_month_old) {
					money_base = money_month - (money_ext + money_night + money_hday) - (money_g_sum + money_e_sum) - money_year;
				}
				money_hour_ts = Math.round( ( money_base + money_g_sum ) / workhour_day);
				//alert(money_hour_ts+"=("+money_base+"+"+money_g_sum+")/"+workhour_day);
				//alert(money_base);
			} else {
				money_base = money_month - (money_ext + money_night + money_hday) - (money_g_sum + money_e_sum) - money_year;
				money_hour_ts = ( money_month - money_g_sum ) / workhour_day;
			}
		}
	}
	//money_ext 연장근로수당 
	//money_hday 휴일근로수당
	//money_night 야간근로수당 
	//money_year 연차수당 -----------------------------------

	//법정수당 수동입력
	if(f.check_money_b_yn[idx].value == "Y") {
		money_ext = parseInt(f.money_b1[idx].value);
		money_night = parseInt(f.money_b2[idx].value);
		money_hday = parseInt(f.money_b3[idx].value);

	} else {
		money_ext = Math.round(workhour_ext * money_hour_ts * rate_ext);
		money_night = Math.round(workhour_night * money_hour_ts * rate_night);
		money_hday = Math.round(workhour_hday * money_hour_ts * rate_hday);

	}
	//추가근로수당
	money_ext_add = Math.round(workhour_ext_add * money_hour_ts * rate_ext);
	money_night_add = Math.round(workhour_night_add * money_hour_ts * rate_night);
	money_hday_add = Math.round(workhour_hday_add * money_hour_ts * rate_hday);
	//연차수당
	money_year = Math.round(workhour_year * money_hour_ts * rate_hday);

	//결정임금 변경으로 통상시급, 기본급 변경 반복문
	if(money_month_old != money_month) {
		for(i=0;i<20;i++) {
			money_base = money_month - (money_ext + money_night + money_hday) - (money_g_sum + money_e_sum) - money_year;
			//alert(money_base+" = "+money_month+" - ("+money_ext+" + "+money_night+" + "+money_hday+") - ("+money_g_sum+" + "+money_e_sum+") - "+money_year);
			//시급제 (통상임금 설정)
			if(pay_gbn == 1) money_hour_ts = money_month;
			else money_hour_ts = Math.round( ( money_base + money_g_sum ) / workhour_day);
			//alert(money_hour_ts+"=("+money_base+"+"+money_g_sum+")/"+workhour_day);
			money_ext = Math.round(workhour_ext * money_hour_ts * rate_ext);
			//alert(money_ext);
			money_hday = Math.round(workhour_hday * money_hour_ts * rate_hday);
			money_year = Math.round(workhour_year * money_hour_ts * rate_hday);
			money_night = Math.round(workhour_night * money_hour_ts * rate_night);
			money_ext_add = Math.round(workhour_ext_add * money_hour_ts * rate_ext);
			money_night_add = Math.round(workhour_night_add * money_hour_ts * rate_night);
			money_hday_add = Math.round(workhour_hday_add * money_hour_ts * rate_hday);
		}
	}
	//통상임금(시간급) 반올림
	money_hour_ts = Math.round(money_hour_ts);
	//money_base = money_month - (money_ext + money_night + money_hday) - money_g_sum - money_year;
	//기본급 계산식
	//alert(money_base+"="+money_month+"-("+money_ext+"+"+money_night+"+"+money_hday+")-("+money_g_sum+"+"+money_e_sum+")-"+money_year);
	//alert(money_base+"="+money_month+"-("+money_ext+"+"+money_night+"+"+money_hday+")-"+money_g_sum+"-"+money_year);
	//money_total 임금계 
	//money_total = money_month+money_g_sum+money_e_sum;
	money_total = money_base + (money_ext + money_hday + money_night + money_year) + (money_ext_add + money_hday_add + money_night_add) + (money_g_sum + money_e_sum);
	//money_for_tax 과세소득 
	//money_for_tax = money_total - money_g1 - money_g2 - money_g3;

	//기타수당 과세포함 여부
	//alert(f.money_e6_income.value);
	if(f.money_e1_income.value == "Y") money_e1 = 0;
	if(f.money_e2_income.value == "Y") money_e2 = 0;
	if(f.money_e3_income.value == "Y") money_e3 = 0;
	if(f.money_e4_income.value == "Y") money_e4 = 0;
	if(f.money_e5_income.value == "Y") money_e5 = 0;
	if(f.money_e6_income.value == "Y") money_e6 = 0;
	if(f.money_e7_income.value == "Y") money_e7 = 0;
	if(f.money_e8_income.value == "Y") money_e8 = 0;

	//기타수당 합계 (과세소득 계산용)
	money_e_income_sum = money_e1+money_e2+money_e3+money_e4+money_e5+money_e6+money_e7+money_e8;

	money_for_tax = money_total - money_e_income_sum;

	//두루누리 지원금 50%
	//durunuri_50 = 1;
	//alert(durunuri);
	if(f.durunuri[idx].value == "1") durunuri_50 = 2;
	else durunuri_50 = 1;

	//money_yun 국민연금  
	//money_yun = parseInt( ( parseInt(money_for_tax/1000)*1000 * 0.045 ) * 0.1 ) * 10
	money_yun = get_round( parseInt(money_for_tax) * 0.045 / durunuri_50 );
	//money_health 건강보험 
	//money_health = parseInt(money_for_tax* 0.02945 *0.1)*10
	//money_health = get_round( parseInt(money_for_tax) * 0.02945 );
	money_health = get_round( parseInt(money_for_tax) * 0.02995 );
	//money_yoyang 장기요양보험 
	//money_yoyang = parseInt(money_health* 0.0655 *0.1)*10
	money_yoyang = get_round( money_health* 0.0655  );
	//alert(money_yoyang);
	//money_goyong 고용보험
	money_goyong = get_round( parseInt(money_for_tax) * 0.0065 / durunuri_50 );
	//tax_so 소득세
	if(f.check_money_so_yn[idx].value == "0") {
		tax_so = GetTax( money_for_tax );
	} else {
		tax_so = 0;
	}
	//tax_jumin 주민세
	tax_jumin = get_round(tax_so* 0.1 );
	//4대보험 공제 제외
	if(f.iskm[idx].value != "checked") money_yun = 0;
	if(f.isgg[idx].value != "checked") money_health = 0;
	if(f.isgg[idx].value != "checked") money_yoyang = 0;
	if(f.isgy[idx].value != "checked") money_goyong = 0;
	//if(f.isgy.value == "checked") money_goyong = 0;
	//money_gongje 공제계 
	money_gongje = money_yun+money_health+money_yoyang+money_goyong+tax_so+tax_jumin+minus;
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
	money_base = number_format(money_base);
	money_ext = number_format(money_ext);
	money_hday = number_format(money_hday);
	money_night = number_format(money_night);
	money_year = number_format(money_year);

	money_ext_add = number_format(money_ext_add);
	money_hday_add = number_format(money_hday_add);
	money_night_add = number_format(money_night_add);

	//money_hour_ts = number_format(money_hour_ts);

	money_total = number_format(money_total);
	money_for_tax = number_format(money_for_tax);

	money_yun = number_format(money_yun);
	money_health = number_format(money_health);
	money_yoyang = number_format(money_yoyang);
	money_goyong = number_format(money_goyong);
	tax_so = number_format(tax_so);
	tax_jumin = number_format(tax_jumin);
	money_gongje = number_format(money_gongje);
	money_result = number_format(money_result);

	//변수 input 입력
	f.error_code.value = money_base;
	f.money_hour_ts[idx].value = money_hour_ts //money_hour_ts 통상임금(시간급) 
	f.workhour_total[idx].value = workhour_total //workhour_total 임금산출 총시간 mm--
	f.money_base[idx].value = money_base //money_base 기본급
	f.money_ext[idx].value = money_ext //money_ext 연장근로수당 
	f.money_hday[idx].value = money_hday //money_hday 휴일근로수당 
	f.money_night[idx].value = money_night //money_night 야간근로수당 
	f.money_year[idx].value = money_year //money_year 연차수당 ------------------------

	f.money_ext_add[idx].value = money_ext_add //money_ext 연장근로수당(추가)
	f.money_hday_add[idx].value = money_hday_add //money_hday 휴일근로수당(추가)
	f.money_night_add[idx].value = money_night_add //money_night 야간근로수당(추가)

	//납땡수당, 교통비
	f.money_e6[idx].value = number_format(money_e6_g);
	f.money_e7[idx].value = number_format(money_e7_g);

	f.money_total[idx].value = money_total //money_total 임금계 
	f.money_for_tax[idx].value = money_for_tax //money_for_tax 과세소득 

	f.money_yun[idx].value = money_yun //money_yun 국민연금 
	f.money_health[idx].value = money_health //money_health 건강보험 
	f.money_yoyang[idx].value = money_yoyang //money_yoyang 장기요양보험 
	f.money_goyong[idx].value = money_goyong //money_goyong 고용보험 

	f.tax_so[idx].value = tax_so //tax_so 소득세 
	f.tax_jumin[idx].value = tax_jumin //tax_jumin 주민세 
	f.money_gongje[idx].value = money_gongje //money_gongje 공제계 
	f.money_result[idx].value = money_result //money_result 공제후 지급액 
}
function cal_pay2(idx){
	var f = document.dataForm;
	var money_month,money_hour,money_hour_ts,workday,workhour_day,workhour_ext,workhour_night,workhour_hday,workhour_year,workhour_ext_add,workhour_night_add,workhour_hday_add,workhour_total;
	var week_hday,year_hday,money_base,money_ext,money_night,money_hday,money_ext_add,money_night_add,money_hday_add,money_week,money_year;
	var money_g1,money_g2,money_g3,money_g4,money_g5,money_e1,money_e2,money_e3,money_e4,money_e5,money_e6,money_e7,money_e8;
	var money_total,money_for_tax,money_yun,money_health,money_yoyang,money_goyong,tax_so,tax_jumin,minus,money_gongje,money_result;
	money_month     = toInt(f.money_month   [idx].value);    //기본월급 mm--        
	money_hour      = toInt(f.money_hour    [idx].value); 	//기준시급 hh--        
	money_hour_ts   = toInt(f.money_hour_ts [idx].value);	//통상임금(시간급)     

	workday         = toFloat(f.workday       [idx].value);	//근로일수
	workhour_day    = toFloat(f.workhour_day  [idx].value);	//소정근로시간         
	workhour_ext    = toFloat(f.workhour_ext  [idx].value);	//연장근로시간
	workhour_night  = toFloat(f.workhour_night[idx].value);	//야간근로시간         
	workhour_hday   = toFloat(f.workhour_hday [idx].value);	//휴일근로시간         
	workhour_year   = toFloat(f.workhour_year [idx].value);	//특별근로시간

	workhour_ext_add     = toFloat(f.workhour_ext_add  [idx].value);	//추가연장근로시간
	workhour_night_add   = toFloat(f.workhour_night_add  [idx].value);	//추가야간근로시간
	workhour_hday_add    = toFloat(f.workhour_hday_add  [idx].value);	//추가휴일근로시간

	workhour_total  = toFloat(f.workhour_total[idx].value);	//임금산출 총시간 mm-- 
	week_hday       = toInt(f.week_hday     [idx].value);   // 주휴일일수 hh--      
	year_hday       = toInt(f.year_hday     [idx].value);	// 연차유급휴가일수 hh--
	money_base      = toInt(f.money_base    [idx].value);	// 기본급               
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
	money_gongje    = toInt(f.money_gongje  [idx].value);	//공제계       
	money_result    = toInt(f.money_result  [idx].value);	//공제후 지급액

	//money_gongje 공제계 = 국민연금+건강보험+장기요양보험+고용보험+소득세+주민세
	money_gongje = money_yun+money_health+money_yoyang+money_goyong+tax_so+tax_jumin+minus;
	//money_result 공제후 지급액 
	money_result = money_total - money_gongje;
	f.money_gongje[idx].value = number_format(money_gongje); //money_gongje 공제계 
	f.money_result[idx].value = number_format(money_result); //money_result 공제후 지급액 
}
function cal_pay3(idx) {
	var f = document.dataForm;
	var tax_so,tax_jumin;
	tax_so = toInt(f.tax_so[idx].value); //소득세
	//tax_jumin 주민세 
	tax_jumin = parseInt(tax_so*0.1*0.1)*10;
	f.tax_jumin[idx].value = number_format(tax_jumin);
	cal_pay2(idx); // 공제후 지급액 재계산
}
function focusClickClass(idx) {
	var f = document.dataForm;
	//alert(f.idx[idx].checked);
	if(f.idx[idx].checked == true) {
		focusInClass(idx);
	} else {
		focusOutClass(idx);
	}
}
function focusInClass(idx) {
	var frm = document.dataForm;
	//frm.emp_pname[idx].className = "textfm_trans";
	frm.money_month[idx].className = "textfm_trans";
	frm.workday[idx].className = "textfm_trans";
	frm.workhour_day[idx].className = "textfm_trans";
	frm.workhour_ext[idx].className = "textfm_trans";
	frm.workhour_night[idx].className = "textfm_trans";
	frm.workhour_hday[idx].className = "textfm_trans";
	frm.workhour_year[idx].className = "textfm_trans";

	frm.workhour_ext_add[idx].className = "textfm_trans";
	frm.workhour_night_add[idx].className = "textfm_trans";

	frm.workhour_total[idx].className = "textfm_trans";
	frm.money_hour_ts[idx].className = "textfm_trans";
	frm.money_time[idx].className = "textfm_trans";

	frm.money_base[idx].className = "textfm_trans";
	frm.money_ext[idx].className = "textfm_trans";
	frm.money_hday[idx].className = "textfm_trans";
	frm.money_night[idx].className = "textfm_trans";
	frm.money_year[idx].className = "textfm_trans";
	frm.money_night_add[idx].className = "textfm_trans";
	frm.money_hday_add[idx].className = "textfm_trans";

	frm.money_g1[idx].className = "textfm_trans";
	frm.money_g2[idx].className = "textfm_trans";
	frm.money_g3[idx].className = "textfm_trans";
	frm.money_g4[idx].className = "textfm_trans";
	frm.money_g5[idx].className = "textfm_trans";
	frm.money_e1[idx].className = "textfm_trans";
	frm.money_e2[idx].className = "textfm_trans";
	frm.money_e3[idx].className = "textfm_trans";
	frm.money_e4[idx].className = "textfm_trans";
	frm.money_e5[idx].className = "textfm_trans";
	frm.money_e6[idx].className = "textfm_trans";
	frm.money_e7[idx].className = "textfm_trans";
	frm.money_e8[idx].className = "textfm_trans";
	frm.money_total[idx].className = "textfm_trans";
	frm.money_for_tax[idx].className = "textfm_trans";
	frm.money_yun[idx].className = "textfm_trans";
	frm.money_health[idx].className = "textfm_trans";
	frm.money_yoyang[idx].className = "textfm_trans";
	frm.money_goyong[idx].className = "textfm_trans";
	frm.tax_so[idx].className = "textfm_trans";
	frm.tax_jumin[idx].className = "textfm_trans";
	frm.minus[idx].className = "textfm_trans";
	frm.money_gongje[idx].className = "textfm_trans";
	frm.money_result[idx].className = "textfm_trans";
}
function focusOutClass(idx) {
	var frm = document.dataForm;
	if(frm.idx[idx].checked == false) {
		//frm.emp_pname[idx].className = "textfm";
		frm.money_month[idx].className = "textfm";
		frm.workday[idx].className = "textfm";
		frm.workhour_day[idx].className = "textfm";
		frm.workhour_ext[idx].className = "textfm";
		frm.workhour_night[idx].className = "textfm";
		frm.workhour_hday[idx].className = "textfm";
		frm.workhour_year[idx].className = "textfm";

		frm.workhour_ext_add[idx].className = "textfm";
		frm.workhour_night_add[idx].className = "textfm";

		frm.workhour_total[idx].className = "textfm5";
		frm.money_hour_ts[idx].className = "textfm5";
		frm.money_time[idx].className = "textfm5";

		frm.money_base[idx].className = "textfm5";
		frm.money_ext[idx].className = "textfm5";
		frm.money_hday[idx].className = "textfm5";
		frm.money_night[idx].className = "textfm5";
		frm.money_year[idx].className = "textfm5";
		frm.money_night_add[idx].className = "textfm5";
		frm.money_hday_add[idx].className = "textfm5";

		frm.money_g1[idx].className = "textfm";
		frm.money_g2[idx].className = "textfm";
		frm.money_g3[idx].className = "textfm";
		frm.money_g4[idx].className = "textfm";
		frm.money_g5[idx].className = "textfm";
		frm.money_e1[idx].className = "textfm";
		frm.money_e2[idx].className = "textfm";
		frm.money_e3[idx].className = "textfm";
		frm.money_e4[idx].className = "textfm";
		frm.money_e5[idx].className = "textfm";
		frm.money_e6[idx].className = "textfm";
		frm.money_e7[idx].className = "textfm";
		frm.money_e8[idx].className = "textfm";
		frm.money_total[idx].className = "textfm5";
		frm.money_for_tax[idx].className = "textfm5";
		frm.money_yun[idx].className = "textfm";
		frm.money_health[idx].className = "textfm";
		frm.money_yoyang[idx].className = "textfm";
		frm.money_goyong[idx].className = "textfm";
		frm.tax_so[idx].className = "textfm";
		frm.tax_jumin[idx].className = "textfm";
		frm.minus[idx].className = "textfm";
		frm.money_gongje[idx].className = "textfm5";
		frm.money_result[idx].className = "textfm5";
	}
}
function printPaySome() {
	save_ok = "<?=$w_date_ok?>";
	if( save_ok == "" ) {
		alert("저장 후 이용해 주세요.");
		return;
	}
	var f = document.dataForm;
	var pay_no = "";
	for(var i=0; i < f.idx.length; i++) {
		if( f.idx[i].checked ){
			pay_no += (pay_no==""?"":",") + f.pay_no[i].value;
		}
	}
	if( pay_no == "" ) {
		alert("출력할 대상을 선택해 주세요.");
		return;
	} else if(stristr(pay_no, ',')) {
		alert("한명만 선택해 주세요.");
		return;
	}
	//alert(pay_no);
	location.href = "pay_stubs.php?id="+pay_no+"&code=<?=$com_code?>&search_year="+f.search_year.value+"&search_month="+f.search_month.value;
}
function printPaySome_name(pay_no) {
	save_ok = "<?=$w_date_ok?>";
	if( save_ok == "" ) {
		alert("저장 후 이용해 주세요.");
		return;
	}
	var f = document.dataForm;
	//alert(pay_no);
	location.href = "pay_stubs.php?id="+pay_no+"&code=<?=$com_code?>&search_year="+f.search_year.value+"&search_month="+f.search_month.value;
}
function pay_preview() {
	//alert('준비중입니다.');
	//return;
	goInput('preview');
/*
	frm = document.printForm;
	frm.mode.value = "salary_list";
	frm.target = "_blank";
	frm.action = "pay_preview.php?code=<?=$com_code?>&search_year="+frm.search_year.value+"&search_month="+frm.search_month.value;
	frm.submit();
*/
}
function printPayList(){
	save_ok = "<?=$w_date_ok?>";
	if( save_ok == "" ) {
		alert("저장 후 이용해 주세요.");
		return;
	}
	frm = document.printForm;
	frm.mode.value = "salary_list";
	frm.target = "_blank";
	frm.action = "pay_ledger.php?code=<?=$com_code?>&search_year="+frm.search_year.value+"&search_month="+frm.search_month.value;
	frm.submit();
}
function stristr (haystack, needle, bool) {
  var pos = 0;
  haystack += '';
  pos = haystack.toLowerCase().indexOf((needle + '').toLowerCase());
  if (pos == -1) {
    return false;
  } else {
    if (bool) {
      return haystack.substr(0, pos);
    } else {
      return haystack.slice(pos);
    }
  }
}

//number_format 함수
function number_format (number, decimals, dec_point, thousands_sep) {
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');    }
    return s.join(dec);
}
//천단위 콤바
function checkThousand(inputVal, type, keydown) {		// inputVal은 천단위에 , 표시를 위해 가져오는 값
	main = document.dataForm;			// 여기서 type 은 해당하는 값을 넣기 위한 위치지정 index
	var chk		= 0;				// chk 는 천단위로 나눌 길이를 check
	var share	= 0;				// share 200,000 와 같이 3의 배수일 때를 구분하기 위한 변수
	var start	= 0;
	var triple	= 0;				// triple 3, 6, 9 등 3의 배수 
	var end		= 0;				// start, end substring 범위를 위한 변수  
	var total	= "";			
	var input	= "";				// total 임의로 string 들을 규합하기 위한 변수
	//alert(event.keyCode);
	//백스페이스 탭 시프트+탭 좌 우 Del
	if(event.keyCode!=8 && event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=46) {
		if (inputVal.length > 3){
			input = delCom(inputVal, inputVal.length);
			/*
			for(i=0; i<inputVal.length; i++){
				if(inputVal.substring(i,i+1)!=','){		// 먼저 substring을 위해
					input += inputVal.substring(i,i+1);	// 값의 모든 , 를 제거
				}
			}*/
			chk = (input.length)/3;					// input 값을 3의로 나눈 값 계산
			chk = Math.floor(chk);					// 그 값보다 작거나 같은 값 중 최대의 정수 계산
			share = (input.length)%3;				// 200,000 와 같은 3의 배수인 수를 걸러내기 위해 나머지 계산
			if (share == 0 ) {						
				chk = chk - 1;					// 길이가 3의 배수인 수를 위해 chk 값을 하나 뺀다.
			}
			for(i=chk; i>0; i--){
				triple = i * 3;					// 3의 배수 계산 9,6,3 등과 같은 순으로
				end = Number(input.length)-Number(triple);	// 이 때의 end 값은 점차 늘어 나게 된다.
				total += input.substring(start,end)+",";	// total은 앞에서 부터 차례로 붙인다.
				start = end;					// end 값은 다음번의 start 값으로 들어간다.
			}
			total +=input.substring(start,input.length);		// 최종적으로 마지막 3자리 수를 뒤에 붙힌다.
		} else {
			total = inputVal;					// 3의 배수가 되기 이전에는 값이 그대로 유지된다.
		}
		if(keydown =='Y'){
			type.value=total;					// type 에 따라 최종값을 넣어 준다.
		}else if(keydown =='N'){
			return total
		}
		return total
	}
}
function delCom(inputVal, count){
	var tmp = "";
	for(i=0; i<count; i++){
		if(inputVal.substring(i,i+1)!=','){		// 먼저 substring을 위해
			tmp += inputVal.substring(i,i+1);	// 값의 모든 , 를 제거
		}
	}
	return tmp;
}
function month_plus() {
	f = document.searchForm;
	//alert(f.search_month.value);
	year_var = f.search_year.value;
	month_var = f.search_month.value;
	if(month_var == "12") {
		year_var = toInt(year_var) + 1;
		month_var = "01";
		//alert(year_var);
	} else {
		month_var = ""+(toInt(month_var) + 1);
		if(month_var.length == 1) {
		 month_var = "0"+month_var;
		}
	}
	f.search_year.value = year_var;
	f.search_month.value = month_var;
	goSearch();
}
function month_minus() {
	f = document.searchForm;
	year_var = f.search_year.value;
	month_var = f.search_month.value;
	if(month_var == "01") {
		year_var = toInt(year_var) - 1;
		month_var = "12";
		//alert(year_var);
	} else {
		//alert(month_var.length);
		//alert(month_var.substring(0,1));
		//if(month_var.substring(0,1) != "0") {
		month_var = ""+(toInt(month_var) - 1);
		//alert(month_var.length);
		if(month_var.length == 1) {
		 month_var = "0"+month_var;
		}
		//alert(month_var);
	}
	f.search_year.value = year_var;
	f.search_month.value = month_var;
	goSearch();
}
</script>
<? include "./inc/top.php"; ?>

<div id="content">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="1200" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top" width="270">
<?
include "./inc/left_menu4.php";
include "./inc/left_banner.php";
?>
						</td>
						<td valign="top" style="padding:10px 10px 10px 10px">
							<!--타이틀 -->
							<table width="100%" border=0 cellspacing=0 cellpadding=0>
								<tr>     
									<td height="18">
										<table width=100% border=0 cellspacing=0 cellpadding=0>
											<tr>
												<td style='font-size:8pt;color:#929292;'><img src="images/g_title_icon.gif" align=absmiddle  style='margin:0 5 2 0'><span style='font-size:9pt;color:black;'><?=$sub_title?></span>
												</td>
												<td align=right class=navi></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr><td height=1 bgcolor=e0e0de></td></tr>
								<tr><td height=2 bgcolor=f5f5f5></td></tr>
								<tr><td height=5></td></tr>
							</table>

							<!--급여반영 입력폼-->
							<iframe name="hframe" src="" style="width:0;height:0;border:0"></iframe>
							<form name="printForm" method="post" style="margin:0">
								<input type="hidden" name="mode">
								<input type="hidden" name="search_year" value="<?=$search_year?>">
								<input type="hidden" name="search_month" value="<?=$search_month?>">
							</form>
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr> 
									<td id="Tab_cust_tab_01_0"> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="./images/g_tab_on_lt.gif"></td> 
												<td background="./images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80px;text-align:center'> 
												<a href="#">검색</a>
												</td> 
												<td><img src="./images/g_tab_on_rt.gif"></td> 
											</tr> 
										</table> 
									</td> 
									<td width=2></td> 
								</tr> 
							</table>
							<div style="height:2px;font-size:0px" class="bgtr"></div>
							<div style="height:2px;font-size:0px;line-height:0px;"></div>
							<!--댑메뉴 -->
							<!--검색 -->
							<form name="searchForm" method="get">
								<input type="hidden" name="select_type" value="">
								<input type="hidden" name="search_pay_gbn" value="01">
								<input type="hidden" name="add_work_numb">
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="" style="table-layout:">
									<col width="180">
									<col width="350">
									<col width="">
									<tr>
										<td class="tdrow">
											<select name="search_year" class="selectfm" onChange="goSearch();">
<?
for($i=2011;$i<2015;$i++) {
?>
												<option value="<?=$i?>" <? if($i == $search_year) echo "selected"; ?> ><?=$i?></option>
<?
}
?>
											</select> 년
											<select name="search_month" class="selectfm" onChange="goSearch();">
<?
for($i=1;$i<13;$i++) {
	if($i < 10) $month = "0".$i;
	else $month = $i;
?>
			<option value="<?=$month?>" <? if($i == $search_month) echo "selected"; ?> ><?=$month?></option>
<?
}
?>
											</select> 월
											<div style="padding:0 0 0 2px;display:inline">
												<a href="javascript:month_minus();"><img src="images/btn_del.png" align="absmiddle" border="0"></a>
												<a href="javascript:month_plus();"><img src="images/btn_add.png" align="absmiddle" border="0"></a>
											</div>
										</td>
										<td nowrap class="tdrow">
											<table border=0 cellpadding=0 cellspacing=0 style="display:inline;height:18px;">
												<tr>
													<td width=2></td><td><img src=images/btn9_lt.gif></td>
													<td style="background:url(images/btn9_bg.gif) repeat-x center" class=ftbutton5_white nowrap><a href="javascript:goSearch();" target="">검 색</a></td><td><img src=images/btn9_rt.gif></td><td width=2></td>
												</tr>
											</table> 
										</td>
										<td nowrap class="tdrow">
											<b>급여지급일</b> : <?=$pay_date?>  / <b>최종저장일</b> : <?=$w_date?>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrow" colspan="2" style="">
											<b>임금산출기간</b> : <?=$search_year?>년 <?=number_format($search_month)?>월 <?=$row_com_opt[pay_calculate_day_period1]?>일 ~
											<?=$search_year?>년 <?=number_format($search_month)?>월 <?=$row_com_opt[pay_calculate_day_period2]?>일
										</td>
										<td nowrap class="tdrow" colspan="" style="text-align:right">
											<a href="<?=$PHP_SELF?>?data=load&select_type=<?=$select_type?>&search_pay_gbn=<?=$search_pay_gbn?>&add_work_numb=<?=$add_work_numb?>&search_year=<?=$search_year?>&search_month=<?=$search_month?>" target=""><img src="images/btn_dataload_big.png" border="0"></a>
											<a href="javascript:cal_pay_bt();" target=""><img src="images/btn_paycal_big.png" border="0"></a>
<?
//권한별 링크값
if($member['mb_profile'] == "guest") {
	$url_save = "javascript:alert_demo();";
	$url_preview = "javascript:alert_demo();";
	$url_paylist = "javascript:alert_demo();";
} else {
	$url_save = "javascript:goInput('input');";
	$url_preview = "javascript:goInput('preview');";
	$url_paylist = "javascript:printPayList();";
}
?>
											<!--<a href="<?=$url_preview?>" target=""><img src="images/btn_preview_big.png" border="0"></a>-->
											<a href="<?=$url_save?>" target=""><img src="images/btn_paysave_big.png" border="0"></a>
											<a href="<?=$url_paylist?>" target=""><img src="images/btn_paylist_big_07.png" border="0"></a>
										</td>
									</tr>
								</table>
							</form>
							<div style="height:10px;font-size:0px;line-height:0px;"></div>
<!--제이쿼리 -->
<script type="text/javascript" src="popup/images/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="popup/images/jquery.maskedinput-1.3.min.js"></script>
<script type="text/javascript">
function pay_step_btn(no) {
	for(i=1;i<=5;i++) {
		getId("pay_step"+i).src = "images/pay_step"+i+".gif";
	}
	getId("pay_step"+no).src = "images/pay_step"+no+"_on.gif";
}
$(function(){
	$('#step1').click(function() { 
		$('#spanTop').scrollLeft(0);
		$('#spanMain').scrollLeft(0);
		pay_step_btn(1);
	});
	$('#step2').click(function() { 
		$('#spanTop').scrollLeft(710);
		$('#spanMain').scrollLeft(710);
		pay_step_btn(2);
	});
	$('#step3').click(function() { 
		$('#spanTop').scrollLeft(1420);
		$('#spanMain').scrollLeft(1420);
		pay_step_btn(3);
	});
	$('#step4').click(function() { 
		$('#spanTop').scrollLeft(2130);
		$('#spanMain').scrollLeft(2130);
		pay_step_btn(4);
	});
	$('#step5').click(function() { 
		$('#spanTop').scrollLeft(2840);
		$('#spanMain').scrollLeft(2840);
		pay_step_btn(5);
	});
});
</script>
							<!--검색 -->
							<form name="dataForm" method="post">
								<input type="hidden" name="mode">
								<input type="hidden" name="pay_gbn_value" value="0">
								<input type="hidden" name="code" value="<?=$com_code?>">
								<input type="hidden" name="search_year" value="<?=$search_year?>">
								<input type="hidden" name="search_month" value="<?=$search_month?>">
								<input type="hidden" name="total_count" value="<?=$total_count?>">
								<input type="hidden" name="search_pay_gbn" value="01">
								<!--댑메뉴 -->
								<table border=0 cellspacing=0 cellpadding=0> 
									<tr> 
										<td id="Tab_cust_tab_01_0" valign="bottom"> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="./images/g_tab_on_lt.gif"></td> 
													<td background="./images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80px;text-align:center'> 
													<a href="#">급여입력</a>
													</td> 
													<td><img src="./images/g_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width="6"></td> 
										<td width="" align="left">
											<div id="step1" style="cursor:pointer;margin:0 5px 0 0"><img src="images/pay_step1_on.gif" id="pay_step1"></div>
										</td> 
										<td width="" align="left">
											<div id="step2" style="cursor:pointer;margin:0 5px 0 0"><img src="images/pay_step2.gif" id="pay_step2"></div>
										</td> 
										<td width="" align="left">
											<div id="step3" style="cursor:pointer;margin:0 5px 0 0"><img src="images/pay_step3.gif" id="pay_step3"></div>
										</td> 
										<td width="" align="left">
											<div id="step4" style="cursor:pointer;margin:0 5px 0 0"><img src="images/pay_step4.gif" id="pay_step4"></div>
										</td> 
										<td width="" align="left">
											<div id="step5" style="cursor:pointer;margin:0 5px 0 0"><img src="images/pay_step5.gif" id="pay_step5"></div>
										</td> 
										<td align="right" style="padding-right:10"></td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!--댑메뉴 -->
								<!--리스트 -->
								<table width="100%" border="0" cellpadding="0" cellspacing="0" class="bgtable" style="table-layout:fixed;">
									<tr>
										<td width="200" height="84" valign="top">
											<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
												<col width="10%">
												<col width="">
												<col width="35%">
												<col width="25%">
												<tr>
													<td nowrap height="85" align="center" style="background-color:rgb(226, 226, 226);"></td></td>
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
?>
											<div id="spanTop" style="width:100%;overflow:hidden">
												<table cellpadding=0 cellspacing=0 border=0>
													<tr>
														<td>  
															<table width="<?=$pay_list_width?>" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:;">
																<tr>
																	<td class="tdhead_center" rowspan="4" width="45">유형</td>
																	<td class="tdhead_center" colspan="10">결정급여 및 약정근로시간(월) </td>
																	<td class="tdhead_center" rowspan="4" width="18"></td>
																	<td class="tdhead_center" colspan="26">기본급 및 제수당 </td>
																	<td class="tdhead_center" colspan="8">공제액</td>
																	<td class="tdhead_center" rowspan="4" width="76">공제후<br>지급액 </td>
																	<td class="tdhead_center" rowspan="4" width="18"></td>
																</tr>
																<tr>
																	<td class="tdhead_center" rowspan="3" width="64">결정임금</td>
																	<td class="tdhead_center" rowspan="3" width="64">근로일수</td>
																	<td class="tdhead_center" colspan="4">약정근로시간</td>
																	<td class="tdhead_center" colspan="2">추가근로시간</td>
																	<td class="tdhead_center" rowspan="3" width="64">임금산출<br>총시간 </td>
																	<td class="tdhead_center" rowspan="3" width="63">통상임금<br>(시간급)</td>
																	<td class="tdhead_center" colspan="8">기본월급</td>
																	<td class="tdhead_center" rowspan="3" width="18"></td>
																	<td class="tdhead_center" colspan="5">제수당</td>
																	<td class="tdhead_center" rowspan="3" width="19"></td>
																	<td class="tdhead_center" colspan="8">제수당</td>
																	<td class="tdhead_center" rowspan="3" width="69">임금계</td>
																	<td class="tdhead_center" rowspan="3" width="68">과세소득</td>
																	<td class="tdhead_center" rowspan="3" width="18"></td>
																	<td class="tdhead_center" colspan="4">4대보험</td>
																	<td class="tdhead_center" colspan="2">세금</td>
																	<td class="tdhead_center" colspan="1">기타공제</td>
																	<td class="tdhead_center" rowspan="3" width="76">공제계</td>
																</tr>
																<tr>
																	<td class="tdhead_center" rowspan="2" width="63">소정<br>근로시간</td>
																	<td class="tdhead_center" rowspan="2" width="63">잔업<br>근로시간</td>
																	<td class="tdhead_center" rowspan="2" width="63">주차<br>(주휴일)</td>
																	<td class="tdhead_center" rowspan="2" width="63">휴일<br>근로시간</td>

																	<td class="tdhead_center" rowspan="2" width="64">특별<br>근로시간</td>
																	<td class="tdhead_center" rowspan="2" width="64">야간<br>근로시간</td>

																	<td class="tdhead_center" rowspan="2" width="68">기본시급</td>
																	<td class="tdhead_center" rowspan="2" width="88">기본급</td>
																	<td class="tdhead_center" colspan="6">법정수당(과세)</td>
																	<td class="tdhead_center" colspan="5">통상임금수당</td>
																	<td class="tdhead_center" colspan="4">기타수당(비과세)</td>
																	<td class="tdhead_center" colspan="4">기타수당(과세)</td>

																	<td class="tdhead_center" rowspan="2" width="76">국민연금</td>
																	<td class="tdhead_center" rowspan="2" width="76">건강보험</td>
																	<td class="tdhead_center" rowspan="2" width="76">장기요양</td>
																	<td class="tdhead_center" rowspan="2" width="76">고용보험</td>
																	<td class="tdhead_center" rowspan="2" width="76">소득세</td>
																	<td class="tdhead_center" rowspan="2" width="76">주민세</td>
																	<td class="tdhead_center" rowspan="2" width="76">기타공제</td>
																</tr>
																<tr>
																	<td class="tdhead_center" width="88">잔업수당</td>
																	<td class="tdhead_center" width="88">주차수당</td>
																	<td class="tdhead_center" width="89">휴일근로</td>
																	<td class="tdhead_center" width="88">특근수당</td>
																	<td class="tdhead_center" width="88">추가야간</td>
																	<td class="tdhead_center" width="88">추가휴일</td>

																	<td class="tdhead_center" width="137"><input type="text" name="g1" class="textfm5" readonly  style="width:100%;" value="<?=$money_g_txt['g1']?>"></td>
																	<td class="tdhead_center" width="137"><input type="text" name="g2" class="textfm5" readonly  style="width:100%;" value="<?=$money_g_txt['g2']?>"></td>
																	<td class="tdhead_center" width="138"><input type="text" name="g3" class="textfm5" readonly  style="width:100%;" value="<?=$money_g_txt['g3']?>"></td>
																	<td class="tdhead_center" width="137"><input type="text" name="g4" class="textfm5" readonly  style="width:100%;" value="<?=$money_g_txt['g4']?>"></td>
																	<td class="tdhead_center" width="138"><input type="text" name="g5" class="textfm5" readonly  style="width:100%;" value="<?=$money_g_txt['g5']?>"></td>
																	<td class="tdhead_center" width="68"><input type="text" name="b1" class="textfm5" readonly  style="width:100%;" value="<?=$money_e_txt['e1']?>"></td>
																	<td class="tdhead_center" width="68"><input type="text" name="b2" class="textfm5" readonly  style="width:100%;" value="<?=$money_e_txt['e2']?>"></td>
																	<td class="tdhead_center" width="68"><input type="text" name="b3" class="textfm5" readonly  style="width:100%;" value="<?=$money_e_txt['e3']?>"></td>
																	<td class="tdhead_center" width="69"><input type="text" name="b4" class="textfm5" readonly  style="width:100%;" value="<?=$money_e_txt['e4']?>"></td>
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
										<td width="200" bgcolor="#FFFFFF" valign="top">
<?
//$spanMain_height = $total_count * 25 + 25;
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

													<input type="hidden" name="money_month">
													<input type="hidden" name="money_hour">
													<input type="hidden" name="money_hour_ds">
													<input type="hidden" name="money_hour_ts">
													<input type="hidden" name="workday">
													<input type="hidden" name="workhour_day">
													<input type="hidden" name="workhour_ext">
													<input type="hidden" name="workhour_night">
													<input type="hidden" name="workhour_hday">
													<input type="hidden" name="workhour_year">

													<input type="hidden" name="workhour_ext_add">
													<input type="hidden" name="workhour_night_add">
													<input type="hidden" name="workhour_hday_add">

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
													<input type="hidden" name="money_gongje">
													<input type="hidden" name="money_result">
													<!--추가 필드-->
													<input type="hidden" name="money_ng4">
													<input type="hidden" name="money_ng5">
													<input type="hidden" name="advance_pay">
													<input type="hidden" name="check_money_min_yn">
													<input type="hidden" name="check_money_b_yn">
													<input type="hidden" name="check_money_so_yn">
													<input type="hidden" name="money_hour_ms">
													<!--법정수당-->
													<input type="hidden" name="money_b1">
													<input type="hidden" name="money_b2">
													<input type="hidden" name="money_b3">
													<input type="hidden" name="money_b4">
													<!--4대보험여부-->
													<input type="hidden" name="isgy">
													<input type="hidden" name="issj">
													<input type="hidden" name="iskm">
													<input type="hidden" name="isgg">
													<!--두리누리-->
													<input type="hidden" name="durunuri">
												</div>
												<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
													<col width="10%">
													<col width="">
													<col width="35%">
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

														//직위
														$sql_position = " select * from com_code_list where com_code = '$code' and code='$row2[position]' and item='position' ";
														$result_position = sql_query($sql_position);
														$row_position=mysql_fetch_array($result_position);
														//echo $row_position[name];
														$k = $i+1;

														//호봉
														$sql_step = " select * from com_code_list where com_code = '$code' and code='$row2[step]' and item='step' ";
														$result_step = sql_query($sql_step);
														$row_step=mysql_fetch_array($result_step);

														//채용형태
														if($row[work_form] == "") $work_form = "";
														else if($row[work_form] == "1") $work_form = "정규직";
														else if($row[work_form] == "2") $work_form = "계약직";
														else if($row[work_form] == "3") $work_form = "일용직";
													?>

													<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
														<td nowrap class="ltrow1_center_h24">
															<input type="checkbox" name="idx" value="<?=$row[sabun]?>" onclick="focusClickClass('<?=$k?>')">
														</td>
														<td nowrap class="ltrow1_center_h24"><?=$name?></td>
														<td nowrap class="ltrow1_center_h24"><?=$row[in_day]?></td>
														<td nowrap class="ltrow1_center_h24"><input type="text" name="emp_pname" value="<?=$row_position[name]?>" style="width:100%;ime-mode:active;" class="textfm5" readonly onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');"></td>
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
														$com_name = $row_com[com_name];
														$com_name = cut_str($com_name, 21, "..");
														$name = cut_str($row[name], 6, "..");

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
														if($row[work_form] == "") $work_form = "";
														else if($row[work_form] == "1") $work_form = "정규직";
														else if($row[work_form] == "2") $work_form = "계약직";
														else if($row[work_form] == "3") $work_form = "일용직";

														//급여유형
														//echo $row2[pay_gbn];
														if($row2[pay_gbn] == "0") $pay_gbn = "월급제";
														else if($row2[pay_gbn] == "1") $pay_gbn = "시급제";
														else if($row2[pay_gbn] == "2") $pay_gbn = "복합근무";
														else if($row2[pay_gbn] == "3") $pay_gbn = "연봉제";
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

														//급여관리 DB (급여반영) 년월
														$sql4 = " select * from pibohum_base_pay where com_code='$row[com_code]' and sabun='$row[sabun]' and year = '$search_year' and month = '$search_month' and w_date != '0000-00-00' ";
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
														//echo $iskm_chk.",";
														//두리누리 지원 여부
														$durunuri = $row2[insurance];
														//국민연금 만60세 해당 사원
														if($iskm_chk == "checked") {
															$now_date = date("Ymd");
															$jumin_date = "19".substr($row[jumin_no],0,9);
															$age_cal = ( $now_date - $jumin_date ) / 10000;
															$age = (int)$age_cal;
															if($age_cal >= 60) {
																$iskm_chk = "";
															} else {
																$iskm_chk = "checked";
															}
														}
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

<?
if($row4[money_month] == 0) {
	if($pay_gbn_no == 1) {
		$money_total = $row3[money_hour_ds];
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

	$workhour_total = 0;
	$money_hour_ts = $row3[money_hour_ts];
	//기본시급
	$money_time = $row3[money_min_base];
	$money_base = $row4[money_month];

	$money_ext = $row4[ext];
	$money_night = $row4[night];
	$money_hday = $row4[hday];
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
		if($row4[money_hour_ds]) {
			$money_total = $row4[money_hour_ds];
		} else {
			$money_total = $row3[money_hour_ds];
		}
		$money_hour_ds = $row4[money_hour_ds];
	} else {
		//echo $row4[money_setting];
		$money_total = $row4[money_setting];
		$money_hour_ds = 0;
	}
	$workday = $row4[workday];
	$workhour_day = $row4[w_day];
	$workhour_ext = $row4[w_ext];
	$workhour_night = $row4[w_night];
	$workhour_hday = $row4[w_hday];
	$workhour_year = $row4[w_year];

	$w_ext_add = $row4[w_ext_add];
	$w_night_add = $row4[w_night_add];
	$w_hday_add = $row4[w_hday_add];

	$workhour_total = $row4[workhour_total];
	$money_hour_ts = $row4[money_time];
	//기본시급
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
														<input type="hidden" name="workday_<?=$i?>">
														<input type="hidden" name="w_day_<?=$i?>">
														<input type="hidden" name="w_ext_<?=$i?>">
														<input type="hidden" name="w_night_<?=$i?>">
														<input type="hidden" name="w_hday_<?=$i?>">
														<input type="hidden" name="w_year_<?=$i?>">
														<input type="hidden" name="w_ext_add_<?=$i?>">
														<input type="hidden" name="w_night_add_<?=$i?>">
														<input type="hidden" name="w_hday_add_<?=$i?>">

														<input type="hidden" name="workhour_total_<?=$i?>">

														<input type="hidden" name="money_hour_ds_<?=$i?>">
														<input type="hidden" name="money_hour_ts_<?=$i?>">
														<input type="hidden" name="money_time_<?=$i?>">
														<input type="hidden" name="money_day_<?=$i?>">
														<input type="hidden" name="money_month_<?=$i?>" value="<?=$money_total?>">
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
														<!--추가연장근로시간 추가연장근로수당-->
														<input type="hidden" name="workhour_ext_add" value="<?=$w_ext_add?>">
														<input type="hidden" name="money_ext_add" value="<?=number_format($money_ext_add)?>">
														<!--기준시급(시급제) 필드-->
														<input type="hidden" name="money_hour_ds" value="<?=$money_hour_ds?>">
														<td nowrap class="ltrow1_center_h24" width="44"><input type="text" style="width:100%;ime-mode:disabled;" class="textfm5" name="pay_gbn_txt" value="<?=$pay_gbn?>"></td><!-- 근무유형 -->
														<td nowrap class="ltrow1_center_h24" width="64"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_month" value="<?=number_format($money_total)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');"></td><!-- 결정임금 -->
														<td nowrap class="ltrow1_center_h24" width="64"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workday" value="<?=$workday?>" onKeyUp="cal_pay('<?=$k?>');"></td><!-- 근로일수 -->
														<td nowrap class="ltrow1_center_h24" width="63"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_day" value="<?=$workhour_day?>" onKeyUp="cal_pay('<?=$k?>');"></td><!-- 소정근로시간 -->
														<td nowrap class="ltrow1_center_h24" width="63"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_ext" value="<?=$workhour_ext?>" onKeyUp="cal_pay('<?=$k?>');"></td><!-- 연장근로시간 -->
														<td nowrap class="ltrow1_center_h24" width="63"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_night" value="<?=$workhour_night?>" onKeyUp="cal_pay('<?=$k?>');"></td><!-- 야간근로시간 -->
														<td nowrap class="ltrow1_center_h24" width="63"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_hday" value="<?=$workhour_hday?>" onKeyUp="cal_pay('<?=$k?>');"></td><!-- 휴일근로시간 -->

														<td nowrap class="ltrow1_center_h24" width="64"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_year" value="<?=$workhour_year?>" onKeyUp="cal_pay('<?=$k?>');"></td><!-- 특별근무시간 -->
														<!--<td nowrap class="ltrow1_center_h24" width="64"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_ext_add" value="<?=$w_ext_add?>" onKeyUp="cal_pay('<?=$k?>');"></td>--><!-- 추가연장근로시간 -->
														<td nowrap class="ltrow1_center_h24" width="64"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_night_add" value="<?=$w_night_add?>" onKeyUp="cal_pay('<?=$k?>');"></td><!-- 추가야간근로시간 -->
<?
//계명전자 G 타입 자바스크립트 변수 input 사용 안함
//workhour_hday_add
?>
														<td nowrap class="ltrow1_center_h24" width="63"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="workhour_total" value="<?=$workhour_total?>"></td><!-- 임금산출 총시간 -->
														<td nowrap class="ltrow1_center_h24" width="63"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_hour_ts" value="<?=number_format($money_hour_ts)?>"></td><!-- 통상임금(시간급) -->
														<td nowrap class="ltrow1_center_h24" width="18"></td>

														<td nowrap class="ltrow1_center_h24" width="68"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_time" value="<?=number_format($money_time)?>"></td><!-- 기본시급 -->
														<td nowrap class="ltrow1_center_h24" width="88"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_base" value="<?=number_format($money_base)?>" onchage="this.form.money_month_var[].value='this.value';"></td><!-- 기본급 -->
														<td nowrap class="ltrow1_center_h24" width="87"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_ext" value="<?=number_format($money_ext)?>"></td><!-- 연장근로수당 -->
														<td nowrap class="ltrow1_center_h24" width="88"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_night" value="<?=number_format($money_night)?>"></td><!-- 야간근로수당 -->
														<td nowrap class="ltrow1_center_h24" width="88"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_hday" value="<?=number_format($money_hday)?>"></td><!-- 휴일근로수당 -->

														<td nowrap class="ltrow1_center_h24" width="88"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_year" value="<?=number_format($annual_paid_holiday)?>"></td><!-- 특근수당 -->
														<td nowrap class="ltrow1_center_h24" width="88"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_night_add" value="<?=number_format($money_night_add)?>"></td><!-- 추가야간근로수당 -->
														<td nowrap class="ltrow1_center_h24" width="88"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_hday_add" value="<?=number_format($money_hday_add)?>"></td><!-- 추가휴일근로수당 -->
														<td nowrap class="ltrow1_center_h24" width="18"></td>

														<td nowrap class="ltrow1_center_h24" width="137"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_g1" value="<?=number_format($money_g1)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');"></td><!-- 고정성1 -->
														<td nowrap class="ltrow1_center_h24" width="137"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_g2" value="<?=number_format($money_g2)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');"></td><!-- 고정성2 -->
														<td nowrap class="ltrow1_center_h24" width="137"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_g3" value="<?=number_format($money_g3)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');"></td><!-- 고정성3 -->
														<td nowrap class="ltrow1_center_h24" width="137"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_g4" value="<?=number_format($money_g4)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');"></td><!-- 고정성4 -->
														<td nowrap class="ltrow1_center_h24" width="138"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_g5" value="<?=number_format($money_g5)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');"></td><!-- 고정성5 -->
														<td nowrap class="ltrow1_center_h24" width="19"></td>

														<td nowrap class="ltrow1_center_h24" width="68"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e1" value="<?=number_format($money_e1)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');"></td><!-- 기타수당1 -->
														<td nowrap class="ltrow1_center_h24" width="68"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e2" value="<?=number_format($money_e2)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');"></td><!-- 기타수당2 -->
														<td nowrap class="ltrow1_center_h24" width="68"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e3" value="<?=number_format($money_e3)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');"></td><!-- 기타수당3 -->
														<td nowrap class="ltrow1_center_h24" width="68"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e4" value="<?=number_format($money_e4)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');"></td><!-- 기타수당4 -->
														<td nowrap class="ltrow1_center_h24" width="68"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e5" value="<?=number_format($money_e5)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');"></td><!-- 기타수당5 -->
														<td nowrap class="ltrow1_center_h24" width="68"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e6" value="<?=number_format($money_e6)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');"></td><!-- 기타수당6 -->
														<td nowrap class="ltrow1_center_h24" width="68"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e7" value="<?=number_format($money_e7)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');"></td><!-- 기타수당7 -->
														<td nowrap class="ltrow1_center_h24" width="68"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e8" value="<?=number_format($money_e8)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');"></td><!-- 기타수당8 -->

														<td nowrap class="ltrow1_center_h24" width="69"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_total" value="<?=number_format($row4[money_total])?>"></td><!-- 임금계 -->
														<td nowrap class="ltrow1_center_h24" width="68"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_for_tax" value="<?=number_format($row4[money_for_tax])?>"></td><!-- 과세소득 -->
														<td nowrap class="ltrow1_center_h24" width="18"></td>

														<td nowrap class="ltrow1_center_h24" width="76"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_yun" value="<?=number_format($row4[yun])?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay2('<?=$k?>');"></td><!-- 국민연금 -->
														<td nowrap class="ltrow1_center_h24" width="76"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_health" value="<?=number_format($row4[health])?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay2('<?=$k?>');"></td><!-- 건강보험 -->
														<td nowrap class="ltrow1_center_h24" width="76"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_yoyang" value="<?=number_format($row4[yoyang])?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay2('<?=$k?>');"></td><!-- 장기요양보험 -->
														<td nowrap class="ltrow1_center_h24" width="76"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_goyong" value="<?=number_format($row4[goyong])?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay2('<?=$k?>');"></td><!-- 고용보험 -->
														<td nowrap class="ltrow1_center_h24" width="76"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="tax_so" value="<?=number_format($row4[tax_so])?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay3('<?=$k?>');"></td><!-- 소득세 -->
														<td nowrap class="ltrow1_center_h24" width="75"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="tax_jumin" value="<?=number_format($row4[tax_jumin])?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay2('<?=$k?>');"></td><!-- 주민세 -->
														<td nowrap class="ltrow1_center_h24" width="75"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="minus" value="<?=number_format($row4[minus])?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay2('<?=$k?>');"></td><!-- 기타공제 -->
														<td nowrap class="ltrow1_center_h24" width="76"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_gongje" value="<?=number_format($row4[money_gongje])?>"></td><!-- 공제계 -->
														<td nowrap class="ltrow1_center_h24" width="75"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_result" value="<?=number_format($row4[money_result])?>"></td><!-- 공제후지급액 -->
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
								<!--리스트 -->
								<div style="height:10px"></div>
								<input type="hidden" name="total_cnt" value="<?=$k?>">
								<input type="hidden" name="error_code" style="width:100%" value="code">
<?
include "./inc/pay_list_text.php";
?>
							</form>
							<br>
						</td>
					</tr>
				</table>
				<? include "./inc/bottom.php";?>
			</td>
		</tr>
	</table>			
</div>
<script language="javascript">
//자동 계산 버튼 함수
function cal_pay_bt() {
<?
for($i=1;$i<=$k;$i++) {
?>
	cal_pay('<?=$i?>');
<?
}
?>
}
</script>