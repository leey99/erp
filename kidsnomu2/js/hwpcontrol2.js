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



// 표에 마지막 행을 추가하고, 내용을 채운다.
function TableAppendRowContents(FirstCellName, ColumnArray){
	if(TableAppendRow(FirstCellName))
		TableColumnContents(ColumnArray);
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

function TableColumnContents(ColumnArray){
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

function pageLoad(pName){

	var frm = document.HwpControl;

	var now = new Date();
	var nowLs = ''+now.toLocaleString();
	var yyyy = ''+now.getFullYear();
	var mm = ''+(now.getMonth()+1);
	var dd = ''+now.getDate();
	var toDay = yyyy +' 년  '+ mm + ' 월  ' + dd + ' 일';
	//alert(mm);
	var act = pHwpCtrl.CreateAction("InsertText");
	var set = act.CreateSet();



	if(frm.comp_type.value=='A'){
		retire1='a/retire_1_a.hwp';
	}else if(frm.comp_type.value=='B'){
		retire1='b/retire_1_b.hwp';
	}else if(frm.comp_type.value=='C'){
		retire1='c/retire_1_c.hwp';
	}else if(frm.comp_type.value=='D'){
		retire1='d/retire_1_d.hwp';
	}else{
		retire1='e/retire_1_e.hwp';
	}
	if(frm.comp_type.value=='A'){
		retire2='a/retire_2_a.hwp';
	}else if(frm.comp_type.value=='B'){
		retire2='b/retire_2_b.hwp';
	}else if(frm.comp_type.value=='C'){
		retire2='c/retire_2_c.hwp';
	}else if(frm.comp_type.value=='D'){
		retire2='d/retire_2_d.hwp';
	}else{
		retire2='e/retire_2_e.hwp';
	}
	if(frm.comp_type.value=='A'){
		retire3='a/retire_3_a.hwp';
	}else if(frm.comp_type.value=='B'){
		retire3='b/retire_3_b.hwp';
	}else if(frm.comp_type.value=='C'){
		retire3='c/retire_3_c.hwp';
	}else if(frm.comp_type.value=='D'){
		retire3='d/retire_3_d.hwp';
	}else{
		retire3='e/retire_3_e.hwp';
	}
	if(frm.comp_type.value=='A'){
		retire4='a/retire_4_a.hwp';
	}else if(frm.comp_type.value=='B'){
		retire4='b/retire_4_b.hwp';
	}else if(frm.comp_type.value=='C'){
		retire4='c/retire_4_c.hwp';
	}else if(frm.comp_type.value=='D'){
		retire4='d/retire_4_d.hwp';
	}else{
		retire4='e/retire_4_e.hwp';
	}

	//alert(retire1);

	switch(pName){
		case 'retire3': // 퇴직금신청서
			if(!pHwpCtrl.Open(BasePath + "/files/docs/"+retire3)){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}else{
				if (pHwpCtrl.MoveToField("[상호명]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[성명]", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[신청인]", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[신청일자]", true, true, false)){set.SetItem("Text",toDay);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[입사일자]", true, true, false)){set.SetItem("Text",frm.jdate.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사원번호]", true, true, false)){set.SetItem("Text",frm.employee_id.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[소속부서]", true, true, false)){set.SetItem("Text",frm.dept.value);act.Execute(set);}
			}
			break;
		case 'retire2': // 퇴직연금신청서
			if(!pHwpCtrl.Open(BasePath + "/files/docs/"+retire2)){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}else{
				if (pHwpCtrl.MoveToField("[사업장명]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업자등록번호]", true, true, false)){set.SetItem("Text",frm.comp_num.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업장전화번호]", true, true, false)){set.SetItem("Text",frm.comp_tel.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업장팩스번호]", true, true, false)){set.SetItem("Text",frm.comp_fax.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사업자핸드폰번호]", true, true, false)){set.SetItem("Text",frm.comp_cel.value);act.Execute(set);}

				if (pHwpCtrl.MoveToField("[사원성명]", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사원주민등록번호]", true, true, false)){set.SetItem("Text",frm.jumin.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사원주소]", true, true, false)){set.SetItem("Text",frm.addr.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사원핸드폰번호]", true, true, false)){set.SetItem("Text",frm.cel.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사원집전화번호]", true, true, false)){set.SetItem("Text",frm.tel.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[사원이메일주소]", true, true, false)){set.SetItem("Text",frm.email.value);act.Execute(set);}

				if (pHwpCtrl.MoveToField("[지급받는사람명]", true, true, false)){set.SetItem("Text",frm.bank_3.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[은행명]", true, true, false)){set.SetItem("Text",frm.bank_1.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[계좌번호]", true, true, false)){set.SetItem("Text",frm.bank_2.value);act.Execute(set);}
			}
			break;
		case 'retire1': //퇴직금적립 관리대장,정산내역서
			if(!pHwpCtrl.Open(BasePath + "/files/docs/"+retire1)){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}else{
				//alert(frm.comp_name.value);
				if (pHwpCtrl.MoveToField("[회사명]", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[입사일자]", true, true, false)){set.SetItem("Text",frm.jdate.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[이름]", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[이름1]", true, true, false)){set.SetItem("Text",frm.name_k.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[주민번호]", true, true, false)){set.SetItem("Text",frm.jumin.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[주소]", true, true, false)){set.SetItem("Text",frm.addr.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[부서]", true, true, false)){set.SetItem("Text",frm.dept.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[직위]", true, true, false)){set.SetItem("Text",frm.jik.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[퇴사일자]", true, true, false)){set.SetItem("Text",frm.edate.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[년도]", true, true, false)){set.SetItem("Text",frm.today_year.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[월]", true, true, false)){set.SetItem("Text",frm.today_month.value);act.Execute(set);}
				if (pHwpCtrl.MoveToField("[일]", true, true, false)){set.SetItem("Text",frm.today_day.value);act.Execute(set);}
			}
			break;



		default:
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
	pHwpCtrl.MovePos(2);
}

function toggleLayer(id,name){
	if(document.getElementById(id).style.display=='block'){
		document.getElementById(id).style.display='none';
	}else{
		document.getElementById(id).style.display='block';
	}

	document.HwpControl.labor.value = name;
}

function checkSubmit(name,min,max){
	var cnt=0;
	var frm = document.HwpControl;
	var item = document.getElementsByName('employee[]');
	for(i=0;i<item.length;i++){
		if(item[i].checked==true) cnt++;
	}
	if(cnt<min){ alert('최소 '+min+'명의 직원을 선택해야합니다.'); return;}
	if(cnt>max){ alert('최대 '+max+'명의 직원을 입력할 수 있습니다.'); return;}

	document.HwpControl.labor.value = name;
	frm.submit();
}

function goSubmit(name){

	document.HwpControl.labor.value = name;
	document.HwpControl.submit();
}


$(document).ready(function(e) {
	if(myagent == 'ie' || myagent == 'ns') {
		OnStart();
	}else{
		alert('Active X를 지원하지 않는 브라우저에서는 한글컨트롤을 사용할 수 없습니다!');
		location.href='./';
	}
});