/**
 * Author       : Joseph Ansal
 * Date         : 21/3/2015  
 * Description  : RCM-Common JavaScript functions.    
 * ------------------------------------------

 */
$(function() {
	$('input').on('ifChecked', function(event){
		var $box = $(this).closest('.box-body');
		var $hP = $box.find('[data-pms-type="primary_phone"]');
		var $wP = $box.find('[data-pms-type="secondary_phone"]');
		var $cP = $box.find('[data-pms-type="cell_phone"]');
		if($(this).attr('name')=='preferred_phone' || $(this).attr('name')=='billing_preferred_phone'){
			if($(this).attr('value')=='W'){
				$wP.attr('data-pms-required','true'),$cP.removeAttr('data-pms-required'),$hP.removeAttr('data-pms-required');
				$hP.parent().parent().find('.control-label').html('Home Phone #'),
				$wP.parent().parent().find('.control-label').eq(0).html('Work Phone#<span class="span-color">*</span>'),
				$cP.parent().parent().find('.control-label').html('Cell#');
			}
			else if($(this).attr('value')=='H'){
				$hP.attr('data-pms-required','true'),$cP.removeAttr('data-pms-required'),$wP.removeAttr('data-pms-required');
				$hP.parent().parent().find('.control-label').html('Home Phone #<span class="span-color">*</span>'),
				$wP.parent().parent().find('.control-label').eq(0).html('Work Phone#'),
				$cP.parent().parent().find('.control-label').html('Cell#');
				
			}
			else if($(this).attr('value')=='C'){
				$cP.attr('data-pms-required','true'),$wP.removeAttr('data-pms-required'),$hP.removeAttr('data-pms-required');
				$hP.parent().parent().find('.control-label').html('Home Phone #'),
				$wP.parent().parent().find('.control-label').eq(0).html('Work Phone#'),
				$cP.parent().parent().find('.control-label').html('Cell#<span class="span-color">*</span>');
			}
		}
	});
	
	if ($('#passwordChangeModal')) {
		$('#passwordChangeModal').html('<form id="passwordChangeForm"> <div style="" class="row"><div class="col-md-11 col-sm-11"></div><div class="col-md-1 col-sm-1"><i class="fa fa-times-circle iconFontSize-medium" style="font-size: 38px; margin-top: -15px;"></i></div></div><div class="row"> <div class="form-group clearfix"> <label class="col-md-4 control-label">Current Password <span class="span-color">*</span></label> <div class="col-md-8"> <input type="password" data-pms-required="true" value="" id="currentPassword" class="form-control"> </div> </div> <div class="form-group clearfix"> <label class="col-md-4 control-label">New Password <span class="span-color">*</span></label> <div class="col-md-8"> <input type="password" name="password" data-pms-type="password" data-pms-required="true" value="" id="newPassword" class="form-control"> </div> </div> <div class="form-group clearfix"> <label class="col-md-4 control-label">Re-enter Password <span class="span-color">*</span></label> <div class="col-md-8"> <input type="password" name="confirm_password" data-pms-type="confirm_password" data-pms-required="true" value="" id="confirmPassword" class="form-control"> </div> </div> <div class="form-group tc"><span id="passwordChangeModalError" class="b"></span></div> <div class="clearfix tc pad"> <input type="hidden" id="selectedLogin" value="" /> <button id="submitPasswordChange" class="btn btn-primary1">Change Password</button> <button id="closePasswordChange" class="btn">Close</button> </div> </div> </form>');
		
		$('.dataTable').on('click', '.change_password', function (e) {
			e.preventDefault();
			var id = $(this).data('login-id');
			$('#selectedLogin').val(id);
			$('#passwordChangeModalError').text('');
			$('#passwordChangeModal').popup('show');
		})
		$('#submitPasswordChange').click(function (e) {
			$.validate({
				form: '#passwordChangeForm',
				onSuccess : function () {
					$.ajax({
						type: 'GET',
						url: '/common/change_password',
						data: {current_password: $('#currentPassword').val(), new_password: $('#newPassword').val(), login_id: $('#selectedLogin').val()},
						dataType: 'json',
						success: function (data) {
							if (data) {
								if (data.error) {
									$('#passwordChangeModalError').removeClass('text-success').addClass('text-danger').text(data.error);
								} else {
									$('#passwordChangeModalError').removeClass('text-danger').addClass('text-success').text(data.success);
								}
							}
						}
					})
					return false;
				}
			});
		})
		$('#closePasswordChange').click(function (e) {
			e.preventDefault();
			$('#selectedLogin, #currentPassword, #newPassword, #confirmPassword').val('');
			$('#passwordChangeModal').popup('hide');
		})
	}
	 
	if ($('.date-range.select-calendar').length) {
		$('.date-range.select-calendar').rcm_datepicker({}, true);
	}
	if ($('.date.select-calendar').length) {
		$('.date.select-calendar').rcm_datepicker();
	}
});

