include('public/js/utils/alert.js');
include('public/js/views/base-user-creator.js');
include('public/js/utils/request.js');

window.addEventListener('load', () => {
    window.actionButtonName = 'register__action-button';
});

document.getElementById('register__action-button').addEventListener('click', () => {
    document.getElementById('register__action-button').disabled = true;

    const formData = getFormData();

    request(window.location.origin + '/register', 'POST', formData, {}).then(message => {
        document.getElementById('register__action-button').disabled = false;

        if (message) {
            window.location.replace(
                window.location.origin + "/login"
            );
            return;
        }

        document.getElementById('register__action-button').disabled = false;
        alert('User has not been created.')
    });
});
