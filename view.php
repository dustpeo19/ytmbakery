<?php
	SESSION_start();
	include('db_info.php');

	if(isset($_SESSION['userid'])){
		$sql_login="select * from users where userid='{$_SESSION['userid']}'";
		$result_login=mysqli_query($conn,$sql_login);
		$row_login=mysqli_fetch_array($result_login);

		$status="
			<p style='margin:5px 0;'>{$row_login['nickname']}님 환영합니다!</p>
			<p style='margin:0;'><a href='process_logout.php'>로그아웃</a></p>
		";
	}else{
		$status='
			<span><a href="login.html">로그인</a></span>
			<span><a href="join.php">회원가입</a></span>
		';
	}

	//목록부분
	$sql="select * from articles";
	$result=mysqli_query($conn,$sql);
	$list='';
	while($row=mysqli_fetch_array($result)){
		$escaped_title=htmlspecialchars($row['title']);
		$list=$list."<li><a href=\"view.php?id={$row['a_id']}\">{$escaped_title}</a></li>";
	}

	//글부분
	$article=array(
		'title'=>'게시글을 작성해주세요.',
		'description'=>'본문이 여기에 표시됩니다.',
		'author'=>'작성자가 여기에 표시됩니다.'
	);
	$update_link='';
	$delete_link='';

	if(isset($_GET['id'])){
		$filtered_id=mysqli_real_escape_string($conn,$_GET['id']);
		$sql="select * from articles left join users on articles.author_id=users.u_id where a_id={$filtered_id};";
		$result=mysqli_query($conn,$sql);
		$row=mysqli_fetch_array($result);
		$article['title']=htmlspecialchars($row['title']);
		$article['description']=htmlspecialchars($row['description']);
		$article['author']='작성자: '.htmlspecialchars($row['nickname']);

		if($row_login['u_id']===$row['author_id']){
			$update_link='<a href="update.php?id='.$_GET['id'].'">수정하기</a>';
			$delete_link='
				<form action="process_delete.php" method="post">
					<input type="hidden" name="id" value="'.$_GET['id'].'">
					<input type="submit" class="delete_button" value="삭제하기">
				</form>
			';
		}
	}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판 : 영떵민 베이커리</title>
    <meta name="keywords" content="빵, 베이커리, bread, bakery"/>
	<meta name="description" content="영떵민 베이커리"/>
	<meta name="robots" content="all"/>
	<link rel="stylesheet" href="https://cdn.rawgit.com/moonspam/NanumSquare/master/nanumsquare.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/5.3.1/css/font-awesome.min.css">
	<link rel="shortcut icon" type="image/x-icon" href="image/favicon.ico"/>
	<link rel="stylesheet" href="css/main.css">
	<script src="https://kit.fontawesome.com/50d723c333.js" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="http://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<style>
		.title, .article_list h3{
			text-align:center;
		}
		article{
			background-color:beige;
			border: 3px solid burlywood;
			padding:0 20px;
		}
		.article_title{
			border-bottom:2px solid black;
			padding:10px;
		}
		.article_description, .article_author{
			padding:10px;
		}
		.article_menu{
			text-align:right;
		}
		.delete_button{
			font-size=20px;
		}
	</style>
</head>
<body>
	<div id="wrapper">
		<header>
			<div class="headerwrap">
				<div class="headerlogo">
					<a href="index.html">
						<img src="image/logo/영떵민베이커리.png" alt="ytm's bakery" class="logo"/>
					</a>
				</div>
				<div class="headernav">
					<ul class="headermenu">
						<li>
							<a href="menu.html" name="tabs-1">메뉴</a>
							<!-- <div id="tabs-1" name="tabs-1">
								<p>BREAD & CAKE</p>
								<p>COFFEE & BEVERAGES</p>
							</div> -->
						</li>
						<li>
							<a href="event.html" name="tabs-2">이벤트</a>
							<!-- <div id="tabs-2" name="tabs-2">
								<p>현재 이벤트</p>
								<p>이벤트 결과</p>
							</div> -->
						</li>
						<li>
							<a href="notice.html" name="tabs-3">소식</a>
							<!-- <div id="tabs-3" name="tabs-3">
								<p>신메뉴 개발</p>
								<p>주문안내</p>
							</div> -->
						</li>
						<li>
							<a href="community.php" name="tabs-4">게시판</a>
						</li>
					</ul>
				</div>
				<div class="headerloginmenu">
					<?=$status?>
				</div>
			</div><hr>
		</header><!-- //header -->
		<main>
            <div class="container">
				<h2 class="title">게시판</h2>
				<article>
					<div class="article_title">
						<?=$article['title']?>
					</div>
					<div class="article_description">
						<?=$article['description']?>
					</div>
					<div class="article_author">
						<?=$article['author']?>
					</div>
				</article>
				<p class="article_menu">
					<a href="write.php">글쓰기</a>
					<?=$update_link?>
					<?=$delete_link?>
					<a href="community.php">목록으로</a>
				</p>
				<div class="article_list">
					<h3>목록</h3>
					<ol><?=$list?></ol>
				</div>
            </div>
		</main>
		<footer>
			<div class="footerwrap">
				<div class="footernav">
					<ul class="footermenu">
						<li><a href="company.html">베이커리 소개</a></li>
						<li><a href="document.html">자료실</a></li>
						<li><a href="customer.html">고객센터</a></li>
						<li><a href="recruit.html">직원 모집</a></li>
						<li><a href="franchise.html">가맹점 문의</a></li>
						<li><a href="agreement.html">이용약관</a></li>
					</ul>
				</div>
				<div class="footeretc">
					<div>
						<img src="image/logo/영떵민베이커리.png" alt="" width="300px">
					</div>
					<address>
						ytmbakery@gmail.com<br>
						&copy; Copyright 2020. 영떵민 베이커리. All rights reserved.
					</address>
				</div>
			</div>
		</footer><!-- //footer -->
	</div>
	<script src="js/back-to-top.js"></script>
	<script src="js/menutab.js"></script>
</body>
</html>