/**
 * Admin Main JS file
*/
 

// Admin Index
function removeItem (este) {
	var forReal = confirm("Tem a certeza que quer apagar o registo?");
	if (forReal) $(este).closest('form').submit();
}

