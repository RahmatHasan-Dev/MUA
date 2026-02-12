<style>
    footer {
        background: #fff;
        padding: 60px 0 20px;
        border-top: 1px solid #eee;
        color: #1f2937;
        font-family: 'Segoe UI', sans-serif;
        margin-top: auto;
        /* Push footer to bottom if content is short */
    }

    .footer-content {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 40px;
        margin-bottom: 40px;
        max-width: 1200px;
        margin-left: auto;
        margin-right: auto;
        padding: 0 2rem;
    }

    .footer-col h4 {
        color: #065f46;
        margin-bottom: 20px;
        font-size: 1.2rem;
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 700;
    }

    .footer-col p,
    .footer-col ul li {
        color: #6b7280;
        line-height: 1.7;
        font-size: 0.95rem;
    }

    .footer-col ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-col ul li {
        margin-bottom: 10px;
    }

    .footer-col ul li a {
        color: #6b7280;
        text-decoration: none;
        transition: 0.3s;
    }

    .footer-col ul li a:hover {
        color: #10b981;
        padding-left: 5px;
    }

    .copyright {
        text-align: center;
        padding-top: 30px;
        border-top: 1px solid #eee;
        color: #aaa;
        font-size: 0.9rem;
        max-width: 1200px;
        margin: 0 auto;
    }
</style>

<footer>
    <div class="footer-content">
        <div class="footer-col">
            <h4><i class="bi bi-tree-fill"></i> Menadah Untuk Alam</h4>
            <p>Organisasi nirlaba yang berfokus pada konservasi keanekaragaman hayati dan pemberdayaan masyarakat di
                Indonesia.</p>
        </div>
        <div class="footer-col">
            <h4><i class="bi bi-link-45deg"></i> Tautan Cepat</h4>
            <ul>
                <li><a href="{{ route('home') }}">Beranda</a></li>
                <li><a href="{{ route('about') }}">Tentang Kami</a></li>
                <li><a href="{{ route('donasi') }}">Donasi</a></li>
                <li><a href="{{ route('kegiatan') }}">Kegiatan</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4><i class="bi bi-geo-alt"></i> Hubungi Kami</h4>
            <ul>
                <li><i class="bi bi-envelope"></i> info@mua.org</li>
                <li><i class="bi bi-phone"></i> +62 123 4567 890</li>
                <li><i class="bi bi-geo-alt-fill"></i> Yogyakarta, Indonesia</li>
            </ul>
        </div>
    </div>
    <div class="copyright">
        <p>&copy; {{ date('Y') }} Menadah Untuk Alam. All Rights Reserved.</p>
    </div>
</footer>
