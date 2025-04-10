$(document).ready(function() {
    $('#formValidation').validate({
        rules: {
            codeUser: {
                required: true,
                digits: true
            },
            firstName: {
                required: true,
                lettersOnly: true
            },
            lastName:{
                required: true,
                lettersOnly: true
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                algerianPhone: true
            },
            dateBirth: {
              ageOver16: true
            }
        },
        messages: {
            codeUser: {
                required: 'Code user is required',
                digits: 'Code user must be a number'
            },
            firstName: {
                required: 'First Name is required',
                lettersOnly: 'First Name must contain only letters'
            },
            lastName: {
                required: 'last Name is required',
                lettersOnly: 'First Name must contain only letters'
            },
            email: {
                required: 'Email is required',
                email: 'Please enter a valid email address'
            },
            phone: {
                algerianPhone: 'Please enter a valid Algerian phone number'
            },
            dateBirth: {
              ageOver16: 'You must be at least 16 years old'
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });



    $.validator.addMethod("lettersOnly", function(value, element) {
        return this.optional(element) || /^[a-zA-ZÀ-ÿ\s]+$/i.test(value);
      }, "Please enter only letters.");
      $.validator.addMethod("algerianPhone", function(value, element) {
        return this.optional(element) || /^(?:0)(?:5|6|7)[0-9]{8}$/i.test(value);
      }, "Please enter a valid Algerian phone number.");
      $.validator.addMethod("ageOver16", function(value, element) {
        var today = new Date();
        var birthdate = new Date(value);
        var age = today.getFullYear() - birthdate.getFullYear();
        var monthDiff = today.getMonth() - birthdate.getMonth();
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthdate.getDate())) {
          age--;
        }
        return age >= 16;
      }, "You must be at least 16 years old.");
});