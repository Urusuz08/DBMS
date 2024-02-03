<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
$HOSTNAME='localhost';
$USERNAME='root';
$PASSWORD='';
$DATABASE='project';


$con=mysqli_connect($HOSTNAME,$USERNAME,$PASSWORD,$DATABASE);

if($con){
    echo "";

}else{
    die(mysqli_error($con));
}
}
?>