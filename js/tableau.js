/* global formation */

function addRowEtude(tableau){
    tableau = document.getElementById(tableau);
    //Calcul du nombre de cellule par ligne dans le tableau -> on regarde combien il y a de td dans le premier tr
    var tds = tableau.getElementsByTagName('tr')[0].getElementsByTagName('td').length;
    var arrayLignes = document.getElementById("tableauProfil").rows; //l'array est stocké dans une variable
    var longueur = arrayLignes.length;//on peut donc appliquer la propriété length
    //alert("nb ligne = "+longueur);
    //alert("tds = "+tds);
    var tr = document.createElement('tr'); //On créé une ligne
    //On ajoute autant les cellules
    for(var i=0; i<tds; i++){
        var td = document.createElement('td');
        var name;
        tr.appendChild(td);
        switch(i){
            case 0:
                name = '<input type="text" class="titre" name="formation'+longueur+'" required/>';
                break;
            case 1:
                name = '<input type="text" class="titre" name="annee'+longueur+'" required/>';
                break;
            case 2 :
                name = '<input type="text" class="titre" name="discipline'+longueur+'" required/>';
                break;
            case 3:
                name="<select class='select' name='etablissement"+longueur+"' required>"+etablissement+"</select>";
                break;
            case 4:
                name = '<input type="text" class="titre" name="adresse'+longueur+'" required/>';
                break;
            case 5:
                name = '<input type="text" class="titre" name="cp'+longueur+'" required/>';
                break;
            case 6:
                name = '<input type="text" class="titre" name="ville'+longueur+'" required/>';
                break;
        }
   
        //Si on veut mettre du contenu dans la cellule créée, ça se passe ici (sinon il suffit de supprimer cette ligne)
        td.innerHTML = name;
    }
    //On ajoute la ligne créée au tableau : attention, sur firefox on peut ajouter directement au tableau, mais IE ajoute par défaut un noeud tbody à la table
    if(tableau.firstChild.tagName == 'TBODY'){
        tableau.firstChild.appendChild(tr);
    }
    else{
        tableau.appendChild(tr);
    }
}

var gloablCategorie;
var emploi;
var secteuractivite;
var etablissement;
var requete = null;
var globalX="";
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
function loadRecherche(e){
    creerRequete();
    gloablCategorie=e;
    url='profil-recherche.php?get='+e;
    requete.open("GET", url, true);
    requete.onreadystatechange = actualiserSecteur;
  	requete.send(null);
}
function actualiserSecteur(){
  if(requete.readyState==4){
    if(requete.status==200){
      var champs = JSON.parse(requete.responseText);
      n=champs.length;
      i=0;
      if(gloablCategorie=="secteuractivite"){
        secteuractivite='';
        while(i<n){
            secteuractivite=secteuractivite+"<option value='"+champs[i].id+"'>"+champs[i].libelle+"</option>";
            i++;
        }
      }
      if(gloablCategorie=="emploi"){
        emploi='';
        while(i<n){
            emploi=emploi+"<option value='"+champs[i].id+"'>"+champs[i].libelle+"</option>";
            i++;
        }
      }
      if(gloablCategorie=="etablissement"){
        etablissement='';
        while(i<n){
            etablissement=etablissement+"<option value='"+champs[i].id+"'>"+champs[i].nomEta+"</option>";
            i++;
        }
      }
    }
  }
}
function addRowTravail(tableau){
    tableau = document.getElementById(tableau);
    //Calcul du nombre de cellule par ligne dans le tableau -> on regarde combien il y a de td dans le premier tr
    var tds = tableau.getElementsByTagName('tr')[0].getElementsByTagName('td').length;
    var arrayLignes = document.getElementById("tableauTravail").rows; //l'array est stocké dans une variable
    var longueur = arrayLignes.length;//on peut donc appliquer la propriété length
    //alert("nb ligne = "+longueur);
    //alert("tds = "+tds); 
    var tr = document.createElement('tr'); //On créé une ligne
    //On ajoute autant les cellules
    for(var i=0; i<tds; i++){
        var name;
        var td = document.createElement('td');
        tr.appendChild(td);
        switch(i){
            case 0:
                name="<select class='select' name='emploi"+longueur+"' required>"+emploi+"</select>";
                break;
            case 1:
                name='<input type="text" class="titre" name="nomEnt'+longueur+'" required/>';
                break;
            case 2:
                name='<input type="text" class="titre" name="adrEnt'+longueur+'" required/>';
                break;
            case 3:
                name="<select class='select' name='secteur"+longueur+"' required>"+secteuractivite+"</select>";
                break;
            case 4:
                name='<input type="date" class="titre" name="dateDebut'+longueur+'" required/>';
                break;
            case 5:
                name='<input type="date" class="titre" name="dateFin'+longueur+'" required/>';
                break;
        }
        //Si on veut mettre du contenu dans la cellule créée, ça se passe ici (sinon il suffit de supprimer cette ligne)
        td.innerHTML = name;
    }

    //On ajoute la ligne créée au tableau : attention, sur firefox on peut ajouter directement au tableau, mais IE ajoute par défaut un noeud tbody à la table
    if(tableau.firstChild.tagName == 'TBODY'){
        tableau.firstChild.appendChild(tr);
    }
    else{
        tableau.appendChild(tr);
    }
}