var changeUserStatus=function(uId,obj,stat){
	 $.ajax({
		type: 'GET',
		url: '/common/changeUserStatus',
		data: {userId: uId},
		dataType: 'json',
		success: function (data) {
			if (data) {
				if(stat==0){
					obj.attr('data-status',1);
					obj.html('<i class="fa fa-user user-icon-color-active"></i>'),obj.attr('data-original-title','Change status to Inactive');
				}else{
					obj.attr('data-status',0);
					obj.html('<i class="fa fa-user user-icon-color-inactive"></i>'),obj.attr('data-original-title','Change status to Active')
				}
				return true;
			}
		}
	});
}

function displaySelectByUserType () {
	var cur_user_type = $('#currentLoggedInUserType').val();
	if (cur_user_type) {
		if (cur_user_type === 'A') {
		} else if (cur_user_type === 'H') {
			$('[data-pms-class="billing-company"]').hide();
			$('.hub').css('display','none');
		} else if (cur_user_type === 'B') {
			$('[data-pms-class="billing-company"]').hide();
			$('.branch').css('display','none');
		} else if(cur_user_type === 'X'){
			$('[data-pms-class="billing-company"]').hide();
			$('.Biller').css('display','none');
		}
		else if (cur_user_type === 'P'){
			$('[data-pms-class="billing-company"]').hide();
			$('[data-pms-class="practice"]').hide();
			$('.Practice').css('display','none');
		}
		else if(cur_user_type === 'F'){
			$('[data-pms-class="billing-company"]').hide();
			$('[data-pms-class="practice"]').hide();
			$('.Administrator').css('display','none');
		}
		else if(cur_user_type === 'D'){
			$('[data-pms-class="billing-company"]').hide();
			$('[data-pms-class="practice"]').hide();
			$('.Provider').css('display','none');
		}
	}
}


displaySelectByUserType();

function getRequestParams (arParams) {
	if (!arParams.length) return false;
	var arData = {};
	for (var i in arParams) {
		var $el = $('#'+ arParams[i]);
		if ($el) {
			var name = $el.attr('name') ? $el.attr('name') : arParams[i];
			arData[name] = $el.val();
		}
	}
	return arData;
}
function makeSelectionBoxOptions(hashValue, isHash) {
	var optionList = '';
	var arDefPracticeProviderValues = $.map(arDefPracticeProvider, function (v,k) {return v});
	$.each( hashValue, function( key, value ) {
		var selectText = '';
		var val = isHash ? key : value;
		if (value === 'Select') val = "";
		if ($.inArray(val, arDefPracticeProviderValues) >= 0) selectText = ' selected="selected" ';
		optionList += "<option"+ selectText +" value="+ val +">"+ value +"</option>";
	});
    return optionList;
}

function patientSearchCriteria() {	
	var searchList = "<option value='Last_name'>Last Name</option><option value='First_name'>First Name</option><option value='Account_no'>Acct#</option><option value='SSN'>SSN</option><option value='external_id'>External ID</option>";
	return searchList;
}

