include('public/js/utils/files.js');
include('public/js/utils/request.js');

const checkboxControlNames = ['active', 'promo'];
const textControlNames = ['name', 'description'];

function changeDisabledStatus() {
    document.getElementById('product-creator__action-button').disabled = isTextControlInvalid();
}

function isTextControlInvalid() {
    return textControlNames
    .map(controlName => document.getElementById(controlName).validity.valid)
    .some(valid => !valid);
}

document.getElementById('product-creator__action-button').addEventListener('click', () => {
    document.getElementById('product-creator__action-button').disabled = true;

    const formData = new FormData();

    const currentFiles = document.getElementById('images').files;

    for (const file of currentFiles) {
        formData.append("images[]", file);
    }

    formData.append('name', document.getElementById('name').value);
    formData.append('description', document.getElementById('description').value);
    formData.append('isActive', document.getElementById('active').checked);
    formData.append('isPromo', document.getElementById('promo').checked);

    request(window.location.origin + '/product-creator', 'POST', formData, {}).then(message => {
        document.getElementById('product-creator__action-button').disabled = false;

        if (message) {
            window.location.replace(window.location.origin);
        }
    });
});

document.getElementById('images').addEventListener('change', () => handleUpload('images'));

checkboxControlNames.forEach(controlName => {
    document.getElementById(controlName).addEventListener('change', () => {
        if (isTextControlInvalid()) {
            return;
        }

        document.getElementById('product-creator__action-button').disabled = false;
    });
});

handleControlsEvent(textControlNames, 'keydown', debounce(() => changeDisabledStatus(), 1000));
