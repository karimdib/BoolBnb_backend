// import '../../resources/scss/partials/_variables.scss';

const date = new Date();
const todayDate = getDayMonthString(date);
const backOneDate = getPreviousDayMonthString(date);
const backTwoDate = getPreviousDayMonthString(date);
const backThreeDate = getPreviousDayMonthString(date);
const backFourDate = getPreviousDayMonthString(date);
const backFiveDate = getPreviousDayMonthString(date);
const backSixDate = getPreviousDayMonthString(date);


(async function () {
  const data = [
    { day: backSixDate, count: visitCounter(backSixDate) },
    { day: backFiveDate, count: visitCounter(backFiveDate) },
    { day: backFourDate, count: visitCounter(backFourDate) },
    { day: backThreeDate, count: visitCounter(backThreeDate) },
    { day: backTwoDate, count: visitCounter(backTwoDate) },
    { day: backOneDate, count: visitCounter(backOneDate) },
    { day: todayDate, count: visitCounter(todayDate) },
  ];

  new Chart(
    document.getElementById('visits'),
    {
      type: 'bar',
      data: {
        labels: data.map(row => row.day),
        datasets: [
          {
            label: 'Visualizations per day',
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

function getPreviousDayMonthString(date) {
  date.setDate(date.getDate() - 1);
  let day = date.getDate();
  let month = date.getMonth() + 1;
  let fullDate = `${day}/${month}`;
  return fullDate;
}

function getDayMonthString(date) {
  let day = date.getDate();
  let month = date.getMonth() + 1;
  let fullDate = `${day}/${month}`;
  return fullDate;
}

function visitCounter(currentDay) {
  let count = 0;
  visitsJS.forEach(visit => {
    const currentDateObj = new Date(visit.date);
    const day = currentDateObj.getDate();
    const month = currentDateObj.getMonth() + 1;
    let currentDate = `${day}/${month}`;
    if (currentDate == currentDay) {
      count++
    }
  })
  return count;
}