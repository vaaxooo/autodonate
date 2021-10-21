$(document).ready(function () {
    const csrf = $('meta[name="csrf-token"]').attr('content');

    $("#ticketSendMessage").click(function (e) {
        e.preventDefault();
        $('#ticketSendMessageForm').submit();
    });

    /*
        IMAGES UPLOAD HANDLE
    */
    $("#product_image_delete").click(function (e) {
        e.preventDefault();
        $('#product_image').attr("src", window.location.origin + "/assets/images/product_default_image.svg");
        $("#image").val("");
        $("#image_delete").val("true");
    });

    $("#image").change(function (e) {
        e.preventDefault();
        $("#image_delete").val("");
        const file = $("#image").prop('files')[0];
        if (file) {
            const fileReader = new FileReader();
            fileReader.readAsDataURL(file);
            fileReader.addEventListener("load", function () {
                  $('#product_image').attr("src", this.result);
            });
        }
    });
    /*
        IMAGES UPLOAD HANDLE END
    */

    /*
        PRODUCTS HANDLE
    */
    $(".timeout_days_help").click(function (e) {
        e.preventDefault();
        $('#withdraw_command_timeout').val(e.target.getAttribute('data-time'));
    });
    /*
        END PRODUCTS HANDLE
    */

    $("#twofactor").click(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/account/security',
            data: {twofactor: 'twofactor', _token: csrf},
            success: function (data) {
                window.location.href = window.location.href;
            }
        });
    });

    $("#twofactor_refresh").click(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'GET',
            url: '/account/login/two-factor/refresh',
            data: {_token: csrf},
            success: function (data) {
                if (data.status && data.message) {
                    $("#errors").html('');
                    $("#message").html(`<span class="text-success d-block"><em class="icon ni ni-check"></em> ${data.message}</span>`);
                } else {
                    let message = JSON.parse(data.message);
                    $("#message").html('');
                    $("#errors").html(`<span class="text-danger d-block"><em class="icon ni ni-cross"></em> ${message['Auth error']}</span>`);
                }
            }
        });
    });

    $("#logs").change(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/account/security',
            data: {logs: $('#logs').is(':checked'), _token: csrf},
            success: function (data) {
                window.location.href = window.location.href;
            }
        });
    });

    $("#smtp_unusual_activity").change(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/account/security',
            data: {smtp_unusual_activity: $('#smtp_unusual_activity').is(':checked'), _token: csrf},
            success: function (data) {
                window.location.href = window.location.href;
            }
        });
    });

    $("#smtp_new_browser").change(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/account/security',
            data: {smtp_new_browser: $('#smtp_new_browser').is(':checked'), _token: csrf},
            success: function (data) {
                window.location.href = window.location.href;
            }
        });
    });

    if(document.querySelector('form')){
        document.querySelector('form').addEventListener('submit', (e) => {
            e.preventDefault();
            const form = e.target;
            const data = Object.fromEntries(new FormData(e.target).entries());
            let formData = new FormData();

            $.each(data, function(i, val) {
              formData.append(i, val);
            });

            $.ajax({
                type: $(form).attr('method'),
                url: $(form).attr('action'),
                data: formData,
                cache : false,
                processData: false,
                contentType: false,
                success: function (data) {
                    $('#message').html('');
                    $('#errors').html('');
                    if (!data.status) {
                        let errors = JSON.parse(data.errors);
                        for (let field in errors) {
                            $("#errors").append(`<span class="text-danger d-block"><em class="icon ni ni-cross"></em> ${errors[field]}</span>`);
                        }
                    }
                    if (data.status && data.redirect) {
                        window.location.href = data.redirect;
                    }

                    if (data.status && !data.redirect && data.message) {
                        $("#message").append(`<span class="text-success d-block"><em class="icon ni ni-check"></em> ${data.message}</span>`);
                    }

                }
            });
        });
    }

});