


<?php
include 'connessione.php';
$conn = db();
    if(array_key_exists('registrati',$_POST)){
        registrazione($conn);
    }
    if(array_key_exists('login',$_POST)){
        login($conn);
    }
            function login($conn){
                #query login controllo nickname 
                $nickname=$_POST['nickname'];
                $password=sha1($_POST['password']);
                $nick="SELECT nickname FROM autenticazione";
                $psw="SELECT password FROM autenticazione";
                $Apsw=$conn->query($psw);
                $Anickname=$conn->query($nick);

                #controllo errori
                for($i=1;$i<sizeof(mysqli_fetch_array($Anickname,MYSQLI_NUM));$i++){
                    echo"Sono dentro il primo for";
                    if($_POST['nickname']==mysqli_fetch_array($Anickname)[$i])
                    {
                        echo"controllo nickname";
                        for($i=0;$i<sizeof(mysqli_fetch_array($Apsw));$i++){
                            echo"sono dentro il secondo for";
                            if(sha1($_POST['password'])==$Apsw['password']){
                                echo"controllo password";
                                echo"
                                    <form action=../html/valutazione.html method=POST>
                                        <input type=submit value=LOGIN>
                                    </form>
                                ";
                            }
                        }
                    }
                    else{
                        echo"NICKNAME O PASSWORD ERRATI";
                    }
                }
            }

            function registrazione($conn){
                $nickname=$_POST['nickname'];
                $password=sha1($_POST['password']);
                $sql="INSERT into autenticazione (nickname, password)
                values('$nickname', '$password')";
                $query="SELECT nickname, password FROM autenticazione";
                $stmt=$conn->query($query);
                $msg="UTENTE REGISTRATO";
                $result = $conn->query($query);

                if ($result->num_rows == 0) 
                {
                    $row = $stmt->fetch_assoc();
            
                        $stmt = $conn->query($sql);
                        $conn->close();
                        echo"
                            <form action=../html/valutazione.html method=POST>
                                <input type=submit value=LOGIN>
                            </form>
                        ";
                }
                else
                {
                    while($row = $stmt->fetch_assoc())
                    {
                        echo "Sono Dentro While Controllo";

                        $contr = controllo($row);

                        if($contr)
                        {
                            $stmt = $conn->query($sql);
                            $conn->close();
                        echo"
                            <form action=../html/valutazione.html method=POST>
                                <input type=submit value=LOGIN>
                            </form>
                        ";
                        break;
                        }
                       
                    }
                }
                
               

                echo "SUS";
            }
            function controllo($row){

                echo "post " . $_POST['nickname'];
                echo "row" . $row['nickname'];

                if($_POST['nickname']==$row['nickname'])
                    {
                        echo"
                            UTENTE GIA' ESISTENTE
                            <br>
                            <form action=../html/index.html method=POST>
                                <input type=submit value=RIPROVA>
                            </form>
                        ";
                        return false;
                    }
                return true;
            }    
        ?>