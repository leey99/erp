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
	if (_DEBUG) pHwpCtrl.SetClientName("DEBUG"); // Release �� ���� �̺κ��� �����Ѵ�.

	InitToolBarJS();
	
	if(!pHwpCtrl.Open(BasePath + "/files/docs/default.hwp")){
		alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
	}else{
		if (pHwpCtrl.MoveToField("[ȸ����]", true, true, false)) {	
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

function _VerifyVersion(){	 //��ġ Ȯ��
	if(pHwpCtrl.Version == null){
//	if(pHwpCtrl.getAttribute("Version") == null){
		document.getElementById('HwpCtrl').style.display='none';
		alert("�ѱ�  ��Ʈ���� ��ġ���� �ʾҽ��ϴ�.");
		return false;
	}
	//���� Ȯ��
	CurVersion = pHwpCtrl.Version;
	if(CurVersion < MinVersion){
		alert("HwpCtrl�� ������ ���Ƽ� ���������� �������� ���� �� �ֽ��ϴ�.\n"+
			"�ֽ� �������� ������Ʈ�ϱ⸦ �����մϴ�.\n\n"+
			"���� ����:" + CurVersion + "\n"+
			"���� ����:" + MinVersion + " �̻�"			
			);
	}
	return true;
}

function _GetBasePath(){
	//BasePath�� ���Ѵ�.
	var loc = unescape(document.location.href);
	var lowercase = loc.toLowerCase(loc);
	if (lowercase.indexOf("http://") == 0) // Internet
	{
		return loc.substr(0,loc.lastIndexOf("/") + 1);//BasePath ����
	}
	else // local
	{
		var path;
		path = loc.replace(/.{2,}:\/{2,}/, ""); // file:/// �� ����������.
		return path.substr(0,path.lastIndexOf("/") + 1);//BasePath ����
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
	var toDay = yyyy +' ��  '+ mm + ' ��  ' + dd + ' ��';


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
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}else{
				if (pHwpCtrl.MoveToField("ȸ���", true, true, false)) {	
					set.SetItem("Text",frm.comp_name.value );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("������", true, true, false)) {	
					set.SetItem("Text",frm.comp_addr1.value+" "+frm.comp_addr2.value  );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("��ȭ��ȣ", true, true, false)) {	
					set.SetItem("Text",frm.comp_tel.value );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("�ѽ���ȣ", true, true, false)) {	
					set.SetItem("Text",frm.comp_fax.value );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("��", true, true, false)) {	
					set.SetItem("Text",frm.persons.value );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("��", true, true, false)) {	
					set.SetItem("Text",frm.man.value );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("��", true, true, false)) {	
					set.SetItem("Text",frm.woman.value );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("ȸ���1", true, true, false)) {	
					set.SetItem("Text",frm.comp_name.value );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("�þ��ð�", true, true, false)) {	
					set.SetItem("Text",frm.stime.value );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("�����ð�", true, true, false)) {	
					set.SetItem("Text",frm.etime.value );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("�ްԽð�1", true, true, false)) {	
					set.SetItem("Text",frm.rest1.value );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("�ްԽð�2", true, true, false)) {	
					set.SetItem("Text",frm.rest2.value );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("�ްԽð�3", true, true, false)) {	
					set.SetItem("Text",frm.rest3.value );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("������", true, true, false)) {	
					set.SetItem("Text",frm.hday.value );
					act.Execute(set);
				}
				if(pHwpCtrl.MoveToField("��������", true, true, false)){set.SetItem("Text",frm.new_hday.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("��������", true, true, false)){set.SetItem("Text",frm.new_holiday.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("�����ް�", true, true, false)){set.SetItem("Text",frm.new_vacation.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("�����ް�", true, true, false)){set.SetItem("Text",frm.new_celebrate_mourn.value);act.Execute(set);}

				if(pHwpCtrl.MoveToField("����", true, true, false)){set.SetItem("Text",frm.holiday1.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("�߼�", true, true, false)){set.SetItem("Text",frm.holiday2.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("����", true, true, false)){set.SetItem("Text",frm.holiday3.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("����1", true, true, false)){set.SetItem("Text",frm.hday1.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("����2", true, true, false)){set.SetItem("Text",frm.hday2.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("����3", true, true, false)){set.SetItem("Text",frm.hday3.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("����4", true, true, false)){set.SetItem("Text",frm.hday4.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("����5", true, true, false)){set.SetItem("Text",frm.hday5.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("����6", true, true, false)){set.SetItem("Text",frm.hday6.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("����7", true, true, false)){set.SetItem("Text",frm.hday7.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("����8", true, true, false)){set.SetItem("Text",frm.hday8.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("�ϱ��ް�", true, true, false)){set.SetItem("Text",frm.summer_vacation.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("�����ް�1", true, true, false)){set.SetItem("Text",frm.celebrate_mourn1.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("�����ް�2", true, true, false)){set.SetItem("Text",frm.celebrate_mourn2.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("�����ް�3", true, true, false)){set.SetItem("Text",frm.celebrate_mourn3.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("�����ް�4", true, true, false)){set.SetItem("Text",frm.celebrate_mourn4.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("�����ް�5", true, true, false)){set.SetItem("Text",frm.celebrate_mourn5.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("�����ް�6", true, true, false)){set.SetItem("Text",frm.celebrate_mourn6.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("�����ް�7", true, true, false)){set.SetItem("Text",frm.celebrate_mourn7.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("�����ް�8", true, true, false)){set.SetItem("Text",frm.celebrate_mourn8.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("�����ް�9", true, true, false)){set.SetItem("Text",frm.celebrate_mourn9.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("�����ް�10", true, true, false)){set.SetItem("Text",frm.celebrate_mourn10.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("�����ް�11", true, true, false)){set.SetItem("Text",frm.celebrate_mourn11.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("�����ް�12", true, true, false)){set.SetItem("Text",frm.celebrate_mourn12.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("�����ް�13", true, true, false)){set.SetItem("Text",frm.celebrate_mourn13.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("�����ް�14", true, true, false)){set.SetItem("Text",frm.celebrate_mourn14.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("�ӱݰ��Ⱓ", true, true, false)){set.SetItem("Text",frm.pay_calculate_day_period.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("����󿩱�", true, true, false)){set.SetItem("Text",frm.bonus.value);act.Execute(set);}
				if(pHwpCtrl.MoveToField("����", true, true, false)){set.SetItem("Text",frm.retirement_age_rule.value);act.Execute(set);}

				if(pHwpCtrl.MoveToField("�Ӹ���", true, true, false)){set.SetItem("Text",frm.comp_name.value);act.Execute(set);}
			}
			break;
		case 'rule2':
			if(!pHwpCtrl.Open(BasePath + "/files/docs/rule_2.hwp")){

				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}else{
				if (pHwpCtrl.MoveToField("[������]", true, true, false)) {	
					set.SetItem("Text",frm.comp_name.value );
					act.Execute(set);
				}

				if (pHwpCtrl.MoveToField("[���������]", true, true, false)) {	
					set.SetItem("Text",frm.comp_upte.value );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("[��ǥ�ڼ���]", true, true, false)) {	
					set.SetItem("Text",frm.comp_ceo.value );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("[�ٷ��ڼ�]", true, true, false)) {	
					set.SetItem("Text",frm.employee.value );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("[�뵿���տ�]", true, true, false)) {	
					set.SetItem("Text",frm.union.value );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("[����]", true, true, false)) {	
					set.SetItem("Text",frm.women.value );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("[������]", true, true, false)) {	
					set.SetItem("Text",frm.comp_addr1.value+'  '+frm.comp_addr2.value );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("[��ȭ��ȣ]", true, true, false)) {	
					set.SetItem("Text",frm.comp_tel.value );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("[�Ű���]", true, true, false)) {	
					set.SetItem("Text",frm.comp_ceo.value );
					act.Execute(set);
				}
				if (pHwpCtrl.MoveToField("[�븮��]", true, true, false)) {	
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
				if (pHwpCtrl.MoveToField("[��¥�Է�]", true, true, false)) {	
					set.SetItem("Text",toDay );
					act.Execute(set);
				}

			}
			break;
		case 'rule3':
			//if(!pHwpCtrl.Open(BasePath + "/files/docs/�����Ģ_�ǰ�û��׵��Ǽ�.hwp")){
			if(!pHwpCtrl.Open(BasePath + "/files/docs/rule_3.hwp")){

				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}else{
				if (pHwpCtrl.MoveToField("[ȸ���]", true, true, false)) {	
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
				if (pHwpCtrl.MoveToField("[��¥�Է�]", true, true, false)) {	
					set.SetItem("Text",toDay );
					act.Execute(set);
				}

			}
			break;
		default:
			if(!pHwpCtrl.Open(BasePath + "/files/docs/default.hwp")){
				alert("���ϰ�ΰ� �߸� ������ �� �����ϴ�. ���ϰ�θ� Ȯ���Ͽ� �ּ���");
			}else{
				if (pHwpCtrl.MoveToField("[ȸ����]", true, true, false)) {	
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
		alert('Active X�� �������� �ʴ� ������������ �ѱ���Ʈ���� ����� �� �����ϴ�!');
		location.href='./';
	}
});