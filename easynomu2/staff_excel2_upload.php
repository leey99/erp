<?
$sub_menu = "400100";
include_once("./_common.php");

$now_time = date("Y-m-d H:i:s");
$now_time_file = date("Ymd_His");
$now_date = date("Y.m.d");

//첨부파일 경로
$upload_dir = $_SERVER["DOCUMENT_ROOT"]."/easynomu/files/staff_excel/";

//명부(지사)
$staff_excel_file_1 = "";

//첨부서류1
if($_FILES['staff_excel_1']['tmp_name']) {
	$pic_name1 = $_FILES['staff_excel_1']['name'];
	$upload_file_name = $now_time_file."_".$pic_name1;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['staff_excel_1']['tmp_name'], $upload_file);
} else {
	$pic_name1 = "";
}
if($pic_name1) {
	$staff_excel_file_1 = $upload_file_name;
}

//직접입력
$isgy = 0;
$issj = 0;
$iskm = 0;
$isgg = 0;
$isjy = 0;

$pay_gbn = 0;
$input_type = 3;
$work_gbn = "A";
$workday_week = 5;
$gubun = 0;
$fg_div = 0;
$work_form = 1;
$workhour_day_d = 8;
$workhour_day_w = 40;
$check_worktime_w_yn = "N";
$check_worktime_yn = "Y";
$check_money_min_yn = "Y";
$check_money_b_yn = "N";

