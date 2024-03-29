import $ from 'jquery';

class Common {
    instanceProperty = "Main";
    boundFunction = () => {
        return this.instanceProperty;
    }

    runConstraintValidation = () => {
        let inputsRequired = document.querySelectorAll('input[required]');
        let validateEmail = function(email) {
            const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        }

        if (inputsRequired) {
            inputsRequired.forEach(function(inputRequired) {
        
                let typeInput = inputRequired.getAttribute('type');
        
                inputRequired.addEventListener('input', () => {
                    inputRequired.setCustomValidity('');
                    inputRequired.checkValidity();
                });
        
                inputRequired.addEventListener('invalid', () => {
                    if (typeInput == 'email') {
                        if (!validateEmail(inputRequired.value)) {
                            inputRequired.setCustomValidity(translationsJS && translationsJS.are_you_sure_you_want_to_delete_this_item ? translationsJS.are_you_sure_you_want_to_delete_this_item : 'The email format is incorrect!');
                        }
                    }

                    if (inputRequired.value === '') {
                        inputRequired.setCustomValidity(translationsJS && translationsJS.this_field_is_required ? translationsJS.this_field_is_required : 'This field is required!');
                    }

                });
            });
        }
    }

    init = function() {
        this.runConstraintValidation();
    }
}

$(document).ready(function() {
    let common = new Common();
    common.init();
});
