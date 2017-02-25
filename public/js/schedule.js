$(document).ready(function(){
	jQuery.noConflict();
	$("#from_datetime").datetimepicker({format: "YYYY-MM-DD HH:mm:00"});
	$("#to_datetime").datetimepicker({format: "YYYY-MM-DD HH:mm:00"});
	$(".list-schedules tr td .delete").click(function(e){
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
		        				$.alert('Xoá thành công!');
                            	$(self).parent().parent().remove();
		        			} else {
		        				$.alert('Xoá không thành công!');
		        			}
                        });
		        	}
		        },
		        cancel: {
		        	text: "Hủy bỏ",
		        	btnClass: 'btn-green',
		        	action: function(){
		        		// $.alert('Cancel!');
		        	}
		        }
		    }
		});
	});
	$("#trainfilter").change(function(){
		if ($(this).val().length <= 0){
			window.location.href="/";
		} else {
			window.location.href="/?id="+$(this).val();
		}
	})
});