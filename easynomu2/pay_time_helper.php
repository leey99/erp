<?
$sub_menu = "400103";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

//�⵵, �� ����
if(!$search_year) $search_year = date("Y");
if(!$search_month) $search_month = date("m");

$sql_common = " from $g4[pibohum_base] a, pibohum_base_opt b ";

//��������� �ɼ� DB
$sql_com_opt = " select * from com_list_gy_opt where com_code='$com_code' ";
$result_com_opt = sql_query($sql_com_opt);
$row_com_opt=mysql_fetch_array($result_com_opt);
//����� Ÿ��
if($row_com_opt['comp_print_type']) {
	$comp_print_type = $row_com_opt['comp_print_type'];
} else {
	$comp_print_type = "default";
}

//echo $is_admin;
if($is_admin == "super") {
	$sql_search = " where 1=1 ";
} else {
	$sql_search = " where a.com_code='$com_code' ";
}
//�ɼ�DB join
$sql_search .= " and ( ";
$sql_search .= " (a.com_code = b.com_code and a.sabun = b.sabun) ";
$sql_search .= " ) ";
//�޿��� ���� �Ի��� ����
$year_month = $search_year.".".$search_month;
$in_day_base = $year_month.".32";
$sql_search .= " and ( a.in_day = '' or a.in_day < '$in_day_base' ) ";
//������ ����
$year_month = $search_year.".".$search_month;
$out_day_base = $year_month.".01";
$sql_search .= " and ( a.out_day = '' or a.out_day > '$out_day_base' ) ";
//�޿����� �̼����� ����
//$sql_search .= " and ( b.pay_gbn != '' ) ";
//�ñ��� �ٷ��ڸ� ǥ��
//$sql_search .= " and ( b.pay_gbn = '1' ) ";
//�μ��� ���� : �����
if($com_code == "20284") {
	if(!$stx_dept) $stx_dept = 2;
	$sql_search .= " and ( b.dept = '$stx_dept' ) ";
}
//ȭ��������κθ�ȸ ����
if($comp_print_type == "H") {
	if(!$stx_dept) $stx_dept = 7;
	$sql_search .= " and ( b.dept = '$stx_dept' ) ";
	$sql_search .= " and ( b.position = '14' ) ";
}
//echo $stx_name;
// �˻� : ����
if ($stx_name) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.name like '$stx_name%') ";
	$sql_search .= " ) ";
}
// �˻� : ���
if ($stx_sabun) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.sabun like '$stx_sabun%') ";
	$sql_search .= " ) ";
}
// �˻� : ä������
if ($stx_work_form) {
	$sql_search .= " and ( ";
	$sql_search .= " (a.work_form like '$stx_work_form%') ";
	$sql_search .= " ) ";
}
//����
$sql_common_sort = " from com_code_sort ";
$sql_search_sort = " where com_code = '$com_code' ";
//���� 1����
$sql1 = " select * $sql_common_sort $sql_search_sort  and code = '1' ";
$result1 = sql_query($sql1);
$row1 = mysql_fetch_array($result1);
$sort1 = $row1[item];
$sod1 = $row1[sod];
//���� 2����
$sql2 = " select * $sql_common_sort $sql_search_sort  and code = '2' ";
$result2 = sql_query($sql2);
$row2 = mysql_fetch_array($result2);
$sort2 = $row2[item];
$sod2 = $row2[sod];
//���� 3����
$sql3 = " select * $sql_common_sort $sql_search_sort  and code = '3' ";
$result3 = sql_query($sql3);
$row3 = mysql_fetch_array($result3);
$sort3 = $row3[item];
$sod3 = $row3[sod];
//���� 4����
$sql4 = " select * $sql_common_sort $sql_search_sort  and code = '4' ";
$result4 = sql_query($sql4);
$row4 = mysql_fetch_array($result4);
$sort4 = $row4[item];
$sod4 = $row4[sod];

