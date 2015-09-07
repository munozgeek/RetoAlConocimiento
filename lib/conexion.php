<?php
//	FUNCION PARA CONECTARSE CON MYSQL
function conexion()
{
    mysql_connect("localhost", "root", '123456') or die ("NO SE PUDO CONECTAR CON EL SERVIDOR MYSQL!");
    mysql_select_db("reto_mun") or die ("NO SE PUDO CONECTAR CON LA BASE DE DATOS!");
    mysql_query("SET NAMES 'utf8'");
}

?>
