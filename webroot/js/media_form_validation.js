/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
    $('#media').bootstrapValidator({

        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            media_title: {
                validators: {
                    notEmpty: {
                        message: 'Please enter a title for your media'
                    },
                    stringLength: {
                        max: 30,
                        message: 'No more than 30 characters allowed'
                    },
                    regexp: {
                        regexp: /^[A-Za-z0-9 ]+$/,
                        message: 'Please enter only alphabets, numbers, or spaces'
                    }
                }
            },
            media_desc: {
                validators: {
                    notEmpty: {
                        message: 'Please enter a description for your media'
                    },
                    stringLength: {
                        min: 10,
                        max: 200,
                        message: 'Please enter at least 10 characters and no more than 200'
                    }
                }
            },
            genre_id: {
                validators: {
                    notEmpty: {
                        message: 'Please choose a genre for your media'
                    }
                }
            },
            price: {
                validators: {
                    notEmpty: {
                        message: 'Please enter a price for your media'
                    },
                    lessThan: {
                        value: 1000000,
                        message: 'Price must be less than $1 million'
                    },
                    greaterThan: {
                        value: 0,
                        message: 'Price must be greater than $0'
                    },
                    regexp: {
                        regexp: /^\d+(?:\.\d\d?)?$/,
                        message: 'Please enter a valid price'
                    }
                }
            }
        }
    })
            .on('success.form.bv', function (e) {
                $('#success_message').slideDown({opacity: "show"}, "slow") // Do something ...
                $('#media').data('bootstrapValidator').resetForm();
                /*
                 // Prevent form submission
                 e.preventDefault();
                 
                 // Get the form instance
                 var $form = $(e.target);
                 
                 // Get the BootstrapValidator instance
                 var bv = $form.data('bootstrapValidator');
                 
                 // Use Ajax to submit form data
                 $.post($form.attr('action'), $form.serialize(), function (result) {
                 console.log(result);
                 }, 'json');*/
            });
});

