$(document).ready(function(){
    $("#myform").validate({
        rules: {
            fristName: {
                required: true,
            },
            lastName: {
                required: true,
            },
            dob: {
                required: true,
            },
            email: {
                required: true,
                email: true,
            },
            mobile: {
                required: true,
                minlenght:10,
                maxlength: 10,
                number: true,

            },
            designation: {
                required: true,
            },
            gender: {
                required: true,
            },
            hobbies: {
                required: true,
            }
        },
        messages: {
          fristName: {
            required: "First name is required.",
          },
          lastName: {
            required: "Last name is required.",
          },
          email: {
            required: "Email is required.",
            email: "Please enter valid emial address."
          },
          dob: {
            required: "Date Of Birth is required.",
          },
          designation: {
            required: "Designation is required.",
          },
          mobile: {
            required: "Mobile number is required.",
            maxlength: "Maximum {10} digit valid number is required.",
            number: "Only number is valid."
          },
          gender: {
            required: "Please select gender.",
          },
          hobbies: {
            required: "Please select hobbie/hobbies",
          }
        }
      });
});
