var user_id = Math.random();

var conn = new WebSocket('ws://ratchet.dev:8080');

conn.onopen = function(e) {
	console.log('Connection enabled');
}

conn.onmessage = function(e) {
	console.log(e.data);
	addMsg(e.data);
}

function addMsg(msg) {
	var entry = $('<span />').addClass('h').html(msg);
	$('#chatWindow > span.h').append(entry);
}

$(function()
{
	

	var sendo = function()
	{
		var $this = $('#msg'),
		    message = $this.val();
	
		conn.send(message);	
		addMsg(message);
		$this.val('');
	}

	// $(document).on('submit', '#frm', sendo);
});