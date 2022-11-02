 document.addEventListener("DOMContentLoaded", function(event) {

    $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

 


console.log( baseUrl+'/unique_name','ddd')

 var username = $("#unique_name").attr("name");


// alert(baseUrl);


$('#comman_form_id').validate({

     rules: {
                 'country_name': {
                      required: true,
                      
          remote: {
                    url: baseUrl+'/unique_name',
                    type: "post",

                    data: {
                        check_unique_name: function () {
                            return $("#unique_name").val();
                        }
                    },
                    dataFilter: function (data) {
              console.log($.trim(data));
                       if($.trim(data) == "exist"){
                 return 'false';
                }else if($.trim(data) == "notexist"){
                 return 'true';
                }
                    }
                }
                    },

              },
  errorPlacement: function errorPlacement(error, element) {


                    var $parent = $(element).parents('.form-group');
                    // Do not duplicate errors
                    if ($parent.find('.jquery-validation-error').length) {
                      return;
                    }
                    $parent.append(
                      error.addClass('jquery-validation-error small form-text invalid-feedback')
                    );
                  },

                  highlight: function(element) {

                        // alert(username)

                    var $el = $(element);
                    var $parent = $el.parents('.form-group');
                    $el.addClass('is-invalid');
                    // Select2 and Tagsinput
                    if ($el.hasClass('select2-hidden-accessible') || $el.attr('data-role') === 'tagsinput') {
                      $el.parent().addClass('is-invalid');
                    }
                  },
                  unhighlight: function(element) {
                    $(element).parents('.form-group').find('.is-invalid').removeClass('is-invalid');
                  },

                      submitHandler: function(form) {  

                  
                    $('#pageloader').css('display', 'block');
                    
                    form.submit();
      // return false
  },

                           messages: {  // <-- you must declare messages inside of "messages" option
        'country_name':{
            remote:"This name is already used ,please choos another name."                  
        }   }, 

            });


// ..................................
  $(":input").blur(function() {

    // $(this).val($(this).val().trim());
    var obj=$(this).val();
    obj = obj.replace(/^\s+|\s+$/g, "");
// console.log(obj)
var CharArray = obj.split(" ");
      // console.log(CharArray.length) 
      return $(this).val(obj);
    });

// .....................
$(".noSpace").change(function() {
    $(this).val($(this).val().trim());
  });

// .....................

  var testPattern = new RegExp("^(\\+)?(\\d+)$");

    $('.contact_no_validate').on('keyup', function(){
  // console.log('ddd')
  // alert('ddd')
  var vvv=$(this).val();
  if($(this).val().length == 1)$(this).val('+');
  else{ 
    var res = chkInput(vvv);
    if(!res)$(this).val($(this).val().slice(0, -1));
  }
});
    function chkInput(vvv){
      var v = vvv.charAt(vvv.length-1);
      return testPattern.test(v);
    }


// .....................
jQuery('.numbersOnly').keyup(function () { this.value = this.value.replace(/[^0-9\.]+/g,''); });

// .....................

   jQuery.validator.addMethod("same_letterse", function(value, element) {
  // console.log(/(\b(?:([A-Za-z0-9])(?!\2{2}))+\b)/.test(value)+'aaaa')
  return this.optional(element) || /(\b(?:([A-Za-z0-9])(?!\2{2}))+\b)/.test(value);

}, "same letters more than 3 times not allowed"); 

// .....................

   jQuery.validator.addMethod("onlyAlphabet", function(value, element) {
  // console.log(/(\b(?:([A-Za-z0-9])(?!\2{2}))+\b)/.test(value)+'aaaa')
  return this.optional(element) || /^[a-zA-Z.& ]*$/.test(value);

}, "Please enter the alphabet only"); 
// .....................


   jQuery.validator.addMethod("alphanumeric", function(value, element) {
  // console.log(/(\b(?:([A-Za-z0-9])(?!\2{2}))+\b)/.test(value)+'aaaa')
  return this.optional(element) || /^[a-zA-Z0-9&. \s]+$/i.test(value);

}, "Please enter the alphabet only"); 

// .....................

   jQuery.validator.addMethod("alphanumeric_with_dot", function(value, element) {
  // console.log(/(\b(?:([A-Za-z0-9])(?!\2{2}))+\b)/.test(value)+'aaaa')
  return this.optional(element) || /^[a-zA-Z0-9.&\s]+$/i.test(value);

}, "Please enter the alphanumeric and dot only"); 

// .....................

   jQuery.validator.addMethod("address_validation", function(value, element) {
  // console.log(/(\b(?:([A-Za-z0-9])(?!\2{2}))+\b)/.test(value)+'aaaa')
  return this.optional(element) || /^[a-zA-Z0-9&.,-/\s]+$/i.test(value);

}, "Only allow alphanumeric with dot, comma , hash and slash format"); 

// .....................

   jQuery.validator.addMethod("alphanumeric_with_dot_comma", function(value, element) {
  // console.log(/(\b(?:([A-Za-z0-9])(?!\2{2}))+\b)/.test(value)+'aaaa')
  return this.optional(element) || /^[a-zA-Z0-9.,& \s]+$/i.test(value);

}, "Only allow alphanumeric with dot, comma , hash and slash format"); 

// .....................

   jQuery.validator.addMethod("onlyAlphabet_with_dot", function(value, element) {
  // console.log(/(\b(?:([A-Za-z0-9])(?!\2{2}))+\b)/.test(value)+'aaaa')
  return this.optional(element) || /^[a-zA-Z.& ]*$/.test(value);

}, "Please enter the alphabet ,single space and dot only"); 

// .....................


   jQuery.validator.addMethod("onlyAlphabet_with_dot_comma", function(value, element) {
  // console.log(/(\b(?:([A-Za-z0-9])(?!\2{2}))+\b)/.test(value)+'aaaa')
  return this.optional(element) || /^[a-zA-Z.& , ]*$/.test(value);

}, "Please enter the alphabet ,comma and dot only"); 

// .....................

   jQuery.validator.addMethod("onlyAlphabet_with_dot_brakit", function(value, element) {
  // console.log(/(\b(?:([A-Za-z0-9])(?!\2{2}))+\b)/.test(value)+'aaaa')
  return this.optional(element) || /^[a-zA-Z.()&/ ]*$/.test(value);

}, "Please enter the alphabet ,single space and dot only"); 

// .....................


   jQuery.validator.addMethod("emailfull", function(value, element) {
     return this.optional(element) || /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i.test(value);
   }, "Please enter valid email address!");
// .....................

// console.log('sssssss')


// ....................................
});



