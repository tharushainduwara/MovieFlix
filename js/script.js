
/**
 * Search functionality
 * This function finds the search bar and adds an event listener.
 * It filters movies by showing/hiding the .movie-card elements
 * already rendered by PHP on the page.
 */
function setupSearch() {
    const searchInput = document.querySelector('.search-bar input');
    const searchButton = document.querySelector('.search-bar button');
    const grid = document.querySelector('.movies-grid'); // The container for cards

    // If these elements don't exist on the current page, do nothing.
    if (!searchInput || !searchButton || !grid) {
        return;
    }

    const allCards = grid.querySelectorAll('.movie-card');
    let noResultsEl = null; // We will create this element if needed

    const performSearch = () => {
        const searchTerm = searchInput.value.toLowerCase().trim();
        let visibleCount = 0;

        // Loop through all movie cards on the page
        allCards.forEach(card => {
            // Get text content from the card's elements
            const title = card.querySelector('.movie-title')?.textContent.toLowerCase() || '';
            const category = card.querySelector('.movie-category')?.textContent.toLowerCase() || '';
            const description = card.querySelector('.movie-description')?.textContent.toLowerCase() || '';

            // Check if the card's content includes the search term
            const isVisible = title.includes(searchTerm) ||
                              category.includes(searchTerm) ||
                              description.includes(searchTerm);

            // Show or hide the card
            card.style.display = isVisible ? '' : 'none';
            if (isVisible) {
                visibleCount++;
            }
        });

        // Handle the "No results" message
        if (visibleCount === 0) {
            if (!noResultsEl) {
                // Create the "No results" element if it doesn't exist
                noResultsEl = document.createElement('div');
                noResultsEl.className = 'no-results';
                noResultsEl.style = 'grid-column: 1 / -1; text-align: center; padding: 40px; color: var(--gray);';
                grid.appendChild(noResultsEl);
            }
            // Update the message and show it
            noResultsEl.innerHTML = `
                <i class="fas fa-film" style="font-size: 48px; margin-bottom: 20px; opacity: 0.5;"></i>
                <h3>No movies found</h3>
                <p>Your search for "${searchInput.value}" returned no results.</p>
            `;
            noResultsEl.style.display = '';
        } else {
            // If we have results, hide the "No results" message
            if (noResultsEl) {
                noResultsEl.style.display = 'none';
            }
        }
    };

    // Event listeners for search
    searchButton.addEventListener('click', performSearch);
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault(); // Stop form from submitting
            performSearch();
        }
    });

    // Bonus: Show all movies again if the search bar is cleared
    searchInput.addEventListener('input', () => {
        if (searchInput.value.trim() === '') {
            allCards.forEach(card => card.style.display = '');
            if (noResultsEl) {
                noResultsEl.style.display = 'none';
            }
        }
    });
}

/**
 * Mobile menu functionality
 * Toggles the 'active' class on the navigation links
 * when the mobile menu icon is clicked.
 */
function setupMobileMenu() {
    const mobileMenu = document.querySelector('.mobile-menu');
    const navLinks = document.querySelector('.nav-links');

    if (mobileMenu && navLinks) {
        mobileMenu.addEventListener('click', function() {
            navLinks.classList.toggle('active');
        });

        // Close menu when clicking on links
        const navLinksItems = navLinks.querySelectorAll('a');
        navLinksItems.forEach(link => {
            link.addEventListener('click', function() {
                navLinks.classList.remove('active');
            });
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!navLinks.contains(e.target) && !mobileMenu.contains(e.target)) {
                navLinks.classList.remove('active');
            }
        });
    }
}

/**
 * Initialize all JavaScript functionality
 * This runs after the HTML document is fully loaded.
 */
function initializePage() {
    setupSearch();
    setupMobileMenu();
    // All page-specific card generation is now done by PHP.
    // There is no more static 'movies' array or 'generateMovieCards' function.
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', initializePage);