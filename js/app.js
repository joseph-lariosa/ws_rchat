

function changeValue(o){
    document.getElementById('chat_input').value="@" + o.innerHTML + " ";
}


function autoScrolling() {
    $(".scroll_lock").animate({
        scrollTop: $(".scroll_lock")[0].scrollHeight
    }, 100);
}

function autoScrolling_msg() {
    $(".default_scroll").animate({
        scrollTop: $(".default_scroll")[0].scrollHeight
    }, 100);
}


document.addEventListener("DOMContentLoaded", function(event) {
    autoScrolling();
});

$('#chat_output').scroll(function() {
    var st = $(this).scrollTop(); 
    if( st > 500 ) {
    $("#chat_output").addClass("scroll_lock"); 
    } else {
    $("#chat_output").removeClass("scroll_lock"); 
    }
}); 



//Emoji Selector
window.addEventListener('DOMContentLoaded', () => {
    const button = document.querySelector('#emoji');
    const picker = new EmojiButton();
  
    picker.on('emoji', emoji => {
      document.querySelector('#chat_input').value += emoji;
      
    });
  
    button.addEventListener('click', () => {
      picker.togglePicker(button);
      picker.preventDefault();

    });
  });   
  