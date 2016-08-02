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
                      if(text===null||text===""){
                          return true;
                      }
                      else{
                          return false;
                      }
                  }
              function chk(){

                  var name= document.getElementById("name").value;     
                  var loc = document.getElementById("loc").value;
                 
                  if(isNull(name)){
                      alert("type department name");
                      
                      
                      return false;
                  }
                  if(isNull(loc)){
                      alert("type department location");
                      return false;
                  }
                  return true;
                  
                  
                  
              }
              
                
            
            
       
        </script>
    </head>
    <body>
        <?php include_once("../header.php");?>
        
        
         <form method ="post"  action ='do_insert.php' onsubmit ="return chk()" >
             <div>
                 dept name : <input type ="text" name ="dept_name" id = 'name'>
             </div>
             <div>
                 dept loc  : <input type ="text" name ="dept_loc" id = 'loc'>
             </div>
             <div>
                 <input type="submit" name ="submit" value = "insert" >
                 
            </div>
             
        </form>
             <button type ="button"  onclick="history.back()"> back </button>
    </body>
</html>
