// JavaScript Document

// CREO ESTE METODO PARA PODER ELIMINAR LOS ESPACIOS EN BLANCOS AL PRINCIPIO Y AL FINAL DE CADA CAMPO 
String.prototype.trim = function () {
    return this.replace(/^\s+|\s+$/g, '')
}

var MAXLIMIT = 20;

//	FUNCION QUE ME PERMITE CREAR UN NUEVO OBJETO AJAX
function nuevoAjax() {
    // Crea el objeto AJAX.
    var xmlhttp = false;
    try {
        // Creacion del objeto AJAX para navegadores no IE
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    }
    catch (e) {
        try {
            // Creacion del objeto AJAX para IE
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        catch (E) {
            xmlhttp = false;
        }
    }
    if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}

//	FUNCION QUE CAMBIA DE COLOR LA FILA DE UNA TABLA AL HACER CLICK EL PUNTERO DEL MOUSE SOBRE ELLA
function mClk(src, registro) {
    var seleccionado = document.getElementsByTagName("tr");
    for (var i = 0; i < seleccionado.length; i++) {
        if (seleccionado[i].getAttribute((document.all ? 'className' : 'class')) == 'grillaTrSel') {
            seleccionado[i].setAttribute((document.all ? 'className' : 'class'), "grillaTr");
            break;
        }
    }
    //
    var row = document.getElementById(src.id);	//	OBTENGO LA FILA DEL CLICK
    row.className = "grillaTrSel";	//	CAMBIO EL COLOR DE LA FILA
    //
    var registro = document.getElementById(registro);
    registro.value = src.id;
}

//	FUNCION QUE CAMBIA DE COLOR LA FILA DE UNA TABLA AL HACER CLICK EL PUNTERO DEL MOUSE SOBRE ELLA
function mClk2(src, registro, valor2) {
    var seleccionado = document.getElementsByTagName("tr");
    for (var i = 0; i < seleccionado.length; i++) {
        if (seleccionado[i].getAttribute((document.all ? 'className' : 'class')) == 'grillaTrSel') {
            seleccionado[i].setAttribute((document.all ? 'className' : 'class'), "grillaTr");
            break;
        }
    }
    //
    var row = document.getElementById(src.id);	//	OBTENGO LA FILA DEL CLICK
    row.className = "grillaTrSel";	//	CAMBIO EL COLOR DE LA FILA
    //
    var registro = document.getElementById(registro);
    registro.value = src.id + ":" + valor2;
}

//	FUNCION QUE IMPRIME EL NUMERO DE REGISTROS
function totalRegistros(rows) {
    var numreg = document.getElementById("rows");
    numreg.innerHTML = "Registros: " + rows;
}

//	FUNCION QUE IMPRIMIE LA CANTIDAD DEL LOTE QUE SE MUESTRA
function totalLotes(registros, rows, limit) {
    var desde = document.getElementById("desde");
    var hasta = document.getElementById("hasta");
    var btPrimera = document.getElementById("btPrimera");
    var btAnterior = document.getElementById("btAnterior");
    var btSiguiente = document.getElementById("btSiguiente");
    var btUltima = document.getElementById("btUltima");
    if (registros) {
        if (limit == 0) {
            btPrimera.src = "../imagenes/primera_d.png";
            btPrimera.onclick = "";
            btAnterior.src = "../imagenes/anterior_d.png";
            btAnterior.onclick = "";
        } else {
            btPrimera.src = "../imagenes/primera.png";
            btAnterior.src = "../imagenes/anterior.png";
        }
        //
        if ((registros <= MAXLIMIT) || ((limit + rows) == registros) || (limit == registros)) {
            btSiguiente.src = "../imagenes/proxima_d.png";
            btSiguiente.onclick = "";
            btUltima.src = "../imagenes/ultima_d.png";
            btUltima.onclick = "";
        }
        else {
            btSiguiente.src = "../imagenes/proxima.png";
            btUltima.src = "../imagenes/ultima.png";
        }
        //
        desde.innerHTML = limit + 1;
        hasta.innerHTML = limit + rows;
    } else {
        desde.innerHTML = 0;
        hasta.innerHTML = 0;
    }
}

// FUNCION QUE MUESTRA EL LOTE CORREPONDIENTE
function setLotes(lote, registros, limit, pagina) {
    switch (lote) {
        case "P":
            limit = 0;
            break;
        case "A":
            limit = limit - MAXLIMIT;
            break;
        case "S":
            limit = limit + MAXLIMIT;
            break;
        case "U":
            var num = (registros / MAXLIMIT);
            num = parseInt(num);
            limit = num * MAXLIMIT;
            if (limit == registros) limit = limit - MAXLIMIT;
            break;
    }
    document.getElementById("frmEntrada").action = pagina + "?accion=LISTAR&limit=" + limit;
    document.getElementById("frmEntrada").submit();
}

//	FUNCION PARA CARGAR UNA PAGINA
function cargarPagina(pagina) {
    document.getElementById("frmEntrada").action = pagina;
    document.getElementById("frmEntrada").submit();
}

//	FUNCION PARA EDITAR UN REGISTRO
function editarRegistro(pagina) {
    var registro = document.getElementById("registro").value;
    if (registro == "") msjError(1010);
    else {
        pagina = pagina + "?accion=EDITAR&registro=" + registro;
        cargarPagina(pagina);
    }
}

//	FUNCION PARA EDITAR UN REGISTRO
function verRegistro(pagina) {
    var registro = document.getElementById("registro").value;
    if (registro == "") msjError(1010);
    else {
        pagina = pagina + "?accion=VER&registro=" + registro;
        cargarPagina(pagina);
    }
}

//	FUNCION PARA EDITAR UN REGISTRO
function eliminarRegistro(pagina, maestro) {
    var registro = document.getElementById("registro").value;
    if (registro == "") msjError(1010);
    else {
        var eliminar = confirm("¿Está seguro de eliminar este registro?");
        if (eliminar) {
            //	CREO UN OBJETO AJAX PARA GUARDAR LOS DATOS EN LA BASE DE DATOS
            var ajax = nuevoAjax();
            ajax.open("POST", "../lib/fphp.php", true);
            ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            ajax.send("maestro=" + maestro + "&accion=ELIMINAR" + "&registro=" + registro);
            ajax.onreadystatechange = function () {
                if (ajax.readyState == 4) {
                    if (ajax.responseText == "EXITO") {
                        cargarPagina(pagina + "?accion=LISTAR&limit=0");
                    } else msjError(ajax.responseText);
                }
            }
        }
    }
}

//	FUNCION PARA CARGAR EN UN SELECT LO SELECCIONADO EN OTRO SELECT (2 SELECTS)
function getOptions_2(idSelectOrigen, idSelectDestino) {
    var selectOrigen = document.getElementById(idSelectOrigen);
    var optSelectOrigen = selectOrigen.options[selectOrigen.selectedIndex].value;
    var selectDestino = document.getElementById(idSelectDestino);
    if (optSelectOrigen == "") {
        selectDestino.length = 0;
        nuevaOpcion = document.createElement("option");
        nuevaOpcion.value = "";
        nuevaOpcion.innerHTML = "";
        selectDestino.appendChild(nuevaOpcion);
        selectDestino.disabled = true;
    } else {
        //	CREO UN OBJETO AJAX PARA VERIFICAR QUE EL NUEVO REGISTRO NO EXISTA EN LA BASE DE DATOS
        var ajax = nuevoAjax();
        ajax.open("POST", "http://localhost/sia2/lib/select_ajax.php", true);
        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        ajax.send("accion=getOptions_2&tabla=" + idSelectDestino + "&opcion=" + optSelectOrigen);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 1) {
                // Mientras carga elimino la opcion "" y pongo una que dice "Cargando..."
                selectDestino.length = 0;
                var nuevaOpcion = document.createElement("option");
                nuevaOpcion.value = "";
                nuevaOpcion.innerHTML = "Cargando...";
                selectDestino.appendChild(nuevaOpcion);
                selectDestino.disabled = true;
            }
            if (ajax.readyState == 4) {
                selectDestino.parentNode.innerHTML = ajax.responseText;
            }
        }
    }
}

