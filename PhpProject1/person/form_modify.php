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

            $asset_id = $_POST['asset_id'];
            $db_host = "localhost";
            $db_user = "sa";
            $db_pw = "vamosit";
            $db_name = "senacyt_asset";
            $conn = mssql_connect($db_host, $db_user, $db_pw);
            mssql_select_db($db_name, $conn);
            $sql = "select dept_id, dept_name from dbo.Department";
            $result = mssql_query($sql,$conn);


?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
<script type="text/javascript" src="../chk.js"></script>
    </head>
    <body>
        <?php
        include_once("../header.php");
        include_once ("../form_search.html");
        
        // put your code here
        $pid = $_POST['p_id'];
        $plastname = $_POST['p_lastname'];
        $pname = $_POST['p_name'];
        $deptname = $_POST['dept_name'];
        ?>
        <?php
        ?>
        
        <form method ="post" action="do_modify.php" id="myform" onsubmit ="return validateForm('myform');"> 
             <div>
                 <input type ='hidden' name ='person_id' value = '<?php echo $pid?>'>
                 lastname : <input type ="text" name ="person_lastname" id = 'p_lastname' value = '<?php echo $plastname ?>'>
                 name : <input type ="text" name ="person_name" id = 'p_name' value = '<?php echo $pname ?>'>
             </div>
             <div>
                      department : <select name ='dept_name' id = 'dept_name' selected = '<?php echo $deptname; ?>'>
                 <?php
                 while($row =  mssql_fetch_array($result)){
                     ?>
                 <option value='<?php echo $row['dept_name']?>' <?php if($row['dept_name']==$deptname){ echo "selected";}?>> <?php echo $row['dept_name']?></option>
                 <?php
                 }
                 
                 ?>
             </select>
                 
             </div>
             <div>
                 <input type="submit" name ="submit" value = "modify" onclick="return chk()">
                 
            </div>
            
        </form>
        <button type ="button"  onclick="history.back()"> back </button>
        
    </body>
</html>
