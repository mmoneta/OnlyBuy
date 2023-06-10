include('public/js/send-data.js');

window.addEventListener('load', () => {
    sendData('products', null, {
        method: "GET"
    }).then(products => {
        console.log(products);
    });
})
