<?
$sub_menu = "1900400";
include_once("./_common.php");
echo "check_ok_update";
if(!$id) exit;
echo $id."<br />".$manage_cust_numb."<br />".$manage_cust_name;

//담당매니저 설정
$sql_common = " manage_cust_numb = '$manage_cust_numb', manage_cust_name = '$manage_cust_name' ";
$sql = " update com_list_gy_opt set $sql_common where com_code = '$id' ";
//echo $sql;
sql_query($sql);
?>
