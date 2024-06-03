       
                   
function checkBoxButtonFuntion(termCheckBox) {
    if (termCheckBox.checked) {
        document.getElementById("btnContinue").disabled = false;
    } else {
        document.getElementById("btnContinue").disabled = true;
    }
}
