l=1;//déclaration de l en variable gloable utilisé dans deux fonctions différentes mais même utilité d'incrémentation des valeurs d'attributs name et boucle while
n=1;//déclaration de n en variable gloable utilisé dans deux fonctions différentes mais même utilité d'incrémentation des valeurs d'attributs name et boucle while
function afficheFormulaire(text,text2,text3){
    var totalInfo=text.split('/');//sinde la chaine text en un tableau de chaine 
    var formation=text2.split('/');//sinde la chaine text2 en un tableau de chaine 
    var stage=text3.split('/');//sinde la chaine text3 en un tableau de chaine 
    
    //récupération de l'élement Form dans profil.php pour supprimer toutes les balises enfants
    var element = document.getElementById("modifForm");
    if(element!=null){
            element.parentNode.removeChild(element);
    }
    
    //creation de la balise form dans le div principal avec les attributs nécéssaire
    divPrincipal = document.getElementById("divPrincipal");
    formEnfant = document.createElement("form");
    formEnfant.setAttribute("id","profil");
    formEnfant.setAttribute("method","GET");
    formEnfant.setAttribute("action","../backoffice/traitement/traitement_profil_formulaire.php");
    formEnfant.setAttribute("name","formulaire");
    formEnfant.setAttribute("onsubmit","return verifForm(this)");
    divPrincipal.appendChild(formEnfant);

    //creation de la partie 1 du formulaire
    formForumlaire= document.getElementById("profil");//récupération de la balise Form par l'id
    divEnfant = document.createElement("div");//création du premier bloc pour ensuite y mettre les infos requise
    divEnfant.setAttribute("id","part1");//ajout de l'attribut id
    divEnfant.setAttribute("class","box-Secondaire");//ajout de l'attribut class
    formForumlaire.appendChild(divEnfant);//ajout du fieldset dans la balise form

    partieFormulaire1= document.getElementById("part1");//récupération du div créé au dessus
    numTitrePartie1 = document.createElement("h1");//création d'une balise h1 pour y mettre l'intitulé de la première partie du formulaire
    numTitrePartie1.setAttribute("id","titre1");//ajout d'un attribut id à la balise h1
    partieFormulaire1.appendChild(numTitrePartie1);//ajout de la balise legend dans le fieldset
    h11= document.getElementById("titre1");//récupération du fieldset
    span1=document.createElement("span");//création d'une balise span pour y mettre le numéro de la partie
    span1.setAttribute("id","number1");//ajout d'un attribut id à la balise span
    span1.setAttribute("class","number");//ajout d'un attribut class à la balise span
    h11.appendChild(span1);//ajout de la balise span dans la balise legend
    remplaceTexte(span1,"1");//ajout de texte dans la balise span
    remplaceTexte(h11,"Qui êtes-vous?");//ajout de texte dans la balise legend
    inputNom=document.createElement("input");//création de la balise input pour le Nom de la personne
    inputNom.setAttribute("id","nom");//ajout de l'attirbut id à l'input
    inputNom.setAttribute("class","titre");//ajout de l'attribut class à l'input
    inputNom.setAttribute("name","nom");//ajout de l'attribut name à l'input
    inputNom.setAttribute("placeholder","nom : ");
    inputNom.setAttribute("onblur","verifNom(this);");//ajout de l'attribut onblur à l'input pour la vérification de champ
    //si l'élement à l'index 0 de la variable totalInfo éxiste alors l'input est remplit avec l'info contenu à l'index 0
    if(totalInfo[0]!==null){
        inputNom.setAttribute("value",totalInfo[0].replace(/-/gi," "));//utilisation de la fonction replace pour remplacer les - par des espaces
    }
    partieFormulaire1.appendChild(inputNom);//ajout de l'input dans le fieldset
    //création d'une balise p pour informer l'utilisateur s'il y a un problème sur l'input
    erreurnom=document.createElement("p");
    erreurnom.setAttribute("id","erreurnom");
    partieFormulaire1.appendChild(erreurnom);//ajout de la balise p dans le fieldset
    inputPrenom=document.createElement("input");//création de la balise input pour le prénom
    inputPrenom.setAttribute("name","prenom");//ajout de l'attribut name à l'input
    inputPrenom.setAttribute("id","prenom");//ajout de l'attirbut id à l'input
    inputPrenom.setAttribute("class","titre");//ajout de l'attribut type à l'input
    inputPrenom.setAttribute("placeholder","Prénom : ");
    inputPrenom.setAttribute("onblur","verifPrenom(this);");//ajout de l'attribut onblur à l'input pour la vérification de champ
    //si l'élement à l'index 1 de la variable totalInfo éxiste alors l'input  est remplit avec l'info contenu à l'index 1
    if(totalInfo[1]!==null){
        inputPrenom.setAttribute("value",totalInfo[1].replace(/-/gi," "));//utilisation de la fonction replace pour remplacer les - par des espaces
    }
    partieFormulaire1.appendChild(inputPrenom);//ajout de l'input dans le fieldset
    //création d'une balise p pour informer l'utilisateur s'il y a un problème sur l'input
    erreurprenom=document.createElement("p");
    erreurprenom.setAttribute("id","erreurprenom");
    partieFormulaire1.appendChild(erreurprenom);//ajout de la balise p dans le fieldset
    inputDtn=document.createElement("input");//création de la balise input pour le date de naissance
    inputDtn.setAttribute("name","dtn");//ajout de l'attribut name à l'input
    inputDtn.setAttribute("id","dtn");//ajout de l'attirbut id à l'input
    inputDtn.setAttribute("class","titre");//ajout de l'attribut type à l'input
    inputDtn.setAttribute("placeholder","Date de naissance : ");
    inputDtn.setAttribute("onblur","verifDtn(this);");//ajout de l'attribut onblur à l'input pour la vérification de champ
    //si l'élement à l'index 2 de la variable totalInfo éxiste alors l'input  est remplit avec l'info contenu à l'index 2
    if(totalInfo[2]!==null){
        inputDtn.setAttribute("value",totalInfo[2]);//utilisation de la fonction replace pour remplacer les - par des espaces
    }
    partieFormulaire1.appendChild(inputDtn);//ajout de l'input dans le fieldset
    //création d'une balise p pour informer l'utilisateur s'il y a un problème sur l'input
    erreurdtn=document.createElement("p");
    erreurdtn.setAttribute("id","erreurdtn");
    partieFormulaire1.appendChild(erreurdtn);//ajout de la balise p dans le fieldset
    /*
     * le principe de création de la partie 1 du formulaire est le même pour la partie 2, la 3 et la 5
     */

    //creation de la  partie 2 du formulaire
    divEnfant2 = document.createElement("div");//création du deuxième bloc pour ensuite y mettre les infos requise
    divEnfant2.setAttribute("id","part2");//ajout de l'attribut id au div
    divEnfant2.setAttribute("class","box-Secondaire");//ajout de l'attribut class
    formForumlaire.appendChild(divEnfant2);//ajout du fieldset dans la balise form
    partieFormulaire2= document.getElementById("part2");//récupération du fieldset
    numTitrePartie2 = document.createElement("h1");//création d'une balise h1 pour y mettre l'intitulé de la première partie du formulaire
    numTitrePartie2.setAttribute("id","titre2");//ajout de l'attribut id sur la balise legend
    partieFormulaire2.appendChild(numTitrePartie2);//ajout du de la balise legend dans le fieldset
    h12= document.getElementById("titre2");//récupération du legend
    span2=document.createElement("span");//création de la balise span
    span2.setAttribute("id","number2");//ajout de l'attribut id à la balise span
    span2.setAttribute("class","number");//ajout de l'attribut class à la balise span
    h12.appendChild(span2);//ajout de la balise span dans la balise legend
    remplaceTexte(span2,"2");//ajout de texte dans la balise span
    remplaceTexte(h12,"Votre passage dans l'établissement");//ajout de texte dans la balise legend
    pAnEntre = document.createElement("p");//création d'une balise p
    pAnEntre.setAttribute("for","anEntre");//ajout de l'attribut for dans la balise p
    partieFormulaire2.appendChild(pAnEntre);//ajout du p dans le fieldset
    remplaceTexte(pAnEntre,"En quelle année êtes-vous entré(e)?");//ajout de texte dans la balise p
    selectAnEntre = document.createElement("select");//création de la balise select pour une liste déroulante
    selectAnEntre.setAttribute("name","anEntre");//ajout de l'attribut name à la balise select
    selectAnEntre.setAttribute("id","anEntre");//ajout de l'attribut id à la balise select
    selectAnEntre.setAttribute("class","select");//ajout de l'attribut id à la balise select
    selectAnEntre.setAttribute("onclick","verifAnEntre(this);");//ajout de l'attribut onclick pour la vérification
    partieFormulaire2.appendChild(selectAnEntre);//ajout du select dans le fieldset
    optionAnEntre0 = document.createElement("option");//création de la première option du select pour commencer à blanc
    optionAnEntre0.setAttribute("value"," ");
    selectAnEntre.appendChild(optionAnEntre0);//ajout de la première option dans le select
     /*
     * ajout dynamique des options, les options sont des années donc on commence à 1980
     * et on va jusqu'à l'année actuelle grace la fonction Date() la récupère.
     */
    var i=1980;
    var ladate=new Date();
    //tant que i est inférieur à l'année actuelle la boucle continue
    while(i<=ladate.getFullYear()){
        optionAnEntre = document.createElement("option");//création de la balise option
        optionAnEntre.setAttribute("value",i);//ajout d'une valeur à la balise en fonction i
        selectAnEntre.appendChild(optionAnEntre);//ajout de l'option dans le select
        remplaceTexte(optionAnEntre,i);//ajout de l'année en tant que texte dans la balise option
        //si l'élement à l'index 3 de la variable totalInfo éxiste alors l'option est selectionné en fonction de la valeur de l'élément à l'index 3
         if(totalInfo[3]==i){
            $('#anEntre>option[value="'+i+'"]').attr('selected', true);
        }
        i++;//incrémentation de i pour continuer la boucle 
    }
    //document.getElementById("anEntre").selectedIndex="-1";
    erreuranentre=document.createElement("p");//création d'une balise p pour informer l'utilisateur s'il y a un problème sur le select 
    erreuranentre.setAttribute("id","erreuranentre");
    partieFormulaire2.appendChild(erreuranentre);//ajout de la balise p dans le fieldset
    
    //le principe du select au dessus est le même que le suivant
    pAnSortie = document.createElement("p");
    pAnSortie.setAttribute("for","anSortie");
    partieFormulaire2.appendChild(pAnSortie);
    remplaceTexte(pAnSortie,"En quelle année êtes-vous sorti(e)?");
    selectAnSortie = document.createElement("select");
    selectAnSortie.setAttribute("name","anSortie");
    selectAnSortie.setAttribute("id","anSortie");
    selectAnSortie.setAttribute("class","select");//ajout de l'attribut id à la balise select
    selectAnSortie.setAttribute("onclick","verifAnSortie(this);");
    partieFormulaire2.appendChild(selectAnSortie);
    optionAnSortie0 = document.createElement("option");
    optionAnSortie0.setAttribute("value"," ");
    selectAnSortie.appendChild(optionAnSortie0);
    var j=1980;
    while(j<=ladate.getFullYear()){
        optionAnSortie = document.createElement("option");
        optionAnSortie.setAttribute("value",j);
        selectAnSortie.appendChild(optionAnSortie);
        remplaceTexte(optionAnSortie,j);
        if(totalInfo[4]==j){
            $('#anSortie>option[value="'+j+'"]').attr('selected', true);
        }
        j++;
    }
    //document.getElementById("anSortie").selectedIndex="-1";
    erreuransortie=document.createElement("p");
    erreuransortie.setAttribute("id","erreuransortie");
    partieFormulaire2.appendChild(erreuransortie);
    
    //le principe du select au dessus est le même que le suivant mais ici en ne 
    //gère pas des années mais des types de BTS et l'ajout n'est pas dynamique
    pCursur = document.createElement("p");
    pCursur.setAttribute("for","cursus");
    partieFormulaire2.appendChild(pCursur);
    remplaceTexte(pCursur,"Cursus poursuivi dans l'établissement");
    selectCursus = document.createElement("select");
    selectCursus.setAttribute("name","cursus");
    selectCursus.setAttribute("id","cursus");
    selectCursus.setAttribute("class","select");//ajout de l'attribut id à la balise select
    selectCursus.setAttribute("onclick","verifCursus(this);");
    partieFormulaire2.appendChild(selectCursus);
    optionCursus0 = document.createElement("option");
    optionCursus0.setAttribute("value"," ");
    selectCursus.appendChild(optionCursus0);
    optionCursus = document.createElement("option");
    optionCursus.setAttribute("value","BTS AM");
    selectCursus.appendChild(optionCursus);
    remplaceTexte(optionCursus,"BTS Assistant de manager");
    optionCursus1 = document.createElement("option");
    optionCursus1.setAttribute("value","BTS AG");
    selectCursus.appendChild(optionCursus1);
    remplaceTexte(optionCursus1,"BTS Assistant de gestion PME-PMI");
    optionCursus2 = document.createElement("option");
    optionCursus2.setAttribute("value","BTS CGO");
    selectCursus.appendChild(optionCursus2);
    remplaceTexte(optionCursus2,"BTS Comptabilité et gestion des organisations");
    optionCursus3 = document.createElement("option");
    optionCursus3.setAttribute("value","BTS SIO");
    selectCursus.appendChild(optionCursus3);
    remplaceTexte(optionCursus3,"BTS Services Informatiques aux Organisations");
    optionCursus4 = document.createElement("option");
    optionCursus4.setAttribute("value","BTS MUC");
    selectCursus.appendChild(optionCursus4);
    remplaceTexte(optionCursus4,"BTS Management des unités commerciales");
    optionCursus5 = document.createElement("option");
    optionCursus5.setAttribute("value","BTS NRC");
    selectCursus.appendChild(optionCursus5);
    remplaceTexte(optionCursus5,"BTS Négociation et relation client");
    optionCursus6 = document.createElement("option");
    optionCursus6.setAttribute("value","BTS TPL");
    selectCursus.appendChild(optionCursus6);
    remplaceTexte(optionCursus6,"BTS Transport et Prestations logistiques");
    optionCursus7= document.createElement("option");
    optionCursus7.setAttribute("value","BTS C");
    selectCursus.appendChild(optionCursus7);
    remplaceTexte(optionCursus7,"BTS Communication");
    if(totalInfo[5].replace("-"," ")=="BTS AM"){
        $('#cursus>option[value="'+"BTS AM"+'"]').attr('selected', true);
    }
    else{
        if(totalInfo[5].replace("-"," ")=="BTS AG"){
            $('#cursus>option[value="'+"BTS AG"+'"]').attr('selected', true);
        }
        else
        {
             if(totalInfo[5].replace("-"," ")=="BTS CGO"){
                $('#cursus>option[value="'+"BTS CGO"+'"]').attr('selected', true);
            }
            else{
                if(totalInfo[5].replace("-"," ")=="BTS SIO"){
                    $('#cursus>option[value="'+"BTS SIO"+'"]').attr('selected', true);
                }
                else{
                    if(totalInfo[5].replace("-"," ")=="BTS MUC"){
                        $('#cursus>option[value="'+"BTS MUC"+'"]').attr('selected', true);
                    }
                    else{
                         if(totalInfo[5].replace("-"," ")=="BTS NRC"){
                             $('#cursus>option[value="'+"BTS NRC"+'"]').attr('selected', true);
                        }
                        else{
                            if(totalInfo[5].replace("-"," ")=="BTS TPL"){
                                 $('#cursus>option[value="'+"BTS TPL"+'"]').attr('selected', true);
                            }
                            else{
                                if(totalInfo[5].replace("-"," ")=="BTS C"){
                                    $('#cursus>option[value="'+"BTS C"+'"]').attr('selected', true);
                                 }
                            }
                        }
                    }
                }
                
            }
        }
    }
    erreurcursus=document.createElement("p");
    erreurcursus.setAttribute("id","erreurcursus");
    partieFormulaire2.appendChild(erreurcursus);

    //creation de la partie 3 du formulaire
    divEnfant3 = document.createElement("div");
    divEnfant3.setAttribute("id","part3");
    divEnfant3.setAttribute("class","box-Secondaire");//ajout de l'attribut class
    formForumlaire.appendChild(divEnfant3);
    partieFormulaire3= document.getElementById("part3");
    numTitrePartie3 = document.createElement("h1");
    numTitrePartie3.setAttribute("id","titre3");
    partieFormulaire3.appendChild(numTitrePartie3);
    h13= document.getElementById("titre3");
    span3=document.createElement("span");
    span3.setAttribute("id","number3");
    span3.setAttribute("class","number");
    h13.appendChild(span3);
    remplaceTexte(span3,"3");
    remplaceTexte(h13,"Comment vous contacter?");
    inputAdresse=document.createElement("input");
    inputAdresse.setAttribute("name","adresse");
    inputAdresse.setAttribute("id","adresse");
    inputAdresse.setAttribute("class","titre");
    inputAdresse.setAttribute("placeholder","Adresse : ");
    inputAdresse.setAttribute("onblur","verifAdresse(this);");
    if(totalInfo[6]!==null){
        inputAdresse.setAttribute("value",totalInfo[6].replace(/-/gi," "));
    }
    partieFormulaire3.appendChild(inputAdresse);
    erreuradresse=document.createElement("p");
    erreuradresse.setAttribute("id","erreuradresse");
    partieFormulaire3.appendChild(erreuradresse);
    inputCp=document.createElement("input");
    inputCp.setAttribute("name","cp");
    inputCp.setAttribute("id","cp");
    inputCp.setAttribute("class","titre");
    inputCp.setAttribute("placeholder","Code postal : ");
    inputCp.setAttribute("onblur","verifCp(this);"); 
    if(totalInfo[7]!==null){
        inputCp.setAttribute("value",totalInfo[7]);
    }
    partieFormulaire3.appendChild(inputCp);
    erreurcp=document.createElement("p");
    erreurcp.setAttribute("id","erreurcp");
    partieFormulaire3.appendChild(erreurcp);
    inputVille=document.createElement("input");
    inputVille.setAttribute("name","ville");
    inputVille.setAttribute("id","ville");
    inputVille.setAttribute("class","titre");
    inputVille.setAttribute("placeholder","Ville : ");
    inputVille.setAttribute("onblur","verifVille(this);"); 
    if(totalInfo[8]!==null){
        inputVille.setAttribute("value",totalInfo[8].replace(/-/gi," "));
    }
    partieFormulaire3.appendChild(inputVille);
    erreurville=document.createElement("p");
    erreurville.setAttribute("id","erreurville");
    partieFormulaire3.appendChild(erreurville);
    inputTelfixe=document.createElement("input");
    inputTelfixe.setAttribute("name","telfixe");
    inputTelfixe.setAttribute("id","telfixe");
    inputTelfixe.setAttribute("class","titre");
    inputTelfixe.setAttribute("placeholder","Téléphone fixe : ");
    inputTelfixe.setAttribute("onblur","verifTelFixe(this);"); 
    if(totalInfo[9]!==null){
        inputTelfixe.setAttribute("value",totalInfo[9]);
    }
    partieFormulaire3.appendChild(inputTelfixe);
    erreurtelfixe=document.createElement("p");
    erreurtelfixe.setAttribute("id","erreurtelfixe");
    partieFormulaire3.appendChild(erreurtelfixe);
    inputMobile=document.createElement("input");
    inputMobile.setAttribute("name","mobile");
    inputMobile.setAttribute("id","mobile");
    inputMobile.setAttribute("class","titre");
    inputMobile.setAttribute("placeholder","Mobile : ");
    inputMobile.setAttribute("onblur","verifMobile(this);"); 
    if(totalInfo[10]!==null){
        inputMobile.setAttribute("value",totalInfo[10]);
    }
    partieFormulaire3.appendChild(inputMobile);
     erreurmobile=document.createElement("p");
    erreurmobile.setAttribute("id","erreurmobile");
    partieFormulaire3.appendChild(erreurmobile);
    inputEmail=document.createElement("input");
    inputEmail.setAttribute("name","email");
    inputEmail.setAttribute("id","email");
    inputEmail.setAttribute("class","titre");
    inputEmail.setAttribute("placeholder","Email : ");
    inputEmail.setAttribute("onblur","verifEmail(this);"); 
    if(totalInfo[11]!==null){
        inputEmail.setAttribute("value",totalInfo[11]);
    }
    partieFormulaire3.appendChild(inputEmail);
     erreuremail=document.createElement("p");
    erreuremail.setAttribute("id","erreuremail");
    partieFormulaire3.appendChild(erreuremail);


    /*
     * creation de la partie 4 du formulaire
     * toujours le même principe de création d'un bloc d'information
     * avec le fieldset,legend et span
     */
    divEnfant4 = document.createElement("div");
    divEnfant4.setAttribute("id","part4");
    divEnfant4.setAttribute("class","box-Secondaire");//ajout de l'attribut class
    formForumlaire.appendChild(divEnfant4);
    partieFormulaire4= document.getElementById("part4");
    numTitrePartie4 = document.createElement("h1");
    numTitrePartie4.setAttribute("id","titre4");
    partieFormulaire4.appendChild(numTitrePartie4);
    h14= document.getElementById("titre4");
    span4=document.createElement("span");
    span4.setAttribute("id","number4");
    span4.setAttribute("class","number");
    h14.appendChild(span4);
    remplaceTexte(span4,"4");
    remplaceTexte(h14,"Poursuite d'études");
    
    /*
     * création d'un tableau à 4 colonnes
     */
    tabFormation=document.createElement("table");
    tabFormation.setAttribute("id","tableauFormation");
    tr1NomCol=document.createElement("tr");
    thFormation=document.createElement("th");
    remplaceTexte(thFormation,"Formation");
    tr1NomCol.appendChild(thFormation);
    thAn=document.createElement("th");
    remplaceTexte(thAn,"Année");
    tr1NomCol.appendChild(thAn);
    thDiscipline=document.createElement("th");
    remplaceTexte(thDiscipline,"Discipline");
    tr1NomCol.appendChild(thDiscipline);
    thEtablissement=document.createElement("th");
    remplaceTexte(thEtablissement,"Etablissement");
    tr1NomCol.appendChild(thEtablissement);
    tabFormation.appendChild(tr1NomCol);
    
    /*
     * ici une première ligne avec des inputs pour rentrer les informations
     * est ajouté en dur dans le tableau car si l'utilisateur n'a rien rentré
     * il lui faut au minimum une ligne. le principe des inputs est le même
     * que pour les autres parties du formulaire
     */
    tr2Col=document.createElement("tr");
    tdInputFormation=document.createElement("td");
    inputFormation=document.createElement("input");
    inputFormation.setAttribute("name","formation0");
    inputFormation.setAttribute("id","formation");
    inputFormation.setAttribute("class","titre");
    inputFormation.setAttribute("placeholder","Formation : ");
    inputFormation.setAttribute("onblur","verifFormation(this);"); 
    if(formation[1]!=undefined){
        inputFormation.setAttribute("value",formation[1].replace(/-/gi," "));
    }
    partieFormulaire4.appendChild(inputFormation);
    erreurformation=document.createElement("p");
    erreurformation.setAttribute("id","erreurformation");
    partieFormulaire4.appendChild(erreurformation);
    tdInputFormation.appendChild(inputFormation);
    tr2Col.appendChild(tdInputFormation);

    tdSelectAn=document.createElement("td");
    selectAnnee = document.createElement("select");
    selectAnnee.setAttribute("name","annee0");
    selectAnnee.setAttribute("id","annee0");
    selectAnnee.setAttribute("class","selectForm");
    selectAnnee.setAttribute("onclick","verifAnnee(this);");
    partieFormulaire4.appendChild(selectAnnee);
    optionAnnee0 = document.createElement("option");
    optionAnnee0.setAttribute("value","");
    selectAnnee.appendChild(optionAnnee0);
    $('#annee0>option[value="'+""+'"]').attr('selected', true);
    var k=1980;
    while(k<=ladate.getFullYear()){
        optionAnnee = document.createElement("option");
        optionAnnee.setAttribute("value",k);
        selectAnnee.appendChild(optionAnnee);
        remplaceTexte(optionAnnee,k);
        if(parseInt(formation[2])===k){
            $('#annee0>option[value="'+k+'"]').attr('selected', true);
        }
        k++;
    }
    //document.getElementById("anSortie").selectedIndex="-1";
    erreurannee=document.createElement("p");
    erreurannee.setAttribute("id","erreurannee");
    partieFormulaire4.appendChild(erreurannee);
    tdSelectAn.appendChild(selectAnnee);
    tr2Col.appendChild(tdSelectAn);

    tdInputDiscipline=document.createElement("td");
    inputDiscipline=document.createElement("input");
    inputDiscipline.setAttribute("name","discipline0");
    inputDiscipline.setAttribute("id","discipline");
    inputDiscipline.setAttribute("class","titre");
    inputDiscipline.setAttribute("placeholder","Discipline : ");
    inputDiscipline.setAttribute("onblur","verifDiscipline(this);"); 
    if(formation[3]!==undefined){
        inputDiscipline.setAttribute("value",formation[3].replace(/-/gi," "));
    }
    partieFormulaire4.appendChild(inputDiscipline);
    erreurdiscipline=document.createElement("p");
    erreurdiscipline.setAttribute("id","erreurdiscipline");
    partieFormulaire4.appendChild(erreurdiscipline);
    tdInputDiscipline.appendChild(inputDiscipline);
    tr2Col.appendChild(tdInputDiscipline);

    tdInputEtablissement=document.createElement("td");
    inputEtablissement=document.createElement("input");
    inputEtablissement.setAttribute("name","etablissement0");
    inputEtablissement.setAttribute("id","etablissement");
    inputEtablissement.setAttribute("class","titre");
    inputEtablissement.setAttribute("placeholder","Etablissement : ");
    //inputEtablissement.setAttribute("onblur","verifDiscipline(this);"); 
    if(formation[4]!==undefined){
        inputEtablissement.setAttribute("value",formation[4].replace(/-/gi," "));
    }
    partieFormulaire4.appendChild(inputEtablissement);
    /*erreurdiscipline=document.createElement("p");
    erreurdiscipline.setAttribute("id","erreurdiscipline");
    partieFormulaire4.appendChild(erreurdiscipline);*/
    tdInputEtablissement.appendChild(inputEtablissement);
    tr2Col.appendChild(tdInputEtablissement);

    tabFormation.appendChild(tr2Col);
    partieFormulaire4.appendChild(tabFormation);
    
    /*
     * ici l'ajout d'une ligne dans le tableau est dynamique en fonction des informations
     * que l'utilisateur a déjà rentré. le nombre de ligne du tableau est déterminé par
     * par le nombre d'information, 4 informations sur une ligne donc s'il y a 8 informations
     * il y a 2 lignes.
     */
    var nbLigne=(formation.length-1)/4;
    var m=5;//la ligne 0 du tableau a été ajouté au tableau avec ses informations donc les 4 premières alors on prend m à 5
            // de plus m est incrémenté après chaque ajout d'info dans un input
    while(l<nbLigne)//l a été instancié à 1 au préalable car la ligne 0 du tableau a été ajouté en dur
    {
        tr2Col=document.createElement("tr");
        tdInputFormation=document.createElement("td");
        inputFormation=document.createElement("input");
        inputFormation.setAttribute("name","formation"+l);
        inputFormation.setAttribute("id","formation");
        inputFormation.setAttribute("class","titre");
        inputFormation.setAttribute("placeholder","Formation : ");
        inputFormation.setAttribute("onblur","verifFormation(this);"); 
        if(formation[m]!==undefined){
            inputFormation.setAttribute("value",formation[m].replace(/-/gi," "));
        }
        m++;
        partieFormulaire4.appendChild(inputFormation);
        erreurformation=document.createElement("p");
        erreurformation.setAttribute("id","erreurformation");
        partieFormulaire4.appendChild(erreurformation);
        tdInputFormation.appendChild(inputFormation);
        tr2Col.appendChild(tdInputFormation);

        tdSelectAn=document.createElement("td");
        selectAnnee = document.createElement("select");
        selectAnnee.setAttribute("name","annee"+l);
        selectAnnee.setAttribute("id","annee"+l);
        selectAnnee.setAttribute("class","selectForm");
        selectAnnee.setAttribute("onclick","verifAnnee(this);");
        partieFormulaire4.appendChild(selectAnnee);
        optionAnnee0 = document.createElement("option");
        optionAnnee0.setAttribute("value","");
        selectAnnee.appendChild(optionAnnee0);
        $('#annee'+l+'>option[value="'+""+'"]').attr('selected', true);
        var k=1980;
        while(k<=ladate.getFullYear()){
            optionAnnee = document.createElement("option");
            optionAnnee.setAttribute("value",k);
            selectAnnee.appendChild(optionAnnee);
            remplaceTexte(optionAnnee,k);
            if(parseInt(formation[m])===k){
                $('#annee'+l+'>option[value="'+k+'"]').attr('selected', true);
            }
            k++;
        }
        m++;
        //document.getElementById("anSortie").selectedIndex="-1";
        erreurannee=document.createElement("p");
        erreurannee.setAttribute("id","erreurannee");
        partieFormulaire4.appendChild(erreurannee);
        tdSelectAn.appendChild(selectAnnee);
        tr2Col.appendChild(tdSelectAn);

        tdInputDiscipline=document.createElement("td");
        inputDiscipline=document.createElement("input");
        inputDiscipline.setAttribute("name","discipline"+l);
        inputDiscipline.setAttribute("id","discipline");
        inputDiscipline.setAttribute("class","titre");
        inputDiscipline.setAttribute("placeholder","Discipline : ");
        inputDiscipline.setAttribute("onblur","verifDiscipline(this);"); 
        if(formation[m]!==undefined){
            inputDiscipline.setAttribute("value",formation[m].replace(/-/gi," "));
        }
        m++;
        partieFormulaire4.appendChild(inputDiscipline);
        erreurdiscipline=document.createElement("p");
        erreurdiscipline.setAttribute("id","erreurdiscipline");
        partieFormulaire4.appendChild(erreurdiscipline);
        tdInputDiscipline.appendChild(inputDiscipline);
        tr2Col.appendChild(tdInputDiscipline);

        tdInputEtablissement=document.createElement("td");
        inputEtablissement=document.createElement("input");
        inputEtablissement.setAttribute("name","etablissement"+l);
        inputEtablissement.setAttribute("id","etablissement");
        inputEtablissement.setAttribute("class","titre");
        inputEtablissement.setAttribute("placeholder","Etablissement : ");
        //inputEtablissement.setAttribute("onblur","verifDiscipline(this);"); 
        if(formation[m]!==undefined){
            inputEtablissement.setAttribute("value",formation[m].replace(/-/gi," "));
        }
        m++;
        partieFormulaire4.appendChild(inputEtablissement);
        /*erreurdiscipline=document.createElement("p");
        erreurdiscipline.setAttribute("id","erreurdiscipline");
        partieFormulaire4.appendChild(erreurdiscipline);*/
        tdInputEtablissement.appendChild(inputEtablissement);
        tr2Col.appendChild(tdInputEtablissement);
        
        tabFormation.appendChild(tr2Col);
        partieFormulaire4.appendChild(tabFormation);
        l++;//incrémentation de l pour passer à la ligne suivante
    }
    l=l-1;//l prend l - 1 pour remettre la variable au nombre exacte de ligne qui ont été ajouté pour une bonne incrémentation dans la fonction ajoutLigneF ensuite
    //création d'une balise a avec du texte et une fonction qui à chaque clique dessus ajoute une
    //ligne au tableau 
    ajoutLigneF=document.createElement("p");
    ajoutLigneF.setAttribute("onclick","ajoutLigneFormation();");
    partieFormulaire4.appendChild(ajoutLigneF);
    remplaceTexte(ajoutLigneF,"cliquez sur moi pour ajouter une ligne");

    //creation de la partie 5 du formulaire
    divEnfant5 = document.createElement("div");
    divEnfant5.setAttribute("id","part5");
    divEnfant5.setAttribute("class","box-Secondaire");//ajout de l'attribut class
    formForumlaire.appendChild(divEnfant5);
    //creation la partie 5 du formulaire
    partieFormulaire5= document.getElementById("part5");
    numTitrePartie5 = document.createElement("h1");
    numTitrePartie5.setAttribute("id","titre5");
    partieFormulaire5.appendChild(numTitrePartie5);
    h15= document.getElementById("titre5");
    span5=document.createElement("span");
    span5.setAttribute("id","number5");
    span5.setAttribute("class","number");
    h15.appendChild(span5);
    remplaceTexte(span5,"5");
    remplaceTexte(h15,"Votre parcours professionnel");
    inputPosteOccupe=document.createElement("input");
    inputPosteOccupe.setAttribute("name","posteoccupe");
    inputPosteOccupe.setAttribute("id","posteoccupe");
    inputPosteOccupe.setAttribute("class","titre");
    inputPosteOccupe.setAttribute("placeholder","Poste occupé : ");
    inputPosteOccupe.setAttribute("onblur","verifPosteOccupe(this);"); 
    if(totalInfo[12]!==null){
        inputPosteOccupe.setAttribute("value",totalInfo[12].replace(/-/gi," "));
    }
    partieFormulaire5.appendChild(inputPosteOccupe);
    erreurposteoccupe=document.createElement("p");
    erreurposteoccupe.setAttribute("id","erreurposteoccupe");
    partieFormulaire5.appendChild(erreurposteoccupe);
    pTypeContrat = document.createElement("p");
    pTypeContrat.setAttribute("for","typeContrat");
    partieFormulaire5.appendChild(pTypeContrat);
    remplaceTexte(pTypeContrat,"Type de contrat de travail");
    selectTypeContrat = document.createElement("select");
    selectTypeContrat.setAttribute("name","typecontrat");
    selectTypeContrat.setAttribute("id","typecontrat");
    selectTypeContrat.setAttribute("class","select");
    selectTypeContrat.setAttribute("onclick","verifTypeContrat(this);");
    partieFormulaire5.appendChild(selectTypeContrat);
    optionTypeContrat0 = document.createElement("option");
    optionTypeContrat0.setAttribute("value","");
    selectTypeContrat.appendChild(optionTypeContrat0);
    $('#typeContrat>option[value="'+""+'"]').attr('selected', true);
    optionTypeContrat = document.createElement("option");
    optionTypeContrat.setAttribute("value","CDI");
    selectTypeContrat.appendChild(optionTypeContrat);
    remplaceTexte(optionTypeContrat,"CDI");
    optionTypeContrat1 = document.createElement("option");
    optionTypeContrat1.setAttribute("value","CDD");
    selectTypeContrat.appendChild(optionTypeContrat1);
    remplaceTexte(optionTypeContrat1,"CDD");
    erreurtypecontrat=document.createElement("p");
    erreurtypecontrat.setAttribute("id","erreurtypecontrat");
    partieFormulaire5.appendChild(erreurtypecontrat);
    if(totalInfo[13]=="CDI"){
        $('#typeContrat>option[value="'+"CDI"+'"]').attr('selected', true);
    }
    else
    { 
        if(totalInfo[13]=="CDD"){
             $('#typeContrat>option[value="'+"CDD"+'"]').attr('selected', true);
        }
    }

    inputEntreprise=document.createElement("input");
    inputEntreprise.setAttribute("name","entreprise");
    inputEntreprise.setAttribute("id","entreprise");
    inputEntreprise.setAttribute("class","titre");
    inputEntreprise.setAttribute("placeholder","Entreprise : ");
    inputEntreprise.setAttribute("onblur","verifEntreprise(this);"); 
    if(totalInfo[14]!==null){
        inputEntreprise.setAttribute("value",totalInfo[14].replace(/-/gi," "));
    }
    partieFormulaire5.appendChild(inputEntreprise);
    erreurentreprise=document.createElement("p");
    erreurentreprise.setAttribute("id","erreurentreprise");
    partieFormulaire5.appendChild(erreurentreprise);
    inputAdresseEntreprise=document.createElement("input");
    inputAdresseEntreprise.setAttribute("name","adresseentreprise");
    inputAdresseEntreprise.setAttribute("id","adresseEnt");
    inputAdresseEntreprise.setAttribute("class","titre");
    inputAdresseEntreprise.setAttribute("placeholder","Adresse : ");
    inputAdresseEntreprise.setAttribute("onblur","verifAdresseEntreprise(this);"); 
    if(totalInfo[15]!==null){
        inputAdresseEntreprise.setAttribute("value",totalInfo[15].replace(/-/gi," "));
    }
    partieFormulaire5.appendChild(inputAdresseEntreprise);
    erreuradresseentreprise=document.createElement("p");
    erreuradresseentreprise.setAttribute("id","erreuradresseentreprise");
    partieFormulaire5.appendChild(erreuradresseentreprise);
    inputSecteurAct=document.createElement("input");
    inputSecteurAct.setAttribute("name","secteuractivite");
    inputSecteurAct.setAttribute("id","secteurEnt");
    inputSecteurAct.setAttribute("class","titre");
    inputSecteurAct.setAttribute("placeholder","Secteur d'activité : ");
    inputSecteurAct.setAttribute("onblur","verifSecteurActivite(this);"); 
    if(totalInfo[16]!==null){
        inputSecteurAct.setAttribute("value",totalInfo[16].replace(/-/gi," "));
    }
    partieFormulaire5.appendChild(inputSecteurAct);
    erreursecteuractivite=document.createElement("p");
    erreursecteuractivite.setAttribute("id","erreursecteuractivite");
    partieFormulaire5.appendChild(erreursecteuractivite);
	
    
    /*
     * création de la partie 6 du formulaire
     * le principe est le même que la partie 4 du formulaire
     */
    divEnfant6 = document.createElement("div");
    divEnfant6.setAttribute("id","part6");
    divEnfant6.setAttribute("class","box-Secondaire");//ajout de l'attribut class
    formForumlaire.appendChild(divEnfant6);
    partieFormulaire6= document.getElementById("part6");
    numTitrePartie6 = document.createElement("h1");
    numTitrePartie6.setAttribute("id","titre6");
    partieFormulaire6.appendChild(numTitrePartie6);
    h16= document.getElementById("titre6");
    span6=document.createElement("span");
    span6.setAttribute("id","number6");
    span6.setAttribute("class","number");
    h16.appendChild(span6);
    remplaceTexte(span6,"6");
    remplaceTexte(h16,"Stage");
    
    tabStage=document.createElement("table");
    tabStage.setAttribute("id","tableauStage");
    tr1NomColStage=document.createElement("tr");
    thNom=document.createElement("th");
    remplaceTexte(thNom,"Nom de l'entreprise");
    tr1NomColStage.appendChild(thNom);
    thVille=document.createElement("th");
    remplaceTexte(thVille,"Ville où elle est situé");
    tr1NomColStage.appendChild(thVille);
    tabStage.appendChild(tr1NomColStage);
    
    tr2ColStage=document.createElement("tr");
    tdInputStage=document.createElement("td");
    inputNomStage=document.createElement("input");
    inputNomStage.setAttribute("name","nomStage0");
    inputNomStage.setAttribute("id","nomStage");
    inputNomStage.setAttribute("class","titre");
    inputNomStage.setAttribute("placeholder","Nom de l'entreprise : ");
    //inputNomStage.setAttribute("onblur","verifFormation(this);"); 
    if(stage[1]!=undefined){
        inputNomStage.setAttribute("value",stage[1].replace(/-/gi," "));
    }
    /*erreurformation=document.createElement("p");
    erreurformation.setAttribute("id","erreurformation");
    partieFormulaire4.appendChild(erreurformation);*/
    tdInputStage.appendChild(inputNomStage);
    tr2ColStage.appendChild(tdInputStage);

    tdInputVilleEntreprise=document.createElement("td");
    inputVilleEntreprise=document.createElement("input");
    inputVilleEntreprise.setAttribute("name","villeEntreprise0");
    inputVilleEntreprise.setAttribute("id","villeEntreprise");
    inputVilleEntreprise.setAttribute("class","titre");
    inputVilleEntreprise.setAttribute("placeholder","Ville où elle est situé : ");
    //inputVilleEntreprise.setAttribute("onblur","verifDiscipline(this);"); 
    if(stage[2]!==undefined){
        inputVilleEntreprise.setAttribute("value",stage[2].replace(/-/gi," "));
    }
    /*erreurdiscipline=document.createElement("p");
    erreurdiscipline.setAttribute("id","erreurdiscipline");
    partieFormulaire4.appendChild(erreurdiscipline);*/
    tdInputVilleEntreprise.appendChild(inputVilleEntreprise);
    tr2ColStage.appendChild(tdInputVilleEntreprise);

    tabStage.appendChild(tr2ColStage);
    partieFormulaire6.appendChild(tabStage);
        
    var nbLigne2=(stage.length-1)/2;
    var o=3;
    while(n<nbLigne2)
    {
        tr2ColStage=document.createElement("tr");
        tdInputStage=document.createElement("td");
        inputNomStage=document.createElement("input");
        inputNomStage.setAttribute("name","nomStage"+n);
        inputNomStage.setAttribute("id","nomStage");
        inputNomStage.setAttribute("class","titre");
        inputNomStage.setAttribute("placeholder","Nom de l'entreprise : ");
        //inputNomStage.setAttribute("onblur","verifFormation(this);"); 
        if(stage[o]!=undefined){
            inputNomStage.setAttribute("value",stage[o].replace(/-/gi," "));
        }
        o++;
        /*erreurformation=document.createElement("p");
        erreurformation.setAttribute("id","erreurformation");
        partieFormulaire4.appendChild(erreurformation);*/
        tdInputStage.appendChild(inputNomStage);
        tr2ColStage.appendChild(tdInputStage);

        tdInputVilleEntreprise=document.createElement("td");
        inputVilleEntreprise=document.createElement("input");
        inputVilleEntreprise.setAttribute("name","villeEntreprise"+n);
        inputVilleEntreprise.setAttribute("id","villeEntreprise");
        inputVilleEntreprise.setAttribute("class","titre");
        inputVilleEntreprise.setAttribute("placeholder","Ville où elle est situé : ");
        //inputVilleEntreprise.setAttribute("onblur","verifDiscipline(this);"); 
        if(stage[o]!==undefined){
            inputVilleEntreprise.setAttribute("value",stage[o].replace(/-/gi," "));
        }
        o++;
        /*erreurdiscipline=document.createElement("p");
        erreurdiscipline.setAttribute("id","erreurdiscipline");
        partieFormulaire4.appendChild(erreurdiscipline);*/
        tdInputVilleEntreprise.appendChild(inputVilleEntreprise);
        tr2ColStage.appendChild(tdInputVilleEntreprise);

        tabStage.appendChild(tr2ColStage);
        partieFormulaire6.appendChild(tabStage);
        n++;
    }
    n=n-1;
    ajoutLigneS=document.createElement("p");
    ajoutLigneS.setAttribute("onclick","ajoutLigneStage();");
    partieFormulaire6.appendChild(ajoutLigneS);
    remplaceTexte(ajoutLigneS,"cliquez sur moi pour ajouter une ligne");
    
   /*
    * création d'un input caché avec le nombre de ligne du tableau de la partie 4
    * ceci est ensuite utilisé pour récupérer le nombre de ligne au niveau du traitement
    * (voir traitement_profil_formulaire.php ligne 69)
    */
    nbInfoFormation = document.createElement("input");
    nbInfoFormation.setAttribute("name","nbInfoFormation")
    nbInfoFormation.setAttribute("id","nbInfoFormation")
    nbInfoFormation.setAttribute("type","hidden");
    nbInfoFormation.setAttribute("value",l);
    formForumlaire.appendChild(nbInfoFormation);
    /*
    * création d'un input caché avec le nombre de ligne du tableau de la partie 6
    */
    nbInfoStage = document.createElement("input");
    nbInfoStage.setAttribute("name","nbInfoStage")
    nbInfoStage.setAttribute("id","nbInfoStage")
    nbInfoStage.setAttribute("type","hidden");
    nbInfoStage.setAttribute("value",n);
    formForumlaire.appendChild(nbInfoStage);
    
    //créaction du boutton d'envoi du formulaire
    btnForm = document.createElement("input");
    btnForm.setAttribute("name","soumettre")
    btnForm.setAttribute("type","submit");
    btnForm.setAttribute("class","bouton");
    btnForm.setAttribute("value","Modifier");
    formForumlaire.appendChild(btnForm);
}
//fonction pour ajouter du texte dans une balise HTML
function remplaceTexte(el, texte) {
    if (el != null) {
        var nouveauNoeud = document.createTextNode(texte);
        el.appendChild(nouveauNoeud);
    }
}
//fonction de changement de couleur d'un input
function surligne(champ, test)
{
   if(test)
   {
      champ.style.backgroundColor = "";// si champ à true alors aucune couleur   
   }
   else
   {
      champ.style.backgroundColor = "#D46A6A";// si erreur on met la couleur du fond à rouge      
   }
}

