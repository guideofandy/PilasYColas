<?php  
	class Vagon{
		public $nro;
		function __construct($i){
			$this->nro = $i;
		}
	}


	session_start();
	if(!isset($_SESSION['stack'])){
		$_SESSION['stack'] = new SplStack();
		$_SESSION['i'] = 0;
		$_SESSION['dinero'] = 0;
		$_SESSION['ia'] = 0;
		$_SESSION['timeIn'] = 0;
		$_SESSION['timeOut'] = 0;
        $_SESSION['miniQueue'] = 0;
	}
	
?>