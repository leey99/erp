<?
$sub_menu = "300600";
include_once("./_common.php");

//��� : ����(��ǥ, ������, ������, ����, �渮���, ������) ���� 150914
$mb_id_check = explode('000',$member['mb_id']);
if($mb_id_check[1] != "1" && $member['mb_id'] != "kcmc1001" && $member['mb_id'] != "kcmc1002" && $member['mb_id'] != "kcmc1004" && $member['mb_id'] != "kcmc1008" && $member['mb_id'] != "master") {
	alert("�ش� �������� ������ ������ �����ϴ�.");
} else {
	//���� ���� �ִ� ����� ������ ���� 160331
	$is_admin = "super";
}

//���� �⵵
$year_now = date("Y");
//�⵵ ����
if(!$search_year) $search_year = date("Y");

//�⵵, �� ���� (���� ��� ������) 150703
if(!$search_month) {
	$search_month = date("m");
	//echo $search_month;
	if($search_month == 1) {
		$search_year_minus = 1;
		$search_month = 12;
	} else {
		$search_year_minus = 0;
		$search_month -= 1;
	}
	if($search_month < 10) $search_month = "0".$search_month;
	$search_year = date("Y");
	$search_year -= $search_year_minus;
}

//echo date("m");
$sql_common = " from pibohum_base_pay ";

$sql_a4 = " select com_code from $g4[com_list_gy] where t_insureno = '$member[mb_id]' ";
$row_a4 = sql_fetch($sql_a4);
$com_code = $row_a4[com_code];

//echo $is_admin;
if($is_admin == "super") {
	$com_code = 395;
}
$colspan = 16;

$sql_search = " where com_code='$com_code' and year='$search_year' ";

// �˻� : ��
if($search_year) {
	$sql_search .= " and ( ";
	$sql_search .= " (year like '$search_year%') ";
	$sql_search .= " ) ";
}
// �˻� : ��
if($search_month) {
	$sql_search .= " and ( ";
	$sql_search .= " (month like '$search_month%') ";
	$sql_search .= " ) ";
}
//�����
if($w_date) $sql_search .= " and w_date='$w_date' ";
//��Ͻ�
if($w_time) $sql_search .= " and w_time='$w_time' ";
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

if($is_admin == "super") {
	$sst = "com_code";
	$sod = "desc";
	if($sort1) $sod .= ", ";
}

if (!$sst1) {
	if($sort1) {
		if($sort1 == "in_day" || $sort1 == "name") $sst1 = "".$sort1;
		else $sst1 = "".$sort1;
	} else {
		$sst1 = "position";
		$sod1 = "asc";
	}
}
if (!$sst2) {
	if($sort2) {
		if($sort2 == "in_day" || $sort2 == "name") $sst2 = ", ".$sort2;
		else $sst2 = ", ".$sort2;
		$sod2 = $sod2;
	} else {
		$sst2 = ", in_day";
		$sod2 = "asc";
	}
}
if (!$sst3) {
	if($sort3) {
		if($sort3 == "in_day" || $sort3 == "name") $sst3 = ", ".$sort3;
		else $sst3 = ", ".$sort3;
		$sod3 = $sod3;
	} else {
		$sst3 = ", dept";
		$sod3 = "asc";
	}
}
if (!$sst4) {
	if($sort4) {
		if($sort4 == "in_day" || $sort4 == "name") $sst4 = ", ".$sort4;
		else $sst4 = ", ".$sort4;
		$sod4 = $sod4;
	} else {
		$sst4 = ", pay_gbn";
		$sod4 = "asc";
	}
}

$sql_order = " order by $sst $sod $sst1 $sod1 $sst2 $sod2 $sst3 $sod3 $sst4 $sod4 ,sabun asc ";

$sub_title = "�޿�����";
$g4[title] = $sub_title." : ��� : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
";
//echo $sql;
$result = sql_query($sql);

