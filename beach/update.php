<?php
session_start();
require('dbconnect.php');

function h($f){
    return htmlspecialchars($f,ENT_QUOTES,'UTF-8');
}

function makeLink($v){
    return preg_replace('/(https?|ftp)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)/', '<A href="\\1\\2">\\1\\2</A>', $v);
}

//一件表示させるためのSQL
$sqls = sprintf('SELECT * from posts WHERE id=%d',
    mysqli_real_escape_string($db,$_GET['id']));
$result = mysqli_query($db, $sqls) or die(mysqli_error($db));
$row = mysqli_fetch_array($result);


if(isset($_GET['id'])){
    $sqls = sprintf('SELECT * from categories where type_id = 2');
    $result = mysqli_query($db, $sqls) or die(mysqli_error($db));
    $table = mysqli_fetch_array($result);
}
        if(isset($_POST['title'])){
        //画像を送る際に一度$_FILESに入れる必要がある
        $image = date('YmdHis').$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'],'../images/'.$image);
    }

//更新している
if(!empty($_POST)){
    //print_r($_POST);exit;
    if($_GET['id'] > 0){//POSTのidが空でないかどうかを確認する
        $sql = sprintf('UPDATE posts SET title="%s",body="%s",image="%s",modified=NOW() WHERE id=%d',
            mysqli_real_escape_string($db,$_POST['title']),
            mysqli_real_escape_string($db,$_POST['body']),
            mysqli_real_escape_string($db,$_POST['image']),
            mysqli_real_escape_string($db,$_GET['id']));

            mysqli_query($db,$sql) or die(mysqli_error($db));

            //これすることによって再読込ボタンを押したことによる、二重投稿を防止している。
            header('Location:beach.php');
            exit();
    
}

$sql = 'SELECT * FROM posts WHERE del_flg=0';

}
?>

<!DOCTYPE html>
<html lang="ja">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DoDo</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/grayscale.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">


    <script type="text/javascript">
    <!--

    function disp(){

        // 「OK」時の処理開始 ＋ 確認ダイアログの表示
        if(window.confirm('削除しますか？')){
            location.href = "delete.php?id=<?php print($_GET["id"]); ?>"; // example_confirm.html へジャンプ
        }
    }

    // -->
    </script>

</head>

<body　id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">
                    <i class="fa fa-play-circle"></i>  <span class="light">TOP
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#about">Menu</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Intro Header -->
    <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h1 class="brand-heading">DoDo</h1>
                        <p class="intro-text"></p>
                        <a href="#about" class="btn btn-circle page-scroll">
                            <i class="fa fa-angle-double-down animated"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    
 <form method="post" action="" class="anna">
 <div class="container text-center">
 <h1>編集</h1>
 <center>
 <select name="category_id" value="">
            <?php while ($datas = mysqli_fetch_array($result)):?>
            <!--バリューの中にデータを入れてあげる-->
            <option value="<?php $datas['id'];?>"><?php echo $datas['category_name'];?></div></option>
            <?php endwhile;?>
</select>
 <div><br><input type="file" name="image" size="35" /><br></div>
<p>
<input type="text" name="title" size="50" value="<?php print $row['title']; ?>" />
</p>
<!--テキストエリアを使う時は文字としていれる（valueは使用しない）-->
 <textarea name="body" cols="70" rows="6"><?php print $row['body']; ?></textarea>
 <p>
 <input type="submit" class="btn btn-danger" value="更新" />　
 <input type="button" class="btn btn-danger" value="削除" onclick="disp()"/>
 <input type="button" class="btn btn-default" value="戻る" onclick="history.back()">
 </p>
</div>
</div>
</center>
 </form>
</div>

      <!-- Footer -->
    <footer style="background-color:#0ab7f0;color:#f9eb0a;">
        <div class="container text-center">
            <p>Copyright &copy; geechs 6th 2015</p>
        </div>
    </footer>

<!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>

    <!-- Google Maps API Key - Use your own API key to enable the map feature. More information on the Google Maps API can be found at https://developers.google.com/maps/ -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRngKslUGJTlibkQ3FkfTxj3Xss1UlZDA&sensor=false"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/grayscale.js"></script>
</body>

</html>