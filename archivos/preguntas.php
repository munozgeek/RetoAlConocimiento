<?php
include("../lib/fphp.php");
conexion();
$MAXLIMIT=20;
?>
<script type="text/javascript">
var valor=prompt('Ingrese Clave de Acceso','******');
if(valor!='paso'){
    alert('Clave Invalida');
    window.close();
    }

</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" language="javascript" src="../js/jscript.js"></script>
</head>

<body>
<!-- LISTADO DE REGISTROS -->   
<?php
if ($accion=="LISTAR") {
	if ($fbuscar!="") $filtro="AND (preguntas.Numero LIKE '%$fbuscar%' OR preguntas.Pregunta LIKE '%$fbuscar%' OR preguntas.Puntos LIKE '%$fbuscar%' OR rondas.Ronda LIKE '%$fbuscar%')"; else $filtro="";
	if ($fordenar=="") $orden="ORDER BY preguntas.Numero";	
	else $orden="ORDER BY $fordenar";
	?>
	<table width="100%" class="titulo">
		<tr>
			<td>Preguntas y Respuestas </td>
		</tr>
	</table><br /><br />
	<form action="preguntas.php?accion=LISTAR&limit=0" method="POST" name="frmEntrada" id="frmEntrada">	
	<input type="hidden" name="registro" id="registro" />
	<table width="800" class="filtro">
		<tr>
			<td align="right">Buscar:</td>
			<td><input name="fbuscar" type="text" id="fbuscar" size="45" value="<?=$fbuscar?>" /></td>
			<td align="right">Ordenar por:</td>
			<td>
				<select name="fordenar" id="fordenar">
			  		<?=ordenPregunta($fordenar)?>
				</select>
			</td>
			<td align="right"><input name="btBuscar" type="submit" id="btBuscar" value="Buscar" /></td>
		</tr>
	</table><br />
	
	<?php
	//	CONSULTO LA TABLA SOLO PARA SABER EL NUMERO TOTAL DE REGISTROS
	$sql="SELECT preguntas.Numero, preguntas.Pregunta, preguntas.Puntos, rondas.Ronda FROM preguntas, rondas WHERE (preguntas.Ronda=rondas.CodRonda) $filtro";
	$query=mysql_query($sql) or die ($sql.mysql_error());
	$total_rows=mysql_num_rows($query);
	//	SI SE ENCONTRO REGISTROS
	?>
	<table width="800" class="lista">
		<tr>
			<td><div id="rows"></div></td>
			
			<td width="25" align="center"><img id="btPrimera" src="../imagenes/primera.png" title="Primera P�gina" onclick="setLotes('P', <?=$total_rows?>, <?=$limit?>, 'preguntas.php');" /></td>
			<td width="25" align="center"><img id="btAnterior" src="../imagenes/anterior.png" title="P�gina Anterior" onclick="setLotes('A', <?=$total_rows?>, <?=$limit?>, 'preguntas.php');" /></a></td>
			<td width="25">Del</td><td width="25"><div id='desde'></div></td>
			<td width="25">Al</td><td width="25"><div id='hasta'></div></td>
			<td width="25" align="center"><img id="btSiguiente" src="../imagenes/proxima.png" title="P�gina Siguiente" onclick="setLotes('S', <?=$total_rows?>, <?=$limit?>, 'preguntas.php');" /></a></td>
			<td width="25" align="center"><img id="btUltima" src="../imagenes/ultima.png" title="�ltima P�gina" onclick="setLotes('U', <?=$total_rows?>, <?=$limit?>, 'preguntas.php');" /></a></td>
			<td width="175">&nbsp;</td>
			<td width="25"><img id="btNuevo" src="../imagenes/nuevo.png" title="Nuevo Registro" width="16" height="16" onclick="cargarPagina('preguntas.php?accion=NUEVO');" /></td>
			<td width="25"><img id="btEditar" src="../imagenes/editar.png" title="Editar Registro" width="16" height="16" onclick="editarRegistro('preguntas.php');" /></td>
			<td width="25"><img id="btVer" src="../imagenes/ver.png" title="Ver Registro" width="16" height="16" onclick="verRegistro('preguntas.php');" /></td>
			<td width="25"><img id="btEliminar" src="../imagenes/eliminar.png" title="Eliminar Registro" width="16" height="16" onclick="eliminarRegistro('preguntas.php', 'PREGUNTAS');" /></td>
			<td width="25"><img id="btExportar" src="../imagenes/exportar.png" title="Exportar Registros a PDF" width="16" height="16" /></td>
		</tr>
	</table>
	<?php
	//	CONSULTO LA TABLA
	$sql="SELECT preguntas.Numero, preguntas.Pregunta, preguntas.Puntos, rondas.Ronda FROM preguntas, rondas WHERE (preguntas.Ronda=rondas.CodRonda) $filtro $orden LIMIT $limit, $MAXLIMIT";
	$query=mysql_query($sql) or die ($sql.mysql_error());
	$rows=mysql_num_rows($query);
	//	MUESTRO TABLA
	if ($rows!=0) {
		$edo="";
		echo "
		<table width='800' cellpadding='0' cellspacing='0' class='grillaTable'>
			<tr>
				<td width='75' class='grillaTh'>#</td>
				<td class='grillaTh'>Pregunta</td>
				<td class='grillaTh'>Puntos</td>
				<td class='grillaTh'>Ronda</td>
			</tr>";
		for ($i=0; $i<$rows; $i++) {
			$field=mysql_fetch_array($query);
			echo "
			<tr class='grillaTr' id='".$field['Numero']."' onclick='mClk(this, \"registro\");'>
				<td align='center' class='grillaTd'>".$field['Numero']."</td>
				<td class='grillaTd'>".$field['Pregunta']."</td>
				<td align='center' class='grillaTd'>".$field['Puntos']."</td>
				<td align='center' class='grillaTd'>".$field['Ronda']."</td>
			</tr>";
		}
		echo "</table>";
	}
	?>
	<script type="text/javascript" language="javascript">
		totalRegistros(<?=$total_rows?>);
		totalLotes(<?=$total_rows?>, <?=$rows?>, <?=$limit?>)
	</script>
	</form>
<?php } ?>
<!-- FIN LISTADO DE REGISTROS -->

