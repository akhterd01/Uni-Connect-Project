<?php

require_once "libraries/Database.php";

class ProfilePost {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function retrievePostData() {
        $id = $_SESSION["id"];
        $this->db->prepare("SELECT * FROM profileposts WHERE post_user_id = $id ORDER BY profilepostsID DESC");
        $rows = $this->db->fetchAll();

        foreach($rows as $row) {
            $id = $row->profilepostsID;
            $this->db->prepare("SELECT * FROM profileposts_replies WHERE reply_parent_id = $id");
            $replyrows = $this->db->fetchAll();
            $likes = "";
            if ($row->post_likes == 0) {
                $likes = "Like";
            } else {
                $likes = $row->post_likes;
            }
            echo "<div class='profile-post'>
            <div class='post-header flex-container'>
                <div class='post-header-img'><a href=''><img src='images/profile_images/{$row->post_image}' alt=''></a></div>
                <div class='post-header-name'><h3><a href=''>John Doe</a></h3><h4>Shared on - {$row->post_commented_on}</h4></div>
            </div>
            <div class='post-content'>
                <h3>{$row->post_content}</h3>
            </div>
            <div class='like-container'>
                <a href='myprofile.php?action=like&postID={$row->profilepostsID}'><button><i class='far fa-thumbs-up'></i><span>{$likes}</span></button></a>
            </div>";

            foreach($replyrows as $replyrow) {
                $id = $replyrow->reply_id;
                $this->db->prepare("SELECT * FROM replies_responses WHERE parent_reply_id = $id");
                $responserows = $this->db->fetchAll();
    
                if(!empty($replyrow->reply_content)) {
                    echo "
                    <div class='comment-container'>
                    <div class='comment-inner-wrapper'>
                    <div class='comment-inner-container'>
                    <div class='comment-user-img'><a href=''><img src='images/profile_images/{$replyrow->reply_image}' alt=''></a></div>
                    <div class='comment-username'>
                        <h3><a href=''>{$replyrow->reply_username}</a></h3>
                        <h4>{$replyrow->reply_commented_on}</h4>
                    </div>
                    <div class='comment-message'>
                        <h3>{$replyrow->reply_content}</h3>
                        <div class='reply-container'>
                            <h4>+1</h4>
                            <h4><a href=''>Like</a></h4>
                            <h4><a href='#' onclick='return false;' class='reply-toggler'>Reply</a></h4>
                            <h4><a href=''>Report</a></h4> 
                        </div>
                    </div>
                    </div>
                    </div>

                    <div class='hidden-reply-form disabled-reply-form'>
                    <div class='reply-inner-container'>
                    <div class='reply-message'>
                    <form action='controllers/RepliesResponses.php' method='post' class='reply-form-hidden'>
                    <input type='hidden' name='type' value='reply-response'>
                    <input type='hidden' name='parent-username' value='{$replyrow->reply_username}'>
                    <input type='hidden' name='parent-id' value='{$replyrow->reply_user_id}'>
                    <input type='hidden' name='parent-reply-id' value='{$replyrow->reply_id}'>
                    <textarea name='response' class='hidden-text-area' placeholder='Reply to this comment...' required></textarea>
                    <button type='button' class='cancel-btn'>Cancel</button>
                    <input type='submit' value='Submit'>
                    </form>
                    </div>
                    </div>
                    </div>

                    </div>";
                }
            
                foreach($responserows as $responserow) {
                    $id = $responserow->response_id;
                    $this->db->prepare("SELECT * FROM replies_responses WHERE parent_reply_id = $id");
                    $responserowsfinal = $this->db->fetchAll();

                    echo "
                    <div class='reply-comment-container'>
                    <div class='reply-inner-container'>
                    <div class='comment-user-img'><a href=''><img src='images/profile_images/{$responserow->response_image}' alt=''></a></div>
                    <div class='comment-username'>
                    <h3><a href=''>{$responserow->response_username}</a></h3>
                    <h4>{$responserow->response_created_at}</h4>
                    </div>
                    <div class='comment-message'>
                    <h3>{$responserow->response_content}</h3>
                    <div class='reply-additional-container'>
                        <div class='reply-container'>
                            <h4>+1</h4>
                            <h4><a href=''>Like</a></h4>
                            <h4><a href='#' onclick='return false;' class='reply-toggler'>Reply</a></h4>
                            <h4><a href=''>Report</a></h4> 
                        </div>
                    </div>
                    </div>
                    </div>


                    <div class='hidden-reply-form disabled-reply-form'>
                        <div class='reply-inner-container'>
                        <div class='reply-message'>
                        <form action='controllers/RepliesResponses.php' method='post' class='reply-form-hidden'>
                        <input type='hidden' name='type' value='reply-response-final'>
                        <input type='hidden' name='parent-username' value='{$responserow->response_username}'>
                        <input type='hidden' name='parent-id' value='{$responserow->response_user_id}'>
                        <input type='hidden' name='parent-reply-id' value='{$responserow->response_id}'>
                        <textarea name='response' class='hidden-text-area' placeholder='Reply to this comment...'></textarea>
                        <button type='button' class='cancel-btn'>Cancel</button>
                        <input type='submit' value='Submit'>
                        </form>
                        </div>
                        </div>
                        </div>
                    </div>
                    ";
                    

                    foreach($responserowsfinal as $responserowfinal) {
                        echo "
                    <div class='reply-comment-container'>
                    <div class='reply-inner-container'>
                    <div class='comment-user-img'><a href=''><img src='images/profile_images/{$responserowfinal->response_image}' alt=''></a></div>
                    <div class='comment-username'>
                    <h3><a href=''>{$responserowfinal->response_username}</a></h3>
                    <h4>{$responserowfinal->response_created_at}</h4>
                    </div>
                    <div class='comment-message'>
                    <h3><a href='#'>@{$responserowfinal->response_parent_username}</a> {$responserowfinal->response_content}</h3>
                    <div class='reply-additional-container'>
                        <div class='reply-container'>
                            <h4>+1</h4>
                            <h4><a href=''>Like</a></h4>
                            <h4><a href='#' onclick='return false;' class='reply-toggler'>Reply</a></h4>
                            <h4><a href=''>Report</a></h4> 
                        </div>
                    </div>
                    </div>
                    </div>


                    <div class='hidden-reply-form disabled-reply-form'>
                        <div class='reply-inner-container'>
                        <div class='reply-message'>
                        <form action='controllers/RepliesResponses.php' method='post' class='reply-form-hidden'>
                        <input type='hidden' name='type' value='reply-response-final'>
                        <input type='hidden' name='parent-username' value='{$responserow->response_username}'>
                        <input type='hidden' name='parent-id' value='{$responserow->response_user_id}'>
                        <input type='hidden' name='parent-reply-id' value='{$responserow->response_id}'>
                        <textarea name='response' class='hidden-text-area' placeholder='Reply to this comment...' required></textarea>
                        <button type='button' class='cancel-btn'>Cancel</button>
                        <input type='submit' value='Submit'>
                        </form>
                        </div>
                        </div>
                        </div>
                    </div>
                    ";
                    }
                }
            }
            
            echo "<div class='comment-reply-container'>
                <form class='comment-form' id='comment-form-{$row->profilepostsID}'>
                    <input type='hidden' name='type' value='post-reply'>
                    <input type='hidden' name='reply-parent-name' value='{$row->postusername}' id='reply-parent-name-{$row->profilepostsID}'>
                    <input type='hidden' name='reply-parent-id' value='{$row->profilepostsID}' id='reply-parent-id-{$row->profilepostsID}'>
                    <textarea name='comment' id='comment-{$row->profilepostsID}' placeholder='Comment on this post...' class='comment-textarea'></textarea>
                    <button type='button' class='comment-reply-cancel'>Cancel</button>
                    <input type='submit' value='Comment' class='comment-reply-submit'>
                </form>
            </div>
        </div>";
        }
    }

    public function likePost() {
        $postID = $_GET["postID"];
        $username = $_SESSION["username"] . ',';

        $this->db->prepare("SELECT * FROM profileposts WHERE profilepostsID = $postID");
        $row = $this->db->fetch();
        if($row->post_likes_list == 'none') {
            $this->db->prepare("UPDATE profileposts SET post_likes = post_likes + 1, post_likes_list = '$username' WHERE profilepostsID = $postID");
            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        } else {
            $this->db->prepare("UPDATE profileposts SET post_likes = post_likes + 1, post_likes_list = CONCAT('$username', post_likes_list) WHERE profilepostsID = $postID");
            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }
}

$init = new ProfilePost;