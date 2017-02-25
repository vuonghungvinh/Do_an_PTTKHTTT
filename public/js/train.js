$(document).ready(function(){
	$(".list-trains tr td .delete").click(function(e){
		e.preventDefault();
		var name = $(this).attr("name");
		var url = $(this).attr("href");
		jQuery.noConflict();
		var self = this;
		$.confirm({
		    title: 'Xác nhận!',
		    content: 'Bạn có muốn xoá '+name+'?',
		    buttons: {
		        confirm: {
		        	btnClass: 'btn-danger',
		        	text: "Xoá",
		        	action: function(){
		        		$.get(url, function(data) {
		        			if (data)
		        			{
		        				$.alert('Đã xoá thành công!');
                            	$(self).parent().parent().remove();
		        			} else {
		        				$.alert('Xoá không thành công!');
		        			}
                        });
		        	}
		        },
		        cancel: {
		        	btnClass: 'btn-green',
		        	text: "Hủy bỏ",
		        	action: function(){
		        		// $.alert('Cancel!');
		        	}
		        }
		    }
		});
	});
});