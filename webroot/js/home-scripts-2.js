(function(H) {
	H.className = '-js';
	// Opera 8.0+ (UA detection to detect Blink/v8-powered Opera)
	window.isOpera = !!window.opera
			|| navigator.userAgent.indexOf(' OPR/') >= 0;
	isOpera && H.classList.add('opera');
	// Firefox 1.0+
	window.isFirefox = typeof InstallTrigger !== 'undefined';
	isFirefox && H.classList.add('ff');
	// At least Safari 3+: "[object HTMLElementConstructor]"
	window.isSafari = Object.prototype.toString.call(window.HTMLElement)
			.indexOf('Constructor') > 0;
	isSafari && H.classList.add('safari');
	// At least IE6
	window.isIE = /* @cc_on!@ */false || !!document.documentMode;
	isIE && H.classList.add('ie');
	// Edge
	window.isEdge = !isIE && !!window.StyleMedia;
	isEdge && H.classList.add('edge');
	// Chrome 1+
	window.isChrome = !!window.chrome && !!window.chrome.webstore;
	isChrome && H.classList.add('chrome');
	// Blink
	window.isBlink = (isChrome || isOpera) && !!window.CSS;
	isBlink && H.classList.add('blink');
})(document.documentElement);

(function(window, document, undefined) {
	'use strict';

	var isOptiscrollCompatible = false;

	var forEach = Array.prototype.forEach;

	var main = document.getElementsByTagName('main')[0], updateSidebar, headerHeight;

	var _infos, _thumbnails, _infoSwitches, _hovers;

	function resetElementRefs() {
		_infos = null;
		_thumbnails = null;
		_infoSwitches = null;
		_hovers = null;
	}

	function getInfos() {
		if (!_infos)
			_infos = document.querySelectorAll('.tg-information');

		return _infos;
	}

	function getThumbnails() {
		if (!_thumbnails)
			_thumbnails = document.querySelectorAll('.tg-template-img');

		return _thumbnails;
	}

	function getInfoSwitches() {
		if (!_infoSwitches)
			_infoSwitches = document
					.querySelectorAll('.tg-hover > input[type=checkbox]');

		return _infoSwitches;
	}

	function getHovers() {
		if (!_hovers)
			_hovers = document.querySelectorAll('.tg-hover');

		return _hovers;
	}

	var errorObject = {
		value : null
	};

	function tryCatch(fn) {
		try {
			return fn();
		} catch (e) {
			errorObject.value = e;
			return errorObject;
		}
	}

	var wheelEvents = ('onwheel' in document || document.documentMode >= 9) ? [ 'wheel' ]
			: [ 'mousewheel', 'DomMouseScroll', 'MozMousePixelScroll' ];

	// console.log('wheel events:', wheelEvents)
	var getScrollTop, setScrollTop;

	if (isOptiscrollCompatible) {
		getScrollTop = function() {
			return app.scrollTop;
		}

		setScrollTop = function(scrollTop) {
			app.scrollTop = scrollTop;
		}
	} else {
		getScrollTop = function() {
			return (isBlink || isSafari || isEdge) ? document.body.scrollTop
					: document.documentElement.scrollTop;
		}

		setScrollTop = function(scrollTop) {
			if (isBlink || isSafari || isEdge) {
				document.body.scrollTop = scrollTop;
			} else {
				document.documentElement.scrollTop = scrollTop;
			}
		}
	}

	var onDomReady = function(callback) {
		document.readyState == 'interactive'
				|| document.readyState == 'complete' ? callback() : document
				.addEventListener('DOMContentLoaded', callback);
	};

	var sceneDuration = {
		value : 0
	};

	function setSceneDuration(duration) {
		sceneDuration.value = duration;
	}

	function updateSceneDuration() {
		var duration;
		duration = Math.max(0, main.clientHeight - window.innerHeight);
		setSceneDuration(duration);
	}

	onDomReady(function cacheHeaderHeight() {
		headerHeight = parseFloat(window.getComputedStyle(app)
				.getPropertyValue('padding-top'));
	})

	function initSceneDuration() {
		window.removeEventListener('load', initSceneDuration);
	}

	window.addEventListener('load', initSceneDuration);

	function InfosScrolling() {
		var infos, thumbnails, tgContainer = document
				.querySelector('.tg-container');

		function initInfosScrolling() {
			infos = getInfos();
			thumbnails = getThumbnails();

			forEach.call(thumbnails, listenToImageLoad);
		}

		function listenToImageLoad(image, i) {
			if (image.complete) {
				onThumbnailLoad();
			} else {
				image.addEventListener('load', onThumbnailLoad, false);
			}

			function onThumbnailLoad() {
				// Thumbnails are hidden by default via CSS,
				// So, unhide this thumbnail after it's image has completely
				// loaded
				// (avoids showing half-images while they are loading)
				showThumbnail(thumbnails[i].parentElement.parentElement);

				// Update scroll duration cache so sidebar will behave correctly
				// ASAP
				// (Sticky behavior is dependent on gallery height which is
				// affected by thumbnails)
				updateSceneDuration();
				// And update the sidebar accordingly so it doesn't break if a
				// user is a scroll junky
				// and scrolls impatiently on load. This function is created
				// asyncly so wait until it's defined
				// This all happens very quickly so it's ok if we miss out on a
				// couple of hits
				typeof updateSidebar == 'function' && updateSidebar();

				if (isOptiscrollCompatible)
					initScrollbarFor(infos[i]);
			}
		}

		function showThumbnail(thumbnail) {
			thumbnail.classList.remove('-hidden');
		}

		function initScrollbarFor(info) {
			var infoBox = info.firstElementChild;

			// Add Optiscroll classes
			info.classList.add('optiscroll');
			infoBox.classList.add('optiscroll-content');

			// Ensure we'll get a scrollbar even if text is short
			// (Otherwise optiscroll will not init)
			if (info.clientHeight >= infoBox.scrollHeight)
				infoBox.style.overflowY = 'scroll';

			accessInfoScroller(info, function() {
			});
		}

		function updateInfosScrollbars() {
			infos = getInfos();

			forEach.call(infos, resetInfoScrollbar);
		}

		function resetInfoScrollbar(info) {
			info.optiScroll && accessInfoScroller(info, function() {
				info.firstElementChild.style.width = null;
				info.optiScroll.update({
					reset : true
				});
			});
		}

		function accessInfoScroller(info, fn) {
			info.classList.add('-visible');
			fn();
			info.classList.remove('-visible');
		}

		function listenToSidebarToggles(e) {
			if (e.target == tgContainer)
				updateInfosScrollbars();
		}

		if (isOptiscrollCompatible) {

			tgContainer.removeEventListener('transitionend',
					listenToSidebarToggles);
			tgContainer.addEventListener('transitionend',
					listenToSidebarToggles, false);
		}

		return {
			init : initInfosScrolling,
			update : updateInfosScrollbars,
			accessInfoScroller : accessInfoScroller
		}
	}

	var infosScrolling = InfosScrolling();

	onDomReady(infosScrolling.init);

	function initThumbnailHovers() {
		var gallery = document.querySelector('.tg-gallery'), thumbnails = getThumbnails(), hovers = getHovers();

		function watchHoverOpacity(e) {
			var opacity = window.getComputedStyle(this).getPropertyValue(
					'opacity');

			if (opacity == 1) {
				this.classList.add('-active');
			} else {
				this.classList.remove('-visible');
			}
		}

		function hideHover(e) {
			var hover = getTgHover(this);

			if (hover) {
				// Make sure to hide the hover again after animation is
				// finished.
				// Also takes care of when the mouse was moved out of the
				// thumbnail
				// before the animation even started
				hover.classList.add('-visible');
			}
		}

		function getTgHover(el) {
			if (el.classList.contains('tg-thumbnail')) {
				return el.children[2];
			} else if (el.classList.contains('tg-hover')) {
				return el;
			}

			return false;
		}
	}

	onDomReady(initThumbnailHovers);

	function initInfoHovers() {
		var infoSwitches = getInfoSwitches(), infos = getInfos(), thumbnails = getThumbnails();

		// Reset (hide) info hover after mouseout
		forEach.call(thumbnails, function(image, i) {
			image.parentElement.addEventListener('mouseleave', function() {
				function hideInfoHover() {
					// Hide the info hover
					infoSwitches[i].checked = false;

					// Reset its scrollbar
					infos[i].optiScroll
							&& infosScrolling.accessInfoScroller(infos[i],
									function() {
										infos[i].optiScroll.scrollTo(false,
												'top', 0);
										infos[i].optiScroll.update();
									});

					image.parentElement.removeEventListener('transitionend',
							hideInfoHover);
				}

				image.parentElement.addEventListener('transitionend',
						hideInfoHover, false);
			});
		});
	}

	onDomReady(initInfoHovers);

	function initSidebarSwitch() {
		var sidebar, sbSwitch, sbToggle, sbCollapse, sbSwitchStroke;

		function init() {
			sidebar = document.getElementById('sidebar');
			sbSwitch = document.getElementById('sb-switch');
			sbToggle = document.getElementById('sb-toggle');
			sbCollapse = document.getElementById('sb-collapse');
			sbSwitchStroke = document.querySelector('.sbs-stroke');

			// init collapse side menu in mobile
			if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
				sbSwitch.checked = false;
				hideSidebar();
			}
			
			sidebar.removeEventListener('transitionend', sidebarAnimationEnded);
			sidebar.addEventListener('transitionend', sidebarAnimationEnded,
					false);

			sbSwitchStroke.removeEventListener('transitionend',
					toggleAnimationEnded);
			sbSwitchStroke.addEventListener('transitionend',
					toggleAnimationEnded, false);

			sbSwitch.addEventListener('click', function() {
				sidebar.classList.add('-transitioning');

				if (this.checked) {
					showSidebar();
					// cookie.set("sidebar-state",
					// main.classList.contains('-sidebar-open'), Infinity);
				} else {
					hideSidebar();
					// cookie.set("sidebar-state",
					// main.classList.contains('-sidebar-open'), Infinity);
				}
			});

			sbCollapse.addEventListener('click', function() {
				sbSwitch.click();
			});

			app.addEventListener('scroll', trackSBSwitch, false);
		}

		function showSidebar() {
			sbToggle.classList.add('-transitioning');

			main.classList.add('-sidebar-open');
			main.classList.remove('-sidebar-closed');

			getScrollTop() > headerHeight && scrollBodyToTop(true);
			trackSBSwitch(true);
		}

		function hideSidebar() {
			// Animate button
			sbSwitch.classList.remove('-hidden');
			sbToggle.classList.add('-transitioning');
			sbCollapse.classList.add('-hidden');

			// Animate sidebar
			main.classList.add('-sidebar-closed');
			main.classList.remove('-sidebar-open');

			// Update switch state
			trackSBSwitch(true);
		}

		function sidebarAnimationEnded() {
			sidebar.classList.remove('-transitioning');

			// The sidebar animation changes the height of the page,
			// so we should update the scene length for ScrollMagic
			// accordingly. (Instead of ScrollMagic polling the DOM constantly)
			updateSceneDuration();

			// Update switch state
			trackSBSwitch(true);
		}

		function toggleAnimationEnded() {
			sbToggle.classList.remove('-transitioning');

			if (sbSwitch.checked) {
				sbCollapse.classList.remove('-hidden');
				sbSwitch.classList.add('-hidden');
			}

			// Update switch state
			// trackSBSwitch(true);
		}

		function trackSBSwitch(force) {
			if (force !== true && sbSwitch.checked) {
				return;
			}

			var scrollTop = getScrollTop(), mainHeight = main.scrollHeight, bottomBoundary = 350, sbSwitchHeight = 65;

			if (scrollTop >= headerHeight) {
				if (scrollTop + sbSwitchHeight < mainHeight + headerHeight
						- bottomBoundary) {
					sbSwitch.classList.remove('-to-bottom');
					sbToggle.classList.remove('-to-bottom');
					sbSwitch.classList.add('-fixed');
					sbToggle.classList.add('-fixed');
				} else {
					sbSwitch.classList.add('-to-bottom');
					sbToggle.classList.add('-to-bottom');
				}
			} else {
				sbSwitch.classList.remove('-to-bottom');
				sbToggle.classList.remove('-to-bottom');
				sbSwitch.classList.remove('-fixed');
				sbToggle.classList.remove('-fixed');
			}
		}

		return {
			init : init,
			track : trackSBSwitch
		}
	}

	var sbSwitch = initSidebarSwitch();
	onDomReady(sbSwitch.init);

	isOptiscrollCompatible && onDomReady(function initPageScrollbar() {
		document.documentElement.classList.add('using-optiscroll');
		document.body.classList.add('optiscroll');
		app.classList.add('optiscroll-content');
	});

	onDomReady(function initSidebarStickyIsolatedScrolling() {
		// ----------------------------------*\
		// STICKY SCROLLING
		// ----------------------------------*/

		// Keep some styles for future reference
		var sidebar = document.getElementById('sidebar'), tgContainer = document
				.getElementById('gallery-container'), mainBottom = parseFloat(window
				.getComputedStyle(tgContainer).getPropertyValue(
						'padding-bottom')), sidebarWidth = parseFloat(window
				.getComputedStyle(sidebar).getPropertyValue('width'));

		var wrapper, fragment, scrollbar;

		var mode = 1;

		var matches = sidebar.matches ? 'matches' : 'msMatchesSelector';

		// Wrap sidebar in wrapper so we can
		// use it to make the sidebar sticky inside it
		wrapper = document.createElement('div');
		wrapper.className = 'sb-wrapper';
		main.insertBefore(wrapper, tgContainer.previousElementSibling);

		fragment = document.createDocumentFragment();
		fragment.appendChild(sidebar);

		wrapper.appendChild(fragment);

		// Track sidebar while scrolling
		(isOptiscrollCompatible ? app : window).addEventListener('scroll',
				trackSidebar, false);

		updateSidebar = trackSidebar;
		function trackSidebar() {
			var scrollTop = getScrollTop(), mainHeight = main.scrollHeight, scrollBottom = scrollTop
					+ window.innerHeight;

			if (scrollTop < headerHeight) {
				mode !== 1 && resetSidebarToTop();
			} else {
				if (scrollBottom < mainHeight + headerHeight) {
					mode !== 2 && fixSidebar();
				} else {
					mode !== 3 && alignSidebarWithFooter();
				}
			}
		}

		function resetSidebarToTop() {
			mode = 1;

			sidebar.classList.remove('-to-bottom');
			sidebar.classList.remove('-fixed');
			sidebar.style.top = '1px';

			// console.log('top');
		}

		function fixSidebar() {
			mode = 2;

			sidebar.classList.remove('-to-bottom');
			sidebar.classList.add('-fixed');
			sidebar.style.top = '0px';

			// console.log('fixed');
		}

		function alignSidebarWithFooter() {
			mode = 3;

			sidebar.classList.add('-to-bottom');
			sidebar.style.top = sceneDuration.value - 1 + 'px';

			// console.log('bottom');
		}

		// ----------------------------------*\
		// ISOLATED SCROLLING
		// ----------------------------------*/

		for (var i = wheelEvents.length; i;) {
			sidebar
					.addEventListener(
							wheelEvents[--i],
							function(e) {
								var delta = e.deltaY * -1, scrollTop = getScrollTop();

								// console.group()
								// console.log('delta:', delta)
								// console.log('scrollTop:', scrollTop)
								// console.log('sidebar, scrollTop:',
								// sidebar.scrollTop, 'scrollHeight:',
								// sidebar.scrollHeight, 'clientHeight:',
								// sidebar.clientHeight);
								// console.log('wrapper, offsetTop:',
								// sidebar.parentElement.offsetTop);
								// console.groupEnd();

								if (delta < 0
										&& sidebar.classList.contains('-fixed')
										&& !sidebar.classList
												.contains('-to-bottom')
										&& sidebar.scrollTop == (sidebar.scrollHeight - sidebar.clientHeight)
										&& scrollTop > sidebar.parentElement.offsetTop) {
									e.preventDefault();
								}
							}, false);
		}

		// ----------------------------------*\
		// OPTISCROLLER
		// ----------------------------------*/

		isOptiscrollCompatible && initSidebarOptiscroller();

		function initSidebarOptiscroller() {
			sidebar.classList.add('optiscroll-content');
			wrapper.classList.add('optiscroll');

		}
	});

	function scrollBodyToTop(shouldAnimate) {
		if (shouldAnimate) {
			animateToTop();
		} else {
			setScrollTop(0);
		}
	}

	function animateToTop() {
		var scrollTop = getScrollTop(), step = scrollTop / 12, time = Math
				.round(30 / scrollTop) + 10;

		setScrollTop(scrollTop - step);
		sbSwitch.track(true);

		if (scrollTop > 0) {
			setTimeout(animateToTop, time);
		}
	}
})(window, document);