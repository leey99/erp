<?
$sub_menu = "400300";
include_once("./_common.php");

$now_time = date("Y-m-d H:i:s");
$total_year = 2015;
$total_insure_year = 2016;
$is_admin = "super";
//echo $is_admin;
$sql_common = " from com_list_gy a, com_list_gy_opt b ";
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

$sub_title = "�����Ѿ׽Ű�(��)";
$g4['title'] = $sub_title." : �繫��Ź : ".$easynomu_name;

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
	$sql2 = " select * from com_list_gy_opt2 where com_code='$com_code' ";
	$result2 = sql_query($sql2);
	$row2=mysql_fetch_array($result2);
	//����Ȯ���� �α� ���� (������ ����)
	if($member['mb_level'] != 10) {
		$mb_profile_code = $member['mb_profile'];
		$mb_id = $member['mb_id'];
		$sql_erp_view_log = " insert erp_view_log set branch='$mb_profile_code', user_id='$mb_id', com_code='$com_code', wr_datetime='$now_time' ";
		sql_query($sql_erp_view_log);
	}
}
//echo $row[com_code];
//�˻� �Ķ���� ����
$qstr = "stx_comp_name=".$stx_comp_name."&stx_t_no=".$stx_t_no."&stx_biz_no=".$stx_biz_no."&stx_boss_name=".$stx_boss_name."&stx_comp_tel=".$stx_comp_tel."&stx_comp_fax=".$stx_comp_fax."&stx_proxy=".$stx_proxy."&stx_comp_gubun2=".$stx_comp_gubun2."&stx_man_cust_name=".$stx_man_cust_name."&stx_uptae=".$stx_uptae."&stx_upjong=".$stx_upjong."&search_ok=".$search_ok;
$qstr .= "&samu_req_yn=".$samu_req_yn."&health_req_yn=".$health_req_yn."&stx_samu_receive_no=".$stx_samu_receive_no."&stx_samu_receive_no_search=".$stx_samu_receive_no_search."&stx_reg_day_chk=".$stx_reg_day_chk."&search_year=".$search_year."&search_month=".$search_month."&search_year_end=".$search_year_end."&search_month_end=".$search_month_end."&stx_search_day_chk=".$stx_search_day_chk."&search_sday=".$search_sday."&search_eday=".$search_eday;
$qstr .= "&search_day_all=".$search_day_all."&search_day1=".$search_day1."&search_day3=".$search_day3."&search_day4=".$search_day4."&search_day5=".$search_day5."&stx_biz_no_input_not=".$stx_biz_no_input_not."&stx_t_no_input_not=".$stx_t_no_input_not."&stx_uptae_non=".$stx_uptae_non."&stx_samu_keep=".$stx_samu_keep."&stx_samu_close_date=".$stx_samu_close_date."&stx_ok_date=".$stx_ok_date."&stx_input_date=".$stx_input_date;
$qstr .= "&stx_addr=".$stx_addr."&stx_addr_first=".$stx_addr_first."&stx_manage_name=".$stx_manage_name."&stx_samu_state=".$stx_samu_state."&stx_levy_kind=".$stx_levy_kind."&stx_samu_state_total=".$stx_samu_state_total."&stx_tm_name=".$stx_tm_name;
$qstr .= "&stx_total_year=".$stx_total_year."&stx_total_input_all=".$stx_total_input_all."&stx_total_input1=".$stx_total_input1."&stx_total_input2=".$stx_total_input2."&stx_total_input3=".$stx_total_input3."&stx_total_input4=".$stx_total_input4."&stx_total_input5=".$stx_total_input5."&stx_total_input6=".$stx_total_input6."&stx_total_process=".$stx_total_process;
//�޸�
$memo = $row['memo'];
$memo1 = $row['memo1'];
$memo2 = $row['memo2'];
$memo3 = $row['memo3'];
$memo4 = $row['memo4'];
$memo5 = $row['memo5'];
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px;background-color:#f7fafd">
<script src="./js/jquery-1.8.0.min.js" type="text/javascript" charset="euc-kr"></script>
<script language="javascript">
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
<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
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
function open_upjong(n) {
	window.open("popup/upjong_popup.php?n=_"+n, "upjong_popup", "width=540, height=706, toolbar=no, menubar=no, scrollbars=no, resizable=no" );
}
function findNomu(search_belong) {
	var ret = window.open("pop_manage_cust.phpsearch_belong="+search_belong, "pop_nomu_cust", "top=100, left=100, width=800,height=600, scrollbars");
	return;
}
function findTM(search_belong) {
	var ret = window.open("pop_manage_cust.php?search_belong=1&mode=tm", "pop_nomu_cust", "top=100, left=100, width=800,height=600, scrollbars");
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
function field_add(div_id) {
	var v2 = document.getElementById(div_id+'2');
	var v2b = document.getElementById(div_id+'2b');
	var v3 = document.getElementById(div_id+'3');
	var v3b = document.getElementById(div_id+'3b');
	var v4 = document.getElementById(div_id+'4');
	var v4b = document.getElementById(div_id+'4b');
	var v5 = document.getElementById(div_id+'5');
	var v5b = document.getElementById(div_id+'5b');
	if(v2.style.display == "none") {
		v2.style.display = "";
		v2b.style.display = "";
	} else {
		if(v3.style.display == "none") {
			v3.style.display = "";
			v3b.style.display = "";
		} else {
			if(v4.style.display == "none") {
				v4.style.display = "";
				v4b.style.display = "";
			} else {
				if(v5.style.display == "none") {
					v5.style.display = "";
					v5b.style.display = "";
				} else {
					alert("�ִ� 5������ �߰� �����մϴ�.");
				}
			}
		}
	}
}
function field_del(div_id) {
	var v2 = document.getElementById(div_id+'2');
	var v3 = document.getElementById(div_id+'3');
	var v4 = document.getElementById(div_id+'4');
	var v5 = document.getElementById(div_id+'5');
	var v2b = document.getElementById(div_id+'2b');
	var v3b = document.getElementById(div_id+'3b');
	var v4b = document.getElementById(div_id+'4b');
	var v5b = document.getElementById(div_id+'5b');
	if(v5.style.display == "") {
		v5.style.display = "none";
		v5b.style.display = "none";
	} else {
		if(v4.style.display == "") {
			v4.style.display = "none";
			v4b.style.display = "none";
		} else {
			if(v3.style.display == "") {
				v3.style.display = "none";
				v3b.style.display = "none";
			} else {
				if(v2.style.display == "") {
					v2.style.display = "none";
					v2b.style.display = "none";
				} else {
					alert("�ּ� 1���� �����ؾ� �մϴ�. �ش� ������ ������ ������ �����ϼ���.");
				}
			}
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
</script>
<?
include "inc/top.php";
$url_list = "./total_pay_list.php?page=".$page."&".$qstr;
?>
					<td onmouseover="showM('900')">
						<div style="margin:10px 20px 20px 20px;min-height:480px;">
							<table width="100%" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td width="100"><img src="images/top05.gif" border="0"></td>
									<td width="130"><a href="<?=$url_list?>"><img src="images/top05_03.gif" border="0"></a></td>
									<td></td>
								</tr>
								<tr><td height="1" bgcolor="#cccccc" colspan="9"></td></tr>
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
<?
//���Ѻ� ��ũ��
//echo $member['mb_level'];
if($member['mb_level'] >= 8) {
	$url_save = "javascript:checkData('total_pay_update.php');";
} else {
	$url_save = "javascript:alert_no_right();";
}
?>
							</div>
<?
//���� �� �޴� ��ȣ
$tab_onoff_this = 3;
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
							<div id="tab2" style="">
								<!--��޴� -->
								<a name="50001"></a>
								<table border=0 cellspacing=0 cellpadding=0 style=""> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
														�繫��Ź����
													</td> 
													<td><img src="images/g_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width=2></td> 
										<td valign="bottom"></td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!-- �Է��� -->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<tr>
										<td nowrap class="tdrowk" width="110"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��Ź������</td>
										<td nowrap  class="tdrow" width="245">
<?
$samu_receive_chk = $row['samu_receive_chk'];
if($row['samu_receive_non_arrival']) $samu_receive_non_arrival_text = "�̵���";
//��Ź��ȣ 0 ����
if($row['samu_receive_no']) $samu_receive_no = $row['samu_receive_no'];
else  $samu_receive_no = "";
if($row['samu_receive_no_old']) $samu_receive_no_old = $row['samu_receive_no_old'];
else  $samu_receive_no_old = "";
if($samu_receive_chk == "1") echo "����";
else if($samu_receive_chk == "2") echo "�̵���";
?>
											(<?=$row['samu_receive_date']?>)
											��ȣ(<?=$samu_receive_no?>)
											����ȣ(<?=$samu_receive_no_old?>)
										</td>
										<td nowrap class="tdrowk" width="100"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�繫��Ź����</td>
										<td nowrap class="tdrow" width="" colspan="">
<b>
<?
//�繫��Ź����
$samu_req_yn = $row['samu_req_yn'];
if($samu_req_yn == "1") echo "�ݷ�";
else if($samu_req_yn == "2") echo "���Ӱ���";
else if($samu_req_yn == "3") echo "Ÿ����";
else if($samu_req_yn == "4") echo "����";
else if($samu_req_yn == "5") echo "����";
?>
</b>
											������
											(<?=$row['samu_req_date']?>)
											������
											(<?=$row['samu_close_date']?>)
										</td>
										<td nowrap class="tdrowk" width="100"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�������</td>
										<td nowrap class="tdrow" width="" colspan="3">
<?
$sj_rate = $row['sj_rate'];
?>
											<?=$sj_rate?>%
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��ñٷ���</td>
										<td nowrap class="tdrow">
<?
$persons_gy = $row['persons_gy'];
$persons_sj = $row['persons_sj'];
if($persons_gy == "0") $persons_gy = "";
if($persons_sj == "0") $persons_sj = "";
if($row['emp0_gbn'] == 1) $emp0_gbn = "checked";
?>
											��� <?=$persons_gy?>��
											/
											���� <?=$persons_sj?>��
											<input type="checkbox" name="emp0_gbn" value="1" <?=$emp0_gbn?> style="vertical-align:middle" onclick="persons_0(this)">0��
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����� �Ը�</td>
										<td nowrap class="tdrow" colspan="">
<?
//�����Ը�
if($row['emp5_gbn'] == 1) $emp5_gbn = "checked";
if($row['emp30_gbn'] == 1) $emp30_gbn = "checked";
?>
											<input type="checkbox" name="emp5_gbn" value="1" <?=$emp5_gbn?> style="vertical-align:middle">5�� �̸�
											<input type="checkbox" name="emp30_gbn" value="1" <?=$emp30_gbn?> style="vertical-align:middle">30�� �̻�
										</td>
										<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�ǰ�EDI����</td>
										<td nowrap class="tdrow" width="" colspan="">
<b>
<?
//�ǰ�EDI����
$health_req_yn = $row['health_req_yn'];
if($health_req_yn == "1") echo "�ݷ�";
else if($health_req_yn == "2") echo "���Ӱ���";
else if($health_req_yn == "3") echo "Ÿ����";
else if($health_req_yn == "4") echo "����";
else if($health_req_yn == "5") echo "����";
?>
</b>
											������
											(<?=$row['health_req_date']?>)
											������
											(<?=$row['health_close_date']?>)
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���豸��</td>
										<td nowrap class="tdrow">
<?
//���豸��
$samu_state_gy = $row['samu_state_gy'];
$samu_state_sj = $row['samu_state_sj'];
?>
											���
(<?
if($samu_state_gy == "1") echo "����";
else if($samu_state_gy == "2") echo "�Ҹ�";
?>)
											����
(<? if($samu_state_sj == "1") echo "����";
else if($samu_state_sj == "2") echo "�Ҹ�";
?>)
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�ΰ����� ����</td>
										<td nowrap  class="tdrow">
<?
//�ΰ���������
$levy_kind = $row['levy_kind'];
if($levy_kind == "1") echo "�ΰ�����";
else if($levy_kind == "2") echo "�����Ű�";
else if($levy_kind == "3") echo "�ΰ�+����";
?>
										</td>
										<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�������</td>
										<td nowrap  class="tdrow">
<?
//��������
$employer_insure = $row['employer_insure'];
if($employer_insure == "1") echo "����ֻ���";
else if($employer_insure == "2") echo "�ڿ����ڰ��";
?>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�Ҹ�����</td>
										<td nowrap class="tdrow">
											���
											(<?=$row['samu_discharge_date_gy']?>)
											����
											(<?=$row['samu_discharge_date_sj']?>)
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">������������</td>
										<td nowrap  class="tdrow">
<?
//������������
$samu_branch = $row['samu_branch'];
echo $samu_branch;
?>
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��������</td>
										<td nowrap  class="tdrow">
											<?=$row['samu_charge']?>
										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px;line-height:0px;"></div>

								<table border=0 cellspacing=0 cellpadding=0 style=""> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/so_tab_on_lt.gif"></td> 
													<td background="images/so_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
														�����Ű�
													</td> 
													<td><img src="images/so_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width=2></td> 
										<td valign="bottom"></td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="botr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!-- �Է��� -->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<tr>
										<td nowrap class="tdrowk" width="110" style="padding-top:5px;padding-bottom:5px;"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">2014�⵵<br><img src="./images/blank.gif" width="7" height="2">�����Ű�</td>
										<td nowrap class="tdrow" width="" colspan="">
<?
//�����Ű� DB
$sql_total_insure = " select * from com_total_insure where com_code='$com_code' and year='2014' ";
$result_total_insure = sql_query($sql_total_insure);
$row_total_insure = mysql_fetch_array($result_total_insure);

if($row_total_insure['easynomu']) $total_insure_input[0] = "�����빫.";
else $total_insure_input[0] = "";
if($row_total_insure['data']) $total_insure_input[1] = "�ڷ�.";
else $total_insure_input[1] = "";
if($row_total_insure['duzon']) $total_insure_input[2] = "����.";
else $total_insure_input[2] = "";
if($row_total_insure['fax']) $total_insure_input[3] = "�ѽ�.";
else $total_insure_input[3] = "";
if($row_total_insure['mail']) $total_insure_input[4] = "�ڷ�.";
else $total_insure_input[4] = "";
if($row_total_insure['report']) $total_insure_input[5] = "�Ű�";
else $total_insure_input[5] = "";
//��������
if($total_insure_input[0] || $total_insure_input[1] || $total_insure_input[2] || $total_insure_input[3] || $total_insure_input[4] || $total_insure_input[5]) {
?>
											<b>����</b> :
<?
	echo $total_insure_input[0];
	echo $total_insure_input[1];
	echo $total_insure_input[2];
	echo $total_insure_input[3];
	echo $total_insure_input[4];
	echo $total_insure_input[5];
}
//�Ű���
$total_insure_process_chk = $row_total_insure['ok_report'];
if($total_insure_process_chk) {
?>
											<b>�Ű���Ȳ</b> :
<?
	if($total_insure_process_chk == "1") echo "ó����";
	else if($total_insure_process_chk == "2") echo "�Ű�Ϸ�";
	else if($total_insure_process_chk == "3") echo "��ü�Ű�";
	else if($total_insure_process_chk == "4") echo "ȸ��Ű�";
	else if($total_insure_process_chk == "5") echo "����Ű�";
	else if($total_insure_process_chk == "6") echo "�ݷ�";
	else if($total_insure_process_chk == "7") echo "��Ÿ";
}
?>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk" width="" style="padding-top:5px;padding-bottom:5px;"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">2015�⵵<br><img src="./images/blank.gif" width="7" height="2">�����Ű�</td>
										<td nowrap class="tdrow" width="" colspan="">
<?
//�����Ű� DB
$sql_total_insure = " select * from com_total_insure where com_code='$com_code' and year='2015' ";
$result_total_insure = sql_query($sql_total_insure);
$row_total_insure = mysql_fetch_array($result_total_insure);

if($row_total_insure['easynomu']) $total_insure_input[0] = "�����빫.";
else $total_insure_input[0] = "";
if($row_total_insure['data']) $total_insure_input[1] = "�ڷ�.";
else $total_insure_input[1] = "";
if($row_total_insure['duzon']) $total_insure_input[2] = "����.";
else $total_insure_input[2] = "";
if($row_total_insure['fax']) $total_insure_input[3] = "�ѽ�.";
else $total_insure_input[3] = "";
if($row_total_insure['mail']) $total_insure_input[4] = "�ڷ�.";
else $total_insure_input[4] = "";
if($row_total_insure['report']) $total_insure_input[5] = "�Ű�";
else $total_insure_input[5] = "";
//��������
if($total_insure_input[0] || $total_insure_input[1] || $total_insure_input[2] || $total_insure_input[3] || $total_insure_input[4] || $total_insure_input[5]) {
?>
											<b>����</b> :
<?
	echo $total_insure_input[0];
	echo $total_insure_input[1];
	echo $total_insure_input[2];
	echo $total_insure_input[3];
	echo $total_insure_input[4];
	echo $total_insure_input[5];
}
//�Ű���
$total_insure_process_chk = $row_total_insure['ok_report'];
if($total_insure_process_chk) {
?>
											<b>�Ű���Ȳ</b> :
<?
	if($total_insure_process_chk == "1") echo "ó����";
	else if($total_insure_process_chk == "2") echo "�Ű�Ϸ�";
	else if($total_insure_process_chk == "3") echo "��ü�Ű�";
	else if($total_insure_process_chk == "4") echo "ȸ��Ű�";
	else if($total_insure_process_chk == "5") echo "����Ű�";
	else if($total_insure_process_chk == "6") echo "�ݷ�";
	else if($total_insure_process_chk == "7") echo "��Ÿ";
}
?>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk" style="padding-top:5px;padding-bottom:5px;"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">2016�⵵<br><img src="./images/blank.gif" width="7" height="2">�����Ű�</td>
										<td nowrap class="tdrow" colspan="">
											<input name="total_insure_com_name" type="hidden" value="<?=$row['com_name']?>">
											<input name="total_insure_year" type="hidden" value="<?=$total_insure_year?>">
											<input name="total_insure_t_no" type="hidden" value="<?=$row['t_insureno']?>">
<?
//�����Ѿ׽Ű� DB
$sql_total_insure = " select * from com_total_insure where com_code='$com_code' and year='$total_insure_year' ";
$result_total_insure = sql_query($sql_total_insure);
$row_total_insure = mysql_fetch_array($result_total_insure);

if($row_total_insure['easynomu']) $total_insure_input[0] = "checked";
else $total_insure_input[0] = "";
if($row_total_insure['data']) $total_insure_input[1] = "checked";
else $total_insure_input[1] = "";
if($row_total_insure['duzon']) $total_insure_input[2] = "checked";
else $total_insure_input[2] = "";
if($row_total_insure['fax']) $total_insure_input[3] = "checked";
else $total_insure_input[3] = "";
if($row_total_insure['mail']) $total_insure_input[4] = "checked";
else $total_insure_input[4] = "";
if($row_total_insure['report']) $total_insure_input[5] = "checked";
else $total_insure_input[5] = "";
?>
											<b>����</b>
											<input type="checkbox" name="total_insure_input1" value="1" <?=$total_insure_input[0]?> style="vertical-align:middle">�����빫
											<input type="checkbox" name="total_insure_input2" value="1" <?=$total_insure_input[1]?> style="vertical-align:middle">�ڷ�
											<input type="checkbox" name="total_insure_input3" value="1" <?=$total_insure_input[2]?> style="vertical-align:middle">����
											<input type="checkbox" name="total_insure_input4" value="1" <?=$total_insure_input[3]?> style="vertical-align:middle">�ѽ�
											<input type="checkbox" name="total_insure_input5" value="1" <?=$total_insure_input[4]?> style="vertical-align:middle">����
											<input type="checkbox" name="total_insure_input6" value="1" <?=$total_insure_input[5]?> style="vertical-align:middle">�Ű�
											<b>��������</b>
											<input name="total_insure_input_date" type="text" class="textfm" style="width:76px;ime-mode:disabled;" value="<?=$row_total_insure['input_date']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
											<table border=0 cellpadding=0 cellspacing=0 style="display:inline;vertical-align:middle"><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:loadCalendar(document.dataForm.total_insure_input_date);" target="">�޷�</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table>
											<b>���Ű���Ȳ</b>
<?
$total_insure_process_chk = $row_total_insure['ok_report'];
?>
											<select name="total_insure_process" class="selectfm" onchange="input_today(this,'total_insure_process_date', '2')">
												<option value=""  <? if($total_insure_process_chk == "")  echo "selected"; ?>>����</option>
												<option value="1" <? if($total_insure_process_chk == "1") echo "selected"; ?>>ó����</option>
												<option value="2" <? if($total_insure_process_chk == "2") echo "selected"; ?>>�Ű�Ϸ�</option>
												<option value="3" <? if($total_insure_process_chk == "3") echo "selected"; ?>>��ü�Ű�</option>
												<option value="4" <? if($total_insure_process_chk == "4") echo "selected"; ?>>ȸ��Ű�</option>
												<option value="5" <? if($total_insure_process_chk == "5") echo "selected"; ?>>����Ű�</option>
												<option value="6" <? if($total_insure_process_chk == "6") echo "selected"; ?>>�ݷ�</option>
												<option value="7" <? if($total_insure_process_chk == "7") echo "selected"; ?>>��Ÿ</option>
											</select>
											<b>���Ű���</b>
											<input name="total_insure_process_date" type="text" class="textfm" style="width:76px;ime-mode:disabled;" value="<?=$row_total_insure['ok_date']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
											<table border=0 cellpadding=0 cellspacing=0 style="display:inline;vertical-align:middle"><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:loadCalendar(document.dataForm.total_insure_process_date);" target="">�޷�</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table>
										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px;line-height:0px;"></div>

								<table border=0 cellspacing=0 cellpadding=0 style=""> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
														�����Ѿ׽Ű�
													</td> 
													<td><img src="images/g_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width=2></td> 
										<td valign="bottom"></td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!-- �Է��� -->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<tr>
										<td nowrap class="tdrowk" width="110"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">TM�Ŵ���</td>
										<td nowrap  class="tdrow" width="464">
<?
$tm_code = $row['tm_cust_numb'];
$tm_name = $row['tm_cust_name'];
?>
											<input type="text" name="tm_cust_numb" class="textfm" style="width:34px" readonly value="<?=$tm_code?>">
											<input name="tm_cust_name" type="text" class="textfm" style="width:88px" readonly value="<?=$tm_name?>">
											<table border="0" cellpadding="0" cellspacing="0" style="display:inline;vertical-align:middle"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white nowrap"><a href="javascript:findTM(document.dataForm.damdang_code.value);" target="">�˻�</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
										</td>
										<td nowrap class="tdrowk" width="100"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��Ź��������</td>
										<td nowrap class="tdrow" width="" colspan="">
<?
$samu_keep = $row['samu_keep'];
?>
											<select name="samu_keep" class="selectfm" onchange="input_today(this,'samu_keep_date', '3')">
												<option value="">����</option>
												<option value="1" <? if($samu_keep == "1")  echo "selected"; ?>>����</option>
												<option value="2" <? if($samu_keep == "2") echo "selected"; ?>>��������</option>
												<option value="3" <? if($samu_keep == "3") echo "selected"; ?>>����</option>
											</select>
											<b>������</b>
											<input name="samu_keep_date" type="text" class="textfm" style="width:76px;ime-mode:disabled;" value="<?=$row['samu_keep_date']?>" maxlength="10" onKeyPress="only_number();" onkeyup="checkcomma(this.value, this,'Y')">
											<table border=0 cellpadding=0 cellspacing=0 style="display:inline;vertical-align:middle"><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:loadCalendar(document.dataForm.samu_keep_date);" target="">�޷�</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk" style="padding:3px 6px 0 6px;" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">2013�⵵<br><img src="./images/blank.gif" width="7" height="2">(���/����)</td>
										<td nowrap class="tdrow" width="" colspan="">
<?
//�����Ѿ׽Ű� DB
$sql_total = " select * from com_total_pay where com_code='$com_code' and year='2013' ";
$result_total = sql_query($sql_total);
$row_total = mysql_fetch_array($result_total);

if($row_total['easynomu']) $total_input[0] = "�����빫.";
else $total_input[0] = "";
if($row_total['kidsnomu']) $total_input[1] = "Ű��빫.";
else $total_input[1] = "";
if($row_total['duzon']) $total_input[2] = "����.";
else $total_input[2] = "";
if($row_total['fax']) $total_input[3] = "�ѽ�.";
else $total_input[3] = "";
if($row_total['mail']) $total_input[4] = "�ڷ�.";
else $total_input[4] = "";
if($row_total['etc']) $total_input[5] = "��Ÿ(".$row_total['etc_memo'].")";
else $total_input[5] = "";
//��������
if($total_input[0] || $total_input[1] || $total_input[2] || $total_input[3] || $total_input[4] || $total_input[5]) {
?>
											<b>����</b> :
<?
	echo $total_input[0];
	echo $total_input[1];
	echo $total_input[2];
	echo $total_input[3];
	echo $total_input[4];
	echo $total_input[5];
}
//�Ű���
$total_process_chk = $row_total['ok_report'];
if($total_process_chk) {
?>
											<b>�Ű���Ȳ</b> :
<?
	if($total_process_chk == "1") echo "ó����";
	else if($total_process_chk == "2") echo "�Ű�Ϸ�";
	else if($total_process_chk == "3") echo "��ü�Ű�";
	else if($total_process_chk == "4") echo "�ݷ�";
	else if($total_process_chk == "5") echo "��Ÿ";
}
?>

										</td>
										<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">2013�⵵<br><img src="./images/blank.gif" width="7" height="2">(�ǰ�)</td>
										<td nowrap class="tdrow" width="" colspan="">
<?
//�Ű��� �ǰ�����
$total_process_chk = $row_total['ok_report_gg'];
if($total_process_chk) {
?>
											<b>�Ű���Ȳ</b> :
<?
	if($total_process_chk == "1") echo "ó����";
	else if($total_process_chk == "2") echo "�Ű�Ϸ�";
	else if($total_process_chk == "3") echo "��ü�Ű�";
	else if($total_process_chk == "4") echo "�ݷ�";
	else if($total_process_chk == "5") echo "��Ÿ";
}
?>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk" style="padding:3px 6px 0 6px;" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">2014�⵵<br><img src="./images/blank.gif" width="7" height="2">(���/����)</td>
										<td nowrap class="tdrow" width="" colspan="">
<?
//�����Ѿ׽Ű� DB
$sql_total = " select * from com_total_pay where com_code='$com_code' and year='2014' ";
$result_total = sql_query($sql_total);
$row_total = mysql_fetch_array($result_total);

if($row_total['easynomu']) $total_input[0] = "�����빫.";
else $total_input[0] = "";
if($row_total['kidsnomu']) $total_input[1] = "Ű��빫.";
else $total_input[1] = "";
if($row_total['duzon']) $total_input[2] = "����.";
else $total_input[2] = "";
if($row_total['fax']) $total_input[3] = "�ѽ�.";
else $total_input[3] = "";
if($row_total['mail']) $total_input[4] = "�ڷ�.";
else $total_input[4] = "";
if($row_total['etc']) $total_input[5] = "��Ÿ(".$row_total['etc_memo'].")";
else $total_input[5] = "";
//��������
if($total_input[0] || $total_input[1] || $total_input[2] || $total_input[3] || $total_input[4] || $total_input[5]) {
?>
											<b>����</b> :
<?
	echo $total_input[0];
	echo $total_input[1];
	echo $total_input[2];
	echo $total_input[3];
	echo $total_input[4];
	echo $total_input[5];
}
//�Ű���
$total_process_chk = $row_total['ok_report'];
if($total_process_chk) {
?>
											<b>�Ű���Ȳ</b> :
<?
	if($total_process_chk == "1") echo "ó����";
	else if($total_process_chk == "2") echo "�Ű�Ϸ�";
	else if($total_process_chk == "3") echo "��ü�Ű�";
	else if($total_process_chk == "4") echo "�ݷ�";
	else if($total_process_chk == "5") echo "��Ÿ";
}
?>

										</td>
										<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">2014�⵵<br><img src="./images/blank.gif" width="7" height="2">(�ǰ�)</td>
										<td nowrap class="tdrow" width="" colspan="">
<?
//�Ű��� �ǰ�����
$total_process_chk = $row_total['ok_report_gg'];
if($total_process_chk) {
?>
											<b>�Ű���Ȳ</b> :
<?
	if($total_process_chk == "1") echo "ó����";
	else if($total_process_chk == "2") echo "�Ű�Ϸ�";
	else if($total_process_chk == "3") echo "��ü�Ű�";
	else if($total_process_chk == "4") echo "�ݷ�";
	else if($total_process_chk == "5") echo "��Ÿ";
}
?>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">2015�⵵<br><img src="./images/blank.gif" width="7" height="2">(���/����)</td>
										<td nowrap class="tdrow" colspan="">
											<input name="total_com_name" type="hidden" value="<?=$row['com_name']?>">
											<input name="total_year" type="hidden" value="<?=$total_year?>">
											<input name="total_t_no" type="hidden" value="<?=$row['t_insureno']?>">
											<b>����</b>
<?
//�����Ѿ׽Ű� DB
$sql_total = " select * from com_total_pay where com_code='$com_code' and year='$total_year' ";
$result_total = sql_query($sql_total);
$row_total = mysql_fetch_array($result_total);

if($row_total['easynomu']) $total_input[0] = "checked";
else $total_input[0] = "";
if($row_total['kidsnomu']) $total_input[1] = "checked";
else $total_input[1] = "";
if($row_total['duzon']) $total_input[2] = "checked";
else $total_input[2] = "";
if($row_total['fax']) $total_input[3] = "checked";
else $total_input[3] = "";
if($row_total['mail']) $total_input[4] = "checked";
else $total_input[4] = "";
if($row_total['etc']) $total_input[5] = "checked";
else $total_input[5] = "";
?>
											<input type="checkbox" name="total_input1" value="1" <?=$total_input[0]?> style="vertical-align:middle">�����빫
											<input type="checkbox" name="total_input2" value="1" <?=$total_input[1]?> style="vertical-align:middle">Ű��빫
											<input type="checkbox" name="total_input3" value="1" <?=$total_input[2]?> style="vertical-align:middle">����
											<input type="checkbox" name="total_input4" value="1" <?=$total_input[3]?> style="vertical-align:middle">�ѽ�
											<input type="checkbox" name="total_input5" value="1" <?=$total_input[4]?> style="vertical-align:middle">����
											<input type="checkbox" name="total_input6" value="1" <?=$total_input[5]?> style="vertical-align:middle">��Ÿ
											<input name="total_input_etc" type="text" class="textfm" style="width:88px" value="<?=$row_total['etc_memo']?>">
											<br>
											<b>������</b>
											<input name="total_input_date" type="text" class="textfm" style="width:70px;ime-mode:disabled;" value="<?=$row_total['input_date']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
											<table border=0 cellpadding=0 cellspacing=0 style="display:inline;vertical-align:middle"><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:loadCalendar(document.dataForm.total_input_date);" target="">�޷�</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table>
											<b>�Ű���Ȳ</b>
<?
$total_process_chk = $row_total['ok_report'];
?>
											<select name="total_process" class="selectfm" onchange="input_today(this,'total_process_date', '4')">
												<option value=""  <? if($total_process_chk == "")  echo "selected"; ?>>����</option>
												<option value="1" <? if($total_process_chk == "1") echo "selected"; ?>>�ȳ��Ϸ�(1��)</option>
												<option value="2" <? if($total_process_chk == "2") echo "selected"; ?>>�ȳ��Ϸ�(2��)</option>
												<option value="3" <? if($total_process_chk == "3") echo "selected"; ?>>ó����</option>
												<option value="4" <? if($total_process_chk == "4") echo "selected"; ?>>�Ű�Ϸ�</option>
												<option value="5" <? if($total_process_chk == "5") echo "selected"; ?>>��ü�Ű�</option>
												<option value="6" <? if($total_process_chk == "6") echo "selected"; ?>>�ݷ�</option>
												<option value="7" <? if($total_process_chk == "7") echo "selected"; ?>>��������</option>
												<option value="8" <? if($total_process_chk == "8") echo "selected"; ?>>�����Ϸ�</option>
											</select>
											<b>�Ű���</b>
											<input name="total_process_date" type="text" class="textfm" style="width:70px;ime-mode:disabled;" value="<?=$row_total['ok_date']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
											<table border=0 cellpadding=0 cellspacing=0 style="display:inline;vertical-align:middle"><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:loadCalendar(document.dataForm.total_process_date);" target="">�޷�</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table>
										</td>
										<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">2015�⵵<br><img src="./images/blank.gif" width="7" height="2">(�ǰ�)</td>
										<td nowrap class="tdrow" width="" colspan="">
											<b>�Ű���Ȳ</b>
<?
$total_process_chk = $row_total['ok_report_gg'];
?>
											<select name="total_process_gg" class="selectfm" onchange="input_today(this,'total_process_date_gg', '2')">
												<option value=""  <? if($total_process_chk == "")  echo "selected"; ?>>����</option>
												<option value="1" <? if($total_process_chk == "1") echo "selected"; ?>>ó����</option>
												<option value="2" <? if($total_process_chk == "2") echo "selected"; ?>>�Ű�Ϸ�</option>
												<option value="3" <? if($total_process_chk == "3") echo "selected"; ?>>��ü�Ű�</option>
												<option value="4" <? if($total_process_chk == "4") echo "selected"; ?>>�ݷ�</option>
												<option value="5" <? if($total_process_chk == "5") echo "selected"; ?>>��Ÿ</option>
											</select>
											<b>�Ű���</b>
											<input name="total_process_date_gg" type="text" class="textfm" style="width:76px;ime-mode:disabled;" value="<?=$row_total['ok_date_gg']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
											<table border=0 cellpadding=0 cellspacing=0 style="display:inline;vertical-align:middle"><tr><td width=2></td><td><img src=./images/btn2_lt.gif></td><td background=./images/btn2_bg.gif class=ftbutton3_white nowrap><a href="javascript:loadCalendar(document.dataForm.total_process_date_gg);" target="">�޷�</a></td><td><img src=./images/btn2_rt.gif></td> <td width=2></td></tr></table>
										</td>
									</tr>
								</table>
							<div>

							<div id="tab3" style="display:none;">
								<div style="height:10px;font-size:0px;line-height:0px;"></div>
								<!--��޴� -->
								<a name="60001"></a>
								<table border=0 cellspacing=0 cellpadding=0 style=""> 
									<tr>
										<td id=""> 
											<table border=0 cellpadding=0 cellspacing=0> 
												<tr> 
													<td><img src="images/g_tab_on_lt.gif"></td> 
													<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
														���� �ǵ��
													</td> 
													<td><img src="images/g_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width=2></td> 
										<td valign="bottom"></td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!-- �Է��� -->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<tr>
										<td nowrap class="tdrowk" width="130"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��ȭ����</td>
										<td nowrap class="tdrow" width="290">
											<input name="samu_call_date" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row2['samu_call_date']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')">
											<table border=0 cellpadding=0 cellspacing=0 style="display:inline;vertical-align:middle"><tr><td width=2></td><td><img src=./images/btn3_lt.gif></td><td background=./images/btn3_bg.gif class=ftbutton3_white nowrap><a href="javascript:chk_today('samu_call_date', '1');" target="">�Ϸ�</a></td><td><img src=./images/btn3_rt.gif></td> <td width=2></td></tr></table>
										</td>
										<td nowrap class="tdrowk" width="130"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�ѽ����۰��</td>
										<td nowrap  class="tdrow" width="">
<?
//�ѽ����۰��
$fax_error = $row['fax_error'];
$fax_error2 = $row['fax_error2'];
$fax_error3 = $row['fax_error3'];
?>
											1��
											<select name="fax_error" class="selectfm" onchange="">
												<option value=""  <? if($fax_error == "")  echo "selected"; ?>>����</option>
												<option value="1" <? if($fax_error == "1") echo "selected"; ?>>��������</option>
												<option value="2" <? if($fax_error == "2") echo "selected"; ?>>�κ�����</option>
												<option value="3" <? if($fax_error == "3") echo "selected"; ?>>��ȭ����</option>
												<option value="4" <? if($fax_error == "4") echo "selected"; ?>>�������</option>
												<option value="5" <? if($fax_error == "5") echo "selected"; ?>>���¹�ȣ</option>
												<option value="6" <? if($fax_error == "6") echo "selected"; ?>>��ȭ��</option>
												<option value="7" <? if($fax_error == "7") echo "selected"; ?>>��Ÿ</option>
											</select>
											2��
											<select name="fax_error2" class="selectfm" onchange="">
												<option value=""  <? if($fax_error2 == "")  echo "selected"; ?>>����</option>
												<option value="1" <? if($fax_error2 == "1") echo "selected"; ?>>��������</option>
												<option value="2" <? if($fax_error2 == "2") echo "selected"; ?>>�κ�����</option>
												<option value="3" <? if($fax_error2 == "3") echo "selected"; ?>>��ȭ����</option>
												<option value="4" <? if($fax_error2 == "4") echo "selected"; ?>>�������</option>
												<option value="5" <? if($fax_error2 == "5") echo "selected"; ?>>���¹�ȣ</option>
												<option value="6" <? if($fax_error2 == "6") echo "selected"; ?>>��ȭ��</option>
												<option value="7" <? if($fax_error2 == "7") echo "selected"; ?>>��Ÿ</option>
											</select>
											3��
											<select name="fax_error3" class="selectfm" onchange="">
												<option value=""  <? if($fax_error3 == "")  echo "selected"; ?>>����</option>
												<option value="1" <? if($fax_error3 == "1") echo "selected"; ?>>��������</option>
												<option value="2" <? if($fax_error3 == "2") echo "selected"; ?>>�κ�����</option>
												<option value="3" <? if($fax_error3 == "3") echo "selected"; ?>>��ȭ����</option>
												<option value="4" <? if($fax_error3 == "4") echo "selected"; ?>>�������</option>
												<option value="5" <? if($fax_error3 == "5") echo "selected"; ?>>���¹�ȣ</option>
												<option value="6" <? if($fax_error3 == "6") echo "selected"; ?>>��ȭ��</option>
												<option value="7" <? if($fax_error3 == "7") echo "selected"; ?>>��Ÿ</option>
											</select>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�޸�</td>
										<td nowrap  class="tdrow" colspan="3">
											<textarea name="samu_feedback_memo" class="textfm" style='width:100%;height:40px; word-break:break-all;' itemname="first_review_item" required><?=$row2['samu_feedback_memo']?></textarea>
										</td>
									</tr>
								</table>
							<!--�繫��Ź����, ���� �ǵ�� DIV ��-->
							</div>

								<div style="height:20px;font-size:0px"></div>
								<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layput:fixed">
									<tr>
										<td align="center">
<?
if($member['mb_level'] >= 6) {
?>
											<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_save?>" target="">�� ��</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table>
<? } ?>
											<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="./total_pay_list.php?<?=$qstr?>&page=<?=$page?>" target="">�� ��</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table>
<?
if($w == "u") {
?>
										<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./client_view.php?w=<?=$w?>&id=<?=$id?>" target="">�ŷ�ó����</a></td><td><img src=images/btn_rt.gif></td><td width="2"></td></tr></table>
										<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./client_process_view.php?w=<?=$w?>&id=<?=$id?>" target="">����ó����Ȳ</a></td><td><img src=images/btn_rt.gif></td><td width="2"></td></tr></table>
										<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./samu_view.php?w=<?=$w?>&id=<?=$id?>" target="">�繫��Ź��Ȳ</a></td><td><img src=images/btn_rt.gif></td><td width="2"></td></tr></table>
<? } ?>
										</td>
									</tr>
								</table>

<?
include "inc/client_samu_inc.php";
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


									</td>
								</tr>
							</table>
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
