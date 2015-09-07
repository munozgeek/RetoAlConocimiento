<?php
session_start();
include("conexion.php");
conexion();
extract($_POST);
extract($_GET);

//	FUNCION PARA GENERAR UN CODIGO
function generarCodigo($campo, $tabla, $digitos) { 
	$sql="select max($campo) FROM $tabla";
	$query=mysql_query($sql) or die ($sql.mysql_error());
	$field=mysql_fetch_array($query);
	$codigo=(int) ($field[0]+1);
	$codigo=(string) str_repeat("0", $digitos-strlen($codigo)).$codigo;
	return ($codigo);
}

//	FUNCIONES QUE MUESTRA LAS OPCIONES DE ORDEN DE UN MAESTRO
function ordenPregunta($valor) { 
	$val[0]="preguntas.Numero"; $reg[0]="N&uacute;mero";
	$val[1]="preguntas.Pregunta"; $reg[1]="Pregunta";
	$val[2]="preguntas.Respuesta"; $reg[2]="Respuesta";
	$val[3]="preguntas.Puntos"; $reg[3]="Puntos";
	$val[4]="rondas.Ronda"; $reg[4]="Ronda";
	
	for ($i=0; $i<5; $i++) {
		if ($val[$i]==$valor) echo "<option value='".$val[$i]."' selected>".$reg[$i]."</option>";
		else echo "<option value='".$val[$i]."'>".$reg[$i]."</option>";
	}
}

//	FUNCIONES QUE MUESTRA LAS OPCIONES DE ORDEN DE UN MAESTRO
function ordenEquipo($valor) { 
	$val[0]="Numero"; $reg[0]="N&uacute;mero";
	$val[1]="Equipo"; $reg[1]="Equipo";
	
	for ($i=0; $i<2; $i++) {
		if ($val[$i]==$valor) echo "<option value='".$val[$i]."' selected>".$reg[$i]."</option>";
		else echo "<option value='".$val[$i]."'>".$reg[$i]."</option>";
	}
}

//	FUNCIONES QUE MUESTRA LAS OPCIONES DE ORDEN DE UN MAESTRO
function ordenParametro($valor) { 
	$val[0]="Parametro"; $reg[0]="Parametro";
	$val[1]="Descripcion"; $reg[1]="Descripcion";
	$val[2]="Valor"; $reg[2]="Valor";
	
	for ($i=0; $i<3; $i++) {
		if ($val[$i]==$valor) echo "<option value='".$val[$i]."' selected>".$reg[$i]."</option>";
		else echo "<option value='".$val[$i]."'>".$reg[$i]."</option>";
	}
}

//	FUNCIONES QUE MUESTRA LAS OPCIONES DE UN SELECT
function optRonda($ronda) {
	if ($ronda == 1) $ronda1= "selected";
	elseif ($ronda == 2) $ronda2= "selected";
	elseif ($ronda == 3) $ronda3= "selected";
	echo "<option value='1' $ronda1>ELIMINATORIA</option>";
	echo "<option value='2' $ronda2>SEMI-FINAL</option>";
	echo "<option value='3' $ronda3>FINAL</option>";
}

//	FUNCIONES QUE MUESTRA LAS OPCIONES DE UN SELECT
function optEquipo($valor, $opt, $ronda) {
	switch ($opt) {
		case 0:	
			$sql="SELECT Numero, Equipo FROM equipos ORDER BY Numero";
			$query=mysql_query($sql) or die ($sql.mysql_error());
			while ($field=mysql_fetch_array($query)) {
				$field[1]=htmlentities($field[1]);
				if ($field[0]==$valor) echo "<option value='".$field[0]."' selected>".$field[1]."</option>";
				else echo "<option value='".$field[0]."'>".$field[1]."</option>";
			}
			break;
			
		case 1:
			$sql="SELECT Numero, Equipo FROM equipos WHERE Numero='$valor'";
			$query=mysql_query($sql) or die ($sql.mysql_error());
			while ($field=mysql_fetch_array($query)) {
				$field[1]=htmlentities($field[1]);
				if ($field[0]==$valor) echo "<option value='".$field[0]."' selected>".$field[1]."</option>";
				else echo "<option value='".$field[0]."'>".$field[1]."</option>";
			}
			break;
	}
}

