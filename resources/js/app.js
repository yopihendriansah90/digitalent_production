import './bootstrap';

const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
const mobileMenuClose = document.getElementById('mobile-menu-close');
const mobileDrawer = document.getElementById('mobile-drawer');
const mobileDrawerBackdrop = document.getElementById('mobile-drawer-backdrop');
const mobileDrawerPanel = document.getElementById('mobile-drawer-panel');
const desktopTopbar = document.getElementById('desktop-topbar');
const headerSpacer = document.getElementById('header-spacer');

const mobileDrawerLinks = mobileDrawer ? mobileDrawer.querySelectorAll('a') : [];

function openMobileDrawer() {
    if (!mobileDrawer || !mobileDrawerBackdrop || !mobileDrawerPanel || !mobileMenuToggle) return;
    mobileDrawer.classList.remove('pointer-events-none');
    mobileDrawer.setAttribute('aria-hidden', 'false');
    mobileDrawerBackdrop.classList.remove('opacity-0');
    mobileDrawerPanel.classList.remove('translate-x-full');
    mobileMenuToggle.setAttribute('aria-expanded', 'true');
    document.body.classList.add('overflow-hidden');
}

function closeMobileDrawer() {
    if (!mobileDrawer || !mobileDrawerBackdrop || !mobileDrawerPanel || !mobileMenuToggle) return;
    mobileDrawerBackdrop.classList.add('opacity-0');
    mobileDrawerPanel.classList.add('translate-x-full');
    mobileDrawer.setAttribute('aria-hidden', 'true');
    mobileMenuToggle.setAttribute('aria-expanded', 'false');
    document.body.classList.remove('overflow-hidden');

    window.setTimeout(() => {
        if (mobileDrawer.getAttribute('aria-hidden') === 'true') {
            mobileDrawer.classList.add('pointer-events-none');
        }
    }, 300);
}

function syncTopbarOnScroll() {
    if (!desktopTopbar || !headerSpacer) return;

    if (window.innerWidth < 1024) {
        desktopTopbar.classList.remove('lg:max-h-0', 'lg:opacity-0');
        desktopTopbar.classList.add('lg:max-h-[52px]', 'lg:opacity-100');
        headerSpacer.classList.remove('lg:h-[76px]');
        headerSpacer.classList.add('lg:h-[128px]');
        return;
    }

    const isAtTop = window.scrollY <= 8;

    if (isAtTop) {
        desktopTopbar.classList.remove('lg:max-h-0', 'lg:opacity-0');
        desktopTopbar.classList.add('lg:max-h-[52px]', 'lg:opacity-100');
        headerSpacer.classList.add('lg:h-[128px]');
        headerSpacer.classList.remove('lg:h-[76px]');
        return;
    }

    desktopTopbar.classList.remove('lg:max-h-[52px]', 'lg:opacity-100');
    desktopTopbar.classList.add('lg:max-h-0', 'lg:opacity-0');
    headerSpacer.classList.remove('lg:h-[128px]');
    headerSpacer.classList.add('lg:h-[76px]');
}

if (mobileMenuToggle) mobileMenuToggle.addEventListener('click', openMobileDrawer);
if (mobileMenuClose) mobileMenuClose.addEventListener('click', closeMobileDrawer);
if (mobileDrawerBackdrop) mobileDrawerBackdrop.addEventListener('click', closeMobileDrawer);
mobileDrawerLinks.forEach((link) => link.addEventListener('click', closeMobileDrawer));

window.addEventListener('keydown', (event) => {
    if (event.key === 'Escape' && mobileDrawer && mobileDrawer.getAttribute('aria-hidden') === 'false') {
        closeMobileDrawer();
    }
});

window.addEventListener('resize', () => {
    if (window.innerWidth >= 1024) {
        closeMobileDrawer();
    }
});

window.addEventListener('scroll', syncTopbarOnScroll, { passive: true });
syncTopbarOnScroll();

const counterElements = document.querySelectorAll('[data-counter]');

if (counterElements.length > 0) {
    const animateCounter = (el) => {
        if (el.dataset.animated === '1') return;

        const target = Number.parseInt(el.dataset.counter ?? '0', 10);
        const suffix = el.dataset.suffix ?? '+';
        const duration = 1200;
        const start = performance.now();

        const step = (now) => {
            const progress = Math.min((now - start) / duration, 1);
            const value = Math.floor(progress * target);
            el.textContent = `${value}${suffix}`;

            if (progress < 1) {
                window.requestAnimationFrame(step);
                return;
            }

            el.textContent = `${target}${suffix}`;
            el.dataset.animated = '1';
        };

        window.requestAnimationFrame(step);
    };

    const counterObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) return;
            animateCounter(entry.target);
            observer.unobserve(entry.target);
        });
    }, { threshold: 0.4 });

    counterElements.forEach((el) => counterObserver.observe(el));
}
