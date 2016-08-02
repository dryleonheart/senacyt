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
        $login_identity = $_POST['login_identity'];
        $db_host = "localhost";
        $db_user = "sa";
        $db_pw = "vamosit";
        $db_name = "senacyt_asset";
        $conn = mssql_connect($db_host, $db_user, $db_pw);
        mssql_select_db($db_name, $conn);
        
  
        
        $sql = "DELETE from Login where login_identity = '{$login_identity}'";
        $res = mssql_query($sql, $conn);
        $resarray = mssql_fetch_array($res);
        echo "<script> alert('success');window.location.href = 'form_list.php';</script>";
        
        ?>
    </body>
</html>
