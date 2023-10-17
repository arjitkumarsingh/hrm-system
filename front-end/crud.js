$(document).ready(function () {

    $("#toggle-password").click(function () {
        if ($("#password").attr("type") == "password") {
            $("#password").attr("type", "text");
            $("#eye").attr("class", "bi bi-eye-slash")
        } else {
            $("#password").attr("type", "password");
            $("#eye").attr("class", "bi bi-eye")
        }
    });


    //============================= LEAVE =====================================

    // from.min = new Date().toISOString().split("T")[0];
    let todayDate = new Date().toISOString().split("T")[0];
    let fromDate;
    let toDate;
    $("#from").attr("min", todayDate);

    $("#from").on("change blur", function () {
        if (validateFromDate()) {
            $("#to").attr("min", fromDate);
            getDateDifference();
            validateForm();
        }
    });

    $("#to").on("change blur", function () {
        if (validateToDate()) {
            $("#from").attr("max", toDate);
            getDateDifference();
            validateForm();
        }
    });

    $(".ck-content").on("blur", function () {
        // validateReason();
        validateForm();
    });

    $("#leave-form").on("submit", function (e) {
        // return validateReason();
        return validateForm();
    });

    function getDateDifference() {
        if (fromDate && toDate) {
            let dateDiff = (Date.parse(toDate) - Date.parse(fromDate)) / (1000 * 60 * 60 * 24) + 1;
            console.log(dateDiff);
            $("#days").val(dateDiff);
        }
    }

    function validateFromDate() {
        fromDate = $("#from").val();
        let regexDate = /^[0-9]{4}-[0-9]{2}-[0-9]{2}$/;
        if (!regexDate.test(fromDate)) {
            // $("#fromErr-format").show();
            toastr.error('invalid format', "*From Date", {
                closeButton: true,
                progressBar: true,
                preventDuplicates: true,
                positionClass: "toast-bottom-center"
            });
            return false;
        } else if (fromDate < todayDate) {
            // $("#fromErr-format").hide();
            // $("#fromErr-past").show();
            toastr.error('invalid date', "*From Date", {
                closeButton: true,
                progressBar: true,
                preventDuplicates: true,
                positionClass: "toast-bottom-center"
            });
            return false;
        } else {
            // $("#fromErr-format").hide();
            // $("#fromErr-past").hide();
            return true;
        }
    }
    function validateToDate() {
        toDate = $("#to").val();
        let regexDate = /^[0-9]{4}-[0-9]{2}-[0-9]{2}$/;
        if (!regexDate.test(toDate)) {
            // $("#toErr-format").show();
            toastr.error('invalid format', "*To Date", {
                closeButton: true,
                progressBar: true,
                preventDuplicates: true,
                positionClass: "toast-bottom-center"
            });
            return false;
        } else if (toDate < fromDate) {
            // $("#toErr-format").hide();
            // $("#toErr-past").show();
            toastr.error('invalid date', "*To Date", {
                closeButton: true,
                progressBar: true,
                preventDuplicates: true,
                positionClass: "toast-bottom-center"
            });
            return false;
        } else {
            // $("#toErr-format").hide();
            // $("#toErr-past").hide();
            return true;
        }
    }
    function validateReason() {
        // let reasonValue = $("#reason").val();
        let reasonValue = $(".ck-content").text();
        // let regex = /^[\w-':() ]*$/;
        if (reasonValue.length == 0) {
            // $("#reasonErr-required").show();
            console.log(reasonValue);
            toastr.error('reason is required', "*Reason", {
                closeButton: true,
                progressBar: true,
                preventDuplicates: true,
                positionClass: "toast-bottom-center"
            });
            return false;
            // return validateForm();
        } else if (reasonValue.length < 20) {
            // $("#reasonErr-required").hide();
            // $("#reasonErr-short").show();
            toastr.error('reason is too short', "*Reason", {
                closeButton: true,
                progressBar: true,
                preventDuplicates: true,
                positionClass: "toast-bottom-center"
            });
            return false;
            // return validateForm();
            // } else if (!regex.test(reasonValue)) {
            //     $("#reasonErr-short").hide();
            //     $("#reasonErr-invalid").show();
            //     // return false;
            //     return validateForm();
        } else {
            // $("#reasonErr-required").hide();
            // $("#reasonErr-short").hide();
            // $("#reasonErr-invalid").hide();
            return true;
            // return validateForm();
        }
    }

    function validateForm() {
        let isValidFromDate = validateFromDate();
        let isValidToDate = validateToDate();
        let isValidReason = validateReason();
        if (isValidFromDate && isValidToDate && isValidReason) {
            $("#submit").prop("disabled", false);
            return true;
        } else {
            $("#submit").prop("disabled", true);
            return false;
        }
    }

    //=======================================================================


    $("#name").on("keyup blur", function () {
        validateName();
    });
    $("#email").on("keyup blur", function () {
        validateEmail();
    });
    $("#image").change(function () {
        validateImage();
    });
    $("#password").on("keyup blur", function () {
        validatePassword();
    });
    $("#phone").on("keyup blur", function () {
        validatePhone();
    });

    function validateName() {
        let nameValue = $("#name").val();
        let regex = /^[a-zA-Z-' ]*$/;
        if (nameValue.length == 0) {
            // $("#nameErr").html("*Name is required");
            toastr.error('name is required', "*Name", {
                closeButton: true,
                progressBar: true,
                preventDuplicates: true,
                positionClass: "toast-bottom-center"
            });
            return false;
        } else if (nameValue.length < 3) {
            // $("#nameErr").html("*Name must be at least 3 characters long");
            toastr.error('name must be at least 3 characters long', "*Name", {
                closeButton: true,
                progressBar: true,
                preventDuplicates: true,
                positionClass: "toast-bottom-center"
            });
            return false;
        } else if (!regex.test(nameValue)) {
            // $("#nameErr").html("*Only letters and white space allowed");
            toastr.error('only letters and white space allowed', "*Name", {
                closeButton: true,
                progressBar: true,
                preventDuplicates: true,
                positionClass: "toast-bottom-center"
            });
            return false;
        } else {
            // $("#nameErr").html("<br>");
            return true;
        }
    }
    function validateEmail() {
        let emailValue = $("#email").val();
        let regex = /^[a-zA-Z][a-zA-Z\d\w.]{2,30}@[a-zA-Z\d]{3,30}\.[a-zA-Z]{2,20}$/;
        if (emailValue.length == "") {
            // $("#emailErr").html("*Email is required");
            toastr.error('email is required', "*Email", {
                closeButton: true,
                progressBar: true,
                preventDuplicates: true,
                positionClass: "toast-bottom-center"
            });
            return false;
        } else if (!regex.test(emailValue)) {
            // $("#emailErr").html("*Invalid email format");
            toastr.error('invalid email format', "*Email", {
                closeButton: true,
                progressBar: true,
                preventDuplicates: true,
                positionClass: "toast-bottom-center"
            });
            return false;
        } else {
            // $("#emailErr").html("<br>");
            return true;
        }
    }
    function validateImage() {
        // file = e.target.files[0];
        // let file = $(event)[0].files[0];
        let file = $("#image")[0]['files'][0];
        if (file == undefined) {
            $("#imageErr").html("<br>");
            return true;
        }
        let name = file.name;
        let extension = name.substr(name.lastIndexOf("."));
        let size = Math.round(file.size / 1024);
        let allowedExtensionsRegx = /(\.jpg|\.png)$/i;
        let isAllowed = allowedExtensionsRegx.test(extension);
        if (!isAllowed) {
            // $("#imageErr").html("*Image extension must be .jpg or .png");
            toastr.error('image extension must be .jpg or .png', "*Image", {
                closeButton: true,
                progressBar: true,
                preventDuplicates: true,
                positionClass: "toast-bottom-center"
            });
            return false;
        } else if (size > 2048) {
            // $("#imageErr").html("*Image size must be less than 2MB")
            toastr.error('image size must be less than 2MB', "*Image", {
                closeButton: true,
                progressBar: true,
                preventDuplicates: true,
                positionClass: "toast-bottom-center"
            });
            return false;
        } else {
            // $("#imageErr").html("<br>");
            return true;
        }
    }
    function validatePassword() {
        let passwordValue = $("#password").val();
        let regex = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
        if (passwordValue.length == "") {
            // $("#passwordErr").html("*Password is required");
            toastr.error('password is required', "*Password", {
                closeButton: true,
                progressBar: true,
                preventDuplicates: true,
                positionClass: "toast-bottom-center"
            });
            return false;
        } else if (!regex.test(passwordValue)) {
            // $("#passwordErr").html("*Password must be a combination of symbol(!@#$%^&*), number, upper & lower case letter and minimum 8 characters long");
            toastr.error('password must be a combination of symbol(!@#$%^&*), number, upper & lower case letter and minimum 8 characters long', "*Password", {
                closeButton: true,
                progressBar: true,
                preventDuplicates: true,
                positionClass: "toast-bottom-center"
            });
            return false;
        } else {
            // $("#passwordErr").html("<br>");
            return true;
        }
    }
    function validatePhone() {
        let phoneValue = $("#phone").val();
        let regex = /^[0-9]{10}$/;
        if (phoneValue.length == "") {
            // $("#phoneErr").html("<br>");
            return true;
        } else if (!regex.test(phoneValue)) {
            // $("#phoneErr").html("*Phon number must be 10 digits long");
            toastr.error('phone number must be 10 digits long', "*Phone", {
                closeButton: true,
                progressBar: true,
                preventDuplicates: true,
                positionClass: "toast-bottom-center"
            });
            return false;
        } else {
            // $("#phoneErr").html("<br>");
            return true;
        }
    }

    $("#new-user-form").on("submit change", function (e) {
        isNameValid = validateName();
        isEmailValid = validateEmail();
        isPasswordValid = validatePassword();
        isPhoneValid = validatePhone();
        if (isEmailValid && isPasswordValid && isPhoneValid && validateImage()) {
            $("#submit").prop("disabled", false);
            return true;
        } else {
            $("#submit").prop("disabled", true);
            return false;
        }
    });

    $("#registration-form").on("submit change", function () {
        isNameValid = validateName();
        isEmailValid = validateEmail();
        isPasswordValid = validatePassword();
        isPhoneValid = validatePhone();
        if (isNameValid && isEmailValid && isPasswordValid && isPhoneValid) {
            $("#submit").prop("disabled", false);
            return true
        }
        $("#submit").prop("disabled", true);
        return false;
    });

    $("#login-form").on("submit change", function () {
        isEmailValid = validateEmail();
        isPasswordValid = validatePassword();
        if (isEmailValid && isPasswordValid) {
            $("#submit").prop("disabled", false);
            return true
        } else {
            $("#submit").prop("disabled", true);
            return false;
        }
    });

    //=================================================


    // InlineEditor
    //     .create(document.querySelector('#reason'))
    //     .catch(error => {
    //         console.error(error);
    //     });

    // InlineEditor
    //     .create(document.querySelector('#reason'))
    //     .then(editor => {
    //         console.log('Editor was initialized', editor);
    //     })
    //     .catch(err => {
    //         console.error(err);
    //     });

    // CKEDITOR.inline("reason");

    // $("#attendance").click(function (e) {
    //     var time = new Date();
    //     time = time.getHours() + ":" + time.getMinutes() + ":" + time.getSeconds();
    //     if (!$("#login_time").val()) {
    //         console.log($("#login_time"));
    //         $("#login_time").attr("value", time);
    //     } else {
    //         $("#logout_time").attr("value", time);
    //     }

    // window.location.href="../back-end/take_attendance.php";
    // });


    // $("#registration-form").submit(function (e) {
    //     e.preventDefault();

    //     $.ajax({
    //         method: "POST",
    //         // cache: false,
    //         url: "../back-end/save_user.php",
    //         data: $(this).serialize(),
    //         success: function (result) {
    //             console.log(result);
    //             window.location.href = "login.php";
    //         }
    //     });
    // });

    // $("#login-form").submit(function (e) {
    //     e.preventDefault();

    //     $.ajax({
    //         method: "POST",
    //         // cache: false,
    //         url: "../back-end/auth.php",
    //         data: $(this).serialize(),
    //         success: function (result) {
    //             console.log(result);
    //             result = JSON.parse(result);
    //             console.log(typeof result);
    //             if (result.role == "user") {
    //                 window.location.href = "user-dashboard.php";
    //             } else {
    //                 window.location.href = "admin-dashboard.php";
    //             }
    //         },
    //         error: function (response) {
    //             $("#error").text(response.responseText);
    //             console.error(response);
    //         }
    //     });
    // });

    // $("#attendance-form").submit(function (e) {
    //     e.preventDefault();

    //     if ($("#login_time").val()) {
    //         $.ajax({
    //             method: "POST",
    //             // cache: false,
    //             url: "../back-end/take_attendance.php",
    //             data: $(this).serialize(),
    //             success: function (result) {
    //                 console.log(result);
    //                 // $("#user-record").hide();
    //                 // window.location.href = "user-dashboard.php";
    //             }
    //         });
    //     }
    // });

    // $("#new-user-form").submit(function (e) {
    //     e.preventDefault();

    //     $.ajax({
    //         method: "POST",
    //         url: "../back-end/save_user.php",
    //         data: $(this).serialize(),
    //         success: function (result) {
    //             console.log(result);
    //             // location.reload();
    //         },
    //         error: function (response) {
    //             console.error(JSON.parse(response));
    //         }
    //     });
    // });

    // $("#update-form").submit(function (e) {
    //     e.preventDefault();

    //     $.ajax({
    //         method: "post",
    //         url: "../back-end/update_user.php",
    //         data: {
    //             id: $("#id").val(),
    //             name: $("#name").val(),
    //             email: $("#email").val(),
    //             password: $("#password").val(),
    //             phone: $("#phone").val(),
    //             salary: $("#salary").val(),
    //             role: $("#role").val()
    //         },
    //         // data: $(this).serialize(),
    //         success: function (response) {
    //             console.log(response);
    //             window.location.href = "admin-dashboard.php";
    //         }
    //     });
    // });


    // $("#password-form").submit(function (e) {
    //     e.preventDefault();

    //     $.ajax({
    //         method: "POST",
    //         // cache: false,
    //         url: "../back-end/send_mail.php",
    //         data: $(this).serialize(),
    //         success: function (response) {
    //             console.log(response);
    //             response = JSON.parse(response);
    //             $("#message").html("<span class='text-success'>".concat(response.responseText, "</span>"));
    //         },
    //         error: function (response) {
    //             $("#message").html("<span class='text-danger'>".concat(response.responseText, "</span>"));
    //             console.error(response);
    //         }
    //     });
    // });
});