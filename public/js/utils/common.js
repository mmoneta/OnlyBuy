function handleControlsEvent(controlNames, event, callback) {
    controlNames.forEach(controlName => {
        document.getElementById(controlName).addEventListener(event, callback);
    });
}