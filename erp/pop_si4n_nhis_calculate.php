<?
include_once("./_common.php");
$html_title = "4�뺸�����";
?>
<html>
<head>
<title><?=$html_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css" />
</head>
<body topmargin="0" leftmargin="0">
<div id="loading" style="position:absolute;top:0px;right:0px;left:0px;bottom:0px;background:#000;z-index:100;color:#FFF;padding:20px;">
	��ø� ��ٷ� �ֽʽÿ�. ������ �ε� ���Դϴ�.
</div>
<script type="text/javascript" src="js/common.js"></script>
<!--�������� -->
<script type="text/javascript" src="popup/images/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="popup/images/jquery.maskedinput-1.3.min.js"></script>
<script type="text/javascript">
function getId(id)
{
	return document.getElementById(id);
}
function showM(m) {
	//���� �޴� 14�� ������ ���θ޴� �߰� 150916
	for(i=1;i<=14;i++) {
		hideM(i+"00");
	}
	var box = getId('subMenuBox'+m);
	if(box) {
		box.style.display = 'block';
		//box.style.top = -20;
	}
}
//����Խ��� �Է� �޸�
function checkcomma(inputVal, type, keydown) {		// inputVal�� õ������ , ǥ�ø� ���� �������� ��
	var main = document.dataForm;			// ���⼭ type �� �ش��ϴ� ���� �ֱ� ���� ��ġ���� index
	var chk		= 0;				// chk �� õ������ ���� ���̸� check
	var chk2	= 0;
	var chk3	= 0;
	var share	= 0;				// share 200,000 �� ���� 3�� ����� ���� �����ϱ� ���� ����
	var start	= 0;
	var triple	= 0;				// triple 3, 6, 9 �� 3�� ��� 
	var end		= 0;				// start, end substring ������ ���� ����  
	var total	= "";			
	var input	= "";				// total ���Ƿ� string ���� �����ϱ� ���� ����
	//���� �Է¸�
	//alert(event.keyCode);
	input = delcomma(inputVal, inputVal.length);
	//������ master �Է�
	//alert(input);
	if(1 == 1) { // ��� ����
		//�齺���̽�Ű ����
		if(event.keyCode != 8) {
			//alert(inputVal.length);
			//alert(input);
			if(inputVal.length == 4){
				//input = delhyphen(inputVal, inputVal.length);
				total += input.substring(0,4)+".";
			} else if(inputVal.length == 7){
				total += inputVal.substring(0,7)+".";
			} else if(inputVal.length == 12){
				total += inputVal.substring(0,14)+"";
			} else {
				total += inputVal;
			}
			if(keydown =='Y'){
				type.value=total;
			}else if(keydown =='N'){
				return total
			}
		}
		return total
	}
}
function delcomma(inputVal, count){
	var tmp = "";
	for(i=0; i<count; i++){
		if(inputVal.substring(i,i+1)!='.'){		// ���� substring�� ����
			tmp += inputVal.substring(i,i+1);	// ���� ��� , �� ����
		}
	}
	return tmp;
}
function getInternetVersion(browser) {
	var rv = -1; // Return value assumes failure.     
	var ua = navigator.userAgent; 
	var re = null;
	if(browser=="MSIE") {
	 re = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
	 if(re.exec(ua) == null) { // IE11 above (Trident)
		re = new RegExp("rv:([0-9]{1,}[\.0-9]{0,})");
	 }
	}
	else if(browser=="Safari" || browser=="Opera") re = new RegExp("Version/([0-9]{1,}[\.0-9]{0,})");
	else re = new RegExp(browser+"/([0-9]{1,}[\.0-9]{0,})");
	if(re.exec(ua) != null) {
	 rv = parseInt(RegExp.$1);
	}
	return rv; 
}
//������ ���� �� ����Ȯ�� 
function getBroswserType() {
	var browser = "UnKnown";
	if(navigator.appName.charAt(0) == "N") { // Netscape
	 if(navigator.userAgent.indexOf("Chrome") != -1) browser = "Chrome";
	 else if(navigator.userAgent.indexOf("Firefox") != -1) browser = "Firefox";
	 else if(navigator.userAgent.indexOf("Safari") != -1) browser = "Safari";
	 else if(navigator.userAgent.indexOf("Opera") != -1) browser = "Opera";
	 else if(navigator.userAgent.indexOf("Trident") != -1) browser = "MSIE"; // IE11 above (Trident)
	}
	else if(navigator.appName.charAt(0) == "M") { // Microsoft Internet Explorer
	 browser = "MSIE";
	}
	else if(navigator.appName.indexOf("Opera") != -1) { // Opera
	 browser = "Opera";
	}
	return browser;
}
//��ǥ ����
function clientxy(e) {
	var frm = document.dataForm;

	// InternetVersion
 var browser = getBroswserType();
 var ver = getInternetVersion(browser);

	//var browser = navigator.userAgent
	//frm.error_code.value = browser+" "+ver;
	if(browser=="MSIE") {   //�������� IE�϶� ���ư���. ũ�ҿ��� �ᵵ �� �ȴ�.
		//alert("���� ��ǥ�� " + event.x + "/" + event.y);
		x = event.x;
		y = event.y+document.body.scrollTop;
	} else {   //�׿�(���̾�����)�� �� ���ư���.
		//alert("���� ��ǥ�� " + e.clientX + "/" + e.clientY);
		x = e.clientX;
		y = e.clientY;
	}
	//�̰Ŵ� �׳� ������ ���� �������� ��� ��ǥ ǥ��
	//alert("��� ��ǥ��" + screen.width/2 + "/" + screen.height/2 )
	div_id = document.getElementById('couponHelpDiv');
	div_id.style.display = 'block';
	div_id.style.top = y+"px";
	div_id.style.left = x+"px";
}
function emp_text(emp_name,emp_sdate,emp_position,family_count,emp_work_gbn,emp_pay_gbn,emp_money_base,emp_money_min,emp_money_time) {
	getId('emp_name').innerHTML = emp_name;
	getId('emp_sdate').innerHTML = emp_sdate;
	getId('emp_position').innerHTML = emp_position;
	getId('family_count').innerHTML = family_count;
	getId('emp_work_gbn').innerHTML = emp_work_gbn;
	getId('emp_pay_gbn').innerHTML = emp_pay_gbn;
}
//�޿����� ���� (������)
function pay_gbn_month() {
	var frm = document.dataForm;
	frm.pay_gbn_value.value = "0";
}
addLoadEvent(pay_gbn_month);
//������ �ε��� 160329
$(document).ready(function(){
	$("#loading").css("display","none");
});

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
include "./inc/ary_tax_2015.php";
?>
function GetTax(money_for_tax, idx) {
	var f = document.dataForm;
	//alert(idx+" / "+f.family_cnt[idx].value);
	//family_cnt = parseInt(f.family_cnt[idx].value)+parseInt(f.child_cnt[idx].value);
	//�ξ簡�� 20�� �̸� �ڳ� *2 ���� 160502
	family_cnt = parseInt(f.family_cnt[idx].value);
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
		//���°��� �����Է� 160331
		} else if(m_name.name == "manual_etc2") {
			if(m_name.checked) frm.etc2[i].className = "textfm";
			else frm.etc2[i].className = "textfm5";
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
	var money_month,money_hour,money_hour_ts,workhour_day,workhour_ext,workhour_night,workhour_hday,workhour_ext_add,workhour_night_add,workhour_hday_add,workhour_total;
	var week_hday,year_hday,money_base,money_ext,money_night,money_hday,money_ext_add,money_night_add,money_hday_add,money_week,money_year;
	var money_g1,money_g2,money_g3,money_g4,money_g5,money_e1,money_e2,money_e3,money_e4,money_e5,money_e6,money_e7,money_e8,money_e9;
	var money_total,money_for_tax,money_yun,money_health,money_yoyang,money_goyong,tax_so,tax_jumin,minus,minus2,etc,etc2,money_gongje,money_result, workhour_year;
	money_month     = toInt(f.money_month   [idx].value);    //�⺻���� mm--        
	money_hour      = toInt(f.money_hour    [idx].value); 	//���ؽñ� hh--        
	money_hour_ts   = toInt(f.money_hour_ts [idx].value);	//����ӱ�(�ð���)     


	workhour_day    = toFloat(f.workhour_day  [idx].value);	//�����ٷνð�         
	workhour_ext    = toFloat(f.workhour_ext  [idx].value);	//����ٷνð�
	workhour_night  = toFloat(f.workhour_night[idx].value);	//�߰��ٷνð�         
	workhour_hday   = toFloat(f.workhour_hday [idx].value);	//���ϱٷνð�         

	workhour_ext_add    = toFloat(f.workhour_ext_add  [idx].value);	//�߰�����ٷνð�
	workhour_night_add    = toFloat(f.workhour_night_add  [idx].value);	//�߰��߰��ٷνð�
	workhour_hday_add    = toFloat(f.workhour_hday_add  [idx].value);	//�߰����ϱٷνð�

	workhour_total  = toFloat(f.workhour_total[idx].value);	//�ӱݻ��� �ѽð� mm-- 
	week_hday       = toInt(f.week_hday     [idx].value);   // �������ϼ� hh--      
	year_hday       = toInt(f.year_hday     [idx].value);	// ���������ް��ϼ� hh--
	money_base      = toInt(f.money_base    [idx].value);	// �⺻��               
	money_ext       = toInt(f.money_ext     [idx].value);	// ����ٷμ���         
	money_hday      = toInt(f.money_hday    [idx].value);	// ���ϱٷμ���         
	money_night     = toInt(f.money_night   [idx].value);	// �߰��ٷμ���         
	money_week      = toInt(f.money_week    [idx].value);	// ���޼��� hh--        
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
	money_e9        = toInt(f.money_e9      [idx].value);

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
	money_result    = toInt(f.money_result  [idx].value);	//������ ���޾�
	//workhour_year   = toFloat(f.workhour_year  [idx].value);	//�����ް��ð� mm-- 
<?
//�뼺������ũ , �뼺������, �׿��� ������ ���� ����
if($comp_print_type == "D" || $com_code == "20099") {
?>
	money_gongje = money_yun+money_health+money_yoyang+money_goyong+tax_so+tax_jumin+minus+minus2+etc;
	//alert(money_gongje);
<?
} else {
?>
	//money_gongje ������ = ���ο���+�ǰ�����+����纸��+��뺸��+�ҵ漼+�ֹμ�
	money_gongje = money_yun+money_health+money_yoyang+money_goyong+tax_so+tax_jumin+minus+minus2;
<?
}
?>
	//money_result ������ ���޾� 
	money_result = money_total - money_gongje;
	f.money_gongje[idx].value = number_format(money_gongje); //money_gongje ������ 
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
	frm.money_e9[idx].className = "textfm_trans";

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
	frm.money_result[idx].className = "textfm_trans";
	//frm.workhour_year[idx].className = "textfm_trans";
}
function focusOutClass(idx) {
	//alert(idx);
	var frm = document.dataForm;
	if(frm.idx[idx].checked == false) {
		//frm.emp_pname[idx].className = "textfm";
		frm.money_month[idx].className = "textfm";

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
		frm.money_e9[idx].className = "textfm";

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
		//frm.etc2[idx].className = "textfm5";

		//���°��� �����Է� üũ�� �Է� ���� 160331
		if(frm.manual_etc2.checked) frm.etc2[idx].className = "textfm";
		else frm.etc2[idx].className = "textfm5";

		frm.money_gongje[idx].className = "textfm5";
		frm.money_result[idx].className = "textfm5";
		//frm.workhour_year[idx].className = "textfm";
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
		//�⺻�� �����Է� ����
		f.money_month_fix.checked = false;
		money_month = toInt(f.money_month[idx].value);
		money_month_var = (money_month / end_day) * work_day;
		f.money_month[idx].value = number_format(Math.floor(money_month_var/10)*10);
		//�ٷνð�
		workhour_day = toInt(f.workhour_day[idx].value);
		workhour_day_var = (workhour_day / end_day) * work_day;
		//alert("("+workhour_day+" / "+end_day+") * "+work_day);
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
		money_e9 = toInt(f.money_e9[idx].value);
		money_e9_var = (money_e9/end_day) * work_day;
		f.money_e9[idx].value = number_format(Math.floor(money_e9_var/10)*10);

		cal_pay(idx);
	} else {
		return;
	}
}
</script>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-top:10px">
	<tr>
		<td style="padding:0 20 0 20">
			<!--Ÿ��Ʋ -->
			<table width="100%" border=0 cellspacing=0 cellpadding=0>
				<tr>     
					<td height="18">
						<table width="100%" border=0 cellspacing=0 cellpadding=0>
							<tr>
								<td style='font-size:8pt;color:#929292;'>
									<img src="./images/title_icon.gif" align="absmiddle" style="margin:0 5px 2px 0;"><span style="font-size:9pt;color:black;"><?=$html_title?></span>
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
			<!--��޴� -->
