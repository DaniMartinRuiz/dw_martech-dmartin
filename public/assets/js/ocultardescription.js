$(function(){

	$('.btn').on('click',function(event){
		event.preventDefault();

		 $(this).parent().children('.img-fluid').children('.row').children('.offset-md-3').toggle();
	})
})


