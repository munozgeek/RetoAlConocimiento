<?php
include("../lib/fphp.php");
conexion();
$MAXLIMIT=20;
?>
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
	if ($fbuscar!="") $filtro="AND (Numero LIKE '%$fbuscar%' OR Equipo LIKE '%$fbuscar%')"; else $filtro="";
	if ($fordenar=="") $orden="ORDER BY Numero"; else $orden="ORDER BY $fordenar";
	?>
	<table width="100%" class="titulo">
		<tr>
			<td>Equipos a Jugar </td>
		</tr>
	</table><br /><br />
	<form action="equipos.php?accion=LISTAR&limit=0" method="POST" name="frmEntrada" id="frmEntrada">
	<input type="hidden" name="registro" id="registro" />
	<table width="800" class="filtro">
		<tr>
			<td align="right">Buscar:</td>
			<td><input name="fbuscar" type="text" id="fbuscar" size="45" value="<?=$fbuscar?>" /></td>
			<td align="right">Ordenar por:</td>
			<td>
				<select name="fordenar" id="fordenar">
			  		<?=ordenEquipo($fordenar)?>
				</select>
			</td>
			<td align="right"><input name="btBuscar" type="submit" id="btBuscar" value="Buscar" /></td>
		</tr>
	</table><br />
	
	<?php
	//	CONSULTO LA TABLA SOLO PARA SABER EL NUMERO TOTAL DE REGISTROS
	$sql="SELECT Numero, Equipo FROM equipos WHERE (Numero>0) $filtro";
	$query=mysql_query($sql) or die ($sql.mysql_error());
	$total_rows=mysql_num_rows($query);
	?>
	<table width="800" class="lista">
		<tr>
			<td><div id="rows"></div></td>
				
			<td width="25" align="center"><img id="btPrimera" src="../imagenes/primera.png" title="Primera Página" onclick="setLotes('P', <?=$total_rows?>, <?=$limit?>, 'equipos.php');" /></td>
			<td width="25" align="center"><img id="btAnterior" src="../imagenes/anterior.png" title="Página Anterior" onclick="setLotes('A', <?=$total_rows?>, <?=$limit?>, 'equipos.php');" /></a></td>
			<td width="25">Del</td><td width="25"><div id='desde'></div></td>
			<td width="25">Al</td><td width="25"><div id='hasta'></div></td>
			<td width="25" align="center"><img id="btSiguiente" src="../imagenes/proxima.png" title="Página Siguiente" onclick="setLotes('S', <?=$total_rows?>, <?=$limit?>, 'equipos.php');" /></a></td>
			<td width="25" align="center"><img id="btUltima" src="../imagenes/ultima.png" title="Última Página" onclick="setLotes('U', <?=$total_rows?>, <?=$limit?>, 'equipos.php');" /></a></td>
				
			<td width="175">&nbsp;</td>
				
			<td width="25"><img id="btNuevo" src="../imagenes/nuevo.png" title="Nuevo Registro" width="16" height="16" onclick="cargarPagina('equipos.php?accion=NUEVO');" /></td>
			<td width="25"><img id="btEditar" src="../imagenes/editar.png" title="Editar Registro" width="16" height="16" onclick="editarRegistro('equipos.php');" /></td>
			<td width="25"><img id="btVer" src="../imagenes/ver.png" title="Ver Registro" width="16" height="16" onclick="verRegistro('equipos.php');" /></td>
			<td width="25"><img id="btEliminar" src="../imagenes/eliminar.png" title="Eliminar Registro" width="16" height="16" onclick="eliminarRegistro('equipos.php', 'EQUIPOS');" /></td>
			<td width="25"><img id="btExportar" src="../imagenes/exportar.png" title="Exportar Registros a PDF" width="16" height="16" /></td>
		</tr>
	</table>
	<?php
	echo "
	<table width='800' cellpadding='0' cellspacing='0' class='grillaTable'>
		<tr>
			<td width='75' class='grillaTh'>#</td>
			<td class='grillaTh' >Nombre del Equipo</td>
			<td class='grillaTh' >Logo</td>
		</tr>";
	//	SI SE ENCONTRO REGISTROS
	if ($total_rows!=0) {
		//	CONSULTO LA TABLA
		$sql="SELECT * FROM equipos WHERE (Numero>0) $filtro $orden LIMIT $limit, $MAXLIMIT";
		$query=mysql_query($sql) or die ($sql.mysql_error());
		$rows=mysql_num_rows($query);
		//	MUESTRO TABLA
		if ($rows!=0) {
			$edo="";
			for ($i=0; $i<$rows; $i++) {
				$field=mysql_fetch_array($query);
				echo "
				<tr class='grillaTr' id='".$field['Numero']."' onclick='mClk(this, \"registro\");'>
					<td align='center' class='grillaTd'>".$field['Numero']."</td>
					<td class='grillaTd'>".$field['Equipo']."</td>
					<td class='grillaTd' align='center'><img src='../logos/2015/".str_replace('C:fakepath','',$field['logo'])."' alt='' width='50' height='50' border='0' /></td>
				</tr>";
			}
		}
	}
	echo "</table>";
	$rows=(int) $rows;
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
		  <td>Equipos a Jugar  | Nuevo Registro</td>
		</tr>
	</table><br /><br />
	<form enctype="multipart/form-data" action="equipos.php" method="POST" name="frmEntrada" id="frmEntrada" onsubmit="return validarEquipos('GUARDAR');">
	<input name="fbuscar" type="hidden" id="fbuscar" value="<?=$fbuscar?>" />
	<input name="fordenar" type="hidden" id="fordenar" value="<?=$fordenar?>" />
	<div style="width:700px" class="divCaption">Preguntas</div>
	<table width="700" class="tblForm">
    	<tr>
        	<td class="tag">#:</td>
        	<td><input name="numero" type="text" id="numero" size="5" readonly /></td>
        </tr>
    	<tr>
        	<td class="tag">Nombre del Equipo:</td>
        	<td><input type="text" name="equipo" id="equipo" size="75" maxlength="100"  /></td>
        	</tr><tr>
        	<td class="tag">Logo:</td>
        	<td><input type="file" name="logo" id="logo" size="75" maxlength="100"  /></td>
        </tr>
	</table><br />
	
	<center>
	<input type="submit" value="Guardar" class="btGuardar" />
	<input type="button" value="Cancelar" class="btCancelar" onclick="cargarPagina('equipos.php?accion=LISTAR&limit=0');" />
	</center>
	</form>
	
	<div style="width:700px;" class="msjFooter">Todos los campos son Obligatorios</div>
