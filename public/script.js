/**
 * Campus Event Management & Ticketing System
 * Main JavaScript File
 * Author: Shraddha Sawarkar
 * Version: 1.0.0
 */

// ============================================
// TOAST NOTIFICATION SYSTEM
// ============================================

/**
 * Show toast notification
 * @param {string} message - Notification message
 * @param {string} type - Notification type: success, error, warning, info
 * @param {number} duration - Display duration in milliseconds
 */
function showToast(message, type = 'info', duration = 3000) {
    const container = document.getElementById('toastContainer');
    if (!container) return;

    // Create toast element
    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    
    // Icon mapping
    const icons = {
        success: 'fa-check-circle',
        error: 'fa-exclamation-circle',
        warning: 'fa-exclamation-triangle',
        info: 'fa-info-circle'
    };
    
    // Title mapping
    const titles = {
        success: 'Success',
        error: 'Error',
        warning: 'Warning',
        info: 'Information'
    };
    
    toast.innerHTML = `
        <div class="toast-icon">
            <i class="fas ${icons[type]}"></i>
        </div>
        <div class="toast-content">
            <h4>${titles[type]}</h4>
            <p>${message}</p>
        </div>
        <button class="toast-close" onclick="closeToast(this.parentElement)">
            <i class="fas fa-times"></i>
        </button>
    `;
    
    // Add to container
    container.appendChild(toast);
    
    // Trigger animation
    requestAnimationFrame(() => {
        toast.classList.add('show');
    });
    
    // Auto remove
    setTimeout(() => {
        closeToast(toast);
    }, duration);
}

/**
 * Close toast notification
 * @param {HTMLElement} toast - Toast element to close
 */
function closeToast(toast) {
    if (!toast) return;
    toast.classList.remove('show');
    setTimeout(() => {
        toast.remove();
    }, 300);
}

// ============================================
// MODAL SYSTEM
// ============================================

/**
 * Show modal by ID
 * @param {string} modalId - Modal element ID
 */
function showModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.add('active');
        document.body.style.overflow = 'hidden'; // Prevent background scrolling
    }
}

/**
 * Close modal by ID
 * @param {string} modalId - Modal element ID
 */
function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove('active');
        document.body.style.overflow = ''; // Restore scrolling
    }
}

/**
 * Close modal when clicking on overlay
 * @param {Event} event - Click event
 * @param {string} modalId - Modal element ID
 */
function closeModalOnOverlay(event, modalId) {
    if (event.target === event.currentTarget) {
        closeModal(modalId);
    }
}

/**
 * Close all modals
 */
function closeAllModals() {
    document.querySelectorAll('.modal-overlay').forEach(modal => {
        modal.classList.remove('active');
    });
    document.body.style.overflow = '';
}

// Close modal on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeAllModals();
    }
});

// ============================================
// FORM UTILITIES
// ============================================

/**
 * Validate email format
 * @param {string} email - Email to validate
 * @returns {boolean} - True if valid
 */
function isValidEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

/**
 * Validate phone number format
 * @param {string} phone - Phone number to validate
 * @returns {boolean} - True if valid
 */
function isValidPhone(phone) {
    const re = /^[\d\s\-\+\(\)]{10,}$/;
    return re.test(phone);
}

/**
 * Format date to readable string
 * @param {string|Date} date - Date to format
 * @returns {string} - Formatted date string
 */
function formatDate(date) {
    const d = new Date(date);
    const options = { year: 'numeric', month: 'short', day: 'numeric' };
    return d.toLocaleDateString('en-US', options);
}

/**
 * Format time to 12-hour format
 * @param {string} time - Time string (HH:MM)
 * @returns {string} - Formatted time string
 */
function formatTime(time) {
    const [hours, minutes] = time.split(':');
    const h = parseInt(hours);
    const ampm = h >= 12 ? 'PM' : 'AM';
    const h12 = h % 12 || 12;
    return `${h12}:${minutes} ${ampm}`;
}

/**
 * Serialize form data to object
 * @param {HTMLFormElement} form - Form element
 * @returns {Object} - Form data object
 */
function serializeForm(form) {
    const formData = new FormData(form);
    const data = {};
    for (let [key, value] of formData.entries()) {
        data[key] = value;
    }
    return data;
}

/**
 * Clear form fields
 * @param {HTMLFormElement} form - Form element
 */
