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

    request('product-creator', 'POST', formData, {}).then(message => {
        document.getElementById('product-creator__action-button').disabled = false;

        if (message) {
            window.location.replace(window.location.origin);
        }
    });
});

const preview = document.querySelector('.preview');

document.getElementById('images').addEventListener('change', () => {
    while(preview.firstChild) {
        preview.removeChild(preview.firstChild);
    }
    
    const currentFiles = document.getElementById('images').files;
  
    if (currentFiles.length === 0) {
        const paragraph = document.createElement('p');
        paragraph.textContent = 'No files currently selected for upload';
        preview.appendChild(paragraph);
        return;
    }

    const list = document.createElement('ol');
    preview.appendChild(list);

    for (const file of currentFiles) {
        const listItem = document.createElement('li');
        const paragraph = document.createElement('p');

        if (validFileType(file)) {
            paragraph.innerHTML = `
                File name: ${file.name}
                <br />
                File size: ${returnFileSize(file.size)}.
            `;
            paragraph.style = 'margin: 10px 0; line-height: 24px';
            const image = document.createElement('img');
            image.src = URL.createObjectURL(file);
            listItem.appendChild(image);
            listItem.appendChild(paragraph);
        } else {
            paragraph.textContent = `File name ${file.name}: not a valid file type. Update your selection.`;
            listItem.appendChild(paragraph);
        }

        list.appendChild(listItem);
    }    
});

checkboxControlNames.forEach(controlName => {
    document.getElementById(controlName).addEventListener('change', () => {
        if (isTextControlInvalid()) {
            return;
        }

        document.getElementById('product-creator__action-button').disabled = false;
    });
});

textControlNames.forEach(controlName => {
    document.getElementById(controlName).addEventListener('keydown', debounce(() => {
        changeDisabledStatus();
    }, 1000));
});
