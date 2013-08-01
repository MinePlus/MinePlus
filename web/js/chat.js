function connect(host) {   
    try {
        var socket = new WebSocket(host);
        
        socket.onopen = function() {
            $('.chat-indicator').removeClass('btn-primary');
            $('.chat-indicator').addClass('btn-success');
        }
        
        socket.onmessage = function(msg) {
            $('.chat-log').append(msg.data + '<br />');
        }
        
        socket.onclose = function() {
            $('.chat-indicator').removeClass('btn-success');
            $('.chat-indicator').addClass('btn-danger');
        }
        
    } catch (exception) {
        alert(exception);
    }
}