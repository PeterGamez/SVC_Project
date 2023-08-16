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
            th: {
                consentModal: {
                    label: "Cookie consent",
                    description: "เว็บไซต์นี้ใช้คุกกี้ที่จำเป็นเพื่อให้แน่ใจว่ามีการทำงานที่เหมาะสมและติดตามคุกกี้เพื่อทำความเข้าใจว่าคุณโต้ตอบกับเว็บไซต์อย่างไร หลังจะถูกตั้งค่าหลังจากได้รับความยินยอมเท่านั้น",
                    acceptAllBtn: "Accept all",
                    acceptNecessaryBtn: "Reject all",
                    showPreferencesBtn: "Manage preferences",
                    title: "We use cookies!"
                },
                preferencesModal: {
                    title: "Cookie Preferences Setting",
                    acceptAllBtn: "Accept all",
                    acceptNecessaryBtn: "Reject all",
                    savePreferencesBtn: "Save preferences",
                    closeIconLabel: "Close modal",
                    serviceCounterLabel: "Service|Services",
                    sections: [
                        {
                            title: "Cookie Usage",
                            description: "เว็บไซต์นี้ใช้คุกกี้เพื่อให้แน่ใจว่าฟังก์ชันพื้นฐานของเว็บไซต์และเพื่อปรับปรุงประสบการณ์ออนไลน์ของคุณ คุณสามารถเลือกสำหรับแต่ละหมวดหมู่เพื่อเข้าร่วม/ไม่ใช้ได้ทุกเมื่อที่คุณต้องการ สำหรับรายละเอียดเพิ่มเติมเกี่ยวกับคุกกี้และข้อมูลที่ละเอียดอ่อนอื่นๆ"
                        },
                        {
                            title: "Strictly Necessary Cookies <span class=\"pm__badge\">Always Enabled</span>",
                            description: "คุกกี้เหล่านี้จำเป็นสำหรับการทำงานที่เหมาะสมของเว็บไซต์ของเรา หากไม่มีคุกกี้เหล่านี้ เว็บไซต์จะทำงานไม่ถูกต้อง",
                            linkedCategory: "necessary"
                        },
                        {
                            title: "Functionality Cookies",
                            description: "คุกกี้เหล่านี้ช่วยให้เว็บไซต์จดจำตัวเลือกที่คุณได้ทำไว้ในอดีต",
                            linkedCategory: "functionality"
                        },
                        {
                            title: "Analytics Cookies",
                            description: "คุกกี้เหล่านี้รวบรวมข้อมูลเกี่ยวกับวิธีที่คุณใช้เว็บไซต์ หน้าที่คุณเข้าชม และลิงก์ใดที่คุณคลิก ข้อมูลทั้งหมดจะไม่เปิดเผยชื่อและไม่สามารถใช้เพื่อระบุตัวตนของคุณได้",
                            linkedCategory: "analytics",
                            cookieTable: {
                                headers: {
                                    name: "Name",
                                    description: "Description",
                                    Service: "Service"
                                },
                                body: [
                                    {
                                        name: "_ga*, _gid, google-analytics*",
                                        description: "Used to track you",
                                        Service: "Google Analytics"
                                    },
                                ]
                            }
                        },
                        {
                            title: "More information",
                            description: "สำหรับข้อสงสัยเกี่ยวกับนโยบายของเราเกี่ยวกับคุกกี้และตัวเลือกของคุณ โปรดติดต่อผ่าน live chat"
                        }
                    ]
                }
            },
            en: {
                consentModal: {
                    label: "Cookie consent",
                    description: "Hi, this website uses essential cookies to ensure its proper operation and tracking cookies to understand how you interact with it. The latter will be set only after consent.",
                    acceptAllBtn: "Accept all",
                    acceptNecessaryBtn: "Reject all",
                    showPreferencesBtn: "Manage preferences",
                    title: "We use cookies!"
                },
                preferencesModal: {
                    title: "Cookie Preferences Setting",
                    acceptAllBtn: "Accept all",
                    acceptNecessaryBtn: "Reject all",
                    savePreferencesBtn: "Save preferences",
                    closeIconLabel: "Close modal",
                    serviceCounterLabel: "Service|Services",
                    sections: [
                        {
                            title: "Cookie Usage",
                            description: "I use cookies to ensure the basic functionalities of the website and to enhance your online experience. You can choose for each category to opt-in/out whenever you want. For more details relative to cookies and other sensitive data."
                        },
                        {
                            title: "Strictly Necessary Cookies <span class=\"pm__badge\">Always Enabled</span>",
                            description: "These cookies are essential for the proper functioning of my website. Without these cookies, the website would not work properly",
                            linkedCategory: "necessary"
                        },
                        {
                            title: "Functionality Cookies",
                            description: "These cookies allow the website to remember the choices you have made in the past",
                            linkedCategory: "functionality"
                        },
                        {
                            title: "Analytics Cookies",
                            description: "These cookies collect information about how you use the website, which pages you visited and which links you clicked on. All of the data is anonymized and cannot be used to identify you",
                            linkedCategory: "analytics",
                            cookieTable: {
                                headers: {
                                    name: "Name",
                                    description: "Description",
                                    Service: "Service"
                                },
                                body: [
                                    {
                                        name: "_ga*, _gid, google-analytics*",
                                        description: "Used to track you",
                                        Service: "Google Analytics"
                                    },
                                ]
                            }
                        },
                        {
                            title: "More information",
                            description: "For any query in relation to my policy on cookies and your choices, please contact as live chat."
                        }
                    ]
                }
            }
        },
        autoDetect: "browser"
    }
});