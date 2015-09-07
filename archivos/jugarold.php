<?php
session_start();
include("../lib/fphp.php");
$sql="SELECT status.CodRonda, status.Encuentro, status.Turno, rondas.Ronda, encuentros.Equipo1, encuentros.Equipo2, encuentros.Equipo3, (SELECT Equipo FROM equipos WHERE Numero=encuentros.Equipo1) AS Nombre1, (SELECT Equipo FROM equipos WHERE Numero=encuentros.Equipo2) AS Nombre2, (SELECT Equipo FROM equipos WHERE Numero=encuentros.Equipo3) AS Nombre3, resultados.Puntos1, resultados.Puntos2, resultados.Puntos3 FROM status, rondas, encuentros, resultados WHERE (status.CodRonda=encuentros.CodRonda AND status.Encuentro=encuentros.Numero) AND (status.CodRonda=rondas.CodRonda) AND (status.CodRonda=resultados.CodRonda AND status.Encuentro=resultados.Numero)";
$query=mysql_query($sql) or die ($sql.mysql_error());
$rows=mysql_num_rows($query);
if ($rows==0) echo "ERROR.... No se han definido encuentros que jugar o la tabla que indica que encuento viene esta vacio....";
else {
	$field=mysql_fetch_array($query);
	if ($field["Turno"]=="1") { 
		$divColorTurno1="color:#0028B3;"; $imgSRCTurno1="../imagenes/turno.png"; $divColorTurno2=""; $imgSRCTurno2="../imagenes/mm_spacer.gif"; $divColorTurno3="";$imgSRCTurno3="../imagenes/mm_spacer.gif";
	} elseif ($field["Turno"]=="2") {
		$divColorTurno2="color:#0028B3;"; $imgSRCTurno2="../imagenes/turno.png"; $divColorTurno1=""; $imgSRCTurno1="../imagenes/mm_spacer.gif"; $divColorTurno3="";$imgSRCTurno3="../imagenes/mm_spacer.gif";
	} else {
		$divColorTurno3="color:#0028B3;"; $imgSRCTurno3="../imagenes/turno.png"; $divColorTurno1=""; $imgSRCTurno1="../imagenes/mm_spacer.gif"; $divColorTurno2="";$imgSRCTurno2="../imagenes/mm_spacer.gif";
	}
	
	$sql="SELECT * FROM turnos WHERE CodRonda='".$field["CodRonda"]."' AND Encuentro='".$field["Encuentro"]."'";
	$query_turnos=mysql_query($sql) or die ($sql.mysql_error());
	$rows_turnos=mysql_num_rows($query_turnos);
	if ($rows_turnos!=0) {
		$field_turnos=mysql_fetch_array($query_turnos);
		$turnos1=$field_turnos["Equipo1"];
		$turnos2=$field_turnos["Equipo2"];
		$turnos3=$field_turnos["Equipo3"];
	} else {
		$turnos1=0;
		$turnos2=0;
		$turnos3=0;
	}
	
	?>	 
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="../css/main.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" language="javascript" src="../js/jscript.js"></script>
	</head>
	<body style="background-color:#FFFFFF">
	<div id="divSonido"></div>
	
	<embed src="../imagenes/sonido/fondo1.mp3" autostart="true" loop="false" hidden="true">
	
	
	<div id="divCargando" style="position:absolute; top:40%; left:45%; display:none;">
		<img src="../imagenes/cargando.gif" /><br />
		Procesando...
	</div>
	
	<input type="hidden" name="ronda" id="ronda" value="<?=$field["CodRonda"]?>" />
	<input type="hidden" name="encuentro" id="encuentro" value="<?=$field["Encuentro"]?>" />
	<input type="hidden" name="turno" id="turno" value="<?=$field["Turno"]?>" />
	<input type="hidden" name="status" id="status" value="0" />
	<input type="hidden" name="pregunta" id="pregunta" value="" />
	<input type="hidden" name="respuesta" id="respuesta" value="" />
	<input type="hidden" name="responder" id="responder" value="" />
	<input type="hidden" name="respondido" id="respondido" value="0" />
	<input type="hidden" name="puntos" id="puntos" value="1" />
	<input type="hidden" name="equipo1" id="equipo1" value="<?=$field["Equipo1"]?>" />
	<input type="hidden" name="equipo2" id="equipo2" value="<?=$field["Equipo2"]?>" />
	<input type="hidden" name="equipo3" id="equipo3" value="<?=$field["Equipo3"]?>" />
	
	<!-- IMPRIMO LA RONDA -->
	<table width="100%" class="titulo">
		<tr>
			<td><?=$field["Ronda"]?> | Encuentro <?=$field["Encuentro"]?></td>
		</tr>
	</table>
	
	<!-- MUESTRO LOS EQUIPOS Y LOS PUNTOS ACUMULADOS POR EQUIPO -->
	<table align="center">
		<tr>
			<td width="342">
            	<table width="100%">
                	<tr>
                    	<td valign="bottom">
                        	<img src="../imagenes/minus.png" width="16" height="16" style="cursor:pointer;" onclick="restar(1, <?=$field["Equipo1"]?>, '<?=$field["Nombre1"]?>');" /> 
                        	<img src="../imagenes/add.png" width="16" height="16" style="cursor:pointer;" onclick="sumar(1, <?=$field["Equipo1"]?>, '<?=$field["Nombre1"]?>');" />
                        </td>
                    	<td align="right">
							<div id="divTurnos1" style="width:30px; background-color:#CDCDCD; font-size:24px; color:#006600; text-align:center; font-weight:bold;"><?=$turnos1?></div>
                        </td>
                    </tr>
                </table>
			</td>
			<td width="342">
            	<table width="100%">
                	<tr>
                    	<td valign="bottom">
                        	<img src="../imagenes/minus.png" width="16" height="16" style="cursor:pointer;" onclick="restar(2, <?=$field["Equipo2"]?>, '<?=$field["Nombre2"]?>');" /> 
                        	<img src="../imagenes/add.png" width="16" height="16" style="cursor:pointer;" onclick="sumar(2, <?=$field["Equipo2"]?>, '<?=$field["Nombre2"]?>');" />
                        </td>
                    	<td align="right">
							<div id="divTurnos2" style="width:30px; background-color:#CDCDCD; font-size:24px; color:#006600; text-align:center; font-weight:bold;"><?=$turnos2?></div>
                        </td>
                    </tr>
                </table>
			</td>
			<?php if ($field["Equipo3"]!="0") {	?>	
                <td width="342">
                    <table width="100%">
                        <tr>
                            <td valign="bottom">
                                <img src="../imagenes/minus.png" width="16" height="16" style="cursor:pointer;" onclick="restar(3, <?=$field["Equipo3"]?>, '<?=$field["Nombre3"]?>');" /> 
                        		<img src="../imagenes/add.png" width="16" height="16" style="cursor:pointer;" onclick="sumar(3, <?=$field["Equipo3"]?>, '<?=$field["Nombre3"]?>');" />
                            </td>
                            <td align="right">
                                <div id="divTurnos3" style="width:30px; background-color:#CDCDCD; font-size:24px; color:#006600; text-align:center; font-weight:bold;"><?=$turnos3?></div>
                            </td>
                        </tr>
                    </table>
                </td>
			<?php } ?>
		</tr>
	</table>
        
	<table height="78" align="center">
	  <tr>
		<td width="342" height="50" align="center" valign="center" background="../imagenes/div1.png">
			<table onclick="cambiarTurno();">
				<tr>
					<td width="270" rowspan="2" valign="top">
						<div id="divTurno1" style="font-weight:bold; font-size:18px; <?=$divColorTurno1?>">
							<img id="imgTurno1" src="<?=$imgSRCTurno1?>" />&nbsp; <?=$field["Nombre1"]?> 
						</div>
					</td>
					<td width="30" align="center">&nbsp;</td>
				</tr>
				<tr><td align="right" valign="bottom"><div id="divPuntos1" style="font-weight:bold; font-size:30px; color:#FF0000"><?=$field["Puntos1"]?></div></td></tr>
			</table>
		</td>
		<td width="342" height="50" align="center" valign="center" background="../imagenes/div1.png">
			<table onclick="cambiarTurno();">
				<tr>
					<td width="270" rowspan="2" valign="top">
						<div id="divTurno2" style="font-weight:bold; font-size:18px; <?=$divColorTurno2?>">
							<img id="imgTurno2" src="<?=$imgSRCTurno2?>" />&nbsp; <?=$field["Nombre2"]?> 
						</div>
					</td>
					<td width="30" align="center">&nbsp;</td>
				</tr>
				<tr><td align="right" valign="bottom"><div id="divPuntos2" style="font-weight:bold; font-size:30px; color:#FF0000"><?=$field["Puntos2"]?></div></td></tr>
			</table>
		</td>
		<?php
		if ($field["Equipo3"]!="0") {
			?>
			<td width="342" height="50" align="center" valign="center" background="../imagenes/div1.png">
				<table onclick="cambiarTurno();">
					<tr>
						<td width="270" rowspan="2" valign="top">
							<div id="divTurno3" style="font-weight:bold; font-size:18px; <?=$divColorTurno3?>">
								<img id="imgTurno3" src="<?=$imgSRCTurno3?>" />&nbsp; <?=$field["Nombre3"]?> 
							</div>
						</td>
						<td width="30" align="center">&nbsp;</td>
					</tr>
					<tr><td align="right" valign="bottom"><div id="divPuntos3" style="font-weight:bold; font-size:30px; color:#FF0000"><?=$field["Puntos3"]?></div></td></tr>
				</table>
			</td>
		<?php	
		}
		?>
	  </tr>
	</table>
	
	<!-- MUESTRO LA PREGUNTA SELECCIONADA -->
	<table align="center">
      <tr>
        <td width="1043" height="194" background="../imagenes/div2.png" align="center" valign="top">
			<div id="divPregunta" style="font-weight:bold; font-size:22px; margin-top:50px; margin-right:50px; margin-left:5px;"></div>
		</td>
      </tr>
    </table>
	
	<!-- MUESTRO LAS OPCIONES DE RESPUESTAS A LA PREGUNTA SELECCIONADA -->
	<table align="center">
      <tr>
        <td width="396" height="116" id="tdOpcionA" style="background:url('../imagenes/div3.png');" onclick="seleccionarOpcion('A')">
		  <table width="99%">
              <tr id="trOpcionA">
                <td width="10%" align="center" style="font-size:30px; font-weight:bold;5">A</td>
                <td><div id="divOpcionA" style="font-weight:bold; font-size:14px;"></div></td>
                <td width="10%"><img src="../imagenes/mm_spacer.gif" id="imgStatusA" src="" width="40" height="40" /></td>
              </tr>
          </table>
		</td>
        
		<td width="250" rowspan="2" align="center" valign="bottom">
			<?
			if ($field["CodRonda"]=="1") {
				?>
				<div id="divContador" style="display:none;">
				<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="32" height="32">
				  <param name="movie" value="../imagenes/flash/15seg.swf" />
				  <param name="quality" value="high" />
				  <embed src="../imagenes/flash/15seg.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="200" height="200"></embed>
				</object>
				<input type="button" name="btResponder" id="btResponder" value="Responder" onclick="procesarRespuesta();" disabled="disabled" style="width:175px; font-size:14px; font-weight:bold; letter-spacing:5px;" />
				</div>
				<?
			} else {
				?>
				<div id="divContador" style="display:none;">
				<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="32" height="32">
				  <param name="movie" value="../imagenes/flash/minuto.swf" />
				  <param name="quality" value="high" />
				  <embed src="../imagenes/flash/minuto.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="200" height="200"></embed>
				</object>
				<input type="button" name="btResponder" id="btResponder" value="Responder" onclick="procesarRespuesta();" disabled="disabled" style="width:175px; font-size:14px; font-weight:bold; letter-spacing:5px;" />
				</div>
				<?
			}
			?>
		</td>
        
        <td width="396" height="116" style="background:url('../imagenes/div3.png');" onclick="seleccionarOpcion('B')">
		  <table width="99%">
              <tr id="trOpcionB">
                <td width="10%" align="center" style="font-size:30px; font-weight:bold;5">B</td>
                <td><div id="divOpcionB" style="font-weight:bold; font-size:14px;"></div></td>
                <td width="10%"><img src="../imagenes/mm_spacer.gif" id="imgStatusB" src="" width="40" height="40" /></td>
              </tr>
          </table>
		</td>
      </tr>
	  
      <tr>
        <td width="396" height="116" style="background:url('../imagenes/div3.png');" onclick="seleccionarOpcion('C')">
		  <table width="99%">
              <tr id="trOpcionC">
                <td width="10%" align="center" style="font-size:30px; font-weight:bold;5">C</td>
                <td><div id="divOpcionC" style="font-weight:bold; font-size:14px;"></div></td>
                <td width="10%"><img src="../imagenes/mm_spacer.gif" id="imgStatusC" src="" width="40" height="40" /></td>
              </tr>
          </table>
		</td>
		
        
        <td width="396" height="116" style="background:url('../imagenes/div3.png');" onclick="seleccionarOpcion('D')">
		  <table width="99%">
              <tr id="trOpcionD">
                <td width="10%" align="center" style="font-size:30px; font-weight:bold;5">D</td>
                <td><div id="divOpcionD" style="font-weight:bold; font-size:14px;"></div></td>
                <td width="10%"><img src="../imagenes/mm_spacer.gif" id="imgStatusD" src="" width="40" height="40" /></td>
              </tr>
          </table>
		</td>
      </tr>
    </table>
	
	<hr color="#336699" size="1px" />
	<!-- MUESTRO LAS PREGUNTAS QUE LE TOCA A LA RONDA ACTUAL -->
	<?
	$sql1="SELECT Pregunta FROM historial WHERE Ronda='".$field["CodRonda"]."'";
	$query1=mysql_query($sql1) or die ($sql1.mysql_error());
	while ($historial=mysql_fetch_array($query1)) {
		$id=$historial["Pregunta"];
		$pregunta[$id]=$id;
	}
	//------
	$sql2="SELECT * FROM preguntas WHERE Ronda='".$field['CodRonda']."' ORDER BY Numero";
	$query2=mysql_query($sql2) or die ($sql2.mysql_error());
	$rows2=mysql_num_rows($query2);
	if ($rows2!=0) {
		$cols=0; $i=1;
		echo "<table align='center'><tr>";
		while($preguntas=mysql_fetch_array($query2)) {
			$id=$preguntas["Numero"];
			if ($preguntas["Numero"]==$pregunta[$id]) { $disabled="disabled"; $color="#FF0000"; } else { $disabled=""; $color="#000000"; }
			echo "<td><input type='button' name='".$preguntas['Numero']."' id='".$preguntas['Numero']."' value='".$i."' style='width:40px; height:25px; vertical-align:text-top; font-weight:bold; font-size:16px; color:$color;' onclick='procesarPregunta(this.id);' $disabled /></td>";
			$cols++; if ($cols==25) { echo "</tr><tr>"; $cols=0; }
			$i++;
		}
		if (cols!=20) echo "</tr>";
		echo "</table>";
	}
	?>
	<hr color="#336699" size="1px" />
	<table align="center">
		<tr>
			<td><input type="button" name="btSiguiente" id="btSiguiente" value="Siguiente Turno" onclick="cambiarTurno();" disabled="disabled" /> | </td>
			<td><input type="button" value="Anular Respuesta" id="btAnular" onclick="anular();" disabled="disabled" /> | </td>
			<td><input type="button" value="Anular Pregunta" id="btAnularPregunta" onclick="location.href='jugar.php'" disabled="disabled" /> | </td>
			<td><input type="button" value="Finalizar Encuentro" onclick="finEncuentro();" /></td>
		</tr>
	</table>
	
	</body>
	</html> 
<?php
}
?>
