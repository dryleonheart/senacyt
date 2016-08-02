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
        $dename = $_POST['dept_name'];
        $deloc = $_POST['dept_loc'];
        $db_host = "localhost";
        $db_user = "sa";
        $db_pw = "vamosit";
        $db_name = "senacyt_asset";
        $conn = MSSQL_CONNECT($db_host, $db_user, $db_pw) or DIE("DATABASE FAILED TO RESPOND."); ;
        mssql_select_db($db_name, $conn) or DIE("Table unavailable");
        $sql = "select dept_id from department where dept_name='".$dename."'";
        $res = mssql_query($sql, $conn);
        $rearray = mssql_fetch_array($res);
        if($rearray[0] == NULL){
            $sql = "insert into department (dept_name, dept_location) values ('".$dename."'".", '".$deloc."');";
            mssql_query($sql, $conn);
            echo '<a href="form_insert.php">complete</a>';
        }
        else{
            echo '<a href="form_insert.php">there is already registered</a>';
        }
        ?>
    </body>
</html>
