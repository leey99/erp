<?
$sub_menu = "1900300";
include_once("./_common.php");

$now_date = date("Y.m.d");
$sql_common = " from com_list_gy a, com_list_gy_opt b ";

//�˻� �Ķ���� ����
$qstr  = "stx_process=".$stx_process;
$qstr .= "&stx_comp_name=".$stx_comp_name."&stx_t_no=".$stx_t_no."&stx_biz_no=".$stx_biz_no."&stx_boss_name=".$stx_boss_name."&stx_comp_tel=".$stx_comp_tel."&stx_comp_fax=".$stx_comp_fax."&stx_contract=".$stx_contract."&stx_comp_gubun1=".$stx_comp_gubun1."&stx_comp_gubun2=".$stx_comp_gubun2."&stx_comp_gubun3=".$stx_comp_gubun3."&stx_comp_gubun4=".$stx_comp_gubun4."&stx_comp_gubun5=".$stx_comp_gubun5."&stx_comp_gubun6=".$stx_comp_gubun6."&stx_comp_gubun7=".$stx_comp_gubun7."&stx_comp_gubun8=".$stx_comp_gubun8."&stx_comp_gubun9=".$stx_comp_gubun9."&stx_man_cust_name=".$stx_man_cust_name."&stx_man_cust_name2=".$stx_man_cust_name2."&stx_uptae=".$stx_uptae."&stx_upjong=".$stx_upjong."&search_ok=".$search_ok;
$qstr .= "&stx_biz_no_input_not=".$stx_biz_no_input_not."&stx_t_no_input_not=".$stx_t_no_input_not."&stx_samu_receive_no_search=".$stx_samu_receive_no_search."&stx_area1=".$stx_area1."&stx_area2=".$stx_area2."&stx_area3=".$stx_area3."&stx_area4=".$stx_area4."&stx_area5=".$stx_area5."&stx_area6=".$stx_area6."&stx_area7=".$stx_area7."&stx_area8=".$stx_area8."&stx_area9=".$stx_area9."&stx_area10=".$stx_area10."&stx_area11=".$stx_area11."&stx_area12=".$stx_area12."&stx_area13=".$stx_area13."&stx_area14=".$stx_area14."&stx_area15=".$stx_area15."&stx_area16=".$stx_area16."&stx_area17=".$stx_area17."&stx_area_not=".$stx_area_not;
$qstr .= "&stx_addr=".$stx_addr."&stx_addr_first=".$stx_addr_first."&stx_manage_name=".$stx_manage_name."&stx_electric_charges_no=".$stx_electric_charges_no."&stx_ecount=".$stx_ecount."&stx_industry1=".$stx_industry1."&stx_industry2=".$stx_industry2."&stx_industry3=".$stx_industry3."&stx_industry4=".$stx_industry4."&stx_industry5=".$stx_industry5."&stx_industry6=".$stx_industry6."&stx_industry7=".$stx_industry7."&stx_industry8=".$stx_industry8."&stx_industry9=".$stx_industry9."&stx_industry10=".$stx_industry10."&stx_industry11=".$stx_industry11."&stx_industry99=".$stx_industry99."&stx_industry_not=".$stx_industry_not;
$qstr .= "&stx_electric_charges_visit_kind=".$stx_electric_charges_visit_kind."&stx_payments=".$stx_payments."&stx_cost=".$stx_cost."&stx_electric_charges_watt1=".$stx_electric_charges_watt1."&stx_electric_charges_watt2=".$stx_electric_charges_watt2."&stx_reduce_ask=".$stx_reduce_ask."&stx_search_ask=".$stx_search_ask."&stx_construct_chk=".$stx_construct_chk."&stx_electric_charges_power_kind=".$stx_electric_charges_power_kind."&stx_search_day_chk=".$stx_search_day_chk."&search_sday=".$search_sday."&search_eday=".$search_eday."&stx_installment=".$stx_installment;

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

