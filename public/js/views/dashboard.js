include('public/js/utils/request.js');

window.addEventListener('load', () => {
    loadUser();
    loadProducts();
});

const searchInput = document.querySelector('input[type="search"');
const activeCheckbox = document.getElementById('active');
const promoCheckbox = document.getElementById('promo');

searchInput.addEventListener('keydown', debounce(() =>
    loadProducts(searchInput.value, activeCheckbox.checked, promoCheckbox.checked)
, 1000));

[activeCheckbox, promoCheckbox].forEach(control =>
    control.addEventListener('change', () =>
        loadProducts(searchInput.value, activeCheckbox.checked, promoCheckbox.checked)
    )
);

const containers = [];

function getAvatar(user) {
    if (user && user.avatar) {
        const img = document.createElement('img');
        img.setAttribute('alt', 'Avatar of ' + user.username);
        img.setAttribute('src', user.avatar);
        img.classList.add('dashboard__avatar');

        img.addEventListener('click', () =>
            document.querySelector('.dashboard__dropdown-content').classList.toggle('dashboard__dropdown-content--show')
        );
        
        return img;
    }

    const blankAvatar = document.createElement('div');
    blankAvatar.classList.add('dashboard__avatar--blank');
    blankAvatar.addEventListener('click', () =>
        document.querySelector('.dashboard__dropdown-content').classList.toggle('dashboard__dropdown-content--show')
    );

    return blankAvatar;
}

function loadUser() {
    request('session/user', 'GET', null, {}).then(user => {
        const dropdownContainer = document.getElementById('dashboard__dropdown');
        dropdownContainer.appendChild(getAvatar(user));

        const dropdown = document.createElement('div');
        dropdown.classList.add('dashboard__dropdown-content');
        dropdownContainer.appendChild(dropdown);

        const logOutButton = document.createElement('button');
        logOutButton.classList.add('btn', 'btn-secondary', 'w-100');
        logOutButton.style.textAlign = 'left';
        logOutButton.innerText = 'Log out';

        logOutButton.addEventListener('click', () =>
            request('session/logOut', 'POST', null, {}).then(() =>
                window.location.replace(window.location.origin)
            )
        );

        dropdown.appendChild(logOutButton);

        if (user && user.role === 'admin') {
            const productCreatorButton = document.createElement('a');
            productCreatorButton.classList.add('w-100');
            productCreatorButton.innerText = 'Creator of product';
            productCreatorButton.setAttribute('href', '/product-creator');
            dropdown.appendChild(productCreatorButton);

            const usersButton = document.createElement('a');
            usersButton.classList.add('w-100');
            usersButton.innerText = 'Users';
            usersButton.setAttribute('href', '/users');
            dropdown.appendChild(usersButton);
    
            const userCreatorButton = document.createElement('a');
            userCreatorButton.classList.add('w-100');
            userCreatorButton.innerText = 'Creator of user';
            userCreatorButton.setAttribute('href', '/user-creator');
            dropdown.appendChild(userCreatorButton);
        }
    });
}

function loadProducts(search = '', active = true, promo = false) {
    let interval;
    let value = 45;

    if (document.getElementById('spinner')) {
        document.getElementById('spinner').style.display = 'block';

        interval = setInterval(() => {
            document.getElementById('spinner').style.transform = 'rotate(' + value + 'deg)';
            value += 45;
        }, 100);
    }

    request('products?' + new URLSearchParams({
        search,
        active,
        promo
    }), 'GET', null, {}).then(products => {
        if (containers.length) {
            containers.forEach(() => containers.shift().remove());
        }

        if (products.length) {
            document.querySelector('.dashboard__content-empty').style.display = 'none';

            products.forEach(product => {
                const container = document.createElement('div');
                container.classList.add('col-md-4');
                containers.push(container);
    
                const parent = document.createElement('div');
                parent.classList.add('col-md-12', 'dashboard__product');
                container.appendChild(parent);
    
                const img = document.createElement('img');
                img.setAttribute('src', product.images[0]);
                img.setAttribute('alt', 'Image of ' + product.name);
                img.classList.add('w-100');
                parent.appendChild(img);
    
                const child = document.createElement('div');
                parent.appendChild(child);
    
                const h4 = document.createElement('h4');
                h4.innerText = product.name;
                child.appendChild(h4);
    
                const p = document.createElement('p');
                p.innerText = product.description;
                child.appendChild(p);

                const rateContainer = document.createElement('div');
                child.appendChild(rateContainer);

                for (let i = 0; i < 5; i++) {
                    const rate = document.createElement('img');
                    rate.src = 'public/icons/star.svg';
                    rateContainer.appendChild(rate);
                }
    
                const button = document.createElement('button');
                button.innerText = 'Show details';
                button.classList.add('btn', 'btn-primary', 'w-100', 'dashboard__product-button');
                button.setAttribute('type', 'button');
                child.appendChild(button);
    
                container.style.display = 'none';
                document.querySelector('.dashboard__content').appendChild(container);
            });

            containers.forEach(container => container.style.display = 'block');

            if (document.getElementById('spinner')) {
                document.getElementById('spinner').style.display = 'none';
            }

            if (interval) {
                clearInterval(interval);
            }

            return;
        }
        
        if (document.getElementById('spinner')) {
            document.getElementById('spinner').style.display = 'none';
        }

        document.querySelector('.dashboard__content-empty').style.display = 'flex';
    });
}
