
(function($) {
    'use strict';
    
 $(document).ready(function() {
    const af = $('#applicant_form').formValidation({
        message: 'This value is not valid',
        /*icon: {
            required: 'glyphicon glyphicon-asterisk',
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },*/
        fields: {
            year: {
                validators: {
                    notEmpty: {
                        message: 'Year is required'
                    }
                }
            },
            class: {
                validators: {
                    notEmpty: {
                        message: 'Class name is required'
                    }
                }
            },
            roll: {
                validators: {
                    notEmpty: {
                        message: 'Roll is required'
                    }
                }
            },
            name_english: {
                validators: {
                    notEmpty: {
                        message: 'Name is required'
                    }
                }
            },
            name_bangla: {
                validators: {
                    notEmpty: {
                        message: 'Name is required'
                    }
                }
            },
            amd_no: {
                validators: {
                    notEmpty: {
                        message: 'Admission No is required'
                    }
                }
            },
            id_no: {
                validators: {
                    notEmpty: {
                        message: 'ID No is required'
                    }
                }
            },
            father_name_english: {
                validators: {
                    notEmpty: {
                        message: 'Father Name is required'
                    }
                }
            },
            father_name_bangla: {
                validators: {
                    notEmpty: {
                        message: 'Father Name is required'
                    }
                }
            },
            father_occupation: {
                validators: {
                    notEmpty: {
                        message: 'Father Occupation is required'
                    }
                }
            },
            father_mobile_no: {
                validators: {
                    notEmpty: {
                        message: 'Father mobile no is required'
                    },
                    stringLength: {
                        max: 11,
                        min: 11,
                        message: 'Phone Must be 11 number'
                    },

                }
            },
            mother_name_english: {
                validators: {
                    notEmpty: {
                        message: 'Mother Name is required'
                    }
                }
            },
            mother_name_bangla: {
                validators: {
                    notEmpty: {
                        message: 'Mother Name is required'
                    }
                }
            },
            mother_occupation: {
                validators: {
                    notEmpty: {
                        message: 'Mother Occupation is required'
                    }
                }
            },
            mother_mobile_no: {
                validators: {
                    notEmpty: {
                        message: 'Mother mobile no is required'
                    },
                    stringLength: {
                        max: 11,
                        min: 11,
                        message: 'Phone Must be 11 number'
                    },

                }
            },
            date_of_birth: {
                validators: {
                    notEmpty: {
                        message: 'Student date of birth is required'
                    }
                }
            },
            admitted_to_class: {
                validators: {
                    notEmpty: {
                        message: 'Admitted to class is required'
                    }
                }
            },
            /*on: {
                validators: {
                    notEmpty: {
                        message: 'On is required'
                    }
                }
            },
            form: {
                validators: {
                    notEmpty: {
                        message: 'Form is required'
                    }
                }
            },
            tc_no: {
                validators: {
                    notEmpty: {
                        message: 'TC No is required'
                    }
                }
            },
            date: {
                validators: {
                    notEmpty: {
                        message: 'Date is required'
                    }
                }
            },*/
            registration_no: {
                validators: {
                    notEmpty: {
                        message: 'Registration No is required'
                    }
                }
            },
            board_roll_no: {
                validators: {
                    notEmpty: {
                        message: 'Board roll No is required'
                    }
                }
            },
            board_roll_no: {
                validators: {
                    notEmpty: {
                        message: 'Board roll No is required'
                    }
                }
            },
            presend_address: {
                validators: {
                    notEmpty: {
                        message: 'Presend address is required'
                    }
                }
            },
            permanent_address: {
                validators: {
                    notEmpty: {
                        message: 'Permanent address is required'
                    }
                }
            },
           profile_image: {
                validators: {
                    notEmpty: {
                        message: 'Profile image is required'
                    },
                    file: {
                        extension: 'jpeg,jpg,png',
                        type: 'image/jpeg,image/png',
                        maxSize: 3000000,   // 3MB
                        message: 'File size must be less than 3MB and file type will be jpg / jpeg /png'
                    }
                }
            }

        }
    }).on('success.form.fv', function(e) {
        $('#wpmp-register-alert').hide();
        $('#wpmp-mail-alert').hide();
        $('body, html').animate({
            scrollTop: 0
        }, 'slow');
        // You can get the form instance
        var $applicant_form = $(e.target);
        // and the FormValidation instance
        var fv = $applicant_form.data('formValidation');
        var formData = new FormData();
        // get all input and select item in a form
        $('#applicant_form input[type=text],#applicant_form select,#applicant_form textarea,#applicant_form input[type=date],#applicant_form input[type=file]').each(function(i,item){
            if(item.type == 'file'){
                formData.append(item.name,item.files[0]);
            }else {
                formData.append(item.name,item.value);
            }
        })
        var form_action = $(this).attr("action");
        console.log(formData);
    	
        $('#wpmp-reg-loader-info').show();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'POST',
            url: form_action,
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
            /*console.log(data);*/
            $('#wpmp-reg-loader-info').hide();
            // check login status
            if (200 == data.success) {
                $('#wpmp-register-alert').removeClass('alert-danger');
                $('#wpmp-register-alert').addClass('alert-success');
                $('#wpmp-register-alert').show();
                $('#wpmp-register-alert').html(data.suc_msg);
                $('#applicant_form')[0].reset();

            } else {
                $('#wpmp-register-alert').addClass('alert-danger');
                $('#wpmp-register-alert').show();
                $('#wpmp-register-alert').html(data.error);

            }
        },
        error: function(errors) {
            console.log(errors);
        }
        })
        // Prevent form submission
        e.preventDefault();
    })

    const edit = $('#student_edit').formValidation({
        message: 'This value is not valid',
        /*icon: {
            required: 'glyphicon glyphicon-asterisk',
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },*/
        fields: {
            year: {
                validators: {
                    notEmpty: {
                        message: 'Year is required'
                    }
                }
            },
            class: {
                validators: {
                    notEmpty: {
                        message: 'Class name is required'
                    }
                }
            },
            roll: {
                validators: {
                    notEmpty: {
                        message: 'Roll is required'
                    }
                }
            },
            name_english: {
                validators: {
                    notEmpty: {
                        message: 'Name is required'
                    }
                }
            },
            name_bangla: {
                validators: {
                    notEmpty: {
                        message: 'Name is required'
                    }
                }
            },
            amd_no: {
                validators: {
                    notEmpty: {
                        message: 'Admission No is required'
                    }
                }
            },
            id_no: {
                validators: {
                    notEmpty: {
                        message: 'ID No is required'
                    }
                }
            },
            father_name_english: {
                validators: {
                    notEmpty: {
                        message: 'Father Name is required'
                    }
                }
            },
            father_name_bangla: {
                validators: {
                    notEmpty: {
                        message: 'Father Name is required'
                    }
                }
            },
            father_occupation: {
                validators: {
                    notEmpty: {
                        message: 'Father Occupation is required'
                    }
                }
            },
            father_mobile_no: {
                validators: {
                    notEmpty: {
                        message: 'Father mobile no is required'
                    },
                    stringLength: {
                        max: 11,
                        min: 11,
                        message: 'Phone Must be 11 number'
                    },

                }
            },
            mother_name_english: {
                validators: {
                    notEmpty: {
                        message: 'Mother Name is required'
                    }
                }
            },
            mother_name_bangla: {
                validators: {
                    notEmpty: {
                        message: 'Mother Name is required'
                    }
                }
            },
            mother_occupation: {
                validators: {
                    notEmpty: {
                        message: 'Mother Occupation is required'
                    }
                }
            },
            mother_mobile_no: {
                validators: {
                    notEmpty: {
                        message: 'Mother mobile no is required'
                    },
                    stringLength: {
                        max: 11,
                        min: 11,
                        message: 'Phone Must be 11 number'
                    },

                }
            },
            date_of_birth: {
                validators: {
                    notEmpty: {
                        message: 'Student date of birth is required'
                    }
                }
            },
            admitted_to_class: {
                validators: {
                    notEmpty: {
                        message: 'Admitted to class is required'
                    }
                }
            },
            /*on: {
                validators: {
                    notEmpty: {
                        message: 'On is required'
                    }
                }
            },
            form: {
                validators: {
                    notEmpty: {
                        message: 'Form is required'
                    }
                }
            },
            tc_no: {
                validators: {
                    notEmpty: {
                        message: 'TC No is required'
                    }
                }
            },
            date: {
                validators: {
                    notEmpty: {
                        message: 'Date is required'
                    }
                }
            },*/
            registration_no: {
                validators: {
                    notEmpty: {
                        message: 'Registration No is required'
                    }
                }
            },
            board_roll_no: {
                validators: {
                    notEmpty: {
                        message: 'Board roll No is required'
                    }
                }
            },
            board_roll_no: {
                validators: {
                    notEmpty: {
                        message: 'Board roll No is required'
                    }
                }
            },
            presend_address: {
                validators: {
                    notEmpty: {
                        message: 'Presend address is required'
                    }
                }
            },
            permanent_address: {
                validators: {
                    notEmpty: {
                        message: 'Permanent address is required'
                    }
                }
            },
           /*profile_image: {
                validators: {
                    notEmpty: {
                        message: 'Profile image is required'
                    },
                    file: {
                        extension: 'jpeg,jpg,png',
                        type: 'image/jpeg,image/png',
                        maxSize: 3000000,   // 3MB
                        message: 'File size must be less than 3MB and file type will be jpg / jpeg /png'
                    }
                }
            }*/

        }
    }).on('success.form.fv', function(e) {
        $('#wpmp-register-alert').hide();
        $('#wpmp-mail-alert').hide();
        $('body, html').animate({
            scrollTop: 0
        }, 'slow');
        // You can get the form instance
        var $student_edit = $(e.target);
        // and the FormValidation instance
        var fv = $student_edit.data('formValidation');
        var formData = new FormData();
        // get all input and select item in a form
        $('#student_edit input[type=hidden],#student_edit input[type=text],#student_edit select,#student_edit textarea,#student_edit input[type=date],#student_edit input[type=file]').each(function(i,item){
            if(item.type == 'file'){
                formData.append(item.name,item.files[0]);
            }else {
                formData.append(item.name,item.value);
            }
        })
        var form_action = $(this).attr("action");
        
        $('#wpmp-reg-loader-info').show();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'POST',
            url: form_action,
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
            if (data.success == '200') {
                /*$('.modal').modal('hide');
                Swal.fire({
                    icon: "success",
                    title: "School update successfully",
                    showConfirmButton: false,
                    timer: 2000
                });*/
                $('#wpmp-reg-loader-info').css('display','none');
                $('#wpmp-register-alert').removeClass('alert-danger');
                $('#wpmp-register-alert').addClass('alert-success');
                $('#wpmp-register-alert').show();
                $('#wpmp-register-alert').html(data.suc_msg);
            }else{
                console.log('School update error');
            }

            },
            error: function(errors) {
                console.log(errors);
                if( errors.status === 400 ) {
                    var errors_msg = $.parseJSON(errors.responseText);
                    $.each(errors_msg.errors, function (key, val) {
                        $("#" + key + "_error_edit").text(val[0]);
                    });
                }
            }
        })
        // Prevent form submission
        e.preventDefault();
    })

    /*$('#birth_date').datepicker({
    format: 'yyyy-mm-dd'
    }).on('changeDate', function(e) {
        $('#applicant_form').formValidation('revalidateField',   'birth_date');
    });*/




 });

})(jQuery);
