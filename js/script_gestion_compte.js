$("#submit-creacompte").click(function(e){
  e.preventDefault();
  var test=true;
  if(!verifMdpCreacompte()){
    test=false;
  }
  if(!verifMailCreacompte()){
    test=false;
  }
  if(test){
    document.getElementById("form-creacompte").submit();
  }
});
regex4carac = "^.{4,}";
regex8carac = "^.{8,}";
regexMajuscule = "[a-z0-9]{0,}[A-Z]{1,}[a-z0-9]{0,}";
function verifMdpCreacompte(){
  retour = false;
  x=document.getElementById("mdp-creacompte").value;
  if(x.match(regex8carac)){
    if(x.match(regexMajuscule)){
      retour = true;
      document.getElementById("mdp-creacompte-false").style.visibility="hidden";
    }
    else{
      document.getElementById("mdp-creacompte-false").style.visibility="inherit";
      document.getElementById("mdp-creacompte-false").innerHTML="Le mot de passe doit comporter au moins une majucule.";
    }
  }else{
    document.getElementById("mdp-creacompte-false").style.visibility="inherit";
    document.getElementById("mdp-creacompte-false").innerHTML="Le mot de passe doit comporter au moins 8 caractères.";
  }
  return retour;
}
// function verifNomCreacompte(){
//   retour = false;
//   x=document.getElementById("name-creacompte").value;
//   if(!x.match("[0-9]")){
//     retour = true;
//     document.getElementById("name-creacompte-false").style.visibility="hidden";
//   }
//   else{
//     document.getElementById("name-creacompte-false").style.visibility="inherit";
//     document.getElementById("name-creacompte-false").innerHTML="Le nom ne doit pas comporter de numéro.";
//   }
//   return retour;
// }
// function verifPrenomCreacompte(){
//   retour = false;
//   x=document.getElementById("firstname-creacompte").value;
//   if(!x.match("[0-9]")){
//     retour = true;
//     document.getElementById("firstname-creacompte-false").style.visibility="hidden";
//   }
//   else{
//     document.getElementById("firstname-creacompte-false").style.visibility="inherit";
//     document.getElementById("firstname-creacompte-false").innerHTML="Le prénom ne doit pas comporter de numéro.";
//   }
//   return retour;
// }
function verifMailCreacompte(){
  retour = false;
  x=document.getElementById("mail-creacompte").value;
  if(x.match("[a-zA-Z0-9]{3,}[@][a-zA-Z]{1,}[.][a-zA-Z]{2,}")){
    retour = true;
    document.getElementById("mail-creacompte-false").style.visibility="hidden";
  }else{
    document.getElementById("mail-creacompte-false").style.visibility="inherit";
    document.getElementById("mail-creacompte-false").innerHTML="Le mail n'a pas le bon format : *****@***.**";
  }
  return retour;
}
