/* Menu Scripts */
$(document).ready(function(){
  $('#users, #login').css('display','none');
  $('#tasks').css('display','block');
  $('#tasknav').closest('li').addClass('active');
  $("#tasknav").click(function(){
    $("#users, #login").hide();
    $("#tasks, #calendar").show();
  });
  $("#usernav").click(function(){
    $("#tasks, #login").hide();
    $("#users").show();
  });
  $("#loginnav").click(function(){
    $("#tasks, #users").hide();
    $("#login").show();
  });
	$('ul li a').click(function() {
    $('ul li.active').removeClass('active');
    $(this).closest('li').addClass('active');
	});
});