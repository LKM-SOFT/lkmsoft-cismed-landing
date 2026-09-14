/*==============================================================================
    CISMed landing - contact form
    Client-side validation (mirrors includes/contact-form.php) and submission via fetch.
    Without JavaScript the form still posts normally and the server validates it.
==============================================================================*/

(() => {
  const form = document.querySelector("[data-contact-form]");
  if (!form) return;

  const successBox = document.querySelector("[data-form-success]");
  const successMessage = document.querySelector("[data-form-success-message]");
  const errorBox = form.querySelector("[data-form-error]");
  const errorMessage = form.querySelector("[data-form-error-message]");
  const submitButton = form.querySelector("[data-submit-button]");
  const submitSpinner = form.querySelector("[data-submit-spinner]");
  const submitLabel = form.querySelector("[data-submit-label]");

  const NAME_PATTERN = /^[\p{L}\p{M}]+(?:[\s'.-][\p{L}\p{M}]+)+\.?$/u;
  const EMAIL_PATTERN = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;
  // Cédula profesional (SEP): numeric, older licenses have fewer digits.
  const PROFESSIONAL_LICENSE_PATTERN = /^\d{5,8}$/;

  const normalizeMobile = (value) => {
    let digits = value.replace(/\D+/g, "");
    if (digits.length === 13 && digits.startsWith("521")) digits = digits.slice(3);
    else if (digits.length === 12 && digits.startsWith("52")) digits = digits.slice(2);
    return digits;
  };

  /** Each validator returns an error message, or an empty string when the value is valid. */
  const validators = {
    full_name: (field) => {
      const value = field.value.trim().replace(/\s+/g, " ");
      if (!value) return "Escribe tu nombre y apellidos.";
      if (value.length < 5 || !NAME_PATTERN.test(value)) return "Escribe tu nombre y al menos un apellido, solo con letras.";
      return "";
    },
    professional_license: (field) => {
      const value = field.value.replace(/[\s-]+/g, "");
      if (!value) return "Escribe tu cédula profesional.";
      if (!PROFESSIONAL_LICENSE_PATTERN.test(value)) return "La cédula profesional debe tener entre 5 y 8 dígitos, solo números.";
      return "";
    },
    specialty: (field) => (field.value ? "" : "Selecciona tu especialidad."),
    mobile_phone: (field) => {
      if (!field.value.trim()) return "Escribe tu número de celular.";
      if (normalizeMobile(field.value).length !== 10) return "El celular debe tener 10 dígitos.";
      return "";
    },
    email: (field) => {
      const value = field.value.trim();
      if (!value) return "Escribe tu correo electrónico.";
      if (!EMAIL_PATTERN.test(value)) return "Escribe un correo electrónico válido.";
      return "";
    },
    privacy_consent: (field) => (field.checked ? "" : "Debes aceptar el aviso de privacidad para enviar tus datos."),
  };

  const setFieldError = (name, message) => {
    const field = form.elements[name];
    const feedback = document.getElementById(`${name}-error`);
    if (!field || !feedback) return;

    field.classList.toggle("is-invalid", Boolean(message));
    field.setAttribute("aria-invalid", message ? "true" : "false");
    feedback.textContent = message;
  };

  const validateField = (name) => {
    const message = validators[name](form.elements[name]);
    setFieldError(name, message);
    return message === "";
  };

  const validateForm = () => {
    const invalidFields = Object.keys(validators).filter((name) => !validateField(name));
    if (invalidFields.length) form.elements[invalidFields[0]].focus();
    return invalidFields.length === 0;
  };

  const showFormError = (message) => {
    errorMessage.textContent = message;
    errorBox.classList.toggle("d-none", !message);
  };

  const setLoading = (isLoading) => {
    submitButton.disabled = isLoading;
    submitSpinner.classList.toggle("d-none", !isLoading);
    submitButton.querySelector("svg")?.classList.toggle("d-none", isLoading);
    submitLabel.textContent = isLoading ? "Enviando…" : "Enviar solicitud";
  };

  // Live feedback: validate a field once the user leaves it, then re-check while they fix it.
  Object.keys(validators).forEach((name) => {
    const field = form.elements[name];
    const eventName = field.type === "checkbox" || field.tagName === "SELECT" ? "change" : "blur";

    field.addEventListener(eventName, () => validateField(name));
    field.addEventListener("input", () => {
      if (field.classList.contains("is-invalid")) validateField(name);
    });
  });

  // The professional license only accepts digits: drop anything else while typing.
  form.elements.professional_license.addEventListener("input", (event) => {
    const field = event.target;
    const digits = field.value.replace(/\D+/g, "");
    if (digits !== field.value) field.value = digits;
  });

  form.addEventListener("submit", async (event) => {
    event.preventDefault();
    showFormError("");

    if (!validateForm()) return;

    setLoading(true);

    try {
      const response = await fetch(form.action, {
        method: "POST",
        body: new FormData(form),
        headers: { Accept: "application/json" },
        credentials: "same-origin",
      });
      const result = await response.json();

      if (result.ok) {
        // Conversion for Google Analytics (defined in analytics.js on production only). No personal data is sent.
        window.trackEvent?.("generate_lead", { form_name: "contact" });

        successMessage.textContent = result.message;
        form.classList.add("d-none");
        successBox.classList.remove("d-none");
        successBox.scrollIntoView({ behavior: "smooth", block: "center" });
        return;
      }

      Object.entries(result.errors || {}).forEach(([name, message]) => setFieldError(name, message));
      showFormError(result.message);
    } catch (error) {
      showFormError("No pudimos enviar tu solicitud. Revisa tu conexión e inténtalo de nuevo.");
    } finally {
      setLoading(false);
    }
  });
})();
