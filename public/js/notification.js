document.addEventListener('DOMContentLoaded', () => {
    const notificationsList = document.getElementById('notifications');
    const filterButtons = document.querySelectorAll('[data-filter]');
    const sortButtons = document.querySelectorAll('[data-sort]');
    const markAllReadBtn = document.getElementById('markAllRead');
    const visibleCountSpan = document.getElementById('visibleCount');
    const totalCountSpan = document.getElementById('totalCount');
    const loadMoreBtn = document.getElementById('loadMore');

    let currentFilter = 'all';
    let currentSort = 'newest';
    const ITEMS_PER_PAGE = 10;
    let currentPage = 1;

    // Initialize counters
    function updateCounters() {
        const total = notificationsList.querySelectorAll('.notification-item').length;
        const visible = notificationsList.querySelectorAll('.notification-item:not(.d-none)').length;
        totalCountSpan.textContent = total;
        visibleCountSpan.textContent = visible;
    }

    // Filter notifications
    function filterNotifications() {
        const notifications = notificationsList.querySelectorAll('.notification-item');
        notifications.forEach(notification => {
            const category = notification.getAttribute('data-category');
            if (currentFilter === 'all' || category === currentFilter) {
                notification.classList.remove('d-none');
            } else {
                notification.classList.add('d-none');
            }
        });
        updateCounters();
        checkLoadMoreVisibility();
    }

    // Sort notifications
    function sortNotifications() {
        const notifications = Array.from(notificationsList.querySelectorAll('.notification-item'));
        notifications.sort((a, b) => {
            const timeA = parseInt(a.getAttribute('data-timestamp'));
            const timeB = parseInt(b.getAttribute('data-timestamp'));
            return currentSort === 'newest' ? timeB - timeA : timeA - timeB;
        });

        notifications.forEach(notification => {
            notificationsList.appendChild(notification);
        });
    }

    // Handle filter button clicks
    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            filterButtons.forEach(btn => {
                btn.classList.remove('active');
                btn.classList.remove('btn-primary');
                btn.classList.add('btn-outline-primary');
            });

            button.classList.add('active');
            button.classList.remove('btn-outline-primary');
            button.classList.add('btn-primary');

            currentFilter = button.getAttribute('data-filter');
            currentPage = 1;
            filterNotifications();
        });
    });

    // Handle sort button clicks
    sortButtons.forEach(button => {
        button.addEventListener('click', () => {
            currentSort = button.getAttribute('data-sort');
            sortButtons.forEach(btn => {
                btn.classList.remove('active');
            });
            button.classList.add('active');
            sortNotifications();
        });
    });

    // Mark all as read
    markAllReadBtn?.addEventListener('click', () => {
        const unreadNotifications = notificationsList.querySelectorAll('.notification-item:not(.read)');
        unreadNotifications.forEach(notification => {
            notification.classList.add('read');
            const indicator = notification.querySelector('.badge');
            if (indicator) {
                indicator.remove();
            }
        });

        // You might want to add an AJAX call here to update the read status in the backend
        fetch('/api/notifications/mark-all-read', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            }
        }).then(response => {
            if (response.ok) {
                console.log('All notifications marked as read');
            }
        }).catch(error => {
            console.error('Error marking notifications as read:', error);
        });
    });

    // Handle load more
    function checkLoadMoreVisibility() {
        const visibleNotifications = notificationsList.querySelectorAll('.notification-item:not(.d-none)').length;
        if (visibleNotifications < ITEMS_PER_PAGE * currentPage) {
            loadMoreBtn.parentElement.classList.add('d-none');
        } else {
            loadMoreBtn.parentElement.classList.remove('d-none');
        }
    }

    loadMoreBtn?.addEventListener('click', () => {
        currentPage++;
        // Here you would typically make an AJAX call to load more notifications
        // For now, we'll just update the visibility of existing ones
        checkLoadMoreVisibility();
    });

    // Initial setup
    updateCounters();
    filterNotifications();
    sortNotifications();
    checkLoadMoreVisibility();
});