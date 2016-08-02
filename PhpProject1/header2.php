



?>
<header>

	<nav>
		<ul>
                <button onclick="window.location.href='main.php'"> Home</button>
		<button onclick="window.location.href='asset/form_list.php'"> Asset </button>
                <?php 
                if($_SESSION['user_id']=='admin'){
                ?>                
                <button onclick="window.location.href='person/form_list.php'"> Person </button>
                <button onclick="window.location.href='dept/form_list.php'"> Department </button>
                <button onclick="window.location.href='loc/form_list.php'"> Location </button>
                <button onclick="window.location.href='type/form_list.php'"> type </button>
                <button onclick="window.location.href='asset_log/form_list.php'"> Asset_log </button>
                <button onclick="window.location.href='person_log/form_list.php'"> Person_log </button>
                <button onclick="window.location.href='dept_log/form_list.php'"> Department_log </button>
                <button onclick="window.location.href='loc_log/form_list.php'"> Location_log </button>
                <button onclick="window.location.href='../account/form_list.php'"> account </button>
               
                <?php }
                ?>     
                <button onclick="window.location.href='do_logout.php'"> logout </button>
                </ul>
            
	</nav>
	<hr>
</header>



