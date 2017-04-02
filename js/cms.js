/**
 * Created by Raj Yogi on 2017-03-22.
 */
/**
 * Created by RFreeman on 2/9/2017.
 */

// use jQuery for a Delete confirmation pop-up
$('.confirmation').on('click', function() {
    return confirm('Are you sure you want to delete this item?');
});

// check password has been entered the same way twice
$('.btnRegister').on('click', function() {
    if ($('#password').val() != $('#confirm').val()) {
        $('#message').html('Passwords do not Match');
        $('#message').removeClass();
        $('#message').addClass('alert alert-danger');
        return false;
    }
    else {
        return true;
    }
});


$(document).ready(function() {
    $('#password').keyup(function() {
        $('#result').html(checkStrength($('#password').val()))
    })
    function checkStrength(password) {
        var strength = 0
        if (password.length < 5) {
            $('#result').removeClass()
            $('#result').addClass('alert-danger')
            return 'Too short'
        }
        if (password.length > 6) strength += 1

        if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1

        if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) strength += 1

        if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1

        if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1

        if (strength < 2) {
            $('#result').removeClass()
            $('#result').addClass('alert-danger')
            return 'Weak'
        } else if (strength == 2) {
            $('#result').removeClass()
            $('#result').addClass('alert-warning')
            return 'Good'
        } else {
            $('#result').removeClass()
            $('#result').addClass('alert-success')
            return 'Strong'
        }
    }
});