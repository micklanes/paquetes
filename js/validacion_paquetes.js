"use strict"

function validar(){
    
    var remitente=document.formu.remitente.value;
    var telefono_remitente=document.formu.telefono_remitente.value;
    var origen=document.formu.origen.value;
    var destinatario=document.formu.destinatario.value;
    var telefono_destino=document.formu.telefono_destino.value;
    var destino=document.formu.destino.value;
    var direccion_destino=document.formu.direccion_destino.value;
    var peso=document.formu.peso.value;
    var fecha=document.formu.fecha.value;
    var precio=document.formu.precio.value;
    var descripcion=document.formu.descripcion.value;
    var num_guia=document.formu.num_guia.value;

    var tiposervicioID = document.formu.tiposervicioID.value;
    var clienteID = document.formu.clienteID.value;
    if(clienteID==""){
        alert("SELECCIONE UN CLIENTE");
        document.formu.clienteID.focus();
        return;
    }
    if(tiposervicioID==""){
        alert("SELECCIONE UN TIPO DE SERVICIO");
        document.formu.tiposervicioID.focus();
        return;
    }
    
    if(remitente==""){
        alert("REMITENTE NECESARIO");
        document.formu.remitente.focus();
        return;
    }else{
        if(!v1.test(remitente)){
            alert("REMITENTE INCORRECTO");
            document.formu.remitente.focus();
            return;
            }
    }
    if(remitente==""){
        alert("CEDULA DE IDENTIDAD NECESARIA");
        document.formu.remitente.focus();
        return;
    }else{
        if(!v1.test(remitente)){
            alert("REMITENTE INCORRECTO");
            document.formu.remitente.focus();
            return;
            }
    }
    if(telefono_remitente==""){
        alert("TELEFONO NECESARIO");
        document.formu.telefono_remitente.focus();
        return;
    }
    if(origen==""){
        alert("ORIGEN NECESARIO");
        document.formu.origen.focus();
        return;
    }
    if(destinatario==""){
        alert("DESTINATARIO NECESARIO");
        document.formu.destinatario.focus();
        return;
        
    }else{
        if(!v1.test(destinatario)){
            alert("DESTINATARIO INCORRECTO");
            document.formu.destinatario.focus();
            return;
            }
    }
    if(telefono_destino==""){
        alert("TELEFONO NECESARIO");
        document.formu.telefono_destino.focus();
        return;
    }
    if(destino==""){
        alert("DESTINO NECESARIO");
        document.formu.destino.focus();
        return;
        
    }else{
        if(!v1.test(destino)){
            alert("CAMPO DESTINO INCORRECTO");
            document.formu.destino.focus();
            return;
            }
    }
    if(direccion_destino==""){
        alert("DIRECCIÓN DEL DESTINO OBLIGATORIO");
        document.formu.direccion_destino.focus();
        return;
    }
    if(peso==""){
        alert("PESO OBLIGATORIO");
        document.formu.peso.focus();
        return;
    }else{
        if(!v22.test(peso)){
            alert("CAMPO PESO INCORRECTO");
            document.formu.peso.focus();
            return;
            }
    }
    if(fecha==""){
        alert("FECHA OBLIGATORIO");
        document.formu.fecha.focus();
        return;
    }
    if(precio==""){
        alert("PRECIO OBLIGATORIO");
        document.formu.precio.focus();
        return;
    }else{
        if(!v22.test(precio)){
            alert("CAMPO PRECIO INCORRECTO");
            document.formu.precio.focus();
            return;
            }
    }
    if(descripcion==""){
        alert("DESCRIPCION OBLIGATORIO");
        document.formu.descripcion.focus();
        return;
    }
    if(num_guia==""){
        alert("NÚMERO DE GUIA OBLIGATORIO");
        document.formu.num_guia.focus();
        return;
    }else{
        if(!v2.test(num_guia)){
            alert("NÚMERO DE GUIA INCORRECTO");
            document.formu.num_guia.focus();
            return;
            }
    }

    document.formu.submit();
    alert("DATOS CORRECTOS");
}