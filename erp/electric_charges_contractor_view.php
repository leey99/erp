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
$qstr .= "&stx_electric_charges_visit_kind=".$stx_electric_charges_visit_kind;

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
	frm.action = "electric_charges_contractor_update.php";
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
//iframe resize
function resizeFrame(frm) {
 frm.style.height = "auto";
 contentHeight = frm.contentWindow.document.documentElement.scrollHeight;
 frm.style.height = contentHeight + 0 + "px";
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
$electric_charges_cost_arry[1] = "2000~3000";
$electric_charges_cost_arry[2] = "200~300";
$electric_charges_cost_arry[3] = "450~550";
$electric_charges_cost_arry[4] = "600~700";
?>
function electric_charges_cost_func(no) {
	var frm = document.dataForm;
	if(no == 1) {
		ecc1 = 2000;
		ecc2 = 3000;
	} else if(no == 2) {
		ecc1 = 200;
		ecc2 = 300;
	} else if(no == 3) {
		ecc1 = 450;
		ecc2 = 550;
	} else if(no == 4) {
		ecc1 = 600;
		ecc2 = 700;
	}
	frm.electric_charges_cost.value = ecc1;
	frm.electric_charges_cost2.value = ecc2;
}
//�����2
function electric_charges_cost_func2(no) {
	var frm = document.dataForm;
	if(no == 1) {
		ecc1 = 2000;
		ecc2 = 3000;
	} else if(no == 2) {
		ecc1 = 200;
		ecc2 = 300;
	} else if(no == 3) {
		ecc1 = 450;
		ecc2 = 550;
	} else if(no == 4) {
		ecc1 = 600;
		ecc2 = 700;
	}
	frm.electric_charges_cost_b.value = ecc1;
	frm.electric_charges_cost2_b.value = ecc2;
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
//]]>
</script>
<?
//���� ����
if( ($member['mb_profile'] >= 110 && $member['mb_profile'] <= 200) || $member['mb_level'] == 4 ) include "inc/top_dealer.php";
else include "inc/top.php";
//���Ѻ� ��ũ�� : ��ü ����
$url_save = "javascript:checkData();";
$url_print = "javascript:pagePrint(document.getElementById('print_page'), '0')";
$php_self_list = "electric_charges_contractor.php";
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
include "inc/client_basic_contractor.php";
?>
								<div style="height:10px;font-size:0px"></div>
							</div>
<?
$mb_profile_code = $member['mb_profile'];
//echo $row['damdang_code']." == ".$mb_profile_code." ".$member['mb_level'];
if(!$w || $row['damdang_code'] == $mb_profile_code || $row['damdang_code2'] == $mb_profile_code || $member['mb_level'] >= 9 || $member['mb_level'] == 2) $is_damdang = "ok";
//���Ѻ� ��ũ��
//echo $member['mb_level'];
$url_modify = $_SERVER['PHP_SELF']."?w=u&v=write&id=".$com_code."&page=".$page."&".$qstr."&".$stx_qstr;
$url_print = "javascript:pagePrint(document.getElementById('print_page'), '0')";
$url_print_request = "javascript:pagePrint(document.getElementById('tab1'), '0')";

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
											<?=$row['electric_charges_no']?>
										</td>
										<td nowrap class="tdrowk" width="114">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">������ֹι�ȣ
										</td>
										<td nowrap  class="tdrow" width="160">
											<?=$row['electric_charges_ssnb']?>
										</td>
										<td nowrap class="tdrowk" width="114">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���ε�Ϲ�ȣ<font color="red"></font>
										</td>
										<td nowrap  class="tdrow">
											<?=$row['electric_charges_bupin']?>
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
if($member['mb_profile'] < 110 && $member['mb_level'] != 4) {
?>
											<select name="electric_charges_process" class="selectfm" style="float:left;">
												<option value="">����</option>
												<option value="1" <?=$sel_check_ok['1']?>><?=$electric_charges_process_arry[1]?></option>
												<option value="2" <?=$sel_check_ok['2']?>><?=$electric_charges_process_arry[2]?></option>
												<option value="3" <?=$sel_check_ok['3']?>><?=$electric_charges_process_arry[3]?></option>
												<option value="10" <?=$sel_check_ok['10']?>><?=$electric_charges_process_arry[10]?></option>
												<option value="4" <?=$sel_check_ok['4']?>><?=$electric_charges_process_arry[4]?></option>
												<option value="5" <?=$sel_check_ok['5']?>><?=$electric_charges_process_arry[5]?></option>
												<option value="6" <?=$sel_check_ok['6']?>><?=$electric_charges_process_arry[6]?></option>
												<option value="7" <?=$sel_check_ok['7']?>><?=$electric_charges_process_arry[7]?></option>
												<option value="8" <?=$sel_check_ok['8']?>><?=$electric_charges_process_arry[8]?></option>
												<option value="9" <?=$sel_check_ok['9']?>><?=$electric_charges_process_arry[9]?></option>
											</select>
<?
	//���縸 ǥ�� 160126
	if($member['mb_level'] > 6) {
?>
											<table border="0" cellpadding="0" cellspacing="0" style="float:left;vertical-align:middle;margin-left:10px;"><tr><td width="2"></td><td><img src="images/btn_lt.gif"></td><td background="images/btn_bg.gif" class="ftbutton1" nowrap><a href="javascript:electric_charges_history('<?=$id?>');" target="">�̷�</a></td><td><img src="images/btn_rt.gif"></td><td width="2"></td></tr></table>

<?
	}
} else {
	echo $electric_charges_process_arry[$check_ok_id];
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
											<?=$row['electric_charges_manager_name']?> <? if($row['electric_charges_manager']) echo "(".$row['electric_charges_manager'].")"; ?>
										</td>
										<td nowrap class="tdrowk">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">�����ٰ���
										</td>
										<td nowrap  class="tdrow">
											<?=$row['electric_charges_visit_kind']?>
											<?=$row['electric_charges_visitdt']?>
											<?=$row['electric_charges_visitdt_time']?>
											<? if($row['electric_charges_visitdt_ok']) echo "(�Ϸ�)"; ?>
										</td>
									<tr>
										<td nowrap class="tdrowk">
											<img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���������
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
$electric_charges_existing_arry[20] = "�����(��)�� ���A ���å�";

$electric_charges_existing_arry[11] = "�����(��) ����";
$electric_charges_existing_arry[12] = "�����(��) ���A ���å�";
$electric_charges_existing_arry[13] = "�����(��) ���A ���å�";
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
?>
											<?=$electric_charges_existing_arry[$electric_charges_existing]?>
											<?=$row['electric_charges_watt']?> kW
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
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">���޸�<font color="red"></font></td>
										<td nowrap class="tdrow" colspan="5">
<?
//������� ����
if($row['electric_charges_memo']) echo "<pre style='word-wrap:break-word;white-space:pre-wrap;white-space:-moz-pre-wrap;white-space:-pre-wrap;white-space:-o-pre-wrap;word-break:break-all;'>".$row['electric_charges_memo']."</pre>";
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
										</td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="botr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" id="" style="">
									<tr>
										<td class="tdrowk" width="110"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />�����湮��</td>
										<td class="tdrow"  width="220">
											<strong>
											<input name="electric_date_estimate" type="text" class="textfm" style="width:70px;ime-mode:disabled;float:left;" value="<?=$row['electric_date_estimate']?>" maxlength="10" onkeypress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')" />
											<table border="0" cellspacing="0" cellpadding="0" style="vertical-align:middle;float:left;"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif" alt="[" /></td><td style="background:url('./images/btn2_bg.gif')" class="ftbutton3_white"><a href="javascript:loadCalendar(document.dataForm.electric_date_estimate);">�޷�</a></td><td><img src="./images/btn2_rt.gif" alt="]" /></td> <td width="2"></td></tr></table>
											</strong>
										</td>
										<td class="tdrowk" width="110"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />���翹����</td>
										<td class="tdrow"  width="220">
											<input name="electric_date_expect" type="text" class="textfm" style="width:70px;ime-mode:disabled;float:left;" value="<?=$row['electric_date_expect']?>" maxlength="10" onkeypress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')" />
											<table border="0" cellspacing="0" cellpadding="0" style="vertical-align:middle;float:left;"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif" alt="[" /></td><td style="background:url('./images/btn2_bg.gif')" class="ftbutton3_white"><a href="javascript:loadCalendar(document.dataForm.electric_date_expect);">�޷�</a></td><td><img src="./images/btn2_rt.gif" alt="]" /></td> <td width="2"></td></tr></table>
										</td>
										<td class="tdrowk" width="110"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����Ϸ���</td>
										<td class="tdrow">
											<input name="electric_date_finish" type="text" class="textfm" style="width:70px;ime-mode:disabled;float:left;" value="<?=$row['electric_date_finish']?>" maxlength="10" onkeypress="only_number_comma();" onkeyup="checkcomma(this.value, this,'Y')" />
											<table border="0" cellspacing="0" cellpadding="0" style="vertical-align:middle;float:left;"><tr><td width="2"></td><td><img src="./images/btn2_lt.gif" alt="[" /></td><td style="background:url('./images/btn2_bg.gif')" class="ftbutton3_white"><a href="javascript:loadCalendar(document.dataForm.electric_date_finish);">�޷�</a></td><td><img src="./images/btn2_rt.gif" alt="]" /></td> <td width="2"></td></tr></table>
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrowk"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0">����޸�<font color="red"></font></td>
										<td nowrap class="tdrow" colspan="5">
											<textarea name="electric_charges_memo2" class="textfm" style='width:100%;height:76px;word-break:break-all;'><?=$row['electric_charges_memo2']?></textarea>
										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px"></div>

								<table border="0" cellspacing="0" cellpadding="0"> 
									<tr>
										<td> 
											<table border="0" cellpadding="0" cellspacing="0">
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
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<tr>
										<td class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����
										</td>
										<td class="tdrow">
											<a href="files/electric_charges/<?=$row['electric_charges_search_1']?>" target="_blank"><?=$electric_charges_search_1?></a>
										</td>
									</tr>
								</table>
								<div style="height:10px;font-size:0px"></div>
<?
//�ش� ��������ü ID
$mb_id = $member['mb_id'];
//��������ü ÷������ 161006
$sql_file = " select * from electric_charges_file where com_code='$com_code' and w_user='$mb_id' ";
//echo $sql_file;
$result_file = sql_query($sql_file);
$row_file=mysql_fetch_array($result_file);
if($row_file['file_1']) $file_1 = mb_substr($row_file['file_1'],16,99,'euc-kr');
if($row_file['file_2']) $file_2 = mb_substr($row_file['file_2'],16,99,'euc-kr');
if($row_file['file_3']) $file_3 = mb_substr($row_file['file_3'],16,99,'euc-kr');
if($row_file['file_4']) $file_4 = mb_substr($row_file['file_4'],16,99,'euc-kr');
if($row_file['file_5']) $file_5 = mb_substr($row_file['file_5'],16,99,'euc-kr');
if($row_file['file_6']) $file_6 = mb_substr($row_file['file_6'],16,99,'euc-kr');
if($row_file['file_7']) $file_7 = mb_substr($row_file['file_7'],16,99,'euc-kr');
if($row_file['file_8']) $file_8 = mb_substr($row_file['file_8'],16,99,'euc-kr');
?>
								<!--���ȼ���-->
								<table border="0" cellspacing="0" cellpadding="0"> 
									<tr>
										<td> 
											<table border="0" cellspacing="0" cellpadding="0"> 
												<tr> 
													<td><img src="images/sb_tab_on_lt.gif" alt="[" /></td> 
													<td class="Sftbutton_white" style="width:120px;text-align:center;background:url('images/sb_tab_on_bg.gif');"> 
														÷�μ���(<?=$member['mb_nick']?>)
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
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="">
									<tr>
										<td class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����1 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_hidden_del_1" value="1" style="vertical-align:middle" />����<? } ?>
<?
//����� ���� ���� 150824
$is_damdang = "ok";
if($is_damdang == "ok") {
?>
											<div style="margin:4px 0 0 0">
												<img src="./images/icon_blank.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" /><a href="javascript:field_add('file_tr');"><img src="images/btn_add.png" border="0" style="vertical-align:middle" alt="+" /> <span  style="">�߰�</span></a>
											</div>
<?
}
?>
										</td>
										<td   class="tdrow" width="373">
											<? if($is_damdang == "ok") { ?><input name="file_1" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<a href="files/electric_charges/<?=$row_file['file_1']?>" target="_blank"><?=$file_1?></a>
											<input type="hidden" name="file_hidden_1" value="<?=$row_file['file_1']?>" />
										</td>
										<td class="tdrowk" width="120"><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����2 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_hidden_del_2" value="1" style="vertical-align:middle" />����<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang == "ok") { ?><input name="file_2" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<a href="files/electric_charges/<?=$row_file['file_2']?>" target="_blank"><?=$file_2?></a>
											<input type="hidden" name="file_hidden_2" value="<?=$row_file['file_2']?>" />
										</td>
									</tr>
									<tr id="file_tr2" style="<? if(!$row_file['file_3'] && !$row_file['file_4']) echo "display:none"; ?>">
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����3 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_hidden_del_3" value="1" style="vertical-align:middle" />����<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang == "ok") { ?><input name="file_3" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<a href="files/electric_charges/<?=$row_file['file_3']?>" target="_blank"><?=$file_3?></a>
											<input type="hidden" name="file_hidden_3" value="<?=$row_file['file_3']?>" />
										</td>
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����4 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_hidden_del_4" value="1" style="vertical-align:middle" />����<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang == "ok") { ?><input name="file_4" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<a href="files/electric_charges/<?=$row_file['file_4']?>" target="_blank"><?=$file_4?></a>
											<input type="hidden" name="file_hidden_4" value="<?=$row_file['file_4']?>" />
										</td>
									</tr>
									<tr id="file_tr3" style="<? if(!$row_file['file_5'] && !$row_file['file_6']) echo "display:none"; ?>">
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����5 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_hidden_del_5" value="1" style="vertical-align:middle" />����<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang == "ok") { ?><input name="file_5" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<a href="files/electric_charges/<?=$row_file['file_5']?>" target="_blank"><?=$file_5?></a>
											<input type="hidden" name="file_hidden_5" value="<?=$row_file['file_5']?>" />
										</td>
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����6 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_hidden_del_6" value="1" style="vertical-align:middle" />����<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang == "ok") { ?><input name="file_6" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<a href="files/electric_charges/<?=$row_file['file_6']?>" target="_blank"><?=$file_6?></a>
											<input type="hidden" name="file_hidden_6" value="<?=$row_file['file_6']?>" />
										</td>
									</tr>
									<tr id="file_tr4" style="<? if(!$row_file['file_7'] && !$row_file['file_8']) echo "display:none"; ?>">
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����7 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_hidden_del_7" value="1" style="vertical-align:middle" />����<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang == "ok") { ?><input name="file_7" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<a href="files/electric_charges/<?=$row_file['file_7']?>" target="_blank"><?=$file_7?></a>
											<input type="hidden" name="file_hidden_7" value="<?=$row_file['file_7']?>" />
										</td>
										<td class="tdrowk" width=""><img src="./images/icon_02.gif" width="2" height="2" style="margin:0 5px 3px 0" alt="*" />����8 <? if($is_damdang == "ok") { ?><input type="checkbox" name="file_hidden_del_8" value="1" style="vertical-align:middle" />����<? } ?></td>
										<td   class="tdrow" >
											<? if($is_damdang == "ok") { ?><input name="file_8" type="file" class="textfm_search" style="width:250px;margin:0 0 4px 0;" /><br/><? } ?>
											<a href="files/electric_charges/<?=$row_file['file_8']?>" target="_blank"><?=$file_8?></a>
											<input type="hidden" name="file_hidden_8" value="<?=$row_file['file_8']?>" />
										</td>
									</tr>
								</table>

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
							</div>
							<div style="clean:both;width:100%;height:1px;font-size:0px"></div>
<?
//�ű� ��Ͻ� ����
if($w == "u") {
	//�ŷ�ó ��No
	$memo_type = 11;
	//������� ����
	include "inc/client_comment_contractor.php";
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
