function OnSubmitForm(url){
    document.appForm.action = url;
    document.appForm.submit();
    return true;
}