<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title>****비즈프로****</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="./js/common.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/lang/calendar-ko.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
</head>
<script language="javascript">
	function loadCalendar( obj )
	{
		var calendar = new Calendar(0, null, onSelect, onClose);
		calendar.create();
		calendar.parseDate(obj.value);
		calendar.showAtElement(obj, "Br");
		function onSelect(calendar, date)
		{
			var input_field = obj;
			input_field.value = date;
			if (calendar.dateClicked) {
				calendar.callCloseHandler();
			}
		};
		function onClose(calendar)
		{
			calendar.hide();
			calendar.destroy();
		};
	}
	function goSearch()
	{
		var frm = document.searchForm;
		frm.select_type.value = "";
		frm.action = "/_biz/m02s01.asp";
		frm.submit();
	}
	function goSearchPayGbn(pay_gbn){
		var frm = document.searchForm;
		if( pay_gbn == "01" ){
			frm.action = "m02s01.asp";
		}else if( pay_gbn == "02" ){
			frm.action = "m02s0102.asp";
		}
		frm.submit();
	}
	function selectType( select_type ){
		var frm = document.searchForm;
		frm.select_type.value = select_type;
		frm.action = "/_biz/m02s01.asp";
		frm.submit();
	}
	function checkAll(){
		var f = document.dataForm;
		for( var i = 1; i<f.idx.length; i++ ){
			f.idx[i].checked = f.checkall.checked;
		}
	}
	function GetTax(money_for_tax){
		var i, money_base, smoney, emoney, tax, tax_result
		money_base = parseInt( money_for_tax / 1000 )
		tax_result = 0
		for( var i=0; i <ary_tax.length; i++ ){
			smoney = ary_tax[i][0];
			emoney = ary_tax[i][1];
			tax = ary_tax[i][2];
			if( money_base >= smoney && money_base < emoney ){
				tax_result = tax;
				break;
			}
		}
		return tax_result;
	}
	function cal_pay(idx){
		var f = document.dataForm;
		var money_month,money_hour,money_hour_ts,workhour_day,workhour_ext,workhour_hday,workhour_night,workhour_total
		var week_hday,year_hday,money_base,money_ext,money_hday,money_night,money_week,money_year
		var money_g1,money_g2,money_g3,money_b1,money_b2,money_b3,money_ng1,money_ng2,money_ng3
		var money_total,money_for_tax,money_yun,money_health,money_yoyang,money_goyong,tax_so,tax_jumin,money_gongje,money_result, workhour_year
		money_month     = toInt(f.money_month   [idx].value);    //기본월급 mm--        
		money_hour      = toInt(f.money_hour    [idx].value); 	//기준시급 hh--        
		money_hour_ts   = toInt(f.money_hour_ts [idx].value);	//통상임금(시간급)     
		workhour_day    = toFloat(f.workhour_day  [idx].value);	//소정근로시간         
		workhour_ext    = toFloat(f.workhour_ext  [idx].value);	//연장근로시간         
		workhour_hday   = toFloat(f.workhour_hday [idx].value);	//휴일근로시간         
		workhour_night  = toFloat(f.workhour_night[idx].value);	//야간근로시간         
		workhour_total  = toFloat(f.workhour_total[idx].value);	//임금산출 총시간 mm-- 
		week_hday       = toInt(f.week_hday     [idx].value);   // 주휴일일수 hh--      
		year_hday       = toInt(f.year_hday     [idx].value);	// 연차유급휴가일수 hh--
		money_base      = toInt(f.money_base    [idx].value);	// 기본급               
		money_ext       = toInt(f.money_ext     [idx].value);	// 연장근로수당         
		money_hday      = toInt(f.money_hday    [idx].value);	// 휴일근로수당         
		money_night     = toInt(f.money_night   [idx].value);	// 야간근로수당         
		money_week      = toInt(f.money_week    [idx].value);	// 주휴수당 hh--        
		money_year      = toInt(f.money_year    [idx].value);	// 연차수당 hh--        
		money_g1        = toInt(f.money_g1      [idx].value);
		money_g2        = toInt(f.money_g2      [idx].value);
		money_g3        = toInt(f.money_g3      [idx].value);
		money_b1        = toInt(f.money_b1      [idx].value);
		money_b2        = toInt(f.money_b2      [idx].value);
		money_b3        = toInt(f.money_b3      [idx].value);
		money_ng1       = toInt(f.money_ng1     [idx].value);
		money_ng2       = toInt(f.money_ng2     [idx].value);
		money_ng3       = toInt(f.money_ng3     [idx].value);
		money_total     = toInt(f.money_total   [idx].value);   //임금계       
		money_for_tax   = toInt(f.money_for_tax [idx].value);	//과세소득     
		money_yun       = toInt(f.money_yun     [idx].value);	//국민연금     
		money_health    = toInt(f.money_health  [idx].value);	//건강보험     
		money_yoyang    = toInt(f.money_yoyang  [idx].value);	//장기요양보험 
		money_goyong    = toInt(f.money_goyong  [idx].value);	//고용보험     
		tax_so          = toInt(f.tax_so        [idx].value);	//소득세       
		tax_jumin       = toInt(f.tax_jumin     [idx].value);	//주민세       
		money_gongje    = toInt(f.money_gongje  [idx].value);	//공제계       
		money_result    = toInt(f.money_result  [idx].value);	//공제후 지급액
		workhour_year   = toFloat(f.workhour_year  [idx].value);	//연차휴가시간 mm-- 
		var emp5_gbn = "";
		var rate_ext, rate_hday, rate_night;
		if( emp5_gbn == "1" ){ // 5인이하
			rate_ext = 1;
			rate_hday = 1;
			rate_night = 1;
		}else{
			rate_ext = 1.5;
			rate_hday = 1.5;
			rate_night = 0.5;
		}
		//workhour_total 임금산출 총시간 mm-- // 직원등록시 계산법과 다른데?
		workhour_total =  workhour_day + workhour_ext*rate_ext + workhour_hday*rate_hday + workhour_night*rate_night + workhour_year
		//money_hour_ts 통상임금(시간급) 
		if( workhour_total != 0 ){
			money_hour_ts = ( money_month + money_g1 + money_g2 + money_g3 ) / workhour_total;
		}
		//money_base 기본급
		//money_ext 연장근로수당 
		//money_hday 휴일근로수당
		//money_night 야간근로수당 
		//money_year 연차수당 -----------------------------------
		money_ext = Math.round(workhour_ext * money_hour_ts * rate_ext)
		money_hday = Math.round(workhour_hday * money_hour_ts * rate_hday)
		money_night = Math.round(workhour_night * money_hour_ts * rate_night)
		money_year = Math.round(workhour_year * money_hour_ts )
		money_base = money_month - money_ext - money_hday - money_night - money_year;
		//money_total 임금계 
		money_total = money_month+money_g1+money_g2+money_g3+money_b1+money_b2+money_b3+money_ng1+money_ng2+money_ng3
		//money_for_tax 과세소득 
		money_for_tax = money_total - money_b1 - money_b2 - money_b3
		//money_yun 국민연금  
//		money_yun = parseInt( ( parseInt(money_for_tax/1000)*1000 * 0.045 ) * 0.1 ) * 10
		money_yun = get_round( parseInt(money_for_tax) * 0.045 );
		//money_health 건강보험 
//		money_health = parseInt(money_for_tax* 0.02945 *0.1)*10
		money_health = get_round(money_for_tax* 0.02945);
		//money_yoyang 장기요양보험 
//		money_yoyang = parseInt(money_health* 0.0655 *0.1)*10
		money_yoyang = get_round(money_health* 0.0655 );
		//money_goyong 고용보험
		money_goyong = get_round(money_for_tax* 0.0065 );
		//tax_so 소득세 
		tax_so = GetTax( money_for_tax )
		//tax_jumin 주민세 
		tax_jumin = get_round(tax_so* 0.1 );
		//money_gongje 공제계 
		money_gongje = money_yun+money_health+money_yoyang+money_goyong+tax_so+tax_jumin
		//money_result 공제후 지급액 
		money_result = money_total - money_gongje
		f.money_hour_ts[idx].value = money_hour_ts //money_hour_ts 통상임금(시간급) 
		f.workhour_total[idx].value = workhour_total //workhour_total 임금산출 총시간 mm--
		f.money_base[idx].value = money_base //money_base 기본급
		f.money_ext[idx].value = money_ext //money_ext 연장근로수당 
		f.money_hday[idx].value = money_hday //money_hday 휴일근로수당 
		f.money_night[idx].value = money_night //money_night 야간근로수당 
		f.money_year[idx].value = money_year //money_year 연차수당 ------------------------
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
		var money_month,money_hour,money_hour_ts,workhour_day,workhour_ext,workhour_hday,workhour_night,workhour_total
		var week_hday,year_hday,money_base,money_ext,money_hday,money_night,money_week,money_year
		var money_g1,money_g2,money_g3,money_b1,money_b2,money_b3,money_ng1,money_ng2,money_ng3
		var money_total,money_for_tax,money_yun,money_health,money_yoyang,money_goyong,tax_so,tax_jumin,money_gongje,money_result, workhour_year
		money_month     = toInt(f.money_month   [idx].value);    //기본월급 mm--        
		money_hour      = toInt(f.money_hour    [idx].value); 	//기준시급 hh--        
		money_hour_ts   = toInt(f.money_hour_ts [idx].value);	//통상임금(시간급)     
		workhour_day    = toFloat(f.workhour_day  [idx].value);	//소정근로시간         
		workhour_ext    = toFloat(f.workhour_ext  [idx].value);	//연장근로시간         
		workhour_hday   = toFloat(f.workhour_hday [idx].value);	//휴일근로시간         
		workhour_night  = toFloat(f.workhour_night[idx].value);	//야간근로시간         
		workhour_total  = toFloat(f.workhour_total[idx].value);	//임금산출 총시간 mm-- 
		week_hday       = toInt(f.week_hday     [idx].value);   // 주휴일일수 hh--      
		year_hday       = toInt(f.year_hday     [idx].value);	// 연차유급휴가일수 hh--
		money_base      = toInt(f.money_base    [idx].value);	// 기본급               
		money_ext       = toInt(f.money_ext     [idx].value);	// 연장근로수당         
		money_hday      = toInt(f.money_hday    [idx].value);	// 휴일근로수당         
		money_night     = toInt(f.money_night   [idx].value);	// 야간근로수당         
		money_week      = toInt(f.money_week    [idx].value);	// 주휴수당 hh--        
		money_year      = toInt(f.money_year    [idx].value);	// 연차수당 hh--        
		money_g1        = toInt(f.money_g1      [idx].value);
		money_g2        = toInt(f.money_g2      [idx].value);
		money_g3        = toInt(f.money_g3      [idx].value);
		money_b1        = toInt(f.money_b1      [idx].value);
		money_b2        = toInt(f.money_b2      [idx].value);
		money_b3        = toInt(f.money_b3      [idx].value);
		money_ng1       = toInt(f.money_ng1     [idx].value);
		money_ng2       = toInt(f.money_ng2     [idx].value);
		money_ng3       = toInt(f.money_ng3     [idx].value);
		money_total     = toInt(f.money_total   [idx].value);   //임금계       
		money_for_tax   = toInt(f.money_for_tax [idx].value);	//과세소득     
		money_yun       = toInt(f.money_yun     [idx].value);	//국민연금     
		money_health    = toInt(f.money_health  [idx].value);	//건강보험     
		money_yoyang    = toInt(f.money_yoyang  [idx].value);	//장기요양보험 
		money_goyong    = toInt(f.money_goyong  [idx].value);	//고용보험     
		tax_so          = toInt(f.tax_so        [idx].value);	//소득세       
		tax_jumin       = toInt(f.tax_jumin     [idx].value);	//주민세       
		money_gongje    = toInt(f.money_gongje  [idx].value);	//공제계       
		money_result    = toInt(f.money_result  [idx].value);	//공제후 지급액
		workhour_year   = toFloat(f.workhour_year  [idx].value);	//연차휴가시간 mm-- 
		//money_gongje 공제계 = 국민연금+건강보험+장기요양보험+고용보험+소득세+주민세
		money_gongje = money_yun+money_health+money_yoyang+money_goyong+tax_so+tax_jumin
		//money_result 공제후 지급액 
		money_result = money_total - money_gongje
		f.money_gongje[idx].value = money_gongje //money_gongje 공제계 
		f.money_result[idx].value = money_result //money_result 공제후 지급액 
	}
	function cal_pay3(idx){
		var f = document.dataForm;
		var tax_so,tax_jumin;
		tax_so = toInt(f.tax_so[idx].value); //소득세
		//tax_jumin 주민세 
		tax_jumin = parseInt(tax_so*0.1*0.1)*10;
		f.tax_jumin[idx].value = tax_jumin;
		cal_pay2(idx); // 공제후 지급액 재계산
	}
	function focusInClass(idx)
	{
		var frm = document.dataForm;
		frm.emp_pname[idx].className = "textfm_trans";
		frm.money_month[idx].className = "textfm_trans";
		frm.workhour_day[idx].className = "textfm_trans";
		frm.workhour_ext[idx].className = "textfm_trans";
		frm.workhour_hday[idx].className = "textfm_trans";
		frm.workhour_night[idx].className = "textfm_trans";
		frm.workhour_total[idx].className = "textfm5";
		frm.money_hour_ts[idx].className = "textfm5";
		frm.money_base[idx].className = "textfm5";
		frm.money_ext[idx].className = "textfm5";
		frm.money_hday[idx].className = "textfm5";
		frm.money_night[idx].className = "textfm5";
		frm.money_g1[idx].className = "textfm_trans";
		frm.money_g2[idx].className = "textfm_trans";
		frm.money_g3[idx].className = "textfm_trans";
		frm.money_b1[idx].className = "textfm_trans";
		frm.money_b2[idx].className = "textfm_trans";
		frm.money_b3[idx].className = "textfm_trans";
		frm.money_ng1[idx].className = "textfm_trans";
		frm.money_ng2[idx].className = "textfm_trans";
		frm.money_ng3[idx].className = "textfm_trans";
		frm.money_total[idx].className = "textfm5";
		frm.money_for_tax[idx].className = "textfm5";
		frm.money_yun[idx].className = "textfm_trans";
		frm.money_health[idx].className = "textfm_trans";
		frm.money_yoyang[idx].className = "textfm_trans";
		frm.money_goyong[idx].className = "textfm_trans";
		frm.tax_so[idx].className = "textfm_trans";
		frm.tax_jumin[idx].className = "textfm_trans";
		frm.money_gongje[idx].className = "textfm5";
		frm.money_result[idx].className = "textfm5";
		frm.workhour_year[idx].className = "textfm_trans";
	}
	function focusOutClass(idx)
	{
		var frm = document.dataForm;
		frm.emp_pname[idx].className = "textfm";
		frm.money_month[idx].className = "textfm";
		frm.workhour_day[idx].className = "textfm";
		frm.workhour_ext[idx].className = "textfm";
		frm.workhour_hday[idx].className = "textfm";
		frm.workhour_night[idx].className = "textfm";
		frm.workhour_total[idx].className = "textfm5";
		frm.money_hour_ts[idx].className = "textfm5";
		frm.money_base[idx].className = "textfm5";
		frm.money_ext[idx].className = "textfm5";
		frm.money_hday[idx].className = "textfm5";
		frm.money_night[idx].className = "textfm5";
		frm.money_g1[idx].className = "textfm";
		frm.money_g2[idx].className = "textfm";
		frm.money_g3[idx].className = "textfm";
		frm.money_b1[idx].className = "textfm";
		frm.money_b2[idx].className = "textfm";
		frm.money_b3[idx].className = "textfm";
		frm.money_ng1[idx].className = "textfm";
		frm.money_ng2[idx].className = "textfm";
		frm.money_ng3[idx].className = "textfm";
		frm.money_total[idx].className = "textfm5";
		frm.money_for_tax[idx].className = "textfm5";
		frm.money_yun[idx].className = "textfm";
		frm.money_health[idx].className = "textfm";
		frm.money_yoyang[idx].className = "textfm";
		frm.money_goyong[idx].className = "textfm";
		frm.tax_so[idx].className = "textfm";
		frm.tax_jumin[idx].className = "textfm";
		frm.money_gongje[idx].className = "textfm5";
		frm.money_result[idx].className = "textfm5";
		frm.workhour_year[idx].className = "textfm";
	}
	var copy_idx = -1;
	function copyData(idx)
	{
		var frm = document.dataForm;
		copy_idx = idx;
		alert("복사되었습니다.");
		return;
	}
	function pasteData(idx)
	{
		var frm = document.dataForm;
		if (copy_idx == -1)
		{
			alert("복사된 정보가 없습니다.");
			return;
		}
		frm.money_month[idx].value = frm.money_month[copy_idx].value;
		frm.workhour_day[idx].value = frm.workhour_day[copy_idx].value;
		frm.workhour_ext[idx].value = frm.workhour_ext[copy_idx].value;
		frm.workhour_hday[idx].value = frm.workhour_hday[copy_idx].value;
		frm.workhour_night[idx].value = frm.workhour_night[copy_idx].value;
		frm.workhour_total[idx].value = frm.workhour_total[copy_idx].value;
		frm.money_hour_ts[idx].value = frm.money_hour_ts[copy_idx].value;
		frm.money_base[idx].value = frm.money_base[copy_idx].value;
		frm.money_ext[idx].value = frm.money_ext[copy_idx].value;
		frm.money_hday[idx].value = frm.money_hday[copy_idx].value;
		frm.money_night[idx].value = frm.money_night[copy_idx].value;
		frm.money_g1[idx].value = frm.money_g1[copy_idx].value;
		frm.money_g2[idx].value = frm.money_g2[copy_idx].value;
		frm.money_g3[idx].value = frm.money_g3[copy_idx].value;
		frm.money_b1[idx].value = frm.money_b1[copy_idx].value;
		frm.money_b2[idx].value = frm.money_b2[copy_idx].value;
		frm.money_b3[idx].value = frm.money_b3[copy_idx].value;
		frm.money_ng1[idx].value = frm.money_ng1[copy_idx].value;
		frm.money_ng2[idx].value = frm.money_ng2[copy_idx].value;
		frm.money_ng3[idx].value = frm.money_ng3[copy_idx].value;
		frm.money_total[idx].value = frm.money_total[copy_idx].value;
		frm.money_for_tax[idx].value = frm.money_for_tax[copy_idx].value;
		frm.money_yun[idx].value = frm.money_yun[copy_idx].value;
		frm.money_health[idx].value = frm.money_health[copy_idx].value;
		frm.money_yoyang[idx].value = frm.money_yoyang[copy_idx].value;
		frm.money_goyong[idx].value = frm.money_goyong[copy_idx].value;
		frm.tax_so[idx].value = frm.tax_so[copy_idx].value;
		frm.tax_jumin[idx].value = frm.tax_jumin[copy_idx].value;
		frm.money_gongje[idx].value = frm.money_gongje[copy_idx].value;
		frm.money_result[idx].value = frm.money_result[copy_idx].value;
		frm.money_year[idx].value = frm.money_year[copy_idx].value;
		frm.workhour_year[idx].value = frm.workhour_year[copy_idx].value;
	}
	function goInput(){
		var f = document.dataForm;
		/*
		if( f.jigub_day.value == "" ){
			alert("지급일을 입력해 주세요.");
			f.jigub_day.focus();
			return;
		}
		*/
		f.mode.value = "input";
		f.action = "action_m02s01.asp";
		f.submit();
	}
	function goDelete(){
		var f = document.dataForm;
		iCheckCount = 0;
		for( var i=0; i<f.idx.length; i++ ){
			if( f.idx[i].checked ){
				iCheckCount++;
			}
		}
		if( iCheckCount == 0 ){
			alert("삭제할 항목을 선택해 주세요.");
			return;
		}
		if( confirm("삭제하시겠습니까?") ){
			f.mode.value = "delete";
			f.action = "action_m02s01.asp";
			f.submit();
		}
	}
	function selectEmp(){
		var ret = window.open("pop_select_emp.asp", "pop_select_emp", "top=100, left=100, width=800,height=600, scrollbars");
		return;
	}
	function addEmp(add_work_numb){
		var f = document.searchForm;
		f.add_work_numb.value = add_work_numb;
		f.action = "";
		f.submit();
	}
	function printPayAll(){
		frm = document.printForm;
		frm.mode.value = "salary_all";
		frm.target = "hframe";
		frm.action = "http://nomuprint.daine.co.kr/print/rp_pay.asp";
		frm.submit();
	}
	function printPaySome(){
		var f = document.dataForm;
		var pay_no = "";
		for(var i=0; i < f.idx.length; i++){
			if( f.idx[i].checked ){
				pay_no += (pay_no==""?"":",") + f.pay_no[i].value;
			}
		}
		if( pay_no == "" ){
			alert("출력할 대상을 선택해 주세요.");
			return;
		}
		frm = document.printForm;
		frm.mode.value = "salary_sel";
		frm.pa_pay_no.value = pay_no;
		frm.target = "hframe";
		frm.action = "http://nomuprint.daine.co.kr/print/rp_pay.asp";
		frm.submit();
	}
	function printPayList(){
		frm = document.printForm;
		frm.mode.value = "salary_list";
		frm.target = "hframe";
		frm.action = "http://nomuprint.daine.co.kr/print/rp_pay.asp";
		frm.submit();
	}
