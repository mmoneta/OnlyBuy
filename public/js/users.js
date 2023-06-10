include('public/js/send-data.js');

window.addEventListener('load', () => {
    sendData('users', null, {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
            "X-Requested-With": "XMLHttpRequest"
        }
    }).then(users => {
        users.forEach(user => {
            const row = document.createElement('tr');

            const usernameCell = document.createElement('td');
            usernameCell.innerText = user.username;
            row.appendChild(usernameCell);

            const roleCell = document.createElement('td');
            roleCell.innerText = user.role;
            row.appendChild(roleCell);

            const createdDateCell = document.createElement('td');
            createdDateCell.innerText = user.createdDate;
            row.appendChild(createdDateCell);

            const modifiedDateCell = document.createElement('td');
            modifiedDateCell.innerText = user.modifiedDate;
            row.appendChild(modifiedDateCell);

            document.getElementById('users__table').appendChild(row);
        });
    });
})