//	FUNCION PARA CARGAR EN UN SELECT LO SELECCIONADO EN OTRO SELECT (3 SELECTS)
function getOptions_3(idSelectOrigen, idSelectDestino, idSelect3) {
    var selectOrigen = document.getElementById(idSelectOrigen);
    var optSelectOrigen = selectOrigen.options[selectOrigen.selectedIndex].value;
    var selectDestino = document.getElementById(idSelectDestino);
    nuevaOpcion = document.createElement("option");
    nuevaOpcion.value = "";
    nuevaOpcion.innerHTML = "";
    var select3 = document.getElementById(idSelect3);
    select3.length = 0;
    select3.appendChild(nuevaOpcion);
    select3.disabled = true;
    if (optSelectOrigen == "") {
        selectDestino.length = 0;
        selectDestino.appendChild(nuevaOpcion);
        selectDestino.disabled = true;
    } else {
        //	CREO UN OBJETO AJAX PARA VERIFICAR QUE EL NUEVO REGISTRO NO EXISTA EN LA BASE DE DATOS
        var ajax = nuevoAjax();
        ajax.open("POST", "http://localhost/sia2/lib/select_ajax.php", true);
        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        ajax.send("accion=getOptions_3&tabla=" + idSelectDestino + "&opcion=" + optSelectOrigen);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 1) {
                // Mientras carga elimino la opcion "" y pongo una que dice "Cargando..."
                selectDestino.length = 0;
                var nuevaOpcion = document.createElement("option");
                nuevaOpcion.value = "";
                nuevaOpcion.innerHTML = "Cargando...";
                selectDestino.appendChild(nuevaOpcion);
                selectDestino.disabled = true;
            }
            if (ajax.readyState == 4) {
                selectDestino.parentNode.innerHTML = ajax.responseText;
            }
        }
    }
}

