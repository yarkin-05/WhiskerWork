
function getRandomInt(){
  return Math.floor(Math.random() * 5);
}

let img = ['images/monedas/blanco.png', 'images/monedas/gris.png', 'images/monedas/naranja.png', 'images/monedas/negro_.png', 'images/monedas/siames.png'];

function openPopup() {
  // Create a new window for the popup
  var pop_up = window.open("", "popup", "width=200,height=200");

  let image = img[getRandomInt()];

  console.log('hi');
  // Write the content into the popup window
  pop_up.document.write(`
    <html>
    <head>
      <title>Popup</title>
      <link rel="stylesheet" href="styles/dashboard.css">

    </head>
    <body>
      <div class="pop-up">
        <div class="pop-up__content">
          <div class="pop-up__title">A coin just dropped!</div>
          <div class="img">
            <img src="${image}" alt="">
          </div>
        </div>
      </div>
    </body>
    </html>
  `);

  const popup = document.querySelector('.pop-up');
  if(popup){
    setTimeout(() => {
      pop_up.classList.add('visible');
    }, 500);
  }
  
}


/*****************************************
 * 
 * CALENDAR
 * 
 *///*************************** 

const currentDate = document.querySelector('.current-date');
const daysTag = document.querySelector('.days');
const prevnextIcon = document.querySelectorAll('.icons span');

//getting new date, current year and month
let date = new Date(),
currentYear = date.getFullYear(),
currentMonth = date.getMonth();

const MONTHS = ["January", "February", "March",   "April", "May", "June", "July", "August", "September", "October", "November", "December"];

const renderCalendar = () => {
  let firstDateofMonth = new Date(currentYear, currentMonth, 1).getDay(), //getting first date of month
  lastDateofMonth = new Date(currentYear, currentMonth+ 1, 0).getDate(), //previous
  lastDateofLastMonth = new Date(currentYear, currentMonth, 0).getDate(), //getting last date of month
  lastDayofMonth = new Date(currentYear, currentMonth, lastDateofMonth).getDay(); //getting last date of month

  let liTag = "";

  for(let i = firstDateofMonth; i>0; i--){
    //previous month last days
    liTag += `<li class="inactive"> ${lastDateofLastMonth - i + 1}</li>`;
  }

  for(let i = 1; i<=lastDateofMonth; i++){
    //all current month days
    let isToday = i === date.getDate() && currentMonth === new Date().getMonth() &&
    currentYear === new Date().getFullYear() ? "active" : "";
    console.log(isToday);
    liTag += `<li class="${isToday}">${i}</li>`;
  }

  for(let i = lastDayofMonth; i<6; i++){
    //next month first days
    liTag += `<li class="inactive"> ${i - lastDayofMonth + 1}</li>`;
  }

  currentDate.innerText = `${MONTHS[currentMonth]} ${currentYear}`;
  daysTag.innerHTML = liTag;
}
renderCalendar();

prevnextIcon.forEach(icon => {
  icon.addEventListener("click", () => {
    //click event on < > icons
    currentMonth = icon.id === "prev" ? currentMonth -1 : currentMonth + 1;

    if(currentMonth < 0 || currentMonth > 11){
      //year change
      date = new Date(currentYear, currentMonth);
      currentYear = date.getFullYear();
      currentMonth = date.getMonth();
    } else{
      date = new Date();
    }
    renderCalendar();
  });
});