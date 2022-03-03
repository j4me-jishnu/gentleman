/*
    * Validate fax,phone
    */
	var code='202|||203|||204|||205|||206|||207|||208|||209|||210|||212|||213|||214|||215|||216|||217|||218|||219|||224|||225|||226|||228|||229|||231|||234|||239|||240|||242|||246|||248|||250|||251|||252|||253|||254|||256|||260|||262|||264|||267|||268|||269|||270|||276|||281|||284|||289|||301|||302|||303|||304|||305|||306|||307|||308|||309|||310|||312|||313|||314|||315|||316|||317|||318|||319|||320|||321|||323|||325|||330|||331|||334|||336|||337|||339|||340|||343|||345|||347|||351|||352|||360|||361|||385|||386|||401|||402|||403|||404|||405|||406|||407|||408|||409|||410|||412|||413|||414|||415|||416|||417|||418|||419|||423|||424|||425|||430|||432|||434|||435|||438|||440|||441|||442|||443|||450|||456|||458|||469|||470|||473|||475|||478|||479|||480|||484|||500|||501|||502|||503|||504|||505|||506|||507|||508|||509|||510|||512|||513|||514|||515|||516|||517|||518|||519|||520|||530|||533|||534|||540|||541|||551|||559|||561|||562|||563|||567|||570|||571|||573|||574|||575|||579|||580|||581|||585|||586|||587|||600|||601|||602|||603|||604|||605|||606|||607|||608|||609|||610|||612|||613|||614|||615|||616|||617|||618|||619|||620|||623|||626|||630|||631|||636|||641|||646|||647|||649|||650|||651|||657|||660|||661|||662|||664|||670|||671|||678|||681|||682|||684|||700|||701|||702|||703|||704|||705|||706|||707|||708|||709|||710|||712|||713|||714|||715|||716|||717|||718|||719|||720|||724|||727|||731|||732|||734|||740|||747|||754|||757|||758|||760|||762|||763|||765|||767|||769|||770|||772|||773|||774|||775|||778|||779|||780|||781|||784|||785|||786|||787|||800|||801|||802|||803|||804|||805|||806|||807|||808|||809|||810|||812|||813|||814|||815|||816|||817|||818|||819|||828|||829|||830|||831|||832|||843|||845|||847|||848|||849|||850|||855|||856|||857|||858|||859|||860|||862|||863|||864|||865|||866|||867|||868|||869|||870|||872|||876|||877|||878|||888|||900|||901|||902|||903|||904|||905|||906|||907|||908|||909|||910|||912|||913|||914|||915|||916|||917|||918|||919|||920|||925|||928|||931|||936|||937|||938|||939|||940|||941|||947|||949|||951|||952|||954|||956|||970|||971|||972|||973|||978|||979|||980|||985|||989|||';
    $.formUtils.addValidator({
        name : 'usPhone',
        validatorFunction : function(value, $el, conf,language) {
			switch($el.attr('data-pms-type')){ 
				case 'fax': language.badFax='Please enter a valid US fax number.';break;
				case 'cell_phone':  language.badFax='Please enter a valid US phone number.';break;
				case 'secondary_phone':language.badFax='Please enter a valid US phone number.';break;
				case 'primary_phone': language.badFax='Please enter a valid US phone number.';break;
			}
			if(value){
				var p=/\d{10}$/;
				if(p.test(value)){
					var n=value.replace(/\D/gi, "");
					var arr = n.split("");var res="";
					for(var i=0;i<=arr.length;i++){
						res += arr[i];
						if(i == 2 || i == 5){
							res += "-";
						}
					}
					value=res.replace(/[a-z]/gi, "");
				}
				var patt =/^\d{3}-\d{3}-\d{4}$/;
				if(!patt.test(value)){ return false }
				else{
					var res = code.match(value.split("-")[0]);
					if(res)	return true	;		    
					else return false;
				}
			}
			else {
			    
				if($el.attr('data-pms-required') == 'true'){
				    return false;
				}
				return true;
			}
        },
        errorMessage : '',
        errorMessageKey: 'badFax'
    });
    
	/*
    }
    * Validate Password
    */
    $.formUtils.addValidator({
        name : 'password',
        validatorFunction : function(value, $el, conf,language) {
	    console.log('password');
			if(value){
				var patt=/[0-9]/;
				var p=/[A-Z]/;
				var stat=true;
				if(value.length<8){ 
					language.badPass='Please enter at least 8 characters..';
					stat= false;
					return false;
				}
				if(/\s/g.test(value)){ 
					language.badPass='Please check your input';
					stat= false; return false;
				} 
				if (value.match(/(.*[!,@,#,$,%,^,&,*,?,_,~])/)==null) {
					language.badPass='Your password must contain at least one special characters.';
					stat= false; return false;
				}
				if(!patt.test(value)){ 
					language.badPass='Your password must contain at least one digit.';
					stat= false;return false;
				}
				if(!p.test(value)){
					language.badPass='Your password must contain at least one capital letter.';
					stat= false; return false;
				}
				if(stat) return true;
			}
			else {
				language.badPass='This field is required.';
				return false
			};
        },
        errorMessage : '',
        errorMessageKey: 'badPass'
    });
	/*
    * Validate confirm Password
    */
    $.formUtils.addValidator({
        name : 'passConfirm',
        validatorFunction : function(value, $el, config,language,$form) {
			var conf = '',
                confInputName = $el.attr('name').split('_')[1],
                confInput = $form.find('input[name="' +confInputName+ '"]').eq(0);

            if (confInput) {
                conf = confInput.val();
            } else {
                console.warn('Could not find an input with name "'+confInputName+'"');
            }
            return value === conf;
        },
        errorMessage : '',
        errorMessageKey: 'notConfirmed'
    });
	/*
    * Validate city,state
    */
    $.formUtils.addValidator({
        name : 'formCityState',
        validatorFunction : function(value, $el, config,language,$form) {
			if($el.context.options.length>0) return true;
			else return false;
        },
        errorMessage : '',
        errorMessageKey: 'requiredFields'
    });
	/*
    * Validate Address
    */
    $.formUtils.addValidator({
        name : 'address',
        validatorFunction : function(value, $el, config,language) {
			var p=/^[a-zA-Z0-9_\/\\'\s\#\.\-\&\(\)\+\!\,\;\?\=\"]+$/;
			if($el.attr('data-pms-required')){
				if(!p.test(value)){
					return false;
				}	
			}else {
				if(value!=''){
					if(!p.test(value)){
					return false;
					}	
				}
				return true;
			}
			return true;
        },
        errorMessage : '',
        errorMessageKey: 'badAddress'
    });
	/*
    * Validate userRole
    */
    $.formUtils.addValidator({
        name : 'userRole',
        validatorFunction : function(value, $el, config,language) {
			if(value=='')return false;
			else return true;
			//return true;
        },
        errorMessage : 'This field is required',
        errorMessageKey: ''
    });
    /*
    * Validate Country
    */
    $.formUtils.addValidator({
        name : 'countryUS',
        validatorFunction : function(value, $el, config,language) {
	    if($el.attr('data-pms-required')){
                if(value=='') {
                	language.badCountry = "This field is required";
                	return false;
                }
                else if(!(/^[a-zA-Z0-9_]+$/.test(value))){
                	language.badCountry = "Please check your input";
                	return false;
                }
            }
            else{
				if(value!='') {
					if(!(/^[a-zA-Z0-9_]+$/.test(value))) {
                		language.badCountry = "Please check your input";
                		return false;
                	}
                }
                else return true;
            }
        },
        errorMessageKey: 'badCountry'
    });
	/*
    * Validate phoneExtension
    */
	  $.formUtils.addValidator({
        name : 'phoneExtension',
        validateOnKeyUp : true,
        validatorFunction : function(value, $el, config,language) {
			 value = value.replace(/[\_]+/g, '');
			 if(value.length>5) return false;
			 if(value!='') return /[0-9]+/g.test(value);
			 return true;
		},
		errorMessage : 'Please check your input',
		errorMessageKey: ''
	});
	/*
    * Validate firstName
    */
	$.formUtils.addValidator({
        name : 'nameFields',
        validateOnKeyUp : true,
        validatorFunction : function(value, $el, config,lang) {
			 if(value){
				if(!/^[a-zA-Z\'\s\-]+$/.test(value)){ lang.bfn='Please check your input'; return false}
			 }else{
				if($el.attr('data-pms-required')){ lang.bfn='This field is required ';return false;}return true;
			 }
			 return true;
		},
		errorMessage : '',
		errorMessageKey: 'bfn'
	});
	
    	/*
    * Validate digits only
    */
	$.formUtils.addValidator({
        name : 'digitsOnly',
        validateOnKeyUp : true,
        validatorFunction : function(value, $el, config,lang) {
			 if(value){
				if(!/^[0-9]+$/.test(value)){ lang.bfn='Please check your input'; return false}
			 }else{
				if($el.attr('data-pms-required')){ lang.bfn='This field is required ';return false;}return true;
			 }
			 return true;
		},
		errorMessage : '',
		errorMessageKey: 'bfn'
	});
	
	/*
    * Validate digits only
    */
	$.formUtils.addValidator({
        name : 'alphanumericsOnly',
        validateOnKeyUp : true,
        validatorFunction : function(value, $el, config,lang) {
			 if(value){
				if(!/^[a-z0-9]+$/i.test(value)){ lang.bfn='Please check your input'; return false}
			 }else{
				if($el.attr('data-pms-required')){ lang.bfn='This field is required ';return false;}return true;
			 }
			 return true;
		},
		errorMessage : '',
		errorMessageKey: 'bfn'
	});
	/*
    * Validate zipFourDigit
    */
	$.formUtils.addValidator({
        name : 'zipFourDigit',
        validateOnKeyUp : true,
        validatorFunction : function(value, $el, config,language) {
			 value = value.replace(/[\_]+/g, '');
			 if(value){
				if(value.length<4) {language.badFourDigitZip='Enter 4 digit'; return false;}
			 }else{
				if($el.attr('data-pms-required')){ language.badFourDigitZip='This field is required ';return false;}
				return true;
			 }
			 return true;
		},
		errorMessage : '',
		errorMessageKey: 'badFourDigitZip'
	});
	/*
    * Validate ZipCode
    */
    var previousVal = {};
    $.formUtils.addValidator({
        name : 'zipcode',
        validateOnKeyUp : true,
        validatorFunction : function(value, $el, config,language) {
            value = value.replace(/[\_]+/g, '');
            var elementName = $el.attr('name');
            if (!value) {
                if($el.attr('data-pms-required')) return false;
                return true;
            } else {
                var $box = $el.closest('.box-body');
                var $city = $box.find('[data-pms-type="city"]');
                var $state = $box.find('[data-pms-type="state"]');
                if (value.length == 5) {
                    if ($city.val() && $state.val() && previousVal[elementName] === value) return true;
                    previousVal[elementName] = value;
                    var isLoaded = false;
                    $.formUtils.haltValidation = true;
                    $.ajax ({
                        url: '/common/zipcode/',
                        type: 'GET',
                        data: {zipcode: value},
                        dataType: 'json',
                        async:false,
                        success: function (data) {
                            if (data[0] && data[0][0]) {
                    			var city,state = '';
                    			$state.html('');
                            	$.each( data, function( key, value ) {
                        			city += '<option value="'+ data[key][1] +'">'+ data[key][1] +'</option>';
                                	state = '<option value="'+ data[key][2] +'">'+ data[key][3] +'</option>';
                                	$box.find('[data-pms-type="country"]').val('US'); 
                                	if($state.find("option[value='"+data[key][2]+"']").length == 0) {
                                		$state.html($state.html()+state);
                                	}
                            	});
								$city.html(city);
                    			if($city.attr('city') && $city.attr('city') != ''){
                    				if($city.find("option[value='"+$city.attr('city')+"']").length != 0) {
                    					$city.val($city.attr('city'));
                    				}
                    			}
                    			if($state.attr('state') && $city.attr('state') != ''){
                    				if($state.find("option[value='"+$state.attr('city')+"']").length != 0) {
                    					$state.val($state.attr('state'));
                    				}
                    			}
                    			$.formUtils.haltValidation = false;
                            }
							else{
								console.log("Invalid Zip code");
								$box.find('[data-pms-type="country"]').val('');
                    			$city.html('');
                    			$state.html('');
								return false;
							}
                        }
                    });
                    return true;
                } else {
                    $box.find('[data-pms-type="country"]').val('');
                    $city.html('');
                    $state.html('');
                }
            }
        },
        errorMessage : '',
        errorMessageKey: 'badZip'
    });
	/*
    * Validate userid
    */
	
    $.formUtils.addValidator({
        name : 'userId',
        validatorFunction : function(value, $el, config,language,$form) {
			if(value && !$el.attr('readonly')){
				if(/^[a-zA-Z0-9_]+$/.test(value)){
					if($.formUtils.eventType == 'keyup')
						return null;
					$.ajax({
						url : '/common/userIdCheck/',
						type : 'GET',
						cache : false,
						data : {login_fk:value},
						dataType : 'json',
						async:false,
						error : function(error, err) {
							console.log('Server validation failed due to: '+error.statusText);
							if( window.JSON && window.JSON.stringify ) {
								console.log(window.JSON.stringify(error));
							}
						},
						success : function(response) {
							if(response.success=='false'){	
								language.userIdCheck='This username is already taken! Try another.';
								return false;
							}else	{
								return true;
							}
							
						}
					});
				}else {language.userIdCheck='Please check your input';return false;};
			}else{ if($el.attr('data-pms-required')){language.userIdCheck='This field is required'; return false;} }
        },
        errorMessageKey: 'userIdCheck'
    });
    
    $.formUtils.addValidator({
        name : 'npi',
        validatorFunction : function(value, $el, config,language) {
			value = value.replace(/[\_]+/g, '');
			if(value){
			    if(value.length<10) {language.badNPI='Enter 10 digit'; return false;}
			 }
			 else{
			    if($el.attr('data-pms-required')){ language.badNPI='This field is required ';return false;}
				return true;
			 }
			 return true;
		},
		errorMessage : '',
		errorMessageKey: 'badNPI'
	});

    $.formUtils.addValidator({
        name : 'required',
        validatorFunction : function(value, $el, config,language) {
			if(!value){
				if($el.attr('data-pms-required')){ language.badRequired='This field is required ';return false;}
				return true;
			}
			return true;
		},
		errorMessage : '',
		errorMessageKey: 'badRequired'
	});

