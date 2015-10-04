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