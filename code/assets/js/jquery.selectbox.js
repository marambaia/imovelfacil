/*
 *  jQuery selectbox - A cosmetic, styleable replacement for SELECT elements
 *
 *  Copyright 2012 Cory LaViska for A Beautiful Site, LLC.
 *
 *  https://github.com/claviska/jquery-selectbox
 *
 *  Licensed under both the MIT license and the GNU GPLv2 (same as jQuery: http://jquery.org/license)
 *
 */
 /*global jQuery:false */
(function($) {
	"use strict";

	$.extend($.fn, {

		selectbox: function(method, data) {

			var typeTimer,
				typeSearch = '',
				isMac = navigator.platform.match(/mac/i);

			//
			// Private methods
			//

			var init = function(select, data) {
				
				var options;
				
				// Disable for iOS devices (their native controls are more suitable for a touch device)
				if( navigator.userAgent.match(/iPad|iPhone|Android|IEMobile|BlackBerry/i) ) { return false; }

				// Element must be a select control
				if( select.tagName.toLowerCase() !== 'select' ) { return false; }

				select = $(select);
				if( select.data('selectbox-control') ) { return false; }

				var control = $('<a class="selectbox" />'),
					inline = select.attr('multiple') || parseInt(select.attr('size'), 10) > 1;

				var settings = data || {};
				
				control
					.width(select.outerWidth())
					.addClass(select.attr('class'))
					.attr('title', select.attr('title') || '')
					.attr('tabindex', parseInt(select.attr('tabindex'), 10))
					.css('display', 'inline-block')
					.bind('focus.selectbox', function() {
						if( this !== document.activeElement && document.body !== document.activeElement ) { $(document.activeElement).blur(); }
						if( control.hasClass('selectbox-active') ) { return; }
						control.addClass('selectbox-active');
						select.trigger('focus');
					})
					.bind('blur.selectbox', function() {
						if( !control.hasClass('selectbox-active') ) { return; }
						control.removeClass('selectbox-active');
						select.trigger('blur');
					});
				
				if( !$(window).data('selectbox-bindings') ) {
					$(window)
						.data('selectbox-bindings', true)
						.bind('scroll.selectbox', hideMenus)
						.bind('resize.selectbox', hideMenus);
				}
				
				if( select.attr('disabled') ) { control.addClass('selectbox-disabled'); }
				
				// Focus on control when label is clicked
				select.bind('click.selectbox', function(event) {
					control.focus();
					event.preventDefault();
				});

				// Generate control
				if( inline ) {

					//
					// Inline controls
					//
					options = getOptions(select, 'inline');

					control
						.append(options)
						.data('selectbox-options', options)
						.addClass('selectbox-inline selectbox-menuShowing')
						.bind('keydown.selectbox', function(event) {
							handleKeyDown(select, event);
						})
						.bind('keypress.selectbox', function(event) {
							handleKeyPress(select, event);
						})
						.bind('mousedown.selectbox', function(event) {
							if( $(event.target).is('A.selectbox-inline') ) { event.preventDefault(); }
							if( !control.hasClass('selectbox-focus') ) { control.focus(); }
						})
						.insertAfter(select);

					// Auto-height based on size attribute
					if( !select[0].style.height ) {

						var size = select.attr('size') ? parseInt(select.attr('size'), 10) : 5;

						// Draw a dummy control off-screen, measure, and remove it
						var tmp = control
							.clone()
							.removeAttr('id')
							.css({
								position: 'absolute',
								top: '-9999em'
							})
							.show()
							.appendTo('body');
						tmp.find('.selectbox-options').html('<li><a>\u00A0</a></li>');
						var optionHeight = parseInt(tmp.find('.selectbox-options A:first').html('&nbsp;').outerHeight(), 10);
						tmp.remove();

						control.height(optionHeight * size);

					}

					disableSelection(control);

				} else {

					//
					// Dropdown controls
					//
					var label = $('<span class="selectbox-label" />'),
						arrow = $('<span class="selectbox-arrow" />');
					
					// Update label
					label
						.attr('class', getLabelClass(select))
						.text(getLabelText(select));
					
					options = getOptions(select, 'dropdown');
					options.appendTo('BODY');

					control
						.data('selectbox-options', options)
						.addClass('selectbox-dropdown')
						.append(label)
						.append(arrow)
						.bind('mousedown.selectbox', function(event) {
							if( control.hasClass('selectbox-menuShowing') ) {
								hideMenus();
							} else {
								event.stopPropagation();
								// Webkit fix to prevent premature selection of options
								options.data('selectbox-down-at-x', event.screenX).data('selectbox-down-at-y', event.screenY);
								showMenu(select);
							}
						})
						.bind('keydown.selectbox', function(event) {
							handleKeyDown(select, event);
						})
						.bind('keypress.selectbox', function(event) {
							handleKeyPress(select, event);
						})
						.bind('open.selectbox', function(event, triggerData) {
							if(triggerData && triggerData._selectbox === true){ return; }
							showMenu(select);
						})
						.bind('close.selectbox', function(event, triggerData) {
							if(triggerData && triggerData._selectbox === true) { return; }
							hideMenus();
						})						
						.insertAfter(select);
					
					// Set label width
					var labelWidth = control.width() - arrow.outerWidth() - parseInt(label.css('paddingLeft'), 10) - parseInt(label.css('paddingLeft'), 10);
					label.width(labelWidth);
					
					disableSelection(control);
					
				}

				// Store data for later use and show the control
				select
					.addClass('selectbox')
					.data('selectbox-control', control)
					.data('selectbox-settings', settings)
					.hide();
				
			};


			var getOptions = function(select, type) {
				var options;

				// Private function to handle recursion in the getOptions function.
				var _getOptions = function(select, options) {
					// Loop through the set in order of element children.
					select.children('OPTION, OPTGROUP').each( function() {
						// If the element is an option, add it to the list.
						if ($(this).is('OPTION')) {
							// Check for a value in the option found.
							if($(this).length > 0) {
								// Create an option form the found element.
								generateOptions($(this), options);
							}
							else {
								// No option information found, so add an empty.
								options.append('<li>\u00A0</li>');
							}
						}
						else {
							// If the element is an option group, add the group and call this function on it.
							var optgroup = $('<li class="selectbox-optgroup" />');
							optgroup.text($(this).attr('label'));
							options.append(optgroup);
							options = _getOptions($(this), options);
						}
					});
					// Return the built strin
					return options;
				};

				switch( type ) {

					case 'inline':

						options = $('<ul class="selectbox-options" />');
						options = _getOptions(select, options);
						
						options
							.find('A')
								.bind('mouseover.selectbox', function() {
									addHover(select, $(this).parent());
								})
								.bind('mouseout.selectbox', function() {
									removeHover(select, $(this).parent());
								})
								.bind('mousedown.selectbox', function(event) {
									event.preventDefault(); // Prevent options from being "dragged"
									if( !select.selectbox('control').hasClass('selectbox-active') ) { select.selectbox('control').focus(); }
								})
								.bind('mouseup.selectbox', function(event) {
									hideMenus();
									selectOption(select, $(this).parent(), event);
								});

						disableSelection(options);

						return options;

					case 'dropdown':
						options = $('<ul class="selectbox-dropdown-menu selectbox-options" />');
						options = _getOptions(select, options);

						options
							.data('selectbox-select', select)
							.css('display', 'none')
							.appendTo('BODY')
							.find('A')
								.bind('mousedown.selectbox', function(event) {
									event.preventDefault(); // Prevent options from being "dragged"
									if( event.screenX === options.data('selectbox-down-at-x') && event.screenY === options.data('selectbox-down-at-y') ) {
										options.removeData('selectbox-down-at-x').removeData('selectbox-down-at-y');
										hideMenus();
									}
								})
								.bind('mouseup.selectbox', function(event) {
									if( event.screenX === options.data('selectbox-down-at-x') && event.screenY === options.data('selectbox-down-at-y') ) {
										return;
									} else {
										options.removeData('selectbox-down-at-x').removeData('selectbox-down-at-y');
									}
									selectOption(select, $(this).parent());
									hideMenus();
								}).bind('mouseover.selectbox', function() {
									addHover(select, $(this).parent());
								})
								.bind('mouseout.selectbox', function() {
									removeHover(select, $(this).parent());
								});
						
						// Inherit classes for dropdown menu
						var classes = select.attr('class') || '';
						if( classes !== '' ) {
							classes = classes.split(' ');
							for ( var i=0; i<classes.length; i++) { 
								options.addClass(classes[i] + '-selectbox-dropdown-menu');
							}
						}

						disableSelection(options);

						return options;

				}

			};
			
			
			var getLabelClass = function(select) {
				var selected = $(select).find('OPTION:selected');
				return ('selectbox-label ' + (selected.attr('class') || '')).replace(/\s+$/, '');
			};
			
			
			var getLabelText = function(select) {
				var selected = $(select).find('OPTION:selected');
				return selected.text() || '\u00A0';
			};
			
			
			var setLabel = function(select) {
				select = $(select);
				var control = select.data('selectbox-control');
				if( !control ) { return; }
				control.find('.selectbox-label').attr('class', getLabelClass(select)).text(getLabelText(select));
			};
			
			
			var destroy = function(select) {

				select = $(select);
				var control = select.data('selectbox-control');
				if( !control ) { return; }
				var options = control.data('selectbox-options');

				options.remove();
				control.remove();
				select
					.removeClass('selectbox')
					.removeData('selectbox-control').data('selectbox-control', null)
					.removeData('selectbox-settings').data('selectbox-settings', null)
					.show();

			};
			
			
			var refresh = function(select) {
				select = $(select);
				select.selectbox('options', select.html());
			};

			
			var showMenu = function(select) {

				select = $(select);
				var control = select.data('selectbox-control'),
					settings = select.data('selectbox-settings'),
					options = control.data('selectbox-options');
				if( control.hasClass('selectbox-disabled') ) { return false; }

				hideMenus();

				var borderBottomWidth = isNaN(control.css('borderBottomWidth')) ? 0 : parseInt(control.css('borderBottomWidth'), 10);
				
				// Menu position
				options
					.width(control.innerWidth())
					.css({
						top: control.offset().top + control.outerHeight() - borderBottomWidth,
						left: control.offset().left
					});
				
				if( select.triggerHandler('beforeopen') ) { return false; }
				var dispatchOpenEvent = function() {
					select.triggerHandler('open', { _selectbox: true });
				};
				
				// Show menu
				switch( settings.menuTransition ) {

					case 'fade':
						options.fadeIn(settings.menuSpeed, dispatchOpenEvent);
						break;

					case 'slide':
						options.slideDown(settings.menuSpeed, dispatchOpenEvent);
						break;

					default:
						options.show(settings.menuSpeed, dispatchOpenEvent);
						break;

				}
				
				if( !settings.menuSpeed ) { dispatchOpenEvent(); }
				
				// Center on selected option
				var li = options.find('.selectbox-selected:first');
				keepOptionInView(select, li, true);
				addHover(select, li);

				control.addClass('selectbox-menuShowing');

				$(document).bind('mousedown.selectbox', function(event) {
					if( $(event.target).parents().andSelf().hasClass('selectbox-options') ) { return; }
					hideMenus();
				});

			};


			var hideMenus = function() {

				if( $(".selectbox-dropdown-menu:visible").length === 0 ) { return; }
				$(document).unbind('mousedown.selectbox');

				$(".selectbox-dropdown-menu").each( function() {

					var options = $(this),
						select = options.data('selectbox-select'),
						control = select.data('selectbox-control'),
						settings = select.data('selectbox-settings');
					
					if( select.triggerHandler('beforeclose') ) { return false; }
					
					var dispatchCloseEvent = function() {
						select.triggerHandler('close', { _selectbox: true });
					};					
					
					switch( settings.menuTransition ) {

						case 'fade':
							options.fadeOut(settings.menuSpeed, dispatchCloseEvent);
							break;

						case 'slide':
							options.slideUp(settings.menuSpeed, dispatchCloseEvent);
							break;

						default:
							options.hide(settings.menuSpeed, dispatchCloseEvent);
							break;

					}
					
					if( !settings.menuSpeed ) { dispatchCloseEvent(); }
					
					control.removeClass('selectbox-menuShowing');

				});

			};


			var selectOption = function(select, li, event) {

				select = $(select);
				li = $(li);
				var control = select.data('selectbox-control');
					// var settings = select.data('selectbox-settings');

				if( control.hasClass('selectbox-disabled') ) { return false; }
				if( li.length === 0 || li.hasClass('selectbox-disabled') ) { return false; }

				if( select.attr('multiple') ) {

					// If event.shiftKey is true, this will select all options between li and the last li selected
					if( event.shiftKey && control.data('selectbox-last-selected') ) {

						li.toggleClass('selectbox-selected');

						var affectedOptions;
						if( li.index() > control.data('selectbox-last-selected').index() ) {
							affectedOptions = li.siblings().slice(control.data('selectbox-last-selected').index(), li.index());
						} else {
							affectedOptions = li.siblings().slice(li.index(), control.data('selectbox-last-selected').index());
						}

						affectedOptions = affectedOptions.not('.selectbox-optgroup, .selectbox-disabled');

						if( li.hasClass('selectbox-selected') ) {
							affectedOptions.addClass('selectbox-selected');
						} else {
							affectedOptions.removeClass('selectbox-selected');
						}

					} else if( (isMac && event.metaKey) || (!isMac && event.ctrlKey) ) {
						li.toggleClass('selectbox-selected');
					} else {
						li.siblings().removeClass('selectbox-selected');
						li.addClass('selectbox-selected');
					}

				} else {
					li.siblings().removeClass('selectbox-selected');
					li.addClass('selectbox-selected');
				}

				if( control.hasClass('selectbox-dropdown') ) {
					control.find('.selectbox-label').text(li.text());
				}
				
				// Update original control's value
				var i = 0, selection = [];
				if( select.attr('multiple') ) {
					control.find('.selectbox-selected A').each( function() {
						selection[i++] = $(this).attr('rel');
					});
				} else {
					selection = li.find('A').attr('rel');
				}
				
				// Remember most recently selected item
				control.data('selectbox-last-selected', li);

				// Change callback
				if( select.val() !== selection ) {
					select.val(selection);
					setLabel(select);
					select.trigger('change');
				}

				return true;

			};


			var addHover = function(select, li) {
				select = $(select);
				li = $(li);
				var control = select.data('selectbox-control'),
					options = control.data('selectbox-options');

				options.find('.selectbox-hover').removeClass('selectbox-hover');
				li.addClass('selectbox-hover');
			};


			var removeHover = function(select, li) {
				select = $(select);
				li = $(li);
				var control = select.data('selectbox-control'),
					options = control.data('selectbox-options');
				options.find('.selectbox-hover').removeClass('selectbox-hover');
			};


			var keepOptionInView = function(select, li, center) {

				if( !li || li.length === 0 ) { return; }

				select = $(select);
				var control = select.data('selectbox-control'),
					options = control.data('selectbox-options'),
					scrollBox = control.hasClass('selectbox-dropdown') ? options : options.parent(),
					top = parseInt(li.offset().top - scrollBox.position().top, 10),
					bottom = parseInt(top + li.outerHeight(), 10);

				if( center ) {
					scrollBox.scrollTop( li.offset().top - scrollBox.offset().top + scrollBox.scrollTop() - (scrollBox.height() / 2) );
				} else {
					if( top < 0 ) {
						scrollBox.scrollTop( li.offset().top - scrollBox.offset().top + scrollBox.scrollTop() );
					}
					if( bottom > scrollBox.height() ) {
						scrollBox.scrollTop( (li.offset().top + li.outerHeight()) - scrollBox.offset().top + scrollBox.scrollTop() - scrollBox.height() );
					}
				}

			};


			var handleKeyDown = function(select, event) {

				//
				// Handles open/close and arrow key functionality
				//

				select = $(select);
				var control = select.data('selectbox-control'),
					options = control.data('selectbox-options'),
					settings = select.data('selectbox-settings'),
					totalOptions = 0,
					i = 0;

				if( control.hasClass('selectbox-disabled') ) { return; }

				switch( event.keyCode ) {

					case 8: // backspace
						event.preventDefault();
						typeSearch = '';
						break;

					case 9: // tab
					case 27: // esc
						hideMenus();
						removeHover(select);
						break;

					case 13: // enter
						if( control.hasClass('selectbox-menuShowing') ) {
							selectOption(select, options.find('LI.selectbox-hover:first'), event);
							if( control.hasClass('selectbox-dropdown') ) { hideMenus(); }
						} else {
							showMenu(select);
						}
						break;

					case 38: // up
					case 37: // left

						event.preventDefault();

						if( control.hasClass('selectbox-menuShowing') ) {

							var prev = options.find('.selectbox-hover').prev('LI');
							totalOptions = options.find('LI:not(.selectbox-optgroup)').length;
							i = 0;

							while( prev.length === 0 || prev.hasClass('selectbox-disabled') || prev.hasClass('selectbox-optgroup') ) {
								prev = prev.prev('LI');
								if( prev.length === 0 ) {
									if (settings.loopOptions) {
										prev = options.find('LI:last');
									} else {
										prev = options.find('LI:first');
									}
								}
								if( ++i >= totalOptions ) { break; }
							}

							addHover(select, prev);
							selectOption(select, prev, event);
							keepOptionInView(select, prev);

						} else {
							showMenu(select);
						}

						break;

					case 40: // down
					case 39: // right

						event.preventDefault();

						if( control.hasClass('selectbox-menuShowing') ) {

							var next = options.find('.selectbox-hover').next('LI');
							totalOptions = options.find('LI:not(.selectbox-optgroup)').length;
							i = 0;

							while( next.length === 0 || next.hasClass('selectbox-disabled') || next.hasClass('selectbox-optgroup') ) {
								next = next.next('LI');
								if( next.length === 0 ) {
									if (settings.loopOptions) {
										next = options.find('LI:first');
									} else {
										next = options.find('LI:last');
									}
								}
								if( ++i >= totalOptions ) { break; }
							}

							addHover(select, next);
							selectOption(select, next, event);
							keepOptionInView(select, next);

						} else {
							showMenu(select);
						}

						break;

				}

			};


			var handleKeyPress = function(select, event) {

				//
				// Handles type-to-find functionality
				//

				select = $(select);
				var control = select.data('selectbox-control'),
					options = control.data('selectbox-options');

				if( control.hasClass('selectbox-disabled') ) { return; }

				switch( event.keyCode ) {

					case 9: // tab
					case 27: // esc
					case 13: // enter
					case 38: // up
					case 37: // left
					case 40: // down
					case 39: // right
						// Don't interfere with the keydown event!
						break;

					default: // Type to find

						if( !control.hasClass('selectbox-menuShowing') ) { showMenu(select); }

						event.preventDefault();

						clearTimeout(typeTimer);
						typeSearch += String.fromCharCode(event.charCode || event.keyCode);

						options.find('A').each( function() {
							if( $(this).text().substr(0, typeSearch.length).toLowerCase() === typeSearch.toLowerCase() ) {
								addHover(select, $(this).parent());
								keepOptionInView(select, $(this).parent());
								return false;
							}
						});

						// Clear after a brief pause
						typeTimer = setTimeout( function() { typeSearch = ''; }, 1000);

						break;

				}

			};


			var enable = function(select) {
				select = $(select);
				select.attr('disabled', false);
				var control = select.data('selectbox-control');
				if( !control ) { return; }
				control.removeClass('selectbox-disabled');
			};


			var disable = function(select) {
				select = $(select);
				select.attr('disabled', true);
				var control = select.data('selectbox-control');
				if( !control ) { return; }
				control.addClass('selectbox-disabled');
			};


			var setValue = function(select, value) {
				select = $(select);
				select.val(value);
				value = select.val();
				var control = select.data('selectbox-control');
				if( !control ) { return; }
				var settings = select.data('selectbox-settings'),
					options = control.data('selectbox-options');

				// Update label
				setLabel(select);
				
				// Update control values
				options.find('.selectbox-selected').removeClass('selectbox-selected');
				options.find('A').each( function() {
					if( typeof(value) === 'object' ) {
						for( var i = 0; i < value.length; i++ ) {
							if( $(this).attr('rel') === value[i] ) {
								$(this).parent().addClass('selectbox-selected');
							}
						}
					} else {
						if( $(this).attr('rel') === value ) {
							$(this).parent().addClass('selectbox-selected');
						}
					}
				});

				if( settings.change ) { settings.change.call(select); }

			};


			var setOptions = function(select, options) {

				select = $(select);
				var control = select.data('selectbox-control');
					//var settings = select.data('selectbox-settings');

				switch( typeof(data) ) {

					case 'string':
						select.html(data);
						break;

					case 'object':
						select.html('');
						for(var i=0; i<data.length; i++) {
							if( data[i] === null ) { continue; }
							if( typeof(data[i]) === 'object' ) {
								var optgroup = $('<optgroup label="' + i + '" />');
								for(var j=0; j<data[i].length; j++) {
									optgroup.append('<option value="' + j + '">' + data[i][j] + '</option>');
								}
								select.append(optgroup);
							} else {
								var option = $('<option value="' + i + '">' + data[i] + '</option>');
								select.append(option);
							}
						}
						break;

				}

				if( !control ) { return; }

				// Remove old options
				control.data('selectbox-options').remove();

				// Generate new options
				var type = control.hasClass('selectbox-dropdown') ? 'dropdown' : 'inline';
				options = getOptions(select, type);
				control.data('selectbox-options', options);

				switch( type ) {
					case 'inline':
						control.append(options);
						break;
					case 'dropdown':
						// Update label
						setLabel(select);
						$("BODY").append(options);
						break;
				}

			};


			var disableSelection = function(selector) {
				$(selector)
					.css('MozUserSelect', 'none')
					.bind('selectstart', function(event) {
						event.preventDefault();
					});
			};

			var generateOptions = function(self, options){
				var li = $('<li />'),
				a = $('<a />');
				li.addClass( self.attr('class') );
				li.data( self.data() );
				a.attr('rel', self.val()).text( self.text() );
				li.append(a);
				if( self.attr('disabled') ) { li.addClass('selectbox-disabled'); }
				if( self.attr('selected') ) { li.addClass('selectbox-selected'); }
				options.append(li);
			};

			//
			// Public methods
			//

			switch( method ) {

				case 'control':
					return $(this).data('selectbox-control');

				case 'settings':
					if( !data ) { return $(this).data('selectbox-settings'); }
					$(this).each( function() {
						$(this).data('selectbox-settings', $.extend(true, $(this).data('selectbox-settings'), data));
					});
					break;

				case 'options':
					// Getter
					if( data === undefined ) { return $(this).data('selectbox-control').data('selectbox-options'); }
					// Setter
					$(this).each( function() {
						setOptions(this, data);
					});
					break;

				case 'value':
					// Empty string is a valid value
					if( data === undefined ) { return $(this).val(); }
					$(this).each( function() {
						setValue(this, data);
					});
					break;
				
				case 'refresh':
					$(this).each( function() {
						refresh(this);
					});
					break;

				case 'enable':
					$(this).each( function() {
						enable(this);
					});
					break;

				case 'disable':
					$(this).each( function() {
						disable(this);
					});
					break;

				case 'destroy':
					$(this).each( function() {
						destroy(this);
					});
					break;

				default:
					$(this).each( function() {
						init(this, method);
					});
					break;

			}

			return $(this);

		}

	});

})(jQuery);