<?php } ?>
<!-- FIN NUEVO REGISTRO -->

<!-- EDITAR REGISTRO -->		
<?php
if ($accion=="EDITAR") {
	$sql="SELECT * FROM equipos WHERE Numero='$registro'";
	$query=mysql_query($sql) or die ($sql.mysql_error());
	$rows=mysql_num_rows($query);
	if ($rows!=0) {
		$field=mysql_fetch_array($query);
		?>
		<table width="100%" class="titulo">
			<tr>
			  <td>Equipos a Jugar  | Actualizaci&oacute;n </td>
			</tr>
		</table><br /><br />
		<form enctype="multipart/form-data"  action="equipos.php" method="POST" name="frmEntrada" id="frmEntrada" onsubmit="return validarEquipos('ACTUALIZAR');">
		<input name="fbuscar" type="hidden" id="fbuscar" value="<?=$fbuscar?>" />
		<input name="fordenar" type="hidden" id="fordenar" value="<?=$fordenar?>" />
		<div style="width:700px" class="divCaption">Preguntas</div>
		<table width="700" class="tblForm">
			<tr>
				<td class="tag">#:</td>
				<td><input name="numero" type="text" id="numero" size="5" value="<?=$field['Numero']?>" readonly /></td>
			</tr>
			<tr>
				<td class="tag">Nombre del Equipo:</td>
				<td><input type="text" name="equipo" id="equipo" size="75" maxlength="100" value="<?=$field['Equipo']?>"  /></td>
				</tr><tr>
				<td class="tag">Logo:</td>
				<td><input type="file" name="logo" id="logo" size="75" maxlength="100"  value="<?=str_replace('C:fakepath','',$field['logo'])?>"/><?=str_replace('C:fakepath','',$field['logo'])?></td>
				<td><img src="../logos/2015/<?=str_replace('C:fakepath','',$field['logo'])?>" alt="" width="110" height="110" border="0" /></td>
			</tr>
		</table><br />
		
		<center>
		<input type="submit" value="Guardar" class="btGuardar" />
		<input type="button" value="Cancelar" class="btCancelar" onclick="cargarPagina('equipos.php?accion=LISTAR&limit=0');" />
		</center>
		</form>
		
		<div style="width:700px;" class="msjFooter">Todos los campos son Obligatorios</div>
	<?php } ?>
<?php } ?>
<!-- FIN EDITAR REGISTRO -->

<!-- VER REGISTRO -->    		
<?php
if ($accion=="VER") {
	$sql="SELECT Numero, Equipo FROM equipos WHERE Numero='$registro'";
	$query=mysql_query($sql) or die ($sql.mysql_error());
	$rows=mysql_num_rows($query);
	if ($rows!=0) {
		$field=mysql_fetch_array($query);
		?>
		<table width="100%" class="titulo">
			<tr>
			  <td>Equipos a Jugar  | Ver Registro</td>
			</tr>
		</table><br /><br />
		<form action="equipos.php" method="POST" name="frmEntrada" id="frmEntrada">
		<input name="fbuscar" type="hidden" id="fbuscar" value="<?=$fbuscar?>" />
		<input name="fordenar" type="hidden" id="fordenar" value="<?=$fordenar?>" />
		<div style="width:700px" class="divCaption">Preguntas</div>
		<table width="700" class="tblForm">
			<tr>
				<td class="tag">#:</td>
				<td><input name="numero" type="text" id="numero" size="5" value="<?=$field['Numero']?>" readonly /></td>
			</tr>
			<tr>
				<td class="tag">Nombre del Equipo:</td>
				<td><input type="text" name="equipo" id="equipo" size="75" maxlength="100" value="<?=$field['Equipo']?>" readonly /></td>
			</tr>
		</table><br />
		
		<center>
		<input type="button" value="Regresar a la Lista" class="btRegresar" onclick="cargarPagina('equipos.php?accion=LISTAR&limit=0');" />
		</center>
		</form>
	<?php } ?>
<?php } ?>
<!-- FIN EDITAR REGISTRO -->
</body>
</html>
