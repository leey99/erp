<?
$sub_menu = "400400";
include_once("./_common.php");
//echo $chk_data;
//exit;
$now_time = date("Y-m-d H:i:s");
$now_date = date("Y-m-d");
$now_time_file = date("Ymd_His");
$chk_data_array = explode(",", $chk_data);
$check_cnt = sizeof($chk_data_array);
//첨부파일 경로
$upload_dir = '../kidsnomu/files/account/';
//전송 데이터 유무
if($chk_data) {
	for($i=0;$i<$check_cnt;$i++) {
		$code_id_array = explode("_", $chk_data_array[$i]);
		$com_code = $code_id_array[0];
		$id = $code_id_array[1];
		$send_year = $code_id_array[2];
		$send_month = $code_id_array[3];
		//메모
		$memo = $_POST['memo_'.$send_year.'_'.$send_month];
		//첨부파일 SQL
		$pic_name_sql_3 = "";
		$pic_name_sql_4 = "";
		//첨부서류3
		if($_FILES['filename_3_'.$send_year.'_'.$send_month]['tmp_name']) {
			$pic_name3 = $_FILES['filename_3_'.$send_year.'_'.$send_month]['name'];
			$upload_file_name = $now_time_file."_".$pic_name3;
			$upload_file = $upload_dir.$upload_file_name;
			move_uploaded_file($_FILES['filename_3_'.$send_year.'_'.$send_month]['tmp_name'], $upload_file);
		}
		if($pic_name3) {
			$pic_name_sql_3 = " filename_3 = '$upload_file_name', ";
		}
		//첨부서류4
		if($_FILES['filename_4_'.$send_year.'_'.$send_month]['tmp_name']) {
			$pic_name4 = $_FILES['filename_4_'.$send_year.'_'.$send_month]['name'];
			$upload_file_name = $now_time_file."_".$pic_name4;
			$upload_file = $upload_dir.$upload_file_name;
			move_uploaded_file($_FILES['filename_4_'.$send_year.'_'.$send_month]['tmp_name'], $upload_file);
		}
		if($pic_name4) {
			$pic_name_sql_4 = " filename_4 = '$upload_file_name', ";
		}
		//사업장 정보
		$sql_a4 = " select * from com_list_gy where com_code = '$com_code' ";
		$row_a4 = sql_fetch($sql_a4);
		//원천세 신고 사업장 정보
		$sql_common_account = " 
								year = '$send_year',
								t_no = '$row_a4[t_insureno]',
								comp_bznb = '$row_a4[biz_no]',
								comp_name = '$row_a4[com_name]',
								boss_name = '$row_a4[boss_name]',
								boss_ssnb = '$row_a4[jumin_no]',
								adr_zip = '$row_a4[com_postno]',
								adr_adr1 = '$row_a4[com_juso]',
								adr_adr2 = '$row_a4[com_juso2]',
								comp_email = '$row_a4[com_mail]',
								comp_tel = '$row_a4[com_tel]',
								comp_fax = '$row_a4[com_fax]',
								user_id = '$member[mb_id]',

								$pic_name_sql_3
								$pic_name_sql_4

								wr_datetime = '$now_time',
								revert_year = '$send_year',
								revert_month = '$send_month',
								memo = '$memo'
		";
		//기존 데이터 유무 (원천세 신고 사업장 정보)
		$sql_account = "select * from tax_account where comp_code = '$com_code' and revert_year = '$send_year' and revert_month = '$send_month' ";
		$result_account = sql_query($sql_account);
		$total_account = mysql_num_rows($result_account);
		//수정
		if($total_account) {
			$sql_account = "update tax_account set $sql_common_account where comp_code = '$com_code' and  revert_year = '$send_year' and revert_month = '$send_month' ";
		//등록
		} else {
			$sql_account = "insert tax_account set $sql_common_account , comp_code = '$com_code' ";
		}
		sql_query($sql_account);
		//원천세 신고 사업장 정보 id 추출
		$sql_account = " select * from tax_account where comp_code='$com_code' and revert_year = '$send_year' and revert_month = '$send_month' ";
		$result_account = sql_query($sql_account);
		$row_account = mysql_fetch_array($result_account);
		$mid = $row_account['id'];
		//기존 급여정보 데이터 추출
		$sql_common = " from pibohum_base_pay ";
		$sql_search = " where com_code='$com_code' and year = '$send_year' and month = '$send_month' and money_result != 0 ";
		$sql_order = " order by position asc, in_day asc, dept asc, pay_gbn asc ";
		$sql = " select * $sql_common $sql_search $sql_order ";
		$result = sql_query($sql);
		for($k=0; $row=sql_fetch_array($result); $k++) {
			$sql_common_account_opt = " 
									w_date = '$now_date',
									wr_datetime = '$now_time',
									name = '$row[name]',
									position = '$row[position]',
									step = '$row[step]',
									position_txt = '$row[position_txt]',
									step_txt = '$row[step_txt]',
									in_day = '$row[in_day]',
									out_day = '$row[out_day]',
									work_form = '$row[work_form]',
									dept = '$row[dept]',
									pay_gbn = '$row[pay_gbn]',

									w_day = '$row[w_day]',
									w_ext = '$row[w_ext]',
									w_night = '$row[w_night]',
									w_hday = '$row[w_hday]',

									workhour_total = '$row[workhour_total]',

									money_hour_ds = '$row[money_hour_ds]',
									money_month = '$row[money_month]',

									g1 = '$row[g1]',
									g2 = '$row[g2]',
									g3 = '$row[g3]',
									g4 = '$row[g4]',
									g5 = '$row[g5]',
									g6 = '$row[g6]',

									ext = '$row[ext]',
									night = '$row[night]',
									hday = '$row[hday]',
									annual_paid_holiday = '$row[annual_paid_holiday]',

									b1 = '$row[b1]',
									b2 = '$row[b2]',
									b3 = '$row[b3]',
									b4 = '$row[b4]',
									b5 = '$row[b5]',
									b6 = '$row[b6]',
									b7 = '$row[b7]',
									b8 = '$row[b8]',
			 
									tax_so = '$row[tax_so]',
									tax_jumin = '$row[tax_jumin]',
									advance_pay = '$row[advance_pay]',
									health = '$row[health]',
									yoyang = '$row[yoyang]',
									yun = '$row[yun]',
									goyong = '$row[goyong]',
									end_pay = '$row[end_pay]',
									minus = '$row[minus]',
									minus2 = '$row[minus2]',
									etc = '$row[etc]',
									etc2 = '$row[etc2]',

									money_total = '$row[money_total]',
									money_for_tax = '$row[money_for_tax]',
									money_gongje = '$row[money_gongje]',
									money_result = '$row[money_result]'
			";
			//기존 데이터 유무
			$sql_opt1 = "select * from tax_account_opt where com_code = '$com_code' and sabun = '$row[sabun]' and year = '$send_year' and month = '$send_month' ";
			$result_opt1 = sql_query($sql_opt1);
			$total_opt1 = mysql_num_rows($result_opt1);
			//수정
			if($total_opt1) {
				$sql_opt = "update tax_account_opt set 
						$sql_common_account_opt 
						where com_code = '$com_code' and sabun = '$row[sabun]' and year = '$send_year' and month = '$send_month' ";
			//등록
			} else {
				$sql_opt = "insert tax_account_opt set 
						$sql_common_account_opt
						, mid = '$mid' , com_code = '$com_code', sabun = '$row[sabun]', year = '$send_year', month = '$send_month' ";
			}
			sql_query($sql_opt);
		}
	}
}
alert("정상적으로 세무전송이 되었습니다.","pay_ledger_list.php?search_year=$search_year&search_month=$search_month");
?>