if (document.getElementById('left-arrow')) {
    document.getElementById('left-arrow').addEventListener('click', () => 
        window.location.replace(window.location.origin)
    );
}

function include(file) {
    const script = document.createElement('script');
    script.src = file;
    script.type = 'text/javascript';
    script.defer = true;
 
    document.getElementsByTagName('head').item(0).appendChild(script);
}