//	FUNCION PARA CARGAR EN UN SELECT LO SELECCIONADO EN OTRO SELECT (4 SELECTS)
function getOptions_4(idSelectOrigen, idSelectDestino, idSelect3, idSelect4) {
    var selectOrigen = document.getElementById(idSelectOrigen);
    var optSelectOrigen = selectOrigen.options[selectOrigen.selectedIndex].value;
    var selectDestino = document.getElementById(idSelectDestino);
    nuevaOpcion = document.createElement("option");
    nuevaOpcion.value = "";
    nuevaOpcion.innerHTML = "";
    var select3 = document.getElementById(idSelect3);	//---------
    select3.length = 0;	//---------
    select3.appendChild(nuevaOpcion);	//---------
    select3.disabled = true;	//---------
    var select4 = document.getElementById(idSelect4);	//---------
    select4.length = 0;	//---------
    select4.appendChild(nuevaOpcion);	//---------
    select4.disabled = true;	//---------
    if (optSelectOrigen == "") {
        selectDestino.length = 0;
        selectDestino.appendChild(nuevaOpcion);
        selectDestino.disabled = true;
    } else {
        //	CREO UN OBJETO AJAX PARA VERIFICAR QUE EL NUEVO REGISTRO NO EXISTA EN LA BASE DE DATOS
        var ajax = nuevoAjax();
        ajax.open("POST", "http://localhost/sia2/lib/select_ajax.php", true);
        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        ajax.send("accion=getOptions_4&tabla=" + idSelectDestino + "&opcion=" + optSelectOrigen);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 1) {
                // Mientras carga elimino la opcion "" y pongo una que dice "Cargando..."
                selectDestino.length = 0;
                var nuevaOpcion = document.createElement("option");
                nuevaOpcion.value = "";
                nuevaOpcion.innerHTML = "Cargando...";
                selectDestino.appendChild(nuevaOpcion);
                selectDestino.disabled = true;
            }
            if (ajax.readyState == 4) {
                selectDestino.parentNode.innerHTML = ajax.responseText;
            }
        }
    }
}

//	FUNCION PARA MOSTRAR MENSAJES DE ERROR
function msjError(error) {
    switch (error) {
        case 1000:
            alert("¡Debe llenar los campos obligatorios!");
            break;
        case 1010:
            alert("¡Debe seleccionar un registro!");
            break;
        case 1020:
            alert("¡No puede ingresar el mismo equipo mas de una vez en un encuentro!");
            break;
        default:
            alert(error);
            break;
    }
}


