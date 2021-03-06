/**
 * File navigation.js.
 *
 * Handles toggling the account navigation menu for small screens and enables TAB key
 * also, navigation support for dropdown menus.
 */
( function( $ ) {
    var container, button, menuToggle, headerSearch, typeFilter, icon, menu, links, subMenus, i, len;

    container = document.getElementsByTagName( 'header' )[0];
    if ( ! container ) {
        return;
    }

    menuToggle = document.getElementById( 'menu-toggle' );
    if ( ! menuToggle ) {
        return;
    }

    headerSearch = document.getElementById( 'header-search' );
    if ( ! headerSearch ) {
        return;
    }

    typeFilter = headerSearch.getElementsByClassName( 'dropdown-toggle' )[0];
    if ( ! typeFilter ) {
        return;
    }

    icon = menuToggle.getElementsByTagName( 'i' )[0];
    if ( ! icon ) {
        return;
    }

    menu = container.getElementsByTagName( 'ul' )[0];

    // Hide menu toggle button if menu is empty and return early.
    if ( 'undefined' === typeof menu ) {
        menuToggle.style.display = 'none';
        return;
    }

    menu.setAttribute( 'aria-expanded', 'false' );
    if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
        menu.className += ' nav-menu';
    }

    menuToggle.onclick = function() {
        if ( -1 !== container.className.indexOf( 'toggled' ) ) {
            container.className = container.className.replace( ' toggled', '' );
            icon.className = icon.className.replace(' svg-menu_toggle-close', ' svg-menu_toggle-open')
            menuToggle.setAttribute( 'aria-expanded', 'false' );
            menu.setAttribute( 'aria-expanded', 'false' );
        } else {
            container.className += ' toggled';
            icon.className = icon.className.replace(' svg-menu_toggle-open', ' svg-menu_toggle-close')
            menuToggle.setAttribute( 'aria-expanded', 'true' );
            menu.setAttribute( 'aria-expanded', 'true' );
        }
    };

    typeFilter.onclick = function() {
        if ( -1 !== container.className.indexOf( 'type-filter-open' ) ) {
            container.className = container.className.replace( ' type-filter-open', '' );
        } else {
            container.className += ' type-filter-open';
        }
    };

    // Get all the link elements within the menu.
    links    = menu.getElementsByTagName( 'a' );
    subMenus = menu.getElementsByTagName( 'ul' );

    // Set menu items with submenus to aria-haspopup="true".
    for ( i = 0, len = subMenus.length; i < len; i++ ) {
        subMenus[i].parentNode.setAttribute( 'aria-haspopup', 'true' );
    }

    // Each time a menu link is focused or blurred, toggle focus.
    for ( i = 0, len = links.length; i < len; i++ ) {
        links[i].addEventListener( 'focus', toggleFocus, true );
        links[i].addEventListener( 'blur', toggleFocus, true );
    }

    /**
     * Sets or removes .focus class on an element.
     */
    function toggleFocus() {
        var self = this;

        // Move up through the ancestors of the current link until we hit .nav-menu.
        while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

            // On li elements toggle the class .focus.
            if ( 'li' === self.tagName.toLowerCase() ) {
                if ( -1 !== self.className.indexOf( 'focus' ) ) {
                    self.className = self.className.replace( ' focus', '' );
                } else {
                    self.className += ' focus';
                }
            }

            self = self.parentElement;
        }
    }

    function initMainNavigation( container ) {
        // Add dropdown toggle that display child menu items.
        container.find( '.menu-item-has-children > a , .page_item_has_children > a' ).after( '<button class="nav-dropdown-toggle" aria-expanded="false">' + screenReaderText.expand + '</button>' );

        // Toggle buttons and submenu items with active children menu items.
        // container.find( '.current-menu-ancestor > button' ).addClass( 'toggle-on' );
        // container.find( '.current-menu-ancestor > .sub-menu' ).addClass( 'toggled-on' );

        container.find( '.nav-dropdown-toggle' ).click( function( e ) {
            var _this = $( this );
            e.preventDefault();
            _this.toggleClass( 'toggle-on' );
            _this.next( '.children, .sub-menu' ).toggleClass( 'toggled-on' );
            _this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
            _this.html( _this.html() === screenReaderText.expand ? screenReaderText.collapse : screenReaderText.expand );
        } );
    }
    initMainNavigation( $( '.main-navigation' ) );

    // Re-initialize the main navigation when it is updated, persisting any existing submenu expanded states.
    $( document ).on( 'customize-preview-menu-refreshed', function( e, params ) {
        if ( 'primary' === params.wpNavMenuArgs.theme_location ) {
            initMainNavigation( params.newContainer );

            // Re-sync expanded states from oldContainer.
            params.oldContainer.find( '.nav-dropdown-toggle.toggle-on' ).each(function() {
                var containerId = $( this ).parent().prop( 'id' );
                $( params.newContainer ).find( '#' + containerId + ' > .nav-dropdown-toggle' ).triggerHandler( 'click' );
            });
        }
    });

    // Hide/show toggle button on scroll

    var position, direction, previous;

    $(window).scroll(function(){
        if( $(this).scrollTop() == 0 ) {
            $('.menu-toggle').removeClass('hovering');
        } else {
            if( $(this).scrollTop() >= position ){
                direction = 'down';
                if(direction !== previous){
                    $('.menu-toggle').addClass('off-screen hovering');

                    previous = direction;
                }
            } else {
                direction = 'up';
                if(direction !== previous){
                    $('.menu-toggle').removeClass('off-screen');

                    previous = direction;
                }
            }
            position = $(this).scrollTop();
        }
    });

    /**
     * Toggles `focus` class to allow submenu access on tablets.
     */
    /*( function( container ) {
     var touchStartFn, i,
     parentLink = container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

     if ( 'ontouchstart' in window ) {
     touchStartFn = function( e ) {
     var menuItem = this.parentNode, i;

     if ( ! menuItem.classList.contains( 'focus' ) ) {
     e.preventDefault();
     for ( i = 0; i < menuItem.parentNode.children.length; ++i ) {
     if ( menuItem === menuItem.parentNode.children[i] ) {
     continue;
     }
     menuItem.parentNode.children[i].classList.remove( 'focus' );
     }
     menuItem.classList.add( 'focus' );
     } else {
     menuItem.classList.remove( 'focus' );
     }
     };

     for ( i = 0; i < parentLink.length; ++i ) {
     parentLink[i].addEventListener( 'touchstart', touchStartFn, false );
     }
     }
     }( container ) ); */
} )( jQuery );