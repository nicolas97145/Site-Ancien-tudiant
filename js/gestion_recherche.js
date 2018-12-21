var requete = null;
var globalName="";
//Fonction gérant mon Ajax
function creerRequete(){
	try{
		requete = new XMLHttpRequest();
	}
  catch(essaimicrosoft){
		try{
			requete =  new ActiveXObject("Msxml2.XMLHTTP");
		}
    catch(autremicrosoft){
			try{
				requete = new ActiveXObject("Microsoft.XMLHTTP");
			}
      catch(echec){
				requete=null;
			}
		}
	}
	if(requete==null){
		alert("Impossible de cr&eacuteer l'objet requete");
	}
}

function selectitem(){
		document.getElementById('optionrecherche').style.display = 'block';
		var name = document.getElementsByName('radiobutton');
		for(var i=0;i<name.length;i++){
				if(name[i].checked==true){
						$("#"+name[i].value).show();
						globalName=name[i].value;
				}
				else{
						$("#"+name[i].value).hide();
				}
		}
}

function lanceRecherche(){
  //Création de mon Ajax
  creerRequete();
	toDisplay();
	var value=document.getElementById(globalName).value;
	var url = "traitement-recherche.php?x="+globalName+"&value="+value;
  //.open() ouvre la connexion ajax, envoie de paramêtre en GET, à l'URL, asynchrone : true
	requete.open("GET", url, true);
  //.onreadystatechange permet de recharger ma fonction à chaque fois que le status de requete change
	requete.onreadystatechange = actualiserRecherche;
	requete.send(null);
}

function toDisplay(){
	document.getElementById('contentrecherche').style.display="block";
}

function actualiserRecherche(){
  //Déclaration de variable éssentiel
  var i,n,div;
  //Si le status vaut 4, donc que la requete est terminer.
  if(requete.readyState==4){
    //Si il n'y a pas de retour "erreur", du type par exemple 404 Page not Found, alors on fait le code. 200 est l'indice de retour lorsque la requete serveur est réussi.
    if(requete.status==200){
      effacerRes();
      //Je parse mon fichier JSON.
      champs = JSON.parse(requete.responseText);
      //Les deux prochaines variables vont me servir à boucler, sur le tableau de String que je viens de récupérer en parser mon fichier JSON.
			n=champs.length;
      var pdt = document.getElementById('contentrecherche');
			switch(globalName){
				case 'recherche-select-entreprise':
					div=rechercheEntreprise(n,champs);
					break;
				case 'recherche-select-bts':
					div=rechercheBts(n,champs);
					break;
				case 'recherche-select-nom':
					div=rechercheBts(n,champs);
					break;
				case 'recherche-select-etablissement':
					div=rechercheBts(n,champs);
					break;
				case 'recherche-select-promo':
					div=rechercheBts(n,champs);
					break;
			}
			pdt.appendChild(div);
    }
    else{
			alert("erreur : le status de la requête est : "+requete.status);
		 }
  }
}
//Cette fonction me permet de "nettoyer" la page, dans le cas ou des éléments aurait déjà été charger.
function effacerRes(){
		document.getElementById('contentrecherche').innerHTML="";
}

function rechercheEntreprise(n,champs){
	i=0;
	//Je créer une div qui vas remplacer la div précédement effacer.
	var div = document.createElement("DIV");
	var job = new Array();
	var stage = new Array();
	while(i<n){
	//   J'enregistre chacun de mes éléments dans la variable correspondantes (le titre dans la variable titre [etc])
		if(champs[i].job=="true"){
			job.push([champs[i].id,champs[i].nom,champs[i].prenom]);
		}
		else{
			stage.push([champs[i].id,champs[i].nom,champs[i].prenom]);
		}
		i++;
	}
	if(i==0){
		element = document.createTextNode("Aucun étudiant trouvé");
		div.appendChild(element);
	}
	else{
		if(job.length>0){
			div.appendChild(document.createTextNode("Job :"));
			var j=0,h=0;
			while(j<job.length){
				var theDiv = document.createElement("DIV");
				var divpdt = document.createElement("a");
				divpdt.href="affiche_profil.php?id="+job[j][0];
				divpdt.innerHTML=job[j][1]+" "+job[j][2];
				theDiv.appendChild(divpdt);
				div.appendChild(theDiv);
				j++;
			}
		}
		if(stage.length>0){
			div.appendChild(document.createTextNode("Stage :"));
			while(h<stage.length){
				var theDiv = document.createElement("DIV");
				var divpdt = document.createElement("a");
				divpdt.href="affiche_profil.php?id="+stage[h][0];
				divpdt.innerHTML=stage[h][1]+" "+stage[h][2];
				theDiv.appendChild(divpdt);
				div.appendChild(theDiv);
				h++;
			}
		}
	}
	return div;
}

function rechercheBts(n,champs){
	i=0;
	//Je créer une div qui vas remplacer la div précédement effacer.
	var div = document.createElement("DIV");
	var id,nom,prenom;
	while(i<n){
	//   J'enregistre chacun de mes éléments dans la variable correspondantes (le titre dans la variable titre [etc])
		id = champs[i].id;
		nom = champs[i].nom;
		prenom = champs[i].prenom;
		//A chaque boucle, je crée un nouvel élément div, qui vas se rajouter dans l'élément div un peu plus haut
		var theDiv = document.createElement("DIV");
		var divpdt = document.createElement("a");
		divpdt.href="affiche_profil.php?id="+id;
		divpdt.innerHTML=nom+" "+prenom;
		theDiv.appendChild(divpdt);
		div.appendChild(theDiv);
		//Ne pas oublier le i++ dans la boucle ! (Une erreur que je fait bien trop souvent, hélas !)
		i++;
	}
	if(i==0){
		element = document.createTextNode("Aucun étudiant trouvé");
		div.appendChild(element);
	}
	return div;
}
