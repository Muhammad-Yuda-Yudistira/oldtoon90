<?php 
require __DIR__ . "/../user/comment/commentsController.php";
require __DIR__ . "/../film/filmController.php";
require __DIR__ . "/../../models/user/usersModel.php";
require __DIR__ . "/../../models/user/comment/replyModel.php";

// if(isset($_SESSION['username']))
// {
//     $username = $_SESSION['username'];
//     $user = query("SELECT id, picture FROM user WHERE username='$username'");
//     $userId = $user[0]['id'];
//     $picture = $user[0]['picture'];
// }

$title = $_GET['title'];
$eps = $_GET['eps'];
// $currentComment = $_GET['currentComment'];

$result = getCommentsPagination();
$idFilm = films($title);
$users = getUsers();
$replyComment = getReply();

$currentComment = $result['currentComment'];
$totalPages = $result['totalPages'];
$comments = $result['comments'];
?>

<div class="container-comments">
<?php foreach($comments as $comment): ?>
    <?php if($idFilm == $comment['title_id'] && $eps == $comment['episode']): ?>
        <div class="comment-result">
            <div class="comment-title">
                <?php foreach($users as $user): ?>
                    <?php if($user['id'] == $comment['user_id']): ?>
                        <div class="profile">
                            <img src="<?= $baseurl . $user['picture'] ?>">
                        </div>
                        <h5 style="color:#47A992;"><?= $user['username'] ?></h5>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <div class="container-comment-reply">
                <ul class="kolom-comment" data-comment-id="<?= $comment['id'] ?>">
                    <li>
                        <label for="message" style="color:#47A992;">Message : </label>
                        <textarea name="message" id="message" cols="30" rows="10" readonly><?= $comment['comment'] ?></textarea>
                    </li>
                    <div class="bar-bawah-comment">
                        <li>
                            <p style="color:#47A992;"><?= $comment['created_at'] ?></p>
                        </li>
                        <?php if(isset($username)): ?>
                            <button type="button" class="btn-reply" name="reply" data-comment-id="<?= $comment['id'] ?>">balas</button>
                        <?php endif; ?>
                    </div>
                </ul>

                <?php $sumReply = 0; ?>
                <?php foreach($replyComment as $reply): ?>
                    <?php if($reply['user_comment_id'] == $comment['id']): ?>
                        <?php $sumReply++ ?>
                    <?php endif; ?>
                <?php endforeach; ?>

                <?php foreach($replyComment as $reply): ?>
                    <?php if($reply['user_comment_id'] == $comment['id']): ?>
                        <h5 class="lipatan" data-comment-id="<?= $comment['id'] ?>">Lihat balasan<span> (<?= $sumReply ?>)</span> <span>&#x2934;</span></h5>
                        <?php break; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
                <div class="comment-box hidden" data-comment-id="<?= $comment['id'] ?>">
                    <?php foreach($replyComment as $reply): ?>
                        <?php if($reply['user_comment_id'] == $comment['id']): ?>
                            <div class="comment comment-reply" style="display: flex;">
                                <div class="comment-title">
                                    <?php foreach($users as $user): ?>
                                        <?php if($user['id'] == $reply['user_id']): ?>
                                            <div class="profile">
                                                <img src="<?= $baseurl . $user['picture'] ?>">
                                            </div>
                                            <h5 style="color:#47A992;"><?= $user['username'] ?></h5>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                                <form action="../controllers/user/comment/reply.php" method="post" class="form-reply">
                                    <ul class="kolom-comment">
                                        <li>
                                            <input type="hidden" name="from" value="<?= $userId ?>">
                                        </li>
                                        <li>
                                            <input type="hidden" name="to" value="<?= $comment['id'] ?>">
                                        </li>
                                        <li>
                                            <label for="message">Message : </label>
                                            <textarea name="message" id="message" cols="30" rows="10" readonly><?= $reply['message'] ?></textarea>
                                        </li>
                                        <div class="bar-bawah-comment">
                                            <li>
                                                <p style="color:#47A992;"><?= $comment['created_at'] ?></p>
                                            </li>
                                        </div>
                                    </ul>
                                </form>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <div class="comment comment-reply munculkan" data-comment-id="<?= $comment['id'] ?>">
                    <div class="comment-title">
                        <div class="profile">
                            <img src="<?= isset($picture) ? $baseurl . $picture : $baseurl . "images/users/blank-profile.webp" ?>">
                        </div>
                        <h5 style="color:#47A992;"><?= isset($username) ? $username : "Anonymous" ?></h5>
                    </div>
                    <form action="../controllers/user/comment/reply.php" method="post" class="form-reply">
                        <ul class="kolom-comment">
                            <li>
                                <input type="hidden" name="from" value="<?= $userId ?>">
                            </li>
                            <li>
                                <input type="hidden" name="to" value="<?= $comment['id'] ?>">
                            </li>
                            <li>
                                <label for="message">Message : </label>
                                <textarea name="message" id="message" cols="30" rows="10" required></textarea>
                            </li>
                            <input type="submit" value="kirim" name="balas" class="btn">
                            <input type="button" value="batal" class="btn btn-batal" data-comment-id="<?= $comment['id'] ?>">
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endforeach; ?>
</div>

<div class="comment-paginate">
    <?php if($currentComment > 1): ?>
        <a href="<?= $baseurl . 'controllers/ajax/comment-paginate.php?title=' . $title . '&eps=' . $eps . '&currentComment=' . ($currentComment - 1) ?>" class="pagination">&laquo;</a>
    <?php endif; ?>
    <?php for($i = 1; $i <= $totalPages; $i++): ?>
        <a href="<?= $baseurl . 'controllers/ajax/comment-paginate.php?title=' . $title . '&eps=' . $eps . '&currentComment=' . $i ?>" class="pagination <?= $currentComment == $i ? 'active' : ''; ?>"><?= $i ?></a>
    <?php endfor; ?>
    <?php if($currentComment < $totalPages): ?>
        <a href="<?= $baseurl . 'controllers/ajax/comment-paginate.php?title=' . $title . '&eps=' . $eps . '&currentComment=' . ($currentComment + 1) ?>" class="pagination">&raquo;</a>
    <?php endif; ?>
</div>
