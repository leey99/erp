<html>
<head>
<title>�ְ� �ٹ�ǥ ����</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<link rel="stylesheet" type="text/css" href="./css/style_admin.css">
<script language="javascript" src="./js/common.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/lang/calendar-ko.js"></script>
<style type="text/css"> 
@import url("./js/jscalendar-1.0/calendar-system.css"); 
</style>
<script language="javascript">
	// ����� �ʱ�ȭ
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

		f.c_workhour_day_d.value = "0";
		f.c_workhour_day_w.value = "0";
		f.c_workhour_ext_w.value = "0";
		f.c_workhour_hday_w.value = "0";
		f.c_workhour_night_w.value = "0";

		f.d_workhour_day_d.value = "0";
		f.d_workhour_day_w.value = "0";
		f.d_workhour_ext_w.value = "0";
		f.d_workhour_hday_w.value = "0";
		f.d_workhour_night_w.value = "0";


		if( f.a_checked.checked && isValidWorkTime("A") ){
			setWorkTime("A");
		}
		if( f.b_checked.checked && isValidWorkTime("B") ){
			setWorkTime("B");
		}
		if( f.c_checked.checked && isValidWorkTime("C") ){
			setWorkTime("C");
		}
		if( f.d_checked.checked && isValidWorkTime("D") ){
			setWorkTime("D");
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


		if( f.workday_month.value == "" ){ // �ٹ��� Ȯ��
			return;
		}

		if( f.a_checked.checked && isValidWorkTime("A") ){ // ��5����, 6���� Ȯ��
			setWorkTime("A");
		}
		if( f.b_checked.checked && isValidWorkTime("B") ){
			setWorkTime("B");
		}
		if( f.c_checked.checked && isValidWorkTime("C") ){
			setWorkTime("C");
		}
		if( f.d_checked.checked && isValidWorkTime("D") ){
			setWorkTime("D");
		}

	}


	function checkWorkGbn( work_gbn, checked ){
		var f = document.form1;

		var disabled = true;
		var background = "bbbbbb";
		if( checked ){ // üũ, ����
			disabled = false;
			background = "";
		}

		for( var i=0; i<28; i++ ){ // 7*4
			try{
				if( f.work_gbn[i].value == work_gbn ){

					f.work_gbn[i].disabled = disabled; f.work_gbn[i].style.background = background;
					f.week_day[i].disabled = disabled; f.week_day[i].style.background = background;

					f.workday_gbn[i].disabled = disabled; f.workday_gbn[i].style.background = background;

					f.work_shour[i].disabled = disabled; f.work_shour[i].style.background = background;
					f.work_smin[i].disabled = disabled; f.work_smin[i].style.background = background;
					f.work_ehour[i].disabled = disabled; f.work_ehour[i].style.background = background;
					f.work_emin[i].disabled = disabled; f.work_emin[i].style.background = background;

					f.rest_shour[i].disabled = disabled; f.rest_shour[i].style.background = background;
					f.rest_smin[i].disabled = disabled; f.rest_smin[i].style.background = background;
					f.rest_ehour[i].disabled = disabled; f.rest_ehour[i].style.background = background;
					f.rest_emin[i].disabled = disabled; f.rest_emin[i].style.background = background;

					f.rest_shour2[i].disabled = disabled; f.rest_shour2[i].style.background = background;
					f.rest_smin2[i].disabled = disabled; f.rest_smin2[i].style.background = background;
					f.rest_ehour2[i].disabled = disabled; f.rest_ehour2[i].style.background = background;
					f.rest_emin2[i].disabled = disabled; f.rest_emin2[i].style.background = background;

					f.rest_shour3[i].disabled = disabled; f.rest_shour3[i].style.background = background;
					f.rest_smin3[i].disabled = disabled; f.rest_smin3[i].style.background = background;
					f.rest_ehour3[i].disabled = disabled; f.rest_ehour3[i].style.background = background;
					f.rest_emin3[i].disabled = disabled; f.rest_emin3[i].style.background = background;
				}
			}catch(e){}
		}
	}

	function setWorkTime( work_gbn ){

		var emp5_gbn = "";

		var f = document.form1;

		var week_day, workday_gbn, work_shour,work_smin,work_ehour,work_emin;
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

		for( var i=0; i<28; i++ ){ // 7*4
			if( f.work_gbn[i].value == work_gbn ){

				workhour_day = 0;
				workhour_ext = 0;
				workhour_hday = 0;
				workhour_night = 0;

				week_day = f.week_day[i].value; // ����
				workday_gbn = f.workday_gbn[i].value; // �ٹ�����

				work_shour = f.work_shour[i].value;
				work_smin = f.work_smin[i].value;
				work_ehour = f.work_ehour[i].value;
				work_emin = f.work_emin[i].value;

				rest_shour = f.rest_shour[i].value;
				rest_smin = f.rest_smin[i].value;
				rest_ehour = f.rest_ehour[i].value;
				rest_emin = f.rest_emin[i].value;

				rest_shour2 = f.rest_shour2[i].value;
				rest_smin2 = f.rest_smin2[i].value;
				rest_ehour2 = f.rest_ehour2[i].value;
				rest_emin2 = f.rest_emin2[i].value;

				rest_shour3 = f.rest_shour3[i].value;
				rest_smin3 = f.rest_smin3[i].value;
				rest_ehour3 = f.rest_ehour3[i].value;
				rest_emin3 = f.rest_emin3[i].value;

				if( workday_gbn != "" && work_shour != "" && work_smin != "" && work_ehour != "" && work_emin != "" ){

								var work_hour_arr = new Array();  // �þ��ð�(0) ~ �����ð�(23)
								var rest_hour_arr = new Array();  // �ްԽð�����(0) ~ �ްԽð�����(23)
								var rest2_hour_arr = new Array(); // �ްԽð�����(0) ~ �ްԽð�����(23)
								var rest3_hour_arr = new Array(); // �ްԽð�����(0) ~ �ްԽð�����(23)
								for(var j=0; j < 24; j++) {
									work_hour_arr[j] = 0;
									rest_hour_arr[j] = 0;
									rest2_hour_arr[j] = 0;
									rest3_hour_arr[j] = 0;
								}

								if( work_shour != "" && work_smin != "" && work_ehour != "" && work_emin != "" ){
									if( work_ehour > work_shour ){
										var iStart = toInt(work_shour);
										var iEnd = toInt(work_ehour);
										for( var j=iStart; j<=iEnd; j++ ){
											if( j == iStart ) work_hour_arr[j] += (60 - toInt(work_smin));
											else if( j == iEnd ) work_hour_arr[j] += toInt(work_emin);
											else work_hour_arr[j] += 60;
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

								// �����ٷνð�
								if ( workday_gbn == "01" || workday_gbn == "04" ){ // �ٹ���, ���ޱٷ�
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
								for( var j=0; j < work_hour_arr.length; j++ ){
									if( j <= 5 || j >= 22  ){
										var tmp = work_hour_arr[j] - rest_hour_arr[j]- rest2_hour_arr[j]- rest3_hour_arr[j];
										if( tmp > 0 ) workhour_night += tmp;

										//document.all.debug.value += "["+work_gbn+"]["+i+"]["+workday_gbn+"]["+j+"]"+ tmp+"\r\n";
									}
								}
								//document.all.debug.value += "["+work_gbn+"]["+i+"]["+workday_gbn+"]"+ workhour_night+"\r\n";


								workhour_day /= 60.0;
								//workhour_ext /= 60.0;
								workhour_hday /= 60.0;
								workhour_night /= 60.0;

								// ����ٷνð�(workhour_ext), �����ٷνð�
								if( workday_week == 5 ){ // �� 5����, �Ϻ��� ���
									if( workhour_day > 8 ){
										workhour_ext = workhour_day - 8;
										workhour_day = 8;
									}else{
										workhour_ext = 0;
										//workhour_day = workhour_day;
									}
								}else if( workday_week == 6 ){ // �� 6����, �Ϻ��� ��� ����, ��ü �հ�� ���
									//workhour_ext = 0;
									//workhour_day = workhour_day;
								}

								workhour_day_w += workhour_day;
								workhour_ext_w += workhour_ext;
								workhour_hday_w += workhour_hday;
								workhour_night_w += workhour_night;
				}
			} // if( f.work_gbn[i].value == work_gbn )
		} // end for


		// 1�� ����ٷνð�, �����ٷνð� (6����, ����)
		if( workday_week == 6 ){ // �� 6���� - �����ٷνð�, ����ٷνð�  ��ü �հ�� ���
			if( workhour_day_w > 40 ){
				workhour_ext_w = workhour_day_w - 40;
				workhour_day_w = 40;
			}else{
				workhour_ext_w = 0;
				//workhour_day_w = workhour_day_w;
			}
		}

		// 1�� �����ٷνð�
		if( workday_week > 0 ){
			workhour_day_d = workhour_day_w / workday_week;
		}

		// 5�ι̸� ����� - �߰��ٷ� �ð� ����. 2013.08.05 �߰�
		if( emp5_gbn == "1" ){ // 5������
			workhour_night = 0;
			workhour_night_w = 0;
		}


		workhour_day_d = ( parseInt(workhour_day_d * 1000) / 1000);
		workhour_day_w = ( parseInt(workhour_day_w * 1000) / 1000);
		workhour_ext_w = ( parseInt(workhour_ext_w * 1000) / 1000);
		workhour_hday_w = ( parseInt(workhour_hday_w * 1000) / 1000);
		workhour_night_w = ( parseInt(workhour_night_w * 1000) / 1000);

		if( work_gbn == "A" ){
			f.a_workhour_day_d.value = workhour_day_d;
			f.a_workhour_day_w.value = workhour_day_w;
			f.a_workhour_ext_w.value = workhour_ext_w;
			f.a_workhour_hday_w.value = workhour_hday_w;
			f.a_workhour_night_w.value = workhour_night_w;
		}else if( work_gbn == "B" ){
			f.b_workhour_day_d.value = workhour_day_d;
			f.b_workhour_day_w.value = workhour_day_w;
			f.b_workhour_ext_w.value = workhour_ext_w;
			f.b_workhour_hday_w.value = workhour_hday_w;
			f.b_workhour_night_w.value = workhour_night_w;
		}else if( work_gbn == "C" ){
			f.c_workhour_day_d.value = workhour_day_d;
			f.c_workhour_day_w.value = workhour_day_w;
			f.c_workhour_ext_w.value = workhour_ext_w;
			f.c_workhour_hday_w.value = workhour_hday_w;
			f.c_workhour_night_w.value = workhour_night_w;
		}else if( work_gbn == "D" ){
			f.d_workhour_day_d.value = workhour_day_d;
			f.d_workhour_day_w.value = workhour_day_w;
			f.d_workhour_ext_w.value = workhour_ext_w;
			f.d_workhour_hday_w.value = workhour_hday_w;
			f.d_workhour_night_w.value = workhour_night_w;
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
		for( var i=0; i<28; i++ ){ // 7*4
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
		initWorkTime(); /////////////////////////////////

		var f = document.form1;

		var checked = false;
		if( work_gbn == "A" ){
			checked = f.a_checked.checked;
		}else if( work_gbn == "B" ){
			checked = f.b_checked.checked;
		}else if( work_gbn == "C" ){
			checked = f.c_checked.checked;
		}else if( work_gbn == "D" ){
			checked = f.d_checked.checked;
		}

		if( !checked ){
			alert( "["+work_gbn+"] Ÿ���� �ٹ����� �Է��ϼ���." );
			return;
		}

		if( f.workday_month.value == "" ){
			alert("�ְ� �ٷ����� ������ �ּ���.");
			f.workday_month.focus();
			return;
		}

		// �� 5����, 6���� �ٹ��� Ȯ��
		if( isValidWorkTime( work_gbn ) != true ){
			alert( "["+work_gbn+"] Ÿ���� �ٹ����� �ְ� �ٷ���("+f.workday_week.value+" ��)�� �°� �Է��ϼ���." );
			return;
		}

		setWorkTime( work_gbn );

		selectWorkTime( work_gbn );  /////////////////////////////////
	}


	function selectWorkTime(work_gbn){

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
		}else if( work_gbn == "C" ){
			workhour_day_d = f.c_workhour_day_d.value;
			workhour_day_w = f.c_workhour_day_w.value
			workhour_ext_w = f.c_workhour_ext_w.value;
			workhour_hday_w = f.c_workhour_hday_w.value;
			workhour_night_w = f.c_workhour_night_w.value;
		}else if( work_gbn == "D" ){
			workhour_day_d = f.d_workhour_day_d.value;
			workhour_day_w = f.d_workhour_day_w.value
			workhour_ext_w = f.d_workhour_ext_w.value;
			workhour_hday_w = f.d_workhour_hday_w.value;
			workhour_night_w = f.d_workhour_night_w.value;
		}


		var f1 = opener.document.dataForm;
		var idx = 0;
		for( var i=0; i<28; i++ ){ // 7*4
			if( f.work_gbn[i].value == work_gbn ){
				//var week_day = f.week_day[i].value; // ����
				f1.work_gbn[idx].value = work_gbn;

				f1.workday_gbn[idx].value = f.workday_gbn[i].value; // �ٹ�����
				f1.work_shour[idx].value = f.work_shour[i].value;
				f1.work_smin[idx].value = f.work_smin[i].value;
				f1.work_ehour[idx].value = f.work_ehour[i].value;
				f1.work_emin[idx].value = f.work_emin[i].value;
				f1.rest_shour[idx].value = f.rest_shour[i].value;
				f1.rest_smin[idx].value = f.rest_smin[i].value;
				f1.rest_ehour[idx].value = f.rest_ehour[i].value;
				f1.rest_emin[idx].value = f.rest_emin[i].value;

				f1.rest_shour2[idx].value = f.rest_shour2[i].value;
				f1.rest_smin2[idx].value = f.rest_smin2[i].value;
				f1.rest_ehour2[idx].value = f.rest_ehour2[i].value;
				f1.rest_emin2[idx].value = f.rest_emin2[i].value;

				f1.rest_shour3[idx].value = f.rest_shour3[i].value;
				f1.rest_smin3[idx].value = f.rest_smin3[i].value;
				f1.rest_ehour3[idx].value = f.rest_ehour3[i].value;
				f1.rest_emin3[idx].value = f.rest_emin3[i].value;

				idx++;
			}
		}

		f1.workday_month.value = workday_month;
		if( workday_month == "20" ){
			opener.document.getElementById("workday_month_text").innerHTML = "5�ϱٷ�";
			f1.workday_week.value = "5";
		}else if( workday_month == "24" ){
			opener.document.getElementById("workday_month_text").innerHTML = "6�ϱٷ�";
			f1.workday_week.value = "6";
		}else{
			opener.document.getElementById("workday_month_text").innerHTML = "�̵��";
			f1.workday_week.value = "";
		}

		var f2 = opener.document.formSalary; // ������
		if(f1.pay_gbn[1].checked ){ // �ð���
			f2 = opener.document.formParttime;
		}
		f2.workhour_day_d.value = workhour_day_d;
		f2.workhour_day_w.value = workhour_day_w;
		f2.workhour_ext_w.value = workhour_ext_w;
		f2.workhour_hday_w.value = workhour_hday_w;
		f2.workhour_night_w.value = workhour_night_w;

		opener.setWorkHour("all");

	}

</script>

<body topmargin="8" leftmargin="0">
<form name="form1" method="post" style="margin:0">
<input type="hidden" name="cust_numb" value="98">
<input type="hidden" name="url" value="/_biz/pop_select_work_time.asp">
<input type="hidden" name="frmurl" value="/_biz/pop_select_work_time.asp?cust_numb=98">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td style="padding-left:20">
			<!--Ÿ��Ʋ -->
			<table width="100%" border=0 cellspacing=0 cellpadding=0>
				<tr>     
					<td height="18">
						<table width=100% border=0 cellspacing=0 cellpadding=0>
							<tr>
								<td style='font-size:8pt;color:#929292;'><img src=./images/g_title_icon.gif align=absmiddle  style='margin:0 5 2 0'><span style='font-size:9pt;color:black;'>�ٷνð� ���</span>
								</td>
								<td align=right class=navi></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td height=1 bgcolor=e0e0de></td>
				</tr>
				<tr>
					<td height=2 bgcolor=f5f5f5></td>
				</tr>
				<tr>
					<td height=5></td>
				</tr>
			</table>
			<!--Ÿ��Ʋ -->

			<!--��޴� -->
			<table border=0 cellspacing=0 cellpadding=0> 
				<tr> 
					<td id="Tab_cust_tab_01_0"> 
						<table border=0 cellpadding=0 cellspacing=0> 
							<tr> 
								<td><img src="./images/g_tab_on_lt.gif"></td> 
								<td background="./images/g_tab_on_bg.gif" class="Sftbutton_white" style='width:80;text-align:center'> 
								<a href="#">���������</a> 
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
			<!--��޴� -->

			<!-- �Է��� -->
			<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
				<col width="12%"/>
				<col width=""/>
				<col width="12%"/>
				<col width=""/>
				<col width="12%"/>
				<col width=""/>
				<tr>
					<td class="tdrowk">���ü��</td>
					<td class="tdrow">�泲�簡���κ�������</td>
					<td class="tdrowk">����ڱ���</td>
					<td class="tdrow"> ����</td>
					<td class="tdrowk">����ڹ�ȣ</td>
					<td class="tdrow">6218271633</td>
				</tr>
				<tr>
					<td class="tdrowk">����</td>
					<td class="tdrow">
						[�����] �簡����
					</td>
					<td class="tdrowk">�ְ� �ٷ���</td>
					<td class="tdrow">
						<select name="workday_month" class="selectfm" onChange="changeWorkDayMonth()">
						<option value=""></option>
						<option value="20" selected>5�ϱٷ�</option>
						<option value="24" >6�ϱٷ�</option>
						</select>

						<input type="hidden" name="workday_week" value="5">
					</td>
					<td class="tdrowk"></td>
					<td class="tdrow"></td>

				</tr>
			</table>


			<div style="height:5px;font-size:0px"></div>
			<table border=0 cellspacing=0 cellpadding=0> 
				<tr> 
					<td id="Tab_cust_tab_01_0"> 
						<table border=0 cellpadding=0 cellspacing=0> 
							<tr> 
								<td><img src="./images/g_tab_on_lt.gif"></td> 
								<td background="./images/g_tab_on_bg.gif" class="Sftbutton_white" style='width:80;text-align:center'> 
								<a href="#">A Ÿ��</a> 
								</td> 
								<td><img src="./images/g_tab_on_rt.gif"></td> 
							</tr> 
						</table> 
					</td> 
					<td width=2></td> 
					<td>
					<input type="checkbox" name="a_checked" value="1"  onClick="checkWorkGbn('A',this.checked);">
					</td> 
					<td>
<table border=0 cellpadding=0 cellspacing=0 style=display:inline;>    <tr>       <td width=2></td>        <td><img src=./images/btn1_lt.gif></td>        <td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:calWorkTime('A');" target="">�ٷνð� �����ϱ�</a></td>        <td><img src=./images/btn1_rt.gif></td>       <td width=2></td>      </tr>    </table>  
					</td>
				</tr> 
			</table>
			<div style="height:2px;font-size:0px" class="bgtr"></div>
			<div style="height:2px;font-size:0px"></div>
			<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
				<col width="40"/><col width=""/><col width=""/><col width=""/><col width=""/><col width=""/><col width=""/><col width=""/><col width=""/><col width=""/>
				<tr>
					<td class="tdhead_center" rowspan="2">����</td>
					<td class="tdhead_center" rowspan="2">�ٹ�����</td>
					<td class="tdhead_center" rowspan="2">�þ��ð�</td>
					<td class="tdhead_center" rowspan="2">�����ð�</td>
					<td class="tdhead_center" colspan="6">�ްԽð�</td>
				</tr>
				<tr>
					<td class="tdhead_center">����</td>
					<td class="tdhead_center">����</td>
					<td class="tdhead_center">����</td>
					<td class="tdhead_center">����</td>
					<td class="tdhead_center">����</td>
					<td class="tdhead_center">����</td>
				</tr>


				<tr>
					<td class="tdrow">��
<input type="hidden" name="work_gbn" value="A">
<input type="hidden" name="week_day" value="1">
					</td>
					<td class="tdrow">
						<select name="workday_gbn" class="selectfm">
							<option value=""></option>
							<option value="01" >�ٹ���</option>
							<option value="02" selected>��������</option>
							<option value="03" >��������</option>
							<option value="04" >�����޹���</option>
						</select>
					</td>
					<td class="tdrow">
						<select name="work_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="work_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>

				<tr>
					<td class="tdrow">��
<input type="hidden" name="work_gbn" value="A">
<input type="hidden" name="week_day" value="2">
					</td>
					<td class="tdrow">
						<select name="workday_gbn" class="selectfm">
							<option value=""></option>
							<option value="01" selected>�ٹ���</option>
							<option value="02" >��������</option>
							<option value="03" >��������</option>
							<option value="04" >�����޹���</option>
						</select>
					</td>
					<td class="tdrow">
						<select name="work_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" selected>9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="work_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" selected>18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" selected>12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" selected>13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>

				<tr>
					<td class="tdrow">ȭ
<input type="hidden" name="work_gbn" value="A">
<input type="hidden" name="week_day" value="3">
					</td>
					<td class="tdrow">
						<select name="workday_gbn" class="selectfm">
							<option value=""></option>
							<option value="01" selected>�ٹ���</option>
							<option value="02" >��������</option>
							<option value="03" >��������</option>
							<option value="04" >�����޹���</option>
						</select>
					</td>
					<td class="tdrow">
						<select name="work_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" selected>9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="work_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" selected>18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" selected>12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" selected>13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>

				<tr>
					<td class="tdrow">��
<input type="hidden" name="work_gbn" value="A">
<input type="hidden" name="week_day" value="4">
					</td>
					<td class="tdrow">
						<select name="workday_gbn" class="selectfm">
							<option value=""></option>
							<option value="01" selected>�ٹ���</option>
							<option value="02" >��������</option>
							<option value="03" >��������</option>
							<option value="04" >�����޹���</option>
						</select>
					</td>
					<td class="tdrow">
						<select name="work_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" selected>9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="work_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" selected>18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" selected>12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" selected>13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>

				<tr>
					<td class="tdrow">��
<input type="hidden" name="work_gbn" value="A">
<input type="hidden" name="week_day" value="5">
					</td>
					<td class="tdrow">
						<select name="workday_gbn" class="selectfm">
							<option value=""></option>
							<option value="01" selected>�ٹ���</option>
							<option value="02" >��������</option>
							<option value="03" >��������</option>
							<option value="04" >�����޹���</option>
						</select>
					</td>
					<td class="tdrow">
						<select name="work_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" selected>9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="work_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" selected>18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" selected>12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" selected>13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>

				<tr>
					<td class="tdrow">��
<input type="hidden" name="work_gbn" value="A">
<input type="hidden" name="week_day" value="6">
					</td>
					<td class="tdrow">
						<select name="workday_gbn" class="selectfm">
							<option value=""></option>
							<option value="01" selected>�ٹ���</option>
							<option value="02" >��������</option>
							<option value="03" >��������</option>
							<option value="04" >�����޹���</option>
						</select>
					</td>
					<td class="tdrow">
						<select name="work_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" selected>9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="work_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" selected>18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" selected>12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" selected>13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>

				<tr>
					<td class="tdrow">��
<input type="hidden" name="work_gbn" value="A">
<input type="hidden" name="week_day" value="7">
					</td>
					<td class="tdrow">
						<select name="workday_gbn" class="selectfm">
							<option value=""></option>
							<option value="01" >�ٹ���</option>
							<option value="02" >��������</option>
							<option value="03" selected>��������</option>
							<option value="04" >�����޹���</option>
						</select>
					</td>
					<td class="tdrow">
						<select name="work_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="work_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>

			</table>
			<div style="height:2px;font-size:0px"></div>
			<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
				<tr>
					<td class="tdhead_center">1�� �����ٷνð�</td>
					<td class="tdhead_center">1�� �����ٷνð�</td>
					<td class="tdhead_center">1�� ����ٷνð�</td>
					<td class="tdhead_center">1�� ���ϱٷνð�</td>
					<td class="tdhead_center">1�� �߰��ٷνð�</td>
				</tr>
				<tr>
					<td class="tdrow_center"><input type="text" name="a_workhour_day_d" style="width:50px;background:bbbbbb;" value="" readonly></td>
					<td class="tdrow_center"><input type="text" name="a_workhour_day_w" style="width:50px;background:bbbbbb;" value="" readonly></td>
					<td class="tdrow_center"><input type="text" name="a_workhour_ext_w" style="width:50px;background:bbbbbb;" value="" readonly></td>
					<td class="tdrow_center"><input type="text" name="a_workhour_hday_w" style="width:50px;background:bbbbbb;" value="" readonly></td>
					<td class="tdrow_center"><input type="text" name="a_workhour_night_w" style="width:50px;background:bbbbbb;" value="" readonly></td>
				</tr>
			</table>
<script>
checkWorkGbn('A',false);
</script>
























			<div style="height:5px;font-size:0px"></div>
			<table border=0 cellspacing=0 cellpadding=0> 
				<tr> 
					<td id="Tab_cust_tab_01_0"> 
						<table border=0 cellpadding=0 cellspacing=0> 
							<tr> 
								<td><img src="./images/g_tab_on_lt.gif"></td> 
								<td background="./images/g_tab_on_bg.gif" class="Sftbutton_white" style='width:80;text-align:center'> 
								<a href="#">B Ÿ��</a> 
								</td> 
								<td><img src="./images/g_tab_on_rt.gif"></td> 
							</tr> 
						</table> 
					</td> 
					<td width=2></td> 
					<td>
					<input type="checkbox" name="b_checked" value="1"  onClick="checkWorkGbn('B',this.checked);">
					</td> 
					<td>
<table border=0 cellpadding=0 cellspacing=0 style=display:inline;>    <tr>       <td width=2></td>        <td><img src=./images/btn1_lt.gif></td>        <td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:calWorkTime('B');" target="">�ٷνð� �����ϱ�</a></td>        <td><img src=./images/btn1_rt.gif></td>       <td width=2></td>      </tr>    </table>  
					</td>
				</tr> 
			</table>
			<div style="height:2px;font-size:0px" class="bgtr"></div>
			<div style="height:2px;font-size:0px"></div>
			<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
				<col width="40"/><col width=""/><col width=""/><col width=""/><col width=""/><col width=""/><col width=""/><col width=""/><col width=""/><col width=""/>
				<tr>
					<td class="tdhead_center" rowspan="2">����</td>
					<td class="tdhead_center" rowspan="2">�ٹ�����</td>
					<td class="tdhead_center" rowspan="2">�þ��ð�</td>
					<td class="tdhead_center" rowspan="2">�����ð�</td>
					<td class="tdhead_center" colspan="6">�ްԽð�</td>
				</tr>
				<tr>
					<td class="tdhead_center">����</td>
					<td class="tdhead_center">����</td>
					<td class="tdhead_center">����</td>
					<td class="tdhead_center">����</td>
					<td class="tdhead_center">����</td>
					<td class="tdhead_center">����</td>
				</tr>


				<tr>
					<td class="tdrow">��
<input type="hidden" name="work_gbn" value="B">
<input type="hidden" name="week_day" value="1">
					</td>
					<td class="tdrow">
						<select name="workday_gbn" class="selectfm">
							<option value=""></option>
							<option value="01" >�ٹ���</option>
							<option value="02" selected>��������</option>
							<option value="03" >��������</option>
							<option value="04" >�����޹���</option>
						</select>
					</td>
					<td class="tdrow">
						<select name="work_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="work_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>

				<tr>
					<td class="tdrow">��
<input type="hidden" name="work_gbn" value="B">
<input type="hidden" name="week_day" value="2">
					</td>
					<td class="tdrow">
						<select name="workday_gbn" class="selectfm">
							<option value=""></option>
							<option value="01" selected>�ٹ���</option>
							<option value="02" >��������</option>
							<option value="03" >��������</option>
							<option value="04" >�����޹���</option>
						</select>
					</td>
					<td class="tdrow">
						<select name="work_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" selected>9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="work_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" selected>18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" selected>12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" selected>13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>

				<tr>
					<td class="tdrow">ȭ
<input type="hidden" name="work_gbn" value="B">
<input type="hidden" name="week_day" value="3">
					</td>
					<td class="tdrow">
						<select name="workday_gbn" class="selectfm">
							<option value=""></option>
							<option value="01" selected>�ٹ���</option>
							<option value="02" >��������</option>
							<option value="03" >��������</option>
							<option value="04" >�����޹���</option>
						</select>
					</td>
					<td class="tdrow">
						<select name="work_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" selected>9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="work_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" selected>18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" selected>12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" selected>13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>

				<tr>
					<td class="tdrow">��
<input type="hidden" name="work_gbn" value="B">
<input type="hidden" name="week_day" value="4">
					</td>
					<td class="tdrow">
						<select name="workday_gbn" class="selectfm">
							<option value=""></option>
							<option value="01" selected>�ٹ���</option>
							<option value="02" >��������</option>
							<option value="03" >��������</option>
							<option value="04" >�����޹���</option>
						</select>
					</td>
					<td class="tdrow">
						<select name="work_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" selected>9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="work_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" selected>18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" selected>12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" selected>13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>

				<tr>
					<td class="tdrow">��
<input type="hidden" name="work_gbn" value="B">
<input type="hidden" name="week_day" value="5">
					</td>
					<td class="tdrow">
						<select name="workday_gbn" class="selectfm">
							<option value=""></option>
							<option value="01" selected>�ٹ���</option>
							<option value="02" >��������</option>
							<option value="03" >��������</option>
							<option value="04" >�����޹���</option>
						</select>
					</td>
					<td class="tdrow">
						<select name="work_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" selected>9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="work_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" selected>18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" selected>12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" selected>13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>

				<tr>
					<td class="tdrow">��
<input type="hidden" name="work_gbn" value="B">
<input type="hidden" name="week_day" value="6">
					</td>
					<td class="tdrow">
						<select name="workday_gbn" class="selectfm">
							<option value=""></option>
							<option value="01" selected>�ٹ���</option>
							<option value="02" >��������</option>
							<option value="03" >��������</option>
							<option value="04" >�����޹���</option>
						</select>
					</td>
					<td class="tdrow">
						<select name="work_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" selected>9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="work_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" selected>18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" selected>12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" selected>13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>

				<tr>
					<td class="tdrow">��
<input type="hidden" name="work_gbn" value="B">
<input type="hidden" name="week_day" value="7">
					</td>
					<td class="tdrow">
						<select name="workday_gbn" class="selectfm">
							<option value=""></option>
							<option value="01" >�ٹ���</option>
							<option value="02" >��������</option>
							<option value="03" selected>��������</option>
							<option value="04" >�����޹���</option>
						</select>
					</td>
					<td class="tdrow">
						<select name="work_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="work_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>

			</table>
			<div style="height:2px;font-size:0px"></div>
			<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
				<tr>
					<td class="tdhead_center">1�� �����ٷνð�</td>
					<td class="tdhead_center">1�� �����ٷνð�</td>
					<td class="tdhead_center">1�� ����ٷνð�</td>
					<td class="tdhead_center">1�� ���ϱٷνð�</td>
					<td class="tdhead_center">1�� �߰��ٷνð�</td>
				</tr>
				<tr>
					<td class="tdrow_center"><input type="text" name="b_workhour_day_d" style="width:50px;background:bbbbbb;" value="" readonly></td>
					<td class="tdrow_center"><input type="text" name="b_workhour_day_w" style="width:50px;background:bbbbbb;" value="" readonly></td>
					<td class="tdrow_center"><input type="text" name="b_workhour_ext_w" style="width:50px;background:bbbbbb;" value="" readonly></td>
					<td class="tdrow_center"><input type="text" name="b_workhour_hday_w" style="width:50px;background:bbbbbb;" value="" readonly></td>
					<td class="tdrow_center"><input type="text" name="b_workhour_night_w" style="width:50px;background:bbbbbb;" value="" readonly></td>
				</tr>
			</table>
<script>
checkWorkGbn('B',false);
</script>
























			<div style="height:5px;font-size:0px"></div>
			<table border=0 cellspacing=0 cellpadding=0> 
				<tr> 
					<td id="Tab_cust_tab_01_0"> 
						<table border=0 cellpadding=0 cellspacing=0> 
							<tr> 
								<td><img src="./images/g_tab_on_lt.gif"></td> 
								<td background="./images/g_tab_on_bg.gif" class="Sftbutton_white" style='width:80;text-align:center'> 
								<a href="#">C Ÿ��</a> 
								</td> 
								<td><img src="./images/g_tab_on_rt.gif"></td> 
							</tr> 
						</table> 
					</td> 
					<td width=2></td> 
					<td>
					<input type="checkbox" name="c_checked" value="1"  onClick="checkWorkGbn('C',this.checked);">
					</td> 
					<td>
<table border=0 cellpadding=0 cellspacing=0 style=display:inline;>    <tr>       <td width=2></td>        <td><img src=./images/btn1_lt.gif></td>        <td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:calWorkTime('C');" target="">�ٷνð� �����ϱ�</a></td>        <td><img src=./images/btn1_rt.gif></td>       <td width=2></td>      </tr>    </table>  
					</td>
				</tr> 
			</table>
			<div style="height:2px;font-size:0px" class="bgtr"></div>
			<div style="height:2px;font-size:0px"></div>
			<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
				<col width="40"/><col width=""/><col width=""/><col width=""/><col width=""/><col width=""/><col width=""/><col width=""/><col width=""/><col width=""/>
				<tr>
					<td class="tdhead_center" rowspan="2">����</td>
					<td class="tdhead_center" rowspan="2">�ٹ�����</td>
					<td class="tdhead_center" rowspan="2">�þ��ð�</td>
					<td class="tdhead_center" rowspan="2">�����ð�</td>
					<td class="tdhead_center" colspan="6">�ްԽð�</td>
				</tr>
				<tr>
					<td class="tdhead_center">����</td>
					<td class="tdhead_center">����</td>
					<td class="tdhead_center">����</td>
					<td class="tdhead_center">����</td>
					<td class="tdhead_center">����</td>
					<td class="tdhead_center">����</td>
				</tr>


				<tr>
					<td class="tdrow">��
<input type="hidden" name="work_gbn" value="C">
<input type="hidden" name="week_day" value="1">
					</td>
					<td class="tdrow">
						<select name="workday_gbn" class="selectfm">
							<option value=""></option>
							<option value="01" >�ٹ���</option>
							<option value="02" selected>��������</option>
							<option value="03" >��������</option>
							<option value="04" >�����޹���</option>
						</select>
					</td>
					<td class="tdrow">
						<select name="work_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="work_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>

				<tr>
					<td class="tdrow">��
<input type="hidden" name="work_gbn" value="C">
<input type="hidden" name="week_day" value="2">
					</td>
					<td class="tdrow">
						<select name="workday_gbn" class="selectfm">
							<option value=""></option>
							<option value="01" selected>�ٹ���</option>
							<option value="02" >��������</option>
							<option value="03" >��������</option>
							<option value="04" >�����޹���</option>
						</select>
					</td>
					<td class="tdrow">
						<select name="work_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" selected>9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="work_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" selected>18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" selected>12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" selected>13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>

				<tr>
					<td class="tdrow">ȭ
<input type="hidden" name="work_gbn" value="C">
<input type="hidden" name="week_day" value="3">
					</td>
					<td class="tdrow">
						<select name="workday_gbn" class="selectfm">
							<option value=""></option>
							<option value="01" selected>�ٹ���</option>
							<option value="02" >��������</option>
							<option value="03" >��������</option>
							<option value="04" >�����޹���</option>
						</select>
					</td>
					<td class="tdrow">
						<select name="work_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" selected>9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="work_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" selected>18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" selected>12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" selected>13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>

				<tr>
					<td class="tdrow">��
<input type="hidden" name="work_gbn" value="C">
<input type="hidden" name="week_day" value="4">
					</td>
					<td class="tdrow">
						<select name="workday_gbn" class="selectfm">
							<option value=""></option>
							<option value="01" selected>�ٹ���</option>
							<option value="02" >��������</option>
							<option value="03" >��������</option>
							<option value="04" >�����޹���</option>
						</select>
					</td>
					<td class="tdrow">
						<select name="work_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" selected>9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="work_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" selected>18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" selected>12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" selected>13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>

				<tr>
					<td class="tdrow">��
<input type="hidden" name="work_gbn" value="C">
<input type="hidden" name="week_day" value="5">
					</td>
					<td class="tdrow">
						<select name="workday_gbn" class="selectfm">
							<option value=""></option>
							<option value="01" selected>�ٹ���</option>
							<option value="02" >��������</option>
							<option value="03" >��������</option>
							<option value="04" >�����޹���</option>
						</select>
					</td>
					<td class="tdrow">
						<select name="work_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" selected>9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="work_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" selected>18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" selected>12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" selected>13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>

				<tr>
					<td class="tdrow">��
<input type="hidden" name="work_gbn" value="C">
<input type="hidden" name="week_day" value="6">
					</td>
					<td class="tdrow">
						<select name="workday_gbn" class="selectfm">
							<option value=""></option>
							<option value="01" selected>�ٹ���</option>
							<option value="02" >��������</option>
							<option value="03" >��������</option>
							<option value="04" >�����޹���</option>
						</select>
					</td>
					<td class="tdrow">
						<select name="work_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" selected>9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="work_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" selected>18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" selected>12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" selected>13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>

				<tr>
					<td class="tdrow">��
<input type="hidden" name="work_gbn" value="C">
<input type="hidden" name="week_day" value="7">
					</td>
					<td class="tdrow">
						<select name="workday_gbn" class="selectfm">
							<option value=""></option>
							<option value="01" >�ٹ���</option>
							<option value="02" >��������</option>
							<option value="03" selected>��������</option>
							<option value="04" >�����޹���</option>
						</select>
					</td>
					<td class="tdrow">
						<select name="work_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="work_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>

			</table>
			<div style="height:2px;font-size:0px"></div>
			<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
				<tr>
					<td class="tdhead_center">1�� �����ٷνð�</td>
					<td class="tdhead_center">1�� �����ٷνð�</td>
					<td class="tdhead_center">1�� ����ٷνð�</td>
					<td class="tdhead_center">1�� ���ϱٷνð�</td>
					<td class="tdhead_center">1�� �߰��ٷνð�</td>
				</tr>
				<tr>
					<td class="tdrow_center"><input type="text" name="c_workhour_day_d" style="width:50px;background:bbbbbb;" value="" readonly></td>
					<td class="tdrow_center"><input type="text" name="c_workhour_day_w" style="width:50px;background:bbbbbb;" value="" readonly></td>
					<td class="tdrow_center"><input type="text" name="c_workhour_ext_w" style="width:50px;background:bbbbbb;" value="" readonly></td>
					<td class="tdrow_center"><input type="text" name="c_workhour_hday_w" style="width:50px;background:bbbbbb;" value="" readonly></td>
					<td class="tdrow_center"><input type="text" name="c_workhour_night_w" style="width:50px;background:bbbbbb;" value="" readonly></td>
				</tr>
			</table>
<script>
checkWorkGbn('C',false);
</script>
























			<div style="height:5px;font-size:0px"></div>
			<table border=0 cellspacing=0 cellpadding=0> 
				<tr> 
					<td id="Tab_cust_tab_01_0"> 
						<table border=0 cellpadding=0 cellspacing=0> 
							<tr> 
								<td><img src="./images/g_tab_on_lt.gif"></td> 
								<td background="./images/g_tab_on_bg.gif" class="Sftbutton_white" style='width:80;text-align:center'> 
								<a href="#">D Ÿ��</a> 
								</td> 
								<td><img src="./images/g_tab_on_rt.gif"></td> 
							</tr> 
						</table> 
					</td> 
					<td width=2></td> 
					<td>
					<input type="checkbox" name="d_checked" value="1"  onClick="checkWorkGbn('D',this.checked);">
					</td> 
					<td>
<table border=0 cellpadding=0 cellspacing=0 style=display:inline;>    <tr>       <td width=2></td>        <td><img src=./images/btn1_lt.gif></td>        <td background=./images/btn1_bg.gif class=ftbutton3_white nowrap><a href="javascript:calWorkTime('D');" target="">�ٷνð� �����ϱ�</a></td>        <td><img src=./images/btn1_rt.gif></td>       <td width=2></td>      </tr>    </table>  
					</td>
				</tr> 
			</table>
			<div style="height:2px;font-size:0px" class="bgtr"></div>
			<div style="height:2px;font-size:0px"></div>
			<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
				<col width="40"/><col width=""/><col width=""/><col width=""/><col width=""/><col width=""/><col width=""/><col width=""/><col width=""/><col width=""/>
				<tr>
					<td class="tdhead_center" rowspan="2">����</td>
					<td class="tdhead_center" rowspan="2">�ٹ�����</td>
					<td class="tdhead_center" rowspan="2">�þ��ð�</td>
					<td class="tdhead_center" rowspan="2">�����ð�</td>
					<td class="tdhead_center" colspan="6">�ްԽð�</td>
				</tr>
				<tr>
					<td class="tdhead_center">����</td>
					<td class="tdhead_center">����</td>
					<td class="tdhead_center">����</td>
					<td class="tdhead_center">����</td>
					<td class="tdhead_center">����</td>
					<td class="tdhead_center">����</td>
				</tr>


				<tr>
					<td class="tdrow">��
<input type="hidden" name="work_gbn" value="D">
<input type="hidden" name="week_day" value="1">
					</td>
					<td class="tdrow">
						<select name="workday_gbn" class="selectfm">
							<option value=""></option>
							<option value="01" >�ٹ���</option>
							<option value="02" selected>��������</option>
							<option value="03" >��������</option>
							<option value="04" >�����޹���</option>
						</select>
					</td>
					<td class="tdrow">
						<select name="work_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="work_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>

				<tr>
					<td class="tdrow">��
<input type="hidden" name="work_gbn" value="D">
<input type="hidden" name="week_day" value="2">
					</td>
					<td class="tdrow">
						<select name="workday_gbn" class="selectfm">
							<option value=""></option>
							<option value="01" selected>�ٹ���</option>
							<option value="02" >��������</option>
							<option value="03" >��������</option>
							<option value="04" >�����޹���</option>
						</select>
					</td>
					<td class="tdrow">
						<select name="work_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" selected>9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="work_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" selected>18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" selected>12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" selected>13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>

				<tr>
					<td class="tdrow">ȭ
<input type="hidden" name="work_gbn" value="D">
<input type="hidden" name="week_day" value="3">
					</td>
					<td class="tdrow">
						<select name="workday_gbn" class="selectfm">
							<option value=""></option>
							<option value="01" selected>�ٹ���</option>
							<option value="02" >��������</option>
							<option value="03" >��������</option>
							<option value="04" >�����޹���</option>
						</select>
					</td>
					<td class="tdrow">
						<select name="work_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" selected>9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="work_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" selected>18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" selected>12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" selected>13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>

				<tr>
					<td class="tdrow">��
<input type="hidden" name="work_gbn" value="D">
<input type="hidden" name="week_day" value="4">
					</td>
					<td class="tdrow">
						<select name="workday_gbn" class="selectfm">
							<option value=""></option>
							<option value="01" selected>�ٹ���</option>
							<option value="02" >��������</option>
							<option value="03" >��������</option>
							<option value="04" >�����޹���</option>
						</select>
					</td>
					<td class="tdrow">
						<select name="work_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" selected>9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="work_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" selected>18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" selected>12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" selected>13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>

				<tr>
					<td class="tdrow">��
<input type="hidden" name="work_gbn" value="D">
<input type="hidden" name="week_day" value="5">
					</td>
					<td class="tdrow">
						<select name="workday_gbn" class="selectfm">
							<option value=""></option>
							<option value="01" selected>�ٹ���</option>
							<option value="02" >��������</option>
							<option value="03" >��������</option>
							<option value="04" >�����޹���</option>
						</select>
					</td>
					<td class="tdrow">
						<select name="work_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" selected>9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="work_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" selected>18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" selected>12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" selected>13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_smin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="rest_emin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>

				<tr>
					<td class="tdrow">��
<input type="hidden" name="work_gbn" value="D">
<input type="hidden" name="week_day" value="6">
					</td>
					<td class="tdrow">
						<select name="workday_gbn" class="selectfm">
							<option value=""></option>
							<option value="01" selected>�ٹ���</option>
							<option value="02" >��������</option>
							<option value="03" >��������</option>
							<option value="04" >�����޹���</option>
						</select>
					</td>
					<td class="tdrow">
						<select name="work_shour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" selected>9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" >18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="work_ehour" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="01" >1</option>
							
								<option value="02" >2</option>
							
								<option value="03" >3</option>
							
								<option value="04" >4</option>
							
								<option value="05" >5</option>
							
								<option value="06" >6</option>
							
								<option value="07" >7</option>
							
								<option value="08" >8</option>
							
								<option value="09" >9</option>
							
								<option value="10" >10</option>
							
								<option value="11" >11</option>
							
								<option value="12" >12</option>
							
								<option value="13" >13</option>
							
								<option value="14" >14</option>
							
								<option value="15" >15</option>
							
								<option value="16" >16</option>
							
								<option value="17" >17</option>
							
								<option value="18" selected>18</option>
							
								<option value="19" >19</option>
							
								<option value="20" >20</option>
							
								<option value="21" >21</option>
							
								<option value="22" >22</option>
							
								<option value="23" >23</option>
							
						</select>
						<select name="work_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour" class="selectfm">
							<option value=""></option>
<?
for($i=0;$i<24;$i++) {
	if($i<10) $k = "0".$i;
	else $k = $i;
	if($i==12) $selected_rest_shour[$i] = "selected";
	else $selected_rest_shour[$i] = "";
?>
								<option value="<?=$k?>" <?=$selected_rest_shour[$i]?>><?=$i?></option>
<?
}
?>	
						</select>
						<select name="rest_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" selected>0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour" class="selectfm">
							<option value=""></option>
<?
for($i=0;$i<24;$i++) {
	if($i<10) $k = "0".$i;
	else $k = $i;
	if($i==13) $selected_rest_ehour[$i] = "selected";
	else $selected_rest_ehour[$i] = "";
?>
								<option value="<?=$k?>" <?=$selected_rest_ehour[$i]?>><?=$i?></option>
<?
}
?>		
						</select>
						<select name="rest_emin" class="selectfm">
							<option value=""></option>
<?
for($i=0;$i<=50;$i+=10) {
	if($i<10) $k = "0".$i;
	else $k = $i;
	if($i==0) $selected_rest_emin[$i] = "selected";
?>
							<option value="<?=$k?>" <?=$selected_rest_emin[$i]?>><?=$i?></option>
<?
}
?>
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour2" class="selectfm">
							<option value=""></option>
<?
for($i=0;$i<24;$i++) {
	if($i<10) $k = "0".$i;
	else $k = $i;
?>
								<option value="<?=$k?>" ><?=$i?></option>
<?
}
?>		
						</select>
						<select name="rest_smin2" class="selectfm">
							<option value=""></option>
<?
for($i=0;$i<=50;$i+=10) {
	if($i<10) $k = "0".$i;
	else $k = $i;
?>
							<option value="<?=$k?>" ><?=$i?></option>
<?
}
?>
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour2" class="selectfm">
							<option value=""></option>
<?
for($i=0;$i<24;$i++) {
	if($i<10) $k = "0".$i;
	else $k = $i;
?>
								<option value="<?=$k?>" ><?=$i?></option>
<?
}
?>
						</select>
						<select name="rest_emin2" class="selectfm">
							<option value=""></option>
<?
for($i=0;$i<=50;$i+=10) {
	if($i<10) $k = "0".$i;
	else $k = $i;
?>
							<option value="<?=$k?>" ><?=$i?></option>
<?
}
?>
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour3" class="selectfm">
							<option value=""></option>
<?
for($i=0;$i<24;$i++) {
	if($i<10) $k = "0".$i;
	else $k = $i;
?>
								<option value="<?=$k?>" ><?=$i?></option>
<?
}
?>		
						</select>
						<select name="rest_smin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour3" class="selectfm">
							<option value=""></option>
<?
for($i=0;$i<24;$i++) {
	if($i<10) $k = "0".$i;
	else $k = $i;
?>
								<option value="<?=$k?>" ><?=$i?></option>
<?
}
?>		
						</select>
						<select name="rest_emin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>

				<tr>
					<td class="tdrow">��
<input type="hidden" name="work_gbn" value="D">
<input type="hidden" name="week_day" value="7">
					</td>
					<td class="tdrow">
						<select name="workday_gbn" class="selectfm">
							<option value=""></option>
							<option value="01" >�ٹ���</option>
							<option value="02" >��������</option>
							<option value="03" selected>��������</option>
							<option value="04" >�����޹���</option>
						</select>
					</td>
					<td class="tdrow">
						<select name="work_shour" class="selectfm">
							<option value=""></option>
<?
for($i=0;$i<24;$i++) {
	if($i<10) $k = "0".$i;
	else $k = $i;
?>
								<option value="<?=$k?>" ><?=$i?></option>
<?
}
?>		
						</select>
						<select name="work_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="work_ehour" class="selectfm">
							<option value=""></option>
<?
for($i=0;$i<24;$i++) {
	if($i<10) $k = "0".$i;
	else $k = $i;
?>
								<option value="<?=$k?>" ><?=$i?></option>
<?
}
?>		
						</select>
						<select name="work_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour" class="selectfm">
							<option value=""></option>
<?
for($i=0;$i<24;$i++) {
	if($i<10) $k = "0".$i;
	else $k = $i;
?>
								<option value="<?=$k?>" ><?=$i?></option>
<?
}
?>		
						</select>
						<select name="rest_smin" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour" class="selectfm">
							<option value=""></option>
<?
for($i=0;$i<24;$i++) {
	if($i<10) $k = "0".$i;
	else $k = $i;
?>
								<option value="<?=$k?>" ><?=$i?></option>
<?
}
?>		
						</select>
						<select name="rest_emin" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour2" class="selectfm">
							<option value=""></option>
<?
for($i=0;$i<24;$i++) {
	if($i<10) $k = "0".$i;
	else $k = $i;
?>
								<option value="<?=$k?>" ><?=$i?></option>
<?
}
?>		
						</select>
						<select name="rest_smin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour2" class="selectfm">
							<option value=""></option>
<?
for($i=0;$i<24;$i++) {
	if($i<10) $k = "0".$i;
	else $k = $i;
?>
								<option value="<?=$k?>" ><?=$i?></option>
<?
}
?>		
						</select>
						<select name="rest_emin2" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_shour3" class="selectfm">
							<option value=""></option>
<?
for($i=0;$i<24;$i++) {
	if($i<10) $k = "0".$i;
	else $k = $i;
?>
								<option value="<?=$k?>" ><?=$i?></option>
<?
}
?>		
						</select>
						<select name="rest_smin3" class="selectfm">
							<option value=""></option>
							
								<option value="00" >0</option>
							
								<option value="10" >10</option>
							
								<option value="20" >20</option>
							
								<option value="30" >30</option>
							
								<option value="40" >40</option>
							
								<option value="50" >50</option>
							
						</select>
					</td>
					<td class="tdrow">
						<select name="rest_ehour3" class="selectfm">
							<option value=""></option>
<?
for($i=0;$i<24;$i++) {
	if($i<10) $k = "0".$i;
	else $k = $i;
?>
								<option value="<?=$k?>" ><?=$i?></option>
<?
}
?>							
						</select>
						<select name="rest_emin3" class="selectfm">
							<option value=""></option>
						
							<option value="00" >0</option>
						
							<option value="10" >10</option>
						
							<option value="20" >20</option>
						
							<option value="30" >30</option>
						
							<option value="40" >40</option>
						
							<option value="50" >50</option>
						
						</select>
					</td>
			</table>
			<div style="height:2px;font-size:0px"></div>
			<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
				<tr>
					<td class="tdhead_center">1�� �����ٷνð�</td>
					<td class="tdhead_center">1�� �����ٷνð�</td>
					<td class="tdhead_center">1�� ����ٷνð�</td>
					<td class="tdhead_center">1�� ���ϱٷνð�</td>
					<td class="tdhead_center">1�� �߰��ٷνð�</td>
				</tr>
				<tr>
					<td class="tdrow_center"><input type="text" name="d_workhour_day_d" style="width:50px;background:bbbbbb;" value="" readonly></td>
					<td class="tdrow_center"><input type="text" name="d_workhour_day_w" style="width:50px;background:bbbbbb;" value="" readonly></td>
					<td class="tdrow_center"><input type="text" name="d_workhour_ext_w" style="width:50px;background:bbbbbb;" value="" readonly></td>
					<td class="tdrow_center"><input type="text" name="d_workhour_hday_w" style="width:50px;background:bbbbbb;" value="" readonly></td>
					<td class="tdrow_center"><input type="text" name="d_workhour_night_w" style="width:50px;background:bbbbbb;" value="" readonly></td>
				</tr>
			</table>
			<script>
			checkWorkGbn('D',false);
			</script>

			<div style="height:5px;font-size:0px"></div>
			<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layput:fixed">
				<tr>
					<td align="center">
						<table border=0 cellpadding=0 cellspacing=0 style=display:inline;>   <tr>     <td width=2></td>      <td><img src=./images/btn_lt.gif></td>      <td background=./images/btn_bg.gif class=ftbutton1 nowrap><a href="javascript:self.close();" target="">�� ��</a></td>      <td><img src=./images/btn_rt.gif></td>     <td width=2></td>    </tr>  </table> 
					</td>
				</tr>
			</table>
			<div style="height:20px;font-size:0px"></div>
			<!--��޴� -->
			<!-- �Է��� -->
		</td>
	</tr>
</table>
</form>
</body>
</html>