<?
$colspan = 12;
//$total_count = 10;
$total_count = $_GET['cnt'];
//�޿��ݿ� ���̺� ����
$pay_list_width = 3550;
$money_month_text = "�����ӱ�";
?>
							<!--�˻� -->
							<form name="dataForm" method="post">
								<input type="hidden" name="mode">
								<input type="hidden" name="pay_gbn_value" value="0">
								<input type="hidden" name="code" value="<?=$id?>">
								<input type="hidden" name="total_count" value="<?=$total_count?>">
								<!--��޴� -->
								<table border=0 cellspacing=0 cellpadding=0> 
									<tr> 
										<td id="Tab_cust_tab_01_0" valign="bottom"> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="./images/g_tab_on_lt.gif"></td> 
													<td background="./images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80px;text-align:center'> 
													<a href="#">�޿��Է�</a>
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
											<div id="step2" style="cursor:pointer;margin:0 5px 0 0;display:none;"><img src="images/pay_step2.gif" id="pay_step2"></div>
										</td> 
										<td width="" align="left">
											<div id="step3" style="cursor:pointer;margin:0 5px 0 0;display:none;"><img src="images/pay_step3.gif" id="pay_step3"></div>
										</td> 
										<td width="" align="left">
											<div id="step4" style="cursor:pointer;margin:0 5px 0 0;display:none;"><img src="images/pay_step4.gif" id="pay_step4"></div>
										</td> 
										<td width="" align="left">
											<div id="step5" style="cursor:pointer;margin:0 5px 0 0"><img src="images/pay_step5.gif" id="pay_step5"></div>
										</td> 
										<td align="right" style="padding-left:20px">����� : <?=$total_count?>��</td>
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>

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
$sql_manual = " select * from pibohum_base_pay where com_code='$com_code' and year = '$search_year' and month = '$search_month' and w_date != '0000-00-00' order by manual desc ";
//echo $sql_manual;
$row_manual = sql_fetch($sql_manual);
//echo "//����".$row_manual[manual];
$manual_array = explode(",",$row_manual[manual]);
if($manual_array[0] == "1") $check_manual_ext = "checked";
if($manual_array[1] == "1") $check_manual_night = "checked";
if($manual_array[2] == "1") $check_manual_hday = "checked";
if($manual_array[3] == "1") $check_manual_4insure = "checked";
if($manual_array[4] == "1") $check_manual_tax = "checked";

