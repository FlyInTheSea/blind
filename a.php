<?php


class a {
	function jian(){
 echo get_called_class();

	}

}


class b extends a {



}


$c = new b();

$c->jian();