$top_sub_title = "images/top19_03.gif";
$sub_title = "������";
$g4['title'] = $sub_title." : ����о� : ".$easynomu_name;

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
}
//�޸�
$memo = $row['memo'];
//�繫��Ź����
$samu_req_yn = $row['samu_req_yn'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
	<title><?=$g4['title']?></title>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/style_admin.css" />
	<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
	<script type="text/javascript"  src="js/common.js"></script>
</head>
<body style="margin:0px;background-color:#f7fafd">
<script type="text/javascript"  src="./js/jquery-1.8.0.min.js" charset="euc-kr"></script>
<script type="text/javascript">
//<![CDATA[
function checkData() {
	var frm = document.dataForm;
	//���� ����ȣ �ߺ� üũ(�ŷ�ó ��� �� ����ȣ ������ ���) 160518
	if(frm.rst_chk_electric_no.value == "y") {
		alert("�̹� ��ϵ� ����ȣ�Դϴ�. Ȯ�� �� ��� �ٶ��ϴ�.");
		frm.electric_charges_no.focus();
		return;
	}
	frm.action = "electric_charges_update.php";
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
			//hyphen 109 , del 46 , backsp 8 , left 37 , right 39 , tab 9 , shift 16
			if(event.keyCode != 109 && event.keyCode != 46 && event.keyCode != 8 && event.keyCode != 37 && event.keyCode != 39 && event.keyCode != 9 && event.keyCode != 16) {
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
//]]>
</script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/lang/calendar-ko.js"></script>
<script type="text/javascript">
//<![CDATA[
function loadCalendar( obj ) {
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
function findNomu(branch,kind) {
	var ret = window.open("pop_manage_cust.php?search_belong="+branch+"&kind="+kind, "pop_nomu_cust", "top=100, left=100, width=800,height=600, scrollbars");
	return;
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
	if (event.keyCode < 48 || (event.keyCode > 57 && event.keyCode < 97) || (event.keyCode > 122)) event.returnValue = false;
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
		//�齺���̽�Ű ����
		if(event.keyCode != 8) {
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
					main.jumin_no.value=total;					// type �� ���� �������� �־� �ش�.
				}
			}else if(keydown =='N'){
				return total
			}
		}
		return total
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
	//�� ����Ʈ+�� �� �� Home
	if(event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=36) {
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
function number_format (number, decimals, dec_point, thousands_sep) {
	number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
	var n = !isFinite(+number) ? 0 : +number,
		prec = !isFinite(+decimals) ? 0 : Math.abs(decimals), sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
		dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
		s = '',
		toFixedFix = function (n, prec) {
			var k = Math.pow(10, prec);
			return '' + Math.round(n * k) / k;
		};
	// Fix for IE parseFloat(0.55).toFixed(0) = 0;
	s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
	if (s[0].length > 3) {
		s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
	}
	if ((s[1] || '').length < prec) {
		s[1] = s[1] || '';
		s[1] += new Array(prec - s[1].length + 1).join('0');
	}
	return s.join(dec);
}
//]]>
</script>
<script type="text/javascript">
//<![CDATA[
//���
function pagePrint(Obj, orientation_var) {  
  var W = 920;        //screen.availWidth;  
  var H = 600;       //screen.availHeight; 
 
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
	PrintPage.IEPageSetupX.PrintBackground = true;
	PrintPage.IEPageSetupX.ShrinkToFit = true;
	// �μ�̸�����
	PrintPage.IEPageSetupX.Preview();
}
function Installed() {
	try 
	{ 
		return (new ActiveXObject('IEPageSetupX.IEPageSetup')); 
	} 
	catch (e) 
	{ 
		return false; 
	} 
} 
function PrintTest() {
	if (!Installed()) 
		alert("��Ʈ���� ��ġ���� �ʾҽ��ϴ�. ���������� �μ���� ���� �� �ֽ��ϴ�.") 
	else 
		alert("���������� ��ġ�Ǿ����ϴ�."); 
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
//÷�μ��� �߰� ��ư
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
//÷�μ��� ���� for�� �߰� ��ư
function field_add_file(div_id, id) {
	var v2 = document.getElementById(div_id+'2_'+id);
	var v3 = document.getElementById(div_id+'3_'+id);
	var v4 = document.getElementById(div_id+'4_'+id);
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
//�̷�
function electric_charges_history(id) {
	var ret = window.open("./electric_charges_history_popup.php?id="+id, "window_electric_charges_history", "scrollbars=yes,width=640,height=240");
	return;
}
//�����ݰ�� 160212
function pop_electric_calculate() {
	var ret = window.open("pop_electric_calculate.php", "pop_electric_calculate", "width=450,height=570,scrollbars=no");
	return;
}
//�����ݰ��2 160317
function pop_electric_calculate2() {
	var ret = window.open("pop_electric_calculate.php?id=2", "pop_electric_calculate", "width=450,height=570,scrollbars=no");
	return;
}
//ó����� �˾� 160317
function pop_electric_process_memo() {
	var ret = window.open("./popup/pop_electric_process_memo.php", "pop_electric_process_memo", "width=540,height=706,scrollbars=no");
	return;
}
//����� ���� 160412
<?
$electric_charges_cost_arry[1] = "200~250";
$electric_charges_cost_arry[2] = "500~600";
$electric_charges_cost_arry[3] = "600~700";
$electric_charges_cost_arry[4] = "1000~1200";
$electric_charges_cost_arry[5] = "1500~2000";
?>
function electric_charges_cost_func(no) {
	var frm = document.dataForm;
	//�����1,2 ������ ���� ����, ���� �ʱ�ȭ 161026
	var ecc1 = ecc2 = "";
	if(no == 1) {
		ecc1 = 200;
		ecc2 = 250;
	} else if(no == 2) {
		ecc1 = 500;
		ecc2 = 600;
	} else if(no == 3) {
		ecc1 = 600;
		ecc2 = 700;
	} else if(no == 4) {
		ecc1 = 1000;
		ecc2 = 1200;
	} else if(no == 5) {
		ecc1 = 1500;
		ecc2 = 2000;
	}
	//����� �Է� ������ �������� ���� �ذ� 161026
	if(no) {
		frm.electric_charges_cost.value = ecc1;
		frm.electric_charges_cost2.value = ecc2;
	}
}
//�����2
function electric_charges_cost_func2(no) {
	var frm = document.dataForm;
	var ecc1 = ecc2 = "";
	if(no == 1) {
		ecc1 = 200;
		ecc2 = 250;
	} else if(no == 2) {
		ecc1 = 500;
		ecc2 = 600;
	} else if(no == 3) {
		ecc1 = 1000;
		ecc2 = 1200;
	} else if(no == 4) {
		ecc1 = 1000;
		ecc2 = 700;
	} else if(no == 5) {
		ecc1 = 1500;
		ecc2 = 2000;
	}
	if(no) {
		frm.electric_charges_cost_b.value = ecc1;
		frm.electric_charges_cost2_b.value = ecc2;
	}
}
//������ ��� 160412
function electric_charges_commission_calc(no) {
	var frm = document.dataForm;
	if(no == 1) {
		if(frm.electric_charges_reduce.value == "") {
			alert("��������ݾ�1�� �Է��ϼ���.");
			frm.electric_charges_reduce.focus();
			return;
		}
		ecc1 = toInt(frm.electric_charges_cost.value)*10000;
		ecc2 = toInt(frm.electric_charges_cost2.value)*10000;
		ecc_average = (ecc1+ecc2)/2;
		//ecc_result = toInt(frm.electric_charges_reduce.value)/2 - ecc_average;
		ecc_result = toInt(frm.electric_charges_reduce.value)/2;
		if(ecc_result < 5000000) frm.electric_charges_commission.value = number_format(5000000);
		else frm.electric_charges_commission.value = number_format(ecc_result);
	} else if(no == 2) {
		if(frm.electric_charges_reduce2.value == "") {
			frm.electric_charges_reduce2.focus();
			alert("��������ݾ�2�� �Է��ϼ���.");
			return;
		}
		ecc1 = toInt(frm.electric_charges_cost_b.value)*10000;
		ecc2 = toInt(frm.electric_charges_cost2_b.value)*10000;
		ecc_average = (ecc1+ecc2)/2;
		//ecc_result = toInt(frm.electric_charges_reduce2.value)/2 - ecc_average;
		ecc_result = toInt(frm.electric_charges_reduce2.value)/2;
		if(ecc_result < 5000000) frm.electric_charges_commission2.value = number_format(5000000);
		else frm.electric_charges_commission2.value = number_format(ecc_result);
	}
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
//�����ݰ��� 160616
function electric_charges_calculate() {
	var ret = window.open("pop_electric_charges_calculate.php", "pop_electric_charges_calculate", "width=450,height=570,scrollbars=yes");
	return;
}
//÷�μ���(�������) ���翭�� 160920
function electric_charges_construct_open_chk(obj) {
	var frm = document.dataForm;
	var id = frm.id.value;
	var check_ok = "";
	var confirm_text = "";
	if(!obj.checked) {
		check_ok = "";
		confirm_text = "����";
	} else {
		check_ok = "1";
		confirm_text = "����";
	}
	if(confirm("���翭�� "+confirm_text+"�Ͻðڽ��ϱ�?")) {
		check_ok_iframe.location.href = "electric_charges_construct_open_update.php?id="+id+"&check_ok="+check_ok;
		return;
	} else {
		return;
	}
}
//÷�μ���(�������) ���� ���翭�� 161108
function electric_charges_construct_open_individual_chk(obj, no) {
	var frm = document.dataForm;
	var id = frm.id.value;
	var check_ok = "";
	var confirm_text = "";
	if(!obj.checked) {
		check_ok = "";
		confirm_text = "����";
	} else {
		check_ok = "1";
		confirm_text = "����";
	}
	if(confirm("���翭�� "+confirm_text+"�Ͻðڽ��ϱ�?")) {
		check_ok_iframe.location.href = "electric_charges_construct_open_individual_update.php?id="+id+"&no="+no+"&check_ok="+check_ok;
		return;
	} else {
		return;
	}
}
//]]>
</script>
<?
//���� ����
if( ($member['mb_profile'] >= 110 && $member['mb_profile'] <= 200) || $member['mb_level'] == 4 ) include "inc/top_dealer.php";
else include "inc/top.php";

//ȸ�� ���� ���� : ��ٿ� ��� 9����
if($member['mb_profile'] == 1 && $member['mb_level'] == 4) $member['mb_level'] = 9;

//���Ѻ� ��ũ�� : ��ü ����
$url_save = "javascript:checkData();";
$url_print = "javascript:pagePrint(document.getElementById('print_page'), '0')";
$php_self_list = "electric_charges_list.php";
$url_list = "./".$php_self_list."?page=".$page."&".$qstr;
?>
		<td onmouseover="showM('900')" valign="top">
			<div style="margin:10px 20px 20px 20px;min-height:480px;">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="100"><img src="images/top19.gif" border="0" alt="����о�" /></td>
						<td><a href="<?=$url_list?>"><img src="<?=$top_sub_title?>" border="0" alt="������������" /></a></td>
						<td></td>
					</tr>
					<tr><td colspan="3" style="background:#cccccc;height:1px;"></td></tr>
				</table>
				<table width="<?=$content_width?>" border="0" align="left" cellpadding="0" cellspacing="0" >
					<tr>
									<td valign="top" style="padding:10px 0 0 0">
										<!--Ÿ��Ʋ -->	
<?
//$samu_list = "ok";
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
//���� ���� �̻� ���� 160411
if($member['mb_level'] >= 4) {
	$url_modify = $_SERVER['PHP_SELF']."?w=u&v=write&id=".$com_code."&page=".$page."&".$qstr."&".$stx_qstr;
	$url_print = "javascript:pagePrint(document.getElementById('print_page'), '0')";
	$url_print_request = "javascript:pagePrint(document.getElementById('tab1'), '0')";
} else {
	$url_save = "javascript:alert_no_right();";
}
//������ ��� ǥ��
if($w) {
	//���� �� �޴� ��ȣ
	$tab_onoff_this = 12;
	//���α׷� ����
	if($row['easynomu_yn'] == 1) {
		$tab_program_url = 1;
	} else if($row['easynomu_yn'] == 2) {
		$tab_program_url = 2;
	} else {
		$tab_program_url = 1;
		if($row['construction_yn'] == 1) $tab_program_url = 3;
	}
	//���� ���� ��� ǥ��
	if($member['mb_profile'] < 110 && $member['mb_level'] != 4) {
		include "inc/tab_menu.php";
		//����ó����Ȳ ����(������������) 160322
		$client_basic_admin_hide = 1;
		//����ó����Ȳ
		include "inc/client_basic_admin.php";
	}
}
?>
							<div id="tab1">
								<a name="20001"><!--������������--></a>
								<table border="0" cellpadding="0" cellspacing="0"> 
									<tr>
										<td id=""> 
											<table border="0" cellpadding="0" cellspacing="0"> 
												<tr> 
													<td><img src="images/so_tab_on_lt.gif"></td> 
													<td background="images/so_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100px;text-align:center'> 
														<span onclick="getId('electric_charges_div').style.display='';" style="cursor:pointer">�⺻����</span>
													</td> 
													<td><img src="images/so_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width=6></td> 
										<td valign="bottom" style="padding-left:10px;">
										</td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="botr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!--��޴� -->
								<!-- �Է��� -->
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" id="electric_charges_div" style="">
									<tr>
										<td nowrap class="tdrowk" width="110">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����ȣ<font color="red"></font>
										</td>
										<td nowrap  class="tdrow" width="204">
											<input name="electric_charges_no" type="text" class="textfm" style="width:94px;" value="<?=$row['electric_charges_no']?>" maxlength="10" onblur="getCont_electric_no(this.value, '<?=$id?>');" />
											��) 0912341234
											<div id='rst_electric_no' style="color:red;"></div>
											<input type="hidden" name="rst_chk_electric_no" value="" />
										</td>
										<td nowrap class="tdrowk" width="114">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">������ֹι�ȣ
										</td>
										<td nowrap  class="tdrow" width="160">
											<input name="electric_charges_ssnb" type="text" class="textfm" style="width:100px;ime-mode:disabled;" value="<?=$row['electric_charges_ssnb']?>" maxlength="14" onkeydown="only_number_hyphen()" onkeyup="checkhyphen_ssnb(this.value, this)" />
										</td>
										<td nowrap class="tdrowk" width="114">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���ε�Ϲ�ȣ<font color="red"></font>
										</td>
										<td nowrap  class="tdrow">
											<input name="electric_charges_bupin" type="text" class="textfm" style="width:110px;ime-mode:disabled;" value="<?=$row['electric_charges_bupin']?>" maxlength="14" onkeydown="only_number_hyphen()" onkeyup="checkhyphen_ssnb(this.value, this)" />
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">ó����Ȳ<font color="red"></font></td>
										<td nowrap class="tdrow">
<?
$sel_check_ok = array();
$check_ok_id = $row['electric_charges_process'];
$sel_check_ok[$check_ok_id] = "selected";
//if($member['mb_level'] != 6) {
//���� ���� 150918
//if(1==1) {
//���� ���� ��� ǥ�� 160112
//if($member['mb_profile'] < 110 && $member['mb_level'] != 4) {
//���� �������� ���� ��ǥ�� ���� 160629
if($member['mb_level'] > 6) {
?>
											<select name="electric_charges_process" class="selectfm" style="float:left;">
												<option value="">����</option>
												<option value="1" <?=$sel_check_ok['1']?>><?=$electric_charges_process_arry[1]?></option>
												<option value="2" <?=$sel_check_ok['2']?>><?=$electric_charges_process_arry[2]?></option>
												<option value="3" <?=$sel_check_ok['3']?>><?=$electric_charges_process_arry[3]?></option>
												<option value="10" <?=$sel_check_ok['10']?>><?=$electric_charges_process_arry[10]?></option>
												<option value="4" <?=$sel_check_ok['4']?>><?=$electric_charges_process_arry[4]?></option>
												<option value="16" <?=$sel_check_ok['16']?>><?=$electric_charges_process_arry[16]?></option><!--���˿Ϸ� 160919-->
												<option value="11" <?=$sel_check_ok['11']?>><?=$electric_charges_process_arry[11]?></option>
												<option value="5" <?=$sel_check_ok['5']?>><?=$electric_charges_process_arry[5]?></option>
												<option value="6" <?=$sel_check_ok['6']?>><?=$electric_charges_process_arry[6]?></option>
												<option value="12" <?=$sel_check_ok['12']?>><?=$electric_charges_process_arry[12]?></option>
												<option value="13" <?=$sel_check_ok['13']?>><?=$electric_charges_process_arry[13]?></option>
												<option value="7" <?=$sel_check_ok['7']?>><?=$electric_charges_process_arry[7]?></option>
												<option value="8" <?=$sel_check_ok['8']?>><?=$electric_charges_process_arry[8]?></option>
												<option value="15" <?=$sel_check_ok['15']?>><?=$electric_charges_process_arry[15]?></option>
												<option value="14" <?=$sel_check_ok['14']?>><?=$electric_charges_process_arry[14]?></option>
												<option value="9" <?=$sel_check_ok['9']?>><?=$electric_charges_process_arry[9]?></option>
											</select>
<?
	//���縸 ǥ�� 160126
	//if($member['mb_level'] > 6) {
?>
											<table border="0" cellpadding="0" cellspacing="0" style="float:left;vertical-align:middle;margin-left:10px;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="javascript:electric_charges_history('<?=$id?>');" target="">�̷�</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>

<?
	//}
} else {
	echo $electric_charges_process_arry[$check_ok_id];
	//echo $check_ok_id;
}
?>
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />���������</td>
										<td class="tdrow">
<?
if($row['damdang_code2']) {
	$damdang_code = $row['damdang_code2'];
} else {
	$damdang_code = $row['damdang_code'];
}
?>
											<input type="text" name="manager_code" class="textfm" style="width:34px;float:left;" readonly value="<?=$row['electric_charges_manager']?>" />
											<input type="text" name="manager_name" class="textfm" style="width:66px;float:left;" readonly value="<?=$row['electric_charges_manager_name']?>" />
											<table border="0" cellpadding="0" cellspacing="0" style="vertical-align:middle;float:left;"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif"></td><td background="./images/btn2_bg.gif" class="ftbutton3_white nowrap"><a href="javascript:findNomu(<?=$damdang_code?>,2);" target="">�˻�</a></td><td><img src="./images/btn2_rt.gif"></td> <td width="2"></td></tr></table>
										</td>
										<td nowrap class="tdrowk">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�����ٰ���(����)
										</td>
										<td nowrap  class="tdrow">
											<select name="electric_charges_visit_kind" class="selectfm" style="float:left;">
												<option value="">����</option>
												<option value="�湮" <? if($row['electric_charges_visit_kind'] == "�湮") echo "selected"; ?>>�湮</option>
												<option value="�翬��" <? if($row['electric_charges_visit_kind'] == "�翬��") echo "selected"; ?>>�翬��</option>
											</select>
											<input name="electric_charges_visitdt" type="text" class="textfm" style="width:78px;ime-mode:disabled;float:left;" value="<?=$row['electric_charges_visitdt']?>" maxlength="10" onkeypress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')" />
											<table border="0" cellspacing="0" cellpadding="0" style="vertical-align:middle;float:left;"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif" alt="[" /></td><td style="background:url('./images/btn2_bg.gif')" class="ftbutton3_white"><a href="javascript:loadCalendar(document.dataForm.electric_charges_visitdt);">�޷�</a></td><td><img src="./images/btn2_rt.gif" alt="]" /></td> <td width="2"></td></tr></table>
											<select name="electric_charges_visitdt_time" class="selectfm" style="float:left;">
												<option value="">����</option>
												<option value="����" <? if($row['electric_charges_visitdt_time'] == "����") echo "selected"; ?>>����</option>
												<option value="����" <? if($row['electric_charges_visitdt_time'] == "����") echo "selected"; ?>>����</option>
											</select>
											<input type="checkbox" name="electric_charges_visitdt_ok" <? if($row['electric_charges_visitdt_ok']) echo "checked"; ?> value="1" onclick="" style="vertical-align:middle;" />�Ϸ�
										</td>
									<tr>
										<td nowrap class="tdrowk">
<?
//�λ곲�� ������ ���� ���� 160701 / ���翡 ����������� ǥ�� 160801 / �ٽ� ����
?>
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0"><? if($member['mb_level'] > 6 || $member['mb_id'] == "ps50001") echo "���������"; else echo "�������"; ?>
											<!--<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���������-->
										</td>
										<td nowrap  class="tdrow" colspan="3">
<?
//���������
$electric_charges_existing = $row['electric_charges_existing'];
//������� �迭 160317;
$electric_charges_existing_arry[1] = "�����(��)�� ����";
$electric_charges_existing_arry[2] = "�����(��)�� ���A ���å�";
$electric_charges_existing_arry[3] = "�����(��)�� ���A ���å�";
$electric_charges_existing_arry[4] = "�Ϲݿ�(��)�� ����";
$electric_charges_existing_arry[5] = "�Ϲݿ�(��)�� ���A ���å�";
$electric_charges_existing_arry[6] = "�Ϲݿ�(��)�� ���A ���å�";
$electric_charges_existing_arry[7] = "������(��)�� ����";
$electric_charges_existing_arry[8] = "������(��)�� ���A ���å�";
$electric_charges_existing_arry[9] = "������(��)�� ���A ���å�";

$electric_charges_existing_arry[40] = "�Ϲݿ�(��)�� ���A ���å�";
$electric_charges_existing_arry[10] = "�Ϲݿ�(��)�� ���A ���å�";
$electric_charges_existing_arry[50] = "�����(��)�� ���A ���å�";
$electric_charges_existing_arry[20] = "�����(��)�� ���A ���å�";

$electric_charges_existing_arry[11] = "�����(��) ����";
$electric_charges_existing_arry[12] = "�����(��) ���A ���å�";
$electric_charges_existing_arry[13] = "�����(��) ���A ���å�";
$electric_charges_existing_arry[32] = "�����(��) ���A ���å�";
$electric_charges_existing_arry[31] = "�����(��) ���B ���å�";

$electric_charges_existing_arry[14] = "�Ϲݿ�(��) ����";
$electric_charges_existing_arry[15] = "�Ϲݿ�(��) ���A ���å�";
$electric_charges_existing_arry[16] = "�Ϲݿ�(��) ���A ���å�";
$electric_charges_existing_arry[30] = "�Ϲݿ�(��) ���B ���å�";

$electric_charges_existing_arry[17] = "������(��) ����";
$electric_charges_existing_arry[18] = "������(��) ���A ���å�";
$electric_charges_existing_arry[19] = "������(��) ���A ���å�";

$electric_charges_existing_arry[21] = "����(��) ����";
$electric_charges_existing_arry[22] = "����(��) ���";
$electric_charges_existing_arry[24] = "����(��) ����";
$electric_charges_existing_arry[25] = "����(��) ���A";
$electric_charges_existing_arry[26] = "����(��) ���B";
//���� ����
if($member['mb_level'] > 6) {
?>
											<select name="electric_charges_existing" class="selectfm" style="vertical-align:middle;">
												<option value="">����</option>
												<option value="1" <? if($electric_charges_existing == 1) echo "selected"; ?>><?=$electric_charges_existing_arry[1]?></option>
												<option value="2" <? if($electric_charges_existing == 2) echo "selected"; ?>><?=$electric_charges_existing_arry[2]?></option>
												<option value="3" <? if($electric_charges_existing == 3) echo "selected"; ?>><?=$electric_charges_existing_arry[3]?></option>
												<option value="4" <? if($electric_charges_existing == 4) echo "selected"; ?>><?=$electric_charges_existing_arry[4]?></option>
												<option value="5" <? if($electric_charges_existing == 5) echo "selected"; ?>><?=$electric_charges_existing_arry[5]?></option>
												<option value="6" <? if($electric_charges_existing == 6) echo "selected"; ?>><?=$electric_charges_existing_arry[6]?></option>
												<option value="7" <? if($electric_charges_existing == 7) echo "selected"; ?>><?=$electric_charges_existing_arry[7]?></option>
												<option value="8" <? if($electric_charges_existing == 8) echo "selected"; ?>><?=$electric_charges_existing_arry[8]?></option>
												<option value="9" <? if($electric_charges_existing == 9) echo "selected"; ?>><?=$electric_charges_existing_arry[9]?></option>

												<option value="40" <? if($electric_charges_existing == 40) echo "selected"; ?>><?=$electric_charges_existing_arry[40]?></option>
												<option value="10" <? if($electric_charges_existing == 10) echo "selected"; ?>><?=$electric_charges_existing_arry[10]?></option>
												<option value="50" <? if($electric_charges_existing == 50) echo "selected"; ?>><?=$electric_charges_existing_arry[50]?></option>
												<option value="20" <? if($electric_charges_existing == 20) echo "selected"; ?>><?=$electric_charges_existing_arry[20]?></option>

												<option value="11" <? if($electric_charges_existing == 11) echo "selected"; ?>><?=$electric_charges_existing_arry[11]?></option>
												<option value="12" <? if($electric_charges_existing == 12) echo "selected"; ?>><?=$electric_charges_existing_arry[12]?></option>
												<option value="13" <? if($electric_charges_existing == 13) echo "selected"; ?>><?=$electric_charges_existing_arry[13]?></option>
												<option value="32" <? if($electric_charges_existing == 32) echo "selected"; ?>><?=$electric_charges_existing_arry[32]?></option>
												<option value="31" <? if($electric_charges_existing == 31) echo "selected"; ?>><?=$electric_charges_existing_arry[31]?></option>

												<option value="14" <? if($electric_charges_existing == 14) echo "selected"; ?>><?=$electric_charges_existing_arry[14]?></option>
												<option value="15" <? if($electric_charges_existing == 15) echo "selected"; ?>><?=$electric_charges_existing_arry[15]?></option>
												<option value="16" <? if($electric_charges_existing == 16) echo "selected"; ?>><?=$electric_charges_existing_arry[16]?></option>
												<option value="30" <? if($electric_charges_existing == 30) echo "selected"; ?>><?=$electric_charges_existing_arry[30]?></option>

												<option value="17" <? if($electric_charges_existing == 17) echo "selected"; ?>><?=$electric_charges_existing_arry[17]?></option>
												<option value="18" <? if($electric_charges_existing == 18) echo "selected"; ?>><?=$electric_charges_existing_arry[18]?></option>
												<option value="19" <? if($electric_charges_existing == 19) echo "selected"; ?>><?=$electric_charges_existing_arry[19]?></option>

												<option value="21" <? if($electric_charges_existing == 21) echo "selected"; ?>><?=$electric_charges_existing_arry[21]?></option>
												<option value="22" <? if($electric_charges_existing == 22) echo "selected"; ?>><?=$electric_charges_existing_arry[22]?></option>
												<option value="24" <? if($electric_charges_existing == 24) echo "selected"; ?>><?=$electric_charges_existing_arry[24]?></option>
												<option value="25" <? if($electric_charges_existing == 25) echo "selected"; ?>><?=$electric_charges_existing_arry[25]?></option>
												<option value="26" <? if($electric_charges_existing == 26) echo "selected"; ?>><?=$electric_charges_existing_arry[26]?></option>
											</select>
											<input name="electric_charges_watt" type="text" class="textfm" style="width:70px;ime-mode:disabled;margin-left:5px;" value="<?=$row['electric_charges_watt']?>" maxlength="6" onkeydown="only_number()" onkeyup="checkThousand(this.value, this,'Y')" />kW
											<strong style="margin-left:12px;">��ũġ</strong><input name="electric_charges_peak" type="text" class="textfm" style="width:70px;ime-mode:disabled;margin-left:5px;" value="<?=$row['electric_charges_peak']?>" maxlength="6" onkeydown="only_number()" onkeyup="checkThousand(this.value, this,'Y')" />kW
<?
//�λ곲�� ������ ���� ���� 160701
} else if($member['mb_id'] == "ps50001") {
	if($electric_charges_existing) echo $electric_charges_existing_arry[$electric_charges_existing]." ";
	if($row['electric_charges_watt']) echo "".$row['electric_charges_watt']."kW";
	if($row['electric_charges_peak']) echo "<strong style='margin-left:12px;'> ��ũġ</strong> ".$row['electric_charges_peak']."kW";
//��� ���� ���� 161201
} else {
	if($row['electric_charges_watt']) echo "".$row['electric_charges_watt']."kW";
	if($row['electric_charges_peak']) echo "<strong style='margin-left:12px;'> ��ũġ</strong> ".$row['electric_charges_peak']."kW";
	//���翡 ����������� ǥ��(�豹�� ���� ��û) 160801
/*
	if($electric_charges_existing) echo $electric_charges_existing_arry[$electric_charges_existing]." ";
	else echo "";
	if($row['electric_charges_watt']) echo $row['electric_charges_watt']." ";
	else echo "";
*/
	//1��ġ �����ȸ��û üũ�ڽ� 160405
/*
	if($row['electric_charges_search_ask'] == 1) $electric_charges_search_ask_checked = "checked";
	echo "<input type='checkbox' name='electric_charges_search_ask' value='1' ".$electric_charges_search_ask_checked." style='vertical-align:middle;' />�����ȸ��û (�������ڿ��� �˸��� ǥ�õ˴ϴ�.)";
*/
}
?>
										</td>
										<td nowrap class="tdrowk">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�����(1�Ⱓ)
										</td>
										<td nowrap  class="tdrow">
<?
if($member['mb_level'] > 6) {
?>
											<input name="electric_charges_year_fee" type="text" class="textfm" style="width:100px;ime-mode:disabled;" value="<?=$row['electric_charges_year_fee']?>" maxlength="14" onkeydown="only_number()" onkeyup="checkThousand(this.value, this,'Y')" />
<?
} else {
	if($row['electric_charges_year_fee']) echo $row['electric_charges_year_fee']."��";
	else echo "";
}
?>
										</td>
									</tr>
									<tr>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����ȸ</td>
										<td class="tdrow">
<?
	//����ȸ 160411
	if($row['electric_charges_search_ask'] == 1) $electric_charges_search_ask_checked = "checked";
	echo "<input type='checkbox' name='electric_charges_search_ask' value='1' ".$electric_charges_search_ask_checked." style='vertical-align:middle;' />����ȸ";
?>
										</td>
<?
//������� / �λ곲�� ������ ���� ���� 160629
if($member['mb_level'] > 6 || $member['mb_id'] == "ps50001") {
?>
										<td class="tdrowk">����</td>
										<td class="tdrow">
											<table border="0" cellspacing="0" cellpadding="0" style="vertical-align:middle;margin-left:0;float:left;"><tr><td width="2"></td><td><img src="./images/btn3_lt.gif" alt="[" /></td><td style="background:url('./images/btn3_bg.gif')"><a href="#pop_electric_calculate" onclick="electric_charges_calculate();return false;" onkeypress="this.onclick;" style="color:white;font-size:8pt;">�����ݰ��</a></td><td><img src="./images/btn3_rt.gif" alt="]" /></td> <td width="2"></td></tr></table>
<table border="0" cellspacing="0" cellpadding="0" style="vertical-align:middle;margin-left:0;float:left;"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif" alt="[" /></td><td style="background:url('./images/btn2_bg.gif')"><a href="#pop_electric_calculate" onclick="pop_electric_calculate();return false;" onkeypress="this.onclick;" style="color:white;font-size:8pt;">�������Ա�</a></td><td><img src="./images/btn2_rt.gif" alt="]" /></td> <td width="2"></td></tr></table>
										</td>
<?
} else {
?>
										<td class="tdrowk"></td>
										<td class="tdrow">
										</td>
<?
}
?>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />�����ٰ���(����)</td>
										<td class="tdrow">
											<select name="electric_charges_visit_kind2" class="selectfm" style="float:left;">
												<option value="">����</option>
												<option value="�湮" <? if($row['electric_charges_visit_kind2'] == "�湮") echo "selected"; ?>>�湮</option>
												<option value="�翬��" <? if($row['electric_charges_visit_kind2'] == "�翬��") echo "selected"; ?>>�翬��</option>
											</select>
											<input name="electric_charges_visitdt2" type="text" class="textfm" style="width:78px;ime-mode:disabled;float:left;" value="<?=$row['electric_charges_visitdt2']?>" maxlength="10" onkeypress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')" />
											<table border="0" cellspacing="0" cellpadding="0" style="vertical-align:middle;float:left;"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif" alt="[" /></td><td style="background:url('./images/btn2_bg.gif')" class="ftbutton3_white"><a href="javascript:loadCalendar(document.dataForm.electric_charges_visitdt2);">�޷�</a></td><td><img src="./images/btn2_rt.gif" alt="]" /></td> <td width="2"></td></tr></table>
											<select name="electric_charges_visitdt_time2" class="selectfm" style="float:left;">
												<option value="">����</option>
												<option value="����" <? if($row['electric_charges_visitdt_time2'] == "����") echo "selected"; ?>>����</option>
												<option value="����" <? if($row['electric_charges_visitdt_time2'] == "����") echo "selected"; ?>>����</option>
											</select>
											<input type="checkbox" name="electric_charges_visitdt_ok2" <? if($row['electric_charges_visitdt_ok2']) echo "checked"; ?> value="1" onclick="" style="vertical-align:middle;" />�Ϸ�
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���޸�<font color="red"></font></td>
										<td nowrap class="tdrow" colspan="5">
<?
//����, ���� ����
if($member['mb_level'] <= 6) {
?>
											<textarea name="electric_charges_memo" class="textfm" style='width:100%;height:76px;word-break:break-all;'><?=$row['electric_charges_memo']?></textarea>
<?
} else {
	if($row['electric_charges_memo']) echo "<pre style='word-wrap:break-word;white-space:pre-wrap;white-space:-moz-pre-wrap;white-space:-pre-wrap;white-space:-o-pre-wrap;word-break:break-all;'>".$row['electric_charges_memo']."</pre>";
}
?>
										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px"></div>

								<table border="0" cellpadding="0" cellspacing="0"> 
									<tr>
										<td> 
											<table border="0" cellpadding="0" cellspacing="0"> 
												<tr> 
													<td><img src="images/so_tab_on_lt.gif"></td> 
													<td background="images/so_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100px;text-align:center'> 
														������(1��)
													</td> 
													<td><img src="images/so_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width=6></td> 
										<td valign="bottom" style="padding-left:10px;">
										</td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="botr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" id="" style="">
									<tr>
										<td nowrap class="tdrowk" width="110">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�������ĺ���1
										</td>
										<td nowrap  class="tdrow" colspan="5">
<?
//������ �� ���� �����
$electric_charges_meter_rate = $row['electric_charges_meter_rate'];
//���縸 ǥ�� 160126
if($member['mb_level'] > 6) {
?>
											<select name="electric_charges_meter_rate" class="selectfm" style="vertical-align:middle;">
												<option value="">����</option>
												<option value="1" <? if($electric_charges_meter_rate == 1) echo "selected"; ?>><?=$electric_charges_existing_arry[1]?></option>
												<option value="2" <? if($electric_charges_meter_rate == 2) echo "selected"; ?>><?=$electric_charges_existing_arry[2]?></option>
												<option value="3" <? if($electric_charges_meter_rate == 3) echo "selected"; ?>><?=$electric_charges_existing_arry[3]?></option>
												<option value="4" <? if($electric_charges_meter_rate == 4) echo "selected"; ?>><?=$electric_charges_existing_arry[4]?></option>
												<option value="5" <? if($electric_charges_meter_rate == 5) echo "selected"; ?>><?=$electric_charges_existing_arry[5]?></option>
												<option value="6" <? if($electric_charges_meter_rate == 6) echo "selected"; ?>><?=$electric_charges_existing_arry[6]?></option>
												<option value="7" <? if($electric_charges_meter_rate == 7) echo "selected"; ?>><?=$electric_charges_existing_arry[7]?></option>
												<option value="8" <? if($electric_charges_meter_rate == 8) echo "selected"; ?>><?=$electric_charges_existing_arry[8]?></option>
												<option value="9" <? if($electric_charges_meter_rate == 9) echo "selected"; ?>><?=$electric_charges_existing_arry[9]?></option>

												<option value="11" <? if($electric_charges_meter_rate == 11) echo "selected"; ?>><?=$electric_charges_existing_arry[11]?></option>
												<option value="12" <? if($electric_charges_meter_rate == 12) echo "selected"; ?>><?=$electric_charges_existing_arry[12]?></option>
												<option value="13" <? if($electric_charges_meter_rate == 13) echo "selected"; ?>><?=$electric_charges_existing_arry[13]?></option>
												<option value="14" <? if($electric_charges_meter_rate == 14) echo "selected"; ?>><?=$electric_charges_existing_arry[14]?></option>
												<option value="15" <? if($electric_charges_meter_rate == 15) echo "selected"; ?>><?=$electric_charges_existing_arry[15]?></option>
												<option value="16" <? if($electric_charges_meter_rate == 16) echo "selected"; ?>><?=$electric_charges_existing_arry[16]?></option>
												<option value="17" <? if($electric_charges_meter_rate == 17) echo "selected"; ?>><?=$electric_charges_existing_arry[17]?></option>
												<option value="18" <? if($electric_charges_meter_rate == 18) echo "selected"; ?>><?=$electric_charges_existing_arry[18]?></option>
												<option value="19" <? if($electric_charges_meter_rate == 19) echo "selected"; ?>><?=$electric_charges_existing_arry[19]?></option>

												<option value="21" <? if($electric_charges_meter_rate == 21) echo "selected"; ?>><?=$electric_charges_existing_arry[21]?></option>
												<option value="22" <? if($electric_charges_meter_rate == 22) echo "selected"; ?>><?=$electric_charges_existing_arry[22]?></option>
												<option value="24" <? if($electric_charges_meter_rate == 24) echo "selected"; ?>><?=$electric_charges_existing_arry[24]?></option>
												<option value="25" <? if($electric_charges_meter_rate == 25) echo "selected"; ?>><?=$electric_charges_existing_arry[25]?></option>
												<option value="26" <? if($electric_charges_meter_rate == 26) echo "selected"; ?>><?=$electric_charges_existing_arry[26]?></option>
											</select>
											<input name="electric_charges_watt_revision" type="text" class="textfm" style="width:70px;ime-mode:disabled;margin-left:5px;" value="<?=$row['electric_charges_watt_revision']?>" maxlength="6" onkeydown="only_number()" onkeyup="checkThousand(this.value, this,'Y')" />kW
											&nbsp; &nbsp;
<?
//�λ곲�� ������ ���� ���� 160701
} else if($member['mb_id'] == "ps50001") {
	if($electric_charges_meter_rate) echo $electric_charges_existing_arry[$electric_charges_meter_rate]." ";
	if($row['electric_charges_watt_revision']) echo "<strong>".$row['electric_charges_watt_revision']."kW<strong>";
}
?>
											<span style="font-weight:bold;">�����1</span>
<?
//���� ���� != ���� > �� ���� 160412
if($member['mb_level'] > 6) {
?>
											<select name="electric_charges_cost_no" class="selectfm" style="vertical-align:middle;" onclick="electric_charges_cost_func(this.value);">
												<option value="">����</option>
												<option value="1" <? if($row['electric_charges_cost_no'] == 1) echo "selected"; ?>><?=$electric_charges_cost_arry[1]?></option>
												<option value="2" <? if($row['electric_charges_cost_no'] == 2) echo "selected"; ?>><?=$electric_charges_cost_arry[2]?></option>
												<option value="3" <? if($row['electric_charges_cost_no'] == 3) echo "selected"; ?>><?=$electric_charges_cost_arry[3]?></option>
												<option value="4" <? if($row['electric_charges_cost_no'] == 4) echo "selected"; ?>><?=$electric_charges_cost_arry[4]?></option>
												<option value="5" <? if($row['electric_charges_cost_no'] == 5) echo "selected"; ?>><?=$electric_charges_cost_arry[5]?></option>
											</select>
											<input name="electric_charges_cost"  type="text" class="textfm" style="width:50px;" value="<?=$row['electric_charges_cost']?>"  maxlength="12" />
											~
											<input name="electric_charges_cost2" type="text" class="textfm" style="width:50px;" value="<?=$row['electric_charges_cost2']?>" maxlength="12" />
											����
<?
} else {
	if($row['electric_charges_cost']) echo $row['electric_charges_cost']."~".$row['electric_charges_cost2']."��";
	else echo "";
}
?>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��������ݾ�1
										</td>
										<td nowrap  class="tdrow" width="220">
<?
//���� ����
if($member['mb_level'] > 6) {
?>
											<input name="electric_charges_reduce" type="text" class="textfm" style="width:100px;ime-mode:disabled;" value="<?=$row['electric_charges_reduce']?>" maxlength="14" onkeydown="only_number()" onkeyup="checkThousand(this.value, this,'Y')" />
<?
} else {
	//�������, ó����Ȳ �����ȸ�� ��� ��ǥ�� 160905
	if($check_ok_id != 2) {
		if($row['electric_charges_reduce']) echo $row['electric_charges_reduce']."��";
		else echo "";
	}
}
?>
										</td>
										<td nowrap class="tdrowk" width="110">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�������Ա�1
										</td>
										<td nowrap  class="tdrow" width="220">
<?
if($member['mb_level'] > 6) {
?>
											<input name="electric_charges_payments" type="text" class="textfm" style="width:100px;ime-mode:disabled;float:left;" value="<?=$row['electric_charges_payments']?>" maxlength="14" onkeydown="only_number()" onkeyup="checkThousand(this.value, this,'Y')" />
<?
} else {
	if($row['electric_charges_payments']) echo $row['electric_charges_payments']."��";
	else echo "";
}
//��ǥ, ������ ���� 160212 ���ȣ �߰� 160519
if($member['mb_id'] == "kcmc1001" || $member['mb_id'] == "master" || $member['mb_id'] == "kcmc1003") {
?>
											<table border="0" cellspacing="0" cellpadding="0" style="vertical-align:middle;margin-left:0;float:left;"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif" alt="[" /></td><td style="background:url('./images/btn2_bg.gif')"><a href="#pop_electric_calculate" onclick="pop_electric_calculate();return false;" onkeypress="this.onclick;" style="color:white;font-size:8pt;">���</a></td><td><img src="./images/btn2_rt.gif" alt="]" /></td> <td width="2"></td></tr></table>
<?
}
?>
										</td>
										<td nowrap class="tdrowk" width="110">
											<div style="float:left;">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">������1
											</div>
										</td>
										<td nowrap  class="tdrow">
<?
if($member['mb_level'] > 6) {
?>
											<input name="electric_charges_commission" type="text" class="textfm" style="width:100px;ime-mode:disabled;float:left;" value="<?=$row['electric_charges_commission']?>" maxlength="14" onkeydown="only_number()" onkeyup="checkThousand(this.value, this,'Y')" />
											<table border="0" cellspacing="0" cellpadding="0" style="vertical-align:middle;margin-left:0;float:left;"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif" alt="[" /></td><td style="background:url('./images/btn2_bg.gif')"><a href="#electric_charges_commission_calc" onclick="electric_charges_commission_calc(1);return false;" onkeypress="this.onclick;" style="color:white;font-size:8pt;">���</a></td><td><img src="./images/btn2_rt.gif" alt="]" /></td> <td width="2"></td></tr></table>
<?
} else {
	if($row['electric_charges_commission']) echo $row['electric_charges_commission']."��";
	else echo "";
}
?>
										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px"></div>

								<table border="0" cellpadding="0" cellspacing="0"> 
									<tr>
										<td> 
											<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='consulting2_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer">
												<tr> 
													<td><img src="images/so_tab_on_lt.gif"></td> 
													<td background="images/so_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100px;text-align:center'> 
														������(2��)
													</td> 
													<td><img src="images/so_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width=6></td> 
										<td valign="bottom" style="padding-left:10px;">
										</td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="botr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
<?
//��ǥ�� ����
if($member['mb_id'] == "kcmc1001") {
	if(!$row['electric_charges_meter_rate2']) {
		$consulting2_div_display = "display:none;";
	}
} else {
	$consulting2_div_display = "";
}
?>
								<div id="consulting2_div" style="<?=$consulting2_div_display?>">
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" id="" style="">
									<tr>
										<td nowrap class="tdrowk" width="110">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�������ĺ���2
										</td>
										<td nowrap  class="tdrow" colspan="5">
<?
//������ �� ���� �����
$electric_charges_meter_rate2 = $row['electric_charges_meter_rate2'];
//���縸 ǥ�� 160126
if($member['mb_level'] > 6) {
?>
											<select name="electric_charges_meter_rate2" class="selectfm" style="vertical-align:middle;">
												<option value="">����</option>
												<option value="1" <? if($electric_charges_meter_rate2 == 1) echo "selected"; ?>><?=$electric_charges_existing_arry[1]?></option>
												<option value="2" <? if($electric_charges_meter_rate2 == 2) echo "selected"; ?>><?=$electric_charges_existing_arry[2]?></option>
												<option value="3" <? if($electric_charges_meter_rate2 == 3) echo "selected"; ?>><?=$electric_charges_existing_arry[3]?></option>
												<option value="4" <? if($electric_charges_meter_rate2 == 4) echo "selected"; ?>><?=$electric_charges_existing_arry[4]?></option>
												<option value="5" <? if($electric_charges_meter_rate2 == 5) echo "selected"; ?>><?=$electric_charges_existing_arry[5]?></option>
												<option value="6" <? if($electric_charges_meter_rate2 == 6) echo "selected"; ?>><?=$electric_charges_existing_arry[6]?></option>
												<option value="7" <? if($electric_charges_meter_rate2 == 7) echo "selected"; ?>><?=$electric_charges_existing_arry[7]?></option>
												<option value="8" <? if($electric_charges_meter_rate2 == 8) echo "selected"; ?>><?=$electric_charges_existing_arry[8]?></option>
												<option value="9" <? if($electric_charges_meter_rate2 == 9) echo "selected"; ?>><?=$electric_charges_existing_arry[9]?></option>

												<option value="11" <? if($electric_charges_meter_rate2 == 11) echo "selected"; ?>><?=$electric_charges_existing_arry[11]?></option>
												<option value="12" <? if($electric_charges_meter_rate2 == 12) echo "selected"; ?>><?=$electric_charges_existing_arry[12]?></option>
												<option value="13" <? if($electric_charges_meter_rate2 == 13) echo "selected"; ?>><?=$electric_charges_existing_arry[13]?></option>
												<option value="14" <? if($electric_charges_meter_rate2 == 14) echo "selected"; ?>><?=$electric_charges_existing_arry[14]?></option>
												<option value="15" <? if($electric_charges_meter_rate2 == 15) echo "selected"; ?>><?=$electric_charges_existing_arry[15]?></option>
												<option value="16" <? if($electric_charges_meter_rate2 == 16) echo "selected"; ?>><?=$electric_charges_existing_arry[16]?></option>
												<option value="17" <? if($electric_charges_meter_rate2 == 17) echo "selected"; ?>><?=$electric_charges_existing_arry[17]?></option>
												<option value="18" <? if($electric_charges_meter_rate2 == 18) echo "selected"; ?>><?=$electric_charges_existing_arry[18]?></option>
												<option value="19" <? if($electric_charges_meter_rate2 == 19) echo "selected"; ?>><?=$electric_charges_existing_arry[19]?></option>

												<option value="21" <? if($electric_charges_meter_rate2 == 21) echo "selected"; ?>><?=$electric_charges_existing_arry[21]?></option>
												<option value="22" <? if($electric_charges_meter_rate2 == 22) echo "selected"; ?>><?=$electric_charges_existing_arry[22]?></option>
												<option value="24" <? if($electric_charges_meter_rate2 == 24) echo "selected"; ?>><?=$electric_charges_existing_arry[24]?></option>
												<option value="25" <? if($electric_charges_meter_rate2 == 25) echo "selected"; ?>><?=$electric_charges_existing_arry[25]?></option>
												<option value="26" <? if($electric_charges_meter_rate2 == 26) echo "selected"; ?>><?=$electric_charges_existing_arry[26]?></option>
											</select>
											<input name="electric_charges_watt_revision2" type="text" class="textfm" style="width:70px;ime-mode:disabled;margin-left:5px;" value="<?=$row['electric_charges_watt_revision2']?>" maxlength="6" onkeydown="only_number()" onkeyup="checkThousand(this.value, this,'Y')" />kW
											&nbsp; &nbsp;
<?
//�λ곲�� ������ ���� ���� 160701
} else if($member['mb_id'] == "ps50001") {
	if($electric_charges_meter_rate2) echo $electric_charges_existing_arry[$electric_charges_meter_rate2]." ";
	if($row['electric_charges_watt_revision2']) echo "<strong>".$row['electric_charges_watt_revision2']."kW<strong>";
}
?>
											<span style="font-weight:bold;">�����2</span>
<?
if($member['mb_level'] > 6) {
?>
											<select name="electric_charges_cost_no2" class="selectfm" style="vertical-align:middle;" onclick="electric_charges_cost_func2(this.value);">
												<option value="">����</option>
												<option value="1" <? if($row['electric_charges_cost_no2'] == 1) echo "selected"; ?>><?=$electric_charges_cost_arry[1]?></option>
												<option value="2" <? if($row['electric_charges_cost_no2'] == 2) echo "selected"; ?>><?=$electric_charges_cost_arry[2]?></option>
												<option value="3" <? if($row['electric_charges_cost_no2'] == 3) echo "selected"; ?>><?=$electric_charges_cost_arry[3]?></option>
												<option value="4" <? if($row['electric_charges_cost_no2'] == 4) echo "selected"; ?>><?=$electric_charges_cost_arry[4]?></option>
												<option value="5" <? if($row['electric_charges_cost_no2'] == 5) echo "selected"; ?>><?=$electric_charges_cost_arry[5]?></option>
											</select>
											<input name="electric_charges_cost_b"  type="text" class="textfm" style="width:50px;" value="<?=$row['electric_charges_cost_b']?>"  maxlength="12" />
											~
											<input name="electric_charges_cost2_b" type="text" class="textfm" style="width:50px;" value="<?=$row['electric_charges_cost2_b']?>" maxlength="12" />
											����
<?
} else {
	if($row['electric_charges_cost_b']) echo $row['electric_charges_cost_b']."~".$row['electric_charges_cost2_b']."��";
	else echo "";
}
?>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��������ݾ�2
										</td>
										<td nowrap  class="tdrow" width="220">
<?
if($member['mb_level'] > 6) {
?>
											<input name="electric_charges_reduce2" type="text" class="textfm" style="width:100px;ime-mode:disabled;" value="<?=$row['electric_charges_reduce2']?>" maxlength="14" onkeydown="only_number()" onkeyup="checkThousand(this.value, this,'Y')" />
<?
} else {
	//�������, ó����Ȳ �����ȸ�� ��� ��ǥ�� 160905
	if($check_ok_id != 2) {
		if($row['electric_charges_reduce2']) echo $row['electric_charges_reduce2']."��";
		else echo "";
	}
}
?>
										</td>
										<td nowrap class="tdrowk" width="110">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�������Ա�2
										</td>
										<td nowrap  class="tdrow" width="220">
<?
if($member['mb_level'] > 6) {
?>
											<input name="electric_charges_payments2" type="text" class="textfm" style="width:100px;ime-mode:disabled;float:left;" value="<?=$row['electric_charges_payments2']?>" maxlength="14" onkeydown="only_number()" onkeyup="checkThousand(this.value, this,'Y')" />
<?
} else {
	if($row['electric_charges_payments2']) echo $row['electric_charges_payments2']."��";
	else echo "";
}
//��ǥ, ������, ���ȣ ���� 160212
if($member['mb_id'] == "kcmc1001" || $member['mb_id'] == "master" || $member['mb_id'] == "kcmc1003") {
?>
											<table border="0" cellspacing="0" cellpadding="0" style="vertical-align:middle;margin-left:0;float:left;"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif" alt="[" /></td><td style="background:url('./images/btn2_bg.gif')"><a href="#pop_electric_calculate2" onclick="pop_electric_calculate2();return false;" onkeypress="this.onclick;" style="color:white;font-size:8pt;">���</a></td><td><img src="./images/btn2_rt.gif" alt="]" /></td> <td width="2"></td></tr></table>
<?
}
?>
										</td>
										<td nowrap class="tdrowk" width="110">
											<div style="float:left;">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">������2
											</div>
										</td>
										<td nowrap  class="tdrow">
<?
if($member['mb_level'] > 6) {
?>
											<input name="electric_charges_commission2" type="text" class="textfm" style="width:100px;ime-mode:disabled;float:left;" value="<?=$row['electric_charges_commission2']?>" maxlength="14" onkeydown="only_number()" onkeyup="checkThousand(this.value, this,'Y')" />
											<table border="0" cellspacing="0" cellpadding="0" style="vertical-align:middle;margin-left:0;float:left;"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif" alt="[" /></td><td style="background:url('./images/btn2_bg.gif')"><a href="#electric_charges_commission_calc" onclick="electric_charges_commission_calc(2);return false;" onkeypress="this.onclick;" style="color:white;font-size:8pt;">���</a></td><td><img src="./images/btn2_rt.gif" alt="]" /></td> <td width="2"></td></tr></table>
<?
} else {
	if($row['electric_charges_commission2']) echo $row['electric_charges_commission2']."��";
	else echo "";
}
?>
										</td>
									</tr>
								</table>
								</div>
								<div style="height:10px;font-size:0px"></div>

								<table border="0" cellpadding="0" cellspacing="0"> 
									<tr>
										<td> 
											<table border="0" cellpadding="0" cellspacing="0"> 
												<tr> 
													<td><img src="images/so_tab_on_lt.gif"></td> 
													<td background="images/so_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100px;text-align:center'> 
														ó����Ȳ
													</td> 
													<td><img src="images/so_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width=6></td> 
										<td valign="bottom" style="padding-left:10px;">
										</td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="botr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" id="" style="">
									<tr>
										<td class="tdrowk" width="110"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����������</td>
										<td class="tdrow"  width="220">
											<strong>
<?
$etc_user = $row['electric_charges_user'];
if($etc_user == "�ּ���") $etc_user = "������";
echo $etc_user;
?>
											</strong>
										</td>
										<td class="tdrowk" width="110"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />�����Ͻ�</td>
										<td class="tdrow"  width="220">
<?
$editdt = $row['electric_charges_editdt'];
echo $editdt;
?>
										</td>
										<td class="tdrowk" width="110">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />1��������ǥ
										</td>
										<td class="tdrow">
<?
//������� �� ǥ��
if($row['electric_charges_process'] == 3) {
	//1��ġ �����ȸ��û üũ�ڽ� 160405
	if($row['electric_charges_reduce_ask'] == 1) $electric_charges_reduce_ask_checked = "checked";
	echo "<input type='checkbox' name='electric_charges_reduce_ask' value='1' ".$electric_charges_reduce_ask_checked." style='vertical-align:middle;' /><span style='color:red;'>��û</span>";
} else {
	echo "������� �ܰ迡�� ��û����";
}
?>
										</td>
									</tr>
<?
//���� ����
if($member['mb_level'] > 6) {
?>
									<tr>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />��������</td>
										<td class="tdrow">
<?
	//��Ī ����. ȸ������� ����. ��ȣ���� �߰�. ��������(2��) 160831
	//�������� 160517 / �����, 2��, 3�� �����ü(�������) -> ������ 160830 �޺��ڽ� 160628 / ������� �߰� 160726
	//if($row['electric_charges_construct_chk'] == 1) $electric_charges_construct_chk_checked = "checked";
	//echo "<input type='checkbox' name='electric_charges_construct_chk' value='1' ".$electric_charges_construct_chk_checked." style='vertical-align:middle;' />����";
?>
											<select name="electric_charges_construct_chk" class="selectfm" style="vertical-align:middle;">
												<option value="">����</option>
												<option value="1" <? if($row['electric_charges_construct_chk'] == 1) echo "selected"; ?>><?=$electric_charges_construct_arry[1]?></option>
												<option value="2" <? if($row['electric_charges_construct_chk'] == 2) echo "selected"; ?>><?=$electric_charges_construct_arry[2]?></option>
												<option value="3" <? if($row['electric_charges_construct_chk'] == 3) echo "selected"; ?>><?=$electric_charges_construct_arry[3]?></option>
												<option value="4" <? if($row['electric_charges_construct_chk'] == 4) echo "selected"; ?>><?=$electric_charges_construct_arry[4]?></option>
												<option value="5" <? if($row['electric_charges_construct_chk'] == 5) echo "selected"; ?>><?=$electric_charges_construct_arry[5]?></option>
											</select>

											<select name="electric_charges_construct_chk2" class="selectfm" style="vertical-align:middle;">
												<option value="">����</option>
												<option value="1" <? if($row['electric_charges_construct_chk2'] == 1) echo "selected"; ?>><?=$electric_charges_construct_arry[1]?></option>
												<option value="2" <? if($row['electric_charges_construct_chk2'] == 2) echo "selected"; ?>><?=$electric_charges_construct_arry[2]?></option>
												<option value="3" <? if($row['electric_charges_construct_chk2'] == 3) echo "selected"; ?>><?=$electric_charges_construct_arry[3]?></option>
												<option value="4" <? if($row['electric_charges_construct_chk2'] == 4) echo "selected"; ?>><?=$electric_charges_construct_arry[4]?></option>
												<option value="5" <? if($row['electric_charges_construct_chk2'] == 5) echo "selected"; ?>><?=$electric_charges_construct_arry[5]?></option>
											</select>
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />�г�</td>
										<td class="tdrow">
											<select name="electric_charges_installment" class="selectfm">
												<option value="">����</option>
<?
	for($k=1;$k<=24;$k++) {
		if($k == $row['electric_charges_installment']) $installment_selected = "selected";
		else $installment_selected = "";
		echo "<option value='".$k."' ".$installment_selected.">".$k."</option>";
	}
	//�г� 48���� �߰�(��Ʈ������ȣ��) 160707
	$k = 48;
	if($k == $row['electric_charges_installment']) $installment_selected = "selected";
	else $installment_selected = "";
?>
												<option value='<?=$k?>' <?=$installment_selected?>><?=$k?></option>
											</select>
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����������</td>
										<td class="tdrow">
<?
if($member['mb_level'] > 6) {
?>
											<input name="kepco_date_accept" type="text" class="textfm" style="width:70px;ime-mode:disabled;float:left;" value="<?=$row['kepco_date_accept']?>" maxlength="10" onkeypress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')" />
											<table border="0" cellspacing="0" cellpadding="0" style="vertical-align:middle;float:left;"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif" alt="[" /></td><td style="background:url('./images/btn2_bg.gif')" class="ftbutton3_white"><a href="javascript:loadCalendar(document.dataForm.kepco_date_accept);">�޷�</a></td><td><img src="./images/btn2_rt.gif" alt="]" /></td> <td width="2"></td></tr></table>
<?
} else {
	if($row['kepco_date_accept']) echo $row['kepco_date_accept'];
	else echo "";
}
?>
										</td>
									</tr>
<?
}
?>
									<tr>
<?
$sql_app = " select * from erp_application where com_code='$com_code' and application_kind=23 order by idx asc ";
//echo $sql_app;
$result_app = sql_query($sql_app);
$row_app = mysql_fetch_array($result_app);
?>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�����Ա���</td>
										<td class="tdrow">
											<?=$row_app['down_payment_date']?>
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����</td>
										<td class="tdrow">
<?
if($row_app['down_payment']) echo number_format($row_app['down_payment'])."";
?>
										</td>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�ǻ�Ϸ���</td>
										<td class="tdrow">
<?
if($member['mb_level'] > 6) {
?>
											<input name="kepco_date_check" type="text" class="textfm" style="width:70px;ime-mode:disabled;float:left;" value="<?=$row['kepco_date_check']?>" maxlength="10" onkeypress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')" />
											<table border="0" cellspacing="0" cellpadding="0" style="vertical-align:middle;float:left;"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif" alt="[" /></td><td style="background:url('./images/btn2_bg.gif')" class="ftbutton3_white"><a href="javascript:loadCalendar(document.dataForm.kepco_date_check);">�޷�</a></td><td><img src="./images/btn2_rt.gif" alt="]" /></td> <td width="2"></td></tr></table>
<?
} else {
	if($row['kepco_date_check']) echo $row['kepco_date_check'];
	else echo "";
}
?>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">û����<font color="red"></font></td>
										<td nowrap class="tdrow">
<?
if($member['mb_level'] > 6) {
?>
											<input name="electric_date_request" type="text" class="textfm" style="width:90px;float:left;margin-right:5px;" value="<?=$row['electric_date_request']?>" maxlength="16" />
<?
} else {
	if($row['electric_date_request']) echo $row['electric_date_request'];
	else echo "";
}
?>
											��ȸ������
<?
if($row['electric_date_request']) {
	$electric_date_request_arry = explode("~", $row['electric_date_request']);
	//û���� ~ ���� ���� ��� - ���ڷ� �迭 ����
	if(!$electric_date_request_arry[1]) $electric_date_request_arry = explode("-", $row['electric_date_request']);
	$electric_date_request_arry[1] = (int)str_replace("��", "", $electric_date_request_arry[1]);
	//7��->9�Ϸ� ���� 160511 -> 10�� ������ 160926
	$electric_date_inquiry = date("d", strtotime("2016-04-".$electric_date_request_arry[1]." + 10 days"));
	echo $electric_date_inquiry."��";
}
?>
										</td>
										<td nowrap class="tdrowk" width="110"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">������<font color="red"></font></td>
										<td nowrap class="tdrow">
<?
if($member['mb_level'] > 6) {
?>
											<input name="electric_date_delivery" type="text" class="textfm" style="width:90px;float:left;" value="<?=$row['electric_date_delivery']?>" maxlength="16" />
<?

		$electric_date_request_arry = explode("~", $row['electric_date_request']);
		//û���� ~ ���� ���� ��� - ���ڷ� �迭 ����
		if(!$electric_date_request_arry[1]) $electric_date_request_arry = explode("-", $row['electric_date_request']);
		$electric_date_request_arry[0] = (int)str_replace("��", "", $electric_date_request_arry[0]);
		$electric_date_request_arry[1] = (int)str_replace("��", "", $electric_date_request_arry[1]);
		//����Ϸ��� : ��, �� �и�
		$electric_date_change_arry = explode(".", $row['electric_date_change']);
		//����Ϸ��� ���� ���� �ľ�
		$electric_date_change_after = $electric_date_change_arry[0].".".$electric_date_change_arry[1].".".$electric_date_request_arry[0];
		//���� ������
		$electric_date_inquiry = $electric_date_change_arry[0].".".$electric_date_change_arry[1].".".$electric_date_inquiry_day;
		//7��->9�Ϸ� ���� 160511 -> 10�� 160926
		$electric_date_inquiry_day = date("Y-m-d", strtotime($electric_date_change_arry[0]."-".$electric_date_change_arry[1]."-".$electric_date_request_arry[1]." + 10 days"));
		//������ <= û�������� 2016.08.08 <= 2016.08.15
		//echo $row['electric_date_change']." <= ".$electric_date_change_after;
		if($row['electric_date_change'] <= $electric_date_change_after) {
			$electric_date_inquiry_1month = date("Y-m-d", strtotime($electric_date_inquiry_day." + 1 months"));
			$electric_date_inquiry_time = $electric_date_inquiry_1month." 09:00:00";
		} else {
			$electric_date_inquiry_2month = date("Y-m-d", strtotime($electric_date_inquiry_day." + 2 months"));
			$electric_date_inquiry_time = $electric_date_inquiry_2month." 09:00:00";
		}
		//���� �� ���� ������
		echo " ".$electric_date_inquiry_time;

} else {
	if($row['electric_date_delivery']) echo $row['electric_date_delivery'];
	else echo "";
}
?>
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����Ϸ���<font color="red"></font></td>
										<td nowrap class="tdrow">
<?
//����Ϸ��� ��� ���� / ���ȣ ��� �ǰ� 160809
//����, �λ곲�� ������ ���� 160812
if($member['mb_level'] > 6 || $member['mb_id'] == "ps50001") {
?>
											<input name="electric_date_change" type="text" class="textfm" style="width:70px;ime-mode:disabled;float:left;" value="<?=$row['electric_date_change']?>" maxlength="10" onkeypress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')" />
											<table border="0" cellspacing="0" cellpadding="0" style="vertical-align:middle;float:left;"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif" alt="[" /></td><td style="background:url('./images/btn2_bg.gif')" class="ftbutton3_white"><a href="javascript:loadCalendar(document.dataForm.electric_date_change);">�޷�</a></td><td><img src="./images/btn2_rt.gif" alt="]" /></td> <td width="2"></td></tr></table>
<?
} else {
	if($row['electric_date_change']) echo $row['electric_date_change'];
	else echo "";
}
?>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" />�ܱݿ�û��<font color="red"></font></td>
										<td nowrap class="tdrow">
<?
if($member['mb_level'] > 6) {
?>
											<input name="remainder_date" type="text" class="textfm" style="width:70px;ime-mode:disabled;float:left;" value="<?=$row['remainder_date']?>" maxlength="10" onkeypress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')" />
											<table border="0" cellspacing="0" cellpadding="0" style="vertical-align:middle;float:left;"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif" alt="[" /></td><td style="background:url('./images/btn2_bg.gif')" class="ftbutton3_white"><a href="javascript:loadCalendar(document.dataForm.remainder_date);">�޷�</a></td><td><img src="./images/btn2_rt.gif" alt="]" /></td> <td width="2"></td></tr></table>
<?
} else {
	if($row['remainder_date']) echo $row['remainder_date'];
	else echo "";
}
?>
										</td>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" />���ںи�<font color="red"></font></td>
										<td nowrap class="tdrow" colspan="3">
<?
if($member['mb_level'] > 6) {
?>
											���ںи�<input type="checkbox" name="electric_charges_separate" <? if($row['electric_charges_separate']) echo "checked"; ?> value="1" onclick="" style="vertical-align:middle;" />
											����ȣ(��) <input name="electric_charges_separate_no" type="text" class="textfm" style="width:94px;" value="<?=$row['electric_charges_separate_no']?>" maxlength="10" />
											������(��) <input name="electric_charges_separate_name" type="text" class="textfm" style="width:144px;" value="<?=$row['electric_charges_separate_name']?>" maxlength="15" />
											<br />
											<textarea name="electric_charges_separate_memo" class="textfm" style='width:470px;height:60px;word-break:break-all;'><?=$row['electric_charges_separate_memo']?></textarea>
											�޸�
<?
} else {
	echo "<pre>".$row['electric_charges_separate_memo']."</pre>";
}
?>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">ó�����<font color="red"></font>
<?
//��ǥ, ������ ���� 160317 / ���� �߰� 160428 / ��ٿ� ��� 160516
if($member['mb_id'] == "kcmc1001" || $member['mb_id'] == "master" || $member['mb_id'] == "kcmc1004" || $member['mb_id'] == "kcmc1003") {
?>
											<table border="0" cellspacing="0" cellpadding="0" style="vertical-align:middle;margin-left:5px;"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif" alt="[" /></td><td style="background:url('./images/btn2_bg.gif')" class="ftbutton3_white"><a href="#pop_electric_process_memo" onclick="pop_electric_process_memo();return false;" onkeypress="this.onclick;">�˾�</a></td><td><img src="./images/btn2_rt.gif" alt="]" /></td> <td width="2"></td></tr></table>
<?
}
?>
										</td>
										<td nowrap class="tdrow" colspan="5">
<?
if($member['mb_level'] > 6) {
?>
											<textarea name="electric_charges_etc" id="electric_charges_etc" class="textfm" style='width:99%;height:76px;word-break:break-all;'><?=$row['electric_charges_etc']?></textarea>
<?
} else {
	echo "<pre style='white-space:pre-wrap;'>".$row['electric_charges_etc']."</pre>";
?>
											<textarea name="electric_charges_etc" class="textfm" style='width:99%;height:56px;word-break:break-all;display:none;'><?=$row['electric_charges_etc']?></textarea>
<?
}
?>
										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px"></div>

								<table border="0" cellpadding="0" cellspacing="0"> 
									<tr>
										<td> 
											<table border="0" cellpadding="0" cellspacing="0"> 
												<tr> 
													<td><img src="images/so_tab_on_lt.gif"></td> 
													<td background="images/so_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100px;text-align:center'> 
														�������
													</td> 
													<td><img src="images/so_tab_on_rt.gif"></td> 
												</tr> 
											</table> 
										</td> 
										<td width=6></td> 
										<td valign="bottom" style="padding-left:10px;">
										</td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="botr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" id="" style="">
									<tr>
										<td class="tdrowk" width="110"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />�����湮��</td>
										<td class="tdrow"  width="220">
<?
if($member['mb_level'] > 6) {
?>
											<input name="electric_date_estimate" type="text" class="textfm" style="width:70px;ime-mode:disabled;float:left;" value="<?=$row['electric_date_estimate']?>" maxlength="10" onkeypress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')" />
											<table border="0" cellspacing="0" cellpadding="0" style="vertical-align:middle;float:left;"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif" alt="[" /></td><td style="background:url('./images/btn2_bg.gif')" class="ftbutton3_white"><a href="javascript:loadCalendar(document.dataForm.electric_date_estimate);">�޷�</a></td><td><img src="./images/btn2_rt.gif" alt="]" /></td> <td width="2"></td></tr></table>
<?
} else {
	if($row['electric_date_estimate']) echo $row['electric_date_estimate'];
	else echo "";
}
?>
										</td>
										<td class="tdrowk" width="110"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />���翹����</td>
										<td class="tdrow"  width="220">
<?
if($member['mb_level'] > 6) {
?>
											<input name="electric_date_expect" type="text" class="textfm" style="width:70px;ime-mode:disabled;float:left;" value="<?=$row['electric_date_expect']?>" maxlength="10" onkeypress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')" />
											<table border="0" cellspacing="0" cellpadding="0" style="vertical-align:middle;float:left;"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif" alt="[" /></td><td style="background:url('./images/btn2_bg.gif')" class="ftbutton3_white"><a href="javascript:loadCalendar(document.dataForm.electric_date_expect);">�޷�</a></td><td><img src="./images/btn2_rt.gif" alt="]" /></td> <td width="2"></td></tr></table>
<?
} else {
	if($row['electric_date_expect']) echo $row['electric_date_expect'];
	else echo "";
}
?>
										</td>
										<td class="tdrowk" width="110"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����Ϸ���</td>
										<td class="tdrow">
<?
if($member['mb_level'] > 6) {
?>
											<input name="electric_date_finish" type="text" class="textfm" style="width:70px;ime-mode:disabled;float:left;" value="<?=$row['electric_date_finish']?>" maxlength="10" onkeypress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')" />
											<table border="0" cellspacing="0" cellpadding="0" style="vertical-align:middle;float:left;"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif" alt="[" /></td><td style="background:url('./images/btn2_bg.gif')" class="ftbutton3_white"><a href="javascript:loadCalendar(document.dataForm.electric_date_finish);">�޷�</a></td><td><img src="./images/btn2_rt.gif" alt="]" /></td> <td width="2"></td></tr></table>
<?
} else {
	if($row['electric_date_finish']) echo $row['electric_date_finish'];
	else echo "";
}
?>
										</td>
									</tr>
									<tr>
										<td class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����� ���ݿϷ�</td>
										<td class="tdrow" colspan="5">
<?
if($member['mb_level'] > 6) {
?>
											<input name="electric_date_collect" type="text" class="textfm" style="width:70px;ime-mode:disabled;float:left;" value="<?=$row['electric_date_collect']?>" maxlength="10" onkeypress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')" />
											<table border="0" cellspacing="0" cellpadding="0" style="vertical-align:middle;float:left;"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif" alt="[" /></td><td style="background:url('./images/btn2_bg.gif')" class="ftbutton3_white"><a href="javascript:loadCalendar(document.dataForm.electric_date_collect);">�޷�</a></td><td><img src="./images/btn2_rt.gif" alt="]" /></td> <td width="2"></td></tr></table>
<?
} else {
	if($row['electric_date_collect']) echo $row['electric_date_collect'];
	else echo "";
}
?>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���б� ��Ȳ<font color="red"></font></td>
										<td nowrap class="tdrow" colspan="5">
<?
if($member['mb_level'] > 6) {
?>
											<textarea name="electric_charges_memo3" class="textfm" style='width:100%;height:76px;word-break:break-all;'><?=$row['electric_charges_memo3']?></textarea>
<?
} else {
	if($row['electric_charges_memo3']) echo "<pre style='word-wrap:break-word;white-space:pre-wrap;white-space:-moz-pre-wrap;white-space:-pre-wrap;white-space:-o-pre-wrap;word-break:break-all;'>".$row['electric_charges_memo3']."</pre>";
}
?>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����޸�<font color="red"></font></td>
										<td nowrap class="tdrow" colspan="5">
<?
if($row['electric_charges_memo2']) echo "<pre style='word-wrap:break-word;white-space:pre-wrap;white-space:-moz-pre-wrap;white-space:-pre-wrap;white-space:-o-pre-wrap;word-break:break-all;'>".$row['electric_charges_memo2']."</pre>";
?>
										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px"></div>
<?
//���縸 ǥ�� 160324
if($member['mb_level'] > 6) {
	//��ǥ�� ����
	if($member['mb_id'] == "kcmc1001") {
		$manage_div_display = "display:none;";
		$collection_div_display = "display:none;";
	} else {
		$manage_div_display = "";
		$collection_div_display = "";
	}
	//��� ����� 160516
	$manage_div_display = "display:none;";
	$collection_div_display = "display:none;";

	//������������ ù ��������Ȳ
	$sql2 = " select * from erp_application where com_code='$com_code' and application_kind=23 order by idx asc limit 0, 1 ";
	//echo $sql2;
	$result2 = sql_query($sql2);
	$row2 = mysql_fetch_array($result2);
	//���� 160912
	if($row2['down_payment']) $down_payment = number_format($row2['down_payment']);
	else $down_payment = "-";
	//�����
	if($row2['allowance_rate']) $allowance_rate = $row2['allowance_rate']."%";
	else $allowance_rate = "-";
	//�����(VAT����)
	if($row2['allowance_rate_vat_extra']) $allowance_rate_vat_extra = "(VAT����)";
	else $allowance_rate_vat_extra = "";
	//�����
	if($row2['person_charge']) $person_charge = $row2['person_charge'];
	else $person_charge = "-";
	//���ټ�(�뿪��)
	if($row2['grade_income_tax']) $grade_income_tax = "����";
	$grade_income_tax = "-";
?>
								<!--������-->
								<table border="0" cellspacing="0" cellpadding="0"> 
									<tr>
										<td> 
											<table border="0" cellspacing="0" cellpadding="0" onclick="var div_display='manage_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer">
												<tr> 
													<td><img src="images/g_tab_on_lt.gif" alt="[" /></td> 
													<td class="Sftbutton_white" style="width:90px;text-align:center;background:url('images/g_tab_on_bg.gif');"> 
														������
													</td> 
													<td><img src="images/g_tab_on_rt.gif" alt="]" /></td> 
												</tr> 
											</table> 
										</td> 
										<td width="6"></td> 
										<td valign="middle">
											
										</td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" id="manage_div" style="<?//=$manage_div_display?>">
									<tr>
										<td class="tdrow">
											<iframe id="iframe_electric_manage" src="iframe_electric_manage.php?id=<?=$id?>" frameborder="0" width="100%" height="200" onload="resizeFrame(this)" scrolling="auto" style="margin:4px 0 0 0"></iframe>
										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px"></div>

								<!--���ݰ��� ���� 160525 / ����(��ǥ�� ����) 160922-->
								<table border="0" cellspacing="0" cellpadding="0"> 
									<tr>
										<td> 
											<table border="0" cellspacing="0" cellpadding="0" onclick="var div_display='collection_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer">
												<tr> 
													<td><img src="images/g_tab_on_lt.gif" alt="[" /></td> 
													<td class="Sftbutton_white" style="width:90px;text-align:center;background:url('images/g_tab_on_bg.gif');"> 
														���ݰ���
													</td> 
													<td><img src="images/g_tab_on_rt.gif" alt="]" /></td> 
												</tr> 
											</table> 
										</td> 
										<td width="6"></td> 
										<td valign="middle">
											�� �г� : <?=$row['electric_charges_installment']?>ȸ
											/ ���� : <?=$down_payment?>
											/ ����� : <?=$allowance_rate?><?=$allowance_rate_vat_extra?>
											/ ����� : <?=$person_charge?>
											/ ���ټ� : <?=$grade_income_tax?>
										</td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" id="collection_div" style="<?//=$collection_div_display?>">
									<tr>
										<td class="tdrow">
											<iframe id="iframe_electric_collection" src="iframe_electric_collection.php?id=<?=$id?>" frameborder="0" width="100%" height="250" onload="" scrolling="auto" style="margin:4px 0 0 0"></iframe>
										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px"></div>
<?
//������ if�� ����
}
//������ ��ȣ
$app_no = 1;
//������ DB
$sql2 = " select * from erp_application where com_code='$com_code' and application_kind=25 order by idx asc ";
//echo $sql2;
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
														<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100px;text-align:center'> 
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
									<input type="hidden" name="idx<?=$k?>" value="<?=$idx?>" />
									<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
										<tr>
											<td nowrap rowspan="" class="tdrowk" width="110">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">��û�ݾ�
											</td>
											<td nowrap class="tdrow" width="120">
<?=number_format($row2['application_fee_sum'])?>
											</td>
											<td nowrap rowspan="" class="tdrowk" width="130">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���ݼ��ݰ�꼭
											</td>
											<td nowrap class="tdrow" width="120">
<?=$row2['down_payment_tax']?>
											</td>
											<td nowrap rowspan="" class="tdrowk" width="110">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�����Ա���
											</td>
											<td nowrap class="tdrow" width="120">
<?=$row2['down_payment_date']?>
											</td>
											<td nowrap rowspan="" class="tdrowk" width="110">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����
											</td>
											<td nowrap class="tdrow">
<?=number_format($row2['down_payment'])?>
											</td>
										</tr>
										<tr>
											<td nowrap rowspan="" class="tdrowk" width="">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�ܱ�������
											</td>
											<td nowrap class="tdrow">
<?=$row2['remainder_date']?>
											</td>
											<td nowrap rowspan="" class="tdrowk" width="">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�ܱ�
												<input type="checkbox" name="remainder_vat<?=$k?>" value="1" <? if($row2['remainder_vat'] == 1) echo "checked"; ?> style="margin-left:0;vertical-align:middle" /><span style="font-size:8pt">VAT����</span>
											</td>
											<td nowrap class="tdrow">
<?=number_format($row2['remainder'])?>
											</td>
											<td nowrap rowspan="" class="tdrowk" width="">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�ŷ�����
											</td>
											<td nowrap class="tdrow">
<?=$row2['statement_date']?>
											</td>
											<td nowrap rowspan="" class="tdrowk" width="">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">û���ݾ�(�ŷ�)
											</td>
											<td nowrap class="tdrow">
<?=number_format($row2['requested_amount'])?>
											</td>
										</tr>
										<tr>
											<td nowrap rowspan="" class="tdrowk" width="">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���ݰ�꼭
											</td>
											<td nowrap class="tdrow">
<?=$row2['tax_invoice']?>
											</td>
											<td nowrap rowspan="" class="tdrowk" width="">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�����Ա���
											</td>
											<td nowrap class="tdrow">
<?=$row2['main_receipt_date']?>
											</td>
											<td nowrap colspan="3" class="tdrowk" width="">
												<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�����Աݱݾ�(�ΰ���<b>����</b>)
											</td>
											<td nowrap class="tdrow">
<?
if($row2['main_receipt_fee']) $main_receipt_fee = number_format($row2['main_receipt_fee']);
else $main_receipt_fee = "";
echo $main_receipt_fee = "";
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
if($receipt_place == 1) echo "�Ѱ�";
else if($receipt_place == 2) echo "��ȣ��";
else echo "";
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
echo $person_charge;
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
echo $app_memo;
?>
											</td>
										</tr>
									</table>
									<div style="height:10px;font-size:0px"></div>
<?
}
//������ for�� end
?>



									<div style="height:10px;font-size:0px"></div>
									<!--÷�μ���-->
									<table border=0 cellspacing=0 cellpadding=0> 
										<tr>
											<td id=""> 
												<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='filename_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer">
													<tr> 
														<td><img src="images/sb_tab_on_lt.gif"></td> 
														<td background="images/sb_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:140;text-align:center'> 
															÷�μ��� (�⺻����)
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
<?
//��ǥ�� ����
if($member['mb_id'] == "kcmc1001") {
	if(!$row['filename_1'] && !$row['filename_2'] && !$row['filename_3'] && !$row['filename_4'] && !$row['filename_5'] && !$row['filename_6'] && !$row['filename_7'] && !$row['filename_8']) {
		$filename_div_display = "display:none;";
	}
}
else $filename_div_display = "";
//���ϸ� ��¥ �ð� ���� ǥ�� 160201
if($row['filename_1']) $filename_1 = mb_substr($row['filename_1'],16,99,'euc-kr');
if($row['filename_2']) $filename_2 = mb_substr($row['filename_2'],16,99,'euc-kr');
if($row['filename_3']) $filename_3 = mb_substr($row['filename_3'],16,99,'euc-kr');
if($row['filename_4']) $filename_4 = mb_substr($row['filename_4'],16,99,'euc-kr');
if($row['filename_5']) $filename_5 = mb_substr($row['filename_5'],16,99,'euc-kr');
if($row['filename_6']) $filename_6 = mb_substr($row['filename_6'],16,99,'euc-kr');
if($row['filename_7']) $filename_7 = mb_substr($row['filename_7'],16,99,'euc-kr');
if($row['filename_8']) $filename_8 = mb_substr($row['filename_8'],16,99,'euc-kr');
?>
									<div id="filename_div" style="<?=$filename_div_display?>">
									<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
										<tr>
											<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����1
											</td>
											<td   class="tdrow" width="373">
												<a href="files/contract/<?=$row['filename_1']?>" target="_blank"><?=$filename_1?></a>
											</td>
											<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����2</td>
											<td   class="tdrow" >
												<a href="files/contract/<?=$row['filename_2']?>" target="_blank"><?=$filename_2?></a>
											</td>
										</tr>
										<tr id="file_tr2" style="<? if(!$row['filename_3'] && !$row['filename_4']) echo "display:none"; ?>">
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����3</td>
											<td   class="tdrow" >
												<a href="files/contract/<?=$row['filename_3']?>" target="_blank"><?=$filename_3?></a>
											</td>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����4</td>
											<td   class="tdrow" >
												<a href="files/contract/<?=$row['filename_4']?>" target="_blank"><?=$filename_4?></a>
											</td>
										</tr>
										<tr id="file_tr3" style="<? if(!$row['filename_5'] && !$row['filename_6']) echo "display:none"; ?>">
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����5</td>
											<td   class="tdrow" >
												<a href="files/contract/<?=$row['filename_5']?>" target="_blank"><?=$filename_5?></a>
											</td>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����6</td>
											<td   class="tdrow" >
												<a href="files/contract/<?=$row['filename_6']?>" target="_blank"><?=$filename_6?></a>
											</td>
										</tr>
										<tr id="file_tr4" style="<? if(!$row['filename_7'] && !$row['filename_8']) echo "display:none"; ?>">
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����7</td>
											<td   class="tdrow" >
												<a href="files/contract/<?=$row['filename_7']?>" target="_blank"><?=$filename_7?></a>
											</td>
											<td nowrap class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����8</td>
											<td   class="tdrow" >
												<a href="files/contract/<?=$row['filename_8']?>" target="_blank"><?=$filename_8?></a>
											</td>
										</tr>
									</table>
								</div>
								<div style="height:10px;font-size:0px"></div>

								<!--÷�μ���-->
								<table border="0" cellspacing="0" cellpadding="0"> 
									<tr>
										<td> 
											<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='electric_charges_file_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer">
												<tr> 
													<td><img src="images/sb_tab_on_lt.gif" alt="[" /></td> 
													<td class="Sftbutton_white" style="width:110px;text-align:center;background:url('images/sb_tab_on_bg.gif');"> 
														÷�μ���(������)
													</td> 
													<td><img src="images/sb_tab_on_rt.gif" alt="]" /></td> 
												</tr> 
											</table> 
										</td> 
										<td width="6"></td> 
										<td valign="middle"></td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bbtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
<?
//��ǥ�� ����
if($member['mb_id'] == "kcmc1001") {
	if(!$row['electric_charges_file_1'] && !$row['electric_charges_file_2'] && !$row['electric_charges_file_3'] && !$row['electric_charges_file_4'] && !$row['electric_charges_file_5'] && !$row['electric_charges_file_6'] && !$row['electric_charges_file_7'] && !$row['electric_charges_file_8']) {
		$electric_charges_file_div_display = "display:none;";
	}
}
else $electric_charges_file_div_display = "";
?>
								<div id="electric_charges_file_div" style="<?=$electric_charges_file_div_display?>">
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<tr>
										<td nowrap class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0"><b>÷�μ���</b><font color="red"></font></td>
										<td class="tdrow" colspan="3">
<?
//����� ���� ���� 150824
$is_damdang = "ok";
//÷�μ���(������) üũ 160411
$electric_charges_file_check = explode(',',$row['electric_charges_file_check']);
if($is_damdang == "ok") {
?>
											<input type="checkbox" name="e_file_check1" value="1" <? if($electric_charges_file_check[0] == 1) echo "checked"; ?> style="vertical-align:middle">1����������ǥ(��� ��)
											<input type="checkbox" name="e_file_check2" value="1" <? if($electric_charges_file_check[1] == 1) echo "checked"; ?> style="vertical-align:middle">�������ǥ(����Ϸ� ��)
<?
} else {
	if($electric_charges_file_check[0]) echo "������ǥ. ";
	if($electric_charges_file_check[1]) echo ". ";
	if($electric_charges_file_check[2]) echo ". ";
}
?>
										</td>
									</tr>
									<tr>
										<td class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����1 <? if($is_damdang == "ok") { ?><input type="checkbox" name="electric_charges_file_hidden_del_1" value="1" style="vertical-align:middle" />����<? } ?>
<?
if($is_damdang == "ok") {
?>
											<div style="margin:4px 0 0 0">
												<img src="./images/icon_blank.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" /><a href="javascript:field_add('electric_charges_file_tr');"><img src="images/btn_add.png" border="0" style="vertical-align:middle" alt="+" /> <span  style="">�߰�</span></a>
											</div>
<?
}
if($row['electric_charges_file_1']) $electric_charges_file_1 = mb_substr($row['electric_charges_file_1'],16,99,'euc-kr');
if($row['electric_charges_file_2']) $electric_charges_file_2 = mb_substr($row['electric_charges_file_2'],16,99,'euc-kr');
if($row['electric_charges_file_3']) $electric_charges_file_3 = mb_substr($row['electric_charges_file_3'],16,99,'euc-kr');
if($row['electric_charges_file_4']) $electric_charges_file_4 = mb_substr($row['electric_charges_file_4'],16,99,'euc-kr');
if($row['electric_charges_file_5']) $electric_charges_file_5 = mb_substr($row['electric_charges_file_5'],16,99,'euc-kr');
if($row['electric_charges_file_6']) $electric_charges_file_6 = mb_substr($row['electric_charges_file_6'],16,99,'euc-kr');
if($row['electric_charges_file_7']) $electric_charges_file_7 = mb_substr($row['electric_charges_file_7'],16,99,'euc-kr');
if($row['electric_charges_file_8']) $electric_charges_file_8 = mb_substr($row['electric_charges_file_8'],16,99,'euc-kr');
?>
										</td>
										<td   class="tdrow" width="373">
											<? if($is_damdang == "ok") { ?><input name="electric_charges_file_1" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<a href="files/electric_charges/<?=$row['electric_charges_file_1']?>" target="_blank"><?=$electric_charges_file_1?></a>
											<input type="hidden" name="electric_charges_file_hidden_1" value="<?=$row['electric_charges_file_1']?>" />
										</td>
										<td class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����2 <? if($is_damdang == "ok") { ?><input type="checkbox" name="electric_charges_file_hidden_del_2" value="1" style="vertical-align:middle" />����<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang == "ok") { ?><input name="electric_charges_file_2" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<a href="files/electric_charges/<?=$row['electric_charges_file_2']?>" target="_blank"><?=$electric_charges_file_2?></a>
											<input type="hidden" name="electric_charges_file_hidden_2" value="<?=$row['electric_charges_file_2']?>" />
										</td>
									</tr>
									<tr id="electric_charges_file_tr2" style="<? if(!$row['electric_charges_file_3'] && !$row['electric_charges_file_4']) echo "display:none"; ?>">
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����3 <? if($is_damdang == "ok") { ?><input type="checkbox" name="electric_charges_file_hidden_del_3" value="1" style="vertical-align:middle" />����<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang == "ok") { ?><input name="electric_charges_file_3" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<a href="files/electric_charges/<?=$row['electric_charges_file_3']?>" target="_blank"><?=$electric_charges_file_3?></a>
											<input type="hidden" name="electric_charges_file_hidden_3" value="<?=$row['electric_charges_file_3']?>" />
										</td>
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����4 <? if($is_damdang == "ok") { ?><input type="checkbox" name="electric_charges_file_hidden_del_4" value="1" style="vertical-align:middle" />����<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang == "ok") { ?><input name="electric_charges_file_4" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<a href="files/electric_charges/<?=$row['electric_charges_file_4']?>" target="_blank"><?=$electric_charges_file_4?></a>
											<input type="hidden" name="electric_charges_file_hidden_4" value="<?=$row['electric_charges_file_4']?>" />
										</td>
									</tr>
									<tr id="electric_charges_file_tr3" style="<? if(!$row['electric_charges_file_5'] && !$row['electric_charges_file_6']) echo "display:none"; ?>">
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����5 <? if($is_damdang == "ok") { ?><input type="checkbox" name="electric_charges_file_hidden_del_5" value="1" style="vertical-align:middle" />����<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang == "ok") { ?><input name="electric_charges_file_5" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<a href="files/electric_charges/<?=$row['electric_charges_file_5']?>" target="_blank"><?=$electric_charges_file_5?></a>
											<input type="hidden" name="electric_charges_file_hidden_5" value="<?=$row['electric_charges_file_5']?>" />
										</td>
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����6 <? if($is_damdang == "ok") { ?><input type="checkbox" name="electric_charges_file_hidden_del_6" value="1" style="vertical-align:middle" />����<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang == "ok") { ?><input name="electric_charges_file_6" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<a href="files/electric_charges/<?=$row['electric_charges_file_6']?>" target="_blank"><?=$electric_charges_file_6?></a>
											<input type="hidden" name="electric_charges_file_hidden_6" value="<?=$row['electric_charges_file_6']?>" />
										</td>
									</tr>
									<tr id="electric_charges_file_tr4" style="<? if(!$row['electric_charges_file_7'] && !$row['electric_charges_file_8']) echo "display:none"; ?>">
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����7 <? if($is_damdang == "ok") { ?><input type="checkbox" name="electric_charges_file_hidden_del_7" value="1" style="vertical-align:middle" />����<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang == "ok") { ?><input name="electric_charges_file_7" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<a href="files/electric_charges/<?=$row['electric_charges_file_7']?>" target="_blank"><?=$electric_charges_file_7?></a>
											<input type="hidden" name="electric_charges_file_hidden_7" value="<?=$row['electric_charges_file_7']?>" />
										</td>
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����8 <? if($is_damdang == "ok") { ?><input type="checkbox" name="electric_charges_file_hidden_del_8" value="1" style="vertical-align:middle" />����<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang == "ok") { ?><input name="electric_charges_file_8" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<a href="files/electric_charges/<?=$row['electric_charges_file_8']?>" target="_blank"><?=$electric_charges_file_8?></a>
											<input type="hidden" name="electric_charges_file_hidden_8" value="<?=$row['electric_charges_file_8']?>" />
										</td>
									</tr>
								</table>
								</div>
<?
//���� ����
if($member['mb_level'] > 6) {
	if($row['electric_charges_secret_1']) $electric_charges_secret_1 = mb_substr($row['electric_charges_secret_1'],16,99,'euc-kr');
	if($row['electric_charges_secret_2']) $electric_charges_secret_2 = mb_substr($row['electric_charges_secret_2'],16,99,'euc-kr');
	if($row['electric_charges_secret_3']) $electric_charges_secret_3 = mb_substr($row['electric_charges_secret_3'],16,99,'euc-kr');
	if($row['electric_charges_secret_4']) $electric_charges_secret_4 = mb_substr($row['electric_charges_secret_4'],16,99,'euc-kr');
	if($row['electric_charges_secret_5']) $electric_charges_secret_5 = mb_substr($row['electric_charges_secret_5'],16,99,'euc-kr');
	if($row['electric_charges_secret_6']) $electric_charges_secret_6 = mb_substr($row['electric_charges_secret_6'],16,99,'euc-kr');
	if($row['electric_charges_secret_7']) $electric_charges_secret_7 = mb_substr($row['electric_charges_secret_7'],16,99,'euc-kr');
	if($row['electric_charges_secret_8']) $electric_charges_secret_8 = mb_substr($row['electric_charges_secret_8'],16,99,'euc-kr');
	//���ȼ��� -> �������� ���� 160517 -> �ٽ� ���ȼ��� 160523

	//��ǥ�� ����
	if($member['mb_id'] == "kcmc1001") {
		if(!$row['electric_charges_secret_1'] && !$row['electric_charges_secret_2'] && !$row['electric_charges_secret_3'] && !$row['electric_charges_secret_4'] && !$row['electric_charges_secret_5'] && !$row['electric_charges_secret_6'] && !$row['electric_charges_secret_7'] && !$row['electric_charges_secret_8']) {
			$electric_charges_secret_div_display = "display:none;";
		}
	}
	else $electric_charges_secret_div_display = "";
?>
								<div style="height:10px;font-size:0px"></div>
								<!--���ȼ���-->
								<table border="0" cellspacing="0" cellpadding="0"> 
									<tr>
										<td> 
											<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='electric_charges_secret_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer">
												<tr> 
													<td><img src="images/sb_tab_on_lt.gif"></td> 
													<td background="images/sb_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:140;text-align:center'> 
														÷�μ���(���ȼ���)
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
								<div id="electric_charges_secret_div" style="<?=$electric_charges_secret_div_display?>">
									<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
										<tr>
											<td class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����1 <? if($is_damdang == "ok") { ?><input type="checkbox" name="electric_charges_secret_hidden_del_1" value="1" style="vertical-align:middle" />����<? } ?>
<?
	//����� ���� ���� 150824
	$is_damdang = "ok";
	if($is_damdang == "ok") {
?>
												<div style="margin:4px 0 0 0">
													<img src="./images/icon_blank.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" /><a href="javascript:field_add('electric_charges_secret_tr');"><img src="images/btn_add.png" border="0" style="vertical-align:middle" alt="+" /> <span  style="">�߰�</span></a>
												</div>
<?
	}
?>
											</td>
											<td   class="tdrow" width="373">
												<? if($is_damdang == "ok") { ?><input name="electric_charges_secret_1" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
												<a href="files/electric_charges/<?=$row['electric_charges_secret_1']?>" target="_blank"><?=$electric_charges_secret_1?></a>
												<input type="hidden" name="electric_charges_secret_hidden_1" value="<?=$row['electric_charges_secret_1']?>" />
											</td>
											<td class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����2 <? if($is_damdang == "ok") { ?><input type="checkbox" name="electric_charges_secret_hidden_del_2" value="1" style="vertical-align:middle" />����<? } ?></td>
											<td   class="tdrow" >
												<? if($is_damdang == "ok") { ?><input name="electric_charges_secret_2" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
												<a href="files/electric_charges/<?=$row['electric_charges_secret_2']?>" target="_blank"><?=$electric_charges_secret_2?></a>
												<input type="hidden" name="electric_charges_secret_hidden_2" value="<?=$row['electric_charges_secret_2']?>" />
											</td>
										</tr>
										<tr id="electric_charges_secret_tr2" style="<? if(!$row['electric_charges_secret_3'] && !$row['electric_charges_secret_4']) echo "display:none"; ?>">
											<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����3 <? if($is_damdang == "ok") { ?><input type="checkbox" name="electric_charges_secret_hidden_del_3" value="1" style="vertical-align:middle" />����<? } ?></td>
											<td   class="tdrow" >
												<? if($is_damdang == "ok") { ?><input name="electric_charges_secret_3" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
												<a href="files/electric_charges/<?=$row['electric_charges_secret_3']?>" target="_blank"><?=$electric_charges_secret_3?></a>
												<input type="hidden" name="electric_charges_secret_hidden_3" value="<?=$row['electric_charges_secret_3']?>" />
											</td>
											<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����4 <? if($is_damdang == "ok") { ?><input type="checkbox" name="electric_charges_secret_hidden_del_4" value="1" style="vertical-align:middle" />����<? } ?></td>
											<td   class="tdrow" >
												<? if($is_damdang == "ok") { ?><input name="electric_charges_secret_4" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
												<a href="files/electric_charges/<?=$row['electric_charges_secret_4']?>" target="_blank"><?=$electric_charges_secret_4?></a>
												<input type="hidden" name="electric_charges_secret_hidden_4" value="<?=$row['electric_charges_secret_4']?>" />
											</td>
										</tr>
										<tr id="electric_charges_secret_tr3" style="<? if(!$row['electric_charges_secret_5'] && !$row['electric_charges_secret_6']) echo "display:none"; ?>">
											<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����5 <? if($is_damdang == "ok") { ?><input type="checkbox" name="electric_charges_secret_hidden_del_5" value="1" style="vertical-align:middle" />����<? } ?></td>
											<td   class="tdrow" >
												<? if($is_damdang == "ok") { ?><input name="electric_charges_secret_5" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
												<a href="files/electric_charges/<?=$row['electric_charges_secret_5']?>" target="_blank"><?=$electric_charges_secret_5?></a>
												<input type="hidden" name="electric_charges_secret_hidden_5" value="<?=$row['electric_charges_secret_5']?>" />
											</td>
											<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����6 <? if($is_damdang == "ok") { ?><input type="checkbox" name="electric_charges_secret_hidden_del_6" value="1" style="vertical-align:middle" />����<? } ?></td>
											<td   class="tdrow" >
												<? if($is_damdang == "ok") { ?><input name="electric_charges_secret_6" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
												<a href="files/electric_charges/<?=$row['electric_charges_secret_6']?>" target="_blank"><?=$electric_charges_secret_6?></a>
												<input type="hidden" name="electric_charges_secret_hidden_6" value="<?=$row['electric_charges_secret_6']?>" />
											</td>
										</tr>
										<tr id="electric_charges_secret_tr4" style="<? if(!$row['electric_charges_secret_7'] && !$row['electric_charges_secret_8']) echo "display:none"; ?>">
											<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����7 <? if($is_damdang == "ok") { ?><input type="checkbox" name="electric_charges_secret_hidden_del_7" value="1" style="vertical-align:middle" />����<? } ?></td>
											<td   class="tdrow" >
												<? if($is_damdang == "ok") { ?><input name="electric_charges_secret_7" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
												<a href="files/electric_charges/<?=$row['electric_charges_secret_7']?>" target="_blank"><?=$electric_charges_secret_7?></a>
												<input type="hidden" name="electric_charges_secret_hidden_7" value="<?=$row['electric_charges_secret_7']?>" />
											</td>
											<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����8 <? if($is_damdang == "ok") { ?><input type="checkbox" name="electric_charges_secret_hidden_del_8" value="1" style="vertical-align:middle" />����<? } ?></td>
											<td   class="tdrow" >
												<? if($is_damdang == "ok") { ?><input name="electric_charges_secret_8" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
												<a href="files/electric_charges/<?=$row['electric_charges_secret_8']?>" target="_blank"><?=$electric_charges_secret_8?></a>
												<input type="hidden" name="electric_charges_secret_hidden_8" value="<?=$row['electric_charges_secret_8']?>" />
											</td>
										</tr>
									</table>
								</div>
<?
	if($row['electric_charges_search_1']) $electric_charges_search_1 = mb_substr($row['electric_charges_search_1'],16,99,'euc-kr');

	//��ǥ�� ����
	if($member['mb_id'] == "kcmc1001") {
		if(!$row['electric_charges_search_1']) {
			$electric_charges_search_div_display = "display:none;";
		}
	}
	else $electric_charges_search_div_display = "";
?>
								<div style="display:nonel">
								<div style="height:10px;font-size:0px"></div>
								<table border="0" cellspacing="0" cellpadding="0"> 
									<tr>
										<td> 
											<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='electric_charges_search_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer">
												<tr> 
													<td><img src="images/g_tab_on_lt.gif" alt="[" /></td> 
													<td class="Sftbutton_white" style="width:110px;text-align:center;background:url('images/g_tab_on_bg.gif');"> 
														�����ݻ���ȸ
													</td> 
													<td><img src="images/g_tab_on_rt.gif" alt="]" /></td> 
												</tr> 
											</table> 
										</td> 
										<td width="6"></td> 
										<td valign="middle"></td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<div id="electric_charges_search_div" style="<?=$electric_charges_search_div_display?>">
									<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1">
										<tr>
											<td class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />���� <? if($is_damdang == "ok") { ?><input type="checkbox" name="electric_charges_search_hidden_del_1" value="1" style="vertical-align:middle" />����<? } ?>
											</td>
											<td class="tdrow">
												<? if($is_damdang == "ok") { ?><input name="electric_charges_search_1" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><? } ?>
												<a href="files/electric_charges/<?=$row['electric_charges_search_1']?>" target="_blank"><?=$electric_charges_search_1?></a>
												<input type="hidden" name="electric_charges_search_hidden_1" value="<?=$row['electric_charges_search_1']?>" />
											</td>
										</tr>
									</table>
								</div>
<?
}
//���� ���� ����
?>

<?
//����, �������, ���翭�� ���� 160920
if( ($member['mb_level'] > 6 || $member['mb_level'] == 2) || $row['electric_charges_construct_open'] ) {
	if($row['electric_charges_construct_1']) $electric_charges_construct_1 = mb_substr($row['electric_charges_construct_1'],16,99,'euc-kr');
	if($row['electric_charges_construct_2']) $electric_charges_construct_2 = mb_substr($row['electric_charges_construct_2'],16,99,'euc-kr');
	if($row['electric_charges_construct_3']) $electric_charges_construct_3 = mb_substr($row['electric_charges_construct_3'],16,99,'euc-kr');
	if($row['electric_charges_construct_4']) $electric_charges_construct_4 = mb_substr($row['electric_charges_construct_4'],16,99,'euc-kr');
	if($row['electric_charges_construct_5']) $electric_charges_construct_5 = mb_substr($row['electric_charges_construct_5'],16,99,'euc-kr');
	if($row['electric_charges_construct_6']) $electric_charges_construct_6 = mb_substr($row['electric_charges_construct_6'],16,99,'euc-kr');
	if($row['electric_charges_construct_7']) $electric_charges_construct_7 = mb_substr($row['electric_charges_construct_7'],16,99,'euc-kr');
	if($row['electric_charges_construct_8']) $electric_charges_construct_8 = mb_substr($row['electric_charges_construct_8'],16,99,'euc-kr');

	//��ǥ�� ����
	if($member['mb_id'] == "kcmc1001") {
		if(!$row['electric_charges_construct_1'] && !$row['electric_charges_construct_2'] && !$row['electric_charges_construct_3'] && !$row['electric_charges_construct_4'] && !$row['electric_charges_construct_5'] && !$row['electric_charges_construct_6'] && !$row['electric_charges_construct_7'] && !$row['electric_charges_construct_8']) {
			$electric_charges_construct_div_display = "display:none;";
		}
	}
	else $electric_charges_construct_div_display = "";
?>
								<div style="height:10px;font-size:0px"></div>
								<!--�������-->
								<table border="0" cellspacing="0" cellpadding="0"> 
									<tr>
										<td> 
											<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='electric_charges_construct_div';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer">
												<tr> 
													<td><img src="images/g_tab_on_lt.gif" alt="[" /></td> 
													<td class="Sftbutton_white" style="width:110px;text-align:center;background:url('images/g_tab_on_bg.gif');"> 
														÷�μ���(�������)
													</td> 
													<td><img src="images/g_tab_on_rt.gif" alt="]" /></td> 
												</tr> 
											</table> 
										</td> 
										<td width="6"></td> 
										<td valign="middle">
<?
//���� ���� / ���翭�� 160919
if($member['mb_level'] > 6) {
	$is_damdang = "ok";
?>
											<input type="checkbox" name="electric_charges_construct_open" value="1" <? if($row['electric_charges_construct_open'] == 1) echo "checked"; ?> onclick="electric_charges_construct_open_chk(this);" style="vertical-align:middle" />���翭��
											<iframe name="check_ok_iframe" src="electric_charges_construct_open_update.php" style="width:0;height:0" frameborder="0"></iframe>
<?
//�����ü ��� ����
} else if($member['mb_level'] == 2) {
	$is_damdang = "ok";
?>

<?
} else {
	$is_damdang = "";
}
?>
										</td>
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<div id="electric_charges_construct_div" style="<?=$electric_charges_construct_div_display?>">
									<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
										<tr>
											<td class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����1 <? if($is_damdang == "ok") { ?><input type="checkbox" name="electric_charges_construct_hidden_del_1" value="1" style="vertical-align:middle" />����<? } ?>
<?
	//����� ���� ���� 150824
	//$is_damdang = "ok";
	if($is_damdang == "ok") {
?>
												<div style="margin:4px 0 0 0">
													<img src="./images/icon_blank.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" /><a href="javascript:field_add('electric_charges_construct_tr');"><img src="images/btn_add.png" border="0" style="vertical-align:middle" alt="+" /> <span  style="">�߰�</span></a>
												</div>
<?
	}
?>
											</td>
											<td   class="tdrow" width="373">
												<? if($is_damdang == "ok") { ?><input name="electric_charges_construct_1" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
												<a href="files/electric_charges/<?=$row['electric_charges_construct_1']?>" target="_blank"><?=$electric_charges_construct_1?></a>
												<input type="hidden" name="electric_charges_construct_hidden_1" value="<?=$row['electric_charges_construct_1']?>" />
											</td>
											<td class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����2 <? if($is_damdang == "ok") { ?><input type="checkbox" name="electric_charges_construct_hidden_del_2" value="1" style="vertical-align:middle" />����<? } ?></td>
											<td   class="tdrow" >
												<? if($is_damdang == "ok") { ?><input name="electric_charges_construct_2" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
												<a href="files/electric_charges/<?=$row['electric_charges_construct_2']?>" target="_blank"><?=$electric_charges_construct_2?></a>
												<input type="hidden" name="electric_charges_construct_hidden_2" value="<?=$row['electric_charges_construct_2']?>" />
											</td>
										</tr>
										<tr id="electric_charges_construct_tr2" style="<? if(!$row['electric_charges_construct_3'] && !$row['electric_charges_construct_4']) echo "display:none"; ?>">
											<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����3 <? if($is_damdang == "ok") { ?><input type="checkbox" name="electric_charges_construct_hidden_del_3" value="1" style="vertical-align:middle" />����<? } ?></td>
											<td   class="tdrow" >
												<? if($is_damdang == "ok") { ?><input name="electric_charges_construct_3" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
												<a href="files/electric_charges/<?=$row['electric_charges_construct_3']?>" target="_blank"><?=$electric_charges_construct_3?></a>
												<input type="hidden" name="electric_charges_construct_hidden_3" value="<?=$row['electric_charges_construct_3']?>" />
											</td>
											<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����4 <? if($is_damdang == "ok") { ?><input type="checkbox" name="electric_charges_construct_hidden_del_4" value="1" style="vertical-align:middle" />����<? } ?></td>
											<td   class="tdrow" >
												<? if($is_damdang == "ok") { ?><input name="electric_charges_construct_4" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
												<a href="files/electric_charges/<?=$row['electric_charges_construct_4']?>" target="_blank"><?=$electric_charges_construct_4?></a>
												<input type="hidden" name="electric_charges_construct_hidden_4" value="<?=$row['electric_charges_construct_4']?>" />
											</td>
										</tr>
										<tr id="electric_charges_construct_tr3" style="<? if(!$row['electric_charges_construct_5'] && !$row['electric_charges_construct_6']) echo "display:none"; ?>">
											<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����5 <? if($is_damdang == "ok") { ?><input type="checkbox" name="electric_charges_construct_hidden_del_5" value="1" style="vertical-align:middle" />����<? } ?></td>
											<td   class="tdrow" >
												<? if($is_damdang == "ok") { ?><input name="electric_charges_construct_5" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
												<a href="files/electric_charges/<?=$row['electric_charges_construct_5']?>" target="_blank"><?=$electric_charges_construct_5?></a>
												<input type="hidden" name="electric_charges_construct_hidden_5" value="<?=$row['electric_charges_construct_5']?>" />
											</td>
											<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����6 <? if($is_damdang == "ok") { ?><input type="checkbox" name="electric_charges_construct_hidden_del_6" value="1" style="vertical-align:middle" />����<? } ?></td>
											<td   class="tdrow" >
												<? if($is_damdang == "ok") { ?><input name="electric_charges_construct_6" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
												<a href="files/electric_charges/<?=$row['electric_charges_construct_6']?>" target="_blank"><?=$electric_charges_construct_6?></a>
												<input type="hidden" name="electric_charges_construct_hidden_6" value="<?=$row['electric_charges_construct_6']?>" />
											</td>
										</tr>
										<tr id="electric_charges_construct_tr4" style="<? if(!$row['electric_charges_construct_7'] && !$row['electric_charges_construct_8']) echo "display:none"; ?>">
											<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����7 <? if($is_damdang == "ok") { ?><input type="checkbox" name="electric_charges_construct_hidden_del_7" value="1" style="vertical-align:middle" />����<? } ?></td>
											<td   class="tdrow" >
												<? if($is_damdang == "ok") { ?><input name="electric_charges_construct_7" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
												<a href="files/electric_charges/<?=$row['electric_charges_construct_7']?>" target="_blank"><?=$electric_charges_construct_7?></a>
												<input type="hidden" name="electric_charges_construct_hidden_7" value="<?=$row['electric_charges_construct_7']?>" />
											</td>
											<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����8 <? if($is_damdang == "ok") { ?><input type="checkbox" name="electric_charges_construct_hidden_del_8" value="1" style="vertical-align:middle" />����<? } ?></td>
											<td   class="tdrow" >
												<? if($is_damdang == "ok") { ?><input name="electric_charges_construct_8" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
												<a href="files/electric_charges/<?=$row['electric_charges_construct_8']?>" target="_blank"><?=$electric_charges_construct_8?></a>
												<input type="hidden" name="electric_charges_construct_hidden_8" value="<?=$row['electric_charges_construct_8']?>" />
											</td>
										</tr>
									</table>
<?
}
?>
								</div>
<?
//������� ��ü for��
$w_user_arry[1] = "el1001";
$w_user_arry[2] = "el1002";
$w_user_arry[3] = "el1003";
$w_user_arry[4] = "el1004";
$w_user_arry[5] = "el1005";
//$i = 1;
for($i=1; $i<=5; $i++) {
	//���� ���� / ���� ���� �� ǥ��
	if($member['mb_level'] > 6 || $row['electric_charges_construct_open'.$i]) {
		//��������ü ÷������ 161006
		$sql_file = " select * from electric_charges_file where com_code='$com_code' and w_user='$w_user_arry[$i]' ";
		//echo $sql_file;
		$result_file = sql_query($sql_file);
		$row_file=mysql_fetch_array($result_file);
		$file_1 = mb_substr($row_file['file_1'],16,99,'euc-kr');
		$file_2 = mb_substr($row_file['file_2'],16,99,'euc-kr');
		$file_3 = mb_substr($row_file['file_3'],16,99,'euc-kr');
		$file_4 = mb_substr($row_file['file_4'],16,99,'euc-kr');
		$file_5 = mb_substr($row_file['file_5'],16,99,'euc-kr');
		$file_6 = mb_substr($row_file['file_6'],16,99,'euc-kr');
		$file_7 = mb_substr($row_file['file_7'],16,99,'euc-kr');
		$file_8 = mb_substr($row_file['file_8'],16,99,'euc-kr');

		//��ǥ�� ����
		/*if($member['mb_id'] == "kcmc1001") {
			//echo $row_file['file_1'];
			if(!$row_file['file_1'] && !$row_file['file_2'] && !$row_file['file_3'] && !$row_file['file_4'] && !$row_file['file_5'] && !$row_file['file_6'] && !$row_file['file_7'] && !$row_file['file_8']) {
				$electric_construct_file_div_display = "display:none;";
			}
		}
		else*/ $electric_construct_file_div_display = "";
?>
								<div style="height:10px;font-size:0px"></div>
								<table border="0" cellspacing="0" cellpadding="0"> 
									<tr>
										<td> 
											<table border="0" cellpadding="0" cellspacing="0" onclick="var div_display='electric_construct_file_div_<?=$w_user_arry[$i]?>';if(getId(div_display).style.display=='none') { getId(div_display).style.display='';} else { getId(div_display).style.display='none';}" style="cursor:pointer">
												<tr> 
													<td><img src="images/sb_tab_on_lt.gif" alt="[" /></td> 
													<td class="Sftbutton_white" style="width:130px;text-align:center;background:url('images/sb_tab_on_bg.gif');"> 
														÷�μ���(<?=$electric_charges_construct_arry[$i]?>)
													</td> 
													<td><img src="images/sb_tab_on_rt.gif" alt="]" /></td> 
												</tr> 
											</table> 
										</td> 
										<td width="6"></td> 
										<td valign="middle">
<?
		//���� ���� / ���翭�� 161108
		if($member['mb_level'] > 6) {
?>
											<input type="checkbox" name="electric_charges_construct_open<?=$i?>" value="1" <? if($row['electric_charges_construct_open'.$i] == 1) echo "checked"; ?> onclick="electric_charges_construct_open_individual_chk(this, <?=$i?>);" style="vertical-align:middle" />���翭��
<?
		}
?>
										</td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bbtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<div id="electric_construct_file_div_<?=$w_user_arry[$i]?>" style="<?=$electric_construct_file_div_display?>">
<?
		//��ǥ�Ը� ��������ü ���� ���� ���ε� ��� ���� 161111 / ������ ���� �߰� 161216
		if($member['mb_id'] == "kcmc1001" || $member['mb_id'] == "kcmc1003") $is_damdang_file = "ok";
		else $is_damdang_file = "";
?>
									<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
										<tr>
											<td class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����1 <? if($is_damdang_file == "ok") { ?><input type="checkbox" name="file_hidden_del_1_<?=$i?>" value="1" style="vertical-align:middle" />����<? } ?>
<?
		if($member['mb_level'] > 6) {
			$is_damdang = "ok";
		} else {
			$is_damdang = "";
		}
		if($is_damdang_file == "ok") {
?>
											<div style="margin:4px 0 0 0">
												<img src="./images/icon_blank.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" /><a href="javascript:field_add_file('file_tr',<?=$i?>);"><img src="images/btn_add.png" border="0" style="vertical-align:middle" alt="+" /> <span  style="">�߰�</span></a>
											</div>
<?
		}
?>
										</td>
										<td   class="tdrow" width="373">
											<? if($is_damdang_file == "ok") { ?><input name="file_1_<?=$i?>" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<a href="files/electric_charges/<?=$row_file['file_1']?>" target="_blank"><?=$file_1?></a>
											<input type="hidden" name="file_hidden_1_<?=$i?>" value="<?=$row_file['file_1']?>" />
										</td>
										<td class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����2 <? if($is_damdang_file == "ok") { ?><input type="checkbox" name="file_hidden_del_2_<?=$i?>" value="1" style="vertical-align:middle" />����<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang_file == "ok") { ?><input name="file_2_<?=$i?>" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<a href="files/electric_charges/<?=$row_file['file_2']?>" target="_blank"><?=$file_2?></a>
											<input type="hidden" name="file_hidden_2_<?=$i?>" value="<?=$row_file['file_2']?>" />
										</td>
									</tr>
									<tr id="file_tr2_<?=$i?>" style="<? if(!$row_file['file_3'] && !$row_file['file_4']) echo "display:none"; ?>">
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����3 <? if($is_damdang_file == "ok") { ?><input type="checkbox" name="file_hidden_del_3_<?=$i?>" value="1" style="vertical-align:middle" />����<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang_file == "ok") { ?><input name="file_3_<?=$i?>" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<a href="files/electric_charges/<?=$row_file['file_3']?>" target="_blank"><?=$file_3?></a>
											<input type="hidden" name="file_hidden_3_<?=$i?>" value="<?=$row_file['file_3']?>" />
										</td>
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����4 <? if($is_damdang_file == "ok") { ?><input type="checkbox" name="file_hidden_del_4_<?=$i?>" value="1" style="vertical-align:middle" />����<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang_file == "ok") { ?><input name="file_4_<?=$i?>" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<a href="files/electric_charges/<?=$row_file['file_4']?>" target="_blank"><?=$file_4?></a>
											<input type="hidden" name="file_hidden_4_<?=$i?>" value="<?=$row_file['file_4']?>" />
										</td>
									</tr>
									<tr id="file_tr3_<?=$i?>" style="<? if(!$row_file['file_5'] && !$row_file['file_6']) echo "display:none"; ?>">
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����5 <? if($is_damdang_file == "ok") { ?><input type="checkbox" name="file_hidden_del_5_<?=$i?>" value="1" style="vertical-align:middle" />����<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang_file == "ok") { ?><input name="file_5_<?=$i?>" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<a href="files/electric_charges/<?=$row_file['file_5']?>" target="_blank"><?=$file_5?></a>
											<input type="hidden" name="file_hidden_5_<?=$i?>" value="<?=$row_file['file_5']?>" />
										</td>
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����6 <? if($is_damdang_file == "ok") { ?><input type="checkbox" name="file_hidden_del_6_<?=$i?>" value="1" style="vertical-align:middle" />����<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang_file == "ok") { ?><input name="file_6_<?=$i?>" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<a href="files/electric_charges/<?=$row_file['file_6']?>" target="_blank"><?=$file_6?></a>
											<input type="hidden" name="file_hidden_6_<?=$i?>" value="<?=$row_file['file_6']?>" />
										</td>
									</tr>
									<tr id="file_tr4_<?=$i?>" style="<? if(!$row_file['file_7'] && !$row_file['file_8']) echo "display:none"; ?>">
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����7 <? if($is_damdang_file == "ok") { ?><input type="checkbox" name="file_hidden_del_7_<?=$i?>" value="1" style="vertical-align:middle" />����<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang_file == "ok") { ?><input name="file_7_<?=$i?>" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<a href="files/electric_charges/<?=$row_file['file_7']?>" target="_blank"><?=$file_7?></a>
											<input type="hidden" name="file_hidden_7_<?=$i?>" value="<?=$row_file['file_7']?>" />
										</td>
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����8 <? if($is_damdang_file == "ok") { ?><input type="checkbox" name="file_hidden_del_8_<?=$i?>" value="1" style="vertical-align:middle" />����<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang_file == "ok") { ?><input name="file_8_<?=$i?>" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<a href="files/electric_charges/<?=$row_file['file_8']?>" target="_blank"><?=$file_8?></a>
											<input type="hidden" name="file_hidden_8_<?=$i?>" value="<?=$row_file['file_8']?>" />
										</td>
										</tr>
									</table>
								</div>
<?
	}
}
?>
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
							<div style="height:20px;padding-left:478px;">
								<table border="0" cellpadding="0" cellspacing="0" style="float:left;" id="btn_save"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="<?=$url_save?>" target="">�� ��</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table>
								<table border="0" cellpadding="0" cellspacing="0" style="float:left;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="<?=$url_list?>" target="">�� ��</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>
<?
//���� ����
if($member['mb_profile'] >= 110 && $member['mb_profile'] <= 200) {
?>
								<table border="0" cellpadding="0" cellspacing="0" style="float:left;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="./client_view_dealer.php?w=<?=$w?>&id=<?=$id?>" target="">�ŷ�ó����</a></td><td><img src=images/btn_rt.gif></td><td width="2"></td></tr></table>
<? } ?>
							</div>
							<div style="clean:both;width:100%;height:1px;font-size:0px"></div>

<script type="text/javascript">
//<![CDATA[
function resizeFrame(frm) {
	frm.style.height = "auto";
	contentHeight = frm.contentWindow.document.documentElement.scrollHeight;
	frm.style.height = contentHeight + 0 + "px";
	//alert(getId('manage_div').id);
<?
//���縸 ǥ�� 160324
if($member['mb_level'] > 6) {
?>
	getId('manage_div').style.display = "none";
	getId('collection_div').style.display = "none";
<?
}
?>
}
//]]>
</script>
<?
//�ű� ��Ͻ� ����
if($w == "u") {
	//�ŷ�ó ��No
	$memo_type = 11;
	//���� ����
	if($member['mb_profile'] >= 110 && $member['mb_profile'] <= 200) include "inc/client_comment_dealer.php";
	else include "inc/client_comment_only.php";
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
