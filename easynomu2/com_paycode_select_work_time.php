<?
if(!$workday_week) $workday_week = 5;
//���� A,B 7+7 = 14
//���� A,B 7+7+7 = 21
$work_gbn_count = 21;
$work_gbn_chk = "A";
$sql_work_time = " select * from a4_work_time where com_code='$code' and sabun='' and work_gbn = '$work_gbn_chk' ";
//echo $sql_work_time;
$result_work_time = sql_query($sql_work_time);
$row_work_time = mysql_fetch_array($result_work_time);
$work_gbn_text_a = $row_work_time[work_gbn_text];
//�����Է�
$manual_array = explode(",",$row_work_time['manual']);
if($manual_array[0] == "1") $check_manual_day_day = "checked";
if($manual_array[1] == "1") $check_manual_day = "checked";
if($manual_array[2] == "1") $check_manual_ext = "checked";
if($manual_array[3] == "1") $check_manual_night = "checked";
if($manual_array[4] == "1") $check_manual_hday = "checked";
//A�� �ʱ� ǥ��
if(!$tab) $tab = "tab1";
//�߰� �ʵ� ������ (�޿�����)
$sql_common_opt2 = " from com_list_gy_opt2 ";
$sql_search_opt2 = " where com_code='$code' ";
$sql_opt2 = " select *
          $sql_common_opt2
          $sql_search_opt2 ";
