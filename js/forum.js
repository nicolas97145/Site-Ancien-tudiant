var requete = null;
function creerRequete(){
	try{
		requete = new XMLHttpRequest();

	} catch(essaimicrosoft){
		try{
			requete =  new ActiveXObject("Msxml2.XMLHTTP");
		}catch(autremicrosoft){
			try{
				requete = new ActiveXObject("Microsoft.XMLHTTP");
			} catch(echec){
				requete=null;
			}
		}
	}
	if(requete==null){
		alert("Impossible de cr&eacuteer l'objet requete");
	}

}
function test(x){
    creerRequete();
    var cat = document.getElementById("cat").value;
    var recherche = document.getElementById("recherche").value;
    var remplir = document.getElementById("select-sujet");
    var url = "forum-recherche.php?cat="+cat+"&recherche="+recherche+"&theme="+x;
    requete.open("GET",url,true);
    requete.onreadystatechange = actualiser;
    requete.send(null);
}
function actualiser(){
  if(requete.readyState==4){
  		if(requete.status==200){
  			  var recompense = "<table><tr><td>Sujet</td><td>Auteur</td><td>NB</td></tr>";
          var i=0;
          var champs = JSON.parse(requete.responseText);
          while(i<champs.length){
              recompense=recompense+"<tr>";
              recompense=recompense+"<td><a href='forumSujet.php?sujet="+champs[i].idsujet+"'>"+champs[i].libelle+"</a></td>";
              recompense=recompense+"<td><a href='affiche_profil?id="+champs[i].id+"'>"+champs[i].nom+" "+champs[i].prenom+"</a></td>";
              recompense=recompense+"<td>"+champs[i].nb+"</td>";
              recompense=recompense+"</tr>";
              i++;
          }
          recompense=recompense+"</table>";
          document.getElementById("select-sujet").innerHTML=recompense;
  		}
  	}
}
