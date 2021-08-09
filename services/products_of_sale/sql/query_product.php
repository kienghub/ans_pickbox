<?php
include '../../../connection.php';
$output = array();
$query  =mysqli_query($con,"SELECT*FROM
	ans_production_of_sale
	LEFT JOIN office_branches
	ON ans_production_of_sale.branch_id = office_branches.id_branch
	LEFT JOIN ans_category_of_sale ON ans_production_of_sale.pro_size = ans_category_of_sale.cate_id ORDER BY pro_createdAt DESC");
if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_array($query)) {
        $output[] = $row;
    }
    echo json_encode($output);
}
mysqli_close($con);
?>