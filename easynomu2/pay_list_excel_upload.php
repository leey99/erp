<?
$sub_menu = "400100";
include_once("./_common.php");

$now_time = date("Y-m-d H:i:s");
$now_time_file = date("Ymd_His");
$now_date = date("Y.m.d");

//첨부파일 경로
$upload_dir = $_SERVER["DOCUMENT_ROOT"]."/easynomu/files/pay_excel/";

//명부(지사)
$pay_excel_sql_1 = "";
//첨부서류 삭제 기능
if($pay_excel_del_1 == 1) {
	$filename = $upload_dir.$i_file_1;
	if(is_file($filename)) {
		unlink($filename);
	} else {
		echo "파일(1)이 존재하지 않습니다.";
	}
}
//첨부서류1
if($_FILES['pay_excel_1']['tmp_name']) {
	$pic_name1 = $_FILES['pay_excel_1']['name'];
	$upload_file_name = $now_time_file."_".$pic_name1;
	$upload_file = $upload_dir.$upload_file_name;
	move_uploaded_file($_FILES['pay_excel_1']['tmp_name'], $upload_file);
} else {
	$pic_name1 = "";
}
if($pic_name1) {
	$pay_excel_sql_1 = " pay_excel_1 = '$upload_file_name', ";
} else {
	if($pay_excel_del_1 == 1) $pay_excel_sql_1 = " pay_excel_1 = '', ";
}
//사업장 정보 추가2 DB
$sql_common_opt2 = "
							$pay_excel_sql_1
							wr_date = '$now_time'
";
//데이터2 유무
$sql2 = " select * from com_list_gy_opt2 where com_code='$code' ";
$result2 = sql_query($sql2);
$row2 = mysql_fetch_array($result2);
//데이터2 존재 시 update
if($row2['com_code']) {
	$sql_opt2 = " update com_list_gy_opt2 set 
				$sql_common_opt2 
				where com_code = '$code' ";
} else {
	$sql_opt2 = " insert com_list_gy_opt2 set 
				$sql_common_opt2 
				, com_code = '$code' ";
}
sql_query($sql_opt2);
//완료 후 페이지 이동
if($pay_gbn_value == 'all') $pay_list_url = "pay_list.php";
else if($pay_gbn_value == '0') $pay_list_url = "pay_month_list.php";
else $pay_list_url = "pay_time_list.php";
alert("정상적으로 급여계산 엑셀 업로드가 되었습니다.","$pay_list_url?data=excel&search_year=$search_year&search_month=$search_month&stx_dept=$stx_dept");
?>