//	Validaciones de Formularios
//	----------------------------------------------------------------------------------	//
//	FUNCION PARA VALIDAR EL FORMULARIO DE PREGUNTAS Y RESPUESTAS
function validarPreguntas(accion) {
    var numero = document.getElementById("numero").value;
    numero = numero.trim();
    var pregunta = document.getElementById("pregunta").value;
    pregunta = pregunta.trim();
    var a = document.getElementById("a").value;
    a = a.trim();
    var b = document.getElementById("b").value;
    b = b.trim();
    var c = document.getElementById("c").value;
    c = c.trim();
    var d = document.getElementById("d").value;
    d = d.trim();
    var respuesta = document.getElementById("respuesta").value;
    respuesta = respuesta.trim();
    var puntos = document.getElementById("puntos").value;
    puntos = puntos.trim();
    var ronda = document.getElementById("ronda").value;
    ronda = ronda.trim();
    if (pregunta == "0" || a == "0" || b == "0" || c == "0" || d == "0" || respuesta == "0" || puntos == "0") msjError(1000);
    else {
        //	CREO UN OBJETO AJAX PARA GUARDAR LOS DATOS EN LA BASE DE DATOS
        var ajax = nuevoAjax();
        ajax.open("POST", "../lib/fphp.php", true);
        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        ajax.send("maestro=PREGUNTAS&accion=" + accion + "&numero=" + numero + "&pregunta=" + pregunta + "&a=" + a + "&b=" + b + "&c=" + c + "&d=" + d + "&respuesta=" + respuesta + "&puntos=" + puntos + "&ronda=" + ronda);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4) {
                if (ajax.responseText == "EXITO") {
                    cargarPagina("preguntas.php?accion=LISTAR&limit=0");
                } else msjError(ajax.responseText);
            }
        }
    }
    return false;
}

//	FUNCION PARA VALIDAR EL FORMULARIO DE EQUIPOS
function validarEquipos(accion) {
    var numero = document.getElementById("numero").value;
    numero = numero.trim();
    var equipo = document.getElementById("equipo").value;
    equipo = equipo.trim();
    var logo = document.getElementById("logo").value;
    equipo = equipo.trim();
    if (equipo == "0") msjError(1000);
    else {
        //	CREO UN OBJETO AJAX PARA GUARDAR LOS DATOS EN LA BASE DE DATOS
        var ajax = nuevoAjax();
        ajax.open("POST", "../lib/fphp.php", true);
        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        ajax.send("maestro=EQUIPOS&accion=" + accion + "&numero=" + numero + "&equipo=" + equipo + "&logo=" + logo);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4) {
                if (ajax.responseText == "EXITO") {
                    cargarPagina("equipos.php?accion=LISTAR&limit=0");
                } else msjError(ajax.responseText);
            }
        }
    }
    return false;
}

//	FUNCION PARA VALIDAR EL FORMULARIO DE ENCUENTROS
function validarEncuentros(accion) {
    var numero = document.getElementById("encuentro").value;
    numero = numero.trim();
    var equipo1 = document.getElementById("equipo1").value;
    equipo1 = equipo1.trim();
    var equipo2 = document.getElementById("equipo2").value;
    equipo2 = equipo2.trim();
    var equipo3 = document.getElementById("equipo3").value;
    equipo3 = equipo3.trim();
    var ronda = document.getElementById("ronda").value;
    ronda = ronda.trim();
    if (equipo1 == "0" || equipo2 == "0") msjError(1000);
    else if ((equipo1 == equipo2) || (equipo1 == equipo3) || (equipo2 == equipo3)) msjError(1020);
    else {
        //	CREO UN OBJETO AJAX PARA GUARDAR LOS DATOS EN LA BASE DE DATOS
        var ajax = nuevoAjax();
        ajax.open("POST", "../lib/fphp.php", true);
        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        ajax.send("maestro=ENCUENTROS&accion=" + accion + "&numero=" + numero + "&equipo1=" + equipo1 + "&equipo2=" + equipo2 + "&equipo3=" + equipo3 + "&ronda=" + ronda);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4) {
                if (ajax.responseText == "EXITO") {
                    cargarPagina("encuentros.php?accion=LISTAR&limit=0");
                } else msjError(ajax.responseText);
            }
        }
    }
    return false;
}

