<?
$sub_menu = "300100";
include_once("./_common.php");

//�⵵, ��, ����� �ڵ� ����
if(!$search_year) $search_year = date("Y");
if(!$search_month) $search_month = date("m");
$com_code = $code;

$sql_common = " from $g4[pibohum_base] a, pibohum_base_opt b ";

//��������� �ɼ� DB
$sql_com_opt = " select * from com_list_gy_opt where com_code='$com_code' ";
//echo $sql_com_opt;
//exit;
$result_com_opt = sql_query($sql_com_opt);
$row_com_opt=mysql_fetch_array($result_com_opt);
//����� Ÿ��
if($row_com_opt[comp_print_type]) {
	$comp_print_type = $row_com_opt['comp_print_type'];
} else {
	$comp_print_type = "default";
}
//������
$com_name = $row_com_opt['com_name_opt'];

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
//ȭ��������κθ�ȸ ���� ����� ���� 150819
//$sql_search .= " and ( a.gubun != 2 ) ";
//�ӽ���� �� ����� ���� 160125
$sql_search .= " and ( a.out_day = '' or a.out_day > '$out_day_base' or a.out_temp = '1' ) ";
//�ñ��� �ٷ��ڸ� ǥ��
//$sql_search .= " and ( b.pay_gbn = '1' ) ";
//����
$sql_search .= " and ( b.position = '14' ) ";
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
//���� ���� ���� ���ٶ� ��, �Ի��� 160106
if($comp_print_type == "H") {
	$sst = "a.name";
	$sod = "asc";
	$sst2 = ", a.in_day";
	$sod2 = "asc";
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
$rows = 999;
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
//�ð��� �޿� �ܰ� ���� DB
$start_date = $search_year.".".$search_month.".01";
$end_date = $search_year.".".$search_month.".31";
$where_time = " and end_date >= '$start_date' and start_date <= '$end_date' ";
$sql_time = " select * from com_list_gy_time where com_code='$com_code' $where_time ";
//echo $sql_time;
$result_time = sql_query($sql_time);
$row_time = mysql_fetch_array($result_time);
//type h ���Ǻ���, ��⵵, ȭ����(���,�޽�), �����ð�, ����Ʈ��
$money_time1 = $row_time['money_time1'];
$money_time2 = $row_time['money_time2'];
$money_time3 = $row_time['money_time3'];
$money_time1_com = $row_time['money_time1_com'];
$money_time2_com = $row_time['money_time2_com'];
$money_time3_com = $row_time['money_time3_com'];
$money_time_edu = $row_time['money_time_edu'];
$money_time_phone = $row_time['money_time_phone'];

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

	//�ӽ������ ȸ�� �� ǥ�� 150819
	if($row['out_temp'] && $row['out_day'] <= $out_day_base) {
		$tr_class[$i] = "gray";
	} else {
		$tr_class[$i] = "white";
	}
	//�޿����� DB (�޿��ݿ�) ���
	$sql4 = " select * from pibohum_base_pay_helper where com_code='$row[com_code]' and sabun='$row[sabun]' and year = '$search_year' and month = '$search_month' and w_date != '0000-00-00' order by w_date desc, w_time desc limit 0, 1 ";
	//echo $sql4;
	$result4 = sql_query($sql4);
	$row4=mysql_fetch_array($result4);

	//�޿����� DB ȣ��
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
	$workhour_1 = $row4['w_1'];
	$workhour_2 = $row4['w_2'];
	$workhour_3 = $row4['w_3'];
	$workhour_edu = $row4['w_edu'];
	$workhour_phone = $row4['w_phone'];
	//�ð� 0 �� ��� ������ ǥ��
	if(!$workhour_1) $workhour_1 = "";
	if(!$workhour_2) $workhour_2 = "";
	if(!$workhour_3) $workhour_3 = "";
	if(!$workhour_edu) $workhour_edu = "";
	if(!$workhour_phone) $workhour_phone = "";

	//�������� -> ����������
	if($row4['annual_paid_holiday']) $annual_paid_holiday = number_format($row4['annual_paid_holiday']);
	else $annual_paid_holiday = "";

	//�ٷ��ڸ�
	$name[$i] = $row['name'];
	//���� �� �Է¿� �迭 ����, �ѱ� ��ȯ
	$name[$i] = iconv("EUC-KR", "UTF-8", $name[$i]);
	$sabun[$i] = $row['sabun'];
	$in_day[$i] = $row['in_day'];
	$jumin_no[$i] = explode('-',$row['jumin_no']);;
	$birthday[$i] = $jumin_no[$i][0];
	$position_ary[$i] = iconv("EUC-KR", "UTF-8", $position);;
	$pay_gbn_ary[$i] = iconv("EUC-KR", "UTF-8", $pay_gbn);;
	$workhour_1_ary[$i] = $workhour_1;
	$workhour_2_ary[$i] = $workhour_2;
	$workhour_3_ary[$i] = $workhour_3;
	$workhour_edu_ary[$i] = $workhour_edu;
	$workhour_phone_ary[$i] = $workhour_phone;
	$annual_paid_holiday_ary[$i] = $annual_paid_holiday;
	$money_gongje[$i] = number_format($row4['money_gongje']);
	$money_result[$i] = number_format($row4['money_result']);
	$yun[$i] = number_format($row4['yun']);
	$health[$i] = number_format($row4['health']);
	$yoyang[$i] = number_format($row4['yoyang']);
	$goyong[$i] = number_format($row4['goyong']);
	$tax_so[$i] = number_format($row4['tax_so']);
	$tax_jumin[$i] = number_format($row4['tax_jumin']);
	$minus[$i] = number_format($row4['minus']);
	$c_yun[$i] = number_format($row4['c_yun']);
	$c_health[$i] = number_format($row4['c_health']);
	$c_yoyang[$i] = number_format($row4['c_yoyang']);
	$c_goyong[$i] = number_format($row4['c_goyong']);
	$c_sanjae[$i] = number_format($row4['c_sanjae']);
}
//for�� ����

