var currUrl = window.location.href.split('/');
currUrl.pop();
var globalUrl = currUrl.join('/');
// console.log(globalUrl);


$(document).ready(function () {
    //Pemilihan Role
    $('#role').on('change', function () {
        // Set selected option as variable
        var selectValue = $(this).val();
        // console.log(selectValue);

        //Jika memilih role Administrator Sistem maka selecte option fakultas akan hide
        if (selectValue == "Administrator Sistem") {
            $("#fakultas_select").hide();
        }
        else {
            //Jika memilih role Administrator Sistem maka selecte option fakultas akan show
            $("#fakultas_select").show();
        }

    });
});

