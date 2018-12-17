<html>
<head>
<title> </title>
</head>
<body>

    <?php
        $user=$_SESSION['user'];
        if(!isset($user)){
    ?>

    <div class="item">
        <a class="ui primary button" href="login">
            <i class="sign in icon"></i> Login
        </a>
    </div>
    <?php } else { ?>
        <div class="item button" onclick="location.href='logout'">
        
        <div class="ui header">
                <i class="user circle icon"></i>
                <div class="content">
                <?php 
                    echo $_SESSION['user'] 
                    ?>
                <div class="sub header">Logout</div>
            </div>
        </div>
        </div>
    <?php
        }
    ?>
</body>
<html>