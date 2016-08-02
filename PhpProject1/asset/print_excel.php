<?php
session_start();

// Include classes
include_once('../extLib/tbs_class.php'); // Load the TinyButStrong template engine
include_once('../extLib/tbs_plugin_opentbs.php'); // Load the OpenTBS plugin

// prevent from a PHP configuration problem when using mktime() and date()
if (version_compare(PHP_VERSION,'5.1.0')>=0) {
	if (ini_get('date.timezone')=='') {
		date_default_timezone_set('UTC');
	}
}

// Initialize the TBS instance
$TBS = new clsTinyButStrong; // new instance of TBS
$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); // load the OpenTBS plugin

// ------------------------------//
// Prepare some data for the demo//
// ------------------------------//

// Retrieve the user name to display//
$yourname = (isset($_POST['yourname'])) ? $_POST['yourname'] : '';
$yourname = trim(''.$yourname);
if ($yourname=='') $yourname = "(no name)";

// A recordset for merging tables//

// Other single data items//
$in_date = $_POST['asset_in'];
$out_date = $_POST['asset_out'];
$x_in = date("d-m-Y", strtotime($in_date));
$x_out = date("d-m-Y", strtotime($out_date)); //the date format must be converted later 

$x_desc = $_POST['asset_desc'];
$x_brand = $_POST['asset_brand'];
$x_model = $_POST['asset_model'];
$x_serial = $_POST['asset_serial'];

$x_detail = $_POST['asset_details'];

$x_barcode = $_POST['asset_barcode'];

//below must be converted into real world terms
$loc_bf = $_SESSION['location_before'];

$loc_ft = $_POST['loc_id'];
$p_id = $_POST['p_id'];
$db_host = "localhost";
            $db_user = "sa";
            $db_pw = "vamosit";
            $db_name = "senacyt_asset";
            $conn = mssql_connect($db_host, $db_user, $db_pw);
            mssql_select_db($db_name, $conn);
            $p_sql ="select p_name from dbo.person where p_id = {$p_id}";
            $p_res = mssql_query($p_sql,$conn);
            $loc_bf_sql = "select * from dbo.loc where loc_id={$loc_bf}";
            $loc_bf_res = mssql_query($loc_bf_sql, $conn);
            $loc_ft_sql ="select * from dbo.loc where loc_id={$loc_ft}";
            $loc_ft_res = mssql_query($loc_ft_sql, $conn);
$p_row = mssql_fetch_array($p_res);
$loc_bf_row = mssql_fetch_array($loc_bf_res);
$loc_ft_row = mssql_fetch_array($loc_ft_res);
            

$x_curr= $loc_bf_row['loc_building']." ".$loc_bf_row['loc_floor']." ".$loc_bf_row['loc_desc'];

$x_future = $loc_ft_row['loc_building']." ".$loc_ft_row['loc_floor']." ".$loc_ft_row['loc_desc'];
$x_person = $p_row['p_name'];
// -----------------
// Load the template
// -----------------

$template = '../FormulariodePrestamosdeEquipo.xlsx';
$TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8); // Also merge some [onload] automatic fields (depends of the type of document).

// ----------------------
// Debug mode of the demo
// ----------------------
if (isset($_POST['debug']) && ($_POST['debug']=='current')) $TBS->Plugin(OPENTBS_DEBUG_XML_CURRENT, true); // Display the intented XML of the current sub-file, and exit.
if (isset($_POST['debug']) && ($_POST['debug']=='info'))    $TBS->Plugin(OPENTBS_DEBUG_INFO, true); // Display information about the document, and exit.
if (isset($_POST['debug']) && ($_POST['debug']=='show'))    $TBS->Plugin(OPENTBS_DEBUG_XML_SHOW); // Tells TBS to display information when the document is merged. No exit.

// --------------------------------------------
// Merging and other operations on the template
// --------------------------------------------

// Merge data in the first sheet
//$TBS->MergeBlock('a,b', $data);

// Merge cells (extending columns)
//$TBS->MergeBlock('cell1,cell2', $data);

// Change the current sheet


// Merge pictures of the current sheet


// Delete a sheet



// Display a sheet (make it visible)

// -----------------
// Output the result
// -----------------

// Define the name of the output file
$save_as = (isset($_POST['save_as']) && (trim($_POST['save_as'])!=='') && ($_SERVER['SERVER_NAME']=='localhost')) ? trim($_POST['save_as']) : '';
$output_file_name = str_replace('.', '_'.date('Y-m-d').$save_as.'.', $template);
if ($save_as==='') {
	// Output the result as a downloadable file (only streaming, no data saved in the server)
	$TBS->Show(OPENTBS_DOWNLOAD, $output_file_name); // Also merges all [onshow] automatic fields.
	// Be sure that no more output is done, otherwise the download file is corrupted with extra data.
	exit();
} else {
	// Output the result as a file on the server.
	$TBS->Show(OPENTBS_FILE, $output_file_name); // Also merges all [onshow] automatic fields.
	// The script can continue.
	exit("File [$output_file_name] has been created.");
}
?>

<!--<meta http-equiv="refresh" content="0;url=form_rent.php">