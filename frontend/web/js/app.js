$(document).ready(function () {


	$('#carousel-example').on('slide.bs.carousel', function (e) {
		var $e = $(e.relatedTarget);
		var idx = $e.index();
		var itemsPerSlide = 5;
		var totalItems = $('.carousel-item').length;

		if (idx >= totalItems-(itemsPerSlide-1)) {
			var it = itemsPerSlide - (totalItems - idx);
			for (var i=0; i<it; i++) {
				// append slides to end
				if (e.direction=="left") {
					$('.carousel-item').eq(i).appendTo('.carousel-inner');
				}
				else {
					$('.carousel-item').eq(0).appendTo('.carousel-inner');
				}
			}
		}
	});


	let allFilingDescr = $('.cake-filling-des');

	$('.cake-filling-radio').on('change', function () {
		allFilingDescr.removeClass('cake-filling-des_show');

		$(".cake-filling-des[data-id="+$(this).data('target')+"]").addClass('cake-filling-des_show');
	});
});




