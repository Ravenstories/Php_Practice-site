<?php

    include('Templates/db_connect.php');

    $sql = 'SELECT article_id, article_title, article_text, user_name, month_name FROM articles, month, user';
    $result = mysqli_query($conn, $sql);
    $articles = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);

?>


<!DOCTYPE html>

<html lang="en">

<?php include ("Templates/header.php"); ?>

<div class="container">
    <div class="row">
        <?php foreach($articles as $article){ ?>
            <div class="col s6 md3">
                <div class="card z-depth-0">
                    <div class="card-content center">
                        <h6><?php echo htmlspecialchars($article['user_name']); ?></h6>
                        <div><?php echo htmlspecialchars($article['article_title']); ?></div>
                        <div><?php echo htmlspecialchars($article['article_text']); ?></div>
                    </div>
                </div>
            </div>
        <?php } ?>    
    </div>
</div>

<?php include ("Templates/footer.php"); ?>
  
</html>
