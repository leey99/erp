var BasePath = rooturl;  
var MinVersion = 0;//0x05050118;
var rowIndex = 1;
var tableIndex = 0;

var _DEBUG = true; // Debug mode.
var pHwpCtrl;

function InitToolBarJS(){
	HwpControl.HwpCtrl.ReplaceAction("FileNew", "HwpCtrlFileNew");
	HwpControl.HwpCtrl.ReplaceAction("FileSave", "HwpCtrlFileSave");
	HwpControl.HwpCtrl.ReplaceAction("FileSaveAs", "HwpCtrlFileSaveAs");
	HwpControl.HwpCtrl.ReplaceAction("FileOpen", "HwpCtrlFileOpen");
	HwpControl.HwpCtrl.SetToolBar(0, "FilePreview, Print, Separator, Undo, Redo, Separator, Cut, Copy, Paste,"
	+"Separator, ParaNumberBullet, MultiColumn, SpellingCheck, HwpDic, Separator, PictureInsertDialog, MacroPlay1");
	HwpControl.HwpCtrl.ShowToolBar(true);

}

function _VerifyVersion(){	 //설치 확인
	if(pHwpCtrl.Version == null){
		document.getElementById('HwpCtrl').style.display='none';
		alert("한글  컨트롤이 설치되지 않았습니다.");
		return false;
	}
	//버젼 확인
	CurVersion = pHwpCtrl.Version;
	if(CurVersion < MinVersion){
		alert("HwpCtrl의 버젼이 낮아서 정상적으로 동작하지 않을 수 있습니다.\n"+
			"최신 버젼으로 업데이트하기를 권장합니다.\n\n"+
			"현재 버젼:" + CurVersion + "\n"+
			"권장 버젼:" + MinVersion + " 이상"			
			);
	}
	return true;
}

function _GetBasePath(){
	//BasePath를 구한다.
	var loc = unescape(document.location.href);
	var lowercase = loc.toLowerCase(loc);
	if (lowercase.indexOf("http://") == 0) // Internet
	{
		return loc.substr(0,loc.lastIndexOf("/") + 1);//BasePath 생성
	}
	else // local
	{
		var path;
		path = loc.replace(/.{2,}:\/{2,}/, ""); // file:/// 를 지워버린다.
		return path.substr(0,path.lastIndexOf("/") + 1);//BasePath 생성
	}
}

function TableColumnContents(ColumnArray){
	if (pHwpCtrl.ParentCtrl.CtrlID == "tbl"){ // 테이블 내에 커서가 있는가?
		var i;
		var size;
		var dact = pHwpCtrl.CreateAction("InsertText");
		var dset = dact.CreateSet();
		size = ColumnArray.length;
		for (i = 0;i < size; i++){
			dset.SetItem("Text", ColumnArray[i]);
			if(i==4){
				dact.Execute(dset);
				pHwpCtrl.Run("TableSplitCellRow2");
				pHwpCtrl.Run("TableLowerCell");
			}else if(i==9){
				dact.Execute(dset);
				pHwpCtrl.Run("TableSplitCellRow2");
				pHwpCtrl.Run("TableLowerCell");
			}else{
				dact.Execute(dset);
				pHwpCtrl.Run("TableRightCell");
			}
		}
		return true;
	}else	{
		if (_DEBUG)
			alert("현재 커서의 위치가 표의 내부가 아님.");
		return false;
	}
}

function TableAppendRow(FirstCellName){
	if (pHwpCtrl.MoveToField(FirstCellName, false, false, false)){
		pHwpCtrl.Run("TableCellBlock");
		pHwpCtrl.Run("TableColPageDown");
		pHwpCtrl.Run("Cancel");
		pHwpCtrl.Run("TableAppendRow");
		return true;
	}else	{
		if (_DEBUG)
			alert("셀필드(" + FirstCellName +")가 존재하지 않습니다.");
		return false;
	}
}


// 표에 마지막 행을 추가하고, 내용을 채운다.
function TableAppendRowContents(FirstCellName, ColumnArray){
	if(TableAppendRow(FirstCellName))
		TableColumnContents(ColumnArray);
}

