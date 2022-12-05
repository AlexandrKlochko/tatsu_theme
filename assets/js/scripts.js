import smoothscroll from 'smoothscroll-polyfill';
import scriptLoader from './components/script-loader';
import {slideToggle} from 'slidetoggle';
import fadr from 'fadr';

'use strict';

const TATSU = {

    scrolled: window.scrollY,
    winWidth: window.innerWidth,
    winHeight: window.innerHeight,

    init() {

        smoothscroll.polyfill();

        TATSU.langSelector();
        TATSU.mobileMenu();
        TATSU.fixedMenu();
        TATSU.menuList();
        TATSU.galleryGrid();
        TATSU.cookieModal();
        TATSU.defaultInputs();
        TATSU.authModals();
        TATSU.formValidation();
        TATSU.defaultSelect();
        TATSU.couponCheckmark();
        TATSU.basketModal();
        TATSU.zipcodeChecker();
        TATSU.allergiesList();
        TATSU.menuSection();
        TATSU.accountDetails();
        TATSU.accountOrders();

        MODAL.init();

        // Init in th end
        TATSU.goTo();
        TATSU.imgToSVG();

        window.addEventListener('scroll', () => {
            TATSU.scrolled = window.scrollY;
            TATSU.lazyImages();
            TATSU.isInViewport();
        }, {passive: true});

        window.addEventListener('resize', () => {
            TATSU.winWidth = window.innerWidth;
            TATSU.winHeight = window.innerHeight;
        }, {passive: true})

        window.dispatchEvent(new Event('scroll'));
        window.dispatchEvent(new Event('resize'));
    },
    refreshCart(){
        jQuery.ajax({
            url: woocommerce_params.ajax_url,
            type: 'POST',
            data: { action: 'woocommerce_get_refreshed_fragments' },
            success: function( data ) {
                if ( data && data.fragments ) {
                    jQuery.each( data.fragments, function( key, value ) {
                        jQuery(key).replaceWith(value);
                    });

                    if ( typeof $supports_html5_storage !== 'undefined' && $supports_html5_storage && typeof wc_cart_fragments_params !== 'undefined' && wc_cart_fragments_params ) {
                        sessionStorage.setItem( "wc_fragments", JSON.stringify( data.fragments ) );
                        sessionStorage.setItem( "wc_cart_hash", data.cart_hash );
                    }
                    jQuery('body').trigger( 'wc_fragments_refreshed' );
                    jQuery('body').trigger('update_checkout');
                    jQuery('body').trigger('wc_update_cart');
                }
            }
        });
    },

    menuSection() {
        if (!document.querySelectorAll('.js__menu-section [data-toggle]').length) return;

        document.querySelectorAll('.js__menu-section [data-toggle]').forEach(btn => {
            const section = btn.closest('.js__menu-section');
            const links = section.querySelector('[data-links]');
            const overlay = document.querySelector('.js__overlay-footer');
            btn.addEventListener('click', function () {
                fadr('in', overlay, {
                    duration: 250,
                    complete: () => {
                        overlay.style.opacity = '1';
                    }
                });
                links.classList.add('is-opened');
            }, {passive: true});

            overlay.addEventListener('click', function () {
                links.classList.remove('is-opened');
                fadr('out', overlay, {
                    duration: 250,
                    complete: () => {
                        overlay.style.opacity = '';
                    }
                });
            }, {passive: true});
        });
    },

    allergiesList() {
        if (!document.querySelectorAll('.js__allergies-list').length) return;

        const holder = document.querySelector('.js__allergies-list');
        const toggle = holder.querySelector('[data-toggle]');
        const dropdown = holder.querySelector('[data-dropdown]');

        toggle.addEventListener('click', function () {
            slideToggle.slideToggle(dropdown, 150)
        }, {passive: true});
    },

    zipcodeChecker() {
        if (!document.querySelectorAll('.js__zipcode-checker').length) return;

        const holder = document.querySelector('.js__zipcode-checker');
        const form = holder.querySelector('form');
        const input = form.querySelector('[required]');

        input.addEventListener('input', function () {
            if (this.classList.contains('error')) this.classList.remove('error');
        });

        form.addEventListener('submit', function (e) {
            e.preventDefault();
            var $form = jQuery(this);
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: $form.attr('action'),
                data: $form.serialize(),
                success: function (data) {
                    if (data.totalrec >0) {
                        holder.querySelector('[data-result="yes"]').classList.add('is-opened');
                    } else {
                        holder.querySelector('[data-result="no"]').classList.add('is-opened');
                    }
                }
            });
            return false;
        });

        holder.querySelectorAll('[data-close-result]').forEach(closeBtn => {
            closeBtn.addEventListener('click', function (e) {
                e.preventDefault();
                this.closest('[data-result]').classList.remove('is-opened');
            });
        });

    },

    basketModal() {
        if (!document.querySelectorAll('.js__basket-link').length) return;

        const basketModal = document.querySelector('.js__modal-basket');
        const openBtn = document.querySelector('.js__basket-link');
        const overlay = document.querySelector('.js__overlay');

        jQuery(document).on('click','.js__basket-link',function(e){
            e.preventDefault();
            basketModal.classList.add('is-opened');
            fadr('in', overlay, {
                duration: 250,
                complete: () => {
                    overlay.style.opacity = '1';
                }
            });

        });
        jQuery(document).on('click', '.js__modal-basket-close', function (e) {
            e.preventDefault();
            basketModal.classList.remove('is-opened');
            fadr('out', overlay, {
                duration: 250,
                complete: () => {
                    overlay.style.opacity = '0';
                }
            });
        });

        jQuery(document).on('click', '.quantity-counter [data-minus]', function (e) {
            e.preventDefault();
            let quantity = jQuery(this).parent().find('input[name="quantity"]');
            let key = jQuery(this).parent().attr('data-item-key');
            if (jQuery(quantity).val() > 1) {
                let qty = +jQuery(quantity).val() - 1;
                jQuery(quantity).val(qty);
                updateQty(key,qty)
            }
        });

        jQuery(document).on('click', '.quantity-counter [data-plus]', function (e) {
            e.preventDefault();
            let quantity = jQuery(this).parent().find('input[name="quantity"]');
            let key = jQuery(this).parent().attr('data-item-key');
            let qty = +jQuery(quantity).val() + 1;
            jQuery(quantity).val(qty);
            updateQty(key,qty)
        });

        function updateQty(key,qty){
            jQuery.ajax({
                url: woocommerce_params.ajax_url,
                type: 'POST',
                data: { action: 'ajaxchange_quantity', cart_item_key: key, cart_item_qty:qty},
                success: function( data ) {
                    TATSU.refreshCart();
                }
            });
        }

        document.addEventListener('click', e => {
            if (e.target.matches('.js__overlay') && document.querySelectorAll('.js__modal-basket.is-opened').length) {
                basketModal.classList.remove('is-opened');
                fadr('out', overlay, {
                    duration: 250,
                    complete: () => {
                        overlay.style.opacity = '0';
                    }
                });
            }
        }, {passive: true});

    },

    couponCheckmark() {
        jQuery(document).on('change', '.js__toggle-coupon-input', function () {
            let block = jQuery(jQuery(this).data('toggle'));
            if (jQuery(this).is(':checked')) {
                jQuery(block).css('display', 'flex');
            } else {
                jQuery(block).hide();
            }
        });
        jQuery(document).on('click', 'button[name="apply_coupon"]', function (e) {
            e.preventDefault();
            let code = jQuery(this).parent().find('input[name="coupon_code"]').val();
            let security = jQuery(this).parent().find('input[name="security"]').val();
            jQuery.ajax({
                url: woocommerce_params.ajax_url,
                type: 'POST',
                data: { action: 'ajaxapply_coupon',code:code,security:security },
                success: function( data ) {
                    TATSU.refreshCart();
                }
            });
        });
        jQuery(document).on('click', '.woocommerce-remove-coupon', function (e) {
            e.preventDefault();
            let code = jQuery(this).data('coupon');
            jQuery.ajax({
                url: woocommerce_params.ajax_url,
                type: 'POST',
                data: { action: 'ajaxremove_coupon',code:code},
                success: function( data ) {
                    TATSU.refreshCart();
                }
            });
        });

    },

    defaultSelect() {
        if (!document.querySelectorAll('.js__default-select').length) return;

        document.querySelectorAll('.js__default-select').forEach(select => {
            const current = select.querySelector('[data-current]');
            const dropdown = select.querySelector('[data-dropdown]');
            const hiddenSelect = select.querySelector('select');

            current.addEventListener('click', function () {
                select.classList.toggle('is-opened');
            }, {passive: true});

            dropdown.querySelectorAll('li').forEach(li => {
                li.addEventListener('click', function () {
                    const currentValue = current.innerHTML;
                    current.innerHTML = this.innerHTML;
                    hiddenSelect.value = this.dataset.value;
                    //this.innerHTML = currentValue;
                    select.classList.remove('is-opened');
                    jQuery('[data-dropdown] li').show();
                    jQuery(this).hide();
                }, {passive: true});
            });

        });
    },

    formValidation() {
        if (!document.querySelectorAll('form[novalidate]').length) return;

        document.querySelectorAll('form[novalidate]').forEach(form => {

            form.querySelectorAll('[required]').forEach(input => {
                ['input', 'change'].forEach(eventName => {
                    input.addEventListener(eventName, function () {
                        input.classList.remove('error');
                        input.classList.remove('valid');
                        input.parentElement.classList.remove('error');
                        input.parentElement.classList.remove('valid');
                    });
                });
            })

            form.addEventListener('submit', function (e) {
                const inputs = form.querySelectorAll('[required]');

                for (let i = 0; i < inputs.length; i++) {
                    if (inputs[i].validity.valid) {
                        inputs[i].classList.remove('error');
                        inputs[i].classList.add('valid');
                        inputs[i].parentElement.classList.remove('error');
                        inputs[i].parentElement.classList.add('valid');
                    } else {
                        inputs[i].classList.remove('valid');
                        inputs[i].classList.add('error');
                        inputs[i].parentElement.classList.remove('valid');
                        inputs[i].parentElement.classList.add('error');
                    }
                }

                if (!form.checkValidity()) e.preventDefault();
            });
        });
    },

    authModals() {
        if (!document.querySelectorAll('.js__modal-auth-open').length) return;

        const overlay = document.querySelector('.js__overlay');

        document.querySelectorAll('.js__modal-auth-open').forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelectorAll('.js__modal-auth').forEach(item => {
                    item.style.display = 'none';
                    item.style.opacity = '0';
                });
                const modal = document.querySelector(this.getAttribute('href'));
                fadr('in', overlay, {
                    duration: 250,
                    complete: () => {
                        overlay.style.opacity = '1';
                    }
                });
                fadr('in', modal, {
                    duration: 250,
                    complete: () => {
                        modal.style.opacity = '1';
                    }
                });
                if (window.scrollY > 0) {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                }
            });
        });

        document.addEventListener('click', e => {
            if (e.target.matches('.js__overlay, .js__modal-auth-close')) {
                fadr('out', overlay, {
                    duration: 250,
                    complete: () => {
                        overlay.style.opacity = '';
                    }
                });
                document.querySelectorAll('.js__modal-auth').forEach(modal => {
                    if (modal.offsetParent !== null) {
                        fadr('out', modal, {
                            duration: 250,
                            complete: () => {
                                overlay.style.opacity = '';
                            }
                        });
                    }
                });
            }
        }, {passive: true});

        jQuery('form#login').submit(function (e) {
            e.preventDefault();
            var $form = jQuery(this);
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: $form.attr('action'),
                data: $form.serialize(),
                success: function (data) {
                    if (data.success == true) {
                        location.reload();
                    } else {
                        $form.find('.default-input').removeClass('valid').css('border', '1px solid red');
                        alert(data.error);
                    }
                }
            });
            return false;
        });
        jQuery('form#register').submit(function (e) {
            e.preventDefault();
            var $form = jQuery(this);
            jQuery.ajax({
                type: 'POST',
                dataType: 'json',
                url: $form.attr('action'),
                data: $form.serialize(),
                success: function (data) {
                    if (data.success == true) {
                        window.location.replace(data.redirect);
                    } else {
                        $form.find('.default-input').removeClass('valid').css('border', '1px solid red');
                        alert(data.error);
                    }
                }
            });
            return false;
        });
    },

    defaultInputs() {
        if (!document.querySelectorAll('.default-input').length) return;

        jQuery(document).on('input focus blur', '.default-input input', function () {
            if (this.value.length > 0) {
                jQuery(this).parent().addClass('is-focused');
                jQuery(this).addClass('is-focused');
            } else {
                jQuery(this).parent().addClass('is-focused');
                jQuery(this).addClass('is-focused');
            }
        });
        jQuery(document).on('input', '.default-input input', function () {
            if (this.classList.contains('js__only-num')) {
                this.value = this.value.replace(/[^0-9\.]+/g, '');
            }
        });
        document.querySelectorAll('.default-input').forEach(holder => {
            const input = holder.querySelector('input');
            if (input == null) {
                return;
            }
            if (input.value.length > 0) holder.classList.add('is-focused');
        });
    },

    cookieModal() {
        if (!document.querySelectorAll('.js__toggle-cookies-list').length) return;

        const toggle = document.querySelector('.js__toggle-cookies-list');
        const list = document.querySelector('.js__cookies-list');

        toggle.addEventListener('click', function () {
            if (this.textContent.trim() === this.dataset.openText.trim()) {
                this.textContent = this.dataset.closeText;
                list.style.display = 'block';
                if (this.closest('.cookie-modal').getBoundingClientRect().height + 200 > TATSU.winHeight) {
                    this.closest('.modal__inner').classList.add('with-scrollbar');
                }
            } else {
                this.textContent = this.dataset.openText;
                list.style.display = 'none';
            }
        }, {passive: true});

    },

    galleryGrid() {
        if (!document.querySelectorAll('.js__gallery-grid').length) return;

        const grid = document.querySelector('.js__gallery-grid');
        const loader = new scriptLoader();

        loader.load([
            'https://unpkg.com/imagesloaded@4.1.4/imagesloaded.pkgd.min.js',
            'https://unpkg.com/masonry-layout@4.2.2/dist/masonry.pkgd.min.js'
        ]).then(() => {
            setTimeout(() => {
                const masonry = new Masonry(grid, {
                    itemSelector: '.gallery-card',
                    columnWidth: '.gallery-card',
                    percentPosition: true,
                    gutter: 48
                });
                imagesLoaded(grid).on('progress', function () {
                    masonry.layout();
                });
            }, 0);
        });
    },

    menuList() {
        if (!document.querySelectorAll('.js__menu-list').length) return;

        const links = document.querySelectorAll('.js__menu-list a');

        links.forEach(link => {
            link.addEventListener('click', function () {
                links.forEach(link => link.classList.remove('is-active'));
                this.classList.add('is-active');
            });
        });

        window.addEventListener('scroll', () => {
            document.querySelectorAll('[id]').forEach(section => {
                if (window.scrollY + 120 >= section.getBoundingClientRect().top + window.scrollY) {
                    for (let i = 0; i < links.length; i++) {
                        if (links[i].getAttribute('href') === `#${section.id}`) {
                            links.forEach(link => link.classList.remove('is-active'));
                            links[i].classList.add('is-active');
                            break;
                        }
                    }
                }
            });
        }, {passive: true});
    },

    fixedMenu() {
        if (!document.querySelectorAll('.js__header').length) return;

        let c, currentScrollTop = 0,
            header = document.querySelector('.js__header'),
            menu = document.querySelector('.js__menu-list');

        window.addEventListener('scroll', () => {
            const a = window.scrollY;
            const b = header.getBoundingClientRect().height;

            currentScrollTop = a;

            if (c < currentScrollTop && a > b + b) {
                header.classList.add('is-scrolled');
                if (menu) menu.classList.add('is-scrolled');
            } else if (c > currentScrollTop && !(a <= b)) {
                header.classList.remove('is-scrolled');
                if (menu) menu.classList.remove('is-scrolled');
            }

            c = currentScrollTop;

        }, {passive: true});
    },

    mobileMenu() {
        if (!document.querySelectorAll('.js__toggle-menu').length) return;

        const overlay = document.querySelector('.js__overlay-footer');

        document.querySelectorAll('.js__toggle-menu').forEach(btn => {
            btn.addEventListener('click', function () {
                document.querySelector('.js__header-menu').classList.toggle('is-opened');
                if (overlay.getAttribute('style')) {
                    if (!overlay.getAttribute('style').includes('opacity: 1')) {
                        fadr('in', overlay, {
                            duration: 250,
                            complete: () => {
                                overlay.style.opacity = '1';
                            }
                        });
                    } else {
                        fadr('out', overlay, {
                            duration: 250,
                            complete: () => {
                                overlay.style.opacity = '';
                            }
                        });
                    }
                } else {
                    if (overlay.offsetParent === null) {
                        fadr('in', overlay, {
                            duration: 250,
                            complete: () => {
                                overlay.style.opacity = '1';
                            }
                        });
                    }
                }
            }, {
                passive: true
            });
        });
        overlay.addEventListener('click', function () {
            document.querySelector('.js__header-menu').classList.remove('is-opened');
        });
    },

    langSelector() {
        if (!document.querySelectorAll('.js__lang-selector').length) return;

        document.querySelector('.js__lang-selector [data-current-lang]').addEventListener('click', function () {
            this.closest('.js__lang-selector').classList.toggle('is-opened');
        }, {
            passive: true
        });
    },

    goTo() {
        document.querySelectorAll('a[href^="#"]:not([href="#"])').forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                if (document.querySelector(link.getAttribute('href'))) {
                    const destinationElement = document.querySelector(link.getAttribute('href'));
                    const offset = +link.dataset.offset || 0;
                    const top = destinationElement.getBoundingClientRect().top + window.scrollY - offset;
                    window.scrollTo({
                        top,
                        behavior: 'smooth'
                    });
                }
            });
        });
    },

    imgToSVG() {
        /* Replacing images to inline svg */
        if (!document.querySelectorAll('img.js__img-to-svg').length) return;

        document.querySelectorAll('img.js__img-to-svg').forEach(image => {
            fetch(image.getAttribute('src'))
                .then(res => res.text())
                .then(data => {
                    const parser = new DOMParser();
                    const svg = parser.parseFromString(data, 'image/svg+xml').querySelector('svg');

                    if (image.id) svg.id = image.id;
                    if (image.className) svg.classList = image.classList;

                    image.parentNode.replaceChild(svg, image);
                })
                .catch(error => {
                    console.log(error)
                });
        });

    },

    lazyImages() {
        /* Lazy Load Images */
        if (!document.querySelectorAll('[data-lazy-me]').length) return;

        document.querySelectorAll('[data-lazy-me]').forEach(img => {
            const source = img.getAttribute('data-lazy-me');
            const timeout = +img.getAttribute('data-lazy-timeout') || 0;
            const offset = img.offsetTop - 500;
            if (window.scrollY + window.innerHeight > offset) {
                if (img.tagName === 'IMG') {
                    setTimeout(() => {
                        img.setAttribute('src', source);
                    }, timeout);
                } else {
                    setTimeout(() => {
                        img.style.backgroundImage = `url(${source})`;
                    }, timeout);
                }
            }
        });

    },

    isInViewport() {
        if (!document.querySelectorAll('[data-check-position]').length) return;

        document.querySelectorAll('[data-check-position]').forEach(item => {
            const offset = item.getBoundingClientRect().top + window.scrollY;
            if (window.scrollY + window.innerHeight > offset) {
                item.classList.add('is-in-view');
            } else {
                item.classList.remove('is-in-view');
            }
        });
    },

    accountDetails() {
        if (document.querySelector('.account-details')) {
            document.querySelector('.account-details').addEventListener('submit', function (e) {
                e.preventDefault();
                var $form = jQuery(this);
                jQuery.ajax({
                    url: $form.attr('action'),
                    data: $form.serialize(),
                    type: 'POST',
                    beforeSubmit: function () {
                        $form.find('button[type="submit"]').prop('disabled', true);
                    },
                    success: function (response) {
                        $form.find('button[type="submit"]').prop('disabled',false);
                    }
                });
            });
        }
    },

    accountOrders() {
        if (document.querySelector('.order-add')) {
            document.querySelector('.order-add').addEventListener('click', function (e) {
                e.preventDefault();
                var $form = jQuery(this).closest('form');
                jQuery.ajax({
                    url: $form.attr('action'),
                    data: $form.serialize(),
                    type: 'POST',
                    success: function (response) {
                        console.log(response.success);
                        if (response.success === true) {
                            var page = +jQuery($form).find("input[name='page']").val() + 1;
                            jQuery($form).find("input[name='page']").val(page);
                            jQuery('#orders-list').append(response.html);
                        } else {
                            jQuery($form).fadeOut('slow');
                        }
                    }
                });
            });
        }
    }

};

