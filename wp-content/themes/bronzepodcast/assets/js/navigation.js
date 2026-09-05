(() => {
  const header = document.querySelector('[data-site-header]');
  const toggle = document.querySelector('[data-menu-toggle]');
  const navigation = document.querySelector('[data-site-navigation]');

  if (!header || !toggle || !navigation) return;

  const closeMenu = () => {
    header.classList.remove('menu-is-open');
    toggle.setAttribute('aria-expanded', 'false');
    toggle.querySelector('.screen-reader-text').textContent = 'Abrir menu';
  };

  toggle.addEventListener('click', () => {
    const willOpen = !header.classList.contains('menu-is-open');
    header.classList.toggle('menu-is-open', willOpen);
    toggle.setAttribute('aria-expanded', String(willOpen));
    toggle.querySelector('.screen-reader-text').textContent = willOpen ? 'Fechar menu' : 'Abrir menu';
  });

  navigation.addEventListener('click', (event) => {
    if (event.target.closest('a')) closeMenu();
  });

  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') closeMenu();
  });

  const updateHeader = () => {
    header.classList.toggle('site-header--scrolled', window.scrollY > 24);
  };

  updateHeader();
  window.addEventListener('scroll', updateHeader, { passive: true });

  const newsletter = document.querySelector('[data-newsletter-form]');
  if (newsletter) {
    newsletter.addEventListener('submit', (event) => event.preventDefault());
  }
})();
