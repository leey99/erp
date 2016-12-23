<?
//요일 A,B 7+7 = 14
$work_gbn_count = 14;

$sql_work_time = " select * from a4_work_time where com_code='$code' and sabun='' ";
//echo $sql_work_time;
$result_work_time = sql_query($sql_work_time);
$row_work_time = mysql_fetch_array($result_work_time);
?>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/lang/calendar-ko.js"></script>
<style type="text/css"> 
@import url("./js/jscalendar-1.0/calendar-system.css"); 
</style>
<script language="javascript">
// 계산전 초기화
function initWorkTime(){
	var f = document.form1;
	f.a_workhour_day_d.value = "0";
	f.a_workhour_day_w.value = "0";
	f.a_workhour_ext_w.value = "0";
	f.a_workhour_hday_w.value = "0";
	f.a_workhour_night_w.value = "0";
	f.b_workhour_day_d.value = "0";
	f.b_workhour_day_w.value = "0";
	f.b_workhour_ext_w.value = "0";
	f.b_workhour_hday_w.value = "0";
	f.b_workhour_night_w.value = "0";
	if( f.a_checked.checked && isValidWorkTime("A") ){
		setWorkTime("A");
	}
	if( f.b_checked.checked && isValidWorkTime("B") ){
		setWorkTime("B");
	}
}
function changeWorkDayMonth(){
	initWorkTime(); /////////////////////////////////
	var f = document.form1;
	var workday_month = f.workday_month.value;
	var workday_week = 0;
	if( workday_month != "" ){
		workday_week = workday_month / 4;
	}
	f.workday_week.value = workday_week;
	//alert(workday_week);
	if( f.workday_month.value == "" ){ // 근무일 확인
		return;
	}
	if( f.a_checked.checked && isValidWorkTime("A") ){ // 주5일제, 6일제 확인
		setWorkTime("A");
	}
	if( f.b_checked.checked && isValidWorkTime("B") ){
		setWorkTime("B");
	}
}
function checkWorkGbn( work_gbn, checked ){
	var f = document.form1;
	if(work_gbn == "A") f.b_checked.checked=false;
	else if(work_gbn == "B") f.a_checked.checked=false;
}
function setWorkTime( work_gbn ){
	var emp5_gbn = "";
	var f = document.form1;
	var week_day, workday_gbn, work_shour,work_smin,work_ehour,work_emin;
	var ext_shour,ext_smin,ext_ehour,ext_emin,night_shour,night_smin,night_ehour,night_emin;
	var rest_shour,rest_smin,rest_ehour,rest_emin,rest_shour2,rest_smin2,rest_ehour2,rest_emin2,rest_shour3,rest_smin3,rest_ehour3,rest_emin3;
	var workhour_day_d, workhour_day_w, workhour_ext_w, workhour_hday_w, workhour_night_w, workhour_day, workhour_ext, workhour_hday, workhour_night ;
	var work_time, rest_time, rest_time2, rest_time3;
	var workday_week = f.workday_week.value; // 일반직원 주간 근무일수
	workhour_day_d = 0;
	workhour_day_w = 0;
	workhour_ext_w = 0;
	workhour_hday_w = 0;
	workhour_night_w = 0;
	workhour_day = 0;
	workhour_ext = 0;
	workhour_hday = 0;
	workhour_night = 0;
	work_time = 0;
	rest_time = 0;
	rest_time2 = 0;
	rest_time3 = 0;
	for( var i=0; i<<?=$work_gbn_count?>; i++ ){ // 7*4
		//alert(i+" "+f.work_gbn[i].value+" == "+work_gbn);
		if( f.work_gbn[i].value == work_gbn ){
			workhour_day = 0;
			workhour_ext = 0;
			workhour_hday = 0;
			workhour_night = 0;
			week_day = f.week_day[i].value; // 요일
			workday_gbn = f.workday_gbn[i].value; // 근무유형
			//alert(i+" "+workday_gbn);
			//근무시간
			work_shour = toInt(f.work_shour[i].value);
			work_smin = toInt(f.work_smin[i].value);
			work_ehour = toInt(f.work_ehour[i].value);
			work_emin = toInt(f.work_emin[i].value);
			//휴게시간1
			rest_shour = toInt(f.rest_shour[i].value);
			rest_smin = toInt(f.rest_smin[i].value);
			rest_ehour = toInt(f.rest_ehour[i].value);
			rest_emin = toInt(f.rest_emin[i].value);
			//휴게시간2
			rest_shour2 = toInt(f.rest_shour2[i].value);
			rest_smin2 = toInt(f.rest_smin2[i].value);
			rest_ehour2 = toInt(f.rest_ehour2[i].value);
			rest_emin2 = toInt(f.rest_emin2[i].value);
			//휴게시간3
			rest_shour3 = toInt(f.rest_shour3[i].value);
			rest_smin3 = toInt(f.rest_smin3[i].value);
			rest_ehour3 = toInt(f.rest_ehour3[i].value);
			rest_emin3 = toInt(f.rest_emin3[i].value);
			//연장근무 시간
			ext_shour = toInt(f.ext_shour[i].value);
			ext_smin = toInt(f.ext_smin[i].value);
			ext_ehour = toInt(f.ext_ehour[i].value);
			ext_emin = toInt(f.ext_emin[i].value);
			//야간근무 시간
			night_shour = toInt(f.night_shour[i].value);
			night_smin = toInt(f.night_smin[i].value);
			night_ehour = toInt(f.night_ehour[i].value);
			night_emin = toInt(f.night_emin[i].value);
			//alert(work_shour);
			//null분 0분 처리
			if(work_shour != "") {
				if(work_smin == "") work_smin = "0";
			}
			if(work_ehour != "") {
				if(work_emin == "") work_emin = "0";
			}
			if(rest_shour != "") {
				if(rest_smin == "") rest_smin = "0";
			}
			if(rest_ehour != "") {
				if(rest_emin == "") rest_emin = "0";
			}
			if(rest_shour2 != "") {
				if(rest_smin2 == "") rest_smin2 = "0";
			}
			if(rest_ehour2 != "") {
				if(rest_emin2 == "") rest_emin2 = "0";
			}
			if(rest_shour3 != "") {
				if(rest_smin3 == "") rest_smin3 = "0";
			}
			if(rest_ehour3 != "") {
				if(rest_emin3 == "") rest_emin3 = "0";
			}
			if(ext_shour != "") {
				if(ext_smin == "") ext_smin = "0";
			}
			if(ext_ehour != "") {
				if(ext_emin == "") ext_emin = "0";
			}
			if(night_shour != "") {
				if(night_smin == "") night_smin = "0";
			}
			if(night_ehour != "") {
				if(night_emin == "") night_emin = "0";
			}
			//alert(workday_gbn+"/"+work_shour+"/"+work_smin+"/"+work_ehour+"/"+work_emin);
			if( workday_gbn != "" && work_shour != "" && work_smin != "" && work_ehour != "" && work_emin != "" ) {
				var work_hour_arr = new Array();  // 시업시간(0) ~ 종업시간(23)
				var rest_hour_arr = new Array();  // 휴게시간시작(0) ~ 휴게시간종료(23)
				var rest2_hour_arr = new Array(); // 휴게시간2시작(0) ~ 휴게시간종료(23)
				var rest3_hour_arr = new Array(); // 휴게시간3시작(0) ~ 휴게시간종료(23)
				var ext_hour_arr = new Array();   // 연장근무시간시작(0) ~ 휴게시간종료(23)
				var night_hour_arr = new Array(); // 야간근무시간시작(0) ~ 휴게시간종료(23)
				for(var j=0; j < 24; j++) {
					work_hour_arr[j] = 0;
					rest_hour_arr[j] = 0;
					rest2_hour_arr[j] = 0;
					rest3_hour_arr[j] = 0;
					ext_hour_arr[j] = 0;
					night_hour_arr[j] = 0;
				}
				//alert(work_hour_arr[0]);
				if( work_shour != "" && work_smin != "" && work_ehour != "" && work_emin != "" ) {
					//alert(work_ehour+" > "+work_shour);
					if( work_ehour > work_shour ){
						//alert(work_ehour);
						var iStart = toInt(work_shour);
						var iEnd = toInt(work_ehour);
						for( var j=iStart; j<=iEnd; j++ ){
							if( j == iStart ) work_hour_arr[j] += (60 - toInt(work_smin));
							else if( j == iEnd ) work_hour_arr[j] += toInt(work_emin);
							else work_hour_arr[j] += 60;
							//alert(work_hour_arr[j]);
						}
					}else if( work_ehour < work_shour ){
						var iStart = toInt(work_shour);
						var iEnd = 23;
						for( var j=iStart; j<=iEnd; j++ ){
							if( j == iStart ) work_hour_arr[j] += (60 - toInt(work_smin));
							else work_hour_arr[j] += 60;
						}
						iStart = 0;
						iEnd = toInt(work_ehour);
						for( var j=iStart; j<=iEnd; j++ ){
							if( j == iEnd ) work_hour_arr[j] += toInt(work_emin);
							else work_hour_arr[j] += 60;
						}
					}else{ // work_ehour == work_shour
						var idx = toInt(work_shour);
						var tmp = toInt(work_emin) - toInt(work_smin);
						if( tmp > 0 ) work_hour_arr[idx] += tmp;
					}
				}
				if( rest_shour != "" && rest_smin != "" && rest_ehour != "" && rest_emin != "" ){
					if( rest_ehour > rest_shour ){
						var iStart = toInt(rest_shour);
						var iEnd = toInt(rest_ehour);
						for( var j=iStart; j<=iEnd; j++ ){
							if( j == iStart ) rest_hour_arr[j] += (60 - toInt(rest_smin));
							else if( j == iEnd ) rest_hour_arr[j] += toInt(rest_emin);
							else rest_hour_arr[j] += 60;
						}
					}else if( rest_ehour < rest_shour ){
						var iStart = toInt(rest_shour);
						var iEnd = 23;
						for( var j=iStart; j<=iEnd; j++ ){
							if( j == iStart ) rest_hour_arr[j] += (60 - toInt(rest_smin));
							else rest_hour_arr[j] += 60;
						}
						iStart = 0;
						iEnd = toInt(rest_ehour);
						for( var j=iStart; j<=iEnd; j++ ){
							if( j == iEnd ) rest_hour_arr[j] += toInt(rest_emin);
							else rest_hour_arr[j] += 60;
						}
					}else{ // rest_ehour == rest_shour
						var idx = toInt(rest_shour);
						var tmp = toInt(rest_emin) - toInt(rest_smin);
						if( tmp > 0 ) rest_hour_arr[idx] += tmp;
					}
				}
				if( rest_shour2 != "" && rest_smin2 != "" && rest_ehour2 != "" && rest_emin2 != "" ){
					if( rest_ehour2 > rest_shour2 ){
						var iStart = toInt(rest_shour2);
						var iEnd = toInt(rest_ehour2);
						for( var j=iStart; j<=iEnd; j++ ){
							if( j == iStart ) rest2_hour_arr[j] += (60 - toInt(rest_smin2));
							else if( j == iEnd ) rest2_hour_arr[j] += toInt(rest_emin2);
							else rest2_hour_arr[j] += 60;
						}
					}else if( rest_ehour2 < rest_shour2 ){
						var iStart = toInt(rest_shour2);
						var iEnd = 23;
						for( var j=iStart; j<=iEnd; j++ ){
							if( j == iStart ) rest2_hour_arr[j] += (60 - toInt(rest_smin2));
							else rest2_hour_arr[j] += 60;
						}
						iStart = 0;
						iEnd = toInt(rest_ehour2);
						for( var j=iStart; j<=iEnd; j++ ){
							if( j == iEnd ) rest2_hour_arr[j] += toInt(rest_emin2);
							else rest2_hour_arr[j] += 60;
						}
					}else{ // rest_ehour2 == rest_shour2
						var idx = toInt(rest_shour2);
						var tmp = toInt(rest_emin2) - toInt(rest_smin2);
						if( tmp > 0 ) rest2_hour_arr[idx] += tmp;
					}
				}
				if( rest_shour3 != "" && rest_smin3 != "" && rest_ehour3 != "" && rest_emin3 != "" ){
					if( rest_ehour3 > rest_shour3 ){
						var iStart = toInt(rest_shour3);
						var iEnd = toInt(rest_ehour3);
						for( var j=iStart; j<=iEnd; j++ ){
							if( j == iStart ) rest3_hour_arr[j] += (60 - toInt(rest_smin3));
							else if( j == iEnd ) rest3_hour_arr[j] += toInt(rest_emin3);
							else rest3_hour_arr[j] += 60;
						}
					}else if( rest_ehour3 < rest_shour3 ){
						var iStart = toInt(rest_shour3);
						var iEnd = 23;
						for( var j=iStart; j<=iEnd; j++ ){
							if( j == iStart ) rest2_hour_arr[j] += (60 - toInt(rest_smin3));
							else rest3_hour_arr[j] += 60;
						}
						iStart = 0;
						iEnd = toInt(rest_ehour3);
						for( var j=iStart; j<=iEnd; j++ ){
							if( j == iEnd ) rest3_hour_arr[j] += toInt(rest_emin3);
							else rest3_hour_arr[j] += 60;
						}
					}else{ // rest_ehour3 == rest_shour3
						var idx = toInt(rest_shour3);
						var tmp = toInt(rest_emin3) - toInt(rest_smin3);
						if( tmp > 0 ) rest3_hour_arr[idx] += tmp;
					}
				}
				//연장근무
				if( ext_shour != "" && ext_smin != "" && ext_ehour != "" && ext_emin != "" ){
					if( ext_ehour > ext_shour ){
						var iStart = toInt(ext_shour);
						var iEnd = toInt(ext_ehour);
						for( var j=iStart; j<=iEnd; j++ ){
							if( j == iStart ) ext_hour_arr[j] += (60 - toInt(ext_smin));
							else if( j == iEnd ) ext_hour_arr[j] += toInt(ext_emin);
							else ext_hour_arr[j] += 60;
						}
					}else if( ext_ehour < ext_shour ){
						var iStart = toInt(ext_shour);
						var iEnd = 23;
						for( var j=iStart; j<=iEnd; j++ ){
							if( j == iStart ) ext_hour_arr[j] += (60 - toInt(ext_smin));
							else ext_hour_arr[j] += 60;
						}
						iStart = 0;
						iEnd = toInt(ext_ehour);
						for( var j=iStart; j<=iEnd; j++ ){
							if( j == iEnd ) ext_hour_arr[j] += toInt(ext_emin);
							else ext_hour_arr[j] += 60;
						}
					}else{ // ext_ehour == ext_shour
						var idx = toInt(ext_shour);
						var tmp = toInt(ext_emin) - toInt(ext_smin);
						if( tmp > 0 ) ext_hour_arr[idx] += tmp;
					}
				}
				//야간근무
				if( night_shour != "" && night_smin != "" && night_ehour != "" && night_emin != "" ){
					if( night_ehour > night_shour ){
						var iStart = toInt(night_shour);
						var iEnd = toInt(night_ehour);
						for( var j=iStart; j<=iEnd; j++ ){
							if( j == iStart ) night_hour_arr[j] += (60 - toInt(night_smin));
							else if( j == iEnd ) night_hour_arr[j] += toInt(night_emin);
							else night_hour_arr[j] += 60;
						}
					}else if( night_ehour < night_shour ){
						var iStart = toInt(night_shour);
						var iEnd = 23;
						for( var j=iStart; j<=iEnd; j++ ){
							if( j == iStart ) night_hour_arr[j] += (60 - toInt(night_smin));
							else night_hour_arr[j] += 60;
						}
						iStart = 0;
						iEnd = toInt(night_ehour);
						for( var j=iStart; j<=iEnd; j++ ){
							if( j == iEnd ) night_hour_arr[j] += toInt(night_emin);
							else night_hour_arr[j] += 60;
						}
					}else{ // night_ehour == night_shour
						var idx = toInt(night_shour);
						var tmp = toInt(night_emin) - toInt(night_smin);
						if( tmp > 0 ) night_hour_arr[idx] += tmp;
					}
				}
				// 소정근로시간
				//alert(work_hour_arr.length);
				if ( workday_gbn == "01" || workday_gbn == "04" ){ // 근무일, 무급근로
					for( var j=0; j < work_hour_arr.length; j++ ){
						var tmp = work_hour_arr[j] - rest_hour_arr[j]- rest2_hour_arr[j]- rest3_hour_arr[j];
						if( tmp > 0 ) workhour_day += tmp;
					}
				}
				// 휴일근로시간
				if( workday_gbn == "02" || workday_gbn == "03" ){ //유급휴일, 무급휴일
					for( var j=0; j < work_hour_arr.length; j++ ){
						var tmp = work_hour_arr[j] - rest_hour_arr[j]- rest2_hour_arr[j]- rest3_hour_arr[j];
						if( tmp > 0 ) workhour_hday += tmp;
					}
				}
				// 야간근로시간
/*
				for( var j=0; j < work_hour_arr.length; j++ ){
					if( j <= 5 || j >= 22  ){
						var tmp = work_hour_arr[j] - rest_hour_arr[j]- rest2_hour_arr[j]- rest3_hour_arr[j];
						if( tmp > 0 ) workhour_night += tmp;
						//document.all.debug.value += "["+work_gbn+"]["+i+"]["+workday_gbn+"]["+j+"]"+ tmp+"\r\n";
					}
				}
				//document.all.debug.value += "["+work_gbn+"]["+i+"]["+workday_gbn+"]"+ workhour_night+"\r\n";
*/
				//연장근로시간
				if ( workday_gbn == "01" || workday_gbn == "04" ){ // 근무일, 무급근로
					for( var j=0; j < ext_hour_arr.length; j++ ){
						var tmp = ext_hour_arr[j];
						if( tmp > 0 ) workhour_ext += tmp;
					}
				}
				//야간근로시간
				if ( workday_gbn == "01" || workday_gbn == "04" ){ // 근무일, 무급근로
					for( var j=0; j < night_hour_arr.length; j++ ){
						var tmp = night_hour_arr[j];
						if( tmp > 0 ) workhour_night += tmp;
					}
				}
				//alert(workhour_day);
				workhour_day /= 60.0;
				workhour_hday /= 60.0;
				workhour_ext /= 60.0;
				workhour_night /= 60.0;
				//alert(workday_week);
				// 연장근로시간(workhour_ext), 소정근로시간
				if( workday_week == 5 ){ // 주 5일제, 일별로 계산
					if( workhour_day > 8 ){
						//workhour_ext = workhour_day - 8;
						//workhour_day = 8;
					}else{
						//workhour_ext = 0;
						//workhour_day = workhour_day;
					}
				}else if( workday_week == 6 ){ // 주 6일제, 일별로 계산 안함, 전체 합계로 계산
					//6에서 5로 변경, 월~금까지만 계산 13.12.18
					//workday_week = 5;
					//workhour_ext = 0;
					//workhour_day = workhour_day;
				}
				//alert(workday_week);
				workhour_day_w += workhour_day;
				//alert(workhour_day_w);
				workhour_ext_w += workhour_ext;
				workhour_hday_w += workhour_hday;
				workhour_night_w += workhour_night;
			}
		} // if( f.work_gbn[i].value == work_gbn )
	} // end for
	// 1주 연장근로시간, 소정근로시간 (6일제, 재계산)
	if( workday_week == 6 ){ // 주 6일제 - 소정근로시간, 연장근로시간  전체 합계로 계산
		if( work_gbn == "A" ){
			if( workhour_day_w > 40 ){
				workhour_ext_w = workhour_day_w - 40;
				workhour_day_w = 40;
			}else{
				workhour_ext_w = 0;
				//workhour_day_w = workhour_day_w;
			}
		}else if( work_gbn == "B" ){
			if( workhour_day_w >= 44 ){
				workhour_ext_w = workhour_day_w - 44;
				//주44시간
				workhour_day_w = 44;
			}else{
				workhour_ext_w = 0;
				//workhour_day_w = workhour_day_w;
			}
		}
	}
	//alert(workhour_day_w+" / "+workday_week);
	// 1일 소정근로시간
	if( workday_week > 0 ) {
		workhour_day_d = workhour_day_w / workday_week;
		//alert(workhour_day_d+" = "+workhour_day_w+" / "+workday_week);
	}
	// 5인미만 사업장 - 야간근로 시간 없음. 2013.08.05 추가
	if( emp5_gbn == "1" ) { // 5인이하
		workhour_night = 0;
		workhour_night_w = 0;
	}
	workhour_day_d = ( parseInt(workhour_day_d * 1000) / 1000);
	//workhour_day_d = Math.round(workhour_day_d * 10) / 10;
	//alert(workhour_day_d);
	workhour_day_w = ( parseInt(workhour_day_w * 1000) / 1000);
	workhour_ext_w = ( parseInt(workhour_ext_w * 1000) / 1000);
	workhour_hday_w = ( parseInt(workhour_hday_w * 1000) / 1000);
	workhour_night_w = ( parseInt(workhour_night_w * 1000) / 1000);
	if( work_gbn == "A" ) {
		//1일 소정근로시간 초과 빨간색 표시
		if(workhour_day_d > 8) f.a_workhour_day_d.style.color = "red";
		else f.a_workhour_day_d.style.color = "#343434";
		f.a_workhour_day_d.value = workhour_day_d;
		f.a_workhour_day_w.value = workhour_day_w;
		f.a_workhour_ext_w.value = workhour_ext_w;
		f.a_workhour_hday_w.value = workhour_hday_w;
		f.a_workhour_night_w.value = workhour_night_w;
	}else if( work_gbn == "B" ) {
		//1일 소정근로시간 초과 빨간색 표시

		//근무시간 기초값 (토요일 근무시간 제외)
		i = 12;
		//alert(j);
		workday_gbn = f.workday_gbn[i].value; // 근무유형
		work_shour = toInt(f.work_shour[i].value);
		work_smin = toInt(f.work_smin[i].value);
		work_ehour = toInt(f.work_ehour[i].value);
		work_emin = toInt(f.work_emin[i].value);

		for(var j=0; j < 24; j++) {
			work_hour_arr[j] = 0;
			rest_hour_arr[j] = 0;
			rest2_hour_arr[j] = 0;
			rest3_hour_arr[j] = 0;
		}
		//근무시간 계산식
		//alert(work_shour+":"+work_smin+" ~ "+work_ehour+":"+work_emin);
		if( work_shour != "" && work_ehour != "" ) {
			//alert(work_ehour+" > "+work_shour);
			if( work_ehour > work_shour ){
				//alert(work_ehour);
				iStart = toInt(work_shour);
				iEnd = toInt(work_ehour);
				//alert(iStart+", "+iEnd+", "+work_hour_arr[j]);
				for( j=iStart; j<=iEnd; j++ ) {
					//alert(iStart+", "+iEnd+", "+j+" "+work_smin);
					//alert(j);
					if( j == iStart ) work_hour_arr[j] += (60 - toInt(work_smin));
					else if( j == iEnd ) work_hour_arr[j] += toInt(work_emin);
					else work_hour_arr[j] += 60;
					//alert(j+" : "+work_hour_arr[j]);
				}
				//alert(iStart+", "+iEnd+", "+work_hour_arr[j]);
			}else if( work_ehour < work_shour ){
				var iStart = toInt(work_shour);
				var iEnd = 23;
				for( j=iStart; j<=iEnd; j++ ){
					if( j == iStart ) work_hour_arr[j] += (60 - toInt(work_smin));
					else work_hour_arr[j] += 60;
				}
				iStart = 0;
				iEnd = toInt(work_ehour);
				for( j=iStart; j<=iEnd; j++ ){
					if( j == iEnd ) work_hour_arr[j] += toInt(work_emin);
					else work_hour_arr[j] += 60;
				}
			}else{ // work_ehour == work_shour
				var idx = toInt(work_shour);
				var tmp = toInt(work_emin) - toInt(work_smin);
				if( tmp > 0 ) work_hour_arr[idx] += tmp;
			}
		}
		// 소정근로시간
		//alert(work_hour_arr.length);
		if ( workday_gbn == "01" || workday_gbn == "04" ) { // 근무일, 무급근로
			for( j=0; j < work_hour_arr.length; j++ ) {
				tmp = work_hour_arr[j] - rest_hour_arr[j] - rest2_hour_arr[j]- rest3_hour_arr[j];
				if( tmp > 0 ) workhour_day += tmp;
				//alert(workhour_day);
			}
		}
		//alert(iStart+", "+iEnd+", "+work_hour_arr[j]);
		//alert(workhour_day);
		workhour_day /= 60.0;
		workhour_day /= 5;

		//workhour_day_d = Math.round(workhour_day_d * 10) / 10;

		workhour_day_d = workhour_day_d - workhour_day;
		//workhour_day_d = Number(workhour_day_d).toFixed(1);
		//소수점 둘째자리 반올림
		workhour_day_d = Math.round(workhour_day_d * 10)/10;
		//alert(workhour_day_d);
		//alert(workhour_day_d+" = "+workhour_day_d+" - "+workhour_day);
		//alert(work_hour_arr[j]);

		if(workhour_day_d > 8) f.b_workhour_day_d.style.color = "red";
		else f.b_workhour_day_d.style.color = "#343434";
		f.b_workhour_day_d.value = workhour_day_d;
		f.b_workhour_day_w.value = workhour_day_w;
		f.b_workhour_ext_w.value = workhour_ext_w;
		f.b_workhour_hday_w.value = workhour_hday_w;
		f.b_workhour_night_w.value = workhour_night_w;
	}
}
// 유효성 체크
function isValidWorkTime( work_gbn ){
	var bResult = false;
	var f = document.form1;
	if( f.workday_month.value == "" ){
		return false;
	}
	var workday_week = f.workday_week.value;
	if( workday_week != 5 && workday_week != 6 ){
		return false;
	}
	var exist_workday_gbn_04 = false; // 무급근로 선택여부
	var workday_week_now = 0;
	for( var i=0; i<<?=$work_gbn_count?>; i++ ){ // 7*4
		if( f.work_gbn[i].value == work_gbn ){
			var week_day = f.week_day[i].value; // 요일
			var workday_gbn = f.workday_gbn[i].value; // 근무유형
			var work_shour = f.work_shour[i].value;
			var work_smin = f.work_smin[i].value;
			var work_ehour = f.work_ehour[i].value;
			var work_emin = f.work_emin[i].value;
			//if( workday_gbn != "" && work_shour != "" && work_smin != "" && work_ehour != "" && work_emin != "" ){
				if( workday_week == 5 ){
					if( workday_gbn == "01" ) workday_week_now++;
				}else if( workday_week == 6 ){
					if( workday_gbn == "01" || workday_gbn == "04" ) workday_week_now++;
				}
				if( workday_gbn == "04" ) exist_workday_gbn_04 = true;
			//}
		}
	}
	if( workday_week == workday_week_now ){
		bResult = true;
	}
	if( workday_week == 5 && exist_workday_gbn_04 == true ){ // 무급근로는 6일제만 가능
		bResult = false;
	}
	return bResult;
}
// 확인후 계산
function calWorkTime( work_gbn ){
	initWorkTime(); /////////////////////////////////
	var f = document.form1;
	var checked = false;
	var work_gbn_txt;
	if( work_gbn == "A" ) {
		f.a_checked.checked = true;
		f.b_checked.checked = false;
		checked = f.a_checked.checked;
		work_gbn_txt = "주40시간";
		workday_week_txt = "5";
		document.getElementById("tab_44").style.display = "none";
		document.getElementById("tab_40").style.display = "";
	} else if( work_gbn == "B" ) {
		f.a_checked.checked = false;
		f.b_checked.checked = true;
		checked = f.b_checked.checked;
		work_gbn_txt = "주44시간";
		workday_week_txt = "6";
		document.getElementById("tab_40").style.display = "none";
		document.getElementById("tab_44").style.display = "";
	}
/*
	f.work_gbn_chk.value = work_gbn;
	if( !checked ){
		alert( "["+work_gbn_txt+"] 타입의 근무일을 선택하세요." );
		return;
	}
	if( f.workday_month.value == "" ) {
		alert("주간 근로일을 선택해 주세요.");
		f.workday_month.focus();
		return;
	}
	// 주 5일제, 6일제 근무일 확인
	if( isValidWorkTime( work_gbn ) != true ) {
		alert( "["+work_gbn_txt+"] 타입의 근무일을 주간 근로일("+workday_week_txt+"일근로)로 선택하세요." );
		f.workday_month.focus();
		return;
	}
*/
	//alert(work_gbn);
	setWorkTime( work_gbn );
	selectWorkTime( work_gbn );  /////////////////////////////////
	//alert(f.work_gbn_chk.value);
}
function selectWorkTime(work_gbn) {
	var f = document.form1;
	var workday_month, workday_week, workhour_day_d, workhour_day_w, workhour_ext_w, workhour_hday_w, workhour_night_w;
	workday_month = f.workday_month.value;
	workday_week = f.workday_week.value; // 일반직원 주간 근무일수
	if( work_gbn == "A" ){
		workhour_day_d = f.a_workhour_day_d.value;
		workhour_day_w = f.a_workhour_day_w.value
		workhour_ext_w = f.a_workhour_ext_w.value;
		workhour_hday_w = f.a_workhour_hday_w.value;
		workhour_night_w = f.a_workhour_night_w.value;
	}else if( work_gbn == "B" ){
		workhour_day_d = f.b_workhour_day_d.value;
		workhour_day_w = f.b_workhour_day_w.value
		workhour_ext_w = f.b_workhour_ext_w.value;
		workhour_hday_w = f.b_workhour_hday_w.value;
		workhour_night_w = f.b_workhour_night_w.value;
	}
}
function checkData() {
	var frm = document.form1;
	if (frm.a_checked.checked == false && frm.b_checked.checked == false)
	{
		alert("주40시간 또는 주44시간 근로시간표 중 하나를 선택하세요.");
		frm.a_checked.focus();
		return;
	}
	if(frm.a_checked.checked) {
		frm.work_gbn_chk.value = "A";
		plus = 0;
	} else {
		frm.work_gbn_chk.value = "B";
		plus = 7;
	}
	//저장 전 근로시간 적용하기
	calWorkTime(frm.work_gbn_chk.value);
	for(i=0; i<7; i++) {
		k = i + plus;
		frm['workday_gbn_'+i].value = frm.workday_gbn[k].value;
		frm['work_shour_'+i].value = frm.work_shour[k].value;
		frm['work_smin_'+i].value = frm.work_smin[k].value;
		frm['work_ehour_'+i].value = frm.work_ehour[k].value;
		frm['work_emin_'+i].value = frm.work_emin[k].value;
		frm['rest_shour_'+i].value = frm.rest_shour[k].value;
		frm['rest_smin_'+i].value = frm.rest_smin[k].value;
		frm['rest_ehour_'+i].value = frm.rest_ehour[k].value;
		frm['rest_emin_'+i].value = frm.rest_emin[k].value;
		frm['rest_shour2_'+i].value = frm.rest_shour2[k].value;
		frm['rest_smin2_'+i].value = frm.rest_smin2[k].value;
		frm['rest_ehour2_'+i].value = frm.rest_ehour2[k].value;
		frm['rest_emin2_'+i].value = frm.rest_emin2[k].value;
		frm['rest_shour3_'+i].value = frm.rest_shour3[k].value;
		frm['rest_smin3_'+i].value = frm.rest_smin3[k].value;
		frm['rest_ehour3_'+i].value = frm.rest_ehour3[k].value;
		frm['rest_emin3_'+i].value = frm.rest_emin3[k].value;
		frm['ext_shour_'+i].value = frm.ext_shour[k].value;
		frm['ext_smin_'+i].value = frm.ext_smin[k].value;
		frm['ext_ehour_'+i].value = frm.ext_ehour[k].value;
		frm['ext_emin_'+i].value = frm.ext_emin[k].value;
		frm['night_shour_'+i].value = frm.night_shour[k].value;
		frm['night_smin_'+i].value = frm.night_smin[k].value;
		frm['night_ehour_'+i].value = frm.night_ehour[k].value;
		frm['night_emin_'+i].value = frm.night_emin[k].value;
	}
	//frm.action = "com_code_update.php";
	//alert(frm.b_checked.checked);
	frm.submit();
	return;
}
function tab_view(tab) {
	var obj = document.getElementById(tab);
	if(obj.style.display == "none") {
		obj.style.display = "";
		//alert(tab);
		if(tab == "tab_44") document.getElementById("tab_40").style.display = "none";
		else if(tab == "tab_40") document.getElementById("tab_44").style.display = "none";
	} else {
		obj.style.display = "none";
	}
}
function worktime_sdate_copy(work_gbn) {
	var f = document.form1;
	if( work_gbn == "A" ) {
		work_shour = f.work_shour[0].value;
		work_smin = f.work_smin[0].value;
		//월~금 복사
		for(i=0; i<5; i++) {
			f.work_shour[i].value = work_shour;
			f.work_smin[i].value = work_smin;
		}
	} else if( work_gbn == "B" ) {
		work_shour = f.work_shour[7].value;
		work_smin = f.work_smin[7].value;
		for(i=7; i<12; i++) {
			f.work_shour[i].value = work_shour;
			f.work_smin[i].value = work_smin;
		}
	}
}
function worktime_edate_copy(work_gbn) {
	var f = document.form1;
	if( work_gbn == "A" ) {
		work_ehour = f.work_ehour[0].value;
		work_emin = f.work_emin[0].value;
		//alert(work_ehour);
		//월~금 복사
		for(i=0; i<5; i++) {
			f.work_ehour[i].value = work_ehour;
			f.work_emin[i].value = work_emin;
		}
	} else if( work_gbn == "B" ) {
		work_ehour = f.work_ehour[7].value;
		work_emin = f.work_emin[7].value;
		for(i=7; i<12; i++) {
			f.work_ehour[i].value = work_ehour;
			f.work_emin[i].value = work_emin;
		}
	}
}
function resttime_sdate_copy(work_gbn) {
	var f = document.form1;
	if( work_gbn == "A" ) {
		rest_shour = f.rest_shour[0].value;
		rest_smin = f.rest_smin[0].value;
		//alert(rest_shour);
		//월~금 복사
		for(i=0; i<5; i++) {
			f.rest_shour[i].value = rest_shour;
			f.rest_smin[i].value = rest_smin;
		}
	} else if( work_gbn == "B" ) {
		rest_shour = f.rest_shour[7].value;
		rest_smin = f.rest_smin[7].value;
		for(i=7; i<12; i++) {
			f.rest_shour[i].value = rest_shour;
			f.rest_smin[i].value = rest_smin;
		}
	}
}
function resttime_edate_copy(work_gbn) {
	var f = document.form1;
	if( work_gbn == "A" ) {
		rest_ehour = f.rest_ehour[0].value;
		rest_emin = f.rest_emin[0].value;
		//alert(rest_ehour);
		//월~금 복사
		for(i=0; i<5; i++) {
			f.rest_ehour[i].value = rest_ehour;
			f.rest_emin[i].value = rest_emin;
		}
	} else if( work_gbn == "B" ) {
		rest_ehour = f.rest_ehour[7].value;
		rest_smin = f.rest_smin[7].value;
		for(i=7; i<12; i++) {
			f.rest_ehour[i].value = rest_ehour;
			f.rest_smin[i].value = rest_smin;
		}
	}
}
function resttime_sdate_copy2(work_gbn) {
	var f = document.form1;
	if( work_gbn == "A" ) {
		rest_shour2 = f.rest_shour2[0].value;
		rest_smin2 = f.rest_smin2[0].value;
		for(i=0; i<5; i++) {
			f.rest_shour2[i].value = rest_shour2;
			f.rest_smin2[i].value = rest_smin2;
		}
	} else if( work_gbn == "B" ) {
		rest_shour2 = f.rest_shour2[7].value;
		rest_smin2 = f.rest_smin2[7].value;
		for(i=7; i<12; i++) {
			f.rest_shour2[i].value = rest_shour2;
			f.rest_smin2[i].value = rest_smin2;
		}
	}
}
function resttime_edate_copy2(work_gbn) {
	var f = document.form1;
	if( work_gbn == "A" ) {
		rest_ehour2 = f.rest_ehour2[0].value;
		rest_emin2 = f.rest_emin2[0].value;
		for(i=0; i<5; i++) {
			f.rest_ehour2[i].value = rest_ehour2;
			f.rest_emin2[i].value = rest_emin2;
		}
	} else if( work_gbn == "B" ) {
		rest_ehour2 = f.rest_ehour2[7].value;
		rest_emin2 = f.rest_emin2[7].value;
		for(i=7; i<12; i++) {
			f.rest_ehour2[i].value = rest_ehour2;
			f.rest_emin2[i].value = rest_emin2;
		}
	}
}
function resttime_sdate_copy3(work_gbn) {
	var f = document.form1;
	if( work_gbn == "A" ) {
		rest_shour3 = f.rest_shour3[0].value;
		rest_smin3 = f.rest_smin3[0].value;
		for(i=0; i<5; i++) {
			f.rest_shour3[i].value = rest_shour3;
			f.rest_smin3[i].value = rest_smin3;
		}
	} else if( work_gbn == "B" ) {
		rest_shour3 = f.rest_shour3[7].value;
		rest_smin3 = f.rest_smin3[7].value;
		for(i=7; i<12; i++) {
			f.rest_shour3[i].value = rest_shour3;
			f.rest_smin3[i].value = rest_smin3;
		}
	}
}
function resttime_edate_copy3(work_gbn) {
	var f = document.form1;
	if( work_gbn == "A" ) {
		rest_ehour3 = f.rest_ehour3[0].value;
		rest_emin3 = f.rest_emin3[0].value;
		for(i=0; i<5; i++) {
			f.rest_ehour3[i].value = rest_ehour3;
			f.rest_emin3[i].value = rest_emin3;
		}
	} else if( work_gbn == "B" ) {
		rest_ehour3 = f.rest_ehour3[7].value;
		rest_emin3 = f.rest_emin3[7].value;
		for(i=7; i<12; i++) {
			f.rest_ehour3[i].value = rest_ehour3;
			f.rest_emin3[i].value = rest_emin3;
		}
	}
}
function exttime_sdate_copy(work_gbn) {
	var f = document.form1;
	if( work_gbn == "A" ) {
		ext_shour = f.ext_shour[0].value;
		ext_smin = f.ext_smin[0].value;
		for(i=0; i<5; i++) {
			f.ext_shour[i].value = ext_shour;
			f.ext_smin[i].value = ext_smin;
		}
	} else if( work_gbn == "B" ) {
		ext_shour = f.ext_shour[7].value;
		ext_smin = f.ext_smin[7].value;
		for(i=7; i<12; i++) {
			f.ext_shour[i].value = ext_shour;
			f.ext_smin[i].value = ext_smin;
		}
	}
}
function exttime_edate_copy(work_gbn) {
	var f = document.form1;
	if( work_gbn == "A" ) {
		ext_ehour = f.ext_ehour[0].value;
		ext_emin = f.ext_emin[0].value;
		for(i=0; i<5; i++) {
			f.ext_ehour[i].value = ext_ehour;
			f.ext_emin[i].value = ext_emin;
		}
	} else if( work_gbn == "B" ) {
		ext_ehour = f.ext_ehour[7].value;
		ext_emin = f.ext_emin[7].value;
		for(i=7; i<12; i++) {
			f.ext_ehour[i].value = ext_ehour;
			f.ext_emin[i].value = ext_emin;
		}
	}
}
function nighttime_sdate_copy(work_gbn) {
	var f = document.form1;
	if( work_gbn == "A" ) {
		night_shour = f.night_shour[0].value;
		night_smin = f.night_smin[0].value;
		for(i=0; i<5; i++) {
			f.night_shour[i].value = night_shour;
			f.night_smin[i].value = night_smin;
		}
	} else if( work_gbn == "B" ) {
		night_shour = f.night_shour[7].value;
		night_smin = f.night_smin[7].value;
		for(i=7; i<12; i++) {
			f.night_shour[i].value = night_shour;
			f.night_smin[i].value = night_smin;
		}
	}
}
function nighttime_edate_copy(work_gbn) {
	var f = document.form1;
	if( work_gbn == "A" ) {
		night_ehour = f.night_ehour[0].value;
		night_emin = f.night_emin[0].value;
		for(i=0; i<5; i++) {
			f.night_ehour[i].value = night_ehour;
			f.night_emin[i].value = night_emin;
		}
	} else if( work_gbn == "B" ) {
		night_ehour = f.night_ehour[7].value;
		night_emin = f.night_emin[7].value;
		for(i=7; i<12; i++) {
			f.night_ehour[i].value = night_ehour;
			f.night_emin[i].value = night_emin;
		}
	}
}
function rest_add(work_gbn) {
	if( work_gbn == "A" ) {
		if(document.getElementById('rest_str2').style.display == "") {
			document.getElementById('rest_str3').style.display = "";
			document.getElementById('rest_etr3').style.display = "";
			document.getElementById('rest_del_bt2').style.display = "none";
			document.getElementById('rest_del_bt3').style.display = "";
		} else {
			document.getElementById('rest_str2').style.display = "";
			document.getElementById('rest_etr2').style.display = "";
			document.getElementById('rest_del_bt2').style.display = "";
		}
	} else if( work_gbn == "B" ) {
		if(document.getElementById('rest_str2b').style.display == "") {
			document.getElementById('rest_str3b').style.display = "";
			document.getElementById('rest_etr3b').style.display = "";
			document.getElementById('rest_del_bt2b').style.display = "none";
			document.getElementById('rest_del_bt3b').style.display = "";
		} else {
			document.getElementById('rest_str2b').style.display = "";
			document.getElementById('rest_etr2b').style.display = "";
			document.getElementById('rest_del_bt2b').style.display = "";
		}
	}
}
function rest_del2(work_gbn) {
	if( work_gbn == "A" ) {
		document.getElementById('rest_del_bt2').style.display = "none";
		document.getElementById('rest_str2').style.display = "none";
		document.getElementById('rest_etr2').style.display = "none";
		var f = document.form1;
		for(i=0; i<7; i++) {
			f.rest_shour2[i].value = "";
			f.rest_smin2[i].value = "";
			f.rest_ehour2[i].value = "";
			f.rest_emin2[i].value = "";
		}
	} else if( work_gbn == "B" ) {
		document.getElementById('rest_del_bt2b').style.display = "none";
		document.getElementById('rest_str2b').style.display = "none";
		document.getElementById('rest_etr2b').style.display = "none";
		var f = document.form1;
		for(i=7; i<14; i++) {
			f.rest_shour2[i].value = "";
			f.rest_smin2[i].value = "";
			f.rest_ehour2[i].value = "";
			f.rest_emin2[i].value = "";
		}
	}
}
function rest_del3(work_gbn) {
	if( work_gbn == "A" ) {
		document.getElementById('rest_del_bt3').style.display = "none";
		document.getElementById('rest_str3').style.display = "none";
		document.getElementById('rest_etr3').style.display = "none";
		document.getElementById('rest_del_bt2').style.display = "";
		var f = document.form1;
		for(i=0; i<7; i++) {
			f.rest_shour3[i].value = "";
			f.rest_smin3[i].value = "";
			f.rest_ehour3[i].value = "";
			f.rest_emin3[i].value = "";
		}
	} else if( work_gbn == "B" ) {
		document.getElementById('rest_del_bt3b').style.display = "none";
		document.getElementById('rest_str3b').style.display = "none";
		document.getElementById('rest_etr3b').style.display = "none";
		document.getElementById('rest_del_bt2b').style.display = "";
		var f = document.form1;
		for(i=7; i<14; i++) {
			f.rest_shour3[i].value = "";
			f.rest_smin3[i].value = "";
			f.rest_ehour3[i].value = "";
			f.rest_emin3[i].value = "";
		}
	}
}
function only_number() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		event.returnValue = false;
	}
}
</script>
<body topmargin="8" leftmargin="0">
<form name="form1" method="post" style="margin:0" action="com_paycode_select_work_time_update.php">
<input type="hidden" name="code" value="<?=$code?>">
<input type="hidden" name="work_gbn_chk" value="">
<input type="hidden" name="item" value="<?=$item?>">
<input type="hidden" name="url" value="com_paycode_select_work_time.php">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td style="padding-left:0">
			<!--댑메뉴 -->
			<table border=0 cellspacing=0 cellpadding=0> 
				<tr> 
					<td id="Tab_cust_tab_01_0"> 
						<table border=0 cellpadding=0 cellspacing=0> 
							<tr> 
								<td><img src="./images/g_tab_on_lt.gif"></td> 
								<td background="./images/g_tab_on_bg.gif" class="Sftbutton_white" style='width:80;text-align:center'> 
								<a href="#">사업자정보</a> 
								</td> 
								<td><img src="./images/g_tab_on_rt.gif"></td> 
							</tr> 
						</table> 
					</td> 
					<td width=2></td> 
				</tr> 
			</table>
			<div style="height:2px;font-size:0px" class="bgtr"></div>
			<div style="height:2px;font-size:0px"></div>
			<!--댑메뉴 -->
			<!-- 입력폼 -->
