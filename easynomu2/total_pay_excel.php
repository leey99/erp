<?php
$sub_menu = "300100";
include_once("./_common.php");

$result1=mysql_query("select * from total_pay where id = $id");
$row1=mysql_fetch_array($result1);
$comp_bznb = $row1[t_no];
$comp_name = $row1[comp_name];
$boss_name = $row1[boss_name];
$adr_zip = explode("-",$row1[adr_zip]);
$adr_zip1 = $adr_zip[0];
$adr_zip2 = $adr_zip[1];
$adr_adr1 = $row1[adr_adr1];
$adr_adr2 = $row1[adr_adr2];
$sj_upjong_code = $row1[sj_upjong_code];
$sj_upjong = $row1[sj_upjong];
$sj_percent = $row1[sj_percent];
$comp_email = $row1[comp_email];
$comp_tel = $row1[comp_tel];
$comp_fax = $row1[comp_fax];
//근로자 신고건수
$result2=mysql_query("select count(*) as cnt from total_pay_opt where mid = $id");
$row2=mysql_fetch_array($result2);
$worker_count = $row2[cnt];



$cell = array("성명","주민(외국인)등록번호","부과부호구분","(산재)취득일","(산재)상실일","(산재)연간보수총액","(산재)월평균보수","(고용)취득일","(고용)상실일","(고용)연간보수총액(1~6월)","(고용)연간보수총액(7~12월)","(고용)월평균보수","근무지우편번호","오류메시지");
//             0      1                      2              3              4              5                    6                  7              8              9                           10                           11                 12               13
/**
 * MS-Excel stream handler
 * Excel download example
 * @author      Ignatius Teo            <ignatius@act28.com>
 * @copyright   (C)2004 act28.com       <http://act28.com>
 * @date        21 Oct 2004
*/
/*
$assoc = array(
array($cell[0] => $row1[join_name],  $cell[1] => $row1[join_ssnb],  $cell[2] => "",$cell[3] => "",$cell[4] => $row1[join_date],  $cell[5] => "",$cell[6] => "",$cell[7] => "",$cell[8] => "",$cell[9] => "",$cell[10] => $row1[join_salary],  $cell[11] => $row1[join_time],  $cell[12] => $row1[join_jikjong_code],  $cell[13] => $register_kind[0],$cell[14] => "",$cell[15] => "",$cell[16] => "",$cell[17] => "",$cell[18] => "",$cell[19] => "",$cell[20] => "",$cell[21] => "",$cell[22] => "",$cell[23] => "",$cell[24] => "",$cell[25] => "",$cell[26] => ""),
array($cell[0] => $row1[join_name_2],$cell[1] => $row1[join_ssnb_2],$cell[2] => "",$cell[3] => "",$cell[4] => $row1[join_date_2],$cell[5] => "",$cell[6] => "",$cell[7] => "",$cell[8] => "",$cell[9] => "",$cell[10] => $row1[join_salary_2],$cell[11] => $row1[join_time_2],$cell[12] => $row1[join_jikjong_code_2],$cell[13] => $register_kind[1],$cell[14] => "",$cell[15] => "",$cell[16] => "",$cell[17] => "",$cell[18] => "",$cell[19] => "",$cell[20] => "",$cell[21] => "",$cell[22] => "",$cell[23] => "",$cell[24] => "",$cell[25] => "",$cell[26] => ""),
array($cell[0] => $row1[join_name_3],$cell[1] => $row1[join_ssnb_3],$cell[2] => "",$cell[3] => "",$cell[4] => $row1[join_date_3],$cell[5] => "",$cell[6] => "",$cell[7] => "",$cell[8] => "",$cell[9] => "",$cell[10] => $row1[join_salary_3],$cell[11] => $row1[join_time_3],$cell[12] => $row1[join_jikjong_code_3],$cell[13] => $register_kind[2],$cell[14] => "",$cell[15] => "",$cell[16] => "",$cell[17] => "",$cell[18] => "",$cell[19] => "",$cell[20] => "",$cell[21] => "",$cell[22] => "",$cell[23] => "",$cell[24] => "",$cell[25] => "",$cell[26] => ""),
array($cell[0] => $row1[join_name_4],$cell[1] => $row1[join_ssnb_4],$cell[2] => "",$cell[3] => "",$cell[4] => $row1[join_date_4],$cell[5] => "",$cell[6] => "",$cell[7] => "",$cell[8] => "",$cell[9] => "",$cell[10] => $row1[join_salary_4],$cell[11] => $row1[join_time_4],$cell[12] => $row1[join_jikjong_code_4],$cell[13] => $register_kind[3],$cell[14] => "",$cell[15] => "",$cell[16] => "",$cell[17] => "",$cell[18] => "",$cell[19] => "",$cell[20] => "",$cell[21] => "",$cell[22] => "",$cell[23] => "",$cell[24] => "",$cell[25] => "",$cell[26] => ""),
array($cell[0] => $row1[join_name_5],$cell[1] => $row1[join_ssnb_5],$cell[2] => "",$cell[3] => "",$cell[4] => $row1[join_date_5],$cell[5] => "",$cell[6] => "",$cell[7] => "",$cell[8] => "",$cell[9] => "",$cell[10] => $row1[join_salary_5],$cell[11] => $row1[join_time_5],$cell[12] => $row1[join_jikjong_code_5],$cell[13] => $register_kind[4],$cell[14] => "",$cell[15] => "",$cell[16] => "",$cell[17] => "",$cell[18] => "",$cell[19] => "",$cell[20] => "",$cell[21] => "",$cell[22] => "",$cell[23] => "",$cell[24] => "",$cell[25] => "",$cell[26] => "")
);
*/

