<?php 
    
    $conn = mysqli_connect('localhost', 'root', '', 'datingapp');

    if(mysqli_connect_errno()){
        echo "Failed to connect to MsSQL" . mysqli_connect_errno();
    }

?>