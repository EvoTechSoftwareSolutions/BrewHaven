document.addEventListener('DOMContentLoaded', () => {

    // ── Mobile Menu Toggle ────────────────────────────────────────
    const hamburger = document.getElementById('mobile-menu');
    const navLinks = document.querySelector('.nav-links');
    if (hamburger) {
        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('is-active');
            navLinks.classList.toggle('active');
        });
    }

    // ── Category Pill → Smooth Scroll ────────────────────────────
    const pills = document.querySelectorAll('.m-pill');

    pills.forEach(pill => {
        pill.addEventListener('click', () => {
            pills.forEach(p => p.classList.remove('active'));
            pill.classList.add('active');

            const targetId = pill.getAttribute('data-section');
            const target = document.getElementById(targetId);
            if (target) {
                const filterBar = document.querySelector('.m-filter');
                const filterHeight = filterBar ? filterBar.offsetHeight : 0;
                const navBar = document.querySelector('.navbar');
                const navHeight = navBar ? navBar.offsetHeight : 0;
                const offset = navHeight + filterHeight + 12;
                const top = target.getBoundingClientRect().top + window.pageYOffset - offset;
                window.scrollTo({ top, behavior: 'smooth' });
            }
        });
    });

    // ── Scroll → Highlight Active Pill ───────────────────────────
    const sections = document.querySelectorAll('.m-section[id]');
    const filterBar = document.querySelector('.m-filter');

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const id = entry.target.id;
                pills.forEach(p => {
                    if (p.getAttribute('data-section') === id) {
                        pills.forEach(q => q.classList.remove('active'));
                        p.classList.add('active');
                    }
                });
            }
        });
    }, {
        root: null,
        rootMargin: '-25% 0px -65% 0px',
        threshold: 0,
    });

    sections.forEach(s => observer.observe(s));

    // ── Live Search Filter ────────────────────────────────────────
    const searchInput = document.getElementById('menu-search');
    if (searchInput) {
        searchInput.addEventListener('input', e => {
            const q = e.target.value.trim().toLowerCase();
            const cards = document.querySelectorAll(
                '.m-card, .m-juice, .m-wellness, .m-artisan'
            );
            cards.forEach(card => {
                const text = card.textContent.toLowerCase();
                const show = !q || text.includes(q);
                card.style.opacity = show ? '1' : '0.18';
                card.style.transform = show ? '' : 'scale(0.97)';
                card.style.transition = 'opacity .3s ease, transform .3s ease';
            });
        });
    }

    // ── Add to Order — Feedback Animation ────────────────────────
    document.addEventListener('click', e => {
        const btn = e.target.closest('.m-add-btn');
        if (!btn) return;
        const orig = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check"></i> Added!';
        btn.style.background = '#27ae60';
        btn.style.borderColor = '#27ae60';
        btn.style.color = '#fff';
        setTimeout(() => {
            btn.innerHTML = orig;
            btn.style.background = '';
            btn.style.borderColor = '';
            btn.style.color = '';
        }, 1600);
    });

});
