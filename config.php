<?php


//$con=mysqli_connect('localhost','root','','onhinee');// هذا الاتصال بدوال الماي اس كيو ال اي


/*$dsn="musql:host=localhost;dbname=onhinee;charset=utf8";
$user="root";
$password="";*/

define("dsn","mysql:host=localhost;dbname=onhinee;charset=utf8");
define("user","root");



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