<?php
session_start();
?>

<body>
<table align="center" style="font-size:60px; font-weight:bold; color:#541E86;">
		<tr><td>RESULTADOS</td></tr>
</table>
<?php
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

if ($i==3) {
	?>
	<div style="background-color:#CDCDCD; position:absolute; left: 20px; top: 207px; width: 323px; height: 75px; border:3px ridge #FFFFFF;">
	<table align="center" style="font-size:24px; font-weight:bold;">
		<tr><td align="center"><?=$nombre[1]?></td></tr>
		<tr><td align="center" style="font-size:36px; color:#FF0000;"><?=$puntos[1]?></td></tr>
	</table>
	</div>
	
	<div style="background-color:#CDCDCD; position:absolute; left: 353px; top: 207px; width: 323px; height: 75px; border:3px ridge #FFFFFF;">
	<table align="center" style="font-size:24px; font-weight:bold;">
		<tr><td align="center"><?=$nombre[2]?></td></tr>
		<tr><td align="center" style="font-size:36px; color:#FF0000;"><?=$puntos[2]?></td></tr>
	</table>
</div>
	
	<div style="background-color:#CDCDCD; position:absolute; left: 686px; top: 207px; width: 323px; height: 75px; border:3px ridge #FFFFFF;">
	<table align="center" style="font-size:24px; font-weight:bold;">
		<tr><td align="center"><?=$nombre[3]?></td></tr>
		<tr><td align="center" style="font-size:36px; color:#FF0000;"><?=$puntos[3]?></td></tr>
	</table>
</div>
	
	<div style="background-color:#CDCDCD; position:absolute; left: 245px; top: 300px; width: 564px; height: 75px; border:3px ridge #FFFFFF;">
	<table align="center" style="font-size:24px; font-weight:bold;">
		<tr><td align="center">&iexcl;GANADOR!</td></tr>
		<tr><td align="center" style="font-size:36px; color:#FF0000;"><?=$ganador?></td></tr>
	</table>
</div>	
	<?php
} else {
	?>
	<div style="background-color:#CDCDCD; position:absolute; left: 176px; top: 207px; width: 323px; height: 75px; border:3px ridge #FFFFFF;">
	<table align="center" style="font-size:24px; font-weight:bold;">
		<tr><td align="center"><?=$nombre[1]?></td></tr>
		<tr><td align="center" style="font-size:36px; color:#FF0000;"><?=$puntos[1]?></td></tr>
	</table>
</div>
	
	<div style="background-color:#CDCDCD; position:absolute; left: 509px; top: 207px; width: 323px; height: 75px; border:3px ridge #FFFFFF;">
	<table align="center" style="font-size:24px; font-weight:bold;">
		<tr><td align="center"><?=$nombre[2]?></td></tr>
		<tr><td align="center" style="font-size:36px; color:#FF0000;"><?=$puntos[2]?></td></tr>
	</table>
</div>
	
	<div style="background-color:#CDCDCD; position:absolute; left: 244px; top: 300px; width: 564px; height: 75px; border:3px ridge #FFFFFF;">
	<table align="center" style="font-size:24px; font-weight:bold;">
		<tr><td align="center">&iexcl;GANADOR!</td></tr>
		<tr><td align="center" style="font-size:36px; color:#FF0000;"><?=$ganador?></td></tr>
	</table>
</div>	
	<?php
}
?>

<?
//	
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
?>
<embed src="../imagenes/sonido/resultados.mp3" autostart="true" loop="false" hidden="true">
</body>