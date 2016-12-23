<?
//$mode = "popup";
$sub_menu = "100200";
include_once("./_common.php");

//auth_check($auth[$sub_menu], "w");
//mysql_query("set names euckr");

$now_time = date("Y-m-d H:i:s");

//사업장소재지 우편번호
$adr_zip = $adr_zip1."-".$adr_zip2;

//일용근로자 및 그밖의 근로자수(명) 1~12월
$etc_count = $etc_count1;
for($i=2;$i<13;$i++) {
	$etc_count .= ",".$_POST['etc_count'.$i];
}
//노조전임자 보수총액 신고
for($i=1;$i<6;$i++) {
	$u_name = $_POST['u_name'.$i];
	$u_ssnb = $_POST['u_ssnb'.$i];
	$u_bohum_code = $_POST['u_bohum_code'.$i];
	$u_sj_sdate = $_POST['u_sj_sdate'.$i];
	$u_sj_edate = $_POST['u_sj_edate'.$i];
	$u_sj_ypay = $_POST['u_sj_ypay'.$i];
	$u_sj_mpay = $_POST['u_sj_mpay'.$i];
	$u_gy_sdate = $_POST['u_gy_sdate'.$i];
	$u_gy_edate = $_POST['u_gy_edate'.$i];
	$u_loss_pay = $_POST['u_loss_pay'.$i];
	$u_hire_pay = $_POST['u_hire_pay'.$i];
	$u_gy_mpay = $_POST['u_gy_mpay'.$i];
	// 천단위 콤마 제거 DB 저장
	$u_sj_ypay = ereg_replace(',', '', $u_sj_ypay);
	$u_sj_mpay = ereg_replace(',', '', $u_sj_mpay);
	$u_loss_pay = ereg_replace(',', '', $u_loss_pay);
	$u_hire_pay = ereg_replace(',', '', $u_hire_pay);
	$u_gy_mpay = ereg_replace(',', '', $u_gy_mpay);

	$u_common .= " u_name".$i." = '$u_name',
			u_ssnb".$i." = '$u_ssnb',
			u_bohum_code".$i." = '$u_bohum_code',
			u_sj_sdate".$i." ='$u_sj_sdate',
			u_sj_edate".$i." ='$u_sj_edate',
			u_sj_ypay".$i." ='$u_sj_ypay',
			u_sj_mpay".$i." ='$u_sj_mpay',
			u_gy_sdate".$i." ='$u_gy_sdate',
			u_gy_edate".$i." ='$u_gy_edate',
			u_loss_pay".$i." ='$u_loss_pay',
			u_hire_pay".$i." ='$u_hire_pay',
			u_gy_mpay".$i." ='$u_gy_mpay', 
	";
}
// 천단위 콤마 제거 DB 저장
$temp_sj_ypay = ereg_replace(',', '', $temp_sj_ypay);
$temp_gy_ypay = ereg_replace(',', '', $temp_gy_ypay);
$temp_gy_ypay2 = ereg_replace(',', '', $temp_gy_ypay2);
$etc_sj_ypay = ereg_replace(',', '', $etc_sj_ypay);
$etc2_sj_ypay = ereg_replace(',', '', $etc2_sj_ypay);
$sj_ysum = ereg_replace(',', '', $sj_ysum);
$gy_ysum = ereg_replace(',', '', $gy_ysum);
$gy_ysum2 = ereg_replace(',', '', $gy_ysum2);
$change_ypay = ereg_replace(',', '', $change_ypay);
$now_ypay = ereg_replace(',', '', $now_ypay);
$temp_gg_ypay = ereg_replace(',', '', $temp_gg_ypay);
$etc_gg_ypay = ereg_replace(',', '', $etc_gg_ypay);
$etc2_gg_ypay = ereg_replace(',', '', $etc2_gg_ypay);
$gg_ysum = ereg_replace(',', '', $gg_ysum);

