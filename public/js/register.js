document.getElementById('register__action-button').addEventListener('click', () => {
    postData('registers', {
        username: document.getElementById('username').value,
        email: document.getElementById('email').value,
        password: document.getElementById('password').value,
    }).then((data) => {
        console.log(data); // JSON data parsed by `data.json()` call
    });
});
