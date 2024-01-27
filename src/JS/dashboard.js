const $ = document;
const sidebar = $.querySelector(".sidebar");
const toggleBtnMenu = $.querySelector(".toggle-menu");
const content = $.querySelector(".content");

function clickMenuActive() {
  toggleBtnMenu.addEventListener("click", () => {
    sidebar.classList.toggle("active");
    content.classList.toggle("active");
  });
}

clickMenuActive();
