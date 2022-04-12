<?php 

//file ini berhubungan langsung degan database


function getConn(){
    $conn = mysqli_connect("localhost","root","","ujicoba");
    // $conn = mysqli_connect("sql108.epizy.com","epiz_31493034","o1D4khGn0JoiCjn","epiz_31493034_ujicoba");
    return $conn;
}


?>