<?
//�Ϲ� Type
?>
<script language="javascript">
// ���� �˻� Ȯ��
function del(page,id) 
{
	if(confirm("�����Ͻðڽ��ϱ�?")) {
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

	for(i=1;i<=<?=$total_count?>;i++) {
		//alert(f.emp_name[i].value);
		k = i-1;
		//alert(f.workhour_day[i].value);
		f["pay_gbn_"+k].value = f.pay_gbn[i].value;

		f["w_1_"+k].value = f.workhour_1[i].value;
		f["w_2_"+k].value = f.workhour_2[i].value;
		f["w_3_"+k].value = f.workhour_3[i].value;
		f["w_1_hday_"+k].value = f.workhour_1_hday[i].value;
		f["w_2_hday_"+k].value = f.workhour_2_hday[i].value;
		f["w_3_hday_"+k].value = f.workhour_3_hday[i].value;
		f["w_edu_"+k].value = f.workhour_edu[i].value;
		f["w_phone_"+k].value = f.workhour_phone[i].value;

		f["w_day_"+k].value = f.workhour_day[i].value;
		f["w_ext_"+k].value = f.workhour_ext[i].value;
		f["w_night_"+k].value = f.workhour_night[i].value;
		f["w_hday_"+k].value = f.workhour_hday[i].value;

		f["w_ext_add_"+k].value = f.workhour_ext_add[i].value;
		f["w_night_add_"+k].value = f.workhour_night_add[i].value;
		f["w_hday_add_"+k].value = f.workhour_hday_add[i].value;
		//alert(f["w_night_add_"+k].value);

		f["w_late_"+k].value = f.workhour_late[i].value;
		f["w_leave_"+k].value = f.workhour_leave[i].value;
		f["w_out_"+k].value = f.workhour_out[i].value;
		f["w_absence_"+k].value = f.workhour_absence[i].value;

		f["workhour_total_"+k].value = f.workhour_total[i].value;
		//alert(f["workhour_total_"+k].value);



		f["money_hour_ds_"+k].value = f.money_hour_ds[i].value;
		//alert(f["money_hour_ds_"+k].value);
		f["money_hour_ts_"+k].value = f.money_hour_ts[i].value;
		//�⺻�ñ�
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

		f["yun_"+k].value = f.money_yun[i].value;
		f["health_"+k].value = f.money_health[i].value;
		f["yoyang_"+k].value = f.money_yoyang[i].value;
		f["goyong_"+k].value = f.money_goyong[i].value;

		f["c_yun_"+k].value = f.c_money_yun[i].value;
		f["c_health_"+k].value = f.c_money_health[i].value;
		f["c_yoyang_"+k].value = f.c_money_yoyang[i].value;
		f["c_goyong_"+k].value = f.c_money_goyong[i].value;
		f["c_sanjae_"+k].value = f.c_money_sanjae[i].value;
		//if(i == 55) alert(f["c_sanjae_"+k].value+" "+k);
		f["c_money_gongje_"+k].value = f.c_money_gongje[i].value;
		f["retirement_pension_"+k].value = f.retirement_pension[i].value;

		//f["end_pay_"+k].value = f.end_pay[i].value;
		f["minus_"+k].value = f.minus[i].value;
		f["minus2_"+k].value = f.minus2[i].value;
		f["etc_"+k].value = f.etc[i].value;
		f["etc2_"+k].value = f.etc2[i].value;

		f["money_total_"+k].value = f.money_total[i].value;
		//if(i == 56) alert(f["money_total_"+k].value+" "+k);
		f["money_for_tax_"+k].value = f.money_for_tax[i].value;
		f["money_gongje_"+k].value = f.money_gongje[i].value;
		f["money_result_"+k].value = f.money_result[i].value;
	}

	f.mode.value = mode;
	f.action = "pay_update_type_h.php";
	f.submit();
}
//�޿��ݿ� �Է���
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
//2015�⵵ 7�� ���� �ٷμҵ� ���Ǽ���ǥ 150821
//if($search_year >= 2015 && $search_month >= 7) {
//2015�⵵ �ҵ� ����ǥ ���� ���� �缳�� 160226
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
function GetTax(money_for_tax, idx) {
	var f = document.dataForm;
	//alert(idx+" / "+f.family_cnt[idx].value);
	family_cnt = parseInt(f.family_cnt[idx].value)+parseInt(f.child_cnt[idx].value);
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
		if(family_cnt == 2) {
			tax = ary_tax2[i][2];
		} else if(family_cnt == 3) {
			tax = ary_tax3[i][2];
		} else if(family_cnt == 4) {
			tax = ary_tax4[i][2];
		} else if(family_cnt == 5) {
			tax = ary_tax5[i][2];
		} else if(family_cnt == 6) {
			tax = ary_tax6[i][2];
		} else if(family_cnt == 7) {
			tax = ary_tax7[i][2];
		} else if(family_cnt == 8) {
			tax = ary_tax8[i][2];
		} else if(family_cnt == 9) {
			tax = ary_tax9[i][2];
		} else if(family_cnt == 10) {
			tax = ary_tax10[i][2];
		} else if(family_cnt >= 11) {
			tax = ary_tax11[i][2];
		} else {
			tax = ary_tax[i][2];
		}
		//alert(smoney);
		if( money_base >= smoney && money_base < emoney ) {
			tax_result = tax;
			break;
		}
	}
	return tax_result;
}
function check_manual(m_name) {
	var frm = document.dataForm;
	var total_cnt = frm.total_cnt.value;
	for(i=1;i<=total_cnt;i++) {
		if(m_name.name == "manual_ext") {
			if(m_name.checked) frm.money_ext[i].className = "textfm";
			else frm.money_ext[i].className = "textfm5";
		} else if(m_name.name == "manual_night") {
			if(m_name.checked) frm.money_night[i].className = "textfm";
			else frm.money_night[i].className = "textfm5";
		} else if(m_name.name == "manual_hday") {
			if(m_name.checked) frm.money_hday[i].className = "textfm";
			else frm.money_hday[i].className = "textfm5";
/*
		} else if(m_name.name == "manual_4insure") {
			if(m_name.checked) {
				frm.money_yun[i].className = "textfm";
				frm.money_health[i].className = "textfm";
				frm.money_yoyang[i].className = "textfm";
				frm.money_goyong[i].className = "textfm";
			} else {
				frm.money_yun[i].className = "textfm5";
				frm.money_health[i].className = "textfm5";
				frm.money_yoyang[i].className = "textfm5";
				frm.money_goyong[i].className = "textfm5";
			}
		} else if(m_name.name == "manual_tax") {
			if(m_name.checked) {
				frm.tax_so[i].className = "textfm";
				frm.tax_jumin[i].className = "textfm";
			} else {
				frm.tax_so[i].className = "textfm5";
				frm.tax_jumin[i].className = "textfm5";
			}
*/
		}
	}
}
//���ο��� �����Է� üũ ���ο���(�����) �����Է� �ؽ�Ʈ ǥ�� �Լ� 151029
function check_manual_yun_func(m_name) {
	if(m_name.checked) getId('check_manual_yun_text').innerHTML = "(�����Է�)";
	else getId('check_manual_yun_text').innerHTML = "";
}
function money_month_fix_ft(obj) {
	var f = document.dataForm;
	//if(obj.checked) alert(obj.value);
	for( var i = 1; i<f.idx.length; i++ ) {
		if(obj.checked) {
			f.money_base[i].className = "textfm";
			f.money_base[i].readOnly = false;
		} else  {
			f.money_base[i].className = "textfm5";
			f.money_base[i].readOnly = true;
		}
	}
}
function cal_pay2(idx){
	var f = document.dataForm;
	var workhour_1, workhour_2, workhour_3, workhour_1_hday, workhour_2_hday, workhour_3_hday, workhour_edu, workhour_phone;
	var money_month,money_hour,money_hour_ts,workhour_day, workhour_ext,workhour_night,workhour_hday,workhour_ext_add,workhour_night_add,workhour_hday_add,workhour_total;
	var money_base,money_ext,money_night,money_hday,money_ext_add,money_night_add,money_hday_add,money_year;
	var money_g1,money_g2,money_g3,money_g4,money_g5,money_e1,money_e2,money_e3,money_e4,money_e5,money_e6,money_e7,money_e8;
	var money_total,money_for_tax,money_yun,money_health,money_yoyang,money_goyong,tax_so,tax_jumin,minus,minus2,etc,etc2,money_gongje,money_result, workhour_year;
	var c_money_yun,c_money_health,c_money_yoyang,c_money_goyong,c_money_sanjae,c_money_gongje;
	money_month     = toInt(f.money_month   [idx].value);    //�⺻���� mm--        
	money_hour      = toInt(f.money_hour    [idx].value); 	//���ؽñ� hh--        
	money_hour_ts   = toInt(f.money_hour_ts [idx].value);	//����ӱ�(�ð���)     

	workhour_1    = toFloat(f.workhour_1  [idx].value);	//���Ǻ��� ���
	workhour_1_hday    = toFloat(f.workhour_1_hday  [idx].value);	//���Ǻ��� �޽�
	workhour_2    = toFloat(f.workhour_2  [idx].value);	//��⵵ ���
	workhour_2_hday    = toFloat(f.workhour_2_hday  [idx].value);	//��⵵ �޽�
	workhour_3    = toFloat(f.workhour_3  [idx].value);	//ȭ���� ���
	workhour_3_hday    = toFloat(f.workhour_3_hday  [idx].value);	//ȭ���� �޽�
	workhour_edu    = toFloat(f.workhour_edu  [idx].value);	//�����ð�
	workhour_phone    = toFloat(f.workhour_phone  [idx].value);	//����Ʈ��

	workhour_day    = toFloat(f.workhour_day  [idx].value);	//�����ٷνð�         
	workhour_ext    = toFloat(f.workhour_ext  [idx].value);	//����ٷνð�
	workhour_night  = toFloat(f.workhour_night[idx].value);	//�߰��ٷνð�         
	workhour_hday   = toFloat(f.workhour_hday [idx].value);	//���ϱٷνð�         

	workhour_ext_add    = toFloat(f.workhour_ext_add  [idx].value);	//�߰�����ٷνð�
	workhour_night_add    = toFloat(f.workhour_night_add  [idx].value);	//�߰��߰��ٷνð�
	workhour_hday_add    = toFloat(f.workhour_hday_add  [idx].value);	//�߰����ϱٷνð�

	workhour_total  = toFloat(f.workhour_total[idx].value);	//�ӱݻ��� �ѽð� mm-- 
	money_base      = toInt(f.money_base    [idx].value);	// �⺻��               
	money_ext       = toInt(f.money_ext     [idx].value);	// ����ٷμ���         
	money_hday      = toInt(f.money_hday    [idx].value);	// ���ϱٷμ���         
	money_night     = toInt(f.money_night   [idx].value);	// �߰��ٷμ���         
	money_year      = toInt(f.money_year    [idx].value);	// �������� hh--        

	money_ext_add   = toInt(f.money_ext_add [idx].value);	// ����ٷμ���(�߰�)     
	money_hday_add  = toInt(f.money_hday_add[idx].value);	// ���ϱٷμ���(�߰�)
	money_night_add = toInt(f.money_night_add[idx].value);	// �߰��ٷμ���(�߰�)

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
	money_total     = toInt(f.money_total   [idx].value);   //�ӱݰ�       
	money_for_tax   = toInt(f.money_for_tax [idx].value);	//�����ҵ�     
	money_yun       = toInt(f.money_yun     [idx].value);	//���ο���     
	money_health    = toInt(f.money_health  [idx].value);	//�ǰ�����     
	money_yoyang    = toInt(f.money_yoyang  [idx].value);	//����纸�� 
	money_goyong    = toInt(f.money_goyong  [idx].value);	//��뺸��     
	tax_so          = toInt(f.tax_so        [idx].value);	//�ҵ漼       
	tax_jumin       = toInt(f.tax_jumin     [idx].value);	//�ֹμ�       
	minus           = toInt(f.minus         [idx].value);	//��Ÿ����
	minus2          = toInt(f.minus2        [idx].value);	//��Ÿ����2
	etc           	= toInt(f.etc      	 	  [idx].value);	//����
	etc2          	= toInt(f.etc2      	  [idx].value);	//���°���
	money_gongje    = toInt(f.money_gongje  [idx].value);	//������
	//����(�����) �ڵ����(�����Է� ����) ���ο���,�ǰ�����,����� ���� 150910
	if(!f.c_manual_4insure.checked) {
		f.c_money_yun[idx].value = f.money_yun[idx].value;	//���ο���     
		f.c_money_health[idx].value = f.money_health[idx].value;	//�ǰ�����     
		f.c_money_yoyang[idx].value = f.money_yoyang[idx].value;	//����纸��
	}
	c_money_yun     = toInt(f.c_money_yun   [idx].value);	//���ο���     
	c_money_health  = toInt(f.c_money_health[idx].value);	//�ǰ�����     
	c_money_yoyang  = toInt(f.c_money_yoyang[idx].value);	//����纸�� 
	c_money_goyong  = toInt(f.c_money_goyong[idx].value);	//��뺸��     
	c_money_sanjae  = toInt(f.c_money_sanjae[idx].value);	//���纸��
	c_money_gongje  = toInt(f.c_money_gongje[idx].value);	//������
	money_result    = toInt(f.money_result  [idx].value);	//������ ���޾�
	//workhour_year   = toFloat(f.workhour_year  [idx].value);	//�����ް��ð� mm-- 

	//money_gongje ������ = ���ο���+�ǰ�����+����纸��+��뺸��+�ҵ漼+�ֹμ�
	money_gongje = money_yun+money_health+money_yoyang+money_goyong+tax_so+tax_jumin+minus+minus2;
	c_money_gongje = c_money_yun+c_money_health+c_money_yoyang+c_money_goyong+c_money_sanjae;

	//money_result ������ ���޾� 
	money_result = money_total - money_gongje;
	f.money_gongje[idx].value = number_format(money_gongje); //money_gongje ������ 
	f.c_money_gongje[idx].value = number_format(c_money_gongje); //c_money_gongje ������ 
	f.money_result[idx].value = number_format(money_result); //money_result ������ ���޾� 
}
function cal_pay3(idx) {
	var f = document.dataForm;
	var tax_so,tax_jumin;
	tax_so = toInt(f.tax_so[idx].value); //�ҵ漼
	//tax_jumin �ֹμ� 
	tax_jumin = parseInt(tax_so*0.1*0.1)*10;
	f.tax_jumin[idx].value = number_format(tax_jumin);
	cal_pay2(idx); // ������ ���޾� ����
}
function focusClickClass(idx) {
	var frm = document.dataForm;
	//alert(f.idx[idx].checked);
	if(frm.idx[idx].checked == true) {
		focusInClass(idx);
	} else {
		focusOutClass(idx);
	}
}
function focusInClass(idx) {
	var frm = document.dataForm;
	//frm.emp_pname[idx].className = "textfm_trans";
	frm.money_month[idx].className = "textfm_trans";

	frm.workhour_1[idx].className = "textfm_trans";
	frm.workhour_2[idx].className = "textfm_trans";
	frm.workhour_3[idx].className = "textfm_trans";
	frm.workhour_1_hday[idx].className = "textfm_trans";
	frm.workhour_2_hday[idx].className = "textfm_trans";
	frm.workhour_3_hday[idx].className = "textfm_trans";
	frm.workhour_edu[idx].className = "textfm_trans";
	frm.workhour_phone[idx].className = "textfm_trans";

	frm.workhour_day[idx].className = "textfm_trans";
	frm.workhour_ext[idx].className = "textfm_trans";
	frm.workhour_night[idx].className = "textfm_trans";
	frm.workhour_hday[idx].className = "textfm_trans";

	frm.workhour_late[idx].className = "textfm_trans";
	frm.workhour_leave[idx].className = "textfm_trans";
	frm.workhour_out[idx].className = "textfm_trans";
	frm.workhour_absence[idx].className = "textfm_trans";

	frm.workhour_total[idx].className = "textfm_trans";

	frm.money_hour_ts[idx].className = "textfm_trans";
	frm.money_time[idx].className = "textfm_trans";

	if(frm.money_month_fix.checked) {
		frm.money_base[idx].className = "textfm_trans";
	} else {
		frm.money_base[idx].className = "textfm5";
	}

	frm.money_ext[idx].className = "textfm_trans";
	frm.money_night[idx].className = "textfm_trans";
	frm.money_hday[idx].className = "textfm_trans";

	frm.money_ext_add[idx].className = "textfm_trans";
	frm.money_hday_add[idx].className = "textfm_trans";
	frm.money_night_add[idx].className = "textfm_trans";
	frm.money_year[idx].className = "textfm_trans";

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
	frm.minus2[idx].className = "textfm_trans";
	frm.etc[idx].className = "textfm_trans";
	frm.etc2[idx].className = "textfm_trans";
	frm.money_gongje[idx].className = "textfm_trans";
	frm.c_money_yun[idx].className = "textfm_trans";
	frm.c_money_health[idx].className = "textfm_trans";
	frm.c_money_yoyang[idx].className = "textfm_trans";
	frm.c_money_goyong[idx].className = "textfm_trans";
	frm.c_money_sanjae[idx].className = "textfm_trans";
	frm.c_money_gongje[idx].className = "textfm_trans";
	frm.retirement_pension[idx].className = "textfm_trans";
	frm.money_result[idx].className = "textfm_trans";
	//frm.workhour_year[idx].className = "textfm_trans";
}
function focusOutClass(idx) {
	var frm = document.dataForm;
	if(frm.idx[idx].checked == false) {
		//frm.emp_pname[idx].className = "textfm";
		frm.money_month[idx].className = "textfm";

		frm.workhour_1[idx].className = "textfm";
		frm.workhour_2[idx].className = "textfm";
		frm.workhour_3[idx].className = "textfm";
		frm.workhour_1_hday[idx].className = "textfm";
		frm.workhour_2_hday[idx].className = "textfm";
		frm.workhour_3_hday[idx].className = "textfm";
		frm.workhour_edu[idx].className = "textfm";
		frm.workhour_phone[idx].className = "textfm";

		frm.workhour_day[idx].className = "textfm";
		frm.workhour_ext[idx].className = "textfm";
		frm.workhour_night[idx].className = "textfm";
		frm.workhour_hday[idx].className = "textfm";

		frm.workhour_late[idx].className = "textfm";
		frm.workhour_leave[idx].className = "textfm";
		frm.workhour_out[idx].className = "textfm";
		frm.workhour_absence[idx].className = "textfm";

		frm.workhour_total[idx].className = "textfm5";

		frm.money_hour_ts[idx].className = "textfm";
		frm.money_time[idx].className = "textfm";

		if(frm.money_month_fix.checked) {
			frm.money_base[idx].className = "textfm";
		} else {
			frm.money_base[idx].className = "textfm5";
		}

		if(frm.manual_ext.checked) frm.money_ext[idx].className = "textfm";
		else frm.money_ext[idx].className = "textfm5";
		if(frm.manual_night.checked) frm.money_night[idx].className = "textfm";
		else frm.money_night[idx].className = "textfm5";
		if(frm.manual_hday.checked) frm.money_hday[idx].className = "textfm";
		else frm.money_hday[idx].className = "textfm5";

		frm.money_ext_add[idx].className = "textfm";
		frm.money_hday_add[idx].className = "textfm";
		frm.money_night_add[idx].className = "textfm";
		frm.money_year[idx].className = "textfm";

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
		frm.minus2[idx].className = "textfm";
		frm.etc[idx].className = "textfm";
		frm.etc2[idx].className = "textfm5";
		frm.money_gongje[idx].className = "textfm5";
		frm.c_money_yun[idx].className = "textfm";
		frm.c_money_health[idx].className = "textfm";
		frm.c_money_yoyang[idx].className = "textfm";
		frm.c_money_goyong[idx].className = "textfm";
		frm.c_money_sanjae[idx].className = "textfm";
		frm.c_money_gongje[idx].className = "textfm5";
		frm.retirement_pension[idx].className = "textfm5";
		frm.money_result[idx].className = "textfm5";
		//frm.workhour_year[idx].className = "textfm";
	}
}
function printPaySome() {
	save_ok = "<?=$w_date_ok?>";
	if( save_ok == "" ) {
		alert("���� �� �̿��� �ּ���.");
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
		alert("����� ����� ������ �ּ���.");
		return;
	} else if(stristr(pay_no, ',')) {
		alert("�Ѹ� ������ �ּ���.");
		return;
	}
	//alert(pay_no);
	location.href = "pay_stubs.php?id="+pay_no+"&code=<?=$com_code?>&search_year="+f.search_year.value+"&search_month="+f.search_month.value;
}
function printPaySome_name(pay_no) {
	save_ok = "<?=$w_date_ok?>";
	if( save_ok == "" ) {
		alert("���� �� �̿��� �ּ���.");
		return;
	}
	var f = document.dataForm;
	//alert(pay_no);
	location.href = "pay_stubs.php?id="+pay_no+"&code=<?=$com_code?>&search_year="+f.search_year.value+"&search_month="+f.search_month.value;
}
function pay_preview() {
	//alert('�غ����Դϴ�.');
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
		alert("���� �� �̿��� �ּ���.");
		return;
	}
	frm = document.printForm;
	frm.mode.value = "salary_list";
	frm.target = "_blank";
	frm.action = "pay_ledger_beistand.php?code=<?=$com_code?>&search_year="+frm.search_year.value+"&search_month="+frm.search_month.value;
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

