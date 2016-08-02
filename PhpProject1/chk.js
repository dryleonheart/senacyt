
        function validateForm(formId)
        {
            var inputs, index;
            var form=document.getElementById(formId);
            inputs = form.getElementsByTagName('input');
        
            for (index = 0; index < inputs.length; ++index) {
                // deal with inputs[index] element.
                if (inputs[index].value==null || inputs[index].value==""||inputs[index].value==" "||inputs[index].value=="  ")
                {
                    alert("Field is empty");
                    return false;
                }
            }

        }

