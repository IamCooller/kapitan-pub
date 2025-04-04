# Kapitan Pub WordPress Theme

A modern, responsive WordPress theme built with TailwindCSS and Vite.

![Theme Screenshot](screenshot.png)

## 🚀 Features

- Modern development workflow with Vite
- TailwindCSS for utility-first styling
- Responsive design
- Browser-sync for live reloading
- Swiper.js integration for sliders
- WordPress coding standards compliance
- RTL support

## 🛠️ Tech Stack

- WordPress
- TailwindCSS
- Vite
- Swiper.js
- Browser-sync
- PostCSS
- Autoprefixer

## 📋 Prerequisites

Before you begin, ensure you have the following installed:
- [Node.js](https://nodejs.org/) (v14 or higher)
- [Composer](https://getcomposer.org/)
- WordPress (latest version recommended)

## 🚀 Installation

1. Clone the repository:
```bash
git clone https://github.com/IamCooller/kapitan-pub
```

2. Install dependencies:
```bash
composer install
npm install
```

3. Start development server:
```bash
npm run dev
```

4. Build for production:
```bash
npm run build
```

## 🎨 Development

The theme uses a modern development workflow:

- `npm run dev` - Starts development server with hot reload
- `npm run build` - Builds assets for production
- `composer lint:wpcs` - Checks PHP files against WordPress Coding Standards
- `composer lint:php` - Checks PHP files for syntax errors

## 📁 Project Structure

```
kapitan-pub/
├── assets/          # Theme assets (CSS, JS, images)
├── dist/           # Compiled assets
├── inc/            # PHP includes and functions
├── template-parts/ # Reusable template parts
├── vendor/         # Composer dependencies
└── node_modules/   # NPM dependencies
```

## 🔧 Configuration

- `vite.config.js` - Vite configuration
- `tailwind.config.js` - TailwindCSS configuration
- `phpcs.xml.dist` - PHP Coding Standards configuration

## 📝 License

This theme is licensed under the GPL v2 or later.

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## Using Translations with Polylang

The Kapitan Pub theme uses the Polylang plugin for multilingual functionality. Translation strings are registered in several theme files:

- `inc/polylang-strings.php` - main string registration file
- `inc/theme-setup.php` - registration of some strings during theme setup
- `inc/booking-form.php` - booking form strings

### How to Use Translations in Templates

To output translatable strings in templates, use the check with the `pll__` function:

---

Made with ❤️
