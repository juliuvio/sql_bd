<?
  $dblocation = "localhost";
  $dbname = "hospital";
  $dbuser = "root";
  $dbpasswd = "";
  $id = @mysql_connect($dblocation,$dbuser,$dbpasswd);
  if (!$id) exit("<p>К сожалению, не доступен сервер MySQL".mysql_error()."</p>");
  if (!@mysql_select_db($dbname,$id)) exit("<p>К сожалению, не доступна база данных: ".mysql_error()."</p>");
  mysql_query('set character set utf8');
?>