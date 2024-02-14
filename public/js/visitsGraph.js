const date = new Date();
const todayDate = getDayMonthString(date);
const backOneDate = getDayMonthString(date);
const backTwoDate = getDayMonthString(date);
const backThreeDate = getDayMonthString(date);
const backFourDate = getDayMonthString(date);
const backFiveDate = getDayMonthString(date);
const backSixDate = getDayMonthString(date);



visitsJS.forEach(visit => {
  // console.log(visit);
});

(async function () {
  const data = [
    { day: backSixDate, count: 10 },
    { day: backFiveDate, count: 20 },
    { day: backFourDate, count: 15 },
    { day: backThreeDate, count: 30 },
    { day: backTwoDate, count: 5 },
    { day: backOneDate, count: 12 },
    { day: todayDate, count: 23 },
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
            data: data.map(row => row.count)
          }
        ]
      }
    }
  );
})();

function getDayMonthString(date) {
  date.setDate(date.getDate() - 1);
  let day = date.getDate();
  let month = date.getMonth() + 1;
  let fullDate = `${day}/${month}`;
  return fullDate;
}
