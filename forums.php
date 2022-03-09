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
    $title = "Forums | Uni-Connect";
    require_once "helpers/session_helper.php";
    include "includes/header_logged_in.php";
    include "includes/navbar_logged_in.php";
?>
<div class="profile-page-container" style="padding: 80px 30px; margin-right: 20px">
    <div class="flex-container forums-container">
        <div class="posts-container">
            <div class="university-header">
                <h2>The Forums | <span>The University of Leeds</span></h2>
            </div>
            <div class="posts-section forum-section-1">
                <table>
                    <tr>
                        <th>General</th>
                        <th>Threads</th>
                        <th>Posts</th>
                        <th>Latest Posts</th>
                    </tr>
                    <tr>
                        <td><a href="">Introduce Yourself</a>
                            <span class="table-desc">New to the forums? Introduce yourself!</span>
                        </td>
                        <td>25</td>
                        <td>154</td>
                        <td><a href="">Hi, my name is John Doe.</a></td>
                    </tr>
                    <tr>
                        <td><a href="">Uni Questions</a>
                            <span class="table-desc">Got a uni-related question that needs answering?</span>
                        </td>
                        <td>12</td>
                        <td>85</td>
                        <td><a href="">I need some tips for my personal statement, any help would be appreciated.</a></td>
                    </tr>
                    <tr>
                        <td><a href="">Uni Events</a>
                            <span class="table-desc">Hosting a uni event? Post it here!</span>
                        </td>
                        <td>73</td>
                        <td>1530</td>
                        <td><a href="">Society Event - All Are Welcome 12/12/2021</a></td>
                    </tr>
                    <tr>
                        <td><a href="">Societies</a>
                            <span class="table-desc">Want to join a society? Posting about one? Goes here.</span>
                        </td>
                        <td>28</td>
                        <td>132</td>
                        <td><a href="">Judo Society - All Are Welcome!</a></td>
                    </tr>
                    <tr>
                        <td><a href="">Career Advice</a>
                            <span class="table-desc">Ask other students for career advice.</span>
                        </td>
                        <td>28</td>
                        <td>132</td>
                        <td><a href="">Roadmap to becoming an engineer?</a></td>
                    </tr>   
                </table>
            </div>
            <div class="posts-section forum-section-2">
                <table>
                    <tr>
                        <th>Interests</th>
                        <th>Threads</th>
                        <th>Posts</th>
                        <th>Latest Posts</th>
                    </tr>
                    <tr>
                        <td><a href="">Television & Film</a>
                            <span class="table-desc">Talk about your favorite tv shows and films.</span>
                        </td>
                        <td>73</td>
                        <td>1530</td>
                        <td><a href="">Society Event - All Are Welcome 12/12/2021</a></td>
                    </tr>
                    <tr>
                        <td><a href="">Sports</a>
                            <span class="table-desc">Discuss the latest sporting events.</span>
                        </td>
                        <td>73</td>
                        <td>1530</td>
                        <td><a href="">Society Event - All Are Welcome 12/12/2021</a></td>
                    </tr>
                    <tr>
                        <td><a href="">Fitness</a>
                            <span class="table-desc">Workout routines, diet, tips and tricks.</span>
                        </td>
                        <td>73</td>
                        <td>1530</td>
                        <td><a href="">Society Event - All Are Welcome 12/12/2021</a></td>
                    </tr>
                    <tr>
                        <td><a href="">E-Sports</a>
                            <span class="table-desc">gg ff15 go next</span>
                        </td>
                        <td>73</td>
                        <td>1530</td>
                        <td><a href="">Society Event - All Are Welcome 12/12/2021</a></td>
                    </tr>
                    <tr>
                        <td><a href="">Music</a>
                            <span class="table-desc">Whos your favorite artist?</span>
                        </td>
                        <td>73</td>
                        <td>1530</td>
                        <td><a href="">Society Event - All Are Welcome 12/12/2021</a></td>
                    </tr>
                    <tr>
                        <td><a href="">Food & Cooking</a>
                            <span class="table-desc">Recipes, tips and tricks for delicious food go here.</span>
                        </td>
                        <td>73</td>
                        <td>1530</td>
                        <td><a href="">Society Event - All Are Welcome 12/12/2021</a></td>
                    </tr>
                    <tr>
                        <td><a href="">History</a>
                            <span class="table-desc">Talk about that one time where that one thing happened.</span>
                        </td>
                        <td>73</td>
                        <td>1530</td>
                        <td><a href="">Society Event - All Are Welcome 12/12/2021</a></td>
                    </tr>
                    <tr>
                        <td><a href="">Travel and Outdoors</a>
                            <span class="table-desc">Discuss all your travels and adventures here.</span>
                        </td>
                        <td>73</td>
                        <td>1530</td>
                        <td><a href="">Society Event - All Are Welcome 12/12/2021</a></td>
                    </tr>
                    <tr>
                        <td><a href="">Technology</a> 
                            <span class="table-desc">Can someone please tell me what a shared ledger is??</span>
                        </td>
                        <td>73</td>
                        <td>1530</td>
                        <td><a href="">Society Event - All Are Welcome 12/12/2021</a></td>
                    </tr>
                    <tr>
                        <td><a href="">Books and Literature</a>
                            <span class="table-desc">Dumbledore asked calmly.</span>
                        </td>
                        <td>73</td>
                        <td>1530</td>
                        <td><a href="">Society Event - All Are Welcome 12/12/2021</a></td>
                    </tr>
                    <tr>
                        <td><a href="">Maths & Science</a>
                            <span class="table-desc">What did the triangle say to the circle? “You're pointless.”</span>
                        </td>
                        <td>73</td>
                        <td>1530</td>
                        <td><a href="">Society Event - All Are Welcome 12/12/2021</a></td>
                    </tr>
                    <tr>
                        <td><a href="">Conspiracies</a>
                            <span class="table-desc">MK Ultra? Bigfoot? Flat Earth??</span>
                        </td>
                        <td>73</td>
                        <td>1530</td>
                        <td><a href="">Society Event - All Are Welcome 12/12/2021</a></td>
                    </tr>
                </table>
            </div>
            <div class="posts-section forum-section-3">
                <table>
                    <tr>
                        <th>World Events</th>
                        <th>Threads</th>
                        <th>Posts</th>
                        <th>Latest Posts</th>
                    </tr>
                    <tr>
                        <td><a href="">News</a>
                            <span class="table-desc">Discussion on the latest news and world events.</span>
                        </td>
                        <td>73</td>
                        <td>1530</td>
                        <td><a href="">Society Event - All Are Welcome 12/12/2021</a></td>
                    </tr>
                    <tr>
                        <td><a href="">Politics</a>
                            <span class="table-desc">All things politics.</span>
                        </td>
                        <td>73</td>
                        <td>1530</td>
                        <td><a href="">Society Event - All Are Welcome 12/12/2021</a></td>
                    </tr>
                    <tr>
                        <td><a href="">Debate</a>
                            <span class="table-desc">Want to debate others on a certain topic?</span>
                        </td>
                        <td>73</td>
                        <td>1530</td>
                        <td><a href="">Society Event - All Are Welcome 12/12/2021</a></td>
                    </tr>
                </table>
            </div>
            <div class="posts-section forum-section-4">
                <table>
                    <tr>
                        <th>I Need Advice</th>
                        <th>Threads</th>
                        <th>Posts</th>
                        <th>Latest Posts</th>
                    </tr>
                    <tr>
                        <td><a href="">Advice General</a>
                            <span class="table-desc">Need advice on something? Ask other students.</span>
                        </td>
                        <td>73</td>
                        <td>1530</td>
                        <td><a href="">Society Event - All Are Welcome 12/12/2021</a></td>
                    </tr>
                    <tr>
                        <td><a href="">Mental Health</a>
                            <span class="table-desc">Need a place to chat? You are welcome here.</span>
                        </td>
                        <td>73</td>
                        <td>1530</td>
                        <td><a href="">Society Event - All Are Welcome 12/12/2021</a></td>
                    </tr>
                </table>
            </div>
            
            <div class="site-stats-container">
                <div class="flex-container">
                    <div class="site-stat"><h3>Members: 18,323</h3></div>
                    <div class="site-stat"><h3>Threads: 15,841</h3></div>
                    <div class="site-stat"><h3>Posts: 34,351</h3></div>
                    <div class="site-stat"><h3>Views: 112,436</h3></div>
                </div>
                <div class="newest-user">
                    <h3>Welcome to our latest member JohnDoe100 registered 15 minutes ago</h3>
                </div>
            </div>
        </div>
        <div class="right-container">
            <div class="latest-threads-container">
                <h4>Latest Threads</h4>
                <div class="latest-thread flex-container">
                    <div class="latest-thread-user-img">Img</div>
                    <div class="latest-thread-info">
                        <h3>Latest Post</h3>
                        <h3>User's Name</h3>
                        <h3>User's Name</h3>
                    </div>
                    <span class="thread-time">1 w</span>
                </div>
                <div class="latest-thread flex-container">
                    <div class="latest-thread-user-img">Img</div>
                    <div class="latest-thread-info">
                        <h3>Latest Post</h3>
                        <h3>User's Name</h3>
                        <h3>User's Name</h3>
                    </div>
                </div>
                <div class="latest-thread flex-container">
                    <div class="latest-thread-user-img">Img</div>
                    <div class="latest-thread-info">
                        <h3>Latest Post</h3>
                        <h3>User's Name</h3>
                        <h3>User's Name</h3>
                    </div>
                    <span class="thread-time">1 w</span>
                </div>
                <div class="latest-thread flex-container">
                    <div class="latest-thread-user-img">Img</div>
                    <div class="latest-thread-info">
                        <h3>Latest Post</h3>
                        <h3>User's Name</h3>
                        <h3>User's Name</h3>
                    </div>
                    <span class="thread-time">1 w</span>
                </div>
                <div class="latest-thread flex-container">
                    <div class="latest-thread-user-img">Img</div>
                    <div class="latest-thread-info">
                        <h3>Latest Post</h3>
                        <h3>User's Name</h3>
                        <h3>User's Name</h3>
                    </div>
                    <span class="thread-time">1 w</span>
                </div>
                <div class="latest-thread flex-container">
                    <div class="latest-thread-user-img">Img</div>
                    <div class="latest-thread-info">
                        <h3>Latest Post</h3>
                        <h3>User's Name</h3>
                        <h3>User's Name</h3>
                    </div>
                    <span class="thread-time">1 w</span>
                </div>
                <div class="latest-thread flex-container">
                    <div class="latest-thread-user-img">Img</div>
                    <div class="latest-thread-info">
                        <h3>Latest Post</h3>
                        <h3>User's Name</h3>
                        <h3>User's Name</h3>
                    </div>
                    <span class="thread-time">1 w</span>
                </div>
                <div class="latest-thread flex-container">
                    <div class="latest-thread-user-img">Img</div>
                    <div class="latest-thread-info">
                        <h3>Latest Post</h3>
                        <h3>User's Name</h3>
                        <h3>User's Name</h3>
                    </div>
                    <span class="thread-time">1 w</span>
                </div>
                <div class="latest-thread flex-container">
                    <div class="latest-thread-user-img">Img</div>
                    <div class="latest-thread-info">
                        <h3>Latest Post</h3>
                        <h3>User's Name</h3>
                        <h3>User's Name</h3>
                    </div>
                    <span class="thread-time">1 w</span>
                </div>
                <div class="latest-thread flex-container">
                    <div class="latest-thread-user-img">Img</div>
                    <div class="latest-thread-info">
                        <h3>Latest Post</h3>
                        <h3>User's Name</h3>
                        <h3>User's Name</h3>
                    </div>
                    <span class="thread-time">1 w</span>
                </div>
                <div class="latest-thread flex-container">
                    <div class="latest-thread-user-img">Img</div>
                    <div class="latest-thread-info">
                        <h3>Latest Post</h3>
                        <h3>User's Name</h3>
                        <h3>User's Name</h3>
                    </div>
                    <span class="thread-time">1 w</span>
                </div>
            </div>

            <div class="user-statistics-container">
                <div class="user-statistics-header">
                    <h4>Top Users</h4>
                </div>
                <div class="user-statistics-user-container flex-container">
                    <div class="user-statistics-number">1</div>
                    <div class="user-statistics-user-img">Img</div>
                    <div class="user-statistics-user-info">
                        <h3>User's Name</h3>
                        <h4>100 Points</h4>
                    </div>
                </div>
                <div class="user-statistics-user-container flex-container">
                    <div class="user-statistics-number">2</div>
                    <div class="user-statistics-user-img">Img</div>
                    <div class="user-statistics-user-info">
                        <h3>User's Name</h3>
                        <h4>100 Points</h4>
                    </div>
                </div>
                <div class="user-statistics-user-container flex-container">
                    <div class="user-statistics-number">3</div>
                    <div class="user-statistics-user-img">Img</div>
                    <div class="user-statistics-user-info">
                        <h3>User's Name</h3>
                        <h4>100 Points</h4>
                    </div>
                </div>
                <div class="user-statistics-user-container flex-container">
                    <div class="user-statistics-number">4</div>
                    <div class="user-statistics-user-img">Img</div>
                    <div class="user-statistics-user-info">
                        <h3>User's Name</h3>
                        <h4>100 Points</h4>
                    </div>
                </div>
                <div class="user-statistics-user-container flex-container">
                    <div class="user-statistics-number">5</div>
                    <div class="user-statistics-user-img">Img</div>
                    <div class="user-statistics-user-info">
                        <h3>User's Name</h3>
                        <h4>100 Points</h4>
                    </div>
                </div>
                <div class="user-statistics-user-container flex-container">
                    <div class="user-statistics-number">6</div>
                    <div class="user-statistics-user-img">Img</div>
                    <div class="user-statistics-user-info">
                        <h3>User's Name</h3>
                        <h4>100 Points</h4>
                    </div>
                </div>
                <div class="user-statistics-user-container flex-container">
                    <div class="user-statistics-number">7</div>
                    <div class="user-statistics-user-img">Img</div>
                    <div class="user-statistics-user-info">
                        <h3>User's Name</h3>
                        <h4>100 Points</h4>
                    </div>
                </div>
                <div class="user-statistics-user-container flex-container">
                    <div class="user-statistics-number">8</div>
                    <div class="user-statistics-user-img">Img</div>
                    <div class="user-statistics-user-info">
                        <h3>User's Name</h3>
                        <h4>100 Points</h4>
                    </div>
                </div>
                <div class="user-statistics-user-container flex-container">
                    <div class="user-statistics-number">9</div>
                    <div class="user-statistics-user-img">Img</div>
                    <div class="user-statistics-user-info">
                        <h3>User's Name</h3>
                        <h4>100 Points</h4>
                    </div>
                </div>
                <div class="user-statistics-user-container flex-container">
                    <div class="user-statistics-number">10</div>
                    <div class="user-statistics-user-img">Img</div>
                    <div class="user-statistics-user-info">
                        <h3>User's Name</h3>
                        <h4>100 Points</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="scripts/settingstoggler.js"></script>
<?php
    include "includes/footer.php";
?>  