<!-- NUEVO REGISTRO -->   		
<?php
if ($accion=="NUEVO") {
	?>
	<table width="100%" class="titulo">
		<tr>
		  <td>Preguntas y Respuestas  | Nuevo Registro</td>
		</tr>
	</table><br /><br />
	<form action="preguntas.php" method="POST" name="frmEntrada" id="frmEntrada" onsubmit="return validarPreguntas('GUARDAR');">
	<input name="fbuscar" type="hidden" id="fbuscar" value="<?=$fbuscar?>" />
	<input name="fordenar" type="hidden" id="fordenar" value="<?=$fordenar?>" />
	<div style="width:700px" class="divCaption">Preguntas</div>
	<table width="700" class="tblForm">
    	<tr>
        	<td class="tag">#:</td>
        	<td><input name="numero" type="text" id="numero" size="5" readonly /></td>
        </tr>
    	<tr>
        	<td class="tag">Pregunta:</td>
        	<td><textarea name="pregunta" id="pregunta" cols="100" rows="4"></textarea></td>
        </tr>
	</table><br />
	<div style="width:700px" class="divCaption">Opciones</div>
	<table width="700" class="tblForm">
    	<tr>
        	<td class="tag">Opci&oacute; A:</td>
        	<td><input name="a" type="text" id="a" size="100" /></td>
        </tr>
    	<tr>
        	<td class="tag">Opci&oacute; B:</td>
        	<td><input name="b" type="text" id="b" size="100" /></td>
        </tr>
    	<tr>
        	<td class="tag">Opci&oacute; C:</td>
        	<td><input name="c" type="text" id="c" size="100" /></td>
        </tr>
    	<tr>
        	<td class="tag">Opci&oacute; D:</td>
        	<td><input name="d" type="text" id="d" size="100" /></td>
        </tr>
	</table><br />
	<div style="width:700px" class="divCaption">Respuesta</div>
	<table width="700" class="tblForm">
    	<tr>
        	<td class="tag">Respuesta:</td>
        	<td><input name="respuesta" type="text" id="respuesta" size="5" maxlength="1" /></td>
        	<td class="tag">Puntos:</td>
        	<td><input name="puntos" type="text" id="puntos" size="5" maxlength="2" /></td>
        	<td class="tag">Ronda:</td>
			<td>
				<select name="ronda" id="ronda">
					<?=optRonda($_SESSION["RONDA_ACTUAL"])?>
				</select>
			</td>
        </tr>
	</table>
	
	
	
	<center>
	<input type="submit" value="Guardar" class="btGuardar" />
	<input type="button" value="Cancelar" class="btCancelar" onclick="cargarPagina('preguntas.php?accion=LISTAR&limit=0');" />
	</center>
	</form>
	
	<div style="width:700px;" class="msjFooter">Todos los campos son Obligatorios</div>
<?php } ?>
<!-- FIN NUEVO REGISTRO -->

