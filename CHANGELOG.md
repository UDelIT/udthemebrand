# Change Log

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/) and this project adheres to [Semantic Versioning](http://semver.org/).

## [3.5.2](https://github.com/UDelIT/udthemebrand/releases/tag/3.5.2)  - 4-18-2019

### Fixed 

* Plugin should now be fully WCAG 2.0 AA compliant.

* Remove normalize default margin and padding ([#44](https://github.com/UDelIT/udthemebrand/issues/44))
* Footer color stays disabled when view footer is enabled ([#45](https://github.com/UDelIT/udthemebrand/issues/45))
* Footer not staying on bottom of page ([#46](https://github.com/UDelIT/udthemebrand/issues/46))
* Focus Visible 2.4.7 - Element not highlighted on focus ([#47](https://github.com/UDelIT/udthemebrand/issues/47))

## [3.5.1.3](https://github.com/UDelIT/udthemebrand/releases/tag/3.5.1.3)  - 11-20-2018

### Fixed
* Non-text Content 1.1.1 - WAI-ARIA image is missing alternative text ([#39](https://github.com/UDelIT/udthemebrand/issues/39))
* Non-text Content 1.1.1 - Alternative text for image is identical to link text error circle UD in footer  ([#41](https://github.com/UDelIT/udthemebrand/issues/41))
* Focus Visible 2.4.7 - Element not highlighted on focus ([#43](https://github.com/UDelIT/udthemebrand/issues/43))

## [3.5.0](https://github.com/UDelIT/udthemebrand/releases/tag/3.5.0)  - 10-25-2018

### Added
* All images replaced with svg accessible images.
* Adjust text size and content in Legal footer when browser is resized.
* Added hover events on all plugin links for accessibility.
* Added new Site Title bar.
* Accessibility features added: keyboard and tab navigation, dynamic aria settings.
* Migrated JS events, storage, feature detection from jQuery to plain JS.
* ~~Added new Quick Links menu (Apply, Visit, Give).~~
* Performance and documentation improvements.


### Fixed
* Main content needs spacing above footer ([#38](https://github.com/UDelIT/udthemebrand/issues/38))
* Footer legal links have underlines on hover ([#37](https://github.com/UDelIT/udthemebrand/issues/37))
* Divi Logo Container alignment bug ([#36](https://github.com/UDelIT/udthemebrand/issues/36))
* Header link text color and hover color not applying ([#35](https://github.com/UDelIT/udthemebrand/issues/35))
* Footer icons ([#32](https://github.com/UDelIT/udthemebrand/issues/32))
* Header - site title option ([#31](https://github.com/UDelIT/udthemebrand/issues/31))
* Header - Links have large outlines ([#30](https://github.com/UDelIT/udthemebrand/issues/30))
* Ask CampusPress to use AddHandler in htacccess for php css files ([#29](https://github.com/UDelIT/udthemebrand/issues/29))
* add ud class to body when plugin is activated, remove class when deactivated ([#27](https://github.com/UDelIT/udthemebrand/issues/27))
* Footer color not clearing when footer is disabled ([#24](https://github.com/UDelIT/udthemebrand/issues/24))
* Footer accessibility compliance via attributes ([#22](https://github.com/UDelIT/udthemebrand/issues/22))
* Header accessibility compliance via attributes ([#21](https://github.com/UDelIT/udthemebrand/issues/21))
* Create FAQ's under Support tab ([#19](https://github.com/UDelIT/udthemebrand/issues/19))
* Adjust loading gif duration value ([#10](https://github.com/UDelIT/udthemebrand/issues/10))
* Fix Divi theme #main-header z-index overriding branded footer CSS ([#9](https://github.com/UDelIT/udthemebrand/issues/9))

## [3.0.4](https://github.com/UDelIT/udthemebrand/releases/tag/3.0.4)  - 10-5-2017

### Added
* Update footer links to include Accessibility notice ([#23](https://github.com/UDelIT/udthemebrand/issues/23))
* Create FAQ's under Support tab ([#19](https://github.com/UDelIT/udthemebrand/issues/19))
* Add undefined notice help details under Support tab ([#11](https://github.com/UDelIT/udthemebrand/issues/11))

### Changed
* Update new footer styles ([#16](https://github.com/UDelIT/udthemebrand/issues/16))
* Adjust loading gif duration value ([#10](https://github.com/UDelIT/udthemebrand/issues/10))

### Fixed
* Adjust height of College name in header for touch devices ([#20](https://github.com/UDelIT/udthemebrand/issues/20))
* Fix wrong css selector name for footer (from udbrand_footer to udtbp_footer) ([#15](https://github.com/UDelIT/udthemebrand/issues/15))



---

## [3.0.2]  - 3-17-2017

### Added
* Add AJAX capability when saving plugin options ([#5](https://github.com/UDelIT/udthemebrand/issues/5))

### Changed
* Remove "branding" text from plugin header tab ([#18](https://github.com/UDelIT/udthemebrand/issues/18))

### Fixed
* Fix UDeploy theme main banner hidden under branding header ([#12](https://github.com/UDelIT/udthemebrand/issues/12))
* Fix Divi theme fixed nav error message ([#8](https://github.com/UDelIT/udthemebrand/issues/8))

---

## [3.0.1]  - 1-13-2017

### Added
* Add minimum required PHP version check ([#2](https://github.com/UDelIT/udthemebrand/issues/2))
* Add minimum required WordPress version check ([#1](https://github.com/UDelIT/udthemebrand/issues/1))

### Fixed
* Fix social icon links overlapped by circle UD container ([#7](https://github.com/UDelIT/udthemebrand/issues/7))
* Fix Twenty Fifteen sidebar overlapping branded footer ([#6](https://github.com/UDelIT/udthemebrand/issues/6))
* Fix branded header html showing on wp-login.php and admin.php screens ([#4](https://github.com/UDelIT/udthemebrand/issues/4))
* Fix wp_get_theme() not working with Twenty* themes ([#3](https://github.com/UDelIT/udthemebrand/issues/3))
---

## [3.0.0]  - 7-2-2015


* Initial release
* Add ability for web site administrators to use CPA approved custom headers
* Update branding to align with new CPA guidelines
* Display admin notice when incompatible theme is used
* Clean up documentation
* Optimize code into a more OOP approach

---

