<?
$sub_menu = "100100";
include_once("./_common.php");

$now_date = date("Y.m.d");
$sql_common = " from com_list_gy a, com_list_gy_opt b ";

//�˻� �Ķ���� ����
$qstr  = "search_detail=".$search_detail;
$qstr .= "&stx_comp_name=".$stx_comp_name."&stx_t_no=".$stx_t_no."&stx_biz_no=".$stx_biz_no."&stx_boss_name=".$stx_boss_name."&stx_comp_tel=".$stx_comp_tel."&stx_comp_fax=".$stx_comp_fax."&stx_contract=".$stx_contract."&stx_comp_gubun1=".$stx_comp_gubun1."&stx_comp_gubun2=".$stx_comp_gubun2."&stx_comp_gubun3=".$stx_comp_gubun3."&stx_comp_gubun4=".$stx_comp_gubun4."&stx_comp_gubun5=".$stx_comp_gubun5."&stx_comp_gubun6=".$stx_comp_gubun6."&stx_comp_gubun7=".$stx_comp_gubun7."&stx_comp_gubun8=".$stx_comp_gubun8."&stx_comp_gubun9=".$stx_comp_gubun9."&stx_man_cust_name=".$stx_man_cust_name."&stx_man_cust_name2=".$stx_man_cust_name2."&stx_uptae=".$stx_uptae."&stx_upjong=".$stx_upjong."&search_ok=".$search_ok;
$qstr .= "&stx_biz_no_input_not=".$stx_biz_no_input_not."&stx_t_no_input_not=".$stx_t_no_input_not."&stx_samu_receive_no_search=".$stx_samu_receive_no_search."&stx_area1=".$stx_area1."&stx_area2=".$stx_area2."&stx_area3=".$stx_area3."&stx_area4=".$stx_area4."&stx_area5=".$stx_area5."&stx_area6=".$stx_area6."&stx_area7=".$stx_area7."&stx_area8=".$stx_area8."&stx_area9=".$stx_area9."&stx_area10=".$stx_area10."&stx_area11=".$stx_area11."&stx_area12=".$stx_area12."&stx_area13=".$stx_area13."&stx_area14=".$stx_area14."&stx_area15=".$stx_area15."&stx_area16=".$stx_area16."&stx_area17=".$stx_area17."&stx_area_not=".$stx_area_not;
$qstr .= "&stx_addr=".$stx_addr."&stx_addr_first=".$stx_addr_first."&stx_manage_name=".$stx_manage_name."&stx_scount=".$stx_scount."&stx_ecount=".$stx_ecount."&stx_industry1=".$stx_industry1."&stx_industry2=".$stx_industry2."&stx_industry3=".$stx_industry3."&stx_industry4=".$stx_industry4."&stx_industry5=".$stx_industry5."&stx_industry6=".$stx_industry6."&stx_industry7=".$stx_industry7."&stx_industry8=".$stx_industry8."&stx_industry9=".$stx_industry9."&stx_industry10=".$stx_industry10."&stx_industry11=".$stx_industry11."&stx_industry99=".$stx_industry99."&stx_industry_not=".$stx_industry_not;
//�󼼰˻�
$stx_qstr  = "stx_rules_report_if=".$stx_rules_report_if."&stx_retirement_age=".$stx_retirement_age."&stx_new_fund_scale_site=".$stx_new_fund_scale_site."&stx_establish_type=".$stx_establish_type."&stx_refund_request=".$stx_refund_request."&stx_factory_split=".$stx_factory_split."&stx_extend_age=".$stx_extend_age."&stx_easynomu_request=".$stx_easynomu_request;
$stx_qstr .= "&stx_fund_type_industry=".$stx_fund_type_industry."&stx_employment_support=".$stx_employment_support."&stx_establish_proposal_if=".$stx_establish_proposal_if."&stx_multitude=".$stx_multitude."&stx_charge_progress=".$stx_charge_progress."&stx_establish_way=".$stx_establish_way."&stx_sj_if=".$stx_sj_if."&stx_handicapped_employment=".$stx_handicapped_employment;
$stx_qstr .= "&stx_disaster_if=".$stx_disaster_if."&stx_found_if=".$stx_found_if."&stx_subsidy_type_if=".$stx_found_if."&stx_factory_site_1000=".$stx_factory_site_1000."&stx_women_matriarch_if=".$stx_women_matriarch_if."&stx_found_tax=".$stx_found_tax."&stx_disaster_if=".$stx_disaster_if."&stx_job_creation_proposal=".$stx_job_creation_proposal."&stx_rule_pay=".$stx_rule_pay;
$stx_qstr .= "&stx_rural_areas=".$stx_rural_areas."&stx_pay_peak_if=".$stx_pay_peak_if."&stx_career_kind=".$stx_career_kind."&stx_fund_basic_check=".$stx_fund_basic_check."&stx_shift_system=".$stx_shift_system."&stx_local_tax_yn=".$stx_local_tax_yn."&stx_work_contract=".$stx_work_contract."&stx_fund_kind=".$stx_fund_kind."&stx_establish_request=".$stx_establish_request;

//echo $member[mb_profile];
if($is_admin != "super") {
	//echo $member['mb_profile'];
	$stx_man_cust_name = $member['mb_profile'];
}
$is_admin = "super";
//echo $is_admin;
$sql_search = " where a.com_code=b.com_code and a.com_code='$id' ";

if (!$sst) {
    $sst = "a.com_code";
    $sod = "desc";
}

$sql_order = " order by $sst $sod ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";

//echo $sql;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = 20;
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���

if (!$page) $page = 1; // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����

$listall = "<a href='$_SERVER[PHP_SELF]' class=tt>ó��</a>";

$sub_title = "�ŷ�ó����(��)";
$g4[title] = $sub_title." : �ŷ�ó : ".$easynomu_name;

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
	$top_sub_title = "images/top01_01.gif";
} else {
	$top_sub_title = "images/top01_00.gif";
}
//�޸�
$memo = $row['memo'];
$memo1 = $row['memo1'];
$memo2 = $row['memo2'];
$memo3 = $row['memo3'];
$memo4 = $row['memo4'];
$memo5 = $row['memo5'];
//�繫��Ź����
$samu_req_yn = $row['samu_req_yn'];
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
function checkID() {
	var frm = document.dataForm;
	if (frm.comp_bznb.value == "")
	{
		alert("����ڹ�ȣ�� �Է��ϼ���.");
		frm.comp_bznb.focus();
		return;
	}
	var ret = window.open("./common/member_idcheck.php?user_id="+frm.comp_bznb.value, "id_check", "top=100, left=100, width=395,height=240");
	return;
}
function member_form() {
	var frm = document.dataForm;
	if (frm.firm_name.value == "")
	{
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
/*
	if (frm.user_id.value == "")
	{
		alert("���̵� �Է��ϼ���.");
		frm.user_id.focus();
		return;
	}
*/
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
	if (frm.firm_name.value == "") {
		alert("�������� �Է��ϼ���.");
		frm.firm_name.focus();
		return;
	}
	//alert(frm.comp_type.value);
	//alert(radio_chk(frm.comp_type, '����ڱ�����'));
	if(radio_chk(frm.comp_type, "����ڱ�����") == 0) {
		frm.comp_type[0].focus();
		return;
	}
	if (frm.comp_bznb.value == "") {
		alert("����ڹ�ȣ�� �Է��ϼ���.");
		frm.comp_bznb.focus();
		return;
	}
	if(frm.rst_chk.value == "y") {
		alert("�̹� ��ϵ� ����ڹ�ȣ�Դϴ�. Ȯ�� �� ��� �ٶ��ϴ�.");
		frm.comp_bznb.focus();
		return;
	}
	if (frm.uptae.value == "") {
		alert("���¸� �Է��ϼ���.");
		frm.uptae.focus();
		return;
	}
/*
	if (frm.user_id.value == "") {
		alert("���̵� �Է��ϼ���.");
		frm.user_id.focus();
		return;
	}
	if (frm.upjong_code.value == "") {
		alert("������ �Է��ϼ���.");
		frm.upjong_code.focus();
		return;
	}
	if (frm.upjong.value == "") {
		alert("������ �Է��ϼ���.");
		frm.upjong.focus();
		return;
	}
*/
	if (frm.cust_name.value == "") {
		alert("��ǥ�ڸ� �Է��ϼ���.");
		frm.cust_name.focus();
		return;
	}
	if (frm.cust_tel1.value == "") {
		alert("��ȭ��ȣ(��)�� �Է��ϼ���.");
		frm.cust_tel1.focus();
		return;
	}
	if (frm.cust_tel2.value == "") {
		alert("��ȭ��ȣ(�߾�)�� �Է��ϼ���.");
		frm.cust_tel2.focus();
		return;
	}
	if (frm.cust_tel3.value == "") {
		alert("��ȭ��ȣ(��)�� �Է��ϼ���.");
		frm.cust_tel3.focus();
		return;
	}
	if (frm.cust_fax1.value == "") {
		alert("�ѽ���ȣ(��)�� �Է��ϼ���.");
		frm.cust_fax1.focus();
		return;
	}
	if (frm.cust_fax2.value == "") {
		alert("�ѽ���ȣ(�߾�)�� �Է��ϼ���.");
		frm.cust_fax2.focus();
		return;
	}
	if (frm.cust_fax3.value == "") {
		alert("�ѽ���ȣ(��)�� �Է��ϼ���.");
		frm.cust_fax3.focus();
		return;
	}
	if (frm.damdang_name.value == "") {
		alert("����ڸ��� �Է��ϼ���.");
		frm.damdang_name.focus();
		return;
	}
	if (frm.new_zip.value == "") {
		alert("�ּҸ� �Է��ϼ���.");
		return;
	}
	if (frm.cust_email.value == "") {
		alert("�̸��ϸ� �Է��ϼ���.");
		frm.cust_email.focus();
		return;
	}
<?
if($stx_man_cust_name < 100) {
?>
	if(frm.job_request_if.checked) {
		if(frm.job_hrd_id.value == "") {
			alert("HRD���̵� �Է��ϼ���.");
			frm.job_hrd_id.focus();
			return;
		}
		if(!frm.job_file_check1.checked) {
			alert("üũ����Ʈ�� ����ϼ���.");
			frm.job_file_check1.focus();
			return;
		}
	}
<?
}
?>
	//���� ����ȣ �ߺ� üũ 160406
	if(frm.rst_chk_electric_no.value == "y") {
		alert("�̹� ��ϵ� ����ȣ�Դϴ�. Ȯ�� �� ��� �ٶ��ϴ�.");
		frm.electric_charges_no.focus();
		return;
	}
	getId('btn_save').style.display = "none";
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
	if(count == 0){
		alert(t+" ������ �ּ���.");
		return rv = 0;
	}else{
		//alert(radio_name_val);
		return rv = 1;
	}
}
//���� �ŷ�ó (������)
function del_com(page, id) {
	if(confirm("���� �Ͻðڽ��ϱ�?")) {
		location.href = "client_delete_com.php?page="+page+"&id="+id;
	}
}
//������û
function del_request(page, id) {
	if(confirm("������û �Ͻðڽ��ϱ�?")) {
		location.href = "client_delete_request.php?page="+page+"&id="+id;
	}
}
function goSearch() {
	var frm = document.searchForm;
	frm.action = "<?=$PHP_SELF?>";
	frm.submit();
	return;
}
function only_number() {
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
			//hyphen 109 , ������(F9 �ϴ�) 189 , del 46 , backsp 8 , left 37 , right 39 , tab 9 , shift 16
			if(event.keyCode != 109 && event.keyCode != 189 && event.keyCode != 46 && event.keyCode != 8 && event.keyCode != 37 && event.keyCode != 39 && event.keyCode != 9 && event.keyCode != 16) {
				event.preventDefault ? event.preventDefault() : event.returnValue = false;
			}
		}
	}
}
function only_number_comma() {
	//alert(event.keyCode);
	if (event.keyCode < 48 || event.keyCode > 57) {
		if (event.keyCode < 95 || event.keyCode > 105) {
			//comma 110 , del 46 , backsp 8 , left 37 , right 39 , tab 9 , shift 16
			if(event.keyCode != 110 && event.keyCode != 46 && event.keyCode != 8 && event.keyCode != 37 && event.keyCode != 39 && event.keyCode != 9 && event.keyCode != 16) {
				event.preventDefault ? event.preventDefault() : event.returnValue = false;
			}
		}
	}
}
</script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/lang/calendar-ko.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
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
function delhyphen(inputVal, count) {
	var tmp = "";
	for(i=0; i<count; i++){
		if(inputVal.substring(i,i+1)!='-') {		// ���� substring�� ����
			tmp += inputVal.substring(i,i+1);	// ���� ��� , �� ����
		}
	}
	return tmp;
}
//����/������
function only_number_english() {
	if (event.keyCode < 48 || (event.keyCode > 57 && event.keyCode < 97) || (event.keyCode > 122)) event.preventDefault ? event.preventDefault() : event.returnValue = false;
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
				return total;
			}
		}
		return total;
	}
}
function delcomma(inputVal, count) {
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
			if(inputVal.length == 6) {
				//input = delhyphen(inputVal, inputVal.length);
				total += input.substring(0,6)+"-";
			} else {
				total += inputVal;
			}
			if(keydown =='Y') {
				if ( type =='1' ) {
					main.bupin_no.value=total;					// type �� ���� �������� �־� �ش�.
				}
				else if ( type =='2' ) {
					main.cust_ssnb.value=total;					// type �� ���� �������� �־� �ش�.
				}
			}else if(keydown =='N') {
				return total;
			}
		}
		return total;
	}
}
//�ֹε�Ϲ�ȣ �Է� ������
function checkhyphen_ssnb(inputVal, type) {
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
		if(inputVal.length == 6) {
			total += input.substring(0,6)+"-";
		} else {
			total += inputVal;
		}
		type.value = total;
	}
	return total;
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
			return total;
		}
		return total;
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
	var v3 = document.getElementById(div_id+'3');
	var v4 = document.getElementById(div_id+'4');
	if(v2.style.display == "none") {
		v2.style.display = "";
	} else {
		if(v3.style.display == "none") {
			v3.style.display = "";
		} else {
			if(v4.style.display == "none") {
				v4.style.display = "";
			} else {
				alert("�ִ� 8������ �߰� �����մϴ�.");
			}
		}
	}
}
//���
function pagePrint(Obj, orientation_var) {  
  var W = Obj.offsetWidth + 40;        //screen.availWidth;  
  var H = Obj.offsetHeight + 50;       //screen.availHeight; 
 
  var features = "menubar=no,toolbar=no,location=no,directories=no,status=no,scrollbars=yes,resizable=yes,width=" + W + ",height=" + H + ",left=0,top=0";  
  var PrintPage = window.open("about:blank",Obj.id,features);  
 
	var iepage_script = "<style type='text/css'>\n@media print{ \n#noPrint1{display: none;} \n} \n</style> \n<script language='javascript' type='text/javascript'> \nfunction Installed() \n{ \ntry \n{ \nreturn (new ActiveXObject('IEPageSetupX.IEPageSetup')); \n} \ncatch (e) \n{ \nreturn false; \n} \n} \nfunction PrintTest() \n{ \nif (!Installed()) \nalert('��Ʈ���� ��ġ���� �ʾҽ��ϴ�. ���������� �μ���� ���� �� �ֽ��ϴ�.') \nelse \nalert('���������� ��ġ�Ǿ����ϴ�.'); \n} \nfunction printsetup()\n{ \nIEPageSetupX.header = '';\nIEPageSetupX.footer = '';\nIEPageSetupX.leftMargin = 10;\nIEPageSetupX.rightMargin = 10;\nIEPageSetupX.topMargin = 20;\nIEPageSetupX.bottomMargin = 10;\nIEPageSetupX.PrintBackground = true;\nIEPageSetupX.Orientation = 0;\nIEPageSetupX.PaperSize = 'A4';\n</sc"+"ript>";
	var iepage_object = "<script language='JavaScript' for='IEPageSetupX' event='OnError(ErrCode, ErrMsg)'>\nalert('���� �ڵ�: ' + ErrCode + '\n���� �޽���: ' + ErrMsg);\n</sc"+"ript>\n<object id=IEPageSetupX classid='clsid:41C5BC45-1BE8-42C5-AD9F-495D6C8D7586' codebase='/IEPageSetupX/IEPageSetupX.cab#version=1,4,0,3' width=0 height=0>\n<param name='copyright' value='http://isulnara.com'>\n<div style='position:absolute;top:276;left:320;width:300;height:68;border:solid 1 #99B3A0;background:#D8D7C4;overflow:hidden;z-index:1;visibility:visible;'><FONT style='font-family: '����', 'Verdana'; font-size: 9pt; font-style: normal;'>\n<BR>  �μ� �������� ��Ʈ���� ��ġ���� �ʾҽ��ϴ�.  <BR>  <a href='/IEPageSetupX/IEPageSetupX.exe'><font color=red>�̰�</font></a>�� Ŭ���Ͽ� �������� ��ġ�Ͻñ� �ٶ��ϴ�.  </FONT>\n</div>\n</object>";

  PrintPage.document.open();  
  PrintPage.document.write("<html><head><title></title><link rel='stylesheet' type='text/css' href='css/style.css'>\n<link rel='stylesheet' type='text/css' href='css/style_admin.css'>\n</head>\n<body style='margin:0'>\n<div style='text-align:center;'>\n"+iepage_script+"\n"+iepage_object+"\n<div style='width:1004px;margin:0 auto;'>\n" + Obj.innerHTML + "\n</div>\n</div>\n</body></html>");
  PrintPage.document.close();  
  PrintPage.document.title = document.domain;
	// �������
	PrintPage.IEPageSetupX.Orientation = orientation_var;
	// �μ�̸�����
	PrintPage.IEPageSetupX.Preview();
  //PrintPage.print(PrintPage.location.reload());
}
function Installed() {
	try { 
		return (new ActiveXObject('IEPageSetupX.IEPageSetup')); 
	} catch (e) { 
		return false; 
	} 
} 
function PrintTest() {
	if(!Installed()) alert("��Ʈ���� ��ġ���� �ʾҽ��ϴ�. ���������� �μ���� ���� �� �ֽ��ϴ�.") 
	else alert("���������� ��ġ�Ǿ����ϴ�."); 
}
function printsetup() {
	IEPageSetupX.header = ""; // ������� 
	IEPageSetupX.footer = ""; // Ǫ�ͼ��� 
	IEPageSetupX.leftMargin = 10; // ���ʿ��鼳�� 
	IEPageSetupX.rightMargin = 10; // �����ʿ��� ���� 
	IEPageSetupX.topMargin = 20; // ���ʿ��� ���� 
	IEPageSetupX.bottomMargin = 10; // �Ʒ��� ���鼳�� 
	IEPageSetupX.PrintBackground = true; // ���� �� �̹��� �μ� 
	IEPageSetupX.Orientation = 1; // ���� ����� ���Ͻø� 0�� ������ �˴ϴ�. ��������� 1�Դϴ�. 
	IEPageSetupX.PaperSize = 'A4'; // ���������Դϴ�. 
}
//������������ ���� ����ȣ �ߺ� Ȯ�� 160406
function getCont_electric_no( id, code ) {
	var frm = document.dataForm;
	var xmlhttp = fncGetXMLHttpRequest();
	xmlhttp.open('POST', 'ajax_check_electric_no_confirm.php?id='+id+'&code='+code, false);
	xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=euc-kr');
	xmlhttp.onreadystatechange = function () {
		if(xmlhttp.readyState=='4' && xmlhttp.status==200) {
			if(xmlhttp.status==500 || xmlhttp.status==404 || xmlhttp.status==403)	alert("������ ���� : "+xmlhttp.status);
			else {
				var dp  = document.getElementById('rst_electric_no');
				if(xmlhttp.responseText=='Y') {
					dp.innerHTML = "�̹� ��ϵ� ����ȣ�Դϴ�.(���繮�ǿ��)";
					frm.rst_chk_electric_no.value = "y";
				} else {
					dp.innerHTML = "";
					frm.rst_chk_electric_no.value = "";
				}
			}
		}
	}
	xmlhttp.send();
}
</script>
<style type="text/css"> 
@media print{ 
	#noPrint1{display: none;} 
} 
</style>
<?
include "inc/top.php";
$url_list = "./client_list.php?page=".$page."&".$qstr;
?>
		<td onmouseover="showM('900')" style="vertical-align:top;">
			<div style="margin:10px 20px 20px 20px;min-height:480px;">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="100"><img src="images/top01.gif" border="0"></td>
						<td width="130"><a href="<?=$url_list?>"><img src="<?=$top_sub_title?>" border="0" /></a></td>
						<td>