function checkAjaxSession (data) {

	if (data === 'ERR:SESS001') {
		window.location = "/login/";
	}
	return data;
}
function processAjax($url,$data,$callcback,$method,$dataType){
	$method=($method)?$method:'GET';
	$dataType=($method)?$dataType:'json';
	$.ajax({
		type: $method,url: $url,
		data: $data,dataType:$dataType,
		success: function (data) {
			checkAjaxSession(data);
			if($callcback) 
				$callcback(data);
        }, 
		error:function(xhr,errorThrown){
			console.log("Error message:"+xhr.responseText);
			console.log("Error ajax"+errorThrown);
		}
	});
}

var _dynamicLoadedScripts = [];
$.fn.extend({
	rcm_autosuggest: function(url,source_data, callback) {
	var $t = $(this);
	var data_search = {};	
	if (!callback) {
		if (typeof source_data !== 'undefined' && $.isFunction(source_data)) {
			callback = source_data;
			source_data = [];
		}
	}
	$t.keyup(function () {
		if (source_data) {
		for (var i in source_data) {
			data_search[i] = source_data[i].val();
		}
		}
		$t.autocomplete({
			 
		  source: function(request,response){
		  	var term=request.term;
		    if (term.length) data_search['search_term'] = term;
					 
			$.ajax({
			  url: url,
			  type: 'GET',
			  data: data_search,
			  dataType: 'json',
			  success:function(data)
			  {
				var responseData = [];
				if (data) {
					for (var i in data) {
						responseData.push($.makeArray(data[i]).join('|'));
					}
				}     
			      response(responseData);
			  }
		     
		      });             
		  }, select: function(e, ui)
			  {
			  	e.preventDefault();
			    var value = ui.item.value;
			   	this.value = ui.item.label;
			    if (typeof callback !== 'undefined' && $.isFunction(callback)) {
			    	callback(e, ui.item, value);
			    }
			    
			  },
			  focus: function (e, ui) {
			  	e.preventDefault();
			   	this.value = ui.item.label;
			  },
		      response: function(e, ui) {
		      	if (ui.content) {
		      		for (var i in ui.content) {
		      			ui.content[i]['label'] = ui.content[i].label.replace(/\|+/g, '-');
		      		}
		      	}
		      },
			  open: function(event, ui) { disable=true },
			  close: function(event, ui) {
			  disable=false; $(this).focus();
			}
		})
	    
    })
 
	},

	rcm_autoComplete:function(url,columnObj,extraParam,callback){
		var $t = $(this);
		if (!callback) {
			if (typeof extraParam !== 'undefined' && $.isFunction(extraParam)) {
				callback = extraParam;
			}
		}
		var data_search = {};
		$t.keyup(function () {
			$t.combogrid({
				url:url,
				debug:true,
				colModel:columnObj,
				select: function( event, ui ) {
					if (typeof callback !== undefined && $.isFunction(callback)) {
			    	callback($t,event, ui.item);
					}
					return false;
				}
			});
			if(typeof extraParam !== undefined ){
				for(i in extraParam){
					data_search[i]=encodeURIComponent(extraParam[i].val());
				}
				$t.combogrid( "option", "dataParam", data_search);
			}
//			extraParam['searchBy'].css("border-color","");
		
		});
	},
	rcm_autoComplete_d:function(){
		var $t = $(this);
		$t.keyup(function () {
			$t.removeClass('cg-loading');
			if(!$t.combogrid( "option", "disabled" )){
				$t.combogrid( "option", "disabled", true );
			}
		});
	}

});

$.extend({
	getCss: function (scriptLocationAndName) {
	    var head = document.getElementsByTagName('head')[0];
	    var link = document.createElement('link');
	    link.type = 'text/css';
	    link.rel = 'stylesheet';
	    $.get(scriptLocationAndName, function (d) {
		    link.href = scriptLocationAndName;
		    link.content = d;
		    head.appendChild(link);
	    })
	}
})

$.extend({
	addOverlay: function () {
		if (!$('.blockUIParent').length)
		$('body').append('<div class="blockUIParent hide"><div class="blockUIMsg"><img src="/assets/img/ajax-loader-black.gif"> <span>Please wait...</span></div><div class="blockUIOverlay"></div></div>');
		$('.blockUIParent').removeClass('hide');
	},
	removeOverlay: function () {
		if ($('.blockUIParent').length) $('.blockUIParent').addClass('hide');
	}
})