if (!$sst) {
	if($is_admin == "super") {
		$sst = "a.com_code";
		$sod = "desc";
	} else {
		if($sort1) {
			if($sort1 == "in_day" || $sort1 == "name" || $sort1 == "work_form") $sst = "a.".$sort1;
			else $sst = "b.".$sort1;
			$sod = $sod1;
		} else {
			$sst = "b.position";
			$sod = "asc";
		}
	}
}
if (!$sst2) {
	if($sort2) {
		if($sort2 == "in_day" || $sort2 == "name" || $sort2 == "work_form") $sst2 = ", a.".$sort2;
		else $sst2 = ", b.".$sort2;
		$sod2 = $sod2;
	} else {
		$sst2 = ", a.in_day";
		$sod2 = "asc";
	}
}
if (!$sst3) {
	if($sort3) {
		if($sort3 == "in_day" || $sort3 == "name" || $sort3 == "work_form") $sst3 = ", a.".$sort3;
		else $sst3 = ", b.".$sort3;
		$sod3 = $sod3;
	} else {
		$sst3 = ", b.dept";
		$sod3 = "asc";
	}
}
if (!$sst4) {
	if($sort4) {
		if($sort4 == "in_day" || $sort4 == "name" || $sort4 == "work_form") $sst4 = ", a.".$sort4;
		else $sst4 = ", b.".$sort4;
		$sod4 = $sod4;
	} else {
		$sst4 = ", b.pay_gbn";
		$sod4 = "asc";
	}
}

$sql_order = " order by $sst $sod $sst2 $sod2 $sst3 $sod3 $sst4 $sod4 ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";

//echo $sql;
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = 180;
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���

if (!$page) $page = 1; // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
$result = sql_query($sql);
//echo $sql;
$colspan = 12;

