<?php
	if( isset( $_POST["FN"] ) && isset( $_POST["LN"] ) && $_POST["FN"] !== "" && $_POST["LN"] !== "")
	{
		$FN = $_POST["FN"];
		$LN = $_POST["LN"];
		
		if( isset( $_POST["bio"] ) )
		{
			$bio = str_replace( "\n", "</p><p>", $_POST["bio"] );
			$brothers = file_get_contents( "brothers.csv" );
			$row_start = stripos( $brothers, $FN."|".$LN );
			if( $row_start > stripos( $brothers, "\n" ) )
			{
				$last_field = stripos( $brothers, "|", 1 + stripos( $brothers, "|", $row_start + strlen($FN."|".$LN) ) );
				$row_end = stripos( $brothers, "\n", $row_start );
				$brothers_new = substr( $brothers, 0, $last_field + 1 ).$bio.substr( $brothers, $row_end - 1 );
				file_put_contents( "img/uploads/brothers.csv", $brothers_new );
			}
			
			$core = file_get_contents( "core.csv" );
			$row_start = stripos( $core, $FN."|".$LN );
			if( $row_start > stripos( $core, "\n" ) )
			{
				$last_field = stripos( $brothers, "|", 1 + stripos( $brothers, "|", $row_start + strlen($FN."|".$LN) ) );
				$row_end = stripos( $core, "\n", $row_start );			
				$core_new = substr( $core, 0, $last_field + 1 ).$bio.substr( $core, $row_end - 1 );
				file_put_contents( "img/uploads/core.csv", $core_new );
			}
			
			$semester = file_get_contents( "semester.csv" );
			$row_start = stripos( $semester, $FN."|".$LN );
			if( $row_start > stripos( $semester, "\n" ) )
			{
				$last_field = stripos( $brothers, "|", 1 + stripos( $brothers, "|", $row_start + strlen($FN."|".$LN) ) );
				$row_end = stripos( $semester, "\n", $row_start );
				$semester_new = substr( $semester, 0, $last_field + 1 ).$bio.substr( $semester, $row_end - 1 );				
				file_put_contents( "img/uploads/semester.csv", $semester_new );
			}
		}

		if( isset( $_FILES["pic"] ) )
		{
			$imgpath = "img/uploads/";
			$imgname = $FN[0].$LN.".png";
			$imgtemp = $_FILES["pic"]["tmp_name"];
			
			move_uploaded_file( $imgtemp, $imgpath.$imgname );
		}
	}
?>

<html lang="en">
<head>
<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta name="author" content="Varun Hegde">

<!-- css -->

<link href="css/bootstrap.min.css" rel="stylesheet">

<link href="css/style.css" rel="stylesheet">

<link rel="icon" type="image/png" href="img/favicon.ico">

</head>

<body>
<div id="wrapper">
	<section id="content">
		<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<p style="width:75%;margin:0 auto;">Please type your Full Name and the bio you'd like to use. Please also upload a photo of your headshot that is sized 360px width by 504px height. Thank You.</p>
				<form enctype="multipart/form-data" style="width:75%;margin:0 auto;" id="bio-update" action="bio_data_update.php" method="post">
					<div class="row">
						<div class="col-lg-4 field">
							<input style="width:45%;border-radius:10px;border-color:#C0C0C0;margin:2%;" type="text" name="FN" placeholder="* Enter your First Name" data-rule="maxlen:4" data-msg="Please enter at least 4 chars">
							<input style="width:45%;border-radius:10px;border-color:#C0C0C0;margin:2%;" type="text" name="LN" placeholder="* Enter your Last Name" data-rule="maxlen:4" data-msg="Please enter at least 4 chars">
							<div class="validation">
							</div>
						</div>
					</div><div class="row">
						<textarea style="width:100%;height:350px;border-radius:10px;border-color:#C0C0C0;margin:5px;" rows="12" name="bio" class="input-block-level" placeholder="* Your bio here..." data-rule="required" data-msg="Please write something"></textarea>
					</div><div style="width:100%; border-radius:10px; border-color:#C0C0C0; margin:5px;" class="row">Headshot( png only ):
						<input name="pic" type="file" accept="image/png" />
					</div><div class="row">
						<p>
							<button class="btn btn-theme margintop10 pull-left" type="submit">Submit Bio & Pic</button>
							<span class="pull-right margintop20">* Please fill all required form fields, thanks!</span>
						</p>
					</div>
				</form>
			</div>
		</div>
	</div>
	</section>
</div>
<a href="#" class="scrollup"><i class="fa fa-angle-up active"></i></a>
<!-- javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.fancybox.pack.js"></script>
<script src="js/jquery.fancybox-media.js"></script>
<script src="js/google-code-prettify/prettify.js"></script>
<script src="js/portfolio/jquery.quicksand.js"></script>
<script src="js/portfolio/setting.js"></script>
<script src="js/jquery.flexslider.js"></script>
<script src="js/animate.js"></script>
<script src="js/custom.js"></script>
<script src="js/validate.js"></script>

</body></html>