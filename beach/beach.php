<?php
session_start();
require('dbconnect.php');

function h($f){
    return htmlspecialchars($f,ENT_QUOTES,'UTF-8');
}

//一覧表示させるためのSQL
$sqls = sprintf('SELECT * from categories where type_id = 2');
$result = mysqli_query($db, $sqls) or die(mysqli_error($db));

//カテゴリー一覧のためのSQL
$sq = sprintf('SELECT * from categories where type_id = 2');
$anna = mysqli_query($db, $sq) or die(mysqli_error($db));

//内部結合
//２つのテーブルをつなげる時に使うSELECT文
$sql = 'SELECT p.id,p.title,p.body,c.category_name,p.modified  FROM posts p INNER JOIN categories c ON p.category_id = c.id WHERE p.type_id = 2';
$ichiran = mysqli_query($db, $sql) or die(mysqli_error($db));

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

 <div>
    <h1>一覧</h1>
    <h5><a href="index.php">投稿</a></h5>
    <!--　一覧表示させる方法　-->
    <?php while ($row = mysqli_fetch_array($ichiran)):?>
    <p>
    タイトル：<a href="view.php?id=<?php echo $row['id'];?>"><?php print $row['title']; ?></a><br>
    内容：<?php print $row['body']; ?><br>
    カテゴリー：<?php print $row['category_name']; ?><br>
    更新日時：<?php print $row['modified']; ?><br>
    <hr><!--線をいれる-->
    </p>
    <?php endwhile;?>

 </div>

 <div>
    <h1>カテゴリー</h1>
    <!--　カテゴリ一覧表示させる方法　-->
    <?php while ($an = mysqli_fetch_array($anna)):?>
    <?php echo $an['category_name']; ?><br>
    <?php endwhile;?>
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