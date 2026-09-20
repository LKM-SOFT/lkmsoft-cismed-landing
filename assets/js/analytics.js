/*==============================================================================
    CISMed landing - Google Analytics consent and events
    Loaded only on production hosts (see analytics_enabled() in includes/config.php).
    The gtag snippet in includes/head.php starts with every consent denied; this file
    shows the cookie banner, stores the visitor's choice and reports key events.
==============================================================================*/

/*
    1. Event helper
    2. Cookie consent banner
    3. Events: WhatsApp and email clicks
*/

(() => {
  const script = document.currentScript;
  const CONSENT_KEY = script?.dataset.consentKey || "cismed_cookie_consent";

  /**=====================
    1. Event helper
  ==========================**/
  /** Sends a GA4 event. Exposed so other scripts (e.g. the contact form) can report conversions. */
  window.trackEvent = (name, params = {}) => {
    if (typeof window.gtag === "function") window.gtag("event", name, params);
  };

  /**=====================
    2. Cookie consent banner
  ==========================**/
  const banner = document.querySelector("[data-cookie-banner]");

  const readChoice = () => {
    try {
      return localStorage.getItem(CONSENT_KEY);
    } catch (error) {
      return null;
    }
  };

  const saveChoice = (choice) => {
    try {
      localStorage.setItem(CONSENT_KEY, choice);
    } catch (error) {
      // Private browsing can block storage: the choice then lasts only for this page view.
    }
  };

  const showBanner = () => {
    if (banner) banner.hidden = false;
  };

  const hideBanner = () => {
    if (banner) banner.hidden = true;
  };

  const applyChoice = (choice) => {
    saveChoice(choice);
    window.gtag?.("consent", "update", { analytics_storage: choice === "granted" ? "granted" : "denied" });
    hideBanner();
  };

  if (!readChoice()) showBanner();

  banner?.querySelectorAll("[data-cookie-choice]").forEach((button) => {
    button.addEventListener("click", () => applyChoice(button.dataset.cookieChoice));
  });

  // "Preferencias de cookies" in the footer reopens the banner to change the choice.
  document.querySelectorAll("[data-cookie-preferences]").forEach((button) => {
    button.addEventListener("click", () => {
      showBanner();
      banner?.querySelector('[data-cookie-choice="granted"]')?.focus();
    });
  });

  /**=====================
    3. Events: WhatsApp and email clicks
  ==========================**/
  document.addEventListener("click", (event) => {
    const link = event.target.closest("a");
    if (!link) return;

    if (link.hasAttribute("data-whatsapp-link")) {
      window.trackEvent("whatsapp_click", { link_location: link.dataset.trackLocation || "unknown" });
      return;
    }

    if (link.hasAttribute("data-account-link")) {
      window.trackEvent("create_account_click", { link_location: link.dataset.trackLocation || "unknown" });
      return;
    }

    if (link.protocol === "mailto:") {
      // The <body> class is "page-<slug>" (see includes/head.php): report the page when it is not the footer.
      const pageName = document.body.className.replace(/^page-/, "");
      window.trackEvent("email_click", { link_location: link.closest("footer") ? "footer" : pageName });
    }
  });
})();
