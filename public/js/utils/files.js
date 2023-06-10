const fileTypes = [
  "image/jpeg",
  "image/pjpeg",
  "image/png"
];
  
function validFileType(file) {
  return fileTypes.includes(file.type);
}

function returnFileSize(number) {
  if (number < 1024) {
    return `${number} bytes`;
  }
  
  if (number >= 1024 && number < 1048576) {
    return `${(number / 1024).toFixed(1)} KB`;
  }
  
  if (number >= 1048576) {
    return `${(number / 1048576).toFixed(1)} MB`;
  }
}

function handleUpload(inputFileName) {
  const preview = document.querySelector('.preview');

  while(preview.firstChild) {
    preview.removeChild(preview.firstChild);
  }

  const currentFiles = document.getElementById(inputFileName).files;

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
}