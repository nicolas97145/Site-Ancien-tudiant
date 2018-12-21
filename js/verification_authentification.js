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
function verifIdentifiant(champ)
{   
   if(champ.value.length > 2 && champ.value.length < 25)//Si le nombre de caractére est inférieur à 2 ou supérieur à 15 alors
   {
      surligne(champ, true);//On appel la fonction surligne et on lui passe en paramétre erreur à true
      document.getElementById("erreuridentifiant").innerHTML = " ";
      return true;
   }
   else//Si la condition n'est pas respecté alors
   {
      surligne(champ, false);//On appel la fonction surligne et on lui passe en paramétre erreur à false
      //document.getElementById("erreuridentifiant").innerHTML = "Vous devez saisir votre identifiant";
      document.getElementById("loginId").setAttribute("value","Vous devez saisir votre identifiant");
      return false;
   }
}

//Fonction pour la vérification de l'email
function verifMotDePasse(champ)
{
   if(champ.value.length > 2 && champ.value.length < 50)
   {
      surligne(champ, true);//On appel la fonction surligne et on lui passe en paramétre erreur à true
      document.getElementById("password").setAttribute("type","password");
      return true;
   }
   else
   {
      surligne(champ, false);//On appel la fonction surligne et on lui passe en paramétre erreur à false
      //document.getElementById("erreurmotdepasse").innerHTML = "Vous devez saisir votre mot de passe";
      document.getElementById("password").setAttribute("value","Vous devez saisir votre mot de passe");
      document.getElementById("password").setAttribute("type","text");
      return false;
   }
}

//Fonction permettant la validation ou non du formulaire si tout les tests sont ok
function verifForm(login)
{
   var identifiantOk = verifIdentifiant(login.identifiant);
   var motdepasseOk = verifMotDePasse(login.motdepasse);
   
   if(identifiantOk && motdepasseOk)
   {
        document.getElementById("login").submit();
   }
   else
   {
        alert("Veuillez remplir correctement tous les champs");
        return false;
   }
}
