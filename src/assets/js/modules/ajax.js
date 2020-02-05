import $ from "jquery";


function formCheckout() {
    function confirm(elem, url) {
        var data = $(elem).serialize();
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            dataType: 'json',
            beforeSend: function() {
                $('p.error').remove();
            },
            success: function(json) {

                if(Object.entries(json.error).length > 0)
                    for (const [key, value] of Object.entries(json.error)) {
                        $('[name="' + key + '"]').after('<p class="error">' + value + '</p>');
                    }
                else if(json.success) {
                    $('.order').removeClass('order-form').addClass('order-result');
                    // /*$(elem)[0].reset();
                    // document.querySelector('.pop.pop--call').classList.remove("active");
                    // openSuccess('Спасибо', json.success);*/
                }
                /*if(json.redirect) {
                    window.setTimeout(function(){
                        location = json.redirect;
                    }, 2000);
                }*/
            }
        });
    }

    $('.form--checkout').on('submit', function(){
        var url = this.getAttribute('data-url');

        confirm(this, url);

        return false;
    });
}

export {formCheckout}