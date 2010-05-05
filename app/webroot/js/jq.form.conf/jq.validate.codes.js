
$(document).ready(function(){
		$('form#reduction_codes').validate({
			rules: {
			'data[ReductionCode][code]': {
				required: true,
				maxlength: 127,
				regex: "^[A-Z0-9']{1,127}$" 
			},
			'data[ReductionCode][number_of_people]': {
	      		required: true,
	      		maxlength: 6,
	      		regex: "^[0-9']{1,6}$" 
			}
		},
		messages: {
			'data[ReductionCode][code]': {
				required: "Du måste fylla i något.",
				regex: "Rabattkoden får bara innehålla versaler och siffror."
			},
			'data[ReductionCode][number_of_people]': {
				required: "Du måste fylla i något.",
				regex: "Du kan bara fylla i siffror"
			}
		}
			
		});
		
});
