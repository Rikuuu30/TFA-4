(() => {
    const menuButton = document.querySelector('.menu-toggle');
    const navigation = document.querySelector('.primary-navigation');

    if (menuButton && navigation) {
        menuButton.addEventListener('click', () => {
            const isOpen = menuButton.getAttribute('aria-expanded') === 'true';
            menuButton.setAttribute('aria-expanded', String(!isOpen));
            navigation.classList.toggle('open', !isOpen);
        });

        navigation.addEventListener('click', (event) => {
            if (event.target instanceof HTMLAnchorElement) {
                menuButton.setAttribute('aria-expanded', 'false');
                navigation.classList.remove('open');
            }
        });
    }

    document.querySelectorAll('[data-directory]').forEach((directory) => {
        const input = directory.querySelector('[data-table-search]');
        const rows = [...directory.querySelectorAll('[data-table-row]')];
        const resultsLabel = directory.querySelector('[data-results-label]');
        const emptyState = directory.querySelector('[data-empty-state]');

        if (!input || rows.length === 0) return;

        const itemName = document.body.textContent.includes('Customer accounts') ? 'customers' : 'users';

        input.addEventListener('input', () => {
            const query = input.value.trim().toLocaleLowerCase();
            let visibleCount = 0;

            rows.forEach((row) => {
                const isMatch = row.textContent.toLocaleLowerCase().includes(query);
                row.hidden = !isMatch;
                if (isMatch) visibleCount += 1;
            });

            if (resultsLabel) {
                resultsLabel.textContent = query
                    ? `${visibleCount} ${itemName} matched your search`
                    : `Showing all ${rows.length} ${itemName}`;
            }

            if (emptyState) emptyState.hidden = visibleCount !== 0;
        });
    });
})();
