<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="description" content="Soccer League">
		<meta name="keywords" content="">
		<meta name="author" content="SoftIXX">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<!-- Mobile Specific Meta Tag-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">		
		<!-- TITLE PATTERN -->
		<title>CIS - Clinical Information System</title>
		<!-- Favicon  -->
    	<link rel="icon" href="assets/src/favicon/fav.png" />
    	<!-- Coming Soon CSS-->
		<link rel="stylesheet" media="screen" href="assets/css/coming-soon.css" />
		<!-- END -->
	</head>
	<body style="text-align: center">
		<img src="assets/src/comingsoon/comingsoon.png" alt="">
		<ul id="suffle">
			<li>
				<a href="#">
					<img id="slide-1" class="opaque" src="assets/src/comingsoon/sfondo_1.jpg" alt="">
				</a>
			</li>
			<li>
				<a href="#">
					<img id="slide-2" src="assets/src/comingsoon/sfondo_2.jpg" alt="">
				</a>
			</li>
			<li>
				<a href="#">
					<img id="slide-3" src="assets/src/comingsoon/sfondo_3.jpg" alt="">
				</a>
			</li>
		</ul>		
		
		<!-- SoftIXX Web Assets: JQuery-->
		<script src="assets/js/vendors/jquery-3.6.0.min.js" type="text/javascript"></script>
		<script type="text/javascript" th:inline="javascript">
			var bkgInterval = null;
			var bkgImg = 1;
			$(document).ready(function() {
				bkgInterval = setInterval(rotateBkg, 3000);
				rotateBkg();
				
			});
			
			const rotateBkg = () => {
				if (bkgImg > 3) {
					bkgImg = 1;
				}
				
				$("#suffle img").removeClass("opaque");
			    if (bkgImg == 1) {
					$("#slide-1").addClass("opaque");
				} else if (bkgImg == 2) {
					$("#slide-2").addClass("opaque");
				} else if (bkgImg == 3) {
					$("#slide-3").addClass("opaque");
				}
				
				bkgImg ++;
				
				clearInterval(bkgInterval);
				bkgInterval = setInterval(rotateBkg, 2000);
			}
		</script>
	</body>
</html>