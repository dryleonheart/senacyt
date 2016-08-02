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
        $dept_id = $_POST['dept_id'];
        $dept_name = $_POST['dept_name'];
        $dept_location = $_POST['dept_location'];
        $db_host = "localhost";
        $db_user = "sa";
        $db_pw = "vamosit";
        $db_name = "senacyt_asset";
        $conn = mssql_connect($db_host, $db_user, $db_pw);
        mssql_select_db($db_name, $conn);
        

        
        $sql = "UPDATE dbo.Department SET dept_name ='{$dept_name}', dept_location = '{$dept_location}' WHERE dept_id = {$dept_id};";
        mssql_query($sql,$conn);
        
        $sql = "select dept_id, dept_name, dept_location from dbo.Department where dept_id = ".$dept_id.";";
        $res = mssql_query($sql, $conn);
        
        $rearray = mssql_fetch_array($res);
        if($res){
            ?>
        <script>alert("modification success");</script>
                <meta http-equiv="refresh" content="0;url=form_list.php">
                <?php
        }
        else{
            ?>
                <script>alert("modification failed");</script>
                <meta http-equiv="refresh" content="0;url=form_list.php">
                <?php
        }
        
       
        ?>
    </body>
</html>
