<?php 
session_start();

$payRate;
if($_SESSION['empPosition']=='Instructor I'){
    $payRate = 890.75;
}elseif($_SESSION['empPosition']=='Instructor II'){
    $payRate = 940.50;
}
elseif($_SESSION['empPosition']=='Instructor III'){
    $payRate = 1200.75;
}elseif($_SESSION['empPosition']=='Associate Professor I'){
    $payRate = 1700.25;
}elseif($_SESSION['empPosition']=='Associate Professor II'){
    $payRate = 5000.75;
}elseif($_SESSION['empPosition']=='Associate Professor III'){
    $payRate = 7500.50;
}


$grossPay = $_SESSION['empHour'] * $payRate;
$deductions=0;
foreach($_SESSION['empDeduct'] as $deduct){
    if($deduct=='GSIS'){
        $deductions += 550;
    }elseif($deduct=='PhilHealth'){
        $deductions += 150;
    }elseif($deduct=='Pagibig'){
        $deductions += 256;
    }
    
}

$withHoldingTax;
if($grossPay<10000){
    $withHoldingTax = $grossPay * .05;
}elseif($grossPay >= 10000 && $grossPay < 30000 ){
    $withHoldingTax = (($grossPay - 10000) * .1) + 500;
}elseif($grossPay >=30000 && $grossPay < 70000){
    $withHoldingTax = (($grossPay - 30000) * .15) + 2500;
}elseif($grossPay >=70000 && $grossPay < 140000){
    $withHoldingTax = (($grossPay - 70000) * .2) + 8500;
}elseif($grossPay >= 140000 && $grossPay < 250000){
    $withHoldingTax = (($grossPay - 140000) * .25) + 22500;
}elseif($grossPay >= 250000 && $grossPay < 500000){
    $withHoldingTax = (($grossPay - 250000) * .3) + 50000;
}else{
    $withHoldingTax = (($grossPay - 500000) * .34) + 125000;
}


$netPay = $grossPay - $deductions - $withHoldingTax;


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payslip</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="d-flex flex-column justify-content-center align-items-center text-dark" style="height: 100vh">
    <div class="border border-success w-50">
    <!-- first container -->
    <div class="container  bg-success fs-4 d-flex align-items-center text-white" style="height: 10vh">
        Transaction Complete!
    </div>
    <!-- second container -->
    
        <table class="table p-4">
            <tr >
                <th >Employee #</th>
                <td colspan="3"><?=$_SESSION['empNo']?></td>
            </tr>
            <tr class="table-light">
                <th>Name</th>
                <td><?=$_SESSION['empName']?></td>
                <th>Position</th>
                <td><?=$_SESSION['empPosition']?></td>
            </tr>

            <tr >
                <th>Gross Pay</th>
                <td colspan="3"><?=$grossPay?></td>
            </tr>
            <tr class="table-light"> 
                <th>Deductions</th>
                <td colspan="3"><?=$deductions?></td>
            </tr>
            <tr >
                <th>Withholding Tax</th>
                <td colspan="3"><?=$withHoldingTax?></td>
            </tr>
            <tr class="table-light">
                <th>Net Pay</th>
                <td colspan="3"><?=$netPay?></td>
            </tr>
        </table>
        </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>