$result_opt2 = sql_query($sql_opt2);
$row_opt2 = mysql_fetch_array($result_opt2);
?>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/lang/calendar-ko.js"></script>
<style type="text/css"> 
@import url("./js/jscalendar-1.0/calendar-system.css"); 
</style>
<script language="javascript">
// ����� �ʱ�ȭ
function initWorkTime( work_gbn ){
	/*
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
	*/
	setWorkTime(work_gbn);
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
	if( f.workday_month.value == "" ){ // �ٹ��� Ȯ��
		return;
	}
	if( f.a_checked.checked && isValidWorkTime("A") ){ // ��5����, 6���� Ȯ��
		setWorkTime("A");
	}
	if( f.b_checked.checked && isValidWorkTime("B") ){
		setWorkTime("B");
	}
	if( f.b_checked.checked && isValidWorkTime("C") ){
		setWorkTime("C");
	}
}
function checkWorkGbn( work_gbn, checked ){
	var f = document.form1;
	//if(work_gbn == "A") f.b_checked.checked=false;
	//else if(work_gbn == "B") f.a_checked.checked=false;
}
function setWorkTime( work_gbn ){
	//alert(work_gbn);
	var emp5_gbn = "";
	var f = document.form1;
	var week_day, workday_gbn, work_shour,work_smin,work_ehour,work_emin;
	var ext_shour,ext_smin,ext_ehour,ext_emin,night_shour,night_smin,night_ehour,night_emin;
	var rest_shour,rest_smin,rest_ehour,rest_emin,rest_shour2,rest_smin2,rest_ehour2,rest_emin2,rest_shour3,rest_smin3,rest_ehour3,rest_emin3;
	var workhour_day_d, workhour_day_w, workhour_ext_w, workhour_hday_w, workhour_night_w, workhour_day, workhour_ext, workhour_hday, workhour_night ;
	var work_time, rest_time, rest_time2, rest_time3;
	var workday_week = f.workday_week.value; // �Ϲ����� �ְ� �ٹ��ϼ�
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
			week_day = f.week_day[i].value; // ����
			workday_gbn = f.workday_gbn[i].value; // �ٹ�����
			//alert(i+" "+workday_gbn);
			//�ٹ��ð�
			work_shour = toInt(f.work_shour[i].value);
			work_smin = toInt(f.work_smin[i].value);
			work_ehour = toInt(f.work_ehour[i].value);
			work_emin = toInt(f.work_emin[i].value);
			//�ްԽð�1
			rest_shour = toInt(f.rest_shour[i].value);
			rest_smin = toInt(f.rest_smin[i].value);
			rest_ehour = toInt(f.rest_ehour[i].value);
			rest_emin = toInt(f.rest_emin[i].value);
			//�ްԽð�2
			rest_shour2 = toInt(f.rest_shour2[i].value);
			rest_smin2 = toInt(f.rest_smin2[i].value);
			rest_ehour2 = toInt(f.rest_ehour2[i].value);
			rest_emin2 = toInt(f.rest_emin2[i].value);
			//�ްԽð�3
			rest_shour3 = toInt(f.rest_shour3[i].value);
			rest_smin3 = toInt(f.rest_smin3[i].value);
			rest_ehour3 = toInt(f.rest_ehour3[i].value);
			rest_emin3 = toInt(f.rest_emin3[i].value);
			//����ٹ� �ð�
			ext_shour = toInt(f.ext_shour[i].value);
			ext_smin = toInt(f.ext_smin[i].value);
			ext_ehour = toInt(f.ext_ehour[i].value);
			ext_emin = toInt(f.ext_emin[i].value);
			//�߰��ٹ� �ð�
			night_shour = toInt(f.night_shour[i].value);
			night_smin = toInt(f.night_smin[i].value);
			night_ehour = toInt(f.night_ehour[i].value);
			night_emin = toInt(f.night_emin[i].value);
			//alert(work_shour);
			//null�� 0�� ó��
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
				var work_hour_arr = new Array();  // �þ��ð�(0) ~ �����ð�(23)
				var rest_hour_arr = new Array();  // �ްԽð�����(0) ~ �ްԽð�����(23)
				var rest2_hour_arr = new Array(); // �ްԽð�2����(0) ~ �ްԽð�����(23)
				var rest3_hour_arr = new Array(); // �ްԽð�3����(0) ~ �ްԽð�����(23)
				var ext_hour_arr = new Array();   // ����ٹ��ð�����(0) ~ �ްԽð�����(23)
				var night_hour_arr = new Array(); // �߰��ٹ��ð�����(0) ~ �ްԽð�����(23)
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
				//����ٹ�
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
				//�߰��ٹ�
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
				// �����ٷνð�
				//alert(work_hour_arr.length);
				//if ( workday_gbn == "01" || workday_gbn == "04" ){ // �ٹ���, ���ޱٷ�
				if ( workday_gbn == "01" ){
					for( var j=0; j < work_hour_arr.length; j++ ){
						var tmp = work_hour_arr[j] - rest_hour_arr[j]- rest2_hour_arr[j]- rest3_hour_arr[j];
						if( tmp > 0 ) workhour_day += tmp;
					}
				}
				// ���ϱٷνð�
				if( workday_gbn == "02" || workday_gbn == "03" ){ //��������, ��������
					for( var j=0; j < work_hour_arr.length; j++ ){
						var tmp = work_hour_arr[j] - rest_hour_arr[j]- rest2_hour_arr[j]- rest3_hour_arr[j];
						if( tmp > 0 ) workhour_hday += tmp;
					}
				}
				// �߰��ٷνð�
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
				//����ٷνð�
				if ( workday_gbn == "01" || workday_gbn == "04" ){ // �ٹ���, ���ޱٷ�
					for( var j=0; j < ext_hour_arr.length; j++ ){
						var tmp = ext_hour_arr[j];
						if( tmp > 0 ) workhour_ext += tmp;
					}
				}
				//����� �����޹��� ������ ����ٷνð� �߰�
				if(i == 5) {
					if ( workday_gbn == "04" ){ // �ٹ���, ���ޱٷ�
						for( var j=0; j < ext_hour_arr.length; j++ ){
							var tmp = work_hour_arr[j] - rest_hour_arr[j]- rest2_hour_arr[j]- rest3_hour_arr[j];
							if( tmp > 0 ) workhour_ext += tmp;
						}
					}
				}

				//�߰��ٷνð�
				if ( workday_gbn == "01" || workday_gbn == "04" ){ // �ٹ���, ���ޱٷ�
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
				// ����ٷνð�(workhour_ext), �����ٷνð�
				if( workday_week == 5 ){ // �� 5����, �Ϻ��� ���
					if( workhour_day > 8 ){
						//workhour_ext = workhour_day - 8;
						//workhour_day = 8;
					}else{
						//workhour_ext = 0;
						//workhour_day = workhour_day;
					}
				}else if( workday_week == 6 ){ // �� 6����, �Ϻ��� ��� ����, ��ü �հ�� ���
					//6���� 5�� ����, ��~�ݱ����� ��� 13.12.18
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
	// 1�� ����ٷνð�, �����ٷνð� (6����, ����)
	//C�� workday_week = 5;
	//alert(workday_week);
	if( workday_week == 6 ){ // �� 6���� - �����ٷνð�, ����ٷνð�  ��ü �հ�� ���
		if( work_gbn == "A" ){
			if( workhour_day_w > 40 ){
				workhour_ext_w = workhour_day_w - 40;
				workhour_day_w = 40;
			}else{
				workhour_ext_w = 0;
				//workhour_day_w = workhour_day_w;
			}
		}else if( work_gbn == "B" ){
			if( workhour_day_w >= 40 ){
				workhour_ext_w = workhour_day_w - 40;
				//��40�ð�
				workhour_day_w = 40;
			}else{
				workhour_ext_w = 0;
				//workhour_day_w = workhour_day_w;
			}
		}else if( work_gbn == "C" ){
			if( workhour_day_w >= 44 ){
				workhour_ext_w = workhour_day_w - 44;
				//��44�ð�
				workhour_day_w = 44;
			}else{
				workhour_ext_w = 0;
				//workhour_day_w = workhour_day_w;
			}
		}
	}
	//alert(workhour_day_w);
	// 1�� �����ٷνð�
	if( workday_week > 0 ){
		workhour_day_d = workhour_day_w / workday_week;
		//alert(workhour_day_d+" = "+workhour_day_w+" / "+workday_week);
	}
	//alert(workhour_day_w+" / "+workday_week);
	// 5�ι̸� ����� - �߰��ٷ� �ð� ����. 2013.08.05 �߰�
	if( emp5_gbn == "1" ){ // 5������
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


	for(j=0; j < 24; j++) {
		work_hour_arr[j] = 0;
		rest_hour_arr[j] = 0;
		rest2_hour_arr[j] = 0;
		rest3_hour_arr[j] = 0;
	}

	if( work_gbn == "A" ) {
		//1�� �����ٷνð� �ʰ� ������ ǥ��
		if(workhour_day_d > 8) f.a_workhour_day_d.style.color = "red";
		else f.a_workhour_day_d.style.color = "#343434";
		//f.a_workhour_day_d.value = workhour_day_d;
		//1�� �����ٷνð� ���� ����
		//f.a_workhour_day_d.value = 8;
		if(!f.manual_day_a.checked) f.a_workhour_day_w.value = Math.round(workhour_day_w);
		if(!f.manual_ext_a.checked) f.a_workhour_ext_w.value = workhour_ext_w;
		if(!f.manual_hday_a.checked) f.a_workhour_hday_w.value = workhour_hday_w;
		if(!f.manual_night_a.checked) f.a_workhour_night_w.value = workhour_night_w;

	} else if( work_gbn == "B" ) {
		//�ٹ��ð� ���ʰ� (����� �ٹ��ð� ����)
		i = 12;
		//alert(j);
		workday_gbn = f.workday_gbn[i].value; // �ٹ�����
		work_shour = toInt(f.work_shour[i].value);
		work_smin = toInt(f.work_smin[i].value);
		work_ehour = toInt(f.work_ehour[i].value);
		work_emin = toInt(f.work_emin[i].value);

		//�ٹ��ð� ����
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
		// �����ٷνð�
		//alert(work_hour_arr.length);
		if ( workday_gbn == "01" || workday_gbn == "04" ) { // �ٹ���, ���ޱٷ�
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
		//�Ҽ��� ��°�ڸ� �ݿø�
		workhour_day_d = Math.round(workhour_day_d * 10)/10;
		//alert(workhour_day_d);
		//alert(workhour_day_d+" = "+workhour_day_d+" - "+workhour_day);
		//alert(work_hour_arr[j]);

		//1�� �����ٷνð� �ʰ� ������ ǥ��
		if(workhour_day_d > 8) f.b_workhour_day_d.style.color = "red";
		else f.b_workhour_day_d.style.color = "#343434";
		//f.b_workhour_day_d.value = workhour_day_d;
		//1�� �����ٷνð� ���� ����
<?
//����ȸ�� ���ؿ���, �ֽ�ȸ�� �����ֽ�
if($code == "20149") $b_workhour_day_d = 5;
else if($code == "20630") $b_workhour_day_d = 6;
else $b_workhour_day_d = 8;
?>
		f.b_workhour_day_d.value = <?=$b_workhour_day_d?>;
		if(!f.manual_day_b.checked) f.b_workhour_day_w.value = workhour_day_w;
		if(!f.manual_ext_b.checked) f.b_workhour_ext_w.value = workhour_ext_w;
		if(!f.manual_hday_b.checked) f.b_workhour_hday_w.value = workhour_hday_w;
		if(!f.manual_night_b.checked) f.b_workhour_night_w.value = workhour_night_w;

	} else if( work_gbn == "C" ) {

		//�ٹ��ð� ���ʰ� (����� �ٹ��ð� ����)
		i = 19;
		//alert(j);
		workday_gbn = f.workday_gbn[i].value; // �ٹ�����
		work_shour = toInt(f.work_shour[i].value);
		work_smin = toInt(f.work_smin[i].value);
		work_ehour = toInt(f.work_ehour[i].value);
		work_emin = toInt(f.work_emin[i].value);
		//alert(workday_gbn);

		//�ٹ��ð� ����
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
		// �����ٷνð�
		//alert(work_hour_arr.length);
		if ( workday_gbn == "01" || workday_gbn == "04" ) { // �ٹ���, ���ޱٷ�
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
		//�Ҽ��� ��°�ڸ� �ݿø�
		workhour_day_d = Math.round(workhour_day_d * 10)/10;
		//alert(workhour_day_d);
		//alert(workhour_day_d+" = "+workhour_day_d+" - "+workhour_day);
		//alert(work_hour_arr[j]);

		if(workhour_day_d > 8) f.c_workhour_day_d.style.color = "red";
		else f.c_workhour_day_d.style.color = "#343434";
		//f.c_workhour_day_d.value = workhour_day_d;
		//1�� �����ٷνð� ���� ����
<?
//����ȸ�� ���ؿ���, �ֽ�ȸ�� �����ֽ�
if($code == "20149") $c_workhour_day_d = 5.5;
else if($code == "20630") $c_workhour_day_d = 5;
else $c_workhour_day_d = 8;
?>
		f.c_workhour_day_d.value = <?=$c_workhour_day_d?>;
		if(!f.manual_day_c.checked) f.c_workhour_day_w.value = workhour_day_w;
		if(!f.manual_ext_c.checked) f.c_workhour_ext_w.value = workhour_ext_w;
		if(!f.manual_hday_c.checked) f.c_workhour_hday_w.value = workhour_hday_w;
		if(!f.manual_night_c.checked) f.c_workhour_night_w.value = workhour_night_w;
	}
}
// ��ȿ�� üũ
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
	var exist_workday_gbn_04 = false; // ���ޱٷ� ���ÿ���
	var workday_week_now = 0;
	for( var i=0; i<<?=$work_gbn_count?>; i++ ){ // 7*4
		if( f.work_gbn[i].value == work_gbn ){
			var week_day = f.week_day[i].value; // ����
			var workday_gbn = f.workday_gbn[i].value; // �ٹ�����
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
	if( workday_week == 5 && exist_workday_gbn_04 == true ){ // ���ޱٷδ� 6������ ����
		bResult = false;
	}
	return bResult;
}
// Ȯ���� ���
function calWorkTime( work_gbn ){
	//alert(work_gbn);
	initWorkTime(work_gbn); /////////////////////////////////
	var f = document.form1;
	var checked = false;
	var work_gbn_txt;
	if( work_gbn == "A" ) {
		//f.a_checked.checked = true;
		//f.b_checked.checked = false;
		//checked = f.a_checked.checked;
		work_gbn_txt = "A��";
		workday_week_txt = "5";
		//document.getElementById("tab_44").style.display = "none";
		//document.getElementById("tab_40").style.display = "";
	} else if( work_gbn == "B" ) {
		//f.a_checked.checked = false;
		//f.b_checked.checked = true;
		//checked = f.b_checked.checked;
		work_gbn_txt = "B��";
		workday_week_txt = "5";
		//document.getElementById("tab_40").style.display = "none";
		//document.getElementById("tab_44").style.display = "";
	} else if( work_gbn == "C" ) {
		//f.a_checked.checked = false;
		//f.b_checked.checked = true;
		//checked = f.b_checked.checked;
		work_gbn_txt = "C��";
		workday_week_txt = "6";
		//document.getElementById("tab_40").style.display = "none";
		//document.getElementById("tab_44").style.display = "";
	}
	setWorkTime( work_gbn );
	selectWorkTime( work_gbn );
	//alert(f.work_gbn_chk.value);
}
function selectWorkTime(work_gbn) {
	var f = document.form1;
	var workday_month, workday_week, workhour_day_d, workhour_day_w, workhour_ext_w, workhour_hday_w, workhour_night_w;
	workday_month = f.workday_month.value;
	workday_week = f.workday_week.value; // �Ϲ����� �ְ� �ٹ��ϼ�
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
	//A B ���� ������ �⺻�� ����
	frm.work_gbn_chk.value = "A";
	plus = 0;

	//���� �� �ٷνð� �����ϱ�
	//calWorkTime(frm.work_gbn_chk.value);
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
	plus = 7;
	for(i=0; i<7; i++) {
		k = i + plus;
		frm['b_workday_gbn_'+i].value = frm.workday_gbn[k].value;
		frm['b_work_shour_'+i].value = frm.work_shour[k].value;
		frm['b_work_smin_'+i].value = frm.work_smin[k].value;
		frm['b_work_ehour_'+i].value = frm.work_ehour[k].value;
		frm['b_work_emin_'+i].value = frm.work_emin[k].value;
		frm['b_rest_shour_'+i].value = frm.rest_shour[k].value;
		frm['b_rest_smin_'+i].value = frm.rest_smin[k].value;
		frm['b_rest_ehour_'+i].value = frm.rest_ehour[k].value;
		frm['b_rest_emin_'+i].value = frm.rest_emin[k].value;
		frm['b_rest_shour2_'+i].value = frm.rest_shour2[k].value;
		frm['b_rest_smin2_'+i].value = frm.rest_smin2[k].value;
		frm['b_rest_ehour2_'+i].value = frm.rest_ehour2[k].value;
		frm['b_rest_emin2_'+i].value = frm.rest_emin2[k].value;
		frm['b_rest_shour3_'+i].value = frm.rest_shour3[k].value;
		frm['b_rest_smin3_'+i].value = frm.rest_smin3[k].value;
		frm['b_rest_ehour3_'+i].value = frm.rest_ehour3[k].value;
		frm['b_rest_emin3_'+i].value = frm.rest_emin3[k].value;
		frm['b_ext_shour_'+i].value = frm.ext_shour[k].value;
		frm['b_ext_smin_'+i].value = frm.ext_smin[k].value;
		frm['b_ext_ehour_'+i].value = frm.ext_ehour[k].value;
		frm['b_ext_emin_'+i].value = frm.ext_emin[k].value;
		frm['b_night_shour_'+i].value = frm.night_shour[k].value;
		frm['b_night_smin_'+i].value = frm.night_smin[k].value;
		frm['b_night_ehour_'+i].value = frm.night_ehour[k].value;
		frm['b_night_emin_'+i].value = frm.night_emin[k].value;
	}
	plus = 14;
	for(i=0; i<7; i++) {
		k = i + plus;
		frm['c_workday_gbn_'+i].value = frm.workday_gbn[k].value;
		frm['c_work_shour_'+i].value = frm.work_shour[k].value;
		frm['c_work_smin_'+i].value = frm.work_smin[k].value;
		frm['c_work_ehour_'+i].value = frm.work_ehour[k].value;
		frm['c_work_emin_'+i].value = frm.work_emin[k].value;
		frm['c_rest_shour_'+i].value = frm.rest_shour[k].value;
		frm['c_rest_smin_'+i].value = frm.rest_smin[k].value;
		frm['c_rest_ehour_'+i].value = frm.rest_ehour[k].value;
		frm['c_rest_emin_'+i].value = frm.rest_emin[k].value;
		frm['c_rest_shour2_'+i].value = frm.rest_shour2[k].value;
		frm['c_rest_smin2_'+i].value = frm.rest_smin2[k].value;
		frm['c_rest_ehour2_'+i].value = frm.rest_ehour2[k].value;
		frm['c_rest_emin2_'+i].value = frm.rest_emin2[k].value;
		frm['c_rest_shour3_'+i].value = frm.rest_shour3[k].value;
		frm['c_rest_smin3_'+i].value = frm.rest_smin3[k].value;
		frm['c_rest_ehour3_'+i].value = frm.rest_ehour3[k].value;
		frm['c_rest_emin3_'+i].value = frm.rest_emin3[k].value;
		frm['c_ext_shour_'+i].value = frm.ext_shour[k].value;
		frm['c_ext_smin_'+i].value = frm.ext_smin[k].value;
		frm['c_ext_ehour_'+i].value = frm.ext_ehour[k].value;
		frm['c_ext_emin_'+i].value = frm.ext_emin[k].value;
		frm['c_night_shour_'+i].value = frm.night_shour[k].value;
		frm['c_night_smin_'+i].value = frm.night_smin[k].value;
		frm['c_night_ehour_'+i].value = frm.night_ehour[k].value;
		frm['c_night_emin_'+i].value = frm.night_emin[k].value;
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
		//��~�� ����
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
	} else if( work_gbn == "C" ) {
		work_shour = f.work_shour[14].value;
		work_smin = f.work_smin[14].value;
		for(i=14; i<19; i++) {
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
		//��~�� ����
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
	} else if( work_gbn == "C" ) {
		work_ehour = f.work_ehour[14].value;
		work_emin = f.work_emin[14].value;
		for(i=14; i<19; i++) {
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
		//��~�� ����
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
	} else if( work_gbn == "C" ) {
		rest_shour = f.rest_shour[14].value;
		rest_smin = f.rest_smin[14].value;
		for(i=14; i<19; i++) {
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
		//��~�� ����
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
	} else if( work_gbn == "C" ) {
		rest_ehour = f.rest_ehour[14].value;
		rest_smin = f.rest_smin[14].value;
		for(i=14; i<19; i++) {
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
	} else if( work_gbn == "C" ) {
		rest_shour2 = f.rest_shour2[14].value;
		rest_smin2 = f.rest_smin2[14].value;
		for(i=14; i<19; i++) {
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
	} else if( work_gbn == "C" ) {
		rest_ehour2 = f.rest_ehour2[14].value;
		rest_emin2 = f.rest_emin2[14].value;
		for(i=14; i<19; i++) {
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
	} else if( work_gbn == "C" ) {
		rest_shour3 = f.rest_shour3[14].value;
		rest_smin3 = f.rest_smin3[14].value;
		for(i=14; i<19; i++) {
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
	} else if( work_gbn == "C" ) {
		rest_ehour3 = f.rest_ehour3[14].value;
		rest_emin3 = f.rest_emin3[14].value;
		for(i=14; i<19; i++) {
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
	} else if( work_gbn == "C" ) {
		ext_shour = f.ext_shour[14].value;
		ext_smin = f.ext_smin[14].value;
		for(i=14; i<19; i++) {
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
	} else if( work_gbn == "C" ) {
		ext_ehour = f.ext_ehour[14].value;
		ext_emin = f.ext_emin[14].value;
		for(i=14; i<19; i++) {
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
	} else if( work_gbn == "C" ) {
		night_shour = f.night_shour[14].value;
		night_smin = f.night_smin[14].value;
		for(i=14; i<19; i++) {
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
	} else if( work_gbn == "C" ) {
		night_ehour = f.night_ehour[14].value;
		night_emin = f.night_emin[14].value;
		for(i=14; i<19; i++) {
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
	} else if( work_gbn == "C" ) {
		if(document.getElementById('rest_str2c').style.display == "") {
			document.getElementById('rest_str3c').style.display = "";
			document.getElementById('rest_etr3c').style.display = "";
			document.getElementById('rest_del_bt2c').style.display = "none";
			document.getElementById('rest_del_bt3c').style.display = "";
		} else {
			document.getElementById('rest_str2c').style.display = "";
			document.getElementById('rest_etr2c').style.display = "";
			document.getElementById('rest_del_bt2c').style.display = "";
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
	} else if( work_gbn == "C" ) {
		document.getElementById('rest_del_bt2c').style.display = "none";
		document.getElementById('rest_str2c').style.display = "none";
		document.getElementById('rest_etr2c').style.display = "none";
		var f = document.form1;
		for(i=14; i<21; i++) {
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
	} else if( work_gbn == "C" ) {
		document.getElementById('rest_del_bt3c').style.display = "none";
		document.getElementById('rest_str3c').style.display = "none";
		document.getElementById('rest_etr3c').style.display = "none";
		document.getElementById('rest_del_bt2c').style.display = "";
		var f = document.form1;
		for(i=14; i<21; i++) {
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
//�ٷνð� �����Է� 151001
function check_manual(m_name, abc) {
	var frm = document.form1;
	if(m_name.name == "manual_day_"+abc) {
		if(m_name.checked) {
			frm[abc+'_workhour_day_w'].style.background = "#ffffff";
			frm[abc+'_workhour_day_w'].readOnly = false;
		} else {
			frm[abc+'_workhour_day_w'].style.background = "#bbbbbb;";
			frm[abc+'_workhour_day_w'].readOnly = true;
		}
	} else if(m_name.name == "manual_ext_"+abc) {
		if(m_name.checked) {
			frm[abc+'_workhour_ext_w'].style.background = "#ffffff";
			frm[abc+'_workhour_ext_w'].readOnly = false;
		} else {
			frm[abc+'_workhour_ext_w'].background = "#bbbbbb;";
			frm[abc+'_workhour_ext_w'].readOnly = true;
		}
	} else if(m_name.name == "manual_night_"+abc) {
		if(m_name.checked) {
			frm[abc+'_workhour_night_w'].style.background = "#ffffff";
			frm[abc+'_workhour_night_w'].readOnly = false;
		} else {
			frm[abc+'_workhour_night_w'].background = "#bbbbbb;";
			frm[abc+'_workhour_night_w'].readOnly = true;
		}
	} else if(m_name.name == "manual_hday_"+abc) {
		if(m_name.checked) {
			frm[abc+'_workhour_hday_w'].style.background = "#ffffff";
			frm[abc+'_workhour_hday_w'].readOnly = false;
		} else {
			frm[abc+'_workhour_hday_w'].background = "#bbbbbb;";
			frm[abc+'_workhour_hday_w'].readOnly = true;
		}
	}
}
</script>
<body topmargin="8" leftmargin="0">
<form name="form1" method="post" style="margin:0" action="com_paycode_select_work_time_update.php">
<input type="hidden" name="code" value="<?=$code?>">
<input type="hidden" name="work_gbn_chk" value="">
<input type="hidden" name="item" value="<?=$item?>">
<input type="hidden" name="tab" value="<?=$tab?>">
<input type="hidden" name="url" value="com_paycode_select_work_time.php">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td style="padding-left:0">
			<!--�Ǹ޴� -->
			<table border=0 cellspacing=0 cellpadding=0> 
				<tr> 
					<td id="Tab_cust_tab_01"> 
						<a href="javascript:tab_show('tab1');"><img src="./images/tabA_on.gif" border="0" id="tab_img1"></a>
					</td> 
					<td width=2></td> 
					<td id="Tab_cust_tab_02"> 
						<a href="javascript:tab_show('tab2');"><img src="./images/tabB_off.gif" border="0" id="tab_img2"></a>
					</td>
					<td width=2></td>
					<td id="Tab_cust_tab_03">
						<a href="javascript:tab_show('tab3');"><img src="./images/tabC_off.gif" border="0" id="tab_img3"></a>
					</td>
					<td width=10></td> 
					<td>
						<div id="tab1_text"><input name="work_gbn_text_a" type="text" class="textfm" style="width:180px;" value="" maxlength="50"></div>
						<div id="tab2_text" style="display:none"><input name="work_gbn_text_b" type="text" class="textfm" style="width:180px;" value="" maxlength="50"></div>
						<div id="tab3_text" style="display:none"><input name="work_gbn_text_c" type="text" class="textfm" style="width:180px;" value="" maxlength="50"></div>
					</td>
					<td width=10></td> 
					<td>
						* �⺻����
						<select name="work_gbn_base" class="selectfm">
							<option value="A" <? if($row_opt2[work_gbn_base] == "A" || !$row_opt2[work_gbn_base]) echo "selected"; ?> >A��</option>
							<option value="B" <? if($row_opt2[work_gbn_base] == "B") echo "selected"; ?> >B��</option>
							<option value="C" <? if($row_opt2[work_gbn_base] == "C") echo "selected"; ?> >C��</option>
						</select>
					</td>
				</tr>
			</table>
			<div style="height:2px;font-size:0px" class="bgtr_tab"></div>
			<div style="height:4px;font-size:0px"></div>
			<div id="tab1">

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
					<td class="tdhead_center" colspan="2">����</td>
					<td class="tdhead_center" width="112">������</td>
					<td class="tdhead_center" width="112">ȭ����</td>
					<td class="tdhead_center" width="112">������</td>
					<td class="tdhead_center" width="112">�����</td>
					<td class="tdhead_center" width="112">�ݿ���</td>
					<td class="tdhead_center" width="112" style="color:blue">�����</td>
					<td class="tdhead_center" width="112" style="color:red">�Ͽ���</td>
				</tr>
				<tr>
					<td class="tdhead_center" style="background:#dddddd" colspan="2">�ٹ�����</td>
					<td class="tdrow">
						<input type="hidden" name="work_gbn" value="A">
						<input type="hidden" name="week_day" value="1">
						<select name="workday_gbn" class="selectfm">
							<option value="01" <? if($workday_gbn[0] == "01" || !$workday_gbn[0]) echo "selected"; ?> >�ٹ���</option>
							<option value="02" <? if($workday_gbn[0] == "02") echo "selected"; ?> >��������</option>
							<option value="03" <? if($workday_gbn[0] == "03") echo "selected"; ?> >��������</option>
							<option value="04" <? if($workday_gbn[0] == "04") echo "selected"; ?> >�����޹���</option>
						</select>
					</td>
					<td class="tdrow">
						<input type="hidden" name="work_gbn" value="A">
						<input type="hidden" name="week_day" value="2">
						<select name="workday_gbn" class="selectfm">
							<option value="01" <? if($workday_gbn[1] == "01" || !$workday_gbn[1]) echo "selected"; ?> >�ٹ���</option>
							<option value="02" <? if($workday_gbn[1] == "02") echo "selected"; ?> >��������</option>
							<option value="03" <? if($workday_gbn[1] == "03") echo "selected"; ?> >��������</option>
							<option value="04" <? if($workday_gbn[1] == "04") echo "selected"; ?> >�����޹���</option>
						</select>
					</td>
					<td class="tdrow">
						<input type="hidden" name="work_gbn" value="A">
						<input type="hidden" name="week_day" value="3">
						<select name="workday_gbn" class="selectfm">
							<option value="01" <? if($workday_gbn[2] == "01" || !$workday_gbn[2]) echo "selected"; ?> >�ٹ���</option>
							<option value="02" <? if($workday_gbn[2] == "02") echo "selected"; ?> >��������</option>
							<option value="03" <? if($workday_gbn[2] == "03") echo "selected"; ?> >��������</option>
							<option value="04" <? if($workday_gbn[2] == "04") echo "selected"; ?> >�����޹���</option>
						</select>
					</td>
					<td class="tdrow">
						<input type="hidden" name="work_gbn" value="A">
						<input type="hidden" name="week_day" value="4">
						<select name="workday_gbn" class="selectfm">
							<option value="01" <? if($workday_gbn[3] == "01" || !$workday_gbn[3]) echo "selected"; ?> >�ٹ���</option>
							<option value="02" <? if($workday_gbn[3] == "02") echo "selected"; ?> >��������</option>
							<option value="03" <? if($workday_gbn[3] == "03") echo "selected"; ?> >��������</option>
							<option value="04" <? if($workday_gbn[3] == "04") echo "selected"; ?> >�����޹���</option>
						</select>
					</td>
					<td class="tdrow">
						<input type="hidden" name="work_gbn" value="A">
						<input type="hidden" name="week_day" value="5">
						<select name="workday_gbn" class="selectfm">
							<option value="01" <? if($workday_gbn[4] == "01" || !$workday_gbn[4]) echo "selected"; ?> >�ٹ���</option>
							<option value="02" <? if($workday_gbn[4] == "02") echo "selected"; ?> >��������</option>
							<option value="03" <? if($workday_gbn[4] == "03") echo "selected"; ?> >��������</option>
							<option value="04" <? if($workday_gbn[4] == "04") echo "selected"; ?> >�����޹���</option>
						</select>
					</td>
					<td class="tdrow">
						<input type="hidden" name="work_gbn" value="A">
						<input type="hidden" name="week_day" value="6">
						<select name="workday_gbn" class="selectfm">
							<option value="01" <? if($workday_gbn[5] == "01") echo "selected"; ?> >�ٹ���</option>
							<option value="02" <? if($workday_gbn[5] == "02") echo "selected"; ?> >��������</option>
							<option value="03" <? if($workday_gbn[5] == "03" || !$workday_gbn[5]) echo "selected"; ?> >��������</option>
							<option value="04" <? if($workday_gbn[5] == "04") echo "selected"; ?> >�����޹���</option>
						</select>
					</td>
					<td class="tdrow">
						<input type="hidden" name="work_gbn" value="A">
						<input type="hidden" name="week_day" value="7">
						<select name="workday_gbn" class="selectfm">
							<option value="01" <? if($workday_gbn[6] == "01") echo "selected"; ?> >�ٹ���</option>
							<option value="02" <? if($workday_gbn[6] == "02" || !$workday_gbn[6]) echo "selected"; ?> >��������</option>
							<option value="03" <? if($workday_gbn[6] == "03") echo "selected"; ?> >��������</option>
							<option value="04" <? if($workday_gbn[6] == "04") echo "selected"; ?> >�����޹���</option>
						</select>
					</td>
				</tr>
<?
for($i=0;$i<5;$i++) {
	//�ٹ��� ���� �� �ʱ�ȭ
	if($workday_gbn[$i] == "01" || !$workday_gbn[$i]) {
		if($work_shour[$i] == "") $work_shour[$i] = 9;
		if($work_smin[$i] == "") $work_smin[$i] = "0";
		if($work_ehour[$i] == "") $work_ehour[$i] = 18;
		if($work_emin[$i] == "") $work_emin[$i] = "0";
	}
}
//��,�Ͽ���
for($i=5;$i<7;$i++) {
	//�ð� ������ ���� ��� (�ǹ� ���� if��)
	if($work_shour[$i] == "" && $work_smin[$i] == "") {
		$work_shour[$i] = "";
		$work_smin[$i] = "";
	}
	if($work_ehour[$i] == "" && $work_emin[$i] == "") {
		$work_ehour[$i] = "";
		$work_emin[$i] = "";
	}
}
?>
				<tr>
					<td class="tdhead_center" width="70" rowspan="2">�ٹ��ð�</td>
					<td class="tdhead_center">����</td>
<?
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="work_shour" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$work_shour[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="work_smin"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$work_smin[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:worktime_sdate_copy('A');" target="">����</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<tr>
					<td class="tdhead_center">����</td>
<?
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="work_ehour" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$work_ehour[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="work_emin"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$work_emin[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:worktime_edate_copy('A');" target="">����</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<!--�ްԽð� ��40�ð�-->
				<tr>
					<td class="tdhead_center" rowspan="2">
						�ްԽð�
						<table border=0 cellpadding=0 cellspacing=0 style="" align="center"><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:rest_add('A');" target="">�߰�</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
					</td>
					<td class="tdhead_center">����</td>
<?
for($i=0;$i<5;$i++) {
	//�ٹ��� ���� �� �ʱ�ȭ
	if($workday_gbn[$i] == "01" || !$workday_gbn[$i]) {
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
}
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="rest_shour" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_shour[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="rest_smin"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_smin[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:resttime_sdate_copy('A');" target="">����</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<tr>
					<td class="tdhead_center">����</td>
<?
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="rest_ehour" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_ehour[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="rest_emin"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_emin[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:resttime_edate_copy('A');" target="">����</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<!--�ްԽð�2-->
				<tr id="rest_str2" style="display:none">
					<td class="tdhead_center" rowspan="2">
						�ްԽð�2
						<table border=0 cellpadding=0 cellspacing=0 style="" id="rest_del_bt2" align="center"><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:rest_del2('A');" target="">����</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
					</td>
					<td class="tdhead_center">����</td>
<?
for($i=0;$i<5;$i++) {
	//�ٹ��� ���� �� �ʱ�ȭ
	if($workday_gbn[$i] == "01" || !$workday_gbn[$i]) {
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
}
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="rest_shour2" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_shour2[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="rest_smin2"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_smin2[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:resttime_sdate_copy2('A');" target="">����</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<tr id="rest_etr2" style="display:none">
					<td class="tdhead_center">����</td>
<?
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="rest_ehour2" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_ehour2[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="rest_emin2"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_emin2[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:resttime_edate_copy2('A');" target="">����</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<!--�ްԽð�3-->
				<tr id="rest_str3" style="display:none">
					<td class="tdhead_center" rowspan="2">
						�ްԽð�3
						<table border=0 cellpadding=0 cellspacing=0 style="" id="rest_del_bt3"><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:rest_del3('A');" target="">����</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
					</td>
					<td class="tdhead_center">����</td>
<?
for($i=0;$i<5;$i++) {
	//�ٹ��� ���� �� �ʱ�ȭ
	if($workday_gbn[$i] == "01" || !$workday_gbn[$i]) {
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
}
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="rest_shour3" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_shour3[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="rest_smin3"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_smin3[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:resttime_sdate_copy3('A');" target="">����</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<tr id="rest_etr3" style="display:none">
					<td class="tdhead_center">����</td>
<?
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="rest_ehour3" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_ehour3[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="rest_emin3"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_emin3[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:resttime_edate_copy3('A');" target="">����</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<!--����ٹ�-->
				<tr>
					<td class="tdhead_center" rowspan="2">����ٹ�</td>
					<td class="tdhead_center">����</td>
<?
for($i=0;$i<5;$i++) {
	//�ٹ��� ���� �� �ʱ�ȭ
	if($workday_gbn[$i] == "01" || !$workday_gbn[$i]) {
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
}
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="ext_shour" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$ext_shour[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="ext_smin"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$ext_smin[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:exttime_sdate_copy('A');" target="">����</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<tr>
					<td class="tdhead_center">����</td>
<?
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="ext_ehour" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$ext_ehour[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="ext_emin"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$ext_emin[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:exttime_edate_copy('A');" target="">����</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<!--�߰��ٹ�-->
				<tr>
					<td class="tdhead_center" rowspan="2">�߰��ٹ�</td>
					<td class="tdhead_center">����</td>
<?
for($i=0;$i<5;$i++) {
	//�ٹ��� ���� �� �ʱ�ȭ
	if($workday_gbn[$i] == "01" || !$workday_gbn[$i]) {
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
}
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="night_shour" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$night_shour[$i]?>" maxlength="2"/> :
						<input name="night_smin"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$night_smin[$i]?>"  maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:nighttime_sdate_copy('A');" target="">����</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<tr>
					<td class="tdhead_center">����</td>
<?
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="night_ehour" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$night_ehour[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="night_emin"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$night_emin[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:nighttime_edate_copy('A');" target="">����</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
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
					<td class="tdhead_center">1�� �����ٷνð�</td>
					<td class="tdhead_center">1�� �����ٷνð�</td>
					<td class="tdhead_center">1�� ����ٷνð�</td>
					<td class="tdhead_center">1�� �߰��ٷνð�</td>
					<td class="tdhead_center">1�� ���ϱٷνð�</td>
				</tr>
				<tr>
					<td class="tdrow_center">
						<input type="text" name="a_workhour_day_d" style="width:50px;background:#bbbbbb;<? if($row_work_time['workhour_day_d'] > 8) echo "color:red"; ?>" value="<?=$row_work_time['workhour_day_d']?>" readonly />
					</td>
					<td class="tdrow_center">
						<input type="text" name="a_workhour_day_w" <? if($check_manual_day != "checked") { ?> style="width:50px;background:#bbbbbb;" readonly <? } else { ?> style="width:50px;" <? } ?> value="<?=$row_work_time['workhour_day_w']?>" />
						<input type="checkbox" name="manual_day_a" <?=$check_manual_day?> onclick="check_manual(this, 'a');" value="1" style="vertical-align:middle;" />����
					</td>
					<td class="tdrow_center">
						<input type="text" name="a_workhour_ext_w" <? if($check_manual_ext != "checked") { ?> style="width:50px;background:#bbbbbb;" readonly <? } else { ?> style="width:50px;" <? } ?> value="<?=$row_work_time['workhour_ext_w']?>" />
						<input type="checkbox" name="manual_ext_a" <?=$check_manual_ext?> onclick="check_manual(this, 'a');" value="1" style="vertical-align:middle;" />����
					</td>
					<td class="tdrow_center">
						<input type="text" name="a_workhour_night_w" <? if($check_manual_night != "checked") { ?> style="width:50px;background:#bbbbbb;" readonly <? } else { ?> style="width:50px;" <? } ?> value="<?=$row_work_time['workhour_night_w']?>" />
						<input type="checkbox" name="manual_night_a" <?=$check_manual_night?> onclick="check_manual(this, 'a');" value="1" style="vertical-align:middle;" />����
					</td>
					<td class="tdrow_center">
						<input type="text" name="a_workhour_hday_w" <? if($check_manual_hday != "checked") { ?> style="width:50px;background:#bbbbbb;" readonly <? } else { ?> style="width:50px;" <? } ?> value="<?=$row_work_time['workhour_hday_w']?>" />
						<input type="checkbox" name="manual_hday_a" <?=$check_manual_hday?> onclick="check_manual(this, 'a');" value="1" style="vertical-align:middle;" />����
					</td>
				</tr>
			</table>
		</div>
		<!--��40�ð� end-->
		<script type="text/javascript">
		function rest_add_a() {
			rest_add('A');
		}
		<?
		//echo $rest_shour2[0];
		if($rest_shour2[0] != "") {
		?>
		addLoadEvent(rest_add_a);
		<?
		}
		?>
		</script>
		</div>
		<!--B�� ��-->
		<div id="tab2" style="display:none">
<?
$work_gbn_chk = "B";
$sql_work_time = " select * from a4_work_time where com_code='$code' and sabun='' and work_gbn = '$work_gbn_chk' ";
//echo $sql_work_time;
$result_work_time = sql_query($sql_work_time);
$row_work_time = mysql_fetch_array($result_work_time);
$work_gbn_text_b = $row_work_time[work_gbn_text];
//�����Է�
$manual_array = explode(",",$row_work_time['manual']);
if($manual_array[0] == "1") $check_manual_day_day = "checked";
if($manual_array[1] == "1") $check_manual_day_b = "checked";
if($manual_array[2] == "1") $check_manual_ext_b = "checked";
if($manual_array[3] == "1") $check_manual_night_b = "checked";
if($manual_array[4] == "1") $check_manual_hday_b = "checked";

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
	//�� ������ �Է�
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
		<div id="tab_44" style="<? if($row_work_time[work_gbn] != "B") echo "display:"; ?>">
			<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
				<tr>
					<td class="tdhead_center" colspan="2">����</td>
					<td class="tdhead_center" width="112">������</td>
					<td class="tdhead_center" width="112">ȭ����</td>
					<td class="tdhead_center" width="112">������</td>
					<td class="tdhead_center" width="112">�����</td>
					<td class="tdhead_center" width="112">�ݿ���</td>
					<td class="tdhead_center" width="112" style="color:blue">�����</td>
					<td class="tdhead_center" width="112" style="color:red">�Ͽ���</td>
				</tr>
				<tr>
					<td class="tdhead_center" style="background:#dddddd" colspan="2">�ٹ�����</td>
					<td class="tdrow">
						<input type="hidden" name="work_gbn" value="B">
						<input type="hidden" name="week_day" value="1">
						<select name="workday_gbn" class="selectfm">
							<option value="01" <? if($workday_gbn[0] == "01" || !$workday_gbn[0]) echo "selected"; ?> >�ٹ���</option>
							<option value="02" <? if($workday_gbn[0] == "02") echo "selected"; ?> >��������</option>
							<option value="03" <? if($workday_gbn[0] == "03") echo "selected"; ?> >��������</option>
							<option value="04" <? if($workday_gbn[0] == "04") echo "selected"; ?> >�����޹���</option>
						</select>
					</td>
					<td class="tdrow">
						<input type="hidden" name="work_gbn" value="B">
						<input type="hidden" name="week_day" value="2">
						<select name="workday_gbn" class="selectfm">
							<option value="01" <? if($workday_gbn[1] == "01" || !$workday_gbn[1]) echo "selected"; ?> >�ٹ���</option>
							<option value="02" <? if($workday_gbn[1] == "02") echo "selected"; ?> >��������</option>
							<option value="03" <? if($workday_gbn[1] == "03") echo "selected"; ?> >��������</option>
							<option value="04" <? if($workday_gbn[1] == "04") echo "selected"; ?> >�����޹���</option>
						</select>
					</td>
					<td class="tdrow">
						<input type="hidden" name="work_gbn" value="B">
						<input type="hidden" name="week_day" value="3">
						<select name="workday_gbn" class="selectfm">
							<option value="01" <? if($workday_gbn[2] == "01" || !$workday_gbn[2]) echo "selected"; ?> >�ٹ���</option>
							<option value="02" <? if($workday_gbn[2] == "02") echo "selected"; ?> >��������</option>
							<option value="03" <? if($workday_gbn[2] == "03") echo "selected"; ?> >��������</option>
							<option value="04" <? if($workday_gbn[2] == "04") echo "selected"; ?> >�����޹���</option>
						</select>
					</td>
					<td class="tdrow">
						<input type="hidden" name="work_gbn" value="B">
						<input type="hidden" name="week_day" value="4">
						<select name="workday_gbn" class="selectfm">
							<option value="01" <? if($workday_gbn[3] == "01" || !$workday_gbn[3]) echo "selected"; ?> >�ٹ���</option>
							<option value="02" <? if($workday_gbn[3] == "02") echo "selected"; ?> >��������</option>
							<option value="03" <? if($workday_gbn[3] == "03") echo "selected"; ?> >��������</option>
							<option value="04" <? if($workday_gbn[3] == "04") echo "selected"; ?> >�����޹���</option>
						</select>
					</td>
					<td class="tdrow">
						<input type="hidden" name="work_gbn" value="B">
						<input type="hidden" name="week_day" value="5">
						<select name="workday_gbn" class="selectfm">
							<option value="01" <? if($workday_gbn[4] == "01" || !$workday_gbn[4]) echo "selected"; ?> >�ٹ���</option>
							<option value="02" <? if($workday_gbn[4] == "02") echo "selected"; ?> >��������</option>
							<option value="03" <? if($workday_gbn[4] == "03") echo "selected"; ?> >��������</option>
							<option value="04" <? if($workday_gbn[4] == "04") echo "selected"; ?> >�����޹���</option>
						</select>
					</td>
					<td class="tdrow">
						<input type="hidden" name="work_gbn" value="B">
						<input type="hidden" name="week_day" value="6">
						<select name="workday_gbn" class="selectfm">
							<option value="01" <? if($workday_gbn[5] == "01") echo "selected"; ?> >�ٹ���</option>
							<option value="02" <? if($workday_gbn[5] == "02") echo "selected"; ?> >��������</option>
							<option value="03" <? if($workday_gbn[5] == "03" || !$workday_gbn[5]) echo "selected"; ?> >��������</option>
							<option value="04" <? if($workday_gbn[5] == "04") echo "selected"; ?> >�����޹���</option>
						</select>
					</td>
					<td class="tdrow">
						<input type="hidden" name="work_gbn" value="B">
						<input type="hidden" name="week_day" value="7">
						<select name="workday_gbn" class="selectfm">
							<option value="01" <? if($workday_gbn[6] == "01") echo "selected"; ?> >�ٹ���</option>
							<option value="02" <? if($workday_gbn[6] == "02" || !$workday_gbn[6]) echo "selected"; ?> >��������</option>
							<option value="03" <? if($workday_gbn[6] == "03") echo "selected"; ?> >��������</option>
							<option value="04" <? if($workday_gbn[6] == "04") echo "selected"; ?> >�����޹���</option>
						</select>
					</td>
				</tr>
<?
for($i=0;$i<5;$i++) {
	//�ٹ��� ���� �� �ʱ�ȭ
	if($workday_gbn[$i] == "01" || !$workday_gbn[$i]) {
		if($work_shour[$i] == "") $work_shour[$i] = 9;
		if($work_smin[$i] == "") $work_smin[$i] = "0";
		if($work_ehour[$i] == "") $work_ehour[$i] = 18;
		if($work_emin[$i] == "") $work_emin[$i] = "0";
	}
}
//����� : ��44�ð� ������ �ּ�ó��
/*
for($i=5;$i<6;$i++) {
	if($work_shour[$i] == "" && $work_smin[$i] == "") $work_shour[$i] = "9";
	else $work_smin[$i] = "0";
	if($work_ehour[$i] == "" && $work_emin[$i] == "") $work_ehour[$i] = "13";
	else $work_emin[$i] = "0";
}
*/
?>
				<tr>
					<td class="tdhead_center" width="70" rowspan="2">�ٹ��ð�</td>
					<td class="tdhead_center">����</td>
<?
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="work_shour" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$work_shour[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="work_smin"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$work_smin[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:worktime_sdate_copy('B');" target="">����</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<tr>
					<td class="tdhead_center">����</td>
<?
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="work_ehour" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$work_ehour[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="work_emin"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$work_emin[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:worktime_edate_copy('B');" target="">����</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<!--�ްԽð� ��44�ð�-->
<?
for($i=0;$i<5;$i++) {
	//�ٹ��� ���� �� �ʱ�ȭ
	if($workday_gbn[$i] == "01" || !$workday_gbn[$i]) {
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
}
?>
				<tr>
					<td class="tdhead_center" rowspan="2">
						�ްԽð�
						<table border=0 cellpadding=0 cellspacing=0 style="" align="center"><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:rest_add('B');" target="">�߰�</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
					</td>
					<td class="tdhead_center">����</td>
<?
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="rest_shour" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_shour[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="rest_smin"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_smin[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:resttime_sdate_copy('B');" target="">����</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<tr>
					<td class="tdhead_center">����</td>
<?
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="rest_ehour" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_ehour[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="rest_emin"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_emin[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:resttime_edate_copy('B');" target="">����</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<!--�ްԽð�2-->
<?
for($i=0;$i<5;$i++) {
	//�ٹ��� ���� �� �ʱ�ȭ
	if($workday_gbn[$i] == "01" || !$workday_gbn[$i]) {
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
}
?>
				<tr id="rest_str2b" style="<? if($rest_shour2[0] == "") echo "display:none"; ?>">
					<td class="tdhead_center" rowspan="2">
						�ްԽð�2
						<table border=0 cellpadding=0 cellspacing=0 style="" align="center" id="rest_del_bt2b"><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:rest_del2('B');" target="">����</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
					</td>
					<td class="tdhead_center">����</td>
<?
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="rest_shour2" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_shour2[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="rest_smin2"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_smin2[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:resttime_sdate_copy2('B');" target="">����</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<tr id="rest_etr2b" style="<? if($rest_shour2[0] == "") echo "display:none"; ?>">
					<td class="tdhead_center">����</td>
<?
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="rest_ehour2" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_ehour2[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="rest_emin2"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_emin2[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:resttime_edate_copy2('B');" target="">����</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<!--�ްԽð�3-->
<?
for($i=0;$i<5;$i++) {
	//�ٹ��� ���� �� �ʱ�ȭ
	if($workday_gbn[$i] == "01" || !$workday_gbn[$i]) {
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
}
?>
				<tr id="rest_str3b" style="<? if($rest_shour3[0] == "") echo "display:none"; ?>">
					<td class="tdhead_center" rowspan="2">
						�ްԽð�3
						<table border=0 cellpadding=0 cellspacing=0 style="" align="center" id="rest_del_bt3b"><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:rest_del3('B');" target="">����</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
					</td>
					<td class="tdhead_center">����</td>
<?
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="rest_shour3" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_shour3[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="rest_smin3"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_smin3[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:resttime_sdate_copy3('B');" target="">����</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<tr id="rest_etr3b" style="<? if($rest_shour3[0] == "") echo "display:none"; ?>">
					<td class="tdhead_center">����</td>
<?
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="rest_ehour3" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_ehour3[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="rest_emin3"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_emin3[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:resttime_edate_copy3('B');" target="">����</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<!--����ٹ�-->
<?
for($i=0;$i<5;$i++) {
	//�ٹ��� ���� �� �ʱ�ȭ
	if($workday_gbn[$i] == "01" || !$workday_gbn[$i]) {
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
}
?>
				<tr>
					<td class="tdhead_center" rowspan="2">����ٹ�</td>
					<td class="tdhead_center">����</td>
<?
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="ext_shour" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$ext_shour[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="ext_smin"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$ext_smin[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:exttime_sdate_copy('B');" target="">����</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<tr>
					<td class="tdhead_center">����</td>
<?
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="ext_ehour" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$ext_ehour[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="ext_emin"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$ext_emin[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:exttime_edate_copy('B');" target="">����</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<!--�߰��ٹ�-->
				<tr>
					<td class="tdhead_center" rowspan="2">�߰��ٹ�</td>
					<td class="tdhead_center">����</td>
<?
for($i=0;$i<5;$i++) {
	//�ٹ��� ���� �� �ʱ�ȭ
	if($workday_gbn[$i] == "01" || !$workday_gbn[$i]) {
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
}
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="night_shour" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$night_shour[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="night_smin"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$night_smin[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:nighttime_sdate_copy('B');" target="">����</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<tr>
					<td class="tdhead_center">����</td>
<?
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="night_ehour" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$night_ehour[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="night_emin"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$night_emin[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:nighttime_edate_copy('B');" target="">����</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
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
					<td class="tdhead_center">1�� �����ٷνð�</td>
					<td class="tdhead_center">1�� �����ٷνð�</td>
					<td class="tdhead_center">1�� ����ٷνð�</td>
					<td class="tdhead_center">1�� �߰��ٷνð�</td>
					<td class="tdhead_center">1�� ���ϱٷνð�</td>
				</tr>
				<tr>
					<td class="tdrow_center">
						<input type="text" name="b_workhour_day_d" style="width:50px;background:bbbbbb;" value="<?=$row_work_time['workhour_day_d']?>" readonly />
					</td>
					<td class="tdrow_center">
						<input type="text" name="b_workhour_day_w" <? if($check_manual_day_b != "checked") { ?> style="width:50px;background:#bbbbbb;" readonly <? } else { ?> style="width:50px;" <? } ?> value="<?=$row_work_time['workhour_day_w']?>" />
						<input type="checkbox" name="manual_day_b" <?=$check_manual_day_b?> onclick="check_manual(this, 'b');" value="1" style="vertical-align:middle;" />����
					</td>
					<td class="tdrow_center">
						<input type="text" name="b_workhour_ext_w" <? if($check_manual_ext_b != "checked") { ?> style="width:50px;background:#bbbbbb;" readonly <? } else { ?> style="width:50px;" <? } ?> value="<?=$row_work_time['workhour_ext_w']?>" />
						<input type="checkbox" name="manual_ext_b" <?=$check_manual_ext_b?> onclick="check_manual(this, 'b');" value="1" style="vertical-align:middle;" />����
					</td>
					<td class="tdrow_center">
						<input type="text" name="b_workhour_night_w" <? if($check_manual_night_b != "checked") { ?> style="width:50px;background:#bbbbbb;" readonly <? } else { ?> style="width:50px;" <? } ?> value="<?=$row_work_time['workhour_night_w']?>" />
						<input type="checkbox" name="manual_night_b" <?=$check_manual_night_b?> onclick="check_manual(this, 'b');" value="1" style="vertical-align:middle;" />����
					</td>
					<td class="tdrow_center">
						<input type="text" name="b_workhour_hday_w" <? if($check_manual_hday_b != "checked") { ?> style="width:50px;background:#bbbbbb;" readonly <? } else { ?> style="width:50px;" <? } ?> value="<?=$row_work_time['workhour_hday_w']?>" />
						<input type="checkbox" name="manual_hday_b" <?=$check_manual_hday_b?> onclick="check_manual(this, 'b');" value="1" style="vertical-align:middle;" />����
					</td>
				</tr>
			</table>
		</div>
		<!--��44�ð� end-->
		<script type="text/javascript">
		function rest_add_b() {
			rest_add('B');
		}
		<?
		//echo $rest_shour2[0];
		if($rest_shour2[0] != "") {
		?>
		addLoadEvent(rest_add_b);
		<?
		}
		?>
		</script>
		</div>
		<!--C�� ��-->
		<div id="tab3" style="display:none">
<?
$work_gbn_chk = "C";
$sql_work_time = " select * from a4_work_time where com_code='$code' and sabun='' and work_gbn = '$work_gbn_chk' ";
//echo $sql_work_time;
$result_work_time = sql_query($sql_work_time);
$row_work_time = mysql_fetch_array($result_work_time);
$work_gbn_text_c = $row_work_time[work_gbn_text];
//�����Է�
$manual_array = explode(",",$row_work_time['manual']);
if($manual_array[0] == "1") $check_manual_day_day = "checked";
if($manual_array[1] == "1") $check_manual_day_c = "checked";
if($manual_array[2] == "1") $check_manual_ext_c = "checked";
if($manual_array[3] == "1") $check_manual_night_c = "checked";
if($manual_array[4] == "1") $check_manual_hday_c = "checked";

if($row_work_time[work_gbn] == "C") {
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
	//�� ������ �Է�
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
		<div id="tab_54" style="<? if($row_work_time[work_gbn] != $work_gbn_chk) echo "display:"; ?>">
			<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
				<tr>
					<td class="tdhead_center" colspan="2">����</td>
					<td class="tdhead_center" width="112">������</td>
					<td class="tdhead_center" width="112">ȭ����</td>
					<td class="tdhead_center" width="112">������</td>
					<td class="tdhead_center" width="112">�����</td>
					<td class="tdhead_center" width="112">�ݿ���</td>
					<td class="tdhead_center" width="112" style="color:blue">�����</td>
					<td class="tdhead_center" width="112" style="color:red">�Ͽ���</td>
				</tr>
				<tr>
					<td class="tdhead_center" style="background:#dddddd" colspan="2">�ٹ�����</td>
					<td class="tdrow">
						<input type="hidden" name="work_gbn" value="<?=$work_gbn_chk?>">
						<input type="hidden" name="week_day" value="1">
						<select name="workday_gbn" class="selectfm">
							<option value="01" <? if($workday_gbn[0] == "01" || !$workday_gbn[0]) echo "selected"; ?> >�ٹ���</option>
							<option value="02" <? if($workday_gbn[0] == "02") echo "selected"; ?> >��������</option>
							<option value="03" <? if($workday_gbn[0] == "03") echo "selected"; ?> >��������</option>
							<option value="04" <? if($workday_gbn[0] == "04") echo "selected"; ?> >�����޹���</option>
						</select>
					</td>
					<td class="tdrow">
						<input type="hidden" name="work_gbn" value="<?=$work_gbn_chk?>">
						<input type="hidden" name="week_day" value="2">
						<select name="workday_gbn" class="selectfm">
							<option value="01" <? if($workday_gbn[1] == "01" || !$workday_gbn[1]) echo "selected"; ?> >�ٹ���</option>
							<option value="02" <? if($workday_gbn[1] == "02") echo "selected"; ?> >��������</option>
							<option value="03" <? if($workday_gbn[1] == "03") echo "selected"; ?> >��������</option>
							<option value="04" <? if($workday_gbn[1] == "04") echo "selected"; ?> >�����޹���</option>
						</select>
					</td>
					<td class="tdrow">
						<input type="hidden" name="work_gbn" value="<?=$work_gbn_chk?>">
						<input type="hidden" name="week_day" value="3">
						<select name="workday_gbn" class="selectfm">
							<option value="01" <? if($workday_gbn[2] == "01" || !$workday_gbn[2]) echo "selected"; ?> >�ٹ���</option>
							<option value="02" <? if($workday_gbn[2] == "02") echo "selected"; ?> >��������</option>
							<option value="03" <? if($workday_gbn[2] == "03") echo "selected"; ?> >��������</option>
							<option value="04" <? if($workday_gbn[2] == "04") echo "selected"; ?> >�����޹���</option>
						</select>
					</td>
					<td class="tdrow">
						<input type="hidden" name="work_gbn" value="<?=$work_gbn_chk?>">
						<input type="hidden" name="week_day" value="4">
						<select name="workday_gbn" class="selectfm">
							<option value="01" <? if($workday_gbn[3] == "01" || !$workday_gbn[3]) echo "selected"; ?> >�ٹ���</option>
							<option value="02" <? if($workday_gbn[3] == "02") echo "selected"; ?> >��������</option>
							<option value="03" <? if($workday_gbn[3] == "03") echo "selected"; ?> >��������</option>
							<option value="04" <? if($workday_gbn[3] == "04") echo "selected"; ?> >�����޹���</option>
						</select>
					</td>
					<td class="tdrow">
						<input type="hidden" name="work_gbn" value="<?=$work_gbn_chk?>">
						<input type="hidden" name="week_day" value="5">
						<select name="workday_gbn" class="selectfm">
							<option value="01" <? if($workday_gbn[4] == "01" || !$workday_gbn[4]) echo "selected"; ?> >�ٹ���</option>
							<option value="02" <? if($workday_gbn[4] == "02") echo "selected"; ?> >��������</option>
							<option value="03" <? if($workday_gbn[4] == "03") echo "selected"; ?> >��������</option>
							<option value="04" <? if($workday_gbn[4] == "04") echo "selected"; ?> >�����޹���</option>
						</select>
					</td>
					<td class="tdrow">
						<input type="hidden" name="work_gbn" value="<?=$work_gbn_chk?>">
						<input type="hidden" name="week_day" value="6">
						<select name="workday_gbn" class="selectfm">
							<option value="01" <? if($workday_gbn[5] == "01" || !$workday_gbn[5]) echo "selected"; ?> >�ٹ���</option>
							<option value="02" <? if($workday_gbn[5] == "02") echo "selected"; ?> >��������</option>
							<option value="03" <? if($workday_gbn[5] == "03") echo "selected"; ?> >��������</option>
							<option value="04" <? if($workday_gbn[5] == "04") echo "selected"; ?> >�����޹���</option>
						</select>
					</td>
					<td class="tdrow">
						<input type="hidden" name="work_gbn" value="<?=$work_gbn_chk?>">
						<input type="hidden" name="week_day" value="7">
						<select name="workday_gbn" class="selectfm">
							<option value="01" <? if($workday_gbn[6] == "01") echo "selected"; ?> >�ٹ���</option>
							<option value="02" <? if($workday_gbn[6] == "02" || !$workday_gbn[6]) echo "selected"; ?> >��������</option>
							<option value="03" <? if($workday_gbn[6] == "03") echo "selected"; ?> >��������</option>
							<option value="04" <? if($workday_gbn[6] == "04") echo "selected"; ?> >�����޹���</option>
						</select>
					</td>
				</tr>
<?
for($i=0;$i<5;$i++) {
	//�ٹ��� ���� �� �ʱ�ȭ
	if($workday_gbn[$i] == "01" || !$workday_gbn[$i]) {
		if($work_shour[$i] == "") $work_shour[$i] = 9;
		if($work_smin[$i] == "") $work_smin[$i] = "0";
		if($work_ehour[$i] == "") $work_ehour[$i] = 18;
		if($work_emin[$i] == "") $work_emin[$i] = "0";
	}
}
//����� : C�� ����� �ٹ�
if($workday_gbn[5] == "01" || !$workday_gbn[5]) {
	for($i=5;$i<6;$i++) {
		if($work_shour[$i] == "" && $work_smin[$i] == "") $work_shour[$i] = "9";
		else $work_smin[$i] = "0";
		if($work_ehour[$i] == "" && $work_emin[$i] == "") $work_ehour[$i] = "13";
		else $work_emin[$i] = "0";
	}
}
?>
				<tr>
					<td class="tdhead_center" width="70" rowspan="2">�ٹ��ð�</td>
					<td class="tdhead_center">����</td>
<?
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="work_shour" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$work_shour[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="work_smin"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$work_smin[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:worktime_sdate_copy('<?=$work_gbn_chk?>');" target="">����</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<tr>
					<td class="tdhead_center">����</td>
<?
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="work_ehour" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$work_ehour[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="work_emin"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$work_emin[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:worktime_edate_copy('<?=$work_gbn_chk?>');" target="">����</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<!--�ްԽð� ��44�ð�-->
<?
for($i=0;$i<5;$i++) {
	//�ٹ��� ���� �� �ʱ�ȭ
	if($workday_gbn[$i] == "01" || !$workday_gbn[$i]) {
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
}
?>
				<tr>
					<td class="tdhead_center" rowspan="2">
						�ްԽð�
						<table border=0 cellpadding=0 cellspacing=0 style="" align="center"><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:rest_add('<?=$work_gbn_chk?>');" target="">�߰�</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
					</td>
					<td class="tdhead_center">����</td>
<?
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="rest_shour" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_shour[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="rest_smin"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_smin[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:resttime_sdate_copy('<?=$work_gbn_chk?>');" target="">����</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<tr>
					<td class="tdhead_center">����</td>
<?
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="rest_ehour" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_ehour[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="rest_emin"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_emin[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:resttime_edate_copy('<?=$work_gbn_chk?>');" target="">����</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<!--�ްԽð�2-->
<?
for($i=0;$i<5;$i++) {
	//�ٹ��� ���� �� �ʱ�ȭ
	if($workday_gbn[$i] == "01" || !$workday_gbn[$i]) {
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
}
?>
				<tr id="rest_str2c" style="<? if($rest_shour2[0] == "") echo "display:none"; ?>">
					<td class="tdhead_center" rowspan="2">
						�ްԽð�2
						<table border=0 cellpadding=0 cellspacing=0 style="" align="center" id="rest_del_bt2c"><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:rest_del2('<?=$work_gbn_chk?>');" target="">����</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
					</td>
					<td class="tdhead_center">����</td>
<?
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="rest_shour2" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_shour2[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="rest_smin2"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_smin2[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:resttime_sdate_copy2('<?=$work_gbn_chk?>');" target="">����</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<tr id="rest_etr2c" style="<? if($rest_shour2[0] == "") echo "display:none"; ?>">
					<td class="tdhead_center">����</td>
<?
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="rest_ehour2" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_ehour2[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="rest_emin2"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_emin2[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:resttime_edate_copy2('<?=$work_gbn_chk?>');" target="">����</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<!--�ްԽð�3-->
<?
for($i=0;$i<5;$i++) {
	//�ٹ��� ���� �� �ʱ�ȭ
	if($workday_gbn[$i] == "01" || !$workday_gbn[$i]) {
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
}
?>
				<tr id="rest_str3c" style="<? if($rest_shour3[0] == "") echo "display:none"; ?>">
					<td class="tdhead_center" rowspan="2">
						�ްԽð�3
						<table border=0 cellpadding=0 cellspacing=0 style="" align="center" id="rest_del_bt3c"><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:rest_del3('<?=$work_gbn_chk?>');" target="">����</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
					</td>
					<td class="tdhead_center">����</td>
<?
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="rest_shour3" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_shour3[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="rest_smin3"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_smin3[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:resttime_sdate_copy3('<?=$work_gbn_chk?>');" target="">����</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<tr id="rest_etr3c" style="<? if($rest_shour3[0] == "") echo "display:none"; ?>">
					<td class="tdhead_center">����</td>
<?
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="rest_ehour3" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_ehour3[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="rest_emin3"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$rest_emin3[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:resttime_edate_copy3('<?=$work_gbn_chk?>');" target="">����</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<!--����ٹ�-->
<?
for($i=0;$i<5;$i++) {
	//�ٹ��� ���� �� �ʱ�ȭ
	if($workday_gbn[$i] == "01" || !$workday_gbn[$i]) {
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
}
?>
				<tr>
					<td class="tdhead_center" rowspan="2">����ٹ�</td>
					<td class="tdhead_center">����</td>
<?
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="ext_shour" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$ext_shour[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="ext_smin"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$ext_smin[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:exttime_sdate_copy('<?=$work_gbn_chk?>');" target="">����</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<tr>
					<td class="tdhead_center">����</td>
<?
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="ext_ehour" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$ext_ehour[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="ext_emin"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$ext_emin[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:exttime_edate_copy('<?=$work_gbn_chk?>');" target="">����</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<!--�߰��ٹ�-->
				<tr>
					<td class="tdhead_center" rowspan="2">�߰��ٹ�</td>
					<td class="tdhead_center">����</td>
<?
for($i=0;$i<5;$i++) {
	//�ٹ��� ���� �� �ʱ�ȭ
	if($workday_gbn[$i] == "01" || !$workday_gbn[$i]) {
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
}
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="night_shour" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$night_shour[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="night_smin"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$night_smin[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:nighttime_sdate_copy('<?=$work_gbn_chk?>');" target="">����</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
					</td>
<?
}
?>
				</tr>
				<tr>
					<td class="tdhead_center">����</td>
<?
for($i=0;$i<7;$i++) {
?>
					<td class="tdrow">
						<input name="night_ehour" class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$night_ehour[$i]?>" onkeypress="only_number()" maxlength="2"/> :
						<input name="night_emin"  class="textfm" style="width:25px;ime-mode:disabled;" value="<?=$night_emin[$i]?>"  onkeypress="only_number()" maxlength="2"/>
<?
if($i == 0) {
?>
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=./images/btn1_lt.gif></td><td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:nighttime_edate_copy('<?=$work_gbn_chk?>');" target="">����</a></td><td><img src=./images/btn1_rt.gif></td><td width=2></td></tr></table>
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
					<td class="tdrow_center" rowspan="2"><a href="javascript:calWorkTime('<?=$work_gbn_chk?>');"><img src="./images/apply.png" border="0"></a></td>
					<td class="tdhead_center">1�� �����ٷνð�</td>
					<td class="tdhead_center">1�� �����ٷνð�</td>
					<td class="tdhead_center">1�� ����ٷνð�</td>
					<td class="tdhead_center">1�� �߰��ٷνð�</td>
					<td class="tdhead_center">1�� ���ϱٷνð�</td>
				</tr>
				<tr>
					<td class="tdrow_center">
						<input type="text" name="c_workhour_day_d" style="width:50px;background:#bbbbbb;" value="<?=$row_work_time['workhour_day_d']?>" readonly />
					</td>
					<td class="tdrow_center">
						<input type="text" name="c_workhour_day_w" <? if($check_manual_day_c != "checked") { ?> style="width:50px;background:#bbbbbb;" readonly <? } else { ?> style="width:50px;" <? } ?> value="<?=$row_work_time['workhour_day_w']?>" />
						<input type="checkbox" name="manual_day_c" <?=$check_manual_day_c?> onclick="check_manual(this, 'c');" value="1" style="vertical-align:middle;" />����
					</td>
					<td class="tdrow_center">
						<input type="text" name="c_workhour_ext_w" <? if($check_manual_ext_c != "checked") { ?> style="width:50px;background:#bbbbbb;" readonly <? } else { ?> style="width:50px;" <? } ?> value="<?=$row_work_time['workhour_ext_w']?>" />
						<input type="checkbox" name="manual_ext_c" <?=$check_manual_ext_c?> onclick="check_manual(this, 'c');" value="1" style="vertical-align:middle;" />����
					</td>
					<td class="tdrow_center">
						<input type="text" name="c_workhour_night_w" <? if($check_manual_night_c != "checked") { ?> style="width:50px;background:#bbbbbb;" readonly <? } else { ?> style="width:50px;" <? } ?> value="<?=$row_work_time['workhour_night_w']?>" />
						<input type="checkbox" name="manual_night_c" <?=$check_manual_night_c?> onclick="check_manual(this, 'c');" value="1" style="vertical-align:middle;" />����
					</td>
					<td class="tdrow_center">
						<input type="text" name="c_workhour_hday_w" <? if($check_manual_hday_c != "checked") { ?> style="width:50px;background:#bbbbbb;" readonly <? } else { ?> style="width:50px;" <? } ?> value="<?=$row_work_time['workhour_hday_w']?>" />
						<input type="checkbox" name="manual_hday_c" <?=$check_manual_hday_c?> onclick="check_manual(this, 'c');" value="1" style="vertical-align:middle;" />����
					</td>
				</tr>
			</table>
		</div>
		<!--��44�ð� end-->
		<script type="text/javascript">
		function rest_add_c() {
			rest_add('C');
		}
		<?
		//echo $rest_shour2[0];
		if($rest_shour2[0] != "") {
		?>
		addLoadEvent(rest_add_c);
		<?
		}
		?>
		</script>
		</div>
<?
//���Ѻ� ��ũ��
if($member['mb_level'] == 6) {
	$url_save = "javascript:alert_demo();";
} else {
	$url_save = "javascript:checkData();";
}
?>
			<div style="height:20px;font-size:0px"></div>
			<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
				<tr>
					<td align="center">
						<a href="<?=$url_save?>" target=""><img src="./images/btn_save_big.png" border="0"></a>
					</td>
				</tr>
			</table>
			<div style="height:5px;font-size:0px"></div>

			<!--��޴� -->
			<table border=0 cellspacing=0 cellpadding=0> 
				<tr> 
					<td id="Tab_cust_tab_01_0"> 
						<table border=0 cellpadding=0 cellspacing=0> 
							<tr> 
								<td><img src="./images/g_tab_on_lt.gif"></td> 
								<td background="./images/g_tab_on_bg.gif" class="Sftbutton_white" style='width:80;text-align:center'> 
								<a href="#">���� ���</a> 
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
<?
//echo $row_com[upche_div];
if($row_com[upche_div] == 2) $upche_div = "����";
else $upche_div = "����";
?>
			<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="font-size:15px">
				<col width="20%"/>
				<col width=""/>
				<tr>
					<td class="tdrowk">�ְ��ٹ��ð� ����</td>
					<td class="tdrow">��ü�� �����ٷνð��� ���� A~C���� �����մϴ�.</td>
				</tr>
				<tr>
					<td class="tdrowk">�ٹ�����</td>
					<td class="tdrow">�ٹ��� : �����ٷ���<br>
					�������� : ���� �ٹ��� ���ϱٷμ��� ����(�⺻ ����ó��)<br>
					�����޹��� : �޹��� �ٹ��� ����ٷμ��� ����(�⺻ ����ó��)<br>
					�������� : ���� �ٹ��� ���ϱٷμ��� ����(�⺻ ����ó��)
					</td>
				</tr>
			</table>
			<input type="hidden" name="workday_month" value="<?=$row_com_opt[workday_month]?>">
			<input type="hidden" name="workday_week" value="<?=$workday_week?>">
			<div style="height:5px;font-size:0px"></div>

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
for($i=0;$i<7;$i++) {
?>
<input type="hidden" name="b_workday_gbn_<?=$i?>">
<input type="hidden" name="b_work_shour_<?=$i?>">
<input type="hidden" name="b_work_smin_<?=$i?>">
<input type="hidden" name="b_work_ehour_<?=$i?>">
<input type="hidden" name="b_work_emin_<?=$i?>">
<input type="hidden" name="b_rest_shour_<?=$i?>">
<input type="hidden" name="b_rest_smin_<?=$i?>">
<input type="hidden" name="b_rest_ehour_<?=$i?>">
<input type="hidden" name="b_rest_emin_<?=$i?>">
<input type="hidden" name="b_rest_shour2_<?=$i?>">
<input type="hidden" name="b_rest_smin2_<?=$i?>">
<input type="hidden" name="b_rest_ehour2_<?=$i?>">
<input type="hidden" name="b_rest_emin2_<?=$i?>">
<input type="hidden" name="b_rest_shour3_<?=$i?>">
<input type="hidden" name="b_rest_smin3_<?=$i?>">
<input type="hidden" name="b_rest_ehour3_<?=$i?>">
<input type="hidden" name="b_rest_emin3_<?=$i?>">
<input type="hidden" name="b_ext_shour_<?=$i?>">
<input type="hidden" name="b_ext_smin_<?=$i?>">
<input type="hidden" name="b_ext_ehour_<?=$i?>">
<input type="hidden" name="b_ext_emin_<?=$i?>">
<input type="hidden" name="b_night_shour_<?=$i?>">
<input type="hidden" name="b_night_smin_<?=$i?>">
<input type="hidden" name="b_night_ehour_<?=$i?>">
<input type="hidden" name="b_night_emin_<?=$i?>">
<?
}
//C��
for($i=0;$i<7;$i++) {
?>
<input type="hidden" name="c_workday_gbn_<?=$i?>">
<input type="hidden" name="c_work_shour_<?=$i?>">
<input type="hidden" name="c_work_smin_<?=$i?>">
<input type="hidden" name="c_work_ehour_<?=$i?>">
<input type="hidden" name="c_work_emin_<?=$i?>">
<input type="hidden" name="c_rest_shour_<?=$i?>">
<input type="hidden" name="c_rest_smin_<?=$i?>">
<input type="hidden" name="c_rest_ehour_<?=$i?>">
<input type="hidden" name="c_rest_emin_<?=$i?>">
<input type="hidden" name="c_rest_shour2_<?=$i?>">
<input type="hidden" name="c_rest_smin2_<?=$i?>">
<input type="hidden" name="c_rest_ehour2_<?=$i?>">
<input type="hidden" name="c_rest_emin2_<?=$i?>">
<input type="hidden" name="c_rest_shour3_<?=$i?>">
<input type="hidden" name="c_rest_smin3_<?=$i?>">
<input type="hidden" name="c_rest_ehour3_<?=$i?>">
<input type="hidden" name="c_rest_emin3_<?=$i?>">
<input type="hidden" name="c_ext_shour_<?=$i?>">
<input type="hidden" name="c_ext_smin_<?=$i?>">
<input type="hidden" name="c_ext_ehour_<?=$i?>">
<input type="hidden" name="c_ext_emin_<?=$i?>">
<input type="hidden" name="c_night_shour_<?=$i?>">
<input type="hidden" name="c_night_smin_<?=$i?>">
<input type="hidden" name="c_night_ehour_<?=$i?>">
<input type="hidden" name="c_night_emin_<?=$i?>">
<?
}
?>
</form>
<script language="javascript" type="text/javascript">
function tab_text_int() {
	var frm = document.form1;
	frm.work_gbn_text_a.value = "<?=$work_gbn_text_a?>";
	frm.work_gbn_text_b.value = "<?=$work_gbn_text_b?>";
	frm.work_gbn_text_c.value = "<?=$work_gbn_text_c?>";
}
addLoadEvent(tab_text_int);
function tab_show(tab) {
	var frm = document.form1;
	frm.tab.value = tab;
	document.getElementById(tab+'_text').style.display="";
	document.getElementById(tab).style.display="";
	if(tab == "tab1") {
		document.getElementById('tab2_text').style.display="none";
		document.getElementById('tab3_text').style.display="none";
		document.getElementById('tab2').style.display="none";
		document.getElementById('tab3').style.display="none";
		document.getElementById('tab_img1').src="./images/tabA_on.gif";
		document.getElementById('tab_img2').src="./images/tabB_off.gif";
		document.getElementById('tab_img3').src="./images/tabC_off.gif";
	} else if(tab == "tab2") {
		document.getElementById('tab1_text').style.display="none";
		document.getElementById('tab3_text').style.display="none";
		document.getElementById('tab1').style.display="none";
		document.getElementById('tab3').style.display="none";
		document.getElementById('tab_img1').src="./images/tabA_off.gif";
		document.getElementById('tab_img2').src="./images/tabB_on.gif";
		document.getElementById('tab_img3').src="./images/tabC_off.gif";
	} else {
		document.getElementById('tab1_text').style.display="none";
		document.getElementById('tab2_text').style.display="none";
		document.getElementById('tab1').style.display="none";
		document.getElementById('tab2').style.display="none";
		document.getElementById('tab_img1').src="./images/tabA_off.gif";
		document.getElementById('tab_img2').src="./images/tabB_off.gif";
		document.getElementById('tab_img3').src="./images/tabC_on.gif";
	}
}
</script>
