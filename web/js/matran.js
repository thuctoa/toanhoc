function bieuthuc(iddangxet) {
    var str = document.getElementById(iddangxet).value;
    var len=str.length;
    for(i=0;i<len;i++){
        if(kytuhoplebieuthuc(str.charAt(i))==false){
            document.getElementById(iddangxet).value='';
            break;
        }
    }
}
function kytuhoplebieuthuc(kytu){
    switch(kytu){
        case '0':
        case '1':
        case '2':
        case '3':
        case '4':
        case '5':
        case '6':
        case '7':
        case '8':
        case '9':
        case '*':
        case ' ':
        case '/':
        case '+':
        case '-': 
        case '(': 
        case ')': 
        case '.': 
            return true;
        default :
                return false;
    }
}
function dongcuamatranb(){
    document.getElementById('mb').value=document.getElementById('na').value;

}

function dongcuamatrana(){
    document.getElementById('na').value=document.getElementById('mb').value;

}
if(document.getElementById('sobac')){
    var sobac=document.getElementById('sobac').value;

    for(var i=0;i<sobac;i++){
        for(var j=0;j<sobac;j++){
            str=document.getElementById('p'+i+j);
            if(str.value.length!=0){
                str.style.width = ((str.value.length + 1) * 8+10) + 'px';
            }
        }
    }
}

if(document.getElementById('nghiemdathuc')){
    var sobac=document.getElementById('nghiemdathuc').value;
    if(sobac>0){
        for(var i=0;i<=sobac;i++){
            str=document.getElementById('a'+i);
            if(str.value.length!=0){
                str.style.width = ((str.value.length + 1) * 8+10) + 'px';
            }
        }
    }
}
if(document.getElementById('nhanhaidathuc')){
    var n1=document.getElementById('n1').value;
    if(n1>0){
        for(var i=0;i<=n1;i++){
            str=document.getElementById('a'+i);
            if(str.value.length!=0){
                str.style.width = ((str.value.length + 1) * 8+10) + 'px';
            }
        }
    }
    var n2=document.getElementById('n2').value;
    if(n2>0){
        for(var i=0;i<=n2;i++){
            str=document.getElementById('b'+i);
            if(str.value.length!=0){
                str.style.width = ((str.value.length + 1) * 8+10) + 'px';
            }
        }
    }
}

if(document.getElementById('soan')){
    var sobac=document.getElementById('soan').value;

    for(var i=0;i<sobac;i++){
        for(var j=0;j<sobac;j++){
            str=document.getElementById('a'+i+j);
            if(str.value.length!=0){
                str.style.width = ((str.value.length + 1) * 8+10) + 'px';
            }
        }
        str=document.getElementById('b'+i);
        if(str.value.length!=0){
            str.style.width = ((str.value.length + 1) * 8+10) + 'px';
        }
    }
}