//엑셀 파일 존재 여부
if($staff_excel_file_1) $excel = $staff_excel_file_1;
//엑셀 리더
include $_SERVER["DOCUMENT_ROOT"]."/PHPExcel/Classes/PHPExcel.php";
if($excel) {

	//사번 자동 생성
	$sql_max = "select max(sabun) from pibohum_base where com_code = '$code' ";
	$result_max = sql_query($sql_max);
	$row_max = mysql_fetch_array($result_max);
	$id = $row_max[0]+1;
	if(strlen($id) == 3) $id = "0".$id;
	else if(strlen($id) == 2) $id = "00".$id;
	else if(strlen($id) == 1) $id = "000".$id;

	$UpFileExt = "xlsx";
	$objPHPExcel = new PHPExcel();
	$upload_path = $_SERVER["DOCUMENT_ROOT"]."/easynomu/files/staff_excel";
	$upfile_path = $upload_path."/".$excel;
	//echo $upfile_path;
	if(file_exists($upfile_path)) {
		$inputFileType = 'Excel2007';
		if($UpFileExt == "xls") {
			$inputFileType = 'Excel5';	
		}
		//echo $inputFileType;
		$objReader = PHPExcel_IOFactory::createReaderForFile($upfile_path);
		$objPHPExcel = $objReader->load($upfile_path);
		$objPHPExcel ->setActiveSheetIndex(0);
		$objWorksheet = $objPHPExcel->getActiveSheet(); 
		$maxRow = $objWorksheet->getHighestRow(); 
		//echo $maxRow;
		$m = 0;
		$count_page = 0;
		//연번
		$start_line = 6;
		//echo $excel_count;
		//echo $excel_type;
		$p = 0;
		for ($i = 0; $i < $maxRow; $i++) {
			$k = $i + $start_line;
			$id = $objWorksheet->getCell('A' . $k)->getValue();
			//이지노무 사번 코드 형식
			if(strlen($id) == 3) $id = "0".$id;
			else if(strlen($id) == 2) $id = "00".$id;
			else if(strlen($id) == 1) $id = "000".$id;
			//입사일, 퇴사일
			$emp_sdate = $objWorksheet->getCell('C' . $k)->getValue();
			$emp_edate = $objWorksheet->getCell('D' . $k)->getValue();
			$excel_name[$i] = $objWorksheet->getCell('E' . $k)->getValue();
			$cust_ssnb = $objWorksheet->getCell('F' . $k)->getValue();
			$position = $objWorksheet->getCell('I' . $k)->getValue();
			$family_count = trim($objWorksheet->getCell('K' . $k)->getValue()); 
			$dept = $objWorksheet->getCell('G' . $k)->getValue();
			//근로시간
			$workhour_day = $objWorksheet->getCell('AB' . $k)->getValue();
			$workhour_ext = $objWorksheet->getCell('AC' . $k)->getValue();
			$workhour_night = $objWorksheet->getCell('AD' . $k)->getValue();
			$workhour_hday = $objWorksheet->getCell('AE' . $k)->getValue();
			//수당
			$money_hour_ds = $objWorksheet->getCell('AI' . $k)->getValue();
			$money_day_base = $objWorksheet->getCell('AJ' . $k)->getValue();
			$money_hour_ms = $objWorksheet->getCell('AK' . $k)->getValue();
			//기본급
			//echo $money_hour_ms;
			//exit;
			$b1 = $objWorksheet->getCell('AL' . $k)->getValue();
			$b2 = $objWorksheet->getCell('AM' . $k)->getValue();
			$b3 = $objWorksheet->getCell('AN' . $k)->getValue();
			$b4 = $objWorksheet->getCell('AO' . $k)->getValue();
			$e1 = $objWorksheet->getCell('BA' . $k)->getValue();
			$e2 = $objWorksheet->getCell('BB' . $k)->getValue();
			$e3 = $objWorksheet->getCell('BC' . $k)->getValue();
			$e4 = $objWorksheet->getCell('BE' . $k)->getValue();
			$money_month_base = $objWorksheet->getCell('BF' . $k)->getValue();
			//한글 인코딩
			$emp_name = iconv("UTF-8", "EUC-KR", $excel_name[$i]);
			//데이터가 있을 경우
			if($id) {
				//사원정보
				$sql_common = " name = '$emp_name',
					jumin_no = '$cust_ssnb',
					in_day = '$emp_sdate',
					out_day = '$emp_edate',

					layoff_sdate = '$layoff_sdate',
					layoff_edate = '$layoff_edate',

					apply_gy = '$isgy',
					apply_sj = '$issj',
					apply_km = '$iskm',
					apply_gg = '$isgg',
					apply_jy = '$isjy',

					gubun = '$gubun',
					fg_div = '$fg_div',
					work_form = '$work_form'
				";
				$sql = " insert pibohum_base set 
							$sql_common 
							, com_code = '$code', sabun='$id' ";
				//echo $sql;
				//exit;
				sql_query($sql);
				//추가정보
				$sql_common2 = " pay_gbn = '$pay_gbn',
					work_gbn = '$work_gbn',
					workday_week = '$workday_week',

					dept = '$dept',
					position = '$position',
					family_cnt = '$family_count'

				";
				$sql2 = " insert pibohum_base_opt set $sql_common2 , com_code = '$code', sabun='$id' ";
				sql_query($sql2);
				//급여정보
				$sql_common3 = " input_type = '$input_type', 
					workhour_day_d = '$workhour_day_d', workhour_day_w = '$workhour_day_w', workhour_ext_w = '$workhour_ext_w',
					check_worktime_w_yn = '$check_worktime_w_yn', check_worktime_yn = '$check_worktime_yn', check_money_min_yn = '$check_money_min_yn', 
					check_money_b_yn = '$check_money_b_yn',
					workhour_day = '$workhour_day', workhour_ext = '$workhour_ext', workhour_hday = '$workhour_hday', workhour_night = '$workhour_night', 
					money_month_base = '$money_month_base', money_hour_ms = '$money_hour_ms', 
					money_hour_ds = '$money_hour_ds', money_hour_ts = '$money_hour_ds', money_min_base = '$money_hour_ds', 
					money_b1 = '$b1', money_b2 = '$b2', money_b3 = '$b3', money_b4 = '$b4',
					money_e1 = '$e1', money_e2 = '$e2', money_e3 = '$e3', money_e4 = '$e4'
				";
				$sql3 = " insert pibohum_base_opt2 set $sql_common3 , com_code = '$code', sabun='$id', wr_date = '$now_time' ";
				sql_query($sql3);
			}
		}
	}
}
//완료 후 페이지 이동
alert("정상적으로 엑셀서식 업로드가 되었습니다.","staff_list.php");
?>