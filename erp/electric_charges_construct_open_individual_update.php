<?
$sub_menu = "1900300";
include_once("./_common.php");
echo "electric_charges_construct_open_individual_update.php";
if(!$id) exit;
echo $id;

$sql_common = " electric_charges_construct_open".$no." = '$check_ok' ";

$sql = " update com_list_gy set $sql_common where com_code = '$id' ";
//echo $sql;
sql_query($sql);

alert("���������� ���翭�� �Ǿ����ϴ�.","electric_charges_construct_open_individual_update.php");
?>
