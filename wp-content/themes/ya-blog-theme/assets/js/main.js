/**
 * YA Blog Theme Main JavaScript
 */

(function() {
    'use strict';

    document.addEventListener('DOMContentLoaded', function() {
        // Mobile menu toggle
        const navigationToggle = document.querySelector('.menu-toggle');
        const navigation = document.querySelector('.main-navigation');

        if (navigationToggle) {
            navigationToggle.addEventListener('click', function() {
                navigation.classList.toggle('toggled');
                this.setAttribute('aria-expanded',
                    this.getAttribute('aria-expanded') === 'false' ? 'true' : 'false'
                );
            });
        }

        // Touch device excerpt toggle
        if ('ontouchstart' in window) {
            const postArticles = document.querySelectorAll('.post-list article');

            postArticles.forEach(function(article) {
                article.addEventListener('touchstart', function(e) {
                    // Don't prevent default - we want links to still work
                    const isActive = this.classList.contains('touch-active');

                    // Remove active class from all other articles
                    postArticles.forEach(function(otherArticle) {
                        if (otherArticle !== article) {
                            otherArticle.classList.remove('touch-active');
                        }
                    });

                    // Toggle active class on tapped article
                    if (!isActive) {
                        this.classList.add('touch-active');
                    } else {
                        this.classList.remove('touch-active');
                    }
                });
            });

            // Close excerpts when tapping outside
            document.addEventListener('touchstart', function(e) {
                if (!e.target.closest('.post-list article')) {
                    postArticles.forEach(function(article) {
                        article.classList.remove('touch-active');
                    });
                }
            });
        }
    });

})();
