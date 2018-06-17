
function createDiv(){

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("txtHint").innerHTML = this.responseText;

         }
        };
            xmlhttp.open("POST", "../../controllers/notification.php?controller=pages&action=notification", true);
            xmlhttp.send();
            return false;
        }
    createDiv();
    setInterval(createDiv, 7000);




