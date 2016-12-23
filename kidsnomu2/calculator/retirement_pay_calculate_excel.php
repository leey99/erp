<?
$sub_menu = "300100";
include_once("./_common.php");

//파일 저장용 현재 시간
$now_time_file = date("Ymd_His");
$now_time = date("Y-m-d");

//PHPExcel
include $_SERVER["DOCUMENT_ROOT"]."/PHPExcel/Classes/PHPExcel.php";
//템플릿 엑셀 파일
$file = "retirement_pay_calculate_excel.xlsx";
$objReader = PHPExcel_IOFactory::createReaderForFile($file);
$objPHPExcel = new PHPExcel();
$objPHPExcel = $objReader->load($file);
//엑셀 파일명
$file_name = "퇴직금_영수증_".$com_name."_".$name.".xls";

//엑셀 셀 입력용 배열 설정, 한글 변환
$com_name = iconv("EUC-KR", "UTF-8", $com_name);
$boss_name = iconv("EUC-KR", "UTF-8", $boss_name);
$name = iconv("EUC-KR", "UTF-8", $name);

//입사일
if($smon < 10) $smon = "0".$smon;
if($sday < 10) $sday = "0".$sday;
$in_day = $syear."-".$smon."-".$sday;
//xhl사일
if($emon < 10) $emon = "0".$emon;
if($eday < 10) $eday = "0".$eday;
$out_day = $eyear."-".$emon."-".$eday;

//Add some data
$objPHPExcel->setActiveSheetIndex(0)
						->setCellValueExplicit("F6", $biz_no, PHPExcel_Cell_DataType::TYPE_STRING)
						->setCellValue("F7", $com_name)
						->setCellValue("F8", $boss_name)
						->setCellValue("F13", $name)
						->setCellValueExplicit("F14", $jumin_no, PHPExcel_Cell_DataType::TYPE_STRING)
						->setCellValueExplicit("C20", $in_day, PHPExcel_Cell_DataType::TYPE_STRING)
						->setCellValueExplicit("D20", $in_day, PHPExcel_Cell_DataType::TYPE_STRING)
						->setCellValueExplicit("E20", $out_day, PHPExcel_Cell_DataType::TYPE_STRING)
						->setCellValueExplicit("F20", $now_time, PHPExcel_Cell_DataType::TYPE_STRING)
						->setCellValueExplicit("C24", $retirePay, PHPExcel_Cell_DataType::TYPE_STRING);

//커서 초기화
//$objPHPExcel->setActiveSheetIndex(0)->getStyle("A3");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file_name");
header("Cache-Control: max-age=0");
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>
