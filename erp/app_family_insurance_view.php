<?
$sub_menu = "200500";
include_once("./_common.php");

$now_time = date("Y-m-d H:i:s");
$sql_common = " from com_list_gy a, com_list_gy_opt b ";

//echo $member[mb_profile];
if($is_admin != "super") {
	$stx_man_cust_name = $member['mb_profile'];
}
$is_admin = "super";
//echo $is_admin;
$sql_search = " where a.com_code=b.com_code and a.com_code='$id' ";
$sql_order = "";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";

$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = 20;
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���

if (!$page) $page = 1; // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����

$sub_title = "���������";
$g4['title'] = $sub_title." : ������ : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order ";
//echo $sql;
$result = sql_query($sql);
//echo $row[com_code];

$colspan = 11;

if($w == "u") {
	$row=mysql_fetch_array($result);
	if(!$row['com_code']) alert("�ش� �ŷ�ó�� ���� �Ǿ��ų� �������� �ʽ��ϴ�.","main.php");
	//master �α��ν� com_code ����
	if(!$com_code) $com_code = $id;
	//�����DB �ɼ�2
	//������DB ��ü 141112
/*
	$sql2 = " select * from com_list_gy_opt2 where com_code='$com_code' ";
	$result2 = sql_query($sql2);
	$row2=mysql_fetch_array($result2);
*/
	//����Ȯ���� �α� ���� (������ ����)
	if($member['mb_level'] != 10) {
		$mb_profile_code = $member['mb_profile'];
		$mb_id = $member['mb_id'];
		$sql_erp_view_log = " insert erp_view_log set branch='$mb_profile_code', user_id='$mb_id', com_code='$com_code', wr_datetime='$now_time' ";
		sql_query($sql_erp_view_log);
	}
}
//echo $row[com_code];
//�޸�
$memo = $row['memo'];
$memo1 = $row['memo1'];
$memo2 = $row['memo2'];
$memo3 = $row['memo3'];
$memo4 = $row['memo4'];
$memo5 = $row['memo5'];
//�˻� �Ķ���� ����
$qstr = "stx_comp_name=".$stx_comp_name."&stx_t_no=".$stx_t_no."&stx_comp_tel=".$stx_comp_tel."&stx_proxy=".$stx_proxy;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4['title']?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css" />
<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript" src="./js/jquery-1.8.0.min.js" charset="euc-kr"></script>
</head>
<body style="margin:0px;background-color:#f7fafd">
<script type="text/javascript">
function checkData(action_file) {
	var frm = document.dataForm;
	frm.action = action_file;
	frm.submit();
	return;
}
function radio_chk(x,t){
	var count=0;
	for(i=0;i<x.length;i++){
		if(x[i].checked){
			count += 1;
			radio_name_val = x[i].value; 
		}
	}
	if(count == 0){
		alert(t+" ������ �ּ���.");
		return rv = 0;
	}else{
		//alert(radio_name_val);
		return rv = 1;
	}
}
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
function only_number() {
	//alert(event.keyCode);
	//Ű���� ��� ����Ű
	if (event.keyCode < 48 || event.keyCode > 57) {
		//Ű���� ���� ����Ű
		if (event.keyCode < 95 || event.keyCode > 105) {
			//del 46 , backsp 8 , left 37 , right 39 , tab 9 , shift 16
			if(event.keyCode != 46 && event.keyCode != 8 && event.keyCode != 37 && event.keyCode != 39 && event.keyCode != 9 && event.keyCode != 16) {
				event.preventDefault ? event.preventDefault() : event.returnValue = false;
			}
		}
	}
}
function only_number_hyphen() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if (event.keyCode < 95 || event.keyCode > 105) {
			if(event.keyCode != 45) event.preventDefault ? event.preventDefault() : event.returnValue = false;
		}
	}
}
function only_number_comma() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if (event.keyCode < 95 || event.keyCode > 105) {
			if(event.keyCode != 46) event.returnValue = false;
		}
	}
}
function only_number_isnan() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if (event.keyCode < 95 || event.keyCode > 105) {
			event.preventDefault ? event.preventDefault() : event.returnValue = false;
		}
	}
}
</script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/lang/calendar-ko.js"></script>
<script type="text/javascript">
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
function open_upjong(n) {
	window.open("popup/upjong_popup.php?n=_"+n, "upjong_popup", "width=540, height=706, toolbar=no, menubar=no, scrollbars=no, resizable=no" );
}
function findNomu() {
	var ret = window.open("pop_manage_cust.php", "pop_nomu_cust", "top=100, left=100, width=800,height=600, scrollbars");
	return;
}
//����ڹ�ȣ �Է� ������
function checkhyphen(inputVal, type, keydown) {		// inputVal�� õ������ , ǥ�ø� ���� �������� ��
	main = document.dataForm;			// ���⼭ type �� �ش��ϴ� ���� �ֱ� ���� ��ġ���� index
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
	input = delhyphen(inputVal, inputVal.length);
	//������ master �Է�
	//alert(input);
	if(1 == 1) { //��� ����
		//�� ����Ʈ+�� �� �� Home backsp
		if(event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=36 && event.keyCode!=8) {
			//alert(inputVal.length);
			//alert(input);
			if(inputVal.length == 3){
				//input = delhyphen(inputVal, inputVal.length);
				total += input.substring(0,3)+"-";
			} else if(inputVal.length == 6){
				total += inputVal.substring(0,8)+"-";
			} else if(inputVal.length == 12){
				total += inputVal.substring(0,14)+"";
			} else {
				total += inputVal;
			}
			if(keydown =='Y'){
				if ( type =='1' ) {
					main.comp_bznb.value=total;					// type �� ���� �������� �־� �ش�.
				}
				else if ( type =='2' ) {
					main.t_insureno.value=total;					// type �� ���� �������� �־� �ش�.
				}
			}else if(keydown =='N'){
				return total
			}
		}
		return total
	}
}
//����������ȣ �Է� ������
function checkhyphen_tno(inputVal, type, keydown) {
	main = document.dataForm;			// ���⼭ type �� �ش��ϴ� ���� �ֱ� ���� ��ġ���� index
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
	input = delhyphen(inputVal, inputVal.length);
	//������ master �Է�
	//alert(input);
	if(1 == 1) { //��� ����
		//�� ����Ʈ+�� �� �� Home backsp
		if(event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=36 && event.keyCode!=8) {
			//alert(inputVal.length);
			//alert(input);
			if(inputVal.length == 3){
				//input = delhyphen(inputVal, inputVal.length);
				total += input.substring(0,3)+"-";
			} else if(inputVal.length == 6){
				total += inputVal.substring(0,8)+"-";
			} else if(inputVal.length == 12){
				total += inputVal.substring(0,14)+"-";
			} else {
				total += inputVal;
			}
			if(keydown =='Y'){
				main.t_insureno.value=total;
			}else if(keydown =='N'){
				return total
			}
		}
		return total
	}
}
function delhyphen(inputVal, count){
	var tmp = "";
	for(i=0; i<count; i++){
		if(inputVal.substring(i,i+1)!='-'){		// ���� substring�� ����
			tmp += inputVal.substring(i,i+1);	// ���� ��� , �� ����
		}
	}
	return tmp;
}
//����/������
function only_number_english() {
	if (event.keyCode < 48 || (event.keyCode > 57 && event.keyCode < 97) || (event.keyCode > 122))  event.preventDefault ? event.preventDefault() : event.returnValue = false;
}
//����Խ��� �Է� �޸�
function checkcomma(inputVal, type, keydown) {		// inputVal�� õ������ , ǥ�ø� ���� �������� ��
	var main = document.dataForm;			// ���⼭ type �� �ش��ϴ� ���� �ֱ� ���� ��ġ���� index
	var chk		= 0;				// chk �� õ������ ���� ���̸� check
	var chk2	= 0;
	var chk3	= 0;
	var share	= 0;				// share 200,000 �� ���� 3�� ����� ���� �����ϱ� ���� ����
	var start	= 0;
	var triple	= 0;			// triple 3, 6, 9 �� 3�� ��� 
	var end		= 0;				// start, end substring ������ ���� ����  
	var total	= "";			
	var input	= "";				// total ���Ƿ� string ���� �����ϱ� ���� ����
	//���� �Է¸�
	//alert(event.keyCode);
	input = delcomma(inputVal, inputVal.length);
	//������ master �Է�
	//alert(input);
	if(1 == 1) { // ��� ����
		//�� ����Ʈ+�� �� �� Home backsp
		if(event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=36 && event.keyCode!=8) {
			//alert(inputVal.length);
			//alert(input);
			if(inputVal.length == 4){
				//input = delhyphen(inputVal, inputVal.length);
				total += input.substring(0,4)+".";
			} else if(inputVal.length == 7) {
				total += inputVal.substring(0,7)+".";
			} else if(inputVal.length == 12) {
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
function pay_day_last_chk(val) {
	var main = document.dataForm;
	if(val.checked == true) {
		if(main.pay_day.value != "") main.pay_day_old.value = main.pay_day.value;
		main.pay_day.value = "";
	} else {
		//alert(main.pay_day_old.value);
		main.pay_day.value = main.pay_day_old.value;
	}
}
//���ε�Ϲ�ȣ �Է� ������
function checkhyphen_bupin_no(inputVal, type, keydown) {		// inputVal�� õ������ , ǥ�ø� ���� �������� ��
	main = document.dataForm;			// ���⼭ type �� �ش��ϴ� ���� �ֱ� ���� ��ġ���� index
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
	input = delhyphen(inputVal, inputVal.length);
	//������ master �Է�
	//alert(input);
	if(1 == 1) { //��� ����
		//�� ����Ʈ+�� �� �� Home backsp
		if(event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=36 && event.keyCode!=8) {
			//alert(inputVal.length);
			//alert(input);
			if(inputVal.length == 6){
				//input = delhyphen(inputVal, inputVal.length);
				total += input.substring(0,6)+"-";
			} else {
				total += inputVal;
			}
			if(keydown =='Y'){
				if ( type =='1' ) {
					main.bupin_no.value=total;					// type �� ���� �������� �־� �ش�.
				}
				else if ( type =='2' ) {
					main.cust_ssnb.value=total;					// type �� ���� �������� �־� �ش�.
				}
			}else if(keydown =='N'){
				return total
			}
		}
		return total
	}
}
function tab_view(tab) {
	var obj = document.getElementById(tab);
	if(obj.style.display == "none") {
		obj.style.display = "";
	} else {
		obj.style.display = "none";
	}
}
//õ���� �޹�
function checkThousand(inputVal, type, keydown) {
	main = document.dataForm;
	var chk		= 0;
	var share	= 0;
	var start	= 0;
	var triple	= 0;
	var end		= 0;
	var total	= "";			
	var input	= "";
	//�� ����Ʈ+�� �� �� Home backsp
	if(event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=36 && event.keyCode!=8) {
		if (inputVal.length > 3) {
			input = delCom(inputVal, inputVal.length);
			chk = (input.length)/3;
			chk = Math.floor(chk);
			share = (input.length)%3;
			if (share == 0 ) {						
				chk = chk - 1;
			}
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
		if(keydown =='Y') {
			type.value=total;
		}else if(keydown =='N') {
			return total
		}
		return total
	}
}
function delCom(inputVal, count) {
	var tmp = "";
	for(i=0; i<count; i++) {
		if(inputVal.substring(i,i+1)!=',') {
			tmp += inputVal.substring(i,i+1);
		}
	}
	return tmp;
}
function tab_show(tab) {
	var frm = document.dataForm;
	frm.tab.value = tab;
	document.getElementById(tab).style.display="";
	if(tab == "tab1") {
		document.getElementById('tab2').style.display="none";
		document.getElementById('tab_img1').src="./images/tab01_on.gif";
		document.getElementById('tab_img2').src="./images/tab02_off.gif";
	} else {
		document.getElementById('tab1').style.display="none";
		document.getElementById('tab_img1').src="./images/tab01_off.gif";
		document.getElementById('tab_img2').src="./images/tab02_on.gif";
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
function application_fee_sum_func(obj_no) {
	var frm = document.dataForm;
	if(obj_no == 1) {
		application_fee_sum = toInt(frm.application_fee_1.value) + toInt(frm.application_fee_2.value) + toInt(frm.application_fee_3.value);
		frm.application_fee_sum.value = number_format(application_fee_sum);
		if(application_fee_sum == 0) frm.application_fee_sum.value = "";
	} else if(obj_no == 2) {
		application_fee_sum2 = toInt(frm.application_fee2_1.value) + toInt(frm.application_fee2_2.value) + toInt(frm.application_fee2_3.value);
		frm.application_fee_sum2.value = number_format(application_fee_sum2);
		if(application_fee_sum2 == 0) frm.application_fee_sum2.value = "";
	} else if(obj_no == 3) {
		application_fee_sum3 = toInt(frm.application_fee3_1.value) + toInt(frm.application_fee3_2.value) + toInt(frm.application_fee3_3.value);
		frm.application_fee_sum3.value = number_format(application_fee_sum3);
		if(application_fee_sum3 == 0) frm.application_fee_sum3.value = "";
	} else if(obj_no == 4) {
		application_fee_sum4 = toInt(frm.application_fee4_1.value) + toInt(frm.application_fee4_2.value) + toInt(frm.application_fee4_3.value);
		frm.application_fee_sum4.value = number_format(application_fee_sum4);
		if(application_fee_sum4 == 0) frm.application_fee_sum4.value = "";
	} else if(obj_no == 5) {
		application_fee_sum5 = toInt(frm.application_fee5_1.value) + toInt(frm.application_fee5_2.value) + toInt(frm.application_fee5_3.value);
		frm.application_fee_sum5.value = number_format(application_fee_sum5);
		if(application_fee_sum5 == 0) frm.application_fee_sum5.value = "";
	}
}
function persons_0(obj) {
	var frm = document.dataForm;
	if(obj.checked) {
		frm.persons_gy_old.value = frm.persons_gy.value;
		frm.persons_sj_old.value = frm.persons_sj.value;
		frm.persons_gy.value = "";
		frm.persons_sj.value = "";
	} else {
		frm.persons_gy.value = frm.persons_gy_old.value;
		frm.persons_sj.value = frm.persons_sj_old.value;
	}
}
function view_application_date_chk(obj, obj_no) {
	if(!obj.value) {
		obj2 = document.getElementById('application_date_a_'+obj_no);
		obj2.style.display = "";
		obj3 = document.getElementById('application_date_b_'+obj_no);
		obj3.style.display = "none";
	} else {
		obj2 = document.getElementById('application_date_a_'+obj_no);
		obj2.style.display = "none";
		obj3 = document.getElementById('application_date_b_'+obj_no);
		obj3.style.display = "";
	}
}
function view_close_kind(obj, obj_no) {
	if(!obj.value) {
		obj2 = document.getElementById('close_date_a_'+obj_no);
		obj2.style.display = "";
		obj3 = document.getElementById('close_date_b_'+obj_no);
		obj3.style.display = "none";
	} else {
		obj2 = document.getElementById('close_date_a_'+obj_no);
		obj2.style.display = "none";
		obj3 = document.getElementById('close_date_b_'+obj_no);
		obj3.style.display = "";
	}
}
//û���ݾ� * 1.1 = �����Աݱݾ�
function main_receipt_fee_cal(k) {
	var frm = document.dataForm;
	requested_amount = toInt(frm['requested_amount'+k].value);
	main_receipt_fee = requested_amount * 1.1;
	frm['main_receipt_fee'+k].value = number_format(main_receipt_fee);
}
//��û�ݾ� = �Աݱݾ� ����
function requested_amount_copy(k, fee_kind) {
	var frm = document.dataForm;
	application_fee_sum = toInt(frm['application_fee_sum'+k].value);
	if(fee_kind == "support") {
		p_support = frm['p_support'].value;
	} else {
		p_support = frm['p_contribution'].value;
	}
	if(p_support == "") {
		alert('������ ������ �Ǿ� ���� �ʽ��ϴ�.');
		return;
	}
	client_receipt_fee = toInt(frm['client_receipt_fee'+k].value);
	if(application_fee_sum == "") {
		alert("��û�ݾ��� �Է��ϼ���.");
		frm['application_fee_sum'+k].focus();
		return;
	}
	client_receipt_fee = application_fee_sum;
	requested_amount = client_receipt_fee * p_support / 100;
	frm['client_receipt_fee'+k].value = number_format(client_receipt_fee);
	frm['requested_amount'+k].value = number_format(requested_amount);
}
//�����Աݱݾ� ���
function main_receipt_fee_cal(k) {
	var frm = document.dataForm;
	requested_amount = toInt(frm['requested_amount'+k].value);
	if(requested_amount == "") {
		alert("û���ݾ�(�ŷ�)�� �Է��ϼ���.");
		frm['requested_amount'+k].focus();
		return;
	}
	main_receipt_fee = requested_amount * 1.1;
	frm['main_receipt_fee'+k].value = number_format(main_receipt_fee);
}
</script>
<?
include "inc/top.php";
?>
		<td onmouseover="showM('900')" style="vertical-align:top;">
			<div style="margin:10px 20px 20px 20px;min-height:480px;">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="100"><img src="images/top02.gif" border="0"></td>
						<td width=""><img src="images/top02_05.gif" border="0"></td>
						<td></td>
					</tr>
					<tr><td height="1" bgcolor="#cccccc" colspan="3"></td></tr>
				</table>
				<table width="1000" border="0" align="left" cellpadding="0" cellspacing="0" >
					<tr>
						<td valign="top" style="padding:10px 0 0 0">
							<!--Ÿ��Ʋ -->	
<?
$samu_list = "ok";
$report = "ok";
include "inc/client_basic_info.php";
?>
									<div style="height:10px;font-size:0px;line-height:0px;"></div>
								</div><!--����Ʈ ���� DIV ����-->
								<!--�Ǹ޴� -->
<?
//���� �� �޴� ��ȣ
$tab_onoff_this = 6;
//���α׷� ����
if($row['easynomu_yn'] == 1) {
	$tab_program_url = 1;
} else if($row['easynomu_yn'] == 2) {
	$tab_program_url = 2;
} else {
	$tab_program_url = 1;
	if($row['construction_yn'] == 1) $tab_program_url = 3;
}
include "inc/tab_menu.php";
?>
								<div id="tab2" >
<?
//������ ��ȣ
$app_no = 1;
//������ DB
$sql2 = " select * from erp_application where com_code='$com_code' and application_kind='18' order by idx asc ";
$result2 = sql_query($sql2);
?>
									<!--��޴� -->
									<a name="40001"><!--��û�� �ۼ�--></a>
<?
//������ for�� start
//for($app_no=1;$app_no<=$app_count;$app_no++) {
for ($app_no=1; $row2=sql_fetch_array($result2); $app_no++) {
	//IDX ����
	$idx = $row2['idx'];
	//������ ����
	$application_kind[$app_no] = $row2['application_kind'];
	//��û�Ⱓ/�б� ����
	$application_date_chk = $row2['application_date_chk'];
	//���û���� �Ϸ�
	$reapplication_done = $row2['reapplication_done'];

	$k = $app_no;
	if($k == 1) $k = "";
	$m = $app_no-1;
?>
									<table border="0" cellspacing="0" cellpadding="0" style=""> 
										<tr>
											<td id=""> 
												<table border="0" cellpadding="0" cellspacing="0"> 
													<tr> 
														<td><img src="images/g_tab_on_lt.gif"></td> 
														<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
															������<?=$app_no?>
														</td> 
														<td><img src="images/g_tab_on_rt.gif"></td> 
													</tr> 
												</table> 
											</td> 
											<td width=2></td> 
											<td valign="bottom">
											</td> 
										</tr> 
									</table>
									<div style="height:2px;font-size:0px" class="bgtr"></div>
									<div style="height:2px;font-size:0px;line-height:0px;"></div>
									<!-- �Է��� -->
									<input type="hidden" name="idx<?=$k?>" value="<?=$idx?>">
									<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
										<tr>
											<td nowrap rowspan="" class="tdrowk" width="110">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����
											</td>
											<td nowrap class="tdrow" width="136">
<?
$application_review = $row2['application_review'];
$application_recognize = $row2['application_recognize'];
//����,��, ����, ���ϼ�
if($application_kind[$app_no] >= 13 && $application_kind[$app_no] <= 16) $fee_kind = "contribution";
else $fee_kind = "support";
if($member['mb_level'] != 6) {
?>
												<select name="application_kind<?=$k?>" class="selectfm">
													<option value="0" >����</option>
<?
for($i=1;$i<count($support_kind_array);$i++) {
?>
													<option value="<?=$i?>" <? if($application_kind[$app_no] == $i) echo "selected"; ?>><?=$support_kind_array[$i]?></option>
<?
}
?>
												</select>
<?
} else {
	$application_kind_app_no = $application_kind[$app_no];
	echo $support_kind_array[$application_kind_app_no];
}
?>
											</td>
											<td nowrap class="tdrowk" width="80"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�����߼�</td>
											<td nowrap  class="tdrow" width="130">
<?
if($member['mb_level'] != 6) {
?>
												<input name="application_send<?=$k?>" type="text" class="textfm" style="width:70px;ime-mode:disabled;" value="<?=$row2['application_send']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
												<table border=0 cellpadding=0 cellspacing=0 style="display:inline;vertical-align:middle"><tr><td width=2></td><td><img src=./images/btn3_lt.gif></td><td background=./images/btn3_bg.gif class=ftbutton3_white nowrap><a href="javascript:chk_today('application_send<?=$k?>', '1');" target="">�Ϸ�</a></td><td><img src=./images/btn3_rt.gif></td> <td width=2></td></tr></table>
<?
} else {
	echo $row2['application_send'];
}
?>
											</td>
											<td nowrap class="tdrowk" width="80"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">������ȣ</td>
											<td nowrap  class="tdrow" width="160">
<?
if($member['mb_level'] != 6) {
?>
												<input name="application_send_no" type="text" class="textfm" style="width:150px;ime-mode:disabled;" value="<?=$row2['application_send_no']?>" maxlength="30" onKeyPress="only_number_comma();" onkeyup="">
<?
} else {
	echo $row2['application_send_no'];
}
?>
											</td>
											<td nowrap class="tdrowk" width="80"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��������</td>
											<td nowrap  class="tdrow">
												<input name="application_accept<?=$k?>" type="text" class="textfm" style="width:70px;ime-mode:disabled;" value="<?=$row2['application_accept']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
												<table border=0 cellpadding=0 cellspacing=0 style="display:inline;vertical-align:middle"><tr><td width=2></td><td><img src=./images/btn3_lt.gif></td><td background=./images/btn3_bg.gif class=ftbutton3_white nowrap><a href="javascript:chk_today('application_accept<?=$k?>', '1');" target="">�Ϸ�</a></td><td><img src=./images/btn3_rt.gif></td> <td width=2></td></tr></table>
											</td>
										</tr>
										<tr>
											<td nowrap rowspan="" class="tdrowk" width="">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" />��û�Ⱓ
<?
//echo $m;
if($application_date_chk == 1) $application_date_chk_selected = "selected";
else $application_date_chk_selected = "";
if($member['mb_level'] != 6) {
?>
												<select name="application_date_chk<?=$k?>" class="selectfm" onChange="view_application_date_chk(this,'<?=$app_no?>')">
													<option value="">�Ⱓ</option>
													<option value="1" <?=$application_date_chk_selected?>>�б�</option>
												</select>
<?
} else {
	if($application_date_chk == 1) echo ": �б�";
	else echo ": �Ⱓ";
}
?>
											</td>
											<td nowrap  class="tdrow" colspan="3">
<?
//��û�б�
$application_quarter_year = explode(',',$row2['application_quarter_year']);
$application_quarter = explode('_',$row2['application_quarter']);
$application_quarter_1 = explode(',',$application_quarter[0]);
$application_quarter_2 = explode(',',$application_quarter[1]);
$application_quarter_3 = explode(',',$application_quarter[2]);
if($member['mb_level'] != 6) {
?>
												<div id="application_date_a_<?=$app_no?>" style="<? if($application_date_chk == 1) echo "display:none"; ?>">
													<input name="application_date_start<?=$k?>" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row2['application_date_start']?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')">
													<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.dataForm.application_date_start<?=$app_no?>);" target="">�޷�</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
													~
													<input name="application_date_end<?=$k?>" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row2['application_date_end']?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')">
													<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.dataForm.application_date_end<?=$app_no?>);" target="">�޷�</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
												</div>
												<div id="application_date_b_<?=$app_no?>" style="<? if($application_date_chk != 1) echo "display:none"; ?>">
												<select name="application_quarter_year<?=$k?>_1" class="selectfm" onChange="">
													<option value="">����</option>
<?
for($i=2016;$i>2000;$i--) {
?>
													<option value="<?=$i?>" <? if($i == $application_quarter_year[0]) echo "selected"; ?> ><?=$i?></option>
<?
}
?>
												</select>��
												<input type="checkbox" name="application_quarter<?=$k?>_1_1" value="1" <? if($application_quarter_1[0] == 1) echo "checked"; ?> style="vertical-align:middle" onchange="">1�б�
												<input type="checkbox" name="application_quarter<?=$k?>_1_2" value="1" <? if($application_quarter_1[1] == 1) echo "checked"; ?> style="vertical-align:middle" onchange="">2�б�
												<input type="checkbox" name="application_quarter<?=$k?>_1_3" value="1" <? if($application_quarter_1[2] == 1) echo "checked"; ?> style="vertical-align:middle" onchange="">3�б�
												<input type="checkbox" name="application_quarter<?=$k?>_1_4" value="1" <? if($application_quarter_1[3] == 1) echo "checked"; ?> style="vertical-align:middle" onchange="">4�б�
												<br>
												<select name="application_quarter_year<?=$k?>_2" class="selectfm" onChange="">
													<option value="">����</option>
<?
for($i=2016;$i>2000;$i--) {
?>
													<option value="<?=$i?>" <? if($i == $application_quarter_year[1]) echo "selected"; ?> ><?=$i?></option>
<?
}
?>
												</select>��
												<input type="checkbox" name="application_quarter<?=$k?>_2_1" value="1" <? if($application_quarter_2[0] == 1) echo "checked"; ?> style="vertical-align:middle" onchange="">1�б�
												<input type="checkbox" name="application_quarter<?=$k?>_2_2" value="1" <? if($application_quarter_2[1] == 1) echo "checked"; ?> style="vertical-align:middle" onchange="">2�б�
												<input type="checkbox" name="application_quarter<?=$k?>_2_3" value="1" <? if($application_quarter_2[2] == 1) echo "checked"; ?> style="vertical-align:middle" onchange="">3�б�
												<input type="checkbox" name="application_quarter<?=$k?>_2_4" value="1" <? if($application_quarter_2[3] == 1) echo "checked"; ?> style="vertical-align:middle" onchange="">4�б�
												<br />
												<select name="application_quarter_year<?=$k?>_3" class="selectfm" onChange="">
													<option value="">����</option>
<?
for($i=2016;$i>2000;$i--) {
?>
													<option value="<?=$i?>" <? if($i == $application_quarter_year[2]) echo "selected"; ?> ><?=$i?></option>
<?
}
?>
												</select>��
												<input type="checkbox" name="application_quarter<?=$k?>_3_1" value="1" <? if($application_quarter_3[0] == 1) echo "checked"; ?> style="vertical-align:middle" onchange="">1�б�
												<input type="checkbox" name="application_quarter<?=$k?>_3_2" value="1" <? if($application_quarter_3[1] == 1) echo "checked"; ?> style="vertical-align:middle" onchange="">2�б�
												<input type="checkbox" name="application_quarter<?=$k?>_3_3" value="1" <? if($application_quarter_3[2] == 1) echo "checked"; ?> style="vertical-align:middle" onchange="">3�б�
												<input type="checkbox" name="application_quarter<?=$k?>_3_4" value="1" <? if($application_quarter_3[3] == 1) echo "checked"; ?> style="vertical-align:middle" onchange="">4�б�
<?
} else {
	if($application_quarter_year[0]) {
		echo $application_quarter_year[0]."�� ";
		if($application_quarter_1[0]) echo "1�б� ";
		if($application_quarter_1[1]) echo "2�б� ";
		if($application_quarter_1[2]) echo "3�б� ";
		if($application_quarter_1[3]) echo "4�б� ";
		echo "<br>";
	}
	if($application_quarter_year[1]) {
		echo $application_quarter_year[1]."�� ";
		if($application_quarter_2[0]) echo "1�б� ";
		if($application_quarter_2[1]) echo "2�б� ";
		if($application_quarter_2[2]) echo "3�б� ";
		if($application_quarter_2[3]) echo "4�б� ";
		echo "<br>";
	}
	if($application_quarter_year[2]) {
		echo $application_quarter_year[2]."�� ";
		if($application_quarter_3[0]) echo "1�б� ";
		if($application_quarter_3[1]) echo "2�б� ";
		if($application_quarter_3[2]) echo "3�б� ";
		if($application_quarter_3[3]) echo "4�б� ";
	}
}
?>
												</div>
											</td>
											<td nowrap rowspan="" class="tdrowk" width="">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��û�ݾ�
											</td>
											<td nowrap class="tdrow">
<?
//��û�ݾ�
if($row2['application_fee_sum']) $application_fee_sum = number_format($row2['application_fee_sum']);
else $application_fee_sum = "";
if($member['mb_level'] != 6) {
?>
												<input name="application_fee_sum<?=$k?>" type="text" class="textfm" style="width:100px;ime-mode:disabled;" value="<?=$application_fee_sum?>" onKeyPress="only_number()" onkeyup="checkThousand(this.value, this,'Y');">
												<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn4_lt.gif"></td><td background="./images/btn4_bg.gif" class="ftbutton3_white"_white nowrap><a href="javascript:requested_amount_copy('<?=$k?>', '<?=$fee_kind?>');" target=""><span style="font-size:11px">���</span></a></td><td><img src="./images/btn4_rt.gif"></td> <td width="2"></td></tr></table>
<?
} else {
	if($row2['application_fee_sum']) echo number_format($row2['application_fee_sum'])."";
}
?>
											</td>
											<td nowrap rowspan="" class="tdrowk" width="">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����������
											</td>
											<td nowrap class="tdrow">
<?
if($member['mb_level'] != 6) {
?>
												<input name="reapplication_date<?=$k?>" type="text" class="textfm" style="width:70px;ime-mode:disabled;" value="<?=$row2['reapplication_date']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
												<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white"_white nowrap><a href="javascript:loadCalendar(document.dataForm.reapplication_date<?=$k?>);" target="">�޷�</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
<?
} else {
	if($row2['reapplication_date']) echo $row2['reapplication_date'];
}
?>
											</td>
										</tr>
										<tr>
											<td nowrap rowspan="" class="tdrowk" width="">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���ᱸ��
											</td>
											<td nowrap class="tdrow">
<?
if($member['mb_level'] != 6) {
?>
												<select name="close_kind<?=$k?>" class="selectfm" onChange="view_close_kind(this,'<?=$app_no?>')">
													<option value="">�Ⱓ</option>
													<option value="1" <? if($row2['close_kind'] == 1) echo "selected"; ?>>�б�</option>
												</select>
<?
} else {
	if($row2['close_kind'] == 1) echo "�б�";
	else echo "�Ⱓ";
}
?>
											</td>
											<td nowrap rowspan="" class="tdrowk" width="">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��������
											</td>
											<td nowrap class="tdrow">
												<div id="close_date_a_<?=$app_no?>" style="<? if($row2['close_kind'] == 1) echo "display:none"; ?>">
<?
if($member['mb_level'] != 6) {
?>
													<input name="close_date<?=$k?>" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row2['close_date']?>" maxlength="10" onkeydown="only_number();" onkeyup="checkcomma(this.value, this,'Y')">
													<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.dataForm.close_date<?=$k?>);" target="">�޷�</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
<?
} else {
	echo $row2['close_date'];
}
?>
												</div>
												<div id="close_date_b_<?=$app_no?>" style="<? if($row2['close_kind'] != 1) echo "display:none"; ?>">
<?
if($member['mb_level'] != 6) {
?>
													<select name="close_year<?=$k?>" class="selectfm" onChange="">
														<option value="">����</option>
<?
for($i=2020;$i>=2014;$i--) {
?>
														<option value="<?=$i?>" <? if($i == $row2['close_year']) echo "selected"; ?> ><?=$i?></option>
<?
}
?>
													</select> ��
													<select name="close_quarter<?=$k?>" class="selectfm" onChange="">
														<option value="">����</option>
<?
for($i=1;$i<=4;$i++) {
?>
														<option value="<?=$i?>" <? if($i == $row2['close_quarter']) echo "selected"; ?> ><?=$i?>�б�</option>
<?
}
?>
													</select> 
<?
} else {
	echo $row2['close_year']."�� ";
	echo $row2['close_quarter']."�б� ";
}
?>
												</div>
											</td>
											<td nowrap rowspan="" class="tdrowk" width="">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��û�ֱ�
											</td>
											<td nowrap class="tdrow">
<?
if($member['mb_level'] != 6) {
?>
												<select name="application_cycle<?=$k?>" class="selectfm" onChange="view_close_kind(this)">
													<option value="">����</option>
													<option value="1" <? if($row2['application_cycle'] == 1) echo "selected"; ?>>�ſ�</option>
													<option value="2" <? if($row2['application_cycle'] == 2) echo "selected"; ?>>�б�</option>
												</select>
<?
} else {
	if($row2['application_cycle'] == 1) echo "�ſ�";
	else if($row2['application_cycle'] == 2) echo "�б�";
	else echo "";
}
?>
											</td>
											<td nowrap rowspan="" class="tdrowk" width="">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�����Ϸ�
											</td>
											<td nowrap class="tdrow">
<?
if($row2['reapplication_done'] == 1) $reapplication_done_text = "�Ϸ�";
else if($row2['reapplication_done'] == 2) $reapplication_done_text = "�ݷ�";
else if($row2['reapplication_done'] == 3) $reapplication_done_text = "���";
else if($row2['reapplication_done'] == 4) $reapplication_done_text = "�̰�";
else $reapplication_done_text = "";
if($member['mb_level'] != 6) {
?>
												<select name="reapplication_done<?=$k?>" class="selectfm" onChange="">
													<option value="">����</option>
													<option value="1" <? if($row2['reapplication_done'] == 1) echo "selected"; ?>>�Ϸ�</option>
													<option value="2" <? if($row2['reapplication_done'] == 2) echo "selected"; ?>>�ݷ�</option>
													<option value="3" <? if($row2['reapplication_done'] == 3) echo "selected"; ?>>���</option>
													<option value="4" <? if($row2['reapplication_done'] == 4) echo "selected"; ?>>�̰�</option>
												</select>
												<input type="checkbox" name="reapplication_del<?=$k?>" value="1" style="vertical-align:middle">����
<?
} else {
	echo $reapplication_done_text;
}
?>
											</td>
										</tr>
										<tr>
											<td nowrap rowspan="" class="tdrowk" width="">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��ü�Ա���
											</td>
											<td nowrap class="tdrow">
<?
if($member['mb_level'] != 6) {
?>
												<input name="client_receipt_date<?=$k?>" type="text" class="textfm" style="width:70px;ime-mode:disabled;" value="<?=$row2['client_receipt_date']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
												<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.dataForm.client_receipt_date<?=$k?>);" target="">�޷�</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
<?
} else {
	if($row2['client_receipt_date']) echo $row2['client_receipt_date'];
}
?>
											</td>
											<td nowrap rowspan="" class="tdrowk" width="">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�Աݱݾ�
											</td>
											<td nowrap class="tdrow">
<?
//��û�ݾ�
if($row2['client_receipt_fee']) $client_receipt_fee = number_format($row2['client_receipt_fee']);
else $client_receipt_fee = "";
if($member['mb_level'] != 6) {
?>
												<input name="client_receipt_fee<?=$k?>" type="text" class="textfm" style="width:120px;ime-mode:disabled;" value="<?=$client_receipt_fee?>" onKeyPress="only_number()" onkeyup="checkThousand(this.value, this,'Y');">
<?
} else {
	if($row2['client_receipt_fee']) echo number_format($row2['client_receipt_fee'])."";
}
?>
											</td>
											<td nowrap rowspan="" class="tdrowk" width="">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�ŷ�����
											</td>
											<td nowrap class="tdrow">
<?
if($member['mb_level'] != 6) {
?>
												<input name="statement_date<?=$k?>" type="text" class="textfm" style="width:70px;ime-mode:disabled;" value="<?=$row2['statement_date']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
												<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.dataForm.statement_date<?=$k?>);" target="">�޷�</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
<?
} else {
	if($row2['statement_date']) echo $row2['statement_date'];
}
?>
											</td>
											<td nowrap rowspan="" class="tdrowk" width="">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">û���ݾ�(�ŷ�)
											</td>
											<td nowrap class="tdrow">
<?
if($row2['requested_amount']) $requested_amount = number_format($row2['requested_amount']);
else $requested_amount = "";
if($member['mb_level'] != 6) {
?>
												<input name="requested_amount<?=$k?>" type="text" class="textfm" style="width:120px;ime-mode:disabled;" value="<?=$requested_amount?>" onKeyPress="only_number()" onkeyup="checkThousand(this.value, this,'Y');" onblur="main_receipt_fee_cal('<?=$k?>');">
<?
} else {
	if($row2['requested_amount']) echo number_format($row2['requested_amount'])."";
}
?>
											</td>
										</tr>
										<tr>
											<td nowrap rowspan="" class="tdrowk" width="">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���ݰ�꼭
											</td>
											<td nowrap class="tdrow">
<?
if($member['mb_level'] != 6) {
?>
												<input name="tax_invoice<?=$k?>" type="text" class="textfm" style="width:70px;ime-mode:disabled;" value="<?=$row2['tax_invoice']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
												<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.dataForm.tax_invoice<?=$k?>);" target="">�޷�</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
<?
} else {
	if($row2['tax_invoice']) echo $row2['tax_invoice'];
}
?>
											</td>
											<td nowrap rowspan="" class="tdrowk" width="">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�����Ա���
											</td>
											<td nowrap class="tdrow">
<?
if($member['mb_level'] != 6) {
?>
												<input name="main_receipt_date<?=$k?>" type="text" class="textfm" style="width:70px;ime-mode:disabled;" value="<?=$row2['main_receipt_date']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
												<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white" nowrap><a href="javascript:loadCalendar(document.dataForm.main_receipt_date<?=$k?>);" target="">�޷�</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
<?
} else {
	if($row2['main_receipt_date']) echo $row2['main_receipt_date']." ".$main_receipt_date;
}
?>
											</td>
											<td nowrap colspan="3" class="tdrowk" width="">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�����Աݱݾ�(�ΰ���<b>����</b>)
<?
if($member['mb_level'] != 6) {
?>
												<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn4_lt.gif"></td><td background="./images/btn4_bg.gif" class="ftbutton3_white"_white nowrap><a href="javascript:main_receipt_fee_cal('<?=$k?>');" target=""><span style="font-size:11px">���</span></a></td><td><img src="./images/btn4_rt.gif"></td> <td width="2"></td></tr></table>
<?
}
?>
											</td>
											<td nowrap class="tdrow" colspan="">
<?
if($row2['main_receipt_fee']) $main_receipt_fee = number_format($row2['main_receipt_fee']);
else $main_receipt_fee = "";
if($member['mb_level'] != 6) {
?>
												<input name="main_receipt_fee<?=$k?>" type="text" class="textfm" style="width:120px;ime-mode:disabled;" value="<?=$main_receipt_fee?>" onKeyPress="only_number()" onkeyup="checkThousand(this.value, this,'Y');">
<?
} else {
	if($row2['main_receipt_fee']) echo $main_receipt_fee;
}
?>
											</td>
										</tr>
										<tr>
											<td nowrap rowspan="" class="tdrowk" width="">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�Ա�ó
											</td>
											<td nowrap class="tdrow">
<?
$receipt_place = $row2['receipt_place'];
if($member['mb_level'] != 6) {
?>
												<select name="receipt_place<?=$k?>" class="selectfm" onChange="">
													<option value="1" <? if($receipt_place == "1") echo "selected"; ?>>�Ѱ�</option>
													<option value="2" <? if($receipt_place == "2") echo "selected"; ?>>��ȣ��</option>
												</select>
<?
} else {
	if($receipt_place == 1) echo "�Ѱ�";
	else if($receipt_place == 2) echo "��ȣ��";
	else echo "";
}
?>
											</td>
											<td nowrap rowspan="" class="tdrowk" width="">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�����
											</td>
											<td nowrap class="tdrow">
<?
if($row2['person_charge']) {
	$person_charge = $row2['person_charge'];
} else if($row['damdang_code'] == 1) {
	$person_charge = $row['manage_cust_name'];
} else {
	$man_cust_name_code = $row['damdang_code'];
	$person_charge = $man_cust_name_arry[$man_cust_name_code];
}
if($member['mb_level'] != 6) {
?>
												<input name="person_charge<?=$k?>" type="text" class="textfm" style="width:120px;ime-mode:active;" value="<?=$person_charge?>" onKeyPress="" onkeyup="">
<?
} else {
	if($row2['person_charge']) echo $person_charge;
}
?>
											</td>
											<td nowrap colspan="" class="tdrowk" width="">
											</td>
											<td nowrap class="tdrow" colspan="3">
											</td>
										</tr>
										<tr>
											<td nowrap colspan="" class="tdrowk" width="">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�޸�(����)
											</td>
											<td nowrap class="tdrow" colspan="7">
<?
$app_memo = $row2['app_memo'];
?>
												<textarea name="app_memo<?=$k?>" class="textfm" style='width:100%;height:48px;word-break:break-all;' itemname="����" required><?=$app_memo?></textarea>
											</td>
										</tr>
									</table>
									<div style="height:10px;font-size:0px"></div>
<?
}
//������ for�� end
?>
									<!--÷�μ���-->
									<table border=0 cellspacing=0 cellpadding=0> 
										<tr>
											<td id=""> 
												<table border=0 cellpadding=0 cellspacing=0> 
													<tr> 
														<td><img src="images/sb_tab_on_lt.gif"></td> 
														<td background="images/sb_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100px;text-align:center'> 
															÷�μ���
														</td> 
														<td><img src="images/sb_tab_on_rt.gif"></td> 
													</tr> 
												</table> 
											</td> 
											<td width=6></td> 
											<td valign="middle"></td> 
										</tr> 
									</table>
									<div style="height:2px;font-size:0px" class="bbtr"></div>
									<div style="height:2px;font-size:0px;line-height:0px;"></div>
									<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
										<tr>
											<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0"><b>�⺻����</b><font color="red"></font></td>
											<td nowrap  class="tdrow" colspan="3">
<?
$file_check = explode(',',$row['file_check']);
$file_easynomu = explode(',',$row['file_easynomu']);
if($file_check[0]) echo "�������Ƿڼ�. ";
if($file_check[1]) echo "��༭. ";
if($file_check[2]) echo "�繫��Ź��. ";
if($file_check[3]) echo "�븮�μ���(����). ";
if($file_check[4]) echo "���ڹο�(����). ";
if($file_check[5]) echo "����ڵ����. ";
if($file_check[6]) echo "����纻. ";
if($file_check[7]) echo "���/��Ǹ���Ʈ. ";
if($file_check[8]) echo "�ð�������. ";
if($file_check[9]) echo "��å�ڱ��Ƿڼ�. ";
?>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����1
											</td>
											<td   class="tdrow" width="373">
												<a href="files/contract/<?=$row['filename_1']?>" target="_blank"><?=$row['filename_1']?></a>
											</td>
											<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����2</td>
											<td   class="tdrow" >
												<a href="files/contract/<?=$row['filename_2']?>" target="_blank"><?=$row['filename_2']?></a>
											</td>
										</tr>
										<tr id="file_tr2" style="<? if(!$row['filename_3'] && !$row['filename_4']) echo "display:none"; ?>">
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����3</td>
											<td   class="tdrow" >
												<a href="files/contract/<?=$row['filename_3']?>" target="_blank"><?=$row['filename_3']?></a>
											</td>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����4</td>
											<td   class="tdrow" >
												<a href="files/contract/<?=$row['filename_4']?>" target="_blank"><?=$row['filename_4']?></a>
											</td>
										</tr>
										<tr id="file_tr3" style="<? if(!$row['filename_5'] && !$row['filename_6']) echo "display:none"; ?>">
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����5</td>
											<td   class="tdrow" >
												<a href="files/contract/<?=$row['filename_5']?>" target="_blank"><?=$row['filename_5']?></a>
											</td>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����6</td>
											<td   class="tdrow" >
												<a href="files/contract/<?=$row['filename_6']?>" target="_blank"><?=$row['filename_6']?></a>
											</td>
										</tr>
										<tr id="file_tr4" style="<? if(!$row['filename_7'] && !$row['filename_8']) echo "display:none"; ?>">
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����7</td>
											<td   class="tdrow" >
												<br><a href="files/contract/<?=$row['filename_7']?>" target="_blank"><?=$row['filename_7']?></a>
											</td>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����8</td>
											<td   class="tdrow" >
												<br><a href="files/contract/<?=$row['filename_8']?>" target="_blank"><?=$row['filename_8']?></a>
											</td>
										</tr>
									</table>
									<div style="height:10px;font-size:0px"></div>

									<input type="hidden" name="app_count" value="<?=$app_no-1?>">
									<div style="height:10px;font-size:0px"></div>
									<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layput:fixed">
										<tr>
											<td align="center">
<?
//���Ѻ� ��ũ��
//echo $member['mb_level'];
if($member['mb_level'] >= 8) {
	$url_save = "javascript:checkData('app_family_insurance_update.php');";
} else {
	$url_save = "javascript:alert_no_right();";
}
if($member['mb_level'] >= 6) {
?>
												<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="<?=$url_save?>" target="">�� ��</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
<? } ?>
												<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./app_family_insurance_list.php?page=<?=$page?>&stx_count=<?=$stx_count?>" target="">�� ��</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
<?
if($w == "u") {
?>
												<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./client_view.php?w=<?=$w?>&id=<?=$id?>" target="">�ŷ�ó����</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
												<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./client_process_view.php?w=<?=$w?>&id=<?=$id?>" target="">����ó����Ȳ</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
												<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./settlement_view.php?w=<?=$w?>&id=<?=$id?>" target="">�����Ȳ</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
<? } ?>
											</td>
										</tr>
									</table>
<?
include "inc/client_comment_only.php";
?>
									<div style="height:20px;font-size:0px"></div>
									<!--���� ����-->
									<input type="hidden" name="prv_cust_tell"  value="<?=$row['com_tel']?>" />
									<input type="hidden" name="prv_user_id" value="<?=$row['t_insureno']?>" />
									<input type="hidden" name="w" value="<?=$w?>" />
									<input type="hidden" name="id" value="<?=$id?>" />
									<input type="hidden" name="page" value="<?=$page?>" />
								</form>
							</div>
						</td>
					</tr>
				</table>
			</div>
		</td>
	</tr>
</table>
<? include "./inc/bottom.php";?>
</body>
</html>