function clearForm(form) {
    form.reset();
}

// ============================================
// LOCAL STORAGE UTILITIES
// ============================================

/**
 * Save data to localStorage
 * @param {string} key - Storage key
 * @param {*} value - Data to store
 */
function saveToStorage(key, value) {
    try {
        localStorage.setItem(key, JSON.stringify(value));
        return true;
    } catch (e) {
        console.error('Error saving to localStorage:', e);
        return false;
    }
}

/**
 * Get data from localStorage
 * @param {string} key - Storage key
 * @param {*} defaultValue - Default value if not found
 * @returns {*} - Stored data or default value
 */
function getFromStorage(key, defaultValue = null) {
    try {
        const item = localStorage.getItem(key);
        return item ? JSON.parse(item) : defaultValue;
    } catch (e) {
        console.error('Error reading from localStorage:', e);
        return defaultValue;
    }
}

/**
 * Remove data from localStorage
 * @param {string} key - Storage key
 */
function removeFromStorage(key) {
    try {
        localStorage.removeItem(key);
        return true;
    } catch (e) {
        console.error('Error removing from localStorage:', e);
        return false;
    }
}

// ============================================
// UI UTILITIES
// ============================================

/**
 * Toggle element visibility
 * @param {string|HTMLElement} element - Element or element ID
 * @param {string} display - Display value when visible
 */
function toggleVisibility(element, display = 'block') {
    const el = typeof element === 'string' ? document.getElementById(element) : element;
    if (el) {
        el.style.display = el.style.display === 'none' ? display : 'none';
    }
}

/**
 * Smooth scroll to element
 * @param {string|HTMLElement} element - Element or element ID
 * @param {number} offset - Offset from top
 */
function scrollToElement(element, offset = 80) {
    const el = typeof element === 'string' ? document.getElementById(element) : element;
    if (el) {
        const top = el.getBoundingClientRect().top + window.pageYOffset - offset;
        window.scrollTo({ top, behavior: 'smooth' });
    }
}

/**
 * Debounce function
 * @param {Function} func - Function to debounce
 * @param {number} wait - Wait time in milliseconds
 * @returns {Function} - Debounced function
 */
function debounce(func, wait = 300) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

/**
 * Throttle function
 * @param {Function} func - Function to throttle
 * @param {number} limit - Limit time in milliseconds
 * @returns {Function} - Throttled function
 */
function throttle(func, limit = 300) {
    let inThrottle;
    return function executedFunction(...args) {
        if (!inThrottle) {
            func(...args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    };
}

// ============================================
// DATA UTILITIES
// ============================================

/**
 * Generate unique ID
 * @param {number} length - ID length
 * @returns {string} - Unique ID
 */
function generateId(length = 8) {
    return Math.random().toString(36).substring(2, length + 2);
}

/**
 * Format currency
 * @param {number} amount - Amount to format
 * @param {string} currency - Currency code
 * @returns {string} - Formatted currency string
 */
function formatCurrency(amount, currency = 'USD') {
    return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: currency
    }).format(amount);
}

/**
 * Format number with commas
 * @param {number} num - Number to format
 * @returns {string} - Formatted number string
 */
function formatNumber(num) {
    return new Intl.NumberFormat('en-US').format(num);
}

/**
 * Truncate text
 * @param {string} text - Text to truncate
 * @param {number} length - Max length
 * @returns {string} - Truncated text
 */
function truncateText(text, length = 100) {
    if (text.length <= length) return text;
    return text.substring(0, length) + '...';
}

/**
 * Capitalize first letter
 * @param {string} str - String to capitalize
 * @returns {string} - Capitalized string
 */
function capitalize(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
}

/**
 * Capitalize all words
 * @param {string} str - String to capitalize
 * @returns {string} - Capitalized string
 */
function capitalizeWords(str) {
    return str.replace(/\b\w/g, l => l.toUpperCase());
}

// ============================================
// ANIMATION UTILITIES
// ============================================

/**
 * Add animation class to element
 * @param {string|HTMLElement} element - Element or element ID
 * @param {string} animation - Animation class name
 * @param {number} duration - Animation duration
 */
function animateElement(element, animation, duration = 1000) {
    const el = typeof element === 'string' ? document.getElementById(element) : element;
    if (el) {
        el.classList.add(animation);
        setTimeout(() => {
            el.classList.remove(animation);
        }, duration);
    }
}

