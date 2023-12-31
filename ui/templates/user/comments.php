<?php
require_once "../models/comments_model.php";

if(isset($_SESSION['email']))
{
    $userEmail = $_SESSION['email'];
    $picture = query("SELECT picture FROM user WHERE email='$userEmail'");
    $picture = $picture[0]['picture'];
}

if(isset($_POST['send']))
{
    $dataComment['user'] = $userEmail;
    $dataComment['message'] = $_POST['message'];
    $dataComment['title'] = $_GET['title'];
    $dataComment['eps'] = $_GET['eps'];
    
    addComment($dataComment);
}

$result = getComment();

$idFilm = query("SELECT id FROM film WHERE title='$title'");
$idFilm = $idFilm[0]['id'];
?>

<?php if(isset($userEmail)): ?>

    <div class="comment">
        <div class="comment-title">
            <div class="profile">
                <img src="<?= isset($picture) ? $baseurl . $picture : $baseurl . "images/users/blank-profile.webp" ?>">
            </div>
            <h5 style="color:#47A992;"><?= isset($userEmail) ? $userEmail : "Anonymous" ?></h5>
        </div>
        <form action="" method="post">
            <ul class="kolom-comment">
                <li>
                    <label for="message">Message : </label>
                    <textarea name="message" id="message" cols="30" rows="10" required></textarea>
                </li>
                <input type="submit" value="Send" name="send" class="btn">
            </ul>
        </form>
    </div>
<?php else: ?>
    <div class="comment" style="background-color: salmon; width: 100%;">
        <h2 style="color: #333; margin: auto;">Please login for comment</h2>
    </div>
<?php endif; ?>

<?php if($result !== "data tidak ada"): ?>
    <?php foreach($result as $comment): ?>
        <?php if($idFilm == $comment['title_id'] && $eps == $comment['episode']): ?>
            <div class="comment-result">
                <div class="comment-title">
                    <div class="profile">
                        <img src="<?= $baseurl . $comment['picture'] ?>">
                    </div>
                    <h5 style="color:#47A992;"><?= $comment['email'] ?></h5>
                </div>
                <ul class="kolom-comment">
                    <li>
                        <label for="message" style="color:#47A992;">Message : </label>
                        <textarea name="message" id="message" cols="30" rows="10" readonly style="color:#333;font-size:1rem;padding:3px 6px;"><?= $comment['comment'] ?></textarea>
                    </li>
                    <li>
                        <p style="color:#47A992;"><?= $comment['created_at'] ?></p>
                    </li>
                </ul>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>