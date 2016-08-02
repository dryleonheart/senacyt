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
        $p_id = $_POST['p_id'];
        $p_lastname = $_POST['p_lastname'];
        $p_name = $_POST['p_name'];
        $d_name = $_POST['dept_name'];
        $db_host = "localhost";
        $db_user = "sa";
        $db_pw = "vamosit";
        $db_name = "senacyt_asset";
        $conn = mssql_connect($db_host, $db_user, $db_pw);
        mssql_select_db($db_name, $conn);
        
  
        
        $sql = "select asset_desc from Asset where p_id = '{$p_id}'";
        $res = mssql_query($sql, $conn);
        $resarray = mssql_fetch_array($res);
        if($resarray[0] == NULL){
            if($p_id == NULL){
            echo '<br><a href="form_list.php">invalid data</a>';
            }
            else{
                $sql = "DELETE from dbo.Person where p_id= '{$p_id}';";
                mssql_query($sql,$conn);
                
                        echo "<script> alert('success');"
        . "window.location.href = 'form_list.php';</script>";
            }
        }
        else{
            ?>
        <script>alert("failed. it is referenced by other attributes.");</script>
        <meta http-equiv="refresh" content="0;url=form_list.php">
        <?php
        }
        
        ?>
    </body>
</html>