/**
 * Fade in element
 * @param {string|HTMLElement} element - Element or element ID
 * @param {number} duration - Animation duration
 */
function fadeIn(element, duration = 300) {
    const el = typeof element === 'string' ? document.getElementById(element) : element;
    if (el) {
        el.style.opacity = '0';
        el.style.display = 'block';
        el.style.transition = `opacity ${duration}ms ease`;
        requestAnimationFrame(() => {
            el.style.opacity = '1';
        });
    }
}

/**
 * Fade out element
 * @param {string|HTMLElement} element - Element or element ID
 * @param {number} duration - Animation duration
 */
function fadeOut(element, duration = 300) {
    const el = typeof element === 'string' ? document.getElementById(element) : element;
    if (el) {
        el.style.transition = `opacity ${duration}ms ease`;
        el.style.opacity = '0';
        setTimeout(() => {
            el.style.display = 'none';
        }, duration);
    }
}

// ============================================
// MOBILE MENU
// ============================================

/**
 * Initialize mobile menu toggle
 */
function initMobileMenu() {
    const toggle = document.getElementById('mobileToggle');
    const menu = document.getElementById('navMenu');
    
    if (toggle && menu) {
        toggle.addEventListener('click', () => {
            menu.classList.toggle('active');
            const icon = toggle.querySelector('i');
            if (icon) {
                icon.classList.toggle('fa-bars');
                icon.classList.toggle('fa-times');
            }
        });
        
        // Close menu when clicking on a link
        menu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                menu.classList.remove('active');
                const icon = toggle.querySelector('i');
                if (icon) {
                    icon.classList.add('fa-bars');
                    icon.classList.remove('fa-times');
                }
            });
        });
    }
}

// ============================================
// SIDEBAR
// ============================================

/**
 * Initialize sidebar toggle for mobile
 */
function initSidebar() {
    const toggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    
    if (toggle && sidebar) {
        toggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });
        
        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', (e) => {
            if (window.innerWidth < 1024 && 
                !sidebar.contains(e.target) && 
                !toggle.contains(e.target) &&
                sidebar.classList.contains('active')) {
                sidebar.classList.remove('active');
            }
        });
    }
}

// ============================================
// PASSWORD TOGGLE
// ============================================

/**
 * Toggle password visibility
 * @param {string} fieldId - Password input field ID
 */
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const button = field?.nextElementSibling || field?.parentElement?.querySelector('.toggle-password');
    const icon = button?.querySelector('i');
    
    if (field && icon) {
        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            field.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
}

// ============================================
// LOADER
// ============================================

/**
 * Show loader
 */
function showLoader() {
    const loader = document.getElementById('loader');
    if (loader) {
        loader.classList.remove('hidden');
    }
}

/**
 * Hide loader
 */
function hideLoader() {
    const loader = document.getElementById('loader');
    if (loader) {
        loader.classList.add('hidden');
    }
}

// ============================================
// TABLE UTILITIES
// ============================================

/**
 * Sort table by column
 * @param {string} tableId - Table element ID
 * @param {number} columnIndex - Column index to sort by
 * @param {string} type - Sort type: string, number, date
 */
function sortTable(tableId, columnIndex, type = 'string') {
    const table = document.getElementById(tableId);
    if (!table) return;
    
    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));
    
    rows.sort((a, b) => {
        const aVal = a.cells[columnIndex].textContent.trim();
        const bVal = b.cells[columnIndex].textContent.trim();
        
        if (type === 'number') {
            return parseFloat(aVal) - parseFloat(bVal);
        } else if (type === 'date') {
            return new Date(aVal) - new Date(bVal);
        }
        return aVal.localeCompare(bVal);
    });
    
    rows.forEach(row => tbody.appendChild(row));
}

/**
 * Filter table rows
 * @param {string} tableId - Table element ID
 * @param {string} searchTerm - Search term
 * @param {number[]} columnIndices - Column indices to search
 */
function filterTable(tableId, searchTerm, columnIndices = []) {
    const table = document.getElementById(tableId);
    if (!table) return;
    
    const rows = table.querySelectorAll('tbody tr');
    const term = searchTerm.toLowerCase();
    
    rows.forEach(row => {
        let found = false;
        const cells = row.querySelectorAll('td');
        
        cells.forEach((cell, index) => {
            if (columnIndices.length === 0 || columnIndices.includes(index)) {
                if (cell.textContent.toLowerCase().includes(term)) {
                    found = true;
                }
            }
        });
        
        row.style.display = found ? '' : 'none';
    });
}

