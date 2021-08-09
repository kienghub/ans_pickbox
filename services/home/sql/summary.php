<?php 
     include('../../../connection.php');
     $callSummaryForReceive=$_sql($con,"SELECT sum(rec_qty) AS recTotal FROM ans_receive WHERE  branch_id='$_state_branch'");
     $receive=$_assoc($callSummaryForReceive);
     echo $receive['recTotal'];
     echo ",";
     $callSummaryForPaylist=$_sql($con,"SELECT sum(pay_qty) AS payTotal FROM ans_paylist WHERE  branch_id='$_state_branch'");
     $res=$_assoc($callSummaryForPaylist);
     echo $res['payTotal'];
     echo ",";
     echo ($receive['recTotal']-$res['payTotal']);
     echo ",";
     $callSummaryBranch=$_sql($con,"SELECT count(*) AS branchTotal FROM office_branches");
     $rows=$_assoc($callSummaryBranch);
     echo $rows['branchTotal'];
     mysqli_close($con);
?>