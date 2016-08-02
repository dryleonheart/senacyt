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
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
<?php
            include_once("../header.php");
            include_once ("../form_search.html");

            
            $db_host = "localhost";
            $db_user = "sa";
            $db_pw = "vamosit";
            $db_name = "senacyt_asset";
            $conn = mssql_connect($db_host, $db_user, $db_pw);
            mssql_select_db($db_name, $conn);
            $sql = "";
            if(isset($_POST['keyword'])){
                $loc_name = $_POST['keyword'];
                
                $sql = $sql."select t_id, t_name from tipo where t_name like '%{$loc_name}%';";
         
            }   
            else{
                $sql = $sql."select t_id, t_name from tipo";
            }
            $result = mssql_query($sql,$conn);
            ?>
        <table border ="1">
            <tr> 
            
                <th>type name</th>
                <th>admin</th>
            </tr> 
        <?php
            while($row=  mssql_fetch_array($result)){
            ?>
            <tr>
       
                <td> <?php echo $row['t_name'];
                 $a = $row['t_id'];
                $b = $row['t_name'];?> </td>
              
                <td>
                    <form method ='post' >
                        <input type="hidden" name ="t_id" value ='<?php echo $a;?>' >
                        <input type="hidden" name ="t_name" value ='<?php echo $b;?>' >
                        <input type='submit' name ='submit' value ='modify' formaction = "form_modify.php">
                        <input type='submit' name ='submit' value ='delete' formaction="do_delete.php">
                    </form>
                </td>
        
                
            </tr>
               
            
    <?php
            }
?>
            </table>
    </body>
</html>


