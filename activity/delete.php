<?php
session_start();
require('dbconnect.php');

function h($f){
    return htmlspecialchars($f,ENT_QUOTES,'UTF-8');
}

//論理削除の場合UPDATE
//anketo の中のdel_flg=1　を１に変えるという文章
//$sql = sprintf('UPDATE posts SET del_flg=1 WHERE id=%d' , $_GET['id']);

$sql = sprintf('DELETE FROM posts WHERE id=%d' , $_GET['id']);
mysqli_query($db,$sql);
header('Location: delete.php');

?>