function addRowStage(tableau){
    tableau = document.getElementById(tableau);
    //Calcul du nombre de cellule par ligne dans le tableau -> on regarde combien il y a de td dans le premier tr
    var tds = tableau.getElementsByTagName('tr')[0].getElementsByTagName('td').length;
    var arrayLignes = document.getElementById("tableauStage").rows; //l'array est stocké dans une variable
    var longueur = arrayLignes.length;//on peut donc appliquer la propriété length
    //alert("nb ligne = "+longueur);
    //alert("tds = "+tds);
    var tr = document.createElement('tr'); //On créé une ligne
    //On ajoute autant les cellules
    for(var i=0; i<tds; i++){
        var td = document.createElement('td');
        tr.appendChild(td);
        switch(i){
            case 0:
                name='<input type="text" class="titre" name="objectifStage'+longueur+'" required/>';
                break;
            case 1:
                name='<input type="text" class="titre" name="nomEntrepriseStage'+longueur+'" required/>';
                break;
            case 2:
                name='<input type="text" class="titre" name="adresseStage'+longueur+'" required/>';
                break;
            case 3:
                name="<select class='select' name='secteurStage"+longueur+"' required>"+secteuractivite+"</select>";
                break;
            case 4:
                name='<input type="date" class="titre" name="datedebutStage'+longueur+'" required/>';
                break;
            case 5:
                name='<input type="date" class="titre" name="datefinStage'+longueur+'" required/>';
                break;
        }
        //Si on veut mettre du contenu dans la cellule créée, ça se passe ici (sinon il suffit de supprimer cette ligne)
        td.innerHTML = name;
    }

    //On ajoute la ligne créée au tableau : attention, sur firefox on peut ajouter directement au tableau, mais IE ajoute par défaut un noeud tbody à la table
    if(tableau.firstChild.tagName == 'TBODY'){
        tableau.firstChild.appendChild(tr);
    }
    else{
        tableau.appendChild(tr);
    }
}

function deleteRowEtude(t)
{
    document.getElementById(t).lastChild.deleteRow();
}
loadRecherche('emploi');
setTimeout(function(){
    //Cette requete attend la fin de la précédente requete, vue que c'est de l'AJAX;
    loadRecherche('secteuractivite');
},250);
setTimeout(function(){
    //Cette requete attend la fin de la précédente requete, vue que c'est de l'AJAX;
    loadRecherche('etablissement');
},250);
    