<?
//echo $row_com[upche_div];
if($row_com[upche_div] == 2) $upche_div = "법인";
else $upche_div = "개인";
?>
			<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
				<col width="12%"/>
				<col width=""/>
				<col width="12%"/>
				<col width=""/>
				<col width="12%"/>
				<col width=""/>
				<tr>
					<td class="tdrowk">사업체명</td>
					<td class="tdrow"><?=$row_com[com_name]?></td>
					<td class="tdrowk">사업자구분</td>
					<td class="tdrow"><?=$upche_div?></td>
					<td class="tdrowk">사업자번호</td>
					<td class="tdrow"><?=$row_com[biz_no]?></td>
				</tr>
				<tr>
<!--
					<td class="tdrowk">주간 근로일</td>
					<td class="tdrow">
<?
if($row_com_opt[workday_month] == "20") {
	$sel_workday_month1 = "selected";
	$workday_week = 5;
} else if($row_com_opt[workday_month] == "24") {
	$sel_workday_month2 = "selected";
	$workday_week = 6;
} else {
	$sel_workday_month1 = "selected";
	$workday_week = 5;
}
?>
						<select name="workday_month" class="selectfm" onChange="changeWorkDayMonth()">
							<option value="">선택</option>
							<option value="20" <?=$sel_workday_month1?>>5일근로</option>
							<option value="24" <?=$sel_workday_month2?>>6일근로</option>
						</select>
						<input type="hidden" name="workday_week" value="<?=$workday_week?>">
					</td>
