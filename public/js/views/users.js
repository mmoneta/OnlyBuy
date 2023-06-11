include('public/js/utils/date.js');
include('public/js/utils/request.js');
include('public/js/utils/table.js');

window.addEventListener('load', () => {
    request('users', 'GET').then(users => {
        users.forEach(user => {
            const row = document.createElement('tr');

            addCell(row, user.username);
            addCell(row, user.email);
            addCell(row, user.role);
            addCell(row, getDate(user.createdDate));
            addCell(row, getDate(user.modifiedDate));

            const link = document.createElement('a');
            link.innerText = 'Edit';
            link.setAttribute('href', '/users/' + user.username + '/edit');
            link.setAttribute('title', 'Edit');

            addCell(row, link);

            document.getElementById('users__table').appendChild(row);
        });
    });
});
