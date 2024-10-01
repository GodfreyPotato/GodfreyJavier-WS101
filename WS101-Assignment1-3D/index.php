<?php session_start(); 
    $nameError = $emailError = $passwordError = $cpassError = $genderError = $countryError = $skillError = $bioError = $fbError = $phoneError = "";
    $validName = $validEmail = $validBio = $validFB = $validPhone = "";
    $isValid = true;

    function cleanData($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if(isset($_POST['submit'])){
        //name
        $namePattern = "/^[A-Za-z\s]+$/";
        if(preg_match($namePattern, cleanData($_POST['name']))&&!empty($_POST['name'])){
            $_SESSION['name'] = $_POST['name'];
            $validName = $_SESSION['name'];
        }else{
            $isValid = false;
            $nameError = "Invalid Name!";
        }
        //email
        if(filter_var(cleanData($_POST['email']), FILTER_VALIDATE_EMAIL)&&!empty($_POST['email'])){
            $_SESSION['email'] = $_POST['email'];
            $validEmail = $_SESSION['email'];
        }else{
            $isValid = false;
            $emailError = "Invalid Email!";
        }

        //password
        $passwordPattern = "/^(?=.*[A-Z])[A-Za-z0-9]+$/";
        if(strlen($_POST['password'])>=8&&!empty(cleanData($_POST['password']))){
            if(preg_match( $passwordPattern,cleanData($_POST['password']))){
                $_SESSION['password'] = $_POST['password'];
                
            }else{
                $isValid = false;
                $passwordError = "Password must have atleast 1 capital letter";
            }
        }else{
            $isValid = false;
            $passwordError = "Password must be atleast 8 characters!";
        }

        //cpassword
        if(cleanData($_POST['password'])===cleanData($_POST['c-password'])&&!empty(cleanData($_POST['password']))){
            $_SESSION['cpassword'] = $_POST['c-password'];
        }else{
            $isValid = false;
            $cpassError = "Check your password!";
        }

        //gender
        if(isset($_POST['gender'])){
            $_SESSION['gender'] = $_POST['gender'];
        }else{
            $isValid = false;
            $genderError = "Select a gender!";
        }

        //country
        if(!empty($_POST['country'])){
            $_SESSION['country'] = $_POST['country'];
        }else{
            $isValid = false;
            $countryError = "Select a Country!";
        }

        //skill
        if(isset($_POST['skill'])){
            $_SESSION['skill'] = $_POST['skill'];
            
        }else{
            $isValid = false;
            $skillError = "Select at least 1 skill!";
        }

        //biography
        if(!empty(cleanData($_POST['biography']))&&strlen(cleanData($_POST['biography']))<=200){
            $_SESSION['biography'] = $_POST['biography'];
            $validBio = $_SESSION['biography'];
        }else{
            $isValid = false;
            $bioError = "Must have 1 - 200 characters only!";
        }

        //fb
        $fbURLPattern = "/^(https?:\/\/)?(www\.)?facebook\.com\/[A-Za-z0-9\.]+$/";
        if(!empty($_POST['fb'])&&preg_match($fbURLPattern,$_POST['fb'])){
            $_SESSION['fb'] = $_POST['fb'];
            $validFB = $_SESSION['fb'];
        }else{
            $isValid = false;
            $fbError = "Invalid FB URL!";
        }

        //phone number
        if(is_numeric(cleanData($_POST['pnum']))&&!empty($_POST['pnum'])){
            $_SESSION['pnum'] = $_POST['pnum'];
            $validPhone = $_SESSION['pnum'];
        }else{
            $isValid = false;
            $phoneError = "Must be all numeric!";
        }

        if($isValid){
            header('location:about.php');
        }
    }
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebSys Assignment</title>
    <style>
        
body{
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
    background-color:bisque;
}
.form-container{
    display: flex;
    width: 40vw;
    height: auto;
    padding: 1vw;
    flex-direction: column;
}
/* text area */
#biography{
    width: 40vw;
    height: 20vh;
    resize: none;
    padding: 1vw;
}
.error{
    color: red;
}
input[type="text"], input[type="number"],input[type='password']{
    width: 20vw;
}
input[type="submit"] {
    color: white;
    font-weight: bold;
    border: none;
    padding: 1vw;
    background-color: rgb(163, 195, 241);
}
input[type="submit"]:hover{
    background-color: rgb(74, 142, 236);
}

fieldset{
    box-shadow: 1px 0px 10px rgb(68, 68, 68);
    border: none;
    background-color: whitesmoke;
}
legend{
    border-radius: 5px;
    color: white;
    padding: 1vw;
    background-color: rgb(74, 142, 236);
}
</style>
</head>
<body>
    
    <fieldset class="form-container">
        <legend><b>Enter Information</b></legend>

        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">

        <div class="form-fill">
            <label for="name"><b>Name:     </b> </label><span class="error"><?= $nameError?></span><br>
            <input type="text" name="name" id="name" value="<?=$validName?>"><hr>
        </div>

        <div class="form-fill">
            <label for="email"><b>Email:     </b></label><span class="error"><?= $emailError?></span><br>
            <input type="text" name="email" id="email" value="<?=$validEmail?>"><hr>   
        </div>

        <div class="form-fill">
            <label for="password"><b>Password:     </b></label><span class="error"><?= $passwordError?></span><br>
            <input type="password" name="password" id="password" ><hr> 
        </div>

        <div class="form-fill">
            <label for="c-password"><b>Confirm Password:     </b></label><span class="error"><?= $cpassError?><br>
            <input type="password" name="c-password" id="c-password"><hr>
        </div>

        <div class="form-fill">
            <label for=""><b>Gender:</b></label>
            <input type="radio" name="gender" id="male" value="male">
            <label for="male">Male</label>
            <input type="radio" name="gender" id="female" value="female">
            <label for="female">Female     </label><span class="error"><?= $genderError?></span>
            <hr>
        </div>

        <div class="form-fill">
            <label for="country"><b>Country:</b></label>
            <select name="country" id="country">
                <option value="">--</option>
                <option value="Philippines">Philippines</option>
                <option value="China">China</option>
                <option value="Singapore">Singapore</option>
            </select><span class="error">     <?= $countryError?></span><hr>
        </div>

        <div class="form-fill">
            <label for="skill"><b>Skills:</b></label>

            <label>
                <input type="checkbox" name="skill[]" value="Coding">Coding
            </label>

            <label>
                <input type="checkbox" name="skill[]" value="Designing">Designing
            </label>

            <label>
                <input type="checkbox" name="skill[]" value="Networking">Networking
            </label>

            <label>
                <input type="checkbox" name="skill[]" value="Bootstrap">Bootstrap
            </label>
            <span class="error">     <?= $skillError?></span>
            <hr>
        </div>

        <div class="form-fill">
            <label for="biography"><b>Biography</b></label><span class="error">     <?=$bioError?><br>
            <textarea name="biography" id="biography" placeholder="Enter your biography"><?=$validBio?></textarea><hr>
        </div>

        <div class="form-fill">
            <label for="fb"><b>Facebook URL:</b></label> <span class="error">     <?=$fbError?><br>
            <input type="text" name="fb" id="fb" value="<?=$validFB?>"><hr>   
        </div>
        
        <div class="form-fill">
            <label for="pnum"><b>Phone:</b></label><span class="error">     <?=$phoneError?><br>
            <input type="number" name="pnum" id="pnum" value="<?=$validPhone?>"><hr>   
        </div>

        <div class="form-fill">
            <input type="submit" name="submit" id="submit" value="Submit Form">
        </div>
    </form>   

    </fieldset>

 
</body>
</html>