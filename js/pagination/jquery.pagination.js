(function($) {
    
    $.fn.pagination=function(options) {

    	var element=$(this),
    		nbImgs=element.find('a').size(),
    		param=getParametres(),
    		pages=new Array();

    	function getParametres() {
    		
    		var img=element.find('a img:first'),
				nbColImgsDefauts=0;

			if(nbImgs>10) nbColImgsDefauts=4;
			else if(nbImgs>5) nbColImgsDefauts=3;
			else if(nbImgs>3) nbColImgsDefauts=2;
			else nbColImgsDefauts=2;

			defauts={ 
	    		'largImg': img.css('width') , 
	    		'hautImg': img.css('height') , 
	    		'nbImgsPage': nbImgs , 
	    		'nbColImgs': nbColImgsDefauts,
	    		'margeEntreImgs': 30,
	    		'dureePagin': 300,
	    		'dureeZoomImg': 50,
	    		'lienControl': ''
			}

			return $.extend(defauts, options);

		}


		function getTableDiv(x,y) {
			var tDiv=new Array(),
				div=parseInt(x/y),
				mod=x%y,
				n=div+((mod==0)?0:1);
			for (var i = 0; i < n; i++) tDiv.push((mod!=0 && i==n-1)?mod:y);
			return tDiv;
		}

		function pagination(element,nbep,eWrap) {

			var a=element.find('a');
				size=a.size(),
				tDiv=getTableDiv(size,nbep);

			for (var i = 0; i < tDiv.length; i++) {
				page=a.slice(i*tDiv[0],i*tDiv[0]+tDiv[i]);
				page.wrapAll('<'+eWrap+'></'+eWrap+'>');
			}

		}

		function setCss() {

			element.find('td').css({
				'padding': param.margeEntreImgs,
				'width': param.largImg,
				'height': param.hautImg
			});

			element.find('a').css({
				'position':'relative',
				'width': param.largImg,
				'height': param.hautImg,
				'display': 'block',
				// 'background': 'red'
			});

			element.find('img').css({
				'width': param.largImg,
				'height': param.hautImg,
				// 'background': 'green',
				'position': 'absolute',
				'top': 0,
				'left': 0,
				'border':'black solid 1px'
			});	

			element.find('table').css({ 
				'border-spacing': '0',
			});

			element.find('.page').css({
				'width': element.find('table:first').css('width'),
				'height': element.find('table:first').css('height'),
				'background': 'rgb(18,111,150)',
				'position':'absolute',
				'backface-visibility':'hidden'
			});

//			w=element.find('table:first').css('width').replace('px','')+50;

			element.css({
				'perspective': '2000px',
				'width': parseInt(element.find('table:first').css('width').replace('px',''))+160,
				'height': parseInt(element.find('table:first').css('height').replace('px',''))+60,
				// 'background': 'green',
				'position':'relative',
				'margin':'50px auto'
			});	

		}

		function creerPages() {

			pagination(element,param.nbImgsPage,'table');

			element.find('table').each(function() { 
				pagination($(this),param.nbColImgs,'tr');
				$(this).wrap("<div class='page'></div>") 
			})

			element.find('a').wrap('<td></td>');
		}

		function initPagination3D() {

			card=$("<div id='card'></div>");
			card.css({
				'transform-style':'preserve-3d',
				'position':'absolute',
				'top':'30px',
				'left':'80px',
				'height':element.find('table:first').css('height').replace('px','')+'px',
				'width':element.find('table:first').css('width').replace('px','')+'px',
				'background':'red'		
			});
			element.find('.page').each(function() { pages.push($(this));  });
			element.empty();
			element.append(card);

			card.append(pages[0]);

			if(pages.length>1) {
				card.append(pages[1]);
				pages[1].css({ 'transform': 'rotateY( 180deg )' })
				element.append(
					"<img id='p' class='control' src='"+param.lienControl+"/prec.png'>"+ 
					"<img id='s' class='control' src='"+param.lienControl+"/suiv.png'> "
				);
				element.find('.control').css({
					'position':'absolute',
					'top':parseInt(element.css('height').replace('px','')/2-20)+'px',
					'width':'40px',
					'height':'40px',
					'cursor':'pointer',
					'opacity': 0.3
				});

				element.find('#p').css({ 'left':0 });
				element.find('#s').css({ 'right':0 });
			}	
			zoomImgsHover();
		}

		function rotationY(sens) {
			var k=(sens=='-')?-1:+1;
			$({deg: 0}).animate({deg: k*180}, {
				duration: param.dureePagin,
				step: function(now) { 
					$('#card').css({ transform: 'rotateY(' + now + 'deg)' }); 
				},
				complete: function() {

				}
			});
		}

		function genTableIndexs(nbPages) {
			var tIndexs=new Array(); 
			for (var i = 0; i < nbPages; i++) {
				var t=new Array();
				t[0]=i;		t[1]=(i+1)%nbPages;
				tIndexs.push(t);
			}
			return tIndexs;
		}

		function zoomImgsHover() {
			element.find('.page img').hover(
				function() {
					$(this).css('z-index',1);
					$(this).stop(true, false).animate( { width: param.largImg+30, height:param.hautImg+30, top:-15, left:-15}, param.dureeZoomImg );
				},
				function() {
					$(this).css('z-index',0);
					$(this).stop(true, false).animate( {width:param.largImg, height:param.hautImg, top:0, left:0},param.dureeZoomImg );
				}
			)
		}	

		function controlHover() {
			
			element.find('.control').hover(
				function() {
					$(this).stop(false, true).animate( { opacity:1},300 );
				},
				function() {
					$(this).stop(false, true).animate( {opacity:0.3},300 );
				}
			)
		}

		function controlClick() {
			var index=0,	
				nbPages=pages.length,
				tIndexs=genTableIndexs(nbPages);
			
			element.find('.control').click( function() {
				id=$(this).attr('id');
				if(id=='p') {
					if(index==0) index=nbPages;
		 			index--;
					element.find('#card').empty();
		 			element.find('#card').css({ 'transform': 'rotateY( 0deg )' });
					element.find('#card').append(pages[tIndexs[index][1]]);	
		 			element.find('#card').append(pages[tIndexs[index][0]]);
		 			element.find('.page').attr('style','');
		  			element.find('.page').css({'background':'rgb(18,111,150)','position':'absolute','left':'0','top':'0','width':'inherit','height':'inherit','backface-visibility':'hidden'})
					element.find('.page:eq(1)').css({ 'transform': 'rotateY( -180deg )' })
					zoomImgsHover();
					rotationY('-');			
				} 
				else {
					element.find('#card').empty();
		 			element.find('#card').css({ 'transform': 'rotateY( 0deg )' });
					element.find('#card').append(pages[tIndexs[index][0]]);	
		 			element.find('#card').append(pages[tIndexs[index][1]]);
		 			element.find('.page').attr('style','');
		  			element.find('.page').css({'background':'rgb(18,111,150)','position':'absolute','left':'0','top':'0','width':'inherit','height':'inherit','backface-visibility':'hidden'})
					element.find('.page:eq(1)').css({ 'transform': 'rotateY( 180deg )' });
					index=(index+1)%nbPages;
					zoomImgsHover();
					rotationY('+');
				}
				
			})
		}
		
		(function() { 
			creerPages();    
			setCss();
			initPagination3D();
			controlHover() 
			controlClick(); 
		})();

    };

})(jQuery);