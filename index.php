<div id="toast" class="kmedium">This is toast</div>

<?php
    session_start();
    require './linkServices.php';
    if (isLoggedIn()) {
        header('location: ./home.php?home');
    }
    // Check if input is given
    if (isset($_POST['isFormSubmitted'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        if ($name == "" || $email == "" || $password == "") {
            showError('Required field not filled properly');
        }else{
            try {
                $password = password_hash($password,PASSWORD_DEFAULT);
                $sql = "insert into user(name,email,password,img) 
                values('$name','$email','$password','./img/user/default_user.jpg')";
                if ($mysqli->query($sql)) {
                    $msg = "Signup successful. Please login to continue.";
                    header("location: ./login.php?msg=$msg");
                }
            } catch (Exception $e) {
                $errmsg = $e->getMessage();
                if(explode(' ',$errmsg)[0] == "Duplicate"){
                    $errmsg = "The email you are trying to signup with already exists";
                }
                $errmsg = "Signup Failed. ".$errmsg;
                showError($errmsg);
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup To continue</title>
    <link rel="stylesheet" href="./css/signup.css">
</head>
<body>
    <main>
        <section class="center row">
            <section class="quoteSection">
                <div id="quote" class="quote mbold">
                    An apple a day keeps the doctor away.
                </div>

                <div id="author" class="author mmedium">
                    Manish Pandey
                </div>
            </section>
            <section class="loginSection">
                <div class="formHeading kbold">
                    Create an account
                </div>
                <div class="formSubHeading kmedium">
                    A warm welcome to <b>Unfold</b>
                </div>
                <div class="form-group">
                    <form autocomplete="off" action="#" method="post">
                        <div class="input-group">
                            <input required name="name" type="text" placeholder="Name">
                        </div>
                        <div class="input-group">
                            <input required name="email" type="text" placeholder="Email">
                        </div>
                        <div class="input-group">
                            <input required name="password" id="password" type="password" placeholder="Password">
                        </div>
                        <div class="input-group">
                            <input required name="retypePwd" id="retypePassword" type="password" placeholder="Confirm Password">
                        </div>
                        <input type="hidden" name="isFormSubmitted" value ="1">
                        <div class="input-group">
                            <button id="signupBtn" name="signup" class="signupbtn kmedium" type="submit">
                                Create Account
                            </button>
                        </div>
                    </form>
                    <div class="formSubHeading kmedium mt20">
                        Already have an account? <a href="./login.php">
                            Login Here
                        </a>
                    </div>
                </div>
            </section>
        </section>
    </main>
</body>
<script src="./js/main.js"></script>
</html>

<?php
    function showError($err){
        ?> 
            <script>
                toast = document.querySelector("#toast");
                toast.textContent = '<?php echo $err?>';
                toast.style.display = 'block';
                setTimeout(() => {
                    toast.style.display = 'none';
                }, 4000);
            </script>
        <?php
    }
?>