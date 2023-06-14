include('public/js/utils/request.js');

window.addEventListener('load', () => loadProducts());

const searchInput = document.querySelector('input[type="search"');
const activeCheckbox = document.getElementById('active');
const promoCheckbox = document.getElementById('promo');

searchInput.addEventListener('keydown', debounce(() => {
    loadProducts(searchInput.value, activeCheckbox.checked, promoCheckbox.checked);
}, 1000));

[activeCheckbox, promoCheckbox].forEach(control =>
    control.addEventListener('change', () =>
        loadProducts(searchInput.value, activeCheckbox.checked, promoCheckbox.checked)
    )
);

const containers = [];

function loadProducts(search = '', active = true, promo = false) {
    let value = 45;

    const interval = setInterval(() => {
        document.getElementById('spinner').style.transform = 'rotate(' + value + 'deg)';
        value += 45;
    }, 100);

    document.getElementById('spinner').style.display = 'block';

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

                const rate = document.createElement('div');
                p.innerText = product.description;
                child.appendChild(p);
    
                const button = document.createElement('button');
                button.innerText = 'Show details';
                button.classList.add('btn', 'btn-primary', 'w-100', 'dashboard__product-button');
                button.setAttribute('type', 'button');
                child.appendChild(button);
    
                container.style.display = 'none';
                document.querySelector('.dashboard__content').appendChild(container);
            });

            containers.forEach(container => container.style.display = 'block');
            document.getElementById('spinner').style.display = 'none';
            clearInterval(interval);

            return;
        }
        
        document.getElementById('spinner').style.display = 'none';
        document.querySelector('.dashboard__content-empty').style.display = 'flex';
    });
}
