var BasePath = rooturl;  
var MinVersion = 0;//0x05050118;
var rowIndex = 1;
var tableIndex = 0;

var _DEBUG = true; // Debug mode.
var pHwpCtrl;

function OnStart(){

	//BasePath = _GetBasePath();
	pHwpCtrl = HwpControl.HwpCtrl;

	if(!_VerifyVersion()) {
		//alert("서식출력은 인터넷 익스플로러에서만 지원합니다.);
		location.href='./';
		return;
	}
	if (_DEBUG) pHwpCtrl.SetClientName("DEBUG"); // Release 할 때는 이부분을 제거한다.

	InitToolBarJS();
	
	if(!pHwpCtrl.Open(BasePath + "/files/docs/default.hwp")){
		alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
	}else{
		if (pHwpCtrl.MoveToField("[회원명]", true, true, false)) {	
			var act = pHwpCtrl.CreateAction("InsertText");
			var set = act.CreateSet();
			set.SetItem("Text",document.HwpControl.mb_name.value );
			act.Execute(set);
		}
	}

	if(document.HwpControl.labor.value != '') {
		pageLoad(document.HwpControl.labor.value);
	}

}
//custom Toolbar 사용시 기본 액션에는 새로만들기, 저장, 다른이름으로 저장, 열기, 가 없는데 대체 액션을 만들어서 사용
//html의 onstart()에 다음과 같이 넣고 사용하면 된다. 상단에 함수로 onstart있다.
function InitToolBarJS(){
	HwpControl.HwpCtrl.ReplaceAction("FileNew", "HwpCtrlFileNew");
	HwpControl.HwpCtrl.ReplaceAction("FileSave", "HwpCtrlFileSave");
	HwpControl.HwpCtrl.ReplaceAction("FileSaveAs", "HwpCtrlFileSaveAs");
	HwpControl.HwpCtrl.ReplaceAction("FileOpen", "HwpCtrlFileOpen");
//	HwpControl.HwpCtrl.SetToolBar(3, "FileNew, FileSave, FileSaveAs, FileOpen");
	/*
	HwpControl.HwpCtrl.SetToolBar(0, "FileNew, FileSave, FileSaveAs, FileOpen, Separator, FilePreview, Print, Separator, Undo, Redo, Separator, Cut, Copy, Paste,"
	+"Separator, ParaNumberBullet, MultiColumn, SpellingCheck, HwpDic, Separator, PictureInsertDialog, MacroPlay1");
	*/
	HwpControl.HwpCtrl.SetToolBar(0, "FilePreview, Print, Separator, Undo, Redo, Separator, Cut, Copy, Paste,"
	+"Separator, ParaNumberBullet, MultiColumn, SpellingCheck, HwpDic, Separator, PictureInsertDialog, MacroPlay1");
	/*
	HwpControl.HwpCtrl.SetToolBar(1, "DrawObjCreatorLine, DrawObjCreatorRectangle, DrawObjCreatorEllipse,"
	+"DrawObjCreatorArc, DrawObjCreatorPolygon, DrawObjCreatorCurve, DrawObjTemplateLoad,"
	+"Separator, ShapeObjSelect, ShapeObjGroup, ShapeObjUngroup, Separator, ShapeObjBringToFront,"
	+"ShapeObjSendToBack, ShapeObjDialog, ShapeObjAttrDialog");

	HwpControl.HwpCtrl.SetToolBar(2, "StyleCombo, CharShapeLanguage, CharShapeTypeFace, CharShapeHeight,"
	+"CharShapeBold, CharShapeItalic, CharShapeUnderline, ParagraphShapeAlignJustify, ParagraphShapeAlignLeft,"
	+"ParagraphShapeAlignCenter, ParagraphShapeAlignRight, Separator, ParaShapeLineSpacing,"
	+"ParagraphShapeDecreaseLeftMargin, ParagraphShapeIncreaseLeftMargin");
	*/
	HwpControl.HwpCtrl.ShowToolBar(true);

}

