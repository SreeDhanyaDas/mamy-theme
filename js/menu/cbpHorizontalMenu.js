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
    var $listItems = $('#cbp-hrmenu > ul > li');
    var $menuItems = $listItems.children('a[href^="#"]');
    var $body = $('body');
    var current = -1;

    var $listSubItems = $('.submenu_level2 > ul > li');
    var $menu_SubItems = $listSubItems.children('a[href^="#"]');

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

        var $item = $(event.currentTarget).parent('li');
        var idx = $item.index();

        // console.log("idx" + idx);
        // console.log("current" + current);
        if (current === idx) {
            $item.removeClass('cbp-hropen');
            current = -1;
        } else {
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
        console.log(event);
    
        var $item = $(event.currentTarget).parent('li');
        var idx = $item.index();
    
        console.log('id', idx);
        console.log('item', $item);
    
        var $submenuList = $item.find('.cbp-hrsub.sub-little.submenu_list');
        console.log($submenuList);
    
        $item.siblings().removeClass('active');
        $item.addClass('active');
    
        // Hide all submenu lists within siblings
        $item.siblings().find('.cbp-hrsub.sub-little.submenu_list').hide();
    
        // Show the submenu corresponding to the clicked main menu item
        $submenuList.show();
    }
    

    return { init: init };
})();




