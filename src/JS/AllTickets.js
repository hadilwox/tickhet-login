const $ = document;
const tickets = $.querySelectorAll(".body-table");

function clickOnTickets() {
  tickets.forEach((ticket) => {
    ticket.addEventListener("click", () => {
      window.location.href = "/src/seeOneTicket.html";
    });
  });
}

clickOnTickets();
