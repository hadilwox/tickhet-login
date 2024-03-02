let regularEye = $.querySelectorAll(".fa-regular");

// inputs for login
let inputPassLogin = $.getElementById("pass-login");

// change type password (can see / can't see)
function clickEyePass() {
  regularEye.forEach((eyeBtn) => {
    eyeBtn.addEventListener("click", () => {
      // for login page
      if (inputPassLogin.type == "password") {
        inputPassLogin.type = "text";
      } else {
        inputPassLogin.type = "password";
      }
    });
  });
}

// Call function
clickEyePass();