//Fonction pour la vérification du nom 
function verifNom(champ)
{   
   if(champ.value.length > 2 && champ.value.length < 25)//Si le nombre de caractére est inférieur à 2 ou supérieur à 25 alors
   {
      surligne(champ, true);//On appel la fonction surligne et on lui passe en paramétre erreur à true
      document.getElementById("erreurnom").innerHTML = " ";
      return true;
   }
   else//Si la condition n'est pas respecté alors
   {
      surligne(champ, false);//On appel la fonction surligne et on lui passe en paramétre erreur à false
      document.getElementById("erreurnom").innerHTML = "Vous devez saisir votre nom";
      return false;
   }
}
//Fonction pour la vérification du prenom
function verifPrenom(champ)
{   
   if(champ.value.length > 2 && champ.value.length < 25)//Si le nombre de caractére est inférieur à 2 ou supérieur à 25 alors
   {
      surligne(champ, true);//On appel la fonction surligne et on lui passe en paramétre erreur à true
      document.getElementById("erreurprenom").innerHTML = " ";
      return true;
   }
   else//Si la condition n'est pas respecté alors
   {
      surligne(champ, false);//On appel la fonction surligne et on lui passe en paramétre erreur à false
      document.getElementById("erreurprenom").innerHTML = "Vous devez saisir votre prenom";
      return false;
   }
}
//Fonction pour la vérification de la date de naissance
function verifDtn(champ)
{  
   if(champ.value.length!=10)//Si le nombre de caractére n'est pas égal à 10
   {
       surligne(champ, false);//On appel la fonction surligne et on lui passe en paramétre erreur à false
       document.getElementById("erreurdtn").innerHTML = "Vous devez saisir votre date de naissance(AAAA-MM-JJ)";
      return false;
   }
   else//sinon s'il y a bien 10 caractères on vérifie que l'utilisateur a rentré sa date de naissance sous le bon format AAAA-MM-JJ
   {
       var dtn=champ.value.split('-');
       var ladate=new Date();
       //on regarde si l'année de naissance n'est pas inférieur à 1940 et suppérieur à l'année acutelle
       if((parseInt(dtn[0])<1940 || parseInt(dtn[0])>ladate.getFullYear())){
            surligne(champ, false);//On appel la fonction surligne et on lui passe en paramétre erreur à true
            document.getElementById("erreurdtn").innerHTML = "Votre année de naissance est incorrect ";
            return false;
        }
       else
       {
           //on regarde que le mois rentré n'est pas inférieur à 0 ou suppérieur à 12 
           if(( parseInt(dtn[1])<0 || parseInt(dtn[1])>12)){
               surligne(champ, false);//On appel la fonction surligne et on lui passe en paramétre erreur à true
                document.getElementById("erreurdtn").innerHTML = "Votre mois de naissance est incorrect ";
                return false;
           }
           else{
               //on regarde que le jour de naissance n'est pas inférieur à 0 ou suppérieur à 31
               if(( parseInt(dtn[2])<0 || parseInt(dtn[2])>31)){
                   surligne(champ, false);//On appel la fonction surligne et on lui passe en paramétre erreur à true
                    document.getElementById("erreurdtn").innerHTML = "Votre jour de naissance est incorrect ";
                    return false;
               }
               else{
                    surligne(champ, true);//On appel la fonction surligne et on lui passe en paramétre erreur à false
                    document.getElementById("erreurdtn").innerHTML = " ";
                    return true;
               }
           }
            
       }
   }
}
//Fonction pour la vérification de l'année d'entré dans l'établissement
function verifAnEntre(champ){
    if(champ.value!=" ")//Si le champ est différent de vide
   {
      surligne(champ, true);//On appel la fonction surligne et on lui passe en paramétre erreur à true
      document.getElementById("erreuranentre").innerHTML = " ";
      return true;
   }
   else//Si la condition n'est pas respecté alors
   {
      surligne(champ, false);//On appel la fonction surligne et on lui passe en paramétre erreur à false
      document.getElementById("erreuranentre").innerHTML = "Vous devez choisir une date d'entré dans l'établissement";
      return false;
   }
}
//Fonction pour la vérification de l'année de sortie dans l'établissement
function verifAnSortie(champ){
    if(champ.value!=" ")//Si le champ est différent de vide
   {
      surligne(champ, true);//On appel la fonction surligne et on lui passe en paramétre erreur à true
      document.getElementById("erreuransortie").innerHTML = " ";
      return true;
   }
   else//Si la condition n'est pas respecté alors
   {
      surligne(champ, false);//On appel la fonction surligne et on lui passe en paramétre erreur à false
      document.getElementById("erreuransortie").innerHTML = "Vous devez choisir une date d'entré dans l'établissement";
      return false;
   }
}
//Fonction pour la vérification du cursus
function verifCursus(champ){
    if(champ.value!=" ")//Si le champ est différent de vide
   {
      surligne(champ, true);//On appel la fonction surligne et on lui passe en paramétre erreur à true
      document.getElementById("erreurcursus").innerHTML = " ";
      return true;
   }
   else//Si la condition n'est pas respecté alors
   {
      surligne(champ, false);//On appel la fonction surligne et on lui passe en paramétre erreur à false
      document.getElementById("erreurcursus").innerHTML = "Vous devez choisir un cursus";
      return false;
   }
}