if($manual_array[6] == "1") $check_manual_etc2 = "checked";
//������ �����Է� ����
if($data == "load") {
	$check_manual_4insure = "";
	$check_manual_tax = "";
}
//�⺻�� ����
$sql_money_month = " select * from pibohum_base_pay where com_code='$com_code' and year = '$search_year' and month = '$search_month' and w_date != '0000-00-00' order by w_date desc, w_time desc ";
$row_money_month = sql_fetch($sql_money_month);
if($row_money_month['money_month_fix'] == "Y") $check_money_month_fix = "checked";

//�ѱ�����濵�� 395 �⺻��, 4�뺸�� ���� ���� 160603
if($com_code == 395) {
	$check_money_month_fix = "checked";
	$check_manual_4insure = "checked";
}

//�޿����� �̵�Ͻ� �⺻��, �������, ���°���, 4�뺸�� �����Է� üũ 160401
if(!$w_date_ok) {
	//$check_money_month_fix = "checked";
	//$check_manual_ext = "checked";
	//$check_manual_etc2 = "checked";
//	$check_manual_4insure = "checked";
}
?>
											<div id="spanTop" style="width:100%;overflow:hidden">
												<table cellpadding="0" cellspacing="0" border="0">
													<tr>
														<td>  
															<table width="<?=$pay_list_width?>" border="0" cellpadding="0" cellspacing="1" class="bgtable">
																<tr>
																	<td class="tdhead_center" rowspan="4" width="45">�ξ�<br />����</td>
																	<td class="tdhead_center" colspan="10">�����޿� �� �ٷνð�(��) </td>
																	<td class="tdhead_center" rowspan="4" width="18"></td>
																	<td class="tdhead_center" colspan="7">�⺻�� �� ������ </td>
																	<td class="tdhead_center" rowspan="4" width="18"></td>
																	<td class="tdhead_center" colspan="7">�⺻�� �� ������ </td>
																	<td class="tdhead_center" rowspan="4" width="18"></td>
																	<td class="tdhead_center" colspan="9">�⺻�� �� ������ </td>
																	<td class="tdhead_center" rowspan="4" width="18"></td>
																	<td class="tdhead_center" colspan="2"> </td>
																	<td class="tdhead_center" colspan="8">������</td>
																	<td class="tdhead_center" rowspan="4" width="74">������<br>���޾� </td>
																	<td class="tdhead_center" rowspan="4" width="18"></td>
																</tr>
																<tr>
																	<td class="tdhead_center" rowspan="3" width="66"><?=$money_month_text?></td>
																	<td class="tdhead_center" colspan="4">�ٷνð�</td>
																	<td class="tdhead_center" colspan="4">���°����ð�</td>
																	<td class="tdhead_center" rowspan="3" width="63">�ӱݻ���<br>�ѽð� </td>

																	<td class="tdhead_center" colspan="7">�⺻����</td>
																	<td class="tdhead_center" colspan="5">������</td>
																	<td class="tdhead_center" colspan="2">��Ÿ</td>
																	<td class="tdhead_center" colspan="9">��Ÿ����</td>
																	<td class="tdhead_center" rowspan="3" width="68">�ӱݰ�</td>
																	<td class="tdhead_center" rowspan="3" width="68">�����ҵ�</td>
																	<td class="tdhead_center" colspan="4"><input type="checkbox" name="manual_4insure" <?=$check_manual_4insure?> onclick="check_manual(this);" value="1" title="�����Է�" style="vertical-align:middle;"> 4�뺸��</td>
																	<td class="tdhead_center" colspan="2"><input type="checkbox" name="manual_tax" <?=$check_manual_tax?> onclick="check_manual(this);" value="1" title="�����Է�" style="vertical-align:middle;"> ����</td>
																	<td class="tdhead_center" colspan="1">��Ÿ</td>
																	<td class="tdhead_center" rowspan="3" width="72">������</td>
																</tr>
																<tr>
																	<td class="tdhead_center" rowspan="2" width="63">����<br>�ٷνð�</td>
																	<td class="tdhead_center" rowspan="2" width="63">����<br>�ٷνð�</td>
																	<td class="tdhead_center" rowspan="2" width="63">�߰�<br>�ٷνð�</td>
																	<td class="tdhead_center" rowspan="2" width="63">����<br>�ٷνð�</td>

																	<td class="tdhead_center" rowspan="2" width="64">����</td>
																	<td class="tdhead_center" rowspan="2" width="64">����</td>
																	<td class="tdhead_center" rowspan="2" width="64">����</td>
																	<td class="tdhead_center" rowspan="2" width="64">���</td>

																	<td class="tdhead_center" rowspan="2" width="77">���ñ�</td>
																	<td class="tdhead_center" rowspan="2" width="78">�⺻�ñ�</td>
																	<td class="tdhead_center" rowspan="2" width="102"><input type="checkbox" name="money_month_fix" <?=$check_money_month_fix?> onclick="money_month_fix_ft(this);" value="Y" title="�����Է�"> �⺻��</td>
																	<td class="tdhead_center" colspan="4">��������(����)</td>
																	<td class="tdhead_center" colspan="5">����ӱݼ���</td>
																	<td class="tdhead_center" ></td>

																	<td class="tdhead_center" rowspan="2" width="71"><input type="checkbox" name="manual_etc2" <?=$check_manual_etc2?> onclick="check_manual(this);" value="1" title="�����Է�" style="vertical-align:middle;" /><br />���°���</td>
																	<td class="tdhead_center" colspan="3">�����</td>
																	<td class="tdhead_center" colspan="6">����</td>

																	<td class="tdhead_center" rowspan="2" width="57">���ο���</td>
																	<td class="tdhead_center" rowspan="2" width="57">�ǰ�����</td>
																	<td class="tdhead_center" rowspan="2" width="57">�����</td>
																	<td class="tdhead_center" rowspan="2" width="57">��뺸��</td>
																	<td class="tdhead_center" rowspan="2" width="57">�ҵ漼</td>
																	<td class="tdhead_center" rowspan="2" width="57">�ֹμ�</td>
																	<td class="tdhead_center" rowspan="2" width="60">
