<?php
include('db_info.php');

$filtered=array(
    'userid'=>mysqli_real_escape_string($conn,$_POST['userid']),
    'nickname'=>mysqli_real_escape_string($conn,$_POST['nickname']),
    'password'=>mysqli_real_escape_string($conn,$_POST['password'])
);

$sql="
    insert into users(userid,nickname,password)
    values(
        '{$filtered['userid']}',
        '{$filtered['nickname']}',
        '{$filtered['password']}'
    )
";

$result=mysqli_query($conn,$sql);

if($result===false){
    echo '회원가입 과정에서 문제가 발생하였습니다. 관리자에게 문의해주세요.';
}else{
?>
<script>
    alert("영떵민 베이커리에 가입하신 것을 축하드립니다!");
    history.go(-2);
</script>
<?php
}
?>