//Fonction pour la vérification de l'adresse
function verifAdresse(champ){
     if(champ.value.length > 2 && champ.value.length < 75)//Si le nombre de caractére est inférieur à 2 ou supérieur à 75 alors
   {
      surligne(champ, true);//On appel la fonction surligne et on lui passe en paramétre erreur à true
      document.getElementById("erreuradresse").innerHTML = " ";
      return true;
   }
   else//Si la condition n'est pas respecté alors
   {
      surligne(champ, false);//On appel la fonction surligne et on lui passe en paramétre erreur à false
      document.getElementById("erreuradresse").innerHTML = "Vous devez saisir votre Adresse";
      return false;
   }
}

//Fonction pour la vérification du code postale
function verifCp(champ){
    var i=0;
    var nbN=champ.value.length;
    var totalOK=0;
    while(i<nbN){//pour chaque caractère 
        if(champ.value.charAt(i)>=0 && champ.value.charAt(i)<10)//si le caractère est bien être 0 et 10(exclu)
        {
            totalOK++;
        }
        i++;
    }
    if(nbN==5 && totalOK==5){//un CP est composé de 5 chiffres, s'il y a bien 5chiffres et qu'ils sont tous entre 0 et 10(exclu)
        surligne(champ, true);//On appel la fonction surligne et on lui passe en paramétre erreur à true
        document.getElementById("erreurcp").innerHTML = " ";
        return true;
    }
    else//si la condition est pas respecté
    {
        surligne(champ, false);//On appel la fonction surligne et on lui passe en paramétre erreur à true
        document.getElementById("erreurcp").innerHTML = "Vous devez saisir votre code postal ";
        return false;
    }
}

