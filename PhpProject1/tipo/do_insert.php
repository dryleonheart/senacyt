<?php

session_cache_limiter('nocache, must-revalidate');

    session_start();
    
    if($_SESSION['user_id']!='admin'){    
        ?>
<script>alert("no access right");</script>
<meta http-equiv="refresh" content="0;url=../main.php">
<?php
    }
        
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php

        // put your code here
        $t_id = $_POST['t_id'];
        $t_name = $_POST['t_name'];

        $db_host = "localhost";
        $db_user = "sa";
        $db_pw = "vamosit";
        $db_name = "senacyt_asset";
        $conn = MSSQL_CONNECT($db_host, $db_user, $db_pw) or DIE("DATABASE FAILED TO RESPOND."); ;
        mssql_select_db($db_name, $conn) or DIE("Table unavailable");
        $sql = "select t_id from dbo.tipo where t_name='{$t_name}';";
      
        $res = mssql_query($sql, $conn);
        $rearray = mssql_fetch_array($res);
        if($t_name != NULL && $rearray==NULL){
           
            $sql = "INSERT into dbo.tipo (t_name) values ('{$t_name}')";
            $r = mssql_query($sql, $conn);
            if($r){
                echo "<script> alert('success');"
        . "window.location.href = 'form_list.php';</script>";
            }
            else{
               ?>
                  <script> alert('undefined error');"
        . "window.location.href = 'form_list.php';</script>" 
                   <?php
            }
                    
        }
        else{
            echo "<script> alert('already registered');"
        . "window.location.href = 'form_list.php';</script>";
          
        }
        ?>
    </body>
</html>
