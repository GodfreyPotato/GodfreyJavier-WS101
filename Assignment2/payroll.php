<?php 
session_start();
$empNoValue = $empNameValue = $empHourValue = $empPositionValue = "";
$empNoValid = $empNameValid = $empHourValid = $empPositionValid = "";
$empNoWord = $empNameWord = $empHourWord = $empPositionWord = $empDeductWord = "";
$empDeductValue = [];
function sanitizeData($input){
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

if(isset($_POST['sub'])){
    $isValid = true;
    //employee no
    if(isset($_POST['employeeNo'])&&!empty($_POST['employeeNo'])){
        $_SESSION['empNo'] = sanitizeData($_POST['employeeNo']);
        $empNoValue = $_SESSION['empNo'];
        $empNoValid = "is-valid";
        $empNoWord = "";
    }else{
        $empNoValid = "is-invalid";
        $empNoWord = "Invalid employee number!";
        $isValid = false;
    }

    //employee name
    if(!empty($_POST['employeeName']) && strlen($_POST['employeeName'] ) <= 100){
        $_SESSION['empName'] = sanitizeData($_POST['employeeName']);
        $empNameValue = $_SESSION['empName'];
        $empNameValid = "is-valid";
        $empNameWord = "";
    }else{
        $empNameValid = "is-invalid";
        $empNameWord = "Invalid employee name";
        $isValid = false;
    }

    //employee position
    if(isset($_POST['employeePosition'])&&!empty($_POST['employeePosition'])){
        $_SESSION['empPosition'] = sanitizeData($_POST['employeePosition']);
        $empPositionValue = $_SESSION['empPosition'];
        $empPositionValid = "is-valid";
        $empPositionWord = "";
    }else{
        $empPositionValid = "is-invalid";
        $empPositionWord = "Select position!";      
        $isValid = false; 
    }

    //employee hour
    if(isset($_POST['employeeHour'])&&is_numeric($_POST['employeeHour'])){
        $_SESSION['empHour'] = sanitizeData($_POST['employeeHour']);
        $empHourValue = $_SESSION['empHour'];
        $empHourValid = "is-valid";
        $empHourWord = "";
    }else{
        $empHourValid = "is-invalid";
        $empHourWord = "Should be numeric!";   
        $isValid = false;    
    }

    //employee deduct
    if(!empty($_POST['deduct'])){
        $_SESSION['empDeduct'] = $_POST['deduct'];
        $empDeductValue = $_SESSION['empDeduct'];
        $empDeductWord = "";
    }else{
        $empDeductWord = "Select atleast 1";
        $isValid = false;
    }


    //go to the payslip
    if($isValid){
        echo "<script>location.href='payslip.php'</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="d-flex justify-content-center align-items-center" style="height: 100vh">

<div class="container-fluid bg-primary w-75 text-white rounded">
    <h2 class="text-center py-3">Payroll Web Application</h2>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">

        <div class="container-fluid d-flex mb-4">
            <div class="container-fluid">
                <label for="" class="form-label fs-5 ">Employee Number</label>
                <input type="text" name="employeeNo"  class="form-control <?=$empNoValid?>" value="<?=$empNoValue?>" placeholder="<?=$empNoWord?>">
            </div>
            <div class="container-fluid">
                <label for="" class="form-label fs-5">Name</label>
                <input type="text" name="employeeName" class="form-control <?=$empNameValid?>" value="<?=$empNameValue?>" placeholder="<?=$empNameWord?>">
            </div>
        </div>

        <div class="container-fluid d-flex mb-4">

            <div class="container-fluid w-75">
            <label class="form-label fs-5">Position</label><span class="fs-6 fw-light text-warning">     <?=$empPositionWord?></span>
            <select name="employeePosition"  class="form-select <?=$empPositionValid?>">
                <option value="<?=$empPositionValue?>"><?=empty($empPositionValue) ? "Select Position" : $empPositionValue?></option>
                <option value="Instructor I">Instructor I</option>
                <option value="Instructor II">Instructor II</option>
                <option value="Instructor III">Instructor III</option>
                <option value="Associate Professor I">Associate Professor I</option>
                <option value="Associate Professor II">Associate Professor II</option>
                <option value="Associate Professor III">Associate Professor III</option>
            </select>
            </div>

            <div class="container-fluid w-50">
                <label for="" class="form-label fs-5">Hours Rendered</label>
                <input type="text" class="form-control <?=$empHourValid?>" value="<?=$empHourValue?>" name="employeeHour" placeholder="<?=$empHourWord?>">
            </div>
        </div>

        <div class="container-fluid mb-4">
            <div class="container d-flex  align-items-center">
                
                <div class="fs-5 me-5">Deductions</div>
                
                <div class="container form-check form-check-inline">
                <input type="checkbox" name="deduct[]" class="form-check-input" id="pagibig" value="Pagibig" <?=in_array("Pagibig",$empDeductValue) ? "checked" : ''?>>
                <label for="pagibig" class="form-check-label">Pagibig</label>
                </div>

                <div class="container form-check form-check-inline">
                <input type="checkbox" name="deduct[]" class="form-check-input" id="GSIS" value="GSIS" <?=in_array("GSIS", $empDeductValue) ? "checked" : ''?>>
                <label for="GSIS" class="form-check-label">GSIS</label>
                </div>

                <div class="container form-check form-check-inline">
                <input type="checkbox" name="deduct[]" class="form-check-input" id="Ph" value="PhilHealth" <?=in_array('PhilHealth',$empDeductValue) ? "checked" : ""?>>
                <label for="Ph" class="form-check-label">PhilHealth</label>
                </div>

            </div>

            <div class="fs-6 fw-light text-warning">
                <span>&nbsp;&nbsp;&nbsp;<?=$empDeductWord?></span>
            </div>

        </div>

        <div class="container-fluid mb-4 d-flex justify-content-center align-items-center">
            <input type="submit" name="sub" class="btn btn-success w-75" value="Compute Payroll">
        </div>

    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