<!-- EDITAR REGISTRO -->    	
<?php
if ($accion=="EDITAR") {
	$sql="SELECT Numero, Pregunta, OpcionA, OpcionB, OpcionC, OpcionD, Respuesta, Puntos, Ronda FROM preguntas WHERE Numero='$registro'";
	$query=mysql_query($sql) or die ($sql.mysql_error());
	$rows=mysql_num_rows($query);
	if ($rows!=0) {
		$field=mysql_fetch_array($query);
		?>
		<table width="100%" class="titulo">
			<tr>
			  <td>Preguntas y Respuestas  | Actualizaci&oacute;n</td>
			</tr>
		</table><br /><br />
		<form action="preguntas.php" method="POST" name="frmEntrada" id="frmEntrada" onsubmit="return validarPreguntas('ACTUALIZAR');">
		<input name="fbuscar" type="hidden" id="fbuscar" value="<?=$fbuscar?>" />
		<input name="fordenar" type="hidden" id="fordenar" value="<?=$fordenar?>" />
		<div style="width:700px" class="divCaption">Preguntas</div>
		<table width="700" class="tblForm">
			<tr>
				<td class="tag">#:</td>
				<td><input name="numero" type="text" id="numero" size="5" readonly value="<?=$field['Numero']?>" /></td>
			</tr>
			<tr>
				<td class="tag">Pregunta:</td>
				<td><textarea name="pregunta" id="pregunta" cols="100" rows="4"><?=$field['Pregunta']?></textarea></td>
			</tr>
		</table><br />
		<div style="width:700px" class="divCaption">Opciones</div>
		<table width="700" class="tblForm">
			<tr>
				<td class="tag">Opci&oacute; A:</td>
				<td><input name="a" type="text" id="a" size="100" value="<?=$field['OpcionA']?>" /></td>
			</tr>
			<tr>
				<td class="tag">Opci&oacute; B:</td>
				<td><input name="b" type="text" id="b" size="100" value="<?=$field['OpcionB']?>" /></td>
			</tr>
			<tr>
				<td class="tag">Opci&oacute; C:</td>
				<td><input name="c" type="text" id="c" size="100" value="<?=$field['OpcionC']?>" /></td>
			</tr>
			<tr>
				<td class="tag">Opci&oacute; D:</td>
				<td><input name="d" type="text" id="d" size="100" value="<?=$field['OpcionD']?>" /></td>
			</tr>
		</table><br />
		<div style="width:700px" class="divCaption">Respuesta</div>
		<table width="700" class="tblForm">
			<tr>
				<td class="tag">Respuesta:</td>
				<td><input name="respuesta" type="text" id="respuesta" size="5" maxlength="1" value="<?=$field['Respuesta']?>" /></td>
				<td class="tag">Puntos:</td>
				<td><input name="puntos" type="text" id="puntos" size="5" maxlength="2" value="<?=$field['Puntos']?>" /></td>
				<td class="tag">Ronda:</td>
				<td>
					<select name="ronda" id="ronda">
						<?=optRonda($field['Ronda'], 0)?>
					</select>
				</td>
			</tr>
		</table>
		<center>
		<input type="submit" value="Guardar" class="btGuardar" />
		<input type="button" value="Cancelar" class="btCancelar" onclick="cargarPagina('preguntas.php?accion=LISTAR&limit=0');" />
		</center>
		</form>
		
		<div style="width:700px;" class="msjFooter">Todos los campos son Obligatorios</div>
	<?php } ?>
<?php } ?>
<!-- FIN EDITAR REGISTRO -->

