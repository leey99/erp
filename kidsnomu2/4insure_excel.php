<?php
$sub_menu = "100200";
include_once("./_common.php");

$result1=mysql_query("select * from $g4[insure_table] where id = $id");
$row1=mysql_fetch_array($result1);
if($row1[join_date] == "0000-00-00 00:00:00") $row1[join_date] = "";
if($row1[join_date_2] == "0000-00-00 00:00:00") $row1[join_date_2] = "";
if($row1[join_date_3] == "0000-00-00 00:00:00") $row1[join_date_3] = "";
if($row1[join_date_4] == "0000-00-00 00:00:00") $row1[join_date_4] = "";
if($row1[join_date_5] == "0000-00-00 00:00:00") $row1[join_date_5] = "";
if($row1[join_time] == "0") $row1[join_time] = "";
else $row1[join_time] = intval($row1[join_time]);
if($row1[join_time_2] == "0") $row1[join_time_2] = "";
else $row1[join_time_2] = intval($row1[join_time_2]);
if($row1[join_time_3] == "0") $row1[join_time_3] = "";
else $row1[join_time_3] = intval($row1[join_time_3]);
if($row1[join_time_4] == "0") $row1[join_time_4] = "";
else $row1[join_time_4] = intval($row1[join_time_4]);
if($row1[join_time_5] == "0") $row1[join_time_5] = "";
else $row1[join_time_5] = intval($row1[join_time_5]);
if($row1[join_salary] == "0") $row1[join_salary] = "";
else $row1[join_salary] = intval($row1[join_salary]);
if($row1[join_salary_2] == "0") $row1[join_salary_2] = "";
else $row1[join_salary_2] = intval($row1[join_salary_2]);
if($row1[join_salary_3] == "0") $row1[join_salary_3] = "";
else $row1[join_salary_3] = intval($row1[join_salary_3]);
if($row1[join_salary_4] == "0") $row1[join_salary_4] = "";
else $row1[join_salary_4] = intval($row1[join_salary_4]);
if($row1[join_salary_5] == "0") $row1[join_salary_5] = "";
else $row1[join_salary_5] = intval($row1[join_salary_5]);
if($row1[quit_date] == "0000-00-00 00:00:00") $row1[quit_date] = "";
if($row1[quit_date_2] == "0000-00-00 00:00:00") $row1[quit_date_2] = "";
if($row1[quit_date_3] == "0000-00-00 00:00:00") $row1[quit_date_3] = "";
if($row1[quit_date_4] == "0000-00-00 00:00:00") $row1[quit_date_4] = "";
if($row1[quit_date_5] == "0000-00-00 00:00:00") $row1[quit_date_5] = "";
if($row1[quit_sum_now] == "0") $row1[quit_sum_now] = "";
else $row1[quit_sum_now] = number_format($row1[quit_sum_now]);
if($row1[quit_sum_now_2] == "0") $row1[quit_sum_now_2] = "";
else $row1[quit_sum_now_2] = number_format($row1[quit_sum_now_2]);
if($row1[quit_sum_now_3] == "0") $row1[quit_sum_now_3] = "";
else $row1[quit_sum_now_3] = number_format($row1[quit_sum_now_4]);
if($row1[quit_sum_now_4] == "0") $row1[quit_sum_now_4] = "";
else $row1[quit_sum_now_4] = number_format($row1[quit_sum_now_4]);
if($row1[quit_sum_now_5] == "0") $row1[quit_sum_now_5] = "";
else $row1[quit_sum_now_5] = number_format($row1[quit_sum_now_5]);
if($row1[quit_sum_now_month] == "0") $row1[quit_sum_now_month] = "";
if($row1[quit_sum_now_month_2] == "0") $row1[quit_sum_now_month_2] = "";
if($row1[quit_sum_now_month_3] == "0") $row1[quit_sum_now_month_3] = "";
if($row1[quit_sum_now_month_4] == "0") $row1[quit_sum_now_month_4] = "";
if($row1[quit_sum_now_month_5] == "0") $row1[quit_sum_now_month_5] = "";
if($row1[quit_sum_pre] == "0") $row1[quit_sum_pre] = "";
else $row1[quit_sum_pre] = number_format($row1[quit_sum_pre]);
if($row1[quit_sum_pre_2] == "0") $row1[quit_sum_pre_2] = "";
else $row1[quit_sum_pre_2] = number_format($row1[quit_sum_pre_2]);
if($row1[quit_sum_pre_3] == "0") $row1[quit_sum_pre_3] = "";
else $row1[quit_sum_pre_3] = number_format($row1[quit_sum_pre_3]);
if($row1[quit_sum_pre_4] == "0") $row1[quit_sum_pre_4] = "";
else $row1[quit_sum_pre_4] = number_format($row1[quit_sum_pre_4]);
if($row1[quit_sum_pre_5] == "0") $row1[quit_sum_pre_5] = "";
else $row1[quit_sum_pre_5] = number_format($row1[quit_sum_pre_5]);
if($row1[quit_sum_pre_month] == "0") $row1[quit_sum_pre_month] = "";
if($row1[quit_sum_pre_month_2] == "0") $row1[quit_sum_pre_month_2] = "";
if($row1[quit_sum_pre_month_3] == "0") $row1[quit_sum_pre_month_3] = "";
if($row1[quit_sum_pre_month_4] == "0") $row1[quit_sum_pre_month_4] = "";
if($row1[quit_sum_pre_month_5] == "0") $row1[quit_sum_pre_month_5] = "";
if($row1[quit_3month] == "0") $row1[quit_3month] = "";
else $row1[quit_3month] = number_format($row1[quit_3month]);
if($row1[quit_3month_2] == "0") $row1[quit_3month_2] = "";
else $row1[quit_3month_2] = number_format($row1[quit_3month_2]);
if($row1[quit_3month_3] == "0") $row1[quit_3month_3] = "";
else $row1[quit_3month_3] = number_format($row1[quit_3month_3]);
if($row1[quit_3month_4] == "0") $row1[quit_3month_4] = "";
else $row1[quit_3month_4] = number_format($row1[quit_3month_4]);
if($row1[quit_3month_5] == "0") $row1[quit_3month_5] = "";
else $row1[quit_3month_5] = number_format($row1[quit_3month_5]);