<?
//����ȸ�� ���ؿ���, �ֽ�ȸ�� �����ֽ�
if($member['mb_id'] == "410-86-38857" || $member['mb_id'] == "321-87-00290") echo "����ȸ��";
else {
	//����� 3�� �������� 160321
	if($com_code == 20623) {
		if($search_month == 3) echo "��������";
		else echo "��Ÿ����";
	} else {
		//�ų� 2�� �������� ȯ�޺����� ��ü 160218
		if($search_month == 2) echo "��������";
		else echo "��Ÿ����";
	}
}
?>
																	</td>
																</tr>
																<tr>
																	<td class="tdhead_center" width="110"><input type="checkbox" name="manual_ext" <?=$check_manual_ext?> onclick="check_manual(this);" value="1" title="�����Է�" style="vertical-align:middle;"> �������</td>
																	<td class="tdhead_center" width="110"><input type="checkbox" name="manual_night" <?=$check_manual_night?> onclick="check_manual(this);" value="1" title="�����Է�" style="vertical-align:middle;"> �߰��ٷ�</td>
																	<td class="tdhead_center" width="110"><input type="checkbox" name="manual_hday" <?=$check_manual_hday?> onclick="check_manual(this);" value="1" title="�����Է�" style="vertical-align:middle;"> ���ϱٷ�</td>
																	<td class="tdhead_center" width="101">��������</td>



																	<td class="tdhead_center" width="109"><input type="text" name="g1" class="textfm" style="width:100%;" value="<?=$money_g_txt['g1']?>"></td>
																	<td class="tdhead_center" width="109"><input type="text" name="g2" class="textfm" style="width:100%;" value="<?=$money_g_txt['g2']?>"></td>
																	<td class="tdhead_center" width="109"><input type="text" name="g3" class="textfm" style="width:100%;" value="<?=$money_g_txt['g3']?>"></td>
																	<td class="tdhead_center" width="109"><input type="text" name="g4" class="textfm" style="width:100%;" value="<?=$money_g_txt['g4']?>"></td>
																	<td class="tdhead_center" width="109"><input type="text" name="g5" class="textfm" style="width:100%;" value="<?=$money_g_txt['g5']?>"></td>

																	<td class="tdhead_center" width="71"><input type="text" name="etc_txt" class="textfm" style="width:100%;" value="<?=$etc_txt?>" /></td>

																	<td class="tdhead_center" width="76"><input type="text" name="b1" class="textfm" style="width:100%;" value="<?=$money_e_txt['e1']?>"></td>
																	<td class="tdhead_center" width="76"><input type="text" name="b2" class="textfm" style="width:100%;" value="<?=$money_e_txt['e2']?>"></td>
																	<td class="tdhead_center" width="76"><input type="text" name="b3" class="textfm" style="width:100%;" value="<?=$money_e_txt['e3']?>"></td>
																	<td class="tdhead_center" width="76"><input type="text" name="b4" class="textfm" style="width:100%;" value="<?=$money_e_txt['e4']?>"></td>
																	<td class="tdhead_center" width="76"><input type="text" name="b5" class="textfm" style="width:100%;" value="<?=$money_e_txt['e5']?>"></td>
																	<td class="tdhead_center" width="76"><input type="text" name="b6" class="textfm" style="width:100%;" value="<?=$money_e_txt['e6']?>"></td>
																	<td class="tdhead_center" width="76"><input type="text" name="b7" class="textfm" style="width:100%;" value="<?=$money_e_txt['e7']?>"></td>
																	<td class="tdhead_center" width="76"><input type="text" name="b8" class="textfm" style="width:100%;" value="<?=$money_e_txt['e8']?>"></td>
																	<td class="tdhead_center" width="76"><input type="text" name="b9" class="textfm" style="width:100%;" value="<?=$money_e_txt['e9']?>"></td>
																</tr>
															</table>
															<input type="text" name="b3" value="<?=$money_e_txt['e3']?>" style="display:none;" />
														</td>
														<td nowrap bgcolor=white>&nbsp; &nbsp;&nbsp; &nbsp;</td>
													</tr>
												</table>
											</div>
										</td>
									</tr>
									<tr>
										<td width="200" bgcolor="#ffffff" valign="top">
<?
//$spanMain_height = $total_count * 23 + 23;
$spanMain_height = 252;
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
													<input type="hidden" name="money_e9">
													<!--�հ����� ����-->
													<input type="hidden" name="money_e1_gy" value="<?=$money_e_gy['e1']?>">
													<input type="hidden" name="money_e2_gy" value="<?=$money_e_gy['e2']?>">
													<input type="hidden" name="money_e3_gy" value="<?=$money_e_gy['e3']?>">
													<input type="hidden" name="money_e4_gy" value="<?=$money_e_gy['e4']?>">
													<input type="hidden" name="money_e5_gy" value="<?=$money_e_gy['e5']?>">
													<input type="hidden" name="money_e6_gy" value="<?=$money_e_gy['e6']?>">
													<input type="hidden" name="money_e7_gy" value="<?=$money_e_gy['e7']?>">
													<input type="hidden" name="money_e8_gy" value="<?=$money_e_gy['e8']?>">
													<input type="hidden" name="money_e9_gy" value="<?=$money_e_gy['e9']?>">
													<!--�������� ����-->
													<input type="hidden" name="money_e1_income" value="<?=$money_e_income['e1']?>">
													<input type="hidden" name="money_e2_income" value="<?=$money_e_income['e2']?>">
													<input type="hidden" name="money_e3_income" value="<?=$money_e_income['e3']?>">
													<input type="hidden" name="money_e4_income" value="<?=$money_e_income['e4']?>">
													<input type="hidden" name="money_e5_income" value="<?=$money_e_income['e5']?>">
													<input type="hidden" name="money_e6_income" value="<?=$money_e_income['e6']?>">
													<input type="hidden" name="money_e7_income" value="<?=$money_e_income['e7']?>">
													<input type="hidden" name="money_e8_income" value="<?=$money_e_income['e8']?>">
													<input type="hidden" name="money_e9_income" value="<?=$money_e_income['e9']?>">
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
for ($i=0; $i<$total_count; $i++) {
	$k = $i + 1;
	if($k < $total_count) {
		$k_next = $k+1;
	}
?>
													<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
														<td nowrap class="ltrow1_center_h24">
															<input type="checkbox" name="idx" value="<?=$row[sabun]?>" onclick="focusClickClass('<?=$k?>')">
														</td>
														<td nowrap class="ltrow1_center_h24"><input type="text" name="emp_name" value="" style="width:100%;ime-mode:active;" class="textfm" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" maxlength="10" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" id="id_emp_name_<?=$k?>" onkeydown="if(event.keyCode == 13){ getId('id_emp_name_<?=$k_next?>').select(); }" /></td>
														<td nowrap class="ltrow1_center_h24"><input type="text" name="emp_sdate" value="" style="width:100%;ime-mode:disabled;" class="textfm" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')" id="id_emp_sdate_<?=$k?>" onkeydown="if(event.keyCode == 13){ getId('id_emp_sdate_<?=$k_next?>').select(); }" /></td>
														<td nowrap class="ltrow1_center_h24"><input type="text" name="emp_pname" value="<?=$row_position[name]?>" style="width:100%;ime-mode:active;" class="textfm" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" maxlength="10" id="id_emp_pname_<?=$k?>" onkeydown="if(event.keyCode == 13){ getId('id_emp_pname_<?=$k_next?>').select(); }" /></td>
													</tr>
<?
}
if ($i == 0)
		echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='4' nowrap class=\"ltrow1_center_h22\">�ڷᰡ �����ϴ�.</td></tr>";
?>

												</table>
												<br>
											</div>
										</td>
										<td bgcolor="#ffffff" valign="top">
											<div id="spanMain" style="width:100%;height:<?=$spanMain_height?>px;overflow-x:hidden;overflow-y:auto;" onScroll="spanLeft.scrollTop = this.scrollTop; spanTop.scrollLeft = this.scrollLeft;">
												<table width="<?=$pay_list_width?>" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
