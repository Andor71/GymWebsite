const infomations = document.querySelector(".data");
const form = document.querySelector(".form");
const updateExcercise = document.querySelector(".excupdate")

function HideInfomationsOpenForm(){
    infomations.classList.add("hide");
    form.classList.remove("hide")
}
function HideInfomationsOpenExc(){
    infomations.classList.add("hide");
    updateExcercise.classList.remove("hide")
}

function HideFormOpenData(){
    form.classList.add("hide")
    infomations.classList.remove("hide");
}

function HideExcOpenData(){
    updateExcercise.classList.add("hide");
    infomations.classList.remove("hide");
}

function showHint(str) {
    console.log("a");
    if (str.length == 0) {
      document.getElementById("txtHint").innerHTML = "";
      return;
    } else {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let words = this.responseText.split(",");
            console.log(words);
            for(let i = 0 ; i < words.length ; i++){
                document.getElementById("txtHint").innerHTML +=  '<a href=./profile.php?response='+ words[i]+'>'+words[i]+'</a><br>';
            }
        }
      };
      xmlhttp.open("GET", "gethint.php?text=" + str, true);
      xmlhttp.send();
    }
}