//�޿��ݿ� ���̺� ����
$pay_list_width = 3550;
//��������� �ɼ� DB
$sql_com_opt = " select * from com_list_gy_opt where com_code='$com_code' ";
$result_com_opt = sql_query($sql_com_opt);
$row_com_opt=mysql_fetch_array($result_com_opt);
//����� Ÿ��
$comp_print_type = $row_com_opt[comp_print_type];
//�޿�������
if($row_com_opt[pay_day_time]) {
	if($search_month == 12) {
		$pay_date = "1�� ".$row_com_opt[pay_day_time]."��";
	} else {
		$pay_date = ($search_month+1)."�� ".$row_com_opt[pay_day_time]."��";
	}
	//�޿������� ��� üũ ����
	if($row_com_opt[pay_day_now_month_time] == 1) {
		$pay_date = $search_month."�� ".$row_com_opt[pay_day_time]."��";
	}
} else {
	$pay_date = "�޿������� ������";
}
//�޿������� ���� üũ
if($row_com_opt[pay_day_last_time]) {
	if($search_month == 12) {
		$pay_date = "1�� ����";
	} else {
		$pay_date = ($search_month+1)."�� ����";
	}
	//�޿������� ��� üũ ����
	if($row_com_opt[pay_day_now_month_time] == 1) {
		$pay_date = $search_month."�� ����";
	}
}
if($row_com_opt[pay_calculate_day1_time]) {
	$pay_calculate_date = $row_com_opt[pay_calculate_day1_time]." ".$row_com_opt[pay_calculate_day_period1_time]."�� ~ ".$row_com_opt[pay_calculate_day2_time]." ".$row_com_opt[pay_calculate_day_period2_time]."��";
}
//�޿����� DB (�޿��ݿ�) ���
if($comp_print_type == "H") $sql_w_date = " select * from pibohum_base_pay_helper where com_code='$com_code' and year = '$search_year' and month = '$search_month' ";
else $sql_w_date = " select * from pibohum_base_pay where com_code='$com_code' and year = '$search_year' and month = '$search_month' ";
$result_w_date = sql_query($sql_w_date);
$row_w_date=mysql_fetch_array($result_w_date);
//echo $sql_w_date;
if($row_w_date[w_date] != "0000-00-00") {
	$w_date = $row_w_date[w_date];
	$w_date_ok = "1";
} else {
	$w_date = "<span style='color:red'>�ӽ�����</span>";
	$w_date_ok = "";
}
if($row_w_date[w_date] == "") {
	$w_date = "<span style='color:red'>�̵��</span>";
	$w_date_ok = "";
}
//������ Ÿ��Ʋ
//ȭ��������κθ�ȸ Ȱ��������
if($comp_print_type == "H") $sub_title = "�޿����(����)";
else $sub_title = "�޿����(�ñ���)";
$g4[title] = $sub_title." : �޿����� : ".$easynomu_name;
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?> Type : <?=$comp_print_type?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px">
<?
$money_month_text = "�⺻�ñ�";
//echo "comp_print_type : ".$comp_print_type;
//ȭ��������κ���ȸ ����
if($comp_print_type == "H") {
	include "pay_list_helper.php";
} else {
	include "pay_list_helper.php";
}
?>
<script language="javascript">
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
//�޿����� ���� (�ñ���)
function pay_gbn_time() {
	var frm = document.dataForm;
	frm.pay_gbn_value.value = "1";
}
addLoadEvent(pay_gbn_time);
</script>
<style type="text/css">
#wrapper02 .CPWalletArea {
	background: rgb(255, 255, 255); margin: auto; border: 1px solid rgb(226, 1, 102); width:300px; display: block;
}
#wrapper02 .CPWalletArea .CPImg {
	top: -5px; right: 22px; display: block; position: absolute;
}
*:first-child + html #wrapper02 .CPWalletArea .CPImg {
	top: -9px; right: 22px; display: block; position: absolute;
}
#wrapper02 .CPWalletArea .nwapClsBtn01 {
	top: 15px; right: 15px; display: block; position: absolute;
}
#wrapper02 .CPWalletArea h3 {
	margin: 0px; padding: 20px 0px 10px 20px; color: rgb(226, 1, 102); font-size: 12px;
}
#wrapper02 .CPWalletArea ol {
	list-style: none; margin: 0px; padding: 0px 20px 20px; text-align: left; color: rgb(102, 102, 102); font-size: 11px;
}
#wrapper02 .CPWalletArea ol li {
	margin: 0px; padding: 0px;
}
#wrapper02 .CPWalletArea ol .nwapCPDisc {
	line-height: 15px; padding-top: 5px;
}
#wrapper02 .CPWalletArea ol .nwapCPStit {
	padding-top: 25px;
}
#wrapper02 .CPWalletArea ol .nwapCPDisc01 {
	
}
#wrapper02 .CPWalletArea ol .nwapCPDisc01 img {
	vertical-align: middle;
}
#wrapper02 .CPWalletArea .nwapCPDisc a {
	color: rgb(51, 51, 51); text-decoration: underline !important;
}
#wrapper02 .CPWalletArea .nwapCPDisc span {
	color: rgb(51, 51, 51);
}
</style>
<!-- ���� :: start -->
<div id="couponHelpDiv" style="display:none; position:absolute; top:0; left:0;">
	<div id="wrapper02">
		<div class="CPWalletArea">
			<!--<div class="CPImg"><img src="./images/pay_img01.gif" width="8" height="6" alt="" /></div>-->
			<h3>��� �⺻/�޿� ����</h3>
			<ol>
				<li><strong>1. �⺻����</strong>
					<ul class="nwapCPDisc">
						<li>���� : <span id="emp_name"></span></li>
						<li>�Ի��� : <span id="emp_sdate"></span></li>
						<li>���� : <span id="emp_position"></span></li>
						<li>�ξ簡�� : <span id="family_count"></span></li>
					</ul>
				</li>
				<li class="nwapCPStit"><strong>2. �޿�����</strong>
					<ul class="nwapCPDisc">
						<li>�ֱٹ��ð� : <span id="emp_work_gbn"></span></li>
						<li>�޿����� : <span id="emp_pay_gbn"></span></li>
						<li>�����ӱ� : <span id="emp_money_base"></span></li>
						<li>�⺻�� : <span id="emp_money_min"></span></li>
						<li>�⺻�ñ� : <span id="emp_money_time"></span></li>
					</ul>
				</li>
			</ol>
			<div style="position:absolute; right:15px; top:15px;">
				<img src="https://img.akmall.com/imgs/ak_wap/cart_box/pay_cls_btn02.gif" alt="�ݱ�" onclick="$('#couponHelpDiv').css('display','none')" style="cursor:pointer" />
			</div>
		</div>
	</div>
</div>
<!-- ���� :: end -->
</body>
</html>