//���� ����� ���� �ð�
$now_time_file = date("Ymd_His");
//PHPExcel
include $_SERVER["DOCUMENT_ROOT"]."/PHPExcel/Classes/PHPExcel.php";
//���ø� ���� ����
$file = "excel/pay_excel_helper.xlsx";
$objReader = PHPExcel_IOFactory::createReaderForFile($file);
$objPHPExcel = new PHPExcel();
$objPHPExcel = $objReader->load($file);
//���� ���ϸ�
$file_name = $com_name."_����_".$search_year."��_".$search_month."��.xls";
//�� ����
$styleArray = array(
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array(
            'rgb' => 'F3F3F3'
        )
    )
);
//�� �Է� for��
for($i=0;$i<$total_count;$i++) {
	$k = $i + 4;
	//Add some data
	$objPHPExcel->setActiveSheetIndex(0)
							->setCellValueExplicit("A$k", $sabun[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValue("B$k", $name[$i])
							->setCellValueExplicit("C$k", $birthday[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValue("D$k", $position_ary[$i])
							->setCellValueExplicit("E$k", $workhour_1_ary[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("F$k", $workhour_2_ary[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("G$k", $annual_paid_holiday_ary[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("H$k", $yun[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("I$k", $health[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("J$k", $yoyang[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("K$k", $goyong[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("L$k", $tax_so[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("M$k", $tax_jumin[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("N$k", $minus[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("O$k", $c_yun[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("P$k", $c_health[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("Q$k", $c_yoyang[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("R$k", $c_goyong[$i], PHPExcel_Cell_DataType::TYPE_STRING)
							->setCellValueExplicit("S$k", $c_sanjae[$i], PHPExcel_Cell_DataType::TYPE_STRING);
	//�� ���� ȸ�� ó��
	if($tr_class[$i] == "gray") $objPHPExcel->setActiveSheetIndex(0)->getStyle("A$k:Z$k")->applyFromArray($styleArray);
}
//Ŀ�� �ʱ�ȭ
$objPHPExcel->setActiveSheetIndex(0)->getStyle("A3");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file_name");
header("Cache-Control: max-age=0");
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>
