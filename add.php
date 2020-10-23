<!DOCTYPE html>

<html lang="en">

<?php 
include('Templates/db_connect.php');
include ("Templates/header.php"); ?>
<?php

    $title = $comments = '';
    $errors =array('article_title'=>'', 'article_text'=>'');

    if(isset($_POST['submit']))
    {
        if(empty($_POST['article_title']))
        {
            $errors['article_title'] = 'Please add a valid title.';
        } else
        {
            $title = $_POST['article_title'];
            if(!preg_match('/^[A-Z][a-zA-Z\s]+$/', $title))
            {
                $errors['article_title'] = 'The title must start with a capital letter and be letters and spaces only.';
            }
        }
        if(empty($_POST['article_text']))
        {
            $errors['article_text'] = 'Please write a comment';
        } else
        {
            $comments = $_POST['article_text'];
            if(!preg_match('/^[a-zA-Z0-9\s]+$/', $comments))
            {
                $errors['article_text'] = 'The title must be letters and spaces only.';
            }
        }
        if(array_filter($errors))
        {
            
        } else
        {
            $title = mysqli_real_escape_string($conn, $_POST['article_title']);
            $comments = mysqli_real_escape_string($conn, $_POST['article_text']);

            $sql = "INSERT INTO articles(article_title, article_text) VALUES('$title', '$comments')";

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
    <h4 class="center">Add Comment</h4>
    <form action="add.php" class="white" method="POST">
        <label>Title:</label>
        <input type="text" name="article_title" value="<?php echo htmlspecialchars($title) ?>">
        <div class="red-text"><?php echo $errors['article_title']; ?></div>
        <label>Article:</label>
        <input type="text" name="article_text" value="<?php echo htmlspecialchars($comments) ?>">
        <div class="red-text"><?php echo $errors['article_text']; ?></div>
        <div class="center">
            <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
        </div>
    </form>
</section>

<?php include ("Templates/footer.php"); ?>
  
</html>
