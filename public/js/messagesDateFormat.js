const messageDate = document.querySelectorAll('.message-date');


messageDate.forEach(function (dataStart) {
    const firstStart = dataStart.innerText;
    const secondStart = new Date(firstStart);
    const formatDataStart = secondStart.toString().split(' ')[1] + " " + secondStart.toString().split(' ')[2] + " " + secondStart.toString().split(' ')[3] + " " + secondStart.toString().split(' ')[4];
    dataStart.innerText = formatDataStart;
});