include('public/js/utils/request.js');

window.addEventListener('load', () => {
    request('products', 'GET', null, {}).then(products => {
        const container = document.getElementById('dashboard__content');

        products.forEach(product => {
            
        });
    });
})
