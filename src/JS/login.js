
let regularEye = $.querySelectorAll(".fa-regular");

// inputs for login
let inputPassLogin = $.getElementById("pass-login");
let inputEmailLogin = $.getElementById("email-login");

// section in page
let loginSection = $.querySelector(".login-section");

// link to click change page (login / sign)
let creatAccountLink = $.querySelector(".creat-account-link");
let loginNowLink = $.querySelector(".login-now-link");

// Empty all inputs
function emptyInputLogin() {
  inputPassLogin.value = "";
  inputEmailLogin.value = "";
}

let inputPassSign = $.getElementById("pass-sign");
let inputEmailSign = $.getElementById("email-sign");
let inputUserName = $.getElementById("username");

let signSection = $.querySelector(".sign-section");

let warningMessageSign = $.getElementById("warning-message-sign");

function emptyInputSign() {
  inputPassSign.value = "";
  inputEmailSign.value = "";
  inputUserName.value = "";
}

//  ----- code for Both(Login & Sign)  -----

// change type password (can see / can't see)
function clickEyePass() {
  regularEye.forEach((eyeBtn) => {
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
  });
}

// change page to sign
function changeToSign() {
  creatAccountLink.addEventListener("click", () => {
    loginSection.classList.add("activeRotate");
    signSection.classList.add("activeRotate");
    emptyInputLogin();
  });
}

// change page to login
function changeToLogin() {
  loginNowLink.addEventListener("click", () => {
    loginSection.classList.remove("activeRotate");
    signSection.classList.remove("activeRotate");
    emptyInputSign();
  });
}

// Call function
changeToLogin();
clickEyePass();
changeToSign();
