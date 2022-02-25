<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/css.css">
    </head>
    <body>
        <div id="div2">
        <h1>Valutazioni Inserite</h1>
        <hr>
        <?php
           include 'connessione.php';
           $conn=db();
           echo"
           <h4>Elenco valutazioni per film</h4>
           ";
           $sql="SELECT titolo, max(valutazione) as max
           FROM film
           GROUP BY titolo";
           $risultati=$conn->query($sql);
           $rows=array();
           while($row=mysqli_fetch_array($risultati)){
               $rows[]=$row;
               $titolo=stripslashes($row['titolo']);
               $valutazione=stripslashes($row['max']);
               echo"$titolo $valutazione <br>";
           }
           echo"
            <h4>media valutazioni film</h4>
           ";
           $sql="SELECT titolo, AVG(valutazione) AS Media
           FROM film
           GROUP BY titolo";
           $risultati=$conn->query($sql);
           $rows=array();
           while($row=mysqli_fetch_array($risultati)){
               $rows[]=$row;
               $titolo=stripslashes($row['titolo']);
               $media=stripslashes($row['Media']);
               echo"$titolo $media <br>";
           }

           echo"
            <h4>Film con valutazione massima: </h4>
           ";
           $sql="SELECT titolo, max(valutazione) AS max
           FROM film
           GROUP BY titolo
           ORDER BY valutazione DESC LIMIT 1";
           $risultati=$conn->query($sql);
           $rows=array();
           while($row=mysqli_fetch_array($risultati)){
               $rows[]=$row;
               $titolo=stripslashes($row['titolo']);
               $valutazione=stripslashes($row['max']);
               echo"$titolo $valutazione <br><br><br>";
           }
           
        ?>
        </div>
        
    </body>
</html>