<!-- sidebar -->
<div class="three columns">
<!-- menu izquierda -->

<?php if(qtrans_getLanguage()=='en') { ?>
<div class="demo">
		<div class="three columns mtop">
			<span class="menu-left-nosotros">who we are</span>
			<ul class="sub-menu-left">
				<li><a href="http://kandor.d3s.es/en/history" tittle="History">history</a></li>
				<li><a href="http://kandor.d3s.es/en/activity" tittle="Activity">activity</a></li>
				<li><a href="http://kandor.d3s.es/en/process" tittle="Process">process</li></a>
				<li><a href="http://kandor.d3s.es/en/commitment" tittle="Commitment">commitment</a></li>
				<li><a href="http://kandor.d3s.es/en/strengths" tittle="Strengths">strengths</a></li>
			</ul>
			
			<ul class="mbotton menu-left">
				<li><a href="http://kandor.d3s.es/en/awards" tittle="Awards">awards</a></li>
				<li><a href="http://kandor.d3s.es/en/master" tittle="Master">master</a></li>
				<li><a class="active" href="http://kandor.d3s.es/prensa/en" tittle="Press">press</a></li>
			</ul>
		</div>
	</div>
<aside class="two columns">
	<ul class="prensa_ul cuarenta-top">
	
	</ul>
</aside>
</div>
<?php } elseif(qtrans_getLanguage()=='es') { ?>
<div class="demo">
		<div class="three columns mtop">
			<span class="menu-left-nosotros"><?php _e("<!--:en-->who we are<!--:--><!--:es-->nosotros");?></span>
			<ul class="sub-menu-left">
				<li><a href="http://kandor.d3s.es/historia" tittle="Historia">historia</a></li>
				<li><a href="http://kandor.d3s.es/actividad" tittle="Actividad">actividad</a></li>
				<li><a href="http://kandor.d3s.es/proceso" tittle="Proceso">proceso</li></a>
				<li><a href="http://kandor.d3s.es/nuestros-compromisos" tittle="Compromiso">compromiso</a></li>
				<li><a href="http://kandor.d3s.es/fortalezas" tittle="Fortalezas">fortalezas</a></li>
			</ul>

			<ul class="mbotton menu-left">
				<li><a href="http://kandor.d3s.es/premios" tittle="Premios Kandor Graphics">premios</a></li>
				<li><a href="http://kandor.d3s.es/master" tittle="Master Kandor Graphics">m&aacute;ster</a></li>
				<li><a class="active" href="http://kandor.d3s.es/prensa" tittle="Prensa Kandor Graphics">prensa</a></li>
			</ul>
		</div>
	</div>
<aside class="two columns">
	<ul class="prensa_ul cuarenta-top">
		
	</ul>
</aside>
</div>

<?php }?>

<!-- sidebar -->

<script type="text/javascript">
	$(".demo").collapse({show: function(){
	        this.animate({
	            opacity: 'toggle', 
	            height: 'toggle'
	        }, 300);
	    },
	    hide : function() {
			this.animate({
	            opacity: 'toggle', 
	            height: 'toggle'
	        }, 300);
	    }
	});
</script>