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
