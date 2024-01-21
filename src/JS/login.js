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

// Warning Message
let warningMessage = $.querySelectorAll(".warning-message")

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

// RegEx Email to correrct
function testCorrectEmail() {
  let regexEmail =
    /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/;
  let isEmailLogin = regexEmail.test(inputEmailLogin.value);
  let isEmailSign =  regexEmail.test(inputEmailSign.value);
  if (isEmailLogin || isEmailSign){
    console.log(true);
    emptyInput();
    showWelcamMesage();
  } else {
    showWarningMessage();
  }
    
}

// Event click on Btn
function clickOnBtn (){
  buttons.forEach(btn => {
    btn.addEventListener("click", () => {
      testCorrectEmail()
    })
  })
}

// Empty all inputs
function emptyInput (){

  inputPassLogin.value = "";
  inputEmailLogin.value = "";
  inputPassSign.value = "";
  inputEmailSign.value = "";
  inputUserName.value = "";
}

// show Not correct Email message
function showWarningMessage (){
  warningMessage.forEach( message => {
    message.className = "warning-message text-danger"
    message.innerHTML = "ایمیل شما نامعتبر است";
  })
  setInterval(() => {
    warningMessage.forEach( message => {
      message.innerHTML = "";
    })

  }, 3000)

}

// show correct Enter
function showWelcamMesage (){
  warningMessage.forEach( message => {
    message.className = "warning-message text-success "
    message.innerHTML = "خوشامدید";
  })
}

clickOnBtn ()
changeToLogin ()
clickEyePass();
changeToSign ()