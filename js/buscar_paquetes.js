"use strict"
function buscar_personas(){
    var d1,d2,d3,d4,d11,ajax,url,param,contenedor;
    contenedor = document.getElementById('paquetes1');
    d1=document.formu.num_guia.value;
    if(d1.length==0){
        d1='%';
    }
    d2=document.formu.destinatario.value;
    d3=document.formu.destino.value;
    d4=document.formu.estado.value;

    //alert(d5);
    ajax=nuevoAjax();
    url="ajax_buscar_paquete.php";
    param="num_guia="+d1+"&destinatario="+d2+"&destino="+d3+"&estado="+d4;
    //alert(param);
    ajax.open("POST",url,true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajax.onreadystatechange=function(){
        if(ajax.readyState==4){
            contenedor.innerHTML=ajax.responseText;
        }
    }
    ajax.send(param);
}