//�˻� �Ķ���� ����
$qstr = "search_year=".$search_year."&search_month=".$search_month;
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
			frm.action="pay_ledger_delete.php";
			frm.submit();
		} else {
			return;
		}
	} 
}
function printPayList(search_year, search_month) {
	frm = document.printForm;
	frm.mode.value = "salary_list";
	frm.search_year.value = search_year;
	frm.search_month.value = search_month;
	frm.target = "_blank";
	frm.action = "pay_ledger.php?code=<?=$com_code?>";
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
						<td width="129"><a href="settlement_pay.php"><img src="images/menu06_top04_off.gif" border="0" alt="�޿�����" /></a></td>
						<td width="129"><a href="pay_all.php"><img src="images/menu06_top03_off.gif" border="0" alt="�޿��ݿ�" /></a></td>
						<td width="129"><a href="pay_stubs_list.php"><img src="images/menu06_top05_on.gif" border="0" alt="��/�� ���" /></a></td>
						<td></td>
					</tr>
					<tr><td height="1" bgcolor="#cccccc" colspan="9"></td></tr>
				</table>
				<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top" style="padding:10px 0 0 0">

							<!--������ -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr> 
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
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
								<input type="hidden" name="page" value="<?=$page?>">
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable1" style="table-layout:fixed">
									<col width="10%">
									<col width="">
									<col width="">
									<tr>
										<td nowrap class="tdrowk"><img src="/img/ims/icon_02.gif" width="2" height="2" style="margin:0 5 3 0">�޿��⵵/��</td>
										<td nowrap class="tdrow">
											<select name="search_year" class="selectfm" onChange="goSearch();">
<?
for($i=2011;$i<=$year_now;$i++) {
?>
												<option value="<?=$i?>" <? if($i == $search_year) echo "selected"; ?> ><?=$i?></option>
<?
}
?>
											</select> ��
											<select name="search_month" class="selectfm" onChange="goSearch();">
<?
for($i=1;$i<=12;$i++) {
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
							</form>

							<!--��޴� -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
												��ü ���
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

							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
								<tr>
									<td nowrap class="tdhead_center" width="60">����</td>
									<td nowrap class="tdhead_center" width="40">��</td>
									<td nowrap class="tdhead_center" width="84">�����</td>
									<td nowrap class="tdhead_center" width="50">�ο�</td>
									<td nowrap class="tdhead_center" width="">�μ�</td>
									<td nowrap class="tdhead_center" style="padding:4px 0 2px 0;" width="90">��ձ⺻�ñ�<br />������ñ�</td>
									<td nowrap class="tdhead_center" width="90">���ӱݰ�<br />��ձ⺻����</td>
									<td nowrap class="tdhead_center" width="82">�Ѱ�����</td>
									<td nowrap class="tdhead_center" width="90">�����޾�</td>
									<td nowrap class="tdhead_center" width="65">��������</td>
								</tr>
								<?
								// ����Ʈ ���
								$sst2 = "year desc";
								$sst3 = ", month desc";
								$sql_order_month = " order by w_date desc, w_time desc, $sst2 $sst3 ";
								$sql_month = " select count(*) as cnt
												 $sql_common
												 $sql_search
												 $sql_order ";

								//echo $sql;
								$row_month = sql_fetch($sql_month);
								$total_count_month = $row_month[cnt];

								$rows = 15;
								$total_page  = ceil($total_count / $rows);  // ��ü ������ ���

								if (!$page) $page = 1; // �������� ������ ù ������ (1 ������)
								$from_record = ($page - 1) * $rows; // ���� ���� ����

								$sql_month = " select com_code, sabun, year, month, count(month) as cnt, sum(money_total) as sum_total, sum(money_gongje) as sum_gongje, 
													sum(money_result) as sum_result, w_date, w_time, sum(money_min_base) as sum_money_min_base, sum(money_time) as sum_money_time,
													sum(money_month) as sum_money_month,
													group_concat(DISTINCT dept SEPARATOR '. ') as dept
													$sql_common
													$sql_search group by year, month, w_date, w_time
													$sql_order_month 
													limit $from_record, $rows ";
								//echo $sql_month;
								$result_month = sql_query($sql_month);
								$colspan_month = 10;

								for ($i=0; $row_month=sql_fetch_array($result_month); $i++) {
									//$page
									//$total_page
									//$rows
									$no = $total_count_month - $i - ($row_months*($page-1));
									$list = $i%2;
									//����� �ڵ� / ��� / �ڵ�_���
									$code = $row_month[com_code];
									$id = $row_month[sabun];
									$code_id = $code."_".$id;
									// ������ : ������ڵ�
									$sql_com = " select com_name from $g4[com_list_gy] where com_code = '$row_month[com_code]' ";
									$row_month_com = sql_fetch($sql_com);
									$com_name = $row_month_com[com_name];
									$com_name = cut_str($com_name, 21, "..");
									$name = cut_str($row_month[name], 6, "..");
									//����,��
									//$search_year = 2013;
									//$search_month = 11-$i;
									//���
									$year_month = $row_month[year]."_".$row_month[month];
									//�����
									$reg_day = $row_month[w_date];
									//��Ͻð�
									$w_time = $row_month['w_time'];
									//�ʱ� ����Ͻ�
									if($i == 0) {
										$w_date_first = $row_month['w_date'];
										$w_time_first = $row_month['w_time'];
									}
									//����ڼ�
									$pay_count = $row_month[cnt];
									//��Ϻμ�
									$dept_txt = $row_month['dept'];
									//���� ��ũ
									if($member['mb_profile'] == "guest") {
										$url_form = "javascript:alert_demo();";
										$url_form_all_excel = "javascript:alert_demo();";
										$url_pay_ledger = "javascript:alert_demo();";
									} else {
										$url_form = "pay_stubs_all.php?code=$code&$qstr&search_year=$search_year&search_month=$search_month&w_date=$w_date&w_time=$w_time&page=$page";
										$url_form_all_excel = "pay_stubs_all_excel.php?code=".$code."&search_year=".$search_year."&search_month=".$search_month."&w_date=".$w_date."&w_time=".$w_time;
										$url_pay_ledger = "pay_list.php?w=u&code=".$code."&search_year=".$search_year."&search_month=".$search_month."&w_date=".$w_date."&w_time=".$w_time."&page=".$page;
									}
									$url_pay_stubs = $PHP_SELF."?w_date=".$reg_day."&w_time=".$w_time;
								?>
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
									<td nowrap class="ltrow1_center_h34"><?=$row_month[year]?>��</td>
									<td nowrap class="ltrow1_center_h34"><?=$row_month[month]?>��</td>
									<td nowrap class="ltrow1_center_h34" style="padding:4px 0 2px 0;"><a href="<?=$url_pay_stubs?>" style="font-weight:bold;"><?=$reg_day?><br /><?=$w_time?></a></td>
									<td nowrap class="ltrow1_center_h34"><?=$pay_count?>��</td>
									<td class="ltrow1_center_h34"><?=$dept_txt?></td>
									<td nowrap class="ltrow1_center_h34"><?=number_format($row_month[sum_money_min_base]/$pay_count)?><br /><?=number_format($row_month[sum_money_time]/$pay_count)?></td>
									<td nowrap class="ltrow1_center_h34"><?=number_format($row_month[sum_total])?><br /><?=number_format($row_month[sum_money_month]/$pay_count)?></td>
									<td nowrap class="ltrow1_center_h34"><?=number_format($row_month[sum_gongje])?></td>
									<td nowrap class="ltrow1_center_h34"><?=number_format($row_month[sum_result])?></td>
									<td nowrap class="ltrow1_center_h34">
										<table border=0 cellpadding=0 cellspacing=0 style=display:inline;><tr><td width=2></td><td><img src=images/btn_lt.gif></td><td background=images/btn_bg.gif class=ftbutton1 nowrap><a href="<?=$url_form_all_excel?>" target="">��������</a></td><td><img src=images/btn_rt.gif></td><td width=2></td></tr></table> 
									</td>
								</tr>
								</tr>
								<?
								}
								if($i == 0) {
									echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan_month' nowrap class=\"ltrow1_center_h22\">�ڷᰡ �����ϴ�.</td></tr>";
								} else if($i == 1) {
									echo "<input type='checkbox' name='idx' value='' class='no_borer' style='display:none'><input type='hidden' name='codex' value=''>";
								}
								?>
							</table>
							<div style="height:10px;font-size:0px;line-height:0px;"></div>

							<!--��޴� -->
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr>
									<td id=""> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="images/g_tab_on_lt.gif"></td> 
												<td background="images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:100;text-align:center'> 
												���� ���
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
							.btn00 a {display:inline-block;border-top:#FFFFFF solid 1px;background:#EFEFEF;padding:1px 5px 1px 5px;color:#444;font-family:dotum;font-size:11px;text-decoration:none;letter-spacing:-1px;}
							.btn00 a:hover {background:#E1E1E1;}
							.btn00 input {margin:0;cursor:pointer;border-top:#DFDFDF solid 1px;border-left:#DFDFDF solid 1px;border-right:#DFDFDF solid 1px;border-bottom:#C0C0C0 solid 1px;background:#EFEFEF;height:13px;color:#444;font-family:dotum;font-weight:bold;font-size:11px;text-decoration:none;letter-spacing:-1px;}
							.btn00 input:hover {background:#E1E1E1;}
							</style>
							<form name="dataForm" method="post">
							<input type="hidden" name="chk_data">
							<input type="hidden" name="page" value="<?=$page?>">
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable" style="table-layout:fixed;">
								<tr>
									<td nowrap class="tdhead_center" width="28"><input type="checkbox" name="checkall" value="1" class="textfm" onclick="checkAll()"></td>
									<td nowrap class="tdhead_center" width="30">No</td>
									<td nowrap class="tdhead_center" width="60">���</td>
									<td nowrap class="tdhead_center" width="70">�̸�</td>
									<td nowrap class="tdhead_center" width="74">�Ի���</td>
									<td nowrap class="tdhead_center" width="60">�޿�����</td>
									<td nowrap class="tdhead_center" width="70">����</td>
									<td nowrap class="tdhead_center" width="70">�μ�</td>
									<td nowrap class="tdhead_center" width="60">�⺻�ñ�</td>
									<td nowrap class="tdhead_center" width="60">���ñ�</td>
									<td nowrap class="tdhead_center" width="86">�⺻����</td>
									<td nowrap class="tdhead_center" width="">����</td>
									<td nowrap class="tdhead_center" width="">�����</td>
									<td nowrap class="tdhead_center" width="">������</td>
									<td nowrap class="tdhead_center" width="">�����޾�</td>
									<td nowrap class="tdhead_center" width="65">��������</td>
								</tr>
<?
$sql_common = " from pibohum_base_pay ";
$sql_search = " where com_code='$com_code' and year='$search_year' and month='$search_month' and w_date='$w_date_first' and w_time='$w_time_first' ";
$sql_search .= " and money_result > 0 ";
$sql = " select count(*) as cnt
         $sql_common
         $sql_search
         $sql_order ";
//echo $sql;
$row = sql_fetch($sql);
$total_count = $row[cnt];
$rows = 15;
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���
if (!$page) $page = 1; // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����

$sql = " select * $sql_common $sql_search $sql_order limit $from_record, $rows ";
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
	$sql2 = " select * from pibohum_base a, pibohum_base_opt b where (a.com_code=b.com_code and a.sabun=b.sabun) and a.com_code='$row[com_code]' and a.sabun='$row[sabun]' ";
	//echo $sql2;
	$result2 = sql_query($sql2);
	$row2=mysql_fetch_array($result2);

	//ä������
	$work_form = $row[work_form];

	//�Ի���
	$in_day = $row['in_day'];

	//�޿�����
	if($row[pay_gbn] == 0) $pay_gbn = "������";
	else if($row[pay_gbn] == 1) $pay_gbn = "�ñ���";
	else if($row[pay_gbn] == 2) $pay_gbn = "���ձٹ�";
	else if($row[pay_gbn] == 3) $pay_gbn = "������";
	else $pay_gbn = "-";

	//����
	$sql_position = " select * from com_code_list where com_code = '$row[com_code]' and code='$row[position]' and item='position' ";
	//echo $sql_position;
	$result_position = sql_query($sql_position);
	$row_position=mysql_fetch_array($result_position);
	//echo $row_position[name];
	if($row_position[name]) $position_name = $row_position[name];
	else $position_name = "-";
/*
	//������� �޿� DB
	$sql_pay = " select * from pibohum_base_pay where com_code='$row[com_code]' and sabun='$row[sabun]' and year='$row[year]' and month='$row[month]' ";
	//echo $sql_pay;
	$result_pay = sql_query($sql_pay);
	$row_pay=mysql_fetch_array($result_pay);
*/
	//���� ��ũ
	if($member['mb_profile'] == "guest") {
		$url_form = "javascript:alert_demo();";
		$url_form_excel = "javascript:alert_demo();";
	} else {
		$url_form = "pay_stubs.php?id=$row[sabun]&code=$row[com_code]&search_year=$row[year]&search_month=$row[month]&page=$page";
		$url_form_excel = "pay_stubs_excel.php?id=".$row['sabun']."&code=".$code."&search_year=".$search_year."&search_month=".$search_month."&w_date=".$w_date_first."&w_time=".$w_time_first;
	}
	//����� �հ� 160329
	$tax_exemption = $row['money_total']  - $row['money_for_tax'];
?>
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
									<td nowrap class="ltrow1_center_h22"><input type="checkbox" name="idx" value="<?=$code_id?>_<?=$year_month?>" class="no_borer" /></td>
									<td nowrap class="ltrow1_center_h22"><?=$no?></td>
									<td nowrap class="ltrow1_center_h22"><?=$row2['employee_no']?></td>
									<td nowrap class="ltrow1_center_h22"><b><?=$name?></b></td>
									<td nowrap class="ltrow1_center_h22"><?=$in_day?></td>
									<td nowrap class="ltrow1_center_h22"><?=$pay_gbn?></td>
									<td nowrap class="ltrow1_center_h22"><?=$position_name?></td>
									<td nowrap class="ltrow1_center_h22"><?=$row['dept']?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($row[money_min_base])?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($row[money_time])?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($row[money_month])?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($row[money_for_tax])?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($tax_exemption)?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($row['money_gongje'])?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($row['money_result'])?></td>
									<td nowrap class="ltrow1_center_h22"><span class="btn00"><a href="<?=$url_form_excel?>">��������</a></span></td>
								</tr>
<?
}
if($i == 0) {
	echo "<tr class=\"list_row_now_wh\" onMouseOver=\"this.className='list_row_over';\" onMouseOut=\"this.className='list_row_now_wh';\"><td colspan='$colspan' nowrap class=\"ltrow1_center_h22\">�ڷᰡ �����ϴ�.</td></tr>";
} else if($i == 1) {
	echo "<input type='checkbox' name='idx' value='' class='no_borer' style='display:none' />";
}
?>
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