//	FUNCIONES QUE MUESTRA LAS OPCIONES DE UN SELECT
function optEncuentro($valor) {		
	$val[1]="1"; $reg[1]="01";
	$val[2]="2"; $reg[2]="02";
	$val[3]="3"; $reg[3]="03";
	$val[4]="4"; $reg[4]="04";
	$val[5]="5"; $reg[5]="05";
	$val[6]="6"; $reg[6]="06";	
	for ($i=1; $i<=6; $i++) {
		if ($val[$i]==$valor) echo "<option value='".$val[$i]."' selected>".$reg[$i]."</option>";
		else echo "<option value='".$val[$i]."'>".$reg[$i]."</option>";
	}
}

//	-----------------------------------------------------------------------------------------	//
if ($maestro=="PREGUNTAS") { 
	if ($accion=="GUARDAR") {
		$numero=generarCodigo("Numero", "preguntas", "4");
		$sql="INSERT INTO preguntas VALUES ('$numero', '$pregunta', '$a', '$b', '$c', '$d', '$respuesta', '$puntos', '$ronda')";
		$query=mysql_query($sql) or die ($sql.mysql_error());
		echo "EXITO";
	}
	elseif ($accion=="ACTUALIZAR") {
		$sql="UPDATE preguntas SET Pregunta='$pregunta', OpcionA='$a', OpcionB='$b', OpcionC='$c', OpcionD='$d', Respuesta='$respuesta', Puntos='$puntos', Ronda='$ronda' WHERE Numero='$numero'";
		$query=mysql_query($sql) or die ($sql.mysql_error());
		echo "EXITO";
	}
	elseif ($accion=="ELIMINAR") {
		$sql="DELETE FROM preguntas WHERE Numero='$registro'";
		$query=mysql_query($sql) or die ($sql.mysql_error());
		echo "EXITO";
	}
}

elseif ($maestro=="EQUIPOS") { 
	if ($accion=="GUARDAR") {
		$sql="SELECT * FROM equipos WHERE Equipo='$equipo'";
		$query=mysql_query($sql) or die ($sql.mysql_error());
		$rows=mysql_num_rows($query);
		if ($rows!=0) echo "¡Nombre de equipo ya existe!";
		else {
			$numero=generarCodigo("Numero", "equipos", "4");
			$sql="INSERT INTO equipos VALUES ('$numero', '$equipo','$logo')";
			$query=mysql_query($sql) or die ($sql.mysql_error());
			echo "EXITO";
		}
	}
	elseif ($accion=="ACTUALIZAR") {
		$sql="SELECT * FROM equipos WHERE Equipo='$equipo' AND Numero<>'$numero'";
		$query=mysql_query($sql) or die ($sql.mysql_error());
		$rows=mysql_num_rows($query);
		if ($rows!=0) echo "¡Nombre de equipo ya existe!";
		else {
			$sql="UPDATE equipos SET Equipo='$equipo', logo='$logo' WHERE Numero='$numero'";
			$query=mysql_query($sql) or die ($sql.mysql_error());
			echo "EXITO";
		}
	}
	elseif ($accion=="ELIMINAR") {
		$sql="DELETE FROM equipos WHERE Numero='$registro'";
		$query=mysql_query($sql) or die ($sql.mysql_error());
		echo "EXITO";
	}
}

elseif ($maestro=="PARAMETROS") { 
	if ($accion=="GUARDAR") {
		$sql="SELECT * FROM parametros WHERE Parametro='$parametro'";
		$query=mysql_query($sql) or die ($sql.mysql_error());
		$rows=mysql_num_rows($query);
		if ($rows!=0) echo "¡Parametro ya existe!";
		else {
			$sql="INSERT INTO parametros VALUES ('$parametro', '$descripcion', '$valor')";
			$query=mysql_query($sql) or die ($sql.mysql_error());
			echo "EXITO";
		}
	}
	elseif ($accion=="ACTUALIZAR") {
		$sql="UPDATE parametros SET Descripcion='$descripcion', Valor='$valor' WHERE Parametro='$parametro'";
		$query=mysql_query($sql) or die ($sql.mysql_error());
		echo "EXITO";
	}
	elseif ($accion=="ELIMINAR") {
		$sql="DELETE FROM parametros WHERE Parametro='$registro'";
		$query=mysql_query($sql) or die ($sql.mysql_error());
		echo "EXITO";
	}
}

