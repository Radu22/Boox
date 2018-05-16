
function getFiltered()
{
	var input, book_div, title, filter, current, len;
	input = document.getElementById("filter");
	filter = input.value.toUpperCase();
	len = document.getElementsByClassName("card").length;
	for(i = 0; i < len; i++)
	{
		book_div = document.getElementsByClassName("card")[i];
		title = book_div.getElementsByTagName("h2")[0];
		// console.log(title.innerHTML);
		if(title.innerHTML.toUpperCase().indexOf(filter) > -1)
		{
			book_div.style.display = "";
		}
		else
		{
			book_div.style.display = "none";
		}
	}

}