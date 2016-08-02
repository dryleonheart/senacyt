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
                       <script type="text/javascript" src="../chk.js"></script>
 
        </script>
    </head>
    <body>
        <?php
        
        include_once("../header.php");
        include_once ("../form_search.html");
        
        // put your code here
        
        $t_id = $_POST['t_id'];
        
        $t_name = $_POST['t_name'];


      ?>
        <form method ="post" action="do_modify.php" id="myform" name='myform' onsubmit ="return validateForm('myform');"> 
        <input type='hidden' name = 't_id' value = '<?php echo $t_id;?>' >
        <br> type name : <input type='text' name='t_name' value = '<?php echo $t_name; ?>'>
        <br><input type='submit' name='submit' value = 'submit'>
       
        </form>
        <button type ="button"  onclick="history.back()"> back </button>
        
    </body>
</html>
