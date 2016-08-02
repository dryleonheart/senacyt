<?php

session_cache_limiter('nocache, must-revalidate');

    session_start();
  echo "account : ".$_SESSION['user_id'];
    if($_SESSION['user_id']!='admin'){    
        ?>
<script>alert("no access right");</script>
<meta http-equiv="refresh" content="0;url=../main.php">
<?php
    }
        
?>

<?php 
session_start();
    if(!isset($_POST['asset_id'])){
       ?> <meta http-equiv="refresh" content="0;url=../index.php"><?php
    }
            $asset_id = $_POST['asset_id'];
            $db_host = "localhost";
            $db_user = "sa";
            $db_pw = "vamosit";
            $db_name = "senacyt_asset";
            $conn = mssql_connect($db_host, $db_user, $db_pw);
            mssql_select_db($db_name, $conn);
            $sql = "select * from dbo.Asset where asset_id = {$asset_id};";
            $sql2 = "select * from dbo.Person;";
            $sql3 = "select * from dbo.Loc;";
            $result_asset = mssql_query($sql,$conn);
            $result_person = mssql_query($sql2, $conn);
            $result_loc = mssql_query($sql3,$conn);
            $row1 = mssql_fetch_array($result_asset);
            
            
            
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script type="text/javascript" src="../chk.js"></script>
    </head>
    <body>
        <?php        include_once '../header.php';?>
       <form method ="post" action="do_rent.php" id="myform" onsubmit=" return validateForm('myform')"> 

             
            <input type = 'hidden' name ='asset_id' value ='<?php echo $row1['asset_id']?>'> 
            
             barcode : <input type ="text" name ="asset_barcode" value = "<?php echo $row1['asset_barcode']?>" disabled>   <br>
             description : <input type ="text" name ="asset_desc" value = "<?php echo $row1['asset_desc']?>" disabled>  <br>
             brand : <input type ="text" name ="asset_brand" value = "<?php echo $row1['asset_brand']?>" disabled >  <br>
             model : <input type ="text" name ="asset_model" value = "<?php echo $row1['asset_model']?>"  disabled >  <br>
             serial : <input type ="text" name ="asset_serial" value = "<?php echo $row1['asset_serial']?>" disabled>  <br>
             details : <input type ="text" name ="asset_details" value = "<?php echo $row1['asset_details']?>" disabled>  <br>
             bought date : <input type ="date" name ="asset_bought_date" value = "<?php echo $row1['asset_bought_date']?>" disabled>  <br>
             gurantee end : <input type ="date" name ="asset_guarantee_expired" value = "<?php echo $row1['asset_guarantee_expired']?>" disabled>  <br>
             purchase price : <input type ="number" step="0.01" name ="asset_price" value = "<?php echo $row1['asset_price']?>" disabled>  <br>
             provider : <input type ="text" name ="asset_provider" value = "<?php echo $row1['asset_provider']?>" disabled >  <br>
             person who is assigned to :
             <select name ='p_id'>
                 <?php
                    mssql_fetch_array($result_person);
                 while($row2 =  mssql_fetch_array($result_person)){
                     ?>
                 <option value='<?php echo $row2['p_id']?>'> <?php echo $row2['p_name']?></option>
                 <?php
                 }
                 ?>
             </select>
            location : 
            <select name='loc_id'>
            <?php
                 
                 while($row3 =  mssql_fetch_array($result_loc)){
                     ?>
                 <option value='<?php echo $row3['loc_id']?>'> <?php echo $row3['loc_building']." ".$row3['loc_floor']." ".$row3['loc_desc']?></option>
                 <?php
                 }
                 ?>
            
             </select>
            <div>lease date <input type='date' name ='asset_out' value = '<?php echo date("Y-m-d");?>'></div>
            
            
             <div>
                 
                 <input type="submit" name ="optype" value = "assign" >
            </div>
        </form>
        
<button type ="button"  onclick="history.back()"> back </button>
        
    </body>
</html>
