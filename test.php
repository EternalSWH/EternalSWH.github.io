<?php
if($_GET["flag"]==1) {
    $text = file_get_contents("data.json");
    $arr = json_decode($text, true);
    $new = array_slice($arr, $_GET["index"], 3);
    echo json_encode($new);
}
if($_GET["flag"]==2) {
    $text = file_get_contents("data.json");
    $arr = json_decode($text, true);
    array_unshift($arr, $_GET);
    file_put_contents("data.json", json_encode($arr));
}
if($_GET["flag"]==3){
    $text = file_get_contents("data.json");
    $arr = json_decode($text, true);
    echo count($arr);
}
if($_GET["flag"]==4){
    $sign=$_GET["sign"];
    $text = file_get_contents("data.json");
    $arr = json_decode($text, true);
     for($i=0;$i<count($arr);$i++){
        if($sign==$arr[$i]['sign']){
            if($_GET["flag1"]==1){
                $arr[$i]['upNum']=$arr[$i]['upNum']+1;
            }else{
                $arr[$i]['downNum']=$arr[$i]['downNum']+1;
            }
            break;
        }
    }
    file_put_contents("data.json", json_encode($arr));
}
if($_GET["flag"]==5){
    $sign=$_GET["sign"];
    $text = file_get_contents("data.json");
    $arr = json_decode($text, true);
    for($i=0;$i<count($arr);$i++){
        if($sign==$arr[$i]['sign']){
            array_splice($arr,$i,1);
//            unset($arr[$i]);
            break;
        }
    }
    file_put_contents("data.json", json_encode($arr));
}
?>