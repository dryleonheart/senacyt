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
   
        $db_host = "localhost";
        $db_user = "sa";
        $db_pw = "vamosit";
        $db_name = "senacyt_asset";
        $conn = mssql_connect($db_host, $db_user, $db_pw);
        mssql_select_db($db_name, $conn);
        
 
        
        $sql = "select asset_desc from Asset where loc_id = '{$loc_id}'";
        $res = mssql_query($sql, $conn);
        $resarray = mssql_fetch_array($res);
        if($resarray[0] == NULL){
            if($loc_id == NULL){
            echo '<br><a href="form_list.php">invalid data</a>';
            }
            else{
                $sql = "DELETE from dbo.Loc where loc_id= '{$loc_id}';";
                mssql_query($sql,$conn);
               ?>
        <script> alert("delete success");
         window.location.href = 'form_list.php';</script>
        <?php
            }
        }
        else{
        ?>
        <script> alert("deletion failed. The location is referenced by Asset");
       
    </script>
          <meta http-equiv="refresh" content="0;url=form_list.php">
        <?php
            
        }
        
        ?>
    </body>
</html>
