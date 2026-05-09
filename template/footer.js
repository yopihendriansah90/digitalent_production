const footerMount = document.getElementById("site-footer");

if (footerMount) {
  footerMount.innerHTML = `
    <footer class="bg-[linear-gradient(180deg,_#009adf_0%,_#0b7fc4_55%,_#09468a_100%)] text-white">
      <div class="mx-auto grid max-w-7xl gap-10 px-4 py-14 lg:grid-cols-[1.2fr_0.8fr_0.9fr_1fr] lg:gap-12">
        <div>
          <img src="Logo/PNG/Horizontal_Background Gelap.png" alt="DigiTalent" class="h-14 w-auto" />
          <p class="mt-5 max-w-sm text-[1.02rem] leading-8 text-white/84">DigiTalent supports digital transformation through capable, industry-ready talent with a focus on IT Training and IT Outsourcing.</p>
          <div class="mt-5 max-w-sm overflow-hidden rounded-2xl border border-white/20 bg-white/10 shadow-soft">
            <iframe title="DigiTalent Office Location" src="https://www.google.com/maps?q=Wisma%20Bumiputera%20Lantai%201%2C%20Jl.%20Jend.%20Sudirman%20Kav.%2075%2C%20Jakarta%20Selatan%2012910%2C%20Indonesia&z=16&output=embed" class="h-44 w-full" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>
        <div class="hidden lg:block">
          <h3 class="text-lg font-extrabold text-white">Pages</h3>
          <ul class="mt-4 space-y-3 text-white/82">
            <li><a href="index.html" class="transition hover:text-brand-cyan">Home</a></li>
            <li><a href="about.html" class="transition hover:text-brand-cyan">About Us</a></li>
            <li><a href="services.html" class="transition hover:text-brand-cyan">Services</a></li>
            <li><a href="vision-mission.html" class="transition hover:text-brand-cyan">Vision & Mission</a></li>
            <li><a href="portfolio.html" class="transition hover:text-brand-cyan">Client / Portfolio</a></li>
            <li><a href="training.html" class="transition hover:text-brand-cyan">Training</a></li>
            <li><a href="outsourcing.html" class="transition hover:text-brand-cyan">Outsourcing</a></li>
            <li><a href="contact.html" class="transition hover:text-brand-cyan">Contact</a></li>
          </ul>
        </div>
        <div class="hidden lg:block">
          <h3 class="text-lg font-extrabold text-white">Services</h3>
          <ul class="mt-4 space-y-3 text-white/82">
            <li><a href="training.html" class="transition hover:text-brand-cyan">IT Training</a></li>
            <li><a href="training.html" class="transition hover:text-brand-cyan">Certification Preparation</a></li>
            <li><a href="training.html" class="transition hover:text-brand-cyan">Corporate In-House Training</a></li>
            <li><a href="outsourcing.html" class="transition hover:text-brand-cyan">IT Outsourcing</a></li>
            <li><a href="outsourcing.html" class="transition hover:text-brand-cyan">Dedicated IT Staff</a></li>
            <li><a href="outsourcing.html" class="transition hover:text-brand-cyan">Project-Based IT Teams</a></li>
          </ul>
        </div>
        <div>
          <h3 class="text-lg font-extrabold text-white">Contact</h3>
          <ul class="mt-4 space-y-3 text-white/84">
            <li><span class="font-semibold text-white">Phone:</span> <a href="tel:+62215224520" class="transition hover:text-brand-cyan">(+62) 21 522 4520</a></li>
            <li><span class="font-semibold text-white">Email:</span> <a href="mailto:info@digitalent.co.id" class="transition hover:text-brand-cyan">info@digitalent.co.id</a></li>
            <li><span class="font-semibold text-white">Website:</span> <a href="https://www.digitalent.co.id" class="transition hover:text-brand-cyan">www.digitalent.co.id</a></li>
            <li><span class="font-semibold text-white">WhatsApp:</span> <a href="https://wa.me/628131337687" class="transition hover:text-brand-cyan">+62 813 1337 687</a></li>
            <li class="max-w-[20rem]"><span class="font-semibold text-white">Address:</span> Wisma Bumiputera Lantai 1, Jl. Jend. Sudirman Kav. 75 Jakarta Selatan 12910 Indonesia</li>
          </ul>
          <div class="mt-6 flex flex-wrap items-center gap-3">
            <a class="flex h-11 w-11 items-center justify-center overflow-hidden rounded-full bg-white/10 backdrop-blur-sm transition hover:scale-105" href="https://www.instagram.com/digitalent.systech" aria-label="DigiTalent Instagram">
              <img src="Logo/instagram.png" alt="Instagram" class="h-9 w-9 object-contain" />
            </a>
            <a class="flex h-11 w-11 items-center justify-center overflow-hidden rounded-full bg-white/10 backdrop-blur-sm transition hover:scale-105" href="https://www.linkedin.com/company/pt-systech-talenta-digital-digitalent" aria-label="DigiTalent LinkedIn">
              <img src="Logo/linkedin.webp" alt="LinkedIn" class="h-8 w-8 object-contain" />
            </a>
          </div>
        </div>
      </div>
      <div class="border-t border-white/12">
        <div class="mx-auto flex max-w-7xl flex-col items-center gap-3 px-4 py-6 text-center text-sm text-white/72 md:flex-row md:items-center md:justify-between md:text-left">
          <p>
            <span class="md:hidden">&copy; 2026 DigiTalent</span>
            <span class="hidden md:inline">&copy; 2026 PT. Systech Talenta Digital. All Rights Reserved.</span>
          </p>
          <p>Empowering Digital Talent, Enabling Global Success.</p>
        </div>
      </div>
    </footer>
    <a href="https://wa.me/628131337687" class="fixed bottom-5 right-5 z-50 block h-16 w-16 transition hover:scale-105" aria-label="Chat DigiTalent via WhatsApp">
      <img src="Logo/whatsapp.png" alt="WhatsApp" class="h-full w-full object-contain" />
    </a>
  `;
}