//Fonction pour la vérification de la ville
function verifVille(champ){
    if(champ.value.length > 2 && champ.value.length < 25)//Si le nombre de caractére est inférieur à 2 ou supérieur à 25 alors
   {
      surligne(champ, true);//On appel la fonction surligne et on lui passe en paramétre erreur à true
      document.getElementById("erreurville").innerHTML = " ";
      return true;
   }
   else//Si la condition n'est pas respecté alors
   {
      surligne(champ, false);//On appel la fonction surligne et on lui passe en paramétre erreur à false
      document.getElementById("erreurville").innerHTML = "Vous devez saisir votre ville";
      return false;
   }
}

//Fonction pour la vérification du numéro de téléphone fix
function verifTelFixe(champ){
    /*
     * le principe de vérification du code postal s'applique aussi
     * pour la vérification du numéro de téléphone fixe
     */
    var i=0;
    var nbN=champ.value.length;
    var totalOK=0;
    while(i<nbN){
        if(champ.value.charAt(i)>=0 && champ.value.charAt(i)<10)
        {
            totalOK++;
        }
        i++;
    }
    if(nbN==10 && totalOK==10){
        surligne(champ, true);//On appel la fonction surligne et on lui passe en paramétre erreur à true
        document.getElementById("erreurtelfixe").innerHTML = " ";
        return true;
    }
    else
    {
        surligne(champ, false);//On appel la fonction surligne et on lui passe en paramétre erreur à true
        document.getElementById("erreurtelfixe").innerHTML = "Vous devez saisir votre numéro de téléphone fixe(sans espace entre les chiffres) ";
        return false;
    }
}

