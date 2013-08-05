$(document).ready(function () {
    function connect() {   
        try {
            socket.onopen = function() {
                setIndicator(true);
            }

            socket.onmessage = function(msg) {
                message(JSON.parse(msg.data));
            }

            socket.onclose = function() {
                setIndicator(false);
            }

        } catch (exception) {
            alert(exception);
        }
    }

    function send(path, parameters) {
        var json = {
            'path': path,
            'parameters': parameters
        };
        console.log(json);
        socket.send(JSON.stringify(json));
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
    
    function message(msg) {
        $('.chat-log').append(msg.parameters.message + '<br />');
        $('.chat-log').scrollTop($('.chat-log')[0].scrollHeight);
    }
    
    var url = window.location.hostname;
    url = 'ws://' + url.replace('/', '') + ':8081';
                    
    var socket = new WebSocket(url);
                    
    connect();
    rescaleChat();
                    
    $('#chat-send').click(function () {
        send('chat/send', { 'message': $('#chat-textarea').val() });
    });
});