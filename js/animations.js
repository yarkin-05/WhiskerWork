// Function to toggle the submenu visibility
let subMenu = document.getElementById("subMenu");
function toggleMenu() {
  subMenu.classList.toggle("open-menu");
}

// Function to toggle visibility of "Hi" and "Bye" based on selected reward
let galleryOption = document.getElementById("gallery_option");
let coinsOption = document.getElementById("coins_option");
let gallery = document.getElementById("gallery");
let coins = document.getElementById("coins");

function toggleVisibility() {
  gallery.classList.toggle("visible", galleryOption.classList.contains("selected"));
  coins.classList.toggle("visible", coinsOption.classList.contains("selected"));
  gallery.classList.toggle("invisible", galleryOption.classList.contains("not-selected"));
  coins.classList.toggle("invisible", coinsOption.classList.contains("not-selected"));
}

function alter() {
  let unselected = document.querySelector(".rewards .not-selected");
  let selected = document.querySelector(".rewards .selected");

  unselected.addEventListener("click", function () {
    unselected.classList = 'selected';
    selected.classList = 'not-selected';
  });

  toggleVisibility();
}

// Run alter function on an interval of 1000ms (1 second)
//setInterval(alter, 100);


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