-->
					<td class="tdrowk">업종</td>
					<td class="tdrow" colspan="3"><?=$row_com[upjong]?></td>
					<!--<td class="tdrowk">법인등록번호</td>
					<td class="tdrow"><?=$row_com[bupin_no]?></td>-->
					<td class="tdrowk">저장일시</td>
					<td class="tdrow"><?=$row_work_time[modify_date]?></td>
				</tr>
			</table>
			<input type="hidden" name="workday_month" value="<?=$row_com_opt[workday_month]?>">
			<input type="hidden" name="workday_week" value="<?=$workday_week?>">
			<div style="height:5px;font-size:0px"></div>
			<table border=0 cellspacing=0 cellpadding=0> 
				<tr> 
					<td id="Tab_cust_tab_01_0"> 
						<table border=0 cellpadding=0 cellspacing=0> 
							<tr> 
								<td><img src="./images/g_tab_on_lt.gif"></td> 
								<td background="./images/g_tab_on_bg.gif" class="Sftbutton_white" style='width:80;text-align:center'> 
									<a href="javascript:tab_view('tab_40');">주40시간</a>
								</td> 
								<td><img src="./images/g_tab_on_rt.gif"></td> 
							</tr> 
						</table> 
					</td> 
					<td width=2></td> 
					<td>
						<input type="checkbox" name="a_checked" value="1" <? if($row_work_time[work_gbn] == "A" || !$row_work_time[work_gbn]) echo "checked"; ?> onClick="calWorkTime('A');"> 선택
					</td> 
					<td style="padding-left:10px">
						<!--<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:calWorkTime('A');" target="">근로시간 적용하기</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>-->
					</td>
				</tr> 
			</table>
			<div style="height:2px;font-size:0px" class="bgtr"></div>
			<div style="height:2px;font-size:0px"></div>
