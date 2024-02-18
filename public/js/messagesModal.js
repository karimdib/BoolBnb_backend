
const modalTriggers = document.getElementsByClassName('modal-trigger');

const modal = document.querySelector('.modal');

const modalCloseBtns = document.getElementsByClassName('close-modal');

const messagesContainer = document.getElementById('messages-container');

const tHeaderRow = document.getElementById('header-table-row')

// console.log(tHeaderRow);
for (var i = 0; i < modalTriggers.length; i++) {

    modalTriggers[i].addEventListener('click', function() {
        
        modal.classList.add('d-block');

        const message = JSON.parse(this.getAttribute('message'));
        const apartment = JSON.parse(this.getAttribute('apartment'));

        document.getElementById('message-sender').innerHTML = message.sender;
        document.getElementById('message-email').innerHTML = message.email;
        document.getElementById('message-subject').innerHTML = message.subject;
        document.getElementById('message-content').innerHTML = message.content;
        document.getElementById('message-apartment').innerHTML = apartment.name;


        const messageTableCells = document.getElementsByClassName('message-cell');
        const senderTableCells = document.getElementsByClassName('sender-cell');
        // console.log(senderTableCells);
        openMessage(messageTableCells, senderTableCells)
    });
    
    
};

for (var i = 0; i < modalCloseBtns.length; i++) {
    modalCloseBtns[i].addEventListener('click', function() {
        
        // console.log('click to close');
        modal.classList.remove('d-block');
        // while(messagesContainer.firstChild) {
        //     messagesContainer.removeChild(messagesContainer.firstChild)
        // }
    });
};
window.addEventListener('click', function(event) {
    if(event.target == modal) {
        modal.classList.remove('d-block');
        // while(messagesContainer.firstChild) {
        //     messagesContainer.removeChild(messagesContainer.firstChild)
        // }
    }
});

function iterateMessages(array) {
    array.forEach(message => {
        // CREO ELEMENTO PADRE (TR) DEL MESSAGGIO
        const messageRow = document.createElement('tr')
        messageRow.classList.add('message-row');

        // CREO ELEMENTI FIGLI (TH) CELLE CON LE PROPRIETA'

        // CREO IL PRIMO E PIU' CARATTERISTICO ELEMENTO FIGLIO
        const thTableEl = document.createElement('th');
        thTableEl.classList.add('date-of-sending');
        // SETTO L'ATTRIBUTO DELL'ELEMENTO FIGLIO
        thTableEl.setAttribute('scope', 'row');

        // FORMATTO LA DATA
        const dateString = message.created_at;
        const formattedDate = getFormattedDate(dateString);
        // ASSEGNO AL CONTENUTO LA MIA DATA FORMATTATA
        thTableEl.textContent = formattedDate;
        
        // INSERISCO L'ELEMENTO FIGLIO NELL'ELEMENTO PADRE
        messageRow.appendChild(thTableEl);
        
        // ITERO UN PROCEDIMENTO SIMILE A QUELLO SOPRA PER TUTTE LE ALTRE PROPRIETA' DEL MESSAGGIO
        iterateMessageProps(message, messageRow)

        // INSERISCO L'ELEMENTO PADRE CON TUTTE LE PROPRIETA' NELL'ELEMENTO CONTENITORE DEL DOM
        messagesContainer.appendChild(messageRow);
    });

}

function iterateMessageProps(object, HTMLElement) {
    for(const key in object) {
        if((key !== 'created_at') && (key !== 'apartment_id') && (key !== 'deleted_at') && (key !== 'id') && (key !== 'updated_at')) {
            
            const propElTagHTML = document.createElement('td');

            if(key == 'content') {
                propElTagHTML.classList.add('message-cell')
                propElTagHTML.textContent = `${object[key]}`;

            } else if (key == 'sender') {
                propElTagHTML.classList.add('sender-cell');
                propElTagHTML.textContent =`${object[key]}`;
            } else {
                propElTagHTML.textContent = `${object[key]}`;
            }
            
            HTMLElement.appendChild(propElTagHTML)

            
        }
    }
}

function getFormattedDate(string) {
    const date = new Date(string);
    const addZero = number => number < 10 ? '0' + number : number;

    // (a) => a + 100; arrow function
    const year = date.getFullYear();
    const month = addZero(date.getMonth() + 1);
    const day = addZero(date.getDate());
    const hours = addZero(date.getHours());
    const minutes = addZero(date.getMinutes());

    const formattedDate = `${day}/${month}/${year} ${hours}:${minutes}`;

    return formattedDate

}

function openMessage(array) {
    
    for(let i = 0; i < array.length; i++) {
        let singleCell = array[i];

        // DA CAPIRE SE IL SENDER NON LO RIMUOVO O MI CICLO I SENDER IN BASE AL MESSAGGIO

        singleCell.addEventListener('click', function(){
            let message = singleCell.textContent;

            
            while(messagesContainer.firstChild) {
                messagesContainer.removeChild(messagesContainer.firstChild)
            }
            while(tHeaderRow.firstChild) {
                tHeaderRow.removeChild(tHeaderRow.firstChild)
            }
            const thMessageHTMLTag = document.createElement('th');
            
            thMessageHTMLTag.textContent = 'Message';
            thMessageHTMLTag.classList.add('w-75', 'align-middle')
            thMessageHTMLTag.setAttribute('scope', 'col');

            tHeaderRow.appendChild(thMessageHTMLTag);

            const thSenderHTMLTag = document.createElement('th');

            thSenderHTMLTag.textContent = 'Sender';
            thSenderHTMLTag.classList.add('align-middle')
            thSenderHTMLTag.setAttribute('scope', 'col');

            tHeaderRow.appendChild(thSenderHTMLTag)

            const thButtonHTMLTag = document.createElement('th');
            const buttonHTMLTag = document.createElement('button');

            const classesToAdd = ['btn', 'btn-secondary', 'btn-sm', 'back-button'];
            buttonHTMLTag.classList.add(...classesToAdd);
            buttonHTMLTag.setAttribute('type', 'button');
            buttonHTMLTag.textContent = 'Back';
            thButtonHTMLTag.appendChild(buttonHTMLTag);

            tHeaderRow.appendChild(thButtonHTMLTag);

            trMessageHTMLTag = document.createElement('tr');

            tdMessageHTMLTag = document.createElement('td');
            tdMessageHTMLTag.textContent = message;

            trMessageHTMLTag.appendChild(tdMessageHTMLTag);

            messagesContainer.appendChild(trMessageHTMLTag);

            

            // backToMessages()
        })
        
    }
}

// DA DEFFINIRE COME TORNARE INDIETRO CON IL BOTTONE
// function backToMessages() {
//     const backBtn = document.querySelector('.back-button');
//     // console.log(this)
//     console.log(backBtn)

//     backBtn.addEventListener('click', function() {
//         console.log(this)
//     })
// }