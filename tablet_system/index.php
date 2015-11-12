<?php
require_once 'HTML.php';
$minify = new Minify_HTML();


//textareaよりコードを取得し、出力する。
$html_single_quotation = str_replace('"', "'", $_POST['html']);
$html = $minify->minify($html_single_quotation);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.18.1/build/cssreset/cssreset-min.css"><!--cssreset-->
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<title>メイツ教科書</title>
</head>

<body>

	<!--header-->
	<header>
		<div class="header_inner">
		<div class="clearfix">
			<h1><img src="images/header_logo.png" id="header_logo"></h1>
			<div class="howto"><p>ボタンを押すと上のキャンバスに表示されるよ！</p></div>
		</div>
		</div>
	</header>

	<!--contents-->
	<div class="wrapper">



		<!--run_area-->
		<div id ="run_area">

				<!--実行エリア-->
				<iframe id='iframe' srcdoc="<?php echo $html;?>"></iframe>

				<form action="" method="post" id="html_run">

				<!--HTML記入エリア-->

					<!--以下textarea内がコード記入となります-->
					<div class="clearfix">
						<textarea cols="90" rows="7" name="html" placeholder="HTML/CSSを記入" id="html_code" class="html_code"><?php echo $_POST['html'] ?></textarea>


						<!--HTML出力ボタン-->
						<input type="submit" value="描く" class="run_button button">
					</div>

				<!--JavaScript記入エリア-->

					<!--以下textarea内がコード記入となります-->
					<div class="clearfix">
						<textarea cols="90" rows="7" name="js" id="Js_code" placeholder="Javascriptを記入"><?php echo $_POST['js'] ?></textarea>


						<!--Js出力ボタン-->
						<div class="Js_button button"><p>動かす</p></div>

					</div>

				</form>

		</div><!--text_area-->

		<!--お試しボタン-->
		<div id="btn_area">
			<div class="clearfix">
				<div class="key_left clearfix">
					<button id='smdiv' class="button smbtn">□</button>
					<button id='js' class="button smbtn">js</button>
					<button id='crdiv' class="button smbtn">div</button>
					<button id='css' class="button smbtn">CSS</button>
					

					<form action='' method='post' class="clear">
						<input type='hidden' name='html' value=''>
						<input type='hidden' name='js' value=''>
						<input type='submit' value='Clear' class="clearbtn button">
					</form>
				</div>

				<div class="key_right">
					<button id='up' class="button contlv">↑</button>
					<button id='down' class="button contlv">↓</button>
					<button id='left' class="button contlh">←</button>
					<button id='right' class="button contlh">→</button>
				</div>
			</div>
		</div>


	</div><!--contents-->
</div>



	
	<script>
	$( function() {

		$('.Js_button').click(function(){

			// clickのタイミングで毎回要素を代入する
			$iframe = $("#iframe")[0].contentWindow.document;
			$target = $('.target', $iframe);

			// Jsを実行する
			eval($('#Js_code').val());
		});

		$("#smdiv").click(function() {
	    	document.getElementById('html_code').innerHTML += '<style type="text/css">\n.target {\nwidth:30px;\nheight:30px;\nborder:1px solid black;\nposition:relative;\ntop:10px;\nleft:10px;\n}\n</style>\n<div class="target"></div>\n';
	    });
	    $("#css").click(function() {
	    	document.getElementById('html_code').innerHTML += '<style type="text/css">\n.name {\nwidth:30px;\nheight:30px;\nbackground-color:red;\n}\n</style>\n';
	    });
	    $("#crdiv").click(function() {
	    	document.getElementById('html_code').innerHTML += '<div class="name"></div>\n';
	    });
		$("#js").click(function() {
	    	document.getElementById('Js_code').innerHTML += '$target.animate({\n  top: "+=50",\n  left: "+=50"\n}, 500);';
		});

		$iframe = $("#iframe")[0].contentWindow.document;
		$target = $('.target', $iframe);

		$target.animate({
		  top: "+=50",
		  left: "+=50"
		}, 500);

		$("#up").click(function(){
			$target.animate({
			  top: "-=50"
			}, 500);
		});
		$("#down").click(function(){
			$target.animate({
			  top: "+=50"
			}, 500);
		});
		$("#left").click(function(){
			$target.animate({
			  left: "-=50"
			}, 500);
		});
		$("#right").click(function(){
			$target.animate({
			  left: "+=50"
			}, 500);
		});

		function move(){
		   $element = $('#circle', $iframe);
		   $element.style.marginTop += 300 + "px";
		   $element.style.marginTop += 300 + "px";
		}
	});


	</script>

	<!--footer-->
	<div id="footer">
		<div class="footer_inner">
			<small>Copyright (C) 2015 株式会社インフラトップ Infratop Inc. All Rights Reserved.</small>
		</div>
	</div>

</body>
</html>