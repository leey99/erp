<?
$sub_menu = "1900300";
include_once("./_common.php");
echo "electric_charges_construct_open_update.php";
if(!$id) exit;
echo $id;
$now_time = date("Y-m-d H:i:s");
$now_date = date("Y.m.d");

//담당자 설정
$mb_id = $member['mb_id'];
$mb_nick = $member['mb_nick'];
$sql_common = " electric_charges_construct_open = '$check_ok', electric_charges_user = '$mb_nick', electric_charges_editdt = '$now_time' ";

$sql = " update com_list_gy set $sql_common where com_code = '$id' ";
//echo $sql;
sql_query($sql);

//사업장 기본정보 호출
$sql_com = "select * from com_list_gy where com_code = '$id' ";
$row_com = sql_fetch($sql_com);
//이력 DB 저장
$electric_charges_process = $row_com['electric_charges_process'];
$electric_charges_no = $row_com['electric_charges_no'];
$electric_charges_watt = $row_com['electric_charges_watt'];
$electric_charges_year_fee = $row_com['electric_charges_year_fee'];
$electric_charges_payments = $row_com['electric_charges_payments'];
$electric_charges_reduce = $row_com['electric_charges_reduce'];
$electric_charges_etc = $row_com['electric_charges_etc'];
$electric_charges_construct_open = $row_com['electric_charges_construct_open'];
$sql_samu_history = " insert electric_charges_history set 
		com_code = '$id', w_date='$now_time', w_user = '$mb_id', w_name = '$mb_nick', electric_charges_process = '$electric_charges_process', 
		electric_charges_no = '$electric_charges_no', electric_charges_watt = '$electric_charges_watt', electric_charges_year_fee = '$electric_charges_year_fee', 
		electric_charges_payments = '$electric_charges_payments', electric_charges_reduce = '$electric_charges_reduce', 
		electric_charges_etc = '$electric_charges_etc', electric_charges_construct_open = '$electric_charges_construct_open'
";
sql_query($sql_samu_history);

alert("정상적으로 지사열람 되었습니다.","electric_charges_construct_open_update.php");
?>
