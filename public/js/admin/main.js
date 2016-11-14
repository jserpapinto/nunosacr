/**
 * Admin Main JS file
*/
 

// Admin Index
function removeArtist (este) {
	var forReal = confirm("Tem a certeza que quer apagar o registo?");
	if (forReal) $(este).closest('form').submit();
}