//number_format �Լ�
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
//õ���� �޹�
function checkThousand(inputVal, type, keydown) {		// inputVal�� õ������ , ǥ�ø� ���� �������� ��
	main = document.dataForm;			// ���⼭ type �� �ش��ϴ� ���� �ֱ� ���� ��ġ���� index
	var chk		= 0;				// chk �� õ������ ���� ���̸� check
	var share	= 0;				// share 200,000 �� ���� 3�� ����� ���� �����ϱ� ���� ����
	var start	= 0;
	var triple	= 0;				// triple 3, 6, 9 �� 3�� ��� 
	var end		= 0;				// start, end substring ������ ���� ����  
	var total	= "";			
	var input	= "";				// total ���Ƿ� string ���� �����ϱ� ���� ����
	//alert(event.keyCode);
	//�齺���̽� �� ����Ʈ+�� �� �� Del
	if(event.keyCode!=8 && event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=46) {
		if (inputVal.length > 3){
			input = delCom(inputVal, inputVal.length);
			/*
			for(i=0; i<inputVal.length; i++){
				if(inputVal.substring(i,i+1)!=','){		// ���� substring�� ����
					input += inputVal.substring(i,i+1);	// ���� ��� , �� ����
				}
			}*/
			chk = (input.length)/3;					// input ���� 3�Ƿ� ���� �� ���
			chk = Math.floor(chk);					// �� ������ �۰ų� ���� �� �� �ִ��� ���� ���
			share = (input.length)%3;				// 200,000 �� ���� 3�� ����� ���� �ɷ����� ���� ������ ���
			if (share == 0 ) {						
				chk = chk - 1;					// ���̰� 3�� ����� ���� ���� chk ���� �ϳ� ����.
			}
			for(i=chk; i>0; i--){
				triple = i * 3;					// 3�� ��� ��� 9,6,3 ��� ���� ������
				end = Number(input.length)-Number(triple);	// �� ���� end ���� ���� �þ� ���� �ȴ�.
				total += input.substring(start,end)+",";	// total�� �տ��� ���� ���ʷ� ���δ�.
				start = end;					// end ���� �������� start ������ ����.
			}
			total +=input.substring(start,input.length);		// ���������� ������ 3�ڸ� ���� �ڿ� ������.
		} else {
			total = inputVal;					// 3�� ����� �Ǳ� �������� ���� �״�� �����ȴ�.
		}
		if(keydown =='Y'){
			type.value=total;					// type �� ���� �������� �־� �ش�.
		}else if(keydown =='N'){
			return total
		}
		return total
	}
}
//õ���� �޹� (���� ���)
function checkThousand_negative(inputVal, type, keydown) {
	main = document.dataForm;
	var inputVal = type.value;
	var chk		= 0;
	var share	= 0;
	var start	= 0;
	var triple	= 0;
	var end		= 0;
	var total	= "";
	var input	= "";
	//alert(event.keyCode);
	//�齺���̽� �� ����Ʈ+�� �� �� Del
	if(event.keyCode!=8 && event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=46) {
		if (inputVal.length > 3) {
			input = delCom(inputVal, inputVal.length);
			chk = (input.length)/3;
			chk = Math.floor(chk);
			share = (input.length)%3;
			if (share == 0 ) chk = chk - 1;
			for(i=chk; i>0; i--) {
				triple = i * 3;
				end = Number(input.length)-Number(triple);
				total += input.substring(start,end)+",";
				start = end;
			}
			total +=input.substring(start,input.length);
		} else {
			total = inputVal;
		}
		type.value=total.replace(/\-,/g,"-");
	}
}
//õ���� ���̳ʽ� ��ȣ ���
function commify(n, type) {
	var reg = /(^[+-]?\d+)(\d{3})/;
	n += '';  // ���ڸ� ���ڿ��� ��ȯ
	while (reg.test(n)) n = n.replace(reg, '$1' + ',' + '$2');
	type.value=n;	
}
function delCom(inputVal, count){
	var tmp = "";
	for(i=0; i<count; i++){
		if(inputVal.substring(i,i+1)!=','){		// ���� substring�� ����
			tmp += inputVal.substring(i,i+1);	// ���� ��� , �� ����
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
function month_middle_cal(idx,end_day,work_day) {
	var f = document.dataForm;
	if(confirm("���� ��� �Ͻðڽ��ϱ�?")) {
		//
		money_month = toInt(f.money_month[idx].value);
		money_month_var = (money_month / end_day) * work_day;
		f.money_month[idx].value = number_format(Math.floor(money_month_var/10)*10);
		//�ٷνð�
		workhour_day = toInt(f.workhour_day[idx].value);
		workhour_day_var = (workhour_day / end_day) * work_day;
		alert("("+workhour_day+" / "+end_day+") * "+work_day);
		f.workhour_day[idx].value = Math.ceil(workhour_day_var);
		workhour_ext = toInt(f.workhour_ext[idx].value);
		workhour_ext_var = (workhour_ext / end_day) * work_day;
		f.workhour_ext[idx].value = (workhour_ext_var).toFixed(2);
		workhour_night = toInt(f.workhour_night[idx].value);
		workhour_night_var = (workhour_night / end_day) * work_day;
		f.workhour_night[idx].value = (workhour_night_var).toFixed(2);
		workhour_hday = toInt(f.workhour_hday[idx].value);
		workhour_hday_var = (workhour_hday / end_day) * work_day;
		f.workhour_hday[idx].value = (workhour_hday_var).toFixed(2);
		//����ӱݼ���
		money_g1 = toInt(f.money_g1[idx].value);
		money_g1_var = (money_g1/end_day) * work_day;
		f.money_g1[idx].value = number_format(Math.floor(money_g1_var/10)*10);
		money_g2 = toInt(f.money_g2[idx].value);
		money_g2_var = (money_g2/end_day) * work_day;
		f.money_g2[idx].value = number_format(Math.floor(money_g2_var/10)*10);
		money_g3 = toInt(f.money_g3[idx].value);
		money_g3_var = (money_g3/end_day) * work_day;
		f.money_g3[idx].value = number_format(Math.floor(money_g3_var/10)*10);
		money_g4 = toInt(f.money_g4[idx].value);
		money_g4_var = (money_g4/end_day) * work_day;
		f.money_g4[idx].value = number_format(Math.floor(money_g4_var/10)*10);
		money_g5 = toInt(f.money_g5[idx].value);
		money_g5_var = (money_g5/end_day) * work_day
		f.money_g5[idx].value = number_format(Math.floor(money_g5_var/10)*10);
		//��Ÿ����
		money_e1 = toInt(f.money_e1[idx].value);
		money_e1_var = (money_e1/end_day) * work_day;
		f.money_e1[idx].value = number_format(Math.floor(money_e1_var/10)*10);
		money_e2 = toInt(f.money_e2[idx].value);
		money_e2_var = (money_e2/end_day) * work_day;
		f.money_e2[idx].value = number_format(Math.floor(money_e2_var/10)*10);
		money_e3 = toInt(f.money_e3[idx].value);
		money_e3_var = (money_e3/end_day) * work_day;
		f.money_e3[idx].value = number_format(Math.floor(money_e3_var/10)*10);
		money_e4 = toInt(f.money_e4[idx].value);
		money_e4_var = (money_e4/end_day) * work_day;
		f.money_e4[idx].value = number_format(Math.floor(money_e4_var/10)*10);
		money_e5 = toInt(f.money_e5[idx].value);
		money_e5_var = (money_e5/end_day) * work_day;
		f.money_e5[idx].value = number_format(Math.floor(money_e5_var/10)*10);
		money_e6 = toInt(f.money_e6[idx].value);
		money_e6_var = (money_e6/end_day) * work_day;
		f.money_e6[idx].value = number_format(Math.floor(money_e6_var/10)*10);
		money_e7 = toInt(f.money_e7[idx].value);
		money_e7_var = (money_e7/end_day) * work_day;
		f.money_e7[idx].value = number_format(Math.floor(money_e7_var/10)*10);
		money_e8 = toInt(f.money_e8[idx].value);
		money_e8_var = (money_e8/end_day) * work_day;
		f.money_e8[idx].value = number_format(Math.floor(money_e8_var/10)*10);
		cal_pay(idx);
	} else {
		return;
	}
}
//���ڸ� �Է� ('-' ����)
function onlyNumber_negative() {
	//alert(event.keyCode);
	if(((event.keyCode<48)||(event.keyCode>57)) && event.keyCode !=13 && event.keyCode !=45) {
		event.returnValue=false;
		alert("���ڿ� ������ �Է��� �� �ֽ��ϴ�.");
	}
}
</script>
<? include "./inc/top.php"; ?>
<?
if($member[mb_id] == "master") {
?>
<div id="content" style="padding:20px">
	�Ϲ� ����� �α��ν� �̿� �����մϴ�.
</div>
<?
	exit;
}
?>
<div id="content">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="1200" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top" width="270">
<?
if($comp_print_type == "N") {
	include "./inc/left_menu4_type_n.php";
} else if($comp_print_type == "H") {
	include "./inc/left_menu4_type_h.php";
} else {
	include "./inc/left_menu4.php";
}
include "./inc/left_banner.php";
?>
						</td>
						<td valign="top" style="padding:10px 10px 10px 10px">
							<!--Ÿ��Ʋ -->
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
<?
include "./inc/pay_list_include_h.php";
?>
								<!--����Ʈ -->
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
													<td nowrap class="tdhead_center">�̸�</td>
													<td nowrap class="tdhead_center">�Ի���</td>
													<td nowrap class="tdhead_center">����</td>
												</tr>
											</table>
										</td>
										<td nowrap class="tdhead_center" valign="top">
<?
//����ӱ�
$sql_g = " select * from com_paycode_list where com_code = '$com_code' and item='trade' ";
//echo $sql_g;
$result_g = sql_query($sql_g);
for($i=0; $row_g=sql_fetch_array($result_g); $i++) {
	$g_code = $row_g[code];
	$money_g_txt[$g_code] = $row_g[name];
	//echo $g_code;
}
//��Ÿ����
$sql_e = " select * from com_paycode_list where com_code = '$com_code' and item='privilege' ";
$result_e = sql_query($sql_e);
for($i=0; $row_e=sql_fetch_array($result_e); $i++) {
	$e_code = $row_e[code];
	$money_e_txt[$e_code] = $row_e[name];
	//�ӱ����Կ���
	$money_e_gy[$e_code] = $row_e[gy_yn];
	//�������Կ���
	$money_e_income[$e_code] = $row_e[income];
}
//�����Է�
$sql_manual = " select * from pibohum_base_pay_h where com_code='$com_code' and year = '$search_year' and month = '$search_month' and w_date != '0000-00-00' order by manual desc ";
//echo $sql_manual;
$row_manual = sql_fetch($sql_manual);
//echo "//����".$row_manual[manual];
$manual_array = explode(",",$row_manual['manual']);
if($manual_array[0] == "1") $check_manual_ext = "checked";
if($manual_array[1] == "1") $check_manual_night = "checked";
if($manual_array[2] == "1") $check_manual_hday = "checked";
if($manual_array[3] == "1") $check_manual_4insure = "checked";
if($manual_array[4] == "1") $check_manual_tax = "checked";
if($manual_array[5] == "1") $check_c_manual_4insure = "checked";
if($manual_array[6] == "1") $check_manual_yun = "checked";
//������ �����Է� ����
if($data == "load") {
	$check_manual_4insure = "";
	$check_manual_tax = "";
	$check_c_manual_4insure = "";
	$check_manual_yun = "";
}
//�⺻�� ����
$sql_money_month = " select * from pibohum_base_pay_h where com_code='$com_code' and year = '$search_year' and month = '$search_month' and w_date != '0000-00-00' order by w_date desc, w_time desc ";
$row_money_month = sql_fetch($sql_money_month);
if($row_money_month['money_month_fix'] == "Y") $check_money_month_fix = "checked";
//type h ���Ǻ���, ��⵵, ȭ����(���,�޽�), �����ð�, ����Ʈ��
/*
$sql_opt2 = " select * from com_list_gy_opt2 where com_code='$com_code' ";
$result_opt2 = sql_query($sql_opt2);
$row_opt2 = mysql_fetch_array($result_opt2);
$money_time_edu = $row_opt2['money_time_edu'];
$money_time_phone = $row_opt2['money_time_phone'];
*/
//�ð��� �޿� �ܰ� ���� DB
$start_date = $search_year.".".$search_month.".01";
$end_date = $search_year.".".$search_month.".31";
$where_time = " and end_date >= '$start_date' and start_date <= '$end_date' ";
$sql_time = " select * from com_list_gy_time where com_code='$com_code' $where_time ";
//echo $sql_time;
$result_time = sql_query($sql_time);
$row_time = mysql_fetch_array($result_time);
//type h ���Ǻ���, ��⵵, ȭ����(���,�޽�), �����ð�, ����Ʈ��
$money_time1 = $row_time['money_time1'];
$money_time1_hday = $row_time['money_time1_hday'];
$money_time2 = $row_time['money_time2'];
$money_time2_hday = $row_time['money_time2_hday'];
$money_time3 = $row_time['money_time3'];
$money_time3_hday = $row_time['money_time3_hday'];
$money_time1_com = $row_time['money_time1_com'];
$money_time1_hday_com = $row_time['money_time1_hday_com'];
$money_time2_com = $row_time['money_time2_com'];
$money_time2_hday_com = $row_time['money_time2_hday_com'];
$money_time3_com = $row_time['money_time3_com'];
$money_time3_hday_com = $row_time['money_time3_hday_com'];
$money_time_edu = $row_time['money_time_edu'];
$money_time_phone = $row_time['money_time_phone'];
//echo "money_time1 : ".$money_time1;
//�Է��� ����
$pay_list_width = 2130;
?>
											<input type="checkbox" name="money_month_fix" <?=$check_money_month_fix?> value="Y" style="display:none;">
											<input type="checkbox" name="manual_ext" <?=$check_manual_ext?> value="1" title="�����Է�" style="display:none;">
											<input type="checkbox" name="manual_night" <?=$check_manual_night?> value="1" title="�����Է�" style="display:none;">
											<input type="checkbox" name="manual_hday" <?=$check_manual_hday?> value="1" title="�����Է�" style="display:none;">
											<div id="spanTop" style="width:100%;overflow:hidden">
												<table cellpadding=0 cellspacing=0 border=0>
													<tr>
														<td>  
															<table width="<?=$pay_list_width?>" border="0" cellpadding="0" cellspacing="1" class="bgtable">
																<tr>
																	<td class="tdhead_center" rowspan="3" width="45" style="height:85px;">����</td>
																	<td class="tdhead_center" colspan="10">�ٷνð�(��) </td>
																	<td class="tdhead_center" rowspan="3" width="18"></td>
																	<td class="tdhead_center" colspan="2">�ӱ��հ�</td>
																	<td class="tdhead_center" colspan="8">����(�ٷ���)</td>
																	<td class="tdhead_center" rowspan="3" width="74">������<br>���޾� </td>
																	<td class="tdhead_center" rowspan="3" width="18"></td>
																	<td class="tdhead_center" colspan="6">����(�����)</td>
																	<td class="tdhead_center" rowspan="3" width="98">��������</td>
																	<td class="tdhead_center" rowspan="3" width="18"></td>
																</tr>
																<tr>
																	<td class="tdhead_center" colspan="2">���Ǻ���</td>
																	<td class="tdhead_center" colspan="2">��⵵</td>
																	<td class="tdhead_center" colspan="2">ȭ����</td>
																	<td class="tdhead_center" rowspan="2" width="63">�����ð�<br><?=number_format($money_time_edu)?></td>
																	<td class="tdhead_center" rowspan="2" width="64">����Ʈ��<br><?=number_format($money_time_phone)?></td>
																	<td class="tdhead_center" rowspan="2" width="65">����<br>������</td>
																	<td class="tdhead_center" rowspan="2" width="63">��<br>�ٷνð�</td>
																	<td class="tdhead_center" rowspan="2" width="67">����<br>�̿�ݾ�</td>
																	<td class="tdhead_center" rowspan="2" width="67">�޿�</td>
																	<td class="tdhead_center" colspan="4"><input type="checkbox" name="manual_4insure" <?=$check_manual_4insure?> onclick="check_manual(this);" value="1" title="�����Է�" style="vertical-align:middle;"> 4�뺸��</td>
																	<td class="tdhead_center" colspan="2"><input type="checkbox" name="manual_tax" <?=$check_manual_tax?> onclick="check_manual(this);" value="1" title="�����Է�" style="vertical-align:middle;"> ����</td>
																	<td class="tdhead_center" colspan="1">��Ÿ</td>
																	<td class="tdhead_center" rowspan="2" width="72">������</td>

																	<td class="tdhead_center" colspan="5"><input type="checkbox" name="c_manual_4insure" <?=$check_c_manual_4insure?> onclick="check_manual(this);" value="1" title="�����Է�" style="vertical-align:middle;"> 4�뺸��</td>
																	<td class="tdhead_center" rowspan="2" width="98">������</td>
																</tr>
																<tr>
																	<td class="tdhead_center" rowspan="1" width="63">���<br><?=number_format($money_time1)?></td>
																	<td class="tdhead_center" rowspan="1" width="63">�޽�<br><?=number_format($money_time1_hday)?></td>
																	<td class="tdhead_center" rowspan="1" width="63">���<br><?=number_format($money_time2)?></td>
																	<td class="tdhead_center" rowspan="1" width="63">�޽�<br><?=number_format($money_time2_hday)?></td>

																	<td class="tdhead_center" rowspan="1" width="63">���<br><?=number_format($money_time3)?></td>
																	<td class="tdhead_center" rowspan="1" width="63">�޽�<br><?=number_format($money_time3_hday)?></td>

																	<td class="tdhead_center" rowspan="1" width="56">���ο���<br /><input type="checkbox" name="manual_yun" <?=$check_manual_yun?> onclick="check_manual_yun_func(this)" value="1" title="�����Է�" style="vertical-align:middle;"></td>
																	<td class="tdhead_center" rowspan="1" width="57">�ǰ�����</td>
																	<td class="tdhead_center" rowspan="1" width="57">�����</td>
																	<td class="tdhead_center" rowspan="1" width="57">��뺸��</td>
																	<td class="tdhead_center" rowspan="1" width="57">�ҵ漼</td>
																	<td class="tdhead_center" rowspan="1" width="57">�ֹμ�</td>
																	<td class="tdhead_center" rowspan="1" width="60">��Ÿ����</td>

																	<td class="tdhead_center" rowspan="1" width="98">���ο���<div id="check_manual_yun_text" style="color:red;font-size:9px;"></div></td>
																	<td class="tdhead_center" rowspan="1" width="98">�ǰ�����</td>
																	<td class="tdhead_center" rowspan="1" width="98">�����</td>
																	<td class="tdhead_center" rowspan="1" width="97">��뺸��</td>
																	<td class="tdhead_center" rowspan="1" width="97">���纸��</td>
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
$spanMain_height = 351;
?>
											<div id="spanLeft" style="width:200px;height:<?=$spanMain_height?>px;overflow:hidden">
												<div style="display:none;">
													<input type="hidden" name="idx">
													<input type="hidden" name="pay_gbn">
													<input type="hidden" name="yyyymm">
													<input type="hidden" name="emp_name">
													<input type="hidden" name="emp_sdate">
													<input type="hidden" name="emp_pname">
													<input type="hidden" name="family_cnt">
													<input type="hidden" name="child_cnt">

													<input type="hidden" name="money_month">
													<input type="hidden" name="money_hour">
													<input type="hidden" name="money_hour_ds">
													<input type="hidden" name="money_hour_ts">

													<input type="hidden" name="workhour_1">
													<input type="hidden" name="workhour_2">
													<input type="hidden" name="workhour_3">
													<input type="hidden" name="workhour_1_hday">
													<input type="hidden" name="workhour_2_hday">
													<input type="hidden" name="workhour_3_hday">
													<input type="hidden" name="workhour_edu">
													<input type="hidden" name="workhour_phone">

													<input type="hidden" name="workhour_day">
													<input type="hidden" name="workhour_ext">
													<input type="hidden" name="workhour_night">
													<input type="hidden" name="workhour_hday">

													<input type="hidden" name="workhour_ext_add">
													<input type="hidden" name="workhour_night_add">
													<input type="hidden" name="workhour_hday_add">

													<input type="hidden" name="workhour_late">
													<input type="hidden" name="workhour_leave">
													<input type="hidden" name="workhour_out">
													<input type="hidden" name="workhour_absence">

													<input type="hidden" name="money_time">
													<input type="hidden" name="workhour_total">

													<input type="hidden" name="money_base">
													<input type="hidden" name="money_ext">
													<input type="hidden" name="money_hday">
													<input type="hidden" name="money_night">
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
													<!--�հ����� ����-->
													<input type="hidden" name="money_e1_gy" value="<?=$money_e_gy['e1']?>">
													<input type="hidden" name="money_e2_gy" value="<?=$money_e_gy['e2']?>">
													<input type="hidden" name="money_e3_gy" value="<?=$money_e_gy['e3']?>">
													<input type="hidden" name="money_e4_gy" value="<?=$money_e_gy['e4']?>">
													<input type="hidden" name="money_e5_gy" value="<?=$money_e_gy['e5']?>">
													<input type="hidden" name="money_e6_gy" value="<?=$money_e_gy['e6']?>">
													<input type="hidden" name="money_e7_gy" value="<?=$money_e_gy['e7']?>">
													<input type="hidden" name="money_e8_gy" value="<?=$money_e_gy['e8']?>">
													<!--�������� ����-->
													<input type="hidden" name="money_e1_income" value="<?=$money_e_income['e1']?>">
													<input type="hidden" name="money_e2_income" value="<?=$money_e_income['e2']?>">
													<input type="hidden" name="money_e3_income" value="<?=$money_e_income['e3']?>">
													<input type="hidden" name="money_e4_income" value="<?=$money_e_income['e4']?>">
													<input type="hidden" name="money_e5_income" value="<?=$money_e_income['e5']?>">
													<input type="hidden" name="money_e6_income" value="<?=$money_e_income['e6']?>">
													<input type="hidden" name="money_e7_income" value="<?=$money_e_income['e7']?>">
													<input type="hidden" name="money_e8_income" value="<?=$money_e_income['e8']?>">
													<!--�ӱ��Ѿ�-->
													<input type="hidden" name="money_total">
													<input type="hidden" name="money_for_tax">
													<input type="hidden" name="money_yun">
													<input type="hidden" name="money_health">
													<input type="hidden" name="money_yoyang">
													<input type="hidden" name="money_goyong">
													<input type="hidden" name="tax_so">
													<input type="hidden" name="tax_jumin">
													<input type="hidden" name="minus">
													<input type="hidden" name="minus2">
													<input type="hidden" name="etc">
													<input type="hidden" name="etc2">
													<input type="hidden" name="money_gongje">
													<input type="hidden" name="money_result">
													<input type="hidden" name="workhour_year">
													<!--����� ��ȸ����-->
													<input type="hidden" name="c_money_yun">
													<input type="hidden" name="c_money_health">
													<input type="hidden" name="c_money_yoyang">
													<input type="hidden" name="c_money_goyong">
													<input type="hidden" name="c_money_sanjae">
													<input type="hidden" name="c_money_gongje">
													<input type="hidden" name="retirement_pension">
													<!--����սŰ�ݾ�-->
													<input type="hidden" name="pay_yun">
													<input type="hidden" name="pay_health">
													<input type="hidden" name="pay_goyong">
													<!--�߰� �ʵ�-->
													<input type="hidden" name="money_ng4">
													<input type="hidden" name="money_ng5">
													<input type="hidden" name="advance_pay">
													<input type="hidden" name="check_money_min_yn">
													<input type="hidden" name="check_money_b_yn">
													<input type="hidden" name="check_money_so_yn">
													<input type="hidden" name="money_hour_ms">
													<input type="hidden" name="check_business_yn">
													<!--��������-->
													<input type="hidden" name="money_b1">
													<input type="hidden" name="money_b2">
													<input type="hidden" name="money_b3">
													<input type="hidden" name="money_b4">
													<!--4�뺸�迩��-->
													<input type="hidden" name="isgy">
													<input type="hidden" name="issj">
													<input type="hidden" name="iskm">
													<input type="hidden" name="isgg">
													<input type="hidden" name="isjy">
													<!--�θ�����-->
													<input type="hidden" name="durunuri">
												</div>
												<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
													<col width="10%">
													<col width="">
													<col width="35%">
													<col width="25%">
													<?
													// ����Ʈ ���
													for ($i=0; $row=sql_fetch_array($result); $i++) {
														//$page
														//$total_page
														//$rows

														$no = $total_count - $i - ($rows*($page-1));
														$list = $i%2;
														$code = $row[com_code];
														// ������ : ������ڵ�
														$sql_com = " select com_name from $g4[com_list_gy] where com_code = '$row[com_code]' ";
														$row_com = sql_fetch($sql_com);
														$com_name = $row_com[com_name];
														$com_name = cut_str($com_name, 21, "..");
														$name = cut_str($row[name], 6, "..");

														//������� �⺻ DB
														$sql1 = " select * from pibohum_base where com_code='$row[com_code]' and sabun='$row[sabun]' ";
														$result1 = sql_query($sql1);
														$row1=mysql_fetch_array($result1);

														//������� �߰� DB
														$sql2 = " select * from pibohum_base_opt where com_code='$row[com_code]' and sabun='$row[sabun]' ";
														$result2 = sql_query($sql2);
														$row2=mysql_fetch_array($result2);

														//������� �߰� DB 2
														$sql4 = " select * from pibohum_base_opt2 where com_code='$row[com_code]' and sabun='$row[sabun]' ";
														$result4 = sql_query($sql4);
														$row4=mysql_fetch_array($result4);

														//����
														$sql_position = " select * from com_code_list where com_code = '$code' and code='$row2[position]' and item='position' ";
														$result_position = sql_query($sql_position);
														$row_position=mysql_fetch_array($result_position);
														//echo $row_position[name];
														$k = $i+1;

														//ȣ��
														$sql_step = " select * from com_code_list where com_code = '$code' and code='$row2[step]' and item='step' ";
														$result_step = sql_query($sql_step);
														$row_step=mysql_fetch_array($result_step);

														//ä������
														if($row[work_form] == "") $work_form = "";
														else if($row[work_form] == "1") $work_form = "������";
														else if($row[work_form] == "2") $work_form = "�����";
														else if($row[work_form] == "3") $work_form = "�Ͽ���";

														//��������
														if($row1['gubun'] == 0) $gubun = "����";
														else if($row1['gubun'] == "1") $gubun = "����";
														else if($row1['gubun'] == "2") $gubun = "����";
														else if($row1['gubun'] == "3") $gubun = "����";

														//�ӽ������ ȸ�� �� ǥ�� 150819
														if($row['out_temp'] && $row['out_day'] <= $out_day_base) {
															$tr_class = "list_row_now_gr";
														} else {
															$tr_class = "list_row_now_wh";
														}
													?>

													<tr class="<?=$tr_class?>" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='<?=$tr_class?>';">
														<td nowrap class="ltrow1_center_h24">
															<input type="checkbox" name="idx" value="<?=$row['sabun']?>" onclick="focusClickClass('<?=$k?>')" />
														</td>
<?
if($row2[pay_gbn] == "0") $pay_gbn = "������";
else if($row2[pay_gbn] == "1") $pay_gbn = "�ñ���";
else if($row2[pay_gbn] == "3") $pay_gbn = "������";
if($row4[input_type] == "1") $input_type = "(A)";
else if($row4[input_type] == "2") $input_type = "(B)";
else if($row4[input_type] == "3") $input_type = "(C)";
//�� �߰� �Ի��� ���� ���
$join_year = $search_year;
$join_month = $search_month;
$join_day = $row_com_opt['pay_calculate_day_period1'];
if($join_day < 10) $join_day = "0".$join_day;
$start_date = $join_year.".".$join_month.".".$join_day;
$end_year = $search_year;
$end_month = $search_month;
$end_day = $row_com_opt['pay_calculate_day_period2'];
if($end_day == "��") {
	$end_day = date("t",mktime(0,0,0,$end_month,1,$end_year));
} else if($end_day < 10) {
	$end_day = "0".$end_day;
}
$end_date = $end_year.".".$end_month.".".$end_day;
$in_day = $row['in_day'];
if($in_day > $start_date && $in_day <= $end_date) {
	$in_day_color = "color:red";
	$in_day_hyphen = str_replace('.','-',$in_day);
	$start_date_hyphen = str_replace('.','-',$start_date);
	$end_date_hyphen = str_replace('.','-',$end_date);
	$in_day_var = new DateTime($in_day_hyphen);
	$end_date_var = new DateTime($end_date_hyphen);
	$date_diff_var = date_diff($in_day_var, $end_date_var);
	$work_day = ($date_diff_var->days)+1;
} else {
	$in_day_color = "";
}
?>
														<td nowrap class="ltrow1_center_h24"><b onclick="emp_text('<?=$row[name]?>','<?=$in_day?>','<?=$row_position[name]?>','<?=$row2[family_cnt]?>','<?=$row2[work_gbn]?>','<?=$pay_gbn.$input_type?>','<?=number_format($row4['money_month_base'])?>','<?=number_format($row4['money_hour_ms'])?>','<?=number_format($row4['money_min_base'])?>');" style="cursor:pointer" title="<?=substr($row['jumin_no'],0,2).".".substr($row['jumin_no'],2,2).".".substr($row['jumin_no'],4,2)?>(<?=$gubun?>)"><?=$name?></b></td>
														<td nowrap class="ltrow1_center_h24"><span onclick="month_middle_cal('<?=$k?>','<?=$end_day?>','<?=$work_day?>')" style="cursor:pointer;<?=$in_day_color?>"><?=$in_day?></span></td>
														<td nowrap class="ltrow1_center_h24"><input type="text" name="emp_pname" value="<?=$row_position[name]?>" style="width:100%;ime-mode:active;" class="textfm5" readonly onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');"></td>
													</tr>
													<?
													}
													if ($i == 0)
															echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' nowrap class=\"ltrow1_center_h22\">�ڷᰡ �����ϴ�.</td></tr>";
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
													// ����Ʈ ���
													for ($i=0; $row=sql_fetch_array($result); $i++) {
														//$page
														//$total_page
														//$rows

														$no = $total_count - $i - ($rows*($page-1));
														$list = $i%2;
														// ������ : ������ڵ�
														$sql_com = " select com_name from $g4[com_list_gy] where com_code = '$row[com_code]' ";
														$row_com = sql_fetch($sql_com);
														$com_name = $row_com[com_name];
														$com_name = cut_str($com_name, 21, "..");
														$name = cut_str($row[name], 6, "..");

														//������� �߰� DB
														$sql2 = " select * from pibohum_base_opt where com_code='$row[com_code]' and sabun='$row[sabun]' ";
														$result2 = sql_query($sql2);
														$row2=mysql_fetch_array($result2);

														//����
														$sql_position = " select * from com_code_list where com_code='$row[com_code]' and code='$row2[position]' and item='position' ";
														//echo $sql_position;
														$result_position = sql_query($sql_position);
														$row_position=mysql_fetch_array($result_position);
														//echo $row_position[name];
														$k = $i+1;

														//ȣ��
														$sql_step = " select * from com_code_list where com_code='$row[com_code]' and code='$row2[step]' and item='step' ";
														$result_step = sql_query($sql_step);
														$row_step=mysql_fetch_array($result_step);

														//ä������
														if($row[work_form] == "") $work_form = "";
														else if($row[work_form] == "1") $work_form = "������";
														else if($row[work_form] == "2") $work_form = "�����";
														else if($row[work_form] == "3") $work_form = "�Ͽ���";

														//�޿�����
														//echo $row2[pay_gbn];
														if($row2[pay_gbn] == "0") $pay_gbn = "������";
														else if($row2[pay_gbn] == "1") $pay_gbn = "�ñ���";
														else if($row2[pay_gbn] == "2") $pay_gbn = "���ձٹ�";
														else if($row2[pay_gbn] == "3") $pay_gbn = "������";
														else if($row2[pay_gbn] == "4") $pay_gbn = "�ϱ���";
														else $pay_gbn = "-";
														$pay_gbn_no = $row2[pay_gbn];

														//����ٷ�
														$sql_attendance = " select * from a4_attendance where com_code='$row[com_code]' and sabun='$row[sabun]' and att_day like '201310%' ";
														//echo $sql_attendance;
														$result_attendance = sql_query($sql_attendance);
														$row_attendance=mysql_fetch_array($result_attendance);

														//������� �߰� DB (�޿�����)
														$sql3 = " select * from pibohum_base_opt2 where com_code='$row[com_code]' and sabun='$row[sabun]' ";
														//echo $sql3;
														$result3 = sql_query($sql3);
														$row3=mysql_fetch_array($result3);

														//�޿����� DB (�޿��ݿ�) ���
														$sql4 = " select * from pibohum_base_pay_h where com_code='$row[com_code]' and sabun='$row[sabun]' and year = '$search_year' and month = '$search_month' and w_date != '0000-00-00' order by w_date desc, w_time desc limit 0, 1 ";
														//echo $sql4;
														$result4 = sql_query($sql4);
														$row4=mysql_fetch_array($result4);

														//�߰����� �ٷνð� �ʱ�ȭ
														if(!$row4[w_ext_add]) $row4[w_ext_add] = "0";
														if(!$row4[w_night_add]) $row4[w_night_add] = "0";
														if(!$row4[w_hday_add]) $row4[w_hday_add] = "0";
														if(!$row3[money_month_base]) {
															$row4[w_ext_add] = "";
															$row4[w_night_add] = "";
															$row4[w_hday_add] = "";
														}
														//4�뺸�迩��
														if($row[apply_gy] == "0") $isgy_chk = "checked";
														else $isgy_chk = "";
														if($row[apply_sj] == "0") $issj_chk = "checked";
														else $issj_chk = "";
														if($row[apply_km] == "0") $iskm_chk = "checked";
														else $iskm_chk = "";
														if($row[apply_gg] == "0") $isgg_chk = "checked"; 
														else $isgg_chk = "";
														if($row[apply_jy] == "0") $isjy_chk = "checked"; 
														else $isjy_chk = "";
														//�θ����� ���� ����
														$durunuri = $row2[insurance];
														//���ο��� ��60�� �ش� ���
														$now_date = date("Ymd");
														$jumin_date = "19".substr($row[jumin_no],0,9);
														$age_cal = ( $now_date - $jumin_date ) / 10000;
														$age = (int)$age_cal;
														if($age_cal >= 60) {
															$iskm_chk = "";
														}
														//����ҵ��� 3.3% �ҵ漼/�ֹμ�
														if($row['work_form'] == 4) {
															$check_business_yn = "0";
															$pay_gbn = "<span style='color:red' title='����ҵ���'>".$pay_gbn."</a>";
														}
														else $check_business_yn = "";
													?>

													<tr class="list_row_now_gr" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_gr';">
														<input type="hidden" name="pay_no" value="<?=$row['sabun']?>">
														<input type="hidden" name="pay_gbn" value="<?=$pay_gbn_no?>">
														<input type="hidden" name="emp_name" value="<?=$name?>">
														<input type="hidden" name="emp_sdate" value="<?=$row['in_day']?>">
														<input type="hidden" name="money_hour" value="0">
														<input type="hidden" name="sabun_<?=$i?>" value="<?=$row['sabun']?>">
														<input type="hidden" name="staff_name_<?=$i?>" value="<?=$name?>">
														<input type="hidden" name="in_day_<?=$i?>" value="<?=$row['in_day']?>">
														<input type="hidden" name="out_day_<?=$i?>" value="<?=$row['out_day']?>">
														<input type="hidden" name="position_<?=$i?>" value="<?=$row2['position']?>">
														<input type="hidden" name="position_txt_<?=$i?>" value="<?=$row_position['name']?>">
														<input type="hidden" name="step_<?=$i?>" value="<?=$row2['step']?>">
														<input type="hidden" name="step_txt_<?=$i?>" value="<?=$row_step['name']?>">
														<input type="hidden" name="work_form_<?=$i?>" value="<?=$work_form?>">
														<input type="hidden" name="dept_code_<?=$i?>" value="<?=$row2['dept']?>">
														<input type="hidden" name="dept_<?=$i?>" value="<?=$row2['dept_1']?>">
														<input type="hidden" name="pay_gbn_txt_<?=$i?>" value="<?=$pay_gbn_txt?>">
														<input type="hidden" name="pay_gbn_<?=$i?>">

														<input type="hidden" name="family_cnt" value="<?=$row['family_cnt']?>">
														<input type="hidden" name="child_cnt" value="<?=$row['child_cnt']?>">

<?
if(!$w_date_ok) {
	if($pay_gbn_no == 1) {
		$money_total = $row3['money_hour_ds'];
		$money_hour_ds = $row3['money_hour_ds'];
	} else if($pay_gbn_no == 4) {
		$money_total = $row3['money_day_base'];
		$money_hour_ds = $row3['money_hour_ds'];
	} else {
		$money_total = $row3['money_month_base'];
		$money_hour_ds = 0;
	}
	$workhour_1 = "";
	$workhour_2 = "";
	$workhour_3 = "";
	$workhour_1_hday = "";
	$workhour_2_hday = "";
	$workhour_3_hday = "";
	$workhour_edu = "";
	$workhour_phone = "";

	$workhour_day = $row3['workhour_day'];
	$workhour_ext = $row3['workhour_ext'];
	$workhour_night = $row3['workhour_night'];
	$workhour_hday = $row3['workhour_hday'];
	$workhour_year = $row3['workhour_year'];

	$w_ext_add = 0;
	$w_night_add = 0;
	$w_hday_add = 0;

	//��������
	$att_ymd = $search_year."".$search_month;
	$sql_attendance = " select * from a4_attendance where com_code='$com_code' and sabun='$row[sabun]' ";
	//echo $sql_attendance;
	$result_attendance = sql_query($sql_attendance);
	$att_rule = array();
	//�������� �ʱ�ȭ
	$w_late = "";
	$w_leave = "";
	$w_out = "";
	$w_absence = "";
	for($j=0; $row_attendance=sql_fetch_array($result_attendance); $j++) {
		//��������
		$att_day = date('Y-m-d',strtotime($row_attendance[att_day]));
		$att_date = explode("-", $att_day);
		//echo $att_date[0];
		//�ش� �⵵
		if($att_date[0] == $search_year && $att_date[1] == $search_month) {
			$monthday = date('md',strtotime($row_attendance[att_day]));
			$att_rule_2 = explode(":", $row_attendance[att_time2]);
			$att_rule_1 = explode(":", $row_attendance[att_time]);
			if($att_rule_2[0] < $att_rule_1[0]) {
				$att_rule_hour = (24 - $att_rule_1[0]) + $att_rule_2[0];
			} else {
				$att_rule_hour = ($att_rule_2[0] - $att_rule_1[0]);
			}
			$att_rule_min = ($att_rule_2[1] - $att_rule_1[1]);
			$att_rule_min_cal = $att_rule_min / 60;
			$att_category = $row_attendance[att_category];
			//echo $att_category;
			$att_rule[$att_category] = $att_rule_hour + $att_rule_min_cal;
			//$att_rule[$att_category] += $att_rule[$att_category];
			if($att_category == 3) $w_late += $att_rule[$att_category];
			else if($att_category == 2) $w_leave += $att_rule[$att_category];
			else if($att_category == 4) $w_out += $att_rule[$att_category];
			else if($att_category == 1) $w_absence += $att_rule[$att_category] -1;
		}
	}
	if($j == 0) {
		$w_late = "";
		$w_leave = "";
		$w_out = "";
		$w_absence = "";
	}
	$workhour_total = 0;

	$money_hour_ts = $row3[money_hour_ts];
	//�⺻�ñ�
	$money_time = $row3[money_min_base];
	$money_base = $row4[money_month];

	$money_ext = $row3[money_b1];
	$money_night = $row3[money_b2];
	$money_hday = $row3[money_b3];
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
	$workhour_1 = $row4['w_1'];
	$workhour_2 = $row4['w_2'];
	$workhour_3 = $row4['w_3'];
	$workhour_1_hday = $row4['w_1_hday'];
	$workhour_2_hday = $row4['w_2_hday'];
	$workhour_3_hday = $row4['w_3_hday'];
	$workhour_edu = $row4['w_edu'];
	$workhour_phone = $row4['w_phone'];
	//�ð� 0 �� ��� ������ ǥ��
	if(!$workhour_1) $workhour_1 = "";
	if(!$workhour_2) $workhour_2 = "";
	if(!$workhour_3) $workhour_3 = "";
	if(!$workhour_1_hday) $workhour_1_hday = "";
	if(!$workhour_2_hday) $workhour_2_hday = "";
	if(!$workhour_3_hday) $workhour_3_hday = "";
	if(!$workhour_edu) $workhour_edu = "";
	if(!$workhour_phone) $workhour_phone = "";

	$workhour_day = $row4[w_day];
	$workhour_ext = $row4[w_ext];
	$workhour_night = $row4[w_night];
	$workhour_hday = $row4[w_hday];
	$workhour_year = 0;

	$w_ext_add = $row4[w_ext_add];
	$w_night_add = $row4[w_night_add];
	$w_hday_add = $row4[w_hday_add];

	$w_late = $row4[w_late];
	$w_leave = $row4[w_leave];
	$w_out = $row4[w_out];
	$w_absence = $row4[w_absence];

	$workhour_total = $row4[workhour_total];

	$money_hour_ts = $row4[money_time];
	//�⺻�ñ�
	$money_time = $row4[money_min_base];
	$money_base = $row4[money_month];

	$money_ext = $row4[ext];
	$money_night = $row4[night];
	$money_hday = $row4[hday];

	//�������� -> ����������
	if($row4['annual_paid_holiday']) $annual_paid_holiday = number_format($row4['annual_paid_holiday']);
	else $annual_paid_holiday = "";

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
//�����ñ� DB ���
if($row4[money_hour_ds] == 0) {
	$money_hour_ds = $row3[money_hour_ds];
} else {
	$money_hour_ds = $row4[money_hour_ds];
}
?>
														<input type="hidden" name="w_1_<?=$i?>">
														<input type="hidden" name="w_2_<?=$i?>">
														<input type="hidden" name="w_3_<?=$i?>">
														<input type="hidden" name="w_1_hday_<?=$i?>">
														<input type="hidden" name="w_2_hday_<?=$i?>">
														<input type="hidden" name="w_3_hday_<?=$i?>">
														<input type="hidden" name="w_edu_<?=$i?>">
														<input type="hidden" name="w_phone_<?=$i?>">

														<input type="hidden" name="w_day_<?=$i?>">
														<input type="hidden" name="w_ext_<?=$i?>">
														<input type="hidden" name="w_night_<?=$i?>">
														<input type="hidden" name="w_hday_<?=$i?>">

														<input type="hidden" name="w_ext_add_<?=$i?>">
														<input type="hidden" name="w_night_add_<?=$i?>">
														<input type="hidden" name="w_hday_add_<?=$i?>">

														<input type="hidden" name="w_late_<?=$i?>">
														<input type="hidden" name="w_leave_<?=$i?>">
														<input type="hidden" name="w_out_<?=$i?>">
														<input type="hidden" name="w_absence_<?=$i?>">

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
														<!--��������-->
														<input type="hidden" name="tax_so_var_<?=$i?>">
														<input type="hidden" name="tax_jumin_var_<?=$i?>">
														<input type="hidden" name="advance_pay_<?=$i?>">
														<input type="hidden" name="end_pay_<?=$i?>">
														<input type="hidden" name="minus_<?=$i?>">
														<input type="hidden" name="minus2_<?=$i?>">
														<input type="hidden" name="etc_<?=$i?>">
														<input type="hidden" name="etc2_<?=$i?>">
														<!--4�뺸��-->
														<input type="hidden" name="health_<?=$i?>">
														<input type="hidden" name="yoyang_<?=$i?>">
														<input type="hidden" name="yun_<?=$i?>">
														<input type="hidden" name="goyong_<?=$i?>">
														<!--4�뺸��(�����)-->
														<input type="hidden" name="c_yun_<?=$i?>">
														<input type="hidden" name="c_health_<?=$i?>">
														<input type="hidden" name="c_yoyang_<?=$i?>">
														<input type="hidden" name="c_goyong_<?=$i?>">
														<input type="hidden" name="c_sanjae_<?=$i?>">
														<input type="hidden" name="c_money_gongje_<?=$i?>">
														<input type="hidden" name="retirement_pension_<?=$i?>">
														<!--�����޿�-->
														<input type="hidden" name="money_total_<?=$i?>">
														<input type="hidden" name="money_for_tax_<?=$i?>">
														<input type="hidden" name="money_gongje_<?=$i?>">
														<input type="hidden" name="money_result_<?=$i?>">
														<!--�߰� �ʵ�-->
														<input type="hidden" name="money_ng4">
														<input type="hidden" name="money_ng5">
														<input type="hidden" name="advance_pay">
														<input type="hidden" name="check_money_min_yn" value="<?=$row3[check_money_min_yn]?>">
														<input type="hidden" name="check_money_b_yn" value="<?=$row3[check_money_b_yn]?>">
														<input type="hidden" name="check_money_so_yn" value="<?=$row2[apply_so]?>">
														<input type="hidden" name="money_hour_ms" value="<?=$row3[money_hour_ms]?>">
														<input type="hidden" name="check_business_yn" value="<?=$check_business_yn?>">
														<!--��������-->
														<input type="hidden" name="money_b1" value="<?=$row3[money_b1]?>">
														<input type="hidden" name="money_b2" value="<?=$row3[money_b2]?>">
														<input type="hidden" name="money_b3" value="<?=$row3[money_b3]?>">
														<input type="hidden" name="money_b4" value="<?=$row3[money_b4]?>">
														<!--4�뺸�迩��-->
														<input type="hidden" name="isgy" value="<?=$isgy_chk?>">
														<input type="hidden" name="issj" value="<?=$issj_chk?>">
														<input type="hidden" name="iskm" value="<?=$iskm_chk?>">
														<input type="hidden" name="isgg" value="<?=$isgg_chk?>">
														<input type="hidden" name="isjy" value="<?=$isjy_chk?>">
														<!--�θ�����-->
														<input type="hidden" name="durunuri" value="<?=$durunuri?>">
														<!--�߰����� �߰��߰� �߰�����-->
														<input type="hidden" name="workhour_ext_add" value="<?=$w_ext_add?>">
														<input type="hidden" name="workhour_night_add" value="<?=$w_night_add?>">
														<input type="hidden" name="workhour_hday_add" value="<?=$w_hday_add?>">
														<input type="hidden" name="money_ext_add" value="<?=number_format($money_ext_add)?>">
														<input type="hidden" name="money_night_add" value="<?=number_format($money_night_add)?>">
														<input type="hidden" name="money_hday_add" value="<?=number_format($money_hday_add)?>">
														<!--��Ÿ����-->
														<!--<input type="hidden" name="minus" value="<?=$row4[minus]?>">-->
														<input type="hidden" name="minus2" value="<?=$row4[minus2]?>">
														<!--���ؽñ�(�ñ���) �ʵ�-->
														<input type="hidden" name="money_hour_ds" value="<?=$money_hour_ds?>">
														<!--�����ӱ�(�ñ�)-->
														<input type="hidden" name="money_month" value="<?=number_format($money_total)?>" />

														<td nowrap class="ltrow1_center_h24" style="background-color:#ffffff" width="45"><input type="hidden" style="width:100%;ime-mode:disabled;" class="textfm5" name="pay_gbn_txt" value="<?=$pay_gbn?>"><?=$pay_gbn?></td><!--�ٹ�����-->

														<td nowrap class="ltrow1_center_h24" width="63">
<?
//echo $total_count;
if($k < $total_count) {
	$k_next = $k+1;
}
?>
															<input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_1" id="id_workhour_1_<?=$k?>" value="<?=$workhour_1?>" onkeyup="cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_workhour_1_<?=$k_next?>').focus(); }" /><!--���Ǻ��� ���-->
															<input type="hidden" name="workhour_day" value="<?=$workhour_day?>" /><!--�����ٷνð�-->
															<input type="hidden" name="workhour_ext" value="<?=$workhour_ext?>" /><!--����ٷνð�-->
															<input type="hidden" name="workhour_night" value="<?=$workhour_night?>" /><!--�߰��ٷνð�-->
															<input type="hidden" name="workhour_hday" value="<?=$workhour_hday?>" /><!--���ϱٷνð�-->
															<input type="hidden" name="workhour_late" value="<?=$w_late?>" /><!--����-->
															<input type="hidden" name="workhour_leave" value="<?=$w_leave?>" /><!--����-->
															<input type="hidden" name="workhour_out" value="<?=$w_out?>" /><!--����-->
															<input type="hidden" name="workhour_absence" value="<?=$w_absence?>" /><!--���-->
														</td>
														<td nowrap class="ltrow1_center_h24" width="63">
															<input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_1_hday" id="id_workhour_1_hday_<?=$k?>" value="<?=$workhour_1_hday?>" onkeyup="cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_workhour_1_hday_<?=$k_next?>').focus(); }" /><!--���Ǻ��� �޽�-->
														</td>
														<td nowrap class="ltrow1_center_h24" width="63">
															<input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_2" id="id_workhour_2_<?=$k?>" value="<?=$workhour_2?>" onkeyup="cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_workhour_2_<?=$k_next?>').focus(); }" /><!--��⵵ ���-->
														</td>
														<td nowrap class="ltrow1_center_h24" width="63">
															<input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_2_hday" id="id_workhour_2_hday_<?=$k?>" value="<?=$workhour_2_hday?>" onkeyup="cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_workhour_2_hday_<?=$k_next?>').focus(); }" /><!--��⵵ �޽�-->
														</td>
														<td nowrap class="ltrow1_center_h24" width="63">
															<input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_3" id="id_workhour_3_<?=$k?>" value="<?=$workhour_3?>" onkeyup="cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_workhour_3_<?=$k_next?>').focus(); }" /><!--ȭ���� ���-->
														</td>
														<td nowrap class="ltrow1_center_h24" width="63">
															<input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_3_hday" id="id_workhour_3_hday_<?=$k?>" value="<?=$workhour_3_hday?>" onkeyup="cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_workhour_3_hday_<?=$k_next?>').focus(); }" /><!--ȭ���� �޽�-->
														</td>
														<td nowrap class="ltrow1_center_h24" width="63">
															<input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_edu" id="id_workhour_edu_<?=$k?>" value="<?=$workhour_edu?>" onkeyup="cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_workhour_edu_<?=$k_next?>').focus(); }" /><!--�����ð�-->
														</td>
														<td nowrap class="ltrow1_center_h24" width="64">
															<input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_phone" id="id_workhour_phone_<?=$k?>" value="<?=$workhour_phone?>" onkeyup="cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_workhour_phone_<?=$k_next?>').focus(); }" /><!--����Ʈ��-->
														</td>
														<td nowrap class="ltrow1_center_h24" width="65"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm"  name="money_year" id="id_money_year_<?=$k?>" value="<?=$annual_paid_holiday?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_year_<?=$k_next?>').focus(); }" /></td><!--����������-->
														<td nowrap class="ltrow1_center_h24" width="63"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="workhour_total" value="<?=$workhour_total?>"></td><!--�ӱݻ��� �ѽð�-->
														<td nowrap class="ltrow1_center_h24" width="18">
<?
//�⺻�� �����Է� Ŭ���� ����
if($check_money_month_fix) {
	$class_money_base = "textfm";
	$readonly_money_base = "";
} else {
	$class_money_base = "textfm5";
	$readonly_money_base = "readonly";
}
?>
															<input type="hidden" name="money_hour_ts" value="<?=number_format($money_hour_ts)?>" /><!--����ӱ�(�ð���)-->
															<input type="hidden" name="money_time" value="<?=number_format($money_time)?>" /><!--�⺻�ñ�-->
															<input type="hidden" name="money_base" value="<?=number_format($money_base)?>" /><!--�⺻��-->
															<input type="hidden" name="money_ext" value="<?=number_format($money_ext)?>" /><!--����ٷμ���-->
															<input type="hidden" name="money_night" value="<?=number_format($money_night)?>" /><!--�߰��ٷμ���-->
															<input type="hidden" name="money_hday" value="<?=number_format($money_hday)?>" /><!--���ϱٷμ���-->
															<input type="hidden" name="money_g1" value="<?=number_format($money_g1)?>" /><!--������1-->
															<input type="hidden" name="money_g2" value="<?=number_format($money_g2)?>" /><!--������2-->
															<input type="hidden" name="money_g3" value="<?=number_format($money_g3)?>" /><!--������3-->
															<input type="hidden" name="money_g4" value="<?=number_format($money_g4)?>" /><!--������4-->
															<input type="hidden" name="money_g5" value="<?=number_format($money_g5)?>" /><!--������5-->

															<input type="hidden" name="money_e1" value="<?=number_format($money_e1)?>" /><!--��Ÿ����1-->
															<input type="hidden" name="money_e2" value="<?=number_format($money_e2)?>" /><!--��Ÿ����2-->
															<input type="hidden" name="money_e3" value="<?=number_format($money_e3)?>" /><!--��Ÿ����3-->
															<input type="hidden" name="money_e4" value="<?=number_format($money_e4)?>" /><!--��Ÿ����4-->
															<input type="hidden" name="money_e5" value="<?=number_format($money_e5)?>" /><!--��Ÿ����5-->
															<input type="hidden" name="money_e6" value="<?=number_format($money_e6)?>" /><!--��Ÿ����6-->
															<input type="hidden" name="money_e7" value="<?=number_format($money_e7)?>" /><!--��Ÿ����7-->
															<input type="hidden" name="money_e8" value="<?=number_format($money_e8)?>" /><!--��Ÿ����8-->

															<input type="hidden" name="etc"  value="<?=number_format($row4['etc'])?>" /><!--����-->
															<input type="hidden" name="etc2" value="<?=number_format($row4['etc2'])?>" /><!--���°���-->

															<input type="hidden" name="pay_yun" value="<?=$row3['pay_yun']?>" /><!--���ο���-->
															<input type="hidden" name="pay_health" value="<?=$row3['pay_health']?>" /><!--�ǰ�����-->
															<input type="hidden" name="pay_goyong" value="<?=$row3['pay_goyong']?>" /><!--��뺸��-->
														</td>
														<td nowrap class="ltrow1_center_h24" width="67"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_total" value="<?=number_format($row4['money_total'])?>"></td><!--�����̿�ݾ�-->
														<td nowrap class="ltrow1_center_h24" width="67"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_for_tax" value="<?=number_format($row4['money_for_tax'])?>"></td><!--�޿�-->

														<td nowrap class="ltrow1_center_h24" width="56"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber_negative();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_yun" id="id_money_yun_<?=$k?>" value="<?=number_format($row4['yun'])?>" onkeyup="checkThousand_negative(this.value, this,'Y');cal_pay2('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_yun_<?=$k_next?>').focus(); }" /></td><!--���ο���-->
														<td nowrap class="ltrow1_center_h24" width="57"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber_negative();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_health" id="id_money_health_<?=$k?>" value="<?=number_format($row4['health'])?>" onkeyup="checkThousand_negative(this.value, this,'Y');cal_pay2('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_health_<?=$k_next?>').focus(); }" /></td><!--�ǰ�����-->
														<td nowrap class="ltrow1_center_h24" width="57"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber_negative();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_yoyang" id="id_money_yoyang_<?=$k?>" value="<?=number_format($row4['yoyang'])?>" onkeyup="checkThousand_negative(this.value, this,'Y');cal_pay2('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_yoyang_<?=$k_next?>').focus(); }" /></td><!--����纸��-->
														<td nowrap class="ltrow1_center_h24" width="57"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber_negative();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_goyong" id="id_money_goyong_<?=$k?>" value="<?=number_format($row4['goyong'])?>" onkeyup="checkThousand_negative(this.value, this,'Y');cal_pay2('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_goyong_<?=$k_next?>').focus(); }" /></td><!--��뺸��-->
														<td nowrap class="ltrow1_center_h24" width="57"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="tax_so" id="id_tax_so_<?=$k?>" value="<?=number_format($row4['tax_so'])?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay3('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_tax_so_<?=$k_next?>').focus(); }" /></td><!--�ҵ漼-->
														<td nowrap class="ltrow1_center_h24" width="57"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="tax_jumin" id="id_tax_jumin_<?=$k?>" value="<?=number_format($row4['tax_jumin'])?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay2('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_tax_jumin_<?=$k_next?>').focus(); }" /></td><!--�ֹμ�-->
														<td nowrap class="ltrow1_center_h24" width="60"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="minus" id="id_minus_<?=$k?>" value="<?=number_format($row4['minus'])?>" onkeyup="checkThousand(this.value, this,'Y');cal_pay2('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_minus_<?=$k_next?>').focus(); }" /></td><!--��Ÿ����-->

														<td nowrap class="ltrow1_center_h24" width="72"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_gongje" value="<?=number_format($row4['money_gongje'])?>"></td><!--������-->
														<td nowrap class="ltrow1_center_h24" width="73"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_result" value="<?=number_format($row4['money_result'])?>"></td><!--���������޾�-->
														<td nowrap class="ltrow1_center_h24" width="18"></td>

														<td nowrap class="ltrow1_center_h24" width="98"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber_negative();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="c_money_yun" id="id_c_money_yun_<?=$k?>" value="<?=number_format($row4['c_yun'])?>" onkeyup="checkThousand_negative(this.value, this,'Y');cal_pay2('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_c_money_yun_<?=$k_next?>').focus(); }" /></td><!--���ο���-->
														<td nowrap class="ltrow1_center_h24" width="98"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber_negative();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="c_money_health" id="id_c_money_health_<?=$k?>" value="<?=number_format($row4['c_health'])?>" onkeyup="checkThousand_negative(this.value, this,'Y');cal_pay2('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_c_money_health_<?=$k_next?>').focus(); }" /></td><!--�ǰ�����-->
														<td nowrap class="ltrow1_center_h24" width="98"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber_negative();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="c_money_yoyang" id="id_c_money_yoyang_<?=$k?>" value="<?=number_format($row4['c_yoyang'])?>" onkeyup="checkThousand_negative(this.value, this,'Y');cal_pay2('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_c_money_yoyang_<?=$k_next?>').focus(); }" /></td><!--����纸��-->
														<td nowrap class="ltrow1_center_h24" width="97"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber_negative();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="c_money_goyong" id="id_c_money_goyong_<?=$k?>" value="<?=number_format($row4['c_goyong'])?>" onkeyup="checkThousand_negative(this.value, this,'Y');cal_pay2('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_c_money_goyong_<?=$k_next?>').focus(); }" /></td><!--��뺸��-->
														<td nowrap class="ltrow1_center_h24" width="97"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber_negative();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="c_money_sanjae" id="id_c_money_sanjae_<?=$k?>" value="<?=number_format($row4['c_sanjae'])?>" onkeyup="checkThousand_negative(this.value, this,'Y');cal_pay2('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_c_money_sanjae_<?=$k_next?>').focus(); }" /></td><!--���纸��-->

														<td nowrap class="ltrow1_center_h24" width="98"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="c_money_gongje" value="<?=number_format($row4['c_money_gongje'])?>"></td><!--������-->
														<td nowrap class="ltrow1_center_h24" width="98"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="retirement_pension" value="<?=number_format($row4['retirement_pension'])?>"></td><!--��������-->
														<td nowrap class="ltrow1_center_h24" width="18"></td>
													</tr>
													<?
													}
													if ($i == 0) {
														echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' nowrap class=\"ltrow1_center_h22\">�ڷᰡ �����ϴ�.</td></tr>";
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
								<!--����Ʈ -->
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
//�ڵ� ��� ��ư �Լ�
function cal_pay_bt() {
<?
for($i=1;$i<=$k;$i++) {
?>
	cal_pay('<?=$i?>');
<?
}
?>
}
<?
//������ �����Է� ����
if($data == "load") {
	echo "addLoadEvent(cal_pay_bt);";
}
?>
function cal_pay(idx) {
	var f = document.dataForm;
	var pay_gbn, money_day, pay_yun, pay_health, pay_goyong, money_for_4i, c_money_yun,c_money_health,c_money_yoyang,c_money_goyong,c_money_sanjae,c_money_gongje;
	var workhour_1, workhour_2, workhour_3, workhour_1_hday, workhour_2_hday, workhour_3_hday, workhour_edu, workhour_phone, money_pay, retirement_pension;
	var money_month,money_hour,money_hour_ds,money_hour_ts,workhour_day,workhour_ext,workhour_night,workhour_hday,workhour_ext_add,workhour_night_add,workhour_hday_add,workhour_total;
	var workhour_late,workhour_leave,workhour_out,workhour_absence,money_hour_ms;
	var money_base,money_time,money_ext,money_night,money_hday,money_ext_add,money_night_add,money_hday_add,money_year;
	var money_g1,money_g2,money_g3,money_g4,money_g5,money_e1,money_e2,money_e3,money_e4,money_e5,money_e6,money_e7,money_e8;
	var money_g_sum, money_b_sum, money_e_sum;
	var money_total,money_for_tax,money_yun,money_health,money_yoyang,money_goyong,tax_so,tax_jumin,minus,minus2,etc,etc2,money_gongje,money_result,workhour_year;

	pay_gbn 		    = toInt(f.pay_gbn 		  [idx].value);
	money_month     = toInt(f.money_month   [idx].value); //�⺻���� mm--
	money_hour      = toInt(f.money_hour    [idx].value);	//���ؽñ� hh--
	money_hour_ds   = toInt(f.money_month 	[idx].value);	//���ؽñ�(�ñ���)
	money_hour_ts   = toInt(f.money_hour_ts [idx].value);	//����ӱ�(�ð���)

	workhour_1    = toFloat(f.workhour_1  [idx].value);	//���Ǻ��� ���
	workhour_1_hday    = toFloat(f.workhour_1_hday  [idx].value);	//���Ǻ��� �޽�
	workhour_2    = toFloat(f.workhour_2  [idx].value);	//��⵵ ���
	workhour_2_hday    = toFloat(f.workhour_2_hday  [idx].value);	//��⵵ �޽�
	workhour_3    = toFloat(f.workhour_3  [idx].value);	//ȭ���� ���
	workhour_3_hday    = toFloat(f.workhour_3_hday  [idx].value);	//ȭ���� �޽�
	workhour_edu    = toFloat(f.workhour_edu  [idx].value);	//�����ð�
	workhour_phone    = toFloat(f.workhour_phone  [idx].value);	//����Ʈ��

	workhour_day    = toFloat(f.workhour_day  [idx].value);	//�����ٷνð�
	workhour_ext    = toFloat(f.workhour_ext  [idx].value);	//����ٷνð�         
	workhour_night  = toFloat(f.workhour_night[idx].value);	//�߰��ٷνð�
	workhour_hday   = toFloat(f.workhour_hday [idx].value);	//���ϱٷνð�

	workhour_ext_add    = toFloat(f.workhour_ext_add   [idx].value);	//�߰�����ٷνð�
	workhour_night_add  = toFloat(f.workhour_night_add [idx].value);	//�߰��߰��ٷνð�
	workhour_hday_add   = toFloat(f.workhour_hday_add  [idx].value);	//�߰����ϱٷνð�

	workhour_late    = toFloat(f.workhour_late   [idx].value);
	workhour_leave   = toFloat(f.workhour_leave  [idx].value);
	workhour_out     = toFloat(f.workhour_out    [idx].value);
	workhour_absence = toFloat(f.workhour_absence[idx].value);

	workhour_total  = toFloat(f.workhour_total[idx].value);	//�ӱݻ��� �ѽð� mm-- 

	money_base      = toInt(f.money_base    [idx].value);	// �⺻��      
	money_time      = toInt(f.money_time    [idx].value);	// �⺻�ñ�
	money_ext       = toInt(f.money_ext     [idx].value);	// ����ٷμ���
	money_hday      = toInt(f.money_hday    [idx].value);	// ���ϱٷμ���
	money_night     = toInt(f.money_night   [idx].value);	// �߰��ٷμ���
	money_year      = toInt(f.money_year    [idx].value);	// �������� hh--

	money_ext_add   = toInt(f.money_ext_add [idx].value);	// ����ٷμ���(�߰�)
	money_hday_add  = toInt(f.money_hday_add[idx].value);	// ���ϱٷμ���(�߰�)
	money_night_add = toInt(f.money_night_add[idx].value);	// �߰��ٷμ���(�߰�)

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

	money_total     = toInt(f.money_total   [idx].value); //�ӱݰ�       
	money_for_tax   = toInt(f.money_for_tax [idx].value);	//�����ҵ�     
	money_yun       = toInt(f.money_yun     [idx].value);	//���ο���
	money_health    = toInt(f.money_health  [idx].value);	//�ǰ�����     
	money_yoyang    = toInt(f.money_yoyang  [idx].value);	//����纸�� 
	money_goyong    = toInt(f.money_goyong  [idx].value);	//��뺸��

	c_money_yun    = toInt(f.c_money_yun   [idx].value);	//���ο���
	c_money_health = toInt(f.c_money_health[idx].value);	//�ǰ�����     
	c_money_yoyang = toInt(f.c_money_yoyang[idx].value);	//����纸�� 
	c_money_goyong = toInt(f.c_money_goyong[idx].value);	//��뺸��
	c_money_sanjae = toInt(f.c_money_sanjae[idx].value);	//���纸��
	c_money_gongje = toInt(f.c_money_gongje[idx].value);	//������(�����)
	retirement_pension = toInt(f.retirement_pension[idx].value);	//��������

	tax_so          = toInt(f.tax_so        [idx].value);	//�ҵ漼       
	tax_jumin       = toInt(f.tax_jumin     [idx].value);	//�ֹμ�
	minus           = toInt(f.minus         [idx].value);	//��Ÿ����
	minus2          = toInt(f.minus2        [idx].value);	//��Ÿ����2
	etc           	= toInt(f.etc      	 	  [idx].value);	//����
	etc2          	= toInt(f.etc2      	  [idx].value);	//���°���
	money_gongje    = toInt(f.money_gongje  [idx].value);	//������       
	money_result    = toInt(f.money_result  [idx].value);	//������ ���޾�
	//workhour_year   = toFloat(f.workhour_year  [idx].value);	//�����ް��ð� mm-- 
	workhour_year   = 0;
	var emp5_gbn = "";
	var rate_ext, rate_hday, rate_night;
	if( emp5_gbn == "1" ) { // 5������
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
//�⺻����
$sql_paycode = " select * from com_paycode_list where com_code = '$com_code' and code='b1' ";
$row_paycode = sql_fetch($sql_paycode);
if($row_paycode[multiple]) {
	$rate_ext = $row_paycode[multiple];
} else {
	$rate_ext = 1.5;
}
if($row_paycode[manual] == "Y") $check_manual_ext = "checked";
//�߰��ٷ�
$sql_paycode = " select * from com_paycode_list where com_code = '$com_code' and code='b2' ";
$row_paycode = sql_fetch($sql_paycode);
if($row_paycode[multiple]) {
	$rate_night = $row_paycode[multiple];
} else {
	$rate_night = 2;
}
if($row_paycode[manual] == "Y") $check_manual_night = "checked";
//���ϱٷ�
$sql_paycode = " select * from com_paycode_list where com_code = '$com_code' and code='b3' ";
$row_paycode = sql_fetch($sql_paycode);
if($row_paycode[multiple]) {
	$rate_hday = $row_paycode[multiple];
} else {
	$rate_hday = 1.5;
}
if($row_paycode[manual] == "Y") $check_manual_hday = "checked";
?>
		rate_ext = <?=$rate_ext?>;
		rate_night = <?=$rate_night?>;
		rate_hday = <?=$rate_hday?>;
	}
	//����ӱݼ��� �հ�
	money_g_sum = money_g1+money_g2+money_g3+money_g4+money_g5;
	//alert(money_g_sum+"="+money_g1+"+"+money_g2+"+"+money_g3+"+"+money_g4+"+"+money_g5);

	//�ӱ��հ� ����
	if(f.money_e1_gy.value != "Y") money_e1 = 0;
	if(f.money_e2_gy.value != "Y") money_e2 = 0;
	if(f.money_e3_gy.value != "Y") money_e3 = 0;
	if(f.money_e4_gy.value != "Y") money_e4 = 0;
	if(f.money_e5_gy.value != "Y") money_e5 = 0;
	if(f.money_e6_gy.value != "Y") money_e6 = 0;
	if(f.money_e7_gy.value != "Y") money_e7 = 0;
	if(f.money_e8_gy.value != "Y") money_e8 = 0;
	//��Ÿ���� �հ�
	money_e_sum = money_e1+money_e2+money_e3+money_e4+money_e5+money_e6+money_e7+money_e8;

	k = idx-1;
	money_month_old = f['money_month_'+k].value;
	//�ñ���
	//alert(pay_gbn);
	if(pay_gbn == 1) {
		money_hour = money_month;
		//�ӱݻ��� �ѽð�
		//workhour_total = parseInt( ( workhour_1 + workhour_2 + workhour_3 + workhour_1_hday + workhour_2_hday + workhour_3_hday + workhour_edu + workhour_phone ) * 1000 ) / 1000;
		workhour_total = parseInt( ( workhour_1 + workhour_2 + workhour_3 + workhour_1_hday + workhour_2_hday + workhour_3_hday ) * 1000 ) / 1000;
		workhour_total = Math.round(workhour_total*100)/100;
		//money_base = Math.round( money_hour * workhour_day );
		//�⺻�� ���� : ������ �ƴ� ��� �⺻�� ���
		if(!f.money_month_fix.checked) money_base = Math.round( money_hour * workhour_day );
		//money_hour_ts = Math.round( money_hour + ( money_g_sum / workhour_day ) );
		//����ӱ� = �����ӱ�
		money_hour_ts = money_month;
		//money_hour_ts = 5160;
		if( isNaN(money_hour_ts) ) money_hour_ts = 0;
		f.money_hour_ds[idx].value = money_hour_ds;
		//alert(money_hour_ds);
	//�ϱ���
	} else if(pay_gbn == 4) {
		money_hour = money_month;
		//�ӱݻ��� �ѽð�
		workhour_total = parseInt( ( workhour_day + (workhour_ext*rate_ext) + (workhour_night*rate_night) + (workhour_hday*rate_hday) ) * 1000 ) / 1000;
		workhour_total = Math.round(workhour_total*100)/100;
		//alert(money_hour);
		money_base = Math.round( (money_hour/8) * workhour_day );
		//money_hour_ts = Math.round( money_hour + ( money_g_sum / workhour_day ) );
		//����ӱ� = �����ӱ�
		money_hour_ts = money_month;
		//money_hour_ts = 5160;
		if( isNaN(money_hour_ts) ) money_hour_ts = 0;
		f.money_hour_ds[idx].value = money_hour_ds;
		//alert(money_hour_ds);
	} else {
		//workhour_total �ӱݻ��� �ѽð� mm--
		//workhour_total = workhour_day + (workhour_ext*rate_ext) + (workhour_night*rate_night) + (workhour_hday*rate_hday) + (workhour_ext_add*rate_ext) + (workhour_night_add*rate_night) + (workhour_hday_add*rate_hday) + workhour_year -(workhour_late+workhour_leave+workhour_out+workhour_absence);
		workhour_total = workhour_day + (workhour_ext*rate_ext) + (workhour_night*rate_night) + (workhour_hday*rate_hday) + (workhour_ext_add*rate_ext) + (workhour_night_add*rate_night) + (workhour_hday_add*rate_hday) + workhour_year;

		//money_base �⺻��
		//money_base = money_month - money_ext - money_hday - money_night - money_year;
		
		//alert(money_base);
		//money_hour_ts ����ӱ�(�ð���) 
		if( workhour_total != 0 ){
			//�⺻�� �����Է�
			//alert(f.check_money_min_yn[idx].value);
			if(f.check_money_min_yn[idx].value == "Y") {
				//alert(f['money_month_'+k].value);
				if(money_month_old == money_month) {
					money_hour_ms = toInt(f.money_hour_ms[idx].value);
					if(!f.money_month_fix.checked) money_base = money_month - (money_ext + money_night + money_hday) - (money_g_sum + money_e_sum) - money_year;
					if(money_hour_ms != money_base) {
						if(!f.money_month_fix.checked) money_base = money_month - (money_ext + money_night + money_hday) - (money_g_sum + money_e_sum) - money_year;
					}
					//if(idx == 3) alert(money_base);
				} else {
					if(!f.money_month_fix.checked) money_base = money_month - (money_ext + money_night + money_hday) - (money_g_sum + money_e_sum) - money_year;
					//alert(money_base+" = "+money_month+" - ("+money_ext+" + "+money_night+" + "+money_hday+") - ("+money_g_sum+" + "+money_e_sum+") - "+money_year);
				}
				//�޿� �ش�� �߰� �Ի��� �⺻�� ����
				if(money_base > money_month_old) {
					if(!f.money_month_fix.checked) money_base = money_month - (money_ext + money_night + money_hday) - (money_g_sum + money_e_sum) - money_year;
				}
				money_hour_ts = Math.round( ( money_base + money_g_sum ) / workhour_day);
				//alert(money_hour_ts+"=("+money_base+"+"+money_g_sum+")/"+workhour_day);
				//alert(money_base);
			} else {
				if(!f.money_month_fix.checked) money_base = money_month - (money_ext + money_night + money_hday) - (money_g_sum + money_e_sum) - money_year;
				money_hour_ts = ( money_month - money_g_sum ) / workhour_day;
			}
		}
	}
	//�����ӱ� 0 �̸� ���ñ�, �⺻�� 0
	if(money_month == 0) money_hour_ts = 0;
	if(money_month == 0) money_base = 0;
	//money_ext ����ٷμ��� 
	//money_hday ���ϱٷμ���
	//money_night �߰��ٷμ��� 
	//money_year �������� -----------------------------------

	//�������� �����Է� (�������-�޿�����) ����ٷ� �����Է� 140610
	if(!f.manual_ext.checked) {
		if(f.check_money_b_yn[idx].value == "Y") money_ext = parseInt(f.money_b1[idx].value);
		else money_ext = Math.round(workhour_ext * money_hour_ts * rate_ext);
	}
	//alert(money_ext);
	//�����Է� �߰��ٷ�
	if(!f.manual_night.checked) {
		if(f.check_money_b_yn[idx].value == "Y") money_night = parseInt(f.money_b2[idx].value);
		else money_night = Math.round(workhour_night * money_hour_ts * rate_night);
	}
	//�����Է� ���ϱٷ�
	if(!f.manual_hday.checked) {
		if(f.check_money_b_yn[idx].value == "Y") money_hday = parseInt(f.money_b3[idx].value);
		else money_hday = Math.round(workhour_hday * money_hour_ts * rate_hday);
	}
	//�߰��ٷμ���
	money_ext_add = Math.round(workhour_ext_add * money_hour_ts * rate_ext);
	money_night_add = Math.round(workhour_night_add * money_hour_ts * rate_night);
	money_hday_add = Math.round(workhour_hday_add * money_hour_ts * rate_hday);
	//��������
	//money_year = Math.round(workhour_year * money_hour_ts );

	//�����ӱ� �������� ���ñ�, �⺻�� ���� �ݺ���
	if(money_month_old != money_month) {
		for(i=0;i<20;i++) {
			//money_base = money_month - (money_ext + money_night + money_hday) - (money_g_sum + money_e_sum) - money_year;
			if(!f.money_month_fix.checked) money_base = money_month - (money_ext + money_night + money_hday) - (money_g_sum + money_e_sum) - money_year;
			//alert(money_base+" = "+money_month+" - ("+money_ext+" + "+money_night+" + "+money_hday+") - ("+money_g_sum+" + "+money_e_sum+") - "+money_year);
			//�ñ��� (����ӱ� ����)
			if(pay_gbn == 1) money_hour_ts = money_month;
			else money_hour_ts = Math.round( ( money_base + money_g_sum ) / workhour_day);
			//alert(money_hour_ts+"=("+money_base+"+"+money_g_sum+")/"+workhour_day);
			money_ext = Math.round(workhour_ext * money_hour_ts * rate_ext);
			//alert(money_ext);
			money_hday = Math.round(workhour_hday * money_hour_ts * rate_hday);
			money_night = Math.round(workhour_night * money_hour_ts * rate_night);
			money_ext_add = Math.round(workhour_ext_add * money_hour_ts * rate_ext);
			money_night_add = Math.round(workhour_night_add * money_hour_ts * rate_night);
			money_hday_add = Math.round(workhour_hday_add * money_hour_ts * rate_hday);
		}
	}
	//����ӱ�(�ð���) �ݿø�
	money_hour_ts = Math.round(money_hour_ts);
	//money_base = money_month - (money_ext + money_night + money_hday) - money_g_sum - money_year;
	//�⺻�� ����
	//alert(money_base+"="+money_month+"-("+money_ext+"+"+money_night+"+"+money_hday+")-("+money_g_sum+"+"+money_e_sum+")-"+money_year);
	//alert(money_base+"="+money_month+"-("+money_ext+"+"+money_night+"+"+money_hday+")-"+money_g_sum+"-"+money_year);

	//���°���
	etc2 = money_time * (workhour_late+workhour_leave+workhour_out+workhour_absence);

	money_total = parseInt( (workhour_1*<?=$money_time1_com?>) + (workhour_2*<?=$money_time2_com?>) + (workhour_3*<?=$money_time3_com?>) + (workhour_1_hday*<?=$money_time1_hday_com?>) + (workhour_2_hday*<?=$money_time2_hday_com?>) + (workhour_3_hday*<?=$money_time3_hday_com?>) + money_year );
<?
//��������
$sql_paycode = " select * from com_paycode_list where com_code = '$com_code' and code='e1' ";
$row_paycode = sql_fetch($sql_paycode);
if($row_paycode[tax_limit]) {
	$money_e1_tax_limit = preg_replace('@,@', '', $row_paycode[tax_limit]);
} else {
	$money_e1_tax_limit = 0;
}
//�Ĵ�
$sql_paycode = " select * from com_paycode_list where com_code = '$com_code' and code='e2' ";
$row_paycode = sql_fetch($sql_paycode);
if($row_paycode[tax_limit]) {
	$money_e2_tax_limit = preg_replace('@,@', '', $row_paycode[tax_limit]);
} else {
	$money_e2_tax_limit = 0;
}
//�ڳຸ��
$sql_paycode = " select * from com_paycode_list where com_code = '$com_code' and code='e3' ";
$row_paycode = sql_fetch($sql_paycode);
if($row_paycode[tax_limit]) {
	$money_e3_tax_limit = preg_replace('@,@', '', $row_paycode[tax_limit]);
} else {
	$money_e3_tax_limit = 0;
}
//����Ȱ����
$sql_paycode = " select * from com_paycode_list where com_code = '$com_code' and code='e4' ";
$row_paycode = sql_fetch($sql_paycode);
if($row_paycode[tax_limit]) {
	$money_e4_tax_limit = preg_replace('@,@', '', $row_paycode[tax_limit]);
} else {
	$money_e4_tax_limit = 0;
}
?>

	//��Ÿ���� �������� ����, ����� �ѵ� ����
	//alert(f.money_e6_income.value);
	if(f.money_e1_income.value != "Y") {
		if(money_e1 > toInt(<?=$money_e1_tax_limit?>)) money_e1 = money_e1 - toInt(<?=$money_e1_tax_limit?>);
		else money_e1 = 0;		
	}
	if(f.money_e2_income.value != "Y") {
		if(money_e2 > toInt(<?=$money_e2_tax_limit?>)) money_e2 = money_e2 - toInt(<?=$money_e2_tax_limit?>);
		else money_e2 = 0;
	}
	if(f.money_e3_income.value != "Y") {
		if(money_e3 > toInt(<?=$money_e3_tax_limit?>)) money_e3 = money_e3 - toInt(<?=$money_e3_tax_limit?>);
		else money_e3 = 0;
	}
	if(f.money_e4_income.value != "Y") {
		if(money_e4 > toInt(<?=$money_e4_tax_limit?>)) money_e4 = money_e4 - toInt(<?=$money_e4_tax_limit?>);
		else money_e4 = 0;
	}
	if(f.money_e5_income.value != "Y") {
		if(money_e5 > toInt(<?=$money_e5_tax_limit?>)) money_e5 = money_e5 - toInt(<?=$money_e5_tax_limit?>);
		else money_e5 = 0;
	}
	if(f.money_e6_income.value != "Y") {
		if(money_e6 > toInt(<?=$money_e6_tax_limit?>)) money_e6 = money_e6 - toInt(<?=$money_e6_tax_limit?>);
		else money_e6 = 0;
	}
	if(f.money_e7_income.value != "Y") {
		if(money_e7 > toInt(<?=$money_e7_tax_limit?>)) money_e7 = money_e7 - toInt(<?=$money_e7_tax_limit?>);
		else money_e7 = 0;
	}
	if(f.money_e8_income.value != "Y") {
		if(money_e8 > toInt(<?=$money_e8_tax_limit?>)) money_e8 = money_e8 - toInt(<?=$money_e8_tax_limit?>);
		else money_e8 = 0;
	}

	//f.error_code.value += money_e1;
	//��Ÿ���� �հ� (�����ҵ� ����)
	money_e_income_sum = money_e1+money_e2+money_e3+money_e4+money_e5+money_e6+money_e7+money_e8;
	//alert(money_e_income_sum);
	//f.error_code.value += ", "+money_e_income_sum;

	//money_for_tax = (money_total - money_e_sum) + money_e_income_sum;
	money_pay = parseInt( (workhour_1*<?=$money_time1?>) + (workhour_2*<?=$money_time2?>) + (workhour_3*<?=$money_time3?>) + (workhour_1_hday*<?=$money_time1_hday?>) + (workhour_2_hday*<?=$money_time2_hday?>) + (workhour_3_hday*<?=$money_time3_hday?>) + (workhour_edu*<?=$money_time_edu?>) + (workhour_phone*<?=$money_time_phone?>) + money_year );
	money_for_tax = money_pay;

	//�η紩�� ������ 50%
	//durunuri_50 = 1;
	//alert(durunuri);
	if(f.durunuri[idx].value == "1") durunuri_50 = 2;
	else durunuri_50 = 1;
	//4�뺸�� �����Է� ���� (�ڵ� ���� ���� ����)
	if(!f.manual_4insure.checked) {
		//����սŰ�ݾ�
		pay_yun = toInt(f.pay_yun[idx].value);
		//alert(pay_yun);
		pay_health = toInt(f.pay_health[idx].value);
		pay_goyong = toInt(f.pay_goyong[idx].value);
		if(pay_yun > 0) money_for_4i = pay_yun;
		else money_for_4i = money_for_tax;
		//money_yun ���ο���  
		//money_yun = parseInt( ( parseInt(money_for_tax/1000)*1000 * 0.045 ) * 0.1 ) * 10

		//���ο��� �����Է��� �ƴϸ�(�ڵ�) 151029
		if(!f.manual_yun.checked) money_yun = get_round( parseInt(money_for_4i) * 0.045 / durunuri_50 );
		//money_yun = get_round( parseInt(money_for_4i) * 0.045 / durunuri_50 );
		//money_health �ǰ����� 
		//money_health = parseInt(money_for_tax* 0.02945 *0.1)*10
		//money_health = get_round( parseInt(money_for_tax) * 0.02945 );
		//money_health = get_round( parseInt(money_for_tax) * 0.02995 );
		if(pay_health > 0) money_for_4i = pay_health;
		else money_for_4i = money_for_tax;
		money_health = get_round( parseInt(money_for_4i) * 0.03035 );
		//money_yoyang ����纸�� 
		//money_yoyang = parseInt(money_health* 0.0655 *0.1)*10
		money_yoyang = get_round( money_health* 0.0655  );
		//alert(money_yoyang);
		//money_goyong ��뺸��
		if(pay_goyong > 0) money_for_4i = pay_goyong;
		else money_for_4i = money_for_tax;
		money_goyong = get_round( parseInt(money_for_4i) * 0.0065 / durunuri_50 );
		//4�뺸�� ���� ����
		if(f.iskm[idx].value != "checked") money_yun = 0;
		if(f.isgg[idx].value != "checked") money_health = 0;
		if(f.isjy[idx].value != "checked") money_yoyang = 0;
		if(f.isgy[idx].value != "checked") money_goyong = 0;
	}
	//���� �����Է� ����
	if(!f.manual_tax.checked) {
		//tax_so �ҵ漼
		if(f.check_money_so_yn[idx].value == "0") {
			tax_so = GetTax( money_for_tax, idx );
		} else {
			tax_so = 0;
		}
		//����ҵ��� 3.3% ����
		if(f.check_business_yn[idx].value == "0") {
			//alert(f.money_time[idx].value);
			//money_day = toInt(f.money_time[idx].value) * 8;
			tax_so = get_round(money_for_tax* 0.03 );
			if(tax_so <= 1000) tax_so = 0;
		}
		//tax_jumin �ֹμ�
		tax_jumin = get_round(tax_so* 0.1 );
	}

	//4�뺸�� �����Է� ����(�����)
	if(!f.c_manual_4insure.checked) {
		//����սŰ�ݾ�
		pay_yun = toInt(f.pay_yun[idx].value);
		//alert(pay_yun);
		pay_goyong = toInt(f.pay_goyong[idx].value);
		if(pay_yun > 0) money_for_4i = pay_yun;
		else money_for_4i = money_for_tax;
		//c_money_yun = get_round( parseInt(money_for_4i) * 0.045 / durunuri_50 );
		//���ο��� �����Է��� �ƴϸ�(�ڵ�) 151029
		if(!f.manual_yun.checked) c_money_yun = get_round( parseInt(money_for_4i) * 0.045 / durunuri_50 );
		//�ǰ����� ���(�����)
		pay_health = toInt(f.pay_health[idx].value);
		if(pay_health > 0) money_for_4i = pay_health;
		else money_for_4i = money_for_tax;
		c_money_health = get_round( parseInt(money_for_4i) * 0.03035 );
		//money_yoyang ����纸�� 
		//money_yoyang = parseInt(money_health* 0.0655 *0.1)*10
		c_money_yoyang = get_round( money_health* 0.0655  );
		//alert(money_yoyang);
		//money_goyong ��뺸��
		if(pay_goyong > 0) money_for_4i = pay_goyong;
		else money_for_4i = money_for_tax;
		c_money_goyong = get_round( parseInt(money_for_4i) * 0.00899 / durunuri_50 );
		//���纸��
		c_money_sanjae = get_round( parseInt(money_for_4i) * 0.00784 / durunuri_50 );
		//4�뺸�� ���� ���� (�����)
		if(f.iskm[idx].value != "checked") c_money_yun = 0;
		if(f.isgg[idx].value != "checked") c_money_health = 0;
		if(f.isjy[idx].value != "checked") c_money_yoyang = 0;
		if(f.isgy[idx].value != "checked") c_money_goyong = 0;
		if(f.issj[idx].value != "checked") c_money_sanjae = 0;
	}
	//���ο���, �ǰ�����, �����, �������� 60�ð� �̸� �ٷ��� 0 ó�� 150909
	if(workhour_total < 60) {
		if(!f.manual_4insure.checked) {
			money_yun = 0;
			money_health = 0;
			money_yoyang = 0;
		}
		if(!f.c_manual_4insure.checked) {
			c_money_yun = 0;
			c_money_health = 0;
			c_money_yoyang = 0;
		}
		retirement_pension = 0;
	} else {
		retirement_pension = Math.ceil((money_for_tax / 12)/10)*10;
	}
	//money_gongje ������ 
	money_gongje = money_yun+money_health+money_yoyang+money_goyong+tax_so+tax_jumin+minus+minus2;
	c_money_gongje = c_money_yun+c_money_health+c_money_yoyang+c_money_goyong+c_money_sanjae;
	//if(idx == 1) alert(c_money_gongje);
	//money_result ������ ���޾� 
	money_result = money_for_tax - money_gongje;

	//�Ҽ��� 2�ڸ� �ݿø�
	workhour_total = workhour_total.toFixed(2);
	money_hour_ts = money_hour_ts.toFixed(2);
	//alert(money_hour_ts);

	//����ӱ�(�ð���) < �����ӱ�(2014��)
	money_min = 5210;
	if(money_hour_ts < money_min) {
		f.money_hour_ts[idx].style.color = "red";
	} else {
		f.money_hour_ts[idx].style.color = "#343434";
	}

	//õ���� ����
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

	c_money_yun = number_format(c_money_yun);
	c_money_health = number_format(c_money_health);
	c_money_yoyang = number_format(c_money_yoyang);
	c_money_goyong = number_format(c_money_goyong);
	c_money_sanjae = number_format(c_money_sanjae);
	c_money_gongje = number_format(c_money_gongje);
	retirement_pension = number_format(retirement_pension);

	tax_so = number_format(tax_so);
	tax_jumin = number_format(tax_jumin);
	minus2 = number_format(minus2);
	etc2 = number_format(etc2);

	money_gongje = number_format(money_gongje);
	money_result = number_format(money_result);

	//���� input �Է�
	//f.error_code.value = money_base;
	f.money_hour_ts[idx].value = money_hour_ts //money_hour_ts ����ӱ�(�ð���) 
	f.workhour_total[idx].value = workhour_total //workhour_total �ӱݻ��� �ѽð� mm--
<?
if(!$row3['money_month']) {
?>
	f.money_base[idx].value = money_base //money_base �⺻��
<? } ?>
	if(f.check_money_b_yn[idx].value != "Y") {
		if(!f.manual_ext.checked) f.money_ext[idx].value = money_ext //money_ext ����ٷμ���
		if(!f.manual_night.checked) f.money_night[idx].value = money_night //money_night �߰��ٷμ���
		if(!f.manual_hday.checked) f.money_hday[idx].value = money_hday //money_hday ���ϱٷμ���
	}
	//f.money_year[idx].value = money_year //money_year �������� ------------------------

	f.money_ext_add[idx].value = money_ext_add //money_ext ����ٷμ���(�߰�)
	f.money_hday_add[idx].value = money_hday_add //money_hday ���ϱٷμ���(�߰�)
	f.money_night_add[idx].value = money_night_add //money_night �߰��ٷμ���(�߰�)

	f.money_total[idx].value = money_total //money_total �ӱݰ� 
	f.money_for_tax[idx].value = money_for_tax //money_for_tax �����ҵ� 

	f.money_yun[idx].value = money_yun //money_yun ���ο��� 
	f.money_health[idx].value = money_health //money_health �ǰ����� 
	f.money_yoyang[idx].value = money_yoyang //money_yoyang ����纸�� 
	f.money_goyong[idx].value = money_goyong //money_goyong ��뺸�� 

	f.c_money_yun[idx].value = c_money_yun //c_money_yun ���ο��� 
	f.c_money_health[idx].value = c_money_health //c_money_health �ǰ����� 
	f.c_money_yoyang[idx].value = c_money_yoyang //c_money_yoyang ����纸�� 
	f.c_money_goyong[idx].value = c_money_goyong //c_money_goyong ��뺸�� 
	f.c_money_sanjae[idx].value = c_money_sanjae //c_money_sanjae ���纸��
	f.c_money_gongje[idx].value = c_money_gongje //c_money_gongje ������(�����)
	f.retirement_pension[idx].value = retirement_pension //��������

	f.tax_so[idx].value = tax_so //tax_so �ҵ漼 
	f.tax_jumin[idx].value = tax_jumin //tax_jumin �ֹμ� 

	f.minus2[idx].value = minus2 //���°���
	f.etc2[idx].value = etc2 //���°���

	f.money_gongje[idx].value = money_gongje //money_gongje ������ 
	f.money_result[idx].value = money_result //money_result ������ ���޾� 
}
</script>