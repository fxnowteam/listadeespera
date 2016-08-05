<?
function conecta(){
    mysql_connect("localhost","MHrZbqYSvhcRZQRd","jM8Hef9BBCEAKKHe") or die(mysql_error());
    mysql_select_db("listadeespera") or die(mysql_error());
}