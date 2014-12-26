PUKISAPP.createNameSpace("PUKISAPP.BEHAVIOR.USERS");

PUKISAPP.BEHAVIOR.USERS.permissions = function() {
	var aclExpand = function(){
		$(".expand").mouseover(function(){ $(this).css('cursor', 'pointer'); });
		$('.expand').click(function(){
			$this = $(this);
			$text = $(this).text();
			if ( $('.controller-'+$text).is(':visible') == true ) {
				$('.controller-'+$text).addClass('hidden');
			}else{
				$('.controller-'+$text).removeClass('hidden');
			}
		});
	}
	var aclChange = function(element) {
		$(".permission-toggle").mouseover(function(){ $(this).css('cursor', 'pointer'); });
		$(".permission-toggle").click(function(){
			$.ajax({
				url: '/admin/users/permissions/change/',
				type: 'POST',
				dataType: 'JSON',
				data: {
					aco_id: $(this).data('aco_id'),
					aro_id: $(this).data('aro_id')
				},
				success: function(data){
					response = PUKISAPP.BEHAVIOR.PUKIS.util().checkJson(data);
			    	if (typeof response.url != 'undefined') {
			    		PUKISAPP.BEHAVIOR.PUKIS.ajax().ajaxRequest($(this), '/admin/users/permissions/index', element);				
					} else {
						$(element).html(data);
					}
				},
				beforeSend: function(data){
					$('#loader').show();
				},
				complete: function(data){
					$('#loader').hide();
				}
			});
		});
	}
	return {
		aclChange: aclChange
	}
};