//	FUNCION PARA VALIDAR EL FORMULARIO DE PARAMETROS
function validarParametros(accion) {
    var parametro = document.getElementById("parametro").value;
    parametro = parametro.trim();
    var descripcion = document.getElementById("descripcion").value;
    descripcion = descripcion.trim();
    var valor = document.getElementById("valor").value;
    valor = valor.trim();
    if (parametro == "" || descripcion == "" || valor == "") msjError(1000);
    else {
        //	CREO UN OBJETO AJAX PARA GUARDAR LOS DATOS EN LA BASE DE DATOS
        var ajax = nuevoAjax();
        ajax.open("POST", "../lib/fphp.php", true);
        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        ajax.send("maestro=PARAMETROS&accion=" + accion + "&parametro=" + parametro + "&descripcion=" + descripcion + "&valor=" + valor);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4) {
                if (ajax.responseText == "EXITO") {
                    cargarPagina("parametros.php?accion=LISTAR&limit=0");
                } else msjError(ajax.responseText);
            }
        }
    }
    return false;
}

function procesarPregunta(pregunta) {
    //-

    var divSonido = document.getElementById("divSonido");
    divSonido.innerHTML = "<embed src='../imagenes/sonido/pregunta.mp3' autostart='true' loop='false' hidden='true'>";
    //-
    var ronda = document.getElementById("ronda").value;
    var turno = document.getElementById("turno").value;
    var status = document.getElementById("status").value;
    var encuentro = document.getElementById("encuentro").value;
    if (turno == 1) var tequipo = "equipo1";
    if (turno == 2) var tequipo = "equipo2";
    if (turno == 3) var tequipo = "equipo3";
    var equipo = document.getElementById(tequipo).value;

    if (status != 1) {
        //	CREO UN OBJETO AJAX PARA GUARDAR LOS DATOS EN LA BASE DE DATOS
        var ajax = nuevoAjax();
        ajax.open("POST", "../lib/fphp.php", true);
        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        ajax.send("maestro=JUEGO&accion=SELECCION&ronda=" + ronda + "&pregunta=" + pregunta + "&equipo=" + equipo + "&encuentro=" + encuentro);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 1) {
                document.getElementById("divCargando").style.display = "block";
            }
            if (ajax.readyState == 4) {
                var respuesta = ajax.responseText;
                var valores = respuesta.split("::");
                if (valores[0] == "EXITO") {

                    document.getElementById("divPregunta").innerHTML = valores[1];
                    document.getElementById("divOpcionA").innerHTML = valores[2];
                    document.getElementById("divOpcionB").innerHTML = valores[3];
                    document.getElementById("divOpcionC").innerHTML = valores[4];
                    document.getElementById("divOpcionD").innerHTML = valores[5];
                    document.getElementById("respuesta").value = valores[6];
                    document.getElementById("puntos").value = valores[7];
                    document.getElementById("pregunta").value = valores[8];
                    document.getElementById("status").value = 1;
                    document.getElementById("divContador").style.display = "block";
                    document.getElementById(pregunta).style.color = "#FF0000";
                    document.getElementById(pregunta).disabled = true;
                    document.getElementById("btAnular").disabled = false;
                    document.getElementById("btAnularPregunta").disabled = false;
                } else msjError(ajax.responseText);
            }
        }
    } else {
        alert("¡Acción inválida! \nPregunta en proceso...");
    }
}

