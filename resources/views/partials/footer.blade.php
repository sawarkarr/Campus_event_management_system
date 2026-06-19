<!-- Footer -->
<footer class="footer">
    <div class="footer-grid">
        <div class="footer-brand">
            <h3><i class="fas fa-calendar-alt mr-2"></i>Event Hub</h3>
            <p>The complete campus event management solution. Simplify event creation, ticketing, and attendance tracking.</p>
            <div class="footer-social">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
        
        <div class="footer-column">
            <h4>Product</h4>
            <ul>
                <li><a href="#">Features</a></li>
                <li><a href="#">Pricing</a></li>
                <li><a href="#">Integrations</a></li>
                <li><a href="#">Updates</a></li>
            </ul>
        </div>
        
        <div class="footer-column">
            <h4>Company</h4>
            <ul>
                <li><a href="{{ route('about') }}">About Us</a></li>
                <li><a href="#">Careers</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="{{ route('contact') }}">Contact</a></li>
            </ul>
        </div>
        
        <div class="footer-column">
            <h4>Support</h4>
            <ul>
                <li><a href="#">Help Center</a></li>
                <li><a href="#">Documentation</a></li>
                <li><a href="#">API Reference</a></li>
                <li><a href="#">System Status</a></li>
            </ul>
        </div>
    </div>
    
    <div class="footer-bottom">
        <p>&copy; {{ date('Y') }} Campus Event Management System. All rights reserved. | Designed by Shraddha Sawarkar</p>
    </div>
</footer>
