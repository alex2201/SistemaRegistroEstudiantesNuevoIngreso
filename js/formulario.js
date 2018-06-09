// Fill previous school options.

const select = $("#previous_school");

let school_options = "";
let i;
for (i = 1; i <= 18; i++) {
    school_options += `<option value="${i}"> CECyT ${i}</option>` + "\n";
}
school_options += "<option value=\"19\"> CET 1 </option>" + "\n";
school_options += "<option value=\"20\"> Otro </option>" + "\n";
select.append(school_options);

$(document).ready(function () {
    $(".button-collapse").sideNav();

    $('select').material_select();

    $(".datepicker").pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 100, // Creates a dropdown of 15 years to control year
        closeOnSelect: false // Close upon selecting a date
    });

    // Validation.

    $("#register_form").validetta({
        bubblePosition: 'bottom',
        bubbleGapTop: 10,
        bubbleGapLeft: -5,
        onValid: function (e) {
            e.preventDefault();
            const data = new FormData($("#register_form")[0]);
            $.ajax({
                method: "post",
                url: "app/registrar.php",
                data: data,
                enctype: 'multipart/form-data',
                cache: false,
                contentType: false,
                processData: false,
                error: function (e, status, error) {
                    alert(error.toString());
                },
                success: function (response, request) {
                    alert(response);
                    // $("#btn_reset").trigger("click");
                }
            });
        }
    });

});