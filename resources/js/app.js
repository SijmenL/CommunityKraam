import './bootstrap';
window.addEventListener('load', init);

let select;
let buttonContainer;

function init() {
    deleteButtons();

    if (document.getElementById('select-tags')) {
        select = document.getElementById('select-tags');
        buttonContainer = document.getElementById('button-container');
        editTags();
    }
}

function deleteButtons() {
    let allButtons = document.querySelectorAll('a[class^=delete-button]');
    for (let i = 0; i < allButtons.length; i++) {
        allButtons[i].addEventListener('click', function (e) {
            if (allButtons[i].getAttribute('data-sure') === 'true') {
                // Allow the link to be activated
                return;
            }

            e.preventDefault();
            allButtons[i].innerHTML = 'Sure?';
            let buttonID = allButtons[i].getAttribute('data-id');
            allButtons[i].setAttribute('href', `/product/delete/${buttonID}`);
            allButtons[i].setAttribute('data-sure', 'true');
            allButtons[i].classList.add('btn-danger')
            allButtons[i].classList.remove('btn-outline-danger')


            // Automatically reset the button after 5 seconds
            setTimeout(function () {
                allButtons[i].innerHTML = 'Delete';
                allButtons[i].setAttribute('href', ``);
                allButtons[i].setAttribute('data-sure', 'false');
                allButtons[i].classList.remove('btn-danger')
                allButtons[i].classList.add('btn-outline-danger')
            }, 5000);
        });
    }
}

// Create buttons for each option
function editTags() {
    select.querySelectorAll('option').forEach(option => {
        const button = document.createElement('p');
        const autoSubmit = document.getElementById("auto-submit");
        button.textContent = option.textContent;
        button.classList.add('btn');
        button.classList.add('btn-light');
        button.dataset.value = option.value;

        if (option.selected) {
            button.classList.add('btn-info');
            button.classList.remove('btn-light');
        } else {
            button.classList.remove('btn-primary');
            button.classList.add('btn-light');
        }


        button.addEventListener('click', () => {
            if (option.selected) {
                option.selected = false;
                button.classList.remove('btn-info');
                button.classList.add('btn-light');
                autoSubmit.submit();
            } else {
                option.selected = true;
                button.classList.add('btn-info');
                button.classList.remove('btn-light');
                autoSubmit.submit();
            }
        });

        buttonContainer.appendChild(button);
    });
}
