<?php
include('db_info.php');

settype($_POST['id'],'integer');
$filtered=array(
    'id'=>mysqli_real_escape_string($conn,$_POST['id']),
    'title'=>mysqli_real_escape_string($conn,$_POST['title']),
    'description'=>mysqli_real_escape_string($conn,$_POST['description'])
);

$sql="
    update articles set
        title='{$filtered['title']}',
        description='{$filtered['description']}'
    where
        a_id='{$filtered['id']}'
";

$result=mysqli_query($conn,$sql);
if($result===false){
    echo '저장하는 과정에서 문제가 발생하였습니다. 관리자에게 문의해주세요.';
}else{
    header("Location: view.php?id=".$filtered['id']);
}
?>