</script>
<body>
<iframe name="hframe" src="" style="width:0;height:0;border:0"></iframe>
<form name="printForm" method="post">
	<input type="hidden" name="mode">
	<input type="hidden" name="pa_cust_numb" value="98">
	<input type="hidden" name="pa_yyyymm" value="201311">
	<input type="hidden" name="pa_pay_no">
</form>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td valign="top" style="padding:10px 10px 10px 10px">
			<!--타이틀 -->
			<table width="100%" border=0 cellspacing=0 cellpadding=0>
				<tr>     
					<td height="18">
						<table width=100% border=0 cellspacing=0 cellpadding=0>
							<tr>
								<td style='font-size:8pt;color:#929292;'><img src=./images/g_title_icon.gif align=absmiddle  style='margin:0 5 2 0'><span style='font-size:8pt;color:black;'>급여입력</span>
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
			<!--타이틀 -->
			<!--댑메뉴 -->
			<table border=0 cellspacing=0 cellpadding=0> 
				<tr> 
					<td id="Tab_cust_tab_01_0"> 
						<table border=0 cellpadding=0 cellspacing=0> 
							<tr> 
								<td><img src="./images/g_tab_on_lt.gif"></td> 
								<td background="./images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
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
			<form name="searchForm" method="post">
				<input type="hidden" name="select_type" value="">
				<input type="hidden" name="search_pay_gbn" value="01">
				<input type="hidden" name="add_work_numb">
				<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
					<col width="10%">
					<col width="20%">
					<col width="70%">
					<tr>
						<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">임금대장</td>
						<td class="tdrow">
							<select name="search_year" class="selectfm" onChange="goSearch();">
							<option value="2010" >2010</option>
							<option value="2011" >2011</option>
							<option value="2012" >2012</option>
							<option value="2013" selected>2013</option>
							<option value="2014" >2014</option>
							</select> 년
							<select name="search_month" class="selectfm" onChange="goSearch();">
							<option value="01" >01</option>
							<option value="02" >02</option>
							<option value="03" >03</option>
							<option value="04" >04</option>
							<option value="05" >05</option>
							<option value="06" >06</option>
							<option value="07" >07</option>
							<option value="08" >08</option>
							<option value="09" >09</option>
							<option value="10" >10</option>
							<option value="11" selected>11</option>
							<option value="12" >12</option>
							</select> 월
						</td>
						<td class="tdrow">
						 <table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn9_lt.gif></td><td background=./images/btn9_bg.gif class=ftbutton5_white nowrap><a href="javascript:goSearch();" target="">검 색</a></td><td><img src=./images/btn9_rt.gif></td><td width=2></td></tr></table>
						</td>
					</tr>
				</table>
			</form>
			<div style="height:10px;font-size:0px;line-height:0px;"></div>
			<!--검색 -->
			<form name="dataForm" method="post">
				<input type="hidden" name="mode">
				<input type="hidden" name="search_year" value="2013">
				<input type="hidden" name="search_month" value="11">
				<input type="hidden" name="search_pay_gbn" value="01">
				<input type="hidden" name="url" value="/_biz/m02s01.asp?select_type=&search_pay_gbn=01&add_work_numb=64%2C66&search_year=2013&search_month=11">
				<!--댑메뉴 -->
				<table width="100%" border=0 cellspacing=0 cellpadding=0> 
					<tr> 
						<td id="Tab_cust_tab_01_0"> 
							<table border=0 cellpadding=0 cellspacing=0> 
								<tr> 
									<td><img src="./images/g_tab_on_lt.gif"></td> 
									<td background="./images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
									<a href="#">급여입력</a>
									</td> 
									<td><img src="./images/g_tab_on_rt.gif"></td> 
								</tr> 
							</table> 
						</td> 
						<td width=2></td> 
						<td align="right" style="padding-right:10"></td> 
					</tr> 
				</table>
				<div style="height:2px;font-size:0px" class="bgtr"></div>
				<div style="height:2px;font-size:0px;line-height:0px;"></div>
				
				<table border=0 cellpadding=0 cellspacing=0> 
					<tr> 
						<td> <table border=0 cellpadding=0 cellspacing=0 style=display:inline;>    <tr>       <td width=2></td>        <td><img src=./images/btn1_lt.gif></td>        <td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:printPayAll();" target="">급여명세서 전체출력</a></td>        <td><img src=./images/btn1_rt.gif></td>       <td width=2></td>      </tr>    </table>  </td>
						<td> <table border=0 cellpadding=0 cellspacing=0 style=display:inline;>    <tr>       <td width=2></td>        <td><img src=./images/btn1_lt.gif></td>        <td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:printPaySome();" target="">급여명세서 선택출력</a></td>        <td><img src=./images/btn1_rt.gif></td>       <td width=2></td>      </tr>    </table>  </td>
						<td> <table border=0 cellpadding=0 cellspacing=0 style=display:inline;>    <tr>       <td width=2></td>        <td><img src=./images/btn1_lt.gif></td>        <td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:printPayList();" target="">급여대장 출력</a></td>        <td><img src=./images/btn1_rt.gif></td>       <td width=2></td>      </tr>    </table>  </td>
					</tr> 
				</table> 
				<div style="height:2px;font-size:0px;line-height:0px;"></div>
				<!--댑메뉴 -->
				<!--리스트 -->
				<table width="100%" border="0" cellpadding="0" cellspacing="0" class="bgtable" style="table-layout:fixed;">
					<tr>
						<td width="340" height="86" valign="top">
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
								<col width="10%">
								<col width="">
								<col width="20%">
								<col width="20%">
								<col width="30%">
								<tr>
									<td nowrap height="98" align="center" style="background-color:rgb(226, 226, 226);"><input type="checkbox" name="checkall" onclick="checkAll();"></td></td>
									<td nowrap class="tdhead_center">이름</td>
									<td nowrap class="tdhead_center">입사일</td>
									<td nowrap class="tdhead_center">직책</td>
									<td nowrap class="tdhead_center">복사 / 붙여넣기</td>
								</tr>
							</table>
						</td>
						<td nowrap class="tdhead_center" valign="top">
							<div id="spanTop" style="width:100%;overflow:hidden">
								<table cellpadding=0 cellspacing=0 border=1>
									<tr>
										<td>  
											<table width="1900" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
											  <tr>
												<td class="tdhead_center" colspan="8">기본월급 및 약정근로시간(월) </td>
												<td class="tdhead_center" colspan="16">기본급 및 제수당 </td>
												<td class="tdhead_center" colspan="7">공제액</td>
												<td class="tdhead_center" rowspan="4">공제후 지급액 </td>
											  </tr>
											  <tr>
												<td class="tdhead_center" rowspan="3">기본월급</td>
												<td class="tdhead_center" colspan="5">약정근로시간</td>
												<td class="tdhead_center" rowspan="3">임금산출 총시간 </td>
												<td class="tdhead_center" rowspan="3">통상임금(시간급)</td>
												<td class="tdhead_center" colspan="5">기본월급</td>
												<td class="tdhead_center" colspan="9">제수당</td>
												<td class="tdhead_center" rowspan="3">임금계</td>
												<td class="tdhead_center" rowspan="3">과세소득</td>
												<td class="tdhead_center" rowspan="3">국민연금</td>
												<td class="tdhead_center" rowspan="3">건강보험</td>
												<td class="tdhead_center" rowspan="3">장기요양보험</td>
												<td class="tdhead_center" rowspan="3">고용보험</td>
												<td class="tdhead_center" rowspan="3">소득세</td>
												<td class="tdhead_center" rowspan="3">주민세</td>
												<td class="tdhead_center" rowspan="3">공제계</td>
											  </tr>
											  <tr>
												<td class="tdhead_center" rowspan="2">소정근로시간</td>
												<td class="tdhead_center" rowspan="2">연장근로시간</td>
												<td class="tdhead_center" rowspan="2">휴일근로시간</td>
												<td class="tdhead_center" rowspan="2">야간근로시간</td>
												<td class="tdhead_center" rowspan="2">연차휴가시간</td>
												<td class="tdhead_center" rowspan="2">기본급</td>
												<td class="tdhead_center" colspan="4">법정수당(약정)</td>
												<td class="tdhead_center" colspan="3">고정성수당</td>
												<td class="tdhead_center" colspan="3">비과세수당</td>
												<td class="tdhead_center" colspan="3">비고정성수당</td>
											  </tr>
											  <tr>
												<td class="tdhead_center">연장근로수당</td>
												<td class="tdhead_center">휴일근로수당</td>
												<td class="tdhead_center">야간근로수당</td>
												<td class="tdhead_center">연차휴가수당</td>
												<td class="tdhead_center"><input type="text" name="g1" class="textfm" style="width:100%;" value=""></td>
												<td class="tdhead_center"><input type="text" name="g2" class="textfm" style="width:100%;" value=""></td>
												<td class="tdhead_center"><input type="text" name="g3" class="textfm" style="width:100%;" value=""></td>
												<td class="tdhead_center"><input type="text" name="b1" class="textfm" style="width:100%;" value=""></td>
												<td class="tdhead_center"><input type="text" name="b2" class="textfm" style="width:100%;" value=""></td>
												<td class="tdhead_center"><input type="text" name="b3" class="textfm" style="width:100%;" value=""></td>
												<td class="tdhead_center"><input type="text" name="ng1" class="textfm" style="width:100%;" value=""></td>
												<td class="tdhead_center"><input type="text" name="ng2" class="textfm" style="width:100%;" value=""></td>
												<td class="tdhead_center"><input type="text" name="ng3" class="textfm" style="width:100%;" value=""></td>
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
						<td width="340" bgcolor="#FFFFFF">
							<div id="spanLeft" style="width:340;height:340;overflow:hidden">
								<div style="display:none;">
									<input type="checkbox" name="idx" value="0">
									<input type="hidden" name="pay_no">
									<input type="hidden" name="cust_numb">
									<input type="hidden" name="work_numb">
									<input type="hidden" name="pay_gbn">
									<input type="hidden" name="yyyymm">
									<input type="hidden" name="emp_name">
									<input type="hidden" name="emp_sdate">
									<input type="hidden" name="emp_pname">
									<input type="hidden" name="money_month">
									<input type="hidden" name="money_hour">
									<input type="hidden" name="money_hour_ts">
									<input type="hidden" name="workhour_day">
									<input type="hidden" name="workhour_ext">
									<input type="hidden" name="workhour_hday">
									<input type="hidden" name="workhour_night">
									<input type="hidden" name="workhour_total">
									<input type="hidden" name="week_hday">
									<input type="hidden" name="year_hday">
									<input type="hidden" name="money_base">
									<input type="hidden" name="money_ext">
									<input type="hidden" name="money_hday">
									<input type="hidden" name="money_night">
									<input type="hidden" name="money_week">
									<input type="hidden" name="money_year">
									<input type="hidden" name="money_g1">
									<input type="hidden" name="money_g2">
									<input type="hidden" name="money_g3">
									<input type="hidden" name="money_b1">
									<input type="hidden" name="money_b2">
									<input type="hidden" name="money_b3">
									<input type="hidden" name="money_ng1">
									<input type="hidden" name="money_ng2">
									<input type="hidden" name="money_ng3">
									<input type="hidden" name="money_total">
									<input type="hidden" name="money_for_tax">
									<input type="hidden" name="money_yun">
									<input type="hidden" name="money_health">
									<input type="hidden" name="money_yoyang">
									<input type="hidden" name="money_goyong">
									<input type="hidden" name="tax_so">
									<input type="hidden" name="tax_jumin">
									<input type="hidden" name="money_gongje">
									<input type="hidden" name="money_result">
									<input type="hidden" name="workhour_year">
								</div>
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
									<col width="10%">
									<col width="">
									<col width="20%">
									<col width="20%">
									<col width="30%">
									<tr class="list_row_now_gr" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_gr';">
										<td nowrap class="ltrow1_center_h22">
											<input type="checkbox" name="idx" value="1">
										</td>
										<td nowrap class="ltrow1_center_h22">김석순</td>
										<td nowrap class="ltrow1_center_h22">2011-08-01</td>
										<td nowrap class="ltrow1_center_h22"><input type="text" name="emp_pname" value="" style="width:100%;ime-mode:active;" class="textfm" onfocusin="javascript:focusInClass('1');" onfocusout="javascript:focusOutClass('1');"></td>
										<td nowrap class="ltrow1_center_h22">
											 <table border=0 cellpadding=0 cellspacing=0 style=display:inline;>    <tr>       <td width=2></td>        <td><img src=./images/btn1_lt.gif></td>        <td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:copyData('1');" target="">복사</a></td>        <td><img src=./images/btn1_rt.gif></td>       <td width=2></td>      </tr>    </table>   <table border=0 cellpadding=0 cellspacing=0 style=display:inline;>    <tr>       <td width=2></td>        <td><img src=./images/btn1_lt.gif></td>        <td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:pasteData('1');" target="">붙여넣기</a></td>        <td><img src=./images/btn1_rt.gif></td>       <td width=2></td>      </tr>    </table>  
										</td>
									</tr>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<td nowrap class="ltrow1_center_h22">
											<input type="checkbox" name="idx" value="2">
										</td>
										<td nowrap class="ltrow1_center_h22">서분순</td>
										<td nowrap class="ltrow1_center_h22">2011-09-07</td>
										<td nowrap class="ltrow1_center_h22"><input type="text" name="emp_pname" value="" style="width:100%;ime-mode:active;" class="textfm" onfocusin="javascript:focusInClass('2');" onfocusout="javascript:focusOutClass('2');"></td>
										<td nowrap class="ltrow1_center_h22">
											 <table border=0 cellpadding=0 cellspacing=0 style=display:inline;>    <tr>       <td width=2></td>        <td><img src=./images/btn1_lt.gif></td>        <td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:copyData('2');" target="">복사</a></td>        <td><img src=./images/btn1_rt.gif></td>       <td width=2></td>      </tr>    </table>   <table border=0 cellpadding=0 cellspacing=0 style=display:inline;>    <tr>       <td width=2></td>        <td><img src=./images/btn1_lt.gif></td>        <td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:pasteData('2');" target="">붙여넣기</a></td>        <td><img src=./images/btn1_rt.gif></td>       <td width=2></td>      </tr>    </table>  
										</td>
									</tr>
								</table>
								<br>&nbsp;
								</div>
							</td>
							<td bgcolor="#FFFFFF">
								<div id="spanMain" style="width:100%;height:340;overflow:scroll;" onScroll="spanLeft.scrollTop = this.scrollTop; spanTop.scrollLeft = this.scrollLeft;">
									<table width="1900" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
									<tr class="list_row_now_gr" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_gr';">
										<input type="hidden" name="pay_no" value="">
										<input type="hidden" name="cust_numb" value="98">
										<input type="hidden" name="work_numb" value="64">
										<input type="hidden" name="pay_gbn" value="01">
										<input type="hidden" name="yyyymm" value="201311">
										<input type="hidden" name="emp_name" value="김석순">
										<input type="hidden" name="emp_sdate" value="2011-08-01">
										<input type="hidden" name="money_hour" value="0">
										<input type="hidden" name="week_hday" value="0">
										<input type="hidden" name="year_hday" value="0">
										<input type="hidden" name="money_week" value="">
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('1');" onfocusout="javascript:focusOutClass('1');" class="textfm" name="money_month" value="460000" onKeyUp="cal_pay('1');"></td><!-- 기본월급 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('1');" onfocusout="javascript:focusOutClass('1');" class="textfm" name="workhour_day" value="67" onKeyUp="cal_pay('1');"></td><!-- 소정근로시간 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('1');" onfocusout="javascript:focusOutClass('1');" class="textfm" name="workhour_ext" value="" onKeyUp="cal_pay('1');"></td><!-- 연장근로시간 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('1');" onfocusout="javascript:focusOutClass('1');" class="textfm" name="workhour_hday" value="" onKeyUp="cal_pay('1');"></td><!-- 휴일근로시간 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('1');" onfocusout="javascript:focusOutClass('1');" class="textfm" name="workhour_night" value="" onKeyUp="cal_pay('1');"></td><!-- 야간근로시간 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('1');" onfocusout="javascript:focusOutClass('1');" class="textfm" name="workhour_year" value="" onKeyUp="cal_pay('1');"></td><!-- 연차휴가시간 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('1');" onfocusout="javascript:focusOutClass('1');" class="textfm5" readonly name="workhour_total" value="67"></td><!-- 임금산출 총시간 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('1');" onfocusout="javascript:focusOutClass('1');" class="textfm5" readonly name="money_hour_ts" value="6865.67164179104"></td><!-- 통상임금(시간급) -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('1');" onfocusout="javascript:focusOutClass('1');" class="textfm5" readonly name="money_base" value="460000"></td><!-- 기본급 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('1');" onfocusout="javascript:focusOutClass('1');" class="textfm5" readonly name="money_ext" value=""></td><!-- 연장근로수당 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('1');" onfocusout="javascript:focusOutClass('1');" class="textfm5" readonly name="money_hday" value=""></td><!-- 휴일근로수당 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('1');" onfocusout="javascript:focusOutClass('1');" class="textfm5" readonly name="money_night" value=""></td><!-- 야간근로수당 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('1');" onfocusout="javascript:focusOutClass('1');" class="textfm5" readonly name="money_year" value=""></td><!-- 연차휴가수당 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('1');" onfocusout="javascript:focusOutClass('1');" class="textfm" name="money_g1" value="" onKeyUp="cal_pay('1');"></td><!-- 고정성1 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('1');" onfocusout="javascript:focusOutClass('1');" class="textfm" name="money_g2" value="" onKeyUp="cal_pay('1');"></td><!-- 고정성2 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('1');" onfocusout="javascript:focusOutClass('1');" class="textfm" name="money_g3" value="" onKeyUp="cal_pay('1');"></td><!-- 고정성3 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('1');" onfocusout="javascript:focusOutClass('1');" class="textfm" name="money_b1" value="" onKeyUp="cal_pay('1');"></td><!-- 비과세1 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('1');" onfocusout="javascript:focusOutClass('1');" class="textfm" name="money_b2" value="" onKeyUp="cal_pay('1');"></td><!-- 비과세2 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('1');" onfocusout="javascript:focusOutClass('1');" class="textfm" name="money_b3" value="" onKeyUp="cal_pay('1');"></td><!-- 비과세3 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('1');" onfocusout="javascript:focusOutClass('1');" class="textfm" name="money_ng1" value="" onKeyUp="cal_pay('1');"></td><!-- 비고정1 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('1');" onfocusout="javascript:focusOutClass('1');" class="textfm" name="money_ng2" value="" onKeyUp="cal_pay('1');"></td><!-- 비고정2 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('1');" onfocusout="javascript:focusOutClass('1');" class="textfm" name="money_ng3" value="" onKeyUp="cal_pay('1');"></td><!-- 비고정3 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('1');" onfocusout="javascript:focusOutClass('1');" class="textfm5" readonly name="money_total" value="460000"></td><!-- 임금계 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('1');" onfocusout="javascript:focusOutClass('1');" class="textfm5" readonly name="money_for_tax" value="460000"></td><!-- 과세소득 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('1');" onfocusout="javascript:focusOutClass('1');" class="textfm" name="money_yun" value="20700" onKeyUp="cal_pay2('1');"></td><!-- 국민연금 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('1');" onfocusout="javascript:focusOutClass('1');" class="textfm" name="money_health" value="13540" onKeyUp="cal_pay2('1');"></td><!-- 건강보험 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('1');" onfocusout="javascript:focusOutClass('1');" class="textfm" name="money_yoyang" value="880" onKeyUp="cal_pay2('1');"></td><!-- 장기요양보험 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('1');" onfocusout="javascript:focusOutClass('1');" class="textfm" name="money_goyong" value="2990" onKeyUp="cal_pay2('1');"></td><!-- 고용보험 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('1');" onfocusout="javascript:focusOutClass('1');" class="textfm" name="tax_so" value="" onKeyUp="cal_pay3('1');"></td><!-- 소득세 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('1');" onfocusout="javascript:focusOutClass('1');" class="textfm" name="tax_jumin" value="" onKeyUp="cal_pay2('1');"></td><!-- 주민세 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('1');" onfocusout="javascript:focusOutClass('1');" class="textfm5" readonly name="money_gongje" value="38110"></td><!-- 공제계 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('1');" onfocusout="javascript:focusOutClass('1');" class="textfm5" readonly name="money_result" value="421890"></td><!-- 공제후지급액 -->
									</tr>
									<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
										<input type="hidden" name="pay_no" value="">
										<input type="hidden" name="cust_numb" value="98">
										<input type="hidden" name="work_numb" value="66">
										<input type="hidden" name="pay_gbn" value="01">
										<input type="hidden" name="yyyymm" value="201311">
										<input type="hidden" name="emp_name" value="서분순">
										<input type="hidden" name="emp_sdate" value="2011-09-07">
										<input type="hidden" name="money_hour" value="0">
										<input type="hidden" name="week_hday" value="0">
										<input type="hidden" name="year_hday" value="0">
										<input type="hidden" name="money_week" value="">
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('2');" onfocusout="javascript:focusOutClass('2');" class="textfm" name="money_month" value="470000" onKeyUp="cal_pay('2');"></td><!-- 기본월급 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('2');" onfocusout="javascript:focusOutClass('2');" class="textfm" name="workhour_day" value="87" onKeyUp="cal_pay('2');"></td><!-- 소정근로시간 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('2');" onfocusout="javascript:focusOutClass('2');" class="textfm" name="workhour_ext" value="" onKeyUp="cal_pay('2');"></td><!-- 연장근로시간 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('2');" onfocusout="javascript:focusOutClass('2');" class="textfm" name="workhour_hday" value="" onKeyUp="cal_pay('2');"></td><!-- 휴일근로시간 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('2');" onfocusout="javascript:focusOutClass('2');" class="textfm" name="workhour_night" value="" onKeyUp="cal_pay('2');"></td><!-- 야간근로시간 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('2');" onfocusout="javascript:focusOutClass('2');" class="textfm" name="workhour_year" value="" onKeyUp="cal_pay('2');"></td><!-- 연차휴가시간 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('2');" onfocusout="javascript:focusOutClass('2');" class="textfm5" readonly name="workhour_total" value="87"></td><!-- 임금산출 총시간 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('2');" onfocusout="javascript:focusOutClass('2');" class="textfm5" readonly name="money_hour_ts" value="5402.29885057471"></td><!-- 통상임금(시간급) -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('2');" onfocusout="javascript:focusOutClass('2');" class="textfm5" readonly name="money_base" value="470000"></td><!-- 기본급 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('2');" onfocusout="javascript:focusOutClass('2');" class="textfm5" readonly name="money_ext" value=""></td><!-- 연장근로수당 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('2');" onfocusout="javascript:focusOutClass('2');" class="textfm5" readonly name="money_hday" value=""></td><!-- 휴일근로수당 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('2');" onfocusout="javascript:focusOutClass('2');" class="textfm5" readonly name="money_night" value=""></td><!-- 야간근로수당 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('2');" onfocusout="javascript:focusOutClass('2');" class="textfm5" readonly name="money_year" value=""></td><!-- 연차휴가수당 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('2');" onfocusout="javascript:focusOutClass('2');" class="textfm" name="money_g1" value="" onKeyUp="cal_pay('2');"></td><!-- 고정성1 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('2');" onfocusout="javascript:focusOutClass('2');" class="textfm" name="money_g2" value="" onKeyUp="cal_pay('2');"></td><!-- 고정성2 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('2');" onfocusout="javascript:focusOutClass('2');" class="textfm" name="money_g3" value="" onKeyUp="cal_pay('2');"></td><!-- 고정성3 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('2');" onfocusout="javascript:focusOutClass('2');" class="textfm" name="money_b1" value="" onKeyUp="cal_pay('2');"></td><!-- 비과세1 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('2');" onfocusout="javascript:focusOutClass('2');" class="textfm" name="money_b2" value="" onKeyUp="cal_pay('2');"></td><!-- 비과세2 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('2');" onfocusout="javascript:focusOutClass('2');" class="textfm" name="money_b3" value="" onKeyUp="cal_pay('2');"></td><!-- 비과세3 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('2');" onfocusout="javascript:focusOutClass('2');" class="textfm" name="money_ng1" value="" onKeyUp="cal_pay('2');"></td><!-- 비고정1 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('2');" onfocusout="javascript:focusOutClass('2');" class="textfm" name="money_ng2" value="" onKeyUp="cal_pay('2');"></td><!-- 비고정2 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('2');" onfocusout="javascript:focusOutClass('2');" class="textfm" name="money_ng3" value="" onKeyUp="cal_pay('2');"></td><!-- 비고정3 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('2');" onfocusout="javascript:focusOutClass('2');" class="textfm5" readonly name="money_total" value="470000"></td><!-- 임금계 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('2');" onfocusout="javascript:focusOutClass('2');" class="textfm5" readonly name="money_for_tax" value="470000"></td><!-- 과세소득 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('2');" onfocusout="javascript:focusOutClass('2');" class="textfm" name="money_yun" value="21150" onKeyUp="cal_pay2('2');"></td><!-- 국민연금 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('2');" onfocusout="javascript:focusOutClass('2');" class="textfm" name="money_health" value="13840" onKeyUp="cal_pay2('2');"></td><!-- 건강보험 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('2');" onfocusout="javascript:focusOutClass('2');" class="textfm" name="money_yoyang" value="900" onKeyUp="cal_pay2('2');"></td><!-- 장기요양보험 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('2');" onfocusout="javascript:focusOutClass('2');" class="textfm" name="money_goyong" value="3050" onKeyUp="cal_pay2('2');"></td><!-- 고용보험 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('2');" onfocusout="javascript:focusOutClass('2');" class="textfm" name="tax_so" value="" onKeyUp="cal_pay3('2');"></td><!-- 소득세 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('2');" onfocusout="javascript:focusOutClass('2');" class="textfm" name="tax_jumin" value="" onKeyUp="cal_pay2('2');"></td><!-- 주민세 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('2');" onfocusout="javascript:focusOutClass('2');" class="textfm5" readonly name="money_gongje" value="38940"></td><!-- 공제계 -->
										<td nowrap class="ltrow1_center_h22"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('2');" onfocusout="javascript:focusOutClass('2');" class="textfm5" readonly name="money_result" value="431060"></td><!-- 공제후지급액 -->
									</tr>
									</table>
								</div>
							</td>
						</tr>
					</table>
					<!--리스트 -->
				</form>
			</td>
		</tr>
</table>
</body>
</html>
