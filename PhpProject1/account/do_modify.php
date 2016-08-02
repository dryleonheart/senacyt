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
        $p_id = $_POST['person_id'];
        $p_lastname = $_POST['person_lastname'];
        $p_name = $_POST['person_name'];
        $d_name = $_POST['dept_name'];
        $db_host = "localhost";
        $db_user = "sa";
        $db_pw = "vamosit";
        $db_name = "senacyt_asset";
        $conn = mssql_connect($db_host, $db_user, $db_pw);
        mssql_select_db($db_name, $conn);

        
        $sql = "SELECT dept_id from Department where dept_name = '{$d_name}';";
        $res = mssql_query($sql, $conn);
        
        $rearray  = mssql_fetch_array($res);
        $d_id = $rearray[0];
        if($d_id == NULL){
            echo '<br><a href="form_modify.php">that department is unknowned</a>';
        }
        else{
            $sql = "UPDATE dbo.Person SET p_lastname ='{$p_lastname}', p_name ='{$p_name}', dept_id = {$d_id} WHERE p_id = {$p_id};";
            mssql_query($sql,$conn);
        
            $sql = "select p_id, p_lastname, p_name, dept_id from dbo.Person where p_id = ".$p_id.";";
            $res = mssql_query($sql, $conn);
  
            $rearray = mssql_fetch_array($res);
        
         
        }
        ?>
        <script>alert("done"); </script>
        <meta http-equiv="refresh" content="0;url=form_list.php">
    </body>
</html>
