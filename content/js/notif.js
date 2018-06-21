function getNumber(){

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("notif_nr").innerHTML = this.responseText;
         }
        };
            xmlhttp.open("POST", "../../controllers/notif_number.php", true);
            xmlhttp.send();
            return false;
        }
getNumber();
setInterval(getNumber, 7000);