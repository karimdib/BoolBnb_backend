
console.log('ciao sono una prova per vedere se va');
const dataStartList = document.querySelectorAll('.data-start');
const dataEndList = document.querySelectorAll('.data-end');

//formattazione data d inzxio
dataStartList.forEach(function (dataStart) {
    const firstStart = dataStart.innerText;
    const secondStart = new Date(firstStart);
    const formatDataStart = secondStart.toString().split(' ')[1] + " " + secondStart.toString().split(' ')[2] + " " + secondStart.toString().split(' ')[3] + " " + secondStart.toString().split(' ')[4];
    dataStart.innerText = formatDataStart;
});
//formattazzione data fine
dataEndList.forEach(function (dataEnd) {
    const firstEnd = dataEnd.innerText;
    const secondEnd = new Date(firstEnd);
    const formatDataEnd = secondEnd.toString().split(' ')[1] + " " + secondEnd.toString().split(' ')[2] + " " + secondEnd.toString().split(' ')[3] + " " + secondEnd.toString().split(' ')[4];
    dataEnd.innerText = formatDataEnd;
});
