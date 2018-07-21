<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <title>Wylęgarnia Drobiu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
	<form action="index.php" method="post">
		<input type="text" name="imie" />
		<input type="text" name="nazwisko" />
		<input type="text" name="wiek" />
		<input type="submit" />
	</form>

	
	<?php
	
	$serveraddress = 'localhost';
	$serverlogin = 'aaartur_tmp';
	$serverpassword = '';
	$serwerdb = 'aaartur_tmp';	


	$imie = $_POST['imie'];
	$nazwisko = $_POST['nazwisko'];
	$wiek = $_POST['wiek'];



	if(isset($imie) && isset($nazwisko) && ctype_digit($wiek)){ 
	

		$connect = new mysqli($serveraddress, $serverlogin, $serverpassword, $serwerdb ); 
		

		if($connect->connect_error){ 
			die('Connect Faild: ' . $connect->connect_error); 
		}

		$sql = "INSERT INTO osoby2 (imie, nazwisko, wiek) VALUES ('$imie', '$nazwisko', '$wiek')"; 

		if($connect->query($sql) === TRUE){ 
			echo 'Zapisane!';
		}else{
			echo 'Error: ' . $sql . "<br>" . $connect->error;
		}


		$connect->close(); 
	}

	$connect2 = new mysqli($serveraddress, $serverlogin, $serverpassword, $serwerdb );

	if($connect2->connect_error){ 
		die('Connect Faild: ' . $connect2->connect_error); 
	}

	$sql2 = 'SELECT * FROM osoby2 ORDER BY imie';

	$result = $connect2->query($sql2);

	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			echo "imie: " . $row['imie'] . " nazwisko:" . $row['nazwisko'] . " wiek:" . $row['wiek']. "<br>";
		}
	}else{
		echo 'Brak danych';
	}
	echo '<br><br>';
	$sql3 = 'SELECT * FROM osoby2 ORDER BY wiek';

	$result = $connect2->query($sql3);

	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){ 
			echo "imie: " . $row['imie'] . " nazwisko:" . $row['nazwisko'] . " wiek:" . $row['wiek']. "<br>";
		}
	}else{
		echo 'Brak danych';
	}


$connect2->close();




$connect3 = new mysqli($serveraddress, $serverlogin, $serverpassword, $serwerdb );

	if($connect3->connect_error){ 
		die('Connect Faild: ' . $connect3->connect_error); 
	}


category_tree(0);
 
function category_tree($catid){
global $connect3;
 
$sql4 = "SELECT * FROM strony where id_parent ='".$catid."'";
$result = $connect3->query($sql4);
 
while($row = mysqli_fetch_object($result)):
$i = 0;
if ($i == 0) echo '
<ul>';
 echo '
<li>' . $row->nazwa;
 category_tree($row->id);
 echo '</li>
 
';
$i++;
 if ($i > 0) echo '</ul>
 
';
endwhile;
}
//close the connection
mysqli_close($connect3);



//Zadanie 4
class Osoba{

	public $dane = ['imie' => '', 'nazwisko' => '', 'wiek' => ''];

	function dodajOsobe(){
		$this->dane['imie'] = 'Piotr';
		$this->dane['nazwisko'] = 'Moje naziwsko';
		$this->dane['wiek'] = '21';
	}

	function pokazOsobe(){
		print_r($this->dane['imie']);
		print_r($this->dane['nazwisko']);
		print_r($this->dane['wiek']);
	}
}
$nowaOsoba = new Osoba();
$nowaOsoba->dodajOsobe();
$nowaOsoba->pokazOsobe();





	?>
		 
</body>
</html>	