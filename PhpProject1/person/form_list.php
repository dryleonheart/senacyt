<?php
session_cache_limiter('nocache, must-revalidate');
    session_start();
    echo "account : ".$_SESSION['user_id'];
    if($_SESSION['user_id']!='admin'){
        ?>
<script>alert("sign in with admin account"); </script>
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

?>
        <form method ='post' action="../do_export_excel.php">
            <input type ='hidden' name ='searchtext' value ='<?php echo $_POST['keyword'];?>'>
            <input type ='hidden' name ='checkvalue' value =<?php echo $_POST['check'];?>>
            <input type ='submit' name ='print' value = 'excel'>
        </from>
<?php
            
            $db_host = "localhost";
            $db_user = "sa";
            $db_pw = "vamosit";
            $db_name = "senacyt_asset";
            $conn = mssql_connect($db_host, $db_user, $db_pw);
            mssql_select_db($db_name, $conn);
            $sql = "";
            if(isset($_POST['keyword'])){
                $p_name = $_POST['keyword'];
               
                $sql = $sql."select p_id , Department.dept_id as dept_id, p_lastname as lastname, p_name as name, dept_name as department, dept_location as location from Person inner join Department on Department.dept_id=Person.dept_id where 
p_name like '%{$p_name}%' or dept_name like '%{$p_name}%';";
               
            }
            else{
                $sql = $sql."select p_id, Department.dept_id as dept_id, p_lastname as lastname, p_name as name, dept_name as department, dept_location as location from Person inner join Department on Department.dept_id=Person.dept_id;";
            }
            $result = mssql_query($sql,$conn);
            echo "<table border='1'><tr>";
            for($i = 2; $i < mssql_num_fields($result); $i++) {
            $field_info = mssql_fetch_field($result, $i);
            echo "<th>{$field_info->name}</th>";
        }
        echo "<th> admin </th>";
        echo "</tr>";

// Print the data
    while($row = mssql_fetch_row($result)) {
        $num = 0;
        $arraypass[6];
        echo "<tr>";
        foreach($row as $_column) {
            if($num<=1){
               
            }
            else{
                echo '<td ><input type ="text" value = "'.$_column.'" disabled = true ></td>';
            }
            $arraypass[$num]=$_column;
            $num = $num+1;
        }
        echo '<td>';
        echo '<form method="post"> ';
        echo '<input type ="hidden" name = "p_id" value = "'.$arraypass[0].'">';
        echo '<input type ="hidden" name = "p_lastname" value = "'.$arraypass[2].'">';
        echo '<input type ="hidden" name = "p_name" value = "'.$arraypass[3].'">';
        echo'<input type ="hidden" name = "dept_name" value = "'.$arraypass[4].'">';
        echo'<input type ="hidden" name = "dept_location" value = "'.$arraypass[5].'">';
        echo '<input type="submit" name ="submit" value = "modify" formaction="form_modify.php" > ';
        echo '<input type="submit" name ="submit" value = "delete" formaction="do_delete.php"> ';
        ?><input type="submit" name ="submit" value = "view" formaction="form_person_view.php">
        
       <?php
        echo '</form> </td>';
        echo "</tr>";
    }

echo "</table>";
 ?>
        
            
        </form>
    </body>
</html>
