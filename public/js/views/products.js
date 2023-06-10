include('public/js/utils/request.js');

window.addEventListener('load', () => {
    request('products', 'GET', null, {}).then(products => {
        console.log(products);
    });
})
