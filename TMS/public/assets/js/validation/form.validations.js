export { Login, Addstaff,Addcategory,Adddesignation,Addteam};

const Login = () => {
    $("#loginForm").validate({
        rules: {
            username: {
                required: true,
                minlength: 3,
            },
            password: {
                required: true,
            },
        },
        messages: {
            username: {
                required: "Please enter your username",
                minlength: "Name must be at least 3 characters long",
            },
            password: {
                required: "Please provide a password",
            },
        },
    });
};

const Addstaff = () => {
    $.validator.addMethod(
        "passwordStrength",
        function (value, element) {
            return (
                this.optional(element) ||
                /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W)(?!.*\s).*$/.test(value)
            );
        },
        "Password must contain at least one number, one uppercase letter, one lowercase letter, and one special character."
    );

    $("#registerForm").validate({
        rules: {
            username: {
                required: true,
                minlength: 5,
                maxlength: 15,
            },
            email: {
                required: true,
                email: true,
            },
            contact: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 10,
            },
            designation: {
                required: true,
            },
            password: {
                required: true,
                minlength: 8,
                maxlength: 15,
                passwordStrength: true,
            },
        },
        messages: {
            username: {
                required: "Please enter username",
                minlength: "Name must be at least 5 characters long",
                maxlength: "Name must be at most 15 characters long",
            },
            email: {
                required: "Please provide an email",
                email: "Enter a valid email",
            },
            contact: {
                required: "Please enter a phone number",
                digits: "Please enter only numbers",
                minlength: "Phone number must be 10 characters long",
                maxlength: "Phone number must be 10 characters long",
            },
            designation: {
                required: "Please select a designation",
            },
            password: {
                required: "Please enter a password",
                minlength: "Password must be at least 8 characters long",
                maxlength: "Password must be at most 15 characters long",
            },
        },
    });
};

const Addcategory=()=>{
    $("#addCategory").validate({
        rules:{
            title:{
                required:true,
                minlength:2,
                maxlength:20
            }
        },
        messages:{
            title:{
                required:"Please enter the Category",
                minlength:"Category length should be more than 2 character",
                maxlength:"Category length do not exceed more than 20 characters"
            }
           
        }
    })
};


const Adddesignation=()=>{
    $("#addDesignation").validate({
        rules:{
            title:{
                required:true,
                minlength:2,
                maxlength:20
            }
        },
        messages:{
            title:{
                required:"Please enter the Designation",
                minlength:"Designation length should be more than 2 character",
                maxlength:"Designation length do not exceed more than 20 characters"
            }
           
        }
    })
};
const Addteam = () => {
    $.validator.addMethod(
        "selectMember",
        function (value, element) {
            return $('input[name="members[]"]:checked').length > 0;
        },
        "Please select at least one member."
    );

    $("#addTeam").validate({
        rules: {
            team_name: {
                required: true,
                minlength: 5,
                maxlength: 20,
            },
            "members[]": {
                selectMember: true,
            },
        },
        messages: {
            team_name: {
                required: "Please enter the Team name",
                minlength: "Team name length should be more than 5 characters",
                maxlength: "Team name length should not exceed 20 characters",
            },
        },
        errorPlacement: function (error, element) {
            if (element.attr("name") === "members[]") {
                error.appendTo("#membersError"); 
            } else {
                error.insertAfter(element); 
            }
        },
    });
};




