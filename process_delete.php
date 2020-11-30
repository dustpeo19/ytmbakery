<?php
include('db_info.php');

settype($_POST['id'],'integer');
$filtered=array(
    'id'=>mysqli_real_escape_string($conn,$_POST['id']),
);

$sql="
    delete from articles where a_id={$filtered['id']}
";
$result=mysqli_query($conn,$sql);

if($result===false){
    echo '삭제하는 과정에서 문제가 발생하였습니다. 관리자에게 문의해주세요.</br><a href="community.php">돌아가기</a>';
}else{
    header("Location: community.php");
}
?>