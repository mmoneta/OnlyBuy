include('public/js/utils/alert.js');
include('public/js/utils/request.js');

let activePanelId;
let interval;
let value = 45;
let username = '';

const controlNames = ['password', 'repeat-password'];
const systemRoles = {};

window.addEventListener('load', () => {
    if (document.getElementById('spinner')) {
        document.getElementById('spinner').style.display = 'block';

        interval = setInterval(() => {
            document.getElementById('spinner').style.transform = 'rotate(' + value + 'deg)';
            value += 45;
        }, 100);
    }

    loadUser();
    loadRoles();
    initTabs();
});

document.getElementById('user-editor__action-button').addEventListener('click', () => {
    document.getElementById('user-editor__action-button').disabled = true;

    const formData = getFormData();

    request(window.location.origin + '/user', 'PUT', JSON.stringify(formData), {}).then(message => {
        document.getElementById('user-editor__action-button').disabled = false;

        if (message) {
            window.location.replace(
                window.location.origin + "/users"
            );
            return;
        }

        alert('User has not been updated.')
    });
});

function changeDisabledStatus() {
    if (activePanelId === '#change-password') {
        if (
            document.getElementById('password').validity.valid
            && document.getElementById('repeat-password').validity.valid
        ) {
            document.getElementById('user-editor__action-button').disabled = false;
            return;
        }

        document.getElementById('user-editor__action-button').disabled = true;
        return;
    }

    if (
        activePanelId === '#change-role'
        && systemRoles[document.getElementById('role').value]
            !== document.getElementById('role').getAttribute('data-initial-value')
    ) {
        document.getElementById('user-editor__action-button').disabled = false;
        return;
    }

    document.getElementById('user-editor__action-button').disabled = true;
}

document.getElementById('role').addEventListener('change', () => changeDisabledStatus());

handleControlsEvent(controlNames, 'keydown', debounce(() => changeDisabledStatus(), 1000));

function loadRoles() {
    request(window.location.origin + '/roles', 'GET').then(roles => {
        roles.forEach(role => {
            systemRoles[role.roleId] = role.name;

            const option = document.createElement('option');

            option.value = role.roleId;
            option.innerHTML = role.name;

            document.getElementById('role').appendChild(option);
        });
    });
}

function loadUser() {
    request(window.location.origin + '/users/' + window.location.href.split('/').slice(-1), 'GET').then(user => {
        if (user) {
            username = user.username;

            document.getElementById('user-editor__title').innerText = user.username;

            document.getElementById('username').value = user.username;
            document.getElementById('username').disabled = true;

            document.getElementById('email').value = user.email;
            document.getElementById('email').disabled = true;
            
            document.getElementById('role').value = user.role;
            document.getElementById('role').setAttribute('data-initial-value', user.role);

            if (document.getElementById('spinner')) {
                document.getElementById('spinner').style.display = 'none';
            }
    
            if (interval) {
                clearInterval(interval);
            }
    
            document.querySelector('.content').style.display = 'block';
        }
    });
}

function getFormData() {
    if (activePanelId === '#change-password') {
        return {
            username,
            password: document.getElementById('password').value
        }
    }

    return {
        username,
        roleId: document.getElementById('role').value
    }
}

function initTabs() {
    const tabs = document.querySelectorAll("ul.nav-tabs > li");

    tabs.forEach(tab => tab.addEventListener("click", tabClick));
}

function tabClick(tabClickEvent) {
    const tabs = document.querySelectorAll("ul.nav-tabs > li");

    tabs.forEach(tab => tab.classList.remove("active"));

    const clickedTab = tabClickEvent.currentTarget;
    clickedTab.classList.add("active");

    tabClickEvent.preventDefault();

    const contentPanels = document.querySelectorAll(".tab-pane");

    contentPanels.forEach(contentPanel => contentPanel.classList.remove("active"));

    const anchorReference = tabClickEvent.target;
    activePanelId = anchorReference.getAttribute("href");
    const activePanel = document.querySelector(activePanelId);

    changeDisabledStatus();

    activePanel.classList.add("active");
}