if ($('.date-range.select-calendar') || $('.date.select-calendar')) {

	$.fn.extend({
		rcm_datepicker: function (options, range) {
			var $t = $(this);
			$.ajaxSetup({
			  cache: true
			})
				$.when(
					// $.getScript(base_url+'/assets/plugins/datepicker/moment.min.js'),
					// $.getScript(base_url+'/assets/plugins/datepicker/daterangepicker.js'),
					// $.getCss(base_url+'/assets/plugins/datepicker/daterangepicker.css'),
					// $.Deferred(function (deferred) {
					// 	$(deferred.resolve);
					// })
				).done(function () {
					var datepicker_options = {
						format: 'MM/DD/YYYY',
						dateLimit: { days: 60 },
						showDropdowns: true,
					};

					var range_options = {
						ranges: {
							'Today': [moment(), moment()],
							'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
							'Last 7 Days': [moment().subtract(6, 'days'), moment()],
							'Last 30 Days': [moment().subtract(29, 'days'), moment()],
							'This Month': [moment().startOf('month'), moment().endOf('month')],
							'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
						},
						opens: 'left',
						buttonClasses: ['btn', 'btn-sm'],
						applyClass: 'btn-primary',
						cancelClass: 'btn-default',
						separator: ' - ',
						locale: {
							applyLabel: 'Submit',
							cancelLabel: 'Cancel',
							fromLabel: 'From',
							toLabel: 'To',
							customRangeLabel: 'Custom',
							daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
							monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
							firstDay: 0
						}
					}
					var single_options = {
						singleDatePicker: true
					}
					var extra_options = (typeof range === 'undefined') ? single_options : range_options;
					var settings = $.extend( {}, datepicker_options, extra_options, (options || {}) );
					_initiateDateRange($t, settings, range);
				})
		}
	});
	var _initiateDateRange = function ($t, settings, range) {

		var $el = $t.prev('[data-pms-type="date"]');
		if ($el.attr('data-pms-max-date') === 'today') settings['maxDate'] = moment();
		if (range) {
			$t.daterangepicker(settings, function(start, end, label) {
				if ($el) {
					var to_id = $el.attr('data-pms-date-to');
					var from_id = $el.attr('data-pms-date-from');
					var format = $el.attr('placeholder').toUpperCase();
					if (to_id) {
						$el.val(start.format(format));
						$('#'+ to_id).val(end.format(format)).focus();
					} else if (from_id) {
						$el.val(end.format(format));
						$('#'+ from_id).val(start.format(format)).focus();
					} else {

					}
				}
			}); 
		} else {
			$t.daterangepicker(settings, function(start, end, label) {
				var $el = $($(this)[0]['element'][0]).prev('[data-pms-type="date"]');
				if ($el.attr('data-pms-max-date') === 'today') settings['maxDate'] = moment();
				var format = $el.attr('placeholder').toUpperCase();
				if ($el) $el.val(start.format(format)).focus();
			}); 
		}
	}
}
$.extend({
showNotificationMessage:function(text_message,message_type, sticky){
	var expires = 0;
	if (!sticky) expires = 4000;
  var color, icon, title;
  if(message_type=="error"){
  	title = 'Error';
    color="#DD4B39";
    icon="fa fa-exclamation-triangle";
  }
  else{
  	title = 'Success';
    color="#26BFA1";
    icon="fa fa-check";
  }
  if (!$("#notificationContainer").length) $('body').append('<div id="notificationContainer" style="display:none"><div id="defaultNotification"><a class="ui-notify-close ui-notify-cross" href="#">x</a><h1>#{title}</h1><p>#{text}</p></div></div>');
  $container = $("#notificationContainer").notify({expires: expires});    
  create("defaultNotification", { title:title, text:'<span class="'+icon+'" style="float: left;  margin-right: 0.3em;"></span>'+text_message});

  $(".ui-notify-message-style").css("background-color",color);
  $(".ui-notify-message-style .ui-icon").addClass(icon);   
}
});
function create(template, vars, opts ){
	return $container.notify("create", template, vars, opts);
}
