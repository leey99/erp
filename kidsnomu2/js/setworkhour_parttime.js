//�ñ���
function setWorkHour_Parttime( type ){
	var money_min_time = 4860;
	if(type==undefined) type = "";

	var workday_month = toInt(document.dataForm.workday_month.value); // �Ϲ����� 1���� �ٹ��ϼ�
	var workday_week = workday_month / 4 ; // �Ϲ����� �ְ� �ٷ��ϼ�

	var emp5_gbn = "";
	var rate_ext, rate_hday, rate_night;
	if( emp5_gbn == "1" ){ // 5������
		rate_ext = 1;
		rate_hday = 1;
		rate_night = 1;
	}else{
		rate_ext = 1.5;
		rate_hday = 1.5;
		rate_night = 0.5;
	}

	var f = document.formSalary; /////////////////////
	var money_hour; // ���ؽñ޾� ////////////////////////////
	var money_month, money_g1, money_g2, money_g3;
	var workhour_day_d;
	var workhour_day, workhour_ext, workhour_hday, workhour_night, workhour_total, workhour_total2, workhour_total3;
	var workhour_day_w, workhour_ext_w, workhour_hday_w, workhour_night_w, workhour_total_w, workhour_total2_w, workhour_total3_w;

	//money_month = toInt(f.money_month.value); // �⺻����
	money_hour = toInt( f.money_hour.value ); // ���ؽñ޾�
	money_g1 = toInt(f.money_g1.value); // ����������1
	money_g2 = toInt(f.money_g2.value); // ����������2
	money_g3 = toInt(f.money_g3.value); // ����������3

	if( f.check_worktime_yn.checked ) { // �����Է�
		workhour_day_d = toFloat(f.workhour_day_d.value);
		workhour_day_w = toFloat(f.workhour_day_w.value);
		workhour_ext_w = toFloat(f.workhour_ext_w.value);
		workhour_hday_w = toFloat(f.workhour_hday_w.value);
		workhour_night_w = toFloat(f.workhour_night_w.value);

		//workhour_day_w = workhour_day_d * workday_week;
		f.workhour_day_w.value = workhour_day_w;

		workhour_day = toFloat(f.workhour_day.value);
		workhour_ext = toFloat(f.workhour_ext.value);
		workhour_hday = toFloat(f.workhour_hday.value);
		workhour_night = toFloat(f.workhour_night.value);
	}else{
		workhour_day_d = toFloat(f.workhour_day_d.value);

		workhour_day_w = toFloat(f.workhour_day_w.value);
		workhour_ext_w = toFloat(f.workhour_ext_w.value);
		workhour_hday_w = toFloat(f.workhour_hday_w.value);
		workhour_night_w = toFloat(f.workhour_night_w.value);
		workhour_total_w = 0;

		//var workhour_day_d_limit = workhour_day_d; // 1�ϼ����ٷνð� max 8 �� ����
		//if( workhour_day_d_limit > 8 ) workhour_day_d_limit = 8;

		if( type == "base" ){
			//workhour_day_w = workhour_day_d * workday_week;
			f.workhour_day_w.value = workhour_day_w;

			workhour_day = parseInt( workhour_day_w * 4.3452 *10 ) / 10;
			f.workhour_day.value = workhour_day;
		}else if( type == "day" ){
			workhour_day = parseInt( workhour_day_w * 4.3452 *10 ) / 10;
			f.workhour_day.value = workhour_day;
		}else if( type == "ext" ){
			workhour_ext = parseInt( workhour_ext_w * 4.3452 *10 ) / 10;
			f.workhour_ext.value = workhour_ext;
		}else if( type == "hday" ){
			workhour_hday = parseInt( workhour_hday_w * 4.3452 *10 ) / 10;
			f.workhour_hday.value = workhour_hday;
		}else if( type == "night" ){
			workhour_night = parseInt( workhour_night_w * 4.3452 *10 ) / 10;
			f.workhour_night.value = workhour_night;
		}else if( type == "all" ){
			workhour_day = parseInt( workhour_day_w * 4.3452 *10 ) / 10;
			f.workhour_day.value = workhour_day;

			workhour_ext = parseInt( workhour_ext_w * 4.3452 *10 ) / 10;
			f.workhour_ext.value = workhour_ext;

			workhour_hday = parseInt( workhour_hday_w * 4.3452 *10 ) / 10;
			f.workhour_hday.value = workhour_hday;

			workhour_night = parseInt( workhour_night_w * 4.3452 *10 ) / 10;
			f.workhour_night.value = workhour_night;
		}
		workhour_day = toFloat(f.workhour_day.value);
		workhour_ext = toFloat(f.workhour_ext.value);
		workhour_hday = toFloat(f.workhour_hday.value);
		workhour_night = toFloat(f.workhour_night.value);
	}

	//�ѱٷνð�
	workhour_total = parseInt( ( workhour_day + workhour_ext + workhour_hday ) * 1000 ) / 1000; // �߰��ٷμ��� ���� -----------
	workhour_total_w = parseInt( ( workhour_day_w + workhour_ext_w + workhour_hday_w + workhour_night_w ) * 1000 ) / 1000;

	//�ѱٷνð�(�ٷΰ�༭��)
	workhour_total2 = parseInt( ( workhour_day + workhour_ext + workhour_hday ) * 1000 ) / 1000;
	workhour_total2_w = parseInt( ( workhour_day_w + workhour_ext_w + workhour_hday_w ) * 1000 ) / 1000;

	//�ѱٷνð�(�ӱݻ����)
	workhour_total3 = parseInt( ( workhour_day + workhour_ext*rate_ext + workhour_hday*rate_hday + workhour_night*rate_night ) * 1000 ) / 1000;
	workhour_total3_w = parseInt( ( workhour_day_w + workhour_ext_w*rate_ext + workhour_hday_w*rate_hday + workhour_night_w*rate_night ) * 1000 ) / 1000;

	// ����ӱ�(�ð���) = ���ؽñ޾� + (������������ / 1���� �����ٷνð�) 
	money_hour_ts = money_hour + ( (money_g1+money_g2+money_g3) / workhour_day );
	if( isNaN(money_hour_ts) ) money_hour_ts = 0;

	// ����ӱ�(�ϱ�) = ���ؽñ޾� + (������������ / 1���� �����ٷνð�) 
	money_hour_ds = money_hour + ( (money_g1+money_g2+money_g3) / workhour_day );
	if( isNaN(money_hour_ds) ) money_hour_ds = 0;

	//�����ӱ�(1�ð�) ����
	//alert(money_min_time);
	if(money_hour_ts < money_min_time) {
		//f.money_hour_ts.style.color = "red";
		//alert(money_hour_ts);
	}

	f.workhour_total.value = workhour_total;
	f.workhour_total_w.value = workhour_total_w;

	f.workhour_total2.value = workhour_total2;
	f.workhour_total2_w.value = workhour_total2_w;

	f.workhour_total3.value = workhour_total3;
	f.workhour_total3_w.value = workhour_total3_w;

	f.money_hour_ts.value = money_hour_ts;
	f.money_hour_ts_view.value = setComma( parseInt(money_hour_ts) );

	//�⺻�ϱ� õ���� �޸�
	//f.money_hour_ds_view.value = setComma( parseInt(money_hour_ds) );

	// �ּ��ӱ� ���رݾ�
	f.money_min.value = setComma( toInt(workhour_total3 * money_min_time) );

	var money_base = 0; // �⺻��
	var money_ext = 0; // ����ٷμ���
	var money_hday = 0; // ���ϱٷμ���
	var money_night = 0; // �߰��ٷμ���
	money_base = Math.round( money_hour * workhour_day );
	money_ext = Math.round( money_hour_ts * rate_ext * workhour_ext );
	money_hday = Math.round( money_hour_ts * rate_hday * workhour_hday );
	money_night = Math.round( money_hour_ts * rate_night * workhour_night );

	f.money_base.value = setComma( money_base );
	f.money_ext.value = setComma( money_ext );
	f.money_hday.value = setComma( money_hday );
	f.money_night.value = setComma( money_night );
}