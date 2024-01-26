const $ = document;
const sidebar = $.querySelector(".sidebar");
const toggleBtnMenu = $.querySelector(".toggle-menu");

function clickMenuActive() {
  toggleBtnMenu.addEventListener("click", () => {
    sidebar.classList.toggle("active");
  });
}

clickMenuActive();
