<?php

$HOSTNAME='localhost';
$USERNAME='root';
$PASSWORD='';
$DATABASE='project';


$conn=new mysqli($HOSTNAME,$USERNAME,$PASSWORD,$DATABASE);

if($conn){
    echo "";

}else{
    die(mysqli_error($conn));
}

?>