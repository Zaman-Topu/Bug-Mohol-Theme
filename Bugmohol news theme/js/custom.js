document.addEventListener("DOMContentLoaded", () => {
  const toggleBtns = document.querySelectorAll("#darkModeToggle, #darkModeToggleMobile");
  const body = document.body;
  const themeIcons = document.querySelectorAll("#themeIcon, #darkModeToggleMobile i");

  function updateThemeUI(isDark) {
    themeIcons.forEach(icon => {
      icon.className = isDark ? "fas fa-sun" : "fas fa-moon";
    });
    
    // Update mobile text if it exists
    const mobileText = document.querySelector(".dark-mode-text");
    if (mobileText) {
      mobileText.textContent = isDark ? "লাইট মোড" : "ডার্ক মোড";
    }
  }

  // Check local storage for dark mode preference
  if (localStorage.getItem("theme") === "dark") {
    body.classList.add("dark-mode");
    updateThemeUI(true);
  } else {
    updateThemeUI(false);
  }

  toggleBtns.forEach(btn => {
    btn.addEventListener("click", (e) => {
      e.preventDefault();
      body.classList.toggle("dark-mode");
      const isDark = body.classList.contains("dark-mode");
      localStorage.setItem("theme", isDark ? "dark" : "light");
      updateThemeUI(isDark);
    });
  });

  // Live Bangla Date and Time Clock
  const banglaDigits = {
    0: "০",
    1: "১",
    2: "২",
    3: "৩",
    4: "৪",
    5: "৫",
    6: "৬",
    7: "৭",
    8: "৮",
    9: "৯",
  };
  const banglaDays = [
    "রবিবার",
    "সোমবার",
    "মঙ্গলবার",
    "বুধবার",
    "বৃহস্পতিবার",
    "শুক্রবার",
    "শনিবার",
  ];
  const banglaMonths = [
    "জানুয়ারি",
    "ফেব্রুয়ারি",
    "মার্চ",
    "এপ্রিল",
    "মে",
    "জুন",
    "জুলাই",
    "আগস্ট",
    "সেপ্টেম্বর",
    "অক্টোবর",
    "নভেম্বর",
    "ডিসেম্বর",
  ];

  function translateToBangla(str) {
    return str.toString().replace(/[0-9]/g, function (w) {
      return banglaDigits[w];
    });
  }

  function updateBanglaTime() {
    const clocks = document.querySelectorAll(".live-bangla-clock");
    if (clocks.length === 0) return;

    const now = new Date();
    const dayName = banglaDays[now.getDay()];
    const day = translateToBangla(String(now.getDate()).padStart(2, "0"));
    const monthName = banglaMonths[now.getMonth()];
    const year = translateToBangla(now.getFullYear());

    // Format: সোমবার, ০৯ মার্চ ২০২৬
    const timeString = `${dayName}, ${day} ${monthName} ${year}`;

    clocks.forEach((clock) => {
      clock.innerHTML = `<i class="far fa-calendar-alt me-1 text-muted"></i> ${timeString}`;
    });
  }

  // Update every minute (no need to tick every second if it's only a date)
  setInterval(updateBanglaTime, 60000);
  updateBanglaTime(); // Initial call

  // Sidebar Tab Widget Logic
  const tabBtns = document.querySelectorAll(".tab-btn");
  if (tabBtns.length > 0) {
    tabBtns.forEach((btn) => {
      btn.addEventListener("click", function () {
        // Remove active classes
        tabBtns.forEach((b) => b.classList.remove("active", "text-primary"));
        document.querySelectorAll(".tab-pane").forEach((p) => {
          p.classList.remove("active", "show");
          p.classList.add("d-none");
        });

        // Add active to current
        this.classList.add("active", "text-primary");
        const targetPane = document.getElementById(
          this.getAttribute("data-target"),
        );
        if (targetPane) {
          targetPane.classList.remove("d-none");
          // Add slight delay for animation
          setTimeout(() => {
            targetPane.classList.add("active", "show");
          }, 50);
        }
      });
    });
  }

  // --- Sticky Navbar Logic ---
  const siteNav = document.getElementById("site-navigation");
  const stickyContainer = document.querySelector(".header-main");

  if (siteNav && stickyContainer) {
    window.addEventListener("scroll", () => {
      // Calculate offset to fix nav when header main scrolls out
      const stickyOffset = stickyContainer.offsetHeight;

      if (window.scrollY > stickyOffset) {
        siteNav.classList.add("is-sticky");
      } else {
        siteNav.classList.remove("is-sticky");
      }
    });
  }
});
