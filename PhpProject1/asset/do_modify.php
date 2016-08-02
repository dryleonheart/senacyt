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
            
            $barcode = $_POST['asset_barcode'];
            $desc = $_POST['asset_desc'];
            $model = $_POST['asset_model'];
            $brand = $_POST['asset_brand'];
            $serial = $_POST['asset_serial'];
            $details = $_POST['asset_details'];
            $purchase = $_POST['asset_bought_date'];
            $guarantee = $_POST['asset_guarantee_expired'];
            $price = $_POST['asset_price'];
            $provider = $_POST['asset_provider'];        
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
                 $sql = "update dbo.Asset set asset_barcode = '{$barcode}', asset_desc = '{$desc}',"
                 . " loc_id = {$loc_id}, p_id = {$p_id}, asset_model = '{$model}', asset_brand = '{$brand}',"
                 . "asset_serial = '{$serial}', asset_details = '{$details}',  asset_bought_date = '{$purchase}', asset_guarantee_expired = '{$guarantee}',"
                 . "asset_price =  {$price}, asset_provider = '{$provider}' "
                 . "where asset_id = {$asset_id} ;";
                 
         

            
            mssql_query($sql,$conn);
            mssql_close();
?><meta http-equiv="refresh" content="0;url=form_list.php">



