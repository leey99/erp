<div id="loading" style="position:absolute;top:0px;right:0px;left:0px;bottom:0px;background:#000;z-index:100;color:#FFF;padding:20px;">
	��ø� ��ٷ� �ֽʽÿ�. ������ �ε� ���Դϴ�.
</div>
<?
$sub_menu = "400100";
include_once("./_common.php");

//guest id
if($member[mb_id] == "guest") {
	$member[mb_id] = "615-12-12345";
	$com_code = "00002";
	$code = "00002";
}

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

//echo $search_month;
$sql_common = " from pibohum_base a, pibohum_base_opt b ";

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
//�ش� �� ���� 160229
$search_month_last_day = date("t", mktime(0, 0, 0, $search_month, 1, $search_year));
//�޿��� ���� �Ի��� ����
$year_month = $search_year.".".$search_month;
$in_day_base = $year_month.".".$search_month_last_day;
$sql_search .= " and ( a.in_day = '' or a.in_day < '$in_day_base' ) ";
//������ ����
$year_month = $search_year.".".$search_month;
$out_day_base = $year_month.".01";
$sql_search .= " and ( a.out_day = '' or a.out_day > '$out_day_base' ) ";
//������ ���� : �����Ⱓ �޿����� ��ǥ�� 150727
//$sql_search .= " and ( a.gubun != '1' ) ";
$sql_search .= " and ( ( a.gubun != '1' ) or ( b.layoff_sdate = '' or b.layoff_edate= '' ) or ( b.layoff_sdate > '$out_day_base' and b.layoff_edate > '$in_day_base' ) or ( b.layoff_sdate < '$out_day_base' and b.layoff_edate < '$in_day_base' ) ) ";
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
			//�μ��� ��� �μ��ڵ� dept_1 �� ���� 160329
			if($sort1 == "dept") $sort1 = "dept_1";
			if($sort1 == "in_day" || $sort1 == "name") $sst = "a.".$sort1;
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
		if($sort2 == "dept") $sort2 = "dept_1";
		if($sort2 == "in_day" || $sort2 == "name") $sst2 = ", a.".$sort2;
		else $sst2 = ", b.".$sort2;
	} else {
		$sst2 = ", a.in_day";
		$sod2 = "asc";
	}
}
if (!$sst3) {
	if($sort3) {
		if($sort3 == "dept") $sort3 = "dept_1";
		if($sort3 == "in_day" || $sort3 == "name") $sst3 = ", a.".$sort3;
		else $sst3 = ", b.".$sort3;
	} else {
		$sst3 = ", b.dept_1";
		$sod3 = "asc";
	}
}
if (!$sst4) {
	if($sort4) {
		if($sort4 == "dept") $sort4 = "dept_1";
		if($sort4 == "in_day" || $sort4 == "name") $sst4 = ", ".$sort4;
		else $sst4 = ", ".$sort4;
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

$rows = 999;
$total_page  = ceil($total_count / $rows);  // ��ü ������ ���

if (!$page) $page = 1; // �������� ������ ù ������ (1 ������)
$from_record = ($page - 1) * $rows; // ���� ���� ����

$sub_title = "�޿��ݿ�";
$g4[title] = $sub_title." : �޿����� : ".$easynomu_name;

$sql = " select *
          $sql_common
          $sql_search
          $sql_order
          limit $from_record, $rows ";
//echo $sql;
$result = sql_query($sql);
$colspan = 12;

//�޿��ݿ� ���̺� ����
$pay_list_width = 2540;

//��������� �ɼ� DB
$sql_com_opt = " select * from com_list_gy_opt where com_code='$com_code' ";
$result_com_opt = sql_query($sql_com_opt);
$row_com_opt=mysql_fetch_array($result_com_opt);
//�޿�������
if($row_com_opt[pay_day]) {
	if($search_month == 12) {
		$pay_date = "1�� ".$row_com_opt[pay_day]."��";
	} else {
		$pay_date = ($search_month+1)."�� ".$row_com_opt[pay_day]."��";
	}
	//�޿������� ��� üũ ����
	if($row_com_opt[pay_day_now_month] == 1) {
		$pay_date = $search_month."�� ".$row_com_opt[pay_day]."��";
	}
} else {
	$pay_date = "������";
}
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title><?=$g4[title]?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/style_admin.css" />
<script language="javascript" src="js/common.js"></script>
</head>
<body style="margin:0px">
<script language="javascript">
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
function goInput(){
	var f = document.dataForm;
	/*
	if( f.jigub_day.value == "" ){
		alert("�������� �Է��� �ּ���.");
		f.jigub_day.focus();
		return;
	}
	*/
	//alert(f.money_month[1].value);
	//alert(<?=$total_count?>);
	//alert(f.w_day.value);
	//w_day = document.getElementsByTagName("w_day[]").;
	//alert(w_day.value);

	//f["w_day_"+0].value = f.workhour_day[1].value;
	//alert(f["w_day_"+0].value);

	for(i=1;i<=<?=$total_count?>;i++) {
		//alert(f.emp_name[i].value);
		k = i-1;
		//alert(f.workhour_day[i].value);
		f["pay_gbn_"+k].value = f.pay_gbn[i].value;

		f["w_day_"+k].value = f.workhour_day[i].value;
		f["w_ext_"+k].value = f.workhour_ext[i].value;
		f["w_night_"+k].value = f.workhour_night[i].value;
		f["w_hday_"+k].value = f.workhour_hday[i].value;

		f["w_ext_add_"+k].value = f.workhour_ext_add[i].value;
		f["w_night_add_"+k].value = f.workhour_night_add[i].value;
		f["w_hday_add_"+k].value = f.workhour_hday_add[i].value;
		//alert(f["w_night_add_"+k].value);

		f["w_late_"+k].value = f.workhour_late[i].value;
		f["w_leave_"+k].value = f.workhour_leave[i].value;
		f["w_out_"+k].value = f.workhour_out[i].value;
		f["w_absence_"+k].value = f.workhour_absence[i].value;

		f["workhour_total_"+k].value = f.workhour_total[i].value;
		//alert(f["workhour_total_"+k].value);

		f["money_hour_ds_"+k].value = f.money_hour_ds[i].value;
		//alert(f["money_hour_ds_"+k].value);
		f["money_hour_ts_"+k].value = f.money_hour_ts[i].value;
		//�⺻�ñ�
		f["money_time_"+k].value = f.money_time[i].value;
		//f["money_day_"+k].value = f.money_day[i].value;
		f["money_month_"+k].value = f.money_base[i].value;
		f["money_setting_"+k].value = f.money_month[i].value;

		f["g1_"+k].value = f.money_g1[i].value;
		f["g2_"+k].value = f.money_g2[i].value;
		f["g3_"+k].value = f.money_g3[i].value;
		f["g4_"+k].value = f.money_g4[i].value;
		f["g5_"+k].value = f.money_g5[i].value;
<?
//ASE�����
if($com_code == 20482) {
?>
		f["g6_"+k].value = f.money_g6[i].value;
<?
}
?>
		f["ext_"+k].value = f.money_ext[i].value;
		f["night_"+k].value = f.money_night[i].value;
		f["hday_"+k].value = f.money_hday[i].value;
		f["annual_paid_holiday_"+k].value = f.money_year[i].value;

		f["ext_add_"+k].value = f.money_ext_add[i].value;
		f["night_add_"+k].value = f.money_night_add[i].value;
		f["hday_add_"+k].value = f.money_hday_add[i].value;

		f["e1_"+k].value = f.money_e1[i].value;
		f["e2_"+k].value = f.money_e2[i].value;
		f["e3_"+k].value = f.money_e3[i].value;
		f["e4_"+k].value = f.money_e4[i].value;
		f["e5_"+k].value = f.money_e5[i].value;
		f["e6_"+k].value = f.money_e6[i].value;
		f["e7_"+k].value = f.money_e7[i].value;
		f["e8_"+k].value = f.money_e8[i].value;

		f["tax_so_var_"+k].value = f.tax_so[i].value;
		f["tax_jumin_var_"+k].value = f.tax_jumin[i].value;
		f["advance_pay_"+k].value = f.advance_pay[i].value;
		f["health_"+k].value = f.money_health[i].value;
		f["yoyang_"+k].value = f.money_yoyang[i].value;
		f["yun_"+k].value = f.money_yun[i].value;
		f["goyong_"+k].value = f.money_goyong[i].value;
		//f["end_pay_"+k].value = f.end_pay[i].value;
		//f["minus_"+k].value = f.minus[i].value;

		f["minus_"+k].value = f.minus[i].value;
		f["minus2_"+k].value = f.minus2[i].value;
		f["etc_"+k].value = f.etc[i].value;
		f["etc2_"+k].value = f.etc2[i].value;

		f["money_total_"+k].value = f.money_total[i].value;
		f["money_for_tax_"+k].value = f.money_for_tax[i].value;
		f["money_gongje_"+k].value = f.money_gongje[i].value;
		f["money_result_"+k].value = f.money_result[i].value;
	}

	f.mode.value = "input";
	f.action = "pay_update.php";
	f.submit();
}
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
//2015�⵵ 7�� ���� �ٷμҵ� ���Ǽ���ǥ 150821
//if($search_year >= 2015 && $search_month >= '07') {
//2015�⵵ �ҵ� ����ǥ ���� ���� �缳�� 160226
$search_year_month = $search_year.".".$search_month;
if($search_year_month >= "2015.07") {
	include "./inc/ary_tax_2015.php";
} else {
	include "./inc/ary_tax.php";
}
?>
//alert('<?=$search_month?>');
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
function checkAll(){
	var f = document.dataForm;
	for( var i = 1; i<f.idx.length; i++ ) {
		f.idx[i].checked = f.checkall.checked;
	}
}
function GetTax(money_for_tax, idx) {
	var f = document.dataForm;
	//alert(idx+" / "+f.family_cnt[idx].value);
	//�ξ簡�� : 20�� ���� �ڳ� �߰����� ���� 160517
	//family_cnt = parseInt(f.family_cnt[idx].value)+parseInt(f.child_cnt[idx].value);
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
	var money_g1,money_g2,money_g3,money_g4,money_g5,money_e1,money_e2,money_e3,money_e4,money_e5,money_e6,money_e7,money_e8;
	var money_total,money_for_tax,money_yun,money_health,money_yoyang,money_goyong,tax_so,tax_jumin,minus,minus2,etc,etc2,money_gongje,money_result, workhour_year;
	var money_yun_rate,money_health_rate,money_yoyang_rate,money_goyong_rate;
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
	//money_gongje ������ = ���ο���+�ǰ�����+����纸��+��뺸��+�ҵ漼+�ֹμ�
	money_gongje = money_yun+money_health+money_yoyang+money_goyong+tax_so+tax_jumin+minus+minus2;
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
		frm.etc2[idx].className = "textfm5";
		frm.money_gongje[idx].className = "textfm5";
		frm.money_result[idx].className = "textfm5";
		//frm.workhour_year[idx].className = "textfm";
	}
}
function stristr (haystack, needle, bool) {
  var pos = 0;
  haystack += '';
  pos = haystack.toLowerCase().indexOf((needle + '').toLowerCase());
  if (pos == -1) {
    return false;
  } else {
    if (bool) {
      return haystack.substr(0, pos);
    } else {
      return haystack.slice(pos);
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
//õ���� �޹� (���� ���)
function checkThousand_negative(inputVal, type, keydown) {
	main = document.dataForm;
	var inputVal = type.value;
	var chk		= 0;
	var share	= 0;
	var start	= 0;
	var triple	= 0;
	var end		= 0;
	var total	= "";
	var input	= "";
	//alert(event.keyCode);
	//�齺���̽� �� ����Ʈ+�� �� �� Del
	if(event.keyCode!=8 && event.keyCode!=9 && event.keyCode!=16 && event.keyCode!=37 && event.keyCode!=39 && event.keyCode!=46) {
		if (inputVal.length > 3) {
			input = delCom(inputVal, inputVal.length);
			chk = (input.length)/3;
			chk = Math.floor(chk);
			share = (input.length)%3;
			if (share == 0 ) chk = chk - 1;
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
		type.value=total.replace(/\-,/g,"-");
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
	org_year_var = f.search_year.value;
	org_month_var = f.search_month.value;
	if(org_month_var == "12") {
		year_var = toInt(org_year_var) + 1;
		month_var = "01";
		//alert(year_var);
	} else {
		month_var = ""+(toInt(org_month_var) + 1);
		if(month_var.length == 1) {
		 month_var = "0"+month_var;
		}
		year_var = org_year_var;
	}
	f.search_year.value = year_var;
	f.search_month.value = month_var;

	//�˻�
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
//������ ���� Ȯ�� �Լ�
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
function emp_text(emp_sabun,emp_name,emp_sdate,emp_edate,emp_position,family_count,emp_work_gbn,emp_pay_gbn,emp_money_base,emp_money_min,emp_money_time) {
	getId('emp_name').innerHTML = emp_name;
	getId('emp_name').style.cursor = "pointer";
	getId('emp_name').style.fontWeight = "bold";
	getId('emp_name').addEventListener("click", function () { window.open('staff_view.php?w=u&code=<?=$com_code?>&id='+emp_sabun,'_blank');	});
	getId('emp_sdate').innerHTML = emp_sdate;
	getId('emp_edate').innerHTML = emp_edate;
	getId('emp_position').innerHTML = emp_position;
	getId('family_count').innerHTML = family_count;
	getId('emp_work_gbn').innerHTML = emp_work_gbn;
	getId('emp_pay_gbn').innerHTML = emp_pay_gbn;
	getId('emp_money_base').innerHTML = emp_money_base;
	getId('emp_money_min').innerHTML = emp_money_min;
	getId('emp_money_time').innerHTML = emp_money_time;
}
<?
//������ �����Է� ����
if($data == "load") {
	echo "addLoadEvent(cal_pay_bt);";
}
?>
</script>
<? include "./inc/top.php"; ?>

<div id="content">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table width="1200" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td valign="top" width="270">
<?
include "./inc/left_menu4.php";
include "./inc/left_banner.php";
?>
						</td>
						<td valign="top" style="padding:10px 10px 10px 10px">
							<!--Ÿ��Ʋ -->
							<table width="100%" border=0 cellspacing=0 cellpadding=0>
								<tr>     
									<td height="18">
										<table width=100% border=0 cellspacing=0 cellpadding=0>
											<tr>
												<td style='font-size:8pt;color:#929292;'><img src="images/g_title_icon.gif" align=absmiddle  style='margin:0 5 2 0'><span style='font-size:9pt;color:black;'><?=$sub_title?></span>
												</td>
												<td align=right class=navi></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr><td height=1 bgcolor=e0e0de></td></tr>
								<tr><td height=2 bgcolor=f5f5f5></td></tr>
								<tr><td height=5></td></tr>
							</table>

							<!--�޿��ݿ� �Է���-->
							<iframe name="hframe" src="" style="width:0;height:0;border:0"></iframe>
							<form name="printForm" method="post" style="margin:0">
								<input type="hidden" name="mode">
								<input type="hidden" name="search_year" value="<?=$search_year?>">
								<input type="hidden" name="search_month" value="<?=$search_month?>">
							</form>
							<table border=0 cellspacing=0 cellpadding=0> 
								<tr> 
									<td id="Tab_cust_tab_01_0"> 
										<table border=0 cellpadding=0 cellspacing=0> 
											<tr> 
												<td><img src="./images/g_tab_on_lt.gif"></td> 
												<td background="./images/g_tab_on_bg.gif" class="Sftbutton_white" nowrap style='width:80px;text-align:center'> 
												<a href="#">�˻�</a>
												</td> 
												<td><img src="./images/g_tab_on_rt.gif"></td> 
											</tr> 
										</table> 
									</td> 
									<td width=2></td> 
								</tr> 
							</table>
							<div style="height:2px;font-size:0px" class="bgtr"></div>
							<div style="height:2px;font-size:0px;line-height:0px;"></div>
							<!--��޴� -->
							<!--�˻� -->
							<form name="searchForm" method="get">
								<input type="hidden" name="select_type" value="">
<?
$search_pay_gbn = "01";

//�޿����� DB (�޿��ݿ�) ��� : �޿����� ��� �����Է� üũ 150723
if($data == "copy") {
	$sql_manual = " select * from pibohum_base_pay where com_code='$com_code' and year = '$copy_year' and month = '$copy_month' and w_date != '0000-00-00' order by manual desc ";
} else {
	$sql_manual = " select * from pibohum_base_pay where com_code='$com_code' and year = '$search_year' and month = '$search_month' and w_date != '0000-00-00' order by manual desc ";
}
$row_manual = sql_fetch($sql_manual);
//�����Է�
$manual_array = explode(",",$row_manual[manual]);
if($manual_array[0] == "1") $check_manual_ext = "checked";
if($manual_array[1] == "1") $check_manual_night = "checked";
if($manual_array[2] == "1") $check_manual_hday = "checked";
if($manual_array[3] == "1") $check_manual_4insure = "checked";
if($manual_array[4] == "1") $check_manual_tax = "checked";
if($manual_array[5] == "1") $check_manual_etc2 = "checked";
//�⺻�� ���� : ����޿����� �ҷ����� Ŭ�� �� �⺻�� �����Է� üũ 150803
if($row_manual['money_month_fix'] == "Y" || $data == "load") $check_money_month_fix = "checked";
//���� ����
if($row_manual[w_date]) {
	$w_date = $row_manual[w_date];
	$w_date_ok = "1";
} else {
	$w_date = "<span style='color:red'>�̵��</span>";
	$w_date_ok = "";
}
//�޿����� �� ���� �̵�� ǥ�� 150806
if($data == "copy") $w_date = "<span style='color:red'>�̵��</span>";
//�޿����� �̵�Ͻ� �⺻�� �����Է� üũ : üũ ���� 150709
//if(!$w_date_ok) $check_money_month_fix = "checked";
?>
								<input type="hidden" name="search_pay_gbn" value="<?=$search_pay_gbn?>">
								<input type="hidden" name="add_work_numb">
								<table width="100%" border="0" cellpadding="0" cellspacing="1" class="" style="table-layout:">
									<col width="180">
									<col width="140">
									<col width="">
									<tr>
										<td class="tdrow">
											<select name="search_year" class="selectfm" onChange="goSearch();" style="font-size:12pt;">
<?
for($i=2013;$i<=2016;$i++) {
?>
												<option value="<?=$i?>" <? if($i == $search_year) echo "selected"; ?> ><?=$i?></option>
<?
}
?>
											</select> ��
											<select name="search_month" class="selectfm" onChange="goSearch();" style="font-size:12pt;">
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
										<td nowrap class="tdrow">
											<table border="0" cellpadding="0" cellspacing="0" style="display:inline;height:18px;">
												<tr>
													<td width="2"></td><td><img src="images/btn9_lt.gif" /></td>
													<td style="background:url(images/btn9_bg.gif) repeat-x center" class="ftbutton5_white" nowrap><a href="javascript:goSearch();">�� ��</a></td><td><img src="images/btn9_rt.gif" /></td><td width="2"></td>
												</tr>
											</table> 
										</td>
										<td nowrap class="tdrow" style="text-align:right">
											<b>�޿�������</b> : <?=$pay_date?>  / <b>����������</b> : <?=$w_date?>
										</td>
										<td nowrap class="tdrow">
<?
$url_pay_excel_input = "pay_excel_input.php";
?>
											<!--<table border="0" cellpadding="0" cellspacing="0" style="display:inline;"><tr><td width="2"></td><td><img src="images/btn_lt.gif" /></td><td style="background:url('images/btn_bg.gif');" class="ftbutton1" nowrap><a href="<?=$url_pay_excel_input?>" onclick="pay_excel_input(this.href);return false;">�����Է�</a></td><td><img src="images/btn_rt.gif" /></td><td width="2"></td></tr></table>-->
										</td>
									</tr>
									<tr>
										<td nowrap class="tdrow" colspan="2" style="height:38px">
											<b>�ӱݻ���Ⱓ</b> : <?=$search_year?>�� <?=number_format($search_month)?>�� <?=$row_com_opt[pay_calculate_day_period1]?>�� ~
											<?=$search_year?>�� <?=number_format($search_month)?>�� <?=$row_com_opt[pay_calculate_day_period2]?>��
										</td>
										<td nowrap class="tdrow" colspan="2" style="text-align:right">
<?
//���Ѻ� ��ũ��
if($member['mb_profile'] == "guest") {
	$url_save = "javascript:alert_demo();";
	$url_preview = "javascript:alert_demo();";
	$url_paylist = "javascript:alert_demo();";
} else {
	$url_save = "javascript:goInput('input');";
	$url_preview = "javascript:goInput('preview');";
	$url_paylist = "javascript:printPayList();";
}
?>
											<div style="float:left">
												<select name="copy_year" id="copy_year" class="selectfm" style="font-size:12pt;">
<?
//�޿����� �⺻ ��� ���� ǥ�� 150723
if(!$copy_month) {
	$copy_month = $search_month;
	//echo $copy_month;
	if($copy_month == 1) {
		$copy_year_minus = 1;
		$copy_month = 12;
	} else {
		$copy_year_minus = 0;
		$copy_month -= 1;
	}
	if($copy_month < 10) $copy_month = "0".$copy_month;
	$copy_year = $search_year;
	$copy_year -= $copy_year_minus;
}
for($i=2013;$i<=2016;$i++) {
?>
													<option value="<?=$i?>" <? if($i == $copy_year) echo "selected"; ?> ><?=$i?></option>
<?
}
?>
												</select> ��<br />
												<select name="copy_month" id="copy_month" class="selectfm" style="font-size:12pt;">
<?
for($i=1;$i<=12;$i++) {
	if($i < 10) $month = "0".$i;
	else $month = $i;
?>
													<option value="<?=$month?>" <? if($i == $copy_month) echo "selected"; ?> ><?=$month?></option>
<?
}
?>
												</select> ��
											</div>
											<div style="float:left;padding-left:4px;">
												<span onclick="pay_copy('<?=$PHP_SELF?>');" style="cursor:pointer"><img src="images/btn_pay_copy_big.png" border="0" /></span>
											</div>
											<div style="float:right">
												<a href="<?=$PHP_SELF?>?data=load&select_type=<?=$select_type?>&search_pay_gbn=<?=$search_pay_gbn?>&add_work_numb=<?=$add_work_numb?>&search_year=<?=$search_year?>&search_month=<?=$search_month?>"><img src="images/btn_staff_pay_get_big.png" border="0" /></a>
												<a href="<?=$PHP_SELF?>?select_type=<?=$select_type?>&search_pay_gbn=<?=$search_pay_gbn?>&add_work_numb=<?=$add_work_numb?>&search_year=<?=$search_year?>&search_month=<?=$search_month?>"><img src="images/btn_last_pay_get_big.png" border="0" /></a>
												<a href="javascript:cal_pay_bt();"><img src="images/btn_paycal_big.png" border="0" /></a>
												<!--<a href="<?=$url_preview?>"><img src="images/btn_preview_big.png" border="0" /></a>-->
												<a href="<?=$url_save?>"><img src="images/btn_paysave_big.png" border="0" /></a>
												<a href="<?=$url_paylist?>"><img src="images/btn_paylist_big_07.png" border="0" /></a>
											</div>
										</td>
									</tr>
								</table>
							</form>
							<div style="height:10px;font-size:0px;line-height:0px;"></div>
<!--�������� -->
<script type="text/javascript" src="popup/images/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="popup/images/jquery.maskedinput-1.3.min.js"></script>
<script type="text/javascript">
function pay_step_btn(no) {
	for(i=1;i<=5;i++) {
		//if(i != 3) getId("pay_step"+i).src = "images/pay_step"+i+".gif";
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
//������ �ε��� 160329
$(document).ready(function(){
	$("#loading").css("display","none");
});
</script>
							<!--�˻� -->
							<form name="dataForm" method="post">
								<input type="hidden" name="mode">
								<input type="hidden" name="code" value="<?=$com_code?>">
								<input type="hidden" name="search_year" value="<?=$search_year?>">
								<input type="hidden" name="search_month" value="<?=$search_month?>">
								<input type="hidden" name="total_count" value="<?=$total_count?>">
								<input type="hidden" name="search_pay_gbn" value="01">
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
											<div id="step2" style="cursor:pointer;margin:0 5px 0 0"><img src="images/pay_step2.gif" id="pay_step2"></div>
										</td> 
										<td width="" align="left">
											<div id="step3" style="cursor:pointer;margin:0 5px 0 0"><img src="images/pay_step3.gif" id="pay_step3"></div>
										</td> 
										<td width="" align="left">
											<div id="step4" style="cursor:pointer;margin:0 5px 0 0"><img src="images/pay_step4.gif" id="pay_step4"></div>
										</td> 
										<td width="" align="left">
											<div id="step5" style="cursor:pointer;margin:0 5px 0 0"><img src="images/pay_step5.gif" id="pay_step5"></div>
										</td> 
										<td align="right" style="padding-left:20px">����� : <?=$total_count?>��</td> 
									</tr> 
								</table>
								<div style="height:2px;font-size:0px" class="bgtr"></div>
								<div style="height:2px;font-size:0px;line-height:0px;"></div>
								<!--��޴� -->
<?
//ASE�����
if($com_code == 20482) {
	include "pay_list_ase.php";
} else {
	include "pay_list_default.php";
}
?>
								<!--����Ʈ -->
								<input type="hidden" name="total_cnt" value="<?=$k?>">
								<input type="hidden" name="error_code" style="width:100%" value="code">
							</form>
							<br />
						<div>
							<table width="100%" border="0" cellpadding="0" cellspacing="1" class="bgtable">
								<tr>
									<td class="tdhead_center" width="60">����</td>
									<td class="tdhead_center" width="40">��</td>
									<td class="tdhead_center" width="90">�⺻��</td>
									<td class="tdhead_center" width="90">�ѹ�������</td>
									<td class="tdhead_center" width="90">����ӱݼ���</td>
									<td class="tdhead_center" width="90"><div style="padding:4px;">��Ÿ����<br />(�����)</div></td>
									<td class="tdhead_center" width="90"><div style="padding:4px;">��Ÿ����<br />(����)</div></td>
									<td class="tdhead_center" width="90">���ӱݰ�</td>
									<td class="tdhead_center" width="90">�Ѱ����ҵ�</td>
									<td class="tdhead_center" width="90">�Ѱ�����</td>
									<td class="tdhead_center" width="">�����޾�</td>
								</tr>
								<?
								// ����Ʈ ���
								$sql_common = " from pibohum_base_pay ";
								$sql_search = " where com_code='$com_code' and year='$search_year' and month='$search_month' ";
								$sql_month = " select com_code, sabun, year, month, count(month) as cnt, sum(money_month) as sum_money_month,
													sum(ext) as sum_ext, sum(night) as sum_night, sum(hday) as sum_hday, sum(annual_paid_holiday) as sum_annual_paid_holiday,
													sum(g1) as sum_g1, sum(g2) as sum_g2, sum(g3) as sum_g3, sum(g4) as sum_g4, sum(g5) as sum_g5,
													sum(b1) as sum_b1, sum(b2) as sum_b2, sum(b3) as sum_b3, sum(b4) as sum_b4, sum(b5) as sum_b5, sum(b6) as sum_b6, sum(b7) as sum_b7, sum(b8) as sum_b8,
													sum(money_total) as sum_total, sum(money_for_tax) as sum_money_for_tax,
													sum(money_gongje) as sum_gongje, 
													sum(money_result) as sum_result, w_date, sum(money_hour_ds) as sum_money_hour_ds, sum(money_time) as sum_money_time
													$sql_common
													$sql_search group by year, month ";
								//echo $sql_month;
								$result_month = sql_query($sql_month);
								$colspan_month = 11;
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
									//����ڼ�
									$pay_count = $row_month[cnt];
									//�Ѱ�
									$sum_court = (int)$row_month['sum_ext']+(int)$row_month['sum_night']+(int)$row_month['sum_hday']+(int)$row_month['sum_annual_paid_holiday'];
									$sum_g = (int)$row_month['sum_g1']+(int)$row_month['sum_g2']+(int)$row_month['sum_g3']+(int)$row_month['sum_g4']+(int)$row_month['sum_g5'];
									$sum_b_tax_free = (int)$row_month['sum_b1']+(int)$row_month['sum_b2']+(int)$row_month['sum_b3']+(int)$row_month['sum_b4'];
									$sum_b_tax = (int)$row_month['sum_b5']+(int)$row_month['sum_b6']+(int)$row_month['sum_b7']+(int)$row_month['sum_b8'];
								?>
								<tr class="list_row_now_wh" onMouseOver="this.className='list_row_over';" onMouseOut="this.className='list_row_now_wh';">
									<td nowrap class="ltrow1_center_h22"><?=$row_month[year]?>��</td>
									<td nowrap class="ltrow1_center_h22"><?=$row_month[month]?>��</td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($row_month['sum_money_month'])?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($sum_court)?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($sum_g)?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($sum_b_tax_free)?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($sum_b_tax)?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($row_month['sum_total'])?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($row_month['sum_money_for_tax'])?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($row_month['sum_gongje'])?></td>
									<td nowrap class="ltrow1_center_h22"><?=number_format($row_month['sum_result'])?></td>
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


							</div>
						</td>
					</tr>
				</table>
				<? include "./inc/bottom.php";?>
			</td>
		</tr>
	</table>			
</div>
<script type="text/javascript">
<!--
//�ڵ� ��� ��ư �Լ�
function cal_pay_bt() {
<?
for($i=1;$i<=$k;$i++) {
?>
	cal_pay('<?=$i?>');
<?
}
?>
}
//����, �߰�, ���ϱٷ� ���� üũ �Է� �ʵ� Ŭ���� ����
<?
for($i=1;$i<=$k;$i++) {
?>
focusOutClass(<?=$i?>);
<?
}
?>
function printPaySome() {
	save_ok = "<?=$w_date_ok?>";
	if( save_ok == "" ) {
		alert("���� �� �̿��� �ּ���.");
		return;
	}
	var f = document.dataForm;
	var pay_no = "";
	for(var i=0; i < f.idx.length; i++) {
		if( f.idx[i].checked ){
			pay_no += (pay_no==""?"":",") + f.pay_no[i].value;
		}
	}
	if( pay_no == "" ) {
		alert("����� ����� ������ �ּ���.");
		return;
	} else if(stristr(pay_no, ',')) {
		alert("�Ѹ� ������ �ּ���.");
		return;
	}
	//alert(pay_no);
	location.href = "pay_stubs.php?id="+pay_no+"&code=<?=$com_code?>&search_year="+f.search_year.value+"&search_month="+f.search_month.value;
}
function printPaySome_name(pay_no) {
	save_ok = "<?=$w_date_ok?>";
	if( save_ok == "" ) {
		alert("���� �� �̿��� �ּ���.");
		return;
	}
	var f = document.dataForm;
	//alert(pay_no);
	location.href = "pay_stubs.php?id="+pay_no+"&code=<?=$com_code?>&search_year="+f.search_year.value+"&search_month="+f.search_month.value;
}
function pay_preview() {
	//alert('�غ����Դϴ�.');
	//return;
	goInput('preview');
/*
	frm = document.printForm;
	frm.mode.value = "salary_list";
	frm.target = "_blank";
	frm.action = "pay_preview.php?code=<?=$com_code?>&search_year="+frm.search_year.value+"&search_month="+frm.search_month.value;
	frm.submit();
*/
}
function printPayList(){
	save_ok = "<?=$w_date_ok?>";
	if( save_ok == "" ) {
		alert("���� �� �̿��� �ּ���.");
		return;
	}
	frm = document.printForm;
	frm.mode.value = "salary_list";
	frm.target = "_blank";
	frm.action = "pay_ledger.php?code=<?=$com_code?>&search_year="+frm.search_year.value+"&search_month="+frm.search_month.value;
	frm.submit();
}
<?
//�޿����� �Ϸ� �˸�
if($data == "copy") {
	echo "alert('".$copy_year."�� ".$copy_month."�� �޿������� ���� �Ǿ����ϴ�.\\n�޿� ���� �� �޿����� ��ư�� Ŭ���Ͻʽÿ�.');";
	echo "cal_pay_bt();";
}
?>
//-->
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
						<li>����� : <span id="emp_edate" style="color:red;"></span></li>
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
				<img src="images/pay_cls_btn02.gif" alt="�ݱ�" onclick="$('#couponHelpDiv').css('display','none')" style="cursor:pointer" />
			</div>
		</div>
	</div>
</div>
<!-- ���� :: end -->
</body>
</html>
