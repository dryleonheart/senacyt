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
        <?php

        // put your code here
        $p_lastname = $_POST['p_lastname'];
        $p_name = $_POST['p_name'];
        $d_name = $_POST['dept_name'];

        $db_host = "localhost";
        $db_user = "sa";
        $db_pw = "vamosit";
        $db_name = "senacyt_asset";
        $conn = mssql_connect($db_host, $db_user, $db_pw);
        mssql_select_db($db_name, $conn);
        
        $sql = "select dept_id from Department where dept_name = '{$d_name}'";
        $res = mssql_query($sql, $conn);
        $rearray = mssql_fetch_array($res);
        $d_id = $rearray[0];
        
        $sql = "INSERT into person (p_lastname, p_name, dept_id) values('".$p_lastname."',"."'".$p_name."',"."".$d_id.");";
        mssql_query($sql,$conn);
        
        $sql = "select p_id, p_lastname, p_name, dept_id from dbo.Person where p_id = (select max(p_id) from dbo.person)";
        $res = mssql_query($sql, $conn);
        
        $rearray = mssql_fetch_array($res);
        echo "<script> alert('success');"
        . "window.location.href = 'form_list.php';</script>";
      
        
       
       

