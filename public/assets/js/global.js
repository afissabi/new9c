function validation_form(error, form_id) {
    var errors = error.responseJSON.errors;

    var i = 1;
    for (var item in errors) {
        $("#" + form_id + " #fb_" + item).text(errors[item][0]);
        $("#" + form_id + " #fb_" + item).slideDown(i * 50 + 125);
        i++;
    }
}

function reset_form(form_id, is_reset = 1) {
    let i = 1;
    $("#" + form_id + " .form_feedback").each(function () {
        let id_feedback = $(this).attr("id");
        let id_input = id_feedback.substring(3);
        let input_type = $("#" + form_id + " #" + id_input).data("type");
        let is_skip = $("#" + form_id + " #" + id_input).data("skip");
        let is_hidden = $("#" + form_id + " #" + id_input).data("is-hidden");
        let default_value = $("#" + form_id + " #" + id_input).data("default-value");

        if (is_skip != undefined && is_skip == true) {
            return;
        }

        if (is_hidden != undefined && is_hidden == true && is_reset == 1) {
            $("#" + form_id + " #div_" + id_input).slideUp(250);
        }

        $("#" + form_id + " #" + id_feedback).slideUp(i * 50 + 125);
        $("#" + form_id + " #" + id_feedback).text("");

        if (is_reset) {
            let value = "";
            if (default_value != undefined) {
                value = default_value;
            }
            switch (input_type) {
                case "text":
                    $("#" + form_id + " #" + id_input).val(value).trigger("input");
                    break;

                case "textarea":
                    $("#" + form_id + " #" + id_input).val(value);
                    break;

                case "switch":
                case "checkbox":
                    $("#" + form_id + " #" + id_input).prop("checked", false).trigger("change");
                    break;

                case "select2":
                    $("#" + form_id + " #" + id_input)
                        .val(value)
                        .trigger("change");
                    break;

                case "file":
                    $("#" + form_id + " #" + id_input)
                        .val(value);
                    break;
            }
        }

        i++;
    });
}

function search_object(_object, _key, _value) {
    let obj = _object.find((o) => o[_key] === _value);
    return obj;
}

function search_index_object(_object, _key, _value) {
    var index = -1;
    _object.find((o, i) => {
        if (o[_key] === _value) {
            // console.log(i);
            index = i;
            return;
        }
    });
    return index;
}

function helpCurrency(value='', logo_currency='', pemisah='.', pemisah_sen=',', end='') {
    value = String(value);
    if(value == '' || value == 'null'){
        value = '0';
    }

    var split_value = value.split(".");

    if(end != ''){
        end = pemisah_sen+end;
    }

    if(split_value.length > 1){
        if(split_value[1].length == 1){
            end = pemisah_sen+split_value[1]+'0';
        }else{
            end = pemisah_sen+split_value[1];
        }
    }

    return logo_currency + split_value[0].split("").reverse().reduce(function(acc, value, i, orig) {
        return  value=="-" ? acc : value + (i && !(i % 3) ? pemisah : "") + acc;
    }, "") + end;
}

function sortArray(object_name, keyName) {
    if (object_name.length < 2) {
        return object_name;
    }
    let byName = object_name.slice(0);
    byName.sort(function(a, b) {
        var x = a[keyName].toLowerCase();
        var y = b[keyName].toLowerCase();
        return x < y ? -1 : x > y ? 1 : 0;
    });
    return byName;
}

function ajax_select2({select_id, url, ajaxData = null, value = "", options = {text: "text", value: "id"}, async = true}) {
    $.ajax({
        url: url,
        type: (ajaxData != null ? "POST" : "GET"),
        data: ajaxData,
        async: async,
        headers: {
            "X-CSRF-TOKEN": $(`meta[name="csrf-token"]`).attr("content")
        },
        success: function(data) {
            if (data.status) {
                data = data.data;

				$(`#${select_id}`).html(`<option value="" selected>Pilih</option>`);

                for (let item of data) {
                    let newOption = new Option(item[options.text], item[options.value], false, false);
                    $(`#${select_id}`).append(newOption);
                }

                if (value == "") {
                    $(`#${select_id}`).val(value).trigger("change");
                } else {
                    setTimeout(function() {
                        $(`#${select_id}`).val(value).trigger("change");
                    }, 0);
                }
                console.log(select_id)
            }
        },
        error: function(error) {
            console.log(error);
        }
    });
}
