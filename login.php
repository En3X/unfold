<div id="toast" class="kmedium">This is toast</div>

<?php
    session_start();
    require './linkServices.php';
    if (isLoggedIn()) {
        header('location: ./home.php');
    }
    // Check if login is clicked

    if (isset($_GET['msg'])) {
        if ($_GET['msg'] !== "") {
            showError($_GET['msg']);
        }
    }
  
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to continue</title>
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
                    Welcome back
                </div>
                <div class="formSubHeading kmedium">
                    Login to your account and get started
                </div>

                <?php
                    if (isset($_POST['login']) && isset($_POST['isFormSubmitted'])) {
                        $email = $_POST['email'];
                        $password = $_POST['password'];
                        if ($email=="" || $password == "") {
                            alert("Required field not filled properly.");
                        }else{
                            $sql = "Select * from user where email='$email'";
                            if ($data = $mysqli->query($sql)) {
                                if ($data->num_rows < 1) {
                                    alert('Email does not exists.');
                                }else{
                                    while($row=$data->fetch_assoc()){
                                        $id = $row['uid'];
                                        $email = $row['email'];
                                        $pwd = $row['password'];
                                        $name = $row['name'];
                                        $discription = $row['discription'];
                                        $img = $row['img'];
                                        if (password_verify($password,$pwd)) {
                                            $user = new User($id,$name,$email,$pwd,$dis,$img);
                                            $_SESSION['user'] = serialize($user);
                                            $_SESSION['isLoggedIn'] = true;
                                            header('location: ./home.php');

                                        }else{
                                            alert('Password for given email is incorrect.');
                                        }
                                    }
                                }
                            }
                        }

                    }
                ?>

                <div class="form-group">
                    <form autocomplete="off" action="./login.php" method="post">
                        <div class="input-group">
                            <input  name="email" type="text" placeholder="Email">
                        </div>
                        <div class="input-group">
                            <input  name="password" id="password" type="password" placeholder="Password">
                        </div>
                    
                        <input type="hidden" name="isFormSubmitted" value ="1">
                        <div class="input-group">
                            <button id="signupBtn" name="login" class="signupbtn kmedium" type="submit">
                                Login to your account
                            </button>
                        </div>
                    </form>
                    <div class="formSubHeading kmedium mt20">
                        Already have an account? <a href="./index.php">
                            Signup Here
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


    function alert($msg){
        ?>
        <div class="alert alert-danger kmedium">
            <?php echo $msg?>
        </div>
        <?php
    }
?>