<?
if($row_work_time[work_gbn] == "A") {
	$workday_gbn = explode(",",$row_work_time[workday_gbn]);
	$work_shour = explode(",",$row_work_time[work_shour]);
	$work_smin = explode(",",$row_work_time[work_smin]);
	$work_ehour = explode(",",$row_work_time[work_ehour]);
	$work_emin = explode(",",$row_work_time[work_emin]);
	$rest_shour = explode(",",$row_work_time[rest_shour]);
	$rest_smin = explode(",",$row_work_time[rest_smin]);
	$rest_ehour = explode(",",$row_work_time[rest_ehour]);
	$rest_emin = explode(",",$row_work_time[rest_emin]);
	$rest_shour2 = explode(",",$row_work_time[rest_shour2]);
	$rest_smin2 = explode(",",$row_work_time[rest_smin2]);
	$rest_ehour2 = explode(",",$row_work_time[rest_ehour2]);
	$rest_emin2 = explode(",",$row_work_time[rest_emin2]);
	$rest_shour3 = explode(",",$row_work_time[rest_shour3]);
	$rest_smin3 = explode(",",$row_work_time[rest_smin3]);
	$rest_ehour3 = explode(",",$row_work_time[rest_ehour3]);
	$rest_emin3 = explode(",",$row_work_time[rest_emin3]);
	$ext_shour = explode(",",$row_work_time[ext_shour]);
	$ext_smin = explode(",",$row_work_time[ext_smin]);
	$ext_ehour = explode(",",$row_work_time[ext_ehour]);
	$ext_emin = explode(",",$row_work_time[ext_emin]);
	$night_shour = explode(",",$row_work_time[night_shour]);
	$night_smin = explode(",",$row_work_time[night_smin]);
	$night_ehour = explode(",",$row_work_time[night_ehour]);
	$night_emin = explode(",",$row_work_time[night_emin]);
}
//echo $workday_gbn[0];
?>
		<div id="tab_40" style="<? if($row_work_time[work_gbn] != "A" && $row_work_time[work_gbn]) echo "display:none"; ?>">
			<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
				<tr>
					<td class="tdhead_center" colspan="2">요일</td>
					<td class="tdhead_center" width="112">월요일</td>
					<td class="tdhead_center" width="112">화요일</td>
					<td class="tdhead_center" width="112">수요일</td>
					<td class="tdhead_center" width="112">목요일</td>
					<td class="tdhead_center" width="112">금요일</td>
					<td class="tdhead_center" width="112" style="color:blue">토요일</td>
					<td class="tdhead_center" width="112" style="color:red">일요일</td>
				</tr>
				<tr>
					<td class="tdhead_center" style="background:#dddddd" colspan="2">근무유형</td>
					<td class="tdrow">
						<input type="hidden" name="work_gbn" value="A">
						<input type="hidden" name="week_day" value="1">
						<select name="workday_gbn" class="selectfm">
							<option value="01" <? if($workday_gbn[0] == "01" || !$workday_gbn[0]) echo "selected"; ?> >근무일</option>
							<option value="02" <? if($workday_gbn[0] == "02") echo "selected"; ?> >유급휴일</option>
							<option value="03" <? if($workday_gbn[0] == "03") echo "selected"; ?> >무급휴일</option>
							<option value="04" <? if($workday_gbn[0] == "04") echo "selected"; ?> >무급휴무일</option>
						</select>
					</td>
					<td class="tdrow">
						<input type="hidden" name="work_gbn" value="A">
						<input type="hidden" name="week_day" value="2">
						<select name="workday_gbn" class="selectfm">
							<option value="01" <? if($workday_gbn[1] == "01" || !$workday_gbn[1]) echo "selected"; ?> >근무일</option>
							<option value="02" <? if($workday_gbn[1] == "02") echo "selected"; ?> >유급휴일</option>
							<option value="03" <? if($workday_gbn[1] == "03") echo "selected"; ?> >무급휴일</option>
							<option value="04" <? if($workday_gbn[1] == "04") echo "selected"; ?> >무급휴무일</option>
						</select>
					</td>
					<td class="tdrow">
						<input type="hidden" name="work_gbn" value="A">
						<input type="hidden" name="week_day" value="3">
						<select name="workday_gbn" class="selectfm">
							<option value="01" <? if($workday_gbn[2] == "01" || !$workday_gbn[2]) echo "selected"; ?> >근무일</option>
							<option value="02" <? if($workday_gbn[2] == "02") echo "selected"; ?> >유급휴일</option>
							<option value="03" <? if($workday_gbn[2] == "03") echo "selected"; ?> >무급휴일</option>
							<option value="04" <? if($workday_gbn[2] == "04") echo "selected"; ?> >무급휴무일</option>
						</select>
					</td>
					<td class="tdrow">
						<input type="hidden" name="work_gbn" value="A">
						<input type="hidden" name="week_day" value="4">
						<select name="workday_gbn" class="selectfm">
							<option value="01" <? if($workday_gbn[3] == "01" || !$workday_gbn[3]) echo "selected"; ?> >근무일</option>
							<option value="02" <? if($workday_gbn[3] == "02") echo "selected"; ?> >유급휴일</option>
							<option value="03" <? if($workday_gbn[3] == "03") echo "selected"; ?> >무급휴일</option>
							<option value="04" <? if($workday_gbn[3] == "04") echo "selected"; ?> >무급휴무일</option>
						</select>
					</td>
					<td class="tdrow">
						<input type="hidden" name="work_gbn" value="A">
						<input type="hidden" name="week_day" value="5">
						<select name="workday_gbn" class="selectfm">
							<option value="01" <? if($workday_gbn[4] == "01" || !$workday_gbn[4]) echo "selected"; ?> >근무일</option>
							<option value="02" <? if($workday_gbn[4] == "02") echo "selected"; ?> >유급휴일</option>
							<option value="03" <? if($workday_gbn[4] == "03") echo "selected"; ?> >무급휴일</option>
							<option value="04" <? if($workday_gbn[4] == "04") echo "selected"; ?> >무급휴무일</option>
						</select>
					</td>
					<td class="tdrow">
						<input type="hidden" name="work_gbn" value="A">
						<input type="hidden" name="week_day" value="6">
						<select name="workday_gbn" class="selectfm">
							<option value="01" <? if($workday_gbn[5] == "01") echo "selected"; ?> >근무일</option>
							<option value="02" <? if($workday_gbn[5] == "02") echo "selected"; ?> >유급휴일</option>
							<option value="03" <? if($workday_gbn[5] == "03" || !$workday_gbn[5]) echo "selected"; ?> >무급휴일</option>
							<option value="04" <? if($workday_gbn[5] == "04") echo "selected"; ?> >무급휴무일</option>
						</select>
					</td>
					<td class="tdrow">
						<input type="hidden" name="work_gbn" value="A">
						<input type="hidden" name="week_day" value="7">
						<select name="workday_gbn" class="selectfm">
							<option value="01" >근무일</option>
							<option value="02" selected>유급휴일</option>
							<option value="03" >무급휴일</option>
							<option value="04" >무급휴무일</option>
						</select>
					</td>
				</tr>