if($row1[join_name] == "") {
	$register_kind[0] = "";
} else {
	$register_kind[0] = 1;
}
if($row1[join_name_2] == "") {
	$register_kind[1] = "";
} else {
	$register_kind[1] = 1;
}
if($row1[join_name_3] == "") {
	$register_kind[2] = "";
} else {
	$register_kind[2] = 1;
}
if($row1[join_name_4] == "") {
	$register_kind[3] = "";
} else {
	$register_kind[3] = 1;
}
if($row1[join_name_5] == "") {
	$register_kind[4] = "";
} else {
	$register_kind[4] = 1;
}

$cell = array("성명","주민번호","고용형태","전화번호","최종입사일","퇴사일(계약종료일)","우편번호","주소","고용_취득일","학력","월평균보수","근로시간","직종코드","신고구분","고용취득신고일","산재_취득일","산재_특수직종","산재취득신고일","국민_취득일","국민_취득부호","국민_임금","국민_특수직종","국민_취득납부여부","건강_취득일","건강_취득부호","건강_임금","건강_요양보험료경감여부");
//             0      1          2          3          4            5                    6          7      8             9      10           11         12         13         14               15            16              17               18            19              20          21              22                  23            24              25          26                    
/**
 * MS-Excel stream handler
 * Excel download example
 * @author      Ignatius Teo            <ignatius@act28.com>
 * @copyright   (C)2004 act28.com       <http://act28.com>
 * @date        21 Oct 2004
*/

