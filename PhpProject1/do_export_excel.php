<?php
header( "Content-type: application/vnd.ms-excel; charset=euc-kr" );
header( "Expires: 0" );
header( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
header( "Pragma: public" );
header( "Content-Disposition: attachment; filename=export.xls" );
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        
    </head>
    
    <body>
       
        <?php  
            $db_host = "localhost";
            $db_user = "sa";
            $db_pw = "vamosit";
            $db_name = "senacyt_asset";
            $conn = mssql_connect($db_host, $db_user, $db_pw);
            mssql_select_db($db_name, $conn);
            $sql = "";
            $check = $_POST['checkvalue'];
            if(isset($_POST['searchtext'])){
                $p_name = $_POST['searchtext'];
                $sql = $sql."select asset_id, asset_barcode barcode, 
                asset_desc _description,
                asset_brand brand,
                asset_model model,
                asset_serial serialnumber,
                asset_bought_date purchase_date,
                asset_last_touch last_handled,
                asset_guarantee_expired guarantee_expired,
                asset_out out_date,
                asset_in in_date,
                asset_price price,
           
                asset_provider _provider,
		p_name person, dept_name department,
                loc_building as building, loc_floor as _floor, loc_desc location_description,
                pos as available
		 from Asset A inner join Person P on A.p_id = P.p_id inner join Loc L on L.loc_id= A.loc_id inner join Department D on D.dept_id = P.dept_id where L.loc_building like '%".$p_name."%' or  asset_brand  like '%".$p_name."%' or asset_desc like '%".$p_name."%'"
                        . " or asset_barcode like '%".$p_name."%'";
            }
            else if($check==1){
                $sql = $sql."select asset_id, 
                asset_barcode barcode, 
                asset_desc _description,
                asset_brand brand,
                asset_model model,
                asset_serial serialnumber,
                asset_bought_date purchase_date,
                asset_last_touch last_handled,
                asset_guarantee_expired guarantee_expired,
                asset_out out_date,
                asset_in in_date,
                asset_price price,
           
                asset_provider _provider,
		p_name person, dept_name department,
                loc_building as building, loc_floor as _floor, loc_desc location_description,
                pos as available
		from Asset A inner join Person P on A.p_id = P.p_id inner join Loc L on L.loc_id= 
                A.loc_id inner join Department D on D.dept_id = P.dept_id where asset_last_touch <= '".$delay_to_check."'";
            }
            else{
                
                $sql = $sql."select asset_id, asset_barcode barcode, 
asset_desc _description,
 asset_brand brand,
  asset_model model,
   asset_serial serialnumber,
    asset_bought_date purchase_date,
	 asset_last_touch last_handled,
	  asset_guarantee_expired guarantee_expired,
	   asset_out out_date,
	    asset_in in_date,
	   asset_price price,
           
	    asset_provider _provider,
		 p_name person, dept_name department,
	    loc_building as building, loc_floor as _floor, loc_desc location_description,
            pos as available
		 from Asset A inner join Person P on A.p_id = P.p_id inner join Loc L on L.loc_id= A.loc_id inner join Department D on D.dept_id = P.dept_id ;";
            }
            $result = mssql_query($sql,$conn);
            ?>
                
        <table border ='1'>
            <th>barcode</th>
            <th>description</th>
            <th>brand</th>
            <th>model</th>
            <th>ssn</th>
            <th>purchase date</th>
            <th>expired date </th>
            <th>asset out</th>
            <th>asset in</th>
            <th>price</th>
            <th>service provider</th>
            <th>person</th>
            <th>department</th>
            <th>building</th>
            <th>floor</th>
            <th>location description</th>
            <th> possible </th>
            
<?php
while($row = mssql_fetch_array($result)) {
?>
            <tr>
                <td id="centro"><?php echo $row['barcode'];?></td>
                <td id="centro"><?php echo $row['_description'];?></td>
                <td id="centro"><?php echo $row['brand'];?></td>
                <td id="centro"><?php echo $row['model'];?></td>
                <td id="centro"><?php echo $row['serialnumber'];?></td>
                <td id="centro"><?php echo $row['purchase_date'];?></td>
                <td id="centro"><?php echo $row['guarantee_expired'];?></td>
                <td id="centro"><?php echo $row['out_date'];?></td>
                <td id="centro"><?php echo $row['in_date'];?></td>
                <td id="centro"><?php echo $row['price'];?></td>
                <td id="centro"><?php echo $row['_provider'];?></td>
                <td id="centro"><?php echo $row['person'];?></td>
                <td id="centro"><?php echo $row['department'];?></td>
                <td id="centro"><?php echo $row['building'];?></td>
                <td id="centro"><?php echo $row['_floor'];?></td>
                <td id="centro"><?php echo $row['location_description'];?></td>
                <td id="centro"><?php 
                if($row['available']==1){
                    echo "O";
                }
                else{
                    echo "X";
                }
                ?></td>    
                 
            </tr> 
            <?php
            }
            ?>
            </table>
    </body>
</html>