elseif ($maestro=="ENCUENTROS") { 	
	$msj="";
	if ($accion=="GUARDAR") {
		$sql="SELECT * FROM encuentros WHERE ((CodRonda='$ronda') AND ((Equipo1='$equipo1' OR Equipo2='$equipo1' OR Equipo3='$equipo1') OR (Equipo1='$equipo2' OR Equipo2='$equipo2' OR Equipo3='$equipo2') OR (Equipo1='$equipo3' OR Equipo2='$equipo3' OR (Equipo3='$equipo3' AND Equipo3<>'0'))))";
		
$query=mysql_query($sql) or die ($sql.mysql_error());
		$rows=mysql_num_rows($query);
		if ($rows!=0) $msj="¡Un equipo no puede registrarse más de una vez en la misma ronda!";
		//
		$sql="SELECT * FROM encuentros WHERE (CodRonda='$ronda' AND Numero='$numero')";
		$query=mysql_query($sql) or die ($sql.mysql_error());
		$rows=mysql_num_rows($query);
		if ($rows!=0) $msj="¡El número de encuentro ya fue ingresado para esta ronda!";
		if ($msj!="") echo $msj;		
		else {
			$sql="INSERT INTO encuentros VALUES ('$ronda', '$numero', '$equipo1', '$equipo2', '$equipo3')";
			$query=mysql_query($sql) or die ($sql.mysql_error());
			//
			$sql="INSERT INTO resultados VALUES ('$ronda', '$numero', '0', '0', '0')";
			$query=mysql_query($sql) or die ($sql.mysql_error());
			//
			$sql="INSERT INTO turnos VALUES ('0', '0', '0', '$ronda', '$numero')";
			$query=mysql_query($sql) or die ($sql.mysql_error());
			//
			echo "EXITO";
		}
	}
	elseif ($accion=="ACTUALIZAR") {
		$sql="SELECT * FROM encuentros WHERE ((CodRonda='$ronda') AND ((Equipo1='$equipo1' OR Equipo2='$equipo1' OR Equipo3='$equipo1') OR (Equipo1='$equipo2' OR Equipo2='$equipo2' OR Equipo3='$equipo2') OR (Equipo1='$equipo3' OR Equipo2='$equipo3' OR (Equipo3='$equipo3' AND Equipo3<>'0')))) AND (Numero<>'$numero' AND CodRonda<>'$ronda')";
		$query=mysql_query($sql) or die ($sql.mysql_error());
		$rows=mysql_num_rows($query);
		if ($rows!=0) $msj="¡Un equipo no puede registrarse más de una vez en la misma ronda!";
		else {
			$sql="UPDATE encuentros SET Equipo1='$equipo1', Equipo2='$equipo2', Equipo3='$equipo3' WHERE Numero='$numero' AND CodRonda='$ronda'";
			$query=mysql_query($sql) or die ($sql.mysql_error());
			echo "EXITO";
		}
	}
	elseif ($accion=="ELIMINAR") {
		list($registro1, $registro2)=SPLIT( '[:]', $registro);
		$sql="DELETE FROM encuentros WHERE Numero='$registro1' AND CodRonda='$registro2'";
		$query=mysql_query($sql) or die ($sql.mysql_error());
		echo "EXITO";
	}
	if ($ronda=="3") {
		 $sql="UPDATE status SET CodRonda='3', Encuentro='1', Turno='1'";
		 $query=mysql_query($sql) or die ($sql.mysql_error());
	}
}

