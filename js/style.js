// JavaScript Document
$(document).ready(function(){
	$('#tab_content ul li').hide();
	$('#tab_content ul li:first').show();
	$('#tab_title ul li:first a').css('color','#FFF');
	$('#tab_title ul li:first').css('background','#F33');
	$('#tab_title ul li:nth-child(2)').css('background','#0C9');
	
	
$('#tab_title ul li a').click(function(){
	$('#tab_title ul li a').css('color','#000');
	$(this).css('color','#FFF');
	var tab = $(this).attr("id");
	$('#tab_content ul li').hide();
	if(tab == 1)
		$('#tab'+tab).css('background','#FCC');
		else if(tab == 2)
		$('#tab'+tab).css('background','#9FC');
		else if(tab == 3)
		$('#tab'+tab).css('background','#CFF');
	$('#tab'+tab).show();
});
	$('#dialog').hide();
	$('#addSubsDiv').click(function(){
		$('#dialog').slideDown()
	});
});