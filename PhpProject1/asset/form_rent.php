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

    if(!isset($_POST['asset_id'])){
        header("Location : ../main.php");
    }
            $asset_id = $_POST['asset_id'];
   
            
            $db_host = "localhost";
            $db_user = "sa";
            $db_pw = "vamosit";
            $db_name = "senacyt_asset";
            $conn = mssql_connect($db_host, $db_user, $db_pw);
            mssql_select_db($db_name, $conn);
            $sql = "select * from dbo.Asset where asset_id =".$asset_id;
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
             <?php include_once("../header.php");
              $_SESSION['location_before'] = $row1['loc_id'];
             
             ?>
        <form method ="post"  id="myform" onsubmit="return validateForm('myform')" > 
             
            
             <input type ="hidden" name ="asset_id" value = "<?php echo $row1['asset_id']?>">   <br>
             
             barcode : <input type ="hidden" name ="asset_barcode" value = "<?php echo $row1['asset_barcode']?>" > <?php echo $row1['asset_barcode']?> <br>
             description : <input type ="hidden" name ="asset_desc" value = "<?php echo $row1['asset_desc']?>" > <?php echo $row1['asset_desc']?> <br>
             brand : <input type ="hidden" name ="asset_brand" value = "<?php echo $row1['asset_brand']?>" > <?php echo $row1['asset_brand']?> <br>
             model : <input type ="hidden" name ="asset_model" value = "<?php echo $row1['asset_model']?>"   > <?php echo $row1['asset_model']?> <br>
             serial : <input type ="hidden" name ="asset_serial" value = "<?php echo $row1['asset_serial']?>" > <?php echo $row1['asset_serial']?> <br>
             details : <input type ="hidden" name ="asset_details" value = "<?php echo $row1['asset_details']?>" > <?php echo $row1['asset_details']?> <br>
             bought date : <input type ="hidden" name ="asset_bought_date" value = "<?php echo $row1['asset_bought_date']?>" > <?php echo $row1['asset_bought_date']?> <br>
             gurantee end : <input type ="hidden" name ="asset_guarantee_expired" value = "<?php echo $row1['asset_guarantee_expired']?>" > <?php echo $row1['asset_guarantee_expired']?> <br>
             purchase price : <input type ="hidden" step="0.01" name ="asset_price" value = "<?php echo $row1['asset_price']?>"><?php echo $row1['asset_price']?> <br>
             provider : <input type ="hidden" name ="asset_provider" value = "<?php echo $row1['asset_provider']?>"  > <?php echo $row1['asset_provider']?> <br>
             details : <input type ='hidden' name ='asset_details' value ='<?php echo $row1['asset_details'];?>' > <?php echo $row1['asset_details'];?> <br>
             person who rent :
             
             <select name ='p_id'>
                 <?php
              
                 while($row2 =  mssql_fetch_array($result_person)){
                     ?>
                 <option value='<?php echo $row2['p_id']?>'> <?php echo $row2['p_name']?></option>
                 <?php
                 }
                 ?>
             </select>
             <br>
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
            <div>lease date <input type='date' name ='asset_out' value = '<?php echo date("Y-m-d");?>'required > </div>
            <div> return date <input type ='date' name ='asset_in' value = '<?php echo date("Y-m-d");?>'required>  </div>
            
             <div>
                 
                 <input type="submit" name ="optype" value = "confirm" formaction="do_rent.php">
                 <input type="submit" name ="excel" value = "excel" formaction="print_excel.php">
            </div>
        </form>
        
    </body>
</html>
