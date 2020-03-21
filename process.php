<?php 

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'stud_inf') or die(mysqli_error($mysqli));

$name = '';
$studno = '';
$email = ''; 

if(isset($_POST['save'])){
    $name = $_POST['name'];
    $studno = $_POST['studno'];
    $email = $_POST['email'];

    $mysqli->query("INSERT INTO data (name, studno, email) VALUES('$name', '$studno', '$email')") or 
        die($mysqli->error);

        $_SESSION['message'] = "RECORD has Been Saved";
        $_SESSION['msg_type'] = "Success";

        header("location: index.php");
}

if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());

    $_SESSION['message'] = "RECORD has Been Deleted";
    $_SESSION['msg_type'] = "Danger";

    header("location: index.php");
}

if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());
    if (count($result)==1){
        $row = $result->fetch_array();
        $name = $row['name'];
        $studno = $row['studno'];
        $email = $row['email'];
    }
} 