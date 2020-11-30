<?php
session_start();
include('db_info.php');

if(empty($_SESSION['userid'])){
	header("Location: login.html");
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>글쓰기 : 영떵민 베이커리</title>
    <meta name="keywords" content="빵, 베이커리, bread, bakery"/>
	<meta name="description" content="영떵민 베이커리"/>
	<meta name="robots" content="all"/>
	<link rel="stylesheet" href="https://cdn.rawgit.com/moonspam/NanumSquare/master/nanumsquare.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/5.3.1/css/font-awesome.min.css">
	<link rel="shortcut icon" type="image/x-icon" href="image/favicon.ico"/>
	<link rel="stylesheet" href="css/main.css">
	<script src="https://kit.fontawesome.com/b8f1cadba4.js" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="http://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
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
					<p><a href="login.html">로그인</a></p>
					<p><a href="join.php">회원가입</a></p>
				</div>
			</div>
        </header><!-- //header -->
        <main>
            <div class="container">
				<form action="process_create.php" method="post">
					<h1>글쓰기</h1>
					<p>
						<input type="text" name="title" placeholder="제목을 입력하세요">
					</p>
					<p>
						<textarea name="description" cols="100" rows="10" placeholder="공유하고 싶은 내용을 작성해주세요"></textarea>
					</p>
					<p>
						<input type="submit" value="작성하기">
					</p>
				</form>
				<p>
					<a href="community.php">목록으로</a>
				</p>
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
				<div>
					<a id="back-to-top" href="#">TOP</a>
				</div>
			</div>
		</footer><!-- //footer -->

    </div>
</body>
</html>