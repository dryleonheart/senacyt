<?php
if(!isset($_POST['user_id']) || !isset($_POST['user_pw'])) exit;
$user_id = $_POST['user_id'];
$user_pw = $_POST['user_pw'];

$db_host = "localhost";
$db_user = "sa";
$db_pw = "vamosit";
$db_name = "senacyt_asset";
$conn = mssql_connect($db_host, $db_user, $db_pw);
mssql_select_db($db_name, $conn);
$sql = "select login_identity from Login WHERE PWDCOMPARE('".$user_pw."', login_password ) =1 and login_identity = '".$user_id."'";
$result = mssql_query($sql, $conn);
$result = mssql_fetch_array($result);
if($result[0] != NULL){
    session_start();
    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_name'] = $members[$user_id]['name'];
    ?>
    <meta http-equiv='refresh' content='0;url=main.php'>
    <?php
}
else{
    ?>
    <meta http-equiv='refresh' content='0;url=index.php'>
    <?php
}
?>