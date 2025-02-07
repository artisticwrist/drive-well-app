<nav>
    <div class="logo primary-background-color">
        <h1 class="montserrat-head secondary-text-color">Drive Wells</h1>
    </div>
    <div class="navigations montserrat-text">
        <div class="nav-one secondary-background-color primary-text-color">
            <ul>
                <li>08032683662</li>
                <li>contactdev.bigjoe@gmail.com</li>
                <li>09032384759</li>
            </ul>
            <ul>
                <li><b>Follow us</b></li>
                <li>|</li>
                <li>Tw</li>
                <li>Fb</li>
                <li>Ln</li>
            </ul>
        </div>
        <div class="nav-two primary-background-color secondary-text-color">
            <ul>
                <li>Home</li>
                <li>About</li>
                <li>Download</li>
                <li>Contact</li>
                <li><a href="{{ route('login') }}">Admin</a></li>
            </ul>
            <button class="primary-background-color download-app"><a href="" class="secondary-text-color">Download app</a></button>
        </div>
    </div>

    <div class="ham-burger" onclick="showNav()">
        <div class="burger"></div>
        <div class="burger"></div>
        <div class="burger"></div>
    </div>

    <p onclick="closeNav()" class="montserrat-text secondary-text-color close-nav">Close</p>
</nav>

<section class="nav-responsive">
    <div class="secondary-text-color montserrat-text nav-responsive-list">
        <ul>
            <li>Home</li>
            <li>About</li>
            <li>Download</li>
            <li>Contact</li>
            <li><a href="{{ route('login') }}">Admin</a></li>
        </ul>
        <button class="secondary-background-color download-app"><a href="" class="primary-text-color">Download app</a></button>
        <ul>
            <h3>Contact Us</h3>
            <li>08032683662</li>
            <li>contactdev.bigjoe@gmail.com</li>
            <li>09032384759</li>
        </ul>
        <ul class="follow">
            <li><b>Follow us</b></li>
            <li>|</li>
            <li>Tw</li>
            <li>Fb</li>
            <li>Ln</li>
        </ul>
    </div>

    <p class="copy-right montserrat-text secondary-text-color">Copyrights 2024 @ drive-well.info@gmail.com</p>
</section>