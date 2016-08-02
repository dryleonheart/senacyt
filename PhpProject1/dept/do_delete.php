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
        $d_id = $_POST['dept_id'];
        $d_name = $_POST['dept_name'];
        $d_location = $_POST['dept_location'];
        $db_host = "localhost";
        $db_user = "sa";
        $db_pw = "vamosit";
        $db_name = "senacyt_asset";
        $conn = mssql_connect($db_host, $db_user, $db_pw);
        mssql_select_db($db_name, $conn);

        
        $sql = "select p_name from Person where dept_id = '{$d_id}'";
        $res = mssql_query($sql, $conn);
        $resarray = mssql_fetch_array($res);
        if($resarray[0] == NULL){
            if($d_id == NULL){
            echo '<br><a href="form_list.php">invalid data</a>';
            }
            else{
                $sql = "DELETE from dbo.Department where dept_id= '{$d_id}';";
                mssql_query($sql,$conn);
                ?>
        
                <script>alert("success");</script>
                <meta http-equiv="refresh" content="0;url=form_list.php">
                <?php
            }
        }
        else{
            ?>
                <script>alert("it is referenced by others");</script>
                 <meta http-equiv="refresh" content="0;url=form_list.php">
        
            <?php
        }
        
        ?>
    </body>
</html>
