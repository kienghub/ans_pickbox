<?php
include '../../../connection.php';
$output = array();
$query  =mysqli_query($con,"SELECT
	sum(qty)as total,
	ans_branch_stocks.qty, 
	ans_production_of_sale.*
FROM 	ans_branch_stocks
LEFT JOIN ans_production_of_sale
ON ans_branch_stocks.pro_id = ans_production_of_sale.pro_id WHERE ans_branch_stocks.branch_id='$_state_branch' GROUP BY ans_branch_stocks.pro_id");
if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_array($query)) {
        $output[] = $row;
    }
    echo json_encode($output);
}
mysqli_close($con);
?>