=== Allotment Theme ===

Contributors: juettemann
Tags: community, custom-colors, custom-logo, custom-menu, custom-header, featured-images, full-width-template, translation-ready
Requires at least: 6.7
Tested up to: 6.7
Requires PHP: 8.1
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A clean, community-focused theme for allotment association websites.

== Description ==

Allotment Theme is a dependency-free WordPress theme designed to pair with the Allotment Manager plugin. It provides a warm, garden-inspired homepage with hero, feature cards and call-to-action sections, plus a generic page template that renders plugin shortcodes (registration form, member portal, event gallery) without clipping.

Features:

* Sticky navigation with mobile hamburger menu
* Hero section with image, badge, stat card and dual CTAs
* Three feature cards with icon, title, body and bullet list
* Sage-gradient CTA section
* Four-column dark footer with quick links, resources and contact details
* Customiser fields for hero copy, stat card, feature cards, CTA and contact info
* SVG icon sprite (lucide-derived, ISC licensed)
* CSS custom properties throughout — rebrand by editing a single file
* No build step, no framework, no JavaScript dependencies (~30 KB of assets)

== Installation ==

1. Upload the `allotment-theme` directory to `/wp-content/themes/`.
2. Activate the theme via **Appearance → Themes** or `wp theme activate allotment-theme`.
3. Visit **Appearance → Customise** to set the brand name, hero copy, feature cards, CTA text and contact details.
4. Set a static front page: **Settings → Reading → Your homepage displays → A static page → Homepage**.
5. Configure nav menus at **Appearance → Menus**: Primary, Footer Quick Links, Footer Resources.

== Customising ==

All editable content lives in the Customiser:

* **Hero**: badge text, headline (two lines), body copy, primary/secondary button labels and URLs, hero image.
* **Stat card**: number and label shown overlapping the hero image.
* **Feature cards (×3)**: icon, title, body, three bullet points per card.
* **CTA section**: heading, body, primary/secondary button labels and URLs.
* **Footer contact**: address (multi-line), email, Facebook URL, Instagram URL, founded year.

To rebrand: edit `assets/css/variables.css`. Every colour, radius and shadow is a CSS custom property.

== Plugin integration ==

The theme detects the body class `has-am-member-portal` (added by Allotment Manager when the portal shortcode renders) and widens the page container so portal tables breathe. No other plugin coupling.

== Credits ==

Icons derived from [Lucide](https://lucide.dev) — ISC License. See ATTRIBUTIONS.md.

== Changelog ==

= 1.0.0 =
* Initial release.
