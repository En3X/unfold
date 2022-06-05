<section class="postsSection">
    <div class="heading kbold">
        Posts by you
    </div>
    <div class="posts">
    <?php
    $sql = "
        select * from post where uid = $user->id order by pid desc
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
                        <ion-icon style="color: #F36077" name="heart-outline"></ion-icon>

                        <span class="kregular numLikes">
                            <?php echo $post->getNumLikes($mysqli) ?>
                        </span>
                    </div>
                    <div 
                    onclick="window.open('./services/delete.php?postId=<?php echo $post->id?>','_self')" 
                    class="icongroup">
                        <ion-icon style="color: #F36077" name="trash-outline"></ion-icon>
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