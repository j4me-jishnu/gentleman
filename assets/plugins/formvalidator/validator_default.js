/**
 * jQuery default Validator set-up
 * ------------------------------------------

 */
$(function() {
	$('[data-pms-required]').each(function(k,v){
		objrequiresAttr = $(this).attr('data-pms-required');
		if(objrequiresAttr == 'true'){
			$(this).attr('data-validation','required');
		}
	});
	
	$('[data-pms-type]').each(function(k,v){
		objAttr=$(this).attr('data-pms-type');
		if(objAttr=='date'){
			$(this).attr('data-validation','date');
			$(this).attr('data-validation-format',$(this).attr('placeholder'));
			$(this).inputmask($(this).attr('placeholder'));
			if($(this).attr('data-pms-max-date') === 'today') {
				$(this).attr('data-validation','birthdate');
			}
		}
		else if(objAttr=='fax' || objAttr=='cell_phone' || objAttr=='secondary_phone'|| objAttr=='primary_phone'){
			$(this).attr('data-validation','usPhone');
//			$(this).inputmask("999-999-9999");
		}
		else if(objAttr=='email'){
			$(this).attr('data-validation','email');
		}
		else if(objAttr=='secondary_phone_extension'){
			$(this).inputmask("99999");
			$(this).attr('data-validation','phoneExtension');
		}
		else if(objAttr=='five_digit_zip'){
//			$(this).inputmask("99999");
			$(this).attr('data-validation','zipcode');
		}
		else if(objAttr=='four_digit_zip'){
			$(this).inputmask("9999");
			$(this).attr('data-validation','zipFourDigit');
		}
		else if(objAttr=='last_name' || objAttr=='first_name'|| objAttr=='middle_name'){
			$(this).attr('data-validation','nameFields');
		}
		else if(objAttr=='password'){
			$(this).attr('data-validation','password');
		}
		else if(objAttr=='confirm_password'){
			$(this).attr('data-validation','passConfirm');
		}
		else if(objAttr=='login_fk'){
			$(this).attr('data-validation','userId');
		}
		else if(objAttr=='city' || objAttr=='state'){
			$(this).attr('data-validation','formCityState');
		}
		else if(objAttr=='address1' || objAttr=='address2'){
			$(this).attr('data-validation','address');
		}
		else if(objAttr=='role'){
			$(this).attr('data-validation','userRole');
		}
		else if(objAttr=='country'){
			$(this).attr('data-validation','countryUS');
		}
		else if(objAttr=='npi'){
			$(this).attr('data-validation','npi');
			$(this).inputmask("9999999999");
		}
		else if(objAttr=='patientAmountchecking'){
			$(this).attr('data-validation','patientAmountchecking');
		}
		else if(objAttr=='outstandingBalance'){
			$(this).attr('data-validation','outstandingBalance');
		}
		else if(objAttr == 'digitsOnly'){
			$(this).attr('data-validation','digitsOnly');
		}
		else if(objAttr == 'alphanumericsOnly'){
			$(this).attr('data-validation','alphanumericsOnly');
		}
		else{
			console.log('k=',k,' v=',$(this).attr('data-pms-type'));
		}
	});
	
	$.validate({
		modules : 'security,date,pms',
		onModulesLoaded : function() {
			if ($('[data-pms-type="five_digit_zip"]').val()) $('[data-pms-type="five_digit_zip"]').blur();
		}
	});
});