document.addEventListener('DOMContentLoaded', function () {
    TATSU.init();
});

const MODAL = {

    init() {
        document.querySelectorAll('.js__modal-open').forEach(btn => {
            btn.addEventListener('click', function () {
                MODAL.open(this.getAttribute('href'));
            });
        });
        document.querySelectorAll('.js__modal-close').forEach(btn => {
            btn.addEventListener('click', function () {
                MODAL.close();
            });
        });

        document.addEventListener('click', e => {
            if (e.target.matches('.modal__inner')) {
                MODAL.close();
            }
        }, {passive: true});

        document.addEventListener('keyup', e => {
            if (e.key === 'Escape' && document.querySelectorAll('.js__modal.is-opened').length) {
                MODAL.close();
            }
        }, {passive: true});
        document.querySelector('#modal-cookie-form').addEventListener('submit', function (e) {
            e.preventDefault();
            var $form = jQuery(this);
            jQuery.ajax({
                url: $form.attr('action'),
                data: $form.serialize(),
                type: 'POST',
                success: function (response) {
                    MODAL.close();
                }
            });
        });
        var match = document.cookie.match(new RegExp('(^| )accept_cookie=([^;]+)'));
        if (!match) {
            MODAL.open('#modal-cookie');
        }
    },

    open(id) {
        MODAL.close('', () => {
            const modal = document.querySelector(`${id}`);
            modal.style.display = 'block';
            setTimeout(() => {
                modal.classList.add('is-opened');
            }, 300);
        });
    },

    close(id, callback) {
        if (id) {
            const modal = document.querySelector(`${id}`);
            modal.classList.remove('is-opened');
            setTimeout(() => {
                modal.style.display = 'none';
            }, 300);
        } else {
            document.querySelectorAll('.js__modal').forEach(modal => {
                modal.classList.remove('is-opened');
                setTimeout(() => {
                    modal.style.display = 'none';
                }, 300);
            });
        }
        setTimeout(() => {
            if (callback) callback();
        }, 300);
    }

};

