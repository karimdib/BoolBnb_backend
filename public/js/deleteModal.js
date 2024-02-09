// GET BTNS (apartments/index.blade.php)

const modalTriggers = document.getElementsByClassName('modal-trigger');

// GET MODAL (components/delete-modal.blade.php)

const modal = document.querySelector('.modal');

// GET MODAL CLOSE BTNS (components/delete-modal.blade.php)

const modalCloseBtns = document.getElementsByClassName('close-modal');

// GET MODAL DELETE BTN (components/delete-modal.blade.php)

const modalDeleteBtn = document.getElementById("confirm-delete");

// GET FORM (apartments/index.blade.php)

// GET MODAL HTML TAGS (components/delete-modal.blade.ph)

const apartmentTitle = document.getElementById('apartment-name');

const apartmentAddress = document.getElementById('apartment-address');

// LOOP THROUGH MODAL TRIGGERS AND ADD CLICK EVENT LISTENERS

for (var i = 0; i < modalTriggers.length; i++) {

    modalTriggers[i].addEventListener('click', function(event) {
        const index = this;
        
        event.preventDefault();
        console.log('click', this);
        modal.classList.add('d-block');
        apartmentTitle.innerHTML = this.name;

        apartmentAddress.innerHTML = this.getAttribute('address');

        modalDeleteBtn.addEventListener('click', function(event) {
            index.parentElement.submit()
            // console.log(modalTriggers[i].parentElement)
        });
    });
};

for (var i = 0; i < modalCloseBtns.length; i++) {
    modalCloseBtns[i].addEventListener('click', function() {
        
        console.log('click to close');
        modal.classList.remove('d-block');
    });
};

window.addEventListener('click', function(event) {
    if(event.target == modal) {
        modal.classList.remove('d-block');
    }
});