<?php
session_start();
include('db_info.php');

$filtered=array(
    'id'=>mysqli_real_escape_string($conn,$_POST['login_id']),
    'pw'=>mysqli_real_escape_string($conn,$_POST['login_pw'])
);

$sql="select * from users where userid='{$filtered['id']}'";
$result=mysqli_query($conn,$sql);

if(mysqli_num_rows($result)==1){
    $row=mysqli_fetch_array($result);

    if($row['password']===$filtered['pw']){
        $_SESSION['u_id']=$row['u_id'];
        $_SESSION['userid']=$row['userid'];

        if(isset($_SESSION['userid'])){
?>
<script>
    history.go(-2);
</script>
<?php
        }else{
            echo('session failed');
        }
    }else{
?>
<script>
        alert("아이디 또는 비밀번호를 다시 확인하세요.");
        history.back();
</script>
<?php
    }
}else{
?>
<script>
    alert("아이디 또는 비밀번호를 다시 확인하세요.");
    history.back();
</script>
<?php
}
?>