<?php
    SESSION_start();
    include('db_info.php');

    $filtered=array(
        'title'=>mysqli_real_escape_string($conn,$_POST['title']),
        'description'=>mysqli_real_escape_string($conn,$_POST['description'])
    );

    if(isset($_SESSION['u_id'])){
        $filtered['author_id']=mysqli_real_escape_string($conn,$_SESSION['u_id']);
    }else{
        $filtered['author_id']=1;
    }

    $sql="
        insert into articles(title,description,created,author_id)
        values(
            '{$filtered['title']}',
            '{$filtered['description']}',
            now(),
            '{$filtered['author_id']}'
        )
    ";

    $result=mysqli_query($conn,$sql);

    if($result===false){
        echo '저장하는 과정에서 문제가 발생하였습니다. 관리자에게 문의해주세요.';
    }else{
        header("Location: community.php");
    }
?>