//Fonction pour la vérification du numéro de portable
function verifMobile(champ){
    /*
     * le principe de vérification du code postal s'applique aussi
     * pour la vérification du numéro de portable
     */
    var i=0;
    var nbN=champ.value.length;
    var totalOK=0;
    while(i<nbN){
        if(champ.value.charAt(i)>=0 && champ.value.charAt(i)<10)
        {
            totalOK++;
        }
        i++;
    }
    if(nbN==10 && totalOK==10){
        surligne(champ, true);//On appel la fonction surligne et on lui passe en paramétre erreur à true
        document.getElementById("erreurmobile").innerHTML = " ";
        return true;
    }
    else
    {
        surligne(champ, false);//On appel la fonction surligne et on lui passe en paramétre erreur à true
        document.getElementById("erreurmobile").innerHTML = "Vous devez saisir votre numéro de téléphone mobile(sans espace entre les chiffres) ";
        return false;
    }
}

//Fonction pour la vérification de l'email
function verifEmail(champ)
{
    //mise en place du format d'un email
    var reg = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i');

    if(reg.test(champ.value))//on teste si le champ correspond bien à un email
    {
        surligne(champ, true);//On appel la fonction surligne et on lui passe en paramétre erreur à true
        document.getElementById("erreuremail").innerHTML = " ";
        return true;
    }
    else
    {
         surligne(champ, false);//On appel la fonction surligne et on lui passe en paramétre erreur à false
        document.getElementById("erreuremail").innerHTML = "Vous devez saisir votre email";
        return false;
    }
}
/*
 * les vérifications à suive sont lié aux parties du formulaire non obligatoire
 * à remplir donc le champ peut être vide mais s'il est remplit on vérifie qu'il
 * bon
 */
