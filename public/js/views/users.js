include('public/js/utils/date.js');
include('public/js/utils/request.js');
include('public/js/utils/table.js');

window.addEventListener('load', () => {
    let interval;
    let value = 45;

    if (document.getElementById('spinner')) {
        document.getElementById('spinner').style.display = 'block';

        interval = setInterval(() => {
            document.getElementById('spinner').style.transform = 'rotate(' + value + 'deg)';
            value += 45;
        }, 100);
    }

    request(window.location.origin + '/users', 'GET').then(users => {
        users.forEach(user => {
            const row = document.createElement('tr');

            addCell(row, user.username);
            addCell(row, user.email);
            addCell(row, user.role);
            addCell(row, getDate(user.createdDate));
            addCell(row, getDate(user.modifiedDate));

            const link = document.createElement('a');
            link.innerText = 'Edit';
            link.setAttribute('href', '/users/' + user.username);
            link.setAttribute('title', 'Edit');

            addCell(row, link);

            document.getElementById('users__table').appendChild(row);
        });

        if (document.getElementById('spinner')) {
            document.getElementById('spinner').style.display = 'none';
        }

        if (interval) {
            clearInterval(interval);
        }

        document.getElementById('users__table').style.display = 'table';
    });
});
