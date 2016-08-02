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

                  var building = document.getElementById("building").value;     
                  var floor = document.getElementById("floor").value;
                  var desc = document.getElementById("desc").value;
                 
                  if(isNull(building)||isNull(floor)||isNull(desc)){
                      alert("invalid input");
                      return false;
                  }
                  return true;
              }  
        </script>
    </head>
    <body>
        <?php include_once("../header.php");?>
        <form method ="post" onsubmit='return chk()' action ='do_insert.php' >
             <div>
                 location building : <input type ="text" name ="loc_building" id = 'building'>
             </div>
             <div>
                 location floor  : <input type ="text" name ="loc_floor" id ='floor'>
             </div>
             <div>
                 location desc  : <input type ="text" name ="loc_desc" id = 'desc'>
             </div>
             <div>
                 <input type="submit" name ="submit" value = "insert">
                 
            </div>
        </form>
        <button type ="button"  onclick="history.back()"> back </button>
    </body>
</html>
