<?php
 if(isset($_POST['nome']))
 {
    include 'connessione.php';
    $conn = db();
    $titolo=$_POST['nome'];
    $valutazione=intval($_POST['valutazione']);
    $sql="INSERT into film (titolo, valutazione)
    values('{$titolo}', $valutazione)";
    $stmt = $conn->query($sql);
    $conn->close();
    if(array_key_exists('conferma',$_POST)){
      header("Location:../html/valutazione.html");
  }
  if(array_key_exists('risultati',$_POST)){
      header("Location:dati.php");
  }

 }

?>