<?
// ����Ʈ ���
for ($i=0; $i<$total_count; $i++) {
	$k = $i + 1;
	$isgy_chk = "checked";
	$issj_chk = "checked";
	$iskm_chk = "checked";
	$isgg_chk = "checked";
	$isjy_chk = "checked";
	$check_money_so_yn = 0;
	//$check_business_yn = 0;
	$family_cnt = 1;
?>
													<tr class="list_row_now_gr" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_gr';">
														<input type="hidden" name="pay_no" value="<?=$row['sabun']?>" />
														<input type="hidden" name="cust_numb" value="98" />
														<input type="hidden" name="work_numb" value="64" />
														<input type="hidden" name="pay_gbn" value="<?=$pay_gbn_no?>" />
														<input type="hidden" name="yyyymm" value="201311" />
														<input type="hidden" name="emp_name" value="<?=$name?>" />
														<input type="hidden" name="emp_sdate" value="<?=$row['in_day']?>" />
														<input type="hidden" name="money_hour" value="0" />
														<input type="hidden" name="week_hday" value="0" />
														<input type="hidden" name="year_hday" value="0" />
														<input type="hidden" name="money_week" value="" />
														<input type="hidden" name="sabun[]" value="<?=$row['sabun']?>" />
														<input type="hidden" name="staff_name[]" value="<?=$name?>" />
														<input type="hidden" name="in_day[]" value="<?=$row['in_day']?>" />
														<input type="hidden" name="out_day[]" value="<?=$row['out_day']?>" />
														<input type="hidden" name="position[]" value="<?=$row2['position']?>" />
														<input type="hidden" name="position_txt[]" value="<?=$row_position['name']?>" />
														<input type="hidden" name="step[]" value="<?=$row2['step']?>" />
														<input type="hidden" name="step_txt[]" value="<?=$row_step['name']?>" />
														<input type="hidden" name="work_form[]" value="<?=$work_form?>" />
														<input type="hidden" name="dept_code[]" value="<?=$row2['dept_1']?>" />
														<input type="hidden" name="dept[]" value="<?=$dept?>" />
														<input type="hidden" name="pay_gbn_txt[]" value="<?=$pay_gbn_txt?>" />
														<input type="hidden" name="pay_gbn_<?=$i?>" />

														<!--<input type="hidden" name="family_cnt" value="<?=$family_cnt?>" />-->
														<input type="hidden" name="child_cnt" value="<?=$row['child_cnt']?>" />

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
														<input type="hidden" name="e9_<?=$i?>">

														<!--��������-->
														<input type="hidden" name="tax_so_var_<?=$i?>">
														<input type="hidden" name="tax_jumin_var_<?=$i?>">
														<input type="hidden" name="advance_pay_<?=$i?>">
														<input type="hidden" name="health_<?=$i?>">
														<input type="hidden" name="yoyang_<?=$i?>">
														<input type="hidden" name="yun_<?=$i?>">
														<input type="hidden" name="goyong_<?=$i?>">
														<input type="hidden" name="end_pay_<?=$i?>">
														<input type="hidden" name="minus_<?=$i?>">
														<input type="hidden" name="minus2_<?=$i?>">
														<input type="hidden" name="etc_<?=$i?>">
														<input type="hidden" name="etc2_<?=$i?>">

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
														<input type="hidden" name="check_money_so_yn" value="<?=$check_money_so_yn?>">
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
														<!--��������-->
														<!--<input type="hidden" name="money_year" value="<?=number_format($annual_paid_holiday)?>">-->
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
<?
	$pay_gbn = $k;
	if($k < $total_count) {
		$k_next = $k+1;
	}
	//�����ٷνð� �⺻ 209 �ð�
	$workhour_day = 209;
?>
														<td nowrap class="ltrow1_center_h24" style="background-color:#ffffff" width="45"><input type="text" style="width:100%;ime-mode:disabled;text-align:center;" class="textfm" name="family_cnt" value="<?=$family_cnt?>" maxlength="1" id="id_family_cnt_<?=$k?>" onkeydown="if(event.keyCode == 13){ getId('id_family_cnt_<?=$k_next?>').select(); }" /></td><!-- �ξ簡�� -->
														<td nowrap class="ltrow1_center_h24" width="65"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_month" id="id_money_month_<?=$k?>" value="<?=number_format($money_total)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_month_<?=$k_next?>').select(); }" /></td><!-- �����ӱ� -->

														<td nowrap class="ltrow1_center_h24" width="63"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_day" id="id_workhour_day_<?=$k?>" value="<?=$workhour_day?>" onKeyUp="cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_workhour_day_<?=$k_next?>').select(); }" /></td><!-- �����ٷνð� -->
														<td nowrap class="ltrow1_center_h24" width="63"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_ext" id="id_workhour_ext_<?=$k?>" value="<?=$workhour_ext?>" onKeyUp="cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_workhour_ext_<?=$k_next?>').select(); }" /></td><!-- ����ٷνð� -->
														<td nowrap class="ltrow1_center_h24" width="62"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_night" id="id_workhour_night_<?=$k?>" value="<?=$workhour_night?>" onKeyUp="cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_workhour_night_<?=$k_next?>').select(); }" /></td><!-- �߰��ٷνð� -->
														<td nowrap class="ltrow1_center_h24" width="63"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_hday" id="id_workhour_hday_<?=$k?>" value="<?=$workhour_hday?>" onKeyUp="cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_workhour_hday_<?=$k_next?>').select(); }" /></td><!-- ���ϱٷνð� -->

														<td nowrap class="ltrow1_center_h24" width="64"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_late" id="id_workhour_late_<?=$k?>"value="<?=$w_late?>" onKeyUp="cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_workhour_late_<?=$k_next?>').select(); }" /></td><!-- ���� -->
														<td nowrap class="ltrow1_center_h24" width="63"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_leave" id="id_workhour_leave_<?=$k?>" value="<?=$w_leave?>" onKeyUp="cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_workhour_leave_<?=$k_next?>').select(); }" /></td><!-- ���� -->
														<td nowrap class="ltrow1_center_h24" width="64"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_out" id="id_workhour_out_<?=$k?>" value="<?=$w_out?>" onKeyUp="cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_workhour_out_<?=$k_next?>').select(); }" /></td><!-- ���� -->
														<td nowrap class="ltrow1_center_h24" width="64"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_absence" id="id_workhour_absence_<?=$k?>" value="<?=$w_absence?>" onKeyUp="cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_workhour_absence_<?=$k_next?>').select(); }" /></td><!-- ��� -->


														<!--<td nowrap class="ltrow1_center_h24"><input type="text" style="width:100%;ime-mode:disabled;display:none" onKeyPress="onlyNumber2();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="workhour_year" value="<?=$workhour_year?>" onKeyUp="cal_pay('<?=$k?>');"></td>--><!-- �����ް��ð� -->
														<td nowrap class="ltrow1_center_h24" width="62"><input type="text" style="width:100%;ime-mode:disabled;" onKeyPress="" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="workhour_total" value="<?=$workhour_total?>"></td><!-- �ӱݻ��� �ѽð� -->
														<td nowrap class="ltrow1_center_h24" width="18"></td>

														<td nowrap class="ltrow1_center_h24" width="77"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_hour_ts" id="id_money_hour_ts_<?=$k?>" value="<?=number_format($money_hour_ts)?>" onkeydown="if(event.keyCode == 13){ getId('id_money_hour_ts_<?=$k_next?>').select(); }" /></td><!-- ����ӱ�(�ð���) -->
														<td nowrap class="ltrow1_center_h24" width="77"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_time" id="id_money_time_<?=$k?>" value="<?=number_format($money_time)?>" onkeydown="if(event.keyCode == 13){ getId('id_money_time_<?=$k_next?>').select(); }" /></td><!-- �⺻�ñ� -->
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
														<td nowrap class="ltrow1_center_h24" width="100"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="<?=$class_money_base?>" <?=$readonly_money_base?> name="money_base" id="id_money_base_<?=$k?>" value="<?=number_format($money_base)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_base_<?=$k_next?>').select(); }" /></td><!-- �⺻�� -->
														<td nowrap class="ltrow1_center_h24" width="110"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="<? if($check_manual_ext != "checked") echo "textfm5"; else echo "textfm"; ?>" name="money_ext" id="id_money_ext_<?=$k?>" value="<?=number_format($money_ext)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_ext_<?=$k_next?>').select(); }" /></td><!-- ����ٷμ��� -->
														<td nowrap class="ltrow1_center_h24" width="110"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="<? if($check_manual_night != "checked") echo "textfm5"; else echo "textfm"; ?>" name="money_night" id="id_money_night_<?=$k?>" value="<?=number_format($money_night)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_night_<?=$k_next?>').select(); }" /></td><!-- �߰��ٷμ��� -->
														<td nowrap class="ltrow1_center_h24" width="110"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="<? if($check_manual_hday != "checked") echo "textfm5"; else echo "textfm"; ?>" name="money_hday" id="id_money_hday_<?=$k?>" value="<?=number_format($money_hday)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_hday_<?=$k_next?>').select(); }" /></td><!-- ���ϱٷμ��� -->
														<td nowrap class="ltrow1_center_h24" width="101"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm"  name="money_year" id="id_money_year_<?=$k?>" value="<?=number_format($annual_paid_holiday)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_year_<?=$k_next?>').select(); }" /></td><!-- �������� -->




														<td nowrap class="ltrow1_center_h24" width="18"></td>

														<td nowrap class="ltrow1_center_h24" width="108"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_g1" id="id_money_g1_<?=$k?>" value="<?=number_format($money_g1)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_g1_<?=$k_next?>').select(); }" /></td><!-- ������1 -->
														<td nowrap class="ltrow1_center_h24" width="109"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_g2" id="id_money_g2_<?=$k?>" value="<?=number_format($money_g2)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_g2_<?=$k_next?>').select(); }" /></td><!-- ������2 -->
														<td nowrap class="ltrow1_center_h24" width="108"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_g3" id="id_money_g3_<?=$k?>" value="<?=number_format($money_g3)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_g3_<?=$k_next?>').select(); }" /></td><!-- ������3 -->
														<td nowrap class="ltrow1_center_h24" width="109"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_g4" id="id_money_g4_<?=$k?>" value="<?=number_format($money_g4)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_g4_<?=$k_next?>').select(); }" /></td><!-- ������4 -->
														<td nowrap class="ltrow1_center_h24" width="109"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_g5" id="id_money_g5_<?=$k?>" value="<?=number_format($money_g5)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_g5_<?=$k_next?>').select(); }" /></td><!-- ������5 -->

														<td nowrap class="ltrow1_center_h24" width="70"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="etc" id="id_etc_<?=$k?>" value="<?=number_format($etc)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_etc_<?=$k_next?>').select(); }" /></td><!-- ���� -->
														<td nowrap class="ltrow1_center_h24" width="70"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="<? if($check_manual_etc2 != "checked") echo "textfm5"; else echo "textfm"; ?>" name="etc2" id="id_etc2_<?=$k?>" value="<?=number_format($row4[etc2])?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_etc2_<?=$k_next?>').select(); }" /></td><!-- ���°��� -->

														<td nowrap class="ltrow1_center_h24" width="18"></td>

														<td nowrap class="ltrow1_center_h24" width="76"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e1" id="id_money_e1_<?=$k?>" value="<?=number_format($money_e1)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_e1_<?=$k_next?>').select(); }" /></td><!-- ��Ÿ����1 -->
														<td nowrap class="ltrow1_center_h24" width="76"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e2" id="id_money_e2_<?=$k?>" value="<?=number_format($money_e2)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_e2_<?=$k_next?>').select(); }" /></td><!-- ��Ÿ����2 -->
														<td nowrap class="ltrow1_center_h24" width="76"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e3" id="id_money_e3_<?=$k?>" value="<?=number_format($money_e3)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_e3_<?=$k_next?>').select(); }" /></td><!-- ��Ÿ����3 -->
														<td nowrap class="ltrow1_center_h24" width="76"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e4" id="id_money_e4_<?=$k?>" value="<?=number_format($money_e4)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_e4_<?=$k_next?>').select(); }" /></td><!-- ��Ÿ����4 -->
														<td nowrap class="ltrow1_center_h24" width="75"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e5" id="id_money_e5_<?=$k?>" value="<?=number_format($money_e5)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_e5_<?=$k_next?>').select(); }" /></td><!-- ��Ÿ����5 -->
														<td nowrap class="ltrow1_center_h24" width="75"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e6" id="id_money_e6_<?=$k?>" value="<?=number_format($money_e6)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_e6_<?=$k_next?>').select(); }" /></td><!-- ��Ÿ����6 -->
														<td nowrap class="ltrow1_center_h24" width="76"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e7" id="id_money_e7_<?=$k?>" value="<?=number_format($money_e7)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_e7_<?=$k_next?>').select(); }" /></td><!-- ��Ÿ����7 -->
														<td nowrap class="ltrow1_center_h24" width="75"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e8" id="id_money_e8_<?=$k?>" value="<?=number_format($money_e8)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_e8_<?=$k_next?>').select(); }" /></td><!-- ��Ÿ����8 -->
														<td nowrap class="ltrow1_center_h24" width="76"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_e9" id="id_money_e9_<?=$k?>" value="<?=number_format($money_e9)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_e9_<?=$k_next?>').select(); }" /></td><!-- ��Ÿ����9 -->

														<td nowrap class="ltrow1_center_h24" width="18"></td>

														<td nowrap class="ltrow1_center_h24" width="67"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_total" value="<?=number_format($row4[money_total])?>"></td><!-- �ӱݰ� -->
														<td nowrap class="ltrow1_center_h24" width="67"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_for_tax" value="<?=number_format($row4[money_for_tax])?>"></td><!-- �����ҵ� -->

														<td nowrap class="ltrow1_center_h24" width="56"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_yun" id="id_money_yun_<?=$k?>" value="<?=number_format($money_yun)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay2('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_yun_<?=$k_next?>').select(); }" /></td><!-- ���ο��� -->
														<td nowrap class="ltrow1_center_h24" width="57"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_health" id="id_money_health_<?=$k?>" value="<?=number_format($money_health)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay2('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_health_<?=$k_next?>').select(); }" /></td><!-- �ǰ����� -->
														<td nowrap class="ltrow1_center_h24" width="57"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_yoyang" id="id_money_yoyang_<?=$k?>" value="<?=number_format($money_yoyang)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay2('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_yoyang_<?=$k_next?>').select(); }" /></td><!-- ����纸�� -->
														<td nowrap class="ltrow1_center_h24" width="57"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="money_goyong" id="id_money_goyong_<?=$k?>" value="<?=number_format($money_goyong)?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay2('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_money_goyong_<?=$k_next?>').select(); }" /></td><!-- ��뺸�� -->
														<td nowrap class="ltrow1_center_h24" width="57"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="tax_so" id="id_tax_so_<?=$k?>" value="<?=number_format($row4[tax_so])?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay3('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_tax_so_<?=$k_next?>').select(); }" /></td><!-- �ҵ漼 -->
														<td nowrap class="ltrow1_center_h24" width="57"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="tax_jumin" id="id_tax_jumin_<?=$k?>" value="<?=number_format($row4[tax_jumin])?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay2('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_tax_jumin_<?=$k_next?>').select(); }" /></td><!-- �ֹμ� -->
														<td nowrap class="ltrow1_center_h24" width="60"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="onlyNumber();" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm" name="minus" id="id_minus_<?=$k?>" value="<?=number_format($row4[minus])?>" onKeyUp="checkThousand(this.value, this,'Y');cal_pay2('<?=$k?>');" onkeydown="if(event.keyCode == 13){ getId('id_minus_<?=$k_next?>').select(); }" /></td><!-- ��Ÿ���� -->

														<td nowrap class="ltrow1_center_h24" width="72"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_gongje" value="<?=number_format($row4[money_gongje])?>"></td><!-- ������ -->
														<td nowrap class="ltrow1_center_h24" width="73"><input type="text" style="width:100%;ime-mode:disabled;text-align:right" onKeyPress="" onfocusin="javascript:focusInClass('<?=$k?>');" onfocusout="javascript:focusOutClass('<?=$k?>');" class="textfm5" readonly name="money_result" value="<?=number_format($row4[money_result])?>"></td><!-- ���������޾� -->
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

							</form>


			<!--����Ʈ -->
			<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layput:fixed">
				<tr>
					<td align="center">
						<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="javascript:cal_pay_bt();" target="">�޿����</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<script language="javascript">