<?
$title_main_no = "01";
include "inc/sub_menu.php";
?>
						</td>
					</tr>
					<tr><td height="1" bgcolor="#cccccc" colspan="3"></td></tr>
				</table>

				<table width="<?=$content_width?>" border="0" align="left" cellpadding="0" cellspacing="0" >
					<tr>
						<td valign="top" style="padding:10px 0 0 0">
							<!--Ÿ��Ʋ -->
			<!--�μ⿵��-->
			<div id="print_div">
<?
$samu_list = "";
if($v != "write") {
	$report = "ok";
}
if($w != "u") {
	$report = "";
	$v = "write";
}
include "inc/client_basic_info.php";
?>
									<div style="height:10px;font-size:0px"></div>
								</div>
<?
$mb_profile_code = $member['mb_profile'];
//echo $row['damdang_code']." == ".$mb_profile_code." ".$member['mb_level'];
if(!$w || $row['damdang_code'] == $mb_profile_code || $row['damdang_code2'] == $mb_profile_code || $member['mb_level'] >= 9) $is_damdang = "ok";
//���Ѻ� ��ũ��
//echo $member['mb_level'];
if($member['mb_level'] >= 5) {
	if($member['mb_level'] <= 6) $url_save = "javascript:checkData('client_update_branch.php');";
	else $url_save = "javascript:checkData('client_update.php');";
	$url_modify = $_SERVER['PHP_SELF']."?w=u&v=write&id=".$com_code."&page=".$page."&".$qstr."&".$stx_qstr;
	$url_print = "javascript:pagePrint(document.getElementById('print_page'), '0')";
	$url_print_request = "javascript:pagePrint(document.getElementById('print_div'), '0')";
} else {
	$url_save = "javascript:alert_no_right();";
}
//������ ��� ǥ��
if($w) {
	//���� �� �޴� ��ȣ
	$tab_onoff_this = 1;
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
	//����ó����Ȳ
	include "inc/client_basic_admin.php";
}
?>
				<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layput:fixed">
					<tr>
						<td align="center">