function procesarRespuesta() {
    document.getElementById("respondido").value = 1;
    var responder = document.getElementById("responder").value;
    var respuesta = document.getElementById("respuesta").value;
    var ronda = document.getElementById("ronda").value;
    var pregunta = document.getElementById("pregunta").value;
    var turno = document.getElementById("turno").value;
    var status = document.getElementById("status").value;
    var encuentro = document.getElementById("encuentro").value;
    var equipo3 = document.getElementById("equipo3").value;
    document.getElementById("btResponder").disabled = true;
    if (turno == 1) {
        var tequipo = "equipo1";
        var puntos = "divPuntos1";
        var turnos = "divTurnos1";
    }
    if (turno == 2) {
        var tequipo = "equipo2";
        var puntos = "divPuntos2";
        var turnos = "divTurnos2";
    }
    if (turno == 3) {
        var tequipo = "equipo3";
        var puntos = "divPuntos3";
        var turnos = "divTurnos3";
    }
    var equipo = document.getElementById(tequipo).value;
    if (respuesta == "A") document.getElementById("imgStatusA").src = "../imagenes/correcta.png";
    else if (respuesta == "B") document.getElementById("imgStatusB").src = "../imagenes/correcta.png";
    else if (respuesta == "C") document.getElementById("imgStatusC").src = "../imagenes/correcta.png";
    else if (respuesta == "D") document.getElementById("imgStatusD").src = "../imagenes/correcta.png";
    //
    if (respuesta != responder) {
        //-
        var divSonido = document.getElementById("divSonido");
        divSonido.innerHTML = "<embed src='../imagenes/sonido/burro.mp3' autostart='true' loop='false' hidden='true'>";
        //-
        if (responder == "A") document.getElementById("imgStatusA").src = "../imagenes/incorrecta.png";
        else if (responder == "B") document.getElementById("imgStatusB").src = "../imagenes/incorrecta.png";
        else if (responder == "C") document.getElementById("imgStatusC").src = "../imagenes/incorrecta.png";
        else if (responder == "D") document.getElementById("imgStatusD").src = "../imagenes/incorrecta.png";
        var acierto = "N";
    } else {
        //-
        var divSonido = document.getElementById("divSonido");
        divSonido.innerHTML = "<embed src='../imagenes/sonido/aplausos.mp3' autostart='true' loop='false' hidden='true'>";
        //-
        var acierto = "S";
    }
    //	CREO UN OBJETO AJAX PARA GUARDAR LOS DATOS EN LA BASE DE DATOS
    var ajax = nuevoAjax();
    ajax.open("POST", "../lib/fphp.php", true);
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("maestro=JUEGO&accion=RESPUESTA&ronda=" + ronda + "&pregunta=" + pregunta + "&equipo=" + equipo + "&turno=" + turno + "&acierto=" + acierto + "&encuentro=" + encuentro + "&equipo3=" + equipo3 + "&turnos=" + turnos);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 1) {
            document.getElementById("divCargando").style.display = "block";
        }
        if (ajax.readyState == 4) {
            if (ajax.responseText == "EXITO") {
                document.getElementById("btSiguiente").disabled = false;
                if (acierto == "S") {
                    var puntaje = document.getElementById(puntos).innerHTML;
                    document.getElementById(puntos).innerHTML = parseInt(puntaje) + 1;
                }
                var sumturnos = document.getElementById(turnos).innerHTML;
                document.getElementById(turnos).innerHTML = parseInt(sumturnos) + 1;
                document.getElementById("btAnular").disabled = true;
                document.getElementById("btAnularPregunta").disabled = true;
            } else msjError(ajax.responseText);
        }
    }
}

function seleccionarOpcion(opcion) {
    if (document.getElementById("respondido").value == 0) {
        if (opcion == "A") {
            document.getElementById("trOpcionA").style.color = "#0028B3";
            document.getElementById("trOpcionB").style.color = "#000000";
            document.getElementById("trOpcionC").style.color = "#000000";
            document.getElementById("trOpcionD").style.color = "#000000";
            document.getElementById("responder").value = "A";
        }
        else if (opcion == "B") {
            document.getElementById("trOpcionA").style.color = "#000000";
            document.getElementById("trOpcionB").style.color = "#0028B3";
            document.getElementById("trOpcionC").style.color = "#000000";
            document.getElementById("trOpcionD").style.color = "#000000";
            document.getElementById("responder").value = "B";
        }
        else if (opcion == "C") {
            document.getElementById("trOpcionA").style.color = "#000000";
            document.getElementById("trOpcionB").style.color = "#000000";
            document.getElementById("trOpcionC").style.color = "#0028B3";
            document.getElementById("trOpcionD").style.color = "#000000";
            document.getElementById("responder").value = "C";
        }
        else if (opcion == "D") {
            document.getElementById("trOpcionA").style.color = "#000000";
            document.getElementById("trOpcionB").style.color = "#000000";
            document.getElementById("trOpcionC").style.color = "#000000";
            document.getElementById("trOpcionD").style.color = "#0028B3";
            document.getElementById("responder").value = "D";
        }
        document.getElementById("btResponder").disabled = false;
    } else {
        alert("¡Acción inválida!");
    }
}

