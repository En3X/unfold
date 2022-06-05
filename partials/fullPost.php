<section class="postsSection fullpostsection">
    <?php
        if (isset($_GET['pid'])) {
            $post = $_GET['pid'];
            $sql = "
                select * from post where pid = $post
            ";
            if ($data = $mysqli->query($sql)) {
                if ($data->num_rows == 1) {
                    while ($row = $data->fetch_assoc()) {
                        $uname = $row['uname'];
                        $title = $row['title'];
                        $body = $row['body'];
                        $date = $row['postDate'];
                        $tag = $row['tag'];
                    }
                    ?>
    <div class="postHead">
        <div class="maindetails">
            <div class="userimg">
                <img src="./img/user/default_user.jpg" alt="">
            </div>
            <div class="details">
                <div class="username kbold">
                    <?php echo $uname?>
                </div>
                <div class="postDate kregular">
                    <?php echo $date?>
                </div>
            </div>
        </div>
        <div class="right klight">
            <div id="listen">
                <ion-icon name="play-circle-outline"></ion-icon> Listen
            </div>
            
            <div id="report">
                <ion-icon name="alert-circle-outline"></ion-icon> Report
            </div>
        </div>
    </div>

    <div id="title" class="heading kbold mt50">
        <?php echo $title?>
    </div>
    <div id="body" class="postbody kregular mt10">
        <?php echo $body?>
    </div>
    
    <br><br>
    <script>
        document.querySelector('#listen').addEventListener('click',(e)=>{
            title = document.querySelector('#title').textContent;
            body = document.querySelector('#body').textContent;
            msg = title+"."+body;
            var speaker = new SpeechSynthesisUtterance();
            speaker.text = msg;
            window.speechSynthesis.speak(speaker);
        })
    </script>
    <hr>
    <div class="commentSection">
        <div class="cmtHeading kbold">
            Leave some kind words
        </div>
        <div class="profileDetails kregular">
            You are commenting publicly as <b><?php echo $user->name?></b>
        </div>
        <div class="textarea">
            <form method="post" action="./services/postComment.php">
                <textarea required placeholder="You have inspired me a lot. Thank you!" name="cmt"></textarea>
                <input type="hidden" name="postid" value="<?php echo $post?>">
                <input type="hidden" name="isCommentPosted" value=1>
                <input class="commentBtn" type="submit" value="Comment">
            </form>
        </div>
    </div>
    
    <br><hr><br>
    <?php
        function getNumComment($post,$mysqli){
            $sql = "select * from comment where pid=$post";
            if ($data=$mysqli->query($sql)) {
                return $data->num_rows;
            }
            return 0;
        }
    
    ?>
    <div class="comments">
        <div class="cmtHeading kbold">
            All comments (<?php echo getNumComment($post,$mysqli)?>)
        </div>
        <div class="commentlist">
            <!-- <div class="comment">
                <div class="userdetail">
                    <div class="userimg">
                            <img src="./img/user/default_user.jpg" alt="">
                    </div>
                    <div class="details">
                        <div class="username kbold">
                            <?php echo $uname?>
                        </div>
                        <div class="postDate kregular">
                            <?php echo $date?>
                        </div>
                    </div>
                </div>
                <div class="commentText kregular">
                    This post is amazing
                </div>
                <hr>
            </div> -->

            <?php
                $sql = "
                    select * from comment C,user U where C.uid=U.id and C.pid=$post
                ";
                if ($data = $mysqli->query($sql)) {
                    if ($data->num_rows < 1) {
                        ?>
                        <div class="kregular">
                            No comment found
                        </div>
                        <?php
                    }else{
                        while($row=$data->fetch_assoc()){
                            ?>
                                <div class="comment">
                                    <div class="userdetail">
                                        <div class="userimg">
                                                <img src="
                                                <?php echo $row['img']?>
                                                " alt="">
                                        </div>
                                        <div class="details">
                                            <div class="username kbold">
                                                <?php echo $row['uname']?>
                                            </div>
                                            <div class="postDate kregular">
                                                <?php echo $row['date']?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="commentText kregular">
                                        <?php echo $row['comment']?>
                                    </div>
                                    <hr>
                                </div>
                            <?php
                        }
                    }
                }
            
            ?>
        </div>
        
    </div>
    

                    <?php
                }else{
                    ?>
                    <div class="kbold heading">
                        404 . Post not found
                    </div>
                    <?php
                }
            }
        }else{
            header('location: ./home.php?home');
        }
    
    ?>
</section>



<!-- <div class="postHead">
        <div class="maindetails">
            <div class="userimg">
                <img src="./img/user/default_user.jpg" alt="">
            </div>
            <div class="details">
                <div class="username kbold">
                    Maneesh Pandey
                </div>
                <div class="postDate kregular">
                    20 July, 2022
                </div>
            </div>
        </div>
        <div class="right klight">
            Listen <ion-icon name="play-circle-outline"></ion-icon>
        </div>
    </div>

    <div class="heading kbold mt50">
        This is heading
    </div>
    <div class="postbody kregular mt10">
        This is post body
    </div> -->