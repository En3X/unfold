<section class="selfprofile">
    <div class="introSection">
        <div class="profileimage" id="pp">
            <img src="<?php echo $user->img?>" alt="">
        </div>
        <div class="name mt10 kbold">
            <?php echo $user->name?>
        </div>
        <div class="editBtn kmedium">
            Edit
        </div>
    </div>
    <div class="detailsSection">
        <div class="detailtab">
            <div class="numOfDetail kbold">
                0
            </div>
            <div class="detailName kregular">
                Posts
            </div>
        </div>
        <div class="separator"></div>
        <div class="detailtab">
            <div class="numOfDetail kbold">
                0
            </div>
            <div class="detailName kregular">
                Comments
            </div>
        </div>
        <div class="separator"></div>

        <div class="detailtab">
            <div class="numOfDetail kbold">
                0
            </div>
            <div class="detailName kregular">
                Likes
            </div>
        </div>
    </div>
    <div class="description">
        <div class="kbold sectionheading">
            About me
        </div>
        <div class="kregular">
            <?php
                if ($user->description == "" || 
                $user->description === null
                ) {
                    echo "No user description found. You can add description from your profile settings.";
                }else{
                    echo $user->description;
                }
            ?>
        </div>
    </div>
    
    <div class="description">
        <div class="kbold sectionheading">
            Posts by me
        </div>
        <div class="kregular">
            You do not have any posts as of now. Create a post from the <b>Create post</b> button below.
        </div>
    </div>

    <div id="modalOpener" class="createPostBtn kbold mt20">
        Create Post
    </div>
</section>
<script>
    document.querySelector("#modalOpener").addEventListener('click',()=>{
        document.querySelector("#createPostModal").classList.remove('hide');
    })

</script>


<section id="createPostModal" class="modal hide">
    <div class="modalContainer">
        <div class="modalHead">
            <div class="modalTitle kbold">
                Create new post
            </div>
            <div id="closeThisModal" class="close">
                <ion-icon name="close-outline"></ion-icon>
            </div>
        </div>
        <div class="modalBody mt20">
            <form autocomplete="off" method="post" action="makePost.php">
                <div class="input-group">
                    <input required type="text" class="kmedium" id="posttitle" name="postTitle" placeholder="Post Title">
                </div>
                <div class="input-group">
                    <textarea required
                    placeholder="Post body" class="kmedium"
                    name="postBody" id="postBody"></textarea>
                </div>
                <div class="input-group">
                    <div id="tagSection"></div>
                    <input type="text" class="kmedium" id="posttag" name="tags" placeholder="Tags">
                </div>
                <input type="hidden" id="finalTags" name="finalTags">
                <input type="hidden" name="isPostMade" value=1>
                <button type="button" id="decoySubmit" class="editBtn kmedium">
                    Post
                </button>
                <button type="submit" id="makePost"></button>
            </form>
        </div>
    </div>
</section>

<script src="./js/tagManager.js"></script>

<script>
    document.querySelector("#closeThisModal").addEventListener('click',()=>{
        document.querySelector("#createPostModal").classList.add('hide');
    })
    
</script>