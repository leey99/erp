<?
$sub_menu = "1800300";
/*
//W3C Markup �˻� ���� �α��� ����
$mb['mb_id'] = "kcmc2006";
$g4_path = ".."; // common.php �� ��� ���
include_once("$g4_path/common_erp.php");
set_session('erp_mb_id', $mb['mb_id']);
$member['mb_name'] = "�̿���";
*/
//���� ���� �ε�
include_once("./_common.php");

$sql_common = " from job_time a ";

$now_time = date("Y-m-d H:i:s");
$sql_common = " from com_list_gy a, com_list_gy_opt b ";

//echo $member[mb_profile];
if($is_admin != "super") {
	//�α��� �Ӽ����� ������� �̵� �� �ش� ����� ��ȯ�� ��� ���� 150709
	//$stx_man_cust_name = $member['mb_profile'];
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

$sub_title = "�Ǽ�������(��)";
$g4['title'] = $sub_title." : ���α׷� : ".$easynomu_name;

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
//�޸�
$memo = $row['memo'];
$memo1 = $row['memo1'];
$memo2 = $row['memo2'];
$memo3 = $row['memo3'];
$memo4 = $row['memo4'];
$memo5 = $row['memo5'];
//�˻� �Ķ���� ����
$qstr = "stx_comp_name=".$stx_comp_name."&amp;stx_t_no=".$stx_t_no."&amp;stx_biz_no=".$stx_biz_no."&amp;stx_boss_name=".$stx_boss_name."&amp;stx_comp_tel=".$stx_comp_tel."&amp;stx_proxy=".$stx_proxy."&amp;stx_comp_gubun1=".$stx_comp_gubun1."&amp;stx_comp_gubun2=".$stx_comp_gubun2."&amp;stx_comp_gubun3=".$stx_comp_gubun3."&amp;stx_comp_gubun4=".$stx_comp_gubun4."&amp;stx_comp_gubun5=".$stx_comp_gubun5."&amp;stx_comp_gubun6=".$stx_comp_gubun6."&amp;stx_man_cust_name=".$stx_man_cust_name."&amp;stx_man_cust_name2=".$stx_man_cust_name2."&amp;stx_uptae=".$stx_uptae."&amp;stx_upjong=".$stx_upjong."&amp;search_ok=".$search_ok;
$qstr .= "&amp;easynomu_process=".$easynomu_process."&amp;stx_reg_day_chk=".$stx_reg_day_chk."&amp;search_year=".$search_year."&amp;search_month=".$search_month."&amp;search_year_end=".$search_year_end."&amp;search_month_end=".$search_month_end."&amp;stx_search_day_chk=".$stx_search_day_chk."&amp;search_sday=".$search_sday."&amp;search_eday=".$search_eday."&amp;stx_emp5_gbn=".$stx_emp5_gbn."&amp;stx_emp30_gbn=".$stx_emp30_gbn;
$qstr .= "&amp;search_day_all=".$search_day_all."&amp;search_day1=".$search_day1."&amp;search_day2=".$search_day2."&amp;search_day3=".$search_day3."&amp;search_day4=".$search_day4."&amp;search_day5=".$search_day5."&amp;search_day6=".$search_day6."&amp;search_day7=".$search_day7."&amp;search_day8=".$search_day8."&amp;stx_manage_name=".$stx_manage_name."&amp;stx_biz_no_input_not=".$stx_biz_no_input_not."&amp;stx_t_no_input_not=".$stx_t_no_input_not."&amp;stx_manage_name_input_not=".$stx_manage_name_input_not;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css" />
<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
<script type="text/javascript" src="js/common.js"></script>
</head>
<body style="margin:0px;background-color:#f7fafd">
<script type="text/javascript" src="./js/jquery-1.8.0.min.js" charset="euc-kr"></script>
<script type="text/javascript">
//<![CDATA[
function checkID() {
	var frm = document.dataForm;
	if (frm.comp_bznb.value == "") {
		alert("����ڹ�ȣ�� �Է��ϼ���.");
		frm.comp_bznb.focus();
		return;
	}
	var ret = window.open("./common/member_idcheck.php?user_id="+frm.comp_bznb.value, "id_check", "top=100, left=100, width=395,height=240");
	return;
}
function member_form() {
	var frm = document.dataForm;
	if (frm.firm_name.value == "") {
		alert("�������� �Է��ϼ���.");
		frm.firm_name.focus();
		return;
	}
	if(radio_chk(frm.comp_type, "����ڱ�����") == 0) {
		frm.comp_type[0].focus();
		return;
	}
	if (frm.comp_bznb.value == "") {
		alert("����ڵ�Ϲ�ȣ�� �Է��ϼ���.");
		frm.comp_bznb.focus();
		return;
	}
	if (frm.user_pass.value == "") {
		alert("��й�ȣ�� �Է��ϼ���.");
		frm.user_pass.focus();
		return;
	}
	window.open("/admin/member_form_easynomu.php?mb_id="+frm.user_id.value+"&mb_password="+frm.user_pass.value+"&mb_name="+frm.firm_name.value);
}
function id_copy() {
	var frm = document.dataForm;
	frm.user_id.value = frm.comp_bznb.value;
}
function checkData(action_file) {
	var frm = document.dataForm;
	var rv = 0;
	if(frm.easynomu_process.value == "")
	{
		alert("ó����Ȳ�� �����ϼ���.");
		frm.easynomu_process.focus();
		return;
	}
	frm.action = action_file;
	frm.submit();
	return;
}
function radio_chk(x,t) {
	var count=0;
	for(i=0;i<x.length;i++) {
		if(x[i].checked){
			count += 1;
			radio_name_val = x[i].value; 
		}
	}
	if(count == 0) {
		alert(t+" ������ �ּ���.");
		return rv = 0;
	} else {
		//alert(radio_name_val);
		return rv = 1;
	}
}
// ���� �˻� Ȯ��
function del(page,id) {
	if(confirm("�����Ͻðڽ��ϱ�?")) {
		location.href = "4insure_delete.php?page="+page+"&id="+id;
	}
}
function goSearch() {
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
			//del 46 , backsp 8 , left 37 , right 39 , tab 9 , shift 16 , Ctrl+V , Ctrl+C
			if(event.keyCode != 46 && event.keyCode != 8 && event.keyCode != 37 && event.keyCode != 39 && event.keyCode != 9 && event.keyCode != 16 && !(event.ctrlKey  == true && event.keyCode == 86) && !(event.ctrlKey  == true && event.keyCode == 67)) {
				event.preventDefault ? event.preventDefault() : event.returnValue = false;
			}
		}
	}
}
function only_number_hyphen() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if (event.keyCode < 95 || event.keyCode > 105) {
			//del 46 , backsp 8 , left 37 , right 39 , tab 9 , shift 16 , Ctrl+V , Ctrl+C
			if(event.keyCode != 46 && event.keyCode != 8 && event.keyCode != 37 && event.keyCode != 39 && event.keyCode != 9 && event.keyCode != 16 && !(event.ctrlKey  == true && event.keyCode == 86) && !(event.ctrlKey  == true && event.keyCode == 67)) {
				event.preventDefault ? event.preventDefault() : event.returnValue = false;
			}
		}
	}
}
function only_number_comma() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if (event.keyCode < 95 || event.keyCode > 105) {
			//del 46 , backsp 8 , left 37 , right 39 , tab 9 , shift 16 , Ctrl+V , Ctrl+C
			if(event.keyCode != 46 && event.keyCode != 8 && event.keyCode != 37 && event.keyCode != 39 && event.keyCode != 9 && event.keyCode != 16 && !(event.ctrlKey  == true && event.keyCode == 86) && !(event.ctrlKey  == true && event.keyCode == 67)) {
				event.returnValue = false;
			}
		}
	}
}
function only_number_isnan() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if (event.keyCode < 95 || event.keyCode > 105) {
			//del 46 , backsp 8 , left 37 , right 39 , tab 9 , shift 16 , Ctrl+V , Ctrl+C
			if(event.keyCode != 46 && event.keyCode != 8 && event.keyCode != 37 && event.keyCode != 39 && event.keyCode != 9 && event.keyCode != 16 && !(event.ctrlKey  == true && event.keyCode == 86) && !(event.ctrlKey  == true && event.keyCode == 67)) {
				event.preventDefault ? event.preventDefault() : event.returnValue = false;
			}
		}
	}
}
//������ ���� üũ �Լ�
function settlement_day_last_chk(val) {
	var main = document.dataForm;
	if(val.checked == true) {
		if(main.settlement_day.value != "") main.old_settlement_day.value = main.settlement_day.value;
		main.settlement_day.value = "";
	} else {
		main.settlement_day.value = main.old_settlement_day.value;
	}
}
//]]>
</script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/lang/calendar-ko.js"></script>
<script type="text/javascript">
//<![CDATA[
function loadCalendar( obj, k, i ) {
	main = document.dataForm;
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
		obj_name = obj.name.substring(0, 18);
		//alert(obj_name);
		if(obj_name == "approval_effective") {
			var y  = date.substring(0,4);
			var m = date.substring(5,7);
			var d = date.substring(8,10); 
			var date = new Date(m+'/'+d+'/'+y);
			//alert(d+'/'+m+'/'+y);
			var getDate = date.setYear(date.getFullYear() + 1);
			var getDate = date.setDate(date.getDate() - 1);
			var getDate = new Date(getDate);
			var yyyy = getDate.getFullYear();
			var mm = getDate.getMonth()+1;
			var dd = getDate.getDate();
			if(mm < 10) mm = "0"+mm;
			if(dd < 10) dd = "0"+dd;
			resultDate = yyyy+"."+mm+"."+dd;
			main['approval_expiration'+k].value = resultDate;
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
function findNomu(branch) {
	var ret = window.open("pop_manage_cust.php?search_belong="+branch, "pop_nomu_cust", "top=100, left=100, width=800,height=600, scrollbars");
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
			if(inputVal.length == 3) {
				//input = delhyphen(inputVal, inputVal.length);
				total += input.substring(0,3)+"-";
			} else if(inputVal.length == 6) {
				total += inputVal.substring(0,8)+"-";
			} else if(inputVal.length == 12) {
				total += inputVal.substring(0,14)+"-";
			} else {
				total += inputVal;
			}
			if(keydown =='Y') {
				main.t_insureno.value=total;
			}else if(keydown =='N') {
				return total
			}
		}
		return total
	}
}
function delhyphen(inputVal, count) {
	var tmp = "";
	for(i=0; i<count; i++) {
		if(inputVal.substring(i,i+1)!='-') {		// ���� substring�� ����
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
			if(inputVal.length == 4) {
				//input = delhyphen(inputVal, inputVal.length);
				total += input.substring(0,4)+".";
			} else if(inputVal.length == 7) {
				total += inputVal.substring(0,7)+".";
			} else if(inputVal.length == 12) {
				total += inputVal.substring(0,14)+"";
			} else {
				total += inputVal;
			}
			if(keydown =='Y') {
				type.value=total;
			}else if(keydown =='N') {
				return total
			}
		}
		return total
	}
}
function delcomma(inputVal, count) {
	var tmp = "";
	for(i=0; i<count; i++) {
		if(inputVal.substring(i,i+1)!='.') {		// ���� substring�� ����
			tmp += inputVal.substring(i,i+1);	// ���� ��� , �� ����
		}
	}
	return tmp;
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
//�ֹε�Ϲ�ȣ �Է� ������
function checkhyphen_jumin_no(inputVal, type, keydown) {
	main = document.dataForm;
	var chk		= 0;
	var chk2	= 0;
	var chk3	= 0;
	var share	= 0;
	var start	= 0;
	var triple	= 0;
	var end		= 0;
	var total	= "";
	var input	= "";
	input = delhyphen(inputVal, inputVal.length);
	//�� ����Ʈ+�� �� �� Home backsp
	if(event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=36 && event.keyCode!=8) {
		if(inputVal.length == 6){
			total += input.substring(0,6)+"-";
		} else {
			total += inputVal;
		}
		if(keydown =='Y') {
			type.value = total;
		} else if(keydown =='N') {
			return total
		}
	}
	return total
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
//number_format �Լ�
function number_format(number, decimals, dec_point, thousands_sep) {
	number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
	var n = !isFinite(+number) ? 0 : +number,
	prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
	sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
	dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
	s = '',
	toFixedFix = function(n, prec) {
		var k = Math.pow(10, prec);
		return '' + Math.round(n * k) / k;
	};
	// Fix for IE parseFloat(0.55).toFixed(0) = 0;
	s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
	if(s[0].length > 3) {
		s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
	}
	if((s[1] || '').length < prec) {
		s[1] = s[1] || '';
		s[1] += new Array(prec - s[1].length + 1).join('0');
	}
	return s.join(dec);
}
//�����빫 Ű��빫 �α���
function easynomu_login(action_file) {
	frm = document.dataForm;
	frm.mb_id.value = frm.easynomu_id.value;
	frm.mb_password.value = frm.easynomu_pw.value;
	//alert(frm.mb_id.value);
	frm.action = action_file;
	frm.target = "_blank";
	frm.submit();
	return;
}
//]]>
</script>
<?
include "inc/top.php";
?>
		<td onmouseover="showM('900')">
			<div style="margin:10px 20px 20px 20px;min-height:480px;">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="100"><img src="images/top18.gif" border="0"></td>
						<td width="130"><a href="client_construction_list.php"><img src="images/top18_03.gif" border="0"></a></td>
						<td></td>
					</tr>
					<tr><td height="1" bgcolor="#cccccc" colspan="9"></td></tr>
				</table>
				<table width="<?=$content_width?>" border="0" align="left" cellpadding="0" cellspacing="0" >
					<tr>
						<td valign="top" style="padding:10px 0 0 0">
							<!--Ÿ��Ʋ -->	
<?
$samu_list = "";
$report = "ok";
include "inc/client_basic_info.php";
?>
									<div style="height:10px;font-size:0px;line-height:0px;"></div>
								</div><!--����Ʈ ���� DIV ����-->
								<!--�Ǹ޴� -->
<?
//���� �� �޴� ��ȣ
$tab_onoff_this = 7;
//���α׷� ����
$tab_program_url = 3;
include "inc/tab_menu.php";
?>
								<div id="tab1" style="display:none">
									<!--�� 1������-->
								</div>
								<div id="tab2" >
									<!--�� 2������-->
									<a name="50001"><!--�빫�������α׷�--></a>
									<table border=0 cellspacing=0 cellpadding=0 style=""> 
										<tr>
											<td id=""> 
												<table border=0 cellpadding=0 cellspacing=0> 
													<tr> 
														<td><img src="images/g_tab_on_lt.gif"></td> 
														<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
															�빫�������α׷�
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
											<td nowrap class="tdrowk" width="110"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">ó����Ȳ<font color="red">*</font></td>
											<td nowrap class="tdrow" width="110">
<?
$easynomu_process = $row2['easynomu_process'];
$easynomu_process_array = array("","���ʼ�����","�޿�������","�Ϸ�","����","����","���ϼ�����û");
if($member['mb_level'] != 6) {
?>
												<select name="easynomu_process" class="selectfm" onchange="input_today_easynomu(this,'easynomu_finish_date','easynomu_close_date')">
													<option value=""  <? if($easynomu_process == "")  echo "selected"; ?>>����</option>
													<option value="1" <? if($easynomu_process == "1") echo "selected"; ?>>���ʼ�����</option>
													<option value="2" <? if($easynomu_process == "2") echo "selected"; ?>>�޿�������</option>
													<option value="3" <? if($easynomu_process == "3") echo "selected"; ?>>�Ϸ�</option>
													<option value="4" <? if($easynomu_process == "4") echo "selected"; ?>>����</option>
													<option value="5" <? if($easynomu_process == "5") echo "selected"; ?>>����</option>
													<option value="6" <? if($easynomu_process == "6") echo "selected"; ?>>���ϼ�����û</option>
												</select>
<?
} else {
	echo $easynomu_process_array[$easynomu_process];
}
?>
											</td>
											<td nowrap class="tdrowk" width="90"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���ÿϷ���</td>
											<td nowrap  class="tdrow" width="96">
<?
if($member['mb_level'] != 6) {
?>
												<input name="easynomu_finish_date" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row2['easynomu_finish_date']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')" />
<?
} else {
	echo $row2['easynomu_finish_date'];
}
?>
											</td>
											<td nowrap class="tdrowk" width="64"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">������</td>
											<td nowrap  class="tdrow" width="96">
<?
if($member['mb_level'] != 6) {
?>
												<input name="service_day_start" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row['service_day_start']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')" />
<?
} else {
	echo $row['service_day_start'];
}
?>
											</td>
											<td nowrap class="tdrowk" width="64"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">������</td>
											<td nowrap  class="tdrow" width="104">
<?
if($member['mb_level'] != 6) {
?>
												<input name="service_day_end" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row['service_day_end']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')" />
<?
} else {
	echo $row['service_day_end'];
}
?>
											</td>
											<td nowrap class="tdrowk" width="70"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">������</td>
											<td nowrap  class="tdrow">
<?
if($member['mb_level'] != 6) {
?>
												<input name="easynomu_close_date" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row2['easynomu_close_date']?>" maxlength="10" onKeyPress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')" />
<?
} else {
	echo $row2['easynomu_close_date'];
}
?>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���ú�</td>
											<td nowrap  class="tdrow">
<?
if($row['setting_pay']) $setting_pay = number_format($row['setting_pay']);
if($member['mb_level'] != 6) {
?>
												<input name="setting_pay" type="text" class="textfm" style="width:80px;ime-mode:disabled;" onkeyup="checkThousand(this.value, this,'Y')" value="<?=$setting_pay?>" maxlength="20" />
<?
} else {
	echo $setting_pay;
}
?>
											</td>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">������</td>
											<td nowrap  class="tdrow" colspan="">
<?
if($row['setting_pay']) $setting_pay = number_format($row['setting_pay']);
else $setting_pay = "";
if($row['month_pay']) $month_pay = number_format($row['month_pay']);
else $month_pay = "";
if($member['mb_level'] != 6) {
?>
												<input name="month_pay" type="text" class="textfm" style="width:80px;ime-mode:disabled;" onkeyup="checkThousand(this.value, this,'Y')" value="<?=$month_pay?>" maxlength="20" />
<?
} else {
	echo $month_pay;
}
?>
											</td>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">������</td>
											<td nowrap  class="tdrow">
<?
if($member['mb_level'] != 6) {
	if($row['settlement_day_last'] == 1) $settlement_day_last_checked = "checked";
?>
												<input name="settlement_day" type="text" class="textfm" style="width:30px;ime-mode:disabled;" value="<?=$row['settlement_day']?>" maxlength="2" onkeypress="only_number()" />
												<input type="checkbox" name="settlement_day_last" value="1" <?=$settlement_day_last_checked?> style="vertical-align:middle;" onclick="settlement_day_last_chk(this)" />����
<?
} else {
	if($row['settlement_day'] == "" || $row['settlement_day'] == 0) $settlement_day = "����";
	else $settlement_day = $row['settlement_day']."��";
	if($row['settlement_day_last'] != 1)	{
?>
												<?=$settlement_day?>
<?
	} else {
		echo "����";
	}
}
?>
												<input type='hidden' name='old_settlement_day' value='<?=$row['settlement_day']?>' />
												<input type='hidden' name='old_settlement_day_last' value='<?=$row['settlement_day_last']?>' />
											</td>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���̵�</td>
											<td nowrap  class="tdrow">
												<input name="easynomu_id" type="text" class="textfm" style="width:90px;ime-mode:disabled;" value="<?=$row['easynomu_id']?>" maxlength="16" />
											</td>
											<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��й�ȣ</td>
											<td nowrap  class="tdrow">
												<input name="easynomu_pw" type="text" class="textfm" style="width:90px;ime-mode:disabled;" value="<?=$row['easynomu_pw']?>" maxlength="16" />
												<input name="mb_id" type="hidden" /><input name="mb_password" type="hidden" />
												<a href="http://labor.easynomu.com/labor/login_check.php" onclick="easynomu_login(this.href);return false;" title="�α���"><img src="images/icon_login.png" border="0" style="vertical-align:middle;" /></a>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�޸�</td>
											<td nowrap  class="tdrow" colspan="9">
<?
if($member['mb_level'] != 6) {
?>
												<input name="easynomu_memo" type="text" class="textfm" style="width:100%;ime-mode:active;" value="<?=$row2['easynomu_memo']?>" onkeydown="" />
<?
} else {
	echo $row2['easynomu_memo'];
}
?>
											</td>
										</tr>
									</table>
									<div style="height:10px;font-size:0px;line-height:0px;"></div>
									<!--÷�μ���-->
									<table border=0 cellspacing=0 cellpadding=0> 
										<tr>
											<td id=""> 
												<table border=0 cellpadding=0 cellspacing=0> 
													<tr> 
														<td><img src="images/sb_tab_on_lt.gif"></td> 
														<td background="images/sb_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:140;text-align:center'> 
															÷�μ��� (���� �� ����)
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
											<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0"><b>�⺻����</b></td>
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
										<tr>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0"><b>�����빫 ����</b><font color="red"></font></td>
											<td nowrap  class="tdrow" colspan="3">
<?
if($file_easynomu[0]) echo "�����빫 ��༭. ";
if($file_easynomu[1]) echo "�ٷΰ�༭. ";
if($file_easynomu[2]) echo "�����Ģ üũ����Ʈ. ";
if($file_easynomu[3]) echo "�ֱ�3���� �޿�����. ";
?>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����1
											</td>
											<td   class="tdrow" width="373">
												<a href="files/easynomu/<?=$row['file_easynomu_1']?>" target="_blank"><?=$row['file_easynomu_1']?></a>
											</td>
											<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����2</td>
											<td   class="tdrow" >
												<a href="files/easynomu/<?=$row['file_easynomu_2']?>" target="_blank"><?=$row['file_easynomu_2']?></a>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��Ÿ ����<font color="red"></font></td>
											<td nowrap  class="tdrow" colspan="3">
<?
echo $row['file_etc'];
//�ѱ� ���ϸ� ���ڵ�
$filename_1 = iconv("UTF-8", "EUC-KR", $row['filename_1']);
$filename_2 = iconv("UTF-8", "EUC-KR", $row['filename_2']);
$filename_3 = iconv("UTF-8", "EUC-KR", $row['filename_3']);
$filename_4 = iconv("UTF-8", "EUC-KR", $row['filename_4']);
$filename_5 = iconv("UTF-8", "EUC-KR", $row['filename_5']);
$filename_6 = iconv("UTF-8", "EUC-KR", $row['filename_6']);
$filename_7 = iconv("UTF-8", "EUC-KR", $row['filename_7']);
$filename_8 = iconv("UTF-8", "EUC-KR", $row['filename_8']);
?>
											</td>
										</tr>
									</table>
									<input type="hidden" name="prv_user_id" value="<?=$row['t_insureno']?>" />
									<input type="hidden" name="url" value="%2Flabor%2Fmain.php" />
									<input type="hidden" name="id" value="<?=$id?>" />
									<input type="hidden" name="page" value="<?=$page?>" />
									<input type="hidden" name="qstr" value="<?=$qstr?>" />
									<input type="hidden" name="stx_qstr" value="<?=$stx_qstr?>" />
									<div style="height:20px;font-size:0px"></div>
									<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layput:fixed">
										<tr>
											<td align="center">
<?
//���Ѻ� ��ũ��
//echo $member['mb_level'];
if($member['mb_level'] != 6) {
	$url_save = "javascript:checkData('client_construction_update.php');";
} else {
	$url_save = "javascript:alert_no_right();";
}
//��� ��ũ
$list_url = "./client_construction_list.php?page=".$page."&amp;".$qstr."&amp;".$stx_qstr;
//���� ����
if($member['mb_level'] >= 6) {
?>
												<a href="<?=$url_save?>"><img src="images/btn_save_big.png" border="0" alt="����" /></a>
<? } ?>
												<a href="<?=$list_url?>"><img src="images/btn_list_big.png" border="0" alt="���" /></a>
											</td>
										</tr>
									</table>
<?
include "inc/client_comment_only.php";
?>
									<div style="height:20px;font-size:0px"></div>
								</div>
							</form><!--dataForm �� ����-->
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
