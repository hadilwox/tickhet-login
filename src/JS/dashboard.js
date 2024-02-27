const $ = document;

const sidebar = $.querySelector(".sidebar");
const toggleBtnMenu = $.querySelector(".toggle-menu");
const content = $.querySelector(".content");

const sendTicket = $.getElementById("send-ticket");
const answerTicket = $.getElementById("answer-ticket");
const allTicket = $.getElementById("all-ticket");

function clickMenuActive() {
  toggleBtnMenu.addEventListener("click", () => {
    sidebar.classList.toggle("active");
    content.classList.toggle("active");
  });
}

clickMenuActive();
