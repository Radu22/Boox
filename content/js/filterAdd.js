// Returns books filtered after their title for my books page

function getFiltered(){
    var input, field, len, tr, title;

    input = document.getElementById("filter");
    field = input.value.toUpperCase();
    len = document.getElementsByTagName("table")[0].getElementsByTagName("tbody")[0].getElementsByTagName("tr").length;

    for( i = 0; i < len; ++i)
    {
        tr = document.getElementsByTagName("table")[0].getElementsByTagName("tbody")[0].getElementsByTagName("tr")[i];
        title = tr.getElementsByTagName("td")[1];

        if(title.innerHTML.toUpperCase().indexOf(field) > -1){
            tr.style.display = "";
        }else{
            tr.style.display = "none";
        }

    }
}