<?php 
if(!isset($_SESSION)) {
    session_start();
    if(empty($_SESSION["id"])) {
        header("location: index.php");
        exit();
    }
}
?>

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
                <form action='controllers/ProfilePostsReplies.php' method='post' class='comment-form'>
                    <input type='hidden' name='type' value='post-reply'>
                    <input type='hidden' name='reply-parent-name' value='{$row->postusername}'>
                    <input type='hidden' name='reply-parent-id' value='{$row->profilepostsID}'>
                    <textarea name='comment' id='comment' placeholder='Comment on this post...' class='comment-textarea'></textarea>
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

if($_SERVER["REQUEST_METHOD"] == "GET") {
    switch($_GET["action"]) {
        case "like":
            $init->likePost();
            break;
    }
}
?>

<?php
    $title = "My Profile | Uni-Connect";
    require_once "helpers/session_helper.php";
    include "includes/header_logged_in.php";
    include "includes/navbar_logged_in.php";
?>

<div class="profile-page-container">
    <div class="profile-container">
        <div class="profile-top">
            <div class="profile-img-container"><img src="images\profile_images\<?php echo $_SESSION['profile_photo']; ?>" alt=""></div>
                
            <div class="profile-info-container">
                <div class="profile-info-background">   
                    <img src="images/banner_images/default-banner.png" alt="Profile Picture">
                </div>
                <div class="profile-name"><h3><?php echo $_SESSION["fname"]." ".$_SESSION["lname"]; ?></h3></div>
                <div class="profile-bio"><h4><?php echo $_SESSION["bio"] ?></h4></div>
                <div class="profile-uni"><?php echo $_SESSION["university"]; ?></div>
                <div class="profile-course"><?php echo $_SESSION["course"] ?></div>
                <div class="last-seen"><?php echo $_SESSION["last_seen"]; ?></div>
                <div class="add-friend">Connect</div>
            </div>
        </div>

        <div class="profile-filter-container">
            <div class="filter-activity">
                <button><i class="fas fa-house-user" id="active-filter"></i></button>
                <h4>Posts</h4>
            </div>
            <div class="filter-about">
                <button><i class="fas fa-user-circle fa-user-circle-identifier"></i></button>
                <h4>About Me</h4>
            </div>
            <div class="filter-gallery">
                <button><i class="fas fa-photo-video"></i></button>
                <h4>Gallery</h4>
            </div>
            <div class="filter-posts">
                <button><i class="fas fa-folder-open"></i></button>
                <h4>Forum Posts</h4>
            </div>
        </div>
        
        <!--About Me Content-->
        <div class="about-me-container">
            <div class="about-me-inner flex-container">
                <div class="about-image">
                    <img src="images\profile_images\<?php echo $_SESSION['profile_photo']; ?>" alt="Profile Picture">
                </div>
                <div class="about-main">
                    <h3>About <span><?php echo $_SESSION["fname"]?></span></h3>
                    <h3>Name: <span><?php echo $_SESSION["fname"]." ".$_SESSION["lname"]; ?></span></h3>
                    <h3>Age: <span>21</span></h3>
                    <h3>University: <span><?php echo $_SESSION["university"]; ?></span></h3>
                    <h3>Course: <span>Mechanical Engineering</span></h3>
                    <h3>Societies: <ul>
                        <li>Bitcoin Society</li>
                        <li>Blockchain Society</li>
                        <li>Crypto Society</li>
                    </ul></h3>
                    <h3>City: <span>Leeds</span></h3>
                    <h3>About Me: <span>Hi there, my name is John Doe. I am currently studying Mechanical Engineering at the University of Leeds and am wanting to connect to others on my course. Send me a message some time!</span></h3>
                    <h3>Hobbies: <ul>
                        <li>Tennis</li>
                        <li>Reading</li>
                        <li>Cooking</li>
                    </ul></h3>
                    <h3>Interests: <ul>
                        <li>Conspiracy Theories</li>
                        <li>90's Movies</li>
                    </ul></h3>
                </div>
            </div>
        </div>
        <!--End of Gallery Container-->

        <!--Gallery Container-->
        <div class="gallery-container">
            <div class="gallery-filter flex-container">
                <h3>All</h3>
                <h3>Photos</h3>
                <h3>Videos</h3>
                <h3>Audio</h3>
            </div>
            <div class="gallery-inner-container flex-container">
                <div class="gallery-img"><img src="images/user_uploaded_images/selfie.jpg"></div>
                <div class="gallery-img"><img src="images/user_uploaded_images/selfie.jpg"></div>
                <div class="gallery-img"><img src="images/user_uploaded_images/selfie.jpg"></div>
                <div class="gallery-img"><img src="images/user_uploaded_images/selfie.jpg"></div>
                <div class="gallery-img"><img src="images/user_uploaded_images/selfie.jpg"></div>
                <div class="gallery-img"><img src="images/user_uploaded_images/selfie.jpg"></div>
                <div class="gallery-img"><img src="images/user_uploaded_images/selfie.jpg"></div>
                <div class="gallery-img"><img src="images/user_uploaded_images/selfie.jpg"></div>
                <div class="gallery-img"><img src="images/user_uploaded_images/selfie.jpg"></div>
                <div class="gallery-img"><img src="images/user_uploaded_images/selfie.jpg"></div>
                <div class="gallery-img"><img src="images/user_uploaded_images/selfie.jpg"></div>
                <div class="gallery-img"><img src="images/user_uploaded_images/selfie.jpg"></div>
            </div>
        </div>
        <!--End of Gallery Container-->

        <!--Forum Posts Container-->
        <div class="forum-posts-container">
            <div class="forum-posts-inner-wrapper flex-container">
                <div class="forum-posts-left-side">
                    <div class="forum-posts-left-side-inner">
                        <h2>Filter By</h2>
                        <h3>Threads Started</h3>
                        <h3>Threads Replied To</h3>
                        <h2>Order By</h2>
                        <h3>Newest Forum Posts</h3>
                        <h3>Oldest Forum Posts</h3>
                    </div>
                </div>
                <div class="forum-posts-right-side">
                    <div class="forum-posts-right-side-inner">
                        <h3>Forum Posts (1,675 posts)</h3>
                        <div class="forum-posts-right-side-container">
                            <div class="f-p-r-s-top">
                            <a href=""><img src="images/profile_images/blank-profile.png" alt=""></a>
                            <h3><a href="">How do you get a job as a mechanical engineer?</a></h3>
                            </div>
                            <div class="f-p-r-s-bottom">
                                <h3>Ok! We have released further updates to the Latest Threads module. Ability to switch to legacy mode (using previous version of the module) found in settings. Ability to disable popups on thread hover. Ability to disable scrolling and loading of more threads. Various bug fixes and speed optimizations. If you encounter any issues or have further suggestions let us know!</h3>
                            </div>
                            <div class="f-p-r-s-info">
                                <h3><span><a href="">Career Advice >> Support >> Support Questions</a> - 17/12/2021</span></h3>
                            </div>
                        </div>
                        <div class="forum-posts-right-side-container">
                            <div class="f-p-r-s-top">
                            <a href=""><img src="images/profile_images/blank-profile.png" alt=""></a>
                            <h3><a href="">How do you get a job as a mechanical engineer?</a></h3>
                            </div>
                            <div class="f-p-r-s-bottom">
                                <h3>Ok! We have released further updates to the Latest Threads module. Ability to switch to legacy mode (using previous version of the module) found in settings. Ability to disable popups on thread hover. Ability to disable scrolling and loading of more threads. Various bug fixes and speed optimizations. If you encounter any issues or have further suggestions let us know!</h3>
                            </div>
                            <div class="f-p-r-s-info">
                                <h3><span><a href="">Career Advice >> Support >> Support Questions</a> - 17/12/2021</span></h3>
                            </div>
                        </div>
                        <div class="forum-posts-right-side-container">
                            <div class="f-p-r-s-top">
                            <a href=""><img src="images/profile_images/blank-profile.png" alt=""></a>
                            <h3><a href="">How do you get a job as a mechanical engineer?</a></h3>
                            </div>
                            <div class="f-p-r-s-bottom">
                                <h3>Ok! We have released further updates to the Latest Threads module. Ability to switch to legacy mode (using previous version of the module) found in settings. Ability to disable popups on thread hover. Ability to disable scrolling and loading of more threads. Various bug fixes and speed optimizations. If you encounter any issues or have further suggestions let us know!</h3>
                            </div>
                            <div class="f-p-r-s-info">
                                <h3><span><a href="">Career Advice >> Support >> Support Questions</a> - 17/12/2021</span></h3>
                            </div>
                        </div>
                        <div class="forum-posts-right-side-container">
                            <div class="f-p-r-s-top">
                            <a href=""><img src="images/profile_images/blank-profile.png" alt=""></a>
                            <h3><a href="">How do you get a job as a mechanical engineer?</a></h3>
                            </div>
                            <div class="f-p-r-s-bottom">
                                <h3>Ok! We have released further updates to the Latest Threads module. Ability to switch to legacy mode (using previous version of the module) found in settings. Ability to disable popups on thread hover. Ability to disable scrolling and loading of more threads. Various bug fixes and speed optimizations. If you encounter any issues or have further suggestions let us know!</h3>
                            </div>
                            <div class="f-p-r-s-info">
                                <h3><span><a href="">Career Advice >> Support >> Support Questions</a> - 17/12/2021</span></h3>
                            </div>
                        </div>

                        <div class="forum-posts-pagination">
                            <button><<</button>
                            <button><</button>
                            <h3>Page</h3>
                            <input type="number" name="" id="">
                            <button>Go</button>
                            <h3>of <span>34</span></h3>
                            <button>></button>
                            <button>>></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End of Forum Posts Container-->

        <!--Posts Content-->
        <div class="profile-bottom flex-container">
            <div class="profile-posts">
                
                <div class="create-a-post" id="new-post-container">
                    <form action="controllers/ProfilePosts.php" method="post" class="comment-form" id="new-post-form">
                        <input type="hidden" name="type" value="new-post">
                        <textarea required name="wall-post" id="wall-post" placeholder="Post something to your wall..." class="comment-textarea"></textarea>
                        <button type="button" class="comment-reply-cancel">Cancel</button>
                        <input type="submit" value="Post" class="comment-reply-submit">
                    </form>
                </div>

                <?php $init->retrievePostData(); ?>

            </div>

            <div class="profile-right-container">
                <div class="profile-friends">
                    <div class="profile-friends-header">
                        <h3>Connections</h3>
                        <h4><a href="">57 Connections</a></h4>
                    </div>
                    <div class="friends-container">
                        <div class="friend"><a href=""><img src="images/profile_images/blank-profile.png" alt=""></a></div>
                        <div class="friend"><a href=""><img src="images/profile_images/blank-profile.png" alt=""></a></div>
                        <div class="friend"><a href=""><img src="images/profile_images/blank-profile.png" alt=""></a></div>
                        <div class="friend"><a href=""><img src="images/profile_images/blank-profile.png" alt=""></a></div>
                        <div class="friend"><a href=""><img src="images/profile_images/blank-profile.png" alt=""></a></div>
                        <div class="friend"><a href=""><img src="images/profile_images/blank-profile.png" alt=""></a></div>
                        <div class="friend"><a href=""><img src="images/profile_images/blank-profile.png" alt=""></a></div>
                        <div class="friend"><a href=""><img src="images/profile_images/blank-profile.png" alt=""></a></div>
                        <div class="friend"><a href=""><img src="images/profile_images/blank-profile.png" alt=""></a></div>
                        <div class="friend"><a href=""><img src="images/profile_images/blank-profile.png" alt=""></a></div>
                        <div class="friend"><a href=""><img src="images/profile_images/blank-profile.png" alt=""></a></div>
                        <div class="friend"><a href=""><img src="images/profile_images/blank-profile.png" alt=""></a></div>
                    </div>
                </div>

                <div class="profile-gallery-container">
                    <div class="profile-gallery-header">
                        <h3>Photos and Videos</h3>
                        <h4><a href="">17 Uploads</a></h4>
                    </div>
                    <div class="profile-media-container">
                        <div class="profile-media"><a href=""><img src="images/user_uploaded_images/selfie.jpg" alt=""></a></div>
                        <div class="profile-media"><a href=""><img src="images/user_uploaded_images/selfie.jpg" alt=""></a></div>
                        <div class="profile-media"><a href=""><img src="images/user_uploaded_images/selfie.jpg" alt=""></a></div>
                        <div class="profile-media"><a href=""><img src="images/user_uploaded_images/selfie.jpg" alt=""></a></div>
                        <div class="profile-media"><a href=""><img src="images/user_uploaded_images/selfie.jpg" alt=""></a></div>
                        <div class="profile-media"><a href=""><img src="images/user_uploaded_images/selfie.jpg" alt=""></a></div>
                    </div>
                </div>

                <div class="recent-posts-container">
                    <div class="recent-posts-top">
                        <h3>Recent Posts</h3>
                        <h4><a href="">View All Posts</a></h4>
                    </div>
                    <div class="recent-post-content">
                        <div class="recent-post-content-top">
                            <h3><a href="">How do you find the union?</a></h3>
                            <h4>Dec 8, 21</h4>
                        </div>
                        <div class="recent-post-content-main">
                            <h3>I know we already dmed each other but I just wanna thank you again for all of your hard work.</h3>
                        </div>
                    </div>
                    <div class="recent-post-content">
                        <div class="recent-post-content-top">
                            <h3><a href="">Simple recipes for students.</a></h3>
                            <h4>Dec 8, 21</h4>
                        </div>
                        <div class="recent-post-content-main">
                            <h3>I know we already dmed each other but I just wanna thank you again for all of your hard work.</h3>
                        </div>
                    </div>
                    <div class="recent-post-content">
                        <div class="recent-post-content-top">
                            <h3><a href="">How do you get a job as an engineer?</a></h3>
                            <h4>Dec 8, 21</h4>
                        </div>
                        <div class="recent-post-content-main">
                            <h3>I know we already dmed each other but I just wanna thank you again for all of your hard work.</h3>
                        </div>
                    </div>
                    <div class="recent-post-content">
                        <div class="recent-post-content-top">
                            <h3><a href="">Hello, my name is John. I am new to this University.</a></h3>
                            <h4>Dec 8, 21</h4>
                        </div>
                        <div class="recent-post-content-main">
                            <h3>I know we already dmed each other but I just wanna thank you again for all of your hard work.</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End of Posts Content-->
    </div>
</div>
<script src="scripts/replytoggler.js"></script>
<script src="scripts/profilefilter.js"></script>
<script src="scripts/settingstoggler.js"></script>
<?php
    include "includes/footer.php";
?>  