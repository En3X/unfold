<section class="postsSection">
    <div class="heading kbold">
        All Posts
    </div>
    <div class="posts">
    <?php
    $sql = "
        select * from post where uid != $user->id order by pid desc
    ";
    if ($data = $mysqli->query($sql)) {
        // echo "<script>console.log('$user->id')</script>";
        if ($data->num_rows > 0) {
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
            <div onclick="window.location.href='?fullpost&pid=<?php echo $post->id?>'" class="postCard">
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
        }else{
            ?>
            <div class="kregular">
                There are no posts available right now.
            </div>
            <?php
        }
    }
?>

    </div>
</section>


<script>
    function toggleHeart(elem){
        if (elem.name=="heart-outline") {
            elem.style.color = "#F36077";
            elem.name="heart";
        }else{
            elem.style.color = "#000";
            elem.name = "heart-outline";
        }
    }

    function toggleBookmark(elem){
        if (elem.name=="bookmark-outline") {
            elem.style.color = "#6E66FF";
            elem.name="bookmark";
        }else{
            elem.style.color = "#000";
            elem.name = "bookmark-outline";
        }
    }
</script>

<!-- <div class="postCard">
            <div class="postHead">
                <div class="userDetail">
                    <div class="userImg">
                        <img src="./img/user/default_user.jpg" alt="">
                    </div>
                    <div class="headingtext">
                        <div class="name kbold">
                            Maneesh Pandey
                        </div>
                        <div class="date kregular">
                            5 June, 2022
                        </div>
                    </div>
                </div>
            </div>

            <div class="mainpost">
                <div class="heading mbold">
                    How I overcame depression?
                </div>
                <div class="posttext mregular">
                    I have been in depression for so long. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aliquam nesciunt dicta quisquam ullam tempore voluptatum, magni voluptates quas ipsa adipisci debitis rem veritatis fugiat mollitia laboriosam commodi enim atque quos?
                </div>
            </div>
        </div> -->