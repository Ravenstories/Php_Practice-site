<?php
    include ("Templates/header.php");
    include('Templates/db_connect.php');
?>

<?php

    $first = $last = $email = $uid = $pwd = '';
    $errors =array('useruid'=>'', 'mailuid'=>'', 'firstuid'=>'', 'lastuid'=>'', 'pwd'=>'', 'pwd-repeat'=>'');

    if(isset($_POST['submit']))
    {
        if(empty($_POST['useruid']))
        {
            $errors['useruid'] = 'Please enter a username.';
        } else
        {
            $uid = $_POST['useruid'];
            if(!preg_match('/^[A-Z][a-zA-Z\d\s]+$/', $uid))
            {
                $errors['useruid'] = 'The username must start with a capital letter and be letters and spaces only.';
            }
        }
        if(empty($_POST['mailuid']))
        {
            $errors['mailuid'] = 'Please add a valid email.';
        } else
        {
            $email = $_POST['mailuid'];
            if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $errors['mailuid'] = 'The email must be valid, please check again.';
            }
        }
        if(empty($_POST['firstuid']))
        {
            $errors['firstuid'] = 'Please add a valid first name.';
        } else
        {
            $first = $_POST['firstuid'];
            if(!preg_match('/^[A-Z][a-zA-Z\s]+$/', $first))
            {
                $errors['firstuid'] = 'The name must start with a capital letter and be letters and spaces only.';
            }
        }
        if(empty($_POST['lastuid']))
        {
            $errors['lastuid'] = 'Please write a valid last name';
        } else
        {
            $last = $_POST['lastuid'];
            if(!preg_match('/^[a-zA-Z\s]+$/', $last))
            {
                $errors['lastuid'] = 'The name must be letters and spaces only.';
            }
        }
        if(empty($_POST['pwd']))
        {
            $errors['pwd'] = 'Please enter a valid password.';
        } else
        {
            $pwd = $_POST['pwd'];
            if(!preg_match('/^[a-zA-Z0-9\s]+$/', $pwd))
            {
                $errors['pwd'] = 'The password is not valid.';
            }
        }
        if(empty($_POST['pwd-repeat']))
        {
            $errors['pwd-repeat'] = 'The passwords enter the password again.';
        } else
        {
            $pwd = $_POST['pwd-repeat'];
            if(!preg_match('/^[a-zA-Z0-9\s]+$/', $pwd))
            {
                $errors['pwd-repeat'] = 'The passwords do not match.';
            }
        }

        if(array_filter($errors))
        {
            
        } else
        {
            $first = mysqli_real_escape_string($conn, $_POST['firstuid']); 
            $last = mysqli_real_escape_string($conn, $_POST['lastuid']);
            $email = mysqli_real_escape_string($conn, $_POST['mailuid']);
            $uid = mysqli_real_escape_string($conn, $_POST['useruid']);
            $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

            $sql = "INSERT INTO user (user_name, firstname, lastname, email, password) VALUES('$uid', '$first','$last', '$email', '$pwd')";

            if(mysqli_query($conn, $sql))
            {
                header('Location: index.php');
            } else
            {
                echo 'query error: '. mysqli_error($conn);
            }
        }
    }    
?>
<section class="container grey-text">
    <h4 class="center">Signup Form</h4>
    <form action="signup.php" class="white" method="POST">
        <label>Username:</label>
        <input type="text" name="useruid" placeholder="Username...">
        <div class="red-text"><?php echo $errors['useruid']; ?></div>
        <label>E-mail:</label>
        <input type="text" name="mailuid" placeholder="E-mail...">
        <div class="red-text"><?php echo $errors['mailuid']; ?></div>
        <label>Firstname:</label>
        <input type="text" name="firstuid" placeholder="Firstname...">
        <div class="red-text"><?php echo $errors['firstuid']; ?></div>
        <label>Lastname:</label>
        <input type="text" name="lastuid" placeholder="Lastname...">
        <div class="red-text"><?php echo $errors['lastuid']; ?></div>
        <label>Password:</label>
        <input type="password" name="pwd" placeholder="Password...">
        <div class="red-text"><?php echo $errors['pwd']; ?></div>
        <input type="password" name="pwd-repeat" placeholder="Repeat password...">
        <div class="red-text"><?php echo $errors['pwd-repeat']; ?></div>
        <div class="center">
            <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
        </div>
    </form>
</section>

<?php include ("Templates/footer.php"); ?>