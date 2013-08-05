function connect(host) {   
    try {
        var socket = new WebSocket(host);
        
        socket.onopen = function() {
            setIndicator(true);
        }
        
        socket.onmessage = function(msg) {
            $('.chat-log').append(msg.data + '<br />');
        }
        
        socket.onclose = function() {
            setIndicator(false);
        }
        
    } catch (exception) {
        alert(exception);
    }
}

function setIndicator(success) {
    if (success) {
        $('.chat-indicator').removeClass('btn-primary');
        $('.chat-indicator').addClass('btn-success');
        $('.chat-indicator').removeClass('disabled');
    } else {
        $('.chat-indicator').removeClass('btn-success');
        $('.chat-indicator').addClass('btn-danger');
        $('.chat-indicator').addClass('disabled');
    }
}

function rescaleChat() {
    var size = {width: $(window).width(), height: $(window).height()};
    
    $('.modal-body').height(0.7 * size.height);
}