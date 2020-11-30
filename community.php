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

	$sql="select * from articles left join users on articles.author_id=users.u_id order by a_id desc";
	$result=mysqli_query($conn,$sql);
	$a_id_list=array();
	$title_list=array();
	$author_list=array();
	$created_list=array();

	while($row=mysqli_fetch_array($result)){
		$escaped_a_id=htmlspecialchars($row['a_id']);
		array_push($a_id_list,$escaped_a_id);           //id값으로 인덱싱할 때 필요
		
		$escaped_title=htmlspecialchars($row['title']);
		array_push($title_list,$escaped_title);
		
		$escaped_author=htmlspecialchars($row['nickname']);
		array_push($author_list,$escaped_author);
		
		$escaped_created=htmlspecialchars($row['created']);
		array_push($created_list,$escaped_created);
	}

	$article_component=array($a_id_list, $title_list, $author_list, $created_list);
	$article_list='';

	for($i=0;$i<count($a_id_list);$i++){
		$ni=count($a_id_list)-$i;             //반복문으로 인덱싱
		$article_list=$article_list."
			<tr>
				<td>{$ni}</td>
				<td><a href='view.php?id={$a_id_list[$i]}'>{$article_component[1][$i]}</a></td>
				<td>{$article_component[2][$i]}</td>
				<td>{$article_component[3][$i]}</td>
				<td>조회수</td>
			</tr>
		";
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
	<script src="https://kit.fontawesome.com/b8f1cadba4.js" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="http://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<style>
		.title, .article_list h3{
			text-align:center;
		}
        .article-list{
            margin: 0 auto;
        }
        .article-list thead th{
            border-top:2px solid #09C;
	        border-bottom:1px solid #CCC;
            height:40px;
            font-size:17px;
        }
        .article-list tbody td{
            padding:10px 0;
            text-align:center;
            border-bottom:1px solid #CCC;
            /* height:20px; */
            font-size: 14px;
		}
		.write_link{
			text-align:right;
		}
		.write_link a{
			margin-right:110px;
			padding: 10px 20px;
			color:#000;
			font-size:16px;
			transition:0.2s;
		}
        .write_link a:hover{
			margin-right:110px;
			padding: 10px 20px;
			color:#000;
			background-color:rgb(104, 205, 255);
			border-radius:10px;
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
				<div class="headerloginmenu" style="vertical-align:bottom;">
					<?=$status?>
				</div>
			</div><hr>
		</header><!-- //header -->
		<main>
            <div class="container">
				<h2 class="title">게시판</h2>
                <table class="article-list">
                    <thead>
                        <tr>
                            <th width="70">번호</th>
                            <th width="500">제목</th>
                            <th width="120">글쓴이</th>
                            <th width="200">작성일</th>
                            <th width="100">조회수</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?=$article_list?>
                    </tbody>
                </table>
                <p class="write_link"><a href="write.php">글쓰기</a></p>
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