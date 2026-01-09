<footer>
    <div class="container">
        <div class="footer-content">
            <div class="footer-col">
                <h4><i class="bi bi-tree"></i> Menadah Untuk Alam</h4>
                <p>Organisasi nirlaba yang berfokus pada konservasi keanekaragaman hayati dan pemberdayaan masyarakat
                    Indonesia.</p>
            </div>
            <div class="footer-col">
                <h4><i class="bi bi-link-45deg"></i> Tautan Cepat</h4>
                <ul>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ route('about') }}">Tentang Kami</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ route('visimisi') }}">Visi Misi</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ route('kegiatan') }}">Kegiatan</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ route('fun-fact') }}">Fun Fact</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4><i class="bi bi-telephone"></i> Kontak Kami</h4>
                <ul>
                    <li><i class="bi bi-envelope"></i> novandidirobi@students.amikom.ac.id</li>
                    <li><i class="bi bi-phone"></i> +62 123 4567 890</li>
                    <li><i class="bi bi-geo-alt"></i> Daerah Istimewa Yogyakarta, Indonesia</li>
                </ul>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; {{ date('Y') }} MUA. Hak Cipta Dilindungi.</p>
        </div>
    </div>
</footer>

<script>
    // General script for header, dropdown, etc.
    window.addEventListener("scroll", () => {
        const header = document.getElementById("header");
        if (window.scrollY > 100) {
            header.classList.add("scrolled");
        } else {
            header.classList.remove("scrolled");
        }
    });

    const menuToggle = document.getElementById("menuToggle");
    const navLinks = document.getElementById("navLinks");

    menuToggle.addEventListener("click", () => {
        menuToggle.classList.toggle("active");
        navLinks.classList.toggle("active");
    });

    const dropdowns = document.querySelectorAll(".dropdown");
    dropdowns.forEach((dropdown) => {
        const toggle = dropdown.querySelector(".dropdown-toggle");
        toggle.addEventListener("click", function(e) {
            if (window.innerWidth <= 768) {
                e.preventDefault();
                dropdown.classList.toggle("active");
                dropdowns.forEach((otherDropdown) => {
                    if (otherDropdown !== dropdown) {
                        otherDropdown.classList.remove("active");
                    }
                });
            }
        });
    });

    document.addEventListener("click", function(e) {
        if (!e.target.closest(".dropdown")) {
            dropdowns.forEach((dropdown) => {
                dropdown.classList.remove("active");
            });
        }
    });

    navLinks.addEventListener("click", (e) => {
        if (e.target.tagName === "A" && !e.target.classList.contains("dropdown-toggle")) {
            menuToggle.classList.remove("active");
            navLinks.classList.remove("active");
            dropdowns.forEach((dropdown) => {
                dropdown.classList.remove("active");
            });
        }
    });
</script>
