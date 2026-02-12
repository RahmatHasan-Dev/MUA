<style>
    /* Scoped Styles for Footer to avoid conflicts */
    .mua-footer {
        background: linear-gradient(to bottom, #0f291e, #05110d);
        /* Dark cool green */
        color: #d1fae5;
        /* Light green text */
        padding: 80px 0 30px;
        font-family: 'Plus Jakarta Sans', 'Segoe UI', sans-serif;
        position: relative;
        overflow: hidden;
        margin-top: auto;
        /* Push to bottom */
        box-shadow: 0 -10px 40px rgba(0, 0, 0, 0.2);
        border-top: 1px solid rgba(16, 185, 129, 0.1);
    }

    /* Glowing Top Line */
    .mua-footer::before {
        content: '';
        position: absolute;
        top: 0;
        left: 20%;
        right: 20%;
        height: 1px;
        background: linear-gradient(90deg, transparent, #10b981, transparent);
        box-shadow: 0 0 15px rgba(16, 185, 129, 0.6);
        opacity: 0.8;
    }

    .mua-footer-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 60px;
        position: relative;
        z-index: 1;
    }

    /* Brand Section */
    .footer-brand h4 {
        font-size: 1.8rem;
        font-weight: 800;
        color: #fff;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 12px;
        letter-spacing: -0.5px;
        text-shadow: 0 0 20px rgba(16, 185, 129, 0.3);
    }

    .footer-brand h4 i {
        color: #10b981;
        filter: drop-shadow(0 0 8px rgba(16, 185, 129, 0.6));
    }

    .footer-brand p {
        color: #9ca3af;
        line-height: 1.8;
        font-size: 1rem;
        margin-bottom: 25px;
    }

    /* Links Section */
    .footer-links h5 {
        color: #fff;
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 25px;
        position: relative;
        display: inline-block;
    }

    .footer-links h5::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 40px;
        height: 3px;
        background: #10b981;
        border-radius: 2px;
        box-shadow: 0 0 10px rgba(16, 185, 129, 0.5);
    }

    .footer-links ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-links li {
        margin-bottom: 15px;
    }

    .footer-links a {
        color: #9ca3af;
        text-decoration: none;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.95rem;
    }

    .footer-links a:hover {
        color: #10b981;
        transform: translateX(5px);
        text-shadow: 0 0 10px rgba(16, 185, 129, 0.4);
    }

    .footer-links a i {
        font-size: 0.8rem;
        opacity: 0.7;
        transition: 0.3s;
    }

    .footer-links a:hover i {
        opacity: 1;
        color: #34d399;
    }

    /* Contact Section */
    .contact-item {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        margin-bottom: 20px;
        color: #9ca3af;
    }

    .contact-icon {
        background: rgba(16, 185, 129, 0.1);
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #10b981;
        font-size: 1.2rem;
        transition: 0.3s;
        flex-shrink: 0;
        border: 1px solid rgba(16, 185, 129, 0.1);
    }

    .contact-item:hover .contact-icon {
        background: #10b981;
        color: #fff;
        box-shadow: 0 0 15px rgba(16, 185, 129, 0.4);
        transform: translateY(-3px);
    }

    /* Copyright */
    .mua-copyright {
        text-align: center;
        padding-top: 40px;
        margin-top: 60px;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
        color: #6b7280;
        font-size: 0.9rem;
    }

    .mua-copyright span {
        color: #10b981;
        font-weight: 600;
    }

    /* Background Decoration */
    .footer-glow {
        position: absolute;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(16, 185, 129, 0.15) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
        z-index: 0;
    }

    .glow-1 {
        top: -100px;
        right: -50px;
    }

    .glow-2 {
        bottom: -100px;
        left: -50px;
    }

    @media (max-width: 768px) {
        .mua-footer {
            padding: 60px 0 30px;
        }

        .mua-footer-container {
            gap: 40px;
        }
    }
</style>

<footer class="mua-footer">
    <div class="footer-glow glow-1"></div>
    <div class="footer-glow glow-2"></div>

    <div class="mua-footer-container">
        <!-- Brand -->
        <div class="footer-brand">
            <h4><i class="bi bi-tree-fill"></i> MUA</h4>
            <p>
                Menadah Untuk Alam adalah inisiatif konservasi yang berdedikasi untuk melindungi keanekaragaman hayati
                Indonesia melalui aksi nyata, edukasi, dan kolaborasi berkelanjutan.
            </p>
            <div style="display: flex; gap: 15px;">
                <a href="#" class="contact-icon" style="text-decoration: none;"><i class="bi bi-instagram"></i></a>
                <a href="#" class="contact-icon" style="text-decoration: none;"><i class="bi bi-facebook"></i></a>
                <a href="#" class="contact-icon" style="text-decoration: none;"><i class="bi bi-twitter"></i></a>
                <a href="#" class="contact-icon" style="text-decoration: none;"><i class="bi bi-youtube"></i></a>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="footer-links">
            <h5>Jelajahi</h5>
            <ul>
                <li><a href="{{ route('home') }}"><i class="bi bi-chevron-right"></i> Beranda</a></li>
                <li><a href="{{ route('about') }}"><i class="bi bi-chevron-right"></i> Tentang Kami</a></li>
                <li><a href="{{ route('kegiatan') }}"><i class="bi bi-chevron-right"></i> Kegiatan</a></li>
                <li><a href="{{ route('partnership') }}"><i class="bi bi-chevron-right"></i> Partnership</a></li>
                <li><a href="{{ route('donasi') }}"><i class="bi bi-chevron-right"></i> Donasi</a></li>
            </ul>
        </div>

        <!-- Contact -->
        <div class="footer-links">
            <h5>Hubungi Kami</h5>
            <div class="contact-item">
                <div class="contact-icon"><i class="bi bi-geo-alt"></i></div>
                <div>
                    <strong style="color: #fff; display: block; margin-bottom: 4px;">Kantor Pusat</strong>
                    Jl. Kaliurang KM 14, Yogyakarta,<br>Indonesia 55584
                </div>
            </div>
            <div class="contact-item">
                <div class="contact-icon"><i class="bi bi-envelope"></i></div>
                <div>
                    <strong style="color: #fff; display: block; margin-bottom: 4px;">Email</strong>
                    halo@mua.or.id
                </div>
            </div>
            <div class="contact-item">
                <div class="contact-icon"><i class="bi bi-whatsapp"></i></div>
                <div>
                    <strong style="color: #fff; display: block; margin-bottom: 4px;">WhatsApp</strong>
                    +62 812-3456-7890
                </div>
            </div>
        </div>
    </div>

    <div class="mua-copyright">
        <div class="mua-footer-container" style="display: block; padding-top: 0;">
            <p>&copy; {{ date('Y') }} <span>Menadah Untuk Alam</span>. Dibuat dengan <i class="bi bi-heart-fill"
                    style="color: #ef4444;"></i> untuk Bumi Pertiwi.</p>
        </div>
    </div>
</footer>
