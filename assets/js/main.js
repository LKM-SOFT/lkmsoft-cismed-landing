/*==============================================================================
    CISMed landing - main script
    Based on the Curoxa template scripts (loader, PWA and service worker removed).
==============================================================================*/

/*
    1. Icons
    2. Animations (AOS + section titles)
    3. Sticky header
    4. Mobile menu
    4.1 Segmented navigation pill (desktop)
    5. Back to top
    6. Footer accordion
    7. Smooth scroll (Lenis)
    8. WhatsApp links
*/

const prefersReducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

/**=====================
  1. Icons
==========================**/
lucide.createIcons();

/**=====================
  2. Animations
==========================**/
document.addEventListener("DOMContentLoaded", () => {
  AOS.init({ once: true, disable: prefersReducedMotion });

  // The template hides the hero title until it is animated.
  const heroTitle = document.querySelector(".home-style1 h1");
  if (heroTitle) heroTitle.style.visibility = "visible";

  if (prefersReducedMotion || typeof gsap === "undefined") return;

  gsap.registerPlugin(ScrollTrigger);

  if (heroTitle) {
    const heroSplit = new SplitType(heroTitle, { types: "words, chars" });
    gsap.from(heroSplit.chars, {
      scale: 0,
      opacity: 0,
      stagger: 0.02,
      duration: 0.5,
      ease: "back.out(2)",
    });
  }

  document.querySelectorAll(".theme-title h2").forEach((title) => {
    const split = new SplitType(title, { types: "words, chars" });

    gsap.from(split.chars, {
      scale: 0,
      opacity: 0,
      stagger: 0.02,
      duration: 0.5,
      ease: "back.out(2)",
      scrollTrigger: { trigger: title, start: "top 85%", once: true },
    });
  });
});

/**=====================
  3. Sticky header
==========================**/
const header = document.getElementById("header");
const STICKY_POINT = 300;

window.addEventListener("scroll", () => {
  header.classList.toggle("sticky-header", window.scrollY > STICKY_POINT);
});

/**=====================
  4. Mobile menu
==========================**/
(() => {
  const menuBtn = document.querySelector(".menu-btn");
  const menuOverlay = document.querySelector(".menu-overlay");
  const menuItems = document.querySelector(".menu-items");
  const closeMenu = document.querySelector(".close-menu");

  if (!menuBtn || !menuOverlay || !menuItems || !closeMenu) return;

  const setMenuOpen = (isOpen) => {
    menuOverlay.classList.toggle("show", isOpen);
    menuItems.classList.toggle("open", isOpen);
    menuBtn.setAttribute("aria-expanded", String(isOpen));
    document.body.classList.toggle("menu-open", isOpen);
  };

  menuBtn.addEventListener("click", () => setMenuOpen(true));
  [closeMenu, menuOverlay].forEach((el) => el.addEventListener("click", () => setMenuOpen(false)));
  document.addEventListener("keydown", (event) => {
    if (event.key === "Escape") setMenuOpen(false);
  });
})();

/**=====================
  4.1 Segmented navigation pill (desktop)
==========================**/
// iOS-style segmented control. On page load the active link is highlighted by CSS alone (no JS, no motion).
// Only when the user picks another link does a pill appear over the current one and slide to the new link,
// right before the new page loads.
(() => {
  const nav = document.querySelector("[data-segmented-nav]");
  const pill = nav?.querySelector("[data-nav-pill]");
  if (!nav || !pill) return;

  const desktopQuery = window.matchMedia("(min-width: 1200px)");
  const links = [...nav.querySelectorAll(".menu-link-item > a")];
  const initialActive = links.find((link) => link.classList.contains("active"));
  const NAVIGATION_DELAY = prefersReducedMotion ? 0 : 320;

  const SLIDE_DURATION = 400;
  const SLIDE_EASING = "cubic-bezier(0.3, 0.7, 0.2, 1)";

  /** Size and position of a link inside the navigation, as pill styles. */
  const pillGeometry = (link) => {
    const navRect = nav.getBoundingClientRect();
    const linkRect = link.getBoundingClientRect();

    return {
      width: `${linkRect.width}px`,
      height: `${linkRect.height}px`,
      transform: `translate(${linkRect.left - navRect.left - nav.clientLeft}px, ${linkRect.top - navRect.top - nav.clientTop}px)`,
    };
  };

  const setActive = (link) => {
    links.forEach((item) => {
      item.classList.toggle("active", item === link);
      if (item === link) item.setAttribute("aria-current", "page");
      else item.removeAttribute("aria-current");
    });
  };

  const slideTo = (link) => {
    const current = links.find((item) => item.classList.contains("active"));
    const from = pillGeometry(current || link);
    const to = pillGeometry(link);

    // The pill replaces the static highlight and ends on the chosen link.
    Object.assign(pill.style, to);
    nav.classList.add("is-sliding");
    setActive(link);

    // Explicit start and end keyframes, so it slides from the current link in either direction.
    if (current && !prefersReducedMotion) {
      pill.animate(
        [
          { width: from.width, transform: from.transform },
          { width: to.width, transform: to.transform },
        ],
        { duration: SLIDE_DURATION, easing: SLIDE_EASING },
      );
    }
  };

  links.forEach((link) => {
    link.addEventListener("click", (event) => {
      const opensElsewhere = event.metaKey || event.ctrlKey || event.shiftKey || event.altKey || event.button !== 0;
      if (!desktopQuery.matches || opensElsewhere || link.classList.contains("active")) return;

      event.preventDefault();
      slideTo(link);
      window.setTimeout(() => {
        window.location.href = link.href;
      }, NAVIGATION_DELAY);
    });
  });

  // Coming back with the browser's back button restores this page from cache: show its original state.
  window.addEventListener("pageshow", (event) => {
    if (!event.persisted) return;
    nav.classList.remove("is-sliding");
    pill.getAnimations().forEach((animation) => animation.cancel());
    setActive(initialActive);
  });
})();

