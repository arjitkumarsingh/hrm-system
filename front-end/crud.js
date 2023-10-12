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

    $("#name").keyup(function () {
        validateName();
    });
    $("#email").keyup(function () {
        validateEmail();
    });
    $("#image").change(function (e) {
        validateImage(e);
    });
    $("#password").keyup(function () {
        validatePassword();
    });
    $("#phone").keyup(function () {
        validatePhone();
    });

    function validateName() {
        let nameValue = $("#name").val();
        let regex = /^[a-zA-Z-' ]*$/;
        if (nameValue.length == "") {
            $("#nameErr").html("*Name is required");
            $("#submit").prop("disabled", true);
            return false;
        } else if (nameValue.length < 3) {
            $("#nameErr").html("*Name must be at least 3 characters long");
            $("#submit").prop("disabled", true);
            return false;
        } else if (!regex.test(nameValue)) {
            $("#nameErr").html("*Only letters and white space allowed");
            $("#submit").prop("disabled", true);
            return false;
        } else {
            $("#nameErr").html("<br>");
            // $("#submit").prop("disabled", false);
            return true;
        }
    }
    function validateEmail() {
        let emailValue = $("#email").val();
        let regex = /^[a-zA-Z][a-zA-Z\d\w.]{2,30}@[a-zA-Z\d]{3,30}\.[a-zA-Z]{2,20}$/;
        if (emailValue.length == "") {
            $("#emailErr").html("*Email is required");
            $("#submit").prop("disabled", true);
            return false;
        } else if (!regex.test(emailValue)) {
            $("#emailErr").html("*Invalid email format");
            $("#submit").prop("disabled", true);
            return false;
        } else {
            $("#emailErr").html("<br>");
            // $("#submit").prop("disabled", false);
            return true;
        }
    }
    function validateImage(e) {
        var file = e.currentTarget.files[0];
        // var file = $(this)[0].files[0];
        var name = file.name;
        var extension = name.substr(name.lastIndexOf("."));
        var size = Math.round(file.size / 1024);
        console.log(size);
        var allowedExtensionsRegx = /(\.jpg|\.png)$/i;
        var isAllowed = allowedExtensionsRegx.test(extension);

        if (!isAllowed) {
            $("#imageErr").html("*Image extension must be .jpg or .png");
            $("#submit").prop("disabled", true);
            return false;
        } else if (size > 2048) {
            $("#imageErr").html("*Image size must be less than 2MB")
            $("#submit").prop("disabled", true);
            return false;
        } else {
            $("#imageErr").html("<br>");
            $("#submit").prop("disabled", false);
            return true;
        }
    }
    function validatePassword() {
        let passwordValue = $("#password").val();
        let regex = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
        if (passwordValue.length == "") {
            $("#passwordErr").html("*Password is required");
            $("#submit").prop("disabled", true);
            return false;
        } else if (!regex.test(passwordValue)) {
            $("#passwordErr").html("*Password must be a combination of symbol(!@#$%^&*), number, upper & lower case letter and minimum 8 characters long");
            $("#submit").prop("disabled", true);
            return false;
        } else {
            $("#passwordErr").html("<br>");
            // $("#submit").prop("disabled", false);
            return true;
        }
    }
    function validatePhone() {
        let phoneValue = $("#phone").val();
        let regex = /^[0-9]{10}$/;
        if (phoneValue.length == "") {
            $("#phoneErr").html("<br>");
            $("#submit").prop("disabled", false);
            return true;
        } else if (!regex.test(phoneValue)) {
            $("#phoneErr").html("*Phon number must be 10 digits long");
            $("#submit").prop("disabled", true);
            return false;
        } else {
            $("#phoneErr").html("<br>");
            // $("#submit").prop("disabled", false);
            return true;
        }
    }

    $("#new-user-form").submit(function () {
        // if (!(validateName() && validateEmail() && validatePassword() && validatePhone())) {
        //     return false;
        // }
        // return true;
        let isNameValid = validateName();
        let isEmailValid = validateEmail();
        let isPasswordValid = validatePassword();
        let isPhoneValid = validatePhone();
        if (isNameValid && isEmailValid && isPasswordValid && isPhoneValid) {
            // $("#submit").htm
            return true;
        }
        return false;
    });

    $("#registration-form").submit(function () {
        if (!(validateName() && validateEmail() && validatePassword() && validatePhone())) {
            return false;
        }
        return true;
    });

    $("#login-form").submit(function () {
        isEmailValid = validateEmail();
        isPasswordValid = validatePassword();
        console.log("okok");
        while (!(isEmailValid && isPasswordValid)) {
            $("#submit").prop("disabled", true);
            $("#email").keyup(function () {
                validateEmail();
            });
            $("#password").keyup(function () {
                validatePassword();
            })
            // return false;
        }
        return true;
    });

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