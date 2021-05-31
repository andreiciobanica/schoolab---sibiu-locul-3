$('form[name ="signup"]').hide();

function signupShow(){
   $('form[name ="login"]').hide();
   $('form[name ="signup"]').show();
}

function loginShow(){
   $('form[name ="signup"]').hide();
   $('form[name ="login"]').show();
}