                   
function CHKBUTTON(){                            
    if(document.getElementById("checkBox").checked == true){
        document.getElementById("btnContinue").disabled = false;
    }
    else{
        document.getElementById("btnContinue").disabled = true;
    }
}

