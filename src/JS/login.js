const $ = document;

let regularEye = $.querySelectorAll(".fa-regular");
// inputs for login
let inputPassLogin = $.getElementById("pass-login");
let inputEmailLogin = $.getElementById("email-login");

// inputs for sign
let inputPassSign = $.getElementById("pass-sign");
let inputEmailSign = $.getElementById("email-sign");
let inputUserName = $.getElementById("username");

// section in page
let loginSection = $.querySelector(".login-section")
let signSection = $.querySelector(".sign-section")

// link to click change page (login / sign)
let creatAccountLink = $.querySelector(".creat-account-link")
let loginNowLink = $.querySelector(".login-now-link")

// Button to Enter
let buttons = $.querySelectorAll(".btn")

// change type password (can see / can't see)
function clickEyePass() {
  regularEye.forEach(eyeBtn => {
    eyeBtn.addEventListener("click", () => {
      console.log("click");
      // for login page
      if (inputPassLogin.type == "password") {
        inputPassLogin.type = "text";
      } else {
        inputPassLogin.type = "password";
      }
  
      // fot sign page
      if (inputPassSign.type == "password") {
        inputPassSign.type = "text";
      } else {
        inputPassSign.type = "password";
      }
    });
  })
  
}

// change page to sign
function changeToSign (){
  creatAccountLink.addEventListener("click", () =>{
    loginSection.classList.add("activeRotate")
    signSection.classList.add("activeRotate")
    
  })

}

// change page to login
function changeToLogin (){
  loginNowLink.addEventListener("click", () =>{
    loginSection.classList.remove("activeRotate")
    signSection.classList.remove("activeRotate")
    
  })

}

function testCorrectEmail() {
  let regexEmail =
    /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/;
  let isEmailLogin = regexEmail.test(inputEmailLogin.value);
  let isEmailSign =  regexEmail.test(inputEmailSign.value);
  if (isEmailLogin || isEmailSign){
    console.log(true);
    emptyInput();
  } else {
    showWarningMessage();
  }
    
}

function clickOnBtn (){
  buttons.forEach(btn => {
    btn.addEventListener("click", () => {
      testCorrectEmail()
    })
  })
}

function emptyInput (){

  inputPassLogin.value = "";
  inputEmailLogin.value = "";
  inputPassSign.value = "";
  inputEmailSign.value = "";
  inputUserName.value = "";
}

function showWarningMessage (){
  $.querySelectorAll(".warning-message").forEach( message => {
    message.innerHTML = "ایمیل شما نامعتبر است"
  })
}

clickOnBtn ()
changeToLogin ()
clickEyePass();
changeToSign ()