<!-- VER REGISTRO -->    		
<?php
if ($accion=="VER") {
	$sql="SELECT Numero, Pregunta, OpcionA, OpcionB, OpcionC, OpcionD, Respuesta, Puntos, Ronda FROM preguntas WHERE Numero='$registro'";
	$query=mysql_query($sql) or die ($sql.mysql_error());
	$rows=mysql_num_rows($query);
	if ($rows!=0) {
		$field=mysql_fetch_array($query);
		?>
		<table width="100%" class="titulo">
			<tr>
			  <td>Preguntas y Respuestas  | Ver Registro</td>
			</tr>
		</table><br /><br />
		<form action="preguntas.php" method="POST" name="frmEntrada" id="frmEntrada">
		<input name="fbuscar" type="hidden" id="fbuscar" value="<?=$fbuscar?>" />
		<input name="fordenar" type="hidden" id="fordenar" value="<?=$fordenar?>" />
		<div style="width:700px" class="divCaption">Preguntas</div>
		<table width="700" class="tblForm">
			<tr>
				<td class="tag">#:</td>
				<td><input name="numero" type="text" id="numero" size="5" readonly value="<?=$field['Numero']?>" /></td>
			</tr>
			<tr>
				<td class="tag">Pregunta:</td>
				<td><textarea name="pregunta" id="pregunta" cols="100" rows="4" readonly><?=$field['Pregunta']?></textarea></td>
			</tr>
		</table><br />
		<div style="width:700px" class="divCaption">Opciones</div>
		<table width="700" class="tblForm">
			<tr>
				<td class="tag">Opci&oacute; A:</td>
				<td><input name="a" type="text" id="a" size="100" value="<?=$field['OpcionA']?>" readonly /></td>
			</tr>
			<tr>
				<td class="tag">Opci&oacute; B:</td>
				<td><input name="b" type="text" id="b" size="100" value="<?=$field['OpcionB']?>" readonly /></td>
			</tr>
			<tr>
				<td class="tag">Opci&oacute; C:</td>
				<td><input name="c" type="text" id="c" size="100" value="<?=$field['OpcionC']?>" readonly /></td>
			</tr>
			<tr>
				<td class="tag">Opci&oacute; D:</td>
				<td><input name="d" type="text" id="d" size="100" value="<?=$field['OpcionD']?>" readonly /></td>
			</tr>
		</table><br />
		<div style="width:700px" class="divCaption">Respuesta</div>
		<table width="700" class="tblForm">
			<tr>
				<td class="tag">Respuesta:</td>
				<td><input name="respuesta" type="text" id="respuesta" size="5" maxlength="1" value="<?=$field['Respuesta']?>" readonly /></td>
				<td class="tag">Puntos:</td>
				<td><input name="puntos" type="text" id="puntos" size="5" maxlength="2" value="<?=$field['Puntos']?>" readonly /></td>
				<td class="tag">Ronda:</td>
				<td>
					<select name="ronda" id="ronda">
						<?=optRonda($field['Ronda'], 1)?>
					</select>
				</td>
			</tr>
		</table>
		<center>
		<input type="button" value="Regresar a la Lista" class="btRegresar" onclick="cargarPagina('preguntas.php?accion=LISTAR&limit=0');" />
		</center>
		</form>
	<?php } ?>
<?php } ?>
<!-- FIN VER REGISTRO -->
</body>
</html>