// ============================================
// AJAX UTILITIES (Backend Ready)
// ============================================

/**
 * Make AJAX request
 * @param {string} url - Request URL
 * @param {Object} options - Request options
 * @returns {Promise} - Promise resolving to response
 */
async function ajaxRequest(url, options = {}) {
    const defaultOptions = {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
        }
    };
    
    const mergedOptions = { ...defaultOptions, ...options };
    
    try {
        const response = await fetch(url, mergedOptions);
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        return await response.json();
    } catch (error) {
        console.error('AJAX Error:', error);
        throw error;
    }
}

/**
 * Submit form via AJAX
 * @param {string} formId - Form element ID
 * @param {string} url - Submission URL
 * @param {Function} onSuccess - Success callback
 * @param {Function} onError - Error callback
 */
async function submitFormAjax(formId, url, onSuccess, onError) {
    const form = document.getElementById(formId);
    if (!form) return;
    
    const formData = new FormData(form);
    const data = Object.fromEntries(formData);
    
    try {
        const response = await ajaxRequest(url, {
            method: 'POST',
            body: JSON.stringify(data)
        });
        
        if (onSuccess) onSuccess(response);
        return response;
    } catch (error) {
        if (onError) onError(error);
        throw error;
    }
}

// ============================================
// EVENT DATA (Sample Data for Frontend)
// ============================================

const sampleEvents = [
    {
        id: 1,
        name: 'Cultural Night 2024',
        category: 'cultural',
        date: '2024-12-25',
        time: '18:00',
        venue: 'Main Auditorium',
        status: 'active',
        capacity: 500,
        registered: 245,
        description: 'Annual cultural festival featuring music, dance, and drama performances by students.',
        image: 'cultural'
    },
    {
        id: 2,
        name: 'Tech Workshop',
        category: 'technical',
        date: '2024-12-28',
        time: '14:00',
        venue: 'Computer Lab 3',
        status: 'upcoming',
        capacity: 150,
        registered: 128,
        description: 'Web development basics workshop for beginners.',
        image: 'technical'
    },
    {
        id: 3,
        name: 'Sports Tournament',
        category: 'sports',
        date: '2025-01-05',
        time: '09:00',
        venue: 'Sports Complex',
        status: 'upcoming',
        capacity: 200,
        registered: 89,
        description: 'Inter-college basketball tournament.',
        image: 'sports'
    },
    {
        id: 4,
        name: 'Science Exhibition',
        category: 'academic',
        date: '2025-01-10',
        time: '10:00',
        venue: 'Science Block',
        status: 'active',
        capacity: 400,
        registered: 312,
        description: 'Research showcase by science students.',
        image: 'academic'
    }
];

/**
 * Get all events
 * @returns {Array} - Array of events
 */
function getEvents() {
    return getFromStorage('events', sampleEvents);
}

/**
 * Get event by ID
 * @param {number} id - Event ID
 * @returns {Object|null} - Event object or null
 */
function getEventById(id) {
    const events = getEvents();
    return events.find(e => e.id === id) || null;
}

/**
 * Add new event
 * @param {Object} event - Event object
 * @returns {boolean} - Success status
 */
function addEvent(event) {
    const events = getEvents();
    event.id = generateId();
    events.push(event);
    return saveToStorage('events', events);
}

/**
 * Update event
 * @param {number} id - Event ID
 * @param {Object} updates - Updated fields
 * @returns {boolean} - Success status
 */
function updateEvent(id, updates) {
    const events = getEvents();
    const index = events.findIndex(e => e.id === id);
    if (index !== -1) {
        events[index] = { ...events[index], ...updates };
        return saveToStorage('events', events);
    }
    return false;
}

/**
 * Delete event
 * @param {number} id - Event ID
 * @returns {boolean} - Success status
 */
function deleteEvent(id) {
    const events = getEvents();
    const filtered = events.filter(e => e.id !== id);
    return saveToStorage('events', filtered);
}

// ============================================
// AUTHENTICATION UTILITIES
// ============================================

