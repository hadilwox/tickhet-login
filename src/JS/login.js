const $ = document;

let regularEye = $.querySelector(".fa-regular");
let solidEye = $.querySelector(".fa-solid");
let inputPass = $.getElementById("pass");
let inputEmail = $.getElementById("email");

let loginSection = $.querySelector(".login-section")
let signSection = $.querySelector(".sign-section")
let creatAccountLink = $.querySelector(".creat-account-link")
let loginNowLink = $.querySelector(".login-now-link")

function clickEyePass() {
  regularEye.addEventListener("click", () => {
    if (inputPass.type == "password") {
      inputPass.type = "text";
      console.log("click");
    } else {
      inputPass.type = "password";
    }
  });
}

function changeToSign (){
  creatAccountLink.addEventListener("click", () =>{
    loginSection.classList.add("activeRotate")
    signSection.classList.add("activeRotate")
    
  })

}
function changeToLogin (){
  loginNowLink.addEventListener("click", () =>{
    loginSection.classList.remove("activeRotate")
    signSection.classList.remove("activeRotate")
    
  })

}

function testCorrectEmail() {
  let regexEmail =
    /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/;
    let EmailValue = inputEmail.value;
    
}


changeToLogin ()
clickEyePass();
changeToSign ()