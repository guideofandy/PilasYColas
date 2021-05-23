<?php  
	class Vagon{
		public $nro;
		function __construct($i){
			$this->nro = $i;
		}
	}


	session_start();
	if(!isset($_SESSION['queue'])){
		$_SESSION['queue'] = new SplQueue();
		$_SESSION['i'] = 0;
		$_SESSION['dinero'] = 0;
		$_SESSION['ia'] = 0;
		$_SESSION['timeIn'] = 0;
		$_SESSION['timeOut'] = 0;
	}
	
?>