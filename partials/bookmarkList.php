<section class="postsSection">
    <div class="heading kbold">
        Saved posts
    </div>
    <div class="posts">
    <?php
    $sql = "
        select * from post P,bookmarks B  where P.pid = B.pid and B.uid = $user->id order by P.pid desc
    ";
    if($data = $mysqli->query($sql)){
        if ($data->num_rows < 1) {
            ?>
            <div class="kregular">
                No bookmarked post found
            </div>
            <?php
        }else{
            while ($row = $data->fetch_assoc()) {
                $id = $row['pid'];
                $title = $row['title'];
                $body = $row['body'];
                $tag = $row['tag'];
                $uid = $row['uid'];
                $uname = $row['uname'];
                $postDate = $row['postDate'];
                $post = new Post(
                    $id,$title,$body,$tag,$uid,$uname,$postDate
                );

                ?>
                    <div class="postCard">
                <div class="postHead">
                    <div class="userDetail">
                        <div class="userImg">
                            <img src="./img/user/default_user.jpg" alt="">
                        </div>
                        <div class="headingtext">
                            <div class="name kbold">
                                <?php echo $post->uname?>
                            </div>
                            <div class="date kregular">
                                <?php echo $post->date?>
                            </div>
                        </div>
                    </div>
                </div>

                

                <div class="mainpost">
                    <div class="heading mbold">
                    <?php echo $post->title?>
                    </div>
                    <div class="posttext mregular">
                    <?php echo $post->body?>
                    </div>
                </div>

                <div class="controlsSection">
                <div class="icongroup">
                        <!-- <ion-icon
                        onclick="toggleHeart(this)"
                        name="heart-outline"></ion-icon> -->
                        <?php
                            if ($user->hasLikedPost($post->id,$mysqli)) {
                                ?>
                                <ion-icon onclick="window.location.href='./services/controlLike.php?post=<?php echo $post->id?>'" style="color: #F36077" name="heart"></ion-icon>
                                <?php
                            }else{
                                ?>
                                    <ion-icon onclick="window.location.href='./services/controlLike.php?post=<?php echo $post->id?>'" style="color: #000" name="heart-outline"></ion-icon>
                                <?php
                            }
                        ?>
                        <span class="kregular numLikes">
                            <?php echo $post->getNumLikes($mysqli) ?>
                        </span>
                    </div>
                    <div class="icongroup">
                    <?php
                            if ($user->hasBookmarkPost($post->id,$mysqli)) {
                                ?>
                                <ion-icon onclick="window.location.href='./services/controlBookmark.php?post=<?php echo $post->id?>'" style="color: #6E66FF" name="bookmark"></ion-icon>
                                <?php
                            }else{
                                ?>
                                    <ion-icon onclick="window.location.href='./services/controlBookmark.php?post=<?php echo $post->id?>'" style="color: #000" name="bookmark-outline"></ion-icon>

                                <?php
                            }
                        ?>
                </div>
                </div>
                
            </div>
                <?php
            }
        }
    }
?>
    </div>
</section>