jQuery(document).ready(function () {
    //custom button for homepage
    jQuery(".share-btn").click(function (e) {
        jQuery('.networks-5').not(jQuery(this).next(".networks-5")).each(function () {
            jQuery(this).removeClass("active");
        });

        jQuery(this).next(".networks-5").toggleClass("active");
    });
    jQuery(document).on('change','#ship-to-same-address-checkbox',function(){
        jQuery('.woocommerce-billing-fields').fadeToggle();
    });
    jQuery(document).on('change','input[name="billing_same"]',function(){
        jQuery('.billing-fieldset').fadeToggle();
    });
    jQuery(document).on('click','.delivery-info .js__default-select ul li',function(){
        jQuery.ajax({
            url: woocommerce_params.ajax_url,
            type: 'POST',
            data: { action: 'change_delivery_place',delivery_place:jQuery('select[name="delivery_place"]').val() },
            success: function( data ) {
                if(data.success == true){
                    jQuery('.delivery-info ul.time-picker').replaceWith(data.timepicker);
                    console.log(data.data);
                    if(!jQuery.isEmptyObject(data.data)){
                        jQuery.each(data.data,function (key , val){
                            jQuery('input[name="'+key+'"]').val(val).trigger('input');
                        });
                        jQuery('.woocommerce-shipping-fields fieldset.shipping-address-data').fadeOut();
                        jQuery('.woocommerce-billing-section').fadeOut();
                    }else{
                        jQuery('.woocommerce-shipping-fields fieldset.shipping-address-data').fadeIn();
                        jQuery('.woocommerce-billing-section').fadeIn();
                    }
                }
            }
        });
    });
    jQuery(document).on('click','.woocommerce-checkout .step-proceed',function(e){
        e.preventDefault();
        var $form = jQuery(this).closest('form');
        const inputs = $form.find('[required]');

        for (let i = 0; i < inputs.length; i++) {
            if (inputs[i].validity.valid) {
                inputs[i].classList.remove('error');
                inputs[i].classList.add('valid');
                inputs[i].parentElement.classList.remove('error');
                inputs[i].parentElement.classList.add('valid');
            } else {
                inputs[i].classList.remove('valid');
                inputs[i].classList.add('error');
                inputs[i].parentElement.classList.remove('valid');
                inputs[i].parentElement.classList.add('error');
            }
        }
        if (!$form[0].checkValidity()) {
            return false;
        }
        jQuery('.woocommerce-checkout li.step-li').toggleClass('is-current');
        jQuery('.woocommerce-checkout div.steps').fadeToggle();
    });
    // jQuery('.download_menu').click(function(e) {
    //     e.preventDefault();
    //     MODAL.open('#modal-menu');
    // });
    jQuery('.allergies_menu').click(function(e) {
        e.preventDefault();
        MODAL.open('#modal-allergies');
    });
    jQuery(".restaurants-template-default .owl-carousel").owlCarousel({
        items: 1,
        singleItem: true,
        itemsScaleUp : false,
        slideSpeed: 500,
        stopOnHover: true,
        touchDrag: false,
        pagination: false,
        navigation: true,
        navigationText: ['<','>'],
        afterAction: afterActionFunc,
    });
    jQuery(".home .owl-carousel").owlCarousel({
        items: 1,
        singleItem: true,
        itemsScaleUp : false,
        autoPlay: 6000,
        transitionStyle : "fade",
        stopOnHover: false,
        touchDrag: false,
        pagination: false,
        navigation: false,
        scrollPerPage:true,
        afterAction: afterActionFunc,
    });
    function afterActionFunc(){
        jQuery('.owl-carousel-counter .owl-carousel-current').html(+this.currentItem+ +1);
    }
    jQuery('.front-page-carousel-controls .owl-prev').on('click',function(){
        var owl = jQuery(".home .owl-carousel").data('owlCarousel');
        console.log(owl.currentItem);
        owl.prev();
    })
    jQuery('.front-page-carousel-controls .owl-next').on('click',function(){
        var owl = jQuery(".home .owl-carousel").data('owlCarousel');
        console.log(owl.currentItem);
        owl.next();
    })
});

