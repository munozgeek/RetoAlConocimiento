<?php
session_start();
include("lib/fphp.php");
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
//	
$sql="SELECT Parametro, Valor FROM parametros";
$query=mysql_query($sql) or die ($sql.mysql_error());
$rows=mysql_num_rows($query);
if ($rows!=0) {
	while ($field=mysql_fetch_array($query)) {
		if ($field["Parametro"]=="PRERONDA1") $_SESSION["LIM_ELIMINATORIA"]=$field["Valor"];
		if ($field["Parametro"]=="PRERONDA2") $_SESSION["LIM_SEMIFINAL"]=$field["Valor"];
		if ($field["Parametro"]=="PRERONDA3") $_SESSION["LIM_FINAL"]=$field["Valor"];
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- DW6 -->
<head>
<!-- Copyright 2005 Macromedia, Inc. All rights reserved. -->
<title>Reto al Conocimiento</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/mm_entertainment.css" type="text/css" />
<script type="text/javascript" language="javascript" src="js/jscript.js"></script>
</head>
<body bgcolor="">
<br  />
<div class="bordeTablaBanner">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="1043" bgcolor="#cc3300"><img src="mm_spacer.gif" alt="" width="1" height="2" border="0" /></td>
  </tr>

   <tr>
    <td><img src="mm_spacer.gif" alt="" width="1" height="2" border="0" /></td>
  </tr>

   <tr>
    <td bgcolor="#cc3300"><img src="mm_spacer.gif" alt="" width="1" height="1" border="0" /></td>
  </tr>

   <tr>
     <td height="117" colspan="2" id="dateformat"><img src="imagenes/bannerReto.png" width="1024" height="155" /></td>
   </tr>
   
   <tr>
     <td background="imagenes/fondoReto.jpg" colspan="2" align="center" id="dateformat">
	 <br  />
	 <table width="953" border="0">
       <tr>
         <td align="center"><img src="imagenes/preguntas.png" alt="" width="110" height="110" border="0" /></td>
         <td align="center"><img src="imagenes/equipos.png" alt="" width="110" height="110" border="0" /></td>
         <td align="center"><img src="imagenes/encuentros.png" alt="" width="110" height="110" border="0" /></td>
         <td align="center"><img src="imagenes/resultados.png" alt="" width="110" height="110" border="0" /></td>
        </tr>
       <tr>
         <td align="center"><span class="detailText"><a onclick="window.open('archivos/preguntas.php?accion=LISTAR&limit=0', 'formulario', 'toolbar=no, menubar=no, location=no, scrollbars=yes, height=800, width=1050, left=0, top=0, resizable=no')" href="javascript:;">Lista de Preguntas</a></span></td>
         <td align="center"><span class="detailText"><a onclick="window.open('archivos/equipos.php?accion=LISTAR&limit=0', 'formulario', 'toolbar=no, menubar=no, location=no, scrollbars=yes, height=800, width=1050, left=0, top=0, resizable=no')" href="javascript:;">Equipos a Jugar </a></span></td>
         <td align="center"><span class="detailText"><a onclick="window.open('archivos/encuentros.php?accion=LISTAR&limit=0', 'formulario', 'toolbar=no, menubar=no, location=no, scrollbars=yes, height=800, width=1050, left=0, top=0, resizable=no')" href="javascript:;">Definir Encuentros</a></span></td>
         <td align="center"><span class="detailText"><a onclick="window.open('archivos/resultados.php?accion=LISTAR&limit=0', 'formulario', 'toolbar=no, menubar=no, location=no, scrollbars=yes, height=800, width=1050, left=0, top=0, resizable=no')" href="javascript:;">Ver Resultados</a></span></td>
        </tr>
       <tr>
         <td height="97" align="center">&nbsp;</td>
         <td align="center">&nbsp;</td>
         <td align="center">&nbsp;</td>
         <td align="center">&nbsp;</td>
        </tr>
       <tr>
         <td align="center"><img src="imagenes/jugar.png" alt="" width="110" height="110" border="0" /></td>
         <td align="center"><img src="imagenes/nuevo.png" alt="" width="110" height="110" border="0" /></td>
         <td align="center"><img src="imagenes/parametros.png" alt="" width="110" height="110" border="0" /></td>
         <td align="center">&nbsp;</td>
        </tr>
       <tr>
         <td align="center"><span class="detailText"><a onclick="window.open('archivos/jugar.php?accion=LISTAR&limit=0', 'formulario', 'toolbar=no, menubar=no, location=no, scrollbars=yes, height=768, width=1280, left=0, top=0, resizable=no')" href="javascript:;">Jugar </a></span></td>
         <td align="center"><span class="detailText"><a onclick='juego_nuevo();' href="javascript:;">Juego Nuevo </a></span></td>
         <td align="center"><span class="detailText"><a onclick="window.open('archivos/parametros.php?accion=LISTAR&limit=0', 'formulario', 'toolbar=no, menubar=no, location=no, scrollbars=yes, height=900, width=1100, left=0, top=0, resizable=no')" href="javascript:;">Parámetros del Juego </a></span></td>
         <td align="center">&nbsp;</td>
        </tr>
     </table></td>
   </tr>
</table>
</div>
<br />
</body>
</html>
