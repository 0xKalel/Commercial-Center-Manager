<?php include("detection_session.php");
include("../config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns:="http://www.w3.org/1999/xhtml" xml:lang="fr">

	<head>
		<title>Locaux</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="author" content="mondersky" />
		<link rel="stylesheet" href="../css/design.css" type="text/css"/>
		<link href="../js/date_piker/css/ui-darkness/jquery-ui-1.10.4.custom.css" rel="stylesheet"/>
		<link href="../js/date_piker/css/ui-darkness/jquery-ui-1.10.4.custom.min.css" rel="stylesheet"/>
		<style id="test"></style>
		<script type="text/javascript"src="../js/jquery-2.1.0.js"></script>
		<script type="text/javascript" src="../js/date_piker/js/jquery-1.10.2.js"></script>
		<script type="text/javascript" src="../js/date_piker/js/jquery-ui-1.10.4.custom.js"></script>
		<script type="text/javascript" src="../js/date_piker/js/jquery-ui-1.10.4.custom.min.js"></script>
		<script src="../js/date_fr.js" type="text/javascript"></script>
		<script type="text/javascript" src="../js/jquery.validate.min.js"></script>
		<script type="text/javascript" src="../js/messages_fr.js"></script>
		<script type = "text/javascript"src="../js/jquery.form.js"></script>
		<script type="text/javascript" src="../js/liste_options.js"></script>
		<script src="../js/responsiveslides.js"></script>
		<script src="../js/jquery.PrintArea.js"></script>
		<link rel="stylesheet" href="../css/design.css" type="text/css"/>
		<link rel="stylesheet" href="../css/cmxform.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="../css/demo.css">
		<link rel="stylesheet" href="../css/responsiveslides.css">
		<style id="test"></style>

	</head>

	<body>
		<div id="repense" style="display:none;"> 
			<h3></h3>
		</div>
		<div class="main">
			<img calss="border_top" src="../elements/border_top.png">
			<img calss="logo" src="../elements/logo.png">
			<nav>
				<ul>
					<li><a href="../plan">PLAN</a></li>
					<li><a href="javascript:" class="selected">LOCAUX</a></li>
					<li><a href="../locataires">LOCATAIRES</a></li>
					<li><a href="../contrats">CONTRATS</a></li>
					<li><a href="javascript:"><img id="par" src='../elements/parametre.png'></a></li>
				</ul>
			</nav>
			<?php 
				include("liste_options.php");
			 ?>	
			<div class="conteneur">
				<?php 
					$array = array();
					$i=0;
					$id=$_REQUEST["id"];

					$dirname = "../elements/documents/$id";

					$vide=true;
					if (file_exists($dirname)) {
						$dir = opendir($dirname);
						while($file = readdir($dir)) {
							if($file != '.' && $file != '..' && !is_dir($dirname.$file))
								{
									$vide=false;
									$array[$i] = "$dirname$file";
									$i++;
								}
						}

					}
					if($vide) {				
				 ?>

				<script type="text/javascript">

					$("#repense h3").html("Document inexistant!");
				    $("#repense").css("background-color","red");
				    $("#repense").css("display","block");
				    setTimeout(function(){$("#repense").fadeOut(2000);},3000);
				</script>

				<?php
					}
					else {
				?>

<div id="slideshow">
	
</div>

<script type="text/javascript">

	var imgs= <?php echo json_encode($array) ?>;
	
	for (var i = 0; i < imgs.length; i++) {
		$('#slideshow').append("<img src='"+imgs[i]+"' width='90' height='130'>");
	};


</script>
						
				<?php
					}
				?>

			</div>
		</div>
<!-- 		<div class="black_background" id="black_background_documents" style="display: none;">
			<div id="lightbox_container">
				<div class="lightbox" id="lightbox_documents">
					<img src="../elements/close_button.png" class="close_button" alt="" />
					<div class="callbacks_container" id="slider">
						<ul class="rslides" id="slider4">
						<?php 
							for ($t=0; $t < count($array); $t++) {
								$src=$array[$t];
								echo "<li>";
								echo"<img id='slider_image$t' src='$src' width='357' height='505' alt='' />";	
								echo "<p class='caption' id='$t'>Imprimer</p>";
								echo "</li>";	
							}
							
						 ?>
						</ul>
					 </div>
					
				</div>
			</div>
		</div> -->
		<?PHP 
			// include("modifier_cpt.php");
			// $option="options_supplementaires";
			// include("options_admin.php"); 
		?>

		<script type="text/javascript">
		var Image_actuelle;
		$(document).ready(function(){
			function cacher_lightbox(){
				$('.black_background').fadeOut(500);
			};
			$('.close_button').mousedown(function(){
				cacher_lightbox();
			});
			$(".document_image").mousedown(function(){
				Image_actuelle=$(this).index(".document_image")
				$('#black_background_documents').css("display","");
				$("#slider_image2").parent().toggleClass("callbacks1_on");
				$("#slider_image2").parent().toggleClass("premier");
		      $("#slider4").responsiveSlides({
		        auto: false,
		        pager: true,
		        nav: true,
		        speed: 500,
		        namespace: "callbacks",
		        before: function () {
		          $('.events').append("<li>before event fired.</li>");
		        },
		        after: function () {
		          $('.events').append("<li>after event fired.</li>");
		        }
		      });
			});

			$(".caption").mousedown(function(){
				var imp="img#slider_image"+$(this).attr('id');
				$(imp).printArea();
			});

			// Slideshow 4
		});
	</script>
	</body>

</html>