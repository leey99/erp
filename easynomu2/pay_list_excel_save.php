<?
$sub_menu = "300100";
include_once("./_common.php");

//�⵵, ��, ����� �ڵ� ����
if(!$search_year) $search_year = date("Y");
if(!$search_month) $search_month = date("m");
$com_code = $code;

$sql_common = " from $g4[pibohum_base] a, pibohum_base_opt b ";

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
//������, ������ �ٷ��ڸ� ǥ��
$sql_search .= " and ( b.pay_gbn = '0' or b.pay_gbn = '3' ) ";
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
//���� ����
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
//���� order by
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
//�޿����� DB (�޿��ݿ�) ���
$sql_w_date = " select * from pibohum_base_pay where com_code='$com_code' and year = '$search_year' and month = '$search_month' order by w_date desc, w_time desc limit 0, 1 ";
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
//��������� �ɼ� DB
$sql_com_opt = " select * from com_list_gy_opt where com_code='$com_code' ";
$result_com_opt = sql_query($sql_com_opt);
$row_com_opt=mysql_fetch_array($result_com_opt);
//����� Ÿ��
if($row_com_opt[comp_print_type]) {
	$comp_print_type = $row_com_opt['comp_print_type'];
} else {
	$comp_print_type = "default";
}
if($comp_print_type == "N") {
	header('Location:./pay_white.php');
}
//������
$com_name = $row_com_opt['com_name_opt'];
// ����Ʈ ���
for ($i=0; $row=sql_fetch_array($result); $i++) {
	//������� �߰� DB 2
	$sql3 = " select * from pibohum_base_opt2 where com_code='$code' and sabun='$row[sabun]' ";
	$result3 = sql_query($sql3);
	$row3=mysql_fetch_array($result3);

	//����
	$sql_position = " select * from com_code_list where com_code = '$code' and code='$row[position]' and item='position' ";
	$result_position = sql_query($sql_position);
	$row_position = mysql_fetch_array($result_position);
	//echo $row_position[name];
	$position = $row_position['name'];
	$k = $i+1;

	//�޿�����
	if($row[pay_gbn] == "0") $pay_gbn = "������";
	else if($row[pay_gbn] == "1") $pay_gbn = "�ñ���";
	else if($row[pay_gbn] == "2") $pay_gbn = "���ձٹ�";
	else if($row[pay_gbn] == "3") $pay_gbn = "������";
	else if($row[pay_gbn] == "4") $pay_gbn = "�ϱ���";
	else $pay_gbn = "-";

	//�޿������� ���ų� ����޿����� DB ȣ��
	if($row4['money_month'] == 0 || $data == "load") {
		if($pay_gbn_no == 1) {
			$money_total = $row3['money_hour_ds'];
			$money_hour_ds = $row3['money_hour_ds'];
		} else if($pay_gbn_no == 4) {
			$money_total = $row3['money_day_base'];
			$money_hour_ds = $row3['money_hour_ds'];
		} else {
			$money_total = $row3['money_month_base'];
			$money_hour_ds = 0;
		}
		$workhour_day = $row3['workhour_day'];
		$workhour_ext = $row3['workhour_ext'];
		$workhour_night = $row3['workhour_night'];
		$workhour_hday = $row3['workhour_hday'];
		$workhour_year = $row3['workhour_year'];

		$w_ext_add = 0;
		$w_night_add = 0;
		$w_hday_add = 0;

		//��������
		$att_ymd = $search_year."".$search_month;
		$sql_attendance = " select * from a4_attendance where com_code='$com_code' and sabun='$row[sabun]' ";
		//echo $sql_attendance;
		$result_attendance = sql_query($sql_attendance);
		$att_rule = array();
		//�������� �ʱ�ȭ
		$w_late = "";
		$w_leave = "";
		$w_out = "";
		$w_absence = "";
		for($j=0; $row_attendance=sql_fetch_array($result_attendance); $j++) {
			//��������
			$att_day = date('Y-m-d',strtotime($row_attendance[att_day]));
			$att_date = explode("-", $att_day);
			//�ش� �⵵
			if($att_date[0] == $search_year && $att_date[1] == $search_month) {
				$monthday = date('md',strtotime($row_attendance[att_day]));
				$att_rule_2 = explode(":", $row_attendance[att_time2]);
				$att_rule_1 = explode(":", $row_attendance[att_time]);
				if($att_rule_2[0] < $att_rule_1[0]) {
					$att_rule_hour = (24 - $att_rule_1[0]) + $att_rule_2[0];
				} else {
					$att_rule_hour = ($att_rule_2[0] - $att_rule_1[0]);
				}
				$att_rule_min = ($att_rule_2[1] - $att_rule_1[1]);
				$att_rule_min_cal = $att_rule_min / 60;
				$att_category = $row_attendance[att_category];
				//echo $att_category;
				$att_rule[$att_category] = $att_rule_hour + $att_rule_min_cal;
				//$att_rule[$att_category] += $att_rule[$att_category];
				if($att_category == 3) $w_late += $att_rule[$att_category];
				else if($att_category == 2) $w_leave += $att_rule[$att_category];
				else if($att_category == 4) $w_out += $att_rule[$att_category];
				else if($att_category == 1) $w_absence += $att_rule[$att_category] -1;
			}
		}
		if($j == 0) {
			$w_late = "";
			$w_leave = "";
			$w_out = "";
			$w_absence = "";
		}
		$workhour_total = 0;

		$money_hour_ts = $row3[money_hour_ts];
		//�⺻�ñ�
		$money_time = $row3[money_min_base];
		$money_base = $row3[money_hour_ms];

		$money_ext = $row3[money_b1];
		$money_night = $row3[money_b2];
		$money_hday = $row3[money_b3];
		$annual_paid_holiday = $row3[money_b4];

		$money_ext_add = $row4[ext_add];
		$money_night_add = $row4[night_add];
		$money_hday_add = $row4[hday_add];

		$money_g1 = $row3[money_g1];
		$money_g2 = $row3[money_g2];
		$money_g3 = $row3[money_g3];
		$money_g4 = $row3[money_g4];
		$money_g5 = $row3[money_g5];

		$money_e1 = $row3[money_e1];
		$money_e2 = $row3[money_e2];
		$money_e3 = $row3[money_e3];
		$money_e4 = $row3[money_e4];
		$money_e5 = $row3[money_e5];
		$money_e6 = $row3[money_e6];
		$money_e7 = $row3[money_e7];
		$money_e8 = $row3[money_e8];
	} else {
		if($pay_gbn_no == 1) {
			if($row4[money_hour_ds]) {
				$money_total = $row4[money_hour_ds];
			} else {
				$money_total = $row3[money_hour_ds];
			}
			$money_hour_ds = $row4[money_hour_ds];
		} else {
			//echo $row4[money_setting];
			$money_total = $row4[money_setting];
			$money_hour_ds = 0;
		}

		$workhour_day = $row4[w_day];
		$workhour_ext = $row4[w_ext];
		$workhour_night = $row4[w_night];
		$workhour_hday = $row4[w_hday];
		$workhour_year = 0;

		$w_ext_add = $row4[w_ext_add];
		$w_night_add = $row4[w_night_add];
		$w_hday_add = $row4[w_hday_add];

		$w_late = $row4[w_late];
		$w_leave = $row4[w_leave];
		$w_out = $row4[w_out];
		$w_absence = $row4[w_absence];

		$workhour_total = $row4[workhour_total];

		$money_hour_ts = $row4[money_time];
		//�⺻�ñ�
		$money_time = $row4[money_min_base];
		$money_base = $row4[money_month];

		$money_ext = $row4[ext];
		$money_night = $row4[night];
		$money_hday = $row4[hday];
		$annual_paid_holiday = $row4[annual_paid_holiday];

		$money_ext_add = $row4[ext_add];
		$money_night_add = $row4[night_add];
		$money_hday_add = $row4[hday_add];

		$money_g1 = $row4[g1];
		$money_g2 = $row4[g2];
		$money_g3 = $row4[g3];
		$money_g4 = $row4[g4];
		$money_g5 = $row4[g5];

		$money_e1 = $row4[b1];
		$money_e2 = $row4[b2];
		$money_e3 = $row4[b3];
		$money_e4 = $row4[b4];
		$money_e5 = $row4[b5];
		$money_e6 = $row4[b6];
		$money_e7 = $row4[b7];
		$money_e8 = $row4[b8];
	}
	//�����ñ� DB ���
	if($row4[money_hour_ds] == 0) {
		$money_hour_ds = $row3[money_hour_ds];
	} else {
		$money_hour_ds = $row4[money_hour_ds];
	}
	//�ٷ��ڸ�
	$name[$i] = $row['name'];
	//���� �� �Է¿� �迭 ����, �ѱ� ��ȯ
	$name[$i] = iconv("EUC-KR", "UTF-8", $name[$i]);
	$sabun[$i] = $row['sabun'];
	$in_day[$i] = $row['in_day'];
	$position_ary[$i] = iconv("EUC-KR", "UTF-8", $position);;
	$pay_gbn_ary[$i] = iconv("EUC-KR", "UTF-8", $pay_gbn);;
	$money_total_ary[$i] = number_format($money_total);
	$workhour_day_ary[$i] = $workhour_day;
	$workhour_ext_ary[$i] = $workhour_ext;
	$workhour_night_ary[$i] = $workhour_night;
	$workhour_hday_ary[$i] = $workhour_hday;
	$w_late_ary[$i] = $w_late;
	$w_leave_ary[$i] = $w_leave;
	$w_out_ary[$i] = $w_out;
	$w_absence_ary[$i] = $w_absence;
	$money_hour_ts_ary[$i] = number_format($money_hour_ts);
	$money_time_ary[$i] = number_format($money_time);
	$money_base_ary[$i] = number_format($money_base);
	$money_ext_ary[$i] = number_format($money_ext);
	$money_night_ary[$i] = number_format($money_night);
	$money_hday_ary[$i] = number_format($money_hday);
	$annual_paid_holiday_ary[$i] = number_format($annual_paid_holiday);
	$money_g1_ary[$i] = number_format($money_g1);
	$money_g2_ary[$i] = number_format($money_g2);
	$money_g3_ary[$i] = number_format($money_g3);
	$money_g4_ary[$i] = number_format($money_g4);
	$money_g5_ary[$i] = number_format($money_g5);
	$money_e1_ary[$i] = number_format($money_e1);
	$money_e2_ary[$i] = number_format($money_e2);
	$money_e3_ary[$i] = number_format($money_e3);
	$money_e4_ary[$i] = number_format($money_e4);
	$money_e5_ary[$i] = number_format($money_e5);
	$money_e6_ary[$i] = number_format($money_e6);
	$money_e7_ary[$i] = number_format($money_e7);
	$money_e8_ary[$i] = number_format($money_e8);
	$etc[$i] = number_format($row4['etc']);
	$yun[$i] = number_format($row4['yun']);
	$health[$i] = number_format($row4['health']);
	$yoyang[$i] = number_format($row4['yoyang']);
	$goyong[$i] = number_format($row4['goyong']);
	$tax_so[$i] = number_format($row4['tax_so']);
	$tax_jumin[$i] = number_format($row4['tax_jumin']);
	$minus[$i] = number_format($row4['minus']);
}
//for�� ����

