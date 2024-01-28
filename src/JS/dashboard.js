const $ = document;
const testTicket = [
  {
    id: 1,
    title: "مشکل امنیتی",
    content: "من یک مشکل امنیتی در این منطقه دارم",
    send: true,
    answer: false,
  },
  {
    id: 2,
    title: "مشکل ساختمانی",
    content: "من یک مشکل امنیتی در این منطقه دارم",
    send: true,
    answer: false,
  },
  {
    id: 3,
    title: "مشکل برقی در آپارتمان",
    content: "من یک مشکل امنیتی در این منطقه دارم",
    send: true,
    answer: false,
  },
  {
    id: 4,
    title: "2مشکل امنیتی",
    content: "من یک مشکل امنیتی در این منطقه دارم",
    send: true,
    answer: true,
  },
  {
    id: 5,
    title: "3مشکل امنیتی",
    content: "من یک مشکل امنیتی در این منطقه دارم",
    send: true,
    answer: false,
  },
  {
    id: 6,
    title: "4مشکل امنیتی",
    content: "من یک مشکل امنیتی در این منطقه دارم",
    send: true,
    answer: false,
  },
  {
    id: 7,
    title: "5مشکل امنیتی",
    content: "من یک مشکل امنیتی در این منطقه دارم",
    send: true,
    answer: true,
  },
  {
    id: 8,
    title: "6مشکل امنیتی",
    content: "من یک مشکل امنیتی در این منطقه دارم",
    send: true,
    answer: true,
  },
];
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

function showNumTicket() {
  let countAnswer = 0;
  let countSend = 0;
  testTicket.forEach((ticket) => {
   if(ticket.answer){
    countAnswer++
   } 
   if (!ticket.answer){
    countSend++
   }
  });
  sendTicket.innerHTML = countSend;
  answerTicket.innerHTML = countAnswer;
  allTicket.innerHTML = testTicket.length
}

clickMenuActive();
showNumTicket();
