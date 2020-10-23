function obj2str(data) {
    data.t=new Date().getTime();
    var res=[];
    for(var key in data){
        res.push(encodeURIComponent(key)+"="+encodeURIComponent(data[key]));
    }
    return res.join("&");
}

function ajax(option) {
    var str=obj2str(option.data);
    var xmlhttp;
    var timer=0;
    if(window.XMLHttpRequest){
        xmlhttp=new XMLHttpRequest();
    }else{
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    if(option.type.toLowerCase()==="get"){
        xmlhttp.open(option.type, option.url+"?"+str, true);
        xmlhttp.send();
    }else{
        xmlhttp.open(option.type, option.url, true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xmlhttp.send(str);
    }
    xmlhttp.onreadystatechange = function (ev2) {
        if (xmlhttp.readyState === 4) {
            clearInterval(timer);
            if (xmlhttp.status >= 200 && xmlhttp.status < 300 || xmlhttp.status === 304) {
                option.success(xmlhttp);
            } else {
                option.error(xmlhttp);
            }
        }
    }
    if(option.timeout){
        timer=setInterval(function () {
            console.log("中断请求");
            xmlhttp.abort();
            clearInterval(timer);
        },option.timeout);
    }
}