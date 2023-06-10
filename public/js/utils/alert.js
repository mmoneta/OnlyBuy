function alert(alertMessage, timeout = 3000) {
   const alerts = document.getElementById("alert-container");
   
   if (alerts.childElementCount < 2) {
      // Create alert box
      const alertBox = document.createElement("div");
      alertBox.classList.add("alert-message", "slide-in");

      // Add message to alert box
      const alertMessageNode = document.createTextNode(alertMessage);
      alertBox.appendChild(alertMessageNode);

      // Add alert box to parent
      alerts.insertBefore(alertBox, alerts.childNodes[0]);

      // Remove last alert box
      if (alerts.childNodes[1]) {
         alerts.childNodes[1].classList.add("slide-out");
      }

      setTimeout(() => {
         alerts.removeChild(alerts.lastChild);
      }, timeout);
   }
}
