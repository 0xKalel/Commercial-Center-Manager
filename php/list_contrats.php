<?php 

?>
		<table id="tableau_contrats" class="tableau_elements">
			<thead>
				<tr>
					<th id="local"> Local </th>
					<th id="locataire"> Locataire </th>
					<th id="date_debut"> Début </th>
					<th id="date_fin"> Fin </th>
					<th id="montant"> Montant (DA/Mois) </th>
					<th id="autre_declaration"> Autre déclaration (DA/Mois) </th>
					<th id="surface">Actions</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>

		<div class="cadre_pagination">
			
				<table cellspasing=5 class="pagination_page">
					<thead>
						
					</thead>
				</table>
			
		</div>


<script type="text/javascript">
	
	var ordre_prec;
	var Sort="id", Ordre="DESC", Filtre, Page=1, Nbr_page=5;
	 function initialisation(element){
			if(ordre_prec==element)
				var retour=true;  // l'utilisateur a cliqué sur le meme titre
			else
				var retour=false; // l'utilisateur a cliqué sur un titre different du titre précedent et donc réeinitialiser la fleche a décroissant
			ordre_prec=element;
			$( ".croissant").toggleClass( "croissant" );
			$( ".decroissant").toggleClass( "decroissant" );
				$("#tableau_contrats th").one("click",function(){
			})
			return retour;
		}; 

	function ordre_locaux(champs,ordre)
		{
			Sort=champs;
			Ordre=ordre;
			charger_locaux(champs,ordre,Filtre,Page);
		};

	function fleche_croissant(element){
			if(initialisation(element))
			{
				ordre_locaux($(element).attr('id'),"ASC");
				$(element).toggleClass( "croissant" ).one("click",function(){
					fleche_decroissant(element)
				})	
			}
			else
			{
				ordre_locaux($(element).attr('id'),"DESC");
				$(element).toggleClass( "decroissant" ).one("click",function(){
					fleche_croissant(element)
				})
			}
		};

	function fleche_decroissant(element){ 
		initialisation(element)
			ordre_locaux($(element).attr('id'),"DESC");
			$(element).toggleClass( "decroissant" ).one("click",function(){
				fleche_croissant(element)
			})
	};

	function charger_locaux(sort,ordre,filtre,page,fonction_supplementaire){
			var param={sort:sort,ordre:ordre,filtre:filtre,page:page};
			afficher_loader()
			$.post("ajax/out/charger_contrats.php",param,function(resultat){
				var resultat=jQuery.parseJSON(resultat);
				var contrats="";
				for(var i=0;i<resultat.length;i++)
				{
					fichier_class="";
					proprietes_lien=" href='"+resultat[i].fichier+"' target='_blank' ";
					if(resultat[i].fichier==""){
						fichier_class='fichier_vide';
						proprietes_lien=" href='javascript:' ";
					}
					contrats+="<tr id='"+resultat[i].id+"' class='"+fichier_class+"'> <td> "+resultat[i].libelle+
								"</td> <td> "+resultat[i].nom+
								"</td> <td> "+resultat[i].date_debut+
								"</td> <td> "+resultat[i].date_fin+
								"</td> <td> "+resultat[i].montant+
								"</td> <td> "+resultat[i].autre_declaration+
								"</td> <td class='actions'><a href='javascript:' class='plus'></a><a href='javascript:' class='supprimer'></a><a class='facture' "+proprietes_lien+"></a><a class='imprimante' ></a></td> </tr>"; 
				}
				$("#tableau_contrats tbody").html(contrats);
				if(fonction_supplementaire)
					fonction_supplementaire()
				cacher_loader()
			})
			
		};

	function afficher_pagination(nombre_pages)
		{ 
			var P=[""];
			var a=6;
			var n=1;
			Nbr_page=nombre_pages;
			for(var i=parseInt(-(a/2));i<=(a/2);i++)
				{	
					if(((Page + i)>0)&&((Page + i) <= Nbr_page)) 
					{
						var t=Page+i;
						P[n]=t;
						n++;
					}
				}
			$(".pagination_page thead").html("");
				$(".pagination_page thead").append("<td id='1'><span ids='1'>Premier</span></td>");
			for (var i=1;i<P.length;i++)
			{
				$(".pagination_page thead").append("<td id='"+P[i]+"'><span ids='"+P[i]+"'>"+P[i]+"</span></td>");	
			}
			$(".pagination_page thead").append("<td id='"+Nbr_page+"'><span ids='"+Nbr_page+"'>Dernier</span></td>");
			$(".pagination_page thead span").click(function(){
				PAGE=parseInt($(this).attr("ids"));
				afficher_page(PAGE);
			})			
		};

	function afficher_page(page)
		{
			Page=page;
			var nom_table="contrats";
			afficher_loader()
				$.post("ajax/out/nbr_page.php",{nom_table:nom_table},function(resultat)
					{	
						var nbr_page=parseInt(jQuery.parseJSON(resultat));
						var test=parseFloat(jQuery.parseJSON(resultat)%<?php echo "$interval"; ?>);
						if (test>0)
						{
						Nbr_page=parseInt(nbr_page/<?php echo "$interval"; ?>)+1;
						}
						else Nbr_page=parseInt(nbr_page/<?php echo "$interval"; ?>);
						afficher_pagination(Nbr_page);
						$(".pagination_page td[id="+page+"]").toggleClass("active")
						charger_locaux(Sort,Ordre,Filtre,page);
						cacher_loader()
					})
		};

	$(document).ready(function(){
		afficher_page(1);
		$("#tableau_contrats th").one("click",function(){
			fleche_decroissant(this)
		})
	});
</script>