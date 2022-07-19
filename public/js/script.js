(function($){
    $(document).ready(function() {
        $('.store-form').validate({
            rules: {
                amount: {
                    required: true,
                    number: true
                },

                buyer: {
                    alphanumeric: true,
                    maxlength: 20
                },

                receipt_id: {
                    lettersonly: true,
                },

                items: {
                    lettersonly: true,
                },

                buyer_email: {
                    email: true
                },

                note: {
                    maxWords: 30
                },

                city: {
                    lettersonly: true,
                },

                phone: {
                    number: true
                },

                entry_by: {
                    number: true
                }
            },

            messages: {
                amount: {
                    required: "Please enter amount",
                    number: "Please enter only number"
                }
            },
            
            submitHandler: function(form) {
                $.ajax({
                    url: '/store',
                    type: 'post',
                    data: $(form).serialize(),
                    success: function(res) {
                        if (res) {
                            let alertbox = `<div class="alert alert-success" role="alert">
                            Successfully created item!
                          </div>`
                            $('.container').prepend(alertbox);
                            form.reset();
                        }
                    }
                });
                return false;
            }
        });
    });
})(jQuery);