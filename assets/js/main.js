/**
 * Template Name: BizLand - v3.8.1
 * Template URL: https://bootstrapmade.com/bizland-bootstrap-business-template/
 * Author: BootstrapMade.com
 * License: https://bootstrapmade.com/license/
 */
(function () {
	"use strict";

    const params = new URLSearchParams(window.location.search);
    let el = $(`a[href*="id=${params.get("id")}"]`);    
    function activeMenu(el) {
        $(el).addClass("active");
        let parent = $(el).closest("ul").siblings('a');
        if (parent.length) {
            $(parent).addClass("active");
            activeMenu(parent);
        }
    }
    activeMenu(el);   
    
    $(document).ready(function(){
        var currentUrl = window.location.href;
        var searchStringPyd = 'pyd'; 
        var searchStringAbout = 'about'; 
        var searchStringAnnouncements = 'announcements'; 
        var searchStringServices = 'services'; 
        if (currentUrl.indexOf(searchStringPyd) !== -1) {
            $(document).find(`a[href*="id=74"]`).addClass('active');
        }
        if (currentUrl.indexOf(searchStringAbout) !== -1) {
            $(document).find(`a[href*="about"]`).addClass('active');
        }
        if (currentUrl.indexOf(searchStringAnnouncements) !== -1) {
            $(document).find(`a[href*="id=67"]`).addClass('active');
        }
        if (currentUrl.indexOf(searchStringServices) !== -1) {
            $(document).find(`a[href*="services"]`).addClass('active');
        }
    });
    
	$.datetimepicker.setLocale('hy');
	$('.datetimepicker').datetimepicker({
		format: 'Y-m-d H:i:s',
	});
	$('.datepicker').datetimepicker({
		timepicker: false,
		format: 'Y-m-d'
	});

	$.ajax({
		url: BASE_URL + 'get_all_categories',
		success: function (result) {
			$('.select2ToTree').prepend('<option value="0" class="11 non-left">' + sections + '</option>')
			$('.select2ToTree').each(function () {
				$(this).select2ToTree({
					treeData: {
						dataArr: JSON.parse(result)
					}
				});
			})
		}
	})

	/**
	 * Easy selector helper function
	 */
	const select = (el, all = false) => {
		el = el.trim()
		if (all) {
			return [...document.querySelectorAll(el)]
		} else {
			return document.querySelector(el)
		}
	}

	/**
	 * Easy event listener function
	 */
	const on = (type, el, listener, all = false) => {
		let selectEl = select(el, all)
		if (selectEl) {
			if (all) {
				selectEl.forEach(e => e.addEventListener(type, listener))
			} else {
				selectEl.addEventListener(type, listener)
			}
		}
	}

	/**
	 * Easy on scroll event listener 
	 */
	const onscroll = (el, listener) => {
		el.addEventListener('scroll', listener)
	}

	/**
	 * Navbar links active state on scroll
	 */
	let navbarlinks = select('#navbar .scrollto', true)
	const navbarlinksActive = () => {
		let position = window.scrollY + 200
		navbarlinks.forEach(navbarlink => {
			if (!navbarlink.hash) return
			let section = select(navbarlink.hash)
			if (!section) return
			if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
				navbarlink.classList.add('active')
			} else {
				navbarlink.classList.remove('active')
			}
		})
	}
	window.addEventListener('load', navbarlinksActive)
	onscroll(document, navbarlinksActive)

	/**
	 * Scrolls to an element with header offset
	 */
	const scrollto = (el) => {
		let header = select('#header')
		let offset = header.offsetHeight

		if (!header.classList.contains('header-scrolled')) {
			offset -= 16
		}

		let elementPos = select(el).offsetTop
		window.scrollTo({
			top: elementPos - offset,
			behavior: 'smooth'
		})
	}

	/**
	 * Header fixed top on scroll
	 */
	let selectHeader = select('#header')
	if (selectHeader) {
		let headerOffset = selectHeader.offsetTop
		let nextElement = selectHeader.nextElementSibling
		const headerFixed = () => {
			if ((headerOffset - window.scrollY) <= 0) {
				selectHeader.classList.add('fixed-top')
				nextElement.classList.add('scrolled-offset')
			} else {
				selectHeader.classList.remove('fixed-top')
				nextElement.classList.remove('scrolled-offset')
			}
		}
		window.addEventListener('load', headerFixed)
		onscroll(document, headerFixed)
	}

	/**
	 * Back to top button
	 */
	let backtotop = select('.back-to-top')
	if (backtotop) {
		const toggleBacktotop = () => {
			if (window.scrollY > 100) {
				backtotop.classList.add('active')
			} else {
				backtotop.classList.remove('active')
			}
		}
		window.addEventListener('load', toggleBacktotop)
		onscroll(document, toggleBacktotop)
    }
    on('click', '.search_icon', function (e) {
        $('.search_bar').fadeToggle();
        $("i", this).toggleClass("bi bi-x");
    });
	// on('click', '.openSearchModal', function (e) {
	// 	$(".search-panel").addClass("search-panel-open")
	// })
	on('click', '.openSearchModalMobile', function (e) {
		$(".search-panel").addClass("search-panel-open")
	})
	on('click', '.closeSearchModal', function (e) {
		$(".search-panel").removeClass("search-panel-open")
	})
    on('click', '.openCalendarModal', function (e) {
        scrollto('header')
		$(".calendar-panel").addClass("calendar-panel-open")
		$("body").addClass('overflow-hidden')
		$('#calendar-open').show()
		let calendarEl = document.getElementById('calendar');
		let events = [];
		let locale = 'en'
		let DAY_NAMES = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
		let MONTH_NAMES = ['Հունվար', 'Փետրվար', 'Մարտ', 'Ապրիլ', 'Մայիս', 'Հունիս', 'Հուլիս', 'Օգոստոս', 'Սեպտեմբեր', 'Հոկտեմբեր', 'Նոյեմբեր', 'Դեկտեմբեր'];
		if (LANG == 'am') {
			locale = 'hy-am';
			DAY_NAMES = ['Կիր', 'Երկ', 'Երք', 'Չոր', 'Հնգ', 'Ուրբ', 'Շաբ'];
		}
		get_ajax(BASE_URL + 'getNews', null, function (result) {
			Array.prototype.forEach.call(result.data, el => {
				events.push({
					title: el.name,
					url: BASE_URL + 'article?' + el.name + '&i=' + el.id,
					start: moment(el.date).format('YYYY-MM-DD')
				})
            });
            console.log(events);
			let calendar = new FullCalendar.Calendar(calendarEl, {
				headerToolbar: {
					left: 'prev,next today',
					center: 'title',
					right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                },
                initialDate: events[0].start,
				locale: locale,
				dayHeaderContent: function(arg) {
					return DAY_NAMES[arg.date.getDay()]
				},
				buttonIcons: false, // show the prev/next text
				weekNumbers: true,
				navLinks: true, // can click day/week names to navigate views
				editable: false,
				dayMaxEvents: true, // allow "more" link when too many events
                events: events,
				eventClick: function (info) {
					if (info.event.url) {
						info.jsEvent.preventDefault(); // don't let the browser navigate
						window.open(info.event.url, "_blank");
						return false;
					}
				},
				datesSet: function (info) {
					let title = LANG == 'am' ? MONTH_NAMES[info.view.currentStart.getMonth()] +  ' ' + info.view.currentStart.getFullYear() : info.view.title;
					$('.fc-toolbar-title').text(title);
				}
			});
			calendar.render();
		});
	})
	on('click', '.closeCalendarModal', function (e) {
		$(".calendar-panel").removeClass("calendar-panel-open")
		$("body").removeClass('overflow-hidden')
		$('#calendar-open').hide()
	})
	on("click", 'html', function (event) {
		if ($(event.target).closest(".openCalendarModal").length === 0 && $(event.target).closest(".calendar-panel-open").length === 0) {
			$(".calendar-panel").removeClass("calendar-panel-open")
			$("body").removeClass('overflow-hidden')
			$('#calendar-open').hide()
		}
	})
	/**
	 * Mobile nav toggle
	 */
	on('click', '.mobile-nav-toggle', function (e) {
		select('#navbar').classList.toggle('navbar-mobile')
		this.classList.toggle('bi-list')
		this.classList.toggle('bi-x')
	})

	/**
	 * Mobile nav dropdowns activate
	 */
	on('click', '.navbar .dropdown > a', function (e) {
		if (select('#navbar').classList.contains('navbar-mobile')) {
			e.preventDefault()
			this.nextElementSibling.classList.toggle('dropdown-active')
		}
	}, true)

	/**
	 * Scrool with ofset on links with a class name .scrollto
	 */
	on('click', '.scrollto', function (e) {
		if (select(this.hash)) {
			e.preventDefault()

			let navbar = select('#navbar')
			if (navbar.classList.contains('navbar-mobile')) {
				navbar.classList.remove('navbar-mobile')
				let navbarToggle = select('.mobile-nav-toggle')
				navbarToggle.classList.toggle('bi-list')
				navbarToggle.classList.toggle('bi-x')
			}
			scrollto(this.hash)
		}
	}, true)

	/**
	 * Scroll with ofset on page load with hash links in the url
	 */
	window.addEventListener('load', () => {
		if (window.location.hash) {
			if (select(window.location.hash)) {
				scrollto(window.location.hash)
			}
		}
	});

	/**
	 * Preloader
	 */
	let preloader = select('#preloader');
	if (preloader) {
		window.addEventListener('load', () => {
			$('#preloader').hide()
		});
	}

	/**
	 * Initiate glightbox
	 */
	const glightbox = GLightbox({
		selector: '.glightbox'
	});

	/**
	 * Skills animation
	 */
	let skilsContent = select('.skills-content');
	if (skilsContent) {
		new Waypoint({
			element: skilsContent,
			offset: '80%',
			handler: function (direction) {
				let progress = select('.progress .progress-bar', true);
				progress.forEach((el) => {
					el.style.width = el.getAttribute('aria-valuenow') + '%'
				});
			}
		})
	}

	/**
	 * Testimonials slider
	 */
	new Swiper('.testimonials-slider', {
		speed: 600,
		loop: true,
		autoplay: {
			delay: 5000,
			disableOnInteraction: false
		},
		slidesPerView: 'auto',
		pagination: {
			el: '.swiper-pagination',
			type: 'bullets',
			clickable: true
		}
	});

	/**
	 * Porfolio isotope and filter
	 */
	window.addEventListener('load', () => {
		let multimediaContainer = select('.multimedia-container');
		if (multimediaContainer) {
			let multimediaIsotope = new Isotope(multimediaContainer, {
				itemSelector: '.multimedia-item'
			});

			let multimediaFilters = select('#multimedia-flters li', true);

			on('click', '#multimedia-flters li', function (e) {
				e.preventDefault();
				multimediaFilters.forEach(function (el) {
					el.classList.remove('filter-active');
				});
				this.classList.add('filter-active');

				multimediaIsotope.arrange({
					filter: this.getAttribute('data-filter')
				});
				multimediaIsotope.on('arrangeComplete', function () {
					AOS.refresh()
				});
			}, true);
		}

	});

	/**
	 * Initiate multimedia lightbox 
	 */
	const multimediaLightbox = GLightbox({
		selector: '.multimedia-lightbox'
	});

	/**
	 * multimedia details slider
	 */
	new Swiper('.multimedia-details-slider', {
		speed: 400,
		loop: true,
		autoplay: {
			delay: 5000,
			disableOnInteraction: false
		},
		pagination: {
			el: '.swiper-pagination',
			type: 'bullets',
			clickable: true
		}
	});

	/**
	 * Animation on scroll
	 */
	window.addEventListener('load', () => {
		AOS.init({
			duration: 1000,
			easing: 'ease-in-out',
			once: true,
			mirror: false
		})
	});

	/**
	 * Initiate Pure Counter 
	 */
	new PureCounter();
	
	
	// $(function () {
		$(document).ajaxError(function (e, j) {
			console.log(e);
			console.log(j);
			
            if (j.status == 0) {
                alert("Please check your internet connection!");
            }
            $("#spinner").hide();
        });
    // });

    $('[data-fancybox="images"]').fancybox({
        buttons: [
            'slideShow',
            'share',
            'zoom',
            'fullScreen',
            'close'
        ],
        thumbs: {
            autoStart: true
        }
    });
    // $(document).on("click", ".mainnews p img", function () {
    //     $(this).cpLightimg();
    // });
})()