<?
$sub_menu = "300600";
include_once("./_common.php");

//��� : ����(��ǥ, ������, ������, ����, �渮���, ������) ���� 150914
$mb_id_check = explode('000',$member['mb_id']);
if($mb_id_check[1] != "1" && $member['mb_id'] != "kcmc1001" && $member['mb_id'] != "kcmc1002" && $member['mb_id'] != "kcmc1004" && $member['mb_id'] != "kcmc1008" && $member['mb_id'] != "master") {
	alert("�ش� �������� ������ ������ �����ϴ�.");
} else {
	//���� ���� ����� ������ ���� ���� 160331
	$is_admin = "super";
	$com_code = 395;
}

//���� �⵵
$year_now = date("Y");

$sql_common = " from pibohum_base_pay ";

//echo $is_admin;
if($is_admin == "super") {
	$colspan = 15;
} else {
	$colspan = 14;
}
$sql_search = " where com_code='$com_code' ";

//�⵵, �� ����
if(!$search_year) $search_year = date("Y");
//if(!$search_month) $search_month = date("m");

//echo $stx_name;
// �˻� : ��
if ($search_year) {
	$sql_search .= " and ( ";
	$sql_search .= " (year like '$search_year%') ";
	$sql_search .= " ) ";
}
// �˻� : ��
if ($search_month) {
	$sql_search .= " and ( ";
	$sql_search .= " (month like '$search_month%') ";
	$sql_search .= " ) ";
}

$sql_group = " group by year, month, w_date, w_time ";

$sst0 = "  ";
if (!$sst) {
	if($is_admin == "super") {
		$sst = "com_code";
	} else {
		$sst = "sort";
	}
	$sod = "desc";
}
$sst2 = ", year desc";
$sst3 = ", month desc";
$sst4 = ", w_date desc";
$sst5 = ", w_time desc";

$sql_order = " order by $sst0 $sst $sod $sst2 $sst3 $sst4 $sst5 ";

$sql = " select count(*) as cnt
         $sql_common
         $sql_search $sql_group
         $sql_order ";

//echo $sql;
$row = sql_fetch($sql);
$total_count = $row[cnt];

$rows = 999;
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���

if (!$page) $page = 1; // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����

$sub_title = "�޿�����";
$g4[title] = $sub_title." : ��� : ".$easynomu_name;