function cambiarTurno() {
    var turno = document.getElementById("turno").value;
    var equipo3 = document.getElementById("equipo3").value;
    var desactivado = document.getElementById("btSiguiente").disabled;
    document.getElementById("respondido").value = 0;
    if (!desactivado) {
        if (turno == 1) {
            document.getElementById("divTurno1").style.color = "#000000";
            document.getElementById("imgTurno1").src = "../imagenes/mm_spacer.gif";
            document.getElementById("divTurno2").style.color = "#0028B3";
            document.getElementById("imgTurno2").src = "../imagenes/turno.png";
            document.getElementById("turno").value = 2;
        }
        if (turno == 2) {
            if (equipo3 == 0) {
                document.getElementById("turno").value = 1;
                document.getElementById("divTurno2").style.color = "#000000";
                document.getElementById("imgTurno2").src = "../imagenes/mm_spacer.gif";
                document.getElementById("divTurno1").style.color = "#0028B3";
                document.getElementById("imgTurno1").src = "../imagenes/turno.png";
            } else {
                document.getElementById("turno").value = 3;
                document.getElementById("divTurno2").style.color = "#000000";
                document.getElementById("imgTurno2").src = "../imagenes/mm_spacer.gif";
                document.getElementById("divTurno3").style.color = "#0028B3";
                document.getElementById("imgTurno3").src = "../imagenes/turno.png";
            }
        }
        if (turno == 3) {
            document.getElementById("divTurno3").style.color = "#000000";
            document.getElementById("imgTurno3").src = "../imagenes/mm_spacer.gif";
            document.getElementById("divTurno1").style.color = "#0028B3";
            document.getElementById("imgTurno1").src = "../imagenes/turno.png";
            document.getElementById("turno").value = 1;
        }
        document.getElementById("status").value = "0";
        document.getElementById("pregunta").value = "";
        document.getElementById("respuesta").value = "";
        document.getElementById("responder").value = "";
        document.getElementById("btSiguiente").disabled = true;
        document.getElementById("divPregunta").innerHTML = "";
        document.getElementById("divOpcionA").innerHTML = "";
        document.getElementById("divOpcionB").innerHTML = "";
        document.getElementById("divOpcionC").innerHTML = "";
        document.getElementById("divOpcionD").innerHTML = "";
        document.getElementById("imgStatusA").src = "../imagenes/mm_spacer.gif";
        document.getElementById("imgStatusB").src = "../imagenes/mm_spacer.gif";
        document.getElementById("imgStatusC").src = "../imagenes/mm_spacer.gif";
        document.getElementById("imgStatusD").src = "../imagenes/mm_spacer.gif";
        document.getElementById("trOpcionA").style.color = "#000000";
        document.getElementById("trOpcionB").style.color = "#000000";
        document.getElementById("trOpcionC").style.color = "#000000";
        document.getElementById("trOpcionD").style.color = "#000000";
        document.getElementById("divContador").style.display = "none";
        document.getElementById("btAnular").disabled = true;
        document.getElementById("btAnularPregunta").disabled = true;
    } else alert("¡Acción inválida! \nPregunta en proceso...");
}

