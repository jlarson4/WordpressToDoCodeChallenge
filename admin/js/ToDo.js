//boring standard javascript function for the textboxes
function clearContents(element) {
	if (element.value == "Title for your new To Do Items" || element.value == "To Do description") {
  		element.value = "";
	} 
}