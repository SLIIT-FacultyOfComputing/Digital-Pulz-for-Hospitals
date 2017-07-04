// JavaScript Document
$(document).ready(function()
	{
	
		$("#allergyC").hide();
		$("#historyC").hide();
		$("#visitsC").hide();
		$("#examsC").hide();
		$("#admitionsC").hide();
		$("#attachC").hide();
		$("#labC").hide();
		$("#medC").hide();
		$("#quesC").hide();
		
		$(".span12 span").click(function()
		{
	 
			var swtich = this.id;
			if ($("#"+ swtich + "C").css('display') == 'none') 
			{
    			$("#"+ swtich).html("<img src='http://opdbeta.srisource.com/assets/ico/up.png' />");
			}
			else
			{
				$("#"+ swtich).html("<img src='http://opdbeta.srisource.com/assets/ico/down.png' />");
			}
			$("#"+ swtich + "C").slideToggle('normal');
		
		});
	});