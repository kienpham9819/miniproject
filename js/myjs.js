$(document).ready(function(){
	$(".view_noti").delay(3000).slideUp();
	
	// modal quen mat khau
    $("#btn_sdt").click(function(e) {
		e.preventDefault(); // Tránh load lại form
		var phone = $("#help").val();
		if (phone != '') {
			if(phone.match(/^\d{10}$/)){
				$.post('quenmatkhau.php', {phone: phone}, function(data) {
				$("#noti_check_md").text('');
				$("#re_password")[0].reset();
				$(".modal").modal('hide');
				$("#noti_phone").html(data);
			 });
			}
			else {
				$("#noti_check_md").css("color", "red");
			$("#noti_check_md").text('Số điện thoại yêu cầu đủ 10 số!');
			}
			 
		}else{
			$("#noti_check_md").css("color", "red");
			$("#noti_check_md").text('Vui lòng không để trống dữ liệu đầu vào!');
		}
			});
			
	

// đổi tên
	$("#btn_rename").click(function(e) {
		// e.preventDefault(); 
		var name = $("#fname").val();
		if (name != '') {
			 $.post('doiten.php', {name: name}, function(data) {
				$("#noti_check_name").text('');
				$("#re_name")[0].reset();

				$(".modal").modal('hide');
				$("#c_n").text(data);
				 $("#noti_name").text(data);
				 
			 });
		}else{
			e.preventDefault(); 
			$("#noti_check_name").css("color", "red");
			$("#noti_check_name").text('Vui lòng không để trống dữ liệu đầu vào!');
		}
	});
// Đổi địa chỉ
	$("#btn_readdr").click(function(e) {
		// e.preventDefault(); 
		var addr = $("#faddr").val();
		if (addr != '') {
			 $.post('doidiachi.php', {addr: addr}, function(data) {
				$("#noti_check_addr").text('');
				$("#re_addr")[0].reset();
				$(".modal").modal('hide');
				$("#c_a").text(data);
				 $("#noti_diachi").text(data);
				 
			 });
		}else{
			e.preventDefault(); 
			$("#noti_check_addr").css("color", "red");
			$("#noti_check_addr").text('Vui lòng không để trống dữ liệu đầu vào!');
		}
	});

	// ban do

	$(function($){
	$('.maphd').show();
	$('.maphd').click(function(){
		// $('.map_co').hide();
		$(this).parents('.map-nav').next().attr('src',
			'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3890.2645267414873!2d105.78520348483408!3d20.979417449003464!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135acd2c0e21d7b%3A0xec2205f220faeb2!2zQ0dWIEjhu5MgR8awxqFtIFBsYXph!5e0!3m2!1svi!2s!4v1574139459224!5m2!1svi!2s');
	});
	$('.mapht').click(function(){
		// $('.map_co').hide();
		$(this).parents('.map-nav').next().attr('src','https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1190.16163116573!2d105.84026248073646!3d21.018459167343106!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab8f9273cd95%3A0xf86c10f7542e986!2sVietcombank!5e0!3m2!1svi!2s!4v1574139937961!5m2!1svi!2s');	
	});
	$('.mapcg').click(function(){
		// $('.map_co').hide();
		$(this).parents('.map-nav').next().attr('src','https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.0434574544047!2d105.781722014213!3d21.0309470930812!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab4c76b12a3b%3A0x9a311c833456d5f0!2zUGjhu5EgRHV5IFTDom4sIEPhuqd1IEdp4bqleSwgSMOgIE7hu5lpLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1574140054021!5m2!1svi!2s');
	});
});


	 function readIMG(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img_add').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
           
        }
    }

    $("#url_img").change(function(event){
        readIMG(this);
        $('#lab_url').attr('width',20);
       // var v  = URL.createObjectURL(event.target.files[0]);
       //  alert(v);

});
     function readIMG1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#url_edit').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }


    $('#img_edit').change(function(){
    	readIMG1(this);
    });


});
