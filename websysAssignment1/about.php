<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <style>
body {
    font-family: Arial, sans-serif;
    background-color: bisque;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}
.container {
    background-color: whitesmoke;
    padding: 20px 40px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 50%;
}
.header {
    text-align: center;
    margin-bottom: 20px;
}
.header h1 {
    color: #333;
}
.info {
    margin-bottom: 15px;
}
.info label {
    font-weight: bold;
    color: #555;
}
.info span {
    display: block;
    color: #333;
}
.skills span {
    display: inline-block;
    background-color: rgb(212, 242, 255);
    padding: 5px 10px;
    border-radius: 5px;
    margin-right: 5px;
    margin-top: 5px;
}
.logout {
    text-align: center;
    margin-top: 20px;
}
input[type="submit"] {
    background-color: #ff4c4c;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
}
input[type="submit"]:hover {
    background-color: #ff0000;
}
.biography{
    height: auto;
    word-wrap: break-word;
}
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>User Information</h1>
        </div>
        <div class="info">
            <label>Name:</label>
            <span><?=$_SESSION['name']?></span>
        </div>
        <div class="info">
            <label>Email:</label>
            <span><?= $_SESSION['email']?></span>
        </div>
        <div class="info">
            <label>Gender:</label>
            <span><?=$_SESSION['gender'] ?></span>
        </div>
        <div class="info">
            <label>Country:</label>
            <span><?= $_SESSION['country']?></span>
        </div>
        <div class="info skills">
            <label>Skills:</label>
            <?php 
                foreach($_SESSION['skill'] as $skill){
                    echo "<span>$skill</span>";
                }
            ?>
        </div>
        <div class="info">
            <label>Biography:</label>
            <div class="biography">
              <?=$_SESSION['biography'] ?>
            </div>
        </div>
        <div class="info">
            <label>Facebook URL:</label>
            <span><?= $_SESSION['fb']?></span>
        </div>
        <div class="info">
            <label>Phone Number:</label>
            <span><?= $_SESSION['pnum']?></span>
        </div>
        <div class="logout">
            <form action="logout.php" method="post">
                <input type="submit" name="logout" value="Log Out">
            </form>
        </div>
    </div>
</body>
</html>

