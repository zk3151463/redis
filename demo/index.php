<?php
//var_dump($_post);
//echo time();
//die;
$nid="1";
//$con = mysql_connect("localhost","root","root");
   $conn=mysqli_connect("localhost", "root","root");
if (!$conn)
  {
  die('Could not connect: ' . mysqli_error());
  }
$conn->query("use liaotian ");
if($_POST){
     $jilu=$_POST["id"];
    //$jilu=$nid.$jilu.time();
    $redis = new Redis();
    $redis->connect('127.0.0.1',6379);
    $z=rand(0, 9);
    $redis->zAdd('uid',time().$z,$nid.time().$z);

    $redis->zAdd('jilu',time().$z,$jilu.time().$z);
//$e=$redis->zScore('jilu',"*");
//var_dump($e);
  //  $xjilu=$redis->zRange('jilu', 0, -1,true);
   // $xjilu= $redis->smembers("id");
   // var_dump($xjilu);
   // echo $xjilu["1kkkjh1489313977"];
   // die;
}
//die;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>聊天界面</title>
</head>
<body>
<div style="width:100%;height:100%">
    <div id="jiluzhi">


    <table border="1" width="100%" height="100%" style="bottom: 100px;">
        <thead>
            <tr>
                <th colspan="2" align="center" style="height:20%"  >聊天界面</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $redis = new Redis();
            $redis->connect('127.0.0.1',6379);

           $xjilu=$redis->zRange('jilu', 0, -1,true);

            foreach ($xjilu as $key => $value) {
                if(time()-substr($value, 0, -1)>600){
                    $redis->zDelete('jilu', $key);
                }
        ?>


            <tr>

                <td width="10%">name:</td>
                <td><?php echo substr($key, 0, -11) ?></td>
            </tr>
            <tr> <td colspan="2" align="right"><?php echo @date("Y-m-d H:i:s",substr($value, 0, -1) ) ?></td></tr>
            <?php
        }
            ?>
        </tbody>

    </table>
      </div>
    <form action="http://127.0.0.1/redis/demo/index.php" method="POST" >
       <input type="text" name="id"  style="width:90%;height:50px">
       <input  style="width:8.5%;height:52px" type="submit" value="发送">
    </form>
</div>
</body>
</html>
