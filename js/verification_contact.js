/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Fonction colorant les champs ou non suivant l'état des tests
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
   if(champ.value.length > 2 && champ.value.length < 25)//Si le nombre de caractére est inférieur à 2 ou supérieur à 15 alors
   {
      surligne(champ, true);//On appel la fonction surligne et on lui passe en paramétre erreur à true
      champ.value=champ.value.toUpperCase();//On force la saisie du nom en majuscule
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

//Fonction pour la vérification de l'email
function verifEmail(champ)
{
   if(champ.value.length > 2 && champ.value.length < 50)
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

//Fonction pour la vérification du sujet
function verifSujet(champ)
{
   if(champ.value.length > 2 && champ.value.length < 50)
   {
      surligne(champ, true);//On appel la fonction surligne et on lui passe en paramétre erreur à true
      document.getElementById("erreursujet").innerHTML = " ";
      return true;
   }
   else
   {
      surligne(champ, false);//On appel la fonction surligne et on lui passe en paramétre erreur à false
      document.getElementById("erreursujet").innerHTML = "Vous devez saisir un sujet";
      return false;
   }
}

//Fonction pour la vérification du message
function verifMessage(champ)
{
   if(champ.value.length > 2 && champ.value.length < 200)
   {
      surligne(champ, true);//On appel la fonction surligne et on lui passe en paramétre erreur à true
      document.getElementById("erreurmessage").innerHTML = " ";
      return true;
   }
   else
   {
      surligne(champ, false);//On appel la fonction surligne et on lui passe en paramétre erreur à false
      document.getElementById("erreurmessage").innerHTML = "Vous devez saisir un messsage";
      return false;
   }
}

//Fonction permettant la validation ou non du formulaire si tout les tests sont ok
function verifForm(contact)
{
   var nomOk = verifNom(contact.nom);
   var emailOk = verifEmail(contact.email);
   var messageOk = verifMessage(contact.message);
   var sujetOk = verifSujet(contact.sujet);

   if(nomOk && emailOk && messageOk && sujetOk)
   {
        document.getElementById("contact").submit();
   }
   else
   {
        alert("Veuillez remplir correctement tous les champs");
        return false;
   }
}


