<?
function conecta(){
    mysql_connect("localhost","MHrZbqYSvhcRZQRd","jM8Hef9BBCEAKKHe") or die(mysql_error());
    mysql_select_db("listadeespera") or die(mysql_error());
}

/**
 * Transforma data formato aaaa-mm-dd para dd/mm/aaaa ou dd de mm de aaaa
 * Fonte: https://github.com/paico/bigboss/
 *
 * @param string $data 	(aaaa-mm-dd)
 * @param bool $tipo	(if true, exibe dd/mm/aaaa, else print dd de mm de aaaa) //valor default
 * @return string	(dd/mm/aaaa)
 */
function data($data, $tipo = 0){
	if($tipo == 0){
		$data = explode("-",$data);
		$data = $data[2]."/".$data[1]."/".$data[0];
	}elseif($tipo == 1){
		//$data = explode("-",$data);
		//$data = $data[2]." de ".mes($data[1])." de ".$data[0];
	}else{
		$data = explode("/",$data);
		$data = $data[2]."-".$data[1]."-".$data[0];
        }
	return $data;
}