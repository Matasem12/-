<?php

/*$dsn="musql:host=localhost;dbname=online;charset=utf8";
$user="root";
$password="";*/

define("dsn","mysql:host=localhost;dbname=onhinee;charset=utf8");
define("user","root");
//define("password","123شش");


/*if(con){
    echo "connected";
}
else{
    echo "failed conncted";
}*/
try{
    $con=new PDO(dsn,user);
    //echo "connected";
}
catch(PDOException $e){
    die($e->getMessage()); //يقتل العملية
}

?>