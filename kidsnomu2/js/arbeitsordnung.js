var BasePath = rooturl;  
var MinVersion = 0;//0x05050118;
var rowIndex = 1;
var tableIndex = 0;

var _DEBUG = true; // Debug mode.
var pHwpCtrl;

function OnStart(){

	//BasePath = _GetBasePath();
	pHwpCtrl = HwpControl.HwpCtrl;

	if(!_VerifyVersion()){
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
	HwpControl.HwpCtrl.SetToolBar(0, "FilePreview, Print, Separator, Undo, Redo, Separator, Separator, Cut, Copy, Paste,"
	+"Separator, ParaNumberBullet, MultiColumn, SpellingCheck, HwpDic, Separator, PictureInsertDialog, MacroPlay1");
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


function pageLoad(pName){
	var rule1 ='';
	var frm = document.HwpControl;

	var now = new Date();
	var nowLs = ''+now.toLocaleString();
	var yyyy = ''+now.getFullYear();
	var mm = ''+now.getMonth();
	var dd = ''+now.getDate();
	var toDay = yyyy +' 년  '+ mm + ' 월  ' + dd + ' 일';


	if(frm.comp_type.value=='A'){
		rule1='rule_1a.hwp';
	}else if(frm.comp_type.value=='B'){
		rule1='rule_1b.hwp';
	}else if(frm.comp_type.value=='D'){
		rule1='rule_1d.hwp';
	}else{
		rule1='rule_1c.hwp';
	}

	var act = pHwpCtrl.CreateAction("InsertText");
	var set = act.CreateSet();

	switch(pName){
		case 'rule1':
			if(!pHwpCtrl.Open(BasePath + "/files/docs/"+rule1)){
				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}else{
				if (pHwpCtrl.MoveToField("회사명", true, true, false)) {	
					set.SetItem("Text",frm.comp_name.value );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("소재지", true, true, false)) {	
					set.SetItem("Text",frm.comp_addr1.value+" "+frm.comp_addr2.value  );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("전화번호", true, true, false)) {	
					set.SetItem("Text",frm.comp_tel.value );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("팩스번호", true, true, false)) {	
					set.SetItem("Text",frm.comp_fax.value );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("명", true, true, false)) {	
					set.SetItem("Text",frm.persons.value );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("남", true, true, false)) {	
					set.SetItem("Text",frm.man.value );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("여", true, true, false)) {	
					set.SetItem("Text",frm.woman.value );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("회사명1", true, true, false)) {	
					set.SetItem("Text",frm.comp_name.value );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("시업시간", true, true, false)) {	
					set.SetItem("Text",frm.stime.value );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("종업시간", true, true, false)) {	
					set.SetItem("Text",frm.etime.value );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("휴게시간1", true, true, false)) {	
					set.SetItem("Text",frm.rest1.value );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("휴게시간2", true, true, false)) {	
					set.SetItem("Text",frm.rest2.value );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("휴게시간3", true, true, false)) {	
					set.SetItem("Text",frm.rest3.value );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("주휴일", true, true, false)) {	
					set.SetItem("Text",frm.hday.value );
					act.Execute(set);
				}
				if(pHwpCtrl.MoveToField("유급휴일", true, true, false)){set.SetItem("Text",frm.new_hday.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("무급휴일", true, true, false)){set.SetItem("Text",frm.new_holiday.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("유급휴가", true, true, false)){set.SetItem("Text",frm.new_vacation.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("무급휴가", true, true, false)){set.SetItem("Text",frm.new_celebrate_mourn.value);act.Execute(set);}

				if(pHwpCtrl.MoveToField("설날", true, true, false)){set.SetItem("Text",frm.holiday1.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("추석", true, true, false)){set.SetItem("Text",frm.holiday2.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("신정", true, true, false)){set.SetItem("Text",frm.holiday3.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("휴일1", true, true, false)){set.SetItem("Text",frm.hday1.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("휴일2", true, true, false)){set.SetItem("Text",frm.hday2.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("휴일3", true, true, false)){set.SetItem("Text",frm.hday3.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("휴일4", true, true, false)){set.SetItem("Text",frm.hday4.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("휴일5", true, true, false)){set.SetItem("Text",frm.hday5.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("휴일6", true, true, false)){set.SetItem("Text",frm.hday6.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("휴일7", true, true, false)){set.SetItem("Text",frm.hday7.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("휴일8", true, true, false)){set.SetItem("Text",frm.hday8.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("하기휴가", true, true, false)){set.SetItem("Text",frm.summer_vacation.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("경조휴가1", true, true, false)){set.SetItem("Text",frm.celebrate_mourn1.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("경조휴가2", true, true, false)){set.SetItem("Text",frm.celebrate_mourn2.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("경조휴가3", true, true, false)){set.SetItem("Text",frm.celebrate_mourn3.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("경조휴가4", true, true, false)){set.SetItem("Text",frm.celebrate_mourn4.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("경조휴가5", true, true, false)){set.SetItem("Text",frm.celebrate_mourn5.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("경조휴가6", true, true, false)){set.SetItem("Text",frm.celebrate_mourn6.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("경조휴가7", true, true, false)){set.SetItem("Text",frm.celebrate_mourn7.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("경조휴가8", true, true, false)){set.SetItem("Text",frm.celebrate_mourn8.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("경조휴가9", true, true, false)){set.SetItem("Text",frm.celebrate_mourn9.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("경조휴가10", true, true, false)){set.SetItem("Text",frm.celebrate_mourn10.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("경조휴가11", true, true, false)){set.SetItem("Text",frm.celebrate_mourn11.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("경조휴가12", true, true, false)){set.SetItem("Text",frm.celebrate_mourn12.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("경조휴가13", true, true, false)){set.SetItem("Text",frm.celebrate_mourn13.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("경조휴가14", true, true, false)){set.SetItem("Text",frm.celebrate_mourn14.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("임금계산기간", true, true, false)){set.SetItem("Text",frm.pay_calculate_day_period.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("정기상여금", true, true, false)){set.SetItem("Text",frm.bonus.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("정년", true, true, false)){set.SetItem("Text",frm.retirement_age_rule.value);act.Execute(set);}

				if(pHwpCtrl.MoveToField("머리말", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
			}
			break;
		case 'rule2':
			if(!pHwpCtrl.Open(BasePath + "/files/docs/rule_2.hwp")){

				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}else{
				if (pHwpCtrl.MoveToField("[사업장명]", true, true, false)) {	
					set.SetItem("Text",frm.comp_name.value );
					act.Execute(set);
				}

				if (pHwpCtrl.MoveToField("[사업의종류]", true, true, false)) {	
					set.SetItem("Text",frm.comp_upte.value );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("[대표자성명]", true, true, false)) {	
					set.SetItem("Text",frm.comp_ceo.value );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("[근로자수]", true, true, false)) {	
					set.SetItem("Text",frm.employee.value );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("[노동조합원]", true, true, false)) {	
					set.SetItem("Text",frm.union.value );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("[여성]", true, true, false)) {	
					set.SetItem("Text",frm.women.value );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("[소재지]", true, true, false)) {	
					set.SetItem("Text",frm.comp_addr1.value+'  '+frm.comp_addr2.value );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("[전화번호]", true, true, false)) {	
					set.SetItem("Text",frm.comp_tel.value );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("[신고인]", true, true, false)) {	
					set.SetItem("Text",frm.comp_ceo.value );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("[대리인]", true, true, false)) {	
//					set.SetItem("Text",frm.comp_name.value );
//					act.Execute(set);
				}

				if (pHwpCtrl.MoveToField("[YYYY]", true, true, false)) {	
					set.SetItem("Text",yyyy );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("[MM]", true, true, false)) {	
					set.SetItem("Text",mm );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("[DD]", true, true, false)) {	
					set.SetItem("Text",dd );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("[날짜입력]", true, true, false)) {	
					set.SetItem("Text",toDay );
					act.Execute(set);
				}

			}
			break;
		case 'rule3':
			//if(!pHwpCtrl.Open(BasePath + "/files/docs/취업규칙_의견청취및동의서.hwp")){
			if(!pHwpCtrl.Open(BasePath + "/files/docs/rule_3.hwp")){

				alert("파일경로가 잘못 지정된 것 같습니다. 파일경로를 확인하여 주세요");
			}else{
				if (pHwpCtrl.MoveToField("[회사명]", true, true, false)) {	
					set.SetItem("Text",frm.comp_name.value );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("[YYYY]", true, true, false)) {	
					set.SetItem("Text",yyyy );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("[MM]", true, true, false)) {	
					set.SetItem("Text",mm );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("[DD]", true, true, false)) {	
					set.SetItem("Text",dd );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("[날짜입력]", true, true, false)) {	
					set.SetItem("Text",toDay );
					act.Execute(set);
				}

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

$(document).ready(function(e) {
	if(myagent=='ie' || myagent=='ns') {
		OnStart();
	}else{
		alert('Active X를 지원하지 않는 브라우저에서는 한글컨트롤을 사용할 수 없습니다!');
		location.href='./';
	}
});