function finEncuentro() {
    var status = document.getElementById("status").value;
    var ronda = document.getElementById("ronda").value;
    var encuentro = document.getElementById("encuentro").value;
    var equipo1 = document.getElementById("equipo1").value;
    var equipo2 = document.getElementById("equipo2").value;
    var equipo3 = document.getElementById("equipo3").value;
    var puntos1 = document.getElementById("divPuntos1").innerHTML;
    var puntos2 = document.getElementById("divPuntos2").innerHTML;
    if (equipo3 != 0) var puntos3 = document.getElementById("divPuntos3").innerHTML; else {
        var puntos3 = 0;
        equipo3 = 0;
    }

    if (status != 1) {
        if ((equipo3 != 0 && (puntos1 == puntos2 || puntos1 == puntos3 || puntos2 == puntos3)) || (equipo3 == 0 && puntos1 == puntos2))
            alert("¡No se puede finalizar un encuentro cuando existe empate!");
        else {
            //	CREO UN OBJETO AJAX PARA GUARDAR LOS DATOS EN LA BASE DE DATOS
            var ajax = nuevoAjax();
            ajax.open("POST", "../lib/fphp.php", true);
            ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            ajax.send("maestro=JUEGO&accion=FINALIZAR&ronda=" + ronda + "&encuentro=" + encuentro + "&equipo1=" + equipo1 + "&equipo2=" + equipo2 + "&equipo3=" + equipo3 + "&puntos1=" + puntos1 + "&puntos2=" + puntos2 + "&puntos3=" + puntos3);
            ajax.onreadystatechange = function () {
                if (ajax.readyState == 1) {
                    document.getElementById("divCargando").style.display = "block";
                }
                if (ajax.readyState == 4) {
                    if (ajax.responseText == "EXITO") {
                        location.href = "msj_fin.php?ronda=" + ronda + "&encuentro=" + encuentro + "&equipo1=" + equipo1 + "&equipo2=" + equipo2 + "&equipo3=" + equipo3;
                    } else msjError(ajax.responseText);
                }
            }
        }
    } else {
        alert("¡Acción inválida! \nPregunta en proceso...");
    }
}

function juego_nuevo() {
    x = confirm("¿Está seguro de comenzar una nueva partida? \n Esta acción eliminara el historial de la partida actual....");
    if (x) {
        //	CREO UN OBJETO AJAX PARA GUARDAR LOS DATOS EN LA BASE DE DATOS
        var ajax = nuevoAjax();
        ajax.open("POST", "lib/fphp.php", true);
        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        ajax.send("maestro=JUEGO&accion=NUEVO");
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 1) {
                document.getElementById("divCargando").style.display = "block";
            }
            if (ajax.readyState == 4) {
                if (ajax.responseText == "EXITO") {
                    alert("¡Todos los valores fueron inicializados!");
                } else msjError(ajax.responseText);
            }
        }
    }
}

function anular() {
    document.getElementById("responder").value = "X"
    procesarRespuesta();
}

function sumar(nro, idequipo, nombre) {
    var status = document.getElementById('status').value;
    var respondido = document.getElementById('respondido').value;

    if (status == 1 && respondido == 0) alert("¡Acción inválida! \nPregunta en proceso...");
    else {
        x = confirm("¿Está seguro de validar la última pregunta como CORRECTA? \n Esta acción SUMARÁ un punto al equipo " + nombre);
        if (x) {
            //	CREO UN OBJETO AJAX PARA GUARDAR LOS DATOS EN LA BASE DE DATOS
            var ajax = nuevoAjax();
            ajax.open("POST", "../lib/fphp.php", true);
            ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            ajax.send("maestro=JUEGO&accion=SUMAR&equipo=" + idequipo + "&nro=" + nro);
            ajax.onreadystatechange = function () {
                if (ajax.readyState == 1) {
                    document.getElementById("divCargando").style.display = "block";
                }
                if (ajax.readyState == 4) {
                    if (ajax.responseText == "EXITO") {
                        location.href = "../archivos/jugar.php?accion=LISTAR&limit=0";
                    } else msjError(ajax.responseText);
                }
            }
        }
    }
}

function restar(nro, idequipo, nombre) {
    var status = document.getElementById('status').value;
    var respondido = document.getElementById('respondido').value;

    if (status == 1 && respondido == 0) alert("¡Acción inválida! \nPregunta en proceso...");
    else {
        x = confirm("¿Está seguro de validar la última pregunta como INCORRECTA? \n Esta acción RESTARÁ un punto al equipo " + nombre);
        if (x) {
            //	CREO UN OBJETO AJAX PARA GUARDAR LOS DATOS EN LA BASE DE DATOS
            var ajax = nuevoAjax();
            ajax.open("POST", "../lib/fphp.php", true);
            ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            ajax.send("maestro=JUEGO&accion=RESTAR&equipo=" + idequipo + "&nro=" + nro);
            ajax.onreadystatechange = function () {
                if (ajax.readyState == 1) {
                    document.getElementById("divCargando").style.display = "block";
                }
                if (ajax.readyState == 4) {
                    if (ajax.responseText == "EXITO") {
                        location.href = "../archivos/jugar.php?accion=LISTAR&limit=0";
                    } else msjError(ajax.responseText);
                }
            }
        }
    }
}
