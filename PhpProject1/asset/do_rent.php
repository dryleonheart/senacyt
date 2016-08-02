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
            $asset_id = $_POST['asset_id'];
            $in = $_POST['asset_in'];
            $out = $_POST['asset_out'];
            $loc_id = $_POST['loc_id'];
            $p_id  = $_POST['p_id'];
            $today = date("Y-m-d");
            $db_host = "localhost";
            $db_user = "sa";
            $db_pw = "vamosit";
            $db_name = "senacyt_asset";
            $conn = mssql_connect($db_host, $db_user, $db_pw);
            mssql_select_db($db_name, $conn);
            $z =0;
            $sql= "";
            if(isset($_POST['asset_in'])){
               
                 $sql = "update dbo.Asset set asset_in = '{$in}', asset_out = '{$out}', loc_id = {$loc_id}, p_id = {$p_id}, pos={$z}, "
                . "asset_last_touch = '{$today}'  "
                . "where asset_id = {$asset_id} ;";
            }
            
            else{
            $sql = "update Asset set asset_in = '9999-12-31', asset_out = '{$out}', loc_id ={$loc_id}, p_id = {$p_id}, pos={$z}, "
            . "asset_last_touch = '{$today}'  "
            . "where asset_id = {$asset_id} ;";
            }

            
            mssql_query($sql,$conn);
            mssql_close();
?><meta http-equiv="refresh" content="0;url=form_list.php">



