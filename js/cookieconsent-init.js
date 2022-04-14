// obtain plugin
var cc = initCookieConsent();

// run plugin with your configuration
cc.run({
  current_lang: "en",
  // autoclear_cookies: true, // default: false
  // page_scripts: true, // default: false

  // mode: 'opt-in'                          // default: 'opt-in'; value: 'opt-in' or 'opt-out'
  // delay: 0,                               // default: 0
  // auto_language: null                     // default: null; could also be 'browser' or 'document'
  // autorun: true,                          // default: true
  force_consent: false,
  // hide_from_bots: false,                  // default: false
  // remove_cookie_tables: false             // default: false
  // cookie_name: 'cc_cookie',               // default: 'cc_cookie'
  // cookie_expiration: 182,                 // default: 182 (days)
  // cookie_necessary_only_expiration: 182   // default: disabled
  // cookie_domain: location.hostname,       // default: current domain
  // cookie_path: '/',                       // default: root
  // cookie_same_site: 'Lax',                // default: 'Lax'
  // use_rfc_cookie: false,                  // default: false
  // revision: 0,                            // default: 0

  languages: {
    en: {
      consent_modal: {
        title: cookieconsent.title,
        description: cookieconsent.message,
        primary_btn: {
          text: cookieconsent.agree_button,
          role: "accept_all", // 'accept_selected' or 'accept_all'
        },
      },
      settings_modal: {
        blocks: [],
      },
    },
  },
  gui_options: {
    consent_modal: {
      layout: "box", // box/cloud/bar
      position: "bottom left", // bottom/middle/top + left/right/center
      transition: "slide", // zoom/slide
      swap_buttons: false, // enable to invert buttons
    },
  },
});
