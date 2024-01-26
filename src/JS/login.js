const $ = document;

let regularEye = $.querySelectorAll(".fa-regular");

//  ----- code for Login -----

// inputs for login
let inputPassLogin = $.getElementById("pass-login");
let inputEmailLogin = $.getElementById("email-login");


// section in page
let loginSection = $.querySelector(".login-section")

// link to click change page (login / sign)
let creatAccountLink = $.querySelector(".creat-account-link")
let loginNowLink = $.querySelector(".login-now-link")

// Button to Enter Login
function clickOnBtnLogin (){
  $.getElementById("btn-login").addEventListener("click", (event) => {
    event.preventDefault()
    testCorrectEmail()
  })
}
 
// Warning Message Login
let warningMessageLogin = $.getElementById("warning-message-login")

// RegEx Email to correrct
function testCorrectEmail() {

  let regexEmail =
    /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/;

  if (inputEmailLogin.value){
    let isEmailLogin = regexEmail.test(inputEmailLogin.value);
    correctEmailLogin(isEmailLogin)

  } else if (!inputEmailLogin.value){
    showWarningMessageEmailLogin()

  } 
  
  if (inputEmailSign.value){
    let isEmailSign =  regexEmail.test(inputEmailSign.value);
    correctEmailSign(isEmailSign)

  }else if (!inputEmailSign.value){
    showWarningMessageEmailSign()
  }
}

function correctEmailLogin(isEmailLogin){
  if (isEmailLogin){
    testCorrectPassLogin()
  }else {
    showWarningMessageEmailLogin()
  }
}

// Correct Password Login
function testCorrectPassLogin (){

  if (inputPassLogin.value.trim()){
    emptyInputLogin();
    showWelcamMessageLogin();
  }else if (!inputPassLogin.value.trim()){
    showWarningMessagePassLogin();
  }
}

// Empty all inputs
function emptyInputLogin (){
  inputPassLogin.value = "";
  inputEmailLogin.value = "";
}


// show Not correct Email message
function showWarningMessageEmailLogin (){
  warningMessageLogin.className = "text-danger";
  warningMessageLogin.innerHTML = "ایمیل شما نامعتبر است";
  setInterval(() => {
    warningMessageLogin.innerHTML = "";
  }, 5000)

}

function showWarningMessagePassLogin (){
  warningMessageLogin.className = "text-danger";
  warningMessageLogin.innerHTML = "پسورد شما نامعتبر است";
  setInterval(() => {
    warningMessageLogin.innerHTML = "";
  }, 5000)

}

// show correct Enter
function showWelcamMessageLogin (){
  warningMessageLogin.className = "text-success";
  warningMessageLogin.innerHTML = "خوشامدید";
  window.location.href = "/src/dashboard.html"
}

clickOnBtnSign ();
clickOnBtnLogin ();
changeToLogin ();
clickEyePass();
changeToSign ();


//  ----- code for Sign -----


// // inputs for sign
let inputPassSign = $.getElementById("pass-sign");
let inputEmailSign = $.getElementById("email-sign");
let inputUserName = $.getElementById("username");

let signSection = $.querySelector(".sign-section")

let warningMessageSign = $.getElementById("warning-message-sign")

// // Button to Enter Sign
function clickOnBtnSign (){
  $.getElementById("btn-sign").addEventListener("click", (event) => {
    event.preventDefault()
    testCorrectUsername()
  })
}

function testCorrectUsername (){
  if (inputUserName.value.trim()){
    testCorrectEmail()
  }else{
    warningMessageSign.className = "text-danger";
    warningMessageSign.innerHTML = "نام کاربری شما نامعتبر است";
  
    setInterval(() => {
      warningMessageSign.innerHTML = "";
    }, 5000)
  
  }
}

function correctEmailSign(isEmailSign){
  if (isEmailSign){
    testCorrectPassSign()
  }else {
    showWarningMessageEmailSign()
  }
}

function testCorrectPassSign(){
  if (inputPassSign.value.trim()){
    emptyInputSign();
    showWelcamMessageSign();
  }else if (!inputPassSign.value.trim()){
    showWarningMessagePassSign();
  }
}

function showWarningMessageEmailSign(){
  warningMessageSign.className = "text-danger";
  warningMessageSign.innerHTML = "ایمیل شما نامعتبر است";
  setInterval(() => {
    warningMessageSign.innerHTML = "";
  }, 5000)

}

function showWarningMessagePassSign(){
  warningMessageSign.className = "text-danger";
  warningMessageSign.innerHTML = "پسورد شما نامعتبر است";
  setInterval(() => {
    warningMessageSign.innerHTML = "";
  }, 5000)
}

function showWelcamMessageSign(){
  warningMessageSign.className = "text-success";
  warningMessageSign.innerHTML = "خوشامدید";
  window.location.href = "/src/dashboard.html"
}



function emptyInputSign (){
  inputPassSign.value = "";
  inputEmailSign.value = "";
  inputUserName.value = "";
}

// function correctEmailSign (isEmailSign){

// }




//  ----- code for Both(Login & Sign)  -----

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
    emptyInputLogin()
  })

}

// change page to login
function changeToLogin (){
  loginNowLink.addEventListener("click", () =>{
    loginSection.classList.remove("activeRotate")
    signSection.classList.remove("activeRotate")
    emptyInputSign()
  })

}