$file_name = "이지노무 ".$row1[t_no].".xls";
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
$result_opt_cnt = mysql_query("select count(*) as cnt from total_pay_opt where mid = $id");
$row_opt_cnt = mysql_fetch_array($result_opt_cnt);
$cnt = $row_opt_cnt[cnt];
//echo $cnt;
$result_opt = mysql_query("select * from total_pay_opt where mid = $id order by id asc");
for($i=1; $row_opt=sql_fetch_array($result_opt); $i++) {
	$name[$i] = $row_opt[name1];
	$ssnb[$i] = $row_opt[ssnb1];
	$bohum_code[$i] = $row_opt[bohum_code1];
	$sj_sdate[$i] = $row_opt[sj_sdate1];
	$sj_edate[$i] = $row_opt[sj_edate1];
	$sj_ypay[$i] = number_format($row_opt[sj_ypay1]);
	$sj_mpay[$i] = number_format($row_opt[sj_mpay1]);
	$gy_sdate[$i] = $row_opt[gy_sdate1];
	$gy_edate[$i] = $row_opt[gy_edate1];
	$gy_ypay[$i] = number_format($row_opt[gy_ypay1]);
	$gy_ypay2[$i] = number_format($row_opt[gy_ypay2]);
	$gy_mpay[$i] = number_format($row_opt[gy_mpay1]);
	$gy_post[$i] = $row_opt[gy_post1];
	$gg_sdate[$i] = $row_opt[gg_sdate1];
	$gg_ypay[$i] = number_format($row_opt[gg_ypay1]);
	$gg_month[$i] = number_format($row_opt[gg_month1]);
}
$temp_sj_ypay = number_format($row1[temp_sj_ypay]);
$temp_gy_ypay = number_format($row1[temp_gy_ypay]);
$temp_gy_ypay2 = number_format($row1[temp_gy_ypay2]);
$etc_sj_ypay = number_format($row1[etc_sj_ypay]);
$etc2_sj_ypay = number_format($row1[etc2_sj_ypay]);
$sj_ysum = number_format($row1[sj_ysum]);
$gy_ysum = number_format($row1[gy_ysum]);
$gy_ysum2 = number_format($row1[gy_ysum2]);
$temp_gg_ypay = number_format($row1[temp_gg_ypay]);
$etc_gg_ypay = number_format($row1[etc_gg_ypay]);
$etc2_gg_ypay = number_format($row1[etc2_gg_ypay]);
$gg_ysum = number_format($row1[gg_ysum]);
for($i=1;$i<=$cnt;$i++) {
	if($sj_sdate[$i] == "") {
		//산재 연간보수총액 유무
	} else {
?>
			<tr bgcolor="#FFFFFF" align=center>
				<td align="center"><?=$name[$i]?></td>
				<td align="center"><?=$ssnb[$i]?></td>
				<td align="center"><?=$bohum_code[$i]?></td>
				<td align="center"><?=$sj_sdate[$i]?></td>
				<td align="center"><?=$sj_edate[$i]?></td>
				<td align="center"><?=$sj_ypay[$i]?></td>
				<td align="center"><?=$sj_mpay[$i]?></td>
				<td align="center"><?=$gy_sdate[$i]?></td>
				<td align="center"><?=$gy_edate[$i]?></td>
				<td align="center"><?=$gy_ypay[$i]?></td>
				<td align="center"><?=$gy_ypay2[$i]?></td>
				<td align="center"><?=$gy_mpay[$i]?></td>
				<td align="center"></td>
				<td align="center"></td>
			</tr>
<?
	}
}
?>
</table>
<?
exit;
?>

