// Small progressive enhancements, shared by Laravel and the static export.
const menuButton = document.querySelector('[data-menu-button]');
const mobileMenu = document.getElementById('mobile-navigation');
const setMenu = (open) => {
    if (!menuButton || !mobileMenu) return;
    menuButton.setAttribute('aria-expanded', String(open));
    menuButton.querySelector('[data-menu-label]').textContent = open ? 'Close' : 'Menu';
    mobileMenu.hidden = !open;
    document.querySelector('.site-header').classList.toggle('menu-open', open);
};
menuButton?.addEventListener('click', () => setMenu(menuButton.getAttribute('aria-expanded') !== 'true'));
mobileMenu?.querySelectorAll('a').forEach((link) => link.addEventListener('click', () => setMenu(false)));
document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape' && menuButton?.getAttribute('aria-expanded') === 'true') {
        setMenu(false);
        menuButton.focus();
    }
});
matchMedia('(min-width: 1000px)').addEventListener('change', (event) => { if (event.matches) setMenu(false); });

document.querySelectorAll('[data-schedule-cities]').forEach((group) => {
    const cities = [...group.querySelectorAll('.schedule-city')];
    const name = group.querySelector('[data-schedule-city-name]');
    let current = 0;
    const activate = (index) => {
        current = (index + cities.length) % cities.length;
        cities.forEach((city, cityIndex) => { city.hidden = cityIndex !== current; });
        name.textContent = cities[current].dataset.cityName;
    };
    group.querySelector('[data-schedule-city-previous]').addEventListener('click', () => activate(current - 1));
    group.querySelector('[data-schedule-city-next]').addEventListener('click', () => activate(current + 1));
});

document.querySelectorAll('[data-starting-list-toggle]').forEach((button) => {
    button.addEventListener('click', () => {
        button.setAttribute('aria-pressed', String(button.getAttribute('aria-pressed') !== 'true'));
    });
});

document.querySelectorAll('[data-merchandise-carousel]').forEach((carousel) => {
    const viewport = carousel.querySelector('[data-merchandise-viewport]');
    const scroll = (direction) => {
        const slide = viewport.querySelector('.merchandise-slide');
        if (!slide) return;
        const gap = Number.parseFloat(getComputedStyle(viewport).gap) || 0;
        viewport.scrollBy({ left: direction * (slide.getBoundingClientRect().width + gap), behavior: 'smooth' });
    };
    carousel.querySelector('[data-merchandise-previous]').addEventListener('click', () => scroll(-1));
    carousel.querySelector('[data-merchandise-next]').addEventListener('click', () => scroll(1));
});

if (!matchMedia('(prefers-reduced-motion: reduce)').matches) {
    document.querySelectorAll('[data-archive-gallery-tile]').forEach((tile, index) => {
        const layers = [...tile.querySelectorAll('.archive-gallery-layer')];
        if (layers.length < 2) return;
        let current = 0;
        const advance = () => {
            layers[current].classList.remove('is-active');
            current = (current + 1) % layers.length;
            layers[current].classList.add('is-active');
        };
        window.setTimeout(() => window.setInterval(advance, 6200 + (index % 3) * 700), index * 520);
    });
}

const informationTabs = new Map();
document.querySelectorAll('[data-tabs]').forEach((group) => {
    const list = group.querySelector('[role="tablist"]');
    const tabs = [...list.querySelectorAll('[role="tab"]')];
    const activate = (tab, focus = false) => {
        tabs.forEach((item) => {
            const selected = item === tab;
            item.setAttribute('aria-selected', String(selected));
            item.tabIndex = selected ? 0 : -1;
            document.getElementById(item.getAttribute('aria-controls')).hidden = !selected;
        });
        if (focus) tab.focus({ preventScroll: true });
        if (group.hasAttribute('data-information') && matchMedia('(max-width: 700px)').matches) {
            // Scroll the selector itself, not the page, when navigating by keyboard.
            list.scrollLeft = tab.offsetLeft - list.offsetLeft - 5;
        }
    };
    if (group.hasAttribute('data-information')) {
        tabs.forEach((tab) => informationTabs.set(tab.getAttribute('aria-controls'), () => activate(tab)));
        const updateOrientation = () => list.setAttribute('aria-orientation', matchMedia('(max-width: 700px)').matches ? 'horizontal' : 'vertical');
        updateOrientation();
        matchMedia('(max-width: 700px)').addEventListener('change', updateOrientation);
        const move = (direction) => {
            const current = tabs.findIndex((tab) => tab.getAttribute('aria-selected') === 'true');
            activate(tabs[(current + direction + tabs.length) % tabs.length], true);
        };
        group.querySelector('[data-information-previous]').addEventListener('click', () => move(-1));
        group.querySelector('[data-information-next]').addEventListener('click', () => move(1));
    }
    tabs.forEach((tab, index) => {
        tab.addEventListener('click', () => activate(tab));
        tab.addEventListener('keydown', (event) => {
            const vertical = list.getAttribute('aria-orientation') === 'vertical';
            const next = vertical ? 'ArrowDown' : 'ArrowRight';
            const previous = vertical ? 'ArrowUp' : 'ArrowLeft';
            let target;
            if (event.key === next) target = (index + 1) % tabs.length;
            if (event.key === previous) target = (index - 1 + tabs.length) % tabs.length;
            if (event.key === 'Home') target = 0;
            if (event.key === 'End') target = tabs.length - 1;
            if (target !== undefined) { event.preventDefault(); activate(tabs[target], true); }
        });
    });
});

const revealInformation = (hash, focus = false) => {
    const id = hash.replace(/^#/, '');
    const activate = informationTabs.get(id);
    if (!activate) return;
    activate();
    const panel = document.getElementById(id);
    if (focus) panel.focus({ preventScroll: true });
    panel.scrollIntoView({ block: 'start' });
};
document.querySelectorAll('[data-info-link]').forEach((link) => link.addEventListener('click', () => revealInformation(link.hash, true)));
window.addEventListener('hashchange', () => revealInformation(location.hash));
if (location.hash) revealInformation(location.hash);
