<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
    <title>Student Info</title>
</head>
<body>
    <?php require_once 'process.php'; ?>

    <?php

        if (isset($_SESSION['message'])): ?>

    <div class="alert alert-<?=$_SESSION['msg_type']?>">

            <?php 
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            ?> 
    </div>
    <?php endif ?>

    <div class="container">
    <?php 
    
        $mysqli = new mysqli('localhost', 'root', '', 'stud_inf') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
        //pre_r($result);
        ?>

        <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Student Number</th>
                        <th>Email Address</th>
                        <th colspan="3">Action</th>
                    </tr>
                </thead>
            <?php 
            
                while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['studno']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td>
                        <a href="index.php?edit=<?php echo $row['id']; ?>"
                            class="btn btn-info">Edit</a>
                        <a href="process.php?delete=<?php echo $row['id'] ?>"
                            class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </table>
        </div>
        <?php
        function pre_r( $array ) {
            echo '<pre>';
            print_r($array);
            echo '<pre>';
        }
    
    
        ?>
        <div class="row justify-content-center">
        <form action="process.php" method="POST">
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" 
            value="<?php echo $name; ?>" placeholder="Full Name">
        </div>
        <div class="form-group">
            <label>Student Number</label>
            <input type="text" name="studno" class="form-control" 
            value="<?php echo $studno; ?>" placeholder="Student Number">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" class="form-control" 
            value="<?php echo $email; ?>" placeholder="Email Address">
        </div>
        <div class="form-group">
        <!-- <button class="btn btn-info" type="submit" name="update">Update</button> -->
            <button class="btn btn-primary" type="submit" name="save">Save</button>
        </div>
        </form>
    </div>
    </div>
</body>
</html>