$assoc = array(
array($cell[0] => $row1[join_name],  $cell[1] => $row1[join_ssnb],  $cell[2] => "",$cell[3] => "",$cell[4] => $row1[join_date],  $cell[5] => "",$cell[6] => "",$cell[7] => "",$cell[8] => "",$cell[9] => "",$cell[10] => $row1[join_salary],  $cell[11] => $row1[join_time],  $cell[12] => $row1[join_jikjong_code],  $cell[13] => $register_kind[0],$cell[14] => "",$cell[15] => "",$cell[16] => "",$cell[17] => "",$cell[18] => "",$cell[19] => "",$cell[20] => "",$cell[21] => "",$cell[22] => "",$cell[23] => "",$cell[24] => "",$cell[25] => "",$cell[26] => ""),
array($cell[0] => $row1[join_name_2],$cell[1] => $row1[join_ssnb_2],$cell[2] => "",$cell[3] => "",$cell[4] => $row1[join_date_2],$cell[5] => "",$cell[6] => "",$cell[7] => "",$cell[8] => "",$cell[9] => "",$cell[10] => $row1[join_salary_2],$cell[11] => $row1[join_time_2],$cell[12] => $row1[join_jikjong_code_2],$cell[13] => $register_kind[1],$cell[14] => "",$cell[15] => "",$cell[16] => "",$cell[17] => "",$cell[18] => "",$cell[19] => "",$cell[20] => "",$cell[21] => "",$cell[22] => "",$cell[23] => "",$cell[24] => "",$cell[25] => "",$cell[26] => ""),
array($cell[0] => $row1[join_name_3],$cell[1] => $row1[join_ssnb_3],$cell[2] => "",$cell[3] => "",$cell[4] => $row1[join_date_3],$cell[5] => "",$cell[6] => "",$cell[7] => "",$cell[8] => "",$cell[9] => "",$cell[10] => $row1[join_salary_3],$cell[11] => $row1[join_time_3],$cell[12] => $row1[join_jikjong_code_3],$cell[13] => $register_kind[2],$cell[14] => "",$cell[15] => "",$cell[16] => "",$cell[17] => "",$cell[18] => "",$cell[19] => "",$cell[20] => "",$cell[21] => "",$cell[22] => "",$cell[23] => "",$cell[24] => "",$cell[25] => "",$cell[26] => ""),
array($cell[0] => $row1[join_name_4],$cell[1] => $row1[join_ssnb_4],$cell[2] => "",$cell[3] => "",$cell[4] => $row1[join_date_4],$cell[5] => "",$cell[6] => "",$cell[7] => "",$cell[8] => "",$cell[9] => "",$cell[10] => $row1[join_salary_4],$cell[11] => $row1[join_time_4],$cell[12] => $row1[join_jikjong_code_4],$cell[13] => $register_kind[3],$cell[14] => "",$cell[15] => "",$cell[16] => "",$cell[17] => "",$cell[18] => "",$cell[19] => "",$cell[20] => "",$cell[21] => "",$cell[22] => "",$cell[23] => "",$cell[24] => "",$cell[25] => "",$cell[26] => ""),
array($cell[0] => $row1[join_name_5],$cell[1] => $row1[join_ssnb_5],$cell[2] => "",$cell[3] => "",$cell[4] => $row1[join_date_5],$cell[5] => "",$cell[6] => "",$cell[7] => "",$cell[8] => "",$cell[9] => "",$cell[10] => $row1[join_salary_5],$cell[11] => $row1[join_time_5],$cell[12] => $row1[join_jikjong_code_5],$cell[13] => $register_kind[4],$cell[14] => "",$cell[15] => "",$cell[16] => "",$cell[17] => "",$cell[18] => "",$cell[19] => "",$cell[20] => "",$cell[21] => "",$cell[22] => "",$cell[23] => "",$cell[24] => "",$cell[25] => "",$cell[26] => "")
);


$file_name = $row1[comp_name]."_취득.xls";
header("Pragma:");
header("Cache-Control:");
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file_name");
header("Content-Description: PHP5 Generated Data");
?>
<table width='1200' border='1' cellspacing=1 cellpadding=3 bgcolor="#5B8398">
			<tr bgcolor="65CBFF" align=center>
<?
for($i=0; $i<count($cell); $i++) {
?>
				<td align="center"><?=$cell[$i]?></td>
<?
}
?>
			</tr>	
			<tr bgcolor="#FFFFFF" align=center>
				<td align="center"><?=$row1[join_name]?></td>
				<td align="center"><?=$row1[join_ssnb]?></td>
				<td align="center"></td>
				<td align="center"></td>
				<td align="center"><?=substr($row1[join_date],0,11)?></td>
				<td align="center"></td>
				<td align="center"></td>
				<td align="center"></td>
				<td align="center"></td>
				<td align="center"></td>
				<td align="center"><?=$row1[join_salary]?></td>
				<td align="center"><?=$row1[join_time]?></td>
				<td align="center"><?=$row1[join_jikjong_code]?></td>
				<td align="center"><?=$register_kind[0]?></td>
				<td align="center"></td>
				<td align="center"></td>
				<td align="center"></td>
				<td align="center"></td>
				<td align="center"></td>
				<td align="center"></td>
				<td align="center"></td>
				<td align="center"></td>
				<td align="center"></td>
				<td align="center"></td>
				<td align="center"></td>
				<td align="center"></td>
				<td align="center"></td>
			</tr>
<?
for($i=2; $i<=5; $i++) {
	$k = $i - 1;
?>
			<tr bgcolor="#FFFFFF" align=center>
				<td align="center"><?=$row1["join_name_".$i]?></td>
				<td align="center"><?=$row1["join_ssnb_".$i]?></td>
				<td align="center"></td>
				<td align="center"></td>
				<td align="center"><?=substr($row1["join_date_".$i],0,11)?></td>
				<td align="center"></td>
				<td align="center"></td>
				<td align="center"></td>
				<td align="center"></td>
				<td align="center"></td>
				<td align="center"><?=$row1["join_salary_".$i]?></td>
				<td align="center"><?=$row1["join_time_".$i]?></td>
				<td align="center"><?=$row1["join_jikjong_code_".$i]?></td>
				<td align="center"><?=$register_kind[$k]?></td>
				<td align="center"></td>
				<td align="center"></td>
				<td align="center"></td>
				<td align="center"></td>
				<td align="center"></td>
				<td align="center"></td>
				<td align="center"></td>
				<td align="center"></td>
				<td align="center"></td>
				<td align="center"></td>
				<td align="center"></td>
				<td align="center"></td>
				<td align="center"></td>
			</tr>
<?
}
?>
</table>
<?
exit;
?>