//Fonction pour la vérification de la formation
function verifFormation(champ){
    if(champ.value=="")
    {
        surligne(champ, true);//On appel la fonction surligne et on lui passe en paramétre erreur à true
        document.getElementById("erreurformation").innerHTML = " ";
        return "empty";
    }
    else
    {
         if(champ.value.length > 2 && champ.value.length < 50)//Si le nombre de caractére est inférieur à 2 ou supérieur à 25 alors
        {
           surligne(champ, true);//On appel la fonction surligne et on lui passe en paramétre erreur à true
           document.getElementById("erreurformation").innerHTML = " ";
           return true;
        }
        else//Si la condition n'est pas respecté alors
        {
           surligne(champ, false);//On appel la fonction surligne et on lui passe en paramétre erreur à false
           document.getElementById("erreurformation").innerHTML = "Vous devez saisir votre formation";
           return false;
        }
        
    }
   
}

//Fonction pour la vérification du cursus
function verifAnnee(champ){
    if(champ.value=="")
    {
        surligne(champ, true);//On appel la fonction surligne et on lui passe en paramétre erreur à true
        document.getElementById("erreurannee").innerHTML = " ";
        return "empty";
    }
    else
    {
        if(champ.value!="")//Si le nombre de caractére est inférieur à 2 ou supérieur à 15 alors
       {
          surligne(champ, true);//On appel la fonction surligne et on lui passe en paramétre erreur à true
          document.getElementById("erreurannee").innerHTML = " ";
          return true;
       }
       else//Si la condition n'est pas respecté alors
       {
          surligne(champ, false);//On appel la fonction surligne et on lui passe en paramétre erreur à false
          document.getElementById("erreurannee").innerHTML = "Vous devez choisir une année de formation";
          return false;
       }
    }
}