/**
 * Check if user is logged in
 * @returns {boolean} - Login status
 */
function isLoggedIn() {
    return !!getFromStorage('currentUser');
}

/**
 * Get current user
 * @returns {Object|null} - Current user or null
 */
function getCurrentUser() {
    return getFromStorage('currentUser');
}

/**
 * Login user
 * @param {Object} user - User object
 */
function login(user) {
    saveToStorage('currentUser', user);
}

/**
 * Logout user
 */
function logout() {
    removeFromStorage('currentUser');
}

// ============================================
// CONFIRM DIALOGS
// ============================================

/**
 * Show confirmation dialog
 * @param {string} message - Confirmation message
 * @param {Function} onConfirm - Confirm callback
 * @param {Function} onCancel - Cancel callback
 */
function confirmAction(message, onConfirm, onCancel) {
    if (confirm(message)) {
        if (onConfirm) onConfirm();
    } else {
        if (onCancel) onCancel();
    }
}

/**
 * Show delete confirmation
 * @param {string} itemName - Name of item to delete
 * @param {Function} onConfirm - Confirm callback
 */
function confirmDelete(itemName, onConfirm) {
    confirmAction(
        `Are you sure you want to delete "${itemName}"? This action cannot be undone.`,
        onConfirm
    );
}

// ============================================
// PRINT UTILITIES
// ============================================

/**
 * Print element
 * @param {string} elementId - Element ID to print
 */
function printElement(elementId) {
    const element = document.getElementById(elementId);
    if (!element) return;
    
    const printWindow = window.open('', '_blank');
    printWindow.document.write(`
        <html>
        <head>
            <title>Print</title>
            <style>
                body { font-family: Arial, sans-serif; }
                table { width: 100%; border-collapse: collapse; }
                th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                th { background-color: #f5f5f5; }
            </style>
        </head>
        <body>
            ${element.innerHTML}
        </body>
        </html>
    `);
    printWindow.document.close();
    printWindow.print();
}

/**
 * Export table to CSV
 * @param {string} tableId - Table ID
 * @param {string} filename - Export filename
 */
function exportTableToCSV(tableId, filename = 'export.csv') {
    const table = document.getElementById(tableId);
    if (!table) return;
    
    let csv = [];
    const rows = table.querySelectorAll('tr');
    
    rows.forEach(row => {
        const cols = row.querySelectorAll('td, th');
        const rowData = [];
        cols.forEach(col => {
            rowData.push('"' + col.textContent.replace(/"/g, '""') + '"');
        });
        csv.push(rowData.join(','));
    });
    
    const csvContent = 'data:text/csv;charset=utf-8,' + csv.join('\n');
    const encodedUri = encodeURI(csvContent);
    const link = document.createElement('a');
    link.setAttribute('href', encodedUri);
    link.setAttribute('download', filename);
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

// ============================================
// INITIALIZATION
// ============================================

/**
 * Initialize all components on page load
 */
document.addEventListener('DOMContentLoaded', function() {
    // Initialize mobile menu
    initMobileMenu();
    
    // Initialize sidebar
    initSidebar();
    
    // Add smooth scroll to all anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                scrollToElement(target);
            }
        });
    });
    
    // Initialize tooltips (if any)
    document.querySelectorAll('[data-tooltip]').forEach(el => {
        el.addEventListener('mouseenter', function() {
            // Tooltip logic here
        });
    });
    
    console.log('Campus Event Management System - JavaScript Loaded');
});

// ============================================
// POLYFILLS & COMPATIBILITY
// ============================================

// Closest polyfill for IE11
if (!Element.prototype.matches) {
    Element.prototype.matches = Element.prototype.msMatchesSelector || Element.prototype.webkitMatchesSelector;
}

if (!Element.prototype.closest) {
    Element.prototype.closest = function(s) {
        var el = this;
        do {
            if (el.matches(s)) return el;
            el = el.parentElement || el.parentNode;
        } while (el !== null && el.nodeType === 1);
        return null;
    };
}

// Export functions for use in other scripts
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        showToast,
        closeToast,
        showModal,
        closeModal,
        saveToStorage,
        getFromStorage,
        formatDate,
        formatCurrency,
        generateId,
        ajaxRequest,
        getEvents,
        getEventById,
        addEvent,
        updateEvent,
        deleteEvent
    };
}
