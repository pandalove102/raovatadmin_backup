if($("#form-users").length) {
    var error1=$('#form-users #username').attr('data-error');
    var url_username=$('#form-users #username').attr('data-url');
    var error_username=$('#form-users #username').attr('data-error-1');
    var error2=$('#form-users #password').attr('data-error');
    var error3=$('#form-users #re_password').attr('data-error');
    var error4=$('#form-users #name').attr('data-error');
    var error5=$('#form-users #email').attr('data-error');
    var url_email=$('#form-users #email').attr('data-url');
    var error_email=$('#form-users #email').attr('data-error-1');
    var error6=$('#form-users #phone').attr('data-error');
    var error7=$('#form-users #address').attr('data-error');
	var error8=$('#form-users #group_id').attr('data-error');
    var url_group_id=$('#form-users #group_id').attr('data-url');
    var error_group_id=$('#form-users #group_id').attr('data-error-1');
    var error9=$('#form-users #sku').attr('data-error');
    var url_sku=$('#form-users #sku').attr('data-url');
    var error_sku=$('#form-users #sku').attr('data-error-1');
    var error10=$('#form-users #alias').attr('data-error');
    var url_alias=$('#form-users #alias').attr('data-url');
    var error_alias=$('#form-users #alias').attr('data-error-1');
    var error11=$('#form-users #brand').attr('data-error');
    var error12=$('#form-users #quantity').attr('data-error');
    $("#form-users").validate({
       
      onkeyup: false,
        rules: {
            username: {
                required: true,
                remote: {
                    url: url_username,
                    type: "post",
                    data: {
                        username: function() {
                            return $('#form-users #username').val();
                        },
                        id_user: function() {
                              return $('#form-users #id_user').val();
                        },
						uri: function() {
                              return $('#form-users #uri').val();
                        },
                    }                    
                }
            },
            password: "required",
            re_password: {
                required: true,
                equalTo: "#password",
            },                
            name: "required",
            email: {
                required: true,
                email: true,
                remote: {
                    url: url_email,
                    type: "post",
                    data: {
                        email: function() {
                            return $('#form-users #email').val();
                        },
                        id_user: function() {
                              return $('#form-users #id_user').val();
                        },
                        uri: function() {
                              return $('#form-users #uri').val();
                        },
                    }
                }
            },
            group_id: {
                required: true,
                remote: {
                    url: url_group_id,
                    type: "post",
                    data: {
                        group_id: function() {
                            return $('#form-users #group_id').val();
                        },
                        id_user: function() {
                              return $('#form-users #id_user').val();
                        },
                        uri: function() {
                              return $('#form-users #uri').val();
                        },
                    }                    
                }
            },
            sku: {
                required: true,
                remote: {
                    url: url_sku,
                    type: "post",
                    data: {
                        sku: function() {
                            return $('#form-users #sku').val();
                        },
                        id_user: function() {
                              return $('#form-users #id_user').val();
                        },
                        uri: function() {
                              return $('#form-users #uri').val();
                        },
                    }                    
                }
            },
            alias: {
                required: true,
                remote: {
                    url: url_alias,
                    type: "post",
                    data: {
                        alias: function() {
                            return $('#form-users #alias').val();
                        },
                        id_user: function() {
                              return $('#form-users #id_user').val();
                        },
                        uri: function() {
                              return $('#form-users #uri').val();
                        },
                    }                    
                }
            },
            phone: "required",
            address: "required",
            day: "required",    
            month: "required",    
            year: "required",    
            gender: "required",
            brand: "required",
            quantity: "required",
        },
        messages: {
			username: {
                required: error1,
                remote: error_username
            },
            password: error2,
            re_password: {
                required: error2,
                equalTo: error3,
            },
            name: error4,
            email: {
                required: error5,
                email: error5,
                remote: error_email,
            },
			group_id: {
                required: error8,
                remote: error_group_id
            },
            sku: {
                required: error9,
                remote: error_sku
            },
            alias: {
                required: error10,
                remote: error_alias
            },
            phone: error6,
            address: error7,
            brand: error11,
            quantity: error12,
            day: '',
            month: '',
            year: '',
            gender: '',
        },
        highlight : function (element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight : function (element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
    });    
}

$(document).ready(function() {
    $('.footable').footable({paginate:false });
    $(".select2_demo_3").select2({
    placeholder: "Select a state",
    allowClear: true
});

$(document).on('click','.delete-confirm',function(e){
    if(confirm('Bạn có muốn xóa dòng này không?'))
        return true;
    e.preventDefault();
});
});

function validateInp(elem) {                
    var validChars = /[0-9]/;                
    var strIn = elem.value;                
    var strOut = '';                
    for(var i=0; i < strIn.length; i++) {                  
      strOut += (validChars.test(strIn.charAt(i)))? strIn.charAt(i) : '';                
      }                
        elem.value = strOut;            
  }