function _VerifyVersion(){	 //설치 확인
	if(pHwpCtrl.Version == null){
//	if(pHwpCtrl.getAttribute("Version") == null){
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
			//셀 나누기
			if(i==99){
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


function pageLoad(pName){
	//alert('준비중입니다!'); return;

	var labor1 ='';
	var frm = document.HwpControl;

	var now = new Date();
	var nowLs = ''+now.toLocaleString();
	var yyyy = ''+now.getFullYear();
	var mm = ''+(now.getMonth()+1);
	var dd = ''+now.getDate();
	var toDay = yyyy +' 년  '+ mm + ' 월  ' + dd + ' 일';


	var act = pHwpCtrl.CreateAction("InsertText");
	var set = act.CreateSet();

	labor1='labor_1a.hwp';

	switch(pName){
		case 'labor1': { // 근로계약서
			if(!pHwpCtrl.Open(BasePath + "/files/docs/"+labor1)){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}else{
				if (pHwpCtrl.MoveToField("[별정수당1]", true, true, false)) {	set.SetItem("Text",frm.addtxt11_0.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[별정수당2]", true, true, false)) {	set.SetItem("Text",frm.addtxt11_1.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[별정수당3]", true, true, false)) {	set.SetItem("Text",frm.addtxt11_2.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[별정수당4]", true, true, false)) {	set.SetItem("Text",frm.addtxt11_3.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[별정수당5]", true, true, false)) {	set.SetItem("Text",frm.addtxt11_4.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[별정수당6]", true, true, false)) {set.SetItem("Text",frm.addtxt11_5.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[별정수당금액1]", true, true, false)) {	set.SetItem("Text",frm.addtxt12_0.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[별정수당금액2]", true, true, false)) {	set.SetItem("Text",frm.addtxt12_1.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[별정수당금액3]", true, true, false)) {	set.SetItem("Text",frm.addtxt12_2.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[별정수당금액4]", true, true, false)) {	set.SetItem("Text",frm.addtxt12_3.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[별정수당금액5]", true, true, false)) {set.SetItem("Text",frm.addtxt12_4.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[별정수당금액6]", true, true, false)) {set.SetItem("Text",frm.addtxt12_5.value);act.Execute(set);}

				if (pHwpCtrl.MoveToField("[호봉]", true, true, false)) {	set.SetItem("Text",frm.job_grade.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[시간급]", true, true, false)) {set.SetItem("Text",frm.timegub.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[오늘날짜]", true, true, false)) {set.SetItem("Text",frm.today.value);act.Execute(set);}
			
				if (pHwpCtrl.MoveToField("[사업장명1]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사업장명2]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사업장명3]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사업장명4]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사업장명5]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사업장명6]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사업장명7]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사업장명8]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사업장명9]", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사업장명10]", true, true, false)) {set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사업장명11]", true, true, false)) {set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사업장명12]", true, true, false)) {set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}

				if (pHwpCtrl.MoveToField("[사업자등록번호]", true, true, false)) {	set.SetItem("Text",frm.comp_num.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사업장대표]", true, true, false)) {	set.SetItem("Text",frm.comp_ceo.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사업장주소]", true, true, false)) {	set.SetItem("Text",frm.comp_addr1.value +' '+frm.comp_addr2.value );		act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사업장업태]", true, true, false)) {	set.SetItem("Text",frm.comp_upte.value );	act.Execute(set);	}

				if (pHwpCtrl.MoveToField("[사원성명1]", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사원성명2]", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[주민등록번호]", true, true, false)) {	set.SetItem("Text",frm.jumin.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[사원주소]", true, true, false)) {	set.SetItem("Text",frm.addr.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[입사일자1]", true, true, false)) {	set.SetItem("Text",frm.jdate.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[입사일자2]", true, true, false)) {	set.SetItem("Text",frm.jdate.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[퇴직일자]", true, true, false)) {	set.SetItem("Text",frm.edate.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[채용형태]", true, true, false)) {	set.SetItem("Text",frm.job_div.value );	act.Execute(set);	}

				if (pHwpCtrl.MoveToField("[출근시간]", true, true, false)) {	set.SetItem("Text",frm.stime.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[퇴근시간]", true, true, false)) {	set.SetItem("Text",frm.etime.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[일근무시간]", true, true, false)) {	set.SetItem("Text",frm.wtime.value );		act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[주소정근무시간]", true, true, false)) {	set.SetItem("Text",frm.jogun.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[기본급여]", true, true, false)) {	set.SetItem("Text",frm.pay1.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[과세수당합계]", true, true, false)) {	set.SetItem("Text",frm.pay2.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[비과세수당합계]", true, true, false)) {	set.SetItem("Text",frm.pay3.value );	act.Execute(set)	;}
				if (pHwpCtrl.MoveToField("[별정수당합계]", true, true, false)) {	set.SetItem("Text",frm.pay4.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[월급여총합계]", true, true, false)) {	set.SetItem("Text",frm.pay5.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("[급여일]", true, true, false)) {	set.SetItem("Text",frm.pay_day.value );	act.Execute(set);	}
			}
			break;
		}
		case 'career_describe': { // 경력기술서
			if(!pHwpCtrl.Open(BasePath + "/files/docs/career_describe.hwp")){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}
			else{
				if (pHwpCtrl.MoveToField("성명", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("생년월일", true, true, false)) {	set.SetItem("Text",frm.birth_day.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("현주소", true, true, false)) {	set.SetItem("Text",frm.addr.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("성별", true, true, false)) {	set.SetItem("Text",frm.sex.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("연령", true, true, false)){set.SetItem("Text",frm.age.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("학력1", true, true, false)){set.SetItem("Text",frm.hak1.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("학력2", true, true, false)){set.SetItem("Text",frm.hak2.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("학력3", true, true, false)){set.SetItem("Text",frm.hak3.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("졸업1", true, true, false)){set.SetItem("Text",frm.graduate1.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("졸업2", true, true, false)){set.SetItem("Text",frm.graduate2.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("졸업3", true, true, false)){set.SetItem("Text",frm.graduate3.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("경력일1", true, true, false)) {	set.SetItem("Text",frm.career_date1.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("경력일2", true, true, false)) {	set.SetItem("Text",frm.career_date2.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("경력일3", true, true, false)) {	set.SetItem("Text",frm.career_date3.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("근무처1", true, true, false)) {	set.SetItem("Text",frm.career_space1.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("근무처2", true, true, false)) {	set.SetItem("Text",frm.career_space2.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("근무처3", true, true, false)) {	set.SetItem("Text",frm.career_space3.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("직위1", true, true, false)) {	set.SetItem("Text",frm.career_jik1.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("직위2", true, true, false)) {	set.SetItem("Text",frm.career_jik2.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("직위3", true, true, false)) {	set.SetItem("Text",frm.career_jik3.value );	act.Execute(set);	}
			}
			break;
		}
		case 'labor15': { // 경력증명서
			if(!pHwpCtrl.Open(BasePath + "/files/docs/career_certificate.hwp")){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}
			else{
				if (pHwpCtrl.MoveToField("성명", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("성명1", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("소속", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("직위", true, true, false)) {	set.SetItem("Text",frm.jik.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("주민등록번호", true, true, false)) {	set.SetItem("Text",frm.jumin.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("주소", true, true, false)) {	set.SetItem("Text",frm.addr.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("입사일", true, true, false)) {	set.SetItem("Text",frm.jdate.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("퇴사일", true, true, false)) {	set.SetItem("Text",frm.edate.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("대표직위", true, true, false)) {	set.SetItem("Text",frm.ceo_jik.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("대표자", true, true, false)){set.SetItem("Text",frm.comp_ceo.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("오늘일자", true, true, false)) {	set.SetItem("Text",frm.today.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("오늘일자1", true, true, false)) {	set.SetItem("Text",frm.today.value );	act.Execute(set);	}
				
			}
			break;
		}
		case 'public_document': { // 공문(결제란포함)
			if(!pHwpCtrl.Open(BasePath + "/files/docs/public_document.hwp")){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}
			else{
				if (pHwpCtrl.MoveToField("사업장명", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("사업장명1", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("주소", true, true, false)) {	set.SetItem("Text",frm.comp_addr1.value+" "+frm.comp_addr2.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("전화", true, true, false)) {	set.SetItem("Text",frm.comp_tel.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("팩스", true, true, false)) {	set.SetItem("Text",frm.comp_fax.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("이메일", true, true, false)) {	set.SetItem("Text",frm.comp_email.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("대표직위", true, true, false)) {	set.SetItem("Text",frm.ceo_jik.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("대표자", true, true, false)){set.SetItem("Text",frm.comp_ceo.value);act.Execute(set);}
			}
			break;
		}
		case 'advice_resign': { // 권고사직서
			if(!pHwpCtrl.Open(BasePath + "/files/docs/advice_resign.hwp")){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}
			else{
				if (pHwpCtrl.MoveToField("사업장", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("성명", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("성명1", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("직위", true, true, false)) {	set.SetItem("Text",frm.jik.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("주민등록번호", true, true, false)) {	set.SetItem("Text",frm.jumin.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("오늘일자", true, true, false)) {	set.SetItem("Text",frm.today.value );	act.Execute(set);	}
			}
			break;
		}
		case 'minor_consent': { // 미성년자취업동의서
			if(!pHwpCtrl.Open(BasePath + "/files/docs/minor_consent.hwp")){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}
			else{
				if (pHwpCtrl.MoveToField("사업장", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("성명", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("생년월일", true, true, false)) {	set.SetItem("Text",frm.birth_day.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("주소", true, true, false)) {	set.SetItem("Text",frm.addr.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("연령", true, true, false)){set.SetItem("Text",frm.age.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("오늘일자", true, true, false)) {	set.SetItem("Text",frm.today.value );	act.Execute(set);	}
			}
			break;
		}
		case 'resign': { // 사직서
			if(!pHwpCtrl.Open(BasePath + "/files/docs/resign.hwp")){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}
			else{
				if (pHwpCtrl.MoveToField("사업장", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("성명", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("성명1", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("직위", true, true, false)) {	set.SetItem("Text",frm.jik.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("사직사유", true, true, false)) {	set.SetItem("Text",frm.resign_cause.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("입사일", true, true, false)) {	set.SetItem("Text",frm.jdate.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("퇴직일", true, true, false)) {	set.SetItem("Text",frm.edate.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("오늘일자", true, true, false)) {	set.SetItem("Text",frm.today.value );	act.Execute(set);	}
			}
			break;
		}
		case 'identity': { // 신원보증서
			if(!pHwpCtrl.Open(BasePath + "/files/docs/identity.hwp")){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}
			else{
				if (pHwpCtrl.MoveToField("사업장", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("성명", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("현주소", true, true, false)) {	set.SetItem("Text",frm.addr.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("생년월일", true, true, false)) {	set.SetItem("Text",frm.birth_day.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("주민등록번호", true, true, false)) {	set.SetItem("Text",frm.jumin.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("오늘일자", true, true, false)) {	set.SetItem("Text",frm.today.value );	act.Execute(set);	}
			}
			break;
		}
		case 'personnel_appointment': { // 인사발령장
			if(!pHwpCtrl.Open(BasePath + "/files/docs/personnel_appointment.hwp")){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}
			else{
				if (pHwpCtrl.MoveToField("사업장", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("사업장1", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("년도", true, true, false)) {	set.SetItem("Text",frm.yy.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("년도1", true, true, false)) {	set.SetItem("Text",frm.yy.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("성명", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("성명1", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("오늘일자", true, true, false)) {	set.SetItem("Text",frm.today.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("오늘일자1", true, true, false)) {	set.SetItem("Text",frm.today.value );	act.Execute(set);	}
			}
			break;
		}
		case 'hold_retirement_certificate': { // 재직(퇴직)증명서
			if(!pHwpCtrl.Open(BasePath + "/files/docs/hold_retirement_certificate.hwp")){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}else{
				if (pHwpCtrl.MoveToField("주소", true, true, false)) {	set.SetItem("Text",frm.addr.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("성명", true, true, false)) {	set.SetItem("Text",frm.name_k.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("주민번호", true, true, false)) {	set.SetItem("Text",frm.jumin.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("최종직위", true, true, false)) {	set.SetItem("Text",frm.jik.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("근무시작일", true, true, false)) {	set.SetItem("Text",frm.sdate.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("근무종료일", true, true, false)) {	set.SetItem("Text",frm.edate.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("오늘일자", true, true, false)) {	set.SetItem("Text",frm.today.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("사업장", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("대표직위", true, true, false)) {	set.SetItem("Text",frm.ceo_jik.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("대표자", true, true, false)){set.SetItem("Text",frm.comp_ceo.value);act.Execute(set);}
			}
			break;
		}
		case 'business_trip_report': { // 출장품의서
			if(!pHwpCtrl.Open(BasePath + "/files/docs/business_trip_report.hwp")){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}else{
				if (pHwpCtrl.MoveToField("오늘일자", true, true, false)) {	set.SetItem("Text",frm.today.value );	act.Execute(set);	}
			}
			break;			
		}
		case 'worker_register_holder': { // 근로자명부(재직자)
			var worker_count = frm.worker_count.value;
			if(worker_count > 16 && worker_count <= 32) worker_register_holder_hwp = 'worker_register_holder_2page.hwp';
			else if(worker_count > 33 && worker_count <= 48) worker_register_holder_hwp = 'worker_register_holder_3page.hwp';
			else if(worker_count > 49 && worker_count <= 64) worker_register_holder_hwp = 'worker_register_holder_4page.hwp';
			else worker_register_holder_hwp = 'worker_register_holder.hwp';

			if(!pHwpCtrl.Open(BasePath + "/files/docs/"+worker_register_holder_hwp)){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}else{
				if(worker_count <= 16) {
					if (pHwpCtrl.MoveToField("사업장", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("오늘일자", true, true, false)){set.SetItem("Text",frm.today.value );	act.Execute(set);	}
					// 연차 개인별 리스트
					for(i=0;i<16;i++){
						if (pHwpCtrl.MoveToField("직위"+(i+1), true, true, false)) {	set.SetItem("Text",frm.jik[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("성명"+(i+1), true, true, false)) {	set.SetItem("Text",frm.name_k[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("주민번호"+(i+1), true, true, false)) {	set.SetItem("Text",frm.jumin[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("자격증"+(i+1), true, true, false)) {	set.SetItem("Text",frm.license_name[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("자격번호"+(i+1), true, true, false)) {	set.SetItem("Text",frm.license_step[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("주소"+(i+1), true, true, false)) {	set.SetItem("Text",frm.addr[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("입사일자"+(i+1), true, true, false)) {	set.SetItem("Text",frm.in_day[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("호"+(i+1), true, true, false)) {	set.SetItem("Text",frm.step[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("tel"+(i+1), true, true, false)) {	set.SetItem("Text",frm.tel[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("hp"+(i+1), true, true, false)) {	set.SetItem("Text",frm.hp[i].value );	act.Execute(set);	}
					}
				}
				else if(worker_count <= 32) {
					if (pHwpCtrl.MoveToField("사업장", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("오늘일자", true, true, false)){set.SetItem("Text",frm.today.value );	act.Execute(set);	}
					if (pHwpCtrl.MoveToField("사업장2", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("오늘일자2", true, true, false)){set.SetItem("Text",frm.today.value );	act.Execute(set);	}
					// 연차 개인별 리스트
					for(i=0;i<32;i++){
						if (pHwpCtrl.MoveToField("직위"+(i+1), true, true, false)) {	set.SetItem("Text",frm.jik[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("성명"+(i+1), true, true, false)) {	set.SetItem("Text",frm.name_k[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("주민번호"+(i+1), true, true, false)) {	set.SetItem("Text",frm.jumin[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("자격증"+(i+1), true, true, false)) {	set.SetItem("Text",frm.license_name[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("자격번호"+(i+1), true, true, false)) {	set.SetItem("Text",frm.license_step[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("주소"+(i+1), true, true, false)) {	set.SetItem("Text",frm.addr[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("입사일자"+(i+1), true, true, false)) {	set.SetItem("Text",frm.in_day[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("호"+(i+1), true, true, false)) {	set.SetItem("Text",frm.step[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("tel"+(i+1), true, true, false)) {	set.SetItem("Text",frm.tel[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("hp"+(i+1), true, true, false)) {	set.SetItem("Text",frm.hp[i].value );	act.Execute(set);	}
					}
				}
				else if(worker_count <= 48) {
					if (pHwpCtrl.MoveToField("사업장", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("오늘일자", true, true, false)){set.SetItem("Text",frm.today.value );	act.Execute(set);	}
					if (pHwpCtrl.MoveToField("사업장2", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("오늘일자2", true, true, false)){set.SetItem("Text",frm.today.value );	act.Execute(set);	}
					if (pHwpCtrl.MoveToField("사업장3", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("오늘일자3", true, true, false)){set.SetItem("Text",frm.today.value );	act.Execute(set);	}
					// 연차 개인별 리스트
					for(i=0;i<48;i++){
						if (pHwpCtrl.MoveToField("직위"+(i+1), true, true, false)) {	set.SetItem("Text",frm.jik[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("성명"+(i+1), true, true, false)) {	set.SetItem("Text",frm.name_k[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("주민번호"+(i+1), true, true, false)) {	set.SetItem("Text",frm.jumin[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("자격증"+(i+1), true, true, false)) {	set.SetItem("Text",frm.license_name[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("자격번호"+(i+1), true, true, false)) {	set.SetItem("Text",frm.license_step[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("주소"+(i+1), true, true, false)) {	set.SetItem("Text",frm.addr[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("입사일자"+(i+1), true, true, false)) {	set.SetItem("Text",frm.in_day[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("호"+(i+1), true, true, false)) {	set.SetItem("Text",frm.step[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("tel"+(i+1), true, true, false)) {	set.SetItem("Text",frm.tel[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("hp"+(i+1), true, true, false)) {	set.SetItem("Text",frm.hp[i].value );	act.Execute(set);	}
					}
				}
				else if(worker_count <= 64) {
					if (pHwpCtrl.MoveToField("사업장", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("오늘일자", true, true, false)){set.SetItem("Text",frm.today.value );	act.Execute(set);	}
					if (pHwpCtrl.MoveToField("사업장2", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("오늘일자2", true, true, false)){set.SetItem("Text",frm.today.value );	act.Execute(set);	}
					if (pHwpCtrl.MoveToField("사업장3", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("오늘일자3", true, true, false)){set.SetItem("Text",frm.today.value );	act.Execute(set);	}
					if (pHwpCtrl.MoveToField("사업장4", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("오늘일자4", true, true, false)){set.SetItem("Text",frm.today.value );	act.Execute(set);	}
					// 연차 개인별 리스트
					for(i=0;i<64;i++){
						if (pHwpCtrl.MoveToField("직위"+(i+1), true, true, false)) {	set.SetItem("Text",frm.jik[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("성명"+(i+1), true, true, false)) {	set.SetItem("Text",frm.name_k[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("주민번호"+(i+1), true, true, false)) {	set.SetItem("Text",frm.jumin[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("자격증"+(i+1), true, true, false)) {	set.SetItem("Text",frm.license_name[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("자격번호"+(i+1), true, true, false)) {	set.SetItem("Text",frm.license_step[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("주소"+(i+1), true, true, false)) {	set.SetItem("Text",frm.addr[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("입사일자"+(i+1), true, true, false)) {	set.SetItem("Text",frm.in_day[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("호"+(i+1), true, true, false)) {	set.SetItem("Text",frm.step[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("tel"+(i+1), true, true, false)) {	set.SetItem("Text",frm.tel[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("hp"+(i+1), true, true, false)) {	set.SetItem("Text",frm.hp[i].value );	act.Execute(set);	}
					}
				}
			}
			break;
		}
		case 'worker_register_retiree': { // 근로자명부(퇴직자)
			var worker_count = frm.worker_count.value;
			if(worker_count > 16 && worker_count <= 32) worker_register_retiree_hwp = 'worker_register_retiree_2page.hwp';
			else if(worker_count > 33 && worker_count <= 48) worker_register_retiree_hwp = 'worker_register_retiree_3page.hwp';
			else if(worker_count > 49 && worker_count <= 64) worker_register_retiree_hwp = 'worker_register_retiree_4page.hwp';
			else worker_register_retiree_hwp = 'worker_register_retiree.hwp';

			if(!pHwpCtrl.Open(BasePath + "/files/docs/"+ worker_register_retiree_hwp)){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}else{
				if(worker_count <= 16) {
					if (pHwpCtrl.MoveToField("사업장", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("오늘일자", true, true, false)){set.SetItem("Text",frm.today.value );	act.Execute(set);	}
					// 연차 개인별 리스트
					for(i=0;i<16;i++){
						if (pHwpCtrl.MoveToField("직위"+(i+1), true, true, false)) {	set.SetItem("Text",frm.jik[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("성명"+(i+1), true, true, false)) {	set.SetItem("Text",frm.name_k[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("주민번호"+(i+1), true, true, false)) {	set.SetItem("Text",frm.jumin[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("자격증"+(i+1), true, true, false)) {	set.SetItem("Text",frm.license_name[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("자격번호"+(i+1), true, true, false)) {	set.SetItem("Text",frm.license_step[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("주소"+(i+1), true, true, false)) {	set.SetItem("Text",frm.addr[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("입사일자"+(i+1), true, true, false)) {	set.SetItem("Text",frm.in_day[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("호"+(i+1), true, true, false)) {	set.SetItem("Text",frm.step[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("퇴직일자"+(i+1), true, true, false)) {	set.SetItem("Text",frm.out_day[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("퇴직사유"+(i+1), true, true, false)) {	set.SetItem("Text",frm.retire_cause[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("tel"+(i+1), true, true, false)) {	set.SetItem("Text",frm.tel[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("hp"+(i+1), true, true, false)) {	set.SetItem("Text",frm.hp[i].value );	act.Execute(set);	}
					}
				}
				else if(worker_count <= 32) {
					if (pHwpCtrl.MoveToField("사업장", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("오늘일자", true, true, false)){set.SetItem("Text",frm.today.value );	act.Execute(set);	}
					if (pHwpCtrl.MoveToField("사업장2", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("오늘일자2", true, true, false)){set.SetItem("Text",frm.today.value );	act.Execute(set);	}
					// 연차 개인별 리스트
					for(i=0;i<32;i++){
						if (pHwpCtrl.MoveToField("직위"+(i+1), true, true, false)) {	set.SetItem("Text",frm.jik[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("성명"+(i+1), true, true, false)) {	set.SetItem("Text",frm.name_k[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("주민번호"+(i+1), true, true, false)) {	set.SetItem("Text",frm.jumin[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("자격증"+(i+1), true, true, false)) {	set.SetItem("Text",frm.license_name[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("자격번호"+(i+1), true, true, false)) {	set.SetItem("Text",frm.license_step[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("주소"+(i+1), true, true, false)) {	set.SetItem("Text",frm.addr[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("입사일자"+(i+1), true, true, false)) {	set.SetItem("Text",frm.in_day[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("호"+(i+1), true, true, false)) {	set.SetItem("Text",frm.step[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("퇴직일자"+(i+1), true, true, false)) {	set.SetItem("Text",frm.out_day[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("퇴직사유"+(i+1), true, true, false)) {	set.SetItem("Text",frm.retire_cause[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("tel"+(i+1), true, true, false)) {	set.SetItem("Text",frm.tel[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("hp"+(i+1), true, true, false)) {	set.SetItem("Text",frm.hp[i].value );	act.Execute(set);	}
					}
				}
				else if(worker_count <= 48) {
					if (pHwpCtrl.MoveToField("사업장", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("오늘일자", true, true, false)){set.SetItem("Text",frm.today.value );	act.Execute(set);	}
					if (pHwpCtrl.MoveToField("사업장3", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("오늘일자3", true, true, false)){set.SetItem("Text",frm.today.value );	act.Execute(set);	}
					// 연차 개인별 리스트
					for(i=0;i<48;i++){
						if (pHwpCtrl.MoveToField("직위"+(i+1), true, true, false)) {	set.SetItem("Text",frm.jik[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("성명"+(i+1), true, true, false)) {	set.SetItem("Text",frm.name_k[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("주민번호"+(i+1), true, true, false)) {	set.SetItem("Text",frm.jumin[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("자격증"+(i+1), true, true, false)) {	set.SetItem("Text",frm.license_name[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("자격번호"+(i+1), true, true, false)) {	set.SetItem("Text",frm.license_step[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("주소"+(i+1), true, true, false)) {	set.SetItem("Text",frm.addr[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("입사일자"+(i+1), true, true, false)) {	set.SetItem("Text",frm.in_day[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("호"+(i+1), true, true, false)) {	set.SetItem("Text",frm.step[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("퇴직일자"+(i+1), true, true, false)) {	set.SetItem("Text",frm.out_day[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("퇴직사유"+(i+1), true, true, false)) {	set.SetItem("Text",frm.retire_cause[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("tel"+(i+1), true, true, false)) {	set.SetItem("Text",frm.tel[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("hp"+(i+1), true, true, false)) {	set.SetItem("Text",frm.hp[i].value );	act.Execute(set);	}
					}
				}
				else if(worker_count <= 64) {
					if (pHwpCtrl.MoveToField("사업장", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("오늘일자", true, true, false)){set.SetItem("Text",frm.today.value );	act.Execute(set);	}
					if (pHwpCtrl.MoveToField("사업장4", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
					if (pHwpCtrl.MoveToField("오늘일자4", true, true, false)){set.SetItem("Text",frm.today.value );	act.Execute(set);	}
					// 연차 개인별 리스트
					for(i=0;i<64;i++){
						if (pHwpCtrl.MoveToField("직위"+(i+1), true, true, false)) {	set.SetItem("Text",frm.jik[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("성명"+(i+1), true, true, false)) {	set.SetItem("Text",frm.name_k[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("주민번호"+(i+1), true, true, false)) {	set.SetItem("Text",frm.jumin[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("자격증"+(i+1), true, true, false)) {	set.SetItem("Text",frm.license_name[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("자격번호"+(i+1), true, true, false)) {	set.SetItem("Text",frm.license_step[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("주소"+(i+1), true, true, false)) {	set.SetItem("Text",frm.addr[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("입사일자"+(i+1), true, true, false)) {	set.SetItem("Text",frm.in_day[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("호"+(i+1), true, true, false)) {	set.SetItem("Text",frm.step[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("퇴직일자"+(i+1), true, true, false)) {	set.SetItem("Text",frm.out_day[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("퇴직사유"+(i+1), true, true, false)) {	set.SetItem("Text",frm.retire_cause[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("tel"+(i+1), true, true, false)) {	set.SetItem("Text",frm.tel[i].value );	act.Execute(set);	}
						if (pHwpCtrl.MoveToField("hp"+(i+1), true, true, false)) {	set.SetItem("Text",frm.hp[i].value );	act.Execute(set);	}
					}
				}
			}
			break;
		}
		case 'night_holiday_work_consent': { // 야간휴일근로동의서
			if(!pHwpCtrl.Open(BasePath + "/files/docs/night_holiday_work_consent.hwp")){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}else{
				if (pHwpCtrl.MoveToField("소속", true, true, false)){set.SetItem("Text",frm.dept.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("직위", true, true, false)){set.SetItem("Text",frm.jik.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("성명", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("시간", true, true, false)){set.SetItem("Text",frm.time.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("성명1", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("오늘일자", true, true, false)) {	set.SetItem("Text",frm.today.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("사업장", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("대표직위", true, true, false)) {	set.SetItem("Text",frm.ceo_jik.value );	act.Execute(set);	}
			}
			break;
		}
		case 'extend_work_consent': { // 연장근로합의서
			if(!pHwpCtrl.Open(BasePath + "/files/docs/extend_work_consent.hwp")){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}else{
				if (pHwpCtrl.MoveToField("일자", true, true, false)) {	set.SetItem("Text",frm.today.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("부서", true, true, false)){set.SetItem("Text",frm.dept.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("성명", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("오늘일자", true, true, false)) {	set.SetItem("Text",frm.today.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("사업장", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("대표직위", true, true, false)) {	set.SetItem("Text",frm.ceo_jik.value );	act.Execute(set);	}
			}
			break;
		}
		case 'personnel_document_card': { // 인사기록카드(개정)
			if(!pHwpCtrl.Open(BasePath + "/files/docs/personnel_document_card.hwp")){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}else{
				if (pHwpCtrl.MoveToField("사업장", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("주민번호", true, true, false)) {	set.SetItem("Text",frm.jumin.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("성명", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("성별", true, true, false)) {	set.SetItem("Text",frm.sex.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("생년월일", true, true, false)) {	set.SetItem("Text",frm.birth_day.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("주소", true, true, false)) {	set.SetItem("Text",frm.addr.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("성명1", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("오늘일자", true, true, false)) {	set.SetItem("Text",frm.today.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("오늘일자1", true, true, false)) {	set.SetItem("Text",frm.today.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("성명2", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("대표직위", true, true, false)) {	set.SetItem("Text",frm.ceo_jik.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("대표자", true, true, false)){set.SetItem("Text",frm.comp_ceo.value);act.Execute(set);}
			}
			break;
		}
		case 'change_vacation_agree': { // 대체휴가합의서
			if(!pHwpCtrl.Open(BasePath + "/files/docs/change_vacation_agree.hwp")){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}else{
				if (pHwpCtrl.MoveToField("대표자", true, true, false)){set.SetItem("Text",frm.comp_ceo.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("대표자주민번호", true, true, false)) {	set.SetItem("Text",frm.jumin.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("사업장주소", true, true, false)) {	set.SetItem("Text",frm.comp_addr1.value+" "+frm.comp_addr2.value);	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("성명", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("주민번호", true, true, false)) {	set.SetItem("Text",frm.jumin.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("주소", true, true, false)) {	set.SetItem("Text",frm.addr.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("대표자1", true, true, false)){set.SetItem("Text",frm.comp_ceo.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("대표자2", true, true, false)){set.SetItem("Text",frm.comp_ceo.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("사업장", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("성명1", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("성명2", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("오늘일자", true, true, false)) {	set.SetItem("Text",frm.today.value );	act.Execute(set);	}
			}
			break;
		}
		case 'written_apology': { // 시말서
			if(!pHwpCtrl.Open(BasePath + "/files/docs/written_apology.hwp")){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}else{
				if (pHwpCtrl.MoveToField("소속", true, true, false)){set.SetItem("Text",frm.dept.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("직위", true, true, false)){set.SetItem("Text",frm.jik.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("성명", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("오늘일자", true, true, false)) {	set.SetItem("Text",frm.today.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("사업장", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("대표직위", true, true, false)) {	set.SetItem("Text",frm.ceo_jik.value );	act.Execute(set);	}
			}
			break;
		}
		case 'annual_paid_holiday': { // 연차관리대장
			if(!pHwpCtrl.Open(BasePath + "/files/docs/annual_paid_holiday.hwp")){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}else{
				if (pHwpCtrl.MoveToField("년도", true, true, false)){set.SetItem("Text",frm.yy.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("사업장", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}

				// 연차 개인별 리스트
				for(i=0;i<30;i++){
					if (pHwpCtrl.MoveToField("직책"+(i+1), true, true, false)) {	set.SetItem("Text",frm.jik[i].value );	act.Execute(set);	}
					if (pHwpCtrl.MoveToField("성명"+(i+1), true, true, false)) {	set.SetItem("Text",frm.name_k[i].value );	act.Execute(set);	}
					if (pHwpCtrl.MoveToField("입사일자"+(i+1), true, true, false)) {	set.SetItem("Text",frm.in_day[i].value );	act.Execute(set);	}
					if (pHwpCtrl.MoveToField("발생일수"+(i+1), true, true, false)) {	set.SetItem("Text",frm.annual_sum[i].value );	act.Execute(set);	}
					if (pHwpCtrl.MoveToField("사용일수"+(i+1), true, true, false)) {	set.SetItem("Text",frm.annual_use[i].value );	act.Execute(set);	}
					if (pHwpCtrl.MoveToField("잔여일수"+(i+1), true, true, false)) {	set.SetItem("Text",frm.annual_rest[i].value );	act.Execute(set);	}
				}
			}
			break;
		}
		case 'attendance_reason': { // 지각,조퇴,결근 사유서
			if(!pHwpCtrl.Open(BasePath + "/files/docs/attendance_reason.hwp")){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}else{
				if (pHwpCtrl.MoveToField("오늘일자", true, true, false)){set.SetItem("Text",frm.today.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("성명", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
			}
			break;
		}
		case 'vacation': { // 휴가신청서(회사)
			if(!pHwpCtrl.Open(BasePath + "/files/docs/vacation_request.hwp")){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}else{
				if (pHwpCtrl.MoveToField("소속", true, true, false)){set.SetItem("Text",frm.dept.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("직위", true, true, false)){set.SetItem("Text",frm.jik.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("연락처", true, true, false)){set.SetItem("Text",frm.tel.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("성명", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("성명1", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("휴가구분", true, true, false)){set.SetItem("Text",frm.cause.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("기간", true, true, false)){set.SetItem("Text",frm.vdate.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("행선지", true, true, false)){set.SetItem("Text",frm.space.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("사유", true, true, false)){set.SetItem("Text",frm.reason.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("오늘일자", true, true, false)){set.SetItem("Text",frm.today.value );act.Execute(set);}
			}
			break;
		}
		case 'bonus_pay_ledger': { // 상여금지급대장
			if(!pHwpCtrl.Open(BasePath + "/files/docs/bonus_pay_ledger.hwp")){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}else{
				if (pHwpCtrl.MoveToField("결재1", true, true, false)){set.SetItem("Text",frm.approval1.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("결재2", true, true, false)){set.SetItem("Text",frm.approval2.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("결재3", true, true, false)){set.SetItem("Text",frm.approval3.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("사업장", true, true, false)) {	set.SetItem("Text",frm.comp_name.value );	act.Execute(set);	}
				if (pHwpCtrl.MoveToField("년도", true, true, false)){set.SetItem("Text",frm.yy.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("지급1", true, true, false)){set.SetItem("Text",frm.bonus_time1.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("지급2", true, true, false)){set.SetItem("Text",frm.bonus_time2.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("지급3", true, true, false)){set.SetItem("Text",frm.bonus_time3.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("지급4", true, true, false)){set.SetItem("Text",frm.bonus_time4.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("지급5", true, true, false)){set.SetItem("Text",frm.bonus_time5.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("지급6", true, true, false)){set.SetItem("Text",frm.bonus_time6.value);act.Execute(set);}
				setRowInsert();
			}
			break;
		}
		case 'retirement_pay_ledger': { // 퇴직금지급대장
			if(!pHwpCtrl.Open(BasePath + "/files/docs/retirement_pay_ledger.hwp")){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}else{
				if (pHwpCtrl.MoveToField("년도", true, true, false)){set.SetItem("Text",frm.yy.value);act.Execute(set);}
				setRowInsert();
			}
			break;	
		}
		default : {
			if(!pHwpCtrl.Open(BasePath + "/files/docs/default.hwp")){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}else{
				if (pHwpCtrl.MoveToField("[회원명]", true, true, false)) {	
					var act = pHwpCtrl.CreateAction("InsertText");
					var set = act.CreateSet();
					set.SetItem("Text",frm.mb_name.value );
					act.Execute(set);
				}
			}
		}
	}
	pHwpCtrl.MovePos(2);
}

$(document).ready(function(e) {
	//alert(myagent);
	if(myagent == 'ie' || myagent == 'ns') {
		OnStart();
	}else{
		alert('Active X를 지원하지 않는 브라우저에서는 한글컨트롤을 사용할 수 없습니다!');
		location.href='./';
	}
});