function TableAppendRowContents2(FirstCellName, ColumnArray){
	if(TableAppendRow(FirstCellName))
		TableColumnContents2(ColumnArray);
}



function TableColumnContents2(ColumnArray){
	if (pHwpCtrl.ParentCtrl.CtrlID == "tbl"){ 
		var i;
		var size;
		var dact = pHwpCtrl.CreateAction("InsertText");
		var dset = dact.CreateSet();
		size = ColumnArray.length;
		for (i = 0;i < size; i++){
			dset.SetItem("Text", ColumnArray[i]);
			dact.Execute(dset);
			pHwpCtrl.Run("TableRightCell");
		}
		return true;
	}else	{
		if (_DEBUG)
			alert("현재 커서의 위치가 표의 내부가 아님.");
		return false;
	}
}

function TableDeleteRow(FirstCellName){
	if (pHwpCtrl.MoveToField(FirstCellName, false, false, false))
	{
		pHwpCtrl.Run("TableDeleteRow");
	}
}

function OnStart(){
	//BasePath = _GetBasePath();
	pHwpCtrl = HwpControl.HwpCtrl;

	if(!_VerifyVersion()){
		location.href='./';
		return;
	}
	if (_DEBUG) pHwpCtrl.SetClientName("DEBUG"); // Release 할 때는 이부분을 제거한다.

	InitToolBarJS();

	var frm = document.HwpControl;
	var act = pHwpCtrl.CreateAction("InsertText");
	var set = act.CreateSet();

	var pay_count = frm.pay_count.value;
	var pay_page = frm.pay_page.value;
	//var paycode_total_chk = frm.paycode_total_chk.value;

	pay_table = 'pay_ledger_ase_'+pay_page+'page.hwp';

	if(!pHwpCtrl.Open(BasePath + "/files/docs/"+pay_table)) {
		alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
	}else{
		alphabet = "abcdefghijklmnopqrstuvwxyyz";
		for(k=1;k<=pay_page;k++) {
			if(k == 1) {
				p = "";
				u = "";
			} else {
				p = k;
				u = alphabet.charAt(k-1);
			}
			if (pHwpCtrl.MoveToField("[사업장"+p+"]", true, true, false)){set.SetItem("Text",frm.company.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[급여년도"+p+"]", true, true, false)){set.SetItem("Text",frm.pay_year.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[급여월"+p+"]", true, true, false)){set.SetItem("Text",frm.pay_month.value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("통상1"+u, true, true, false)){set.SetItem("Text",frm.g1_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상2"+u, true, true, false)){set.SetItem("Text",frm.g2_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상3"+u, true, true, false)){set.SetItem("Text",frm.g3_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상4"+u, true, true, false)){set.SetItem("Text",frm.g4_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상5"+u, true, true, false)){set.SetItem("Text",frm.g5_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상6"+u, true, true, false)){set.SetItem("Text",frm.g6_text.value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("기타1"+u, true, true, false)){set.SetItem("Text",frm.b1_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타2"+u, true, true, false)){set.SetItem("Text",frm.b2_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타3"+u, true, true, false)){set.SetItem("Text",frm.b3_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타4"+u, true, true, false)){set.SetItem("Text",frm.b4_text.value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("etc1"+u, true, true, false)){set.SetItem("Text",frm.etc1_text.value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("etc2"+u, true, true, false)){set.SetItem("Text",frm.etc2_text.value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("기공1"+u, true, true, false)){set.SetItem("Text",frm.minus_text.value);act.Execute(set);}
		}
		tr_count = pay_page * 28;
		for(i=0;i<=tr_count;i++) {
			if (pHwpCtrl.MoveToField("연번"+i, true, true, false)){set.SetItem("Text",frm.no[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[성명"+i+"]", true, true, false)){set.SetItem("Text",frm.pay_name[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[직위"+i+"]", true, true, false)){set.SetItem("Text",frm.position[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[호봉"+i+"]", true, true, false)){set.SetItem("Text",frm.step[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[입사일"+i+"]", true, true, false)){set.SetItem("Text",frm.jdate[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[퇴사일"+i+"]", true, true, false)){set.SetItem("Text",frm.edate[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("채용형태"+i, true, true, false)){set.SetItem("Text",frm.work_form[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("부서"+i, true, true, false)){set.SetItem("Text",frm.dept[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("[기본근로"+i+"]", true, true, false)){set.SetItem("Text",frm.w_day[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[기본연장"+i+"]", true, true, false)){set.SetItem("Text",frm.w_ext[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[야간근로"+i+"]", true, true, false)){set.SetItem("Text",frm.w_night[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[휴일근로"+i+"]", true, true, false)){set.SetItem("Text",frm.w_hday[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[소계"+i+"]", true, true, false)){set.SetItem("Text",frm.w_sum[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("기본시급"+i, true, true, false)){set.SetItem("Text",frm.money_time_low[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상시급"+i, true, true, false)){set.SetItem("Text",frm.money_time[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기본급"+i, true, true, false)){set.SetItem("Text",frm.money_month[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("급여유형"+i, true, true, false)){set.SetItem("Text",frm.pay_gbn[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("통상1"+i, true, true, false)){set.SetItem("Text",frm.g1[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상2"+i, true, true, false)){set.SetItem("Text",frm.g2[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상3"+i, true, true, false)){set.SetItem("Text",frm.g3[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상4"+i, true, true, false)){set.SetItem("Text",frm.g4[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상5"+i, true, true, false)){set.SetItem("Text",frm.g5[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상6"+i, true, true, false)){set.SetItem("Text",frm.g6[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상임금계"+i, true, true, false)){set.SetItem("Text",frm.g_sum[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("기본연장"+i, true, true, false)){set.SetItem("Text",frm.ext[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("야간근로"+i, true, true, false)){set.SetItem("Text",frm.night[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("휴일근로"+i, true, true, false)){set.SetItem("Text",frm.hday[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("연차수당"+i, true, true, false)){set.SetItem("Text",frm.annual_paid_holiday[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("법정수당계"+i, true, true, false)){set.SetItem("Text",frm.s_sum[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("기타1"+i, true, true, false)){set.SetItem("Text",frm.b1[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타2"+i, true, true, false)){set.SetItem("Text",frm.b2[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타3"+i, true, true, false)){set.SetItem("Text",frm.b3[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타4"+i, true, true, false)){set.SetItem("Text",frm.b4[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타수당계"+i, true, true, false)){set.SetItem("Text",frm.b_sum[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("비과세"+i, true, true, false)){set.SetItem("Text",frm.tax_exemption[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("과세"+i, true, true, false)){set.SetItem("Text",frm.taxation[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("제수당"+i, true, true, false)){set.SetItem("Text",frm.v_sum[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("etc1"+i, true, true, false)){set.SetItem("Text",frm.etc[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("etc2"+i, true, true, false)){set.SetItem("Text",frm.etc2[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("연금보험"+i, true, true, false)){set.SetItem("Text",frm.yun[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("건강보험"+i, true, true, false)){set.SetItem("Text",frm.health[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("장기요양"+i, true, true, false)){set.SetItem("Text",frm.yoyang[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("고용보험"+i, true, true, false)){set.SetItem("Text",frm.goyong[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("소득세"+i, true, true, false)){set.SetItem("Text",frm.tax_so[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("주민세"+i, true, true, false)){set.SetItem("Text",frm.tax_jumin[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타공제"+i, true, true, false)){set.SetItem("Text",frm.minus[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("세금계"+i, true, true, false)){set.SetItem("Text",frm.tax_sum[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("공제계"+i, true, true, false)){set.SetItem("Text",frm.gongje_sum[i].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("급여총액"+i, true, true, false)){set.SetItem("Text",frm.money_total[i].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("지급총액"+i, true, true, false)){set.SetItem("Text",frm.money_result[i].value);act.Execute(set);}
		}
		for(k=0;k<pay_page;k++) {
			if(k == 0) m = "";
			else m = k+1;
			if (pHwpCtrl.MoveToField("[기본근로s"+m+"]", true, true, false)){set.SetItem("Text",frm['w_day_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[기본연장s"+m+"]", true, true, false)){set.SetItem("Text",frm['w_ext_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[야간근로s"+m+"]", true, true, false)){set.SetItem("Text",frm['w_night_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[휴일근로s"+m+"]", true, true, false)){set.SetItem("Text",frm['w_hday_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("[소계s"+m+"]", true, true, false)){set.SetItem("Text",frm['w_sum_sum'+m].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("기본시급s"+m, true, true, false)){set.SetItem("Text",frm['money_time_low_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상시급s"+m, true, true, false)){set.SetItem("Text",frm['money_time_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기본급s"+m, true, true, false)){set.SetItem("Text",frm['money_month_sum'+m].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("기본연장s"+m, true, true, false)){set.SetItem("Text",frm['ext_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("야간근로s"+m, true, true, false)){set.SetItem("Text",frm['night_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("휴일근로s"+m, true, true, false)){set.SetItem("Text",frm['hday_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("연차수당s"+m, true, true, false)){set.SetItem("Text",frm['annual_paid_holiday_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("법정수당계s"+m, true, true, false)){set.SetItem("Text",frm['s_sum_sum'+m].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("통상1s"+m, true, true, false)){set.SetItem("Text",frm['g1_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상2s"+m, true, true, false)){set.SetItem("Text",frm['g2_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상3s"+m, true, true, false)){set.SetItem("Text",frm['g3_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상4s"+m, true, true, false)){set.SetItem("Text",frm['g4_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상5s"+m, true, true, false)){set.SetItem("Text",frm['g5_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상6s"+m, true, true, false)){set.SetItem("Text",frm['g6_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("통상임금계s"+m, true, true, false)){set.SetItem("Text",frm['g_sum_sum'+m].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("기타1s"+m, true, true, false)){set.SetItem("Text",frm['b1_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타2s"+m, true, true, false)){set.SetItem("Text",frm['b2_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타3s"+m, true, true, false)){set.SetItem("Text",frm['b3_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타4s"+m, true, true, false)){set.SetItem("Text",frm['b4_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타수당계s"+m, true, true, false)){set.SetItem("Text",frm['b_sum_sum'+m].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("비과세s"+m, true, true, false)){set.SetItem("Text",frm['tax_exemption_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("과세s"+m, true, true, false)){set.SetItem("Text",frm['taxation_sum'+m].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("제수당s"+i, true, true, false)){set.SetItem("Text",frm['v_sum'+m].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("etc1s"+m, true, true, false)){set.SetItem("Text",frm['etc_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("etc2s"+m, true, true, false)){set.SetItem("Text",frm['etc2_sum'+m].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("연금보험s"+m, true, true, false)){set.SetItem("Text",frm['yun_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("건강보험s"+m, true, true, false)){set.SetItem("Text",frm['health_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("장기요양s"+m, true, true, false)){set.SetItem("Text",frm['yoyang_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("고용보험s"+m, true, true, false)){set.SetItem("Text",frm['goyong_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("소득세s"+m, true, true, false)){set.SetItem("Text",frm['tax_so_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("주민세s"+m, true, true, false)){set.SetItem("Text",frm['tax_jumin_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("기타공제s"+m, true, true, false)){set.SetItem("Text",frm['minus_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("세금계s"+m, true, true, false)){set.SetItem("Text",frm['tax_sum_sum'+m].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("공제계s"+m, true, true, false)){set.SetItem("Text",frm['gongje_sum_sum'+m].value);act.Execute(set);}

			if (pHwpCtrl.MoveToField("세금총액s"+m, true, true, false)){set.SetItem("Text",frm['tax_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("급여총액s"+m, true, true, false)){set.SetItem("Text",frm['money_total_sum'+m].value);act.Execute(set);}
			if (pHwpCtrl.MoveToField("지급총액s"+m, true, true, false)){set.SetItem("Text",frm['money_result_sum'+m].value);act.Execute(set);}
		}
		//총계
		if (pHwpCtrl.MoveToField("[기본근로t]", true, true, false)){set.SetItem("Text",frm.w_day_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[기본연장t]", true, true, false)){set.SetItem("Text",frm.w_ext_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[야간근로t]", true, true, false)){set.SetItem("Text",frm.w_night_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[휴일근로t]", true, true, false)){set.SetItem("Text",frm.w_hday_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("[소계t]", true, true, false)){set.SetItem("Text",frm.w_sum_sum_t.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("기본시급t", true, true, false)){set.SetItem("Text",frm.money_time_low_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상시급t", true, true, false)){set.SetItem("Text",frm.money_time_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기본급t", true, true, false)){set.SetItem("Text",frm.money_month_sum_t.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("기본연장t", true, true, false)){set.SetItem("Text",frm.ext_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("야간근로t", true, true, false)){set.SetItem("Text",frm.night_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("휴일근로t", true, true, false)){set.SetItem("Text",frm.hday_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("연차수당t", true, true, false)){set.SetItem("Text",frm.annual_paid_holiday_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("법정수당계t", true, true, false)){set.SetItem("Text",frm.s_sum_sum_t.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("통상1t", true, true, false)){set.SetItem("Text",frm.g1_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상2t", true, true, false)){set.SetItem("Text",frm.g2_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상3t", true, true, false)){set.SetItem("Text",frm.g3_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상4t", true, true, false)){set.SetItem("Text",frm.g4_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상5t", true, true, false)){set.SetItem("Text",frm.g5_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상6t", true, true, false)){set.SetItem("Text",frm.g6_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("통상임금계t", true, true, false)){set.SetItem("Text",frm.g_sum_sum_t.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("기타1t", true, true, false)){set.SetItem("Text",frm.b1_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타2t", true, true, false)){set.SetItem("Text",frm.b2_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타3t", true, true, false)){set.SetItem("Text",frm.b3_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타4t", true, true, false)){set.SetItem("Text",frm.b4_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타수당계t", true, true, false)){set.SetItem("Text",frm.b_sum_sum_t.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("비과세t", true, true, false)){set.SetItem("Text",frm.tax_exemption_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("과세t", true, true, false)){set.SetItem("Text",frm.taxation_sum_t.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("제수당t", true, true, false)){set.SetItem("Text",frm.v_sum_sum_t.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("etc1t", true, true, false)){set.SetItem("Text",frm.etc_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("etc2t", true, true, false)){set.SetItem("Text",frm.etc2_sum_t.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("연금보험t", true, true, false)){set.SetItem("Text",frm.yun_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("건강보험t", true, true, false)){set.SetItem("Text",frm.health_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("장기요양t", true, true, false)){set.SetItem("Text",frm.yoyang_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("고용보험t", true, true, false)){set.SetItem("Text",frm.goyong_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("소득세t", true, true, false)){set.SetItem("Text",frm.tax_so_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("주민세t", true, true, false)){set.SetItem("Text",frm.tax_jumin_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("기타공제t", true, true, false)){set.SetItem("Text",frm.minus_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("세금계t", true, true, false)){set.SetItem("Text",frm.tax_sum_sum_t.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("공제계t", true, true, false)){set.SetItem("Text",frm.gongje_sum_sum_t.value);act.Execute(set);}

		if (pHwpCtrl.MoveToField("급여총액t", true, true, false)){set.SetItem("Text",frm.money_total_sum_t.value);act.Execute(set);}
		if (pHwpCtrl.MoveToField("지급총액t", true, true, false)){set.SetItem("Text",frm.money_result_sum_t.value);act.Execute(set);}
	}
	pHwpCtrl.MovePos(2);
}
$(document).ready(function(e) {
	if(myagent == 'ie' || myagent == 'ns') {
		OnStart();
	}else{
		alert('Active X를 지원하지 않는 브라우저에서는 한글컨트롤을 사용할 수 없습니다!');
		location.href='index.php';
	}		
});