//Fonction pour la vérification de la discipline
function verifDiscipline(champ){
    if(champ.value=="")
    {
      surligne(champ, true);//On appel la fonction surligne et on lui passe en paramétre erreur à true
      document.getElementById("erreurdiscipline").innerHTML = " ";
      return "empty";
    }
    else
    {
        if(champ.value.length > 2 && champ.value.length < 50)//Si le nombre de caractére est inférieur à 2 ou supérieur à 25 alors
       {
          surligne(champ, true);//On appel la fonction surligne et on lui passe en paramétre erreur à true
          document.getElementById("erreurdiscipline").innerHTML = " ";
          return true;
       }
       else//Si la condition n'est pas respecté alors
       {
          surligne(champ, false);//On appel la fonction surligne et on lui passe en paramétre erreur à false
          document.getElementById("erreurdiscipline").innerHTML = "Vous devez saisir votre discipline";
          return false;
       }
    }
}

//Fonction pour la vérification du poste occupé
function verifPosteOccupe(champ){
    if(champ.value=="")
    {
      surligne(champ, true);//On appel la fonction surligne et on lui passe en paramétre erreur à true
      document.getElementById("erreurposteoccupe").innerHTML = " ";
      return "empty";
    }
    else
    {
        if(champ.value.length > 2 && champ.value.length < 50)//Si le nombre de caractére est inférieur à 2 ou supérieur à 25 alors
       {
          surligne(champ, true);//On appel la fonction surligne et on lui passe en paramétre erreur à true
          document.getElementById("erreurposteoccupe").innerHTML = " ";
          return true;
       }
       else//Si la condition n'est pas respecté alors
       {
          surligne(champ, false);//On appel la fonction surligne et on lui passe en paramétre erreur à false
          document.getElementById("erreurposteoccupe").innerHTML = "Vous devez saisir votre poste occupé";
          return false;
       }
    }
}
//Fonction pour la vérification du type de contrat
function verifTypeContrat(champ){
    if(champ.value=="")
    {
        surligne(champ, true);//On appel la fonction surligne et on lui passe en paramétre erreur à true
        document.getElementById("erreurtypecontrat").innerHTML = " ";
        return "empty";
    }
    else
    {
        if(champ.value!="")//Si le nombre de caractére est inférieur à 2 ou supérieur à 15 alors
       {
          surligne(champ, true);//On appel la fonction surligne et on lui passe en paramétre erreur à true
          document.getElementById("erreurtypecontrat").innerHTML = " ";
          return true;
       }
       else//Si la condition n'est pas respecté alors
       {
          surligne(champ, false);//On appel la fonction surligne et on lui passe en paramétre erreur à false
          document.getElementById("erreurtypecontrat").innerHTML = "Vous devez choisir votre type de contrat";
          return false;
       }
    }
}
//Fonction pour la vérification de l'entreprise
function verifEntreprise(champ){
     if(champ.value=="")
    {
        surligne(champ, true);//On appel la fonction surligne et on lui passe en paramétre erreur à true
        document.getElementById("erreurentreprise").innerHTML = " ";
        return "empty";
    }
    else
    {
        if(champ.value.length > 2 && champ.value.length < 50)//Si le nombre de caractére est inférieur à 2 ou supérieur à 25 alors
       {
          surligne(champ, true);//On appel la fonction surligne et on lui passe en paramétre erreur à true
          document.getElementById("erreurentreprise").innerHTML = " ";
          return true;
       }
       else//Si la condition n'est pas respecté alors
       {
          surligne(champ, false);//On appel la fonction surligne et on lui passe en paramétre erreur à false
          document.getElementById("erreurentreprise").innerHTML = "Vous devez saisir le nom de votre entreprise";
          return false;
       }
    }
}
//Fonction pour la vérification de l'adresse de l'entreprise
function verifAdresseEntreprise(champ){
    if(champ.value=="")
    {
        surligne(champ, true);//On appel la fonction surligne et on lui passe en paramétre erreur à true
        document.getElementById("erreuradresseentreprise").innerHTML = " ";
        return "empty";
    }
    else
    {
        if(champ.value.length > 2 && champ.value.length < 50)//Si le nombre de caractére est inférieur à 2 ou supérieur à 25 alors
       {
          surligne(champ, true);//On appel la fonction surligne et on lui passe en paramétre erreur à true
          document.getElementById("erreuradresseentreprise").innerHTML = " ";
          return true;
       }
       else//Si la condition n'est pas respecté alors
       {
          surligne(champ, false);//On appel la fonction surligne et on lui passe en paramétre erreur à false
          document.getElementById("erreuradresseentreprise").innerHTML = "Vous devez saisir l'adresse de votre entreprise";
          return false;
       }
    }
}
//Fonction pour la vérification du secteur d'activité de l'entreprise
function verifSecteurActivite(champ){
     if(champ.value=="")
    {
        surligne(champ, true);//On appel la fonction surligne et on lui passe en paramétre erreur à true
        document.getElementById("erreursecteuractivite").innerHTML = " ";
        return "empty";
    }
    else
    {
        if(champ.value.length > 2 && champ.value.length < 50)//Si le nombre de caractére est inférieur à 2 ou supérieur à 25 alors
       {
          surligne(champ, true);//On appel la fonction surligne et on lui passe en paramétre erreur à true
          document.getElementById("erreursecteuractivite").innerHTML = " ";
          return true;
       }
       else//Si la condition n'est pas respecté alors
       {
          surligne(champ, false);//On appel la fonction surligne et on lui passe en paramétre erreur à false
          document.getElementById("erreursecteuractivite").innerHTML = "Vous devez saisir le secteur d'activité de votre entreprise";
          return false;
       }
    }
}