//�ڵ� ��� ��ư �Լ� / Confirm Ȯ��â �߰� 160121
function cal_pay_bt() {
	if(confirm("�Է��� �������� �޿���� �ϰڽ��ϱ�?")) {
<?
for($i=1;$i<=$k;$i++) {
?>
	cal_pay('<?=$i?>');
<?
}
?>
	} else {
		return;
	}
}
function money_month_fix_time() {
	var f = document.dataForm;
	//�޿����� �ٷ��� �� �ñ����� ���� ��� �⺻�� �����Է� üũ ���� / 395 ���� �⺻�� �����Է� 160603
	//f.money_month_fix.checked = false;
}
<?
//������ �����Է� ����
if($data == "load") {
	echo "addLoadEvent(cal_pay_bt);";
}
if($pay_gbn_no == 1 && !$w_date_ok) {
	echo "addLoadEvent(money_month_fix_time);";
}
?>

function cal_pay(idx) {
	var f = document.dataForm;
	var pay_gbn,money_day;
	var money_month,money_hour,money_hour_ds,money_hour_ts,workhour_day,workhour_ext,workhour_night,workhour_hday,workhour_ext_add,workhour_night_add,workhour_hday_add,workhour_total;
	var workhour_late,workhour_leave,workhour_out,workhour_absence,money_hour_ms;
	var week_hday,year_hday,money_base,money_time,money_ext,money_night,money_hday,money_ext_add,money_night_add,money_hday_add,money_week,money_year;
	var money_g1,money_g2,money_g3,money_g4,money_g5,money_e1,money_e2,money_e3,money_e4,money_e5,money_e6,money_e7,money_e8,money_e9;
	var money_g_sum, money_b_sum, money_e_sum;
	var money_total,money_for_tax,money_yun,money_health,money_yoyang,money_goyong,tax_so,tax_jumin,minus,minus2,etc,etc2,money_gongje,money_result,workhour_year;

	pay_gbn 		    = toInt(f.pay_gbn 		  [idx].value);
	money_month     = toInt(f.money_month   [idx].value); //�⺻���� mm--
	money_hour      = toInt(f.money_hour    [idx].value);	//���ؽñ� hh--
	money_hour_ds   = toInt(f.money_month 	[idx].value);	//���ؽñ�(�ñ���)
	money_hour_ts   = toInt(f.money_hour_ts [idx].value);	//����ӱ�(�ð���)


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


	week_hday       = toInt(f.week_hday     [idx].value);   // �������ϼ� hh--      
	year_hday       = toInt(f.year_hday     [idx].value);	// ���������ް��ϼ� hh--
	money_base      = toInt(f.money_base    [idx].value);	// �⺻��      
	money_time      = toInt(f.money_time    [idx].value);	// �⺻�ñ�
	money_ext       = toInt(f.money_ext     [idx].value);	// ����ٷμ���
	money_hday      = toInt(f.money_hday    [idx].value);	// ���ϱٷμ���
	money_night     = toInt(f.money_night   [idx].value);	// �߰��ٷμ���
	money_week      = toInt(f.money_week    [idx].value);	// ���޼��� hh--
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
	money_e9        = toInt(f.money_e9      [idx].value);

	money_total     = toInt(f.money_total   [idx].value); //�ӱݰ�       
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
	if(f.money_e9_gy.value != "Y") money_e9 = 0;
	//��Ÿ���� �հ�
	money_e_sum = money_e1+money_e2+money_e3+money_e4+money_e5+money_e6+money_e7+money_e8+money_e9;

	k = idx-1;
	money_month_old = f['money_month_'+k].value;
	//�ñ���
	//alert(pay_gbn);
	if(pay_gbn == 1) {
		money_hour = money_month;
		//�ӱݻ��� �ѽð�
		//workhour_total = parseInt( ( workhour_day + (workhour_ext*rate_ext) + (workhour_night*rate_night) + (workhour_hday*rate_hday)  -(workhour_late+workhour_leave+workhour_out+workhour_absence) ) * 1000 ) / 1000;
		workhour_total = parseInt( ( workhour_day + (workhour_ext*rate_ext) + (workhour_night*rate_night) + (workhour_hday*rate_hday) ) * 1000 ) / 1000;
		workhour_total = Math.round(workhour_total*100)/100;
		//money_base = Math.round( money_hour * workhour_day );
		//�⺻�� ���� : ������ �ƴ� ��� �⺻�� ���
		if(!f.money_month_fix.checked) money_base = Math.round( money_hour * workhour_day );
		//money_hour_ts = Math.round( money_hour + ( money_g_sum / workhour_day ) );
		//����ӱ� = �����ӱ� -> ����ӱ� (�⺻��+����ӱݼ���)/�ٷνð� 150624 (������ ���� �߰����� �ҽ� ����)
		//money_hour_ts = money_month;

		//money_hour_ts = Math.round( ( money_base + money_g_sum ) / workhour_day );

		//���ñ� <- �⺻�ñ� �����ϰ� ���� / ������ ���� ��û 160503
		money_hour_ts = money_time;

		//money_hour_ts = 5160;
		if( isNaN(money_hour_ts) ) money_hour_ts = 0;
		f.money_hour_ds[idx].value = money_hour_ds;
		//alert(money_hour_ds);
	//�ϱ���
	} else if(pay_gbn == 4) {
		money_hour = money_month;
		//�ӱݻ��� �ѽð�
		//workhour_total = parseInt( ( workhour_day + (workhour_ext*rate_ext) + (workhour_night*rate_night) + (workhour_hday*rate_hday)  -(workhour_late+workhour_leave+workhour_out+workhour_absence) ) * 1000 ) / 1000;
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

				//money_hour_ts = Math.round( ( money_base + money_g_sum ) / workhour_day);

				//���ñ� <- �⺻�ñ� �����ϰ� ���� / ������ ���� ��û 160503
				money_hour_ts = money_time;

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
	//�⺻�ñ� ���
	money_time = Math.round(money_hour_ts);
	//money_base = money_month - (money_ext + money_night + money_hday) - money_g_sum - money_year;
	//�⺻�� ����
	//alert(money_base+"="+money_month+"-("+money_ext+"+"+money_night+"+"+money_hday+")-("+money_g_sum+"+"+money_e_sum+")-"+money_year);
	//alert(money_base+"="+money_month+"-("+money_ext+"+"+money_night+"+"+money_hday+")-"+money_g_sum+"-"+money_year);

	//���°���
	if(!f.manual_etc2.checked) etc2 = money_time * (workhour_late+workhour_leave+workhour_out+workhour_absence);

	//money_total �ӱݰ� 
	//money_total = money_month+money_g_sum+money_e_sum;
	//money_total = money_base + (money_ext + money_hday + money_night + money_year) + (money_ext_add + money_hday_add + money_night_add) + (money_g_sum + money_e_sum) - (etc + etc2);
<?
//�ѱ�����濵��
if($com_code == 395) {
?>
	//etc(�����ü���) ����, etc2(���°���) ���� 160331
	money_total = money_base + (money_ext + money_hday + money_night + money_year) + (money_ext_add + money_hday_add + money_night_add) + (money_g_sum + money_e_sum) + etc;
<?
} else {
?>
	//���� �ӱݰ�(�Ա��Ѿ�)�� ����
	money_total = money_base + (money_ext + money_hday + money_night + money_year) + (money_ext_add + money_hday_add + money_night_add) + (money_g_sum + money_e_sum) + etc - etc2;
<?
}
?>
	//money_for_tax �����ҵ� 
	//money_for_tax = money_total - money_g1 - money_g2 - money_g3;

<?
//��������
$money_e1_tax_limit = 200000;
//�Ĵ�
$money_e2_tax_limit = 100000;
//�ڳຸ�� -> ���Ƽ���
$money_e3_tax_limit = 100000;
//����Ȱ����
$money_e4_tax_limit = 200000;
//��Ÿ����5
$sql_paycode = " select * from com_paycode_list where com_code = '$com_code' and code='e5' ";
$row_paycode = sql_fetch($sql_paycode);
if($row_paycode[tax_limit]) {
	$money_e5_tax_limit = preg_replace('@,@', '', $row_paycode['tax_limit']);
} else {
	$money_e5_tax_limit = 0;
}
//��Ÿ����6
$sql_paycode = " select * from com_paycode_list where com_code = '$com_code' and code='e6' ";
$row_paycode = sql_fetch($sql_paycode);
if($row_paycode[tax_limit]) {
	$money_e6_tax_limit = preg_replace('@,@', '', $row_paycode['tax_limit']);
} else {
	$money_e6_tax_limit = 0;
}
//��Ÿ����7
$sql_paycode = " select * from com_paycode_list where com_code = '$com_code' and code='e7' ";
$row_paycode = sql_fetch($sql_paycode);
if($row_paycode[tax_limit]) {
	$money_e7_tax_limit = preg_replace('@,@', '', $row_paycode['tax_limit']);
} else {
	$money_e7_tax_limit = 0;
}
//��Ÿ����8
$sql_paycode = " select * from com_paycode_list where com_code = '$com_code' and code='e8' ";
$row_paycode = sql_fetch($sql_paycode);
if($row_paycode[tax_limit]) {
	$money_e8_tax_limit = preg_replace('@,@', '', $row_paycode['tax_limit']);
} else {
	$money_e8_tax_limit = 0;
}
//��Ÿ����9
$sql_paycode = " select * from com_paycode_list where com_code = '$com_code' and code='e9' ";
$row_paycode = sql_fetch($sql_paycode);
if($row_paycode[tax_limit]) {
	$money_e9_tax_limit = preg_replace('@,@', '', $row_paycode['tax_limit']);
} else {
	$money_e9_tax_limit = 0;
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
	if(f.money_e9_income.value != "Y") {
		if(money_e9 > toInt(<?=$money_e9_tax_limit?>)) money_e9 = money_e9 - toInt(<?=$money_e9_tax_limit?>);
		else money_e9 = 0;
	}

	//f.error_code.value += money_e1;
	//��Ÿ���� �հ� (�����ҵ� ����)
	money_e_income_sum = money_e1+money_e2+money_e3+money_e4+money_e5+money_e6+money_e7+money_e8+money_e9;
	//alert(money_e_income_sum);
	//f.error_code.value += ", "+money_e_income_sum;

	money_for_tax = (money_total - money_e_sum) + money_e_income_sum;

	//�η紩�� ������ 50%
	//durunuri_50 = 1;
	//alert(durunuri);
	if(f.durunuri[idx].value == "1") durunuri_50 = 2;
	else durunuri_50 = 1;

	//4�뺸�� �����Է� ����
	if(!f.manual_4insure.checked) {
		//money_yun ���ο���  
		//money_yun = parseInt( ( parseInt(money_for_tax/1000)*1000 * 0.045 ) * 0.1 ) * 10
		money_yun = get_round( parseInt(money_for_tax) * 0.045 / durunuri_50 );
		//money_health �ǰ����� 
		//money_health = parseInt(money_for_tax* 0.02945 *0.1)*10
		//money_health = get_round( parseInt(money_for_tax) * 0.02945 );
		//money_health = get_round( parseInt(money_for_tax) * 0.02995 );
		money_health = get_round( parseInt(money_for_tax) * 0.03035 );
		//money_yoyang ����纸�� 
		//money_yoyang = parseInt(money_health* 0.0655 *0.1)*10
		money_yoyang = get_round( money_health* 0.0655  );
		//alert(money_yoyang);
		//money_goyong ��뺸��
		money_goyong = get_round( parseInt(money_for_tax) * 0.0065 / durunuri_50 );
		//4�뺸�� ���� ����
		if(f.iskm[idx].value != "checked") money_yun = 0;
		if(f.isgg[idx].value != "checked") money_health = 0;
		if(f.isjy[idx].value != "checked") money_yoyang = 0;
		if(f.isgy[idx].value != "checked") money_goyong = 0;
		//if(f.isgy.value == "checked") money_goyong = 0;
	}
	//���� �����Է� ����
	if(!f.manual_tax.checked) {
		//tax_so �ҵ漼
		//f.error_code.value = money_for_tax;
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

	//money_gongje ������ ���� 160331
<?
//�׿��� ������ ���� ����
if($com_code == 5930) {
	echo "	money_gongje = money_yun+money_health+money_yoyang+money_goyong+tax_so+tax_jumin+minus+minus2+etc;";
//�ѱ�����濵�� ������ ���°��� ���� 160331
} else if($com_code == 395) {
	echo "	money_gongje = money_yun+money_health+money_yoyang+money_goyong+tax_so+tax_jumin+minus+minus2+etc2;";
} else {
	echo "	money_gongje = money_yun+money_health+money_yoyang+money_goyong+tax_so+tax_jumin+minus+minus2;";
}
?>
	//������ �ݿø�
	money_gongje = money_gongje.toFixed(0);
	//money_result ������ ���޾� 
<?
//�����Ǿ���, ���ؿ��� ���� ó��
if($com_code == "20232" || $com_code == "20149") {
?>
	money_result = money_total - (money_gongje + etc);
<?
} else {
?>
	//if(idx == 10) alert(money_total+" - "+money_gongje)
	money_result = money_total - money_gongje;
<?
}
?>
	//�Ҽ��� 2�ڸ� �ݿø�
	workhour_total = workhour_total.toFixed(2);
	money_hour_ts = money_hour_ts.toFixed(2);
	money_time = money_time.toFixed(2);
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
	money_time = number_format(money_time);

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
	minus2 = number_format(minus2);
	etc2 = number_format(etc2);

	money_gongje = number_format(money_gongje);
	money_result = number_format(money_result);

	//���� input �Է�
	//f.error_code.value = money_base;
	f.money_hour_ts[idx].value = money_hour_ts //money_hour_ts ����ӱ�(�ð���) 
	//if(idx == 1) f.error_code.value = money_time;
	f.money_time[idx].value = money_time //money_hour_ts ����ӱ�(�ð���) 
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

	f.tax_so[idx].value = tax_so //tax_so �ҵ漼 
	f.tax_jumin[idx].value = tax_jumin //tax_jumin �ֹμ� 

	f.minus2[idx].value = minus2 //���°���

	//���°��� �����Է� �� üũ�� ���� �ð� ��� 160331
	if(!f.manual_etc2.checked) f.etc2[idx].value = etc2 //���°���

	f.money_gongje[idx].value = money_gongje //money_gongje ������ 
	f.money_result[idx].value = money_result //money_result ������ ���޾� 
}
</script>

</body>
</html>