//���� ����� ���� �ð�
$now_time_file = date("Ymd_His");
//PHPExcel
include $_SERVER["DOCUMENT_ROOT"]."/PHPExcel/Classes/PHPExcel.php";
//���ø� ���� ����
$file = "excel/pay_month.xlsx";
$objReader = PHPExcel_IOFactory::createReaderForFile($file);
$objPHPExcel = new PHPExcel();
$objPHPExcel = $objReader->load($file);
//���� ���ϸ�
$file_name = $com_name."_".$search_year."��_".$search_month."��.xls";
//�� �Է� for��
for($i=0;$i<$total_count;$i++) {
	$k = $i + 4;
	//Add some data
	$objPHPExcel->setActiveSheetIndex(0)
							->setCellValueExplicit("A$k", $sabun[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValue("B$k", $name[$i])
							->setCellValueExplicit("C$k", $in_day[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValue("D$k", $position_ary[$i])
							->setCellValue("E$k", $pay_gbn_ary[$i])
							->setCellValueExplicit("F$k", $money_total_ary[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("G$k", $workhour_day_ary[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("H$k", $workhour_ext_ary[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("I$k", $workhour_night_ary[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("J$k", $workhour_hday_ary[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("K$k", $w_late_ary[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("L$k", $w_leave_ary[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("M$k", $w_out_ary[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("N$k", $w_absence_ary[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("O$k", $money_hour_ts_ary[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("P$k", $money_time_ary[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("Q$k", $money_base_ary[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("R$k", $money_ext_ary[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("S$k", $money_night_ary[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("T$k", $money_hday_ary[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("U$k", $annual_paid_holiday_ary[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("V$k", $money_g1_ary[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("W$k", $money_g2_ary[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("X$k", $money_g3_ary[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("Y$k", $money_g4_ary[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("Z$k", $money_g5_ary[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("AA$k", $money_e1_ary[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("AB$k", $money_e2_ary[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("AC$k", $money_e3_ary[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("AD$k", $money_e4_ary[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("AE$k", $money_e5_ary[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("AF$k", $money_e6_ary[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("AG$k", $money_e7_ary[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("AH$k", $money_e8_ary[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("AI$k", $etc[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("AJ$k", $yun[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("AK$k", $health[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("AL$k", $yoyang[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("AM$k", $goyong[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("AN$k", $tax_so[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("AO$k", $tax_jumin[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("AP$k", $minus[$i], PHPExcel_Cell_DataType::TYPE_STRING);
}
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file_name");
header("Cache-Control: max-age=0");
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>
