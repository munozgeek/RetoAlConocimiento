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
	if ($fbuscar!="") $filtro="WHERE (Parametro LIKE '%$fbuscar%' OR Descripcion LIKE '%$fbuscar%' OR Valor LIKE '%$fbuscar%')"; else $filtro="";
	if ($fordenar=="") $orden="ORDER BY Parametro"; else $orden="ORDER BY $fordenar";
	?>
	<table width="100%" class="titulo">
		<tr>
			<td>Par&aacute;metros </td>
		</tr>
	</table><br /><br />
	<form action="parametros.php?accion=LISTAR&limit=0" method="POST" name="frmEntrada" id="frmEntrada">
	<input type="hidden" name="registro" id="registro" />
	<table width="800" class="filtro">
		<tr>
			<td align="right">Buscar:</td>
			<td><input name="fbuscar" type="text" id="fbuscar" size="45" value="<?=$fbuscar?>" /></td>
			<td align="right">Ordenar por:</td>
			<td>
				<select name="fordenar" id="fordenar">
			  		<?=ordenParametro($fordenar)?>
				</select>
			</td>
			<td align="right"><input name="btBuscar" type="submit" id="btBuscar" value="Buscar" /></td>
		</tr>
	</table><br />
	
	<?php
	//	CONSULTO LA TABLA SOLO PARA SABER EL NUMERO TOTAL DE REGISTROS
	$sql="SELECT Parametro, Descripcion, Valor FROM parametros $filtro";
	$query=mysql_query($sql) or die ($sql.mysql_error());
	$total_rows=mysql_num_rows($query);
	?>
	<table width="800" class="lista">
		<tr>
			<td><div id="rows"></div></td>
				
			<td width="25" align="center"><img id="btPrimera" src="../imagenes/primera.png" title="Primera Página" onclick="setLotes('P', <?=$total_rows?>, <?=$limit?>, 'parametros.php');" /></td>
			<td width="25" align="center"><img id="btAnterior" src="../imagenes/anterior.png" title="Página Anterior" onclick="setLotes('A', <?=$total_rows?>, <?=$limit?>, 'parametros.php');" /></a></td>
			<td width="25">Del</td><td width="25"><div id='desde'></div></td>
			<td width="25">Al</td><td width="25"><div id='hasta'></div></td>
			<td width="25" align="center"><img id="btSiguiente" src="../imagenes/proxima.png" title="Página Siguiente" onclick="setLotes('S', <?=$total_rows?>, <?=$limit?>, 'parametros.php');" /></a></td>
			<td width="25" align="center"><img id="btUltima" src="../imagenes/ultima.png" title="Última Página" onclick="setLotes('U', <?=$total_rows?>, <?=$limit?>, 'parametros.php');" /></a></td>
				
			<td width="175">&nbsp;</td>
				
			<td width="25"><img id="btNuevo" src="../imagenes/nuevo.png" title="Nuevo Registro" width="16" height="16" onclick="cargarPagina('parametros.php?accion=NUEVO');" /></td>
			<td width="25"><img id="btEditar" src="../imagenes/editar.png" title="Editar Registro" width="16" height="16" onclick="editarRegistro('parametros.php');" /></td>
			<td width="25"><img id="btVer" src="../imagenes/ver.png" title="Ver Registro" width="16" height="16" onclick="verRegistro('parametros.php');" /></td>
			<td width="25"><img id="btEliminar" src="../imagenes/eliminar.png" title="Eliminar Registro" width="16" height="16" onclick="eliminarRegistro('parametros.php', 'PARAMETROS');" /></td>
			<td width="25"><img id="btExportar" src="../imagenes/exportar.png" title="Exportar Registros a PDF" width="16" height="16" /></td>
		</tr>
	</table>
	<?php
	echo "
	<table width='800' cellpadding='0' cellspacing='0' class='grillaTable'>
		<tr>
			<td width='150' class='grillaTh'>Par&aacute;metro</td>
			<td width='500' class='grillaTh'>Descripci&oacute;n</td>
			<td class='grillaTh'>Valor</td>
		</tr>";
	//	SI SE ENCONTRO REGISTROS
	if ($total_rows!=0) {
		//	CONSULTO LA TABLA
		$sql="SELECT Parametro, Descripcion, Valor FROM parametros $filtro $orden LIMIT $limit, $MAXLIMIT";
		$query=mysql_query($sql) or die ($sql.mysql_error());
		$rows=mysql_num_rows($query);
		//	MUESTRO TABLA
		if ($rows!=0) {
			$edo="";
			for ($i=0; $i<$rows; $i++) {
				$field=mysql_fetch_array($query);
				echo "
				<tr class='grillaTr' id='".$field['Parametro']."' onclick='mClk(this, \"registro\");'>
					<td align='center' class='grillaTd'>".$field['Parametro']."</td>
					<td class='grillaTd'>".$field['Descripcion']."</td>
					<td class='grillaTd'>".$field['Valor']."</td>
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
		  <td>Par&aacute;metros  | Nuevo Registro</td>
		</tr>
	</table><br /><br />
	<form action="parametros.php" method="POST" name="frmEntrada" id="frmEntrada" onsubmit="return validarParametros('GUARDAR');">
	<input name="fbuscar" type="hidden" id="fbuscar" value="<?=$fbuscar?>" />
	<input name="fordenar" type="hidden" id="fordenar" value="<?=$fordenar?>" />
	<div style="width:700px" class="divCaption">Par&aacute;metros</div>
	<table width="700" class="tblForm">
    	<tr>
        	<td class="tag">Parámetro:</td>
        	<td><input name="parametro" type="text" id="parametro" size="10" /></td>
        </tr>
    	<tr>
        	<td class="tag">Descripción:</td>
        	<td><input type="text" name="descripcion" id="descripcion" size="75" maxlength="100"  /></td>
        </tr>
    	<tr>
        	<td class="tag">Valor:</td>
        	<td><input type="text" name="valor" id="valor" size="75" maxlength="100"  /></td>
        </tr>
	</table><br />
	
	<center>
	<input type="submit" value="Guardar" class="btGuardar" />
	<input type="button" value="Cancelar" class="btCancelar" onclick="cargarPagina('parametros.php?accion=LISTAR&limit=0');" />
	</center>
	</form>
	
	<div style="width:700px;" class="msjFooter">Todos los campos son Obligatorios</div>
<?php } ?>
<!-- FIN NUEVO REGISTRO -->

<!-- EDITAR REGISTRO -->		
<?php
if ($accion=="EDITAR") {
	$sql="SELECT Parametro, Descripcion, Valor FROM parametros WHERE Parametro='$registro'";
	$query=mysql_query($sql) or die ($sql.mysql_error());
	$rows=mysql_num_rows($query);
	if ($rows!=0) {
		$field=mysql_fetch_array($query);
		?>
		<table width="100%" class="titulo">
			<tr>
			  <td>Par&aacute;metros  | Actualizaci&oacute;n </td>
			</tr>
		</table><br /><br />
		<form action="parametros.php" method="POST" name="frmEntrada" id="frmEntrada" onsubmit="return validarParametros('ACTUALIZAR');">
		<input name="fbuscar" type="hidden" id="fbuscar" value="<?=$fbuscar?>" />
		<input name="fordenar" type="hidden" id="fordenar" value="<?=$fordenar?>" />
		<div style="width:700px" class="divCaption">Preguntas</div>
		<table width="700" class="tblForm">
			<tr>
				<td class="tag">Parámetro:</td>
				<td><input name="parametro" type="text" id="parametro" size="10" value="<?=$field["Parametro"]?>" /></td>
			</tr>
			<tr>
				<td class="tag">Descripción:</td>
				<td><input type="text" name="descripcion" id="descripcion" size="75" maxlength="100" value="<?=$field["Descripcion"]?>" /></td>
			</tr>
			<tr>
				<td class="tag">Valor:</td>
				<td><input type="text" name="valor" id="valor" size="75" maxlength="100" value="<?=$field["Valor"]?>" /></td>
			</tr>
		</table><br />
		
		<center>
		<input type="submit" value="Guardar" class="btGuardar" />
		<input type="button" value="Cancelar" class="btCancelar" onclick="cargarPagina('parametros.php?accion=LISTAR&limit=0');" />
		</center>
		</form>
		
		<div style="width:700px;" class="msjFooter">Todos los campos son Obligatorios</div>
	<?php } ?>
<?php } ?>
<!-- FIN EDITAR REGISTRO -->

<!-- VER REGISTRO -->    		
<?php
if ($accion=="VER") {
	$sql="SELECT Parametro, Descripcion, Valor FROM parametros WHERE Parametro='$registro'";
	$query=mysql_query($sql) or die ($sql.mysql_error());
	$rows=mysql_num_rows($query);
	if ($rows!=0) {
		$field=mysql_fetch_array($query);
		?>
		<table width="100%" class="titulo">
			<tr>
			  <td>Par&aacute;metros  | Ver Registro</td>
			</tr>
		</table><br /><br />
		<form action="parametros.php" method="POST" name="frmEntrada" id="frmEntrada">
		<input name="fbuscar" type="hidden" id="fbuscar" value="<?=$fbuscar?>" />
		<input name="fordenar" type="hidden" id="fordenar" value="<?=$fordenar?>" />
		<div style="width:700px" class="divCaption">Preguntas</div>
		<table width="700" class="tblForm">
			<tr>
				<td class="tag">Parámetro:</td>
				<td><input name="parametro" type="text" id="parametro" size="10" value="<?=$field["Parametro"]?>" readonly /></td>
			</tr>
			<tr>
				<td class="tag">Descripción:</td>
				<td><input type="text" name="descripcion" id="descripcion" size="75" maxlength="100" value="<?=$field["Descripcion"]?>" readonly /></td>
			</tr>
			<tr>
				<td class="tag">Valor:</td>
				<td><input type="text" name="valor" id="valor" size="75" maxlength="100" value="<?=$field["Valor"]?>" readonly /></td>
			</tr>
		</table><br />
		
		<center>
		<input type="button" value="Regresar a la Lista" class="btRegresar" onclick="cargarPagina('parametros.php?accion=LISTAR&limit=0');" />
		</center>
		</form>
	<?php } ?>
<?php } ?>
<!-- FIN EDITAR REGISTRO -->
</body>
</html>
