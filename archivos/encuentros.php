<?php
session_start();
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
	?>
	<table width="100%" class="titulo">
		<tr>
			<td>Encuentros  </td>
		</tr>
	</table><br /><br />
	<form action="encuentros.php?accion=LISTAR&limit=0" method="POST" name="frmEntrada" id="frmEntrada">
	<input type="hidden" name="registro" id="registro" /><br />
	
	<?php
	//	CONSULTO LA TABLA SOLO PARA SABER EL NUMERO TOTAL DE REGISTROS
	$sql="SELECT rondas.Ronda, encuentros.Numero, encuentros.Equipo1, encuentros.Equipo2, encuentros.Equipo3 FROM rondas, encuentros WHERE (rondas.CodRonda=encuentros.CodRonda)";
	$query=mysql_query($sql) or die ($sql.mysql_error());
	$total_rows=mysql_num_rows($query);
	?>
	<table width="800" class="lista">
		<tr>
			<td><div id="rows"></div></td>
				
			<td width="25" align="center"><img id="btPrimera" src="../imagenes/primera.png" title="Primera Página" onclick="setLotes('P', <?=$total_rows?>, <?=$limit?>, 'encuentros.php');" /></td>
			<td width="25" align="center"><img id="btAnterior" src="../imagenes/anterior.png" title="Página Anterior" onclick="setLotes('A', <?=$total_rows?>, <?=$limit?>, 'encuentros.php');" /></a></td>
			<td width="25">Del</td><td width="25"><div id='desde'></div></td>
			<td width="25">Al</td><td width="25"><div id='hasta'></div></td>
			<td width="25" align="center"><img id="btSiguiente" src="../imagenes/proxima.png" title="Página Siguiente" onclick="setLotes('S', <?=$total_rows?>, <?=$limit?>, 'encuentros.php');" /></a></td>
			<td width="25" align="center"><img id="btUltima" src="../imagenes/ultima.png" title="Última Página" onclick="setLotes('U', <?=$total_rows?>, <?=$limit?>, 'encuentros.php');" /></a></td>
				
			<td width="175">&nbsp;</td>
			
			<td width="25"><img id="btNuevo" src="../imagenes/nuevo.png" title="Nuevo Registro" width="16" height="16" onclick="cargarPagina('encuentros.php?accion=NUEVO');" /></td>
			<td width="25"><img id="btEditar" src="../imagenes/editar.png" title="Editar Registro" width="16" height="16" onclick="editarRegistro('encuentros.php');" /></td>
			<td width="25"><img id="btVer" src="../imagenes/ver.png" title="Ver Registro" width="16" height="16" onclick="verRegistro('encuentros.php');" /></td>
			<td width="25"><img id="btEliminar" src="../imagenes/eliminar.png" title="Eliminar Registro" width="16" height="16" onclick="eliminarRegistro('encuentros.php', 'ENCUENTROS');" /></td>
			<td width="25"><img id="btExportar" src="../imagenes/exportar.png" title="Exportar Registros a PDF" width="16" height="16" /></td>
		</tr>
	</table>
	<?php
	echo "
	<table width='800' cellpadding='0' cellspacing='0' class='grillaTable'>
		<tr>
			<td width='75' class='grillaTh'>#</td>
			<td class='grillaTh'>Encuentro</td>
		</tr>";
	//	SI SE ENCONTRO REGISTROS
	if ($total_rows!=0) {
		//	CONSULTO LA TABLA
		$sql="SELECT rondas.Ronda AS Ronda, encuentros.Numero AS Numero, (SELECT Equipo FROM equipos WHERE Numero=encuentros.Equipo1) AS Equipo1, (SELECT Equipo FROM equipos WHERE Numero=encuentros.Equipo2) AS Equipo2, (SELECT Equipo FROM equipos WHERE Numero=encuentros.Equipo3) AS Equipo3, rondas.CodRonda FROM rondas, encuentros WHERE (rondas.CodRonda=encuentros.CodRonda) ORDER BY rondas.CodRonda, encuentros.Numero LIMIT $limit, $MAXLIMIT";
		$query=mysql_query($sql) or die ($sql.mysql_error());
		$rows=mysql_num_rows($query);
		//	MUESTRO TABLA
		if ($rows!=0) {
			for ($i=0; $i<$rows; $i++) {
				$field=mysql_fetch_array($query);
				if ($field['Equipo3']!="") $encuentro=$field['Equipo1']." vs. ".$field['Equipo2']." vs. ".$field['Equipo3'];
				else $encuentro=$field['Equipo1']." vs. ".$field['Equipo2'];
				if ($field['Ronda']!=$ronda) { 
					echo "<tr class='grillaTr2'><td class='grillaTd' colspan='2'>".$field['Ronda']."</td></tr>"; 
					$ronda=$field['Ronda']; 
				} else $ronda=$field['Ronda'];
				echo "
				<tr class='grillaTr' id='".$field['Numero']."' onclick='mClk2(this, \"registro\", \"".$field['CodRonda']."\");'>
					<td align='center' class='grillaTd'>".$field['Numero']."</td>
					<td class='grillaTd'>".$encuentro."</td>
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
		  <td>Encuentros  | Nuevo Registro</td>
		</tr>
	</table><br /><br />
	<form action="encuentros.php" method="POST" name="frmEntrada" id="frmEntrada" onsubmit="return validarEncuentros('GUARDAR');">
	<div style="width:700px" class="divCaption">Encuentros</div>
	<table width="700" class="tblForm">
		<tr>
        	<td width="125" class="tag">*Ronda:</td>
			<td colspan="3">
				<select name="ronda" id="ronda">
					<?=optRonda($_SESSION["RONDA_ACTUAL"])?>
				</select>
			</td>
        </tr>
    	<tr>
        	<td class="tag">*Encuentro:</td>
			<td>
				<select name="encuentro" id="encuentro">
					<?=optEncuentro("", 0)?>
				</select>
			</td>
        </tr>
    	<tr>
        	<td class="tag">*Equipo 1:</td>
			<td>
				<select name="equipo1" id="equipo1">
					<option value="0">::.Seleccione un equipo.::</option>
					<?=optEquipo("", 0, $_SESSION["RONDA_ACTUAL"])?>
				</select>
			</td>
        </tr>
    	<tr>
        	<td class="tag">*Equipo 2:</td>
			<td>
				<select name="equipo2" id="equipo2">
					<option value="0">::.Seleccione un equipo.::</option>
					<?=optEquipo("", 0, $_SESSION["RONDA_ACTUAL"])?>
				</select>
			</td>
        </tr>
    	<tr>
        	<td class="tag">Equipo 3:</td>
			<td>
				<select name="equipo3" id="equipo3">
					<option value="0">::.Seleccione un equipo.::</option>
					<?=optEquipo("", 0, $_SESSION["RONDA_ACTUAL"])?>
				</select>
			</td>
        </tr>
	</table><br />
	
	<center>
	<input type="submit" value="Guardar" class="btGuardar" />
	<input type="button" value="Cancelar" class="btCancelar" onclick="cargarPagina('encuentros.php?accion=LISTAR&limit=0');" />
	</center>
	</form>
	
	<div style="width:700px;" class="msjFooter">* Campos Obligatorios </div>
    <?php } ?>
<!-- FIN NUEVO REGISTRO -->

<!-- EDITAR REGISTRO -->		
<?php
if ($accion=="EDITAR") {
	list($registro1, $registro2)=SPLIT( '[:]', $registro);
	$sql="SELECT CodRonda, Numero, Equipo1, Equipo2, Equipo3 FROM encuentros WHERE Numero='$registro1' AND CodRonda='$registro2'";
	$query=mysql_query($sql) or die ($sql.mysql_error());
	$rows=mysql_num_rows($query);
	if ($rows!=0) {
		$field=mysql_fetch_array($query);
		?>
		<table width="100%" class="titulo">
			<tr>
			  <td>Encuentros  | Actualizaci&oacute;n</td>
			</tr>
		</table><br /><br />
		<form action="encuentros.php" method="POST" name="frmEntrada" id="frmEntrada" onsubmit="return validarEncuentros('ACTUALIZAR');">
		<div style="width:700px" class="divCaption">Encuentros</div>
		<table width="700" class="tblForm">
			<tr>
				<td width="125" class="tag">*Ronda:</td>
				<td colspan="3">
					<select name="ronda" id="ronda">
						<?=optRonda($field['CodRonda'])?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="tag">*Encuentro:</td>
				<td>
					<select name="encuentro" id="encuentro">
						<?=optEncuentro($field['Numero'], 1)?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="tag">*Equipo 1:</td>
				<td>
					<select name="equipo1" id="equipo1">
						<option value="0">::.Seleccione un equipo.::</option>
						<?=optEquipo($field['Equipo1'], 0, $_SESSION["RONDA_ACTUAL"])?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="tag">*Equipo 2:</td>
				<td>
					<select name="equipo2" id="equipo2">
						<option value="0">::.Seleccione un equipo.::</option>
						<?=optEquipo($field['Equipo2'], 0, $_SESSION["RONDA_ACTUAL"])?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="tag">Equipo 3:</td>
				<td>
					<select name="equipo3" id="equipo3">
						<option value="0">::.Seleccione un equipo.::</option>
						<?=optEquipo($field['Equipo3'], 0, $_SESSION["RONDA_ACTUAL"])?>
					</select>
				</td>
			</tr>
		</table><br />
		
		<center>
		<input type="submit" value="Guardar" class="btGuardar" />
		<input type="button" value="Cancelar" class="btCancelar" onclick="cargarPagina('encuentros.php?accion=LISTAR&limit=0');" />
		</center>
		</form>
		
		<div style="width:700px;" class="msjFooter">* Campos Obligatorios </div>
	<?php } ?>
<?php } ?>
<!-- FIN EDITAR REGISTRO -->

<!-- VER REGISTRO -->    		
<?php
if ($accion=="VER") {
	list($registro1, $registro2)=SPLIT( '[:]', $registro);
	$sql="SELECT CodRonda, Numero, Equipo1, Equipo2, Equipo3 FROM encuentros WHERE Numero='$registro1' AND CodRonda='$registro2'";
	$query=mysql_query($sql) or die ($sql.mysql_error());
	$rows=mysql_num_rows($query);
	if ($rows!=0) {
		$field=mysql_fetch_array($query);
		?>
		<table width="100%" class="titulo">
			<tr>
			  <td>Encuentros  | Ver Registro</td>
			</tr>
		</table><br /><br />
		<form action="encuentros.php" method="POST" name="frmEntrada" id="frmEntrada">
		<div style="width:700px" class="divCaption">Encuentros</div>
		<table width="700" class="tblForm">
			<tr>
				<td width="125" class="tag">*Ronda:</td>
				<td colspan="3">
					<select name="ronda" id="ronda">
						<?=optRonda($field['CodRonda'])?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="tag">*Encuentro:</td>
				<td>
					<select name="encuentro" id="encuentro">
						<?=optEncuentro($field['Numero'], 1)?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="tag">*Equipo 1:</td>
				<td>
					<select name="equipo1" id="equipo1">
						<?=optEquipo($field['Equipo1'], 1, $_SESSION["RONDA_ACTUAL"])?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="tag">*Equipo 2:</td>
				<td>
					<select name="equipo2" id="equipo2">
						<?=optEquipo($field['Equipo2'], 1, $_SESSION["RONDA_ACTUAL"])?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="tag">Equipo 3:</td>
				<td>
					<select name="equipo3" id="equipo3">
						<?=optEquipo($field['Equipo3'], 1, $_SESSION["RONDA_ACTUAL"])?>
					</select>
				</td>
			</tr>
		</table><br />
		
		<center>
		<input type="button" value="Regresar a la Lista" class="btRegresar" onclick="cargarPagina('encuentros.php?accion=LISTAR&limit=0');" />
		</center>
		</form>
	<?php } ?>
<?php } ?>
<!-- FIN EDITAR REGISTRO -->
</body>
</html>