$sql = " select com_code, sabun, year, month, dept_code, dept, count(month) as cnt, sum(money_total) as sum_total, sum(money_gongje) as sum_gongje, sum(money_result) as sum_result, w_date, w_time
          $sql_common
          $sql_search $sql_group
          $sql_order 
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
$result_reg_cnt = sql_query($sql);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css" />
<script type="text/javascript" src="js/common.js"></script>
</head>
<body style="margin:0px;background-color:#f7fafd">
<script src="./js/jquery-1.8.0.min.js" type="text/javascript" charset="euc-kr"></script>
<script type="text/javascript">
// ���� �˻� Ȯ��
function goSearch()
{
	var frm = document.searchForm;
	frm.action = "<?=$PHP_SELF?>";
	frm.submit();
	return;
}
function checkAll() {
	var f = document.dataForm;
	for( var i = 0; i<f.idx.length; i++ ) {
		f.idx[i].checked = f.checkall.checked;
	}
}
function checked_ok() {
	var frm = document.dataForm;
	var chk_cnt = document.getElementsByName("idx");
	var cnt = 0;
	var chk_data ="";

	for(i=0; i<chk_cnt.length ; i++) {
		if(frm.idx[i].checked==true) {
			cnt++;
			chk_data = chk_data + ',' + frm.idx[i].value;
		}
	}
	//alert(chk_data);
	if(cnt==0) {
	 alert("���õ� �����Ͱ� �����ϴ�.");
	 return;
	} else {
		if(confirm("���� �����Ͻðڽ��ϱ�?")) {
			chk_data = chk_data.substring(1, chk_data.length);
			frm.chk_data.value = chk_data;
			//alert(chk_data);
			frm.action="settlement_pay_delete.php";
			frm.submit();
		} else {
			return;
		}
	} 
}
function printPayList(search_year, search_month, w_date, w_time) {
	frm = document.printForm;
	frm.mode.value = "salary_list";
	frm.search_year.value = search_year;
	frm.search_month.value = search_month;
	frm.w_date.value = w_date;
	frm.w_time.value = w_time;
	frm.target = "_blank";
	frm.action = "pay_ledger.php?code=<?=$com_code?>";
	frm.submit();
}
function printPayList2(search_year, search_month, w_date, w_time) {
	frm = document.printForm;
	frm.mode.value = "salary_list";
	frm.search_year.value = search_year;
	frm.search_month.value = search_month;
	frm.w_date.value = w_date;
	frm.w_time.value = w_time;
	frm.target = "_blank";
	frm.action = "pay_ledger_report.php?code=<?=$com_code?>";
	frm.submit();
}
function printPayList3(search_year, search_month, w_date, w_time) {
	alert("���α׷� ���� ���Դϴ�.");
}
//�����(�Ĵ�, ������) 160603
function printPayList4(search_year, search_month, w_date, w_time) {
	frm = document.printForm;
	frm.mode.value = "salary_list";
	frm.search_year.value = search_year;
	frm.search_month.value = search_month;
	frm.w_date.value = w_date;
	frm.w_time.value = w_time;
	frm.target = "_blank";
	frm.action = "pay_ledger_tax_free.php?code=<?=$com_code?>";
	frm.submit();
}
function month_plus() {
	f = document.searchForm;
	year_var = f.search_year.value;
	month_var = f.search_month.value;
	if(month_var == "12") {
		year_var = toInt(year_var) + 1;
		month_var = "01";
	} else {
		month_var = ""+(toInt(month_var) + 1);
		if(month_var.length == 1) {
		 month_var = "0"+month_var;
		}
	}
	if(year_var > <?=$year_now?>) {
		alert("<?=$year_now?>����� ��ȸ�� �����մϴ�.");
		return;
	}
	f.search_year.value = year_var;
	f.search_month.value = month_var;
	goSearch();
}
function month_minus() {
	f = document.searchForm;
	year_var = f.search_year.value;
	month_var = f.search_month.value;
	if(month_var == "01" || month_var == "") {
		year_var = toInt(year_var) - 1;
		month_var = "12";
	} else {
		month_var = ""+(toInt(month_var) - 1);
		if(month_var.length == 1) {
		 month_var = "0"+month_var;
		}
	}
	if(year_var == "2012") {
		alert("2013����� ��ȸ�� �����մϴ�.");
		return;
	}
	f.search_year.value = year_var;
	f.search_month.value = month_var;
	goSearch();
}
</script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/calendar-setup.js"></script>
<script type="text/javascript" src="./js/jscalendar-1.0/lang/calendar-ko.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="./js/jscalendar-1.0/skins/aqua/theme.css" title="Aqua" />
<script type="text/javascript">
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
<?
$previous_month_start = date("Y.m.01",strtotime("-1month"));
$previous_month_last_day = date('t', strtotime($previous_month_start));
$previous_month_end = date("Y.m",strtotime("-1month")).".".$previous_month_last_day;
$this_month_start = date("Y.m.01");
$this_month_last_day = date('t', strtotime($this_month_start));
$this_month_end = date("Y.m").".".$this_month_last_day;
$next_month_start = date("Y.m.01",strtotime("+1month"));
$next_month_last_day = date('t', strtotime($next_month_start));
$next_month_end = date("Y.m",strtotime("+1month")).".".$next_month_last_day;
?>
function stx_search_day_select(input_obj) {
	var frm = document.searchForm;
	if(input_obj.value == 1) {
		frm['search_sday'].value = "<?=$previous_month_start?>";
		frm['search_eday'].value = "<?=$previous_month_end?>";
	} else 	if(input_obj.value == 2) {
		frm['search_sday'].value = "<?=$this_month_start?>";
		frm['search_eday'].value = "<?=$this_month_end?>";
	} else 	if(input_obj.value == 3) {
		frm['search_sday'].value = "<?=$next_month_start?>";
		frm['search_eday'].value = "<?=$next_month_end?>";
	} else {
		frm['search_sday'].value = "";
		frm['search_eday'].value = "";
	}
}
function search_day_func(obj) {
	var frm = document.searchForm;
	if(frm.search_day_all.checked) {
		if(obj.name == "search_day_all") {
			for(i=1; i<=8; i++) {
				frm['search_day'+i].checked = true;
			}
		} else {
			frm['search_day_all'].checked = false;
		}
	} else if(obj.name == "search_day_all") {
		for(i=1; i<=8; i++) {
			frm['search_day'+i].checked = false;
		}
	}
}
//����ڹ�ȣ �Է� ������
function checkhyphen(inputVal, type, keydown) {		// inputVal�� õ������ , ǥ�ø� ���� �������� ��
	main = document.searchForm;			// ���⼭ type �� �ش��ϴ� ���� �ֱ� ���� ��ġ���� index
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
				type.value = total;
			}else if(keydown =='N'){
				return total
			}
		}
		return total
	}
}
//����������ȣ �Է� ������
function checkhyphen_tno(inputVal, type, keydown) {
	main = document.searchForm;			// ���⼭ type �� �ش��ϴ� ���� �ֱ� ���� ��ġ���� index
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
				type.value = total;
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
function search_day_chk() {
	var frm = document.searchForm;
	if(frm.stx_search_day_chk.value=='') {
		alert('�Ⱓ���� �� ��¥�� �Է��ϼ���.');
		frm.stx_search_day_chk.focus();
	}
}
</script>
<?
include "inc/top.php";
?>
		<td onmouseover="showM('900')" valign="top">
			<div style="margin:10px 20px 20px 20px;min-height:480px;">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="100"><img src="images/top03.gif" border="0" alt="���" /></td>
						<td width="132"><a href="settlement_pay.php"><img src="images/top03_06.gif" border="0" alt="�޿�����" /></a></td>
						<td width="129"><a href="settlement_pay.php"><img src="images/menu06_top04_on.gif" border="0" alt="�޿�����" /></a></td>
						<td width="129"><a href="pay_all.php"><img src="images/menu06_top03_off.gif" border="0" alt="�޿��ݿ�" /></a></td>
						<td width="129"><a href="pay_stubs_list.php"><img src="images/menu06_top05_off.gif" border="0" alt="��/�� ���" /></a></td>
						<td></td>
					</tr>
					<tr><td height="1" bgcolor="#cccccc" colspan="9"></td></tr>
				</table>
				<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top" style="padding:10px 0 0 0">

							<!--������ -->
							<table border="0" cellpadding="0" cellspacing="0">
								<tr> 
									<td id=""> 
										<table border="0" cellpadding="0" cellspacing="0">
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
												�˻�
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
							<!--�˻� -->
							<form name="searchForm" method="get">
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
									<col width="10%">
									<col width="">
									<col width="">
									<tr>
										<td nowrap class="tdrowk"><img src="/img/ims/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�޿��⵵/��</td>
										<td nowrap class="tdrow">
											<select name="search_year" class="selectfm" onChange="goSearch();">
<?
for($i=2011;$i<=2016;$i++) {
?>
												<option value="<?=$i?>" <? if($i == $search_year) echo "selected"; ?> ><?=$i?></option>
<?
}
?>
											</select> ��
											<select name="search_month" class="selectfm" onChange="goSearch();">
												<option value="" >��ü</option>
<?
for($i=1;$i<13;$i++) {
	if($i < 10) $month = "0".$i;
	else $month = $i;
?>
												<option value="<?=$month?>" <? if($i == $search_month) echo "selected"; ?> ><?=$month?></option>
<?
}
?>
											</select> ��
											<div style="padding:0 0 0 2px;display:inline">
												<a href="javascript:month_minus();"><img src="images/btn_del.png" align="absmiddle" border="0"></a>
												<a href="javascript:month_plus();"><img src="images/btn_add.png" align="absmiddle" border="0"></a>
											</div>
										</td>
										<td  nowrap class="tdrow">
											<table border=0 cellpadding=0 cellspacing=0 style="display:inline;height:18px;"><tr><td width=2></td><td><img src=images/btn9_lt.gif></td>
											<td style="background:url(images/btn9_bg.gif) repeat-x center" class=ftbutton5_white nowrap><a href="javascript:goSearch();" target="">�� ��</a></td><td><img src=images/btn9_rt.gif></td><td width=2></td></tr></table> 
										</td>
									</tr>
								</table>
							</form>
							<div style="height:10px;font-size:0px;line-height:0px;"></div>

							<form name="printForm" method="post" style="margin:0">
								<input type="hidden" name="mode">
								<input type="hidden" name="search_year" value="<?=$search_year?>">
								<input type="hidden" name="search_month" value="<?=$search_month?>">
								<input type="hidden" name="w_date">
								<input type="hidden" name="w_time">
							</form>

							<!--��޴� -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80;text-align:center'> 
												����Ʈ
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

							<!--����Ʈ -->
							<style>
							.btn00 {display:inline-block;border-top:#DFDFDF solid 1px;border-left:#DFDFDF solid 1px;border-right:#DFDFDF solid 1px;border-bottom:#C0C0C0 solid 1px;}
							.btn00 a {display:inline-block;border-top:#FFFFFF solid 1px;background:#EFEFEF;padding:4px 7px 4px 7px;color:#444;font-family:dotum;font-size:11px;text-decoration:none;letter-spacing:-1px;}
							.btn00 a:hover {background:#E1E1E1;}
							.btn00 input {margin:0;cursor:pointer;border-top:#DFDFDF solid 1px;border-left:#DFDFDF solid 1px;border-right:#DFDFDF solid 1px;border-bottom:#C0C0C0 solid 1px;background:#EFEFEF;height:18px;color:#444;font-family:dotum;font-weight:bold;font-size:11px;text-decoration:none;letter-spacing:-1px;}
							.btn00 input:hover {background:#E1E1E1;}
							</style>
							<form name="dataForm" method="post">
							<input type="hidden" name="chk_data">
							<input type="hidden" name="page" value="<?=$page?>">
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
								<tr>
									<td nowrap class="tdhead_center" width="3%"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()"></td>
<?
if($is_admin == "super") {
?>
									<td nowrap class="tdhead_center" width="162">������</th>
<?
}
?>
									<td nowrap class="tdhead_center" width="60">����</td>
									<td nowrap class="tdhead_center" width="40">��</td>
									<td nowrap class="tdhead_center" width="">�޿������</td>
									<td nowrap class="tdhead_center" width="80">�����</td>
<?
if($search_month) {
?>
									<td nowrap class="tdhead_center" width="60">��Ͻð�</td>

<?
} else {
?>
									<td nowrap class="tdhead_center" width="60">����Ƚ��</td>

<?
}
if($search_month) {
?>
									<td nowrap class="tdhead_center" width="40">�ο�</td>
<?
	//������
	if($com_code == "20284") {
?>
									<td nowrap class="tdhead_center" width="155" colspan="2">�μ���</td>
<?
	} else {
?>
									<td nowrap class="tdhead_center" width="80">���ӱݰ�</td>
									<td nowrap class="tdhead_center" width="75">�Ѱ�����</td>
<?
	}
?>
									<td nowrap class="tdhead_center" width="80">�����޾�</td>
<?
} else {
?>
									<td nowrap class="tdhead_center" width="305" colspan="4">�μ���</td>
<?
}
?>
									<td nowrap class="tdhead_center" width="74">�޿�����</td>
									<td nowrap class="tdhead_center" width="64">�Ű��</td>
									<td nowrap class="tdhead_center" width="64">�����</td>
									<td nowrap class="tdhead_center" width="50">ȸ��</td>
								</tr>
								<?
								//���Ƚ��
								$r_cnt = 1;
								for ($i=0; $row_reg_cnt=sql_fetch_array($result_reg_cnt); $i++) {
									$year = $row_reg_cnt['year'];
									$month = $row_reg_cnt['month'];
									//echo $year." == ".$old_year." && ".$month." == ".$old_month." &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ";
									$dept_txt = $row_reg_cnt['dept'];
									//echo $i." ".strstr($r_dept, $dept_txt);
									//echo $i.":".preg_match($dept_txt, $r_dept, $matches)." ";
									//echo $i.":".$dept_txt.":".$r_dept.":".$matches." ";
									//echo strpos($r_dept, $dept_txt);
									//echo $r_dept;
									if($year == $old_year && $month == $old_month) {
										//echo $i.":".mb_strpos($r_dept, $dept_txt, 0, "euc-kr").", ";
										//echo $month.":".$row_reg_cnt['dept'];
										if(!$r_dept) $r_dept = "";
										if($dept_txt) {
											if(!mb_strpos($r_dept, $dept_txt, 0, "euc-kr")) {
												$r_dept .= $row_reg_cnt['dept'].". ";
											}
										}
										$r_cnt++;
									} else {
										$r_cnt = 1;
										$r_dept = $row_reg_cnt['dept'].". ";
									}
									$reg_cnt_array[$year][$month] = $r_cnt;
									$reg_dept_array[$year][$month] = $r_dept;
									//echo $no." ";
									$old_year = $row_reg_cnt['year'];
									$old_month = $row_reg_cnt['month'];
								}
								// ����Ʈ ���
								for ($i=0; $row=sql_fetch_array($result); $i++) {
									$year = $row['year'];
									$month = $row['month'];
									//�ߺ� �޿����� ����
									//echo $year." != ".$old_year." && ".$month." != ".$old_month;
									if($search_month || $year != $old_year || $month != $old_month || $i == 0) {
										//$page
										//$total_page
										//$rows
										$no = $total_count - $i - ($rows*($page-1));
										$list = $i%2;
										//����� �ڵ� / ��� / �ڵ�_���
										$code = $row['com_code'];
										$id = $row['sabun'];
										$code_id = $code."_".$id;
										// ������ : ������ڵ�
										$sql_com = " select com_name from $g4[com_list_gy] where com_code = '$row[com_code]' ";
										$row_com = sql_fetch($sql_com);
										$com_name = $row_com['com_name'];
										$com_name = cut_str($com_name, 21, "..");
										$name = cut_str($row['name'], 6, "..");
										//����,��
										//$search_year = 2013;
										//$search_month = 11-$i;
										//���
										$year_month = $row['year']."_".$row['month'];
										//�����
										$reg_day = $row['w_date'];
										//��Ͻð�
										$reg_time = $row['w_time'];
										//����ڼ�
										$pay_count = $row['cnt'];
										//���Ƚ��
										$reg_cnt = $reg_cnt_array[$year][$month];
										//��Ϻμ�
										$reg_dept = $reg_dept_array[$year][$month];
										//echo " // ".$no;
										//���� ��ũ
										if($member['mb_profile'] == "guest") {
											$url_form = "javascript:alert_demo();";
											$url_form_report = "javascript:alert_demo();";
											$url_form_tax_free = "javascript:alert_demo();";
											$url_form_account = "javascript:alert_demo();";
											$url_pay_ledger = "javascript:alert_demo();";
											$url_pay_ledger_excel = "javascript:alert_demo();";
										} else {
											$url_form = "javascript:printPayList('$row[year]','$row[month]','$reg_day','$reg_time');";
											$url_form_report = "javascript:printPayList2('$row[year]','$row[month]','$reg_day','$reg_time');";
											$url_form_tax_free = "javascript:printPayList4('$row[year]','$row[month]','$reg_day','$reg_time');";
											$url_form_account = "javascript:printPayList3('$row[year]','$row[month]','$reg_day','$reg_time');";
											//(��)���� ������, ����� ���� 160115
											if($com_code == "20602") {
												//�μ� �ڵ�
												$dept_code = $row['dept_code'];
												if($dept_code == 1) $url_pay_ledger = "pay_white.php?w=u&code=".$code."&search_year=".$row['year']."&search_month=".$row['month']."&w_date=".$reg_day."&w_time=".$reg_time;
												if($dept_code == 2) $url_pay_ledger = "pay_blue.php?w=u&code=".$code."&search_year=".$row['year']."&search_month=".$row['month']."&w_date=".$reg_day."&w_time=".$reg_time;
												else $url_pay_ledger = "pay_white.php?w=u&code=".$code."&search_year=".$row['year']."&search_month=".$row['month']."&w_date=".$reg_day."&w_time=".$reg_time;
											} else {
												$url_pay_ledger = "pay_all.php?w=u&code=".$code."&search_year=".$row['year']."&search_month=".$row['month']."&w_date=".$reg_day."&w_time=".$reg_time;
											}
											//ȭ��������κθ�ȸ ����� ���� �޿����� 160107
											if($com_code == "20399") $url_pay_ledger_excel = "pay_ledger_excel_h_month.php?code=".$code."&search_year=".$row['year']."&search_month=".$row['month']."&w_date=".$reg_day."&w_time=".$reg_time;
											else if($com_code == "20602") $url_pay_ledger_excel = "pay_ledger_excel_p.php?code=".$code."&search_year=".$row['year']."&search_month=".$row['month']."&w_date=".$reg_day."&w_time=".$reg_time; //(��)����
											else $url_pay_ledger_excel = "pay_ledger_excel.php?code=".$code."&search_year=".$row['year']."&search_month=".$row['month']."&w_date=".$reg_day."&w_time=".$reg_time;
										}
										$url_pay_ledger_list = "settlement_pay.php?search_year=".$row['year']."&search_month=".$row['month'];
								?>
<?
if($search_month) {
	$w_gubun = "";
} else {
	//�ش� �� �޿����� ��ü����
	$w_gubun = "all";
}
?>
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
									<td nowrap class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$code_id?>_<?=$year_month?>_<?=$reg_day?>_<?=$reg_time?>_<?=$w_gubun?>" class="no_borer"></td>
<?
if($is_admin == "super") {
?>
									<td nowrap class="ltrow1_center_h22"><?=$com_name?></td>
<?
}
?>
									<td nowrap class="ltrow1_center_h22"><?=$row[year]?>��</td>
									<td nowrap class="ltrow1_center_h22"><?=$row[month]?>��</td>
<?
if($search_month) {
?>
									<td nowrap class="ltrow1_center_h22"><a href="<?=$url_pay_ledger?>"><?=$row[year]?>�� <?=$row[month]?>�� �޿�����</a></td>
<?
} else {
?>
									<td nowrap class="ltrow1_center_h22"><a href="<?=$url_pay_ledger_list?>" target=""><b><?=$row[year]?>�� <?=$row[month]?>�� �޿�����</b></a></td>
<?
}
?>
									<td nowrap class="ltrow1_center_h22"><?=$reg_day?></td>
<?
if($search_month) {
	$w_gubun = "";
?>
									<td nowrap class="ltrow1_center_h22"><?=$reg_time?></td>
<?
} else {
	//�ش� �� �޿����� ��ü����
	$w_gubun = "all";
?>
									<td nowrap class="ltrow1_center_h22"><?=$reg_cnt?></td>
<?
}
if($search_month) {
?>
									<td nowrap class="ltrow1_center_h22"><?=$pay_count?></td>
<?
	//������
	if($com_code == "20284") {
?>
									<td class="ltrow1_left_h22" colspan="2">
										<?=$row[dept]?>
									</td>
<?
	} else {
?>
									<td nowrap class="ltrow1_center_h22"><?=number_format($row[sum_total])?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($row[sum_gongje])?></td>
<?
	}
?>
									<td nowrap class="ltrow1_center_h22"><?=number_format($row[sum_result])?></td>
<?
} else {
?>
									<td class="ltrow1_left_h22" colspan="4">
										<?=$reg_dept?>
									</td>
<?
}
if($search_month) {
?>
									<td nowrap class="ltrow1_center_h22">
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_form?>" target="">�޿�����</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table> 
									</td>
									<td nowrap class="ltrow1_center_h22">
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_form_report?>" target="">�Ű��</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table> 
									</td>
									<td nowrap class="ltrow1_center_h22">
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_form_tax_free?>" target="">�����</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table> 
									</td>
									<td nowrap class="ltrow1_center_h22">
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_form_account?>" target="">ȸ��</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table> 
									</td>
<?
} else {
?>
									<td nowrap class="ltrow1_center_h22" colspan="4">
										�� �޿������ Ŭ���Ͻʽÿ�.
									</td>
<?
}
?>
								</tr>
								</tr>
								<?
									}
									$old_year = $row['year'];
									$old_month = $row['month'];
								}
								if($i == 0) {
									echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' nowrap class=\"ltrow1_center_h22\">�ڷᰡ �����ϴ�.</td></tr>";
								} else if($i == 1) {
									echo "<input type='checkbox' name='idx' value='' class='no_borer' style='display:none'>";
								}
								?>
								<tr>
									<td nowrap class="tdhead_center"></td>
<?
if($is_admin == "super") {
?>
									<td nowrap class="tdhead_center"></td>
<? } ?>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
									<td nowrap class="tdhead_center"></td>
								</tr>
							</table>

							<table width="60%" align="center" border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td height="40">
										<div align="center">
											<?
											$pagelist = get_paging($config[cf_write_pages], $page, $total_page, "?$qstr&page=");
											echo $pagelist;
											?>
										</div>
									</td>
								</tr>
							</table>
<?
//���Ѻ� ��ũ��
if($member['mb_profile'] == "guest") {
	$url_del = "javascript:alert_demo();";
	$url_view = "javascript:alert_demo();";
} else {
	$url_del = "javascript:checked_ok();";
	$url_view = "pay_list.php";
}
?>

							<table width="100%" border="0" cellpadding="0" cellspacing="0" style="table-layout:fixed">
								<tr>
									<td align="center">
										<a href="<?=$url_del?>" target=""><img src="images/btn_choice_big.png" border="0"></a>
									</td>
								</tr>
							</table>
							</form>


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
