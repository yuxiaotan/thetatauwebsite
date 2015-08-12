<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Crop Box</title>
    <link rel="stylesheet" href="css/cropbox.css" type="text/css" />
    <style>
        .container
        {
            position: absolute;
            top: 10%; left: 10%; right: 0; bottom: 0;
        }
        .action
        {
            width: 400px;
            height: 30px;
            margin: 10px 0;
        }
        .cropped>img
        {
            margin-right: 10px;
        }
    </style>
</head>
<body>
<?php
	if( isset( $_POST[ "data" ] ) )
	{
		$imgData = $_POST[ "data" ];
		$filteredData = substr( $imgData, strpos( $imgData, "," ) + 1 );
		$unencodedData = base64_decode( $filteredData );
		
		$fp = fopen( $_POST["firstname"][0].$_POST["lastname"].'.jpg', 'wb' );
		fwrite( $fp, $unencodedData );
		fclose( $fp );		
	}
?>
<script src="js/jquery.js"></script>
<script src="js/cropbox/cropbox.js"></script>
<div class="container">
    <div class="imageBox">
        <div class="thumbBox"></div>
        <div class="spinner" style="display: none">Loading...</div>
    </div>
    <div class="action">
        <input type="file" id="file" style="float:left; width: 250px">
        
        <input type="button" id="btnZoomIn" value="+" style="float: right">
        <input type="button" id="btnZoomOut" value="-" style="float: right">
    </div>
    <div class="cropped">

    </div>
	<form id="upload" >
		<input type="text" id="fn" name="firstname" Placeholder="First Name"><br><br>
		<input type="text" id="ln" name="lastname" Placeholder="Last Name"><br><br>
		<input type="hidden" id="data" name="data">
		<input id="btnCrop" type="submit" value="Upload Pic!" ></input>
	</form>
</div>
<script type="text/javascript">
    $(window).load(function() {
        var options =
        {
            thumbBox: '.thumbBox',
            spinner: '.spinner',
            imgSrc: 'img/cropbox_default.png'
        }
        var cropper = $('.imageBox').cropbox(options);
        $('#file').on('change', function(){
            var reader = new FileReader();
            reader.onload = function(e) {
                options.imgSrc = e.target.result;
                cropper = $('.imageBox').cropbox(options);
            }
            reader.readAsDataURL(this.files[0]);
            this.files = [];
        });
		
        $("#upload").submit( function(){
			var img = cropper.getDataURL();
			$.post( "uploadpic.php", $("#upload").serialize() );
        });
		
        $('#btnZoomIn').on('click', function(){
            cropper.zoomIn();
        });
        $('#btnZoomOut').on('click', function(){
            cropper.zoomOut();
        });
    });
</script>

</body>
</html>