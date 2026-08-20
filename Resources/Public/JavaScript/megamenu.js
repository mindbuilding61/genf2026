(function () {
    function isDesktop() {
        return window.matchMedia('(min-width: 992px)').matches;
    }

    function closeAll(nav) {
        nav.querySelectorAll('.nav-item.mega.is-open').forEach(function (item) {
            item.classList.remove('is-open');
            var toggle = item.querySelector(':scope > .nav-link');
            if (toggle) {
                toggle.setAttribute('aria-expanded', 'false');
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        var nav = document.querySelector('.navbar--megamenu');
        if (!nav) {
            return;
        }

        nav.querySelectorAll('.nav-item.mega > .nav-link').forEach(function (link) {
            link.addEventListener('click', function (event) {
                if (isDesktop()) {
                    return;
                }
                event.preventDefault();
                var item = link.parentElement;
                var open = item.classList.contains('is-open');
                closeAll(nav);
                if (!open) {
                    item.classList.add('is-open');
                    link.setAttribute('aria-expanded', 'true');
                }
            });
        });

        document.addEventListener('click', function (event) {
            if (!nav.contains(event.target)) {
                closeAll(nav);
            }
        });

        window.addEventListener('resize', function () {
            if (isDesktop()) {
                closeAll(nav);
            }
        });
    });
})();