/**=====================
  5. Back to top
==========================**/
(() => {
  const backToTop = document.getElementById("backToTop");
  if (!backToTop) return;

  window.addEventListener("scroll", () => {
    backToTop.classList.toggle("show", window.scrollY > 300);
  });

  backToTop.addEventListener("click", () => {
    window.scrollTo({ top: 0, behavior: prefersReducedMotion ? "auto" : "smooth" });
  });
})();

/**=====================
  6. Footer accordion
==========================**/
(() => {
  const titles = document.querySelectorAll(".footer-title");

  const setupFooterAccordion = () => {
    const isMobile = window.innerWidth <= 576;

    titles.forEach((title) => {
      const content = title.nextElementSibling;
      if (!content) return;

      title.classList.remove("active");
      content.style.overflow = isMobile ? "hidden" : "visible";
      content.style.maxHeight = isMobile ? "0px" : "none";
    });
  };

  titles.forEach((title) => {
    title.addEventListener("click", () => {
      if (window.innerWidth > 576) return;

      const isActive = title.classList.contains("active");

      titles.forEach((other) => {
        other.classList.remove("active");
        other.nextElementSibling.style.maxHeight = "0px";
      });

      if (!isActive) {
        title.classList.add("active");
        title.nextElementSibling.style.maxHeight = title.nextElementSibling.scrollHeight + "px";
      }
    });
  });

  setupFooterAccordion();
  window.addEventListener("resize", setupFooterAccordion);
})();

/**=====================
  7. Smooth scroll (Lenis)
==========================**/
const HEADER_OFFSET = -100;

if (!prefersReducedMotion) {
  window.lenis = new Lenis({
    autoRaf: true,
    // Leave room for the sticky header when jumping to in-page anchors.
    anchors: { offset: HEADER_OFFSET },
    allowNestedScroll: true,
  });
}

// Links from other pages (e.g. features#billing): jump to the section once the layout is ready.
window.addEventListener("load", () => {
  const target = window.location.hash && document.querySelector(window.location.hash);
  if (!target) return;

  if (window.lenis) {
    window.lenis.scrollTo(target, { offset: HEADER_OFFSET, immediate: true });
  } else {
    target.scrollIntoView();
  }
});

/**=====================
  8. WhatsApp links
==========================**/
// The server renders a universal wa.me link. Here it is replaced by WhatsApp Web on desktop
// and by the WhatsApp app on phones and tablets, keeping the prefilled message.
(() => {
  const links = document.querySelectorAll("[data-whatsapp-link]");
  if (!links.length) return;

  const userAgent = navigator.userAgent;
  const isIpadOs = /Macintosh/.test(userAgent) && navigator.maxTouchPoints > 1;
  const isMobile = /Android|iPhone|iPad|iPod|Mobile|Opera Mini|IEMobile/i.test(userAgent) || isIpadOs;

  links.forEach((link) => {
    // encodeURIComponent writes spaces as %20; WhatsApp can show a literal "+" otherwise.
    const query = `phone=${encodeURIComponent(link.dataset.whatsappPhone)}&text=${encodeURIComponent(link.dataset.whatsappText)}`;

    link.href = isMobile ? `https://api.whatsapp.com/send?${query}` : `https://web.whatsapp.com/send?${query}`;
  });
})();
