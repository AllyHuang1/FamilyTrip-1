<?php
//指定網頁的中文格式
header("Content-type: text/html; charset=utf-8");
//連接資料庫
$user = "root"; //資料庫帳號
$password = "1234"; //資料庫密碼
$host = "127.0.0.1"; //資料庫IP
$db = "travel_db"; //資料庫名稱

$conn = mysqli_connect($host, $user, $password) or die("資料庫連線錯誤！");
//指定連線的資料庫
mysqli_select_db($conn, $db);
//指定資料庫使用的編碼
mysqli_query($conn, "SET NAMES utf8");

//自訂解碼Unicode的方法：傳入JSon格式，將其中的Unicode資料解碼回正常的中文字
function decodeUnicode($str)
{
    $func = function ($matches) {
        return mb_convert_encoding(pack("H*", $matches[1]), "UTF-8", "UCS-2BE");
    };
    return preg_replace_callback('/\\\\u([0-9a-f]{4})/i', $func, $str);
}
// $account = $_GET["account"];
// $title = $_GET['title'];
// $id = $_GET["id"];

// $table = mysqli_query($conn, "delete FROM favorite WHERE id = '" . $_GET["id"] . "'");

$table = mysqli_query($conn, "delete FROM favorite WHERE account = '" . $_GET["account"] . "' and id = '" . $_GET["id"] . "'");

//關閉資料庫連結
mysqli_close($conn);
//將資料集陣列進行json編碼
// echo json_encode($rows);