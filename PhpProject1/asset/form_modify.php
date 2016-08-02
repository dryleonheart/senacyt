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
            $sql = "select * from dbo.Asset where asset_id = {$asset_id};";
            $sql2 = "select * from dbo.Person order by p_name asc;";
            $sql3 = "select * from dbo.Loc order by loc_building asc, loc_floor asc, loc_desc asc;";
            $result_asset = mssql_query($sql,$conn);
            $result_person = mssql_query($sql2, $conn);
            $result_loc = mssql_query($sql3,$conn);
            $row1 = mssql_fetch_array($result_asset);
            
            
            
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
       <script type = "text/javascript">
               function isNull(text){
                      if(text==null||text==""){
                          return true;
                      }
                      else{
                          return false;
                      }
                  }
              function chk(){

                  var barcode = document.getElementById("barcode").value;     
                  var desc = document.getElementById("desc").value;
                  var brand = document.getElementById("brand").value;
                  var model = document.getElementById("model").value;
                  var serial = document.getElementById("serial").value;
                  var purchase = document.getElementById("purchase_date").value;
                  var guarantee = document.getElementById("guarantee_end").value;
                  var price = document.getElementById("purchase_price").value;
                  var provider = document.getElementById("asset_provider").value;
                  
                  if(isNull(barcode)){
                      alert("invalid barcode");
                      return false;
                  }
                  if(isNull(desc)){
                      alert("invalid description");
                      return false;
                  }
                  if(isNull(brand)){
                      alert("invalid brand");                      
                      return false;
                  }
                  if(isNull(model)){
                      alert("invalid model");   
                      return false;
                  }
                  if(isNull(serial)){
                      alert("invalid serial");   
                      return false;
                  }
                  if(isNull(purchase)){
                      alert("invalid purchase date");  
                      return false;
                  }
                  if(isNull(guarantee)){
                      alert("invalid guarantee date");  
                      return false;
                  }
                  if(isNull(price)){
                      alert("invalid price");  
                      return false;
                  }
                  if(isNull(provider)){
                      alert("invalid provider name");  
                      return false;
                  }
                  return true;
                  
                  
                  
              }
                
            
            
       
        </script>  
        
    </head>
    
    <body>
             <?php include_once("../header.php");?>
        <form method ="post" > 
              
            <input type ="hidden" name ="asset_id"  value = "<?php echo $row1['asset_id']?>">  <br>
             barcode : <input type ="text" name ="asset_barcode" id = 'barcode' value = "<?php echo $row1['asset_barcode']?>"  <br>
             description : <input type ="text" name ="asset_desc" id = 'desc' value = "<?php echo $row1['asset_desc']?>">  <br>
             brand : <input type ="text" name ="asset_brand" id = 'brand' value = "<?php echo $row1['asset_brand']?>">  <br>
             model : <input type ="text" name ="asset_model" id = 'model' value = "<?php echo $row1['asset_model']?>">  <br>
             serial : <input type ="text" name ="asset_serial" id = 'serial' value = "<?php echo $row1['asset_serial']?>">  <br>
             details : <input type ="text" name ="asset_details" id = 'serial' value = "<?php echo $row1['asset_details']?>">  <br>
             purchase date : <input type ="date" name ="asset_bought_date" id = 'purchase_date' value = "<?php echo $row1['asset_bought_date']?>">  <br>
             guarantee end : <input type ="date" name ="asset_guarantee_expired" id = 'guarantee' value = "<?php echo $row1['asset_guarantee_expired']?>">  <br>
             purchase price : <input type ="number" step="0.01" name ="asset_price" id ='price' value = "<?php echo $row1['asset_price']?>">  <br>
             provider : <input type ="text" name ="asset_provider" id = 'provider' value = "<?php echo $row1['asset_provider']?>">  <br>
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
             
             <div>
                 <input type="submit" name ="rent" value = "confirm" formaction="do_modify.php">
            </div>
        </form>
        <button type ="button"  onclick="history.back()"> back </button>
        
    </body>
</html>