//Fonction permettant la validation ou non du formulaire si tout les tests sont ok
function verifForm(profil)
{
   //on récupère les valeurs de vérification des champs qui sont true, false 
   var nomOk = verifNom(profil.nom);
   var prenomOk = verifPrenom(profil.prenom);
   var dtnOk = verifDtn(profil.dtn);
   var anEntreOk = verifAnEntre(profil.anEntre);
   var anSortieOk = verifAnSortie(profil.anSortie);
   var cursusOK = verifCursus(profil.cursus);
   var adresseOK = verifAdresse(profil.adresse);
   var cpOK = verifCp(profil.cp);
   var villeOK = verifVille(profil.ville);
   var telFixeOK = verifTelFixe(profil.telfixe);
   var mobileOK = verifMobile(profil.mobile);
   var emailOk = verifEmail(profil.email);
   //les 3 premières parties du formulaire étant obligatoire on regarde si tout est OK
   if(nomOk && prenomOk && dtnOk && anEntreOk && anSortieOk && cursusOK && adresseOK && cpOK && villeOK && telFixeOK && mobileOK && emailOk)
   {
       //on récupère les valeurs de vérification des champs qui sont true, false ou empty
        var formationOk = verifFormation(profil.formation);
        var anneeOk = verifAnnee(profil.annee);
        var disciplineOk = verifDiscipline(profil.discipline);
        var posteOccupeOk = verifPosteOccupe(profil.posteoccupe);
        var typeContratOk = verifTypeContrat(profil.typecontrat);
        var entrepriseOk = verifEntreprise(profil.entreprise);
        var adresseEntrepriseOk = verifAdresseEntreprise(profil.adresseentreprise);
        var secteurActiviteOk = verifSecteurActivite(profil.secteuractivite);
        /*
         * ici commence la gestion des différents cas où le formulaire est bon
         * qui sont : partie 1, 2, 3
         *            partie 1, 2, 3, 4
         *            partie 1, 2, 3, 5
         *            partie 1, 2, 3, 4, 5
         */
        if(formationOk=="empty" && anneeOk=="empty" && disciplineOk=="empty" && posteOccupeOk=="empty" && typeContratOk=="empty" && entrepriseOk=="empty" && adresseEntrepriseOk=="empty" && secteurActiviteOk=="empty")
        {
            document.getElementById("profil").submit();
        }
        else
        {
            if(formationOk==true && anneeOk==true && disciplineOk==true && posteOccupeOk=="empty" && typeContratOk=="empty" && entrepriseOk=="empty" && adresseEntrepriseOk=="empty" && secteurActiviteOk=="empty")
            {
                document.getElementById("profil").submit();
            }
            else
            {
                if(formationOk=="empty" && anneeOk=="empty" && disciplineOk=="empty" && posteOccupeOk==true && typeContratOk==true && entrepriseOk==true && adresseEntrepriseOk==true && secteurActiviteOk==true)
                {
                     document.getElementById("profil").submit();
                }
                else
                {
                    if(formationOk==true && anneeOk==true && disciplineOk==true && posteOccupeOk==true && typeContratOk==true && entrepriseOk==true && adresseEntrepriseOk==true && secteurActiviteOk==true)
                    {
                        document.getElementById("profil").submit();
                    }
                    else
                    {
                        alert("Les trois première parties du formulaire sont obligatoire, mais si vous remplissez les parties 4 et 5 ou juste une des deux assurez vous de l'avoir fait correctement");
                        return false; 
                    }
                }
            }
        }   
   }
   else
   {
        alert("Veuillez remplir au minimun les trois premières parties du formulaire correctement");
        return false;
   }
}
//fonction pour ajouter une ligne au tableau de partie 4 du formulaire
function ajoutLigneFormation()
{
    l=1+l;
    tabFormation=document.getElementById("tableauFormation");
    tr2Col=document.createElement("tr");
    tdInputFormation=document.createElement("td");
    inputFormation=document.createElement("input");
    inputFormation.setAttribute("name","formation"+l);
    inputFormation.setAttribute("id","formation");
    inputFormation.setAttribute("class","titre");
    inputFormation.setAttribute("placeholder","Formation : ");
    inputFormation.setAttribute("onblur","verifFormation(this);"); 
    /*if(totalInfo[12]!==null){
        inputFormation.setAttribute("value",totalInfo[12].replace(/-/gi," "));
    }
    partieFormulaire4.appendChild(inputFormation);
    erreurformation=document.createElement("p");
    erreurformation.setAttribute("id","erreurformation");
    partieFormulaire4.appendChild(erreurformation);*/
    tdInputFormation.appendChild(inputFormation);
    tr2Col.appendChild(tdInputFormation);
    
    tdSelectAn=document.createElement("td");
    selectAnnee = document.createElement("select");
    selectAnnee.setAttribute("name","annee"+l);
    selectAnnee.setAttribute("id","annee"+l);
    selectAnnee.setAttribute("class","selectForm");
    selectAnnee.setAttribute("onclick","verifAnnee(this);");
    partieFormulaire4.appendChild(selectAnnee);
    optionAnnee0 = document.createElement("option");
    optionAnnee0.setAttribute("value","");
    selectAnnee.appendChild(optionAnnee0);
    $('#annee>option[value="'+""+'"]').attr('selected', true);
    var k=1980;
    var ladate=new Date();
    while(k<=ladate.getFullYear()){
        optionAnnee = document.createElement("option");
        optionAnnee.setAttribute("value",k);
        selectAnnee.appendChild(optionAnnee);
        remplaceTexte(optionAnnee,k);
        /*if(totalInfo[13]==k){
            $('#annee>option[value="'+k+'"]').attr('selected', true);
        }*/
        k++;
    }
    //document.getElementById("anSortie").selectedIndex="-1";
    /*erreurannee=document.createElement("p");
    erreurannee.setAttribute("id","erreurannee");
    partieFormulaire4.appendChild(erreurannee);*/
    tdSelectAn.appendChild(selectAnnee);
    tr2Col.appendChild(tdSelectAn);
    
    tdInputDiscipline=document.createElement("td");
    inputDiscipline=document.createElement("input");
    inputDiscipline.setAttribute("name","discipline"+l);
    inputDiscipline.setAttribute("id","discipline");
    inputDiscipline.setAttribute("class","titre");
    inputDiscipline.setAttribute("placeholder","Discipline : ");
    inputDiscipline.setAttribute("onblur","verifDiscipline(this);"); 
    /*if(totalInfo[14]!==null){
        inputDiscipline.setAttribute("value",totalInfo[14].replace(/-/gi," "));
    }
    partieFormulaire4.appendChild(inputDiscipline);
    erreurdiscipline=document.createElement("p");
    erreurdiscipline.setAttribute("id","erreurdiscipline");
    partieFormulaire4.appendChild(erreurdiscipline);*/
    tdInputDiscipline.appendChild(inputDiscipline);
    tr2Col.appendChild(tdInputDiscipline);
    
    tdInputEtablissement=document.createElement("td");
    inputEtablissement=document.createElement("input");
    inputEtablissement.setAttribute("name","etablissement"+l);
    inputEtablissement.setAttribute("id","etablissement");
    inputEtablissement.setAttribute("class","titre");
    inputEtablissement.setAttribute("placeholder","Etablissement : ");
    //inputEtablissement.setAttribute("onblur","verifDiscipline(this);"); 
    /*if(totalInfo[14]!==null){
        inputDiscipline.setAttribute("value",totalInfo[14].replace(/-/gi," "));
    }
    partieFormulaire4.appendChild(inputDiscipline);
    erreurdiscipline=document.createElement("p");
    erreurdiscipline.setAttribute("id","erreurdiscipline");
    partieFormulaire4.appendChild(erreurdiscipline);*/
    tdInputEtablissement.appendChild(inputEtablissement);
    tr2Col.appendChild(tdInputEtablissement);
   
    tabFormation.appendChild(tr2Col);
    
    //update du nombre d'information dans input hidden
     nbInfoFormation.setAttribute("value",l);
}
//fonction pour ajouter une ligne au tableau de partie 6 du formulaire
function ajoutLigneStage()
{
    n=n+1;
    tabStage=document.getElementById("tableauStage");
    tr2ColStage=document.createElement("tr");
    tdInputStage=document.createElement("td");
    inputNomStage=document.createElement("input");
    inputNomStage.setAttribute("name","nomStage"+n);
    inputNomStage.setAttribute("id","nomStage");
    inputNomStage.setAttribute("class","titre");
    inputNomStage.setAttribute("placeholder","Nom de l'entreprise : ");
    //inputNomStage.setAttribute("onblur","verifFormation(this);"); 
    /*if(stage[o]!=undefined){
        inputNomStage.setAttribute("value",stage[o].replace(/-/gi," "));
    }
    partieFormulaire6.appendChild(inputFormation);*/
    /*erreurformation=document.createElement("p");
    erreurformation.setAttribute("id","erreurformation");
    partieFormulaire4.appendChild(erreurformation);*/
    tdInputStage.appendChild(inputNomStage);
    tr2ColStage.appendChild(tdInputStage);

    tdInputVilleEntreprise=document.createElement("td");
    inputVilleEntreprise=document.createElement("input");
    inputVilleEntreprise.setAttribute("name","villeEntreprise"+n);
    inputVilleEntreprise.setAttribute("id","villeEntreprise");
    inputVilleEntreprise.setAttribute("class","titre");
    inputVilleEntreprise.setAttribute("placeholder","Ville où elle est situé : ");
    //inputVilleEntreprise.setAttribute("onblur","verifDiscipline(this);"); 
    /*if(stage[o]!==undefined){
        inputVilleEntreprise.setAttribute("value",stage[o].replace(/-/gi," "));
    }
    partieFormulaire6.appendChild(inputVilleEntreprise);*/
    /*erreurdiscipline=document.createElement("p");
    erreurdiscipline.setAttribute("id","erreurdiscipline");
    partieFormulaire4.appendChild(erreurdiscipline);*/
    tdInputVilleEntreprise.appendChild(inputVilleEntreprise);
    tr2ColStage.appendChild(tdInputVilleEntreprise);

    tabStage.appendChild(tr2ColStage);
    
    //update du nombre d'information dans input hidden
     nbInfoStage.setAttribute("value",n);
}