<?
for($i=0;$i<5;$i++) {
	if($work_shour[$i] == "") $work_shour[$i] = 9;
	if($work_smin[$i] == "") $work_smin[$i] = "0";
	if($work_ehour[$i] == "") $work_ehour[$i] = 18;
	if($work_emin[$i] == "") $work_emin[$i] = "0";
}
//토,일요일
for($i=5;$i<7;$i++) {
	if($work_shour[$i] == "" && $work_smin[$i] == "") $work_shour[$i] = "";
	else $work_smin[$i] = "0";
	if($work_ehour[$i] == "" && $work_emin[$i] == "") $work_ehour[$i] = "";
	else $work_emin[$i] = "0";
}
?>
				<tr>
					<td class="tdhead_center" width="70" rowspan="2">근무시간</td>
					<td class="tdhead_center">시작</td>
<?
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="work_shour" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$work_shour[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="work_smin"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$work_smin[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:worktime_sdate_copy('A');" target="">복사</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<tr>
					<td class="tdhead_center">종료</td>
<?
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="work_ehour" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$work_ehour[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="work_emin"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$work_emin[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:worktime_edate_copy('A');" target="">복사</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<!--휴게시간 주40시간-->
				<tr>
					<td class="tdhead_center" rowspan="2">
						휴게시간
						<table border=0 cellpadding=0 cellspacing=0 style=""><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:rest_add('A');" target="">추가</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
					</td>
					<td class="tdhead_center">시작</td>
<?
for($i=0;$i<5;$i++) {
	if($rest_shour[$i] == "") {
		$rest_shour[$i] = "12";
		$rest_smin[$i] = "0";
	} else {
		if($rest_smin[$i] == "") $rest_smin[$i] = "0";
	}
	if($rest_ehour[$i] == "") {
		$rest_ehour[$i] = "13";
		$rest_emin[$i] = "0";
	} else {
		if($rest_emin[$i] == "") $rest_emin[$i] = "0";
	}
}
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="rest_shour" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_shour[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="rest_smin"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_smin[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:resttime_sdate_copy('A');" target="">복사</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<tr>
					<td class="tdhead_center">종료</td>
<?
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="rest_ehour" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_ehour[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="rest_emin"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_emin[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:resttime_edate_copy('A');" target="">복사</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<!--휴게시간2-->
				<tr id="rest_str2" style="display:none">
					<td class="tdhead_center" rowspan="2">
						휴게시간2
						<table border=0 cellpadding=0 cellspacing=0 style="" id="rest_del_bt2"><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:rest_del2('A');" target="">삭제</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
					</td>
					<td class="tdhead_center">시작</td>
<?
for($i=0;$i<5;$i++) {
	if($rest_shour2[$i] == "") {
		$rest_smin2[$i] = "";
	} else {
		if($rest_smin2[$i] == "") $rest_smin2[$i] = "0";
	}
	if($rest_ehour2[$i] == "") {
		$rest_emin2[$i] = "";
	} else {
		if($rest_emin2[$i] == "") $rest_emin2[$i] = "0";
	}
}
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="rest_shour2" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_shour2[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="rest_smin2"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_smin2[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:resttime_sdate_copy2('A');" target="">복사</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<tr id="rest_etr2" style="display:none">
					<td class="tdhead_center">종료</td>
<?
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="rest_ehour2" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_ehour2[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="rest_emin2"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_emin2[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:resttime_edate_copy2('A');" target="">복사</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<!--휴게시간3-->
				<tr id="rest_str3" style="display:none">
					<td class="tdhead_center" rowspan="2">
						휴게시간3
						<table border=0 cellpadding=0 cellspacing=0 style="" id="rest_del_bt3"><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:rest_del3('A');" target="">삭제</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
					</td>
					<td class="tdhead_center">시작</td>
<?
for($i=0;$i<5;$i++) {
	if($rest_shour3[$i] == "") {
		$rest_smin3[$i] = "";
	} else {
		if($rest_smin3[$i] == "") $rest_smin3[$i] = "0";
	}
	if($rest_ehour3[$i] == "") {
		$rest_emin3[$i] = "";
	} else {
		if($rest_emin3[$i] == "") $rest_emin3[$i] = "0";
	}
}
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="rest_shour3" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_shour3[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="rest_smin3"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_smin3[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:resttime_sdate_copy3('A');" target="">복사</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<tr id="rest_etr3" style="display:none">
					<td class="tdhead_center">종료</td>
<?
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="rest_ehour3" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_ehour3[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="rest_emin3"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_emin3[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:resttime_edate_copy3('A');" target="">복사</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<!--연장근무-->
				<tr>
					<td class="tdhead_center" rowspan="2">연장근무</td>
					<td class="tdhead_center">시작</td>
<?
for($i=0;$i<5;$i++) {
	if($ext_shour[$i] == "") {
		$ext_smin[$i] = "";
	} else {
		if($ext_smin[$i] == "") $ext_smin[$i] = "0";
	}
	if($ext_ehour[$i] == "") {
		$ext_emin[$i] = "";
	} else {
		if($ext_emin[$i] == "") $ext_emin[$i] = "0";
	}
}
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="ext_shour" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$ext_shour[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="ext_smin"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$ext_smin[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:exttime_sdate_copy('A');" target="">복사</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<tr>
					<td class="tdhead_center">종료</td>
<?
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="ext_ehour" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$ext_ehour[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="ext_emin"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$ext_emin[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:exttime_edate_copy('A');" target="">복사</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<!--야간근무-->
				<tr>
					<td class="tdhead_center" rowspan="2">야간근무</td>
					<td class="tdhead_center">시작</td>
<?
for($i=0;$i<5;$i++) {
	if($night_shour[$i] == "") {
		$night_smin[$i] = "";
	} else {
		if($night_smin[$i] == "") $night_smin[$i] = "0";
	}
	if($night_ehour[$i] == "") {
		$night_emin[$i] = "";
	} else {
		if($night_emin[$i] == "") $night_emin[$i] = "0";
	}
}
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="night_shour" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$night_shour[$i]?>" maxlength="2"/> :
						<input name="night_smin"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$night_smin[$i]?>"  maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:nighttime_sdate_copy('A');" target="">복사</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<tr>
					<td class="tdhead_center">종료</td>
<?
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="night_ehour" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$night_ehour[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="night_emin"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$night_emin[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:nighttime_edate_copy('A');" target="">복사</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
			</table>
			<div style="height:2px;font-size:0px"></div>
			<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
				<tr>
					<td class="tdrow_center" rowspan="2"><a href="javascript:calWorkTime('A');"><img src="./images/apply.png" border="0"></a></td>
					<td class="tdhead_center">1일 소정근로시간</td>
					<td class="tdhead_center">1주 소정근로시간</td>
					<td class="tdhead_center">1주 연장근로시간</td>
					<td class="tdhead_center">1주 야간근로시간</td>
					<td class="tdhead_center">1주 휴일근로시간</td>
				</tr>
				<tr>
					<td class="tdrow_center"><input type="text" name="a_workhour_day_d"   style="width:50px;background:bbbbbb;<? if($row_work_time[workhour_day_d] > 8) echo "color:red"; ?>" value="<?=$row_work_time[workhour_day_d]?>" readonly></td>
					<td class="tdrow_center"><input type="text" name="a_workhour_day_w"   style="width:50px;background:bbbbbb;" value="<?=$row_work_time[workhour_day_w]?>" readonly></td>
					<td class="tdrow_center"><input type="text" name="a_workhour_ext_w"   style="width:50px;background:bbbbbb;" value="<?=$row_work_time[workhour_ext_w]?>" readonly></td>
					<td class="tdrow_center"><input type="text" name="a_workhour_night_w" style="width:50px;background:bbbbbb;" value="<?=$row_work_time[workhour_night_w]?>" readonly></td>
					<td class="tdrow_center"><input type="text" name="a_workhour_hday_w"  style="width:50px;background:bbbbbb;" value="<?=$row_work_time[workhour_hday_w]?>" readonly></td>
				</tr>
			</table>
		</div>
		<!--주40시간 end-->

			<div style="height:5px;font-size:0px"></div>
			<table border=0 cellspacing=0 cellpadding=0> 
				<tr> 
					<td id="Tab_cust_tab_01_0"> 
						<table border=0 cellpadding=0 cellspacing=0> 
							<tr> 
								<td><img src="./images/g_tab_on_lt.gif"></td> 
								<td background="./images/g_tab_on_bg.gif" class="Sftbutton_white" style='width:80;text-align:center'> 
									<a href="javascript:tab_view('tab_44');">주44시간</a>
								</td> 
								<td><img src="./images/g_tab_on_rt.gif"></td> 
							</tr> 
						</table> 
					</td> 
					<td width=2></td> 
					<td>
						<input type="checkbox" name="b_checked" value="1" <? if($row_work_time[work_gbn] == "B") echo "checked"; ?> onClick="calWorkTime('B');"> 선택
					</td> 
					<td style="padding-left:10px">
						<!--<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:calWorkTime('B');" target="">근로시간 적용하기</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>-->
					</td>
				</tr> 
			</table>
			<div style="height:2px;font-size:0px" class="bgtr"></div>
			<div style="height:2px;font-size:0px"></div>
<?
if($row_work_time[work_gbn] == "B") {
	$workday_gbn = explode(",",$row_work_time[workday_gbn]);
	$work_shour = explode(",",$row_work_time[work_shour]);
	$work_smin = explode(",",$row_work_time[work_smin]);
	$work_ehour = explode(",",$row_work_time[work_ehour]);
	$work_emin = explode(",",$row_work_time[work_emin]);
	$rest_shour = explode(",",$row_work_time[rest_shour]);
	$rest_smin = explode(",",$row_work_time[rest_smin]);
	$rest_ehour = explode(",",$row_work_time[rest_ehour]);
	$rest_emin = explode(",",$row_work_time[rest_emin]);
	$rest_shour2 = explode(",",$row_work_time[rest_shour2]);
	$rest_smin2 = explode(",",$row_work_time[rest_smin2]);
	$rest_ehour2 = explode(",",$row_work_time[rest_ehour2]);
	$rest_emin2 = explode(",",$row_work_time[rest_emin2]);
	$rest_shour3 = explode(",",$row_work_time[rest_shour3]);
	$rest_smin3 = explode(",",$row_work_time[rest_smin3]);
	$rest_ehour3 = explode(",",$row_work_time[rest_ehour3]);
	$rest_emin3 = explode(",",$row_work_time[rest_emin3]);
	$ext_shour = explode(",",$row_work_time[ext_shour]);
	$ext_smin = explode(",",$row_work_time[ext_smin]);
	$ext_ehour = explode(",",$row_work_time[ext_ehour]);
	$ext_emin = explode(",",$row_work_time[ext_emin]);
	$night_shour = explode(",",$row_work_time[night_shour]);
	$night_smin = explode(",",$row_work_time[night_smin]);
	$night_ehour = explode(",",$row_work_time[night_ehour]);
	$night_emin = explode(",",$row_work_time[night_emin]);
} else {
	//빈 데이터 입력
	$workday_gbn = explode(",",",,,,,,");
	$work_shour = explode(",",",,,,,,");
	$work_smin = explode(",",",,,,,,");
	$work_ehour = explode(",",",,,,,,");
	$work_emin = explode(",",",,,,,,");
	$rest_shour = explode(",",",,,,,,");
	$rest_smin = explode(",",",,,,,,");
	$rest_ehour = explode(",",",,,,,,");
	$rest_emin = explode(",",",,,,,,");
	$rest_shour2 = explode(",",",,,,,,");
	$rest_smin2 = explode(",",",,,,,,");
	$rest_ehour2 = explode(",",",,,,,,");
	$rest_emin2 = explode(",",",,,,,,");
	$rest_shour3 = explode(",",",,,,,,");
	$rest_smin3 = explode(",",",,,,,,");
	$rest_ehour3 = explode(",",",,,,,,");
	$rest_emin3 = explode(",",",,,,,,");
	$ext_shour = explode(",",",,,,,,");
	$ext_smin = explode(",",",,,,,,");
	$ext_ehour = explode(",",",,,,,,");
	$ext_emin = explode(",",",,,,,,");
	$night_shour = explode(",",",,,,,,");
	$night_smin = explode(",",",,,,,,");
	$night_ehour = explode(",",",,,,,,");
	$night_emin = explode(",",",,,,,,");
	$row_work_time[workhour_day_d] = "";
	$row_work_time[workhour_day_w] = "";
	$row_work_time[workhour_ext_w] = "";
	$row_work_time[workhour_hday_w] = "";
	$row_work_time[workhour_night_w] = "";
}
?>
		<div id="tab_44" style="<? if($row_work_time[work_gbn] != "B") echo "display:none"; ?>">
			<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
				<tr>
					<td class="tdhead_center" colspan="2">요일</td>
					<td class="tdhead_center" width="112">월요일</td>
					<td class="tdhead_center" width="112">화요일</td>
					<td class="tdhead_center" width="112">수요일</td>
					<td class="tdhead_center" width="112">목요일</td>
					<td class="tdhead_center" width="112">금요일</td>
					<td class="tdhead_center" width="112" style="color:blue">토요일</td>
					<td class="tdhead_center" width="112" style="color:red">일요일</td>
				</tr>
				<tr>
					<td class="tdhead_center" style="background:#dddddd" colspan="2">근무유형</td>
					<td class="tdrow">
						<input type="hidden" name="work_gbn" value="B">
						<input type="hidden" name="week_day" value="1">
						<select name="workday_gbn" class="selectfm">
							<option value="01" <? if($workday_gbn[0] == "01" || !$workday_gbn[0]) echo "selected"; ?> >근무일</option>
							<option value="02" <? if($workday_gbn[0] == "02") echo "selected"; ?> >유급휴일</option>
							<option value="03" <? if($workday_gbn[0] == "03") echo "selected"; ?> >무급휴일</option>
							<option value="04" <? if($workday_gbn[0] == "04") echo "selected"; ?> >무급휴무일</option>
						</select>
					</td>
					<td class="tdrow">
						<input type="hidden" name="work_gbn" value="B">
						<input type="hidden" name="week_day" value="2">
						<select name="workday_gbn" class="selectfm">
							<option value="01" <? if($workday_gbn[1] == "01" || !$workday_gbn[1]) echo "selected"; ?> >근무일</option>
							<option value="02" <? if($workday_gbn[1] == "02") echo "selected"; ?> >유급휴일</option>
							<option value="03" <? if($workday_gbn[1] == "03") echo "selected"; ?> >무급휴일</option>
							<option value="04" <? if($workday_gbn[1] == "04") echo "selected"; ?> >무급휴무일</option>
						</select>
					</td>
					<td class="tdrow">
						<input type="hidden" name="work_gbn" value="B">
						<input type="hidden" name="week_day" value="3">
						<select name="workday_gbn" class="selectfm">
							<option value="01" <? if($workday_gbn[2] == "01" || !$workday_gbn[2]) echo "selected"; ?> >근무일</option>
							<option value="02" <? if($workday_gbn[2] == "02") echo "selected"; ?> >유급휴일</option>
							<option value="03" <? if($workday_gbn[2] == "03") echo "selected"; ?> >무급휴일</option>
							<option value="04" <? if($workday_gbn[2] == "04") echo "selected"; ?> >무급휴무일</option>
						</select>
					</td>
					<td class="tdrow">
						<input type="hidden" name="work_gbn" value="B">
						<input type="hidden" name="week_day" value="4">
						<select name="workday_gbn" class="selectfm">
							<option value="01" <? if($workday_gbn[3] == "01" || !$workday_gbn[3]) echo "selected"; ?> >근무일</option>
							<option value="02" <? if($workday_gbn[3] == "02") echo "selected"; ?> >유급휴일</option>
							<option value="03" <? if($workday_gbn[3] == "03") echo "selected"; ?> >무급휴일</option>
							<option value="04" <? if($workday_gbn[3] == "04") echo "selected"; ?> >무급휴무일</option>
						</select>
					</td>
					<td class="tdrow">
						<input type="hidden" name="work_gbn" value="B">
						<input type="hidden" name="week_day" value="5">
						<select name="workday_gbn" class="selectfm">
							<option value="01" <? if($workday_gbn[4] == "01" || !$workday_gbn[4]) echo "selected"; ?> >근무일</option>
							<option value="02" <? if($workday_gbn[4] == "02") echo "selected"; ?> >유급휴일</option>
							<option value="03" <? if($workday_gbn[4] == "03") echo "selected"; ?> >무급휴일</option>
							<option value="04" <? if($workday_gbn[4] == "04") echo "selected"; ?> >무급휴무일</option>
						</select>
					</td>
					<td class="tdrow">
						<input type="hidden" name="work_gbn" value="B">
						<input type="hidden" name="week_day" value="6">
						<select name="workday_gbn" class="selectfm">
							<option value="01" <? if($workday_gbn[5] == "01" || !$workday_gbn[5]) echo "selected"; ?> >근무일</option>
							<option value="02" <? if($workday_gbn[5] == "02") echo "selected"; ?> >유급휴일</option>
							<option value="03" <? if($workday_gbn[5] == "03") echo "selected"; ?> >무급휴일</option>
							<option value="04" <? if($workday_gbn[5] == "04") echo "selected"; ?> >무급휴무일</option>
						</select>
					</td>
					<td class="tdrow">
						<input type="hidden" name="work_gbn" value="B">
						<input type="hidden" name="week_day" value="7">
						<select name="workday_gbn" class="selectfm">
							<option value="01" <? if($workday_gbn[6] == "01") echo "selected"; ?> >근무일</option>
							<option value="02" <? if($workday_gbn[6] == "02" || !$workday_gbn[6]) echo "selected"; ?> >유급휴일</option>
							<option value="03" <? if($workday_gbn[6] == "03") echo "selected"; ?> >무급휴일</option>
							<option value="04" <? if($workday_gbn[6] == "04") echo "selected"; ?> >무급휴무일</option>
						</select>
					</td>
				</tr>
<?
for($i=0;$i<5;$i++) {
	if($work_shour[$i] == "") $work_shour[$i] = 9;
	if($work_smin[$i] == "") $work_smin[$i] = "0";
	if($work_ehour[$i] == "") $work_ehour[$i] = 18;
	if($work_emin[$i] == "") $work_emin[$i] = "0";
}
//토요일
for($i=5;$i<6;$i++) {
	if($work_shour[$i] == "" && $work_smin[$i] == "") $work_shour[$i] = "9";
	else $work_smin[$i] = "0";
	if($work_ehour[$i] == "" && $work_emin[$i] == "") $work_ehour[$i] = "13";
	else $work_emin[$i] = "0";
}
?>
				<tr>
					<td class="tdhead_center" width="70" rowspan="2">근무시간</td>
					<td class="tdhead_center">시작</td>
<?
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="work_shour" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$work_shour[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="work_smin"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$work_smin[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:worktime_sdate_copy('B');" target="">복사</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<tr>
					<td class="tdhead_center">종료</td>
<?
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="work_ehour" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$work_ehour[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="work_emin"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$work_emin[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:worktime_edate_copy('B');" target="">복사</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<!--휴게시간 주44시간-->
<?
for($i=0;$i<5;$i++) {
	if($rest_shour[$i] == "") {
		$rest_shour[$i] = "12";
		$rest_smin[$i] = "0";
	} else {
		if($rest_smin[$i] == "") $rest_smin[$i] = "0";
	}
	if($rest_ehour[$i] == "") {
		$rest_ehour[$i] = "13";
		$rest_emin[$i] = "0";
	} else {
		if($rest_emin[$i] == "") $rest_emin[$i] = "0";
	}
}
?>
				<tr>
					<td class="tdhead_center" rowspan="2">
						휴게시간
						<table border=0 cellpadding=0 cellspacing=0 style=""><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:rest_add('B');" target="">추가</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
					</td>
					<td class="tdhead_center">시작</td>
<?
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="rest_shour" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_shour[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="rest_smin"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_smin[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:resttime_sdate_copy('B');" target="">복사</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<tr>
					<td class="tdhead_center">종료</td>
<?
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="rest_ehour" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_ehour[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="rest_emin"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_emin[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:resttime_edate_copy('B');" target="">복사</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<!--휴게시간2-->
<?
for($i=0;$i<5;$i++) {
	if($rest_shour2[$i] == "") {
		$rest_smin2[$i] = "";
	} else {
		if($rest_smin2[$i] == "") $rest_smin2[$i] = "0";
	}
	if($rest_ehour2[$i] == "") {
		$rest_emin2[$i] = "";
	} else {
		if($rest_emin2[$i] == "") $rest_emin2[$i] = "0";
	}
}
?>
				<tr id="rest_str2b" style="<? if($rest_shour2[0] == "") echo "display:none"; ?>">
					<td class="tdhead_center" rowspan="2">
						휴게시간2
						<table border=0 cellpadding=0 cellspacing=0 style="" id="rest_del_bt2b"><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:rest_del2('B');" target="">삭제</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
					</td>
					<td class="tdhead_center">시작</td>
<?
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="rest_shour2" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_shour2[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="rest_smin2"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_smin2[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:resttime_sdate_copy2('B');" target="">복사</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<tr id="rest_etr2b" style="<? if($rest_shour2[0] == "") echo "display:none"; ?>">
					<td class="tdhead_center">종료</td>
<?
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="rest_ehour2" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_ehour2[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="rest_emin2"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_emin2[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:resttime_edate_copy2('B');" target="">복사</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<!--휴게시간3-->
<?
for($i=0;$i<5;$i++) {
	if($rest_shour3[$i] == "") {
		$rest_smin3[$i] = "";
	} else {
		if($rest_smin3[$i] == "") $rest_smin3[$i] = "0";
	}
	if($rest_ehour3[$i] == "") {
		$rest_emin3[$i] = "";
	} else {
		if($rest_emin3[$i] == "") $rest_emin3[$i] = "0";
	}
}
?>
				<tr id="rest_str3b" style="<? if($rest_shour3[0] == "") echo "display:none"; ?>">
					<td class="tdhead_center" rowspan="2">
						휴게시간3
						<table border=0 cellpadding=0 cellspacing=0 style="" id="rest_del_bt3b"><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:rest_del3('B');" target="">삭제</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
					</td>
					<td class="tdhead_center">시작</td>
<?
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="rest_shour3" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_shour3[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="rest_smin3"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_smin3[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:resttime_sdate_copy3('B');" target="">복사</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<tr id="rest_etr3b" style="<? if($rest_shour3[0] == "") echo "display:none"; ?>">
					<td class="tdhead_center">종료</td>
<?
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="rest_ehour3" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_ehour3[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="rest_emin3"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_emin3[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:resttime_edate_copy3('B');" target="">복사</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<!--연장근무-->
<?
for($i=0;$i<5;$i++) {
	if($ext_shour[$i] == "") {
		$ext_smin[$i] = "";
	} else {
		if($ext_smin[$i] == "") $ext_smin[$i] = "0";
	}
	if($ext_ehour[$i] == "") {
		$ext_emin[$i] = "";
	} else {
		if($ext_emin[$i] == "") $ext_emin[$i] = "0";
	}
}
?>
				<tr>
					<td class="tdhead_center" rowspan="2">연장근무</td>
					<td class="tdhead_center">시작</td>
<?
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="ext_shour" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$ext_shour[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="ext_smin"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$ext_smin[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:exttime_sdate_copy('B');" target="">복사</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<tr>
					<td class="tdhead_center">종료</td>
<?
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="ext_ehour" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$ext_ehour[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="ext_emin"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$ext_emin[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:exttime_edate_copy('B');" target="">복사</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<!--야간근무-->
				<tr>
					<td class="tdhead_center" rowspan="2">야간근무</td>
					<td class="tdhead_center">시작</td>
<?
for($i=0;$i<5;$i++) {
	if($night_shour[$i] == "") {
		$night_smin[$i] = "";
	} else {
		if($night_smin[$i] == "") $night_smin[$i] = "0";
	}
	if($night_ehour[$i] == "") {
		$night_emin[$i] = "";
	} else {
		if($night_emin[$i] == "") $night_emin[$i] = "0";
	}
}
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="night_shour" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$night_shour[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="night_smin"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$night_smin[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:nighttime_sdate_copy('B');" target="">복사</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<tr>
					<td class="tdhead_center">종료</td>
<?
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="night_ehour" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$night_ehour[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="night_emin"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$night_emin[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:nighttime_edate_copy('B');" target="">복사</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
			</table>
			<div style="height:2px;font-size:0px"></div>
			<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
				<tr>
					<td class="tdrow_center" rowspan="2"><a href="javascript:calWorkTime('B');"><img src="./images/apply.png" border="0"></a></td>
					<td class="tdhead_center">1일 소정근로시간</td>
					<td class="tdhead_center">1주 소정근로시간</td>
					<td class="tdhead_center">1주 연장근로시간</td>
					<td class="tdhead_center">1주 야간근로시간</td>
					<td class="tdhead_center">1주 휴일근로시간</td>
				</tr>
				<tr>
					<td class="tdrow_center"><input type="text" name="b_workhour_day_d" style="width:50px;background:bbbbbb;" value="<?=$row_work_time[workhour_day_d]?>" readonly></td>
					<td class="tdrow_center"><input type="text" name="b_workhour_day_w" style="width:50px;background:bbbbbb;" value="<?=$row_work_time[workhour_day_w]?>" readonly></td>
					<td class="tdrow_center"><input type="text" name="b_workhour_ext_w" style="width:50px;background:bbbbbb;" value="<?=$row_work_time[workhour_ext_w]?>" readonly></td>
					<td class="tdrow_center"><input type="text" name="b_workhour_night_w" style="width:50px;background:bbbbbb;" value="<?=$row_work_time[workhour_night_w]?>" readonly></td>
					<td class="tdrow_center"><input type="text" name="b_workhour_hday_w" style="width:50px;background:bbbbbb;" value="<?=$row_work_time[workhour_hday_w]?>" readonly></td>
				</tr>
			</table>
		</div>
		<!--주44시간 end-->
			<div style="height:20px;font-size:0px"></div>
			<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
				<tr>
					<td align="center">
						<a href="javascript:checkData()" target=""><img src="./images/btn_save_big.png" border="0"></a>
					</td>
				</tr>
			</table>
			<div style="height:20px;font-size:0px"></div>
			<!--댑메뉴 -->
			<!-- 입력폼 -->
		</td>
	</tr>
</table>
<?
for($i=0;$i<7;$i++) {
?>
<input type="hidden" name="workday_gbn_<?=$i?>">
<input type="hidden" name="work_shour_<?=$i?>">
<input type="hidden" name="work_smin_<?=$i?>">
<input type="hidden" name="work_ehour_<?=$i?>">
<input type="hidden" name="work_emin_<?=$i?>">
<input type="hidden" name="rest_shour_<?=$i?>">
<input type="hidden" name="rest_smin_<?=$i?>">
<input type="hidden" name="rest_ehour_<?=$i?>">
<input type="hidden" name="rest_emin_<?=$i?>">
<input type="hidden" name="rest_shour2_<?=$i?>">
<input type="hidden" name="rest_smin2_<?=$i?>">
<input type="hidden" name="rest_ehour2_<?=$i?>">
<input type="hidden" name="rest_emin2_<?=$i?>">
<input type="hidden" name="rest_shour3_<?=$i?>">
<input type="hidden" name="rest_smin3_<?=$i?>">
<input type="hidden" name="rest_ehour3_<?=$i?>">
<input type="hidden" name="rest_emin3_<?=$i?>">
<input type="hidden" name="ext_shour_<?=$i?>">
<input type="hidden" name="ext_smin_<?=$i?>">
<input type="hidden" name="ext_ehour_<?=$i?>">
<input type="hidden" name="ext_emin_<?=$i?>">
<input type="hidden" name="night_shour_<?=$i?>">
<input type="hidden" name="night_smin_<?=$i?>">
<input type="hidden" name="night_ehour_<?=$i?>">
<input type="hidden" name="night_emin_<?=$i?>">
<?
}
?>
</form>