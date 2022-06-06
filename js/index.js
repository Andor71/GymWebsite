const infomations = document.querySelector(".data");
const form = document.querySelector(".form");


function ChangeLayoutOnInformation(){
    console.log("C");
    infomations.classList.add("hide");
    form.classList.remove("hide")
}

function ChangeLayoutOnForm(){
    form.classList.add("hide")
    infomations.classList.remove("hide");
}