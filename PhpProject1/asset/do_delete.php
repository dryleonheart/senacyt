<?php

session_cache_limiter('nocache, must-revalidate');

    session_start();
    if(!isset($_POST['asset_id'])){
?>
<script>alert("invalid access");</script>
<meta http-equiv="refresh" content="0;url=../main.php">
    <?php }
    
    $id = $_POST['asset_id'];
    $sql = "delete from Asset where asset_id={$id};";
      $db_host = "localhost";
        $db_user = "sa";
        $db_pw = "vamosit";
        $db_name = "senacyt_asset";
        $conn = mssql_connect($db_host, $db_user, $db_pw);
        mssql_select_db($db_name, $conn);
        $res = mssql_query($sql, $conn);
        if(!$res){
            ?> <script> alert("delete failed");</script><?php
        }
        else{
        ?> <script> alert("delete success");</script><?php
        }
?>
             <meta http-equiv="refresh" content="0;url=form_list.php">
        
    </body>
</html>
