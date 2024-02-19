const messageDate = document.querySelectorAll('.message-date');


messageDate.forEach(function (dataStart) {
    const firstStart = dataStart.innerText;
    const secondStart = new Date(firstStart);
    const time = secondStart.toString().split(' ')[4];
    const formattedTime = time.slice(0, 5)
    console.log(time);
    const formatDataStart = secondStart.toString().split(' ')[1] + " " + secondStart.toString().split(' ')[2] + " " + secondStart.toString().split(' ')[3] + " " + formattedTime;
    dataStart.innerText = formatDataStart;
});