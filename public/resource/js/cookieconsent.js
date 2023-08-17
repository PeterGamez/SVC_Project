/**
 * CookieConsent
 * https://github.com/orestbida/cookieconsent
 */

import { run } from 'https://cdn.jsdelivr.net/gh/orestbida/cookieconsent@v3.0.0-rc.16/dist/cookieconsent.esm.js';

run({
    guiOptions: {
        consentModal: {
            layout: "box inline",
            position: "bottom left",
            equalWeightButtons: false,
            flipButtons: false
        },
        preferencesModal: {
            layout: "box",
            position: "right",
            equalWeightButtons: false,
            flipButtons: false
        }
    },
    categories: {
        necessary: {
            readOnly: true
        },
        functionality: {},
        analytics: {}
    },
    language: {
        default: "th",
        translations: {
            th: "https://cdn.jsdelivr.net/gh/itsvc-dev/public/lastboss/json/cookieconsent-th.json",
            en: "https://cdn.jsdelivr.net/gh/itsvc-dev/public/lastboss/json/cookieconsent-en.json"
        },
        autoDetect: "browser"
    }
});