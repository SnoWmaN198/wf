$('#search_form').on('submit', function (event) {
	event.preventDefault();
	if (! $('#searchInput').val() == '') {
	$("#result").html('');
	$.getJSON(
			"/en/brand/search?pattern=" + $('#searchInput').val(),
			function (serverResult) {
				console.log(serverResult);
				serverResult.data.forEach(function(element) {
					$('#result').append('<li>' + element.name + '</li>');
				});
			}
		);
	}
});