elseif ($maestro=="JUEGO") {
	if ($accion=="SELECCION") {

		$sql="SELECT * FROM preguntas WHERE ronda='$ronda' AND Numero='$pregunta'";
		$query=mysql_query($sql) or die ($sql.mysql_error());
		$rows=mysql_num_rows($query);
		if ($rows!=0) {
			$field=mysql_fetch_array($query);
			$respuesta="EXITO::".htmlspecialchars(ucwords(($field["Pregunta"])), ENT_QUOTES)."::".htmlspecialchars(ucwords(($field["OpcionA"])), ENT_QUOTES)."::".htmlspecialchars(ucwords(($field["OpcionB"])), ENT_QUOTES)."::".htmlspecialchars(ucwords(($field["OpcionC"])), ENT_QUOTES)."::".htmlspecialchars(ucwords(($field["OpcionD"])), ENT_QUOTES)."::".ucwords($field["Respuesta"])."::".$field["Puntos"]."::".$field["Numero"];
			//echo $respuesta;
			//
			$sql="INSERT INTO historial VALUES ('', '$ronda', '$equipo', '$pregunta', 'N', '$encuentro', 'N')";
			$query=mysql_query($sql) or die ($sql.mysql_error());
			//
			echo $respuesta;
		}
	}
	elseif ($accion=="RESPUESTA") {
		if ($acierto=="S") {
			if ($turno==1) { $puntos="Puntos1=(SELECT SUM(Puntos1))+1"; }
			if ($turno==2) { $puntos="Puntos2=(SELECT SUM(Puntos2))+1"; }
			if ($turno==3) { $puntos="Puntos3=(SELECT SUM(Puntos3))+1"; }			
			//
			$sql="UPDATE resultados SET $puntos WHERE CodRonda='$ronda' AND Numero='$encuentro'";
			$query=mysql_query($sql) or die ($sql.mysql_error());
		}
		if ($turno==1) $next=2;
		if ($turno==2 && $equipo3!=0) $next=3;
		if ($turno==2 && $equipo3==0) $next=1;
		if ($turno==3) $next=1;
		
		$sql="UPDATE historial SET FlagAcierto='$acierto', FlagValido='S' WHERE Ronda='$ronda' AND Equipo='$equipo' AND Pregunta='$pregunta' AND Encuentro='$encuentro'";
		$query=mysql_query($sql) or die ($sql.mysql_error());
		//		
		$sql="UPDATE status SET Turno='$next'";
		$query=mysql_query($sql) or die ($sql.mysql_error());
		//
		if ($turnos=="divTurnos1") $sumturnos="Equipo1=(SELECT SUM(Equipo1))+1";
		if ($turnos=="divTurnos2") $sumturnos="Equipo2=(SELECT SUM(Equipo2))+1";
		if ($turnos=="divTurnos3") $sumturnos="Equipo3=(SELECT SUM(Equipo3))+1";
		$sql="UPDATE turnos SET $sumturnos WHERE CodRonda='$ronda' AND Encuentro='$encuentro'";
		$query=mysql_query($sql) or die ($sql.mysql_error());
		//
		echo "EXITO";
	}
	elseif ($accion=="FINALIZAR") {
		$respuesta="EXITO";
		if ($ronda=="1") $parametro="Parametro='PRERONDA1'";
		if ($ronda=="2") $parametro="Parametro='PRERONDA2'";
		if ($ronda=="3") $parametro="Parametro='PRERONDA3'";		
		$sql="SELECT Valor FROM parametros WHERE $parametro";
		$query=mysql_query($sql) or die ($sql.mysql_error());
		$rows=mysql_num_rows($query);
		if ($rows!=0) {
			$field=mysql_fetch_array($query);
			$limite=$field["Valor"];
			//
			$sql="SELECT * FROM historial WHERE Ronda='$ronda' AND Encuentro='$encuentro' AND FlagValido='S'";
			$query=mysql_query($sql) or die ($sql.mysql_error());
			$rows=mysql_num_rows($query);
			if ($rows<$limite) $respuesta="ERROR: No se ha alcanzado el limite de preguntas para esta ronda";
		}
		//
		$sql="SELECT * FROM historial WHERE Equipo='$equipo1' AND Ronda='$ronda' AND Encuentro='$encuentro' AND FlagValido='S'";
		$query=mysql_query($sql) or die ($sql.mysql_error());
		$rows1=mysql_num_rows($query);
		//-
		$sql="SELECT * FROM historial WHERE Equipo='$equipo2' AND Ronda='$ronda' AND Encuentro='$encuentro' AND FlagValido='S'";
		$query=mysql_query($sql) or die ($sql.mysql_error());
		$rows2=mysql_num_rows($query);
		//-
		$sql="SELECT * FROM historial WHERE Equipo='$equipo3' AND Ronda='$ronda' AND Encuentro='$encuentro' AND FlagValido='S'";
		$query=mysql_query($sql) or die ($sql.mysql_error());
		$rows3=mysql_num_rows($query);
		if ($equipo3!="0") if ($rows1!=$rows2 || $rows1!=$rows3 || $rows2!=$rows3) $respuesta="ERROR: Los equipos no han completado el mismo numero de preguntas";
		if ($equipo3=="0") if ($rows1!=$rows2) $respuesta="ERROR: Los equipos no han completado el mismo numero de preguntas";
		//
		if ($respuesta=="EXITO") {
			//
			if (($puntos1>$puntos2) && ($puntos1>$puntos3)) {
				$sql="INSERT INTO estadistica VALUES ('$ronda', '$encuentro', '$equipo1', 'S', '$puntos1')";
				$query=mysql_query($sql) or die ($sql.mysql_error());
				$sql="INSERT INTO estadistica VALUES ('$ronda', '$encuentro', '$equipo2', 'N', '$puntos2')";
				$query=mysql_query($sql) or die ($sql.mysql_error());
				$sql="INSERT INTO estadistica VALUES ('$ronda', '$encuentro', '$equipo3', 'N', '$puntos3')";
				$query=mysql_query($sql) or die ($sql.mysql_error());
			}
			else if (($puntos2>$puntos1) && ($puntos2>$puntos3)) {
				$sql="INSERT INTO estadistica VALUES ('$ronda', '$encuentro', '$equipo1', 'N', '$puntos1')";
				$query=mysql_query($sql) or die ($sql.mysql_error());
				$sql="INSERT INTO estadistica VALUES ('$ronda', '$encuentro', '$equipo2', 'S', '$puntos2')";
				$query=mysql_query($sql) or die ($sql.mysql_error());
				$sql="INSERT INTO estadistica VALUES ('$ronda', '$encuentro', '$equipo3', 'N', '$puntos3')";
				$query=mysql_query($sql) or die ($sql.mysql_error());
			}
			else if (($puntos3>$puntos1) && ($puntos3>$puntos2)) {
				$sql="INSERT INTO estadistica VALUES ('$ronda', '$encuentro', '$equipo1', 'N', '$puntos1')";
				$query=mysql_query($sql) or die ($sql.mysql_error());
				$sql="INSERT INTO estadistica VALUES ('$ronda', '$encuentro', '$equipo2', 'N', '$puntos2')";
				$query=mysql_query($sql) or die ($sql.mysql_error());
				$sql="INSERT INTO estadistica VALUES ('$ronda', '$encuentro', '$equipo3', 'S', '$puntos3')";
				$query=mysql_query($sql) or die ($sql.mysql_error());
			}
			//
			$sql="SELECT * FROM encuentros WHERE CodRonda='$ronda'";
			$query=mysql_query($sql) or die ($sql.mysql_error());
			$rows=mysql_num_rows($query);
			//			
			$encuentro++;
			if ($encuentro<=$rows) $sql="UPDATE status SET Encuentro='$encuentro', Turno='1'";
			else { $ronda++; $sql="UPDATE status SET CodRonda='$ronda', Encuentro='1', Turno='1'"; }
			$query=mysql_query($sql) or die ($sql.mysql_error());
		}
		echo $respuesta;
	}
	elseif ($accion=="NUEVO") {
		$sql="TRUNCATE TABLE resultados";
		$query=mysql_query($sql) or die ($sql.mysql_error());
		$sql="TRUNCATE TABLE historial";
		$query=mysql_query($sql) or die ($sql.mysql_error());
		$sql="TRUNCATE TABLE estadistica";
		$query=mysql_query($sql) or die ($sql.mysql_error());
		$sql="TRUNCATE TABLE encuentros";
		$query=mysql_query($sql) or die ($sql.mysql_error());
		$sql="TRUNCATE TABLE equipos";
		$query=mysql_query($sql) or die ($sql.mysql_error());
		$sql="TRUNCATE TABLE turnos";
		$query=mysql_query($sql) or die ($sql.mysql_error());
		$sql="UPDATE status SET CodRonda='1', Encuentro='1', Turno='1'";
		$query=mysql_query($sql) or die ($sql.mysql_error());
		$_SESSION["RONDA_ACTUAL"]=1;
		$_SESSION["ENCUENTRO_ACTUAL"]=1;
		$_SESSION["TURNO_ACTUAL"]=1;
		echo "EXITO";
	}
	elseif ($accion=="ANULAR") {
		if ($turno==1) $puntos="Puntos1=(SELECT SUM(Puntos1))-1";
		if ($turno==2) $puntos="Puntos2=(SELECT SUM(Puntos2))-1";
		if ($turno==3) $puntos="Puntos3=(SELECT SUM(Puntos3))-1";
		$sql="UPDATE resultados SET $puntos WHERE CodRonda='$ronda' AND Numero='$encuentro'";
		$query=mysql_query($sql) or die ($sql.mysql_error());
		echo "EXITO";
	}
	elseif ($accion=="SUMAR") {
		$sql="SELECT * FROM historial WHERE Id=(SELECT MAX(Id) FROM historial) AND Equipo='".$equipo."' AND FlagAcierto='N' order by id";
		$query_historial=mysql_query($sql) or die ($sql.mysql_error());
		if (mysql_num_rows($query_historial)!=0) {
			$field_historial=mysql_fetch_array($query_historial);
			
			if ($nro==1) { $campoP="Puntos1"; $campoT="Equipo1"; }
			elseif ($nro==2) { $campoP="Puntos2"; $campoT="Equipo2"; }
			elseif ($nro==3) { $campoP="Puntos3"; $campoT="Equipo3"; }
			
			$sql="SELECT t.$campoT AS Turnos, r.$campoP AS Puntos FROM resultados r INNER JOIN turnos t ON (r.CodRonda=t.CodRonda AND r.Numero=t.Encuentro) WHERE r.CodRonda='".$field_historial['Ronda']."' AND r.Numero='".$field_historial['Encuentro']."'";
			$query_turnos_puntos=mysql_query($sql) or die ($sql.mysql_error());
			if (mysql_num_rows($query_turnos_puntos)!=0) {
				$field_turnos_puntos=mysql_fetch_array($query_turnos_puntos);
				
				if ($field_turnos_puntos['Puntos']==$field_turnos_puntos['Turnos']) echo "ERROR: No se puede sumar un punto a este equipo (Puntos = Turnos)";
				else {
					$sql="UPDATE historial SET FlagAcierto='S', FlagValido='S' WHERE Id='".$field_historial['Id']."'";
					$query_update=mysql_query($sql) or die ($sql.mysql_error());
					
					$sql="UPDATE resultados SET $campoP=$campoP+1 WHERE CodRonda='".$field_historial['Ronda']."' AND Numero='".$field_historial['Encuentro']."'";
					$query_update=mysql_query($sql) or die ($sql.mysql_error());
				
					echo "EXITO";
				}
				
			} else echo "ERROR: No se puede sumar un punto a este equipo (Turnos : Puntaje)";
			
		} else echo "ERROR: No se puede sumar un punto a este equipo (Historial)";
		
	}
	elseif ($accion=="RESTAR") {
	$sql="SELECT * FROM historial WHERE Id=(SELECT MAX(Id) FROM historial) AND Equipo='".$equipo."' AND FlagAcierto='S' order by id";
		$query_historial=mysql_query($sql) or die ($sql.mysql_error());
		if (mysql_num_rows($query_historial)!=0) {
			$field_historial=mysql_fetch_array($query_historial);
			
			if ($nro==1) { $campoP="Puntos1"; $campoT="Equipo1"; }
			elseif ($nro==2) { $campoP="Puntos2"; $campoT="Equipo2"; }
			elseif ($nro==3) { $campoP="Puntos3"; $campoT="Equipo3"; }
			
			$sql="SELECT t.$campoT AS Turnos, r.$campoP AS Puntos FROM resultados r INNER JOIN turnos t ON (r.CodRonda=t.CodRonda AND r.Numero=t.Encuentro) WHERE r.CodRonda='".$field_historial['Ronda']."' AND r.Numero='".$field_historial['Encuentro']."'";
			$query_turnos_puntos=mysql_query($sql) or die ($sql.mysql_error());
			if (mysql_num_rows($query_turnos_puntos)!=0) {
				$field_turnos_puntos=mysql_fetch_array($query_turnos_puntos);
				
				if ($field_turnos_puntos['Puntos']==0) echo "ERROR: No se puede restar un punto a este equipo (Puntos = 0)";
				elseif ($field_turnos_puntos['Turnos']==0) echo "ERROR: No se puede restar un punto a este equipo (Turnos = 0)";
				else {
					$sql="UPDATE historial SET FlagAcierto='N', FlagValido='S' WHERE Id='".$field_historial['Id']."'";
					$query_update=mysql_query($sql) or die ($sql.mysql_error());
					
					$sql="UPDATE resultados SET $campoP=$campoP-1 WHERE CodRonda='".$field_historial['Ronda']."' AND Numero='".$field_historial['Encuentro']."'";
					$query_update=mysql_query($sql) or die ($sql.mysql_error());
				
					echo "EXITO";
				
				}
				
			} else echo "ERROR: No se puede restar un punto a este equipo (Turnos : Puntaje)";
			
		} else echo "ERROR: No se puede restar un punto a este equipo (Historial)";
		
	}
}
?>
