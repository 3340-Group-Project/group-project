<footer class="footer">
    <div class="footer-container footer-inner">
        <div class="footer-top">
            <div class="footer-brand">
                <img src="{{ asset('images/CampusLogo.png') }}" alt="CampusShelf" class="footer-logo" />
                <div class="footer-brand-text">
                    <h3>CampusShelf</h3>
                    <p>Buy, sell and share course materials with your campus community.</p>
                    <small>© {{ date('Y') }} CampusShelf</small>
                </div>
            </div>

            <div class="footer-links">
                <div class="footer-col">
                    <ul>
                        <li><a href="{{ route('about') }}">About</a></li>
                        <li><a href="{{ route('faq') }}">FAQ</a></li>
                        <li><a href="{{ route('books.index') }}">Book Listings</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <ul>
                        <li><a href="{{ route('wiki.index') }}">Wiki</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
