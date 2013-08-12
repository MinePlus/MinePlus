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
    $('.chat-log').append(msg + '<br />');
    $('.chat-log').scrollTop($('.chat-log')[0].scrollHeight);
}