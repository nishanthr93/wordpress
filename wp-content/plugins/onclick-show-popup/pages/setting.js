function OnclickShowPopup_submit()
{
	if(document.OnclickShowPopup_form.OnclickShowPopup_title.value=="")
	{
		alert(OnclickShowPopup_adminscripts.OnclickShowPopup_title);
		document.OnclickShowPopup_form.OnclickShowPopup_title.focus();
		return false;
	}
	else if(document.OnclickShowPopup_form.OnclickShowPopup_text.value=="")
	{
		alert(OnclickShowPopup_adminscripts.OnclickShowPopup_text);
		document.OnclickShowPopup_form.OnclickShowPopup_text.focus();
		return false;
	}
	else if(document.OnclickShowPopup_form.OnclickShowPopup_status.value == "" || document.OnclickShowPopup_form.OnclickShowPopup_status.value == "Select")
	{
		alert(OnclickShowPopup_adminscripts.OnclickShowPopup_status);
		document.OnclickShowPopup_form.OnclickShowPopup_status.focus();
		return false;
	}
	else if(document.OnclickShowPopup_form.OnclickShowPopup_group.value == "" || document.OnclickShowPopup_form.OnclickShowPopup_group.value == "Select")
	{
		alert(OnclickShowPopup_adminscripts.OnclickShowPopup_group);
		document.OnclickShowPopup_form.OnclickShowPopup_group.focus();
		return false;
	}
}

function OnclickShowPopup_delete(id)
{
	if(confirm(OnclickShowPopup_adminscripts.OnclickShowPopup_delete))
	{
		document.frm_OnclickShowPopup_display.action="options-general.php?page=onclick-show-popup&ac=del&did="+id;
		document.frm_OnclickShowPopup_display.submit();
	}
}	

function OnclickShowPopup_redirect()
{
	window.location = "options-general.php?page=onclick-show-popup";
}

function OnclickShowPopup_help()
{
	window.open("http://www.gopiplus.com/work/2011/12/17/wordpress-plugin-onclick-show-popup-for-content/");
}