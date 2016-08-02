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
        <form method ="post" action ="do_insert.php" onsubmit = "return chk()">
             
       
             barcode : <input type ="text" name ="asset_barcode" id = "barcode">  <br>
             description : <input type ="text" name ="asset_desc" id = "desc" >  <br>
             brand : <input type ="text" name ="asset_brand" id = "brand">  <br>
             model : <input type ="text" name ="asset_model" id = "model">  <br>
             serial : <input type ="text" name ="asset_serial" id = "serial">  <br>
             details : <input type ="text" name ="asset_details" id = "details">  <br>
             purchase date : <input type ="date" name ="asset_bought_date" id = "purchase_date">  <br>
             gurantee end : <input type ="date" name ="asset_guarantee_expired" id = "guarantee_end">  <br>
             purchase price : <input type ="number" step="0.01" name ="asset_price" id = "purchase_price">  <br>
             provider : <input type ="text" name ="asset_provider" id = "asset_provider">  <br>

           
             <div>
                 <input type="submit" name ="submit" value = "insert">
           
            </div>
             <button type ="button"  onclick="history.back()"> back </button>
        </form>
        
    </body>
</html>
