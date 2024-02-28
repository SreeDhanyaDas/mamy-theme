/**
 * cbpHorizontalMenu.js v1.0.0
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2013, Codrops
 * http://www.codrops.com
 */
var cbpHorizontalMenu = (function () {

    var $listItems = $('#cbp-hrmenu > ul > li'),
        $menuItems = $listItems.children('a[href^="#"]'),
        $body = $('body'),
        current = -1;

    var $listSubItems = $('.submenu_level2 > ul > li'),
        $menu_SubItems = $listSubItems.children('a[href^="#"]');

    function init() {
        $menuItems.on('click', open);
        $menu_SubItems.on('click', open_submenu);

        $listItems.on('click', function (event) { event.stopPropagation(); });
    }

    function open(event) {

        if (current !== -1) {
            $listItems.eq(current).removeClass('cbp-hropen');
            $('.submenu_list').hide();
        }

        var $item = $(event.currentTarget).parent('li'),
            idx = $item.index();

        console.log("idx" + idx);
        console.log("current" + current);
        if (current === idx) {
            $item.removeClass('cbp-hropen');
            current = -1;
        }
        else {
            $item.addClass('cbp-hropen');
            current = idx;
            $body.off('click').on('click', close);
        }

        return false;
    }

    function close(event) {
        $listItems.eq(current).removeClass('cbp-hropen');
        current = -1;
        $('.submenu_list').hide();
    }

    function open_submenu(event) {
        var $item = $(event.currentTarget).parent('li');
        var idx = $item.index();

        $listSubItems.removeClass('active'); // Remove active class from all submenu items
        $item.addClass('active'); // Add the active class to the clicked submenu item

        $('.cbp-hrmenu').show(); // Show the main menu

        // Show only the corresponding submenu
        $('.submenu_list').hide(); // Hide all submenu lists
        $('.submenu_list:eq(' + idx + ')').show(); // Show the submenu corresponding to the active item
    }

    return { init: init };

})();

