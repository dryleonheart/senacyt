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

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php

        // put your code here
        $loc_id = $_POST['loc_id'];
        $loc_building = $_POST['loc_building'];
        $loc_floor = $_POST['loc_floor'];
        $loc_desc = $_POST['loc_desc'];
        $db_host = "localhost";
        $db_user = "sa";
        $db_pw = "vamosit";
        $db_name = "senacyt_asset";
        $conn = mssql_connect($db_host, $db_user, $db_pw);
        mssql_select_db($db_name, $conn);
        

        
        $sql = "UPDATE dbo.Loc SET loc_building ='{$loc_building}', loc_floor = '{$loc_floor}', loc_desc = '{$loc_desc}' WHERE loc_id = {$loc_id};";
   
        mssql_query($sql,$conn);
        
        $sql = "select loc_id, loc_building, loc_floor, loc_desc from dbo.Loc where loc_id = ".$loc_id.";";
    
        $res = mssql_query($sql, $conn);
        
        $rearray = mssql_fetch_array($res);
        
     
       ?>
        
        <meta http-equiv="refresh" content="0;url=form_list.php">
           <?php
        ?>
    </body>
</html>
