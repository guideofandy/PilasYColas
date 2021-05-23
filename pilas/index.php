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
	$lista = $_SESSION['stack'];
    $lista->rewind();
	echo '<table><tr><td><b>Numero de Atenciòn</b></td></tr>';
		if((isset($_POST['letra'])) && strtolower($_POST['letra']) == 'c'){
			if(!$lista->valid()){
            $_SESSION['timeIn'] = time();
            $_SESSION['i']++;
            $vagon = new Vagon($_SESSION['i']);
            $lista->push($vagon);
            } else {
                $_SESSION['miniQueue']++;
            }
        }
	
		if($_SESSION['timeOut'] != ($_SESSION['timeIn'] + 60)){
			$_SESSION['timeOut'] = $_SESSION['timeIn'] + 60;
		}

        while($lista->valid() || $_SESSION['miniQueue'] > 0){
			$lista->rewind();
			if(time() > $_SESSION['timeOut'] && $lista->valid()){
				$lista->Pop();
				$_SESSION['ia']++;
				while($_SESSION['miniQueue'] > 0){
					$_SESSION['i']++;
					$vagon = new Vagon($_SESSION['i']);
					$lista->push($vagon);
					$_SESSION['miniQueue']--;
				}
				$_SESSION['timeIn'] = $_SESSION['timeOut'];
				$_SESSION['timeOut'] = $_SESSION['timeIn'] + 60;
			}else break;
		}

		$lista->rewind();
		if($lista->valid()){
			echo '<tr><td class="a">Vagon: '.$_SESSION['stack']->current()->nro."</td></tr>";
		}
		echo "</table>";
	$lista->rewind();
	if($lista->valid()){
		echo "<b>Tiempo de Entrada:</b> ".date('H:i:s', $_SESSION['timeIn']).'<br>';
		echo "<b>Tiempo de salida</b> ".date('H:i:s', $_SESSION['timeOut']).'<br>';
	}
    $total = $lista->count() + $_SESSION['miniQueue'];
	echo "<br> Hay ".$total." vagones";
	$_SESSION['dinero'] = $_SESSION['ia'] * 600;	
	echo '<p>Dinero Cobrado '.$_SESSION['dinero'].' de '.$_SESSION['ia'].' vagones pintados. (Se cobra al finalizar el pintado)</p>';
	echo "Tiempo Actual: ".date('H:i:s', time());
?>
</body>
</html>