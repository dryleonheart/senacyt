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
        $locbuild = $_POST['loc_building'];
        $locfloor = $_POST['loc_floor'];
        $locdesc = $_POST['loc_desc'];
        $db_host = "localhost";
        $db_user = "sa";
        $db_pw = "vamosit";
        $db_name = "senacyt_asset";
        $conn = MSSQL_CONNECT($db_host, $db_user, $db_pw) or DIE("DATABASE FAILED TO RESPOND."); ;
        mssql_select_db($db_name, $conn) or DIE("Table unavailable");
        $sql = "select loc_id from dbo.Loc where (loc_building='".$locbuild."' and loc_floor = "."'".$locfloor."'and loc_desc= "."'".$locdesc."');";
        $res = mssql_query($sql, $conn);
        $rearray = mssql_fetch_array($res);
        if($rearray[0] == NULL && $locbuild !=NULL && $locfloor !=NULL && $locdesc !=NULL){
            $sql = "INSERT into dbo.Loc (loc_building, loc_floor, loc_desc) values ('".$locbuild."'".", '".$locfloor."'".", '".$locdesc."');";
            mssql_query($sql, $conn);
                    echo "<script> alert('success');"
        . "window.location.href = 'form_list.php';</script>";
        }
        else{
                                echo "<script> alert('already registered');"
        . "window.location.href = 'form_list.php';</script>";
          
        }
        ?>
    </body>
</html>
