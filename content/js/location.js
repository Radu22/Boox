function updateDB(){

        var c = function(pos){
        var lat = pos.coords.latitude,
            long= pos.coords.longitude,
            coords = lat + ', ' + long;
            //console.log(coords);

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //console.log(this.responseText);
                    //document.getElementById("txtHint").innerHTML = this.responseText;
         }
        };
            xmlhttp.open("POST", "../../controllers/location.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("lat=" + lat + "&long="+ long);
        }

        navigator.geolocation.watchPosition(c);
        return false;
    }
    updateDB();
    setInterval(updateDB, 1000);