<?
if($v == "write") {
?>
							<table border="0" cellpadding="0" cellspacing="0" style="display:inline;" id="btn_save"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="<?=$url_save?>" target="">�� ��</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table>
<?
} else {
?>
							<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="<?=$url_modify?>" target="">�� ��</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
							<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./client_list.php?search_ok=branch&page=<?=$page?>&<?=$qstr?>&<?=$stx_qstr?>" target="">�� ��</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
							<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="<?=$url_print_request?>" target="">�Ƿڼ����</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
<?
if($w == "u") {
	//���� ���� : �ְ������, �ӿ���
	if($member['mb_level'] == 10 || $member['mb_id'] == "kcmc0331") {
?>
							<table border="0" cellpadding="0" cellspacing="0" style="display:inline;cursor:pointer;" onclick="del_com('<?=$page?>', '<?=$id?>');"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" style="padding-top:3px;letter-spacing:-1px;" nowrap>����</td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
<? } else { ?>
							<table border="0" cellpadding="0" cellspacing="0" style="display:inline;cursor:pointer;" onclick="del_request('<?=$page?>', '<?=$id?>');"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" style="padding-top:3px;letter-spacing:-1px;" nowrap>������û</td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
<? } ?>
							<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./client_process_view.php?w=<?=$w?>&id=<?=$id?>" target="">����ó����Ȳ</a></td><td><img src=images/btn_rt.gif></td><td width="2"></td></tr></table>
<? } ?>
<?
	//�������� �Ƿ� ���� ����
	if($row['job_request_if']) {
		$sql_job = " select idx from job_education where com_code='$id' ";
		$result_job = sql_query($sql_job);
		$row_job=mysql_fetch_array($result_job);
		$idx = $row_job['idx'];
?>
							<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./job_education_view.php?w=<?=$w?>&id=<?=$idx?>" target="">������Ʒ�</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>

<?
	}
?>
						</td>
					</tr>
				</table>
				<div style="height:10px;font-size:0px"></div>
<?
//�űԵ�� �� ǥ��
if(!$w) {
?>
								<!--�Ǹ޴�-->
								<table border="0" cellspacing="0" cellpadding="0"> 
									<tr> 
										<td id="Tab_cust_tab_05"> 
											<a href="#17001"><img src="./images/tab05_on.gif" border="0" id="tab_img5" /></a>
										</td> 
										<td width="2"></td> 
										<td id="Tab_cust_tab_06"> 
											<a href="#19001"><img src="./images/tab06_on.gif" border="0" id="tab_img6" /></a>
										</td>
										<td width="2"></td> 
										<td id="Tab_cust_tab_07"> 
											<a href="#20001"><img src="./images/tab07_on.gif" border="0" id="tab_img7" alt="������������" /></a>
										</td>
										<td width="2"></td> 
										<td id="Tab_cust_tab_03"> 
											<a href="#11001"><img src="./images/tab01_on.gif" border="0" id="tab_img1" /></a>
										</td>
										<td width="2"></td> 
										<td id="Tab_cust_tab_04"> 
											<a href="#16001"><img src="./images/tab03_on.gif" border="0" id="tab_img3" /></a>
										</td>
										<td width="10"></td> 
										<td>
										</td>
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bgtr_tab"></div>
								<div style="height:10px;font-size:0px;line-height:0px;"></div>
								<div style="margin-bottom:10px;width:100%;text-align:left;<? if(!$w) echo "display:none;"; ?>">
									�� ������ : <?=$row['com_name']?> &nbsp; �� ����ڵ�Ϲ�ȣ : <?=$row['biz_no']?> &nbsp; �� ��ǥ�� : <?=$row['boss_name']?>
									&nbsp; �� ��ȭ��ȣ : <?=$row['com_tel']?>
								</div>
<?
}
?>
								<div id="tab1">
<?
//���� �������� ��ȯ
if($w == "u" && $v != "write") $is_damdang = "";
//����, ������ ���� ���� 161109
if($v == "write" && ($member['mb_profile'] == 1 || $member['mb_id'] == "master")) $is_damdang = "ok";
?>
									<!--÷�μ���-->
									<table border="0" cellspacing="0" cellpadding="0"> 
										<tr>
											<td id=""> 
												<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='filename_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer;">
													<tr> 
														<td><img src="images/sb_tab_on_lt.gif" /></td> 
														<td background="images/sb_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
															÷�μ���
														</td> 
														<td><img src="images/sb_tab_on_rt.gif" /></td> 
													</tr> 
												</table> 
											</td> 
											<td width=6></td> 
											<td valign="middle"></td> 
										</tr> 
									</table>
									<div style="height:2px;font-size:0px" class="bbtr"></div>
									<div style="height:2px;font-size:0px;line-height:0px;"></div>
									<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" id="filename_div" style="<? if($w && ($row['file_check']==',,,,,,,,,,' || !$row['file_check']) && ($row['file_easynomu']==',,,,' || !$row['file_easynomu']) && !$row['filename_1'] && !$row['filename_2'] && !$row['filename_3'] && !$row['filename_4'] && !$row['filename_5'] && !$row['filename_6'] && !$row['filename_7'] && !$row['filename_8'] && !$row['file_easynomu_1'] && !$row['file_easynomu_2'] && !$row['file_etc']) echo "display:none"; ?>">
										<tr>
											<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0"><b>�⺻����</b><font color="red"></font></td>
											<td class="tdrow" colspan="3">
<?
$file_check = explode(',',$row['file_check']);
$file_easynomu = explode(',',$row['file_easynomu']);
if($is_damdang == "ok") {
?>
												<input type="checkbox" name="file_check1" value="1" <? if($file_check[0] == 1) echo "checked"; ?> style="vertical-align:middle">�������Ƿڼ�
												<input type="checkbox" name="file_check2" value="1" <? if($file_check[1] == 1) echo "checked"; ?> style="vertical-align:middle">��༭
												<input type="checkbox" name="file_check3" value="1" <? if($file_check[2] == 1) echo "checked"; ?> style="vertical-align:middle">�繫��Ź��
												<input type="checkbox" name="file_check4" value="1" <? if($file_check[3] == 1) echo "checked"; ?> style="vertical-align:middle">�븮�μ���
												<input type="checkbox" name="file_check5" value="1" <? if($file_check[4] == 1) echo "checked"; ?> style="vertical-align:middle">���ڹο�
												<input type="checkbox" name="file_check6" value="1" <? if($file_check[5] == 1) echo "checked"; ?> style="vertical-align:middle">����ڵ����
												<input type="checkbox" name="file_check7" value="1" <? if($file_check[6] == 1) echo "checked"; ?> style="vertical-align:middle">����纻
												<input type="checkbox" name="file_check8" value="1" <? if($file_check[7] == 1) echo "checked"; ?> style="vertical-align:middle">���/��Ǹ���Ʈ
												<input type="checkbox" name="file_check9" value="1" <? if($file_check[8] == 1) echo "checked"; ?> style="vertical-align:middle">�ð�������
												<input type="checkbox" name="file_check10" value="1" <? if($file_check[9] == 1) echo "checked"; ?> style="vertical-align:middle">��å�ڱ��Ƿڼ�
												<input type="checkbox" name="file_check11" value="1" <? if($file_check[10] == 1) echo "checked"; ?> style="vertical-align:middle">�������������
												<input type="checkbox" name="file_check12" value="1" <? if($file_check[11] == 1) echo "checked"; ?> style="vertical-align:middle">��ü�η�������
<?
} else {
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
	if($file_check[10]) echo "�������������. ";
	if($file_check[11]) echo "��ü�η�������. ";
}
?>
											</td>
										</tr>
										<tr>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����1 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_del_1" value="1" style="vertical-align:middle">����<? } ?>
<?
if($is_damdang == "ok") {
?>
												<div style="margin:4px 0 0 0">
													<img src="./images/icon_blank.gif" width="2" height="2" style="margin:0 5px 3px 0"><a href="javascript:field_add('file_tr');"><img src="images/btn_add.png" border="0" style="vertical-align:middle"> <span  style="">�߰�</span></a>
												</div>
<?
}
?>
							</td>
							<td   class="tdrow" width="373">
								<? if($is_damdang == "ok") { ?><input name="filename_1" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br /><? } ?>
								<a href="files/contract/<?=$row['filename_1']?>" target="_blank"><?=$row['filename_1']?></a>
								<input type="hidden" name="file_1" value="<?=$row['filename_1']?>">
							</td>
							<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����2 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_del_2" value="1" style="vertical-align:middle">����<? } ?></td>
							<td   class="tdrow" >
								<? if($is_damdang == "ok") { ?><input name="filename_2" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br /><? } ?>
								<a href="files/contract/<?=$row['filename_2']?>" target="_blank"><?=$row['filename_2']?></a>
								<input type="hidden" name="file_2" value="<?=$row['filename_2']?>">
							</td>
						</tr>
						<tr id="file_tr2" style="<? if(!$row['filename_3'] && !$row['filename_4']) echo "display:none"; ?>">
							<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����3 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_del_3" value="1" style="vertical-align:middle">����<? } ?></td>
							<td   class="tdrow" >
								<? if($is_damdang == "ok") { ?><input name="filename_3" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br /><? } ?>
								<a href="files/contract/<?=$row['filename_3']?>" target="_blank"><?=$row['filename_3']?></a>
								<input type="hidden" name="file_3" value="<?=$row['filename_3']?>">
							</td>
							<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����4 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_del_4" value="1" style="vertical-align:middle">����<? } ?></td>
							<td   class="tdrow" >
								<? if($is_damdang == "ok") { ?><input name="filename_4" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br /><? } ?>
								<a href="files/contract/<?=$row['filename_4']?>" target="_blank"><?=$row['filename_4']?></a>
								<input type="hidden" name="file_4" value="<?=$row['filename_4']?>">
							</td>
						</tr>
						<tr id="file_tr3" style="<? if(!$row['filename_5'] && !$row['filename_6']) echo "display:none"; ?>">
							<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����5 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_del_5" value="1" style="vertical-align:middle">����<? } ?></td>
							<td   class="tdrow" >
								<? if($is_damdang == "ok") { ?><input name="filename_5" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br /><? } ?>
								<a href="files/contract/<?=$row['filename_5']?>" target="_blank"><?=$row['filename_5']?></a>
								<input type="hidden" name="file_5" value="<?=$row['filename_5']?>">
							</td>
							<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����6 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_del_6" value="1" style="vertical-align:middle">����<? } ?></td>
							<td   class="tdrow" >
								<? if($is_damdang == "ok") { ?><input name="filename_6" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br /><? } ?>
								<a href="files/contract/<?=$row['filename_6']?>" target="_blank"><?=$row['filename_6']?></a>
								<input type="hidden" name="file_6" value="<?=$row['filename_6']?>">
							</td>
						</tr>
						<tr id="file_tr4" style="<? if(!$row['filename_7'] && !$row['filename_8']) echo "display:none"; ?>">
							<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����7 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_del_7" value="1" style="vertical-align:middle">����<? } ?></td>
							<td   class="tdrow" >
								<? if($is_damdang == "ok") { ?><input name="filename_7" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br /><? } ?>
								<a href="files/contract/<?=$row['filename_7']?>" target="_blank"><?=$row['filename_7']?></a>
								<input type="hidden" name="file_7" value="<?=$row['filename_7']?>">
							</td>
							<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����8 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_del_8" value="1" style="vertical-align:middle">����<? } ?></td>
							<td   class="tdrow" >
								<? if($is_damdang == "ok") { ?><input name="filename_8" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br /><? } ?>
								<a href="files/contract/<?=$row['filename_8']?>" target="_blank"><?=$row['filename_8']?></a>
								<input type="hidden" name="file_8" value="<?=$row['filename_8']?>">
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0"><b>�����빫 ����</b><font color="red"></font></td>
							<td nowrap  class="tdrow" colspan="3">
<?
if($is_damdang == "ok") {
?>
								<input type="checkbox" name="file_easynomu1" value="1" <? if($file_easynomu[0] == 1) echo "checked"; ?> style="vertical-align:middle">�����빫 ��༭
								<input type="checkbox" name="file_easynomu2" value="1" <? if($file_easynomu[1] == 1) echo "checked"; ?> style="vertical-align:middle">�ٷΰ�༭
								<input type="checkbox" name="file_easynomu3" value="1" <? if($file_easynomu[2] == 1) echo "checked"; ?> style="vertical-align:middle">�����Ģ üũ����Ʈ
								<input type="checkbox" name="file_easynomu4" value="1" <? if($file_easynomu[3] == 1) echo "checked"; ?> style="vertical-align:middle">�ֱ�3���� �޿�����
<?
} else {
	if($file_easynomu[0]) echo "�����빫 ��༭. ";
	if($file_easynomu[1]) echo "�ٷΰ�༭. ";
	if($file_easynomu[2]) echo "�����Ģ üũ����Ʈ. ";
	if($file_easynomu[3]) echo "�ֱ�3���� �޿�����. ";
}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����1 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_easynomu_del_1" value="1" style="vertical-align:middle">����<? } ?>
							</td>
							<td   class="tdrow" width="373">
								<? if($is_damdang == "ok") { ?><input name="file_easynomu_1" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
								<a href="files/easynomu/<?=$row['file_easynomu_1']?>" target="_blank"><?=$row['file_easynomu_1']?></a>
								<input type="hidden" name="feasynomu_1" value="<?=$row['file_easynomu1']?>">
							</td>
							<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����2 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_easynomu_del_2" value="1" style="vertical-align:middle">����<? } ?></td>
							<td   class="tdrow" >
								<? if($is_damdang == "ok") { ?><input name="file_easynomu_2" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
								<a href="files/easynomu/<?=$row['file_easynomu_2']?>" target="_blank"><?=$row['file_easynomu_2']?></a>
								<input type="hidden" name="feasynomu_2" value="<?=$row['file_easynomu_2']?>">
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��Ÿ ����<font color="red"></font></td>
							<td nowrap  class="tdrow" colspan="3">
<?
if($is_damdang == "ok") {
?>
								<input name="file_etc" type="text" class="textfm" style="width:100%;ime-mode:active;" value="<?=$row['file_etc']?>" maxlength="100">
<?
} else {
	echo $row['file_etc'];
}
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
<?
//������ �Ƿڼ� : ����/���� �α��� �� ���� / ���»� �α��� �� ����
if($stx_man_cust_name < 100) {
?>
					<div style="height:10px;font-size:0px"></div>
					<a name="20001"><!--������������--></a>
					<table border="0" cellspacing="0" cellpadding="0" style="">
						<tr>
							<td id=""> 
								<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='electric_charges_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer;">
									<tr> 
										<td><img src="images/so_tab_on_lt.gif"></td> 
										<td background="images/so_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:110px;text-align:center'> 
											<span>������������</span>
										</td> 
										<td><img src="images/so_tab_on_rt.gif"></td> 
									</tr> 
								</table> 
							</td> 
							<td width=6></td> 
							<td valign="bottom" style="padding-left:10px;">
								�� <b style="color:red;">�ʼ��׸�</b> ����ȣ, ������ֹι�ȣ(����), ���ε�Ϲ�ȣ(����)�� �ʼ�üũ�����Դϴ�.
							</td> 
							</td> 
						</tr> 
					</table>
					<div style="height:2px;font-size:0px" class="botr"></div>
					<div style="height:2px;font-size:0px;line-height:0px;"></div>
					<!--��޴� -->
					<!-- �Է��� -->
					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" id="electric_charges_div" style="<? if($w && !$row['electric_charges_no']) echo "display:none;"; ?>">
						<tr>
							<td nowrap class="tdrowk" width="120">
								<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����ȣ<font color="red"></font>
							</td>
							<td nowrap  class="tdrow" width="250">
<?
	if($is_damdang == "ok") {
?>
								<input name="electric_charges_no" type="text" class="textfm" style="width:94px;" value="<?=$row['electric_charges_no']?>" maxlength="10" onblur="getCont_electric_no(this.value, '<?=$id?>');" />
								��) 0912341234
								<div id='rst_electric_no' style="color:red;"></div>
								<input type="hidden" name="rst_chk_electric_no" value="" />
<?
	} else {
		if($row['electric_charges_no']) echo $row['electric_charges_no'];
	}
?>
							</td>
							<td nowrap class="tdrowk" width="120">
								<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">������ֹι�ȣ
							</td>
							<td nowrap  class="tdrow" width="140">
<?
	if($is_damdang == "ok") {
?>
								<input name="electric_charges_ssnb" type="text" class="textfm" style="width:100px;ime-mode:disabled;" value="<?=$row['electric_charges_ssnb']?>" maxlength="14" onkeydown="only_number_hyphen()" onkeyup="checkhyphen_ssnb(this.value, this)" />
<?
	} else {
		if($row['electric_charges_ssnb']) echo $row['electric_charges_ssnb'];
	}
?>
							</td>
							<td nowrap class="tdrowk" width="120">
								<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���ε�Ϲ�ȣ<font color="red"></font>
							</td>
							<td nowrap  class="tdrow" width="">
<?
	if($is_damdang == "ok") {
?>
								<input name="electric_charges_bupin" type="text" class="textfm" style="width:110px;ime-mode:disabled;" value="<?=$row['electric_charges_bupin']?>" maxlength="14" onkeydown="only_number_hyphen()" onkeyup="checkhyphen_ssnb(this.value, this)" />
<?
	} else {
		if($row['electric_charges_bupin']) echo $row['electric_charges_bupin'];
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���޸�<font color="red"></font></td>
							<td nowrap class="tdrow" colspan="5">
<?
	if($is_damdang == "ok") {
?>
								<textarea name="electric_charges_memo" class="textfm" style='width:100%;height:38px;word-break:break-all;'><?=$row['electric_charges_memo']?></textarea>
<?
	} else {
		if($row['electric_charges_memo']) echo "<pre style='word-wrap:break-word;white-space:pre-wrap;white-space:-moz-pre-wrap;white-space:-pre-wrap;white-space:-o-pre-wrap;word-break:break-all;'>".$row['electric_charges_memo']."</pre>";
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">ó����Ȳ<font color="red"></font></td>
							<td nowrap class="tdrow" colspan="5">
<?
$check_ok_id = $row['electric_charges_process'];
if($row['electric_charges_process']) echo $electric_charges_process_arry[$check_ok_id];
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">ó�����<font color="red"></font></td>
							<td nowrap class="tdrow" colspan="5">
<?
if($row['electric_charges_etc']) echo "<pre style='word-wrap:break-word;white-space:pre-wrap;white-space:-moz-pre-wrap;white-space:-pre-wrap;white-space:-o-pre-wrap;word-break:break-all;'>".$row['electric_charges_etc']."</pre>";
?>
							</td>
						</tr>
					</table>

					<div style="height:10px;font-size:0px"></div>
					<a name="20002"><!--�����߸�������--></a>
					<table border="0" cellspacing="0" cellpadding="0" style="">
						<tr>
							<td id=""> 
								<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='job_invent_recompense_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer;">
									<tr> 
										<td><img src="images/so_tab_on_lt.gif"></td> 
										<td background="images/so_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:110px;text-align:center'> 
											<span>�����߸�������</span>
										</td> 
										<td><img src="images/so_tab_on_rt.gif"></td> 
									</tr> 
								</table> 
							</td> 
							<td width=6></td> 
							<td valign="bottom" style="padding-left:10px;">
								�� <b style="color:red;">�ʼ��׸�</b> ����ι�ȣ�� �ʼ�üũ�����Դϴ�.
							</td> 
							</td> 
						</tr> 
					</table>
					<div style="height:2px;font-size:0px" class="botr"></div>
					<div style="height:2px;font-size:0px;line-height:0px;"></div>
					<!--��޴� -->
					<!-- �Է��� -->
					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" id="job_invent_recompense_div" style="<? if($w && !$row['job_invent_recompense_no']) //echo "display:none;"; ?>">
						<tr>
							<td nowrap class="tdrowk" width="120">
								<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0"><b style="color:red;">����ι�ȣ</b>
							</td>
							<td nowrap  class="tdrow" width="">
<?
	if($is_damdang == "ok") {
?>
								<input name="job_invent_no" type="text" class="textfm" style="width:104px;" value="<?=$row2['job_invent_no']?>" maxlength="12" onblur="getCont_electric_no(this.value, '<?=$id?>');" />
								��) 123456789012
<?
	} else {
		if($row2['job_invent_no']) echo $row2['job_invent_no'];
	}
?>
							</td>
						</tr>
					</table>
<?
$title_20003 = "���¼������";
?>
					<div style="height:10px;font-size:0px"></div>
					<a name="20003"><!--<?=$title_20003?>--></a>
					<table border="0" cellspacing="0" cellpadding="0" style="">
						<tr>
							<td id=""> 
								<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='kepco_dsm_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer;">
									<tr> 
										<td><img src="images/so_tab_on_lt.gif"></td> 
										<td background="images/so_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:110px;text-align:center'> 
											<span><?=$title_20003?></span>
										</td> 
										<td><img src="images/so_tab_on_rt.gif"></td> 
									</tr> 
								</table> 
							</td>
							<td width=6></td> 
							<td valign="bottom" style="padding-left:10px;">
								�� <b style="color:red;">�Ƿڿ���</b> �Ƿ� �׸� üũ�ؾ� ����� ���۵˴ϴ�.
							</td> 
							</td> 
						</tr> 
					</table>
					<div style="height:2px;font-size:0px" class="botr"></div>
					<div style="height:2px;font-size:0px;line-height:0px;"></div>
					<!--��޴� -->
					<!-- �Է��� -->
					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" id="kepco_dsm_div" style="<? if($w && !$row['kepco_dsm_no']) //echo "display:none;"; ?>">
						<tr>
							<td nowrap class="tdrowk" width="120">
								<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0"><b style="color:red;">�Ƿڿ���</b>
							</td>
							<td nowrap  class="tdrow" width="">
<?
	if($is_damdang == "ok") {
?>
								<input type="checkbox" name="kepco_dsm_chk" value="1" <? if($row2['kepco_dsm_chk'] == "1") echo "checked"; ?> style="vertical-align:middle"><span style="color:red;font-weight:bold;">�Ƿ�</span>
<?
	} else {
		if($row2['kepco_dsm_chk']) echo "<b>�Ƿ�</b>";
	}
	//�Ƿ� �� �ش� ������ ��ũ
	if($row2['kepco_dsm_chk']) echo " <a href='kepco_dsm_list.php'>[".$title_20003."]</a>";
?>
							</td>
						</tr>
					</table>
<?
$title_1901000 = "4�뺸������";
//���� ���� �Ұ� �豹�� ���� �ǰ� 161019 / �������� ���̿� ���� ������ ���� �ӽ� ���� 161101
//if($member['mb_level'] > 6) {
?>
					<div style="height:10px;font-size:0px"></div>
					<a name="1901000"><!--<?=$title_1901000?>--></a>
					<table border="0" cellspacing="0" cellpadding="0" style="">
						<tr>
							<td id=""> 
								<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='si4n_nhis_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer;">
									<tr> 
										<td><img src="images/so_tab_on_lt.gif"></td> 
										<td background="images/so_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:110px;text-align:center'> 
											<span><?=$title_1901000?></span>
										</td> 
										<td><img src="images/so_tab_on_rt.gif"></td> 
									</tr> 
								</table> 
							</td>
							<td width=6></td> 
							<td valign="bottom" style="padding-left:10px;">
								�� <b style="color:red;">�Ƿڿ���</b> �Ƿ� �׸� üũ�ؾ� ����� ���۵˴ϴ�.
							</td> 
							</td> 
						</tr> 
					</table>
					<div style="height:2px;font-size:0px" class="botr"></div>
					<div style="height:2px;font-size:0px;line-height:0px;"></div>
					<!--��޴� -->
					<!-- �Է��� -->
					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" id="si4n_nhis_div" style="<? if($w && !$row['si4n_nhis_no']) //echo "display:none;"; ?>">
						<tr>
							<td nowrap class="tdrowk" width="120">
								<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0"><b style="color:red;">�Ƿڿ���</b>
							</td>
							<td nowrap  class="tdrow" width="">
<?
	if($is_damdang == "ok") {
?>
								<input type="checkbox" name="si4n_nhis_chk" value="1" <? if($row2['si4n_nhis_chk'] == "1") echo "checked"; ?> style="vertical-align:middle"><span style="color:red;font-weight:bold;">�Ƿ�</span>
<?
	} else {
		if($row2['si4n_nhis_chk']) echo "<b>�Ƿ�</b>";
	}
	//�Ƿ� �� �ش� ������ ��ũ
	if($row2['si4n_nhis_chk']) echo " <a href='si4n_nhis_view.php?w=u&id=".$id."'>[".$title_1901000."]</a>";
?>
							</td>
						</tr>
					</table>
<?
//} //�ӽ� ���� 161101
?>
					<div style="height:10px;font-size:0px"></div>
					<a name="17001"><!--��������--></a>
					<table border="0" cellspacing="0" cellpadding="0" style="">
						<tr>
							<td id=""> 
								<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='job_request_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer;">
									<tr> 
										<td><img src="images/so_tab_on_lt.gif"></td> 
										<td background="images/so_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:110px;text-align:center'> 
											<span>������Ʒ�</span>
										</td> 
										<td><img src="images/so_tab_on_rt.gif"></td> 
									</tr> 
								</table> 
							</td> 
							<td width=6></td> 
							<td valign="bottom" style="padding-left:10px;">
								�� <b style="color:red;">�Ƿڿ���</b> �Ƿ� �׸� üũ�ؾ� ����� ���۵˴ϴ�.
								<b style="color:red;">üũ����Ʈ</b>�� �ʼ������Դϴ�. �ݵ�� ÷���Ͽ� �ֽʽÿ�.
							</td> 
							</td> 
						</tr> 
					</table>
					<div style="height:2px;font-size:0px" class="botr"></div>
					<div style="height:2px;font-size:0px;line-height:0px;"></div>
					<!--��޴� -->
					<!-- �Է��� -->
					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" id="job_request_div" style="<? if($w && $row['job_request_if'] != "1") echo "display:none"; ?>">
						<tr>
							<td nowrap class="tdrowk" width="">
								<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0"><b style="color:red;">�Ƿڿ���</b>
							</td>
							<td nowrap  class="tdrow" width="">
<?
	if($is_damdang == "ok") {
?>
								<input type="checkbox" name="job_request_if" value="1" <? if($row['job_request_if'] == "1") echo "checked"; ?> style="vertical-align:middle"><span style="color:red;font-weight:bold;">�Ƿ�</span>
<?
	} else {
		if($row['job_request_if']) echo "<b>�Ƿ�</b>";
	}
?>
							</td>
							<td nowrap class="tdrowk" width="120">
								<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">HRD���̵�<font color="red">*</font>
							</td>
							<td nowrap  class="tdrow" width="376">
<?
	if($is_damdang == "ok") {
?>
								<b>���̵�</b>
								<input name="job_hrd_id" type="text" class="textfm" style="width:120px;vertical-align:middle;ime-mode:disabled;" value="<?=$row['job_hrd_id']?>" maxlength="14">
								<b>��й�ȣ</b>
								<input name="job_hrd_pw" type="text" class="textfm" style="width:120px;vertical-align:middle;ime-mode:disabled;" value="<?=$row['job_hrd_pw']?>" maxlength="14">
<?
	} else {
		if($row['job_hrd_id']) echo "<b>���̵�</b> : ".$row['job_hrd_id']." ";
		if($row['job_hrd_pw']) echo "<b>��й�ȣ</b> : ".$row['job_hrd_pw'];
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk" width="">
								<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0"><span style="color:#343434;">���輺��</span>
							</td>
							<td nowrap  class="tdrow" width="">
<?
	if($is_damdang == "ok") {
?>
								<input type="checkbox" name="danger_evaluate_if" value="1" <? if($row['danger_evaluate_if'] == "1") echo "checked"; ?> style="vertical-align:middle">�Ƿ�
<?
	} else {
		if($row['danger_evaluate_if']) echo "<b>�Ƿ�</b>";
	}
?>
							</td>
							<td nowrap class="tdrowk" width="">
								<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">KRAS���̵�<font color="red"></font>
							</td>
							<td nowrap  class="tdrow" width="">
<?
	if($is_damdang == "ok") {
?>
								<b>���̵�</b>
								<input name="job_kras_id" type="text" class="textfm" style="width:120px;vertical-align:middle;ime-mode:disabled;" value="<?=$row['job_kras_id']?>" maxlength="14">
								<b>��й�ȣ</b>
								<input name="job_kras_pw" type="text" class="textfm" style="width:120px;vertical-align:middle;ime-mode:disabled;" value="<?=$row['job_kras_pw']?>" maxlength="14">
<?
	} else {
		if($row['job_kras_id']) echo "<b>���̵�</b> : ".$row['job_kras_id']." ";
		if($row['job_kras_pw']) echo "<b>��й�ȣ</b> : ".$row['job_kras_pw'];
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk" width="120">
								<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">÷�μ������
							</td>
							<td nowrap  class="tdrow" width="" colspan="5">
<?
	$job_file_check = explode(',',$row['job_file_check']);

	if($is_damdang == "ok") {
		for($i=0;$i<=7;$i++) {
			$k = $i + 1;
?>
								<input type="checkbox" name="job_file_check<?=$k?>" value="1" <? if($job_file_check[$i] == 1) echo "checked"; ?> style="vertical-align:middle"><? if($i == 0) echo "<span style='color:red;font-weight:bold;'>"; ?><?=$job_file_check_array[$i]?><? if($i == 0) echo "</span>"; ?>
<?
		}
	} else {
		if($job_file_check[0]) echo $job_file_check_array[0].". ";
		if($job_file_check[1]) echo $job_file_check_array[1].". ";
		if($job_file_check[2]) echo $job_file_check_array[2].". ";
		if($job_file_check[3]) echo $job_file_check_array[3].". ";
		if($job_file_check[4]) echo $job_file_check_array[4].". ";
		if($job_file_check[5]) echo $job_file_check_array[5].". ";
		if($job_file_check[6]) echo $job_file_check_array[6].". ";
		if($job_file_check[7]) echo $job_file_check_array[7];
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk" width="" rowspan="4">
								<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">÷������
							</td>
							<td   class="tdrow" width="">
								<div style="padding-top:4px;">
									<? if($is_damdang == "ok") { ?><b>����1</b> <input type="checkbox" name="job_file_del_1" value="1" style="vertical-align:middle">����
									<input name="job_file_1" type="file" class="textfm" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
									<a href="files/job_file/<?=$row['job_file_1']?>" target="_blank"><?=$row['job_file_1']?></a>
									<input type="hidden" name="p_file_1" value="<?=$row['job_file_1']?>">
								</div>
							</td>
							<td   class="tdrow" colspan="2">
								<div style="padding-top:4px;">
									<? if($is_damdang == "ok") { ?><b>����2</b> <input type="checkbox" name="job_file_del_2" value="1" style="vertical-align:middle">����
									<input name="job_file_2" type="file" class="textfm" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
									<a href="files/job_file/<?=$row['job_file_2']?>" target="_blank"><?=$row['job_file_2']?></a>
									<input type="hidden" name="p_file_2" value="<?=$row['job_file_2']?>">
								</div>
							</td>
						</tr>
						<tr>
							<td   class="tdrow" width="">
								<div style="padding-top:4px;">
									<? if($is_damdang == "ok") { ?><b>����3</b> <input type="checkbox" name="job_file_del_3" value="1" style="vertical-align:middle">����
									<input name="job_file_3" type="file" class="textfm" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
									<a href="files/job_file/<?=$row['job_file_3']?>" target="_blank"><?=$row['job_file_3']?></a>
									<input type="hidden" name="p_file_3" value="<?=$row['job_file_3']?>">
								</div>
							</td>
							<td   class="tdrow" colspan="2">
								<div style="padding-top:4px;">
									<? if($is_damdang == "ok") { ?><b>����4</b> <input type="checkbox" name="job_file_del_4" value="1" style="vertical-align:middle">����
									<input name="job_file_4" type="file" class="textfm" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
									<a href="files/job_file/<?=$row['job_file_4']?>" target="_blank"><?=$row['job_file_4']?></a>
									<input type="hidden" name="p_file_4" value="<?=$row['job_file_4']?>">
								</div>
							</td>
						</tr>
						<tr>
							<td   class="tdrow" width="">
								<div style="padding-top:4px;">
									<? if($is_damdang == "ok") { ?><b>����5</b> <input type="checkbox" name="job_file_del_5" value="1" style="vertical-align:middle">����
									<input name="job_file_5" type="file" class="textfm" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
									<a href="files/job_file/<?=$row['job_file_5']?>" target="_blank"><?=$row['job_file_5']?></a>
									<input type="hidden" name="p_file_5" value="<?=$row['job_file_5']?>">
								</div>
							</td>
							<td   class="tdrow" colspan="2">
								<div style="padding-top:4px;">
									<? if($is_damdang == "ok") { ?><b>����6</b> <input type="checkbox" name="job_file_del_6" value="1" style="vertical-align:middle">����
									<input name="job_file_6" type="file" class="textfm" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
									<a href="files/job_file/<?=$row['job_file_6']?>" target="_blank"><?=$row['job_file_6']?></a>
									<input type="hidden" name="p_file_6" value="<?=$row['job_file_6']?>">
								</div>
							</td>
						</tr>
						<tr>
							<td   class="tdrow" width="">
								<div style="padding-top:4px;">
									<? if($is_damdang == "ok") { ?><b>����7</b> <input type="checkbox" name="job_file_del_7" value="1" style="vertical-align:middle">����
									<input name="job_file_7" type="file" class="textfm" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
									<a href="files/job_file/<?=$row['job_file_7']?>" target="_blank"><?=$row['job_file_7']?></a>
									<input type="hidden" name="p_file_7" value="<?=$row['job_file_7']?>">
								</div>
							</td>
							<td   class="tdrow" colspan="2">
								<div style="padding-top:4px;">
									<? if($is_damdang == "ok") { ?><b>����8</b> <input type="checkbox" name="job_file_del_8" value="1" style="vertical-align:middle">����
									<input name="job_file_8" type="file" class="textfm" style="width:250px;margin:0 0 4px 0;"><br><? } ?>
									<a href="files/job_file/<?=$row['job_file_8']?>" target="_blank"><?=$row['job_file_8']?></a>
									<input type="hidden" name="p_file_8" value="<?=$row['job_file_8']?>">
								</div>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�ʼ������̼�����</td>
							<td nowrap  class="tdrow" colspan="3">
<?
	if($is_damdang == "ok") {
?>
								<input type="checkbox" name="job_sexual_if" value="1" <? if($row['job_sexual_if'] == "1") echo "checked"; ?> style="vertical-align:middle"><b>����տ��汳��</b>
								<input type="checkbox" name="job_safety_if" value="1" <? if($row['job_safety_if'] == "1") echo "checked"; ?> style="vertical-align:middle"><b>�����������</b>
								<input type="checkbox" name="job_privacy_if" value="1" <? if($row['job_privacy_if'] == "1") echo "checked"; ?> style="vertical-align:middle"><b>����������ȣ��</b>
								<input name="job_essential" type="text" class="textfm" style="width:200px;vertical-align:middle" value="<?=$row['job_essential']?>" maxlength="50"><b>(�ʼ���������)</b>
<?
	} else {
		if($row['job_sexual_if']) echo "<b>����տ��汳��</b> : ".$row['job_sexual_if']."<br>";
		if($row['job_safety_if']) echo "<b>�����������</b> : ".$row['job_safety_if']."<br>";
		if($row['job_privacy_if']) echo "<b>����������ȣ��</b> : ".$row['job_privacy_if']." ";
		if($row['job_essential']) echo "<b>�ʼ���������</b> : ".$row['job_essential'];
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�����Ʒ������̷�<font color="red"></font></td>
							<td nowrap  class="tdrow" colspan="3">
<?
	if($is_damdang == "ok") {
?>
								<input name="job_participate" type="text" class="textfm" style="width:100%;ime-mode:active;" value="<?=$row['job_participate']?>" maxlength="100">
<?
	} else {
		if($row['job_participate']) echo $row['job_participate'];
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�޸�<font color="red"></font></td>
							<td nowrap class="tdrow" colspan="3">
<?
	if($is_damdang == "ok") {
?>
								<textarea name="job_memo" class="textfm" style='width:100%;height:38px;word-break:break-all;'><?=$row['job_memo']?></textarea>
<?
	} else {
		if($row['job_memo']) echo "<pre style='word-wrap:break-word;white-space:pre-wrap;white-space:-moz-pre-wrap;white-space:-pre-wrap;white-space:-o-pre-wrap;word-break:break-all;'>".$row['job_memo']."</pre>";
	}
?>
							</td>
						</tr>
					</table>
					<div style="height:10px;font-size:0px"></div>
					<a name="19001"><!--�ð�������--></a>
					<table border=0 cellspacing=0 cellpadding=0 style=""> 
						<tr>
							<td id=""> 
								<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='job_time_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer;">
									<tr> 
										<td><img src="images/so_tab_on_lt.gif"></td> 
										<td background="images/so_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:110px;text-align:center'> 
											<span>�ð�������</span>
										</td> 
										<td><img src="images/so_tab_on_rt.gif"></td> 
									</tr> 
								</table> 
							</td> 
							<td width=6></td> 
							<td valign="bottom" style="padding-left:10px;">
								�� <b style="color:red;">�Ƿڿ���</b> �Ƿ� �׸� üũ�ؾ� ����� ���۵˴ϴ�.
							</td> 
							</td> 
						</tr> 
					</table>
					<div style="height:2px;font-size:0px" class="botr"></div>
					<div style="height:2px;font-size:0px;line-height:0px;"></div>
					<!--��޴� -->
					<!-- �Է��� -->
					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" id="job_time_div" style="<? if($w && $row['job_time_if'] != "1") echo "display:none"; ?>">
						<tr>
							<td nowrap class="tdrowk" width="120">
								<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0"><b style="color:red;">�Ƿڿ���</b>
							</td>
							<td nowrap  class="tdrow" width="140">
<?
	if($is_damdang == "ok") {
?>
								<input type="checkbox" name="job_time_if" value="1" <? if($row['job_time_if'] == "1") echo "checked"; ?> style="vertical-align:middle"><span style="color:red;font-weight:bold;">�Ƿ�</span>
<?
	} else {
		if($row['job_time_if']) echo "<b>�Ƿ�</b>";
	}
?>
							</td>
							<td nowrap class="tdrowk" width="120">
								<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���谡���ο�<font color="red"></font>
							</td>
							<td nowrap  class="tdrow" width="140">
<?
	if($is_damdang == "ok") {
?>
								<input name="insurance_persons" type="text" class="textfm" style="width:110px;" value="<?=$row['insurance_persons']?>" maxlength="20" />
<?
	} else {
		if($row['insurance_persons']) echo $row['insurance_persons']." ";
	}
?>
							</td>
							<td nowrap class="tdrowk" width="120">
								<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�湮����<font color="red"></font>
							</td>
							<td nowrap  class="tdrow" width="">
<?
	if($is_damdang == "ok") {
?>
								<input name="visitdt" type="text" class="textfm" style="width:80px;ime-mode:disabled;" value="<?=$row['visitdt']?>" maxlength="10" onkeypress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')" />
								<table border="0" cellspacing="0" cellpadding="0" style="vertical-align:middle;display:inline;"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif" alt="[" /></td><td style="background:url('./images/btn2_bg.gif')" class="ftbutton3_white"><a href="javascript:loadCalendar(document.dataForm.visitdt);">�޷�</a></td><td><img src="./images/btn2_rt.gif" alt="]" /></td> <td width="2"></td></tr></table>
<?
	$visitdt_time = $row['visitdt_time'];
	$sel_visitdt_time = array();
	$sel_visitdt_time[$visitdt_time] = "selected";
?>
								<select name="visitdt_time" class="selectfm">
									<option value="">����</option>
									<option value="����" <?=$sel_visitdt_time['����']?>>����</option>
									<option value="����" <?=$sel_visitdt_time['����']?>>����</option>
								</select>
<?
	} else {
		if($row['visitdt']) echo $row['visitdt']." ";
		if($row['visitdt_time']) echo $row['visitdt_time'];
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���޸�<font color="red"></font></td>
							<td class="tdrow" colspan="5">
<?
	if($is_damdang == "ok") {
?>
								<textarea name="job_time_memo" class="textfm" style='width:100%;height:38px;word-break:break-all;'><?=$row['job_time_memo']?></textarea>
<?
	} else {
		if($row['job_time_memo']) echo "<pre style='word-wrap:break-word;white-space:pre-wrap;white-space:-moz-pre-wrap;white-space:-pre-wrap;white-space:-o-pre-wrap;word-break:break-all;'>".$row['job_time_memo']."</pre>";
	}
?>
							</td>
						</tr>
					</table>

					<div style="height:10px;font-size:0px"></div>
					<!--��޴� -->
					<a name="11001"><!--�������Ƿڼ�--></a>
					<div style="text-align:left;"><span style="cursor:pointer;" onclick="var div_display='consult_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}"><img src="./images/tab01_on.gif" border="0" id="tab_img1" /></span></div>
					<div style="height:2px;font-size:0px" class="bgtr"></div>
					<div style="height:2px;font-size:0px;line-height:0px;"></div>
					<div id="consult_div" style="<? //if($w) echo "display:none;" ?>">
					<div style="height:5px;font-size:0px"></div>
					<table border=0 cellspacing=0 cellpadding=0 style=""> 
						<tr>
							<td id=""> 
								<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='employment_support_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer;">
									<tr> 
										<td><img src="images/g_tab_on_lt.gif"></td> 
										<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
											������
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
					<div id="employment_support_div" style="<? if(!$row['aid_kind'] && !$row['family_work_if'] && !$row['insurance_holder'] && !$row['refund_request'] && !$row['family_refund_wrong'] && !$row['sj_if'] && !$row['join_request'] && !$row['handicapped1'] && !$row['handicapped2'] && !$row['contributor'] && !$row['rules_report_if'] && !$row['rules_report_date'] && !$row['retirement_age'] && !$row['extend_age'] && !$row['multitude'] && !$row['pay_peak_if'] && !$row['hire_support'] && !$row['refugee'] && !$row['support_etc'] && !$row['employment_support']  && !$row['employment_program'] && !$row['women_matriarch_if'] && !$row['handicapped_employment'] && !$row['rural_areas'] && !$row['employable'] && !$row['disaster_if'] && !$row['disaster_memo'] && !$memo1) echo "display:none;" ?>">
					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
						<tr>
							<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��������������<font color="red"></font></td>
							<td nowrap  class="tdrow" colspan="3">
<?
	//������ �Ƿڼ� ����
	$aid_kind = $row['aid_kind']; //����������
	//���谡�� �ٹ�����
	if($row['family_work_if'] == "1") $family_work_if = "YES";
	else if($row['family_work_if'] == "2") $family_work_if = "NO";
	else $family_work_if = "";
	$insurance_holder = $row['insurance_holder']; //���谡����
	//ȯ�޽�û�Ƿ�
	if($row['refund_request'] == "1") $refund_request = "YES";
	else if($row['refund_request'] == "2") $refund_request = "NO";
	else $refund_request = "";
	$family_refund_wrong = $row['family_refund_wrong']; //�Ұ�����
	//������� ���� ���谡������
	if($row['sj_if'] == "1") $sj_if = "YES";
	else if($row['sj_if'] == "2") $sj_if = "NO";
	else $sj_if = "";
	//���Խ�û�Ƿ�
	if($row['join_request'] == "1") $join_request = "YES";
	else if($row['join_request'] == "2") $join_request = "NO";
	else $join_request = "";
	$handicapped1 = $row['handicapped1']; //����(1~3��)
	$handicapped2 = $row['handicapped2']; //����(4~6��)
	$contributor = $row['contributor']; //����������
	if($is_damdang == "ok") {
?>
								<b>����</b>
								<input name="aid_kind" type="text" class="textfm" style="width:840px;ime-mode:active;" value="<?=$row['aid_kind']?>" maxlength="100">
<?
	} else {
		if($aid_kind) echo "<b>����</b> : ".$row['aid_kind'];
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�����������</td>
							<td nowrap  class="tdrow" colspan="">
<?
	if($is_damdang == "ok") {
?>
								<b>���谡�� �ٹ�����</b>
								<input type="radio" name="family_work_if" value="1" <? if($row['family_work_if'] == "1") echo "checked"; ?> style="vertical-align:middle">YES
								<input type="radio" name="family_work_if" value="2" <? if($row['family_work_if'] == "2") echo "checked"; ?> style="vertical-align:middle">NO
								<br><b>���谡����</b>
								<input name="insurance_holder" type="text" class="textfm" style="width:240px;ime-mode:active;vertical-align:middle" value="<?=$row['insurance_holder']?>" maxlength="50">
								<br>
								<b>ȯ�޽�û�Ƿ�</b>
								<input type="radio" name="refund_request" value="1" <? if($row['refund_request'] == "1") echo "checked"; ?> style="vertical-align:middle">YES
								<input type="radio" name="refund_request" value="2" <? if($row['refund_request'] == "2") echo "checked"; ?> style="vertical-align:middle">NO
								<br><b>�Ұ�����</b>
								<input name="family_refund_wrong" type="text" class="textfm" style="width:240px;ime-mode:active;vertical-align:middle" value="<?=$row['family_refund_wrong']?>" maxlength="50">
								<br>
								<b>������� ���� ���谡������</b>
								<input type="radio" name="sj_if" value="1" <? if($row['sj_if'] == "1") echo "checked"; ?> style="vertical-align:middle">YES
								<input type="radio" name="sj_if" value="2" <? if($row['sj_if'] == "2") echo "checked"; ?> style="vertical-align:middle">NO
								<b>���Խ�û�Ƿ�</b>
								<input type="radio" name="join_request" value="1" <? if($row['join_request'] == "1") echo "checked"; ?> style="vertical-align:middle">YES
								<input type="radio" name="join_request" value="2" <? if($row['join_request'] == "2") echo "checked"; ?> style="vertical-align:middle">NO
<?
	} else {
		if($family_work_if) echo "<b>���谡�� �ٹ�����</b> : ".$family_work_if."<br>";
		if($insurance_holder) echo "<b>���谡����</b> : ".$insurance_holder."<br>";
		if($refund_request) echo "<b>ȯ�޽�û�Ƿ�</b> : ".$refund_request." ";
		if($family_refund_wrong) echo "<b>�Ұ�����</b> : ".$family_refund_wrong."<br>";
		if($sj_if) echo "<b>������� ���� ���谡������</b> : ".$sj_if." ";
		if($join_request) echo "<b>���Խ�û�Ƿ�</b> : ".$join_request;
	}
?>
							</td>
							<td nowrap class="tdrowk" width="120">
								<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�����/����������
							</td>
							<td nowrap  class="tdrow" width="280">
<?
	if($is_damdang == "ok") {
?>
								����(1~3��)
								<input name="handicapped1" type="text" class="textfm" style="width:180px;ime-mode:active;vertical-align:middle" value="<?=$row['handicapped1']?>" maxlength="50">
								<br>
								����(4~6��)
								<input name="handicapped2" type="text" class="textfm" style="width:180px;ime-mode:active;vertical-align:middle" value="<?=$row['handicapped2']?>" maxlength="50">
								<br>
								����������<img src="./images/icon_blank.gif" width="2" height="2" style="margin:0 5px 3px 0">
								<input name="contributor" type="text" class="textfm" style="width:180px;ime-mode:active;vertical-align:middle" value="<?=$row['contributor']?>" maxlength="50">
<?
	} else {
		if($handicapped1) echo "����(1~3��) : ".$row['handicapped1'];
		if($handicapped2) echo "<br>����(4~6��) : ".$row['handicapped2'];
		if($contributor) echo "<br>���������� : ".$row['contributor'];
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�����</td>
							<td nowrap class="tdrow" colspan="">
<?
	//�����Ģ�� �Ű���
	if($row['rules_report_if'] == "1") $rules_report_if = "YES";
	else if($row['rules_report_if'] == "2") $rules_report_if = "NO";
	else $rules_report_if = "";
	//�Ű���
	$rules_report_date_array = explode(".",$row['rules_report_date']);
	$rules_report_year = $rules_report_date_array[0];
	$rules_report_month = $rules_report_date_array[1];
	$rules_report_day = $rules_report_date_array[2];
	//���⳪�� ���峪�� �ټ��ο�
	$retirement_age = $row['retirement_age'];
	$extend_age = $row['extend_age'];
	$multitude = $row['multitude'];
	//�ӱ���ũ�� ���Կ���
	if($row['pay_peak_if'] == "1") $pay_peak_if = "YES";
	else if($row['pay_peak_if'] == "2") $pay_peak_if = "NO";
	else $pay_peak_if = "";
	if($is_damdang == "ok") {
?>
								<b>�����Ģ�� �Ű���</b>
								<input type="radio" name="rules_report_if" value="1" <? if($row['rules_report_if'] == "1") echo "checked"; ?> style="vertical-align:middle">YES
								<input type="radio" name="rules_report_if" value="2" <? if($row['rules_report_if'] == "2") echo "checked"; ?> style="vertical-align:middle">NO
								<b>�Ű���</b>
								<input name="rules_report_year" type="text" class="textfm" style="ime-mode:disabled;width:40px;" value="<?=$rules_report_year?>" maxlength="4">�� <input name="rules_report_month" type="text" class="textfm" style="ime-mode:disabled;width:40px;" value="<?=$rules_report_month?>" maxlength="2">�� <input name="rules_report_day" type="text" class="textfm" style="ime-mode:disabled;width:40px;" value="<?=$rules_report_day?>" maxlength="2">��
								<br>
								<b>���⳪��/����</b>
								<input name="retirement_age" type="text" class="textfm" style="ime-mode:active;width:100px;" value="<?=$row['retirement_age']?>" maxlength="20"> 
								<b>���峪��</b>
								<input name="extend_age" type="text" class="textfm" style="ime-mode:disabled;width:40px;" value="<?=$row['extend_age']?>" maxlength="2"> ��
								<b>�ټ��ο�</b>
								<input name="multitude" type="text" class="textfm" style="ime-mode:disabled;width:40px;" value="<?=$row['multitude']?>" maxlength="2"> ��
								<br>
								<b>�ӱ���ũ�� ���Կ���</b>
								<input type="radio" name="pay_peak_if" value="1" <? if($row['pay_peak_if'] == "1") echo "checked"; ?> style="vertical-align:middle">YES
								<input type="radio" name="pay_peak_if" value="2" <? if($row['pay_peak_if'] == "2") echo "checked"; ?> style="vertical-align:middle">NO
<?
	} else {
		if($rules_report_if) echo "<b>�����Ģ�� �Ű���</b> : ".$rules_report_if." ";
		if($row['rules_report_date']) echo " <b>�Ű���</b> : ".$row['rules_report_date'];
		if($retirement_age) echo "<br><b>���⳪��</b> : ".$row['retirement_age']." ";
		if($extend_age) echo "<b>���峪��</b> : ".$row['extend_age']." ";
		if($multitude) echo "<b>�ټ��ο�</b> : ".$row['multitude'];
		if($pay_peak_if) echo "<br><b>�ӱ���ũ�� ���Կ���</b> : ".$pay_peak_if;
	}
?>
							</td>
							<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��Ÿ����</td>
							<td nowrap  class="tdrow">
<?
	$hire_support = $row['hire_support']; //�������
	$refugee = $row['refugee']; //���͹�
	$support_etc = $row['support_etc']; //��Ÿ
	if($is_damdang == "ok") {
?>
								�������
								<input name="hire_support" type="text" class="textfm" style="width:180px;ime-mode:active;vertical-align:middle" value="<?=$row['hire_support']?>" maxlength="50">
								<br>
								���͹�<img src="./images/icon_blank.gif" width="2" height="2" style="margin:0 10px 3px 0">
								<input name="refugee" type="text" class="textfm" style="width:180px;ime-mode:active;vertical-align:middle" value="<?=$row['refugee']?>" maxlength="50">
								<br>
								��Ÿ<img src="./images/icon_blank.gif" width="2" height="2" style="margin:0 22px 3px 0">
								<input name="support_etc" type="text" class="textfm" style="width:180px;ime-mode:active;vertical-align:middle" value="<?=$row['support_etc']?>" maxlength="50">
<?
	} else {
		if($hire_support) echo "������� : ".$row['hire_support'];
		if($refugee) echo "���͹� : ".$row['refugee'];
		if($support_etc) echo "��Ÿ : ".$row['support_etc'];
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk">
								<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�������(11������)
							</td>
							<td nowrap  class="tdrow" colspan="">
<?
	//����������α׷��̼��� ä�뿩��
	if($row['employment_support'] == "1") $employment_support = "YES";
	else if($row['employment_support'] == "2") $employment_support = "NO";
	else $employment_support = "";
	$employment_program = $row['employment_program']; //���α׷���
	//�������� ä��
	if($row['women_matriarch_if'] == "1") $women_matriarch_if = "YES";
	else if($row['women_matriarch_if'] == "2") $women_matriarch_if = "NO";
	else $women_matriarch_if = "";
	//�������� ����
	$women_matriarch_kind = explode(',',$row['women_matriarch_kind']);
	$women_matriarch_kind_text = array("�Ѻθ���","���ʻ�Ȱ","����������");
	//��������� ä��
	if($row['handicapped_employment'] == "1") $handicapped_employment = "YES";
	else if($row['handicapped_employment'] == "2") $handicapped_employment = "NO";
	else $handicapped_employment = "";
	//�������� ������
	if($row['rural_areas'] == "1") $rural_areas = "YES";
	else if($row['rural_areas'] == "2") $rural_areas = "NO";
	else $rural_areas = "";
	$employable = $row['employable']; //�����
	if($is_damdang == "ok") {
?>
								<b>����������α׷��̼��� ä�뿩��</b>
								<input type="radio" name="employment_support" value="1" <? if($row['employment_support'] == "1") echo "checked"; ?> style="vertical-align:middle">YES
								<input type="radio" name="employment_support" value="2" <? if($row['employment_support'] == "2") echo "checked"; ?> style="vertical-align:middle">NO
								<br><b>���α׷���</b>
								<input name="employment_program" type="text" class="textfm" style="width:380px;ime-mode:active;" value="<?=$row['employment_program']?>" maxlength="100">
								<br>
								<b>�������� ä��</b>
								<input type="radio" name="women_matriarch_if" value="1" <? if($row['women_matriarch_if'] == "1") echo "checked"; ?> style="vertical-align:middle">YES
								<input type="radio" name="women_matriarch_if" value="2" <? if($row['women_matriarch_if'] == "2") echo "checked"; ?> style="vertical-align:middle">NO
								(<input type="checkbox" name="women_matriarch_kind1" value="1" <? if($women_matriarch_kind[0] == 1) echo "checked"; ?> style="vertical-align:middle">�Ѻθ���
								<input type="checkbox" name="women_matriarch_kind2" value="1" <? if($women_matriarch_kind[1] == 1) echo "checked"; ?> style="vertical-align:middle">���ʻ�Ȱ
								<input type="checkbox" name="women_matriarch_kind3" value="1" <? if($women_matriarch_kind[2] == 1) echo "checked"; ?> style="vertical-align:middle">����������)
								<br>
								<b>��������� ä��</b>
								<input type="radio" name="handicapped_employment" value="1" <? if($row['handicapped_employment'] == "1") echo "handicapped_employment"; ?> style="vertical-align:middle">YES
								<input type="radio" name="handicapped_employment" value="2" <? if($row['handicapped_employment'] == "2") echo "checked"; ?> style="vertical-align:middle">NO
								<b>�������� ������</b>
								<input type="radio" name="rural_areas" value="1" <? if($row['rural_areas'] == "1") echo "checked"; ?> style="vertical-align:middle">YES
								<input type="radio" name="rural_areas" value="2" <? if($row['rural_areas'] == "2") echo "checked"; ?> style="vertical-align:middle">NO
								<br><b>�����</b>
								<input name="employable" type="text" class="textfm" style="width:400px;ime-mode:active;" value="<?=$row['employable']?>" maxlength="100">
<?
	} else {
		if($employment_support) echo "<b>����������α׷��̼��� ä�뿩��</b> : ".$employment_support."<br>";
		if($employment_program) echo "<b>���α׷���</b> : ".$employment_program."<br>";
		if($women_matriarch_if) echo "<b>�������� ä��</b> : ".$women_matriarch_if."<br>";
		if($handicapped_employment) echo "<b>��������� ä��</b> : ".$handicapped_employment."<br>";
		if($rural_areas) echo "<b>�������� ������</b> : ".$rural_areas."<br>";
		if($employable) echo "<b>�����</b> : ".$employable."";
	}
?>
							</td>
							<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�������</td>
							<td nowrap  class="tdrow">
<?
	//���翩��
	if($row['disaster_if'] == "1") $disaster_if = "YES";
	else if($row['disaster_if'] == "2") $disaster_if = "NO";
	else $disaster_if = "";
	$disaster_memo = $row['disaster_memo']; //����
	if($is_damdang == "ok") {
?>
								<b>���翩��</b>
<?
	if($row['disaster_if'] == "1") $chk_disaster_if1 = "checked";
	else if($row['disaster_if'] == "2") $chk_disaster_if2 = "checked";
?>
								<input type="radio" name="disaster_if" value="1" <?=$chk_disaster_if1?> style="vertical-align:middle">YES
								<input type="radio" name="disaster_if" value="2" <?=$chk_disaster_if2?> style="vertical-align:middle">NO
								<br>����<br>
								<textarea name="disaster_memo" class="textfm" style='width:100%;height:38px;word-break:break-all;'><?=$row['disaster_memo']?></textarea>
<?
	} else {
		if($disaster_if) echo "<b>���翩��</b> : ".$disaster_if."<br>";
		if($disaster_memo) echo "���� : ".$row['disaster_memo'];
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�޸�<font color="red"></font></td>
							<td nowrap  class="tdrow" colspan="3">
<?
	if($is_damdang == "ok") {
?>
								<textarea name="memo1" class="textfm" style='width:100%;height:38px;word-break:break-all;'><?=$memo1?></textarea>
<?
	} else {
		if($memo1) echo "<pre>".$memo1."</pre>";
	}
?>
							</td>
						</tr>
					</table>
					</div>
					<div style="height:10px;font-size:0px;line-height:0px;"></div>

					<!--��޴� -->
					<table border=0 cellspacing=0 cellpadding=0 style=""> 
						<tr>
							<td id=""> 
								<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='job_creation_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer;">
									<tr> 
										<td><img src="images/g_tab_on_lt.gif"></td> 
										<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100px;text-align:center'> 
											���â��
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
					<!--��޴� -->
					<div id="job_creation_div" style="<? if(!$row['career_5year'] && !$row['career_item'] && !$row['scholar_doctor'] && !$row['lab_career'] && !$row['adoption_6months'] && !$row['adoption_env_date'] && !$row['adoption_env_completion'] && !$row['increase_staff'] && !$row['pay_required'] && !$row['fund_item'] && !$row['adoption_env_etc'] && ($row['subsidy_type_if']==',,,,,,,,,,,,,,' || !$row['subsidy_type_if']) && !$row['local_return'] && !$row['adoption_6months_new'] && !$row['employ_execute_yn'] && !$row['employ_execute_age'] && ($row['employ_execute_sex']==',,,' || !$row['employ_execute_date']) && !$row['employ_execute_person'] && !$row['employ_execute_pay'] && !$row['employ_execute_time'] && !$row['employ_execute_id'] && !$row['employ_execute_pw']  && !$row['employ_execute_etc'] && ($row['job_creation_proposal']==',,,,,' || !$row['job_creation_proposal']) && !$row['worktime_shorten_proposal_yn'] && !$row['worktime_shorten_proposal']) echo "display:none;" ?>">
					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
						<tr>
							<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�����η�ä��<font color="red"></font></td>
							<td nowrap  class="tdrow" colspan="">
<?
	$career_5year = $row['career_5year']; //Ÿȸ�� 5���̻� ���߰��
	$career_item = $row['career_item']; //�濵��ȹ,�λ�,�빫�繫,�����ð��
	$scholar_doctor = $row['scholar_doctor']; //��,�ڻ�
	$lab_career = $row['lab_career']; //�����Ұ��
	$adoption_6months = $row['adoption_6months']; //6�����̳� ä�뿹������
	if($is_damdang == "ok") {
?>
								<b>Ÿȸ�� 5���̻� ���߰��</b>
								<input name="career_5year" type="text" class="textfm" style="width:300px;ime-mode:active;" value="<?=$row['career_5year']?>" maxlength="100">
								<br><b>�濵��ȹ,�λ�,�빫�繫,�����ð��</b>
								<input name="career_item" type="text" class="textfm" style="width:254px;ime-mode:active;" value="<?=$row['career_item']?>" maxlength="100">
								<br><b>��,�ڻ�</b>
								<input name="scholar_doctor" type="text" class="textfm" style="width:300px;ime-mode:active;" value="<?=$row['scholar_doctor']?>" maxlength="100">
								<br><b>�����Ұ��</b>
								<input name="lab_career" type="text" class="textfm" style="width:300px;ime-mode:active;" value="<?=$row['lab_career']?>" maxlength="100">
								<br><input type="checkbox" name="career_kind" value="1" <? if($row['career_kind'] == 1) echo "checked"; ?> style="vertical-align:middle">�����
								<input type="checkbox" name="career_kind2" value="1" <? if($row['career_kind2'] == 1) echo "checked"; ?> style="vertical-align:middle">����
								<input type="checkbox" name="career_kind3" value="1" <? if($row['career_kind3'] == 1) echo "checked"; ?> style="vertical-align:middle">�����
								<input type="checkbox" name="career_kind4" value="1" <? if($row['career_kind4'] == 1) echo "checked"; ?> style="vertical-align:middle">�ø����Ի�
								<br><b>6�����̳� ä�뿹������</b>
								<input name="adoption_6months" type="text" class="textfm" style="width:300px;ime-mode:active;" value="<?=$row['adoption_6months']?>" maxlength="100">
<?
	} else {
		if($career_5year) echo "<b>Ÿȸ�� 5���̻� ���߰��</b> : ".$row['career_5year'];
		if($career_item) echo "<br><b>�濵��ȹ,�λ�,�빫�繫,�����ð��</b> : ".$row['career_item'];
		if($scholar_doctor) echo "<br><b>��,�ڻ�</b> : ".$row['scholar_doctor'];
		if($lab_career) echo "<br><b>�����Ұ��</b> : ".$row['lab_career'];
		if($adoption_6months) echo "<br><b>6�����̳� ä�뿹������</b> : ".$row['adoption_6months'];
	}
?>
							</td>
							<td nowrap class="tdrowk" width="96"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���ȯ�氳��</td>
							<td nowrap  class="tdrow" width="300">
<?
	$adoption_env_date = $row['adoption_env_date']; //���ȯ��Ű���
	$adoption_env_completion = $row['adoption_env_completion']; //�Ϸ���
	$increase_staff = $row['increase_staff']; //�����ο�
	$pay_required = $row['pay_required']; //�ҿ���
	$fund_item = $row['fund_item']; //�����׸�
	$adoption_env_etc = $row['adoption_env_etc']; //��Ÿ����
	if($is_damdang == "ok") {
?>
								<b>���ȯ��Ű���</b>
								<input name="adoption_env_date" type="text" class="textfm" style="width:180px;ime-mode:active;" value="<?=$row['adoption_env_date']?>" maxlength="100">
								<br><b>�Ϸ���</b>
								<input name="adoption_env_completion" type="text" class="textfm" style="width:200px;ime-mode:active;" value="<?=$row['adoption_env_completion']?>" maxlength="100">
								<br><b>�����ο�</b>
								<input name="increase_staff" type="text" class="textfm" style="width:40px;ime-mode:active;" value="<?=$row['increase_staff']?>" maxlength="3">��
								<br><b>�ҿ���</b>
								<input name="pay_required" type="text" class="textfm" style="width:200px;ime-mode:active;" value="<?=$row['pay_required']?>" maxlength="100">
								<br><b>�����׸�</b>
								<input name="fund_item" type="text" class="textfm" style="width:200px;ime-mode:active;" value="<?=$row['fund_item']?>" maxlength="100">
								<br><b>��Ÿ����</b>
								<input name="adoption_env_etc" type="text" class="textfm" style="width:200px;ime-mode:active;" value="<?=$row['adoption_env_etc']?>" maxlength="100">
<?
	} else {
		if($adoption_env_date) echo "<b>���ȯ��Ű���</b> : ".$row['adoption_env_date'];
		if($adoption_env_completion) echo "<br><b>�Ϸ���</b> : ".$row['adoption_env_completion'];
		if($increase_staff) echo "<br><b>�����ο�</b> : ".$row['increase_staff'];
		if($pay_required) echo "<br><b>�ҿ���</b> : ".$row['pay_required'];
		if($fund_item) echo "<br><b>�����׸�</b> : ".$row['fund_item'];
		if($adoption_env_etc) echo "<br><b>��Ÿ����</b> : ".$row['adoption_env_etc'];
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��������(����â��)</td>
							<td nowrap  class="tdrow" colspan="">
<?
	//��������������
	$subsidy_type_if = explode(',',$row['subsidy_type_if']);
	$subsidy_type_if_text = array("�����������","������/����Ʈ����","����������","LED����","�׸����۽ý���","�κ�����","�ż���/��������","IT����","���̿�/�ｺ�ɾ�","����","��ΰ���ǰ","ź������������","÷�ܱ׸�����","����ó��");
	//�������ͱ�� ����
	if($row['local_return'] == "1") $local_return = "YES";
	else if($row['local_return'] == "2") $local_return = "NO";
	else $local_return = "";
	//6�����̳� �űԻ�� ä�뿹������
	$adoption_6months_new = $row['adoption_6months_new'];
	if($is_damdang == "ok") {
?>
								<b>��������������</b>
								<br><input type="checkbox" name="subsidy_type_if1" value="1" <? if($subsidy_type_if[0] == 1) echo "checked"; ?> style="vertical-align:middle">�����������
								<input type="checkbox" name="subsidy_type_if2" value="1" <? if($subsidy_type_if[1] == 1) echo "checked"; ?> style="vertical-align:middle">������/����Ʈ����
								<input type="checkbox" name="subsidy_type_if3" value="1" <? if($subsidy_type_if[2] == 1) echo "checked"; ?> style="vertical-align:middle">����������
								<input type="checkbox" name="subsidy_type_if4" value="1" <? if($subsidy_type_if[3] == 1) echo "checked"; ?> style="vertical-align:middle">LED����
								<br>
								<input type="checkbox" name="subsidy_type_if5" value="1" <? if($subsidy_type_if[4] == 1) echo "checked"; ?> style="vertical-align:middle">�׸����۽ý���
								<input type="checkbox" name="subsidy_type_if6" value="1" <? if($subsidy_type_if[5] == 1) echo "checked"; ?> style="vertical-align:middle">�κ�����
								<input type="checkbox" name="subsidy_type_if7" value="1" <? if($subsidy_type_if[6] == 1) echo "checked"; ?> style="vertical-align:middle">�ż���/��������
								<input type="checkbox" name="subsidy_type_if8" value="1" <? if($subsidy_type_if[7] == 1) echo "checked"; ?> style="vertical-align:middle">IT����
								<input type="checkbox" name="subsidy_type_if9" value="1" <? if($subsidy_type_if[8] == 1) echo "checked"; ?> style="vertical-align:middle">���̿�/�ｺ�ɾ�
								<br>
								<input type="checkbox" name="subsidy_type_if10" value="1" <? if($subsidy_type_if[9] == 1) echo "checked"; ?> style="vertical-align:middle">����
								<input type="checkbox" name="subsidy_type_if11" value="1" <? if($subsidy_type_if[10] == 1) echo "checked"; ?> style="vertical-align:middle">��ΰ���ǰ
								<input type="checkbox" name="subsidy_type_if12" value="1" <? if($subsidy_type_if[11] == 1) echo "checked"; ?> style="vertical-align:middle">ź������������
								<input type="checkbox" name="subsidy_type_if13" value="1" <? if($subsidy_type_if[12] == 1) echo "checked"; ?> style="vertical-align:middle">÷�ܱ׸�����
								<input type="checkbox" name="subsidy_type_if14" value="1" <? if($subsidy_type_if[13] == 1) echo "checked"; ?> style="vertical-align:middle">����ó��
								<br><b>�������ͱ�� ����</b>
								<input type="radio" name="local_return" value="1" <? if($row['local_return'] == "1") echo "checked"; ?> style="vertical-align:middle">YES
								<input type="radio" name="local_return" value="2" <? if($row['local_return'] == "2") echo "checked"; ?> style="vertical-align:middle">NO
								<br><b>6�����̳� �űԻ�� ä�뿹������</b>
								<input name="adoption_6months_new" type="text" class="textfm" style="width:200px;ime-mode:active;" value="<?=$row['adoption_6months_new']?>" maxlength="100">
<?
	} else {
		if($row['subsidy_type_if'] && $row['subsidy_type_if'] != ",,,,,,,,,,,,,,") {
			echo "<b>��������������</b> : ";
			for ($i=0; $i<=13; $i++) {
				if($subsidy_type_if[$i]) echo $subsidy_type_if_text[$i].". ";
			}
		}
		if($local_return) echo "<br><b>�������ͱ�� ����</b> : ".$local_return;
		if($adoption_6months_new) echo "<br><b>6�����̳� �űԻ�� ä�뿹������</b> : ".$row['adoption_6months_new'];
	}
?>
							</td>
							<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">ä�����</td>
							<td nowrap  class="tdrow">
<?
	//ä����� �Ƿڿ���
	if($row['employ_execute_yn'] == "1") $employ_execute_yn = "YES";
	else if($row['employ_execute_yn'] == "2") $employ_execute_yn = "NO";
	else $employ_execute_yn = "";
	$employ_execute_age = $row['employ_execute_age']; //���ɴ�
	$employ_execute_sex = $row['employ_execute_sex']; //����
	$employ_execute_date = $row['employ_execute_date']; //ä��ñ�
	$employ_execute_person = $row['employ_execute_person']; //ä���ο�
	$employ_execute_pay = $row['employ_execute_pay']; //�⺻��(����)
	$employ_execute_time = $row['employ_execute_time']; //�ٹ��ð�
	$employ_execute_id = $row['employ_execute_id']; //��ũ��ID
	$employ_execute_pw = $row['employ_execute_pw']; //��й�ȣ
	$employ_execute_etc = $row['employ_execute_etc']; //��Ÿ����
	if($is_damdang == "ok") {
?>
								<b>ä����� �Ƿڿ���</b>
								<input type="radio" name="employ_execute_yn" value="1" <? if($row['employ_execute_yn'] == "1") echo "checked"; ?> style="vertical-align:middle">YES
								<input type="radio" name="employ_execute_yn" value="2" <? if($row['employ_execute_yn'] == "2") echo "checked"; ?> style="vertical-align:middle">NO
								<br>���ɴ�
								<input name="employ_execute_age" type="text" class="textfm" style="width:60px;ime-mode:active;" value="<?=$row['employ_execute_age']?>" maxlength="10">
								����
								<input name="employ_execute_sex" type="text" class="textfm" style="width:40px;ime-mode:active;" value="<?=$row['employ_execute_sex']?>" maxlength="10">
								<br>ä��ñ�
								<input name="employ_execute_date" type="text" class="textfm" style="width:60px;ime-mode:active;" value="<?=$row['employ_execute_date']?>" maxlength="10">
								ä���ο�
								<input name="employ_execute_person" type="text" class="textfm" style="width:40px;ime-mode:active;" value="<?=$row['employ_execute_person']?>" maxlength="10">
								<br>�⺻��(����)
								<input name="employ_execute_pay" type="text" class="textfm" style="width:60px;ime-mode:active;" value="<?=$row['employ_execute_pay']?>" maxlength="10">
								�ٹ��ð�
								<input name="employ_execute_time" type="text" class="textfm" style="width:80px;ime-mode:active;" value="<?=$row['employ_execute_time']?>" maxlength="16">
								<br>��ũ��ID
								<input name="employ_execute_id" type="text" class="textfm" style="width:80px;" value="<?=$row['employ_execute_id']?>" maxlength="16">
								��й�ȣ
								<input name="employ_execute_pw" type="text" class="textfm" style="width:100px;" value="<?=$row['employ_execute_pw']?>" maxlength="16">
								<br>��Ÿ����
								<input name="employ_execute_etc" type="text" class="textfm" style="width:160px;ime-mode:active;" value="<?=$row['employ_execute_etc']?>" maxlength="30">
<?
	} else {
		if($employ_execute_yn) echo "<b>ä����� �Ƿڿ���</b> : ".$employ_execute_yn;
		if($employ_execute_age) echo "<br>���ɴ� : ".$employ_execute_age;
		if($employ_execute_sex) echo "<br>���� : ".$employ_execute_sex;
		if($employ_execute_date) echo "<br>ä��ñ� : ".$employ_execute_date;
		if($employ_execute_person) echo "<br>ä���ο� : ".$employ_execute_person;
		if($employ_execute_pay) echo "<br>�⺻��(����) : ".$employ_execute_pay;
		if($employ_execute_time) echo "<br>�ٹ��ð� : ".$employ_execute_time;
		if($employ_execute_id) echo "<br>��ũ��ID : ".$employ_execute_id;
		if($employ_execute_pw) echo "<br>��й�ȣ : ".$employ_execute_pw;
		if($employ_execute_etc) echo "<br>��Ÿ���� : ".$employ_execute_etc;
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk">
								<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���â������ȹ��
							</td>
							<td nowrap  class="tdrow" colspan="">
<?
	//��������������
	$job_creation_proposal = explode(',',$row['job_creation_proposal']);
	$job_creation_proposal_text = array("�����η�","���ȯ��","���ڸ��Բ�","�ð�������","��������");
	if($is_damdang == "ok") {
?>
								<b>���â������ȹ�� �Ƿڿ���</b>
								<br><input type="checkbox" name="job_creation_proposal1" value="1" <? if($job_creation_proposal[0] == 1) echo "checked"; ?> style="vertical-align:middle">�����η�
								<input type="checkbox" name="job_creation_proposal2" value="1" <? if($job_creation_proposal[1] == 1) echo "checked"; ?> style="vertical-align:middle">���ȯ��
								<!--<input type="checkbox" name="job_creation_proposal3" value="1" <? if($job_creation_proposal[2] == 1) echo "checked"; ?> style="vertical-align:middle">���ڸ��Բ�-->
								<input type="checkbox" name="job_creation_proposal4" value="1" <? if($job_creation_proposal[3] == 1) echo "checked"; ?> style="vertical-align:middle">�ð�������
								<input type="checkbox" name="job_creation_proposal5" value="1" <? if($job_creation_proposal[4] == 1) echo "checked"; ?> style="vertical-align:middle">��������
<?
	} else {
		if($row['job_creation_proposal'] && $row['job_creation_proposal'] != ",,,,,") {
			echo "<b>���â������ȹ�� �Ƿڿ���</b> : ";
			for ($i=0; $i<=4; $i++) {
				if($job_creation_proposal[$i]) echo $job_creation_proposal_text[$i].". ";
			}
		}
	}
?>
							</td>
							<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�ð� ������</td>
							<td nowrap  class="tdrow">
<?
	//15�ð� �̻� 30�ð� �̸� �ٷ��� ä���ȹ
	if($row['worktime_shorten_proposal_yn'] == "1") $worktime_shorten_proposal_yn = "YES";
	else if($row['worktime_shorten_proposal_yn'] == "2") $worktime_shorten_proposal_yn = "NO";
	else $worktime_shorten_proposal_yn = "";
	if($is_damdang == "ok") {
?>
								<b>15�ð� �̻� 30�ð� �̸� �ٷ��� ä���ȹ</b><br>
								<input type="radio" name="worktime_shorten_proposal_yn" value="1" <? if($row['worktime_shorten_proposal_yn'] == "1") echo "checked"; ?> style="vertical-align:middle">YES
								<input type="radio" name="worktime_shorten_proposal_yn" value="2" <? if($row['worktime_shorten_proposal_yn'] == "2") echo "checked"; ?> style="vertical-align:middle">NO
								<br>
								<input name="worktime_shorten_proposal" type="text" class="textfm" style="width:250px;ime-mode:active;" value="<?=$row['worktime_shorten_proposal']?>" maxlength="100">
<?
	} else {
		if($worktime_shorten_proposal_yn) echo "<b>��15~30�ð��̸� �ٷ��� ä���ȹ�ο�</b> : ".$worktime_shorten_proposal_yn."<br>".$row['worktime_shorten_proposal'];
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�޸�<font color="red"></font></td>
							<td nowrap  class="tdrow" colspan="3">
<?
	if($is_damdang == "ok") {
?>
											<textarea name="memo2" class="textfm" style='width:100%;height:38px;word-break:break-all;'><?=$memo2?></textarea>
<?
	} else {
		if($memo2) echo "<pre>".$memo2."</pre>";
	}
?>
							</td>
						</tr>
					</table>
					</div>
					<div style="height:10px;font-size:0px;line-height:0px;"></div>

					<!--��޴� -->
					<table border=0 cellspacing=0 cellpadding=0 style=""> 
						<tr>
							<td id=""> 
								<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='found_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer;">
									<tr> 
										<td><img src="images/g_tab_on_lt.gif"></td> 
										<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style="width:100px;text-align:center;">
											â������
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
					<!--��޴� -->
					<div id="found_div" style="<? if(($row['found_if']==',,,,,,' || !$row['found_if']) && !$row['found_unreg'] && !$row['found_consent_if'] && !$row['first_type'] && !$row['factory_before_type'] && !$row['found_tax_pay'] && ($row['found_tax']==',,' || !$row['found_tax']) && !$row['found_reason'] && ($row['charge_progress']==',,,,' || !$row['charge_progress']) && !$row['charge_progress_etc'] && !$row['charge_progress_reason'] && !$row['charge_progress_factory_scale'] && !$row['factory_site_1000'] && ($row['charge_progress_small']==',,,' || !$row['charge_progress_small']) && !$row['charge_progress_small_etc'] && !$row['charge_progress_small_reason'] && !$row['factory_extend_reduce_yn'] && !$row['factory_extend_reduce'] && !$row['establish_proposal_if']  && !$row['establish_plan_date'] && !$row['establish_area'] && !$row['establish_money'] && ($row['establish_way']===',,,,' || !$row['establish_way']) && ($row['establish_type']==',,,' || !$row['establish_type']) && !$row['establish_type_etc'] && ($row['establish_request']==',,,,,' || !$row['establish_request']) && !$memo3) echo "display:none;" ?>">
					<!-- �Է��� -->
					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
						<tr>
							<td nowrap class="tdrowk" width="120" rowspan=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">â������</td>
							<td nowrap  class="tdrow" width="" rowspan="">
<?
	//â������
	$found_if = explode(',',$row['found_if']);
	$found_if_text = array("�ڰ�����","�Ӵ�","��������","��ȹ����(�������)","������(Y)","�̵��(N)");
	$found_unreg = $row['found_unreg']; //�̵�� ����
	//â����ȹ���ο���
	if($row['found_consent_if'] == "1") $found_consent_if = "YES";
	else if($row['found_consent_if'] == "2") $found_consent_if = "NO";
	else $found_consent_if = "";
	$first_type = $row['first_type']; //�����̷� �� ���� ����� ����
	$factory_before_type = $row['factory_before_type']; //���������� �������
	$found_tax_pay = $row['found_tax_pay']; //����/�ݾ�
	//���ϼ�
	$found_tax = explode(',',$row['found_tax']);
	$found_tax_text = array("����","����/�ݾ�");
	$found_reason = $row['found_reason']; //���λ���
	if($is_damdang == "ok") {
?>
								<input type="checkbox" name="found_if1" value="1" <? if($found_if[0] == 1) echo "checked"; ?> style="vertical-align:middle"><b>�ڰ�����</b>
								<input type="checkbox" name="found_if2" value="1" <? if($found_if[1] == 1) echo "checked"; ?> style="vertical-align:middle"><b>�Ӵ�</b>
								<br>
								<input type="checkbox" name="found_if3" value="1" <? if($found_if[2] == 1) echo "checked"; ?> style="vertical-align:middle"><b>��������</b>
								<input type="checkbox" name="found_if4" value="1" <? if($found_if[3] == 1) echo "checked"; ?> style="vertical-align:middle"><b>��ȹ����(�������)</b>
								<br>
								<input type="checkbox" name="found_if5" value="1" <? if($found_if[4] == 1) echo "checked"; ?> style="vertical-align:middle"><b>������(Y)</b>
								<input type="checkbox" name="found_if6" value="1" <? if($found_if[5] == 1) echo "checked"; ?> style="vertical-align:middle"><b>�̵��(N)</b>
								���� �̵�� ����
								<input name="found_unreg" type="text" class="textfm" style="width:200px;ime-mode:active;" value="<?=$row['found_unreg']?>" maxlength="100">
								<br><b>â����ȹ���ο���</b>
								<input type="radio" name="found_consent_if" value="1" <? if($row['found_consent_if'] == "1") echo "checked"; ?> style="vertical-align:middle">YES
								<input type="radio" name="found_consent_if" value="2" <? if($row['found_consent_if'] == "2") echo "checked"; ?> style="vertical-align:middle">NO
								<br><b>�����̷� �� ���� ����� ����</b>
								<input name="first_type" type="text" class="textfm" style="width:200px;ime-mode:active;" value="<?=$row['first_type']?>" maxlength="100">
								<b>���������� �������</b>
								<input name="factory_before_type" type="text" class="textfm" style="width:200px;ime-mode:active;" value="<?=$row['factory_before_type']?>" maxlength="100">
								<br><b>���ϼ�</b>
								<input type="checkbox" name="found_tax1" value="1" <? if($found_tax[0] == 1) echo "checked"; ?> style="vertical-align:middle">����
								<input type="checkbox" name="found_tax2" value="1" <? if($found_tax[1] == 1) echo "checked"; ?> style="vertical-align:middle">����/�ݾ�
								<input name="found_tax_pay" type="text" class="textfm" style="width:100px;ime-mode:active;" value="<?=$row['found_tax_pay']?>" maxlength="100">
								���λ���
								<input name="found_reason" type="text" class="textfm" style="width:200px;ime-mode:active;" value="<?=$row['found_reason']?>" maxlength="100">
<?
	} else {
		if($row['found_if'] && $row['found_if'] != ",,,,,,") {
			//echo "<b>â������</b> : ";
			for ($i=0; $i<=5; $i++) {
				if($found_if[$i]) echo $found_if_text[$i].". ";
			}
			echo "<br>";
		}
		if($found_unreg) echo "<b>�̵�� ����</b> : ".$found_unreg."<br>";
		if($found_consent_if) echo "<b>â����ȹ���ο���</b> : ".$found_consent_if."<br>";
		if($first_type) echo "<b>�����̷� �� ���� ����� ����</b> : ".$first_type."<br>";
		if($factory_before_type) echo "<b>���������� �������</b> : ".$factory_before_type."<br>";
		if($row['found_tax'] && $row['found_tax'] != ",,") {
			echo "<b>���ϼ�</b> : ";
			for ($i=0; $i<=1; $i++) {
				if($found_tax[$i]) echo $found_tax_text[$i].". ";
			}
		}
		if($found_tax_pay) echo " ".$found_tax_pay;
		if($found_reason) echo " ���λ��� : ".$found_reason;
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">â���δ��</td>
							<td nowrap class="tdrow" colspan="">
<?
	//�δ�� ����(������)
	$charge_progress = explode(',',$row['charge_progress']);
	$charge_progress_text = array("����","��","��������","��Ÿ");
	$charge_progress_etc = $row['charge_progress_etc']; //��Ÿ
	$charge_progress_reason = $row['charge_progress_reason']; //���ش� ����
	$charge_progress_factory_scale = $row['charge_progress_factory_scale']; //�ڰ������� ��ü�Ը�
	//�ڰ��������(����) 1,000�� �̸� ����
	if($row['factory_site_1000'] == "1") $factory_site_1000 = "YES";
	else if($row['factory_site_1000'] == "2") $factory_site_1000 = "NO";
	else $factory_site_1000 = "";
	//�δ�� ����(�һ����)
	$charge_progress_small = explode(',',$row['charge_progress_small']);
	$charge_progress_small_text = array("��������","��ü�긲�ڿ�������","���ߺδ��");
	$charge_progress_small_etc = $row['charge_progress_small_etc']; //��Ÿ
	$charge_progress_small_reason = $row['charge_progress_small_reason']; //���ش� ����
	//�����߰��ż� �� ���࿡ ���� �δ�ݰ��鿩��
	if($row['factory_extend_reduce_yn'] == "1") $factory_extend_reduce_yn = "YES";
	else if($row['factory_extend_reduce_yn'] == "2") $factory_extend_reduce_yn = "NO";
	else $factory_extend_reduce_yn = "";
	$factory_extend_reduce = $row['factory_extend_reduce']; //����
	if($is_damdang == "ok") {
?>
								<b>�δ�� ����(������)</b>
								<input type="checkbox" name="charge_progress1" value="1" <? if($charge_progress[0] == 1) echo "checked"; ?> style="vertical-align:middle">����
								<input type="checkbox" name="charge_progress2" value="1" <? if($charge_progress[1] == 1) echo "checked"; ?> style="vertical-align:middle">��
								<input type="checkbox" name="charge_progress3" value="1" <? if($charge_progress[2] == 1) echo "checked"; ?> style="vertical-align:middle">��������
								<input type="checkbox" name="charge_progress4" value="1" <? if($charge_progress[3] == 1) echo "checked"; ?> style="vertical-align:middle">��Ÿ
								<input name="charge_progress_etc" type="text" class="textfm" style="width:100px;ime-mode:active;" value="<?=$row['charge_progress_etc']?>" maxlength="100">
								<b>���ش� ����</b>
								<input name="charge_progress_reason" type="text" class="textfm" style="width:340px;ime-mode:active;" value="<?=$row['charge_progress_reason']?>" maxlength="100">
								<br><b>�ڰ������� ��ü�Ը�</b>
								<input name="charge_progress_factory_scale" type="text" class="textfm" style="width:60px;ime-mode:active;" value="<?=$row['charge_progress_factory_scale']?>" maxlength="5">��
								<br><b>�ڰ��������(����) 1,000�� �̸� ����</b>
								<input type="radio" name="factory_site_1000" value="1" <? if($row['factory_site_1000'] == "1") echo "checked"; ?> style="vertical-align:middle">YES
								<input type="radio" name="factory_site_1000" value="2" <? if($row['factory_site_1000'] == "2") echo "checked"; ?> style="vertical-align:middle">NO
								<br><b>�δ�� ����(�һ����)</b>
								<input type="checkbox" name="charge_progress_small1" value="1" <? if($charge_progress_small[0] == 1) echo "checked"; ?> style="vertical-align:middle">��������
								<input type="checkbox" name="charge_progress_small2" value="1" <? if($charge_progress_small[1] == 1) echo "checked"; ?> style="vertical-align:middle">��ü�긲�ڿ�������
								<input type="checkbox" name="charge_progress_small3" value="1" <? if($charge_progress_small[2] == 1) echo "checked"; ?> style="vertical-align:middle">���ߺδ��
								<b>���ش� ����</b>
								<input name="charge_progress_small_reason" type="text" class="textfm" style="width:340px;ime-mode:active;" value="<?=$row['charge_progress_small_reason']?>" maxlength="100">
								<br><b>�����߰��ż� �� ���࿡ ���� �δ�ݰ��鿩��</b>
								<input type="radio" name="factory_extend_reduce_yn" value="1" <? if($row['factory_extend_reduce_yn'] == "1") echo "checked"; ?> style="vertical-align:middle">YES
								<input type="radio" name="factory_extend_reduce_yn" value="2" <? if($row['factory_extend_reduce_yn'] == "2") echo "checked"; ?> style="vertical-align:middle">NO
								<b>����</b>
								<input name="factory_extend_reduce" type="text" class="textfm" style="width:340px;ime-mode:active;" value="<?=$row['factory_extend_reduce']?>" maxlength="100">
<?
	} else {
		if($row['charge_progress'] && $row['charge_progress'] != ",,,,") {
			echo "<b>�δ�� ����(������)</b> : ";
			for ($i=0; $i<=4; $i++) {
				if($charge_progress[$i]) echo $charge_progress_text[$i].". ";
			}
		}
		if($charge_progress_etc) echo " ".$charge_progress_etc."<br>";
		if($charge_progress_reason) echo "<b>���ش� ����</b> : ".$charge_progress_reason."<br>";
		if($charge_progress_factory_scale) echo "<b>�ڰ������� ��ü�Ը�</b> : ".$charge_progress_factory_scale."<br>";
		if($factory_site_1000) echo "<b>�ڰ��������(����) 1,000�� �̸� ����</b> : ".$factory_site_1000."<br>";
		if($row['charge_progress_small'] && $row['charge_progress_small'] != ",,,") {
			echo "<b>�δ�� ����(�һ����)</b> : ";
			for ($i=0; $i<=4; $i++) {
				if($charge_progress_small[$i]) echo $charge_progress_small_text[$i].". ";
			}
		}
		if($charge_progress_small_reason) echo " <b>���ش� ����</b> : ".$charge_progress_small_reason."<br>";
		if($factory_extend_reduce_yn) echo "<b>�����߰��ż� �� ���࿡ ���� �δ�ݰ��鿩��</b> : ".$factory_extend_reduce_yn;
		if($factory_extend_reduce) echo " <b>����</b> : ".$factory_extend_reduce."";
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">â�� �� �뿪����<font color="red"></font></td>
							<td nowrap  class="tdrow" colspan="">
<?
	//���弳�� ��ȹ����
	if($row['establish_proposal_if'] == "1") $establish_proposal_if = "YES";
	else if($row['establish_proposal_if'] == "2") $establish_proposal_if = "NO";
	else $establish_proposal_if = "";
	$establish_plan_date = $row['establish_plan_date']; //���������ñ�
	$establish_area = $row['establish_area']; //��������
	$establish_money = $row['establish_money']; //�ݾ�
	//���弳�� ���
	$establish_way = explode(',',$row['establish_way']);
	$establish_way_text = array("�Ӵ�","�ű��ڰ� ���弳��","�������","��2����");
	//���弳�� ����
	$establish_type = explode(',',$row['establish_type']);
	$establish_type_text = array("�������� ����","Ÿ ���� ����","��Ÿ");
	$establish_type_etc = $row['establish_type_etc']; //��Ÿ
	//���弳�� ���� �Ƿڿ���
	$establish_request = explode(',',$row['establish_request']);
	$establish_request_text = array("���Ÿ�缺 �м�","�����ȹ���ۼ�","���弳��","���弳�����ν�û","�����Ͻ�û");
	if($is_damdang == "ok") {
?>
								<b>���弳�� ��ȹ����</b>
								<input type="radio" name="establish_proposal_if" value="1" <? if($row['establish_proposal_if'] == "1") echo "checked"; ?> style="vertical-align:middle">YES
								<input type="radio" name="establish_proposal_if" value="2" <? if($row['establish_proposal_if'] == "2") echo "checked"; ?> style="vertical-align:middle">NO
								<b>���������ñ�</b>
								<input name="establish_plan_date" type="text" class="textfm" style="width:80px;ime-mode:active;" value="<?=$row['establish_plan_date']?>" maxlength="100">
								<b>��������</b>
								<input name="establish_area" type="text" class="textfm" style="width:100px;ime-mode:active;" value="<?=$row['establish_area']?>" maxlength="100">
								<b>�ݾ�</b>
								<input name="establish_money" type="text" class="textfm" style="width:100px;ime-mode:disabled;" onkeyup="checkThousand(this.value, this,'Y')" value="<?=$row['establish_money']?>" maxlength="100">
								<br><b>���弳�� ���</b>
								<input type="checkbox" name="establish_way1" value="1" <? if($establish_way[0] == 1) echo "checked"; ?> style="vertical-align:middle">�Ӵ�
								<input type="checkbox" name="establish_way2" value="1" <? if($establish_way[1] == 1) echo "checked"; ?> style="vertical-align:middle">�ű��ڰ� ���弳��
								<input type="checkbox" name="establish_way3" value="1" <? if($establish_way[2] == 1) echo "checked"; ?> style="vertical-align:middle">�������
								<input type="checkbox" name="establish_way4" value="1" <? if($establish_way[3] == 1) echo "checked"; ?> style="vertical-align:middle">��2����
								<br><b>���弳�� ����</b>
								<input type="checkbox" name="establish_type1" value="1" <? if($establish_type[0] == 1) echo "checked"; ?> style="vertical-align:middle">�������� ����
								<input type="checkbox" name="establish_type2" value="1" <? if($establish_type[1] == 1) echo "checked"; ?> style="vertical-align:middle">Ÿ ���� ����
								<input type="checkbox" name="establish_type3" value="1" <? if($establish_type[2] == 1) echo "checked"; ?> style="vertical-align:middle">��Ÿ
								<input name="establish_type_etc" type="text" class="textfm" style="width:200px;ime-mode:active;" value="<?=$row['establish_type_etc']?>" maxlength="100">
								<br><b>���弳�� ���� �Ƿڿ���</b>
								<input type="checkbox" name="establish_request1" value="1" <? if($establish_request[0] == 1) echo "checked"; ?> style="vertical-align:middle">���Ÿ�缺 �м�<span style="font-size:8px">10.20</span>
								<input type="checkbox" name="establish_request2" value="1" <? if($establish_request[1] == 1) echo "checked"; ?> style="vertical-align:middle">�����ȹ���ۼ�<span style="font-size:8px">3.10</span>
								<input type="checkbox" name="establish_request3" value="1" <? if($establish_request[2] == 1) echo "checked"; ?> style="vertical-align:middle">���弳��<span style="font-size:8px">8.16</span>
								<input type="checkbox" name="establish_request4" value="1" <? if($establish_request[3] == 1) echo "checked"; ?> style="vertical-align:middle">���弳�����ν�û<span style="font-size:8px">2.6</span>
								<input type="checkbox" name="establish_request5" value="1" <? if($establish_request[4] == 1) echo "checked"; ?> style="vertical-align:middle">�����Ͻ�û<span style="font-size:8px">3.6</span>
<?
	} else {
		if($establish_proposal_if) echo "<b>���弳�� ��ȹ����</b> : ".$establish_proposal_if;
		if($establish_plan_date) echo "<b>���������ñ�</b> : ".$establish_plan_date;
		if($establish_area) echo "<br><b>��������</b> : ".$establish_area;
		if($establish_money) echo "<b>�ݾ�</b> : ".$establish_money;
		if($row['establish_way'] && $row['establish_way'] != ",,,,") {
			echo "<br><b>���弳�� ���</b> : ";
			for ($i=0; $i<=3; $i++) {
				if($establish_way[$i]) echo $establish_way_text[$i].". ";
			}
			echo "<br>";
		}
		if($row['establish_type'] && $row['establish_type'] != ",,,") {
			echo "<b>���弳�� ����</b> : ";
			for ($i=0; $i<=2; $i++) {
				if($establish_type[$i]) echo $establish_type_text[$i].". ";
			}
			echo "<br>";
		}
		if($row['establish_request'] && $row['establish_request'] != ",,,,,") {
			echo "<b>���弳�� ���� �Ƿڿ���</b> : ";
			for ($i=0; $i<=4; $i++) {
				if($establish_request[$i]) echo $establish_request_text[$i].". ";
			}
		}
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�޸�<font color="red"></font></td>
							<td nowrap class="tdrow" colspan="">
<?
	if($is_damdang == "ok") {
?>
								<textarea name="memo3" class="textfm" style='width:100%;height:38px;word-break:break-all;'><?=$memo3?></textarea>
<?
	} else {
		if($memo3) echo "<pre>".$memo3."</pre>";
	}
?>
							</td>
						</tr>
					</table>
					</div>
					<div style="height:10px;font-size:0px;line-height:0px;"></div>
					<!--��޴� -->
					<table border=0 cellspacing=0 cellpadding=0 style=""> 
						<tr>
							<td id=""> 
								<table border=0 cellpadding=0 cellspacing=0> 
									<tr> 
										<td><img src="images/g_tab_on_lt.gif"></td> 
										<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center;cursor:pointer;' onclick="var div_display='fund_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}">
											��������
										</td> 
										<td><img src="images/g_tab_on_rt.gif"></td> 
									</tr> 
								</table> 
							</td> 
							<td width="2"></td> 
							<td valign="bottom"></td> 
						</tr> 
					</table>
					<div style="height:2px;font-size:0px" class="bgtr"></div>
					<div style="height:2px;font-size:0px;line-height:0px;"></div>
					<div id="fund_div" style="<? if(($row['fund_kind']==',,,,,,' || !$row['fund_kind']) && !$row['fund_kind_locality'] && !$row['new_fund_scale_site_pay'] && !$row['new_fund_scale_site2_pay'] && !$row['new_fund_scale_site3_pay'] && !$row['new_fund_scale_site4_pay'] && !$row['fund_inside_pay'] && !$row['fund_outside_pay'] && !$row['mou_conclude'] && ($row['fund_type_industry']==',,,,,' || !$row['fund_type_industry']) && !$row['sort_code_number'] && !$row['fund_basic_check1_sales'] && !$row['fund_basic_check2_level'] && !$row['local_tax_yn'] && !$row['fund_etc'] && !$memo4) echo "display:none;" ?>">
					<!-- �Է��� -->
					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
						<tr>
							<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���ڰ�ȹ����<font color="red"></font></td>
							<td nowrap class="tdrow" colspan="" style="padding:10px">
<?
	//������ ����
	$fund_kind = explode(',',$row['fund_kind']);
	$fund_kind_text = array("��������","����","����","��2����","���ͱ��","������");
	$fund_kind_locality = $row['fund_kind_locality']; //����
	$new_fund_scale_site_pay = $row['new_fund_scale_site_pay']; //����(����)
	$new_fund_scale_site2_pay = $row['new_fund_scale_site2_pay']; //���๰
	$new_fund_scale_site3_pay = $row['new_fund_scale_site3_pay']; //����
	$new_fund_scale_site4_pay = $row['new_fund_scale_site4_pay']; //�հ�
	$fund_inside_pay = $row['fund_inside_pay']; //�����ڱ�
	$fund_outside_pay = $row['fund_outside_pay']; //�ܺ��ڱ�
	$mou_conclude = $row['mou_conclude']; //MOU ü��
	//�����ش翩��
	$fund_type_industry = explode(',',$row['fund_type_industry']);
	$fund_type_industry_text = array("�����������","����������ġ����","���ļ��񽺻��","������������","Ưȭ����");
	$sort_code_number = $row['sort_code_number']; //ǥ�ػ�� �з��ڵ��ȣ
	$fund_basic_check1_sales = $row['fund_basic_check1_sales']; //�հ�
	$fund_basic_check2_level = $row['fund_basic_check2_level']; //�հ�
	//���漼 ü������
	if($row['local_tax_yn'] == "1") $local_tax_yn = "YES";
	else if($row['local_tax_yn'] == "2") $local_tax_yn = "NO";
	else $local_tax_yn = "";
	$fund_etc = $row['fund_etc']; //��Ÿ����
	if($is_damdang == "ok") {
?>
								<b>������ ����</b>
								<br><input type="checkbox" name="fund_kind1" value="1" <? if($fund_kind[0] == 1) echo "checked"; ?> style="vertical-align:middle">��������(����
								<input name="fund_kind_locality" type="text" class="textfm" style="width:40px;ime-mode:active;" value="<?=$row['fund_kind_locality']?>" maxlength="50">)
								<input type="checkbox" name="fund_kind2" value="1" <? if($fund_kind[1] == 1) echo "checked"; ?> style="vertical-align:middle">����
								<input type="checkbox" name="fund_kind3" value="1" <? if($fund_kind[2] == 1) echo "checked"; ?> style="vertical-align:middle">����
								<input type="checkbox" name="fund_kind4" value="1" <? if($fund_kind[3] == 1) echo "checked"; ?> style="vertical-align:middle">��2����
								<input type="checkbox" name="fund_kind5" value="1" <? if($fund_kind[4] == 1) echo "checked"; ?> style="vertical-align:middle">���ͱ��
								<input type="checkbox" name="fund_kind6" value="1" <? if($fund_kind[5] == 1) echo "checked"; ?> style="vertical-align:middle">������
								<BR><b>�ű����� �Ը�</b>
								����(����)
								<input name="new_fund_scale_site_pay" type="text" class="textfm" style="width:100px;ime-mode:active;" value="<?=$row['new_fund_scale_site_pay']?>" maxlength="50">
								���๰
								<input name="new_fund_scale_site2_pay" type="text" class="textfm" style="width:100px;ime-mode:active;" value="<?=$row['new_fund_scale_site2_pay']?>" maxlength="50">
								<br>
								����
								<input name="new_fund_scale_site3_pay" type="text" class="textfm" style="width:100px;ime-mode:active;" value="<?=$row['new_fund_scale_site3_pay']?>" maxlength="50">
								�հ�
								<input name="new_fund_scale_site4_pay" type="text" class="textfm" style="width:100px;ime-mode:active;" value="<?=$row['new_fund_scale_site4_pay']?>" maxlength="50">
								<br><b>���ڱ� ���ް�ȹ</b>
								�����ڱ�
								<input name="fund_inside_pay" type="text" class="textfm" style="width:100px;ime-mode:active;" value="<?=$row['fund_inside_pay']?>" maxlength="100">
								�ܺ��ڱ�
								<input name="fund_outside_pay" type="text" class="textfm" style="width:100px;ime-mode:active;" value="<?=$row['fund_outside_pay']?>" maxlength="100">
								<br><b>MOU ü��</b>
								<input name="mou_conclude" type="text" class="textfm" style="width:260px;ime-mode:active;" value="<?=$row['mou_conclude']?>" maxlength="100">
<?
	} else {
		if($row['fund_kind'] && $row['fund_kind'] != ",,,,,,") {
			echo "<b>������ ����</b> : ";
			for ($i=0; $i<=5; $i++) {
				if($fund_kind[$i]) echo $fund_kind_text[$i].". ";
			}
			echo "<br>";
		}
		if($fund_kind_locality) echo "<b>����</b> : ".$fund_kind_locality."<br>";
		if($new_fund_scale_site_pay) echo "<b>����(����)</b> : ".$new_fund_scale_site_pay."<br>";
		if($new_fund_scale_site2_pay) echo "<b>���๰</b> : ".$new_fund_scale_site2_pay."<br>";
		if($new_fund_scale_site3_pay) echo "<b>����</b> : ".$new_fund_scale_site3_pay."<br>";
		if($new_fund_scale_site4_pay) echo "<b>�հ�</b> : ".$new_fund_scale_site4_pay."<br>";
		if($fund_inside_pay) echo "<b>�����ڱ�</b> : ".$fund_inside_pay."<br>";
		if($fund_outside_pay) echo "<b>�ܺ��ڱ�</b> : ".$fund_outside_pay."<br>";
		if($mou_conclude) echo "<b>MOU ü��</b> : ".$mou_conclude;
	}
?>
							</td>
							<td nowrap class="tdrow" colspan="" style="padding:10px">
<?
	if($is_damdang == "ok") {
?>
								<b>�����ش翩��</b>
								<input type="checkbox" name="fund_type_industry1" value="1" <? if($fund_type_industry[0] == 1) echo "checked"; ?> style="vertical-align:middle">�����������
								<input type="checkbox" name="fund_type_industry2" value="1" <? if($fund_type_industry[1] == 1) echo "checked"; ?> style="vertical-align:middle">����������ġ����
								<input type="checkbox" name="fund_type_industry3" value="1" <? if($fund_type_industry[2] == 1) echo "checked"; ?> style="vertical-align:middle">���ļ��񽺻��
								<br><input type="checkbox" name="fund_type_industry4" value="1" <? if($fund_type_industry[3] == 1) echo "checked"; ?> style="vertical-align:middle">������������
								<input type="checkbox" name="fund_type_industry5" value="1" <? if($fund_type_industry[4] == 1) echo "checked"; ?> style="vertical-align:middle">Ưȭ����
								<br><b>ǥ�ػ�� �з��ڵ��ȣ</b>
								<input name="sort_code_number" type="text" class="textfm" style="width:80px;ime-mode:active;" value="<?=$row['sort_code_number']?>" maxlength="100">
								������������
								<br><b>�⺻üũ����</b>
								�ֱ�3�����
								<input name="fund_basic_check1_sales" type="text" class="textfm" style="width:100px;ime-mode:active;" value="<?=$row['fund_basic_check1_sales']?>" maxlength="100">
								�ſ���
								<input name="fund_basic_check2_level" type="text" class="textfm" style="width:100px;ime-mode:active;" value="<?=$row['fund_basic_check2_level']?>" maxlength="100">
								<br>
								<b>���漼 ü������</b>
								<input type="radio" name="local_tax_yn" value="1" <? if($row['local_tax_yn'] == "1") echo "checked"; ?> style="vertical-align:middle">YES
								<input type="radio" name="local_tax_yn" value="2" <? if($row['local_tax_yn'] == "2") echo "checked"; ?> style="vertical-align:middle">NO
								<br><b>��Ÿ����</b>
								<input name="fund_etc" type="text" class="textfm" style="width:260px;ime-mode:active;" value="<?=$row['fund_etc']?>" maxlength="100">
<?
	} else {
		if($row['fund_type_industry'] && $row['fund_type_industry'] != ",,,,,") {
			echo "<b>�����ش翩��</b> : ";
			for ($i=0; $i<=4; $i++) {
				if($fund_type_industry[$i]) echo $fund_type_industry_text[$i].". ";
			}
		}
		if($sort_code_number) echo "<b>ǥ�ػ�� �з��ڵ��ȣ</b> : ".$sort_code_number."<br>";
		if($fund_basic_check1_sales) echo "<b>�ֱ�3�����</b> : ".$fund_basic_check1_sales."<br>";
		if($fund_basic_check2_level) echo "<b>�ſ���</b> : ".$fund_basic_check2_level."<br>";
		if($local_tax_yn) echo "<b>���漼 ü������</b> : ".$local_tax_yn."<br>";
		if($fund_etc) echo "<b>��Ÿ����</b> : ".$fund_etc;
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�޸�<font color="red"></font></td>
							<td nowrap class="tdrow" colspan="3">
<?
	if($is_damdang == "ok") {
?>
											<textarea name="memo4" class="textfm" style='width:100%;height:38px;word-break:break-all;'><?=$memo4?></textarea>
<?
	} else {
		if($memo4) echo "<pre>".$memo4."</pre>";
	}
?>
							</td>
						</tr>
					</table>
					</div>
					<div style="height:10px;font-size:0px;line-height:0px;"></div>

					<!--��޴� -->
					<table border=0 cellspacing=0 cellpadding=0 style=""> 
						<tr>
							<td id=""> 
								<table border=0 cellpadding=0 cellspacing=0> 
									<tr> 
										<td><img src="images/g_tab_on_lt.gif"></td> 
										<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center;cursor:pointer;' onclick="var div_display='industrial_disaster_rate_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}">
											�������
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
					<!--��޴� -->
					<div id="industrial_disaster_rate_div" style="<? if(!$row['industrial_disaster_rate'] && !$row['factory_split'] && !$row['office_rate'] && !$row['office_person'] && !$row['factory_rate'] && !$row['factory_person'] && !$row['lab_rate'] && !$row['lab_person'] && !$row['etc_rate'] && !$row['etc_person'] && !$row['manufacture_process']) echo "display:none;" ?>">
					<!-- �Է��� -->
					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
						<tr>
							<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�������</td>
							<td nowrap class="tdrow" width="">
<?
	$industrial_disaster_rate = $row['industrial_disaster_rate']; //�����������
	//�繫��/����/������ �и� ����
	if($row['factory_split'] == "1") $factory_split = "YES";
	else if($row['factory_split'] == "2") $factory_split = "NO";
	else $factory_split = "";
	$office_rate = $row['office_rate']; //�繫��(%)
	$office_person = $row['office_person']; //�繫��(��)
	$factory_rate = $row['factory_rate']; //���嵿(%)
	$factory_person = $row['factory_person']; //���嵿(��)
	$lab_rate = $row['lab_rate']; //������(%)
	$lab_person = $row['lab_person']; //������(��)
	$etc_rate = $row['etc_rate']; //��Ÿ(%)
	$etc_person = $row['etc_person']; //��Ÿ(��)
	$manufacture_process = $row['manufacture_process']; //��������
	if($is_damdang == "ok") {
?>
								<b>�����������</b>
								<input name="industrial_disaster_rate" type="text" class="textfm" style="width:50px;ime-mode:active;" value="<?=$row['industrial_disaster_rate']?>" maxlength="7">%
								(��Ÿ ������� : �ǳ�, ���̺�, �ֹ�, ����, IT����Ʈ���� ��)
								<br>
								<b>�繫��/����/������ �и� ����</b>
								<input type="radio" name="factory_split" value="1" <? if($row['factory_split'] == "1") echo "checked"; ?> style="vertical-align:middle">YES
								<input type="radio" name="factory_split" value="2" <? if($row['factory_split'] == "2") echo "checked"; ?> style="vertical-align:middle">NO
								<br>
								<b>�繫��</b>
								<input name="office_rate" type="text" class="textfm" style="width:40px;ime-mode:active;" value="<?=$row['office_rate']?>" maxlength="3">%
								<input name="office_person" type="text" class="textfm" style="width:35px;ime-mode:active;" value="<?=$row['office_person']?>" maxlength="3">��
								<b>���嵿</b>
								<input name="factory_rate" type="text" class="textfm" style="width:40px;ime-mode:active;" value="<?=$row['factory_rate']?>" maxlength="3">%
								<input name="factory_person" type="text" class="textfm" style="width:35px;ime-mode:active;" value="<?=$row['factory_person']?>" maxlength="3">��
								<b>������</b>
								<input name="lab_rate" type="text" class="textfm" style="width:40px;ime-mode:active;" value="<?=$row['lab_rate']?>" maxlength="3">%
								<input name="lab_person" type="text" class="textfm" style="width:35px;ime-mode:active;" value="<?=$row['lab_person']?>" maxlength="3">��
								<b>��Ÿ</b>
								<input name="etc_rate" type="text" class="textfm" style="width:40px;ime-mode:active;" value="<?=$row['etc_rate']?>" maxlength="3">%
								<input name="etc_person" type="text" class="textfm" style="width:35px;ime-mode:active;" value="<?=$row['etc_person']?>" maxlength="3">��
<?
	} else {
		if($industrial_disaster_rate) echo "<b>�����������</b> : ".$industrial_disaster_rate." %<br>";
		if($factory_split) echo "<b>�繫��/����/������ �и� ����</b> : ".$factory_split."<br>";
		if($office_rate) echo "<b>�繫��</b> : ".$office_rate." % ";
		if($office_person) echo "".$office_person." ��";
		if($factory_rate) echo "<b>���嵿</b> : ".$factory_rate." % ";
		if($factory_person) echo "".$factory_person." ��";
		if($lab_rate) echo "<b>������</b> : ".$lab_rate." % ";
		if($lab_person) echo "".$lab_person." ��";
		if($etc_rate) echo "<b>��Ÿ</b> : ".$etc_rate." % ";
		if($etc_person) echo "".$etc_person." ��";
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��������<font color="red"></font></td>
							<td nowrap  class="tdrow" colspan="">
<?
	if($is_damdang == "ok") {
?>
								<textarea name="manufacture_process" class="textfm" style='width:100%;height:38px;word-break:break-all;'><?=$row['manufacture_process']?></textarea>
<?
	} else {
		if($manufacture_process) echo $manufacture_process;
	}
?>
							</td>
						</tr>
					</table>
					</div>
					<div style="height:10px;font-size:0px;line-height:0px;"></div>
					<!--��޴� -->
					<table border=0 cellspacing=0 cellpadding=0 style=""> 
						<tr>
							<td id=""> 
								<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='use_program_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer;">
									<tr> 
										<td><img src="images/g_tab_on_lt.gif"></td> 
										<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
											���α׷�
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
					<!--��޴� -->
					<div id="use_program_div" style="<? if(($row['easynomu_request']==',,,' || !$row['easynomu_request']) && !$row['setting_pay'] && !$row['month_pay'] && !$row['easynomu_etc'] && !$memo5) echo "display:none;" ?>">
					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
						<tr>
							<td class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�����빫<font color="red"></font></td>
							<td class="tdrow" width="">
<?
	$use_program = $row['use_program']; //��� ���α׷�
	$use_pay = $row['use_pay']; //���ݾ�
	//�ٷΰ�༭ ����
	if($row['contract_employment'] == "1") $contract_employment = "YES";
	else if($row['contract_employment'] == "2") $contract_employment = "NO";
	else $contract_employment = "";
	//�����Ģ��/�޿����� �ʿ� ����
	if($row['rules_pay'] == "1") $rules_pay = "YES";
	else if($row['rules_pay'] == "2") $rules_pay = "NO";
	else $rules_pay = "";
	if($is_damdang == "ok") {
?>
								<b>���� ��� ���α׷�</b>
								<input name="use_program" type="text" class="textfm" style="width:200px;ime-mode:active;" value="<?=$row['use_program']?>" maxlength="100">
								<br>���ݾ�
								<input name="use_pay" type="text" class="textfm" style="width:100px;ime-mode:active;" value="<?=$row['use_pay']?>" maxlength="100">
								<br>
								<b>�ٷΰ�༭ ����</b>
								<input type="radio" name="contract_employment" value="1" <? if($row['contract_employment'] == "1") echo "checked"; ?> style="vertical-align:middle">YES
								<input type="radio" name="contract_employment" value="2" <? if($row['contract_employment'] == "2") echo "checked"; ?> style="vertical-align:middle">NO
								<br><b>�����Ģ��/�޿����� �ʿ� ����</b>
								<input type="radio" name="rules_pay" value="1" <? if($row['rules_pay'] == "1") echo "checked"; ?> style="vertical-align:middle">YES
								<input type="radio" name="rules_pay" value="2" <? if($row['rules_pay'] == "2") echo "checked"; ?> style="vertical-align:middle">NO
<?
	} else {
		if($use_program) echo "<b>��� ���α׷�</b> : ".$use_program."<br>";
		if($use_pay) echo "<b>���ݾ�</b> : ".$use_pay."<br>";
		if($contract_employment) echo "<b>�ٷΰ�༭ ����</b> : ".$contract_employment."<br>";
		if($rules_pay) echo "<b>�����Ģ��/�޿����� �ʿ� ����</b> : ".$rules_pay;
	}
?>
							</td>
							<td class="tdrow" width="">
<?
	//�����빫 �Ƿ�
	$easynomu_request = explode(',',$row['easynomu_request']);
	$easynomu_request_text = array("�⺻��ġ","�޿����̺�����","�����Ģ���ۼ�");
	//���ú�
	if($row['setting_pay']) $setting_pay = number_format($row['setting_pay']);
	else $setting_pay = "";
	//������
	if($row['month_pay']) $month_pay = number_format($row['month_pay']); 
	else $month_pay = "";
	$easynomu_etc = $row['easynomu_etc']; //��Ÿ����
	if($is_damdang == "ok") {
?>
								<b>�����빫 �Ƿ�</b><br>
								<input type="checkbox" name="easynomu_request1"  value="1" <? if($easynomu_request[0] == 1) echo "checked"; ?> style="vertical-align:middle">�⺻��ġ
								<input type="checkbox" name="easynomu_request2" value="1" <? if($easynomu_request[1] == 1) echo "checked"; ?> style="vertical-align:middle">�޿����̺�����
								<input type="checkbox" name="easynomu_request3" value="1" <? if($easynomu_request[2] == 1) echo "checked"; ?> style="vertical-align:middle">�����Ģ���ۼ�
								<br><b>���ú�</b>
								<input name="setting_pay" type="text" class="textfm" style="width:80px;ime-mode:disabled;" onkeyup="checkThousand(this.value, this,'Y')" value="<?=$setting_pay?>" maxlength="20">
								<b>������</b>
								<input name="month_pay" type="text" class="textfm" style="width:80px;ime-mode:disabled;" onkeyup="checkThousand(this.value, this,'Y')" value="<?=$month_pay?>" maxlength="20">
								<br><b>��Ÿ����</b>
								<input name="easynomu_etc" type="text" class="textfm" style="width:200px;ime-mode:active;" value="<?=$row['easynomu_etc']?>" maxlength="100">
<?
	} else {
		if($row['easynomu_request'] && $row['easynomu_request'] != ",,,") {
			echo "<b>�����빫 �Ƿ�</b> : ";
			for ($i=0; $i<=2; $i++) {
				if($easynomu_request[$i]) echo $easynomu_request_text[$i].". ";
			}
			echo "<br>";
		}
		if($setting_pay) echo "<b>���ú�</b> : ".$setting_pay."<br>";
		if($month_pay) echo "<b>������</b> : ".$month_pay."<br>";
		if($easynomu_etc) echo "<b>��Ÿ����</b> : ".$easynomu_etc;
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�޸�<font color="red"></font></td>
							<td nowrap class="tdrow"  colspan="2">
<?
	if($is_damdang == "ok") {
?>
								<textarea name="memo5" class="textfm" style='width:100%;height:38px;word-break:break-all;'><?=$memo5?></textarea>
<?
	} else {
		if($memo5) echo "<pre>".$memo5."</pre>";
	}
?>
							</td>
						</tr>
					</table>
				</div><!--���α׷� ����-->
			</div><!--������ �Ƿڼ� ����-->
			<div style="height:10px;font-size:0px;line-height:0px;"></div>

					<a name="16001"><!--��å�ڱ�--></a>
					<table border="0" cellspacing="0" cellpadding="0" style="">
						<tr>
							<td id=""> 
								<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='policy_fund_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer;">
									<tr> 
										<td><img src="images/so_tab_on_lt.gif"></td>
										<td background="images/so_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100px;text-align:center'> 
											<span>��å�ڱ�</span>
										</td> 
										<td><img src="images/so_tab_on_rt.gif"></td>
									</tr> 
								</table> 
							</td> 
							<td width="2"></td> 
							<td valign="bottom" style="font-weight:bold;">
<?
	if($is_damdang == "ok") {
?>
								<input type="checkbox" name="policy_fund_chk" value="1" <? if($row['policy_fund_chk'] == 1) echo "checked"; ?> style="vertical-align:middle">��å�ڱ� �Ƿ� �� üũ �Ͻʽÿ�.
								<span style="color:red;">(��å�ڱ� ���� �Է� �� �� üũ �� ���� ���� �ʽ��ϴ�.)</span>
<?
	}
?>
							</td> 
						</tr> 
					</table>
					<div style="height:2px;font-size:0px" class="botr"></div>
					<div style="height:2px;font-size:0px;line-height:0px;"></div>
					<!--���� DIV ����-->
					<div  id="policy_fund_div" style="<? if($w && $row['policy_fund_chk'] != "1") echo "display:none"; ?>">
<?
	if($w == "u") {
		//��å�ڱ�DB
		$sql_policy = " select * from policy_fund where com_code='$com_code' ";
		$row_policy = sql_fetch($sql_policy);
		$sql_policy_opt = " select * from policy_fund_opt where com_code='$com_code' ";
		$row_policy_opt = sql_fetch($sql_policy_opt);
	}
	$area = $row_policy['area']; //����
	$reg_factory_array = array("","��","��");
	$reg_factory = $row_policy['reg_factory'];
	$reg_factory_text = $reg_factory_array[$reg_factory];
?>
					<!-- �Է��� -->
					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1">
						<tr>
							<td nowrap class="tdrowk" width="96"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����</td>
							<td nowrap  class="tdrow" width="170">
<? if($is_damdang == "ok") { ?>
								<input name="area" type="text" class="textfm" style="width:120px;" value="<?=$row_policy['area']?>" maxlength="50">
<?
	} else {
		if($area) echo $area;
	}
?>
							</td>
							<td nowrap class="tdrowk" width="96"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��������</td>
							<td nowrap class="tdrow">
<? if($is_damdang == "ok") { ?>
								<select name="reg_factory" class="selectfm" onchange="">
									<option value="">����</option>
									<option value="1" <? if($row_policy['reg_factory'] == 1) echo "selected"; ?>>��</option>
									<option value="2" <? if($row_policy['reg_factory'] == 2) echo "selected"; ?>>��</option>
								</select>
<?
	} else {
		if($reg_factory_text) echo $reg_factory_text;
	}
?>
							</td>
							<td nowrap class="tdrowk" width="96"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�ſ���</td>
							<td nowrap  class="tdrow">
								������
<? if($is_damdang == "ok") { ?>
								<input name="credit_com" type="text" class="textfm" style="width:50px;ime-mode:disabled;" value="<?=$row_policy['credit_com']?>" maxlength="12">
<?
	} else {
		if($row_policy['credit_com']) echo ": ".$row_policy['credit_com'];
	}
?>
								���ε��
<? if($is_damdang == "ok") { ?>
								<input name="credit_per" type="text" class="textfm" style="width:50px;ime-mode:disabled;" value="<?=$row_policy['credit_per']?>" maxlength="12">
<?
	} else {
		if($row_policy['credit_per']) echo ": ".$row_policy['credit_per'];
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">������Ȳ<font color="red"></font></td>
							<td nowrap  class="tdrow">
<? if($is_damdang == "ok") { ?>
								<select name="property" class="selectfm" onchange="" style="width:60px">
									<option value="">����</option>
									<option value="1" <? if($row_policy['property'] == 1) echo "selected"; ?>>�ڰ�</option>
									<option value="2" <? if($row_policy['property'] == 2) echo "selected"; ?>>�Ӵ�</option>
									<option value="3" <? if($row_policy['property'] == 3) echo "selected"; ?>>����</option>
									<option value="4" <? if($row_policy['property'] == 4) echo "selected"; ?>>��Ÿ</option>
								</select>
<?
	} else {
		$property_array = array("","�ڰ�","�Ӵ�","����","��Ÿ");
		$property = $row_policy['property'];
		$property_text = $property_array[$property];
		if($property_text) echo $property_text;
	}
?>
							</td>
							<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�Ӵ볻��<font color="red"></font></td>
							<td nowrap  class="tdrow">
								����
<? if($is_damdang == "ok") { ?>
								<input name="charter" type="text" class="textfm" style="width:70px;" value="<?=$row_policy['charter']?>" maxlength="12">
<?
	} else {
		if($row_policy['charter']) echo ": ".$row_policy['charter'];
	}
?>
								����
<? if($is_damdang == "ok") { ?>
								<input name="rent_month" type="text" class="textfm" style="width:70px;" value="<?=$row_policy['rent_month']?>" maxlength="12">
<?
	} else {
		if($row_policy['rent_month']) echo ": ".$row_policy['rent_month'];
	}
?>
							</td>
							<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���<font color="red"></font></td>
							<td nowrap  class="tdrow">
								����
<? if($is_damdang == "ok") { ?>
								<input name="area_site" type="text" class="textfm" style="width:35px;" value="<?=$row_policy['area_site']?>" maxlength="6">
<?
	} else {
		if($row_policy['area_site']) echo ": ".$row_policy['area_site'];
	}
?>
								���๰
<? if($is_damdang == "ok") { ?>
								<input name="area_building" type="text" class="textfm" style="width:35px;" value="<?=$row_policy['area_building']?>" maxlength="6">
<?
	} else {
		if($row_policy['area_building']) echo ": ".$row_policy['area_building'];
	}
?>
								����
<? if($is_damdang == "ok") { ?>
								<input name="area_facility" type="text" class="textfm" style="width:35px;" value="<?=$row_policy['area_facility']?>" maxlength="6">
<?
	} else {
		if($row_policy['area_facility']) echo ": ".$row_policy['area_facility'];
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���޸�</td>
							<td nowrap  class="tdrow" colspan="5">
								<textarea name="memo_policy" class="textfm" style='width:100%;height:70px;word-break:break-all;' itemname="����" required><?=$row_policy[memo]?></textarea>
							</td>
						</tr>
					</table>
					<div style="height:2px;font-size:0px;line-height:0px;"></div>

					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
						<tr>
							<td nowrap class="tdrowk_center" width="96">������Ȳ</td>
							<td nowrap class="tdrow" style="padding:" width="" colspan="8">
								<b>�ֱ�3�� ������Ȳ</b>
								2012
<? if($is_damdang == "ok") { ?>
								<input name="sale_2012" type="text" class="textfm" style="width:100px;" value="<?=$row_policy['sale_2012']?>" maxlength="12">
<?
	} else {
		if($row_policy['sale_2012']) echo ": ".$row_policy['sale_2012'];
	}
?>
								2013
<? if($is_damdang == "ok") { ?>
								<input name="sale_2013" type="text" class="textfm" style="width:100px;" value="<?=$row_policy['sale_2013']?>" maxlength="12">
<?
	} else {
		if($row_policy['sale_2013']) echo ": ".$row_policy['sale_2013'];
	}
?>
								2014
<? if($is_damdang == "ok") { ?>
								<input name="sale_2014" type="text" class="textfm" style="width:100px;" value="<?=$row_policy['sale_2014']?>" maxlength="12">
<?
	} else {
		if($row_policy['sale_2014']) echo ": ".$row_policy['sale_2014'];
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk_center" width="" rowspan="4">���<br>���⳻��</td>
							<td nowrap class="tdrowk_center" width="">�ְ�</td>
							<td nowrap class="tdrowk_center" width="114">�⺸</td>
							<td nowrap class="tdrowk_center" width="114">�ź�</td>
							<td nowrap class="tdrowk_center" width="114">�������</td>
							<td nowrap class="tdrowk_center" width="114">������</td>
							<td nowrap class="tdrowk_center" width="114">���ڱ�</td>
							<td nowrap class="tdrowk_center" width="114">���ڱ�</td>
							<td nowrap class="tdrowk_center" width="114">�߱�û</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk_center">����</td>
<?
	for($i=1;$i<=7;$i++) {
?>
							<td nowrap class="tdrow_center" width="">
<? if($is_damdang == "ok") { ?>
								<input name="bank_<?=$i?>" type="text" class="textfm" style="width:100%;" value="<?=$row_policy_opt['bank_'.$i]?>" maxlength="12">
<?
		} else {
			if($row_policy_opt['bank_'.$i]) echo $row_policy_opt['bank_'.$i];
		}
?>
							</td>
<?
	}
?>
						</tr>
						<tr>
							<td nowrap class="tdrowk_center">�ݾ�</td>
<?
	for($i=1;$i<=7;$i++) {
?>
							<td nowrap class="tdrow_center" width="">
<? if($is_damdang == "ok") { ?>
								<input name="amount_<?=$i?>" type="text" class="textfm" style="width:100%;" value="<?=$row_policy_opt['amount_'.$i]?>" maxlength="12">
<?
		} else {
			if($row_policy_opt['amount_'.$i]) echo $row_policy_opt['amount_'.$i];
		}
?>
							</td>
<?
	}
?>
						</tr>
						<tr>
							<td nowrap class="tdrowk_center">�ݸ�</td>
<?
	for($i=1;$i<=7;$i++) {
?>
							<td nowrap class="tdrow_center" width="">
<? if($is_damdang == "ok") { ?>
								<input name="interst_<?=$i?>" type="text" class="textfm" style="width:100%;" value="<?=$row_policy_opt['interst_'.$i]?>" maxlength="12">
<?
		} else {
			if($row_policy_opt['interst_'.$i]) echo $row_policy_opt['interst_'.$i];
		}
?>
							</td>
<?
	}
?>
						</tr>
					</table>
					<div style="height:2px;font-size:0px"></div>

					<!-- �Է��� -->
					<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
						<tr>
							<td nowrap class="tdrowk_center" width="96" rowspan="6">������<br>���⳻��</td>
							<td nowrap class="tdrowk_center" width="">����</td>
<?
	for($i=1;$i<=4;$i++) {
?>
							<td nowrap class="tdrow" width="">
<? if($is_damdang == "ok") { ?>
								<input name="lend_bank_<?=$i?>" type="text" class="textfm" style="width:100%;" value="<?=$row_policy_opt['lend_bank_'.$i]?>" maxlength="12">
<?
		} else {
			if($row_policy_opt['lend_bank_'.$i]) echo $row_policy_opt['lend_bank_'.$i];
		}
?>
							</td>
<?
	}
?>
						</tr>
						<tr>
							<td nowrap class="tdrowk_center">���ⱸ��</td>
<?
	$lend_kind_array = array("","�ü�","����","����","����","�����ڱ�","��Ÿ");
	$lend_kind_text = array(); 
	for($i=1;$i<=4;$i++) {
?>
							<td nowrap class="tdrow" width="192">
<? if($is_damdang == "ok") { ?>
								<select name="lend_kind_<?=$i?>" class="selectfm" onchange="" style="width:100%">
									<option value="">����</option>
									<option value="1" <? if($row_policy_opt['lend_kind_'.$i] == 1) echo "selected"; ?>>�ü�</option>
									<option value="2" <? if($row_policy_opt['lend_kind_'.$i] == 2) echo "selected"; ?>>����</option>
									<option value="3" <? if($row_policy_opt['lend_kind_'.$i] == 3) echo "selected"; ?>>����</option>
									<option value="4" <? if($row_policy_opt['lend_kind_'.$i] == 4) echo "selected"; ?>>����</option>
									<option value="5" <? if($row_policy_opt['lend_kind_'.$i] == 5) echo "selected"; ?>>�����ڱ�</option>
									<option value="6" <? if($row_policy_opt['lend_kind_'.$i] == 6) echo "selected"; ?>>��Ÿ</option>
								</select>
<?
		} else {
			$lend_kind = $row_policy_opt['lend_kind_'.$i];
			$lend_kind_text[$i] = $lend_kind_array[$lend_kind];
			if($lend_kind_text[$i]) echo $lend_kind_text[$i];
		}
?>
							</td>
<?
	}
?>
						</tr>
						<tr>
							<td nowrap class="tdrowk_center">�ݾ�</td>
<?
	for($i=1;$i<=4;$i++) {
?>
							<td nowrap class="tdrow" width="">
<? if($is_damdang == "ok") { ?>
								<input name="lend_amount_<?=$i?>" type="text" class="textfm" style="width:100%;" value="<?=$row_policy_opt['lend_amount_'.$i]?>" maxlength="12">
<?
		} else {
			if($row_policy_opt['lend_amount_'.$i]) echo $row_policy_opt['lend_amount_'.$i];
		}
?>
							</td>
<?
	}
?>
						</tr>
						<tr>
							<td nowrap class="tdrowk_center">�ݸ�</td>
<?
	for($i=1;$i<=4;$i++) {
?>
							<td nowrap class="tdrow" width="">
<? if($is_damdang == "ok") { ?>
								<input name="lend_interst_<?=$i?>" type="text" class="textfm" style="width:100%;" value="<?=$row_policy_opt['lend_interst_'.$i]?>" maxlength="12">
<?
		} else {
			if($row_policy_opt['lend_interst_'.$i]) echo $row_policy_opt['lend_interst_'.$i];
		}
?>
							</td>
<?
	}
?>
						</tr>
						<tr>
							<td nowrap class="tdrowk_center">�㺸����</td>
							<td nowrap class="tdrow" width="" colspan="4">
<? if($is_damdang == "ok") { ?>
								<input name="security" type="text" class="textfm" style="width:100%;" value="<?=$row_policy_opt['security']?>" maxlength="90">
<?
	} else {
		if($row_policy_opt['security']) echo $row_policy_opt['security'];
	}
?>
							</td>
						</tr>
						<tr>
							<td nowrap class="tdrowk_center">�ְŷ�����</td>
							<td nowrap class="tdrow" width="" colspan="4">
<? if($is_damdang == "ok") { ?>
								<input name="primary_bank" type="text" class="textfm" style="width:100%;" value="<?=$row_policy_opt['primary_bank']?>" maxlength="90">
<?
	} else {
		if($row_policy_opt['primary_bank']) echo $row_policy_opt['primary_bank'];
	}
?>
							</td>
						</tr>
					</table>
					<div style="height:2px;font-size:0px;line-height:0px;"></div>
					<!--��޴� -->

					<!-- �Է��� -->
					<table width="100%" height="" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layput:fixed">
						<tr>
							<td nowrap class="tdrowk_center" width="96" rowspan="">�����Ƿڱݾ�</td>
							<td nowrap  class="tdrow" width="" colspan="">
								��å�ڱ�
<? if($is_damdang == "ok") { ?>
								<input name="loan_policy" type="text" class="textfm" style="width:100px;" value="<?=$row_policy['loan_policy']?>" maxlength="12" onKeyPress="">
<?
	} else {
		if($row_policy_opt['loan_policy']) echo ": ".$row_policy_opt['loan_policy'];
	}
?>
								�����ڱ�
<? if($is_damdang == "ok") { ?>
								<input name="loan_finance" type="text" class="textfm" style="width:100px;" value="<?=$row_policy['loan_finance']?>" maxlength="12" onKeyPress="">
<?
	} else {
		if($row_policy_opt['loan_finance']) echo ": ".$row_policy_opt['loan_finance'];
	}
?>
								��Ÿ
<? if($is_damdang == "ok") { ?>
								<input name="loan_etc" type="text" class="textfm" style="width:100px;" value="<?=$row_policy['loan_etc']?>" maxlength="12" onKeyPress="">
<?
	} else {
		if($row_policy_opt['loan_etc']) echo ": ".$row_policy_opt['loan_etc'];
	}
?>
							</td>
						</tr>
					</table>
					</div><!--���� DIV ���� ����-->
<?
}
//���»� ���� IF�� end
?>
				</div><!--�μ⿵�� ����-->
					<input type="hidden" name="prv_dojang_img" value="<?=$row['dojang_img']?>">
					<input type="hidden" name="prv_cust_tell"  value="<?=$row['com_tel']?>">
					<input type="hidden" name="prv_user_id" value="<?=$row['t_insureno']?>">
					<input type="hidden" name="url" value="./com_view.php">
					<input type="hidden" name="id" value="<?=$id?>">
					<input type="hidden" name="page" value="<?=$page?>">
					<input type="hidden" name="is_damdang" value="<?=$is_damdang?>">
					<input type="hidden" name="mb_id" value="<?=$member['mb_id']?>">
					<input type="hidden" name="qstr" value="<?=$qstr?>">
					<input type="hidden" name="stx_qstr" value="<?=$stx_qstr?>">
				</div>
				<div id="tab2" style="display:none">
				</div>
				<div style="height:20px;font-size:0px"></div>
				<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layput:fixed">
					<tr>
						<td align="center">
							<!--<div style="color:red;width:296px;text-align:center;">��å�ڱ��Ƿ� �� üũ �ʼ��Դϴ�.</div>-->
<?
if($v == "write") {
?>
							<table border="0" cellpadding="0" cellspacing="0" style="display:inline;" id="btn_save"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="<?=$url_save?>" target="">�� ��</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table>
<?
} else {
?>
							<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="<?=$url_modify?>" target="">�� ��</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table>
<?
}
?>
							<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./client_list.php?search_ok=branch&page=<?=$page?>&<?=$qstr?>&<?=$stx_qstr?>" target="">�� ��</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
							<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="<?=$url_print_request?>" target="">�Ƿڼ����</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
<?
if($w == "u") {
	//���� ���� : �ְ������, �ӿ���
	if($member['mb_level'] == 10 || $member['mb_id'] == "kcmc0331") {
?>
							<table border="0" cellpadding="0" cellspacing="0" style="display:inline;cursor:pointer;" onclick="del_com('<?=$page?>', '<?=$id?>');"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" style="padding-top:3px;letter-spacing:-1px;" nowrap>����</td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
<? } else { ?>
							<table border="0" cellpadding="0" cellspacing="0" style="display:inline;cursor:pointer;" onclick="del_request('<?=$page?>', '<?=$id?>');"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" style="padding-top:3px;letter-spacing:-1px;" nowrap>������û</td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
<? } ?>
							<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./client_process_view.php?w=<?=$w?>&id=<?=$id?>" target="">����ó����Ȳ</a></td><td><img src=images/btn_rt.gif></td><td width="2"></td></tr></table>
<? } ?>
<?
	//�������� �Ƿ� ���� ����
	if($row['job_request_if']) {
		$sql_job = " select idx from job_education where com_code='$id' ";
		$result_job = sql_query($sql_job);
		$row_job=mysql_fetch_array($result_job);
		$idx = $row_job['idx'];
?>
							<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./job_education_view.php?w=<?=$w?>&id=<?=$idx?>" target="">������Ʒ�</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>

<?
	}
?>
						</td>
					</tr>
				</table>
<?
//�ű� ��Ͻ� ����
if($w == "u") {
	//�ŷ�ó ��No
	//$memo_type = 2;
	include "inc/client_comment_only.php";
}
?>
								<div style="height:20px;font-size:0px"></div>
							</form>
							<!--��޴� -->
							<!-- �Է��� -->
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
