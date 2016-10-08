window.onload = (function() {
    return function() {
        sdcc.menuInit();
    }
})();

$('.has-child-menu > a').on('click', function(e){
    e.preventDefault();
    var $this = $(this);
    if (document.body.clientWidth < 768) {
        $this.siblings('nav').toggleClass('showing');
    } else {
        $this.siblings('nav').removeClass('showing')
    }
});

var sdcc = {
    openedHeight: '',
    menuOpen: true,
    mainMenu: null,
    menuInit: function() {
        this.mainMenu = document.getElementById('main_nav');
        this.mainMenu.style.opacity = 1;
        this.closeMenu();
    },
    closeMenu: function() {
        var height = this.mainMenu.clientHeight;
        this.openedHeight = height + 'px';

        this.mainMenu.style.height = '0';
        this.menuOpen = false;

        var menuLinks = document.getElementById('main_nav').children.length;
        var compHeight = 40 + (51 * menuLinks)

        if (height < compHeight) {
            this.openedHeight = compHeight + 'px';
        }
    },
    toggleMenu: function() {
        var body = document.getElementsByTagName('body')[0];

        if(this.menuOpen) {
            this.closeMenu();
            body.removeAClass('menu-open');
        } else {
            body.className += ' menu-open';
            this.mainMenu.style.height = 'auto';
            this.menuOpen = true;
        }
    }
};

HTMLElement.prototype.removeAClass = function(classToRemove) {
    var newClassName = "";
    var i;
    var classes = this.className.split(" ");
    for(i = 0; i < classes.length; i++) {
        if(classes[i] !== classToRemove) {
            newClassName += classes[i] + " ";
        }
    }
    this.className = newClassName.trim();
}

if (typeof String.prototype.trim != 'function') { // detect native implementation
    String.prototype.trim = function () {
        return this.replace(/^\s+/, '').replace(/\s+$/, '');
    };
}
