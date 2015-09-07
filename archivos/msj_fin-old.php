<?php
session_start();
?>

<body style="background:url(../imagenes/fondo_mjs_fin.png); background-repeat:repeat;">
<table align="center" style="font-size:60px; font-weight:bold; color:#CC6666;">
		<tr><td>RESULTADOS</td></tr>
</table>
  <?php
//	-----------------------------------------------
include("../lib/fphp.php");
$sql="SELECT estadistica.FlagGano, estadistica.Puntos, equipos.Equipo AS Nombre FROM estadistica, equipos WHERE estadistica.CodRonda='$ronda' AND estadistica.Encuentro='$encuentro' AND estadistica.Equipo=equipos.Numero";
$query=mysql_query($sql) or die ($sql.mysql_error());
$rows=mysql_num_rows($query);
$i=0;
while ($field=mysql_fetch_array($query)) {
	$i++;
	$nombre[$i]=$field["Nombre"];
	$puntos[$i]=$field["Puntos"];
	$gano[$i]=$field["FlagGano"];
	if ($field["FlagGano"]=="S") $ganador=$field["Nombre"];
}
//	----------------------------------------------- 
?>

<br />

<table align="center">
  <tr>
    <td height="105" background="../imagenes/fondo_mjs_fin_equipo.png">
	  <table width="450" border="0" align="center">
		  <tr>
			<td style="font-size:40px; font-weight:bold; color:#FFFFFF;"><?=$nombre[1]?></td>
		  </tr>
		  <tr>
			<td align="right" style="font-size:40px; font-weight:bold; color:#CC6666;"><?=$puntos[1]?></td>
		  </tr>
	  </table>
	</td>
    <td height="105" background="../imagenes/fondo_mjs_fin_equipo.png">
	  <table width="450" border="0" align="center">
		  <tr>
			<td style="font-size:40px; font-weight:bold; color:#FFFFFF;"><?=$nombre[2]?></td>
		  </tr>
		  <tr>
			<td align="right" style="font-size:40px; font-weight:bold; color:#CC6666;"><?=$puntos[2]?></td>
		  </tr>
	  </table>
	</td>
  </tr>
</table>

<br />

<table align="center">
  <tr>
    <td height="160" background="../imagenes/fondo_mjs_fin_equipo_2.png">
	  <table width="510" border="0" align="center">
		  <tr>
			<td style="font-size:50px; font-weight:bold; color:#FFFF66;" align="center">&iexcl;Ganador!</td>
		  </tr>
		  <tr>
			<td style="font-size:50px; font-weight:bold; color:#FFFF66;" align="center"><?=$ganador?></td>
		  </tr>
	  </table>
	</td>
  </tr>
</table>

<?
//	-----------------------------------------------
$sql="SELECT CodRonda, Encuentro, Turno FROM status";
$query=mysql_query($sql) or die ($sql.mysql_error());
$rows=mysql_num_rows($query);
if ($rows!=0) {
	$field=mysql_fetch_array($query);
	$_SESSION["RONDA_ACTUAL"]=$field[0];
	$_SESSION["ENCUENTRO_ACTUAL"]=$field[1];
	$_SESSION["TURNO_ACTUAL"]=$field[2];
} else {
	$sql="INSERT INTO status VALUES ('1', '1', '1')";
	$query=mysql_query($sql) or die ($sql.mysql_error());
	$_SESSION["RONDA_ACTUAL"]=1;
	$_SESSION["ENCUENTRO_ACTUAL"]=1;
	$_SESSION["TURNO_ACTUAL"]=1;
}
//	-----------------------------------------------
?>
<embed src="../imagenes/sonido/resultados.mp3" autostart="true" loop="false" hidden="true">
</body>