<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        
        if (password_verify($_POST["password"], $user["password_hash"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["id"];
            
            header("Location: index.php");
            exit;
        }
    }
    
    $is_invalid = true;
}

?>
<html lang=en>
    <head>
        <meta charset="UTF-8">
        <title> Login </title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.win.css"/>
     </head>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=poppins:wght@400;600&display=swap');
*{
    margin:0 ;
    padding: 0;
    box-sizing: border-box;
    font-family: "poppins", sans-serif;
}
body{
    /* background: #dfe9f5; */
    background-size:cover;
    background-repeat: no-repeat;
}
.wrapper
{
    width:330px;
    padding: 2rem 1rem;
    margin: 50px auto;
    /* background-color : #fff; */
    border-radius: 10px;
    text-align : center;
    box-shadow: 0 20px 35px rgba(0,0,0,0.1); 
}
.h1{
    font-size : 2rem;
    color: #07001f;
    margin-bottom : 1.2rem;
    margin: 0 auto;
    display:flex;
    justify-content: center;

}
form input{
    width: 92%;
    outline:none;
    border:1px solid #fff;
    padding: 12px 20px;
    margin-bottom: 10px;
    border-radius: 20px;
     /* background: #e4e4e4; */
} 
button{
    font-size:1rem;
    margin-top: 1.8rem;
    padding:10px 0;
    outline : none;
    border: none;
    width:90%;
    color:#fff;
    cursor :pointer;
    background : rgb(17, 107, 143);
}
button:hover{
    background: rgb(17, 107, 143,0.877);
}
input:focus{
    border:1px solid rgb(192,192,192);
}
.terms
{
    margin-top:0.2rem;
}
.terms input{
    height :1em;
    width:1em;
    vertical-align: middle;
    cursor : pointer;
}
.terms label
{
  font-size:0.7rem;
}
.terms a{
    color:rgb(17,107,143);
    text-decoration: none;
}
.member
{
    font-size:0.8rem;
    margin-top:1.4rem;
    color:#636363;
}
.member a{
    color:rgb(17, 107, 143);
    text-decoration: none;
}
		.left {
			float: left;
			margin-right: 20px;
            background-position: 0%;
		}
		.right {
			float: right;
			margin-left: 20px;
		}
	</style>
<body background="https://c4.wallpaperflare.com/wallpaper/828/157/129/winnie-the-pooh-and-piglet-disney-cartoon-honey-pot-hd-desktop-wallpaper-free-download-2560%C3%971600-wallpaper-preview.jpg">
</body>
<p class="h1"> Login </p>
    <?php if ($is_invalid): ?>
        <em>Invalid login</em>
    <?php endif; ?>
    <div class="wrapper">
    <form method="post">
        <label for="email">email</label>
        <input type="email" name="email" id="email"
               value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
        
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        
        <button><a href ="intro.html">Log in</a> </button>
    </form>
    </div>
    
</body>
</html>