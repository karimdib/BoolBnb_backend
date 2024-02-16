
let date = new Date();

const todayDate = getPreviousMonth(date, 0);
// console.log(getPreviousMonth(todayDate));
const backOneDate = getPreviousMonth(date,1);
// console.log(backOneDate);
const backTwoDate = getPreviousMonth(date,2);
// console.log(backTwoDate);
const backThreeDate = getPreviousMonth(date,3);
// console.log(backThreeDate);
const backFourDate = getPreviousMonth(date,4);
// console.log(backFourDate);
const backFiveDate = getPreviousMonth(date,5);
// console.log(backFiveDate);
const backSixDate = getPreviousMonth(date,6);
const backSevenDate = getPreviousMonth(date,7);
const backEightDate = getPreviousMonth(date,8);
const backNineDate = getPreviousMonth(date,9);
const backTenDate = getPreviousMonth(date,10);
const backElevenDate = getPreviousMonth(date,11);


(async function () {
  const data = [
    { day: getMonthYearString(backElevenDate), count: visitCounter(backElevenDate) },
    { day: getMonthYearString(backTenDate), count: visitCounter(backTenDate) },
    { day: getMonthYearString(backNineDate), count: visitCounter(backNineDate) },
    { day: getMonthYearString(backEightDate), count: visitCounter(backEightDate) },
    { day: getMonthYearString(backSevenDate), count: visitCounter(backSevenDate) },
    { day: getMonthYearString(backSixDate), count: visitCounter(backSixDate) },
    { day: getMonthYearString(backFiveDate), count: visitCounter(backFiveDate) },
    { day: getMonthYearString(backFourDate), count: visitCounter(backFourDate) },
    { day: getMonthYearString(backThreeDate), count: visitCounter(backThreeDate) },
    { day: getMonthYearString(backTwoDate), count: visitCounter(backTwoDate) },
    { day: getMonthYearString(backOneDate), count: visitCounter(backOneDate) },
    { day: getMonthYearString(todayDate), count: visitCounter(todayDate) },
  ];

  new Chart(
    document.getElementById('visits'),
    {
      type: 'bar',
      data: {
        labels: data.map(row => row.day),
        datasets: [
          {
            label: 'Visualizations per month',
            data: data.map(row => row.count),
            backgroundColor: '#77d4b8',
            display: false,
          }
        ]
      },
      options: {
        maintainAspectRatio: false,
        aspectRatio: 1,
        scales: {
          y: {
            ticks: {
              maxTicksLimit: 6
            }
          }
        }
      }
    }
  );
})();

function getPreviousMonth(date, n) {
  let month = date.getMonth() - n;
  let year = date.getFullYear();

  if (month < 0) {
    month += 12; // Aggiungi 12 per ottenere il mese dell'anno precedente
    year -= 1;   // Sottrai 1 dall'anno per ottenere l'anno precedente
  }
  return `${month +1}/${year}`; // Aggiungi 1 a month perché i mesi in JavaScript sono indicizzati da 0
}

function getMonthYearString(monthYearString) {
  // Dividi la stringa in mese e anno
  let [month, year] = monthYearString.split('/');
  // Array dei nomi dei mesi, dove il mese 0 corrisponde a "gennaio"
  const monthNames = [
    "Gennaio", "Febbraio", "Marzo", "Aprile", "Maggio", "Giugno",
    "Luglio", "Agosto", "Settembre", "Ottobre", "Novembre", "Dicembre"
  ];
  // Assicurati che il numero del mese sia nel range corretto
  if (month >= 1 && month <= 12) {
    let monthName = monthNames[month - 1]; // Sottrai 1 perché gli array sono indicizzati da 0
    return `${monthName} ${year}`;
  } else {
    return "Mese non valido";
  }
}

function visitCounter(currentMonth) {
  let count = 0;
  visitsJS.forEach(visit => {
    const currentDateObj = new Date(visit.date);
    const month = currentDateObj.getMonth() + 1;
    const year = currentDateObj.getFullYear();
    let currentDate = `${month}/${year}`;
    if (currentDate == currentMonth) {
      count++
    }
  })
  return count;
}