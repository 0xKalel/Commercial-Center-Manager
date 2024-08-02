$(document).ready(function(){
  var Test=$("#par");

  function cacher_lightbox(){
    $(".black_background").fadeOut(500);
  };

  $(".close_button").click(cacher_lightbox);

  $("#par").click(function(){
    if($("#paramettres").css("display")=="none")
      $("#paramettres").css("display","block");
    else 
      $("#paramettres").css("display","none");
  });

  // $("body").click(function(e) {
  //     // Si ce n'est pas #Test ni un de ses enfants
  //     if(!$(e.target).is(Test)&&!$.contains(Test[0],e.target)) 
  //         $("#paramettres").css("display","none");
  // });

  $("#modifier_compte").click(function(){
    $("#paramettres").css("display","none");
    $("#black_background_compte").css("display","");
  });

  $("#form_modifier_cpt").validate({
    rules :{
        "nom_actuel" :{
          "required" :true,
        },
        "nouveau_nom" :{
            "required" :true,
        },
        "mot_passe_actuel" :{
          "required" : true,
        },
        "nouveau_mot_passe" : {
            "required" :true,
        }
    },

    submitHandler: function(){
      $.post("ajax/in/modifier_cpt.php", $("#form_modifier_cpt").serialize(), function(resultat){
        cacher_lightbox();
        if (resultat == 3) {
          $("#repense h3").html("Paramettres sauvegardés");
          $("#repense").css("background-color","green");
          $.post("php/deconnexion.php");
          setTimeout(function(){location.reload();},5000);
        }else if (resultat == 2){
          $("#repense h3").html("Paramettres non sauvegardés!");
          $("#repense").css("background-color","red");
        }else if (resultat == 1){
          $("#repense h3").html("Nom d'utilisateur existe déja!");
          $("#repense").css("background-color","red");
        }else {
          $("#repense h3").html("Nom ou mot de passe incorrect!");
          $("#repense").css("background-color","red");
        }
        $("#repense").css("display","block");
        setTimeout(function(){$("#repense").fadeOut(2000);},3000);
      })
    }
  });

  $("#nouvel_utilisateur").click(function(){
    $("#paramettres").css("display","none");
    $("#black_background_utilisateur").css("display","");
  });

  $("#form_ajouter_cpt").validate({
    rules :{
        "nom" :{
          "required" :true,
        },
        "mot_de_passe" :{
          "required" :true,
        },
        "confirmation" :{
          "required" :true,
          equalTo : "#mot_de_passe",
        }
    },

    submitHandler: function(){
      $.post("ajax/in/nouvel_utilisateur.php", $("#form_ajouter_cpt").serialize(), function(resultat){
        cacher_lightbox();
        if (resultat == 2) {
          $("#repense h3").html("Utilisateur ajouté");
          $("#repense").css("background-color","green");
        }else if (resultat == 1){
          $("#repense h3").html("Utilisateur non sauvegardé!");
          $("#repense").css("background-color","red");
        }else{
          $("#repense h3").html("Utilisateur existe déja!");
          $("#repense").css("background-color","red");
        }
        $("#repense").css("display","block");
        setTimeout(function(){$("#repense").fadeOut(2000);},3000);
      })
    }
  });

  $("#supp_utilisateur").click(function(){
    var param={};
    $.post("ajax/out/charger_utilisateurs.php",param,function(resultat){
      var resultat=jQuery.parseJSON(resultat);
      var utilisateurs="";
      for(var i=0;i<resultat.length;i++)
        utilisateurs+="<option value='"+resultat[i].nom+"'>"+resultat[i].nom+"</option>"; 
      $("select#nom").html(utilisateurs);
    })
    $("#paramettres").css("display","none");
    $("#black_background_utilisateur2").css("display","");
  });

  $("#form_supp_cpt").validate({
    rules :{
    },

    submitHandler: function(){
      $.post("ajax/in/supp_utilisateur.php", $("#form_supp_cpt").serialize(), function(resultat){
        cacher_lightbox();
        if (resultat == 2) {
          $("#repense h3").html("Utilisateur supprimé");
          $("#repense").css("background-color","green");
        }else if (resultat == 1){
          $("#repense h3").html("Utilisateur non supprimé!");
          $("#repense").css("background-color","red");
        }
        $('#repense').css("display","block");
        setTimeout(function(){$('#repense').fadeOut(2000);},3000);
      })
    }
  });

  $("#options").click(function(){
    $("#paramettres").css("display","none");
    var param={};
    $.post("ajax/out/options_acts.php",param,function(resultat){
      var resultat=jQuery.parseJSON(resultat);
      if (resultat[0].etage=="RDC") 
        $("#etage option[value='RDC']").prop("selected", true);
      else 
        if (resultat[0].etage=="ETAGE1") 
          $("#etage option[value='ETAGE1']").prop("selected", true);
      else 
        $("#etage option[value='ETAGE2']").prop("selected", true);
      $("#interval").val(resultat[0].nbr);
      var c1=resultat[0].color1;
      c1=c1.replace("#","");
      var c2=resultat[0].color2;
      c2=c2.replace("#","");
      $("#color1").attr("value", c1);
      $("#color1").val(c1)
      $("#color1").css("background-color",resultat[0].color1);
      $("#color2").attr("value", c2);
      $("#color2").val(c2)
      $("#color2").css("background-color",resultat[0].color2);
    });
    $("#black_background_options").css("display","");
  });

  $("#form_options").validate({
    rules :{
    },

    submitHandler: function(){
      $.post("ajax/in/options.php", $("#form_options").serialize(), function(resultat){
        cacher_lightbox();
        if (resultat == 2) {
          $("#repense h3").html("Paramettres sauvegardés");
          $("#repense").css("background-color","green");
          setTimeout(function(){location.reload();},5000);
        }else if (resultat == 1){
          $("#repense h3").html("paramettres non sauvegardés");
          $("#repense").css("background-color","red");
        }
        $("#repense").css("display","block");
        setTimeout(function(){$('#repense').fadeOut(2000);},3000);
      })
    }
  });
});