
//hide placeholder on form focus 

$("input").on('focus',function () {
    $place = $(this).attr("placeholder");
   $(this).attr("placeholder","");
   });
   
$("input").on("blur",function () {
    $(this).attr("placeholder",$place);
  });


// add astrisk on required Field

$('input').each(function(){
  if($(this).attr('required') === 'required'){
    $(this).after('<span class="asterisk">*</span>');

  }
});

// convert password to text to show

$('.show-pass').hover(function(){

  $('.password').attr('type','text');

}, function(){
  $('.password').attr('type','password');
});



// confirmation message on Before Delete

$('.confirm').click(function(){
  return confirm('Are You Sure To Delete This User ?')

});
  

