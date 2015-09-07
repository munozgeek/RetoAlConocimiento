<?php
session_start();
include("../lib/fphp.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" language="javascript" src="../js/jscript.js"></script>
</head>
<body>
<table width="100%" class="titulo">
	<tr>
		<td>Resultados  </td>
	</tr>
</table><br /><br />

<?php
$sql="SELECT estadistica.CodRonda, rondas.Ronda FROM estadistica, rondas WHERE (estadistica.CodRonda=rondas.CodRonda) GROUP BY (estadistica.CodRonda)";
$query_rondas=mysql_query($sql) or die ($sql.mysql_error());
$rows_rondas=mysql_num_rows($query_rondas);
for ($i_rondas=1; $i_rondas<=$rows_rondas; $i_rondas++) {
	$field_rondas=mysql_fetch_array($query_rondas);
	echo "
	<table align='center' cellpadding='5' cellspacing='5'>
  		<tr>";
	$sql="SELECT encuentros.Numero, (SELECT Equipo FROM equipos WHERE equipos.Numero=encuentros.Equipo1) AS Nombre1,(SELECT logo FROM equipos WHERE equipos.Numero=encuentros.Equipo1) AS logo1, (SELECT Equipo FROM equipos WHERE equipos.Numero=encuentros.Equipo2) AS Nombre2, (SELECT logo FROM equipos WHERE equipos.Numero=encuentros.Equipo2) AS logo2,(SELECT Equipo FROM equipos WHERE equipos.Numero=encuentros.Equipo3) AS Nombre3, (SELECT logo FROM equipos WHERE equipos.Numero=encuentros.Equipo3) AS logo3,(SELECT Puntos FROM estadistica WHERE encuentros.Equipo1=estadistica.Equipo AND encuentros.Numero=estadistica.Encuentro AND encuentros.CodRonda=estadistica.CodRonda) AS Puntos1, (SELECT Puntos FROM estadistica WHERE encuentros.Equipo2=estadistica.Equipo AND encuentros.Numero=estadistica.Encuentro AND encuentros.CodRonda=estadistica.CodRonda) AS Puntos2, (SELECT Puntos FROM estadistica WHERE encuentros.Equipo3=estadistica.Equipo AND encuentros.Numero=estadistica.Encuentro AND encuentros.CodRonda=estadistica.CodRonda) AS Puntos3
FROM encuentros WHERE encuentros.CodRonda='".$field_rondas["CodRonda"]."'";
	$query_encuentros=mysql_query($sql) or die ($sql.mysql_error());
	$rows_encuentros=mysql_num_rows($query_encuentros);
	for ($i_encuentros=1; $i_encuentros<=$rows_encuentros; $i_encuentros++) {
		$field_encuentros=mysql_fetch_array($query_encuentros);
		if ($field_encuentros["Nombre3"]!="") {
			echo "
			<td>
				<table width='450' cellpadding='0' cellspacing='0' style='font-size:10px; border:1px solid #000000; height:30px;'>
				  <tr>
					<td width='125' align='center' rowspan='2' style='background-color:#AFAFAF; font-weight:bold;'><img src='../logos/2015/".str_replace('C:fakepath','',$field_encuentros['logo1'])."' alt='' width='110' height='110' border='0' />".$field_encuentros["Nombre1"]."</td>
					<td style='background-color:#AFAFAF'>&nbsp;</td>
					<td width='15' rowspan='2' align='center' style='background-color:#010101; color:#FFFFFF'>vs</td>
					<td width='125' align='center' rowspan='2' style='background-color:#AFAFAF; font-weight:bold;'><img src='../logos/2015/".str_replace('C:fakepath','',$field_encuentros['logo2'])."' alt='' width='110' height='110' border='0' />".$field_encuentros["Nombre2"]."</td>
					<td style='background-color:#AFAFAF'>&nbsp;</td>
					<td width='15' rowspan='2' align='center' style='background-color:#010101; color:#FFFFFF'>vs</td>
					<td width='125' align='center' rowspan='2' style='background-color:#AFAFAF; font-weight:bold;'><img src='../logos/2015/".str_replace('C:fakepath','',$field_encuentros['logo3'])."' alt='' width='110' height='110' border='0' />".$field_encuentros["Nombre3"]."</td>
					<td style='background-color:#AFAFAF'>&nbsp;</td>
				  </tr>
				  <tr>
					<td align='center' style='background-color:#AFAFAF; font-weight:bold; font-size:20px; color:#FF0000;'>".$field_encuentros["Puntos1"]."</td>
					<td align='center' style='background-color:#AFAFAF; font-weight:bold; font-size:20px; color:#FF0000;'>".$field_encuentros["Puntos2"]."</td>
					<td align='center' style='background-color:#AFAFAF; font-weight:bold; font-size:20px; color:#FF0000;'>".$field_encuentros["Puntos3"]."</td>
				  </tr>
				</table>
			</td>";
		} else {
			echo "
			<td>
				<table width='300' cellpadding='0' cellspacing='0' style='font-size:10px; border:1px solid #000000; height:30px;'>
				  <tr>
					<td width='125' align='center' rowspan='2' style='background-color:#AFAFAF; font-weight:bold;'><img src='../logos/2015/".str_replace('C:fakepath','',$field_encuentros['logo1'])."' alt='' width='110' height='110' border='0' />".$field_encuentros["Nombre1"]."</td>
					<td style='background-color:#AFAFAF'>&nbsp;</td>
					<td width='15' rowspan='2' align='center' style='background-color:#010101; color:#FFFFFF'>vs</td>
					<td width='125' align='center' rowspan='2' style='background-color:#AFAFAF; font-weight:bold;'><img src='../logos/2015/".str_replace('C:fakepath','',$field_encuentros['logo2'])."' alt='' width='110' height='110' border='0' />".$field_encuentros["Nombre2"]."</td>
					<td style='background-color:#AFAFAF'>&nbsp;</td>
				  </tr>
				  <tr>
					<td align='center' style='background-color:#AFAFAF; font-weight:bold; font-size:20px; color:#FF0000;'>".$field_encuentros["Puntos1"]."</td>
					<td align='center' style='background-color:#AFAFAF; font-weight:bold; font-size:20px; color:#FF0000;'>".$field_encuentros["Puntos2"]."</td>
				  </tr>
				</table>
			</td>";
		}
	}
	echo "
		</tr>
	</table><br /><br />";
}
?>

<embed src="../imagenes/sonido/ganador.mp3" autostart="true" loop="false" hidden="true">
</body>
</html>