$sql_common = " comp_bznb = '$comp_bznb',
						comp_name = '$comp_name',
						boss_name = '$boss_name',
						adr_zip = '$adr_zip',
						adr_adr1 = '$adr_adr1',
						adr_adr2 = '$adr_adr2',

						sj_upjong_code = '$sj_upjong_code',
						sj_upjong = '$sj_upjong',
						sj_percent = '$sj_percent',
						comp_email = '$comp_email',
						comp_tel = '$comp_tel',
						comp_fax = '$comp_fax',

						temp_sj_ypay = '$temp_sj_ypay',
						temp_gy_ypay = '$temp_gy_ypay',
						temp_gy_ypay2 = '$temp_gy_ypay2',
						etc_sj_ypay = '$etc_sj_ypay',
						etc2_sj_ypay = '$etc2_sj_ypay',
						sj_ysum = '$sj_ysum',
						gy_ysum = '$gy_ysum',
						gy_ysum2 = '$gy_ysum2',

						temp_gg_ypay = '$temp_gg_ypay',
						etc_gg_ypay = '$etc_gg_ypay',
						etc2_gg_ypay = '$etc2_gg_ypay',
						gg_ysum = '$gg_ysum',
						chk_temp_etc = '$chk_temp_etc',

						change_sdate = '$change_sdate',
						change_edate = '$change_edate',
						now_sdate = '$now_sdate',
						now_edate = '$now_edate',
						change_ypay = '$change_ypay',
						now_ypay = '$now_ypay',
						etc_count = '$etc_count',

						$u_common

						year = $year,
						wr_datetime = '$now_time'
";

if($w == 'u') {
	$sql = " update total_pay set $sql_common where id = '$id' ";
	sql_query($sql);
	$sql_opt = " delete from total_pay_opt where mid = $id ";
	sql_query($sql_opt);
} else {
	$sql = " insert total_pay set $sql_common , t_no = '$comp_bznb-0' ";
	sql_query($sql);
	$id = mysql_insert_id();
}

for($i=1; $i<=$worker_count; $i++) {
	$name_array[$i] = $_POST['name_'.$i];
	$ssnb_array[$i] = $_POST['ssnb_'.$i];
	$bohum_code_array[$i] = $_POST['bohum_code_'.$i];
	$sj_sdate_array[$i] = $_POST['sj_sdate_'.$i];
	$sj_edate_array[$i] = $_POST['sj_edate_'.$i];
	$sj_ypay_array[$i] = $_POST['sj_ypay_'.$i];
	$sj_mpay_array[$i] = $_POST['sj_mpay_'.$i];
	$gy_sdate_array[$i] = $_POST['gy_sdate_'.$i];
	$gy_edate_array[$i] = $_POST['gy_edate_'.$i];
	$gy_ypay_array[$i] = $_POST['gy_ypay_'.$i];
	$gy_ypay_array2[$i] = $_POST['gy_ypay2_'.$i];
	$gy_mpay_array[$i] = $_POST['gy_mpay_'.$i];
	$gy_post_array[$i] = $_POST['gy_post_'.$i];
	$gg_sdate_array[$i] = $_POST['gg_sdate_'.$i];
	$gg_ypay_array[$i] = $_POST['gg_ypay_'.$i];
	$gg_month_array[$i] = $_POST['gg_month_'.$i];
	// 천단위 콤마 제거 DB 저장
	$sj_ypay_array[$i] = ereg_replace(',', '', $sj_ypay_array[$i]);
	$sj_mpay_array[$i] = ereg_replace(',', '', $sj_mpay_array[$i]);
	$gy_ypay_array[$i] = ereg_replace(',', '', $gy_ypay_array[$i]);
	$gy_ypay_array2[$i] = ereg_replace(',', '', $gy_ypay_array2[$i]);
	$gy_mpay_array[$i] = ereg_replace(',', '', $gy_mpay_array[$i]);
	$gg_ypay_array[$i] = ereg_replace(',', '', $gg_ypay_array[$i]);

	if($name_array[$i]) {
		$sql_common_opt = " name1 = '$name_array[$i]',
				ssnb1 = '$ssnb_array[$i]',
				bohum_code1 = '$bohum_code_array[$i]',
				sj_sdate1 = '$sj_sdate_array[$i]',
				sj_edate1 = '$sj_edate_array[$i]',
				sj_ypay1 = '$sj_ypay_array[$i]',
				sj_mpay1 = '$sj_mpay_array[$i]',
				gy_sdate1 = '$gy_sdate_array[$i]',
				gy_edate1 = '$gy_edate_array[$i]',
				gy_ypay1 = '$gy_ypay_array[$i]',
				gy_ypay2 = '$gy_ypay_array2[$i]',
				gy_mpay1 = '$gy_mpay_array[$i]',
				gy_post1 = '$gy_post_array[$i]',

				gg_sdate1 = '$gg_sdate_array[$i]',
				gg_ypay1 = '$gg_ypay_array[$i]',
				gg_month1 = '$gg_month_array[$i]'
		";
		//수정,추가 공통
		$sql_opt = " insert total_pay_opt set $sql_common_opt , mid = $id ";
		sql_query($sql_opt);
	}
}
alert("정상적으로 신고 접수/수정 되었습니다.","total_pay_write_admin.php?w=u&id=$id&page=$page");
//goto_url("./4insure_list.php");
?>