<?php
session_start();
?>

<body style="background:url(../imagenes/fondo_mjs_fin.png); background-repeat:no-repeat;">
<table align="center" style="font-size:60px; font-weight:bold; color:#CC6666;">
		<tr><td>RESULTADOS</td></tr>
</table></br></br></br>
  <?php
//	-----------------------------------------------
include("../lib/fphp.php");
$sql="SELECT estadistica.FlagGano, estadistica.Puntos, equipos.Equipo as Nombre, equipos.logo AS logo FROM estadistica, equipos WHERE estadistica.CodRonda='$ronda' AND estadistica.Encuentro='$encuentro' AND estadistica.Equipo=equipos.Numero";
$query=mysql_query($sql) or die ($sql.mysql_error());
$rows=mysql_num_rows($query);
$i=0;

echo '<table align="center"><tr>';
while ($field=mysql_fetch_array($query)) {
	/*$i++;
	$nombre[$i]=$field["Nombre"];
	$puntos[$i]=$field["Puntos"];
	$gano[$i]=$field["FlagGano"];
	$logo[$i]=$field["logo"];*/   //background="../logos/'.$field["logo"].'"
	if ($field["FlagGano"]=="S") {$ganador=$field["Nombre"]; $lg=$field["logo"];}
	echo '<td height="60px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		  <td><img src="../logos/2015/'.str_replace('C:fakepath','',$field['logo']).'" alt="" width="110" height="110" border="0" /></td>
		  
			<td style="font-size:40px; font-weight:bold; color:#000000;" align="center" height="110px">'.utf8_decode($field["Nombre"]).'<p>'.utf8_decode($field["Puntos"]).'</p></td>
		  	
		  ';
} echo '</tr></table>';
//	----------------------------------------------- 
?>

  
<br />

<table align="center">
  <tr>
    <td height="160" background="../imagenes/<?=$lg?>">
	  <table width="510" border="0" align="center">
		  <tr>
			<td style="font-size:50px; font-weight:bold; color:#0000FF;" align="center">&iexcl;Ganador!</td>
		  </tr>
		  <tr>
			<td style="font-size:50px; font-weight:bold; color:#0000FF;" align="center"><?=utf8_decode($ganador)?></td>
		  </tr>
	  </table>
	</td>
  </tr>
</table>

<?PHP
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
