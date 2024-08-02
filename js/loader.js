function afficher_loader(selecteur){
  if(!selecteur)
    selecteur="body";
  loader="<div class='fond_gris'><div class='conteneur_loader'><div id='facebookG'><div id='blockG_1' class='facebook_blockG'></div><div id='blockG_2' class='facebook_blockG'></div><div id='blockG_3' class='facebook_blockG'></div></div>"
  $(selecteur).append(loader).find(".fond_gris").hide().fadeIn(300)
}
function cacher_loader(){
  $(".fond_gris").fadeOut(300,function(){
    $(this).remove()
  })
}
