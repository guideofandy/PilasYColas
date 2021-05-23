<?php 
	require_once "clases.php";
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styles.css">
	<title>SERVICIO</title>
</head>
<body>
	<form method="POST" action="#">
		<input type="text" name="letra" maxlength="1">
		<button>Enviar</button>
	</form>
	
	
<?php 
	$lista = $_SESSION['queue'];
	echo '<table><tr><td><b>Numero de Atenciòn</b></td></tr>';
		if(isset($_POST['letra'])){
			if(strtolower($_POST['letra']) == 'c') {
				$_SESSION['i']++;
				$lista->rewind();
				if(!$lista->valid()){
					$_SESSION['timeIn'] = time();
				}
				$vagon = new Vagon($_SESSION['i']);
				$lista->enqueue($vagon);
			}
		}
		
		$lista->rewind();
		if($_SESSION['timeOut'] != ($_SESSION['timeIn'] + 60)){
			$_SESSION['timeOut'] = $_SESSION['timeIn'] + 60;
		}

		while($lista->valid()){
			if(time() > $_SESSION['timeOut']){
				$lista->dequeue();
				$_SESSION['timeIn'] = $_SESSION['timeOut'];
				$_SESSION['timeOut'] = $_SESSION['timeIn'] + 60;
				$_SESSION['ia']++;
				$lista->rewind();
			}
			else break;
		}
		

		$lista->rewind();
		if($lista->valid()){
			echo '<tr><td class="a">Vagon: '.$_SESSION['queue']->current()->nro."</td></tr>";
		}
		echo "</table>";
	$lista->rewind();
	if($lista->valid()){
		echo "<b>Tiempo de Entrada:</b> ".date('H:i:s', $_SESSION['timeIn']).'<br>';
		echo "<b>Tiempo de salida</b> ".date('H:i:s', $_SESSION['timeOut']).'<br>';
	}
	echo "<br> Hay ".$lista->count()." vagones";
	$_SESSION['dinero'] = $_SESSION['ia'] * 600;	
	echo '<p>Dinero Cobrado '.$_SESSION['dinero'].' de '.$_SESSION['ia'].' vagones pintados. (Se cobra al finalizar el pintado)</p>';
	echo "Tiempo Actual: ".date('H:i:s', time());
?>
</body>
</html>