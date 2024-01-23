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
  $.getElementById("btn-login").addEventListener("click", () => {

  })
}
 
// Warning Message Login
let warningMessageLogin = $.getElementById(".warning-message-login")

// RegEx Email to correrct
function testCorrectEmail() {
  let regexEmail =
    /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/;
  let isEmailLogin = regexEmail.test(inputEmailLogin.value);
  let isEmailSign =  regexEmail.test(inputEmailSign.value);

  correctEmailLogin(isEmailLogin)
  correctEmailSign(isEmailSign)
}

function correctEmailLogin(isEmailLogin){

}

// Correct Password
function testCorrectPass (){
  // for login section

  if (inputPassLogin.value.trim()){
    emptyInput();
    showWelcamMessage();
    return
  }else if (!inputPassLogin.value.trim()){
    showWarningMessagePass();
    return
  }

  // for sign section
  if (inputPassSign.value.trim()){
    testCorrectUsername()
  }else if (!inputPassSign.value.trim()){
    showWarningMessagePass();
  }
}

// Empty all inputs
function emptyInputLogin (){
  inputPassLogin.value = "";
  inputEmailLogin.value = "";
}


// show Not correct Email message
function showWarningMessageEmail (){
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

function showWarningMessagePass (){
  warningMessage.forEach( message => {
    message.className = "warning-message text-danger";
    message.innerHTML = "پسورد شما نامعتبر است";
  })
  setInterval(() => {
    warningMessage.forEach( message => {
      message.innerHTML = "";
    })

  }, 5000)

}

// show correct Enter
function showWelcamMessage (){
  warningMessage.forEach( message => {
    message.className = "warning-message text-success "
    message.innerHTML = "خوشامدید";
  })
}

clickOnBtn ()
changeToLogin ()
clickEyePass();
changeToSign ()


//  ----- code for Sign -----


// inputs for sign
let inputPassSign = $.getElementById("pass-sign");
let inputEmailSign = $.getElementById("email-sign");
let inputUserName = $.getElementById("username");

let signSection = $.querySelector(".sign-section")

let warningMessageSign = $.getElementById(".warning-message-sign")

function testCorrectUsername (){
  if (inputUserName.value.trim()){
    emptyInput();
    showWelcamMessage();
  }else{
    warningMessage.forEach( message => {
      message.className = "warning-message text-danger";
      message.innerHTML = "نام کاربری شما نامعتبر است";
    })
    setInterval(() => {
      warningMessage.forEach( message => {
        message.innerHTML = "";
      })
  
    }, 5000)
  
  }
}

function emptyInputSign (){
  inputPassSign.value = "";
  inputEmailSign.value = "";
  inputUserName.value = "";
}

function correctEmailSign (isEmailSign){

}




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
    
  })

}

// change page to login
function changeToLogin (){
  loginNowLink.addEventListener("click", () =>{
    loginSection.classList.remove("activeRotate")
    signSection.classList.remove("activeRotate")
    
  })

}
