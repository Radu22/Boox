function verifyBook(){

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //document.getElementById("notif_nr").innerHTML = this.responseText;
            console.log(this.responseText);
         }
        };
            xmlhttp.open("POST", "../../controllers/verify.php", true);
            xmlhttp.send();
            return false;
        }
verifyBook();
setInterval(verifyBook, 7000);