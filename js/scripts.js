
var Color=100;
	var EatgeSelecnionne=1;
	var Local="";
	var op=0;
	var Dropped=false;
	var currentMousePos = {
		x: -1,
		y: -1
	};
	var overlaps = (function () {
		function getPositions( elem ) {
			var pos, width, height;
			pos = $( elem ).position();
			width = $( elem ).width();
			height = $( elem ).height();
			return [ [ pos.left, pos.left + width ], [ pos.top, pos.top + height ] ];
		}

		function comparePositions( p1, p2 ) {
			var r1, r2;
			r1 = p1[0] < p2[0] ? p1 : p2;
			r2 = p1[0] < p2[0] ? p2 : p1;
			return r1[1] > r2[0] || r1[0] === r2[0];
		}

		return function ( d, b ) {
			var pos1 = getPositions( d ),
			pos2 = getPositions( b );
			return comparePositions( pos1[0], pos2[0] ) && comparePositions( pos1[1], pos2[1] );
		};
	})();
	$(function() {

		var area = $( '.des' )[0],
		i=0,
		html=0;
		function testcolision(A){
			box = A[0]
			$(".des .dep").each(  function (  ) {
				if(overlaps( box, this ) == true){ html=1;}



			})};
			

			$(".obstacle img").hide();

			$( "#draggable0" ).draggable({ 
				containment: $(".bordures_map"),
				// revert : function(event, ui) {
				// 	$(this).data("ui-draggable").originalPosition = {
				// 		top : 0,
				// 		left : 85
				// 	}
				// 	if(Dropped==false){
				// 		$(this).toggleClass("nouveau_local_mode_resize").css({height:100,width:100})
				// 		setTimeout(function(){
				// 			$(".nouveau_local_mode_resize").toggleClass("nouveau_local_mode_resize")
				// 		},1000)
				// 	}
				// 	return !event;
				// },
				cursor: "crosshair" 
				,obstacle: ".des .dep" 
				,preventCollision: true
				,dragstart: function( event, ui ) {}
			}).resizable({
				containment:  $(".bordures_map")})
			$( "#sole" ).droppable({
				greedy: true,	
				drop: function( event, ui ) {
					var pos;
					pos=$(".des").position();
				}


			}).on("drop", function(event, ui) {
				$(".message_deplacer span").hide()
				$("#draggable_container:not(.reduire_hauteur)").toggleClass("reduire_hauteur")	

				Dropped=true;
			}).on("dropout", function(event, ui) {
				$(".message_deplacer span").show()
				$("#draggable_container.reduire_hauteur").toggleClass("reduire_hauteur")
				Dropped=false;
			})

		});
function alerte (){
	$('.expere').css("background-color","rgb("+Color+",0,0)");
	$('.experant').css("background-color","rgb(255,"+Color+",0)");
	Color=(Color % 255) + 5;
	if (Color == 5) {
		Color=100;
		setTimeout(alerte, 500);
	} else setTimeout(alerte, 10);

};

function svt(){
	$("img#prec").unbind('mousedown');
	$("img#next").unbind('mousedown');
	$(".description p").empty();
	if (EatgeSelecnionne==1){
		$("#etage1").css("position","absolute").animate({left:"-542px"},300);
		$("#etage2").css("position","absolute").animate({left:"60px"},300);
		$("#etage3").css("left","662px");
		$(".description p").append("Etage N° 01");
	}else if (EatgeSelecnionne==2){
		$("#etage2").css("position","absolute").animate({left:"-542px"},300);
		$("#etage3").css("position","absolute").animate({left:"60px"},300);
		$("#etage1").css("left","662px");
		$(".description p").append("Etage N° 02");
	}else{
		$("#etage3").css("position","absolute").animate({left:"-542px"},300);
		$("#etage1").css("position","absolute").animate({left:"60px"},300);
		$("#etage2").css("left","662px");
		$(".description p").append("RDC");
	}
	EatgeSelecnionne=EatgeSelecnionne % 3 + 1;
	setTimeout(function(){$("img#prec").bind('mousedown',prec);}, 300);
	setTimeout(function(){$("img#next").bind('mousedown',svt);}, 300);


};

function prec(){
	$("img#prec").unbind('mousedown');
	$("img#next").unbind('mousedown');
	$(".description p").empty();
	if (EatgeSelecnionne==1){
		$("#etage1").css("position","absolute").animate({left:"662px"},300);
		$("#etage3").css("position","absolute").animate({left:"60px"},300);
		$("#etage2").css("left","-542px");
		$(".description p").append("Etage N° 02");
	}else if (EatgeSelecnionne==3){
		$("#etage3").css("position","absolute").animate({left:"662px"},300);
		$("#etage2").css("position","absolute").animate({left:"60px"},300);
		$("#etage1").css("left","-542px");
		$(".description p").append("Etage N° 01");
	}else{
		$("#etage2").css("position","absolute").animate({left:"662px"},300);
		$("#etage1").css("position","absolute").animate({left:"60px"},300);
		$("#etage3").css("left","-542px");
		$(".description p").append("RDC");
	}
	EatgeSelecnionne=EatgeSelecnionne - 1;
	if (EatgeSelecnionne == 0) EatgeSelecnionne=3;
	setTimeout(function(){$("img#prec").bind('mousedown',prec);}, 300);
	setTimeout(function(){$("img#next").bind('mousedown',svt);}, 300);
};

$("img#prec").mousedown(prec);

$("img#next").mousedown(svt);

function info(num){
	var param={Num:num};
	$.post("ajax/out/info_locaux.php",param,function(resultat){
		var resultat=jQuery.parseJSON(resultat);
		console.log(resultat["nbr"]);
		$(".lblvalue#nbr p").html(resultat['nbr']);
		$(".lblvalue#nbr_res p").html(resultat['nbr_occupe']);
		$(".lblvalue#nbr_no_res p").html(resultat['nbr_libre']);
	})
}

function etage(num){
	if (num==0){
		$('.etage#etage2').fadeOut(00);
		$('.etage#etage3').fadeOut(00);
		$('.etage#etage1').fadeIn(600);
		info(1);
	}else if (num==1){
		$('.etage#etage1').fadeOut(00);
		$('.etage#etage3').fadeOut(00);
		$('.etage#etage2').fadeIn(600);
		info(2);
	}else{
		$('.etage#etage2').fadeOut(00);
		$('.etage#etage1').fadeOut(00);
		$('.etage#etage3').fadeIn(600);
		info(3);
	}
	$('#info h1').html("• INFOS ETAGE");
	$('#detailles').css("display","none");		
	$('#detailles a').attr("href","#");
	// $("#info_desc").css("display", "block");
	$("#info_desc2").css("display", "none");

}
var Zoom=true;
function zoom(){

	var i=Math.min($( window ).height()/450,$( window ).width()/1200);
	var j=190*i;
	var k=105*i;
	if (Zoom){
		$('body').toggleClass("dzoom");
		$('body').toggleClass("zoom");
		$('body').css("transform", "translate(-"+j+"px, -"+k+"px) scale("+i+")");
		$('#btn6').html("Zoom out");
	}else {
		$('body').toggleClass("zoom");
		$('body').toggleClass("dzoom");
		$('body').css("transform", "translate(0px, 0px) scale(1)");
		$('#btn6').html("Zoom in");

		$('body').css("transform", "");
	}
	Zoom=!Zoom;
}
